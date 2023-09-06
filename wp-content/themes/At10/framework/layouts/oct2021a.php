<?php
 
add_filter( 'ppt_admin_layouts',  array('oct2021a',  'data') );
add_filter( 'oct2021a',  array('oct2021a',  'load') );
 
class oct2021a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['oct2021a'] = array(
		
			"key" => "oct2021a",
			"name" 	=> "Oct 2021 a", 
			"theme"	=> array("framework_oct","restaurants"),	
			"order" => 2.1
 	 		
		);	
			
		switch(THEME_KEY){
			case "sp": {
				$a['oct2021a']["name"] = "Fashion";
			} break;
		}
		switch(THEME_KEY){			 
			
			
			case "dt":
			case "vt":
			case "sp":
			case "da":
			case "dl":
			case "so":
			case "es": {
				$a['oct2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".THEME_KEY."/1.jpg";
			} break;
			default: {
				$a['oct2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/d/1.jpg";			
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
		$core['design']['color_primary'] = "#D8AE5B";		
		$core['design']['color_secondary'] = "#111111"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";	
	} break;
	
	case "sp": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#D8AE5B";		
		$core['design']['color_secondary'] = "#111111"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";	
	} break;
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#fafafb";		
	} break;
	case "dl": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#fbd200"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	default:
	 { 
		$core['design']['color_primary'] = "#cf580a";
		$core['design']['color_secondary'] = "#111";
		$core['design']['color_primary_soft'] = "#fff5ef";		
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
$core["home"]["hero3"]["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".$imgKey."/hero1.jpg";   
$core["home"]["hero3"]["title"] = "Looking for <br /> [".$CORE->LAYOUT("get_placeholder_text_new", array("code", "typewriter" ) )."]";
$core["home"]["hero3"]["title_animated"] = "ppt-animate-rise-in"; 
$core["home"]["hero3"]["subtitle"] = "We have hundreds of talented people waiting to hear from you, what are you looking for?";
 

$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/oct2021/".$imgKey."/image1.jpg";   


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