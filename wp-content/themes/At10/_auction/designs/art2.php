<?php
 
add_filter( 'ppt_admin_layouts',  array('art2',  'data') );
add_filter( 'art2',  array('art2',  'load') );
 
class art2 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['art2'] = array(
		
			"key" => "art2",
		
			"name" 	=> "art2", 
						
			"theme"	=> "art", 
			 
			"order" => 0.2
 	 		
		);		
		
		$a['art2']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/art/2.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";

$core['design']['color_primary'] = "#77133a";
$core['design']['color_primary_soft'] = "";
$core['design']['color_secondary'] = "#fac300"; 
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Art<span class='text-black'>Auctions</span>";      
 
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
$core["home"]["listings102"]["card"] = "grid";
$core["home"]["listings102"]["show"] = "15";

/*hero*/
$core["home"]["hero4"]["section_overlay"] = "gradient-left-small";

$core["home"]["hero4"]["image"] =  DEMO_IMG_PATH."/framework/layouts/_at/art/hero2.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-primary";
$core["home"]["hero4"]["btn2_bg"] = "btn-primary";
 $core["home"]["hero4"]["section_overlay"] = "gradient-left"; 
/* colors */ 
$core["home"]["hero1"]["title_color"] = "text-light";  		
$core["home"]["hero1"]["subtitle_color"] = "text-light"; 

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";       

return $core;

}
	
	
}

?>