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

$tags = get_terms("post_tag", array('number' => 45, 'orderby' => 'count', 'order' => 'desc'));


?>

<div class="position-relative filter-keyword">

  <input type="text" class="form-control customfilter typeahead" name="keyword" id="keyword" data-type="text" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?> data-key="keyword" autocomplete="off"  data-formatted-text="<?php echo __("Keyword","premiumpress"); ?>" placeholder="<?php echo __("Keyword..","premiumpress"); ?>" value="<?php if(isset($_GET['s'])){ echo esc_attr($_GET['s']); } ?>">
  
   
  <button class="btn iconbit" type="button" onclick="_filter_update()" style="position:absolute; top:10px; right:10px;" ><i class="fal fa-search"></i></button>
  
  
</div>

<?php if(!isset($_POST['sidebar'])){ ?>
<button class="btn-primary mt-3" data-ppt-btn onclick="_filter_update()"><?php echo __("Update","premiumpress"); ?></button>
<?php } ?>
<?php 

/*

if (!empty($tags)) {  ?>
<div class="text600"><?php echo __("Popular keywords..","premiumpress"); ?></div>

<?php

foreach( $tags as $tag){
?>
<a href="<?php echo  home_url()."/?s=".$tag->name; ?>" data-ppt-btn class="btn btn-primary btn-sm"><?php echo $tag->name; ?></a>
 
<?php } } 


 

<script>



jQuery(document).ready(function(){ 


jQuery("<script/>",{type:'text/javascript', src: CNDPath + 'js/js.plugins-typeahead.js'}).appendTo('head');
			
			setTimeout( function(){ 

	jQuery("input.typeahead").typeahead({	
													
						onSelect: function(item) { 
						  window.location = item.extra;
						},
						ajax: {
							
							url: ajax_site_url,
							timeout: 500,
							triggerLength: 1,
							dataType: 'json',			
							method: "POST",	
							
							data: {
								search_action: "search_live",
								search_data: jQuery(".typeahead").val(), 
							},
							preDispatch: function (query) { 
								return {
									search: query,
									search_action: "search_live",
								}
							},
							preProcess: function (data) {
							 
								if (data.success === false) {
									 
									return false;
								}
							 
								return data.mylist;
							}
						},	
					}); 
					
					
			}  , 3000 );  			
});
</script>

*/

?>