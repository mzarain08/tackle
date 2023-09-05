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

global $CORE, $userdata, $post, $settings; 

 
?>

<div class="tax_wrapper membership">
<?php	
 
$ratings = array(
	"" 			=> array( "name" => __("All Access","premiumpress") ),
	"loggedin" 	=> array( "name" => __("Members Only","premiumpress") ),		
	"subs" 		=> array( "name" => __("Members With Subscriptions","premiumpress") ), 
);


// GET ALL MEMBERSHIPS
if(_ppt(array('mem','enable')) == "1"){		
	$all_memberships = $CORE->USER("get_memberships", array());
	foreach($all_memberships  as $key => $m){
		$ratings[$m['key']] = array( "name" => $m['name'] );
	} 		
}

foreach($ratings as $s => $r){
?>
<div onclick="updateratingmembership('<?php echo $s; ?>'); jQuery('.membership .on').removeClass('on'); jQuery(this).toggleClass('on');">
<?php echo $r['name']; ?>
</div>
<?php } ?>
</div> 
      
<script>
function updateratingmembership(g){	 	 
	jQuery('#amembership').val(g).addClass('customfilter');
	_filter_update();
}
</script>

<input type="hidden" id="amembership" class="hidden" data-formatted-text="<?php echo __("Membership","premiumpress"); ?>" name="access" data-type="text" data-key="access" value="">