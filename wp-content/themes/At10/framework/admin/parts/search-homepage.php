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
 
 global $settings;

 $settings = array(
  "title" => __("Homepage Search Box","premiumpress"), 
  "desc" => __("This section is only used if you have a search box on your homepage.","premiumpress"),
	"back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-9">
          <label><?php echo __("Enable Custom Search","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("This will turn off the default search items and use your selections below.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('searchbox_enable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('searchbox_enable').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'searchbox_enable')), array("","1"))){ ?>on<?php } ?>">
              <div class="yes">
                ON
              </div>
              <div class="switch">
              </div>
              <div class="no">
                OFF
              </div>
            </div>
          </div>
          <input type="hidden" id="searchbox_enable" name="admin_values[design][searchbox_enable]" value="<?php if(in_array(_ppt(array('design', 'searchbox_enable')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
        </div>
      </div>
    </div>
    <div class="bg-light text-center font-weight-bold opacity-5 py-3 mb-4">
      <?php echo __("Select the search fields to show.","premiumpress"); ?>
    </div>
    <div class="row">
      <?php 


$videopak = array(

	1 => array("key" => "keyword", "name" => __("Keyword","premiumpress") ),
	2 => array("key" => "tax_listing", "name" => __("Category","premiumpress") ),
	3 => array("key" => "price", "name" => __("Price","premiumpress") ),
	4 => array("key" => "location", "name" => __("Location","premiumpress") ),
	
	
	
);

$taxonomies = get_taxonomies(); 
foreach ( $taxonomies as $taxonomy ) {
if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','listing','elementor_library_type','elementor_library_category', 'elementor_font_type', 
'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme' 
))){ continue; } 

if(strpos($taxonomy, "wp_") !== false){ continue; }

$videopak[] = array("key" => "tax_".$taxonomy, "name" => $CORE->GEO("translation_tax_key", $taxonomy) );

}

foreach($videopak as $k => $f ){ ?>
      <div class="col-md-4">
        <label class="custom-control custom-checkbox">
        <input type="checkbox" 
        value="0" 
        class="custom-control-input" 
        id="search_<?php echo $f['key']; ?>check" 
        onchange="ChekSeF('#search_<?php echo $f['key']; ?>');"
         
		<?php if( _ppt(array('customsearchbox', $f['key'])) == 1){ ?>checked=checked<?php } ?>>
        <input type="hidden" name="admin_values[customsearchbox][<?php echo $f['key']; ?>]" id="search_<?php echo $f['key']; ?>add" value="<?php if(_ppt(array('customsearchbox', $f['key'])) == 1){ echo 1; }else{ echo 0; } ?>">
        <span class="custom-control-label"><?php echo $f['name']; ?></span> </label>
      </div>
      <?php  } ?>
      <script>
		function ChekSeF(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
    </div>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>