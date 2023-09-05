<?php
 
add_filter( 'ppt_admin_layouts',  array('at_s5',  'data') );
add_filter( 'at_s5',  array('at_s5',  'load') );
 
class at_s5 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_s5'] = array(
		
			"key" => "at_s5",
		
			"name" 	=> "Niche 5",
			"image"	=> _ppt_demopath()."/designs/simple5.jpg",
						
			"theme"	=> "at_s1",
			
			
			"color_p" 	=> "#ec762e",
			"color_s" 	=> "#FFD04C",
			
			"order" => 1.5
 	 		
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
	$core['design']['textlogo'] = "<span class='font-weight-bold text-primary'>Travel</span>Auctions";  
 
 
 $core['design']['header_style'] = "header7";
$core['design']['slot1_style'] = "hero_text1";
$core['design']['slot2_style'] = "listings2";
$core['design']['slot3_style'] = "text1a";
$core['design']['slot4_style'] = "listings2a";
$core['design']['footer_style'] = "footer1";
$core['design']['slot5_style'] = '';
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
 
        /* header7 */    
        $core["header"]["header7"]["section_padding"] = "";     
        $core["header"]["header7"]["section_bg"] = "bg-white";     
        $core["header"]["header7"]["section_pos"] = "";     
        $core["header"]["header7"]["section_w"] = "container";     
        $core["header"]["header7"]["section_pattern"] = "";     
        $core["header"]["header7"]["btn_show"] = "yes";     
        $core["header"]["header7"]["btn_link"] = "";     
        $core["header"]["header7"]["btn_txt"] = "Add Auction";     
        $core["header"]["header7"]["btn_bg"] = "dark";     
        $core["header"]["header7"]["btn_bg_txt"] = "text-light";     
        $core["header"]["header7"]["btn_icon"] = "";     
        $core["header"]["header7"]["btn_icon_pos"] = "before";     
        $core["header"]["header7"]["btn_size"] = "btn-md";     
        $core["header"]["header7"]["btn_margin"] = "mt-0";     
        $core["header"]["header7"]["btn_style"] = "5";     
        $core["header"]["header7"]["btn_font"] = "";     
        $core["header"]["header7"]["btn_txtw"] = "font-weight-bold";     
        $core["header"]["header7"]["topmenu_show"] = "yes";     
        $core["header"]["header7"]["extra_show"] = "no";     
        $core["header"]["header7"]["extra_type"] = "button"; 		
 
        /* hero_text1 */    
        $core["home"]["hero_text1"]["section_padding"] = "";     
        $core["home"]["hero_text1"]["section_bg"] = "bg-white";     
        $core["home"]["hero_text1"]["section_pos"] = "";     
        $core["home"]["hero_text1"]["section_w"] = "container";     
        $core["home"]["hero_text1"]["section_pattern"] = "";     
        $core["home"]["hero_text1"]["title_show"] = "yes";     
        $core["home"]["hero_text1"]["title"] = "Travel Auctions";     
        $core["home"]["hero_text1"]["subtitle"] = "Save time & money - get started now!";     
        $core["home"]["hero_text1"]["desc"] = " ";     
        $core["home"]["hero_text1"]["title_style"] = "1";     
        $core["home"]["hero_text1"]["title_pos"] = "left";     
        $core["home"]["hero_text1"]["title_heading"] = "h1";     
        $core["home"]["hero_text1"]["title_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["desc_margin"] = "mb-4";     
        $core["home"]["hero_text1"]["title_txtcolor"] = "white";     
        $core["home"]["hero_text1"]["subtitle_txtcolor"] = " opacity-8 text-light";     
        $core["home"]["hero_text1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["hero_text1"]["title_font"] = "";     
        $core["home"]["hero_text1"]["subtitle_font"] = "";     
        $core["home"]["hero_text1"]["desc_font"] = "";     
        $core["home"]["hero_text1"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["btn_show"] = "yes";     
        $core["home"]["hero_text1"]["btn_link"] = "[link-search]";     
        $core["home"]["hero_text1"]["btn_txt"] = "Search Website";     
        $core["home"]["hero_text1"]["btn_bg"] = "primary";     
        $core["home"]["hero_text1"]["btn_bg_txt"] = "text-light";     
        $core["home"]["hero_text1"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["hero_text1"]["btn_icon_pos"] = "after";     
        $core["home"]["hero_text1"]["btn_size"] = "btn-xl";     
        $core["home"]["hero_text1"]["btn_margin"] = "mt-4";     
        $core["home"]["hero_text1"]["btn_style"] = "3";     
        $core["home"]["hero_text1"]["btn_font"] = "";     
        $core["home"]["hero_text1"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text1"]["btn2_show"] = "no";     
        $core["home"]["hero_text1"]["hero_image"] = _ppt_demopath()."/simple1/image11.jpg";    
        $core["home"]["hero_text1"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text1"]["hero_overlay"] = "black";     
        $core["home"]["hero_text1"]["hero_txtcolor"] = "light"; 		
 
        /* listings2 */    
        $core["home"]["listings2"]["section_padding"] = "section-60";     
        $core["home"]["listings2"]["section_bg"] = "bg-white";     
        $core["home"]["listings2"]["section_pos"] = "";     
        $core["home"]["listings2"]["section_w"] = "container";     
        $core["home"]["listings2"]["section_pattern"] = "";     
        $core["home"]["listings2"]["title_show"] = "yes";     
        $core["home"]["listings2"]["title"] = "Newly Added";     
        $core["home"]["listings2"]["subtitle"] = " ";     
        $core["home"]["listings2"]["desc"] = " ";     
        $core["home"]["listings2"]["title_style"] = "1";     
        $core["home"]["listings2"]["title_pos"] = "left";     
        $core["home"]["listings2"]["title_heading"] = "h2";     
        $core["home"]["listings2"]["title_margin"] = "mb-0";     
        $core["home"]["listings2"]["subtitle_margin"] = "mb-0";     
        $core["home"]["listings2"]["desc_margin"] = "";     
        $core["home"]["listings2"]["title_txtcolor"] = "dark";     
        $core["home"]["listings2"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings2"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings2"]["title_font"] = "";     
        $core["home"]["listings2"]["subtitle_font"] = "";     
        $core["home"]["listings2"]["desc_font"] = "";     
        $core["home"]["listings2"]["title_txtw"] = "";     
        $core["home"]["listings2"]["subtitle_txtw"] = "";     
        $core["home"]["listings2"]["datastring"] = " dataonly='1' cat='' card='small' perrow='3' show='3' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2"]["perrow"] = "3";     
        $core["home"]["listings2"]["card"] = "small";     
        $core["home"]["listings2"]["limit"] = "3";     
        $core["home"]["listings2"]["custom"] = "new"; 		
 
        /* text1a */    
        $core["home"]["text1a"]["section_padding"] = "section-80";     
        $core["home"]["text1a"]["section_bg"] = "bg-light";     
        $core["home"]["text1a"]["section_pos"] = "";     
        $core["home"]["text1a"]["section_w"] = "container";     
        $core["home"]["text1a"]["section_pattern"] = "";     
        $core["home"]["text1a"]["title_show"] = "yes";     
        $core["home"]["text1a"]["title"] = "Don't Miss Out!";     
        $core["home"]["text1a"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";     
        $core["home"]["text1a"]["desc"] = "PremiumPress themes come with 150+ ready-made drag & drop design blocks making it easy to create stunning websites.";     
        $core["home"]["text1a"]["title_style"] = "1";     
        $core["home"]["text1a"]["title_pos"] = "left";     
        $core["home"]["text1a"]["title_heading"] = "h2";     
        $core["home"]["text1a"]["title_margin"] = "mb-4";     
        $core["home"]["text1a"]["subtitle_margin"] = "";     
        $core["home"]["text1a"]["desc_margin"] = "";     
        $core["home"]["text1a"]["title_txtcolor"] = "dark";     
        $core["home"]["text1a"]["subtitle_txtcolor"] = "opacity-5";     
        $core["home"]["text1a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1a"]["title_font"] = "";     
        $core["home"]["text1a"]["subtitle_font"] = "";     
        $core["home"]["text1a"]["desc_font"] = "";     
        $core["home"]["text1a"]["title_txtw"] = "text-700";     
        $core["home"]["text1a"]["subtitle_txtw"] = "";     
        $core["home"]["text1a"]["btn_show"] = "yes";     
        $core["home"]["text1a"]["btn_link"] = "[link-search]";     
        $core["home"]["text1a"]["btn_txt"] = "Get Started";     
        $core["home"]["text1a"]["btn_bg"] = "primary";     
        $core["home"]["text1a"]["btn_bg_txt"] = "";     
        $core["home"]["text1a"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["text1a"]["btn_icon_pos"] = "before";     
        $core["home"]["text1a"]["btn_size"] = "btn-xl";     
        $core["home"]["text1a"]["btn_margin"] = "mt-2";     
        $core["home"]["text1a"]["btn_style"] = "3";     
        $core["home"]["text1a"]["btn_font"] = "";     
        $core["home"]["text1a"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text1a"]["btn2_show"] = "no";     
        $core["home"]["text1a"]["text_image1"] = _ppt_demopath()."/simple1/image12.jpg";    
        $core["home"]["text1a"]["text_image1_title"] = "";     
        $core["home"]["text1a"]["text_image1_link"] = ""; 		
 
        /* listings2a */    
        $core["home"]["listings2a"]["section_padding"] = "section-80";     
        $core["home"]["listings2a"]["section_bg"] = "bg-light";     
        $core["home"]["listings2a"]["section_pos"] = "";     
        $core["home"]["listings2a"]["section_w"] = "container";     
        $core["home"]["listings2a"]["section_pattern"] = "";     
        $core["home"]["listings2a"]["title_show"] = "no";     
        $core["home"]["listings2a"]["datastring"] = " dataonly='1' cat='' card='small' perrow='3' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2a"]["perrow"] = "3";     
        $core["home"]["listings2a"]["card"] = "small";     
        $core["home"]["listings2a"]["limit"] = "";     
        $core["home"]["listings2a"]["custom"] = "new"; 		
 
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
		
 
		
		$i=1;		
		while($i < 21){	
		
			$core['sampledata'][$i] = array(		 
					
					"title" => "Example Auction ".$i,	
					
					"image" => DEMO_IMG_PATH."at/products/travel/".$i.".jpg", 
					"thumb" => DEMO_IMG_PATH."at/products/travel/".$i.".jpg",			 
					
					"images" => array(
					
						1 => array(
							"image" => DEMO_IMG_PATH."at/products/travel/".$i.".jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/travel/".$i.".jpg",
						),
				 				
												
						
					),
					
									 
				);
		$i++;	
		} 
	
	return $core;
	}
	
	
}
?>