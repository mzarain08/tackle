<?php

class framework_wp_templates extends framework_mobile {
  
 	
function handle_search_template($template) { global $post, $userdata, $CORE;
	 
		// SET FLAG
		$GLOBALS['flag-search'] = 1; 
		$GLOBALS['flag-searchpage'] = 1; 

		// CHECK FOR REDIRECT
		if(_ppt(array("search","mustlogin")) == 1 && !$userdata->ID){ 
	   
			$link = _ppt(array("search","mustlogin_link"));
			if($link == ""){
				$link = wp_login_url();
			}
			
			header("location: ".$link);
			exit(); 
		}
		
 	  
		return $template; 

}
	
	
function handle_taxonomy_template($template_dir) { global $post, $userdata, $wp_query, $CORE;
	 
  
	$GLOBALS['flag-taxonomy'] = 1;
	
	$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	 
	 
	$GLOBALS['flag-taxonomy-type'] 				= $term->taxonomy;
	$GLOBALS['flag-taxonomy-id'] 				= $term->term_id;
	$GLOBALS['flag-taxonomy-name'] 				= $term->name;
	$GLOBALS['flag-tax-'.$term->taxonomy] 		= 1;
	$GLOBALS['flag-taxonomy-parent'] 			= $term->parent;
	 
	
	if(isset($post->post_type)){
	
		switch($post->post_type){
		
			case "listing_type": { 
			
				$this->handle_search_template("");
				
			} break;
		}
	
	}
	
	// RETURN
	return $template_dir;
		
}
	
function handle_page_template($template_dir) { global $post, $userdata, $wp_query, $CORE;
 
  
	switch(get_post_meta(get_the_ID(), '_wp_page_template', true)){
	
	
		case "templates/tpl-page-blog.php": {
		
		   $GLOBALS['flag-blog'] 		= 1;
		   $GLOBALS['flag-blog-single'] = 1;
 		
		} break;	
	
		case "templates/tpl-page-account.php": { global $wpdb;
		
		   $GLOBALS['flag-account'] = 1; 
   
			// UPDATE ONLINE STATUS
			$CORE->USER("set_online",$userdata->ID);  
		
		} break;
		
		case "templates/tpl-page-contact.php": { 
		
			$GLOBALS['flag-contact'] = 1; 
			
			// CAPACHA
			if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" && !isset($GLOBALS['flag-register-recap']) ){
				wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
			} 
		
		} break;
		
		case "templates/tpl-page-memberships.php": { 
		
			$GLOBALS['flag-memberships'] = 1; 
			
			// CAPACHA
			//if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" && !isset($GLOBALS['flag-register-recap']) ){
				//wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
			//} 
		
		} break;
		
		case "templates/tpl-callback.php": {
		
			// SET FLAG
			$GLOBALS['flag-callback'] = 1;
			 
			if( defined('WLT_DEMOMODE') && isset($_SESSION['skin']) ){
			$loginSkin = $_SESSION['skin'];
			}
		
			// PAYMENT DATA GLOBAL
			global $payment_status, $payment_data;
		 
			// ADD HOOK FOR PAYPAL
			add_action('hook_callback','core_paypal_callback');
			add_action('hook_callback','core_usercredit_callback');
			add_action('hook_callback','core_token_callback');
			add_action('hook_callback','core_admin_test_callback');
			add_action('hook_callback','core_free_upgrade_callback'); 
			
			add_action('hook_callback','core_free_order_callback'); //?? 
			 
			// GET PAYMENT RESPONSDE
			$payment_data = hook_callback($_POST);
			 
			  
			if(is_array($payment_data) ){
			$payment_status = "success";
			}else{
			$payment_status = "error";
			}
		 
 			
			// DESTROY CART SESSION		 
			unset($_SESSION['ppt_cart']); 
			
			// DELETE STORED SESSION COOKIE
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}
			
			// AUTO FOR FORCING PAYMENT SUCCESS
			if(isset($_GET['auth'])){ $payment_status = "success"; }	
			
			
			if( defined('WLT_DEMOMODE') && isset($loginSkin) ){
			session_start();
			$_SESSION['skin'] = $loginSkin;
			}
		
		} break;
		
		default: {
		
			// SET FLAG
			$GLOBALS['flag-page'] = 1;
			
			if(is_front_page() && $CORE->_language_current(1) != "en_us" && $CORE->_language_current(1) != ""){
				
				// CHECK FOR LANGUAGE TEMPLATE
				$lang = $CORE->_language_current(1);
				if(_ppt('home_link_'.$lang) != ""){
					header('location:'._ppt('home_link_'.$lang));
				}
			
			}else{
					
				 
				// CHECK PAGE ACCESS
				if(!$CORE->USER("membership_hasaccess_page", $post->ID )){
				
					header("location: "._ppt(array('links','myaccount'))."?noaccess=1&showtab=membership");
					exit();	
				
				} 
			} 
		
		
		} break;

	
	} 
	// END SWITCH 
	
	//RETURN
	return $template_dir;
}



function handle_post_type_template($single_template) { global $post, $userdata, $CORE;
  	
	// BLOG PAGE
	switch($post->post_type){
	
		case "post": {
		 
		   // SET FLAG
		   $GLOBALS['flag-blog'] 		= 1;
		   $GLOBALS['flag-blog-single'] = 1;
		   
		   
			// CHECK PAGE ACCESS
			if(!$CORE->USER("membership_hasaccess_page", $post->ID )){				
				header("location: "._ppt(array('links','myaccount'))."?noaccess=1&showtab=membership");
				exit();					
			} 
		   
		   // GOOGLE RECAPCTURE
		   if(_ppt(array('captcha','enable')) == 1 && _ppt('captcha','sitekey') != ""){
			   wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
		   }
		 
		   // UPDATE HITS
		   $hits = get_post_meta($post->ID,'hits',true);
		   if(!is_numeric($hits)){ $hits = 0; }
		   update_post_meta($post->ID, 'hits',  $hits + 1 );
		   $hits++;
		   
		} break;
		
		case "listing_type": {
		
			// SET FLAG
			$GLOBALS['flag-single'] = 1; 
			
			// GLOBAL ID
			$GLOBALS['flag-single-id'] = $post->ID;
			
		
			// ADD ON FACEBOOK META
			add_action('wp_head',  array($this, '_facebookmeta') );
			
			// LOGIN TO VIEW
			$canContinue = true;
			
			if( ( _ppt(array('register', 'forcemailverify' )) == 1 || _ppt(array('register', 'photoverify' )) == 1 || _ppt(array('sms', 'force' )) == 1 ) && $userdata->ID && $CORE->USER("get_verified", $userdata->ID) == "0"){
			
				$ev = _ppt(array("emails","user_verify")); 
				if(isset($ev['enable']) && $ev['enable'] == 1){
					$canContinue = false;
					$link = _ppt(array('links','myaccount'))."?noverified=1";
					header("location: ". $link);
					exit;
				}
				
				
			} 
			
			 
		 
			if(!$canContinue){	
			 	
			
				// DATING SEND TO MEMBERSHIPS PAGE
				if(THEME_KEY == "da"){
				
					if(_ppt(array('mem','register'))  == '1'){ 
						$link = wp_login_url();
					}else{
					$link = _ppt(array('links','memberships'));
					}
				
				}elseif(!isset($link)){
				
					$link = wp_login_url();	
				}
			
				header("location: ". $link);
				exit;
			
			}
			
			// CHECK THE LISTING IS LIVE
			if(in_array($post->post_status, array("pending_approval", "pending", "payment","trash") ) && ( $post->post_author != $userdata->ID && !current_user_can('administrator') ) ){
				header("location: ". home_url()."/?pending_approval=1");
				exit;		
			}
			
			/*
			if(_ppt(array('mem','enable'))  == '1' && !$CORE->USER("membership_hasaccess", "view_listing")){
			 
				$link = _ppt(array('links','memberships'))."?noaccess=1";
				if(!$userdata->ID){
					$link = wp_login_url();	
				} 	
				header("location: ". $link);
				exit;
			}
			*/
			// END LOGIN TO CONTINUE
			 	
			
			
			// CHECK IF EXPIRED
			$CORE->expire_listing($post->ID);
			 
				
			// UPDATE VIEW COUNTER
			$CORE->PACKAGE("update_hits", $post->ID);
			
			// UPDATE HISTORY
			$CORE->USER("history_add", $post->ID);
			
			// + UPDATE LAST VIEWED
			$pv = get_post_meta($post->ID,'pageviewed',true);
			if($pv != ""){
				update_post_meta($post->ID,'lastviewed', $pv);
			}
			update_post_meta($post->ID,'pageviewed',date("Y-m-d H:i:s"));
					
			// UPDATE VIEW COUNTER
			if(isset($userdata->ID) && $post->post_type == "listing_type"){
				$CORE->user_recentlyviewed($userdata->ID, $post->ID, false);
			}
			
			// CUSTOM HEADER 
			$SetThis = _ppt(array('design','single_layout')); 			
			if(defined('WLT_DEMOMODE') && isset($_GET['style']) && is_numeric($_GET['style']) && $_GET['style'] == 4){
				 $GLOBALS['global_design4'] = 1;
			}			
			if(in_array($SetThis, array("4","global_design4"))){  $GLOBALS['global_design4'] = 1; } 
			 
			 // ADD BOOTSTRAP img-fluid CODE
			 add_filter( 'the_content', array($this, '_make_images_responsive' ) );	 

		
		} break;
		
		
	}
 
	 
	 //RETURN	 
     return $single_template;  
}



