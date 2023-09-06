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

if(in_array(_ppt(array('design','breadcrumbs')), array("","1"))){

$term = wp_get_post_terms($post->ID,"listing");
$country = do_shortcode("[COUNTRY]");
$city = do_shortcode("[CITY]");
  
?>

<div class="border-bottom py-3">
  <div class="container">
    <div class="list-list small letter-spacing-1 arrow">
      <span><a href="<?php echo home_url(); ?>" class="text-dark"><?php echo __("Home","premiumpress"); ?></a></span>
      <?php if( in_array(THEME_KEY,array("da","es")) ){ 


$gender = wp_get_post_terms($post->ID,"dagender");
if(isset($gender[0])){
?>
      <span><a href="<?php echo get_term_link($gender[0]->term_id,"dagender"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $gender[0]); ?></a></span>
      <?php
} } ?>
      <?php if(!empty($term)){ $i=1; foreach($term as $cat){ if(defined('WLT_DEMOMODE') && $i> 3) { continue; }  if($cat->parent != "0"){ continue; }
	  ?>
      <span><a href="<?php echo get_term_link($cat->term_id,"listing"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $cat); ?></a></span>
      <?php $i++;} } ?>
      <?php if(!empty($term)){ $i=1; foreach($term as $cat){ if(defined('WLT_DEMOMODE') && $i> 3) { continue; } if($cat->parent == "0"){ continue; } ?>
      <span><a href="<?php echo get_term_link($cat->term_id,"listing"); ?>" class="text-dark"><?php echo $CORE->GEO("translation_tax_with_termdata", $cat); ?></a></span>
      <?php $i++;} } ?>
      <?php /*
<?php if(strlen($country) > 1){ ?>  
  <span><a href="<?php echo home_url(); ?>/?s=&country=<?php echo $country; ?>"><?php echo $country; ?></a></span>
<?php } ?>
      
<?php if(strlen($city) > 1){ ?>  
  <span><a href="<?php echo home_url(); ?>/?s=&city=<?php echo $city; ?>"><?php echo $city; ?></a></span>
<?php } ?>
*/ ?>
    </div>
  </div>
</div>
<?php } ?>