<?php
 
add_filter( 'ppt_admin_layouts',  array('at_s1',  'data') );
add_filter( 'at_s1',  array('at_s1',  'load') );
 
class at_s1 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_s1'] = array(
		
			"key" => "at_s1",
		
			"name" 	=> "Niche 1",
			"image"	=> _ppt_demopath()."/designs/simple1.jpg",
						
			"theme"	=> "at_s1",
			
			
			"color_p" 	=> "#0F9964",
			"color_s" 	=> "#FFD04C",
			
			"order" => 1.1
 	 		
		);		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
  
 $core['design']['single_layout'] = "4";
 $core['design']['search_layout'] = "5";
	/* logo */
	$core['design']['logo_url_aid'] = "";
	$core['design']['logo_url'] = "";
	$core['design']['light_logo_url_aid'] = "";
	$core['design']['light_logo_url'] = "";
	$core['design']['textlogo'] = "<span class='font-weight-bold text-primary'>Ticket</span>Auctions";  
 
 
 $core['design']['color_primary'] = "#0F9964";
$core['design']['color_secondary'] = "#FFD04C";
 
$core['design']['header_style'] = "header3";
$core['design']['slot1_style'] = "hero_text3b";
$core['design']['slot2_style'] = "testimonials3a";
$core['design']['slot3_style'] = "listings1";
$core['design']['slot4_style'] = "text1";
$core['design']['slot5_style'] = "text1a";
$core['design']['slot6_style'] = "listings2a";
$core['design']['slot7_style'] = "category1";
$core['design']['footer_style'] = "footer1";
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
 
        /* header3 */    
        $core["header"]["header3"]["section_padding"] = "";     
        $core["header"]["header3"]["section_bg"] = "bg-white";     
        $core["header"]["header3"]["section_pos"] = "";     
        $core["header"]["header3"]["section_w"] = "container";     
        $core["header"]["header3"]["section_pattern"] = "";     
        $core["header"]["header3"]["btn_show"] = "yes";     
        $core["header"]["header3"]["btn_link"] = "";     
        $core["header"]["header3"]["btn_txt"] = "Add Auction";     
        $core["header"]["header3"]["btn_bg"] = "primary";     
        $core["header"]["header3"]["btn_bg_txt"] = "text-light";     
        $core["header"]["header3"]["btn_icon"] = "";     
        $core["header"]["header3"]["btn_icon_pos"] = "before";     
        $core["header"]["header3"]["btn_size"] = "btn-md";     
        $core["header"]["header3"]["btn_margin"] = "mt-0";     
        $core["header"]["header3"]["btn_style"] = "1";     
        $core["header"]["header3"]["btn_font"] = "";     
        $core["header"]["header3"]["btn_txtw"] = "font-weight-bold";     
        $core["header"]["header3"]["topmenu_show"] = "yes";     
        $core["header"]["header3"]["extra_show"] = "yes";     
        $core["header"]["header3"]["extra_type"] = ""; 		
 
        /* hero_text3b */    
        $core["home"]["hero_text3b"]["section_padding"] = "";     
        $core["home"]["hero_text3b"]["section_bg"] = "bg-white";     
        $core["home"]["hero_text3b"]["section_pos"] = "";     
        $core["home"]["hero_text3b"]["section_w"] = "container";     
        $core["home"]["hero_text3b"]["section_pattern"] = "";     
        $core["home"]["hero_text3b"]["title_show"] = "yes";     
        $core["home"]["hero_text3b"]["title"] = "Sporting Tickets Online Auctions";     
        $core["home"]["hero_text3b"]["subtitle"] = "Get the best deals on Sports Tickets today!";     
        $core["home"]["hero_text3b"]["desc"] = "Welcome to our auction website, here you'll find sports tickets auctions for all the top events.";     
        $core["home"]["hero_text3b"]["title_style"] = "1";     
        $core["home"]["hero_text3b"]["title_pos"] = "left";     
        $core["home"]["hero_text3b"]["title_heading"] = "h1";     
        $core["home"]["hero_text3b"]["title_margin"] = "mb-2";     
        $core["home"]["hero_text3b"]["subtitle_margin"] = "mb-4";     
        $core["home"]["hero_text3b"]["desc_margin"] = "";     
        $core["home"]["hero_text3b"]["title_txtcolor"] = "white";     
        $core["home"]["hero_text3b"]["subtitle_txtcolor"] = "secondary";     
        $core["home"]["hero_text3b"]["desc_txtcolor"] = "opacity-8 text-light";     
        $core["home"]["hero_text3b"]["title_font"] = "";     
        $core["home"]["hero_text3b"]["subtitle_font"] = "";     
        $core["home"]["hero_text3b"]["desc_font"] = "";     
        $core["home"]["hero_text3b"]["title_txtw"] = "text-700";     
        $core["home"]["hero_text3b"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3b"]["btn_show"] = "yes";     
        $core["home"]["hero_text3b"]["btn_link"] = "[link-search]";     
        $core["home"]["hero_text3b"]["btn_txt"] = "Search Website";     
        $core["home"]["hero_text3b"]["btn_bg"] = "secondary";     
        $core["home"]["hero_text3b"]["btn_bg_txt"] = "text-light";     
        $core["home"]["hero_text3b"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["hero_text3b"]["btn_icon_pos"] = "before";     
        $core["home"]["hero_text3b"]["btn_size"] = "btn-lg";     
        $core["home"]["hero_text3b"]["btn_margin"] = "mt-4";     
        $core["home"]["hero_text3b"]["btn_style"] = "1";     
        $core["home"]["hero_text3b"]["btn_font"] = "";     
        $core["home"]["hero_text3b"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3b"]["btn2_show"] = "no";     
        $core["home"]["hero_text3b"]["hero_image"] = _ppt_demopath()."/simple1/image0.jpg";  
        $core["home"]["hero_text3b"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text3b"]["hero_overlay"] = "none";     
        $core["home"]["hero_text3b"]["hero_txtcolor"] = "light"; 		
 
        /* testimonials3a */    
        $core["home"]["testimonials3a"]["section_padding"] = "section-top-40";     
        $core["home"]["testimonials3a"]["section_bg"] = "bg-white";     
        $core["home"]["testimonials3a"]["section_pos"] = "";     
        $core["home"]["testimonials3a"]["section_w"] = "container";     
        $core["home"]["testimonials3a"]["section_pattern"] = "";     
        $core["home"]["testimonials3a"]["title_show"] = "no"; 		
 
        /* listings1 */    
        $core["home"]["listings1"]["section_padding"] = "section-60";     
        $core["home"]["listings1"]["section_bg"] = "bg-white";     
        $core["home"]["listings1"]["section_pos"] = "";     
        $core["home"]["listings1"]["section_w"] = "container";     
        $core["home"]["listings1"]["section_pattern"] = "";     
        $core["home"]["listings1"]["title_show"] = "yes";     
        $core["home"]["listings1"]["title"] = "Newly Added Tickets";     
        $core["home"]["listings1"]["subtitle"] = " ";     
        $core["home"]["listings1"]["desc"] = " ";     
        $core["home"]["listings1"]["title_style"] = "1";     
        $core["home"]["listings1"]["title_pos"] = "left";     
        $core["home"]["listings1"]["title_heading"] = "h2";     
        $core["home"]["listings1"]["title_margin"] = "mb-3";     
        $core["home"]["listings1"]["subtitle_margin"] = "mb-0";     
        $core["home"]["listings1"]["desc_margin"] = "mb-0";     
        $core["home"]["listings1"]["title_txtcolor"] = "dark";     
        $core["home"]["listings1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings1"]["title_font"] = "";     
        $core["home"]["listings1"]["subtitle_font"] = "";     
        $core["home"]["listings1"]["desc_font"] = "";     
        $core["home"]["listings1"]["title_txtw"] = "text-800";     
        $core["home"]["listings1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["listings1"]["datastring"] = "";     
        $core["home"]["listings1"]["perrow"] = "";     
        $core["home"]["listings1"]["card"] = "info";     
        $core["home"]["listings1"]["limit"] = "";     
        $core["home"]["listings1"]["custom"] = "new"; 		
 
        /* text1 */    
        $core["home"]["text1"]["section_padding"] = "section-60";     
        $core["home"]["text1"]["section_bg"] = "bg-light";     
        $core["home"]["text1"]["section_pos"] = "";     
        $core["home"]["text1"]["section_w"] = "container";     
        $core["home"]["text1"]["section_pattern"] = "";     
        $core["home"]["text1"]["title_show"] = "yes";     
        $core["home"]["text1"]["title"] = "Dont Miss Out! ";     
        $core["home"]["text1"]["subtitle"] = "Lorem ipsum dolor sit amet.";     
        $core["home"]["text1"]["desc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.?";     
        $core["home"]["text1"]["title_style"] = "1";     
        $core["home"]["text1"]["title_pos"] = "left";     
        $core["home"]["text1"]["title_heading"] = "h2";     
        $core["home"]["text1"]["title_margin"] = "mb-4";     
        $core["home"]["text1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["text1"]["desc_margin"] = "";     
        $core["home"]["text1"]["title_txtcolor"] = "dark";     
        $core["home"]["text1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["text1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1"]["title_font"] = "";     
        $core["home"]["text1"]["subtitle_font"] = "";     
        $core["home"]["text1"]["desc_font"] = "";     
        $core["home"]["text1"]["title_txtw"] = "text-800";     
        $core["home"]["text1"]["subtitle_txtw"] = "text-800";     
        $core["home"]["text1"]["btn_show"] = "yes";     
        $core["home"]["text1"]["btn_link"] = "[link-search]";     
        $core["home"]["text1"]["btn_txt"] = "Search Website";     
        $core["home"]["text1"]["btn_bg"] = "primary";     
        $core["home"]["text1"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text1"]["btn_icon"] = "fas fa-search";     
        $core["home"]["text1"]["btn_icon_pos"] = "before";     
        $core["home"]["text1"]["btn_size"] = "btn-xl";     
        $core["home"]["text1"]["btn_margin"] = "mt-2";     
        $core["home"]["text1"]["btn_style"] = "3";     
        $core["home"]["text1"]["btn_font"] = "";     
        $core["home"]["text1"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text1"]["btn2_show"] = "no";     
        $core["home"]["text1"]["text_image1"] = _ppt_demopath()."/simple1/image1.jpg";      
        $core["home"]["text1"]["text_image1_title"] = "";     
        $core["home"]["text1"]["text_image1_link"] = ""; 		
 
        /* text1a */    
        $core["home"]["text1a"]["section_padding"] = "section-60";     
        $core["home"]["text1a"]["section_bg"] = "bg-light";     
        $core["home"]["text1a"]["section_pos"] = "";     
        $core["home"]["text1a"]["section_w"] = "container";     
        $core["home"]["text1a"]["section_pattern"] = "";     
        $core["home"]["text1a"]["title_show"] = "yes";     
        $core["home"]["text1a"]["title"] = "Going Going Gone!";     
        $core["home"]["text1a"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.?";     
        $core["home"]["text1a"]["desc"] = "Lorem ipsum dolor sit amet.?";     
        $core["home"]["text1a"]["title_style"] = "1";     
        $core["home"]["text1a"]["title_pos"] = "left";     
        $core["home"]["text1a"]["title_heading"] = "h1";     
        $core["home"]["text1a"]["title_margin"] = "mb-4";     
        $core["home"]["text1a"]["subtitle_margin"] = "mb-2";     
        $core["home"]["text1a"]["desc_margin"] = "";     
        $core["home"]["text1a"]["title_txtcolor"] = "dark";     
        $core["home"]["text1a"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["text1a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1a"]["title_font"] = "";     
        $core["home"]["text1a"]["subtitle_font"] = "";     
        $core["home"]["text1a"]["desc_font"] = "";     
        $core["home"]["text1a"]["title_txtw"] = "text-800";     
        $core["home"]["text1a"]["subtitle_txtw"] = "text-700";     
        $core["home"]["text1a"]["btn_show"] = "yes";     
        $core["home"]["text1a"]["btn_link"] = "[link-search]";     
        $core["home"]["text1a"]["btn_txt"] = "Get Started";     
        $core["home"]["text1a"]["btn_bg"] = "primary";     
        $core["home"]["text1a"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text1a"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["text1a"]["btn_icon_pos"] = "";     
        $core["home"]["text1a"]["btn_size"] = "btn-xl";     
        $core["home"]["text1a"]["btn_margin"] = "mt-2";     
        $core["home"]["text1a"]["btn_style"] = "3";     
        $core["home"]["text1a"]["btn_font"] = "";     
        $core["home"]["text1a"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text1a"]["btn2_show"] = "no";     
        $core["home"]["text1a"]["text_image1"] = _ppt_demopath()."/simple1/image2.jpg";     
        $core["home"]["text1a"]["text_image1_title"] = "";     
        $core["home"]["text1a"]["text_image1_link"] = ""; 		
 
        /* listings2a */    
        $core["home"]["listings2a"]["section_padding"] = "section-60";     
        $core["home"]["listings2a"]["section_bg"] = "bg-white";     
        $core["home"]["listings2a"]["section_pos"] = "";     
        $core["home"]["listings2a"]["section_w"] = "container";     
        $core["home"]["listings2a"]["section_pattern"] = "";     
        $core["home"]["listings2a"]["title_show"] = "yes";     
        $core["home"]["listings2a"]["title"] = "Popular Auctions";     
        $core["home"]["listings2a"]["subtitle"] = " ";     
        $core["home"]["listings2a"]["desc"] = " ";     
        $core["home"]["listings2a"]["title_style"] = "1";     
        $core["home"]["listings2a"]["title_pos"] = "left";     
        $core["home"]["listings2a"]["title_heading"] = "h2";     
        $core["home"]["listings2a"]["title_margin"] = "mb-4";     
        $core["home"]["listings2a"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings2a"]["desc_margin"] = "";     
        $core["home"]["listings2a"]["title_txtcolor"] = "dark";     
        $core["home"]["listings2a"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings2a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings2a"]["title_font"] = "";     
        $core["home"]["listings2a"]["subtitle_font"] = "";     
        $core["home"]["listings2a"]["desc_font"] = "";     
        $core["home"]["listings2a"]["title_txtw"] = "text-800";     
        $core["home"]["listings2a"]["subtitle_txtw"] = "text-800";     
        $core["home"]["listings2a"]["datastring"] = "";     
        $core["home"]["listings2a"]["perrow"] = "";     
        $core["home"]["listings2a"]["card"] = "info";     
        $core["home"]["listings2a"]["limit"] = "";     
        $core["home"]["listings2a"]["custom"] = "new"; 		
 
        /* category1 */    
        $core["home"]["category1"]["section_padding"] = "section-top-60";     
        $core["home"]["category1"]["section_bg"] = "bg-light";     
        $core["home"]["category1"]["section_pos"] = "";     
        $core["home"]["category1"]["section_w"] = "container";     
        $core["home"]["category1"]["section_pattern"] = "";     
        $core["home"]["category1"]["title_show"] = "yes";     
        $core["home"]["category1"]["title"] = "Auction Categories";     
        $core["home"]["category1"]["subtitle"] = " ";     
        $core["home"]["category1"]["desc"] = " ";     
        $core["home"]["category1"]["title_style"] = "1";     
        $core["home"]["category1"]["title_pos"] = "left";     
        $core["home"]["category1"]["title_heading"] = "h2";     
        $core["home"]["category1"]["title_margin"] = "mb-4";     
        $core["home"]["category1"]["subtitle_margin"] = "mb-0";     
        $core["home"]["category1"]["desc_margin"] = "mb-4";     
        $core["home"]["category1"]["title_txtcolor"] = "dark";     
        $core["home"]["category1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["category1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["category1"]["title_font"] = "";     
        $core["home"]["category1"]["subtitle_font"] = "";     
        $core["home"]["category1"]["desc_font"] = "";     
        $core["home"]["category1"]["title_txtw"] = "text-800";     
        $core["home"]["category1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["category1"]["cat_show"] = "16";     
        $core["home"]["category1"]["cat_show_list"] = "5";     
        $core["home"]["category1"]["cat_offset"] = "0"; 		
 
        /* footer1 */    
        $core["footer"]["footer1"]["section_padding"] = "";     
        $core["footer"]["footer1"]["section_bg"] = "bg-primary";     
        $core["footer"]["footer1"]["section_pos"] = "";     
        $core["footer"]["footer1"]["section_w"] = "container";     
        $core["footer"]["footer1"]["section_pattern"] = "";     
        $core["footer"]["footer1"]["footer_copyright"] = "&copy; 2022";     
        $core["footer"]["footer1"]["footer_description"] = "";     
        $core["footer"]["footer1"]["footer_copyright_style"] = "";     
        $core["footer"]["footer1"]["footer_menu1"] = "";     
        $core["footer"]["footer1"]["footer_menu2"] = "";     
        $core["footer"]["footer1"]["footer_menu1_title"] = "";     
        $core["footer"]["footer1"]["footer_menu2_title"] = ""; 		
 
 
 
		// DEFAULT INNER PAGE DAATA
		$core = $CORE->LAYOUT("default_innerpages", $core);
		
		// SAMPLE DATA
		
		$i=1;		
		while($i < 21){	
		
			$core['sampledata'][$i] = array(		 
					
					"title" => "Example Auction ".$i,	
					
					"image" => _ppt_demopath()."/products/tickets/".$i.".jpg", 
					"thumb" => _ppt_demopath()."/products/tickets/".$i.".jpg",			 
					 
						"images" => array(
					
						1 => array(
							"image" => _ppt_demopath()."/products/tickets/".$i.".jpg", 
							"thumb" => _ppt_demopath()."/products/tickets/".$i.".jpg",
						),
					 
											
						
					),
									 
				);
		$i++;	
		} 		
			
	return $core;
	}
	
	
}

?>