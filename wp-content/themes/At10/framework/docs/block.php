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

 
global $CORE, $CORE_UI, $userdata;

$menu = array();

 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['blockid'])){ 

// GET DATA
$g = $CORE->LAYOUT("load_all_by_cat",  $_POST['blockid']);

 
$order = array_column($g, 'order'); 
array_multisort( $order, SORT_ASC, $g);
 	   

//echo $CORE->LAYOUT("get_block_prewview", $k  );
 ?>
<div class="container">
 
<?php foreach($g as $k => $g){  

	if(!isset($g['widget'])){ continue; }
	 
	?>
	
 
<section class="position-relative sectionid-<?php echo $k; ?>" data-nav-title="<?php echo $g['name']; ?>"> 
<div class="my-4">

<div ppt-flex-between> 

	<div class="text-700">
	<a href="<?php echo home_url(); ?>?ppt_live_preview=1&tid=<?php echo $_POST['blockid']; ?>&sid=<?php echo $k; ?>" class="text-dark" target="_blank"><?php echo $g['name']; ?></a>
	</div> 
     <div class="filterToggle"> 
    <div class="d-flex  toggle-me" onclick="_docsToggleHTML('<?php echo $k; ?>');">
     
    <svg aria-hidden="true" data-icon="toggle-on" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-on">
    <path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zm0 320c-70.8 0-128-57.3-128-128 0-70.8 57.3-128 128-128 70.8 0 128 57.3 128 128 0 70.8-57.3 128-128 128z" class="text-success"></path>
    </svg>
    
    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-off">
    <g class="fa-group"><path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zM192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class=""></path>
    <path fill="currentColor" d="M192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class="text-light"></path></g>
    </svg>
    
      <div>Show HTML code</div>
    </div>
    </div> 
    
    </div> 

</div> 
 
	<div class=" border my-4 code-wrapper-display" ppt-border1>
	<?php
		$html = "";
		ob_start();
		do_action( $k );
		$html = ob_get_contents();
		 
		//ob_end_clean();
		//ob_flush();
		echo do_action( $k."-css" );
		echo do_action( $k."-js" );
		 
	?>
	</div>  
    
  <div class="hide code-wrapper" style="display:none;"><?php echo _docsDisplayCode($html, 1); ?></div>
 
</section>
	<?php
	
	}
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>