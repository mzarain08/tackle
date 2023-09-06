<?php
 
add_filter( 'ppt_admin_layouts',  array('at_cars3',  'data') );
add_filter( 'at_cars3',  array('at_cars3',  'load') );
 
class at_cars3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_cars3'] = array(
		
			"key" => "at_cars3",
		
			"name" 	=> "Car Auctions",
			"image"	=> _ppt_demopath()."/designs/cars3.jpg",
						
			"theme"	=> "at_cars", 
			
			"color_p" 	=> "#1075d3",
			"color_s" 	=> "#222222",
			
			"order" => 1.2
 	 		
		);		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
  
 $core['design']['single_layout'] = "4";
 $core['design']['search_layout'] = "5";
 $core['design']['search_card'] = "2";
 $core['lst']['makemodels'] = "1";
 
 
 $core['design']['single_top'] = "full_gallery";
 
 
	/* logo */
	$core['design']['logo_url_aid'] = "";
	$core['design']['logo_url'] = "";
	$core['design']['light_logo_url_aid'] = "";
	$core['design']['light_logo_url'] = "";
	$core['design']['textlogo'] = "<i class='fal fa-car ml-2 text-primary'>&nbsp;</i> <span class='font-weight-bold text-primary'>Car</span>Auctions";  
 

$core['design']['header_style'] = "header22";
$core['design']['footer_style'] = "footer1";

$core['design']['color_primary'] = "#1075d3";
$core['design']['color_secondary'] = "#222222";
 
 		
 $core['design']['slot1_style'] = "hero_text1";
