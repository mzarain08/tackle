<?php
 
add_filter( 'ppt_admin_layouts',  array('at_s3',  'data') );
add_filter( 'at_s3',  array('at_s3',  'load') );
 
class at_s3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_s3'] = array(
		
			"key" => "at_s3",
		
			"name" 	=> "Niche 3",
			"image"	=> _ppt_demopath()."/designs/simple3.jpg",
						
			"theme"	=> "at_s1",
			
			
			"color_p" 	=> "#ec762e",
			"color_s" 	=> "#000000",
			
			"order" => 1.3
 	 		
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
	$core['design']['textlogo'] = "<span class='font-weight-bold text-primary'>Gym</span>Auctions";  
 
 
 
$core['design']['color_primary'] = "#ec762e";
$core['design']['color_secondary'] = "#000000";
 
$core['design']['header_style'] = "header12";
$core['design']['slot1_style'] = "hero_text3c";
$core['design']['slot2_style'] = "listings1";
$core['design']['slot3_style'] = "text1g";
$core['design']['slot4_style'] = "testimonials3";
$core['design']['slot5_style'] = "text1f";
$core['design']['slot6_style'] = "listings5";
$core['design']['slot7_style'] = "category1a";
$core['design']['footer_style'] = "footer1";
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
 
 
        /* header12 */    
        $core["header"]["header12"]["section_padding"] = "";     
        $core["header"]["header12"]["section_bg"] = "bg-white";     
        $core["header"]["header12"]["section_pos"] = "";     
        $core["header"]["header12"]["section_w"] = "container";     
        $core["header"]["header12"]["section_pattern"] = "";     
        $core["header"]["header12"]["btn_show"] = "yes";     
        $core["header"]["header12"]["btn_link"] = "";     
        $core["header"]["header12"]["btn_txt"] = "Add Auction";     
        $core["header"]["header12"]["btn_bg"] = "dark";     
        $core["header"]["header12"]["btn_bg_txt"] = "text-light";     
        $core["header"]["header12"]["btn_icon"] = "";     
        $core["header"]["header12"]["btn_icon_pos"] = "before";     
        $core["header"]["header12"]["btn_size"] = "btn-md";     
        $core["header"]["header12"]["btn_margin"] = "mt-0";     
        $core["header"]["header12"]["btn_style"] = "5";     
        $core["header"]["header12"]["btn_font"] = "";     
        $core["header"]["header12"]["btn_txtw"] = "font-weight-bold";     
        $core["header"]["header12"]["topmenu_show"] = "yes";     
        $core["header"]["header12"]["extra_show"] = "yes";     
        $core["header"]["header12"]["extra_type"] = "button"; 		
 
        /* hero_text3c */    
        $core["home"]["hero_text3c"]["section_padding"] = "";     
        $core["home"]["hero_text3c"]["section_bg"] = "bg-white";     
        $core["home"]["hero_text3c"]["section_pos"] = "";     
        $core["home"]["hero_text3c"]["section_w"] = "container";     
        $core["home"]["hero_text3c"]["section_pattern"] = "";     
        $core["home"]["hero_text3c"]["title_show"] = "yes";     
        $core["home"]["hero_text3c"]["title"] = "Gym Equipment Online Auctions";     
        $core["home"]["hero_text3c"]["subtitle"] = "Get the best deals on gym equipment.";     
        $core["home"]["hero_text3c"]["desc"] = "Welcome to our auction website. We have hundreds of amazing auction all just a click away! ";     
        $core["home"]["hero_text3c"]["title_style"] = "1";     
        $core["home"]["hero_text3c"]["title_pos"] = "left";     
        $core["home"]["hero_text3c"]["title_heading"] = "h1";     
        $core["home"]["hero_text3c"]["title_margin"] = "mb-2";     
        $core["home"]["hero_text3c"]["subtitle_margin"] = "mb-4";     
        $core["home"]["hero_text3c"]["desc_margin"] = "";     
        $core["home"]["hero_text3c"]["title_txtcolor"] = "primary";     
        $core["home"]["hero_text3c"]["subtitle_txtcolor"] = " opacity-8";     
        $core["home"]["hero_text3c"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["hero_text3c"]["title_font"] = "";     
        $core["home"]["hero_text3c"]["subtitle_font"] = "";     
        $core["home"]["hero_text3c"]["desc_font"] = "";     
        $core["home"]["hero_text3c"]["title_txtw"] = "text-700";     
        $core["home"]["hero_text3c"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3c"]["btn_show"] = "yes";     
        $core["home"]["hero_text3c"]["btn_link"] = "[link-search]";     
        $core["home"]["hero_text3c"]["btn_txt"] = "Search Website";     
        $core["home"]["hero_text3c"]["btn_bg"] = "primary";     
        $core["home"]["hero_text3c"]["btn_bg_txt"] = "text-light";     
        $core["home"]["hero_text3c"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["hero_text3c"]["btn_icon_pos"] = "before";     
        $core["home"]["hero_text3c"]["btn_size"] = "btn-lg";     
        $core["home"]["hero_text3c"]["btn_margin"] = "mt-4";     
        $core["home"]["hero_text3c"]["btn_style"] = "1";     
        $core["home"]["hero_text3c"]["btn_font"] = "";     
        $core["home"]["hero_text3c"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["hero_text3c"]["btn2_show"] = "no";     
        $core["home"]["hero_text3c"]["hero_image"] = _ppt_demopath()."/simple1/image6.jpg";        
        $core["home"]["hero_text3c"]["hero_size"] = "hero-medium";     
        $core["home"]["hero_text3c"]["hero_overlay"] = "none";     
        $core["home"]["hero_text3c"]["hero_txtcolor"] = "light"; 		
 
        /* listings1 */    
        $core["home"]["listings1"]["section_padding"] = "section-60";     
        $core["home"]["listings1"]["section_bg"] = "bg-white";     
        $core["home"]["listings1"]["section_pos"] = "";     
        $core["home"]["listings1"]["section_w"] = "container";     
        $core["home"]["listings1"]["section_pattern"] = "";     
        $core["home"]["listings1"]["title_show"] = "yes";     
        $core["home"]["listings1"]["title"] = "Newly Added";     
        $core["home"]["listings1"]["subtitle"] = " ";     
        $core["home"]["listings1"]["desc"] = " ";     
        $core["home"]["listings1"]["title_style"] = "1";     
        $core["home"]["listings1"]["title_pos"] = "left";     
        $core["home"]["listings1"]["title_heading"] = "h2";     
        $core["home"]["listings1"]["title_margin"] = "mb-0";     
        $core["home"]["listings1"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings1"]["desc_margin"] = "";     
        $core["home"]["listings1"]["title_txtcolor"] = "dark";     
        $core["home"]["listings1"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings1"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings1"]["title_font"] = "";     
        $core["home"]["listings1"]["subtitle_font"] = "";     
        $core["home"]["listings1"]["desc_font"] = "";     
        $core["home"]["listings1"]["title_txtw"] = "";     
        $core["home"]["listings1"]["subtitle_txtw"] = "";     
        $core["home"]["listings1"]["datastring"] = " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings1"]["perrow"] = "";     
        $core["home"]["listings1"]["card"] = "info";     
        $core["home"]["listings1"]["limit"] = "";     
        $core["home"]["listings1"]["custom"] = "new"; 		
 
        /* text1g */    
        $core["home"]["text1g"]["section_padding"] = "section-80";     
        $core["home"]["text1g"]["section_bg"] = "bg-light";     
        $core["home"]["text1g"]["section_pos"] = "";     
        $core["home"]["text1g"]["section_w"] = "container";     
        $core["home"]["text1g"]["section_pattern"] = "";     
        $core["home"]["text1g"]["title_show"] = "yes";     
        $core["home"]["text1g"]["title"] = "Dont Miss Out";     
        $core["home"]["text1g"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.???";     
        $core["home"]["text1g"]["desc"] = " ";     
        $core["home"]["text1g"]["title_style"] = "1";     
        $core["home"]["text1g"]["title_pos"] = "left";     
        $core["home"]["text1g"]["title_heading"] = "h1";     
        $core["home"]["text1g"]["title_margin"] = "mb-4";     
        $core["home"]["text1g"]["subtitle_margin"] = "";     
        $core["home"]["text1g"]["desc_margin"] = "";     
        $core["home"]["text1g"]["title_txtcolor"] = "dark";     
        $core["home"]["text1g"]["subtitle_txtcolor"] = "opacity-5";     
        $core["home"]["text1g"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1g"]["title_font"] = "";     
        $core["home"]["text1g"]["subtitle_font"] = "";     
        $core["home"]["text1g"]["desc_font"] = "";     
        $core["home"]["text1g"]["title_txtw"] = "";     
        $core["home"]["text1g"]["subtitle_txtw"] = "";     
        $core["home"]["text1g"]["btn_show"] = "yes";     
        $core["home"]["text1g"]["btn_link"] = "[link-search]";     
        $core["home"]["text1g"]["btn_txt"] = "Get Started";     
        $core["home"]["text1g"]["btn_bg"] = "primary";     
        $core["home"]["text1g"]["btn_bg_txt"] = "text-light";     
        $core["home"]["text1g"]["btn_icon"] = "fas fa-search";     
        $core["home"]["text1g"]["btn_icon_pos"] = "before";     
        $core["home"]["text1g"]["btn_size"] = "btn-lg";     
        $core["home"]["text1g"]["btn_margin"] = "mt-2";     
        $core["home"]["text1g"]["btn_style"] = "1";     
        $core["home"]["text1g"]["btn_font"] = "";     
        $core["home"]["text1g"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text1g"]["btn2_show"] = "no";     
        $core["home"]["text1g"]["text_image1"] = _ppt_demopath()."/simple1/image7.jpg";        
        $core["home"]["text1g"]["text_image1_title"] = "";     
        $core["home"]["text1g"]["text_image1_link"] = ""; 		
 
        /* testimonials3 */    
        $core["home"]["testimonials3"]["section_padding"] = "section-40";     
        $core["home"]["testimonials3"]["section_bg"] = "bg-dark";     
        $core["home"]["testimonials3"]["section_pos"] = "";     
        $core["home"]["testimonials3"]["section_w"] = "container";     
        $core["home"]["testimonials3"]["section_pattern"] = "";     
        $core["home"]["testimonials3"]["title_show"] = "no"; 		
 
        /* text1f */    
        $core["home"]["text1f"]["section_padding"] = "section-80";     
        $core["home"]["text1f"]["section_bg"] = "bg-light";     
        $core["home"]["text1f"]["section_pos"] = "";     
        $core["home"]["text1f"]["section_w"] = "container";     
        $core["home"]["text1f"]["section_pattern"] = "";     
        $core["home"]["text1f"]["title_show"] = "yes";     
        $core["home"]["text1f"]["title"] = "Going Going Gone!";     
        $core["home"]["text1f"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";     
        $core["home"]["text1f"]["desc"] = " ";     
        $core["home"]["text1f"]["title_style"] = "1";     
        $core["home"]["text1f"]["title_pos"] = "left";     
        $core["home"]["text1f"]["title_heading"] = "h2";     
        $core["home"]["text1f"]["title_margin"] = "mb-4";     
        $core["home"]["text1f"]["subtitle_margin"] = "";     
        $core["home"]["text1f"]["desc_margin"] = "";     
        $core["home"]["text1f"]["title_txtcolor"] = "dark";     
        $core["home"]["text1f"]["subtitle_txtcolor"] = "opacity-5";     
        $core["home"]["text1f"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["text1f"]["title_font"] = "";     
        $core["home"]["text1f"]["subtitle_font"] = "";     
        $core["home"]["text1f"]["desc_font"] = "";     
        $core["home"]["text1f"]["title_txtw"] = "";     
        $core["home"]["text1f"]["subtitle_txtw"] = "";     
        $core["home"]["text1f"]["btn_show"] = "yes";     
        $core["home"]["text1f"]["btn_link"] = "[link-search]";     
        $core["home"]["text1f"]["btn_txt"] = "Signup Now";     
        $core["home"]["text1f"]["btn_bg"] = "primary";     
        $core["home"]["text1f"]["btn_bg_txt"] = "";     
        $core["home"]["text1f"]["btn_icon"] = "far fa-arrow-alt-circle-right";     
        $core["home"]["text1f"]["btn_icon_pos"] = "before";     
        $core["home"]["text1f"]["btn_size"] = "btn-xl";     
        $core["home"]["text1f"]["btn_margin"] = "mt-2";     
        $core["home"]["text1f"]["btn_style"] = "1";     
        $core["home"]["text1f"]["btn_font"] = "";     
        $core["home"]["text1f"]["btn_txtw"] = "font-weight-bold";     
        $core["home"]["text1f"]["btn2_show"] = "no";     
        $core["home"]["text1f"]["text_image1"] = _ppt_demopath()."/simple1/image8.jpg";         
        $core["home"]["text1f"]["text_image1_title"] = "";     
        $core["home"]["text1f"]["text_image1_link"] = ""; 		
 
        /* listings5 */    
        $core["home"]["listings5"]["section_padding"] = "section-60";     
        $core["home"]["listings5"]["section_bg"] = "bg-white";     
        $core["home"]["listings5"]["section_pos"] = "";     
        $core["home"]["listings5"]["section_w"] = "container";     
        $core["home"]["listings5"]["section_pattern"] = "";     
        $core["home"]["listings5"]["title_show"] = "yes";     
        $core["home"]["listings5"]["title"] = "Popular Items";     
        $core["home"]["listings5"]["subtitle"] = " ";     
        $core["home"]["listings5"]["desc"] = " ";     
        $core["home"]["listings5"]["title_style"] = "1";     
        $core["home"]["listings5"]["title_pos"] = "left";     
        $core["home"]["listings5"]["title_heading"] = "h2";     
        $core["home"]["listings5"]["title_margin"] = "mb-0";     
        $core["home"]["listings5"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings5"]["desc_margin"] = "";     
        $core["home"]["listings5"]["title_txtcolor"] = "dark";     
        $core["home"]["listings5"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["listings5"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings5"]["title_font"] = "";     
        $core["home"]["listings5"]["subtitle_font"] = "";     
        $core["home"]["listings5"]["desc_font"] = "";     
        $core["home"]["listings5"]["title_txtw"] = "";     
        $core["home"]["listings5"]["subtitle_txtw"] = "";     
        $core["home"]["listings5"]["datastring"] = " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings5"]["perrow"] = "";     
        $core["home"]["listings5"]["card"] = "info";     
        $core["home"]["listings5"]["limit"] = "";     
        $core["home"]["listings5"]["custom"] = "new"; 		
 
        /* category1a */    
        $core["home"]["category1a"]["section_padding"] = "section-60";     
        $core["home"]["category1a"]["section_bg"] = "bg-light";     
        $core["home"]["category1a"]["section_pos"] = "";     
        $core["home"]["category1a"]["section_w"] = "container";     
        $core["home"]["category1a"]["section_pattern"] = "";     
        $core["home"]["category1a"]["title_show"] = "yes";     
        $core["home"]["category1a"]["title"] = "Auction Categories";     
        $core["home"]["category1a"]["subtitle"] = " ";     
        $core["home"]["category1a"]["desc"] = " ";     
        $core["home"]["category1a"]["title_style"] = "1";     
        $core["home"]["category1a"]["title_pos"] = "left";     
        $core["home"]["category1a"]["title_heading"] = "h2";     
        $core["home"]["category1a"]["title_margin"] = "mb-0";     
        $core["home"]["category1a"]["subtitle_margin"] = "mb-0";     
        $core["home"]["category1a"]["desc_margin"] = "mb-4";     
        $core["home"]["category1a"]["title_txtcolor"] = "dark";     
        $core["home"]["category1a"]["subtitle_txtcolor"] = "primary";     
        $core["home"]["category1a"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["category1a"]["title_font"] = "";     
        $core["home"]["category1a"]["subtitle_font"] = "";     
        $core["home"]["category1a"]["desc_font"] = "";     
        $core["home"]["category1a"]["title_txtw"] = "text-800";     
        $core["home"]["category1a"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["category1a"]["cat_show"] = "4";     
        $core["home"]["category1a"]["cat_show_list"] = "5";     
        $core["home"]["category1a"]["cat_offset"] = "0"; 		
 
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
					
					"image" => DEMO_IMG_PATH."at/products/gym/".$i.".jpg", 
					"thumb" => DEMO_IMG_PATH."at/products/gym/".$i.".jpg",			 
					
					"images" => array(
					
						1 => array(
							"image" => DEMO_IMG_PATH."at/products/gym/".$i.".jpg", 
							"thumb" => DEMO_IMG_PATH."at/products/gym/".$i.".jpg",
						),
				 				
												
						
					),
					
									 
				);
		$i++;	
		} 
	
	return $core;
	}
	
	
}
?>