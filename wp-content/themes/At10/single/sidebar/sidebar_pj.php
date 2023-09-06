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

global $CORE, $userdata, $post;
 
 

 /*

$expiryDate = get_post_meta($post->ID, "listing_expiry_date", true);

$price = get_post_meta($post->ID, "price", true);

if(get_post_meta($post->ID, "status", true) == "1"){ ?>
     
<div class="text-center">
     
     <div class="alert alert-success text-600"><?php echo __("Offer Accepted","premiumpress"); ?></div>  
     
</div>
     
<?php }else{  ?>


<div class="d-flex align-items-baseline mb-3 ">

<div class="_price data-fields-single _style1 lg buybox-price-num text-center text-md-left topbidprice  <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php if(is_admin()){echo "50"; }else{ echo $price; } ?></div>

<?php if($expiryDate != "" && strlen($expiryDate)  > 1){?> 
<div class="ml-3 opacity-8">

<div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"> 

<div class="d-flex">
<i class="fal fa-clock mr-1"></i> <div id="buybox-timer" data-ppt-countdown="<?php echo $expiryDate; ?>" data-timezone="<?php echo get_option('gmt_offset'); ?>"></div>
</div>
    </div>
    <div class="badge_tooltip__item text-center"><?php echo __("Time remaining before bidding ends.","premiumpress"); ?></div>
  </div>



</div>
<?php } ?>

</div>  


<?php
	
 
 
}*/
	
?>
  