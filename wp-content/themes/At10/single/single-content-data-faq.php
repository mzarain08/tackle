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
 

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->thistheme = THEME_KEY;
	}

$current_data = get_post_meta($post->ID,'customfaq', true); 


if(defined('WLT_DEMOMODE') || get_post_meta($post->ID,"ppt-demo",true) == "1" || is_admin() ){

	$current_data = array(
	
		"name" => array(
			0 => "This is an example seller FAQ question.",
			1 => "This is another FAQ added by the seller.",
			2 => "This is another FAQ added by the seller.",
			3 => "This is another FAQ added by the seller.",
		),
		"value" => array(
			0 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			1 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			2 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			3 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
		),
		
	);
}
$i=0; $shown = 0;
if( !empty($current_data) ){  ?>
 
<div id="single-faq">
 
<?php  foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){ $shown++; ?>
 
<div class="card ppt-show-hide mb-3" style="cursor:pointer;">
<div class="card-body p-3 text-600">
 
	<i class="fa fa-question-circle mr-2 text-primary hide-mobile"></i>  <?php echo stripslashes($current_data['name'][$i]); ?>
 
 
	<?php if(strlen($current_data['value'][$i]) > 0){ ?>
    <div class="hide pt-3"><?php echo stripslashes($current_data['value'][$i]); ?> </div>
    <?php } ?>

</div> 
</div> 
 
  <?php } $i++; } ?>
  
</div>
<?php }  ?> 