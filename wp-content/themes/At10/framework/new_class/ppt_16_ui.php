<?php

class premiumpress_ui {
 
		public $tags = array(
			
			"data-ppt-element", "data-ppt-blocktype" 
		);
		
		public $elements = array(
			
			"shadow" => array("ppt-shadow","ppt-shadow-lg"),
 			
		);
 
		
		public $scripts = array(
				 
				
				"premiumpress-js"	=> array( 
					"path" => 'js/js.custom.js', 
					"admin" => 0,
					"rtl"		=> array("0","1"),
				),
				
				// UPLOAD 
				"premiumpress-up-js"	=> array( 
					"path" 		=> "js/js.up.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account","flag-add"),
				),
				"premiumpress-submit-js"	=> array( 
					"path" 		=> "js/js.search.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-add"),
				),
				
				// ZCLIP / COPY BUTTON
				"premiumpress-zclip-js"	=> array( 
					"path" 		=> "js/js.zclip.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account","flag-single","flag-theme-cp"),
				),	
				
				// CHARTS
				"premiumpress-charts-js"	=> array( 
					"path" 		=> "js/js.chart2.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account"),
				),
				
				// MOBILE
				"premiumpress-search"	=> array( 
					"path" 		=> "js/js.search.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-search"),
				),
				
				// ZCLIP / COPY BUTTON
				"premiumpress-zclip-js"	=> array( 
					"path" 		=> "js/js.zclip.js", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account","flag-single","flag-theme-cp"),
				),	
				
				
					  	
		);	
		
		public $styles = array(
				
				
				"boostrap-css"	=> array( 
					"path" 		=> "css/_bootstrap.css",  //"css/css.theme-grid.css",//
					"admin" 	=> 0,
					"rtl"		=> array("0"),
				),
				
				 
				"boostrap-css-rtl"	=> array( 
					"path" 		=> "css/_bootstrap-rtl.css", 
					"admin" 	=> 0,
					"rtl"		=> array("1"),
				),
				 
				"theme-grid"	=> array( 
					"path" 		=> "css/css.theme-grid.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					//"globals"	=> array("flag-docs"),
					"testing" 	=> 1,
				),
				
				"theme-grid-rtl"	=> array( 
					"path" 		=> "css/css.theme-grid-rtl.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					//"globals"	=> array("flag-docs"),
					"testing" 	=> 1,
				),
				
				
				"theme-fonts"	=> array( 
					"path" 		=> "css/css.theme-fonts.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
				),
				
				"theme-elementor"	=> array( 
					"path" 		=> "css/css.theme-elementor.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
				),
				 
				/*
				"theme-gallery"	=> array( 
					"path" 		=> "css/css.theme-gallery.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-single"),
				),
				*/
				
				"theme-maps"	=> array( 
					"path" 		=> "css/css.theme-maps.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					//"globals"	=> array("flag-single"),
				),
				
				
				"theme-utilities"	=> array( 
					"path" 		=> "css/css.theme-utilities.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
				),
				 
			
				"premiumpress-css"	=> array( 
					"path" 		=> "css/css.premiumpress.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
				),
			 
				
				
				
				// ACCOUNT PAGE
				"premiumpress-account"	=> array( 
					"path" 		=> "css/_account.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account"),
				),
				
				
				// CHAT
				"premiumpress-chat"	=> array( 
					"path" 		=> "css/_chat.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"), 
				),
				
				// UPLOAD 
				"premiumpress-up"	=> array( 
					"path" 		=> "css/_up.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-account","flag-add"),
				),
				
				"premiumpress-submit"	=> array( 
					"path" 		=> "css/_submitform.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("flag-add"),
				),
				
				// MOBILE
				"premiumpress-mobileprefix"	=> array( 
					"path" 		=> "css/_mobileprefix.css", 
					"admin"		=> 0,
					"rtl"		=> array("0","1"),
					"globals"	=> array("adminarea","flag-account","flag-add","flag-register"),
				),
				 
				
				// ADMIN AREA				
				"premiumpress-admin-css" => array( 
					"path" 		=>  'admin/css/premiumpress.css', 
					"admin" 	=> 1,
					"globals"	=> array("adminarea"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-admin-globals-css" => array( 
					"path" 		=>  'admin/css/wpglobal.css', 
					"admin" 	=> 1,
					"globals"	=> array("adminarea"),
					"rtl"		=> array("0","1"),
				),
				
				
				"premiumpress-docs"	=> array( 
					"path" 		=>  'css/css.docs.css', 
					"admin" 	=> 1,
					"globals"	=> array("flag-docs"),
					"rtl"		=> array("0","1"),
				),
				
				// THEME BASED
				"premiumpress-theme-cp"	=> array( 
					"path" 		=>  'css/_theme_cp.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-cp"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-theme-es"	=> array( 
					"path" 		=>  'css/_theme_es.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-es"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-theme-da"	=> array( 
					"path" 		=>  'css/_theme_da.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-da"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-theme-vt"	=> array( 
					"path" 		=>  'css/_theme_vt.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-vt"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-theme-mj"	=> array( 
					"path" 		=>  'css/_theme_mj.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-mj"),
					"rtl"		=> array("0","1"),
				),
				
				"premiumpress-cart"	=> array( 
					"path" 		=>  'css/_cart.css', 
					"admin" 	=> 0,
					"globals"	=> array("theme-sp","theme-so"),
					"rtl"		=> array("0","1"),
				),
				
					  	
		);		 

		public $images = array(
						0	=> DEMO_IMG_PATH."_bg/640x640.jpg",//
						1 	=> DEMO_IMG_PATH."_bg/640x1136.jpg",
						2 	=> DEMO_IMG_PATH."_bg/800x600.jpg",
					 	3 	=> DEMO_IMG_PATH."/blocks/image_block/city1.jpg",
						4 	=> DEMO_IMG_PATH."/blocks/image_block/city2.jpg",
						
						
		);	
		public $user_images = array(
						0	=> DEMO_IMG_PATH."/rt/agent1.jpg",
						1 	=> DEMO_IMG_PATH."/rt/agent2.jpg",
						2 	=> DEMO_IMG_PATH."/rt/agent3.jpg",
						3 	=> DEMO_IMG_PATH."/rt/agent4.jpg",
						4 	=> DEMO_IMG_PATH."/rt/agent5.jpg",
						5 	=> DEMO_IMG_PATH."/rt/agent6.jpg",
						6 	=> DEMO_IMG_PATH."/rt/agent7.jpg",
						7 	=> DEMO_IMG_PATH."/rt/agent8.jpg", 
		);
		
		public $user_socials = array(
						"facebook"	=> array(
							"icon" => "fab fa-facebook",
							"share" => 1,
						),
						"twitter"	=> array(
							"icon" => "fab fa-twitter",
							"share" => 1,
						), 
						"instagram"	=> array(
							"icon" => "fab fa-instagram",
						), 
						"pinterest"	=> array(
							"icon" => "fab fa-pinterest",
							"share" => 1,
						), 
						"linkedin"	=> array(
							"icon" => "fab fa-linkedin",
							"share" => 1,
						), 
						"youtube"	=> array(
							"icon" => "fab fa-youtube",
						), 	
						"vimeo"	=> array(
							"icon" => "fab fa-vimeo",
						), 										
		);
		

public $icons_emoji = array(
 

"1" => "&#x1F600;",
"2" => "&#x1F604;",
"3" => "&#x1F60A;",
"4" => "&#x1F60B;",
"5" => "&#x1F60E;",
"6" => "&#x1F642;"

);

public $borders = array(

"curve_top" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 70"><path fill="currentColor" d="M1440,70H0V45.16a5762.49,5762.49,0,0,1,1440,0Z"/></svg>',

"curve_bottom" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="currentColor" d="M0,0V60H1440V0A5771,5771,0,0,1,0,0Z"></path></svg>',

);
		
public $icons_svg = array(

"dashboard" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" /></svg>',


"toggle_on" => '<svg aria-hidden="true" data-icon="toggle-on" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-on">
        <path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zm0 320c-70.8 0-128-57.3-128-128 0-70.8 57.3-128 128-128 70.8 0 128 57.3 128 128 0 70.8-57.3 128-128 128z" class="text-success"></path>
        </svg>',
		
"toggle_off" => '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-off">
        <g class="fa-group"><path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zM192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class=""></path>
        <path fill="currentColor" d="M192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class="text-light"></path></g>
        </svg>',

"store" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>',

"advertising" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>',

"cog" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
	
"chevron-right" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>',
		
"code" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>',

"clipboard" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>',
 
 
"fill" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.63 217.06L294.94 9.37A31.94 31.94 0 0 0 272.31 0c-8.19 0-16.38 3.12-22.62 9.37L162.5 96.56 70.62 4.69c-6.25-6.25-16.38-6.25-22.63 0L36.69 16c-6.25 6.25-6.25 16.38 0 22.63l91.88 91.88L28.11 230.95c-37.49 37.48-37.49 98.26 0 135.75L145.3 483.89c18.74 18.74 43.31 28.12 67.87 28.12 24.57 0 49.13-9.37 67.87-28.12l221.57-221.57c12.51-12.51 12.51-32.76.02-45.26zM247.11 449.95C238.05 459.01 226 464 213.18 464s-24.87-4.99-33.93-14.05L65.3 336h295.75L247.11 449.95zM409.06 288H49.34c2-8.67 6.27-16.67 12.71-23.11L162.5 164.44l69.9 69.9c9.37 9.37 24.56 9.37 33.94 0 9.37-9.37 9.37-24.57 0-33.94l-69.9-69.9 75.87-75.87 185.06 185.06L409.06 288z"/></svg>',

"blocks" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>',

"photo" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>', 
 
"clock" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"file-text" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',

"file-code" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M369.941 97.941l-83.882-83.882A48 48 0 0 0 252.118 0H48C21.49 0 0 21.49 0 48v416c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V131.882a48 48 0 0 0-14.059-33.941zm-22.627 22.628a15.89 15.89 0 0 1 4.195 7.431H256V32.491a15.88 15.88 0 0 1 7.431 4.195l83.883 83.883zM336 480H48c-8.837 0-16-7.163-16-16V48c0-8.837 7.163-16 16-16h176v104c0 13.255 10.745 24 24 24h104v304c0 8.837-7.163 16-16 16zm-161.471-67.404l-25.928-7.527a5.1 5.1 0 0 1-3.476-6.32l58.027-199.869a5.1 5.1 0 0 1 6.32-3.476l25.927 7.527a5.1 5.1 0 0 1 3.476 6.32L180.849 409.12a5.1 5.1 0 0 1-6.32 3.476zm-48.446-47.674l18.492-19.724a5.101 5.101 0 0 0-.351-7.317L105.725 304l38.498-33.881a5.1 5.1 0 0 0 .351-7.317l-18.492-19.724a5.1 5.1 0 0 0-7.209-.233L57.61 300.279a5.1 5.1 0 0 0 0 7.441l61.263 57.434a5.1 5.1 0 0 0 7.21-.232zm139.043.232l61.262-57.434a5.1 5.1 0 0 0 0-7.441l-61.262-57.434a5.1 5.1 0 0 0-7.209.233l-18.492 19.724a5.101 5.101 0 0 0 .351 7.317L278.275 304l-38.499 33.881a5.1 5.1 0 0 0-.351 7.317l18.492 19.724a5.1 5.1 0 0 0 7.209.232z"/></svg>',

"folder" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>',

"folder_tree" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M544 32H432L400 0h-80a32 32 0 0 0-32 32v160a32 32 0 0 0 32 32h224a32 32 0 0 0 32-32V64a32 32 0 0 0-32-32zm0 288H432l-32-32h-80a32 32 0 0 0-32 32v160a32 32 0 0 0 32 32h224a32 32 0 0 0 32-32V352a32 32 0 0 0-32-32zM64 16A16 16 0 0 0 48 0H16A16 16 0 0 0 0 16v400a32 32 0 0 0 32 32h224v-64H64V160h192V96H64z"/></svg>',

"folder_open" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
</svg>',

"folder_add" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>',

"star" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>',

"star_off" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
</svg>',

"filters" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>',

"sliders" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 416C0 398.3 14.33 384 32 384H86.66C99 355.7 127.2 336 160 336C192.8 336 220.1 355.7 233.3 384H480C497.7 384 512 398.3 512 416C512 433.7 497.7 448 480 448H233.3C220.1 476.3 192.8 496 160 496C127.2 496 99 476.3 86.66 448H32C14.33 448 0 433.7 0 416V416zM192 416C192 398.3 177.7 384 160 384C142.3 384 128 398.3 128 416C128 433.7 142.3 448 160 448C177.7 448 192 433.7 192 416zM352 176C384.8 176 412.1 195.7 425.3 224H480C497.7 224 512 238.3 512 256C512 273.7 497.7 288 480 288H425.3C412.1 316.3 384.8 336 352 336C319.2 336 291 316.3 278.7 288H32C14.33 288 0 273.7 0 256C0 238.3 14.33 224 32 224H278.7C291 195.7 319.2 176 352 176zM384 256C384 238.3 369.7 224 352 224C334.3 224 320 238.3 320 256C320 273.7 334.3 288 352 288C369.7 288 384 273.7 384 256zM480 64C497.7 64 512 78.33 512 96C512 113.7 497.7 128 480 128H265.3C252.1 156.3 224.8 176 192 176C159.2 176 131 156.3 118.7 128H32C14.33 128 0 113.7 0 96C0 78.33 14.33 64 32 64H118.7C131 35.75 159.2 16 192 16C224.8 16 252.1 35.75 265.3 64H480zM160 96C160 113.7 174.3 128 192 128C209.7 128 224 113.7 224 96C224 78.33 209.7 64 192 64C174.3 64 160 78.33 160 96z"/></svg>',

"desktop" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',

"chat" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>',

"chat1" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>',

"chat2" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>',

"bell" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>',

"text-left" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>',

"database" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>',

"wordpress" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke="currentColor"><path d="M256 8C119.3 8 8 119.2 8 256c0 136.7 111.3 248 248 248s248-111.3 248-248C504 119.2 392.7 8 256 8zM33 256c0-32.3 6.9-63 19.3-90.7l106.4 291.4C84.3 420.5 33 344.2 33 256zm223 223c-21.9 0-43-3.2-63-9.1l66.9-194.4 68.5 187.8c.5 1.1 1 2.1 1.6 3.1-23.1 8.1-48 12.6-74 12.6zm30.7-327.5c13.4-.7 25.5-2.1 25.5-2.1 12-1.4 10.6-19.1-1.4-18.4 0 0-36.1 2.8-59.4 2.8-21.9 0-58.7-2.8-58.7-2.8-12-.7-13.4 17.7-1.4 18.4 0 0 11.4 1.4 23.4 2.1l34.7 95.2L200.6 393l-81.2-241.5c13.4-.7 25.5-2.1 25.5-2.1 12-1.4 10.6-19.1-1.4-18.4 0 0-36.1 2.8-59.4 2.8-4.2 0-9.1-.1-14.4-.3C109.6 73 178.1 33 256 33c58 0 110.9 22.2 150.6 58.5-1-.1-1.9-.2-2.9-.2-21.9 0-37.4 19.1-37.4 39.6 0 18.4 10.6 33.9 21.9 52.3 8.5 14.8 18.4 33.9 18.4 61.5 0 19.1-7.3 41.2-17 72.1l-22.2 74.3-80.7-239.6zm81.4 297.2l68.1-196.9c12.7-31.8 17-57.2 17-79.9 0-8.2-.5-15.8-1.5-22.9 17.4 31.8 27.3 68.2 27.3 107 0 82.3-44.6 154.1-110.9 192.7z"/></svg>',

"chart" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>',

"chart-bar" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',

"light-bulb" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>',

"check_circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
"check" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',

"check-circle-full" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>',

"facebook" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke="currentColor"><path stroke="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>',
"link" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>',

"downloads" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',


"language" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" /></svg>',


"arrow-long-right" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>',

"user" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>',

"user-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"user-card" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>',

"briefcase" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',


"phone" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>',

"map-marker" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',

"logout" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>',

"search" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>',

"rss" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>',

"tag" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>',

"add-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"add" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>',

"menu" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>',

"home" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>',

"shopping-bag" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>',

"chat" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>',

"support" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>',

"question" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"smile" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"users" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',

"close" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',

"close-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"cart" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',


"grab" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>',

"pencil" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>',

"heart" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',


"envelope" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',

"cash" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',

"cashout" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" /></svg>',

"colors" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>',


"popup" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" /></svg>',


"comments" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>',


"eye-off" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>',

"credit-card" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>',

"cashback" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>',


"gift" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>',

"trash" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>',

"invoice" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" /></svg>',

"clipboard-check" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>',

'offers' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" /></svg>',

"chevron-down" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>',

"lock" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>',


"info-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"heart-full" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>',

"flag" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" /></svg>',

"faq" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',


"bed" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor"><path fill="currentColor" d="M168 304c48.52 0 88-39.48 88-88s-39.48-88-88-88-88 39.48-88 88 39.48 88 88 88zm0-128c22.06 0 40 17.94 40 40s-17.94 40-40 40-40-17.94-40-40 17.94-40 40-40zm360-48H304c-8.84 0-16 7.16-16 16v192H48V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v352c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16v-48h544v48c0 8.84 7.16 16 16 16h16c8.84 0 16-7.16 16-16V240c0-61.86-50.14-112-112-112zm64 208H336V176h192c35.29 0 64 28.71 64 64v96z"/></svg>',

"bath" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke="currentColor"><path fill="currentColor" d="M496,256H80V69.25a21.26,21.26,0,0,1,36.28-15l12,12a74,74,0,0,0,15.18,88A15.9,15.9,0,0,0,144,176l11.31,11.31a16,16,0,0,0,22.63,0L283.31,81.94a16,16,0,0,0,0-22.63L272,48a15.89,15.89,0,0,0-21.78-.56,74,74,0,0,0-88-15.18l-12-12A69.25,69.25,0,0,0,32,69.25V256H16A16,16,0,0,0,0,272v16a16,16,0,0,0,16,16H32v80a95.4,95.4,0,0,0,32,71.09V496a16,16,0,0,0,16,16H96a16,16,0,0,0,16-16V478.39A95.87,95.87,0,0,0,128,480H384a95.87,95.87,0,0,0,16-1.61V496a16,16,0,0,0,16,16h16a16,16,0,0,0,16-16V455.09A95.4,95.4,0,0,0,480,384V304h16a16,16,0,0,0,16-16V272A16,16,0,0,0,496,256ZM178,120.51c-5.93-5-10-12.1-10-20.51a28,28,0,0,1,28-28c8.46,0,15.58,4.08,20.58,10.07C205.07,93.75,192.62,106.2,178,120.51ZM432,384a48.05,48.05,0,0,1-48,48H128a48.05,48.05,0,0,1-48-48V304H432Z"/></svg>',


"cursor-click" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" /></svg>',


"cartype" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor"><path fill="currentColor" d="M336 344.48a23.93 23.93 0 1 0 24 23.93 24 24 0 0 0-24-23.93zm163.32-68.16a32.06 32.06 0 0 0-29.52-19.59h-75.6a32 32 0 0 0-29.41 19.34l-19.59 44.47h173.6zM528 344.48a23.93 23.93 0 1 0 24 23.93 24 24 0 0 0-24-23.93zm58.77-67.21l-14-32.63A111.88 111.88 0 0 0 469.8 177h-75.6a111.88 111.88 0 0 0-102.94 67.69l-14 32.63A79.93 79.93 0 0 0 224 352.45v31.91c0 26 12.72 48.9 32.07 63.47 0 .13-.07.23-.07.35v31.91A32 32 0 0 0 288 512h16a32 32 0 0 0 32-31.91v-15.95h192v15.95A32 32 0 0 0 560 512h16a32 32 0 0 0 32-31.91v-31.91c0-.12-.07-.22-.07-.35 19.35-14.57 32.07-37.48 32.07-63.47v-31.91a79.93 79.93 0 0 0-53.23-75.18zM592 384.36a32 32 0 0 1-32 31.91H304a32 32 0 0 1-32-31.91v-31.91a32 32 0 0 1 32-31.91h6.86l24.52-57a64 64 0 0 1 58.82-38.68h75.6a64 64 0 0 1 58.82 38.68l24.52 57H560a32 32 0 0 1 32 31.91zM176 97.18H96a16 16 0 0 0-16 15.95v111.69a16 16 0 0 0 16 16h80zM48 328.52V99.15c0-28.72 63.77-51.29 144-51.29s144 22.57 144 51.29v58.33a144.12 144.12 0 0 1 48-11.69V99.15C384 26 280.57 0 192 0S0 26 0 99.15v229.37a56 56 0 0 0 56 55.84h8v31.91a32 32 0 0 0 32 31.91h16a32 32 0 0 0 32-31.91v-31.91h48v-31.91a110.91 110.91 0 0 1 1.18-15.95H56a8 8 0 0 1-8-7.98zm32-39.89a24 24 0 1 0 24-23.93 24 24 0 0 0-24 23.93zm181.84-56.56a143.19 143.19 0 0 1 42.16-55v-64a16 16 0 0 0-16-15.95h-80v143.65h50.11z"/></svg>',

"hand" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" /></svg>',

"image" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',


"attachment" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>',


"video" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>',

"video-full" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" /></svg>',

"hash" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" /></svg>',

"grid" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>',


"list" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>',

"plus-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"plus-sm" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>',

"paypal" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"><path stroke="currentColor" d="M186.3 258.2c0 12.2-9.7 21.5-22 21.5-9.2 0-16-5.2-16-15 0-12.2 9.5-22 21.7-22 9.3 0 16.3 5.7 16.3 15.5zM80.5 209.7h-4.7c-1.5 0-3 1-3.2 2.7l-4.3 26.7 8.2-.3c11 0 19.5-1.5 21.5-14.2 2.3-13.4-6.2-14.9-17.5-14.9zm284 0H360c-1.8 0-3 1-3.2 2.7l-4.2 26.7 8-.3c13 0 22-3 22-18-.1-10.6-9.6-11.1-18.1-11.1zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM128.3 215.4c0-21-16.2-28-34.7-28h-40c-2.5 0-5 2-5.2 4.7L32 294.2c-.3 2 1.2 4 3.2 4h19c2.7 0 5.2-2.9 5.5-5.7l4.5-26.6c1-7.2 13.2-4.7 18-4.7 28.6 0 46.1-17 46.1-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.2 8.2-5.8-8.5-14.2-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9 0 20.2-4.9 26.5-11.9-.5 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H200c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm40.5 97.9l63.7-92.6c.5-.5.5-1 .5-1.7 0-1.7-1.5-3.5-3.2-3.5h-19.2c-1.7 0-3.5 1-4.5 2.5l-26.5 39-11-37.5c-.8-2.2-3-4-5.5-4h-18.7c-1.7 0-3.2 1.8-3.2 3.5 0 1.2 19.5 56.8 21.2 62.1-2.7 3.8-20.5 28.6-20.5 31.6 0 1.8 1.5 3.2 3.2 3.2h19.2c1.8-.1 3.5-1.1 4.5-2.6zm159.3-106.7c0-21-16.2-28-34.7-28h-39.7c-2.7 0-5.2 2-5.5 4.7l-16.2 102c-.2 2 1.3 4 3.2 4h20.5c2 0 3.5-1.5 4-3.2l4.5-29c1-7.2 13.2-4.7 18-4.7 28.4 0 45.9-17 45.9-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.3 8.2-5.5-8.5-14-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9.3 0 20.5-4.9 26.5-11.9-.3 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H484c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm47.5-33.3c0-2-1.5-3.5-3.2-3.5h-18.5c-1.5 0-3 1.2-3.2 2.7l-16.2 104-.3.5c0 1.8 1.5 3.5 3.5 3.5h16.5c2.5 0 5-2.9 5.2-5.7L544 191.2v-.3zm-90 51.8c-12.2 0-21.7 9.7-21.7 22 0 9.7 7 15 16.2 15 12 0 21.7-9.2 21.7-21.5.1-9.8-6.9-15.5-16.2-15.5z"/></svg>',

"tax" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" /></svg>',

"templates" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>',

"email" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',


"user-add" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>',

"user-remove" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" /></svg>',

"block" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>',


"check-circle" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',

"bag" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>',


"calendar" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',

"verified" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>',

"not-verified" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" /></svg>',


"view-list" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>',

"qr" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>',

"newsletter" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',

"chart-bars" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',


"pages" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>',


"thumb-down" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" /></svg>',

"thumb-down-full" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" /></svg>',
 
  
"thumb-up" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>',

"thumb-up-full" => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
</svg>',
  

);
		
