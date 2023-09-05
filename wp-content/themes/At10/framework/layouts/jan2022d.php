<?php
 
add_filter( 'ppt_admin_layouts',  array('jan2022d',  'data') );
add_filter( 'jan2022d',  array('jan2022d',  'load') );
 
class jan2022d {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['jan2022d'] = array(
		
			"key" => "jan2022d",		
			"name" 	=> "Jan 2022 d",
			"theme"	=> "framework_jan", 			
			"order" => 0.1
 	 		
		);		
		
		
		switch(THEME_KEY){
			case "at":
			case "dl":
			case "cp":
			case "so":
			case "rt":
			case "mj":	
			case "at":
			case "jb":
			case "ll":		 
		 	case "vt":
			case "ct":
			case "dt":
			case "da":
			case "es":
 
			{
				$a['jan2022d']["image"] = DEMO_IMG_PATH."/framework/layouts/jan2022/".THEME_KEY."/4.jpg";
			} break;
			default: {
				$a['jan2022d']["image"] = DEMO_IMG_PATH."/framework/layouts/jan2022/d/4.jpg";
			} break; 
		} 
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	 

/* colors */ 
$imgKey = "d";
switch(THEME_KEY){
	case "dl": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "cp": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "so": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "rt": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "mj": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "at": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "jb": { 
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3b5998";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#e7efff";		
	} break;
	case "ll": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#822423";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#ffeaea";
	} break;
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#822423";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#ffeaea";
	} break;
	case "da": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#822423";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#ffeaea";
	} break;
	case "ct": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#ff8300";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#fff1e1";
	} break;
	case "dt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#822423";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#ffeaea";
	} break;
	case "es": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#1891cb";
		$core['design']['color_secondary'] = "#1a1a1a";
		$core['design']['color_primary_soft'] = "#f0f9f3";	
	} break;
	
	default: {
		$core['design']['color_primary'] = "#ff8300";
		$core['design']['color_secondary'] = "#111"; 
		$core['design']['color_primary_soft'] = "#fff0e0";
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
$core['design']['slot1_style'] = "hero2";
$core['design']['slot2_style'] = "text123";
if(!in_array(THEME_KEY,array("da","es"))){
$core['design']['slot3_style'] = "listings100";
}else{
$core['design']['slot3_style'] = "";
}
$core['design']['slot4_style'] = "";
$core['design']['slot5_style'] = "";
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';

/*listings*/
$core["home"]["listings100"]["section_padding"] = "section-none"; 


/*hero*/
$core["home"]["hero2"]["section_bg"] = "bg-light";   
$core["home"]["hero2"]["image"] = DEMO_IMG_PATH."/framework/layouts/jan2022/".$imgKey."/hero4.jpg";   

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
 
/* text1 */    
$core["home"]["text123"]["image"] = DEMO_IMG_PATH."/framework/layouts/jan2022/".$imgKey."/image4.jpg";   	
    

return $core;

}
	
	
}

?>