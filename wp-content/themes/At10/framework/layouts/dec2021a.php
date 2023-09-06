<?php
 
add_filter( 'ppt_admin_layouts',  array('dec2021a',  'data') );
add_filter( 'dec2021a',  array('dec2021a',  'load') );
 
class dec2021a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['dec2021a'] = array(
		
			"key" => "dec2021a",
			"name" 	=> "Dec 2021 a", 
			"theme"	=> array("framework_dec","vape","services"), 			
			"order" => 3.1
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['dec2021a']["name"] = "Vape";
			} break;
		}

		switch(THEME_KEY){
		
			case "vt":
			case "sp":
			case "cp":	 
		 	case "es":
			case "ct":
			case "dt":
			case "da":
 
			{
				$a['dec2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".THEME_KEY."/1.jpg";
			} break;
			default: {
				$a['dec2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/d/1.jpg";
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
		$core['design']['color_primary'] = "#7f5bd8";		
		$core['design']['color_secondary'] = "#111111"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "vt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#8d0707";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#e3e3e3";
	} break;
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#8d0707";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#e3e3e3";
	} break;
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#125ea6";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
	} break;
	case "dt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#125ea6";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
	} break;
	default: { 
		$core['design']['color_primary'] = "#125ea6";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
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
$core['design']['slot1_style'] = "hero4";
$core['design']['slot2_style'] = "listings101";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';

/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left-small";

$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/hero1.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-primary";
$core["home"]["hero4"]["btn2_bg"] = "btn-primary";

/*listings*/
$core["home"]["listings101"]["perrow"] = "3"; 
switch(THEME_KEY){
	case "es": { 
		$core["home"]["listings101"]["show"] = "6";  
	} break;
	default: {
		$core["home"]["listings101"]["show"] = "9";  
	} break;
} 


$core["home"]["listings101"]["image1"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/image1.jpg";   	
$core["home"]["listings101"]["image2"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/image1b.jpg";   	

/* listings*/
$core["home"]["listings100"]["section_bg"] = "bg-white";
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["perrow"] = "4";  
$core["home"]["listings100"]["show"] = "4";  

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


/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";    
 

return $core;

}
	
	
}

?>