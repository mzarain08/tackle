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

 


if(in_array(_ppt(array('design','display_claim')), array("","1")) ){ ?> 
   
<?php if( user_can( $post->post_author, 'delete_posts' ) && get_post_meta($post->ID,"claimed", true) == "" ){ ?>
    
<div class="card my-4 rounded overflow-hidden" ppt-box>

<span class="featuredribbion bg-success"><?php echo __("Claim Me","premiumpress"); ?></span>
 
<div class="card-body">

<div class="text-600 fs-5 mb-2"><?php echo __("Work Here?","premiumpress") ?></div>

<p class="opacity-5"><?php echo __("Claim this page for your business.","premiumpress") ?></p>
 
<a href="javascript:void(0)" <?php if(!$userdata->ID){ ?>onclick="processLogin();" <?php }else{ ?>onclick="processClaimPop();jQuery('.extra-modal-item .card-footer').hide();"<?php } ?> class="btn-system shadow-0" data-ppt-btn><?php echo __("Learn More","premiumpress") ?></a>

</div>  
 
    
    <?php if($userdata->ID){ ?>
    <script>function processClaimPop(){	 
	 
	cb = jQuery("#claimbox").html();
	jQuery("#claimbox").remove();
	
	pptModal('claimbox', cb, "modal-bottom-rightxxx", "ppt-animate-fadein bg-white w-700 p-3 overflow-hidden", 0);
	
	
	} </script>
    <!--msg model -->
    <div id="claimbox" style="display:none;">
 
            <?php _ppt_template( 'single/sidebar/sidebar_dt_claim' );  ?>
      
    </div>
    <?php } ?>
 </div>  

<?php } 


}

?>