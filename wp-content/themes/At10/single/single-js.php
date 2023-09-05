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

global $userdata, $CORE, $CORE_UI;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['flag-set-makeoffer'])){
?>
 
<script>
function processMakeOffer(){	 
			
			<?php if(in_array(THEME_KEY,array("rt"))){  ?>
			 jQuery("<script/>",{type:'text/javascript', src:'https://code.jquery.com/ui/1.13.0/jquery-ui.js'}).appendTo('head'); 
    jQuery('head').append('<link rel="stylesheet" type="text/css" href="<?php echo CDN_PATH."css/_datepicker.css"; ?>">');
	jQuery( "#seldate" ).hide();
	setTimeout(function(){
	 
			jQuery( "#seldate" ).show();
			
		jQuery( "#datepicker" ).datepicker({
				   format: 'yyyy-mm-dd hh:ii:ss',
			altField: "#offer_price_amount"
		}); 
			 
	}, 2000);   <?php } ?>
	
	
 
	response = jQuery("#modal-offer").html(); 
	jQuery("#modal-offer").remove();
 
	pptModal("offer", response, "modal-bottomxxxx", "mm-wink ppt-animate-bouncein bg-white ppt-modal-shadow w-700", 0);
	 

}
</script>
 <div style="display:none;" id="modal-offer"> 

<div ppt-box class="rounded">

<?php if(!in_array(THEME_KEY,array("cb"))){  ?>
<div class="_header d-flex">

    <div class="_title w-100">
      <?php echo ppt_title_offer(); ?>
    </div>  
    <div class="_close btn-close">
        <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['close']; ?>
          </div>
    </div>
    
</div> 
<?php } ?>             
    
                
                  <?php 
				  
				  	if(in_array(THEME_KEY,array("jb"))){ 
					
				  	_ppt_template( 'single/sidebar/sidebar_jb_offer' ); 					
					
					}elseif(in_array(THEME_KEY,array("cb"))){ 
					
				  	_ppt_template( 'single/sidebar/sidebar_cb_offer' ); 
					
					}elseif(in_array(THEME_KEY,array("rt"))){ 
					
				  	_ppt_template( 'single/sidebar/sidebar_rt_offer' );  
					
					}elseif(in_array(THEME_KEY,array("ll"))){ 
					
				  	_ppt_template( 'single/sidebar/sidebar_ll_offer' ); 					
					
					}else{
					
					 _ppt_template( 'single/single-offer' ); 
					}  
					
					?>
              
</div> 
</div>
<?php

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('design','display_stickysidebar')), array("","1"))){ ?>   <?php } ?> 
<?php if($userdata->ID && $post->post_author == $userdata->ID){ ?>
<div class="ppt-own-listing"></div> 
<script>  


function processLiveEditors(){
 
		jQuery('.addeditmenu').each(function () {	
		
			icon = "fal fa-pencil";
			css = "float-right position-relative hide-mobile"; 
			
			if( jQuery(this).attr("data-key") == "top"){
			icon = "fal fa-camera";
			} else if( jQuery(this).attr("data-key") == "video"){
			icon = "fal fa-video";
			} else if( jQuery(this).attr("data-key") == "images"){
			icon = "fal fa-image";
			
			} else if( jQuery(this).attr("data-key") == "imagestop"){
			icon = "fal fa-image";
			css = " position-relative float-left hide-mobile";
			
			} else if( jQuery(this).attr("data-key") == "titletop"){
			icon = "fal fa-pencil";
			css = " position-relative float-left hide-mobile";
			
			
			} else if (jQuery(this).attr("data-key")  == "videoseries"){
			icon = "fal fa-film";
			//css = " position-relative hide-mobile ";
			}
			  
			jQuery(this).html('<span class="'+css+'"><a href="javascript:void(0);" onclick="processEditData(\''+jQuery(this).attr("data-key")+'\');" class="single-page-edit-button single-page-edit-button-bg"><i class="'+icon+' text-white"></i><span class="ripple single-page-edit-button-bg"></span><span class="ripple single-page-edit-button-bg"></span><span class="ripple single-page-edit-button-bg"></span></a></span>');	
		});  

}
 
function processEditSubmitData(){
	// BUSINESS HOURS PLUGIN
	jQuery('.startTime').attr('name', 'startTime[]');
	jQuery('.endTime').attr('name', 'endTime[]');
	jQuery('.isActive').attr('name', 'isActive[]');
	
	return true;
}
function processEditData(btype){
	
	var SleepFor = 0;
	if(btype == "imagestop" || btype == "images" || btype == "video" ||  btype == "music"){
	
	jQuery("<script/>",{type:'text/javascript', src:'<?php echo CDN_PATH; ?>js/js.up.js'}).appendTo('head');	
	jQuery("<script/>",{type:'text/javascript', src:'<?php echo CDN_PATH; ?>js/js.plugins-upload.js'}).appendTo('head'); 	
 
	jQuery("<script/>",{type:'text/javascript', src:'<?php echo home_url(); ?>/wp-includes/js/jquery/ui/core.js'}).appendTo('head');
	jQuery("<script/>",{type:'text/javascript', src:'<?php echo home_url(); ?>/wp-includes/js/jquery/ui/mouse.js'}).appendTo('head');
 
	jQuery('head').append('<link rel="stylesheet" href="<?php echo CDN_PATH; ?>css/_up.css" type="text/css" />');
 
 	SleepFor = 1000; 
	
	} 
	
	setTimeout(function(){
	
		jQuery.ajax({
			type: "POST",
			url: ajax_site_url,		
			data: {
				   action: "load_editlisting_form",		
				   type: btype,
				   eid: <?php echo $post->ID; ?>   
			   },
			   success: function(response) { 
			   
			   		
					if(btype == "imagestop" || btype == "images" || btype == "video" ||  btype == "music"){
					 
					
					var hh = response+'<div class="bg-light py-4 text-center mt-4 mx-n3 mb-n4"> <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-system shadow-sm btn-xl"><i class="fa fa-sync mr-3"></i><?php echo __("Refresh Page","premiumpress"); ?></a></div>';
					
					pptModal(btype, hh, "modal-bottom-rightxxx", "ppt-animate-fadein bg-white w-700 p-3 overflow-hidden", 0);
					
					}else{
			   
				  
					var hh = '<form method="post" class="p-0 m-0" onsubmit="return processEditSubmitData()"><input type="hidden" name="liveeditlisting" value="1" /><input type="hidden" name="eid" value="<?php echo $post->ID; ?>" />'+response+' <div class="bg-light py-4 text-center mt-4 mx-n3 mb-n4"> <button class="btn btn-system shadow-sm btn-xl"><?php echo __("Save Changes","premiumpress"); ?></button></div></form>';
					
					
					pptModal(btype, hh, "modal-bottom-rightxxx", "ppt-animate-fadein bg-white w-700 p-3 overflow-hidden", 0);
		   	 
					}
					 
									
			   },
			   error: function(e) {
				   console.log(e)
			   }
		   });
	   
	   }, SleepFor);
   
} 
</script>
<?php } ?> 