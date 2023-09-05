<?php
 
add_filter( 'ppt_admin_layouts',  array('feb2022d',  'data') );
add_filter( 'feb2022d',  array('feb2022d',  'load' ) );
 
class feb2022d {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['feb2022d'] = array(
		
			"key" => "feb2022d",
		
			"name" 	=> "Feb 2022 d",
			 			
			"theme"	=> array("framework_feb","gym"),		
			
			"color_p" 	=> "",
			"color_s" 	=> "#000",
			"color_soft" => "",
			
			"order" => 0.4
 	 		
		);	

		switch(THEME_KEY){
			case "sp": {
				$a['feb2022d']["name"] = "Gym";
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
			$a['feb2022d']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".THEME_KEY."/4.jpg";
			} break;
			default: {
				$a['feb2022d']["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/d/4.jpg";	
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
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "dl": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "so": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "rt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "jb": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "vt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "dt": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#37adce";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
	} break;
	case "da": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#3faaa1";		
		$core['design']['color_secondary'] = "#717574"; 
		$core['design']['color_primary_soft'] = "#d9fffc";
	} break;
	case "pj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#34a3c6";		
		$core['design']['color_secondary'] = "#d24764"; 
		$core['design']['color_primary_soft'] = "#f0fbff";
	} break;
	case "mj": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#34a3c6";
		$core['design']['color_primary_soft'] = "#f0fbff";
		$core['design']['color_secondary'] = "#d24764"; 
	} break;
	case "es": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#c31131";
		$core['design']['color_primary_soft'] = "#fff5f7";
		$core['design']['color_secondary'] = "#000";
	} break;
	case "ct": {
		$imgKey = THEME_KEY;
		$core['design']['color_primary'] = "#c31131";
		$core['design']['color_primary_soft'] = "#fff5f7";
		$core['design']['color_secondary'] = "#000";
	} break;
	default: {
		$core['design']['color_primary'] = "#37adce";
		$core['design']['color_primary_soft'] = "#fff5f7";
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
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/hero4.jpg";   
$core["home"]["hero1"]["btn_bg"] = "btn-primary";   


/* colors */ 
switch(THEME_KEY){
	case "sp":
	case "vt":
	case "dt": {
	$core["home"]["hero1"]["title_color"] = "text-dark";  		
	$core["home"]["hero1"]["subtitle_color"] = "text-dark"; 
	$core["home"]["hero1"]["btn1_bg"] = "btn-primary"; 
	$core["home"]["hero1"]["btn2_bg"] = "btn-primary"; 
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
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/feb2022/".$imgKey."/image4.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";    

return $core;

}
	
	
}

?>