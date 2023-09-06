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

global $CORE, $wpdb, $settings;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$settings = array(
"title" => __("Import Subscribers","premiumpress"), 
"desc" => __("Here you can import newsletter subscribers.","premiumpress"),
"back" 		=> "overview"
);

_ppt_template('framework/admin/_form-wrap-top' ); 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
            
        
		<div class="card card-admin"><div class="card-body">  
 

<form method="post"  action="admin.php?page=email" >
 
<input type="hidden" name="action" value="importemails" />  
 
<div class="mt-3 mb-3 text-muted"><?php echo __("Enter email addresses below, each on a new line with optional name values. <br /> Import format is: <b> example@hotmail.com","premiumpress"); ?></b></div>

<textarea class="form-control" id="import_emails_data" style="height:400px !important;" name="import_emails"></textarea>  
                
 
  <div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Import Subscribers","premiumpress"); ?></button>
    	</div>
     
 
</form>
      
        
        </div><!-- end col 8 -->
      

    </div></div>  <!-- end admin card -->
        
        

</div></div>  <!-- end row -->
        