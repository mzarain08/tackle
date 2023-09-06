<?php
 
add_filter( 'ppt_admin_layouts',  array('at_style4b',  'data') );
add_filter( 'at_style4b',  array('at_style4b',  'load') );
 
class at_style4b {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_style4b'] = array(
		
			"key" => "at_style4b",
		
			"name" 	=> "Style 4",
			"image"	=> _ppt_demopath()."/designs/style4b.jpg",
						
			"theme"	=> "at_style4",
			
			
			"color_p" 	=> "#003884",
			"color_s" 	=> "#FF6600",
			
			"order" => 0
 	 		
		);		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
 
 
 //
 
 
 
 /* fonts */
$core['design']['font_body'] = "";
$core['design']['font_logo'] = "";

//$core['design']['font_h1'] = "Barlow";
//$core['design']['font_h2'] = "Barlow";
	
 
	/* logo */
	$core['design']['logo_url_aid'] = "";
	$core['design']['logo_url'] = "";
	$core['design']['light_logo_url_aid'] = "";
	$core['design']['light_logo_url'] = "";
	$core['design']['textlogo'] = "<i class='fal fa-paint-brush hide-mobile text-primary'>&nbsp;</i><span class='font-weight-bold text-uppercase'>Art Auctions</span>";   
	$core['design']['color_bg'] = "";
	$core['design']['color_text'] = "";
	
