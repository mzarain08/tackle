<?php


class framework_addlisting extends framework_advertising {

function handle_listings_without_accepted_offers(){ global $CORE;
 

	global $wpdb;

	$args = array(
   		'post_type' 		=> 'ppt_offer',
    	'posts_per_page' 	=> 100,
                        'paged' 			=> 1,
                     	'post_status'		=> 'publish',
						 'meta_query' => array(	
							  			 
									 'user2'   => array(
									 'key'     => 'offer_status',							
									 'compare' => '=',
									 'value' => 1	                     
								 ),						
							  
						 ),
    );					
                     
	$data = array();
	$wp_custom_query = new WP_Query($args); 
	$tt = $wpdb->get_results($wp_custom_query->request, OBJECT);
	foreach($tt as $g){
		 
		// GET ORDER ID
		$order_id = get_post_meta($g->ID, 'order_id', true);
		
		// GET ORDER DATE
		$order_date = get_post_meta($order_id, 'order_date', true);
		 
		$vv = $CORE->date_timediff(date("Y-m-d H:i:s", strtotime( $order_date . " + 5 days") ), date("Y-m-d H:i:s"));
	
		if($vv['expired'] == "1"){ 
		
				// GET AMOUNT
				$amount = get_post_meta($g->ID, "price", true);
				if(!is_numeric($amount)){
				$amount = 0;
				} 		
				
				// PRICE OFFER		 						
				$price_customoffer = get_post_meta($g->ID, "price_customoffer", true); 	
				
				// GET BUYER ID
				$buyer_id  = get_post_meta($g->ID, 'buyer_id', true);
				 			
				/// ADD ON CREDIT
				if( is_numeric($amount) && $amount  > 0 && $price_customoffer == ""){ // DONT CREDIT FOR CUSTOM OFFERS AS THEY ARE NOT PAID FOR					
						$c = get_user_meta($buyer_id,'ppt_usercredit', true);
						$c1  = $c + $amount;
						update_user_meta($buyer_id,'ppt_usercredit', $c1);						
				}
				
				
				// NOW CLOSE THE OFFER
				update_post_meta($g->ID, "offer_status", 3);
				update_post_meta($g->ID, "offer_complete", 5); 
				
				add_post_meta($g->ID, "feedback_date_seller", current_time( 'mysql' ));
				add_post_meta($g->ID, "feedback_date_buyer", current_time( 'mysql' ));
						
				update_post_meta(get_post_meta($g->ID, 'post_id', true),'status',1);		
		
		}
		
		
			
	} 

}


function PACKAGE($action='add', $order_data = "123"){

	global $userdata, $wpdb, $CORE;
 
	switch($action){
	
			
		 case "get_new_comments": {
		
			 
				$POSTID = $order_data;
				
				$text = "";
				$time = "";
				$uid = 0;
				$comments = get_comments("post_id=".$POSTID."&status=approve&orderby=date&order=desc");
			 
				if ($comments) {
				 
					$comment = $comments[0];
					 
					$text = $comment->comment_content;
					
					$uid = $comment->user_id;
					 
					$vv = $CORE->date_timediff($comment->comment_date);	
					$time = $vv['string-small']." ".__("ago","premiumpress");
				  
				
					// CHECK RATING TOTOAL
					// DONT DISPLAY BAD RATINGS
					$rating = get_comment_meta( $comment->comment_ID, 'ratingtotal', true);
					if($rating < 2){
						return "";
					}
				
				} 
				
				 
				if(strlen($text) > 1){
				
					return array("uid" => $uid, "text" => substr($text,0,50), "text_long" => substr($text,0,250), "time" => $time );
					 
				}		
				
				return "";
		
		} break;
	
	
		case "get_random_listings": { //AND t1.meta_key = 'featured' AND t1.meta_value = '1'
		

			$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."
		
						INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID )
		
						WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type' GROUP BY ID ORDER BY RAND() LIMIT ".$order_data;	
		
			 
		
			$images = array();
		
			$posts = $wpdb->get_results($SQL);	 
		
			foreach($posts as $post){ 
		
			$images[] = array('id' => $post->ID, 'post_title' => $post->post_title, 'src' => do_shortcode("[IMAGE pid='".$post->ID."' pathonly=1]"), 'link' => get_permalink($post->ID)   );
		
			}  
		
			return $images;	 

		
		} break;
	
		case "update_listing_rating": {
		
			// USED TO KEEP THE RATING SCORE ON THE LSITING
			// OTHERWISE WE CANNOT DO SEARCHES BY RATING	
			
			$totalvotes = 0;
			$totalamount = 0;
			$save_rating = 0;
			
			$args = array(					 
					'posts_per_page'	=> '150',
					'meta_query' => array( 
							array(
								'key'		=> 'ratingpid',
								'value' 	=> $order_data,
								'compare' 	=> '=',
							),							 
						),						
			);
			// GET LISTING FEEDBACK
			$c = new WP_Comment_Query($args);				
			$feedback = $c->comments;
			if(!empty($feedback)){ 
					$total_found = count($feedback);
					foreach($feedback as $co){
					
						// ADD A NEW ONE
						$newRating = get_comment_meta($co->comment_ID, 'ratingtotal', true);
						if(is_numeric($newRating) && $newRating >= 0 && $newRating <= 5){
							
						}else{
								$newRating = 5;
						}
					
					
						$totalvotes++;
						$totalamount = $totalamount + $newRating;
					
					}	 
			}	
			
			 
			$save_rating = round(($totalamount/$totalvotes),2); 
			update_post_meta($order_data, 'starrating', $save_rating);
			update_post_meta($order_data, 'starrating_total', $totalamount);
			update_post_meta($order_data, 'starrating_votes', $totalvotes); 
			
			//die("votes".$totalvotes." // amount ".$totalamount." // save ".$save_rating);
			
		 
		
		} break;
 	
		case "list_custom": {
		
			$key = $order_data[0];
			$val = $order_data[1]; 
		 	
			
			switch($key){
				
				case "makes1":
				case "makes": {
				
					$list = array();
					if(isset($GLOBALS['ppt_makes'])){
					$list = $GLOBALS['ppt_makes'];
					}
					$data = array();
					foreach($list as $m){
					$data[str_replace(" ","",strtolower($m))] = __($m,"premiumpress");
					}
				
				} break;
				
				case "models1":
				case "models": {
					 
					if(isset($GLOBALS['ppt_models'][$val])){
					$list = $GLOBALS['ppt_models'][$val];
					$data = array();
					foreach($list as $m){
					$data[$m] = __($m,"premiumpress");
					}
					
					}else{
					$data = array();
					}
				
				} break;
				
				default: {				
				
					$data = array();
				
				}
				
			} 
 
		
		
			return $data;
		
		} break;	
	 
		
		case "count_orders_per_package": {
			
			$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND mt1.meta_key = 'order_post_packageid' AND mt1.meta_value = '".$order_data."' )
			WHERE ".$wpdb->prefix."posts.post_type = 'ppt_orders'";	
		 	 			 
			$result = $wpdb->get_results($SQL);
			
			if(isset($result[0])){
			return $result[0]->total;		
			}			
			
			return 0;	 
		
		} break;
	
		case "count_listings_per_package": {
		
			 
			$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND mt1.meta_key = 'packageid' AND mt1.meta_value = '".$order_data."' )
			WHERE ".$wpdb->prefix."posts.post_type = 'listing_type'";	
		 	 			 
			$result = $wpdb->get_results($SQL);
			
			if(isset($result[0])){
			return $result[0]->total;		
			}			
			
