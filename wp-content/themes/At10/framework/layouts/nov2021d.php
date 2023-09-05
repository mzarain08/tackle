<?php
 
add_filter( 'ppt_admin_layouts',  array('nov2021d',  'data') );
add_filter( 'nov2021d',  array('nov2021d',  'load') );
 
class nov2021d {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['nov2021d'] = array(
		
			"key" => "nov2021d",
			"name" 	=> "Nov 2021 d", 
			"theme"	=> "framework_nov", 			
			"order" => 0.4
 	 		
		);		


		switch(THEME_KEY){	
				 
		  	case "dl":
			case "so": {
			$a['nov2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/".THEME_KEY."/4.jpg";
			} break;
			default: {
			$a['nov2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/nov2021/d/4.jpg";	
			} break; 
		}
		 
		
		return $a;	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
 

/* colors */ 
$imgKey = "d"; 
switch(THEME_KEY){
	 
	default: { 
		$core['design']['color_primary'] = "#495057";
		$core['design']['color_secondary'] = "#fac300";	
		$core['design']['color_primary_soft'] = "#ebebeb";
	} break; 
}
 
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
$core['design']['slot1_style'] = "hero9";
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
 

 /*hero*/
$core["home"]["hero9"]["section_bg"] = "bg-primary";
$core["home"]["hero9"]["searchboxmap"] = "1";
 

return $core;

}
	
	
}

?>