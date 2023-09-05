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

$key = "featured";
if(isset($GLOBALS['addon-key'])){
$key = $GLOBALS['addon-key'];
}
 
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


$addons = $CORE->PACKAGE("get_packages_addons", array() );

 
$amount = _ppt(array('lst','addon_'.$key.'_price'));
if(!is_numeric($amount)){
$amount = 10;
}
$rannum = rand();
$postID = 0;

if(isset($_POST['pid']) && is_numeric($_POST['pid'])){
$postID = $_POST['pid'];
}

if($userdata->ID){
?> 
<input type="hidden" id="upgrade_featured<?php echo $rannum; ?>" value="<?php  
   
   
   echo $CORE->order_encode(array(   
   	"uid" 			=> $userdata->ID, 
   	"amount" 		=> $amount,     	
   	"order_id" 		=> "UPGRADE-".$postID."-".$key,   	 
   	"description" 	=> $addons[$key ]['pay_text'],   	
   	"recurring" 	=> 0,   	
   	"couponcode" 	=> 0,   	
	"hidecouponbox" => 1, 							
   ) ); 
    		
   ?>" />
<?php } ?>

</div></div> 


<div class="card-body pop-animate fadeIn delay-200 text-center col-lg-10 mx-auto mb-4">

<p class="lead text-600"><?php echo $addons[$key]['title']; ?></p>

<p><?php echo $addons[$key]['desc']; ?></p>          
          
<a href="javascript:void(0)" onclick="<?php if(!$userdata->ID){ ?>processLogin();<?php }else{ ?>processNewPayment('#upgrade_featured<?php echo $rannum; ?>');<?php } ?>" class="btn-lg btn-system shadow-sm" data-ppt-btn><?php echo $addons[$key]['smilecode']; ?> <?php echo $addons[$key]['btn_txt']; ?></a>

</div>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>