			return 0; 
		
		} break;
	
	
		case "renew_data": { 
			
			// CHECK HAS EXPIRED
			$HasExpired = 0;
			if(get_post_meta($order_data,'listing_expiry_date',true) == ""){
				$HasExpired = 1;
			}
			
			// PACKAGE ID & KEY
			$pak = get_post_meta($order_data,'packageID',true);
			if(!is_numeric($pak)){
				$pak = 0;
			}			
			$PakKey = _ppt('pak'.$pak.'_key'); 
			
			// PACKAGE NAME
			$PakName = _ppt('pak'.$pak.'_name');
			
			// HOW MANY DAYS		
			$days = get_post_meta($order_data, 'listing_expiry_days', true);
			if(is_numeric($days)) {			
				$duration = $days;				
			}else{				
				$duration = _ppt('pak'.$pak.'_duration');
			}			
			if(!is_numeric($duration)){
				 $duration = 30; // default
			}	
				
			// PRICE
			$price =  get_post_meta($order_data,'listing_price_paid',true);
			if(!is_numeric($price)){ 				
				$price = _ppt('pak'.$pak.'_price');			
			}
			if(!is_numeric($duration)){
				 $price = 0; // default
			} 
			
			
			// FREE RENEWAL FOR AUCTIONS
			if(THEME_KEY == "at"){
				global $CORE_AUCTION;
				if($CORE_AUCTION->account_can_repost($order_data) == "1"){
				$price = 0;
				}
			}
			
			
			// ADDONS?
			$PakAddons = array();			
			$addons = $CORE->PACKAGE("get_packages_addons", array() );
			if(!empty($addons )){
				foreach($addons as $a){ 				 
					if( _ppt('pak'.$pak.'_'.str_replace("addon_","",$a['key'])) == '1' ){
					$PakAddons[$a['key']] = 1;
					}else{
					$PakAddons[$a['key']] = 0;
					}
				}
			}
			
		
			return array(
			
				"price" 	=> $price, 
				  
				"days" 		=> $duration, 
				"expired"	=> $HasExpired,
				
				"pak_ID" 	=>  $pak,
				"pak_key" 	=> $PakKey,
				"pak_name" 	=> $PakName,
				"pak_addons" => $PakAddons,
				
			); 
		
		
		} break;
	 	
		case "show_upgrades": {
		
		$g = false;
		
		if(_ppt(array('lst','addon_featured_enable')) == "1" || _ppt(array('lst','addon_sponsored_enable')) == "1" || _ppt(array('lst','addon_homepage_enable')) == "1"){
		
			$g = true;
		
		}
		
		return $g;
		
		
		} break;
		
		case "get_post_keywords": {
		
		
			$tfs = wp_get_post_tags($order_data);
			 
			$ftags = "";
			if(!empty($tfs)){
				foreach($tfs as $ta){ $ftags .= $ta->name.", "; }
			}	 
			
			$keywords = $ftags; 
		
			if(strlen($keywords) > 1){
			
				$words = explode(",", $keywords);
				
				return $words;
			
			}
			
			return false;
		
		
		} break;
	
		case "get_continue_button": {
		
			$k = $order_data; 
			
			$key = _ppt('pak'.$k.'_key');
			if($key == ""){
				$key == $k;
			}						
			 
			$button = 'href="'._ppt(array('links','add')).'/?packageid='.$key.'"';  
            
			return $button;
		
		} break;
	
		case "get_days_text": {
		
		
			$k = $order_data;
			
			// WORK OUR DAYS
			  $DAYS = _ppt('pak'.$k.'_duration');
			  if($DAYS == ""){ $DAYS =0; }
			   
			  // TUN OFF DURATION FOR AUCTION THEME
			  if(THEME_KEY == "at" && _ppt(array('lst','auction_time')) != '1' ){
			  $DAYS = 0;
			  }
			  
			  $daytext = ""; 
			  switch($DAYS){				
				  case "1": {
					  $daytext = "24 ".__("Hours","premiumpress");
				  } break;
				  case "7": {
					  $daytext = "1 ".__("Week","premiumpress");
				  } break;
				  case "30": {
				  	$daytext =  "1 ".__("Month","premiumpress");
				  } break;
				  case "365": {
				  	$daytext =  "1 ".__("Year","premiumpress");
				  } break;
				  default: { 				  
					  if(is_numeric($DAYS) && $DAYS > 0){
					  $daytext = $DAYS." ".__("Days","premiumpress");
					  }else{
					   $daytext = "";
					  }
				  }
			   } 
			   
			   // DAY  TEXT
			   if(strlen($daytext) > 0){
			   $daytext = __("Live for","premiumpress")." ".$daytext;
			   }
			
			return $daytext;
		
		} break;
		
		case "get_features_array": {
			
			$i 		= $order_data[0]; // pakid
			$type 	=  $order_data[1];
			 
			if(defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") !== false ){
			
				return array( 
				
					1 => array("name" => "My custom text here", "value" => "1"),
					2 => array("name" => "My custom text here", "value" => "1"),
					3 => array("name" => "My custom text here", "value" => "1"),
					4 => array("name" => "My custom text here", "value" => "1"),
					
				);
			}
			
			
			
			/*foreach($CORE->USER("membership_features", array()) as $f){  
	
			if( _ppt($n['key']."_".$f['key']."_hide") == "1" || _ppt("mem".$n['key']."_".$f['key']."_hide") == "1" ){ continue; }
			
			
			}*/
			 
			$features = array();
			$f =1; 
			while($f < 11){				
				
				if($type == "mem"){
				$name = $CORE->GEO("translate_mem_fea_name", array( stripslashes(_ppt('mem'.$i.'_txt'.$f)), $i, $f)  );				
				$value = _ppt('mem'.$i.'_txt'.$f.'_val');
				}else{
				$name = $CORE->GEO("translate_pak_fea_name", array( stripslashes(_ppt('pak'.$i.'_txt'.$f)), $i, $f)  );				
				$value = _ppt('pak'.$i.'_txt'.$f.'_val');
				}
				
				 
				if($value == ""){ $value = 1;}
				
				if(strlen($name) > 1){
					$features[] = array(				
						"name" 	=> $name,
						"value" => $value,					
					);
				}
				
				$f++;
			}
			
			return $features;
		
		} break;
	
		case "count_enabled_packages": {
		
			$i = 0; $found = 0;
			while($i < 10){
				
				if( _ppt('pak'.$i.'_enable') == '1' ){  $found++; }
			 
				$i++;
			}
			 
   
		
		return  $found;
		
		} break;
		
		case "has_expired": {		
			
			// DONT EXPIRE DATING LISTINGS
			if( in_array(THEME_KEY, array("da")) ){
				return 0;
			}
			
			$expires = get_post_meta($order_data, 'listing_expiry_date', true);		
			
			
			 
			if($expires == "" && get_post_status($order_data) != "expired"){ 
				return 0;
			}			
			
			// CHECK STATUS
			if(get_post_status($order_data) == "expired"){
				return 1;
			}
			
			$ff = $this->date_timediff($expires,'');
			 
			if($ff['expired'] == 1) { 
				return 1;
			}
			
			return 0;
		
		
		} break;
	
		case "get_timesince": {
		 
				$ff = $this->date_timediff($order_data,'');
				
				if($ff['expired'] == 1) {
					
					return $ff['string-small'];
				
				}
	 
				return $ff['string-small'];
				 
		
		} break;
	
		case "featured": {
		
			if(is_numeric($order_data) && _ppt(array('lst','addon_featured_enable')) == "1" ){
				if(get_post_meta($order_data,'featured', true) == 1){
					return true;
				}			
			}
			
			return false;
		
		} break;
		
		case "homepage": {
		
			if(is_numeric($order_data)){
				if(get_post_meta($order_data,'homepage', true) == 1){
					return true;
				}			
			}
			
			return false;
		
		} break;
				
		case "sponsored": {
		
			if(is_numeric($order_data)){
				if(_ppt(array('lst','addon_sponsored_enable')) == "1" && get_post_meta($order_data,'sponsored', true) == 1){
					return true;
				}			
			}
			
			return false;
		
		} break;		
	
		case "canedit": {
		
			
			$edit_data = get_post($order_data);
			
			if(!isset($edit_data->post_author)){
			return false;
			}
			
			// CHECK WE ARE THE AUTHOR
			if($edit_data->post_author != $userdata->ID && !current_user_can('administrator') ){
			return false;
			}
			
			return true;
		
		} break;	
		
		case "get_hits": {
		 
			$g = $order_data;
			
			$count = 0;			 
		 	
			$data = get_post_meta($g[0],'hits_array',true);
			if(!is_array($data)){ $data = array(); }
			 	
			switch($g[1]){
				
				case "all": {
				 	
					foreach($data as $h){
					
						$count =  $count + $h['hits'];					
					}					
				 
				} break;
				
				default: {
				
					if(isset($data[$g[1]])){
					
						$count = $data[$g[1]]['hits'];
					
					}
				
				} break;
			
			}	 
			 
					 
			update_post_meta($g[0],'hits',$count);
			
			return number_format($count);
			
		
		} break;
		 
		
		
		case "update_hits": {
		
			// POST ID
			$PID = $order_data;	
			
			// HITS ARRAy
			$data = get_post_meta($PID,'hits_array',true);
			 
			if(!is_array($data)){ $data = array(); }
			
			// GET DATE			  
			$date_now = date('Y-m-d');
			
			
			// update
			if(isset($data[$date_now]) && isset($data[$date_now]) ){
			
				$data[$date_now] = array("date" => $date_now, "hits" => $data[$date_now]['hits']+1, "last_visit" => date('Y-m-d H:i:s'));  
							
			}else{	  
				$data[$date_now] = array("date" => $date_now, "hits" => 1 );
			} 
					 
			// SAVE			
			update_post_meta($PID,'hits_array',$data);	
			  
		
		} break; 
		 
	
		case "get_user_listing_ids_published": {
		
		 	// POST ID
			$UID = $order_data;		 	 
			$args = array('posts_per_page' => 100,  'post_type' => "listing_type", 'post_status' => array( 'publish' ), "author__in" => $UID );			
			$data = array();
			$wp_custom_query = new WP_Query($args); 
			$tt = $wpdb->get_results($wp_custom_query->request, OBJECT);
			foreach($tt as $g){			
				$data[] = $g->ID;			
			}
			
			return $data;		
		
		} break;
			
		case "get_user_listing_ids": {
		
		 	// POST ID
			$UID = $order_data;		 	 
			$args = array('posts_per_page' => 100,  'post_type' => "listing_type", "author__in" => $UID );			
			$data = array();
			$wp_custom_query = new WP_Query($args); 
			$tt = $wpdb->get_results($wp_custom_query->request, OBJECT);
			foreach($tt as $g){			
				$data[] = $g->ID;			
			}
			
			return $data;		
		
		} break;	
	
		case "get_expires_timeline": {
		
			$percentage = 0;
			$days = 0;
			
			$date_expires = get_post_meta($order_data, 'listing_expiry_date', true);
			if($date_expires == ""){
			
				$percentage = 0;
			
			}else{
			
				// TIME
				$now = time(); 
				$your_date = strtotime($date_expires);
				$datediff = $now - $your_date;			
				$days = str_replace("-","",round($datediff / (60 * 60 * 24)));
				
				
				$x = $days;
				$total = 100;
				$percentage = ($x*100)/$total;
			
			}
			
			ob_start();
			?>
            <div class="progress md-progress">
            <div class="progress-bar bg-success" role="progressbar" style="width:<?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
			<?php echo $days; ?></div>
            </div>
            <div class="small text-right text-muted"><?php echo $days; ?> days left</div>
            <?php
			return ob_get_clean();
		
		} break;
	
		case "get_expires": {
		
			$date_expires = get_post_meta($order_data, 'listing_expiry_date', true);
			
			if($date_expires == ""){	
				return __("Never Expires","premiumpress"); // NEVER EXPIRES	
			}else{
				return $date_expires;	
			}
		
		} break;
	
		
		case "get_status_db": {		
		
			$SQL = "SELECT post_status FROM ".$wpdb->base_prefix."posts WHERE ID = ('".$order_data."')  LIMIT 1 ";	
			 			 
			$result = $wpdb->get_results($SQL);
			
			if(isset($result[0])){
			return $result[0]->post_status;		
			}
			
			return "published";
		} break;
		
		case "get_status_formatted": {
		
		 
			$status = $CORE->PACKAGE("get_status", $order_data);
			 	 
			$t = '<span class="inline-flex items-center font-weight-bold order-status-icon '.$status['css'].'"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap">'.$status['name'].'</span> </span>';
			
			return $t;
		
		} break;
		
		case "get_status": {
		 
			$status_array = array(
				
				"publish" => array(
				
					"key"	=> "publish",
					"name" => __("Live","premiumpress"),
					 
					"css" => "status-1",					
					"css-bg" => "bg-success",					
					"css-btn" => "btn-success",
					
				),	
			   
				"pending" => array(
					"key"	=> "pending",
					"name" => __("Pending","premiumpress"),					
					"css" => "status-2",					
					"css-bg" => "bg-warning",					
					"css-btn" => "btn-warning",
					 
				), 
				
				"pending_approval" => array(
					"key"	=> "pending_approval",
					"name" => __("Pending Approval","premiumpress"),					
					"css" => "status-4",					
					"css-bg" => "bg-warning",					
					"css-btn" => "btn-warning",
					 
				), 
				
				"payment" => array(
					"key"	=> "payment",
					"name" => __("Waiting Payment","premiumpress"),
					
					"css" => "status-3",					
					"css-bg" => "bg-warning",
					"css-btn" => "btn-warning",
					
				),
				
				"expired" => array(
					"key"	=> "expired",
					"name" => __("Expired","premiumpress"),
					 
					"css" => "status-5",					
					"css-bg" => "bg-danger",
					"css-btn" => "btn-danger",
				), 
				 
				"trash" => array(
					"key"	=> "trash",
					"name" 	=> __("Deleted","premiumpress"),
					
					"css" => "status-7",					
					"css-bg" => "bg-danger",
					"css-btn" => "btn-danger",
					 
				),	 					
			
			);
			if(THEME_KEY == "at"){			
				$status_array['expired']['name'] = __("Ended/ Sold","premiumpress"); 
			}
			
			if(THEME_KEY == "sp"){			
				unset($status_array['payment']);
				unset($status_array['expired']);
			}			
			
			
			// RETUNS ARRAY FOR DISPLAY
			if(is_array($order_data) && empty($order_data)){
				return $status_array;
			}	
			
			///////////////////////////////////////////////////////////////////////////
			/// NOW RETURN VALUE FOR LISTING SET	
		 	$status = get_post_status($order_data);
			
			 
			
			// PENIDNG APPROVAL
			if( $status == 'pending_approval' ){
				return $status_array[$status];
			} 
			
			// CHECK FOR PAYMENT DUE
			$foundA = get_post_meta($order_data,'totaldue',true); 
			if(is_numeric($foundA) && $foundA > 0){
				return $status_array["payment"];	
			} 
			 

			if(THEME_KEY == "ct" && get_post_meta($order_data, "status", true ) == "1"){
			 return $status_array["expired"];	
			}	  

			 
			// EXPIRY DATE
			if($CORE->PACKAGE("has_expired", $order_data) == "1" || $status == "expired"){
				 return $status_array["expired"];	
			}
			
			if(THEME_KEY == "at"){
				if(get_post_meta($order_data,'listing_expiry_date',true) == ""){
				return $status_array["expired"];	
				}
			}
			
			// SYSTEM STATUS
			if( isset($status_array[$status]) ){
				return $status_array[$status];
			} 
			
			// DEFAULT
			return $status_array["publish"];		
		
		
		} break;
		
		case "is_active_package": {
			
			if(!is_numeric($order_data)){
				return 0;
			}
			
			if(_ppt('pak'.$order_data.'_enable') == 1){
				return 1;
			}
			
			return 0;
		
		} break;
		
		case "get_date_now": {
			 
			$ff = $this->date_timediff($order_data,'');
			
			if($ff['expired'] == 1) {
				return $ff['string-small'];				
			}
	 
			return $ff['string-small'];
			
		} break;
		case "get_post_date": {
			 
			return get_the_date('Y-m-d H:i:s', $order_data); 
			
		} break;
		
		case "get_post_modified_date": {
			
			return get_the_modified_date('Y-m-d H:i:s', $order_data); 
		
		} break;
		
		case "get_package_all_features": {
				
				$features = array();
				 
					$features = array(	
					 										
						1 => array(
						
							"name" => __("Images","premiumpress"), 
							"desc" => __("Users can upload X number of images.","premiumpress"), 
							
							"icon" => "fal fa-camera",
							"key" => "images",
							"inputbox" => 1,
						),
						2 => array(
							"name" => __("Video","premiumpress"), 
							"desc" => __("Users can upload X number of videos.","premiumpress"),
							
							"icon" => "fal fa-video",
							"key" => "videos",
							"inputbox" => 1,							 
						),	
						
						0 => array(
							"name" => __("Audio","premiumpress"), 
							"desc" => __("Users can upload X number of audio files.","premiumpress"),
							
							"icon" => "fal fa-music",
							"key" => "music",
							"inputbox" => 1,							 
						),					
						
						3 => array(
							"name" => __("Featured","premiumpress"),
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This %s will display a red featured badge.","premiumpress")),
							
							"icon" => "fal fa-star", 
							"key" => "featured",							
						), 
						
						4 => array(
							"name" => __("Sponsored","premiumpress"), 
							
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This %s will display at the top of search results.","premiumpress")),
							
							
							"icon" => "fal fa-check", 
							"key" => "sponsored",
							 
						),
						
						5 => array(
							"name" => __("Homepage","premiumpress"), 
							
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This %s will display on your homepage.","premiumpress")),						 	
							"icon" => "fal fa-home",
							"key" => "homepage",
							
						),
								
						6 => array(
							"name" => __("Duration","premiumpress"), 							
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This %s will expire after X number of days. (0 = never) ","premiumpress")),						 	
							"icon" => "fal fa-clock",
							"key" => "duration",
							"inputbox" => 1,
						),	
						
						7 => array(
							"name" => __("Multiple Categories","premiumpress"), 							
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("This %s can be displayed in multiple categories.","premiumpress")),						 	
							"icon" => "fal fa-home",
							"key" => "category",
							
						),
										
					);
					
					
				 
				 
				 // TUN OFF DURATION FOR AUCTION THEME ?????
				
				return $features;
			
		} break;	
		
		
	
		case "get_package": {
				
				$h = get_post_meta($order_data,'packageID', true);
				
				if(is_numeric($h)){
				
				$g = $this->PACKAGE("get_packages", array());
				
				if(isset($g[$h])){
				return $g[$h];
				}
								
				}
				
				return $h;
		
		} break;
		
	
		case "get_packages": {
				
				// 0 = free
				// 1 = featured
				// 2 = sponsored
				
				$namesarray = array(
					0 => __("Basic","premiumpress"),
					1 => __("Featured","premiumpress"),
					2 => __("Sponsored","premiumpress"),
				);
				 
				
				// WITHOUT PACKAGES
				/*
				if( _ppt(array('lst','websitepackages')) == 0){
					
					
					//UPLOADS
					$files = _ppt(array('lst', 'defaultuploads' ));
					if($files == ""){ $files = 10; }
					
					// BUILD					
					$list[0] = array(					
						"key" 		=> 0,
						"name" 		=> trim($name),
						"desc" 		=> trim(stripslashes($desc)),
						"price" 	=> 0,
						"price_text" => 0,
						"duration" 	=> 30,	
						"recurring" => 0,											
					);
					
					return $list;
				
				
				}*/
				
				// WITH PACKAGES
				
				$list = array(); 
				$i=0;
				while($i < 10){ 
					
					// ENABLED
					if(_ppt('pak'.$i.'_enable') != 1){
					$i++; continue;
					}
				
					// NAME
					if(_ppt('pak'.$i.'_name') == "" && $i < 3){
						$name = $namesarray[$i];					
					}elseif(_ppt('pak'.$i.'_name') == "" && $i > 4){					
						$i++; continue;					
					}else{
						$name = _ppt('pak'.$i.'_name');
					}
					 
					
					// PRICE
					if(_ppt('pak'.$i.'_price') == ""){
					$price = 0;
					}else{
					$price = $CORE->_currency(_ppt('pak'.$i.'_price'));
					}
					
					// WORK OUR PRICE
					if( _ppt('pak'.$i.'_price')  == 0){       
						 $price_txt = __("FREE","premiumpress");  
					}else{
						  $price_txt = hook_price(_ppt('pak'.$i.'_price'));
					}
					
					// DURATION
					if(_ppt('pak'.$i.'_duration') == ""){
					$duration = 0;
					}else{
					$duration = _ppt('pak'.$i.'_duration');
					}
					
					// KEY 
					$key = _ppt('pak'.$i.'_key');
					if(!is_numeric($key)){
						$key = $i;
					}
					
					// DESC
					$desc = _ppt('pak'.$i.'_desc');	
					
					// RECURRING
					if(_ppt('pak'.$i.'_r') == 1){
					$recurring = 1;
					}else{
					$recurring = 0;
					}
					
					// BUILD					
					$list[$i] = array(					
						"key" 		=> $key,
						"name" 		=> trim($name),
						"desc" 		=> trim(stripslashes($desc)),
						"price" 	=> trim($price),
						"price_text" => $price_txt,
						"duration" 	=> trim($duration),	
						"recurring" => $recurring,											
					);
					
					$i++;
				}
				
				return $list;
		
		} break;
		
		
		case "get_packages_addons": {
			
			$addme = array(
			
					"featured" => array(
					
						"name" 	=> __("Featured","premiumpress"), 
						
						"key" 	=> "addon_featured",						 
						"color" => "span-yellow", 
						
						
						"pay_text" 	=> __("Featured Upgrade","premiumpress"),
						"title" 	=> __("Get Featured!","premiumpress"),
						"desc" 		=> __("Featured ads are highlighted in search results and shown 10x more often than standard ads.","premiumpress"), 						
						"btn_txt" 	=> __("Get Featured!","premiumpress"),											
						"ajax" 		=> "processFeatured",
						"smilecode" => "&#x1F642;",
						
						"desc_days" 	=> __("Highlighted in search results for %s days.","premiumpress"),
						
					),
					
					"sponsored" => array(
					
						"name" 	=> __("Sponsored","premiumpress"), 
						"key" 	=> "addon_sponsored", 
						"color" => "span-red", 
						
						"pay_text" 	=> __("Sponsored Upgrade","premiumpress"),
						"title" 	=> __("Get Sponsored!","premiumpress"),
						"desc" 		=> __("Sponsored ads are shown on rotation at the top of the search results page.","premiumpress"), 						
						"btn_txt" 	=> __("Get Sponsored!","premiumpress"),	
						 
						"desc_days" 	=> __("Appear at the top of search results for %s days.","premiumpress"), 
						
						"ajax" => "processSponsored",
						"smilecode" => "&#x1F917;",
						
					),
					
					
					"homepage" => array(
						"name" 	=> __("Homepage","premiumpress"), 
						"key" 	=> "addon_homepage", 
						"color" => "span-blue", 
						
						"pay_text" 	=> __("Homepage Upgrade","premiumpress"),
						"title" 	=> __("Homepage Exposure","premiumpress"),
						"desc" 		=> __("Have your ad appear on our homepage and seen by thousands of people.","premiumpress"), 						
						"btn_txt" 	=> __("Upgrade Now","premiumpress"),	
						
						 
						
						"desc_days" 	=> __("Feature on our homepage for %s days.","premiumpress"), 
						"ajax" => "processHomepage", 
						"smilecode" => "&#x1F60E;",
					),
					
					
					"boost" => array(
						"name" 	=> __("Boost","premiumpress"), 
						"key" 	=> "addon_boost", 
						"color" => "span-green", 
						
						"title" => "title here",
						"desc" 	=>  __("Have your ad appear on all featured areas on our website for 24 hours.","premiumpress"), 
						
						"desc_days" 	=> __("Appear on all featured areas on our website for 24 hours.","premiumpress"),
						"ajax" => "processBoost", 
					),
					 
					
				
			);
			
			
			
			if(defined('THEME_KEY') && THEME_KEY == "cp"){
				//$addme[1]['name'] = __("Staff Picks","premiumpress");
				//$addme[2]['name'] = __("Popular","premiumpress");
				//$addme[3]['name'] = __("Homepage / Deals","premiumpress"); 
			}
			
				
			return $addme;
		
		} break;
		case "package_process_upgrade": {
		
			$type = $order_data[0];
			$pid = $order_data[1];
		 
			switch($type){				
				case "sponsored": {
					update_post_meta($pid, 'sponsored', 1); 
					
					// ADD ON TIMER
					if(is_numeric(_ppt(array('lst', 'addon_sponsored_days'))) && _ppt(array('lst', 'addon_sponsored_days')) > 0){
					update_post_meta($pid, 'sponsored_expires', date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +"._ppt(array('lst', 'addon_sponsored_days'))." days")) ); 
					}
					
				} break;
				case "homepage": {
					update_post_meta($pid, 'homepage', 1); 
					
					// ADD ON TIMER
					if(is_numeric(_ppt(array('lst', 'addon_homepage_days'))) && _ppt(array('lst', 'addon_homepage_days')) > 0){
					update_post_meta($pid, 'homepage_expires', date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +"._ppt(array('lst', 'addon_homepage_days'))." days")) ); 
					}
					
				} break;
				case "featured": {
					update_post_meta($pid, 'featured', 1); 
					
					// ADD ON TIMER
					if(is_numeric(_ppt(array('lst', 'addon_featured_days'))) && _ppt(array('lst', 'addon_featured_days')) > 0){
					update_post_meta($pid, 'featured_expires', date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +"._ppt(array('lst', 'addon_featured_days'))." days")) ); 
					}
					
				} break;
			}
			 
		
		} break;
		
		case "package_hasaccess": {
			
				// RETURN 1 IF MEMBERSHIPS NOT ENABLED
				if( !$CORE->LAYOUT("captions","memberships") ){ 
				return 1;
				}
				
				global $post;
				if($userdata->ID == $post->post_author){
				return 1;
				}
				
				if(is_array($order_data)){ // CHECK USER AGAINST
					
					$g = $order_data; // MUST BE ARRAY
					
					$usermeme = $this->USER("get_user_membership", $g[0]);
					if(is_array($usermeme)){
						
						if(_ppt($usermeme['key'].'_'.$g[1]) == 1){ 
							return 1;
						}						 
					}				
				
				}else{
				
					$usermeme = $this->USER("get_user_membership", $userdata->ID);
					if(is_array($usermeme)){
						
						if(_ppt($usermeme['key'].'_'.$order_data) == 1){ 
							return 1;
						}						 
					}
				
				}
				
				
				return 0;
			
			} break;
	
	
	}
}

function get_listing_package_name($packageID){
	
	
	if($packageID == 99){
	
	return  __("Free Listing","premiumpress");
	}
	$i=0; 
	$paknames = array('Basic','Standrad','Premium');
	
	while($i < 3){ 		
	
		if($packageID == $i){ 
		
			if(_ppt('pak'.$i.'_name') == ""){ 
			return  $paknames[$i]; 
			}else{ 
			return  _ppt('pak'.$i.'_name'); 
			}  
		}
		
		$i++; 
	
	}
	
	return "";

}

function error_display(){

if(!isset($GLOBALS['error_message'])){ return; }
if(!isset($GLOBALS['error_type'])){ $GLOBALS['error_type'] = "success"; }

switch($GLOBALS['error_type']){

	case "success": {
		
		$css = "alert alert-success";
		
	} break;

	case "error": {
	
		$css = "alert alert-danger";
	
	} break;
	
	case "warning": {
	
		$css = "alert alert-warning";
	
	} break;	
	default: {
	
	$css = "alert alert-success";
	
	}
	
}
 
?>
<div class="<?php echo $css; ?>">
	<?php if(isset($GLOBALS['error_title'])){ ?><h4 class="alert-heading"><?php echo $GLOBALS['error_title']; ?></h4><?php } ?>    
    <p class="mb-0"><?php echo $GLOBALS['error_message']; ?></p>
</div>
<?php 
 
}
 
/*
	functon turns true/false if a listing has expired
*/
function has_expired($postid){

	$expires = $this->get_listing_expirydate($postid);
	
	if($expires == ""){ 
		return 0;
	}
	
	$ff = $this->date_timediff($expires,'');
	 
	if($ff['expired'] == 1) { 
		return 1;
	}
	
	return 0;

}



	/*
		this function gets the data for a listing
	*/
	function get_edit_data($field, $postid){ global $userdata;
	
		// CHECK IF WE ARE EDITING A LISTING
		if(is_numeric($postid) && $postid > 0 ){
		
			// GET POST DATA	
			$edit_data = get_post($postid);
			if(!isset($edit_data->post_author)){
			return;
			}
			
			// CHECK WE ARE THE AUTHOR
			if($edit_data->post_author != $userdata->ID && !current_user_can('administrator') ){
			return "Not your post!";
			}
		
			// GET CUSTM FIELD DATA 
			$editdata = array();
			$custom_fields 	= get_post_custom($postid);
			if(is_array($custom_fields)){
				foreach ( $custom_fields as $key => $value ){	
					$editdata[$key] =  $value[0];	
				}
			}
			// STORE DATA IN ARRAY TO BE PASSED TO OUR CORE FUNCTIONS
			$editdata['post_title'] 	=  $edit_data->post_title;
			$editdata['post_excerpt'] 	=  $edit_data->post_excerpt;
			$editdata['post_content'] 	=  preg_replace("/<div style='display:none'>(.*?)<\/div>/", "", $edit_data->post_content);
			$editdata['post_status'] 	=  $edit_data->post_status;
			 
			// CHECK FOR FIELD VALUES
			
			$tfs = wp_get_post_tags($postid);
			 
			$ftags = "";
			if(!empty($tfs)){
				foreach($tfs as $ta){ $ftags .= $ta->name.", "; }
			}			
			$editdata['post_tags'] 	= $ftags;	
			 
		}
		
		if(isset($editdata[$field])){
			return $editdata[$field];
		}else{
			return "";
		}
	}





	/*
		this function counts how many packages
		there are
	*/
	function packages_count(){
	
		$cpackages = get_option("cpackages"); 
		if(!is_array($cpackages)){ return 0; }  
		
		$counter = 0;
		if(is_array($cpackages) && !empty($cpackages) ){ $i=0; 

		foreach($cpackages['name'] as $data){  
		
			if($cpackages['name'][$i] != "" ){ 
				$counter ++;			
			} 
			$i++; 
			} 
		}
		
		return $counter;
		 
	}
	
 
/* this function calculates how much the
relist price is for a listing */

function relist_price($postid){ global $wpdb, $CORE; 

	return $CORE->PACKAGE("renew_data", $postid);

}

/*
	this function will reset the listing
	expiry days and do the checks
*/
function reset_listing_expirydate($postid){
	
	// STOP DOUBLE TAKES
	//if(isset($GLOBALS['reset_listing_expirydate_done'])){ return; }
	//$GLOBALS['reset_listing_expirydate_done'] = 1;
	
	// GET DATA
	$ar = $this->relist_price($postid);	 $rhours = 0; $rminutes =0 ;
 
	// DEFAULTS
	$rdays 		= $ar['days'];
	if(isset($ar['hours'])){
	$rhours 	= $ar['hours'];
	}
	if(isset($ar['minutes'])){
	$rminutes 	= $ar['minutes'];
	}
	//$pprice = $ar['price'];
 
	if($rdays == 0 && $rhours == 0 && $rminutes == 0 ){ $rdays = 30; }	
	 			
	//2. UPDATE TIMER
	$expiry_date = get_post_meta($postid,'listing_expiry_date',true);
	if($expiry_date == "" || ( strtotime($expiry_date) < strtotime(current_time( 'mysql' )) )  ){
		$expiry_date = current_time( 'mysql' );
	}	
	
	
	//die($expiry_date."--".$postid);
	
 
	// SET EXPIRY DATE
	if($rminutes != 0 ){ 
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rminutes." minutes") );
	}
	if($rhours != 0 ){ 
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rhours." hours") );
	}
	if($rdays != 0 ){
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rdays." days") );
	}
	//die(print_r($ar). $expiry_date."< --".current_time( 'mysql' )." post ID: ".$postid);
	// UPDATE AND SAVE	
	update_post_meta($postid,'listing_expiry_date', $expiry_date );

}

