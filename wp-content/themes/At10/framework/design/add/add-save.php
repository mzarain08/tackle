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

$email = "";
$email = $CORE->USER("get_email", $userdata->ID);

$current_post_status = "pending";
 
$sm_data = array(
 
	"added" => array(
	
		"title" => __("Created","premiumpress"),
		"v" => "",
		"d" => __("Just Now","premiumpress"),
	),
	"modified" => array(
	
		"title" => __("Last Updated","premiumpress"),
		"v" => "",
		"d" =>  "-",
	),
	"expires" => array(
	
		"title" => __("Expiry Date","premiumpress"),
		"v" => "",
		"d" =>  __("Never","premiumpress"),
		"edit" => 1,
	),
	"hits" => array(
	
		"title" => __("Views","premiumpress"),
		"v" => "",
		"d" =>  0,
	),
	
	"status" => array(
	
		"title" => __("Status","premiumpress"),
		"v" => "",
		"d" =>  __("Pending Approval","premiumpress"),
		"edit" => 1,
	),
);

$cstatus = ""; 
if(isset($_GET['eid'])){

	$cstatus = $CORE->PACKAGE("get_status", $_GET['eid']);
	
	$sm_data['status']['v'] = $cstatus['name'];
	
	$sm_data['hits']['v'] 	= $CORE->PACKAGE("get_hits", array($_GET['eid'],"all"));
	
	$sm_data['added']['v'] = $CORE->PACKAGE("get_post_date", $_GET['eid']);
	$sm_data['modified']['v'] = $CORE->PACKAGE("get_post_modified_date", $_GET['eid']); 
	
	$sm_data['expires']['v'] = get_post_meta($_GET['eid'] ,'listing_expiry_date', true);
	
	$current_post_status = $cstatus['key'];
	
}else{

	unset($sm_data['modified']);

}
   
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
   
 
if(!$userdata->ID){
?>

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("New Account","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<div class="my-4">

<label><?php echo __("Create a username for your account.","premiumpress"); ?> <span class="text-danger">*</span> 

<div class="badge_tooltip" data-direction="top" style="display:inline-block">
	<div class="badge_tooltip__initiator"> 
   <i class="fal fa-info-circle" style="color:#000000"></i>
   </div>
    <div class="badge_tooltip__item" style="width:300px;">
     <?php echo __("Your unique account name. Must be 3 to 10 characters and can include lowercase letters, numbers, and hyphens. Choose wisely - this can only be changed once after signup.","premiumpress"); ?>
     </div>
</div>

</label>

<div class="usernamevalid" data-valid="" /></div>

<div class="position-relative"> 
<input type="text" name="myusername" class="form-control big val-nospaces" value=""  data-key="username" maxlength="10" />
 
</div>

<div id="ajax-username"></div> 
 

</div>


<div class="row">

<div class="col-md-6 mobile-mb-2">
<label><?php echo __("Password","premiumpress"); ?> <span class="text-danger">*</span> </label>
<input type="text" name="mypass" class="form-control big val-nospaces" data-key="mypass" value="" maxlength="20" />
 

</div>

<div class="col-md-6 mobile-mb-2">

<label><?php echo __("Repeat Password","premiumpress"); ?> <span class="text-danger">*</span> </label>
<input type="text" name="mypass1" class="form-control big val-nospaces" data-key="mypass1" value="" maxlength="20" />
 

</div>

</div>
 

<label><?php echo __("Which email can we contact you on?","premiumpress"); ?> <span class="text-danger">*</span> </label>

<div class="position-relative"> 

<input type="text" name="myemail" class="form-control big myemail mb-2" value="" maxlength="150" />
 
</div>
 

<?php

}
 
 
// UPGRADES
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if( !in_array(THEME_KEY,array("sp")) && !empty($CORE->PACKAGE("get_packages_addons", array())) ){
 
?>
<script>
function ChekME(div){
	if (jQuery(div+'check').is(':checked')) {			
		jQuery(div+'add').val(1);			
	}else{			
		jQuery(div+'add').val(0);
	}
	
	updateTotal();
	
}
</script>

<div class="block-header mt-4" id="upgradestitle">
<h3 class="block-header__title"><?php echo __("Upgrades","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<?php

$shownUpgrades = 0;
$addons = $CORE->PACKAGE("get_packages_addons", array() );
if(!empty($addons )){

	// CHECK NOT HIDDEN
	$canShow = false;
	foreach($addons as $a){ 
	
		if( _ppt(array('lst', $a['key'].'_enable')) == '1' || is_admin() ){ $canShow = true; }
	
	}
	if($canShow){
	
		foreach($addons as $a){  if( _ppt(array('lst', $a['key'].'_enable')) != '1'  && !is_admin()){ continue; } 
		 
		if($a['key'] == "addon_boost"){ continue; }
		
		if(_ppt(array('lst','addon_sponsored_enable')) != "1" && $a['key'] == "addon_sponsored"){ continue; }
		
		if(_ppt(array('lst','addon_featured_enable')) != "1" && $a['key'] == "addon_featured"){ continue; }		
		
		$days =  _ppt(array('lst', $a['key'].'_days'));		
		
		$active = 0;
		$addon_expirydate = "";
		if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ 
			
			$active = 1;
		
		 	$expirydate = get_post_meta($_GET['eid'], str_replace("addon_","",$a['key'])."_expires", true);
			if($expirydate != "" && $expirydate > 0 ){ 
				$addon_expirydate = $expirydate;
			}
		
		} 
		
		$shownUpgrades++;
	 
	?>
	
<div class="py-3 border-bottom p-3 mb-4 rounded-lg shadow-sm border">

    <div class="d-flex justify-content-between">
    
    <div>
        <div class="d-flex">
        
        <div> 
       
            
        <label class="custom-control custom-checkbox exta1a">
        <input type="checkbox" value="1" class="custom-control-input" id="<?php echo $a['key']; ?>check" 
	
        <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ echo "checked=checked"; } ?>
        
		 onclick="ChekME('#<?php echo $a['key']; ?>');" <?php if($active && $current_post_status != "payment"){ ?>disabled<?php } ?>> 
        
        
        <input <?php if(!$active){ ?>data-amount="<?php echo _ppt(array('lst', $a['key'].'_price')); ?>"<?php } ?> 
        type="hidden" name="<?php echo $a['key']; ?>" 
        id="<?php echo $a['key']; ?>add" 
        value="<?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], str_replace("addon_","",$a['key']), true) == 1){ echo 1; }else{ echo 0; } ?>" 
        class="form-control"> 
        
        <span class="custom-control-label">&nbsp;</span> </label>
         
         
        </div>
        <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  ?>
        <div style="font-size: 30px; margin: -5px 20px;" class="hide-mobile"><?php echo $a['smilecode']; ?></div>
        <?php } ?>
        <div class="ml-3">
        
        <div class="text-600"><?php echo $a['name']; ?></div> 
         
        </div>
        
        </div>
    </div>
    
    <?php if( !$active ){ ?>
    
        <div class="text-700 h4">
        
          <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(_ppt(array('lst', $a['key'].'_price'))); ?></span>
       
       
       <?php if($days > 0){ ?>
        <div class="badge_tooltip text-center float-right ml-3" data-direction="top">
                <div class="badge_tooltip__initiator"> <i class="fal fa-clock"></i></div>
                <div class="badge_tooltip__item"> <?php echo str_replace("%s", $days, __("This addon will remain active for %s days.","premiumpress")); ?></div>
       </div>
        <?php } ?>
        
        
     </div> 
    
    <?php }elseif( $active ){ ?>
    
    <div class="text-700 h4">
        
		<?php if(strlen($addon_expirydate) > 1){ ?> 
            
           <div class="badge_tooltip text-center float-right ml-3" data-direction="top">
            <div class="badge_tooltip__initiator">  <i class="fal fa-clock"></i> </div>
            <div class="badge_tooltip__item"> <?php echo __("This addon will remain active until.","premiumpress"); ?><hr />  <?php echo $addon_expirydate; ?>  </div>
          </div>
         <?php } ?>
             
         <span class="badge badge-primary"> <?php echo __("Active","premiumpress"); ?> </span>
     
    </div> 
     
	<?php } ?>
    
</div> 


<div class="opacity-5 pak-desc"><?php echo $a['desc']; ?></div>
        


</div>

<?php if($active){
 $addon_expirydate = ""; 
 
 
 if(isset($_GET['eid'])){ 
 	$addon_expirydate = get_post_meta($_GET['eid'], str_replace("addon_","",$a['key'])."_expires", true);  
 }		 
?>
<div class="mb-3 small" <?php if(!is_admin() && $addon_expirydate == ""){ ?>style="disply:none;"<?php } ?>>
<span class="text-600"><?php echo __("Active until","premiumpress"); ?>:</span> 

<?php if($addon_expirydate == ""){ echo __("Forever - No date set.","premiumpress"); }else{ echo hook_date($addon_expirydate); } ?> 

    
    <?php if(is_admin()){ ?>
    
    <i class="fa fa-pencil ml-3" onclick="jQuery('#<?php echo $a['key']; ?>-editme').toggle();" style="cursor:pointer;"></i>
	
 
    <div id="<?php echo $a['key']; ?>-editme" style="display:none;">
    
<div class="input-group form-group position-relative date my-3 ppt-datepicker" data-target="#<?php echo $a['key']; ?>_expires-date" id="<?php echo $a['key']; ?>_expires-date">
  <input type="text" name="custom[<?php echo str_replace("addon_","",$a['key']); ?>_expires]"  id="<?php echo $a['key']; ?>_expires" tabindex="" value="<?php echo $addon_expirydate;  ?>" class="form-control">
  <span class="input-group-addon" style="z-index: 100;"> 
  
  <span class="fal fa-calendar" style="top:22px;z-index: 100;right: 10px;position: absolute; top: 10px;"></span> </span>
   
   </div>
<div class="mt-n2">
   
<a href="javascript:void(0);" class="small" onclick="jQuery('#<?php echo $a['key']; ?>_expires').val('<?php echo date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . "+1 minute")); ?>');">Time Now + 1 minute</a>
</div>
    
    </div>
    <?php } ?>

</div>
<?php
 
	
	} 
	
		}
	
	}
}

