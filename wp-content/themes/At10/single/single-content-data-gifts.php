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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$gifts = array();

if(is_admin()){
$gifts["gift1"] = array(
"gift_id" 	=> 1,
"image" 	=> get_template_directory_uri()."/_escort/icons/1.png",
"date" 		=> "",
);

$gifts["gift2"] = array(
"gift_id" 	=> 2,
"image" 	=> get_template_directory_uri()."/_escort/icons/2.png",
"date" 		=> "",
);

$gifts["gift3"] = array(
"gift_id" 	=> 3,
"image" 	=> get_template_directory_uri()."/_escort/icons/3.png",
"date" 		=> "",
);
}else{
$gifts = get_user_meta($post->post_author,'gifts_array',true);
}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$descTitle = 0;

if(isset($new_settings['block_title'])){
	$descTitle  = $new_settings["block_title"];
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
	
if(is_array($gifts) && !empty($gifts)){


// CLEAN UP
foreach($gifts as $k => $g){

	if($g['gift_id'] == "99"){ 
	
		unset($gifts[$k]);
		
	}else{
	
		// DEFAULT IMAGE
		if(defined('THEME_KEY') && in_array(THEME_KEY, array("es")) ){
			$defaultimg = get_template_directory_uri()."/_escort/icons/".$g['gift_id'].".png";
		}else{
			$defaultimg = get_template_directory_uri()."/_dating/icons/".$g['gift_id'].".png";
		}
		
		if( strlen(_ppt(array('giftimg', $g['gift_id']))) > 2 ){		
		$defaultimg = _ppt(array('giftimg', $g['gift_id']));				
		}
	
		$gifts[$k]['image'] = $defaultimg;
		
	}
}
 

// 
if(!empty($gifts)){
 
?>
<?php if($descTitle){ ?>

<div class="my-3 fs-7 text-600">
  <?php echo __("Gifts Received","premiumpress"); ?>
</div>
<?php } ?>
<div>
  <ul class="row">
    <?php foreach($gifts as $g){   
	
	
	$vv = $CORE->date_timediff($g['date']);	
	 
	
	?>
    <li class="col-4 col-md-2 mb-3">
      <div class="badge_tooltip text-center" data-direction="top">
        <div class="badge_tooltip__initiator">
          <img src="<?php echo $g['image']; ?>" class="img-fluid" alt="gift" />
        </div>
        <div class="badge_tooltip__item">
          <?php echo str_replace("%d", $CORE->USER("get_display_name",$g['from_id']), str_replace("%s",$vv['string-small'],__("Sent by %d %s","premiumpress"))); ?>
        </div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<?php } 


}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>