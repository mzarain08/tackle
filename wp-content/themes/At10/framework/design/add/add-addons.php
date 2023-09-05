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

$addons = $CORE->PACKAGE("get_packages_addons", array() );
if(!empty($addons )){

// CHECK NOT HIDDEN
$canShow = false;
foreach($addons as $a){ 

	if( _ppt(array('lst', $a['key'].'_enable')) == '1' || is_admin() ){ $canShow = true; }

}
if($canShow){
?>

<div id="ajax_addon_payment_form"></div>
<div class="card ppt-forms rounded-0">
 
  <div class="card-body single">
  
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="media media-title">
    <div class="media-body">
        <h6><?php echo __("Upgrade","premiumpress"); ?></h6>
        <p><?php echo __("Get more page views.","premiumpress"); ?></p>
    </div>
    <span>
    	<i class="fa fa-star"></i>
    </span>         
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
 
  
  
    
    <?php foreach($addons as $a){  if( _ppt(array('lst', $a['key'].'_enable')) != '1'  && !is_admin()){ continue; } 
	
	
	if($a['key'] == "addon_boost"){ continue; }
	
	if(_ppt(array('lst','addon_sponsored_enable')) != "1" && $a['key'] == "addon_sponsored"){ continue; }
	
	if(_ppt(array('lst','addon_featured_enable')) != "1" && $a['key'] == "addon_featured"){ continue; } 
	
	 ?> 
	 
    <div class=" pt-2 mb-3 <?php echo $a['key']; ?>"> 
   
      
     <div class="d-flex justify-content-between"> 
     <div>  
      <div class="d-flex">
      
        <?php if(is_admin() || (!is_admin() && !isset($_GET['eid']) ) ){ ?>
            
        <label class="custom-control custom-checkbox">
        <input type="checkbox"  value="1" class="custom-control-input" id="<?php echo $a['key']; ?>check" 
	
        <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ echo "checked=checked"; } ?>
        
		 onclick="<?php if(isset($_GET['eid']) && !is_admin() ){ ?>jQuery('.<?php echo $a['key']; ?> .paymentform').toggle();<?php } ?> ChekME('#<?php echo $a['key']; ?>');">
        
        
        <input type="hidden" name="<?php echo $a['key']; ?>" id="<?php echo $a['key']; ?>add" value="<?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ echo 1; }else{ echo 0; } ?>" class="form-control">
        
        <span class="custom-control-label">&nbsp;</span> </label>
        
        <?php } ?>
      
      <span class="text-700"><?php echo $a['name']; ?></span>
      
      </div>
    </div>  
   
   <div>   
   
   
      
   <?php $active = 0; $inclided = 0; 
   
   
   if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ $active = 1; ?>
   
        <span class="text-success small float-right"><i class="fa fa-check"></i> <?php echo __("active","premiumpress"); ?></span> 
     
      <?php }else{ ?>
		
        <?php if( _ppt(array('lst', $a['key'].'_enable')) == '1' ){ ?>          
       
        <span class="addonprice text-500" >+ <strong class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(_ppt(array('lst', $a['key'].'_price'))); ?></strong></span>
       
       <?php } ?>
        
        <span class="text-success small includedtext" style="display:none;"><i class="fa fa-check mr-2"></i><?php echo __("included","premiumpress"); ?></span>
      
               
   
    <?php } ?>
    
    </div>
    </div>
     
       <?php
	   
	   	   
	     $showtxt = 1;
		if($active){
			 
			$addon_expirydate = get_post_meta($_GET['eid'], str_replace("addon_","",$a['key'])."_expires", true);
						 
			if($addon_expirydate != ""){ 
				
				$expdate = do_shortcode('[TIMELEFT postid="'.$_GET['eid'].'" layout="1" text_before="" text_ended="'.__("Never Expires","premiumpress").'" key="'.str_replace("addon_","",$a['key'])."_expires".'"]');
				
				if(strlen( $expdate) > 0 && strtolower($expdate) != "ended"){ $showtxt=0; ?>
				 
				<div class="small mb-2 d-flex mt-2">
                
                <div>
                <i class="fal fa-clock mr-2"></i> <?php echo __("Upgrade Expires In","premiumpress"); ?>: 
                </div>
                
                <span class="ml-2 opacity-8 text-400"><?php echo $expdate; ?> </span>
                
                
                </div>
        
        
		<?php 
					
				} 
			}
		
		}
		
		if($showtxt){ ?>
      <div class="small text-muted mt-2">
	  <?php if(is_numeric(_ppt(array('lst', $a['key'].'_days'))) && _ppt(array('lst', $a['key'].'_days')) > 0){ echo str_replace("%s",_ppt(array('lst', $a['key'].'_days')),$a['desc_days']); }else{ echo $a['desc']; } ?>
      </div>
      <?php } ?>
      
         
      
  
    <?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ ?>
    
	<?php if(get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ ?>
   
    <?php }elseif(!is_admin()){ ?>
    
    <div class="paymentform mt-2" >
     
     <a href="javascript:void(0);" onclick="<?php echo $a['ajax']; ?>('<?php echo esc_attr($_GET['eid']); ?>')" class="btn btn-dark btn-sm text-light"><?php echo __("Learn More","premiumpress"); ?></a>
     
     
    </div>
 
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
</div>
</div>
<?php } ?>
 
<script>
		function ChekME(div){
		 
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
<?php } ?>
