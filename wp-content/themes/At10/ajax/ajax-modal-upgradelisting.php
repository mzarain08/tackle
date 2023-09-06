<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
	global $CORE, $userdata;
	
	$GLOBALS['flag-upgrade-memberships'] = 1;
	
	$randomID = uniqid();
	
	$postid = $_POST['pid'];
	
	$hasUpgradeOptions = 0;
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$size = "large";
if(isset($GLOBALS['ajax-size'])){
$size = $GLOBALS['ajax-size'];
}
?>
<div class="card-popup <?php echo $size; ?>">
<div class="bg-primary pt-3">    
<div class="card-popup-content">      
<div class="pop-icons-line pt-4">
<?php
$images = array(); $i = 1;

$files = $CORE->MEDIA("get_formatted_images_for_header", $postid);
 
foreach( $files as $ik => $im){
	
	
	if(strlen($im['thumbnail']) > 1){
	if($i > 3){ continue; }
	?>
   
     <div class="pop-icon pop-animate popIn <?php if($i == 2){ ?>delay-500 middle<?php }else{ ?>delay-300 side<?php } ?>">
            <div class="bg-image" style="background-image:url('<?php echo $im['thumbnail']; ?>');">
            </div>
      </div>  
      
    <?php
	$i++;
	}
}
?>
</div>
</div>
</div>
</div> 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
    
?>
 
    

<div class="card shadow-sm border-0" style="max-height:600px; overflow:hidden; overflow-y:scroll">
  <div class="card-body">
  
 
  <h5 class="text-700 mb-4"><a href="<?php echo get_permalink($postid); ?>" target="_blank" class="text-dark"><?php echo get_the_title($postid); ?></a></h5>
 
  <div id="ajax_addon_payment_form"></div> 
  <?php 
   
  if($CORE->PACKAGE("has_expired", $postid) == "1" ){
  
  	$hasUpgradeOptions = 1;
  	
	$relist = $CORE->relist_price($postid); 
	  
  	$renewprice = $relist['price'];
  	$renewdays = $relist['days'];
  
  ?>
  
  <div class="card p-2 mb-4 p-3  text-center text-md-left">



<div class="row">
        <div class="col-md-9">
         
         <div class="fs-5 text-600 mb-3"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("%s Renewal","premiumpress")) ?></div>
		
          <p class="mb-0 small"> 
          
           <?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")),__("Your %s has expired. Click continue to relist this item.","premiumpress")); ?> 
		   
		   
		   <?php //echo str_replace("%d", $renewdays ,__("Renew for another %d days.","premiumpress")); ?> 
           
          </p> 
          
        </div>
        <div class="col-md-3">
          
          <a href="javascript:void(0);" onclick="processNewPayment('#renew<?php echo esc_attr($postid); ?>')" data-ppt-btn class="btn-system text-dark btn-block">
		 
          <?php echo __("Continue","premiumpress"); ?>
         
          </a> 
          
            <input type="hidden" id="renew<?php echo esc_attr($postid); ?>" value="<?php  
           echo $CORE->order_encode(array(
           
            "uid" => $userdata->ID, 
            "amount" => $renewprice,    	
            "order_id" => "RENEW-".$postid."-".rand(0,1000),  	 
            "description" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s renewal","premiumpress"))." - ".get_the_title($postid),   	
            "recurring" => 0,   	
            "couponcode" => 0, 
            "full" => 1,     								
           ) ); 
                    
           ?>" />
           <div class="mt-2  font-weight-bold text-center">
           <?php if($renewprice  == 0){ echo __("FREE","premiumpress"); }else{ echo hook_price($renewprice); } ?> 
          </div>
         
          
        </div>
      </div> 
     
    
</div>
  
  <hr />
  <?php  } ?>
  
  
  
  
<?php

$addons = $CORE->PACKAGE("get_packages_addons", array() );
if(!empty($addons )){

// CHECK NOT HIDDEN
$canShow = false;
foreach($addons as $a){ 

	if( _ppt(array('lst', $a['key'].'_enable')) == '1' || is_admin() ){ $canShow = true; }

}
if($canShow){

 foreach($addons as $a){  
 
 	if($a['key'] == "addon_boost"){ continue; }
 	if( _ppt(array('lst', $a['key'].'_enable')) != '1'  && !is_admin()){ continue; } 
	if(_ppt(array('lst','addon_sponsored_enable')) != "1" && $a['key'] == "addon_sponsored"){ continue; }
	if(_ppt(array('lst','addon_featured_enable')) != "1" && $a['key'] == "addon_featured"){ continue; }
	
	 
	$active = 0; 
	if(get_post_meta($postid, str_replace("addon_","",$a['key']), true) == 1){ 
		$active = 1;
	}
	
	$hasUpgradeOptions = 1;

?>

<div class="p-2 mb-4 p-3 text-center text-lg-left" ppt-border1>



<div class="row">
        <div class="col-md-9">
         <div class="fs-5 text-700 mb-3"><?php echo $a['name']; ?></div>
		
          <div class="fs-7 opacity-5"> 
          
           <?php if(is_numeric(_ppt(array('lst', $a['key'].'_days'))) && _ppt(array('lst', $a['key'].'_days')) > 0){ echo str_replace("%s",_ppt(array('lst', $a['key'].'_days')),$a['desc_days']); }else{ echo $a['desc']; } ?>
          
          </div> 
          
              
          <?php $addon_expirydate = get_post_meta($postid, str_replace("addon_","",$a['key'])."_expires", true);			 
			if($addon_expirydate != ""){  
			 
			 
			?>
            <div class="mt-2 small font-weight-bold">
            <?php echo __("Active until","premiumpress"); ?>: <?php echo hook_date($addon_expirydate); ?>
            </div>
            <?php  } ?>
          
          
        </div>
        <div class="col-md-3">
          <?php if($active){ ?>
          
          <a href="javascript:void(0);" data-ppt-btn class="btn-primary text-light opacity-5 btn-block">
		  <i class="fa fa-check"></i> <?php echo __("Enabled","premiumpress"); ?>
          </a> 
          
          <?php }else{ ?>
          <a href="javascript:void(0);" onclick="processNewPayment('#<?php echo $a['key']; ?><?php echo esc_attr($postid); ?>')" data-ppt-btn class="btn-primary text-light btn-block">
		  <?php echo __("Upgrade","premiumpress"); ?>
          </a> 
            <input type="hidden" id="<?php echo $a['key']; ?><?php echo esc_attr($postid); ?>" value="<?php  
           echo $CORE->order_encode(array(
           
            "uid" 			=> $userdata->ID, 
            "amount" 		=> _ppt(array('lst', $a['key'].'_price')),    	
            "order_id" 		=> "UPGRADE-".$postid."-".str_replace("addon_","",$a['key']),  	 
            "description" 	=> $a['pay_text'],   	
            "recurring" 	=> 0,   	
            "couponcode" 	=> 1, 
            "full" 			=> 1,     								
           ) ); 
                    
           ?>" />
           <div class="mt-2  font-weight-bold text-center">
         <?php echo hook_price(_ppt(array('lst', $a['key'].'_price'))); ?> 
          </div>
          <?php } ?>
          
        </div>
      </div> 
     
    
</div> 
   
   
<?php } ?>
 
<?php } }  ?>


<?php if(!$hasUpgradeOptions){ ?>

<div class="alert alert-success small"><i class="fa fa-check"></i> <?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")),__("Your %s is fully updated.","premiumpress")); ?></div>

<?php } ?>

  </div>
</div>