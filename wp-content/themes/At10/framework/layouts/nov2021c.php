<?php
 
add_filter( 'ppt_admin_layouts',  array('nov2021c',  'data') );
add_filter( 'nov2021c',  array('nov2021c',  'load') );
 
class nov2021c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['nov2021c'] = array(
		
			"key" => "nov2021c",
			"name" 	=> "Nov 2021 c", 
			"theme"	=> "framework_nov", 			
			"order" => 0.3
 	 		
		);		
		
		switch(THEME_KEY){
		
			case "dl":
			case "so": {
				$a['nov2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/".THEME_KEY."/3.jpg";	
			} break;
			default: {
				$a['nov2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/d/3.jpg";				
			} break; 
		}			 
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
 

/* colors */ 
switch(THEME_KEY){
 
	default: { 
		$core['design']['color_primary'] = "#1075d3";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#f8fffc";
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
$core['design']['slot1_style'] = "hero11";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text116";
$core['design']['slot4_style'] = "text101";
$core['design']['slot5_style'] = "blog1";
$core['design']['slot6_style'] = "";
$core['design']['slot7_style'] = "";
 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 
 

 
/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["show"] = "8";
$core["home"]["listings100"]["section_bg"] = "bg-white";  
 
/* footer */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-dark";  

$core["home"]["blog1"]["section_padding"] = "section-60";     
$core["home"]["blog1"]["title_margin"] = "mb-4";   

return $core;

}
	
	
}

?>