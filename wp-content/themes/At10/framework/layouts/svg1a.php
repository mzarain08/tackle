<?php
 
add_filter( 'ppt_admin_layouts',  array('svg1a',  'data') );
add_filter( 'svg1a',  array('svg1a',  'load') );
 
class svg1a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['svg1a'] = array(
		
			"key" => "svg1a",
			"name" 	=> "Illustration 1", 
			"theme"	=> "framework_svg", 			
			"order" => 0.1
 	 		
		);	
		
		switch(THEME_KEY){ 
			 
			default: {
				$a['svg1a']["image"] = DEMO_IMG_PATH."/framework/layouts/svg/d/1.jpg";				
			} break; 
		}	
		  
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 
$core['design']['color_primary'] = "#4058ba";
$core['design']['color_primary_soft'] = "";
$core['design']['color_secondary'] = "#ffc107";
 
 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Simply<span class='text-primary'>".$CORE->LAYOUT("captions","2")."</span>";    
 
$core['design']['header_style'] = "header102";
$core['design']['footer_style'] = "footer2";

/*layout data */
$core['design']['slot1_style'] = "hero102";
$core['design']['slot2_style'] = "text154";
$core['design']['slot3_style'] = "headline5";
$core['design']['slot4_style'] = "listings2";
$core['design']['slot5_style'] = "text136";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
/*listings*/
$core['home']['listings100']['section_bg'] = "bg-white"; 

$core['home']['headline5']['title_underline_color'] = "#ffc107"; 

$core['home']['text136']['title_underline_color'] = "#ffc107"; 
$core['home']['text136']['section_bg'] = "section-bottom-80"; 

$core['footer']['footer2']['section_bg'] = "bg-white"; 

$core['header']['header102']['btn_show'] = 0; 
$core['header']['header102']['btn2_show'] = 0; 


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