<?php
 
add_filter( 'ppt_admin_layouts',  array('may2021a',  'data') );
add_filter( 'may2021a',  array('may2021a',  'load') );
 
class may2021a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['may2021a'] = array(
		
			"key" => "may2021a",
			"name" 	=> "May 2021 a", 
			"theme"	=> "framework_may", 			
			"order" => 0.1
 	 		
		);		
		
		
		 
		switch(THEME_KEY){
		
			case "sp":
			case "mj":
			case "rt":
			case "dl":
			case "cp":	 
		  	case "da":
			case "es": {
			$a['may2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/".THEME_KEY."/1.jpg";
			} break;
			default: {
			$a['may2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/d/1.jpg";
			} break; 
		}
		
		
		return $a;
	
	}  
	
	public static  function load($core){ global $CORE;  

/* colors */
$imgKey = "d"; 
switch(THEME_KEY){
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#12bfbc";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#b5dddd";
	} break; 
	default:
	 { 
		$core['design']['color_primary'] = "#ffbd00";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fafafb";
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
$core['design']['slot1_style'] = "hero1";
$core['design']['slot2_style'] = "text118";
$core['design']['slot3_style'] = "text128";
$core['design']['slot4_style'] = "listings100";
$core['design']['slot5_style'] = "text101";
$core['design']['slot6_style'] = "text104";
$core['design']['slot7_style'] = "";

 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 

/*hero*/
$core["home"]["hero1"]["section_overlay"] = "gradient-left-small";
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/".$imgKey."/hero1.jpg";   
$core["home"]["hero1"]["btn_show"] = "0";
$core["home"]["hero1"]["btn2_show"] = "0";
$core["home"]["hero1"]["searchbox"] = "1";
 
 
/*cateorgy*/
$core["home"]["text128"]["section_bg"] = "bg-white"; 
$core["home"]["text128"]["section_divider"] = "6"; 
 
/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["show"] = "8";
$core["home"]["listings100"]["section_bg"] = "bg-light";  
$core["home"]["listings100"]["section_divider"] = "7"; 
 
/* footer */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-dark"; 
 
 

/* colors */ 
switch(THEME_KEY){
	case "pj": {
	$core["home"]["hero1"]["title_color"] = "text-dark";  		
	$core["home"]["hero1"]["subtitle_color"] = "text-dark"; 
	} break;
	default: {
	$core["home"]["hero1"]["title_color"] = "text-light";  		
	$core["home"]["hero1"]["subtitle_color"] = "text-light"; 
	} break;
}

 

return $core;

}
	
	
}

?>