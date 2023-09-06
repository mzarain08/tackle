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


if(in_array(THEME_KEY , array("xxx"))){  

$editID=0;

if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
$editID = $_GET['eid'];
} 
 
?>

<div class="form-group">
  <input type="hidden" name="excerpt_counter_hidden" value="90" id="excerpt_counter_hidden">
  <div id="excerpt_counter" class="text-muted small float-right"><span></span></div>
  <label>
  <?php 
		
		if(THEME_KEY == "es"){ 
		
		echo __("Special tag line.","premiumpress");
		
	 		
		}elseif(THEME_KEY == "ll"){ 
		
		echo __("A few words to explain the course content.","premiumpress");
		
		
		}else{
		echo __("How would you describe yourself in one sentence?","premiumpress");
		
		} 
		
		?>
  <?php if(_ppt(array('lst', 'require_except')) == 1){ ?><span class="text-danger">*</span><?php } ?>
  
   </label>
  <input name="form[post_excerpt]" class="form-control rounded-0 <?php if(_ppt(array('lst', 'require_except')) == 1){ ?>required-field<?php } ?>" tabindex="2" id="field-post_excerpt" placeholder="<?php if(THEME_KEY == "da"){  echo __("I'm tall, dark and mysterious. Contact me now to learn more :-)","premiumpress"); } ?>" value="<?php if(isset($_GET['eid'])){  echo preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', $CORE->get_edit_data('post_excerpt', $_GET['eid'])); }?>">
</div>

<?php } ?>