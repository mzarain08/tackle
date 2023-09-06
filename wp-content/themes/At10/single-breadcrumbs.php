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

global $CORE, $post, $userdata, $CORE_UI;

  

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$term = wp_get_post_terms($post->ID,"category"); 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div class="border-bottom py-3">
    <div class="container">
    <div class="list-list small letter-spacing-1 arrow">
    <span><a href="<?php echo home_url(); ?>" class="text-dark"><?php echo __("Home","premiumpress"); ?></a></span>
    
    <?php if(_ppt(array('links','blog')) != ""){ ?>
      <span><a href="<?php echo _ppt(array('links','blog')); ?>" class="text-dark"><?php echo __("Blog","premiumpress"); ?></a></span>
   <?php } ?>
    
    
    <?php if(isset($term[0]->parent) && $term[0]->parent != 0){
    
        $sub = get_term_by( 'id', $term[0]->parent, 'category' ); 
     
        if(isset($sub->term_id)){ 
        
            if(isset($sub->parent) && $sub->parent != 0){
        
                $subsub = get_term_by( 'id', $sub->parent, 'category' );
        
                if(isset($subsub->term_id)){ ?>
           
                    <span><a href="<?php echo get_term_link($subsub->term_id,"category"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $subsub); ?></a></span>
            
                <?php } 
        
        } ?>
           
        <span><a href="<?php echo get_term_link($sub->term_id,"category"); ?>" class="text-dark"><?php  echo $CORE->GEO("translation_tax_with_termdata", $sub);  ?></a></span>
            
        <?php }
        
         }
         
         if(isset($term[0]->term_id)){ ?>
       
    <span><a href="<?php echo get_term_link($term[0]->term_id,"category"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $term[0]); ?></a></span>
        
    <?php } ?> 
    
    </div>
    </div>
</div> 