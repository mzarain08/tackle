<?php
 
add_filter( 'ppt_admin_layouts',  array('at_compact3',  'data') );
add_filter( 'at_compact3',  array('at_compact3',  'load') );
 
class at_compact3 {

	function __construct(){}		

	public static function data($a){ 
	
		global $CORE;
  
		$a['at_compact3'] = array(
		
			"key" => "at_compact3",
		
			"name" 	=> "Compact 3",
			"image"	=> _ppt_demopath()."/designs/compact3.jpg",
						
			"theme"	=> "at_compact",
			
			"color_p" 	=> "#00aff0",
			"color_s" 	=> "#0a1a35",
			
			"order" => 0
 	 		
		);		
		
		return $a;
	
	} 
	
	
	
	public static  function load($core){ global $CORE; 
 
$core['design']['boxed_layout'] = "1";

$core['design']['search_layout'] = "6";

$core['design']['single_layout'] = "1";

$core['design']['font_logo'] = "";
 
 /* fonts */
$core['design']['color_bg'] = "#efefef";
$core['design']['font_logo'] = "";

//$core['design']['font_h1'] = "Barlow";
//$core['design']['font_h2'] = "Barlow";
	
 
	/* logo */
	$core['design']['logo_url_aid'] = "";
	$core['design']['logo_url'] = "";
	$core['design']['light_logo_url_aid'] = "";
	$core['design']['light_logo_url'] = "";
$core['design']['textlogo'] = "<span class='font-weight-bold text-uppercase'>Quick</span><span class='font-weight-bold text-uppercase text-primary'>Bid</span><i class='fal fa-hand-peace ml-2'></i> ";   
 

$core['design']['header_style'] = "header12";
$core['design']['slot1_style'] = "";
$core['design']['slot2_style'] = "listings10";
$core['design']['footer_style'] = "footer1";
$core['design']['slot3_style'] = '';
$core['design']['slot4_style'] = '';
$core['design']['slot5_style'] = '';
$core['design']['slot6_style'] = '';
$core['design']['slot7_style'] = '';
$core['design']['slot8_style'] = '';
$core['design']['slot9_style'] = '';
$core['design']['color_primary'] = "#00aff0";
$core['design']['color_secondary'] = "#0a1a35";
 
 
        /* header12 */    
        $core["header"]["header12"]["section_padding"] = "section-80";     
        $core["header"]["header12"]["section_bg"] = "bg-white";     
        $core["header"]["header12"]["section_pos"] = "";     
        $core["header"]["header12"]["section_w"] = "container";     
        $core["header"]["header12"]["section_pattern"] = "";     
        $core["header"]["header12"]["btn_show"] = "yes";     
        $core["header"]["header12"]["btn_link"] = "[link-add]";     
        $core["header"]["header12"]["btn_txt"] = "POST AD";     
        $core["header"]["header12"]["btn_bg"] = "light";     
        $core["header"]["header12"]["btn_bg_txt"] = "text-dark";     
        $core["header"]["header12"]["btn_icon"] = "fas fa-angle-double-right";     
        $core["header"]["header12"]["btn_icon_pos"] = "after";     
        $core["header"]["header12"]["btn_size"] = "btn-md";     
        $core["header"]["header12"]["btn_margin"] = "mt-0";     
        $core["header"]["header12"]["btn_style"] = "3";     
        $core["header"]["header12"]["btn_font"] = "";     
        $core["header"]["header12"]["topmenu_show"] = "yes"; 		
 
        /* image_basic1 */    
        $core["home"]["image_basic1"]["section_padding"] = "section-0";     
        $core["home"]["image_basic1"]["section_bg"] = "bg-white";     
        $core["home"]["image_basic1"]["section_pos"] = "";     
        $core["home"]["image_basic1"]["section_w"] = "container-fluid";     
        $core["home"]["image_basic1"]["section_pattern"] = "";     
        $core["home"]["image_basic1"]["title_show"] = "no";     
        $core["home"]["image_basic1"]["image_block1"] = _ppt_demopath()."/compact/inline4.jpg";     
    
        $core["home"]["image_basic1"]["image_block1_effect"] = "5";     
        $core["home"]["image_basic1"]["image_block1_txtpos"] = "bleft";     
        $core["home"]["image_basic1"]["image_block1_title"] = "Welcome to our website";     
        $core["home"]["image_basic1"]["image_block1_subtitle"] = "Over 1,000+ Auctions online right now!";     
        $core["home"]["image_basic1"]["image_block1_title_margin"] = "mb-4";     
        $core["home"]["image_basic1"]["image_block1_subtitle_margin"] = "mb-4";     
        $core["home"]["image_basic1"]["image_block1_title_txtcolor"] = "dark";     
        $core["home"]["image_basic1"]["image_block1_subtitle_txtcolor"] = "white";     
        $core["home"]["image_basic1"]["image_block1_title_txtsize"] = "xxl";     
        $core["home"]["image_basic1"]["image_block1_subtitle_txtsize"] = "md";     
        $core["home"]["image_basic1"]["image_block1_title_font"] = "";     
        $core["home"]["image_basic1"]["image_block1_subtitle_font"] = "";     
        $core["home"]["image_basic1"]["image_block1_title_txtw"] = "font-weight-bold";     
        $core["home"]["image_basic1"]["image_block1_subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["image_basic1"]["image_block1_btn_show"] = "yes";     
        $core["home"]["image_basic1"]["image_block1_btn_txt"] = "Member Login";     
        $core["home"]["image_basic1"]["image_block1_btn_bg"] = "light";     
        $core["home"]["image_basic1"]["image_block1_btn_bg_txt"] = "text-dark";     
        $core["home"]["image_basic1"]["image_block1_btn_icon"] = "";     
        $core["home"]["image_basic1"]["image_block1_btn_icon_pos"] = "before";     
        $core["home"]["image_basic1"]["image_block1_btn_size"] = "btn-md";     
        $core["home"]["image_basic1"]["image_block1_btn_margin"] = "mt-0";     
        $core["home"]["image_basic1"]["image_block1_btn_style"] = "3";     
        $core["home"]["image_basic1"]["image_block1_btn_font"] = "";     
        $core["home"]["image_basic1"]["image_block1_btn_link"] = "[link-login]";     
        $core["home"]["image_basic1"]["image_block2_effect"] = "1";     
        $core["home"]["image_basic1"]["image_block2_txtpos"] = "left";     
        $core["home"]["image_basic1"]["image_block3_effect"] = "1";     
        $core["home"]["image_basic1"]["image_block3_txtpos"] = "left";     
        $core["home"]["image_basic1"]["image_block4_effect"] = "1";     
        $core["home"]["image_basic1"]["image_block4_txtpos"] = "left";     
        $core["home"]["image_basic1"]["image_block5_effect"] = "1";     
        $core["home"]["image_basic1"]["image_block5_txtpos"] = "left";     
        $core["home"]["image_basic1"]["image_block6_effect"] = "1";     
        $core["home"]["image_basic1"]["image_block6_txtpos"] = "left"; 	

 
        /* listings10 */    
        $core["home"]["listings10"]["section_padding"] = "section-80";     
        $core["home"]["listings10"]["section_bg"] = "bg-light";     
        $core["home"]["listings10"]["section_pos"] = "";     
        $core["home"]["listings10"]["section_w"] = "container-fluid";     
        $core["home"]["listings10"]["section_pattern"] = "";     
        $core["home"]["listings10"]["title_show"] = "yes";     
        $core["home"]["listings10"]["title"] = "Welcome To Our Website";     
        $core["home"]["listings10"]["subtitle"] = "We've got exactly what you're looking for!";     
        $core["home"]["listings10"]["desc"] = "Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos.";     
        $core["home"]["listings10"]["title_style"] = "2";     
        $core["home"]["listings10"]["title_pos"] = "left";     
        $core["home"]["listings10"]["title_heading"] = "h2";     
        $core["home"]["listings10"]["title_margin"] = "mb-4";     
        $core["home"]["listings10"]["subtitle_margin"] = "mb-4";     
        $core["home"]["listings10"]["desc_margin"] = "mb-4";     
        $core["home"]["listings10"]["title_txtcolor"] = "dark";     
        $core["home"]["listings10"]["subtitle_txtcolor"] = "dark";     
        $core["home"]["listings10"]["desc_txtcolor"] = "opacity-5";     
        $core["home"]["listings10"]["title_font"] = "";     
        $core["home"]["listings10"]["subtitle_font"] = "";     
        $core["home"]["listings10"]["desc_font"] = "";     
        $core["home"]["listings10"]["title_txtw"] = "font-weight-bold";     
        $core["home"]["listings10"]["subtitle_txtw"] = "font-weight-bold";     
        $core["home"]["listings10"]["datastring"] = " dataonly='1' cat='' show='12' custom='new' customvalue='' order='date' orderby='date' debug='0' ";     
        $core["home"]["listings10"]["perrow"] = "2";     
        $core["home"]["listings10"]["card"] = "info";     
        $core["home"]["listings10"]["limit"] = "12"; 		
 
        /* footer1 */    
        $core["footer"]["footer1"]["section_padding"] = "section-60";     
        $core["footer"]["footer1"]["section_bg"] = "bg-white";     
        $core["footer"]["footer1"]["section_pos"] = "";     
        $core["footer"]["footer1"]["section_w"] = "container-fluid";     
        $core["footer"]["footer1"]["section_pattern"] = ""; 		

	




 
		// DEFAULT INNER PAGE DAATA
		$core = $CORE->LAYOUT("default_innerpages", $core);
		
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