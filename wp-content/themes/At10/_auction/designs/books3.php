<?php
 
add_filter( 'ppt_admin_layouts',  array('books3',  'data') );
add_filter( 'books3',  array('books3',  'load') );
 
class books3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['books3'] = array(
		
			"key" => "books3",
		
			"name" 	=> "books3", 
						
			"theme"	=> "books", 
			 
			"order" => 0.3
 	 		
		);		
		
		$a['books3']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/books/3.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
$core['design']['search_sponsored'] = 0;
$core['design']['search_filters'] = 1;

//$core['searchcustom']['perrow'] = 5;	
  
/* colors */
$core['design']['color_primary'] = "#ed3030";  
$core['design']['color_secondary'] = "#292b2c";
$core['design']['color_link_dark'] = ""; 

$core['design']['color_border'] = ""; 

$core['design']['color_bg'] = "";
$core['design']['color_text'] = "";
 
$core['design']['color_box'] = "";
$core['design']['color_box_text'] = "";

$core['design']['color_search'] = "#1f2121";
$core['design']['color_search_text'] = "#fff";


$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Comic <span class='text-primary'>Auctions</span>";    
 
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
$core['home']['listings100']['title_underline_color'] = "#ed3030";
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