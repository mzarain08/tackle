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

global $post, $CORE_UI, $userdata, $CORE;

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
		$post->carddata = "";
	}
	
	$customvals = _ppt('searchcardvals'); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
?>

<div ppt-box="" class="list-info-pop-wrap hide-mobile search-zoom rounded-lg mb-4 border-0 shadow" data-pid='%postid%' <?php if(isset($post->carddata)){ echo $post->carddata; } ?>>
 
  <figure>
  <?php _ppt_template( 'cards/themes/search_buttons' ); ?>
  
  <a href="%link%">
  
  <div ppt-border1 class="p-1">
  
    <div class="search-gradient">&nbsp;</div>
    
    <div class="bg-light position-relative overflow-hidden" style="height:360px;">
      <div style="z-index: 1; bottom:10px; position: absolute;left:10px;">
        <div class="text-white fs-4 text-600">
          %title%
          <?php if(isset($post->online) && $post->online){ ?>
          <span class="text-online">&bull;</span>
          <?php } ?>
        </div>
        <div class="fs-sm text-white opacity-5 text-400">
          %city% &nbsp;
        </div>
      </div>
      <div class="bg-image" data-bg="%image%">
        &nbsp;
      </div>
      <?php _ppt_template( 'cards/themes/search_badges' ); ?>
      
      
      <div class="list-info-pop bg-black hide-mobile">
        <ul class="list-unstyled <?php if(_ppt(array('searchcustom','perrow')) == 5){ echo "fs-sm"; } ?>">
          <?php 
	  
	  $shown =0; 
	  if(is_array($customvals) && !empty($customvals)){ 
	  
	  
	  	foreach($customvals as $type => $vals){
			
			if($vals != "1"){  continue; }
			$shown++;
			
			if(THEME_KEY == "da" && in_array($type,array("height","dress"))){ continue; }
			
			switch($type){
		
			case "age": {
			?>
          <?php if(strlen(do_shortcode('[AGE]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Age","premiumpress"); ?></span> <?php echo do_shortcode('[AGE]'); ?> </li>
          <?php } ?>
          <?php
			} break;
  
			case "height": {
			 
			?>
          <?php if(strlen(do_shortcode('[HEIGHT]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Height","premiumpress"); ?></span> <?php echo do_shortcode('[HEIGHT]'); ?> </li>
          <?php } ?>
          <?php 
		  
			} break;
			
			case "dress": {
			
			?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Dress Size","premiumpress"); ?></span> <?php echo do_shortcode('[DRESSSIZE]'); ?> </li>
          <?php
			} break;
			
			case "tax_country": {
			?>
          <?php if(strlen(do_shortcode('[COUNTRY]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Country","premiumpress"); ?></span> <?php echo do_shortcode('[COUNTRY]'); ?></li>
          <?php } ?>
          <?php
			} break;
			
			case "city": {
			?>
          <?php if(strlen(do_shortcode('[CITY]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("City","premiumpress"); ?></span> <?php echo do_shortcode('[CITY]'); ?></li>
          <?php } ?>
          <?php
			} break;
			
			default: {
			
		
			
			
				if(substr($type, 0, 3) == "tax"){
				
					$taxonomy = str_replace("tax_","",$type);
				
					$cats = get_terms( $taxonomy, array( 'hide_empty' => 0, 'parent' => 0  ));
					if(!empty($cats)){
					
					
					if(strlen(do_shortcode('[TAX name="'.$taxonomy.'" pid="'.$post->ID.'"]')) > 1){
					?>
        <li class="d-flex justify-content-between"> <span>
          <?php 
					
					if($taxonomy == "store"){ 
					
						echo __("Agency","premiumpress");
					
					}elseif($taxonomy == "listing"){ 
					
						echo SearchFilterCaptions("category", __("Category","premiumpress") ); 
					
					}else{ echo $CORE->GEO("translation_tax_key", $taxonomy); } ; ?>
          </span> <?php echo do_shortcode('[TAX name="'.$taxonomy.'" pid="'.$post->ID.'"]'); ?> </li>
        <?php } ?>
        <?php
					
					}
				}
				
			
			} break;
			
			}
		 
		
		}
	  
	  }
	  
	  if($shown ==0){ ?>
          <?php if(strlen(do_shortcode('[AGE]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Age","premiumpress"); ?></span> <?php echo do_shortcode('[AGE]'); ?> </li>
          <?php } ?>
          <?php if(strlen(do_shortcode('[CITY]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("City","premiumpress"); ?></span> <?php echo do_shortcode('[CITY]'); ?></li>
          <?php } ?>
          <?php if(THEME_KEY == "es" && strlen(do_shortcode('[HEIGHT]')) > 1){ ?>
          <li class="d-flex justify-content-between"> <span><?php echo __("Height","premiumpress"); ?></span> <?php echo do_shortcode('[HEIGHT]'); ?> </li>
          <?php } ?>
          <?php } ?>
        </ul>
      </div>
    </div>
    </figure>
  </div>
</div>
</a>

<?php _ppt_template( 'cards/themes/search_mobile' ); ?>