$core['design']['header_style'] = "header4";
$core['design']['slot1_style'] = "image_style3";
$core['design']['slot2_style'] = "listings2";
$core['design']['slot3_style'] = "testimonials3a";
$core['design']['footer_style'] = "footer1";
$core['design']['slot4_style'] = '';
$core['design']['slot5_style'] = '';
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
$core['design']['color_primary'] = "#003884";
$core['design']['color_secondary'] = "#FF6600";
 
 
        /* header4 */    
        $core["header"]["header4"]["section_padding"] = "section-80";     
        $core["header"]["header4"]["section_bg"] = "bg-white";     
        $core["header"]["header4"]["section_pos"] = "";     
        $core["header"]["header4"]["section_w"] = "container";     
        $core["header"]["header4"]["section_pattern"] = "";     
        $core["header"]["header4"]["btn_show"] = "yes";     
        $core["header"]["header4"]["btn_link"] = "[link-add]";     
        $core["header"]["header4"]["btn_txt"] = "Add Auction";     
        $core["header"]["header4"]["btn_bg"] = "secondary";     
        $core["header"]["header4"]["btn_bg_txt"] = "text-light";     
        $core["header"]["header4"]["btn_icon"] = "";     
        $core["header"]["header4"]["btn_icon_pos"] = "before";     
        $core["header"]["header4"]["btn_size"] = "btn-md";     
        $core["header"]["header4"]["btn_margin"] = "mt-0";     
        $core["header"]["header4"]["btn_style"] = "1";     
        $core["header"]["header4"]["btn_font"] = "";     
        $core["header"]["header4"]["topmenu_show"] = "yes";     
        $core["header"]["header4"]["extra_show"] = "yes"; 		
 
        /* image_style3 */    
        $core["home"]["image_style3"]["section_padding"] = "section-80";     
        $core["home"]["image_style3"]["section_bg"] = "bg-light";     
        $core["home"]["image_style3"]["section_pos"] = "";     
        $core["home"]["image_style3"]["section_w"] = "container";     
        $core["home"]["image_style3"]["section_pattern"] = "";     
        $core["home"]["image_style3"]["title_show"] = "no";     
        $core["home"]["image_style3"]["image_block1"] = _ppt_demopath()."/style4/b1.jpg";     
        $core["home"]["image_style3"]["image_block1_effect"] = "2";     
        $core["home"]["image_style3"]["image_block1_txtpos"] = "bcenter";     
        $core["home"]["image_style3"]["image_block1_title"] = "Welcome to <br> <i class='fal fa-paint-brush hide-mobile mx-2 '></i> Art Lovers";     
        $core["home"]["image_style3"]["image_block1_subtitle"] = "Over 1,000 paintings up for grabs!";     
        $core["home"]["image_style3"]["image_block1_title_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block1_subtitle_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block1_title_txtcolor"] = "white";     
        $core["home"]["image_style3"]["image_block1_subtitle_txtcolor"] = "white";     
        $core["home"]["image_style3"]["image_block1_title_txtsize"] = "xl";     
        $core["home"]["image_style3"]["image_block1_subtitle_txtsize"] = "md";     
        $core["home"]["image_style3"]["image_block1_title_font"] = "";     
        $core["home"]["image_style3"]["image_block1_subtitle_font"] = "";     
        $core["home"]["image_style3"]["image_block1_title_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block1_subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block1_btn_show"] = "yes";     
        $core["home"]["image_style3"]["image_block1_btn_txt"] = "Search Now";     
        $core["home"]["image_style3"]["image_block1_btn_bg"] = "secondary";     
        $core["home"]["image_style3"]["image_block1_btn_bg_txt"] = "text-light";     
        $core["home"]["image_style3"]["image_block1_btn_icon"] = "";     
        $core["home"]["image_style3"]["image_block1_btn_icon_pos"] = "before";     
        $core["home"]["image_style3"]["image_block1_btn_size"] = "btn-xl";     
        $core["home"]["image_style3"]["image_block1_btn_margin"] = "mt-0";     
        $core["home"]["image_style3"]["image_block1_btn_style"] = "2";     
        $core["home"]["image_style3"]["image_block1_btn_font"] = "";     
        $core["home"]["image_style3"]["image_block1_btn_link"] = "[link-search]";     
        $core["home"]["image_style3"]["image_block2"] = _ppt_demopath()."/style4/b2.jpg";     
        $core["home"]["image_style3"]["image_block2_effect"] = "2";     
        $core["home"]["image_style3"]["image_block2_txtpos"] = "bleft";     
        $core["home"]["image_style3"]["image_block2_title"] = "Members Area";     
        $core["home"]["image_style3"]["image_block2_subtitle"] = "";     
        $core["home"]["image_style3"]["image_block2_title_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block2_subtitle_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block2_title_txtcolor"] = "black";     
        $core["home"]["image_style3"]["image_block2_subtitle_txtcolor"] = "dark";     
        $core["home"]["image_style3"]["image_block2_title_txtsize"] = "xl";     
        $core["home"]["image_style3"]["image_block2_subtitle_txtsize"] = "md";     
        $core["home"]["image_style3"]["image_block2_title_font"] = "";     
        $core["home"]["image_style3"]["image_block2_subtitle_font"] = "";     
        $core["home"]["image_style3"]["image_block2_title_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block2_subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block2_btn_show"] = "yes";     
        $core["home"]["image_style3"]["image_block2_btn_txt"] = "login now";     
        $core["home"]["image_style3"]["image_block2_btn_bg"] = "secondary";     
        $core["home"]["image_style3"]["image_block2_btn_bg_txt"] = "text-light";     
        $core["home"]["image_style3"]["image_block2_btn_icon"] = "";     
        $core["home"]["image_style3"]["image_block2_btn_icon_pos"] = "before";     
        $core["home"]["image_style3"]["image_block2_btn_size"] = "btn-md";     
        $core["home"]["image_style3"]["image_block2_btn_margin"] = "mt-0";     
        $core["home"]["image_style3"]["image_block2_btn_style"] = "5";     
        $core["home"]["image_style3"]["image_block2_btn_font"] = "";     
        $core["home"]["image_style3"]["image_block2_btn_link"] = "[link-login]";     
        $core["home"]["image_style3"]["image_block3"] = _ppt_demopath()."/style4/b3.jpg";     
        $core["home"]["image_style3"]["image_block3_effect"] = "2";     
        $core["home"]["image_style3"]["image_block3_txtpos"] = "bright";     
        $core["home"]["image_style3"]["image_block3_title"] = "Join Free Today!";     
        $core["home"]["image_style3"]["image_block3_subtitle"] = "";     
        $core["home"]["image_style3"]["image_block3_title_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block3_subtitle_margin"] = "mb-4";     
        $core["home"]["image_style3"]["image_block3_title_txtcolor"] = "black";     
        $core["home"]["image_style3"]["image_block3_subtitle_txtcolor"] = "dark";     
        $core["home"]["image_style3"]["image_block3_title_txtsize"] = "xl";     
        $core["home"]["image_style3"]["image_block3_subtitle_txtsize"] = "md";     
        $core["home"]["image_style3"]["image_block3_title_font"] = "";     
        $core["home"]["image_style3"]["image_block3_subtitle_font"] = "";     
        $core["home"]["image_style3"]["image_block3_title_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block3_subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["image_style3"]["image_block3_btn_show"] = "yes";     
        $core["home"]["image_style3"]["image_block3_btn_txt"] = "Register";     
        $core["home"]["image_style3"]["image_block3_btn_bg"] = "secondary";     
        $core["home"]["image_style3"]["image_block3_btn_bg_txt"] = "text-light";     
        $core["home"]["image_style3"]["image_block3_btn_icon"] = "";     
        $core["home"]["image_style3"]["image_block3_btn_icon_pos"] = "before";     
        $core["home"]["image_style3"]["image_block3_btn_size"] = "btn-md";     
        $core["home"]["image_style3"]["image_block3_btn_margin"] = "mt-0";     
        $core["home"]["image_style3"]["image_block3_btn_style"] = "5";     
        $core["home"]["image_style3"]["image_block3_btn_font"] = "";     
        $core["home"]["image_style3"]["image_block3_btn_link"] = "[link-register]";     
        $core["home"]["image_style3"]["image_block4_effect"] = "2";     
        $core["home"]["image_style3"]["image_block4_txtpos"] = "bcenter";     
        $core["home"]["image_style3"]["image_block5_effect"] = "1";     
        $core["home"]["image_style3"]["image_block5_txtpos"] = "left";     
        $core["home"]["image_style3"]["image_block6_effect"] = "1";     
        $core["home"]["image_style3"]["image_block6_txtpos"] = "left"; 		
 
        /* listings2 */    
        $core["home"]["listings2"]["section_padding"] = "section-80";     
        $core["home"]["listings2"]["section_bg"] = "bg-white";     
        $core["home"]["listings2"]["section_pos"] = "";     
        $core["home"]["listings2"]["section_w"] = "container";     
        $core["home"]["listings2"]["section_pattern"] = "";     
        $core["home"]["listings2"]["title_show"] = "yes";     
        $core["home"]["listings2"]["title"] = "FEATURED <i class='fal fa-paint-brush hide-mobile mx-2 text-primary'></i> PAINTINGS";     
        $core["home"]["listings2"]["subtitle"] = "";     
        $core["home"]["listings2"]["desc"] = "";     
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
        $core["home"]["listings2"]["datastring"] = " dataonly='1' cat='' show='12' custom='new' customvalue='' order='desc' orderby='date' debug='0' ";     
        $core["home"]["listings2"]["perrow"] = "4";     
        $core["home"]["listings2"]["card"] = "list-small";     
        $core["home"]["listings2"]["limit"] = "12"; 		
 
        /* testimonials3a */    
        $core["home"]["testimonials3a"]["section_padding"] = "section-40";     
        $core["home"]["testimonials3a"]["section_bg"] = "bg-light";     
        $core["home"]["testimonials3a"]["section_pos"] = "";     
        $core["home"]["testimonials3a"]["section_w"] = "container";     
        $core["home"]["testimonials3a"]["section_pattern"] = "";     
        $core["home"]["testimonials3a"]["title_show"] = "no"; 		
 
        /* footer1 */    
        $core["footer"]["footer1"]["section_padding"] = "section-60";     
        $core["footer"]["footer1"]["section_bg"] = "bg-dark";     
        $core["footer"]["footer1"]["section_pos"] = "";     
        $core["footer"]["footer1"]["section_w"] = "container-fluid";     
        $core["footer"]["footer1"]["section_pattern"] = ""; 		


 
		// DEFAULT INNER PAGE DAATA
		$core = $CORE->LAYOUT("default_innerpages", $core);
		
		// SAMPLE DATA		
		$i=1;		
		while($i < 21){	
		
			$core['sampledata'][$i] = array(		 
					
					"title" => "Example Painting ".$i,	
					
					"image" => _ppt_demopath()."/products/art/".$i.".jpg", 
					"thumb" => _ppt_demopath()."/products/art/".$i.".jpg",			 
					 
									 
				);
		$i++;	
		}  	
			
	return $core;
	}
	
	
}

?>