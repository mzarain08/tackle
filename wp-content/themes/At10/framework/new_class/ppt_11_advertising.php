<?php


class framework_advertising extends framework_geo {


	function ADVERTISING($action='add', $order_data = "123"){
	
	global $userdata, $wpdb, $CORE;
	 
		switch($action){
		
		

		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "popup_delete": {

			wp_delete_post($order_data, true); 
			die();
			
		} break;
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
		
		case "popup_generated_new": {

			 
			
		} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "popup_fields": {
		
			$fields = array(
				
				
				"status"  => array(
				
						"name" 	=> __("Status","premiumpress"),
						"values" => array(

							"1" => array("id" => "1", "name" => __("Pending","premiumpress") ),							
							"3" => array("id" => "3", "name" => __("Live","premiumpress") ),
						),
						"type" => "select",						
						"default" => "3",
						
				),
				
				
				
				"date_end"	=> array(
						
						
						"name"	=>__("End Date","premiumpress"),
						
						"default" => date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +1 hour")),
						
						"type" => "date",
						
						
				),
				
				"divider"	=> array(
				
					"name" 	=> __("Popup Settings","premiumpress"),
					"type" => "seperator",
				
				),
				
				"type"  => array(
				
						"name" 	=> __("Popup Type","premiumpress"),
						"values" => array(

							 
							1 => array("id" => "1", "name" => __("Custom Popup","premiumpress") ),
							
							2 => array("id" => "2", "name" => __("User Login","premiumpress") ),
							3 => array("id" => "3", "name" => __("User Logout","premiumpress") ),
							4 => array("id" => "4", "name" => __("User Upgrade","premiumpress") ),
							 
						),
						"type" => "select",						
						"default" => "1",
						
				),
				
				
				"show"  => array(
				
						"name" 	=> __("Show To","premiumpress"),
						"values" => array(

							"1" => array("id" => "1", "name" => __("All Users","premiumpress") ),
							"2" => array("id" => "2", "name" => __("Guests Only","premiumpress") ),	
							"3" => array("id" => "3", "name" => __("Members Only","premiumpress") ),	
							
													 
						),
						"type" => "select",						
						"default" => "1",
						
				), 
				
				"title"	=> array(		
						"name" => __("Display Caption","premiumpress"),		
						"default" => "",
						"type" => "text",
						"css" => "col-12 mb-4",						
				),
				 
				
				"link"	=> array(
						"name" => __("Click Link","premiumpress"),
						"default" => "",
						"type" => "text",
				),
				
				"image"	=> array(
						"name" 		=> __("Image Link","premiumpress"),
						"default"	=>"",
						"type" => "text", 
				),
				 
				 "userid"	=> array(
						"name" => __("User ID","premiumpress"),
						"default" => 0,
						"type" => "hidden",
				),
				 
				
			
			);
			
			
			// GET LSIT VALUE
			if(is_array($order_data) && !empty($order_data)){
				if(isset($fields[$order_data[0]]["values"][$order_data[1]])){
				return $fields[$order_data[0]]["values"][$order_data[1]]['name'];
				}else{
				return "";
				}
				
			}
			 
			
			
			return $fields;
		
		} break;
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "popup_new": {
		
		$type = $order_data[0];
		$uid = $order_data[1];
		 
		if(_ppt(array('liveads',$type)) != "1"){
			return;
		} 

		$CORE->ADVERTISING("popup_clear", array()); 
		
		$fields = $CORE->ADVERTISING("popup_fields", array());  
		
		switch($type){
		
			case "login": {				
				
				$fields['type']['default'] = 2;
				$fields['userid']['default'] = $uid;
			
			} break;
			case "logout": { 
				$fields['type']['default'] = 3;
				$fields['userid']['default'] = $uid;			
			} break;
			case "upgrade": {
				$fields['type']['default'] = 4;
				$fields['userid']['default'] = $uid;
			
			} break;
		
		} 
		
		// CHECK WE DONT ALREADY EXISTS
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
				INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND mt1.meta_key = 'userid' AND mt1.meta_value = '".$uid."' )
				INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'type' AND mt2.meta_value = ".$fields['type']['default']." )
				WHERE ".$wpdb->prefix."posts.post_type = 'ppt_news' LIMIT 1";	
	 
		$result = $wpdb->get_results($SQL);	 
		if(!empty($result)){				
					return;				
		}
	
		// ADD NEW			
		$my_post = array();				
		$my_post['post_title'] 		= "Popup"; 
		$my_post['post_type'] 		= "ppt_news"; 
		$my_post['post_status'] 	= "publish";
		$my_post['post_content'] 	= ""; 
		$newid = wp_insert_post( $my_post );
		
		// ADD ON FIELDS
		foreach($fields as $k => $d){
			 
			if(isset($d['default'])){
			
			update_post_meta($newid, $k, $d['default']);
			
			}		
			
		} 
	
	
	} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "popup_clear": {
	
	
	$args = array('posts_per_page' => 100, 
			'post_type' => 'ppt_news', 'orderby' => 'meta_value', 'order' => 'asc', 'fields' => 'ID', 
			'meta_query' => array (
					array( 
						'key' => 'date',																
						'orderby' => 'meta_value',						 
						'compare' => '<',
						'value' => date('Y-m-d H:i:s'),
						'type' => 'DATETIME'							 
					),
				  ) 
	);	
	
	$found = query_posts($args);	
	if(!empty($found)){
		foreach($found as $p){ 				
			wp_delete_post( $log->ID, true );	
		}	
	} 
	 
	
	} break;
	
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	case "popup_get": {
	
	
		switch($order_data){
		
			case "login": {				
				 $type = 2;
			} break;
			case "logout": {
				$type = 3;				 			
			} break;
			case "upgrade": {
				$type = 4;
			} break;
			case "custom": {				
			 	$type = 1;
			} break;
		} 
	
		$seeAds = array();	
		$popup_data = array();			
		if(isset($_SESSION['seen_ads'])){
			$seeAds = $_SESSION['seen_ads'];
		}else{
			$_SESSION['seen_ads'] = array();
		}
		
		$show = array(1,2);
		if($userdata->ID){
		$show = array(1,3);
		}
		
		//die(print_r($show));
		
		$args = array(
				'post_type' 		=> 'ppt_news',
				'post_status'		=> 'publish',
				'orderby'			=> 'rand',
				'posts_per_page'	=> 1,
				//'post__not_in' 		=> $seeAds,
						 
				'meta_query' => array( 
							
					'relation' => "AND",							
					'type'    => array(
							'key' 			=> 'type',	
							'type' 			=> 'NUMERIC',
							'value' 		=> $type,
							'compare' 		=> '=',								 					 			
					), 	
					'show'    => array(
							'key' 			=> 'show',	
							'type' 			=> 'NUMERIC',
							'value' 		=> $show,
							'compare' 		=> 'IN',								 					 			
					),
					'status'    => array(
							'key' 			=> 'status',	
							'type' 			=> 'NUMERIC',
							'value' 		=> 3,
							'compare' 		=> '=',								 					 			
					),							 	
				),   
		);
		
		$wp_query1 = new WP_Query($args);
		 
		$data = array();
		if(!empty($wp_query1->post)){ // 
					 
		// ADD TO SEEN
		$_SESSION['seen_ads'][$wp_query1->post->ID] = $wp_query1->post->ID;
		
		
		if($order_data == "custom"){
		
			if(strlen(get_post_meta($wp_query1->post->ID, "title", true)) < 2){
			return 0;
			}	
				
			$popup_data = array(
				"type" 		=> $order_data,
				"name" 		=> get_post_meta($wp_query1->post->ID,"title",true),
				"image" 	=> get_post_meta($wp_query1->post->ID,"image",true),
				"link"		=> get_post_meta($wp_query1->post->ID,"link",true),
			);
			
		}else{
			
			$uid = get_post_meta($wp_query1->post->ID,"userid",true);
			$type = get_post_meta($wp_query1->post->ID,"type",true);
			if($type == 1){
			return 0;
			}
			
		 	if(!is_numeric($uid) || $uid == 0  ){

				$CORE->ADVERTISING("popup_delete", $wp_query1->post->ID );
				return 0;
				
			}elseif($CORE->USER("get_display_name", $uid) == ""){

				$CORE->ADVERTISING("popup_delete", $wp_query1->post->ID );
				return 0;
				
			}elseif( $uid == $userdata->ID ){
				return 0;
			}
			
			
			
			$popup_data = array(
				"type" 		=> $order_data,
				"uid"		=> $uid,
				"name" 		=> $CORE->USER("get_display_name", $uid),
				"image" 	=> $CORE->USER("get_avatar", $uid),
				"link"		=> $CORE->USER("get_user_profile_link", $uid),
			);
		} 
					     
		// UPDATE OUNTER
		$c = get_post_meta($wp_query1->post->ID,"hits",true);
		if(!is_numeric($c)){ $c = 0; }
		$c++;
		update_post_meta($wp_query1->post->ID,"hits",$c);
		} 
		
					 
		return $popup_data; 
		
	
	} break;
	
