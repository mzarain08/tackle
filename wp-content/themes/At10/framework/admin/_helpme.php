<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
   
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE;

?>

<div id="sidebar_help_icon"> <a href="javascript:void(0);" onclick="jQuery('#sidebar_help_icon').addClass('hideme');jQuery('#sidebar_help').addClass('showme');"><?php echo __("Need Help","premiumpress"); ?><a> </div>
<div id="sidebar_help">
<?php /*
  <div class="help_searchbox">
    <div class="position-relative">
      <input type="text" class="form-control" name="helpme_keyword" id="helpme_keyword" autocomplete="off" placeholder="<?php echo __("Search knowledgebase...","premiumpress"); ?>" value="">
      <button class="btn position-absolute text-muted" type="button" onclick="helpme_searh_results();" style=" top: 1px;    right: 0px;" ><i class="fal fa-search"></i></button>
    </div>
  </div>
  */ ?>
  <div class="mt-3 p-2"> <a href="https://www.youtube.com/c/Premiumpress/videos?sub_confirmation=1" target="_blank" class="float-right  badge badge-danger font-weight-normal"><i class="fab fa-youtube"></i> Visit YouTube</a>
    <div id="ajax-helpme-output"></div>
  </div>
  <div class="border-bottom text-center text-uppercase" id="hidembtn" >
    <div class="btn-group d-flex justify-content-between position-absolute w-100" style="bottom:0px;"  >
      <button type="button" class="btn btn-secondary htmlmebuttonout"><?php echo __("Ask Question","premiumpress"); ?></button>
      <button type="button" class="btn btn-secondary"  onclick="jQuery('#sidebar_help_icon').removeClass('hideme');jQuery('#sidebar_help').removeClass('showme');" style="background: #ca0000; border-color:#ca0000;"><?php echo __("Hide Me","premiumpress"); ?></button>
    </div>
  </div>
</div>
<style>
/* icons */
#sidebar_help_icon:not(.hideme){ display:block !important; }
#sidebar_help_icon { position: absolute; height:40px; line-height: 30px;    top: 20%;    right: -50px;    background: #ca0000; padding:0px 20px;   min-width: 100px; text-align:center;    -moz-transform: rotate(-90deg);  -moz-transform-origin: center center; -webkit-transform: rotate(-90deg);  -webkit-transform-origin: center center;  -ms-transform: rotate(-90deg); -ms-transform-origin: center center; }

body.rtl #sidebar_help_icon { right:auto; left:-70px !important; }

#sidebar_help_icon a { color:#fff; font-size: 16px; text-transform: none; }

/* main helpme sidebar wrap */
#sidebar_help { display:none; }
#sidebar_help.showme { background: #fff; display:block !important;    position: absolute;    right: 0px;    top: 0;   min-height:97vh;    width: 400px; display:none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; }

body.rtl #sidebar_help.showme { right:auto; left:0px !important }

#ajax-helpme-output li a { font-size:14px; color:#333333; font-weight: 500; }


.help_searchbox {

margin: 6px;
    height: 34px;
    background-image: -moz-radial-gradient(center, ellipse cover, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    background-image: -webkit-gradient(radial, center center, 0px, center center, 100%, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    background-image: -webkit-radial-gradient(center, ellipse cover, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    background-image: -o-radial-gradient(center, ellipse cover, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    background-image: -ms-radial-gradient(center, ellipse cover, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    background-image: radial-gradient(ellipse at center, rgba(237, 243, 247, 1), rgba(237, 243, 247, 1));
    border: 1px none rgb(255, 255, 255);
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0px 1px 2px -1px rgb(141, 141, 141) inset;

} 

#sidebar_help ul { line-height:30px; }
 
/*
 buttons
*/
#hidembtn .btn { height:50px; border-radius:0px; }

/* mobile */
@media (max-width: 575.98px) { 
#sidebar_help_icon:not(.hideme) { display:none !important; }
}

@media (min-width: 1500px){ 

<?php if(isset($_GET['page']) && in_array($_GET['page'], array("premiumpress","design","listingsetup","membershipsetup","email","cart","advertising","settings") ) ){ //,"design","settings" ?>

#sidebar_help_icon { display:none; }
<?php }else{ ?>
#sidebar_help_icon { display:block !important; }
<?php } ?>

}
 

</style>
<script>


function closeHelpBoxWindow(){

	jQuery('#sidebar_help_icon').removeClass('hideme');
	jQuery('#sidebar_help').removeClass('showme');
}

jQuery('.htmlmebuttonout').click(function() {
    
   
   window.open("https://www.premiumpress.com/contactform/?license_key=<?php echo get_option("ppt_license_key"); ?>", '_blank');
   
});

jQuery('#helpme_keyword').keypress(function (e) {
   
   if (e.which == 13) {
     helpme_searh_results();
   }
});

jQuery('#sidebar_help_icon a').click(function() {
   helpme_searh_results();
});

function helpme_searh_results(){

jQuery('#ajax-helpme-output').html('<div class="text-center mt-5 pt-5"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>');
 
  
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "helpme_search",
			keyword: jQuery("#helpme_keyword").val(),
			page: "<?php if(isset($_GET['page'])){ echo esc_attr($_GET['page']); } ?>",
			innerpage: jQuery(".lefttab").val(),
        },
        success: function(response) {
	 		 
			if(response.status == "ok"){
			
				jQuery("#ajax-helpme-output").html(response.output);			
			
				if(response.mainvid != ""){
					
					if(jQuery("#mainvidbox").length > 0){
					
						jQuery("#mainvidbox").find('iframe').attr('src', 'https://www.youtube.com/embed/'+response.mainvid);
						
					}else{
						
						jQuery("#sidebar_help").prepend('<div class="border p-2 bg-light" id="mainvidbox"><iframe width="100%" height="280" src="https://www.youtube.com/embed/'+response.mainvid+'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>');
					
					}
				}
			  	 
  		 	
			}else{			
			 	jQuery('#ajax-helpme-output').html('');		
				closeHelpBoxWindow();
			}	
			
			
        },
        error: function(e) {
            jQuery('#ajax-helpme-output').html('');		
			closeHelpBoxWindow();
        }
    });
	
  
	
}// end are you sure


jQuery(window).on('load', function(){
	
	 

		if(jQuery(window).width() > 1700){
		<?php if(isset($_GET['page']) && in_array($_GET['page'], array("premiumpress","listingsetup","membershipsetup","email","cart","advertising","settings") ) ){ //,"design","settings" ?>
		//jQuery('#sidebar_help').addClass('showme defaultopen');
		//helpme_searh_results();
		<?php } ?>
		}
									   
		 
		jQuery(window).on('scroll', function() {
											 
		 	//console.log(jQuery(this).scrollTop());
			if(jQuery(this).scrollTop() > 100) {
				
				 
				jQuery('#sidebar_help.showme').attr('style','height:100%;');
			 
			} else {
				
				 jQuery('#sidebar_help.showme').attr('style','height: 90vh;');
				
			}
			 
			
		}); 
	
});
</script>