function handle_author_template($template_dir) { global $post,$userdata, $authorID, $listingcount, $wp_query, $CORE;
   
	// SET FLAG 
	$GLOBALS['flag-author'] = 1;
	
	if(isset($_POST['action']) && $_POST['action'] !=""){

		switch($_POST['action']){
		
			case "delfeedback": {	
			 
			$my_post 				= array();
			$my_post['ID'] 			= $_POST['fid'];
			$my_post['post_status'] = "draft";
			wp_update_post( $my_post );	
			
			$GLOBALS['error_message'] 	= "Feedback Deleted";				
			
			} break;
		
		}	
	}
	
	// TURN ON/OFF DISPLAY 
	if(_ppt(array('user','allow_profile')) == 0){ 
		header("location: ".home_url());
		exit();
	} 
	
	// DATING THEME REDIRECT
	if(THEME_KEY == "da" ){
		global $wpdb;
		$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$userdata->ID."') LIMIT 1";				 
		$query = $wpdb->get_results($SQL, OBJECT);
		if(!empty($query)){
			$link =  get_permalink($query[0]->ID);
			header("location: ".$link);
			exit();
		}
	} 
  
	// GET THE AUTHOR ID 
	if(isset($_GET['author']) && is_numeric($_GET['author'])){
	$authorID = $_GET['author'];
	}else{	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$authorID = $author->ID;
	}
	
	// UPDATE VIEW COUNTER
	$CORE->USER("update_views", $authorID);
	 
 
	//RETURN
	return $template_dir;
}
	
	
}













function ppt_demo_page_text($default, $page, $block){


	switch(THEME_KEY){
		
		
 
		case "jb": {
			switch($page){
			
				case "how": {
				
					switch($block){
					 
						case "text1a-title": {						
							$default = __("Employers - List Your Jobs","premiumpress");						
						} break;					
					 
						
						
					}// end switch	
				
				
				} break;
			}
		
		} break;		
		
		case "at":
		case "mj": {
			switch($page){
			
				case "how": {
					
					switch($block){
					
						case "text8-title": {						
							$default = __("How it works","premiumpress");						
						} break;
						case "text8-subtitle": {						
							$default = __("Welcome to our community","premiumpress");						
						} break;	 
						
						
						case "text1-title": {						
							$default = __("Become a member","premiumpress");						
						} break;
						case "text1-desc": {						
							$default = __("Here you can explain some of the benefits of joining your website and why they should become a member.","premiumpress");						
						} break;
						
						case "text1a-title": {						
							$default = __("Become a seller","premiumpress");						
						} break;					
						case "text1a-desc": {						
							$default = __("Here you can explain some of the benefits of joining your website and why they should become a seller.","premiumpress");						
						} break;
						
						
					}// end switch					
				
				} break;
			
			} // end switch			
		
		} break;
	
	}
 
return $default;

}



