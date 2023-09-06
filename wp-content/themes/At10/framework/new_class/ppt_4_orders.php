<?php


class framework_orders extends framework_media {

// USED WITHIN OLD PAYMENT PLUGINS
function order_exists($orderid){ global $CORE;

	return $CORE->ORDER("check_exists", $orderid);
}

 
function ORDER($action='add', $order_data = "123"){

global $userdata, $wpdb, $CORE;
 
	switch($action){
	
		
		case "get_dispute_pending": {
		
			$jobid = $order_data[0]; 
			$buyer = $order_data[1]; 
			$seller = $order_data[2]; 
		
							
					$args = array(
						'post_type' 		=> 'ppt_dispute',
					 		'post_status'	=> 'publish',
							'meta_query' => array( 
							
								'relation' => "AND",
								
								'order_id'    => array(
									'key' 			=> 'order_id',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $jobid,
									'compare' 		=> '=',								 					 			
								),
								
								'user_id'    => array(
									'key' 			=> 'user1_id',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $buyer,
									'compare' 		=> '=',								 					 			
								),
								
								'cashout_status'    => array(
									'key' 			=> 'user2_id',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $seller,
									'compare' 		=> '=',								 					 			
								),					 	
							),  
							
					  );
					  
					  
					 $wp_query1 = new WP_Query($args);
					  
					 
					return $wp_query1->found_posts;
					
		} break;
	
		case "get_dispute_status_formatted": {
		
			$status = $CORE->ORDER("dispute_status", $order_data);
			if(!isset($status['css'])){
				$status['css'] = "";
			}
			if(!isset($status['name'])){
				$status['name'] = "";
			}
			 	 
			$t = '<span class="inline-flex items-center font-weight-bold order-status-icon '.$status['css'].'"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap">'.$status['name'].'</span> </span>';
			
			return $t;
		
		} break;
		
		case "get_dispute_user_status_formatted": {
		
			$status = $CORE->ORDER("dispute_user_status", $order_data);
			if(!isset($status['css'])){
				$status['css'] = "";
			}
			if(!isset($status['name'])){
				$status['name'] = "";
			}
			 	 
			$t = '<div class="ppt-badge '.$status['css'].'">  '.$status['name'].'</div>';
			
			return $t;
		
		} break;
		
		
	case "dispute_user_status": {
	 
	 
			$order_status = array(
			
			
			 	1 => array(	
					"name" =>  __("User Agrees","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-2",
					"key" => 0,
				),
				
			
				2 => array(	// FOR OLDER SYSTEM
					"name" =>  __("User Disagrees","premiumpress"), 
					"color" => "#34cd63",
					"css" => "status-1",
					"key" => 1,
				),		
				
				3 => array(	
					"name" =>  __("No Choice Made","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-3",
					"key" => 2,
					
				),	 
				 
			
			);
			
			
			if(is_numeric($order_data) && isset($order_status[$order_data]) ){ // GET SINGLE
			
				return $order_status[$order_data];
			
			}
			
			return $order_status; 
		
		
		} break;
		
	case "dispute_status": {
	 
		
			$order_status = array(
			
			
			 	1 => array(	
					"name" =>  __("Pending","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-2",
					"key" => 0,
				),
				
			
				2 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Approved","premiumpress"), 
					"color" => "#34cd63",
					"css" => "status-1",
					"key" => 1,
				),		
				
				3 => array(	
					"name" =>  __("Rejected","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-3",
					"key" => 2,
					
				),	 
				 
			
			);
			
			
			if( $order_data == "random" ){ // RETURN RANDOM TYPE
			
				return rand(0, 6);			
			 
			
			}elseif(is_numeric($order_data) && isset($order_status[$order_data]) ){ // GET SINGLE
			
				return $order_status[$order_data];
			
			}
			
			return $order_status; 
		
		
		} break;
	
		case "dispute_fields": {
		
			$fields = array(
				
				
				"dispute_status"  => array(
				
						"name" 	=> __("Status","premiumpress"),
						"values" => array(

							"1" => array("id" => "1", "name" => __("Pending","premiumpress") ),							
							"2" => array("id" => "3", "name" => __("Approved","premiumpress") ),
							"3" => array("id" => "3", "name" => __("Rejected","premiumpress") ),							
						),
						"type" => "select",						
						"default" => "1",
						
				),
				
				
				
			 	"post_id"	=> array(		
						"name" => __("Job Post ID","premiumpress"),		
						"default" => "",
						"type" => "text", 
				),
				  
				
				"order_total"	=> array(		
						"name" => __("Order Amount","premiumpress"),		
						"default" => "",
						"type" => "text", 
				),
				  
				 "order_id"	=> array(		
						"name" => __("Order ID","premiumpress"),		
						"default" => "",
						"type" => "text", 
				),
				
				
				"divider"	=> array(
				
					"name" 	=> __("Dispute From","premiumpress"),
					"type" => "seperator",
				
				),
				
				 
				"user1_id"	=> array(
						"name" => __("User ID","premiumpress"),
						"default" => "",
						"type" => "text",
				),
				
				"user1_status"  => array(
				
						"name" 	=> __("Status","premiumpress"),
						"values" => array(

							"1" => array("id" => "1", "name" => __("User Agrees","premiumpress") ),							
							"2" => array("id" => "2", "name" => __("User Disagrees","premiumpress") ),
							"3" => array("id" => "3", "name" => __("No Choice Made","premiumpress") ),							
						),
						"type" => "select",						
						"default" => "3",
						
				),
				
				"user1_notes"	=> array(		
						"name" => __("User Comments","premiumpress"),		
						"default" => "",
						"type" => "textarea",
						"css" => "col-12 mb-4",						
				),
				
				"divider22"	=> array(
				
					"name" 	=> __("Dispute To","premiumpress"),
					"type" => "seperator",
				
				),
				
				 
				"user2_id"	=> array(
						"name" => __("User ID","premiumpress"),
						"default" => "",
						"type" => "text",
				),
				
				"user2_status"  => array(
				
						"name" 	=> __("Status","premiumpress"),
						"values" => array(

							"1" => array("id" => "1", "name" => __("User Agrees","premiumpress") ),							
							"2" => array("id" => "2", "name" => __("User Disagrees","premiumpress") ),
							"3" => array("id" => "3", "name" => __("No Choice Made","premiumpress") ),							
						),
						"type" => "select",						
						"default" => "3",
						
				),
				
				"user2_notes"	=> array(		
						"name" => __("User Comments","premiumpress"),		
						"default" => "",
						"type" => "textarea",
						"css" => "col-12 mb-4",						
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
	
	
	
	
	
	
	
	
	
	
	
	
	
		case "count_invoices_by_userid": {
		
	   // ORDERS
		$args = array(
			'post_type' 		=> 'ppt_orders', 
			'fields' => 'ids',
			'no_found_rows' => true,
				'meta_query' => array( 
					'user_id'    => array(
						'key' 			=> 'order_userid',	
						'type' 			=> 'NUMERIC',
						'value' 		=> $order_data,
						'compare' 		=> '=',								 					 			
					),					 	
				), 
			 
				
		  );
		  $wp_query1 = new WP_Query($args); 
		  $orders = $wpdb->get_results($wp_query1->request, OBJECT);
		  
		  
	  	// PAYMENTS
		 $args = array(
			'post_type' 		=> 'ppt_orders', 
			'fields' => 'ids',
			'no_found_rows' => true,
			'meta_query' => array(
				'relation'    => 'OR',												 
											'seller_id'    => array(
												'key' => 'seller_id',	
												'type' 			=> 'NUMERIC',
												'value' 		=> $order_data,
												'compare' 		=> '=',								 					 			
											),			 
											'buyer_id'   => array(
												'key'     => 'buyer_id',							
												'type' 			=> 'NUMERIC',
												'value' 		=> $order_data,
												'compare' 		=> '=',															
											),		
			),
				
		  );
		  $wp_query2 = new WP_Query($args); 
		  $payments = $wpdb->get_results($wp_query2->request, OBJECT);  
		  
		  
		  return  number_format(count($orders)+count($payments));
		
		} break;
		
		
		case "get_user_sales": {
		
                     $args = array(
                        'post_type' 		=> 'ppt_offer',
                        'posts_per_page' 	=> 100,
                        'paged' 			=> 1,
                     	'post_status'		=> 'publish',
						 'meta_query' => array(	
							 'relation'    => 'AND',					
								 array(							
									 'relation'    => 'OR',											 
									 'user1'    => array(
									 'key' => 'buyer_id',
									 'compare' => '=',
									 'value' => $order_data,							 			
									),			 
									 'user2'   => array(
									 'key'     => 'seller_id',							
									 'compare' => '=',
									 'value' => $order_data,	                     
								 ),						
							 ),	
						 ),
                     );					
                     $wp_query = new WP_Query($args); 
                      
                     $tt = $wpdb->get_results($wp_query->request, OBJECT);
					 $data = array(); $totalAmount = 0;
                     foreach($tt as $p){
					 	
						// STATUS
					 	$offer_status = get_post_meta($p->ID,'offer_status',true);
						
						// GET BUYER ID
						$job_buyer_id = get_post_meta($p->ID,'buyer_id',true);
						if($job_buyer_id == ""){ $job_buyer_id =0;}
											 
						$job_seller_id = get_post_meta($p->ID,'seller_id',true);
						if($job_seller_id == ""){ $job_seller_id = 0; }
						 
						 
						 // GET POST ID FOR JOB
						$order_total = 0; $order_id = "";
						if(get_post_meta($p->ID,'order_id',true) != ""){
						
							$order_total = $CORE->ORDER("get_order_total", get_post_meta($p->ID,'order_id',true));						
							$order_id = get_post_meta($p->ID,'order_id',true);
						}
						
						if($order_total == "0"){ // THIS IS BECAUSE OF BUY NOW OPTION, NO PAYMENT ORDER IS MADE
						
							$order_total = get_post_meta($p->ID, 'price', true);
						 	   
						}
						 
						if($offer_status == "3"){
							$data[] = array(
								"total" 		=> $order_total,
								"buyer_id" 		=> $job_buyer_id,
								"seller_id" 	=> $job_seller_id,
								"order_id" 		=> $order_id,
								"date" 			=> get_the_time('Y-m-d', $p->ID),
							);
							
							$totalAmount += $order_total;
						
						}					
					 
					 }
				 
				 
				 // die(print_r($data)." --".$order_data);
				 
				return array("total" => $totalAmount, "items" => $data);
		
		} break;
	
		case "get_user_sales_ids": {
		
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
	
		case "order_id_amount": {
		
			$orderid = $order_data;
		
			// EXTRA VALIDATE FOR USER ID
			if( substr($orderid,0,4) == "SUBS"){
			
				$ff = explode("-",$orderid);
				if(isset($ff[2]) && is_numeric($ff[2])){
								
				$sd = $CORE->USER("get_this_membership", $ff[1]);
			 
				return $sd['price'];	
				
				} 
			
			
			}
			
			return 0;
		
		
		} break;
	
		case "order_id_user_id": {
		
			$orderid = $order_data;
		
			// EXTRA VALIDATE FOR USER ID
			if( substr($orderid,0,4) == "SUBS"){
				
				$ff = explode("-",$orderid);
				if(isset($ff[2]) && is_numeric($ff[2])){
				return $ff[2];
				}
			
			}elseif(substr($orderid,0,6) == "CREDIT"){
			
				$ff = explode("-",$orderid);
				if(isset($ff[1]) && is_numeric($ff[1])){
				return $ff[1];
				}	
			
			
			}elseif(substr($orderid,0,7) == "UPGRADE"){
			
				$ff = explode("-",$orderid);
				if(isset($ff[1]) && is_numeric($ff[1])){ 
				return get_post_field( 'post_author', $ff[1] );
				}	
				
			
			}elseif( substr($orderid,0,6) == "ESCROW"){	
			
				$ff = explode("-",$orderid);
				if(isset($ff[1]) && is_numeric($ff[1])){
				return get_post_meta($ff[1], 'order_userid', true);
				}	
				
			}elseif( substr($orderid,0,4) == "GIFT"){	
			
				$ff = explode("-",$orderid); 
				
				if(isset($ff[3]) && is_numeric($ff[3])){
				return $ff[3];
				} 
				
			}elseif(substr($orderid,0,3) == "BAN"){
			
				$ff = explode("-",$orderid);
				if(isset($ff[2]) && is_numeric($ff[2])){
				return $ff[2];
				}	
			
			}elseif(substr($orderid,0,2) == "MJ"){ 
			
				$ff = explode("-",$orderid);
				if(isset($ff[2]) && is_numeric($ff[2])){
				return $ff[2];
				}	
			
			}elseif(substr($orderid,0,4) == "CART"){
			
				 
				$ff = explode("-",$orderid);
				if(isset($ff[1]) ){				
				
					$obits = explode("-",$orderid); 
					$SQL = "SELECT session_data FROM ".$wpdb->prefix."core_sessions WHERE session_key LIKE ('%".strip_tags($ff[1])."%') LIMIT 1";
					$hassession = $wpdb->get_results($SQL, OBJECT);
					
					if(!empty($hassession)){
								// RESTORE THE CART DATA
							$cart_data = unserialize($hassession[0]->session_data);	 
							 
							return $cart_data['userid'];
					}
					  
				}
				
				// FALL BACK
				$orderbits = explode("-",$orderid);
				if(isset($orderbits[2])){
					return $orderbits[2];
				} 
				
				if(isset($userdata->ID)){
					return $userdata->ID;
				}
			
			}  
			
			return 1;
		
		
		} break;
	 	
	
		case "user_get_name": {
			
			$name = "";
			
			if(THEME_KEY == "sp"){
				
				$f = get_user_meta($order_data, "billing_fname", true)." ".get_user_meta($order_data, "billing_lname", true);
				 
				if(strlen($f) > 3){
					$name .= $f."<br>";
				}
			}
			
			if($name == ""){
			$name = $CORE->USER("get_name", $order_data);
			}
			
			return $name;
		
		} break;
		
		case "user_get_address": {
		
			$addr = "";
			
			if(THEME_KEY == "sp"){
			
				global $CORE_CART;
			
				foreach($CORE_CART->shop_user_fields as $key => $field){	
		 		
					if($field['type'] != "sep" && !in_array($key, array("billing_phone","billing_fname","billing_lname")) ){
					
						$f = get_user_meta($order_data, $key, true);
						if(strlen($f) > 0){
						$addr .= $f."<br>";
						}
					 
					}		
				}			
			}
		
			if($addr == ""){
			$addr = $CORE->USER("get_address", $order_data);
			}
			
			return $addr;
		
		
		} break;
		
		case "user_get_phone": {
			
			$addr = "";
			
			if(THEME_KEY == "sp"){
				
				$f = get_user_meta($order_data, "billing_phone", true);
				if(strlen($f) > 0){
					$addr .= $f."<br>";
				}
			}
			
			if($addr == ""){
			$addr = $CORE->USER("get_phone", $order_data);
			}
			
			return $addr;
		
		
		} break;
		
		case "format_id": {
		
			return str_pad($order_data, 6, "0", STR_PAD_LEFT);
		
		} break;
		
		case "check_expired": {
		
			$orderid = $order_data;	
		
		} break;
		
		case "check_exists": {
		
			if($order_data == ""  || $order_data == "UPGRADE-" || $order_data == "LST-" ){ //|| $order_data == "CART-"
				return "";
			}
		
			$ores = $wpdb->get_results("SELECT post_id as order_id FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'order_id' AND meta_value = ('".esc_sql($order_data)."') LIMIT 1 ");
			 
			if(isset($ores[0])){
			  
				if($ores[0]->order_id == 0){	
					return "";
				}else{
					return $ores[0]->order_id;
				}
			
			}	
		
		} break;
 
		case "delete": {
		 
			wp_delete_post( $order_data, true );
			return;	
		
		} break;
			
		case "add": {
		 
		 	// DONT ADD INVOICE FOR COMBINED ORDERS
			if(strpos($order_data['order_id'],"combined") !== false){
			return array("orderid" => "99999999", "type" => "old");	
			}
			
				
			// CHECK ORDER DOESNT ALREADY EXISTS
			if(!is_numeric($this->ORDER("check_exists", $order_data['order_id'])) ){			
				 
				if(isset($order_data['user_id'])){
					$order_data['order_userid'] = $order_data['user_id'];
				}elseif(isset($order_data['order_userid'])){
					$order_data['order_userid'] = $order_data['order_userid'];
				}else{
					$order_data['order_userid'] = 1;
				}
				
				// PREPARE DATA
		  		$rawdata = array();
				$postcontent = "";
				if(isset($_POST) && !isset($_POST['action'])){
					parse_str(implode("", $_POST), $rawdata);
					if(is_array($rawdata)){
						foreach($rawdata as $k => $v){
							 $postcontent .= $k." == ".$v;
						}
					}
				}
				
				 
				// SETUP NEW ORDER			
				$my_post = array();				
				$my_post['post_title'] 		= "Order #".$order_data['order_id']; 
				$my_post['post_type'] 		= "ppt_orders"; 
				$my_post['post_status'] 	= "publish";
				$my_post['post_content'] 	= $postcontent; 
				$payment_id = wp_insert_post( $my_post );	
				
				 
				// CLEAN THE ORDER DATA
				foreach($order_data as $key=>$val){	
					update_post_meta($payment_id, $key, esc_sql($val));			 
				}// end foreach
				 
				// SET DEFULT STATUS				
				update_post_meta($payment_id, 'order_process', 1);
				
				// RETURN
				return array("orderid" => $payment_id, "type" => "new");
				
			}else{
			
			 	
				// CHECK OLD ORDERS
				$old_id = $this->ORDER("check_exists", $order_data['order_id']);			 	 
			
				// UPDATE STATUS AND SET ACTIVE
				if(is_numeric($old_id)){					
					$my_post = array();	
					$my_post['ID']	= $old_id;	
					$my_post['post_status'] 	= "publish";
					wp_update_post( $my_post );
					 					
					// SET DEFULT STATUS				
					update_post_meta($old_id, 'order_status', 1);
						
					// SET DEFULT STATUS
					if(isset($order_data['order_process']) && is_numeric($order_data['order_process'])){
					
					update_post_meta($old_id, 'order_process', $order_data['order_process']);	
					
					}else{
					
					update_post_meta($old_id, 'order_process', 3);
					
					}
					
					// SET DEFULT STATUS				
					update_post_meta($old_id, 'order_gatewayname', $order_data['order_gatewayname']);	
					
					
					// IF ORDER VALUE IS 0 SET IT AS FREE FOR FREE LISTING
					if($order_data['order_total'] == 0){
					update_post_meta($old_id, 'order_total', 0);
					update_post_meta($old_id, 'order_notes', "free listing upgrade");				
						
					}		
					 			
				}
				 
				
				// ADD NEW TRANSACTION				
				return array("orderid" => $old_id, "type" => "old");			
			}
	 
		} break ; // end add
	
		case "get_id": {		
	 
		 	if( $order_data == "random" ){
			
				return  rand(0,999999);
				
			}
		
		} break;

		
		case "get_order": {
		
			if(get_post_meta($order_data, "order_id", true) != ""){
			
				$p = get_post($order_data);
				
				$data = array(
				
					"order_id" 			=> get_post_meta($order_data, "order_id", true),
					"order_status" 		=> get_post_meta($order_data, "order_status", true),
					
					"order_process" 	=> get_post_meta($order_data, "order_process", true),
					
					"order_date" 		=> $p->post_date,
					
					"order_total" 		=> get_post_meta($order_data, "order_total", true),
					"order_discount" 	=> get_post_meta($order_data, "order_discount", true),
					"order_tax" 		=> get_post_meta($order_data, "order_tax", true),
					"order_shipping" 	=> get_post_meta($order_data, "order_shipping", true),
					"order_shipping_method" 	=> get_post_meta($order_data, "order_shipping_method", true),
					
					
					"order_userid" 		=> get_post_meta($order_data, "order_userid", true),
					"order_email" 		=> get_post_meta($order_data, "order_email", true),
					
					"order_description" => get_post_meta($order_data, "order_description", true),
					
					"order_postid" 		=> get_post_meta($order_data, "order_postid", true),
					
					
					
					
					 
						
				);	
				
				return $data;
			
			}else{
			
				return false;
			
			}
		
		} break;
		
		case "get_order_total": { 
		
			return get_post_meta($order_data, "order_total", true);
		
		} break;
		
		case "get_listing_orders": {
		 
		 	 $records = array();
			   
			  $args = array(
				  'post_type' 			=> 'ppt_orders',
				  'posts_per_page' 		=> 100,					 	 
			  );
			  $args['meta_query']["order_postid"]  = array(							
				'key' => "order_postid",
				'type' => 'NUMERIC',
				'value' => $order_data,
				'compare'=> '='						
			 );			  
			  
			 $wp_query = new WP_Query($args); 
			 $tt = $wpdb->get_results($wp_query->request, OBJECT);
			  
			 if(!empty($tt)){
			 	foreach($tt as $p){	
				
				$os = get_post_meta($p->ID,'order_status',true);
				 
				 		  
				  $records[$p->ID] =  array(
				  
					"id" => $p->ID,
					"id_formatted" 		=> $CORE->ORDER("format_id", $p->ID),
					"total" 			=> get_post_meta($p->ID,'order_total',true),
					"status" 			=> get_post_meta($p->ID,'order_status',true),
					"status_formatted" 	=> $CORE->ORDER("get_status",$os),
					
					
				   );
			 	}
			 }
			 
			 return $records;
		
		
		} break;
		
		
		case "get_process": {
		
		
			$order_status = array(
			 
			
				1 => array(	
					"name" =>  __("Processing","premiumpress"), 
					"color" => "#eb983c",
				),
				
				2 => array(	
					"name" =>  __("In Transit","premiumpress"), 
					"color" => "#277fbf",
				),
				
				3 => array(	
					"name" =>  __("Complete","premiumpress"), 
					"color" => "#34cd63",
				),
				
				4 => array(	
					"name" =>  __("Recurring","premiumpress"), 
					"color" => "#344860",
				),
				
			);
			
			
			if( $order_data == "random" ){ // RETURN RANDOM TYPE
			
				return rand(0, 3);			
			 
			
			}elseif(is_numeric($order_data) && isset($order_status[$order_data]) ){ // GET SINGLE
			
				return $order_status[$order_data];
			
			}
			
			return $order_status; 
		
		
		} break;
		
		
		case "get_status_formatted": {
		
			$status = $CORE->ORDER("get_status", $order_data);
			if(!isset($status['css'])){
				$status['css'] = "";
			}
			if(!isset($status['name'])){
				$status['name'] = "";
			}
			 	 
			$t = '<span class="inline-flex items-center font-weight-bold order-status-icon '.$status['css'].'"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap">'.$status['name'].'</span> </span>';
			
			return $t;
		
		} break;	
		
		case "get_status": {
		
		
			$order_status = array(
			
			/*
			 	0 => array(	
					"name" =>  __("Pending","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-2",
					"key" => 0,
				),
				*/
			
				1 => array(	// FOR OLDER SYSTEM
					"name" =>  __("Paid","premiumpress"), 
					"color" => "#34cd63",
					"css" => "status-1",
					"key" => 1,
				),		
				
				2 => array(	
					"name" =>  __("Pending","premiumpress"), 
					"color" => "#eb983c",
					"css" => "status-3",
					"key" => 2,
					
				),	
					
				
				3 => array(	
					"name" =>  __("Failed","premiumpress"), 
					"color" => "#c13a24",
					"css" => "status-5",
					"key" => 3,
				),			
				
				4 => array(	
					"name" =>  __("Cancelled","premiumpress"), 
					"color" => "#576475",
					"css" => "status-7",
					"key" => 4,
				),
				
				5 => array(	
					"name" =>  __("Refunded","premiumpress"), 
					"color" => "#8d43b4",
					"css" => "status-7",
					"key" => 5,
				),
				
				6 => array(	
					"name" =>  __("On Hold","premiumpress"), 
					"color" => "#95a5a5",
					"css" => "status-2",
					"key" => 6,
				),
				 
			
			);
			
			
			if( $order_data == "random" ){ // RETURN RANDOM TYPE
			
				return rand(0, 6);			
			 
			
			}elseif(is_numeric($order_data) && isset($order_status[$order_data]) ){ // GET SINGLE
			
				return $order_status[$order_data];
			
			}
			
			return $order_status; 
		
		
		} break;
		
		case "get_type": {
		
		
			$ordertypes = array(
	
					"LST" 			=> array(
						"id" 		=> "LST",  
						"name" 		=> __("Listing","premiumpress"), 
						"color" 	=> "#49caae",
					),
					
					"UPGRADE" 		=> array(
						"id" 		=>	"UPGRADE",  
						"name" 		=> __("Listing Upgrade","premiumpress"),   
						"color" 	=> "green",
					),	
					
					
					"PAYWALL" 			=> array(
						"id" 		=> "PAYWALL",  
						"name" 		=> __("Membership","premiumpress"), 
						"color" 	=> "#49caae",
					),
					 
					
					"SUBS" 			=> array(
						"id" 		=> "SUBS",
						"name"		=> __("Membership","premiumpress"),
						"color" 	=> "#34cd63"
					),
					
					"BAN" 			=> array("id" =>"BAN",  "name" => __("Advertising","premiumpress"),  "color" => "#3197e1"),
					"CREDIT" 		=> array("id" =>"CREDIT",  "name" => __("User Credit","premiumpress"),  "color" => "#9a58bc"),
					//"TOKEN" 		=> array("id" =>"TOKEN",  "name" => "Token",  "color" => "" ),
					"RENEW" 		=> array("id" =>"RENEW",  "name" => __("Renewal","premiumpress"),  "color" => "#344860"),
					"INVOICE" 		=> array("id" =>"INVOICE",  "name" => __("Invoice","premiumpress"),  "color" => "#1ba083"),
					//"POWERSELLER" 	=> array("id" =>"POWERSELLER",  "name" => "Powerseller",  "color" => "green"),
					
					
					"CART" 			=> array("id" =>"CART",  "name" => __("Cart","premiumpress"),  "color" => "#54be74"),	
					"MJ" 			=> array("id" =>"MJ",  "name" => __("Micro Jobs","premiumpress"),  "color" => "#277fbf"),
					"NA" 			=> array("id" =>"NA",  "name" => __("Unknown","premiumpress"),  "color" => "#8d43b4"),
					
					"OFFER" 		=> array("id" =>"OFFER",  "name" => __("Offer","premiumpress"),  "color" => "#576475"),
					
					"CUSTOM" 		=> array("id" =>"CUSTOM",  "name" => __("Custom","premiumpress"),  "color" => "#f0c400"),
					
					"TEST" 		=> array("id" =>"TEST",  "name" => __("Test","premiumpress"),  "color" => "#c13a24"),
					
					"GIFT" 		=> array("id" =>"GIFT",  "name" => __("Gift","premiumpress"),  "color" => "#00b9f0"),
					
					"ESCROW" 		=> array("id" =>"ESCROW",  "name" => __("Escrow","premiumpress"),  "color" => "#f0c400"),
					
					"FREE" 		=> array("id" =>"FREE",  "name" => __("Free","premiumpress"),  "color" => "#f0c400"),
					
					"BOOST" 		=> array("id" =>"BOOST",  "name" => __("Account Boost","premiumpress"),  "color" => "#2371b1"),
					
					
			);
			
			$toplevel = array();
			foreach($ordertypes as $k => $h){
			$toplevel[$k] = $k;
			} 
			
			if(is_array($order_data)){
				
				if(THEME_KEY == "sp"){
				unset($ordertypes['LST']);	
				unset($ordertypes['MJ']);
				unset($ordertypes['TEST']);	
				unset($ordertypes['SUBS']);		
				unset($ordertypes['OFFER']);
				}
				
				return $ordertypes;
			
			}elseif( $order_data == "" ){ // RETURN ALL TYPES
			
				return $ordertypes;			
			
			}elseif( $order_data == "random" ){ // RETURN RANDOM TYPE
			
				$rand_keys = array_rand($ordertypes, 2);
							
				return $ordertypes[$rand_keys[0]]['id'];
			
			}elseif(in_array($order_data, $toplevel) ){
			
				return $ordertypes[$order_data];
			
			}elseif(substr($order_data,0,4) == "FREE"){	
			
				return $ordertypes["FREE"];
				
			}elseif(substr($order_data,0,4) == "TEST"){	
			
				return $ordertypes["TEST"];
			
			}elseif(substr($order_data,0,2) == "MJ"){	
			
				return $ordertypes["MJ"];	
			
			}elseif(substr($order_data,0,5) == "TOKEN"){	
			
				return $ordertypes["TOKEN"];
			
			}elseif(substr($order_data,0,5) == "RENEW"){	
		 
				return $ordertypes["RENEW"];
			
			}elseif(substr($order_data,0,7) == "INVOICE"){
			
				return $ordertypes["INVOICE"];
			
			}elseif(substr($order_data,0,11) == "POWERSELLER"){	
			
				return $ordertypes["POWERSELLER"];
			
			}elseif(substr($order_data,0,3) == "BAN"){
			
				return $ordertypes["BAN"];
			
			}elseif(substr($order_data,0,6) == "CREDIT"){
				
				
				if(in_array(THEME_KEY, array("mj","at","ct","ll","pj")) && ( _ppt(array('hc', 'house_comission')) > 0 || _ppt(array('hc', 'house_comission_fixed')) > 0 ) ){
				$ordertypes["CREDIT"]['name'] = __("House Commission","premiumpress");
				}
				
				return $ordertypes["CREDIT"];
			
			}elseif(substr($order_data,0,7) == "UPGRADE"){
			
				return $ordertypes["UPGRADE"];
				
			}elseif(substr($order_data,0,7) == "PAYWALL"){
			
				return $ordertypes["PAYWALL"];
			
			}elseif( substr($order_data ,0,4) == "SUBS"){
			
				return $ordertypes["SUBS"];
			
			}elseif( substr($order_data ,0 ,3) == "LST"){
			
				return $ordertypes["LST"];
			
			}elseif( substr($order_data ,0,4) == "CART"){	
			
				return $ordertypes["CART"];
			
			}elseif( substr($order_data ,0,5) == "OFFER"){	
			
				return $ordertypes["OFFER"];
			
			}elseif( substr($order_data ,0,6) == "CUSTOM"){	
			
				return $ordertypes["CUSTOM"];
				
			}elseif( substr($order_data ,0,6) == "ESCROW"){	
			
				return $ordertypes["ESCROW"];	
				
			}elseif( substr($order_data ,0,4) == "GIFT"){	
			
				return $ordertypes["GIFT"];				
			
			}elseif( substr($order_data ,0,5) == "BOOST"){	
			
				return $ordertypes["BOOST"];				
			
			}
			
			
			return $ordertypes;  
		
		
		} break;
		
		case "get_total": {		
		
		if(!is_numeric($order_data)){ $order_data = 1; }
		
		// TOTAL OF ALL ORDERS		
		$SQL = "SELECT sum(mt1.meta_value) AS total FROM ".$wpdb->prefix."posts 
					INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 	
					INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 				 				
					WHERE 1=1 
					AND ( mt1.meta_key = 'order_total' )
					AND ( mt2.meta_key = 'order_status' AND mt2.meta_value = '".$order_data."' )				 
					AND ".$wpdb->prefix."posts.post_type='ppt_orders' AND ".$wpdb->prefix."posts.post_status = 'publish' ";
			 
			$result = $wpdb->get_results($SQL);	
		 			 
			if(empty($result)){
				return 0;
			}
			
			if(!is_numeric($result[0]->total)){
				return 0;
			}
			
			return $result[0]->total;
	 	
		}
		
		
		case "get_order_items": {
		
		
		// ORDER ID
		if(!is_numeric($order_data)){
		return "invalid order id";
		}
		
		$GLOBALS['global_cart_data'] = array();
		
		$order_post_data = get_post( $order_data );		
		$orderid = get_post_meta($order_data, "order_id", true);
		$order_userid = get_post_meta($order_data, "order_userid", true);	
		$order_status = get_post_meta($order_data, "order_status", true);			
		$order_type = $CORE->ORDER("get_type", $orderid);
		$order_shipping_method = 0;
		
		if(substr($orderid,0,4) == "CART"){
		
		
		
			$obits = explode("-",$orderid); 
			$SQL = "SELECT session_data FROM ".$wpdb->prefix."core_sessions WHERE session_key LIKE ('%".strip_tags($obits[1])."%') LIMIT 1";
			$hassession = $wpdb->get_results($SQL, OBJECT);
			 
			if(!empty($hassession)){
						// RESTORE THE CART DATA
					$cart_data = unserialize($hassession[0]->session_data);
						 
					// NOW WE LOOP ALL ITEMS AND REMOVE THE QTY IF REQUIRED
					if(isset($cart_data['items']) && is_array($cart_data['items'])){
						$GLOBALS['global_cart_data'] = $cart_data;
					 }// end if
			}
			
			// METHOD CHANGE
			if(isset($GLOBALS['global_cart_data']['method']) && is_array($GLOBALS['global_cart_data']['method']) && !empty($GLOBALS['global_cart_data']['method']) ){
				
					// METHODS
					 
						$custommethods 	= _ppt('custommethods');
						$method_name = "";
						$method_price = 0;
						if(is_array($custommethods) && !empty($custommethods['region'])){ $i=0;  
							foreach($custommethods['name'] as $cship){ 
							 
								if(in_array($custommethods['key'][$i], $GLOBALS['global_cart_data']['method']) && is_numeric($custommethods['price'][$i]) ){			
									$method_price += $custommethods['price'][$i];
									$method_name .= $custommethods['name'][$i];
								}
							
								$i++;
							}
						}
					 
				if(get_post_meta($order_data, "order_shipping", true) == "" && $method_price > 0 ){
				
					update_post_meta($order_data, "order_shipping", $GLOBALS['global_cart_data']['shipping']);
					update_post_meta($order_data, "order_shipping_method", $method_name);					
					update_post_meta($order_data, "order_notes", get_post_meta($order_data, "order_notes", true)." ".$method_name);
					
				}
			}
			
			
			// NEW ORDER SUB TOTAL
			$order_s = get_post_meta($order_data, "order_subtotal", true);			 
			if(is_numeric($order_s) && $order_s > 0){
			$order_subtotal = $order_s;
			$GLOBALS['global_cart_data']['subtotal'] = $order_subtotal;
			}
			
			$GLOBALS['global_cart_data']["orderid"] = "#CART-".strip_tags($obits[1]);
			 
			
		}else{
		
		 
			
			// INVOICE FOR OFFERS
			if(isset($order_type['id']) && $order_type['id'] == "OFFER"){ 			 
			
				$order_description = "";
				$offer_id = get_post_meta($order_data, "offer_id", true);
				$post_id = get_post_meta($offer_id, "post_id", true);
				$order_description = get_the_title($post_id); 
				
				$order_total = get_post_meta($order_data, "order_total", true);
				$order_userid = get_post_meta($order_data, "order_userid", true);
				//$order_subtotal = get_post_meta($order_data, "order_subtotal", true);					
				
				$order_tax = "";
				$order_shipping = "";
				$order_discount = "";
				
				
			}else{
		
		 	
			// GET DATA FROM ADMIN
			$order_total = get_post_meta($order_data, "order_total", true);
			$order_tax = get_post_meta($order_data, "order_tax", true);
			$order_shipping = get_post_meta($order_data, "order_shipping", true);
			$order_discount = get_post_meta($order_data, "order_discount", true);
			$order_id = get_post_meta($order_data, "order_id", true);
			$order_description = get_post_meta($order_data, "order_description", true);
			$order_email = get_post_meta($order_data, "order_email", true);
			
			
			}
			 
			if(!is_numeric($order_tax)){ $order_tax = 0; }
			if(!is_numeric($order_shipping)){ $order_shipping = 0; }
			if(!is_numeric($order_discount)){ $order_discount = 0; }
			if(!is_numeric($order_total)){ $order_total = 0; }
			
			 
			$order_subtotal = $order_total - $order_shipping - $order_discount - $order_tax;
			
			// NEW ORDER SUB TOTAL
			$order_s = get_post_meta($order_data, "order_subtotal", true);			 
			if(is_numeric($order_s) && $order_s > 0){
			$order_subtotal = $order_s;
			}	
			
			 switch(THEME_KEY){
	  
				  case "at": {
				   
				  // GET SHIPPING OST
				   $price_shipping = get_post_meta($order_data,'price_shipping',true);
				     
				   if(is_numeric($price_shipping) && $price_shipping > 0){				  
				   
					update_post_meta($order_data, "order_shipping",  $price_shipping);					 
					
				   }
				   
				  
				  } break;
			  
			  }
			  
			  
			if($order_description == "" && THEME_KEY == "mj"){
			
				$h = explode("-",$order_id);
				if(isset($h[1])){			
				$order_description = get_the_title($h[1]);			
				}
			}
			 
			 
		 
		 $GLOBALS['global_cart_data'] = array(
				 
				"userid" => $order_userid,
				"total_items" => 1,
				"total" => $order_total,
				"subtotal" => $order_subtotal,
				"qty" => "1",
				"tax" => $order_tax,
				
				"weight_class" => 0,
				"weight" => 0,
				"tokens" => 0,
				"shipping" => $order_shipping,
				"shipping_method" => $order_shipping_method,
				"comments" => "",
				"orderid" => $order_id,
				"discount" => 0,
				"discount_code" => 0,
				
				"items" => array(
						
						1 => array(
							
							1 => array(
							"innerID" => 1,
                            "name" => $order_description,
                            "link" => "", 
                            "amount" => $order_total,
                            "image" => "", 
							"qty" => "1",
							"comments" => "",
							),
						),
					
					),
					
				  );
				  
				  // FLAT RATE TAX 
				if($order_tax == "0" && _ppt('basic_tax_flatrate') == 1){
				
					// SHIPPING FLAT RATE
					if( is_numeric(_ppt(array('basic_tax','flatrate'))) ){ 
						$tax = _ppt(array('basic_tax','flatrate')); 
					}
							
					// SHIPPING FLAT PERCENTAGE
					if( is_numeric(_ppt(array('basic_tax','flatrate_percent')))  ){ 
						$tax += (  $order_total * _ppt(array('basic_tax','flatrate_percent')) / 100 );
					}
					
					$order_tax = $tax;
					$GLOBALS['global_cart_data']['tax']= $tax;
					update_post_meta($order_data, "order_tax", $tax);
						
				}
				if($order_shipping > 0 && $order_s == ""){
				$order_total = $order_total - $order_shipping;
				$GLOBALS['global_cart_data']['subtotal'] =  $order_total;	
				} 
		
		
		}
		/////////////////////////////////
		
 		$h = $CORE->ORDER("get_status", $order_status); 
		 
		$GLOBALS['global_cart_data']['status'] 		=  $h['name'];
		$GLOBALS['global_cart_data']['status_key'] 	=  $order_status; 
 	
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
		if(isset($order_type['id']) && $order_type['id'] == "OFFER"){ 
		
			$buyerid = get_post_meta($_GET['invoiceid'], "buyer_id", true); 
			$sellerid = get_post_meta($_GET['invoiceid'], "seller_id", true); 
			
			$GLOBALS['global_cart_data']["bill_name"] = $CORE->USER("get_name", $buyerid);
			$GLOBALS['global_cart_data']["bill_email"] = $CORE->USER("get_email", $buyerid);
			$GLOBALS['global_cart_data']["bill_phone"] = $CORE->USER("get_phone", $buyerid);
			$GLOBALS['global_cart_data']["bill_address"] = $CORE->USER("get_address", $buyerid);
				
			$GLOBALS['global_cart_data']["company_name"] = $CORE->USER("get_name", $sellerid);
			$GLOBALS['global_cart_data']["company_email"] = $CORE->USER("get_email", $sellerid);
			$GLOBALS['global_cart_data']["company_phone"] = $CORE->USER("get_phone", $sellerid);
			$GLOBALS['global_cart_data']["company_address"] = $CORE->USER("get_address", $sellerid);
		
		
		}else{
		
			$GLOBALS['global_cart_data']["bill_name"] = $CORE->USER("get_name", $order_userid);
			$GLOBALS['global_cart_data']["bill_email"] = $CORE->USER("get_email", $order_userid);
			$GLOBALS['global_cart_data']["bill_phone"] = $CORE->USER("get_phone", $order_userid);
			$GLOBALS['global_cart_data']["bill_address"] = $CORE->USER("get_address", $order_userid);
				
			$GLOBALS['global_cart_data']["company_name"] = _ppt(array('company','name'));
			$GLOBALS['global_cart_data']["company_email"] = _ppt(array('company','email'));
			$GLOBALS['global_cart_data']["company_phone"] = _ppt(array('company','phone'));
			$GLOBALS['global_cart_data']["company_address"] = _ppt(array('company','address')); 
			
			if(isset($order_type['id']) && $order_type['id'] == "ESCROW"){ 				
			$GLOBALS['global_cart_data']["invoice_title"] = __("Escrow Deposit","premiumpress"); 		
			}
		
		}
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
	 
                 
		$GLOBALS['global_cart_data']["date"] = $order_post_data->post_date;
		
		$order_total = get_post_meta($order_data, "order_total", true);
		$GLOBALS['global_cart_data']['total'] =  $order_total;
		
		$order_shipping = get_post_meta($order_data, "order_shipping", true);	
		$GLOBALS['global_cart_data']['shipping'] =  $order_shipping;
		
		$order_tax = get_post_meta($order_data, "order_tax", true);
		$GLOBALS['global_cart_data']['tax'] =  $order_tax;
		
		$order_discount = get_post_meta($order_data, "order_discount", true);
		$GLOBALS['global_cart_data']['discount'] =  $order_discount;
		
		if(!isset($GLOBALS['global_cart_data']['subtotal'])){
		$GLOBALS['global_cart_data']['subtotal'] =  $order_total;
		}
		 
		$order_shipping_method = get_post_meta($order_data, "order_shipping_method", true);
		$GLOBALS['global_cart_data']['shipping_method'] =  $order_shipping_method;
	  
		if(isset($GLOBALS['dataonly'])){
		return $GLOBALS['global_cart_data']; 
		}
		
		ob_start();
		?>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th><?php echo __("Item","premiumpress"); ?></th>
 

<th class="right"><?php echo __("Unit Cost","premiumpress"); ?></th>
  <th class="center"><?php echo __("Qty","premiumpress"); ?></th>
<th class="right"><?php echo __("Total","premiumpress"); ?></th>
</tr>
</thead>
<tbody>
<?php 
if(isset($GLOBALS['global_cart_data']['items'])){
foreach($GLOBALS['global_cart_data']['items'] as $key => $inner_item){  

	foreach($inner_item as $innerkey => $item){ 
	 

?>
          
<tr>
<td class="center"><?php echo $innerkey; ?></td>
<td class="left strong">

<?php 

if(!isset($order_id)){ $order_id =0 ; }

$order_type = $CORE->ORDER("get_type", $order_id);
if(!empty($order_type) && isset($order_type['id'])){

	switch($order_type['id']){
	
		case "MJ": {
		
		$obits = explode("-", $order_id);
		
		$pid = $obits[1];
		
		 
		$og = $CORE->USER("check_offer_exists_by_orderid", $order_data);
		 
		
		?>
        <div style="line-height:30px;">
        <div style="font-weight:bold;"> <?php echo get_the_title($pid); ?> </div>
        <?php if(is_numeric($og) && $og > 0){ 
		
		$gt = get_post_meta($og,'gig_type',true);
		?>
        <div style="font-size:14px;"><?php echo __("Type","premiumpress"); ?>: 
            <?php if($gt == "3"){ echo __("Premium","premiumpress"); }elseif($gt == "2"){ echo __("Standard","premiumpress");  }else{ echo __("Basic","premiumpress"); } ?>
        
        </div>
        
        <div style="font-size:14px;"><?php echo __("Addon","premiumpress"); ?>: 
        
		
		<?php  if(get_post_meta($og,'gig_addon',true) != "" && is_numeric(get_post_meta($og,'gig_addon',true)) ){ 
			   
			   $addonid = get_post_meta($og,'gig_addon',true); 
			   
			   echo $addonid."<--";
			    
			   	$current_data = get_post_meta($pid, 'customextras', true); 
				if(is_array($current_data) && !empty($current_data) && $current_data['name'][0] != "" ){ 
					$i=0; 				 
					foreach($current_data['name'] as $key => $data){ 
					if($current_data['name'][$i] !="" && is_numeric($current_data['price'][$i]) ){						
							
							if($i == $addonid){							
							echo $current_data['name'][$i] ." - ".hook_price($current_data['price'][$i]); 
													
							}  
						}						
						$i++; 
						}
					}
			   
			   
			   }else{ echo __("None","premiumpress"); } ?>
               
               </div>
               <?php } ?>
        </div>
        <?php
		
		} break;
		default: {
		
		echo $item['name']; 
		
		} break;
	}

}else{
	
	echo $item['name']; 

}


?>



 
        <?php
		
		if(isset($item['custom_data']) && is_array($item['custom_data']) ){
		?>
        <ul class="list-inline">
        <?php
		  
		foreach($item['custom_data'] as $f){ ?>
        
        <li class="list-inline-item small">
        <?php 
		
		switch($f['key']){
			
			default: {
			?>
            <?php echo $CORE->GEO("translation_tax_key", $f['key']); ?>: <?php echo $f['text']; ?>  
            <?php			
			} break;		
		}
		 
		?>        
        </li>
        
        
        <?php	
		}
		?>
        </ul>
        <?php 
		}		
		 
		?>
        
        
        <?php if(get_post_meta($key, "download_path", true) != ""){ 
		
			 
			// DOWNLOAD ARRSY
			$data_array = array(
			"uid" 		=> $userdata->ID,
			"pid" 		=> $key,
			);
		
		?>
        
    
    <form method="post" action="" class="mt-3">
    <input type="hidden" name="data" value="<?php echo base64_encode( json_encode( $data_array ) ); ?>" />
    <input type="hidden" name="downloadproduct" value="1" />
    <button type='submit' class='btn btn-primary'><i class="fal mr-2 fa-download"></i> <?php echo __("Download File","premiumpress"); ?></button>
    </form>
        <?php } ?>

</td>
 

<td class="right"><?php echo hook_price($item['amount']); ?></td>
  <td class="center"><?php echo $item['qty']; ?></td>
<td class="right"><?php echo hook_price($item['amount']*$item['qty']); ?></td>
</tr>

<?php } } } ?>
 

 

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong><?php echo __("Subtotal","premiumpress"); ?></strong>
</td>
<td class="right"><?php if(isset($GLOBALS['global_cart_data']['subtotal'])){ echo hook_price($GLOBALS['global_cart_data']['subtotal']); }else{ echo hook_price($GLOBALS['global_cart_data']['total']);; } ?></td>
</tr>
<tr>
<?php if(is_numeric($GLOBALS['global_cart_data']['discount']) && $GLOBALS['global_cart_data']['discount'] > 0 ){ ?>
<td class="left">
<strong><?php echo __("Discount","premiumpress"); ?></strong>
</td>
<td class="right"><?php echo hook_price($GLOBALS['global_cart_data']['discount']); ?></td>
</tr>
<tr>
<?php } ?>
<?php if(is_numeric($GLOBALS['global_cart_data']['tax']) && $GLOBALS['global_cart_data']['tax'] > 0 ){ ?>
<td class="left">
 <strong><?php echo __("Tax","premiumpress"); ?></strong>
</td>
<td class="right"><?php echo hook_price($GLOBALS['global_cart_data']['tax']); ?></td>
</tr>
<tr>
<?php } ?>
<?php if(is_numeric($GLOBALS['global_cart_data']['shipping']) && $GLOBALS['global_cart_data']['shipping'] > 0 ){ ?>
<td class="left">
 <strong><?php echo __("Shipping","premiumpress"); ?></strong>
</td>
<td class="right"><?php echo hook_price($GLOBALS['global_cart_data']['shipping']); ?></td>
</tr>
<tr>
<?php } ?>
<td class="left">
<strong><?php echo __("Total","premiumpress"); ?></strong>
</td>
<td class="right">
<strong><?php echo hook_price($GLOBALS['global_cart_data']['total']); ?></strong>
</td>
</tr>
</tbody>
</table>
 

</div>
        <?php
		return ob_get_clean();
		
		} break;
	
		
	} // end switch

}


  
function order_encode($order_id){
 
return base64_encode(json_encode($order_id));

}

function order_decode($order_id){
 
return json_decode(base64_decode($order_id));

}

function order_get_orderid($autoid = "", $oid = ""){ 
	
	return str_pad($autoid, 6, "0", STR_PAD_LEFT);
	
}
  
  
  
  
  
  
  
  
  
  
  
  
 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
function payment_setup($data, $smallform = 0){ global $CORE, $userdata; $STRING = "";
	  
	  	// SMALL FORM COL WIDTHS
		if($smallform == 1){ 
		$col1 = 'col-12'; $col2 = "col-12"; 
		
		}else{ $col1 = 'col-xl-7 mb-3 mb-xl-0';  $col2 = "col-xl-4 offset-xl-1";  
		}
	  
		// DECODE DATA
		$data = $CORE->order_decode($data);
	 	 	   
		// MAKE SURE HERE IS AN ORDER ID
		if(!isset($data->order_id)){
		die("no payment data");
		}	 	
		
		 
		// CHECK FOR TOKEN PAYMENT
		if(isset($data->tokens) && is_numeric($data->tokens) && $data->tokens > 0){				
			$STRING .= $this->payment_via_tokens($data->order_id, $data->tokens , $data->description);	
		} 
		 
	 	
		$data->amount = str_replace(",",".",$data->amount);
		
		$GLOBALS['orderid'] 	= $data->order_id;	
		$GLOBALS['total'] 		= $data->amount;
		$GLOBALS['description'] = $data->description;
		$GLOBALS['subtotal'] 	= 0;
		$GLOBALS['shipping'] 	= 0;
		$GLOBALS['tax'] 		= 0;
		$GLOBALS['weight'] 		= 0; 
		$GLOBALS['discount'] 	= 0;
		$GLOBALS['items'] 		= "";	
		 
		
		// FLAT RATE TAX 
		if(_ppt('basic_tax_flatrate') == 1){
		
			// SHIPPING FLAT RATE
			if( is_numeric(_ppt(array('basic_tax','flatrate'))) ){ 
				$GLOBALS['tax'] += _ppt(array('basic_tax','flatrate')); 
			}
					
			// SHIPPING FLAT PERCENTAGE
			if( is_numeric(_ppt(array('basic_tax','flatrate_percent')))  ){ 
				$GLOBALS['tax'] += (  $GLOBALS['total'] * _ppt(array('basic_tax','flatrate_percent')) /100);
			}
			
			$GLOBALS['tax'] = round($GLOBALS['tax'],2);
		}
		
		// COUNTRY TAX
		$delivery_country 	= get_user_meta($userdata->ID, 'country', true);
		$delivery_state 	= get_user_meta($userdata->ID, 'city', true);
		 
		if(THEME_KEY != "sp" && _ppt('basic_country_tax_tax') == 1 && $delivery_country != "" ){		
		 
			$regions = _ppt('regions');	$taxSet = 0;	
			if(is_array($regions)){ 
				$i=0; 
				while($i < count($regions['name']) ){
					if($regions['name'][$i] !=""){	
					
						
						if( (!empty($regions['country'][$i]) && in_array($delivery_country, $regions['country'][$i]) ) 
						|| (!empty($regions['state'][$i]) && in_array($delivery_state, $regions['state'][$i]) ) ) { // COUNTRY OR STATE CHECKOUT	
						
					 
							// FLAT RATE 
							if( is_numeric( _ppt(array('tax_country','price_'.$regions['key'][$i])) ) && !$taxSet ){ 
								$GLOBALS['tax'] += _ppt(array('tax_country','price_'.$regions['key'][$i])); 
								$taxSet = 1;
							}
									
							// FLAT PERCENTAGE
							if( is_numeric( _ppt(array('tax_country','percentage_'.$regions['key'][$i])) ) && !$taxSet  ){ 		 
								$GLOBALS['tax'] += ( $GLOBALS['total'] * _ppt(array('tax_country','percentage_'.$regions['key'][$i])) /100);
								$taxSet = 1;
							}					
						
						}
												
					}
				$i++;
				} 
			}
		}
		
		
		// DISABLE TAX FOR SOME ELEMENTS
		if(isset($data->tax) && $data->tax == 0){
		$GLOBALS['tax'] = 0;
		}
		 
		if(THEME_KEY != "sp" && $GLOBALS['tax'] > 0 && !isset($data->tax_added)){
		$GLOBALS['total'] += $GLOBALS['tax'];
		//$GLOBALS['tax'] = 0;
		}
	 	
		
		// FORM SIZES		 
		if(isset($data->formsize)){		 
		$col1 = 'col-12'; $col2 = "col-12";
		}
		
		  
		//if(!is_numeric($data->amount)){ $data->amount = 0; }
		if($data->amount < 0){ $data->amount = 0; }		
		
		
		if(_ppt(array('coupons','enable')) == 1 && isset($data->couponcode) && strlen($data->couponcode) > 1 ){
		 
			// COUPON CODES 
			$ppt_coupons = get_option("ppt_coupons");
			// CHECK WE HAVE SUCH A CODE
			if(is_array($ppt_coupons) && count($ppt_coupons) > 0 ){
				foreach($ppt_coupons as $key=>$field){
					if($data->couponcode == $field['code']){
					
							// WORK OUT DISCOUNT AMOUNT
							$discount = $field['discount_percentage']; 
							 
							if(is_numeric($discount) ){
							
								$GLOBALS['CODECODES_DISCOUNT'] = $data->amount/100*$discount;
								
								//die("Total: ".$GLOBALS['total']." <br> Discount: ".$discount."<br> Saved Discount: ".$GLOBALS['CODECODES_DISCOUNT']);
								
								 
							}elseif(is_numeric($field['discount_fixed'])){
								$GLOBALS['CODECODES_DISCOUNT'] = $field['discount_fixed']; 
							}
							
							if(defined('WLT_CART') ){
							global $CORE_CART; 
						 
							add_action('hook_cart_data', array( $CORE_CART, 'CODECODES_APPLYCART') );
							
							} 
					}
				}
			}
			
			if(isset($GLOBALS['CODECODES_DISCOUNT']) && $GLOBALS['CODECODES_DISCOUNT'] > 0){
				$GLOBALS['total'] =  $data->amount; // - $GLOBALS['CODECODES_DISCOUNT'];
				//echo $GLOBALS['total']."<--".$data->amount."--".$GLOBALS['CODECODES_DISCOUNT'];
			} 
			
			$STRING .= ' <script>jQuery("#ppdiscountlist").show();jQuery("#ppdiscount").html("'.hook_price($GLOBALS['CODECODES_DISCOUNT']).'");jQuery("#ppprice").html("'.hook_price($data->amount).'");</script>';
			 
		}
			
		// CLEAN UP TOTAL
		$GLOBALS['total'] = round($GLOBALS['total'],2);	
		
		
		$GLOBALS['payment_data'] = $data;
		
		ob_start();
		_ppt_template( 'ajax/ajax-modal-payment' ); 
		$STRING .= ob_get_clean();
		
		// RETURN GATEWAY INFORMATION
		return $STRING;
	}
	 
	
 
	
	
/* =============================================================================
ORDER PROCESSING
========================================================================== */

  
/*
	this function handles differeny changes
	based on the order ID prefix
*/

function _hook_v9_order_process($data){ global $wpdb, $CORE, $userdata;
 
 
 	// ADD POPUP
	if($userdata->ID){
	$CORE->ADVERTISING("popup_new", array("upgrade", $userdata->ID ));
 	}
 	
	if(isset($data['order_id'])){
	
		if(substr($data['order_id'],0,4) == "GIFT"){ //"GIFT-".$uid."-".$pid."-".$userdata->ID."-".$i."-".rand(0,1000000);
		
			// BREAK DOWN THE ORDER ID
	   	 	$obits = explode("-", $data['order_id']);
			
			// 0 excrow
			// 1 = user id
			// 2 = post id
			// 3 = paying uid
			// 4 = gift id
			// rand
			
			 
		$my_post = array();
		$my_post['post_title'] 		= "conversation";
		$my_post['post_content'] 	= "";
		$my_post['post_excerpt'] 	= "";
		$my_post['post_status'] 	= "publish";
		$my_post['post_type'] 		= "ppt_message";
		$my_post['post_author'] 	= $userdata->ID;
		$POSTID 					= wp_insert_post( $my_post );								
				
		add_post_meta($POSTID, "reciever_id", $obits[1]);
		add_post_meta($POSTID, "sender_id", $obits[3]); 
		add_post_meta($POSTID, "msg_status", "unread_".$obits[1]); 
		add_post_meta($POSTID, "msg_status", "unread_".$obits[3]);
		add_post_meta($POSTID, "msg_stick", "[".$obits[1]."][".$obits[3]."]");
		add_post_meta($POSTID, "gift", $obits[4]); 
		
		// UPDATE USER ACCOUNT GIFTS ARRSY
		$CORE->USER("update_gifts", array($obits[1], $obits[3], $obits[4]));
		
		// ADD LOG
		$CORE->FUNC("add_log",
			array(				 
				"type" 		=> "da_gift",
				"to" 		=> $obits[1],
				"from" 		=> $obits[3], 
			)
		);
		
			
	
		}elseif(substr($data['order_id'],0,6) == "ESCROW"){ 
		
		/*
			ESCROW PAYMENTS ARE FOR EXISTING INVOICES
			SO WE GET THE INVOICE ID
			AND THEN GET THE DATA FROM THERE
		*/
		 

			// BREAK DOWN THE ORDER ID
	   	 	$obits = explode("-", $data['order_id']);
			 
			
			// 0 excrow
			// 1 = payment id
			// 2 = offer id
			// 3 = post id for orginal item
		  	
			$ordercheck = $CORE->ORDER("get_order", $obits[1]);	
			
			 //die(print_r($ordercheck).print_r($data).print_r($obits));
			 
			 
			 // FOR ALL NEW 'BUY NOW' OFFERS THE ORDER IS ONLY ADDED
			 // DURING PAYMENT, SO WE GET THE ID NOW
			 if(!is_numeric($obits[1]) && isset($ordercheck['ID']) && is_numeric($ordercheck['ID'])){
			 
			 $obits[1] = $ordercheck['ID'];
			 
			}
			
			
			
			// ADD LOG
			$post_author_id = $CORE->USER("get_userid_from_postid",$obits['3']);
			$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "offer_updated",									
								"postid"	=> $obits[3],								
								"to" 		=> $ordercheck['order_userid'], 						
								"from" 		=> $post_author_id,									
								"extra" 	=> $obits[2],															
								"alert_uid1" 	=>  $post_author_id, 
								 
							)
			); 
			
			 	
			if( is_array($ordercheck) && !empty($ordercheck) && isset($obits[1]) && isset($obits[2]) ){ 
			  
			  
				//	1. SET INVOICE HAS PAID
				if(is_numeric($obits[1])){
				update_post_meta($obits[1],'payment_complete', date('Y-m-d H:i:s') );
				update_post_meta($obits[1],'invoice_status', 5);
				update_post_meta($obits[1],'order_status', 1);
				}
				
				// 2. SET OFFER AS PAID
				update_post_meta($obits[2],'payment_complete', date('Y-m-d H:i:s') );				 	
				update_post_meta($obits[2], "order_id", $obits[1]);	
				update_post_meta($obits[2], "offer_complete", 2);
						 
				
				// 3. SET THE ORGINAL INVOICE AS PAID
				$oo = explode("-", $ordercheck['order_id']);
			 	
				update_post_meta($oo[1],'payment_complete', date('Y-m-d H:i:s') );
				update_post_meta($oo[1],'invoice_status', 5);
				update_post_meta($oo[1],'order_status', 1);
				
				// NOW UPDATE THE ORGINAL OFFER WITH A PAID ORDER ID
				add_post_meta($oo[1], "order_id", $obits[1]);
				add_post_meta($oo[1], "escrow_id", $data['ID']); // ???
			 
			
			}elseif( !is_array($ordercheck)  && isset($obits[2]) ){
				
				// 2. SET OFFER AS PAID
				update_post_meta($obits[2],'payment_complete', date('Y-m-d H:i:s') );				 	
				update_post_meta($obits[2], "order_id", $obits[1]);	
				update_post_meta($obits[2], "offer_complete", 2);
				
			}
	 
	 		if(isset($obits[3]) && is_numeric($obits[3])){
			
				// UPDATE ORDER WITH DATA
				update_post_meta($data['ID'], "order_postid", $obits[3]);
			
			}
			
			// SET THE OFFER TO FINISHED IF ADMIN ONLY
			if(_ppt(array('lst','adminonly')) == "1" && isset($obits[2]) ){			
				update_post_meta($obits[2], "offer_status", 3);
				 update_post_meta($obits[2], "offer_complete", 5);
			}
		
				
			
 
		}elseif(substr($data['order_id'],0,2) == "MJ"){ 
		 
			/*
			Array
			(
				[0] =&gt; MJ <-- MICRO JOBS
				[1] =&gt; 991 <-- POST ID
				[2] =&gt; 1 <-- USERID
				[3] =&gt; 2 <-- STANDARD OR PREMIUM
				[4] =&gt; 50 <-- ADDON ID
			)		
			*/
			// BREAK DOWN THE ORDER ID
	   	 	$obits = explode("-", $data['order_id']);
		 
			$order_key_id = $this->ORDER("check_exists", $data['order_id']);
			 		
			if( is_numeric($order_key_id) ){
				
				
				// CHECK OFFER HASNT ALREADY BEEN ADDED
				$og = $CORE->USER("check_offer_exists_by_orderid", $order_key_id);
				 
				if($og  == 0){
						 	
					$ordercheck = $CORE->ORDER("get_order", $order_key_id);			 
					
					// ADD A NEW OFFER TO THE SYTEM
					$my_post = array();
					$my_post['post_title'] 		= "New Job - ".$obits[2]."-".$obits[1];
					$my_post['post_content'] 	= "";
					$my_post['post_excerpt'] 	= "";
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "ppt_offer";
					$my_post['post_author'] 	= 1;
					$POSTID 					= wp_insert_post( $my_post );
					
					// STORE ORDER ID
					add_post_meta($POSTID, "order_id", $order_key_id);
							
					// STORE POST ID
					add_post_meta($POSTID, "post_id", $obits[1]);
							 
					// SAVE THE BUYERS ID
					add_post_meta($POSTID, "buyer_id", $obits[2]); 
							
					// SAVE THE BUYERS ID
					$author_id = get_post_field ('post_author', $obits[1]);
					add_post_meta($POSTID, "seller_id", $author_id); 
							
					// ADD STATUS
					add_post_meta($POSTID, "price", $ordercheck['order_total']);			
							
					// ADD STATUS
					add_post_meta($POSTID, "offer_status", 1);
					
					// PREMIUMD OR STANDARD
					add_post_meta($POSTID, "gig_type", $obits[3]);
					add_post_meta($POSTID, "gig_addon", $obits[4]);
					
					
					// ADD LOG
					$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "offer_new",	
																
							"postid"	=> $obits[1],
							
							"extra" 	=> $POSTID,
							"extra2" 	=> $order_key_id,
									
							"to" 		=> get_post_field( 'post_author', $obits[1] ), 						
							"from" 		=> $obits[2],
									
							"alert_uid1" 	=>  get_post_field( 'post_author', $obits[1] ),	
									 
						)
					);			
			}
		 
	
		} // end check exists	 
 		
		
		// LISTING UPGRADES
		}elseif(substr($data['order_id'],0,7) == "PAYWALL"){
		
				// BREAK DOWN ID
				$ob = explode("-",$data['order_id']); 
				
				// GET USER STTATUS
				$accounttype = $CORE->USER("get_account_type", $ob[1]);
				if(!isset($accounttype['key']) ){
				$accounttype['key'] = "subscriber";
				}
				
				// DAYS
				$days = _ppt(array('paywall_'.$accounttype['key'], 'duration'));
				if(!is_numeric($days)){
				$days = 10;
				}
				
				// CHECK FOR EXISTING
				$ff = get_user_meta($ob[1],'ppt_paywall', true);
				if(is_array($ff) && !empty($ff) ){
				
					$da = $CORE->date_timediff($ff['date_expires'],'');
            		if($da['expired'] == 0 && isset($da['raw']['days']) ){
						 
						 $days += $da['raw']['days'];
						
					} 
					
					$expires = date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$days." days"));
					
					// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
					update_user_meta($ob[1],'ppt_paywall', 
						array( 
							"date_start" 	=> date("Y-m-d-H:i:s"), 
							"date_expires" 	=> $expires,	
							"approved" 		=> 1,				
						)
					);
				
				
				}else{
		
					// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
					update_user_meta($ob[1],'ppt_paywall', 
						array( 
							"date_start" 	=> date("Y-m-d-H:i:s"), 
							"date_expires" 	=> date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$days." days")),	
							"approved" 		=> 1,				
						)
					);
					
				}
		 	
		
		// LISTING UPGRADES
		}elseif(substr($data['order_id'],0,7) == "UPGRADE"){				 
			
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			  	
			// UPGRADE PACKAGE ADDONS PAYMENT
			if(isset($ob[2]) && $ob[2] != "combined"){
				
				$CORE->PACKAGE("package_process_upgrade", array( $ob[2], $ob[1] ) );			
			
			}
			
			
			// 2. CHECK IF THERE IS AN EXISTING ORDER FOR THIS
			$ex = $CORE->ORDER("check_exists", $data['order_id']);	
			 							 
			if( is_numeric($ex) && strlen($ex) > 1 ){						
				// NOW LETS UPDATE THE ORDER STATUS
				update_post_meta($ex, "order_status", 1);				
				update_post_meta($ex,'order_paid',date("Y-m-d-H:i:s"));	
				
				// ADD ON PACKAGE ID FOR SALES HISTORY
				$pakid = get_post_meta($ob[1], "packageID", true);
				update_post_meta($ex, "order_post_packageid", $pakid);
				
			}
			 
			// UPDATE PACKAGE EXPIRY DATE
			// INCASE USER HAS DELAY BEFORE PAYING	
			if(isset($ob[2]) && in_array($ob[2], array("featured","sponsored","homepage"))){ //,"combined"
				
				// DO NOTHING
				 
				
			
			}else{ 
				
				$default_days = get_post_meta($ob[1],'default_expiry_days',true);
				if(is_numeric($default_days) && $default_days > 0){				
				
						$tnow = date("Y-m-d H:i:s"); 				
						$newdate = date("Y-m-d H:i:s", strtotime( $tnow . " +".$default_days." days"));				 
						update_post_meta($ob[1], 'listing_expiry_date', $newdate );
						
				}else{	
				
				
					$pak = get_post_meta($ob[1],'packageID',true);			
					if(strlen($pak) > 0){			
						$tnow = date("Y-m-d H:i:s"); 				
						$newdate = date("Y-m-d H:i:s", strtotime( $tnow . " +"._ppt('pak'.$pak.'_duration')." days"));				 
						update_post_meta($ob[1], 'listing_expiry_date', $newdate );
					}
				
				}
			
			}			 
			
			// SET STATUS TO LIVE
			$my_post = array();
			$my_post['ID'] 					= $ob[1];
			$my_post['post_status']			= "publish";
			wp_update_post( $my_post  );
	 
		}elseif( substr($data['order_id'] ,0 ,3) == "LST"){		
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);		
			
			
			// CHECK FOR PAYMENT DUE
			$paymentDue = get_post_meta($ob[1],'totaldue',true);
			update_post_meta($ob[1],'totaldue',0);
			
			if($paymentDue > 0){
				
				// CHECK FOR ADDONS FIRST
				// IF THERE IS A TIMER ALREADY, THEN IT'S A PREVIOUS ADDON
				$addons = $CORE->PACKAGE("get_packages_addons", array() );
				if(!empty($addons )){
					foreach($addons as $a){
					
						if($a['key'] == "addon_boost"){ continue; }
						
						if( _ppt(array('lst', $a['key'].'_enable')) == '1' && get_post_meta($ob[1], str_replace("addon_","",$a['key']), true) == 1 && get_post_meta($ob[1], str_replace("addon_","",$a['key'])."_expires", true) == "" ){
							
							$days = _ppt(array('lst', $a['key'].'_days'));
							
							if($days == 0){ // UNLIMITED TIME
								$add_expires = 0;
							}else{
								$add_expires = date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +".$days." days"));
							} 
							
							update_post_meta($ob[1], str_replace("addon_","",$a['key'])."_expires", $add_expires); 
						
						}
					}				
				}			
			}
			
			// UPDATE PACKAGE EXPIRY DATE
			// INCASE USER HAS DELAY BEFORE PAYING	
			
			if(THEME_KEY == "at"){
			
			
			}else{
			
				$pak = get_post_meta($ob[1],'packageID',true);
				if($pak > -1 && is_numeric(_ppt('pak'.$pak.'_duration')) ){	
									 
					update_post_meta($ob[1], 'listing_expiry_date',  date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +"._ppt('pak'.$pak.'_duration')." days"))  );
				
				}else{
				
					update_post_meta($ob[1], 'listing_expiry_date',  date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +1 year"))  );
				}
			
			}
			 
			 
			// 2. CHECK IF THERE IS AN EXISTING ORDER FOR THIS
			$ex = $CORE->ORDER("check_exists", $data['order_id'] );									 
			if( is_numeric($ex) && strlen($ex) > 1 ){						
				// NOW LETS UPDATE THE ORDER STATUS
				update_post_meta($ex, "order_status", 1);				
				update_post_meta($ex,'order_paid',date("Y-m-d-H:i:s"));	
			}
			
			
			// SET STATUS TO LIVE
			$my_post = array();
			$my_post['ID'] 					= $ob[1];
			$my_post['post_status']			= "publish";
			wp_update_post( $my_post  );
			
			
		
			
			 	
			
		}elseif(substr($data['order_id'],0,6) == "CREDIT"){
		 	
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			 		
			
			// ADD ON CREDIT
			
			//die(print_r($ob)."--"._ppt(array('credit', $ob[3] .'b')).print_r($data));
			
			if( $ob[2] == "NEW"){			
			
				$c = get_user_meta($ob[1],'ppt_usercredit', true);
				
				if(!is_numeric($c)){
				$c = 0;
				}
				
				$v = _ppt(array('credit', $ob[3] .'b'));
				if(!is_numeric($v)){
				$v = 0;
				}
				
				$c1  = $c + $v;
				
				update_user_meta($ob[1],'ppt_usercredit', $c1);	
			
			
			}elseif( is_numeric($ob[1]) && $ob[1] > 0 && !in_array(THEME_KEY, array("mj","at"))  ){		
						
					$c = get_user_meta($data['user_id'],'ppt_usercredit', true);
					$c1  = number_format((float)$c, 2, '.', '')  + number_format((float)$data['order_total'], 2, '.', '');
					update_user_meta($data['user_id'],'ppt_usercredit', $c1);						
			}			
			 
		 
		// TOKEN PAYMENT
		}elseif(substr($data['order_id'],0,5) == "TOKEN"){
		 
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);	
		 	 
			// ADD ON TOKENS
			if( is_numeric($ob[1]) && $ob[1] > 0){	
			 
						$c = get_user_meta($data['user_id'],'ppt_usertokens', true);
						$c1  = $c + $CORE->credit_exchangerate($data['order_total'], "token");
						update_user_meta($data['user_id'],'ppt_usertokens', $c1);
			}
			
		
		
		}elseif(substr($data['order_id'],0,5) == "RENEW"){	
		
		 	// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			if( is_numeric($ob[1]) && $ob[1] > 0){
			
				$POSTID = $ob[1];
				
				// GET RENEW DATA
				$relist = $CORE->relist_price($POSTID); 
				
				// UPDATE TIMER	
				if($relist['days'] == "0.5"){
						
					update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +30 minutes") ) );
						
				}elseif($relist['days'] == "0.1"){
						
					update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +1 hour") ) );
							
				}else{
						  
					update_post_meta($POSTID, 'listing_expiry_date', date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$relist['days']." days")) );		
				
				}
				
