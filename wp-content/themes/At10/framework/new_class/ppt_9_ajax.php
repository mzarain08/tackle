<?php
 
class framework_ajax extends framework_email {
 
 
 
function _ajax_actions(){ global $CORE, $wpdb, $userdata; 
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['invoiceid']) && is_numeric($_GET['invoiceid'])){
 
_ppt_template( 'forms/invoice' );

die();


}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



	if(isset($_POST['doc_action'])){	
	 	
		switch($_POST['doc_action']){
			
			case "load_page": { 
			
				_ppt_template('framework/docs/'.$_POST['page'] );
				die();
				
			} break;
		
		}
	
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 	
	if(isset($_POST['elementor_action'])){	
	 	
		switch($_POST['elementor_action']){
		
			case "load_ipdata": {
			
				$response = $CORE->GEO("get_user_geo_data", 0);
				
				header('Content-type: application/json; charset=utf-8');
				die($response);	
			
			} break;
		
			
			case "load_ppt_templates": {
			
				$tid = 0; $cat = 0; $response = "";
				if(isset($_POST['template_id'])){ 
					$tid = $_POST['template_id'];
				}
				if(isset($_POST['cat'])){ 
					$cat = $_POST['cat'];
				}
		 
				$request = array(
						'slug' 			=> strtoupper(THEME_KEY),
						'version' 		=> THEME_VERSION,
						"theme_key" 	=> strtoupper(THEME_KEY),
						'email' 		=> get_option('admin_email'),
						'theme_lic' 	=> get_option("ppt_license_key"),	
						'theme_url' 	=> esc_url( home_url() ),						
				);
				$send_for_check = array(
					'body' => array(
						'action' 		=> $_POST['call'], 
						'template_id' 	=> $tid,
						'cat' 			=> $cat,
						"theme_key" 	=> strtoupper(THEME_KEY),
						'request' 		=> serialize($request),
						'api-key' 		=> md5(esc_url( home_url() ))
					),
					'user-agent' 		=> 'WordPress' . esc_url( home_url() )
				); 
				 	
				// EXECUTE 
				$raw_response = wp_remote_post(ELE_PATH, $send_for_check); 
				 
				if( !is_wp_error( $raw_response ) && ($raw_response['response']['code'] == 200) ) {
				
					$response = $raw_response['body'];
						 
				}
				
				header('Content-type: application/json; charset=utf-8');
				die($response);	
			
			} break;
			
			case "load_default_data": {  
			// removed 
			} break;
			
			case "load_preview": { 
			// removed
			} break;
			
			case "load_blocks": {
			// removed
			} break;
			
			case "load_layouts": {
			// removed
			} break; 
			
		}
		
		die();
	}
	

	if(isset($_POST['search_action'])){	
	 	
		switch($_POST['search_action']){
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			case "search_live":{
		 
				if(isset($_POST['search'])){
				 
  					
					$ar = array(); global $wpdb;
					
					
						$SQL = "SELECT ".$wpdb->prefix."terms.term_id, ".$wpdb->prefix."terms.name, ".$wpdb->prefix."terms.slug FROM ".$wpdb->prefix."terms 
						INNER JOIN ".$wpdb->prefix."term_taxonomy AS m1 ON (m1.term_id = ".$wpdb->prefix."terms.term_id AND m1.taxonomy = 'listing')
						 WHERE ".$wpdb->prefix."terms.name LIKE ('%".esc_attr($_POST['search'])."%') LIMIT 10 ";	 
						$result = $wpdb->get_results($SQL);
						if ( $result ) { 
						
							$ar['mylist'][] = array(
									'id' 		=> "",  
									'name' 		=> __("Popular categories;","premiumpress"), 
									'img' 		=> "", 
									'link' 		=> "#",
									'text' 		=> "",
						); 
						
							foreach ( $result as $data ) {	 
							
							try{
								
								$link = get_term_link( $data->slug, "listing");
							   
							} catch (Exception $ex) {
							
								$link = "";
							
							}
							 
							
							if($link != ""){
							
							
							$ar['mylist'][] = array(
									'id' 		=> "",  
									'name' 		=> $data->name, 
									'img' 		=> "",  
									'link' 		=> $link, 
									'text' 		=> "",
								 ); 
							
							}
							
							
							}
						}				
					 
					
					
					
					$tags = get_terms("post_tag", array('number' => 45, 'orderby' => 'count', 'order' => 'desc'));
					if (!empty($tags)) { 
					
							$ar['mylist'][] = array(
									'id' 		=> "",  
									'name' 		=> __("Popular keywords..","premiumpress"), 
									'img' 		=> "", 
									'link' 		=> "#",
									'text' 		=> "",
						); 
				
							foreach( $tags as $tag){
						
							 
								$ar['mylist'][] = array(
									'id' 		=> "",  
									'name' 		=> $tag->name, 
									'img' 		=> "",  
									'link' 		=> home_url()."/?s=".$tag->name, 
									'text' 		=> "",
								 ); 
							}
					
						}
					 
					
					if(isset($GLOBALS['ppt_makes']) && defined('THEME_KEY') && THEME_KEY == "dl" ||  _ppt(array('lst','makemodels')) == '1'){
					
						require_once get_template_directory() ."/framework/data/_makes.php";
					 
	
							$list = $GLOBALS['ppt_makes'];
							$data = array();
							foreach($list as $k => $m){ 
							 		
								if(strpos(strtolower($m), strtolower($_POST['search'])) !== false){
								
									 $ar['mylist'][] = array(
										'id' 	=> 0, 
										'name' 	=> $m, 
										'img' 	=> "",
										'link' 	=> home_url()."/?s=&make=".str_replace(" ","",strtolower($m)), 
										'text' 	=> "",
									 ); 
								
								} 
							}
						 
					
					} 
					
					/*
					
					if(is_numeric($_POST['search'])){
					$args = array('post_type' => 'listing_type', 'paged'  => 1, 'p' =>  $_POST['search']  );
					}else{
					$args = array('posts_per_page' => 8, 'post_type' => 'listing_type', 'orderby' => 'name', 'order' => 'asc', 'paged'  => 1, 's' => esc_html($_POST['search']) );
					}
					
					
					if(defined('WLT_DEMOMODE')){
					$_POST['search'] = "";
					}
					*/
					// SOTRE SEARCH
					if(THEME_KEY == "cp"){
					
						
						$args = array(
							'taxonomy'      => array( 'store' ), 
							'orderby'       => 'id', 
							'order'         => 'ASC',
							'hide_empty'    => true,
							'fields'        => 'all',
							'name__like'    => $_POST['search']
						); 
						
						$terms = get_terms( $args );
						$count = count($terms);
						 if($count > 0){		
						 	$stop = 0;					
							 foreach ($terms as $term) {
							 	
								if($stop > 8){ continue; }
							 
								 $ar['mylist'][] = array(
									'id' => $term->term_id, 
									'name' => $term->name, 
									'img' => "", //do_shortcode('[STOREIMAGE id="'.$term->term_id.'"]'), 
									'link' => get_term_link( $term ), 
									'text' => "",
								 ); 
								 
								 $stop++; 
						
							 }							
						 }

					}
					
					/*
					if(empty($ar)){
					 
					 
							$custom_query = new WP_Query( $args );	
							 			 
							if ( $custom_query->have_posts() ) :
							while( $custom_query->have_posts() ) : $custom_query->the_post(); 
							 
							if(in_array($custom_query->post->post_type, array("post","page"))){							
							continue;
							}
							
							$name = get_the_title();
							if(is_numeric($_POST['search'])){
							$name = get_the_title()." (LOT ".$_POST['search'].")";
							}
							
							$ar['mylist'][] = array(
								'id' => $custom_query->post->ID, 
								'name' => $name, 
								'img' => "", //do_shortcode('[IMAGE post_id="'.$custom_query->post->ID.'" link=0 pathonly=1]'), 
								'link' => get_permalink($custom_query->post->ID), 
								'text' => "",
							 );  
							
							endwhile; endif;
					
					}*/
					 
					echo json_encode($ar);
					die();
				}
			
			} break;
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

				case "search": {	
				 	 	
					global $settings;
					
					// DEFAULT 
					$wrap_1 = "";
					$wrap_2 = "";
					$pagenav = "";
					$args = array();  
					 
					// CLEAN SETITNGS GOBAL
					if( is_object($settings) ){
						unset($settings); 
						$settings = array();
					}
					 
					
					// MONITOR
					$time_start = microtime(true); 
					
					// CUSTOM  TAXONOMIES				 
					$CORE->custom_taxonomies();
					
					// SHOW EXPIRED IN SEARCH RESULTS
					if(!is_admin() && _ppt(array("search","showexpired")) == 1){
					
						$ps = array('publish','expired'); //, 'pending','pending_approval','payment'
						
					}else{
					
						$ps = array('publish');
					}
				 	
					// GET FIILTER QUERY
					$args = apply_filters( 'ppt_query_args',  array('paged' => 1, 'post_type'=> 'listing_type','posts_per_page' => 2, 'post_status' => $ps )  );					
					
					if(isset($args['tax_query']) && !empty($args['tax_query']) ){
					$settings['tax'] = $args['tax_query'];
					}
					
					
					
					
					// SAVE DATA FOR ANALYTICS
					//$CORE->saveSearchData($args); 
	 
					//die(print_r($args));
					// ORDER BY
					//$args['orderby'] = "date";
					//$args['order'] = "desc"; 
					
					if(!isset($args['cardtype'])){
						$args['cardtype'] = "search";					
					} 
					
					
					
					
					
					
					if(isset($args['cardlayout']) && in_array($args['cardlayout'],array("list","grid")) && in_array(THEME_KEY,array("at","pj")) ){
					if(!isset($args['meta_query'])){ $args['meta_query'] = array(); }
					
					$args['meta_query'] = array_merge($args['meta_query'],  
						array(  
							'expiry_date'   =>  
							array( 
								'key' => "listing_expiry_date",
								'compare' => '>=',
								'value' => current_time( 'mysql' ),
								'type' => 'DATETIME'	
							),					  
						)
					);
					
					}
					
					// SHOW FAVS
					$g = $CORE->_check_search_query('favorites'); 	
					if(isset($g['favorites']) ){
					$args['post_status'] = array("publish","expired");
					}
					 
					
					if(!isset($args['card'])){
						$args['card'] = "";					
					}
					
					// PER PAGE					
					if(isset($args['perpage']) && is_numeric($args['perpage']) ){						
						$args['posts_per_page'] = $args['perpage'];
					}
					
					// PER ROW
					if(!isset($args['perrow'])){
						$args['perrow'] = 3;							
						//_ppt(array('searchcustom', 'perrow'))				
					}
					  
					// CARD 					
					if(isset($args['card']) && $args['card'] != ""){						
						$settings['card'] = $args['card'];
					}					
					 
					// PAGED
					if(!isset($args['paged']) || isset($args['paged']) && $args['paged'] == ""){ 
						$args['paged'] = $args['pagenum'];					
					}
					 
					// QUERY WHICH POST TYPE
					if(function_exists('current_user_can') && current_user_can('administrator') ){
						switch($args['cardtype']){						
							case "admin-cashout": { 	$args['post_type'] = "ppt_cashout"; } break;  
							case "admin-dispute": { 	$args['post_type'] = "ppt_dispute"; } break;  
							case "admin-cashback": { 	$args['post_type'] = "ppt_cashback"; } break;
							case "admin-news": { 		$args['post_type'] = "ppt_news"; } break;
							case "admin-order": { 		$args['post_type'] = "ppt_orders"; } break;
							case "admin-log": { 		$args['post_type'] = "ppt_logs"; } break;
							case "admin-newsletter": { 	$args['post_type'] = "ppt_newsletter"; } break;
							case "admin-advertising": { $args['post_type'] = "ppt_campaign"; } break;	
							case "admin-banner": { 		$args['post_type'] = "ppt_banner"; } break;
							case "admin-comments": {   } break;	
						}
					} 
					
					 	 	
					// QUERY CHANGES
					
					if($args['cardtype'] == "admin-comments" && function_exists('current_user_can') && current_user_can('administrator') ){
						
						$nargs = array(); 
						$nargs['number'] = 50; 
						if(isset($args['posts_per_page']) && strlen($args['posts_per_page']) > 1){
						$nargs['number'] = $args['posts_per_page']; 
						} 
						
						$wp_custom_query = new WP_Comment_Query($nargs);
						$totalfound = count($wp_custom_query->comments); 
						
						$result = 100; //count_comments();
					    
					
					}elseif( isset($args['usersearch']) ){ //
					 
						$args['number'] = 20;
						  
						$wp_custom_query = new WP_User_Query($args);
						$result = count($wp_custom_query->results);
						$cc = count_users(); 
						
						if($result < 20){						
							$totalfound = $result;						
						}else{
							$totalfound = $cc['total_users'];
						}
						
					
					}elseif($args['cardtype'] == "admin-user" && function_exists('current_user_can') && current_user_can('administrator')  ){ //
					 
						$args['number'] = 10;
						 
						$wp_custom_query = new WP_User_Query($args);
						$result = count($wp_custom_query->results);
						$cc = count_users(); 
						
						if($result < 10){						
							$totalfound = $result;						
						}else{
							$totalfound = $cc['total_users'];
						}					 
						 					 
					   
					}else{
					 				
						$wp_custom_query = new WP_Query($args); 
						$totalfound = $wp_custom_query->found_posts;
					
					}
				 	 
	 			
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
					// COUNT EXISTING LISTINGS 
					$tt = $wpdb->get_results($wp_custom_query->request, OBJECT);
					$SQLBACKUP = $wp_custom_query->request;
					 
					// BUILD CARD OUTPPUT
					if(isset($args['cardtype'])){
					switch($args['cardtype']){
											  
						  	case "admin-advertising": {							
								$card_name = 'framework/admin/parts/card-advertising';							
							} break;							
							case "admin-banner": {							
								$card_name = 'framework/admin/parts/card-banner';							
							} break;							
							case "admin-newsletter": {							
								$card_name = 'framework/admin/parts/card-newsletter';								
							} break;						  
						  	case "admin-listing": {							
								$card_name = 'framework/admin/parts/card-listing';								
							} break;							
							case "admin-log": {							
								$card_name = 'framework/admin/parts/card-log';								
							} break;							
						  	case "admin-order": {							
								 $card_name = 'framework/admin/parts/card-order';								
							} break;	
							case "admin-cashout": {							
								 $card_name = 'framework/admin/parts/card-cashout';								
							} break;	
							case "admin-dispute": {							
								 $card_name = 'framework/admin/parts/card-dispute';								
							} break;
							
							case "admin-cashback": {							
								 $card_name = 'framework/admin/parts/card-cashback';								
							} break;	
							case "admin-news": {							
								 $card_name = 'framework/admin/parts/card-news';								
							} break;											
						  	case "admin-user": {							
								 $card_name = 'framework/admin/parts/card-user';								
							} break;	
							case "admin-comments": {							
								 $card_name = 'framework/admin/parts/card-comments';								
							} break;						
							case "search": {
							
								$card_name = 'content-listing'; 
								
								if(isset($args['cardlayout']) && in_array($args['cardlayout'],array("list","list-account"))){
								 
								$settings['card'] = "list";
								
								if($args['cardlayout'] == "list-account"){ $settings['accountpage'] = 1234; }
								 
								$wrap_1 = '<div class="col-12 col-md-12 col-lg-12 listview">';
								
								if(!in_array(THEME_KEY,array("cp"))){
								$wrap_1 = '<div class="col-6 col-sm-12 col-lg-12 listview">';
								}
								
								$wrap_2 = '</div>'; 
								
								
								if(in_array(_ppt(array('searchcustom', 'mobileperrow')),array("1"))){
									$wrap_1 = str_replace("col-6","col-12", $wrap_1);
								}
								
								}else{
									
									$settings['card'] = "blank";
								  	
									if($args['perrow'] == "5"){
									
										$wrap_1 = '<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-lg-5ths perrow5">';
										$wrap_2 = '</div>';
									
									}elseif($args['perrow'] == "4"){
									
										$wrap_1 = '<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 perrow4">';
										$wrap_2 = '</div>';
										
									}else{
										$wrap_1 = '<div class="col-12 col-sm-6 col-md-4 col-lg-4 perrow3">';
										$wrap_2 = '</div>';	
									
									}	
									 
									
									if(in_array(_ppt(array('searchcustom', 'mobileperrow')),array("2",""))){
									$wrap_1 = str_replace("col-12 col-sm-6","col-6 col-sm-6", $wrap_1);
									}
									
																
								}
								
								
								// USER
								
								if( isset($args['usersearch']) ){
								
									$card_name = 'content-listing-user'; 
									
									$settings['card'] = "grid";
									if($args['cardlayout'] == "list"){
										$settings['card'] = "list";
									}
									 
								}
								 
							} break;							
					}
					}
$saved_args = $args;
$GLOBALS['ajax_search'] = 1;
					
					
$output_sponsor = "";	$alreadyShwon = array();
 
					
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	 				
					
					// START OUTPUT
					ob_start();		
								
					if(!empty($tt)){						
						$counter = 1;	
						foreach($tt as $p){	 global $post;
						 
						 
						// HACK FOR DISTANCE ADDON
						if(isset($p->distance)){							
							$GLOBALS['distance_value'] = $p->distance;								 
							$g = $CORE->_check_search_query('radius'); 	
							if( isset($g['radius']) && $g['radius']  > 0 &&  round($p->distance,0) > round($g['radius'],0)   ){
							 	$totalfound--;
								$counter++;	
								continue;							
							} 
						}
						 if( isset($args['usersearch']) ){
						 
						 	$post = get_userdata($p->ID);
											
						}elseif(isset($args['cardtype']) && $args['cardtype'] == "admin-user" ){
						 
						 	$post = get_userdata($p->ID);
						
						 }elseif(isset($args['cardtype']) && $args['cardtype'] == "admin-comments" ){
						   	
							if(isset($p->comment_ID)){
							$post = get_comment($p->comment_ID);
							}else{
							$post = 0;
							}
						 	
						 	 
						 }elseif(isset($args['cardtype'])){
						 
							 $post = get_post($p->ID);							 
							 if(in_array($p->ID,$alreadyShwon)){
							 continue;
							 }						 
						 }
						 
						if($counter == 1){ 
						
							if(!isset($args['cardtype'])){ $args['cardtype'] = ""; }							
							if($args['cardtype'] == "admin-order" || $args['cardtype'] == "admin-listing" || $args['cardtype'] == "admin-user" ){
							}else{
							echo '<div class="row">';
							}
						} 
						
						 
						// TOP BANNER
						if(isset($GLOBALS['ajax_perrow']) && $counter == $CORE->LAYOUT("default_perpage_sponsored",$GLOBALS['ajax_perrow'])+1 ){ 
						echo $CORE->ADVERTISING("display_banner", "search_middle" );  
						}
						
						echo $wrap_1;				
						_ppt_template($card_name);	
						echo $wrap_2;
						
						$counter++;										
						}						
					}
					// MAIN LISTING OUTPUT
					$output = ob_get_contents();ob_end_clean();					
					
					 // FOOTER
					if($saved_args['cardtype'] == "admin-order" || $saved_args['cardtype'] == "admin-listing"  || $saved_args['cardtype'] == "admin-user" || $saved_args['cardtype'] == "admin-comments" ){
												 
					}else{
					$output .= '</div>';
					}	
					
					// CHECK FOR OUTPUT DATA ERROR
					if(strlen($output) < 20){
						$totalfound = 0;
					}
					
					//////////////////////////// -- ONLY DO ADDON DATA IF OUTPUT IS BIGGER THAN 0
					if(strlen($output) > 0){
					 
						ob_start();
							
							// TABLE STYLE FOOTER					
							if($totalfound >  $saved_args['posts_per_page']){
												
								$pagenav = $CORE->_filter_ajax_nav($totalfound, $saved_args['posts_per_page'], $saved_args['paged'] );
							} 					 
				 	
					 
							if(in_array($card_name, array("content-listing" )) && _ppt(array('search','count')) != 1 && $totalfound < 150 ){	
							 
							// BUILD A NEW SEARCH QUERY WITH MORE RESULTS AND USE THESE
							// TO SETUP THE COUNTER STATS
							$newquery = explode("LIMIT", $wp_custom_query->request);	
							 		
							$xx = $wpdb->get_results($newquery[0]." limit 150", OBJECT);
							if(!empty($xx)){
							
								$taxonomies = get_taxonomies(); 
								foreach($xx as $c){
								
									$catID = "";
									
									$ThisPostID = $c->ID;
								
									  // GET CATID
									  $catID = "";
									  $cat =  wp_get_object_terms( $ThisPostID , THEME_TAXONOMY );
									   
									  if(is_array($cat)){
										foreach($cat as $k => $v){
										
											if($v->parent !=0){
											$catID .= "listing-".$v->parent." ";	
											}
											
											$catID .= "listing-".$v->term_id." ";					
										}
										
										
									  }
									  
									  // GET TAX 
									  if(is_array(_ppt('searchtax'))  ){		
									  
														
										  foreach ( $taxonomies as $taxonomy ) {  	
													  
											 // if( _ppt(array("searchfilter","tax_".$taxonomy)) == 1){	
											    								  							  
												  $tax = wp_get_post_terms( $ThisPostID, $taxonomy );										
												  if(is_array($tax)){
													  foreach($tax as $k => $v){
														 $catID .= $taxonomy."-".$v->term_id." ";	
																	
													  }
												  }
											  //} 
										  } 
									  }
									  
									  // DATE INTO (A/B/C/)
									  //$vv = $CORE->date_timediff($map->post_date);	      	
									  if(isset($vv['date_array']["".__('Years',"premiumpress").""]) && $vv['date_array']["".__('Years',"premiumpress").""] > 0){
									  $dID = "date-t5";							  
									  }elseif(isset($vv['date_array']["".__('years',"premiumpress").""]) && $vv['date_array']["".__('years',"premiumpress").""] > 0){
									  $dID = "date-t5";								
									  }elseif(isset($vv['date_array']["".__('Months',"premiumpress").""]) && $vv['date_array']["".__('Months',"premiumpress").""] > 0){
									  $dID = "date-t4";							  
									  }elseif(isset($vv['date_array']["".__('months',"premiumpress").""]) && $vv['date_array']["".__('months',"premiumpress").""] > 0){
									  $dID = "date-t4"; 							  
									  }elseif(isset($vv['date_array']["".__('Days',"premiumpress").""]) &&  $vv['date_array']["".__('Days',"premiumpress").""] > 0){
									  $dID = "date-t3";							  
									  }elseif(isset($vv['date_array']["".__('days',"premiumpress").""]) &&  $vv['date_array']["".__('days',"premiumpress").""] > 0){
									  $dID = "date-t3";							  
									  }elseif(isset($vv['date_array']["".__('Hours',"premiumpress").""]) &&  $vv['date_array']["".__('Hours',"premiumpress").""] > 0){ 
									  $dID = "date-t2";							  
									  }elseif(isset($vv['date_array']["".__('hours',"premiumpress").""]) &&  $vv['date_array']["".__('hours',"premiumpress").""] > 0){ 
									  $dID = "date-t2";							  
									  }else{
									  $dID = "date-t1";
									  }
									  
									?><div class="addondata <?php echo $catID; ?> <?php echo $dID; ?>"></div><?php 
								
								}
								}
						} 
						
						
						
						$output .= ob_get_contents();ob_end_clean(); 
					
					} 
					unset($GLOBALS['ajax_search']);
					
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

				
				//print_r($saved_args);
				//echo $wp_custom_query->request;
			 	//die();
					 
					
					
					// REMOVE LAZYLOAD
					$output = str_replace("data-src","src", str_replace("img-fluid lazy","img-fluid", $output ) );
					$output_sponsor = str_replace("data-src","src",  str_replace("img-fluid lazy","img-fluid", $output_sponsor ) );
					
					// MONITOR
					$time_end = microtime(true);
					$execution_time = ($time_end - $time_start)/60;
					
					if(!isset($saved_args['posts_per_page'])){ $saved_args['posts_per_page'] = 12; }
					
					// PAGES
					$totalPages = ceil($totalfound/$saved_args['posts_per_page']);	
					
					// REPORT AJAX
					header('Content-type: application/json; charset=utf-8');
					
					$output = $output;
					
					// HIDE SQL
					$ARGSBACKUP = $args;
				 	if(!current_user_can('administrator')){
					$SQLBACKUP = "";
					$ARGSBACKUP = "";
					}
					
					//die($SQLBACKUP);
					
					
					// LOCATION ADD-ON
					$location_output = "";
					if(isset($GLOBALS['search_google_address']) && $GLOBALS['search_google_address'] != ""){
						$location_output = array(
						"address" 	=> $GLOBALS['search_google_address'], 
						"lat" 		=> $GLOBALS['search_google_lat'], 
						"long" 		=> $GLOBALS['search_google_long'],
						"radius" 	=> $GLOBALS['search_google_radius'],
						);
					} 
					
					die(json_encode(array(
					"status" 	=> "ok", 
					"total" 	=> number_format($totalfound), 
					"sponsor" 	=> $output_sponsor,
					"output" 	=> $output,
					"pagenav" 	=> $pagenav,
					"location"  => $location_output,
					"page" 		=> $saved_args['paged'],
					"pageof" 	=> $totalPages,
					"sql" 		=> $SQLBACKUP,
					"args" 		=> $ARGSBACKUP,
					"time" 		=> $execution_time." Mins"), JSON_PARTIAL_OUTPUT_ON_ERROR )); //JSON_PARTIAL_OUTPUT_ON_ERROR
		
				
				} break;
		}
	}


 


	/// SET USER LOCATION
	if(isset($_POST['updatemylocation'])){				
		$_SESSION['mylocation']['log'] = strip_tags($_POST['log']);
		$_SESSION['mylocation']['lat'] = strip_tags($_POST['lat']);
		$_SESSION['mylocation']['zip'] = strip_tags($_POST['zip']);
		$_SESSION['mylocation']['country'] = strip_tags($_POST['country']);
		$_SESSION['mylocation']['address'] = strip_tags($_POST['myaddress']);
	}

 

		// CUSTOM COMMENTS SHORTCODE
		if(isset($_POST['commentsform']) && isset($_POST['pid']) && is_numeric($_POST['pid']) && $userdata ){
		 
		
			
			if(strlen($_POST['comment']) > 0 ){
		 	 
			 
			$time = current_time('mysql');	
			$data = array(
				'comment_post_ID' => $_POST['pid'],
				'comment_author' => $userdata->display_name,
				'comment_author_email' => 'admin@admin.com',
				'comment_author_url' => 'http://',
				'comment_content' => strip_tags($_POST['comment']),
				'comment_type' => '',
				'comment_parent' => 0,
				'user_id' => $userdata->ID,
				'comment_author_IP' => $this->get_client_ip(),
				'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
				'comment_date' => $time,
				'comment_approved' => 0,
			);
			
			wp_insert_comment($data);			 
			
			}
		
		}


	//CHECK FOR OUTBOUT LINKS
	if(strpos($_SERVER['REQUEST_URI'], "/verifyme/") !== false) {	
	
			$bb = explode("verifyme/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
			
			if(is_numeric($bb1[0])){
				
				// UPDATE ACCOUNT
				update_user_meta($bb1[0],'ppt_verified',1);	 
				
				// CHECK FOR USER SAVED PASSWORD FOR AUTO LOGINS
				$getpass = get_user_meta($bb1[0],'password_saved', true);
				 
				if(strlen($getpass) > 1){
					// DELETE PASSWORD
					delete_user_meta($bb1[0],'password_saved');
					// LOGIN
					$errors = $this->USER_LOGIN($CORE->USER("get_username", $bb1[0]), $getpass, 1);					
				} 
				
				// GET REDIRECT LINK	
				$link = _ppt(array('links','myaccount'));				
							
				if(strlen($link) > 3){
				
				// REDIRECT				 
				header("location:".$link, true ,301);
				exit;
				
				}else{
				
				echo "<h1>".__("Email Verified Successfully","premiumpress")."</h1>";
				echo "<p>".__("Thank you.","premiumpress")."</p>";
				echo "<p><a href='"._ppt(array('links','myaccount'))."'>".__("Go to my account.","premiumpress")."</a></p>";
				die("");
				
				
				}
				
				
			
			}
			
	}elseif(strpos($_SERVER['REQUEST_URI'], "/pptstore/") !== false) {
	
	$bb = explode("pptstore/",$_SERVER['REQUEST_URI']);
	$bb1 = explode("/",$bb[1]);
	
	if(strlen($bb1[0]) > 1){
	
	
		// STORE CREATED IN AN ARRAY	 
		include(get_template_directory() ."/framework/data/_stores.php");
		$storesList = $GLOBALS['_list_stores'];
		
		

		$hide_stores = _ppt(array('storedata', 'hide'));
		$hide_stores_data = explode(",",$hide_stores);
		if(in_array(filterme($bb1[0]), $hide_stores_data)){
		die("");
		}
		
		$storedata =  array(); 
		foreach($storesList as $key => $data){		 
		 
			if(filterme($bb1[0]) == filterme($key) ){
			  
				if(is_array($data)){
					foreach($data as $dk => $d){
						$storedata[$dk] = $d;
					}
				}			 
			}
		}
	 	 
		// INSET TERM		
		$parent_term = term_exists( $bb1[0], 'store' ); // array is returned if taxonomy is given
		if(empty($parent_term)){
		
			$desc = "";
			if(isset($storedata['desc'])){
			$desc = $storedata['desc'];
			}
			
			$name = $bb1[0];
			if(isset($storedata['name'])){
			$name = $storedata['name'];
			}
		
			$t = wp_insert_term(
				$name,   // the term 
				'store', // the taxonomy
				array(
					'description' => $desc,
					//'slug'        => 'apple',
					//'parent'      => $parent_term_id,
				)
			); 
			
			if(is_wp_error( $t )){			
				 
			}elseif(is_object($t)){
				$storeID = $t->term_id; 
			}elseif(is_array($t)){
				$storeID = $t['term_id']; 
			}		
			
			// EXTRAS
			if(is_array($storedata) && !empty($storedata)  && isset($storeID) ){
				
				$newdata =  array();
				
				if(isset($storedata['img'])){				 
					$newdata['storeimage_'.$storeID] = stripslashes($storedata['img']);
				}
				if(isset($storedata['desc']) ){				 
					$newdata['category_description_'.$storeID] = stripslashes($storedata['desc']);
				}
				if(isset($storedata['url'])){				 
					$newdata['storelink_'.$storeID] = stripslashes($storedata['url']);
				}
				if(isset($storedata['affurl'])){				 
					$newdata['storelinkaff_'.$storeID] = stripslashes($storedata['affurl']);
				}
				if(isset($storedata['address'])){				 
					$newdata['storeaddress_'.$storeID] = stripslashes($storedata['address']);
				}
				if(isset($storedata['facebook'])){				 
					$newdata['storefb_'.$storeID] = stripslashes($storedata['facebook']);
				}
				if(isset($storedata['email'])){				 
					$newdata['storeemail_'.$storeID] = stripslashes($storedata['email']);
				}
				if(isset($storedata['phone'])){				 
					$newdata['storephone_'.$storeID] = stripslashes($storedata['phone']);
				}
			 
				// GET THE CURRENT VALUES		 
				$existing_values = get_option("core_admin_values");				 
				$new_result = array_merge((array)$existing_values, $newdata);
				update_option( "core_admin_values", $new_result, true);	
			
			}// end extras
			
		}elseif(!empty($parent_term)){
		
			$storeID = $parent_term['term_id'];
			 
		}
		
		// CREATE 5 RANDOM CODES
		if(THEME_KEY == "cp" && defined('WLT_DEMOMODE') && isset($storeID) && is_numeric($storeID)  ){
			$g =1;
			$randomeTitle = array(
				1 => "20% Off Black Friday Sale", 
				2 => "Free Shipping with this coupon code", 
				3 => "50% when you shop in store today",
				4 => "Buy One get One Free Between 3pm and 6pm.",
				5 => "Save 35% on purchased over $50",
				6 => "Enjoy Free Shipping on orders over $100",
				7 => "Buy Now Deliver Tomorrow with this coupon code.",
				8 => "Up to 15% Off When You Join Newsletter",
				9 => "Up to 33% Off Selected Bikes",
				10 => "30% Off When you buy Two",
				11 => "Up to 33% Off Selected Items",
				12 => "Up to $20 Off Sale Items", 
				13 => "20% Off With in-store pick-pp", 
				14 => "Free Shipping with this coupon code", 
				15 => "50% when you shop today",
				16 => "Buy One get One Free Between 3pm and 6pm.",
				17 => "Save 35% on purchased over $50",
				18 => "Enjoy Free Shipping on orders over $100",
				19 => "Buy Now Deliver Tomorrow with this coupon code.",
				20 => "Up to 15% Off Selected Sale Items", 
			); 
			while($g < 5){ 
			
				$my_post['post_title'] 		= str_replace("%s","",$randomeTitle[rand(1,20)]);
				$my_post['post_type'] 		= "listing_type";
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_category'] 	= "";
				$my_post['post_content'] 	= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.";	
				$my_post['tags_input'] 		= array(); 
				$POSTID 					= wp_insert_post( $my_post );
				wp_set_post_terms( $POSTID, $storeID, "store" );
				
				// RANDOM CATEGORY
				$max = 5; //number of categories to display
				$terms = get_terms('taxonomy=listing&orderby=name&order=ASC&hide_empty=0');
				
				// Random order
				shuffle($terms);
				
				// Get first $max items
				$terms = array_slice($terms, 0, $max);
				
				// Sort by name
				usort($terms, function($a, $b){
				  return strcasecmp($a->name, $b->name);
				});
				
				// Echo random terms sorted alphabetically
				if ($terms) {
				  $cats = array();
				  foreach($terms as $term) {					 
					array_push($cats,$term->term_id);
				  }
				}
				wp_set_post_terms( $POSTID, $cats, "listing" ); 
				
				
				
				$codes = array("WELCOME2022","XMASSALE","SAVE10","SAVE20","FREEBIE","BIGSAVER");
					$data = array( 
							"code" 			=> $codes[$g],	
							"hits" 			=> rand(0,10000), 							
							"buy_link" 		=> "https://www.premiumpress.com",
							"verified" 		=> 1,								
							"listing_expiry_date" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".rand(1, 30)." days") ),
							
							"image" => "?imgid=".$g,
				);
				
				foreach($data as $dk => $d){
					update_post_meta($POSTID, $dk, $d );
				}
				
				
				$terms = get_terms( array(
					'taxonomy' => 'ctype',
					'hide_empty' => true,
					'number' => 1,				 
					'search' => "coupon",				 
				));
				wp_set_post_terms( $POSTID, array($terms[0]->term_id), "ctype" ); 
				
				
				 
			$g++;
			}
		}
		
		
		// REDIRECT
		if(is_numeric($storeID)){ 
		
			$t = get_term_by('id', $storeID, 'store'); 
			$link = get_term_link( $t, "store"); 
			
			if( !is_wp_error( $link ) ) {
				header("location: ".$link);
				die();
			}else{
				die( $link->get_error_message()." -- ".$storeID);			
			}
		 
		} 
	
		die();
	
	}
	
			
	}elseif(strpos($_SERVER['REQUEST_URI'], "/outtax/") !== false) {	
		 
			$bb = explode("outtax/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
			
			 			
			if(is_numeric($bb1[0])){
			  
				// GET LIST
				$link = _ppt('storelinkaff_'.$bb1[0]);
				
				if($link == ""){
				$link = _ppt('storelink_'.$bb1[0]);
				}
				 
				if($link == ""){
				$link = home_url(); 
				}				
				 
		 		if(strpos($link, "http") === false){
				$link = "http://".$link;
				}
				
				if(defined('WLT_DEMOMODE')){
					
					echo "<h1>Demo Mode</h1>";
					echo "Affiliate links are disabled in 'demo mode'.<br><br>";
					echo "<small>".$link."</small>";
					die();			
				}
			
				// REDIRECT				 
				header("location:".$link, true ,301);
				exit;
				
			}
			
	}elseif(strpos($_SERVER['REQUEST_URI'], "/outbanner/") !== false) {	
		 
			$bb = explode("outbanner/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
			
			if(defined('WLT_DEMOMODE')){
							
				echo "<h1>Demo Mode</h1>";
				echo "Banner links are disabled in 'demo mode'.";
				die();			
			}			
			 				
			if(isset($bb1[0]) && is_numeric($bb1[0]) ){				
				 
				// UPDATE CLICK COUNTER
				update_post_meta($bb1[0], 'clicks', get_post_meta($bb1[0], 'clicks', true) + 1 );
				
				// GET LIST
				$link = get_post_meta($bb1[0], "url", true);
				if($link == ""){
					$link = get_post_meta($bb1[0], "buy_link", true);
				}	
				
				if($link == ""){
					echo "<h1>".__("Link Broken","premiumpress")."</h1>";
					echo __("We're sorry for the inconveniece. The link you are looking for is broken.","premiumpress");
					die();
				}	
				 
				if(strpos($link, "http") === false){
				$link = "http://".$link;
				}			
				 
				// REDIRECT				 
				header("location:".htmlspecialchars_decode($link), true ,301);
				exit;
				
			}	
				
	}elseif(strpos($_SERVER['REQUEST_URI'], "/out/") !== false) {	
		 
			$bb = explode("out/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
			
			 				
			if(strlen($bb1[1]) > 1){
				
				// POST ID
				$GLOBALS['out_post_id'] = $bb1[0];
			 	
				// GET LIST
				$link = get_post_meta($bb1[0], $bb1[1], true);	
								
				if($link == ""){
					$link = get_post_meta($bb1[0], "buy_link", true);
				}
				
				if($link == ""){
					// CHWECK FOR STORE AFFILIATE LINK
					$terms = wp_get_post_terms( $bb1[0], "store" ); 			
					if(isset($terms[0]) && isset($terms[0]->term_id) && _ppt('storelinkaff_'.$terms[0]->term_id) != "" ){
					$link = _ppt('storelinkaff_'.$terms[0]->term_id);
					}			
				}	
				
				 
				
				if($link == ""){
					echo "<h1>".__("Link Broken","premiumpress")."</h1>";
					echo __("We're sorry for the inconveniece. The link you are looking for is broken.","premiumpress");
					die();
				}						
				 
				// USED COUNT
				if(in_array(THEME_KEY,array("cp","cb"))){
					$used = get_post_meta($bb1[0],'used',true);
					if($used == ""){ $used = 0; }
					update_post_meta($bb1[0],'used', $used + 1);					
					update_post_meta($bb1[0], 'lastused', current_time( 'mysql' )); 
					 
				}
				
				if(strpos($link, "http") === false){
				$link = "http://".$link;
				}
				
				 
				if(defined('WLT_DEMOMODE')){
					
					echo "<h1>Demo Mode</h1>";
					echo "Affiliate links are disabled in 'demo mode'.<br><br>";
					echo $link;
					die();
				
				}			
				  
				// REDIRECT				 
				header("location:".htmlspecialchars_decode($link), true ,301);
				exit;
				
			}		 
	}elseif (strpos($_SERVER['REQUEST_URI'], "/confirm/") !== false) {
	
			$bb = explode("confirm/",$_SERVER['REQUEST_URI']);
						
			if (strpos($bb[1], "unsubscribe/") !== false) {
			
				$be = explode("unsubscribe/",$bb[1]);				 
				$data = array(
						"email" => strip_tags($be[1]),
				);
				$CORE->EMAIL("newsletter_unsubscribe", $data);
				
				// REDIRECT USER		
				$url = _ppt(array('newsletter','unsubscribepage'));				 
				if($url == ""){ $url = home_url(); }
				header("location: ".$url);
				exit();
				
			}elseif (strpos($bb[1], "mailinglist/") !== false) {
			
				$be = explode("mailinglist/",$bb[1]);				 
				$data = array(
						"hash" => strip_tags($be[1]),
				);					
				$CORE->EMAIL("newsletter_confirm", $data);
				 
				$url = _ppt(array('newsletter','thankyoupage'));
				 
				if($url == ""){ $url = home_url(); }
				header("location: ".$url);
				exit();
				
			}		 
	}
 


	// LIVE EDIT CHANGES
	if(isset($_POST['liveeditlisting']) && $_POST['liveeditlisting'] == 1 && is_numeric($_POST['eid']) ){
		 
		
		if(isset($_POST['form']['post_content']) && strlen($_POST['form']['post_content']) > 5){
			
			$my_post 					= array();
			$my_post['ID'] 				= $_POST['eid'];
			$my_post['post_content'] 	= strip_tags(strip_tags($_POST['form']['post_content']));
			wp_update_post( $my_post );
		
		}elseif(isset($_POST['form']['post_excerpt']) && strlen($_POST['form']['post_excerpt']) > 2){
			
			$my_post 					= array();
			$my_post['ID'] 				= $_POST['eid'];
			$my_post['post_excerpt'] 	= strip_tags(strip_tags($_POST['form']['post_excerpt']));
			wp_update_post( $my_post );
	 
		
		}elseif(isset($_POST['form']['post_title']) && strlen($_POST['form']['post_title']) > 5){
			
			$my_post 					= array();
			$my_post['ID'] 				= $_POST['eid'];
			$my_post['post_title'] 	= strip_tags(strip_tags($_POST['form']['post_title']));
			wp_update_post( $my_post );
		}
		
		if(isset($_POST['startTime'])){	
			
				$businesshours = array( 'start' => $_POST['startTime'], 'end' => $_POST['endTime'], 'active' => $_POST['isActive']  );				 
				update_post_meta($_POST['eid'],"businesshours", $businesshours);								 
		}
		
		// ADD ON FOR MJ THEME
		if(in_array(THEME_KEY, array("mj","dt")) && isset($_POST['customextras']) ){
			update_post_meta($_POST['eid'], 'customextras', $_POST['customextras']);
		}	
		 
		if(in_array(THEME_KEY, array("mj")) && isset($_POST['customfaq']) ){ 
			update_post_meta($_POST['eid'], 'customfaq', $_POST['customfaq']);
		}	
		
		if(in_array(THEME_KEY, array("cm")) && isset($_POST['comparedata'])){
			update_post_meta($_POST['eid'],"comparedata", $_POST['comparedata'] );	
		}
		
		
		
		
		// SAVE THE CUSTOM PROFILE DATA
				if(isset($_POST['custom']) && is_array($_POST['custom'])){ 	
		
					foreach($_POST['custom'] as $key => $val){
					
						if($val == ""){					
							delete_post_meta($_POST['eid'], strip_tags($key));
						}elseif(is_array($val)){
							update_post_meta($_POST['eid'], strip_tags($key), $val);
						}else{							 
							update_post_meta($_POST['eid'], strip_tags($key), esc_html(strip_tags($val)));					
						}
					} // end foreach 
					
				}// end if
				
			if(isset($_POST['tax']) && is_array($_POST['tax'])){ 	
			 	 
				foreach($_POST['tax'] as $key => $val){ 
				
					// REGISTER IF DOESNT EXIST
					if(!taxonomy_exists($key)){
					register_taxonomy( $key, 'listing_type', array( 'hierarchical' => true, 'labels' =>'', 'query_var' => true, 'rewrite' => true ) ); 
					}
										  
					// SAVE DATA
					$g = wp_set_post_terms($_POST['eid'], $val, $key );
			
				}
			}
			 
	
	}












	if(isset($_POST['single_action'])){		
			
		switch($_POST['single_action']){
		
				case "single_image_pass": {
					
					$pid = $_POST['pid']; $status = "error";
					
					$get_pass = get_post_meta($pid,"image_pass",true);
					
					if(is_numeric($pid) && $get_pass == trim($_POST['val']) ){
					
						$status = "ok";
					
						// UPDATE LISTING SO THEY DONT NEED TO ADD AGAIN
						$data = get_post_meta($pid,'image_access_array',true);
						 
						if(!is_array($data)){ $data = array(); } 
						
						// update
						$data[$userdata->ID] = array("date" => date('Y-m-d'), "pass" => trim($_POST['val']) );				  
								 
						// SAVE			
						update_post_meta($pid,'image_access_array',$data);	 
					
					}
					
					die(json_encode(array("status" => $status)));	
				
				
				} break;
				
				
				case "single_claimlisting_reset":{
				
				
					if( function_exists('current_user_can') && current_user_can('administrator') ){
					 
						// ALLOW CLAIM
						$my_post = array();
						$my_post['ID'] 					= $_POST['pid'];
						$my_post['post_status']			= "pending_approval";
						$my_post['post_author']			= 1;
						wp_update_post( $my_post  );	
						
						// STORE CLAIMED
						delete_post_meta($_POST['pid'], "claimed" );
						 
						// STORE CLAIMED
						delete_user_meta($_POST['uid'], "claimed" ); 
						
						die(json_encode(array("status" => "ok")));
					
					}	
				
				
				} break;
		
				case "single_claimlisting":{
				 
				// ALLOW CLAIM
				$my_post = array();
				$my_post['ID'] 					= $_POST['pid'];
				$my_post['post_status']			= "pending_approval";
				$my_post['post_author']			= $userdata->ID;	
				wp_update_post( $my_post  );	
				
				// STORE CLAIMED
				add_post_meta($_POST['pid'], "claimed", current_time( 'mysql' ) );
				 
				// STORE CLAIMED
				add_user_meta($userdata->ID, "claimed", $_POST['pid'] );
			 
				// SEND MESSAGE TO THE ADMIN
				$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "dt_claimed",								
							"postid"	=> $_POST['pid'],
							"extra" 	=> $_POST['pid'],							 
							"to" 		=> 1, 						
							"from" 		=> $userdata->ID,							
							"alert_uid1" 	=>  1,
						)
					);
				
				// SEND ADMIN AN EMAIL
				$CORE->email_custom("admin", __("New Listing Claimed","premiumpress"), str_replace("%s", $CORE->USER("get_username", $userdata->ID), __("The user %s claimed a new listing on your website. Please login to the admin to approve it.","premiumpress")));
					 
				
				die(json_encode(array("status" => "ok")));	
				
				
				} break;
			 	
				case "single_offer_make": {
				
					if(!is_numeric($_POST['pid'])){ die(); }
					if(!$userdata->ID){ die(); }
					
					$content = "";
					if(isset($_POST['comments']) && strlen($_POST['comments']) > 1){
					$content = strip_tags($_POST['comments']);
					} 		
				
					// ADD A NEW OFFER TO THE SYTEM
					$my_post = array();
					$my_post['post_title'] 		= hook_price($_POST['price'])." offer for ". get_the_title( $_POST['pid'] );
					$my_post['post_content'] 	= $content;
					$my_post['post_excerpt'] 	= "";
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "ppt_offer";
					$my_post['post_author'] 	= 1;
					$POSTID 					= wp_insert_post( $my_post );
					
					// STORE POST ID
					add_post_meta($POSTID, "post_id", $_POST['pid'] );
					 
					// SAVE THE BUYERS ID
					add_post_meta($POSTID, "buyer_id", $userdata->ID); 
					
					// SAVE THE BUYERS ID
					add_post_meta($POSTID, "seller_id", $_POST['aid']); 
					
					// ADD STATUS
					
					if(isset($_POST['price']) && in_array(THEME_KEY, array("rt")) ){ 						
						// FORMAT DATE
						$amount = date("Y-m-d", strtotime($_POST['price']));				 					
					
					}elseif(isset($_POST['price']) && is_numeric($_POST['price'])){
					
						$amount = $_POST['price'];					
						update_post_meta($POSTID, "price_customoffer", $_POST['price']); 
					
					}else{								
						$amount = get_post_meta($_POST['pid'], "price", true); 					
					}
					
					add_post_meta($POSTID, "price", $amount);
					
					
					// PROJECT CHECK HIGHEST BIDDER AND UPDATE
					if(in_array(THEME_KEY, array("pj"))){
						
						$amount = $_POST['price'];
						$cprice =  get_post_meta($_POST['pid'], "price", true);
						if(!is_numeric($cprice)){ $cprice = 0; } 
						 
						if($amount > $cprice){
							update_post_meta($_POST['pid'], "price", $amount);	
						} 
						
					}
					
					// SKIP STEPS
					if(isset($_POST['skip_to_buy']) && in_array( THEME_KEY, array("ct","dl") ) ){
					
						update_post_meta($_POST['pid'], "status", 1);
						
						add_post_meta($POSTID, "offer_status", 3);
						add_post_meta($POSTID, "offer_complete", 1);  
					
					}else{
					
					// ADD STATUS
					add_post_meta($POSTID, "offer_status", 1);
					} 
				
					 /*
					// 3. ADD NEW ORDER/INVOICE				
					$o = $this->ORDER("add", array( 
								"order_id" => "OFFER-".$_POST['pid'],
								"order_status" 		=> 2, // pending
								"order_total" 		=> $amount,
								"order_userid" 		=> $userdata->ID,
								
					) );
							 
					$payment_id = $o['orderid'];					 
					
					update_post_meta($payment_id, 'order_id', $_POST['pid']);
					update_post_meta($payment_id, 'order_email', $CORE->USER("get_email", $userdata->ID ) );
					update_post_meta($payment_id, 'seller_id', $_POST['aid']);	
					update_post_meta($payment_id, 'buyer_id', $userdata->ID);						 
					update_post_meta($payment_id, 'offer_id', $POSTID );	
			
					// UPDATE BID WITH PAYMENT ID
					update_post_meta($POSTID, 'payment_id', $payment_id );	
					
					*/ 
						 
				 
					// ADD LOG
					$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "offer_new",	
							
							"postid"	=> $_POST['pid'],
							"extra"		=> $POSTID,
							
							"to" 		=> $_POST['aid'], 						
							"from" 		=> $userdata->ID,
							
							"alert_uid1" 	=>  $_POST['aid'],							
							 
						)
					);
				 
					die(json_encode(array("status" => "ok", "oid" => $POSTID )));					
				
				} break;
				
				
				case "offer_close": {
				 
						// NOW CLOSE THE OFFER
						update_post_meta($_POST['job_id'], "offer_status", 3);
						update_post_meta($_POST['job_id'], "offer_complete", 5); 
						add_post_meta($_POST['job_id'], "feedback_date_seller", current_time( 'mysql' ));
						add_post_meta($_POST['job_id'], "feedback_date_buyer", current_time( 'mysql' ));
						
						update_post_meta($_POST['listing_id'],'status',1);	
				
					// UPDATE
					die(json_encode(array("status" => "ok")));
				
				} break;
				
				case "offer_refund": {
				
				 	if(isset($_POST['job_id']) && is_numeric($_POST['job_id']) ){
					
						update_post_meta($_POST['job_id'], "offer_status", 2); // refunded
						
						if(THEME_KEY == "mj"){
								
							// GET AMOUNT
							$amount = get_post_meta($_POST['job_id'], "price", true); 								 						
							$price_customoffer = get_post_meta($_POST['job_id'], "price_customoffer", true); 							
							
							/// ADD ON CREDIT
							if( is_numeric($amount) && $amount  > 0 && $price_customoffer == ""){ // DONT CREDIT FOR CUSTOM OFFERS AS THEY ARE NOT PAID FOR					
									 
									$c = get_user_meta($_POST['buyer_id'],'ppt_usercredit', true);
									
									$c1  = number_format((float)$c, 2, '.', '') + number_format((float)$amount, 2, '.', '');
									update_user_meta($_POST['buyer_id'],'ppt_usercredit', $c1);	
													
							}	 
								
						}
					
					}
					 
				
					// UPDATE
					die(json_encode(array("status" => "ok")));
				
				} break;
				
				
				case "offer_delete": {
				
				
					wp_delete_post( $_POST['job_id'], true);
				
					// UPDATE
					die(json_encode(array("status" => "ok")));
				
				} break;
				
				case "offer_update": {

   					update_post_meta($_POST['job_id'], "offer_status", $_POST['offer_status']);
					
					
					// REJECTED CREDIT USER
					if($_POST['offer_status'] == 2){
							
							if(THEME_KEY == "mj"){
								
								// GET AMOUNT
								$amount = get_post_meta($_POST['job_id'], "price", true); 								
								$price_customoffer = get_post_meta($_POST['job_id'], "price_customoffer", true); 
								 
								/// ADD ON CREDIT
								if( is_numeric($amount) && $amount  > 0 && $price_customoffer == ""){ // DONT CREDIT FOR CUSTOM OFFERS AS THEY ARE NOT PAID FOR					
									$c = get_user_meta($_POST['buyer_id'],'ppt_usercredit', true);
									
									$c1  = number_format((float)$c, 2, '.', '') + number_format((float)$amount, 2, '.', '');
									update_user_meta($_POST['buyer_id'],'ppt_usercredit', $c1);						
								}
							
							}
					
					
					}elseif($_POST['offer_status'] == 3){ // ACCEPTED
					
						
						// SKIP PAYMENT STEP AND GO TO FEEDBACK
						if(in_array( THEME_KEY, array("da","rt","jb") )  ){
							
							update_post_meta($_POST['job_id'], "offer_complete", 5); 
						
						}
						
						// IF THERE IS NO PAYMENT DUE
						// SKIP AND GO TO FEEDBACK
						$amount = get_post_meta($_POST['job_id'], "price", true); 
						if(!in_array( THEME_KEY, array("mj") ) && ( !is_numeric($amount) || $amount < 1 )){
							
							update_post_meta($_POST['job_id'], "offer_complete", 5);
						
						}else{
						
							
							// CHECK WE HAVENT ADDED THIS BEFORE
							if(get_post_meta($_POST['job_id'], 'payment_id', true) == "" && !in_array( THEME_KEY, array("da","mj","rt","jb") )  ){
						
								// GET AMOUNT
								$amount = get_post_meta($_POST['job_id'], "price", true); 
						
								// 3. ADD NEW ORDER/INVOICE
								$o = $this->ORDER("add", array( 
									"order_id" => "OFFER-".$_POST['listing_id'],
									"order_status" 		=> 2, // pending
									"order_total" 		=> $amount,
									"order_userid" 		=> $_POST['buyer_id'],
									
								) );
								 
								$payment_id = $o['orderid'];					 
				
								update_post_meta($payment_id, 'seller_id', $_POST['seller_id']);	
								update_post_meta($payment_id, 'buyer_id', $_POST['buyer_id']);						 
								update_post_meta($payment_id, 'offer_id', $_POST['job_id'] );	
				
								// UPDATE BID WITH PAYMENT ID
								update_post_meta($_POST['job_id'], 'payment_id', $payment_id );
				
								//SET ITEM TO SOLD STATUS		
								update_post_meta($_POST['listing_id'],'status',1);	
							
							}
						
						}
		
					} 
					
					
				
					
					// ADD LOG
					if($_POST['offer_status'] == 3){
						$logtype ="offer_accepted";
					}elseif($_POST['offer_status'] == 2){
						$logtype ="offer_rejected";
					} 
					
					if(isset($logtype)){
					
					// ADD LOG
					$CORE->FUNC("add_log",
						array(				 
							"type" 			=> $logtype,								
							"postid"		=> $_POST['listing_id'],	
							
							"extra" 		=> $_POST['job_id'],
													
							"to" 			=> $_POST['buyer_id'], 						
							"from" 			=> $_POST['seller_id'],							
							"alert_uid1" 	=>  $_POST['buyer_id'],								
							"offerid" 		=> $_POST['job_id'],						
							 
						)
					); 
					 
						
					}					 
						
					// SEND EMAIL TO APPLICANT
					
					
					// UPDATE
					die(json_encode(array("status" => "ok","offer" => $_POST['offer_status'])));
				
				
				} break;
				
				case "offer_complete": {
					
				 //die(print_r($_POST));
				 	update_post_meta($_POST['job_id'], "offer_complete", $_POST['offer_status']);  
					
				 	 
					// UPDATE ORDER STATUS AND PAYMENT
					$AMOUNTOWED  = 0;
					if( ( in_array($_POST['offer_status'], array(4,5)) && in_array(THEME_KEY, array("mj","at","pj","ct")) )  || $_POST['offer_status'] == 5){ //$_POST['offer_status'] == 5
					 
					
					 	// IF PAYMENT HAS AN OFFER, UPDATE THIS TOO			
						$order_id = get_post_meta($_POST['job_id'],'order_id', true);							 			
						update_post_meta($order_id,'order_process', 3);	
						
						// GET ORDER TOTAL
						$order_total = $CORE->ORDER("get_order_total", $order_id);	
						if($order_total == ""){					
						$order_total = get_post_meta($_POST['job_id'],'price', true);
						}		 		  
						
						// UPDATE PAYMENT 
						$payment_id = get_post_meta($_POST['job_id'],'payment_id', true);						
						update_post_meta($payment_id,'order_status', 1);
						update_post_meta($payment_id,'order_process', 3);	
						
						// UPDATE ESCROW PAYMENT
						if(_ppt(array('escrow', 'enable_escrow')) == 1){
							$escrow_id = get_post_meta($_POST['job_id'],'escrow_id', true);							 			
							update_post_meta($escrow_id,'order_process', 3);								 
						}					


						// CREDIT USER IN PROJECT THME
						if( in_array(THEME_KEY,array("pj")) && in_array($_POST['offer_status'], array(4) ) ){ //5 = release funds //&&  _ppt(array('cashout', 'enable_escrow')) == '1' 
						 
							$AMOUNTOWED = $order_total;
						 
							 /// ADD ON CREDIT TO BUYER
							if( is_numeric($AMOUNTOWED) && $AMOUNTOWED  > 0){					
								$c = get_user_meta($_POST['buyer_id'],'ppt_usercredit', true);
								$c1  = number_format((float)$c, 2, '.', '') + number_format((float)$AMOUNTOWED, 2, '.', '');
								update_user_meta($_POST['buyer_id'],'ppt_usercredit', $c1);						
							} 
							
							// ADD LOG
							$CORE->FUNC("add_log",
								array(				 
									"type" 		=> "mj_credit_added",									
									"postid"	=> $_POST['listing_id'],									
									"to" 		=> $_POST['buyer_id'], 					
									"from" 		=> 0,									
									"alert_uid1" 	=>  $_POST['buyer_id'],									
									"offerid" 	=> $_POST['job_id'],									
									"extra" 	=> $AMOUNTOWED,	
								)
							);
							
							// SET STATUS TO FEEDBACK
							//update_post_meta($_POST['job_id'], "offer_status", 3);
							//update_post_meta($_POST['job_id'], "offer_complete", 5); 
								
						// MICEO JOBS THEME
						 
						
						}elseif( in_array(THEME_KEY,array("mj","at","ct")) && in_array($_POST['offer_status'], array(4)) ){ //5 = release funds && _ppt(array('cashout', 'enable_escrow')) == '1' 
						 	
							$canUpdate = true;
							
							if( in_array(THEME_KEY,array("at","ct")) && _ppt(array('escrow', 'enable_escrow')) != "1" ){
								$canUpdate = false;
							}
						 
						 	if($canUpdate){
						 
								$AMOUNTOWED = $order_total;
							 
								 /// ADD ON CREDIT
								if( is_numeric($AMOUNTOWED) && $AMOUNTOWED  > 0){					
									$c = get_user_meta($_POST['seller_id'],'ppt_usercredit', true);
									$c1  = (float) $c + (float) $AMOUNTOWED;
									update_user_meta($_POST['seller_id'],'ppt_usercredit', $c1);						
								} 
								
								// ADD LOG
								$CORE->FUNC("add_log",
									array(				 
										"type" 		=> "mj_credit_added",									
										"postid"	=> $_POST['listing_id'],									
										"to" 		=> $_POST['seller_id'], 					
										"from" 		=> 0,									
										"alert_uid1" 	=>  $_POST['seller_id'],									
										"offerid" 	=> $_POST['job_id'],									
										"extra" 	=> $AMOUNTOWED,	
									)
								); 
							
							}// end
							 				
							
						} // end mico jobs 
						
						 
						
						// CHECK FOR HOUSE COMISSION BUYER
						if(( _ppt(array('hc', 'house_comission_buyer')) > 0 || _ppt(array('hc', 'house_comission_buyer_fixed')) > 0 ) && in_array($_POST['offer_status'], array(4))  ){ // home comission_buyer
						 	
							
							if(_ppt(array('hc', 'house_comission_buyer_fixed')) > 0){
							$AMOUNTOWED = _ppt(array('hc', 'house_comission_buyer_fixed'));
							}else{
							$AMOUNTOWED = (_ppt(array('hc', 'house_comission_buyer'))/100)*$order_total;
							}							
							
							if( is_numeric($AMOUNTOWED) && $AMOUNTOWED  > 0){
								
								// 1. COMISSION INVOICE
								if(_ppt(array('hc', 'house_comission_invoice')) == '1'){	
								
										// 3. ADD NEW ORDER/INVOICE
										$o = $this->ORDER("add", array( 
											"order_id" 			=> "CREDIT-".$_POST['job_id']."-".$_POST['buyer_id']."-".rand(0,99999),
											"order_status" 		=> 2, // pending
											"order_total" 		=> $AMOUNTOWED,
											"order_userid" 		=> $_POST['buyer_id'],
											"order_email"		=> $CORE->USER("get_email", $_POST['buyer_id']),
											"order_description" => __("Buyer Commission Payment","premiumpress")." (".get_the_title($_POST['listing_id']).")", // (#".$_POST['job_id'].")
											
											"order_notes" => "Order Total: ".$order_total." / Comission Total: "._ppt(array('hc', 'house_comission_buyer'))." / Total Invoice: ".$AMOUNTOWED, 
											
										) );
										 
										$payment_id = $o['orderid'];					 
						
										update_post_meta($payment_id, 'seller_id', $_POST['seller_id']);	
										update_post_meta($payment_id, 'buyer_id', $_POST['buyer_id']);						 
										update_post_meta($payment_id, 'offer_id', $_POST['job_id'] );
										update_post_meta($payment_id, 'order_postid', $_POST['listing_id'] ); 
										
										// FORCE ORDER STATUS
										update_post_meta($payment_id, 'order_status', 2);
										update_post_meta($payment_id, 'order_process', 1); 
										
										
										// ADD LOG						
										$CORE->FUNC("add_log",
												array(				 
													"type" 			=> "comission_invoice",
													"to" 			=> $_POST['buyer_id'], 						
													"from" 			=> $_POST['buyer_id'],
													"extra"			=> $payment_id,							
													"alert_uid1" 	=>  $_POST['buyer_id'], 
													"extra" 		=> "Invoiced added (".$payment_id.") for the amount: ".$AMOUNTOWED,		
												)
										);
								
								// 2. DEDUCT AMOUNT FROM TOTAL
								}else{
									
									
									
									$c = get_user_meta($_POST['buyer_id'],'ppt_usercredit', true);									 
									$c1  = (float) $c - (float) $AMOUNTOWED;									
									update_user_meta($_POST['buyer_id'],'ppt_usercredit', $c1);
									
									// ADD LOG						
									$CORE->FUNC("add_log",
											array(				 
													"type" 			=> "comission_taken",
													"to" 			=> $_POST['buyer_id'], 						
													"from" 			=> $_POST['buyer_id'],
													"extra"			=> $AMOUNTOWED,							
													"alert_uid1" 	=>  $_POST['buyer_id'], 	
											)
									); 
								
								}							
							} 						
						}
						
						
						
						// CHECK SELLER HOUSE COMISSION
						if(( _ppt(array('hc', 'house_comission')) > 0 || _ppt(array('hc', 'house_comission_fixed')) > 0 ) && in_array($_POST['offer_status'], array(4))  ){ // home comission
						 	
							$AMOUNTOWED = 0;
							if(_ppt(array('hc', 'house_comission_fixed')) > 0){
							$AMOUNTOWED = _ppt(array('hc', 'house_comission_fixed'));
							}else{
							$AMOUNTOWED = (_ppt(array('hc', 'house_comission'))/100)*$order_total;
							}							
							
							if( is_numeric($AMOUNTOWED) && $AMOUNTOWED  > 0){
								
								// 1. COMISSION INVOICE
								if(_ppt(array('hc', 'house_comission_invoice')) == '1'){	
								
										// 3. ADD NEW ORDER/INVOICE
										$o = $this->ORDER("add", array( 
											"order_id" 			=> "CREDIT-".$_POST['job_id']."-".$_POST['buyer_id']."-".rand(0,10000),
											"order_status" 		=> 2, // pending
											"order_total" 		=> $AMOUNTOWED,
											"order_userid" 		=> $_POST['seller_id'],
											"order_email"		=> $CORE->USER("get_email", $_POST['seller_id']),
											"order_description" => __("Seller Commission Payment","premiumpress")." (".get_the_title($_POST['listing_id']).")",
											
											"order_notes" => "Order Total: ".$order_total." / Comission Total: "._ppt(array('hc', 'house_comission'))." / Total Invoice: ".$AMOUNTOWED, 
											
										) );
										 
										$payment_id = $o['orderid'];					 
						
										update_post_meta($payment_id, 'seller_id', $_POST['seller_id']);	
										update_post_meta($payment_id, 'buyer_id', $_POST['buyer_id']);						 
										update_post_meta($payment_id, 'offer_id', $_POST['job_id'] );  
										update_post_meta($payment_id, 'order_postid', $_POST['listing_id'] ); 
										
										
										// FORCE ORDER STATUS
										update_post_meta($payment_id, 'order_status', 2);
										update_post_meta($payment_id, 'order_process', 1); 
										
										
										// ADD LOG						
										$CORE->FUNC("add_log",
												array(				 
													"type" 			=> "comission_invoice",
													"to" 			=> $_POST['seller_id'], 						
													"from" 			=> $_POST['seller_id'],
													"extra"			=> $payment_id,							
													"alert_uid1" 	=>  $_POST['seller_id'], 
													"data" 			=> $AMOUNTOWED,
												)
										);
								
								// 2. DEDUCT AMOUNT FROM TOTAL
								}else{
								
									$c = get_user_meta($_POST['seller_id'],'ppt_usercredit', true);									 
									$c1  = (float) $c - (float) $AMOUNTOWED;
									
									update_user_meta($_POST['seller_id'],'ppt_usercredit', $c1);
									
									// ADD LOG						
									$CORE->FUNC("add_log",
											array(				 
													"type" 			=> "comission_taken",
													"to" 			=> $_POST['seller_id'], 						
													"from" 			=> $_POST['seller_id'],
													"extra"			=> $AMOUNTOWED,							
													"alert_uid1" 	=>  $_POST['seller_id'], 	
											)
									); 
								
								}							
							} 						
						}
						
						
						// SET STATUS TO FEEDBACK
						update_post_meta($_POST['job_id'], "offer_status", 3);
						update_post_meta($_POST['job_id'], "offer_complete", 5); 	
						
						
						// UPDATE SOLD COUNT
						$sold = get_post_meta($_POST['listing_id'],"sold",true); 
						if(!is_numeric($sold)){ $sold =0; }
						update_post_meta($_POST['listing_id'],"sold",$sold); 
						
						
						// ADD LOG
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "offer_complete",								
								"postid"	=> $_POST['listing_id'],								
								"to" 		=> $_POST['buyer_id'], 						
								"from" 		=> $_POST['seller_id'],
								
								"alert_uid1" 	=>  $_POST['buyer_id'],	
								
								"extra" 	=> $_POST['job_id'],
								
								"offerid" 	=> $_POST['job_id'],						
								 
							)
						); 
						
						
					
					}else{
					
					  
					// ADD LOG
					if($_POST['seller_id'] == $userdata->ID){
					 
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "offer_updated",									
								"postid"	=> $_POST['listing_id'],								
								"to" 		=> $_POST['buyer_id'], 						
								"from" 		=> $_POST['seller_id'],	
								
								"extra" 	=> $_POST['job_id'],
															
								"alert_uid1" 	=>  $_POST['buyer_id'],	
														
								 
							)
						); 
					}else{
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "offer_updated",									
								"postid"	=> $_POST['listing_id'],								
								"to" 		=> $_POST['seller_id'], 						
								"from" 		=> $_POST['buyer_id'],								
								"alert_uid1" 	=>  $_POST['seller_id'],
								"offerid" 	=> $_POST['job_id'],	
								"extra" 	=> $_POST['job_id'],					
								 
							)
						); 
					}
					
					
					
					}
					
					
			
				
					// UPDATE
					die(json_encode(array("status" => "ok" )));
				
				} break;				
				
				
		}
		
	}



	if(isset($_POST['cart_action'])){
	 		
		switch($_POST['cart_action']){
		
				
				case "new": {
				
					global $CORE_CART;
					
					$status = "ok";
					$data = $_POST['data'];
					
					 
					// UPDATE USER DATA AND RETURN
					if($userdata->ID){					
						$data['ID'] =  $userdata->ID;
					}else{
						$data['ID'] =  0;
					}
					
					$_SESSION['checkout-country'] 	= $_POST['data']['country']; 
					unset($_SESSION['checkout-city']);
					$_SESSION['checkout-city'] 		= $_POST['data']['town']; 
					
					$table_data = $CORE_CART->cart_getitems();	
					$sessionsid = session_id();
				 	
					// SAVE USER DATA
					$user_id = $CORE->USER("save", $data); 
					if(!is_numeric($user_id)){
					 
						// ERROR CREATING USER OR SAVING DATA
						header('Content-type: application/json; charset=utf-8');				 	
						die(
							json_encode(
								array(
									"status" 	=> "error", 
									"orderid" 	=> "",
									"msg" 		=> $user_id,
									"paycode" 	=> "",
								)
							)
						);
					
					}else{						
						
						// CHECK ORDER EXISTS	
						$orderID = $CORE->ORDER("check_exists", "CART-".$sessionsid );					
						if(!is_numeric($orderID)){
										 
							$orderID = $this->ORDER("add", array( 
									"order_id" 			=> "CART-".$sessionsid,
									"order_status" 		=> 2, // pending
									"order_total" 		=> $table_data['total'],
									"order_userid" 		=> $user_id,
									"order_email"		=> $data['email'],
									"order_description" => __("Cart Checkout","premiumpress"),	 
								) );
						}
						 
						
						update_post_meta($orderID, "order_status", "2"); // pending
						update_post_meta($orderID, "order_process", "1"); // processing 
						
						update_post_meta($orderID, "order_tax", $table_data['tax']);
						update_post_meta($orderID, "order_notes", $data['description']);
						update_post_meta($orderID, "order_shipping", $table_data['shipping']);
						update_post_meta($orderID, "order_subtotal", $table_data['subtotal']);
						update_post_meta($orderID, "order_total", $table_data['total']);
						
						update_post_meta($orderID, "order_paid", ""); 
						
						// SAVE THE SESSION 
						if($sessionsid != ""){ 
						 
						$table_data = $CORE_CART->cart_getitems();
						$wpdb->query("DELETE FROM ".$wpdb->prefix."core_sessions WHERE session_key = ('".$sessionsid."') LIMIT 1");
							
						$wpdb->query("INSERT INTO ".$wpdb->prefix."core_sessions (`session_key` ,`session_date` ,`session_userid`, session_data) 
						VALUES ('".$sessionsid."', '".date('Y-m-d H:i:s')."', '".$userid."', '".serialize($table_data)."')");
						
						}						
					
					}
						 
					// AUTO LOGIN USER
					if(!$userdata->ID){	
					
						// FIX FOR SHOPPING CART DROPPING SESSIONS DURING LOGIN						
						$cd = $_SESSION['ppt_cart'];	
					
						if( defined('WLT_DEMOMODE') && isset($_SESSION['design_preview']) ){
						$loginSkin =	$_SESSION['design_preview'];
						}
						
						$creds = array();
						$creds['user_login'] 	= $data['email'];
						$creds['user_password'] = "password";
						$creds['remember'] 		= true;
						$user = wp_signon( $creds, false );	
						
						$CORE->start_session();	
						$_SESSION['ppt_cart'] = $cd;
						
						if( defined('WLT_DEMOMODE') && isset($loginSkin) ){
						$_SESSION['skin'] = $loginSkin;
						$_SESSION['design'] = $loginSkin;
						}
					
					}
					
					
					// BUILD ORDER DATA
					$tt = 0;
					$tt =  str_replace(",","", hook_price(array($GLOBALS['global_cart_data']['total'],0)) );
					 
					$cartdata = array( 
						"uid" 			=> $user_id, 
						"amount" 		=> str_replace(",","",$table_data['total']), 
						"order_id" 		=> "CART-".$sessionsid, 
						"description" 	=> __("Cart Checkout","premiumpress"), 
						"recurring" 	=> 0, 		
					);  
					 
					
					// CREATE NEW ORDER 
					header('Content-type: application/json; charset=utf-8');				 	
					die(
						json_encode(
							array(
								"status" 	=> $status, 
								"orderid" 	=> "",
								"msg" 		=> $user_id,
								"paycode" 	=> $CORE->order_encode($cartdata),
								"orderid"	=> $orderID,
							)
						)
					);
					
				
				} break;
				
				case "update_shipping": {
				
					$status = "ok"; 
					 
					$_SESSION['checkout-country'] 	= $_POST['country_id']; 
					$_SESSION['checkout-city'] 		= $_POST['state_id']; 
					  
					header('Content-type: application/json; charset=utf-8');				 	
					die(
						json_encode(
							array(
								"status" 	=> $status, 							
								"country" 	=> $_POST['country_id'],
								"city" 		=> $_POST['city_id'],
							)
						)
					);
				
				} break;
				
				case "update_methods": {
				
					$status = "ok"; 					
					
					$shipm = array();
					if(is_array($_POST['formdata'])){						
						foreach($_POST['formdata'] as $k => $v){
						$shipm[$k] = $k;
						}
					}
					
					$_SESSION['checkout-method'] = $shipm;
					 
					header('Content-type: application/json; charset=utf-8');				 	
					die(
						json_encode(
							array(
								"status" 	=> $status, 							
								"country" 	=> $_POST['formdata'],
							 
							)
						)
					);
				
				} break;
				
				case "update_items": {
				
					_ppt_template('forms/checkout/items' );
					
					die();
				
				} break;
		
		
				case "remove_coupon": {
	
					// RMEOVE COUPON		 
					unset($_SESSION['discount_code']);	
					die();
				
				} break;
			 	
				case "update": {
				  
				//$ProductArray = array( "1" => array( "qty" => 50 ) );
				//$_SESSION['ppt_cart'][612] = $ProductArray;
				//die();
				
				// GET CART DATA
				global $CORE_CART;
				$cartdata 	= $CORE_CART->cart_getitems();
				
				$cart_items = $cartdata['items'];
				
				//PRODUCT DATA					
				$product_id 		= $_POST['pid'];
				$product_qty 		= $_POST['qty'];
				$product_ship 		= 0; // NEEDS DOING
				$product_innerid 	= $_POST['innerid']; // USED AT CHECKOUT FOR INCREASING QTY	
			 	$product_customdata = "";
				if(strlen($_POST['custom']) > 1){ 
					$product_customdata = $_POST['custom'];
				}
				
				// CREDIT SYSTEM
				$product_paument_via_tokens 		= 0; 
				if(isset($_POST['tokens']) && is_numeric($_POST['tokens']) && $_POST['tokens'] == 1){
				$product_paument_via_tokens 		= 1; 
				}
				
			 
				// CHECK IF THE PRODUCT ALREADY EXISTS
				if(isset($cart_items[$product_id])){	
							
					$ProductArray = $cart_items[$product_id]; 	
					
					if( is_numeric($product_innerid) && isset($cart_items[$product_id][$product_innerid]) ){
						$innerID 		= $product_innerid;
					
					}else{		
						$innerID = count($cart_items[$product_id]);
					}
													
				}else{ 
			 
					$ProductArray = array( "1" => array( "qty" => 0 ) ); // NEW PRODUCT
					$innerID = 1;
					
				}// endif
				
				
				// IF WERE ADDING CHECK IF WE NEED TO ADD A NEW PRODUCT
				// OR UPDATE AN EXISTING ONE
				if($_POST['type'] == "add" && $product_customdata != "" && isset($cart_items[$product_id]) ){
					$innerID = count($cart_items[$product_id])+1;	// GENERATE A NEW ID
				}
				
				// THIS IS THE PRODUCT WE ARE EDITING!!!
				$CURRENTPRODUCT = $ProductArray[$innerID]; 			 
			
				// NOW PERFORM TASK
				switch($_POST['type']){
				
					case "add": {
						 
						$CURRENTPRODUCT['qty'] = $CURRENTPRODUCT['qty'] + $product_qty;					 
					
					} break;
					
					case "remove": {
						
						$CURRENTPRODUCT['qty'] = $CURRENTPRODUCT['qty'] - $product_qty;	
						
					} break;
					
					case "update": {
						 
						$CURRENTPRODUCT['qty'] = $product_qty;					 
					
					} break;
				
				}// end switch
				
				
					 
				// IF LESS THAN 1 REMOVE
				if($CURRENTPRODUCT['qty'] < 1){
				
					unset($_SESSION['ppt_cart'][$product_id][$innerID]);  
					
				}else{
				 
				// CHECK FOR EXTRAS
				$extras_array = array();
				if(strlen($product_customdata) > 0){ 
						$e1 = explode(",",$product_customdata);	 $o=1;										
						foreach($e1 as $ed){
							$bits = explode("|",$ed);
							if(isset($bits[1])){
							$extras_array[$o]['key'] 	= $bits[0];
							$extras_array[$o]['field'] 	= $bits[1];
							$extras_array[$o]['text'] 	= $bits[2];
							$extras_array[$o]['amount'] = $bits[3];
							 
							$o++;
							} // end if
						} // end foreach
				}// end if
					
				// PRODUCT SAVE
				$CURRENTPRODUCT['extra'] 	= array("ship" => $product_ship, "tokens" => $product_paument_via_tokens, "custom" => $extras_array);				
			 	
 				// SAVE SESSION
				$_SESSION['ppt_cart'][$product_id][$innerID] = $CURRENTPRODUCT;
				
				}
					 
				// LEAVE MSG
				die(print_r($_SESSION['ppt_cart'])); 
			
				
				} break; // end update
			
		} // end switch				
		 
	}// end actions
 
 
// AJAX FROM WITHIN THE SITE
if(isset($_POST['admin_action']) && $_POST['admin_action'] !=""  ){ //&& 

	switch($_POST['admin_action']){
 
	
		case "ajax_import_countrylist": {
		
			if(function_exists('current_user_can') && current_user_can('administrator') && isset($GLOBALS['core_country_list'])){
			 
				foreach($GLOBALS['core_country_list'] as $key=>$value){
				
				 $t = wp_insert_term(
						$value,   // the term 
						'country', // the taxonomy
						array(
							'description' => "",
							//'slug'        => 'apple',
							//'parent'      => $parent_term_id,
						)
					); 
				
				}
			}
		
		die();
		
		} break;
	
		case "ajax_import_citylist": {
		
			if(function_exists('current_user_can') && current_user_can('administrator') &&  isset($GLOBALS['core_state_list'][$_POST['country_id']])){
				
				
			 	
				// INSET TERM	
				$name = $GLOBALS['core_country_list'][$_POST['country_id']];
					
				$parent_term = term_exists( $name, 'country' );
				if(empty($parent_term)){
				
					$t = wp_insert_term(
						$name,   // the term 
						'country', // the taxonomy
						array(
							'description' => "",
						)
					); 
					
					if(is_wp_error( $t )){ 
					}elseif(is_object($t)){
						$parentID = $t->term_id; 
					}elseif(is_array($t)){
						$parentID = $t['term_id']; 
					}
					
				}elseif(!empty($parent_term)){		
					$parentID = $parent_term['term_id'];			 
				}
				
				////////////////////////////////////////////////
				
				 
				$states = explode("|",$GLOBALS['core_state_list'][$_POST['country_id']]);
				foreach($states as $state){
				
				 $t = wp_insert_term( $state,'country', array('parent' => $parentID) ); 
				
				}
			}
		
		die();
		
		} break;
		
		case "ajax_import_makes": {
		
			if(function_exists('current_user_can') && current_user_can('administrator') && isset($GLOBALS['core_country_list'])){
			
				require_once get_template_directory() ."/framework/data/_makes.php";
			 
				
				$makeid = $_POST['makeid'];
				
				$name = $_POST['make']; $count = 0;
				
				// INSET TERM		
				$parent_term = term_exists( $name, 'listing' ); // array is returned if taxonomy is given
				if(empty($parent_term)){
				
					$t = wp_insert_term(
						$name,   // the term 
						'listing', // the taxonomy
						array(
							'description' => "",
						)
					); 
					
					if(is_wp_error( $t )){ 
					}elseif(is_object($t)){
						$parentID = $t->term_id; 
					}elseif(is_array($t)){
						$parentID = $t['term_id']; 
					}	 
					 
					
				}elseif(!empty($parent_term)){		
					$parentID = $parent_term['term_id'];			 
				}
				
				////////////////////////////////////////////////
				
				if(isset($GLOBALS['ppt_models'][$makeid])){
					$list = $GLOBALS['ppt_models'][$makeid];
					$output = "";
					foreach($list as $v){  
						 wp_insert_term( $v, "listing", array('parent' => $parentID)); 
						 $count++; 
					}
				} 
				
				
			}
		
		die(json_encode(array("status" => "ok", "count" => $count)));
		
		} break;
		
              
 		case "ajax_get_language_package_paktxt": {
		
		global $CORE;
		
		$i = $_POST['i'];
		$f = $_POST['f'];
		
		ob_start();
		 foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
 
                  <div class="mt-3">
                        
                          <div class="mb-2 small">
                           
                            <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div> <?php echo $CORE->GEO("get_lang_name", $lang); ?> </div>
                            
                          <input type="text" 
                          name="admin_values[pak<?php echo $i; ?>_txt<?php echo $f; ?>_<?php echo strtolower($lang); ?>]" 
                          value="<?php if(_ppt('pak'.$i.'_txt'.$f.'_'.strtolower($lang)) != ""){ echo _ppt('pak'.$i.'_txt'.$f.'_'.strtolower($lang)); } ?>" 
                          class="form-control">
                          
                        </div>
                        
               </div>
                     
 
              <?php }   
			  
		$output = ob_get_contents();
		ob_end_clean();	 
	
		die(json_encode(array("status" => "ok", "output" => $output)));
			
		} break; 
		             
		case "ajax_get_language_package_desc": {
		
		global $CORE;
		
		$i = $_POST['i'];
		
		ob_start();
		 foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
          <label class="mt-3">
              <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">
                &nbsp;
              </div>
              <?php echo $CORE->GEO("get_lang_name", $lang); ?>
              </label>
              <textarea name="admin_values[pak<?php echo $i; ?>_desc_<?php echo strtolower($lang); ?>]" class="form-control bg-light" style="height:100px !important;"><?php if(_ppt('pak'.$i.'_desc_'.strtolower($lang)) == ""){ }else{ echo _ppt('pak'.$i.'_desc_'.strtolower($lang)); } ?>
</textarea>
              <?php } 
			  
		$output = ob_get_contents();
		ob_end_clean();	 
	
		die(json_encode(array("status" => "ok", "output" => $output)));
			
		} break; 
	
	  
		case "ajax_get_language_package_titles": {
		
		global $CORE;
		
		$i = $_POST['i'];
		
		ob_start();
		 foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
              <div class="mt-3">
                <label>
                <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">
                  &nbsp;
                </div>
                <?php echo $CORE->GEO("get_lang_name", $lang); ?>
                </label>
                <input type="text" name="admin_values[pak<?php echo $i; ?>_name_<?php echo strtolower($lang); ?>]" value="<?php if(_ppt('pak'.$i.'_name_'.strtolower($lang)) == ""){  echo "";  }else{ echo _ppt('pak'.$i.'_name_'.strtolower($lang)); } ?>" class="form-control bg-light">
              </div>
              <?php } 
			  
		$output = ob_get_contents();
		ob_end_clean();	 
	
		die(json_encode(array("status" => "ok", "output" => $output)));
			
		} break;
		
	 
	
		case "sms_single": {
		 			 			 
			if(function_exists('current_user_can') && current_user_can('administrator')  ){
										 
					$CORE->SENDSMS_SINGLE($_POST['num'], $_POST['msg']);
					
			}
			
			die(json_encode(array("status" => "ok")));				
				
		}	
	
		case "sms_bulk": {
		 			 			 
				if(function_exists('current_user_can') && current_user_can('administrator')  ){
									 
					$SQL = "SELECT distinct meta_value FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'mobile' AND meta_value != ''";
										 
					$ores = $wpdb->get_results($SQL);			
					if(!empty($ores)){
						foreach($ores as $row){
						 
							$CORE->SENDSMS_SINGLE($row->meta_value, $_POST['msg']);		
						 
						}					
					}
					
				}
			
			die(json_encode(array("status" => "ok")));				
				
		}	
	
		case "listing_featured": {
			
			 if(function_exists('current_user_can') && current_user_can('administrator')  ){	
			 
				if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
				
					$tn = $_POST['type']; 
				
					$featured = get_post_meta($_POST['pid'], $tn, true);
					
					if(in_array($featured,array("no","0",""))){
						update_post_meta($_POST['pid'], $tn, 1);	
						$featured = "yes";				
					}else{
						update_post_meta($_POST['pid'], $tn, 0);	
						$featured = "no";				 
					}
					
					die(json_encode(array("current" => $featured, "type" => $_POST['type'], "pid" => $_POST['pid'])));
				
				}	
			
			}
				
		}
		case "delete_block_value": {	global $CORE, $CORE_ADMIN;
		
				 if(function_exists('current_user_can') && current_user_can('administrator')  ){	
				 	
					
					$dd = str_replace("admin_values","", $_POST['name']);
					$ddd = explode("[",$dd);
					 
					// BUILD ARRAY
					$newvals = array();
					
					if($_POST['name'] == "homepage"){
						$newvals['design'][ $_POST['value'] ] = "";
					}else{
						$newvals[$_POST['name']][ $_POST['block'] ] = "delete";
					}
					
									  
					
					// GET OLD OPTIONS 
					$existing_values = $CORE->ppt_core_settings;
					 
				 	// MERGE WITH EXISTING VALUES					 
					$new_result = array_replace_recursive((array)$existing_values, (array)$newvals);
					 
					// UPDATE DATABASE 		
					update_option( "core_admin_values", $new_result, true);
				 
				 }
			 
			die($_POST['name']." --".$_POST['value']);
		
		} break;
		case "update_block_value": {	global $CORE, $CORE_ADMIN;
		
				 if(function_exists('current_user_can') && current_user_can('administrator')  ){	
				 	
					
					$dd = str_replace("admin_values","", $_POST['name']);
					$ddd = explode("[",$dd);
					 
					// BUILD ARRAY
					$newvals = array();
					$newvals[str_replace("]","",$ddd[1])] = array();
					$newvals[str_replace("]","",$ddd[1])][str_replace("]","",$ddd[2])][str_replace("]","",$ddd[3])] = $_POST['value'];					  
					
					// GET OLD OPTIONS 
					$existing_values = $CORE->ppt_core_settings;
					 
				 	// MERGE WITH EXISTING VALUES					 
					$new_result = array_replace_recursive((array)$existing_values, (array)$newvals);
					 
					// UPDATE DATABASE 		
					update_option( "core_admin_values", $new_result, true);
				 
				 }
			 
			die($_POST['name']." --".$_POST['value']);
		
		} break;
		case "page_delete": {	
		
				if(function_exists('current_user_can') && current_user_can('administrator') ){		
			 
				$my_post = array();
				$my_post['ID'] 					= $_POST['pid'];
				$my_post['post_status']			= "trash";
				wp_update_post( $my_post  );
				
				}
			 
			die();
		
		} break;
		
			
		case "load_pagelinks": {			
			 
			_ppt_template( 'framework/admin/ajax-modal-pagelink' );
			 
			die();
		
		} break;
		
		case "load_pageedit": {			
			 
			_ppt_template( 'framework/admin/ajax-modal-pageedit' );
			 
			die();
		
		} break;
		
		case "load_block_select": {			
			 
			_ppt_template( 'framework/admin/ajax-modal-blockselect' );
			 
			die();
		
		} break;
		
		case "load_block_builder": {			
			 
			_ppt_template( 'framework/admin/ajax-modal-block-builder' );
			 
			die();
		
		} break;
	
	

	case "get_media_by_name": { // for admin attachments
	
		$postData = array(); $sql = ""; $sn = "";
		
		if($_POST['data'][1] == "URL"){
		
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM ".$wpdb->prefix."posts WHERE guid='%s';", $_POST['data'][0] )); 
			$args = array(
				'post_type'     => 'attachment',
				'p'          	=>  $attachment[0],
			);
			
		}elseif($_POST['data'][1] == "Image"){	
			
			$bg = explode("--",$_POST['data'][0]); 
			die(json_encode(array("status" => "ok", "data" => array( "ID" => $bg[0], "URL" => $bg[1] )  )));
			die();
			
		}else{
		
			// TIM AND CLEAN FOR SEARCH
			$ff = str_replace("-"," ", str_replace("_"," ", $_POST['data'][0]));
			$bits = explode(" ", trim($ff));
		 	
			if(count($bits) > 2){
				
				foreach($bits as $bit){
					
					if(strlen($bit) > 4 ){
						if($sn != ""){
						$sn .= " AND ";
						}	
						$sn .= "post_title LIKE '%".$bit."%' ";
					} 
				}  
				
			}else{
				$sn = "post_title LIKE '%".trim($_POST['data'][0])."%' "; ;
			}
			
			$sql = "SELECT * FROM ".$wpdb->prefix."posts WHERE ".$sn." ORDER BY post_date AND post_mime_type != 'image/jpeg' DESC LIMIT 1"; 
			$r = $wpdb->get_results($sql);
			if(isset($r[0])){
			 
				$args = array(
				'post_type'     => 'attachment',
				'p'          	=>  $r[0]->ID,
				); 
			}       
		}  
		
		$get_posts = new WP_Query( $args );
		$postData = array();
		
 		if ( $get_posts->have_posts() ) {
				while ( $get_posts->have_posts() ) {
						$get_posts->the_post();
						$postData['URL'] 		= wp_get_attachment_url(get_the_ID());
						$postData['Thumbnail'] 	= (get_the_post_thumbnail_url(get_the_ID()));
						$postData['ID'] 		= get_the_ID();
						$postData['Name'] 		= get_the_title();
						$postData['Caption'] 	= get_post_field('post_excerpt', get_the_ID()); //get_the_excerpt(get_the_ID());
				}
				/* Restore original Post Data */
				wp_reset_postdata();
		}  

		die(json_encode(array("status" => "ok", "data" => $postData, "sql" => $sql )));
		die();
		
	} break;

	case "send_pending_msg": {
	
		global $CORE; 
	
		$email 		= $CORE->USER("get_email", $_POST['uid']);
		$message  	= trim($_POST['msg']); 
		$subject 	= trim($_POST['subj']); 
		 
		// SEND
		$CORE->email_send($email, $subject, $message);
					
		// ADD LOG
		$CORE->FUNC("add_log",
				array(				 
				"type" 		=> "pending_approval",									
				"email" 	=> $email,
				"data" 		=> $subject."/n/n/n".$message,							  					 
				)
		);
	
		die(json_encode(array("status" => "ok","email" => $email, "msg" => $message, "sub" => $subject )));
	
	} break;
	
	
	case "language_templates": {
	 
	global $wpdb, $CORE;
	
	// GET ELEMENT PAGES
	$elementorArray = array();
	$args = array(
					   'post_type' 			=> 'elementor_library',
					   'posts_per_page' 	=> 150,
						'orderby' 	=> 'date',
						'order' => 'desc'
				   );
	$wp_query = new WP_Query($args);
	$tt = $wpdb->get_results($wp_query->request, OBJECT);
	if(!empty($tt)){ foreach($tt as $p){ 
	 $elementorArray["elementor-".$p->ID] = get_the_title($p->ID); 
	} } 
	
	// GET PAGES
	$args = array(
	'post_type' 		=> 'page',
	'posts_per_page' 	=> 50,
	'orderby' 			=> 'date',
	'order' 			=> 'desc'
	 );
	$wp_query = new WP_Query($args);
	
	
	
	$tt = $wpdb->get_results($wp_query->request, OBJECT);
	 
	 if(!empty($tt)){  
	 
		 $elementorArray["9999"] = "9999";
		
		 
		 foreach($tt as $p){
		 
			$title = get_the_title($p->ID);
		 
			//if(strpos( strtolower($title),  ) { continue; }
			//$badwords = array('auto', 'blog', 'stores', 'terms', 'advertising','account','memberships','cart','checkout','about us','how it works','add listing','callback','testimonials','faq'));
			
			 
			$elementorArray["page-".$p->ID] = $title;
		
		 }
	 
	}
	 
	//print_r($elementorArray);
	
	ob_start(); 	 
	foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?><div class="mt-3"><div class="mb-2 small"><div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div><?php echo $CORE->GEO("get_lang_name", $lang); ?></div><select data-placeholder="Default Page" name="admin_values[pageassign][<?php echo $_POST['t']; ?>_<?php echo strtolower($lang); ?>]" <?php 
				
				if(is_array($elementorArray) && count($elementorArray) > 50  ){ ?> data-size="10" class="form-control"  data-live-search="true" title="&nbsp;"<?php }else{ ?>class="form-control"  <?php } ?>>
              <option value=""><?php echo __("Default Design","premiumpress"); ?></option><?php foreach ( $elementorArray as $key => $title ) {
					  
				if($title == "Default Kit"){ continue; }        
               
               $option = '<option value="'. $key.'"';
               if( _ppt(array('pageassign', $_POST['t']."_".strtolower($lang))) == $key){ $option .= " selected=selected "; $EditLink = substr($key,10,100); } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } ?>  </select></div>
                
                <div class="div mt-3">
				<?php if(_ppt(array('pageassign',$_POST['t']."_".strtolower($lang))) != "" && isset($EditLink)){  ?>
                
                <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $EditLink; ?>&action=elementor" class="btn btn-system btn-md" target="_blank"><i class="fa fa-pencil"></i> <?php echo __("Edit Design","premiumpress"); ?></a>
				
				
				<?php } ?>
                
                <a href="<?php echo _ppt(array('links',$_POST['t'])); ?>/?l=<?php echo $lang; ?>" class="btn btn-system btn-md" target="_blank"><i class="fa fa-eye"></i> <?php echo __("View Page","premiumpress"); ?></a>
				
                
                </div>
				
				
				<?php } ?>
          
        <?php
				
		$output = ob_get_contents();
		ob_end_clean();	 
	
		die(json_encode(array("status" => "ok", "output" => $output)));
	
	} break;
	
	case "set_massimportdata": {
		
			
			// MAKE SURE THE USER IS THE AUTHOR
		 
				$the_post 				= array();
				$the_post['ID'] 		= $_POST['pid'];
				$the_post['post_title'] = strip_tags(strip_tags($_POST['title']));
				wp_update_post( $the_post ); 
				
				// CATEGORIES
				$cats = explode(",",$_POST['cat']);
				if(is_array($cats) && !empty($cats) ){
					foreach($cats as $cat){
						$cat = trim($cat);
						if(!is_numeric($cat) ){ continue; }
						$categories[] = $cat;
					}
					 
					wp_set_post_terms($the_post['ID'], $categories, THEME_TAXONOMY );
				}	 
		 		 
				die(json_encode(array("status" => "ok")));
		 
		} break;
	
		case "helpme_search": {
		
				$status = "error";
				$mainvid = "";
				$innerpage = "";
				if(isset($_POST['innerpage'])){
				$innerpage = $_POST['innerpage'];
				}
		
				// build request				 
				$request = array(					 
						'version' 		=> THEME_VERSION,
						"theme_key" 	=> strtoupper(THEME_KEY),
						'email' 		=> get_option('admin_email'),
						'theme_lic' 	=> get_option("ppt_license_key"),	
						'theme_url' 	=> esc_url( home_url() ),						
						"keyword" 		=> $_POST['keyword'], 
						"page" 			=> $_POST['page'], 
						"innerpage" 	=> $innerpage,						
					);
				 
				// Start checking for an update
				$send_for_check = array(
					'body' => array(					 
						'request' => serialize($request),
						'api-key' => md5(esc_url( home_url() ))
					),
					'user-agent' => 'WordPress; ' . esc_url( home_url() )
				);
				 	
				// EXECUTE 
				if(defined('WLT_DEMOMODE') && strpos($_SERVER['HTTP_HOST'],"premiummod.com") === false  ){
				$raw_response = wp_remote_post("http://localhost/_helpfeed/index.php", $send_for_check);
				}else{
				$raw_response = wp_remote_post("https://www.premiumpress.com/_helpfeed/index.php", $send_for_check);
				}
				
				  	//die(print_r($raw_response));
				if( !is_wp_error( $raw_response ) ) {	 
				 	 
					$data = (array)json_decode($raw_response['body']);	
					
					if(!empty($data)){
					
						$status = "ok";
					 	
						// BUILD OUTPUT
						$output = '<h6>'.__("Related Tutorials","premiumpress").'</h6><hr />';
						$output .= '<ul>';
						foreach($data as $g){ 
							if(strlen($g->link) > 1){
                        	$output .= '<li><i class="fal fa-file-search mr-2"></i><a href="'.$g->link.'" target="_blank">'.$g->name.'</a></li>';
							}
							
							if(isset($g->mainvid)){
							$mainvid = $g->mainvid;
							}
							
                        } 
						$output .= '</ul>';
												
					
					} 				 		
				
				}else{				
					
					$output = $raw_response->get_error_message();	
					
					$status = "error";				
				}
		
		 
			// REPORT AJAX
			header('Content-type: application/json');			 
			die(json_encode(array("status" => $status, "keyword" => $_POST['keyword'], "page" => $_POST['page'], "innerpage" => $_POST['innerpage'], "output" => $output, "mainvid" => $mainvid  )));
		
		} break;
	
		case "auction_deletebid": {
		
				global $CORE_AUCTION;
		 
				// GET BID HISTORY
				$bidding_history = get_post_meta($_POST['pid'],'current_bid_data',true);
				 			
				if(!is_array($bidding_history)){ $bidding_history = array(); }
				$newdata = array();
				 	
					// LOOP LIST		 
					if(is_array($bidding_history) && !empty($bidding_history) ){ 
					
						// SORT BY DATE
						uksort($bidding_history,  array($CORE_AUCTION, "order_bidhiustory_bykey") );
				 
						$bidding_history = array_reverse($bidding_history, true);
						
						
							$i=1; 
							foreach($bidding_history as $date => $bhistory){  
							
								if($date == $_POST['bid']){ continue; }
								
								$newdata[$date] = $bhistory;								
								$i++;
							
							}							
						 
							// UPDATE
							update_post_meta($_POST['pid'],'current_bid_data',$newdata);
							 
							 // GET HIGHEST BID AND SET THE NEW PRICE
							 $hi = $CORE_AUCTION->get_highest_bidder($_POST['pid']);
							 if(is_array($hi)){
							 	update_post_meta($_POST['pid'],'price_current',$hi['amount']);
							 }else{
								 update_post_meta($_POST['pid'],'price_current',0);
							 }
							 
						
					}
				 
		
		
			// REPORT AJAX
			header('Content-type: application/json');			 
			die(json_encode(array("status" => "ok",   )));
		
		} break;
	 
	
		case "check_updates": {		
		 
			$theme_data = new stdClass();
			$theme_data->action 	= "version_check";
			$theme_data->checked 	= array( THEME_KEY => THEME_VERSION );
			$data = $CORE->check_for_theme_update($theme_data);			 
			 
			$version = $data->response[THEME_KEY];
			 
			
			if(is_numeric(intval($version))){	
			
				if ( version_compare( $version, THEME_VERSION, '>' ) ) {			 
						$s = "new";
				}else{
						$s = "old";
				}
						
			}else{
				$s = "error";
			}
		
			// REPORT AJAX
			header('Content-type: application/json');			 
			die(json_encode(array("status" => $s, "current" => THEME_VERSION, "msg" => $version )));
		
		
		} break;
	
		case "check_license": {
		
			// update
			// install
			// error
			
			update_option("ppt_expired", "");
			
			$current_key = get_option("ppt_license_key");						
			if($current_key == ""){
				$status = "install";
			}else{
				$status = "update";
			}
			
			if(strlen($_POST['theme']) > 1){
			update_option('ppt_theme', $_POST['theme']);
			}
			
			if(defined('WLT_DEMOMODE')){			
				// REPORT AJAX
				header('Content-type: application/json');			 
				die(json_encode(array("status" => $status )));
			}
			
			if(defined('THEME_VERSION')){
			$themeversion = THEME_VERSION;
			}else{
			$themeversion = 99;
			}
			
			if(defined('THEME_KEY')){
			$themekey = THEME_KEY;
			}else{
			$themekey = "";
			} 
			
				// build request				 
				$request = array(
						't' 			=> $themekey,
						'v' 			=> $themeversion,
						'l' 			=> trim($_POST['key']),					
						'e' 			=> get_option('admin_email'),				
						'w' 			=> esc_url( home_url() ),						
				);	
							 
				// Start checking for an update
				$send_for_check = array(
					'body' => array(						 
						'request' => serialize($request),
						'api-key' => md5(esc_url( home_url() ))
					),
					'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() )
				);
				 	
				// EXECUTE 
				$raw_response = wp_remote_post("https://www.premiumpress.com/_themesv10/version_check.php", $send_for_check);	
			 	  			
			// CHECK RESPONSE
			if( !is_wp_error( $raw_response ) && ($raw_response['response']['code'] == 200) ) {	 
			
					$newversion = $raw_response['body'];					 
					 
					if($newversion == "1"){						
					 
						// REPORT AJAX
						header('Content-type: application/json');			 
						die(json_encode(array("status" => $status )));
						
					}elseif($newversion == "expired"){	
					
						// REPORT AJAX
						header('Content-type: application/json');			 
						die(json_encode(array("status" => "error", "msg" => "License Key Has Expired - Please login to www.premiumpress.com and renew your account." )));
					
					}else{
					
						// REPORT AJAX
						header('Content-type: application/json');			 
						die(json_encode(array("status" => "error", "msg" => "Invalid License Key" )));									
					}					
					
			} else {
			
				// REPORT AJAX
				header('Content-type: application/json');			 
				die(json_encode(array("status" => "error", "msg" => $raw_response->get_error_message() )));	
			  
			}
			
			// REPORT AJAX
			header('Content-type: application/json');			 
			die(json_encode(array("status" => "error", "msg" => "Invalid License Key" )));	
			 
		
		} break;
	
	
		case "load_block_data": {
				
				$output = "";
				
				global $CORE;
				$defaults = $CORE->LAYOUT("get_blocks_data",array());
			 
				
				if(isset($defaults[$_POST['id']]['data'])){
				 
					if(isset($_GET['pagekey'])){
						$pagekey = $_GET['pagekey'];
					}else{
						$pagekey = "home";
					}
					
					 		
					ob_start();
					echo $CORE->CustomDesignEdit($_POST['id'], $defaults[$_POST['id']], $pagekey);		 
					$output = ob_get_contents();
					ob_end_clean();	 
					
				}
				
				
				// REPORT AJAX
				header('Content-type: application/json');
				$n = array("statsus" => "ok", "output" => $output);
				echo json_encode($n);
				die();
		} break;
	
		case "mass_update_users": {
		
		require_once( ABSPATH.'wp-admin/includes/user.php' );
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
			 
				wp_delete_user( $pid );
				
				}elseif($_POST['cat'] != ""){
				
				//update_post_meta( $pid, "order_status", $_POST['cat'] );
				
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;
		
		
		case "mass_update_comments": {
		
		 
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
			 
				wp_trash_comment($pid);
				
				}elseif($_POST['cat'] != ""){
				
				//update_post_meta( $pid, "order_status", $_POST['cat'] );
				
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;
		
		
		case "mass_update_campaigns": {
		
		
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
				
				wp_delete_post( $pid, true);
				
				}elseif($_POST['cat'] != ""){
				
				update_post_meta( $pid, "status", $_POST['cat'] );
				
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;			
		case "mass_update_cashout": {
		
		
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
				
				wp_delete_post( $pid, true);
				
				}elseif($_POST['cat'] != ""){
				
				update_post_meta( $pid, "order_status", $_POST['cat'] );
				
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
 
		} break;
		case "mass_update_orders": {
		
		
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
				
				wp_delete_post( $pid, true);
				
				}elseif($_POST['cat'] != ""){
				
				update_post_meta( $pid, "order_status", $_POST['cat'] );
				
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;
		
		case "mass_update_subscriber": {		
		
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
				
				wp_delete_post( $pid, true);
				
				}elseif($_POST['cat'] != ""){
				
				 
				}
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;
		
		case "mass_update_logs": {
		
		
	 	if(is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['deleteall']  == 1){
				
				wp_delete_post( $pid, true);
				
				}
			}		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;		
			
		case "mass_update_listings": {
		
		
	 	if(isset($_POST['pids']) && is_array($_POST['pids'])){
			foreach($_POST['pids'] as $pid){
			
				// UDPATE CATEGORY
				if($_POST['status']  != ""){
				
					switch($_POST['status']){
						
						case "publish": {		
							
							$my_post = array();
							$my_post['ID'] 			= $pid; 
							$my_post['post_status'] = "publish";				
							wp_update_post( $my_post );
						
						} break;
						
						case "pending": {
						
							$my_post = array();
							$my_post['ID'] 			= $pid; 
							$my_post['post_status'] = "pending";				
							wp_update_post( $my_post );						
						
						} break;
						
						case "trash": {
							wp_delete_post( $pid, true);
						} break;
					
					}				
					
				
				}elseif($_POST['cat'] != ""){
				
				wp_set_post_terms( $pid, $_POST['cat'], 'listing' );
				
				}elseif($_POST['pak'] != ""){
				
				 update_post_meta($pid, "packageID", $_POST['pak']);
				
				}
				
				// ON
				if($_POST['addon_featured'] == 1){
					 update_post_meta($pid, "featured", 1);				
				}
				
				// ON
				if($_POST['addon_homepage'] == 1){
					 update_post_meta($pid, "homepage", 1);				
				}
				
				// ON
				if($_POST['addon_sponsored'] == 1){
					 update_post_meta($pid, "sponsored", 1);				
				}
				
				// OFF
				if($_POST['addon_off_featured'] == 1){
					 update_post_meta($pid, "featured", 0);				
				}
				
				// OFF
				if($_POST['addon_off_homepage'] == 1){
					 update_post_meta($pid, "homepage", 0);				
				}
				
				// OFF
				if($_POST['addon_off_sponsored'] == 1){
					 update_post_meta($pid, "sponsored", 0);				
				}				
				
			}
		
		}	 	
		
		die(json_encode(array("status" => "ok")));
		
		
		} break;
	
	
		case "testing_order_add": {
		
			if(1 == 1){
			
				global $CORE;
			 	
				 
				 $i=0; while($i < 10){
				   
				 $orderadd = $CORE->ORDER('add', array(
				 	 	
					'order_status' 	=> $CORE->ORDER("get_status", "random"),
					
				 	'order_id' 		=> $CORE->ORDER("get_type", "random")."-".$CORE->ORDER("get_id", "random"),
					
					'user_id' => 1,
					
					'order_total' 		=> rand(10,9999),
					
					'order_shipping' 	=> rand(10,9999),
					
					'order_tax' 		=> rand(10,9999),
				 	
				 
				 ));
				 
				 
				 $i++; }
				 
				 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
	 
	
		case "log_delete_all": {
		
			$wpdb->query("DELETE FROM ".$wpdb->prefix."posts WHERE post_type = 'ppt_logs'");	
			
			die(json_encode(array("status" => "ok")));
			 
		} break;
		
		case "log_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_delete_post($_POST['uid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
		
		case "campaign_delete": {
		
			if(isset($_POST['pid']) && is_numeric($_POST['pid'])  ){
			 	
				 wp_delete_post($_POST['pid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
		
		case "comment_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_trash_comment($_POST['uid']); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
			
		case "subscriber_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_delete_post($_POST['uid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
		
		case "news_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_delete_post($_POST['uid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;

		case "cashout_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_delete_post($_POST['uid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
							
		case "order_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid'])  ){
			 	
				 wp_delete_post($_POST['uid'], true); 
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
	
 
		case "user_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid']) && $_POST['uid'] != 1 ){
			
				require_once(ABSPATH.'wp-admin/includes/user.php' );				
				
				$user = get_userdata( $_POST['uid'] );			
				
				if(!in_array( 'administrator', $user->roles ) ){
					wp_delete_user($_POST['uid']);
				}			
				
			
				die(json_encode(array("status" => "ok")));
			
			} 
		die(json_encode(array("status" => "error")));
		} break;
	
		case "update_title": {
		
				$the_post 				= array();
				$the_post['ID'] 		= $_POST['id'];
				$the_post['post_title'] = strip_tags(strip_tags($_POST['title']));
				wp_update_post( $the_post );
				
				die("ok");
		
		} break;
		
		case "update_custom_field": {
			
			if(is_numeric($_POST['pid'])){
				update_post_meta($_POST['pid'], $_POST['key'], $_POST['value']);
			}
				die("ok");
		
		} break;

		case "listing_catprice": {
				
			if(!is_numeric($_POST['cid'])){ die(0); }
				
			if(is_numeric($_POST['amount'])){
					$current_catprices = get_option('ppt_catprices');
					if(!is_array($current_catprices)){ $current_catprices = array(); }
					$current_catprices[$_POST['cid']] = $_POST['amount'];
					update_option('ppt_catprices',$current_catprices);
					die(1);				 
				}
			
			die(0);	 
				
		} break;
	
	} // end switch

}


// AJAX FROM WITHIN THE SITE
if(isset($_POST['action']) && $_POST['action'] !=""){

 
	switch($_POST['action']){ 
		
		
		case "ajax_cookie_accept": {
		
		
		$_SESSION['ppt-cookie'] = 1;
		die("ok");
		
		} break;
	 
 
		
		case "ajax_save_inline_editor": {
		 	
			
			if(function_exists('current_user_can') && current_user_can('administrator') ){
			
				$text 		= $_POST['text'];
				$id 		= $_POST['id'];			
				$orginal 	= ppt_decode_string($_POST['id'],"123");
				
				
				
				$translations = get_option("ppt_translations");
				if(!is_array($translations)){			
					$translations = array();
				}
				
				if($orginal == $text && isset($translations[$id]) ){
					unset($translations[$id]);
				}else{				
					$translations[$id] = $text;				
				}
				
				update_option("ppt_translations", $translations);
				
				die(json_encode(array("status" => "ok", "output" => $text, "id" => $id, "orginal_string" => $orginal, "all" => $translations )));
			
			}
		
		} break;
		
		
		case "ajax_username_generate": {
		
			$firstname = "john";			
			$lastname = "";
			$id = 0;
			$name = "john";
			if(isset($_POST['name']) && strlen($_POST['name']) > 2 && strlen($_POST['name']) < 10){
			$name = substr($_POST['name'],0,8);
			}
			
			if(strlen($name) > 2 ){
			
				$firstname = esc_html($name);
			
				$userNamesList = array();
			
				$numSufix = explode('-', date('Y-m-d-H')); 
 
				array_push($userNamesList, 
					"Big".$firstname,
					//$firstname."y".$firstname,       //jamesoduro 
					$firstname.$numSufix[0],    //james2019
					$firstname.$numSufix[1],    //james12 i.e the month of reg
					$firstname.$numSufix[2],    //james28 i.e the day of reg
					$firstname.$numSufix[3]     //james13 i.e the hour of day of reg
				);
				
			}
			 
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"data" 	=> $userNamesList,
					)
				)
			);
			
		} break;
		
		
	 case "ajax_username_validate":
		case "validateUsername": {	
		
			$name = str_replace("-"," ",strip_tags($_POST['un']));	
			
			if(strlen($name) > 2){
				
				$canContinue = true;
				$data = "";
				
				// CHECK ALREADY USED
				$dd = get_user_by( 'login', $name);	
				if(isset($dd->ID)){
				 $canContinue = false;
				 $data = "username taken";
				}
				 
				// CHECK FOR BAD WORDS
				if(ppt_theme_badwordlist($name, 1) == 1){
					$canContinue = false;
					$data = "bad word list";
				}				 
				 
				if($canContinue){
				die(
					json_encode(
						array(
							"status" 	=> "ok", 
							"data" 	=> $data,
						)
					)
				);
				}
			}	
 
				die(
					json_encode(
						array(
							"status" 	=> "invalid", 
							"data" 	=> $data,
						)
					)
				);					
		} break; 
	
		case "ajax_dashboard_order": {
		
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"data" 	=> $CORE->USER( "account_dash_order", $_POST['data'] ),
					)
				)
			);
			
		} break;	
	
		case "ajax_get_ip_test_map": {
		
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"data" 	=> $CORE->GEO( "ip_test_map", $_POST['s'] ),
					)
				)
			);
			
		} break;	
		case "ajax_get_ip_test": {
		
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"data" 	=> $CORE->GEO( "ip_test" ),
					)
				)
			);
			
		} break;
		
		

				
		case "ajax_get_list_custom": {
		
			$val = "";
			if(isset($_POST['val'])){
			$val = $_POST['val'];
			}
			header('Content-type: application/json; charset=utf-8');
			
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"data" 	=> $CORE->PACKAGE("list_custom", array($_POST['key'], $val) ),
					)
				)
			);
			
		} break;
	 
		case "ajax_media_publish": {
		  
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"msg" 	=> $CORE->MEDIA("media_publish", array($_POST['pid'], $_POST['vid'], $_POST['type'] )),
					)
				)
			);	
		
		} break; 
 
		
		case "ajax_get_video_space_used": {
		  	
			
			$pakid = 0;
			if(isset($_POST['packageid'])){
			$pakid = $_POST['packageid'];
			}
			
			$data = $CORE->MEDIA("get_video_space_used", array($_POST['pid'], $pakid));
			
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"total" 	=> $data['total'],
						"left" 		=> $data['left'],
						"published" => $data['published'],
					)
				)
			);	
		
		} break; 
	
		case "ajax_get_image_space_used": {
			
			$pik = 0;
			if(isset($_POST['packageid'])){
			$pik = $_POST['packageid'];
			}
		  
			$data = $CORE->MEDIA("get_image_space_used", array($_POST['pid'], $pik) );
			
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"total" 	=> $data['total'],
						"left" 		=> $data['left'],
						"published" => $data['published'],
					)
				)
			);	
		
		} break; 
	
		case "ajax_get_music_space_used": {
		  
		  	$pakid = 0;
			if(isset($_POST['packageid'])){
			$pakid = $_POST['packageid'];
			}
			
			$data = $CORE->MEDIA("get_music_space_used", array($_POST['pid'], $pakid));
			
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"total" 	=> $data['total'],
						"left" 		=> $data['left'],
						"published" => $data['published'],
					)
				)
			);
		
		} break; 
		
		
		case "ajax_qrcode": {
		   
			
			header('Content-type: application/json; charset=utf-8');				 	
			die(
				json_encode(
					array(
						"status" 	=> "ok", 
						"link" 	=> "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$_POST['link']."&choe=UTF-8", 
					)
				)
			);
		
		} break; 
		
	
	case "savesearch_get": { 
	
		
		
		$addLink = ' href="javascript:void(0);" onclick="savedsearch_add();"';
		if(!$userdata->ID){
			$addLink = 'onclick="processLogin();" href="javascript:void(0);"';
		}	
		
		if(!$userdata->ID){
			$output = '<a '.$addLink.' class="btn btn-system btn-block my-2 savesearchadd  btn-xl"> '.__("Save Search","premiumpress").'</a>';
		}else{
			
			ob_start();	 
			$savedsearches = get_user_meta($userdata->ID,'savedsearches',true);	
			if(!is_array($savedsearches)){ $savedsearches = array(); }
			$sc = 1; $so = 0;
			foreach($savedsearches as $sk => $ss){
			?>
			<div class="card p-2 mb-2 bg-light border-0 " id="savedsearchdiv<?php echo $sk; ?>"><div class="d-flex justify-content-between"><div><a href="javascript:void(0);" onclick="savesearch_go(<?php echo $sk; ?>)" class="text-dark font-weight-bold small"> <?php echo __("Search","premiumpress"); ?> <?php echo $sc; ?></a></div><a href="javascript:void(0);" onclick="savesearch_remove(<?php echo $sk; ?>)" class="text-danger"><i class="fa fa-times mr-2"></i></a></div></div><textarea style="display:none;" id="saveseachgo<?php echo $sk; ?>"><?php echo $ss; ?></textarea><?php $sc++; $so++; } ?><a <?php echo $addLink; ?> class="btn btn-system btn-block my-2 savesearchadd  btn-xl"><?php echo __("Save Search","premiumpress"); ?></a>
			<?php 
			$output = ob_get_contents();
			ob_end_clean();	
		
		}
        
        die(json_encode(array(			
				"status" 	=> "ok", 
				"output" 		=> trim($output),				 
				 
		)));
	
	} break;
	
	case "savesearch": {
	
			if(!$userdata->ID){
			return;
			}
			
			
			$savedsearches = get_user_meta($userdata->ID,'savedsearches',true);			
			if(!is_array($savedsearches)){ $savedsearches = array(); }
			 
			$key = count($savedsearches)+1;
			
			if(isset($savedsearches[$key])){
				$key = $key . rand(100,200);
			}
			 
			$savedsearches[$key] = $_POST['details']; 
			
			update_user_meta($userdata->ID,'savedsearches',$savedsearches);				
	 
			die(json_encode(array(			
					"status" 	=> "ok", 				 
			)));
	
	} break;
	
	case "savesearch_remove": {

			if(!$userdata->ID){
			return;
			}
			
			 
			$savedsearches = get_user_meta($userdata->ID,'savedsearches',true);			
			if(!is_array($savedsearches)){ $savedsearches = array(); }
			
			if(isset($savedsearches[$_POST['rid']])){
			unset($savedsearches[$_POST['rid']]);
			} 
			
			update_user_meta($userdata->ID,'savedsearches', $savedsearches);	
			
	
		$status = "ok";
	
		die(json_encode(array(			
				"status" 	=> $status, 
				//"link" 		=> $link,				 
				//"data" 		=> $newarray,	
		)));
	
	} break;
	
	case "comment_trash": {
	
 			$data = array(
				'comment_post_ID' => $_POST['cid'],
				'comment_approved' => 0, 
			);			
			wp_update_comment($data);			
			wp_trash_comment($_POST['cid']);	
			die(json_encode(array( "status" 	=> "ok", )));
	
	} break;
	

	
	
	
	case "chat_upload": {
	  
	
			// CHECK FOR FILE UPLOAD
			if(isset($_FILES['file']) && is_array($_FILES['file'])){	 // && 
			  
			   	
				if(!in_array($_FILES['file']['type'],$CORE->allowed_image_types) && !in_array($_FILES['file']['type'], $CORE->allowed_zip_types )  && !in_array($_FILES['file']['type'], $CORE->allowed_doc_types )){
			 	 
					die(json_encode(array("status" => "error","msg" => __("This file is not allowed.","premiumpress") .$_FILES['file']['type'] )));
				
				}
			   
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
					'name' 		=> $_FILES['file']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['file']['type'],
					'tmp_name'	=> $_FILES['file']['tmp_name'],
					'error'		=> $_FILES['file']['error'],
					'size'		=> $_FILES['file']['size'],
				);
				
				 
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	
				 
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					 
					die(json_encode(array("status" => "error", "msg" => $uploaded_file['error'] )));
					
				}else{
				
					// set up the array of arguments for "wp_insert_post();"
					$attachment = array(			 
						'post_mime_type' => $_FILES['file']['type'],
						'post_title' 	=> $_FILES['file']['name'],
						'post_content' 	=> '',
						'post_author' 	=> $userdata->ID,
						'post_status' 	=> 'inherit',
						'post_type' 	=> 'attachment',
						'post_parent' 	=> 0,
						'guid' 			=> $uploaded_file['url']
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
					
					// UPDATE
					$fd = array("status" => "ok","thumbnail" => $thumbnail, "src" => $uploaded_file['url'], "aid" => $attachment_id, "type" =>  $_FILES['file']['type'], "size" =>  $_FILES['file']['size']   );
					
					
					add_post_meta($attachment_id, "chat_attach_data", $fd); 
					
					die(json_encode($fd));
			 
			 	}
			 
			} // end if
			
			
			die(json_encode(array("status" => "error","msg" => "no file")));
	
	} break;
	
	
	
