<?php
 
add_filter( 'ppt_admin_layouts',  array('may2021b',  'data') );
add_filter( 'may2021b',  array('may2021b',  'load') );
 
class may2021b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['may2021b'] = array(
		
			"key" => "may2021b",
			"name" 	=> "May 2021 b", 
			"theme"	=> "framework_may", 			
			"order" => 0.2
 	 		
		);		
		
		
		switch(THEME_KEY){
			
			case "sp":
			case "mj":
			case "rt":
			case "dl":		 
		  	case "da":
			case "es": {
				$a['may2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/".THEME_KEY."/2.jpg";
			} break;
			default: {
				$a['may2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/d/2.jpg";
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
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "mj": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "rt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "dl": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	default: { 
		$core['design']['color_primary'] = "#1c901c";
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
$core['design']['slot1_style'] = "hero5";
$core['design']['slot2_style'] = "text118";
$core['design']['slot3_style'] = "text128";
$core['design']['slot4_style'] = "listings100";
$core['design']['slot5_style'] = "text101";
$core['design']['slot6_style'] = "text104";
$core['design']['slot7_style'] = "";
 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 

/*hero*/ 
$core["home"]["hero5"]["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/".$imgKey."/hero2.jpg";   

 
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
 
 

return $core;

}
	
	
}

?>