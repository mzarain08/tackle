<?php


class framework_search extends framework_orders {

function saveSearchData($search_data){
	
	global $userdata;
	
	if(_ppt(array('search', 'analytics' )) != '1'){ return ""; }
 
	
	// HITS ARRAy
	$data = get_option('ppt_search_data'); 
	if(!is_array($data)){ $data = array(); }
				
	// GET DATE			  
	if (isset($_SERVER['HTTP_CLIENT_IP']))
	{
		$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
	}
				
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
		$real_ip_adress = $_SERVER['REMOTE_ADDR'];
	}
	
	// FORMAT
	$newdata = array();
	foreach($search_data as $k => $v){
		
		if(in_array($k,array("meta_query","tax_query"))){
			$newdata[$k] = $v;
		}
	
	}
	
	// LOCATION DATE
	$country = "";
	$country_name = "";
	$city = "";
	
	$saved_ip_data = get_option("ppt_user_ipdata");
	if(!is_array($saved_ip_data)){ $saved_ip_data = array(); }
	
	if(isset($saved_ip_data[$real_ip_adress]) ){ 
		$country 		= $saved_ip_data[$real_ip_adress]['country'];
		$country_name 	= $saved_ip_data[$real_ip_adress]['country_name'];
		$city 			= $saved_ip_data[$real_ip_adress]['city'];	}
 				
	// update
	if(isset($data[$real_ip_adress]) && is_array($data[$real_ip_adress]) ){		
		 
		$olddata = $data[$real_ip_adress]['data'];
		if(!is_array($olddata)){ $olddata = array(); }
			
		$olddata[] = $newdata;
	 	
		$data[$real_ip_adress] = array(
			"date" 			=> $data[$real_ip_adress]['date'], 
			"updated" 		=> date('Y-m-d H:i:s'), 
			"country" 		=> $data[$real_ip_adress]['country'], 
			"country_name" 	=> $data[$real_ip_adress]['country_name'], 
			"city" 			=> $data[$real_ip_adress]['city'], 
			"data" 			=> $olddata, 
			"user" 			=> $userdata->ID 
		); 
		
	}else{	
	
		$data[$real_ip_adress] = array(
			"date" 			=> date('Y-m-d H:i:s'), 
			"country" 		=> $country, 
			"country_name"	=> $country_name, 
			"city" 			=> $city, 
			"data" 			=> array($newdata), 
			"user" 			=> $userdata->ID
		);
		
	}
		 		 
	// SAVE			
	update_option('ppt_search_data', $data);	

}


function default_searchfilters(){ global $wpdb;
	
	
	add_filter('posts_orderby', array($this, 'custom_orderby') );

	// SORT BY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_sortby' ) );
	
	// SORT BY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_perpage' ) );
	
	// CARD TYPE
	add_filter( 'ppt_query_args', array($this, '_filter_cardtype' ) );
 	
	// CARD TYPE
	add_filter( 'ppt_query_args', array($this, '_filter_card' ) );
 
	// PAGE NUMBER
	add_filter( 'ppt_query_args', array($this, '_filter_pagenum' ) );
	
	// PAGE NUMBER
	add_filter( 'ppt_query_args', array($this, '_filter_cardlayout' ) );
	
	// PAGE NUMBER
	add_filter( 'ppt_query_args', array($this, '_filter_usersearch' ) );
 	
	// PAGE NUMBER
	add_filter( 'ppt_query_args', array($this, '_filter_perrow' ) );

	// PAGE NUMBER
	add_filter( 'ppt_query_args', array($this, '_filter_search_style' ) );
		
	// KEYWORD FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_keyword' ) );
	
	// KEYWORD FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_comments' ) );
	
	// KEYWORD FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_date_added' ) );
	

 	// FAVORITES FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_favorites' ) ); 

 	// FAVORITES FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_history' ) ); 
  
	// CATEGORY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_category' ) );
	
	add_filter( 'ppt_query_args', array($this, '_filter_subcategory' ) );
	
	add_filter( 'ppt_query_args', array($this, '_filter_offers' ) );
	add_filter( 'ppt_query_args', array($this, '_filter_cashback' ) );
		
	// PACKAGE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_package' ) );			

	// VERIFIED FILTER (COUPON THEME)
	add_filter( 'ppt_query_args', array($this, '_filter_verified' ) );

	// VERIFIED FILTER (COUPON THEME)
	add_filter( 'ppt_query_args', array($this, '_filter_images' ) );
 
	// VERIFIED FILTER 
	add_filter( 'ppt_query_args', array($this, '_filter_reviews' ) );

	// VERIFIED FILTER 
	add_filter( 'ppt_query_args', array($this, '_filter_hasbids' ) );

	// VERIFIED FILTER 
	add_filter( 'ppt_query_args', array($this, '_filter_buynow' ) );

	// HAS VIDEO UPLOADS FILTER 
	add_filter( 'ppt_query_args', array($this, '_filter_hasvideo' ) );

	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_price' ) );

	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_sale' ) );


	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_deliverytime' ) );

	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_sold' ) );
	
	add_filter( 'ppt_query_args', array($this, '_filter_dateends' ) );
	
	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_downloads' ) );
	
	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_length' ) );


	// PRICE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_membership_access' ) );


	// AGE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_age' ) );

	// AGE FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_days' ) );
	
	// LASTUSED FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_lastused' ) );
	
	// YEAR FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_year' ) );
	
	// MAP FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_country' ) );
	
	// SELLER COUNTRY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_seller_country' ) );

	// YEAR FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_city' ) );
	
	// RATING FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_rating' ) );

	// RADIUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_radius' ) );

	// RADIUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_zipcode' ) );
	
	// TAXONOMY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_taxonomy' ) );
	
	// TAXONOMY FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_single_taxonomy' ) );	
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_poststatus' ) );
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_type' ) );
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_process' ) );
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_date' ) );

	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_status' ) );	
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_cashback_status' ) );	
	
	
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_dispute_status' ) );	

	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_orderid' ) );	

	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_pakid' ) );	
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_memid' ) );	
	

	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_userid' ) );
	
	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_order_invoiceid' ) );

	// POST STATUS FILTER
	add_filter( 'ppt_query_args', array($this, '_filter_userid' ) );
	 
	// USER - ONLINE
	add_filter( 'ppt_query_args', array($this, '_filter_user_online' ) ); 	
	
	// USER - VERIFIED
	add_filter( 'ppt_query_args', array($this, '_filter_user_verify' ) );
	
	// USER - NAME SEARCH
	add_filter( 'ppt_query_args', array($this, '_filter_username' ) );
	
	// USER - NAME SEARCH
	add_filter( 'ppt_query_args', array($this, '_filter_user_type' ) );
 

	// MEMBERSHIPS
	add_filter( 'ppt_query_args', array($this, '_filter_user_membership' ) );
 
	// REPORTS - LOG TYPE
	add_filter( 'ppt_query_args', array($this, '_filter_logtype' ) );
	
 	// SHOW ONLY FILTERS
	add_filter( 'ppt_query_args', array($this, '_filter_showonly_status' ) );
	
 	// SHOW ONLY FILTERS
	add_filter( 'ppt_query_args', array($this, '_filter_showonly_featured' ) );
	
 	// SHOW ONLY FILTERS
	add_filter( 'ppt_query_args', array($this, '_filter_showonly_homepage' ) );
	
 	// SHOW ONLY FILTERS
	add_filter( 'ppt_query_args', array($this, '_filter_showonly_sponsored' ) );

 	//  EXPIRY DATE
	add_filter( 'ppt_query_args', array($this, '_filter_expiry' ) );


	//  EXPIRY DATE
	add_filter( 'ppt_query_args', array($this, '_filter_makes' ) );
	add_filter( 'ppt_query_args', array($this, '_filter_model' ) );


}
function _filter_makes($a){


	$g = $this->_check_search_query('filter-make');		
	
	if(isset( $g['filter-make']) && is_array($g['filter-make'])){
		
		$g = $g['filter-make'];
	 	if(isset($g[1])){
		
			$a['meta_query']["customfield_make"]  = array(							
				'key' 		=> "make",			 
				'value' 	=> $g[1],
				'compare'	=> '='						
			);	 
		
		} 
	  
	}elseif(isset( $g['filter-make']) && $g['filter-make'] != "null" && !is_array($g['filter-make']) && strlen($g['filter-make']) > 2  ){
		
			 
			$a['meta_query']["customfield_make"]  = array(							
				'key' 		=> "make",			 
				'value' 	=> $g['filter-make'],
				'compare'	=> '='						
			);	
			
	}

	return $a;
}
function _filter_model($a){


	$g = $this->_check_search_query('filter-model');		 
	if(isset( $g['filter-model']) && $g['filter-model'] != "null" && strlen($g['filter-model']) > 2 ){
		
			 
			$a['meta_query']["customfield_model"]  = array(							
				'key' 		=> "model",			 
				'value' 	=> $g['filter-model'],
				'compare'	=> '='						
			);	
			
	}

	return $a;
}

