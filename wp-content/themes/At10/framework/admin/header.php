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
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }  global $wpdb, $CORE, $userdata, $CORE_UI; 
   
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$navigation  = $CORE_UI->ppt_admin_navigation();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div id="jumplinks"  style="display:none">
<?php
$added = array("all" => "all");
foreach($navigation as $k => $i){ 
	
	if(isset($added[$k])){ continue; } 
	
	$added[$k] = $k;

?>
  <ul class="child jumplinks-<?php echo $k; ?> nav"></ul>
    
    <?php if(isset($i['p']) && is_array($i['p']) ){ 
	
		foreach($i['p'] as $pk => $pi){ 
			
			if(isset($added[$pk])){ continue; } 
	
			$added[$pk] = $pk;		
		?>
   		<ul class="child jumplinks-<?php echo $pk; ?> nav"></ul>
   	 <?php } 
	
	}	 

} 
?>
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
   
?> 
<div id="page-loading" class="text-center">
<img src="<?php echo CDN_PATH; ?>/images/loading.svg" alt="loading page" style="max-width:150px;" />
</div>
<div id="admin-wrapper" style="display:none;">
             
<!-- END SPINNER -->
<!-- MAIN BODY WRAP -->
<div id="premiumpress-body" style="display:none;">
<div class="wrapper d-flex align-items-stretch ml-n4">
<?php if(isset($_GET['page'] ) && $_GET['page'] == "ASDADAD" ){ // && $_GET['page'] == "premiumpress" ||  $_GET['page'] == "listings"  ||  $_GET['page'] == "orders" ||  $_GET['page'] == "reports" ||  $_GET['page'] == "members" ?>
<ul class="list-unstyled components mb-5 nav flex-column nav-pills" id="jumplinks" style="display:none;"> </ul>
<?php }else{ ?>
<nav id="sidebar">

<!--
   <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn">
      <i class="fa fa-bars text-white"></i>
      <span class="sr-only">Toggle Menu</span>
      </button>
   </div> -->
   
   
<div class="bg-primary px-3 pt-2">



          <div class="d-inline-flex align-self-baseline font-weight-bold">
    <div>
            <a href="admin.php?page=members&eid=<?php echo $userdata->ID; ?>" class="float-left mr-3">
            
            <?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $userdata->ID, "css" => "rounded", "online" => 0, "link" => 0)); ?>
            
            </a>
            </div>
            
            <div class="mt-1 ml-2">
            
			<div class="text-truncate" style="max-width:100px; width:100px;"><?php echo $CORE->USER("get_username", $userdata->ID ); ?></div>
            
             
            <a href="admin.php?page=messages" class="text-light tiny"><?php echo __("messages","premiumpress"); ?></a>
             
            
            </div>
            
            </div>




 
</div> 
 
    
<style>