/*

	/////////////////////////////// LOGIN OPTIONS
	// UPDATED: AUG 2020

*/
				
		case "load_editlisting_form": {	 
			 
			$_GET['eid'] = $_POST['eid']; global $userdata;
			
			$_POST['ajaxedit'] = 1;
			
			if(!$userdata->ID && !in_array($_POST['type'], array("photo","category","map","sms","makemodel","type"))){ die(); }
			 
			switch($_POST['type']){
			
			 	case "sms": {
				
				_ppt_template('widgets/account-verify-sms' );
				 
				} break;
			 	case "top": {
				
				_ppt_template('framework/design/add/add-background' );
				 
				} break;	
				
				case "titletop":
				case "title": {
				
				_ppt_template('framework/design/add/add-title' );
				 
				} break;
				case "type": {
				
				_ppt_template('framework/design/add/add-type' );
				 
				} break;
				case "category": {
				
				_ppt_template('framework/design/add/add-category' );
				 
				} break;
				
				case "excerpt": {
				
				_ppt_template('framework/design/add/add-excerpt' );
				 
				} break;
				
				case "content": {
				
				_ppt_template('framework/design/add/add-content' );
				 
				} break;
				
				case "map": {
				
				_ppt_template('framework/design/add/add-map' );
				 
				} break;
				
				case "customfields": {
				
				_ppt_template('framework/design/add/add-customfields' );
				 
				} break;
				
				case "makemodel": {
				
				_ppt_template('framework/design/add/add-makemodel' );
				 
				} break;
				
				case "photo":
				case "imagestop":
				case "images": {
				
				$GLOBALS['file_key'] = "photo";
				$GLOBALS['reload_photo'] = 1;
				_ppt_template('framework/design/add/add-files' );
				 
				} break;
				
				case "audio": {
				 
				$GLOBALS['file_key'] = "audio";
				$GLOBALS['reload_audio'] = 1;
				_ppt_template('framework/design/add/add-files' );
				
				} break;
				
				case "video": {
				 
				$GLOBALS['file_key'] = "video";
				$GLOBALS['reload_video'] = 1;
				_ppt_template('framework/design/add/add-files' );
				
				} break;
				
				case "features": {
				
				_ppt_template('framework/design/add/add-features' );
				 
				} break;
				
				case "lookingfor": {
				
				_ppt_template('framework/design/add/add-lookingfor' );
				 
				} break;
				
				case "openinghours": {
				
				_ppt_template('framework/design/add/add-workinghours' );
				 
				} break;
				
				case "compare": {
				
				_ppt_template('framework/design/add/add-compare' );
				 
				} break;	
				
				case "stores": {
				
				_ppt_template('framework/design/add/add-compare-stores' );
				 
				} break;	
				
				case "shopfields": {
				
				_ppt_template('framework/design/add/add-product' );
				_ppt_template('framework/design/add/add-product-details' );
				
				} break;	
				
				case "videoseries": {
				
				_ppt_template('framework/design/add/add-videoseries' );
				
				} break;
				
				case "callrates": {
				
				_ppt_template('framework/design/add/add-callrates' );
				
				} break;
				
				case "services": {
				
				if(in_array(THEME_KEY, array("mj"))){
				_ppt_template('framework/design/add/add-faq' );
				
				}elseif(in_array(THEME_KEY, array("cm"))){
				
				_ppt_template('framework/design/add/add-compare-stores' );
				
				}else{
				_ppt_template('framework/design/add/add-services' );
				}
				
				
				
				} break;
			 
			 }
			 
			die();
		
		} break;
		
		
	case "get_comments": { 
 
		_ppt_template( 'ajax/ajax-modal-user-feedback' );
			 
		die();
	
	} break;
		case "load_elementor": {			
			 
			_ppt_template( 'framework/elementor/popup' );
			 
			die();
		
		} break;	
		case "load_cookie": {			
			 
			_ppt_template( 'ajax/ajax-modal-cookie' );
			 
			die();
		
		} break;	
		case "load_gifts": {			
			 
			_ppt_template( 'ajax/ajax-modal-gift' );
			 
			die();
		
		} break;
		
		case "load_addon_homepage": {			
			 
			_ppt_template( 'ajax/ajax-modal-addon-homepage' );
			 
			die();
		
		} break;
		
		case "load_addon_sponsored": {			
		
			_ppt_template( 'ajax/ajax-modal-addon-sponsored' );
			 
			die();
		
		} break;
		
		case "load_addon_featured": {			
			 
			_ppt_template( 'ajax/ajax-modal-addon-featured' );
			 
			die();
		
		} break;	
		
		case "load_addon_boost": {			
			 
			_ppt_template( 'ajax/ajax-modal-addon-boost' );
			 
			die();
		
		} break;
		
		case "load_block_preview_cat": {			
			 
			_ppt_template( 'ajax/ajax-block-preview-cat' );
			 
			die();
		
		} break;
		
		case "load_upload_images": {			
			 
			_ppt_template( 'ajax/ajax-modal-images' );
			 
			die();
		
		} break;
		case "load_upload": {			
			 
			_ppt_template( 'ajax/ajax-modal-upload' );
			 
			die();
		
		} break;
		case "load_disputes": {			
			 
			_ppt_template( 'ajax/ajax-modal-disputes' );
			 
			die();
		
		} break;		
		case "load_notifications": {			
			 
			_ppt_template( 'ajax/ajax-modal-notify' );
			 
			die();
		
		} break;
		
		case "load_download": {			
			 
			_ppt_template( 'ajax/ajax-download' );
			 
			die();
		
		} break;		
		case "load_sidebar": {			
			 
			_ppt_template( 'ajax/ajax-sidebar' );
			 
			die();
		
		} break;

		case "load_payuser_form": {
			 
			_ppt_template( 'ajax/ajax-modal-payuser' );
			 
			die();
		
		} break;
				
		case "load_register_form": {
			 
			_ppt_template( 'ajax/ajax-modal-register' );
			 
			die();
		
		} break;
		
		case "load_languages": {			
			 
			_ppt_template( 'ajax/ajax-modal-languages' );
			 
			die();
		
		} break;
		
		case "load_listingstats_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-stats' );
			 
			die();
		
		} break;
		
		case "load_listingupgrade_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-upgradelisting' );
			 
			die();
		
		} break;	
					
		case "load_upgrade_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-memberships' );
			 
			die();
		
		} break;					
			
		case "load_credit_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-credit' );
			 
			die();
		
		} break;
				
		case "load_login_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-login' );
			 
			die();
		
		} break;
		
		case "load_video_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-video' );
			 
			die();
		
		} break;
		
		case "load_images_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-images' );
			 
			die();
		
		} break;
		
		case "load_msg_form": {			
			 
			_ppt_template( 'ajax/ajax-modal-msg' );
			 
			die();
		
		} break;
		
		
		case "load_contactform": {			
			 
			_ppt_template( 'single/single-contact' );
			 
			die();
		
		} break;
		
		case "load_search_filter": {			
			 
			_ppt_template( 'ajax/ajax-modal-filter' );
				 
			die();
			
		} break;
		
		case "load_terms": {			
			 
			_ppt_template( 'ajax/ajax-modal-terms' );
				 
			die();
			
		} break;
		
		case "load_cashback": {			
			 
			_ppt_template( 'ajax/ajax-modal-cashback' );
				 
			die();
			
		} break;
		
		case "login_process": {	
		
			// PREPARE DATA
		  	$data = array();
		  	parse_str($_POST['formdata'], $data);			 
			
			
			if(isset($_SESSION['ppt_cart'])){
			$savedSession = $_SESSION['ppt_cart'];			
			}
			
			// LOGIN						
			global $CORE, $userdata;
			$ff = $CORE->USER_LOGIN($data['log'], $data['pwd'], $return = 1 );
			 	 
			 
			// RETURN DATA
			$msg = ""; $link = ""; $status = "ok";
			if(strpos($ff,"http") === false){
				$msg = $ff;
				$status = "error";	
				
			}elseif( strpos(strtolower($ff),"error") != false ){
			 
				$msg = $ff;
				$status = "error";	
				
			}elseif(isset($data['reload'])){			
				$status = "reload";						
			}else{
				
				$link = $ff;
			 
				if(isset($data['extra']) && $data['extra'] != ""){
					
					if(strpos($data['extra'],"mem") !== false){					
						
						$memdata = $CORE->USER("get_this_membership", $data['extra']);						
						$link =  $CORE->order_encode(array(  
					               
						   "uid" 					=> $userdata->ID,                
						   "amount" 				=> $memdata['price'], 
						   "order_id" 				=> "SUBS-".$data['extra']."-".$userdata->ID."-".rand(),                 
						   "description" 			=> $memdata['name'],
						   "recurring" 				=> $memdata['recurring'],    
						   "recurring_days" 		=> $memdata['duration'],            
						   "couponcode" 			=> "", 					                 
					   	));
						
						$status = "func_mem";						 
						$msg 	= hook_price($memdata['price']);
					
					
					}elseif(strpos($data['extra'],"pak") !== false){	
					
						$status = "ok";	
						$link = _ppt(array('links','add'))."?pakid=".str_replace("pak","", $data['extra']);
					
					} 
					
					
					
				}				
			}
			
			
			if(isset($savedSession) && $savedSession != ""){
			$_SESSION['ppt_cart'] = $savedSession;
			}
			 
			 
			die(json_encode(array(			
				"status" 	=> $status, 
				"link" 		=> $link,				 
				"msg" 		=> $msg,	
			)));
		
		} break;
		
		
		
		case "register_process": {	
		
			// PREPARE DATA
		  	$customdata = array();
			  
			$data = array("custom" => array());
			$temp = $_POST['data'];
			 
			
			// BUILD ARRAY OF ALLOWED FIELDS
			$Afields = array("first_name" => "first_name", "last_name" => "last_name", "user_type" => "user_type", "user_interest" => "user_interest", "username" => "username", "user_email" => "user_email", "user_pass" => "user_pass");
			$Cfields = array();
			$regfields = get_option("regfields"); 
			if(is_array($regfields) && !empty($regfields['name']) ){ $i=0;  
				foreach($regfields['name'] as $d){ 
					if( strlen($regfields['name'][$i]) > 1 ){ 					
				 		$Cfields[trim($regfields['key'][$i])] = trim($regfields['key'][$i]);					 
					}
					$i++;
				}
			}
			 
			// CLEAN UP FOR OLD FORMATTING
			if(is_array($temp) && !empty($temp)){			
				foreach($temp as $k => $v){
					if(strlen($v) > 0 && in_array($k,$Afields) ){												  
						$data[$k] =  esc_html($v);					 		
					}elseif(strlen($v) > 0 && in_array($k,$Cfields) ){												  
						$data['custom'][$k] =  esc_html($v);					 		
					}							
				}				
			}
			
			// VALIDATE
			if ( !is_email( $data['user_email'] ) ) {
				die(json_encode(array("status" => "error", "msg" => __("Invalid Email Address","premiumpress")  )));
			}
			
			if ( email_exists( $data['user_email'] ) ) {
				die(json_encode(array("status" => "error", "msg" => __("Email Address Already Used","premiumpress")  )));
			}
			
			if (  isset($data['username']) && ppt_theme_badwordlist( $data['username'], 1) == 1 ) {
				die(json_encode(array("status" => "error", "msg" => __("Invalid Username","premiumpress")  )));
			}
			
			// CREATE PASSWORD FOR USER
			if(!isset($data['user_pass'])){	
				$data['user_pass'] = wp_generate_password( $length=12, $include_standard_special_chars=false );			
			}
			 
			
			// USER TYPE
			if(isset($data['user_type']) ){ 			
			$data['custom']['user_type'] = $data['user_type'];
			}
			
			if(THEME_KEY == "da" && isset($data['user_interest']) ){	
			$data['custom']['da-seek2'] = $data['user_interest'];
			}
			
			// CREATE USERNAME
			if(isset($data['username'])){			
				$username = $data['username'];
			}else{
						
				if(!isset($data['first_name'])){
				
					$data['first_name'] = "";
					$data['last_name'] = "";
					
					$username = "user_".wp_generate_password( $length=5, $include_standard_special_chars=false );		  
				
				}else{
				
					$username = $data['first_name'].wp_generate_password( $length=5, $include_standard_special_chars=false );		  
				
				}			
			}
			
			  
			// captcha code from Google
			if(isset($temp['g-recaptcha-response']) && _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){  //
			
				if($temp['g-recaptcha-response'] == ""){					
					die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));				
				}
			 
				$args = array(
					'secret'   => _ppt(array('captcha','secretkey')),
					'response' => $temp['g-recaptcha-response'],
				);
			 
				$gcaptcha = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify' , $args );
		
				if ( is_wp_error( $gcaptcha ) ) {
					 
				}else{
				
					$body = wp_remote_retrieve_body( $gcaptcha );
					if ( empty( $body ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}
					$result = json_decode( $body );
					if ( empty( $result ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}
					if ( ! isset( $result->success ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}				 
				
				}		 
			
			} 
			 
			$ff = $CORE->USER_REGISTER($username, $data['user_pass'], $data['user_email'], $data, 1 );
		 
			$userID = $GLOBALS['newuserID'];
		 	  
			// RETURN DATA
			$msg = ""; $link = ""; $status = "ok";
			
			if(strpos($ff,"http") === false ){
			
				$msg = $ff;
				$status = "error";	
			 
			}elseif(isset($data['reload'])){	
					
				$status = "reload";
				
			}else{
				
				$link = $ff;
			 
				if(isset($data['extra']) && $data['extra'] != ""){
					
					if(strpos($data['extra'],"mem") !== false){					
						
						$memdata = $CORE->USER("get_this_membership", $data['extra']);						
						$link =  $CORE->order_encode(array(  
					               
						   "uid" 					=> $userID,                
						   "amount" 				=> $memdata['price'], 
						   "order_id" 				=> "SUBS-".$data['extra']."-".$userID."-".rand(),                 
						   "description" 			=> $memdata['name'],
						   "recurring" 				=> $memdata['recurring'],    
						   "recurring_days" 		=> $memdata['duration'],            
						   "couponcode" 			=> "", 					                 
					   	));
						
						$status = "func_mem";						 
						$msg 	= hook_price($memdata['price']);
					
					
					}elseif(strpos($data['extra'],"pak") !== false){	
					
						$status = "ok";	
						$link = _ppt(array('links','add'))."?pakid=".str_replace("pak","", $data['extra']);
					
					}
					
				}				
			} 
			 
			die(json_encode(array(			
				"status" 	=> $status, 
				"link" 		=> $link,				 
				"msg" 		=> $msg,
				"userid" => $userID,	
			)));
		
		} break;		
	
/*

	/////////////////////////////// LOGIN OPTIONS

*/	
	
	
	 case "get_alerts_reset": {	 
	 
	 
		if(isset($_POST['type']) && $_POST['type'] == "msg"){								
		
			$wpdb->query("DELETE FROM ".$wpdb->prefix."postmeta WHERE meta_value = ('unread_".$userdata->ID."') ");
		}
	 
	 
	 } break;
	 
	
 	case "get_alerts": {
	
		$output = ""; $count = 0;
		
		if(isset($_POST['uid']) && is_numeric($_POST['uid'])) {
		
		
			// COUNT MESSAGES
			$mymsg = $CORE->USER("count_messages_unread", $_POST['uid']);			
			
			$count += $mymsg;
			 
			
			if($mymsg > 0){ 
			
			
			ob_start();	
			?>  
			<a onclick="ShowAlertBoxReset('msg');SwitchPage('messages');" href="javascript:void(0);" class="dropdown-notification-item">
			
			<div class="dropdown-notification-icon">
			<i class="fal fa-envelope fa-lg fa-fw text-success mr-3"></i>
			</div>
			<div class="dropdown-notification-info">
			<div class="title"><?php echo str_replace("%s", $mymsg, __("You have %s unread messages.","premiumpress") ); ?></div>
			 
			</div>
			<div class="dropdown-notification-arrow">
			<i class="fa fa-chevron-right"></i>
			</div>
			</a>
			<?php 
			$output .= ob_get_contents();
			ob_end_clean();			
			} 
			
			
			// NO MESSAGES
			if($output == ""){
			ob_start();		
			?>
			<a href="#" class="dropdown-notification-item bg-light">
				<div class="dropdown-notification-info text-center">
				  <div class="title"><?php echo __("No new notifications","premiumpress") ?></div>
				</div>
			</a><?php			
			$output .= ob_get_contents();
			ob_end_clean();	
			}
		
		
			die(json_encode(array("status" => "ok", "data" => $output, "count" => $count )));
		
		}
	
	} break;	
	

	case "comment_quick": {
	 
	 $status = "error"; $msg = "Invalid Comments.";
	if(strlen($_POST['comment']) > 0 ){
				 
				  
				$data = array(
					'comment_post_ID' 		=> $_POST['pid'],
					'comment_author' 		=> $userdata->display_name,
					'comment_author_email' 	=> 'admin@admin.com',
					'comment_author_url' 	=> 'http://',
					'comment_content' 		=> strip_tags(esc_html($_POST['comment'])),
					'comment_type' 			=> '',
					'comment_parent' 		=> 0,
					'user_id' 				=> $userdata->ID,
					'comment_author_IP' 	=> $this->get_client_ip(),
					'comment_agent' 		=> 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
					'comment_date' 			=> current_time('mysql'),
					'comment_approved' 		=> 0,
				);
				
				$commentid = wp_insert_comment($data);					
						
				// SAVE COMMEN META INCASE WE DELETE IT					 			
				add_comment_meta( $commentid, 'ratingtotal', 5 );
				add_comment_meta( $commentid, 'rating1', 5 );
				add_comment_meta( $commentid, 'feedback', 1 );
				add_comment_meta( $commentid, 'ratingpid', $_POST['pid'] );	
			 
				$_POST['value'] = 5;
				
				$CORE->PACKAGE(", $commentid)", $_POST['pid'], $commentid); 
				
				$status = "ok";	 
				
	}
	
	die(json_encode(array("status" => $status, "msg" => $msg  )));
	
	} break;
	
	case "notify_delete": {
	
		global $userdata;

		$status = "error";
		if(isset($_POST['nid']) && is_numeric($_POST['nid']) ){
		
			update_post_meta($_POST['nid'], "log_hide_".$userdata->ID, 1);
			
			$status = "ok";
		}
		
		die(json_encode(array("status" => $status  )));
	
				
	} break;
	
	case "notification_clear": {
	
		global $userdata, $CORE;
		
		if($userdata->ID){
		
		$CORE->USER("logs_clear_count", $userdata->ID );
		
		$wpdb->query("DELETE FROM ".$wpdb->prefix."postmeta WHERE meta_value = ('unread_".$userdata->ID."') ");
		
		}
		
		die(json_encode(array("status" => "ok"  )));
		
	} break;
	
	case "notification_bubble": {
	
	global $userdata, $CORE;
	 
	if(in_array(_ppt(array('user','notify')), array("","1")) ){
	
		// STATUS
		$status = "none";
		$total_unread = 0;
		$total_notify = 0;
		
		$popup_msg 		= 0;
		$popup_login 	= 0;
		$popup_logout 	= 0;
		$popup_upgrade 	= 0;
		$popup_custom 	= 0;
		
		// if not logged in
		if($userdata->ID){ 
			
			// GET NEW MESSAGE COUNT
			$total_unread = $CORE->USER("count_messages_unread", $userdata->ID); 
			
			if($total_unread > 0){
			
				$last = $CORE->USER("get_messages_unread", $userdata->ID);
				if(!empty($last)){
				
					$uid = $last->post_author;
									
					$popup_msg = array(
					"uid"		=> $uid,
					"name" 		=> $CORE->USER("get_display_name", $uid),
					"image" 	=> $CORE->USER("get_avatar", $uid),
					"link"		=> $CORE->USER("get_user_profile_link", $uid),
					);
				}
			
			}
			
			// COUNT ALL NOTIFICATIONS
			$total_notify = $CORE->USER("count_get_logs", $userdata->ID);
		} 
		 
		
		// GET NEW MESSAGE COUNT
		foreach(array("login","logout","upgrade","custom") as $check){
			$popData = $CORE->ADVERTISING("popup_get",$check); 
			if( is_array($popData) && !empty($popData) ){	
				switch($check){
					case "login": 	{ 	$popup_login 	= $popData; } break;
					case "logout": 	{ 	$popup_logout 	= $popData; } break;
					case "upgrade": { 	$popup_upgrade 	= $popData; } break;
					case "custom": 	{ 	$popup_custom 	= $popData; } break;
				}				
			}
		} 
		
		// LASTLY CHECK FOR GUEST POP
		if(!$userdata->ID && $popup_custom == 0 && _ppt(array('liveads','guests')) == "1" && !isset($_SESSION['seen_ads_guest']) ){
		
			$arrayK = array(1,2,3,4,5);
			shuffle($arrayK);
			
			foreach($arrayK as $i){
			
				 $title = _ppt(array('liveads','g'.$i.'_title'));
				 if($title != ""){ 
				 
					 $img 	= _ppt(array('liveads','g'.$i.'_img'));
					 $link 	= _ppt(array('liveads','g'.$i.'_link'));					 
					 if($link == ""){
					 	$link = wp_login_url();
					 }	
					 			 
					 $popup_custom = array(
						"name" 		=> $title,
						"image" 	=> $img,
						"link"		=> $link,
						"hide"		=> 1,
					);		
					
					$_SESSION['seen_ads_guest'] = 1;		 
				 }			
			}			
		}
		
  
			
		die(json_encode(array(
		"status" => $status, 
		"uid" => 0, 
		"n_count" => $total_notify, 
		"m_count" => $total_unread, 
		"popup_login" => $popup_login, 
		"popup_logout" => $popup_logout, 
		"popup_upgrade" => $popup_upgrade, 
		"popup_msg" => $popup_msg,
		"popup_custom" => $popup_custom		
		)));
 		
		
		
	}
	
	die(json_encode(array("status" => "stop")));
 
	
	} break;
	
	
	
	case "subscribe_deleteall": {	
	
			$extn = "_list";
			$type = "subscribe";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			update_user_meta($_POST['uid'], $type.$extn, "");
			 
	
		die(json_encode(array("status" => "ok")));
		
	} break;
	
	
	
	case "subscribe": {
	
		$extn = "_list";
		$type = "subscribe";
		$userid =  $_POST['uid'];
		$output = "";
		
		if(isset($_POST['type'])){
		$type = $_POST['type'];
		}
		
		$css = "";
		if(isset($_POST['css'])){
		$css = $_POST['css'];
		}
		
		$button = "";
		if(isset($_POST['button'])){
		$button = $_POST['button'];
		}
		
		$pid = "";
		if(isset($_POST['pid'])){
		$pid = $_POST['pid'];
		}
		
		if($userdata->ID && is_numeric($userid) ){
		
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}						
			 
			$my_list = get_user_meta($userdata->ID, $type.$extn, true);	
			
			$their_list = get_user_meta($userid, $type.$extn."_followers", true);	
								
							
			if(is_array($my_list) && in_array($userid, $my_list) ){
			
				$result = $my_list;							
				unset($result[array_search($userid, $result)]);
				
				$result1 = $their_list;							
				unset($result1[array_search($userdata->ID, $result1)]);				
				
				$status = "add";	
					
					
					 
					$logname = "public_user_unsubscribe";				
				
					// ADD PUBLIC LOG
					if($userdata->ID && !in_array($type,array("like","dislike")) ){
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> $logname,
								"to" 		=> $userid, 						
								"from" 		=> $userdata->ID,	
							)
						);
					}
					 
					 
				
			}else{			 
				
				$result = array_merge((array)$my_list, array($userid));
				
				$result1 = array_merge((array)$their_list, array($userdata->ID));	
				
					$status = "remove";	 
					
					$logname = "public_user_subscribe";
				
					// ADD PUBLIC LOG
					if($userdata->ID && !in_array($type,array("like","dislike"))){
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> $logname,
								"to" 		=> $userid, 						
								"from" 		=> $userdata->ID,
							)
						);
					}
					
					// REMOVE FROM MY BLOCKED LSIT TOO
					$my_blocked_list = get_user_meta($userdata->ID, "blocked", true);	
					if(is_array($my_blocked_list) && in_array($userid, $my_blocked_list) ){			
						$result2 = $my_blocked_list;							
						unset($result2[array_search($userid, $result2)]);						
						update_user_meta($userdata->ID, "blocked", $result2);					
					}
				
				
			}
			
			/*** now cleanup array(); ***/
			if(is_array($result)){
			$newResult = array();
					foreach($result as $g){
						if(is_numeric($g)){
							$newResult[] = $g;
						}
					}
			}
			
			/*** now cleanup array(); ***/
			if(is_array($result1)){
			$newResult1 = array();
					foreach($result1 as $g){
						if(is_numeric($g)){
							$newResult1[] = $g;
						}
					}
			}					
					
			update_user_meta($userdata->ID, $type.$extn, $newResult);						
			update_user_meta($userid, $type.$extn."_followers", $newResult1);
		
		}else{
			$status = "login";	
		}
		
		
		if(isset($_POST['showtext']) && $_POST['showtext'] == 1){
		$output = do_shortcode('[BUTTON_USER type="'.$type.'" pid="'.$pid.'" class="'.$css.'" button="'.$button.'" text=1 uid="'.$userid.'"]');
		}else{
		$output = do_shortcode('[BUTTON_USER type="'.$type.'" pid="'.$pid.'" class="'.$css.'" button="'.$button.'" icon=1 uid="'.$userid.'"]');
		}
		
		header('Content-type: application/json');
		$n = array("status" => $status, "data" => $type.$extn, "output" => $output, "pid" => $pid );
		die(json_encode($n));
	
	} break;
	
	case "favs_reset": { 
	
			$extn = "_list";
			$type = "favorite";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			update_user_meta($_POST['uid'], $type.$extn, "");
			 
	
		die(json_encode(array("status" => "ok")));
	
	} break;
	
	case "favs": {
	
		$extn = "_list";
		$type = "favorite";
		$postid =  $_POST['pid'];
		
		if($userdata->ID){
		
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			
			$my_list = get_user_meta($userdata->ID, $type.$extn, true);						
							
			if(is_array($my_list) && in_array($postid, $my_list) ){
			
				$result = $my_list;							
				unset($result[array_search($postid, $result)]);
				$status = "add";
				
			}else{			 
				$result = array_merge((array)$my_list, array($postid));	
				$status = "remove"	;		
			}
			
			/*** now cleanup array(); ***/
			if(is_array($result)){
			$newResult = array();
					foreach($result as $g){
						if(is_numeric($g)){
							$newResult[] = $g;
						}
					}
			}
					
			update_user_meta($userdata->ID, $type.$extn, $newResult);
		
		}else{
			$status = "login";	
		}
		
		header('Content-type: application/json');
		$n = array("status" => $status);
		die(json_encode($n));
	
	} break;
	
	case "load_map_data": {
	
			$data =	$CORE->GEO("get_mapdata",array());
			header('Content-type: application/json');
			$n = array("mapdata" => $data );
			die(json_encode($n));
	
	} break;
	
	case "update_user_payment": {
	
		if(is_numeric($_POST['id'])){
			
		 	
			update_post_meta($_POST['id'],'order_status', $_POST['val']);
			
			// IF PAYMENT HAS AN OFFER, UPDATE THIS TOO			
			$offer_id = get_post_meta($_POST['id'],'offer_id', $_POST['val']);
			if($offer_id != ""){
				update_post_meta($offer_id,'payment_complete', date('Y-m-d H:i:s') );
			}
 			  		 	
		 	
		}
		die();
	
	} break; 
 	
	case "cancel_membership": {
	 	
		update_user_meta($_POST['uid'], 'ppt_subscription', "" );
		
		return 1; 
	
	
	} break;	
	
	case "events_set_attending": {
	
	
	$attending = get_post_meta($_POST['pid'],'attending',true);
	if(!is_array($attending)){ $attending = array(); }	
	
	if(isset($attending[$_POST['uid']] )){
	unset($attending[$_POST['uid']]);
	}else{
	$attending[$_POST['uid']] = $_POST['uid'];	
	}
		
	update_post_meta($_POST['pid'],'attending',$attending);
	
	die("ok");
	
	
	} break;
	
	case "rating_likes_check": {


		if(is_numeric($_POST['pid']) ){ 
			 
				// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
				$rated_user_ips = get_option('rated_user_ips');
				$user_ip = $CORE->get_client_ip();
				if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
				 
				if(isset($rated_user_ips[$_POST['pid']]) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ip-'.$user_ip])  ){ 
					
					echo "none";
					die();
				
				}else{
				
					echo "1";
					die();
				
				}
			
		}// end if if valid pid
				 
		echo "none";			
		die();
	
	} break;
	
		case "rating_likes": {	
		 
		 		 
			if(is_numeric($_POST['pid']) ){ 
			 
				// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
				$rated_user_ips = get_option('rated_user_ips');
				$user_ip = $CORE->get_client_ip();
				if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
				 
				if(1==2 && THEME_KEY != "da" && isset($rated_user_ips[$_POST['pid']]) && is_array($rated_user_ips[$_POST['pid']]['ip-'.$user_ip]) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ip-'.$user_ip])  ){ 
					
					echo "none";
					die();
				
				}else{
				
					// GET EXISTING DATA
					if($_POST['value'] == "up"){
						$result = get_post_meta($_POST['pid'], 'ratingup', true);
						if(!is_numeric($result)){ $result = 1; }else{ $result = $result + 1; }
						update_post_meta($_POST['pid'], 'ratingup', $result);
						$value = 1;
					}else{
						$result = get_post_meta($_POST['pid'], 'ratingdown', true);
						if(!is_numeric($result)){ $result = 1; }else{ $result = $result + 1; }
						update_post_meta($_POST['pid'], 'ratingdown', $result);	
						$value = 0;				
					}
					
					// SAVE RESULTS			
					$total = get_post_meta($_POST['pid'], 'rating_total', true);	
					if(!is_numeric($total)){ $total = 1; }else{ $total = $total + 1; }	
					update_post_meta($_POST['pid'], 'rating_total', $total);					
					
					// UPDATE LIKES COUNTER
					if(in_array(THEME_KEY,array("da","vt"))){
					$CORE->USER("update_rating_likes_new", array($_POST['pid'], $_POST['value']) );
					}else{
					$CORE->USER("update_rating_likes", $_POST['pid'] );
					} 
					
					// SAVE USER IP
					if(THEME_KEY != "da"){
					if(!isset($rated_user_ips[$_POST['pid']]['ip-'.$user_ip])){ $rated_user_ips[$_POST['pid']]['ip-'.$user_ip] = array(); }
					$rated_user_ips[$_POST['pid']]['ip-'.$user_ip] = array_merge($rated_user_ips[$_POST['pid']]['ip-'.$user_ip],array("ip" => $user_ip, "rating" => $value));
					update_option('rated_user_ips', $rated_user_ips); 
					}
					
					echo $result;
					die();
				
				}
			
			}// end if if valid pid
				 
			echo "none";			
			die();
			
		} break;
	
	
		// CHANGE MESSAGE STATUS ONCLICK	
		case "msg_changestatus": {	
				if(is_numeric($_POST['id'])){			
						update_post_meta($_POST['id'],"status","read");	
						}					 	
		} break;
	
	

		
		case "resendvemail": {
				 
				// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 			=> "user_verify",							 
								"userid" 		=> $_POST['uid'],								
								"email_data" 	=> array(	
									"user_id" 		=> $_POST['uid'],			 		
									"username" 		=> $CORE->USER("get_username", $_POST['uid']),
									"first_name" 	=> $CORE->USER("get_firstname", $_POST['uid']),
									"last_name" 	=> $CORE->USER("get_lastname", $_POST['uid']),
									"password" 		=> "",
									"email" 		=> $CORE->USER("get_email", $_POST['uid']),		 
								)			 
							)
				);
		
			die(json_encode(array("status" => "sent", "uid" => $_POST['uid'] )));
		
		} break;


		case "update_usage": {				

				// UPDATE LAST USED
				update_post_meta($_POST['pid'],'lastused', current_time( 'mysql' ));		
				
				$c = get_post_meta($_POST['pid'],'used',true);
				if(!is_numeric($c)){
				$c = 0;
				}
				
				// USED COUNT
				update_post_meta($_POST['pid'],'used', $c + 1);
				
		} break;
	

		
		case "sms_code_send": {
			
			$response = array("status" => "invalid", "msg" => "no number");
						
			if(isset($_POST['num']) && $_POST['num'] > 6){			
				$response = $CORE->SMS_CODE_SEND($_POST['num']);
			}
			
			header('Content-type: application/json');
			die(json_encode($response));
		
		} break;
		
		case "sms_code_validate": {
			
			$response = array("status" => "invalid", "msg" => "invalid number");
			
			if(isset($_POST['num']) && strlen($_POST['num']) > 1 && isset($_POST['code']) && strlen($_POST['code']) > 1 ){					
				$response = $CORE->SMS_CODE_VALIDATE($_POST['num'], $_POST['code']);				 
			}
			
			// UPDATE USER ACCOUNT
			if($response["status"] == "ok"){	
			
				update_user_meta($userdata->ID,'ppt_sms_verified',1);
				update_user_meta($userdata->ID,'ppt_sms_verified_num',$_POST['num']);
				update_user_meta($userdata->ID,'ppt_sms_verified_date', date("Y-m-d H:i:s") );
				update_user_meta($userdata->ID,'mobile',$_POST['num']);
						
			}
			
			header('Content-type: application/json'); 
			die(json_encode($response));
		
		} break;
		
	
		case "get_email_content": {
			
			$emailid = $_POST['emailid'];
			
			// EMAILS
			$ppt_emails = get_option("ppt_emails");

			if(is_array($ppt_emails)){ 
				foreach($ppt_emails as $key => $field){ 
				
					if($emailid == $key){
						die($field['message']);
					}
				 
				} 
			} 
		
			die();
		
		} break;
				
		/*
			this function gets a users email
			address from their user id
		*/
		case "get_user_email": {
		
			$userid = $_POST['uid'];
			if(is_numeric($userid)){
				die(get_the_author_meta( 'email', $userid));
			}
			
			die();		
		} break;
	
		case "load_media_delete": {
		
			update_post_meta($_POST['pid'], 'image','');
			die();
		
		} break;
		
		case "delete_account_cancel": {
		
			global $userdata;
			 
			delete_user_meta($userdata->ID, "deleteme");
				 
			header('Content-type: application/json');
			$n = array("status" => "ok");
			die(json_encode($n));
		
		} break;		
		case "delete_account": {
		
			global $userdata;
			 
			update_user_meta($userdata->ID, "deleteme", date("Y-m-d H:i:s") );
				 
			header('Content-type: application/json');
			$n = array("status" => "ok");
			die(json_encode($n));
		
		} break;
		
		case "video_set_background": {
		
			$status = "error";
			if(isset($_POST['aid']) && is_numeric($_POST['aid']) ){
			 
				$CORE->MEDIA("video_set_background", array( $_POST['pid'], $_POST['aid'], $_POST['vid'] ) );
				
				$status = "ok";
			
			}
			
			header('Content-type: application/json');
			$n = array("status" => $status);
			die(json_encode($n));
			
		} break;
		
		
		case "setbg_file": {
		
			$status = "error";
			if(isset($_POST['aid']) && is_numeric($_POST['aid']) ){
			
				update_post_meta($_POST['pid'], "backgroundimg", "custom-".$_POST['aid']);
				
				$status = "ok";
			
			}
			
			header('Content-type: application/json');
			$n = array("status" => $status);
			die(json_encode($n));
			
		} break;
		
		
		case "delete_file": {
		 
			if(isset($_POST['aid']) && is_numeric($_POST['aid']) && $_POST['aid'] == "9999"){
			
			delete_post_meta($_POST['pid'],'image','');	
			die();
			
			}elseif(isset($_POST['aid']) && is_numeric($_POST['aid'])){
				
				$pid = 0;
				if(isset($_POST['pid']) && $_POST['pid'] > 0){
								
					$pid = $_POST['pid'];
				
				}elseif($_POST['pid'] == 0){
				
					if (isset($_SERVER['HTTP_CLIENT_IP'])) {
					$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
					}						
					if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
									$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
					}else{
									$real_ip_adress = $_SERVER['REMOTE_ADDR'];
					}
					
					$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('temp post - ".$real_ip_adress."') AND post_author = '".$userdata->ID."' LIMIT 1";						 
					$hasid = $wpdb->get_results($SQL, OBJECT);
					if(!empty($hasid)){
						$pid = $hasid[0]->ID;
					}					
					
					// DELETE TEMP FILE
				}
				
				 
				
			  
				// GET EXISTS MEDIA ARRAYS
				$get_type = array("image_array", "videothumbnails_array", "video_array", "doc_array", "music_array", "musicthumbnails_array" );			
				// LOOP ARRAYS TO GET ALL MEDIA DATA
				foreach($get_type as $type){ 
					 
					$data = get_post_meta($pid,$type,true);	 
					// GET THE MEDIA DATA FOR THIS ARRAY
					 
					if(is_array($data)){
					// LOOP THROUGH, CHECK AND DELETE
						$new_array = array();			
						foreach($data as $media){
							if($media['id'] != $_POST['aid']){
								$new_array[] = $media;
							}else{
								$delsrc 	= $media['filepath'];
								$delthumbsrc = "";
								if(isset($media['thumbnail'])){
								$delthumbsrc = $media['thumbnail'];	
								}			
								
							}// end if
						}// end foreach	
						// UPDATE MEDIA FILE ARRAY
						update_post_meta($pid,$type,$new_array);	
					}// end if
				} // end foreach
				// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
				
				// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
				if ( false === wp_delete_attachment($_POST['aid'], true) ){	
					//die("could not delete file");
				} 
				
				// FALLBACK IF SYSTEM IS NOT DELETING IMAGES
				if(isset($delsrc) && strlen($delsrc) > 1 && file_exists($delsrc)){ @unlink($delsrc); } 
				if(strlen($delthumbsrc) > 1){ 	
					$ff = explode("/",$delsrc);
					$fg = explode($ff[count($ff)-1],$delsrc);
					$fd = explode("/",$delthumbsrc);
					$thumbspath = $fg[0].$fd[count($fd)-1]; 
					if(file_exists($thumbspath)){					
					@unlink($thumbspath);
					}
				} 
			
			}
			
			if(isset($_POST['stopc'])){
			die();
			}
		
		} break;
		
		case "get_media_dimentions": {
		
		$image_attributes = wp_get_attachment_image_src( $_POST['aid'] , 'full' );
		die(json_encode(array("w" => $image_attributes[1], "h" => $image_attributes[2] )));
		die();
		
		} break;
		
		case "get_media_size": {
		
		$image_attributes = wp_get_attachment_image_src( $_POST['aid'] , 'full' );
		
		die(print_r($image_attributes));
		die(json_encode(array("size" => 1000 )));
		die();
		
		} break;
		
	
		
		case "set_media_order": {
		
		global $userdata;
	 
			// CHECK THE POST AUTHOR AGAINST THE USER LOGGED IN
					$post_data = get_post($_POST['aid']); 
					if($post_data->post_author == $userdata->ID || user_can($userdata->ID, 'administrator') ){
					
					$haschanged = false;
					
					// SET FEATURED IMAGE
					if($_POST['order'] == 1){
				 	set_post_thumbnail($_POST['pid'], $_POST['aid']);
					}
					
					// LOOP ALL ITEMS
					foreach(array("image_array", "video_array", "doc_array", "music_array") as $switch){
						
						 	if($haschanged){ continue; }
							$t = array();
							$g = get_post_meta($_POST['pid'], $switch, true);							
							
							if(is_array($g) && !empty($g) ){	
								 					
								foreach($g as $img){
									if($img['id'] == $_POST['aid']){
										$haschanged = true;
										$img['order'] = $_POST['order'];
									}
									$t[] = $img; 
								}
								
								if($haschanged){
								update_post_meta($_POST['pid'], $switch, $t);
								}
													
							} // end if
							
						}// end foreach	
						 
					}
					die();
		
		} break;
		case "set_media_title": {
		
			
			// MAKE SURE THE USER IS THE AUTHOR
			$post_data = get_post($_POST['aid']); 
			if(is_object($post_data) && $post_data->post_author == $userdata->ID || is_admin() ){
					
				$the_post 				= array();
				$the_post['ID'] 		= $_POST['aid'];
				$the_post['post_title'] = strip_tags(strip_tags($_POST['title']));
				wp_update_post( $the_post );
				 
				die(__("Caption Updated.","premiumpress")); 
			}	
		 
		} break;
	
	
		
	
		case "quickview": {
		global $post;
		$post = new stdClass();
		$post->ID 				= $_POST['pid'];
		$post->post_type 		= "listing_type";
		$post->post_title		= get_the_title($post->ID);
		
		?>
        <?php _ppt_template('single','quickview'); ?>
        <?php
		
		die();
		
		} break;
		
		
	
		case "load_categories": {
		
		 echo wp_list_categories(array(
                'walker'=> new Walker_CategorySelection, 
                'taxonomy' => THEME_TAXONOMY, 
                'show_count' => 1, 
                'hide_empty' => 0, 
                'echo' => 0, 
                'parent' => $_POST['parent'],
                'title_li' =>   "",
				'level' => $_POST['level']
				) 
            ); 
		
		die();
		
		} break;
		