function custom_orderby($orderby){


	$g = $this->_check_search_query('sortby');		 
	if(isset($g['sortby']) && in_array($g['sortby'], array("featured-u","featured-d")) ){
		
		if(strpos(strtolower($orderby), "desc") !== false){
		
		return "CAST(mt1.meta_value AS SIGNED) desc";
		
		}else{
		
		return "CAST(mt1.meta_value AS SIGNED) asc";
		
		}
		 
	}

	return $orderby;
}

function _filter_logtype($a){

	$g = $this->_check_search_query('logtype');
	
	if(isset($g['logtype']) && is_array($g['logtype']) && !empty($g['logtype'])){
	
		$a['meta_query']['logtype']   = array(
					
				'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'log_type1'    => array(
								'key' 			=> 'log_type',
								
								'value' 		=> $g['logtype'][0],
								'compare' 		=> '=',								 			
							),			 
							'log_type2'   => array(
								'key' 			=> 'log_type',								
								
								'compare' 		=> '=',	
								'value' 		=> $g['logtype'][1],
												
							),						
				),	
		);
	 
	 
	
	}elseif(isset($g['logtype']) && !is_array($g['logtype']) && strlen($g['logtype']) > 2){	
	
		$a['meta_query']["log_type"]  = array(							
				'key' => "log_type",
				'value' => $g['logtype'],
				'compare'=> '='						
		);
	
	}
	
	return $a;
}


function _check_search_query($lookingfor){

	$ceanArray = array();	
 	
	if(isset($_POST['search_data']) && strpos($_POST['search_data'], $lookingfor) !== false){
	 
		preg_match_all("/\\[(.*?)\\]/", $_POST['search_data'], $m);
		 
		if(!empty($m[0])){
		  
		foreach($m[0] as $k){
		
			$g = explode(":", str_replace("[","", str_replace("]","",$k)) );
			
			 
			if(isset($ceanArray[$g[0]])){ // LOPPED SO WOULD BE SET ALREADY			  
				 	
					$t_key = $g[0];
					$t_val = $g[1];
						
					$h = $ceanArray[$g[0]];	
					
					// MAKE FIRST VALUE AN ARRAY SO WE CAN ADD ON NEW ARRAY VALUES
					if(!is_array($ceanArray[$g[0]])){
					$ceanArray[$g[0]] = array();
					array_push($ceanArray[$g[0]],$h);
					}
					
					// NOW ADD ON NEW ARRAY
					array_push($ceanArray[$g[0]], $t_val);
					 
				
			}else{
			$ceanArray[$g[0]] = $g[1];
			}
		
		}
		}
	//die(print_r($ceanArray));
	}
	 
	return $ceanArray;
}

function _filter_order_invoiceid($a){

	$g = $this->_check_search_query('invoiceid');
	
	if(isset($g['invoiceid']) && strlen($g['invoiceid']) > 1  ){
	
	 		$a['p'] = str_replace("#","", str_replace("00","",$g['invoiceid']));
	
	}
	
	return $a;
}
function _filter_order_orderid($a){

	$g = $this->_check_search_query('orderid');
	
	if(isset($g['orderid']) && strlen($g['orderid']) > 1   ){
	
	 		//$a['p'] = $g['orderid'];
			$a['meta_query']["orderid"]  = array(	
			
				'relation'    => 'OR',
					
			 	 	array(		 
					'key' 		=> "order_id",
					'value' 	=> $g['orderid'],
					'compare'	=> 'LIKE'		
				 	
					),							
											
			);
	
	
	}
	
	return $a;
}

function _filter_order_memid($a){

	$g = $this->_check_search_query('order_memid');
	
	if(isset($g['order_memid']) && is_numeric($g['order_memid']) ){	
	 
		$a['meta_query']["order_post_packageid"]  = array(							
				'key' => "order_id",
				'value' => "mem".$g['order_memid'],
				'compare'=> 'LIKE'						
		); 
	
	}
	
	return $a;
}

function _filter_order_pakid($a){

	$g = $this->_check_search_query('order_pakid');
	
	if(isset($g['order_pakid']) && is_numeric($g['order_pakid']) ){	
	 
		$a['meta_query']["order_post_packageid"]  = array(							
				'key' => "order_post_packageid",
				'value' => $g['order_pakid'],
				'compare'=> '='						
		); 
	
	}
	
	return $a;
}

function _filter_order_userid($a){

	$g = $this->_check_search_query('order_userid');
	
	if(isset($g['order_userid']) && is_numeric($g['order_userid']) ){	
	
		$a['meta_query']["order_userid"]  = array(							
				'key' => "order_userid",
				'value' => $g['order_userid'],
				'compare'=> '='						
		);
	
	
	}
	
	return $a;
}

function _filter_showonly_status($a){

	$g = $this->_check_search_query('status');
	
	if(isset($g['status']) && is_numeric($g['status']) ){
	
		if($g['status'] == 1){ // NOT SET TO 0
	  
			$a['meta_query']["status"]  = array(	
			
				'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'status1'    => array(
								'key' 		=> "status",
								'value' 	=> 1,
								'compare'	=> '!='							 			
							),			 
							'status2'   => array(
								'key' 		=> "status",
								'type' 		=> 'NUMERIC',			 
								'compare'	=>'NOT EXISTS'												
							),						
				),								
											
			);

		}else{
		
			$a['meta_query']["status"]  = array(							
					'key' => "status",
					'value' => 0,
					'compare'=> '='						
			);
			
			
			
		}	
	
		
	
	
	}
	
	return $a;
}

function _filter_expiry($a){

	$g = $this->_check_search_query('expiry');
	
	if(isset($g['expiry']) ){
	
		$a['meta_query']["expiry"]  = array(							
				'key' => "listing_expiry_date",
				'compare' => '>=',
				'value' => current_time( 'mysql' ),
				'type' => 'DATETIME'						
		); 
	
	}
	
	return $a;
}

function _filter_reviews($a){

	$g = $this->_check_search_query('reviews');
	
	if(isset($g['reviews']) && is_numeric($g['reviews']) ){	
	 
		$a['meta_query']["ratingtotal"]  = array(							
				'key' => "starrating",
				'value' => "",
				'compare'=> '!='						
		); 
	
	}
	
	return $a;
}



function _filter_hasbids($a){

	$g = $this->_check_search_query('hasbids');
	
	if(isset($g['hasbids']) && is_numeric($g['hasbids']) && $g['hasbids'] == "1" ){	
	 
		$a['meta_query']["current_bid_data"]  = array(							
				'key' 		=> 'current_bid_data',
				'value' 	=> "",
				'compare'	=> '!='						
		); 
	
	}
	
	return $a;
}
function _filter_buynow($a){

	$g = $this->_check_search_query('buynow');
	
	if(isset($g['buynow']) && is_numeric($g['buynow']) ){	
	
		if(THEME_KEY == "at"){ $key = "auction_type"; $val = 2; }else{ $key = "offertype"; $val = 1; }
	
		$a['meta_query']["buynow"]  = array(							
				'key' => $key,
				'value' => $val,
				'compare'=> '='						
		); 
	
	}
	
	return $a;
}
 

function _filter_hasvideo($a){

	$g = $this->_check_search_query('hasvideo');
	
	if(isset($g['hasvideo']) && is_numeric($g['hasvideo']) ){	
	  
		$a['meta_query']['hasvideo']   = array(
					
				'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'hasvideo1'    => array(
								'key' 			=> 'video_array',							
								'value' 		=> "",
								'compare' 		=> '!=',								 			
							),			 
							'hasvideo2'   => array(
								'key' 			=> 'youtube_id',							
								'value' 		=> "",
								'compare' 		=> '!=',
												
							),						
				),	
		); 
	
	}
	
	return $a;
}

function _filter_sale($a){

	$g = $this->_check_search_query('sale'); // CUSTOM FIELD sale FILTER
	
	if(isset($g['sale']) && is_numeric($g['sale']) ){	
	
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'sale'    => array(
								'key' => 'old_price',
								'value' => "",
								'compare'=> '!='								 			
							),			 
							'sale1'   => array(
								'key'     => 'old_price',							
								'compare' => 'EXISTS',
								
												
							),						
						),	
					); 
	
	    
	}
	
	return $a;
}

function _filter_images($a){

	$g = $this->_check_search_query('images'); // CUSTOM FIELD images FILTER
	
	if(isset($g['images']) && is_numeric($g['images']) ){	
	
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'images'    => array(
								'key' => 'image_array',
								'value' => "",
								'compare'=> '!='								 			
							),			 
							'images1'   => array(
								'key'     => 'image',							
								'compare' => 'EXISTS',
								
												
							),						
						),	
					); 
	
	    
	}
	
	return $a;
}
function _filter_cashback($a){

	$g = $this->_check_search_query('cashback'); // CUSTOM FIELD cashback FILTER
	
	if(isset($g['cashback']) && is_numeric($g['cashback']) ){	 
		 
		 $a['meta_query']["cashback"]  = array(							
					'key' => "cashback",
					'value' => 0,
					'compare'=> '>'						
			); 
		 
	}
	
	return $a;
}

