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
   
   global $CORE, $userdata, $settings, $post; 
 
   ?>

<div class="card card-blog">
<div class="card-header bg-primary text-light text-600"><span><?php echo __("Popular Categories","premiumpress"); ?></span></div>
  <div class="card-body">
    
    <ul class="storelist popular">
      <?php
 
			 	  
					$args =  array('taxonomy' => 'listing', 'orderby'  => 'term_order', 'order' => 'asc', 'hide_empty' => true, 'parent' => 0, 'number' => 9  ); 
					$term_query = new WP_Term_Query( $args );
					$categories = array();
					if ( ! empty( $term_query->terms ) ) {
						foreach ( $term_query ->terms as $term ) {
							$categories[] = $term;
						}
					}
 
				     
                     $i=1;
                     foreach ($categories as $category) { 
                     
                             // HIDE PARENT
                            if($category->parent != 0){ continue; }
               		
               				if($i > 4){ continue; }
                            
                             
                             // LINK 
                             $link = get_term_link($category);
							 
							// ICON
							$image = do_shortcode('[CATEGORYIMAGE term_id="'.$category->term_id.'" big=1 pathonly=1 placeholder=1]');
							
							// TITLE
							$title = $CORE->GEO("translation_tax_with_termdata", $category);
							 
                             
                     ?>
      <li class="clearfix">
        <div class="store text-left">
          <a href="<?php echo $link; ?>" class="text-dark">
          <div class="image bg-white position-relative rounded" style="height:60px;">
            <div class="bg-image" data-bg="<?php echo $image; ?>"></div>
          </div>
          <div class="content text-left">
            <h6><?php echo $title; ?></h6>
            <div class="text-uppercase tiny opacity-8"><?php echo str_replace("%s", $category->count ,__("%s coupons","premiumpress")); ?></div>
          </div>
          </a>
        </div>
      </li>
      <?php $i++; } ?>
    </ul>
    <div class="clearfix">
    </div>
    <ul class="storelist-text mt-3">
      <?php
               $i=1;
               foreach ($categories as $category) { 
               
                       // HIDE PARENT
                       if($category->parent != 0){ continue; }
               
               if($i < 4){ $i++; continue; }
			   
			   	if($i > 21){ continue; }
                   
                       
                       // LINK 
                       $link = get_term_link($category);
                       
               ?>
      <li> <a href="<?php echo $link; ?>"  class="text-dark">
        <div class="store-name">
          <i class="fa fa-chevron-right"></i> <?php echo $category->name; ?>
        </div>
        </a> </li>
      <?php $i++; } ?>
    </ul>
    <div class="clearfix">
    <?php if(strlen(_ppt(array('links','categories'))) > 1){ ?>
    <div>
     <a href="<?php echo _ppt(array('links','categories')); ?>" class="btn btn-system mt-2 btn-sm w-100"> <?php echo __("All Categories","premiumpress") ?> </a>
      
    </div>
    <?php } ?>
    
    </div>
  </div>
</div>