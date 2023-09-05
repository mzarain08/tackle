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

global $CORE, $CORE_UI, $post;


if(isset($post->ID)){
$pid = $post->ID;
}else{
$pid = $_POST['pid'];
}
 
$url = get_post_meta($pid, "buy_link", true);

if($url == ""){

	$found 	= wp_get_object_terms( $pid, 'store' ); 
	if(is_array($found) && !empty($found)){
	 	
		if(  strlen(_ppt('storelinkaff_'.$found->term_id)) >  2){  
			$url = _ppt('storelinkaff_'.$found->term_id);		
		}elseif( strlen(_ppt('storelink_'.$found->term_id)) >  2){  
			$url = _ppt('storelink_'.$found->term_id); 
		} 
		 
	} 

}

if(substr($url,0,4) != "http"){
	$url = "https://".$url;
}

?>

<div class="p-md-3">


<div class="container">
 
    <div class="row align-items-center">
    
      <div class="col-lg-6 order-2 px-0">
      
        <div class="shadow-sm " ppt-border1>
          <div class="card-body p-md-4">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-success text-light"><span class="number"><i class="fa fa-check"></i></span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Activate Tracking","premiumpress") ?></div>
                
              </div>
            </div>
          </div>
  
        </div>
 
        <div class="shadow-sm  mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-light  text-light"><span class="number"><i class="fa fa-check"></i></span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Proof of Purchase","premiumpress") ?></div>
                <div class="opacity-5 fs-sm"><?php echo __("After you've purchased the item from the retailer, upload your proof of purchase via your members area.","premiumpress") ?></div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="shadow-sm  mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-light  text-light"><span class="number"><i class="fa fa-check"></i> </span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Wait for Confirmation","premiumpress") ?></div>
                <div class="opacity-5 fs-sm"><?php echo __("Once the retailer pays us the comission for your order we will credit it to your account as cashback.","premiumpress") ?></div>
              </div>
            </div>
          </div>
        </div>
    
      </div>
  
      <div class="col-lg-6  pr-lg-5 pe-lg-5">
      
      
<div class="text-600 fs-md mb-4 pt-5 pt-md-0"><?php echo __("Tracking Activated","premiumpress") ?></div>
 
<p class="lead mb-4"><?php echo __("You can monitor the progress of this cashback request via your members area.","premiumpress") ?></p>



<div class="mb-3">

<a href="<?php echo $url; ?>" class="btn-success btn-block btn-lg" target="_blank" rel="nofollow" data-ppt-btn><?php echo __("Visit Retailer","premiumpress") ?></a>


</div>

<div class="mb-4 mobile-mb-4" ppt-flex-between>
<button class="btn-close btn-system" data-ppt-btn><?php echo __("Close","premiumpress") ?></button>
<a href="<?php echo _ppt(array('links','myaccount')); ?>?tab=cashback" class="btn-system" data-ppt-btn><?php echo __("Members Area","premiumpress") ?></a>
</div>
   
      </div>
      </div>  
      
</div> 

</div>



<style>
.mt-6 {
    margin-top: 1.5rem!important;
} 
.number-box {
    width: 40px;
    height: 40px;
    font-size: 16px;
    display: inline-block;
    margin-right: 30px;
    border-radius: 100%;
    text-align: center;
    line-height: 40px;
    font-weight: 600;
}

</style>