function _filter_offers($a){

	$g = $this->_check_search_query('offers'); // CUSTOM FIELD offers FILTER
	
	if(isset($g['offers']) && is_numeric($g['offers']) ){	 
		 
			$a['meta_query']['code']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	 
							'code'    => array(
								'key' => "code", 
								'value'	=> ''								 			
							),			 
							'code1'   => array(
								'key'     => "code",							
								'compare' => 'NOT EXISTS',
								 
												
							),						
						),	
					); 
		 
	}
	
	return $a;
}

function _filter_verified($a){

	$g = $this->_check_search_query('verified'); // CUSTOM FIELD VERIFIED FILTER
	
	if(isset($g['verified']) && is_numeric($g['verified']) ){	
	
		if(THEME_KEY == "es"){
		
		$a['meta_query']["photosverified"]  = array(							
					'key' => "photosverified",
					'value' => 1,
					'compare'=> '='						
			); 
		}else{
			$a['meta_query']["verified"]  = array(							
					'key' => "verified",
					'value' => 1,
					'compare'=> '='						
			); 
		}
	}
	
	return $a;
}

function _filter_user_verify($a){

	$g = $this->_check_search_query('verify');
	 
	if(isset($g['verify']) && is_numeric($g['verify']) ){	
 
		$a['meta_query']["verified"]  = array(							
				'key' => "ppt_verified",
				'value' => $g['verify'],
				'compare'=> '='						
		);  
	
	}
	
	return $a;
}

function _filter_user_type($a){

	$g = $this->_check_search_query('user_type');
	  
	if( isset($g['user_type'])  ){	
	
		if(isset($g['user_type']) && $g['user_type'] == "all" ){	
		
		}else{
	
			$a['meta_query']["usertype"]  = array(							
					'key' => "user_type",			 
					'value' => $g['user_type'],
					'compare'=> '='						
			); 
		
		}
	
	}
	
	return $a;
}

function _filter_user_membership($a){

	$g = $this->_check_search_query('membership');	 
	
	if(isset($g['membership']) && is_numeric($g['membership'])  ){	 
	
		$a['meta_query']["ppt_subscription"]  = array(							
				'key' => "ppt_subscription_key",			 
				'value' => $g['membership'],
				'compare'=> '='						
		);	
	
	}elseif(isset($g['membership']) && is_array($g['membership']) && !empty($g['membership'])  ){	 
	
		$a['meta_query']["ppt_subscription"]  = array(							
				'key' => "ppt_subscription_key",			 
				'value' => $g['membership'],
				'compare'=> 'IN'					
		);	
	}
	
	return $a;
}

function _filter_user_type_fr($a){

 
	$g = $this->_check_search_query('user_fr');
	
	if(isset($g['user_fr']) && is_numeric($g['user_fr']) ){	
	
		if(isset($g['user_em']) && is_numeric($g['user_em']) ){	
		
		}else{
	
		$a['meta_query']["usertype"]  = array(							
				'key' => "user_type",			 
				'value' => "user_fr",
				'compare'=> '='						
		); 
		
		}
	
	}
	
	return $a;
}

function _filter_user_online($a){

	$g = $this->_check_search_query('online');
	
	if(isset($g['online']) && is_numeric($g['online']) ){	
	
		$a['meta_query']["online"]  = array(							
				'key' => "online",
				'type' => 'DATETIME',
				'value' => "",
				'compare'=> '!='						
		);  
	
	}
	
	return $a;
}

function _filter_userid($a){ global $searchdata;

	$g = $this->_check_search_query('userid');
	
	if(isset($g['userid']) && is_numeric($g['userid']) ){	
	
		add_filter( 'pre_get_posts', array($this, '_pre_get_posts_userid') );
	 
	}	
	
	return $a;

}
function _pre_get_posts_userid($q){

	$g = $this->_check_search_query('userid');
	
	if(isset($g['userid']) && is_numeric($g['userid']) ){	
		$q->set('author', $g['userid']);	
	}
	
	return $q;
}


function _filter_rating($a){ global $searchdata;

	$g = $this->_check_search_query('rating');
	
	if(isset($g['rating']) && is_numeric($g['rating']) && $g['rating'] != 0){
	
		if($g['rating'] == 5){
		$compare = "=";
		}else{
		$compare = ">=";
		}
		
	 
		$a['meta_query']["rating"]  = array(							
				'key' => "starrating",
				'type' => 'NUMERIC',
				'value' => $g['rating'],
				'compare'=> $compare						
		);
			
	} 
	
	return $a;
} 

function _filter_category($a){ global $searchdata;

	$g = $this->_check_search_query('catid');
	
	if(isset($g['catid']) && is_array($g['catid']) && !isset($g['subcatid']) ){
	
		$a['tax_query'][] = array(
				'taxonomy' => "listing",
				'field' => 'term_id',
				'terms' => $g['catid'],
				'operator'=> 'IN',								
		);
		 	
	}elseif(isset($g['catid']) && is_numeric($g['catid']) && $g['catid'] != 0 && !isset($g['subcatid']) ){
	
		$a['tax_query'][] = array(
				'taxonomy' => "listing",
				'field' => 'term_id',
				'terms' => array($g['catid']),
				'operator'=> 'IN',								
		); 	
	}
	
	return $a;
}

function _filter_subcategory($a){ global $searchdata;

	$g = $this->_check_search_query('subcatid');
	
	if(isset($g['subcatid']) && is_array($g['subcatid']) ){
	
		$a['tax_query'][] = array(
				'taxonomy' => "listing",
				'field' => 'term_id',
				'terms' => $g['subcatid'],
				'operator'=> 'IN',								
		);
		 	
	}elseif(isset($g['subcatid']) && is_numeric($g['subcatid']) && $g['subcatid'] != 0){
	
		$a['tax_query'][] = array(
				'taxonomy' => "listing",
				'field' => 'term_id',
				'terms' => array($g['subcatid']),
				'operator'=> 'IN',								
		); 	
	}
	
	return $a;
} 

function _filter_single_taxonomy($a){ global $searchdata;

	$g = $this->_check_search_query('singletaxonomy');
	
	
	if(isset($g['singletaxonomy']) && strlen($g['singletaxonomy']) > 1 ){
	  
		$a['taxonomy'] = $g['singletaxonomy'];			  
		
	} 
	
	return $a;
} 

function _filter_taxonomy($a){ global $searchdata;

	$g = $this->_check_search_query('taxonomy'); 
	
	if(isset($g['taxonomy']) && is_array($g['taxonomy']) ){ 
	   
	 	
		// CLEAN ARRAY	
		if(isset($a['tax_query']) && !is_array($a['tax_query'])){ $a['tax_query'] = array('relation'    => 'AND'); }	 
		$cleaned = array(); $added = array();  $adddata = array(); $i =1;
		
		$new_taxkeys = array();
		
		foreach($g['taxonomy'] as $h){			
	 		
			$t = str_replace(" ", "-", $h);			 
			$tax_val = preg_replace("/[^0-9.]/", "", $h );		
			$tax_key = str_replace("-".preg_replace("/[^0-9.]/", "", $h),"", str_replace(" ", "-", $h) );
			 
			if(isset($new_taxkeys[$tax_key])){
			 
				array_push($new_taxkeys[$tax_key], $tax_val); 
			
			}else{
			
				$new_taxkeys[$tax_key] = array($tax_val);
			
			} 			
				
		} // finish loop
		 
		
		if(!empty($new_taxkeys)){
			
			if(!isset($a['tax_query'])){  $a['tax_query'] = array(); }
			
			 
			foreach($new_taxkeys as $tk => $ta ){ 
			
				if(in_array($tk,array("country","listing"))){
					
						$ii=1;
						foreach($ta as $k){
						
						$a['tax_query'] = array_merge($a['tax_query'],  
								array(  
									$tk.$ii   =>  
									array( 
										'taxonomy' => $tk,
										'field' => 'term_id',
										'terms' => $k,
										'operator'=> 'IN',	
									),					  
								)
						);	
						$ii++;
						}
				
				}else{
		
				$a['tax_query'] = array_merge($a['tax_query'],  
						array(  
							$tk   =>  
							array( 
								'taxonomy' => $tk,
								'field' => 'term_id',
								'terms' => $ta,
								'operator'=> 'IN',	
							),					  
						)
				);	 
				
				}
			
			}
		} 
	 
	/// die(print_r($a));
		
	}elseif(isset($g['taxonomy']) && strlen($g['taxonomy']) > 1){		
		
		$tax = str_replace("-".preg_replace("/[^0-9.]/", "", $g['taxonomy']),"", str_replace(" ", "-", $g['taxonomy']) );	
		
		$t = preg_replace("/[^0-9.]/", "", $g['taxonomy']);
		
		if(!isset($a['tax_query'])){  $a['tax_query'] = array(); }
			
		 
		$a['tax_query'][$tax] = array(
		
				'taxonomy' 	=> $tax,
				'field' 	=> 'term_id',
				'terms' 	=> $t,
				'operator'	=> 'IN',								
		); 	
	}
	

	 
	return $a;
} 

