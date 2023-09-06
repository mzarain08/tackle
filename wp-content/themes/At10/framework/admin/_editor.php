<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $CORE_UI, $userdata;
 
 
 
?> 
<style>

/*
-------------------------------------
*/
body {
    background: #f7f7f7!important;
}
html.wp-toolbar {    padding-top: 0px; }
#wpadminbar, #adminmenuback, #adminmenuwrap { display:none; }
#wpcontent, #wpfooter {    margin-left: 0px;}
#wpcontent {    padding-left: 0px;}
#wpwrap {    height: 100%; }
#wpbody-content {
    padding-bottom: 0;
    float: none;
    width: 100%;
    overflow: visible;
    display: block;
    height: 100%;
	min-height:100%;
}
#wpbody {    position: relative;    height: 100%;}
@media screen and (max-width: 782px){
	.auto-fold #wpcontent {
		position: relative;
		margin-left: 0;
		padding-left: 10px;
	}
} 
	
/*
-------------------------------------
*/	
.ppt_editor_open .editor_panel{right:0;left:inherit;z-index:999999}.editor_panel{background-color:#fafafa;width:340px;height:100%;padding:0;display:flex;flex-direction:column;flex-shrink:0;position:fixed;top:0;box-sizing:border-box;right:-360px;left:inherit;z-index:9999;transition:all .3s cubic-bezier(.215, .61, .355, 1) 0s;box-shadow:rgb(0 0 0 / 40%) 0 0 9px}.editor_panel_wrap{height:100%;display:flex;flex-direction:column;position:relative}
.editor_panel_title{padding:25px 15px;width:100%; background:#212121!important}
.editor_panel_title .componentTitle{font-size:18px;line-height:1;width:100%;margin:0;text-align:center;display:flex;-webkit-box-pack:center;justify-content:center}.editor_panel_footer{width:100%;padding:25px;display:flex;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;background-color:#fff;border-top:1px solid #eee}
 
 
/*
-------------------------------------
*/
.ppt-scroll  {  position: relative;  width: 100%;  overflow: auto;}
.ps{overflow:hidden!important;overflow-anchor:none;-ms-overflow-style:none;touch-action:auto;-ms-touch-action:auto}.ps__rail-x{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;height:15px;bottom:0;position:absolute}.ps__rail-y{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;width:15px;right:0;position:absolute}.ps--active-x>.ps__rail-x,.ps--active-y>.ps__rail-y{display:block;background-color:transparent}.ps--focus>.ps__rail-x,.ps--focus>.ps__rail-y,.ps--scrolling-x>.ps__rail-x,.ps--scrolling-y>.ps__rail-y,.ps:hover>.ps__rail-x,.ps:hover>.ps__rail-y{opacity:.6}.ps .ps__rail-x.ps--clicking,.ps .ps__rail-x:focus,.ps .ps__rail-x:hover,.ps .ps__rail-y.ps--clicking,.ps .ps__rail-y:focus,.ps .ps__rail-y:hover{background-color:#eee;opacity:.9}.ps__thumb-x{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,height .2s ease-in-out;-webkit-transition:background-color .2s linear,height .2s ease-in-out;height:6px;bottom:2px;position:absolute}.ps__thumb-y{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,width .2s ease-in-out;-webkit-transition:background-color .2s linear,width .2s ease-in-out;width:6px;right:2px;position:absolute}.ps__rail-x.ps--clicking .ps__thumb-x,.ps__rail-x:focus>.ps__thumb-x,.ps__rail-x:hover>.ps__thumb-x{background-color:#999;height:11px}.ps__rail-y.ps--clicking .ps__thumb-y,.ps__rail-y:focus>.ps__thumb-y,.ps__rail-y:hover>.ps__thumb-y{background-color:#999;width:11px}@supports (-ms-overflow-style:none){.ps{overflow:auto!important}}@media screen and (-ms-high-contrast:active),(-ms-high-contrast:none){.ps{overflow:auto!important}}
 
/*
-------------------------------------
*/
.ppt-nav-wrap { border-bottom: 1px solid #ffffff; margin-bottom: 20px;  }
.ppt-tabs { margin-left:-20px; margin-right:-20px; margin-top:-20px; border-bottom: 1px solid #efefef;  font-size: 14px;    text-transform: uppercase;    font-weight: 500;    line-height: 30px;  }
.ppt-tabs li { margin:0px; }
.ppt-nav-wrap .nav-tabs .nav-link { color:#333333; text-shadow: 1px 1px #fff; }
.ppt-nav-wrap .nav-tabs .nav-link.active {
        color: #2371b1;
    background-color: #fafafa;
       border-color: #fafafa #fafafa #e8e8e8;
	   font-weight:bold;
 
}
.ppt-nav-wrap .nav-tabs .nav-link:focus, .ppt-nav-wrap .nav-tabs .nav-link:hover {   box-shadow:none!important; border:0px!important;}
.ppt-nav-wrap a:focus  { box-shadow:none!important; border:0px!important; }

.ppt-nav-wrap .nav-item:focus, .ppt-nav-wrap .nav-item:focus-visible, nav-link:focus-visible {
  outline: none!important;
  box-shadow: none;
}
 
/*
-------------------------------------
*/
.ppt-iframe-wrap { height:100%;      }
@media (min-width: 1300px){
.ppt_editor_open  .ppt-iframe-wrap { margin-right:350px;  }
}

 

._title { font-size:14px; font-weight:500; } 

.fieldset{border:1px solid #ddd;padding:22px 0 16px 28px;margin-bottom:20px;position:relative;border-radius:4px;margin-top:10px}
.fieldset ._title{position:absolute;top:-15px;left:10px;font-size:16px;background:#fafafb;padding:5px 20px; color: #606060;    text-shadow: 1px 1px #fff;}
.fieldset ._price{font-size:30px;font-weight:700;text-shadow:1px 1px #fff}.ppt-tabs-listing .fieldset .bg-pattern{opacity:.05} 


.dropdown-toggle::after { display:none!important; }
.dropdown-item { font-size:12px; }
 
</style>
<style><?php  echo $CORE->LAYOUT("load_css", array()); ?></style>
 

<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// PAGE LINKS ARRAY
$GLOBALS['core_page_templates'] = $CORE->LAYOUT("get_innerpage_blocks", array());
 
$GLOBALS['core_page_templates']['homepage'] = array( "name" => __("Home Page","premiumpress"), "link" => home_url()."/?reset=1", "order" => 1, "icon" => "fa-home", "bgcolor" => "#212548");  

$GLOBALS['core_page_templates']['login'] = array( "name" => __("Login Page","premiumpress"), "link" => wp_login_url(), "order" => 1.1, "icon" => "fa fa-lock", "bgcolor" => "#483c21");  

$GLOBALS['core_page_templates']['register'] = array( "name" => __("Register Page","premiumpress"), "link" => wp_registration_url(), "order" => 1.2, "icon" => "fa fa-page", "bgcolor" => "#483c21"); 

$GLOBALS['core_page_templates']['search'] = array( "name" => __("Search Page","premiumpress"), "link" => home_url()."/?s=", "order" => 2.1, "icon" => "fa-search", "bgcolor" => "#214841");  
 
$GLOBALS['core_page_templates']['blog'] = array( "name" => __("Blog","premiumpress"), "link" => _ppt(array('links','blog')), "order" => 2.3, "icon" => "fa fa-rss", "bgcolor" => "#483c21");  
 
 
 
 
$SQL = "SELECT ID FROM ".$wpdb->posts." WHERE post_type ='listing_type' and post_status = 'publish' ORDER BY rand() LIMIT 1 ";				 			 
$result = $wpdb->get_results($SQL);
if(isset($result[0])){
$postID = $result[0]->ID;	
$GLOBALS['core_page_templates']['listingpage'] = array( "name" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Page","premiumpress")), "link" => get_permalink($postID), "order" => 2.2, "icon" => $CORE->LAYOUT("captions","icon"), "bgcolor" => "#482121");  
}



?>


<div id="page-loading" class="text-center">
<img src="<?php echo CDN_PATH; ?>/images/loading.svg" alt="loading page" style="max-width:150px;" />
</div>
<div id="admin-wrapper" style="display:none;">

<div class="ppt-iframe-wrap">

 
<div class="p-lg-5">

 

    <div class="container-fluid h-100" style="    max-width: 1300px;"> 
    
    
  
  <?php if(defined('ELEMENTOR_VERSION')){ ?>
  
 
  
  <?php }else{ ?>
   
<div class="alert alert-help border mb-3 bg-white mt-4">
  <div class="alert-icon bg-danger">
    <i class="fa fa-info"></i>
  </div>
  <div class="alert-text p-4 px-4">
    <h5><?php echo __("Elementor Not Installed","premiumpress"); ?></h5> 
    <p class="mt-2"><?php echo __("If you want to edit your pages with a page builder, please install Elementor.","premiumpress"); ?></p>
    <div>
     <a href="plugin-install.php?tab=plugin-information&plugin=elementor" data-ppt-btn class=" btn-system shadow-sm"><i class="fab fa-elementor"></i> <?php echo __("Install Elementor","premiumpress"); ?></a>
	</div>
  </div>
</div>

  <?php } ?>  
    
    		<?php /*
            <div id="d" class="nav-tab-wrapper mb-4">    
            <a class="nav-tab nav-tab-active" href="#" style="background: #f7f7f7;"><?php echo __("My Website","premiumpress"); ?></a>                            
            <a class="nav-tab" href="https://www.premiumpress.com/changelogs/" target="_blank"><?php echo __("What's new","premiumpress"); ?></a>
            <a class="nav-tab" href="https://www.premiumpress.com/contact/" target="_blank"><?php echo __("Documentation","premiumpress"); ?></a>
            
            <?php if(!defined('WLT_DEMOMODE')){ ?>
            <a class="nav-tab float-right border-0 bg-none" href="admin.php?page=premiumpress&hideme=1"><?php echo __("Hide","premiumpress"); ?></a>
            <?php } ?>
            </div>
			*/ ?>
     
    
        <div class="row">
        <?php 
		
		
		
		
$pageBrokeCounter = 0;	
foreach($CORE->multisort($GLOBALS['core_page_templates'], array('order'))  as $k => $p){

	// KEY
	$corekey = str_replace("page_","",$k);
	$p['id'] = $corekey; 
 	
	// SKIP ADD
	if($corekey == "add"){
	continue;
	}
	
	// SKIP BROKEN PAGES
	if(!in_array($k,array("homepage","listingpagexx","search","login","register")) && ( $p['link'] == "" || strpos($p['link'],"?") !== false) ){ 
	
		$pageBrokeCounter = 1;
		continue;
		
	}
	

	// CHECK FOR MOBILE VIEW
	$page_mobile = _ppt(array('pageassign', $p['id'].'_mobile'));

	// EDIT PAGE LINK
	$page_el = "#"; $page_target_c = ""; $page_target_b = 1; 
	
	if(in_array($k,array("homepage")) && _ppt(array('design','slot1_style')) == "" && _ppt(array('design','header_style')) == "" ){
	
		$page_target_b = 0;
		
		$page_el = home_url()."/wp-admin/admin.php?page=design&lefttab=ideas";
	
	}elseif(in_array($k,array("listingpage")) && !defined('ELEMENTOR_VERSION') ){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=listingsetup&lefttab=single";
		
		$page_target_b = 0;	
		
	}elseif(in_array($k,array("listingpagexxxxx")) ){
	
	  $page_el = "#";
		
		$page_target_b = 0;	
		
	}elseif(in_array($k,array("login")) ){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=usersettings&lefttab=login";
		
		$page_target_b = 0;		
	
	}elseif(in_array($k,array("register")) ){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=usersettings&lefttab=register";
		
		$page_target_b = 0;		
		
	
	}elseif(in_array($k,array("add")) ){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=listingsetup&lefttab=s";
		
		$page_target_b = 0;		
		
	}elseif(in_array($k,array("blog","page_blog")) ){
	
	  $page_el = home_url()."/wp-admin/edit.php";
		
	$page_target_b = 0;	
	
	}elseif(in_array($k,array("privacy","page_privacy")) ){
	
	$page_el = _ppt(array('links','privacy'));
	$SQL = "SELECT post_id FROM ".$wpdb->postmeta." WHERE meta_key ='_wp_page_template' and meta_value = 'templates/tpl-page-privacy.php' ORDER BY rand() LIMIT 1 ";				 			 
	$result = $wpdb->get_results($SQL);
	if(isset($result[0])){
	$postID = $result[0]->post_id;
	
	$page_el = home_url()."/wp-admin/post.php?post=".$postID."&action=edit";
	 
	
	}
	
	
	  
		
	$page_target_b = 0;	
		
	}elseif(in_array($k,array("page_stores")) ){
	
	  $page_el = home_url()."/edit-tags.php?taxonomy=store&post_type=listing_type";
		
		$page_target_b = 0;	
			
	}elseif(in_array($k,array("search")) ){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=search";
		
		$page_target_b = 0;		
		
	}elseif(in_array($k,array("search",))){
	
		$page_target_b = 0;
		
		$page_target_c = "onclick=\"jQuery('#".$k."-tab').trigger('click');\""; 
	
	}elseif(defined('ELEMENTOR_VERSION')){ 
          
          if(substr(_ppt(array('pageassign',$p['id'])), 0, 9) == "elementor" ){ 
		  
		  $page_el = home_url()."/wp-admin/post.php?post=".str_replace("elementor-","",_ppt(array('pageassign',$p['id'])))."&action=elementor";
		  
		  }elseif(substr(_ppt(array('pageassign',$p['id'])), 0, 5) == "page-" ){
		  
		   $page_el = home_url()."/wp-admin/post.php?post=".str_replace("page-","",_ppt(array('pageassign',$p['id'])))."&action=edit";
           
		  }elseif($p['id'] == "homepage" && _ppt(array('design','slot1_style')) == "" && _ppt(array('design','slot2_style')) == ""){ // NO HOMEPAGE SET 		  
		  
		  $page_el = home_url()."/wp-admin/wp-admin/admin.php?page=design&lefttab=ideas";
		  
		  }else{ 
           
           	if($p['id'] == "homepage"){ 
           
           	$page_el = home_url()."/wp-admin/admin.php?page=design&loadpage=home";
			
			}else{
			
				$page_el = home_url()."/wp-admin/admin.php?page=design&loadpage=new&inner=".$p['id'];
			
				$page_target_c = "onclick=\"_pageRefresh();\"";
			
			}
         }
	
	}else{ // end elementor			
	
		$page_target_b = 0;
		
		$page_target_c = "onclick=\"load_ajax_pageedit('".$p['id']."');\"";  
	
	}
	
	
	if(!in_array($k,array("homepage","search")) && ( $p['link'] == "" || strpos($p['link'],"?") !== false) ){
	$preview = "";
	
	}else{
	
	
	$preview = "https://premiummod.com/webshot/index.php?license=".get_option('ppt_license_key')."&web=".$p['link']."&tk=".THEME_KEY."&email=".get_option('admin_email');
	
	}
	
	

		
		?>
        <div class="col-md-6 col-lg-3  <?php if($p['id'] == "homepage"){ echo ""; } ?> card-preview">
        
            <div class="border shadow-sm bg-white my-2 position-relative" <?php if(isset($_GET['s']) && $_GET['s'] == $p['id']){ ?>style="border:2px solid red!important;"<?php } ?>>
            
            
            <div style="height:200px;" class="bg-light border m-2 position-relative">
            
            <div class="overlay-inner" style="z-index: 1;"></div>
            
            <div class="bg-image" <?php if($preview != ""){ ?>data-bg="<?php echo $preview; ?>" <?php } ?>></div> 
            </div>
             
            <div style=" position:absolute; top:25%; z-index:1;" class="w-100 text-center">
            <div style="width: 100px;    margin: auto;">
         
          
 

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

 

 <?php if(!in_array($k,array("homepage","listingpage","search","login","register")) && ( $p['link'] == "" || strpos($p['link'],"?") !== false) ){ $pageBroke = 1; ?>
    
    
    
   
    
    
       <div class="badge_tooltip text-center" data-direction="top">
                    <div class="badge_tooltip__initiator">
                 
                 
                  <a style="width:40px;" href="admin.php?page=settings&lefttab=pagelinks&brokenlink=<?php echo $p['link']; ?>" data-ppt-btn class="list btn-sm btn-system" target="_blank"><i class="fa fa-unlink text-danger"></i></a>
                   
                   
                   </div>
                    <div class="badge_tooltip__item"><?php echo __("The page link is not correct. <br><br> Click the button and check your page links.","premiumpress"); ?></div>
                </div>
    
     
    <?php }else{ ?>
    
        <a href="<?php echo $p['link']; ?>" data-ppt-btn class="list btn-system btn-block" target="_blank">View</a>
        
       
        
    <?php } ?>
         
         
    <?php if(!isset($pageBroke) ){ ?>  
    
     <?php if(defined('ELEMENTOR_VERSION')){ ?>
     <a href="<?php echo $page_el; ?>" <?php echo $page_target_c; ?> <?php if($page_target_b){ ?>target="_blank"<?php } ?> data-ppt-btn class="list btn-system btn-block">
    Edit
    </a>
     <?php }else{ ?>
     
     <a href="#" onclick="alert('Please install Elementor to edit this page.');" data-ppt-btn class="list btn-system btn-block">
    Edit
    </a>
     <?php } ?>
    
        
	
    <?php } ?>
      
         
         
         </div>
         
            </div>
            
             <!-- end box -->
            
            <div class="d-flex justify-content-between mb-2">
            
                <div class="_title ml-2 text-truncate mt-2 text-600"><?php echo $p['name']; ?></div>
                
                <div>
               <div class="d-flex">
               <?php 
				
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(!in_array($k,array("search","login","register"))){
				
				$hasCustomPage = _ppt(array('pageassign', $p['id'] ));
				?> 
                
                 <div class="badge_tooltip text-center" data-direction="top">
                    <div class="badge_tooltip__initiator">
                  <a href="javascript:void(0);" onclick="load_ajax_pagelinks('<?php echo $p['id']; ?>', 0);" data-ppt-btn data-ppt-btn class="btn-system btn-sm mr-2">
				 
                    
                    <div ppt-icon-20 data-ppt-icon-size="20" class="<?php if($hasCustomPage){ ?>text-warning<?php } ?>"><?php echo $CORE_UI->icons_svg['desktop']; ?></div>
                    					
					</a>    
                   </div>
                    <div class="badge_tooltip__item"><?php echo __("Use Custom Template","premiumpress"); ?> <?php if($hasCustomPage){ ?><div class="small text-warning"><?php echo __("custom design set","premiumpress"); ?></div><?php } ?></div>
                </div>
				
					
				 
					
				<?php 
				}
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(!in_array($k,array("search", "listingpage","login","register"))){
				?>
                
                <div class="badge_tooltip text-center" data-direction="top">
                    <div class="badge_tooltip__initiator">
                   <a href="javascript:void(0);" onclick="load_ajax_pagelinks('<?php echo $p['id']; ?>', 1);" data-ppt-btn class="btn-sm  btn-system mr-2"> <i class="fa fa-language m-0"></i> </a>    
                   </div>
                    <div class="badge_tooltip__item"><?php echo __("Setup Multiple Languages","premiumpress"); ?></div>
                </div>
                
				
                <?php } 
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("search"))){
				?>
				
               <a href="admin.php?page=search" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                     <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div>
                </a> 
                
                
                
                <?php } 
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("listingpage"))){
				?>
                
                  
               <a href="admin.php?page=listingsetup&lefttab=single" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                
                    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div>
                  
                 </a> 
               
                
       <?php } 
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("blog"))){
				?>
                
                  
                   
                  <a href="edit.php" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                    <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div>
                 </a>
                
       <?php } 
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("page_sellspace"))){
				?>
                
                  
                   <a href="admin.php?page=advertising" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                     <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div>
                 </a> 
                 
       <?php } 
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("page_memberships"))){
				?>
                
                  
                <a href="admin.php?page=membershipsetup" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                 <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div>
                 </a> 
 
               <?php
			   }
			   
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////////////////////
				if(in_array($k,array("page_contact"))){
				?>
                
                  <a href="admin.php?page=settings&lefttab=company" target="_blank" class="btn-sm btn-system mr-2" data-ppt-btn>
                  <div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['cog']; ?></div> 
                 </a>  
				
				<?php
				}
                ///////////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////////////////////////////
                ?>
                
           <?php if(strlen($page_mobile) > 5){ ?>
           
           
                  <div class="badge_tooltip text-center" data-direction="top">
                    <div class="badge_tooltip__initiator">
                
                  <a style="width:40px;" href="<?php echo str_replace("?reset=1","",$p['link']); ?>?mobile_view=1" data-ppt-btn class="btn-system btn-sm text-dark mr-3" target="_blank" >
                  
                  <i class="fal fa-mobile"></i>
                  
                  
                  </a>
                   
                   </div>
                    <div class="badge_tooltip__item">
					
                    <?php echo __("Mobile Phone Preview","premiumpress"); ?>
                    
                    </div>
                </div>
            
      
        <?php } ?>
                
                
							   
               </div>
               
                </div>
            
            </div>
            <!-- end box -->
            
            
            </div>
            
        </div>
        <?php } ?>
        </div>
     
    


<?php if($pageBrokeCounter > 0){?>

<div class="alert alert-help border mb-3 bg-white mt-4">
  <div class="alert-icon bg-danger">
    <i class="fa fa-info"></i>
  </div>
  <div class="alert-text p-4 px-4">
    <h5><?php echo $pageBrokeCounter." ".__("Broken Page Links","premiumpress"); ?></h5> 
    <p><?php echo __("Some of your page links are broken. Please fix these soon.","premiumpress"); ?></p>
    <div>
     <a href="admin.php?page=settings&lefttab=pagelinks" data-ppt-btn class=" btn-system shadow-sm"><i class="fa fa-unlink"></i> <?php echo __("Fix Page Links","premiumpress"); ?></a>
	</div>
  </div>
</div>

<?php } ?>


<hr />

<div class="row">


<div class="col-md-4">
<div class="text-600 my-3"><?php echo __("Header Design","premiumpress"); ?></div>
<?php

$headerstyle = _ppt(array('design',"header_style"));
if(strlen($headerstyle) > 2){ 
?> 
<img src="<?php echo $CORE->LAYOUT("get_block_prewview",  $headerstyle); ?>" class="img-fluid  mb-4"   />
<?php } ?>
<a href="admin.php?page=design&lefttab=header" target="_blank" data-ppt-btn class=" btn-system btn-md mr-2"><?php echo __("Edit Header Design","premiumpress") ?></a>

<a href="nav-menus.php" target="_blank" data-ppt-btn class=" btn-system btn-md"><?php echo __("Menu Items","premiumpress") ?></a>
 


</div>
<div class="col-md-4">
<div class="text-600 my-3"><?php echo __("Footer Design","premiumpress"); ?></div>
<?php

$headerstyle = _ppt(array('design',"footer_style"));
if(strlen($headerstyle) > 2){ 
?> 
 <img src="<?php echo $CORE->LAYOUT("get_block_prewview", _ppt(array('design',"footer_style")) ); ?>" class="img-fluid mb-4" />
 <?php } ?>
<a href="admin.php?page=design&lefttab=footer" target="_blank" data-ppt-btn class=" btn-system btn-md mr-2"><?php echo __("Edit Footer Design","premiumpress") ?></a>

</div>

</div>



        
    </div> 

</div> 
</div> 





<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="editor_panel_toggle editor_panel" data-rtl="ltr">
<div class="sc-gipzik editor_panel_wrap">

<div class="sc-iRbamj editor_panel_title">


<h3 class="componentTitle text-700 text-white"><span><?php echo __("Site Manager","premiumpress"); ?></span></h3>

<a href="javascript:void(0);" onclick="EditorOpen();" class="text-light" style="position: absolute;    top: 20px;    right: 20px;"><i class="fa fa-times"></i></a>


</div>


<div class="card-footer text-center text-light text-600" id="editor_title1" style="background:#2371b1;">

<?php echo __("Branding","premiumpress"); ?>

</div>

<div class="card-body ppt-scroll">
  
 

<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="ppt-nav-wrap">

 

<ul class="nav nav-tabs ppt-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" onclick="editorTab(1)"><?php echo __("Branding","premiumpress") ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false" onclick="editorTab(2)"><?php echo __("Pages","premiumpress") ?></a>
  </li>
  <?php /*
  <li class="nav-item">
    <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false" onclick="editorTab(3)"><?php echo __("Design","premiumpress") ?></a>
  </li>
  */ ?>
</ul>
</div>
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="tab-content" id="myTabContent1">
  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
  
 

<div class="fieldset">
<div class="_title"><?php echo __("My Logo","premiumpress") ?></div>
<div class="_price">

<?php echo $CORE->LAYOUT("get_logo","dark");  ?>

</div>
</div>
<a href="admin.php?page=design&lefttab=logo" target="_blank" data-ppt-btn class=" btn-system btn-md"><?php echo __("Edit Logo","premiumpress") ?></a>
 


<div class="fieldset mt-4">

<div class="_title"><?php echo __("My Colors","premiumpress") ?></div>
<div class="_price">

<div class="d-flex">
    <div style="width:50px; height:50px;" class="bg-primary" >  </div>
    <div class="mx-2"></div>    
    <div style="width:50px; height:50px;" class="bg-secondary" > </div>
    
    
   <div class="mx-2"></div>
    
    <div style="width:50px; height:50px;" class="bg-soft" ></div>
    
    
</div>

</div>
</div>  

<a href="admin.php?page=design&lefttab=colors" target="_blank" data-ppt-btn class=" btn-system btn-md"><?php echo __("Edit Colors","premiumpress") ?></a>
 
 
  </div>
<?php

/// WORDPRESS PAGES
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// GET PAGES
$args = array('post_type' => 'page','posts_per_page' 	=> 20,'orderby' => 'date','order' => 'desc' );
$wp_query = new WP_Query($args);
$tt = $wpdb->get_results($wp_query->request, OBJECT);


?>  
  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="pages-tab">

 
<?php

 if(!empty($tt)){  
	 $elementorArray["9999"] = "9999";
	 foreach($tt as $p){	 
	 
	 	$title = get_the_title($p->ID);	
		
		$link = get_permalink($p->ID);
		
		$template = get_post_meta($p->ID,"_wp_page_template", true);	
		
		if(strlen($template) > 1 && !in_array($template, array('elementor_canvas','elementor_header_footer','elementor_theme')) ){ continue; }
 

?>

<div class="border-bottom py-2">

<div class="d-flex justify-content-between">

<div class="text-truncate">
	<span class="small"><?php echo $title; ?></span>
</div>

<a href="<?php echo $link; ?>"  target="_blank" data-toggle="tooltip" data-placement="top" class="text-dark" title="<?php echo __("Vew Page","premiumpress"); ?>"><i class="fa fa-external-link"></i></a>
</div>
</div>

<?php } } ?>


  </div>
  
<?php

/// NEW DESIGNS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>  
  <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
  
 sdsd 
</div>

<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  
  
  
  
</div>

</div>

<?php /*
 <div class="sc-jlyJG editor_panel_footer" style="display:none"><a href="javascript:void(0);" style="background: #2371b1;" onclick="load_ajax_blocks_builder(0);" data-ppt-btn class=" btn-success btn-lg btn-block text-700"><span><?php echo __("Page Builder","premiumpress") ?></span></a></div>

*/ ?>

</div>
</div>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<div id="option_btn">

<div class="heading" style="background:#2371b1;" onclick="EditorOpen();"><a href="javascript:void(0);" class="border-0 p-0 m-0 text-white" style="display: inline-block;">

<div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['cog']; ?></div>

 
</a></div>

<div class="heading bg-dark"><a href="admin.php?page=premiumpress" class="border-0 p-0 m-0 text-white" style="display: inline-block;"><i class="fa fa-chevron-double-right" aria-hidden="true"></i></a></div>

 
 
</div>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

</div> 

<!--global modal -->
<div class="ppt-modal-wrap shadow hidepage" style="display:none;">
  <div class="ppt-modal-wrap-overlay">
  </div>
  <div class="ppt-modal-item">
    <div class="ppt-modal-container">
      <div id="ppt-modal-ajax-form">asd
      </div>
      <div class="ppt-modal-close text-center">
        <i class="fa fa-times">&nbsp;</i>
      </div>
      <div class="card-footer ppt-modal-footer text-center" style="display:none;">
        <button type="button" onclick="jQuery('.ppt-modal-wrap').fadeOut(400);" data-ppt-btn class=" btn-system btn-xl"><?php echo __("Close Window","premiumpress"); ?></button>
      </div>
    </div>
  </div>
</div>
<!--global modal -->
 
<script type="text/javascript"> 

var ajax_site_url = "<?php echo home_url(); ?>/"; 


function editorTab(tabid){
	
	
	jQuery('.editor_panel_footer').hide();
	
	if(tabid == 1){
	
		jQuery('#editor_title1').html("<?php echo __("Branding","premiumpress"); ?>");
		
	}
	
	if(tabid == 2){
	jQuery('.editor_panel_footer').show();
	
		jQuery('#editor_title1').html("<?php echo __("Website Pages","premiumpress"); ?>");
	
	}
	
	if(tabid == 3){
	
		jQuery('#editor_title1').html("<?php echo __("Designs","premiumpress"); ?>");
		
		jQuery('#tab3 img').each(function () {		  
		 
			jQuery(this).attr("src",jQuery(this).attr("data-src"));
    		jQuery(this).removeAttr("data-src");
			
		}); 
	 
	}
	
	

}

function EditorOpen(){

	jQuery('body').toggleClass('ppt_editor_open');
	
	jQuery('.card-preview').toggleClass('col-xl-3');

}

function _pageRefresh(){
 
 setTimeout(function(){
       window.location = "<?php echo home_url(); ?>/wp-admin/admin.php?page=ppt_editor&reload=1";
   },10000); 

}

jQuery(document).ready(function(){ 
jQuery('body').toggleClass('ppt_editor_open'); 
const qs = new PerfectScrollbar('.ppt-scroll');

});
 

/* SCROLL */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.PerfectScrollbar=e()}(this,function(){"use strict";function t(t){return getComputedStyle(t)}function e(t,e){for(var i in e){var r=e[i];"number"==typeof r&&(r+="px"),t.style[i]=r}return t}function i(t){var e=document.createElement("div");return e.className=t,e}function r(t,e){if(!v)throw new Error("No element matching method supported");return v.call(t,e)}function l(t){t.remove?t.remove():t.parentNode&&t.parentNode.removeChild(t)}function n(t,e){return Array.prototype.filter.call(t.children,function(t){return r(t,e)})}function o(t,e){var i=t.element.classList,r=m.state.scrolling(e);i.contains(r)?clearTimeout(Y[e]):i.add(r)}function s(t,e){Y[e]=setTimeout(function(){return t.isAlive&&t.element.classList.remove(m.state.scrolling(e))},t.settings.scrollingThreshold)}function a(t,e){o(t,e),s(t,e)}function c(t){if("function"==typeof window.CustomEvent)return new CustomEvent(t);var e=document.createEvent("CustomEvent");return e.initCustomEvent(t,!1,!1,void 0),e}function h(t,e,i,r,l){var n=i[0],o=i[1],s=i[2],h=i[3],u=i[4],d=i[5];void 0===r&&(r=!0),void 0===l&&(l=!1);var f=t.element;t.reach[h]=null,f[s]<1&&(t.reach[h]="start"),f[s]>t[n]-t[o]-1&&(t.reach[h]="end"),e&&(f.dispatchEvent(c("ps-scroll-"+h)),e<0?f.dispatchEvent(c("ps-scroll-"+u)):e>0&&f.dispatchEvent(c("ps-scroll-"+d)),r&&a(t,h)),t.reach[h]&&(e||l)&&f.dispatchEvent(c("ps-"+h+"-reach-"+t.reach[h]))}function u(t){return parseInt(t,10)||0}function d(t){return r(t,"input,[contenteditable]")||r(t,"select,[contenteditable]")||r(t,"textarea,[contenteditable]")||r(t,"button,[contenteditable]")}function f(e){var i=t(e);return u(i.width)+u(i.paddingLeft)+u(i.paddingRight)+u(i.borderLeftWidth)+u(i.borderRightWidth)}function p(t,e){return t.settings.minScrollbarLength&&(e=Math.max(e,t.settings.minScrollbarLength)),t.settings.maxScrollbarLength&&(e=Math.min(e,t.settings.maxScrollbarLength)),e}function b(t,i){var r={width:i.railXWidth},l=Math.floor(t.scrollTop);i.isRtl?r.left=i.negativeScrollAdjustment+t.scrollLeft+i.containerWidth-i.contentWidth:r.left=t.scrollLeft,i.isScrollbarXUsingBottom?r.bottom=i.scrollbarXBottom-l:r.top=i.scrollbarXTop+l,e(i.scrollbarXRail,r);var n={top:l,height:i.railYHeight};i.isScrollbarYUsingRight?i.isRtl?n.right=i.contentWidth-(i.negativeScrollAdjustment+t.scrollLeft)-i.scrollbarYRight-i.scrollbarYOuterWidth:n.right=i.scrollbarYRight-t.scrollLeft:i.isRtl?n.left=i.negativeScrollAdjustment+t.scrollLeft+2*i.containerWidth-i.contentWidth-i.scrollbarYLeft-i.scrollbarYOuterWidth:n.left=i.scrollbarYLeft+t.scrollLeft,e(i.scrollbarYRail,n),e(i.scrollbarX,{left:i.scrollbarXLeft,width:i.scrollbarXWidth-i.railBorderXWidth}),e(i.scrollbarY,{top:i.scrollbarYTop,height:i.scrollbarYHeight-i.railBorderYWidth})}function g(t,e){function i(e){b[d]=g+Y*(e[a]-v),o(t,f),R(t),e.stopPropagation(),e.preventDefault()}function r(){s(t,f),t[p].classList.remove(m.state.clicking),t.event.unbind(t.ownerDocument,"mousemove",i)}var l=e[0],n=e[1],a=e[2],c=e[3],h=e[4],u=e[5],d=e[6],f=e[7],p=e[8],b=t.element,g=null,v=null,Y=null;t.event.bind(t[h],"mousedown",function(e){g=b[d],v=e[a],Y=(t[n]-t[l])/(t[c]-t[u]),t.event.bind(t.ownerDocument,"mousemove",i),t.event.once(t.ownerDocument,"mouseup",r),t[p].classList.add(m.state.clicking),e.stopPropagation(),e.preventDefault()})}var v="undefined"!=typeof Element&&(Element.prototype.matches||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector),m={main:"ps",element:{thumb:function(t){return"ps__thumb-"+t},rail:function(t){return"ps__rail-"+t},consuming:"ps__child--consume"},state:{focus:"ps--focus",clicking:"ps--clicking",active:function(t){return"ps--active-"+t},scrolling:function(t){return"ps--scrolling-"+t}}},Y={x:null,y:null},X=function(t){this.element=t,this.handlers={}},w={isEmpty:{configurable:!0}};X.prototype.bind=function(t,e){void 0===this.handlers[t]&&(this.handlers[t]=[]),this.handlers[t].push(e),this.element.addEventListener(t,e,!1)},X.prototype.unbind=function(t,e){var i=this;this.handlers[t]=this.handlers[t].filter(function(r){return!(!e||r===e)||(i.element.removeEventListener(t,r,!1),!1)})},X.prototype.unbindAll=function(){var t=this;for(var e in t.handlers)t.unbind(e)},w.isEmpty.get=function(){var t=this;return Object.keys(this.handlers).every(function(e){return 0===t.handlers[e].length})},Object.defineProperties(X.prototype,w);var y=function(){this.eventElements=[]};y.prototype.eventElement=function(t){var e=this.eventElements.filter(function(e){return e.element===t})[0];return e||(e=new X(t),this.eventElements.push(e)),e},y.prototype.bind=function(t,e,i){this.eventElement(t).bind(e,i)},y.prototype.unbind=function(t,e,i){var r=this.eventElement(t);r.unbind(e,i),r.isEmpty&&this.eventElements.splice(this.eventElements.indexOf(r),1)},y.prototype.unbindAll=function(){this.eventElements.forEach(function(t){return t.unbindAll()}),this.eventElements=[]},y.prototype.once=function(t,e,i){var r=this.eventElement(t),l=function(t){r.unbind(e,l),i(t)};r.bind(e,l)};var W=function(t,e,i,r,l){void 0===r&&(r=!0),void 0===l&&(l=!1);var n;if("top"===e)n=["contentHeight","containerHeight","scrollTop","y","up","down"];else{if("left"!==e)throw new Error("A proper axis should be provided");n=["contentWidth","containerWidth","scrollLeft","x","left","right"]}h(t,i,n,r,l)},L={isWebKit:"undefined"!=typeof document&&"WebkitAppearance"in document.documentElement.style,supportsTouch:"undefined"!=typeof window&&("ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch),supportsIePointer:"undefined"!=typeof navigator&&navigator.msMaxTouchPoints,isChrome:"undefined"!=typeof navigator&&/Chrome/i.test(navigator&&navigator.userAgent)},R=function(t){var e=t.element,i=Math.floor(e.scrollTop);t.containerWidth=e.clientWidth,t.containerHeight=e.clientHeight,t.contentWidth=e.scrollWidth,t.contentHeight=e.scrollHeight,e.contains(t.scrollbarXRail)||(n(e,m.element.rail("x")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarXRail)),e.contains(t.scrollbarYRail)||(n(e,m.element.rail("y")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarYRail)),!t.settings.suppressScrollX&&t.containerWidth+t.settings.scrollXMarginOffset<t.contentWidth?(t.scrollbarXActive=!0,t.railXWidth=t.containerWidth-t.railXMarginWidth,t.railXRatio=t.containerWidth/t.railXWidth,t.scrollbarXWidth=p(t,u(t.railXWidth*t.containerWidth/t.contentWidth)),t.scrollbarXLeft=u((t.negativeScrollAdjustment+e.scrollLeft)*(t.railXWidth-t.scrollbarXWidth)/(t.contentWidth-t.containerWidth))):t.scrollbarXActive=!1,!t.settings.suppressScrollY&&t.containerHeight+t.settings.scrollYMarginOffset<t.contentHeight?(t.scrollbarYActive=!0,t.railYHeight=t.containerHeight-t.railYMarginHeight,t.railYRatio=t.containerHeight/t.railYHeight,t.scrollbarYHeight=p(t,u(t.railYHeight*t.containerHeight/t.contentHeight)),t.scrollbarYTop=u(i*(t.railYHeight-t.scrollbarYHeight)/(t.contentHeight-t.containerHeight))):t.scrollbarYActive=!1,t.scrollbarXLeft>=t.railXWidth-t.scrollbarXWidth&&(t.scrollbarXLeft=t.railXWidth-t.scrollbarXWidth),t.scrollbarYTop>=t.railYHeight-t.scrollbarYHeight&&(t.scrollbarYTop=t.railYHeight-t.scrollbarYHeight),b(e,t),t.scrollbarXActive?e.classList.add(m.state.active("x")):(e.classList.remove(m.state.active("x")),t.scrollbarXWidth=0,t.scrollbarXLeft=0,e.scrollLeft=0),t.scrollbarYActive?e.classList.add(m.state.active("y")):(e.classList.remove(m.state.active("y")),t.scrollbarYHeight=0,t.scrollbarYTop=0,e.scrollTop=0)},T={"click-rail":function(t){t.event.bind(t.scrollbarY,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarYRail,"mousedown",function(e){var i=e.pageY-window.pageYOffset-t.scrollbarYRail.getBoundingClientRect().top>t.scrollbarYTop?1:-1;t.element.scrollTop+=i*t.containerHeight,R(t),e.stopPropagation()}),t.event.bind(t.scrollbarX,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarXRail,"mousedown",function(e){var i=e.pageX-window.pageXOffset-t.scrollbarXRail.getBoundingClientRect().left>t.scrollbarXLeft?1:-1;t.element.scrollLeft+=i*t.containerWidth,R(t),e.stopPropagation()})},"drag-thumb":function(t){g(t,["containerWidth","contentWidth","pageX","railXWidth","scrollbarX","scrollbarXWidth","scrollLeft","x","scrollbarXRail"]),g(t,["containerHeight","contentHeight","pageY","railYHeight","scrollbarY","scrollbarYHeight","scrollTop","y","scrollbarYRail"])},keyboard:function(t){function e(e,r){var l=Math.floor(i.scrollTop);if(0===e){if(!t.scrollbarYActive)return!1;if(0===l&&r>0||l>=t.contentHeight-t.containerHeight&&r<0)return!t.settings.wheelPropagation}var n=i.scrollLeft;if(0===r){if(!t.scrollbarXActive)return!1;if(0===n&&e<0||n>=t.contentWidth-t.containerWidth&&e>0)return!t.settings.wheelPropagation}return!0}var i=t.element,l=function(){return r(i,":hover")},n=function(){return r(t.scrollbarX,":focus")||r(t.scrollbarY,":focus")};t.event.bind(t.ownerDocument,"keydown",function(r){if(!(r.isDefaultPrevented&&r.isDefaultPrevented()||r.defaultPrevented)&&(l()||n())){var o=document.activeElement?document.activeElement:t.ownerDocument.activeElement;if(o){if("IFRAME"===o.tagName)o=o.contentDocument.activeElement;else for(;o.shadowRoot;)o=o.shadowRoot.activeElement;if(d(o))return}var s=0,a=0;switch(r.which){case 37:s=r.metaKey?-t.contentWidth:r.altKey?-t.containerWidth:-30;break;case 38:a=r.metaKey?t.contentHeight:r.altKey?t.containerHeight:30;break;case 39:s=r.metaKey?t.contentWidth:r.altKey?t.containerWidth:30;break;case 40:a=r.metaKey?-t.contentHeight:r.altKey?-t.containerHeight:-30;break;case 32:a=r.shiftKey?t.containerHeight:-t.containerHeight;break;case 33:a=t.containerHeight;break;case 34:a=-t.containerHeight;break;case 36:a=t.contentHeight;break;case 35:a=-t.contentHeight;break;default:return}t.settings.suppressScrollX&&0!==s||t.settings.suppressScrollY&&0!==a||(i.scrollTop-=a,i.scrollLeft+=s,R(t),e(s,a)&&r.preventDefault())}})},wheel:function(e){function i(t,i){var r=Math.floor(o.scrollTop),l=0===o.scrollTop,n=r+o.offsetHeight===o.scrollHeight,s=0===o.scrollLeft,a=o.scrollLeft+o.offsetWidth===o.scrollWidth;return!(Math.abs(i)>Math.abs(t)?l||n:s||a)||!e.settings.wheelPropagation}function r(t){var e=t.deltaX,i=-1*t.deltaY;return void 0!==e&&void 0!==i||(e=-1*t.wheelDeltaX/6,i=t.wheelDeltaY/6),t.deltaMode&&1===t.deltaMode&&(e*=10,i*=10),e!==e&&i!==i&&(e=0,i=t.wheelDelta),t.shiftKey?[-i,-e]:[e,i]}function l(e,i,r){if(!L.isWebKit&&o.querySelector("select:focus"))return!0;if(!o.contains(e))return!1;for(var l=e;l&&l!==o;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var s=l.scrollHeight-l.clientHeight;if(s>0&&!(0===l.scrollTop&&r>0||l.scrollTop===s&&r<0))return!0;var a=l.scrollWidth-l.clientWidth;if(a>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===a&&i>0))return!0}l=l.parentNode}return!1}function n(t){var n=r(t),s=n[0],a=n[1];if(!l(t.target,s,a)){var c=!1;e.settings.useBothWheelAxes?e.scrollbarYActive&&!e.scrollbarXActive?(a?o.scrollTop-=a*e.settings.wheelSpeed:o.scrollTop+=s*e.settings.wheelSpeed,c=!0):e.scrollbarXActive&&!e.scrollbarYActive&&(s?o.scrollLeft+=s*e.settings.wheelSpeed:o.scrollLeft-=a*e.settings.wheelSpeed,c=!0):(o.scrollTop-=a*e.settings.wheelSpeed,o.scrollLeft+=s*e.settings.wheelSpeed),R(e),(c=c||i(s,a))&&!t.ctrlKey&&(t.stopPropagation(),t.preventDefault())}}var o=e.element;void 0!==window.onwheel?e.event.bind(o,"wheel",n):void 0!==window.onmousewheel&&e.event.bind(o,"mousewheel",n)},touch:function(e){function i(t,i){var r=Math.floor(h.scrollTop),l=h.scrollLeft,n=Math.abs(t),o=Math.abs(i);if(o>n){if(i<0&&r===e.contentHeight-e.containerHeight||i>0&&0===r)return 0===window.scrollY&&i>0&&L.isChrome}else if(n>o&&(t<0&&l===e.contentWidth-e.containerWidth||t>0&&0===l))return!0;return!0}function r(t,i){h.scrollTop-=i,h.scrollLeft-=t,R(e)}function l(t){return t.targetTouches?t.targetTouches[0]:t}function n(t){return!(t.pointerType&&"pen"===t.pointerType&&0===t.buttons||(!t.targetTouches||1!==t.targetTouches.length)&&(!t.pointerType||"mouse"===t.pointerType||t.pointerType===t.MSPOINTER_TYPE_MOUSE))}function o(t){if(n(t)){var e=l(t);u.pageX=e.pageX,u.pageY=e.pageY,d=(new Date).getTime(),null!==p&&clearInterval(p)}}function s(e,i,r){if(!h.contains(e))return!1;for(var l=e;l&&l!==h;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var o=l.scrollHeight-l.clientHeight;if(o>0&&!(0===l.scrollTop&&r>0||l.scrollTop===o&&r<0))return!0;var s=l.scrollLeft-l.clientWidth;if(s>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===s&&i>0))return!0}l=l.parentNode}return!1}function a(t){if(n(t)){var e=l(t),o={pageX:e.pageX,pageY:e.pageY},a=o.pageX-u.pageX,c=o.pageY-u.pageY;if(s(t.target,a,c))return;r(a,c),u=o;var h=(new Date).getTime(),p=h-d;p>0&&(f.x=a/p,f.y=c/p,d=h),i(a,c)&&t.preventDefault()}}function c(){e.settings.swipeEasing&&(clearInterval(p),p=setInterval(function(){e.isInitialized?clearInterval(p):f.x||f.y?Math.abs(f.x)<.01&&Math.abs(f.y)<.01?clearInterval(p):(r(30*f.x,30*f.y),f.x*=.8,f.y*=.8):clearInterval(p)},10))}if(L.supportsTouch||L.supportsIePointer){var h=e.element,u={},d=0,f={},p=null;L.supportsTouch?(e.event.bind(h,"touchstart",o),e.event.bind(h,"touchmove",a),e.event.bind(h,"touchend",c)):L.supportsIePointer&&(window.PointerEvent?(e.event.bind(h,"pointerdown",o),e.event.bind(h,"pointermove",a),e.event.bind(h,"pointerup",c)):window.MSPointerEvent&&(e.event.bind(h,"MSPointerDown",o),e.event.bind(h,"MSPointerMove",a),e.event.bind(h,"MSPointerUp",c)))}}},H=function(r,l){var n=this;if(void 0===l&&(l={}),"string"==typeof r&&(r=document.querySelector(r)),!r||!r.nodeName)throw new Error("no element is specified to initialize PerfectScrollbar");this.element=r,r.classList.add(m.main),this.settings={handlers:["click-rail","drag-thumb","keyboard","wheel","touch"],maxScrollbarLength:null,minScrollbarLength:null,scrollingThreshold:1e3,scrollXMarginOffset:0,scrollYMarginOffset:0,suppressScrollX:!1,suppressScrollY:!1,swipeEasing:!0,useBothWheelAxes:!1,wheelPropagation:!0,wheelSpeed:1};for(var o in l)n.settings[o]=l[o];this.containerWidth=null,this.containerHeight=null,this.contentWidth=null,this.contentHeight=null;var s=function(){return r.classList.add(m.state.focus)},a=function(){return r.classList.remove(m.state.focus)};this.isRtl="rtl"===t(r).direction,this.isNegativeScroll=function(){var t=r.scrollLeft,e=null;return r.scrollLeft=-1,e=r.scrollLeft<0,r.scrollLeft=t,e}(),this.negativeScrollAdjustment=this.isNegativeScroll?r.scrollWidth-r.clientWidth:0,this.event=new y,this.ownerDocument=r.ownerDocument||document,this.scrollbarXRail=i(m.element.rail("x")),r.appendChild(this.scrollbarXRail),this.scrollbarX=i(m.element.thumb("x")),this.scrollbarXRail.appendChild(this.scrollbarX),this.scrollbarX.setAttribute("tabindex",0),this.event.bind(this.scrollbarX,"focus",s),this.event.bind(this.scrollbarX,"blur",a),this.scrollbarXActive=null,this.scrollbarXWidth=null,this.scrollbarXLeft=null;var c=t(this.scrollbarXRail);this.scrollbarXBottom=parseInt(c.bottom,10),isNaN(this.scrollbarXBottom)?(this.isScrollbarXUsingBottom=!1,this.scrollbarXTop=u(c.top)):this.isScrollbarXUsingBottom=!0,this.railBorderXWidth=u(c.borderLeftWidth)+u(c.borderRightWidth),e(this.scrollbarXRail,{display:"block"}),this.railXMarginWidth=u(c.marginLeft)+u(c.marginRight),e(this.scrollbarXRail,{display:""}),this.railXWidth=null,this.railXRatio=null,this.scrollbarYRail=i(m.element.rail("y")),r.appendChild(this.scrollbarYRail),this.scrollbarY=i(m.element.thumb("y")),this.scrollbarYRail.appendChild(this.scrollbarY),this.scrollbarY.setAttribute("tabindex",0),this.event.bind(this.scrollbarY,"focus",s),this.event.bind(this.scrollbarY,"blur",a),this.scrollbarYActive=null,this.scrollbarYHeight=null,this.scrollbarYTop=null;var h=t(this.scrollbarYRail);this.scrollbarYRight=parseInt(h.right,10),isNaN(this.scrollbarYRight)?(this.isScrollbarYUsingRight=!1,this.scrollbarYLeft=u(h.left)):this.isScrollbarYUsingRight=!0,this.scrollbarYOuterWidth=this.isRtl?f(this.scrollbarY):null,this.railBorderYWidth=u(h.borderTopWidth)+u(h.borderBottomWidth),e(this.scrollbarYRail,{display:"block"}),this.railYMarginHeight=u(h.marginTop)+u(h.marginBottom),e(this.scrollbarYRail,{display:""}),this.railYHeight=null,this.railYRatio=null,this.reach={x:r.scrollLeft<=0?"start":r.scrollLeft>=this.contentWidth-this.containerWidth?"end":null,y:r.scrollTop<=0?"start":r.scrollTop>=this.contentHeight-this.containerHeight?"end":null},this.isAlive=!0,this.settings.handlers.forEach(function(t){return T[t](n)}),this.lastScrollTop=Math.floor(r.scrollTop),this.lastScrollLeft=r.scrollLeft,this.event.bind(this.element,"scroll",function(t){return n.onScroll(t)}),R(this)};return H.prototype.update=function(){this.isAlive&&(this.negativeScrollAdjustment=this.isNegativeScroll?this.element.scrollWidth-this.element.clientWidth:0,e(this.scrollbarXRail,{display:"block"}),e(this.scrollbarYRail,{display:"block"}),this.railXMarginWidth=u(t(this.scrollbarXRail).marginLeft)+u(t(this.scrollbarXRail).marginRight),this.railYMarginHeight=u(t(this.scrollbarYRail).marginTop)+u(t(this.scrollbarYRail).marginBottom),e(this.scrollbarXRail,{display:"none"}),e(this.scrollbarYRail,{display:"none"}),R(this),W(this,"top",0,!1,!0),W(this,"left",0,!1,!0),e(this.scrollbarXRail,{display:""}),e(this.scrollbarYRail,{display:""}))},H.prototype.onScroll=function(t){this.isAlive&&(R(this),W(this,"top",this.element.scrollTop-this.lastScrollTop),W(this,"left",this.element.scrollLeft-this.lastScrollLeft),this.lastScrollTop=Math.floor(this.element.scrollTop),this.lastScrollLeft=this.element.scrollLeft)},H.prototype.destroy=function(){this.isAlive&&(this.event.unbindAll(),l(this.scrollbarX),l(this.scrollbarY),l(this.scrollbarXRail),l(this.scrollbarYRail),this.removePsClasses(),this.element=null,this.scrollbarX=null,this.scrollbarY=null,this.scrollbarXRail=null,this.scrollbarYRail=null,this.isAlive=!1)},H.prototype.removePsClasses=function(){this.element.className=this.element.className.split(" ").filter(function(t){return!t.match(/^ps([-_].+|)$/)}).join(" ")},H});

 

</script>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

do_action('hook_footer_after'); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>