/*
this function loops thourgh all listings which
need to be expired
*/
function handle_listings_upgrade_expire(){
 	
	foreach(array("homepage","featured","boost","sponsored") as $k){
	
	$args = array('posts_per_page' => 100, 
			'post_type' => 'listing_type', 'orderby' => 'meta_value', 'order' => 'asc', 'fields' => 'ID', 
			'meta_query' => array (
					array( 
						'key' => $k.'_expires',																
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
			
			update_post_meta($p->ID, $k.'_expires', '');
			update_post_meta($p->ID, $k, 0); 
			
		}	
	} 
	
	
	}
	
}

function handle_listings_expire(){
 	
	$args = array('posts_per_page' => 100, 
			'post_type' => 'listing_type', 'orderby' => 'meta_value', 'order' => 'asc', 'fields' => 'ID', 
			'meta_query' => array (
					array( 
						'key' => 'listing_expiry_date',																
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
			$this->expire_listing($p->ID);
		}	
	} 
}


/*
	this function handles the listing expiry
*/

function expire_listing($postid){ global $CORE, $post; 

  	
	// NO NEED FOR SOME THEMES
	if(!$CORE->LAYOUT("captions","listings")){ return; }
	
	
	
	// VALIDATE
	if(!is_numeric($postid)){ return; }
	
	// GET THE LISTING EXPIRY DATE	 
	$expires = get_post_meta($postid, 'listing_expiry_date',true);
	 	
	if($expires == ""){ return; }
	

	// CHECK IF THIS IS A SUBSCRIPTION
	$is_subscription = get_post_meta($postid,'subscription',true);
	if($is_subscription == "yes"){ return; } 
		
	// GET ARRAY OF DATE/TIME VALUES
	$ff = $this->date_timediff($expires,'');	
	
	  
 	// SEND OUT EMAILS TO USER
	if($ff['expired'] != 1 && isset($ff['date_array']['days'])){
			// LINE UP 30 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)
			if( ( $ff['date_array']['days'] == 30 || $ff['date_array']['days'] == 29 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_30dayreminder',true) == ""){ // 
				//$CORE->SENDEMAIL($post->post_author,'reminder_30');
				//update_post_meta($postid,'email_sent_30dayreminder',current_time( 'mysql' ));
				
			}
			// LINE UP 15 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)			
			if( ( $ff['date_array']['days'] == 15 || $ff['date_array']['days'] == 14 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_15dayreminder',true) == ""){ //
				//$CORE->SENDEMAIL($post->post_author,'reminder_15');
				//update_post_meta($postid,'email_sent_15dayreminder',current_time( 'mysql' ));
			}	
			
			// LINE UP 1 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)
			if( ( $ff['date_array']['days'] == 02 || $ff['date_array']['days'] == 01 || $ff['date_array']['days'] == 00 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_1dayreminder',true) == ""){	// 	 
				//$CORE->SENDEMAIL($post->post_author,'reminder_1');
				//update_post_meta($postid,'email_sent_1dayreminder',current_time( 'mysql' ));
			}	
	} // end if date
 	
	// CHECK IF IT HAS EXPIRED
	if($ff['expired'] == 1) { 
	
	
		// SEND EMAIL
		$data1 = array(		
			"username" 		=> $CORE->USER("get_username", $CORE->USER("get_userid_from_postid", $postid) ),	
			"item_title" 	=> get_the_title($postid),
			"item_link" 	=> get_permalink($postid),	
			"title" 		=> get_the_title($postid),
			"link" 			=> get_permalink($postid),
			"ID" 			=> $postid,
		);				 
				
		// SEND EMAILS					
		$CORE->email_system("admin", "admin_listing_expire", $data1);
	 
		
		// DEMO AUCTION
		if( defined('WLT_DEMOMODE') && defined('THEME_KEY') && THEME_KEY == "at" && _ppt('autolist') == 1 ){
				
			global $CORE_AUCTION;				
			$CORE_AUCTION->_relist_auction($postid, 0);				
			// FINISH
			return;				
		
		
		}elseif( defined('THEME_KEY') && THEME_KEY == "at"){
					
			global $CORE_AUCTION;				
			$CORE_AUCTION->_end_auction($postid);
			
			
			
			// FINISH
			return;	
		}
		
		
	 
		// ADD LOG
		$CORE->FUNC("add_log",
				array(				 
					"type" 		=> "listing_expired",												
					"postid"	=> $postid,							
					"to" 		=> get_post_field( 'post_author', $postid ), 						
					"from" 		=> 0,							
					"alert_uid1" 	=>  get_post_field( 'post_author', $postid ), 	
				)
		);		
		
		// CLEAR EXPIRY DATE 
		update_post_meta($postid,'listing_expiry_date', '');
		
		
		// CHANGE PACKAGE
		$pakchange = _ppt(array('lst', 'expirypackage'));
		if(is_numeric($pakchange) && $pakchange != 0){ 
		update_post_meta($postid, "packageID", $pakchange);	
		}
			
		// CHANGE STATUS 
		switch( _ppt(array('lst', 'expiryaction')) ){			 
			
			case "1": { // SET TO PENDING
			 
					$my_post['ID'] 			= $postid;
					$my_post['post_status'] = "expired";
					$g = wp_update_post( $my_post );
					 
					
			} break; 
			
			
			case "2": { // DELETE
					//wp_delete_post( $postid, true ); 
			} break;
			case "0":			
			default: { // DO NOTHING			
						
			}// end default			
		}// end switch	

			
		
		
		
	
	/*
	
	NNEEDS REDOING
			
			// HOOK FOR THEME USE
		 	$finish_early = hook_expire_listing_action($postid); 
			
			//die(print_r($ff).$finish_early);
	
			// CHECK FOR AUTO RELISTING
			if( _ppt('autolist') == 1 && THEME_KEY == "at"){
				
				global $CORE_AUCTION;
				
				$CORE_AUCTION->_relist_auction($postid, 0);
				
				// FINISH
				return;
				
			}elseif( _ppt('autolist') == 1){
				
				$this->reset_listing_expirydate($postid);
				
				// FINISH
				return;
			}
		 	
			// CHECK FOR STOPAGE
			if($finish_early == "stop"){ return; }
  	 	 
		 	// INCLUDE PACKAGE OPTIONS FOR CUSTOM MOVES
			$packagefields = get_option("packagefields");
			if(!is_array($packagefields)){ $packagefields = array(); }
			$packageID = get_post_meta($postid, 'packageID',true); 
			
			// CHECK IF THE PACKAGE ID HAS A CUSTOM MOVE
			if(isset($packagefields[$packageID]['action']) && strlen($packagefields[$packageID]['action']) > 0){
			
					
			
			}else{
				// DEFAULT 
				//$my_post['ID'] 			= $postid;
				//$my_post['post_status'] = "draft";
				//wp_update_post( $my_post );	
						
			}
 			
			// SEND EMAIL ONLY IF PAYPAL RECURRING PAYMENTS INST SET
			$last_sent = get_post_meta($postid,'email_sent_expired',true);
			//$last_sent_date = date('Y-m-d H:i:s',strtotime($last_sent . "+2 days"));
			// || ( strtotime(current_time( 'mysql' )) > strtotime($last_sent_date) )
			if( $last_sent == ""  ){  
						 
				$CORE->SENDEMAIL($post->post_author,'expired');			 
				update_post_meta($postid,'email_sent_expired',current_time( 'mysql' ));			 
			} 
			
			// ADD LOG ENTRY			 
			$CORE->ADDLOG("Listing Expired", 0, $postid, $post->post_title, "listing", "" );	
	*/
	} 
	
	return;

}
 
 
	/* =============================================================================
	   COUNT LISTING DATA SYSTEM
	   ========================================================================== */
	function COUNT($key,$val,$extra=true, $taxid = "", $taxname = "store"){ global $wpdb, $core, $userdata, $wp_query; $skey = "";
	 	
		if(is_array($val)){
		$args = array(
			'post_type'  => 'listing_type',
			'post_status' => array( 'publish' ),
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key'     => $key,
					'value'   => $val,
					//'compare' => '=',
				),
			),
		);
		}else{
		
		$args = array(
			'post_type'  => 'listing_type',
			'post_status' => array( 'publish' ),
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key'     => $key,
					'value'   => $val,
					'compare' => '=',
				),
			),
		);
		}
		 
				
		if(THEME_KEY == "cp" && _ppt('coupon_showexpired') != 1 ){
			$args['meta_query']["expirydate"]   = array(							
				'key' => "expiry_date",
				'compare' => '>=',
				'value' => date('Y-m-d H:i:s'),
				'type' => 'DATETIME'					
			);
		}
		
		if(isset($GLOBALS['flag-taxonomy'])){
		
			$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			 
			
			$args['tax_query'][] = array( 
					'taxonomy' => $term->taxonomy,
					'field' => 'term_id',
					'terms' => $term->term_id,
					'operator' => 'IN',
					//'include_children' => true,					
			); 	
				
		}elseif(is_numeric($taxid)){
			
			$args['tax_query'][] = array( 
					'taxonomy' => $taxname,
					'field' => 'term_id',
					'terms' => $taxid,
					'operator' => 'IN',
					//'include_children' => true,					
			); 
		
		}
		
		if(isset($_GET['s'])){		
		$args['s'] = esc_html($_GET['s']);
		}
		
		 
		 
		$allsearch = new WP_Query($args); 
		$count = $allsearch->post_count;
		 
		return $count;		
	}

	
/* =============================================================================
	  REGISTER /LISTING FIELDS
	========================================================================== */
function BUILD_FIELDS($fields,$data=""){

global $wpdb, $CORE, $userdata;  $i = 0; $FIELDVALUE = ""; $STRING = ""; $EXTRA = ""; $FIELDVALUE="";  $VALIDATION = ""; $show_count = 0; $hideempty = 0;

	if(isset($_GET['eid'])){ $_GET['eid'] = strip_tags($_GET['eid']); }
	// TABBING ORDER
	if(!isset($GLOBALS['TABORDER'])){$GLOBALS['TABORDER'] = 12;	}
	
	if(!isset($GLOBALS['SETFIELDS'])){ $GLOBALS['SETFIELDS'] = array(); }
	 
	// IF NOT ARRAY, RETURN
	if(!is_array($fields)){ return; }
	
	 
	// LOOP THROUGH THE FIELDS AND BUILD DISPLAY
	foreach($fields as $field){	
	
	
		if(isset($field['adminonly'])  && !is_admin()){ continue; } 
		
		if($field['type'] == "businesshours"){ continue; }
		
		if(isset($GLOBALS['SETFIELDS'][$field['name']])){
			continue;
		}else{
		$GLOBALS['SETFIELDS'][$field['name']] = $field['name'];
	 	}
		
	 
		// SPAN SIZES
		if(isset($field['ontop'])){
			$spans1 = "col-md-12";
			$spans2 = "col-md-12";
		}else{
			$spans1 = "col-md-12";
			$spans2 = "col-md-12";
		}
		
		// ADD IN VALIDATE CODE
		if(isset($field['required']) && $field['required'] == "yes" &&  !in_array($field['name'], array('post_title','post_content', 'category') )  && $field['type'] != "image"  ){
			 
			if(isset($field['taxonomy']) && strlen($field['taxonomy']) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			} 
			 	
		} 
		  
		// BUILD OUTPUT - DONT SHOW FOR HIDDEN FIELDS		
		if($field['type'] == "title"){ 
		
		$STRING .= '<div class="form-group clearfix customfield py-4">
		<div class="block-header">
<h3 class="block-header__title">'.stripslashes($field['title']).'</h3>
<div class="block-header__divider"></div> 
</div>
		 
		
		<div>';
		
		}elseif($field['type'] == "post_content"){
		
		$STRING .= '<div class="form-group clearfix col-md-12  form-group" id="form-row-rapper-'.$field['name'].'"><label class="">';
		$STRING .= stripslashes($field['title']);
		$STRING .= ' <span class="text-danger">*</span></label><div class="field_wrapper">';
		
		}elseif($field['type'] !="hidden"  && $field['type'] != "category" ){
		
		if(isset($field['fullspan'])){
		$colg = "col-md-12 fullspanbox";
		}else{
		$colg = "col-md-6";
		}
		 				
			$STRING .= '<div class="'.$colg.' clearfix form-group" id="form-row-rapper-'.$field['name'].'">
			 
			
			<label class="">';
			
			$STRING .= stripslashes($field['title']);
			// IS IT REQUIRED?
			if(isset($field['required']) && $field['required'] == "yes"){
			$STRING .= " <span class='text-danger'>*</span>";
			}
			
			$STRING .= '</label>
			
			<div class="field_wrapper">';
		}
		
		  
	 
		// CHECK FOR
		
		// GET THE FIELD VALUE
		$FIELDVALUE = "";
		if(isset($field['name']) && $field['name'] == "post_tags" && isset($_GET['eid']) ){
			$FIELDVALUE = "";
			$tfs = wp_get_post_tags($_GET['eid']);
			if(!empty($tfs)){
			foreach($tfs as $ta){ $FIELDVALUE .= $ta->name.", "; }
			}
		}elseif(isset($field['name']) && isset($_GET['eid'])){
				$FIELDVALUE = get_post_meta($_GET['eid'],$field['name'],true);
		}
		
		// not set
		if(!isset($field['required'])){ $field['required'] = false; }
	 	
		// DISPLAY FIELD TYPES
		switch($field['type']){
			
			case "title":{
			 
			} break;
			case "map": {
			} break;
			case "tags": {
			} break;
			case "upload": {
			} break;
 
			case "hidden": {
			$STRING .= '<input class="form-control" type="hidden" name="custom['.$field['name'].']" id="form_'.$field['name'].'" value="'.$field['values'].'"  '.$EXTRA.'/>';	
			} break;
			case "percentage": {
			
			$STRING .=  $this->fieldtype("percentage", $field['name'], $field['defaultvalue'], $GLOBALS['TABORDER'], $FIELDVALUE, $field['required']); 			
			
			} break;
			case "price": {	 
			 
			$STRING .=  $this->fieldtype("price", $field['name'], $field['defaultvalue'], $GLOBALS['TABORDER'], $FIELDVALUE, $field['required']); 			
						
			} break;
			case "longtext": 
			case "text": {			
			$STRING .=  $this->fieldtype("input", $field['name'], '', $GLOBALS['TABORDER'], $FIELDVALUE, $field['required']); 			
					
			} break;
			case "post_content":
			case "textarea": { 
			
			$STRING .=  $this->fieldtype("textarea", $field['name'], '', $GLOBALS['TABORDER'], $FIELDVALUE, 0); 
 
 	
			} break;					
			case "select": {
						   
				$STRING .=  $this->fieldtype("select", $field['name'], $field['listvalues'], $GLOBALS['TABORDER'], $FIELDVALUE, $field['required']); 			  
				  
			} break;	
			case "taxonomy": {
			 
			   
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				//if(is_array($value)){
				//$selected_array = array();
				//foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				//}
				 
				
				// GET SELECTED VALUE
				if(isset($_GET['eid'])){	 
				$selected_array = wp_get_post_terms($_GET['eid'], $field['taxonomy'], array("fields" => "ids"));					 
				}
					
			 	// START BUILDING THE LIST
				$terms = get_terms($field['taxonomy'],'hide_empty=0&parent=0');
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
				$count = count($terms);	
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($field['taxonomy_link']) && strlen($field['taxonomy_link']) > 2 && $field['taxonomy_link'] != "store"){
						$taxlink = true;
						
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("https://","",str_replace("http://","",get_home_url()))."',this.value,'".$field['taxonomy_link']."__".$field['taxonomy']."','tx_".$field['taxonomy_link']."[]','-1','".$canAdd."', 'reg_field_tax_".$field['taxonomy_link']."')\"";
					}
					 
					
					$STRING .= '<div class="input-group">';
					
					/*
					$STRING .= '<span class="input-group-prepend"><span class="input-group-text">';					
					$STRING .= "<a href='#step4' onclick=\"TaxNewValue('reg_field_tax_".$field['taxonomy']."', '".__("Enter a value below to create a new option.","premiumpress")."')\"> <i class='fa fa-plus-square'></i> </a> </span></span>"; 
					*/
					
					$STRING .= '<select name="tax['.$field['taxonomy'].']" class="'.$field['class'].'" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$field['taxonomy'].'" '.$ex.'>';
					$STRING .="<option value=''></option>";
					
					
					foreach ( $terms as $term ) {
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(isset($selected_array) && is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $CORE->GEO("translation_tax_value", array($term->term_id, $term->name)). " (".$term->count.") </option>";
						
						 
						// GET INNER CHILD ITEMS
						/*
						$terms_inner = get_terms($field['taxonomy'],'hide_empty=0&child_of='.$term->term_id);
						if(count($terms_inner) > 0){
						
							foreach ( $terms_inner as $term_inn ) {
							
								// SETUP VALUE FOR LISTBOX
								if($taxlink){ $tvg1 = $term_inn->term_id; }else{ $tvg1 = $term_inn->term_id; }
								
								// SETUP SELECTED VALUE
								if(is_array($selected_array) && in_array($tvg1,$selected_array)){ $b = "selected=selected"; }else{ $b= ""; }
								
								$STRING .= "<option value='".$tvg1."' ".$b."> -- " . $term_inn->name . " (".$term_inn->count.") </option>";
							}
						}	
						*/				 		   
													   				
					 }
					 
					$STRING .= '</select>';
					
					
					$STRING .= '</span></div>';
					
					
					 
				}
				
			} break;
			
 			case "time": { 
			
				$STRING .=  $this->fieldtype("time", $field['name'],"", $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			
			
			} break;
			 
			case "date": { 
			
				$STRING .=  $this->fieldtype("date", $field['name'],"", $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			
			
			} break;
			
			case "checkbox": {
			
				$STRING .=  $this->fieldtype("checkbox", $field['name'], $field['listvalues'], $GLOBALS['TABORDER'], $FIELDVALUE, 0); 	
				
			} break; 
			
			default:{
		 
			
			} break;
					
		}	
		
		if(isset($field['help']) && strlen($field['help']) > 1){
			$STRING .= "<small class='description'>".stripslashes($field['help'])."</small>";
		}
		// DONT SHOW FOR HIDDEN FIELDS
		if($field['type'] !="hidden"  && $field['type'] != "category" ){ 
			$STRING .= '</div></div>';
		}
			
		// INCREMENT TAB ORDER
		$GLOBALS['TABORDER']++;
		
	}// end foreach
	 
	
	return hook_add_build_field($STRING);


}



function SUBMISSION_FIELDS($show=false,$addlisting = false){

	global $wpdb, $CORE, $userdata; $STRING = ""; $packageID = ""; $GLOBALS['TABORDER'] = 3; $VALIDATION = '<script > function ValidateCoreRegFields(){ ';
	
	if(isset($GLOBALS['core_theme_validation_listing'])){ $VALIDATION .= $GLOBALS['core_theme_validation_listing']; }
	  
	// GET THE DATA
	$cdata = get_option("cfields");
	$taxmulti = _ppt('taxmulti');
	
	 
	// CHECK HAS VALUES
 	if(is_array($cdata)){	
	
		if(!isset($GLOBALS['SETFIELDS'])){ $GLOBALS['SETFIELDS'] = array(); }
 		 
		$i = 0; $completedArray = array(); 
		if(isset($cdata['name']) && is_array($cdata['name'])){
		foreach($cdata['name'] as $xxxxxxx){
		 
			// CHECK KEY HAS A DATABASE KEY FOR SAVING
			if(!isset($cdata['dbkey'][$i]) || ( isset($cdata['dbkey'][$i]) && $cdata['dbkey'][$i] == "" ) ){ $i++; continue; }
			
			if($cdata['name'][$i] == ""){ continue; }	
			
		 
			// STOP DUPLICATE FIELDS FOR CUSTOM FIELDS			
			if(isset($GLOBALS['SETFIELDS'][$cdata['dbkey'][$i]])){
				$i++; continue;
			}else{
				$GLOBALS['SETFIELDS'][$cdata['dbkey'][$i]] = $cdata['dbkey'][$i];
			} 
		  	
			
			$show = true;
			if($show){	
			
			
		  	////////////////////////////////////////////////////
			// GET EXISTING DATA
			////////////////////////////////////////////////////
			if(isset($_GET['eid']) && isset($cdata['fieldtype'][$i]) && $cdata['fieldtype'][$i] == "taxonomy"){					
				$value = get_the_terms( $_GET['eid'], $cdata['taxonomy'][$i] );
				
				//1 . register
				if( is_wp_error( $value ) ){				
					register_taxonomy( $cdata['taxonomy'][$i], $cdata['taxonomy'][$i], array() ); 					
					$value = get_the_terms( $_GET['eid'], $cdata['taxonomy'][$i] );			 
				}
				
			}elseif(isset($_GET['eid']) ){
				$value = get_post_meta($_GET['eid'], $cdata['dbkey'][$i], true);		 
			}else{
				$value = "";
			}
		 	
			
		  
			
				// GET THE CATIDS FOR THIS FIELD					
				$dcats = ""; $hide = false;
				
				if(isset($cdata['cat'][$i]) && is_array($cdata['cat'][$i]) && !empty($cdata['cat'][$i]) ){
				
						 
						foreach($cdata['cat'][$i] as $h){
						
							if($h == "" || $h == 0){ 							
								$h = 0;  // ALL CATS
								$dcats .= "customid-0 "; 							
							
							}elseif(is_numeric($h) && $h > 0){								
								$hide = true;								
								$dcats .= "customid-".$h." ";							
							}
						}
						 
				}else{	
				
				$dcats .= "customid-0 "; 
				
				}	
								
				$hs = "style=''";
				
				if($hide && !is_admin()){
					$hs = "style='display:none;'";
				}				 
				
			 
			 
			 	$colspanc = "col-md-6";
				if($cdata['fieldtype'][$i] == "textarea"){
				$colspanc = "col-12";
				}
				
				
					////////////////////////////////////////////////////
			// BUILD HTML OUTPUT
			////////////////////////////////////////////////////
			if(isset($cdata['fieldtype'][$i]) && $cdata['fieldtype'][$i] == "title" ){	
				 
				 
				 $STRING .= '<div class="col-md-12 customfield '.$dcats.'" '.$hs.'><div>
				 
				 
				 <div class="block-header mt-4">
<h3 class="block-header__title">'.$CORE->GEO("translate_field_name", array( stripslashes($cdata['name'][$i]), $i, $cdata)).'</h3>
<div class="block-header__divider"></div> 
</div>
				<div></div>';				 
							 
				
			}else{
				
				
				
					$STRING .= '<div class="'.$colspanc.' clearfix customfield mb-4 '.$dcats.'" '.$hs.' id="fkey'.$cdata['dbkey'][$i].'">';
					
					if(is_admin() && isset($cdata['fieldtype'][$i]) && $cdata['fieldtype'][$i] == "taxonomy"){
					
					$STRING .=  '<a href="'.home_url().'/wp-admin/edit-tags.php?taxonomy='.$cdata['taxonomy'][$i].'&post_type=listing_type" target="_blank" class="tiny float-right text-uppercase">'.__("manage","premiumpress").'</a>';
					
					}
					
					
					
					$STRING .= '<label>'.$CORE->GEO("translate_field_name", array( stripslashes($cdata['name'][$i]), $i, $cdata));
					
					  if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){ $STRING .= ' <span class="text-danger">*</span>'; }
					  
					$STRING .= '</label>
					
					<div class="field_wrapper">';
			 
				
				
			} // END ELSE IF IS TITLE
			
			
			$eclass = "";
			if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){			
			$eclass = "required-field";
			}
			
 			 
		  	////////////////////////////////////////////////////
			// SWITCH TYPES
			////////////////////////////////////////////////////
			 
			if(isset($cdata['fieldtype'][$i])){
			switch($cdata['fieldtype'][$i]){ 
			
			
			
			
			case "input": { 	
			 
			
if(in_array($cdata['dbkey'][$i], array("whatsapp","mobile") )){


			
			ob_start();
			
			/*
?>
<script>
  jQuery(document).ready(function(){ 
   
	   var handleChange = function() {    
	   jQuery("#<?php echo $cdata['dbkey'][$i]; ?>-input").val(iti.getNumber());
	   }
	   
		var input = document.querySelector("#<?php echo $cdata['dbkey'][$i]; ?>-input");
		var iti = window.intlTelInput(input, { 
		  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
		 // autoHideDialCode: false,
		  nationalMode: false,
		   
		});
	
		input.addEventListener('change', handleChange);
		input.addEventListener('keyup', handleChange);
		 
		jQuery(".iti__country-list li").click(function(e) {				 
			jQuery("#<?php echo $cdata['dbkey'][$i]; ?>-input").val( '+' + jQuery(this).data('dial-code') ); 
			
		});
	
	});
	
  </script>
  */?>
  <div class="form-group ">
<input name="custom[<?php echo $cdata['dbkey'][$i]; ?>]" type="text" class="form-control required" id="<?php echo $cdata['dbkey'][$i]; ?>-input" value="<?php echo $value; ?>" />
</div>
<?php
			$output = ob_get_contents();
			ob_end_clean();
			$STRING .= $output;
			
		
			}elseif($cdata['dbkey'][$i] == "price"){
				
				
					
			ob_start();
			?>
            
            
            <div class="input-group">
            	<span class="input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                <input type="text" name="custom[<?php echo $cdata['dbkey'][$i]; ?>]" maxlength="255"  class="form-control val-numeric <?php echo $eclass; ?>" tabindex="<?php echo $GLOBALS['TABORDER']; ?>"  value="<?php echo esc_attr( $value ); ?>" id="field-<?php echo $cdata['dbkey'][$i]; ?>" />                
            </div>
		 
        
         <script>
		jQuery( "#field-<?php echo $cdata['dbkey'][$i]; ?>" ).change(function() {	   
			jQuery( "#field-<?php echo $cdata['dbkey'][$i]; ?>" ).val( jQuery( "#field-<?php echo $cdata['dbkey'][$i]; ?>" ).val().replace(',', '') );	  
		});
		</script>
      
      
            <?php
			$STRING .= ob_get_clean();
				 
				  
				}else{
				
				
				$STRING .= '<input type="text" name="custom['.$cdata['dbkey'][$i].']" value="'.$value.'" id="reg_field_'.$cdata['dbkey'][$i].'" tabindex="'.$GLOBALS['TABORDER'].'" class="form-control '.$eclass.'" />';
					
				}
			  
						
			} break;
			case "textarea": { 
				$extra = "";
				
					$extra = "style='width:100%; height:100px !important;'";
				
			
				$STRING .= '<textarea '.$extra.' name="custom['.$cdata['dbkey'][$i].']" class="form-control '.$eclass.'" id="reg_field_'.$cdata['dbkey'][$i].'" tabindex="'.$GLOBALS['TABORDER'].'">'.$value.'</textarea>';
			} break;

			case "select": {
			
			if(is_array($value)){ $value = ""; }
			 
			 $value = trim(stripslashes(str_replace(" ","_", str_replace(",","::", str_replace("'",";;", $value)))));
			 
			 
			  
						
			 $options = explode( PHP_EOL, $cdata['values'][$i] );			 
			 $STRING .= '<select name="custom['.$cdata['dbkey'][$i].']" class="form-control '.$eclass.'" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$cdata['dbkey'][$i].'">';
			 
			 
			 if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){
			 $STRING .= '<option value=""></option>';
			 }
			 					
				foreach($options as $val){
				
					if(is_array($val)){ continue; }
					
					$val = trim(stripslashes($val));
					
					$value_check = trim(stripslashes(str_replace(" ","_", str_replace(",","::", str_replace("'",";;", $val)))));
				 	
					if($value == $value_check){
							$STRING .= '<option value="'.$value_check.'" selected=selected>'.$val.'</option>';
					}else{
							$STRING .= '<option value="'.$value_check.'">'.$val.'</option>';
					}
				}// end foreach
			$STRING .= '</select>';
			} break;
			
			case "date": { 
			
			$STRING .=  $this->fieldtype("date", $cdata['dbkey'][$i], $value , $GLOBALS['TABORDER'], $value, 0); 
			
			
			} break;
						
			case "taxonomy": {
		 	
			  
		 	if($cdata['taxonomy'][$i] != ""){
			
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				if(is_array($value)){
				$selected_array = array();
				foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				}
				
			 	// START BUILDING THE LIST 				 
				$terms = get_terms($cdata['taxonomy'][$i],"get=all");			 
				
				//1 . register
				if( is_wp_error( $terms ) ){				
					register_taxonomy( $cdata['taxonomy'][$i], $cdata['taxonomy'][$i], array() ); 					
					$terms = get_terms($cdata['taxonomy'][$i],"get=all");				 
				}			
	 			
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		
				
				$count = 0;
				if(is_array($terms)){
				$count = count($terms);	
				}
				 
				
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($cdata['taxonomy_link'][$i]) && strlen($cdata['taxonomy_link'][$i]) > 2 && $cdata['taxonomy_link'][$i] != "store"){
					
						$taxlink = true;
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("http://","",get_home_url())."',this.value,'".$cdata['taxonomy_link'][$i]."__".$cdata['taxonomy'][$i]."','tx_".$cdata['taxonomy_link'][$i]."[]','-1','".$canAdd."','reg_field_tax_".$cdata['taxonomy_link'][$i]."')\"";
					}
						 
						 
						 
						 if( ( $cdata['taxonomy'][$i] == "features" || is_array($taxmulti) && !empty($taxmulti) && isset($cdata['taxonomy'][$i]) && in_array($cdata['taxonomy'][$i], $taxmulti) ) && !$CORE->isMobileDevice() ){
						 
						 $STRING .= '<select name="tax['.$cdata['taxonomy'][$i].'][]" multiple class="form-control selectpicker border"  data-dropup-auto="false" data-size="5" data-live-search="true" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$cdata['taxonomy'][$i].'" '.$ex.'>';
					
						 }else{
						 
						 $STRING .= '<select name="tax['.$cdata['taxonomy'][$i].']" class="form-control" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$cdata['taxonomy'][$i].'" '.$ex.'>';
					
						 }
						 
					
					//$STRING .="<option value=''></option>";
					 
					
					// COUNT TERMS AND					
					foreach ( $terms as $term ) {					
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(isset($selected_array) && is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }						
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $CORE->GEO("translation_tax_value", array($term->term_id, $term->name)) . "</option>"; // (".$term->count.") 						
						 	 		   
													   				
					 }
					 
					 
					$STRING .= '</select>';
				}
				
				} // end if blank
				
				if(isset($cdata['taxonomy_link'][$i]) && strlen($cdata['taxonomy_link'][$i]) > 2 && $cdata['taxonomy_link'][$i] != "store"){
				?>
                <script>jQuery(document).ready(function(){ jQuery('#reg_field_tax_<?php echo $cdata['taxonomy_link'][$i]; ?>').prop('disabled', true); }); </script>
                
                <?php
				}
				
			} break;	
							
			case "checkbox": { 
			 $options = explode( PHP_EOL, $cdata['values'][$i] ); 
			 $bb ="";
			 	
				$hasSetValue = false;
				foreach($options as $val){ 
					$val = trim($val);				 		
					if((is_array($value) && in_array($val,$value)) || $value == $val ){
							$bb = 'checked=checked';
							$hasSetValue = true;
					}else{
							$bb = '';
					}
					
					$extrastyles = "height:auto !important; width: auto !important;    display: inline-block !important;";
					if(is_admin()){
					$extrastyles = "width:18px; height: 18px !important;";
					}
					$STRING .= '
					<div class="form-check pl-0">
					<label class="checkbox" >
					 
					<input type="checkbox" '.$bb.' name="custom['.$cdata['dbkey'][$i].'][]" data-toggle="checkbox" class="form-control" style="'.$extrastyles.'" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />
					&nbsp; &nbsp; '.$val.'
					
					</label>
					</div>';
				}// end foreach
				// THIS EXTRA VALUE WAS ADDED SO THAT THE FORM DATA WILL COMPLETE WITHOUT ANY VALUES CHECKED
				// OTHERWISE IT WOULD NOT SAVE
				$STRING .= '<input type="hidden"  name="custom['.$cdata['dbkey'][$i].'][]" class="form-control"  value="--" />';
				
				if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){
				
					// FORM NAME
					if(isset($GLOBALS['flag-myaccount'])){ $formname = "#myaccountdataform"; }else{ $formname = "form"; }
					
					
					$STRING .= "<script>
					 jQuery(document).ready(function(){ 
					 ";
					 
					 
					if(!isset($_GET['eid'])){  if(!$hasSetValue){ 
					$STRING .= " jQuery('".$formname." .btn-primary').attr('disabled', true); ";
					} }
					 
					$STRING .= " jQuery('".$formname." .reg_form_".$cdata['dbkey'][$i]."').on('change', function (e) {
					
						isChecked = false; 						
						jQuery('".$formname." .reg_form_".$cdata['dbkey'][$i]."').each(function(){				 
							 
							if(jQuery(this).is(\":checked\")){
								isChecked = true;							
							}													
						});
						
						if(isChecked){
						jQuery('".$formname." .btn-primary').attr('disabled', false);
						}else{
						jQuery('".$formname." .btn-primary').attr('disabled', true);
						}
						"; 
						
					$STRING .= "}); });</script>";
					
				}
				
			} break;	
					
			case "radio": { 
			 	
				$options = explode( PHP_EOL, $cdata['values'][$i] ); $bb =""; $rc = 0;
			 
			 
				foreach($options as $val){		
				
					$val = trim($val);		 		
					
					if( $value == $val || ( $value =="" && $rc==0 ) ){
							$bb = 'checked=checked';
					}else{
							$bb = '';
					}
					
					//echo $value."<--".$val;
 		
					//id="reg_form_'.$cdata['dbkey'][$i].'"
					
					$STRING .= '<div class="">
					<label class="custom-control custom-checkbox">
					<input type="radio" class="form-control custom-control-input border-0" '.$bb.' name="custom['.$cdata['dbkey'][$i].']"  value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" /><span class="custom-control-label"></span>
					
					&nbsp; &nbsp; '.$val.
					'</label>
					</div>';
					
					$rc++;
				}// end foreach			
			} break;	
			
			} } // end switch iffset				
			
			}
			$GLOBALS['TABORDER']++;
			
			if(isset($cdata['help'][$i]) && strlen($cdata['help'][$i]) > 1 && !is_admin()){
			
			$STRING .= "<small class='description'>".$CORE->GEO("translate_field_help", array( stripslashes($cdata['help'][$i]), $i, $cdata))."</small>";
			
			}
			
			
			 $STRING .= '</div></div>';	
		 
			
			
			
			
			
		  	////////////////////////////////////////////////////
			// REQUIRED FIELDS
			////////////////////////////////////////////////////
			if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes" && $cdata['fieldtype'][$i] != "checkbox" && $cdata['fieldtype'][$i] != "radio"){
			 
			if(isset($cdata['taxonomy'][$i]) && strlen($cdata['taxonomy'][$i]) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			}
			
			if($eth != "_tax"){
			
			$VALIDATION .= " 
			
				if( jQuery('#fkey".$cdata['dbkey'][$i]."').css('display') != 'none' ){ 
				
				
					var cus".$GLOBALS['TABORDER']." = document.getElementById(\"reg_field".$eth."_".trim($cdata['dbkey'][$i])."\");
				 
						 if(cus".$GLOBALS['TABORDER'].".value == '-------'){
							alert('".__("Please complete all required fields.","premiumpress")."');
							cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
							cus".$GLOBALS['TABORDER'].".focus();
							XXX
							return false;
						}
						if(cus".$GLOBALS['TABORDER'].".value == ''){
							alert('".__("Please complete all required fields.","premiumpress")."');
							cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
							cus".$GLOBALS['TABORDER'].".focus();
							XXX
							return false;
						}
				}
					";
			}
			
				
			$VALIDATION = str_replace("XXX", "colAll(); tsf.goto(2); jQuery('.stepblock5').collapse('show');", $VALIDATION);
				
			
			}
			
			 
			
			
			
			
		$i++; // NEXT FIELD	
		 		
		} }	// end foreach			
		
	}// end if
 
 
	
	$VALIDATION .= ' }</script>';
 
	return $STRING.$VALIDATION;

}   









