<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } 
if (!headers_sent()){ header('X-UA-Compatible: IE=edge'); }


$GLOBALS['flag-docs'] = 1; 

global $CORE, $CORE_UI;


 
$navigation = array(

 
	"intro" => array(	 				
		"n" 		=> __("Getting Started","premiumpress"),				
		"i" 		=> "bell", 				
		"desc"		=> "Thank you for choosing PremiumPress. This documentation is work in progress.",				
		"docs" 		=> "",				
		"l" 		=> "p_intro",
	),
	
	
	"structure" => array(	 				
		"n" => __("Theme structure","premiumpress"),				
		"i" 		=> "folder_add", 				
		"desc"		=> "A quick overview of the theme file structure.",				
		"docs" 		=> "",				
		"l" => "p_structure",
	),
	
	"blocks_cats" => array(	 				
		"n" => __("Blocks","premiumpress"),				
		"i" 		=> "desktop", 				
		"desc"		=> "A quick overview of the theme file structure.",				
		"docs" 		=> "",				
		"l" => "block_cats",
	),


	
	"styles" => array(
		
		"n" => __("Layout","premiumpress"), "i" => "filters", "p" => array( 
		
		"c_typography" => array(	
							
				"n" => __("Typography","premiumpress"),				
				"i" 		=> "text-left",				
				"desc"		=> "Headings, body text, lists, blockquotes and more.",				
				"docs" 		=> "https://getbootstrap.com/docs/5.1/content/typography/",				
				"l" => "c_typography",		
			),
				
			"e_ui" => array(	 				
				"n" => __("UI Elements","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "e_ui",
			),
			
		
			"c_colors" => array(	 				
				"n" => __("Colors","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "PremiumPress themes use 3 main colors. <mark>.bg-primary</mark>, <mark>.bg-secondary</mark>, <mark>.bg-soft</mark> ",				
				"docs" 		=> "",				
				"l" => "c_colors",
			),
			
			"c_fonts" => array(		
							
				"n" => __("Fonts","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "",
			),
			
			"c_icons" => array(		
							
				"n" => __("Icons","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "PremiumPress themes will be using SVG icons in future and moving away from Fontawesome to improve page loading time and overall performance.",				
				"docs" 		=> "",				
				"l" => "",
			),
			
			
			"c_lists" => array(		
	 				
				"n" => __("Lists","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "",
			), 
			
			"c_forms" => array(					
				"n" 		=> __("Forms","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "PremiumPress forms have a wrapper class <mark>.ppt-forms </mark>",
				"docs" 		=> "",
			),
			
			"c_responsive" => array(		
	 				
				"n" => __("Responisve","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "",
			), 
			
			
			"c_padding" => array(		
	 				
				"n" => __("Margins &amp; Padding","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "",
			), 
			
			"e_shadow" => array(					
				"n" 		=> __("Shadows","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",				 
			),
			
			
			"e_backgrounds" => array(					
				"n" 		=> __("Backgrounds","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",				 
			),
			
			
			
			"e_borders" => array(					
				"n" 		=> __("Borders","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
		),
	),
  
 
	"3" => array(
		
		"n" => __("Components","premiumpress"), "i" => "code", "p" => array( 
		
		
		
			"c_pop" => array(					
				"n" 		=> __("Animated Content","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
		
		
		
		"c_navigation" => array(					
				"n" 		=> __("Navigation","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
		
		
			"c_stats" => array(				
				"n" 		=> __("Stats","premiumpress"),				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "", 
			),
			
		
			"c_alerts" => array(				
				"n" 		=> __("Alerts","premiumpress"),				
				"i" 		=> "", 
				"desc"		=> "Provide contextual feedback messages for typical user actions.",
				"docs" 		=> "", 
			),
			
			 
			"c_modals" => array(				
				"n" 		=> __("Modals &amp; Popups","premiumpress"),				
				"i" 		=> "", 
				"desc"		=> "Provide contextual feedback messages for typical user actions.",
				"docs" 		=> "", 
			),
			
		
			"c_accodian" => array(					
				"n" 		=> __("Accordian","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "Vertically stacked list using jQuery to show/hide. <mark>.ppt-show-hide</mark>",
				"docs" 		=> "",				 
			),
			
			"c_buttons" => array(	
				
				"n" 		=> __("Buttons","premiumpress"), 
				"i" 		=> "", 
				"desc"		=> "PremiumPress use the html markup <mark>data-ppt-btn</mark> to style buttons.",
				"docs" 		=> "",				 
			),
			
			
			"e_badges" => array(					
				"n" 		=> __("Badges","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_dropdowns" => array(					
				"n" 		=> __("Dropdown Menu","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"c_breadcrumbs" => array(					
				"n" 		=> __("Breadcrumbs","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_avatars" => array(					
				"n" 		=> __("Avatars","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_ratings" => array(					
				"n" 		=> __("Ratings","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_social" => array(					
				"n" 		=> __("Social","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"c_cards" => array(					
				"n" 		=> __("Cards","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			 
			
			"c_online" => array(					
				"n" 		=> __("Online Indicators","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_images" => array(					
				"n" 		=> __("Images & figures","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"c_numbers" => array(					
				"n" 		=> __("Numbers &amp; Counters","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"c_tooltip" => array(					
				"n" 		=> __("Tooltips","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
				"widgets" => array(	 				
				"n" => __("Widgets","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "Widgets are pre-styled blocks used throughout the theme.",				
				"docs" 		=> "",				
				"l" => "",
			),
			 
		
		),
		
	),


	
	"single" => array(
		
		"n" => __("Single Design","premiumpress"), "i" => "cashout", "p" => array( 
		
			
		 	"s_buts" => array(					
				"n" 		=> __("Single Buttons","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_blocks" => array(					
				"n" 		=> __("Single Blocks","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_title" => array(					
				"n" 		=> __("Single Title","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_subtitle" => array(					
				"n" 		=> __("Single Subtitle","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),

			"s_gallery" => array(					
				"n" 		=> __("Single Gallery","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			"s_author" => array(					
				"n" 		=> __("Single Author","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
		 	"s_desc" => array(					
				"n" 		=> __("Single Description","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"s_faq" => array(					
				"n" 		=> __("Single FAQ","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
		"s_services" => array(					
				"n" 		=> __("Single Services","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			"s_features" => array(					
				"n" 		=> __("Single Features","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_files" => array(					
				"n" 		=> __("Single User Atttachments","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"s_customfields" => array(					
				"n" 		=> __("Single Custom Fields","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_contact" => array(					
				"n" 		=> __("Single Contact Form","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"s_hours" => array(					
				"n" 		=> __("Single Hours","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			
			"s_rates" => array(					
				"n" 		=> __("Single Rates","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),			
		 	
			"s_features" => array(					
				"n" 		=> __("Single Features","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_map" => array(					
				"n" 		=> __("Single Map","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_reviews" => array(					
				"n" 		=> __("Single Reviews","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),

			"s_reviews" => array(					
				"n" 		=> __("Single Reviews","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),		
			
			 "s_gifts" => array(					
				"n" 		=> __("Single Gifts","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),	
			
			 "s_social" => array(					
				"n" 		=> __("Single Social","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),		
			
			 "s_sidebar" => array(					
				"n" 		=> __("Single Sidebar","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),	
					 				
			
		), 
			
	),

	
	"system" => array(
		
		"n" => __("System","premiumpress"), "i" => "database", "p" => array( 
		  	
			
			
			
	"s_button_favs" => array(	 				
				"n" => __("Special Buttons","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "s_button_favs",				
			), 
			
			
			"s_database" => array(	 				
				"n" => __("Database","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> " ",				
				"docs" 		=> "",				
				"l" => "s_database",				
			),
			
			"s_ratingdata" => array(					
				"n" 		=> __("User Rating Data","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_listingdata" => array(					
				"n" 		=> __("Ad Rating Data","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_carddata" => array(					
				"n" 		=> __("Card Data","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_buttondata" => array(					
				"n" 		=> __("Button Data","premiumpress"), 				
				"i" 		=> "", 
				"desc"		=> "",
				"docs" 		=> "",
			),
			
			"s_orders" => array(	 				
				"n" => __("Orders","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "s_orders",				
			),
			
			
			"s_debug" => array(	 				
				"n" => __("Debug","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "s_debug",				
			), 
			
			"c_invoice" => array(	 				
				"n" => __("Invoice","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "c_invoice",				
			), 
			
			"s_demo" => array(	 				
				"n" => __("Demo Text","premiumpress"),				
				"i" 		=> "", 				
				"desc"		=> "",				
				"docs" 		=> "",				
				"l" => "s_demo",				
			),
			
		), 
			
	),
	 
 
	"languages" => array(	 				
		"n" => __("RTL &amp; Languages","premiumpress"),				
		"i" 		=> "language", 				
		"desc"		=> "PremiumPress themes use 3 main colors. <mark>.bg-primary</mark>, <mark>.bg-secondary</mark>, <mark>.bg-soft</mark> ",				
		"docs" 		=> "",				
		"l" => "p_languages",
	),
	
);
 

 
?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" >
<!--[if lte IE 8 ]><html lang="en" class="ie ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie"><![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

<?php wp_head();  ?> 

 
     
<script>
 

function _docsToggleHTML(val){
 
	var toggleFieldWrap = jQuery('.sectionid-'+val+' .toggle-me');
	if(toggleFieldWrap.hasClass('on')){
		toggleFieldWrap.removeClass('on').addClass('off');
	}else{
		toggleFieldWrap.removeClass('off').addClass('on');
	}
	
	jQuery(".sectionid-"+val+" .code-wrapper-display").toggle();
	jQuery(".sectionid-"+val+" .code-wrapper").toggle();
 
}



function _docsLoadPage(pageid){

	jQuery("[data-title]").html(jQuery("[data-navid-"+pageid+"]").html());
	 
	var d = jQuery("[data-navid-"+pageid+"]"); 
	var blockid = jQuery(d).attr("data-blockid");
	 
 
	if(blockid != "" || pageid == "text"){
	pageid = "block"; 
	}
	
    jQuery.ajax({
        type: "POST",
        url: ajax_site_url,	 
   		data: {
               doc_action: "load_page", 
			   page: pageid,	
			   blockid: blockid,	 
           },
           success: function(response) {
			   
			jQuery("#ppt-doc-page-output").html(response); 
			
			
			if(pageid == "block"){
			
			jQuery(".ppt-docs-title").show();
			jQuery(".ppt-docs-title h1").html(jQuery(d).attr("data-title"));
 			jQuery(".ppt-docs-title .lead").html("");
			
			}else{
			
			jQuery(".ppt-docs-title").show();
			jQuery(".ppt-docs-title h1").html(jQuery(d).html());
			jQuery(".ppt-docs-title .lead").html(jQuery(d).attr("data-desc"));			
			}
			
			
			  
			// make jump nav
			var i = 1;
			jQuery(".ppt-docs-jumpnav > div").html('');
			var a = jQuery("#ppt-doc-page-output section");
			a.each(function (a) {
				jQuery(this).attr("id","section-"+i);
				
				if (typeof jQuery(this).attr("data-nav-title") !== 'undefined') {
				
				jQuery(".ppt-docs-jumpnav > div").append("<a href='#section-"+ i +"' class='custom-scroll-link'>"+ jQuery(this).attr("data-nav-title") +"<a>");
				
				}
				i++;
			
			});	
			 
			 Prism.highlightAll();
			 
			 // trigger update
			jQuery(".ppt-js-trigger-ajax").trigger('click');
			
			
			 // QUICK FIX FOR LAZY IMAGES
			 jQuery("img").each(function() { 
				   
				   var imgsrc = jQuery(this).attr('data-src');				   
				   if(imgsrc != ""){		   
				   jQuery(this).attr('src', imgsrc);
				   }			   
			 });  
			
			   
		   }	
	
	});
	
	
					


}


</script>


 

</head>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

?>
<body>

<div id="ppt-account-wrapper">
 
        <div class="nav-header">
            <a href="<?php echo home_url(); ?>/?reset=1" target="_blank" class="brand-logo">
            
            	<img src="https://premiumpressweb.b-cdn.net/premiumpress-logo-white.svg">
               
                <div class="main w-100">PremiumPress</div>
                
                <div class="icon w-100"></div>
                
            </a> 

            <div class="nav-control">
                <div class="menubars">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div> 
        
 
        <div class="header">
            <div class="header-content">
                <nav>
                    <div class="d-flex justify-content-between">
                    
                        <div class="header-left">
                            <div class="dashboard_bar" > <span data-title> Dashboard </span>  </div>
                        </div>
                        
                       
                        <ul class="navbar-nav header-right">
                     
                        <li class="nav-item" style="display:none;">
                        <div class="input-group search-area d-lg-inline-flex d-none">
									<input type="text" class="form-control" placeholder="Search here...">
									<div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)"><i class="fal fa-search"></i></a></span>
									</div>
								</div>
                        </li>
                       
                   
                       
                        
                        </ul>
                        
                    </div>
                </nav>
            </div>
        </div>
        
<!-- // -->
        <div class="ppt-account-nav">
            <div class="ppt-account-nav-scroll">
				<ul class="metismenu" id="menu">
                
               <?php foreach($navigation as $k => $i){  ?>
               
               
                <li><a class="<?php if(isset($i['l']) && $i['l'] != "" ){ }else{ ?>has-arrow ai-icon<?php } ?>" <?php if(isset($i['l']) && $i['l'] != "" ){ ?>
                
				
				href="#" onClick="_docsLoadPage('<?php echo $i['l']; ?>');" 
                            data-navid-<?php echo $i['l']; ?> 
                            data-docs="<?php if(isset($i['docs'])){ echo $i['docs']; } ?>"
                            data-desc="<?php if(isset($i['desc'])){ echo $i['desc']; } ?>"
                            data-blockid="<?php if(isset($i['blockid'])){ echo $i['blockid']; } ?>"
				
				
				<?php }else{ ?>href="javascript:void(0);" aria-expanded="false"<?php } ?>>
							<?php if(strlen($i['i']) > 1 && isset($CORE_UI->icons_svg[$i['i']]) ){ ?><span ppt-icon-24><?php echo $CORE_UI->icons_svg[$i['i']]; ?></span><?php } ?> <span class="nav-text"><?php echo $i['n']; ?></span>
						</a>
                        
                        <?php if(isset($i['p']) && is_array($i['p']) ){ ?>
                        <ul aria-expanded="false">                        
                        <?php foreach($i['p'] as $pk => $pi){ ?>                        
							<li>
                            
                            <a href="#" onClick="_docsLoadPage('<?php echo $pk; ?>');" 
                            data-navid-<?php echo $pk; ?> 
                            data-docs="<?php if(isset($pi['docs'])){ echo $pi['docs']; } ?>"
                            data-desc="<?php if(isset($pi['desc'])){ echo $pi['desc']; } ?>"
                            data-blockid="<?php if(isset($pi['blockid'])){ echo $pi['blockid']; } ?>"
                            >
							<?php echo $pi['n']; ?>
                            </a>
                            
                            
                            </li>
						<?php } ?>                        
						</ul>
                        <?php } ?>
                    </li>
               
               
               <?php } ?>
                 
                    
                </ul>
                <div class="copyright">
                
                 
                
					<p><span>Version <?php echo THEME_VERSION; ?></span></p>
                    <div class="small"><?php echo THEME_VERSION_DATE; ?></div>
				</div>
				 
			</div>
        </div> 
 
        <div class="content-body"> 
			<div class="container-fluid"> 
            
 
<aside class="ppt-docs-jumpnav">
    <h6>Jump to</h6>
    <div></div>
</aside>


<div class="ppt-docs-title mb-5" style="display:none">
<h1></h1>
<p></p>
</div>


 

<div id="ppt-doc-page-output"></div>

<div class="ppt-js-trigger-ajax"></div>
 