public $icons = array(

"accessibility" => array(


"american-sign-language-interpreting"  ,"assistive-listening-systems"  ,"audio-description"  ,"blind"  ,"braille"  ,"closed-captioning"  ,"deaf"  ,"dog-leashed"  ,"low-vision"  ,"phone-volume"  ,"question-circle"  ,"sign-language"  ,"tty"  ,"universal-access"  ,"wheelchair"

),

"alerts" => array(
    "alarm-clock","alarm-exclamation","bell","bell-exclamation","bell-on","bell-school-slash","bell-slash","bells","calendar-exclamation","comment-alt-exclamation","comment-exclamation","engine-warning","exclamation","exclamation-circle","exclamation-square","exclamation-triangle","file-exclamation","lightbulb-exclamation","map-marker-exclamation","radiation","radiation-alt","sensor","sensor-alert","sensor-fire","sensor-on","sensor-smoke","skull-crossbones","star-exclamation","wind-warning",
),

"animals" => array(

"alicorn","badger-honey","bat","cat","cat-space","cow","crow","deer","deer-rudolph","dog","dog-leashed","dove","dragon","duck","elephant","feather","feather-alt","fish","frog","hippo","horse","horse-head","horse-saddle","kiwi-bird","monkey","narwhal","otter","paw","paw-alt","paw-claws","pegasus","pig","rabbit","rabbit-fast","ram","sheep","skull-cow","snake","spider","spider-black-widow","squirrel","turtle","unicorn","whale"

),

"arrows" => array(

"angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","arrow-alt-circle-down","arrow-alt-circle-left","arrow-alt-circle-right","arrow-alt-circle-up","arrow-alt-down","arrow-alt-from-bottom","arrow-alt-from-left","arrow-alt-from-right","arrow-alt-from-top","arrow-alt-left","arrow-alt-right","arrow-alt-square-down","arrow-alt-square-left","arrow-alt-square-right","arrow-alt-square-up","arrow-alt-to-bottom","arrow-alt-to-left","arrow-alt-to-right","arrow-alt-to-top","arrow-alt-up","arrow-circle-down","arrow-circle-left","arrow-circle-right","arrow-circle-up","arrow-down","arrow-from-bottom","arrow-from-left","arrow-from-right","arrow-from-top","arrow-left","arrow-right","arrow-square-down","arrow-square-left","arrow-square-right","arrow-square-up","arrow-to-bottom","arrow-to-left","arrow-to-right","arrow-to-top","arrow-up","arrows","arrows-alt","arrows-alt-h","arrows-alt-v","arrows-h","arrows-v","caret-circle-down","caret-circle-left","caret-circle-right","caret-circle-up","caret-down","caret-left","caret-right","caret-square-down","caret-square-left","caret-square-right","caret-square-up","caret-up","cart-arrow-down","chart-line","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-double-down","chevron-double-left","chevron-double-right","chevron-double-up","chevron-down","chevron-left","chevron-right","chevron-square-down","chevron-square-left","chevron-square-right","chevron-square-up","chevron-up","cloud-download","cloud-download-alt","cloud-upload","cloud-upload-alt","compress-alt","compress-arrows-alt","download","exchange","exchange-alt","expand-alt","expand-arrows","expand-arrows-alt","external-link","external-link-alt","external-link-square","external-link-square-alt","hand-point-down","hand-point-left","hand-point-right","hand-point-up","hand-pointer","history","inbox-in","inbox-out","level-down","level-down-alt","level-up","level-up-alt","location-arrow","long-arrow-alt-down","long-arrow-alt-left","long-arrow-alt-right","long-arrow-alt-up","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","mouse-pointer","play","random","recycle","redo","redo-alt","repeat","repeat-1","repeat-1-alt","repeat-alt","reply","reply-all","retweet","retweet-alt","share","share-all","share-square","sign-in","sign-in-alt","sign-out","sign-out-alt","sort","sort-alpha-down","sort-alpha-down-alt","sort-alpha-up","sort-alpha-up-alt","sort-alt","sort-amount-down","sort-amount-down-alt","sort-amount-up","sort-amount-up-alt","sort-down","sort-numeric-down","sort-numeric-down-alt","sort-numeric-up","sort-numeric-up-alt","sort-shapes-down","sort-shapes-down-alt","sort-shapes-up","sort-shapes-up-alt","sort-size-down","sort-size-down-alt","sort-size-up","sort-size-up-alt","sort-up","sync","sync-alt","text-height","text-width","triangle","undo","undo-alt","upload"

),

"audio-video" => array(

"album","album-collection","amp-guitar","audio-description","backward","betamax","boombox","broadcast-tower","camcorder","camera-home","camera-movie","camera-polaroid","circle","closed-captioning","cloud-music","compress","compress-alt","compress-arrows-alt","compress-wide","computer-speaker","drone","drone-alt","eject","expand","expand-alt","expand-arrows","expand-arrows-alt","expand-wide","fast-backward","fast-forward","file-audio","file-video","film","film-alt","film-canister","forward","head-side-headphones","headphones","image-polaroid","microphone","microphone-alt","microphone-alt-slash","microphone-slash","microphone-stand","mp3-player","music","pause","pause-circle","phone-volume","photo-video","play","play-circle","podcast","projector","random","rectangle-landscape","rectangle-portrait","rectangle-wide","redo","redo-alt","repeat","repeat-1","repeat-1-alt","repeat-alt","rss","rss-square","scrubber","signal-stream","speaker","speakers","step-backward","step-forward","stop","stop-circle","sync","sync-alt","tv","tv-alt","undo","undo-alt","vhs","video","volume","volume-down","volume-mute","volume-off","volume-slash","volume-up","waveform","waveform-path","webcam","webcam-slash","b fab fa-youtube",
),

"Automotive" => array(

"air-freshener","ambulance","bus","bus-alt","car","car-alt","car-battery","car-building","car-bump","car-bus","car-crash","car-garage","car-mechanic","car-side","car-tilt","car-wash","caravan","caravan-alt","cars","charging-station","engine-warning","flux-capacitor","garage","garage-car","garage-open","gas-pump","gas-pump-slash","motorcycle","oil-can","oil-temp","rv","shuttle-van","steering-wheel","tachometer","tachometer-alt","tachometer-alt-average","tachometer-alt-fast","tachometer-alt-fastest","tachometer-alt-slow","tachometer-alt-slowest","tachometer-average","tachometer-fast","tachometer-fastest","tachometer-slow","tachometer-slowest","taxi","tire","tire-flat","tire-pressure-warning","tire-rugged","trailer","truck","truck-monster","truck-pickup","wagon-covered",

),

"Autum" => array(

"acorn","apple-alt","apple-crate","axe","campfire","campground","cloud-sun","coffee-togo","corn","drumstick","drumstick-bite","football-ball","hiking","kite","leaf-maple","leaf-oak","mountain","mountains","mug-tea","pie","pumpkin","shovel","squirrel","tractor","tree","tree-alt","trees","turkey","wheat","wind","wine-bottle",


),


"beverage" => array("beer","blender","burger-soda","cocktail","coffee","coffee-pot","coffee-togo","flask","flask-poison","flask-potion","glass","glass-champagne","glass-cheers","glass-citrus","glass-martini","glass-martini-alt","glass-whiskey","glass-whiskey-rocks","jug","mug","mug-hot","mug-marshmallows","mug-tea","wine-bottle","wine-glass","wine-glass-alt",), "buildings" => array("archway","building","campground","car-building","chimney","church","city","clinic-medical","container-storage","dungeon","farm","garage","garage-car","garage-open","gopuram","home","home-alt","home-lg","home-lg-alt","hospital","hospital-alt","hospital-user","hospitals","hotel","house","house-damage","house-day","house-flood","house-night","igloo","industry","industry-alt","kaaba","landmark","landmark-alt","monument","mosque","place-of-worship","school","store","store-alt","synagogue","torii-gate","university","vihara","warehouse","warehouse-alt",), "business" => array("address-book","address-card","archive","badge","badge-check","badge-dollar","badge-percent","balance-scale","balance-scale-left","balance-scale-right","birthday-cake","book","briefcase","building","bullhorn","bullseye","business-time","cabinet-filing","calculator","calendar","calendar-alt","certificate","chart-area","chart-bar","chart-line","chart-line-down","chart-network","chart-pie","chart-pie-alt","chart-scatter","city","clipboard","coffee","coffee-pot","columns","compass","computer-classic","copy","copyright","cut","edit","envelope","envelope-open","envelope-square","eraser","fax","file","file-alt","file-chart-line","file-chart-pie","file-spreadsheet","file-user","folder","folder-download","folder-minus","folder-open","folder-plus","folder-times","folder-tree","folder-upload","folders","glasses","globe","highlighter","industry","industry-alt","keynote","lamp-desk","landmark","laptop-house","marker","mind-share","money-check-edit","money-check-edit-alt","paperclip","paste","pen","pen-alt","pen-fancy","pen-nib","pen-square","pencil","pencil-alt","percent","phone","phone-alt","phone-office","phone-slash","phone-square","phone-square-alt","phone-volume","podium","presentation","print","print-slash","project-diagram","projector","registered","router","save","scanner-image","shredder","sitemap","socks","sticky-note","stream","table","tag","tags","tasks","tasks-alt","thumbtack","trademark","user-chart","wallet",), "camping" => array("acorn","axe","backpack","biking-mountain","binoculars","boot","campfire","campground","caravan","caravan-alt","cauldron","compass","faucet","faucet-drip","fire","fire-alt","fire-smoke","first-aid","flashlight","frog","hiking","map","map-marked","map-marked-alt","map-signs","mountain","mountains","route","rv","shish-kebab","shovel","squirrel","sunrise","sunset","toilet-paper","toilet-paper-alt","trailer","tree","tree-alt","tree-large","trees",), "charity" => array("book-heart","box-heart","box-usd","dollar-sign","donate","dove","gift","globe","hand-heart","hand-holding-heart","hand-holding-seedling","hand-holding-usd","hand-holding-water","hands-heart","hands-helping","hands-usd","handshake","handshake-alt","heart","heart-circle","heart-square","home-heart","leaf","leaf-heart","money-check-edit","money-check-edit-alt","parachute-box","piggy-bank","ribbon","seedling","usd-circle","usd-square",), "chat" => array("comment","comment-alt","comment-alt-check","comment-alt-dots","comment-alt-edit","comment-alt-exclamation","comment-alt-lines","comment-alt-medical","comment-alt-minus","comment-alt-plus","comment-alt-slash","comment-alt-smile","comment-alt-times","comment-check","comment-dots","comment-edit","comment-exclamation","comment-lines","comment-medical","comment-minus","comment-music","comment-plus","comment-slash","comment-smile","comment-times","comments","comments-alt","frown","icons-alt","meh","phone","phone-alt","phone-plus","phone-slash","poo","quote-left","quote-right","smile","smile-plus","sms","video","video-plus","video-slash",), "chess" => array("chess","chess-bishop","chess-bishop-alt","chess-board","chess-clock","chess-clock-alt","chess-king","chess-king-alt","chess-knight","chess-knight-alt","chess-pawn","chess-pawn-alt","chess-queen","chess-queen-alt","chess-rook","chess-rook-alt","game-board","game-board-alt","square-full",), "childhood" => array("apple-alt","baby","baby-carriage","backpack","baseball","basketball-hoop","bath","bell-school","bell-school-slash","biking","birthday-cake","cookie","cookie-bite","duck","flashlight","game-console-handheld","gamepad","gamepad-alt","globe-snow","ice-cream","mitten","robot","school","shapes","snowman",), "clothing" => array("boot","graduation-cap","hat-cowboy","hat-cowboy-side","hat-santa","hat-winter","hat-witch","hat-wizard","hood-cloak","ice-skate","mitten","scarf","shoe-prints","socks","stocking","tshirt","user-tie",), "code" => array("archive","barcode","bath","brackets","brackets-curly","browser","bug","code","code-branch","code-commit","code-merge","coffee","file","file-alt","file-code","filter","fire-extinguisher","folder","folder-open","keyboard","laptop-code","microchip","phone-laptop","project-diagram","qrcode","shield","shield-alt","shield-check","sitemap","stream","terminal","user-secret","window","window-alt","window-close","window-maximize","window-minimize","window-restore",), "communication" => array("address-book","address-card","american-sign-language-interpreting","assistive-listening-systems","at","bell","bell-exclamation","bell-plus","bell-slash","bluetooth","bluetooth-b","broadcast-tower","bullhorn","chalkboard","comment","comment-alt","comments","envelope","envelope-open","envelope-square","fax","inbox","inbox-in","inbox-out","language","microphone","microphone-alt","microphone-alt-slash","microphone-slash","mobile","mobile-alt","mobile-android","mobile-android-alt","paper-plane","phone","phone-alt","phone-slash","phone-square","phone-square-alt","phone-volume","rss","rss-square","signal-stream","tty","voicemail","walkie-talkie","webcam","webcam-slash","wifi",), "computers" => array("brackets","brackets-curly","compact-disc","computer-classic","computer-speaker","database","desktop","desktop-alt","disc-drive","download","ethernet","hdd","headphones","keyboard","laptop","laptop-house","memory","microchip","mobile","mobile-alt","mobile-android","mobile-android-alt","mouse","mouse-alt","mp3-player","phone-laptop","plug","power-off","print","router","satellite","satellite-dish","save","scanner-image","sd-card","server","sim-card","speaker","speakers","stream","tablet","tablet-alt","tablet-android","tablet-android-alt","tv","tv-music","tv-retro","upload","usb-drive","watch-calculator","webcam","webcam-slash",), "construction" => array("axe","brush","construction","digging","drafting-compass","dumpster","forklift","hammer","hard-hat","paint-roller","pencil","pencil-alt","pencil-ruler","ruler","ruler-combined","ruler-horizontal","ruler-triangle","ruler-vertical","screwdriver","shovel","toolbox","tools","traffic-cone","truck-container","truck-pickup","user-hard-hat","wrench",), "currency" => array("bitcoin","btc","coin","dollar-sign","ethereum","euro-sign","gg","gg-circle","hryvnia","lira-sign","money-bill","money-bill-alt","money-bill-wave","money-bill-wave-alt","money-check","money-check-alt","pound-sign","ruble-sign","rupee-sign","sack","sack-dollar","shekel-sign","tenge","usd-circle","usd-square","won-sign","yen-sign",), "date-time" => array("alarm-clock","alarm-exclamation","alarm-plus","alarm-snooze","bell","bell-exclamation","bell-plus","bell-slash","calendar","calendar-alt","calendar-check","calendar-edit","calendar-exclamation","calendar-minus","calendar-plus","calendar-times","clock","flux-capacitor","hourglass","hourglass-end","hourglass-half","hourglass-start","house-day","house-night","snooze","stopwatch","watch","watch-calculator",), "design" => array("adjust","bezier-curve","bring-forward","bring-front","brush","camera-polaroid","clone","copy","crop","crop-alt","crosshairs","cut","drafting-compass","draw-circle","draw-polygon","draw-square","edit","eraser","eye","eye-dropper","eye-slash","fill","fill-drip","highlighter","icons-alt","image-polaroid","lasso","layer-group","layer-minus","layer-plus","magic","marker","object-group","object-ungroup","paint-brush","paint-brush-alt","paint-roller","palette","paste","pen","pen-alt","pen-fancy","pen-nib","pencil","pencil-alt","pencil-ruler","ruler-combined","ruler-horizontal","ruler-vertical","save","scanner-image","send-back","send-backward","splotch","spray-can","stamp","swatchbook","tint","tint-slash","vector-square",), "editors" => array("align-center","align-justify","align-left","align-right","align-slash","bold","border-all","border-bottom","border-center-h","border-center-v","border-inner","border-left","border-none","border-outer","border-right","border-style","border-style-alt","border-top","bring-forward","bring-front","clipboard","clone","columns","copy","cut","edit","eraser","file","file-alt","font","font-case","glasses","h1","h2","h3","h4","heading","highlighter","horizontal-rule","i-cursor","icons-alt","indent","italic","kerning","line-columns","link","list","list-alt","list-ol","list-ul","marker","outdent","overline","page-break","paper-plane","paperclip","paragraph","paragraph-rtl","paste","pen","pen-alt","pen-fancy","pen-nib","pencil","pencil-alt","print","quote-left","quote-right","redo","redo-alt","remove-format","reply","reply-all","screwdriver","send-back","send-backward","share","share-all","spell-check","strikethrough","subscript","superscript","sync","sync-alt","table","tasks","tasks-alt","text","text-height","text-size","text-width","th","th-large","th-list","tools","trash","trash-alt","trash-restore","trash-restore-alt","typewriter","underline","undo","undo-alt","unlink","wrench",), "education" => array("apple-alt","atom","atom-alt","award","backpack","bell","bell-school","bell-school-slash","bell-slash","book-alt","book-open","book-reader","books","bus-school","chalkboard","chalkboard-teacher","diploma","file-certificate","glasses-alt","globe-stand","graduation-cap","laptop-code","microscope","music","pencil-paintbrush","ruler-triangle","school","shapes","theater-masks","user-graduate","users-class",), "emoji" => array("angry","dizzy","flushed","frown","frown-open","grimace","grin","grin-alt","grin-beam","grin-beam-sweat","grin-hearts","grin-squint","grin-squint-tears","grin-stars","grin-tears","grin-tongue","grin-tongue-squint","grin-tongue-wink","grin-wink","kiss","kiss-beam","kiss-wink-heart","laugh","laugh-beam","laugh-squint","laugh-wink","meh","meh-blank","meh-rolling-eyes","sad-cry","sad-tear","smile","smile-beam","smile-wink","surprise","tired",), "energy" => array("atom","atom-alt","battery-bolt","battery-empty","battery-full","battery-half","battery-quarter","battery-slash","battery-three-quarters","broadcast-tower","burn","burrito","charging-station","fan","fire","fire-alt","gas-pump","gas-pump-slash","heat","house-day","house-night","industry","industry-alt","leaf","lightbulb","outlet","plug","poop","power-off","radiation","radiation-alt","seedling","solar-panel","sun","water","wind","wind-turbine",), "files" => array("archive","clone","copy","cut","file","file-alt","file-archive","file-audio","file-check","file-code","file-edit","file-excel","file-exclamation","file-image","file-minus","file-music","file-pdf","file-plus","file-powerpoint","file-search","file-times","file-video","file-word","folder","folder-open","paste","photo-video","save","sticky-note",), "finance" => array("analytics","badge-dollar","badge-percent","balance-scale","balance-scale-left","balance-scale-right","book","cash-register","chart-line","chart-line-down","chart-pie","chart-pie-alt","coin","coins","comment-alt-dollar","comment-dollar","comments-alt-dollar","comments-dollar","credit-card","credit-card-blank","credit-card-front","donate","file-chart-line","file-chart-pie","file-invoice","file-invoice-dollar","hand-holding-usd","hands-usd","landmark","money-bill","money-bill-alt","money-bill-wave","money-bill-wave-alt","money-check","money-check-alt","percentage","piggy-bank","receipt","sack","sack-dollar","stamp","tally","treasure-chest","wallet",), "fitness" => array("bicycle","biking","biking-mountain","book-heart","burn","fire-alt","heart","heart-rate","heartbeat","hiking","monitor-heart-rate","running","shoe-prints","skating","ski-jump","skiing","skiing-nordic","snowboarding","spa","swimmer","walking","watch-fitness",), "food" => array("apple-alt","apple-crate","bacon","bone","bread-loaf","bread-slice","burger-soda","burrito","candy-cane","candy-corn","carrot","cheese","cheese-swiss","cheeseburger","cloud-meatball","cookie","corn","croissant","drumstick","drumstick-bite","egg","egg-fried","fish","fish-cooked","french-fries","gingerbread-man","hamburger","hat-chef","hotdog","ice-cream","lemon","meat","pepper-hot","pie","pizza","pizza-slice","popcorn","pumpkin","salad","sandwich","sausage","seedling","shish-kebab","soup","steak","stroopwafel","taco","turkey","wheat",), "fruit-vegetable" => array("apple-alt","apple-crate","carrot","leaf","lemon","pepper-hot","pumpkin","salad","seedling","wheat",), "games" => array("alien-monster","chess","chess-bishop","chess-bishop-alt","chess-board","chess-clock","chess-clock-alt","chess-king","chess-king-alt","chess-knight","chess-knight-alt","chess-pawn","chess-pawn-alt","chess-queen","chess-queen-alt","chess-rook","chess-rook-alt","club","diamond","dice","dice-d10","dice-d12","dice-d20","dice-d4","dice-d6","dice-d8","dice-five","dice-four","dice-one","dice-six","dice-three","dice-two","dreidel","game-console-handheld","gamepad","gamepad-alt","ghost","headset","heart","joystick","playstation","puzzle-piece","spade","steam","steam-square","steam-symbol","twitch","xbox",), "gaming-tabletop" => array("acquisitions-incorporated","axe-battle","book-dead","book-spells","bow-arrow","campfire","critical-role","d-and-d","d-and-d-beyond","dagger","dice-d10","dice-d12","dice-d20","dice-d4","dice-d6","dice-d8","dragon","dungeon","eye-evil","fantasy-flight-games","fist-raised","flame","flask-potion","game-board","game-board-alt","hammer-war","hand-holding-magic","hat-wizard","helmet-battle","hood-cloak","mace","mandolin","paw-claws","penny-arcade","ring","scroll","scroll-old","scythe","shield-cross","sickle","skull-crossbones","sparkles","staff","sword","swords","treasure-chest","wand","wand-magic","wizards-of-the-coast",), "gender" => array("genderless","mars","mars-double","mars-stroke","mars-stroke-h","mars-stroke-v","mercury","neuter","transgender","transgender-alt","venus","venus-double","venus-mars",), "halloween" => array("bat","book-dead","book-spells","broom","candle-holder","candy-corn","cat","cauldron","claw-marks","cloud-moon","coffin","crow","flask-poison","flask-potion","ghost","hat-witch","hat-wizard","hockey-mask","jack-o-lantern","key-skeleton","knife-kitchen","mask","scarecrow","scythe","skull-crossbones","sparkles","spider","spider-black-widow","spider-web","toilet-paper","toilet-paper-alt","tombstone","tombstone-alt","wand","wand-magic",), "hands" => array("allergies","fist-raised","hand-heart","hand-holding","hand-holding-box","hand-holding-heart","hand-holding-magic","hand-holding-medical","hand-holding-seedling","hand-holding-usd","hand-holding-water","hand-lizard","hand-middle-finger","hand-paper","hand-peace","hand-point-down","hand-point-left","hand-point-right","hand-point-up","hand-pointer","hand-receiving","hand-rock","hand-scissors","hand-sparkles","hand-spock","hands","hands-heart","hands-helping","hands-usd","hands-wash","handshake","handshake-alt","handshake-alt-slash","handshake-slash","praying-hands","thumbs-down","thumbs-up",), "health" => array("ambulance","h-square","heart","heartbeat","hospital","medkit","plus-square","prescription","stethoscope","user-md","wheelchair",), "holiday" => array("angel","bells","candy-cane","carrot","cookie-bite","deer","deer-rudolph","dreidel","fireplace","gift","gifts","gingerbread-man","glass-champagne","glass-cheers","hat-santa","holly-berry","lights-holiday","mistletoe","mug-hot","narwhal","ornament","rv","sleigh","snowman","star-christmas","stocking","tree-christmas","tree-decorated","turkey","wreath",), "hotel" => array("air-conditioner","alarm-clock","alarm-snooze","baby-carriage","bath","bed","bed-bunk","bed-empty","briefcase","car","car-building","car-bus","car-garage","cocktail","coffee","concierge-bell","dice","dice-five","door-closed","door-open","dryer","dryer-alt","dumbbell","fan-table","fireplace","glass-martini","glass-martini-alt","heat","hot-tub","hotel","infinity","key","lamp-desk","luggage-cart","microwave","outlet","oven","paw-alt","refrigerator","shower","shuttle-van","smoking","smoking-ban","snooze","snowflake","spa","suitcase","suitcase-rolling","swimmer","swimming-pool","tv","tv-alt","tv-retro","umbrella-beach","utensils","utensils-alt","vacuum","washer","wheelchair","wifi","wifi-slash",), "household" => array("air-conditioner","bath","bed","bed-alt","bed-bunk","bed-empty","bell","bell-on","blanket","blender","blinds","blinds-open","blinds-raised","books","box-tissue","camera-home","cctv","chair","chair-office","coffee","coffee-pot","couch","door-closed","door-open","dryer","dryer-alt","dungeon","fan","fan-table","faucet","faucet-drip","fireplace","flashlight","garage","garage-car","garage-open","heat","house","house-day","house-leave","house-night","house-return","house-signal","house-user","lamp","lamp-desk","lamp-floor","laptop-house","light-ceiling","light-switch","light-switch-off","light-switch-on","lightbulb","lightbulb-on","loveseat","mailbox","microwave","outlet","oven","plug","pump-soap","refrigerator","sensor","sensor-alert","sensor-fire","sensor-on","sensor-smoke","shower","signal-stream","sink","siren","siren-on","snowflake","soap","sort-circle","sort-circle-down","sort-circle-up","speaker","speakers","sprinkler","temperature-down","temperature-up","toilet-paper","toilet-paper-alt","toilet-paper-slash","tv","tv-alt","tv-retro","vacuum","vacuum-robot","washer","webcam","window-frame","window-frame-open",), "images" => array("adjust","bolt","camera","camera-alt","camera-polaroid","camera-retro","chalkboard","clone","compress","compress-arrows-alt","compress-wide","expand","expand-wide","eye","eye-dropper","eye-slash","file-image","film","film-alt","film-canister","id-badge","id-card","image","image-polaroid","images","photo-video","portrait","rectangle-landscape","rectangle-portrait","rectangle-wide","sliders-h","sliders-h-square","sliders-v","sliders-v-square","tint","unsplash",), "interfaces" => array("alarm-clock","award","badge","badge-check","ban","barcode","bars","beer","bell","bell-slash","blog","bug","bullhorn","bullseye","calculator","calendar","calendar-alt","calendar-check","calendar-edit","calendar-exclamation","calendar-minus","calendar-plus","calendar-times","certificate","check","check-circle","check-double","check-square","circle","clipboard","clone","cloud","cloud-download","cloud-download-alt","cloud-upload","cloud-upload-alt","coffee","cog","cogs","copy","cut","database","dot-circle","download","edit","ellipsis-h","ellipsis-h-alt","ellipsis-v","ellipsis-v-alt","envelope","envelope-open","eraser","exclamation","exclamation-circle","exclamation-square","exclamation-triangle","external-link","external-link-alt","external-link-square","external-link-square-alt","eye","eye-slash","file","file-alt","file-download","file-export","file-import","file-search","file-upload","filter","fingerprint","flag","flag-checkered","folder","folder-open","frown","glasses","grip-horizontal","grip-lines","grip-lines-vertical","grip-vertical","hashtag","heart","history","home","i-cursor","info","info-circle","info-square","language","lasso","magic","marker","medal","meh","microphone","microphone-alt","microphone-slash","minus","minus-circle","minus-hexagon","minus-octagon","minus-square","paste","pen","pen-alt","pen-fancy","pencil","pencil-alt","plus","plus-circle","plus-hexagon","plus-octagon","plus-square","poo","qrcode","question","question-circle","question-square","quote-left","quote-right","redo","redo-alt","reply","reply-all","rss","rss-square","save","screwdriver","search","search-minus","search-plus","share","share-all","share-alt","share-alt-square","share-square","shield","shield-alt","sign-in","sign-in-alt","sign-out","sign-out-alt","signal","signal-1","signal-2","signal-3","signal-4","signal-alt","signal-alt-1","signal-alt-2","signal-alt-3","signal-alt-slash","signal-slash","sitemap","sliders-h","sliders-h-square","sliders-v","sliders-v-square","smile","sort","sort-alpha-down","sort-alpha-down-alt","sort-alpha-up","sort-alpha-up-alt","sort-alt","sort-amount-down","sort-amount-down-alt","sort-amount-up","sort-amount-up-alt","sort-down","sort-numeric-down","sort-numeric-down-alt","sort-numeric-up","sort-numeric-up-alt","sort-up","star","star-exclamation","star-half","sync","sync-alt","thumbs-down","thumbs-up","times","times-circle","times-hexagon","times-octagon","times-square","toggle-off","toggle-on","tools","trash","trash-alt","trash-restore","trash-restore-alt","trash-undo","trash-undo-alt","trophy","trophy-alt","undo","undo-alt","upload","user","user-alt","user-circle","volume","volume-down","volume-mute","volume-off","volume-slash","volume-up","wifi","wifi-1","wifi-2","wifi-slash","wrench",), "logistics" => array("barcode-alt","barcode-read","barcode-scan","box","box-check","boxes","clipboard-check","clipboard-list","conveyor-belt","conveyor-belt-alt","dolly","dolly-empty","dolly-flatbed","dolly-flatbed-alt","dolly-flatbed-empty","forklift","hand-holding-box","hand-receiving","hard-hat","inventory","pallet","pallet-alt","scanner","scanner-keyboard","scanner-touchscreen","shipping-fast","shipping-timed","tablet-rugged","truck","user-hard-hat","warehouse","warehouse-alt",), "maps" => array("ambulance","anchor","bags-shopping","balance-scale","balance-scale-left","balance-scale-right","bath","bed","beer","bell","bell-slash","bicycle","binoculars","birthday-cake","blind","bomb","book","bookmark","briefcase","building","car","cctv","coffee","compass-slash","crosshairs","directions","do-not-enter","dollar-sign","draw-circle","draw-polygon","draw-square","eye","eye-slash","fighter-jet","fire","fire-alt","fire-extinguisher","flag","flag-checkered","flask","gamepad","gavel","gift","glass-martini","globe","graduation-cap","h-square","heart","heartbeat","helicopter","home","hospital","image","images","industry","industry-alt","info","info-circle","info-square","key","landmark","layer-group","layer-minus","layer-plus","leaf","lemon","life-ring","lightbulb","location","location-arrow","location-circle","location-slash","low-vision","magnet","male","map","map-marker","map-marker-alt","map-marker-alt-slash","map-marker-check","map-marker-edit","map-marker-exclamation","map-marker-minus","map-marker-plus","map-marker-question","map-marker-slash","map-marker-smile","map-marker-times","map-pin","map-signs","medkit","money-bill","money-bill-alt","motorcycle","music","newspaper","parking","parking-circle","parking-circle-slash","parking-slash","paw","phone","phone-alt","phone-square","phone-square-alt","phone-volume","plane","plane-alt","plug","plus","plus-square","print","recycle","restroom","road","rocket","route","route-highway","route-interstate","search","search-minus","search-plus","ship","shoe-prints","shopping-bag","shopping-basket","shopping-cart","shower","skull-cow","snowplow","street-view","subway","suitcase","tag","tags","taxi","thumbtack","ticket","ticket-alt","tint","traffic-cone","traffic-light","traffic-light-go","traffic-light-slow","traffic-light-stop","train","tram","tree","tree-alt","trophy","trophy-alt","truck","truck-plow","tty","umbrella","university","usd-circle","usd-square","utensil-fork","utensil-knife","utensil-spoon","utensils","utensils-alt","vest","vest-patches","wheelchair","wifi","wine-glass","wrench",), "maritime" => array("anchor","binoculars","compass","compass-slash","container-storage","dharmachakra","duck","frog","island-tropical","raindrops","ship","skull-crossbones","stars","swimmer","treasure-chest","turtle","walkie-talkie","water","water-lower","water-rise","whale","wind","wind-warning",), "marketing" => array("ad","analytics","badge","badge-check","badge-dollar","badge-percent","bullhorn","bullseye","bullseye-arrow","bullseye-pointer","comment-alt-dollar","comment-dollar","comments-alt-dollar","comments-dollar","envelope-open-dollar","envelope-open-text","funnel-dollar","gift-card","lightbulb","lightbulb-dollar","lightbulb-exclamation","lightbulb-on","lightbulb-slash","mail-bulk","megaphone","poll","poll-h","search-dollar","search-location","signal-stream","sparkles","user-crown","users-crown",), "mathematics" => array("abacus","calculator","calculator-alt","divide","empty-set","equals","function","greater-than","greater-than-equal","infinity","integral","intersection","lambda","less-than","less-than-equal","minus","not-equal","omega","percentage","pi","plus","sigma","square-root","square-root-alt","subscript","superscript","tally","theta","tilde","times","union","value-absolute","watch-calculator","wave-sine","wave-square","wave-triangle",), "medical" => array("allergies","ambulance","band-aid","biohazard","bone","bone-break","bong","book-medical","book-user","books-medical","brain","briefcase-medical","burn","cannabis","capsules","clinic-medical","clipboard-prescription","clipboard-user","comment-alt-medical","comment-medical","crutch","crutches","diagnoses","disease","dna","ear","file-medical","file-medical-alt","file-prescription","files-medical","first-aid","head-side-brain","head-side-mask","head-side-medical","heart","heart-rate","heartbeat","hospital","hospital-alt","hospital-symbol","hospital-user","hospitals","id-card-alt","inhaler","joint","kidneys","laptop-medical","lips","lungs","microscope","monitor-heart-rate","mortar-pestle","notes-medical","pager","pills","plus","poop","prescription","prescription-bottle","prescription-bottle-alt","procedures","pump-medical","radiation","radiation-alt","scalpel","scalpel-path","skeleton","smoking","smoking-ban","star-of-life","stethoscope","stomach","stretcher","syringe","tablets","teeth","teeth-open","thermometer","tooth","toothbrush","user-md","user-md-chat","user-nurse","users-medical","vial","vials","virus","virus-slash","viruses","walker","watch-fitness","weight","x-ray",), "moving" => array("archive","blanket","box-alt","box-fragile","box-full","box-open","box-up","boxes-alt","caravan","caravan-alt","container-storage","couch","dolly","dolly-empty","fragile","house-leave","house-return","lamp","loveseat","people-carry","person-carry","person-dolly","person-dolly-empty","ramp-loading","route","sign","suitcase","tape","trailer","truck-container","truck-couch","truck-loading","truck-moving","truck-ramp","vacuum","wine-glass",), "music" => array("album","album-collection","amp-guitar","banjo","bells","boombox","cassette-tape","clarinet","cloud-music","comment-alt-music","comment-music","compact-disc","computer-speaker","cowbell","cowbell-more","drum","drum-steelpan","ear","file-audio","file-music","flute","gramophone","guitar","guitar-electric","guitars","head-side-headphones","headphones","headphones-alt","kazoo","list-music","mandolin","microphone","microphone-alt","microphone-alt-slash","microphone-slash","microphone-stand","mp3-player","music","music-alt","music-alt-slash","music-slash","napster","piano","piano-keyboard","play","radio","radio-alt","record-vinyl","sax-hot","saxophone","sliders-h","sliders-h-square","sliders-v","sliders-v-square","soundcloud","speaker","speakers","spotify","triangle-music","trumpet","turntable","tv-music","user-music","violin","volume","volume-down","volume-mute","volume-off","volume-slash","volume-up","waveform","waveform-path","whistle",), "objects" => array("alarm-clock","ambulance","anchor","archive","award","axe-battle","baby-carriage","balance-scale","balance-scale-left","balance-scale-right","ball-pile","bath","bed","beer","bell","bells","bicycle","binoculars","birthday-cake","blender","bomb","book","book-dead","book-spells","bookmark","boot","bow-arrow","briefcase","broadcast-tower","bug","building","bullhorn","bullseye","bus","calculator","calendar","calendar-alt","camera","camera-alt","camera-retro","candy-cane","car","carrot","chimney","church","clipboard","cloud","coffee","cog","cogs","compass","cookie","cookie-bite","copy","cube","cubes","cut","dagger","dice","dice-d10","dice-d12","dice-d20","dice-d4","dice-d6","dice-d8","dice-five","dice-four","dice-one","dice-six","dice-three","dice-two","digital-tachograph","door-closed","door-open","dreidel","drum","drum-steelpan","ear-muffs","envelope","envelope-open","eraser","eye","eye-dropper","fax","feather","feather-alt","fighter-jet","file","file-alt","file-prescription","film","film-alt","fire","fire-alt","fire-extinguisher","fireplace","flag","flag-checkered","flask","flask-potion","futbol","gamepad","gavel","gem","gift","gifts","gingerbread-man","glass-champagne","glass-cheers","glass-martini","glass-whiskey","glass-whiskey-rocks","glasses","globe","globe-snow","graduation-cap","guitar","hammer-war","hat-santa","hat-winter","hat-wizard","hdd","headphones","headphones-alt","headset","heart","heart-broken","helicopter","helmet-battle","highlighter","holly-berry","home","hood-cloak","hospital","hourglass","ice-skate","igloo","image","images","industry","industry-alt","jack-o-lantern","key","keyboard","laptop","leaf","lemon","life-ring","lightbulb","lights-holiday","lock","lock-alt","lock-open","lock-open-alt","mace","magic","magnet","mandolin","map","map-marker","map-marker-alt","map-pin","map-signs","marker","medal","medkit","memory","microchip","microphone","microphone-alt","mitten","mobile","mobile-alt","mobile-android","mobile-android-alt","money-bill","money-bill-alt","money-check","money-check-alt","moon","motorcycle","mug-hot","mug-marshmallows","newspaper","ornament","paint-brush","paper-plane","paperclip","paste","paw","pen","pen-alt","pen-fancy","pen-nib","pencil","pencil-alt","phone","phone-alt","plane","plane-alt","plug","print","puzzle-piece","ring","road","rocket","ruler-combined","ruler-horizontal","ruler-vertical","rv","satellite","satellite-dish","save","scarf","school","screwdriver","scroll","scroll-old","scythe","sd-card","search","shield","shield-alt","shield-cross","shopping-bag","shopping-basket","shopping-cart","shovel-snow","shower","sim-card","skull-crossbones","sleigh","snowflake","snowmobile","snowplow","space-shuttle","staff","star","sticky-note","stocking","stopwatch","stroopwafel","subway","suitcase","sun","sword","swords","tablet","tablet-alt","tablet-android","tablet-android-alt","tachometer","tachometer-alt","tag","tags","taxi","thumbtack","ticket","ticket-alt","toilet","toolbox","tools","train","tram","trash","trash-alt","treasure-chest","tree","tree-alt","tree-christmas","tree-decorated","tree-large","trophy","trophy-alt","truck","truck-plow","tv","tv-retro","umbrella","university","unlock","unlock-alt","utensil-fork","utensil-knife","utensil-spoon","utensils","utensils-alt","wallet","wand","wand-magic","watch","weight","wheelchair","wine-glass","wreath","wrench",), "payments-shopping" => array("alipay","amazon-pay","apple-pay","badge","badge-check","bags-shopping","bell","bitcoin","bookmark","btc","bullhorn","camera","camera-alt","camera-retro","cart-arrow-down","cart-plus","cc-amazon-pay","cc-amex","cc-apple-pay","cc-diners-club","cc-discover","cc-jcb","cc-mastercard","cc-paypal","cc-stripe","cc-visa","certificate","credit-card","credit-card-blank","credit-card-front","ethereum","gem","gift","google-pay","google-wallet","handshake","heart","key","money-check","money-check-alt","money-check-edit","money-check-edit-alt","paypal","receipt","shopping-bag","shopping-basket","shopping-cart","star","star-exclamation","stripe","stripe-s","tag","tags","thumbs-down","thumbs-up","trophy","trophy-alt",), "pharmacy" => array("band-aid","book-medical","cannabis","capsules","cauldron","clinic-medical","clipboard-prescription","disease","eye-dropper","file-medical","file-prescription","files-medical","first-aid","flask","flask-potion","history","inhaler","joint","laptop-medical","mortar-pestle","notes-medical","pills","prescription","prescription-bottle","prescription-bottle-alt","receipt","skull-crossbones","syringe","tablets","thermometer","vial","vials",), "political" => array("award","balance-scale","balance-scale-left","balance-scale-right","ballot","ballot-check","booth-curtain","box-ballot","bullhorn","calendar-star","check-double","clipboard-list-check","democrat","donate","dove","fist-raised","flag-alt","flag-usa","handshake","landmark-alt","person-booth","person-sign","piggy-bank","podium","podium-star","poll-people","republican","tally","vote-nay","vote-yea",), "religion" => array("ankh","atom","bahai","bible","church","cross","dharmachakra","dove","gopuram","hamsa","hanukiah","jedi","journal-whills","kaaba","khanda","menorah","mosque","om","pastafarianism","peace","place-of-worship","pray","praying-hands","quran","star-and-crescent","star-of-david","synagogue","tanakh","torah","torii-gate","vihara","yin-yang",), "science" => array("analytics","atom","atom-alt","biohazard","book-spells","brain","burn","capsules","cauldron","chart-network","chart-scatter","clipboard-check","disease","dna","eye-dropper","filter","fire","fire-alt","flask","flask-poison","flask-potion","frog","head-side-brain","key-skeleton","kite","magnet","microscope","mortar-pestle","pills","prescription-bottle","radiation","radiation-alt","seedling","skull-crossbones","syringe","tablets","tally","temperature-high","temperature-low","vial","vials",), "science-fiction" => array("alien","alien-monster","atom","atom-alt","cat-space","comet","drone","drone-alt","eclipse","eclipse-alt","flux-capacitor","galactic-republic","galactic-senate","galaxy","globe","hand-spock","jedi","jedi-order","journal-whills","meteor","moon","moon-stars","old-republic","planet-moon","planet-ringed","police-box","portal-enter","portal-exit","radar","raygun","robot","rocket","rocket-launch","satellite","satellite-dish","solar-system","space-shuttle","space-station-moon","space-station-moon-alt","star-shooting","starfighter","starfighter-alt","stars","starship","starship-freighter","sword-laser","sword-laser-alt","swords-laser","telescope","transporter","transporter-1","transporter-2","transporter-3","transporter-empty","ufo","ufo-beam","user-alien","user-astronaut","user-robot","user-visor","watch-calculator",), "security" => array("badge-sheriff","ban","bug","cctv","debug","do-not-enter","door-closed","door-open","dungeon","eye","eye-slash","file-certificate","file-contract","file-signature","fingerprint","id-badge","id-card","id-card-alt","key","key-skeleton","lock","lock-alt","lock-open","lock-open-alt","mask","passport","shield","shield-alt","shield-check","siren","siren-on","unlock","unlock-alt","usb-drive","user-lock","user-secret","user-shield","user-unlock","whistle",), "shapes" => array("badge","bookmark","calendar","certificate","circle","cloud","club","comment","diamond","file","folder","heart","heart-broken","hexagon","map-marker","octagon","play","rectangle-landscape","rectangle-portrait","rectangle-wide","shapes","shield","spade","square","star","ticket","triangle",), "shopping" => array("badge","badge-check","badge-dollar","badge-percent","bags-shopping","barcode","barcode-alt","barcode-read","barcode-scan","booth-curtain","box-full","cart-arrow-down","cart-plus","cash-register","gift","gift-card","gifts","hand-holding-box","person-booth","receipt","shipping-fast","shipping-timed","shopping-bag","shopping-basket","shopping-cart","store","store-alt","store-alt-slash","store-slash","truck","truck-container","tshirt",), "social" => array("bags-shopping","bell","birthday-cake","camera","comment","comment-alt","envelope","hashtag","heart","icons-alt","image","images","map-marker","map-marker-alt","photo-video","poll","poll-h","retweet","retweet-alt","share","share-alt","share-square","signal-stream","sparkles","star","thumbs-down","thumbs-up","thumbtack","user","user-circle","user-crown","user-friends","user-plus","users","users-crown","video",), "spinners" => array("asterisk","atom","atom-alt","badge","bahai","bullseye-arrow","certificate","circle-notch","cog","compact-disc","compass","crosshairs","dharmachakra","eclipse-alt","fan","hurricane","life-ring","palette","ring","slash","snowflake","spider-web","spinner","spinner-third","star-christmas","steering-wheel","stroopwafel","sun","sync","sync-alt","tire","tire-rugged","wreath","yin-yang",), "sports" => array("baseball","baseball-ball","basketball-ball","basketball-hoop","biking","biking-mountain","bowling-ball","bowling-pins","boxing-glove","cricket","curling","dumbbell","field-hockey","football-ball","football-helmet","futbol","golf-ball","golf-club","hockey-mask","hockey-puck","hockey-sticks","ice-skate","luchador","pennant","quidditch","racquet","running","shuttlecock","skating","ski-jump","skiing","skiing-nordic","sledding","snowboarding","swimmer","table-tennis","tennis-ball","volleyball-ball","whistle",), "spring" => array("allergies","broom","cloud-rainbow","cloud-sun","cloud-sun-rain","flower","flower-daffodil","flower-tulip","frog","hand-holding-seedling","rabbit","rabbit-fast","rainbow","raindrops","seedling","shovel","sunglasses","thunderstorm","tree-alt","umbrella",), "status" => array("badge","badge-check","ban","battery-bolt","battery-empty","battery-full","battery-half","battery-quarter","battery-slash","battery-three-quarters","bell","bell-school","bell-school-slash","bell-slash","bells","calendar","calendar-alt","calendar-check","calendar-day","calendar-edit","calendar-exclamation","calendar-minus","calendar-plus","calendar-star","calendar-times","calendar-week","cart-arrow-down","cart-plus","comment","comment-alt","comment-alt-slash","comment-slash","compass","compass-slash","door-closed","door-open","exclamation","exclamation-circle","exclamation-square","exclamation-triangle","eye","eye-slash","file","file-alt","file-check","file-edit","file-exclamation","file-minus","file-plus","file-times","folder","folder-open","gas-pump","gas-pump-slash","info","info-circle","info-square","lightbulb","lightbulb-slash","location","location-slash","lock","lock-alt","lock-open","lock-open-alt","map-marker","map-marker-alt","map-marker-alt-slash","map-marker-slash","microphone","microphone-alt","microphone-alt-slash","microphone-slash","minus","minus-circle","minus-hexagon","minus-octagon","minus-square","parking","parking-circle","parking-circle-slash","parking-slash","phone","phone-alt","phone-slash","plus","plus-circle","plus-hexagon","plus-octagon","plus-square","print","print-slash","question","question-circle","question-square","shield","shield-alt","shield-check","shopping-cart","sign-in","sign-in-alt","sign-out","sign-out-alt","signal","signal-1","signal-2","signal-3","signal-4","signal-alt","signal-alt-1","signal-alt-2","signal-alt-3","signal-alt-slash","signal-slash","smoking-ban","star","star-half","star-half-alt","stream","thermometer-empty","thermometer-full","thermometer-half","thermometer-quarter","thermometer-three-quarters","thumbs-down","thumbs-up","tint","tint-slash","toggle-off","toggle-on","unlock","unlock-alt","user","user-alt","user-alt-slash","user-slash","video","video-slash","volume","volume-down","volume-mute","volume-off","volume-slash","volume-up","wifi","wifi-1","wifi-2","wifi-slash",), "summer" => array("anchor","biking","biking-mountain","fish","glass","glass-citrus","hotdog","ice-cream","island-tropical","kite","lemon","shish-kebab","sun","sunglasses","swimmer","swimming-pool","temperature-hot","tree-palm","umbrella-beach","volleyball-ball","water",), "toggle" => array("bullseye","bullseye-arrow","check-circle","circle","dot-circle","location","location-slash","microphone","microphone-slash","star","star-half","star-half-alt","toggle-off","toggle-on","volume","volume-slash","wifi","wifi-slash",), "travel" => array("archway","atlas","bed","bus","bus-alt","cactus","car-bus","caravan","caravan-alt","cars","cocktail","concierge-bell","dumbbell","flux-capacitor","glass-martini","glass-martini-alt","globe-africa","globe-americas","globe-asia","globe-europe","horse-saddle","hot-tub","hotel","island-tropical","luggage-cart","map","map-marked","map-marked-alt","monument","passport","phone-rotary","plane","plane-arrival","plane-departure","rings-wedding","rv","shuttle-van","spa","suitcase","suitcase-rolling","swimmer","swimming-pool","taxi","tram","tree-palm","tv","tv-alt","umbrella-beach","wagon-covered","wine-glass","wine-glass-alt",), "users-people" => array("address-book","address-card","angel","baby","bed","biking","biking-mountain","blind","chalkboard-teacher","child","digging","female","file-user","frown","head-side","head-vr","hiking","id-badge","id-card","id-card-alt","male","meh","people-arrows","people-carry","person-booth","person-carry","person-dolly","person-dolly-empty","person-sign","poll-people","poo","portrait","power-off","pray","restroom","running","skating","ski-jump","ski-lift","skiing","skiing-nordic","sledding","smile","snowboarding","snowmobile","street-view","swimmer","user","user-alt","user-alt-slash","user-astronaut","user-chart","user-check","user-circle","user-clock","user-cog","user-cowboy","user-crown","user-edit","user-friends","user-graduate","user-hard-hat","user-headset","user-injured","user-lock","user-md","user-md-chat","user-minus","user-music","user-ninja","user-nurse","user-plus","user-secret","user-shield","user-slash","user-tag","user-tie","user-times","user-unlock","users","users-class","users-cog","users-crown","users-medical","users-slash","walking","wheelchair",), "vehicles" => array("ambulance","baby-carriage","bicycle","bus","bus-alt","car","car-alt","car-building","car-bump","car-bus","car-crash","car-side","car-tilt","cars","drone","drone-alt","fighter-jet","flux-capacitor","helicopter","horse","horse-saddle","motorcycle","paper-plane","pegasus","plane","plane-alt","rocket","rocket-launch","rv","ship","shopping-cart","shuttle-van","ski-lift","sleigh","snowmobile","snowplow","space-shuttle","starfighter","starfighter-alt","starship","starship-freighter","subway","taxi","tractor","train","tram","truck","truck-monster","truck-pickup","truck-plow","ufo","ufo-beam","wheelchair",), "weather" => array("bolt","cloud","cloud-drizzle","cloud-hail","cloud-hail-mixed","cloud-meatball","cloud-moon","cloud-moon-rain","cloud-rain","cloud-rainbow","cloud-showers","cloud-showers-heavy","cloud-sleet","cloud-snow","cloud-sun","cloud-sun-rain","clouds","clouds-moon","clouds-sun","dewpoint","eclipse","eclipse-alt","fire-smoke","fog","heat","house-flood","humidity","hurricane","meteor","moon","moon-cloud","moon-stars","poo-storm","rainbow","raindrops","smog","smoke","snow-blowing","snowflake","snowflakes","sparkles","stars","sun","sun-cloud","sun-dust","sun-haze","sunrise","sunset","temperature-down","temperature-frigid","temperature-high","temperature-hot","temperature-low","temperature-up","thunderstorm","thunderstorm-moon","thunderstorm-sun","tornado","umbrella","volcano","water","water-lower","water-rise","wind","wind-warning","windsock",), "winter" => array("ball-pile","boot","chimney","ear-muffs","frosty-head","glass-whiskey","glass-whiskey-rocks","globe-snow","hat-winter","ice-skate","icicles","igloo","mitten","mug-marshmallows","mug-tea","scarf","shovel-snow","skating","ski-jump","ski-lift","skiing","skiing-nordic","sledding","snowboarding","snowflakes","snowmobile","snowplow","temperature-frigid","tram","tree-large","truck-plow",), "writing" => array("archive","blog","book","bookmark","edit","envelope","envelope-open","eraser","file","file-alt","folder","folder-open","keyboard","newspaper","paper-plane","paperclip","paragraph","pen","pen-alt","pen-square","pencil","pencil-alt","quote-left","quote-right","sticky-note","thumbtack",),


);







