<?php
 
add_filter( 'ppt_admin_layouts',  array('oct2021c',  'data') );
add_filter( 'oct2021c',  array('oct2021c',  'load') );
 
class oct2021c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['oct2021c'] = array(
		
			"key" => "oct2021c",
			"name" 	=> "Oct 2021 c", 
			"theme"	=> array("framework_oct"),		
			"order" => 2.3
 	 		
		);	
		
		switch(THEME_KEY){
			case "sp": {
				$a['oct2021c']["name"] = "Makeup";
			} break;
		}	
		
		switch(THEME_KEY){			 
			
			case "dt":
			case "vt":
			case "sp":
			case "da":
			case "es": {
				$a['oct2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".THEME_KEY."/3.jpg";
			} break;
			default: {
				$a['oct2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/d/3.jpg";			
			} break; 
		}			 
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){
	case "dt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "vt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "sp": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#b10580";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#fafafb";		
	} break;
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#b10580";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	default:
	 { 
		$core['design']['color_primary'] = "#bb8e4d";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#ffe6c2";		
	} break;
}

 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Simply<span class='text-primary'>".$CORE->LAYOUT("captions","2")."</span>";    
 
$core['design']['header_style'] = "header102";
$core['design']['footer_style'] = "footer1";

/*layout data */
$core['design']['slot1_style'] = "hero3";
$core['design']['slot2_style'] = "text118";
$core['design']['slot3_style'] = "category100";
$core['design']['slot4_style'] = "listings100";
$core['design']['slot5_style'] = "text108";
$core['design']['slot6_style'] = "text102";
$core['design']['slot7_style'] = "";
 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 

/* hero*/
$core["home"]["hero3"]["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".$imgKey."/hero3.jpg";   
$core["home"]["hero3"]["title"] = "Looking for <br /> [".$CORE->LAYOUT("get_placeholder_text_new", array("code", "typewriter" ) )."]";
$core["home"]["hero3"]["title_animated"] = "ppt-animate-fade-in"; 
$core["home"]["hero3"]["subtitle"] = "We have hundreds of talented people waiting to hear from you, what are you looking for?";
 
$core["home"]["hero3"]["btn_show"] = "0";
$core["home"]["hero3"]["btn2_show"] = "0";
$core["home"]["hero3"]["searchbox"] = "1";

$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".$imgKey."/image3.jpg";   


/*text*/
$core["home"]["text118"]["section_bg"] = "bg-white";

/*cateorgy*/
$core["home"]["category101"]["section_bg"] = "bg-light";   
$core["home"]["category101"]["section_padding"] = "section-bottom-40"; 
$core["home"]["category101"]["section_divider"] = "5"; 
 
/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["show"] = "8";
$core["home"]["listings100"]["section_bg"] = "bg-white";  
$core["home"]["listings100"]["section_divider"] = "5"; 
    

switch(THEME_KEY){
	case "da":
	case "dl": { 
		$core['design']['slot3_style'] = "";
		$core["home"]["listings100"]["section_bg"] = "bg-light";  
	} break;
	case "sp": {	
	$core['design']['slot3_style'] = "";
	$core["home"]["listings100"]["section_divider"] = ""; 	
	} break;
}


return $core;

}
	
	
}

?>