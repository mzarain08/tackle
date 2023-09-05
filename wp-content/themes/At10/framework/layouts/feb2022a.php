<?php
 
add_filter( 'ppt_admin_layouts',  array('feb2022a',  'data') );
add_filter( 'feb2022a',  array('feb2022a',  'load') );
 
class feb2022a {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['feb2022a'] = array(
		
			"key" => "feb2022a",
		
			"name" 	=> "Feb 2022 a", 
						
			"theme"	=> array("framework_feb","vape","services"), 
			 
			"order" => 0.1
 	 		
		);		
		
		switch(THEME_KEY){
			case "sp": {
				$a['feb2022a']["name"] = "Vape";
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
			case "pj":
			{
			$a['feb2022a']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".THEME_KEY."/1.jpg";
			} break;
			default: {
				$a['feb2022a']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/d/1.jpg";			
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
		$core['design']['color_primary'] = "#7f5bd8";		
		$core['design']['color_secondary'] = "#111111"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "dl": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f65e6e";		
		$core['design']['color_secondary'] = "#22191a"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "so": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f65e6e";		
		$core['design']['color_secondary'] = "#22191a"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "rt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#1b8251";		
		$core['design']['color_secondary'] = "#32373d"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "jb": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f65e6e";		
		$core['design']['color_secondary'] = "#22191a"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "ll": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f65e6e";		
		$core['design']['color_secondary'] = "#22191a"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f65e6e";		
		$core['design']['color_secondary'] = "#22191a"; 
		$core['design']['color_primary_soft'] = "#f3f3f3";
	} break;
	case "ct": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#1075d3";		
		$core['design']['color_secondary'] = "#fac300"; 
		$core['design']['color_primary_soft'] = "#d3eaff";
	} break;
	case "dt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#63269c";		
		$core['design']['color_secondary'] = "#fac300"; 
		$core['design']['color_primary_soft'] = "#efe4fc";
	} break;
	case "da": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#6108ac";		
		$core['design']['color_secondary'] = "#fac300"; 
		$core['design']['color_primary_soft'] = "#fafafb";
	} break;
	case "pj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#379dc6";
		$core['design']['color_primary_soft'] = "#d5f4ff";
		$core['design']['color_secondary'] = "#111"; 
	} break;
	case "mj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#f0ac18";
		$core['design']['color_primary_soft'] = "#fff9eb";
		$core['design']['color_secondary'] = "#111"; 
	} break;
	case "es": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#FFC300";
		$core['design']['color_primary_soft'] = "#fafafb";
		$core['design']['color_secondary'] = "#000"; 
	} break;	
	default: {
		$core['design']['color_primary'] = "#FFC300";
		$core['design']['color_primary_soft'] = "#fafafb";
		$core['design']['color_secondary'] = "#000"; 
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
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/hero1.jpg";   

/* colors */ 
switch(THEME_KEY){
	case "so":
 	case "rt":
	case "pj": {
	$core["home"]["hero1"]["title_color"] = "text-dark";  		
	$core["home"]["hero1"]["subtitle_color"] = "text-dark"; 
	} break;
	default: {
	$core["home"]["hero1"]["title_color"] = "text-light";  		
	$core["home"]["hero1"]["subtitle_color"] = "text-light"; 
	} break;
}

 

/* listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["perrow"] = "4";  
$core["home"]["listings100"]["show"] = "4";  

/* listings*/
$core["home"]["listings99"]["section_padding"] = "section-40";  
$core["home"]["listings99"]["perrow"] = "4";  
$core["home"]["listings99"]["show"] = "12";  

/* text1 */    
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/image1.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";     

return $core;

}
	
	
}

?>