function ppt_admin_navigation(){ global $CORE;

   
   $navigation = array(

	"dash" => array(
		
		"n" => __("Dashboard","premiumpress"), "i" => "fal fa-tachometer-alt", "l" => "admin.php?page=premiumpress",
	),
	 
	

	"listings" => array(
		
		"n" => $CORE->LAYOUT("captions","2"), "i" => $CORE->LAYOUT("captions","icon"), 
		
		"sl" => "admin.php?page=listingsetup",
		
		"pageopen" => array("listings","listingsetup","search","stores","comments","categories"), "p" => array(  
			
				"members" => array(
					
					"n" => str_replace("%s", $CORE->LAYOUT("captions","2"), __("All %s","premiumpress")), "l" => "admin.php?page=listings", "svg" => "colors",
				),
			
				"listingsetup" => array(
					
					"n" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Settings","premiumpress")),  "l" => "admin.php?page=listingsetup", "svg" => "cog",
				), 
				
				"customfields" => array(
					
					"n" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Fields","premiumpress")),  "l" => "admin.php?page=customfields", "svg" => "menu",
				),
				
				
				"search" => array(
					
					"n" => __("Search Settings","premiumpress"),  "l" => "admin.php?page=search", "svg" => "search",
				), 
				"stores" => array(
					
					"n" => __("Categories","premiumpress"),  "l" => "admin.php?page=stores", "svg" => "home",
				),
			
			),
		
	),	
	
	"users" => array(
		
		"n" => __("Users","premiumpress"), "i" => "fal fa-users", 		
		
		"sl" => "admin.php?page=usersettings",
		
		"pageopen" => array("manage","usersettings","membershipsetup","paywall"), "p" => array(  
			
			"manage" => array(
				"n" => __("All Users","premiumpress"), "l" => "admin.php?page=members", "svg" => "users",
			), 
			
			"usersettings" => array(				
				"n" => __("User Settings","premiumpress"), "l" => "admin.php?page=usersettings", "svg" => "user", 
			),
			
			
			"paywall" => array(
				"n" => __("Pay Wall","premiumpress"), "l" => "admin.php?page=paywall", "svg" => "shoe-prints", 
			),
			
			
			"membershipsetup" => array(
				"n" => __("Memberships","premiumpress"), "l" => "admin.php?page=membershipsetup", "svg" => "user-circle", 
			), 
			
			"comments" => array(
					
					"n" => __("Comments","premiumpress"),  "l" => "admin.php?page=comments", "svg" => "chat",
			),
		
		),
	), 


	"cashback" => array(
		"n" => __("Cashback","premiumpress"), "i" => "fal fa-sync", "pageopen" => array("cashback"), "l" => "admin.php?page=cashback",
	),


	
	"orders" => array(
		
		"n" => __("Orders","premiumpress"), "i" => "fa fa-dollar-sign", 
		
		"sl" => "admin.php?page=cart",
		
		"pageopen" => array("orders","cashout","dispute"), "p" => array( 	 
			
			"all" => array(		
				"n" => __("All Orders","premiumpress"),   "l" => "admin.php?page=orders", "svg" => "cart", 
			),		
			"cashout" => array(		
				"n" => __("Cashout","premiumpress"), "l" => "admin.php?page=cashout", "svg" => "cash", 
			),
			/*
			"dispute" => array(				
				"n" => __("Disputes","premiumpress"),  "l" => "admin.php?page=dispute", "svg" => "user", 
			),
			*/
					
			
		),
		
		"extra" => array( 	 
			
			"gateways" => array(		
				"n" => __("Payment Gateways","premiumpress"),   "l" => "admin.php?page=cart&lefttab=gateways", "svg" => "paypal", 
			),	
 		  
		),
 		
	),
	
	"cart" => array(
				
				"n" => __("Checkout","premiumpress"), "i" => "fal fa-shopping-cart", "pageopen" => array("cart"), "l" => "admin.php?page=cart",
	),

		
	"design" => array(
		
		"n" => __("Design","premiumpress"), "i" => "fal fa-paint-brush", "pageopen" => array("design"), 
		 	
		"l" => "admin.php?page=design", 
		
	),	
	
	"email" => array(
		
		"n" => __("Email","premiumpress"), "i" => "fal fa-envelope", "pageopen" => array("email","newsletter"), 
		
		"sl" => "admin.php?page=email",
		
		"p" => array( 	
		
			"all" => array(		
				"n" => __("Email","premiumpress"),   "l" => "admin.php?page=email", "svg" => "email",
			),	
			
			"newsletter" => array(				
				"n" => __("Newsletter","premiumpress"),  "l" => "admin.php?page=newsletter", "svg" => "newsletter", 
			), 
	
		),
		
		 
	),	 
	
	"advertising" => array(
		
		"n" => __("Advertising","premiumpress"), "i" => "fal fa-bullseye",  
		
		"pageopen" => array("advertising","news"), 
		
		"sl" => "admin.php?page=advertising",
		
		"p" => array( 	
		
			"all" => array(		
				"n" => __("All Advertising","premiumpress"),   "l" => "admin.php?page=advertising", "svg" => "advertising",
			),	
			
			"news" => array(				
				"n" => __("Popup Ads","premiumpress"),  "l" => "admin.php?page=news", "svg" => "popup", 
			), 
	
		),
		 
		  

	),
	
	
	
	"seo" => array(				
				"n" => __("SEO","premiumpress"), "i" => "fal fa-globe",  "pageopen" => array("seo"), "l" => "admin.php?page=seo",
	),				
			
	
	"settings" => array(
		
		"n" => __("Settings","premiumpress"), "i" => "fal fa-cog", "pageopen" => array("settings"), "l" => "admin.php?page=settings",
	), 
	
);
 

if( in_array(THEME_KEY,array("cb","cp"))  ){

}else{
unset($navigation['cashback']);
}

 

if(!$CORE->LAYOUT("captions","memberships") ){
	unset($navigation['users']['p']['membershipsetup']);
}


if( $CORE->LAYOUT("captions","listings") ){
 	unset($navigation['listings']['pageopen']['customfields']);
}


return $navigation;


}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