				// UPDATE ADD-ONS
				if(is_array($relist['pak_addons']) && !empty($relist['pak_addons'])){
					foreach($relist['pak_addons'] as $ak => $addon){
						if($addon == 1){
							update_post_meta($POSTID, str_replace("addon_","",$ak), "1");
						}else{
							delete_post_meta($POSTID, str_replace("addon_","",$ak) );
						}
					}				
				}
				
				// UPDATE ORDER WITH PSOT ID
				$ex = $CORE->ORDER("check_exists", $data['order_id']);
				if(strlen($ex) > 1){
					update_post_meta($ex,'order_postid', $POSTID );
				}
				 
				// SET STATUS TO LIVE
				$my_post = array();
				$my_post['ID'] 					= $POSTID;
				$my_post['post_status']			= "publish";
				wp_update_post( $my_post  );
				
				
				// EXTRAS
				if(THEME_KEY == "at"){
								
					// RESET BID STRINGS
					update_post_meta($POSTID,	'bidstring', '');				
					update_post_meta($POSTID,	'user_maxbid_data', '');								
					update_post_meta($POSTID,	'relisted', current_time( 'mysql' ) );	
					update_post_meta($POSTID,	'status', '0');					  
				}	
				 
			
			}
		
		}elseif(substr($data['order_id'],0,7) == "INVOICE"){	
			
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']); 
		 	 
			if( is_numeric($ob[2]) && $ob[2] > 0){
			
			update_post_meta($ob[2],'payment_complete', date('Y-m-d H:i:s') );
			update_post_meta($ob[2],'invoice_status', 5);
			
			
			} 
			
		
 	 	}elseif(substr($data['order_id'],0,5) == "BOOST"){
		
		 	
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			$hours = _ppt(array('lst','addon_boost_days')); 
			if(!is_numeric($hours)){
			$hours = 24;
			}
			
			
			$boostdata = array(						
				"start" =>  date("Y-m-d H:i:s"),
				"end" 	=> date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$hours." hours")),
			);
			
			update_user_meta($ob[1], 'upgrade_boost',  $boostdata);
			  
		
		
		// CHECK IF THIS IS A SELLSPACE PAYMENT
		}elseif(substr($data['order_id'],0,3) == "BAN"){
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			// CREATE A NEW CAMPAIGN
			$my_post = array();
			$my_post['post_title'] 		= "User Campaign #".$data['order_id'];
			$my_post['post_content'] 	= "";
			$my_post['post_excerpt'] 	= "";
			$my_post['post_status'] 	= "publish";
			$my_post['post_type'] 		= "ppt_campaign";
			$my_post['post_author'] 	= $ob[2];
			$POSTID 					= wp_insert_post( $my_post );
			 
			// GET BANNER DETAILS
			$sellspacedata = _ppt('sellspace'); 
			
			add_post_meta($POSTID, 'impressions', '0');	
			add_post_meta($POSTID, 'clicks', '0'); 
			add_post_meta($POSTID, 'bannerid', '0'); 
			add_post_meta($POSTID, 'location', $ob[1]);
			add_post_meta($POSTID, 'expires', date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$sellspacedata[$ob[1]."_days"]." days")) );
			
			add_post_meta($POSTID, 'status', 'pending'); 
			
			add_post_meta($POSTID, 'userid', $ob[2]); 

			
			 
		// SUBSCRIPTION PAYMENT
		}elseif( substr($data['order_id'] ,0,4) == "SUBS"){
	
			// GETKEY
			$ff = explode("-",$data['order_id']);
			 
			// CHECK FOR NEW USER
			if($ff[2] == 0){
			$ff[2] = $data['user_id'];			
			}
			  
			// GET THE CREDITS AND TOKENS FOR THIS
			// SUBSCRIPTION AND UPDATE THE USERS ACCOUNT
			$days = _ppt($ff[1].'_duration'); //'mem'		
			if(!is_numeric($days)){
				$days = 30;								
			}
 			 
			// CHECK FOR EXISTING SUBSCRIPTION
			$f = get_user_meta($ff[2], 'ppt_subscription',true);
			if(is_array($f) && !empty($f) ){
			
				// ADD ON EXTRA TIME	
				if(in_array(_ppt(array('mem','paktime')), array("","1"))){		
					$da = $this->date_timediff($f['date_expires'],'');				 
					if($da['expired'] == 0){					
						$days += $da['date_array']['days']+($da['date_array']['months']*30);					
					}	
				}			
			} 
			
			// GET FOR FREE LISTINGS
			$c = _ppt($ff[1].'_listings_count');	 
			if(is_numeric($c)){ 			
				// CHECK IF THEY HAVE FREE LISTINGS ALREADY
				$current_free = get_user_meta($ff[2], 'free_listings_count',true);				 
				if(!is_numeric($current_free)){ $current_free = 0; }				
				$current_free = $current_free + $c;				
				update_user_meta($ff[2], 'free_listings_count', $current_free);				
			}
			
			// GET FOR FREE LISTINGS
			$c = _ppt($ff[1].'_listings_max_count');	 
			if(is_numeric($c)){ 			
				// CHECK IF THEY HAVE FREE LISTINGS ALREADY
				$current_free = get_user_meta($ff[2], 'free_listings_max_count',true);				 
				if(!is_numeric($current_free)){ $current_free = 0; }				
				$current_free = $current_free + $c;				
				update_user_meta($ff[2], 'free_listings_max_count', $current_free);				
			}
			
			// GET FOR FREE LISTINGS
			$c = _ppt($ff[1].'_max_msg_count');	 
			if(is_numeric($c)){ 			
				// CHECK IF THEY HAVE FREE LISTINGS ALREADY
				$current_free = get_user_meta($ff[2], 'max_msg_count',true);				 
				if(!is_numeric($current_free)){ $current_free = 100; }				
				$current_free = $current_free + $c;				
				update_user_meta($ff[2], 'max_msg_count', $current_free);				
			}
						
			// GET FOR FREE DOWNLOADS
			if(THEME_KEY == "so"){
				$c = _ppt($ff[1].'_downloads_count');	 
				if(is_numeric($c)){ 			
					// CHECK IF THEY HAVE FREE downloads ALREADY
					$current_free = get_user_meta($ff[2], 'free_downloads_count',true);				 
					if(!is_numeric($current_free)){ $current_free = 0; }				
					$current_free = $current_free + $c;					
					update_user_meta($ff[2], 'free_downloads_count', $current_free);				
				}
			}
		 	
			// 0 = UNLIMITED BUT WE SET A LONG EXPIRY DATE
			if($days == 0){
			$dd = date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +10 years"));			
			}else{
			$dd =  date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$days." days"));
			} 
			
			
			// CHECK FOR LAST UPDATED
			$lastupdated = get_user_meta($ff[2], "lastupdated", true);
			if($lastupdated == ""){
				$lastupdated = date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +21 minutes"));
			}
			
			// ADMIN TESTING
			if(current_user_can('administrator') ){			
			$lastupdated = date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +21 minutes"));
			}
			
			
			
			//if(strtotime($lastupdated) > strtotime(date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +20 minutes"))) ){
				
				// REQUIRED APPROVAL?
				$app = 1;
				if( _ppt($ff[1].'_approval') == '1'){
				$app = 0;
				}				
				
				// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
				update_user_meta($ff[2],'ppt_subscription', 
					array(
						"key" 			=> $ff[1] , 
						"date_start" 	=> date("Y-m-d-H:i:s"), 
						"date_expires" 	=> $dd,	
						"approved" 		=> $app,				
					)
				);
				
				update_user_meta($ff[2], "lastupdated", date("Y-m-d H:i:s") );				 
			
			//}
			
		 
			 	 
		
		}elseif( substr($data['order_id'] ,0,4) == "CART"){		
		
	 	 
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);				 
			 
			// 2. CHECK IF THERE IS AN EXISTING ORDER FOR THIS
			$ex = $CORE->ORDER("check_exists", $data['order_id']);
						 
			if(is_numeric($ex) && $ex != 0){
			
				// NOW LETS UPDATE THE ORDER STATUS
				update_post_meta($ex, "order_status", 1);
				update_post_meta($ex, "order_process", 3);				
				update_post_meta($ex,'order_paid',date("Y-m-d-H:i:s"));	
				
				if($userdata->ID){
				update_post_meta($ex, "order_userid", $userdata->ID);		
				}
			}
		 	 
			
 			if(THEME_KEY == "so"){
			 
			
			}else{
			
			// NOW GET CART DATA
			$SQL = "SELECT * FROM ".$wpdb->prefix."core_sessions WHERE session_key = ('".strip_tags($ob[1])."') LIMIT 1";
			$hassession = $wpdb->get_results($SQL, OBJECT);
		
			if(!empty($hassession)){
			 	
				// RESTORE THE CART DATA
				$cart_data = unserialize($hassession[0]->session_data); 
				 	 		 
				// NOW WE LOOP ALL ITEMS AND REMOVE THE QTY IF REQUIRED
				if(isset($cart_data['items']) && is_array($cart_data['items'])){
				 
				  
					// UPDATE SHIPPING
					//update_post_meta($ex,'order_shipping', $cart_data['shipping'] );
					//update_post_meta($ex,'order_tax', $cart_data['tax'] );
					//update_post_meta($ex,'order_discount', $cart_data['discount'] );					
					//update_post_meta($ex,'order_discount_code', $cart_data['discount_code'] );				
					//update_post_meta($ex,'order_id', $data['order_id'] );
					//update_post_meta($ex, "order_userid", $cart_data['userid']);
					//update_post_meta($ex, "order_email", $CORE->USER("get_email", $cart_data['userid']) );
										
					
					 	 
				
					// UPDATE ORDER QTY AND DATA ITEMS
					$itemslist = "";
					foreach($cart_data['items'] as $key => $item){
								foreach($item as $mainitem){
								
									$itemslist .= $key." ";								
								
									// UPDATE PURCHASE COUNTER
									$purchased = get_post_meta($key,'purchased',true);
									if($purchased == ""){ $purchased = 0; }									
									update_post_meta($key,'purchased', ( $purchased + 1 ));
									
									// UPDATE STOCK COUNT
									if(get_post_meta($key,'stock_remove',true) == "1"){									
									
										// CHECK IF WE ARE USING THE PRICE-ON SYSTEM
										if(get_post_meta($key,'price-on',true) == 1 && isset($mainitem['custom_data']) ){										
											 	// LET CUSTOM DATA HANDLE IT
										}else{											
											// UPDATE
											update_post_meta($key,'qty',get_post_meta($key,'qty',true)-$mainitem['qty']);
										}
									}
								 
				
						} }
						
				
				}// END ITEMS
				
				
				// UPDATE PRODUCT ITEMS
				update_post_meta($ex,'order_postid', $itemslist ); /// still needed?
				
				}	
				
						
			} // END HAS SESSOPM 
	
		}
		
	}// end if


return $data;


}
  	
	
	
	 
	
}

?>