function _filter_package($a){ global $searchdata;

	$g = $this->_check_search_query('pakid');
	
	if(isset($g['pakid']) && is_array($g['pakid']) ){
 	
		$a['meta_query']['packageid']   = array(
					
				'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'package1'    => array(
								'key' 			=> 'packageID',
								'type' 			=> 'NUMERIC',
								'value' 		=> $g['pakid'][0],
								'compare' 		=> '=',								 			
							),			 
							'package2'   => array(
								'key' 			=> 'packageID',								
								'type' 			=> 'NUMERIC',
								'compare' 		=> '=',	
								'value' 		=> $g['pakid'][1],
												
							),						
				),	
		);
 
	 	
	}elseif(isset($g['pakid']) && is_numeric($g['pakid']) ){
	 
		$a['meta_query']["packageid"]  = array(							
				'key' => "packageID",
				'type' => 'NUMERIC',
				'value' => $g['pakid'],
				'compare'=> '='						
			);
			
	}elseif(isset($g['pakid']) && $g['pakid'] == "none"){
	 
		$a['meta_query']["packageid"]  = array(							
				'key' => "packageID",
				'type' => 'NUMERIC',			 
				'compare'=>'NOT EXISTS'			
			);
	}
	
	return $a;
} 

function _filter_zipcode($a){  

	$g = $this->_check_search_query('zipcode');
   	
	if(isset($g['zipcode']) && $g['zipcode'] != "" && strlen($g['zipcode']) > 4 ){
	 
		add_filter( 'posts_orderby',array($this, '_distance_extra' ) );
		add_filter( 'posts_distinct', array($this, '_distinct_sql')  );		
		add_filter( 'posts_join', array($this, '_distance_join') );
		add_filter( 'posts_where', array($this, '_distance_where') );
		add_filter( 'posts_groupby', array($this, '_distance_groupby') );
	}
	
	return $a;
}
function _filter_radius($a){  

	$g = $this->_check_search_query('radius');
 	
	if(isset($g['radius']) && $g['radius'] != "0" ){
	
		add_filter( 'posts_orderby',array($this, '_distance_extra' ) );
		add_filter( 'posts_distinct', array($this, '_distinct_sql') );		
		add_filter( 'posts_join', array($this, '_distance_join') );
		add_filter( 'posts_where', array($this, '_distance_where') );
		add_filter( 'posts_groupby', array($this, '_distance_groupby') );
	
	}
	
	return $a;
}

	function _distance_join($arg){ global $wpdb;
	
			$arg .= "INNER JOIN $wpdb->postmeta AS wlt1 ON ( $wpdb->posts.ID = wlt1.post_id ) ";
			$arg .= "INNER JOIN $wpdb->postmeta AS wlt2 ON ( $wpdb->posts.ID = wlt2.post_id ) ";
			 
			// ADD-ON SWL
			$arg .= "INNER JOIN $wpdb->postmeta AS t1 ON ($wpdb->posts.ID = t1.post_id AND t1.meta_key = 'map-lat' ) ";
			$arg .= "INNER JOIN $wpdb->postmeta AS t2 ON ($wpdb->posts.ID = t2.post_id AND t2.meta_key = 'map-log') ";	
	
		return $arg;
	}

	function _distance_where($q){ global $wpdb, $CORE;
	 
	 	$q .= " AND (   t1.post_id IS NULL   OR  t1.meta_key = 'map-lat' )"; 
		$q .= " AND (   t2.post_id IS NULL   OR  t2.meta_key = 'map-log' )"; 
		
		$g = $this->_check_search_query('radius');	
		
	 	  
		// RANGE
		$range = 50000; $output = array();
		
		if(isset($g['radius']) && is_numeric($g['radius']) && $g['radius'] > 0){
		$range = $g['radius'];
		}
		
		// CHECK FOR LAT/LOG PASSED IN WITH QUERY
		if(isset($g['map-log']) && is_numeric($g['map-log']) ){
		 	
			$longitude 	= $g['map-log'];
			$latitude 	= $g['map-lat'];
			$address 	= $g['zipcode'];
		
		// ZIPCODE - SEARCH QUERY
		}elseif(isset($g['zipcode']) && strlen($g['zipcode']) > 0){	
		 		
			$thisZip = strtolower($g['zipcode']);
			
			// CLEAN UP STRING
			$cb = explode(",", $thisZip);
			if(is_array($cb) && !empty($cb)){ 
				$newarray = array();
				$count = count($cb); 
 				$i=1;
				foreach($cb as $t){
				
					if($i > 4){
					$i++;
					continue;
					}
				
					$t = trim($t); 
					$newarray[] = strtolower($t); 
					$i++;
				}
			
			}
			
			$newarray = array_unique($newarray);
			
			$thisZip = "";
			foreach($newarray as $t){
			$thisZip .= $t.",";
			}
			$thisZip = substr($thisZip, 0,-1); 
			
			// GET GEO DATA
			$sd = $CORE->GEO( "ip_test_map", urlencode($thisZip) ); 
		 	
			$longitude 	= $sd['lng'];
			$latitude 	= $sd['lat'];
			$address 	= $sd['address'];  
				
		}
		 
		//die(print_r($sd));
		//die($thisZip."// ".$longitude." -- ".$latitude." -- ".$address." -- "._ppt(array('maps','provider'))." -- ".print_r($output)." -- ".$sql );	
		 
		
		// SAVE ONLY IF BOTH NOT EQUAL 0
		if($longitude != "" && $latitude != ""){		 		
				
				// SAVE THE DATA
				$saved_searches[ $longitude . '--' .$latitude ] = array("log" => $longitude, "lat" => $latitude, "address" => $address );		
				update_option('ppt_saved_zipcodes', $saved_searches);
		
			   if(!isset($address)){ $address = ""; }
				
				$GLOBALS['search_google_lat'] 		= $latitude;
				$GLOBALS['search_google_long'] 		= $longitude;
				$GLOBALS['search_google_address'] 	= $address;	
				$GLOBALS['search_google_radius'] 	= $range;
				 	
				// CHECK VALID DATA		
				if(isset($longitude) && is_numeric($longitude) && is_numeric($latitude) && $latitude != 0){	
				 
						
					// Find Max - Min Lat / Long for Radius and zero point and query  
					$lat_range = $range/69.172; 					 
					$lon_range = abs($range/(cos($latitude) * 69.172));  
					$min_lat = number_format($latitude - $lat_range, "4", ".", "");  
					$max_lat = number_format($latitude + $lat_range, "4", ".", "");  
					$min_lon = number_format($longitude - $lon_range, "4", ".", "");  
					$max_lon = number_format($longitude + $lon_range, "4", ".", "");  
					 
					//die("lat: ".$latitude." ($min_lat - $max_lat) / log:".$longitude." ($min_lon - $max_lon)");  
									
					$q .= "AND ( ( wlt1.meta_key = 'map-lat' AND wlt1.meta_value BETWEEN  ".$min_lat." AND  ".$max_lat."	) ";					
					$q .= " AND ( wlt2.meta_key = 'map-log' AND wlt2.meta_value	BETWEEN  ".$min_lon." AND  ".$max_lon." ) ";
					
					$q .= " OR ( 1=1 ) ";	
					
					//wlt2.meta_key = 'map-zip' AND wlt2.meta_value	= '".$thisZip."' OR wlt2.meta_key =  'map-zip' AND wlt2.meta_value	= '".trim($thisZip)."' 
							 
					$q .= " AND ( ( wlt2.post_id IS NULL  ) ) )  "; //OR wlt2.meta_key = 'map-zip'
					 
					 
				}elseif($range < 5000){
				 
					//$q .= "AND (wlt1.meta_key = 'map-zip' AND wlt1.meta_value = ('".strip_tags($thisZip)."')  OR wlt2.meta_key = 'map-zip' AND wlt2.meta_value = ('".trim(chunk_split($thisZip, 4, ' '))."')	) ";
				   
				}
		
		}  
		 
	
		return $q;
	}

	// ADDITONAL SQL FOR QUERY
	function _distinct_sql( $val ) { global $wpdb;
	
		   
		  
			// DEFAULTS
		if(isset($GLOBALS['search_google_lat'])){
			
				$lat = $GLOBALS['search_google_lat'];
				$log = $GLOBALS['search_google_long'];				
				
		}elseif(isset($_SESSION['mylocation']['lat']) && strlen($_SESSION['mylocation']['lat']) > 0 && strlen($_SESSION['mylocation']['log']) > 0 ){	
					
				$lat = strip_tags($_SESSION['mylocation']['lat']);
				$log = strip_tags($_SESSION['mylocation']['log']);
		}else{				
				$lat = "0";
				$log = "0";
		}
		 
			
		return "DISTINCT $wpdb->posts.ID, IFNULL( 3956 * 2 * ASIN(SQRT( POWER(SIN((t1.meta_value - ".$lat." ) *  
			 pi()/180 / 2), 2) +COS(t1.meta_value * pi()/180) * COS(".$lat." * pi()/180) * POWER(SIN((t2.meta_value - ".$log.") * pi()/180 / 2), 2) )), 999999) as distance, ";
 	 
	 	 	
	}	
	
	function _distance_extra($orderby){
	  
		$g = $this->_check_search_query('sortby');		 
		if(isset($g['sortby']) && in_array($g['sortby'], array("distance-u","distance-d")) ){
	
			// GET SORT BY VALUE
			$sortby = $g['sortby'];
			$order = "";		 			
			
			// CHECK FOR NEW ORDER STYLE
			if(strpos($sortby,"-") !== false){
				$sp = explode("-", $sortby);
				$sortby = $sp[0];
				if($sp[1] == "u"){ $order = "asc"; }else{ $order = "desc";  }
			}
			
			$a['orderby'] 	= $sortby;						
			$a['order'] 	= $order;
			
			return "distance ".$order;	
			
		} 
		
		return $orderby;
		
	}	 
	
	function _distance_groupby($groupby) {
		global $wpdb;			
		$groupby = "{$wpdb->posts}.ID";
		return $groupby;			 
	}
	
