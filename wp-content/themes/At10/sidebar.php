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
 
if(!isset($GLOBALS['flag-nosidebar'])){  

$GLOBALS['flag-sidebar'] = 1;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

global $CORE, $post, $settings; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$default_widgets = array("newsletter", "new", "popular", "blog-recent");

if(defined('THEME_KEY') && THEME_KEY == "cp"){
  
	$default_widgets = array("newsletter", "coupon-stores", "coupon-pop", "blog-recent" ); //"coupon-categories",	

}

// CUSTOM SIDEBAR
if(_ppt(array("design","custom_bodytags")) == "design-modern"){

	$default_widgets = array("da-modern");
		
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['flag-home'])){

	$sidebarID = "home";

}elseif(isset($GLOBALS['flag-add'])){

	$sidebarID = "add";

}elseif(isset($GLOBALS['flag-taxonomy'])){

	$sidebarID = "taxonomy";
	
	if($GLOBALS['flag-taxonomy-type'] == "listing"){
		
			$sidebarID = "search"; 
 	
			$default_widgets = array("sidebar-search"); 
	}
	 

}elseif(isset($GLOBALS['flag-blog'])){

	$sidebarID = "blog";
	
	$default_widgets = array( "blog-search","blog-categories","blog-recent" );	
		
}elseif(isset($GLOBALS['flag-single'])){

	$sidebarID = "listing";
	
}elseif(isset($GLOBALS['flag-search'])){

	$sidebarID = "search"; 
 	
	$default_widgets = array("sidebar-search"); 
	
}else{

	$sidebarID = "page";


} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
dynamic_sidebar($sidebarID); 
$user_widgets = ob_get_clean();	

if(strlen($user_widgets) > 10){

	$default_content = $user_widgets;
	
}elseif(!empty($default_widgets)){ 

		ob_start();
		foreach($default_widgets as $widget){
			_ppt_template( 'widgets/widget-'.$widget );
		}
		$default_content = ob_get_clean();	 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

 
<aside class="sidebar-<?php echo $sidebarID; ?> hide-mobile hide-ipad">
 
<?php 
 
 
switch($sidebarID){

	case "home": {
	
		echo $default_content;
	
	} break;
	
	case "listing": {
	
		_ppt_template( 'widgets/single-sidebar' );
		
		echo $default_content;
	
	} break;

	case "taxonomy": {
		
		switch($GLOBALS['flag-taxonomy-type']){
		
			case "store": {
		
				_ppt_template( 'widgets/widget-store' );
		
			} break;

			default: {
			
				echo $default_content;
			
			} break;
			
		}	
	
	} break;
	
	case "search": {
	
		echo $CORE->ADVERTISING("display_banner", "search_sidebar_top" );
	
		echo $default_content;
		
		echo $CORE->ADVERTISING("display_banner", "search_sidebar_bottom" );
	
	} break;
	
	case "blog": {	
		 
		echo $CORE->ADVERTISING("display_banner", "blog_top" ); 
		 
		echo $default_content; 
		
		echo $CORE->ADVERTISING("display_banner", "blog_bottom" );
	
	
	} break;
	
	default: {
	
		echo $default_content;
	
	} break;

}
 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

</aside>
 
<?php  

} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>