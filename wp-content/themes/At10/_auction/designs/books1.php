<?php
 
add_filter( 'ppt_admin_layouts',  array('books1',  'data') );
add_filter( 'books1',  array('books1',  'load') );
 
class books1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['books1'] = array(
		
			"key" => "books1",
		
			"name" 	=> "books1", 
						
			"theme"	=> "books", 
			 
			"order" => 0.1
 	 		
		);		
		
		$a['books1']["image"] = DEMO_IMG_PATH."/framework/layouts/_at/books/1.jpg";	
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
	
	
$core['design']['color_primary'] = "#f50402";
$core['design']['color_primary_soft'] = "#fafafb";
$core['design']['color_secondary'] = "#000"; 
 
/* fonts */
$core['design']['color_bg'] = "";
$core['design']['font_logo'] = "";
 
/* logo */
$core['design']['logo_url_aid'] = "";
$core['design']['light_logo_url_aid'] = "1";
$core['design']['textlogo'] = "Comic <span class='text-primary'>Auctions</span>";    
 
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
$core["home"]["hero1"]["image"] = DEMO_IMG_PATH."/framework/layouts/_at/books/hero1.jpg";   

/* colors */ 
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
$core["home"]["text102"]["image"] = DEMO_IMG_PATH."/framework/layouts/_at/books/image1.jpg";   	

/* footer1 */    
$core["footer"]["footer1"]["section_padding"] = "section-60";     
$core["footer"]["footer1"]["section_bg"] = "bg-black";     

return $core;

}
	
	
}

?>