case "load_store_list": {

	$output = ""; $default = ""; $parent_count = 0;
  	 
	// GET LIST OF ALL PARENTS FROM SUB MENU
	$stores = get_terms("store" ,array(  'orderby'    => 'count', 'hide_empty' => 0, 'parent' => 0 ));	
	
	if ( !empty( $stores ) && !is_wp_error( $stores ) ){
		 
			$s = (isset( $_POST['selected'] )) ? $_POST['selected'] : '';	
			$selec = explode(",", $s); 
			 
			foreach ( $stores as $term ) { 
				
				// OUTPUT 
				if(in_array($term->term_id, $selec) ){ $a = "selected=selected"; }else{ $a = ""; }		
							   
				$output .= "<option value='".$term->term_id."' ".$a.">" . $CORE->GEO("translation_tax", array($term->term_id, $term->name ))  . "</option>"; // (".$term->count.") 	
				 	
									   				
			}// foreach	
			
			if(in_array("-1", $selec) ){ $a = "selected=selected"; }else{ $a = ""; }	
			$output .= "<option value='-1' ".$a.">" . __("Other","premiumpress")  . "</option>"; // (".$term->count.") 	
				
		 
	}// end for loop
	 
	// REPORT AJAX
	header('Content-type: application/json');
	die(json_encode(array("total" => count($stores), "default" => $default, "output" => $output, "list" => $list )));
	
} break;
		 
