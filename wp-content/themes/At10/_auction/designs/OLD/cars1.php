<?php
 
add_filter( 'ppt_admin_layouts',  array('at_cars1',  'data') );
add_filter( 'at_cars1',  array('at_cars1',  'load') );
 
class at_cars1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_cars1'] = array(
		
			"key" => "at_cars1",
		
			"name" 	=> "Car Auctions",
			"image"	=> _ppt_demopath()."/designs/cars1.jpg",
						
			"theme"	=> "at_cars",
			
			
			"color_p" 	=> "#1075d3",
			"color_s" 	=> "#222222",
			
			"order" => 1
 	 		
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

$core['design']['slot1_style'] = "hero_search2";
$core['design']['slot2_style'] = "listings2";
$core['design']['slot3_style'] = "icon8";
$core['design']['slot4_style'] = "text1";
$core['design']['slot5_style'] = "listings2a";
$core['design']['slot6_style'] = "text2";
$core['design']['slot7_style'] = 'subscribe2';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 		
        /* icon8 */    
        $core["home"]["icon8"]["section_padding"] = "section-bottom-80";     
        $core["home"]["icon8"]["section_bg"] = "bg-white"; 
		 $core["home"]["icon8"]["title_show"] = "yes";      
        $core["home"]["icon8"]["title"] = "Popular Brands";     
        $core["home"]["icon8"]["title_show"] = "yes";     
     
        $core["home"]["icon8"]["subtitle"] = " ";     
        $core["home"]["icon8"]["desc"] = " ";     
        $core["home"]["icon8"]["title_style"] = "1";     
        $core["home"]["icon8"]["title_pos"] = "center";     
        $core["home"]["icon8"]["title_heading"] = "h2";     
        $core["home"]["icon8"]["title_margin"] = "mb-4";     
        $core["home"]["icon8"]["subtitle_margin"] = "mb-4";     
        $core["home"]["icon8"]["desc_margin"] = "mb-4";     
        $core["home"]["icon8"]["title_txtcolor"] = "dark";     
        $core["home"]["icon8"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["icon8"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["icon8"]["title_font"] = "";     
        $core["home"]["icon8"]["subtitle_font"] = "";     
        $core["home"]["icon8"]["desc_font"] = "";     
        $core["home"]["icon8"]["title_txtw"] = "font-weight-bold";  
		
		
		
		
        $core["home"]["icon8"]["btn_show"] = "yes";     
        $core["home"]["icon8"]["btn_link"] = "[link-add]";     
        $core["home"]["icon8"]["btn_txt"] = "Sell My Car";     
        $core["home"]["icon8"]["btn_bg"] = "primary";     
        $core["home"]["icon8"]["btn_bg_txt"] = "";     
        $core["home"]["icon8"]["btn_icon"] = "";     
        $core["home"]["icon8"]["btn_icon_pos"] = "after";     
        $core["home"]["icon8"]["btn_size"] = "btn-lg";     
        $core["home"]["icon8"]["btn_margin"] = "mt-0";     
        $core["home"]["icon8"]["btn_style"] = "1";     
        $core["home"]["icon8"]["btn2_show"] = "yes";     
        $core["home"]["icon8"]["btn2_link"] = "[link-search]";     
        $core["home"]["icon8"]["btn2_txt"] = "Search All Cars";     
        $core["home"]["icon8"]["btn2_bg"] = "primary";     
        $core["home"]["icon8"]["btn2_bg_txt"] = "text-light";     
        $core["home"]["icon8"]["btn2_icon"] = "";     
        $core["home"]["icon8"]["btn2_icon_pos"] = "after";     
        $core["home"]["icon8"]["btn2_size"] = "btn-lg";     
        $core["home"]["icon8"]["btn2_margin"] = "mt-0";     
        $core["home"]["icon8"]["btn2_style"] = "1";     
        $core["home"]["icon8"]["icon1"] = "";     
        $core["home"]["icon8"]["icon1_title"] = "BMW";     
        $core["home"]["icon8"]["icon1_desc"] = "";     
        $core["home"]["icon8"]["icon1_link"] = home_url()."?s=&make=bmw";     
        $core["home"]["icon8"]["icon1_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon1_iconcolor"] = "";     
        $core["home"]["icon8"]["icon1_type"] = "image";     
        $core["home"]["icon8"]["icon1_image"] = _ppt_demopath()."/cars/bmw-logo.jpg";     
        $core["home"]["icon8"]["icon2"] = "";     
        $core["home"]["icon8"]["icon2_title"] = "Mercedes";     
        $core["home"]["icon8"]["icon2_desc"] = "";     
        $core["home"]["icon8"]["icon2_link"] = home_url()."?s=&make=mercedes";     
        $core["home"]["icon8"]["icon2_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon2_iconcolor"] = "";     
        $core["home"]["icon8"]["icon2_type"] = "image";     
        $core["home"]["icon8"]["icon2_image"] = _ppt_demopath()."/cars/mercedes-logo.jpg";     
        $core["home"]["icon8"]["icon3"] = "";     
        $core["home"]["icon8"]["icon3_title"] = "Volkswagen";     
        $core["home"]["icon8"]["icon3_desc"] = "";     
        $core["home"]["icon8"]["icon3_link"] = home_url()."?s=&make=volkswagen";     
        $core["home"]["icon8"]["icon3_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon3_iconcolor"] = "";     
        $core["home"]["icon8"]["icon3_type"] = "image";     
        $core["home"]["icon8"]["icon3_image"] = _ppt_demopath()."/cars/volkswagen-logo.jpg";     
        $core["home"]["icon8"]["icon4"] = "";     
        $core["home"]["icon8"]["icon4_title"] = "Skoda";     
        $core["home"]["icon8"]["icon4_desc"] = "";     
        $core["home"]["icon8"]["icon4_link"] = home_url()."?s=&make=skoda";     
        $core["home"]["icon8"]["icon4_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon4_iconcolor"] = "";     
        $core["home"]["icon8"]["icon4_type"] = "image";     
        $core["home"]["icon8"]["icon4_image"] = _ppt_demopath()."/cars/skoda-logo.jpg";     
        $core["home"]["icon8"]["icon5"] = "";     
        $core["home"]["icon8"]["icon5_title"] = "Mini";     
        $core["home"]["icon8"]["icon5_desc"] = "";     
        $core["home"]["icon8"]["icon5_link"] = home_url()."?s=&make=mini";     
        $core["home"]["icon8"]["icon5_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon5_iconcolor"] = "";     
        $core["home"]["icon8"]["icon5_type"] = "image";     
        $core["home"]["icon8"]["icon5_image"] = _ppt_demopath()."/cars/mini-logo.jpg";     
        $core["home"]["icon8"]["icon6"] = "";     
        $core["home"]["icon8"]["icon6_title"] = "Ford";     
        $core["home"]["icon8"]["icon6_desc"] = "";     
        $core["home"]["icon8"]["icon6_link"] = home_url()."?s=&make=ford";     
        $core["home"]["icon8"]["icon6_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon6_iconcolor"] = "";     
        $core["home"]["icon8"]["icon6_type"] = "image";     
        $core["home"]["icon8"]["icon6_image"] = _ppt_demopath()."/cars/ford-logo.jpg";     
        $core["home"]["icon8"]["icon7"] = "";     
        $core["home"]["icon8"]["icon7_title"] = "GMC";     
        $core["home"]["icon8"]["icon7_desc"] = "";     
        $core["home"]["icon8"]["icon7_link"] = home_url()."?s=&make=gmc";     
        $core["home"]["icon8"]["icon7_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon7_iconcolor"] = "";     
        $core["home"]["icon8"]["icon7_type"] = "image";     
        $core["home"]["icon8"]["icon7_image"] = _ppt_demopath()."/cars/gmc-logo.jpg";     
        $core["home"]["icon8"]["icon8"] = "";     
        $core["home"]["icon8"]["icon8_title"] = "Buick";     
        $core["home"]["icon8"]["icon8_desc"] = "";     
        $core["home"]["icon8"]["icon8_link"] = home_url()."?s=&make=buick";     
        $core["home"]["icon8"]["icon8_txtcolor"] = "dark";     
        $core["home"]["icon8"]["icon8_iconcolor"] = "";     
        $core["home"]["icon8"]["icon8_type"] = "image";     
        $core["home"]["icon8"]["icon8_image"] = _ppt_demopath()."/cars/buick-logo.jpg"; 
 
 
        /* hero_search2 */    
        $core["home"]["hero_search2"]["section_padding"] = "section-80";     
        $core["home"]["hero_search2"]["section_bg"] = "bg-light";     
        $core["home"]["hero_search2"]["section_pos"] = "";     
        $core["home"]["hero_search2"]["section_w"] = "container";     
        $core["home"]["hero_search2"]["section_pattern"] = "";     
        $core["home"]["hero_search2"]["title_show"] = "yes";     
        $core["home"]["hero_search2"]["title"] = "Get Started Here";     
        $core["home"]["hero_search2"]["subtitle"] = " ";     
        $core["home"]["hero_search2"]["desc"] = " ";     
        $core["home"]["hero_search2"]["title_style"] = "1";     
        $core["home"]["hero_search2"]["title_pos"] = "left";     
        $core["home"]["hero_search2"]["title_heading"] = "h1";     
        $core["home"]["hero_search2"]["title_margin"] = "mb-2";     
        $core["home"]["hero_search2"]["subtitle_margin"] = "mb-0";     
        $core["home"]["hero_search2"]["desc_margin"] = "mb-0";     
        $core["home"]["hero_search2"]["title_txtcolor"] = "dark";     
        $core["home"]["hero_search2"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["hero_search2"]["desc_txtcolor"] = "dark";     
        $core["home"]["hero_search2"]["title_font"] = "";     
        $core["home"]["hero_search2"]["subtitle_font"] = "";     
        $core["home"]["hero_search2"]["desc_font"] = "";     
        $core["home"]["hero_search2"]["title_txtw"] = "text-700";     
        $core["home"]["hero_search2"]["subtitle_txtw"] = "";     
        $core["home"]["hero_search2"]["btn_show"] = "yes";     
        $core["home"]["hero_search2"]["btn_link"] = home_url()."/?s=";     
        $core["home"]["hero_search2"]["btn_txt"] = "Search Website";     
        $core["home"]["hero_search2"]["btn_bg"] = "orange";     
        $core["home"]["hero_search2"]["btn_bg_txt"] = "text-light";     
        $core["home"]["hero_search2"]["btn_icon"] = "fas fa-long-arrow-alt-right";     
        $core["home"]["hero_search2"]["btn_icon_pos"] = "before";     
        $core["home"]["hero_search2"]["btn_size"] = "btn-lg";     
        $core["home"]["hero_search2"]["btn_margin"] = "mt-4";     
        $core["home"]["hero_search2"]["btn_style"] = "1";     
        $core["home"]["hero_search2"]["btn_font"] = "";     
        $core["home"]["hero_search2"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_search2"]["btn2_show"] = "no";     
        $core["home"]["hero_search2"]["hero_image"] = _ppt_demopath()."/cars/hero1.jpg";     
        $core["home"]["hero_search2"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_search2"]["hero_overlay"] = "primary";     
        $core["home"]["hero_search2"]["hero_txtcolor"] = "light"; 		
 
        /* listings2 */    
        $core["home"]["listings2"]["section_padding"] = "section-80";     
        $core["home"]["listings2"]["section_bg"] = "bg-white";     
        $core["home"]["listings2"]["section_pos"] = "";     
        $core["home"]["listings2"]["section_w"] = "container";     
        $core["home"]["listings2"]["section_pattern"] = "";     
        $core["home"]["listings2"]["title_show"] = "yes";     
        $core["home"]["listings2"]["title"] = "Featured Auctions";     
        $core["home"]["listings2"]["subtitle"] = " ";     
        $core["home"]["listings2"]["desc"] = " ";     
        $core["home"]["listings2"]["title_style"] = "1";     
        $core["home"]["listings2"]["title_pos"] = "center";     
        $core["home"]["listings2"]["title_heading"] = "h2";     
        $core["home"]["listings2"]["title_margin"] = "mb-4";     
        $core["home"]["listings2"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings2"]["desc_margin"] = "mb-4";     
        $core["home"]["listings2"]["title_txtcolor"] = "dark";     
        $core["home"]["listings2"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["listings2"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings2"]["title_font"] = "";     
        $core["home"]["listings2"]["subtitle_font"] = "";     
        $core["home"]["listings2"]["desc_font"] = "";     
        $core["home"]["listings2"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["listings2"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["listings2"]["datastring"] = " dataonly='1' cat='' card='info' perrow='4' show='8' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2"]["perrow"] = "4";     
        $core["home"]["listings2"]["card"] = "info";     
        $core["home"]["listings2"]["limit"] = "8";     
        $core["home"]["listings2"]["custom"] = "new";     
        $core["home"]["listings2"]["category_ids"] = ""; 		
 
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
        $core["home"]["text1"]["btn_link"] = home_url()."/?s=";;     
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
        $core["home"]["text1"]["btn2_link"] = "[link-contact]";     
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
        $core["home"]["text1"]["text_image1"] = _ppt_demopath()."/cars/image1.jpg";     
        $core["home"]["text1"]["text_image1_title"] = "Welcome";     
        $core["home"]["text1"]["text_image1_link"] = home_url()."/?s=";; 		
 
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
        $core["home"]["text2"]["btn_link"] = home_url()."/?s=";;     
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
        $core["home"]["text2"]["text_image1"] = _ppt_demopath()."/cars/image2.jpg";     
        $core["home"]["text2"]["text_image1_title"] = "Welcome";     
        $core["home"]["text2"]["text_image1_link"] = home_url()."/?s=";; 		
 
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
        $core["home"]["subscribe2"]["image_subscribe"] = _ppt_demopath()."/cars/hero2.jpg"; 		



 
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