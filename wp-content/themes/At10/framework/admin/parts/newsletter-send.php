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

global $CORE, $settings; 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$settings = array(
"title" => __("Send Newsletter","premiumpress"),
"desc" => __("Here you can send a mass email to all newsletter subscribers","premiumpress"), 
"back" => "overview"
);

_ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

 
      <div class="card card-admin">
        <div class="card-body">
          <form method="post" name="admin_email" id="admin_email" action="admin.php?page=email" >
            <input type="hidden" name="action" value="sendnewsletter" />
            <label class="txt500"><?php echo __("Subject","premiumpress"); ?></label>
            <input type="text" name="subject" class="form-control mt-2"/> 
 <?php

$content = "";
 

 echo wp_editor( $content, 'newsletter_message', array( 'textarea_name' => 'newsletter_message', 'editor_height' => '300px !important', 'media_buttons' => FALSE ) );  ?>   
            
            
<div class=" mt-2">
 

<?php $shortcodes = $CORE->email_message_filter('',array("unsubscribe" => "unsubscribe link"), true, "newsletter"); ?>
<select class="form-control" id="newslettershortcodes" onchange="appendText(this.value,'newsletter_message')">
<option value=""><?php echo __("Email Shortcodes","premiumpress"); ?></option>
	<?php foreach($shortcodes as $key => $sc){ ?>
    <option value="<?php echo $key; ?>"><?php echo "(".$key.") = ".$sc; ?></option>
    <?php } ?>
</select>

 

</div>           
           
            
            <div class="p-4 bg-light text-center mt-4">
              <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Send Newsletter","premiumpress"); ?></button>
            </div>
          </form>
        
          
        
          
          <?php
		    // ORDERS
			$args = array(
				'post_type' 		=> 'ppt_newsletter',
				'posts_per_page' 	=> 500,
				'paged' 			=> 1,
				
					'meta_query' => array( 
						'user_id'    => array(
							'key' 			=> 'news_email',	
							'value' 		=> "",
							'compare' 		=> '!=',								 					 			
						),	
						
						'verified'    => array(
							'key' 			=> 'news_verified',	
							'value' 		=> "yes",
							'compare' 		=> '=',								 					 			
						),				 	
					), 
				 
					
			  );
			  
			  
			  $wp_query1 = new WP_Query($args);    
			  $emails = $wpdb->get_results($wp_query1->request, OBJECT);
			   
		  ?>
          
         <div class="opacity-5 small mt-3"><?php echo str_replace("%s", "<strong>".$wp_query1->found_posts."</strong>", __("This email will be sent to %s verified users.","premiumpress") ); ?></div>
          
          
          
        </div>
      </div>
    </div>
  </div>
</div>