function ppt_demo_page_data(){

		$core = array();
 	


////// PRICING
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
      /* pricing1 */    
 
        /* pricing9 */    
        $core["pricing"]["pricing10"]["section_padding"] = "section-60";     
        $core["pricing"]["pricing10"]["section_bg"] = "bg-white";     
        $core["pricing"]["pricing10"]["section_pos"] = "";     
        $core["pricing"]["pricing10"]["section_w"] = "container";     
        $core["pricing"]["pricing10"]["section_pattern"] = "";     
        $core["pricing"]["pricing10"]["title_show"] = "yes";     
        $core["pricing"]["pricing10"]["title"] = "Pricing Plans";     
        $core["pricing"]["pricing10"]["subtitle"] = "All prices include a 30-day money back guarantee.";     
        $core["pricing"]["pricing10"]["desc"] = " ";     
        $core["pricing"]["pricing10"]["title_style"] = "1";     
        $core["pricing"]["pricing10"]["title_pos"] = "center";     
        $core["pricing"]["pricing10"]["title_heading"] = "h1";     
        $core["pricing"]["pricing10"]["title_margin"] = "mb-4";     
        $core["pricing"]["pricing10"]["subtitle_margin"] = "mb-4";     
        $core["pricing"]["pricing10"]["desc_margin"] = "mb-4";     
        $core["pricing"]["pricing10"]["title_txtcolor"] = "dark";     
        $core["pricing"]["pricing10"]["subtitle_txtcolor"] = "dark";     
        $core["pricing"]["pricing10"]["desc_txtcolor"] = "opacity-5";     
        $core["pricing"]["pricing10"]["title_font"] = "";     
        $core["pricing"]["pricing10"]["subtitle_font"] = "";     
        $core["pricing"]["pricing10"]["desc_font"] = "";     
        $core["pricing"]["pricing10"]["title_txtw"] = "font-weight-bold";     
        $core["pricing"]["pricing10"]["subtitle_txtw"] = "font-weight-bold";     
        $core["pricing"]["pricing10"]["pricing_type"] = "packages"; 		
        
         
////// pricing
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
 
        /* icon1 */    
        $core["pricing"]["icon1"]["section_padding"] = "section-60";     
        $core["pricing"]["icon1"]["section_bg"] = "bg-light";     
        $core["pricing"]["icon1"]["section_pos"] = "";     
        $core["pricing"]["icon1"]["section_w"] = "container";     
        $core["pricing"]["icon1"]["section_pattern"] = "";     
        $core["pricing"]["icon1"]["title_show"] = "yes";     
        $core["pricing"]["icon1"]["title"] = "";     
        $core["pricing"]["icon1"]["subtitle"] = " ";     
        $core["pricing"]["icon1"]["desc"] = " ";     
        $core["pricing"]["icon1"]["title_style"] = "1";     
        $core["pricing"]["icon1"]["title_pos"] = "center";     
        $core["pricing"]["icon1"]["title_heading"] = "h2";     
        $core["pricing"]["icon1"]["title_margin"] = "";     
        $core["pricing"]["icon1"]["subtitle_margin"] = "mb-5";     
        $core["pricing"]["icon1"]["desc_margin"] = "";     
        $core["pricing"]["icon1"]["title_txtcolor"] = "dark";     
        $core["pricing"]["icon1"]["subtitle_txtcolor"] = "opacity-5";     
        $core["pricing"]["icon1"]["desc_txtcolor"] = "opacity-5";     
        $core["pricing"]["icon1"]["title_font"] = "";     
        $core["pricing"]["icon1"]["subtitle_font"] = "";     
        $core["pricing"]["icon1"]["desc_font"] = "";     
        $core["pricing"]["icon1"]["title_txtw"] = "";     
        $core["pricing"]["icon1"]["subtitle_txtw"] = "";     
        $core["pricing"]["icon1"]["btn_show"] = "no";     
        $core["pricing"]["icon1"]["btn2_show"] = "no";     
        $core["pricing"]["icon1"]["icon1"] = "";     
        $core["pricing"]["icon1"]["icon1_title"] = __("Money Back Guarantee","premiumpress");     
        $core["pricing"]["icon1"]["icon1_desc"] = __("If your unhappy with your purchase, ask for a refund anytime within 30 days.","premiumpress");     
        $core["pricing"]["icon1"]["icon1_link"] = "";     
        $core["pricing"]["icon1"]["icon1_txtcolor"] = "dark";     
        $core["pricing"]["icon1"]["icon1_iconcolor"] = "primary";     
        $core["pricing"]["icon1"]["icon1_type"] = "icon";     
        $core["pricing"]["icon1"]["icon2"] = "";     
        $core["pricing"]["icon1"]["icon2_title"] = __("Secure Online Payments","premiumpress");     
        $core["pricing"]["icon1"]["icon2_desc"] = __("All purchases are made over 128 bit encryption for maximum security.","premiumpress");     
        $core["pricing"]["icon1"]["icon2_link"] = "";     
        $core["pricing"]["icon1"]["icon2_txtcolor"] = "dark";     
        $core["pricing"]["icon1"]["icon2_iconcolor"] = "primary";     
        $core["pricing"]["icon1"]["icon2_type"] = "icon";     
        $core["pricing"]["icon1"]["icon3"] = "";     
        $core["pricing"]["icon1"]["icon3_title"] = __("Instant Access After Payment","premiumpress");     
        $core["pricing"]["icon1"]["icon3_desc"] = __("Once payment is complete your account will be instantly updated.","premiumpress");     
        $core["pricing"]["icon1"]["icon3_link"] = "";     
        $core["pricing"]["icon1"]["icon3_txtcolor"] = "dark";     
        $core["pricing"]["icon1"]["icon3_iconcolor"] = "primary";     
        $core["pricing"]["icon1"]["icon3_type"] = "icon"; 			
		
		

////// MEMBERSHIPS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
      /* pricing1 */    
        $core["memberships"]["pricing9"]["section_padding"] = "section-60";     
        $core["memberships"]["pricing9"]["section_bg"] = "bg-white";     
        $core["memberships"]["pricing9"]["section_pos"] = "";     
        $core["memberships"]["pricing9"]["section_w"] = "container";     
        $core["memberships"]["pricing9"]["section_pattern"] = "";     
        $core["memberships"]["pricing9"]["title_show"] = "yes";     
        $core["memberships"]["pricing9"]["title"] = __("Membership Pricing","premiumpress");     
        $core["memberships"]["pricing9"]["subtitle"] = __("All prices include a 30-day money back guarantee.","premiumpress");     
        $core["memberships"]["pricing9"]["desc"] = "";     
        $core["memberships"]["pricing9"]["title_style"] = "1";     
        $core["memberships"]["pricing9"]["title_pos"] = "center";     
        $core["memberships"]["pricing9"]["title_heading"] = "h1";     
        $core["memberships"]["pricing9"]["title_margin"] = "mb-4";     
        $core["memberships"]["pricing9"]["subtitle_margin"] = "mb-4";     
        $core["memberships"]["pricing9"]["desc_margin"] = "mb-4";     
        $core["memberships"]["pricing9"]["title_txtcolor"] = "dark";     
        $core["memberships"]["pricing9"]["subtitle_txtcolor"] = "dark";     
        $core["memberships"]["pricing9"]["desc_txtcolor"] = "opacity-5";     
        $core["memberships"]["pricing9"]["title_font"] = "";     
        $core["memberships"]["pricing9"]["subtitle_font"] = "";     
        $core["memberships"]["pricing9"]["desc_font"] = "";     
        $core["memberships"]["pricing9"]["title_txtw"] = "font-weight-bold";     
        $core["memberships"]["pricing9"]["subtitle_txtw"] = "font-weight-bold";     
        $core["memberships"]["pricing9"]["pricing_type"] = "memberships"; 		
 
        /* icon10 */    
        $core["memberships"]["icon10"]["section_padding"] = "section-80";     
        $core["memberships"]["icon10"]["section_bg"] = "bg-white";     
        $core["memberships"]["icon10"]["section_pos"] = "";     
        $core["memberships"]["icon10"]["section_w"] = "container";     
        $core["memberships"]["icon10"]["section_pattern"] = "";     
        $core["memberships"]["icon10"]["title_show"] = "yes";     
        $core["memberships"]["icon10"]["title"] = "Our Promise";     
        $core["memberships"]["icon10"]["subtitle"] = "7 Day Refund Policy";     
        $core["memberships"]["icon10"]["desc"] = "Purchase any of our membership packages today and test drive our website with full access. If your unhappy with our service you can contact us for a refund within 7 days for a full refund.";     
        $core["memberships"]["icon10"]["title_style"] = "1";     
        $core["memberships"]["icon10"]["title_pos"] = "left";     
        $core["memberships"]["icon10"]["title_heading"] = "h2";     
        $core["memberships"]["icon10"]["title_margin"] = "mb-4";     
        $core["memberships"]["icon10"]["subtitle_margin"] = "mb-4";     
        $core["memberships"]["icon10"]["desc_margin"] = "mb-4";     
        $core["memberships"]["icon10"]["title_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["subtitle_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["desc_txtcolor"] = "opacity-5";     
        $core["memberships"]["icon10"]["title_font"] = "";     
        $core["memberships"]["icon10"]["subtitle_font"] = "";     
        $core["memberships"]["icon10"]["desc_font"] = "";     
        $core["memberships"]["icon10"]["title_txtw"] = "font-weight-bold";     
        $core["memberships"]["icon10"]["subtitle_txtw"] = "font-weight-bold";     
        $core["memberships"]["icon10"]["btn_show"] = "no";     
        $core["memberships"]["icon10"]["btn2_show"] = "no";     
        $core["memberships"]["icon10"]["icon1"] = "";     
        $core["memberships"]["icon10"]["icon1_title"] = "7 Day Money Back Guarantee.";     
        $core["memberships"]["icon10"]["icon1_desc"] = " ";     
        $core["memberships"]["icon10"]["icon1_link"] = "";     
        $core["memberships"]["icon10"]["icon1_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["icon1_iconcolor"] = "primary";     
        $core["memberships"]["icon10"]["icon1_type"] = "icon";     
        $core["memberships"]["icon10"]["icon2"] = "";     
        $core["memberships"]["icon10"]["icon2_title"] = "Secure Online Payments.";     
        $core["memberships"]["icon10"]["icon2_desc"] = " ";     
        $core["memberships"]["icon10"]["icon2_link"] = "";     
        $core["memberships"]["icon10"]["icon2_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["icon2_iconcolor"] = "primary";     
        $core["memberships"]["icon10"]["icon2_type"] = "icon";     
        $core["memberships"]["icon10"]["icon3"] = "";     
        $core["memberships"]["icon10"]["icon3_title"] = "Instant Access After Payment";     
        $core["memberships"]["icon10"]["icon3_desc"] = " ";     
        $core["memberships"]["icon10"]["icon3_link"] = "";     
        $core["memberships"]["icon10"]["icon3_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["icon3_iconcolor"] = "primary";     
        $core["memberships"]["icon10"]["icon3_type"] = "icon";     
        $core["memberships"]["icon10"]["icon4"] = "";     
        $core["memberships"]["icon10"]["icon4_title"] = "24/7 Help & Online Support";     
        $core["memberships"]["icon10"]["icon4_desc"] = " ";     
        $core["memberships"]["icon10"]["icon4_link"] = "";     
        $core["memberships"]["icon10"]["icon4_txtcolor"] = "dark";     
        $core["memberships"]["icon10"]["icon4_iconcolor"] = "primary";     
        $core["memberships"]["icon10"]["icon4_type"] = "icon"; 	

 
////// HOW
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
 
 
        /* text8 */    
        $core["how"]["text8"]["section_padding"] = "";     
        $core["how"]["text8"]["section_bg"] = "bg-white";     
        $core["how"]["text8"]["section_pos"] = "";     
        $core["how"]["text8"]["section_w"] = "container";     
        $core["how"]["text8"]["section_pattern"] = "";     
        $core["how"]["text8"]["title_show"] = "yes";     
        $core["how"]["text8"]["title"] = ppt_demo_page_text( __("How it works","premiumpress"),"how","text8-title");     
        $core["how"]["text8"]["subtitle"] = ppt_demo_page_text( __("Learn more about our services","premiumpress"),"how","text8-subtitle");     
        $core["how"]["text8"]["desc"] = " ";     
        $core["how"]["text8"]["title_style"] = "1";     
        $core["how"]["text8"]["title_pos"] = "left";     
        $core["how"]["text8"]["title_heading"] = "h2";     
        $core["how"]["text8"]["title_margin"] = "mb-4";     
        $core["how"]["text8"]["subtitle_margin"] = "mb-4";     
        $core["how"]["text8"]["desc_margin"] = "mb-4";     
        $core["how"]["text8"]["title_txtcolor"] = "dark";     
        $core["how"]["text8"]["subtitle_txtcolor"] = "dark";     
        $core["how"]["text8"]["desc_txtcolor"] = "opacity-5";     
        $core["how"]["text8"]["title_font"] = "";     
        $core["how"]["text8"]["subtitle_font"] = "";     
        $core["how"]["text8"]["desc_font"] = "";     
        $core["how"]["text8"]["title_txtw"] = "font-weight-bold";     
        $core["how"]["text8"]["subtitle_txtw"] = "font-weight-bold"; 		
        
        
 
        /* text1 */    
        $core["how"]["text1"]["section_padding"] = "section-top-40";     
        $core["how"]["text1"]["section_bg"] = "";     
        $core["how"]["text1"]["section_pos"] = "";     
        $core["how"]["text1"]["section_w"] = "container";     
        $core["how"]["text1"]["section_pattern"] = "";     
        $core["how"]["text1"]["title_show"] = "yes";     
        $core["how"]["text1"]["title"] = ppt_demo_page_text( __("Signup Free Today!","premiumpress"),"how","text1-title");   
        $core["how"]["text1"]["subtitle"] = "";      
        $core["how"]["text1"]["desc"] = ppt_demo_page_text( "Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos. Mazim nemore singulis an ius.","how","text1-desc");  
		$core["how"]["text1"]["title_style"] = "1";     
        $core["how"]["text1"]["title_pos"] = "left";     
        $core["how"]["text1"]["title_heading"] = "h2";     
        $core["how"]["text1"]["title_margin"] = "mb-4";     
        $core["how"]["text1"]["subtitle_margin"] = "";     
        $core["how"]["text1"]["desc_margin"] = "";     
        $core["how"]["text1"]["title_txtcolor"] = "dark";     
        $core["how"]["text1"]["subtitle_txtcolor"] = "opacity-5";     
        $core["how"]["text1"]["desc_txtcolor"] = "opacity-5";     
        $core["how"]["text1"]["title_font"] = "";     
        $core["how"]["text1"]["subtitle_font"] = "";     
        $core["how"]["text1"]["desc_font"] = "";     
        $core["how"]["text1"]["title_txtw"] = "";     
        $core["how"]["text1"]["subtitle_txtw"] = "";     
        $core["how"]["text1"]["btn_show"] = "yes";     
        $core["how"]["text1"]["btn_link"] = "[link-join]";     
        $core["how"]["text1"]["btn_txt"] = "Join Now";     
        $core["how"]["text1"]["btn_bg"] = "dark";     
        $core["how"]["text1"]["btn_bg_txt"] = "text-light";     
        $core["how"]["text1"]["btn_icon"] = "fal fa-layer-group";     
        $core["how"]["text1"]["btn_icon_pos"] = "none";     
        $core["how"]["text1"]["btn_size"] = "btn-md";     
        $core["how"]["text1"]["btn_margin"] = "mt-2";     
        $core["how"]["text1"]["btn_style"] = "1";     
        $core["how"]["text1"]["btn_font"] = "";     
        $core["how"]["text1"]["btn_txtw"] = "font-weight-bold";     
        $core["how"]["text1"]["btn2_show"] = "no"; 		
		$core["how"]["text1"]["text_image1"] = DEMO_IMGS."?pageid=how&img=1&t=".THEME_KEY;     
        

 
        /* text1a */    
        $core["how"]["text1a"]["section_padding"] = "section-40";     
        $core["how"]["text1a"]["section_bg"] = "";     
        $core["how"]["text1a"]["section_pos"] = "";     
        $core["how"]["text1a"]["section_w"] = "container";     
        $core["how"]["text1a"]["section_pattern"] = "";     
        $core["how"]["text1a"]["title_show"] = "yes";     
        $core["how"]["text1a"]["title"] = ppt_demo_page_text( __("Seller Account","premiumpress"),"how","text1a-title");   
        $core["how"]["text1a"]["subtitle"] = "";      
        $core["how"]["text1a"]["desc"] = ppt_demo_page_text("Quidam officiis similique sea ei, vel tollit indoctum efficiendi ei, at nihil tantas platonem eos. Mazim nemore singulis an ius.","how","text1a-desc");   
        $core["how"]["text1a"]["title_style"] = "1";     
        $core["how"]["text1a"]["title_pos"] = "left";     
        $core["how"]["text1a"]["title_heading"] = "h2";     
        $core["how"]["text1a"]["title_margin"] = "mb-4";     
        $core["how"]["text1a"]["subtitle_margin"] = "";     
        $core["how"]["text1a"]["desc_margin"] = "";     
        $core["how"]["text1a"]["title_txtcolor"] = "dark";     
        $core["how"]["text1a"]["subtitle_txtcolor"] = "opacity-5";     
        $core["how"]["text1a"]["desc_txtcolor"] = "opacity-5";     
        $core["how"]["text1a"]["title_font"] = "";     
        $core["how"]["text1a"]["subtitle_font"] = "";     
        $core["how"]["text1a"]["desc_font"] = "";     
        $core["how"]["text1a"]["title_txtw"] = "";     
        $core["how"]["text1a"]["subtitle_txtw"] = "";     
        $core["how"]["text1a"]["btn_show"] = "yes";     
        $core["how"]["text1a"]["btn_link"] = "[link-join]";     
        $core["how"]["text1a"]["btn_txt"] = "Join Now";     
        $core["how"]["text1a"]["btn_bg"] = "dark";     
        $core["how"]["text1a"]["btn_bg_txt"] = "text-light";     
        $core["how"]["text1a"]["btn_icon"] = "fa fa-user-circle";     
        $core["how"]["text1a"]["btn_icon_pos"] = "none";     
        $core["how"]["text1a"]["btn_size"] = "btn-md";     
        $core["how"]["text1a"]["btn_margin"] = "mt-2";     
        $core["how"]["text1a"]["btn_style"] = "1";     
        $core["how"]["text1a"]["btn_font"] = "";     
        $core["how"]["text1a"]["btn_txtw"] = "font-weight-bold";     
        $core["how"]["text1a"]["btn2_show"] = "no"; 		
		$core["how"]["text1a"]["text_image1"] = DEMO_IMGS."?pageid=how&img=2&t=".THEME_KEY;     
       
 
        /* faq5 */    
        $core["how"]["faq5"]["section_padding"] = "section-80";     
        $core["how"]["faq5"]["section_bg"] = "bg-white";     
        $core["how"]["faq5"]["section_pos"] = "";     
        $core["how"]["faq5"]["section_w"] = "container";     
        $core["how"]["faq5"]["section_pattern"] = "";     
        $core["how"]["faq5"]["title_show"] = "yes";     
        $core["how"]["faq5"]["title"] = ppt_demo_page_text( __("Common Questions","premiumpress"),"text1","title");     
        $core["how"]["faq5"]["subtitle"] = ppt_demo_page_text( __("A few questions we get asked a lot.","premiumpress"),"text1","title");    
        $core["how"]["faq5"]["desc"] = " ";     
        $core["how"]["faq5"]["title_style"] = "6";     
        $core["how"]["faq5"]["title_pos"] = "left";     
        $core["how"]["faq5"]["title_heading"] = "h2";     
        $core["how"]["faq5"]["title_margin"] = "mb-0";     
        $core["how"]["faq5"]["subtitle_margin"] = "mb-0";     
        $core["how"]["faq5"]["desc_margin"] = "mb-5";     
        $core["how"]["faq5"]["title_txtcolor"] = "dark";     
        $core["how"]["faq5"]["subtitle_txtcolor"] = "primary";     
        $core["how"]["faq5"]["desc_txtcolor"] = "opacity-5";     
        $core["how"]["faq5"]["title_font"] = "";     
        $core["how"]["faq5"]["subtitle_font"] = "";     
        $core["how"]["faq5"]["desc_font"] = "";     
        $core["how"]["faq5"]["title_txtw"] = "font-weight-normal";     
        $core["how"]["faq5"]["subtitle_txtw"] = "font-weight-normal";     
        $core["how"]["faq5"]["btn_show"] = "no";  
		 $core["how"]["faq5"]["image_faq"] = DEMO_IMGS."?pageid=how&img=3&t=".THEME_KEY;  			

 

////// TESTIMONIALS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
 
        /* text8 */    
        $core["testimonials"]["text8"]["section_padding"] = "section-40";     
        $core["testimonials"]["text8"]["section_bg"] = "bg-light";     
        $core["testimonials"]["text8"]["section_pos"] = "";     
        $core["testimonials"]["text8"]["section_w"] = "container";     
        $core["testimonials"]["text8"]["title_show"] = "yes";     
        $core["testimonials"]["text8"]["title"] = ppt_demo_page_text( __("Testimonials","premiumpress"),"text8","title");     
        $core["testimonials"]["text8"]["subtitle"] = ppt_demo_page_text( __("User Feedback","premiumpress"),"text8","title");     
        $core["testimonials"]["text8"]["desc"] = "";     
        $core["testimonials"]["text8"]["title_style"] = "h2-2";     
        $core["testimonials"]["text8"]["title_pos"] = "left";     
        $core["testimonials"]["text8"]["title_heading"] = "h2";     
        $core["testimonials"]["text8"]["title_margin"] = "mb-4";     
        $core["testimonials"]["text8"]["subtitle_margin"] = "mb-4";     
        $core["testimonials"]["text8"]["desc_margin"] = "mb-4";     
        $core["testimonials"]["text8"]["title_txtcolor"] = "dark";     
        $core["testimonials"]["text8"]["subtitle_txtcolor"] = "dark";     
        $core["testimonials"]["text8"]["desc_txtcolor"] = "opacity-5";     
        $core["testimonials"]["text8"]["title_font"] = "";     
        $core["testimonials"]["text8"]["subtitle_font"] = "";     
        $core["testimonials"]["text8"]["desc_font"] = "";     
        $core["testimonials"]["text8"]["title_txtw"] = "font-weight-bold";     
        $core["testimonials"]["text8"]["subtitle_txtw"] = "font-weight-bold"; 		
 
        /* text1 */    
        $core["testimonials"]["text1"]["section_padding"] = "section-60";     
        $core["testimonials"]["text1"]["section_bg"] = "bg-white";     
        $core["testimonials"]["text1"]["section_pos"] = "";     
        $core["testimonials"]["text1"]["section_w"] = "container";     
        $core["testimonials"]["text1"]["title_show"] = "yes";     
        $core["testimonials"]["text1"]["title"] = ppt_demo_page_text( __("Over 50,000 Clients Worldwide","premiumpress"),"text1","title");     
        $core["testimonials"]["text1"]["subtitle"] = ppt_demo_page_text( __("Optimized for speed and search engines.","premiumpress"),"text1","subtitle");     
        $core["testimonials"]["text1"]["desc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";     
        $core["testimonials"]["text1"]["title_style"] = "1";     
        $core["testimonials"]["text1"]["title_pos"] = "left";     
        $core["testimonials"]["text1"]["title_heading"] = "h2";     
        $core["testimonials"]["text1"]["title_margin"] = "mb-4";     
        $core["testimonials"]["text1"]["subtitle_margin"] = "mb-4";     
        $core["testimonials"]["text1"]["desc_margin"] = "mb-4";     
        $core["testimonials"]["text1"]["title_txtcolor"] = "dark";     
        $core["testimonials"]["text1"]["subtitle_txtcolor"] = "dark";     
        $core["testimonials"]["text1"]["desc_txtcolor"] = "opacity-5";     
        $core["testimonials"]["text1"]["title_font"] = "";     
        $core["testimonials"]["text1"]["subtitle_font"] = "";     
        $core["testimonials"]["text1"]["desc_font"] = "";     
        $core["testimonials"]["text1"]["title_txtw"] = "font-weight-bold";     
        $core["testimonials"]["text1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["testimonials"]["text1"]["btn_show"] = "no";     
        $core["testimonials"]["text1"]["btn_link"] = "";     
        $core["testimonials"]["text1"]["btn_txt"] = "";     
        $core["testimonials"]["text1"]["btn_bg"] = "primary";     
        $core["testimonials"]["text1"]["btn_bg_txt"] = "text-light";     
        $core["testimonials"]["text1"]["btn_icon"] = "";     
        $core["testimonials"]["text1"]["btn_icon_pos"] = "before";     
        $core["testimonials"]["text1"]["btn_size"] = "btn-xl";     
        $core["testimonials"]["text1"]["btn_margin"] = "mt-0";     
        $core["testimonials"]["text1"]["btn_style"] = "5";     
        $core["testimonials"]["text1"]["btn_font"] = "";     
        $core["testimonials"]["text1"]["btn2_show"] = "no";     
        $core["testimonials"]["text1"]["text_image1"] = DEMO_IMGS."?pageid=testimonials&img=1&t=".THEME_KEY;      
        $core["testimonials"]["text1"]["text_image1_title"] = "";     
        $core["testimonials"]["text1"]["text_image1_link"] = ""; 		
 
  	
 
        /* testimonials2 */    
        $core["testimonials"]["testimonials2"]["section_padding"] = "section-100";     
        $core["testimonials"]["testimonials2"]["section_bg"] = "bg-light";     
        $core["testimonials"]["testimonials2"]["section_pos"] = "";     
        $core["testimonials"]["testimonials2"]["section_w"] = "container";     
        $core["testimonials"]["testimonials2"]["title_show"] = "yes";     
        $core["testimonials"]["testimonials2"]["title"] = ppt_demo_page_text( __("Recent Customer Feedback","premiumpress"),"text1","title");     
        $core["testimonials"]["testimonials2"]["subtitle"] = ppt_demo_page_text( __("Lot's of Happy Customers","premiumpress"),"text1","title");       
        $core["testimonials"]["testimonials2"]["desc"] = "";     
        $core["testimonials"]["testimonials2"]["title_style"] = "1";     
        $core["testimonials"]["testimonials2"]["title_pos"] = "center";     
        $core["testimonials"]["testimonials2"]["title_heading"] = "h2";     
        $core["testimonials"]["testimonials2"]["title_margin"] = "mb-4";     
        $core["testimonials"]["testimonials2"]["subtitle_margin"] = "mb-4";     
        $core["testimonials"]["testimonials2"]["desc_margin"] = "mb-4";     
        $core["testimonials"]["testimonials2"]["title_txtcolor"] = "dark";     
        $core["testimonials"]["testimonials2"]["subtitle_txtcolor"] = "primary";     
        $core["testimonials"]["testimonials2"]["desc_txtcolor"] = "opacity-5";     
        $core["testimonials"]["testimonials2"]["title_font"] = "";     
        $core["testimonials"]["testimonials2"]["subtitle_font"] = "";     
        $core["testimonials"]["testimonials2"]["desc_font"] = "";     
        $core["testimonials"]["testimonials2"]["title_txtw"] = "font-weight-bold";     
        $core["testimonials"]["testimonials2"]["subtitle_txtw"] = "font-weight-bold"; 		


 
 
////// FAQ
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
////// FAQ
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
        /* text8 */    
        $core["faq"]["text8"]["section_padding"] = "section-40";     
        $core["faq"]["text8"]["section_bg"] = "bg-light";     
        $core["faq"]["text8"]["section_pos"] = "";     
        $core["faq"]["text8"]["section_w"] = "container";     
        $core["faq"]["text8"]["section_pattern"] = "";     
        $core["faq"]["text8"]["title_show"] = "yes";     
        $core["faq"]["text8"]["title"] = "FAQ";     
        $core["faq"]["text8"]["subtitle"] = ppt_demo_page_text( __("Commonly Asked Questions","premiumpress"),"text1","subtitle");      
        $core["faq"]["text8"]["desc"] = " ";     
        $core["faq"]["text8"]["title_style"] = "h2-2";     
        $core["faq"]["text8"]["title_pos"] = "left";     
        $core["faq"]["text8"]["title_heading"] = "h2";     
        $core["faq"]["text8"]["title_margin"] = "mb-4";     
        $core["faq"]["text8"]["subtitle_margin"] = "mb-4";     
        $core["faq"]["text8"]["desc_margin"] = "mb-4";     
        $core["faq"]["text8"]["title_txtcolor"] = "dark";     
        $core["faq"]["text8"]["subtitle_txtcolor"] = "dark";     
        $core["faq"]["text8"]["desc_txtcolor"] = "opacity-5";     
        $core["faq"]["text8"]["title_font"] = "";     
        $core["faq"]["text8"]["subtitle_font"] = "";     
        $core["faq"]["text8"]["desc_font"] = "";     
        $core["faq"]["text8"]["title_txtw"] = "font-weight-bold";     
        $core["faq"]["text8"]["subtitle_txtw"] = "font-weight-bold"; 		
 
        /* faq1 */    
        $core["faq"]["faq1"]["section_padding"] = "section-60";     
        $core["faq"]["faq1"]["section_bg"] = "bg-white";     
        $core["faq"]["faq1"]["section_pos"] = "";     
        $core["faq"]["faq1"]["section_w"] = "container";     
        $core["faq"]["faq1"]["section_pattern"] = "";     
        $core["faq"]["faq1"]["title_show"] = "yes";     
        $core["faq"]["faq1"]["title"] =  ppt_demo_page_text( __("Commonly Asked","premiumpress"),"faq1","subtitle");     
        $core["faq"]["faq1"]["subtitle"] = ppt_demo_page_text( __("Questions we get asked the most.","premiumpress"),"faq1","subtitle");     
        $core["faq"]["faq1"]["desc"] = " ";     
        $core["faq"]["faq1"]["title_style"] = "1";     
        $core["faq"]["faq1"]["title_pos"] = "left";     
        $core["faq"]["faq1"]["title_heading"] = "h2";     
        $core["faq"]["faq1"]["title_margin"] = "mb-4";     
        $core["faq"]["faq1"]["subtitle_margin"] = "mb-5";     
        $core["faq"]["faq1"]["desc_margin"] = "mb-4";     
        $core["faq"]["faq1"]["title_txtcolor"] = "dark";     
        $core["faq"]["faq1"]["subtitle_txtcolor"] = "dark";     
        $core["faq"]["faq1"]["desc_txtcolor"] = "opacity-5";     
        $core["faq"]["faq1"]["title_font"] = "";     
        $core["faq"]["faq1"]["subtitle_font"] = "";     
        $core["faq"]["faq1"]["desc_font"] = "";     
        $core["faq"]["faq1"]["title_txtw"] = "font-weight-bold";     
        $core["faq"]["faq1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["faq"]["faq1"]["btn_show"] = "no";     
        $core["faq"]["faq1"]["image_faq"] = DEMO_IMGS."?pageid=faq&img=1&t=".THEME_KEY; 		

 
        /* faq2 */    
        $core["faq"]["faq2"]["section_padding"] = "section-100";     
        $core["faq"]["faq2"]["section_bg"] = "bg-white";     
        $core["faq"]["faq2"]["section_pos"] = "";     
        $core["faq"]["faq2"]["section_w"] = "container";     
        $core["faq"]["faq2"]["section_pattern"] = "";     
        $core["faq"]["faq2"]["title_show"] = "yes";     
        $core["faq"]["faq2"]["title"] = ppt_demo_page_text( __("Account Questions","premiumpress"),"faq1","subtitle");      
        $core["faq"]["faq2"]["subtitle"] = ppt_demo_page_text( __("Helpful FAQ for account area options.","premiumpress"),"faq1","subtitle");   
        $core["faq"]["faq2"]["desc"] = " ";     
        $core["faq"]["faq2"]["title_style"] = "1";     
        $core["faq"]["faq2"]["title_pos"] = "left";     
        $core["faq"]["faq2"]["title_heading"] = "h2";     
        $core["faq"]["faq2"]["title_margin"] = "mb-3";     
        $core["faq"]["faq2"]["subtitle_margin"] = "mb-5";     
        $core["faq"]["faq2"]["desc_margin"] = "mb-0";     
        $core["faq"]["faq2"]["title_txtcolor"] = "dark";     
        $core["faq"]["faq2"]["subtitle_txtcolor"] = "dark";     
        $core["faq"]["faq2"]["desc_txtcolor"] = "opacity-5";     
        $core["faq"]["faq2"]["title_font"] = "";     
        $core["faq"]["faq2"]["subtitle_font"] = "";     
        $core["faq"]["faq2"]["desc_font"] = "";     
        $core["faq"]["faq2"]["title_txtw"] = "font-weight-bold";     
        $core["faq"]["faq2"]["subtitle_txtw"] = "font-weight-bold";     
        $core["faq"]["faq2"]["btn_show"] = "no";     
        $core["faq"]["faq2"]["image_faq"] = DEMO_IMGS."?pageid=faq&img=2&t=".THEME_KEY; 		

 
////// CONTACT US
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

  
        /* text8 */    
        $core["contact"]["text8"]["section_padding"] = "section-40";     
        $core["contact"]["text8"]["section_bg"] = "bg-light";     
        $core["contact"]["text8"]["section_pos"] = "";     
        $core["contact"]["text8"]["section_w"] = "container";     
        $core["contact"]["text8"]["section_pattern"] = "";     
        $core["contact"]["text8"]["title_show"] = "yes";     
        $core["contact"]["text8"]["title"] = ppt_demo_page_text( __("Contact Us","premiumpress"),"text8","title");     
        $core["contact"]["text8"]["subtitle"] = ppt_demo_page_text( __("Online Support 24/7","premiumpress"),"text8","title");     
        $core["contact"]["text8"]["desc"] = " ";     
        $core["contact"]["text8"]["title_style"] = "h2-2";     
        $core["contact"]["text8"]["title_pos"] = "left";     
        $core["contact"]["text8"]["title_heading"] = "h2";     
        $core["contact"]["text8"]["title_margin"] = "mb-4";     
        $core["contact"]["text8"]["subtitle_margin"] = "mb-4";     
        $core["contact"]["text8"]["desc_margin"] = "mb-4";     
        $core["contact"]["text8"]["title_txtcolor"] = "dark";     
        $core["contact"]["text8"]["subtitle_txtcolor"] = "dark";     
        $core["contact"]["text8"]["desc_txtcolor"] = "opacity-5";     
        $core["contact"]["text8"]["title_font"] = "";     
        $core["contact"]["text8"]["subtitle_font"] = "";     
        $core["contact"]["text8"]["desc_font"] = "";     
        $core["contact"]["text8"]["title_txtw"] = "font-weight-bold";     
        $core["contact"]["text8"]["subtitle_txtw"] = "font-weight-bold"; 		
 
 
        /* text1 */    
        $core["contact"]["text1"]["section_padding"] = "section-60";     
        $core["contact"]["text1"]["section_bg"] = "bg-white";     
        $core["contact"]["text1"]["section_pos"] = "";     
        $core["contact"]["text1"]["section_w"] = "container";     
        $core["contact"]["text1"]["section_pattern"] = "";     
        $core["contact"]["text1"]["title_show"] = "yes";     
        $core["contact"]["text1"]["title"] = ppt_demo_page_text( __("We're here to help!","premiumpress"),"text1","title");     
        $core["contact"]["text1"]["subtitle"] = ppt_demo_page_text( __("We do our best to answer all questions within a timely manner.If you have a question please complete the form below and we'll get back toy you ASAP.","premiumpress"),"text1","subtitle");     
        $core["contact"]["text1"]["desc"] = " ";     
        $core["contact"]["text1"]["title_style"] = "1";     
        $core["contact"]["text1"]["title_pos"] = "left";     
        $core["contact"]["text1"]["title_heading"] = "h2";     
        $core["contact"]["text1"]["title_margin"] = "mb-4";     
        $core["contact"]["text1"]["subtitle_margin"] = "";     
        $core["contact"]["text1"]["desc_margin"] = "";     
        $core["contact"]["text1"]["title_txtcolor"] = "dark";     
        $core["contact"]["text1"]["subtitle_txtcolor"] = "opacity-5";     
        $core["contact"]["text1"]["desc_txtcolor"] = "opacity-5";     
        $core["contact"]["text1"]["title_font"] = "";     
        $core["contact"]["text1"]["subtitle_font"] = "";     
        $core["contact"]["text1"]["desc_font"] = "";     
        $core["contact"]["text1"]["title_txtw"] = "font-weight-bold";     
        $core["contact"]["text1"]["subtitle_txtw"] = "";     
        $core["contact"]["text1"]["btn_show"] = "no";     
        $core["contact"]["text1"]["btn2_show"] = "no";     
        $core["contact"]["text1"]["text_image1"] = DEMO_IMGS."?pageid=contact&img=1&t=".THEME_KEY;      
        $core["contact"]["text1"]["text_image1_title"] = "Contact Us";     
        $core["contact"]["text1"]["text_image1_link"] = ""; 	 
        
 
        /* contact1 */    
        $core["contact"]["contact1"]["section_padding"] = "section-80";     
        $core["contact"]["contact1"]["section_bg"] = "bg-white";     
        $core["contact"]["contact1"]["section_pos"] = "";     
        $core["contact"]["contact1"]["section_w"] = "container";     
        $core["contact"]["contact1"]["section_pattern"] = "";     
        $core["contact"]["contact1"]["title_show"] = "yes";     
        $core["contact"]["contact1"]["title"] = ppt_demo_page_text( __("Get in touch","premiumpress"),"contact1","title");     
        $core["contact"]["contact1"]["subtitle"] = " ";     
        $core["contact"]["contact1"]["desc"] = ppt_demo_page_text( __("Complete the form below and we'll get back to you within 48 hours.","premiumpress"),"text8","title");     
        $core["contact"]["contact1"]["title_style"] = "1";     
        $core["contact"]["contact1"]["title_pos"] = "";     
        $core["contact"]["contact1"]["title_heading"] = "h3";     
        $core["contact"]["contact1"]["title_margin"] = "";     
        $core["contact"]["contact1"]["subtitle_margin"] = "";     
        $core["contact"]["contact1"]["desc_margin"] = "mb-5";     
        $core["contact"]["contact1"]["title_txtcolor"] = "dark";     
        $core["contact"]["contact1"]["subtitle_txtcolor"] = "primary";     
        $core["contact"]["contact1"]["desc_txtcolor"] = "opacity-5";     
        $core["contact"]["contact1"]["title_font"] = "";     
        $core["contact"]["contact1"]["subtitle_font"] = "";     
        $core["contact"]["contact1"]["desc_font"] = "";     
        $core["contact"]["contact1"]["title_txtw"] = "";     
        $core["contact"]["contact1"]["subtitle_txtw"] = "";  



////// ABOUT US
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 

 
        /* text8 */    
        $core["aboutus"]["text8"]["section_padding"] = "section-40";     
        $core["aboutus"]["text8"]["section_bg"] = "bg-light";     
        $core["aboutus"]["text8"]["section_pos"] = "";     
        $core["aboutus"]["text8"]["section_w"] = "container";     
        $core["aboutus"]["text8"]["section_pattern"] = "";     
        $core["aboutus"]["text8"]["title_show"] = "yes";     
        $core["aboutus"]["text8"]["title"] = ppt_demo_page_text( __("About Us","premiumpress"),"text8","title");     
        $core["aboutus"]["text8"]["subtitle"] = ppt_demo_page_text( __("Learn more about us","premiumpress"),"text8","title");     
        $core["aboutus"]["text8"]["desc"] = " ";     
        $core["aboutus"]["text8"]["title_style"] = "h2-2";     
        $core["aboutus"]["text8"]["title_pos"] = "left";     
        $core["aboutus"]["text8"]["title_heading"] = "h2";     
        $core["aboutus"]["text8"]["title_margin"] = "mb-4";     
        $core["aboutus"]["text8"]["subtitle_margin"] = "mb-4";     
        $core["aboutus"]["text8"]["desc_margin"] = "mb-4";     
        $core["aboutus"]["text8"]["title_txtcolor"] = "dark";     
        $core["aboutus"]["text8"]["subtitle_txtcolor"] = "dark";     
        $core["aboutus"]["text8"]["desc_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text8"]["title_font"] = "";     
        $core["aboutus"]["text8"]["subtitle_font"] = "";     
        $core["aboutus"]["text8"]["desc_font"] = "";     
        $core["aboutus"]["text8"]["title_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text8"]["subtitle_txtw"] = "font-weight-bold"; 		
  
        /* text1 */    
        $core["aboutus"]["text1"]["section_padding"] = "section-60";     
        $core["aboutus"]["text1"]["section_bg"] = "bg-white";     
        $core["aboutus"]["text1"]["section_pos"] = "";     
        $core["aboutus"]["text1"]["section_w"] = "container";     
        $core["aboutus"]["text1"]["section_pattern"] = "";     
        $core["aboutus"]["text1"]["title_show"] = "yes";     
        $core["aboutus"]["text1"]["title"] = "We've been working hard helping customers for over 10 years.";     
        $core["aboutus"]["text1"]["subtitle"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";     
        $core["aboutus"]["text1"]["desc"] = "";     
        $core["aboutus"]["text1"]["title_style"] = "1";     
        $core["aboutus"]["text1"]["title_pos"] = "left";     
        $core["aboutus"]["text1"]["title_heading"] = "h2";     
        $core["aboutus"]["text1"]["title_margin"] = "mb-4";     
        $core["aboutus"]["text1"]["subtitle_margin"] = "mb-4";     
        $core["aboutus"]["text1"]["desc_margin"] = "mb-4";     
        $core["aboutus"]["text1"]["title_txtcolor"] = "dark";     
        $core["aboutus"]["text1"]["subtitle_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text1"]["desc_txtcolor"] = "";     
        $core["aboutus"]["text1"]["title_font"] = "";     
        $core["aboutus"]["text1"]["subtitle_font"] = "";     
        $core["aboutus"]["text1"]["desc_font"] = "";     
        $core["aboutus"]["text1"]["title_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text1"]["subtitle_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text1"]["btn_show"] = "no";     
        $core["aboutus"]["text1"]["btn2_show"] = "no";     
        $core["aboutus"]["text1"]["text_image1"] = DEMO_IMGS."?pageid=aboutus&img=1&t=".THEME_KEY;     
        $core["aboutus"]["text1"]["text_image1_title"] = "";     
        $core["aboutus"]["text1"]["text_image1_link"] = ""; 		
        
 
        /* text1a */    
        $core["aboutus"]["text1a"]["section_padding"] = "section-bottom-80";     
        $core["aboutus"]["text1a"]["section_bg"] = "bg-white";     
        $core["aboutus"]["text1a"]["section_pos"] = "";     
        $core["aboutus"]["text1a"]["section_w"] = "container";     
        $core["aboutus"]["text1a"]["section_pattern"] = "";     
        $core["aboutus"]["text1a"]["title_show"] = "yes";     
        $core["aboutus"]["text1a"]["title"] = "Create Beautiful Websites In Minutes With PremiumPress";     
        $core["aboutus"]["text1a"]["subtitle"] = "PremiumPress themes come with 150+ ready-made drag & drop design blocks making it easy to create stunning websites.";     
        $core["aboutus"]["text1a"]["desc"] = " ";     
        $core["aboutus"]["text1a"]["title_style"] = "1";     
        $core["aboutus"]["text1a"]["title_pos"] = "left";     
        $core["aboutus"]["text1a"]["title_heading"] = "h2";     
        $core["aboutus"]["text1a"]["title_margin"] = "mb-4";     
        $core["aboutus"]["text1a"]["subtitle_margin"] = "";     
        $core["aboutus"]["text1a"]["desc_margin"] = "";     
        $core["aboutus"]["text1a"]["title_txtcolor"] = "dark";     
        $core["aboutus"]["text1a"]["subtitle_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text1a"]["desc_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text1a"]["title_font"] = "";     
        $core["aboutus"]["text1a"]["subtitle_font"] = "";     
        $core["aboutus"]["text1a"]["desc_font"] = "";     
        $core["aboutus"]["text1a"]["title_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text1a"]["subtitle_txtw"] = "";     
        $core["aboutus"]["text1a"]["btn_show"] = "no";     
        $core["aboutus"]["text1a"]["btn2_show"] = "no"; 
        $core["aboutus"]["text1a"]["text_image1"] = DEMO_IMGS."?pageid=aboutus&img=2&t=".THEME_KEY;    
        
 
        /* text1d */    
        $core["aboutus"]["text1d"]["section_padding"] = "section-40";     
        $core["aboutus"]["text1d"]["section_bg"] = "bg-light";     
        $core["aboutus"]["text1d"]["section_pos"] = "";     
        $core["aboutus"]["text1d"]["section_w"] = "container";     
        $core["aboutus"]["text1d"]["section_pattern"] = "";     
        $core["aboutus"]["text1d"]["title_show"] = "yes";     
        $core["aboutus"]["text1d"]["title"] = "Join our community.";     
        $core["aboutus"]["text1d"]["subtitle"] = "Create your free account today.";     
        $core["aboutus"]["text1d"]["desc"] = " ";     
        $core["aboutus"]["text1d"]["title_style"] = "1";     
        $core["aboutus"]["text1d"]["title_pos"] = "left";     
        $core["aboutus"]["text1d"]["title_heading"] = "h2";     
        $core["aboutus"]["text1d"]["title_margin"] = "mb-4";     
        $core["aboutus"]["text1d"]["subtitle_margin"] = "";     
        $core["aboutus"]["text1d"]["desc_margin"] = "";     
        $core["aboutus"]["text1d"]["title_txtcolor"] = "dark";     
        $core["aboutus"]["text1d"]["subtitle_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text1d"]["desc_txtcolor"] = "opacity-5";     
        $core["aboutus"]["text1d"]["title_font"] = "";     
        $core["aboutus"]["text1d"]["subtitle_font"] = "";     
        $core["aboutus"]["text1d"]["desc_font"] = "";     
        $core["aboutus"]["text1d"]["title_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text1d"]["subtitle_txtw"] = "";     
        $core["aboutus"]["text1d"]["btn_show"] = "yes";     
        $core["aboutus"]["text1d"]["btn_link"] = "[link-join]";     
        $core["aboutus"]["text1d"]["btn_txt"] = "Get Started";     
        $core["aboutus"]["text1d"]["btn_bg"] = "primary";     
        $core["aboutus"]["text1d"]["btn_bg_txt"] = "text-light";     
        $core["aboutus"]["text1d"]["btn_icon"] = "";     
        $core["aboutus"]["text1d"]["btn_icon_pos"] = "";     
        $core["aboutus"]["text1d"]["btn_size"] = "btn-lg";     
        $core["aboutus"]["text1d"]["btn_margin"] = "mt-2";     
        $core["aboutus"]["text1d"]["btn_style"] = "1";     
        $core["aboutus"]["text1d"]["btn_font"] = "";     
        $core["aboutus"]["text1d"]["btn_txtw"] = "font-weight-bold";     
        $core["aboutus"]["text1d"]["btn2_show"] = "no"; 			
		$core["aboutus"]["text1d"]["text_image1"] = DEMO_IMGS."?pageid=aboutus&img=3&t=".THEME_KEY;    
       
  


/* TERMS &amp; CONDITIONS */ 
        
        $core["terms"]["text8"]["section_padding"] = "section-40";     
        $core["terms"]["text8"]["section_bg"] = "bg-light";     
        $core["terms"]["text8"]["title_show"] = "yes";     
        $core["terms"]["text8"]["title"] = "Terms &amp; Conditions";     
        $core["terms"]["text8"]["subtitle"] = "Because we care";     
        $core["terms"]["text8"]["desc"] = "";     
        $core["terms"]["text8"]["title_style"] = "h2-2"; 	
		

 
/* PRIVACY */ 
        
        $core["privacy"]["text8"]["section_padding"] = "section-40";     
        $core["privacy"]["text8"]["section_bg"] = "bg-light";     
        $core["privacy"]["text8"]["title_show"] = "yes";     
        $core["privacy"]["text8"]["title"] = "Privacy";     
        $core["privacy"]["text8"]["subtitle"] = "Because we care";     
        $core["privacy"]["text8"]["desc"] = "";     
        $core["privacy"]["text8"]["title_style"] = "h2-2"; 	
 

 
/* SELL SPACE */

 
 
        /* pricing1 */    
        $core["sellspace"]["pricing11"]["section_padding"] = "section-60";     
        $core["sellspace"]["pricing11"]["section_bg"] = "bg-white";     
        $core["sellspace"]["pricing11"]["section_pos"] = "";     
        $core["sellspace"]["pricing11"]["section_w"] = "container";     
        $core["sellspace"]["pricing11"]["title_show"] = "yes";     
        $core["sellspace"]["pricing11"]["title"] = "Advertising Pricing";     
        $core["sellspace"]["pricing11"]["subtitle"] = "Put your banners on our website today!";     
        $core["sellspace"]["pricing11"]["desc"] = "";     
        $core["sellspace"]["pricing11"]["title_style"] = "1";     
        $core["sellspace"]["pricing11"]["title_pos"] = "center";     
        $core["sellspace"]["pricing11"]["title_heading"] = "h1";     
        $core["sellspace"]["pricing11"]["title_margin"] = "mb-4";     
        $core["sellspace"]["pricing11"]["subtitle_margin"] = "mb-4";     
        $core["sellspace"]["pricing11"]["desc_margin"] = "mb-4";     
        $core["sellspace"]["pricing11"]["title_txtcolor"] = "dark";     
        $core["sellspace"]["pricing11"]["subtitle_txtcolor"] = "dark";     
        $core["sellspace"]["pricing11"]["desc_txtcolor"] = "opacity-5";     
        $core["sellspace"]["pricing11"]["title_font"] = "";     
        $core["sellspace"]["pricing11"]["subtitle_font"] = "";     
        $core["sellspace"]["pricing11"]["desc_font"] = "";     
        $core["sellspace"]["pricing11"]["title_txtw"] = "font-weight-bold";     
        $core["sellspace"]["pricing11"]["subtitle_txtw"] = "font-weight-bold";     
        $core["sellspace"]["pricing11"]["pricing_type"] = "advertising"; 		
 
        /* icon10 */    
        $core["sellspace"]["icon10"]["section_padding"] = "section-80";     
        $core["sellspace"]["icon10"]["section_bg"] = "bg-light";     
        $core["sellspace"]["icon10"]["section_pos"] = "";     
        $core["sellspace"]["icon10"]["section_w"] = "container";     
        $core["sellspace"]["icon10"]["title_show"] = "yes";     
        $core["sellspace"]["icon10"]["title"] = "Advertising Opportunities";     
        $core["sellspace"]["icon10"]["subtitle"] = "Place your banners on our website.";     
        $core["sellspace"]["icon10"]["desc"] = "Purchase advertising space on our website and promote your products or services to our community.<br><br>Contact us today for any special requirements.";     
        $core["sellspace"]["icon10"]["title_style"] = "2";     
        $core["sellspace"]["icon10"]["title_pos"] = "left";     
        $core["sellspace"]["icon10"]["title_heading"] = "h2";     
        $core["sellspace"]["icon10"]["title_margin"] = "mb-4";     
        $core["sellspace"]["icon10"]["subtitle_margin"] = "mb-4";     
        $core["sellspace"]["icon10"]["desc_margin"] = "mb-4";     
        $core["sellspace"]["icon10"]["title_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["subtitle_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["desc_txtcolor"] = "opacity-5";     
        $core["sellspace"]["icon10"]["title_font"] = "";     
        $core["sellspace"]["icon10"]["subtitle_font"] = "";     
        $core["sellspace"]["icon10"]["desc_font"] = "";     
        $core["sellspace"]["icon10"]["title_txtw"] = "font-weight-bold";     
        $core["sellspace"]["icon10"]["subtitle_txtw"] = "font-weight-bold";     
        $core["sellspace"]["icon10"]["btn_show"] = "no";     
        $core["sellspace"]["icon10"]["btn2_show"] = "no";     
        $core["sellspace"]["icon10"]["icon1"] = "";     
        $core["sellspace"]["icon10"]["icon1_title"] = "30 Day Money Back Guarantee.";     
        $core["sellspace"]["icon10"]["icon1_desc"] = " ";     
        $core["sellspace"]["icon10"]["icon1_link"] = "";     
        $core["sellspace"]["icon10"]["icon1_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["icon1_iconcolor"] = "primary";     
        $core["sellspace"]["icon10"]["icon1_type"] = "icon";     
        $core["sellspace"]["icon10"]["icon2"] = "";     
        $core["sellspace"]["icon10"]["icon2_title"] = "Secure Online Payments.";     
        $core["sellspace"]["icon10"]["icon2_desc"] = " ";     
        $core["sellspace"]["icon10"]["icon2_link"] = "";     
        $core["sellspace"]["icon10"]["icon2_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["icon2_iconcolor"] = "primary";     
        $core["sellspace"]["icon10"]["icon2_type"] = "icon";     
        $core["sellspace"]["icon10"]["icon3"] = "";     
        $core["sellspace"]["icon10"]["icon3_title"] = "Instant Access After Payment";     
        $core["sellspace"]["icon10"]["icon3_desc"] = " ";     
        $core["sellspace"]["icon10"]["icon3_link"] = "";     
        $core["sellspace"]["icon10"]["icon3_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["icon3_iconcolor"] = "primary";     
        $core["sellspace"]["icon10"]["icon3_type"] = "icon";     
        $core["sellspace"]["icon10"]["icon4"] = "";     
        $core["sellspace"]["icon10"]["icon4_title"] = "24/7 Help & Online Support";     
        $core["sellspace"]["icon10"]["icon4_desc"] = " ";     
        $core["sellspace"]["icon10"]["icon4_link"] = "";     
        $core["sellspace"]["icon10"]["icon4_txtcolor"] = "dark";     
        $core["sellspace"]["icon10"]["icon4_iconcolor"] = "primary";     
        $core["sellspace"]["icon10"]["icon4_type"] = "icon"; 		

	


/* ADD */

 
        /* text6 */    
     
        $core["add"]["pricing10"]["section_padding"] = "section-60";     
        $core["add"]["pricing10"]["section_bg"] = "bg-white";     
        $core["add"]["pricing10"]["section_pos"] = "";     
        $core["add"]["pricing10"]["title_show"] = "yes";     
        $core["add"]["pricing10"]["title"] = "Pricing Plans for Everyone";     
        $core["add"]["pricing10"]["subtitle"] = "All purchases include a 30-day money back guarantee.";     
        $core["add"]["pricing10"]["desc"] = "";     
        $core["add"]["pricing10"]["title_style"] = "1";     
        $core["add"]["pricing10"]["title_pos"] = "center";     
        $core["add"]["pricing10"]["title_heading"] = "h1";     
        $core["add"]["pricing10"]["title_margin"] = "mb-4";     
        $core["add"]["pricing10"]["subtitle_margin"] = "mb-4";     
        $core["add"]["pricing10"]["desc_margin"] = "mb-4";     
        $core["add"]["pricing10"]["title_txtcolor"] = "dark";     
        $core["add"]["pricing10"]["subtitle_txtcolor"] = "primary";     
        $core["add"]["pricing10"]["desc_txtcolor"] = "opacity-5";     
        $core["add"]["pricing10"]["title_txtw"] = "font-weight-bold";     
        $core["add"]["pricing10"]["subtitle_txtw"] = "font-weight-bold";     
        $core["add"]["pricing10"]["pricing_type"] = "packages"; 		

            
        $core["add"]["icon11"]["section_padding"] = "section-80";     
        $core["add"]["icon11"]["section_bg"] = "bg-light";     
        $core["add"]["icon11"]["section_pos"] = "";     
        $core["add"]["icon11"]["title_show"] = "no";     
        $core["add"]["icon11"]["btn_show"] = "no";     
        $core["add"]["icon11"]["btn2_show"] = "no";     
        $core["add"]["icon11"]["icon1"] = "";     
        $core["add"]["icon11"]["icon1_title"] = "Money Back Guarentee";     
        $core["add"]["icon11"]["icon1_desc"] = "If your unhappy with our service at anytime within 30 days - contact us.";     
        $core["add"]["icon11"]["icon1_link"] = "";     
        $core["add"]["icon11"]["icon1_txtcolor"] = "dark";     
        $core["add"]["icon11"]["icon1_iconcolor"] = "primary";     
        $core["add"]["icon11"]["icon1_type"] = "icon";     
        $core["add"]["icon11"]["icon2"] = "";     
        $core["add"]["icon11"]["icon2_title"] = "Over 50,000 Members";     
        $core["add"]["icon11"]["icon2_desc"] = "Your ad will be exposure to over 50,000+ website members.";     
        $core["add"]["icon11"]["icon2_link"] = "";     
        $core["add"]["icon11"]["icon2_txtcolor"] = "dark";     
        $core["add"]["icon11"]["icon2_iconcolor"] = "primary";     
        $core["add"]["icon11"]["icon2_type"] = "icon";     
        $core["add"]["icon11"]["icon3"] = "";     
        $core["add"]["icon11"]["icon3_title"] = "Easy to customize";     
        $core["add"]["icon11"]["icon3_desc"] = "You can come back and edit you ad anytime using the members area tool.";     
        $core["add"]["icon11"]["icon3_link"] = "";     
        $core["add"]["icon11"]["icon3_txtcolor"] = "dark";     
        $core["add"]["icon11"]["icon3_iconcolor"] = "primary";     
        $core["add"]["icon11"]["icon3_type"] = "icon"; 	
		
		
 
			
		
		return $core;
}


?>