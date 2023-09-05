<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN;

 

// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){
 
   
   if(isset($_POST['ppt_badges'])){
   	if(empty($_POST['ppt_badges'])){ $_POST['ppt_badges'] = array(); }
  	
   	update_option("ppt_badges", $_POST['ppt_badges']);
   
   }
   if(isset($_POST['ppt_awards'])){
   	if(empty($_POST['ppt_awards'])){ $_POST['ppt_awards'] = array(); }
  	
   	update_option("ppt_awards", $_POST['ppt_awards']);
   
   }  
   
   // RESET DEFAULT
   if(isset($_GET['reinstallbadges'])){
   
	  $badges = array('icon' => array('0' => 'fa fa-star','1' => 'fa fa-check','2' => 'fa fa-grin-stars','3' => 'fa fa-hat-santa',),'color' => array('0' => '#FFC300','1' => '#2BA346','2' => '#2266C6','3' => '#CF2121',),'txtcolor' => array('0' => '#000000','1' => '#FBFBFB','2' => '#FEFEFE','3' => '#F9F9F9',),'name' => array('0' => 'Gold','1' => 'Verified','2' => 'Awesome','3' => 'Happy Xmas','4' => '',),'search' => array('0' => '1','1' => '0','2' => '0','3' => '0',),'desc' => array('0' => 'Gold User Listing','1' => '','2' => 'Create your own badges in the admin area!','3' => 'Set your own icons, text and colors!',),'key' => array('0' => '438381','1' => '911356','2' => '79255','3' => '730672',),);
		
		update_option("ppt_badges", $badges);
		 
		
 		// LEAVE MESSAGE
		$_GET['lefttab'] = "b";
		$GLOBALS['ppt_error'] = array(
			"type" 		=> "success",
			"title" 	=> __("Settings Updated","premiumpress"),
			"message"	=> __("settings changed successfully.","premiumpress"),
		);
		
	} 
	
	
   // RESET DEFAULT
   if(isset($_GET['reinstallawards'])){
   
	  $awards = array('icon' => array('0' => 'fa fa-fire-alt','1' => 'fa fa-horse-head','2' => 'fa fa-ghost','3' => 'fa fa-star-exclamation',),'name' => array('0' => 'Your own text here!','1' => 'Make your own awards in the admin area.','2' => 'Change text, icon and color to match your website.','3' => 'Have fun with awards.','4' => '',),'color' => array('0' => '','1' => '','2' => '','3' => '',),'key' => array('0' => '1','1' => '2','2' => '3','3' => '4',),);
		
		update_option("ppt_awards", $awards);
		 
		
 		// LEAVE MESSAGE
		$_GET['lefttab'] = "aw";
		$GLOBALS['ppt_error'] = array(
			"type" 		=> "success",
			"title" 	=> __("Settings Updated","premiumpress"),
			"message"	=> __("settings changed successfully.","premiumpress"),
		);
		
	} 
    
 

}  
 

_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); ?>

 
<div class="tab-content <?php if(isset($_GET['defaultdesign'])){ ?>d-flex flex-column h-100<?php } ?>">
        
        
<div class="tab-pane addjumplink active" 
        data-title="<?php echo __("Overview","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-layer-plus" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
<?php  _ppt_template('framework/admin/parts/listings-overview' ); ?> 
        </div>    
        
      <div class="tab-pane addjumplink" 
        
           data-title="<?php echo str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Page Design","premiumpress") ); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Manage the display of the %s page.","premiumpress")); ?>"
       
        data-icon="fa <?php echo $CORE->LAYOUT("captions","icon"); ?>" 
         
        id="single" 
        role="tabpanel" aria-labelledby="single-tab">
           <?php _ppt_template('framework/admin/parts/design-single' ); ?>
        </div><!-- end design home tab -->
         
        
      <?php  if( $CORE->LAYOUT("captions","listings") ){ ?>  
      <div class="tab-pane addjumplink" 
        
        data-title="<?php echo __("Packages","premiumpress"); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create free or paid packages for users to add %s.","premiumpress")); ?>" 
        data-icon="fa fa-table"  
        id="p" 
        role="tabpanel" aria-labelledby="p-tab">
        <?php  _ppt_template('framework/admin/parts/listings-packages' ); ?> 
        </div><!-- end design home tab -->
        <?php } ?>
         
  
        
        <?php  if( $CORE->LAYOUT("captions","listings") ){ ?>  
<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Upgrades","premiumpress"); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Setup additional upgrade options for your %s.","premiumpress")); ?>"
        data-icon="fa-star" 
        id="a" 
        role="tabpanel" aria-labelledby="a-tab">
<?php  _ppt_template('framework/admin/parts/listings-addons' ); ?> 
        </div>    
        <?php } ?>
        
        
        
 
 <?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("da","es"))  ){ ?>
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Gifts","premiumpress"); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Setup gifts and prices for gifts here.","premiumpress")); ?>"
        data-icon="fa-gifts" 
        id="g" 
        role="tabpanel" aria-labelledby="g-tab">
<?php  _ppt_template('framework/admin/parts/listings-gifts' ); ?> 
        </div>    
        
        <?php } ?>
        
        
        
 <?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("vt"))  ){ ?>
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Video Preview","premiumpress"); ?>" 
        data-desc="<?php echo  __("Let users watch X seconds of a video before being asked to join.","premiumpress"); ?>"
        data-icon="fa-clock" 
        id="vp" 
        role="tabpanel" aria-labelledby="vp-tab">
<?php  _ppt_template('framework/admin/parts/listings-videopreview' ); ?> 
        </div>    
        
        <?php } ?>
        
         
