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
     
// GET DATA
$g = $CORE->LAYOUT("load_all_by_cat",  $_POST['tid']);
if(isset($_GET['tid']) && in_array($_GET['tid'], array('text','icon','listings','header','cta','contact','video','faq'))){
			$order = array_column($g, 'order'); 
   			array_multisort( $order, SORT_ASC, $g);
}	   
 ?>

<div class="row">
<?php foreach($g as $k => $g){  

if(!isset($g['widget'])){ continue; }
if(isset($g['copy'])){ continue; }

if(is_array($g['cat'])){
//print_r($g['cat']);
}
 
?>
	<div class="col-md-6 mb-4">
            <div class="p-3 rounded-lg" ppt-border2>
            <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $_POST['tid']; ?>&sid=<?php echo $k; ?>" target="_blank">
             <img src="<?php echo $CORE->LAYOUT("get_block_prewview", $k  ); ?>" class="img-fluid lazy w-100 shadow-sm" /> 
             </a>
             
             <div class="text-600 mt-1 fs-sm"><?php echo $g['name']; ?></div>
             
             </div>
</div>
<?php }?>	
</div>