function FIELD_USER($data){ global $CORE, $CORE_UI, $userdata;


$type = "text";
if(isset($data['type'])){
$type = $data['type'];
}


$uid = 0;
if(isset($userdata->ID)){
$uid = $userdata->ID;
} 
if(is_admin() && isset($_GET['eid'])){
$uid = $_GET['eid'];
}

$css = "";

$name = $data['key'];
$value = "";

$required = 0;
if(isset( $data['required']) &&  $data['required'] == "1"){
$required = 1;
}
 
switch($type){


case "url":
case "phone":
case "text": {
$value = get_user_meta($uid, $name, true);

?> 
<input type="text" name="<?php echo $name; ?>" <?php if($required){ ?>data-required="1"<?php } ?> class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>" />         
<?php
} break;


 
case "hidden": {
$value = get_user_meta($uid, $name, true);

?> 
<input type="hidden" name="<?php echo $name; ?>" class="<?php echo $css; ?>" value="<?php echo $value; ?>" />         
<?php
} break;

 
case "email": {

if($uid > 0){
$value = $CORE->USER("get_email",$uid);
}

?> 
<input type="text" name="<?php echo $name; ?>" <?php if($required){ ?>data-required="1"<?php } ?> class="form-control <?php echo $css; ?>" value="<?php echo $value; ?>" />         
<?php
} break;

case "textarea": {

$value = get_user_meta($uid, $name, true);

?>
<textarea style="min-height:120px;" <?php if($required){ ?>data-required="1"<?php } ?> class="form-control <?php echo $css; ?>" name="<?php echo $name; ?>"><?php echo stripslashes($value); ?></textarea>
<?php

} break;


case "boost_start":
case "boost_end":
case "date": { 
	 
 
	if(in_array($name,array("boost_start","boost_end"))){
	
		$boostData = get_user_meta($uid, 'upgrade_boost', true);
	 
		if($name == "boost_end" && isset($boostData['end'])){  $value = $boostData['end']; }
	 	if($name == "boost_start" && isset($boostData['start'])){ $value = $boostData['start']; }
	 
	}elseif($value == ""){
	
		$value = get_user_meta($uid, $name, true);
	}
?>
        
<div class="input-group form-group position-relative date mb-3 ppt-datepicker" data-target="#<?php echo $data['key']; ?>-date" id="<?php echo $data['key']; ?>-date">
	<input name="<?php echo $name; ?>" class="form-control"  type="text" value="<?php echo $value; ?>">
	<span class="input-group-addon" style="z-index: 100;"><span class="fal fa-calendar" style="top:15px;"></span></span>
</div>      
<?php
} break;

case "da-seek2": {

$seek2 = get_user_meta($uid,'da-seek2',true);
?>

 
<select name="da-seek2" class="form-control" <?php if($required){ ?>data-required="1"<?php } ?>>
<option value=""></option>
<?php
$count = 1;
if( in_array(THEME_KEY, array("da", "es")) ){
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
}else{
$cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));
}

if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 


$text = ppt_theme_text_switch($cat->slug, $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)) ); //$CORE->GEO("translation_tax", array($cat->term_id, $cat->name));
		 
