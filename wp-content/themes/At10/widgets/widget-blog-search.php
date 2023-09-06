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
   
   global $CORE, $userdata, $settings, $post; 
   
 
   
   if(!_ppt_checkfile("widget-blog-search.php")){
   ?>

<div class="card-blog ppt-forms forms-nowhitebg" ppt-border1>
<div class="card-header bg-primary text-light text-600"><span><?php  echo __("Search","premiumpress"); ?></span></div>
  <div class="card-body">
  
    
 
    
    <form action="<?php echo _ppt(array('links','blog')); ?>/" method="get">
      <div class="position-relative mb-2">
        <input type="text" class="form-control" name="keyword" placeholder="<?php  echo __("Keyword..","premiumpress"); ?>">
        <button type="submit" class="iconbit btn"><i class="fa fa-search"></i></button>
      </div>
    </form>
  </div>
</div>
<?php } ?>
