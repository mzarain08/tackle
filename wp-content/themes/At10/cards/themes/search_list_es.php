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
		
		$post->showupgrades = 1;
	}

 

 
?>

<div class="hide-mobile mb-4" data-pid='%postid%'>

  <div class="d-flex">
  
  
    <div style="min-width:220px;">
      <a href="%link%">
      <div class="p-2 bg-white" ppt-border1>
        <div class="bg-light position-relative overflow-hidden" style="height:220px;">
         <figure>
          <div class="bg-image" data-ppt-image-bg>
            &nbsp;
          </div>
          <?php _ppt_template( 'cards/themes/search_badges' ); ?>
           </figure>
        </div>
      </div>
      </a>
    </div>
    
    
   
    <div class="position-relative w-100 pl-lg-4">
     <div class="p-4 bg-white" ppt-border1 style="min-height:220px;">
      <div class="d-sm-flex flex-sm-column">
        <div class="fs-4 text-600 mb-2">
          
          <a href="%link%" class="text-dark _adtitle">%title%  
		  <?php if(isset($post->online) && $post->online){ ?>
          <span class="text-online">&bull;</span>
          <?php } ?>
          </a>
          
        </div>
         
       <nav ppt-nav class="seperator pl-0 text-muted mb-3"> 
        <ul class="list-unstyled">
          <?php 
	  
	  $shown =0; 
	  if(isset($customvals) && is_array($customvals) && !empty($customvals)){ 
	  
	  
	  	foreach($customvals as $type => $vals){
			
			if($vals != "1"){  continue; }
			$shown++;
			
			switch($type){
		
			case "age": {
			?>
          <?php if(strlen(do_shortcode('[AGE]')) > 1){ ?>
          <li > <span><?php echo __("Age","premiumpress"); ?></span> <?php echo do_shortcode('[AGE]'); ?> </li>
          <?php } ?>
          <?php
			} break;
  
			case "height": {
			?>
          <?php if(strlen(do_shortcode('[HEIGHT]')) > 1){ ?>
          <li > <span><?php echo __("Height","premiumpress"); ?></span> <?php echo do_shortcode('[HEIGHT]'); ?> </li>
          <?php } ?>
          <?php
			} break;
			
			case "dress": {
			?>
          <li > <span><?php echo __("Dress Size","premiumpress"); ?></span> <?php echo do_shortcode('[DRESSSIZE]'); ?> </li>
          <?php
			} break;
			case "city": {
			?>
          <?php if(strlen(do_shortcode('[CITY]')) > 1){ ?>
          <li ><?php echo do_shortcode('[CITY]'); ?></li>
          <?php } ?>
          <?php
			} break;
			
			default: {
			/*
				if(substr($type, 0, 3) == "tax"){
				
					$taxonomy = str_replace("tax_","",$type);
				
					$cats = get_terms( $taxonomy, array( 'hide_empty' => 0, 'parent' => 0  ));
					if(!empty($cats)){
					
					
					if(strlen(do_shortcode('[TAX name="'.$taxonomy.'" pid="'.$post->ID.'"]')) > 1){
					?>
        <li > <span>
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
				*/
			
			} break;
			
			}
		 
		
		}
	  
	  }
	  
	  if($shown ==0){ ?>
          <?php if(strlen(do_shortcode('[AGE]')) > 1){ ?>
          <li > <span><?php echo __("Age","premiumpress"); ?></span> <?php echo do_shortcode('[AGE]'); ?> </li>
          <?php } ?>
          <?php if(strlen(do_shortcode('[CITY]')) > 1){ ?>
          <li > <span><?php echo __("City","premiumpress"); ?></span> <?php echo do_shortcode('[CITY]'); ?></li>
          <?php } ?>
          <?php if(THEME_KEY == "es" && strlen(do_shortcode('[HEIGHT]')) > 1){ ?>
          <li > <span><?php echo __("Height","premiumpress"); ?></span> <?php echo do_shortcode('[HEIGHT]'); ?> </li>
          <?php } ?>
          <?php } ?>
        </ul>
        
        </nav>
        
         
        
        
        <div style="min-height:60px;">
          <?php echo do_shortcode("[EXCERPT limit=150]"); ?>...
        </div>
        
        <?php if(isset($post->showupgrades) && $post->showupgrades == 1){ }else{ ?>
        <div>        
        <a href="%link%" data-ppt-btn class="btn-primary"><?php echo __("View Profile","premiumpress"); ?></a>
        </div>
        <?php } ?>
        
        
       </div>  
        
        
      </div>
    </div>
  </div>
</div>

<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:190px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <div class="h-100 position-relative">
        <figure>
          <?php _ppt_template( 'cards/themes/search_badges' ); ?>
          <div class="bg-image z-0" data-bg="%image%">&nbsp;</div>
        </figure>
      </div>
    </div>
    </a>
    <div class="lh-20 text-700 " style="margin-top:20px;">
      <?php if(isset($post->online) && $post->online){ ?>
      <span class="text-online">&bull;</span>
      <?php } ?>
      <a href="%link%" class="text-dark">%title%, <span class="fs-sm opacity-5"><?php echo do_shortcode('[AGE]'); ?></span></a>
    </div>
  </div>
</div>
<?php if(isset($post->showupgrades) && $post->showupgrades == 1){  _ppt_template( 'cards/themes/search_list_upgrade' );  }   ?>
