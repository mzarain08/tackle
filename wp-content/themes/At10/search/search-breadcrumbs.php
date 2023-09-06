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

  
if(isset($GLOBALS['flag-taxonomy'])){

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>


    <div class="container">
    
    
    <nav ppt-nav class="spacing seperator crumbs small pl-0">
    <ul>
    <li><a href="<?php echo home_url(); ?>" class="text-dark"><?php echo __("Home","premiumpress"); ?></a></li>
    
    <?php if(isset($term->term_id) && $term->taxonomy == "store" &&  _ppt(array('links','stores')) != "" ){ ?>
    
      <li><a href="<?php echo _ppt(array('links','stores')); ?>" class="text-dark"><?php if(in_array(THEME_KEY,array("es"))){ echo __("All Agencies","premiumpress");  }else{  echo __("All Stores","premiumpress"); } ?></a></li>
      
   <?php } ?>
   
    <?php if(isset($term->term_id) && $term->taxonomy == "country"  ){ ?>
    
      
      <?php if($term->parent != 0){ ?>
      <li>
      <?php $parent  = get_term_by( 'id', $term->parent, "country" );  ?>
      <a href="<?php echo get_term_link($parent->term_id,"country"); ?>"><?php echo $parent->name; ?></a>
	  </li>
      
      
      <?php } ?>
	  
	  
      
   <?php } ?>

   
      
   <?php if(isset($term->term_id) && $term->taxonomy == "listing" &&  _ppt(array('links','categories')) != "" ){ ?>
      <li><a href="<?php echo _ppt(array('links','categories')); ?>" class="text-dark"><?php echo __("All Categories","premiumpress"); ?></a></li>
   <?php } ?>
    
    
    <?php if(isset($term->parent) && $term->parent != 0){
    
        $sub = get_term_by( 'id', $term->parent, 'listing' ); 
     
        if(isset($sub->term_id)){ 
        
            if(isset($sub->parent) && $sub->parent != 0){
        
                $subsub = get_term_by( 'id', $sub->parent, 'listing' );
        
                if(isset($subsub->term_id)){ ?>
           
                    <li><a href="<?php echo get_term_link($subsub->term_id,"listing"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $subsub); ?></a></li>
            
                <?php } 
        
        } ?>
           
        <li><a href="<?php echo get_term_link($sub->term_id,"listing"); ?>" class="text-dark"><?php  echo $CORE->GEO("translation_tax_with_termdata", $sub);  ?></a></li>
            
        <?php }
        
         }
		 
		  
         
         if(isset($term->term_id)){ ?>
       
    <li><a href="<?php echo get_term_link($term->term_id, $term->taxonomy); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $term); ?></a></li>
        
    <?php } ?> 
    </ul>
    </nav>
    </div>
 

<?php } ?>