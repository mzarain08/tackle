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
  
	
// LANGUAGES
$languages =  $CORE->GEO("get_languagelist",array()); 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="p-5">
<?php if(is_array($languages) && !empty($languages)){ ?>

<?php foreach($languages as $h){ ?>

<a class="btn btn-system btn-lg mb-4" href="<?php echo $h['link']; ?>"><i class="<?php echo $h['icon']; ?> mr-2 mt-2"></i> <?php echo $h['name']; ?></a>

<?php } ?>         


<?php } ?>
</div>