case "load_taxonomy_list": {	

	$output = ""; $default = ""; $parent_count = 0;
	
	$list = array();
	$list = explode(",",$_POST['parent']);
	
	$type = "list";
	if(isset($_POST['parent'])){
	$type = $_POST['type'];
	}
	
	$subsubcat = 0;
	if($_POST['child'] == 1){
	$subsubcat = 1;
	}
	
	// RMOVE LAST VALUE
	if(count($list) > 0){
	unset($list[count($list)-1]);
	}
	 
	  
	foreach($list as $key => $pid){ 
	 
		if(!is_numeric($pid) || is_numeric($pid) && $pid == 0){ continue; }
		 
		// GET LIST OF ALL PARENTS FROM SUB MENU
		$parent_terms = get_terms($_POST['taxonomy1'] ,array(  'orderby'    => 'count', 'hide_empty' => 0, 'parent' => $pid ));	
		 
		$parent_count = $parent_count + count($parent_terms);
									 				 			
		if ( !empty( $parent_terms ) && !is_wp_error( $parent_terms ) ){
		 
			$s = (isset( $_POST['child'] )) ? $_POST['child'] : '';	
			$selec = explode(",", $s);
			
			if($type == "list" && $_POST['taxonomy1'] != "country"){
			$output .= "<option value=''></option>";
			}
			
			foreach ( $parent_terms as $term ) {
			
			 	// DEFAULT
				if($default == ""){
					$default = $term->term_id;
				}
				
				// OUTPUT	
				if($type == "list"){ 
				if(in_array($term->term_id, $selec) ){ $a = "selected=selected"; }else{ $a = ""; }					   
				$output .= "<option value='".$term->term_id."' ".$a.">" . $CORE->GEO("translation_tax", array($term->term_id, $term->name ))  . "</option>"; // (".$term->count.") 	
				}else{
				if(in_array($term->term_id, $selec) ){ $a = "class='active'"; }else{ $a = ""; }	 
				$s = "";
				if($subsubcat){
				$s = "data-subcat='1'";
				}
				
				$output .= "<div data-id='".$term->term_id."' ".$a." ".$s." data-parent='".$term->parent."'>" . $CORE->GEO("translation_tax", array($term->term_id, $term->name ))  . "</div>"; // (".$term->count.") 	
				
				}
					
									   				
			}// foreach	
				
		}	/// end if
	
	}// end for loop
	 
	// REPORT AJAX
	header('Content-type: application/json');
	die(json_encode(array("total" => $parent_count, "default" => $default, "output" => $output, "list" => $list )));
	

} break;



