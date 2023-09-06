<?php
 
add_filter( 'ppt_admin_layouts',  array('sep2021b',  'data') );
add_filter( 'sep2021b',  array('sep2021b',  'load') );
 
class sep2021b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['sep2021b'] = array(
		
			"key" => "sep2021b",
			"name" 	=> "Sep 2021 b", 
			"theme"	=> array("framework_sep","restaurants"), 			
			"order" => 1.1
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['sep2021b']["name"] = "Vape";
			} break;
		}
	 
		switch(THEME_KEY){
		 	case "dt":
			case "vt":
			case "sp":
			case "da":
			case "es": {
			$a['sep2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/".THEME_KEY."/2.jpg";
			} break;
			default: {
			$a['sep2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/d/2.jpg";
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
		$core['design']['color_primary'] = "#b31f1f";
		$core['design']['color_secondary'] = "#ffc107";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#b31f1f";
		$core['design']['color_secondary'] = "#ffc107";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "da": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#a32496";
		$core['design']['color_secondary'] = "#ffc107";	
		$core['design']['color_primary_soft'] = "#ffedfd";
	} break; 
	default: { 
		$core['design']['color_primary'] = "#a20517";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#fff1f3";
	} break;
 
}

/* sidebar */
$core['design']['search_layout'] = "sidebar";

 
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
$core['design']['slot2_style'] = "listings103";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
 
$core["header"]["header102"]["topmenu_bg"] = "bg-black";



/*listings*/
$core["home"]["listings102"]["card"] = "grid";
$core["home"]["listings102"]["show"] = "15";

/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left";
$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/".$imgKey."/hero2.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-primary";
$core["home"]["hero4"]["btn2_bg"] = "btn-primary";

 

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