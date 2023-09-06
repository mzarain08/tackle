<?php
 
add_filter( 'ppt_admin_layouts',  array('sep2021c',  'data') );
add_filter( 'sep2021c',  array('sep2021c',  'load') );
 
class sep2021c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['sep2021c'] = array(
		
			"key" => "sep2021c",
			"name" 	=> "Sep 2021 c", 
			"theme"	=> array("framework_sep","makeup"),			
			"order" => 1.3
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['sep2021c']["name"] = "Makeup";
			} break;
		}
	 
		switch(THEME_KEY){
		 	
			case "dt":
			case "vt":
			case "sp":
			case "da":
			case "es": {
			$a['sep2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/".THEME_KEY."/3.jpg";
			} break;
			default: {
			$a['sep2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/d/3.jpg";
			} break; 
		}
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){

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
		$core['design']['color_primary'] = "#d64063";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#fafafb";
	} break; 
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#ff8f00";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#f0f0f0";
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
 
 
$core["header"]["header102"]["topmenu_bg"] = "bg-dark";



/*listings*/
$core["home"]["listings102"]["card"] = "grid";
$core["home"]["listings102"]["show"] = "15";

/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left";
$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/sep2021/".$imgKey."/hero3.jpg";   
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