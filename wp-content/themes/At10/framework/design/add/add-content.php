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
 
global $CORE, $userdata;

	switch(THEME_KEY){
		
		case "es":
		case "da": {
		
			 $title = __("About Me","premiumpress"); 
			 
		} break; 
		
		default: {
		
			$title = __("Description","premiumpress");
		 
		} break;
	
	}
	 


$editID=0;
$content = "";
if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
$content = $CORE->get_edit_data('post_content', $editID);
} 


 
?>

<div class="form-group">
  <div id="textarea_counter" class="text-muted small float-right">
    <span></span>
  </div>
  <input type="hidden" name="textarea_counter_hidden" value="<?php if(is_numeric(_ppt(array('lst', 'descmin' ))) ){ echo _ppt(array('lst', 'descmin' )); }else{ echo 100; } ?>" id="textarea_counter_hidden">
  <?php if(isset($_POST['ajaxedit'])){ ?>
 
 
 
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo $title; ?></h3>
<div class="block-header__divider"></div> 
</div>

  <?php }else{ ?>
  <label class="w-100"><?php echo $title; ?> <span class="text-danger">*</span> 
  
  
  <?php if(is_admin() && isset($_GET['eid']) ){ ?>
  <a href="post.php?post=<?php echo $_GET['eid']; ?>&action=edit" class="btn btn-sm btn-system float-right"><?php echo __("HTML Editor","premiumpress"); ?></a>
  <?php } ?>
  
  </label>
  <?php }
	 
	 
		if( is_admin() && 1 == 2 ){
			 
			
			echo wp_editor( $content, 'editor_post_content', array( 'textarea_name' => 'form[post_content]', 'editor_height' => '250px') ); 
				  
		 }else{
		 
		 
		 if( is_admin() ){
		 //$content = preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', $content);
		 }else{
		// 
		 } 		 
		 $content = preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', stripslashes($content));
		 
		 
		 $content = str_replace("<p>","", $content);
		 $content = str_replace("</p>", PHP_EOL .PHP_EOL, $content);
		 
		 
		?>
  <textarea name="form[post_content]" class="form-control rounded-0 required-field" <?php if(isset($_POST['ajaxedit'])){ ?>style="height:300px;"<?php } ?> tabindex="2" id="field-post_content"><?php echo $content; ?></textarea>
  <?php } ?>
</div>

<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(function_exists('current_user_can') && current_user_can('administrator') && _ppt(array('badges','enable')) == "1" && is_admin() ){
?>
 
 
  <a href="admin.php?page=listingsetup&lefttab=b" class="tiny float-right text-uppercase" target="_blank"><u><?php echo __("Manage Badges","premiumpress"); ?></u></a>
 
 
<div class="block-header mt-4">
<h3 class="block-header__title"><?php echo __("Badges","premiumpress"); ?></h3>
<div class="block-header__divider"></div> 
</div>

<div class=" ppt-badges-small row">
<?php
$myBadges = array();
if(isset($_GET['eid'])){
$myBadges = get_post_meta($_GET['eid'],'badges',true);
}
  
if(!is_array($myBadges) || is_array($myBadges) && empty($myBadges) ){ $myBadges = array(); } 
 
$current_data = get_option("ppt_badges"); 
 
if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ 

if($current_data['name'][$i] == ""){ $i++; continue; }
if(!isset($current_data['key'][$i])){ $i++; continue; }

?>
<div class="col-md-4 mb-4">


<div class="d-flex">

<label class="custom-control custom-checkbox mr-2 mt-2">
        <input onclick="ChekBadge('#b<?php echo $i; ?>');" id="b<?php echo $i; ?>check"  type="checkbox" value="1" class="custom-control-input form-control"  <?php if(in_array($current_data['key'][$i],$myBadges)){ echo "checked=checked"; } ?> />
        
        <span class="custom-control-label">&nbsp;</span>
</label>

<div class="ppt-badges mt-0">
            
<div class="_badge" style="<?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>color:<?php echo $current_data['txtcolor'][$i]; ?>;<?php } ?><?php if(isset($current_data['color'][$i]) && strlen($current_data['color'][$i]) > 1){ ?>background-color:<?php echo $current_data['color'][$i]; ?>;<?php } ?>"> 
    
    
    <?php if(isset($current_data['desc'][$i]) && strlen($current_data['desc'][$i]) > 1){ ?>
    
<div class="badge_tooltip text-center" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> <?php echo $current_data['name'][$i]; ?>
    </div>
    <div class="badge_tooltip__item"><?php echo $current_data['desc'][$i]; ?> </div>
  </div>
  
  <?php }else{ ?>
  <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> 
  <?php echo $current_data['name'][$i]; ?>
  <?php } ?>

</div> 
</div>

</div>
 <input type="hidden" name="badges[<?php echo $current_data['key'][$i]; ?>]" id="b<?php echo $i; ?>add" value="<?php if( in_array($current_data['key'][$i],$myBadges) ){  echo 1; }else{ echo 0; } ?>" class="form-control">
 
</div>


<?php $i++; } } ?>
</div>
<?php } ?>
 <script>
function ChekBadge(div){
		 
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
</script>