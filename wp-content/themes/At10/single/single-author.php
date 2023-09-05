<?php


if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $post, $userdata, $new_settings, $CORE_UI; 


if(in_array(THEME_KEY,array("dt","da"))){
return "";
}

 
$data = array(
	"uid" 		=> "1",
	"title" 	=> "John Doe",
	"desc" 		=> "Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.",
	"image" 	=> "http://localhost/V10IMAGES/_demoimagesv10//user/16.jpg",
	"subtitle" 	=> "adsas da dad", 
	"link" => "#",
	
);
 
if(in_array(THEME_KEY,array("es")) && isset($post->ID) ){

	$found 	= wp_get_object_terms( $post->ID, 'store' );
	if(is_array($found) && !empty($found)){
 
		$description = "";
		if(strlen($found[0]->description) > 0){
			$description  = $found[0]->description;
		}elseif( strlen(_ppt('category_description_'.$found[0]->term_id)) >  5){  
			$description = _ppt('category_description_'.$found[0]->term_id);
		}

		$link = get_term_link($found[0]->term_id, "store");	 
		$name = strip_tags(do_shortcode('[STORENAME]'));
		$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
	 
			
		$data = array(
			"uid" 		=> $found[0]->term_id,
			"title" 	=> ppt_title_author(),
			"desc" 		=> substr($description,0,100)."...",
			"image" 	=> $store_image,
			"subtitle" 	=> $name, 
			"link" 		=> $link,
			
		);	
		
		
	}else{
	return "";
	}

}elseif(isset($post->post_author)){ 

	$data['title'] 	=  ppt_title_author();
	$data['uid'] 	= $post->post_author;
	$data['image'] 	= $CORE->USER("get_avatar",$post->post_author);	
	$data['desc'] 	= substr($CORE->USER("get_desc", $post->post_author),0,150)."...";
	$data['link'] 	= $CORE->USER("get_user_profile_link", $post->post_author );
	
	$subtitle = $CORE->USER("get_username", $post->post_author );
	
	$country = $CORE->USER("get_country", $post->post_author);
	if(strlen($country) > 1){
	$subtitle .= " &bull; ".$country;
	}
	
	$subtitle .= " &bull; ".str_replace("%s", strtolower($CORE->USER("get_lastlogin",$post->post_author)),__("last online %s.","premiumpress"));
	
	$data['subtitle'] 	= $subtitle;
 	
}



?>

<div ppt-box class="rounded">
  <div class="_content py-3">
    <div class="d-flex">
      <div style="width:150px;">
        <div style="height:100px; width:100px;" class="bg-light rounded position-relative overflow-hidden">
          <div class="bg-image" data-bg="<?php echo $data['image']; ?>">
            &nbsp;
          </div>
        </div>
      </div>
      <div class="w-100 ml-lg-4 pr-lg-4 hide-mobile" ppt-flex>
        <div class="text-600">
          <div class="mb-0 d-flex align-items-baseline">
            <div class="text-700">
              <?php echo $data['title']; ?>
            </div>
			<?php if(!in_array(THEME_KEY,array("es","vt","jb"))){ ?>
            <div class="ml-3">
              <?php echo do_shortcode('[RATING_USER uid="'.$data['uid'].'" size="sm" total_show="1" reviews_show="0" ]'); ?>
            </div>
            <?php  } ?>
          </div>
        </div>
        <div class="lh-20 mt-2">
          <?php echo $data['desc']; ?>
        </div>
        <div class="opacity-5 fs-sm mt-2">
          <?php echo $data['subtitle']; ?>
        </div>
      </div>
      <div>
      
      <?php if(in_array(THEME_KEY,array("es"))){ ?>
      
       <a href="<?php echo $data['link']; ?>" class="btn-primary list btn-block" data-ppt-btn><?php echo __("View Agency","premiumpress"); ?></a>
        
      <?php }else{ ?>
      
      
      <?php if(in_array(_ppt(array('user','account_messages')),array("","1")) ){ ?>
        <a href="javascript:void(0);" onclick="<?php if(!$userdata->ID){ ?>processLogin(1);<?php }else{ ?>processMessage('<?php echo $data['uid']; ?>');<?php } ?>" class="btn-primary list mt-2 btn-block" data-ppt-btn> <?php echo __("Message","premiumpress"); ?></a> 
        
        <?php } ?>
        
        <a href="<?php echo $data['link']; ?>" class="btn-system list btn-block" data-ppt-btn><?php echo __("View Profile","premiumpress"); ?></a>
        
        <?php } ?>
        
      </div>
    </div>
  </div>
</div>
