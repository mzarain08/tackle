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

global $CORE, $CORE_UI, $userdata; $showDashboard = true;
 

ob_start();
_ppt_template( 'framework/design/widgets/list_right4' ); 
$menu_data = ob_get_contents();
ob_end_clean(); 

?>

 
<div ppt-border1 class="mb-4">
  <div class="d-flex" >
    <div style="width:380px; background:red;" class="h-100">
      <div ppt-box style="min-width:300px; margin: -1px;">
        <div class="_header" ppt-flex-row>
          <div class="_title">
            Account Options
          </div>
          <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24">
             sdsd
            </div>
          </div>
        </div>
        <div class="_content p-0">
          <?php

foreach($menu as $m){ 

echo ppt_theme_block_output($menu_data, array("title" => $m['title'], "icon" => $m['icon'] ),array("widget"));

}

?>
        </div>
      </div>
    </div>
    <div style="background:blue;" class="h-100">
    </div>
  </div>
</div>
<img src="http://localhost/a1.jpg" class="img-fluid" ppt-border1 />