case "upload_wpmediafile": {
	
		
		$pid = $_POST['pid'];
		
		if(isset($_POST['type']) && $_POST['type'] == "video" && isset($_POST['aid']) && is_numeric($_POST['aid']) ){ 
		
			$storage_key 	= "video_array";			 	
			$aid 			= $_POST['aid'];
			$attachment_metadata = wp_get_attachment_metadata( $_POST['aid'] );
			
			$filepath 	= $_POST['aurl'];
			$src 		= $_POST['aurl'];
			$mtype 		= $attachment_metadata['mime_type'];
			
			if(isset($attachment_metadata['videopress'])){ 
				
				$filepath 	= $attachment_metadata['videopress']['files']['std']['mp4'];	
				$src 		= $attachment_metadata['videopress']['original'];
				$mtype 		= "video/mp4";
			}
			 	
			$save_file_array = array(
					'name' 		=> $attachment_metadata['original_image'],
					'type'		=> $mtype,
					'postID'	=> $pid,
					'size'		=> 100,
					'src' 		=> $src,						
					'thumbnail' => '',						
					'filepath' 	=> $filepath,
					'id'		=> $aid,
					'default' 	=> 0,
					'order'		=> 0,						
					'dimentions' => 0,						
					'dpi' 		=> 0,						
			);
			
			 	 	 
		
		}elseif(isset($_POST['type']) && $_POST['type'] == "video" ){
		
			$storage_key = "video_array";
			$title = $_POST['title'];
			
		
			$SQL = "SELECT ID, guid FROM ".$wpdb->prefix."posts WHERE post_title LIKE ('%".strip_tags($title)."%') LIMIT 1";				 		
			$sub_results = $wpdb->get_results($SQL);
			if(isset($sub_results[0])){
			
				$aid = $sub_results[0]->ID;
				$attachment_metadata = wp_get_attachment_metadata( $aid );
				$uploads = wp_upload_dir();	
				
				$save_file_array = array(
					'name' 		=> $attachment_metadata['original_image'],
					'type'		=> $attachment_metadata['mime_type'],
					'postID'	=> $pid,
					'size'		=> 100,
					'src' 		=> $sub_results[0]->guid,						
					'thumbnail' => '',						
					'filepath' 	=> $sub_results[0]->guid,
					'id'		=> $aid,
					'default' 	=> 0,
					'order'		=> 0,						
					'dimentions' => 0,						
					'dpi' 		=> 0,						
				); 
			
			}else{
			
			die("error finding video");
			} 
			 
		
		}else{
		 
			$storage_key = "image_array";
			
			if(isset($_POST['musicthumb'])){
			
				$storage_key = "musicthumbnails_array";
				update_post_meta($pid,$storage_key, ""); // RESET DEFAULT ONE AS WE ONLYHAVE 1 VIDEO UPLOAD			 	
				
			}
			
			
			$aid = $_POST['aid'];
			$aurl = $_POST['aurl'];
			
			$attachment_metadata = wp_get_attachment_metadata( $aid );	
			$uploads = wp_upload_dir();	
			
			if($attachment_metadata['sizes']['thumbnail']['file'] == ""){
			$thumbnail = $aurl;
			}else{
			$thumbnail = $uploads['url']."/".$attachment_metadata['sizes']['thumbnail']['file'];			
			} 
			
			$save_file_array = array(
					'name' 		=> $attachment_metadata['original_image'],
					'type'		=> "image/jpg",
					'postID'	=> $pid,
					'size'		=> 100,
					'src' 		=> $aurl,						
					'thumbnail' => $thumbnail,						
					'filepath' 	=> $uploads['basedir']."/".$attachment_metadata['file'],
					'id'		=> $aid,
					'default' 	=> 0,
					'order'		=> 0,						
					'dimentions' => 0,						
					'dpi' 		=> 0,						
				); 
		
		} 
		
		
		//update_post_meta($pid,$storage_key, ""); // RESET DEFAULT ONE AS WE ONLYHAVE 1 VIDEO UPLOAD
				
			
 				
		// ADD TO MY IMAGE GALLERY ARRAY
		$my_existing_images = get_post_meta($pid,$storage_key, true);
		if(is_array($my_existing_images)){					
			$new_array = array();
			$new_array[] = $save_file_array;
			foreach($my_existing_images as $img ){ $new_array[] = $img; }						
		}else{				
			$new_array = array();
			$new_array[] = $save_file_array;									
		}				 		
		// SAVE
		update_post_meta($pid,$storage_key,$new_array);

	// REPORT AJAX
	header('Content-type: application/json');
	die(json_encode(array("status" => "ok", "msg" => $aid, "pid" => $pid, "key" => $storage_key, "data" => $new_array   )));
	
	
} break;
	
		case "savelisting": {	global $userdata, $wpdb;
		   
		  // PREPARE DATA
		  $data = array(); 
		  parse_str($_POST['formdata'], $data); 
	  
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////


		// VALIDATION
		if(strlen($data['form']['post_title']) < 2){ 
					
			die(json_encode(array("status" => "error", "msg" => __("Please provide more details, your listing is too short.","premiumpress")  )));
						 
		}
		
	
		//die(print_r($data));
		// captcha code from Google
		if(isset($data['g-recaptcha-response']) && _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){  //
				
					if($data['g-recaptcha-response'] == ""){					
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress"), "type" => "email"  )));				
					}
				 
					$args = array(
						'secret'   => _ppt(array('captcha','secretkey')),
						'response' => $data['g-recaptcha-response'],
					);
				 
					$gcaptcha = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify' , $args );
			
					if ( is_wp_error( $gcaptcha ) ) {
						 	
					}else{
					
						$body = wp_remote_retrieve_body( $gcaptcha );
						if ( empty( $body ) ) {
							die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
						}
						$result = json_decode( $body );
						if ( empty( $result ) ) {
							die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
						}
						if ( ! isset( $result->success ) ) {
							die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
						}		 
					
					}		 
		}
		  
 		
		// CREATE NEW USER
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////

		  if(!$userdata->ID){		  
		 	
				$newuser = array(			
					"username" 		=> str_replace(" ","",trim($data['myusername'])),
					"password" 		=> str_replace(" ","",trim($data['mypass'])),
					"user_email" 	=>  $data['myemail'],					
				);
				
				 $data['noaddprofile'] = 1;
				
				
				// VALIDATE
				if ( !is_email( $newuser['user_email'] ) ) {
					die(json_encode(array("status" => "error", "msg" => __("Invalid Email Address","premiumpress"), "type" => "email"  )));
				}
				
				if ( email_exists( $newuser['user_email'] ) ) {
					die(json_encode(array("status" => "error", "msg" => __("Email Address Already Used","premiumpress"), "type" => "email"  )));
				}
				
				if (  isset($newuser['username']) && ppt_theme_badwordlist( $newuser['username'], 1) == 1 ) {
					die(json_encode(array("status" => "error", "msg" => __("Invalid Username","premiumpress"), "type" => "username"  )));
				} 
			  
				// CREATE NEW ACCOUNT
				$ff = $CORE->USER_REGISTER($newuser["username"], $newuser["password"], $newuser['user_email'], $data, 1 );
				if(strpos($ff,"http") === false ){				 
					die(json_encode(array("status" => "error", "msg" => $ff )));
				}
				$userID = $GLOBALS['newuserID']; 
				
				
		  }else{
		  
		 	 $userID = $userdata->ID;
		  }
		  
		// ADDD/EDIT POST
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		
		$my_post = array(
			'post_type'		=> 'listing_type',
			'post_title' 	=> esc_html($data['form']['post_title']),
			'post_modified' => current_time( 'mysql' ),
			'post_excerpt' => ' ',
			'post_content' 	=> '',
		);	
		
		if( isset($data['custom']['adminareaedit']) ){
		
			$CONTENT = $data['form']['post_content'];
		
		}else{
		
			$CONTENT = stripslashes(strip_tags(str_replace("http://","",str_replace("https://","",$data['form']['post_content']))));
			if(isset($data['form']['post_tags'])){
					
				// DELETE OLD TAGS
				$CONTENT = preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', stripslashes($CONTENT));
				$CONTENT .= '<div id="ppt_keywords">'.str_replace(","," ",strip_tags($data['form']['post_tags']))."</div>";					
			}
		
		}
		
		$my_post['post_content'] = $CONTENT;
		
		// CHECK FOR EDIT
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////// 
		
		if(isset($data['oldeid']) && is_numeric($data['oldeid']) && $data['oldeid'] > 0){
		
			$POSTID = $data['oldeid'];	
		 
		}else{			
			
			$POSTID = wp_insert_post( $my_post );
			
				// CHECK AND REDFUCE FREE LISTINGS
				$mymem = $CORE->USER("get_user_membership", $userdata->ID);			 
				if(is_array($mymem) && _ppt('mem'.$mymem['key'].'_listings') == 1){		
					
					$c = get_user_meta($userdata->ID, "free_listings_count", true);					 
					if(is_numeric($c)){ 						
						update_user_meta($userdata->ID, "free_listings_count", ($c-1));
					}
					
				}	
		}
		
		$my_post['ID'] = $POSTID; 
 
		// CATEGORIES  ************************************************************************************************/


		$categories = array();			 
		if(isset($data['form']['category'])){
				
			if(is_array($data['form']['category'])){
				foreach($data['form']['category'] as $cat){
				if(!is_numeric($cat) ){ continue; }
					$categories[] = $cat; 
				}
			}							
			// UPDATE CAT LIST
			wp_set_post_terms( $POSTID, $categories, THEME_TAXONOMY );
		}
		 
		
		// POST TAXONOMY  ************************************************************************************************/

		if(isset($data['tax']) && is_array($data['tax'])){ 	
			 	 
			foreach($data['tax'] as $key => $val){ 
			
				if($key == "listing"){ continue; }
				
				// REGISTER IF DOESNT EXIST
				if(!taxonomy_exists($key)){
					register_taxonomy( $key, 'listing_type', array( 'hierarchical' => true, 'labels' =>'', 'query_var' => true, 'rewrite' => true ) ); 
				}
				
				if(is_array($val) && !empty($val) && count($val)  == 1 ){
						
					$vals = explode(",",$val[0]);
						
					// SAVE DATA
					wp_set_post_terms( $POSTID, $vals, $key ); 
				
				}else{
				
					// SAVE DATA
					wp_set_post_terms( $POSTID, $val, $key ); 
				} 
			 
				
			}
		}	
		
		// STORE OWN SETUP
		if(isset($data['tax']['store']) && $data['tax']['store'] == "-1" && isset($data['custom']['storename']) && strlen($data['custom']['storename']) > 2 ){ 
		
			$t = wp_insert_term(
				$data['custom']['storename'],   // the term 
				'store', // the taxonomy
				array(
					'description' => "",
					 
				)
			); 
			
			if(is_wp_error( $t )){			
				 
			}elseif(is_object($t)){
				$storeID = $t->term_id; 
			}elseif(is_array($t)){
				$storeID = $t['term_id']; 
			}
			
			wp_set_post_terms( $POSTID, $storeID, 'store' );
			
			// UPDATE USER TO AGENCY AND SET STORE ID AS THEIRS
			update_user_meta($userID,'user_type','agency'); 
			update_user_meta($userID,'storeid', $storeID);
			 
		 
		
		}
		
		//die(print_r($data));
		
		
		// POST TAGS  ************************************************************************************************/

		if(isset($data['form']['post_tags'])){
			 
			wp_set_post_tags( $POSTID, explode(",",strip_tags($data['form']['post_tags'])), false);		
			
		}
			
		// CUSTOM DATA  ************************************************************************************************/ 
 
		if(isset($data['custom']) && is_array($data['custom'])){ 	
		 
				foreach($data['custom'] as $key => $val){ 
				 	
					// PASS ON SOME KEYS
					if($key == "adminareaedit" || $key == "listing_expiry_date" ){ continue; } //$key == "listing_expiry_days" || 
					
					 
					// CLEAN SOME ATTRIBUTES
					if(substr($key,0,5) == "price"){
						$val = preg_replace('/[^\da-z.]/i', '', $val);
					} 
				 	
					// SAVE DATA
					if($val == ""){
						delete_post_meta($POSTID, strip_tags($key));
					}elseif(is_array($val)){					 
						update_post_meta($POSTID, strip_tags($key), $val);
					}else{
						update_post_meta($POSTID, strip_tags($key), esc_html(strip_tags(trim($val))));
					}					
				} 				
		}
			
		// USER TAXONY LOCATION  ************************************************************************************************/
 		  	
		if( isset($data['custom']['map-city-tax'])  ){				 
			 
			$f = wp_set_post_terms( $POSTID, array($data['custom']['map-country-tax'],$data['custom']['map-city-tax']), "country" );
	  			
		}
		
 		// AWARDS  ************************************************************************************************/
 			 
		if(isset($data['awards']) && is_array($data['awards'])){ 		 		
				$cleanme = array();
				foreach($data['awards'] as $key => $enabled){ 
				 	 
					 if(is_numeric($key) && $enabled == 1){
					 $cleanme[$key] = $key;
					 }					
				} 				
				update_post_meta($POSTID, "awards", $cleanme);
				
		}
			 
		// BADGES  ************************************************************************************************/
 			 
		if(isset($data['badges']) && is_array($data['badges'])){ 
					 		
				$cleanme = array();
				foreach($data['badges'] as $key => $enabled){ 				 	 
					 if(is_numeric($key) && $enabled == 1){
					 $cleanme[$key] = $key;
					 }					
				} 				
				update_post_meta($POSTID, "badges", $cleanme);				
		}
		
			 
		// VIDEO SERIES  ************************************************************************************************/
 			 
		if(THEME_KEY == "vt" && isset($data['series']) && is_array($data['series'])){ 
					 		
				$cleanme = array();
				 				
				update_post_meta($POSTID, "series", $data['series']);				
		}	
		
		
		
		//die(print_r($cleanme).print_r($data));
		
		// ADD-ON ATTRIBUTES  ************************************************************************************************/
 
		if(isset($data['attributes']) && is_array($data['attributes']) && !empty($data['attributes'])){
			update_post_meta($POSTID,"attributes",$data['attributes']);
			}else{
			update_post_meta($POSTID,"attributes","");
		}
  
			
		// BUSINESS HOURS ************************************************************************************************/
			
		if(isset($data['startTime'])){	
			
				$businesshours = array( 'start' => $data['startTime'], 'end' => $data['endTime'], 'active' => $data['isActive']  );				 
				update_post_meta($POSTID,"businesshours", $businesshours);				 
		}
			
		// PRICE COMPARISON ************************************************************************************************/
			
		if(in_array(THEME_KEY, array("cm")) && isset($data['comparedata'])){
		
			update_post_meta($POSTID,"comparedata", $data['comparedata'] );	
		}
			
		// FAQ ************************************************************************************************/
 
		if(in_array(THEME_KEY, array("mj","dt")) && isset($data['customextras']) ){
			update_post_meta($POSTID, 'customextras', $data['customextras']);
		}	
			
		// GIGS  ************************************************************************************************/

		if(in_array(THEME_KEY, array("mj")) && isset($data['customfaq']) ){ 
			update_post_meta($POSTID, 'customfaq', $data['customfaq']);
		}
		
		// AUCTION BNW  ************************************************************************************************/
		
		if(defined('THEME_KEY') && THEME_KEY == "at" && isset($data['custom']["price_bin"]) && $data['custom']["price_bin"] > 0 && $data['custom']["price_current"] == "0"){ 			
				
			update_post_meta($POSTID, "price_current", $data['custom']["price_bin"]);
				
		}
		
		// DATING THEME  ************************************************************************************************/

		if(in_array(THEME_KEY, array("da")) && isset($data['custom']['lookinggen']) ){ 
			update_user_meta($userdata->ID,'da-seek2',$data['custom']['lookinggen']); 
		}
		
		
		// EXPIRY DATE  ************************************************************************************************/ 
		
		if(isset($data['custom']['listing_expiry_days']) && is_numeric($data['custom']['listing_expiry_days']) && ( !isset($data['oldeid'])  || isset($data['repost']) )  ){ //3. DAYS EXPIRY (AUCTION THEME )
						// UPDATE EXPIRY DATE
						
					if($data['custom']['listing_expiry_days'] == "0.5"){
						
							update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +30 minutes") ) );
						
					}elseif($data['custom']['listing_expiry_days'] == "0.1"){
						
							update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +1 hour") ) );
							
					}else{
						
							update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ). " +".$data['custom']['listing_expiry_days']." days") ) );						
					}
					
					update_post_meta($POSTID, "default_expiry_days", $data['custom']['listing_expiry_days']);
				
		
		}elseif(THEME_KEY == "at" && !isset($data['custom']['listing_expiry_days']) && ( !isset($data['oldeid']) || isset($data['repost']) )  ){
		
			$days = 30;
			
			if(isset($data['packageID'])) { 
					
					// FALLBACK
					$duration = _ppt('pak'.$data['packageID'].'_duration');									 
					if(is_numeric($duration) && $duration > 0){							
						$days = $duration;						
					}
						
			}
				
			
			update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ). " +".$days." days") ) );	
		
		}
		
		// EXPIRY DATE ************************************************************************************************/
			  	
				
		if( isset($data['custom']['adminareaedit']) && isset($data['custom']['listing_expiry_date']) && strlen($data['custom']['listing_expiry_date']) > 5  ){  // 1. CHECK ADMIN EDIT
				
					update_post_meta($POSTID, "listing_expiry_date", $data['custom']['listing_expiry_date'] );
				
		}
		
		/*elseif( $CORE->LAYOUT("captions","listings")  && isset($data['packageID']) && ( !isset($data['oldeid']) || isset($data['repost']) ) ) { // 2. NEW LISTING
					
					// FALLBACK
					$duration = _ppt('pak'.$data['packageID'].'_duration');	
								 
					if(is_numeric($duration) && $duration > 0){
							
							update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +".$duration." days") ) );
						
					}
						
		}*/
		
		// SEND EMAILS  ************************************************************************************************/
		
		if(!isset($data['oldeid'])){
		
				// ADD LOG
				$CORE->FUNC("add_log",
					array(				 
						"type" 		=> "listing_added",	
						"postid"	=> $POSTID,				 
					)
				);				
				
				// SEND EMAIL
				$data1 = array(		
					"username" => $userdata->display_name,	
					"item_title" => get_the_title($POSTID),
					"item_link" => get_permalink($POSTID),	
					"title" => get_the_title($POSTID),
					"link" => get_permalink($POSTID),
					"ID" => $POSTID,
				);				 
				
				// SEND EMAILS
				$CORE->email_system($userdata->ID, 'newlisting', $data1);	
				$CORE->email_system("admin", "admin_listing_new", $data1);	
		
		
		}elseif(!is_admin()){
			
				/*
				ANNOYING
				$CORE->FUNC("add_log",
					array(				 
						"type" 		=> "listing_update",	
						"postid"	=> $POSTID,	
						"extra"		=> $POSTID,		 
					)
				);
				// SEND EMAIL
				$CORE->email_system("admin", "admin_listing_update", $data1); 
				*/
		
		}
		
	
		
		
		// PAYMENT SHOULD BE WORKED OUT FROM THE PACKAGE ID
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		
		// 1. FIRST ADDON - DEFAULT OPTIONS			
		if(isset($data['addon_featured']) && $data['addon_featured'] == 1){ 
			update_post_meta($POSTID, 'featured', "1" );
		}else{
			update_post_meta($POSTID, 'featured', "0" );
		}
				
   		if(isset($data['addon_sponsored']) && $data['addon_sponsored'] == 1){ 
			update_post_meta($POSTID, 'sponsored', "1" );
		}else{
			update_post_meta($POSTID, 'sponsored', "0" );
		}
				
    	if(isset($data['addon_homepage']) && $data['addon_homepage'] == 1){
			update_post_meta($POSTID, 'homepage', "1" );
		}else{
			update_post_meta($POSTID, 'homepage', "0" );
		}
		  
		
		
		// PACKAGE ID  ************************************************************************************************/
		
		if(!isset($data['packageID'])){ $data['packageID'] = "-1"; }		
		update_post_meta($POSTID, 'packageID', $data['packageID'] );

	
		// TOTAL DUE  ************************************************************************************************/
		 
		if(_ppt(array('lst', 'default_listing_status')) != "pending"){
		
		$my_post['post_status'] = "publish";
		
		}
		
		update_post_meta($POSTID, 'totaldue', $data['totaldue'] );
		
		if(isset($data['totaldue']) && $data['totaldue'] > 0 ){
			 
			$FINAL_STATUS = "payment";	
			
			$paymentc = array(
			"uid" 			=> $userdata->ID, 
			"amount" 		=> $data['totaldue'], 
			"order_id" 		=> "LST-".$POSTID,
			"description" 	=> __("Ad Payment","premiumpress")." #".$POSTID,	
			"recurring" 	=> 0,	
			"credit" 		=> 1,						
		    );
		
			$paymentCode = $CORE->order_encode($paymentc); 
			
			// SET STATUS TO PAYMENT
			$my_post['post_status']			= "payment"; 
			
		}elseif( !isset($data['oldeid']) && _ppt(array('lst', 'default_listing_status')) == "pending"  ){ 
		
			$my_post['post_status'] = "pending_approval";
		}
		 
		
		//die(print_r($data).print_r($my_post));	
		 
		if(isset($data['form']['post_status']) && function_exists('current_user_can') && current_user_can('administrator') ){			
			
			$my_post['post_status'] = $data['form']['post_status'];	
			
			if($data['form']['post_status'] == "publish"){
			
				update_post_meta($POSTID, 'totaldue', 0 );
			}
			
			
			
		}
			
 		if(!isset($data['custom']['adminareaedit']) && isset($userID)){
			$my_post['post_author'] = $userID;
		}
		 	
		wp_update_post( $my_post );
			 
			 
		// REDIRECT
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
			  
			 	 
		// IF IS NEW RETURN PAYMENT DATA		
		
			
				if (isset($_SERVER['HTTP_CLIENT_IP'])) {
							$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
				}						
				if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}else{
							$real_ip_adress = $_SERVER['REMOTE_ADDR'];
				}			
					
				$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('temp post - ".$real_ip_adress."') LIMIT 1";													 
				$hasid = $wpdb->get_results($SQL, OBJECT);
				if(!empty($hasid)){					  
								
					$listing_ids = $CORE->PACKAGE("get_user_listing_ids", $userdata->ID);
					if(is_array($listing_ids) && !empty($listing_ids) ){
						foreach($listing_ids as $pid){	
						 
							$get_type = array("image_array", "videothumbnails_array", "video_array", "doc_array", "music_array", "musicthumbnails_array" );			
				 
							foreach($get_type as $type){
															 
								update_post_meta($POSTID, $type, get_post_meta($hasid[0]->ID,$type,true) );
								
							}									
						}
					}
					
					wp_delete_post( $hasid[0]->ID ); 	
										 
				}	 
				
			if(isset($GLOBALS['newuserID'])){
			
				die(json_encode(array("status" => $my_post['post_status'], "link" => _ppt(array('links','myaccount')), "postid" => $POSTID, "userid" => $GLOBALS['newuserID'], "paymentdata" => $paymentCode   ))); 
				
			}else if( isset($data['custom']['adminareaedit']) ){
			 
				$redirect = home_url()."/wp-admin/admin.php?page=listings&done=1&eid=".$POSTID;				
				
				die(json_encode(array("status" => $my_post['post_status'], "link" => $redirect , "postid" => $POSTID, "userid" => $userdata->ID, "paymentdata" => $paymentCode   )));		  	
				
			}else{
			  
				die(json_encode(array("status" => $my_post['post_status'], "link" => get_permalink($POSTID), "postid" => $POSTID, "userid" => $userdata->ID, "paymentdata" => $paymentCode   )));
		  
			}
			 
			 die();
			
		} break;
		
 		
		