if($seek2 ==  $cat->term_id){
$InText = $text;
}

?>
<option value="<?php echo $cat->term_id; ?>" <?php if($seek2 == "" && strtolower($cat->name) == "women"){  echo "selected=selected";  }elseif($seek2 ==  $cat->term_id){ echo "selected=selected"; } ?>>
                    <?php echo $text; ?>
</option>
<?php $count++; } } ?>
</select>
<?php

} break;



case "city": {

?>
 
<input type="hidden"  value="<?php echo $CORE->USER("get_address_part", array("city", $uid) ); ?>" id="user-city"  />

<select class="form-control" id="user-city-select" name="<?php echo $data['key']; ?>" tabindex="7" >
</select>
<?php

} break;
	
	case "country": {
	
	
$selected_country 	= $CORE->USER("get_address_part", array("country", $uid) );
	 
 
 
?>

<select name="<?php echo $data['key']; ?>" class="form-control"  id="user-country">
                      <?php 
					  
					  
					  $admin_countries = _ppt('checkout_countries');
					  
					   
                        foreach($GLOBALS['core_country_list'] as $key=>$value){
						
						
						// HIDE COUNTRIES
						if( !is_array( $admin_countries ) || is_array($admin_countries) && in_array("0", $admin_countries ) ){						
						
						}else{
						
							if( is_array( $admin_countries ) && $admin_countries[0] != ""){		
								if(!in_array( $key, $admin_countries )  ){
								continue;
								}
							}
						
						}
						
                                if(isset($selected_country) && $selected_country == $key){ $sel ="selected=selected"; }else{ $sel =""; }
                                echo "<option ".$sel." value='".$key."'>".$value."</option>";} ?>
</select>
    <script type="application/javascript">
            jQuery(document).ready(function(){ 
            
            	jQuery('#user-country').on('change', function(e){
            	
            		 ajax_update_citylist();
            	
            	});	
            	 	
            	 ajax_update_citylist(); 
            	
            });
            
            function ajax_update_citylist(){
            
            	// COUNTRY VALUE
            	var countryid = jQuery('#user-country').val();
            	if(countryid == ""){
            	countryid = jQuery('#user-country option:first').val();
            	}
             
            	// SET VALUE
            	jQuery('#user-city').val(countryid);
            
                jQuery.ajax({
                    type: "POST",
                    url: ajax_site_url,	 	
            		data: {
                        action: "get_location_states",
            			country_id: countryid,
              			state_id: "<?php echo get_user_meta($uid,'city',true); ?>",
                    },
                    success: function(response) {            	 
            			jQuery("#user-city-select").html(response);
                    },
                    error: function(e) {
                         
                    }
                });
            }
            
         </script>
<?php
	} break;
case "user_type": {


$accountTypes = $CORE->USER("get_account_type_all", array());
   
   $usertype = "";
   if(isset($_GET['eid'])){
   
    $usertype = get_user_meta($uid,'user_type',true);
   
   }
    
		  if(!empty( $accountTypes ) ){   ?>
  
     
              <select name="<?php echo $name; ?>" class="form-control <?php echo $css; ?>">
              
              <option value=""><?php echo __("Auto Assign","premiumpress"); ?></option>
              
               <?php foreach($accountTypes as $k => $g){ 
			   
			   if( in_array(_ppt(array("usertype",$k)), array("","1")) ){ }else{ continue; }
			   
			   ?>             
             <option value="<?php echo $k ?>" <?php if($usertype == $k){ echo "selected='selected'"; } ?>><?php if(isset($g['name'])){ echo $g['name']; }else{ echo $g; } ?></option>
             <?php } ?>  
               
              </select>  
<?php

}
	
	
	} break;


case "deleteaccount": {


?>

<div ppt-border1 class="p-3">
        <p><?php echo __("We're really sad to see you go, but we understand that situations change.","premiumpress"); ?> </p>
        <p><?php echo __("Click to 'delete account' button below to confirm you wish to delete your account.","premiumpress"); ?></p>
        <p><?php echo __("Once processed, you must logout and remain logged out for 30 days.","premiumpress"); ?></p>
        <button data-ppt-btn class="btn-system logoutm2" type="button" onclick="process_delete();"><?php echo __("Delete Account","premiumpress"); ?></button>
        <a href="<?php echo wp_logout_url(home_url()); ?>" data-ppt-btn class="btn-danger logoutmee" style="display:none"><?php echo __("Logout","premiumpress") ?> </a>
        
        
          
              <?php if(is_admin()){ ?>
                  <button data-ppt-btn class="btn-success logoutm3" type="button" onclick="process_delete_cancel();"><?php echo __("Cancel","premiumpress"); ?></button>
              <?php } ?>
       
</div>
        <script>

function process_delete_cancel(){


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "delete_account_cancel",
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 jQuery(".logoutm3").hide();
			jQuery(".deletemealert").hide();
			alert("<?php echo __("Cancelled Successfully.","premiumpress"); ?>"); 
			 			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	 
}
function process_delete(){

jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "delete_account",
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
			jQuery(".logoutmee").show();
			
			jQuery(".logoutm2").hide();
			
			alert("<?php echo __("Account set for deletion - Please logout","premiumpress"); ?>"); 
			 			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	 
}

</script>
<?php

} break;

case "password": { ?>

 
<input autocomplete="off" type="password" data-type="password" <?php if(isset($_GET['eid']) && $_GET['eid'] == 0){ ?>data-required="1"<?php } ?> name="<?php echo $name; ?>" value="" class="form-control">

 
<?php } break;


case "paywall": { 

	 // 
	$value = array();
	if(isset($_GET['eid'])){
	
		$value = $CORE->USER("paywall_data", $_GET['eid']);
		 
	}
	
?>

        <div class="my-2 small text-600"><?php echo __("Expires on","premiumpress") ?></div>
          
           <input type="text" name="paywall_expires" id="mem_expires"  value="<?php echo $value['date_expires']; ?>" class="form-control"  />
          
          <a href="javascript:void(0);" class="small" onclick="jQuery('#mem_expires').val('<?php echo date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . "+1 minute")); ?>');">Time Now + 1 minute</a>
          
          <div class="bg-light small p-2 mt-3"><i class="fal fa-clock"></i>
          <?php echo do_shortcode('[TIMELEFT postid="'.$_GET['eid'].'" layout="1" text_before="" text_ended="Not Set" key="membership"]'); ?>
          </div>
<?php

} break;

case "membership": { 


	// GET MEMBERSHIPS
	$all_memberships = $CORE->USER("get_memberships", array());
	
	 // 
	$value = array();
	if(isset($_GET['eid'])){
	
		$value = $CORE->USER("get_user_membership", $_GET['eid']);
		 		   
		if(!is_array($value)){ $value = array(); }
	 
	}

?>

<div class="row"> 
 <div class="col-md-6">
 
 <div class="my-2 small text-600"><?php echo __("Plan","premiumpress") ?></div>
 
    <select name="membership" class="form-control">
          <option value=""><?php echo __("No Membership","premiumpress"); ?>
            <?php foreach($all_memberships  as $key => $m){  ?>
            <option value="mem<?php echo $m['key']; ?>" <?php if(isset($value['key']) && ( ($m['key'] == $value['key']) || ("mem".$m['key'] == $value['key']) ) ){  echo "selected=selected"; } ?>><?php echo $m['name']; ?></option>
            <?php } ?>
</select>

<div class="my-2 small text-600"><?php echo __("Status","premiumpress") ?></div>

<select name="user_approved" class="form-control">
<option value="1"><?php echo __("Approved","premiumpress"); ?></option>
<option value="0" <?php if(isset($value['user_approved']) && $value['user_approved'] == "0"){ echo 'selected=selected'; } ?>><?php echo __("Pending Approval","premiumpress"); ?></option>
        
</select>

 <?php if(is_array($value) && !empty($value) ){ ?>
          
          <div class="my-2 small text-600"><?php echo __("Expires on","premiumpress") ?></div>
          
           <input type="text" name="membership_expires" id="mem_expires"  value="<?php echo $value['date_expires']; ?>" class="form-control"  />
          
          <a href="javascript:void(0);" class="small" onclick="jQuery('#mem_expires').val('<?php echo date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . "+1 minute")); ?>');">Time Now + 1 minute</a>
          

<?php } ?>


</div>
<div class="col-md-6">


    <div class="my-2 small text-600"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("Messages Reamining","premiumpress")); ?></div>
          <div class="input-group mb-1">
            <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">#</span> </div>
            <input type="text" name="max_msg"  value="<?php if(isset($_GET['eid'])){ echo get_user_meta($_GET['eid'],'max_msg_count',true); }else{ echo 100; } ?>" class="form-control"  />
          </div>

         
 <div class="my-2 small text-600"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"),__("Free %s Remaining","premiumpress")); ?> 
          
          <div class="badge_tooltip text-center float-right mr-3" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle" style="color:#000000"></i></div>
    <div class="badge_tooltip__item"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Allows the user to create multiple %s. Ignore this option if disabled for this membership.","premiumpress")); ?></div>
  </div>
          </div>
        
          <div class="input-group mb-1">
            <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">#</span> </div>
            <input type="text" name="ppt_freelistings"  value="<?php if(isset($_GET['eid'])){ echo get_user_meta($_GET['eid'],'free_listings_count',true); }else{ echo 0; } ?>" class="form-control"  />
          </div>
        
           
 <?php /*if(in_array(THEME_KEY,array("so","ph"))){ ?>
 
 <div class="my-2 small text-600"><?php echo __("Downloads Remaining","premiumpress"); ?></div>
              <div class="input-group mb-1">
                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">#</span> </div>
                <input type="text" name="ppt_userdownloads" value="<?php if(isset($_GET['eid'])){ echo get_user_meta($_GET['eid'],'free_downloads_count',true); }else{ echo 0; } ?>" class="form-control"  />
</div>
<?php } */ ?>


</div>
</div>



<?php
} break;



case "username": {

 
if(is_admin() && isset($_GET['eid']) && $_GET['eid'] == 0 ){ 
	$username = "";
}elseif(is_admin() &&  isset($_GET['eid']) && $_GET['eid'] > 0 ){ 
	$the_user = get_user_by( 'id', $_GET['eid'] ); 
	$username = $the_user->user_login;
}elseif(isset($userdata->ID)){
	$the_user = get_user_by( 'id', $userdata->ID ); 
	$username = $the_user->user_login;
}

// $GLOBALS['flag-account']

?>
 
<span id="ajaxMsgUser"></span>      

<input class="form-control val-nospaces" data-required="1" data-type="username" type="text" <?php if(is_admin()){ ?>id="newusernamefield" name="user_login" <?php }else{ ?>disabled<?php } ?>  value="<?php echo $username; ?>">

<?php if(is_admin()){ ?>
<div class="user-taken text-danger text-600" style="display:none;"><?php echo __("Username Taken","premiumpress"); ?></div>

<div class="user-invalid text-danger text-600" style="display:none;"><?php echo __("Invalid Username","premiumpress"); ?></div>

<div class="user-valid text-success text-600" style="display:none;"><?php echo __("Valid Username","premiumpress"); ?></div>

<?php } ?>
             
<script>
function resetUsernameAlerts(){

jQuery(".user-taken").hide();
jQuery(".user-valid").hide();
jQuery(".user-invalid").hide();

}
jQuery(document).ready(function() {

jQuery('#newusernamefield').change(function() {  

	resetUsernameAlerts();		 

	if(jQuery('#newusernamefield').val().length < 6){
		
		jQuery(".user-invalid").show();
			 
		}else if(jQuery('#newusernamefield').val().length > 6){
		 	 
         
             jQuery.ajax({
                 type: "POST",
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                     action: "validateUsername",
         			un: jQuery('#newusernamefield').val(), 
                 },
                 success: function(response) {
         		 
         			if(response == "yes"){
					
         			jQuery(".user-taken").show();
         			
         			} else {
         			
					jQuery(".user-valid").show();
					
					jQuery('#user_form, .user_form').append('<input type="hidden" name="usernamechange" value="1">');	
					
					}			
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
             });
			 
		}else if(jQuery('#newusernamefield').val().length > 1){
		
		jQuery(".user-valid").hide();		
		jQuery(".user-taken").show();
		}
});
});
</script>
 
 

<?php 

 
} break;

case "userphoto": {


echo $CORE->MEDIA("customUploadForm", "userphoto");
?>

<?php
} break;

case "myavatar": {

$user_avatars = array();
$i=1;
while($i < 16){
$user_avatars["f".$i] = "f".$i;
$i++;
}

$i=1;
while($i < 16){
$user_avatars["m".$i] = "m".$i;
$i++;
}
 
?>
        <div class="row">
                <?php

$CA = get_user_meta($uid,'myavatar',true);
foreach($user_avatars as $k => $h){?>
                <div class="col-4 col-md-2 text-center px-0">
                  <figure> <img data-src="<?php echo CDN_PATH; ?>images/avatar/<?php echo $k; ?>.png" alt="img" class="lazy img-fluid" <?php if( $CA == "" && $k == "m1" ||  $CA == $k){ ?>style="border:3px solid red;"<?php } ?>> </figure>
                  <input type="radio"  value="<?php echo $k; ?>" name="myavatar" <?php if( $CA == "" && $k == "m1" ||  $CA == $k){ echo "checked=checked"; } ?> >
                </div>
                <?php } ?> 
              </div>
              
<?php
} break;


case "customfields": {

?>
<div class="row">
<?php echo $CORE->user_fields($userdata->ID); ?>
</div>
<?php

} break;

 
case "ppt_usercredit": {

$value = get_user_meta($uid, $name, true);
?>
<div class="input-group">
<div class="input-group-prepend">

<span class="input-group-text" id="basic-addon1"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>

</div>

<input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="form-control"  />

</div>

<?php

} break;


case "ppt_sms_verified": {
?>
<select name="ppt_sms_verified" class="form-control mt-2">
<option value="0" <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_sms_verified',true) == "0"){ echo "selected='selected'"; } ?>><?php echo __("No","premiumpress"); ?></option>     
<option value="1" <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_sms_verified',true) == "1"){ echo "selected='selected'"; } ?>><?php echo __("Yes","premiumpress"); ?></option>
 
</select>
 <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_sms_verified_num',true) != ""){ ?>

<div class="mt-2 fs-sm text-600"><?php echo __("Verified Number","premiumpress"); ?></div>

<div class="mt-2"><?php echo get_user_meta($_GET['eid'],'ppt_sms_verified_num',true); ?></div>

<div class="mt-2 fs-sm text-600"><?php echo __("Verified Date","premiumpress"); ?></div>
<div class="mt-2"> <?php echo get_user_meta($_GET['eid'],'ppt_sms_verified_date',true); ?></div>
 <?php } ?>
 
<?php

} break;


case "ppt_verified_email": {

?>
<select name="ppt_verified" class="form-control mt-2">
<option value="0"><?php echo __("No","premiumpress"); ?></option>
<option value="1" <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_verified',true) == "1"){ echo "selected='selected'"; } ?>><?php echo __("Yes","premiumpress"); ?></option>

</select>
       
              
              <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_verified',true) != 1){ ?>
              <div class="mt-2">
              <a href="javascript:void(0);" onclick="resendVemail();" class="small"><i class="fal fa-envelope"></i> <?php echo __("resend verify email","premiumpress"); ?></a>
              
              <a href="<?php echo home_url(); ?>/verifyme/<?php echo $_GET['eid']; ?>/" target="_blank" class="btn btn-system btn-sm float-right"><?php echo __("test link","premiumpress"); ?></a>
              
              </div>
<script>
function resendVemail(){

	jQuery.ajax({
            type: "POST",
			dataType: 'json',	
            url: '<?php echo home_url(); ?>/',		
         	data: {
                    action: "resendvemail",
         			uid: <?php echo esc_attr($_GET['eid']); ?>, 
              },
              success: function(response) {
         		   
				 
         			if(response.status == "sent"){ 
         			 
					alert("<?php echo __("Email Sent!","premiumpress"); ?>");
					}	
					
							
              },
              error: function(e) {
                     alert("error "+e)
               }
	});
			 
}
</script>
 <?php } ?>

<?php

} break;

case "ppt_verified_photo": {

?>
<select name="ppt_verified_photo" class="form-control mt-2">

<option value="0" <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_verified_photo',true) == "0"){ echo "selected='selected'"; } ?>><?php echo __("No","premiumpress"); ?></option>
 
<option value="1" <?php if(isset($_GET['eid']) && get_user_meta($_GET['eid'],'ppt_verified_photo',true) == "1"){ echo "selected='selected'"; } ?>><?php echo __("Yes","premiumpress"); ?></option>
               
              
              </select>
              <?php
			  if(isset($_GET['eid'])){
			  $currentimg = get_user_meta($_GET['eid'], "ppt_verifyfile", true);
			  
			  if(isset($currentimg['img'])){ ?>
              <div class="text-center my-4">
              
              <a href="<?php echo $currentimg['img']; ?>" target="_blank"><img class="img-fluid" src="<?php echo $currentimg['img']; ?>" alt="user "></a>
 
              </div>
              <div class="text-center">
              <button class="btn btn-sm btn-dark" onclick="delete_verifyfile()"><?php echo __("Delete","premiumpress"); ?></button>
            
              </div>
              
<script>
function delete_verifyfile(){
 										   
 	
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "delete_verifyfile",
			uid: "<?php echo $_GET['eid']; ?>",
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
			alert("<?php echo __("Photo Deleted","premiumpress"); ?>"); 
			 			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	
 		
}
</script>
<?php } ?>      <?php } ?>    

<?php

} break;

case "boost": {

	$boostData = array();
	if(isset($_GET['eid'])){
		$boostData = get_user_meta($_GET['eid'], 'upgrade_boost', true);
		
		if(is_array($boostData) && !empty($boostData)){	
			$BoostStart = $boostData['start'];
			$BoostEnds 	= $boostData['end'];
			
			$hh = $CORE->date_timediff($BoostEnds,$BoostStart);
			 
		}
	}

?>

<select name="boost" class="form-control mt-2">
<option value="0" <?php if(empty($boostData)){ echo "selected='selected'"; } ?>><?php echo __("No","premiumpress"); ?></option>
<option value="1" <?php if(!empty($boostData)){ echo "selected='selected'"; } ?>><?php echo __("Yes","premiumpress"); ?></option>                
</select>     
      
<?php

} break;

