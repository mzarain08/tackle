<?php
 
add_filter( 'ppt_admin_layouts',  array('sep2021a',  'data') );
add_filter( 'sep2021a',  array('sep2021a',  'load') );
 
class sep2021a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['sep2021a'] = array(
		
			"key" => "sep2021a",
			"name" 	=> "Sep 2021 a", 
			"theme"	=> array("framework_sep","fashion","services"), 			
			"order" => 1.1
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['sep2021a']["name"] = "Fashion";
			} break;
		}
	 
		switch(THEME_KEY){
		 	
			case "vt":
			case "sp":
			case "da":
			case "es": {
			$a['sep2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/".THEME_KEY."/1.jpg";
			} break;
			default: {
			$a['sep2021a']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/d/1.jpg";
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
		$core['design']['color_primary'] = "#000";
		$core['design']['color_secondary'] = "#ffc107";	
		$core['design']['color_primary_soft'] = "#f7f6f4";
	} break; 
	
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#fac300";		
		$core['design']['color_secondary'] = "#fbd200"; 
		$core['design']['color_primary_soft'] = "#fffae7";
	} break;
 
	default: { 
		$core['design']['color_primary'] = "#125ea6";
		$core['design']['color_secondary'] = "#ffc300";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
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
$core['design']['textlogo'] = "Simply<span class='text-secondary'>".$CORE->LAYOUT("captions","2")."</span>";    
 
$core['design']['header_style'] = "header102";
$core['design']['footer_style'] = "footer1";

/*layout data */
$core['design']['slot1_style'] = "listings103";
$core['design']['slot2_style'] = "";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 

/*listings*/
$core["home"]["listings102"]["card"] = "grid";
$core["home"]["listings102"]["show"] = "15";
 
 

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