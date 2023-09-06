<?php
 
add_filter( 'ppt_admin_layouts',  array('at_mobile',  'data') );
add_filter( 'at_mobile',  array('at_mobile',  'load') );
 
class at_mobile {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_mobile'] = array(
		
			"key" => "at_mobile",
		
			"name" 	=> "Mobile 1",
			"image"	=> _ppt_demopath()."/designs/mobile.jpg",
						
			"theme"	=> "at_mobile",
			
			
			"color_p" 	=> "#c3001e",
			"color_s" 	=> "#0c2b64",
			
			"order" => 0
 	 		
		);		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
  
 $core['design']['single_layout'] = "4";
 $core['design']['search_layout'] = "5";
  $core['design']['search_card'] = "2";
 
	/* logo */
	$core['design']['logo_url_aid'] = "";
	$core['design']['logo_url'] = "";
	$core['design']['light_logo_url_aid'] = "";
	$core['design']['light_logo_url'] = "";
	$core['design']['textlogo'] = "<span class='font-weight-bold text-primary'>Auction</span>Theme";  
 
$core['design']['color_primary'] = "#c3001e";
$core['design']['color_secondary'] = "#0c2b64";
	
$core['design']['header_style'] = "header7";
$core['design']['footer_style'] = "footer1";

$core['design']['slot1_style'] = "hero_text1";

