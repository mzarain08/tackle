<?php
 
add_filter( 'ppt_admin_layouts',  array('feb2022c',  'data') );
add_filter( 'feb2022c',  array('feb2022c',  'load') );
 
class feb2022c {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['feb2022c'] = array(
		
			"key" => "feb2022c",
		
			"name" 	=> "Feb 2022 c",
			"image"	=> _ppt_demopath()."/designs/style4c.jpg",
						
			"theme"	=> array("framework_feb","makeup"), 
			 
			"order" => 0.4
 	 		
		);	

		switch(THEME_KEY){
			case "sp": {
				$a['feb2022c']["name"] = "Makeup";
			} break;
		}
		
		switch(THEME_KEY){
			case "sp":
			case "dl":
			case "cp":
			case "so":
			case "rt":
			case "jb":	
			case "ll":	
			case "at":			 
		    case "vt":
			case "ct":
			case "dt":
			case "da":
			case "es":
			case "mj": 
			case "pj": {
			
			$a['feb2022c']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".THEME_KEY."/3.jpg";
			} break;
			default: {
				$a['feb2022c']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/d/3.jpg";		
			} break; 
		} 
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 


/* colors */ 
$imgKey = "d";
switch(THEME_KEY){
	case "sp": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "dl": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f5092c";		
		$core['design']['color_secondary'] = "#ffd400";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "so": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f5092c";		
		$core['design']['color_secondary'] = "#ffd400";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "rt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f5092c";		
		$core['design']['color_secondary'] = "#ffd400";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "jb": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f5092c";		
		$core['design']['color_secondary'] = "#ffd400";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "ll": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f5092c";		
		$core['design']['color_secondary'] = "#ffd400";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "dt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#780121";		
		$core['design']['color_secondary'] = "#fac300";
		$core['design']['color_primary_soft'] = "#ffe7ee";
	} break;
	case "da": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#6247a4";		
		$core['design']['color_secondary'] = "#de8798";
		$core['design']['color_primary_soft'] = "#f0ecff";
	} break;
	case "pj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#336eb8";
		$core['design']['color_primary_soft'] = "#f0ecff";
		$core['design']['color_secondary'] = "#f9b02c"; 
	} break;
	case "mj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#603dd4";
		$core['design']['color_primary_soft'] = "#f0ecff";
		$core['design']['color_secondary'] = "#f9b02c"; 
	} break;
	case "ct": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#618914";		
		$core['design']['color_secondary'] = "#ffc107";
		$core['design']['color_primary_soft'] = "#eeffcc";
	} break; 
	case "es": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#cac1b2";
		$core['design']['color_primary_soft'] = "#fbf8f2";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "vt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#e02a6b";
		$core['design']['color_primary_soft'] = "#ffedf3";
		$core['design']['color_secondary'] = "#000";
	} break;
	default: {
		$core['design']['color_primary'] = "#618914";		
		$core['design']['color_secondary'] = "#ffc107";
		$core['design']['color_primary_soft'] = "#eeffcc";
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
$core['design']['slot1_style'] = "hero1";
$core['design']['slot2_style'] = "listings100";
$core['design']['slot3_style'] = "text102";
$core['design']['slot4_style'] = "text122";
$core['design']['slot5_style'] = "listings99";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';

/*hero*/
$core["home"]["hero1"]["section_bg"] = "bg-light";   
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/hero3.jpg";   
$core["home"]["hero1"]["btn_bg"] = "btn-primary";   
$core["home"]["hero1"]["title_color"] = "text-light";  		
$core["home"]["hero1"]["subtitle_color"] = "text-light";  

/* listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["perrow"] = "4";  
$core["home"]["listings100"]["show"] = "4";  

/* listings*/
$core["home"]["listings99"]["section_padding"] = "section-40";  
$core["home"]["listings99"]["perrow"] = "4";  
$core["home"]["listings99"]["show"] = "12";  

/* text1 */    
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/image3.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";   
 

return $core;

}
	
	
}

?>