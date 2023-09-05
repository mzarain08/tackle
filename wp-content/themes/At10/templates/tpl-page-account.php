<?php
/*
	Template Name: [PAGE - MY ACCOUNT]
*/
   
global $userdata, $CORE, $CORE_UI; $CORE->Authorize();  $showDashboard = 1;




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$ev = _ppt(array("emails","user_verify")); 

$showPhotoVerify  = 0;
if(_ppt(array('register','photoverify'))  == '1'){
 	
	$showPhotoVerify  = 1;
  
	if(_ppt(array('photo_usertype', $GLOBALS['accounttype']['key'])) == "1" && $CORE->USER("get_verified_photo", $userdata->ID) == "0" ){
	 
		
	
	} else{
	
		update_user_meta($userdata->ID,'ppt_verified_photo',1); 
		$showPhotoVerify  = 0;
	}
}

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// PAYWALL 
 
if(_ppt(array('paywall','enable')) == "1" && _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'enable')) == "1" && _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'price')) > 0 && !$CORE->USER("paywall_active", $userdata->ID) ){

 
 	$showDashboard = 0;
	
	$GLOBALS['flag-paywall'] = 1;
   	_ppt_template( 'page', 'forms' );
	
 
// EMAIL
}elseif( isset($ev['enable']) && $ev['enable'] == 1 &&  _ppt(array('register','forcemailverify'))  == '1' && $CORE->USER("get_verified_email", $userdata->ID)  == "0"){
	
	$showDashboard = 0;
 
	$GLOBALS['flag-validate-email'] = 1;
   	_ppt_template( 'page', 'forms' );
	

// PHOTO
}elseif( $showPhotoVerify ){

	$showDashboard = 0; 
 
	$GLOBALS['flag-validate-photo'] = 1;
   	_ppt_template( 'page', 'forms' ); 
	

	

//SMS
}elseif( _ppt(array('sms','force'))  == '1' && $CORE->USER("get_sms_verified", $userdata->ID)  == "0"){

	$showDashboard = 0; 
 
	$GLOBALS['flag-validate-sms'] = 1;
   	_ppt_template( 'page', 'forms' );  

} 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// CHECK FOR INVALID OR EXPIRED MEMBERSHIP
if( _ppt(array('mem','register'))  == '1' && $showDashboard ==  1){

	$showUpgrades = false;

	$mem = $CORE->USER("get_user_membership", $userdata->ID);  
	
	if(is_array($mem)){
		$da = $CORE->date_timediff($mem['date_expires'],'');
		if($da['expired'] == 1){
		
		$showDashboard = false;
		$showUpgrades = true;
		 
		}
	}else{
		$showDashboard = false;
		$showUpgrades = true;
	}
	
	
	if($showUpgrades){

	// FORMS
	$GLOBALS['flag-memberships'] = 1;
   	_ppt_template( 'page', 'forms' ); 
	} 

}


if(isset($GLOBALS['accounttype']) && $GLOBALS['accounttype']['key'] == "banned"){
 
get_header();
_ppt_template( 'account/account-banned' );
get_footer(); 

}elseif($showDashboard){

get_header();
_ppt_template( 'account/account' );
get_footer(); 

}

?>