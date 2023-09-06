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
 	 
  $settings = array(
  
  "title" => __("Import Values","premiumpress"), 
  "desc" => __("here you can mass import values for your taxonomy.","premiumpress"), 
  
  "back" => "overview",
  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
 
 
 
 
<div class="card p-3">


<?php

if(isset($_GET['getcats'])){ 


/* =============================================================================
WALKER CLASSES
========================================================================== */

class Walker_CategorySelection2 extends Walker_Category {  

     function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) { global $CORE; 
	 	
		$GLOBALS['thiscatitemid'] = $item->term_id; 
		  
		// CHECK IF WE HAVE AN ICONS
		$image = "";		
		if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) > 1){			
			$image = "<i class='fa ".$GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]."'></i>"; 
		}		 
		
        
		// CHECK IF PARENT CAT IS DISABLED
		$disableParent = "";
		if( $item->parent == 0 ){	
			$output .= "";
		}else{
				$output .= "-";
		}
  	
		// DISPLAY
		$output .= " ".esc_attr( $item->name )."\n";	 
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
        $output .= "";  
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) { global $item;
 	 
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);		
		
 
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent";
	}
	
	
} 
		
		$cats = wp_list_categories(array('walker'=> new Walker_CategorySelection2, 'taxonomy' => $_GET['tax'], 'show_count' => 0, 'hide_empty' => 0, 'echo' => 0, 'title_li' =>  false  ) ); 
		 
		echo "<textarea style='width:500px;height:700px;'>".$cats."</textarea>";


}else{
?>



<form method="post">
<input type="hidden" name="page" value="stores" />   
<input type="hidden" name="toolbox" value="importcats" />   
 
<p class="text-600"><?php echo __("Select Import Taxonomy","premiumpress"); ?></p>
<select class="form-control" name="thistax">
<?php
$taxonomies = get_taxonomies(); 
$i=1;
foreach ( $taxonomies as $taxonomy ) {

if(strpos($taxonomy, "wp_") !== false){ continue; }
?>
<option value="<?php echo $taxonomy; ?>"><?php echo $taxonomy; ?></option>
<?php } ?>
</select>


<p class="mt-4"><?php echo __("Enter a list of values below, separate each value with a new line and start sub categories with a dash (-).","premiumpress"); ?>.</p>

<textarea class="w-100 form-control" id="default-textarea" style="height:400px;" name="cat_import"></textarea>        
          
<button type="submit" class="btn btn-primary mt-4 text-600"><?php echo __("Start Import","premiumpress"); ?></button>   
</form> 

<?php } ?>   

<hr />        
<h6 class="mb-3"><?php echo __("Select Export Taxonomy","premiumpress"); ?></h6>

<div>
<?php
$taxonomies = get_taxonomies(); 
$i=1;
foreach ( $taxonomies as $taxonomy ) {

if(strpos($taxonomy, "wp_") !== false){ continue; }
?>
<span class="p-2 mb-2" style="display:inline-block;"><a href="admin.php?page=stores&lefttab=import&getcats=1&tax=<?php echo $taxonomy; ?>" class="btn btn-system "><?php echo $taxonomy; ?></a></span>
 
<?php } ?>     
</div>   
   
        
    </div>



 
   
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 