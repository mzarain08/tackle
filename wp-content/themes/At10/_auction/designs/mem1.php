<?php
 
add_filter( 'ppt_admin_layouts',  array('mem1',  'data') );
add_filter( 'mem1',  array('mem1',  'load') );
 
class mem1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['mem1'] = array(
		
			"key" => "mem1",
		
			"name" 	=> "mem1", 
						
			"theme"	=> "memorabilia", 
			 
			"order" => 0.1
 	 		
		);		
		
		$a['mem1']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/memorabilia/1.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
$imgKey = "at";
		$core['design']['color_primary'] = "#bd2d1f";		
		$core['design']['color_secondary'] = "#000"; 
		$core['design']['color_primary_soft'] = "#fbfbfb";
 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Memorabilia <span class='text-primary'>Auctions</span>";    
 
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
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/_at/memorabilia/hero1.jpg";   
$core["home"]["hero1"]["section_overlay"] = "gradient-left"; 

/* colors */ 
$core["home"]["hero1"]["title_color"] = "light-dark";  		
$core["home"]["hero1"]["subtitle_color"] = "light-dark"; 

/* listings*/
$core["home"]["listings100"]["section_padding"] = "section-40";
$core["home"]["listings100"]["perrow"] = "4";  
$core["home"]["listings100"]["show"] = "4";  

/* listings*/
$core["home"]["listings99"]["section_padding"] = "section-40";  
$core["home"]["listings99"]["perrow"] = "4";  
$core["home"]["listings99"]["show"] = "12";  

/* text1 */    
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/_at/memorabilia/image1.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";     

return $core;

}
	
	
}

?>