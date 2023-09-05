<?php
 
class framework_layout extends framework_functions {

	public $all_admin_layouts;
	
	
	function _ppt_home_url(){
	
		if(isset($_SERVER['HTTPS'])) {
			if ($_SERVER['HTTPS'] == "on") {
				return str_replace("http://","https://",home_url());
			}
		}
	
		return home_url();
	
	}

	function _wp_head(){ global $CORE;
	 	
		if(!is_admin()){ 
			
			// META DESCRIPTION
			echo _ppt_meta_description();
			
			// META KEYWORDS
			echo _ppt_meta_keywords();
			
			// ADSENSE CODE
			if(_ppt(array('adsense','enable')) == 1 && strlen(_ppt(array('adsense','code'))) > 2){ 
				echo _ppt(array('adsense','code')); 
			}
			
			// LOAD CUSTOM STYLES IN HEAD
			echo "<style>.preload-hide { display:none; }</style>";	 
		}  
			
	}

	function _elementor_scripts($pagekey = ""){	global $post;
	 
			
		// ELEMENTOR
		if( defined('ELEMENTOR_VERSIONxxxxxxx') ){
		 		
				if(in_array(_ppt(array('design','elementor_globals')), array("","1"))){				
				wp_register_style( 'elementor-global', $this->_ppt_home_url().'/wp-content/uploads/elementor/css/global.css');	 
				wp_enqueue_style( 'elementor-global' );				
				}
				
				wp_register_style( 'elementor-frontend', $this->_ppt_home_url().'/wp-content/plugins/elementor/assets/css/frontend.min.css');	 
				wp_enqueue_style( 'elementor-frontend' ); 
				 	
				if(defined('ELEMENTOR_PRO_VERSION')){
				wp_register_style( 'elementorpro-frontend', $this->_ppt_home_url().'/wp-content/plugins/elementor-pro/assets/css/frontend.min.css');	 
				wp_enqueue_style( 'elementorpro-frontend' );
				}	
				
				if(isset($post->ID)){
				
					$valid = _ppt(array('pageassign', $pagekey ));
					if(strlen($valid) > 5 && strpos($valid,"elementor") !== false ){
						
						$elementor_page_id = str_replace("elementor-","", $valid);
						
						$uploads = wp_upload_dir();
						
						//_elementor_css
						  
						if( is_numeric($elementor_page_id) && file_exists( $uploads['basedir'].'/elementor/css/post-'.$elementor_page_id.'.css') ){	
										
								wp_register_style( 'elementor-post-'.$elementor_page_id, $uploads['baseurl'].'/elementor/css/post-'.$elementor_page_id.'.css');	 
								wp_enqueue_style( 'elementor-post-'.$elementor_page_id );	
								
								/*echo "<script>jQuery(document).ready(function(){ jQuery('body').addClass('elementor-kit-".$elementor_page_id."'); });</script>";	*/		
						}				
						
						
					
					}
					
				}
				
		}
				
	}
	
	function _enqueue_scripts(){
		 
		
		if(!isset($GLOBALS['flag-add']) && in_array(_ppt(array('design','jqueryFooter')), array("1")) && ( isset($GLOBALS['flag-home']) || isset($GLOBALS['flag-home-demo']) || isset($GLOBALS['flag-page']) || isset($GLOBALS['flag-search']) ) ){
	
		$GLOBALS['flag-jquery-footer'] = 1;
		 
		}else{ 
		
  		wp_enqueue_script('jquery', includes_url( '/js/jquery/jquery.js' ),false, THEME_VERSION ); //, THEME_VERSION, $footer = true
		
		}
		 
		
		// ADD FORM - NEEDS TO LOAD AFTER JQUERY BEFORE BOTTOM
		if(( is_admin() && isset($_GET['page']) && $_GET['page'] == "listings") || isset($GLOBALS['flag-add'])){
	 
		
			wp_register_script( 'ppt-upload', CDN_PATH.'js/js.plugins-upload.js', array( 'jquery' ), true);
			wp_enqueue_script( 'ppt-upload' );
			
			wp_register_script( 'ppt-selectpicker', CDN_PATH.'js/js.plugins-selectpicker.js', array( 'jquery' ), true);
			wp_enqueue_script( 'ppt-selectpicker' );
		
		}	
		
		
		if(is_admin() && isset($GLOBALS['new_admin_menu']) && isset($_GET['page']) && !isset($GLOBALS['flag-add']) && substr($_GET['page'],0,3) == "v10" ||
				
				 isset($_GET['page']) && in_array($_GET['page'], array("gifts","premiumpress","settings","docsxxx","orders","listings","reports","advertising","news", "comments", "cashout","cashback","members","email","design","plugins","cart","getting-started","customfields","massimport","membershipsetup","listingsetup","usersettings","messages","seo","stores","news","search","ppt_editor","newsletter","dispute","paywall")) 
				 
				 ){ 
		
				// GLOBAL STYLES 
				wp_enqueue_style("premiumpress-globals", CDN_PATH.'admin/css/wpglobal.css');
				
				wp_register_script( 'ppt-boostrap', CDN_PATH.'js/js.bootstrap.js', array( 'jquery' ), true);
				wp_enqueue_script( 'ppt-boostrap' );				
			
				wp_register_script( 'ppt-admin', CDN_PATH.'admin/js/admin.js', array( 'jquery' ), true);
				wp_enqueue_script( 'ppt-admin' );
				
				wp_register_script( 'ppt-notify', CDN_PATH.'js/js.plugins-notify.js', array( 'jquery' ), true);
				wp_enqueue_script( 'ppt-notify' );	
				 
				 
				
				global $CORE, $CORE_UI;
				
				// ADMIN LANGUAGE
				$admin_language = get_option('WPLANG');				
				if(in_array($admin_language, array("ar","ary"))){ 
					$bootstrap 	=  	CDN_PATH."css/_bootstrap-rtl.css";
				}else{ 
					$bootstrap 	=  	CDN_PATH."css/_bootstrap.css";
				}  
			  
				wp_enqueue_style("boostrap", 	$bootstrap);
							
				wp_enqueue_style("ppt-admin-css", 	CDN_PATH.'admin/css/premiumpress.css');
				
				
				if(isset($_GET['page']) && in_array($_GET['page'], array("listings","listingsetup",'usersettings','members','design')) ){
				 	
					//wp_register_script( 'ppt-search', CDN_PATH.'js/js.search.js', array( 'jquery' ), true);
					//wp_enqueue_script( 'ppt-search' );
					
					wp_register_script( 'ppt-up-js', CDN_PATH.'js/js.up.js', array( 'jquery' ), true);
					wp_enqueue_script( 'ppt-up-js' );
					
					wp_enqueue_style("ppt-up-css", 	CDN_PATH.'css/_up.css');
					wp_enqueue_style("ppt-submit-css", 	CDN_PATH.'css/_submitform.css'); 										
																								
				}
				   
				// INCLUDE POP-UP MEDIA BOX
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox'); 
				   
				
				  
		}
		
	}
	
	function _deenqueue_scripts(){ 
			
			wp_dequeue_style( 'wp-block-library' );
    		wp_dequeue_style( 'wp-block-library-theme' );
   			wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
				
			wp_dequeue_style('forms');
			
			if(isset($GLOBALS['flag-add']) || ( is_admin() && isset($_GET['page'])) && in_array($_GET['page'], array("listings","listingsetup",'usersettings','members','design') ) ){
			
			wp_deregister_script( 'jquery-ui-autocomplete' );
			
			}
	}
	  
 
	function _hook_footer_after(){
	
		// STOP DOUBLE LOAD
		if( isset($GLOBALS['flag-hook-footer-after']) ){
		return;
		} 
		$GLOBALS['flag-hook-footer-after']=1;
		
		
		global $pagenow, $userdata, $wp_styles, $CORE, $CORE_UI, $post; 
		 	 
				// LOAD IN FRAMEWORK CSS
				$css 	= 	$CORE_UI->LOAD("css");  						
				$js 	= 	$CORE_UI->LOAD("js");  
				 
 			  
				ob_start();				
				?>
                <!-- PREMIUMPRESS THEMES V.<?php echo THEME_VERSION; ?> -->
               
               <?php if( isset($GLOBALS['flag-jquery-footer']) ){  ?>
               
               <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
               integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
               crossorigin="anonymous" referrerpolicy="no-referrer"></script>
               
               <?php } ?>               
               
               <script>
				var ajax_img_url = "<?php echo CDN_PATH; ?>";  
				var ajax_site_url = "<?php echo $CORE->_ppt_home_url(); ?>/index.php";  
				var ajax_framework_url = "<?php echo get_template_directory_uri(); ?>/"; 
				var ajax_googlemaps_key = "<?php echo trim( _ppt(array('maps','apikey')) ); ?>";
				 </script>
				
				<input type="hidden" id="ppt-current-tho" value="<?php echo $CORE->_currency_tho(0); ?>" />
				<input type="hidden" id="ppt-current-dec" value="<?php echo $CORE->_currency_dec(0); ?>" />
				<input type="hidden" id="ppt-current-symbol" value="<?php echo $CORE->_currency_symbol(0); ?>" />
				<input type="hidden" id="ppt-current-position" value="<?php echo $CORE->_currency_position(0); ?>" />
                <input type="hidden" id="ppt-map-provider" value="<?php echo _ppt(array("maps","provider")); ?>" /> 
               
                 <?php if(!empty($js)){ foreach($js as $k => $path){ if(strlen($path) < 5){ continue; }  ?>
                 <script async src="<?php echo $path; ?>?v=<?php echo THEME_VERSION; ?>" id="<?php echo $k; ?>"></script>
                 <?php } } ?>
                 
				<noscript id="deferred-styles">
                
				<?php if(!empty($css)){ foreach($css as $k => $path){ if(strlen($path) < 5){ continue; }  ?>
				<link rel="stylesheet" type="text/css" id="<?php echo $k; ?>" <?php if(in_array($k,array("theme-grid","theme-grid-rtl"))){  ?>
                href="#" class="unset" 
                old-href="<?php echo $path; ?>?v=<?php echo THEME_VERSION; ?>" 
				<?php }else{ ?>href="<?php echo $path; ?>?v=<?php echo THEME_VERSION; ?>"<?php } ?><?php if(in_array($k, array("bootstrap","_fonts","_fontawesome","_responsive","_plugins","cart"))){ ?>rel="preload"<?php } ?>/>
				<?php } } ?>
                
                <?php if(!is_admin()){ ?>
				<style>
				<?php echo $CORE->LAYOUT("load_css", array()); ?>
				</style> 
                <?php } ?> 
				</noscript> 
                
                
     
                 
				<script>
				var loadDeferredStyles = function() {
						var addStylesNode = document.getElementById("deferred-styles");
						var replacement = document.createElement("div");
						replacement.innerHTML = addStylesNode.textContent;
						document.body.appendChild(replacement)
						addStylesNode.parentElement.removeChild(addStylesNode);
				};
				var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
						  window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
					  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
					  else window.addEventListener('load', loadDeferredStyles);
				   
				</script>
                <!----------------- -->
				<?php		
				echo trim(ob_get_clean());		
				 //$str = str_replace(array("\r","\n"),'',trim(ob_get_clean()));
			 	
				echo $CORE->LAYOUT("load_js", array()); 
				
		return; 
		 
	}
 

