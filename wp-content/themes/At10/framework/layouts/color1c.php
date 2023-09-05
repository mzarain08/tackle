<?php
 
add_filter( 'ppt_admin_layouts',  array('color1c',  'data') );
add_filter( 'color1c',  array('color1c',  'load') );
 
class color1c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['color1c'] = array(
		
			"key" => "color1c",
			"name" 	=> "color1c", 
			"theme"	=> "framework_color1", 			
			"order" => 0.1
 	 		
		);	
		
		switch(THEME_KEY){
		 
			case "es":
 
			{
				$a['color1c']["image"] = DEMO_IMG_PATH."/framework/layouts/color1/".THEME_KEY."/3.jpg";
			} break;
			default: {
				$a['color1c']["image"] = DEMO_IMG_PATH."/framework/layouts/color1/d/3.jpg";
			} break; 
		} 
		 	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	
	
$core['design']['search_sponsored'] = 0;
$core['design']['search_filters'] = 1;

//$core['searchcustom']['perrow'] = 5;	


 	 
/* colors */
$core['design']['color_primary'] = "#ac0606";  
$core['design']['color_secondary'] = "#f8a602";
$core['design']['color_link_dark'] = ""; 

$core['design']['color_border'] = ""; 

$core['design']['color_bg'] = "";
$core['design']['color_text'] = "";
 
$core['design']['color_box'] = "";
$core['design']['color_box_text'] = "";

$core['design']['color_search'] = "#252525";
$core['design']['color_search_text'] = "#fff";


$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "UK <span class='text-primary'>Escorts</span>";    
 
$core['design']['header_style'] = "header130";
$core['design']['footer_style'] = "footer1";

/*layout data */
$core['design']['slot1_style'] = "search1";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text136";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';



$core['header']['header130']['header_bg_color'] = "#111111"; 
 
$core['home']['search1']['section_bg_color'] = "#111111";
 

$core['home']['listings100']['title'] = "{Featured} Escorts";
$core['home']['listings100']['title_underline'] = "12";
$core['home']['listings100']['title_underline_color'] = "#ac0606";
$core['home']['listings100']['btn_bg'] = "btn-primary";
 
$core['home']['text136']['section_padding'] = "section-40";
$core['home']['text136']['section_bg'] = "";
$core['home']['text136']['title_underline_color'] = "#000";
 

return $core;

}
	
	
}

?>