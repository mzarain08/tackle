<?php
 
add_filter( 'ppt_admin_layouts',  array('dec2021c',  'data') );
add_filter( 'dec2021c',  array('dec2021c',  'load') );
 
class dec2021c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['dec2021c'] = array(
		
			"key" => "dec2021c",
			"name" 	=> "Dec 2021 c", 
			"theme"	=> array("framework_dec","makeup"), 			
			"order" => 3.3
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['dec2021c']["name"] = "Makeup";
			} break;
		}
		 
		switch(THEME_KEY){
			
			case "dt":
			case "sp":
			case "cp":		 
		 	case "es":
			case "ct":
			case "dt":
			case "da":
 
			{
				$a['dec2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".THEME_KEY."/3.jpg";
			} break;
			default: {
				$a['dec2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/d/3.jpg";
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
	case "sp": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#75e0d2";
		$core['design']['color_secondary'] = "#ed145b";	
		$core['design']['color_primary_soft'] = "#e7fffc";
	} break;
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#75e0d2";
		$core['design']['color_secondary'] = "#ed145b";	
		$core['design']['color_primary_soft'] = "#e7fffc";
	} break;
	case "dt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#75e0d2";
		$core['design']['color_secondary'] = "#ed145b";	
		$core['design']['color_primary_soft'] = "#e7fffc";
	} break;
	default: { 
		$core['design']['color_primary'] = "#75e0d2";
		$core['design']['color_secondary'] = "#ed145b";	
		$core['design']['color_primary_soft'] = "#e7fffc";
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

$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/hero3.jpg";   
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

$core["home"]["listings101"]["image1"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/image3.jpg";   	
$core["home"]["listings101"]["image2"] = DEMO_IMG_PATH."/framework/layouts/dec2021/".$imgKey."/image3b.jpg";   	

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