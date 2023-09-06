<?php
 
add_filter( 'ppt_admin_layouts',  array('apr2021b',  'data') );
add_filter( 'apr2021b',  array('apr2021b',  'load') );
 
class apr2021b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['apr2021b'] = array(
		
			"key" => "apr2021b",
			"name" 	=> "Apr 2021 b", 
			"theme"	=> "framework_apr", 			
			"order" => 0.1 	 		
		);		
		
		 
		switch(THEME_KEY){
			case "es":
			case "sp":
			case "mj":
			case "dl":
			case "cp":			 
			case "ct":
			case "dt":  {
			$a['apr2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/apr2021/".THEME_KEY."/2.jpg"; 
			} break;
			default: {
				$a['apr2021b']["image"] = DEMO_IMG_PATH."/framework/layouts/apr2021/d/2.jpg";				
			} break; 
		}	
		 
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){
	case "dt":
	default: { 
		$core['design']['color_primary'] = "#042e46";
		$core['design']['color_secondary'] = "#000";	
		$core['design']['color_primary_soft'] = "#eef7ff";
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
$core['design']['slot1_style'] = "text125";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
/*listings*/
$core['home']['listings100']['section_bg'] = "bg-white"; 

 

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