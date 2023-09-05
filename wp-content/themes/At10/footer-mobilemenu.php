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
if (!defined('THEME_VERSION')) {	footer('HTTP/1.0 403 Forbidden'); exit; }

global $userdata, $CORE;

$showmenu = _ppt('footer_mobile_menu');

if( ( $showmenu == "" || $showmenu == 1 ) && is_array(_ppt('mobilemenucaption')) && !isset($GLOBALS['flag-home-demo'])  ){

$i = 1;
$menuArray = array();
$names 	= _ppt('mobilemenucaption');
$icons 	= _ppt('mobilemenuicon');
$links 	= _ppt('mobilemenulink');
$bigg 	= _ppt('mobilemenubig');
 
 		  
while($i < 6){

	$name 	= "";
	$icon 	= "";
	$link 	= "";
	$big 	= 0;
	$menu 	= 0;
	
	if(isset($names[$i])){	 
	$name = $names[$i]; 
	}
	
	if(isset($bigg[$i])){
	$big = 1;
	}
	
	if(isset($links[$i])){
	$link = $links[$i];
	
		switch($link){
			case "[login]":{
				$link = _ppt(array('links','myaccount'));		
				$name = __("My Account","premiumpress");		
			} break;
			case "[search]":{
				$link = home_url()."/?s=";
			} break;
			case "[cart]":{
				$link = _ppt(array('links','cart'));
			} break;
			case "[add]":{
				$link = _ppt(array('links','add'));
				//$big = 1;
			} break;
			case "[stores]":{
				$link = _ppt(array('links','stores'));
			} break;
			case "[categories]":{
				$link = _ppt(array('links','categories'));
			} break;
			case "[chatroom]":{
				$link = _ppt(array('links','chatroom'));
			} break;
			case "[menu]":{
				$link = "#";
				$menu = 1;
			} break;
			
			 	
		}
	}
	
	if(isset($icons[$i])){
	$icon = $icons[$i];
	}
	

			
  	if(_ppt(array('lang','switch')) == "1" && is_array(_ppt('languages')) && !empty(_ppt('languages')) ){ 
		$lang = strtolower($CORE->_language_current());		
		if(_ppt(array('mobilemenucaption_'.$lang, $i)) != "" && $lang != "us"){		
			$name = _ppt(array('mobilemenucaption_'.$lang, $i));		
		}			
	}
	 
	$menuArray[] = array(
	"n" => $name,
	"l" => $link,
	"i" => $icon,
	"b" => $big,
	"menu" => $menu,
	);

	$i++;
}
 
 

?> 
 
<div class="footer-nav-area hidepage <?php if(isset($GLOBALS['show-mobilemenu'])){ ?>preview<?php } ?>" <?php if(!isset($GLOBALS['show-mobilemenu'])){ ?>style="display:none;"<?php } ?> id="mobile-bottom-bar">
      <div class="container h-100 px-0">
        <div class="suha-footer-nav h-100">
          <ul class="h-100 list-unstyled d-flex align-items-center justify-content-between pl-0">
       
<?php 


foreach($menuArray as $data){ 

	$icona = explode("-",$data["i"]);
	if(isset($icona[1])){
	$svg = $icona[1];
	}
		
	if($data["b"]){ ?>
    
     <li> <a href="<?php echo $data["l"]; ?>" class="menu-add bg-primary <?php if($data["menu"]){ ?>menu-toggle<?php } ?>"><i class="<?php echo $data["i"]; ?> text-white"></i> </a></li> 
     
    <?php }else{  ?>
    
	<li><a href="<?php echo $data["l"]; ?>" class="<?php if($data["menu"]){ ?>menu-toggle<?php } ?>">
    <?php if(isset($CORE_UI->icons_svg[$svg])){ ?>
    <div ppt-icon-size="24" class="text-light" data-ppt-icon2><?php echo $CORE_UI->icons_svg[$svg]; ?></div>
    <?php }else{ ?>
    <i class="<?php echo $data["i"]; ?>"></i> <?php echo $data["n"]; ?></a></li>
	<?php } ?>
    
	<?php		  
	}
}

?> 
    
          </ul>
        </div>
      </div>
</div>

<?php } ?>
