<?php
 
add_filter( 'ppt_admin_layouts',  array('mar2021c',  'data') );
add_filter( 'mar2021c',  array('mar2021c',  'load') );
 
class mar2021c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['mar2021c'] = array(
		
			"key" => "mar2021c",
			"name" 	=> "Mar 2021 c", 
			"theme"	=> "framework_mar", 			
			"order" => 0.3
 	 		
		);		
		
		
		switch(THEME_KEY){			 
		  	
			case "sp":
			case "ct":
			case "es": {
			$a['mar2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/".THEME_KEY."/3.jpg";

			} break;
			default: {
			$a['mar2021c']["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/d/3.jpg";

			} break; 
		}	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){
	case "ct": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#182f8b";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break;
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#182f8b";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	default: { 
		$core['design']['color_primary'] = "#ffc300";
		$core['design']['color_secondary'] = "#125ea6";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
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
$core['design']['slot1_style'] = "hero4";
$core['design']['slot2_style'] = "listings102";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';


$core["header"]["header102"]["header_bg"] = "bg-secondary";
$core["header"]["header102"]["topmenu_bg"] = "bg-dark";
$core["header"]["header102"]["header_style"] = 1;
$core["header"]["header102"]["submenu_show"] = 1;
$core["header"]["header102"]["submenu_bg"] = 6;

/*listings*/
$core["home"]["listings102"]["card"] = "grid";
$core["home"]["listings102"]["show"] = "15";
/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left-small";

$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/".$imgKey."/hero3.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-secondary";
$core["home"]["hero4"]["btn2_bg"] = "btn-secondary";
 

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";    
 

return $core;

}
	
	
}

?>