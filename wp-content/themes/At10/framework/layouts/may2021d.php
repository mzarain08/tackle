<?php
 
add_filter( 'ppt_admin_layouts',  array('may2021d',  'data') );
add_filter( 'may2021d',  array('may2021d',  'load') );
 
class may2021d {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['may2021d'] = array(
		
			"key" => "may2021d",
			"name" 	=> "May 2021 d", 
			"theme"	=> "framework_may", 			
			"order" => 0.4
 	 		
		);	
			
		switch(THEME_KEY){			 
		  	
			case "sp":
			case "xx":
 
			{
				$a['may2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/".THEME_KEY."/4.jpg";
			} break;
			default: {
				$a['may2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/may2021/d/4.jpg";
			} break; 
		} 
		
		 
		return $a;
	
	}  
	
	public static  function load($core){ global $CORE;  

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){

 
	default: { 
	
		$core['design']['color_primary'] = "#7646fe";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fafafb";

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
$core['design']['slot1_style'] = "hero9";
$core['design']['slot2_style'] = "text118";
$core['design']['slot3_style'] = "text128";
$core['design']['slot4_style'] = "listings100";
$core['design']['slot5_style'] = "text101";
$core['design']['slot6_style'] = "text104";
$core['design']['slot7_style'] = "";
 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = ''; 


 $core["home"]["hero9"]["section_bg"] = "bg-primary"; 
 
/*cateorgy*/
$core["home"]["text128"]["section_bg"] = "bg-white"; 
$core["home"]["text128"]["section_divider"] = "5"; 
 
/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["show"] = "8";
$core["home"]["listings100"]["section_bg"] = "bg-light";  
$core["home"]["listings100"]["section_divider"] = "7"; 
 
/* footer */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-dark"; 
 
 

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

 

return $core;

}
	
	
}

?>