function _filter_year($a){  

	$g = $this->_check_search_query('year2');
 	
	if(isset($g['year2']) && is_numeric($g['year2']) && isset($g['year1']) && is_numeric($g['year1']) && $g['year2'] != (date("Y")+1) ){
	
			$key = "year";
					
			$a['meta_query']["year"]  = array(							
				'key' => $key,
				'type' => 'NUMERIC',
				'value' => array($g['year1'], $g['year2']),
				'compare'=> 'BETWEEN'						
			);
	
	}
	
	return $a;
} 

function _filter_country($a){  

	$g = $this->_check_search_query('country');
 	
	if(isset($g['country']) && $g['country'] != "null" && strlen($g['country']) > 1){	 
					
			$a['meta_query']["country"]  = array(							
				'key' => "map-country",			
				'value' => $g['country'],
				'compare'=> '='						
			);
	
	}
	
	return $a;
} 


function _filter_seller_country($a){  

	$g = $this->_check_search_query('seller_country');
 	
	if(isset($g['seller_country']) && $g['seller_country'] != "null" && strlen($g['seller_country']) > 1){	 
					
			$a['meta_query']["seller_country"]  = array(							
				'key' => "seller_country",			
				'value' => $g['seller_country'],
				'compare'=> '='						
			);
	
	}
	
	return $a;
} 

function _filter_city($a){  

	$g = $this->_check_search_query('newcity');
	
	if(isset($g['newcity']) && $g['newcity'] != "null" && strlen($g['newcity']) > 1 && !is_array($g['newcity']) ){	 
	 
	 
		$terms = get_terms( array(
			'taxonomy' 		=> 'city',
			'hide_empty' 	=> false,
			'number' 		=> 1,				 
			'search' 		=> $g['newcity'],				 
		));
 	
		if(is_array($terms) && !empty($terms)){
			$a['tax_query'][] = array(
				'taxonomy' => "city",
				'field' => 'term_id',
				'terms' => $terms[0]->term_id,
				'operator'=> 'IN',								
			);
		}
	
	}
	
	return $a;
} 


function _filter_date_added($a){

	$g = $this->_check_search_query('date_added');
 	
	if(isset($g['date_added']) && is_numeric($g['date_added']) && $g['date_added'] != 0 ){
		   
		switch($g['date_added']){
		
			case "1": {
			 $dat = "24 hours"; // today
			} break;
			case "2": {
			$dat = "2 days"; // 2 days
			} break;
			case "3": {
			$dat = "7 days"; // 7 days
			} break;
			case "4": {
			$dat = "14 days"; // 14 days
			} break;
			case "5": {
			$dat = "1 month"; // 1 month
			} break;
		} 
		  	
		$a['date_query']  = array(	
			 'column' => 'post_date_gmt',
			 'before' => '1 week',		
		); 
		
		  
	
	}
	
	return $a;
}

function _filter_comments($a){

	$g = $this->_check_search_query('comments');
 	
	if(isset($g['comments']) && is_numeric($g['comments']) && !in_array($g['comments'],array("0","")) ){
		 
		 
		$c = ">";
		 
		switch($g['comments']){ 
			case "1": {
			$dat = 0;
			$c = "=";
			} break;
			case "2": {
			$dat = 0;
			} break;
			case "3": {
			$dat = 5;
			} break;
			case "4": {
			$dat = 10;
			} break;
			case "5": {
			$dat = 20;
			} break;
		} 
		
		 $a['comment_count'] = array(
			'value'   => $dat,
			'compare' => $c,
		); 
	
	}
	
	return $a;
}

function _filter_membership_access($a){

	$g = $this->_check_search_query('access');
 	
	if(isset($g['access']) && strlen($g['access']) > 0 ){
		
		$key = "videoaccess";
		
		
		$ratings = array(
			"" 			=> array( "name" => __("Everyone","premiumpress") ),
			"loggedin" 	=> array( "name" => __("Members Only","premiumpress") ),		
			"subs" 		=> array( "name" => __("Members With Subscriptions","premiumpress") ), 
		);
		
		//die($g['access']."<--");
		 
		switch($g['access']){
			case "loggedin":
			case "subs":
			case "1": {
			
			} break;
		 }
 
		
 			$a['meta_query'][$key]  = array(							
					'key' => $key,
					'value' => '"'.$g['access'].'"',
					'compare'=> 'LIKE'						
			);
		} 
	 
	
	return $a;
}
function _filter_length($a){

	$g = $this->_check_search_query('length');
 	
	if(isset($g['length']) && is_numeric($g['length']) && $g['length'] > 1 ){
		
		$key = "time";
		 
		switch($g['length']){
		
			case "1": {
			
			} break;
			case "2": {
			$dat = array(0, 60);   // 1 min
			} break;
			case "3": {
			$dat = array(0, 30);  // 5 min
			} break;
			case "4": {
			$dat = array(0, 600);  // 10 min
			} break;
			case "5": {
			$dat = array(600, 9999999);  // 10+ min
			} break;
		}
 
		
 		$a['meta_query'][$key]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => $dat,
					'compare'=> 'BETWEEN'						
				);
		} 
	 
	
	return $a;
}
function _filter_downloads($a){

	$g = $this->_check_search_query('downloads');
 	
	if(isset($g['downloads']) && is_numeric($g['downloads']) && $g['downloads'] != 0 ){
		
		$key = "download_count";
		
		switch($g['downloads']){
		
			case "1": {
			 $dat = array(0, 0);
			} break;
			case "2": {
			$dat = array(1, 9999);
			} break;
			case "3": {
			$dat = array(50, 9999);
			} break;
			case "4": {
			$dat = array(100, 99999);
			} break;
			case "5": {
			$dat = array(500, 99999);
			} break;
		}
		 
		
 		$a['meta_query'][$key]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => $dat,
					'compare'=> 'BETWEEN'						
				);
		 
	 
	
	}
	
	return $a;
}

function _filter_dateends($a){

	$g = $this->_check_search_query('dateends');
 	
	if(isset($g['dateends']) && is_numeric($g['dateends']) && $g['dateends'] != 0 ){
		
		$key = "listing_expiry_date";
		 
		switch($g['dateends']){
		
			case "1": {
			 $days = 1; // 24 hours
			} break;
			case "2": {
			 $days = 2; // 48 hours
			} break;
			case "3": {
			 $days = 7; // 7 days
			} break;
			case "4": {
			 $days = 30; // 1 month
			} break;
			 
		}
		
		$date1 =  date('Y-m-d H:i:s', strtotime('-1 days'));
		$date2 =  date('Y-m-d H:i:s', strtotime('+'.$days.' days'));
					
		$a['meta_query']["listing_expiry_date"]  = array(							
				'key' => $key,
				'type' => 'DATETIME',
				'value' => array($date1, $date2),
				'compare'=> 'BETWEEN'						
		);
		
		
	}	 
	
	return $a;
}


