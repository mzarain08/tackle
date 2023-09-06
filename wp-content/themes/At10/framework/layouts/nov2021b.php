<?php
 
add_filter( 'ppt_admin_layouts',  array('nov2021b',  'data') );
add_filter( 'nov2021b',  array('nov2021b',  'load') );
 
class nov2021b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['nov2021b'] = array(
		
			"key" => "nov2021b",
			"name" 	=> "Nov 2021 b", 
			"theme"	=> "framework_nov", 			
			"order" => 0.2 	 		
		);
 
		switch(THEME_KEY){
			
			case "mj":
			case "rt":
			case "dl":
			case "cp":
			case "so":
			case "es": {
				$a['nov2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/".THEME_KEY."/2.jpg";				
			} break; 
			default: {
				$a['nov2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/d/2.jpg";				
			} break; 
		}		 
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
 

/* colors */ 
$imgKey = "d"; 
switch(THEME_KEY){
	case "dl": {
		$imgKey = THEME_KEY;  
		$core['design']['color_primary'] = "#ee7a16";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#fffaf6";
	} break; 	
	case "es": {
		$imgKey = THEME_KEY;  
		$core['design']['color_primary'] = "#ee7a16";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#fffaf6";
	} break; 	 
	default: { 
		$core['design']['color_primary'] = "#ee7a16";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#fffaf6";
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
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text116";
$core['design']['slot4_style'] = "text101";
$core['design']['slot5_style'] = "blog1";
$core['design']['slot6_style'] = "";
$core['design']['slot7_style'] = "";
 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 

/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["show"] = "8";
$core["home"]["listings100"]["section_bg"] = "bg-white";  
 
/* footer */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-dark";  

$core["home"]["blog1"]["section_padding"] = "section-60";     
$core["home"]["blog1"]["title_margin"] = "mb-4";   
 

/*hero*/
$core["home"]["hero1"]["section_overlay"] = "gradient-left-small";
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/".$imgKey."/hero2.jpg";   
$core["home"]["hero1"]["btn_show"] = "0";
$core["home"]["hero1"]["btn2_show"] = "0";
$core["home"]["hero1"]["searchboxmap"] = "1";


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