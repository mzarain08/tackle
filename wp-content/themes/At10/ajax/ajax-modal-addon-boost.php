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

$size = "large";
if(isset($GLOBALS['ajax-size'])){
$size = $GLOBALS['ajax-size'];
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="card-popup <?php echo $size; ?>">
<div class="bg-primary pt-3">    
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div class="card-popup-content">      
<div class="pop-icons-line pt-4">
<?php
$images = array(); $i = 1;
foreach( $CORE->PACKAGE("get_random_listings", 4) as $ik => $im){
	
	
	if(strlen($im['src']) > 1){
	if($i > 3){ continue; }
	?>
    <a href="<?php echo $im['link']; ?>">
     <div class="pop-icon pop-animate popIn <?php if($i == 2){ ?>delay-500 middle<?php }else{ ?>delay-300 side<?php } ?>">
            <div class="bg-image" style="background-image:url('<?php echo $im['src']; ?>');">
            </div>
      </div>
    </a> 
    <?php
	$i++;
	}
}
?>
</div>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$boostData = get_user_meta($userdata->ID, 'upgrade_boost', true);
$BoostTxt = "";
$BoostValue = 0; 
$BoostLive = 0;
$BoostEnds = "";
if(is_array($boostData) && !empty($boostData)){
 
	$BoostEnds 	= $boostData['end'];
	$BoostStart = $boostData['start'];	 
	
	$hh = $CORE->date_timediff($BoostEnds,$BoostStart);
 
	if($hh['expired'] == 0){
		$BoostTxt 	= __("Active","premiumpress");
		$BoostLive = 1;
		$BoostValue = $hh['percentage-left']/100; 
	}  

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$amount = _ppt(array('lst','addon_boost_price'));
if(!is_numeric($amount)){
$amount = 10;
}


if($userdata->ID){
?>
<input type="hidden" id="boostme" value="<?php  
 
   echo $CORE->order_encode(array(   
   	"uid" 			=> $userdata->ID, 
   	"amount" 		=> $amount,     	
   	"order_id" 		=> "BOOST-".$userdata->ID."-".rand(2,10000),   	 
   	"description" 	=> __("Boost Upgrade","premiumpress"),   	
   	"recurring" 	=> 0,   	
   	"couponcode" 	=> 0,   	
	"hidecouponbox" => 1, 							
   ) ); 
    		
?>" />
<?php } ?>
      
</div>
<div class="card-body pop-animate fadeIn delay-200 text-center col-lg-10 mx-auto mb-4">

<p class="text-600"><?php echo __("Get seen by more people!","premiumpress"); ?></p>

<p><?php echo __("Appear at the top of all search results for 24 hours.","premiumpress"); ?></p>
          
          

<?php if($BoostLive){ ?>

<a href="javascript:void(0)" class="btn-lg btn-system shadow-sm" data-ppt-btn>&#x1F680; 
<span style="display:inline-block;" class="text-600" data-pre-layout="boost" data-ppt-countdown="<?php echo $BoostEnds; ?>" data-timezone="<?php echo get_option('gmt_offset'); ?>"></span>
</a>


<div class="border rounded p-2 small mt-3 text-600">
	<?php echo __("Active until","premiumpress"); ?> <?php echo hook_date($BoostEnds); ?>
</div> 
<?php }else{ ?>    

<a href="javascript:void(0)" onclick="<?php if(!$userdata->ID){ ?>processLogin();<?php }else{ ?>processNewPayment('#boostme');<?php } ?>" class="btn-lg btn-system shadow-sm" data-ppt-btn>&#x1F680; <?php echo __("Get Boosted!","premiumpress"); ?></a>


<?php } ?>
</div>
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>