.ppt-account-nav { margin-left: -1px;    transition: all .2s ease;    transition: all .2s ease;}
.ppt-account-nav .ppt-account-nav-scroll {    position: relative;    height: 100%; }
.ppt-account-nav ul {    padding: 0;    margin: 0;    list-style: none; }
.ppt-account-nav .metismenu {    display: flex;    flex-direction: column; }		
.ppt-account-nav .metismenu.fixed {      position: fixed;      top: 0;      width: 100%;      left: 0; }	  
.ppt-account-nav .metismenu > li {      display: flex;      flex-direction: column; }	  
.ppt-account-nav .metismenu > li a > i { display: inline-block; vertical-align: middle; position: relative; top: 0;line-height: 1;-webkit-transition: all 0.5s;-ms-transition: all 0.5s;transition: all 0.5s;margin-right: 15px; }
.ppt-account-nav .metismenu > li > a {  font-weight: 500;  display: inline-block; font-size: 14px; }
.ppt-account-nav .metismenu > li > a svg {  max-width: 24px; max-height: 24px;  height: 100%; margin-right: 5px; margin-top: -3px; color: #2371b1; }
.ppt-account-nav .metismenu > li > a g [fill] {          fill: #2371b1; }
.ppt-account-nav .metismenu > li:hover > a, .ppt-account-nav .metismenu > li:focus > a {        color: #2371b1; }
.ppt-account-nav .metismenu > li:hover > a g [fill], .ppt-account-nav .metismenu > li:focus > a g [fill] {          fill: #2371b1; }
.ppt-account-nav .metismenu > li.mm-active > a {        color: #2371b1; background:#4b5768; }
.ppt-account-nav .metismenu > li.mm-active > a:before {    left: 0;}
.ppt-account-nav .metismenu > li > a:before {  position: absolute;    height: 100%; width: 7px; background: #2371b1;top: 0; left: -7px;    content: "";    -webkit-transition: all 0.5s;    -ms-transition: all 0.5s;    transition: all 0.5s;}
.ppt-account-nav .metismenu li { position: relative; line-height:30px }
.ppt-account-nav .metismenu ul { transition: all .2s ease-in-out;  position: relative; z-index: 1; padding: 0 0;      background: #4b5768; }
.ppt-account-nav .metismenu ul a {  padding-top: .5rem; padding-bottom: .5rem; position: relative; font-size: 16px;   padding-left: 3.75rem;    font-size: 14px; }
.ppt-account-nav .metismenu ul a:hover, .ppt-account-nav .metismenu ul a:focus, .ppt-account-nav .metismenu ul a.mm-active { text-decoration: none; color: #2371b1; }
.ppt-account-nav .metismenu a { position: relative;  display: block;  padding: 0.625rem 1.875rem; outline-width: 0; color: #111111; text-decoration: none; }
.ppt-account-nav .metismenu .has-arrow:after { width: .5rem; height: .5rem; right: 1.875rem; top: 48%; border-color: inherit;  -webkit-transform: rotate(-225deg) translateY(-50%); transform: rotate(-225deg) translateY(-50%); }
.ppt-account-nav .metismenu .has-arrow[aria-expanded=true]:after,.ppt-account-nav .metismenu .mm-active > .has-arrow:after { -webkit-transform: rotate(-135deg) translateY(-50%);      transform: rotate(-135deg) translateY(-50%); }
.ppt-account-nav .metismenu ul a:hover, .ppt-account-nav .metismenu ul a:focus, .ppt-account-nav .metismenu ul a.mm-active {    text-decoration: none;    color: #2371b1;}
.metismenu .mm-collapse:not(.mm-show) {    display: none;}
.metismenu .has-arrow::after {    position: absolute;    content: "";    width: 0.5em;    height: 0.5em;    border-width: 1px 0 0 1px;    border-style: solid;    border-color: initial;    right: 1em;    transform: rotate(-45deg) translate(0, -50%);    transform-origin: top;    top: 50%;    transition: all .3s ease-out;}
.wp-person a:focus .gravatar, a:focus, a:focus .media-icon img {    color: #043959;    box-shadow: none;    outline: none;}
#sidebar ul li li a { color:#fff; }
</style>

 


 <div class="d-flex align-items-end flex-column h-100" style="background: #384250;">
        <div class="w-100 ppt-account-nav">
   
 
<?php 



?>
   
   
   <div class="ppt-account-nav"> 
 
   
   
		<ul class="metismenu" id="admin-menu">
                
               <?php foreach($navigation as $k => $i){  ?>
               
               
                <li <?php if(isset($_GET['page']) && isset($i['pageopen']) && in_array($_GET['page'], $i['pageopen']) ){ ?> class="mm-active"<?php } ?>>
                
                
                <a class="<?php if(isset($i['l']) && $i['l'] != "" ){ }else{ ?>has-arrow ai-icon<?php } ?>" <?php if(isset($i['l']) && $i['l'] != "" ){ ?>href="<?php echo $i['l']; ?>"<?php }else{ ?>href="javascript:void(0);" aria-expanded="false"<?php } ?>>
							<i class="<?php echo $i['i']; ?>"></i> <span class="nav-text"><?php echo $i['n']; ?></span>
						</a>
                        
                        <?php if(isset($i['p']) && is_array($i['p']) ){ ?>
                        <ul aria-expanded="false">                        
                        <?php foreach($i['p'] as $pk => $pi){ ?>                        
							<li><a href="<?php echo $pi['l']; ?>"><?php echo $pi['n']; ?></a></li>
						<?php } ?>                        
						</ul>
                        <?php } ?>
                    </li>
               
               
               <?php } ?>
               
               
               
 <?php

	// ADD-ON FOR NEW MENU ITEMS
		if(isset($GLOBALS['new_admin_menu']) && is_array($GLOBALS['new_admin_menu']) ){
			$sk = 3.5;
		 
			foreach($GLOBALS['new_admin_menu'] as $newmenu){ 
				foreach($newmenu as $key=>$menu){
				?>
                
                  <li>
         <a href="admin.php?page=<?php echo $key; ?>" class="nav-item nav-link" ><?php echo $menu['title']; ?></a>
         
      </li>
      
       <?php 
				 
					
					$sk = $sk  + 0.1;
				}
			}
		}	

?>
                    
                </ul> 
</div>
   
   
   
   
   
 </div>
 
 
 
 
 
 
        <div class="mt-auto w-100">
  <ul id="jumplinks">
  
  <li>
         <a href="admin.php?page=docs" class="nav-item nav-link <?php if(isset($_GET['page']) && $_GET['page'] == "docs"){ echo "active show"; }  ?>" ><i class="fal fa-book"></i><?php echo __("Docs","premiumpress"); ?> - V.<?php echo THEME_VERSION; ?></a>
         <ul class="child jumplinks-docs" style="display:none;"></ul>
      </li>
      <li>
         <a href="admin.php?page=reports" class="nav-item nav-link <?php if(isset($_GET['page']) && $_GET['page'] == "logs"){ echo "active show"; }  ?>" ><i class="fal fa-signal-alt-3"></i><?php echo __("System Logs","premiumpress"); ?></a>
         <ul class="child jumplinks-reports" style="display:none;"></ul>
      </li>
      
   </ul>


</div>
</div>

</nav>
<?php } ?>
<div id="content" class="position-relative <?php if(isset($_GET['page']) && $_GET['page'] != 'listings' ){ ?>ppt-forms<?php } ?>"



  style="<?php if(isset($_GET['page']) && $_GET['page'] != "premiumpress" ){ ?><?php } ?>max-width:1100px;<?php if(isset($_GET['defaultdesign'])){ ?>display:none!important;<?php } ?>">
<?php if(isset($_GET['page']) && $_GET['page'] != "premiumpress" && !isset($_GET['eid']) && !isset($_GET['tid']) ){ ?>




<div style="top:10px; right:10px;" class="position-absolute">

<a href="admin.php?page=ppt_editor" class=" btn btn-sm btn-dark" ><i class="fa fa-tools"></i> <?php echo __("Site Manager","premiumpress"); ?></a>

<a href="<?php echo home_url(); ?>/?reset=1" class="btn btn-sm btn-system" target="_blank"><?php echo __("Visit Website","premiumpress"); ?> <i class="fa fa-long-arrow-right ml-2"></i></a>

</div>

<?php } ?>

<?php /*if(defined('WLT_DEMOMODE')  && !user_can($userdata->ID, 'administrator')){ ?>
 
<?php } // DEMO MODE*/  ?>

<!-- SAVING SPINNER -->
<div id="saving-spinner" <?php if(!isset($_GET['defaultdesign'])){ ?>style="display:none;"<?php } ?>>
  <div class="text-center mt-5 pt-5"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>
  <div class="mt-3 text-muted text-center">
    <?php echo __("Updating your theme, please wait...","premiumpress"); ?>
  </div> 
</div> 

 
<?php if(get_option('ppt_expired') == "1"){ ?>
<div class="bg-danger text-light p-3 px-4">
    <div class="row">
    <div class="col-md-9 y-middle">
    <div>
     
    <div class="fs-md mb-2 text-600"><?php echo __("Your PremiumPress updates have expired","premiumpress"); ?></div>
    
    <div><?php echo __("Don't miss out on important updates, bug fixes and new features.","premiumpress"); ?></div>
    </div>
    </div>
    <div class="col-md-3">
    <a href="https://www.premiumpress.com/account/" target="_blank" class="btn btn-system list btn-block" data-ppt-btn><?php echo __("Renew Now","premiumpress"); ?></a>
    
    <a href="admin.php?page=settings&lefttab=cleaning" data-ppt-btn class="btn btn-danger list btn-block"><?php echo __("Update Key","premiumpress"); ?></a>
    </div>
    </div>
</div>
<?php } ?>