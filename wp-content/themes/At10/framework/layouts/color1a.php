<?php
 
add_filter( 'ppt_admin_layouts',  array('color1a',  'data') );
add_filter( 'color1a',  array('color1a',  'load') );
 
class color1a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['color1a'] = array(
		
			"key" => "color1a",
			"name" 	=> "color1a", 
			"theme"	=> "framework_color1", 			
			"order" => 0.1
 	 		
		);	
		
		switch(THEME_KEY){
		
		 
			case "es":
 
			{
				$a['color1a']["image"] = DEMO_IMG_PATH."/framework/layouts/color1/".THEME_KEY."/1.jpg";
			} break;
			default: {
				$a['color1a']["image"] = DEMO_IMG_PATH."/framework/layouts/color1/d/1.jpg";
			} break; 
		} 
		 	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	
	
$core['design']['search_sponsored'] = 0;
$core['design']['search_filters'] = 2;

//$core['searchcustom']['perrow'] = 5;	


 	 
/* colors */
$core['design']['color_primary'] = "#ffac66";  
$core['design']['color_secondary'] = "#f49900";
$core['design']['color_link_dark'] = "#fff"; 
$core['design']['color_border'] = "#494746"; 
$core['design']['color_bg'] = "#242221";
$core['design']['color_text'] = "#fff";
 
$core['design']['color_box'] = "#3e3938";
$core['design']['color_box_text'] = "#fff";


$core['design']['color_search'] = "#3e3938";
$core['design']['color_search_text'] = "#fff";


$core['design']['color_breadcrumbs'] = "#f9ac66";
$core['design']['color_breadcrumbs_text'] = "#fff";


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
$core['home']['listings100']['title_underline_color'] = "#ffac66";
$core['home']['listings100']['btn_bg'] = "btn-primary";
$core['home']['listings100']['title_color'] = "#ffffff";

$core['home']['text136']['section_padding'] = "section-40";
$core['home']['text136']['section_bg'] = "";
$core['home']['text136']['title_underline_color'] = "#000";
 

return $core;

}
	
	
}

?>