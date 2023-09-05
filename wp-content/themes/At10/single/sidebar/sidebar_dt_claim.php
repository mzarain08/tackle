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

global $CORE, $post, $userdata;

// CHECK IF ALREADY CLAIMED

$claimedBefore = 0;
if($userdata->ID){

	$c = get_user_meta($userdata->ID, "claimed", true );
	if($c != ""){
	$claimedBefore = 1;
	}

}


 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
<div class="card-popup large m-n4">
<div class="bg-primary pt-3">    
<div class="card-popup-content">      
<div class="pop-icons-line pt-4">
<?php
$images = array(); $i = 1;

$files = $CORE->MEDIA("get_formatted_images_for_header", $post->ID);
 
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

<div class="stepbox row">
  <div class="col-4 stepbox-step step1 active">
    <div class="text-center stepbox-stepnum"><?php echo __("Register/Login","premiumpress"); ?></div>
    <div class="progress bg-success">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" onclick="ChangeSteps(1);" class="stepbox-dot bg-dark"></a> </div>
  <div class="col-4 stepbox-step step2">
    <div class="text-center stepbox-stepnum"><?php echo __("Claim Listing","premiumpress"); ?></div>
    <div class="progress">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
  <div class="col-4 stepbox-step step3">
    <div class="text-center stepbox-stepnum"> <?php echo __("Manage Listing","premiumpress"); ?> </div>
    <div class="progress">
      <div class="progress-bar"></div>
    </div>
    <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
</div>
<div id="makeofferbox" >
  <div class="col-md-12 m-auto ">
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="p-4 bg-light col-12">
        
<?php if($claimedBefore){ ?>

 <div style="line-height:30px;" class="text-danger text-600 text-center"> <?php echo __("You have already claimed a listing.","premiumpress"); ?> </div>

<?php }else{ ?>
        
        
<div class="block-header">
<h2 class="block-header__title"><?php echo __("How does it work?","premiumpress"); ?></h2>
<div class="block-header__divider"></div> 
</div>
          <p style="line-height:30px;" class="text-muted"> <?php echo __("If you work or own this business you can claim this listing and add it to your account.","premiumpress"); ?> </p>
          <p style="line-height:30px;" class="text-muted"> <?php echo __("Once claimed, you can update the business information, upload new photos and reply to customer questions.","premiumpress"); ?> </p>
          <?php if(!$userdata->ID){ ?>
          <div class="py-5 text-center"> <a href="<?php echo wp_login_url(); ?>/?redirect=<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-lg"><i class="fal fa-user-circle mr-2"></i> <?php echo __("Please register or login","premiumpress"); ?></a>
            <div class="mt-4 text-muted"><?php echo __("You need to login before you can claim this listing.","premiumpress"); ?></div>
          </div>
          <?php }else{ ?>
          <div class=" text-center"> <a href="javascript:void(0);" onclick="ajax_claimlisting();" class="btn btn-primary btn-lg"><i class="fal fa-check mr-2"></i> <?php echo __("Claim Now!","premiumpress"); ?></a> </div>
<script>

function ajax_claimlisting(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_claimlisting",
			pid: <?php echo $post->ID; ?>,			 
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
			   window.location = "<?php echo _ppt(array('links','myaccount')); ?>/?showtab=listings";
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure
							  
							  
</script>

<?php } ?>
<?php } ?>
          
        </div>
        
<?php if(!$claimedBefore){ ?>
 <p class="mt-4 ml-2 small float-left"><?php echo __("By clicking continue you agree to our website","premiumpress"); ?> <a href="<?php echo _ppt(array('links','terms')); ?>" style="text-decoration:underline;"><?php echo __("terms and conditions","premiumpress"); ?>.</a></p>
 
 <?php } ?>
        
        
        
      </div>
    </div>
  </div>
  <!-- end make offer box -->
</div>
