<?php

function _ppt_filter_childtheme($theme){
 
return $theme;

}
function _ppt_install_childtheme($theme){

		// FIX PHP 7.1
			$existingdta = get_option("core_admin_values");
			if(!is_array($existingdta )){
			$existingdta  = array();
			}
			 	
			$new_core_array = apply_filters($theme, $existingdta );	
			   
			// REMOVE SAMPLE DATA	
			if(isset($new_core_array['sampledata'])){ unset($new_core_array['sampledata']); }
			
			$new_core_array['pageassign']['homepage'] = "";	
		 				 
			update_option('core_admin_values', $new_core_array);	

}


function _childtheme_build(){

if(!current_user_can('administrator')){
die();
}

$uploads = wp_upload_dir(); $saveimages = array();

$data = array( 
	"name" => "Child Themes", 
);

// WORDPRESS UPLOADS
		
		 
		 // NAME 
		 $cname = $data['name'];
		 if(strlen( _ppt(array('childtheme','name')) ) > 1){
		 $cname = _ppt(array('childtheme','name'));
		 }elseif(isset($_POST['childtheme']['name'])){
		 $cname = $_POST['childtheme']['name'];
		 }
		 
		  
		
		// SCREENSHOT FILE		 
		if(is_numeric(_ppt(array('childtheme','thumb_url_aid'))) && strtolower(substr(_ppt(array('childtheme','thumb_url')), -3)) == "png" ){
		 				
			$file = get_attached_file(_ppt(array('childtheme','thumb_url_aid')), true);	
			
			$newname = "screenshot.png";
			
			if (file_exists($uploads['path']."/".$newname)) {
				
			}else{			
			
				if (!copy($file, $uploads['path']."/".$newname)) {
					die("Could not save your screenshot image");
				}
			
			}
		
		} 
		 
		
		// PREVIEW FILE		 
		$preview_image = "";
		if(is_numeric(_ppt(array('childtheme','thumb1_url_aid')))  ){
		 				
			$file = get_attached_file(_ppt(array('childtheme','thumb1_url_aid')), true);	
			
			$preview_image = wp_basename($file);
			
			$preview_image_file =  $file; 
		
		} 
		  
		 $te = explode("wp-content",$_SERVER['SCRIPT_FILENAME']);
		$SERVER_PATH_HERE = str_replace("index.php","",$te[0]);
 		 
		//1. INCLUDE ZIP FEATURE
		include($SERVER_PATH_HERE."/wp-admin/includes/class-pclzip.php");
		$uploads = wp_upload_dir();
		
		$template_name = "childtheme_".str_replace(" ","_",strip_tags($cname));		  
		  
		// 2. REMOVE OLD FILES
		if (file_exists($uploads['path']."/".$template_name.".zip")) {
			@unlink($uploads['path']."/".$template_name.".zip"); 
		}
		  
		 
		//$TKEY = strtoupper(THEME_KEY)."10";
		$TKEY = "DT10";
		
		   
		// 3. CREATE NEW STYLE.CSS
		$cssContent = "/*
		Theme Name: ".strip_tags($cname)."
		Theme URI: http://www.premiumpress.com
		Description: PremiumPress Child Theme created on ".date('l jS \of F Y h:i:s A')."
		Author: ".get_option('admin_email')."
		Author URI: ".get_home_url()."
		Template: ".$TKEY."
		Version: 1.0
		*/";
		
		 	
		//2. ADD-ON CUSTOM STYLES		
		$cssContent .= stripslashes(get_option('custom_head')); 
			
		//3. SAVE THE NEW STYLE FILE		   
		$handle = fopen($uploads['path']."/style.css", "w");
		if (fwrite($handle, $cssContent) === FALSE) {
				echo "Cannot write to styles";
				die();
		} 		 
		fclose($handle);
		
		
		
		// 4. CHECK FOR LOGO
		$logofile = ""; $logo_text = _ppt(array('design','textlogo')); $logo_url = "";
		if($logo_text == ""){
		 $logo_text = "Website Logo";
		}
		if(is_numeric(_ppt(array('design','logo_url_aid')))){
		
			$logo_fullpath = get_attached_file(_ppt(array('design','logo_url_aid')), true);		
		 
	
			$hh = wp_get_attachment_metadata(_ppt(array('design','logo_url_aid')));
			if(isset($hh['file']) && $hh['file'] != ""){			 
			$logofile = $logo_fullpath;
			}
			
			$logo_url = wp_basename($logo_fullpath);
			
		}		
		
		
		// HOMEPAGE ELEMENTOR
	
		$elementor_homepage_name = "";
			/*
		if(strlen(_ppt(array('pageassign','homepage'))) > 3 && substr(_ppt(array('pageassign','homepage')) ,0,4) != "page"){ 
	 	 
			 $args = array(
				 "action" 			=> "elementor_library_direct_actions",
				 "library_action" 	=> "export_template",
				 "source" 			=> "local",
				 "template_id" 		=> str_replace("elementor-","", _ppt(array('pageassign','homepage')) ),
				 		 
			 );
			  
			$elementor_importer = new PremiumPress_Elementor_Importer();
			$filedata = $elementor_importer->export_elementor_file( $args );
			
			
			// IF HAS ERRORS					 
				if ( is_wp_error($filedata) ) {
					echo '<h4>' . $filedata->get_error_message() . '</h4>';						 
					die();	
				}
			
			$elementor_homepage_path = $uploads['path']."/".$filedata['name'];
			$elementor_homepage_name = $filedata['name'];
			
			// SAVE CONTENT TO FUNCTIONS FILE
			$handle = fopen($elementor_homepage_path, "w");
			if (fwrite($handle, $filedata['content']) === FALSE) {
					echo "Cannot write to Elementor Homepage file";
					die();
			} 
			fclose($handle); 
			
			// NOW LOOP ALL IMAGES
			if( is_array($filedata['images']) && !empty($filedata['images']) ) {
				
				foreach($filedata['images'] as $img){
				
					if(file_exists( $uploads['path']."/". wp_basename($img) )){
						
						$saveimages[] = $uploads['path']."/". wp_basename($img); 
					}
				} 
			}
		}
	 	*/
		 
		
		// NOW LOOP ALL IMAGES
		$images = array();
		if(isset($_POST['childtheme']['images'])){
		$images = explode(",",trim($_POST['childtheme']['images']));
		}
		
		if( is_array($images) && !empty($images) ) {
				
			foreach($images as $img){
				
				if(strlen($img) > 5 && file_exists( $uploads['path']."/". wp_basename($img) )){
						
					$saveimages[] = $uploads['path']."/". wp_basename($img); 
				}
			} 
		}
		
	   
		// 4. BUILD THE FUNCTIONS FILE	 
		$funContent = file_get_contents(TEMPLATEPATH."/framework/sampletheme_func.txt");	
		
		$this_theme_key = $template_name;
		/*
		(theme_key)
		(theme_name)
		(theme_logo)
		(preview_image)
		*/	
		$funContent = str_replace("(core_key)", 	strtolower(THEME_KEY), $funContent);		
		$funContent = str_replace("(theme_key)", 	$this_theme_key, $funContent);
		$funContent = str_replace("(theme_name)", 	strip_tags($cname), $funContent);		
		$funContent = str_replace("(theme_color1)", _ppt(array('design','color_primary')), $funContent);
		$funContent = str_replace("(theme_color2)", _ppt(array('design','color_secondary')), $funContent);
		$funContent = str_replace("(logo_text)", $logo_text, $funContent);
		$funContent = str_replace("(logo_url)", $logo_url, $funContent);			 	
		$funContent = str_replace("(preview_image)", 	$preview_image, $funContent); 		    
		$funContent = str_replace("(theme_header)", _ppt(array('design','header_style')), $funContent);
 		$funContent = str_replace("(theme_footer)", _ppt(array('design','footer_style')), $funContent); 
		
		
		// ELEMENTOR
		$funContent = str_replace("(elementor_homepage_name)", $elementor_homepage_name, $funContent);
		
		
		/* DESIGN EXTRA */
		$extra = stripslashes($_POST['childtheme']['data']);
		
		// IMAGE PATH REPLACE
		$extra = str_replace($uploads['url'], '[path-images]/images/', $extra); 	////'get_theme_root_uri()"/'.strip_tags($cname).'/images/' 	
		$extra = str_replace("//", "/", $extra);
		
		
		
		/*
		if( _ppt(array('design','header_style')) ){ 
			ob_start(); 
			foreach($core_admin_values['design'] as $k=> $v){ 
			?>$core['design']['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";<?php
			}
			$extra = ob_get_clean();
		} 		
		*/
		$funContent = str_replace("(design_extra)", $extra, $funContent);
		
		// SAVE CONTENT TO FUNCTIONS FILE
		$handle = fopen($uploads['path']."/functions.php", "w");
		if (fwrite($handle, $funContent) === FALSE) {
				echo "Cannot write to functions file";
				die();
		} 
		fclose($handle);
		
		//die($funContent.$uploads['path']."/functions.php");	
			  
			
		// ADD IN ALL FILES
		$addfiles = array();
		$addfiles[] = $uploads['path']."/style.css";
		$addfiles[] = $uploads['path']."/functions.php";
		
		// ELEMENTOR FILES
		if(strlen($elementor_homepage_name) > 1){
			$addfiles[] = $elementor_homepage_path;
		}
		
		// IMAGE FILES
		if(isset($logofile)){
			$addfiles[] = $logofile;
		}
		
		// SCREENSHOT
		if(is_numeric(_ppt(array('childtheme','thumb_url_aid'))) && strtolower(substr(_ppt(array('childtheme','thumb_url')), -3)) == "png" ){		
			$addfiles[] = $uploads['path']."/screenshot.png";
		}else{
			$addfiles[] = TEMPLATEPATH."/framework/screenshot.png";
		}
		 
		// PREVIEW IMAGE
		if(strlen($preview_image) > 1){		
			$addfiles[] = $preview_image_file;			
		}
 		 
		// CLEAN ARRAY
		$addfiles1 = "";
		foreach($addfiles as $f){
			if(strlen($f) > 5){
				$addfiles1 .= $f.",";
			}
		}
		
		// CLEAN STRING
		$addfiles1 = substr($addfiles1,0,-1);		 
		
		// 4. ZIP EVERYTHING TOGETHER
		$zipfile = new PclZip($uploads['path']."/".$template_name.".zip");		
		$zipfile->add($addfiles1, PCLZIP_OPT_REMOVE_ALL_PATH,  PCLZIP_OPT_ADD_PATH, $template_name); 
		
		// ADD IMAGES AFTER		  
		if(!empty($saveimages)){		
			foreach($saveimages as $img){				 
				$zipfile->add($img, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $template_name."/images/");
			}
		}		 
		 
		// CREATE LANGUAGES
		$zipfile->add(TEMPLATEPATH."/framework/index.html", PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $template_name."/languages/");
		 
		// CREATE JS
		$zipfile->add(TEMPLATEPATH."/framework/index.html", PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $template_name."/js/");
 		  
		// BUILD
		$file = $uploads['path']."/".$template_name.".zip";
		$file_download = $uploads['url']."/".$template_name.".zip";		
		
		if(headers_sent()){
		?>
        <h1>Download Ready</h1>
        <p>Use the link below to download your child theme.</p>
        <p><a href="<?php echo $file_download; ?>"><?php echo $file_download; ?></a>
        <?php 
		die();
		}elseif(file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
		}else{
		die("Theme file unavailable.");
		} 


}






 
class framework_mobile extends framework_user {
	
 

function handle_membership_expire(){

global $wpdb;
 	
	$args = array('posts_per_page' => 100, 
				'post_type' => 'listing_type', 'orderby' => 'rand', 'order' => 'asc', 'fields' => 'ID', 
				'meta_query' => array (
						array( 
							'key' => 'ppt_subscription',	
							'compare' => '!=',
							'value' => "",						 							 
						),
					  ) 
	);	
		
		
	$wp_custom_query = new WP_User_Query($args);
	  
	if(count($wp_custom_query->results) > 0){
		$tt = $wpdb->get_results($wp_custom_query->request, OBJECT);
		foreach($tt as $u){	  
			 
			 // CHECK IF EXPIRED
			 // EXPIRED EMAIL ATTACHED
			$this->USER("membership_active", $u->ID);
		
		}
	} 
	  
}


