<?php
 
add_filter( 'ppt_admin_layouts',  array('antiques3',  'data') );
add_filter( 'antiques3',  array('antiques3',  'load') );
 
class antiques3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['antiques3'] = array(
		
			"key" => "antiques3",
		
			"name" 	=> "antiques 3", 
						
			"theme"	=> "antiques", 
			 
			"order" => 0.1
 	 		
		);		
		
		$a['antiques3']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/antiques/3.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	
$core['design']['search_sponsored'] = 0;
$core['design']['search_filters'] = 1;

//$core['searchcustom']['perrow'] = 5;	
  
/* colors */
$core['design']['color_primary'] = "#b58e50";  
$core['design']['color_secondary'] = "#292b2c";
$core['design']['color_link_dark'] = ""; 

$core['design']['color_border'] = ""; 

$core['design']['color_bg'] = "";
$core['design']['color_text'] = "";
 
$core['design']['color_box'] = "";
$core['design']['color_box_text'] = "";

$core['design']['color_search'] = "#ffffff";
$core['design']['color_search_text'] = "";


$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Antiques <span class='text-primary'>Auctions</span>";    
 
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



$core['header']['header130']['header_bg_color'] = "#292b2c"; 
 
$core['home']['search1']['section_bg_color'] = "#292b2c";
 

$core['home']['listings100']['title'] = "{Featured} Auctions";
$core['home']['listings100']['title_underline'] = "12";
$core['home']['listings100']['title_underline_color'] = "#b58e50";
$core['home']['listings100']['btn_bg'] = "btn-primary";
$core['home']['listings100']['section_bg'] = "bg-white";
 
$core['home']['text136']['section_padding'] = "section-40";
$core['home']['text136']['section_bg'] = "";
$core['home']['text136']['title_underline_color'] = "#000";
$core['home']['text136']['section_bg'] = "bg-white"; 

return $core;

}
	
	
}

?>