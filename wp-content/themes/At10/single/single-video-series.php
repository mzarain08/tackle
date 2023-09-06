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

global $CORE, $userdata, $CORE_UI, $post;

$links = array();
$series = get_post_meta($post->ID,"series",true);



$i = 1; 
while($i< 18){ 
	if(isset($series[$i]) && strlen($series[$i]) > 1 ){
		$links[] = $series[$i];
	}
	$i++; 
} 

if(defined('WLT_DEMOMODE')){
$links[] = array("link" => "#" );
$links[] = array("link" => "#" );
$links[] = array("link" => "#" );
$links[] = array("link" => "#" );
}
 
if(!empty($links)){
?>
<div ppt-box class="rounded p-3">
<div class="container mt-n3">
<div class="row">

<?php $i=1; foreach($links as $link){ ?>

<div class="col-md-2 mt-4"><span class="p-1 rounded-lg text-600 btn-block text-center" ppt-border1>
<a href="<?php if(is_array($link)){ echo "#"; }else{ echo $link; } ?>" <?php if(defined('WLT_DEMOMODE')){?> onclick="alert('Disabled in demo mode.');" <?php } ?> class="text-dark link-dark"><?php echo __("Episode","premiumpress"); ?> <?php echo $i; ?></a>
</span></div>

<?php $i++;  }   ?>

</div> 
 </div>
</div>
<?php } ?>