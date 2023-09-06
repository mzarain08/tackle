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
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$corePages = $CORE->LAYOUT("get_innerpage_blocks", array());

$corePages['homepage'] = array( "name" => __("Home Page","premiumpress"), "link" => home_url()."/?reset=1", "order" => 1, "icon" => "fa-home", "bgcolor" => "#212548");  

$corePages['login'] = array( "name" => __("Login Page","premiumpress"), "link" => wp_login_url(), "order" => 1.1, "icon" => "fa fa-lock", "bgcolor" => "#483c21");  

$corePages['register'] = array( "name" => __("Register Page","premiumpress"), "link" => wp_registration_url(), "order" => 1.2, "icon" => "fa fa-page", "bgcolor" => "#483c21"); 

$corePages['search'] = array( "name" => __("Search Page","premiumpress"), "link" => home_url()."/?s=", "order" => 2.1, "icon" => "fa-search", "bgcolor" => "#214841");  
 
$corePages['blog'] = array( "name" => __("Blog","premiumpress"), "link" => _ppt(array('links','blog')), "order" => 2.3, "icon" => "fa fa-rss", "bgcolor" => "#483c21");  
 
?>
<div class="card">
    <div class="card-body">   
        <ul class="list-group list-group-flush"> 
            <?php
            foreach($corePages  as $k => $p){
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                <a href="<?php echo $p['link']; ?>"><?php echo $p['name']; ?></a> 
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