$core['design']['slot2_style'] = "testimonials3a";
$core['design']['slot3_style'] = "listings2";
$core['design']['slot4_style'] = "category8";
$core['design']['slot5_style'] = "text2b";
$core['design']['slot6_style'] = "listings2a";
$core['design']['slot7_style'] = 'subscribe2'; 
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';

 
 
        /* header7 */    
        $core["header"]["header7"]["section_padding"] = "section-80";     
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
        $core["header"]["header7"]["btn_style"] = "1";     
        $core["header"]["header7"]["btn_font"] = "";     
        $core["header"]["header7"]["topmenu_show"] = "yes";     
        $core["header"]["header7"]["extra_show"] = "yes";
 
		
        /* testimonials3a */    
        $core["home"]["testimonials3a"]["section_padding"] = "section-40";     
        $core["home"]["testimonials3a"]["section_bg"] = "bg-light";     
        $core["home"]["testimonials3a"]["section_pos"] = "";     
        $core["home"]["testimonials3a"]["section_w"] = "container";     
        $core["home"]["testimonials3a"]["section_pattern"] = "";     
        $core["home"]["testimonials3a"]["title_show"] = "no"; 
		
        /* hero_text1 */    
        $core["home"]["hero_text1"]["section_padding"] = "section-80";     
        $core["home"]["hero_text1"]["section_bg"] = "bg-light";     
        $core["home"]["hero_text1"]["section_pos"] = "";     
        $core["home"]["hero_text1"]["section_w"] = "container";     
        $core["home"]["hero_text1"]["section_pattern"] = "";     
        $core["home"]["hero_text1"]["title_show"] = "yes";     
        $core["home"]["hero_text1"]["title"] = "Online Auction Website";     
        $core["home"]["hero_text1"]["subtitle"] = "Big saving on amazing items!";     
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
        $core["home"]["hero_text1"]["hero_image"] = _ppt_demopath()."/mobile/hero1.jpg";     
        $core["home"]["hero_text1"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text1"]["hero_overlay"] = "";     
        $core["home"]["hero_text1"]["hero_txtcolor"] = "light"; 		
 
        /* listings2 */    
        $core["home"]["listings2"]["section_padding"] = "section-40";     
        $core["home"]["listings2"]["section_bg"] = "bg-white";     
        $core["home"]["listings2"]["section_pos"] = "";     
        $core["home"]["listings2"]["section_w"] = "container";     
        $core["home"]["listings2"]["section_pattern"] = "";     
        $core["home"]["listings2"]["title_show"] = "yes";     
        $core["home"]["listings2"]["title"] = "Featured Auctions";     
        $core["home"]["listings2"]["subtitle"] = " ";     
        $core["home"]["listings2"]["desc"] = " ";     
        $core["home"]["listings2"]["title_style"] = "1";     
        $core["home"]["listings2"]["title_pos"] = "left";     
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
        $core["home"]["listings2"]["datastring"] = " dataonly='1' cat='' card='blank' perrow='4' show='4' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2"]["perrow"] = "4";     
        $core["home"]["listings2"]["card"] = "blank";     
        $core["home"]["listings2"]["limit"] = "4";     
        $core["home"]["listings2"]["custom"] = "new";     
        $core["home"]["listings2"]["category_ids"] = ""; 		
 
 	
        /* category8 */    
        $core["home"]["category8"]["section_padding"] = "section-60";     
        $core["home"]["category8"]["section_bg"] = "bg-light";     
        $core["home"]["category8"]["section_pos"] = "";     
        $core["home"]["category8"]["section_w"] = "container";     
        $core["home"]["category8"]["section_pattern"] = "";     
        $core["home"]["category8"]["title_show"] = "yes";     
        $core["home"]["category8"]["title"] = "Popular Categories";     
        $core["home"]["category8"]["subtitle"] = " ";     
        $core["home"]["category8"]["desc"] = " ";     
        $core["home"]["category8"]["title_style"] = "1";     
        $core["home"]["category8"]["title_pos"] = "left";     
        $core["home"]["category8"]["title_heading"] = "h2";     
        $core["home"]["category8"]["title_margin"] = "mb-4";     
        $core["home"]["category8"]["subtitle_margin"] = "";     
        $core["home"]["category8"]["desc_margin"] = "";     
        $core["home"]["category8"]["title_txtcolor"] = "dark";     
        $core["home"]["category8"]["subtitle_txtcolor"] = "opacity-5";     
        $core["home"]["category8"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["category8"]["title_font"] = "";     
        $core["home"]["category8"]["subtitle_font"] = "";     
        $core["home"]["category8"]["desc_font"] = "";     
        $core["home"]["category8"]["title_txtw"] = "text-700";     
        $core["home"]["category8"]["subtitle_txtw"] = "";     
        $core["home"]["category8"]["btn_show"] = "yes";     
        $core["home"]["category8"]["btn_link"] = "[link-categories]";     
        $core["home"]["category8"]["btn_txt"] = "All Categories";     
        $core["home"]["category8"]["btn_bg"] = "primary";     
        $core["home"]["category8"]["btn_bg_txt"] = "";     
        $core["home"]["category8"]["btn_icon"] = "";     
        $core["home"]["category8"]["btn_icon_pos"] = "";     
        $core["home"]["category8"]["btn_size"] = "btn-lg";     
        $core["home"]["category8"]["btn_margin"] = "mt-2";     
        $core["home"]["category8"]["btn_style"] = "1";     
        $core["home"]["category8"]["btn_font"] = "";     
        $core["home"]["category8"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["category8"]["cat_show"] = "16";     
        $core["home"]["category8"]["cat_show_list"] = "0";     
        $core["home"]["category8"]["cat_offset"] = "0"; 

      /* text2b */    
        $core["home"]["text2b"]["section_padding"] = "";     
        $core["home"]["text2b"]["section_bg"] = "bg-white";     
        $core["home"]["text2b"]["section_pos"] = "";     
        $core["home"]["text2b"]["section_w"] = "container";     
        $core["home"]["text2b"]["section_pattern"] = "";     
        $core["home"]["text2b"]["title_show"] = "yes";     
        $core["home"]["text2b"]["title"] = "Welcome to our website!";     
        $core["home"]["text2b"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ";     
        $core["home"]["text2b"]["desc"] = " ";     
        $core["home"]["text2b"]["title_style"] = "1";     
        $core["home"]["text2b"]["title_pos"] = "left";     
        $core["home"]["text2b"]["title_heading"] = "h2";     
        $core["home"]["text2b"]["title_margin"] = "mb-4";     
        $core["home"]["text2b"]["subtitle_margin"] = "";     
        $core["home"]["text2b"]["desc_margin"] = "";     
        $core["home"]["text2b"]["title_txtcolor"] = "black";     
        $core["home"]["text2b"]["subtitle_txtcolor"] = " opacity-8";     
        $core["home"]["text2b"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text2b"]["title_font"] = "";     
        $core["home"]["text2b"]["subtitle_font"] = "";     
        $core["home"]["text2b"]["desc_font"] = "";     
        $core["home"]["text2b"]["title_txtw"] = "text-700";     
        $core["home"]["text2b"]["subtitle_txtw"] = "";     
        $core["home"]["text2b"]["btn_show"] = "yes";     
        $core["home"]["text2b"]["btn_link"] = "[link-register]";     
        $core["home"]["text2b"]["btn_txt"] = "Join Now!";     
        $core["home"]["text2b"]["btn_bg"] = "primary";     
        $core["home"]["text2b"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text2b"]["btn_icon"] = "";     
        $core["home"]["text2b"]["btn_icon_pos"] = "";     
        $core["home"]["text2b"]["btn_size"] = "btn-lg";     
        $core["home"]["text2b"]["btn_margin"] = "mt-4";     
        $core["home"]["text2b"]["btn_style"] = "1";     
        $core["home"]["text2b"]["btn_font"] = "";     
        $core["home"]["text2b"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text2b"]["btn2_show"] = "no";     
        $core["home"]["text2b"]["btn2_link"] = "";     
        $core["home"]["text2b"]["btn2_txt"] = "";     
        $core["home"]["text2b"]["btn2_bg"] = "primary";     
        $core["home"]["text2b"]["btn2_bg_txt"] = "text-light";     
        $core["home"]["text2b"]["btn2_icon"] = "";     
        $core["home"]["text2b"]["btn2_icon_pos"] = "before";     
        $core["home"]["text2b"]["btn2_size"] = "btn-lg";     
        $core["home"]["text2b"]["btn2_margin"] = "mt-4";     
        $core["home"]["text2b"]["btn2_style"] = "1";     
        $core["home"]["text2b"]["btn2_txtw"] = "font-weight-bold";     
        $core["home"]["text2b"]["btn2_font"] = "";  
		 
        $core["home"]["text2b"]["text_image1"] = _ppt_demopath()."/mobile/image1.jpg";     
		
 
        /* listings2a */    
        $core["home"]["listings2a"]["section_padding"] = "section-bottom-40";     
        $core["home"]["listings2a"]["section_bg"] = "bg-white";     
        $core["home"]["listings2a"]["section_pos"] = "";     
        $core["home"]["listings2a"]["section_w"] = "container";     
        $core["home"]["listings2a"]["section_pattern"] = "";     
        $core["home"]["listings2a"]["title_show"] = "no";     
        $core["home"]["listings2a"]["title"] = "";     
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
        $core["home"]["listings2a"]["datastring"] = " dataonly='1' cat='' card='blank' perrow='4' show='8' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2a"]["perrow"] = "4";     
        $core["home"]["listings2a"]["card"] = "blank";     
        $core["home"]["listings2a"]["limit"] = "8";     
        $core["home"]["listings2a"]["custom"] = "new";     
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
        $core["home"]["subscribe2"]["image_subscribe"] = _ppt_demopath()."/mobile/hero2.jpg"; 		


	
 
        /* footer1 */    
        $core["footer"]["footer1"]["section_padding"] = "section-60";     
        $core["footer"]["footer1"]["section_bg"] = "bg-secondary";     
        $core["footer"]["footer1"]["section_pos"] = "";     
        $core["footer"]["footer1"]["section_w"] = "container-fluid";     
        $core["footer"]["footer1"]["section_pattern"] = ""; 		
 		 
 
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