function _filter_sold($a){

	$g = $this->_check_search_query('sold');
 	
	if(isset($g['sold']) && is_numeric($g['sold']) && $g['sold'] != 0 ){
		
		$key = "sold";
		
		switch($g['sold']){
		
			case "1": {
			 
			} break;
			case "2": {
			$dat = array(0, 3);
			} break;
			case "3": {
			$dat = array(0, 10);
			} break;
			case "4": {
			$dat = array(0, 50);
			} break;
			case "5": {
			$dat = array(0, 500);
			} break;
		}
		
		
		if($g['sold'] == 1){
		
			$a[$key]   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'sold'    => array(
								'key' => $key,
								'type'    => 'NUMERIC',
								'value'	=> '0'								 			
							),			 
							'sold1'   => array(
								'key'     => $key,							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
		
		}else{
		
 		$a['meta_query'][$key]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => $dat,
					'compare'=> 'BETWEEN'						
				);
		}
	 
	
	}
	
	return $a;
}
function _filter_deliverytime($a){

	$g = $this->_check_search_query('delivery');
 	
	if(isset($g['delivery']) && is_numeric($g['delivery']) && $g['delivery'] != 0 ){
		
		$key = "days";
		
		switch($g['delivery']){
		
			case "1": {
			$dat = array(1, 2);
			} break;
			case "2": {
			$dat = array(2, 5);
			} break;
			case "3": {
			$dat = array(5, 8);
			} break;
			case "4": {
			$dat = array(8, 32);
			} break;
		
		}
	
 		$a['meta_query'][$key]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => $dat,
					'compare'=> 'BETWEEN'						
				);
	 
	
	}
	
	return $a;
}

function _filter_price($a){  

	$g = $this->_check_search_query('price1');
 	
	if(isset($g['price1']) && is_numeric($g['price1']) ){
	
					
			
			if(is_array($g['price1'])){
				$p1 = $g['price1'][0];
			}else{
				$p1 = $g['price1'];
			}
			
			
			if(!isset($g['price2'])){
				$p2 = "";			
			}elseif(isset($g['price2']) && is_array($g['price2'])){
				$p2 = $g['price2'][0];
			}else{
				$p2 = $g['price2'];
			} 
			
			// SEARCH KEY
			if(THEME_KEY == "at"){ $key = "price_current"; }else{ $key = "price";	 }			 
			 
			 if(is_numeric($p2) && $p2 > 0){
				
				$a['meta_query']["price"]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => array($p1, $p2),
					'compare'=> 'BETWEEN'						
				);
				
			}else{				
				$a['meta_query']["price"]  = array(							
					'key' => $key,
					'type' => 'NUMERIC',
					'value' => $p1,
					'compare'=> '>'						
				);				
			}
			
	}
	
	return $a;
} 
 
function _filter_lastused($a){  

	$g = $this->_check_search_query('lastused');
 	
	if(isset($g['lastused']) && !in_array($g['lastused'],array("365","0","")) ){
	 	
	$days = 1;
	 switch($g['lastused']){
			case "1": {
			$days = 1;
			} break;
			case "2": {
			$days = 2;
			} break;
			case "3": {
			$days = 7;
			} break;
			case "4": {
			$days = 14;
			} break; 
			case "5": {
			$days = 24;
			} break; 
		}
	
		$key = "lastused"; 
			
		$date1 =  date('Y-m-d H:i:s', strtotime('-'.$days.' days'));
		$date2 =  date('Y-m-d H:i:s', strtotime('+1 days'));
					
		$a['meta_query']["lastused"]  = array(							
				'key' => $key,
				'type' => 'DATETIME',
				'value' => array($date1, $date2),
				'compare'=> 'BETWEEN'						
		);
		 
	}
	
	return $a;
} 

function _filter_age($a){  

	$g = $this->_check_search_query('age');
 	
	if(isset($g['age2']) && $g['age2'] != "500000" ){
	 	
			if(is_array($g['age1'])){
			$p1 = $g['age1'][0];
			}else{
			$p1 = $g['age1'];
			}
			
			if(is_array($g['age2'])){
			$p2 = $g['age2'][0];
			}else{
			$p2 = $g['age2'];
			}
					
			$a['meta_query']["age"]  = array(							
				'key' => "daage",
				'type' => 'NUMERIC',
				'value' => array($p1, $p2),
				'compare'=> 'BETWEEN'						
			);	
	}
	
	return $a;
} 

function _filter_days($a){  

	$g = $this->_check_search_query('days');
 	
	if(isset($g['days2']) && $g['days2'] != "500000" ){
	 	
			if(is_array($g['days1'])){
			$p1 = $g['days1'][0];
			}else{
			$p1 = $g['days1'];
			}
			
			if(is_array($g['days2'])){
			$p2 = $g['days2'][0];
			}else{
			$p2 = $g['days2'];
			}
			
			
			$a['meta_query']["days"]   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'days1'    => array(
								'key' => "days",
								'type' => 'NUMERIC',
								'value' => array($p1, $p2),
								'compare'=> 'BETWEEN'							 			
							),			 
							'days2'   => array(
								'key' => "days-1",
								'type' => 'NUMERIC',
								'value' => array($p1, $p2),
								'compare'=> 'BETWEEN'												
							),						
						),	
			);
			
			
	}
	
	return $a;
} 

function _filter_poststatus($a){

	$g = $this->_check_search_query('post_status');
 	
	if(isset($g['post_status']) ){
	  
	  
	  		if(is_array($g['post_status'])){
			
			$a['post_status'] = $g['post_status']; 
			
			}else{
			
				if(strpos($g['post_status'],",") !== false){
					$a['post_status'] =explode(",", $g['post_status']); 
				}else{
					$a['post_status'] = array($g['post_status']); 
				}			
			
			}
			 
	}
	
	return $a;
}

function _filter_username($a){


	$g = $this->_check_search_query('username');
 	
	if(isset($g['username']) ){
	  
		$a['search'] = "*".$g['username']."*"; 
 	
	}
	
	return $a;
}

function _filter_keyword($a){


	$g = $this->_check_search_query('keyword');
 	
	if(isset($g['keyword']) ){
	  
	  if(is_array($g['keyword'])){
	  $a['s'] = $g['keyword'][0]; 
	  }else{
	  $a['s'] = $g['keyword']; 
	  }
		 
	}
	
	return $a;
}

function _filter_cardtype($a){


	$g = $this->_check_search_query('cardtype');
 	
	if(isset($g['cardtype']) ){
	  
		$a['cardtype'] = $g['cardtype']; 
	
	}
	
	return $a;
}

function _filter_perpage($a){


	$g = $this->_check_search_query('perpage');
 	
	if(isset($g['perpage']) ){
	  
		$a['posts_per_page'] = $g['perpage']; 
	
	}
	
	return $a;
}

function _filter_favorites($a){ global $userdata;


	$g = $this->_check_search_query('favorites');
 	
	if(isset($g['favorites']) ){
 
		 add_filter( 'pre_get_posts', array($this, '_pre_get_posts_favorites') );
	
	}
	
	return $a;
}

 

function _filter_history($a){ global $userdata;


	$g = $this->_check_search_query('history');
 	
	if(isset($g['history']) ){
 
		 add_filter( 'pre_get_posts', array($this, '_pre_get_posts_history') );
	
	}
	
	return $a;
}

function _pre_get_posts_history($q){

	$g = $this->_check_search_query('history');
	
	if(isset($g['history']) ){	
			
			global $userdata;
		
			$key 		= "history";
			if(defined('WP_ALLOW_MULTISITE')){
				$key .= get_current_blog_id();
			}
				
			// HITS ARRAY
			$data = get_user_meta($userdata->ID,$key,true);
			if(!is_array($data)){ $data = array(); }	 
			if(isset($data[0])){ unset($data[0]); } 
			
			$mylist = array();
			foreach($data as $k => $h){
			$mylist[$k] = $k;
			}	
						 
			 		
			if(is_array($mylist) && !empty($mylist)){			 
					$a['post_in'] =  $mylist;
			}else{
					$a['post_in'] =  array("99");
			} 
		 
		
			$q->set('post__in', $a['post_in']);	
	}
	
	return $q;
}
 
function _pre_get_posts_favorites($q){

	$g = $this->_check_search_query('favorites');
	
	if(isset($g['favorites']) ){	
			
			global $userdata;
		
			$extn = "_list";
			if(defined('WP_ALLOW_MULTISITE')){
					$extn .= get_current_blog_id();
			}			
						 
			$my_list = get_user_meta($userdata->ID, 'favorite'.$extn,true);	
					
			if(is_array($my_list) && !empty($my_list)){			 
					$a['post_in'] =  $my_list;
			}else{
					$a['post_in'] =  array("99");
			} 
		
		$q->set('post__in', $a['post_in']);	
	}
	
	return $q;
}


function _filter_showonly_homepage($a){


	$g = $this->_check_search_query('homepage');
 	
	if(isset($g['homepage']) ){
	  
		$a['meta_query']['homepageonly']   = array(
					
				'homepage'    => array(
								'key' 			=> 'homepage',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
				),						 
		); 	
	}
	
	return $a;
}

