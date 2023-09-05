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

	// SAVE REG FIELDS
	if(isset($_POST) && !empty($_POST) && isset($_POST['regfields']) ){
	
		update_option("regfields", $_POST['regfields']);	
	}

} 

_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); 
?>
<div class="tab-content <?php if(isset($_GET['defaultdesign'])){ ?>d-flex flex-column h-100<?php } ?>">
       
      
       
 <div class="tab-pane addjumplink active" 
        data-title="<?php echo __("Overview","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-users" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-overview' ); ?>          
        </div><!-- end design home tab -->       
        
 
       
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Registration","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-users-medical" 
        id="reg" 
        role="tabpanel" aria-labelledby="reg-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-reg' ); ?>          
        </div><!-- end design home tab -->       
     
     
      
         
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Fields","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-align-left" 
        id="f" 
        role="tabpanel" aria-labelledby="f-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-fields' ); ?>          
        </div><!-- end design home tab -->      
   
 
 
 
 
             
         
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Types","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-user-secret" 
        id="t" 
        role="tabpanel" aria-labelledby="t-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-types' ); ?>          
        </div><!-- end design home tab -->      
         
     
     
        
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Ratings &amp; Comments","premiumpress"); ?>" 
        data-desc="<?php echo __("Manage user ratings &amp; comments.","premiumpress"); ?>"
        data-icon="fa-star" 
        id="rating" 
        role="tabpanel" aria-labelledby="rating-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-ratings' ); ?>          
        </div><!-- end design home tab -->     
       
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Favorites &amp; Likes","premiumpress"); ?>" 
        data-desc="<?php echo __("Manage user favorites &amp; likes.","premiumpress"); ?>"
        data-icon="fa-heart" 
        id="favs" 
        role="tabpanel" aria-labelledby="favs-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-favs' ); ?>          
        </div><!-- end design home tab -->     
       
       
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Message System","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-comments-alt" 
        id="m" 
        role="tabpanel" aria-labelledby="m-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-messages' ); ?>          
        </div><!-- end design home tab -->     
  
  
       
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Notification System","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-bell" 
        id="n" 
        role="tabpanel" aria-labelledby="n-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-notifications' ); ?>          
        </div><!-- end design home tab -->      
        
     
       <div class="tab-pane addjumplink"         
         data-title="<?php echo __("Login Page","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can choose the design for your login &amp; register pages.","premiumpress"); ?>"
 
        data-icon="fa fa-lock" 
         
        id="login" 
        role="tabpanel" aria-labelledby="login-tab">
             <?php _ppt_template('framework/admin/parts/usersettings-login' ); ?>   
        </div><!-- end design home tab -->   
     
     
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Social Login","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa fa-user-circle" 
        id="s" 
        role="tabpanel" aria-labelledby="s-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-socialogin' ); ?>          
        </div><!-- end design home tab -->       
        
      

        
  
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Verfication","premiumpress"); ?>" 
        data-desc="<?php echo __("Stop users from accessing website features until they verify their identify.","premiumpress"); ?>"
        data-icon="fa-user-shield" 
        id="v" 
        role="tabpanel" aria-labelledby="v-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-verify' ); ?>          
        </div><!-- end design home tab -->       
        
        

        
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Account Options","premiumpress"); ?>" 
        data-desc="<?php echo __("Manage what's displayed on the user account page.","premiumpress"); ?>"
        data-icon="fa-file-user" 
        id="ap" 
        role="tabpanel" aria-labelledby="ap-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-account' ); ?>          
        </div><!-- end design home tab -->     
        
      
    

    
<?php if(!in_array(THEME_KEY, array("da")) ){ ?>
   
   
 <div class="tab-pane addjumplink" 
        data-title="<?php echo __("User Profile Pages","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can change the user settings for your website.","premiumpress"); ?>"
        data-icon="fa-id-card" 
        id="p" 
        role="tabpanel" aria-labelledby="p-tab">
        <?php _ppt_template('framework/admin/parts/usersettings-profile' ); ?>          
        </div><!-- end design home tab -->      
<?php } ?> 
   
 
    
    
   
   
 
   
</div>
 
<?php _ppt_template('framework/admin/_form-bottom' ); ?>



<!-- AFTER FORM DATA -->

<div style="display:none"><div id="regfield-list-new">

    <li class="cfielditem"> 
 
      
       
        <label><?php echo __("Title","premiumpress"); ?></label>
        <input type="text" name="regfields[name][]" value="" id="nfaqt1" class="form-control" />  
        <input type="hidden" name="regfields[values][]" value="" />  
        <input type="hidden" name="regfields[required][]" value="" />  
        <input type="hidden" name="regfields[tax_name][]" value="" />  
        <input type="hidden" name="regfields[posttype_name][]" value="" />  
        <div class="row mt-3">
        
        	<div class="col-md-6">
            
            <label><?php echo __("Field Type","premiumpress"); ?></label>
            
              <select name="regfields[type][]" class="form-control">
                  
                    <option value="input"><?php echo __("Input Field","premiumpress"); ?></option>
                    <option value="textarea"><?php echo __("Text Area","premiumpress"); ?></option>
                    <option value="checkbox"><?php echo __("Checkbox","premiumpress"); ?></option>
                    <option value="radio"><?php echo __("Radio Button","premiumpress"); ?></option> 
                    <option value="select"><?php echo __("Selection Box","premiumpress"); ?></option>                                          
                
              </select>
     
            
            </div>
        
        	<div class="col-md-6">
            
             <label><?php echo __("Unique Key","premiumpress"); ?></label>
             
              <input type="text" name="regfields[key][]" value="field<?php echo rand(0,1000); ?>" class="form-control"  />        
             
            </div>   
                 
        </div> 
  
    
    </li>  
      
</div></div>

   
<?php  _ppt_template('framework/admin/footer' );  ?>