if($shownUpgrades == 0){
?>
<script> 
jQuery(document).ready(function(){ 
	jQuery("#upgradestitle").hide();
});
</script>
<?php
}
}

// plans
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('lst','websitepackages')) == '1'  && THEME_KEY != "sp" && !empty($CORE->PACKAGE("get_packages", array())) && in_array(_ppt(array('lst','displaypricing')),array("","1")) ){
 

// PACKAGE ID
$selectedID = -1;
if(isset($_GET['eid'])){ $selectedID = get_post_meta($_GET['eid'],'packageID', true);  } 
if(!is_numeric($selectedID)){ $selectedID = -1; }
if(!isset($_GET['eid']) && isset($_GET['packageid']) && is_numeric($_GET['packageid'])){
$selectedID = $_GET['packageid'];
$triggerTotalRecal = 1;
}
  
 
?>
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Plan","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<?php

$paks =  $CORE->PACKAGE("get_packages", array() );

// BUILD
if(is_admin()){		
	$paks["-1"] = array(					
		"key" 		=> "-1",
		"name" 		=> __("No Plan","premiumpress"),
		"desc" 		=> __("No package set by this user.","premiumpress"),
		"price" 	=> 0,
		"price_text" => 0,
		"duration" 	=> 0,	
		"recurring" => 0,											
	);
}
$paks = array_values($paks);

$i=1;
foreach(  $paks as $k => $n){ 

 
 
$active = 0;
if($selectedID == $n['key'] && !isset($_GET['packageid'])){
	
	if(is_array($cstatus) && isset($cstatus['key']) && $cstatus['key'] == "payment"){
	
	}else{
	
	$active = 1;
	$addon_expirydate = "";	
	if(isset($_GET['eid']) &&  get_post_meta($_GET['eid'] ,'listing_expiry_date', true) != ""){
		$expirydate = get_post_meta($_GET['eid'] ,'listing_expiry_date', true);
		$addon_expirydate = $expirydate;
	}
	
	}	 

}

// DEFAULT SELECTION
if($i ==1 && (!is_admin() && $selectedID == "-1") ){
	$selectedID = $n['key'];
	$triggerTotalRecal = 1;
}


$icons = array("","&#x1F31D;","&#x2B50;","&#x1F31E;","&#x1F31F;","&#x1F320;",); 

?>

<div class="py-3 border-bottom p-3 mb-4 rounded-lg shadow-sm border">

    <div class="d-flex justify-content-between">
    
    <div>
        <div class="d-flex">
        
        <div> 
       
            
<div>
<input type="radio" name="nosdadasdaadasdas" <?php if(!$active && $n['price'] > 0){ ?>data-amount="<?php echo $n['price']; ?>"<?php }else{ ?>data-amount="0"<?php } ?> onclick="updatePackageID('<?php echo $n['key']; ?>')" value="xxxxxxxxxx" <?php if($selectedID == $n['key']){ echo "checked=checked"; } ?> />
</div> 
        
        </div>
        
        <div style="font-size: 30px; margin: -5px 20px;" class="hide-mobile"><?php if(isset($icons[$i])){ echo $icons[$i]; } ?></div>
        
        <div class="ml-3">
        
        <div class="text-600"><?php echo $CORE->GEO("translate_pak_name", array( stripslashes($n['name']), $n['key'])  ); ?>   </div>  
        </div>
        
        </div>
    </div>
    
    <?php if( !$active ){ ?>
    
    <div class="text-700 h4">
    
    
    <?php if($n['price'] == "0"){ ?>
               <?php echo __("Free","premiumpress"); ?>
     <?php }else{ ?>
             <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"> <?php echo $n['price']; ?></span>
     <?php } ?> 
     
     
     <?php if($n['duration'] > 0){ ?>
       <div class="badge_tooltip text-center float-right ml-3" data-direction="top">
            <div class="badge_tooltip__initiator"> <i class="fal fa-clock"></i></div>
            <div class="badge_tooltip__item"> <?php echo str_replace("%s", $n['duration'] ,__("This ad will remain active for %s days.","premiumpress")); ?></div>
       </div> 
     <?php } ?>
     
      </div>
  
    
    <?php }elseif( $active ){ ?>
    
    <div class="text-700 h4">
        
		  <?php if(strlen($addon_expirydate) > 1 && $n['duration'] > 0 ){ ?>  
           <div class="badge_tooltip text-center float-right ml-3" data-direction="top">
            <div class="badge_tooltip__initiator">   <i class="fal fa-clock"></i></div>
            <div class="badge_tooltip__item"> <?php echo __("This ad will remain active until.","premiumpress"); ?><hr />  <?php echo $addon_expirydate; ?>  </div>
          </div>
         <?php } ?>
             
         <span class="badge badge-primary"> <?php echo __("Active","premiumpress"); ?> </span>
     
    </div> 
     
	<?php } ?>
    
</div> 


        <div class="opacity-5 pak-desc2"><?php echo $CORE->GEO("translate_pak_desc", array( stripslashes($n['desc']), $n['key'])  ); ?> </div>
        


</div>

<?php $i++; } ?>

 
<input type="hidden" class="form-control" name="packageID" id="packageID" value="<?php echo $selectedID; ?>" />

<script>
function updatePackageID(id){
jQuery("#packageID").val(id);
updateTotal()
}

<?php if(isset($triggerTotalRecal)){ ?>
jQuery(document).ready(function(){ 
setTimeout(function(){ updateTotal(); }, 2000);
});
<?php } ?>

</script>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
 
if($userdata->ID){ 
?>
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Summary","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>
 

<div class="row mt-4">
<div class="col-md-4">
 

</div>
<div class="col-md-8">
<div class="p-4 bg-light rounded summarybox">
 
 
<?php foreach($sm_data as $k => $v){ ?>

<div class="row no-gutters">
    <div class="col-6">
    <span class="text-600"><?php echo $v['title']; ?></span>
    </div>
    <div class="col-6">
    
    <?php if(is_admin() && isset($v['edit'])){ ?>
    <i class="fa fa-pencil float-right" onclick="jQuery('#<?php echo $k; ?>-editme').toggle();" style="cursor:pointer;"></i>
    <?php } ?>
    <span class="sumkey-<?php echo $k; ?>"><?php if($v['v'] == ""){ echo $v['d']; }else{ echo $v['v']; }  ?>&nbsp;</span>
    </div>
</div>
<?php if(is_admin() && isset($v['edit'])){ ?>
<div id="<?php echo $k; ?>-editme" style="display:none;">

<?php 

	switch($k){

		case "status": {
		
		 
		$selected = "";
		if(is_array($cstatus) && isset($cstatus['key'])){
		$selected = $cstatus['key'];
		}
	 
		
		 ?>
         
    <select class="form-control mb-2" name="form[post_status]" id="poststt">
    
      <?php $i=1;   foreach($CORE->PACKAGE("get_status", array() ) as $cat){   ?>
      
      <option value="<?php echo $cat['key']; ?>"<?php if($selected == $cat['key']){ echo "selected=selected"; } ?> > <?php echo $cat['name']; ?></option>
      
      <?php $i++; } ?>
      
    </select>
<?php
		
		} break; 
		
	case "expires": { ?>

    
<div class="input-group form-group position-relative date mb-3 ppt-datepicker" data-target="#expiry-date" id="expiry-date">
  <input type="text" name="custom[listing_expiry_date]"  id="listing_expiry_date" tabindex="" value="<?php if( isset($_GET['eid']) ){ echo get_post_meta($_GET['eid'] ,'listing_expiry_date', true);  }  ?>" class="form-control">
  <span class="input-group-addon" style="z-index: 100;"> 
  
  <span class="fal fa-calendar" style="top:22px;z-index: 100;right: 10px;position: absolute; top: 10px;"></span> </span>
   
   </div>
<div class="mt-n2">
   
<a href="javascript:void(0);" class="small" onclick="jQuery('#listing_expiry_date').val('<?php echo date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . "+1 minute")); ?>');">Time Now + 1 minute</a>
</div>

    <?php } break;
		
		
		
	} 
?>

</div>
<?php }

} 
?>
</div>
</div>
</div>

<?php
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!is_admin() &&  _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>

<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Are you real?","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<div class="g-recaptcha my-3" data-sitekey="<?php echo _ppt(array('captcha','sitekey')); ?>" ></div>
 
<?php }
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>