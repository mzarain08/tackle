<?php

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $CORE_UI, $userdata;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// USER DATA
//$desc 		= get_the_author_meta( 'description', $userdata->ID);
$photo 			= $CORE->USER("get_avatar",$userdata->ID);
//$url 			= get_user_meta($userdata->ID,'url',true); 
$username 		= $CORE->USER("get_username",$userdata->ID); 

//$total_notify 	= $CORE->USER("count_get_logs", $userdata->ID); 
$country 		= $CORE->USER("get_country", $userdata->ID);
if($country == ""){ $country = "-"; }

$defaultimg = DEMO_IMGS."?accountimg=1&t=".THEME_KEY;

if(_ppt('account_bgimg') != ""){
$defaultimg = _ppt('account_bgimg');
}

// WECLOME MESSAGE
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$defaulttxt = '<div class="fs-5 text-600 mb-2">'.__("Hello &amp; Welcome","premiumpress").'</div>'.__("A big virtual hug and welcome to our website. If you have any questions or feedback get in touch anytime and we'll be happy to help.","premiumpress");

if(strlen(_ppt('account_welcometxt')) > 1){
$defaulttxt = _ppt('account_welcometxt');
}

if($GLOBALS['accounttype']['count_login'] > 5){

$defaulttxt = '<div class="fs-5 text-600 mb-2">'.__("Welcome back!","premiumpress").'</div>'.__("We are constantly updating and improving our service. If you have any questions or feedback get in touch - we would love to hear them.","premiumpress");

if(strlen(_ppt('account_defaulttxt')) > 1){
$defaulttxt = _ppt('account_defaulttxt');
}

}

$adminNotice = get_user_meta($userdata->ID,'ppt_customtext', true);
if(strlen($adminNotice) > 2){
$defaulttxt = $adminNotice;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$showImg = 1;
if(_ppt(array("user","accountimg")) == "0"){
$showImg = 0;
} 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$boxData = array(

	1 => array(
	
		"icon" => "user-circle",
		"link" => _ppt(array('links','myaccount'))."/?tab=details&sub=username",
		"title" => __("My Username","premiumpress"),
		"desc" => $username,
	),
	
	2 => array(
	
		"icon" => "map-marker",
		"link" => _ppt(array('links','myaccount'))."/?tab=details&sub=address",
		"title" => __("My Location","premiumpress"),
		"desc" => $country,
	),
	
	3 => array(
	
		"icon" => "email",
		"link" => _ppt(array('links','myaccount'))."/?tab=details&sub=contact",
		"title" => __("My Email","premiumpress"),
		"desc" => $CORE->USER("get_email",$userdata->ID),
	),	

);


?>
 
 
 
 
 
<div class="fs-lg text-600 mb-2 hide-mobile"><?php echo __("Welcome Back","premiumpress"); ?></div> 
 
<p class="mb-4 hide-mobile"><?php echo __("Here's an overview of your account.","premiumpress"); ?></p> 
 
<div ppt-border1="" class="p-3 p-md-4  hide-mobile mt-2 mb-5">
	
   
<div class="d-md-flex justift-content-between">


    <div class="d-md-flex border-right pr-3 w-100 mr-3 ">
        <div ppt-icon-size="32" class="mr-3 hide-ipad show-desktop-lg"><?php echo $CORE_UI->icons_svg[$boxData[1]['icon']]; ?></div>
         <a href="<?php echo $boxData[1]['link']; ?>" class="text-black text-decoration-none">
        <span>       
            <div class="text-600"><?php echo $boxData[1]['title']; ?></div>
            <div class="small opacity-8" style="max-width:150px;"><?php echo $boxData[1]['desc']; ?></div>
        </span>
        </a>
    </div>


    <div class="d-md-flex border-right pr-3 w-100 mr-3 ">
        <div ppt-icon-size="32" class="mr-3 hide-ipad show-desktop-lg"><?php echo $CORE_UI->icons_svg[$boxData[2]['icon']]; ?></div>
        <a href="<?php echo $boxData[2]['link']; ?>" class="text-black text-decoration-none">
        <span>
            <div class="text-600"><?php echo $boxData[2]['title']; ?></div>
            <div class="small opacity-8" style="max-width:150px;"><?php echo $boxData[2]['desc']; ?></div>
        </span>
        </a>
    </div>
    
    <div class="d-md-flex w-100">
        <div ppt-icon-size="32" class="mr-3 hide-ipad show-desktop-lg"><?php echo $CORE_UI->icons_svg[$boxData[3]['icon']]; ?></div>
        <a href="<?php echo $boxData[3]['link']; ?>" class="text-black text-decoration-none">
        <span>
            <div class="text-600"><?php echo $boxData[3]['title']; ?></div>
            <div class="small opacity-8 text-truncate" style="max-width:150px;"><?php echo $boxData[3]['desc']; ?></div>
        </span>
        </a>
    </div>
</div>

</div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

<div class="bg-light p-3 p-md-5 rounded-lg mb-4 position-relative mt-xl-n3" >


<div class="row">
<div class="<?php if($showImg){ ?>col-md-6<?php }else{ ?>col-12<?php }?>">

<div class="lh-30">
<?php echo $defaulttxt; ?>
</div>

<?php if(_ppt(array("user","contactus")) != "0"){ ?>
<div class="mt-3 fs-sm contactuslink"><a href="<?php echo _ppt(array('links','contact')); ?>" class="btn-xs btn-system" data-ppt-btn><?php echo __("Contact us","premiumpress"); ?></a></div>
<?php } ?>

</div>
<?php if($showImg){ ?>
<div class="col-md-6">
<div class="my-4 my-md-0">

<div class="position-relative">
<img src="<?php echo $defaultimg; ?>" class="img-fluid rounded-lg" alt="img" />
<?php
if(function_exists('current_user_can') && current_user_can('administrator') ){
?>
<span style="position:absolute;top:10px; right:10px;">
<a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=usersettings&lefttab=ap"class="single-page-edit-button single-page-edit-button-bg">
<i class="fa fa-pencil text-white"></i>
<span class="ripple single-page-edit-button-bg"></span>
<span class="ripple single-page-edit-button-bg"></span>
<span class="ripple single-page-edit-button-bg"></span>
</a>
</span>

<?php } ?>

</div>

</div>
</div>
<?php } ?>

</div>



</div>



<?php

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
 

<div class="text-600"><?php echo __("Recent Notices","premiumpress"); ?></div>

<?php _ppt_template( 'ajax/ajax-modal-notify' ); ?>
</div>
<?php } ?> 