case "language": {

$selected_lang = get_user_meta($_GET['eid'],'language',true);
$list = _ppt('languages');

?>

<select name="language" class="form-control" tabindex="5" id="user-language">

<?php 
if(!empty($list)){
	
	
	foreach( $list as $k => $lang){
		if(isset($selected_lang) && $selected_lang == $lang){ $sel ="selected=selected"; }else{ $sel =""; }
		echo "<option ".$sel." value='".$lang."'>".$CORE->GEO("get_lang_name", $lang)."</option>";
	} 							
}else{							
?>
<option value=""><?php echo __("English","premiumpress"); ?></option>
<?php } ?>
</select>
<?php

} break;

case "mobile": {

$selected_country = "";
$selected_city = "";

if(isset($_GET['eid'])){ 

	// GET USER INFO
	$user_info = get_userdata($_GET['eid']);	
	// USER COUNTRY
	$selected_country 	= $CORE->USER("get_address_part", array("country", $_GET['eid']) );
	$selected_city 		= $CORE->USER("get_address_part", array("city", $_GET['eid']) );

}
if(isset($selected_country) && $selected_country == ""){
   	$selected_country = _ppt(array('user','account_usercountry'));
}
$value = get_user_meta($uid, $name, true);
?>

      
<script>
jQuery(document).ready(function(){ 
setTimeout(function() {
   
   
	   var handleChange = function() {    
	   jQuery("#mobilenum-input").val(iti.getNumber());
	   }
	   
		var input = document.querySelector("#mobilenum-input");
		var iti = window.intlTelInput(input, { 
		  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
		 // autoHideDialCode: false,
		  nationalMode: false,
		  <?php if($selected_country != ""){ ?>preferredCountries: [ "<?php echo $selected_country; ?>" ], <?php } ?>
		   
		});
	
		input.addEventListener('change', handleChange);
		input.addEventListener('keyup', handleChange);
		 
		jQuery(".iti__country-list li").click(function(e) {				 
			jQuery("#mobilenum-input").val( '+' + jQuery(this).data('dial-code') ); 
			
		});
	
	},5000);
	
}); 
 </script>
<input name="mobile" type="text" class="form-control" id="mobilenum-input" value="<?php echo $value; ?>" />

<?php

} break;

case "backgroundimg": {

?>

     
  
<?php ?>   
      

<div class="small mb-3">
<?php echo __("Upload your own artwork","premiumpress"); ?> (1300px / 200px)
</div>
<div class="mb-4">
 <?php echo $CORE->MEDIA("customUploadForm", "userbg"); ?> 
</div>            
<div class="small mb-3">
<?php echo __("or select a default display image.","premiumpress"); ?>
</div>
  
  
      <div style="max-height:600px; overflow-y:scroll">
      <div class="container">
      <div class="row">
      <?php

$lst_backgrounds = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14);

$currentimg = get_user_meta($uid, "backgroundimg", true);

foreach($lst_backgrounds as $k ){

$defaultimg = DEMO_IMG_PATH."backgroundimages/".$k.".jpg";
 
 

?>
      <div class="col-md-6 col-lg-4 text-center p-2">
        <figure>
          <img src="<?php if(_ppt(array('bgimg', $k)) == ""){ echo $defaultimg; }else{ echo _ppt(array('bgimg', $k )); } ?>" alt="img" class="img-fluid">
        </figure>
        <input type="radio" class="form-control"  value="<?php echo $k; ?>" name="backgroundimg" <?php if( $currentimg == $k){ echo "checked=checked"; } ?> style="width: 20px; margin:auto;">
      </div>
      <?php } ?>
    </div>
    </div>
    </div>
 
        
<?php

} break;


default: {
?>

<label> <?php echo $data['title']; ?></label>
<?php

} break;
	

}


}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function LOAD($type){ global $CORE, $CORE_UI, $userdata; 
 
$RTL = 0;
if($CORE->GEO("is_right_to_left", array() )){ 
	$RTL = 1;
}

if(is_admin()){
	$GLOBALS["adminarea"] = 1;
}
	$GLOBALS["theme-".THEME_KEY] = 1;

switch($type){

	case "js": {
	
		$js = array();
		
		foreach($CORE_UI->scripts as $k => $v){
		
		// RTL					
		if(!in_array($RTL,$v['rtl'])){
			continue;
		}
		
		// REQUIRED GLOBALS
		$canContinue = 1;
		if(!empty($v['globals'])){
				$canContinue = 0;
				foreach($v['globals'] as $r){  
					if(isset($GLOBALS[$r]) ){
						$canContinue = 1;
					}
			}
		}
		if(!$canContinue){ continue; }
					
		// SET PATH
		$js[$k] 	=  	CDN_PATH.$v['path']; 
		}
		
		return $js;
	
	} break;

	case "css": {
		
		$css = array();  
		 
		// INCLUDE STYLES
		foreach($CORE_UI->styles as $k => $v){
		 	
			// RTL					
			if(!in_array($RTL,$v['rtl']) && ( !isset($v['testing']) && !isset($GLOBALS['flag-testing']) ) ){
				continue;
			}
			
			// FOR TESTING
			if(isset($v['testing']) && !isset($GLOBALS['flag-testing']) ){
				continue;
			 
			// REQUIRED GLOBALS
			}elseif(!empty($v['globals'])){
				$canContinue = 0;
				foreach($v['globals'] as $r){  
					if(isset($GLOBALS[$r]) ){
						$canContinue = 1;
					}
				}
				
				if(!$canContinue){ continue; }
			}
			 
								
			// SET PATH
			$css[$k] 	=  	CDN_PATH.$v['path']; 
			}
			
			return $css;
			
			
		} break;

}

}
		
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function FIELD($id, $data = array(), $eid= ""){ global $CORE, $CORE_UI, $userdata, $post; 

	
	$key = $id;
	$fname = "";
	if(is_array($id)){	
	$prefix 	= $id[0];
	$key 		= $id[1];	
	$fname 		= "".$id[0]."[".$key."]";
	}
	
	
	$value = "";
	if(isset($data['default'])){
	$value = $data['default'];
	}
	
	if(is_numeric($eid) && $eid > 0 ){ 	
	$value = get_post_meta($eid, $key, true); 
	} 
	
	switch($data['type']){
	
		case "text": {
		?>
		
        <div class="<?php if(isset($data['css'])){ echo $data['css'];  }else{?>col-md-6 mb-2<?php } ?> field_wrap_<?php echo $prefix."_".$key; ?>">
		<label><?php echo $data['name']; ?></label>
		
		 <input name="<?php echo $fname; ?>" class="form-control"  type="text" value="<?php echo $value; ?>">
		</div>
        
		<?php
		} break;
		
		case "textarea": {
		?>
		
        <div class="<?php if(isset($data['css'])){ echo $data['css'];  }else{?>col-md-6 mb-2<?php } ?> field_wrap_<?php echo $prefix."_".$key; ?>">
		<label><?php echo $data['name']; ?></label>
		<textarea name="<?php echo $fname; ?>" class="form-control"><?php echo $value; ?></textarea> 
		</div>
        
		<?php
		} break;
		
		case "date": {
		?>
		
        <div class="<?php if(isset($data['css'])){ echo $data['css'];  }else{?>col-md-6 mb-2<?php } ?> field_wrap_<?php echo $prefix."_".$key; ?>">
        
        <label><?php echo $data['name']; ?></label>
        
        <div> 
        
        	<div class="input-group form-group position-relative date mb-3 ppt-datepicker" data-target="#<?php echo $key; ?>-date" id="<?php echo $key; ?>-date">
		 	<input name="<?php echo $fname; ?>" class="form-control"  type="text" value="<?php echo $value; ?>">
        	<span class="input-group-addon" style="z-index: 100;"><span class="fal fa-calendar" style="top:15px;"></span></span>
			</div>
        
        </div>
        </div>
		<?php
		} break;
		
		case "hidden": {
		?>
		
        <div class="<?php if(isset($data['css'])){ echo $data['css'];  }else{?>col-md-6 mb-2<?php } ?> field_wrap_<?php echo $prefix."_".$key; ?>" style="display:none;">
		<label><?php echo $data['name']; ?></label>
		
		 <input name="<?php echo $fname; ?>" class="form-control"  type="text" value="<?php echo $value; ?>">
		</div>
        
		<?php
		} break;
		
		case "select": {
		?>
         <div class="col-md-6  mb-2 field_wrap_<?php echo $prefix."_".$key; ?>">
        <label><?php echo $data['name']; ?></label>
        
   		<select name="<?php echo $fname; ?>" class="form-control" id="field_<?php echo $prefix."_".$key; ?>">
          <?php if(isset($data['values']) && is_array($data['values']) ){ 
			foreach($data['values'] as $k => $v){ ?>
          <option value="<?php echo $v['id']; ?>" <?php if($value == $v['id']){ echo "selected=selected"; } ?>> <?php echo $v['name']; ?> </option>
          <?php } } ?>
        </select>
        </div>
		<?php
		} break;

		case "seperator": {
		?>
		<div class="col-12 mb-4">
		<div id="d" class="nav-tab-wrapper">
		<a class="nav-tab nav-tab-active" href="#"><?php echo $data['name']; ?></a>
		</div>
		</div>
		<?php
		 
		} break;	
	}
	
}	 	
		
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function RATING($id, $data = array()){ global $CORE, $CORE_UI, $userdata, $post;

		
		switch($id){
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "comment": {
		
				if(!isset($data['uid'])){
					$data['uid'] = "0";
				}
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['text'])){
					$data['text'] = "amazing place to visit";
				}				 
				if(!isset($data['time'])){
					$data['time'] = "2 days ago";
				}
				
				if(!isset($data['size'])){
					$data['size'] = "sm";
				} 		
				
				$data_args = array( 
				 	
					"css" 			=> $data['css'],
								
					"uid" 			=> $data['uid'],
					
					"size" 			=> $data['size'],
					
					"text" 			=> $data['text'],
					"time" 			=> $data['time'], 
					  
					 			
				);
				
				$imgsize = "xs";
				if($data_args['size'] == "lg"){
				$imgsize = "sm";
				}
		
		
		ob_start();
		?>
        
        
        
 <div class="_block position-relative ppt-comment-rating <?php echo $data_args['css']; ?> size-<?php echo $data_args['size']; ?>">

<?php /* <div class="bg-pattern-small" data-bg="<?php echo CDN_PATH; ?>images/pattern/6.svg"></div>
*/ ?>
 
<div class="d-flex">
	
    <div>
    <div class="_icon">
    <?php echo $CORE_UI->AVATAR("user", array("size" => $imgsize, "uid" => $data_args['uid'], "css" => "rounded-circle float-left mr-2", "online" => 0)); ?>
    </div>
    </div>
    <div class="ml-lg-2"> 
 	<div class="_text"><?php echo $data_args['text']; ?></div> 
    <div class="_time"><?php echo $data_args['time']; ?></div> 
    
    </div>

</div>
      
</div>
        
    
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	 
		
		} break;
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "score": {
		
				if(!isset($data['total'])){
					$data['total'] = "4";
				}
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				if(!isset($data['result'])){
					$data['result'] = "";
				}else{
					
					
					if($data['total']  == 0){
					$rg = 0;
					$txt = __("No Reviews","premiumpress");
					}else{
					$rg = 6;
					$txt = __("Bad","premiumpress");					
					}
					
					if($data['total'] >= 2){
					$txt = __("Not Good","premiumpress");
					}
					if($data['total'] >= 3){
					$txt = __("Good","premiumpress");
					}
					if($data['total'] >= 4){
					$txt = __("Very Good","premiumpress");;
					}
					if($data['total'] == 5){
					$txt = __("Awesome","premiumpress");
					} 
					
					if($data['result'] > 5){
					$data['result'] = 5;
					}
				
				}
				 
				if(!isset($data['reviews'])){
					$data['reviews'] = "2";
				}
				 	 
				
				if(!isset($data['size'])){
					$data['size'] = "sm";
				} 		
				
				$data_args = array( 
				 				
					"total" 		=> $data['total'],
					
					"reviews" 		=> $data['reviews'],
					"result" 		=> $data['result'], 
					 					
					 "css" 			=> $data['css'],  
					 
					"size" 			=> $data['size'],  
					 			
				);
		
		
		ob_start();
		?>
        
        <?php if($data_args['size'] == "xs"){ ?>
        
             <div class="ppt-score-rating-xs d-flex rounded p-2 small rating-<?php echo round($data_args['total']); ?>">
            
             <?php /* if($data_args['result'] == 1 && $data_args['total'] > 0){ ?>
             <span class="mr-2"><?php if($data_args['total'] == 0){  }else{ echo $data_args['result']; } ?> <i class="fal fa-comment-alt-lines"></i></span>
             <?php } */ ?>
             <span>
             	<span class="_rating"><?php if($data_args['total'] == 0){ echo "-"; }else{ echo number_format($data_args['total'],1); } ?></span>
             </span> 
          
             </div> 
        
        
        <?php }else{ ?>
        
        <span class="ppt-score-rating size-<?php echo $data_args['size']; ?> <?php echo $data_args['css']; ?> rating-<?php echo round($data_args['total']); ?>">
         
         <?php if($data_args['result'] == 1 && $data_args['total'] == 0){ ?>
           
       
       <?php }elseif($data_args['result'] == 1 && $data_args['total'] > 0){ ?>
        
        <span><?php echo $txt; ?><em><?php echo $data_args['reviews']; ?> <?php if($data_args['reviews'] == 1){ echo __("review","premiumpress"); }else{ echo __("reviews","premiumpress"); } ?></em>
       
        
        </span>
        
		<?php } ?>
        
        <strong><?php echo str_replace("0.0","-",number_format($data_args['total'],1)); ?></strong> 
        
     
     
        </span>
        <?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	 
		
		} break;
		

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "stars": {
		  
				
				if(!isset($data['total'])){
					$data['total'] = "4";
				}
				if(!isset($data['total_show'])){
					$data['total_show'] = 1;
				}
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['reviews'])){
					$data['reviews'] = "";				
				}
				if(!isset($data['reviews_show'])){
					$data['reviews_show'] = 0;				
				}
				
				if(!isset($data['bg'])){
					$data['bg'] = "";
				}
				
				if(!isset($data['color'])){
					$data['color'] = "text-warning";
				}							
				if(!isset($data['icon'])){
					$data['icon'] = "fa fa-star";
				}
				
				if(!isset($data['size'])){
					$data['size'] = "sm";
				}
				
				if(!isset($data['tooltip'])){
					$data['tooltip'] = 1;
				}
				
				if(!isset($data['short'])){
					$data['short'] = 0;
				} 			
				
				$data_args = array( 
				 				
					"total" 		=> $data['total'],
					"total_show" 	=> $data['total_show'],
					
					"reviews_show" 	=> $data['reviews_show'], 
					"reviews" 		=> $data['reviews'], 
					
					"css" 			=> $data['css'],  					
					"icon" 			=> $data['icon'],					
					"size" 			=> $data['size'],
					"color" 		=> $data['color'],
					 "bg" 			=> $data['bg'], 
					 
					 "tooltip" 		=> $data['tooltip'],
					 
					 "short" 		=> $data['short'],
					 			
				);
				
				
				if($data_args['total'] > 5){
				$data_args['total'] = 5;
				}
	 
		
		ob_start();
		?>
   
        <?php if($data_args['tooltip']== 1){ ?>
       <div class="badge_tooltip" data-direction="top">
		<div class="badge_tooltip__initiator"> 
	 <?php } ?>
	
    
        <span class="ppt-star-rating size-<?php echo $data_args['size']; ?> <?php echo $data_args['css']; ?>">        
        <div class="d-flex align-items-baseline <?php if($data['reviews'] == 0){ ?>opacity-2<?php } ?>">
        
          <?php if($data_args['short']== 1){ ?>
          <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] > 0){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
          <?php }else{ ?>
           
         <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] > 0){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
         <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] >= 2){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
         <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] >= 3){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
         <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] >= 4){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
         <div class="<?php echo $data_args['bg']; ?> <?php if($data_args['total'] >= 5){ ?>text-warning<?php } ?>"><div class="svg-icon"><?php echo $CORE_UI->icons_svg['star']; ?></div></div>
       	<?php } ?>
        
        
        <div class="d-flex rating-extras">
        
        <?php if($data_args['total_show'] > 0 && $data_args['reviews'] > 0){ ?>
        <div class="total mx-1 <?php if($data['bg'] == ""){ ?>text-warning<?php } ?> text-600"><?php echo number_format($data_args['total'],1); ?></div>
        <?php } ?>
        
        
        <?php if($data_args['reviews_show'] > 0){ ?>
        <div class="reviews">(<?php echo str_replace(".0","",number_format($data_args['reviews'],1)); ?>)</div>
        <?php } ?>
        
        </div>
         </div>
        
        </span>
        
        
         <?php if($data_args['tooltip']== 1){ ?>
         
        </div>  
		<div class="badge_tooltip__item text-center">
		<?php echo str_replace("%d",$data_args['reviews'], str_replace("%s",$data_args['total'], __("%s stars based on %d reviews.","premiumpress"))); ?>
        </div>
        
	  </div>
      
	<?php } ?>
        
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
		
		} break;
	 
		} 

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	
		
		
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function PLACEHOLDER($id, $data = array()){ global $CORE, $CORE_UI, $userdata, $post;

		
		switch($id){

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "admin-listings": {
		ob_start();
		?><div class="ph-item pt-3 card-mobile-transparent ">
        
        	<div class="ph-col-2">
                    <div class="ph-picture-small"></div>
                </div>

                <div>
                    <div class="ph-row">
                    <div class="ph-col-8 big"></div>
                    
                    <div class="ph-col-4 empty"></div>
                    <div class="ph-col-12 big"></div>
                     <div class="ph-col-12 big"></div>
                 
                </div>

            </div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
		
		} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "list": {
		ob_start();
		?><div class="ph-item card-mobile-transparent"> 
        
        <div class="ph-col-4 pl-0 m-0 py-2 ml-2" style="max-width:300px;">
                    <div class="ph-picture"></div>
                </div>

                <div>
                    <div class="ph-row mt-3">
                    <div class="ph-col-8 big"></div>
                    <div class="ph-col-4 empty"></div>
                    
                    <div class="ph-col-8 big"></div>
                    <div class="ph-col-12 empty hide-mobile"></div>
                    <div class="ph-col-12 empty hide-mobile"></div>
                        <div class="ph-col-6 hide-mobile"></div>
                        <div class="ph-col-6 empty hide-mobile"></div>
                        <div class="ph-col-2 hide-mobile"></div>
                        <div class="ph-col-10 empty hide-mobile"></div>
                      
                        <div class="ph-col-12 hide-mobile"></div>
                    </div>
                </div>

            </div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
		
		} break;
				
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "grid": {
		ob_start();
		?>
        <div class="ph-item card-mobile-transparent">
<div class="ph-picture hide-mobile"></div>
                        <div class="ph-col-12">
                            
                            <div class="ph-row">
                                <div class="ph-col-8 big"></div>
                            
                                <div class="ph-col-12"></div>
                            </div>
                        </div>
                     
                        <div>
                            <div class="ph-row">
                                <div class="ph-col-12"></div>
                                <div class="ph-col-2"></div>
                                <div class="ph-col-10 empty"></div>
                                <div class="ph-col-8 big hide-mobile"></div>
                                <div class="ph-col-4 big empty hide-mobile"></div>
                                <div class="ph-col-2 empty hide-mobile"></div>
                             
                            </div>
                        </div>
                    </div>		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
		
		} break;
		
		
		} 

}	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function NUMBERS($id, $data = array()){ global $CORE, $CORE_UI, $userdata, $post;

		
		switch($id){
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


		
		case "data_chart_small": {
		
		
				 
				if(!isset($data['title'])){
					$data['title'] = "Title Here";
				}
				
				if(!isset($data['num'])){
					$data['num'] = "100000";
				}
				
				if(!isset($data['data'])){
					$data['data'] = "";
				}
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['bgimg'])){
					$data['bgimg'] = "";
				}
				
				if(!isset($data['color'])){
					$data['color'] = "1";
				}	
							
				if(!isset($data['icon'])){
					$data['icon'] = "fal fa-shield-check";
				}				
				$key = "canvus_".rand(0,999).rand(0,999);		
				
				$data_args = array(
				 	
					"title" 		=> $data['title'],					
					"num" 			=> $data['num'], 					
					"data" 			=> $data['data'],
					"data_labels" 	=> $data['data_labels'],
					
					"icon" 			=> $data['icon'], 
					"css" 			=> $data['css'],  	
					
					"color" 		=> $data['color'],  	
					
							
				);
		
		
		ob_start();
				?>
                
  <div class="card  card-numbers style4 text-left <?php echo $data['css']; ?>"> 
  <?php if($data['bgimg'] != ""){ ?>
  <div class="bg-image" data-bg="<?php echo $data['bgimg']; ?>" style="background-position: bottom;"></div> 
  <?php } ?>
    <div class="d-flex justify-content-between p-3 " style="z-index: 1;">    
    <div>    
    	<div class="_title text-primary"><?php echo $data_args['title']; ?></div>        
        <div class="_num"><?php  if(is_numeric($data_args['num'])){ echo number_format($data_args['num']); }else{ echo $data_args['num']; } ?></div> 
        
        <a href="<?php echo $data['btn_link']; ?>" class="btn btn-sm btn-system mt-2 shadow-sm"><?php echo $data['btn_text']; ?></a>       
    </div>      
    <i class="<?php echo $data_args['icon']; ?> fa-2x float-right text-dark"></i>      
    </div>     
<div style="height:60px; z-index: 1;">
<canvas id="<?php echo $key; ?>"></canvas>
</div>
    
    
</div>


<script>

jQuery(document).ready(function() { 

var ctx = document.getElementById('<?php echo $key; ?>').getContext('2d');

var gradient = ctx.createLinearGradient(0, 0, 0, 400);
 
gradient.addColorStop(0, 'rgba(35,133,177,1)');
gradient.addColorStop(1, 'rgba(255,255,255,1)'); 

new Chart(document.getElementById("<?php echo $key; ?>"), {
  type: 'line',
  data: {
    labels: [<?php echo $data_args['data_labels']; ?>],
    datasets: [{ 
	
        data: [<?php echo $data_args['data']; ?>],
        label: "<?php echo $data_args['title']; ?>",
        borderColor: "#2371b1",
		backgroundColor: gradient,
		
        fill: false
      }, 
    
    ]
  },
   options: {
   responsive: true,
    maintainAspectRatio: false, 
				title: {
					display: false,
				 
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
		 legend: {
		 	display:  false,
                labels: {
                    fontColor: "white",
                    fontSize: 18
                }
            },
				scales: {
					xAxes: [{
						display:  false,
						 fontColor: "white",
						scaleLabel: {
							display: false,
							labelString: 'Month',
							 
						},
						ticks: {
                    fontColor: 'white'
                },
					},
					
					],
					yAxes: [{
						display: false,
						scaleLabel: {
							display: false,
							labelString: 'Value',
							fontColor: "white",
						}
					}]
				},
				},
 });


});
</script>

                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
		
		} break;
		
	///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		
		case "account": {
		
		 
			if(!isset($data['css'])){
				$data['css'] = "";
			}
				
			if(!isset($data['graph'])){
					$data['graph'] = 0;
			}
			
			$data_args = array(
				 	
				"graph" => $data['graph'],
					
				"css" => $data['css'], 
			
			);
			
			$Hour = date('G', strtotime( date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . "+1 minute")) ));
			
			if ( $Hour >= 5 && $Hour <= 11 ) {
				$d = __("Good Morning","premiumpress");
			} else if ( $Hour >= 12 && $Hour <= 18 ) {
			   $d = __("Good Afternoon","premiumpress");
			} else if ( $Hour >= 19 || $Hour <= 4 ) {
			   $d = __("Good Evening","premiumpress");
			}
			
			
		ob_start();
				?>
                
