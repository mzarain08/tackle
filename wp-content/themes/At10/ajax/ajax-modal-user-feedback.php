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

global $CORE, $userdata;

if(!is_numeric($_POST['uid'])){ die(); }
			
			$args = array(
				 
				'number' => 10,
				
				'meta_query' => array(
						 
						array(
							'key'		=> 'feedback_for',
							'value' 	=> $_POST['uid'],
							'compare' 		=> '=',
						),
						
						
						array(
							'key'		=> 'feedback',	
							'value' 	=> 1,
							'compare' 	=> '=',
						),	
						
						array(
							'key'		=> 'ratingtotal',	
							'value' 	=> $_POST['value1'],
							'compare' 	=> '>=',
						),	
						
						array(
							'key'		=> 'ratingtotal',	
							'value' 	=> $_POST['value2'],
							'compare' 	=> '<',
						),
						 
						 
					),
					
);
 

// GET USER FEEDBACK
$c = new WP_Comment_Query($args); 
$feedback = $c->comments;
 
?>


<div class="p-4">
<?php 
if(empty($feedback)){ ?>

<hr />
<div><?php echo __("No feedback found.","premiumpress") ?></div>
              
<?php }elseif(!empty($feedback)){
			
			 foreach($feedback as $this_feedback){
					 
					global $settings;
					
					$settings = array(
					
						"ID" => $this_feedback->comment_ID,
						"desc" => strip_tags($this_feedback->comment_content), 
						"date" => $this_feedback->comment_date, 			
						"author" => $this_feedback->user_id, 
						"author_name" => $CORE->USER("get_name",$this_feedback->user_id), 			
						"pid" => $this_feedback->comment_post_ID,			
						
					);		 
					
					// DISPLAY FEEDBACK 
					_ppt_template( 'content', 'feedback' );
					 
					
					
			}  // end foreach
			
}
		
?>
</div>