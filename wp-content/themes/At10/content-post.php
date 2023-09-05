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
   
   if(!_ppt_checkfile("content-post.php")){
   
   global $CORE, $post;
   
   if(!isset($GLOBALS['blogcount'])){ $GLOBALS['blogcount'] = 1; }else{ $GLOBALS['blogcount']++; }
    
    
   $day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
   $month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
   $year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));
   $date 	= $post->post_date;
 
   
   //$g = wp_get_post_terms($post->ID,"category"); 
   
   if( defined('WLT_DEMOMODE') ){
   	 $img =  do_shortcode('[IMAGE pathonly=1]');
   }else{
	   $img = get_the_post_thumbnail_url($post->ID);
	   if(strlen($img) < 4){
	   $img = CDN_PATH."images/nophoto.jpg";
	   }
   }
    
   
   ?>
   
<div class="card-blog-post p-3 p-lg-4 mb-4 " ppt-border1>
   <div class="row d-md-flex <?php if($GLOBALS['blogcount']%2){ ?>flex-md-row-reverse<?php } ?>">
      
      <div class="col-3 col-lg-5">
            <a href="<?php echo get_permalink($post->ID); ?>">
            <img data-src="<?php echo $img; ?>" alt="<?php echo strip_tags($post->post_title); ?>" class="img-fluid lazy mb-4 mb-md-0 w-100 rounded" ppt-border1>  
            </a>
      </div>
      
      <div class="col p-lg-4">
      
    <h3 class="lh-40 mb-sm-3">
            <a href="<?php echo get_permalink($post->ID); ?>" class="text-decoration-none text-black text-500"><?php echo do_shortcode('[TITLE]'); ?></a>
         </h3>
      
      
         <div class="d-flex justify-content-between justify-content-md-start mb-md-4">
            <span class="text-muted">
            <i class="fal fa-folder-open"></i> 
            <?php the_category(' &bull; '); ?>
            </span>
            <span class="text-muted ml-3">
            <i class="fal fa-clock"></i> 
            <time datetime="<?php echo $date; ?>"><?php echo $month; ?> <?php echo $day; ?></time>
            </span>
         </div>
      
         <div class="opacity-8 text-black hide-mobile mb-0 pb-0"><?php echo substr(strip_tags($post->post_content),0,100); ?>... <u><a class="text-primary" href="<?php echo get_permalink($post->ID); ?>"><?php echo __("read more","premiumpress"); ?></a></u></div>
         
      </div>
   </div>
</div>
<?php } ?>