	function LAYOUT($action='add', $order_data = ""){
 
  
	global $userdata, $wpdb, $CORE;
	
 
	switch($action){ 
	
	
	
	case "ppt_colors": {
	
		$colors = array(
		"red" 			=> array("name" => "Red Style", "src" => "", ),
		"blue"  		=> array("name" => "Blue Style", "src" => "", ),
		"green"  		=> array("name" => "Green Style", "src" => "", ),
		"pink"  		=> array("name" => "Pink Style", "src" => "", ),
		"purple"  		=> array("name" => "Purple Style", "src" => "", ), 
		"orange"  		=> array("name" => "Orange Style", "src" => "", )
		);
		
		
		return $colors;
		
	} break;
	
	
	case "default_perpage_sponsored": {
	 				
		 
		switch($order_data){
			case "1": { $t = 5; } break; // full grid
			case "2": { $t = 3; } break; // full list
			case "3": { $t = 4; } break; // container grid
			case "4": { $t = 2; } break; // container list
			case "5": { $t = 3; } break; // sidebar
			case "6": { $t = 1; } break; // sidebar
			case "7": { $t = 3; } break; // map
			case "8": { $t = 3; } break;
			case "9": { $t = 3; } break; 
			default: { $t = 3; }
		 } 
	
		return $t;
	
	
	} break;
	
	case "default_perpage": {
	
		$t = "";
		
		$d = get_option('posts_per_page');
		 
		switch($order_data){
			case "1": { $t = 20; } break; // full grid
			case "2": { $t = 18; } break; // full list
			case "3": { $t = 24; } break; // container grid
			case "4": { $t = 24; } break; // container list
			case "5": { $t = 18; } break; // sidebar
			case "6": { $t = 18; } break; // sidebar
			case "7": { $t = 18; } break; // map
			case "8": { $t = 18; } break;
			case "9": { $t = 18; } break; 
		 }
		 
		 if($d > $t){
		 return $d;
		 } 
		 
		 return $t;
	
	}
	
 
	
		case "get_demo_categories": {
		
		 	$categories = array();
			
			$theme_key = THEME_KEY; 
			
			if(isset($GLOBALS['TEST_THEME_KEY'])){
			$theme_key = $GLOBALS['TEST_THEME_KEY'];
			}
		 
			if(defined('THEME_KEY') && in_array($theme_key, array("at"))){
			
			 	//$categories[$theme_key]["framework_city"] = __("Single City Examples","premiumpress");	
				$categories[$theme_key]["antiques"] 		= __("Antiques & Jewellery Auctions","premiumpress");				
				$categories[$theme_key]["realestate"] 	= __("Property &amp; Real Estate Auctions","premiumpress");					
				$categories[$theme_key]["art"] 			= __("Art &amp; Collectibles Auctions","premiumpress");
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos Auctions","premiumpress"); 				
				$categories[$theme_key]["horses"] 		= __("Horses &amp; Animals Auctions","premiumpress"); 				
				$categories[$theme_key]["gyma"] 			= __("Fitness &amp; Exercise Auctions","premiumpress");
				$categories[$theme_key]["books"] 		= __("Books & Comics Auctions","premiumpress");				
				$categories[$theme_key]["tickets"] 		= __("Tickets &amp; Vacation Auctions","premiumpress");				
				$categories[$theme_key]["memorabilia"] 	= __("Memorabilia Auctions","premiumpress");
		 	
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("jb"))){				
				 
				$categories[$theme_key]["classic"] 	= __("Classic Jobs Board","premiumpress");
				$categories[$theme_key]["acc"] 		= __("Accounting / Finance","premiumpress");
				$categories[$theme_key]["auto"] 		= __("Automotive Jobs","premiumpress");
				$categories[$theme_key]["con"] 		= __("Construction / Facilities","premiumpress");
				$categories[$theme_key]["art"] 		= __("Design, Art & Multimedia","premiumpress");
				$categories[$theme_key]["edu"] 		= __("Education Training","premiumpress");
				$categories[$theme_key]["doc"] 		= __("Health &amp; Fitness Jobs","premiumpress");
				$categories[$theme_key]["rest"] 		= __("Restaurant / Food Service","premiumpress");
				//$categories[$theme_key]["sales"] 	= __("Sales & Marketing","premiumpress");
 				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("so"))){
				
				$categories[$theme_key]["software"] 		= __("Software Downloads","premiumpress");					
				$categories[$theme_key]["wordpress"] 	= __("WordPress Themes","premiumpress");				
				$categories[$theme_key]["software"] 		= __("Software Downloads","premiumpress");					
				$categories[$theme_key]["ebook"] 		= __("eBook Downloads","premiumpress");					
				$categories[$theme_key]["php"] 			= __("PHP Scripts Downloads","premiumpress");	
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("rt"))){				
				
				$categories[$theme_key]["rt"] 			= __("General Real Estate","premiumpress");
				$categories[$theme_key]["student"] 		= __("Student Accommodation","premiumpress");
				$categories[$theme_key]["luxury"] 		= __("Luxury Accommodation","premiumpress");
				$categories[$theme_key]["localrt"] 		= __("Local &amp; City","premiumpress"); 
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("vt"))){
				 
				$categories[$theme_key]["music"] 		= __("Music Videos","premiumpress");	
				$categories[$theme_key]["cook"] 			= __("Cooking Tutorials","premiumpress");	
				$categories[$theme_key]["beauty"] 		= __("Beauty &amp; Makeup Tutorials","premiumpress");				
				$categories[$theme_key]["adult"] 		= __("Adult Videos","premiumpress");	
				$categories[$theme_key]["photography"] 	= __("Photography Videos","premiumpress");	
				$categories[$theme_key]["gym1"] 			= __("Gym/Fitness Tutorials","premiumpress");	
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("dt"))){				
				
				$categories[$theme_key]["local"] 		= __("Local &amp; City Directory","premiumpress");					
				$categories[$theme_key]["fitness"] 		= __("Health &amp; Fitness Directory","premiumpress");					
				$categories[$theme_key]["food"] 			= __("Food &amp; Restaurants Directory","premiumpress");				
				$categories[$theme_key]["shops"] 		= __("Shops &amp; Retail Directory","premiumpress");
				$categories[$theme_key]["coffee"] 		= __("Coffee &amp; Drinks Directory","premiumpress");				
				$categories[$theme_key]["hair"] 			= __("Hair and Beauty Directory","premiumpress");				
				$categories[$theme_key]["legal"] 		= __("Accountants & Legal","premiumpress");					
				$categories[$theme_key]["plumbers"] 		= __("Plumbers &amp; Electrtions","premiumpress");				
				$categories[$theme_key]["doctors"] 		= __("Dentists &amp; Doctors","premiumpress");				
				$categories[$theme_key]["wash"] 			= __("Car Wash &amp; Cleaning Services","premiumpress");
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("ct"))){				
				
				
				$categories[$theme_key]["local"] 		= __("Local &amp; City Classifieds","premiumpress");
				$categories[$theme_key]["antiques"] 		= __("Antiques & Jewellery Classifieds","premiumpress");				
				$categories[$theme_key]["art"] 			= __("Art &amp; Collectibles Classifieds","premiumpress");
				$categories[$theme_key]["books"] 		= __("Books & Comics Classifieds","premiumpress");						
				$categories[$theme_key]["fashion"] 		= __("Fashion & Clothing Classifieds","premiumpress");				
				$categories[$theme_key]["vape1"] 		= __("Vape &amp; Product Classifieds","premiumpress");				
				$categories[$theme_key]["makeup1"] 		= __("Makeup Classifieds","premiumpress");
				$categories[$theme_key]["fitness"] 		= __("Health &amp; Fitness Classifieds","premiumpress");				 
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos Classifieds","premiumpress"); 				
				$categories[$theme_key]["horses"] 		= __("Horses &amp; Animals Classifieds","premiumpress");
				$categories[$theme_key]["realestate"] 	= __("Property &amp; Real Estate Classifieds","premiumpress");	
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos Classifieds","premiumpress"); 				
				$categories[$theme_key]["horses"] 		= __("Horses &amp; Animals Classifieds","premiumpress");
				$categories[$theme_key]["tickets"] 		= __("Tickets &amp; Vacation Classifieds","premiumpress");				
				$categories[$theme_key]["memorabilia"] 	= __("Memorabilia Classifieds","premiumpress"); 
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("cb"))){
				
				
				$categories[$theme_key]["antiques"] 		= __("Antiques & Jewellery Cashback &amp; Deals","premiumpress");	
				$categories[$theme_key]["retail"] 		= __("Shops &amp; Retail Cashback &amp; Deals","premiumpress");
				$categories[$theme_key]["baby"] 			= __("Baby & Toddler Cashback &amp; Deals","premiumpress");
				$categories[$theme_key]["home"] 			= __("Home & Garden Cashback &amp; Deals","premiumpress");
				$categories[$theme_key]["pets"] 			= __("Animals & Pet Supplies Cashback &amp; Deals","premiumpress");				
				$categories[$theme_key]["hosting"] 		= __("Laptop Cashback &amp; Deals","premiumpress");
				$categories[$theme_key]["cameras"] 		= __("Cameras & Optics Cashback &amp; Deals","premiumpress");
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("cp"))){
			
				$categories[$theme_key]["retail"] 		= __("Shops &amp; Retail Coupons","premiumpress");
				$categories[$theme_key]["baby"] 			= __("Baby & Toddler","premiumpress");
				$categories[$theme_key]["home"] 			= __("Home & Garden","premiumpress");
				$categories[$theme_key]["pets"] 			= __("Animals & Pet Supplies","premiumpress");				
				$categories[$theme_key]["hosting"] 		= __("Hosting Coupons &amp; Deals","premiumpress");
				$categories[$theme_key]["cameras"] 		= __("Cameras & Optics","premiumpress");
			
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("es"))){
			
				$categories[$theme_key]["chocolate"] 		= __("Chocolate","premiumpress");
			 	$categories[$theme_key]["cherry"] 			= __("Cherry","premiumpress");
			 	$categories[$theme_key]["vanilla"] 			= __("Vanilla","premiumpress");
			 	$categories[$theme_key]["mint"] 				= __("Mint Choc Chip","premiumpress");
			 	$categories[$theme_key]["mango"] 			= __("Mango","premiumpress");
			 	$categories[$theme_key]["strawberry"] 		= __("Strawberry","premiumpress");
			  	$categories[$theme_key]["coffee"] 			= __("Coffee","premiumpress");
			  	  
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("da"))){
			
			  
				$categories[$theme_key]["match"] 		= __("Matchmaking","premiumpress");	
				$categories[$theme_key]["general"] 		= __("General","premiumpress");					
				$categories[$theme_key]["love"] 			= __("Young Love","premiumpress");								
				$categories[$theme_key]["gay"] 			= __("Gay Dating","premiumpress");
				$categories[$theme_key]["lesbian"] 		= __("Lesbian Dating","premiumpress");
				$categories[$theme_key]["mature"] 		= __("Mature/ Over 50's Dating","premiumpress");			 
				$categories[$theme_key]["pro"] 			= __("Working Professionals","premiumpress");					 
				$categories[$theme_key]["black"] 		= __("Black Dating","premiumpress");
				$categories[$theme_key]["asian"] 		= __("Asian Dating","premiumpress");
				$categories[$theme_key]["indian"] 		= __("Indian Dating","premiumpress");				 
				$categories[$theme_key]["swing"] 		= __("Swingers &amp; Fetish","premiumpress");
			
			
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("dl"))){
				 
				 
				$categories[$theme_key]["cars"] 		= __("Cars","premiumpress");				 
				$categories[$theme_key]["bmx"] 			= __("BMX &amp; Bikes","premiumpress");	
				$categories[$theme_key]["boats"] 		= __("Boats","premiumpress");	
				$categories[$theme_key]["motorbikes"] 	= __("Motorbikes","premiumpress");				
				$categories[$theme_key]["rv"] 			= __("RV's","premiumpress");	
				$categories[$theme_key]["scooters"] 		= __("Scooters","premiumpress");	
				$categories[$theme_key]["trucks"] 		= __("Trucks","premiumpress");	
				$categories[$theme_key]["vans"] 			= __("Vans","premiumpress");	
				$categories[$theme_key]["vintage"] 		= __("Vintage Cars","premiumpress");	
				
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("sp"))){
			
				$categories[$theme_key]["antiques"] 		= __("Antiques & Jewellery Stores","premiumpress");				
				$categories[$theme_key]["art"] 			= __("Art &amp; Collectibles Stores","premiumpress");
				$categories[$theme_key]["books"] 		= __("Books & Comics Stores","premiumpress");						
				$categories[$theme_key]["fashion"] 		= __("Fashion & Clothing Stores","premiumpress");				
				$categories[$theme_key]["vape"] 			= __("Vape &amp; Product Stores","premiumpress");				
				$categories[$theme_key]["makeup"] 		= __("Makeup Stores","premiumpress");					
				$categories[$theme_key]["gym"] 			= __("Health &amp; Fitness Stores","premiumpress");	 
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos Auctions","premiumpress"); 				
				$categories[$theme_key]["horses"] 		= __("Horses &amp; Animals Auctions","premiumpress");
				$categories[$theme_key]["realestate"] 	= __("Property &amp; Real Estate Auctions","premiumpress");	
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos Auctions","premiumpress"); 				
				$categories[$theme_key]["horses"] 		= __("Horses &amp; Animals Auctions","premiumpress");
				$categories[$theme_key]["tickets"] 		= __("Tickets &amp; Vacation Auctions","premiumpress");				
				$categories[$theme_key]["memorabilia"] 	= __("Memorabilia Auctions","premiumpress"); 
			
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("cm"))){
			
	 			$categories[$theme_key]["fashion1"] 		= __("Fashion & Clothing","premiumpress"); 
				$categories[$theme_key]["antiques"] 		= __("Antiques & Jewellery","premiumpress");				
				$categories[$theme_key]["art"] 			= __("Art &amp; Collectibles","premiumpress");
				$categories[$theme_key]["books"] 		= __("Books & Comics","premiumpress");						
				$categories[$theme_key]["vape1"] 		= __("Vape &amp; Product","premiumpress");				
				$categories[$theme_key]["makeup1"] 		= __("Makeup","premiumpress");
				$categories[$theme_key]["fitness"] 		= __("Health &amp; Fitness","premiumpress");				 
				$categories[$theme_key]["cars"] 			= __("Cars &amp; Autos","premiumpress");
				$categories[$theme_key]["tickets"] 		= __("Tickets &amp; Vacation","premiumpress");				
				$categories[$theme_key]["memorabilia"] 	= __("Memorabilia","premiumpress"); 			
				
			}else{
			
			
			
			
			
			if(defined('THEME_KEY') && in_array($theme_key, array("vt"))){
				
				
				//$categories[$theme_key]["framework_vid"] 	= __("Classic Video Layouts","premiumpress");
			
				$categories[$theme_key]["fashion"] 	= __("Niche Market - Cooking Tutorials","premiumpress");	
				$categories[$theme_key]["makeup"] 	= __("Niche Market - Makeup Tutorials","premiumpress");				
				$categories[$theme_key]["vape"] 		= __("Niche Market - Adult Videos","premiumpress");	
				$categories[$theme_key]["gym"] 		= __("Niche Market - Gym/Fitness Tutorials","premiumpress");	
			
				
			}elseif(defined('THEME_KEY') && in_array($theme_key, array("dt"))){
			
			 	$categories[$theme_key]["framework_city"] = __("Single City Examples","premiumpress");	
				$categories[$theme_key]["shops"] 		= __("Niche Market - Shops &amp; Restaurants","premiumpress");	
				$categories[$theme_key]["makeup"] 		= __("Niche Market - Health &amp; Fitness","premiumpress");				
				$categories[$theme_key]["services"] 		= __("Niche Market - Service Industry","premiumpress");	
				$categories[$theme_key]["gym"] 			= __("Niche Market - Random","premiumpress"); 
				
				
			} 
			
			
			if(defined('THEME_KEY') && in_array($theme_key, array("cp"))){
			$categories[$theme_key]["framework_coupon"] 	= __("Classic Coupon Layouts","premiumpress");		
			}
			
			if(defined('THEME_KEY') && in_array($theme_key, array("es"))){			
			$categories[$theme_key]["framework_color1"] 	= __("Color Examples","premiumpress");				
			$categories[$theme_key]["framework_city"] 		= __("Single City Examples","premiumpress");	
			}
			
			if(defined('THEME_KEY') && in_array($theme_key, array("mj"))){
			
			
			$categories[$theme_key]["mj2"] 	= __("Homepage Feature Boxes","premiumpress");			
			$categories[$theme_key]["mj1"] 	= __("Homepage Video","premiumpress");
		 
			 	
			}
			
			
			$categories[$theme_key]["framework_feb"] 	= __("Homepage Banner","premiumpress");	
			$categories[$theme_key]["framework_sep"] 	= __("Homepage Search","premiumpress");
			
			if(defined('THEME_KEY') && !in_array($theme_key, array("da","vt","sp","cp"))){	
			$categories[$theme_key]["framework_nov"] 	= __("Homepage Map","premiumpress");			
			}
			
			$categories[$theme_key]["framework_jan"] 	= __("Homepage Full Header","premiumpress");
			$categories[$theme_key]["framework_oct"] 	= __("Homepage Inline Header","premiumpress");
			$categories[$theme_key]["framework_may"] 	= __("Homepage Search","premiumpress");			
			$categories[$theme_key]["framework_dec"] 	= __("Homepage Inline Banner","premiumpress");					
			$categories[$theme_key]["framework_apr"] 	= __("Homepage Classic Categories","premiumpress");
			$categories[$theme_key]["framework_mar"] 	= __("Homepage Inline + Search","premiumpress"); 
			$categories[$theme_key]["framework_svg"] 	= __("Illistration Style","premiumpress");
			 
			
			}
			
			
			if(defined('THEME_KEY') && in_array($theme_key, array("vt","dt"))){
			unset($categories[$theme_key]["framework_sep"]);
			}
			
			if(defined('THEME_KEY') && in_array($theme_key, array("mj"))){
			 
			$categories[$theme_key]["mj3"] 	= __("Homepage APP","premiumpress");
			 	
			}
			  
			
			//if(defined('THEME_KEY') && in_array(THEME_KEY, array("mj"))){
			//$categories[THEME_KEY]["childtheme_".strtolower(THEME_KEY)] 	= __("Example Child Themes","premiumpress");
			//}
			  
			
			return $categories;
		
		
		} break;
		
		case "captions": {
	
		
		$themeoptions = array(

			"cp" => array(
			 
			
				"1" 	=> __("Coupon","premiumpress"),
				"2" 	=> __("Coupons","premiumpress"),	
				"icon"	=> "fal fa-tag",
				
				"readmore" 	=> __("View Deal","premiumpress"), 
				
				"maps"	=> false,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => true,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
				
				"account_offer1" => "",
				"account_offer2" => "",
				
				"add" => __("Add Coupon","premiumpress"),
				"add_title" => __("eg. Save 10% at BestBuy.com","premiumpress"),
			  
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("My Rating","premiumpress"),
					 	
				),
				 
			),



		"ph" => array(
		
		  
		
				"1" 	=> __("Photo","premiumpress"),
				"2" 	=> __("Photos","premiumpress"),	
				
				"icon"	=> "fal fa-camera",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"readmore" 	=> __("Download","premiumpress"),
				
				"maps"	=> false,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => true,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
				
				"account_offer1" => "",
				"account_offer2" => "", 
				
				"add" => __("Add Item","premiumpress"),				
				"add_title" => __("eg. Landscape photo of New York","premiumpress"),
				  
				"perrow" => 3,
				
				"rating" => array(	 "rating1" => __("My Rating","premiumpress"),		
				),
			 
				
			),
		
		
		"at" => array(
		  
		
				"1" 	=> __("Auction","premiumpress"),
				"2" 	=> __("Auctions","premiumpress"),	
				
				"readmore" 	=> __("View Auction","premiumpress"),
				
				"icon"	=> "fal fa-gavel",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => true,
				
				"offerbtn" => __("Bid Now","premiumpress"),
				"offer" => __("Bid","premiumpress"),
				"offers" => __("Bids","premiumpress"),
				
				"account_offer1" => __("Bidding","premiumpress"),
				"account_offer2" => __("Items Won","premiumpress"), 
				
				"add" => __("Add Item","premiumpress"),				
				"add_title" => __("eg. Used Sony TV","premiumpress"), 
				 
				
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Value for money","premiumpress"),
					"rating2" => __("Quality","premiumpress"),
					"rating3" => __("Packaging","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
			 
			),
		 
			
			"dl" => array(
			 
			
				"1" 	=> __("Car","premiumpress"),
				"2" 	=> __("Cars","premiumpress"),	
				
				"icon"	=> "fal fa-car",				
				"icon-offer"	=> "fal fa-hand-paper",
				
				"readmore" 	=> __("Learn More","premiumpress"),
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => __("Make Offer","premiumpress"),
				"offer" => __("Offer","premiumpress"),
				"offers" => __("Offers","premiumpress"),
				
				"account_offer1" => __("Offers Made","premiumpress"),
				"account_offer2" => __("Offers Accepted","premiumpress"),
				
				
				"add" => __("Sell Car","premiumpress"),
				"add_title" => __("eg. 2007 Ford Mustang","premiumpress"),
				  
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Value for money","premiumpress"),
					"rating2" => __("Interior","premiumpress"),
					"rating3" => __("Exterior","premiumpress"),
					"rating4" => __("Drive & Handling","premiumpress"),		
				),
				  
				
				
			),
			
			"sp" => array(
			
			 
			
				"1" 	=> __("Product","premiumpress"),
				"2" 	=> __("Products","premiumpress"),	
				
				"readmore" 	=> __("View","premiumpress"),
				
				
				"icon"	=> "fal fa-tshirt",
				"maps"	=> false,
				"memberships" => false,
				"listings" => false,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
				
				"account_offer1" => "",
				"account_offer2" => "",
				
				"add_title" => __("eg. Microsoft Surface Laptop","premiumpress"),
				  
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Packaging","premiumpress"),
					"rating3" => __("Delivery","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				
				 
				 
				 
					
			),
			
			
		"ll" => array(
		 
				"1" 	=> __("Course","premiumpress"),
				"2" 	=> __("Courses","premiumpress"),	
				
				"readmore" 	=> __("Learn More","premiumpress"),
				
				"icon"	=> "fal fa-wreath",
				"icon-offer"	=> "fal fa-image",
				
				"maps"	=> false,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => true,
				
				"offerbtn" => __("Enroll Now","premiumpress"),
				"offer" => __("Application","premiumpress"),
				"offers" => __("Applications","premiumpress"),
				
				"add" => __("Add Course","premiumpress"),
				"add_title" => __("Introduction to Data Science","premiumpress"),
				
				"desc" => "Build an own e-learning website.",
				"demo_design" => "feb2022a",	
				 
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Enjoyment","premiumpress"),
					"rating3" => __("Interesting","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 
				
				"link" => "https://www.premiumpress.com/wordpress-lms-theme/", 
				"default_design" => "ll_style1a",
				
				
			),
			
			
			
			"so" => array(
			 
			
			
				"1" 	=> __("Product","premiumpress"),
				"2" 	=> __("Products","premiumpress"),	
				
				"readmore" 	=> __("Download","premiumpress"),
				
				"icon"			=> "fal fa-box",
				"maps"			=> false,
				"memberships" 	=> true,
				"listings" 		=> true,
				"youtube" 		=> true,
				"cashout" 		=> true,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",	
				
				"add_title" => __("eg. Windows Antivirus Software","premiumpress"),			
				 
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Packaging","premiumpress"),
					"rating3" => __("Delivery","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 
				
				 	
			), 
			
			
			"cm" => array(
			 
			 
			
				"1" 	=> __("Product","premiumpress"),
				"2" 	=> __("Products","premiumpress"),	
				
				"readmore" 	=> __("Learn More","premiumpress"),
				
				"icon"	=> "fal fa-tshirt",
				"maps"	=> false,
				"memberships" => true,
				"listings" => true,
				"cashout" => false,
				"youtube" => true,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
				
				"add_title" => __("eg. Microsoft Surface Laptop","premiumpress"),
				  
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Packaging","premiumpress"),
					"rating3" => __("Delivery","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				), 
					
			),
			
			"ct" => array(
			 
			
				"1" 	=> __("Ad","premiumpress"),
				"2" 	=> __("Ads","premiumpress"),	
				
				"icon"	=> "fa fa-megaphone",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"readmore" 	=> __("Buy Now","premiumpress"),
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				 
				"offerbtn" => __("Make Offer","premiumpress"),
				"offer" => __("Offer","premiumpress"),
				"offers" => __("Offers","premiumpress"),
				
				"account_offer1" => __("Offers Made","premiumpress"),
				"account_offer2" => __("Items Won","premiumpress"),
				
				
				"add" => __("Post Ad","premiumpress"),
				"add_title" => __("eg. Used Microsoft Surface Laptop","premiumpress"),				  
				
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Price","premiumpress"),
					"rating3" => __("Value for money","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 
				  
				
			),	
			

			
			"da" => array(
			  
			
				"1" 	=> __("Profile","premiumpress"),
				"2" 	=> __("Profiles","premiumpress"),	
				
				"readmore" 	=> __("View Profile","premiumpress"),
				
				"icon"	=> "fal fa-heart",
				"icon-offer"	=> "fal fa-image",
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => "", //__("Match Now","premiumpress"),
				"offer" => "", //__("Request","premiumpress"),
				"offers" => "", //__("Requests","premiumpress"),
				
				"add" => __("Add Profile","premiumpress"),
				"add_title" => __("Jane Doe","premiumpress"),
			  
				"perrow" => 3,
				
				"rating" => false, 
				
			),
			
			"es" => array(
			 	 
			
				"1" 	=> __("Profile","premiumpress"),
				"2" 	=> __("Profiles","premiumpress"),	
				
				"readmore" 	=> __("View Profile","premiumpress"),
				
				"icon"	=> "fal fa-heart",
				"icon-offer"	=> "fal fa-image",
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => "", //__("Match Now","premiumpress"),
				"offer" => "", //__("Request","premiumpress"),
				"offers" => "", //__("Requests","premiumpress"),
				
				"add" => __("Add Profile","premiumpress"),
				"add_title" => __("Sexy Jane","premiumpress"),
				  
				
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Looks","premiumpress"),
					"rating2" => __("Venue","premiumpress"),
					"rating3" => __("Price","premiumpress"),
					"rating4" => __("Service","premiumpress"),
				),
				  
			 
			),
			
			
			"mj" => array(
			  
			
				"1" 	=> __("Job","premiumpress"),
				"2" 	=> __("Jobs","premiumpress"),
					
				"icon"	=> "fal fa-briefcase",
				"icon-offer"	=> "fal fa-file-invoice-dollar",
				
				"readmore" 	=> __("View Gig","premiumpress"),
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => true,
				
				"offerbtn" => __("Make Offer","premiumpress"),
				"offer" => __("Order","premiumpress"),
				"offers" => __("Orders","premiumpress"),
				
				"account_offer1" => __("Orders","premiumpress"),
				"account_offer2" => __("Accepted","premiumpress"),
				
				
				"add" => __("Post Job","premiumpress"),
				"add_title" => __("e.g I will build you a WordPress website.","premiumpress"),
				
				"desc" => "Start your own micro jobs website right now!",
				  
				
				"perrow" => 3,
				
				"rating" =>  array( "rating1" => __("Overall Experience","premiumpress"), ),
				 
				 
				
			),	
			
		
		"dt" => array(
		 
		
				"1" 	=> __("Listing","premiumpress"),
				"2" 	=> __("Listings","premiumpress"),
					
				"icon"	=> "fal fa-sign",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"readmore" 	=> __("Learn More","premiumpress"),
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
				
				"add" => __("Add Business","premiumpress"),
				"add_title" => __("eg. Frankys Burger Restaurant","premiumpress"),
			  
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Price","premiumpress"),
					"rating3" => __("Value for money","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 
				
			),
			
			
			"rt" => array(
			 
			
			
				"1" 	=> __("Home","premiumpress"),
				"2" 	=> __("Homes","premiumpress"),
				
				"icon"	=> "fal fa-home",
				"icon-offer"	=> "fal fa-clock",
				
				"readmore" 	=> __("Read More","premiumpress"),
				
				"maps"	=> true,
				"memberships" => true,
				"listings" => true,
				"youtube" => false,
				"cashout" => false,
				
				"offerbtn" => __("Book Viewing","premiumpress"),
				"offer" => __("Viewing","premiumpress"),
				"offers" => __("Viewings","premiumpress"),
				
				"account_offer1" => __("Viewings","premiumpress"),
				"account_offer2" => __("Accepted","premiumpress"),
				
				"add" => __("Add Home","premiumpress"),
				"add_title" => __("eg. 4 Bedroom Detached House Near London","premiumpress"),
			  
				
				"perrow" => 3,	
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Price","premiumpress"),
					"rating3" => __("Value for money","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 
				 
			),	
			
			
			"jb" => array(
			 
			
				"1" 			=> __("Job","premiumpress"),
				"2" 			=> __("Jobs","premiumpress"),
				
				"readmore" 	=> __("Read More","premiumpress"),
				
				"offerbtn" 		=> __("Apply Now","premiumpress"),
				"offer" 		=> __("Interview","premiumpress"),
				"offers" 		=> __("Interviews","premiumpress"),
				
				"account_offer1" => __("Applied For","premiumpress"),
				"account_offer2" => __("Accepted","premiumpress"),
					
				"icon"				=> "fal fa-briefcase",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"maps"			=> true,
				"memberships" 	=> true,
				"listings" 		=> true,
				"youtube" 		=> false,
				"cashout" 		=> false,
				
				"add" => __("Add Job","premiumpress"),
				"add_title" => __("eg. Full-time Staff Wanted Urgently","premiumpress"),
				  
				
				"perrow" => 3,
				
				"rating" => array(	
					"rating1" => __("Location","premiumpress"),
					"rating2" => __("Salary","premiumpress"),
					"rating3" => __("Company","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				  
			),	
			
			"vt" => array(
			 
			
				"1" 	=> __("Video","premiumpress"),
				"2" 	=> __("Videos","premiumpress"),
				
				"readmore" 	=> __("Watch Now","premiumpress"),
				
				"offerbtn" => "",
				"offer" => "",
				"offers" => "",
					
				"icon"	=> "fal fa-video",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"maps"	=> false, 
				"memberships" => true,
				"listings" => true,
				"youtube" => true,
				"cashout" => false,
				
				"add" => __("Add Video","premiumpress"),
				"add_title" => __("eg. Learn to cook steak in 5 minutes or less!","premiumpress"),
				  
				
				"perrow" => 3,	
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Enjoyment","premiumpress"),
					"rating3" => __("Interesting","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
				 	
			),
			
	"pj" => array(
			 
	
			
				"1" 	=> __("Job","premiumpress"),
				"2" 	=> __("Jobs","premiumpress"),
				
				"offerbtn" 		=> __("Submit Offer","premiumpress"),
				"offer" 		=> __("Offer","premiumpress"),
				"offers" 		=> __("Offers","premiumpress"),
				
				"readmore" 	=> __("Read More","premiumpress"),
					
				"icon"				=> "fal fa-briefcase",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"maps"	=> true, 
				"memberships" => true,
				"listings" => true,
				"youtube" => true,
				"cashout" => true,
				
				"add" => __("Add Job","premiumpress"),
				"add_title" => __("eg. I need a new website building.","premiumpress"),
				
				"account_offer1" => __("Offers","premiumpress"),
				"account_offer2" => __("Accepted","premiumpress"),
				  
				"perrow" => 3,	
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Enjoyment","premiumpress"),
					"rating3" => __("Interesting","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
			 
			),
			
			
	"cb" => array(
			 
	
			
				"1" 	=> __("Deal","premiumpress"),
				"2" 	=> __("Deals","premiumpress"),
				
				"offerbtn" 		=> "",
				"offer" 		=> "",
				"offers" 		=> "",
				
				"readmore" 	=> __("Read More","premiumpress"),
					
				"icon"				=> "fal fa-briefcase",
				"icon-offer"	=> "fal fa-hand-paper",
				
				"maps"	=> true, 
				"memberships" => true,
				"listings" => true,
				"youtube" => true,
				"cashout" => true,
				
				"add" => __("Add Job","premiumpress"),
				"add_title" => __("eg. I need a new website building.","premiumpress"),
				
				"account_offer1" => __("Offers","premiumpress"),
				"account_offer2" => __("Accepted","premiumpress"),
				  
				"perrow" => 3,	
				
				"rating" => array(	
					"rating1" => __("Quality","premiumpress"),
					"rating2" => __("Enjoyment","premiumpress"),
					"rating3" => __("Interesting","premiumpress"),
					"rating4" => __("Overall","premiumpress"),		
				),
			 
			),
						
		
		);
		 
		
		
		if(!defined('THEME_KEY')){
			$data = $themeoptions["sp"];
		}else{
			 
		
			// THIS THEME
			$ThisTheme = THEME_KEY;
			if(isset($GLOBALS['TEST_THEME_KEY'])){
			$ThisTheme = $GLOBALS['TEST_THEME_KEY'];
			}
			
			
		
			$data = $themeoptions[$ThisTheme];
			
			$GLOBALS['captionsdata'] = $data;
			
			if(_ppt(array('company','core_icon')) != ""){
			
			$data['icon'] = _ppt(array('company','core_icon'));
			 
			
			}
			
		} 
		
		if($order_data == "all"){
			return $data;
		}elseif(isset($data[$order_data])){		
			return $data[$order_data];		
		}else{
			return "";
		}
 		
		} break;
		
		
		
	
		case "get_fonttypes": {
		
			$fonttypes = array(
		
				"font_body" => array(
					"name" => "Body Font",
					"code" => "body ",
				),
				
				"font_logo" => array(
					"name" => "Logo Font",
					"code" => ".textlogo ",
				),
				
				"font_h1" => array(
					"name" => "Heading 1 Font",
					"code" => "h1, .h1, .grid .title",
				),
				
				"font_h2" => array(
					"name" => "Heading 2 Font",	
					"code" => "h2, .h2, .grid .subtitle",
				),
				
				"font_h3" => array(
					"name" => "Heading 3 Font",	
					"code" => "h3, .h3",
				),
				
				"font_h4" => array(
					"name" => "Heading 4 Font",	
					"code" => "h4, .h4",
				),
				
				"font_h5" => array(
					"name" => "Heading 5 Font",	
					"code" => "h5, .h5",
				),
				
				"font_h6" => array(
					"name" => "Heading 6 Font",	
					"code" => "h6, .h6",
				),
				
				"font_menu" => array(
					"name" => "Main Menu",	
					"code" => ".nav-link",
				),
				
				"font_btn" => array(
					"name" => "Button Font",	
					"code" => ".btn",
				),
				
				
					
			
			);
			
			if(is_array($order_data) && empty($order_data)){
				return $fonttypes;
			}else{		
				return $fonttypes[$order_data];
			} 
		
		
		} break;
	
		case "get_fonts": {
		
		
$googleFonts = array('Cairo','Tajawal','Amiri','Almarai','Changa','Lalezar','ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Akronim', 'Aladin', 'Aldrich', 'Alef', 'Alegreya', 'Alegreya SC', 'Alex Brush', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Allan', 'Allerta', 'Allerta Stencil', 'Allura', 'Almendra', 'Almendra Display', 'Almendra SC', 'Amarante', 'Amaranth', 'Amatic SC', 'Amethysta', 'Anaheim', 'Andada', 'Andika', 'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo Black', 'Archivo Narrow', 'Arial Black', 'Arial Narrow', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Bell MT', 'Bell MT Alt', 'Belleza', 'BenchNine', 'Barlow', 'Bentham', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Bitter', 'Black Ops One', 'Bodoni', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buenard', 'Butcherman', 'Butcherman Caps', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Calibri', 'Calligraffitti', 'Cambo', 'Cambria', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Cardo', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC', 'Carter One', 'Caudex', 'Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clara', 'Clicker Script', 'Coda', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon', 'Concert One', 'Condiment', 'Consolas', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Corsiva', 'Courgette', 'Courier New', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Creepster Caps', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono', 'Damion', 'Dancing Script', 'Dangrek', 'Dawning of a New Day', 'Days One', 'Delius', 'Delius Swash Caps', 'Delius Unicase', 'Della Respira', 'Denk One', 'Devonshire', 'Dhyana', 'Didact Gothic', 'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'Dorsa', 'Dosis', 'Dr Sugiyama', 'Droid Arabic Kufi', 'Droid Arabic Naskh', 'Droid Sans', 'Droid Sans Mono', 'Droid Sans TV', 'Droid Serif', 'Duru Sans', 'Dynalight', 'EB Garamond', 'Eagle Lake', 'Eater', 'Eater Caps', 'Economica', 'Electrolize', 'Elsie', 'Elsie Swash Caps', 'Emblema One', 'Emilys Candy', 'Engagement', 'Englebert', 'Enriqueta', 'Erica One', 'Esteban', 'Euphoria Script', 'Ewert', 'Exo', 'Expletus Sans', 'Fanwood Text', 'Fascinate', 'Fascinate Inline', 'Faster One', 'Fasthand', 'Fauna One', 'Federant', 'Federo', 'Felipa', 'Fenix', 'Finger Paint', 'Fjalla One', 'Fjord One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Fira sans','Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galdeano', 'Galindo', 'Garamond', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gilda Display', 'Give You Glory', 'Glass Antiqua', 'Glegoo', 'Gloria Hallelujah', 'Goblin One', 'Gochi Hand', 'Gorditas', 'Goudy Bookletter 1911', 'Graduate', 'Grand Hotel', 'Gravitas One', 'Great Vibes', 'Griffy', 'Gruppo', 'Gudea', 'Habibi', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Headland One', 'Helvetica Neue', 'Henny Penny', 'Herr Von Muellerhoff', 'Holtwood One SC', 'Homemade Apple', 'Homenaje', 'IM Fell DW Pica', 'IM Fell DW Pica SC', 'IM Fell Double Pica', 'IM Fell Double Pica SC', 'IM Fell English', 'IM Fell English SC', 'IM Fell French Canon', 'IM Fell French Canon SC', 'IM Fell Great Primer', 'IM Fell Great Primer SC', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie Flower', 'Inika', 'Irish Grover', 'Irish Growler', 'Istok Web', 'Italiana', 'Italianno', 'Jacques Francois', 'Jacques Francois Shadow', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Josefin Sans', 'Josefin Sans Std Light', 'Josefin Slab', 'Joti One', 'Judson', 'Julee', 'Julius Sans One', 'Junge', 'Jura', 'Just Another Hand', 'Just Me Again Down Here', 'Kameron', 'Karla', 'Kaushan Script', 'Kavoon', 'Keania+One', 'Kelly Slab', 'Kenia', 'Khmer', 'Kite One', 'Knewave', 'Kotta One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona One', 'La Belle Aurore', 'Lancelot', 'Lateef', 'Lato', 'League Script', 'Leckerli One', 'Ledger', 'Lekton', 'Lemon', 'Lemon One', 'Libre Baskerville', 'Life Savers', 'Lilita One', 'Lily Script One', 'Limelight', 'Linden Hill', 'Lobster', 'Lobster+Two', 'Lohit Bengali', 'Lohit Devanagari', 'Lohit Tamil', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister', 'Loved by the King', 'Lovers Quarrel', 'Luckiest Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo Swash Caps', 'Magra', 'Maiden Orange', 'Mako', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad', 'Marvel', 'Mate', 'Mate SC', 'Maven Pro', 'McLaren', 'Meddon', 'MedievalSharp', 'Medula One', 'Megrim', 'Meie Script', 'Merienda', 'Merienda One', 'Merriweather', 'Merriweather Sans', 'Metal', 'Metal Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Milonga', 'Miltonian', 'Miltonian Tattoo', 'Miniver', 'Miss Fajardose', 'Miss Saint Delafield', 'Modern Antiqua', 'Molengo', 'Monda', 'Monofett', 'Monoton', 'Monsieur La Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Moul', 'Moulpali', 'Mountains of Christmas', 'Mouse Memoirs', 'Mr Bedford', 'Mr Bedfort', 'Mr Dafoe', 'Mr De Haviland', 'Mrs Saint Delafield', 'Mrs Sheppards', 'Muli', 'Mystery Quest', 'Neucha', 'Neuton', 'New Rocker', 'News Cycle', 'Niconne', 'Nixie One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Nosifer Caps', 'Nothing You Could Do', 'Noticia Text', 'Noto Sans', 'Noto Sans UI', 'Noto Serif', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'OFL Sorts Mill Goudy TT', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans', 'Oranienbaum', 'Orbitron', 'Oregano', 'Orienta', 'Original Surfer', 'Oswald', 'Over the Rainbow', 'Overlock', 'Overlock SC', 'Ovo', 'Oxygen', 'Oxygen Mono', 'PT Mono', 'PT Sans', 'PT Sans Caption', 'PT Sans Narrow', 'PT Serif', 'PT Serif Caption', 'Pacifico', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One', 'Patrick Hand', 'Patrick Hand SC', 'Patua One', 'Paytone One', 'Peralta', 'Permanent Marker', 'Petit Formal Script', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon Script', 'Pirata One', 'Plaster', 'Play', 'Playball', 'Playfair Display', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Port Lligat Sans', 'Port Lligat Slab', 'Prata', 'Preahvihear', 'Press Start 2P', 'Princess Sofia', 'Prociono', 'Prosto One', 'Proxima Nova', 'Proxima Nova Tabular Figures', 'Puritan', 'Purple Purse', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One', 'Radley', 'Raleway', 'Raleway Dots', 'Rambla', 'Rammetto One', 'Ranchers', 'Rancho', 'Rationale', 'Redressed', 'Reenie Beanie', 'Revalia', 'Ribeye', 'Ribeye Marrow', 'Righteous', 'Risque', 'Roboto', 'Roboto Condensed', 'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Rosarivo', 'Rouge Script', 'Ruda', 'Rufina', 'Ruge Boogie', 'Ruluko', 'Rum Raisin', 'Ruslan Display', 'Russo One', 'Ruthie', 'Rye', 'Sacramento', 'Sail', 'Salsa', 'Sanchez', 'Sancreek', 'Sansita One', 'Sarina', 'Satisfy', 'Scada', 'Scheherazade', 'Schoolbell', 'Seaweed Script', 'Sevillana', 'Seymour One', 'Shadows Into Light', 'Shadows Into Light Two', 'Shanti', 'Share', 'Share Tech', 'Share Tech Mono', 'Shojumaru', 'Short Stack', 'Siamreap', 'Siemreap', 'Sigmar One', 'Signika', 'Signika Negative', 'Simonetta', 'Sintony', 'Sirin Stencil', 'Six Caps', 'Skranji', 'Slackey', 'Smokum', 'Smythe', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy', 'Source Code Pro', 'Source Sans Pro', 'Special Elite', 'Spicy Rice', 'Spinnaker', 'Spirax', 'Squada One', 'Stalemate', 'Stalin One', 'Stalinist One', 'Stardos Stencil', 'Stint Ultra Condensed', 'Stint Ultra Expanded', 'Stoke', 'Strait', 'Sue Ellen Francisco', 'Sunshiney', 'Supermercado One', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tahoma', 'Tangerine', 'Taprom', 'Tauri', 'Telex', 'Tenor Sans', 'Terminal Dosis', 'Terminal Dosis Light', 'Text Me One', 'Thabit', 'The Girl Next Door', 'Tienne', 'Tinos', 'Titan One', 'Titillium Web', 'Trade Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen One', 'Ubuntu', 'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Vampiro One', 'Varela', 'Varela Round', 'Vast Shadow', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting for the Sunrise', 'Wallpoet', 'Walter Turncoat', 'Warnes', 'Wellfleet', 'Wendy One', 'Wire One', 'Yanone Kaffeesatz', 'Yellowtail', 'Yeseva One', 'Yesteryear', 'Zeyada', 'jsMath cmbx10', 'jsMath cmex10', 'jsMath cmmi10', 'jsMath cmr10', 'jsMath cmsy10', 'jsMath cmti10');
		
		
			$fonts = array(				
				"" => array(				
					"name" => "Default Font",
					"google" => 1,					
				),
			);
			
			foreach($googleFonts as $g){
				
				$hh = explode(" ", $g);
				
				$fonts[$hh[0]] = array(
				
					"name" => $g,
					"google" => 1,					
				);
			}	
			
			if(is_array($order_data) && !empty($order_data) && $order_data[1] == "code"){
			
			return $fonts[$order_data[0]]['code'];
			
			}elseif(is_array($order_data) && !empty($order_data) && $order_data[1] == "name" && isset($fonts[$order_data[0]]) ){
			
			return $fonts[$order_data[0]]['name'];
			
			}elseif(is_array($order_data) && empty($order_data)){
				
				$n = array();
				foreach($fonts as $fk => $f){
				$n[$fk] = $f['name'];
				}
				return $n;
			
			}	
		
		
		} break;

		
		case "key":{
		
			// GET PAGE KEY		
			
			if(isset($GLOBALS['flag-footer-block'])){
			
				$pagekey = "footer";
				
			}elseif(isset($_GET['innerpageid']) && current_user_can('administrator')  ){
			
				$pagekey = "page_".$_GET['innerpageid'];			
			
			}elseif(is_page()){
							
				$pagekey = strtolower(str_replace("templates/","", str_replace("tpl-","", str_replace("tpl-page-","", str_replace(".php","", get_page_template_slug())))));	
				
				if( defined('THEME_FOLDER') ){
					$pagekey = str_replace(THEME_FOLDER."/", "", $pagekey);
				}
				$pagekey = "page_".$pagekey;	
			 
			
			}elseif( isset($GLOBALS['flag-home']) || isset($_GET['loadpage']) ){
						
				$pagekey = "home";
				
			}else{
			
				$pagekey = "";
			}
			 
			return $pagekey;
				
		} break;
	
		case "get_logo": {
		
			
	 
			if($order_data == "light"){
				$logo = _ppt(array('design','light_logo_url'));			
				if($logo == ""){
					$logo = _ppt(array('design','logo_url'));
				}
				$logocss = "navbar-brand-light";		
			}else{
				$logo = _ppt(array('design','logo_url'));
				$logocss = "navbar-brand-dark";		
			}
			
			$textlogo = trim(_ppt(array('design','textlogo')));
			
			
			global $df;
			if(isset($df['logo_text'])){			
			$textlogo = $df['logo_text']; 			
			} 
			
		 
			if($logo == "" && $textlogo == ""){
				$textlogo = "Website<span>Logo</span>";
			} 
			
			if( strlen($textlogo) > 1){
			return "<div class='textlogo ".$logocss."'>".$textlogo."</div>";
			}
			
			// FULL PATH
			return "<img src='".$logo."' alt='logo' class='".$logocss."' />";	
	
 		
		} break;
	
		case "get_color": {
		
			// CHECK TYPE
			if(is_array($order_data)){				
				$csstype = $order_data[0];			
			}else{				
				$csstype = $order_data;			
			}
			
			 
		
			if($csstype == "primary"){
			
			
				if(isset($order_data[1]) && strlen($order_data[1]) > 1 ){
					$color = $order_data[1];
				}else{
					$color = _ppt(array("design","color_primary"));
				}
			
			 
			
			if(strlen($color) > 3){
			ob_start(); ?><style>
			.bg-primary, .bg-primary:hover,.bg-primary:focus, a.bg-primary:focus, a.bg-primary:hover, button.bg-primary:focus, button.bg-primary:hover, .badge-primary  { background:<?php echo $color; ?> !important; }
			
			<?php /*if(strlen(_ppt(array("design","color_primary_soft"))) > 1){ ?>.bg-soft, .bg-primary-soft { background:<?php echo _ppt(array("design","color_primary_soft")); ?>!important; }<?php }*/ ?>
			
			.btn-primary, .btn-primary:hover { color: #fff; background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; } 			
			.text-primary, .filters_col .distance span { color: <?php echo $color; ?> !important; }
			.btn-outline-primary { color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
			.btn-outline-primary:hover { background:none !important; }
			.text-primary a  { color: <?php echo $color; ?> !important; }
			
			[ppt-nav].active-underline > ul > li.active > a { border-bottom: 2px solid <?php echo $color; ?>!important; }
			
			<?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp")) ){ ?>
			.btn-ppt-coupon { background:<?php echo $color; ?>!important; }
			.btn-ppt-coupon.withcode .pealbit:after { border-top: 100px solid <?php echo $color; ?>!important; }
			
			
			
			<?php } ?>
			
			
			
			</style><?php $d = ob_get_clean(); 
			return hook_color_primary_css(strip_tags($d));
			}
			
			
			}elseif($csstype == "secondary"){
			
			
			if(isset($order_data[1]) && strlen($order_data[1]) > 1 ){
				$color = $order_data[1];
			}else{
				$color = _ppt(array("design","color_secondary"));
			}
			 
			
			if(strlen($color) > 3){
			ob_start();?><style>
			.bg-secondary, .bg-secondary:hover, .bg-secondary:focus, a.bg-secondary:focus, a.bg-secondary:hover, button.bg-secondary:focus, button.bg-secondary:hover, .irs-bar  { background-color:<?php echo $color; ?> !important; } 
			.btn-secondary, .btn-secondary:hover, .btn-secondary:focus { color: #fff; background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
			 
			<?php /*if(strlen(_ppt(array("design","color_secondary_soft"))) > 1){ ?>.bg-soft-secondary, .bg-secondary-soft { background:<?php echo _ppt(array("design","color_secondary_soft")); ?> }<?php }*/ ?>
			  
			.text-secondary { color: <?php echo $color; ?> !important; }
			.text-secondary a  { color: <?php echo $color; ?> !important; }
			.btn-outline-secondary { color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
			.btn-outline-secondary:hover { background:none !important; }
			
			.custom-control-input:checked~.custom-control-label::before, .filter_sortby a.active {
				color: #fff;
				border-color: <?php echo $color; ?> !important;
				background-color: <?php echo $color; ?> !important;
			}
			
            </style><?php $d = ob_get_clean();
			
			return hook_color_secondary_css(strip_tags($d));
			}
			}elseif($csstype == "bglight"){
			
			$color = _ppt(array("design","color_bglight"));
			if(strlen($color) > 3){
			ob_start();?><style>
			
			.bg-light { background:<?php echo $color; ?> !important; } 
			
			 </style><?php $d = ob_get_clean();
			
			return hook_color_bglight_css(strip_tags($d));
			}
			}elseif($csstype == "bgdark"){
			
			$color = _ppt(array("design","color_bgdark"));
			if(strlen($color) > 3){
			ob_start();?><style>
			.bg-dark { background:<?php echo $color; ?> !important; } 
			 </style><?php $d = ob_get_clean();
			
			return hook_color_bgdark_css(strip_tags($d));
			}
			
			}elseif($csstype == "bg"){
			
			$color = _ppt(array("design","color_bg"));
			$color_text = _ppt(array("design","color_text")); 
			
			$link_light = _ppt(array('design','color_link_light'));
			$link_dark = _ppt(array('design','color_link_dark'));
			
			$border = _ppt(array('design','color_border'));
			
			$box = _ppt(array('design','color_box'));
			$box_text = _ppt(array('design','color_box_text'));
			
			
			$search = _ppt(array('design','color_search'));
			$search_text = _ppt(array('design','color_search_text'));
			 
			$breadcrumbs = _ppt(array('design','color_breadcrumbs'));
			$breadcrumbs_text = _ppt(array('design','color_breadcrumbs_text'));
			
			
			ob_start();?><style>
			<?php if(strlen($color) > 3){ ?>body { background:<?php echo $color; ?> !important; <?php if(strlen($color_text) > 1){ ?>color:<?php echo $color_text; ?>!important; <?php } ?> } <?php } ?>
			
			<?php if(strlen($link_dark) > 2){ ?>.link-dark, a.text-dark { color:<?php echo $link_dark; ?>!important; }<?php } ?>
			<?php if(strlen($link_light) > 2){ ?>.link-light, a.text-light  { color:<?php echo $link_light; ?>!important; }<?php } ?>
			
			<?php if(strlen($border) > 2){ ?> .border-top { border-top: 1px solid <?php echo $border; ?>!important; } .border-bottom { border-bottom: 1px solid <?php echo $border; ?>!important; }  <?php } ?>
			
			<?php if(strlen($box) > 2){ ?> .single-listing_type [ppt-box] { background:<?php echo $box; ?>!important; border:0px!important; } .single-listing_type [ppt-box] ._header:not(.shadow-none) { border:0px!important; } <?php } ?>
			
			<?php if(strlen($box_text) > 2){ ?> .single-listing_type [ppt-box] { color:<?php echo $box_text; ?>!important;  } .card-filter .card-title { border:0px; } <?php } ?>
			
			<?php if(strlen($search) > 2){ ?> body:not(.search-results) .filterboxWrap [ppt-border1] { background:<?php echo $search; ?>!important; border:0px!important;  }  <?php } ?>
			<?php if(strlen($search_text) > 2){ ?> body:not(.search-results) .filterboxWrap [ppt-border1] { color:<?php echo $search_text; ?>!important;  }  <?php } ?>
			
			<?php if(strlen($breadcrumbs) > 2){ ?> .page-breadcrumbs { background:<?php echo $breadcrumbs; ?>!important; border:0px!important;  }  <?php } ?>
			<?php if(strlen($breadcrumbs_text) > 2){ ?> .page-breadcrumbs { color:<?php echo $breadcrumbs_text; ?>!important;  }  <?php } ?>
			
			 
			 </style><?php $d = ob_get_clean();
			
			return strip_tags($d);
			
			
			
			}
		
		} break;
		
		
		case "get_placeholder_text_new": {
		 
			$b 	= $order_data[0];
			$e			= $order_data[1];
			$v 			= array();
			
			
			$v["text102"]["title"] = array( __("We put you in touch with nearby girls and guys!","premiumpress") );								 
			 
			$v["text124a"]["t"] = array( __("USA","premiumpress") );								 
			$v["text124b"]["t"] = array( __("UK","premiumpress") );								 
			$v["text124c"]["t"] = array( __("India","premiumpress") );								 
			$v["text124d"]["t"] = array( __("Canada","premiumpress") );								 
			$v["text124e"]["t"] = array( __("Mexico","premiumpress") );								 
			$v["text124f"]["t"] = array( __("Spain","premiumpress") );	
		 
			$v["text129a"]["t"] = array( __("Summer Sales","premiumpress") );								 
			$v["text129b"]["t"] = array( __("Valentine's Day","premiumpress") );								 
			$v["text129c"]["t"] = array( __("Book a Hotel","premiumpress") );								 
			$v["text129d"]["t"] = array( __("Website Hosting","premiumpress") );								 
		 	
			$v["text129a"]["s"] = array( __("50% Off Big Brands","premiumpress") );								 
			$v["text129b"]["s"] = array( __("75% Off Flowers","premiumpress") );								 
			$v["text129c"]["s"] = array( __("Book a Hotel Under $99","premiumpress") );								 
			$v["text129d"]["s"] = array( __("Upto 80% Web Hosting","premiumpress") );								 
		  		
			$v["hero1"]["t"] = array( __("Build Amazing New Websites Today!","premiumpress") ); 								 
			$v["hero1"]["s"] = array( __("Save time and money - get started now!","premiumpress") );  
			
			$v["button"]["join_now"] = array( __("Join Now","premiumpress") ); 
			$v["button"]["signup_now"] = array( __("Signup Now","premiumpress") ); 
			$v["button"]["start_search"] = array( __("Start Search","premiumpress") ); 
			$v["button"]["search_all"] = array( __("Search All","premiumpress") ); 
			$v["button"]["my_account"] = array( __("My Account","premiumpress") ); 
			$v["button"]["logout"] = array( __("Logout","premiumpress") ); 
			$v["button"]["sign_in"] = array( __("Sign In","premiumpress") ); 
			$v["button"]["register"] = array( __("Register","premiumpress") ); 
			$v["button"]["start_search_here"] = array( __("Start your search here...","premiumpress") ); 
	 		$v["button"]["all_categories"] = array( __("All Categories","premiumpress") ); 
			$v["button"]["add"] = array( __("Add New","premiumpress") ); 
			
			$v["button"]["addnew"] = array( __("Post Ad","premiumpress") ); 
			
			$v["button"]["load_more"] = array( __("Load More","premiumpress") ); 
			
			$v["short"]["pop_stores"] =  array( __("Popular Stores","premiumpress") );
			$v["short"]["more"] =  array( __("View More","premiumpress") );
			$v["short"]["pop"] =  array( __("Popular","premiumpress") );
			$v["short"]["pop_cats"] =  array( __("Popular Categories","premiumpress") );
			
			$v["short"]["already"] =  array( __("Already a member?","premiumpress") );
			
			
			
			$v["short"]["latest_deals"] =  array( __("Latest Deals","premiumpress") );
			 
			$v["short"]["newly_added"] = array( str_replace("%s", $CORE->LAYOUT("captions","2"), __("Newly Added %s","premiumpress")) ) ;
			$v["short"]["featured_listings"] = array( str_replace("%s", $CORE->LAYOUT("captions","2"), __("Featured %s","premiumpress")) ) ;
			  
			$v["short"]["search"] = array( str_replace("%s", $CORE->LAYOUT("captions","2"), __("1000+ %s","premiumpress")) ) ;
			  
			 
			$v["cta"]["1"] = array( __("Create your free account today!","premiumpress") );
			
			
			$v["code"]["typewriter"] = array( __("a Web Designer?,an Accountant?,a Teacher?,a Lawyer?","premiumpress") );
			 
			 
			 
			// return $b." ".$e.$v[$b][$e][0];
			 
	 		
			switch(THEME_KEY){
			
						case "cb": {	
											
						$v["code"]["typewriter"] = array( __("a new Camera?,a new Watch?,a new DVD Player?","premiumpress") );						
						$v["text102"]["title"] = array( __("Big discounts on 1,000+ popular items.","premiumpress") );
						
						$v["hero1"]["t"] = array( __("Save $$$ Online With Cashback &amp; Deals","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Buy products and services using affiliate links on our website and we'll give you cashback!","premiumpress") ); 
						
						$v["text124a"]["t"] = array( __("Internet Services","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Health & Beauty","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Fashion","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Software","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Services","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Pet Supplies","premiumpress") );						
						$v["button"]["addnew"] = array( __("Add Deal","premiumpress") ); 
						
						} break;
			
			
						case "at": {						
						$v["code"]["typewriter"] = array( __("a new Bike?,a new Car?,a new Washing machine?","premiumpress") );						
						$v["text102"]["title"] = array( __("Quality auction items at half their original value.","premiumpress") );
						$v["hero1"]["t"] = array( __("1,000+ Live Auctions Online Right Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Quality auction items up for sale - grab yourself a bargain today!","premiumpress") ); 
						$v["text124a"]["t"] = array( __("Cars & Vehicles","premiumpress") );								 
						$v["text124b"]["t"] = array( __("For Sale","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Property","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Jobs","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Services","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Pets","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Add Auction","premiumpress") ); 
						
						} break; 
						
						case "cm": {						
						$v["code"]["typewriter"] = array( __("a new Camera?,a new Watch?,a new DVD Player?","premiumpress") );						
						$v["text102"]["title"] = array( __("Quality products at half their retail prices.","premiumpress") );
						$v["hero1"]["t"] = array( __("Save Money on 1,000+ Popular Products.","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Price comparison website saving you time and money.","premiumpress") ); 
						$v["text124a"]["t"] = array( __("Cameras","premiumpress") );								 
						$v["text124b"]["t"] = array( __("DVD Players","premiumpress") );								 
						$v["text124c"]["t"] = array( __("TV's","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Dishwahers","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Services","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Pet Food","premiumpress") );
						} break;
						
						case "cp": {						
						$v["code"]["typewriter"] = array( __("a new Camera?,a new Watch?,a new DVD Player?","premiumpress") );						
						$v["text102"]["title"] = array( __("Big discounts on 1,000+ popular items.","premiumpress") );
						$v["hero1"]["t"] = array( __("Save $$$ Online With Coupons &amp; Deals","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Coupon code website saving you time and money on 1,000+ popular products and services.","premiumpress") ); 
						$v["text124a"]["t"] = array( __("Internet Services","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Health & Beauty","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Fashion","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Software","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Services","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Pet Supplies","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Add Coupon","premiumpress") ); 
						
						} break;
						
						case "ct": {
						 			
						$v["hero1"]["t"] = array( __("Free Classifieds Ads <br> Get Started Today!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Buy and sell items and find bargains in your area.","premiumpress") ); 						
						$v["text102"]["title"] = array( __("Buy and sell your old stuff today! Join free and get started now.","premiumpress") );							 
						$v["text124a"]["t"] = array( __("Cars & Vehicles","premiumpress") );								 
						$v["text124b"]["t"] = array( __("For Sale","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Property","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Jobs","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Services","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Pets","premiumpress") );
						} break;
						
						case "dl": {
						
						$v["code"]["typewriter"] = array( __("a new Car?,a new Bike?,soemthing else?","premiumpress") );							
						$v["hero1"]["t"] = array( __("Over 1,000 New &amp; Used Cars Online Now","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Buy and sell cars and find bargains in your area.","premiumpress") );
						$v["text102"]["title"] = array( __("We put you in touch with nearby car owners and dealships.","premiumpress") );
						$v["text124a"]["t"] = array( __("New Cars","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Used Cars","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Motorbikes","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Trucks","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Camper Vans","premiumpress") );								 
						$v["text124f"]["t"] = array( __("All Vehicles","premiumpress") );	
						
						$v["button"]["addnew"] = array( __("Add Vehicle","premiumpress") ); 
			 						  
						} break;
						
						case "da": {
						
						$v["code"]["typewriter"] = array( __("a girlfriend?,a boyfriend?,a date?","premiumpress") );
			 				
						$v["hero1"]["t"] = array( __("Over 1,000 People Waiting To Meet You.","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Meet someone new today.","premiumpress") );
						$v["text102"]["title"] = array( __("We put you in touch with nearby girls and guys!","premiumpress") );
						$v["text124a"]["t"] = array( __("Girls","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Guys","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Couples","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Other","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Mature Men","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Mature Women","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Add Profile","premiumpress") ); 
			 							  
						} break;
						
						case "dt": {
												
						$v["hero1"]["t"] = array( __("Over 1,000 Local Business Listings.","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Need someone to help? You'll find them here!","premiumpress") ); 						
						$v["hero1"]["d"] = array( __("We put you in touch with local businesses in your area.","premiumpress") ); 	
						$v["text102"]["title"] = array( __("We put you in touch with local businesses in your area.","premiumpress") );	
						$v["button"]["addnew"] = array( __("Add Business","premiumpress") );
						
						} break;
						
						case "es": {						
						$v["hero1"]["t"] = array( __("Meet Local Escorts Online Right Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Stunning escorts for incalls and outcalls.","premiumpress") ); 
						$v["code"]["typewriter"] = array( __("a Cuddle?,a Massage?,something else?","premiumpress") );						
						$v["text124a"]["t"] = array( __("Non Asian Girls","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Asian Girls","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Blonde Escorts","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Busty Escorts","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Mature Escorts","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Sensual Massage","premiumpress") );						
						$v["button"]["addnew"] = array( __("Add Profile","premiumpress") ); 			 
						
						} break;
						
						case "jb": {						
						$v["hero1"]["t"] = array( __("Over 1,000 Jobs Available Right Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Get back to work today - find your next job here.","premiumpress") );
						$v["text102"]["title"] = array( __("We put you in touch with local and international employers.","premiumpress") );
						$v["text124a"]["t"] = array( __("Full-time","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Part-time","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Contract","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Other","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Internship","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Temporary","premiumpress") );
						
						
						$v["button"]["addnew"] = array( __("Post Job","premiumpress") ); 
													  
						} break;
						
						case "ll": {						
						$v["hero1"]["t"] = array( __("Over 1,000 Courses Online Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Learn a new skill online today.","premiumpress") );
						$v["text102"]["title"] = array( __("We put you in touch with teachers and tutors to help you learn a new skill.","premiumpress") );
						 							  
						} break;
						
						
						case "mj": {						
						$v["text102"]["title"] = array( __("We put you in touch with the most creative freelances online!","premiumpress") );
						$v["hero1"]["t"] = array( __("1,000+ Freelancers Online Right Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("We have hundreds of talented people waiting to hear from you, start your next project today.","premiumpress") ); 			  
						$v["text124a"]["t"] = array( __("Writing","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Design &amp; Creative","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Legal","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Sales &amp; Marketing","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Translation","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Design &amp; Creative","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Post Job","premiumpress") ); 
							
						} break;
						
						case "ph": {						
						$v["text102"]["title"] = array( __("We put you in touch with the most creative freelances online!","premiumpress") );
						$v["hero1"]["t"] = array( __("10,000+ Royalty Free Stock Images","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("High quality stock images, videos and music shared by our talented community.","premiumpress") ); 			  
						$v["text124a"]["t"] = array( __("Photos","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Illustrations","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Vectors","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Videos","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Music","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Sound Effects","premiumpress") );	
						} break;
						  
						
						case "pj": {
						$v["text102"]["title"] = array( __("We put you in touch with the most creative freelances online!","premiumpress") );
						$v["hero1"]["t"] = array( __("1,000+ Freelancers Online Right Now!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("We have hundreds of talented people waiting to start work. Find a freelancer today!","premiumpress") ); 			  			
						$v["text124a"]["t"] = array( __("Writing","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Design &amp; Creative","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Legal","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Sales &amp; Marketing","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Translation","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Design &amp; Creative","premiumpress") );
						} break;
						
						case "rt": {
						$v["text102"]["title"] = array( __("We've got local real estate experts on standby waiting to help you.","premiumpress") );
						$v["hero1"]["t"] = array( __("5,000+ Properties Online To Buy &amp; Let","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("We have hundreds of available property online right. Find your next home today!","premiumpress") ); 			  			
						$v["text124a"]["t"] = array( __("Apartments","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Detached","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Semi-Detached","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Terraced","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Bungalow","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Office Space","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Add Home","premiumpress") ); 
						
						} break;
						
						case "so": {
						$v["text102"]["title"] = array( __("We've got some of the most popular software online - download now.","premiumpress") );
						$v["hero1"]["t"] = array( __("Download the best software today!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Popular software titles at half their orginal value.","premiumpress") ); 			  			
						$v["text124a"]["t"] = array( __("Web Development","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Desktop","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Graphic Apps","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Education","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Business","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Games","premiumpress") );
						} break;
						
						case "sp": {
						
						$v["code"]["typewriter"] = array( __("a new Watch?,a new Hat?","premiumpress") );
						$v["text102"]["title"] = array( __("We've got fashion worked out - take a look at some of our latest items.","premiumpress") );
						$v["hero1"]["t"] = array( __("Upto 50% Off <br> Sale Starts Today!","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Everything must go in our summer sale.","premiumpress") ); 			  			
						$v["text124a"]["t"] = array( __("Electronics","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Sports","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Digital","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Furniture","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Jewelry","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Watches","premiumpress") );
						
						//$v["button"]["start_search"] = array( __("Browse Store","premiumpress") );
						
						} break;
						
						case "vt": {
						$v["text102"]["title"] = array( __("Join our community today and start uploading your own videos.","premiumpress") );
						$v["hero1"]["t"] = array( __("Over 1,000+ Videos Online Right Now","premiumpress") ); 								 
						$v["hero1"]["s"] = array( __("Welcome to our video community - join free today and start learning something new.","premiumpress") ); 			  			
						$v["text124a"]["t"] = array( __("Science & Tech","premiumpress") );								 
						$v["text124b"]["t"] = array( __("Soaps","premiumpress") );								 
						$v["text124c"]["t"] = array( __("Travel","premiumpress") );								 
						$v["text124d"]["t"] = array( __("Education","premiumpress") );								 
						$v["text124e"]["t"] = array( __("Music","premiumpress") );								 
						$v["text124f"]["t"] = array( __("Nature","premiumpress") );
						
						$v["button"]["addnew"] = array( __("Add Video","premiumpress") ); 
						
						
						$v["code"]["typewriter"] = array( __("Helpful Tutorials,Video Courses,Tips &amp; Tricks","premiumpress") );
			
						
						} break;
	  
						
						
			}
			
			
			
			if(isset($v[$b][$e]) && is_array($v[$b][$e]) ){
			
			return $v[$b][$e][0]; 
			
			}
			
			return "&nbsp;"; 
		
		
		} break;		
		
		case "get_placeholder_text": {
		
			$defaults = array(
				"hero" => array(				
					"title" 	=> __("Build Amazing New Websites Today!","premiumpress"),
					"subtitle" 	=> "",
					"desc" 		=> __("Save time and money - get started now!","premiumpress"),
					 
				),
				 
				"listings" => array(				
					"title" 		=> __("Newly Added","premiumpress"),
					"subtitle" 		=> __("Take a look at some of our latest items.","premiumpress"),
					"desc" 			=> __("Save time and money - get started now!","premiumpress"),
					
					 
				),	
				
				"text1" => array(				
					"title" 		=> __("Create Beautiful Websites In Minutes With PremiumPress","premiumpress"),
					"subtitle" 		=> __("150+ design blocks to choose from.","premiumpress"),
					"desc" 			=> __("PremiumPress themes come with 150+ ready-made drag &amp; drop design blocks making it easy to create stunning websites.","premiumpress"),
					"btn" 			=> __("Get Started","premiumpress"),
					 
				),	
				"text2" => array(				
					"title" 		=> __("Download PremiumPress Today!","premiumpress"),
					"subtitle" 		=> __("It's quick to install and easy to setup.","premiumpress"),
					"desc" 			=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
					"btn" 			=> __("Get Started","premiumpress"),
					 
				),	
				"text" => array(				
					"title" 		=> __("Welcome to our website!","premiumpress"),
					"subtitle" 		=> __("We've got exactly what you're looking for!","premiumpress"),
					"desc" 			=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", 
				),
				"icon" => array(				
					"title" 		=> "We know you'll love our service.",
					"subtitle" 		=> "",
					"desc" 			=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ",
					 
				),	
				"cta" => array(				
					"title" 		=> __("High Conversion CTA Section","premiumpress"),
					"subtitle" 		=> __("Call to action buttons help bring focus to user attention.","premiumpress"),
					"desc" 			=> "",
					 
				),			
				 
				"testimonials" => array(				
					"title" 		=> __("Recent Customer Feedback","premiumpress"),
					"subtitle" 		=> __("Over 50,000+ customers worldwide","premiumpress"),
					"desc" 			=> __("We've included everything you need to build amazing websites in one theme.","premiumpress"), 
				),				
				"blog" => array(				
					"title" 		=> __("Latest News","premiumpress"),
					"subtitle" 		=> __("stay updated and join our newsletter","premiumpress"),
					"desc" 			=> "We've included everything you need to build amazing websites in one theme.", 
				),					
				"faq" => array(				
					"title" 		=> __("Common FAQ","premiumpress"),
					"subtitle" 		=> __("Commonly asked questions & answers","premiumpress"),
					"desc" 			=> __("If you can't find answers to your questions below, contact us.","premiumpress"), 
				),	
				"pricing" => array(				
					"title" 		=> __("Pricing made for everyone","premiumpress"),
					"subtitle" 		=> __("All pricing packages are backed up by a 30-day money back guarantee.","premiumpress"),
					"desc" 			=> "", 
				),	
				"subscribe" => array(				
					"title" 		=> __("Join Our Newsletter","premiumpress"),
					"desc" 		=> __("Stay updated with the latest news and updates.","premiumpress"),
					  
				),
				"video" => array(
					"title" 		=> __("Built using the latest HTML5 Web standards","premiumpress"),
					"subtitle" 		=> __("Optimized for speed and search engines.","premiumpress"),
					"desc" 			=> "We've included everything you need to build amazing websites in one theme.", 
				),
				"slider" => array(				
					"title" 		=> "<small>PremiumPress Themes</small> Build Amazing Websites Today!",
					"subtitle" 		=> "Get Started Today!",
					"desc" 			=> "Build Amazing Websites Today!",
					  
				),
				"users" => array(				
					"title" 		=> "Popular Users",
					"subtitle" 		=> "amazing people here to help you.",
					"desc" 			=> "",
					  
				),
				"category" => array(				
					"title" 		=> __("Popular Website Categories","premiumpress"),
					"subtitle" 		=> __("Find what your looking for, right now!","premiumpress"),
					"desc" 			=> "",
					  
				),
				 				  
																			 
			);
			
			  
			
			// 1. TYE
			// 2. BLOCK
			// 3. NUMBER
			  
			switch($order_data[0]){
			
				 				
				case "title": {
			 	
					if(isset($order_data[1]) && is_numeric($order_data[1])){
					
						$titles_array = array(
							1 => __("24/7 Support","premiumpress"),
							2 => __("Members Area","premiumpress"),
							3 => __("Easy to Navigate","premiumpress"),
							4 => __("Free To Register","premiumpress"),
							5 => __("Message System","premiumpress"),
							6 => __("Author Profiles","premiumpress"),
							7 => __("Facebook Login","premiumpress"),
							8 => __("Message System","premiumpress"),							
							9 => __("Regular Updates","premiumpress"),							
							10 => __("Elementor","premiumpress"),							
							
						);
						
						return $titles_array[$order_data[1]];
						
					}elseif( isset($defaults[$order_data[1]]['title']) ){	
					 	
						return $defaults[$order_data[1]]['title'];
						
					}else{
								
					return "Welcome to my webiste!";
					
					}
				
				} break;				
			 				
				case "subtitle": {
					
					if( isset($defaults[$order_data[1]]['subtitle']) ){	
					 	
						return $defaults[$order_data[1]]['subtitle'];
						
					}else{
								
					return "Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos. ";
					
					}
					
				
				} break;
	 	
				case "desc": {
				
					 if( isset($order_data[1]) && isset($defaults[$order_data[1]]['desc']) ){	
					 	
						return $defaults[$order_data[1]]['desc'];
						
					}else{
								
					return "Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos.";
					
					}
					 		 
				
				} break;
				case "desc_big": {					 
								
					return "Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos. Mazim nemore singulis an ius, nullam ornatus nam ei. ldque maiestatis vis ut. Quo in tacimates recusabo scripserit, in mea tantas soleat imperdiet.";	 
				
				} break;
				
				case "desc_small": {					 
								
					return "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";	 
				
				} break;
				
				  
				case "link_video": {
				
					return "https://www.youtube.com/watch?v=sKDAblffdI8";
					
				} break;
				case "quote": {					
					return "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";				
				} break;
				case "quote_name": {					
					return "John Doe";				
				} break;
				case "quote_job": {					
					return "PremiumPress";				
				} break;
											
				default: {
				
					return $order_data[0];
				}
			
			}
			
			
		
		
		} break;
		
		case "get_placeholder": {
		
			//$order_data[0]
			//$order_data[1]
			//$order_data[2] // type {user, text}
		 
			if($order_data[0] == "slider"){
			
			
				 
				if(isset($order_data[1]) ){
					
						$r = array(
						
							"slider_inline" => "https://via.placeholder.com/1210x540/000000/FFFFFF/",
					
						);
						
						return $r[$order_data[1]];
						
					}else{
								
					return "https://via.placeholder.com/1940x500/000000/FFFFFF/";
					
					}
			
			
			}elseif($order_data[0] == "user"){
			
				return DEMO_IMG_PATH."user/".$order_data[1].".jpg";
			
			}elseif($order_data[0] == "full"){
			
				if(isset($order_data[1]) && strlen($order_data[1]) > 1){
					
						$r = array(
							
							"dark" => "https://via.placeholder.com/1940x500/000000/FFFFFF/",
							"light" => "https://via.placeholder.com/1940x500/efefef/FFFFFF/",
							 			
							
						);
						
						return $r[$order_data[1]];
						
					}else{
								
					return "https://via.placeholder.com/1940x500/000000/FFFFFF/";
					
					}
			
			
			
			}elseif($order_data[0] == "hero"){
			
				if(isset($order_data[1]) && is_numeric($order_data[1])){
					
						$r = array(
							1 => DEMO_IMG_PATH."random/full/1.jpg",
							2 => DEMO_IMG_PATH."random/full/2.jpg",
							3 => DEMO_IMG_PATH."random/full/3.jpg",
							4 => DEMO_IMG_PATH."random/full/4.jpg",
							5 => DEMO_IMG_PATH."random/full/5.jpg",					
							
						);
						
						return $r[$order_data[1]];
						
					}else{
								
					//
					
					}
			
				return "https://via.placeholder.com/1940x500/000000/FFFFFF/";
				
			}elseif($order_data[0] == "text"){
				
				return DEMO_IMG_PATH."".THEME_KEY."/preview/text/".$order_data[1]."_bg.jpg";
 			
			}elseif($order_data[0] == "square"){
			
			return "https://via.placeholder.com/800x800/000000/FFFFFF/";
 			
			} 
			 
		 	
			return "https://via.placeholder.com/".$order_data[0]."x".$order_data[1]."/000000/FFFFFF/";
		
		
		
		} break;
		
		case "get_innerpage_blocks": {
		 
				
				// LIST ALL THEME PAGES
				$pages = array(
				
					"page_aboutus" 		=> array("name"=> __("About Us","premiumpress"), "flag" => "flag-aboutus", "blocks" => array('text103', 'text101','text104') , "link" => _ppt(array('links','aboutus')), "order" => 3),			
				 
					"page_sellspace" 	=> array("name"=> __("Advertising","premiumpress"), "blocks" => array( 'headline23',  'pricing11' , 'text112') , "link" => _ppt(array('links','sellspace')), "order" => 4),	
					
					"page_contact" 		=> array("name"=> __("Contact Us","premiumpress"), "blocks" => array('text106', 'text107') , "link" => _ppt(array('links','contact')), "order" => 5),	
							 
					"page_memberships" 	=> array("name"=> __("Memberships","premiumpress"), "blocks" => array('headline23', 'pricing1') , "link" => _ppt(array('links','memberships')), "order" => 6),
					
					"page_terms" 		=> array("name"=> __("T&amp;C Page","premiumpress"), "blocks" => array("text150") , "link" => _ppt(array('links','terms')), "order" => 13),
					
					"page_privacy" 		=> array("name"=> __("Privacy","premiumpress"), "blocks" => array() , "link" => _ppt(array('links','privacy')), "order" => 13),	
							
					"page_faq" 			=> array("name"=> __("FAQ","premiumpress"), "blocks" => array('text99', 'text110','text111' ) , "link" => _ppt(array('links','faq')), "order" => 10),	
					
					"page_testimonials" => array("name"=> __("Testimonials","premiumpress"), "blocks" => array('text105', 'testimonials1','text112' ) , "link" => _ppt(array('links','testimonials')), "order" =>9),	
							
					"page_how" 			=> array("name"=> __("How It Works","premiumpress"), "blocks" => array('text102', 'text108', 'text109' ), "link" => _ppt(array('links','how')), "order" => 8),
					 
					"page_add" 			=> array("name"=> __("Add Listing","premiumpress"), "blocks" => array('pricing10' , 'icon11'), "link" => _ppt(array('links','add')), "order" => 8),
					
					"page_stores" 		=> array("name"=> __("Stores","premiumpress"), "blocks" => array('stores2' ), "link" => _ppt(array('links','stores')), "order" => 9),					
					
					"page_chatroom" 	=> array("name"=> __("Chatroom","premiumpress"), "link" => _ppt(array('links','chatroom')), "order" => 13),
					
					"page_categories" 	=> array("name"=> __("Categories","premiumpress") , "blocks" => array('category8a' ) , "link" => _ppt(array('links','categories')), "order" => 10),	
					  
					"page_agency" 	=> array("name"=> __("Agencies","premiumpress") , "blocks" => array('listings10b' ) , "link" => _ppt(array('links','agency')), "order" => 15),	
					
					// DEMO EXTRAS
					"page_account" 			=> array("name"=> __("My Account","premiumpress"), "link" => _ppt(array('links','myaccount')), "order" => 2),					
					"page_blog" 			=> array("name"=> __("Blog","premiumpress"), "blocks" => array('blog2' ), "link" => _ppt(array('links','blog')), "order" => 11),					 
					"page_login" 			=> array("name"=> __("Login","premiumpress"), "link" => wp_login_url() , "order" => 12),
					"page_register" 		=> array("name"=> __("Register","premiumpress"), "link" => wp_registration_url()  , "order" => 13),
					
					//"page_lostpassword" 		=> array("name"=> "Lost Password", "link" => $this->_ppt_home_url()."/wp-login.php?action=lostpassword"  ),
					
					"page_search" 		=> array("name"=> __("Search","premiumpress"), "link" => $this->_ppt_home_url()."/?s="  , "order" => 1),
					
					"page_pricing" 	=> array("name"=> __("Pricing","premiumpress") , "blocks" => array( 'headline23', 'pricing10' , 'text116') , "link" => _ppt(array('links','pricing')), "order" => 21),	
					
					
					 
				);  
				
				if(defined('THEME_KEY') && !in_array(THEME_KEY, array("es")) ){
				 
					unset($pages['page_agency']);
				}
				
				if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp","cm")) ){
				
				}else{
					unset($pages['page_stores']);
				}
				 
				// REMOVE PER THEME
				if(defined('THEME_KEY') && THEME_KEY == "sp"){
					unset($pages['page_add']);
					unset($pages['page_memberships']);					
				}
				
				if(defined('THEME_KEY') && THEME_KEY != "da"){
					unset($pages['page_chatroom']);					 				
				}
				
				if( !$CORE->LAYOUT("captions","memberships") ){ 
				unset($pages['page_memberships']);	
				}
				
				if( !$CORE->LAYOUT("captions","listings") ){ 
				unset($pages['page_add']);	
				}
				
				
				if($order_data == "demo"){
					
					return $pages;
				
				}else{
					
					// REMOVE PAGES FROM ARRAY
					// WHICH DO NOT HAVE BLOCKS (DEMO ONLY )
					foreach($pages as $kk => $k){ 
						 
						if(!isset($k['blocks'])){						 					
							unset($pages[$kk]); 
						}
					}			
				
				}
				
				 
				// CREATE BLOCK DATA FROM BUILT IN ARRAY
				$innerd  = $CORE->LAYOUT("default_innerpages", array() ); 
				foreach($pages as $k => $o){
				
					if(isset($innerd[$k]) && is_array($innerd[$k]) ){
					
						$blocksdata = array();
						foreach($innerd[$k] as $j => $cc){							
								$blocksdata[$j] = $j; 						
						}						
						$pages[$k]['blocks'] = $blocksdata;	
						 
					}				
				}	
				
				
				
				if(is_array($order_data) && empty($order_data) ){
				
				return $pages;
				
				}elseif(is_array($order_data) && !empty($order_data) ){
				
					 $k = $order_data[0];
					  
					 if(isset($pages[$k]) && is_array($pages[$k]['blocks'])){
					  
					  
						 foreach($pages[$k]['blocks'] as $k){
						 	
							
								 
							 if(_ppt(array(str_replace("page_","",$order_data[0]),$k)) == "delete"){
							 
							 	
							 }else{
							 
							 
							 	if( in_array($k, array("icon10","text8")) && ( _ppt(array('design', 'customsidebar')) == 1 || isset($GLOBALS['flag-page-sidebar']) ) ){	
									 					 
									continue;
								}
							
								echo do_action( $k."-css" );
								echo do_action( $k );
								echo do_action( $k."-js" );
							
							}
							
						 }
					 }
				
				
				}else{
				
				return $pages[$order_data];
				
				}
				 
		
		} break;
	 
		
		case "get_block_data": {
		
			$data = $this->LAYOUT("get_blocks_data", array());
		
			if( is_array($data) && isset($data[$order_data]) && isset($data[$order_data]) ){
									
			return $data[$order_data];	
				
			}		
		
		} break;
		
		case "get_block_defaults": {
		
			$data = $this->LAYOUT("get_blocks_data", array());
		
			if( is_array($data) && isset($data[$order_data]) && isset($data[$order_data]['defaults']) ){
									
			return $data[$order_data]['defaults'];	
				
			}		
		
		} break;
		
		case "get_block_category": {
		
			$data = $this->LAYOUT("get_blocks_data", array());
		
			if( is_array($data) && isset($data[$order_data]) ){
									
			return $data[$order_data]['cat'];	
				
			}		
		
		} break;
		
		case "get_block_count": {
		
			$data = $this->LAYOUT("get_blocks_data", array());
			$count = array();
			foreach($data as $k => $v){
			
				if(!isset($v['widget'])){ continue; }
				if(isset($v['copy'])){ continue; }
				
				if(is_array($v['cat']) ){
				
					foreach($v['cat'] as $cat){
					
						if(isset($count[$cat])){
						$count[$cat]['count'] = $count[$cat]['count']+1;
						}else{
							$count[$cat] = array("count" => 1);
						}
					}
					
				
				}else{
				
					$cat = $v['cat'];
					
					if(isset($count[$cat])){
						$count[$cat]['count'] = $count[$cat]['count']+1;
					}else{
						$count[$cat] = array("count" => 1);
					}
				
				}
					
				
			
			}	
			
			return $count;
		
		} break;
		
		case "get_block_prewview": {
		
			$data = $this->LAYOUT("get_blocks_data", array()); 
		
			if( is_array($data) && isset($data[$order_data])  ){ 
			
				$cat = "";
				if(is_array($data[$order_data]['cat'])){
				$cat = $data[$order_data]['cat'][0];
				}else{
				$cat = $data[$order_data]['cat'];
				}
			 
			 return DEMO_IMGS."?blocks=1&cat=".$cat."&tid=".str_replace(".jpg","",$data[$order_data]['image'])."&t=".THEME_KEY;
			
			//return DEMO_IMG_PATH."blocks/".$data[$order_data]['cat']."/".$data[$order_data]['image'];
	 			
			}		
		
		} break;
		
		case "get_block_widget": {
		
			$data = $this->LAYOUT("get_blocks_data", array()); 
		 	
			if(is_array($data) && isset($data[$order_data]) && isset($data[$order_data]['widget'])){
			return $data[$order_data]['widget'];
			}else{
			return ELEMENTOR_WIDGET_NAME;
			}		 
	 				
		} break;
	 
		case "get_slots": {	
		
			$slots = array(
			 
				"header" => array (
					"id" => "header_style",
					"name" => "Header",					
				),
				
				"footer" => array (
					"id" => "footer_style",
					"name" => "Footer",	
				),
				 
				1 => array (
					"id" => "slot1_style",
					"name" => "Slot 1",	
				),
			
				2 => array (
					"id" => "slot2_style",
					"name" => "Slot 2",	
				),
				
				3 => array (
					"id" => "slot3_style",
					"name" => "Slot 3",	
				),
				
				4 => array (
					"id" => "slot4_style",
					"name" => "Slot 4",	
				),				
				
				5 => array (
					"id" => "slot5_style",
					"name" => "Slot 5",	
				),
				
				6 => array (
					"id" => "slot6_style",
					"name" => "Slot 6",	
				),	
				
				7 => array (
					"id" => "slot7_style",
					"name" => "Slot 7",	
				),	
				
				8 => array (
					"id" => "slot8_style",
					"name" => "Slot 7",	
				),
				
				9 => array (
					"id" => "slot9_style",
					"name" => "Slot 9",	
				),
				
					
				
			);
			
			if( is_array($order_data) && !empty($order_data) ){
			
				$h = array();
				foreach($order_data as $c){
			 	
				$h[$c] = $slots[$c];
				}
				
				return $h;
				
			
			}else{
			
				return $slots;
			}
			
				
		} break;	
		
		

	
		case "get_block_types": {	
		
			$blocks = array(
			 
				0 => array(	
					"name" 		=>  __("Header","premiumpress"), 
					"id" 		=> "header",
					"color"	 	=> "#e5e5e5",
					"icon" 		=> "fal fa-bars",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/header.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/header.png",
					"num"		=> "20+",
				),	
							
				1 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Footer","premiumpress"), 
					"id" 	=> "footer",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-copyright",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/footer.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/footer.png",
					"num"		=> "20+",
				),	
				
				
				20 => array(	 
					"name" =>  __("Headlines","premiumpress"), 
					"id" 	=> "headline",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-object-ungroup",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/headline.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/headline.png",
					"num"		=> "20+",
				),
				
			
				 	
				2 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Hero","premiumpress"), 
					"id" 	=> "hero",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-object-group",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/hero.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/hero.png",
					"num"		=> "20+",
				),
				3 => array (
					"name" =>  __("Text","premiumpress"), 
					"id" 	=> "text",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-text",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/text.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/text.png",
					"num"		=> "20+",
				),
				4 => array (
					"name" =>  __("Features","premiumpress"), 
					"id" 	=> "icon",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-icons",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/icons.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/icon.png",
					"num"		=> "20+",
				),
				5 => array (
					"name" =>  __("Call-to-action","premiumpress"), 
					"id" 	=> "cta",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-bullseye-pointer",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/cta.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/cta.png",
					"num"		=> "5+",
				),			 			
				6 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Contact Us","premiumpress"), 
					"id" 	=> "contact",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-envelope",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/contact.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/contact.png",
					"num"		=> "5+",
				),				
											
				7 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Video","premiumpress"), 
					"id" 	=> "video",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-video",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/video.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/video.png",
					"num"		=> "5+",
				),
											
				8 => array(	// FOR OLDER SYSTEM
					"name" =>  __("FAQ","premiumpress"), 
					"id" 	=> "faq",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-question-circle",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/faq.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/faq.png",
					"num"		=> "5+",
				),	
												
				9 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Listings","premiumpress"), 
					"id" 	=> "listings",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-align-left",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/listings.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/listings.png",
					"num"		=> "20+",
				),	
				 
				
				10 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Testimonials","premiumpress"), 
					"id" 	=> "testimonials",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-star",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/testimonials.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/testimonials.png",
					"num"		=> "10+",
				),
					
				11 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Subscribe","premiumpress"), 
					"id" 	=> "subscribe",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-envelope",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/subscribe.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/subscribe.png",
					"num"		=> "10+",
				),
				/*
				12 => array (
					"name" =>  __("Image Grids","premiumpress"), 
					"id" 	=> "image_block",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-images",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/image_blocks.jpg",
					"num"		=> "20+",
				),
				*/	
				
				13 => array (
					"name" =>  __("Category","premiumpress"), 
					"id" 	=> "category",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-folders",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/category.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/category.png",
					"num"		=> "10+",
				),
								
				14 => array (
					"name" =>  __("Search","premiumpress"), 
					"id" 	=> "search",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-search",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/search.jpg",
					"num"		=> "5+",
				),
				 
				
				15 => array (
					"name" =>  __("Blog","premiumpress"), 
					"id" 	=> "blog",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-rss",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/blog.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/blog.png",
					"num"		=> "5+",
				),
				
				16 => array (
					"name" =>  __("Pricing","premiumpress"), 
					"id" 	=> "pricing",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-tags",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/pricing.jpg",
					"image_big" => DEMO_IMG_PATH."/demo/blocks/big/pricing.png",
					"num"		=> "10+",
				),
				
				17 => array (
					"name" =>  __("Stores","premiumpress"), 
					"id" 	=> "store",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-home",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/stores.jpg",
					"num"		=> "5+",
				),
				
				/*
				18 => array (
					"name" =>  __("Listing Page","premiumpress"), 
					"id" 	=> "listingpage",
					"color" => "#87c8f7",
					"icon"	=> "fal fa-file",
					"num"	=> "10",
				),
				*/
				
				19 => array (
					"name" =>  __("Users","premiumpress"), 
					"id" 	=> "users",
					"color" => "#87c8f7",
					"icon" 		=> "fal fa-users",
					"image" 	=> DEMO_IMG_PATH."/demo/blocks/users.jpg",
					"num"		=> "5+",
				),
				
				
				21 => array (
					"name" 		=>  __("Blocks","premiumpress"), 
					"id" 		=> "block",
					"color" 	=> "#87c8f7",
					"icon" 		=> "fal fa-cube",
					"image" 	=> "",
					"num"		=> "5+",
				),
				
								
			);
			
			if(in_array(defined('THEME_KEY'), array("cp","cm"))){
			
			}else{
			
			unset($blocks[17]);
			}
			 
			
			return $blocks;   
		
		} break;
		
		case "get_blocks_data": {  		
		
			return apply_filters( 'ppt_blocks_args', array() );			 
		
		} break;
		
		case "load_css": {
			
			$blocks_css  = "";
			
			// GET PAGE
			$key = $this->LAYOUT("key",array()); 
			
			if($key == "home"){
			// GET
			$css = "";
			$g = $this->LAYOUT("get_slots", array());
			foreach($g as $k){
				
				$h = _ppt(array('design', $k['id']));
				
				// DEFAULTS
				if($k['id'] == "header_style" && $h == ""){
				$h = "header3";
				
				}elseif($k['id'] == "footer_style" && $h == ""){
				$h = "footer1";
				 
				} 		
					
				if($h != ""){
				ob_start();
				do_action($h.'-css');
				$css .= ob_get_clean();
				}
			}
			
			$blocks_css = $css;
			
			} 
			 
    
			
			$custom_css  =  $this->LAYOUT("get_color","primary"); 
			$custom_css .=  $this->LAYOUT("get_color","secondary"); 
			$custom_css .=  $this->LAYOUT("get_color","bglight"); 
			$custom_css .=  $this->LAYOUT("get_color","bgdark"); 
			$custom_css .=  $this->LAYOUT("get_color","bg"); 
			
			// MOBILE VIEW
			if(isset($_SESSION['mobile_view'])){  
			$custom_css  .= '::-webkit-scrollbar {    width: 0;}';
			}
			
			// ADMIN CUSTOM CSS
			$custom_css .= stripslashes(get_option('custom_head'));
			 
			return preg_replace('/\s+/', ' ',trim(str_replace("<style>","", str_replace("</style>","", $blocks_css.$custom_css))));
		
		} break;
		
		case "load_js": {
		
				$css = "";				
				
				// CHECK FOR DEFAULT FONTS
				foreach($CORE->LAYOUT("get_fonttypes", array() ) as $fk => $f){
					
					if(_ppt(array('design', $fk)) != ""){
				 
					$h = _ppt(array('design', $fk));					
					$t = $this->LAYOUT("get_fonttypes", $fk);
				 
					ob_start();?>					
					<script>
					jQuery(document).ready(function() {	
						jQuery("head").append("<link href='https://fonts.googleapis.com/css?family=<?php echo $CORE->LAYOUT("get_fonts", array($h, "name") ); ?>' rel='stylesheet' id='ppt-google-fonts' type='text/css'>");
						jQuery("head").find('style').append('<?php echo $t['code']; ?> { font-family: "<?php echo $CORE->LAYOUT("get_fonts", array($h, "name") ); ?>", Sans-serif!important; }');
					});</script><?php 
					$css .= ob_get_clean();
					
					}    
				
				}
				
			
				$key = $this->LAYOUT("key", array());
				 
				if($key == ""){ return $css; }			 
			 
				if(isset($GLOBALS['CORE_THEME'][$key])){
					$dd = $GLOBALS['CORE_THEME'][$key];
				}else{
					$g = get_option("core_admin_values");
					if(isset($g[$key])){
					$dd = $g[$key];
					}else{
						$dd = array();
					}
				}
				
				if($dd == ""){ 
					$dd = array();
				}
				
				 
				$im = "";
				if(is_array($dd)){
					foreach($dd as $bb){ 
						if(is_array($bb)){
							foreach($bb as $hk => $h){
						
								if(strpos($hk,"font") !== false && $h != "" ){	 //	
									
								ob_start();?>					
								<script>
								jQuery(document).ready(function() {	
									jQuery("head").append("<link href='https://fonts.googleapis.com/css?family=<?php echo $CORE->LAYOUT("get_fonts", array($h, "name") ); ?>' rel='stylesheet' type='text/css'>");
									jQuery("head").find('style').append('.font-<?php echo $h; ?> { font-family: "<?php echo $CORE->LAYOUT("get_fonts", array($h, "name") ); ?>", serif; }');
								});</script><?php $css .= ob_get_clean();
								
								}
						
							} 
					
						}
					}
				}
				
				
		
		
			// GET
			$g = $this->LAYOUT("get_slots", array());
			foreach($g as $k){
				
				$h = _ppt(array('design', $k['id']));
				
				// DEFAULTS
				if($k['id'] == "header_style" && $h == ""){
				
				$h = "header3";
				
				}elseif($k['id'] == "footer_style" && $h == ""){
				
				$h = "footer1";
				
				} 
					
				if($h != ""){
				ob_start();
				do_action($h.'-js');
				$css .= ob_get_clean();
				}
			}
			
			return str_replace("","", str_replace("","", $css));
		
		} break;
		
		case "load_all_by_cat": {
		
			$h = array();
			$data = $this->LAYOUT("get_blocks_data", array());
		 		
			if( is_array($data) && !empty($data)  ){			 
			
				foreach($data as $k => $g){	
				
				
					if(is_array($g['cat']) && !is_array($order_data) && in_array($order_data, $g['cat'])){
					
						$h[$k] =  $data[$k];
			 
			 		}elseif(is_array($order_data) && !is_array($g['cat']) &&  in_array($g['cat'], $order_data)){
					 
						$h[$k] =  $data[$k];
					
					}elseif($g['cat'] == $order_data){
					
					
						// HIDE FROM SYSTEM
						if($k == "listingpage_openinghours" && !in_array(THEME_KEY, array("dt"))){
						continue;
						}						
						 
						if($k == "listingpage_title" && in_array(THEME_KEY, array("da"))){
						continue;
						} 
						
						if($k == "listingpage_author" && !in_array(THEME_KEY, array("at","mj"))){
						continue;
						} 
						
						
						if(in_array($k, array("listingpage_comments","listingpage_map","listingpage_content","listingpage_images","listingpage_sidebar")) && THEME_KEY == "cp" ){
						continue;
						}
						
					
						$h[$k] =  $data[$k];
						
					}				
				}
			}
			
			return $h;
		
		} break;
		
		case "load_designs_by_theme": {
		
			$h = array();
			if( is_array($this->all_admin_layouts)  ){
			
				foreach($this->all_admin_layouts as $k => $g){				
			 
			 		if(is_array($order_data) && in_array($g['theme'], $order_data)){
					
						$h[$k] =  $this->all_admin_layouts[$k];
					
					
					}elseif(is_array($g['theme']) && in_array($order_data, $g['theme']) ){
					
						$h[$k] =  $this->all_admin_layouts[$k];
					
					}elseif($g['theme'] == $order_data){
					
						$h[$k] =  $this->all_admin_layouts[$k];
						
					}				
				}
			}
			
			return $h;
		
		} break;
		
		case "load_single_design": {	
		  	
			if(isset($this->all_admin_layouts[$order_data])){
			 
			return $this->all_admin_layouts[$order_data];
			
			}
			
		} break;
				
		case "load_all": {
			
			$data = $this->LAYOUT("get_blocks_data", array());			
			
			
			if( is_array($data) && !empty($data) ){					
				
			
				foreach($data as $k => $g){
				
					if($g['cat'] == $order_data){
					
						echo do_action( $k."-css" );
						echo do_action( $k );
						if($g['cat'] == "header" && isset($_GET['ppt_live_preview']) ){
						echo "<div style='height:200px; background:grey'></div>";
						}
						echo do_action( $k."-js" );
						
						echo "<div class='w-100 bg-black py-3 text-white text-center'>".$k."</div>";
						
					}				
				}
			}
		
		} break;
		
		case "load_random_block": {
		
		
			$h = array();
			
			$data = $this->LAYOUT("get_blocks_data", array());
			
			if( is_array($data) && !empty($data)  ){
			
				foreach($data as $k => $g){				
			 
			 		if(is_array($order_data) && in_array($g['cat'], $order_data)){
					
						$h[$k] =  $data[$k];
					
					}elseif($g['cat'] == $order_data){
					
						$h[$k] =  $data[$k];
						
					}				
				}
			}
			
			$rand_keys = array_rand($h, 2);			 
			$ran = $rand_keys[0]; 
			
			echo do_action( $ran."-css" );
			echo do_action( $ran."-js" );
			 
			$this->LAYOUT("load_single_block",$ran);
 		
		} break;
		
		case "load_single_block": { 
		 
			$data = $this->LAYOUT("get_blocks_data", array());
			 
			 
			if(is_array($order_data)){
				foreach($order_data as $b){
				
					if( is_array($data) && isset($data[$b]) ){
									
						echo do_action( $b );	
						echo do_action( $b."-css" );
						echo do_action( $b."-js" );	
						
					}
				
				}
			
		 	}elseif( is_array($data) && isset($data[$order_data]) ){
									
					echo do_action( $order_data );		
					echo do_action( $order_data."-css" );
					echo do_action( $order_data."-js" );					
			}
		
		} break;
		

		case "load_single_value": {		
	 
				// KEYS
				$key1 = $order_data[0];	// name
				$key2 = $order_data[1];	// id
			
				
				//return $key1." ".$key2; ( isset($_SESSION['design_preview']) && strlen($_SESSION['design_preview']) > 1)
				 
				// GET DATABASE SAVE KEY
				if(isset($order_data[2]) && strlen($order_data[2]) > 1){
					$mainkey = $order_data[2];								
				}else{				
					$mainkey = $this->LAYOUT("key", array());				 
				} 
				  
				// CLEAN UP KEY
				$mainkey = str_replace("page_","", str_replace("homepage","home", $mainkey ) );  // THIS IS THE PAGE KEY (HOME, ABOUTUS, SINGLE ETC ETC)
				   		  
				// LOAD ALL CORE DATA
				$show_default_data = 0;
				if(  isset($_GET['ppt_live_preview']) && isset($_GET['defaultdata']) && ( defined('WLT_DEMOMODE') || current_user_can('administrator')  )   ){
				  	
				$HDATA = array();
				$show_default_data = 1;
				}else{
				$HDATA = _ppt($mainkey);  
				} 
				
				// CHECK IF THERE IS DATA SAVED
				// IN THE MAI DATABASE				
				if(isset($key2) && substr($key2,-4) == "_aid"){						 
					if($exta == "post_title" && isset($HDATA[$key1][$key2]) ){
						return get_the_title($HDATA[$key1][$key2]);
					}						
				}elseif(is_array($HDATA) && isset($HDATA[$key1][$key2]) && $HDATA[$key1][$key2] != "" && _ppt_pagelinking($mainkey) == "" ){  
							
					return stripslashes($HDATA[$key1][$key2]); 
						
				}	
				 
					 
				// if value is blank and it's an inner page
				// lets check for some default content				
				if(_ppt_pagelinking($mainkey) == "" && !$show_default_data ){		 // IS NOT ELEMENTOR PAGE
				 	
					$innerd  = $CORE->LAYOUT("default_innerpages", array() );	
					  
					if(isset($innerd[$mainkey])){ 
						
						$HDATA = $innerd[$mainkey];	
						  
												 		 			
						if(is_array($HDATA) && isset($HDATA[$key1][$key2]) && $HDATA[$key1][$key2] != ""){ 	
						
							$non_elementor_data = _ppt($mainkey);
							if(is_array($non_elementor_data) && isset($non_elementor_data[$key1][$key2]) && $non_elementor_data[$key1][$key2] != ""){ 
							
							return stripslashes($non_elementor_data[$key1][$key2]); 	
							
							}else{	
											 
							return stripslashes($HDATA[$key1][$key2]); 	
							
							}
							
													
						}
					}	
								
				}
				///////////////////////////////////////
				
				
				
				if(isset($_GET['ppt_live_preview'])  ){
				 
				 
					$default_data = $CORE->LAYOUT("get_block_defaults", $key1);
					
					if(is_array($default_data) && !empty($default_data)){
						if(isset($default_data[$key2]) && $default_data[$key2] != ""){ 						 
							return stripslashes($default_data[$key2]); 							
						}
					} 
					
					return "";
				}
				
				  
				 
		} break;
		
		
		case "get_block_settings_defaults_new": {
			
			$s = array();
			
			
			if( is_array($order_data) ){
			
				
				$cat 		=  $order_data[0];
				$blockid 	=  $order_data[1];
				
				 
				 $df = ppt_theme_blocks_defaults($cat); 
				
				 foreach($df as $g => $gg){
				 	if($g != ""){
					
						if(in_array($cat,array("footer","header"))){
							
							$s[$g]		= $CORE->LAYOUT("load_single_value", array($blockid, $g, $cat) );
							 
						}else{
				 			$s[$g]		= $CORE->LAYOUT("load_single_value", array($blockid, $g) );
						}
					}
				 }
				 
				
			 
				/*
				if(!in_array($cat, array("header")) ){ 				
					$s["section_bg"]		= $CORE->LAYOUT("load_single_value", array($blockid, 'section_bg') );		
					$s["section_divider"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'section_divider') );		
					$s["section_padding"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'section_padding') );					
					$s["section_overlay"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'section_overlay') );
					$s["section_w"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'section_w') ); 
					 
				} 
				 
				// GLOBAL
				foreach(array(
				
				"title", "title_color", "title_underline", "title_underline_color",  "title_animated", "title_align", "title_tag", "title_font", "title_font_size", "title_font_weight",
				
				"subtitle", "subtitle_color", "subtitle_underline",  "subtitle_underline_color",   "subtitle_animated", "subtitle_align", "subtitle_tag", "subtitle_font", "subtitle_font_size", "subtitle_font_weight",
				
				"desc", "desc_color", "desc_underline",  "desc_underline_color",   "desc_animated", "desc_align", "desc_tag", "desc_font", "desc_font_size", "desc_font_weight",
				
				
				"btn_bg", "btn2_bg", "btn_bg_color", "btn2_bg_color") as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
				}
				*/
				
				
				// HERO
				if(in_array($cat, array("hero")) ){ 
					foreach(array("searchbox","searchboxmap") as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
					}					 
				}
				
				// HEADLINE
				if(in_array($cat, array("headline")) ){
					foreach(array("design") as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
					}					 
				}
				
				// BLOG
				if(in_array($cat, array("blog")) ){ 
					foreach(array("show","cat") as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
					}					 
				}
				
				// CATEGORY
				if(in_array($cat, array("category")) ){
					foreach(array("design", "cat", "cat_subs", "hide_empty", "tax","limit") as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
					}					 
				} 
				 
				
				if(in_array($cat, array("text","hero")) ){ 				
					$s["image"]				= $CORE->LAYOUT("load_single_value", array($blockid, 'image') );
				}
					
				if(in_array($cat, array("listings","text")) ){ 
						
					
					foreach(array(
					
					"image1", "image2", "image3", "image4", "image5", "image6",
					
					"image1_link", "image2_link", "image3_link", "image4_link", "image5_link", "image6_link",
					
					"image1_txt", "image2_txt", "image3_txt", "image4_txt", "image5_txt", "image6_txt",
					
					"image1_txt1", "image2_txt1", "image3_txt1", "image4_txt1", "image5_txt1", "image6_txt1",
					
					) as $jj){
						$s[$jj]		= $CORE->LAYOUT("load_single_value", array($blockid, $jj) );	
				}	
						
					 	
					
				} 
				
				
				
				if(in_array($cat, array("listings")) ){ 
				
				 	$s["perrow"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'perrow'));						
					$s["show"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'show'));					
					$s["card"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'card'));	
					
					$s["order"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'order'));
					$s["orderby"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'orderby'));
					$s["custom"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'custom'));
					  
				}
				
			
			}
			 
			
			return $s;
		
		
		} break;
		
		case "get_block_settings_defaults": {
		  
			if( is_array($order_data) ){
			
				$blockid 	=  $order_data[0];
				$cat 		=  $order_data[1];
				$s 			=  $order_data[2];
				
				
				
				
				//return $CORE->LAYOUT("get_block_defaults", $blockid );
		 
				
				
				// GLOBAL SECTION TITLES
				if(!in_array($cat, array("header","footer")) ){ 					
				
					// TITLE STYLE
					$s["title_pos"]		= $CORE->LAYOUT("load_single_value", array($blockid, 'title_pos') );
					$s["title_heading"]		= $CORE->LAYOUT("load_single_value", array($blockid, 'title_heading') );
					
					$s["title_show"]	= $CORE->LAYOUT("load_single_value", array($blockid, 'title_show') );
					$s["title_style"]	= $CORE->LAYOUT("load_single_value", array($blockid, 'title_style') );
					$s["title"]			= $CORE->LAYOUT("load_single_value", array($blockid, 'title'));	
					$s["subtitle"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'subtitle'));	
					$s["desc"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'desc'));
					 	
					$s["title_margin"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'title_margin'));
					$s["subtitle_margin"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'subtitle_margin'));
					$s["desc_margin"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'desc_margin'));
					
					
					$s["title_font"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'title_font'));
					$s["subtitle_font"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'subtitle_font'));
					$s["desc_font"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'desc_font'));
					 
					$s["title_txtcolor"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'title_txtcolor'));
					$s["subtitle_txtcolor"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'subtitle_txtcolor'));
					$s["desc_txtcolor"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'desc_txtcolor'));
					
					$s["title_txtw"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'title_txtw'));
					$s["subtitle_txtw"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'subtitle_txtw'));
					
					
					/*
					if($s["title_show"]  == ""){
						
						
						//defaults
						switch($cat){
							case "hero":{
							 
							} break;							
							case "icon": {	
							
								$s["title_show"] = "yes"; 
								$s["title_style"] = "1";
								$s["title_heading"]	 = "h2"; 
								
								$s["title"] = $CORE->LAYOUT("get_placeholder_text", array('title', $cat) );	
								$s["subtitle"] = $CORE->LAYOUT("get_placeholder_text", array('subtitle', $cat) );	
								$s["desc"] = $CORE->LAYOUT("get_placeholder_text", array('desc', $cat) );
						
													
								$s["desc_txtcolor"] = "opacity-5";								
							} break;
							case "image_block": {							
								$s["title_pos"] = "center";		
								$s["desc_margin"] = "mb-5";							
							} break;
							case "category": {							
								$s["title_pos"] = "center";
								$s["subtitle_txtcolor"] = "primary";
							} break;
							case "listings": {							
								$s["title_pos"] = "center";
							} break;
							case "video":
							case "text": {							
								$s["desc_txtcolor"] = "opacity-5";
								$s["subtitle_txtcolor"] = "primary";							
							} break;
							case "cta": {							
								$s["desc_txtcolor"] = "opacity-5";
								$s["subtitle_txtcolor"] = "dark";
								$s["title_txtcolor"] = "primary";								 						
							} break;					
						}// end switch  
					
					}*/
					
					
				}
				
				// GLOBAL SECTION PADDING
				if(!in_array($cat, array("header","hero",'intro')) ){ 
					
					$extra = "";
					if($cat == "footer"){
					$extra = "footer";
					}
			
					// GLOBAL SECTION	
					$s["section_class"]		= ""; //"block-cat-".$cat." block-".$blockid;
					if(!array($cat)){
						$s["section_class"]		.= "block-cat-".$cat;
					}
					if(!array($blockid)){
						$s["section_class"]		.= " block-".$blockid;
					}
					 
					
					$s["section_bg"]		= $CORE->LAYOUT("load_single_value", array($blockid, 'section_bg', $extra) );		
					$s["section_divider"] 	= "";//$CORE->LAYOUT("load_single_value", array($blockid, 'section_divider', $extra) );		
					$s["section_padding"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'section_padding', $extra) );
					$s["section_pos"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'section_pos', $extra) );
					$s["section_pattern"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'section_pattern', $extra) );
					 
					 
					$s["section_w"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'section_w', $extra) );
					 
					if($s["section_w"] == ""){ $s["section_w"] = "container"; }
					
					if($s["section_pos"] == "center"){
					$s["section_class"]	.= " text-center";
					}
					 
					
					// PADDING DEFAULTS FOR DESIGNS 
					if($s["section_padding"] == ""){
					
						 
						//defaults
						switch($cat){
							case "cta": {							
								$s["section_bg"] 		= "bg-light";
								$s["section_padding"] 	= "section-40";						
							} break;
							
							case "footer": {							
								 
								$s["section_padding"] 	= "section-60";						
							} break;
							
							default: {							
								$s["section_padding"] 	= "section-60";							
							} break;					
						}// end switch
					}				
					 
				
				}
				
				// GLOBAL BUTTONS
				if(in_array($cat, array("header","hero","cta","text","faq","icon","video",'intro','store','category')) ){ 
				
					$extra = "";
					if($cat == "header"){
						$extra = "header";
					}
			
					$s["btn_show"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_show', $extra));
						
					$s["btn_style"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_style', $extra));					
					$s["btn_size"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_size', $extra));
					$s["btn_icon"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_icon', $extra));					
					$s["btn_icon_pos"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_icon_pos', $extra));				
					
					$s["btn_font"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_font'));					
					
					$s["btn_txt"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_txt', $extra));
					$s["btn_link"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_link', $extra));
					$s["btn_bg"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_bg', $extra));
					$s["btn_bg_txt"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_bg_txt', $extra));					
					$s["btn_margin"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_margin', $extra));
					$s["btn_txtw"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn_txtw', $extra));
					
					// REPLACE
					$s["btn_link"] = $CORE->_ppt_filter_link($s["btn_link"]);					
					
					// REPLACE ICON
					$s["btn_icon"] = str_replace( "far fa", "fa fa", $s["btn_icon"] );
				 
				
				}	
				// GLOBAL BUTTONS
				if(in_array($cat, array("hero","text","icon","video",'intro')) ){ 
			
					$s["btn2_show"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_show'));
						
					$s["btn2_style"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_style'));					
					$s["btn2_size"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_size'));
					$s["btn2_icon"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_icon'));					
					$s["btn2_icon_pos"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_icon_pos'));					
					
					$s["btn2_font"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_font'));					
							
					$s["btn2_txt"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_txt'));
					$s["btn2_link"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_link'));
					$s["btn2_bg"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_bg'));
					$s["btn2_bg_txt"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_bg_txt'));					
					$s["btn2_margin"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_margin'));
					$s["btn2_txtw"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'btn2_txtw', $extra));
					
					// REPLACE
					$s["btn2_link"] = $CORE->_ppt_filter_link($s["btn2_link"]);
					
					// REPLACE ICON
					$s["btn2_icon"] = str_replace( "far ", "fa ", $s["btn2_icon"] ); 
					
				}					
				
							
				
				// HEADER
				if($cat == "header"){
				 	 
					$s["topmenu_show"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'topmenu_show', 'header'));					 
					$s["extra_show"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'extra_show', 'header'));
				  	$s["extra_type"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'extra_type', 'header'));
				  	 	
					/* defaults */
					if($s["topmenu_show"]  == ""){ $s["topmenu_show"]  = "yes"; }					 
					
				}
				
				// FOOTER
				if($cat == "footer"){
				 	 
					$s["footer_copyright"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_copyright', 'footer'));					 
					$s["footer_description"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_description', 'footer'));					 
				
					$s["footer_copyright_style"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_copyright_style', 'footer'));					 
				
					$s["footer_menu1"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_menu1', 'footer'));					 
					$s["footer_menu2"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_menu2', 'footer'));					 
				
					$s["footer_menu1_title"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_menu1_title', 'footer'));					 
					$s["footer_menu2_title"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'footer_menu2_title', 'footer'));					 
				
				}
				
				// STORES BLOCK
				if($cat == "store"){
				 	 
					//$s["topmenu_show"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'topmenu_show', 'header'));					 
				 	
				}
				 
				if($cat == "users"){
				 	 
					$s["user_type"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'user_type'));					 
				 	
				}
				
				// GLOBAL IMAGE BLOCKS
				if($cat == "image_block"){
				
					$i=1; 
					while($i < 7){
				 	
					 $s["image_block".$i] 				= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i) );
					 $s["image_block".$i."_effect"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_effect') );
					 $s["image_block".$i."_size"] 		= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_size') );
					 $s["image_block".$i."_txtcolor"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_txtcolor') );
					 
					 $s["image_block".$i."_txtpos"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_txtpos') );
					 
					 $s["image_block".$i."_title"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title') );
					 $s["image_block".$i."_subtitle"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle') );
					 
					  $s["image_block".$i."_title_margin"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title_margin') );
					 $s["image_block".$i."_subtitle_margin"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle_margin') );					 
				 	 
				 	 $s["image_block".$i."_title_txtcolor"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title_txtcolor') );
					 $s["image_block".$i."_subtitle_txtcolor"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle_txtcolor') );					
					
					 $s["image_block".$i."_title_txtsize"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title_txtsize') );
					 $s["image_block".$i."_subtitle_txtsize"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle_txtsize') );					
					
					 $s["image_block".$i."_title_font"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title_font') );
					 $s["image_block".$i."_subtitle_font"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle_font') );					
					
					 $s["image_block".$i."_title_txtw"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_title_txtw') );
					 $s["image_block".$i."_subtitle_txtw"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_subtitle_txtw') );					
					
			  		 $s["image_block".$i."_btn_show"] 		=	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_show') );					
					 $s["image_block".$i."_btn_txt"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_txt') );
					 $s["image_block".$i."_btn_bg"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_bg') );
					 $s["image_block".$i."_btn_bg_txt"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_bg_txt') );
					 $s["image_block".$i."_btn_icon"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_icon') );
					 $s["image_block".$i."_btn_icon_pos"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_icon_pos') );
					 $s["image_block".$i."_btn_size"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_size') );
					 $s["image_block".$i."_btn_margin"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_margin') );
					 $s["image_block".$i."_btn_style"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_style') );
					 $s["image_block".$i."_btn_font"] 	= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_font') );
					 $s["image_block".$i."_btn_link"] 		= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_block'.$i.'_btn_link') );
					
					 
						/* defaults */
						if($s["image_block".$i."_effect"]  == ""){ $s["image_block".$i."_effect"]  =  1; }	
						
						// REPLACE						
						$s["image_block".$i."_btn_link"] = $CORE->_ppt_filter_link($s["image_block".$i."_btn_link"]);
						
					$i++; 
					}
				
				}
				
				
				// LISTING PAGE
				if($cat == "listingpage"){	
					
					// TITLE
					//$s["listingpage_title_social"] 				= 	$CORE->LAYOUT("load_single_value", array($blockid, 'listingpage_title_social') );					
					$s["listingpage_title_style"] 				= 	$CORE->LAYOUT("load_single_value", array($blockid, 'listingpage_title_style') );
					
					// IMAGES
					$s["listingpage_images_style"] 				= 	$CORE->LAYOUT("load_single_value", array($blockid, 'listingpage_images_style') );
					
					
				}
				
				// GLOBAL ICON BLOCKS
				if($cat == "icon"){					
					$i=1; 
					
					$s["image_icon"] 				= 	$CORE->LAYOUT("load_single_value", array($blockid, 'image_icon') );
					
					while($i < 11){
						$s["icon".$i] 				= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i) );
						$s["icon".$i."_title"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_title') );
						$s["icon".$i."_desc"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_desc') );
						$s["icon".$i."_link"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_link') );
						$s["icon".$i."_txtcolor"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_txtcolor') );
						$s["icon".$i."_iconcolor"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_iconcolor') );
						
						// FILTER LINK
						$s["icon".$i."_link"] = $CORE->_ppt_filter_link($s["icon".$i."_link"]);
						
						
						$s["icon".$i."_type"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_type') );
						$s["icon".$i."_image"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'icon'.$i.'_image') );
						
						
						// REMOVE FAR
						$s["icon".$i]  = str_replace("far ","fa ", $s["icon".$i] );
						
						if($s["icon".$i."_txtcolor"] == ""){
							$s["icon".$i."_txtcolor"] = "dark";
						}
						
						if($s["icon".$i."_iconcolor"] == ""){
							$s["icon".$i."_iconcolor"] = "primary";
						}
						
						$i++; 
					}
					
				}
				
				
				
				// GLOBAL ICON BLOCKS
				if($cat == "hero"){	
				
					$s["hero_size"]			= $CORE->LAYOUT("load_single_value", array($blockid, 'hero_size'));
					if($s["hero_size"] == ""){
						$s["hero_size"] = "hero-large";
					} 
					
					// USED TO CONTROL MENU COLOR	
					$s["hero_txtcolor"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'hero_txtcolor') );
					if($s["hero_txtcolor"] == ""){
						$s["hero_txtcolor"] = "light";
					} 
					
					$s["hero_image"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'hero_image') );
					
					$s["hero_overlay"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'hero_overlay') );
					  	  
					 
				}
				
				// GLOBAL ICON BLOCKS
				if($cat == "cta"){
				
					$s["image_cta"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'image_cta' ) );						 
					 
				}
				
				// GLOBAL TEXT
				if($cat == "text" || $cat == "video"){
					 
					 	$i=1; 
						while($i < 7){
				
							$s["text_image".$i] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'text_image'.$i) );
							$s["text_image".$i."_title"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'text_image'.$i.'_title') );
							$s["text_image".$i."_link"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'text_image'.$i.'_link') );
							
							// FILTER LINK
							$s["text_image".$i."_link"] 	= $CORE->_ppt_filter_link($s["text_image".$i."_link"]);
						 
						$i++; 
						}						 
				}
				
				// GLOBAL VIDEO
				if($cat == "video"){
				
					$s["video_link"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'video_link') );
					if($s["video_link"] == ""){
						$s["video_link"] = "https://www.youtube.com/watch?v=8wSMWMHx1AI";
					}
				 
				}
				 
				
				// GLOBAL SLIDER
				if($cat == "slider"){					
					$i=1; 
					while($i < 4){
					 	
						// IMAGE
						$s["image".$i] 					= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i));
						$s["image".$i."_txtcolor"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_txtcolor'));
						$s["image".$i."_txtdir"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_txtdir'));						 	
						$s["image".$i."_title"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_title'));
						$s["image".$i."_desc"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_desc'));
						
						$s["image".$i."_btn_text"]		= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_btn_text'));
						$s["image".$i."_btn_link"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'image'.$i.'_btn_link'));
						
						// FILTER LINK
						$s["image".$i."_btn_link"] = $CORE->_ppt_filter_link($s["image".$i."_btn_link"]);
						 
						// defaults
						if(  $i == 1 && $s["image".$i] == ""){
						
							$s["image".$i] 	 			= $CORE->LAYOUT("get_placeholder", array('slider', $blockid) );
							
							$s["image".$i."_title"] 	= $CORE->LAYOUT("get_placeholder_text", array('title', $blockid ) );
							$s["image".$i."_desc"] 		= $CORE->LAYOUT("get_placeholder_text", array('desc', $blockid) );
							
							$s["image".$i."_txtcolor"] 		= "light";
							
							$s["image".$i."_btn_link"] 		= $this->_ppt_home_url()."/?s=";							
							
							if($i == 1){
								$s["image".$i."_txtdir"] 		= "left";
							}elseif($i == 2){
								$s["image".$i."_txtdir"] 		= "center";
							}else{
								$s["image".$i."_txtdir"] 		= "right";
							}
						
						}
						 
						 
						$i++; 
					}
				}			
				 		
				
				// GLOBAL FAQ BLOCKS
				if($cat == "faq"){
				
					$s["image_faq"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'image_faq' ) );
				 				
					$i=1; 
					while($i < 7){
						$s["faq".$i."_title"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'faq'.$i.'_title') );
						$s["faq".$i."_desc"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'faq'.$i.'_desc') );
						$i++; 
					}
				}
				
				// GLOBAL FAQ BLOCKS
				if($cat == "testimonials"){	
								
					$i=1; 
					while($i < 9){
					
						$s["author_quote".$i] 	= $CORE->LAYOUT("load_single_value", array($blockid, "author_quote".$i) );
						$s["author_name".$i] 	= $CORE->LAYOUT("load_single_value", array($blockid, "author_name".$i) );						
						$s["author_image".$i] 	= $CORE->LAYOUT("load_single_value", array($blockid, "author_image".$i) );
						$s["author_job".$i] 	= $CORE->LAYOUT("load_single_value", array($blockid, "author_job".$i) );
						
							if($s["author_quote".$i] == ""){
								$s["author_quote".$i] 		= $CORE->LAYOUT("get_placeholder_text", array('quote') );
							}
							if($s["author_name".$i] == ""){
								$s["author_name".$i] 		= $CORE->LAYOUT("get_placeholder_text", array('quote_name') );
							}
							if($s["author_job".$i] == ""){
								$s["author_job".$i] 		= $CORE->LAYOUT("get_placeholder_text", array('quote_job') );
							}
							if($s["author_image".$i] == ""){
								$s["author_image".$i] 		= $CORE->LAYOUT("get_placeholder", array('user', $i, $blockid ) );
							}
						
						$i++; 
					}
				}
					 
				// GLOBAL PRICING BLOCKS
				if($cat == "pricing"){	
				 			
				 	$s["pricing_type"] = $CORE->LAYOUT("load_single_value", array($blockid, 'pricing_type'));	
					
					if($s["pricing_type"] == ""){
						$s["pricing_type"]  = "memberships";
					}				
					
				 				
				}
				
				// GLOBAL FAQ BLOCKS
				if($cat == "listings"){	
				 			
				 	$s["perrow"] = $CORE->LAYOUT("load_single_value", array($blockid, 'perrow'));						
					$s["limit"] = $CORE->LAYOUT("load_single_value", array($blockid, 'limit'));					
					$s["card"] = $CORE->LAYOUT("load_single_value", array($blockid, 'card'));	
					$s["order"] = $CORE->LAYOUT("load_single_value", array($blockid, 'order'));
					$s["orderby"] = $CORE->LAYOUT("load_single_value", array($blockid, 'orderby'));
					$s["custom"] = $CORE->LAYOUT("load_single_value", array($blockid, 'custom'));
					$s["datastring"] = $CORE->LAYOUT("load_single_value", array($blockid, 'datastring'));
					  
					if($s["datastring"] == "" || $s["custom"] != ""){					
						$s['datastring'] = '
						dataonly="1" 
						cat="" 
						card="'.$s['card'].'"
						perrow="'.$s['perrow'].'" 
						show="'.$s['limit'].'" 
						custom="'.$s['custom'].'" 
						customvalue=""
						order="'.$s['order'].'" 
						orderby="'.$s['orderby'].'" 
						debug="0"	
						';
					}
					 			
				 				
				}
				
				// GLOBAL BLOG
				if($cat == "blog"){
				 
					 			
				}
				
				
				// GLOBAL GATEGORY BLOCKS
				if($cat == "category"){
				
					 $s["cat_order"]  		= $CORE->LAYOUT("load_single_value", array($blockid, 'cat_order' ) );
					 $s["cat_orderby"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'cat_orderby' ) );
					 $s["cat_show"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'cat_show' ) );
					 $s["cat_offset"] 		= $CORE->LAYOUT("load_single_value", array($blockid, 'cat_offset' ) );	
					 $s["cat_show_list"] 	= $CORE->LAYOUT("load_single_value", array($blockid, 'cat_show_list' ) );
					 
				}
				
				// GLOBAL SUBSCRIBE
				if($cat == "subscribe"){
				 
					$s["image_subscribe"] 			= $CORE->LAYOUT("load_single_value", array($blockid, 'image_subscribe' ) );
						
						/* defaults */
						if($s["image_subscribe"]  == ""){							
								$s["image_subscribe"] = $CORE->LAYOUT("get_placeholder", array(800,600 ) );
						}
				}  			
				
			 
				return $s;
			
			}
			
			return array();
		
		
		} break;		
		case "load_blocks": {  global $CORE, $CORE_ADMIN;
		
		  
				$i=1;
				foreach($order_data as $key => $file){
				  
				
					if(!isset($file['name'])){ continue; } 
					
					
					
					// TITLE
					if(!in_array($file['cat'], array('header','footer')) && !isset($file['hide-title']) ){
					
					$file['data']["seperator_title"] = array( "type" => "seperator-heading", "t" => "Title" );
						 
						
					$file['data']["title"]			= array( "t" => "Title", "type" 		=> "text", "d" => $CORE->LAYOUT("get_placeholder_text", array('title', $file['cat']))   ); 
						
						
						$file['data']["title_show"] = array( 
								"t" => "Show Title",
								"type" => "yesno", 
								"values" => array(
									"yes" 	=> "Yes",
									"no" 	=> "No",
									 						
								), 
								"d" => "yes",
						);
						
						
							$file['data']["title_pos"] = array( 
								"t" => "Position",
								"type" => "select", 
								"values" => array(
									"left" 		=> "Left",
									"right" 	=> "Right",
									"center" 	=> "Center",
								), 
								"d" => "left",
						);
						
						$file['data']["title_heading"] = array( 
								"t" => "Heading",
								"type" => "select", 
								"values" => array(
									"h1" 	=> "H1",
									"h2" 	=> "H2",
									"h3" 	=> "H3", 
									"h4" 	=> "H4", 
								), 
								"d" => "left",
						);
						
						
						$file['data']["title_style"] = array( 
								"t" => "Title Style",
								"type" => "select", 
								"values" => array( 
									"1" 			=> "Style 1",
									"2" 			=> "Style 2",
									"3" 			=> "Style 3",
									"4" 			=> "Style 4",		
									"5" 			=> "Style 5",
									"6" 			=> "Style 6",
									//"7" 			=> "Style 7",						 
															
								), 
								"d" => "1",
						);
						
						
						
						$file['data']["title_font"] 		= array( "t" => "Font","type" => "select", "values" =>  $CORE->LAYOUT("get_fonts", array() ) );
						
						$file['data']["title_margin"] = array( 
								"t" => "Margin Bottom",
								"type" => "select", 
								"values" => array(
									'mb-0' => "0px",
									'mb-1' => "10px",
									'mb-2' => "20px",
									'mb-3' => "30px" ,
									'mb-4' => "40px",
									'mb-5' => "50px", 
								), 
								"d" => "mb0",
						);
						
						$file['data']["title_txtcolor"] = array( 
								"t" => "Text Color",
								"type" => "select", 
								"values" => array(
									
									'black' 	=> "Black", 
									
									'white' 	=> "White", 
									
									'light' 	=> "Light",
									'dark' 		=> "Dark",
									 
									"primary" 	=> "Primary Color", 
									"secondary" => "Secondary Color"
								), 
								"d" => "dark",
						);
						
						$file['data']["title_txtw"] = array( 
								"t" => "Bold",
								"type" => "select", 
								"values" => array(
									'font-weight-normal' 	=> "Normal", 
									'font-weight-bold' 		=> "Bold", 
									
									'text-300' 	=> "300",
									'text-500' 	=> "500",
									'text-700' 	=> "700",
									'text-800' 	=> "800",
									'text-900' 	=> "900",
								), 
								"d" => "font-weight-bold",
						);
						
						
						$file['data']["seperator_subtitle"] = array( "type" => "seperator", "t" => "Subtitle" );
						
						
						
						$file['data']["subtitle"] 		= array( "t" => "Subtitle", "type" 		=> "text",  "d" => $CORE->LAYOUT("get_placeholder_text", array('subtitle', $file['cat']))  ); 
						
						
						$file['data']["subtitle_margin"] = array( 
								"t" => "Margin Bottom",
								"type" => "select", 
								"values" => array(
									'mb-0' => "0px",
									'mb-1' => "10px",
									'mb-2' => "20px",
									'mb-3' => "30px" ,
									'mb-4' => "40px",
									'mb-5' => "50px", 
								), 
								"d" => "mb0",
						);
						
						$file['data']["subtitle_txtcolor"] = array( 
								"t" => "Text Color",
								"type" => "select", 
								"values" => array(
								
									
									'black' 	=> "Black", 
									'white' 	=> "White", 
									
									'light' 	=> "Light",
									'dark' 		=> "Dark",
									 
									"primary" 	=> "Primary Color", 
									"secondary" => "Secondary Color",
									
									'orange' 		=> "Orange",
									
									" opacity-5" => "50% Black",
									" opacity-8" => "80% Black", 
									
									" opacity-5 text-light" => "50% White",
									" opacity-8 text-light" => "80% White",
									
								), 
								"d" => "dark",
						);
						
						$file['data']["subtitle_font"] 		= array( "t" => "Font","type" => "select", "values" =>  $CORE->LAYOUT("get_fonts", array()) );
						
						$file['data']["subtitle_txtw"] = array( 
								"t" => "Bold",
								"type" => "select", 
								"values" => array(
									'font-weight-normal' 	=> "Normal", 
									'font-weight-bold' 		=> "Bold", 
									
									'text-300' 	=> "300",
									'text-500' 	=> "500",
									'text-700' 	=> "700",
									'text-800' 	=> "800",
									'text-900' 	=> "900",
								), 
								"d" => "font-weight-bold",
						);
						
						
						$file['data']["seperator_desc"] = array( "type" => "seperator", "t" => "Description" );
						
						
						
						$file['data']["desc"] 			= array( "t" => "Description","type" 	=> "textarea", "d" => $CORE->LAYOUT("get_placeholder_text", array('desc', $file['cat']))   ); 
						
						$file['data']["desc_margin"] = array( 
								"t" => "Margin Bottom",
								"type" => "select", 
								"values" => array(
									'mb-0' => "0px",
									'mb-1' => "10px",
									'mb-2' => "20px",
									'mb-3' => "30px" ,
									'mb-4' => "40px",
									'mb-5' => "50px", 
								), 
								"d" => "mb0",
						);
						
						$file['data']["desc_txtcolor"] = array( 
								"t" => "Text Color",
								"type" => "select", 
								"values" => array(
									
									'black' 	=> "Black", 
									'white' 	=> "White", 
									
									'light' 	=> "Light",
									'dark' 		=> "Dark",
									 
									"primary" 	=> "Primary Color", 
									"secondary" => "Secondary Color",
									
									"opacity-5" => "50% Black",
									"opacity-8" => "80% Black",
									
									"opacity-5 text-light" => "50% White",
									"opacity-8 text-light" => "80% White",
									
									
								), 
								"d" => "opacity-5",
						);
						
						$file['data']["desc_font"] 		= array( "t" => "Font","type" => "select", "values" =>  $CORE->LAYOUT("get_fonts", array()) );
						
						
						$file['data']["desc_txtw"] = array( 
								"t" => "Bold",
								"type" => "select", 
								"values" => array(
									'font-weight-normal' 	=> "Normal", 
									'font-weight-bold' 		=> "Bold", 
									
									'text-300' 	=> "300",
									'text-500' 	=> "500",
									'text-700' 	=> "700",
									'text-800' 	=> "800",
									'text-900' 	=> "900",
								), 
								"d" => "font-weight-normal",
						);						
						
						
						$file['data']["seperator_text1"] 	= array( "type" => "seperator-end" );
						
					}
					/***********************************************************/
					
					
					// GLOBAL BUTTON STYLES
					if(in_array($file['cat'], array('text','cta','header','faq','hero','icon','video') ) && !isset($file['hide-button1']) ){
					
						$file['data']["seperator_btn1"] = array( "type" => "seperator-heading", "t" => "Button 1" );
						
						$file['data']["btn_show"] 		= array( "t" => "Show Button","type" => "yesno", "values" => array( "yes" => "Enable", "no" => "disable" ), "d" => "yes" ); 		
						$file['data']["btn_txt"] 		= array( "t" => "Button Caption", "type" 		=> "text"  ); 
						$file['data']["btn_link"] 		= array( "t" => "Button Link", "type" 		=> "text"  ); 
						$file['data']["btn_bg"] 		= array( "t" => "Button Color","type" => "select", "values" => 
							array( 
							"primary" 	=> "Primary Button",
							"secondary" => "Secondary Button",
							"light" 	=> "Light Button",
							"dark" 		=> "Dark Button",
							
							"orange" => "Orange Button",
							
							)  
						); 
						$file['data']["btn_bg_txt"] 	= array( "t" => "Text Color","type" => "select", "values" => array( "light" => "Light","dark" => "Dark")  ); 
						
						
						$file['data']["btn_style"] 		= array( "t" => "Button Style","type" => "select", "values" => 
							array( 
							"1" 	=> "Normal",
							"2" 	=> "Outlined",	
							"3" 	=> "Normal Rounded",	
							"4" 	=> "Outlined Rounded",		
							"5" 	=> "Square Edges",
							"6" 	=> "Text Link",
										 
							)  
						);
						
						$file['data']["btn_font"] 		= array( "t" => "Font","type" => "select", "values" =>  $CORE->LAYOUT("get_fonts", array()) );
						
						$file['data']["btn_size"] 		= array( "t" => "Button Size","type" => "select", "values" => 
							array( 
						 
							"btn-sm" 	=> "Small",
							"btn-md" 	=> "Medium",
							"btn-lg" 	=> "Large",
							"btn-xl" 	=> "Extra Large",
													 
							)  
						);
						
						
						$file['data']["btn_icon"] 		= array( "t" => "Button Icon", "type" 		=> "text" ); 
						
						$file['data']["btn_icon_pos"] 		= array( "t" => "Icon Position","type" => "select", "values" => 
							array( 							
							"before" 	=> "Before Text",
							"after" 	=> "After Text",													 
							)  
						);
						
						$file['data']["btn_margin"] 		= array( "t" => "Margin","type" => "select", "values" => 
							array( 							
							'mt-0' => "0px",
							'mt-1' => "10px",
							'mt-2' => "20px",
							'mt-3' => "30px" ,
							'mt-4' => "40px",
							'mt-5' => "50px",													 
							)  
						); 
						
						$file['data']["btn_txtw"] = array( 
								"t" => "Bold",
								"type" => "select", 
								"values" => array(
									'font-weight-normal' 	=> "Normal", 
									'font-weight-bold' 		=> "Bold", 
									
									'text-300' 	=> "300",
									'text-500' 	=> "500",
									'text-700' 	=> "700",
									'text-800' 	=> "800",
									'text-900' 	=> "900",
								), 
								"d" => "font-weight-bold",
						);
						
						
						$file['data']["seperator_button21"] 	= array( "type" => "seperator-end" );
						
					
					} 
					/***********************************************************/
					
					
					
					// GLOBAL BUTTON STYLES
					if(in_array($file['cat'], array('text','faq','hero','icon','video') ) && !isset($file['hide-button2']) ){
					
						$file['data']["seperator_btn2"] = array( "type" => "seperator-heading", "t" => "Button 2 " );
						
						$file['data']["btn2_show"] 		= array( "t" => "Show Button","type" => "yesno", "values" => array( "yes" => "Enable", "no" => "disable" ), "d" => "yes"  ); 		
						$file['data']["btn2_txt"] 		= array( "t" => "Button Caption", "type" 		=> "text"  ); 
						$file['data']["btn2_link"] 		= array( "t" => "Button Link", "type" 		=> "text"  ); 
						$file['data']["btn2_bg"] 		= array( "t" => "Button Color","type" => "select", "values" => 
							array( 
							"primary" 	=> "Primary Button",
							"secondary" => "Secondary Button",
							"light" 	=> "Light Button",
							"dark" 		=> "Dark Button",
							)  
						); 
						$file['data']["btn2_bg_txt"] 	= array( "t" => "Text Color","type" => "select", "values" => array( "light" => "Light","dark" => "Dark")  ); 
						
						
						$file['data']["btn2_font"] 		= array( "t" => "Font","type" => "select", "values" =>  $CORE->LAYOUT("get_fonts", array() ) );
						
						$file['data']["btn2_style"] 		= array( "t" => "Button Style","type" => "select", "values" => 
							array( 
							"1" 	=> "Normal",
							"2" 	=> "Outlined",	
							"3" 	=> "Normal Rounded",	
							"4" 	=> "Outlined Rounded",
							"5" 	=> "Square Edges",
							"6" 	=> "Text Link 1",
							"7" 	=> "Text Link 2",					 
							)  
						);
						
						$file['data']["btn2_size"] 		= array( "t" => "Button Size","type" => "select", "values" => 
							array( 
						 
							"btn-sm" 	=> "Small",
							"btn-md" 	=> "Medium",
							"btn-lg" 	=> "Large",
							"btn-xl" 	=> "Extra Large",
													 
							),
							
							"d" => "btn-xl",
							
						);
						
						
						$file['data']["btn2_icon"] 		= array( "t" => "Button Icon", "type" 		=> "text", "d" => "fa fa-long-arrow-alt-right"  ); 
						
						$file['data']["btn2_icon_pos"] 		= array( "t" => "Icon Position","type" => "select", "values" => 
							array( 							
							"before" 	=> "Before Text",
							"after" 	=> "After Text",													 
							)  
						);
						
						$file['data']["btn2_margin"] 		= array( "t" => "Margin","type" => "select", "values" => 
							array( 							
							'mt-0' => "0px",
							'mt-1' => "10px",
							'mt-2' => "20px",
							'mt-3' => "30px" ,
							'mt-4' => "40px",
							'mt-5' => "50px",													 
							)  
						); 
						
						$file['data']["btn2_txtw"] = array( 
								"t" => "Bold",
								"type" => "select", 
								"values" => array(
									'font-weight-normal' 	=> "Normal", 
									'font-weight-bold' 		=> "Bold", 
									
									'text-300' 	=> "300",
									'text-500' 	=> "500",
									'text-700' 	=> "700",
									'text-800' 	=> "800",
									'text-900' 	=> "900",
								), 
								"d" => "font-weight-bold",
						);
						
						
						$file['data']["seperator_button22"] 	= array( "type" => "seperator-end" );
						
					
					} 
					/***********************************************************/
					
				 
				 
					
					// CTA
					if(in_array($file['cat'], array('cta'))){	
					
						 
						$file['data']["seperator_cta1"] 	= array( "type" => "seperator-heading", "t" => "Call to action" );				
					
						$file['data']["image_cta"] 		= array( "t" => "Image", "type" => "upload", "desc" => "This is used on some layout designs and might not apply to all."  );
						 
						$file['data']["seperator_cta2"] 	= array( "type" => "seperator-end" ); 
							
					}
					/***********************************************************/ 
					
					
					// ICONS
					if(in_array($file['cat'], array('icon'))){
						
						
						 	
						$i=1; 
						while($i < 10){
						
						$file['data']["seperator_icons".$i] 	= array( "type" => "seperator-heading", "t" => "Icon ".$i."" );				
							
						
					
							
							$file['data']["icon".$i.""] 	= array( "t" => "Icon Code <br> <small><a href='http://fontawesome.com/icons?d=gallery&q=' target='_blank'>Full list here</a></small>", "type" => "text", "placeholder" => "fa fa-cog",  ); 
							
							$file['data']["icon".$i."_title"] 	= array( "t" => "Title", "type" 		=> "text"  ); 
							$file['data']["icon".$i."_desc"] 	= array( "t" => "Description","type" 	=> "text"  );
							$file['data']["icon".$i."_link"] 	= array( "t" => "Link","type" 	=> "text"  );
							
$file['data']["icon".$i."_txtcolor"] 	= array( "t" => "Text Color", "type" => "select", "values" => 
							array( 
							"primary" 	=> "Primary Button",
							"secondary" => "Secondary Button",
							"light" 	=> "Light Button",
							"dark" 		=> "Dark Button",
							), 
						);
$file['data']["icon".$i."_iconcolor"] 	= array( "t" => "Icon Color", "type" => "select", "values" => 
							array( 
							"primary" 	=> "Primary Button",
							"secondary" => "Secondary Button",
							"light" 	=> "Light Button",
							"dark" 		=> "Dark Button",
							),
						 );
							
							$file['data']["seperator_icon".$i] 	= array( "type" => "seperator-end" ); 
					
							
							$i++; 
						}						
				 
						
						
						
					}
					/***********************************************************/
					
					
					
					// FAQ
					if(in_array($file['cat'], array('faq'))){
						
						$file['data']["seperator_faq1"] = array( "type" => "seperator-heading", "t" => "FAQ Data" );
						
						$file['data']["image_faq"] 		= array( "t" => "Image", "type" => "upload", "desc" => "This is used on some layout designs and might not apply to all."  ); 
									
						$i=1; 
						while($i < 7){
							$file['data']["faq".$i."_title"] 	= array( "t" => "FAQ ".$i." Title", "type" 		=> "text"  ); 
							$file['data']["faq".$i."_desc"] 	= array( "t" => "FAQ ".$i." Description","type" 	=> "textarea"  );
							$i++; 
						}
						
						$file['data']["seperator_faq2"] 	= array( "type" => "seperator-end" ); 
					
					}
					/***********************************************************/
					
					
					
					// SLIDER DETAILS					 
					if(in_array($file['cat'], array('slider'))){	
						
						$file['data']["seperator_slider"] 	= array( "type" => "seperator-heading", "t" => "Slider" ); 
										
						$i=1; 
						while($i < 4){
						
							$file['data']["seperator_im".$i] 	= array( "type" => "seperator", "t" => "Image ".$i ); 
							
							// IMAGE						 
							$file['data']["image".$i.""] 			= array( "t" => "Image ".$i."", "type" => "upload"  ); 						
							$file['data']["image".$i."_txtcolor"] 	= array( "t" => "Text Color","type" => "select", "values" => array( "light" => "light","dark" => "dark")  ); 	
							$file['data']["image".$i."_txtdir"] 	= array( "t" => "Text Direction","type" => "select", "values" => array("left" => "left","right" => "right" ,"center" => "center")  );
												 
							$file['data']["image".$i."_title"] 		= array( "t" => "Title", "type" 		=> "text"  ); 
							$file['data']["image".$i."_desc"] 		= array( "t" => "Description","type" 	=> "textarea"  ); 
							
							$file['data']["image".$i."_btn_text"] 	= array( "t" => "Button Text ","type" 	=> "text"  ); 
							$file['data']["image".$i."_btn_link"]	= array( "t" => "Button Link","type" 	=> "text"  );
							
							$file['data']["image".$i."_seperator"] = array( "type" => "seperator" );
							
							 
							$i++; 
						}
						
						$file['data']["seperator_slider"] 	= array( "type" => "seperator-end" ); 
					}		
					
					// REMOVE SECTION STYLES
					if(in_array($file['cat'], array('hero'))){
					
						$file['data']["seperator_hero"] = array( "type" => "seperator-heading", "t" => "Hero Image" );
						
						
						$file['data']["hero_size"]			= array( "t" => "Hero Size","type" => "select", "values" => 
							array( 
							"hero-small" 	=> "Slim (400px)",
							"hero-medium" 	=> "Medium (500px)",
							"min-h-720" 	=> "Large (720px)",
							"hero-large" 	=> "Extra Large (800px)",
							"hero-full" 	=> "Full Page",
							),
						); 
					  
						$file['data']["hero_image"] 		= array( "t" => "Image", "type" 		=> "upload"  ); 
						
						$file['data']["hero_txtcolor"] = array( 
								"t" => "Menu Color",
								"type" => "select", 
								"values" => array(
									"dark" 	=> "Dark",
									"light" 	=> "Light",
								), 
								"d" => "light",
						); 
						
						
							$file['data']["hero_overlay"] = array( 
								"t" => "Overlay Style",
								"type" => "select", 
								"values" => array(
									"none" 	=> "None",
									"gradient" 	=> "Gradient",
									"gradient-left" 	=> "Gradient Left",
									"black" 	=> "Black",
									"white" 	=> "White",
									"grey" 		=> "Grey",	
									"green" => "Green",									
									"primary" 	=> "Primary Color",
									"secondary" => "Secondary Color",								
									
								), 
								"d" => "",
						); 
						
						$file['data']["seperator_hero2"] 	= array( "type" => "seperator-end" ); 
						
						
					
					} 
					
					
					/***********************************************************/
					
					
						
					// USERS BLOCK					 
					if(in_array($file['cat'], array('users'))){
					
						$file['data']["user_type"] = array( 
								"t" => "User Type",
								"type" => "select", 
								"values" => array(
									"all" 	=> "All Users",
									"user_fr" 	=> "Freelancers",
									"user_em" 	=> "Employees",
								 	
								), 
								"d" => "all",
						); 
					}
					
					
					
						
					/***********************************************************/
					
					
						
					// IMAGE BLOCK					 
					if(in_array($file['cat'], array('image_block'))){	
					
					$file['data']["seperator_imageblock"] = array( "type" => "seperator-heading", "t" => "Images" );
						
									
						$i=1; 
						while($i < 7){
						
							$file['data']["seperator_imx".$i] 	= array( "type" => "seperator", "t" => "Image ".$i ); 
							
							// IMAGE						 
							$file['data']["image_block".$i.""] 			= array( "t" => "Image", "type" => "upload"  );
							 						
						 					 
							$file['data']["image_block".$i."_title"] 		= array( "t" => "Title", "type" 		=> "text"  ); 
							$file['data']["image_block".$i."_subtitle"] 		= array( "t" => "Subtitle","type" 	=> "text"  ); 
							
							$file['data']["image_block".$i."_link"] 		= array( "t" => "Link","type" 	=> "text"  ); 
							
							
							$file['data']["image".$i."_effect"] 	= array( "t" => "Text Direction","type" => "select", "values" => array(
							"1" => "1", "2" => "2" ,"3" => "3","4" => "4","5" => "5","6" => "6")  );
							
							
							$file['data']["image".$i."_txtcolor"] 	= array( "t" => "Text Color","type" => "select", "values" => array('dark' => "Dark",'light' => "White")  );
							
							$file['data']["image".$i."_txtpos"] 	= array( "t" => "Text Color","type" => "select", "values" => array(
							
							'tleft' => "Top Left",
							"tright" => "Top Right",
							"tcenter" => "Top Centered",					
							'ccenter' => "Centered", 					
							'bleft' => "Bottom Left",
							"bright" => "Bottom Right",
							"bcenter" => "Bottom Centered",
							)  );
							
							
							 
							$i++; 
						}
						
						
						$file['data']["seperator_imageblock2"] 	= array( "type" => "seperator-end" );
						
					}	
					/***********************************************************/
					
					
					// LISTINGS DETAILS					 
					if(in_array($file['cat'], array('listings'))){
					 
					
					$file['data']["seperator_listings"] = array( "type" => "seperator-heading", "t" => "Listing Data" );
					
					$file['data']["custom"] =  array( "t" => "Data","type" => "select", "values" => _ppt_custom_searchlist() , "d"=>"random" );				  
					
					
					$file['data']["perrow"] = array( "t" => "Per Row", "type" 		=> "text", "d" => 4  );					 	
					$file['data']["limit"] = array( "t" => "Limit", "type" 		=> "text", "d" => 12  ); 						
					$file['data']["card"] = array( "t" => "Display","type" => "select", "values" => array(
							
						'small' 		=> 'Small',
						'blank' 		=> 'Blank',
						'info' 			=> 'Info',
						'list' 			=> 'List',
						'list-small' 	=> 'List Small',
					
					),
					"d"=>"info",
					  );					 		
					
					
					$file['data']["orderby"] =  array( "t" => "Order By","type" => "select", "values" => array(
							
					'ID' => 'Post ID',
					'author' => 'Post Author',
					'title' => 'Title',
					'date' => 'Date',
					'modified' => 'Last Modified Date',				
					'rand' => 'Random',				
					'menu_order' => 'Menu Order',
					
					),
					"d"=>"ID",
					  );
					  
					  $file['data']["order"] =  array( "t" => "Order","type" => "select", "values" => array(
							
						'asc' => 'Ascending',
                   	 	'desc' => 'Descending'
					
						),
					"d"=>"asc",
					 );
					 
							
					$file['data']["seperator_listings2"] 	= array( "type" => "seperator-end" );			
					
					
					
					}	
					/***********************************************************/
					
					// HEADER
				if($file['cat'] == "header"){
				
					$file['data']["seperator_sub"] = array( "type" => "seperator-heading", "t" => "Header" );
				 	 
					$file['data']["topmenu_show"] 	= array( "t" => "Show Top Menu","type" => "yesno", "values" => array( "yes" => "Enable", "no" => "disable" ), "d" => "yes"  ); 		
					$file['data']["extra_show"] 	= array( "t" => "Show Extra","type" => "yesno", "values" => array( "yes" => "Enable", "no" => "disable" ), "d" => "yes"  ); 				  	 	
					$file['data']["extra_type"] 	= array( "t" => "Show Extra","type" => "select", "values" => array( "" => "Phone", "icons" => "Icons" ), "d" => ""  ); 
					
					
				  	/* defaults */
					if($file['data']["topmenu_show"]  == ""){ $file['data']["topmenu_show"]  = "yes"; }	
					if($file['data']["extra_show"]  == ""){ $file['data']["extra_show"]  = "yes"; }		
					
					$file['data']["seperator_sub2"] 	= array( "type" => "seperator-end" );				 
					
				}
				
				
				
					/***********************************************************/
					
					// FOOTER
				if($file['cat'] == "footer"){
				
					$file['data']["seperator_sub"] = array( "type" => "seperator-heading", "t" => "Footer Menu" );
					
					 
					 
					$file['data']["footer_copyright_style"] 	= array( "t" => "Copyright Style","type" => "select", "values" =>  array(
					""		=> "Default",
					"1" 	=> "Text Left",
					"2" 	=> "Text Center",	
					"3" 	=> "Text Right",	
					"4" 	=> "Text + Cards",
					"5" 	=> "Text + Social",
					"6" 	=> "Text + Links",
				), "d" => ""  ); 
					
					
				 	$file['data']["footer_copyright"] = array( 					 
					 "t" 		=> "Copyright Text", 
					 "type" 	=> "text", 
					 "d" 		=> "&copy; ".date("Y")." ".stripslashes(_ppt(array('company','name')))." ". __("All rights reserved.","premiumpress") 
					);					  
					 
				    $file['data']["footer_description"] = array( "t" => "Footer Description", "type" 		=> "textarea", "d" => _ppt(array('company','mission'))  );	
					
				 	
					$file['data']["footer_menu1_title"] = array( "t" => "Links Title 1", "type" 		=> "text", "d" => "Useful Links"  );	
					  
					 
					$file['data']["footer_menu1"] 	= array( "t" => "Links Menu 1","type" => "select", "values" => _ppt_elementor_menus(), "d" => ""  ); 
					
					
					$file['data']["footer_menu2_title"] = array( "t" => "Links Title 2", "type" 		=> "text", "d" => "Members"  );	
					
					
					$file['data']["footer_menu2"] 	= array( "t" => "Links Menu 2","type" => "select", "values" => _ppt_elementor_menus(), "d" => ""  ); 
					
					 
					
					$file['data']["seperator_sub2"] 	= array( "type" => "seperator-end" );				 
					
				}
				
				
				
				
				
					/***********************************************************/
					
					// SUBSCRIBER DETAILS					 
					if(in_array($file['cat'], array('subscribe'))){
					
						$file['data']["seperator_sub"] = array( "type" => "seperator-heading", "t" => "Subscribe" );
					
						$file['data']["image_subscribe"] 		= array( "t" => "Image", "type" 		=> "upload"  ); 
						
						$file['data']["seperator_sub2"] 	= array( "type" => "seperator-end" );					
					
					}
					/***********************************************************/
					
					// GLOBAL TESTIMONIALS BLOCKS				 
					if(in_array($file['cat'], array('testimonials'))){
					
						$file['data']["seperator_test"] = array( "type" => "seperator-heading", "t" => "Testimonials" );
									
						$i=1; 
						while($i < 9){
						
							$file['data']["author_quote".$i] 	= array( "t" => "Quote", "type" 	=> "textarea"  ); 
							$file['data']["author_name".$i] 	= array( "t" => "Name", "type" 		=> "text"  ); 					
							$file['data']["author_image".$i]  	= array( "t" => "Image", "type" 	=> "upload"  );
							$file['data']["author_job".$i] 		= array( "t" => "Job Title", "type" => "text"  ); 
							
							
							$i++; 
						}
						
						$file['data']["seperator_test2"] 	= array( "type" => "seperator-end" );
					}	
					
					
					
					
					
					
					
					
					
					
					
					/***********************************************************/
					
					
					// GLOBAL TEXT IMAGES
					if(in_array($file['cat'], array('text','video'))){
					
							$file['data']["seperator_images"] = array( "type" => "seperator-heading", "t" => "Images" );
						
						 
							$i=1; 
							while($i < 3){
							
								$file['data']["seperator_im".$i] 	= array( "type" => "seperator", "t" => "Image ".$i ); 
					
								$file['data']["text_image".$i] 			= array( "t" => "Image", "type" 	=> "upload"  );
								$file['data']["text_image".$i."_title"] 	= array( "t" => "Title", "type" 		=> "text"  ); 
								$file['data']["text_image".$i."_link"] 	= array( "t" => "Link", "type" 		=> "text"  ); 							 
							 
							$i++; 
							}	
							
							$file['data']["seperator_images2"] 	= array( "type" => "seperator-end" );					 
					}		
					  
					  /***********************************************************/ 
					
if(!in_array($file['cat'], array('header','hero'))){
					
					$file['data']["seperator_section"] = array( "type" => "seperator-heading", "t" => "Section" );
					
					// ADDON EXTRA BLOCKS FOR GLOBAL VALUES
					$file['data']["section_bg"]  = array( 					
					"t" => "Background", 
					"type" => "select", 
					"values" => array(
					
					'bg-white' 		=> "White",					
					'bg-light' 		=> "Light" ,
					'bg-dark' 		=> "Dark",					
					'bg-primary' 	=> "Primary Color",
					'bg-secondary' 	=> "Secondary Color",	
						
						
						) 
					);
					
					/*
					$file['data']["section_divider"]  = array( 
						"t" => "Divider Style", 
						"type" => "select", 
						"values" => array(
							"divider-after" 	=> "divider-after",
							"divider-before" 	=> "divider-before", 
							"divider-both" 		=> "divider-both", 
							"" 					=> "No Divider"
						),
					);
					*/
					
					$file['data']["section_padding"]  = array( 
						"t" => "Padding", 
						"type" => "select", 
						"values" => array(
						
							"section-0" 		=> "No Padding",
							
							"section-120" 		=> "120px Padding",
							"section-100" 		=> "100px Padding", 
							"section-80" 		=> "80px Padding", 
							"section-60" 		=> "60px Padding", 						
							"section-40" 		=> "40px Padding",
							"section-20" 		=> "20px Padding",
							
							"a" => "------------",
							
							"section-top-40" 		=> "40px Padding Top",
							"section-top-60" 		=> "60px Padding Top",
							"section-top-80" 		=> "80px Padding Top",
							"section-top-100" 		=> "100px Padding Top",
							"section-top-120" 		=> "120px Padding Top",
							
							"b" => "------------",
							
							"section-bottom-40" 		=> "40px Padding Bottom",
							"section-bottom-60" 		=> "60px Padding Bottom",
							"section-bottom-80" 		=> "80px Padding Bottom",
							"section-bottom-100" 		=> "100px Padding Bottom",
							"section-bottom-120" 		=> "120px Padding Bottom",
						),
					);
					
					
					
					$file['data']["section_w"]  = array( 
						"t" => "Container Width", 
						"type" => "select", 
						"values" => array(
						
							'container-fluid' 	=> "Full Width (100%)",					
							'container' 		=> "Container (1300px)" ,
							'container-slim' 	=> "Slim (1000px)",
							  
						),
					);
					
					
					
					
					
					
					$file['data']["seperator1"] = array( "type" => "seperator-end" );
			 
					
					}
					/***********************************************************/ 
					  
					
					
					$image = $CORE->LAYOUT("get_block_prewview", $key );
				  
				 
				  if(isset($GLOBALS['flag-edit-block'])){ //$file['name']; 
				?> 
                  
				<div class="styletype styletype-<?php echo $file['cat']; ?>">
     
                <?php
                    if(isset($_GET['pagekey'])){ $pagekey = $_GET['pagekey']; }else{ $pagekey = "home"; }	
					 
					
                    echo $CORE->CustomDesignEdit($key, $file, $pagekey);  ?> 
                    
                </div>
                <?php
				}


			$i++; }  

 
 
		} break;	
		 
		
		case "default_innerpages": {
		 
		return array_replace_recursive($order_data, ppt_demo_page_data());
		
		} break; 
		
	}
}
 
function default_blocks(){ global $wpdb, $CORE_ADMIN;  


	// GET EACH CATEGORY 
	$types = $this->LAYOUT("get_block_types",array());

	if(is_array($types)){
		foreach($types as $t){
		
			// LOAD DEFAULTS
			$HandlePath = get_template_directory()."/framework/design/".$t['id'];	
			$loadheroArray = array();
			if(is_dir($HandlePath)){
				if($handle1 = opendir($HandlePath)) { 		
					while(false !== ($file = readdir($handle1))){	
						if(strlen($file) > 5 && substr($file, -3) == "php" ){										 
							include($HandlePath."/".$file); 														
						}
					}	
				}
			}
		}
	}

			
}

function default_designs(){ global $wpdb, $CORE_ADMIN; 
	
 
	// LOAD DEFAULTS
	/*
	if(defined('WLT_DEMOMODE')){
	 
		$HandlePath = get_template_directory()."/framework/design/example_langs/";			 
		$loadheroArray = array();
		if(is_dir($HandlePath)){
		if($handle1 = opendir($HandlePath)) {      
				while(false !== ($file = readdir($handle1))){	
					if(strlen($file) > 5 && substr($file, -3) == "php" ){
					
						include($HandlePath."/".$file);					
								
					}
				}	
			}
		} 
	}
	*/
	
	
	// LOAD CHILD THEMES
	if(defined('WLT_DEMOMODE')){
	 
		$HandlePath = WP_CONTENT_DIR."/themes/";
		
		$scanned_directory = array_diff(scandir($HandlePath), array('..', '.'));
		
		foreach($scanned_directory as $dir){
			
			if(substr($dir,0,10) == "childtheme"){
			 
			 	if(file_exists(WP_CONTENT_DIR."/themes/".$dir."/functions.php")){
			 		include(WP_CONTENT_DIR."/themes/".$dir."/functions.php");
				}
				
			}		
		}
		
	}
		 
	
	
	// LOAD DEFAULTS
	if(defined('THEME_FOLDER')){
	 
		$HandlePath = get_template_directory()."/framework/layouts/";			 
		$loadheroArray = array();
		if(is_dir($HandlePath)){
		if($handle1 = opendir($HandlePath)) {      
				while(false !== ($file = readdir($handle1))){	
					if(strlen($file) > 5 && substr($file, -3) == "php" ){
					
						include($HandlePath."/".$file);					
								
					}
				}	
			}
		} 
	} 
	
	
 	
	if(defined('THEME_FOLDER')){

	// LOAD DEFAULTS
	$HandlePath = get_template_directory()."/".THEME_FOLDER."/designs/"; 
		 
	$loadheroArray = array();
	if(is_dir($HandlePath)){
	if($handle1 = opendir($HandlePath)) {      
			while(false !== ($file = readdir($handle1))){	
				if(strlen($file) > 5 && substr($file, -3) == "php" ){
				 
					include($HandlePath."/".$file);					
							
				}
			}	
		}
	} 
	
	}
	
	// LOAD ALL BLOCK DATA AND STORE IT IN A GLOBAL ARRAY
	$args = apply_filters( 'ppt_admin_layouts', array() );
 	
	// THEN LOAD IN THE BLOCKS		
	$this->all_admin_layouts = $args; // save all array into block data
 
}
  

/* =============================================================================
		IS FLUID LAYOUT
	========================================================================== */
function homeCotent($key1, $key2, $exta = ""){ global $CORE;	 
		
		
		if(defined('WLT_DEMOMODE')){
			// CHECK FOR DEFAULT VALUES
			$homedata = hook_admin_2_homeedit(array());			
			if(!empty($homedata) && isset($homedata[$key1]['data'][$key2]['d'])){			
				return $homedata[$key1]['data'][$key2]['d'];			
			}		
		}
		
		$lang = $CORE->_language_current(1);
		
		$lang = "en_us";
		
	 	$HDATA = _ppt('hdata_'.$lang);
		   
		if(substr($key2,-4) == "_aid"){
				 
			if($exta == "post_title"){
				return get_the_title($HDATA[$key1][$key2]);
			}
				
		}elseif(isset($HDATA[$key1][$key2]) && $HDATA[$key1][$key2] != ""){ 
		
				return stripslashes($HDATA[$key1][$key2]); 
				
		}else{
		
			// CHECK FOR DEFAULT VALUES
			$homedata = hook_admin_2_homeedit(array());
			
			if(!empty($homedata) && isset($homedata[$key1]['data'][$key2]['d'])){
			
				return $homedata[$key1]['data'][$key2]['d'];
			
			}else{
			
				return;
			
			}
		}
	
	return;
} 







function style_header($default, $settings){ global $settings;

	// GET SETTINGS
	$headerstyle = _ppt('headerstyle');
	
	if(is_array($headerstyle) && _ppt('allow_headerstyles') == 1 ){
	 
		if(isset($headerstyle['top']) && $headerstyle['top'] != "0"){
		
			// ADD-ON CSS
			if(isset($headerstyle['topclass'])){
			$settings['class'] = $headerstyle['topclass'];
			}
			  
			_ppt_template(  'framework/elementor/_header/'.$headerstyle['top']);
		
		}
		
		if(isset($headerstyle['main']) && $headerstyle['main'] != "0"){
		
			// ADD-ON CSS
			if(isset($headerstyle['mainclass'])){
			$settings['class'] = $headerstyle['mainclass'];
			}
			
			_ppt_template(  'framework/elementor/_header/'.$headerstyle['main']);
		
		}
		
		if(isset($headerstyle['menu']) && $headerstyle['menu'] != "0"){
			
			
			// ADD-ON CSS
			if(isset($headerstyle['menuclass'])){
			$settings['class'] = $headerstyle['menuclass'];
			}
			
			_ppt_template(  'framework/elementor/_header/'.$headerstyle['menu']);		
		}
	
	
	}else{
	 
	_ppt_template( $default );
	
	} 

}
 

/*
	this function performs the rating
	for newly added comments
*/


function delete_comment_extra( $comment_id ){
    //$filter = current_filter();
		
		// GET META
		$update_postid = get_comment_meta($comment_id, 'ratingpid', true);
		
		if(is_numeric($update_postid)){
		
			$vv = get_post_meta( $update_postid, 'starrating_votes', true);
			if(!is_numeric($vv)){ $vv = 1; }
			$vv = $vv -1;
			update_post_meta($update_postid, 'starrating_votes', $vv);
			
			// DELETE ALL
			delete_comment_meta( $commentid, 'ratingpid', '' ); 
		 
		}
		
		return $comment_id;
  
 }

function insert_comment_extra($commentid) { global $post, $CORE;


		// CHECK FOR FILE ATTACHMENT
		if(isset($_FILES['commentphoto']) && strlen($_FILES['commentphoto']['name']) > 2 && in_array($_FILES['commentphoto']['type'],$CORE->allowed_image_types) && is_numeric($_POST['comment_post_ID']) ){
				 
				
				// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
				$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
				if(!function_exists('get_file_description')){
				if(!defined('ABSPATH')){
				require $dir_path . "/wp-load.php";
				}
				require $dir_path . "/wp-admin/includes/file.php";
				require $dir_path . "/wp-admin/includes/media.php";	
				}
				if(!function_exists('wp_generate_attachment_metadata') ){
				require $dir_path . "/wp-admin/includes/image.php";
				}				 
				
				// GET WORDPRESS UPLOAD DATA
				$uploads = wp_upload_dir();
				
				// UPLOAD FILE 
				$file_array = array(
					'name' 		=> $_FILES['commentphoto']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['commentphoto']['type'],
					'tmp_name'	=> $_FILES['commentphoto']['tmp_name'],
					'error'		=> $_FILES['commentphoto']['error'],
					'size'		=> $_FILES['commentphoto']['size'],
				);
				
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
				
				// set up the array of arguments for "wp_insert_post();"
				$attachment = array(			 
					'post_mime_type' => $_FILES['commentphoto']['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', basename( $file['name'] ) ),
					'post_content' => '',
					'post_author' => $userdata->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_parent' => 0,
					'guid' => $uploaded_file['url']
				);									
				
				// insert the attachment post type and get the ID
				$attachment_id = wp_insert_post( $attachment );
		
				// generate the attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
				 
				// update the attachment metadata
				$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
				
				if(isset($attach_data['sizes']['thumbnail']['file'])){
					$thumbnail = $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
				}else{
					$thumbnail = $uploaded_file['url'];
				}	
					
			 	 
				// NOW LETS SAVE THE NEW ONE				 
				add_comment_meta( $commentid, 'photo',  array('src' => $uploaded_file['url'], 'thumb' => $thumbnail, 'path' => $uploaded_file['file'], "attachment_id" => $attachment_id )  );
				
		}}
		
		if( isset($_POST['score']) ){
		
		
		 // SAVE COMMEN META INCASE WE DELETE IT
			add_comment_meta( $commentid, 'ratingpid', $_POST['comment_post_ID'] );				
			add_comment_meta( $commentid, 'ratingtotal', $_POST['score'] );
			add_comment_meta( $commentid, 'rating1', $_POST['score'] );
		 
		}elseif(isset($_POST['rating1']) && is_numeric($_POST['rating1']) && is_numeric($_POST['comment_post_ID']) ){	
		 	
			
		 
		 	$postid = $_POST['comment_post_ID'];  
		 	
			// SAVE STAR RATING VALUE
			$totalvotes 	= get_post_meta($postid, 'starrating_votes', true);
			$totalamount 	= get_post_meta($postid, 'starrating_total', true);
				
			$dividbyme = $_POST['totalratingitems'];
			
			
			// ADD UP ALL THE STARS
			// DEVIDE THEM BY 5
			// MULTIPLY BY 100
			
			 
			if($dividbyme == 4){
			
				$score = round( ( $_POST['rating1']+$_POST['rating2']+$_POST['rating3']+$_POST['rating4'] ) / 4 ,2);
			
			}elseif($dividbyme == 1){
			
				$score = $_POST['rating1'];
			
			}
			  
			if(!is_numeric($totalamount)){ $totalamount = $score; }else{ $totalamount += $score; }
			if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }	
			 
			$save_rating = round(($totalamount/$totalvotes),2);
			update_post_meta($postid, 'starrating', $save_rating);
			update_post_meta($postid, 'starrating_total', $totalamount);
			update_post_meta($postid, 'starrating_votes', $totalvotes);
			
			// SAVE COMMEN META INCASE WE DELETE IT
			add_comment_meta( $commentid, 'ratingpid', $postid );				
			add_comment_meta( $commentid, 'ratingtotal', $score );
			add_comment_meta( $commentid, 'rating1', $_POST['rating1'] );
			
			// POST AUTHOR
			if(isset($_POST['postauthor']) && is_numeric($_POST['postauthor']) ){
			add_comment_meta( $commentid, 'postauthor', $_POST['postauthor'] );
			}
			
			if($dividbyme == 4){
				add_comment_meta( $commentid, 'rating2', $_POST['rating2'] );
				add_comment_meta( $commentid, 'rating3', $_POST['rating3'] );
				add_comment_meta( $commentid, 'rating4', $_POST['rating4'] );	
			}
					
		}
}
/*
	this function redirects the user
	after they have submitted a comment
*/
function redirect_after_comment($location){
		$newurl = substr($location, 0, strpos($location, "#comment"));
		return $newurl . '?newcomment=1';
}
/*
	this function processed the comment
	form
*/
function _preprocess_comment( $comment_data ) { global $CORE, $userdata, $post, $comment;	 
		 
		// BASIC FORM VALIDATION
		if(!is_admin() && !isset($_POST['nocaptcha'])){
		 
		 	$canContinue = true;
			if(_ppt(array('captcha','enable')) == 1 && _ppt('captcha','sitekey') != "" ){	
				$canContinue = google_validate_recaptcha();	
			}
			
			if(!$canContinue){
			wp_die( __("The verification code was invalid. Press back and try again.","premiumpress") );
			}
		} 
		
		// RETURN COMMENT DATA
		return $comment_data;
}
 
 

	/* ========================================================================
	 CORE BODY CSS TAGS
	========================================================================== */ 
	function BODYCLASS($classes){
	
		global $wpdb, $post, $CORE, $userdata, $pagenow; $c = ""; $extra = "";
	 
		if($pagenow == "wp-login.php"){
		$classes[] = "ppt_login";
		}
		
		if($userdata->ID){
		$classes[] = "logged-in";
		}
		
		if($CORE->GEO("is_right_to_left", array() )){ 
		$classes[] = "rtl right-to-left";
		}
		
		if(_ppt(array('design','page_layout_new')) != "" && !isset($_GET['ppt_live_preview']) && !isset($_GET['map'])  ){
			switch(_ppt(array('design','page_layout_new'))){
			
				case "5": {
					$classes[] = "boxed";				
				} break;
				 	
				case "3":
				case "3a": {
					//$classes[] = "fullcontainer";				
				} break;
				
				case "4":
				case "4a": {
					//$classes[] = "slim";				
				} break;				
				
			}		
		}
		 
		// LAYOUT SHADOW
		if( in_array( _ppt(array('design','boxed_layout')) , array("1a","2a","3a","4a") )   ){		 
			$classes[] = "body-shadow";	
		}
		
		// LAYOUT SHADOW
		if( in_array( _ppt(array('design','boxed_layout')) , array("1b") )   ){		 
			$classes[] = "body-border";	
		}
		
		// CUSTOM BODY TAGS
		$tags = _ppt(array('design','custom_bodytags'));
		if(strlen($tags) > 2){
			$classes[] = $tags;	
		}
	 
		
	 
		// MOBILE MENU
		if(_ppt('footer_mobile_menu') == 1){
			$classes[] = "body-hide-footer";			
		}
		 
		if(defined('WLT_DEMOMODE')){
		$classes[] = "demomode";
		} 
		
		if(isset($GLOBALS['flag-search'])){ 
		$classes[] = "search";		
		} 
		if(isset($GLOBALS['flag-single'])){ 
		$classes[] = "single-design4";	
		}
		if(isset($_GET['map'])){ 
		$classes[] = "mapview";	
		} 
		if(isset($_GET['inline-editor'])){ 
		$classes[] = "ppt-inline-editor";	
		} 
		
		
		
		if(_ppt(array('design', 'customsidebar')) == 1){
			$classes[] = "ppt-sidebar";	
		}
		
		if( $CORE->isMobileDevice() ){ 
		$classes[] = "ppt-mobile-device";	
		}   
	 	
		if(defined('THEME_KEY')){
		$classes[] = "theme-".THEME_KEY;
		}
		
		if(defined('THEME_KEY') && in_array(THEME_KEY, array("da","es"))){
		$classes[] = "tall-images";
		}
		
		// INNER PAGE FOR BACKGROUND COLOR
		if(isset($GLOBALS['flag-home']) && !isset($_GET['ppt_live_preview']) ){ 
		
			$classes[] = "home";	
			
		}elseif( isset($_GET['ppt_live_preview']) ){		
		
			$classes[] = "previewmode";
			
		}else{
		
			$classes[] = "innerpage";			
		}
		 
		
		return $classes;	
	}
	
/* ========================================================================
 CORE BODY COLUMN LAYOUTS
========================================================================== */ 
function BODYCOLUMNS(){ global $post;return;}
function CSS($tag,$return=false){}

/* =============================================================================
	PAGE TITLE ADJUSTMENTS
========================================================================== */

function TITLE( $title, $sep = "" ) {
	global $paged, $page, $CORE; $extra = "";
	
	// HOME PAGE OBJECTS
	if(isset($_GET['home_paged'])){
		$extra .= " | ".__("Page","premiumpress")." ".$_GET['home_paged'];
	}
 
    return $title.$extra;
}

	 



function hook_sidebar_bottom(){ global $CORE;
	echo $CORE->BANNER('sidebar_right_bottom'); 
}
function hook_sidebar_bottom1(){ global $CORE;
	echo $CORE->BANNER('sidebar_left_bottom'); 
}
function hook_map_display(){ global $CORE;

if( isset($GLOBALS['CORE_THEME']['display_search_map'] ) && $GLOBALS['CORE_THEME']['display_search_map']  == "2" ){ 

echo $this->ppt_googlemap_html(false);  

}

echo $CORE->BANNER('sidebar_right_top'); 

}

function hook_map_display1(){ global $CORE;
 
if( isset($GLOBALS['CORE_THEME']['display_search_map'] ) && $GLOBALS['CORE_THEME']['display_search_map']  == "1" ){ 

echo $this->ppt_googlemap_html(false);  

}

echo $CORE->BANNER('sidebar_left_top'); 


}

 
	
function login_form(){ if(isset($_GET['redirect']) || isset($_GET['redirect_to']) ){ ?>
 <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['redirect'])){  echo esc_attr($_GET['redirect']); }elseif(isset($_GET['redirect_to'])){  echo esc_attr($_GET['redirect_to']); }else{ echo $GLOBALS['CORE_THEME']['links']['myaccount']; } ?>" />
<?php    
} }
 
 
 
function _hook_callback_success(){ global $payment_data;

   $gc = stripslashes(get_option('google_conversion'));
   
   if(isset($payment_data['orderid'])){        
   echo str_replace("[orderid]",$payment_data['orderid'], $gc ); 
   }
   
   if(isset($payment_data['description'])){
   $gc = str_replace("[description]",$payment_data['description'], $gc);
   }
   
   if(isset($payment_data['total'])){
   $gc = str_replace("[total]",$payment_data['total'], $gc);
   }
   
   echo $gc;	
	
}

 
function _facebookmeta(){ global $post, $CORE;  

?>

<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo strip_tags(do_shortcode('[TITLE]')); ?>" />
<meta property="og:description" content="<?php echo strip_tags(do_shortcode('[EXCERPT]')); ?>" />
<meta property="og:image" content="<?php echo strip_tags(do_shortcode('[IMAGE pathonly=1]')); ?>" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="700" />

<?php }

 


function _make_images_responsive($content) {
  
  $content = str_replace("wp-image","img-fluid wp-image", $content);
  
  return $content;
  
}  

	
/* ========================================================================
 PAGE NAVIGATION BUTTONS
========================================================================== */
function PAGENAV($return="", $numposts = "", $max_page = "") { global $wpdb, $wp_query; $return=""; $pages = "";  $backBtn = ""; $forwardBtn = "";

if (!is_single()) {

 	
		$request = $wp_query->request;	 
		$posts_per_page = intval(get_query_var('posts_per_page'));
		 
		$paged = intval(get_query_var('paged'));
	
		$pagenavi_options['pages_text'] = __("Page %CURRENT_PAGE% of %TOTAL_PAGES%","premiumpress");
		$pagenavi_options['current_text'] = "%PAGE_NUMBER%";
		$pagenavi_options['page_text'] = "%PAGE_NUMBER%";
		
		$pagenavi_options['first_text'] = __("<< First","premiumpress");
		$pagenavi_options['last_text'] = __("Last >>","premiumpress");
 
		$pagenavi_options['num_pages'] = "2";
		$backBtn = ""; $forwardBtn = "";
		
		if(!is_numeric($numposts)){
		$numposts = $wp_query->found_posts;
		}
		
		if(!is_numeric($max_page)){
		$max_page = $wp_query->max_num_pages;
		}
		 
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		if(isset($_GET['home_paged']) && is_numeric($_GET['home_paged'])){
		$paged = $_GET['home_paged'];
		}
		 
		// HIDE IF
		//die($numposts." == ".$posts_per_page);
		if($numposts  <= $posts_per_page){ return; }
		
		
		$pages_to_show = intval(5);
		$larger_page_to_show = intval(1);
		$larger_page_multiple = intval(1);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		
		
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = ($this->n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = $this->n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = $this->n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = $this->n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}
		if($max_page > 1 || intval(1) == 1) {
		
		if($max_page == 0 && $paged > 0){ $max_page=1; }
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);	
  		
					// PAGES COUNT
					if(!empty($pages_text)) {
						$pages .= '<li class="page-item"><span class="page-link">'.$pages_text.'</span></li>';
					}
					
					 
					 // PREVIOUS
					if($paged > 1 ){							
							 				
						if(isset($GLOBALS['flag-home'])){
							$link = get_home_url()."/?home_paged=".($paged-1);
						}else{
							$link = esc_url(get_pagenum_link($paged-1));
						}
															
						$backBtn .= '<li class="page-item "><a href="'.$link.'" class="page-link"><i class="fa fa-angle-left"></i></a></li>';
													
					}else{
					
						$backBtn .= '<li class="page-item disabled "><a href="javascript:void(0);" class="page-link"><i class="fa fa-angle-left"></i> </a></li>';	
					
					}
					
					
				  	//  NUMBERS
					for($i = $start_page; $i  <= $end_page; $i++) {	
						/*** get link for formatting ***/						
						if(isset($GLOBALS['flag-home'])){
						$link = get_home_url()."/?home_paged=".$i;
						}else{
						$link = esc_url(get_pagenum_link($i));
						}

						/*** build string ***/
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							$return .= '<li class="page-item active"><a href="'.$link.'" class="page-link bg-primary" rel="nofollow">'.$current_page_text.'</a></li>';
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$return .= '<li class="page-item"><a href="'.$link.'" class="page-link" rel="nofollow">'.$page_text.'</a></li>';
						}
					}
					 
			 		// FIRST BUTTON
					if($paged > 0 && $paged < $max_page){	
						/*** get link for formatting ***/						
						if(isset($GLOBALS['flag-home'])){
						$link = get_home_url()."/?home_paged=".($paged+1);
						}else{
						$link = esc_url(get_pagenum_link($paged+1));
						}
						 
						$forwardBtn = '<li class="page-item "><a href="'.$link.'" class="page-link"> <i class="fa fa-angle-right nomargin" aria-hidden="true"></i> </a></li>';	
										
					}else{
					
						$forwardBtn = '<li class="page-item disabled "><a href="javascript:void(0);" class="page-link"><i class="fa fa-angle-right nomargin" aria-hidden="true"></i></a></li>';				
					
					}
		}
	}
	
	// ADD ON STYLE WRAPPER <div class="pager pull-right">'.$pages.'</div>
	$return = '<ul class="pagination">'.$backBtn.''.$return.''.$forwardBtn.'</ul>';
	 
	// RETURN VALUE
	if($return){	return $return;	}else{	echo $return;	}
}
function n_round($num, $tonearest) {  return floor($num/$tonearest)*$tonearest;}	
	
/* =============================================================================
   BREADCRUMBS 
   ========================================================================== */		

function BREADCRUMBS($before = '', $after = '') {
 
 global $CORE, $post, $wp_query;
 
  $delimiter = ''; 
 
  $STRING = "";

    $homeLink = esc_url( home_url() );
    $STRING .= $before .' <a href="' . $homeLink . '" class="bchome breadcrumb-item">'.__('Home','premiumpress').'</a> ' . $delimiter . ' '. $after;
 	
	if ( is_category() ) {
 
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
	 
      if ($thisCat->parent != 0 && is_numeric($parentCat) ) $STRING .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
	  
      $STRING .= $before . '<a href="'.$GLOBALS['CORE_THEME']['links']['blog'].'" class="breadcrumb-item">'.__("Blog","premiumpress").'</a>'.$after. ' '. $before.'<a href="#" class="breadcrumb-item">' . single_cat_title('', false) . '</a>' . $after;
 
    } elseif ( is_author() ) {
	
       global $author, $authorID;
      $userdata = get_userdata($author);
      $STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".get_the_author_meta( 'display_name', $authorID)."</a>" . $after;
 
 
    } elseif ( is_day() ) {
      $STRING .= '<a href="' . get_year_link(get_the_time('Y')) . '" class="breadcrumb-item">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      $STRING .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '" class="breadcrumb-item">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      $STRING .= $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      $STRING .= '<a href="' . get_year_link(get_the_time('Y')) . '" class="breadcrumb-item">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      $STRING .= $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      $STRING .= $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
	
      if ( get_post_type() != 'post' ) {
	  
	  // ADD IN FIRST CATEGORY TO THE BREADCRUMBS FOR USER TO RETURN TO
	    $term_list = wp_get_post_terms($post->ID, THEME_TAXONOMY, array("fields" => "all"));
		if(isset($term_list[0]->name)){
		
		 $STRING .=  $before ."<a href='".get_term_link($term_list[0]->slug, THEME_TAXONOMY)."' class='breadcrumb-item'>".$term_list[0]->name.'</a> '.$after;
		}

        
      } else {
	  
        $cat = get_the_category();
		if(!empty($cat)){
		$cat = $cat[0];
		
		$STRING .= $before .'<a href="'._ppt(array('links','blog')).'"  class="breadcrumb-item">'.__("Blog","premiumpress").'</a>'. $after; 
		$STRING .= $before . "".str_replace("<a ","<a class='breadcrumb-item' ",get_category_parents($cat, TRUE, ''))."". $after;
			
			// DONT SET BLOG TITLE AGAIN
			if(!isset($GLOBALS['flag-blog'])){
			
			$STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
			}
		}
		
      }
 	
	} elseif (isset($_GET['s']) || isset($_GET['advanced_search']) ){
	
	$STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".__('Search','premiumpress') ."</a>" . $after;//$post_type->labels->singular_name
	
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	
	// CHECK IF ITS A CATEGORY FOR OUR CUSTOM POST TYPE	
	$category = $wp_query->get_queried_object();
	 
	
	 if(isset($category->taxonomy) && $category->taxonomy != THEME_TAXONOMY){

	  if(isset($category->term_taxonomy_id)){
			 $pterm = get_term_by('id', $category->term_id, $category->taxonomy);
			 $gg1 = get_term_link($pterm->slug, $category->taxonomy);
			 if( !is_wp_error( $gg1 ) ) {
			  $STRING .= $before . "<a href='".$gg1."' class='breadcrumb-item'>".str_replace("_"," ",str_replace("-"," ",$pterm->taxonomy)). "</a>". $before." <a href='".$gg1."' class='breadcrumb-item'>".$pterm->name ."</a>" . $after;
			 }		 
		 }
	 
	 }elseif(isset($category->name)){
	 
	 
		 $gg = get_term_link($category);
			 
		 if( !is_wp_error( $gg ) ) {		 
		 // CHECK FOR PARENT CATEGORY
		 if($category->parent != "0"){
			 $pterm = get_term_by('id', $category->parent, $category->taxonomy);
			 $gg1 = get_term_link($pterm->slug, $category->taxonomy);
			 if( !is_wp_error( $gg1 ) ) {
				 // CHECK FOR PARENT CATEGORY
				 if($pterm->parent != "0"){
					 $pterm2 = get_term_by('id', $pterm->parent, $pterm->taxonomy);
					 $gg2 = get_term_link($pterm2->slug, $pterm2->taxonomy);
					 if( !is_wp_error( $gg2 ) ) {
					 	$STRING .= $before . "<a href='".$gg2."' class='breadcrumb-item'>".$pterm2->name ."</a>" . $after;
					 }		 
				 }
			 
			  $STRING .= $before . "<a href='".$gg1."' class='breadcrumb-item'>".$pterm->name ."</a>" . $after;
			 }		 
		 }		 
	 	 $STRING .= $before . "<a href='".$gg."' class='breadcrumb-item'>".$category->name ."</a>" . $after;
		 }
	 }elseif(!isset($GLOBALS['flag-home'])){	
	 
		 $post_type = get_post_type_object(get_post_type());
		 
		 if(isset($post_type->labels->singular_name)){
		 $STRING .= $before ."<a href='#' class='breadcrumb-item'>".__("Category","premiumpress")."</a>" . $after; //$post_type->labels->singular_name
		 }
		 
	  }
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
	  
      //$STRING .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      $STRING .= $before .'<a href="' . get_permalink($parent) . '" class="breadcrumb-item">' . $parent->post_title . '</a>'. $after;
	  
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
 
    } elseif ( is_page() && !$post->post_parent && !is_front_page()   ) {
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
 
    } elseif ( is_page() && $post->post_parent  && !is_front_page() ) {
	
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
	  if(!is_object($parent_id)){
        $page = get_page($parent_id);
        $breadcrumbs[] = $before .'<a href="' . get_permalink($page->ID) . '" class="breadcrumb-item">' . get_the_title($page->ID) . '</a>'. $after;
        $parent_id  = $page->post_parent;
		}
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb){
		  $STRING .= $crumb . ' ' . $delimiter . '';
	  }
      $STRING .= $before ."<a href='#' class='breadcrumb-item'>" . get_the_title() . "</a>". $after;
 
    } elseif ( is_search() ) {
      $STRING .= $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      $STRING .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 

    } elseif ( is_404() ) {
      $STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".'Error 404'.'</a>' . $after;
    }else{
	
	}
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $STRING .= '  ';
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".__("Page","premiumpress") . ' ' . get_query_var('paged')."</a>". $after;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $STRING .= ' ';
    }
  
  //}
  
  return $STRING;
}	























function CustomDesignEdit($key, $homedata, $pagekey = "home"){

global $CORE;

 
   // GET THE CURRENT DATA
   $HDATA = _ppt($pagekey);
  
   // CHECK FOR INNER PAGE CONTENT -- DEFAULTS   
   if( $HDATA  == "" && isset($_GET['pagekey']) && strpos($_GET['pagekey'],"page_") !== false ){
   	
		$innerd  = $CORE->LAYOUT("default_innerpages", array() ); 
		if(isset($innerd[$pagekey])){
		$HDATA = $innerd[$pagekey];
		}   
   } 
   
   // GET DEFAULT BLOCK DATA
   $block_defaults  =  $CORE->LAYOUT("get_block_defaults", $key);
     
     
   ?>
  

    
<div class="accordion" id="accordionExample">    
 <?php $i=1; foreach($homedata['data'] as $key1 => $item){ 
	    
	   		if(isset($item['type'])){
			
			}else{
				$item['type'] = ""; 
			}
			
			if(!isset($item['d'])){ $item['d'] = ""; }
			 
			
			?>


<?php if($item['type'] == "seperator-heading"){ ?>

  <div class="card mb-0">
    <div class="card-header" id="heading<?php echo $i; ?>">
      <h5 class="mb-0">
        <button class="btn font-weight-bold text-dark" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
         <?php echo $item['t']; ?>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $i; ?>" class="collapse" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordionExample">
      
      <div class="card-body row">   
      
      
<?php }elseif($item['type'] == "seperator-end"){ ?>     
      
      </div>
    </div>
  </div>  
 
          
<?php }elseif($item['type'] == "seperator"){ ?>
 
<div class="col-12 bg-dark text-light p-3 font-weight-bold my-3"><span class="pl-3"><?php echo $item['t']; ?></span></div>
 
<?php }else{ ?>
       
 
<div class="<?php if(in_array($item['type'], array("text","textarea","upload"))){ ?>col-md-12<?php }else{ ?>col-md-4<?php } ?> mb-4">

 
 <div class="col-12">            
         <?php  if(isset($item['t'])){ ?><label class=""><?php echo $item['t']; ?></label><?php } ?>
         
         <?php if(isset($item['desc'])){  ?><p><?php echo $item['desc']; ?></p> <?php  } ?>  
         
         </div>            
         <div class="col-12">
 <?php  switch($item['type']){ 
			 
			
			 case "yesno":
			 case "select": {
			 
               ?> 
			 <select name="admin_values[<?php echo $pagekey; ?>][<?php echo $key; ?>][<?php echo $key1; ?>]" 
             class="form-control hasdefault" 
             id="<?php echo $key; ?>_<?php echo $key1; ?>" 
              
             data-default="<?php if(isset($block_defaults[$key1])){ echo $block_defaults[$key1]; }?>">
             
             <?php if(isset($item['values']) && is_array($item['values']) ){ foreach($item['values'] as $k => $v){ ?>
             <option value="<?php echo $k; ?>" <?php 
			 
			 if(isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == "" && $item['d'] == $k){  
			 echo "selected=selected"; 
			 }elseif(isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == $k){ 
			 echo "selected=selected"; 
			 } ?>><?php echo $v; ?></option>
             <?php } } ?>
             
             </select>
             
             <?php if(in_array($key1,array("footer_menu1","footer_menu2"))){ ?>
             <a href="nav-menus.php" class="small mt-2" target="_blank">set menu items here</a>
             <?php } ?>
             
             
             <?php
			 
			 
			 } break;
			  
               
               
               case "seperator": { } break; 
               
               case "upload": { 
               
                
			   
			   $tdata = _ppt(array( $pagekey ,$key));
			    
               ?> 
           
            <input type="hidden" 
               
               id="up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>_aid" 
               
               name="admin_values[<?php echo $pagekey; ?>][<?php echo $key; ?>][<?php echo $key1; ?>_aid]" 
              
               class="form-control"
             
             value="<?php if(isset($tdata[$key1.'_aid']) && is_numeric($tdata[$key1.'_aid'])){ echo $tdata[$key1.'_aid']; } ?>"  />  
               
               
                             
            <input 
               name="admin_values[<?php echo $pagekey; ?>][<?php echo $key; ?>][<?php echo $key1; ?>]" 
               type="hidden" 
               id="up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>" 
               value="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"
               class="form-control form-image-data"
             
               /> 
               
            <div class="pptselectbox mb-3 bg-dark p-1 text-center" style="padding:5px;">
               <img src="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); }  ?>" style="max-width:100%; max-height:300px;" class="form-image" 
               id="<?php echo $key."".$key1; ?>_preview_<?php echo $pagekey; ?>" />   
            </div>
            <div class="pptselectbtns mb-5 bg-light text-center py-2">
               <a href="<?php if(isset($HDATA[$key][$key1])){ echo $HDATA[$key][$key1]; } ?>" target="_blank" class="btn btn-sm rounded-0 btn-secondary ml-2">View </a>
               <a href="javascript:void(0);"id="editImg<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>" class="btn btn-sm rounded-0 btn-info mr-3">Edit </a>  
               <a href="javascript:void(0);" id="upload_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>" class="btn btn-sm rounded-0 btn-warning">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>').val('');document.admin_save_form.submit();" class="btn btn-sm rounded-0 btn-danger">Delete</a>
            </div>
            <script >
               jQuery(document).ready(function () {
               
                   jQuery('#editImg<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>').click(function() {  
				   
				   		jQuery("#savechagedbtnb").show();         
                                
                       tb_show('', 'media.php?attachment_id=<?php if(isset($HDATA[$key][$key1."_aid"])){ echo $HDATA[$key][$key1."_aid"]; } ?>&action=edit&amp;TB_iframe=true');
                                    
                       return false;
                   });
                   
                   jQuery('#upload_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>').click(function() { 
				   
				   		jQuery("#savechagedbtnb").show();          
                   
                       ChangeAIDBlock('up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>_aid');
                       ChangeImgBlock('up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>');		
                       ChangeImgPreviewBlock('<?php echo $key."".$key1; ?>_preview_<?php echo $pagekey; ?>')
                       
                       formfield = jQuery('#up_<?php echo $key."".$key1; ?>_<?php echo $pagekey; ?>').attr('name');
                    
                       tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                           return false;
                   });
                                   
               });	
            </script>
            <?php 
          
               } break; 
			   
			     case "textarea": {
               ?>
            
            <textarea name="admin_values[<?php echo $pagekey; ?>][<?php echo $key; ?>][<?php echo $key1; ?>]" 
            style="height:150px !important; margin-bottom:20px !important; width:100%;" class="form-control pt-2 hasdefault" data-default="<?php if(isset($block_defaults[$key1])){ echo $block_defaults[$key1]; }?>"/><?php 
			if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == "" ){ 
			echo $item['d']; 
			}else{ echo stripslashes($HDATA[$key][$key1]); } ?></textarea>
            
            <?php 
               } break; 
               
			   case "text": {
                ?>    
          
            
               <input type="text" 
                  name="admin_values[<?php echo $pagekey; ?>][<?php echo $key; ?>][<?php echo $key1; ?>]" 
                  value="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""  ){ 
				  echo $item['d']; 
				  }else{ echo stripslashes($HDATA[$key][$key1]); } ?>" 
                  id="<?php echo $key; ?>_<?php echo $key1; ?>"
                  
                  <?php if(isset($item['placeholder'])){ ?>placeholder="<?php echo $item['placeholder']; ?>"<?php } ?>       
                  
                  
                  <?php if(strpos(strtolower($item['t']), "link") !== false){ ?>placeholder="https://" <?php } ?>         
                  class="form-control hasdefault" data-default="<?php if(isset($block_defaults[$key1])){ echo $block_defaults[$key1]; }?>">
             
            <?php 
               
               } break;
               
               
               } // end swiutch 
            
               
                ?> 
</div>
</div> 


<?php } ?>      
      

 
 
             
<?php $i++; } // end foreach ?>

</div><!-- end accordian -->

 
 <?php
 
} 




	 
	
}

?>