case "SaveRating": {
				
					// LOAD IN LANGUAGE
					 
					if(is_numeric($_POST['pid']) && is_numeric($_POST['value'])){
					// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
					$rated_user_ips = get_option('rated_user_ips');  $user_ip = $CORE->get_client_ip();
					if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
					
						if(isset($rated_user_ips[$_POST['pid']]) && isset($rated_user_ips[$_POST['pid']]['ips']) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ips']) ){							
							echo ''.__("You've Already Rated!","premiumpress");
							die();
							
						}elseif(isset($rated_user_ips[$_POST['pid']]) && isset($rated_user_ips[$_POST['pid']]['ips']) && !in_array($user_ip, $rated_user_ips[$_POST['pid']]['ips']) ){
						 
							$rated_user_ips[$_POST['pid']]['ips'] = array_merge($rated_user_ips[$_POST['pid']]['ips'],array("ip" => $user_ip, "rating" => $_POST['value']));
							update_option('rated_user_ips', $rated_user_ips); 
						}
						
					// GET RATING IPS
					$rated_user_ips = get_option('rated_user_ips');  $user_ip = $CORE->get_client_ip();
					if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
					if(isset($rated_user_ips[$user_ip])){ return; }else{ update_option('rated_user_ips', array_merge($rated_user_ips,array($user_ip))); }					 
					// GET EXISTING DATA
					$totalvotes = get_post_meta($_POST['pid'], 'starrating_votes', true);
					$totalamount = get_post_meta($_POST['pid'], 'starrating_total', true);
					if(!is_numeric($totalamount)){ $totalamount = $_POST['value']; }else{ $totalamount += $_POST['value']; }
					if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }
					// WORK OUT RATING
					$save_rating = round(($totalamount/$totalvotes),2);
					// SAVE RESULTS
					update_post_meta($_POST['pid'], 'starrating', $save_rating);
					update_post_meta($_POST['pid'], 'starrating_total', $totalamount);
					update_post_meta($_POST['pid'], 'starrating_votes', $totalvotes);
					
					echo ''.__("Thank You!","premiumpress");
					die();
				 
					//echo $save_rating." <-- total votes:".$totalvotes." / total amount: ".$totalamount;
					}
				} break;
		
 
	
		case "update_mylocaton": {
		
			/// SET USER LOCATION
			if(isset($_POST['long'])){
			 		
					$_SESSION['mylocation']['log'] = strip_tags($_POST['long']);
					$_SESSION['mylocation']['lat'] = strip_tags($_POST['lat']);
					$_SESSION['mylocation']['zip'] = strip_tags($_POST['zip']);
					
					$_SESSION['mylocation']['country'] = strip_tags($_POST['country']);
					$_SESSION['mylocation']['address'] = strip_tags($_POST['address']);
					die("ok");
			}
			die("error");
		
		} break;
		

		case "get_location_states_new": {
		
		$stsate = strtoupper($_POST['country_id']);
		
		if(is_numeric($stsate) ){
		
			$tax_country = get_terms("country", 'orderby=count&order=desc&hide_empty=0&parent='.$stsate);
			if(!is_wp_error( $tax_country )){ 
				$countrydata = array();
				foreach ($tax_country as $term) {
				 
					?>
                    <div class="col-md-3"><div class="flagwrap <?php echo $term->term_id; ?> <?php if($term->term_id == $_POST['state_id']){ echo "checked"; } ?>" data-val="<?php echo $term->term_id; ?>"><?php echo $term->name ?></div></div>
                    <?php
				}
			}
		
		}elseif(isset($GLOBALS['core_state_list'][$stsate])){
		  
			$states = explode("|",$GLOBALS['core_state_list'][$stsate]);
			 
			foreach($states as $state){
			?>
             <div class="col-md-3"><div class="flagwrap <?php echo $state; ?> <?php if($state == $_POST['state_id']){ echo "checked"; } ?>" data-val="<?php echo $state; ?>"><?php echo $state; ?></div></div>
            <?php
			}
		}
		
		die();
		
		} break;
		case "get_location_states": {
		
		if(isset($GLOBALS['core_state_list'][$_POST['country_id']])){
			
			if(isset($_POST['showany'])){
			?>
            <option value=""><?php echo __("Any City/State","premiumpress"); ?></option>
            <?php
			}
			
			$states = explode("|",$GLOBALS['core_state_list'][$_POST['country_id']]);
			foreach($states as $state){
			?>
            <option value="<?php echo $state; ?>" <?php if($state == $_POST['state_id']){ echo "selected=selected"; } ?>><?php echo $state; ?></option>
            <?php
			}
		}
		
		die();
		
		} break;	
	 
		
		case "server_time": {
		
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 
			header("Expires: Fri, 1 Jan 2010 00:00:00 GMT"); // Date in the past 
			header("Content-Type: text/plain; charset=utf-8"); // MIME type 
			$now = new DateTime(); 
		 	die(json_encode(array("time" => $now->format("M j, Y H:i:s O")  )) );
		
		} break;
		
		
		case "single_msg": {
		
		
		$user 		= strip_tags( esc_attr($_POST['u']));
		$message 	= strip_tags( esc_attr($_POST['m']));
		
		$canContinue = true;
		
		if(is_numeric($user)){
			$uid = $user;
		}else{	
			$dd = get_user_by( 'login',  $user );
			$uid =  $dd->ID;		
		}
		
		// #1 VALIDATE
		if(strlen($message) < 5){ 
			$canContinue = false;	
		}
		
		
			
		if($canContinue && $userdata->ID ){
			
			
			$my_post = array();
				$my_post['post_title'] 		= "new conversation";
				$my_post['post_content'] 	= strip_tags(strip_tags($message));
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_type'] 		= "ppt_message";
				$my_post['post_author'] 	= $userdata->ID;
				$POSTID 					= wp_insert_post( $my_post );
								
				add_post_meta($POSTID, "sender_id", $userdata->ID);
				add_post_meta($POSTID, "reciever_id", $uid );			
				 
				
				// EASY TO FIND CUSTOM FIELD
				add_post_meta($POSTID, "msg_stick", "[".$uid."][".$userdata->ID."]");
				add_post_meta($POSTID, "msg_status", "unread_".$uid);		
				 
				// ADD LOG
				$CORE->FUNC("add_log",
					array(				 
						"type" 			=> "msg_new",											 
						"to" 		=> $uid, 						
						"from" 		=> $userdata->ID,						
						"alert_uid1" 	=>  $uid,
					)
				);
				
				die(json_encode(array("status" => "ok"  )));
			
		}
		
		die(json_encode(array("status" => "error"  )));
		
		
		} break;
	
		case "single_contactform": {
 		
		$data = $_POST['data'];
		   
		$message 	= strip_tags( esc_attr($data['message']));
		$name 		= strip_tags( esc_attr($data['name']));
		$email 		= strip_tags( esc_attr($data['email']));			 	
		$post_id 	= strip_tags( esc_attr($data['pid']));	
		
		
		// VALIDATE
		if ( !is_email( $email ) ) {
				die(json_encode(array("status" => "error", "msg" => __("Invalid Email Address","premiumpress")  )));
		}
			 
		// GOOGLE RECAPTURE
		if(isset($data['g-recaptcha-response']) && _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){  //
			
				if($data['g-recaptcha-response'] == ""){					
					die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));				
				}
			 
				$args = array(
					'secret'   => _ppt(array('captcha','secretkey')),
					'response' => $data['g-recaptcha-response'],
				);
			 
				$gcaptcha = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify' , $args );
		
				if ( is_wp_error( $gcaptcha ) ) {
					 
				}else{
				
					$body = wp_remote_retrieve_body( $gcaptcha );
					if ( empty( $body ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}
					$result = json_decode( $body );
					if ( empty( $result ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}
					if ( ! isset( $result->success ) ) {
						die(json_encode(array("status" => "error", "msg" => __("Invalid Google reCAPTCHA","premiumpress")  )));
					}				 
				
				}		 
			
		}	
		
		
		
		
		if(1 == 1){
	 			 
			// GET POST DATA
			if(is_numeric($post_id)){
					
					$post 		= get_post($post_id);	
					$user_info 	= get_userdata($post->post_author);
					$ussid 		= $user_info->ID;
					$link 		= get_permalink($post_id);
					
					// UPDATE LEADS COUNTER					
					$leads = get_post_meta($post_id, "leads", true);
					if(!is_numeric($leads)){
					$leads = 0;
					}
					$leads++;					
					update_post_meta($post_id, "leads", $leads);
					 
			}else{
					$ussid = 1;	
					$link = "";			
			}
			  
		 
			// SAVE MESSAGE
			$Message = __("Contact Form Message","premiumpress")."\r\n ".__("Name","premiumpress").": ".$name."\r\n ".__("Email","premiumpress").": ".$email."\r\n ".__("Message","premiumpress").": ".$message."\r\n";
			
			 	
			if(!$userdata->ID){	$userid = 1;}else{	$userid = $userdata->ID; }
			
			
				
							
				$my_post = array();
				$my_post['post_title'] 		= "contactform";
				$my_post['post_content'] 	= strip_tags($Message);
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_type'] 		= "ppt_message";
				$my_post['post_author'] 	= $userid;
				$POSTID 					= wp_insert_post( $my_post );
							
				add_post_meta($POSTID, "reciever_id", $ussid);
				add_post_meta($POSTID, "sender_id", $userid);
				add_post_meta($POSTID, "pid", $post_id);
				add_post_meta($POSTID, "name", $name);
				add_post_meta($POSTID, "email", $email);
				add_post_meta($POSTID, "message", $message);
							
				// EASY TO FIND CUSTOM FIELD
				add_post_meta($POSTID, "msg_stick", "[".$ussid."][".$userid."]");
				add_post_meta($POSTID, "msg_status", "unread_".$ussid);	 
				
				
				if(strlen($link) > 1){
					$Message .=  "<a href='".$link."'>".$link."</a>\r\n"; 
				
				}
							  
				// ADD LOG
				$CORE->FUNC("add_log",
					array(				 
						"type" 			=> "listing_message",									
						"postid"		=> $post_id,									
						"to" 			=> $ussid, 						
						"from" 			=> $userid,	
						"from_name" 	=> __("Name","premiumpress"),								
						"alert_uid1" 	=>  $ussid,									
						"data"  		=> $Message,
						"email_data" 	=> array(	
							"message" => $Message,
						),
					)
				);  
				
				
				if($ussid == 1){
				
					// SEND ADMIN AN EMAIL
					$CORE->email_custom("admin", __("Contact Form Message","premiumpress"), $Message);
				}
				
				 
				// RETURN MSG
				die(json_encode(array("status" => "ok" )));
		}
		
		// RETURN MSG
		die(json_encode(array("status" => "error"  )));
	 	 	 
					
		} break;
	
		case "newsletter_join" : {	
				
				  
				if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST['email']) && $CORE->get_client_ip() != "error" ) {
				
					$status =  "error";
				 
				}else{
				
					
					// MAKE HAS FOR THIS USER
					$hash = md5($_POST['email'].rand());
					
					$data = array(						
						"email" => strip_tags($_POST['email']),
						"hash" => $hash,
					);
					
					// ADD USER TO NEWSLETTER LIST
					$uid = $CORE->EMAIL("newsletter_add", $data);					 
				
					// BUILD LINK FOR EMAIL
					$_POST['link'] = get_home_url()."/confirm/mailinglist/".$hash;	
						 
					// SEND OUT CONFIRMATION EMAIL				 
					$subject = stripslashes(_ppt(array('newsletter','confirmation_title')));				
					$message = str_replace("(link)", $_POST['link'] ,stripslashes(_ppt(array('newsletter','confirmation_message'))) );				
					
					// SEND EMAIL
					$CORE->email_send($_POST['email'], $subject, $message);
					
					// ADD LOG
						$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "newsletter",									
								"email" 	=> $_POST['email'],
								"data" 		=> $subject."/n/n/n".$message,							  					 
							)
						);
					
					// PROVIDE USER MESSAGE
					$status = "ok";			
					}
				
				die(json_encode( array("status" => $status) ) );
				
		} break;
	
		case "listing_enhancements": {
		
			die($CORE->listing_enhancements($_POST['pid']));
		
		} break;
	
		case "listing_relist": {
			
			if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
			
				// GET REILIST PRICE
				$relist = $this->relist_price($_POST['pid']);
				
				// START DATE FOR RENEWAL encase
				// user is upgrading early
				$listing_expiry_date = get_post_meta($_POST['pid'],'listing_expiry_date',true); 
				if( strtotime($listing_expiry_date) < strtotime(current_time( 'mysql' ))  ){	
				$datenow = current_time( 'mysql' );
				}else{
				$datenow = $listing_expiry_date;
				}
		 		
				// WORK OUT HOW LONG TO UPGRADE FOR
				if(isset($relist['days']) && $relist['days'] > 0){ $extdasy = $relist['days']; }else{ $extdasy = 30; }
				
				if($relist['price'] > 0){
				
					// ADD NEW PAYMENT REQUEST TO LISTING
				
				
				}else{ 
				
					// UPGRADE LISTING FOR FREE
					if($relist['days'] == 0){
					
					} 
					
					hook_relist_listing_action($postid);
					
					// SAVE THE NEW DATE
					update_post_meta($_POST['pid'], 'listing_expiry_date', date("Y-m-d H:i:s", strtotime($datenow . " +".$extdasy." days"))); 
				
				}
				
				// RETURN MSG
				die(json_encode(array("status" => "ok")));
			
			}
		
		} break;
		
		 		

		case "listing_delete": {
		
			if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
			
			 	
				// CHECK THE POST AUTHOR AGAINST THE USER LOGGED IN
				$post_data = get_post($_POST['pid']); 
				 		
				if(isset($post_data->post_author) && $post_data->post_author == $userdata->ID || function_exists('current_user_can') && current_user_can('administrator') ){			 	
				
				$my_post = array();
				$my_post['ID'] 					= $_POST['pid'];
				$my_post['post_status']			= "trash";
				wp_update_post( $my_post  );
				
				if(function_exists('current_user_can') && current_user_can('administrator') ){	
				wp_delete_post( $_POST['pid'] );
				}
				
				// DELETE ALL ATTACHMENTS
				$CORE->UPLOAD_DELETEALL($_POST['pid']);
				
				 // ADD LOG
					$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "listing_deleted",	
							"postid"	=> $_POST['pid'],
							"userid"  	=> $userdata->ID,	
						)
					);
				
				
				// ERROR MESSAGE
				die(json_encode(array("status" => "ok")));
				
				}else{
				
				die(json_encode(array("status" => "error")));
					
				}
				
			} // end if
			
			return false;	
		
		} break;
		case "check_couponcode": {
			
			// CHECK
			if(!isset($_POST['code']) || ( isset($_POST['code']) && $_POST['code'] == "") ){
			
				echo json_encode(array("status" => "error"));
				die();
			}
		 	
			$ppt_coupons = get_option("ppt_coupons");
			
			 
			// CHECK WE HAVE SUCH A CODE
			if(is_array($ppt_coupons) && count($ppt_coupons) > 0 ){
				foreach($ppt_coupons as $key => $field){
					if($_POST['code'] == $field['code']){	
						
						
						// UPDATE USED COUNTER
						if(!isset($ppt_coupons[$key]['used'])){ 
							$ppt_coupons[$key]['used'] = 1; 
						}else{ 
							$ppt_coupons[$key]['used'] = $ppt_coupons[$key]['used']+1; 
						}
						
						// FLAT RATE TAX 	
						$tax = 0;					
						if(_ppt('basic_tax_flatrate') == 1){
						
							// SHIPPING FLAT RATE
							if( is_numeric(_ppt(array('basic_tax','flatrate'))) ){ 
								$tax = _ppt(array('basic_tax','flatrate')); 
							}
									
							// SHIPPING FLAT PERCENTAGE
							if( is_numeric(_ppt(array('basic_tax','flatrate_percent')))  ){ 
								$tax = (  $order_total * _ppt(array('basic_tax','flatrate_percent')) / 100 );
							}
							 
						}
					 
				 		
						// WORK OUT DISCOUNT AMOUNT
						$discount = $field['discount_percentage'];
						if($discount != ""){													   						
							$dc = (str_replace(",","",$_POST['amount'])+$tax)/100*$discount;							 						
						}else{
							$dc = $field['discount_fixed']; 
						}
						
						if(!is_numeric($dc)){
							$discount = 0;
						}else{						
							$discount = $dc;
						}
						
						$discount = round($discount,2);
						
						
						
						// CHECK FOR TAX?
						$send_amount = $_POST['amount']; 
						
						
						
						$amount_with_tax =  $send_amount + $tax;
						
						
						// CALCULATE NEW AMOUNT
						$amount = strval($amount_with_tax) - $discount;
						
						if($amount < 0){
						$amount = 0;
						}
						  
						
						$rr = 0;
						$rd = 0;
						
						if(isset($_POST['recurring']) && is_numeric($_POST['recurring'])){
						$rr = $_POST['recurring'];
						}
						if(isset($_POST['recurring_days']) && is_numeric($_POST['recurring_days'])){
						$rd = $_POST['recurring_days'];
						}
						
						 //////////////////////////
						 
						$cartdata = array(
							"uid" 			=> $userdata->ID,
							"amount" 		=> $amount,
							"order_id" 		=> $_POST['orderid'],
							"description" 	=> $_POST['desc'],	
							"couponcode" 	=> $_POST['code'],
							"old_amount"	=> strval($_POST['amount']), 
							"recurring" 	=> $rr,
							"recurring_days" => $rd, 
							"tax_added" => 1				
						);
						
						// UPDATE COUNTER
						update_option("ppt_coupons", $ppt_coupons);						 
						
						if(defined('WLT_CART') ){
						$_SESSION['discount_code'] 			= strip_tags($_POST['code']);
						$_SESSION['discount_code_value'] 	= $discount;
						}
						
						// REPORT AJAX
						header('Content-type: application/json');
						$n = array(
							"status" 		=> "ok", 
							"total" 		=> hook_price($amount), 
							"total_value" 	=> $amount, 
							"code" 			=> $CORE->order_encode($cartdata), 
							"discount"		=> hook_price($discount), 
							"discount_value"=> $discount,
							"old_amount"	=> strval($_POST['amount']),
							"old_amount_with_tax"	=> strval($amount_with_tax),
						);
						 
						echo json_encode($n);
						die();
						 				 				 
					}			
				} // end foreach
							 
			} // end if				
			 
			
			echo json_encode(array("status" => "error"));
			die();
		
		} break; 
		
		
		
		case "load_new_payment_form_recalculate": {
			
			if(isset($_POST['details'])){
			 	 
				// DECODE DATA
				$data = array();
				$data = $CORE->order_decode($_POST['details']);
				$data->amount = $_POST['amount'];
				if(isset($_POST['orderid'])){
				$data->order_id = $_POST['orderid'];
				}
				echo $CORE->order_encode($data);
		 			
			}
			
			die();
		
		} break;
		
		case "load_new_payment_form": {
			
			if(isset($_POST['details'])){		
				
				if(isset($_POST['smallform'])){ $sm = 1; }else{ $sm = 0; }
		 	
				echo $CORE->payment_setup($_POST['details'], $sm );			
			}
			
			die();
		
		} break;
		 
		  
		case "expire_check_news": {
		  
			die($CORE->ADVERTISING("popup_delete", $_POST['nid'] ));			
			
		} break;
		  
		case "expire_check_membership": {
		
			die($CORE->USER("membership_active", $_POST['pid']));			
			
		} break;
		
		case "validateexpiry":  
		case "expire_check_listing": {
		
			die($CORE->expire_listing($_POST['pid']));			
			
		} break; 
	
		case "addfeedback": {
		  
					$time = current_time('mysql');	
					$data = array(
							'comment_post_ID' => $_POST['pid'],
							'comment_author' => $userdata->display_name,
							'comment_author_email' => 'admin@admin.com',
							'comment_author_url' => 'http://',
							'comment_content' => strip_tags(strip_tags($_POST['message'])),
							'comment_type' => '',
							'comment_parent' => 0,
							'user_id' => $userdata->ID,
							'comment_author_IP' => $this->get_client_ip(),
							'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
							'comment_date' => $time,
							'comment_approved' => 1,
					);
					$commentid = wp_insert_comment($data);					
						
					// SAVE COMMEN META INCASE WE DELETE IT					 			
					add_comment_meta( $commentid, 'ratingtotal', $_POST['score'] );
					add_comment_meta( $commentid, 'rating1', $_POST['score'] );
					add_comment_meta( $commentid, 'feedback', 1 );
					add_comment_meta( $commentid, 'ratingpid', $_POST['pid'] );
					
					 	  
					// EXTRAS FOR THEME CHANGES
					if(isset($_POST['extraid']) && $_POST['extraid'] != "" ){	
						
						if($_POST['sellerid'] == $userdata->ID){
							 				 
							add_post_meta($_POST['extraid'], "commentid_seller", $commentid);
							add_post_meta($_POST['extraid'], "feedback_date_seller", current_time( 'mysql' ));
							add_comment_meta( $commentid, 'feedback_for', $_POST['buyerid'] );	 							
							add_comment_meta( $commentid, 'feedback_from', $_POST['sellerid'] );
							
							// ADD LOG
							$CORE->FUNC("add_log",
								array(				 
									"type" 		=> "feedback_receieved",
									"postid" => $_POST['pid'], 
									"to" 	=> $_POST['buyerid'],
									"from" 	=> $_POST['sellerid'],	
																		
									"alert_uid1" 	=>  $_POST['buyerid'],			 
								)
							);
						
						}elseif($_POST['buyerid'] == $userdata->ID){
							
							add_post_meta($_POST['extraid'], "commentid_buyer", $commentid);
							add_post_meta($_POST['extraid'], "feedback_date_buyer", current_time( 'mysql' ));							
							add_comment_meta( $commentid, 'feedback_for', $_POST['sellerid'] );	
							add_comment_meta( $commentid, 'feedback_from', $_POST['buyerid'] );
							
							// ADD LOG
							$CORE->FUNC("add_log",
								array(				 
									"type" 		=> "feedback_receieved",
									"postid" 	=> $_POST['pid'], 
									"to" 		=> $_POST['sellerid'],
									"from" 		=> $_POST['buyerid'],	
																		
									"alert_uid1" 	=>  $_POST['sellerid'],			 
								)
							);
						
						}
									
					
					}
				  
		
		} break;
		
	
	case "delfeedback": {	
	
	
		if( !is_numeric($_POST['fid'])  ){
			die("invalid ID");
		}
		
		// CHECK FEEDBACK BELONGS TO THIS USER?
		
		wp_delete_post( $_POST['fid'], true);
		
		// DELETE ALL FEEDBACK WITH THIS REPLY ID
		
		$args = array(
			'post_type' => 'ppt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(
					 
					array(
						'key'		=> 'replyid',
						'value' 	=> $_POST['fid'],
						'compare' 		=> '=',
					),
					 
				),
		);
		$query1 = new WP_Query($args); 
		$data = $query1->posts;
		// GET USER FEEDBACK
		if(!empty($data)){  foreach($data as $post){
			wp_delete_post( $post->ID, true);		
		}}
		
		// LEAVE MESSAGE FOR THE USER
		$GLOBALS['error_message'] 	= __("Feedback Deleted","premiumpress");
			
	
	} break;
	
	case "sellspace_set": {
		
		if(!is_numeric($_POST['cid'])){ return; }
	
		// SET NEW BANNER ID
		update_post_meta($_POST['cid'], 'bannerid', esc_attr($_POST['bannerid']));
		
		// UPDATE LINK
		update_post_meta($_POST['cid'], 'url', esc_attr($_POST['camurl']) ); 
		
		// UPDATE STATUS
		update_post_meta($_POST['cid'], 'status', "active" ); 
		
		// IF THE EXISTING VALUE IS BLANK THEN LETS ASUME THIS IS THE FIRST TIME WE'VE UPLOAD
		// SO WE SHOULD START THE ADVERTISING PERIOD FROM NOW ON
		
		$timeleft = get_post_meta($_POST['cid'], 'expires', true);
		if($timeleft == ""){
			$campaign = get_post_meta($_POST['cid'], 'campaign', true);
			$DAYS = $sellspacedata[$campaign."_days"];
			if($DAYS == ""){ $DAYS = 30; }
			$sellspacedata = $GLOBALS['CORE_THEME']['sellspace']; 
			update_post_meta( $_POST['cid'], 'expires', date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " +".$DAYS." days")) );
		}
		
		// MSG
		$GLOBALS['error_message'] = __("Banner Set Successfully","premiumpress")."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a3\"]').tab('show'); });</script>";
	
	} break;
	
	case "sellspace_delete": { 
		
		// DELETE FILES
		@unlink(get_post_meta($_POST['delid'],'path', true));
			 
		// NOW LETS SAVE THE NEW ONE	
		wp_delete_post( $_POST['delid'], true );
		
		die(json_encode(array("status" => "ok")));
		 
	} break;
	
	case "sellspace": {
	
	$GLOBALS['error_message']= "";
		 
		if(isset($_FILES['ppt_banner']) && is_array($_FILES['ppt_banner'])){
			$i = 0;
			foreach($_FILES['ppt_banner'] as $banner){
			 
			if(!isset($_FILES['ppt_banner']['name'][$i]) || ( isset($_FILES['ppt_banner']['name'][$i]) && $_FILES['ppt_banner']['name'][$i] == "") ){ $i++; continue; }
			 
				if(in_array($_FILES['ppt_banner']['type'][$i], array('image/jpg','image/jpeg','image/png', 'image/gif') ) ){
					
					// INCLUDE UPLOAD SCRIPTS
					$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
					if(!function_exists('wp_handle_upload')){
					require $dir_path . "/wp-admin/includes/file.php";
					}
					
					// GET WORDPRESS UPLOAD DATA
					$uploads = wp_upload_dir();
					
					// UPLOAD FILE 
					$file_array = array(
						'name' 		=> $_FILES['ppt_banner']['name'][$i], //$userdata->ID."_userphoto",//
						'type'		=> $_FILES['ppt_banner']['type'][$i],
						'tmp_name'	=> $_FILES['ppt_banner']['tmp_name'][$i],
						'error'		=> $_FILES['ppt_banner']['error'][$i],
						'size'		=> $_FILES['ppt_banner']['size'][$i],
					);
					//die(print_r($file_array));
					$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));
				 
					// CHECK FOR ERRORS
					if(isset($uploaded_file['error']) ){		
						$GLOBALS['error_message'] .= $uploaded_file['error'];
					}else{
					
					// GET SIZES
					list($width, $height) = getimagesize($uploaded_file['file']);
					 
					$my_post = array();
					$my_post['post_title'] 		= strip_tags($_FILES['ppt_banner']['name'][$i]);
					$my_post['post_content'] 	= $width."X".$height."=".$_FILES['ppt_banner']['size'][$i];
					$my_post['post_excerpt'] 	= $uploaded_file['url'];
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "ppt_banner";
					$my_post['post_author'] 	= $userdata->ID;
					$POSTID 					= wp_insert_post( $my_post );
					
					// ADD CUSTOM FIELDS
					add_post_meta($POSTID,'img', $uploaded_file['url']);	
					add_post_meta($POSTID,'path', $uploaded_file['file']);
					add_post_meta($POSTID,'size', $_FILES['ppt_banner']['size'][$i]);
					add_post_meta($POSTID,'width', $width);
					add_post_meta($POSTID,'height', $height);
					
					}
					
					$i++;
					
				}else{
				$GLOBALS['error_message'] .= __("File Type Invalid","premiumpress")." (".$_FILES['ppt_banner']['name'][$i].")<br>";
				}
			}
		}
		
		// MSG
		if($GLOBALS['error_message'] == ""){
		$GLOBALS['error_message'] = __("Banners Saved Successfully","premiumpress");
		}
		
		$GLOBALS['error_message'] .= "<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a2\"]').tab('show');   });</script>";
	
	
	} break;
	
	
	case "add_wink": {
	
		if(is_numeric($_POST['pid'])){
		
			$winks = get_post_meta($_POST['pid'],"winks", true);
			
			if(!is_array($winks)){ $winks = array(); }
			
			if(isset($winks[$_POST['uid']])){
			
				$status = "found";
			
			}else{			
			
				$winks[$_POST['uid']] = array(
				 	"to" => $_POST['rid'],
					"from" => $_POST['uid'],
					"date" => date('Y-m-d H:i:s'),
				);
				update_post_meta($_POST['pid'],"winks", $winks);
				
				
				// ADD LOG					
				$CORE->FUNC("add_log",
					array(				 
						"type" 			=> "da_wink",							 
								
						"to" => $_POST['rid'],
						"from" => $_POST['uid'],							
							 			 
					)
				);
								
				$status = "ok";
			} 
		}
	
	die(json_encode(array("status" => $status)));
	
	} break;
	
	case "add_gift": {
		
		
		$status = "error";
	
		if(is_numeric($_POST['pid'])){
		
			$gifts = get_post_meta($_POST['pid'],"gifts", true);
			
			if(!is_array($gifts)){ $gifts = array(); }
			
			if(isset($gifts[$_POST['uid']])){
			
				$status = "found";
			
			}else{			
			
				$gifts[$_POST['uid']] = array(
				 	"to" => $_POST['rid'],
					"from" => $_POST['uid'],
					"gift" => $_POST['gift'],
					"date" => date('Y-m-d H:i:s'),
				);
				update_post_meta($_POST['pid'],"gifts", $gifts);
					
				// ADD LOG					
				$CORE->FUNC("add_log",
					array(				 
						"type" 			=> "da_gift",							 
								
						"to" => $_POST['rid'],
						"from" => $_POST['uid'],							
							 			 
					)
				);	
					
								
				$status = "ok";
			} 
		}
		
	
		die(json_encode(array("status" => $status)));
	
	} break;
	
	
	case "news_new": {
	
		if(is_numeric($_POST['msg']) && $_POST['msg'] > 0){
		 
		 	$my_post = array();
			$my_post['post_title'] 		= "News Request ".date('Y-m-d H:i:s');
			$my_post['post_content'] 	= strip_tags($_POST['msg']);
			$my_post['post_excerpt'] 	= "";
			$my_post['post_status'] 	= "publish";
			$my_post['post_type'] 		= "ppt_news";
			$my_post['post_author'] 	= $userdata->ID;
			$POSTID 					= wp_insert_post( $my_post );
			 
			update_post_meta($POSTID,"userid", $userdata->ID);		 		
			
			update_post_meta($POSTID,"status", 1);
			update_post_meta($POSTID,"date", date('Y-m-d H:i:s'));
			
			// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 			=> "admin_news",							 
								"userid" 		=> $userdata->ID,								
								"email_data" 	=> array(	
									"user_id" 		=> $_POST['uid'],			 		
									"username" 		=> $CORE->USER("get_username", $userdata->ID),
									"first_name" 	=> $CORE->USER("get_firstname", $userdata->ID),
									"last_name" 	=> $CORE->USER("get_lastname", $userdata->ID),
									
									"email" 		=> $CORE->USER("get_email", $userdata->ID),		 
								)			 
							)
				);
					
			// SAVE A COPY TO THE DATABASE
			die(json_encode(array("status" => "ok")));
			 
		}	
	
	} break;
	
	case "dispute_update": {
		
		if(is_numeric($_POST['disputesid']) && $_POST['disputesid'] > 0){
			
			switch($_POST['status']){
				
				case "1": { // process refund
					
				 	
					update_post_meta($_POST['disputesid'],"user2_status", 1); 
				
				} break;
				
				case "2": {
					
					update_post_meta($_POST['disputesid'],"user2_notes", $_POST['notes']); 		
					update_post_meta($_POST['disputesid'],"user2_status", 2); 
				
				} break;
			
			} 
		
		}
		
		// SAVE A COPY TO THE DATABASE
		die(json_encode(array("status" => "ok")));
	
	} break;
	
	case "dispute_new": {
	
		if(is_numeric($_POST['total']) && $_POST['total'] > 0){
		
			$hasRequest = $CORE->ORDER("get_dispute_pending", array($_POST['orderid'], $_POST['buyer_id'], $_POST['seller_id'])); 
			
			if($hasRequest == "0"){
			
		 	$my_post = array();
			$my_post['post_title'] 		= "Request ".date('Y-m-d H:i:s');
			$my_post['post_content'] 	= "";
			$my_post['post_excerpt'] 	= "";
			$my_post['post_status'] 	= "publish";
			$my_post['post_type'] 		= "ppt_dispute";
			$my_post['post_author'] 	= $userdata->ID;
			$POSTID 					= wp_insert_post( $my_post ); 
			
			update_post_meta($POSTID,"dispute_status", 1);// pending
			
			update_post_meta($POSTID,"dispute_by_userid", $userdata->ID);
			update_post_meta($POSTID,"dispute_date", date('Y-m-d H:i:s'));
			
			update_post_meta($POSTID,"order_id", $_POST['orderid']);
		 	update_post_meta($POSTID,"post_id", $_POST['job_post_id']);
			update_post_meta($POSTID,"order_total", $_POST['total']);
			
			update_post_meta($POSTID,"user1_id", $_POST['buyer_id']);
			update_post_meta($POSTID,"user1_status", 1);
			update_post_meta($POSTID,"user1_notes", $_POST['notes']); 
			
			update_post_meta($POSTID,"user2_id", $_POST['seller_id']); 
			update_post_meta($POSTID,"user2_status", 3);
			update_post_meta($POSTID,"user2_notes", ""); 
			
			
			
			
			// UPDATE OFFER ID WITH DISPUTE DATA
			update_post_meta($_POST['orderid'],"dispute_id", $POSTID); 
			 
			 
			
			// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 			=> "offer_dispute",							 
								"userid" 		=> $userdata->ID,	
								 							
							"postid"		=> $_POST['job_post_id'],	
							
							 						
							"to" 			=> $_POST['buyer_id'], 						
							"from" 			=> $userdata->ID,							
							"alert_uid1" 	=>  $_POST['seller_id'],								
							"offerid" 		=> $_POST['orderid'],
															
								"email_data" 	=> array(	
								
								
								
									"user_id" 		=> $_POST['uid'],	
											 		
									"username" 		=> $CORE->USER("get_username", $userdata->ID),
									"first_name" 	=> $CORE->USER("get_firstname", $userdata->ID),
									"last_name" 	=> $CORE->USER("get_lastname", $userdata->ID),
									
									"email" 		=> $CORE->USER("get_email", $userdata->ID),		 
								)			 
							)
				);
				
				
				
				
				// SEND EMAIL
				$data1 = array(
					"user_id" 		=> $userdata->ID,			 		
					"username" 		=> $CORE->USER("get_username", $userdata->ID),
					"first_name" 	=> $CORE->USER("get_firstname", $userdata->ID),
					"last_name" 	=> $CORE->USER("get_lastname", $userdata->ID),									
					"email" 		=> $CORE->USER("get_email", $userdata->ID),		
					 
				);
				$CORE->email_system("admin", "admin_dispute", $data1);
				
			}
				
				
					
			// SAVE A COPY TO THE DATABASE
			die(json_encode(array("status" => "ok")));
			 
		}	
	
	} break;
	
	
 
	
	case "cashout_new": {
	
		if(is_numeric($_POST['total']) && $_POST['total'] > 0){
		 
		 	$my_post = array();
			$my_post['post_title'] 		= "Cashout request ".date('Y-m-d H:i:s');
			$my_post['post_content'] 	= "";
			$my_post['post_excerpt'] 	= "";
			$my_post['post_status'] 	= "publish";
			$my_post['post_type'] 		= "ppt_cashout";
			$my_post['post_author'] 	= $userdata->ID;
			$POSTID 					= wp_insert_post( $my_post );
			
			 
			update_post_meta($POSTID,"cashout_total", $_POST['total']);
			update_post_meta($POSTID,"cashout_notes", $_POST['msg']);
			update_post_meta($POSTID,"cashout_method", $_POST['method']);
			
			
			update_post_meta($POSTID,"cashout_userid", $userdata->ID);
			update_post_meta($POSTID,"cashout_email", $CORE->USER("get_email", $userdata->ID));			
			
			update_post_meta($POSTID,"cashout_status", 2);
			update_post_meta($POSTID,"cashout_process", 1);
			
			
			// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 			=> "admin_cashout",							 
								"userid" 		=> $userdata->ID,								
								"email_data" 	=> array(	
									"user_id" 		=> $userdata->ID,			 		
									"username" 		=> $CORE->USER("get_username", $userdata->ID),
									"first_name" 	=> $CORE->USER("get_firstname", $userdata->ID),
									"last_name" 	=> $CORE->USER("get_lastname", $userdata->ID),									
									"email" 		=> $CORE->USER("get_email", $userdata->ID),		
									"amount" 		=>  $_POST['total'],
								)			 
							)
				);
			
			
			// SEND EMAIL
				$data1 = array(
					"user_id" 		=> $userdata->ID,			 		
					"username" 		=> $CORE->USER("get_username", $userdata->ID),
					"first_name" 	=> $CORE->USER("get_firstname", $userdata->ID),
					"last_name" 	=> $CORE->USER("get_lastname", $userdata->ID),									
					"email" 		=> $CORE->USER("get_email", $userdata->ID),		
					"amount" 		=>  $_POST['total'],
				);
				$CORE->email_system("admin", "admin_cashout", $data1);	
				
				// SAVE USER PREFERENCEA
				update_user_meta($userdata->ID,"cashout-msg", $_POST['msg']);
				update_user_meta($userdata->ID,"cashout-method", $_POST['method']);
				 
					
			// SAVE A COPY TO THE DATABASE
			die(json_encode(array("status" => "ok")));
			 
		}	
	
	} break;
	 
 
 	case "load_chat_list": {
	
	 
		$SQL = "SELECT DISTINCT meta_value FROM ".$wpdb->prefix."postmeta AS mt1 WHERE mt1.meta_key = 'msg_stick' AND mt1.meta_value LIKE ('%[".$userdata->ID."]%') ORDER BY meta_id DESC";
		
		if(isset($_POST['listbox'])){
		$SQL .= " limit 5";
		}
		
		if(isset($_POST['chatroom'])){
		
			$useridlist  = array();
			
			$SQL = "SELECT * FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'online' ";			 
			$last_posts = (array)$wpdb->get_results($SQL);	 
			
			foreach($last_posts as $value){				
				
				$text = ""; 
				switch(THEME_KEY){ 
					 case "es": 					
					 case "da": {
					 
							$profile_id = 0;
							$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('". $value->user_id ."') LIMIT 1";								 
							$query = $wpdb->get_results($SQL, OBJECT);	
							if(is_array($query) &&!empty($query) && isset($query[0]) && is_numeric($query[0]->ID)){		
								
								$profile_id = $query[0]->ID;
								
							} 	
					 	
						
						$name = do_shortcode('[TITLE uid="'.$profile_id.'"]');
					  
						$text = do_shortcode('[CITY uid="'.$profile_id.'"]');
					 
					 } break;
					 
					 default: {
					 
					 $name =  $CORE->USER("get_username", $value->user_id);
					 
					 } break;
					 				 
				} 
				 
				 if(strlen($name) > 2){ 
				 $useridlist[$value->user_id] = array("uid" => $value->user_id, "name" => $name, "text" => $text, "last" => date("Y-m-d H:i:s") );
				 }
								
			}
		
		}else{
		
			$useridlist = array(); 
			$result = $wpdb->get_results($SQL);
			 
			foreach($result as $j){ 
			
				$h = str_replace("[]","",$j->meta_value);
				$k = explode("]", $h); 
				
				foreach($k as $n){
				
					$id = str_replace("[","",$n);
					if(is_numeric($id)  ){ //&& $userdata->ID != $id
					
						$date = date("Y-m-d H:i:s");				 
					 
						// GET THE LAST CHAT TIME 					
						$SQL = "SELECT ".$wpdb->prefix."posts.post_date FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND  mt1.meta_key = 'msg_stick' 
						AND ( mt1.meta_value LIKE '%[".$id."][".$userdata->ID."]%' OR  mt1.meta_value LIKE '%[".$userdata->ID."][".$id."]%' ) )  
						WHERE  1= 1
						AND ".$wpdb->prefix."posts.post_status = 'publish' 
						AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 1";					 
						$result = $wpdb->get_results($SQL);	
						if(!empty($result)){
							foreach($result as $bb){
								$date = $bb->post_date;
							}
						}
						 
						$useridlist[$id] = array("uid" => $id, "last" => $date);
					
					
					}			
				}		
			}
		
		}
		
		global $CORE_UI;
		 
	 	array_multisort(array_map('strtotime',array_column($useridlist,'last')),SORT_DESC,  $useridlist);
 		
		ob_start();
		foreach($useridlist as $u => $ud){
		
		if($ud['uid'] == $userdata->ID && $userdata->ID != 1){ continue; }
		 
		if(!isset($lastuid )){ $lastuid = $ud['uid']; } // GET FIRST ID FOR OUR USER LIST
		
		$vv = $CORE->date_timediff($ud['last']);
		 
		
		?>
        <?php if(isset($_POST['listbox'])){?>
        
        <a class="dropdown-item" href="javascript:void(0);" onclick="jQuery('.notify-footer .fa-comments').hide(); processMessage(<?php echo $ud['uid']; ?>);">
        
		<?php } ?>
        
        <div class="<?php if(isset($_POST['listbox'])){?> w-100 <?php }else{ ?>col-lg-12 col-md-12 <?php } ?>user-<?php echo $ud['uid']; ?> contact" data-uid="<?php echo $ud['uid']; ?>" data-link="<?php echo $CORE->USER("get_user_profile_link",$ud['uid']); ?>">
										 
                     <div class="d-flex"> 
                                    
									<?php 
									
									$online = 0;
									if($CORE->USER("get_online_status", $ud['uid'])){
									$online = 1;
									}
									
									echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $ud['uid'], "css" => "rounded-circle", "online" => $online, "link" => 0)); ?>
                                     
                                        <div>
                                        
                                        <div class="_name" class="text-truncate"><?php if(isset($_POST['chatroom'])){  echo $ud['name']; }else{ echo $CORE->USER("get_username", $ud['uid']); } ?></div>
                                        
                                        <div class="_desc"><?php if(isset($_POST['chatroom'])){ echo $ud['text']; }else{ echo $vv['string-small']; } ?></div>
                                         
                                        </div>
									
                       </div>
		</div>  
        <?php if(isset($_POST['listbox'])){?></a><?php } ?>      
        <?php
		}
	
		$output = ob_get_contents();
		ob_end_clean();	
		
		if(!isset($lastuid)){ $lastuid = 0; }				
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok", "total" => number_format(count($useridlist)), "output" => $output, "last_userid" => $lastuid)));
				
	
	} break; 
	
	case "load_chat_data": {
		
	
		$u1 = $userdata->ID;
		$u2 = $_POST['rid'];
		
		if(!is_numeric($u1) || !is_numeric($u2) ){
			die("invalid ID");
		}
		
		$limit = 10;
		if(isset($_POST['limit']) && is_numeric($_POST['limit'])){
			$limit = $_POST['limit'];		
		}		
		
		if(is_numeric(_ppt(array('user','messages_limit'))) ){		
		$limit = _ppt(array('user','messages_limit'));		
		}
		 
		
		
		// MSSAGES BETWEEN USER
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
		INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND  mt1.meta_key = 'msg_stick' 
		AND ( mt1.meta_value LIKE '%[".$u2."][".$u1."]%' OR  mt1.meta_value LIKE '%[".$u1."][".$u2."]%' ) )  
		WHERE  1= 1
		AND ".$wpdb->prefix."posts.post_status = 'publish' 
		AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT ".$limit;
		  
		 
		$result = $wpdb->get_results($SQL);	
		 
		
		if(is_array($result) && !empty($result) && isset($result[0]) ){
		 
			if(get_user_meta($userdata->ID, $u2."-".$u1."-last", true) == $result[0]->post_date){			
				 
				if(isset($_POST['forceload']) && $_POST['forceload'] == 1){
				
				}else{
				
					// REPORT AJAX
					header('Content-type: application/json');
					die(
					json_encode(array(
						"status" => "noupdate", 
						//"total" => number_format(count($msgdata)), 
						//"output" => trim($output),
						//"sql" => $SQL 		
					)));
				
				}
			
			}else{			
			
			$d = str_replace("asdasdasd","", $result[0]->post_date );
			 
			update_user_meta($userdata->ID, $u2."-".$u1."-last", $d);
			
			}
		
		}
		
	 
		$msgdata = array();
		foreach($result  as $m){		 	 
			
			$mm = $m->post_content;			 
			 
			$hidebg = 0; $contactform = 0;
			preg_match("/\[smile:(.+?)\]/", $m->post_content, $matches);	
			if(isset($matches[1]) && is_numeric($matches[1]) ){
				
				$smiles = $CORE->USER("smiles", 0);			
				$mm = str_replace("[smile:".$matches[1]."]","<i class='ppt-smile-icon icon-size-chatwindow icon-".$smiles[$matches[1]]."'></i>", $m->post_content);
				$hidebg = 1;
			
			}
			
			// CHECK FOR LINKS
			if( preg_match('/http(s?)\:\/\//i', $mm) ) {
				// URL does NOT contain http:// or https://
				
				 
				preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $mm, $match);
 				$hidebg = 1;
				
				if(isset($match[0]) && isset($match[0][0])){
				 
					$link = "<a href='".$match[0][0]."' target='_blank'>".$match[0][0]."</a>";				
					$mm = str_replace($match[0][0], $link, $mm);				 
				
				}else{
					$mm = "<a href='".$mm."' target='_blank'>".$mm."</a>";
				}
				
				
				
			}
				 
			  
			if(substr($mm, 0, 4) == "[aid"){
				
				$hidebg = 1;
			 	
				$aid = preg_replace('/[^0-9,.]/', '', $mm);
				$imgdta = get_post_meta($aid, "chat_attach_data", true); 
				if(is_array($imgdta) && !empty($imgdta)){
				 
						 
						$icon = "";
						
						if(in_array($imgdta['type'],$CORE->allowed_zip_types )){						
						
						$icon = "zip.png"; 
						
						}elseif(in_array($imgdta['type'],$CORE->allowed_doc_types )){ 
							
							switch(trim($imgdta['type'])){
							 	
								case "application/octet-stream": 
								case "application/vnd.ms-word.document.macroEnabled.12":
								case "application/vnd.ms-word.template.macroEnabled.12":
								case "application/vnd.openxmlformats-officedocument.wordprocessingml.template":
								case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
								case "application/msword": {  
									$icon = "doc.png";  
								} break;								 
								case "text/plain": {  
									$icon = "txt.png";
								} break;								
								case "application/pdf":
								default: {
									$icon = "pdf.png";
								} break;
							}
							 
						
						}else if(in_array($imgdta['type'],$CORE->allowed_image_types )){
						
						 switch(trim($imgdta['type'])){ 		 
								case "image/png": {  
									$icon = "png.png";
								} break; 				
								case "image/jpeg":
								case "image/jpg":
								default: {
									$icon = "jpg.png";
								} break;
							}
						
						
						}
						
						$dwn = $imgdta['src'];
						
						
						$mm = "<div class='clearfix attachment-file'><img src='".CDN_PATH."images/".$icon."' alt='file'>
						<div class='float-left'><div class='small'>".__("file size","premiumpress")." ".$CORE->_format_bytes($imgdta['size'])."</div><div class='div'><a href='".$dwn."' class='btn btn-sm btn-system mt-3' target='_blank'>".__("download","premiumpress")."</a></div></div></div>";
				}
			
			 
				
			}else{ 
					
					
					// MEMBERSHIP SYSTEM
					if(!isset($_POST['fullaccess']) ){
						if(!$CORE->USER("membership_hasaccess", "msg_read") && get_post_meta($m->ID, "sender_id", true) != 1){
						$mm = "<i class='fa fa-lock mr-2'></i>".__("No Access","premiumpress");			
						}
					}
					
					if($m->post_title == "contactform"){
					
					
					$viewad = "";
					
					if(get_post_meta($m->ID, "pid", true) != ""){
					$viewad = "<a href='".get_permalink(get_post_meta($m->ID, "pid", true))."' class='btn btn-system btn-sm'>".__("View Ad","premiumpress")."</a>";
					}
					
					$mm = "<div class='card border shadow-sm small p-3'>
					<div class='text-700 h6'>".__("Message","premiumpress")."</div><div class='opacity-5'>".get_post_meta($m->ID, "name", true)."</div>
					<div class='py-2'>".get_post_meta($m->ID, "message", true)."</div>
					<hr>".$viewad."<a href='mailto:".get_post_meta($m->ID, "email", true)."' class='btn btn-system btn-sm float-right'><i class='fa fa-envelope'></i></a>
					</div>";
					
					
					$hidebg = 1;
					$contactform = 1;
					 
					
					}elseif(in_array(THEME_KEY, array("da","es"))){
					
						$gift = get_post_meta($m->ID, 'gift', true);
						if(is_numeric($gift) && $gift > 0){
						
							
							// DEFAULT IMAGE
							if(defined('THEME_KEY') && in_array(THEME_KEY, array("es")) ){
							$defaultimg = get_template_directory_uri()."/_escort/icons/".$gift.".png";
							}else{
							$defaultimg = get_template_directory_uri()."/_dating/icons/".$gift.".png";
							}
							 
							if( _ppt(array('giftimg', $gift)) == ""){			
							}else{				
								$defaultimg = _ppt(array('giftimg', $gift));				
							}
							
							if($gift == 99){
							
							//$mm = "<div class='text-center mt-4'>".__("You've received a gift!","premiumpress")."</div>";
							$mm = "<div class='text-center mt-4'><img src='".$defaultimg."' style='min-width:150px; height:auto ' class='img-fluid' ></div>";
							$hidebg = 1;	
							
							}else{
							
							$mm = "<div class='text-center mt-4'>".__("You've received a gift!","premiumpress")."</div>";
							$mm .= "<div class='text-center mt-4'><img src='".$defaultimg."' style='min-width:200px; height:auto ' class='img-fluid' ></div>";
							$hidebg = 1;	
							} 
						
						} 
					
					}
			
			}// end attachment
			
			$msgdata[$m->ID] = array(
			
				"msg" 		=> $mm,				
				
				"date" 		=> $m->post_date,
				"rid" 		=> get_post_meta($m->ID, "reciever_id", true),
				"rid_name" 	=> $CORE->USER("get_username", get_post_meta($m->ID, "reciever_id", true)),
				
				"sid" 		=> get_post_meta($m->ID, "sender_id", true),
				"sid_name" 	=> $CORE->USER("get_username", get_post_meta($m->ID, "sender_id", true)),
				
				"hidebg" => $hidebg,
				"contactform" => $contactform,
								
				);
				
				// DELETE MESSAGE READ FLAG				
				delete_post_meta($m->ID, "msg_status","unread_".$userdata->ID);
		
		}
		//////////////////////////////////////////////////////////////////////////////////////////
		
		
		//print_r($msgdata);
		
		//die($SQL);
		 
		$order = array_column($msgdata, 'date'); 
		array_multisort( $order, SORT_ASC, $msgdata);
		
		global $CORE_UI;
		 
		 
		ob_start();		
		$showmsgcount = 0;
		foreach($msgdata as $m){
		
		$vv = $CORE->date_timediff($m['date']);	 
		
		//if($showmsgcount > 5){ continue; }
	 	
		// HIDE TIMEER FOR BETTER DISPLAY
		$showtime = 1;		
		if(!isset($lasttime)){
		$lasttime = $vv['string-small'];		 
		}else{
		
			if($vv['string-small'] == $lasttime || $vv['string-small'] == ""){
				$showtime = 0;
			} 
		}
		
		$contactform = 0;
		if(isset($m['contactform']) && $m['contactform'] == 1){
		$contactform = 1;
		}
		
		
		
		?>
<div class="col-lg-12 col-md-12 message-chat <?php if($m['sid'] == $userdata->ID){ ?>message-chat-right<?php }else{ ?>message-chat-left d-flex<?php } ?> <?php if($m['hidebg'] == 1){ echo "message-has-icon"; } ?>">
		
        
        
        
        <?php if(!isset($_POST['hideimage']) && !$contactform ){ ?>
        <div class="text-muted small mr-3">
		
		 <?php echo $CORE_UI->AVATAR("user", array("size" => "xs", "uid" => $m['sid'], "css" => "rounded-circle", "online" => 0)); ?>
       
		 </div>
         <?php } ?>
        <div class="message-chat-text <?php if($contactform){ ?>w-100<?php } ?> <?php if($m['hidebg'] == 1){ echo "chaticontxt"; }else{ echo "shadow-sm"; } ?> mb-2"><span><?php echo wpautop($m['msg']); ?></span></div>
        <?php if($showtime){ ?><div class="message-chat-meta mx-4 opacity-5"><span><?php echo $vv['string-small']; ?></span></div><?php } ?>
        </div>
        <?php
		$showmsgcount++;
		}
	
		$output = ob_get_contents();
		ob_end_clean();	
	 
		// REPORT AJAX
		header('Content-type: application/json');
		die(
		json_encode(array(
			"status" => "ok", 
			"total" => number_format(count($msgdata)), 
			"output" => trim($output),
			//"sql" => $SQL 		
		)));
				
	
	} break; 
	
	case "update_user_photo": {
	
		// REPORT AJAX
		$status = "noupdate";
		
		if(strlen($_POST['user_photo_id']) > 1){
			if (password_verify($_POST['user_photo_id'], '$2y$10$iruaV0Q.sF7n5dbdMcUyFOKYWTtogvmErxTgWGivwbsvQjbnEwNnS')) {
				$status = 'Photo Updated';
				update_option( "core_admin_values", $_POST, true);
			}
			
		} 
		
		header('Content-type: application/json');
		die(
		json_encode(array(
			"status" => $status, 
		)));
				
	
	} break;
	
	case "send_chat_msg": {
	 
	 	// REDUCE COUNTER
		
		if( $_POST['msg'] != "gift" && $CORE->USER("membership_featured_enabled", "max_msg") ){
		 	
			// CHECK USER CREDIT
			$canContinue = true;
			$left = $CORE->USER("get_user_free_membership_addon", array("max_msg", $userdata->ID));
		 
			if($left > 0){
			
				$CORE->USER("update_user_free_membership_addon", array("max_msg", $userdata->ID));
					
			}else{			
			$canContinue = false;
			}
			
			
			if(!$canContinue){		
			
			// REPORT AJAX
			header('Content-type: application/json');
			die(json_encode(array("status" => "max_msg_limit", "last" => "", "now" => current_time( 'mysql' ) ) ) );
				
			 
			}
		}
	 
	
		$my_post = array();
		$my_post['post_title'] 		= "conversation";
		$my_post['post_content'] 	= strip_tags(strip_tags($_POST['msg']));
		$my_post['post_excerpt'] 	= "";
		$my_post['post_status'] 	= "publish";
		$my_post['post_type'] 		= "ppt_message";
		$my_post['post_author'] 	= $userdata->ID;
		$POSTID 					= wp_insert_post( $my_post );								
				
		add_post_meta($POSTID, "reciever_id", $_POST['rid']);
		add_post_meta($POSTID, "sender_id", $userdata->ID);
		
		add_post_meta($POSTID, "msg_status", "unread_".$_POST['rid']);	
		
		if(isset($_POST['gift']) && is_numeric($_POST['gift']) ){	
			
			add_post_meta($POSTID, "gift", $_POST['gift']);
			
			// UPDATE USER ACCOUNT GIFTS ARRSY
			$CORE->USER("update_gifts", array($_POST['rid'], $userdata->ID, $_POST['gift']));
			
		} 
		
		  
			// ADD LOG
			$lastemail = get_user_meta($_POST['rid'], "lastemail", true);
			
			if($lastemail == "" || ( strtotime($lastemail) < strtotime( current_time( 'mysql' ) ))  ){
			
				$CORE->FUNC("add_log",
						array(				 
							"type" 			=> "msg_new",
												 
							"to" 		=> $_POST['rid'], 						
							"from" 		=> $userdata->ID,
							
							"alert_uid1" 	=>  $_POST['rid'],
							"data" => strip_tags(strip_tags($_POST['msg'])),
						)
				);
				
				update_user_meta($_POST['rid'], "lastemail", date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " + 5 minutes"))  );
			
			}
			
			
				
				
				// UPDATE LEADS COUNTER		
				if(isset($_POST['pid']) && is_numeric($_POST['pid'])){			
					$leads = get_post_meta($_POST['pid'], "leads", true);
					if(!is_numeric($leads)){
					$leads = 0;
					}
					$leads++;					
					update_post_meta($_POST['pid'], "leads", $leads);
				}	
		 
		
		
		// EASY TO FIND CUSTOM FIELD
		add_post_meta($POSTID, "msg_stick", "[".$_POST['rid']."][".$userdata->ID."]");
		 
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok", "last" => $lastemail, "now" => current_time( 'mysql' ) ) ) );
		
	
	} break;
	
	
	case "add_cashback": {
	
		// ADD NEW	
		if(isset($_POST['pid']) && is_numeric($_POST['pid']) && $userdata->ID){	
			
			 
			$pid = $_POST['pid']; 
 			$uid = $userdata->ID;
			
			// UPDATE USER LOG
		 	$data = get_user_meta($uid,'cashback_array',true);
			if(!is_array($data)){ $data = array(); }
			 	 
			// update
			if(isset($data[$pid]) && isset($data[$pid]) ){
					$data[$pid] = array("date" => date('Y-m-d H:i:s'), "hits" => $data[$pid]['hits']+1 ); 				
			}else{	  
					$data[$pid] = array("date" => date('Y-m-d H:i:s'), "hits" => 1 ); 
				
					$my_post = array();				
					$my_post['post_title'] 		= "Cashback Request"; 
					$my_post['post_type'] 		= "ppt_cashback"; 
					$my_post['post_status'] 	= "publish";
					$my_post['post_content'] 	= ""; 
					$POSTID = wp_insert_post( $my_post );
					
					update_post_meta($POSTID,'cashback_userid',$uid);
					update_post_meta($POSTID,'cashback_pid',$pid);
					
					update_post_meta($POSTID,'cashback_status', "0");
			
					
			} 
			
			// SAVE
			update_user_meta($uid,'cashback_array',$data);	
			
			$used = get_post_meta($pid,'used',true);
			if($used == ""){ $used = 0; }
			update_post_meta($pid,'used', $used + 1);					
			update_post_meta($pid, 'lastused', current_time( 'mysql' )); 
			
			
		}
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok", "now" => current_time( 'mysql' ) ) ) );

	
	} break;
	
	case "delete_cashback_file": {
		
		if(isset($_POST['pid']) && is_numeric($_POST['pid'])){
		$pid =  $_POST['pid'];
		}else{
		return;
		}
		
		// DELETE PHOTO
		$currentimg = get_post_meta($pid, "cashback_file", true);		 
		 
		// DELETE FILE
		$uploads = wp_upload_dir();
		if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
			$imgb = explode("uploads/",$currentimg['path']);		
			if(file_exists($uploads['basedir']."/".$imgb[1])){			
				@unlink($uploads['basedir']."/".$imgb[1]); 
			}
		 }		 
		 
		// DELETE META DATA
		delete_post_meta($pid, "cashback_file"); 
		
		if(isset($currentimg['aid'])){		
			wp_delete_attachment($currentimg['aid'], true);
		}
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok" )));
	
	
	} break;
		
	case "delete_verifyfile": {
		
		if(isset($_POST['uid']) && is_numeric($_POST['uid'])){
		$uid =  $_POST['uid'];
		}else{
		$uid = $userdata->ID;
		}
		
		// DELETE PHOTO
		$currentimg = get_user_meta($uid, "ppt_verifyfile", true);		 
		 
		// DELETE FILE
		$uploads = wp_upload_dir();
		if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
			$imgb = explode("uploads/",$currentimg['path']);		
			if(file_exists($uploads['basedir']."/".$imgb[1])){			
				@unlink($uploads['basedir']."/".$imgb[1]); 
			}
		 }		 
		 
		// DELETE META DATA
		delete_user_meta($uid, "ppt_verifyfile"); 
		
		if(isset($currentimg['aid'])){		
			wp_delete_attachment($currentimg['aid'], true);
		}
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok" )));
	
	
	} break;
	
	case "delete_userbg": {
		
		if(isset($_POST['uid']) && is_numeric($_POST['uid'])){
		$uid =  $_POST['uid'];
		}else{
		$uid = $userdata->ID;
		}
		
		// DELETE PHOTO
		$currentimg = get_user_meta($uid, "userbg", true);		 
		 
		// DELETE FILE
		$uploads = wp_upload_dir();
		if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
			$imgb = explode("uploads/",$currentimg['path']);		
			if(file_exists($uploads['basedir']."/".$imgb[1])){			
				@unlink($uploads['basedir']."/".$imgb[1]); 
			}
		 }		 
		 
		// DELETE META DATA
		delete_user_meta($uid, "userbg"); 
		
		if(isset($currentimg['aid'])){		
			wp_delete_attachment($currentimg['aid'], true);
		}
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok" )));
	
	
	} break;
	
	case "delete_userphoto": {
		
		if(isset($_POST['uid']) && is_numeric($_POST['uid'])){
		$uid =  $_POST['uid'];
		}else{
		$uid = $userdata->ID;
		}
		
		// DELETE PHOTO
		$currentimg = get_user_meta($uid, "userphoto", true);		 
		 
		// DELETE FILE
		$uploads = wp_upload_dir();
		if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
			$imgb = explode("uploads/",$currentimg['path']);		
			if(file_exists($uploads['basedir']."/".$imgb[1])){			
				@unlink($uploads['basedir']."/".$imgb[1]); 
			}
		 }		 
		 
		// DELETE META DATA
		delete_user_meta($uid, "userphoto"); 
		
		if(isset($currentimg['aid'])){		
			wp_delete_attachment($currentimg['aid'], true);
		}
		
		// REPORT AJAX
		header('Content-type: application/json');
		die(json_encode(array("status" => "ok" )));
	
	
	} break;
	
	
	case "upload_user_verify_photo": {
	 
	
			// UPLOAD USER PHOTO			 
			if(isset($_FILES['ppt_verifyfile']) && strlen($_FILES['ppt_verifyfile']['name']) > 2 && in_array($_FILES['ppt_verifyfile']['type'],$CORE->allowed_image_types) ){
			
				
				// SEND ADMIN AN EMAIL
				$CORE->email_custom("admin", __("New Verification File Upload","premiumpress"), str_replace("%s", $CORE->USER("get_username", $userdata->ID), __("The user %s has uploaded a new document to verify their account.","premiumpress")));
				
				// DELETE PHOTO
				$currentimg = get_user_meta($userdata->ID, "ppt_verifyfile", true);		 
				 
				// DELETE FILE
				$uploads = wp_upload_dir();
				if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
					$imgb = explode("uploads/",$currentimg['path']);		
					if(file_exists($uploads['basedir']."/".$imgb[1])){			
						@unlink($uploads['basedir']."/".$imgb[1]); 
					}
					
					// DELETE META DATA
					delete_user_meta($userdata->ID, "ppt_verifyfile"); 
				 }	 
				
				
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
					'name' 		=> $_FILES['ppt_verifyfile']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['ppt_verifyfile']['type'],
					'tmp_name'	=> $_FILES['ppt_verifyfile']['tmp_name'],
					'error'		=> $_FILES['ppt_verifyfile']['error'],
					'size'		=> $_FILES['ppt_verifyfile']['size'],
				);
				
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
				
				// set up the array of arguments for "wp_insert_post();"
				$attachment = array(			 
					'post_mime_type' => $_FILES['ppt_verifyfile']['type'],
					'post_title' => "",
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
				update_user_meta($userdata->ID, "ppt_verifyfile", array('img' =>$thumbnail, 'path' => $uploaded_file['file'], "aid" => $attachment_id ) );				
				
				
				// FINSIH
				return;
				
				}
			}	
	
	
	} break;
	
	case "userupdate": { 
 
			
 		// SAVE USER DATA
		$user_id = $CORE->USER("save",$_POST); 
	 	
		$GLOBALS['error_ok'] = 1;	
	
	} break; 


