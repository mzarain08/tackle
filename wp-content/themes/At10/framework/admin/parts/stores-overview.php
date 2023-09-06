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
 
 
global $settings;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Category Manager","premiumpress"), 
  "desc" => __("Here you can manage all of the taxonomies for your website.","premiumpress"),
  
  //"doclink" => "https://www.premiumpress.com/docs/users/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


	$numTerms = wp_count_terms( 'listing', array(
    'hide_empty'=> false,
    'parent'    => 0
	) );
 
?>

<style>
#overview-box, #d-box, #del-box, #import-box {
	display:none;
}
</style>

<?php /*
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#l-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-map-marker"></i><strong><?php echo __("City Search","premiumpress"); ?></strong>
<p><?php echo __("Here you can turn on the city taxonomy search.","premiumpress"); ?></p></a>


</div>*/ ?>

<?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp"))){ ?>
<div class="card p-3">

<a href="edit-tags.php?taxonomy=store&post_type=listing_type" class="_admin_iconbox icon-box">
<i class="fal fa-tag"></i><strong><?php echo __("Manage Stores","premiumpress"); ?></strong>
<p><?php echo __("This link will take you to the WordPress store manager.","premiumpress"); ?></p></a>


<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#d-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-align-left"></i><strong><?php echo __("Demo Stores","premiumpress"); ?></strong>
<p><?php echo __("Here you can turn on/off demo store data.","premiumpress"); ?></p></a>

 
</div>
<?php } ?>


<?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("dl")) || _ppt(array('lst','makemodels')) == '1' ){ ?>
<div class="card p-3">

<a href="#" onclick="jQuery('#makes-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-car"></i><strong><?php echo __("Import Makes &amp; Models","premiumpress"); ?></strong>
<p><?php echo __("Here you can bulk import categories into your website.","premiumpress"); ?></p></a>

 
 
</div>
<?php } ?>
 

<div class="card p-3">

<a href="edit-tags.php?taxonomy=listing&post_type=listing_type" class="_admin_iconbox icon-box">
<i class="fal fa-folder-tree"></i><strong><?php echo __("Categories","premiumpress"); ?> <span class="badge badge-success"><?php echo $numTerms; ?></span></strong>
<p><?php echo __("Here you can add/edit values for this taxonomy.","premiumpress"); ?></p></a>

<?php
$taxonomies = get_taxonomies(); 
$i=1;
foreach ( $taxonomies as $taxonomy ) {

	if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','listing','elementor_library_type','elementor_library_category', 'elementor_font_type', 
	
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
	
	$numTerms = wp_count_terms( $taxonomy, array(
    'hide_empty'=> false,
    'parent'    => 0
	) );


?>

<a href="edit-tags.php?taxonomy=<?php echo $taxonomy; ?>&post_type=listing_type" class="_admin_iconbox icon-box" >
<i class="<?php echo $icon; ?>"></i><strong><?php echo $name; ?> <span class="badge badge-success"><?php echo $numTerms; ?></span></strong>
<p><?php echo __("Here you can add/edit values for this taxonomy.","premiumpress"); ?></p></a>


<?php } ?>

 
</div>

<div class="card p-3">
 
<a href="admin.php?page=settings&lefttab=taxonomies" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-tools"></i><strong><?php echo __("Manage Taxonomies","premiumpress"); ?></strong>
<p><?php echo __("Change the name, icons, display and add new taxonomies here.","premiumpress"); ?></p></a>

</div>
 

<div class="card p-3">
 
<a href="edit.php?post_type=listing_type&page=to-interface-listing_type" class="_admin_iconbox icon-box" style="border-bottom:0px;">
<i class="fal fa-sync"></i><strong><?php echo __("Change Display Order","premiumpress"); ?></strong>
<p><?php echo __("Here you can change the display order for all taxonomies.","premiumpress"); ?></p>
</a>

</div>
 
<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#import-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-tags"></i><strong><?php echo __("Bulk Import/Export","premiumpress"); ?></strong>
<p><?php echo __("Here you can bulk import taxonomy values.","premiumpress"); ?></p></a>
 
 
</div>

<div class="card p-3">

<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('#del-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });" style="border-bottom:0px;">
<i class="fal fa-times"></i><strong><?php echo __("Bulk Delete","premiumpress"); ?></strong>
<p><?php echo __("Here you can bulk delete taxaonomy values.","premiumpress"); ?></p></a>
 
 
</div>



<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>