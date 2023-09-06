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
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
$randomID = uniqid();
$shown = 0;
$currentKey = 0;
 
if($userdata->ID){
	$mymem 		= $CORE->USER("get_user_membership", $userdata->ID);
	if(isset($mymem['date_expires'])){			
		$memExpires = $CORE->date_timediff($mymem['date_expires'],'');			
		if(isset($mymem["key"])){
			$currentKey = $mymem["key"];
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// DONT SHOW SUBSCRIBED PACKAGES
$dontshowkey = "";
		if($userdata->ID ){							 
				$cm			= get_user_meta($userdata->ID,'ppt_subscription'); 		 
				if(is_array($cm) && isset($cm[0]) && _ppt($cm[0]['key'].'_repurchase') == "0" && !is_admin() ){					 
					$dontshowkey = $cm[0]['key'];
				}	
		}
	  
$pricing_data = array();
foreach(  $CORE->USER("get_memberships", array() ) as $k => $n){  
	
	
	// PACKAGE
	$button = $CORE->USER("get_membership_continue_button", $n['key'] );
	if($dontshowkey == $n['key'] || $dontshowkey == "mem".$n['key']){					
	$button = "existing";
	}
	
	$pricing_data[] = array(
 
	'id' 		=> $n['key'], 	
	'title' 	=> $CORE->GEO("translate_mem_name", array( stripslashes(_ppt('mem'.$n['key'].'_name')), $n['key'])  ),
	'desc' 		=> $CORE->GEO("translate_mem_desc", array( stripslashes(_ppt('mem'.$n['key'].'_desc') ), $n['key']) ),
 	'duration_text'	=> $n['duration_text'],
	'price' 	=> $n['price'],
'price_text' => $n['price_text'],
	'recurring' => _ppt('mem'.$n['key'].'_r'),						
	'features' 	=> $CORE->PACKAGE("get_features_array", array($n['key'], "mem") ),						
	'active' 	=> "",
	'button' 	=> $button,
	); 
		
}
/*
?>
<textarea style="height:200px; width:100%;">
<?php print_r($pricing_data); ?>
</textarea>
<?php
*/
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<?php if(!isset($GLOBALS['flag-pricingtable'])){ ?>

<div class="<?php if(isset($_POST['action'])){ ?>p-md-4<?php } ?>" <?php if(isset($_POST['action'])){ ?>style="max-height:600px; overflow:hidden; overflow-y:visible"<?php } ?>>

  <div class="">


    <div class="clearfix mb-3">
    
  	<?php if(!$userdata->ID || ( _ppt(array('mem','register'))  == '1'  && $currentKey == 0 ) ){  ?>
    
     <h2 class="text-600 mb-3">  <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode float-right" style="font-size: 40px;">&#x1F600;</span><?php } ?> <?php echo __( 'Membership Required', 'premiumpress' ); ?></h2>
    
     <p><?php echo __( 'Please select a membership plan to continue.', 'premiumpress' ); ?></p>
    
    <?php }else{ ?>
     
     <h2 class="text-600 mb-3"> <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?><span class="smilecode float-right" style="font-size: 40px;">&#x1F600;</span><?php } ?> <?php echo __( 'Upgrade Now', 'premiumpress' ); ?></h2>
     
     <p><?php echo __( 'Upgrade your account now to access more features.', 'premiumpress' ); ?></p>
    
     <?php } ?>
      
      
    </div>
    
<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 


<div class="row hide-mobile">
      <?php  foreach($pricing_data as $n){  ?>
      <div class="col-lg-4 mb-4">
        <div class="card card-pricing-membership shadow-sm mb-3">
              
          <?php if($n['button'] == "existing"){ ?>
          <a class="text-dark text-decoration-none" href="#">
          <?php }else{ ?>
          <a class="text-dark text-decoration-none" <?php echo $n['button']; ?>>
          <?php } ?>
          
          
          <div class="card-body text-center position-relative">
       
       <?php if(strlen($n['duration_text']) > 1){ ?>
       <div class="bg-primary memtxt position-absolute small text-600 btn btn-sm btn-rounded-25 text-light" style="top:-10px; right:10px;">
                  <?php echo $n['duration_text']; ?>
                </div>
                <?php } ?>
           
              <div class="memprice">
                <span class="text-700 <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php if(!is_numeric($n['price']) || $n['price'] == "0"){ echo __("Free","premiumpress"); }else{  echo hook_price($n['price']); } ?></span>
              </div>
       
          </div>
          </a>
        </div>
        <div class="d-flex justify-content-between align-items-baseline">
          <div class="small opacity-8 text-500 ">
            <?php echo $n['title']; ?>
          </div>
          <div>
           <?php if($currentKey == $n['id'] ){ ?>
                <div class="badge badge-warning">  <?php echo __("Active","premiumpress"); ?>  </div> <?php }elseif($n['recurring']){ ?><div class="small badge badge-light text-600"><?php echo __("Recurring","premiumpress"); ?> </div><?php  } ?>
          </div>
        </div>
      </div>
      <?php } ?>
</div>
 
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!empty($pricing_data)){
	global $settings;
	$settings['pricing_data'] = $pricing_data;	
	_ppt_template( 'framework/design/pricing/pricing_mobile' );

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($currentKey != 0 && $memExpires['expired'] == 0 ){
 
?>
<div class="card p-3">

<?php if( isset($mymem['user_approved']) && $mymem['user_approved'] == "0"){ ?>

<div>
<?php echo __("Your membership upgrade is pending admin approval. As soon as it has been approved your account will be upgraded.","premiumpress"); ?>
</div>

<?php }else{ ?>
<div>&#x1F55B; <?php echo __("Active until:","premiumpress"); ?> <span class="text-600"><?php echo hook_date($memExpires['end']); ?></span> </div>

<?php } ?>

</div>
<a href="javascript:void(0);" class="btn btn-system float-right btn-sm" style="display:none;" onclick="ajax_cancel_membership();"><?php echo __("Cancel My Membership","premiumpress"); ?></a>
<script>
   function ajax_cancel_membership(){
   
   if (window.confirm("<?php echo __("Are you sure? This action cannot be undone.","premiumpress"); ?>")) {
          
		
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "cancel_membership",
   			uid: "<?php echo $userdata->ID; ?>",
   			
           },
           success: function(response) {
   			
   			  location.href = "<?php echo _ppt(array('links','myaccount')); ?>";        
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
   }
   }
</script>
<?php
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($currentKey != 0 && $memExpires['expired'] == 0 && $CORE->USER("membership_hasaccess", "listings") && _ppt(array('lst','websitepackages')) == "1" ){

$included = _ppt('mem'.$mymem['key'].'_listings_count');
$left = $CORE->USER("get_user_free_membership_addon", array("listings", $userdata->ID));

?>
<div class="card p-3 mt-2">

&#x1F920; <?php echo str_replace("%d", $left, str_replace("%s", $included, __("This plan includes %s free listings. You have %d left.","premiumpress"))); ?>

</div> 

<?php 

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 

if($currentKey != 0 && $memExpires['expired'] == 0 && $CORE->USER("membership_featured_enabled", "max_msg") ){

$included = _ppt('mem'.$mymem['key'].'_max_msg_count');
$left = $CORE->USER("get_user_free_membership_addon", array("max_msg", $userdata->ID));

?>
<div class="card p-3 mt-2">

&#x1F4E7; <?php echo str_replace("%d", $left, str_replace("%s", $included, __("This plan includes %s messages. You have %d left.","premiumpress"))); ?>

</div> 

<?php 

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!in_array(THEME_KEY,array("vt"))){ 
?>
    <div id="dislpay_features" style="display:none;">
      <div class="mt-4">
        <?php echo $CORE->USER("membership_features_list_full", array() ); ?>
      </div>
    </div>
 
    <a href="javascript:void(0);" class="text-decoration-none text-dark" onclick="jQuery('#dislpay_features').toggle();jQuery('#display_packages').toggle();">
    <div class="btn-light text-center text-600 p-3 mt-4">
      <?php echo __("Compare Features","premiumpress"); ?>
    </div>
    </a>
       <?php if(isset($_POST['action'])){ ?><?php } 

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($memExpires) && $memExpires['expired'] != 1 && in_array(_ppt(array('mem','paktime')), array("","1")) ){   ?>
     
    <div class="alert  text-center mt-4">
      &#x1F60A; <?php echo str_replace("%s", "<u class='font-weight-bold'>".$memExpires['days-left']."</u>", __("Buy a new membership today and get the %s days left on your old membership added completely free!","premiumpress")); ?>
    </div>
    
<?php 

} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



?>
<?php if(!isset($GLOBALS['flag-pricingtable'])){ ?>     
    
  </div>
</div>
<?php } ?>