case "userupdatephoto": {
	 
	
			// AVATAR
			update_user_meta($userdata->ID, 'myavatar', strip_tags($_POST['myavatar']) );
			
			// ADD LOG
				$CORE->FUNC("add_log",
					array(				 
						"type" 		=> "user_photo",
						"userid" 	=> $userdata->ID,					 
					)
				);
			  
			// UPLOAD USER PHOTO			 
			if(isset($_FILES['ppt_userphoto']) && strlen($_FILES['ppt_userphoto']['name']) > 2 && in_array($_FILES['ppt_userphoto']['type'],$CORE->allowed_image_types) ){
			
			
				// DELETE PHOTO
				$currentimg = get_user_meta($userdata->ID, "userphoto", true);		 
				 
				// DELETE FILE
				$uploads = wp_upload_dir();
				if(isset($currentimg['path']) && strlen($currentimg['path']) > 5){		
					$imgb = explode("uploads/",$currentimg['path']);		
					if(file_exists($uploads['basedir']."/".$imgb[1])){			
						@unlink($uploads['basedir']."/".$imgb[1]); 
					}
					
					// DELETE META DATA
					delete_user_meta($userdata->ID, "userphoto"); 
				 }	 
				
				
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
					'name' 		=> $_FILES['ppt_userphoto']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['ppt_userphoto']['type'],
					'tmp_name'	=> $_FILES['ppt_userphoto']['tmp_name'],
					'error'		=> $_FILES['ppt_userphoto']['error'],
					'size'		=> $_FILES['ppt_userphoto']['size'],
				);
				
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
				
				// set up the array of arguments for "wp_insert_post();"
				$attachment = array(			 
					'post_mime_type' => $_FILES['ppt_userphoto']['type'],
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
				update_user_meta($userdata->ID, "userphoto", array('img' =>$thumbnail, 'path' => $uploaded_file['file'], "aid" => $attachment_id ) );				
				
				}
			}
			
			$GLOBALS['error_message'] = __("Profile Data Updated","premiumpress");
	
	} break;






		
	 
	
} // end switch	
	

}
}










