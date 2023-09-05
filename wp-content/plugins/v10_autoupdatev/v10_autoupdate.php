<?php
/*
Plugin Name: [MISC V10] - WordPress Network Theme Update
Plugin URI: https://www.premiumpress.com
Description: This plugin will check for theme and plugin updates on a WordPress multisite setup.
Version: 1.0
Author: Mark Fail
Author URI: http://www.premiumpress.com
License:
*/

add_filter('plugins_api', 'wlt_plugin_v10_plugin_api_call', 10, 3);

add_filter('pre_set_site_transient_update_plugins', 'wlt_plugin_v10_check_for_plugin_update' );
add_filter('pre_set_site_transient_update_themes', 'wlt_plugin_v10_check_for_theme_update' );
 
/* =============================================================================
   CORE SYSTEM PLUGIN UPDATE TOOL
   ========================================================================== */

function wlt_plugin_v10_check_for_theme_update($theme_data) {
	//
	global $wp_version, $theme_version, $theme_base;
	
	//Comment out these two lines during testing.
	if (empty($theme_data->checked)){ return $theme_data; }
	
	// NOW LOOP THROUGH ALL OUR PLUGINS TO CHECK FOR UPDATES
	if(is_array($theme_data->checked)){ 
		// LOOP ALL THEMES
		foreach($theme_data->checked as $key => $version){
			// CHECK NAME
			if(substr($key,0,9) != "template_" && !in_array($key,array('VT10','DT10','CM10','RT10','DA10','SP10','AT10','PH10','CP10','CT10', 'MJ10','JB10','SO10','PH10','DL10')) ){ continue; } 
			// build request
			$request = array( 'slug' => $key, 'version' => $version  );
			// Start checking for an update
			$send_for_check = array(
				'body' => array(
					'action' => 'theme_update', 
					'request' => serialize($request),
					'api-key' => md5(get_bloginfo('url'))
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);
			// EXECUTE 
			$raw_response = wp_remote_post("https://www.premiumpress.com/_themesv10/", $send_for_check);
			if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
				$response = unserialize($raw_response['body']);
		 
			// Feed the update data into WP updater
			if (isset($response['package'])){		 
				$theme_data->response[$key] = $response;
			}		
		
		} // end foreach
	}// end if 
	
	return $theme_data;
}
   
function wlt_plugin_v10_check_for_plugin_update($plugin_data) {
 
	 
	return $plugin_data;
}
function wlt_plugin_v10_plugin_api_call($def, $action, $args) {
	global  $wp_version;
	// RETURN IF INVALID	
 
	if (!isset($args->slug)){ return false; } 
	if(substr($args->slug,0,4) != "wlt_"){ return $def; }
	// SET SITE SO IT KNOWS WERE GOING TO UPDATE
	$plugin_info = get_site_transient('update_plugins');
	// GET THE CURRENT VERSION 
	$current_version = $plugin_info->checked[$args->slug .'/'.$args->slug.'.php'];
	$args->version = $current_version;
	// BUILD STRING
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	 // MAKE REQUEST
	$request = wp_remote_post("http://www.premiumpress.com/_pluginsv9/", $request_string);
 	// PROCESS AND DISPLAY
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	// RETURN
	return $res;
}
?>