	function premiumpress_cron_activation() {
	 
		if ( !wp_next_scheduled( 'premiumpress_hourly_event_hook' ) ) {
			wp_schedule_event( time(), 'hourly', 'premiumpress_hourly_event_hook' );
		}
	
		if ( !wp_next_scheduled( 'premiumpress_daily_event_hook' ) ) {
			wp_schedule_event( time(), 'daily', 'premiumpress_daily_event_hook' );
		}
		
	}
	function cron_hourly(){ global $CORE, $wpdb;
	
	 	// PERFORM LISTING EXPIRY
		$this->handle_listings_expire();
		
		// PERFORM LISTING EXPIRY
		$this->handle_listings_upgrade_expire();	
		
		// PERFORM LISTING EXPIRY
		$this->handle_membership_expire(); 
		
		// PERFORM LISTING CHECKS
		if(defined('THEME_KEY') && THEME_KEY == "mj"){
		$this->handle_listings_without_accepted_offers();
		}
		
		// DELETE ONLINE USERS
		if(!defined('WLT_DEMOMODE')){		
			delete_metadata( 'user', null, 'online', '', true );
		}
		
		// DELETE TEMP POSTS
		$SQL = "SELECT DISTINCT ID FROM $wpdb->posts WHERE post_title LIKE '%temp post%' LIMIT 100";			 
		$fp = $wpdb->get_results($SQL, ARRAY_A);
		if(is_array($fp) && !empty($fp)){
			foreach($fp as $d){
				wp_delete_post( $d['ID'], true );
				
				$_GET['eid'] = $d['ID'];
				$media = $CORE->MEDIA("get_all_images", $d['ID']);	 
				unset($_GET['eid']);
				
				if(!empty($media)){  foreach($media as $img){
					
					$CORE->UPLOAD_DELETE($img['pid']."---".$img['aid']);
				
				}}
				
			}
		}  
		
		 
	}

