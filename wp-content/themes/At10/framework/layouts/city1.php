<?php
 
add_filter( 'ppt_admin_layouts',  array('city1',  'data') );
add_filter( 'city1',  array('city1',  'load') );
 
class city1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['city1'] = array(
		
			"key" => "city1",
			"name" 	=> "Apr 2021 a", 
			"theme"	=> "framework_city", 			
			"order" => 0.1
 	 		
		);	
		 
		 
		switch(THEME_KEY){
			case "es":			
			case "dt": {
				$a['city1']["image"] = DEMO_IMG_PATH."/framework/layouts/city/".THEME_KEY."/1.jpg";
			} break;
			default: {
				$a['city1']["image"] = DEMO_IMG_PATH."/framework/layouts/city/d/1.jpg";
			} break; 
		} 
		
		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 




switch(THEME_KEY){
	case "es": { 
			$txt1 = "Escorts";
	} break;
	default: {
	
		$txt1 = $CORE->LAYOUT("captions","2");
	} break; 
}
	 
/* colors */
$core['design']['color_primary'] = "#d30a0b";  
$core['design']['color_secondary'] = "#f49900";
 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "UK <span class='text-primary'>".$txt1."</span>";    
 
$core['design']['header_style'] = "header118";
$core['design']['footer_style'] = "footer1";

/*layout data */
$core['design']['slot1_style'] = "category2";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text136";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
/*listings*/
$core['home']['listings100']['section_bg'] = "bg-white"; 
 

$core['home']['category2']['section_padding'] = "section-top-40";
$core['home']['category2']['tax'] = "country";
$core['home']['category2']['title'] = "{Nearby} ".$txt1."";
$core['home']['category2']['title_underline'] = "12";
$core['home']['category2']['title_underline_color'] = "#d30a0b";
$core['home']['category2']['title_font_size'] = "fs-lg";
$core['home']['category2']['desc'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. ";


$core['home']['category2']['hide_empty'] = 0;
$core['home']['category2']['limit'] = 28;

if(defined('WLT_DEMOMODE')){
$ss = get_terms( array(
				'taxonomy' => 'country',
				'hide_empty' => false,
				'number' => 1,				 
				'search' => "united kingdom",	
				"parent" => 0,			 
));
 
if(!is_wp_error( $ss ) && isset($ss[0])){
	
	$core['home']['category2']['tax'] = "country";
	$core['home']['category2']['cat_subs'] = 1;
	$core['home']['category2']['cat'] = $ss[0]->term_id;
	$core['home']['category2']['hide_empty'] = 0;

}
}
 

$core['home']['listings100']['title'] = "{Featured} ".$txt1."";
$core['home']['listings100']['title_underline'] = "12";
$core['home']['listings100']['title_underline_color'] = "#d30a0b";


$core['home']['text136']['section_padding'] = "section-40";
$core['home']['text136']['section_bg'] = "bg-white";
$core['home']['text136']['title_underline_color'] = "#000";
 

return $core;

}
	
	
}

?>