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
 
	if(!in_array(THEME_KEY, array("cp")) ){ return ""; }
   
   ?>

<div class="mb-4 rounded"  ppt-box>

<div class="_header">

<div class="_title bg-primary text-light"><?php echo __("Popular Stores","premiumpress"); ?></div>

</div>

<div class="_content pb-3">
 
<div class="row mt-n2">
      <?php
 
			 	  
					$args =  array('taxonomy' => 'store', 'orderby'  => 'term_order', 'order' => 'asc', 'hide_empty' => true, 'parent' => 0, 'number' => 14  ); 
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
                              
                             if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
                             $caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
                             }else{
                             $caticon = "fa fa-check";
                             }
							    
                             // LINK 
                             $link = get_term_link($category,"store");
							 
							 // ICON
							$image = do_shortcode('[CATEGORYIMAGE term_id="'.$category->term_id.'" pathonly=1 placeholder=1 tax="store"]');
							
							// TITLE
							$title = $CORE->GEO("translation_tax_with_termdata", $category);
                             
                     ?>
                     

<div class="col-6">
<a href="<?php echo $link; ?>" class="text-dark">
<div class="image bg-white mt-4 rounded shadow-sm border">
<div class="position-relative overflow-hidden"  style="height:50px;">
<div class="bg-image" data-bg="<?php echo $image; ?>" style="background-size: contain!important;background-repeat: no-repeat;"></div>
</div>
</div>
</a>
</div>         
                     
 
      
      <?php $i++; } ?>
  
 
    </div>
   
  </div>
</div>