$core['design']['slot2_style'] = "listings1";
$core['design']['slot3_style'] = "text2";
$core['design']['slot4_style'] = "text1";
$core['design']['slot5_style'] = "listings2a";
$core['design']['slot6_style'] = "subscribe2";
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
 
        /* hero_text1 */    
        $core["home"]["hero_text1"]["section_padding"] = "section-80";     
        $core["home"]["hero_text1"]["section_bg"] = "bg-light";     
        $core["home"]["hero_text1"]["section_pos"] = "";     
        $core["home"]["hero_text1"]["section_w"] = "container";     
        $core["home"]["hero_text1"]["section_pattern"] = "";     
        $core["home"]["hero_text1"]["title_show"] = "yes";     
        $core["home"]["hero_text1"]["title"] = "Car Auctions";     
        $core["home"]["hero_text1"]["subtitle"] = "Big saving on amazing cars!";     
        $core["home"]["hero_text1"]["desc"] = " ";     
        $core["home"]["hero_text1"]["title_style"] = "1";     
        $core["home"]["hero_text1"]["title_pos"] = "left";     
        $core["home"]["hero_text1"]["title_heading"] = "h1";     
        $core["home"]["hero_text1"]["title_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["desc_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["title_txtcolor"] = "dark";     
        $core["home"]["hero_text1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["hero_text1"]["desc_txtcolor"] = "dark";     
        $core["home"]["hero_text1"]["title_font"] = "";     
        $core["home"]["hero_text1"]["subtitle_font"] = "";     
        $core["home"]["hero_text1"]["desc_font"] = "";     
        $core["home"]["hero_text1"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["btn_show"] = "yes";     
        $core["home"]["hero_text1"]["btn_link"] = "[link-search]";     
        $core["home"]["hero_text1"]["btn_txt"] = "View Auctions";     
        $core["home"]["hero_text1"]["btn_bg"] = "light";     
        $core["home"]["hero_text1"]["btn_bg_txt"] = "text-dark";     
        $core["home"]["hero_text1"]["btn_icon"] = "fas fa-long-arrow-alt-right";     
        $core["home"]["hero_text1"]["btn_icon_pos"] = "after";     
        $core["home"]["hero_text1"]["btn_size"] = "btn-xl";     
        $core["home"]["hero_text1"]["btn_margin"] = "mt-5";     
        $core["home"]["hero_text1"]["btn_style"] = "3";     
        $core["home"]["hero_text1"]["btn_font"] = "";     
        $core["home"]["hero_text1"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["btn2_show"] = "no";     
        $core["home"]["hero_text1"]["hero_image"] = "http://localhost/V10IMAGES/_demoimagesv10/at/cars/hero4.jpg";     
        $core["home"]["hero_text1"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text1"]["hero_overlay"] = "";     
        $core["home"]["hero_text1"]["hero_txtcolor"] = "light"; 		
 
        /* listings1 */    
        $core["home"]["listings1"]["section_padding"] = "section-80";     
        $core["home"]["listings1"]["section_bg"] = "bg-white";     
        $core["home"]["listings1"]["section_pos"] = "";     
        $core["home"]["listings1"]["section_w"] = "container";     
        $core["home"]["listings1"]["section_pattern"] = "";     
        $core["home"]["listings1"]["title_show"] = "yes";     
        $core["home"]["listings1"]["title"] = "Featured Auctions";     
        $core["home"]["listings1"]["subtitle"] = "Take a look at some of our latest items.";     
        $core["home"]["listings1"]["desc"] = " ";     
        $core["home"]["listings1"]["title_style"] = "1";     
        $core["home"]["listings1"]["title_pos"] = "left";     
        $core["home"]["listings1"]["title_heading"] = "h3";     
        $core["home"]["listings1"]["title_margin"] = "mb-2";     
        $core["home"]["listings1"]["subtitle_margin"] = "mb-1";     
        $core["home"]["listings1"]["desc_margin"] = "mb-0";     
        $core["home"]["listings1"]["title_txtcolor"] = "dark";     
        $core["home"]["listings1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings1"]["title_font"] = "";     
        $core["home"]["listings1"]["subtitle_font"] = "";     
        $core["home"]["listings1"]["desc_font"] = "";     
        $core["home"]["listings1"]["title_txtw"] = "text-800";     
        $core["home"]["listings1"]["subtitle_txtw"] = "text-700";     
        $core["home"]["listings1"]["datastring"] = " dataonly='1' cat='' card='info' perrow='4' show='8' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings1"]["perrow"] = "4";     
        $core["home"]["listings1"]["card"] = "info";     
        $core["home"]["listings1"]["limit"] = "8";     
        $core["home"]["listings1"]["custom"] = "new";     
        $core["home"]["listings1"]["category_ids"] = ""; 		
 
        /* text2 */    
        $core["home"]["text2"]["section_padding"] = "section-80";     
        $core["home"]["text2"]["section_bg"] = "bg-light";     
        $core["home"]["text2"]["section_pos"] = "";     
        $core["home"]["text2"]["section_w"] = "container";     
        $core["home"]["text2"]["section_pattern"] = "";     
        $core["home"]["text2"]["title_show"] = "yes";     
        $core["home"]["text2"]["title"] = "Buy & sell your old stuff!";     
        $core["home"]["text2"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";     
        $core["home"]["text2"]["desc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";     
        $core["home"]["text2"]["title_style"] = "2";     
        $core["home"]["text2"]["title_pos"] = "left";     
        $core["home"]["text2"]["title_heading"] = "h2";     
        $core["home"]["text2"]["title_margin"] = "mb-4";     
        $core["home"]["text2"]["subtitle_margin"] = "mb-4";     
        $core["home"]["text2"]["desc_margin"] = "mb-4";     
        $core["home"]["text2"]["title_txtcolor"] = "dark";     
        $core["home"]["text2"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["text2"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text2"]["title_font"] = "";     
        $core["home"]["text2"]["subtitle_font"] = "";     
        $core["home"]["text2"]["desc_font"] = "";     
        $core["home"]["text2"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["text2"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["text2"]["btn_show"] = "yes";     
        $core["home"]["text2"]["btn_link"] = "[link-search]";     
        $core["home"]["text2"]["btn_txt"] = "Search auctions";     
        $core["home"]["text2"]["btn_bg"] = "primary";     
        $core["home"]["text2"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text2"]["btn_icon"] = "";     
        $core["home"]["text2"]["btn_icon_pos"] = "after";     
        $core["home"]["text2"]["btn_size"] = "btn-lg";     
        $core["home"]["text2"]["btn_margin"] = "mt-0";     
        $core["home"]["text2"]["btn_style"] = "1";     
        $core["home"]["text2"]["btn_font"] = "";     
        $core["home"]["text2"]["btn_txtw"] = "text-700";     
        $core["home"]["text2"]["btn2_show"] = "no";     
        $core["home"]["text2"]["text_image1"] = "http://localhost/V10IMAGES/_demoimagesv10/at/cars/image2.jpg";     
        $core["home"]["text2"]["text_image1_title"] = "Welcome";     
        $core["home"]["text2"]["text_image1_link"] = "[link-search]"; 		
 
        /* text1 */    
        $core["home"]["text1"]["section_padding"] = "section-80";     
        $core["home"]["text1"]["section_bg"] = "bg-light";     
        $core["home"]["text1"]["section_pos"] = "";     
        $core["home"]["text1"]["section_w"] = "container";     
        $core["home"]["text1"]["section_pattern"] = "";     
        $core["home"]["text1"]["title_show"] = "yes";     
        $core["home"]["text1"]["title"] = "Hello & Welcome!";     
        $core["home"]["text1"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";     
        $core["home"]["text1"]["desc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";     
        $core["home"]["text1"]["title_style"] = "4";     
        $core["home"]["text1"]["title_pos"] = "left";     
        $core["home"]["text1"]["title_heading"] = "h2";     
        $core["home"]["text1"]["title_margin"] = "mb-4";     
        $core["home"]["text1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["text1"]["desc_margin"] = "mb-4";     
        $core["home"]["text1"]["title_txtcolor"] = "dark";     
        $core["home"]["text1"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["text1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1"]["title_font"] = "";     
        $core["home"]["text1"]["subtitle_font"] = "";     
        $core["home"]["text1"]["desc_font"] = "";     
        $core["home"]["text1"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["text1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["text1"]["btn_show"] = "yes";     
        $core["home"]["text1"]["btn_link"] = "[link-search]";     
        $core["home"]["text1"]["btn_txt"] = "Search auctions";     
        $core["home"]["text1"]["btn_bg"] = "primary";     
        $core["home"]["text1"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text1"]["btn_icon"] = "";     
        $core["home"]["text1"]["btn_icon_pos"] = "after";     
        $core["home"]["text1"]["btn_size"] = "btn-lg";     
        $core["home"]["text1"]["btn_margin"] = "mt-0";     
        $core["home"]["text1"]["btn_style"] = "1";     
        $core["home"]["text1"]["btn_font"] = "";     
        $core["home"]["text1"]["btn_txtw"] = "text-600";     
        $core["home"]["text1"]["btn2_show"] = "yes";     
        $core["home"]["text1"]["btn2_link"] = "http://localhost/V9/contact/";     
        $core["home"]["text1"]["btn2_txt"] = "Contact Us";     
        $core["home"]["text1"]["btn2_bg"] = "primary";     
        $core["home"]["text1"]["btn2_bg_txt"] = "text-light";     
        $core["home"]["text1"]["btn2_icon"] = "";     
        $core["home"]["text1"]["btn2_icon_pos"] = "before";     
        $core["home"]["text1"]["btn2_size"] = "btn-lg";     
        $core["home"]["text1"]["btn2_margin"] = "mt-0";     
        $core["home"]["text1"]["btn2_style"] = "1";     
        $core["home"]["text1"]["btn2_txtw"] = "text-600";     
        $core["home"]["text1"]["btn2_font"] = "";     
        $core["home"]["text1"]["text_image1"] = "http://localhost/V10IMAGES/_demoimagesv10/at/cars/image1.jpg";     
        $core["home"]["text1"]["text_image1_title"] = "Welcome";     
        $core["home"]["text1"]["text_image1_link"] = "[link-search]"; 		
 
        /* listings2a */    
        $core["home"]["listings2a"]["section_padding"] = "section-80";     
        $core["home"]["listings2a"]["section_bg"] = "bg-white";     
        $core["home"]["listings2a"]["section_pos"] = "";     
        $core["home"]["listings2a"]["section_w"] = "container";     
        $core["home"]["listings2a"]["section_pattern"] = "";     
        $core["home"]["listings2a"]["title_show"] = "yes";     
        $core["home"]["listings2a"]["title"] = "Auctions Ending Soon";     
        $core["home"]["listings2a"]["subtitle"] = " ";     
        $core["home"]["listings2a"]["desc"] = " ";     
        $core["home"]["listings2a"]["title_style"] = "1";     
        $core["home"]["listings2a"]["title_pos"] = "center";     
        $core["home"]["listings2a"]["title_heading"] = "h2";     
        $core["home"]["listings2a"]["title_margin"] = "mb-4";     
        $core["home"]["listings2a"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings2a"]["desc_margin"] = "mb-4";     
        $core["home"]["listings2a"]["title_txtcolor"] = "dark";     
        $core["home"]["listings2a"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["listings2a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings2a"]["title_font"] = "";     
        $core["home"]["listings2a"]["subtitle_font"] = "";     
        $core["home"]["listings2a"]["desc_font"] = "";     
        $core["home"]["listings2a"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["listings2a"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["listings2a"]["datastring"] = " dataonly='1' cat='' card='info' perrow='4' show='8' custom='endingsoon' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2a"]["perrow"] = "4";     
        $core["home"]["listings2a"]["card"] = "info";     
        $core["home"]["listings2a"]["limit"] = "8";     
        $core["home"]["listings2a"]["custom"] = "endingsoon";     
        $core["home"]["listings2a"]["category_ids"] = ""; 		
 
        /* subscribe2 */    
        $core["home"]["subscribe2"]["section_padding"] = "section-100";     
        $core["home"]["subscribe2"]["section_bg"] = "bg-light";     
        $core["home"]["subscribe2"]["section_pos"] = "";     
        $core["home"]["subscribe2"]["section_w"] = "container";     
        $core["home"]["subscribe2"]["section_pattern"] = "";     
        $core["home"]["subscribe2"]["title_show"] = "yes";     
        $core["home"]["subscribe2"]["title"] = "STAY <i class='fal fa-star mx-2 text-primary'></i> UPDATED";     
        $core["home"]["subscribe2"]["subtitle"] = "Join our newsletter today!";     
        $core["home"]["subscribe2"]["desc"] = " ";     
        $core["home"]["subscribe2"]["title_style"] = "1";     
        $core["home"]["subscribe2"]["title_pos"] = "left";     
        $core["home"]["subscribe2"]["title_heading"] = "h2";     
        $core["home"]["subscribe2"]["title_margin"] = "mb-2";     
        $core["home"]["subscribe2"]["subtitle_margin"] = "mb-4";     
        $core["home"]["subscribe2"]["desc_margin"] = "mb-4";     
        $core["home"]["subscribe2"]["title_txtcolor"] = "dark";     
        $core["home"]["subscribe2"]["subtitle_txtcolor"] = "light";     
        $core["home"]["subscribe2"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["subscribe2"]["title_font"] = "";     
        $core["home"]["subscribe2"]["subtitle_font"] = "";     
        $core["home"]["subscribe2"]["desc_font"] = "";     
        $core["home"]["subscribe2"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["subscribe2"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["subscribe2"]["image_subscribe"] = "http://localhost/V10IMAGES/_demoimagesv10/at/cars/hero2.jpg"; 		





 
        /* footer1 */    
        $core["footer"]["footer1"]["section_padding"] = "section-60";     
        $core["footer"]["footer1"]["section_bg"] = "bg-primary";     
        $core["footer"]["footer1"]["section_pos"] = "";     
        $core["footer"]["footer1"]["section_w"] = "container-fluid";     
        $core["footer"]["footer1"]["section_pattern"] = ""; 		
 		 
 
		// DEFAULT INNER PAGE DAATA
		$core = $CORE->LAYOUT("default_innerpages", $core);
		
		$i=1;		
		while($i < 21){	
		
			$core['sampledata'][$i] = array(		 
					
					"title" => "Example Auction ".$i,	
					
					"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_1.jpg", 
					"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_1.jpg",			 
					
					"images" => array(
					
						1 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_1.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_1.jpg",
						),
						2 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_2.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_2.jpg",
						),
						3 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_3.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_3.jpg",
						),	
						
						4 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_4.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_4.jpg",
						),
						
						5 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_5.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_5.jpg",
						),
						
						6 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_6.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_6.jpg",
						),
						
						7 => array(
							"image" => DEMO_IMG_PATH."at/products/cars/car".$i."_7.jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/cars/car".$i."_7.jpg",
						),					
												
						
					),
					
									 
				);
		$i++;	
		} 		
			
	return $core;
	}
	
	
}

?>