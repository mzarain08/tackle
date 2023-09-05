<?php
 
add_filter( 'ppt_admin_layouts',  array('feb2022b',  'data') );
add_filter( 'feb2022b',  array('feb2022b',  'load') );
 
class feb2022b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['feb2022b'] = array(
		
			"key" => "feb2022b",
		
			"name" 	=> "Feb 2022 b",
			 			
			"theme"	=> array("framework_feb"),
			 
			"order" => 0.2
 	 		
		);	
			
		switch(THEME_KEY){
			case "sp": {
				$a['feb2022b']["name"] = "Fashion";
			} break;
		}
		
		switch(THEME_KEY){
			case "sp": 
			case "dl":
			case "cp":
			case "so":
			case "rt":
			case "jb":
			case "ll":
			case "at":			 
			case "vt":
			case "ct":
			case "dt":
			case "da":
			case "es":
			case "mj": 
			case "pj":
			{
			$a['feb2022b']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".THEME_KEY."/2.jpg";
			} break;
			default: {
				$a['feb2022b']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/d/2.jpg";		
			} break; 
		}
		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
 
 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){

	case "sp": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#D8AE5B";		
		$core['design']['color_secondary'] = "#111111"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	
	case "dl": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#dee2e6"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "so": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "rt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "jb": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "ll": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#fbd200"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "dt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#2775d3";		
		$core['design']['color_secondary'] = "#fac300"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "da": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#1075d3"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
	case "pj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#000";
		$core['design']['color_primary_soft'] = "#d6efff";
		$core['design']['color_secondary'] = "#3b92cd";
	} break;
	case "mj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#000";
		$core['design']['color_primary_soft'] = "#d6efff";
		$core['design']['color_secondary'] = "#3b92cd";
	} break;	
	case "es": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#FFC300";
		$core['design']['color_primary_soft'] = "#fafafb";
		$core['design']['color_secondary'] = "#000"; 
	} break; 	
	default: {		
		$core['design']['color_primary'] = "#FFC300";
		$core['design']['color_primary_soft'] = "#fafafb";
		$core['design']['color_secondary'] = "#000"; 
	} break;
}

 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Simply<span class='text-secondary'>".$CORE->LAYOUT("captions","2")."</span>";    
 
$core['design']['header_style'] = "header102";
$core['design']['footer_style'] = "footer1";

/*layout data */
$core['design']['slot1_style'] = "hero1";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text102";
$core['design']['slot4_style'] = "text122";
$core['design']['slot5_style'] = "listings99";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';

/*hero*/
$core["home"]["hero1"]["section_bg"] = "bg-light";   
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/hero2.jpg";   
switch(THEME_KEY){
	case "vt": {
$core["home"]["hero1"]["title_color"] = "text-dark";  		
$core["home"]["hero1"]["subtitle_color"] = "text-dark";  
 
	} break;
	default: {
$core["home"]["hero1"]["title_color"] = "text-light";  		
$core["home"]["hero1"]["subtitle_color"] = "text-light";  

	} break;
}


/* listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["perrow"] = "4";  
$core["home"]["listings100"]["show"] = "4";  

/* listings*/
$core["home"]["listings99"]["section_padding"] = "section-40";  
$core["home"]["listings99"]["perrow"] = "4";  
$core["home"]["listings99"]["show"] = "12";  

/* text1 */    
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/image2.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";     

return $core;

}
	
	
}

?>