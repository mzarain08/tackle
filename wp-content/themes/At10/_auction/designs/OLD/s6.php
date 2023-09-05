<?php
 
add_filter( 'ppt_admin_layouts',  array('at_s6',  'data') );
add_filter( 'at_s6',  array('at_s6',  'load') );
 
class at_s6 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_s6'] = array(
		
			"key" => "at_s6",
		
			"name" 	=> "Niche 6",
			"image"	=> _ppt_demopath()."/designs/simple6.jpg",
						
			"theme"	=> "at_cars",
			
			
			"color_p" 	=> "#ec762e",
			"color_s" 	=> "#FFD04C",
			
			"order" => 0
 	 		
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
	$core['design']['textlogo'] = "<span class='font-weight-bold text-primary'>Auction</span>Website";  
 
 
  $core['design']['color_primary'] = "#e55122";
$core['design']['color_secondary'] = "#000";
 
$core['design']['header_style'] = "header7";
$core['design']['slot1_style'] = "hero_text3e";
$core['design']['slot2_style'] = "listings1";
$core['design']['slot3_style'] = "cta1a";
$core['design']['slot4_style'] = "listings1";
$core['design']['slot5_style'] = "text18";
$core['design']['slot6_style'] = "category2";
$core['design']['footer_style'] = "footer1";
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
        $core["header"]["header7"]["btn_link"] = "[link-add]";     
        $core["header"]["header7"]["btn_txt"] = "Add Auction";     
        $core["header"]["header7"]["btn_bg"] = "primary";     
        $core["header"]["header7"]["btn_bg_txt"] = "text-light";     
        $core["header"]["header7"]["btn_icon"] = "";     
        $core["header"]["header7"]["btn_icon_pos"] = "before";     
        $core["header"]["header7"]["btn_size"] = "btn-md";     
        $core["header"]["header7"]["btn_margin"] = "mt-0";     
        $core["header"]["header7"]["btn_style"] = "4";     
        $core["header"]["header7"]["btn_font"] = "";     
        $core["header"]["header7"]["btn_txtw"] = "font-weight-bold";     
        $core["header"]["header7"]["topmenu_show"] = "yes";     
        $core["header"]["header7"]["extra_show"] = "no";     
        $core["header"]["header7"]["extra_type"] = "button"; 		
 
        /* hero_text3e */    
        $core["home"]["hero_text3e"]["section_padding"] = "";     
        $core["home"]["hero_text3e"]["section_bg"] = "bg-white";     
        $core["home"]["hero_text3e"]["section_pos"] = "";     
        $core["home"]["hero_text3e"]["section_w"] = "container";     
        $core["home"]["hero_text3e"]["section_pattern"] = "";     
        $core["home"]["hero_text3e"]["title_show"] = "yes";     
        $core["home"]["hero_text3e"]["title"] = "Your <span>Amazing, Awesome, Brlliant, Quality</span> <br> Auction Website";     
        $core["home"]["hero_text3e"]["subtitle"] = "Save time and money - get started now!";     
        $core["home"]["hero_text3e"]["desc"] = "This premium WordPress theme includes everything you need to build your own online auction website.";     
        $core["home"]["hero_text3e"]["title_style"] = "1";     
        $core["home"]["hero_text3e"]["title_pos"] = "left";     
        $core["home"]["hero_text3e"]["title_heading"] = "h1";     
        $core["home"]["hero_text3e"]["title_margin"] = "mb-2";     
        $core["home"]["hero_text3e"]["subtitle_margin"] = "mb-4";     
        $core["home"]["hero_text3e"]["desc_margin"] = "";     
        $core["home"]["hero_text3e"]["title_txtcolor"] = "black";     
        $core["home"]["hero_text3e"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["hero_text3e"]["desc_txtcolor"] = "opacity-8";     
        $core["home"]["hero_text3e"]["title_font"] = "";     
        $core["home"]["hero_text3e"]["subtitle_font"] = "";     
        $core["home"]["hero_text3e"]["desc_font"] = "";     
        $core["home"]["hero_text3e"]["title_txtw"] = "text-700";     
        $core["home"]["hero_text3e"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3e"]["btn_show"] = "yes";     
        $core["home"]["hero_text3e"]["btn_link"] = "[link-search]";     
        $core["home"]["hero_text3e"]["btn_txt"] = "Search Website";     
        $core["home"]["hero_text3e"]["btn_bg"] = "primary";     
        $core["home"]["hero_text3e"]["btn_bg_txt"] = "text-light";     
        $core["home"]["hero_text3e"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["hero_text3e"]["btn_icon_pos"] = "before";     
        $core["home"]["hero_text3e"]["btn_size"] = "btn-lg";     
        $core["home"]["hero_text3e"]["btn_margin"] = "mt-4";     
        $core["home"]["hero_text3e"]["btn_style"] = "1";     
        $core["home"]["hero_text3e"]["btn_font"] = "";     
        $core["home"]["hero_text3e"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3e"]["btn2_show"] = "no";     
        $core["home"]["hero_text3e"]["hero_image"] = _ppt_demopath()."/simple1/image14.jpg";     
        $core["home"]["hero_text3e"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text3e"]["hero_overlay"] = "none";     
        $core["home"]["hero_text3e"]["hero_txtcolor"] = "light"; 		
 
        /* listings1 */    
        $core["home"]["listings1"]["section_padding"] = "section-60";     
        $core["home"]["listings1"]["section_bg"] = "bg-white";     
        $core["home"]["listings1"]["section_pos"] = "";     
        $core["home"]["listings1"]["section_w"] = "container";     
        $core["home"]["listings1"]["section_pattern"] = "";     
        $core["home"]["listings1"]["title_show"] = "yes";     
        $core["home"]["listings1"]["title"] = "Featured Auctions";     
        $core["home"]["listings1"]["subtitle"] = " ";     
        $core["home"]["listings1"]["desc"] = " ";     
        $core["home"]["listings1"]["title_style"] = "1";     
        $core["home"]["listings1"]["title_pos"] = "left";     
        $core["home"]["listings1"]["title_heading"] = "h2";     
        $core["home"]["listings1"]["title_margin"] = "mb-4";     
        $core["home"]["listings1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings1"]["desc_margin"] = "";     
        $core["home"]["listings1"]["title_txtcolor"] = "dark";     
        $core["home"]["listings1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings1"]["title_font"] = "";     
        $core["home"]["listings1"]["subtitle_font"] = "";     
        $core["home"]["listings1"]["desc_font"] = "";     
        $core["home"]["listings1"]["title_txtw"] = "text-700";     
        $core["home"]["listings1"]["subtitle_txtw"] = "";     
        $core["home"]["listings1"]["datastring"] = " dataonly='1' cat='' card='blank' perrow='3' show='3' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings1"]["perrow"] = "3";     
        $core["home"]["listings1"]["card"] = "blank";     
        $core["home"]["listings1"]["limit"] = "3";     
        $core["home"]["listings1"]["custom"] = "new"; 		
 
        /* cta1a */    
        $core["home"]["cta1a"]["section_padding"] = "section-40";     
        $core["home"]["cta1a"]["section_bg"] = "bg-dark";     
        $core["home"]["cta1a"]["section_pos"] = "";     
        $core["home"]["cta1a"]["section_w"] = "container";     
        $core["home"]["cta1a"]["section_pattern"] = "";     
        $core["home"]["cta1a"]["title_show"] = "yes";     
        $core["home"]["cta1a"]["title"] = "High Conversion CTA Section";     
        $core["home"]["cta1a"]["subtitle"] = "Call to action buttons help bring focus to user attention.";     
        $core["home"]["cta1a"]["desc"] = " ";     
        $core["home"]["cta1a"]["title_style"] = "1";     
        $core["home"]["cta1a"]["title_pos"] = "left";     
        $core["home"]["cta1a"]["title_heading"] = "h2";     
        $core["home"]["cta1a"]["title_margin"] = "";     
        $core["home"]["cta1a"]["subtitle_margin"] = "";     
        $core["home"]["cta1a"]["desc_margin"] = "";     
        $core["home"]["cta1a"]["title_txtcolor"] = "light";     
        $core["home"]["cta1a"]["subtitle_txtcolor"] = " opacity-8 text-light";     
        $core["home"]["cta1a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["cta1a"]["title_font"] = "";     
        $core["home"]["cta1a"]["subtitle_font"] = "";     
        $core["home"]["cta1a"]["desc_font"] = "";     
        $core["home"]["cta1a"]["title_txtw"] = "";     
        $core["home"]["cta1a"]["subtitle_txtw"] = "";     
        $core["home"]["cta1a"]["btn_show"] = "yes";     
        $core["home"]["cta1a"]["btn_link"] = "http://localhost/V9/wp-login.php";     
        $core["home"]["cta1a"]["btn_txt"] = "Join Now!";     
        $core["home"]["cta1a"]["btn_bg"] = "";     
        $core["home"]["cta1a"]["btn_bg_txt"] = "";     
        $core["home"]["cta1a"]["btn_icon"] = "";     
        $core["home"]["cta1a"]["btn_icon_pos"] = "";     
        $core["home"]["cta1a"]["btn_size"] = "btn-xl";     
        $core["home"]["cta1a"]["btn_margin"] = "";     
        $core["home"]["cta1a"]["btn_style"] = "1";     
        $core["home"]["cta1a"]["btn_font"] = "";     
        $core["home"]["cta1a"]["btn_txtw"] = "font-weight-bold"; 		
 
        /* listings1 */    
        $core["home"]["listings1"]["section_padding"] = "section-60";     
        $core["home"]["listings1"]["section_bg"] = "bg-white";     
        $core["home"]["listings1"]["section_pos"] = "";     
        $core["home"]["listings1"]["section_w"] = "container";     
        $core["home"]["listings1"]["section_pattern"] = "";     
        $core["home"]["listings1"]["title_show"] = "yes";     
        $core["home"]["listings1"]["title"] = "Popular Auctions";     
        $core["home"]["listings1"]["subtitle"] = " ";     
        $core["home"]["listings1"]["desc"] = " ";     
        $core["home"]["listings1"]["title_style"] = "1";     
        $core["home"]["listings1"]["title_pos"] = "left";     
        $core["home"]["listings1"]["title_heading"] = "h2";     
        $core["home"]["listings1"]["title_margin"] = "mb-4";     
        $core["home"]["listings1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings1"]["desc_margin"] = "";     
        $core["home"]["listings1"]["title_txtcolor"] = "dark";     
        $core["home"]["listings1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings1"]["title_font"] = "";     
        $core["home"]["listings1"]["subtitle_font"] = "";     
        $core["home"]["listings1"]["desc_font"] = "";     
        $core["home"]["listings1"]["title_txtw"] = "text-700";     
        $core["home"]["listings1"]["subtitle_txtw"] = "";     
        $core["home"]["listings1"]["datastring"] = " dataonly='1' cat='' card='blank' perrow='3' show='3' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings1"]["perrow"] = "3";     
        $core["home"]["listings1"]["card"] = "blank";     
        $core["home"]["listings1"]["limit"] = "3";     
        $core["home"]["listings1"]["custom"] = "new"; 		
 
        /* text18 */    
        $core["home"]["text18"]["section_padding"] = "section-80";     
        $core["home"]["text18"]["section_bg"] = "bg-light";     
        $core["home"]["text18"]["section_pos"] = "";     
        $core["home"]["text18"]["section_w"] = "container";     
        $core["home"]["text18"]["section_pattern"] = "";     
        $core["home"]["text18"]["title_show"] = "yes";     
        $core["home"]["text18"]["title"] = "Get Started Today!";     
        $core["home"]["text18"]["subtitle"] = " ";     
        $core["home"]["text18"]["desc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ";     
        $core["home"]["text18"]["title_style"] = "1";     
        $core["home"]["text18"]["title_pos"] = "left";     
        $core["home"]["text18"]["title_heading"] = "h2";     
        $core["home"]["text18"]["title_margin"] = "";     
        $core["home"]["text18"]["subtitle_margin"] = "";     
        $core["home"]["text18"]["desc_margin"] = "";     
        $core["home"]["text18"]["title_txtcolor"] = "dark";     
        $core["home"]["text18"]["subtitle_txtcolor"] = " opacity-8";     
        $core["home"]["text18"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text18"]["title_font"] = "";     
        $core["home"]["text18"]["subtitle_font"] = "";     
        $core["home"]["text18"]["desc_font"] = "";     
        $core["home"]["text18"]["title_txtw"] = "";     
        $core["home"]["text18"]["subtitle_txtw"] = "";     
        $core["home"]["text18"]["btn_show"] = "yes";     
        $core["home"]["text18"]["btn_link"] = "[link-search]";     
        $core["home"]["text18"]["btn_txt"] = "join now";     
        $core["home"]["text18"]["btn_bg"] = "primary";     
        $core["home"]["text18"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text18"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["text18"]["btn_icon_pos"] = "";     
        $core["home"]["text18"]["btn_size"] = "btn-lg";     
        $core["home"]["text18"]["btn_margin"] = "mt-4";     
        $core["home"]["text18"]["btn_style"] = "7";     
        $core["home"]["text18"]["btn_font"] = "";     
        $core["home"]["text18"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text18"]["btn2_show"] = "no";     
        $core["home"]["text18"]["text_image1"] = _ppt_demopath()."/simple1/image15.jpg";        
        $core["home"]["text18"]["text_image1_title"] = "";     
        $core["home"]["text18"]["text_image1_link"] = ""; 		
 
        /* category2 */    
        $core["home"]["category2"]["section_padding"] = "section-80";     
        $core["home"]["category2"]["section_bg"] = "bg-light";     
        $core["home"]["category2"]["section_pos"] = "";     
        $core["home"]["category2"]["section_w"] = "container";     
        $core["home"]["category2"]["section_pattern"] = "";     
        $core["home"]["category2"]["title_show"] = "no";     
        $core["home"]["category2"]["cat_show"] = "6";     
        $core["home"]["category2"]["cat_show_list"] = "5";     
        $core["home"]["category2"]["cat_offset"] = "0"; 		
 
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
					
					"image" => _ppt_demopath()."/products/photo/".$i.".jpg", 
					"thumb" => _ppt_demopath()."/products/photo/".$i.".jpg",			 
					 
						"images" => array(
					
						1 => array(
							"image" => _ppt_demopath()."/products/photo/".$i.".jpg", 
							"thumb" => _ppt_demopath()."/products/photo/".$i.".jpg",
						),
						2 => array(
							"image" => _ppt_demopath()."/products/photo/".$i.".jpg", 
							"thumb" => _ppt_demopath()."/products/photo/".$i.".jpg",
						),
						3 => array(
							"image" => _ppt_demopath()."/products/photo/".$i.".jpg", 
							"thumb" => _ppt_demopath()."/products/photo/".$i.".jpg",
						),	
											
						
					),
									 
				);
		$i++;	
		} 		
			
	return $core;
	}
	
	 
	
}
?>