function _filter_showonly_sponsored($a){


	$g = $this->_check_search_query('sponsored');
 	
	if(isset($g['sponsored']) ){
	  
		$a['meta_query']['sponsoredonly']   = array(
					
				'sponsored'    => array(
								'key' 			=> 'sponsored',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
				),						 
		); 	
	}
	
	return $a;
}

function _filter_showonly_featured($a){
	 
	$g = $this->_check_search_query('featured');
 	
	if(isset($g['featured']) ){
	  
		$a['meta_query']['featuredonly']   = array(
					
				'featured'    => array(
								'key' 			=> 'featured',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
				),						 
		); 	
	}
	
	return $a;
}

function _filter_pagenum($a){


	$g = $this->_check_search_query('pagenum');
 	
	if(isset($g['pagenum'])){
	  		
		if(is_array($g['pagenum'])){			
			$g['pagenum'] = array_reverse($g['pagenum']);
			$num = $g['pagenum'][0];			
		}else{			
			$num = $g['pagenum'];
		}			
		$a['paged'] = $num;
	
	}
	
	return $a;
}

function _filter_cardlayout($a){


	$g = $this->_check_search_query('cardlayout');
 	
	if(isset($g['cardlayout'])){
	  		 
			$a['cardlayout'] = $g['cardlayout']; 
	
	}
	
	return $a;
}

function _filter_usersearch($a){


	$g = $this->_check_search_query('usersearch');
 	
	if(isset($g['usersearch'])){
	  		 
			$a['usersearch'] = $g['usersearch']; 
	
	}
	
	return $a;
}

function _filter_card($a){


	$g = $this->_check_search_query('card');
 	
	if(isset($g['card'])){
	  		 
			$a['card'] = $g['card']; 
	
	}
	
	return $a;
}

function _filter_perrow($a){


	$g = $this->_check_search_query('perrow');
 	
	if(isset($g['perrow'])){
	  		 
			$a['perrow'] = $g['perrow']; 	
	}
	
	return $a;
}

function _filter_search_style($a){


	$g = $this->_check_search_query('search_style');
	 
 	
	if(isset($g['search_style'])){
	  		 
			$a['search_style'] = $g['search_style']; 	
	}
 
	
	return $a;
}


function _filter_order_type($a){


	$g = $this->_check_search_query('ordertype');
 	
	if(isset($g['ordertype'])){
	  	
			$a['meta_query']["order_type"]  = array(							
				'key' => "order_id",			 
				'value' => $g['ordertype'],
				'compare'=> 'LIKE'						
			);
		 
	}
	
	return $a;
}

function _filter_order_process($a){


	$g = $this->_check_search_query('orderprocess');
 	
	if(isset($g['orderprocess'])){
	  	
			$a['meta_query']["order_process"]  = array(							
				'key' => "order_process",			 
				'value' => $g['orderprocess'],
				'compare'=> 'LIKE'						
			);	
	}
	
	return $a;
}
function _filter_dispute_status($a){


	$g = $this->_check_search_query('disputestatus');
 	
	if(isset($g['disputestatus'])){
	
		if(is_array($g['disputestatus'])){
		
			$a['meta_query']["disputestatus"]  = array(							
				'key' => "dispute_status",			 
				'value' => $g['disputestatus'],
				'compare'=> 'IN'						
			);	
			
		}else{
		  	
			$a['meta_query']["disputestatus"]  = array(							
				'key' => "dispute_status",			 
				'value' => $g['disputestatus'],
				'compare'=> '='						
			);	
		}
	}
	
	return $a;
}

function _filter_cashback_status($a){


	$g = $this->_check_search_query('cashbackstatus');
 	
	if(isset($g['cashbackstatus'])){
	
		if(is_array($g['cashbackstatus'])){
		
			$a['meta_query']["cashbackstatus"]  = array(							
				'key' => "cashback_status",			 
				'value' => $g['cashbackstatus'],
				'compare'=> 'IN'						
			);	
			
		}else{
		  	
			$a['meta_query']["cashbackstatus"]  = array(							
				'key' => "cashback_status",			 
				'value' => $g['cashbackstatus'],
				'compare'=> '='						
			);	
		}
	}
	
	return $a;
}


function _filter_order_status($a){


	$g = $this->_check_search_query('orderstatus');
 	
	if(isset($g['orderstatus'])){
	
		if(is_array($g['orderstatus'])){
		
			$a['meta_query']["orderstatus"]  = array(							
				'key' => "order_status",			 
				'value' => $g['orderstatus'],
				'compare'=> 'IN'						
			);	
			
		}else{
		  	
			$a['meta_query']["orderstatus"]  = array(							
				'key' => "order_status",			 
				'value' => $g['orderstatus'],
				'compare'=> '='						
			);	
		}
	}
	
	return $a;
}