<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Settings","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-cog" 
        id="s" 
        role="tabpanel" aria-labelledby="s-tab">
<?php  _ppt_template('framework/admin/parts/listings-settings' ); ?> 
        </div>    
        
        
        
        
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Media Settings","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-images" 
        id="m" 
        role="tabpanel" aria-labelledby="m-tab">
 <?php  _ppt_template('framework/admin/parts/listings-media' ); ?> 
        </div> 
        
        
        
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Gallery Settings","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-images" 
        id="gallery" 
        role="tabpanel" aria-labelledby="gallery-tab">
 <?php  _ppt_template('framework/admin/parts/listings-gallery' ); ?> 
        </div> 
             
        
        
  <?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("sp"))  ){ ?>
         <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Product Settings","premiumpress"); ?>" 
        data-desc="<?php echo  __("Additional product settings for your website.","premiumpress"); ?>"
        data-icon="fa-cog" 
        id="sc" 
        role="tabpanel" aria-labelledby="sc-tab">
 <?php  _ppt_template('framework/admin/parts/listings-settings-shop' ); ?> 
        </div> 
 <?php } ?>
 
  
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Badges","premiumpress"); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Create badges and display them on website %s pages.","premiumpress")); ?>"
        data-icon="fa-badge-check" 
        id="b" 
        role="tabpanel" aria-labelledby="b-tab">
 <?php  _ppt_template('framework/admin/parts/listings-badges' ); ?> 
        </div> 
        
        
        
           
    <?php if(in_array(THEME_KEY, array("dt")) ){ ?>
      <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Claim Listing","premiumpress"); ?>" 
        data-desc="<?php echo __("Turn on/off this feature here.","premiumpress"); ?>"
        data-icon="fa-thumbs-up" 
        id="claim" 
        role="tabpanel" aria-labelledby="claim-tab">
 <?php  _ppt_template('framework/admin/parts/listings-claim' ); ?> 
        </div> 


    <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Business Services","premiumpress"); ?>" 
        data-desc="<?php echo __("Turn on/off this feature here.","premiumpress"); ?>"
        data-icon="fa-thumbs-up" 
        id="ss" 
        role="tabpanel" aria-labelledby="ss-tab">
 <?php  _ppt_template('framework/admin/parts/listings-services' ); ?> 
        </div> 

<?php } ?>        
        
          
    <?php if(in_array(THEME_KEY, array("dt","es","dl","rt","jb")) ){ ?>
      <div class="tab-pane addjumplink" 
        data-title="<?php echo ppt_title_hours(); ?>" 
        data-desc="<?php echo __("Turn on/off this feature here.","premiumpress"); ?>"
        data-icon="fa-clock" 
        id="wc" 
        role="tabpanel" aria-labelledby="wc-tab">
 <?php  _ppt_template('framework/admin/parts/listings-hours' ); ?> 
        </div> 
        
<?php } ?>         
            
              
 <?php if(in_array(THEME_KEY, array("at")) ){ ?>
      <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Car Auctions","premiumpress"); ?>" 
        data-desc="<?php echo __("Are you runing this as a car auction website?.","premiumpress"); ?>"
        data-icon="fa-car" 
        id="cca" 
        role="tabpanel" aria-labelledby="cca-tab">
 <?php  _ppt_template('framework/admin/parts/listings-carauctions' ); ?> 
        </div> 
        
<?php } ?>         
              
        
 <?php if(in_array(THEME_KEY, array("es")) ){ ?>
      <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Call Rates","premiumpress"); ?>" 
        data-desc="<?php echo __("Turn on/off this feature here.","premiumpress"); ?>"
        data-icon="fa-phone-alt" 
        id="cc" 
        role="tabpanel" aria-labelledby="cc-tab">
 <?php  _ppt_template('framework/admin/parts/listings-callrates' ); ?> 
        </div> 
        
<?php } ?>         
        
        
        
        
        
        
        <?php /*
         <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Awards","premiumpress"); ?>" 
        data-desc="<?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Create awards and display them on website %s pages.","premiumpress")); ?>"
        data-icon="fa-award" 
        id="aw" 
        role="tabpanel" aria-labelledby="aw-tab">
 <?php  _ppt_template('framework/admin/parts/listings-awards' ); ?> 
        </div> 
		
		*/ ?>
        
       
       
        


        
 

</div>

<?php _ppt_template('framework/admin/_form-bottom' ); ?>
<?php  _ppt_template('framework/admin/footer' );  ?>
 
  


<!--- ----------- -->

<div style="display:none">
    <div id="customvalue-list"> 

 
                    <div class="col-md-6 mt-4 border-bottom pb-4 newfield customtxtfield">
                      <div class="position-relative">
                      
                        <input type="text" class="f1 form-control" style="padding-left:45px !important;" placeholder="<?php echo __("Includes X Images..","premiumpress"); ?>">
                        
                        <i class="fal fa-trash text-danger f4" style="position:absolute; right:10px; top:10px; cursor:pointer;"></i>
                        
                        <input type="hidden" class="f2" />
                       
                        <i class="fa fa-check text-success position-absolute f3"  style="top:15px; left:15px; cursor:pointer;"></i> </div>
                     
                  
                      
                    </div>
            </div>
 
</div>