	function cron_daily(){ global $CORE, $wpdb;		
		
		//  ONLINE OLD LOGS
		$args = array( 				
			'post_type' 		=> 'ppt_logs',
			'posts_per_page' 	=>  100,				
			'date_query' => array(
					'before'     => '1 week ago',
					'inclusive' => true
			),	 					
		);
		$found_logs = new WP_Query($args);
		
		$logs = $wpdb->get_results($found_logs->request, OBJECT);
		foreach($logs as $log){		 
			wp_delete_post( $log->ID, true );		 
		 }	 
	 
	 	// CLEAN UP OLD DATA
		delete_option('ppt_saved_zipcodes'); 
		
		// OLD MESSAGES
		$args = array( 				
			'post_type' 		=> 'ppt_message',
			'posts_per_page' 	=>  100,				
			'date_query' => array(
					'before'     => '1 month ago',
					'inclusive' => true
			),	 					
		);
		$found_logs = new WP_Query($args);
		$logs = $wpdb->get_results($found_logs->request, OBJECT);
		foreach($logs as $log){		 
			wp_delete_post( $log->ID, true );		 
		 }
		
		
		
	}
	
	
	function isMobileDevice(){ global $userdata;
	 
	    if(!isset($_SERVER["HTTP_USER_AGENT"])){
		return false;
		}	
		
		// GET THE BROWSER AGENTS
        $agent = $_SERVER["HTTP_USER_AGENT"]; 
		    
		// CHECK FOR MOBILE DEVICE
		if (strpos(strtolower($agent), "facebook") === false) { }else{ return false;}	
		 
        $mobile = false;
        $agents = array("Alcatel", "Blackberry", "HTC",  "LG", "Motorola", "Nokia", "Palm", "Samsung", "SonyEricsson", "ZTE", "iPhone", "iPod", "Mini", "Playstation", "DoCoMo", "Benq", "Vodafone", "Sharp", "Kindle", "Nexus", "Windows Phone", "Mobile",'mobile');
        foreach($agents as $a){
		 
            if(stripos($agent, $a) !== false){
			 
				// SET CONSTANT
				return true;
            }
        }	
		
		if(isset($_GET['mobile_view'])){
			return true;
		}  
		
        return false;
	}	
	
	
	
}

?>