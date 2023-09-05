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

global $CORE;
 
 
global $settings, $CORE, $CORE_ADMIN;

 
	
$letters = range('A', 'Z');
	 
  $settings = array(
  
  "title" => __("Stores &amp; Categories","premiumpress"), 
  "desc" => __("This will delete all existing values. This cannot be undone.","premiumpress"), 
  
  "back" => "overview",
  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
 
 
 
 
<div class="card p-3">

 
<?php
$taxonomies = get_taxonomies(); 
$i=1;
foreach ( $taxonomies as $taxonomy ) {

	if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format', 'elementor_library_type','elementor_library_category', 'elementor_font_type', 
	
	'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme',
	
	'make','model'
	 
	))){ continue; } 
	
	
	if(strpos($taxonomy, "wp_") !== false){ continue; }

	$icon = _ppt(array('taxicon', $taxonomy));
	if($icon == ""){
	$icon = ppt_default_tax_icon($taxonomy);
	} 
	
	$name = $taxonomy;;
	if(_ppt(array('taxcaption', $taxonomy)) != ""){ 
	 $name = _ppt(array('taxcaption', $taxonomy));
	}


?>

<a href="javascript:void(0)" onclick="jQuery('.btn-delete-<?php echo $taxonomy; ?>').trigger('click');" class="_admin_iconbox icon-box" >
<i class="fa fa-trash"></i><strong> <?php echo  str_replace("listing", __("categories","premiumpress"),$name); ?></strong>
<p><?php echo __("Here you can delete all values for this taxonomy.","premiumpress"); ?></p>

</a>
<form method="post" action="admin.php?page=stores" class=" confirm">
            <input type="hidden" name="page" value="stores" />
            <input type="hidden" name="toolbox" value="delete_tax" />
             <input type="hidden" name="tax" value="<?php echo $taxonomy; ?>" />
             <button class="btn-delete-<?php echo $taxonomy; ?>" type="submit" style="display:none;"></button>
 </form>

<?php } ?>

 
</div>
   
  
  
  
 
   
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 