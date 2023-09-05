<?php
 
add_filter( 'ppt_admin_layouts',  array('mar2021d',  'data') );
add_filter( 'mar2021d',  array('mar2021d',  'load') );
 
class mar2021d {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['mar2021d'] = array(
		
			"key" => "mar2021d",
			"name" 	=> "Mar 2021 d", 
			"theme"	=> "framework_mar", 			
			"order" => 0.4
 	 		
		);		
		
		
		switch(THEME_KEY){			 
		  	
			case "sp":
			case "ct":
			case "es": {
			$a['mar2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/".THEME_KEY."/4.jpg";

			} break;
			default: {
			$a['mar2021d']["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/d/4.jpg";

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
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f1aa04";
		$core['design']['color_secondary'] = "#111";	
		$core['design']['color_primary_soft'] = "#fff6e0";
	} break; 
	default: { 
		$core['design']['color_primary'] = "#d26f76";
		$core['design']['color_secondary'] = "#3cb6ce";	
		$core['design']['color_primary_soft'] = "#eaf4ff";
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
$core['design']['slot1_style'] = "hero4";
$core['design']['slot2_style'] = "listings102";
$core['design']['slot3_style'] = "";
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';


$core["header"]["header102"]["header_bg"] = "bg-primary";
$core["header"]["header102"]["topmenu_bg"] = "bg-dark";
$core["header"]["header102"]["header_style"] = 1;
$core["header"]["header102"]["submenu_show"] = 1;
$core["header"]["header102"]["submenu_bg"] = 6;


/*listings*/
$core["home"]["listings102"]["card"] = "list";
$core["home"]["listings102"]["show"] = "10";

/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left-small";

$core["home"]["hero4"]["image"] = DEMO_IMG_PATH."/framework/layouts/mar2021/".$imgKey."/hero4.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-primary";
$core["home"]["hero4"]["btn2_bg"] = "btn-primary";

 

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