function _filter_order_date($a){

	$g = $this->_check_search_query('orderdate1');
 	
	if(isset($g['orderdate1'])){	
	
	
		  	 if(isset($g['orderdate2'])){
			 
			 	$a['meta_query']['date'] = array(				 
					'key' => 'order_date',
					'value' => array($g['orderdate1'], $g['orderdate2']),
					'compare' => 'BETWEEN',
					'type' => 'DATETIME'
				);		
			 
			 }else{
			 
			 	$a['meta_query']['date'] = array(				 
					'key' => 'order_date',
					'value' => $g['orderdate1'],
					'compare' => '>',
					'type' => 'DATETIME'
				);
			 
			 
			 }
			
		
			
	}
	 
	return $a;
}
function _filter_sortby($a){

	$g = $this->_check_search_query('sortby');
 	
	if(isset($g['sortby']) ){
	
			// GET SORT BY VALUE
			$sortby = $g['sortby'];
			$order = "";		 			
			
			// CHECK FOR NEW ORDER STYLE
			if(strpos($sortby,"-") !== false){
				$sp = explode("-", $sortby);
				$sortby = $sp[0];
				if($sp[1] == "u"){ $order = "asc"; }else{ $order = "desc";  }
			}
			
			$a['orderby'] 	= $sortby;						
			$a['order'] 	= $order;
			
			  
			switch($a['orderby']){
				
				case "order_total": {
				
					$a['orderby'] 	= "meta_value_num";
					$a['meta_query']['order_total'] = array(				 
						'key' => 'order_total',					
						'type' => 'NUMERIC'
					);			
				
				} break;
				
				case "credit": {
				
				$a['orderby'] 	= "meta_value_num";
				$a['meta_query']["credit"]  = array(							
					'key' => "ppt_usercredit",
					'type' => 'NUMERIC',
					 						
				);
				
				} break;
				
				case "campaign_clicks": {
				
				$a['orderby'] 	= "meta_value_num";
				$a['meta_query']["campaign_clicks"]  = array(							
					'key' => "clicks",
					'type' => 'NUMERIC',
					 						
				);
				
				} break; 
				
				case "campaign_impressions": {
				
				$a['orderby'] 	= "meta_value_num";
				$a['meta_query']["campaign_impressions"]  = array(							
					'key' => "impressions",
					'type' => 'NUMERIC',
					 						
				);
				
				} break; 
				
				case "homepage": {
				
					$a['meta_query']["homepage"]  = array(							
						'key' => "homepage",
						'type' => 'NUMERIC',
						'compare'=> '=',	
						'value' => 1					
					);
		
				} break;
				
				case "sponsored": {
				
					$a['meta_query']["sponsored"]  = array(							
						'key' => "sponsored",
						'type' => 'NUMERIC',
						'compare'=> '=',	
						'value' => 1					
					);
		
				} break;
								
				case "featured": {					
					 
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' => 'featured',
								'type'    => 'NUMERIC',								 			
							),			 
							'featured1'   => array(
								'key'     => 'featured',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$a['orderby'] 	= "featured";  
					 
				
				} break;
				
				
				
				case "leads": {
				 					 
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'leads'    => array(
								'key' => 'leads',
								'type'    => 'NUMERIC',								 			
							),			 
							'leads1'   => array(
								'key'     => 'leads',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$a['orderby'] 	= "leads";  
					 
				
				} break;
				
				
								
				case "age": {
				  
					 
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'daage'    => array(
								'key' => 'daage',
								'type'    => 'NUMERIC',								 			
							),			 
							'daage1'   => array(
								'key'     => 'daage',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$a['orderby'] 	= "daage";  
					 
				
				} break;
				
				case "downloads": {
					 
					$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'download_count'    => array(
								'key' => 'download_count',
								'type'    => 'NUMERIC',								 			
							),			 
							'download_count1'   => array(
								'key'     => 'download_count',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$a['orderby'] 	= "download_count";  
					 
				
				} break; 
				
				case "verify": {		
						
				
				$a['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'ppt_verified'    => array(
								'key' => 'ppt_verified',
								'type'    => 'NUMERIC',								 			
							),			 
							'ppt_verified1'   => array(
								'key'     => 'ppt_verified',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$a['orderby'] 	= "ppt_verified";  
				
		
				} break;
				
				
				case "claimed": {
				
				$a['meta_query']["claimed"]  = array(							
					'key' => "claimed",
					
					'compare'=> '='						
				);
		
				} break;
				
				
				case "online": {
				
				$a['meta_query']["online"]  = array(							
					'key' => "online",
					'type' => 'DATETIME',
					'value' => "",
					'compare'=> '!='						
				);
				
				} break;
				
				
				
				case "lastused": {
				
					$a['meta_query']['lastused'] = array(				 
						'key' => 'lastused',					
						'type' => 'DATETIME'
					);
					
					$a['orderby'] 	= "meta_value";	
				
				} break;
								
				case "lastlogin": {
				
					$a['meta_query']['login_lastdate'] = array(				 
						'key' => 'login_lastdate',					
						'type' => 'DATETIME' 
					);
					
					$a['orderby'] 	= "login_lastdate";
					//$a['order'] = "asc";
				
				} break;
				
				case "price": {
					
					$a['orderby'] 	= "meta_value_num";
					
					if(THEME_KEY == "at"){
					$pkey = "price_current";					
					}else{
					$pkey = "price";					
					}
					
					$a['meta_query'][$pkey] = array(				 
						'key' => $pkey,					
						'type' => 'NUMERIC'
					);	 	
				
				} break;

				case "hits": {
					 
					$a['meta_query']['hits'] = array(
						
						'relation'    => 'OR',	
						
						'hits'   => array(
																 
							'key' 	=> 'hits',					
							'type' 	=> 'NUMERIC',
							
						),
						
						'hits1'   => array(
								'key' 		=> "hits",
								'type' 		=> 'NUMERIC',			 
								'compare'	=>'NOT EXISTS'												
						),	
						
						
					);
					$a['orderby'] 	= "meta_value_num";				
				
				} break;
				
				case "rating": { 
				
				
				$a['meta_query']['rating'] = array(
						
						'relation'    => 'OR',	
						
						'rating'   => array(
																 
							'key' 	=> 'starrating',					
							'type' 	=> 'NUMERIC',
							
						),
						
						'rating1'   => array(
								'key' 		=> "starrating",
								'type' 		=> 'NUMERIC',			 
								'compare'	=>'NOT EXISTS'												
						),	
						
						
					);
					 
					$a['orderby'] 	= "meta_value_num";	
				
				
				} break;
				
				case "expiry": { 
				 
					$a['meta_query']['listing_expiry_date'] = array(				 
						'key' => 'listing_expiry_date',					
						'type' => 'DATETIME'
					);
					 $a['orderby'] 	= "meta_value";	
					  
				
				} break;
				
				case "packageid": {
					
					$a['orderby'] 	= "meta_value_num";
					$a['meta_query']['packageid'] = array(				 
						'key' => 'packageID',					
						 
					);			
				
				} break;
				
				case "user_fr": {
				
				
					$a['meta_query']["usertype"]  = array(							
							'key' => "user_type",			 
							'value' => "user_fr",
							'compare'=> '='						
					); 
				
				} break;
				
				
				case "user_em": {				
				
					$a['meta_query']["usertype"]  = array(							
							'key' => "user_type",			 
							'value' => "user_em",
							'compare'=> '='						
					); 
				
				} break;				
				
				case "dateuser": {
			 
					$a['orderby'] 	= "registered";
					 
				} break;
				
				
				case "date": {
			 
					$a['orderby'] 	= "post_date";
					 
				} break;
				
				case "update": {
			 
					$a['orderby'] 	= "post_modified";
					 
				} break;
				
				case "title": {
			 
					$a['orderby'] 	= "post_title";
					 
				} break;
				
				case "id": {
			 
					$a['orderby'] 	= "ID";
					 
				} break;
				
				default: { } break;
				
			}// END SWITCH	
		 
			 
	}
	
	return $a;
}


 
 

 






/* ========================================================================
 PAGE NAVIGATION BUTTONS
========================================================================== */

 
function _filter_ajax_nav($total = 100, $perpage = 10, $current_page = 2  ) {  
  	 
 		$return = "";
		$backBtn = "";
		$forwardBtn = "";
		 
		$totalPages = ceil($total/$perpage);
		$start_page = ($current_page)-1;
		if($start_page < 1){ $start_page = 1; }		
		$end_page = $start_page+4;
		if($end_page  > $totalPages){ $end_page  = $totalPages; }
		 
			
		// PREVIOUS
		 
		if($current_page > 1 ){							
							 				
					if(isset($GLOBALS['flag-home'])){
							$link = get_home_url()."/?home_paged=".($current_page-1);
					}else{
							$link = esc_url(get_pagenum_link($current_page-1));
					}									
					$backBtn .= '<li class="page-item"><a href="javascript:void(0);" onclick="_filter_page(1)" class="page-link"><i class="fa fa-angle-left"></i></a></li>';
													
		} 		
					
		//  NUMBERS
		for($i = $start_page; $i  <= $end_page; $i++) {	
					 

						/*** build string ***/
					if($i == $current_page) {
						 
							$return .= '<li class="page-item active"><a href="javascript:void(0);" onclick="_filter_page('.$i.')" class="page-link bg-primary">'.$i.'</a></li>';
					} else {
						 
							$return .= '<li class="page-item"><a href="javascript:void(0);" onclick="_filter_page('.$i.')" class="page-link" rel="nofollow">'.$i.'</a></li>';
					}
		}
					 
		 
		 if($current_page != $totalPages){
		 
		 $forwardBtn = '<li class="page-item"><a href="javascript:void(0);" onclick="_filter_page('.$totalPages.')" class="page-link"><i class="fa fa-angle-right nomargin" aria-hidden="true"></i>
		 </a></li>';	
		 
		 }			
 
	// ADD ON STYLE WRAPPER 
	return '<ul class="pagination">'.$backBtn.''.$return.''.$forwardBtn.'</ul>';
	 
	 
}
function n_round($num, $tonearest) {  return floor($num/$tonearest)*$tonearest;}







 
 
 
	/*
		This function gets the citties from a selected country
	*/
	function search_get_cities($country, $limit=10){	global $wpdb;
 
	$SQL = "SELECT DISTINCT t1.meta_value as city FROM ".$wpdb->postmeta." 

				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( ".$wpdb->postmeta.".post_id = t1.post_id AND t1.meta_key = 'map-city')
			 
				WHERE ".$wpdb->postmeta.".meta_key = 'map-country' AND ".$wpdb->postmeta.".meta_value = '".$country."'  LIMIT ".$limit;	
 

	$cities = array();

	$posts = $wpdb->get_results($SQL);	 

	foreach($posts as $post){ 
	
		$cities[] = $post->city;

	} 
 
	return $cities;	 
 
	}
 
	/*
		This function displays the most
		popular searches with links
	*/
	function search_popular_searches($limit=10, $type = 1){ $STRING = "";
	
		$saved_searches_array = get_option('recent_searches');
		if(is_array($saved_searches_array) && !empty($saved_searches_array)){
		
		$ss = array_reverse( $this->multisort( $saved_searches_array, array('views') ), true );
		$i =0;
		foreach($ss  as $key => $searchdata){ 
		if($i > $limit){ continue; }
		
		$term = esc_attr(str_replace("_"," ",$key));
		
		
		if($type == 2){
		
		$STRING .= "<li><a href='" . home_url(). "/?s=" . $term . "'>".substr(stripslashes($term),0,20)."</a></li>";
		
		}else{
		
		$STRING .= "<a href='" . home_url(). "/?s=" . $term . "'>".substr(stripslashes($term),0,20)."</a>";
		
		}
		
		$i ++;
		}
	}
	
	return $STRING;
	}
	
 
	

/* =============================================================================
	 CORE ITEM DISPLAY SETTINGS
	========================================================================== */
 
 
	// LET USERS EDIT THEIR OWN POSTS
	function ppt_edit_own_caps() {  global $userdata;
 		
		 // ADD ON TAG SUPPORT
		register_taxonomy_for_object_type('post_tag', THEME_TAXONOMY.'_type');
			
		if(isset($userdata->ID) && $userdata->ID > 0){
			// gets the author role
			$role = get_role( 'subscriber' );
			$role->add_cap( 'edit_posts' ); 
			//upload_files ??
		}
	} 
	// SETS THE DEFAULT SEARCH QUERY TO POSATIVE IF NO SEARCH KEYWORD IS ENTERED
	function my_request_filter( $query_vars ) {
	 
	 	if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
			$query_vars['s'] = " ";
		}
		return $query_vars;
	}
	
  
	// USED FOR NORMAL SEARCHES
	function _posts_distinct( $where ) {
		global $wpdb;
	
		if ( is_search() ) {
			return "DISTINCT";
		}
	
		return $where;
	}
	
	


 
	
} // end class

?>