<div class="card card-numbers text-left card-mobile-transparent">


<div class="bg-primary p-2 p-md-4 text-white mobile-negative-margin-x">

     <div class="d-flex">
       
            <?php if(in_array(THEME_KEY, array("da","es"))){ ?>
            
           <a href="<?php if(isset($GLOBALS['singleListingLinkMain']) && $GLOBALS['singleListingLinkMain'] != ""){ echo $GLOBALS['singleListingLinkMain']; }else{ echo "#"; } ?>">
           
               <?php echo $CORE_UI->AVATAR("user", array("size" => "xxl", "uid" => $userdata->ID, "css" => "rounded shadow-sm float-left mr-2 mr-md-4", "online" => 0, "link" => 0)); ?>
           </a>
           
            <?php }else{ ?>
            <a href="javascript:void(0);" onclick="showdetails('photo');"> 
            
            <?php echo $CORE_UI->AVATAR("user", array("size" => "xxl", "uid" => $userdata->ID, "css" => "rounded shadow-sm float-left mr-2 mr-md-4", "online" => 0, "link" => 0)); ?>
            
            </a>
            <?php } ?>
        
        <div class="ml-3">
        
        <h3 class="title text-600 mb-3 mt-2" style="letter-spacing: -.05em!important;">  <?php 
		
		echo $d;
		
		$name = $CORE->USER("get_first_name",$userdata->ID);
		if(strlen($name) > 3){
		echo ", ".$name;
		}
		
		?>!</h3>
        
        <p class="tx-white-7 mb-1 mobile-text-12">
<?php echo str_replace("%s",'<b><a href="'._ppt(array('links','contact')).'" class="text-warning">'.__("contact us","premiumpress").'</a></b>',__("This is your members area where you can manage your account. If you have any questions please %s anytime.","premiumpress")); ?>
</p> 
        
        
       </div>
 </div>
 
 </div>
 
 
<div class="card-footer pt-0 pb-0 text-center bg-white border-bottom mobile-mb-2 mobile-negative-margin-x">
                                <div class="row">
                                
									<div class="col-4 pt-3 pb-3 border-right">
                                    
<?php if( in_array(THEME_KEY, array("da")) && isset($GLOBALS['flag-account-links']['friends'])  ){ 

 ?>
<a href="javascript:void(0);" onclick="SwitchPage('friends');" class="text-decoration-none text-black"><h3 class="mb-1 count-friends text-700">0</h3><span class="text-uppercase small"><?php echo __("friends","premiumpress"); ?></span></a>

<?php }else{ 

// COUNT ALL NOTIFICATIONS
$total_notify = $CORE->USER("count_get_logs", $userdata->ID); 
			

?>              
<a href="javascript:void(0);" onclick="processNotificatons()" class="text-decoration-none text-black"><h3 class="mb-1 text-700"><?php echo $total_notify; ?></h3><span class="text-uppercase small"><?php echo __("notices","premiumpress"); ?></span></a>

<?php } ?>

                                        
                                        
									</div>
									<div class="col-4 pt-3 pb-3 border-right">
										<a href="<?php echo home_url(); ?>/?s=&favs=1" class="text-decoration-none text-black"><h3 class="mb-1 text-700"><?php echo $CORE->USER("favs_count", $userdata->ID); ?></h3><span class="text-uppercase small"><?php echo __("favorites","premiumpress"); ?></span></a>
									</div>
									<div class="col-4 pt-3 pb-3">
										<a href="<?php echo home_url(); ?>/?s=&history=1" class="text-decoration-none text-black"><h3 class="mb-1 text-700"><?php echo $CORE->USER("history_count", $userdata->ID); ?></h3><span class="text-uppercase small"><?php echo __("history","premiumpress"); ?></span></a>
                                    </div>
                                </div>
                            </div>
 
<div class="card-body">

    <div class="_title">
    <div class="d-flex justify-content-between">
    
   
    <div class="badge_tooltip" data-direction="top">
		<div class="badge_tooltip__initiator"> 
	   <span class="text-600">
	   
         <a class="text-600 h5 text-dark" href="#top" onclick="SwitchPage('details');showdetails('username');"><?php echo $CORE->USER("get_username", $userdata->ID); ?></a> 
       
       </span>
		</div>
		<div class="badge_tooltip__item text-center">
		<?php echo __("Your user ID is","premiumpress"); ?> <?php echo $CORE->ORDER("format_id",$userdata->ID); ?>. <?php echo str_replace("%s", "<u>".$CORE->USER("get_joined",  $userdata->ID)."</u>", __("You joined us %s","premiumpress")); ?> </div>
	  </div> 
  
    
	<div>
    
    

	<?php  if(isset($GLOBALS['accounttype']) && strlen($GLOBALS['accounttype']['name']) > 1){ ?><a class="text-dark" href="#top" onclick="SwitchPage('details');showdetails('details');"><?php echo $GLOBALS['accounttype']['name']; ?></a> <?php } ?>
    </div> 
    
    
    
   
    </div>
    </div>
    
    
<?php


/* if(isset($GLOBALS['accounttype']['can_add']) && $GLOBALS['accounttype']['can_add'] == 1 || isset($GLOBALS['singleListingID']) && is_numeric($GLOBALS['singleListingID'])){ 

if(isset($GLOBALS['accounttype']['can_add']) && $GLOBALS['accounttype']['can_add'] == 1){
$sharelink = $CORE->USER("get_user_profile_link", $userdata->ID ); 
}else{
$sharelink = get_permalink($GLOBALS['singleListingID']);
}
 
?>


<div class="_content  border-top pt-3 mt-3">  
      
<div class="d-flex justify-content-between">
                    
            <div class=" mt-3">
            
            	<div class="d-flex"> 
                       
                <i class="fal <?php echo $CORE->LAYOUT("captions","icon"); ?> mr-3 text-primary mt-1"></i>
                
                <p class="_text mb-0">
                
                <span class="text-700"><?php echo __("My Profile Link","premiumpress"); ?></span>  
                
                </p> 
                
                </div> 
 

</div> 

<div class="text-right">            
   
  
            
	<div class="badge_tooltip mt-2" data-direction="top">
		<div class="badge_tooltip__initiator"> 
	   
       <div style="max-width:200px;" class="text-truncate">
       
       <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text js-copy-link1" data-clipboard-target="#copylink1">
          <i class="fal fa-copy cicon1"></i> 
          
          </div>
        </div>
        <input type="text" class="form-control small bg-light" id="copylink1" value="<?php echo $sharelink; ?>">
      </div> 
      
      
      
       </div>
		
        
        </div>
		<div class="badge_tooltip__item text-center"><?php echo __("This is your unique profile link. Copy and share this link online.","premiumpress"); ?></div>
	  </div> 
            
	</div> 
        
                  
</div>
 </div> 
 <script>      
jQuery(document).ready(function(){  
	
	var clipboard = new ClipboardJS('.js-copy-link1');
	clipboard.on('success', function(e) { 
	
	jQuery(".cicon1").addClass("text-600 text-warning");
	
	 alert("<?php echo __("Link saved to your clipboard.","premiumpress"); ?>");
	 
	 });
});
                         
</script> 
<?php } */ ?>

 
    <div class="_content  border-top pt-3 mt-3">    
    
    
    
    
<?php if( in_array(THEME_KEY, array("da")) && isset($GLOBALS['flag-account-links']['likes']) ){ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-stars mr-3 text-primary mt-1"></i>
                <p class="_text font-weight-bold mb-0"><?php echo  __("My Profile Likes","premiumpress"); ?></p>
            </div> 
            
            <span class="_num text-600"><a href="javascript:void(0)" onclick="SwitchPage('likes');" class="text-dark h3"><?php echo $CORE->USER("get_user_count_likes",$userdata->ID); ?></a></span>
          
        </div> 
<?php } ?>
    
<?php if( in_array(THEME_KEY, array("da","es")) ){ 

$seek2 = get_user_meta($userdata->ID,'da-seek2',true);

$count = 1; $myinterests = __("All Users","premiumpress");
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
	foreach($cats as $cat){ 
		if($cat->parent != 0){ continue; } 
	
		if($seek2 ==  $cat->term_id){ 
		$myinterests = $CORE->GEO("translation_tax", array($cat->term_id, $cat->name));
		}
	} 
} 


?> 
        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-search mr-3 text-primary mt-1"></i>
                <p class="_text font-weight-bold mb-0"><?php echo  __("I'm Interested In","premiumpress"); ?></p>
            </div> 
            
            <span class="_num"><a href="javascript:void(0)" onclick="SwitchPage('details');showdetails('details');" class="text-dark"><?php echo $myinterests; ?></a></span>
          
        </div> 
<?php } ?> 
    
    
    
    
    
<?php if( in_array(THEME_KEY, array("sp"))  ){ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-box mr-3 text-primary mt-1"></i>
                <p class="_text font-weight-bold mb-0"><?php echo  __("Delivery Address","premiumpress"); ?></p>
            </div> 
            
            <div class="text-truncate" style="max-width:300px;"><a href="javascript:void(0)" onclick="SwitchPage('details');showdetails('address');" class="text-dark"><?php echo $CORE->USER("get_address",$userdata->ID); ?></a></div>
          
        </div> 
<?php } ?>
    
    
    
    
        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">            
            <div class="d-flex mt-2">            
                <i class="fal fa-envelope mr-3 text-primary mt-1"></i>
                
                <p class="_text mb-0"><span class="text-700"><?php echo __("My Email","premiumpress"); ?></span>  </p>
                
            </div>             
            <span>            
            
	<div class="badge_tooltip mt-2" data-direction="top">
		<div class="badge_tooltip__initiator"> 
	   <div style="max-width:200px;" class="text-truncate"><a onclick="SwitchPage('details');showdetails('details');" href="javascript:void(0);" class="text-dark"><?php echo $CORE->USER("get_email",  $userdata->ID); ?></a></div>
		</div>
		<div class="badge_tooltip__item text-center"><?php echo __("Notification emails will be sent here.","premiumpress"); ?></div>
	  </div> 
            
            </span>          
 </div>     
    
    
    
    

    
    
    
    
    
    
    
<?php
/*
if(_ppt(array('mem','enable')) == "1" ){


$mymem = $CORE->USER("get_user_membership", $userdata->ID);
 
// DAYS LEFT 
$date = "";  $duration = 0;
if(isset($mymem['expired']) && $mymem['expired'] == 1){
	$date = __("expired","premiumpress");
}elseif(isset($mymem['expired'])) {
	$hh = $CORE->date_timediff($mymem['date_expires']);	
	$date = $hh['string-small']."<span>".__("remaining","premiumpress")."</span>";
	
	$duration_days = _ppt('mem'.$mymem['key'].'_duration');
	if(!is_numeric($duration_days)){
	$duration_days = 30;
	}
	if($duration_days == 0){ 
	$duration  = 0;
	}else{
	$duration = $hh['days-left']/$duration_days*100;			 
	}
	
	
}else{

$date = "<a href='javascript:void(0);' class='btn btn-primary shadow-sm' onclick='processUpgrade();'>".__("Upgrade Now","premiumpress")."</a>"; 
}


?>
    
        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
             
                <?php if(isset($mymem['expired']) ){ //&& $mymem['expired'] == 1  ?> 
                
                
                <i class="fal <?php echo $mymem['icon']; ?> mr-3 mt-1 text-primary"></i>
                
                <div>
                <p class="_text font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="<?php echo __("My Membership","premiumpress"); ?>"><a href="javascript:void(0)" class="text-dark" onclick="SwitchPage('membership');"><?php echo trim($mymem['name']); ?></a></p>
                </div>
                <?php }else{ ?>
                
                <i class="fal fa-id-card-alt mr-3 text-primary"></i>
                <p class="_text font-weight-bold mb-0"><?php echo __("No Membership","premiumpress"); ?> </p>
                
                <?php } ?>
                
                
            </div> 
            
            <span class="_num">
			
			<?php echo $date; ?>
            
            <?php if($duration > 0){ ?>
                <div class="w-100 btn-block">
                <div class="progress mt-1 mb-0" style="height: 7px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $duration; ?>%" aria-valuenow="<?php echo $duration; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div></div>
            <?php } ?>
               
            
            
            </span> 
            
         
        </div>    
        

<?php }  */  ?>


<?php if(isset($GLOBALS['flag-account-links']['comments'])){ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-comment mr-3 text-primary mt-1"></i>
                <p class="_text font-weight-bold mb-0"><?php echo __("My Comments","premiumpress"); ?></p>
            </div> 
            
            <div class="_num"><a onclick="SwitchPage('comments');" href="javascript:void(0);" class="text-dark"><span class="count-all-comments">0</span> <?php echo __("comments","premiumpress"); ?>  </a></div>
          
        </div> 


<?php } ?>

<?php if( in_array(THEME_KEY, array("vt","cm")) || $CORE->LAYOUT("captions","offers") == ""){ }else{ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-comment-alt-lines mr-3 text-primary mt-1"></i>
                <p class="_text font-weight-bold mb-0"><?php echo str_replace("%d", $CORE->LAYOUT("captions","offers"), __("My %d","premiumpress")); ?></p>
            </div> 
            
            <div class="_num"><a href="javascript:void(0)" onclick="showoffers('all');" class="text-dark"><span class="count-pending">0</span> <?php echo strtolower($CORE->LAYOUT("captions","offers")); ?> </a></div>
          
        </div> 
<?php } ?>


<?php if( in_array(THEME_KEY, array("at")) && isset($GLOBALS['accounttype'])){ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-hammer mr-3 text-primary"></i>
                <p class="_text font-weight-bold mb-0">
                
                <?php if($GLOBALS['accounttype']['key'] == "user_em"){ ?>
                
                <?php  echo __("Sold Auctions","premiumpress"); ?>
                
                <?php }else{ ?>
                 <?php  echo __("Auctions Won","premiumpress"); ?>
                
                <?php } ?>
                
                </p>
            </div> 
            
            <div class="_num"><a href="javascript:void(0)" onclick="showoffers(3);" class="text-dark"><span class=" count-approved">0</span> <?php  echo __("Items","premiumpress"); ?></a></span></div>
          
        </div> 
        
<?php } ?>




<?php if(isset($GLOBALS['flag-account-links']['sellspace'])){ ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-ad mr-3 text-primary"></i>
                <p class="_text font-weight-bold mb-0"><?php  echo __("Advertising","premiumpress"); ?></p>
            </div> 
            
            <div class="_num"><a href="javascript:void(0)" onclick="SwitchPage('sellspace');" class="text-dark"><span class="count-advertising">0</span> <?php  echo __("ads","premiumpress"); ?></a></span></div>
          
        </div> 

<?php } ?>






<?php 


if(isset($GLOBALS['flag-account-links']['friends'])){ $friends = $CORE->USER("get_subscribers_followers", $userdata->ID); ?>

        <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
            
            <div class="d-flex mt-2">
                <i class="fal fa-users mr-3 text-primary"></i>
                <p class="_text font-weight-bold mb-0"><?php  echo __("Friends","premiumpress"); ?></p>
            </div> 
            
            <div class="_num"><a href="javascript:void(0)" onclick="SwitchPage('friends');" class="text-dark"><span class="count-friends">0</span> <?php if(count($friends) ==1){  echo __("friend","premiumpress");  }else{  echo __("friends","premiumpress"); } ?></a></span></div>
          
        </div> 

<?php } ?>

<?php