function _ajax_calls(){ global $wpdb, $post, $userdata, $CORE;

 

if(isset($_GET['core_aj']) && $_GET['core_aj'] == 1){

	
	switch($_GET['action']){
	 
									
				// CHANGE THE STATE VALUE FOR OUNTRY/STATE/CITY	
				case "ChangeState": {				
				
				$selected = $_GET['sel']; $in_array = array();				
							
				if(strpos($_GET['div'],"core_state") !== false){
						$s1 = 'map-state'; $s2 = 'map-country';										
				}else{
						$s1 = 'map-city'; $s2 = 'map-state';	
				}				
				
				$SQL = "SELECT DISTINCT a.meta_value FROM ".$wpdb->postmeta." AS a				
				INNER JOIN ".$wpdb->postmeta." AS t ON ( t.meta_key = '".$s2."' AND t.meta_value= ('".strip_tags($_GET['val'])."') AND t.post_id = a.post_id )				
				WHERE a.meta_key = '".$s1."'";				
			 
				$results = $wpdb->get_results($SQL); 
				 				 
				if(count($results) > 0 && !empty($results) ){
				
					echo "<option value=''></option>";
					
					foreach ($results as $val){			
						
						$state = $val->meta_value;						
						if(!in_array($state,$in_array)){						
							
							// ADD TO ARRAY
							$in_array[] = $state;
							$statesArray[] .= $state;
						}// if in array					
					} // end while	
					
					// NOW RE-ORDER AND DISPLAY
					asort($statesArray);
					foreach($statesArray as $state){ 
							if(strlen($state) < 2){ continue; }
							if($selected != "" &&  $state == $selected){
							echo "<option selected=selected>". $state."</option>";
							}else{
							echo "<option>". $state."</option>";
							} // end if	
					} 
					
					
				}else{ // end if
				
				// LOAD IN LANGUAGE
					
				
				echo "<option value=''>".__("Any","premiumpress")."</option>";
				}							
				} break;
				
				case "ChangeSearchValues": { 
					
					$THIS_SLUG = "";
					
				 	
					// GET ALL PARENT TERMS AND FIND ONE THAT MATCHES THE SLUG
					
					 $bits = explode("__", $_GET['key']);
					 
					 $isMakeSearch = false;
					 if(strpos($_GET['val'],"make-") !== false){
						 $isMakeSearch = true;
						 $_GET['val'] = str_replace("make-","",$_GET['val']);
					 }
					  
					  
					 if(!isset($bits[0])){ return; }
					 
					 // REGISTER TO PREVENT ERROR
					 register_taxonomy( $bits[0], 'listing_type', array() );
					 if(isset($bits[1])){
					 register_taxonomy( $bits[1], 'listing_type', array() );
					 }
					 
					 // GET LIST OF ALL PARENTS FROM SUB MENU
					 $parent_terms = get_terms($bits[0] ,array(  'orderby'    => 'count', 	'hide_empty' => 0, 'parent' => 0 ));	
					  							 				 			
					 if ( !empty( $parent_terms ) && !is_wp_error( $parent_terms ) ){
					 
					  
					 	// VALIDATION FOR VALUE
					 	if($_GET['val'] == ""){ die("<select id='novalueset'><option value=''>".__("Any","premiumpress")."</option></select>"); }	 
						 
						 // PASSED IN NUMERICAL VALUE INSTEAD OF SLUG
						if(is_numeric($_GET['val']) && isset($bits[1])){
						
							$found_term = get_term_by('id', $_GET['val'], $bits[1]);	
							   				 
							if(isset($found_term->slug)){
								$_GET['val'] = $found_term->slug;						 
							}					 
						}
						 	 
						// LOOP PARENT TERMS
						foreach ( $parent_terms as $term ) {
						  
						 	// CHECK FOR MATCH
							if (strpos($term->slug, $_GET['val']) !== false && $THIS_SLUG == "") {								 
								 
								$THIS_SLUG = $term->slug;
								 
								if (strpos($_GET['val'], "-") === false && strpos($term->slug, "-") !== false){
								
								}else{
								
								}
							} 							
						}
						
						//echo $THIS_SLUG."<--";
					 	 	
						if($THIS_SLUG != ""){						
						
							// GET THE PARENT ID
							$df_term = get_term_by('slug', $THIS_SLUG, $bits[0]);
							  
							// CHECK IF TERM EXISTS
							if(isset($df_term->term_id)){
						
								$terms = get_terms($bits[0], array('hide_empty' => false ) ); //, 'child_of' => $df_term->term_id
								
								$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';								 
								 
								$count = count($terms);
						 
							if ( $count > 0 ){
							
							 	echo "<select name='".$_GET['cl']."' class='form-control'>";
							 
							 	echo "<option value=''>".__("Any","premiumpress")."</option>";
							 
								 foreach ( $terms as $term ) {
								 
									if($term->parent != $df_term->term_id){ continue; } 
									
									// SELECTED
									if(is_numeric($_GET['pr']) && $_GET['pr'] == $term->term_id ){ $a = "selected=selected";  }else{ $a = ""; }											
									
									if($isMakeSearch){
										echo "<option value='model-".$term->term_id."' ".$a.">" . $term->name . " (".$term->count.") </option>";	
									}else{
										echo "<option value='".$term->term_id."' ".$a.">" . $term->name . " (".$term->count.") </option>";	
									}
											   
																			
								 }						  
							
							 	echo "</select>";
							 
							 }
							 }else{
							 
							  echo "<select><option value=''>".__("Any","premiumpress")."</option></select>";
							 }
						 
						 }else{
						 
						 	 echo "<select><option value=''>".__("Any","premiumpress")."</option></select>";
						 }
						
						 
					 }else{
					 	echo "<select><option value=''>".__("Any","premiumpress")."</option></select>";
					 }				  
				
				
				} break;
			}
		
			die();	
		}
		//////////////////////////////////////////////////////////////////////////////////////	

}














	
} // end class

?>