function CORE_FIELDS($show=false,$addlisting=false){

	global $wpdb, $CORE, $userdata; $STRING = ""; $packageID = ""; $VALIDATION = '<script > function ValidateCoreRegFields(){ ';
	
	if(isset($GLOBALS['core_theme_validation_listing'])){ $VALIDATION .= $GLOBALS['core_theme_validation_listing']; }
	
	// CHECK FOR PACKAGE ID // IF WERE ADDING A NEW LISTING
	if(isset($_POST['packageID']) && is_numeric($_POST['packageID']) ){
	//$packagefields = get_option("packagefields");
	//$packageID = $packagefields[$_POST['packageID']]['ID'];
	$packageID = $_POST['packageID'];
	}
	// TABBING ORDER
	if(!isset($GLOBALS['TABORDER'])){$GLOBALS['TABORDER'] = 3;	}
	// WHICH SET OF FIELDS TO DISPLAy
	if($addlisting){
	$regfields = get_option("submissionfields");
	}else{
	$regfields = get_option("regfields");
	}
	
	// ADD ON BASIC FIELDS FOR REGISTRATION
	if(!$addlisting && !isset($GLOBALS['flag-myaccount']) ){
	
	$VALIDATION .= "var b1 = document.getElementById(\"user_login\");if(b1.value == ''){alert('".str_replace("'","",__("Please complete all required fields.","premiumpress"))."');b1.style.border = 'thin solid red';b1.focus();return false;};";
	$VALIDATION .= "var b2 = document.getElementById(\"user_email\");if(b2.value == ''){alert('".str_replace("'","",__("Please complete all required fields.","premiumpress"))."');b2.style.border = 'thin solid red';b2.focus();return false;};";
	$VALIDATION .= "if( !isValidEmail( b2.value ) ) { alert('".str_replace("'","",__("You have entered and invalid email address.","premiumpress"))."'); b2.style.border = 'thin solid red'; b2.focus(); return false; }";
	}
	
	
	if(isset($GLOBALS['CORE_THEME']['show_mem_registraion']) && $GLOBALS['CORE_THEME']['show_mem_registraion'] == '1' && !isset($GLOBALS['tpl-add']) && $GLOBALS['nosidebar-right'] == true && $GLOBALS['nosidebar-left'] == true){
	$VALIDATION .= "var mm1 = document.getElementById(\"membershipID\"); if(mm1.value == ''){alert('".str_replace("'","",__("Please select a membership package.","premiumpress"))."'); return false;};";
	}
	
 	if(is_array($regfields)){
	
		//PUT IN CORRECT ORDER
		$regfields = $this->multisort( $regfields , array('order') );
		$regfields = hook_custom_fields_filter($regfields);
		foreach($regfields as $field){
		
		 
			// EXIST IF KEY DOESNT EXIST
			if($field['fieldtype'] == "taxonomy" && is_admin() ){ continue; }
			if($field['key'] == "" && ( $field['fieldtype'] != "taxonomy" && $field['fieldtype'] != "title" ) ){ continue; }
	 
			$canContinue = false;
			// CHECK MEMBERSIP HAS ACCESS TO THIS FIELD
			if(isset($field['membership']) && is_array($field['membership']) && count($field['membership']) > 0){
				if( isset($GLOBALS['current_membership']) && in_array($GLOBALS['current_membership'], $field['membership'])  ){
				$canContinue = true; 
				}else{
				$canContinue = false;
				}
			}else{
			$canContinue = true; 
			}
			 
			// CHECK PACKAGE HAS ACCESS TO THIS FIELD
			if(isset($field['package']) && is_array($field['package']) && count($field['package']) > 0){
				if(is_numeric($packageID) && in_array($packageID, $field['package']) ){ 
				$canContinue = true;
				}else{
				$canContinue = false;
				}
			}else{
			/** add an extra check because the membersips might return false above ***/
			if($canContinue){
				$canContinue = true;
			} 
			}
			
			// NOW GET THE RESULT
			if(!$canContinue && !is_admin()){ continue; } // 
			 
			
			// CHECK IF WE ARE GETTING VALUES
			if($show){				
				// CAN WE DISPLAY THIS ON OUR PROFILE??
				if(isset($field['display_profile']) && $field['display_profile'] == "no"){ continue; } // SKIP FIELD
				
				if($addlisting){				
					if($field['fieldtype'] == "taxonomy"){					
					$value = get_the_terms( $_GET['eid'], $field['taxonomy'] );
					}else{
					$value = get_post_meta($_GET['eid'], $field['key'], true);
					}				
				}else{
				$value = get_user_meta($userdata->ID, $field['key'], true);
				}
				
			}else{
				if(isset($_POST['custom'][$field['key']])){
					// GET THE POST DATA AFTER FORM WAS SUBMITTED
					if(is_array($_POST['custom'][$field['key']])){
					$value = $_POST['custom'][$field['key']];
					}else{
					$value = esc_attr($_POST['custom'][$field['key']]);
					}				
				}else{
					// GET LISTING DATA
					if($addlisting && isset($_GET['eid']) && $field['fieldtype'] == "taxonomy"){					
					$value = get_the_terms( $_GET['eid'], $field['taxonomy'] );
					}elseif($addlisting && isset($_GET['eid']) ){
					$value = get_post_meta($_GET['eid'], $field['key'], true);
					}else{
					$value = "";
					}				
				}
			}
			
			
			if($field['fieldtype'] == "title" ){
			
				if(is_admin()){
				$STRING .= '<b>'.stripslashes($field['name']).'</b><hr/>';
				}else{
				$STRING .= '<div class="form-group clearfix customfield"><h4 class="fieldtitle">'.stripslashes($field['name']).'</h4><div>';
				}
			
			
			}else{
			
					// GET THE CATIDS FOR THIS FIELD
					
					$dcats = ""; $hide = false;
					if(isset($field['cat']) && !empty($field['cat']) ){
						$hide = true;
						foreach($field['cat'] as $h){
						$dcats .= "customid-".$h." ";
						}
					}else{
					$dcats .= "customid-0 ";
					}
					
					$hs = "";
					if($hide){
					$hs = "style='display:none;'";
					}
				  	
				
					$STRING .= '<div class="form-group clearfix customfield '.$dcats.'" '.$hs.'>
					
					
					  <label class="control-label col-md-4">'.stripslashes($field['name']);
					  if(isset($field['required']) && $field['required'] == "yes"){ $STRING .= ' <span class="required">*</span>'; }
					$STRING .= '</label><div class="field_wrapper col-md-8">';
			 
				
				
			}
			
			// ADD IN VALIDATE CODE
			if(isset($field['required']) && $field['required'] == "yes" && $field['fieldtype'] != "checkbox" && $field['fieldtype'] != "radio"){
			 
			if(isset($field['taxonomy']) && strlen($field['taxonomy']) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			}
			
			if($eth != "_tax"){
			
			$VALIDATION .= " var cus".$GLOBALS['TABORDER']." = document.getElementById(\"reg_field".$eth."_".trim($field['key'])."\");
					 if(cus".$GLOBALS['TABORDER'].".value == '-------'){
						alert('".__("Please complete all required fields.","premiumpress")."');
						cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
						cus".$GLOBALS['TABORDER'].".focus();
						XXX
						return false;
					}
					if(cus".$GLOBALS['TABORDER'].".value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
						cus".$GLOBALS['TABORDER'].".focus();
						XXX
						return false;
					}";
			}
			
				if(isset($GLOBALS['tpl-add'])){
					$VALIDATION = str_replace("XXX", "colAll(); jQuery('.stepblock5').collapse('show');", $VALIDATION);
				}else{
					$VALIDATION = str_replace("XXX", "", $VALIDATION);
				}
			
			}
			
			 
			if($field['key'] == "country"){
						 		 
				$STRING .= sprintf( '<select class="form-control" name="custom['.$field['key'].']" id="reg_field_'.$field['key'].'">', "" );
                foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
                	$STRING .= sprintf( '<option value="%1$s"%3$s>%2$s</option>', trim( $key  ), $option, selected( $value, $key, false ) );
                }
                $STRING .= '</select>';
				
			}elseif($field['key'] == "state"){
				
				// SELECT AND STRING				
                $selected = isset( $_GET['custom']['state'] ) ? $_GET['custom']['state'] : '';				 
				
					$STRING .= sprintf( '<select class="form-control" name="custom['.trim($field['key']).']" id="reg_field_'.trim($field['key']).'">', "" );
					foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
						$STRING .= sprintf( '<option value="%1$s" disabled id="'.$key.'_key">%2$s</option>', trim( $key  ), $option);
					 
						if(isset($GLOBALS['core_state_list'][$key])){						
							$state_list = explode("|",$GLOBALS['core_state_list'][$key]);						 
							foreach($state_list as $state){							
									$STRING .= sprintf( '<option value="%1$s"%3$s>-- %2$s</option>', trim( $state  ), $state, selected( $value, $state, false ) );
							} // end foreach					
						}// end if			
					} // end foreach
                	$STRING .= '</select>';
                	$STRING .=  '<script> jQuery(\'#core_country_dropdown1\').change(function() { jQuery(\'#core_state_dropdown1\').val(this.value); } ); </script>';	
			
			}else{
			 
			// SWITCH TYPES
			switch($field['fieldtype']){ 
			
			case "input": { 	
			
			if($field['key'] == "price"){
			
				$STRING .='<div class="input-group date col-md-4">
				<input type="text" name="custom['.$field['key'].']" value="'.$value.'"  tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$field['key'].'" class="form-control" />
				<span class="input-group-prepend"><span class="input-group-text">'.hook_currency_symbol('').'</div></span>
			  </div> <div class="clearfix"></div> ';
			  
			  $STRING .= "<script>jQuery('#reg_field_".$field['name']."').change(function(e) { 
			  if(!isNaN(jQuery('#reg_field_".$field['name']."').val())){ }else{ jQuery('#reg_field_".$field['name']."').val(''); } }); </script>";
			  
			}else{
			$STRING .='<input type="text" name="custom['.$field['key'].']" value="'.$value.'" id="reg_field_'.$field['key'].'" tabindex="'.$GLOBALS['TABORDER'].'" class="form-control" />';	
			}
			  
						
			} break;
			case "textarea": { 
				$STRING .= '<textarea name="custom['.$field['key'].']" class="form-control" id="reg_field_'.$field['key'].'" tabindex="'.$GLOBALS['TABORDER'].'">'.$value.'</textarea>';
			} break;

			case "select": {
			
			 			
			 $options = explode( PHP_EOL, $field['values'] );			 
			 $STRING .= '<select name="custom['.$field['key'].']" class="form-control" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$field['key'].'">';					
				foreach($options as $val){
					
					$val = trim($val);
					
					if($value == $val){
							$STRING .= '<option value="'.$val.'" selected=selected>'.$val.'</option>';
					}else{
							$STRING .= '<option value="'.$val.'">'.$val.'</option>';
					}
				}// end foreach
			$STRING .= '</select>';
			} break;
			case "date": {
		
		
			$STRING .= 'removed';	
			
			} break;			
			case "taxonomy": {
			 
		 
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				if(is_array($value)){
				$selected_array = array();
				foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				}
				
			 	// START BUILDING THE LIST 
				 
				$terms = get_terms($field['taxonomy'],"get=all");
			 
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
				$count = count($terms);	
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($field['taxonomy_link']) && strlen($field['taxonomy_link']) > 2 && $field['taxonomy_link'] != "store"){
						$taxlink = true;
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("http://","",get_home_url())."',this.value,'".$field['taxonomy_link']."__".$field['taxonomy']."','tx_".$field['taxonomy_link']."[]','-1','".$canAdd."','reg_field_tax_".$field['taxonomy_link']."')\"";
					}
						 
					$STRING .= '<select name="tax['.$field['taxonomy'].']" class="form-control" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$field['taxonomy'].'" '.$ex.'>';
					
					$STRING .="<option value=''></option>";
					 
					
					// COUNT TERMS AND					
					foreach ( $terms as $term ) {					
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }						
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $CORE->GEO("translation_tax_value", array($term->term_id, $term->name)) . " (".$term->count.") </option>";
						
						// GET INNER CHILD ITEMS
						/*
						$terms_inner = get_terms($field['taxonomy'],'hide_empty=0&child_of='.$term->term_id);
						if(count($terms_inner) > 0){						
						
							foreach ( $terms_inner as $term_inn ) {
							
								// SETUP VALUE FOR LISTBOX
								if($taxlink){ $tvg1 = $term_inn->term_id; }else{ $tvg1 = $term_inn->term_id; }
								
								// SETUP SELECTED VALUE
								if(is_array($selected_array) && in_array($tvg1,$selected_array)){ $b = "selected=selected"; }else{ $b= ""; }
								
								$STRING .= "<option value='".$tvg1."' ".$b."> -- " . $term_inn->name . " (".$term_inn->count.") </option>";
							}
						} 		
						*/		 		   
													   				
					 }
					 
					 
					$STRING .= '</select>';
				}
				
			} break;					
			case "checkbox": { 
			 $options = explode( PHP_EOL, $field['values'] ); $bb ="";
			 	
				$hasSetValue = false;
				foreach($options as $val){ $val = trim($val);				 		
					if((is_array($value) && in_array($val,$value)) || $value == $val ){
							$bb = 'checked=checked';
							$hasSetValue = true;
					}else{
							$bb = '';
					}
					$STRING .= '<label class="checkbox"> <input type="checkbox" 
					'.$bb.' name="custom['.$field['key'].'][]" class="reg_form_'.$field['key'].' form-control" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />'.$val.'</label>';
				}// end foreach
				// THIS EXTRA VALUE WAS ADDED SO THAT THE FORM DATA WILL COMPLETE WITHOUT ANY VALUES CHECKED
				// OTHERWISE IT WOULD NOT SAVE
				$STRING .= '<input type="hidden"  name="custom['.$field['key'].'][]"  value="--" class="form-control" />';
				
				if(isset($field['required']) && $field['required'] == "yes"){
				
					// FORM NAME
					if(isset($GLOBALS['flag-myaccount'])){ $formname = "#myaccountdataform"; }else{ $formname = "form"; }
					
					
					$STRING .= "<script>
					 jQuery(document).ready(function(){ 
					 ";
					 
					 
					if(!isset($_GET['eid'])){  if(!$hasSetValue){ 
					$STRING .= " jQuery('".$formname." .btn-primary').attr('disabled', true); ";
					} }
					 
					$STRING .= " jQuery('".$formname." .reg_form_".$field['key']."').on('change', function (e) {
					
						isChecked = false; 						
						jQuery('".$formname." .reg_form_".$field['key']."').each(function(){				 
							 
							if(jQuery(this).is(\":checked\")){
								isChecked = true;							
							}													
						});
						
						if(isChecked){
						jQuery('".$formname." .btn-primary').attr('disabled', false);
						}else{
						jQuery('".$formname." .btn-primary').attr('disabled', true);
						}
						"; 
						
					$STRING .= "}); });</script>";
					
				}
				
			} break;			
			case "radio": { 
			 $options = explode( PHP_EOL, $field['values'] ); $bb =""; $rc = 0;
				foreach($options as $val){		$val = trim($val);		 		
					if( $value == $val || ( $value =="" && $rc==0 ) ){
							$bb = 'checked=checked';
					}else{
							$bb = '';
					}
					$STRING .= '<label class="radio"><input type="radio" 
					'.$bb.' name="custom['.$field['key'].']" id="reg_form_'.$field['key'].'" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />'.$val.'</label>';
					$rc++;
				}// end foreach			
			} break;	
			
			} // end if is country/state					
			
			}	
			$GLOBALS['TABORDER']++;
			
			if(isset($field['help']) && strlen($field['help']) > 1 && !is_admin()){
			$STRING .= "<p class='description'>".$field['help']."</p>";
			}
			
			
		 
				$STRING .= '</div></div>';	
			 
			
			
		}	// end foreach	
	}// end if
	
	if(isset($GLOBALS['CORE_THEME']['visitor_password']) && $GLOBALS['CORE_THEME']['visitor_password'] == '1' && !isset($GLOBALS['tpl-add']) && !isset($GLOBALS['flag-myaccount']) ){
	
	$VALIDATION .= "var pass1 = document.getElementById(\"pass1\"); var pass2 = document.getElementById(\"pass2\");
					if(pass1.value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass1.style.border = 'thin solid red';
						pass1.focus();
						return false;
					}
					if(pass2.value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass2.style.border = 'thin solid red';
						pass2.focus();
						return false;
					}
					if(pass2.value != pass1.value){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass1.style.border = 'thin solid red';
						pass2.style.border = 'thin solid red';
						pass2.focus();
						return false;
					}
					";
					
					// ADD ON MEMBERSHIP REQUIRMENT
					//if($GLOBALS['CORE_THEME']['show_mem_registraion'] == '1'){
					//	$VALIDATION .= "var mem = document.getElementById(\"membershipID\");
					//	if(mem.value == ''){
					//		alert('".$CORE->_e(array('validate','31'))."');							
					//		return false;
					//	}";					
					//}
	}
 
	
	$VALIDATION .= ' }</script>';
 
 	
	return $STRING.$VALIDATION;

}   
	
}

?>