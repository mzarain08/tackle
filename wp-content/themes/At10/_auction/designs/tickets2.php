<?php
 
add_filter( 'ppt_admin_layouts',  array('tickets2',  'data') );
add_filter( 'tickets2',  array('tickets2',  'load') );
 
class tickets2 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['tickets2'] = array(
		
			"key" => "tickets2",
		
			"name" 	=> "tickets2", 
						
			"theme"	=> "tickets", 
			 
			"order" => 0.1
 	 		
		);		
		
		$a['tickets2']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/tickets/2.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";

$core['design']['color_primary'] = "#2f2e33";
$core['design']['color_primary_soft'] = "";
$core['design']['color_secondary'] = "#fac300"; 
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Tickets <span class='text-secondary'>Auctions</span>";      
 
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

$core["home"]["hero4"]["image"] =  DEMO_IMG_PATH."/framework/layouts/_at/tickets/hero2.jpg";   
$core["home"]["hero4"]["btn_bg"] = "btn-secondary";
$core["home"]["hero4"]["btn2_bg"] = "btn-secondary";
 
/* colors */ 
$core["home"]["hero1"]["title_color"] = "text-dark";  		
$core["home"]["hero1"]["subtitle_color"] = "text-dark"; 

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";           

return $core;

}
	
	
}

?>