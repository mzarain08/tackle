<?php
 

/*
	this function performs the installation
*/
function premiumpress_install_and_reset(){ global $CORE, $userdata, $wpdb;

	$GLOBALS['ppt_start_time'] = microtime(true);

	
	// REINSTALL
	if(get_option("core_theme_defaults_loaded") == "" && isset($_POST['adminArray']['ppt_license_key']) && isset($_POST['reinstall']) ){	
	 	
		
		// SET LICENSE KEY
		update_option('ppt_license_key', trim($_POST['adminArray']['ppt_license_key']), true);		
		
		// MAKE CHECKES
		header("location: ".get_home_url().'/wp-admin/admin.php?page=premiumpress');
		exit();		
	
	// FIRST INSTALL
	}elseif(get_option("core_theme_defaults_loaded") == "" && isset($_POST['adminArray']['ppt_license_key']) && isset($_POST['firstimeinstall']) ){		 	  
			
		// SAVE THE THEME NAME FOR LATER USE
		update_option('ppt_theme', $_POST['admin_values']['template']);
		
		// INSTALL THEME TABLES
		core_admin_2_themeinstall();	
		
		// UPDATE
		update_option("ppt_reinstall", THEME_VERSION);
					
		// SET LICENSE KEY
		update_option('ppt_license_key', trim($_POST['adminArray']['ppt_license_key']), true);
		
		// MAKE CHECKES
		header("location: ".get_home_url().'/wp-admin/admin.php?page=settings&firstinstall=1');
		exit();		
	
	}// END FIRST INSTALLATION
	
	// SYSTEM RESET
	if(isset($_POST['core_system_reset']) && $_POST['core_system_reset'] == "new"){		 	
			
			if(current_user_can( 'edit_user', $userdata->ID ) ){
			
				delete_option("ppt_reinstall");
			
			
				// [MYSQL] DROP ALL OF THE TABLES LINKED TO OUR THEMES
				$wpdb->query("delete a,b,c,d
							FROM ".$wpdb->prefix."posts a
							LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
							LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
							LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
							LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
							WHERE a.post_type ='".THEME_TAXONOMY."_type'");
				
				// 2. DELETE ALL CATEGORIES
				$terms = get_terms(THEME_TAXONOMY, 'orderby=count&hide_empty=0');	 
				$count = count($terms);
				if ( $count > 0 ){				
						foreach ( $terms as $term ) {
							wp_delete_term( $term->term_id, THEME_TAXONOMY );
						}
				}
			
				// RESET ALL CORE VALUES
				update_option('ppt_installed_theme','');
				update_option('ppt_license_key','');
				update_option('ppt_license_upgrade', '');
				update_option("core_theme_defaults_loaded","");
				update_option("core_admin_values","");
				// REDIRECT TO DASHBOARD
				header("location: ".get_home_url().'/wp-admin/index.php');
				exit();			
			}
			
	} // END SYSTEM RESET	

}

/*
FUNCTION USED WHEN OUR THEME IS DEACTIVATED
*/
function core_admin_01_theme_deactivated(){ }
   
  
function ppt_install_db_tables($droptable = true){ global $wpdb;

 
// [MYSQL] INSTALL SESSION TABLE FOR CART
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_sessions` (
  `session_key` varchar(100) NOT NULL,
  `session_date` datetime NOT NULL,
  `session_userid` int(10) NOT NULL,
  `session_data` text NOT NULL,
  PRIMARY KEY (`session_key`));");

$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_sessions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
 

}

 
function core_admin_2_themeinstall($test=false){ global $wpdb, $CORE; $CORE->taxonomies(); $GLOBALS['theme_defaults'] = array();





	
	// INSTALL DATABASE TABLES
	ppt_install_db_tables(); 
 	
 	
	// [WORDPRESS] DEFAULT MEDIA OPTIONS
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 350);
	update_option('thumbnail_crop', 0);	 
	update_option('core_post_types', ''); 
	update_option('posts_per_page', '12');
	update_option('recent_searches','');
	
	// ADD IN NEW TAX ORDERING CHANGES
	ppt_orderby_activated(false);	
		
	// [PAGES] CREATE DEFAULT THEME PAGES
	$page_links = array();
	
	$theme_pages = array( 
	
		"My Account"	=> "templates/tpl-page-account.php", 
		"Blog" 			=> "templates/tpl-page-blog.php", 
		"Callback" 		=> "templates/tpl-callback.php", 
		"Contact" 		=> "templates/tpl-page-contact.php", 
		"About Us" 		=> "templates/tpl-page-aboutus.php", 
		"FAQ" 			=> "templates/tpl-page-faq.php", 
		"Advertising" 	=> "templates/tpl-page-sellspace.php", 
		"Categories" 	=> "templates/tpl-page-categories.php", 
		
		"Terms" 		=> "templates/tpl-page-terms.php", 
		"Privacy" 		=> "templates/tpl-page-privacy.php",  
		"Add Listing" 	=> "templates/tpl-add.php",
		"Testimonials" 	=> "templates/tpl-page-testimonials.php", 
		"Memberships" 	=> "templates/tpl-page-memberships.php", 
	  
		
		"How it works" 	=> "templates/tpl-page-how.php", 
		"Top Listings" 	=> "templates/tpl-page-top.php",
		
		"Checkout" 		=> "templates/tpl-page-checkout.php", 
		"Cart"			=> "templates/tpl-page-cart.php" ,
		
		"Stores"		=> "templates/tpl-page-stores.php",
		
		"Pricing"		=> "templates/tpl-page-pricing.php"  
	
	 );
	 
	 if( in_array($_POST['admin_values']['template'],array("dating"))){
	 $theme_pages['chatroom']  = "templates/tpl-page-chatroom.php";
	 }
	 
	  
	 if( !in_array($_POST['admin_values']['template'],array("cashback","coupon","compare","escort","software","jobs"))){
	 unset($theme_pages['Stores']);	 
	 }
	 
	  
	 if( isset($_POST['admin_values']['template']) && !in_array($_POST['admin_values']['template'],array("software")) ){
	 
		 if( isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'],array("shop")) ){
			unset($theme_pages['Add Listing']);
			unset($theme_pages['Memberships']);	 
		 }else{
			unset($theme_pages['Checkout']);	
			unset($theme_pages['Cart']);	
		 }
		 
	 }
 
	foreach($theme_pages as $ntitle => $nkey){
		
		if ( get_page_by_title( $ntitle ) == NULL ) {
		
		$page = array();
		$page['post_title'] 	= $ntitle;
		$page['post_content'] 	= '';
		$page['post_status'] 	= 'publish';
		$page['post_type'] 		= 'page';
		$page['post_author'] 	= 1;
		$page_id = wp_insert_post( $page );
		//update_post_meta($page_id , 'pagecolumns', 3);
		update_post_meta($page_id , '_wp_page_template', $nkey);
		$page_links[$nkey] = get_permalink($page_id);  
		
		}else{
			$pagep = get_page_by_title( $ntitle );
			$page_links[$nkey] = get_permalink($pagep->ID);
		}
	
	}
	
 	
	
	// NOW ASSIGN PAGES	
	 
	$GLOBALS['theme_defaults']['links'] = array();
	$GLOBALS['theme_defaults']['links']['blog'] 		= $page_links['templates/tpl-page-blog.php'];
	$GLOBALS['theme_defaults']['links']['myaccount'] 	= $page_links['templates/tpl-page-account.php'];	
	$GLOBALS['theme_defaults']['links']['callback'] 	= $page_links['templates/tpl-callback.php'];
	//$GLOBALS['theme_defaults']['links']['members'] 		= $page_links['tpl-page-members.php'];
	$GLOBALS['theme_defaults']['links']['contact'] 		= $page_links['templates/tpl-page-contact.php'];
	$GLOBALS['theme_defaults']['links']['sellspace'] 	= $page_links['templates/tpl-page-sellspace.php'];
	$GLOBALS['theme_defaults']['links']['aboutus'] 		= $page_links['templates/tpl-page-aboutus.php'];
	$GLOBALS['theme_defaults']['links']['terms'] 		= $page_links['templates/tpl-page-terms.php'];
	$GLOBALS['theme_defaults']['links']['privacy'] 		= $page_links['templates/tpl-page-privacy.php'];
	$GLOBALS['theme_defaults']['links']['faq'] 			= $page_links['templates/tpl-page-faq.php'];
 	$GLOBALS['theme_defaults']['links']['testimonials'] = $page_links['templates/tpl-page-testimonials.php'];
	$GLOBALS['theme_defaults']['links']['categories'] 	= $page_links['templates/tpl-page-categories.php'];
 	
	$GLOBALS['theme_defaults']['links']['how'] 			= $page_links['templates/tpl-page-how.php'];
 	$GLOBALS['theme_defaults']['links']['top'] 			= $page_links['templates/tpl-page-top.php'];
 	
 	$GLOBALS['theme_defaults']['links']['pricing'] 		= $page_links['templates/tpl-page-pricing.php'];
	
	
	if( isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'],array("software")) ){
	
			$GLOBALS['theme_defaults']['links']['cart'] 		= $page_links['templates/tpl-page-cart.php'];
			$GLOBALS['theme_defaults']['links']['checkout'] 	= $page_links['templates/tpl-page-checkout.php'];	 	
		 
			$GLOBALS['theme_defaults']['links']['add'] 			= $page_links['templates/tpl-add.php'];
			$GLOBALS['theme_defaults']['links']['memberships'] 	= $page_links['templates/tpl-page-memberships.php'];
	
	}else{
	
		if( in_array($_POST['admin_values']['template'],array("shop"))){	
			$GLOBALS['theme_defaults']['links']['cart'] 		= $page_links['templates/tpl-page-cart.php'];
			$GLOBALS['theme_defaults']['links']['checkout'] 	= $page_links['templates/tpl-page-checkout.php'];		 	
		}else{	
			$GLOBALS['theme_defaults']['links']['add'] 			= $page_links['templates/tpl-add.php'];
			$GLOBALS['theme_defaults']['links']['memberships'] 	= $page_links['templates/tpl-page-memberships.php'];
		} 
	}
	
	if( in_array($_POST['admin_values']['template'],array("cashback","coupon","compare","escort","software","jobs"))){
	$GLOBALS['theme_defaults']['links']['stores'] 	= $page_links['templates/tpl-page-stores.php'];	
	}
	
	if( in_array($_POST['admin_values']['template'],array("dating"))){
	$GLOBALS['theme_defaults']['links']['chatroom'] 	= $page_links['templates/tpl-page-chatroom.php'];		
	}
 
 
// SOCIAL
$GLOBALS['theme_defaults']['company'] = array("twitter" => "#", "facebook" => "#",  "youtube" => "#", "skype" => "#", "instagram" => "#");
 
 
update_option('show_on_front','page');
update_option('page_on_front', 0);
 
// SAMPLE PAYPAL GATEWAY
update_option('gateway_paypal', 'yes');
update_option('paypal_email', 'sample@paypal.com');	
update_option('paypal_currency', 'USD');	
 
	 
// WEBSITE FAQ
$cfaq = array(

"name" => array(

0 => "This is a sample FAQ for your website.",
1 => "This is a sample FAQ for your website.",
2 => "This is a sample FAQ for your website.",
3 => "This is a sample FAQ for your website.",
4 => "This is a sample FAQ for your website.",

),

"desc" => array(

0 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

1 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


2 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


3 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


4 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

),

);
update_option('cfaq', $cfaq);	


if( isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'],array("escort")) ){

$badges = array('icon' => array('0' => 'fa fa-fire-alt','1' => 'fa fa-horse-head','2' => 'fa fa-ghost','3' => 'fa fa-star-exclamation',),'name' => array('0' => 'Your own text here!','1' => 'Make your own badges in the admin area.','2' => 'Change text, icon and color to match your website.','3' => 'Have fun with badges.','4' => '',),'color' => array('0' => '','1' => '','2' => '','3' => '',),'key' => array('0' => '1','1' => '2','2' => '3','3' => '4',),);
		
update_option("ppt_awards", $badges);

}

	  $badges = array('icon' => array('0' => 'fa fa-star','1' => 'fa fa-check','2' => 'fa fa-grin-stars','3' => 'fa fa-hat-santa',),'color' => array('0' => '#FFC300','1' => '#2BA346','2' => '#2266C6','3' => '#CF2121',),'txtcolor' => array('0' => '#000000','1' => '#FBFBFB','2' => '#FEFEFE','3' => '#F9F9F9',),'name' => array('0' => 'Gold','1' => 'Verified','2' => 'Awesome','3' => '','4' => '',),'search' => array('0' => '1','1' => '0','2' => '0','3' => '0',),'desc' => array('0' => 'Gold User Listing','1' => '','2' => 'Create your own badges in the admin area!','3' => 'Set your own icons, text and colors!',),'key' => array('0' => '1','1' => '2','2' => '3','3' => '4',),);
		
		update_option("ppt_badges", $badges);


switch($_POST['admin_values']['template']){
	
	case "cashback":
	case "coupon":
	case "micro":
 
	case "project":
	case "compare": {
	
	$dafelds = array();
	update_option("cfields", $dafelds);	
	
	} break;
	
		  case "jobs": {
	   
			$dafelds = array('name' => array('0' => 'Job Type','1' => 'Experience','2' => 'Company Details','3' => 'Company Name','4' => 'Company Website',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'dbkey' => array('0' => 'custom-1','1' => 'custom-2','2' => 'custom-4','3' => 'company','4' => 'url',),'cat' => array(),'fieldtype' => array('0' => 'taxonomy','1' => 'taxonomy','2' => 'title','3' => 'input','4' => 'input',),'taxonomy' => array('0' => 'jobtype','1' => 'experience','2' => 'category','3' => 'category','4' => 'category',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),);

		
		update_option("cfields", $dafelds);
	   
	   } break;
	
	
		  case "learning": {
	   
	   $dafelds = array('name' => array('0' => 'Price','1' => 'Level','2' => 'Language','3' => 'Course Requirements',),'help' => array('0' => '','1' => '','2' => '','3' => '',),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'textarea',),'dbkey' => array('0' => 'price','1' => 'level','2' => 'language','3' => 'req',),'values' => array('0' => '','1' => '','2' => '','3' => '',),'taxonomy' => array('0' => 'category','1' => 'level','2' => 'language','3' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no',),);
		
		update_option("cfields", $dafelds);
	   
	   } break;
	
	
	  case "cardealer": {
	   
	   $dafelds = array('name' => array('0' => 'Year','1' => 'Condition','2' => 'Body','3' => 'Fuel','4' => 'Transmission','5' => 'Exterior','6' => 'Interior','7' => 'Doors','8' => 'Engine','9' => 'Seller','10' => 'Miles','11' => 'Drive','12' => 'Owners','13' => 'Seller',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'taxonomy','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'taxonomy','9' => 'taxonomy','10' => 'input','11' => 'taxonomy','12' => 'taxonomy','13' => 'taxonomy',),'dbkey' => array('0' => 'year','1' => 'key3','2' => 'key4','3' => 'key5','4' => 'key13','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'key9','9' => 'key10','10' => 'miles','11' => 'key12','12' => 'key1214','13' => 'key72764',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'body','3' => 'fuel','4' => 'transmission','5' => 'exterior','6' => 'interior','7' => 'doors','8' => 'engine','9' => 'owners','10' => 'category','11' => 'drive','12' => 'owners','13' => 'seller',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no',),);
	   
	   update_option("cfields", $dafelds);
	   
	   } break;
	
	
	case "software": {
	
	$dafelds =  array('name' => array('0' => 'Original Price','1' => 'Version','2' => 'Downloads','3' => 'Brand','4' => 'Operating System','5' => 'Last Updated',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'dbkey' => array('0' => 'price','1' => 'version','2' => 'download_count','3' => 'custom-5','4' => 'system','5' => 'updated',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'input','2' => 'input','3' => 'taxonomy','4' => 'taxonomy','5' => 'date',),'taxonomy' => array('0' => 'category','1' => 'category','2' => 'category','3' => 'store','4' => 'system','5' => 'category',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),);;
		
		update_option("cfields", $dafelds);
	
	
	} break;
	
	case "realestate": {
	
	   $dafelds = array('name' => array('0' => 'Asking Price','1' => 'Property Type','2' => 'Beds','3' => 'Baths','4' => 'Property Size (sqft)','5' => 'Phone Number','6' => 'Website','7' => 'My Custom Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'input','5' => 'input','6' => 'input','7' => 'input',),'dbkey' => array('0' => 'price','1' => 'key75170','2' => 'key751701','3' => 'key751702','4' => 'size','5' => 'phone','6' => 'website','7' => 'customfield',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'taxonomy' => array('0' => 'category','1' => 'type','2' => 'beds','3' => 'baths','4' => 'category','5' => 'category','6' => 'category','7' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no',),'cat' => array('0' => 'Array',),);
	   
	update_option("cfields", $dafelds);	
	
	} break;
	
	
	case "escort": {
	
$dafelds = array('name' => array('0' => 'Ethnicity','1' => 'Sexuality','2' => 'Gender','3' => 'Location','4' => 'What do I look like?','5' => 'My Eyes','6' => 'My Hair','7' => 'My Body','8' => 'My Height','9' => 'Dress Size','10' => 'Bust size','11' => 'My Habbits','12' => 'Drinking','13' => 'Smoking','14' => 'WhatsApp Number',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'fieldtype' => array('0' => 'taxonomy','1' => 'taxonomy','2' => 'taxonomy','3' => 'input','4' => 'title','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'input','9' => 'input','10' => 'input','11' => 'title','12' => 'taxonomy','13' => 'taxonomy','14' => 'input',),'dbkey' => array('0' => 'key2','1' => 'key3','2' => 'key4','3' => 'map-city','4' => 'key5','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'height','9' => 'dresssize','10' => 'bustsize','11' => 'key9','12' => 'key10','13' => 'key11','14' => 'whatsapp',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'taxonomy' => array('0' => 'dathnicity','1' => 'dasexuality','2' => 'dagender','3' => 'category','4' => 'category','5' => 'daeyes','6' => 'dahair','7' => 'dabody','8' => 'category','9' => 'category','10' => 'category','11' => 'category','12' => 'dadrink','13' => 'dasmoke','14' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no','14' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no','14' => 'yes',),'cat' => array('0' => 'Array',),);

update_option("cfields", $dafelds);	

	} break;
	
	case "dating": {


$dafelds = array('name' => array('0' => 'Age','1' => 'Ethnicity','2' => 'Sexuality','3' => 'Gender','4' => 'What do I look like?','5' => 'My Eyes','6' => 'My Hair','7' => 'My Body','8' => 'Hair Lenght','9' => 'My Habbits','10' => 'Drinking','11' => 'Smoking',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'title','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'taxonomy','9' => 'title','10' => 'taxonomy','11' => 'taxonomy',),'dbkey' => array('0' => 'daage','1' => 'key2','2' => 'key3','3' => 'key4','4' => 'key5','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'key439','9' => 'key9','10' => 'key10','11' => 'key11',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '',),'taxonomy' => array('0' => 'category','1' => 'dathnicity','2' => 'dasexuality','3' => 'dagender','4' => 'category','5' => 'daeyes','6' => 'dahair','7' => 'dabody','8' => 'dahairlength','9' => 'category','10' => 'dadrink','11' => 'dasmoke',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no',),);

update_option("cfields", $dafelds);	
	
	} break;
	case "auction": {

  $dafelds = array('name' => array('0' => 'Refunds','1' => 'Condition','2' => '7 Day Refunds','3' => 'Brand','4' => 'Brand','5' => 'Model Number','6' => 'Color','7' => 'Size',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'fieldtype' => array('0' => 'title','1' => 'taxonomy','2' => 'taxonomy','3' => 'title','4' => 'taxonomy','5' => 'input','6' => 'taxonomy','7' => 'taxonomy',),'dbkey' => array('0' => 'key1','1' => 'key2','2' => 'key94643','3' => 'key46827','4' => 'key90394','5' => 'modelnum','6' => 'key5411','7' => 'key91614',),'values' => array('0' => '','1' => '','2' => 'Yes
No','3' => '','4' => '','5' => '','6' => '','7' => 'Yes
No',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'refunds','3' => 'category','4' => 'brand','5' => 'category','6' => 'color','7' => 'size',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no',),);

update_option("cfields", $dafelds);	
	
	} break;
	case "directory": {
	
$dafelds =  array('name' => array('0' => 'Phone Number','1' => 'Website','2' => 'Payment Accepted','3' => 'Wifi Access','4' => 'Pets','5' => 'Parking',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'input','2' => 'taxonomy','3' => 'taxonomy','4' => 'taxonomy','5' => 'taxonomy',),'dbkey' => array('0' => 'phone','1' => 'website','2' => 'key1','3' => 'key2','4' => 'key3','5' => 'key4',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'taxonomy' => array('0' => 'category','1' => 'category','2' => 'payment','3' => 'wifi','4' => 'pets','5' => 'parking',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),);

update_option("cfields", $dafelds);	
	
	} break;
	case "classifieds": {
	
$dafelds = array('name' => array('0' => 'Refunds','1' => 'Condition','2' => '7 Day Refunds','3' => 'Brand','4' => 'Brand','5' => 'Model Number','6' => 'Color','7' => 'Size','8' => 'Example Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '',),'fieldtype' => array('0' => 'title','1' => 'taxonomy','2' => 'taxonomy','3' => 'title','4' => 'taxonomy','5' => 'input','6' => 'taxonomy','7' => 'taxonomy','8' => 'input',),'dbkey' => array('0' => 'key1','1' => 'key2','2' => 'key94643','3' => 'key46827','4' => 'key90394','5' => 'modelnum','6' => 'key5411','7' => 'key91614','8' => 'examplefield',),'values' => array('0' => '','1' => '','2' => 'Yes
No','3' => '','4' => '','5' => '','6' => '','7' => 'Yes
No','8' => '',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'refunds','3' => 'category','4' => 'brand','5' => 'category','6' => 'color','7' => 'size','8' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no',),'cat' => array('0' => 'Array',),);

update_option("cfields", $dafelds);

	} break;
	case "dealer": {
	
	   $dafelds = array('name' => array('2' => 'Year','3' => 'Condition','4' => 'Body','5' => 'Fuel','6' => 'Transmission','7' => 'Exterior','8' => 'Interior','9' => 'Doors','10' => 'Engine','11' => 'Seller','12' => 'Miles','13' => 'Drive','14' => 'Owners',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'fieldtype' => array('0' => 'taxonomy','1' => 'taxonomy','2' => 'input','3' => 'taxonomy','4' => 'taxonomy','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'taxonomy','9' => 'taxonomy','10' => 'taxonomy','11' => 'taxonomy','12' => 'input','13' => 'taxonomy','14' => 'taxonomy',),'dbkey' => array('0' => 'key1','1' => 'key2','2' => 'year','3' => 'key3','4' => 'key4','5' => 'key5','6' => 'key13','7' => 'key6','8' => 'key7','9' => 'key8','10' => 'key9','11' => 'key10','12' => 'miles','13' => 'key12','14' => 'key1214',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'taxonomy' => array('0' => 'make','1' => 'model','2' => 'category','3' => 'condition','4' => 'body','5' => 'fuel','6' => 'transmission','7' => 'exterior','8' => 'interior','9' => 'doors','10' => 'engine','11' => 'owners','12' => 'category','13' => 'drive','14' => 'owners',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no','14' => 'no',),);
	   
update_option("cfields", $dafelds);
	
	
	} break;
	
	case "photography": {
	
$dafelds = array('name' => array('0' => 'Camera','1' => 'Camera Model','2' => 'Orientation','3' => 'License Type','4' => 'Example Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'fieldtype' => array('0' => 'taxonomy','1' => 'input','2' => 'taxonomy','3' => 'taxonomy','4' => 'input',),'dbkey' => array('0' => 'cameratype','1' => ' camera_model','2' => 'key62809','3' => 'licensetype','4' => 'examplefield',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'taxonomy' => array('0' => 'cameratype','1' => 'category','2' => 'orientation','3' => 'license','4' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),);
		
		update_option("cfields", $dafelds);
		
	} break;

}


 



	
	
 // WEBSITE TESTIMONIALS
$cfaq = array(

"name" => array(

0 => "John Doe",
1 => "Jane Doe",
2 => "Mark Brown", 
),

"name_title" => array(

0 => "CEO/ Manager",
1 => "General Manager",
3 => "Manager", 

),

"logo_url" => array(

0 => get_template_directory_uri()."/framework/img/user.png",
1 => get_template_directory_uri()."/framework/img/user.png",
2 => get_template_directory_uri()."/framework/img/user.png",
 
),

"date" => array(

0 => " " . date('Y-m-d H'),
1 => " " . date('Y-m-d H'),
2 => " " . date('Y-m-d H'),
 
),

"rating" => array(

0 => 5,
1 => 5,
 
),

"desc" => array(

0 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

1 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
 
2 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

),

);

update_option('ctestimonial', $cfaq);  
	
	
	
// INSTALL 5 SAMPLE BLOG POSTS

$titles = array(
"The 7 Secrets You Will Never Know About Business.",
"Seven Top Reasons Why You Face Obstacles In Learning Business.",
"Why Is Business So Famous?",
"This Story Behind Business Will Haunt You Forever!",
"Seven Places That You Can Find Business.",
"Think You're An Expert In Business? Take This Quiz Now To Find Out.",
/*
"7 Ways To Tell You're Suffering From An Obession With Business.",
"5 Questions To Ask At Business.",
"The Story Of Business Has Just Gone Viral!",
"7 Tips To Avoid Failure In Business.",
"Seven Ways Business Can Improve Your Business.",
"Top Five Common Prejudices About Business.",
"Seven Unbelievable Facts About Business.",
"You Will Never Believe These Bizarre Truth Behind Business.",
"Seven Secrets About Business That Has Never Been Revealed For The Past 50 Years.",
"Here's What Industry Insiders Say About Business.",
"The Rank Of Business In Consumer's Market.",
"Ten Useful Tips From Experts In Business.",
"Understand Business Before You Regret.",
*/
);
 

$catsid = array();
foreach(array("Consulting","Business","Corporate","Finance","Economy","WordPress") as $cat){

		$tax = "category";
		if ( term_exists( $cat, $tax ) ){
				$term = get_term_by('slug', $cat, $tax );		 
				$nparent  = $term->term_id;				
		}else{
			
			$tax_id = wp_insert_term( $cat, $tax, array('cat_name' => $cat  ));			 
			if(!is_object($tax_id) && isset($tax_id['term_id'])){				 
				$nparent = $tax_id['term_id'];				
			}else{			 
				$nparent = $tax_id->term_id;
			}	 
				 
	} 
 
	$catsid[$nparent] = $nparent;
	
}	

$i=1;
foreach($titles as $title){
 	
	$fount_post = post_exists( $title ,'','','');
	if(!$fount_post){
	
		$my_post = array();
		$my_post['post_title'] 		= $title;
		$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
	<p>Accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>";
		$my_post['post_type'] 		= "post";
		$my_post['post_status'] 	= "publish";
		$my_post['post_category'] 	= "";
		$my_post['tags_input'] 		= "";
		$POSTID 					= wp_insert_post( $my_post );
	 
		add_post_meta($POSTID, "image", DEMO_IMG_PATH."blog/blog".$i.".jpg");
		
		// UPDATE CAT LIST 
		if(isset($catsid) && is_array($catsid) ){
			
			$rndid = rand(0,5);
			if(isset($catsid[$rndid])){
			wp_set_post_categories( $POSTID, $catsid[$rndid] );
			}
		}
	
	}
 	$i++;
} 	

  
// CURRENY PARTS
$GLOBALS['theme_defaults']['currency']['symbol'] 	= "$";
$GLOBALS['theme_defaults']['currency']['code'] 		= "USD";

// PAGE ASSIGN
$GLOBALS['theme_defaults']['pageassign']['homepage'] = ""; 


/***********************************************************************************/

if( isset($_POST['admin_values']['template']) && !in_array($_POST['admin_values']['template'],array("dating","escort")) ){
 
$GLOBALS['theme_defaults']['lst']['websitepackages'] = 1;

$GLOBALS['theme_defaults']['pak0_name']  = "Free Package";
$GLOBALS['theme_defaults']['pak1_name']  = "Silver Package";
$GLOBALS['theme_defaults']['pak2_name']  = "Gold Package";

$GLOBALS['theme_defaults']['pak0_price']  = "0";
$GLOBALS['theme_defaults']['pak1_price']  = "20";
$GLOBALS['theme_defaults']['pak2_price']  = "50";

$GLOBALS['theme_defaults']['pak0_desc']  = "Free for a 2 day ad display.";
$GLOBALS['theme_defaults']['pak1_desc']  = "$20 for 1 month ad display.";
$GLOBALS['theme_defaults']['pak2_desc']  = "$50 for 6 months ad display.";

$GLOBALS['theme_defaults']['pak0_duration']  = "2";
$GLOBALS['theme_defaults']['pak1_duration']  = "30";
$GLOBALS['theme_defaults']['pak2_duration']  = "180";

$GLOBALS['theme_defaults']['pak0_icon']  = "fa fa-star";
$GLOBALS['theme_defaults']['pak1_icon']  = "fa fa-crown";
$GLOBALS['theme_defaults']['pak2_icon']  = "fa fa-flame";

$GLOBALS['theme_defaults']['pak0_enable']  = "1";
$GLOBALS['theme_defaults']['pak1_enable']  = "1";
$GLOBALS['theme_defaults']['pak2_enable']  = "1";  

$GLOBALS['theme_defaults']['pak0_highlight']  = "0";
$GLOBALS['theme_defaults']['pak1_highlight']  = "1";
$GLOBALS['theme_defaults']['pak2_highlight']  = "0";  

 
}


	
/***********************************************************************************/

 
$nameLink = array();
$taxdata = array();
$randomarray = array();

// EXTRA FOR TEMPLATES
switch($_POST['admin_values']['template']){
 
			case "learning": {
			
				$taxdata = array(	
								
						1 => array(						
							"name" => "listing",							
								"data" => array( 
								
								"Data Scienece",
								"Business",
								"Computer Science",
								"Personal Development",
								"Information Technology",
								"Language Learning",
								"Health",
								"Math and Logic",
								"Social Science",
								"Physucal Learning",
								"Arts and Crafts", 
								),
							),
							 
							2 => array(		
							"name" => "features",		
							"data" => array(
								"Gratitude",
								"Happiness",
								"Meditation",						 
								"Algorithms",
								"Grammar",
								"Speech",
								"Writing",
								 																
								),
							),
							
							3 => array(						
							"name" => "level",							
							"data" => array("All Levels", "Beginner","Intermediate","Advanced" ),
							),
							
							
							4 => array(						
							"name" => "language",							
							"data" => array("English", "Mandarin Chinese","Hindi","Spanish","French","Arabic","Russian","German","Bengali" ),
							), 

				);
						
			} break;
			case "auction": {
			
				$taxdata = array(	
								
						1 => array(						
							"name" => "listing",							
								"data" => array(
							
								"Appliances" => array ('General Appliances', 'Kitchen', 'Other'),
								"Business" => array ('Accounting','Aerospace and Defense','Agriculture and Forestry'),
								"Computers" => array ('Laptops','Desktops','Parts for sale'),
								"Games" => array ('xbox','Pc &amp; Mac','Playstation'),
								"Health" => array ('Skincare','Medicine','Pills and Potions'),
								"Home" => array ('Furniture','Decorations','Misc'),
								"Kids and Teens" => array ('Clothes','Shoes','Outdoors'),
								"Arts" => array ('Paints','Crft Items','Misc'),
								"Books" => array ('Kindle Books','Magazines','Textbooks'),
								"Sports" => array ('Outdoor','Indoor','Misc'),
								"Electronics" => array ('Dvd Players','TVs','Mics'),
								"Clothing" => array ('Clothing','Jewelry','Accessories'),
								"Freebies" => array ('Coupons','VIP Cards', 'Other'),
								"Video Games" => array ('Xbox','Nintendo','Other'),
								"Pets" => array ('Pets for Sale','Equipment &amp; Accessories','Other'),
								"Community" => array ('Artists &amp; Theatres','Fitness &amp; Health','Other'),
							
							),
							
						),
						
						2 => array(							
							"name" => "condition",							
							"data" => array("New","Used"),						
						),
						
						3 => array(		
							"name" => "size",		
							"data" => array("XL","L","M","2XL","S","3XL","XS","4XL"),	
						),	
						 	
						4 => array(		
							"name" => "color",		
							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),	
						),	
						
						5 => array(		
							"name" => "brand",		
							"data" => array("Sony","Sennheiser","Bose","Samsung"),	
						),
						
						6 => array(		
							"name" => "refunds",		
							"data" => array("Yes","No"),	
						),
						
						7 => array(		
							"name" => "features",		
							"data" => array(
								"Almost New",
								"Unwanted Gift",
								"Original Packaging",
								"Includes Reciept",
								"Like Brand New",
								"Latest Model",
								"Half Orginal Price",
								"Limited Edition",																	
							),
						),
						
				);
			
			} break;
			
			case "exchange": {
			
				$taxdata = array(					
						1 => array(						
							"name" => "listing",							
							"data" => array(
								"English", "Chinese (Mandarin)", "French","Spanish","Portuguese","German", "Japanese", "Korean", "Arabic", "Hindi", "Italian", "Russian"
							),
						),
				);
				
			} break;

			case "escort": {
			
				$taxdata = array(					
						1 => array(						
							"name" => "listing",							
							"data" => array("Non Asian Girls","Asian Girls","Sensual Massage","Blonde Escorts","Busty Escorts","Mature Escorts","Young Escorts","Cougar Escorts","MILF Escorts","Red hair Escorts","Black hair Escorts","Brunette Escorts","Slim EscortsTall Escorts","BBW Escorts","Curvy Escorts","Voluptuous Escorts","Petite Escorts","Touring Escorts","Tattooed Escorts","No Tattoo Escorts","Submissive Escorts","Shaved Escorts","Natural Bush Escorts","Non Smoking Escorts","Enhanced Breasts Escorts","Natural Breasts Escorts","Fitness Escorts","Massage / Erotic Relaxation Escorts","Photos Verified Escorts","Fly Me To You Escorts","Doubles Profiles"),
						),
						2 => array(							
							"name" => "dagender",							
							"data" => array("Female Escort","Male Escort"),							
						), 
						
						3 => array(							
							"name" => "dasexuality",							
							"data" => array("Straight","Gay","Lesbian","Bisexual","Other"),						
						),
						
						4 => array(							
							"name" => "dathnicity",							
							"data" => array("African","American","Arab","Asian","Caucasian","Hispanic","Indian", "Mixed", "Native", "Other"),						
						),
						
						5 => array(							
							"name" => "daeyes",							
							"data" => array("Amber","Brown","Green","Blue","Gray","Hazel","Other"),						
						),
						
						6 => array(							
							"name" => "dahair",							
							"data" => array("Blond","Brown","Red","Black","Gray","Other"),						
						),
						
						7 => array(							
							"name" => "dabody",							
							"data" => array("Slim","Average","A little plump","Big and lovely","Other"),						
						),
						
						8 => array(							
							"name" => "dasmoke",							
							"data" => array("Never","Rarely","Quit","Socially","Often","Very often"),						
						),
						
						9 => array(							
							"name" => "dadrink",							
							"data" => array("Never","Rarely","Quit","Socially","Often","Very often"),						
						),
						10 => array(							
							"name" => "dastarsign",							
							"data" => array("Aries","Taurus","Gemini","Cancer","Leo","Virgo","Libra","Scorpio","Sagittarius","Capricorn","Aquarius","Pisces"),						
						), 
						
						11 => array(							
							"name" => "features",							
							"data" => array(
								"sensual massage only",
								"Affectionate cuddling",
								"Affectionate kissing",
								"Sexy lingerie",
								"Light bondage",
								"Dirty talk",
								"Costumes",
								"Strip tease",
								"body slide",
								"Blow job",
								"Balls licking",
								"Cum in mouth",
								"Cum on body",
								"Deep French kissing",
								"Double penetration",
								"Disabled clients",
								"Doggy style",
								"Girlfriend experience",
								"Happy ending",
								"Massage",
								"Overnight stays",
								"Passionate kissing"
							),
					),
					
					12 => array(							
							"name" => "age",							
							"data" => array("18+","30+","40+","50+"),	
							
						),
					
					
					14 => array(		
							"name" => "store",		
							"data" => array(
								"Agency Name 1",
								"Agency Name 2",
								"Agency Name 3",	
								"Agency Name 4",	
								"Agency Name 5",
								"Agency Name 6",
								"Agency Name 7",
								"Agency Name 8",
								"Agency Name 9",
								"Agency Name 10",
								"Agency Name 11",
								"Agency Name 12",
								"Agency Name 13",
								"Agency Name 14",
								"Agency Name 15", 
							), 
													
						),
						
				);
				 	
			} break;
						
			
			case "dating": {
			
				$taxdata = array(					
						1 => array(						
							"name" => "listing",							
							"data" => array("Aries","Taurus","Gemini","Cancer","Leo","Virgo","Libra","Scorpio","Sagittarius","Capricorn","Aquarius","Pisces"),
						),
						2 => array(							
							"name" => "dagender",							
							"data" => array("Male","Female"),	 //,"Trans Man","Trans Woman","Transsexual","Non-binary"					
						), 
						
						3 => array(							
							"name" => "dasexuality",							
							"data" => array("Straight","Gay","Lesbian","Bisexual","Other"),						
						),
						
						4 => array(							
							"name" => "dathnicity",							
							"data" => array("African","American","Arab","Asian","Caucasian","Hispanic","Indian", "Mixed", "Native", "Other"),						
						),
						
						5 => array(							
							"name" => "daeyes",							
							"data" => array("Amber","Brown","Green","Blue","Gray","Hazel","Other"),						
						),
						
						6 => array(							
							"name" => "dahair",							
							"data" => array("Blond","Brown","Red","Black","Gray","Other"),						
						),
						
						7 => array(							
							"name" => "dabody",							
							"data" => array("Slim","Average","A little plump","Big and lovely","Other"),						
						),
						
						8 => array(							
							"name" => "dasmoke",							
							"data" => array("Never","Rarely","Quit","Socially","Often","Very often"),						
						),
						
						9 => array(							
							"name" => "dadrink",							
							"data" => array("Never","Rarely","Quit","Socially","Often","Very often"),						
						),
						
						10 => array(							
							"name" => "dahairlength",							
							"data" => array("Short","Medium","Lond","Very Long","Shaved Head","Bald"),						
						),					 
						
						12 => array(							
							"name" => "age",							
							"data" => array("18+","30+","40+","50+"),						
						),
						
						11 => array(							
							"name" => "features",							
							"data" => array(
								"Writing/Blogging",
								"Cooking",
								"Refinishing Furniture",
								"Flea Market Shopping",
								"Catering",
								"Making Music",
								"Tapping Maple Trees",
								"Bartending",
								"Wine Making",
								"Playing The Stock Market",							
								"Beekeeping",							
								"Programming",
								"Proofreading And Editing",
								"Coding",
								"Tattooing",
								"Performing Stand Up Comedy",
								"Drive Others Around",
								"Graphic Design",
								"Making T-Shirts",
								"Becoming A Fitness Instructor",
								"Starting A YouTube Channel",
								"Being A Handyman",
								"Decorating Homes",
								"Reviewing Things",
								"Pet Sitting",
								"Flipping Items"
							),
							 
							
							
													
						),
						
				);
				 	
			} break;
			
			case "micro": {
			
				$taxdata = array(					

						1 => array(						
							"name" => "listing",							
								"data" => array(
							
								"Graphics & Design" => array (
								
'Logo Design',
'Brand Style Guides',
'Game Art',
'Graphics for Streamers',
'Business Cards & Stationery',
'Illustration',
'Pattern Design',
'Packaging & Label Design',
'Brochure Design',
'Poster Design',
'Signage Design',
'Flyer Design',
'Book Design',
'Album Cover Design',
'Podcast Cover Art',
'Website Design',
'App Design',
'UX Design',
'Landing Page Design',
'Social Media Design',
'Email Design',
'Resume Design',
'Storyboards',
'Car Wraps',
'Menu Design',
'Postcard Design',
'Vector Tracing',
'Twitch Store',
'Other'
								
								),
								"Digital Marketing" => array (
								
'Content Marketing',
'Public Relations',
'Video Marketing',
'Email Marketing',
'Text Message Marketing',
'Affiliate Marketing',
								
								),
								"Writing & Translation" => array (
								
'Articles & Blog Posts',
'Proofreading & Editing',
'Website Content',
'UX Writing',
'eBook Writing',
'Resume Writing',
'Cover Letters',
'LinkedIn Profiles'
								
								),
								"Video & Animation" => array (
								

'Animated Explainers',
'Video Editing',
'Short Video Ads',
'Character Animation',
'Animated GIFs',
'Logo Animation',
'Intros & Outros',
'Lyric & Music Videos',
'Product Photography',
'Local Photography',
'Drone Videography',
'Other',

								
								),
								"Music & Audio" => array (
								

'Voice Over',
'Mixing & Mastering',
'Producers & Composers',
'Singers & Vocalists',
'Session Musicians',
'Online Music Lessons',
'Songwriters',
'Beat Making',
'Podcast Editing',
'Other'
								
								),
								"Programming & Tech" => array (
								
'WordPress',
'Website Builders',
'E-Commerce Development',
'Game Development',
'Development for Streamers',
'Mobile Apps',
'Web Programming',
'Desktop Applications',
'Online Coding Lessons',
'Chatbots',
'Other'								
								),
								"Data" => array (
								
'Databases',
'Data Analytics',
'Data Processing',
'Data Visualization',
'Data Engineering',
'Data Science',
'Data Entry',
'Other'
								
								),
								"Business" => array (
								
'Virtual Assistant',
'E-Commerce Management',
'Market Research',
'Business Plans',
'Legal Consulting',
'Financial Consulting',
'Sales',
'Customer Care',
'Business Consulting',
'HR Consulting',
'Other'					
								),
								"Lifestyle" => array (
								
'Online Tutoring',
'Gaming',
'Astrology & Psychics',
'Modeling & Acting',
'Fitness Lessons',
'Dance Lessons',
'Life Coaching',
'Other',
								
								),
							 
							
							),
							
						),
						2 => array(							
							"name" => "delivery",							
							"data" => array("Express 24H","Up to 3 days","Up to 5 days","Up to 10 days","Up to 1 month"),						
						),
						
						3 => array(
							
							"name" => "features",
							
							"data" => array("Hard Worker","Team Player","Creative","Organized","Flexibile","Emotional Intelligent","Punctual", "Reliable", "Caring","Good Listener"),
						
						),	
 
				);
				 	
			} break;
			
			
		case "directory": {				 
				$taxdata = array(
					
						1 => array(		
							"name" => "listing",
									
							"data" => 		array(
							
							"Example Category 1" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	"Example Category 2" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	"Example Category 3" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	"Example Category 4" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	"Example Category 5" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	"Example Category 6" => array("Sub Category 1", "Sub Category 2", "Sub Category 3", "Sub Category 4", "Sub Category 5"),
						 	   
							), 						
 
						),	
						 
						2 => array(		
							"name" => "features",		
							"data" => array(
							
								"Car Park",
								"Pets Welcome",
								"Modern Fittings",
								"Air Conditioning", 
								"Stunning Views", 
								"Fitness Center/Gym",
								"Swimming Pool", 
								"Wifi Access", 
								"Nearby Shops &amp; Restaurants",
								"Bike Storage",
								"Large Public Spaces",
								"Meeting Rooms",
								"24/7 Building Security Staff", 
								"Nearby Public Transport",
								"Good Mobile Coverage",										
							),
						),
						
						3 => array(							
							"name" => "parking",							
							"data" => array("Free Parking", "Paid Parking", "Roadside Parking","No Parking"),					
						),
						
						4 => array(							
							"name" => "wifi",							
							"data" => array("Free Wifi","Paid Wifi","No Wifi"),					
						),
						
						5 => array(							
							"name" => "payment",							
							"data" => array("All Payments","Credit Cards Only","Cash Only"),					
						),
						
						6 => array(							
							"name" => "pets",							
							"data" => array("Pet Friendly","No Pets Allowed"),					
						), 
						 
						 
						 
						
						
						
					);	
					
								
			} break;
			
			
			case "cardealer": {
					$taxdata = array(
					  
						3 => array(
							
							"name" => "condition",
							
							"data" => array("New","Used","Certified"),
						
						),
						
						4 => array(
							
							"name" => "body",
							
							"data" => array("Convertible", "Coupe","Hatchback", "Sedan", "SUV / Crossover", "Truck", "Van / Minivan", "Wagon"),
						
						),
						
						5 => array(
							
							"name" => "fuel",
							
							"data" => array("Petrol", "Diesel", "Electric", "Gasoline", "Hybrid", "Plug-in Hybrid"),
						
						),	
						
						6 => array(
							
							"name" => "transmission",
							
							"data" => array("Automatic", "Manual"),
						
						),	
						
						7 => array(
							
							"name" => "exterior",
							


							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),
						
						),
						
						8 => array(
							
							"name" => "interior",
							
							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),
						
						),
							
						9 => array(
							
							"name" => "doors",
							
							"data" => array("Two Door", "Three Door", "Four Door", "Five Door"),
						
						), 
						
							
						10 => array(
							
							"name" => "seller",
							
							"data" => array("Dealer", "Private Seller"),
						
						), 	
						
						11 => array(
							
							"name" => "features",
							
							"data" => array("Android Auto","Apple CarPlay","Bluetooth, Hands-Free","Cruise Control","DVD Player","Navigation","Portable Audio Connection","Premium Audio","Satellite Radio","Steering Wheel Controls"),
						
						),	
						
						12 => array(
							
							"name" => "engine",
							
							"data" => array("1L","1.6L","3L","3.2L","6L","1.2L","2L"),
						
						),	
						
						13 => array(
							
							"name" => "drive",
							
							"data" => array("Left Hand Drive", "Right Hand Drive"),
						
						),	
						
						14 => array(
							
							"name" => "owners",
							
							"data" => array("0 Owners", "1 Owner","2 Owners","3 Owners","4 Owners","5 Owners","6+ Owners"),
						
						),	
						
					15 => array(							
							"name" => "listing",							
							"data" => array(
							
								"Make 1" => array ('Model 1', 'Model 2', 'Other'),
								"Make 2" => array ('Model 1', 'Model 2', 'Other'), 
							
							),						
						),
							
					
					);	
			} break;	
			case "classifieds": {
					$taxdata = array(				
						
					 
						1 => array(							
							"name" => "listing",							
							"data" => array(
							
								"Appliances" => array ('General Appliances', 'Kitchen', 'Other'),
								"Business" => array ('Accounting','Aerospace and Defense','Agriculture and Forestry'),
								"Computers" => array ('Laptops','Desktops','Parts for sale'),
								"Games" => array ('xbox','Pc &amp; Mac','Playstation'),
								"Health" => array ('Skincare','Medicine','Pills and Potions'),
								"Home" => array ('Furniture','Decorations','Misc'),
								"Kids and Teens" => array ('Clothes','Shoes','Outdoors'),
								"Arts" => array ('Paints','Crft Items','Misc'),
								"Books" => array ('Kindle Books','Magazines','Textbooks'),
								"Sports" => array ('Outdoor','Indoor','Misc'),
								"Electronics" => array ('Dvd Players','TVs','Mics'),
								"Clothing" => array ('Clothing','Jewelry','Accessories'),
								"Pets" => array ('Pets for Sale','Equipment &amp; Accessories','Other'),
								"Freebies" => array ('Coupons','VIP Cards', 'Other'),
								"Video Games" => array ('Xbox','Nintendo','Other'),
								"Community" => array ('Artists &amp; Theatres','Fitness &amp; Health','Other'),
							
							),						
						),
						
						
						
						2 => array(							
							"name" => "condition",							
							"data" => array("New","Used","Certified"),						
						),
						
						3 => array(		
							"name" => "size",		
							"data" => array("XL","L","M","2XL","S","3XL","XS","4XL"),	
						),	
						 	
						4 => array(		
							"name" => "color",		
							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),	
						),	
						
						5 => array(		
							"name" => "brand",		
							"data" => array("Sony","Sennheiser","Bose","Samsung"),	
						),
						
						6 => array(		
							"name" => "refunds",		
							"data" => array("Yes","No"),	
						),
						
						7 => array(		
							"name" => "features",		
							"data" => array(
								"Almost New",
								"Unwanted Gift",
								"Original Packaging",
								"Includes Reciept",
								"Like Brand New",
								"Latest Model",
								"Half Orginal Price",
								"Limited Edition",																	
							),
						), 

					
					);
				 	
			} break;
			
			 
			
			case "project": {
			 
			
				$taxdata = array(
						
						1 => array(		
							"name" => "listing",	
								
							"data" => array(
								"Accounting & Consulting",
								"Admin Support",
								"Customer Service",
								"Data Science & Analytics",
								"Design & Creative",
								"Engineering & Architecture",
								"IT & Networking",
								"Legal",
								"Sales & Marketing",
								"Translation",
								"Web, Mobile & Software Dev",
								"Writing"
							),	
						),	 
						
						2 => array(		
							"name" => "experience",		
							"data" => array( "No Experience Required", "High school diploma or equivalent", "Some college, no degree",  "Postsecondary non-degree award", "Associate's degree", "Bachelor's degree", "Master's degree","Doctoral or professional degree" ),	
						),
						 
				);	
				 		
			} break;
			
			case "jobs": {
				$taxdata = array(
				
				
						1 => array(		
							"name" => "listing",		
							"data" => array("Accounting" ,"General Business","Admin & Clerical"	 ,"General Labor"	 ,"Pharmaceutical","Automotive"	 ,"Government","Banking"	 ,"Grocery"	 ,"Purchasing" ,"Procurement"
,"Biotech"	 ,"Health Care"	 ,"QA" ,"Quality Control","Broadcast" ,"Journalism"	 ,"Hotel" ,"Hospitality"	 ,"Real Estate"	 ,"Human Resources"	 ,"Research","Construction"	   ,"Restaurant" ,"Food Service","Consultant","Customer Service"	 ,"Insurance"	 ,"Sales","Design","Inventory","Science","Distribution" ,"Shipping"	,"Legal","Skilled Labor" ,"Trades","Education" ,"Teachin"	 ,"Legal Admin"	 ,"Strategy" ,"Planning","Engineering"	 ,"Management"	 ,"Supply Chain","Entry Level" ,"New Grad"	 ,"Manufacturing","Executive"	 ,"Marketing"	 ,"Training","Facilities"	 ,"Media" ,"Journalism" ,"Newspaper","Transportation","Finance"	 ,"Nonprofit" ,"Social Services","Warehouse"),	
						),	 
						
					
						2 => array(		
							"name" => "jobtype",		
							"data" => array("Part-time", "Contract" , "Internship", "Temporary", "Full-time"),	
						),	
						
						3 => array(		
							"name" => "experience",		
							"data" => array( "No Experience Required", "High school diploma or equivalent", "Some college, no degree",  "Postsecondary non-degree award", "Associate's degree", "Bachelor's degree", "Master's degree","Doctoral or professional degree" ),	
						),
						
						4 => array(		
							"name" => "postedby",		
							"data" => array( "Agency", "Employer", "REED"),	
						),
						 
						5 => array(		
							"name" => "remote",		
							"data" => array("Remote","Temporarily remote (COVID-19)","Other"),	
						), 
						
						6 => array(		
							"name" => "store",		
							"data" => array(
								"Company Name 1",
								"Company Name 2",
								"Company Name 3",	
								"Company Name 4",	
								"Company Name 5",
								"Company Name 6",
								"Company Name 7",
								"Company Name 8",
								"Company Name 9",
								"Company Name 10",
								"Company Name 11",
								"Company Name 12",
								"Company Name 13",
								"Company Name 14",
								"Company Name 15", 
							), 
													
						),
						
				);	
				 		
			} break;			
			case "coupon": {
			 
			
			$taxdata = array(
					
						1 => array(		
							"name" => "listing",		
							"data" => 
							
							array("Animals & Pet Supplies","Apparel & Accessories","Arts & Entertainment","Baby & Toddler","Business & Industrial","Cameras & Optics","Coupons","Credit Card","Deals","Electronics","Fashion","Food, Beverages & Tobacco","Furniture","Gift","Hardware","Health & Beauty","Home & Garden","Internet Service","Luggage & Bags","Media","Mobile Apps","Money & Banking","Office Supplies","Printable","Religious & Ceremonial","Restaurant","Security","Service","Software","Sporting Goods","Subscription","Toys & Games","Travel","Vehicles & Parts"),
						),	 
						
						2 => array(		
							"name" => "ctype",		
							"data" => array("Coupon","Offer","Printable Coupon"),	
						),		
						  
						3 => array(		
							"name" => "store",		
							"data" => array(
								"Store Name 1",
								"Store Name 2",
								"Store Name 3",	
								"Store Name 4",	
								"Store Name 5",
								"Store Name 6",	
								"Store Name 7",	
								"Store Name 8",		
								"Store Name 9",	
								"Store Name 10",				
							),
						), 
					);
					
					if(defined('WLT_DEMOMODE')){
					unset($taxdata[3]);
					}
					 
			} break;
			
			
case "cashback": {
			 
			
			$taxdata = array(
					
						1 => array(		
							"name" => "listing",		
							"data" => 
							
							array("Animals & Pet Supplies","Apparel & Accessories","Arts & Entertainment","Baby & Toddler","Business & Industrial","Cameras & Optics","Coupons","Credit Card","Deals","Electronics","Fashion","Food, Beverages & Tobacco","Furniture","Gift","Hardware","Health & Beauty","Home & Garden","Internet Service","Luggage & Bags","Media","Mobile Apps","Money & Banking","Office Supplies","Printable","Religious & Ceremonial","Restaurant","Security","Service","Software","Sporting Goods","Subscription","Toys & Games","Travel","Vehicles & Parts"),
						),	 
						 		
						2 => array(		
							"name" => "store",		
							"data" => array(
								"Store Name 1",
								"Store Name 2",
								"Store Name 3",	
								"Store Name 4",	
								"Store Name 5",
								"Store Name 6",	
								"Store Name 7",	
								"Store Name 8",		
								"Store Name 9",	
								"Store Name 10",				
							),
						), 
					);
					 
					 
			} break;
			
			
			case "photography": {
			
			
			$taxdata = array(
					
						1 => array(		
							"name" => "listing",		
							"data" => array("ABSTRACT","ANIMALS","ARCHITECTURE","BUSINESS","CELEBRATIONS","CITY","ELECTRONICS","HEALTH &amp; BEAUTY","AROUND THE HOUSE","LANDSCAPES","LIFESTYLE","MUSIC","NATURE","PEOPLE","SCIENCE","TRAVEL"),	
						),	 
						
						2 => array(		
							"name" => "orientation",		
							"data" => array("Landscape","Portrait"),	
						),		
						
						3 => array(							
							"name" => "features",							
							"data" => array("Canon Camera","Colorful","Landscape","Difficult Shot","Commercial Use","Fun Photo"),						
						),
						
						4 => array(							
							"name" => "license",							
							"data" => array("Commercial Usage","Creative Commons","Non-exclusive"),						
						),
						
						5 => array(							
							"name" => "cameratype",							
							"data" => array("Canon", "Nikon", "Pentax", "Sony", "Olympus", "Fujifilm", "GoPro", "Leica"),						
						),
						
						
					 
					);
			
				 
			} break;
			case "software":{
			
			$taxdata = array(
			
			
				1 => array(		
					"name" => "listing",		
					"data" => array(
							
								"Audio" => array("Audio Encoders/Decoders","Audio File Players","Audio File Recorders","CD Burners","CD Players","Multimedia Creation Tools","Music Composers","Rippers &amp; Converters","Other"),
								"Business" => array("Accounting &amp; Finance","Calculators &amp; Converters","Databases &amp; Tools","Helpdesk &amp; Remote PC","Inventory &amp; Barcoding","Investment Tools","Math &amp; Scientific Tools","Office Suites &amp; Tools","Other"),
								"Coms" => array("Chat &amp; Instant Messaging","E-Mail Clients","E-Mail List Management","Newsgroup Clients","Web/Video Cams","Pager Tools","Telephony","Other Comms Tools"),
								"Desktop" => array("Clocks &amp; Alarms","Cursors &amp; Fonts","Icons","Screen Savers","Themes &amp; Wallpaper","Other"),
								"Development" => array("Active X","Basic, VB, VB DotNet","C / C++ / C#","Compilers &amp; Interpreters","Components &amp; Libraries","Debugging","Delphi","Help Tools","Install &amp; Setup"),
								"Education" => array("Computer","Dictionaries","Geography","Kids","Languages","Mathematics","Reference Tools","Teaching &amp; Training Tools","Other"),
								"Games" => array("Action","Adventure &amp; Roleplay","Arcade","Board","Card","Casino &amp; Gambling","Kids","Online Gaming","Strategy &amp; War Games","Other"),
								"Graphic Apps" => array("Animation Tools","CAD","Converters &amp; Optimizers","Editors","Font Tools","Gallery &amp; Cataloging Tools","Icon Tools","Screen Capture","Other"),
								"Home &amp; Hobby" => array("Astrology/Biorhythms/Mystic","Astronomy","Cataloging","Food &amp; Drink","Genealogy","Health &amp; Nutrition","Personal Finance","Personal Interes","Other"),
								"Network" => array("Ad Blockers","Browser Tools","Browsers","Download Managers","File Sharing/Peer to Peer","FTP Clients","Network Monitoring","Remote Computing","Other"),
								"Security" => array("Access Control","Anti-Spam &amp; Anti-Spy Tools","Anti-Virus Tools","Covert Surveillance","Encryption Tools","Password Managers","Other"),
								"Servers" => array("Firewall &amp; Proxy Servers","FTP Servers","Mail Servers","News Servers","Telnet Servers","Web Servers","Other Server Applications"),
								"Utilities" => array("Automation Tools","Backup &amp; Restore","Benchmarking","Clipboard Tools","File &amp; Disk Management","File Compression","Launchers &amp; Task Managers","Printer","Other"),
								"Web Development" => array("ASP &amp; PHP","E-Commerce","Flash Tools","HTML Tools","Java &amp; JavaScript","Log Analysers","Site Administration","Wizards &amp; Components","XML/CSS Tools","Other"),
								"Other" => array(),
						),
					),
					
					2 => array(		
							"name" => "features",		
							"data" => array(
								"Easy to Install",
								"No Skills Required",
								"Original Packaging",
								"Download Version",
								"IOS App Included",
								"Lots of Features",
								"Half Orginal Price",
								"Limited Edition",																	
							),
						), 
						
						3 => array(		
							"name" => "system",		
							"data" => array(
								"Windows",
								"Apple MAC",
								"Mobile Device", 																
							),
						), 
						
						
						4 => array(		
							"name" => "store",		
							"data" => array(
								"Brand Name 1",
								"Brand Name 2",
								"Brand Name 3",	
								"Brand Name 4",	
								"Brand Name 5",
								"Brand Name 6",
								"Brand Name 7",
								"Brand Name 8",
								"Brand Name 9",
								"Brand Name 10",
								"Brand Name 11",
								"Brand Name 12",
								"Brand Name 13",
								"Brand Name 14",
								"Brand Name 15", 
							), 
													
						),
						

			 
			);
			
 		
			} break;
			case "realestate": {				 
				$taxdata = array(
				
						1 => array(		
							"name" => "listing",		
							"data" => array("Detached","Semi-Detached","Terraced","Bungalow","Land","Apartment","Office","Auction","Forclosed","Other"),	
						),					
						2 => array(		
							"name" => "beds",		
							"data" => array("1 Bedroom","2 Bedrooms","3 Bedrooms","4 Bedrooms","5+ Bedrooms"),	
						),	 	
						3 => array(		
							"name" => "baths",		
							"data" => array("1 Bathroom","2 Bathrooms","3 Bathrooms","4 Bathrooms","5+ Bathrooms"),	
						),						
						4 => array(		
							"name" => "type",		
							"data" => array("For Sale","For Rent"),	
						),						
						5 => array(		
							"name" => "features",		
							"data" => array(
								"Modern Fittings",
								"Air Conditioning",
								"Washer/Dryer Hookups",
								"Furniture",
								"Patio/Balcony",
								"Hardwood Floors",
								"Dishwasher",
								"Stunning Views",
								"Walk-in Closets",
								"Wireless Internet",
								"Pet Friendly",
								"Fitness Center/Gym",
								"Swimming Pool",
								"Car Park",
								"Nearby Shops &amp; Restaurants",
								"Bike Storage",
								"Large Public Spaces",
								"Meeting Rooms",
								"24/7 Building Security Staff", 
								"Nearby Public Transport",
								"Good Mobile Coverage",										
							),
						),
						
						6 => array(		
							"name" => "parking",		
							"data" => array("Free Parking", "Paid Parking", "Roadside Parking","No Parking"),	
						),
						
						7 => array(		
							"name" => "garden",		
							"data" => array("Has Garden","Shared Garden","No Garden"),	
						),
						
					);		
								
			} break;
			
			case "compare": {
			
			$taxdata = array(
					
						1 => array(		
							"name" => "size",		
							"data" => array("XL","L","M","2XL","S","3XL","XS","4XL"),	
						),	 	
						2 => array(		
							"name" => "color",		
							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),	
						),	
						
						3 => array(		
							"name" => "listing",		
							"data" => array(
							
								"Sports" => array ('Tennis', 'Football', 'Swimming', 'Climbing'),
								"Electronic" => array ('Television', 'Air Conditional', 'ARM', 'Theater'),
								"Digital" => array ('Mobile', 'Camera', 'Laptop', 'Notebook'),
								"Furniture" => array ('Television', 'Air Conditional', 'Theater', 'Accessories'),
								"Jewelry" => array ('Mobile', 'Camera', 'Laptop', 'Notebook'), 
								"Fashion" => array ('Women', 'Men', 'Kids', 'Accessories'),
								"Books" => array ('Romance', 'Crime Fiction', 'Fiction', 'Erotica'),
								"Music" => array ('Pop', 'Dance', 'Electronic', 'Rock'),
								"Gaming" => array ('xBox', 'Playstation', 'PC Games', 'Accessories'),
								
								"Outdoors" => array ('Fitness', 'Crime Fiction', 'Camping & Hiking', 'Cycling'),
								"Movies &amp; TV," => array ('DVD & Blu-ray CDs ', 'Vinyl', ' Digital Music'),
								"Watches" => array ('Women', 'Men'),
							),	
						),	
						
						4 => array(		
							"name" => "features", 		
							"data" => array(
								"Example Feature 1", 
								"Example Feature 2", 
								"Example Feature 3", 
								"Example Feature 4", 
								"Example Feature 5", 
								"Example Feature 6", 
								"Example Feature 7", 
								"Example Feature 8", 
								"Example Feature 9",  								
							),
						),	
						
						5 => array(		
							"name" => "store",		
							"data" => array(
								"Store Name 1",
								"Store Name 2",
								"Store Name 3",	
								"Store Name 4",	
								"Store Name 5",	
								"Store Name 6",					
							),
						), 
					);
						
			} break;
			case "shop": {				 
					$taxdata = array(
					
						1 => array(		
							"name" => "size",		
							"data" => array("XL","L","M","2XL","S","3XL","XS","4XL"),	
						),	 	
						2 => array(		
							"name" => "color",		
							"data" => array("Beige","Black","Blue","Brown","Burgundy","Charcoal","Gold","Gray","Green","Off White","Orange","Pink","Purple","Red","Silver"),	
						),	
						
						3 => array(		
							"name" => "listing",		
							"data" => array(
							
								"Sports" => array ('Tennis', 'Football', 'Swimming', 'Climbing'),
								"Electronic" => array ('Television', 'Air Conditional', 'ARM', 'Theater'),
								"Digital" => array ('Mobile', 'Camera', 'Laptop', 'Notebook'),
								"Furniture" => array ('Television', 'Air Conditional', 'Theater', 'Accessories'),
								"Jewelry" => array ('Mobile', 'Camera', 'Laptop', 'Notebook'), 
								"Fashion" => array ('Women', 'Men', 'Kids', 'Accessories'),
								"Books" => array ('Romance', 'Crime Fiction', 'Fiction', 'Erotica'),
								"Music" => array ('Pop', 'Dance', 'Electronic', 'Rock'),
								"Gaming" => array ('xBox', 'Playstation', 'PC Games', 'Accessories'),
								
								"Outdoors" => array ('Fitness', 'Crime Fiction', 'Camping & Hiking', 'Cycling'),
								"Movies &amp; TV," => array ('DVD & Blu-ray CDs ', 'Vinyl', ' Digital Music'),
								"Watches" => array ('Women', 'Men'),
							),	
						),
					 
						4 => array(							
							"name" => "sale",							
							"data" => array("Discount","Black Friday"),						
						),
						
						 
					);					
			} break;
			case "video": {
			
				$taxdata = array(					
						1 => array(						
							"name" => "listing",							
							"data" => array(
							"Action & Adventure","Animation","Beauty & Fashion","Classic TV","Comedy","Documentary","Drama","Entertainment","Family","Food","Gaming","Health & Fitness","Home & Garden","Learning & Education","Music","Nature","News","Reality & Game Shows","Science & Tech","Science Fiction","Soaps","Sports","Travel"
							),
						),
						
						2 => array(						
							"name" => "level",							
							"data" => array("All Levels", "Beginner","Intermediate","Advanced" ),
						),
						3 => array(							
							"name" => "features",							
							"data" => array("Live","4K","HD","Subtitles/CC","Creative Commons","360°","VR180","3D","HDR","Location","Purchased"),						
						),
						
						/*
						4 => array(							
							"name" => "area",							
							"data" => array("Chinese","Hong Kong","Korea","Japan","America","France","U.K","Germany","Italy","Canada","India","Russia","Thail","Other"),						
						),
						
						5 => array(							
							"name" => "language",							
							"data" => array("English", "Chinese","Korea","Japan","America","France","U.K","Germany","Italy","Canada","India","Russia","Thail","Other"),						
						),
						
						6 => array(							
							"name" => "subtitles",							
							"data" => array("English","Chinese","Korea","Japan","America","France","U.K","Germany","Italy","Canada","India","Russia","Thail","Other"),						
						),
						
						7 => array(							
							"name" => "type",							
							"data" => array("martial arts","gangster","crime","science fiction","war fear","thriller","Documentary","western","drama","singing and dancing","fantasy","adventure","Suspense","history","action","biography","animation","child","comedy","love story","sports","short film"),						
						),
						
						
						8 => array(							
							"name" => "year",							
							"data" => array("2022","2021","2020","2019","2018","2017","2016","2015","2014","2013","2012","2011","2010","the 90s","the 80's","the 70's","earlier"),						
						),
						*/
						 
						 
				);
			
			} break;
}


		$cat_icons_small = array(
		
						'fa-car',
						'fa-archive',
						'fa-university',
						'fa-coffee',
						'fa-heart',
						'fa-desktop',
						'fa-film',
						'fa-futbol',
						'fa-bus',
						
						'fa-car',
						'fa-coffee',
						'fa-university',
						'fa-archive',
						'fa-laptop',
						'fa-desktop',
						'fa-film',
						'fa-futbol',
						'fa-bus',
						
						'fa-car',
						'fa-archive',
						'fa-university',
						'fa-coffee',
						'fa-heart',
						'fa-desktop',
						'fa-film',
						'fa-futbol',
						'fa-bus',
		
		);	
		
		


$ti = 0; $si=0;

//die(print_r($taxdata));

foreach($taxdata as $t){ 
	
	//1 . register
	register_taxonomy( $t['name'], THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => array('name' => $t['name']) , 'query_var' => true, 'rewrite' => true, 'rewrite' => array('slug' => $t['name']) ) );  
		

		//2. build categories
		foreach( $t['data'] as $topcat => $cat){
		
		$desc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.";  
		
		if(is_array($cat)){
		
		
			if ( term_exists( $topcat, $t['name'] ) ){
				$term = get_term_by('slug', $topcat, $t['name']);		 
				$nparent  = $term->term_id;				
			}else{
			
				$topcat_id = wp_insert_term($topcat, $t['name'], array('cat_name' => $topcat, 'description' => $desc ));
				if(!is_object($topcat_id) && isset($topcat_id['term_id'])){				 
					$nparent = $topcat_id['term_id'];				
				}else{			 
					$nparent = $topcat_id->term_id;
				}	 
				 
			}
			
			// STORE NAME
			$nameLink[$t['name']."-".strtolower(str_replace(" ","",$topcat))] = $nparent; 			
			$randomarray[$t['name']][$nparent] = $nparent; 
			 	
			// SUB CATEGORIES
			foreach($cat as $incat){
				
				if ( term_exists( $incat, $t['name'], $nparent ) ){					
						$term = get_term_by('slug', $incat, $t['name']);		 
						$sparent  = $term->term_id;						
				}else{
					
						$cat_id = wp_insert_term($incat, $t['name'], array('parent' => $nparent, 'description' => $desc ));
						if(!is_object($cat_id) && isset($cat_id['term_id'])){
							$sparent = $cat_id['term_id'];
						}elseif(isset($cat_id->term_id)){									 
							$sparent = $cat_id->term_id;
						}
				}					
				// STORE NAME
				$nameLink[$t['name']."-".strtolower(str_replace(" ","",$incat))] = $sparent;
				$randomarray[$t['name']][$sparent] = $sparent;
			} 
			
		 
		
		}else{
		
				if ( term_exists( $cat, $t['name'] ) ){	
		
					$term = get_term_by('slug', $cat, $t['name']);		 
					$nparent  = $term->term_id;
				
				}else{
			
					$cat_id = wp_insert_term($cat, $t['name'], array('cat_name' => $cat, 'description' => $desc ));
					if(!is_object($cat_id) && isset($cat_id['term_id'])){				 
						$nparent = $cat_id['term_id'];				
					}else{			 
						$nparent = $cat_id->term_id;
					}	 
				}
				
				// STORE NAME
				$nameLink[$t['name']."-".strtolower(str_replace(" ","",$cat))] = $nparent;
				$randomarray[$t['name']][$nparent] = $nparent;	 
			
		}// END OUTTER ARAY
		
		
		 
		// ADD ON EXTRA DATA 
		if(is_numeric($nparent) && $t['name'] == "listing"){
			
			// CATEGORY LOGO
			$GLOBALS['theme_defaults']['storeimage_'.$nparent] = "?iconimgid=".$ti;	
			
			// CATEGORY IMAGE
			$GLOBALS['theme_defaults']['category_image_'.$nparent] = "?catimgid=".$ti;
		
		}
		// ADD ON EXTRA DATA 
		if(is_numeric($nparent) && $t['name'] == "store"){
			
			// CATEGORY LOGO
			$GLOBALS['theme_defaults']['storeimage_'.$nparent] = "?store=1&iconimgid=".$si;	
			
			// CATEGORY IMAGE
			$GLOBALS['theme_defaults']['category_image_'.$nparent] = "?store=1&catimgid=".$si;
			$si++;
		}
		
		
		// INCREMENT
		$ti++;
			
	
	
	}

}	

 
$locations = array(

	1 => array("US", "New York", "Manhattan", "240 Broadway, New York, NY 10007, USA", "-74.0059728","40.7127753","10007"),
	2 => array("US", "New York", "Manhattan", "Pearl Street & Robert F Wagner Place, New York, NY 10038, USA", "-74.00099462006835","40.710433145221195", "10038"),
	3 => array("US", "New York", "Manhattan", "Madison St/Catherine St, New York, NY 10038, USA", "-73.99751847718505","40.71202712062323","100038"),
	4 => array("US", "New York", "Manhattan", "429 Broome St, New York, NY 10013, USA", "-73.99932092164306","40.72123239521979","10013"),
	5 => array("US", "New York", "Manhattan", "66 1st Avenue, New York, NY 10009, USA", "-73.98627465699462","40.72539549359491","10009"),
	6 => array("US", "New York", "Manhattan", "68 W 10th St, New York, NY 10011, USA", "-73.9984626147583","40.73437128836366","10011"),
	7 => array("US", "New York", "Manhattan", "108 E 16th St, New York, NY 10003, USA", "-73.98884957764892","40.735541954942086","10003"),
	8 => array("US", "New York", "Manhattan", "42 W 44th St, New York, NY 10036, USA", "-73.98215478394775","40.755570168893485","10036"),
	9 => array("US", "New York", "Manhattan", "230 E 63rd St, New York, NY 10065, USA", "-73.96344369385986","40.76324171770885","10065"),
	10 => array("US", "New York", "Queens", "8 49th Ave, Queens, NY 11101, USA", "-73.94765084718017","40.74217534312245","11101"),
	11 => array("US", "New York", "Queens", "25-3 Borden Ave, Long Island City, NY 11101, USA", "-73.94473260377197","40.73967164196744","11101"),
	12 => array("US", "New York", "Queens", "48-1 36th St, Long Island City, NY 11101, USA", "-73.92962640260009","40.74032196301581","11101"),
	13 => array("US", "New York", "Queens", "30-09 41st St, Astoria, NY 11103, USA", "-73.91434854005126","40.763209213014065","11103"),
	14 => array("US", "New York", "Queens", "30-48 72nd St, Queens, NY 11370, USA", "-73.89546578858642","40.75878842640948","11370"),
	15 => array("US", "New York", "Queens", "63-39 83rd Pl, Flushing, NY 11379, USA", "-73.87108987305908","40.72211057045409","11374"),
	16 => array("US", "New York", "Queens", "79-42 67th Rd, Flushing, NY 11379, USA", "-73.87186234925537","40.71235241703782","11379"),
	17 => array("US", "New York", "Queens", "107-47 104th St, Jamaica, NY 11417, USA", "-73.8354701373413","40.67929418003906","11417"),
	18 => array("US", "New York", "Queens", "87-27 133rd St, Jamaica, NY 11418, USA", "-73.81881898377685","40.70155172662101","11418"),
	19 => array("US", "New York", "Queens", "143-57 229th St, Jamaica, NY 11413, USA", "-73.74878114197998","40.66406104898427","11413"),
	20 => array("US", "New York", "Queens", "4 Central Terminal Area, Jamaica, NY 11430, USA", "-73.78963654969482","40.64153046978498","11430"),

); 


$locations_dt = array(

	1 => array("US", "New York", "Manhattan", "240 Broadway, New York, NY 10007, USA", "-74.0059728","40.7127753","10007"),
	2 => array("GB", "London", "Manhattan", "Pearl Street & Robert F Wagner Place, New York, NY 10038, USA", "-74.00099462006835","40.710433145221195", "10038"),
	3 => array("GB", "Leeds", "Manhattan", "Madison St/Catherine St, New York, NY 10038, USA", "-73.99751847718505","40.71202712062323","100038"),
	4 => array("GB", "Liverpool", "Manhattan", "429 Broome St, New York, NY 10013, USA", "-73.99932092164306","40.72123239521979","10013"),
	5 => array("US", "Colorado", "Manhattan", "66 1st Avenue, New York, NY 10009, USA", "-73.98627465699462","40.72539549359491","10009"),
	6 => array("US", "California", "Manhattan", "68 W 10th St, New York, NY 10011, USA", "-73.9984626147583","40.73437128836366","10011"),
	7 => array("US", "Texas", "Manhattan", "108 E 16th St, New York, NY 10003, USA", "-73.98884957764892","40.735541954942086","10003"),
	8 => array("US", "Mississippi", "Manhattan", "42 W 44th St, New York, NY 10036, USA", "-73.98215478394775","40.755570168893485","10036"),
	9 => array("IN", "Assam", "Manhattan", "230 E 63rd St, New York, NY 10065, USA", "-73.96344369385986","40.76324171770885","10065"),
	10 => array("IN", "Chandigarh", "Queens", "8 49th Ave, Queens, NY 11101, USA", "-73.94765084718017","40.74217534312245","11101"),
	11 => array("IN", "Chhattisgarh", "Queens", "25-3 Borden Ave, Long Island City, NY 11101, USA", "-73.94473260377197","40.73967164196744","11101"),
	12 => array("IN", "Pondicherry", "Queens", "48-1 36th St, Long Island City, NY 11101, USA", "-73.92962640260009","40.74032196301581","11101"),
	13 => array("IN", "Sikkim", "Queens", "30-09 41st St, Astoria, NY 11103, USA", "-73.91434854005126","40.763209213014065","11103"),
	14 => array("IN", "Uttar Pradesh", "Queens", "30-48 72nd St, Queens, NY 11370, USA", "-73.89546578858642","40.75878842640948","11370"),
	15 => array("GB", "Manchester", "Queens", "63-39 83rd Pl, Flushing, NY 11379, USA", "-73.87108987305908","40.72211057045409","11374"),
	16 => array("GB", "London", "Queens", "79-42 67th Rd, Flushing, NY 11379, USA", "-73.87186234925537","40.71235241703782","11379"),
	17 => array("GB", "London", "Queens", "107-47 104th St, Jamaica, NY 11417, USA", "-73.8354701373413","40.67929418003906","11417"),
	18 => array("US", "California", "Queens", "87-27 133rd St, Jamaica, NY 11418, USA", "-73.81881898377685","40.70155172662101","11418"),
	19 => array("US", "California", "Queens", "143-57 229th St, Jamaica, NY 11413, USA", "-73.74878114197998","40.66406104898427","11413"),
	20 => array("US", "California", "Queens", "4 Central Terminal Area, Jamaica, NY 11430, USA", "-73.78963654969482","40.64153046978498","11430"),

); 
 
 
$itemdata = array(); $i =1;

$tcc = 20;
if($_POST['admin_values']['template'] == "learning"){
$tcc = 20;
}

while($i< $tcc){ 

 
		// EXTRA FOR TEMPLATES
		if(isset($_POST['admin_values']['template'])){
			switch($_POST['admin_values']['template']){
			
	 
			
			case "auction": {
			
			 	$random_num = rand(20, 100);
				
				
				// RANDOM MAKE AND MODEL
				$randn = rand(1,90);	
				$model = "";			
				$make =  "";
			  
			
				$itemdata[$i] = array(
				
						"name" 	=> "Example Auction ".$i,						 
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
							"map-country" 	=> $locations[$i][0],			
							"map-city" 		=> $locations[$i][1],
							"map-area" 		=> $locations[$i][2],
							"map-location" 	=> $locations[$i][3],
							"map-log" 		=> $locations[$i][4],
							"map-lat" 		=> $locations[$i][5],
							"map-zip" 		=> $locations[$i][6],	
										 
							"hits" 			=> rand(0,10000),			
							"price_current" => rand(80, 500),
							"price_bin" 	=> rand(500, 1500),
							
							
							"miles" 	=> rand(20000,100000),
							"year" 		=> rand(1999,2020),								
							"make" 		=>  $make,	
							"model" 	=> $model,	
							
							
							"modelnum" => "MH12433",
							
							"backgroundimg" => rand(1,14),
							
							"listing_expiry_date" =>  date('Y-m-d H:i:s', strtotime( current_time( 'mysql' ) . "+".$random_num." days" )  ) ,
							"listing_expiry_days" =>  $random_num,
							
							"examplefield" => "example value",	
							
							"image" => "?imgid=".$i,
							
							//"youtube_id"	=> "ek5BOZUg9U8",
							
							  
						), 
						
						"tax" => array("listing","condition","features","color","size","brand","refunds"),						
						
				);
				 
			
			} break;
			
			case "micro": {
			
			
				
				$title = array(
						1 => "I will do a professional illustration", 
						2 => "I will create pbr materials for you", 
						3 => "I will design a professional game icon and screenshots",
						4 => "I will create boards and tiles for your games",
						5 => "I will design a board card game with a tabletop box.",
						6 => "I will create logo typeface animation",
						7 => "I will create an animated logo with a mascot or animal",
						8 => "I will do a professional logo animation",
						9 => "I will create a professional custom logo animation",
						10 => "I will create a dynamic and catchy explainer video",
						11 => "I will do professional cartoon animation",
						12 => "I will develop high quality video game for any platform", 
						13 => "I will produce animated 3d music video in unreal engine", 
						14 => "I will do a lyrics music video", 
						15 => "I will design and develop flutter and react native apps",
						16 => "I will create a full ios and android mobile app",
						17 => "I will upgrade and update your hybrid mobile app",
						18 => "I will be your pro social media content creator",
						19 => "I will be your social media manager and content creator",
						20 => "I will create your instagram content strategy and designs",
						21 => "I will audit or build and manage your google ads",
					);  
			  
			 	 $itemdata[$i] = array(
				
						"name" 	=> $title[$i], 
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
						  				 
							"hits" 			=> rand(0,10000),	
							
							//"youtube_id"	=> "tBJwQiCjZ-E",
							
							"image" => "?imgid=".$i,
										
					 		
							"days" 			=> rand(1, 30),
							"price" 		=> rand(500, 1500),							
							"gig" => "Example Standard Title",
							"desc" => "This is a test description for this gig. Users can write their own when they create their jobs.",
							
							
							"days-1" 			=> rand(1, 30),
							"price-1" 		=> rand(500, 1500),							
							"gig-1" => "Example Premium Title",
							"desc-1" => "This is a test description for this gig. Users can write their own when they create their jobs.",
							
							
							"customextras" => array(	
							"name" => array( 0 => "Example Addon 1", 1 => "Example Addon 2" ),
							"value" => array( 0 => "Tihs is an example micro job add-on option.", 1 => "Tihs is an example micro job add-on option." ),
							"price" => array( 0 => "10", 1 => "50" ) 
							),
					 		 
							  
						), 
						
						"tax" => array("listing","delivery","features"),						
						
				);
				 
			
			} break;
			case "directory": {
			
			$businesshours = array(
				'start' => array
					(
						0 => '09:00',
						1 => '09:00',
						2 => '12:00',
						3 => '09:45',
						4 => '09:00',
						5 => '09:00',
						6 => '06:45',
					),
			
				'end' => array
					(
						0 => '18:00',
						1 => '18:00',
						2 => '18:00',
						3 => '18:00',
						4 => '18:00',
						5 => '18:00',
						6 => '18:00',
					),
			
				'active' => array
					(
						0 => rand(0,1),
						1 => rand(0,1),
						2 => rand(0,1),
						3 => rand(0,1),
						4 => rand(0,1),
						5 => rand(0,1),
						6 => rand(0,1),
					),
			
			);
			
			$website = array(
			"www.premiumpress.com",
			"google.com",
			"yahoo.com",
			"bing.com",
			"ask.com","baidu.com","duckduckgo.com","youtube.com","facebook.com","twitter.com","myspace.com","bbc.com","cnn.com","wordpress.org","instagram.com","okcupid.com","match.com","zoosk.com","fiverr.com","jdate.com","fontawesome.com","bbpress.org"
			
			);
			 	
			 
			  
			$itemdata[$i] = array(
				
						"name" 	=> "Example Business ".$i,						 
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
							"map-country" 	=> $locations_dt[$i][0],			
							"map-city" 		=> $locations_dt[$i][1],
							"map-area" 		=> $locations_dt[$i][2],
							"map-location" 	=> $locations_dt[$i][3],
							"map-log" 		=> $locations_dt[$i][4],
							"map-lat" 		=> $locations_dt[$i][5],
							"map-zip" 		=> $locations_dt[$i][6],	
										 
							"hits" 			=> rand(0,10000),			
							"phone" 		=> "+".rand(10,99)." ".rand(100,700)." ".rand(100,700)." ".rand(100,700),
							//"email" 		=> "example@example.com",
							"website" 		=> $website[$i],
							
							"businesshours" => 	$businesshours,
							
							"backgroundimg" => rand(1,14),
							
							//"youtube_id"	=> "Rhoumi1Ml9s", 
							
							
							"customextras" => array(	
								"name" => array( 0 => "Example Service 1", 1 => "Example Service 2", 2 => "Example Service 3" ),
								"value" => array( 0 => "Here users can create their own services.", 1 => "Here users can create their own services", 2 => "Here users can create their own services" ),
								"price" => array( 0 => "10", 1 => "50", 2 => "100" ) 
							),
							
							"image" => "?imgid=".$i,
						), 
						
						"tax" => array("listing","features","parking","payment","wifi","pets"),
					 	
				);
			
			} break;
			
			case "cardealer": {
			
				$businesshours = array(
					'start' => array
						(
							0 => '09:00',
							1 => '09:00',
							2 => '12:00',
							3 => '09:45',
							4 => '09:00',
							5 => '09:00',
							6 => '06:45',
						),
				
					'end' => array
						(
							0 => '18:00',
							1 => '18:00',
							2 => '18:00',
							3 => '18:00',
							4 => '18:00',
							5 => '18:00',
							6 => '18:00',
						),
				
					'active' => array
						(
							0 => rand(0,1),
							1 => rand(0,1),
							2 => rand(0,1),
							3 => rand(0,1),
							4 => rand(0,1),
							5 => rand(0,1),
							6 => rand(0,1),
						),
				
				);
				
				// RANDOM MAKE AND MODEL
				$randn = rand(1,90);				
				$make = "";
				$model = "";
				
				
				$itemdata[$i] = array(
				
						"name" 	=> "Example Car ".$i,
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
							"map-country" 	=> $locations[$i][0],			
							"map-city" 		=> $locations[$i][1],
							"map-area" 		=> $locations[$i][2],
							"map-location" 	=> $locations[$i][3],
							"map-log" 		=> $locations[$i][4],
							"map-lat" 		=> $locations[$i][5],
							"map-zip" 		=> $locations[$i][6],				 
							"hits" 			=> rand(0,10000),			
							"price" 		=> rand(0,10000),
							
							"miles" 	=> rand(20000,100000),
							"year" 		=> rand(1999,2020),								
							//"make" 		=>  $make,	
							//"model" 	=> $model,	
							
							
							"image" => "?imgid=".$i,
							
							//"youtube_id"	=> "b-f3B_lgG_E", 
							
							"businesshours" => 	$businesshours,
							
						), 
						
						"tax" => array("listing","condition","body","fuel","transmission","exterior","interior","doors","seller","features","engine","drive","owners"),
					 	
				);
			} break;	
			case "classifieds": {
			 
			
				$itemdata[$i] = array(
				
						"name" 	=> "Example Ad ".$i,						 
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
							"map-country" 	=> $locations[$i][0],			
							"map-city" 		=> $locations[$i][1],
							"map-area" 		=> $locations[$i][2],
							"map-location" 	=> $locations[$i][3],
							"map-log" 		=> $locations[$i][4],
							"map-lat" 		=> $locations[$i][5],
							"map-zip" 		=> $locations[$i][6],
											 
							"hits" 			=> rand(0,10000),			
							"price" 		=> rand(0,10000),
							"price_bn" 		=> rand(500,10000),	
							
							"examplefield" => "example value",	
							
							"modelnum" => "MH12433",
							
							"image" => "?imgid=".$i,
							
							//"youtube_id"	=> "BhFmA7voPVk", 
							
							"offertype" => "1",
						 
							
							"backgroundimg" => rand(1,14),		 
						), 
						
						"tax" => array("condition","listing","features","color","size","brand","refunds"),
					 	
				);	 	
			} break;
			
			 		
			case "escort": {
			 
			 
			 	$businesshours = array(
				'start' => array
					(
						0 => '09:00',
						1 => '09:00',
						2 => '12:00',
						3 => '09:45',
						4 => '09:00',
						5 => '09:00',
						6 => '06:45',
					),
			
				'end' => array
					(
						0 => '18:00',
						1 => '18:00',
						2 => '18:00',
						3 => '18:00',
						4 => '18:00',
						5 => '18:00',
						6 => '18:00',
					),
			
				'active' => array
					(
						0 => rand(0,1),
						1 => rand(0,1),
						2 => rand(0,1),
						3 => rand(0,1),
						4 => rand(0,1),
						5 => rand(0,1),
						6 => rand(0,1),
					),
			
			);
			
				$titles = array(				
				"Scarlett",
				"Nicolette",
				"Natalia",
				"Anais",
				"Paulina",
				"Alessandra",
				"Chanel",
				"Heartbreaker",
				"Coffee",
				"Soraya",
				"Adrianna",
				"Giuliana",
				"Gertrude",
				"Agnes",
				"Ethel",
				"Roadblock",
				"Bowie",
				"Leyre",
				"Rooster",
				"Kaelee",
				"Mildred",
				"Antina"
			 );	
			
			
				$ag = rand(18,45);
				$itemdata[$i] = array(
					
							"name" 	=> $titles[$i],							
							"data" => array(					 
								"hits" 			=> rand(0,10000),			
								 								
								"packageID" 	=> rand(0,2),
														
								"map-country" 	=> $locations[$i][0],			
								"map-city" 		=> $locations[$i][1],
								"map-area" 		=> $locations[$i][2],
								"map-location" 	=> $locations[$i][3],
								"map-log" 		=> $locations[$i][4],
								"map-lat" 		=> $locations[$i][5],
								"map-zip" 		=> $locations[$i][6],
								
								"videoaccess" 	=> array(0 => 1, 1 => 2 , 2 => 3 ),
								
								"image" => "?imgid=".$i,
								
								"daage" => $ag,	
								
 								"height" => rand(150,200)." CM",	
								
								"dresssize" => rand(5,12),	
								
								"whatsapp" => "15551234567",
								
								"bustsize" => "G",
								
								//"youtube_id"	=> "PVeAGrWJZ6s",
								
								"businesshours" => 	$businesshours, 
								
								"phone" => "123 456 678",
								
								'rate_outcall1' => rand(10,50),
								'rate_outcall2' => rand(10,50),
								'rate_outcall3' => rand(10,50),
								'rate_outcall4' => rand(10,50),
								'rate_outcall5' => rand(10,50),
								
								
								"photosverified" => "1",
								
								"price" => rand(200,1000),	
								
								
								
								"lookingdesc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.", 
								//"lookinggen" => $nameLink["dagender-male"],
								//"lookingage" => rand(1,6),
								
								//"backgroundimg" => rand(1,12),
							),
							
							"tax" => array("listing","dagender","daseeking","dasexuality","dathnicity","daeyes","dahair","dabody","dasmoke","dadrink","features","age","store"),
					);	
			
				 	
			} break;
			
			 		
			case "dating": {
			
			$titles = array(				
				"Queen Bee",
				"Ladysmith",
				"Drift",
				"Mafia Princess",
				"Spitfire",
				"Snapdragon",
				"Mother Night",
				"Heartbreaker",
				"Coffee",
				"The Beekeeper",
				"Bitmap",
				"Junkyard Dog",
				"Riff Raff",
				"Blister",
				"K-9",
				"Roadblock",
				"Bowie",
				"Keystone",
				"Rooster",
				"Bowler",
				"Kickstart",
				"Sandbox"
			 );	
			 
			
				$ag = rand(18,65);
				$itemdata[$i] = array(
					
							"name" 	=> $titles[$i],								
							"data" => array(					 
								"hits" 			=> rand(0,10000),			
								 								
								"packageID" 	=> rand(0,2),
														
								"map-country" 	=> $locations[$i][0],			
								"map-city" 		=> $locations[$i][1],
								"map-area" 		=> $locations[$i][2],
								"map-location" 	=> $locations[$i][3],
								"map-log" 		=> $locations[$i][4],
								"map-lat" 		=> $locations[$i][5],
								"map-zip" 		=> $locations[$i][6],
								
								"videoaccess" 	=> array(0 => 1, 1 => 2 , 2 => 3 ),
								
								"daage" => $ag,	
								
								"lookingdesc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.", 
								"lookinggen" => $nameLink["dagender-male"],
								"lookingage" => rand(1,6),
								
								"backgroundimg" => rand(1,12),
								
								//"youtube_id"	=> "Xp-3BoAPiGk", 
								
								"image" => "?imgid=".$i,
								
							),
							
							"tax" => array("listing","dagender","daseeking","dasexuality","dathnicity","daeyes","dahair","dabody","dasmoke","dadrink","dahairlength","features","age"),
					);	
			
				 	
			} break;
			
			
			
			case "project": {
			
			
			$title = array(
					1 => "I need a new website designing in WordPress.", 
					2 => "I need a mobile app creating.", 
					3 => "I want my lawn mowing",
					4 => "I want a teacher to help me learn Chinese.",
					5 => "I want my car cleaning.",
					6 => "I want someone to teach me French.",
					7 => "I want a website designed in PHP.",
					8 => "I want someone to make a bag design for me.",
					9 => "I want a t-shirt designed for me.",
					10 => "I want someone to help make a new logo design.",
					11 => "I want someone to clean my car.",
					12 => "I want a new bike logo designing.", 
					13 => "I want someone to do my homework.", 
					14 => "I want a personal trainer.", 
					15 => "I want someone to be my date for a night.",
					16 => "I want help writitng my English essay.",
					17 => "I want coupons for Wall-Mart.",
					18 => "I'm looking for someone to help me move.",
					19 => "I'm looking for a yoga teacher.",
					20 => "I want someone to teach me how to code.",
					21 => "I want someone good at SEO.",
				);
				
				$random_num = rand(20, 100);
			
				$itemdata[$i] = array(
					
							"name" 	=> $title[$i],							
							"data" => array(		
										 
								"hits" 			=> rand(0,10000),
											
								"price" 		=> rand(50,1050),	
								
							"map-country" 	=> $locations[$i][0],			
								"map-city" 		=> $locations[$i][1],
								"map-area" 		=> $locations[$i][2],
								"map-location" 	=> $locations[$i][3],
								"map-log" 		=> $locations[$i][4],
								"map-lat" 		=> $locations[$i][5],
								"map-zip" 		=> $locations[$i][6],
								
								"backgroundimg" => rand(1,14),								
								 								
								"listing_expiry_date" =>  date('Y-m-d H:i:s', strtotime( current_time( 'mysql' ) . "+".$random_num." days" )  ) ,
								"listing_expiry_days" =>  $random_num,
								
								"image" => "?imgid=".$i,
								
								"price_bin" 	=> rand(1500, 5500),
								
								 
							),
							
							"tax" => array("experience","listing"),
					);	
					
					 
				 		
			} break;
			
			
			
			
			case "jobs": {
			
			$titles = array(
			"Apple Specialist - Retail Customer Services and Sales",
			"Customer Assistant - Immediate start available",
			"Support COVID-19 Vaccination Programme",
			"Digital Marketing Intern",
			"Exhibitions Assistant",
			"International Trade Trainee",
			"Office Assistant",
			"Student Hub Telephone Advisor",
			"Weekend Technical Support",
			"Technology Project Administrator",
			"Store Assistant - Days",
			"Customer Team Member",
			"Brand Ambassador",
			"Events Assistant and Host",
			"PR & Communications Assistant",
			"Receptionist",
			"Home nursery worker",
			"Marketing/Personal Assistant");
			
			$businesshours = array(
				'start' => array
					(
						0 => '09:00',
						1 => '09:00',
						2 => '12:00',
						3 => '09:45',
						4 => '09:00',
						5 => '09:00',
						6 => '06:45',
					),
			
				'end' => array
					(
						0 => '18:00',
						1 => '18:00',
						2 => '18:00',
						3 => '18:00',
						4 => '18:00',
						5 => '18:00',
						6 => '18:00',
					),
			
				'active' => array
					(
						0 => rand(0,1),
						1 => rand(0,1),
						2 => rand(0,1),
						3 => rand(0,1),
						4 => rand(0,1),
						5 => rand(0,1),
						6 => rand(0,1),
					),
			
			);
			
			$itemdata[$i] = array(
					
							"name" 	=> $titles[$i],							
							"data" => array(					 
								"hits" 			=> rand(0,10000),			
								"price" 		=> rand(0,100000),	
								
								"company" => "John Doe Company",
								"hours" => rand(20,100),
																
								"packageID" 	=> rand(0,2),						
								"map-country" 	=> $locations[$i][0],			
								"map-city" 		=> $locations[$i][1],
								"map-area" 		=> $locations[$i][2],
								"map-location" 	=> $locations[$i][3],
								"map-log" 		=> $locations[$i][4],
								"map-lat" 		=> $locations[$i][5],
								"map-zip" 		=> $locations[$i][6],
								
								"responsibilities" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
								
								"qualifications"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
								
								
								"image" => "?imgid=".$i,
								"imagelogo" => "?imglogoid=".$i,
								
								"businesshours" => $businesshours, 
								
								"url" 				=> "https://www.premiumpress.com/",
								
								//"youtube_id"	=> "h5Vtl66Ae2M", 
								
								
							),
							
							"tax" => array("jobtype","experience","listing","remote"),
					);	
					
					 
				 		
			} break;			
			case "coupon": {
			
				// RANDOM CONTENT
				$randomeTitle = array(
					1 => "20% Off With in-store pick-pp", 
					2 => "Free Shipping with this coupon code", 
					3 => "50% when you shop in store today",
					4 => "Buy Obe get One Free Between 3pm and 6pm.",
					5 => "Save 35% on purchased over $50",
					6 => "Enjoy Free Shipping on orders over $100",
					7 => "Buy Now Deliver Tomorrow with this coupon code.",
					8 => "Up to 15% Off When You Join Newsletter",
					9 => "Up to 33% Off Selected Bikes",
					10 => "30% Off When you buy Two",
					11 => "Up to 33% Off Selected Items",
					12 => "Up to $20 Off Summer Items", 
					13 => "20% Off With in-store pick-pp", 
					14 => "Free Shipping with this coupon code", 
					15 => "50% when you shop today",
					16 => "Buy One get One Free Between 3pm and 6pm.",
					17 => "Save 35% on purchased over $50",
					18 => "Enjoy Free Shipping on orders over $100",
					19 => "Buy Now Deliver Tomorrow with this coupon code.",
					20 => "Up to 15% Off Selected Items",
					21 => "Up to 33% Off Selected Items",
				);
			
				  
			 	 $itemdata[$i] = array(
				
						"name" 	=> $randomeTitle[$i],
						
						"data" => array(
						
							"packageID" 	=> rand(0,2),							
							 			 
							"hits" 			=> rand(0,10000), 
							
							"buy_link" => "https://www.premiumpress.com",
							
							"verified" 	=> rand(0,1),	
							
							"listing_expiry_date" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".rand(1, 30)." days") ),
							
							"image" => "?imgid=".$i,
							
							"ctype" => $nameLink["ctype-offer"],
							 
							"featured" => 1,
							  
							
						), 
						
						"tax" => array("listing", "store", "ctype"),						
						
				);
				  
			
			} break;
			
			
			case "cashback": {
			
	
				  
			 	 $itemdata[$i] = array(
				
						"name" 	=> "Example Deal ".$i,
						
						"data" => array(
						
							"packageID" 	=> rand(0,2),							
							 			 
							"hits" 			=> rand(0,10000), 
							
							"buy_link" => "https://www.premiumpress.com",
							
							"verified" 	=> rand(0,1),	
							  
							"image" => "?imgid=".$i,
							 
							"cashback_p" => rand(1,50),
							
							"price" 			=> rand(50,200),			
							"old_price" 		=> rand(10,500),
							
							"featured" => rand(0,1),
							  
							
						), 
						
						"tax" => array("listing", "store"),						
						
				);
			
			
			} break;
			
			
			case "learning": {
			
			
				
			// RANDOM CONTENT
			$randomeTitle = array(
					1 => "Your Complete Guide to Photography", 
					2 => "Learn Python - Interactive Python Tutorial", 
					3 => "From Zero to Hero with Nodejs",
					4 => "HTML5/CSS3 Essentials in 4-Hours",
					5 => "The Art of Black and White Photography",
					6 => "Become a PHP Master and Make Money Fast",
					7 => "Learning jQuery Mobile for Beginners",
					8 => "Getting Started with LESS - Beginner Crash",
					9 => "Improve Your CSS Workflow with SASS",
					10 => "Complete Beginner to JavaScript Developer",
					11 > "HTML Tutorial: HTML & CSS for Beginners",					
					12 => "Learn Python - Interactive Python Tutorial", 
					13 => "From Zero to Hero with Nodejs",
					14 => "HTML5/CSS3 Essentials in 4-Hours",
					15 => "The Art of Black and White Photography",
					16 => "Become a PHP Master and Make Money Fast",
					17 => "Learning jQuery Mobile for Beginners",
					18 => "Getting Started with LESS - Beginner Crash",
					19 => "Improve Your CSS Workflow with SASS",
					20 => "Complete Beginner to JavaScript Developer", 
				  
			); 
			 
			 	 $itemdata[$i] = array(
				
						"name" 	=> $randomeTitle[$i], 
						
						"data" => array(
						
							"backgroundimg" => rand(1,14),
							
							"hits" 			=> rand(0,10000),  
							
							"price"	=> "0",
							
							//"youtube_id"	=> "H3K9y8ptQ0s",
							
							"download_path" 	=> "https://www.premiumpress.com/_demoimages/softwaretheme/example.zip",
							
							"req" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
							
							
							"image" => "?imgid=".$i, 
							
						 							 
						), 
						
						"tax" => array("listing","level","language","features"),						
						
				); 
				 
			} break;
			
			
			case "photography": {
			 
			 	 $itemdata[$i] = array(
				
						"name" 	=> "Example File ".$i,						 
						
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
						  				 
							"hits" 			=> rand(0,10000),	 
							
							"videoaccess" 	=> array(0 => "loggedin", 1 => "subs" , 2 => 1, 3 => 2 ),
						 
							 "camera_model" => " Mark 3",
							 
							 "image" => "?imgid=".$i,
							 
						), 
						
						"tax" => array("listing","orientation","features","license","cameratype"),						
						
				); 
				 
			} break;
			case "software": {
			 
					$itemdata[$i] = array(
					
							"name" 	=> "Example Download ".$i,							
							"data" => array(				
								 
								 
								"price_cart" 		=> rand(0,50),	
								
								"hits" 				=> rand(1000,10000),	
								"price" 			=> rand(50,200),			
								"old_price" 		=> rand(10,500),		
								"download_count" 	=> rand(0,100),
								
								"version" 	=> rand(1,5).".".rand(0,9),	
								
								"videoaccess" 	=> array(0 => "loggedin", 1 => "subs" , 2 => 1, 3 => 2 ),
								 
								"type" 				=> "3",
								
								"examplefield" => "example value",
								
								"url" 				=> "https://www.premiumpress.com/",
								"url_demo" 			=> "https://www.premiumpress.com/?demo=123",
								
								"download_path" 	=> "https://www.premiumpress.com/_demoimages/softwaretheme/example.zip",
								
								"image" => "?imgid=".$i,
								
								//"youtube_id"	=> "MCss1QxIeQI",
								 
							 
							),	
							
							
							"tax" => array("listing","features","system","store"),			
							 
					);	
 		
			} break;
			
			case "realestate": {	
			
			
		 		 $businesshours = array(
				'start' => array
					(
						0 => '09:00',
						1 => '09:00',
						2 => '12:00',
						3 => '09:45',
						4 => '09:00',
						5 => '09:00',
						6 => '06:45',
					),
			
				'end' => array
					(
						0 => '18:00',
						1 => '18:00',
						2 => '18:00',
						3 => '18:00',
						4 => '18:00',
						5 => '18:00',
						6 => '18:00',
					),
			
				'active' => array
					(
						0 => rand(0,1),
						1 => rand(0,1),
						2 => rand(0,1),
						3 => rand(0,1),
						4 => rand(0,1),
						5 => rand(0,1),
						6 => rand(0,1),
					),
			
			);
					$itemdata[$i] = array(
					
							"name" 	=> "Example Property ".$i,							
							"data" => array(					 
								"hits" 			=> rand(0,10000),			
								"price" 		=> rand(0,100000),		
								"size" 			=> rand(0,10000),								
								"packageID" 	=> rand(0,2),						
								"map-country" 	=> $locations[$i][0],			
								"map-city" 		=> $locations[$i][1],
								"map-area" 		=> $locations[$i][2],
								"map-location" 	=> $locations[$i][3],
								"map-log" 		=> $locations[$i][4],
								"map-lat" 		=> $locations[$i][5],
								"map-zip" 		=> $locations[$i][6],
								
								"image" => "?imgid=".$i,
								
								
								//"youtube_id"	=> "LxZNe9-nwSQ",
								
								"businesshours" => 	$businesshours,
								
							),
							
							"tax" => array("beds","baths","type","listing","features","parking","garden"),
					);				
			} break;
			case "compare": {			
			
					$ss = array_values($randomarray['store']);
					 
					
					$cd = array(
						"store" => array($ss[0],$ss[1],$ss[2],$ss[3],$ss[4]),						 
						"price" => array(rand(100, 1000),rand(100, 1000),rand(100, 10000),rand(100, 10000),rand(100, 10000)),
						"link" => array("https://premiumpress.com","https://premiumpress.com","https://premiumpress.com","https://premiumpress.com","https://premiumpress.com"),
					);
					
					$_POST['admin_values']['storeimage_'.$ss[0]] = DEMO_IMG_PATH."cm/stores/1.jpg";
					$_POST['admin_values']['storeimage_'.$ss[1]] = DEMO_IMG_PATH."cm/stores/2.jpg";
					$_POST['admin_values']['storeimage_'.$ss[2]] = DEMO_IMG_PATH."cm/stores/3.jpg";
					$_POST['admin_values']['storeimage_'.$ss[3]] = DEMO_IMG_PATH."cm/stores/4.jpg";
					$_POST['admin_values']['storeimage_'.$ss[4]] = DEMO_IMG_PATH."cm/stores/5.jpg";
					$_POST['admin_values']['storeimage_'.$ss[4]] = DEMO_IMG_PATH."cm/stores/6.jpg";
					
					$_POST['admin_values']['storelink_'.$ss[0]] = "https://premiumpress.com";	
					$_POST['admin_values']['storelink_'.$ss[1]] = "https://premiumpress.com";	
					$_POST['admin_values']['storelink_'.$ss[2]] = "https://premiumpress.com";	
					$_POST['admin_values']['storelink_'.$ss[3]] = "https://premiumpress.com";	
					$_POST['admin_values']['storelink_'.$ss[4]] = "https://premiumpress.com";		
					$_POST['admin_values']['storelink_'.$ss[5]] = "https://premiumpress.com";			
					
					$_POST['admin_values']['category_description_'.$ss[0]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";
					$_POST['admin_values']['category_description_'.$ss[1]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";
					$_POST['admin_values']['category_description_'.$ss[2]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";
					$_POST['admin_values']['category_description_'.$ss[3]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";
					$_POST['admin_values']['category_description_'.$ss[4]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";					
					$_POST['admin_values']['category_description_'.$ss[5]] = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam.";	
					
					$_POST['admin_values']['storelinkaff_'.$ss[0]] = "https://premiumpress.com/?afflink=123";
					$_POST['admin_values']['storelinkaff_'.$ss[1]] = "https://premiumpress.com/?afflink=123";
					$_POST['admin_values']['storelinkaff_'.$ss[2]] = "https://premiumpress.com/?afflink=123";
					$_POST['admin_values']['storelinkaff_'.$ss[3]] = "https://premiumpress.com/?afflink=123";
					$_POST['admin_values']['storelinkaff_'.$ss[4]] = "https://premiumpress.com/?afflink=123";
					$_POST['admin_values']['storelinkaff_'.$ss[5]] = "https://premiumpress.com/?afflink=123"; 
					
					// GET THE CURRENT VALUES
					$existing_values = get_option("core_admin_values");
					// MERGE WITH EXISTING VALUES
					$new_result = array_merge((array)$existing_values, (array)$_POST['admin_values']);
					// UPDATE DATABASE 		
					update_option( "core_admin_values", $new_result);
					
					
					
					$products = array(
						
						1 => array(							
							"name" => "Sony Alpha a7",
							"asin" => "",
							"price" => "1000",
							"keywords" => array("Sony Alpha","a7","body"),													
						),
						2 => array(							
							"name" => "SanDisk 128GB Extreme PRO Card",
							"asin" => "B07H9DVLBB",
							"price" => "29.99",	
							"keywords" => array(""),												
						),
						3 => array(							
							"name" => "Camer Bag",
							"asin" => "",
							"price" => "19.99",	
							"keywords" => array(""),													
						),
						4 => array(							
							"name" => "GoPro Head Strap",
							"asin" => "",
							"price" => "B00F19PYR4",
							"keywords" => array(""),													
						),
						5 => array(							
							"name" => "BAGSMART SLR DSLR Canvas Camera Case",
							"asin" => "",
							"price" => "19.99",
							"keywords" => array(""),													
						),					
						
						6 => array(							
							"name" => "HDMI Cable",
							"asin" => "",
							"price" => "29.99",	
							"keywords" => array(""),													
						),
						7 => array(							
							"name" => "Camera Case",
							"asin" => "",
							"price" => "102.99",
							"keywords" => array(""),													
						),
						8 => array(							
							"name" => "Canon PowerShot Digital Camera",
							"asin" => "",
							"price" => "19.99",
							"keywords" => array(""),													
						),
						9 => array(							
							"name" => "ScanDisk 32 GB",
							"asin" => "",
							"price" => "50.99",
							"keywords" => array(""),													
						),
						10 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "258.99",
							"keywords" => array(""),													
						),
						
						11 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "480.99",
							"keywords" => array(""),													
						),
						
						12 => array(							
							"name" => "Lumix Camera",
							"asin" => "45.99",
							"price" => "",
							"keywords" => array(""),													
						),
						
						13 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "567.99",
							"keywords" => array(""),														
						),
						
						14 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),														
						),
						
						15 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),													
						),
						
						16 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),													
						),
						
						17 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),													
						),
						
						18 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),														
						),
						
						19 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),														
						),
						20 => array(							
							"name" => "Lumix Camera",
							"asin" => "",
							"price" => "344.88",
							"keywords" => array(""),													
						),
					
					
					);
					 
			
					$itemdata[$i] = array(
					
							"name" 	=> "Example Product ".$i,							
							"data" => array(
								 
								//"packageID" 	=> rand(0,2),	
								"hits" 		=> rand(0,10000),			
								"price" 	=> $products[$i]['price'],
								"keywords" 	=> $products[$i]['keywords'],	
								 
								
								"asin"	=> $products[$i]['asin'],
								
								"sku" 	=> "PPT0".rand(1,9)."-".rand(100,200),
								
								"cm_verdict" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
								"cm_for" 	=> "Point One\nPoint Two\nPoint Three\nPoint Four",
								"cm_against" => "Point One\nPoint Two\nPoint Three\nPoint Four",
								"cm_rating" => "5", 
								
								"comparedata" => $cd,
								
								
								"buy_link" 	=> "https://www.premiumpress.com/",
								
								"image" => "?imgid=".$i,
								 
							),
							
							"tax" => array("color","size","listing","features","store"),
					);	
			
			
			} break;
			case "shop": {	
					
					$op = 0;
					if($i > 10){
					
					$op = rand(100,200);
					}
						 
					$itemdata[$i] = array(
					
							"name" 	=> "Example Product ".$i,							
							"data" => array(
								 
								"hits" 		=> rand(0,10000),			
								"price" 	=> rand(50,200),		
								"old_price" 	=> $op,
								
								"sku" 	=> "PPT0".rand(1,9)."-".rand(100,200),
								
								"image" => "?imgid=".$i,
								
								//"youtube_id"	=> "Df-QCbCYh0k",
							),
							
							"tax" => array("color","size","listing","delivery","sale","for"),
					);				
			} break;
 
			case "video": {
				$itemdata[$i] = array(
				
						"name" 	=> "Example Video ".$i,						 
						
						"data" => array(
							"packageID" 	=> rand(0,2),							
							"map-country" 	=> $locations[$i][0],			
							"map-city" 		=> $locations[$i][1],
							"map-area" 		=> $locations[$i][2],
							"map-location" 	=> $locations[$i][3],
							"map-log" 		=> $locations[$i][4],
							"map-lat" 		=> $locations[$i][5],
							"map-zip" 		=> $locations[$i][6],
											 
							"hits" 			=> rand(1000,100000),			
							"time" 			=> rand(1,1000),
							"level" 		=> rand(1,3),	
							"youtube_id"	=> "VGA1JxZCAOo",
							"videoaccess" 	=> array(0 => 1, 1 => 2 , 2 => 3 ),
							
							
							"image" => "?imgid=".$i,
							
						), 
						
						"tax" => array("listing","level","features"),
					 	
				);	 	
			} break;

			}
		}// END SWITCH	

 
$i++;
};

 
	 
$i=1; $importedListings = array();
foreach($itemdata as $car){

	if($car['name'] == ""){ continue; }	
	if(post_exists( $car['name'],'','','')){ continue; }
	
 
	$my_post = array();
	$my_post['post_title'] 		= $car['name'];
	
	
	
	 
	if(isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'], array("software","escort"))){
	
	$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>";			
		
	}elseif(isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'], array("shop","compare","directory"))){
	
	$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>";	
		
		
	}else{
	
	$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>";	

	}
	 
	
	$my_post['post_type'] 		= THEME_TAXONOMY."_type";
	$my_post['post_excerpt'] 	= "";
	
	$my_post['post_status'] 	= "publish";
	$my_post['post_category'] 	= "";
	if(isset($car['keywords'])){
	$my_post['tags_input'] 		= $car['keywords'];
	}else{
	$my_post['tags_input'] 		= array();
	}
	 //'tag1','tag2','tag3'
	$POSTID 					= wp_insert_post( $my_post );
	
	$importedListings[$i] = $POSTID;
 	 
 	foreach($car['data'] as $k => $g){
	
		add_post_meta($POSTID, $k, $g );
	
	}
	// BADGES
	update_post_meta($POSTID,"badges",array("1" => "1", "2" => "2", "3" => "3", "4" => "4"));
	
	// AWARDS
	update_post_meta($POSTID,"awards",array("1" => "1", "2" => "2", "3" => "3", "4" => "4"));
	
	// BACKGROUND
	update_post_meta($POSTID, "backgroundimg", rand(1,14) );
	
	update_post_meta($POSTID, "ppt-demo", "1" );
	
	// FEATURED AND SPONSORED
	if(in_array($_POST['admin_values']['template'], array("coupon") ) ){
		if( in_array($i, array(16,17,18,19,20)) ){
			update_post_meta($POSTID, "homepage", 1 );
		}
	}else{
		if( in_array($i, array(1,3,4,3,6,7,8,12,14,16,17,19)) ){
		
			update_post_meta($POSTID, "sponsored", 1 );
		
		}elseif( in_array($i, array(6,8,11,15,7)) ){
		
			update_post_meta($POSTID, "featured", 1 );
		}
	}
	 
	 
 	
 	foreach($car['tax'] as $k){
	 
		// GET RANDOM VALUE FROM MAIN LIST	 
		if(isset($randomarray[$k]) ){
		
			$rand_keys = array_rand($randomarray[$k], 1);
			
			if($k == "features"){
		 	
			wp_set_post_terms( $POSTID, $randomarray[$k], $k );
			
			}else{
			
				if($k == "listing" && in_array($_POST['admin_values']['template'], array("classifieds","exchange","coupon") ) ){
			 
				$rand_keys = $randomarray[$k]; 
				
				}elseif($k == "dagender"){
				 
				
					if($_POST['admin_values']['template'] == "escort"){
						$rand_keys = $nameLink["dagender-femaleescort"];
					}else{
					
					if($i < 11){
					$rand_keys = $nameLink["dagender-male"];
				 	}else{
					$rand_keys = $nameLink["dagender-female"];
					} 
					
					}
					 
				} 
			
				wp_set_post_terms( $POSTID, $rand_keys, $k );
 				
			}			
			
		}
	
	}
 	
$i++;		
} // end foreach


	
		$nusers = array(
			
			1 => array("name" => "James Black", "pass" => "password", "email" => "jblack@gmail.com", "photo" => DEMO_IMG_PATH."/user/1.jpg", "youtube" => "DB0HDumBAH4", "info" => "I am well-balanced and stable, but willing to let you knock me off my feet."),
			2 => array("name" => "John Forth", "pass" => "password", "email" => "jforth@gmail.com", "photo" => DEMO_IMG_PATH."/user/2.jpg", "youtube" => "-jL5vzGmU-k", "info" => "I am old fashioned sometimes. I still believe in romance, in roses, in holding hands."),
			3 => array("name" => "Tim Green", "pass" => "password", "email" => "tgreen@gmail.com", "photo" => DEMO_IMG_PATH."/user/3.jpg", "youtube" => "DZYXleNfqc0", "info" => "I don't smoke, drink or party every weekend. I don't play around or start drama to get attention. Yes, we do still exist!"),
			4 => array("name" => "Kai Rashford", "pass" => "password", "email" => "krashford@gmail.com", "photo" => DEMO_IMG_PATH."/user/4.jpg", "youtube" => "lbIAFwGJL8I", "info" => "I'm going to make the rest of my life the best of my life. Care to share it with me?"),
			
			5 => array("name" => "Jane Cross", "pass" => "password", "email" => "jcross@gmail.com", "photo" => DEMO_IMG_PATH."/user/5.jpg", "youtube" => "_71XmzANVow", "info" => "I am strong, kind, smart, hilarious, sweet, lovable, and amazing. Isn't that what you've been looking for?"),
			6 => array("name" => "Sarah Smith", "pass" => "password", "email" => "ssmith@gmail.com", "photo" => DEMO_IMG_PATH."/user/6.jpg", "youtube" => "wD3YltuTUwE", "info" => "I'm neither especially clever nor especially gifted, except for when it comes to being your perfect other half." ),
			7 => array("name" => "Karren Ronbinson", "pass" => "password", "email" => "krobinson@gmail.com", "photo" => DEMO_IMG_PATH."/user/7.jpg", "youtube" => "cCFQDNISUbY", "info" => "I want to inspire and be inspired.",),
			8 => array("name" => "Maria Brown", "pass" => "password", "email" => "mbrown@gmail.com", "photo" => DEMO_IMG_PATH."/user/8.jpg", "youtube" => "T7qvWrbXKG8", "info" => "I find that having a dirty mind makes ordinary conversations much more interesting." ),  
		
		);
		

if( isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'],array("photography", "learning", "project")) ){

		$nusers = array(
			
			1 => array("name" => "James Black", "pass" => "password", "email" => "jblack@gmail.com", "photo" => DEMO_IMG_PATH."/user/1.jpg", "youtube" => "DB0HDumBAH4", "info" => "I am well-balanced and stable, but willing to let you knock me off my feet."),
			2 => array("name" => "John Forth", "pass" => "password", "email" => "jforth@gmail.com", "photo" => DEMO_IMG_PATH."/user/2.jpg", "youtube" => "-jL5vzGmU-k", "info" => "I am old fashioned sometimes. I still believe in romance, in roses, in holding hands."),
			3 => array("name" => "Tim Green", "pass" => "password", "email" => "tgreen@gmail.com", "photo" => DEMO_IMG_PATH."/user/3.jpg", "youtube" => "DZYXleNfqc0", "info" => "I don't smoke, drink or party every weekend. I don't play around or start drama to get attention. Yes, we do still exist!"),
			4 => array("name" => "Kai Rashford", "pass" => "password", "email" => "krashford@gmail.com", "photo" => DEMO_IMG_PATH."/user/4.jpg", "youtube" => "lbIAFwGJL8I", "info" => "I'm going to make the rest of my life the best of my life. Care to share it with me?"),
			
			5 => array("name" => "Jane Cross", "pass" => "password", "email" => "jcross@gmail.com", "photo" => DEMO_IMG_PATH."/user/5.jpg", "youtube" => "_71XmzANVow", "info" => "I am strong, kind, smart, hilarious, sweet, lovable, and amazing. Isn't that what you've been looking for?"),
			6 => array("name" => "Sarah Smith", "pass" => "password", "email" => "ssmith@gmail.com", "photo" => DEMO_IMG_PATH."/user/6.jpg", "youtube" => "wD3YltuTUwE", "info" => "I'm neither especially clever nor especially gifted, except for when it comes to being your perfect other half." ),
			7 => array("name" => "Karren Ronbinson", "pass" => "password", "email" => "krobinson@gmail.com", "photo" => DEMO_IMG_PATH."/user/7.jpg", "youtube" => "cCFQDNISUbY", "info" => "I want to inspire and be inspired.",),
			8 => array("name" => "Maria Brown", "pass" => "password", "email" => "mbrown@gmail.com", "photo" => DEMO_IMG_PATH."/user/8.jpg", "youtube" => "T7qvWrbXKG8", "info" => "I find that having a dirty mind makes ordinary conversations much more interesting."),
			
			
			9 => array("name" => "Sammy", "pass" => "password", "email" => "sammy@gmail.com", "photo" => DEMO_IMG_PATH."/user/9.jpg", "youtube" => "", "info" => ""),
			
			10 => array("name" => "Taylor", "pass" => "password", "email" => "Taylor@gmail.com", "photo" => DEMO_IMG_PATH."/user/10.jpg", "youtube" => "", "info" => ""),
			11 => array("name" => "Rosie", "pass" => "password", "email" => "Rosie@gmail.com", "photo" => DEMO_IMG_PATH."/user/11.jpg", "youtube" => "", "info" => ""),
			12 => array("name" => "Josie", "pass" => "password", "email" => "Josie@gmail.com", "photo" => DEMO_IMG_PATH."/user/12.jpg", "youtube" => "", "info" => ""),
			13 => array("name" => "Aiden", "pass" => "password", "email" => "Aiden@gmail.com", "photo" => DEMO_IMG_PATH."/user/13.jpg", "youtube" => "", "info" => ""),
			14 => array("name" => "Scarlet", "pass" => "password", "email" => "Scarlet@gmail.com", "photo" => DEMO_IMG_PATH."/user/14.jpg", "youtube" => "", "info" => ""),
			15 => array("name" => "Syeda", "pass" => "password", "email" => "Syeda@gmail.com", "photo" => DEMO_IMG_PATH."/user/15.jpg", "youtube" => "", "info" => ""),
			
			16 => array("name" => "Alistair", "pass" => "password", "email" => "Luke@gmail.com", "photo" => DEMO_IMG_PATH."/user/16.jpg", "youtube" => "", "info" => ""),
			17 => array("name" => "Luke", "pass" => "password", "email" => "mbrown@gmail.com", "photo" => DEMO_IMG_PATH."/user/17.jpg", "youtube" => "", "info" => ""),
			18 => array("name" => "Haris", "pass" => "password", "email" => "Haris@gmail.com", "photo" => DEMO_IMG_PATH."/user/18.jpg", "youtube" => "", "info" => ""),
			19 => array("name" => "Ibrahim", "pass" => "password", "email" => "Ibrahim@gmail.com", "photo" => DEMO_IMG_PATH."/user/19.jpg", "youtube" => "", "info" => ""),
		 
		);		
}
		
		
		if( isset($_POST['admin_values']['template']) && in_array($_POST['admin_values']['template'],array("realestate")) ){
		$nusers[1]["photo"] = _ppt_demopath()."/agent1.jpg";
		$nusers[2]["photo"] = _ppt_demopath()."/agent2.jpg";
		$nusers[3]["photo"] = _ppt_demopath()."/agent3.jpg";
		$nusers[4]["photo"] = _ppt_demopath()."/agent4.jpg";
		$nusers[5]["photo"] = _ppt_demopath()."/agent5.jpg";
		$nusers[6]["photo"] = _ppt_demopath()."/agent6.jpg";
		$nusers[7]["photo"] = _ppt_demopath()."/agent7.jpg";
		$nusers[8]["photo"] = _ppt_demopath()."/agent8.jpg";
		}
		


/***********************************************************************************/
$GLOBALS['theme_defaults']['design']['preload'] = "1";

if( isset($_POST['admin_values']['template']) && !in_array($_POST['admin_values']['template'],array("shop")) ){

if(in_array($_POST['admin_values']['template'],array("dating")) ){
 
	$GLOBALS['theme_defaults']['lst']['default_catsbox'] = "0";
 
}

$GLOBALS['theme_defaults']['mem1_name']  = "Free Membership";
$GLOBALS['theme_defaults']['mem2_name']  = "Silver Membership";
$GLOBALS['theme_defaults']['mem3_name']  = "Gold Membership";

$GLOBALS['theme_defaults']['mem1_price']  = "10";
$GLOBALS['theme_defaults']['mem2_price']  = "20";
$GLOBALS['theme_defaults']['mem3_price']  = "50";

$GLOBALS['theme_defaults']['mem1_desc']  = "Free for 24 hour access!";
$GLOBALS['theme_defaults']['mem2_desc']  = "$20 for 1 months access!";
$GLOBALS['theme_defaults']['mem3_desc']  = "$50 for 6 months access!";

$GLOBALS['theme_defaults']['mem1_duration']  = "1";
$GLOBALS['theme_defaults']['mem2_duration']  = "30";
$GLOBALS['theme_defaults']['mem3_duration']  = "180";

$GLOBALS['theme_defaults']['mem1_icon']  = "fa fa-star";
$GLOBALS['theme_defaults']['mem2_icon']  = "fa fa-crown";
$GLOBALS['theme_defaults']['mem3_icon']  = "fa fa-flame";

$GLOBALS['theme_defaults']['mem1_enable']  = "1";
$GLOBALS['theme_defaults']['mem2_enable']  = "1";
$GLOBALS['theme_defaults']['mem3_enable']  = "1";  
 
}


/***********************************************************************************/


	$GLOBALS['theme_defaults']['search']["filters_country"] = 0; 			
	$GLOBALS['theme_defaults']['search']["filters_countrylist"] = 0; 
	$GLOBALS['theme_defaults']['search']["filters_citylist"] = 0; 
			
	$GLOBALS['theme_defaults']['lst']["addon_featured_enable"] = 1;
	$GLOBALS['theme_defaults']['lst']["addon_sponsored_enable"] = 1;
	$GLOBALS['theme_defaults']['lst']["addon_homepage_enable"] = 1; 
	$GLOBALS['theme_defaults']['lst']["addon_boost_enable"] = 1; 
	
	$GLOBALS['theme_defaults']['lst']["addon_featured_price"] = 10;
	$GLOBALS['theme_defaults']['lst']["addon_sponsored_price"] = 30;
	$GLOBALS['theme_defaults']['lst']["addon_homepage_price"] = 50; 
	$GLOBALS['theme_defaults']['lst']["addon_boost_price"] 	= 5; 
	
	$GLOBALS['theme_defaults']['lst']["addon_featured_days"] = 30;
	$GLOBALS['theme_defaults']['lst']["addon_sponsored_days"] = 30;
	$GLOBALS['theme_defaults']['lst']["addon_homepage_days"] = 30; 
	$GLOBALS['theme_defaults']['lst']["addon_boost_days"] = 24; 
	
	//$GLOBALS['theme_defaults']['lst']['default_listing_status'] = "pending";
	 
	
	$GLOBALS['theme_defaults']['pak0_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['pak0_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['pak0_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['pak0_txt4'] = "my own text here";
		
	$GLOBALS['theme_defaults']['pak1_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['pak1_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['pak1_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['pak1_txt4'] = "my own text here";
	 	
	$GLOBALS['theme_defaults']['pak2_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['pak2_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['pak2_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['pak2_txt4'] = "my own text here";

	
	// MEMBERSHIPS
	$GLOBALS['theme_defaults']['mem1_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['mem1_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['mem1_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['mem1_txt4'] = "my own text here";
		
	$GLOBALS['theme_defaults']['mem2_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['mem2_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['mem2_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['mem2_txt4'] = "my own text here";
	 	
	$GLOBALS['theme_defaults']['mem3_txt1'] = "my own text here";
	$GLOBALS['theme_defaults']['mem3_txt2'] = "my own text here";
	$GLOBALS['theme_defaults']['mem3_txt3'] = "my own text here";
	$GLOBALS['theme_defaults']['mem3_txt4'] = "my own text here";
	
	
	$GLOBALS['theme_defaults']['pak0_icon'] = "fa fa-smile";	
	$GLOBALS['theme_defaults']['pak1_icon'] = "fa fa-star";
	$GLOBALS['theme_defaults']['pak2_icon'] = "fa fa-cube";
	
	$GLOBALS['theme_defaults']['mem1_price'] 	= "25";
	$GLOBALS['theme_defaults']['mem2_price'] 	= "50";
	$GLOBALS['theme_defaults']['mem3_price'] 	= "75";
		
	$GLOBALS['theme_defaults']['user']["ratings"] = 1;
	
	// SELL SPACE		
	$GLOBALS['theme_defaults']['sellspace']["enable"] = 1; 
			
	foreach($CORE->ADVERTISING("get_spaces", array() ) as $key => $ban){
				
		if(!in_array($key, array("blog_top","blog_bottom","search_middle", "search_bottom", "search_sidebar_top", "search_sidebar_bottom")) ){ continue; } //, "single_sidebar" "search_top", 
			
		$GLOBALS['theme_defaults']['sellspace'][$key] = 1;
		$GLOBALS['theme_defaults']['sellspace'][$key."_sample"] = 0;
		$GLOBALS['theme_defaults']['sellspace'][$key."_size"] = $ban['sw']."x".$ban['sh'];
		$GLOBALS['theme_defaults']['sellspace'][$key."_price"] = 30;
		$GLOBALS['theme_defaults']['sellspace'][$key."_days"] = 30;
		$GLOBALS['theme_defaults']['sellspace'][$key."_name"] = $ban['n'];
		$GLOBALS['theme_defaults']['sellspace'][$key."_desc"] = "";
		 
			
	} 
	 
	
	if($_POST['admin_values']['template'] == "micro"){
	
	$commentdata = array(
	
	"1" => array("rating" => "5", "comment" => "Amazing - This seller is awesome." ),
	"2" => array("rating" => "5", "comment" => "I honestly can't find another seller who is as professional, considerate, and creative as her. " ),
	"3" => array("rating" => "4.6", "comment" => "Highly professional and brought my brand to life. Will be working with them in the future!" ),
	"4" => array("rating" => "3.2", "comment" => "Such a talent and has done an exceptional job! A big thank you - and can't wait to continue working with you!" ),
	"5" => array("rating" => "5", "comment" => "A++ Highly Recommended." ),
	"6" => array("rating" => "5", "comment" => "Love it! Will come again." ),
	"7" => array("rating" => "4.4", "comment" => "Simply the best." ),
	"8" => array("rating" => "4.7", "comment" => "We had lot's of fun on this project, looking forward to our next one." ), 
	);
	
	}elseif(in_array($_POST['admin_values']['template'],array("directory"))){
	
	$commentdata = array(
	
	"1" => array("rating" => "5", "comment" => "Amazing - I really had a great time. Thank you." ),
	"2" => array("rating" => "5", "comment" => "Can't wait to visit again. Some great memeories had here." ),
	"3" => array("rating" => "1.6", "comment" => "I didnt have a great experinece. I wont be using their services anymore." ),
	"4" => array("rating" => "3.", "comment" => "Needs Improvement. I don't want to be rude but this wasnt good, their services need improvement." ),
	"5" => array("rating" => "5", "comment" => "A++ Highly Recommended." ),
	"6" => array("rating" => "5", "comment" => "Love it here! Will come again." ),
	"7" => array("rating" => "4.4", "comment" => "Simply the best." ),
	"8" => array("rating" => "4.7", "comment" => "We had lot's of fun, looking forward to our next one." ), 
	);
	
	}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!in_array($_POST['admin_values']['template'], array("auction","dating","escort") ) ){ 
$ic = 1;
foreach($nusers as $user){

if(email_exists( $user['email'] )){ 
 

			if(in_array($_POST['admin_values']['template'], array("photography", "learning", "project" ) ) ){ 
			
				$us = get_user_by( 'email', $user['email']  );				
				$user_id = $us->data->ID;
				
				$my_post = array();
				$my_post['ID'] = $importedListings[$ic];				
				$my_post['post_author'] = $user_id;				 
				wp_update_post( $my_post );				 
				
				update_user_meta( $user_id, "userphoto", array('img' => $user['photo']));	
				
				if(in_array($_POST['admin_values']['template'], array("learning" ) ) ){ 
				update_post_meta($my_post['ID'], 'youtube_id', $user['youtube'] );
				}
			
			}
			
 
}else{
		
			$user_id = wp_create_user( $user['name'], $user['pass'], $user['email'] );				
			if ( is_wp_error( $user_id  ) ) {				
				$us = get_user_by( 'email', $user['email']  );				
				$user_id = $us->data->ID;
			}
			
			// COMMENTS
			if(isset($commentdata)){
			
				$data = array(
					'comment_post_ID' => $importedListings[$ic],
					'comment_author' => $user['name'],
					'comment_author_email' => 'admin@admin.com',
					'comment_author_url' => 'http://',
					'comment_content' => $commentdata[$ic]['comment'],
					'comment_type' => '',
					'comment_parent' => 0,
					'user_id' => $user_id,
					'comment_author_IP' => "",
					'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
					'comment_date' => current_time('mysql'),
					'comment_approved' => 1,
				);
				
				$commentid = wp_insert_comment($data);
	
				// SAVE COMMEN META INCASE WE DELETE IT	
				
				add_comment_meta( $commentid, 'ratingtotal', $commentdata[$ic]['rating'] );
				add_comment_meta( $commentid, 'rating1', $commentdata[$ic]['rating'] );
				//add_comment_meta( $commentid, 'feedback', 1 );
				add_comment_meta( $commentid, 'ratingpid', $importedListings[$ic] );
				
				// SAVE RESULTS
				update_post_meta($importedListings[$ic], 'starrating', $commentdata[$ic]['rating']);
				update_post_meta($importedListings[$ic], 'starrating_total', $commentdata[$ic]['rating']);
				update_post_meta($importedListings[$ic], 'starrating_votes', 1);
			
			}//////////////////////	 
			
			
			update_user_meta( $user_id, "userphoto", array('src' => $user['photo'], 'img' => $user['photo'], "aid" =>0 ));	
			update_user_meta( $user_id, 'ppt_verified', 1);	
			update_user_meta( $user_id, 'phone', "+020 4447 33821");
			 
			$ggtypes = array("user_fr", "user_em");
			$ut = $ggtypes[rand(0,1)];
			update_user_meta( $user_id, 'user_type', $ut);	
			
			update_user_meta( $user_id, 'login_lastdate', date('Y-m-d H:i:s', strtotime( current_time( 'mysql' ) )  ) );	
		 
 			
			if(in_array($_POST['admin_values']['template'], array("photography", "learning", "project" ) ) ){ 
				
				$my_post = array();
				$my_post['ID'] = $importedListings[$ic];				
				//$my_post['post_title'] = get_the_title($importedListings[$ic]);	
				$my_post['post_author'] = $user_id;				 
				wp_update_post( $my_post );				 
				
				update_user_meta( $user_id, "userphoto", array('img' => $user['photo']));	
				
				if(in_array($_POST['admin_values']['template'], array("learning" ) ) ){ 
				update_post_meta($my_post['ID'], 'youtube_id', $user['youtube'] );
				}
			
			
			}elseif(in_array($_POST['admin_values']['template'], array("dating","escort") ) ){ 
				
				//$my_post = array();
				//$my_post['ID'] = $importedListings[$ic];				
				//$my_post['post_title'] = get_the_title($importedListings[$ic]);	
				//$my_post['post_author'] = $user_id;				 
				//wp_update_post( $my_post );
				
				//update_user_meta( $user_id, "userphoto", array('img' => $user['photo']));	
				 
		  
					
					 
			}elseif($_POST['admin_values']['template'] == "exchange"){
			
			
				update_user_meta( $user_id, 'country', "US");
				update_user_meta( $user_id, 'city', "New York");
			
				$my_post = array(
						'post_type'		=> 'listing_type',
						'post_title' 	=> __("My Profile","premiumpress")." - ".$user['name'],
						'post_modified' => current_time( 'mysql' ),
						'post_excerpt' => 'Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. ',
						'post_content' 	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget tag2. <br><br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget tag1.  <br><br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget tag3.  ',
						'post_author' 	=> $user_id,
					);	
					 				
					$my_post['post_status'] 	= "publish"; 
					$POSTID = wp_insert_post( $my_post );	
					 
					
					$rand_keys = array_rand($randomarray["listing"], 1);
					
					wp_set_post_terms( $POSTID, $rand_keys, "listing" );
					
					update_post_meta($POSTID, 'youtube_id', $user['youtube'] );
					
					
					if($ut == "user_em"){
					update_post_meta($POSTID, 'user_type', "user_em");
					}else{
					update_post_meta($POSTID, 'user_type', "user_fr");
					}
					
			
			}else{
			
			update_user_meta( $user_id, 'pj_rate', rand(5,50));	
			
			}
			
			$ic++;
		
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	
		
			if(in_array($_POST['admin_values']['template'], array("dating","escort")) ){ 
			
			//$GLOBALS['theme_defaults']['mem']["enable"] = 1;
		 
		 	//$GLOBALS['theme_defaults']['lst']["websitepackages"] = 1;
			
			
			$GLOBALS['theme_defaults']['mem0_msg_send'] = 0;
			$GLOBALS['theme_defaults']['mem0_view_photos'] = 0;
			$GLOBALS['theme_defaults']['mem0_view_videos'] = 0; 
			
			 
			
			if(in_array($_POST['admin_values']['template'], array("photography")) ){ 
			
			$GLOBALS['theme_defaults']['mem']["enable"] = 1;
			
			$GLOBALS['theme_defaults']['lst']["websitepackages"] = 1;
			
			$GLOBALS['theme_defaults']['pak0_enable'] = 0;
			$GLOBALS['theme_defaults']['pak1_enable'] = 0;
			$GLOBALS['theme_defaults']['pak2_enable'] = 0;
			
			
			}
			
			
			if(in_array($_POST['admin_values']['template'], array("learning")) ){ 
					 
				$GLOBALS['theme_defaults']['searchtax']['0'] = "levels";
				$GLOBALS['theme_defaults']['searchtax']['1'] = "language";					 
				$GLOBALS['theme_defaults']['taxorder']['levels'] = "1";
				$GLOBALS['theme_defaults']['taxorder']['language'] = "2";				
			 			
				
		  	}
		 
			$GLOBALS['theme_defaults']['searchtax']['0'] = "dagender";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "1";
		 	
			$GLOBALS['theme_defaults']['searchtax']['2'] = "dasexuality";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "3";
			
			$GLOBALS['theme_defaults']['searchtax']['3'] = "dathnicity";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "4";
			
			$GLOBALS['theme_defaults']['searchtax']['4'] = "daeyes";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "5";
			
			$GLOBALS['theme_defaults']['searchtax']['5'] = "dahair";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "6";
			
			$GLOBALS['theme_defaults']['searchtax']['6'] = "dabody";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "7";
			
			$GLOBALS['theme_defaults']['searchtax']['7'] = "dasmoke";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "8";
			
			$GLOBALS['theme_defaults']['searchtax']['8'] = "dadrink";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "9";
			
			$GLOBALS['theme_defaults']['searchtax']['9'] = "dastarsign";			 
			$GLOBALS['theme_defaults']['dagender']['level'] = "10";
		
			}
			
			
			if(in_array($_POST['admin_values']['template'], array("classifieds", "directory")) ){ 
			
			$GLOBALS['theme_defaults']['mem']["enable"] = 1;
		 	$GLOBALS['theme_defaults']['lst']["websitepackages"] = 1;
			
			}
			
			
			
	 	
			if(in_array($_POST['admin_values']['template'], array("software")) ){ 
			
			$GLOBALS['theme_defaults']['mem']["enable"] = 1;
		 
		 	$GLOBALS['theme_defaults']['lst']["websitepackages"] = 0;
		
			$GLOBALS['theme_defaults']['lst']["requirelogin_downloads"] = 1;
			//$GLOBALS['theme_defaults']['lst']["hide_featuredimage"] = 1;

			
			}
			
			if(in_array($_POST['admin_values']['template'], array("realestate")) ){ 
			
			$GLOBALS['theme_defaults']['searchtax']['0'] = "beds";
			$GLOBALS['theme_defaults']['searchtax']['1'] = "baths";
			$GLOBALS['theme_defaults']['searchtax']['2'] = "type";
			
			$GLOBALS['theme_defaults']['taxorder']['beds'] = "2";
			$GLOBALS['theme_defaults']['taxorder']['baths'] = "3";
			$GLOBALS['theme_defaults']['taxorder']['type'] = "1";
			$GLOBALS['theme_defaults']['taxorder']['features'] = "4";
			 

			}
			
			if(in_array($_POST['admin_values']['template'], array("auction")) ){ 
			
			$GLOBALS['theme_defaults']['searchtax']['0'] = "condition";			 
			$GLOBALS['theme_defaults']['taxorder']['condition'] = "1";
			
			$GLOBALS['theme_defaults']['searchtax']['1'] = "color";	
			$GLOBALS['theme_defaults']['searchtax']['2'] = "store";	
					 
			$GLOBALS['theme_defaults']['taxorder']['color'] = "1";
			$GLOBALS['theme_defaults']['taxorder']['store'] = "2";
			
			//$GLOBALS['theme_defaults']['mem']["enable"] = 1;
		 	$GLOBALS['theme_defaults']['lst']["websitepackages"] = 1; 
			 

			}
			
			
			if(in_array($_POST['admin_values']['template'], array("jobs")) ){ 
			
			$GLOBALS['theme_defaults']['searchtax']['0'] = "jobtype";			 
			$GLOBALS['theme_defaults']['taxorder']['jobtype'] = "1";
			 

			}
			 
		 

			if(in_array($_POST['admin_values']['template'], array("video")) ){ 
			
			$GLOBALS['theme_defaults']['mem']["enable"] = 1;
		 	$GLOBALS['theme_defaults']['lst']["websitepackages"] = 0;	
				
			$GLOBALS['theme_defaults']['searchtax']['0'] = "level";			 
			$GLOBALS['theme_defaults']['taxorder']['level'] = "1";
			
			$GLOBALS['theme_defaults']['pak0_videos'] = 1;
			$GLOBALS['theme_defaults']['pak1_videos'] = 1;
			$GLOBALS['theme_defaults']['pak2_videos'] = 1;
			  
			
			
			foreach($importedListings as $vid){
			
			update_post_meta($vid, "vt_video1", $importedListings[1] );
			update_post_meta($vid, "vt_video2", $importedListings[2] );
			update_post_meta($vid, "vt_video3", $importedListings[3] );
			update_post_meta($vid, "vt_video4", $importedListings[4] );
			//update_post_meta($vid, "vt_video5", $importedListings[5] );
			//update_post_meta($vid, "vt_video6", $importedListings[6] );
			
			}		 

			}
 
		
			if(in_array($_POST['admin_values']['template'], array("compare")) ){ 
			
			$GLOBALS['theme_defaults']['searchtax']['0'] = "color";	
			$GLOBALS['theme_defaults']['searchtax']['1'] = "store";	
					 
			$GLOBALS['theme_defaults']['taxorder']['color'] = "1";
			$GLOBALS['theme_defaults']['taxorder']['store'] = "2"; 

			}
		
			if(in_array($_POST['admin_values']['template'], array("coupon")) ){ 

	 		 
			$GLOBALS['theme_defaults']['searchtax']['1'] = "store";	
			 
			$GLOBALS['theme_defaults']['taxorder']['store'] = "1";
			
			}
			
			if(in_array($_POST['admin_values']['template'], array("shop")) ){ 

			$GLOBALS['theme_defaults']['searchtax']['0'] = "color";			 
			$GLOBALS['theme_defaults']['taxorder']['color'] = "1";
			
			$GLOBALS['theme_defaults']['mem']["enable"] = 0;
		 	$GLOBALS['theme_defaults']['lst']["websitepackages"] = 0;
			
			$GLOBALS['theme_defaults']['user']["allow_profile"] = 0;
			
			
			
			}
		
			if(in_array($_POST['admin_values']['template'], array("cardealer")) ){ 
 			
			$GLOBALS['theme_defaults']['searchtax']['0'] = "make";			 
			$GLOBALS['theme_defaults']['taxorder']['make'] = "1";
			
			$GLOBALS['theme_defaults']['searchtax']['1'] = "model";			 
			$GLOBALS['theme_defaults']['taxorder']['model'] = "2";
			
			$GLOBALS['theme_defaults']['searchtax']['1'] = "condition";			 
			$GLOBALS['theme_defaults']['taxorder']['condition'] = "3";
		
			}

 

if(defined('WLT_DEMOMODE')){

$GLOBALS['theme_defaults']['maps']['enable'] = "1";
$GLOBALS['theme_defaults']['maps']['provider'] = "mapbox";
$GLOBALS['theme_defaults']['maps']['apikey'] = "pk.eyJ1IjoicHJlbWl1bXByZXNzIiwiYSI6ImNreGl1em91bDJuNTMycmt5bWV0MngxMXQifQ.1epsn8OSvrtt0lMAOZOckg";


$GLOBALS['theme_defaults']['emails']['user_verify']['enable'] = 1;
$GLOBALS['theme_defaults']['emails']['admin_user_new']['enable'] = 1;
$GLOBALS['theme_defaults']['emails']['admin_user_login']['enable']  = 1;
$GLOBALS['theme_defaults']['emails']['admin_user_login']['subject'] = "Demo Theme Login - (theme_key)";


}else{

$GLOBALS['theme_defaults']['maps']['enable'] = "1";
$GLOBALS['theme_defaults']['maps']['provider'] = "mapbox";
$GLOBALS['theme_defaults']['maps']['apikey'] = "";


} 
 

	$GLOBALS['theme_defaults']['newsletter']['enable'] = "1";
	$GLOBALS['theme_defaults']['newsletter']['newsdefault'] = "1";
	 
	
	// FINALLY, SAVE IT ALL AND UPDATE DATABASE 		
	update_option( "core_admin_values",  array_merge((array)get_option("core_admin_values"), $GLOBALS['theme_defaults'])); 	
	
	// FINISH
	$GLOBALS['error_message'] = "Example Information Installed";
 		
	 
}// END FUNCTION 

?>