if(_ppt(array("cashout","enable")) != "0"){

// 1. GET THE USERS CREDIT
$user_credit = get_user_meta($userdata->ID,'ppt_usercredit',true);
if(!is_numeric($user_credit) ){ $user_credit = 0; } 

$invoices = $CORE->ORDER("count_invoices_by_userid", $userdata->ID);

?>
 
    
        <div class="d-flex justify-content-between">
            
            <div class="d-flex mt-2">
                <i class="fal fa-credit-card-blank mr-3 text-primary"></i>
                <p class="_text font-weight-bold mb-0"><a href="javascript:void(0)" class="text-dark" onclick="SwitchPage('cashout');"><?php echo __("My Credit","premiumpress"); ?></a></p>
            </div> 
            
            <div>
            <?php if($invoices > 0){ ?>
            <span class="mt-2 hide-mobile"><a onclick="SwitchPage('orders');" href="javascript:void(0);" class="text-dark mr-3 small"><u><?php echo $invoices; ?> <?php echo __("Inovices","premiumpress"); ?></u></a></span>
            <?php } ?>
            
            <span class="_num mt-2 <?php if($user_credit < 0){ echo "text-danger"; } ?> text-600" data-amount="<?php echo $user_credit; ?>"><?php  echo hook_price($user_credit); ?></span>
          	
            </div>
            
        </div>  
    
<?php } ?>
    
    
</div>

   
    
 
</div> </div>


                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
		
		} break;
		
		
		
		}
}

		

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function IMAGES($id, $data = array()){ global $CORE, $CORE_UI, $userdata, $post;

		
		switch($id){


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "image": {
			 
				$data['img'] = "";
				
				// DEFAULTS
				if(isset($data['src']) && strlen($data['src']) > 2){
				
					$data['img'] = $data['src'];
					
				}elseif(isset($data['uid']) || isset($data['uid']) &&  $data['uid'] < 1){
				
					$data['name'] = $CORE->USER("get_username", $data['uid'] );
					$data['img'] = $CORE->USER("get_avatar", $data['uid']);
					if(isset($data['link']) && $data['link'] != "0" ){					 
					$data['link'] 	= $CORE->USER("get_user_profile_link", $data['uid'] );		
					}
					
				}elseif(!isset($data['pid']) || isset($data['pid']) &&  $data['pid'] < 1){
					
					if(isset($data['pid'])){
					$data['img'] = $this->images[str_replace("0.","",$data['pid'])];
					}else{					
					$data['pid'] = 0;
					} 
					
					
				}else{
					
					$data['name'] = $CORE->USER("get_username", $data['pid'] );
					$data['img'] = do_shortcode("[IMAGE pid=".$data['pid']." pathonly=1]");
					if(isset($data['link']) && $data['link'] != "0" ){					 
					$data['link'] 	= get_permalink($data['pid']);		
					}			 
					
				}
				
				if(!isset($data['size'])){
					$data['size'] = "";
				}
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				 
				if(!isset($data['link'])){
					$data['link'] = "#";
				}
				 
				if(!isset($data['name'])){
					$data['name'] = "image";
				}
				
				if(!isset($data['text'])){
					$data['text'] = "";
				}
				
				if(!isset($data['tooltip'])){
					$data['tooltip'] = "";
				} 
				
				
				$data_args = array(
				 	
					"text" 	=> $data['text'],
					
					"name" 	=> $data['name'], 
					"img" 	=> $data['img'], 
					"link" 	=> $data['link'],
					
					"size" 	=> $data['size'], 
					"css" 	=> $data['css'], 
					 
					"tooltip" => $data['tooltip'],
					
					"pid" 	=> $data['pid'], 
					 
				
				);
			
				ob_start();
				?>
                
                <?php if($data_args['size'] == ""){ ?>
                <img data-src="<?php echo $data_args['img']; ?>" alt="<?php echo $data_args['name']; ?>" class="lazy img-fluid <?php echo $data_args['css']; ?>" />
                <?php }else{ ?>
				
                <<?php if($data_args['link'] == "0"){ echo "span"; }else{ echo "a"; } ?> href="<?php echo $data_args['link']; ?>" class="ppt-image ppt-image-<?php echo $data_args['size']; ?>  <?php echo $data_args['css']; ?>" <?php if($data_args['tooltip'] == 1){ ?>data-toggle="tooltip" data-placement="top" title="<?php echo $data_args['name']; ?>"<?php } ?>>
                
                <div class="_wrap bg-image" data-bg="<?php echo $data_args['img']; ?>" data-pid="<?php echo $data_args['pid']; ?>">
                
                 <?php if($data_args['text'] != ""){ ?> <div class="bg-gradient"></div> <div class="_txtbit"><?php echo $data_args['text']; ?></div> <?php } ?>
                 
                </div> 
                           
                </<?php if($data_args['link'] == "0"){ echo "span"; }else{ echo "a"; } ?>> 
                <?php } ?>
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
			
			
			
			} break;



		}
}

	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function ICONS($id, $data = array()){ global $CORE, $CORE_UI, $userdata, $post;

		
		switch($id){
		
			case "list": {			
			
			return $this->icons;
			
			} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "online": {
			
				if(!isset($data['uid'])){
					$data['uid'] = 0;					
				}
				
				if($data['uid'] > 0 && !$CORE->USER("get_online_status", $post->post_author)){ 
				return;			
				}
				
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['ripple'])){
					$data['ripple'] = "1";
				}
				
				
				$text = __("Online Now","premiumpress");
				
				$data_args = array(
				 	
					"uid" => $data['uid'],
					 
					"size" => $data['size'], 
					
					"style" => $data['style'], 
					
					"ripple" => $data['ripple'],
					
					"text"	=> $text,
					
					"css" => $data['css'], 
				
				);
				ob_start();
				?>
                
                <div class="ppt-icon-onlinebar _style<?php echo $data_args['style']; ?> size-<?php echo $data_args['size']; ?> <?php echo $data_args['css']; ?>">
                
                    <div class="_wrap">
                    
                          <span class="ppt-icon-online">
                          <?php if($data_args['ripple'] == 1){ ?>
                          <span class="ripple"></span>
                          <span class="ripple"></span>
                          <span class="ripple"></span>
                          <?php } ?>
                          </span>
                          
                          <span><?php echo $data_args['text']; ?></span>
                    
                    </div> 
                
                </div>
                
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;
		 
			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "social": {
			 
			
				
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['uid'])){
					$data['uid'] = 0;					
				}
				
				if(!isset($data['website'])){
					$data['website'] = 0;					
				}
				
				if(!isset($data['footer'])){
					$data['footer'] = 0;					
				}
				if(!isset($data['header'])){
					$data['header'] = 0;					
				}
				
				if(!isset($data['size']) || isset($data['size']) && $data['size'] == ""){
					$data['size'] = "md";					
				}
				
				if(!isset($data['style'])){
					$data['style'] = 1;					
				}
				
				if(!isset($data['share'])){
					$data['share'] = 0;	
				}
				
				if(!isset($data['max'])){
					$data['max'] = 10;	
				}
				
				if(!isset($data['link']) && isset($post) ){
					$data['link'] = get_permalink($post->ID);	
				}elseif(!isset($data['link'])){
					$data['link'] = "";
				}
				
				if(!isset($data['link_desc']) && isset($post)){
					$data['link_desc'] = $post->post_title;	
				}elseif(!isset($data['link_desc'])){
					$data['link_desc'] = "";
				}
				
				$data_args = array(
				 	
					"uid" => $data['uid'],
					"website" => $data['website'],
					"footer" => $data['footer'],
					
					"header" => $data['header'],
					
					"share" => $data['share'],
					 
					"style" => $data['style'],
					
					"size" => $data['size'], 
					
					"css" => $data['css'], 
					
					"max" => $data['max'],
					
					"link" => $data['link'],
					
					"link_desc" => $data['link_desc'],
				
				);
				  
				ob_start();
				?><div class="ppt-icons-social <?php if($data_args['share'] == 1){ ?>_share<?php } ?> _style<?php echo $data_args['style']; ?> size-<?php echo $data_args['size']; ?> <?php echo $data_args['css']; ?>">
                <ul>
               
                <?php $i=1; foreach($this->user_socials as $key => $social){ 
					
					if($i > $data_args['max']){ continue; }
				 	$i++;
					
					
					if($data_args['share'] == 1 && !isset($social['share']) ){ 
					continue;
					}
					

					if($data_args['share'] == 1){
					
							switch($key){
								case "facebook": {
								
								 $value = "https://www.facebook.com/sharer.php?u=".$data_args['link'];
								
								} break;
								case "linkedin": {
								
								  $value = "https://www.linkedin.com/cws/share?url=".$data_args['link'];
								
								} break;
								case "pinterest": {
								
								  $value = "https://pinterest.com/pin/create/button/?url=".$data_args['link']."&amp;description=".$data_args['link_desc'];
								
								} break;
								case "twitter": {
								  	  
									$value = "https://twitter.com/share?url=".$data_args['link']."&amp;text=".$data_args['link_desc'];	 
								  
								
								} break;						
							}
							
					}elseif($data_args['website'] == 1){
					 
						$value = trim(_ppt(array('company',$key)));
						
						if($data_args['footer'] == 1 && _ppt(array('newfooter',$key)) != ""){
						$value = trim(_ppt(array('newfooter',$key)));  
						
						}elseif($data_args['header'] == 1 && _ppt(array('newheader',$key)) != ""){
						$value = trim(_ppt(array('newheader',$key)));  
						} 
					 
						
						if(strlen($value) > 1){
							switch($key){
								case "facebook": {
								
								  if(strpos($value,"facebook.com") === false){		  
									$value = "https://www.facebook.com/".$value;		  
								  }	
								
								} break;
								case "youtube": {
								
								  if(strpos($value,"youtube.com") === false){		  
									$value = "https://www.youtube.com/".$value;		  
								  }	
								
								} break;
								case "instagram": {
								
								  if(strpos($value,"instagram.com") === false){		  
									$value = "https://www.instagram.com/".$value;		  
								  }	
								
								} break;
								case "twitter": {
								
								  if(strpos($value,"twitter.com") === false){		  
									$value = "https://www.twitter.com/".$value;		  
								  }	
								
								} break;						
							}
						}
						
						
					
					}elseif($data_args['uid'] > 1){
					$value = user_meta($data_args['uid'], $key, true);
					}else{
					$value = "#";
					}
					
					
					
					if($value == ""){ continue; }
					 
					
				?>
                 <li class="<?php echo $key; ?>">
                 <a href="<?php echo trim($value); ?>" title="<?php echo $key; ?>" class="icon-<?php echo $key; ?>" rel="nofollow" target="_blank">
                 
                 <i class="<?php echo $social['icon']; ?>"></i>
                 
                 <?php if($data_args['share'] == 1){ ?>
                 <span class="hide-mobile"><?php echo __("Share","premiumpress"); ?></span>
                 <?php } ?>
                 
                 </a></li>
                <?php } ?>
                </ul> 
                </div>
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;
		
		}
}
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function USER($id, $data = array()){ global $CORE, $CORE_UI, $userdata;

		
		switch($id){
		
			

			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "user_short": {
				ob_start();
				
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				
				if(!isset($data['style'])){
					$data['style'] = "1";
				}
				
				if(!isset($data['uid'])){
					$data['uid'] = "1";
				 
					
					$images = array(
						1 => DEMO_IMG_PATH."/rt/agent1.jpg",
						2 => DEMO_IMG_PATH."/rt/agent2.jpg",
						3 => DEMO_IMG_PATH."/rt/agent3.jpg",
					);					
					if(isset($data['style']) && is_numeric($data['style']) && isset($images[$data['style']])){
					$data['img'] = $images[$data['style']];
					}else{
					$data['img'] = $images[1];
					}
					
					$data['name'] = "John Doe";
					$data['desc'] = "London";
				}else{
					$data['img'] = $CORE->USER("get_avatar", $data['uid'] );
					$data['desc'] = $CORE->USER("get_country", $data['uid'] );
				}
				
				$data_args = array(
				 
					"css" => $data['css'], 
					
					"style" => $data['style'], 
					
					"uid" 	=> $data['uid'],					
					"img" 	=> $data['img'],
					"name"	=> $data['name'], 
					"desc"	=> $data['desc'], 
				
				);
				?>
 
            <div class="overflow-hidden ppt-user style<?php echo $data_args['style']; ?> <?php echo $data_args['css']; ?>">
            
                <figure> <a href="">
                <img src="<?php echo $data_args['img']; ?>" alt="<?php echo $data_args['name']; ?>" class="img-fluid w-100">
                </a></figure>
            <div class="bar mt-n3"></div>
                <div class="_content text-center position-relative">
         
                    <div class="_wrap position-relative py-3">
                    
                    <h4><?php echo $data_args['name']; ?></h4>
                    <p class="opacity-5"><?php echo $data_args['desc']; ?></p>
                    
                    
                    <?php if(isset($data['style']) && is_numeric($data['style']) && $data['style'] == 1 ){ ?>
                     <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "1", "size" => "md", "max" => 4)); ?>
                     <?php }elseif(isset($data['style']) && is_numeric($data['style']) && $data['style'] == 2 ){ ?>
                     <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "md", "max" => 4)); ?>
                      <?php }elseif(isset($data['style']) && is_numeric($data['style']) && $data['style'] == 3 ){ ?>
                     <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "3", "size" => "md", "max" => 4)); ?>
                     <?php } ?>
                    
                    </div>
                </div>
            
            </div>
                
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;
			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "user_card": {
			
			
				// DEFAULTS
				if(!isset($data['uid'])){
					
					$data['uid'] = 0;  
					$data['txt'] = "";
					$data['link'] = "";
					 
				}else{
				
					$data['name'] 	= $CORE->USER("get_username", $data['uid'] ); 
					$data['txt'] 	= $CORE->USER("get_desc", $data['uid']);
					$data['link'] 	= $CORE->USER("get_user_profile_link", $data['uid'] );
					
				}
				
				if(!isset($data['css'])){
					$data['css'] = "shadow-sm bg-light";
				}
				 
				
				if(!isset($data['name'])){
					$data['name'] = "John Doe";
				}
				 
				
				if(!isset($data['btn-css'])){
					$data['btn-css'] = "";
				}
			
				$data_args = array(
				
					"uid" => $data['uid'],
					 
					"name" 	=> $data['name'],
					"txt" 	=> $data['txt'],
					"link" 	=> $data['link'],
					
					"css" => $data['css'], 
					
					"btn-css" => $data['btn-css'], 
					 
				);
			
				ob_start();
				?>
              
<div class="card mb-4 mt-4 bg-light rounded p-3 <?php echo $data_args['css']; ?>">
 
    <div class="row">
    <div class="col-12"> 
    
    <?php if($CORE->USER("get_online_status", $data['uid'])){ ?>
    <?php echo $CORE_UI->ICONS("online", array("uid" => $data['uid'], "css" => "float-right inline rounded", "style" => "1", "size" => "sm" )); ?>

    <?php } ?>
    
    <h6><?php echo $data_args['name']; ?></h6>
    
    <hr />
    
    </div>
    
      <div class="col-md-2 text-center"> 
      
       <?php echo $CORE_UI->AVATAR("user", array("size" => "xl", "uid" => $data['uid'], "css" => "rounded-circle", "online" => 0, "tooltip" => 0)); ?>
   
      
       </div>
      <div class="col-md-6">
        <div class="opacity-8 text-14" style="max-height:62px; overflow:hidden;">
          <?php echo $data_args['txt']; ?> 
        </div>
      </div>
      <div class="col-md-4 text-center">
        <div class="small mb-2">
          <?php if(_ppt(array('user','ratings')) == "1"){ ?>
          <?php echo do_shortcode('[RATING_USER reviews=0 uid='.$data['uid'].']'); ?>
          <?php } ?>
        </div>
        
        <?php if(_ppt(array('user','allow_profile')) == "1"){ ?>
        
        <a href="<?php echo $data_args['link']; ?>" class="btn btn-system font-weight-bold <?php echo $data_args['btn-css']; ?>"> <?php if(THEME_KEY == "vt"){ echo __("View Channel","premiumpress"); }else{ echo __("View Profile","premiumpress"); } ?></a>
      	<?php } ?>
       
    </div>
  </div>
</div>
                
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;
			
 		
		
		}
		
}
					
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
				 
	function AVATAR($id, $data = array()){ global $CORE, $CORE_UI, $userdata;

		
		switch($id){

			case "user": {
			 
			// DEFAULTS
				if(!isset($data['uid']) || isset($data['uid']) &&  $data['uid'] < 1){
					
	 
					if(isset($data['uid']) && isset($this->user_images[str_replace("0.","",$data['uid'])]) ){
					$data['img'] = $this->user_images[str_replace("0.","",$data['uid'])];
					$data['uid'] = 0;
					}else{					
					$data['uid'] = 0;
					}
				 
					
				}else{
					
					$data['name'] = $CORE->USER("get_username", $data['uid'] );
					$data['img'] = $CORE->USER("get_avatar", $data['uid'] );
					if(!isset($data['link']) || isset($data['link']) && $data['link'] != "0"){	
					
					if(_ppt(array('user','allow_profile')) == "1"){
					$data['link'] 	= $CORE->USER("get_user_profile_link", $data['uid'] );		
					}else{
					$data['link'] 	= "#";
					} 			 
					
					}			 
					
				}
				
				if(!isset($data['size'])){
					$data['size'] = "";
				}
				if(!isset($data['css'])){
					$data['css'] = "";
				}
				if(!isset($data['link'])){
					$data['link'] = "#";
				}
				if(!isset($data['img'])){
					$data['img'] = "";
				}
				if(!isset($data['online'])){
					$data['online'] = "";
				}
				if(!isset($data['name'])){
					$data['name'] = "user";
				}
				
				if(!isset($data['tooltip'])){
					$data['tooltip'] = "";
				}
				
				if(!isset($data['icon'])){
					
					$data['icon'] = "";
					
					// AUTO ADD IF MEMEBERSHIPS ARE ENABLED
					if(_ppt(array('mem','enable')) == "1" && $data['uid'] > 0){
						$data['icon'] = $CORE->USER("membership_user_icon", $data['uid']);						
					}
					
					
				}
				
				
				$data_args = array(
				
					"uid" 	=> $data['uid'],
					
					"name" 	=> $data['name'], 
					"img" 	=> $data['img'], 
					"link" 	=> $data['link'],
					
					"size" 	=> $data['size'], 
					"css" 	=> $data['css'], 
					
					"icon" 	=> $data['icon'],
					
					"tooltip" => $data['tooltip'],
					
					"online" 	=> $data['online'], 
					
				
				);
			
				ob_start();
				?><<?php if($data_args['link'] == "0"){ echo "span"; }else{ echo "a"; } ?> href="<?php echo $data_args['link']; ?>" class="ppt-avatar ppt-avatar-<?php echo $data_args['size']; ?>  <?php echo $data_args['css']; ?>" <?php if($data_args['tooltip'] == 1){ ?>data-toggle="tooltip" data-placement="top" title="<?php echo $data_args['name']; ?>"<?php } ?>>
                
                <div class="_wrap bg-image" data-bg="<?php echo $data_args['img']; ?>">&nbsp;</div>
                
                <?php if($data_args['icon'] !=""){ ?>
                <span class="iconbit"><span class="<?php echo $data_args['icon']; ?>"></span></span>
                <?php } ?>
                
                <?php if($data_args['online'] == 1){ ?>
                      <span class="ppt-icon-online">
                      <span class="ripple"></span>
                      <span class="ripple"></span>
                      <span class="ripple"></span>
                      </span>
                <?php } ?>                
                </<?php if($data_args['link'] == "0"){ echo "span"; }else{ echo "a"; } ?>>
                <?php $output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;

		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "card": {
				
				// DEFAULTS
				if(!isset($data['uid'])){
					$data['uid'] = 1;
					$data['img'] = DEMO_IMG_PATH."/rt/agent1.jpg";
					$data['txt'] = "London";
				
					$data['bg-img'] = "http://localhost/land.jpg";
					
				}else{
				
					$data['img'] = $CORE->USER("get_avatar", $data['uid'] );
					$data['txt'] = $CORE->USER("get_country", $data['uid'] );
				
				}
				
				if(!isset($data['css'])){
					$data['css'] = "shadow-sm bg-light";
				}
				
				if(!isset($data['bg-img'])){
					$data['bg-img'] = "";
				}
				
				if(!isset($data['btn-css'])){
					$data['btn-css'] = "";
				}
			
				$data_args = array(
				
					"uid" => $data['uid'],
					
					"img" => $data['img'],
					
					"txt" => $data['txt'],
					
					"css" => $data['css'], 
					
					"btn-css" => $data['btn-css'], 
					
					"bg-img" => $data['bg-img'],
				
				);
			
				ob_start();
				?>
<div class="rounded ppt-avatar-card overflow-hidden <?php echo $data_args['css']; ?>">
  <div class="bg-primary overflow-hidden position-relative" style="height:120px;">
  <?php if($data_args['bg-img'] != ""){ ?><div class="bg-image"  data-image="<?php echo $data_args['bg-img']; ?>"></div><?php } ?>
  </div>
  <div class="mx-auto mt-n5 text-center">
    <div class="ppt-avatar bg-image" data-image="<?php echo $data_args['img']; ?>">
    <?php if(_ppt(array('user','onlinemode')) == "1"){ ?>
      <span class="ppt-icon-online">
      <span class="ripple"></span>
      <span class="ripple"></span>
      <span class="ripple"></span>
      </span>
      <?php } ?>
    </div>
  </div>
  <div class="text-center px-3 pb-3">
    <h4 class="text-shadow-white-1"><?php echo $CORE->USER("get_username", $data_args['uid']); ?></h4>
    <p class="small opacity-5"><?php echo $data_args['txt']; ?></p>
    
    <?php if(_ppt(array('user','account_messages')) == 1){ ?>
    <a href="javascript:void(0);" onClick="processMessage(<?php echo $data_args['uid']; ?>);" class="btn btn-system btn-block shadow-sm btn-icon icon-before btn-lg mb-2 <?php echo $data_args['btn-css']; ?>">
    <i class="fal fa-envelope float-left"></i> 
    <span><?php echo __("Message Me","premiumpress"); ?></span></a>
    <?php } ?> 
    
    
    <?php if(THEME_KEY == "vt"){  
	
	
	?>
    
    <?php echo do_shortcode('[SUBSCRIBE class="btn btn-block btn-system" icon=0 count=0 text=1 uid="'.$data_args['uid'].'" text_remove="'.__("Unsubscribe","premiumpress").'" text_add="'.__("Subscribe","premiumpress").'"]'); ?>
    
    <div class="d-flex justify-content-between border-top pt-4 mt-3 col-xl-10 mx-auto">
    
    <div> <h4><?php echo $CORE->USER("get_total_account_views", $data_args['uid']); ?></h4> <div class="small opacity-5"> <?php echo __("views","premiumpress"); ?></div> </div>

    <div> <h4><?php echo $CORE->USER("get_subscribers_count", $data_args['uid']); ?></h4> <div class="small opacity-5"> <?php echo __("subscribers","premiumpress"); ?></div> </div>
    
    </div>
    
    <?php } ?>
    
    
  </div>
</div>


                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;

			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "cardxxx": {
				ob_start();
				?>
                
                
                
                <?php
				
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
				
			} break;
			

			
		
		}
	
	} 

 
	
}

?>