	///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "get_continue_button": {
		
				$k = $order_data;
				 
                
					if($userdata->ID){
					
						$sellspacedata 	= _ppt('sellspace');
                    
                    	// PAY CODE
						$btn =  $CORE->order_encode(array(   
							  "uid" 			=> $userdata->ID,                
							  "amount" 			=> $sellspacedata[$k."_price"],
							  "order_id" 		=> "BAN-".$k."-".$userdata->ID."-".rand(),                
							  "description" 	=> stripslashes($sellspacedata[$k."_name"]), 
						)); 
									
						$button = 'href="javascript:void(0);" onclick="processPayment(\''.$btn.'\',\''.$sellspacedata[$k."_price"].'\'); "';
									 
					}else{ 
									
						$button = 'href="javascript:void(0)" onclick="processLogin(0,\'\');"';
									
					} 
				 
				
				return $button;
			
			} break;
			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "campaign_expires": {
				
				$expires = get_post_meta($order_data,'expires',true);
				
				$expired = 0;
				$days = 0;
				
				// CHECK EXPIRES
				if($expires == ""){
					$expired = 1;				 
				}else{
				
					$da = $CORE->date_timediff($expires,'');
					if($da['expired'] == 1){
					
						$expired = 1;					
						update_post_meta($order_data,'status','ended'); 
						
					}else{
					$days = $da['string'];
					}
					 			  
				} 
				
				$data = array(
					"days" => $days,
					"date" => $expires,
					"expired" => $expired,
				);
				
				return $data;	
	
			} break;
			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "campaign_clicks": {
				
				$clicks = get_post_meta($order_data,'clicks',true);
				if($clicks == ""){
				$clicks = 0;
				}
				return number_format($clicks);	
	
			} break;
			
			case "campaign_impressions": {
				
				$clicks = get_post_meta($order_data,'impressions',true);
				if($clicks == ""){
				$clicks = 0;
				}
				return number_format($clicks);	
	
			} break;
			
			case "update_impressions": {
			
				$clicks = get_post_meta($order_data,'impressions',true);
				if($clicks == ""){
				$clicks = 0;
				}
				
				update_post_meta($order_data,'impressions',$clicks+1);
				
			} break;			
		
			case "campaign_status": {
			
				
				$status_array = array(
				
					"active" => array(
						"key"	=> "publish",
						"name" => __("Live","premiumpress"),
						"short" => __("Live","premiumpress"),
						"color" => "#00b517",
					),	
				 
					"pending" => array(	
						"key" 	=> "payment",				
						"name" 	=> __("Pending Update","premiumpress"),
						"short" => __("Pending","premiumpress"),
						"color" => "#ff9017",
					),
					
					"hold" => array(	
						"key" 	=> "hold",				
						"name" 	=> __("On Hold","premiumpress"),
						"short" => __("On Hold","premiumpress"),
						"color" => "#ff9017",
					),
					 
					
					"ended" => array(
						"key"	=> "ended",
						"name" => __("Finished","premiumpress"),
						"short" => __("Finished ","premiumpress"),
						"color" => "#17a2b8",
					),
					
					
				);
				
				if(is_numeric($order_data)){
				
					$status = get_post_meta($order_data,'status',true);
					
					if(isset($status_array[$status])){
						return $status_array[$status];					
					}
					
					return $status_array["pending"];
					
				 
				
				}else{
				
				return $status_array;
				
				}
				
				 
			
			
			} break;	
			
			case "check_exists": {	
			
			 	 
				if(_ppt(array('mem','enable')) == "1" && isset($userdata->ID) && $CORE->USER("membership_hasaccess", "adfree")){
					return 0;				
				}
				 
				// BANNER KEY (FOOTER, HEADER ETC)
				if(is_array($order_data)){
				$banner_key 	= $order_data[0];				
				}else{
				$banner_key 	= $order_data;				
				}
				
				// SELLSPACE
				$sellspacedata = _ppt('sellspace'); 
				 
				// args
				$args = array(
							'posts_per_page' 	=> 1, 
							'post_type' 		=> 'ppt_campaign', 
							'orderby' 			=> 'post_date', 
							'order' 			=> 'desc',
							'post_status'		=> 'publish',
							'meta_query' => array(
								array(
									'key'     => 'location',
									'value'   => $banner_key,
									'compare' => '=',
								),							
								
								array(
									'key'     => 'status',
									'value'   => "active",
									'compare' => '=',
								),
							),
					);
				 	 
				$wp_query1 = new WP_Query($args); 
				$tt = $wpdb->get_results($wp_query1->request, OBJECT);
				 
					  
				if(!empty($tt)){			
					
					return 1;
					
				}elseif(isset($sellspacedata[$banner_key]) && $sellspacedata[$banner_key] == 1 && isset($sellspacedata[$banner_key."_sample"]) && $sellspacedata[$banner_key."_sample"] ){
					
					return 1;
										
				}
			   	
			   	return 0;				
				
			
			} break;
			
			case "get_spaces": {
			 
			
			// SELL SPACE AREAS
			$sellspace = array(	
			
			
				"header_top" => array(		 
					"n" => "Top Menu",
					"desc" => "Only visible in some designs.",
					"sw" => "468",
					"sh" => "60",
					"p"	=> "header_top",
					"min" => 1,
					"max" => 1,			
					"icon" => CDN_PATH."images/advertising/s12.png",			
				),	 
				
				"header" => array(		 
					"n" => "Header",
					"sw" => "468",
					"sh" => "60",
					"p"	=> "header",
					"min" => 1,
					"max" => 1,	
					"icon" => CDN_PATH."images/advertising/header.png",				
				),				
			 
				"footer" => array(		 
					"n" => "Footer",
					"sw" => "468",
					"sh" => "60",
					"p"	=> "footer",
					"min" => 1,
					"max" => 1,
					 "icon" => CDN_PATH."images/advertising/footer.png",	
					
				),
				
				"account_top" => array(		 
					"n" => "Account Page (Top)",
					"sw" => "468",
					"sh" => "60",
					"p"	=> "account_top",
					"min" => 1,
					"max" => 3,
					"icon" => CDN_PATH."images/advertising/atop.png",	
					 
					
				),
			
				"blog_top" => array(		 
					"n" => "Blog Sidebar (Top)",
					"sw" => "280",
					"sh" => "250",
					"p"	=> "blog_top",
					"min" => 1,
					"max" => 3,
					"icon" => CDN_PATH."images/advertising/btop.png",	
					 
					
				),
				
				"blog_bottom" => array(		 
					"n" => "Blog Sidebar (Bottom)",
					"sw" => "280",
					"sh" => "250",
					"p"	=> "blog_bottom",
					"min" => 1,
					"max" => 3,
					"icon" => CDN_PATH."images/advertising/bbot.png",	
					 
				), 
				
				// SEARCH PAGE
				"search_top" => array(		 
					"n" => "Search Top",
					"sw" => "728",
					"sh" => "90",
					"p"	=> "search",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/stop.png",	
					 
				),
				
				// SEARCH PAGE
				"search_middle" => array(		 
					"n" => "Search Middle",
					"sw" => "728",
					"sh" => "90",
					"p"	=> "search",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/stop.png",	
					 
				),
				
				"search_bottom" => array(		 
					"n" => "Search Bottom",
					"sw" => "728",
					"sh" => "90",
					"p"	=> "search",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/sbot.png",	
				),
				
				"search_sidebar_top" => array(		 
					"n" => "Search Sidebar - Top",
					"sw" => "280",
					"sh" => "200",
					"p"	=> "search",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/sstop.png",	
				),
				
				"search_sidebar_bottom" => array(		 
					"n" => "Search Sidebar - Bottom",
					"sw" => "280",
					"sh" => "200",
					"p"	=> "search",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/ssbot.png",	
				), 
				
				// SINGLE PAGE
				"single_sidebar" => array(		 
					"n" => "Single ".$CORE->LAYOUT("captions", 1)." Sidebar",
					"sw" => "350",
					"sh" => "250",
					"p"	=> "single",
					"min" => 1,
					"max" => 1,
					"icon" => CDN_PATH."images/advertising/ps.png",	
				),	
				
				
									
			);
			
			
			// UNSET UNUSED 
			
			if(!is_array($order_data) && strlen($order_data) > 1){
				
				if(isset($sellspace[$order_data])){
					return $sellspace[$order_data];
				}
				return $sellspace["header"];
			}
			
			if(is_array($order_data) && isset($order_data[0]) && $order_data[0] == "enabled"){
			
				foreach($sellspace as $k => $s){
					if(_ppt(array('sellspace', $k )) != "1"){
						unset($sellspace[$k]);
					} 
				}
			}
			
			
			return $sellspace;
			
			
			} break;
			
			case "get_user_banners": {
			
					$mybanners = array();
					
					$userid = $order_data[0];
					if(isset($order_data[1])){
						$size1 = $order_data[1];
						$size2 = $order_data[2];
					}
					
					if(isset($size1)){		
					
					$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."
							INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'width' AND t1.meta_value = '".$size1."')
							INNER JOIN ".$wpdb->postmeta." AS t2 ON ( t2.post_id = ".$wpdb->posts.".ID AND t2.meta_key = 'height' AND t2.meta_value = '".$size2."')
							WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_author = ".$userid."  LIMIT 0,50";	
			 
					}else{
					$SQL = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'ppt_banner' AND post_author = ".$userid." ORDER BY post_date DESC"; 
					}
				  
					$posts = $wpdb->get_results($SQL);	 
					foreach($posts as $post){ 
						$mybanners[] = array(
							'id' => $post->ID, 
							'name' => $post->post_title, 
							'img' => $post->post_excerpt, 
							'w' => get_post_meta($post->ID, 'width', true), 
							'h' => get_post_meta($post->ID, 'height', true)  
						);
					}
				 
					return $mybanners;	
			
			} break;
			
			case "get_all_banners": {
			
					$SQL = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'ppt_banner' ORDER BY post_date DESC"; 					
				  	$mybanners = array();
					$posts = $wpdb->get_results($SQL);	 
					foreach($posts as $post){ 
						$mybanners[] = array(
							'id' => $post->ID, 
							'name' => $post->post_title, 
							'img' => $post->post_excerpt, 
							'w' => get_post_meta($post->ID, 'width', true), 
							'h' => get_post_meta($post->ID, 'height', true)  
						);
					}
				 
					return $mybanners;	
			
			
			} break;
						
			case "get_banner_link": {			
			
			
			return home_url()."/outbanner/".$order_data."/";
			
			} break;			
			
			case "get_banner": {	
				
				
				// BANNER KEY (FOOTER, HEADER ETC)
				if(is_array($order_data)){
				$banner_key 	= $order_data[0];			 
				}else{
				$banner_key 	= $order_data;				 
				}  
				
				// GET DATA
				$OUTINNER = "";				 
				$sellspacedata = _ppt('sellspace');
				 
				// args
				$args = array(
							'posts_per_page' 	=> 10, 
							'post_type' 		=> 'ppt_campaign', 
							'orderby' 			=> 'rand', 
							'order' 			=> 'desc',
							'post_status'		=> 'publish',
							'meta_query' => array(
								array(
									'key'     => 'location',
									'value'   => $banner_key,
									'compare' => '=',
								),							
								
								array(
									'key'     => 'status',
									'value'   => "active",
									'compare' => '=',
								),
							),
				);
				 					 
				$wp_query1 = new WP_Query($args); 
				 
				$tt = $wpdb->get_results($wp_query1->request, OBJECT);	
			  		
				if(!empty($tt)){
				
					// GET RANDOM BANNER
					$tc = count($tt);
					if($tc > 1){
						$randomID = rand(0,$tc-1);
					}else{
						$randomID = 0;
					}
					
					// RANDOM BANNER ID
					$RanBannerID = $tt[$randomID]->ID;					  
				
					// GET BANNER
					$bannerID = get_post_meta($RanBannerID,"bannerid",true);
					$code = get_post_meta($RanBannerID,"code",true);
					
					if(strlen($code) > 1){
					
					$OUTINNER .= $code; 
					
					$CORE->ADVERTISING("update_impressions", $RanBannerID);
					
					}elseif(is_numeric($bannerID)){ 
					
					$img = $CORE->ADVERTISING("banner_image", $bannerID);
					$OUTINNER .= '<a href="'.$CORE->ADVERTISING("get_banner_link", $RanBannerID).'">
					<img src="'.$img.'" alt="banner" class="sellspace img-fluid" />
					</a>';
					
					$CORE->ADVERTISING("update_impressions", $RanBannerID);
					
					} 
					 
				
				// DISPLAY SAMPLE BANNERS IF REQUIRED
				}elseif( isset($sellspacedata[$banner_key."_sample"]) && $sellspacedata[$banner_key."_sample"] ){						
					 
						// CHECK FOR A CUSTOM LINK							 
						$adlink = _ppt(array('links','sellspace'));
							
						$size = $sellspacedata[$banner_key.'_size'];
						
						
						$size_parts = explode("x", $size);				
						$width = $size_parts[0];
						$heigth = $size_parts[1];
							
						// CHECK FOR SAMPLE BANNER
						if( _ppt('samplebanner_'.$width.'x'.$heigth) != "" && substr( _ppt('samplebanner_'.$width.'x'.$heigth) ,0,4) == "http"){ 
							
							$OUTINNER .= '<a href="'.$adlink.'?selladd=1&amp;ad='.$banner_key.'" target="_blank">
							<img src="'._ppt('samplebanner_'.$width.'x'.$heigth).'" alt="samplebanner_'.$width.'_'.$heigth.' " class="sellspace_banner rounded w-100 banner_'.$width.'_'.$heigth.' img-fluid" />
							</a>';
							
						}else{
							
							$OUTINNER .= '<a href="'.$adlink.'?selladd=1&amp;ad='.$banner_key.'">
							<div class="sellspace_banner banner_'.$width.'_'.$heigth.' text-center hidden-xs hidden-sm w-100 mx-auto y-middle rounded" style="max-width:'.$width.'px; height:'.$heigth.'px;">
							<div class="title">'.__("Advertise Here","premiumpress").'</div>';
							if($width > 300){ $OUTINNER .= '<div class="pricing">'.__("view pricing","premiumpress").'</div>'; }
							$OUTINNER .= '</div></a>'; 
							
						}
				}			
			 
				return "<div class='sellspace-live'>".$OUTINNER."</div>";
			
		}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "banner_image": {
		
		return get_the_excerpt($order_data);
		
		} break;
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "banner_name": {
		
		return get_the_title($order_data);
		
		} break;
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "banner_data": {
		
			return array(
				'name' => get_the_title($order_data), 
				'img' => get_the_excerpt($order_data), 
				'w' => get_post_meta($order_data, 'width', true), 
				'h' => get_post_meta($order_data, 'height', true),
				'size' => get_post_meta($order_data, 'size', true) 
			);					 
		
		} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "display_banner": {
		
				$quickcode = _ppt(array("quick_banner", $order_data));
				
				if($quickcode == "off"){
				return "";
				}
				 	 	
				if(defined('WLT_DEMOMODE') && defined("THEME_KEY") && !in_array($order_data,array("header","search_top","single_sidebar","search_sidebar_bottom")) ){
				 
					$quickcode = DEMO_IMGS."?bannerid=".$order_data."&t=".THEME_KEY;
					if(isset($_SESSION['design_preview'])){
						$quickcode.= "&ct=".$_SESSION['design_preview'];
					}
					
					$quickcode = "<a href='javascript:void(0)' class='samplebanneronly'><img src='".$quickcode."' class='img-fluid' alt='sample banner'></a>";
				
				}
		
				switch($order_data){
				 
					 
					case "single_sidebar": { 
					
							if($quickcode != ""){ ?>
                            <div class="mt-4 text-center">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
							
							if($CORE->ADVERTISING("check_exists", "single_sidebar") ){ ?>
                            <div class="mt-4 text-center">                            
                            <?php echo $CORE->ADVERTISING("get_banner", "single_sidebar" );  ?>                            
                            </div>
                            <?php } 
                                                
					} break;
					
					case "search_top": { 
					
							if($quickcode != ""){ ?>
                            <div class="col-12 px-0"><div class="mb-3 text-center ">
                            <?php echo $quickcode;  ?>
                            </div></div>
							<?php }
							
							if($CORE->ADVERTISING("check_exists", "search_top") ){ ?>
							<div class="col-12 px-0"><div class="mb-3 text-center ">							  
							  <?php echo $CORE->ADVERTISING("get_banner", "search_top" );  ?>							  
							</div></div>
							<?php }
					
					} break;
										
					case "search_middle": {
							
							if($quickcode != ""){ ?>
                            <div class="col-12"><div class="my-3 py-3 text-center mt-n2">
                            <?php echo $quickcode;  ?>
                            </div></div>
							<?php }
							
							if($CORE->ADVERTISING("check_exists", "search_middle") ){ ?>
							<div class="col-12"><div class="my-3 py-3 text-center mt-n2">							  
							  <?php echo $CORE->ADVERTISING("get_banner", "search_middle" );  ?>							  
							</div></div>
							<?php }
					
					} break;
					
					case "search_bottom": {
					
							if($quickcode != ""){ ?>
                            <div class="my-3 text-center">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
							
							if($CORE->ADVERTISING("check_exists", "search_bottom") ){ ?>
                            <div class="my-3 text-center ">
							<?php echo $CORE->ADVERTISING("get_banner", "search_bottom" );  ?>
                            </div>
                            <?php } 
                                                
					} break;		
					
					case "search_sidebar_top": {
							
							if($quickcode != ""){ ?>
                            <div class="mb-4 d-none d-md-block">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
							
							if($CORE->ADVERTISING("check_exists", "search_sidebar_top") ){ ?>
                            <div class="mb-4 d-none d-md-block">
                            <?php echo $CORE->ADVERTISING("get_banner", "search_sidebar_top" );  ?>
                            </div>
                            <?php } 
                                                
					} break;	 		 
	 
					case "search_sidebar_bottom": {
					
					
							if($quickcode != ""){ ?>
                            <div class="mb-4 d-none d-md-block">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
							
							if($CORE->ADVERTISING("check_exists", "search_sidebar_bottom") ){ ?>
                            <div class="mb-4 d-none d-md-block">                            
                            <?php echo $CORE->ADVERTISING("get_banner", "search_sidebar_bottom" );  ?>                            
                            </div>
                            <?php } 
                                                
					} break;	


					case "header_top": {
					
							if($quickcode != ""){ ?>
                            <div class="hide-mobile">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
					
							if($CORE->ADVERTISING("check_exists", "header_top") ){ ?>
                            <div class="hide-mobile">
                            <?php echo $CORE->ADVERTISING("get_banner", "header_top" );  ?>
                            </div>
                            <?php } 
                                                
					} break; 
					
					case "header": {
					
							if($quickcode != ""){ ?>
                            <div class="py-4 text-center border-top border-bottom">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
					
							if($CORE->ADVERTISING("check_exists", "header") ){ ?>
                            <div class="py-4 text-center border-top border-bottom">
                            <?php echo $CORE->ADVERTISING("get_banner", "header" );  ?>
                            </div>
                            <?php } 
                                                
					} break; 
					
					case "blog_bottom": {
					
							if($quickcode != ""){ ?>
                            <div class="mb-4 text-center">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
					
							if($CORE->ADVERTISING("check_exists", "blog_bottom") ){ ?>
                            <div class="mb-4 text-center">
                            <?php echo $CORE->ADVERTISING("get_banner", "blog_bottom" );  ?>
                            </div>
                            <?php } 
                                                
					} break; 
					
					case "blog_top": { 
					
							if($quickcode != ""){ ?>
                            <div class="mb-4 text-center">
                            <?php echo $quickcode;  ?>
                            </div>
							<?php } 
					
							if($CORE->ADVERTISING("check_exists", "blog_top") ){ ?>
                            <div class="mb-4 text-center">
                            <?php echo $CORE->ADVERTISING("get_banner", "blog_top" );  ?>
                            </div>
                            <?php } 
                                                
					} break; 	
					 
									
				}
		
		} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		
	}
 
}
	
}

?>