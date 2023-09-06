<?php


function ppt_user_fields(){
	
	
	$fields = array(	
	
	"username" => array(	
		
		"title" => __("Username","premiumpress"),
		"desc" => __("The username or email can be used to login.","premiumpress"),
		
		"fields" => array(
		
			"username" => array(			
				"title" => __("Username","premiumpress"),
				"type" => "username",
				"required" => 1,
				
				"info" => __("The username cannot be changed once created.","premiumpress"),
				
			),
			"display_name" => array(			
				"title" => __("Display Name","premiumpress"),
				"type" => "text",
				"required" => 1,
				
				"info" => __("Where possible we will display this name instead of your username.","premiumpress"),
				 
			),
		 
		),
	),
	
	"password" => array(	
		
		"title" => __("Password","premiumpress"),
		
		"desc" => __("Only complete these fields if you wish to change the existing password.","premiumpress"),
		
		"fields" => array(
		
		"password" => array(			
			"title" => __("Password","premiumpress"),
			"type" => "password",
		), 
		"password_r" => array(			
			"title" => __("Password Re-type","premiumpress"),
			"type" => "password",
		), 
			
		),
	),



	
	"contact" => array(	
		
		"title" => __("Email &amp; Phone","premiumpress"),
		
		"desc" => __("A valid email is required.","premiumpress"),
		
		"fields" => array(
		
		"email" => array(
			
			"title" => __("Email","premiumpress"),
			"type" => "email",
			"required" => 1,
		),
		
		"mobile" => array(
			
			"title" => __("Mobile Number","premiumpress"),
			"type" => "mobile",
		),
		
		/*
		"phone" => array(
			
			"title" => __("Phone","premiumpress"),
			"type" => "phone",
		),
		*/
			
		),
	),
	


	
	"about" => array(	
		
		"title" => __("About Me","premiumpress"),
		
		"desc" => __("This information will be displayed on your public profile.","premiumpress"),
		
		"fields" => array(
		
		 
		"description" => array(
			
			"title" => __("My Description","premiumpress"),
			"type" => "textarea",
		),
	
		
		"url" => array(
			
			"title" => __("My Website","premiumpress"),
			"type" => "url",
		),
			
		),
	),


	"preferences" => array(	
		
		"title" => __("Preferences","premiumpress"),
		
		"desc" => __("Where possible we will only show content related to your preferences.","premiumpress"),
		
		
		"fields" => array(
		
			"da-seek2" => array(
					
					"title" => __("Show Me","premiumpress"),
					"type" => "da-seek2",
				),
				
		),
	),


		

	
	"basic" => array(	
		
		"title" => __("Basic Details","premiumpress"),
		
		"desc" => __("This information is not displayed on your profile.","premiumpress"),
		
		
		"fields" => array(
		
	
		
		"first_name" => array(
			
			"title" => __("First Name","premiumpress"),
			"type" => "text",
		),
		"last_name" => array(
			
			"title" => __("Last Name","premiumpress"),
			"type" => "text",
		), 

		"language" => array(
			
			"title" => __("My Language","premiumpress"),
			"type" => "language",
		),
		 
		
		"custom" => array(				
				"title" => __("Custom Fields","premiumpress"),
				"type" => "customfields",
		), 
 
			
		),
	
	),
	
	
	
 
	
	"address" => array(	
		
		"title" => __("Address","premiumpress"),
		
		"desc" => __("Displayed on invoices and purchase reciepts.","premiumpress"),
		
		"hide" => 1,
		"fields" => array(
		
			
			"country" => array(				
					"title" => __("My Location","premiumpress"),
					"type" => "country",
			),
			"city" => array(				
				"title" => __("Region","premiumpress"),
				"type" => "city",
			),
			
			"address1" => array(			
				"title" => __("Address 1","premiumpress"),
				"type" => "text",
			),
			"address2" => array(			
				"title" => __("Address 2","premiumpress"),
				"type" => "text",
			),
		
			
			"town" => array(				
				"title" => __("Town","premiumpress"),
				"type" => "text",
			),
			"zip" => array(				
				"title" => __("Zipcode","premiumpress"),
				"type" => "text",
			),			
		
		),
	
	),
		
		
	
	"avatar" => array(	
		
		"title" => __("User Avatar","premiumpress"),
		"hide" => 1,
		"fields" => array(
		
			"myavatar" => array(
				
				"title" => __("Avatar","premiumpress"),
				"type" => "myavatar",
			),
			
			"userphoto" => array(
				
				"title" => __("Photo","premiumpress"),
				"type" => "userphoto",
			),
			 
		),
	),
	  
		
	
	
	"background" => array(	
		
		"title" => __("Background","premiumpress"),
		"desc" => __("The background image is displayed on your public profile page.","premiumpress"),
		"hide" => 1,
		"fields" => array(
		
			"backgroundimg" => array(
				
				"title" => __("Background Image","premiumpress"),
				"type" => "backgroundimg",
			),
		 
			 
		),
	),
	
 	
	
	"verify" => array(	
		
		"title" => __("User Verification","premiumpress"),
		
		"desc" => __("If any of these are set to no, the user will be required to verify themselves before accessing their account.","premiumpress"),
		
	 	"hide" => 1,
		"adminonly" => 1,
		"fields" => array(
		
		
			"ppt_verified" => array(			
				"title" => __("Email Verified","premiumpress"),
				"type" => "ppt_verified_email",
			),
			
			"ppt_sms_verified" => array(			
				"title" => __("SMS Verified","premiumpress"),
				"type" => "ppt_sms_verified",
			),
			
			"ppt_verified_photo" => array(			
				"title" => __("Photo Verified","premiumpress"),
				"type" => "ppt_verified_photo",
			), 
		
		),
	),
	
	"balance" => array(	
		
		"title" => __("User Balance","premiumpress"),
		
		"desc" => __("Here you can manually adjust the account balance.","premiumpress"),
		
	 	"hide" => 1,
		"adminonly" => 1,
		"fields" => array(
		
			
			"ppt_usercredit" => array(			
				"title" => __("User Credit","premiumpress"),
				"type" => "ppt_usercredit",
			),
				
		),
	),
	

	"user_type" => array(	
		
		"title" => __("User Type","premiumpress"),
		
		"desc" => __("Here you can manually adjust the user type.","premiumpress"),
		
	 	"hide" => 1,
		"adminonly" => 1,
		"fields" => array(
		
			"user_type" => array(			
				"title" => __("User Type","premiumpress"),
				"type" => "user_type",
			),
		 
		),
	),
	
	"store" => array(	
		
		"title" => __("Agency","premiumpress"),
		
		"desc" => __("Here you can manually set the agency ID which belongs to this user. They will then be able to edit the agency details via their members area.","premiumpress")."<br><br><a href='edit-tags.php?taxonomy=store&post_type=listing_type'>View All Agencies</a>",
		
	 	"hide" => 1,
		"adminonly" => 1,
		"fields" => array(
		 
			"storeid" => array(			
				"title" => __("Agency ID","premiumpress"),
				"type" => "text", 
			),
		),
	),
	
	"admin" => array(	
		
		"title" => __("Admin Fields","premiumpress"),
		
		"desc" => __("System fields used to store additional data about the user.","premiumpress"),
		
		"hide" => 1,
		"adminonly" => 1,
		"fields" => array(
		
			
				
			"ppt_customtext" => array(			
				"title" => __("Account Notice","premiumpress"),
				"type" => "textarea",
			),
			
			"login_lastdate" => array(			
				"title" => __("Last Login","premiumpress"),
				"type" => "date",
			),
			"login_count" => array(			
				"title" => __("Login Count","premiumpress"),
				"type" => "text",
			),
			"login_ip" => array(			
				"title" => __("Login IP","premiumpress"),
				"type" => "text",
			),

				
		
		),
	),

	
	"membership" => array(	
		
		"title" => __("Membership","premiumpress"),
		
		"desc" => __("User membership level and access.","premiumpress"),
		
		"adminonly" => 1,
		"hide" => 1,
		"fields" => array(
		
			"membership" => array(				
				"title" => __("Membership","premiumpress"),
				"type" => "membership",
			),
 
		),
	),
	
	"paywall" => array(	
		
		"title" => __("Paywall","premiumpress"),
		
		"desc" => __("User membership and access.","premiumpress"),
		
		"adminonly" => 1,
		"hide" => 1,
		"fields" => array(
		
			"paywall" => array(				
				"title" => __("Membership","premiumpress"),
				"type" => "paywall",
			),
 
		),
	),
	
	
 
	"boost" => array(	
		
		"title" => __("Account Boost","premiumpress"),
		
		"desc" => __("This is used with the boost account upgrade.","premiumpress"),
		
		"adminonly" => 1,
		"hide" => 1,
		"fields" => array(
		
			"boost" => array(			
				"title" => __("Boost Enabled","premiumpress"),
				"type" => "boost",
			),
			
			"boost_start" => array(			
				"title" => __("Boost Started","premiumpress"),
				"type" => "boost_start",
			),
			
			"boost_end" => array(			
				"title" => __("Boost End","premiumpress"),
				"type" => "boost_end",
			),
		
		),
	),
	
	
		"deleteaccount" => array(	
		
		"title" => __("Delete Account","premiumpress"),
		"hide" => 1,
		"fields" => array(
		
			"deleteaccount" => array(
				
				"title" => "",
				"type" => "deleteaccount",
			),
		 
			 
		),
	),
		
	
	
	);
	
	
	if(in_array(THEME_KEY , array("da","es")) ){ 
	
	unset($fields['avatar']);
	unset($fields['about']);
	unset($fields['background']);
	
	}
	
	if(!in_array(THEME_KEY , array("es")) ){ 
	unset($fields['store']);
	}
	
	if(in_array(THEME_KEY , array("cp","cb")) ){ 
	 
	unset($fields['about']);
	unset($fields['background']);
	
	}
	
	
	if(_ppt(array('mem','enable')) != "1"){
	unset($fields['membership']);
	}
	
	
	if(_ppt(array('paywall','enable')) != "1"){
	unset($fields['paywall']);
	}
	
	if(in_array(THEME_KEY , array("sp")) ){ 
	
	unset($fields['avatar']);
	unset($fields['about']['fields']['url']);
	
	$fields['about']['title'] = __("User Notes","premiumpress");
	$fields['about']['fields']['description']['title'] = __("User Notes","premiumpress");
	
	unset($fields['background']);
	unset($fields['preferences']);
	}
	
	return $fields;
	
	

}




/*

FUNCTION LIST
1. user_posts()

*/
use Hybridauth\Hybridauth; 


class framework_user extends framework_addlisting {

 
 
function USER($action='add', $order_data = ""){
	
	global $userdata, $wpdb, $CORE;
	 
		switch($action){
		
		case "paywall_data": {
		 	
			
			$default = array( 
						"date_start" 	=> "", 
						"date_expires" 	=> "",	
						"approved" 		=> 1,				
			);
			
			$m = get_user_meta($order_data, 'ppt_paywall', true); 
					  
			if( is_array($m) && !empty($m) ){ 
				
				$default = $m;
												 
			}						
			
			return $default;
		
		
		} break;
		
		
		case "paywall_active": {
		
		
				// IS THE ADMIN
				if( _ppt(array('paywall','enable')) != "1" || user_can($userdata->ID, 'administrator') ){
				return 1;
				} 
		 
					$m = get_user_meta($order_data, 'ppt_paywall', true); 
					  
					if(is_array($m)){
					
						$da = $CORE->date_timediff($m['date_expires'],'');
            			if($da['expired'] == 0){
						
							return 1;
						
						}elseif($da['expired'] == 1){ 
							
							// DELETE KEY
							//delete_user_meta($order_data,'ppt_paywall'); 
						
						}
												 
					}						
			
			return 0; 
		
		
		} break;
		
 
		
case "count_cashback": {
	
	$count = 0;
	
	if($userdata->ID){
			
			$data = get_user_meta($userdata->ID,'cashback_array',true);
			
			if(!is_array($data)){ $data = array(); }
			
			$count = count($data); 
			
	}
	
	return $count;
} break;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		case "cashback_fields": {
		
			$fields = array(
				
				"cashback_userid"	=> array(		
						"name" => __("User ID","premiumpress"),		
						"default" => "",
						"type" => "text",
						"css" => "",						
				),
				
				"cashback_pid"	=> array(		
						"name" => __("Post ID","premiumpress"),		
						"default" => "",
						"type" => "text",
						"css" => "",						
				),
				
				"cashback_total"	=> array(		
						"name" => __("Cashback Total","premiumpress"),		
						"default" => "",
						"type" => "price",
						"css" => "",						
				),
				
				"cashback_file"	=> array(		
						"name" => __("Proof Of Purchase","premiumpress"),		
						"default" => "",
						"type" => "file",
						"css" => "",						
				),
				
				"cashback_status"  => array(
				
						"name" 	=> __("Status","premiumpress"),
						"values" => array(

							"0" => array("id" => "0", "name" => __("Pending Upload","premiumpress") ),							
							"1" => array("id" => "1", "name" => __("Pending","premiumpress") ),
							"2" => array("id" => "2", "name" => __("Rejected","premiumpress") ),
							"3" => array("id" => "3", "name" => __("Expired","premiumpress") ),
							"4" => array("id" => "4", "name" => __("Approved","premiumpress") ),
							
							
						),
						"type" => "select",						
						"default" => "0",
						
				),
				
				"cashback_notes"	=> array(		
						"name" => __("Admin notes","premiumpress"),		
						"default" => "",
						"type" => "textarea",
						"css" => "",						
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
	
		
	case "save": {


$pd = $order_data; // POST DATA
if(empty($pd)){ return; }

 
// VALIDATE
if ( !is_email( $pd['email'] ) ) {
return __("Invalid Email Address","premiumpress");
die();
}	

 
// USER BASICS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$data = array();
if(is_admin() && isset($pd['edituserid'])){
$data['ID'] 				= $pd['edituserid'];
$data['display_name'] 		= strip_tags($pd['display_name']);
$data['user_login'] 		= strip_tags($pd['user_login']);  
}else{
$data['ID'] 				= $userdata->ID;
$data['display_name'] 		= $userdata->display_name;
$data['user_login'] 		= $userdata->user_login; 
} 

$data['user_email'] 		= strip_tags($pd['email']);
$data['first_name'] 		= strip_tags($pd['first_name']);
$data['last_name'] 			= strip_tags($pd['last_name']);

if(!isset($pd['description'])){ $pd['description'] = ""; }
$data['description'] 		= strip_tags($pd['description']);

if($data['user_login'] == ""){ $data['user_login'] = $data['user_email']; } 

 
// CHECK FOR USERNAME CHANGE
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(isset($pd['usernamechange']) && $pd['usernamechange'] == 1){
			
	// SAVE OLD USERNAME
	update_user_meta($userdata->ID, 'old_username', $userdata->user_login);
				
	// SET NEW USER LOGIN
	//$data['user_login'] 		= $pd['newusername'];
				
	//

}
 
if(isset($pd['display_name']) && strlen($pd['display_name']) > 2 && (is_admin() || ppt_theme_badwordlist($pd['display_name'], 1) != "1") ){
 	
	$data['display_name'] 		= strip_tags($pd['display_name']);
	$wpdb->query("UPDATE ".$wpdb->prefix."users SET display_name = '".trim(strip_tags($data['display_name']))."' WHERE ID = (".$data['ID'].") LIMIT 1"); 
 

}

// CHECK FOR PASSSWORD CHANGE
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if($data['ID'] == 0){ //is_admin() && 

	if($pd['password'] == ""){ $pd['password'] = "password"; }
	
	
	$user_id = wp_create_user($data['user_login'], $pd['password'], $data['user_email'] );
	
	if( is_wp_error( $user_id ) ) {			
		return $user_id->get_error_message();
		die();			
	} 
	
	$data['ID'] 				= $user_id;
	
	 
}
 
// PASSWORD CHANGE
if( !defined('WLT_DEMOMODE') && ( isset($pd['password']) && strlen($pd['password']) > 6 && ( $pd['password'] == $pd['password_r'] ) ) ){
		$data['user_pass'] 		= $pd['password'];		
}		

// UPDATE BASIC USER DSTA
$saveme = wp_update_user( $data ); 
if ( is_wp_error($saveme) ) {
	return $saveme->get_error_message();
	die();	
}	
 
 

// GET VALID FIELDS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$fields_valid = array();
$fields = ppt_user_fields();
foreach($fields as $k => $v){
	if(isset($v['fields'])){
    	foreach($v['fields'] as $fk => $f){	
			$fields_valid[$fk] = $fk;
		}
	}
}
$regfields = get_option("regfields"); 
 	
if(is_array($regfields) && !empty($regfields['name']) ){ 
	$i=0;  
	foreach($regfields['name'] as $fd){ 
		$nk = trim($regfields['key'][$i]);
		$fields_valid[$nk] = $nk;
		 
		if(isset($pd['custom'][$nk])){
		update_user_meta($data['ID'], $nk, $pd['custom'][$nk]); 
		}
		 
		 
		$i++;
	}
}
 
foreach($pd as $k => $v){
	
	if(in_array($k, $fields_valid)){ 
			
			$val = $pd[$k];
			
			switch($k){
				
				//case "display_name":
				case "username":
				case "password_r":
				case "password":
				case "description":
				case "last_name":
				case "first_name":
				case "email": {
				
				} break;
				default: {
				
					if($val == ""){					
						delete_user_meta($data['ID'], strip_tags($k));
					}elseif(is_array($val)){
						update_user_meta($data['ID'], strip_tags($k), $val);
					}else{	 
						update_user_meta($data['ID'], strip_tags($k), esc_html(strip_tags($val)));					
					} 
				 
				
				} break;
			}	
	}
	
}

// RETURN USER ID
return $data['ID'];

} break;
			

		
		
		case "boost_get_user_posts": {
				
				
				if(isset($GLOBALS['BOOSTED-DATA'])){
				return $GLOBALS['BOOSTED-DATA'];
				}
				// CHECK EXISTS
				$postIDS = array();
				$SQL = "SELECT * FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'upgrade_boost' ";
				$user = array();
				$last_posts = (array)$wpdb->get_results($SQL);	 
				foreach($last_posts as $value){				
 
						$boostData = get_user_meta($value->user_id, 'upgrade_boost', true);
						if(is_array($boostData) && !empty($boostData)){
							$BoostEnds 	= $boostData['end'];
							$BoostStart = $boostData['start'];	
							$hh 		= $CORE->date_timediff($BoostEnds,$BoostStart);
							if($hh['expired'] == 0){
							 
								
								// GET ALL LISTS BY THIS USER
								$allUserPosts = $CORE->PACKAGE("get_user_listing_ids_published",$value->user_id); 
								if(is_array($allUserPosts) && !empty($allUserPosts)){
									$limit = 1; $k = 0;
									foreach($allUserPosts as $p){
										if($k == $limit){ continue; }
										
										if(THEME_KEY == "at" && $CORE->PACKAGE("has_expired", $p) == "1" ){								
											continue;
										}
										
										$postIDS[$p] = $p;
										$k++;
									}
								}							
							}						
						} 		
				}
			
			$GLOBALS['BOOSTED-DATA'] = $postIDS;
				
			return $postIDS;	
		
		
		} break;
		
		
		case "account_dash_order": {
		
			update_user_meta($userdata->ID, "dash_order", $order_data);
		
		} break;
		
		
		case "count_user_listings": {
		
			$my_listings = array(
			'publish' => 0,'pending' => 0,'pending_approval' => 0,'payment' => 0,'expired' => 0, "total" => 0
			);
			// USER LISTINGS
			$args = array(
					'post_type' 		=> 'listing_type',
					'posts_per_page' 	=> 200,
					'paged' 			=> 1,
					'author'			=> $order_data,
					'post_status' 		=> array('publish','pending','pending_approval','payment','expired'), //,'trash'
			 );
			 
			 
			$wp_query1 = new WP_Query($args); 
			$lists = $wpdb->get_results($wp_query1->request, OBJECT);
			
			if(is_array($lists) && !empty($lists)){
				foreach($lists as $list){	
					
					$status = get_post_status($list->ID);
					 
					if(isset($my_listings[$status])){
						$my_listings[$status] = $my_listings[$status] + 1;
						$my_listings["total"] = $my_listings["total"] + 1;
					} 
				}
			}
			
			return $my_listings;
		
		
		} break;
		
		
		case "new_users": {
		
			$users = array();
			$args = array('role' => 'subscriber', 'number' => $order_data );
			$args = array_merge($args, 			
				array( 'meta_query' => array (
				
					'relation'    => 'AND',	
					
							array( 	 
							'userphoto'    => array(
								'key' 			=> 'userphoto',								 
								'value' 		=> '',
								'compare' 		=> '!=',								 			
							),			 
							 						
						),			
				), )  );
				
		$query1 = new WP_User_Query($args); 
		$editors = $query1->get_results(); 
 
		if ( ! empty( $editors ) ) { 
			
			foreach ( $editors as $editor ) {
			
				$users[] = $editor->data;
			
			}
		
		}
		return $users;
		
		} break;
		
 
		
case "hasaccess_special_vdeoaccess": { 

		 
		if(is_array($order_data)){
			$pid = $order_data[0];
			$returnfo = $order_data[1];
		}else{
			$pid = $order_data;
		}
		
		 
		// OWN POST
		if(get_post_field ('post_author', $pid) == $userdata->ID){
		return 1;
		}
		
		// GET ALL ACCESS FIRST
		$allAccessOptions = array(
			"" 			=> __("Everyone","premiumpress"),
			"loggedin" 	=> __("Members Only","premiumpress"),		
			"subs" 		=> __("Members With Subscriptions","premiumpress"), 
		);
		
		// GET ALL MEMBERSHIPS
		if(_ppt(array('mem','enable')) == "1"){		
			$all_memberships = $CORE->USER("get_memberships", array());
			foreach($all_memberships  as $key => $m){
				$allAccessOptions[$m['key']] = $m['name'];
			} 		
		}
		
		// NOW CHECK AGAINST ALL ACCESS
		$pageAccess = array();
		$value = get_post_meta($pid,'videoaccess',true);
		// QUICK CHECKS
		if($value == "" ){
			$myAccess[""]						= $allAccessOptions[""];
		}
		if(!empty($value) && is_array($value) ){
			foreach($value as $v){
				
				if($v == "9999"){ // no acces
				
				}else{
					$pageAccess[$v] = $allAccessOptions[$v];
				}
				
			
			} 
		}
		 
		
		// CHECK MY ACCESS
		$myAccess = array(); 
		$myAccess[""]						= $allAccessOptions[""];
		if($userdata->ID){
		$myAccess["loggedin"]				= $allAccessOptions["loggedin"];
		}
		if($userdata->ID){		
			$mymem = $CORE->USER("get_user_membership", $userdata->ID);	
			 
		 
			if(isset($mymem['key']) && $mymem['expired'] == "0" && $mymem['user_approved'] == "1"){
				
				$myAccess["subs"]			= $allAccessOptions["subs"];
				$myAccess[$mymem['key']] 	= $allAccessOptions[$mymem['key']];
			}					 		
		}
		
		
		if(isset($returnfo) && $returnfo == 1){
		return  $allAccessOptions;
		}
		if(isset($returnfo) && $returnfo == 2){
		return  $pageAccess;
		}
		if(isset($returnfo) && $returnfo == 3){
		return  $myAccess;
		}
		//print_r($allAccessOptions);
		//print_r($pageAccess);
		//print_r($myAccess);
		
		// CHECK MY ACCES IS IN PAGE ACCESS
		 foreach($pageAccess as $key => $name){
		 
			 if(isset($myAccess[$key])){
			 	
				return 1;
				// echo "access granted for ".$key."<br>";
			 
			 }		 
		 } 		 
		 
		return 0;
		
} break;	
		
		
		
		
		
		
		
		case "hasaccess_images": { 
			
			// GET PASS
			$mypass = get_post_meta($order_data, "image_pass", true);
			
			if(strlen($mypass) < 2){
			return 1; // yes they have access, no pass
			}
			
			// not logged in and password set above
			if(!$userdata->ID){
			return 0; // no acccess
			}
			 
			$data = get_post_meta($order_data,'image_access_array', true);
			if(!is_array($data)){
			return 0; // no acccess
			}
			
			foreach($data as $u => $d){
				if($u == $userdata->ID && isset($d['pass']) && $d['pass'] == $mypass){
					return 1;
				}
			} 
			
			return 0; // no access
		
		} break;
		
		
case "membership_features_list": {
 
	membership_plan_features($order_data); 

} break;

case "membership_features_list_full": {
 
	membership_plan_features_full(); 

} break;

case "count_orders_per_membership": {
			
			$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND mt1.meta_key = 'order_id' AND mt1.meta_value LIKE ('%mem".$order_data."%') )
			WHERE ".$wpdb->prefix."posts.post_type = 'ppt_orders'";	
		 	 			 
			$result = $wpdb->get_results($SQL);
			
			if(isset($result[0])){
			return $result[0]->total;		
			}			
			
			return 0;	 
		
		} break;
	
		case "count_users_per_membership": {
		
			 
			$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."users 
			INNER JOIN ".$wpdb->prefix."usermeta AS mt1 ON (".$wpdb->prefix."users.ID = mt1.user_id AND mt1.meta_key = 'ppt_subscription_key' AND mt1.meta_value = '".$order_data."' ) ";	
		 	 			 
			$result = $wpdb->get_results($SQL);
			
			if(isset($result[0])){
			return $result[0]->total;		
			}			
			
			return 0; 
		
		} break;
		 

			case "update_gifts": {
			
				// POST ID
				$USER_ID 	= $order_data[0];
				$FROM_ID 	= $order_data[1];	
				$GIFTID		= $order_data[2];
				
				// HITS ARRAy
				$data = get_user_meta($USER_ID,'gifts_array',true);
				 
				if(!is_array($data)){ $data = array(); }
				
				// GET DATE			  
				$date_now = date('Y-m-d'); 
				
				// update
				$data[$date_now] = array("date" => $date_now, "gift_id" => $GIFTID, "from_id" => $FROM_ID  );
				 		 
				// SAVE			
				update_user_meta($USER_ID,'gifts_array',$data);	
				  
			
			} break;

			case "set_offline_listings": {
			
				if( defined('THEME_KEY') && in_array(THEME_KEY,  array("da","es","ct","mj") ) ){ 				
				
					$SQL = "SELECT ID FROM ".$wpdb->base_prefix."posts WHERE post_author = '".$order_data."' AND post_type = 'listing_type' AND post_status = 'publish'  LIMIT 100";							 			 
					$ores = $wpdb->get_results($SQL);			
					if(!empty($ores)){
						foreach($ores as $row){
						 
							delete_post_meta($row->ID,"online");			
						 
						}					
					}
				}
			
			} break;
			
			
			case "set_online_listings": {
			
				if( defined('THEME_KEY') && in_array(THEME_KEY,  array("da","es","ct","mj") ) ){ 
				
				
					$SQL = "SELECT ID FROM ".$wpdb->base_prefix."posts WHERE post_author = '".$order_data."' AND post_type = 'listing_type' AND post_status = 'publish'  LIMIT 100";			 			 
					$ores = $wpdb->get_results($SQL);			
					if(!empty($ores)){
						foreach($ores as $row){
						 
							update_post_meta($row->ID,"online",  date('Y-m-d H:i:s'));			
						 
						}					
					}
				}
			
			} break;
		
			
			case "smiles": {
			
			return array("angel","angry","cap","clown","confused","cool","crying","cyber","depression","dislike","eyeglass","gay", "geek","happy","humor","kiss","laughing","like","love","money","mustache","punk","robot","security","sleepi","smarth","smile","star","sunglass","sunglass_2","sunglass_3","suprise","tounge","wink");
			
			} break;
			

			case "get_account_type_all": {
				 
				
				$data = array(
						
						"banned" => array(
								"name" 		=> __("Banned","premiumpress"), 
								"desc" 		=> __("This user has no access to account features.","premiumpress"), 
								"icon" 		=> "fa fa-user-slash",
								
								"privileges" => array(
								
									"single" 	=> 0,
									"multiple"	=> 0,
									"sellspace"	=> 0,
									"view_ads" => 0,
								), 
							),
							
							
					"visitor" => array(
								"name" 		=> __("Visitor","premiumpress"), 
								"desc" 		=> __("This user has not registered.","premiumpress"), 
								"icon" 		=> "fa fa-user-circle",
								
								"privileges" => array(
								
									"single" 	=> 1,
									"multiple"	=> 0,
									"sellspace"	=> 0,
									"view_ads" => 1,
								), 
					),
					
						"subscriber" => array(
								"name" 		=> __("Guest","premiumpress"), 
								"desc" 		=> __("Typically this user has registered but not created any ads.","premiumpress"), 
								"icon" 		=> "fa fa-user-clock",
								
								"privileges" => array(
								
									"single" 	=> 1,
									"multiple"	=> 1,
									"sellspace"	=> 1,
									"view_ads" => 1,
								), 
							),
							
							"member" => array(
								"name" => __("Member","premiumpress"), 
								"desc" => __("Typically this user has registered and created a single ad.","premiumpress"), 
								"icon" 		=> "fa fa-user",
								
								"privileges" => array(
								
									"single" 	=> 1,
									"multiple"	=> 1,
									"sellspace"	=> 1,
									"view_ads" => 1,
								),
								  
							),
							
							"agency" => array(
								"name" => __("Agency","premiumpress"), 
								"desc" => __("Typically this user has registered and created multiple ads.","premiumpress"), 
								"icon" 		=> "fa fa-user-crown",
								
								"privileges" => array(
								
									"single" 	=> 1,
									"multiple"	=> 1,
									"sellspace"	=> 1,
									"view_ads" => 1,
								),
								  
							),							
							
					);
					
					
					// CUSTOM TEXT
					if(strlen(_ppt(array('usertype','subscriber_name'))) > 2){
						$data["subscriber"]["name"] 	= _ppt(array('usertype','subscriber_name'));
					}
					if(strlen(_ppt(array('usertype','member_name'))) > 2){
						$data["member"]["name"] 	= _ppt(array('usertype','member_name'));
					}
					if(strlen(_ppt(array('usertype','agency_name'))) > 2){
						$data["agency"]["name"] 	= _ppt(array('usertype','agency_name'));
					}					
					
					if(THEME_KEY == "es"){ 
					
						$data["subscriber"]["name"] =__("Member","premiumpress");
						$data["member"]["name"] 	= __("Escort","premiumpress");
						$data["agency"]["name"] 	= __("Agency","premiumpress");
						
						$data["member"]["privileges"]["multiple"] = 0;
					 
					 }elseif(THEME_KEY == "jb"){ 
					
						$data["subscriber"]["name"] =__("Employee","premiumpress");
						$data["member"]["name"] 	= __("Employer","premiumpress");
						$data["agency"]["name"] 	= __("Employer","premiumpress");
						 
					}elseif(THEME_KEY == "vt"){ 
					
						$data["agency"]["name"] 	= __("Member","premiumpress");
					 
					}elseif(THEME_KEY == "da"){ 
					
						$data["subscriber"]["privileges"]["multiple"] = 0;
						$data["member"]["privileges"]["multiple"] = 0;
						$data["agency"]["privileges"]["multiple"] = 0;
					
					}
					
					 
			
				return $data;
			
			} break;			
			case "get_account_type": {
				
		
				$act = $CORE->USER("get_account_type_all", array());
				
				$user_privilages = array( 
					"name" 				=> __("Member","premiumpress"),   
					"key" 				=> "member",  
					"can_add" 			=> 1,
					"can_add_multiple" 	=> 1,
					"can_sellspace" 	=> 1,
					"can_view_ads"		=> 0,
				);	
				
				$mtype = "subscriber";
				
				if(!$userdata->ID){
					$mtype = "visitor";
				}
				
				
				// UPDATE USER TYPE BASED ON
				// ACTIVITY ON THE WEBSITE
				if($userdata->ID){
				
					$activeListings = $CORE->USER("count_listings_all", $userdata->ID);
					if($activeListings > 0 ){
						
						if($activeListings == 1){
						$mtype = "member";
						}else{
						$mtype = "agency";
						}									
					}					
					
					// ADMIN OVERRIDE
					$admin_override = get_user_meta($userdata->ID,'user_type',true);
					if(isset($act[$admin_override])){
					$mtype = $admin_override;
					}				
				}
				
				
				 	 
				// NAME
				if(isset($act[$mtype])){
				
					$name = $act[$mtype]['name'];					
					if(_ppt(array("usertype",$mtype."_name" )) != ""){
						$name = _ppt(array("usertype",$mtype."_name" ));				
					} 
					
					$can_add = _ppt(array("usertype",$mtype."_single" )); 
					if($can_add == ""){
					$can_add = $act[$mtype]['privileges']['single']; 
					}
					
					$can_addm = _ppt(array("usertype",$mtype."_multiple" )); 
					if($can_addm == ""){
					$can_addm = $act[$mtype]['privileges']['multiple']; 
					}
					
					$can_sellspace = _ppt(array("usertype",$mtype."_sellspace" )); 
					if($can_sellspace == ""){
					$can_sellspace = $act[$mtype]['privileges']['sellspace']; 
					}
					
					$can_view_ads = _ppt(array("usertype",$mtype."_view_ads" )); 
					if($can_view_ads == ""){
					$can_view_ads = $act[$mtype]['privileges']['view_ads']; 
					}
					
					$user_privilages['key'] 				=  $mtype;
					$user_privilages['name'] 				=  $name;
					$user_privilages['can_add']				= $can_add;
					$user_privilages['can_add_multiple']	= $can_addm;		
					$user_privilages['can_sellspace']		= $can_sellspace;	
					
					$user_privilages['can_view_ads']		= $can_view_ads;	
					
				}
				
				
				
				
				// LOGIN COUNT
				$lc = 0;
				if($userdata->ID){
					$lc = get_user_meta($userdata->ID, "login_count", true);
					if(!is_numeric($lc)){
					$lc = 0;
					}
				}
				
				$user_privilages['count_login']		= $lc;	
				
				if(in_array(THEME_KEY,array("sp","cm")) ){
				$user_privilages['can_add'] = 0;
				$user_privilages['can_add_multiple'] = 0;
				}
				
			
				return $user_privilages;
			
			} break;
		
			case "get_message_link":{ global $post;
				 
				
				if($userdata->ID){
				 
					if(_ppt(array('mem','enable')) == "1" && ( !$CORE->USER("membership_hasaccess", "msg_send") && !$CORE->USER("membership_hasaccess", "max_msg") ) ){  
		   
						return 'href="'._ppt(array('links','myaccount')).'/?tab=membership"';
		   
					}else{
					
						if(isset($GLOBALS['flag-single'])){
						
						global $post;
						
							return 'href="javascript:void(0);" onclick="processMessageSingle('.$order_data.','.$post->ID.');"';
						
						}else{
						
							return 'href="javascript:void(0);" onclick="processMessage('.$order_data.');"';
						
						} 
										
					}
				
				}elseif(!$userdata->ID && in_array(THEME_KEY,array("dt","rt","at")) && !in_array(_ppt(array('user','messages_login_required')), array("1")) ){
				
				
				 return 'href="javascript:void(0)" onclick="contactformshow('.$post->ID.');"';
				   
				}else{
					
					return 'href="javascript:void(0);" onclick="processLogin(1);"';
				
				}			 			
			
			} break;
		
			case "get_membership_continue_button": {
		
				$k = $order_data;
				 
                
					if($userdata->ID){
                    
                    	$btn =  $CORE->order_encode(array(  					               
						   "uid" 					=> $userdata->ID,                
						   "amount" 				=> _ppt('mem'.$k.'_price'), 
						   "order_id" 				=> "SUBS-mem".$k."-".$userdata->ID."-".rand(),                 
						   "description" 			=> _ppt('mem'.$k.'_name'),
						   "recurring" 				=> _ppt('mem'.$k.'_r'),    
						   "recurring_days" 		=> _ppt('mem'.$k.'_duration'),            
						   "couponcode" 			=> "", 	
						   				                 
					   	));
									
						$button = 'href="javascript:void(0);" onclick="processNewPayment(\''.$btn.'\');"';
									 
					}else{ 
									
						$button = 'href="javascript:void(0)" onclick="processLogin(0, \'mem'.$k.'\');"';
									
					} 
				 
				
				return $button;
			
			} break;
		
		 
			case "get_user_count_likes": {			
				
				$total = 0;
			 
				$SQL = "SELECT ID FROM ".$wpdb->base_prefix."posts WHERE post_author = '".$order_data."' AND post_type = 'listing_type' AND post_status = 'publish'  LIMIT 100";			 			 
				$ores = $wpdb->get_results($SQL);			
				if(!empty($ores)){
					foreach($ores as $row){					 
						$total = $total + $CORE->USER("get_likes_count", $row->ID);		
					}				
				}				
				return $total;	
						
			} break; 
			
			 
			
			case "get_user_revenue": { 

				return 0;
 			
			}
			
		 
			
			case "update_user_free_membership_addon": {
			
				// MAKE SURE ITS EANBELD
				if(_ppt(array('mem','enable')) != 1){ return; }
				 
				
				// LISTINGS
				if($order_data[0] == "listings" && $CORE->USER("membership_hasaccess", "listings") ){
				
					$c = get_user_meta($order_data[1], "free_listings_count", true);
					 
					if(is_numeric($c)){ 
						
						update_user_meta($order_data[1], "free_listings_count", ($c-1));
					}
					
				/*}elseif($order_data[0] == "listings_max" && $CORE->USER("membership_hasaccess", "listings_max")  ){
				
					$c = get_user_meta($order_data[1], "free_listings_max_count", true);
					 
					if(is_numeric($c)){
						
						update_user_meta($order_data[1], "free_listings_max_count", ($c-1));
					}
				*/	
				}elseif($order_data[0] == "max_msg"  ){ 
				
					$c = get_user_meta($order_data[1], "max_msg_count", true);
					 
					if(is_numeric($c)){
						
						update_user_meta($order_data[1], "max_msg_count", ($c-1));
					}	
					
					if(($c-1) < 1){
					return false;
					}
					
				}elseif($order_data[0] == "downloadsxxxxxxxxxxxxxx"){
				
						 
				 
					// CHECK IF DOWNLOAD HAS BEEN DONE BEFORE
					$order_key_id = $this->ORDER("check_exists", "FREE-".$order_data[2] );
					if( !is_numeric($order_key_id) ){
					
						// 3. ADD NEW ORDER/INVOICE
						$ex = $CORE->ORDER("add", array( 
							"order_id" 			=> "FREE-".$order_data[2],
							"order_status" 		=> 1, // pending
							"order_total" 		=> 0,
							"order_userid" 		=> $order_data[1],
							"order_postid" 		=> $order_data[2],						
							"order_description" => __("Free credit download","premiumpress"),
							
						) ); 
						 
				
						$c = get_user_meta($order_data[1], "free_downloads_count", true);						 
						if(is_numeric($c)){
							$c = $c - 1;
							update_user_meta($order_data[1], "free_downloads_count", $c);
						} 
						$c = get_user_meta($order_data[1], "free_downloads_count", true);
						
						
										
					}
					
				
				}
				
				return true;
			
			
			} break;
			
			case "get_user_free_membership_addon": {
			
				if(!isset($order_data[1])){ return 0; } 
				
				// RETURN 1 IF MEMBERSHIPS ARE DISABLED
				if(_ppt(array('mem','enable')) != 1){ return 9999; }
				
				$c = 0;
				
				// GET CURRENT MEMBERSHIP
				$mymmem = $this->USER("get_user_membership", $order_data[1]);				 
			 
				if($order_data[0] == "listings"){
				
					// GET COUNT FROM USER PROFILE
					$c = get_user_meta($order_data[1], "free_listings_count", true);
					 
					  
					// ASSUME SICEN NOTHING WAS FOUND
					// THAT THEY DIDNT GET ADDED
					if(!is_numeric($c) || $c < 0){
					
						$c = _ppt('mem'.$mymmem['key'].'_listings_count');
						if(!is_numeric($c)){ $c = 0; }
						
						update_user_meta($order_data[1], "free_listings_count", $c);
					
					}
					
					return $c;
				
				
				}elseif($order_data[0] == "listings_max"){
				
					// GET COUNT FROM USER PROFILE
					$c = get_user_meta($order_data[1], "free_listings_max_count", true);
					   
					// ASSUME SICEN NOTHING WAS FOUND
					// THAT THEY DIDNT GET ADDED
					if(!is_numeric($c) ){
					
						$c = _ppt('mem'.$mymmem['key'].'_listings_max_count');
						if(!is_numeric($c)){ $c = 0; }
						
						update_user_meta($order_data[1], "free_listings_max_count", $c);
					
					}
					
					return $c;
					
				}elseif($order_data[0] == "max_msg"){
				
					// GET COUNT FROM USER PROFILE
					$c = get_user_meta($order_data[1], "max_msg_count", true);
					   
					// ASSUME SICEN NOTHING WAS FOUND
					// THAT THEY DIDNT GET ADDED
					if(!is_numeric($c) ){
					
						$c = _ppt('mem'.$mymmem['key'].'_max_msg_count');
						if(!is_numeric($c)){ $c = 0; }
						
						update_user_meta($order_data[1], "max_msg_count", $c);
					
					}
					
					if($c < 1){
					$c = 0;
					}
					
					return $c;
				
				}elseif($order_data[0] == "downloadsxxxxxxxxxxxxxxxxxxxxx"){
				
				 
					// GET COUNT FROM USER PROFILE
					$c = get_user_meta($order_data[1], "free_downloads_count", true);
					
					// ASSUME SICEN NOTHING WAS FOUND
					// THAT THEY DIDNT GET ADDED
					
					// CHECK IT'S ENABLED
					if(isset($mymmem['key']) && _ppt('mem'.$mymmem['key'].'_downloads_hide') == "1"){
					return 100; // disabled so allow acces
					}
					
					if(!is_numeric($c) && isset($mymmem['key']) ){
					
						$c = _ppt('mem'.$mymmem['key'].'_downloads_count');
						if(!is_numeric($c)){ $c = 0; }
						
						update_user_meta($order_data[1], "free_downloads_count", $c);
					
					}
				
					return $c;
				
				}
			
			
			} break;
			
			
		
			case "check_identifier_exists": {
			
				
				if($order_data == ""){ return false; }
			
				// FIND OUT WHICH USERS HAVE ADDED ME TO THEIR LIST
				$my_list = array();
				
				$SQL = "SELECT user_id FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'sociallogin_identifier' AND meta_value LIKE '%\"".$order_data."\"%'  LIMIT 1 ";					 
				$result = $wpdb->get_results($SQL);
				if(empty($result)){ 
				
					return false;
				}			
			
				return array(
				
				"user_id" => $result[0]->ID,
				"user_email" => $CORE->USER("get_email", $result[0]->ID),
				
				);
			
			} break;
			
			case "get_this_membership": {
			
			 
				$all_memberships = $CORE->USER("get_memberships", array()); 
				foreach($all_memberships  as $key => $m){
				
					if($m['key'] == $order_data || "mem".$m['key'] == $order_data  ){
						return $m;
					} 
				
				} 
				
				return array();
			
			} break;
		
			case "get_memberships": { 
			 
				// CHECK FOR CURRENT PLAN
				$dontshowkey = "";
				/*
				if($userdata->ID && !isset($GLOBALS['SHOWALLMEMS'])){		
				 
					$cm			= get_user_meta($userdata->ID,'ppt_subscription'); 
					if(is_array($cm) && isset($cm[0]) && _ppt($cm[0]['key'].'_repurchase') == "0" && !is_admin() ){
					 
					 $dontshowkey = $cm[0]['key'];					 
					 
					}					
				
				}*/		
				
								
			
				// 0 = free
				// 1 = featured
				// 2 = sponsored
				
				 				
				
				$i = 1; $list = array(); 
				while($i < 11){		 	 
					
					// ENABLED
					if(  _ppt('mem'.$i.'_enable') == 0){ 
						$i++; continue;
				  	}
					
					// HIDDEN
					if( ( isset($GLOBALS['flag-memberships']) || isset($GLOBALS['flag-login']) || isset($GLOBALS['flag-register']) || isset($GLOBALS['flag-upgrade-memberships']) ) && _ppt('mem'.$i.'_hideme') == 1){ 
						$i++; continue;
				  	}
									
					// NAME
					if(_ppt('mem'.$i.'_name') == ""){					
						$i++; continue;					
					}else{
						$name = _ppt('mem'.$i.'_name');
					}
					
					// PRICE
					if(_ppt('mem'.$i.'_price') == ""){
					$price = 0;
					}else{
					$price = _ppt('mem'.$i.'_price');
											
						// CONVERT TO LOCAL PRICE AMOUNT
						$price = hook_price(array($price, 0));
						
						// REMOVE COMMA
						$price = str_replace(",","",$price);					
					
					}
					
					// DURATION
					if(_ppt('mem'.$i.'_duration') == ""){
					$duration = 0;
					}else{
					$duration = _ppt('mem'.$i.'_duration');
					}
					
					// RECURRING
					if( _ppt('mem'.$i.'_r') == 1){
					$recurring = 1;
					}else{
					$recurring = 0;
					}
					
					// WORK OUR PRICE
					if( _ppt('mem'.$i.'_price') == 0){       
						 $price_txt = __("FREE","premiumpress");  
					}else{
						  $price_txt = hook_price(_ppt('mem'.$i.'_price'));
					}
					
					// ICONS 
					$icon =  _ppt('mem'.$i.'_icon');
				 
			 		// DAY TEXT
					$daytext = ""; 
					switch($duration){				
						  case "1": {
							  $daytext = "24 ".__("Hours","premiumpress");
						  } break;
						   case "2": {
							  $daytext = "48 ".__("Hours","premiumpress");
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
							  if(is_numeric($duration) && $duration > 0){
							  $daytext = $duration." ".__("Days","premiumpress");
							  }else{
							   $daytext = "";
							  }
						 }
					 }				    
										
					// KEY 
					$key = _ppt('mem'.$i.'_key');
					if(!is_numeric($key)){
						$key = $i;
					}
					
					
					
					// DESC
					$desc = _ppt('mem'.$i.'_desc');	
										 			 
					
					// BUILD					
					$list[$i] = array(					
						"key" 		=> $key,
						"name" 		=> trim(stripslashes($name)),
						"desc" 		=> trim(stripslashes($desc)),
						"icon"		=> $icon,
						"price" 	=> trim($price),
						"price_text" 	=> $price_txt,						
						"duration" 	=> trim($duration),	
						"duration_text" => $daytext,
						"recurring" => $recurring,
						 									
					);
					
					$i++;
				}
				
				return $list;
			
			
			} break;
		
			case "membership_features": {
				
				$features = array();
				
				
					$features = array(	
					
										
						"listings_multiple" => array(
						
							"name" => str_replace("%s", $CORE->LAYOUT("captions","2"), __("Unlimited %s","premiumpress") ), 
							"key" => "listings_multiple",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Allow users to create unlimited %s. If disabled, users have to pay for %s separately.","premiumpress")),
							
							"desc_user" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create as many %s as you want!","premiumpress")),
							
							 					
							"icon" => $CORE->LAYOUT("captions","icon"),
							
							
							"order" => 20,
							"default" => 0,
							"hide_default" => 1,
						),
						
						
						"listings" => array(
							"name" => str_replace("%s", $CORE->LAYOUT("captions","2"),__("Multiple %s (X Number)","premiumpress")), 
							"key" => "listings",
							
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Allow users to create multiple %s where X is number of free %s they can create. Any additional %s will be paid for.","premiumpress")),
							
							"desc_user" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create X number of free %s. Additional %s will be charged at the standard rate.","premiumpress")),
							
							 
							"name_front_end" => str_replace("%s", $CORE->LAYOUT("captions","2"), __("Multiple %s","premiumpress") ),
							"desc_front_end" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create upto %x %s.","premiumpress") ),	
							
													
							"icon" => $CORE->LAYOUT("captions","icon"),
							 
							
							"order" => 21,
							"default" => 0,
							"hide_default" => 1,
						),
						
						
						
						"view_photos" => array(
							"name" => __("Photos","premiumpress"), 
							"key" => "view_photos",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("User can view user photos.","premiumpress")),
							
							"desc_user" => __("View user photos.","premiumpress"),
							
							"order" => 5,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-photos",
						),
							 
					 "view_videos" => array(
							"name" => __("Videos","premiumpress"), 
							"key" => "view_photos",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("User can watch user videos.","premiumpress")),
							
							"desc_user" => __("Watch user videos.","premiumpress"),
							
							"order" => 5,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-photos",
						),
						
							
						"view_music" => array(
							"name" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("Audio Files","premiumpress") ), 
							"key" => "view_music",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("User can listen to music/audio files.","premiumpress")),
							
							"desc_user" => __("Listen to user audio files.","premiumpress"),
							
							"order" => 8,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-music",
						),
						
						
						
						
						"gifts" => array(
							"name" => __("Send Gifts","premiumpress"), 
							"key" => "gifts",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Enable users to send gifts.","premiumpress")),
							
							"desc_user" => __("Send gifts to other users.","premiumpress"),
							
							"order" => 9,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-gifts",
							
						),	
						
						"view_chatroom"  => array(
							"name" => __("Access Chatroom","premiumpress"), 
							"key" => "view_chatroom",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Enable users to access the chatroom page.","premiumpress")),
							
							"desc_user" => __("Access our user chatroom.","premiumpress"),
							
							"order" => 10,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-comment-alt-lines",
							
						),
						
						/*
						"downloads" => array(
							"name" => __("Free Downloads","premiumpress"), 
							"key" => "downloads",
							"desc" => __("This is the number of downloads they receive when they signup or renew this membership.","premiumpress"),
							
							"desc_user" => __("Download upto X files.","premiumpress"),
							
							"order" => 11,
							"default" => 0,
							"hide_default" => 0,
							
							"desc_front_end" =>  __("Download upto %x files.","premiumpress"),
							
							
							"icon" => "fa-cloud-download-alt",
						),
						*/
					
						"liked" => array(
							"name" => __("See Who Likes You","premiumpress"), 
							"key" => "liked",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Enable users to see who's liked their %s.","premiumpress")),
							
							"desc_user" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("See which users have liked your %s","premiumpress")),
							
							"order" => 13,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-book-reader",
						),
						
						
						/*
						14 => array(
							"name" => __("Visitor Charts","premiumpress"), 
							"key" => "visitor_chart",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Enable users to see who's visiited their %s.","premiumpress")),
							"order" => 9,
							"default" => 1,
							"hide_default" => 0,
						),*/
						
						"phone" => array(
							"name" => __("View Phone Number","premiumpress"), 
							"key" => "phone",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Enable users to view the phone number.","premiumpress")),
							
							"desc_user" => __("View phone numbers.","premiumpress"),
							
							"order" => 15,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-phone",
							
						),
						
						
						"msg_send" => array(
							"name" => __("Send Unlimited Messages","premiumpress"), 
							"key" => "msg_send",
							"desc" => __("Enable users to send unlimited messages to other users.","premiumpress"),
							
							"desc_user" => __("Send messages to other users.","premiumpress"),
							
							"order" => 16,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-envelope",
						),						
						
						"max_msg" => array(
							"name" => __("Send Message Limit","premiumpress"), 
							"key" => "max_msg",
							"desc" => __("Limit how many messages this user can send. Will update when their membership renews.","premiumpress"),
							
							"desc_user" => __("Send upto x messages.","premiumpress"),
							
							"order" => 17,
							"default" => 0,
							"hide_default" => 1,
							
							"icon" => "fa-mail-bulk",
							
							"name_front_end" =>  __("Send Messages","premiumpress"),
							
							"desc_front_end" =>  __("Send upto X messages.","premiumpress"),							
							
							
							
						),
						
						"msg_read" => array(
							"name" => __("Read Messages","premiumpress"), 
							"key" => "msg_read",
							"desc" => __("Enable users to read messages.","premiumpress"),
							
							"desc_user" => __("Read messages sent to you by other users.","premiumpress"),
							
							"order" => 18,
							"default" => 1,
							"hide_default" => 0,
							
							"icon" => "fa-envelope-open-text",
						),  
						
						
						
						"adfree" => array(
							"name" => __("Hide Ads","premiumpress"), 
							"key" => "adfree",
							"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Disable the display of the built-in advertising system.","premiumpress")),
							
							"desc_user" => __("Stop seeing third-party website advertisng.","premiumpress"),
							
							
							"order" => 20,
							"default" => 0,
							"hide_default" => 0,
							
							"icon" => "fa-ad",
						),
						
						
						 			
					);
					 
					
					if(_ppt(array('lst','websitepackages')) == "0" || in_array(THEME_KEY, array("da")) ){
						unset($features["listings_multiple"]);		
						unset($features["listings"]);					
					}
					
					if( _ppt(array('user','account_messages')) == "0"){
						unset($features["max_msg"]);
						unset($features["msg_send"]);
					}
					
					// downloads
					if(defined('THEME_KEY') && !in_array(THEME_KEY, array("so","ph"))){
						unset($features["downloads"]);					
					}
					
					// view Phone Number
					if(defined('THEME_KEY') && !in_array(THEME_KEY, array("dt","es"))){	
						unset($features["phone"]);						
					}
					
					// LIKED
					if(defined('THEME_KEY') && !in_array(THEME_KEY, array("da"))){	
							
						unset($features["view_chatroom"]);	 
					}
					 
					
					
					 
					 
					 // LIKED
					 if(defined('THEME_KEY') && !in_array(THEME_KEY, array("da", "es")) ){ 	
					 unset($features["liked"]);
					 }elseif(defined('THEME_KEY') && in_array(THEME_KEY, array("da", "es")) && !in_array(_ppt(array('user', 'likes')), array("", "1")) ){ 	
					 unset($features["liked"]);
					 }
					
					// GIFTS
					if(defined('THEME_KEY') && !in_array(THEME_KEY, array("da", "es"))){
						unset($features["gifts"]);
					}elseif(defined('THEME_KEY') && in_array(THEME_KEY, array("da", "es")) && !in_array(_ppt(array('gifts', 'enable')), array("", "1")) ){ 							
											
					}else{
						unset($features["gifts"]);
					}
					
					// MUSIC
					if( _ppt('audioupload_enable') != "1"){
						unset($features["music"]);
					}  

 
 				// REORDER
				usort($features, 'compare_order'); 
				
				return $features;
			
			} break;
			
			
			case "membership_hasaccess_page": {
			 
						
 	 				// MEMBERSHIPS TURNED OFF
					if(_ppt(array('mem','enable')) == "0"){
							return 1;
					}
					
				
					// GET VIDEO ACCESS
					$value = get_post_meta($order_data,'pageaccess',true);				 										 
					if(!is_array($value) || is_array($value) && empty($value) ){
						return 1;
					} 
					 
					// QUICK CHECKS
					if( $value[0] == "" ){
					return 1;  
					}	
					
					// BUILD USERS ACCESS
					$myaccess = array();
					
					// MEMBER IS LOGGED IN ACCESS
					if(is_array($value)){
						foreach($value as $h){				
							if($h == "loggedin" && !$userdata->ID){ 
							
								return 0;
								
							}elseif($h == "loggedin" && $userdata->ID){ 
							
								return 1;
							}
							
						}
					}				
						
					// MEMBER HAS VALID SUBSCRIPTION
					if($userdata->ID){		
					
						$mymem = $CORE->USER("get_user_membership", $userdata->ID);						
						
						if( isset($mymem['expired']) && $mymem['expired'] == 0 && in_array("subs", $value) ){
						
							return 1;
						}
						 
						if(is_array($value)){
							foreach($value as $h){	
										
								 if(in_array($mymem['key'], $value) ){
								
									return 1;
								
								 }				
							}
						}			
					}
					
				 
					
					return 0;
		
			} break;	
					
			case "membership_user_icon": {
			
				// RETURN 1 IF MEMBERSHIPS NOT ENABLED
				if( !$CORE->LAYOUT("captions","memberships") ){ 
				return "";
				} 	
				
				// DISALED
				if(_ppt(array('mem','enable')) == "0"){
				return "";
				}	
				
				$usermeme = $this->USER("get_user_membership", $order_data);	
					 
				// PENDING APPROVAL
				if(isset($usermeme['user_approved']) && $usermeme['user_approved'] == "0"){
					return "";
				}
				
				if(is_array($usermeme)){
					 
						if(_ppt($usermeme['key'].'_badge') == "1" && strlen(_ppt($usermeme['key'].'_icon')) > 1){ 
							return _ppt($usermeme['key'].'_icon');
						
						}elseif(_ppt("mem".$usermeme['key'].'_badge') == "1" && strlen(_ppt("mem".$usermeme['key'].'_icon')) > 1){ 
							return _ppt("mem".$usermeme['key'].'_icon');
						}		 
										 
				}
				
				return "";
			
			} break;	
			
			
			case "membership_featured_enabled": {
			
				if(_ppt(array('mem','enable'))  != '1'){
				return 0;
				}
			
				// CHECK WE HAVE THIS OPTION ENABLED
				if($userdata->ID){
				
					$ff = $this->USER("get_user_membership", $userdata->ID);
					if(is_array($ff) && !empty($ff) ){
					  
						if(_ppt($ff['key'].'_'.$order_data) == 1 || _ppt("mem".$ff['key'].'_'.$order_data) == 1 ){ 
							return 1;
						}
						
					}
					
				}else{
				
					// CHECK AGAINST NO MEMBERSHIP
					if(_ppt('mem0_'.$order_data) == 1){ 
						return 1;
					}
				
				
				}
				
				return 0;			
			
			
			} break;	 
			
			case "membership_hasaccess": {			 
			
				// RETURN 1 IF MEMBERSHIPS NOT ENABLED
				if( !$CORE->LAYOUT("captions","memberships") ){ 
				return 1;
				} 
					
				// DISALED
				if(_ppt(array('mem','enable')) == "0" && $order_data == "listings_multiple" ){
				return 0;
				}	
							
				// DISABLED
				if(_ppt(array('mem','enable')) == "0"){
				return 1;
				}
				
				// IS THE ADMIN
				if( user_can($userdata->ID, 'administrator') ){
				return 1;
				} 	
				
				
				
				
				 
				// CHECK WE HAVE THIS OPTION ENABLED
				$ff = $this->USER("membership_features", $userdata->ID);
				  
				if(is_array($ff)){
				
					$checkky = array();
					foreach($ff as $ffk){
					$checkky[$ffk['key']] = $ffk['key']; 
					}
					 
					if(!in_array($order_data, $checkky)){
					 return 1;
					} 
				}
				
				global $post;
				
				// MY OWN POSTS
				if($order_data != "liked" && isset($post->post_author) && ( $userdata->ID == $post->post_author && $post->post_type == "listing_type") && isset($GLOBALS['flag-single']) ){
				return 1;
				}
				 
				
				$usermeme = "";
				if(is_array($order_data) && $userdata->ID ){ // CHECK USER AGAINST				
				 	
					$g = $order_data; // MUST BE ARRAY
					
					$usermeme = $this->USER("get_user_membership", $g[0]);	
					
					// PENDING APPROVAL
					if($usermeme['user_approved'] == "0"){
					return 0;
					}
					 
					if(is_array($usermeme)){
						
						if(_ppt($usermeme['key'].'_'.$g[1]) == 1){ 
							return 1;
						}						 
					}				
				
				}elseif($userdata->ID){
				
					
				 	
					// CHECK CURRENT MEMBERSHIP
					$usermeme = $this->USER("get_user_membership", $userdata->ID);
					
					// HAS NO MEMBERSHIP
					if(empty($usermeme)){
					
						// CHECK AGAINST NON-MEMBER PACKAGE
						if(_ppt('mem0_'.$order_data) == 1 || _ppt("mem".'mem0_'.$order_data) == 1 ){ 
							return 1;
						}
						
					}
					 
					// PENDING APPROVAL
					if(!isset($usermeme['user_approved']) || isset($usermeme['user_approved']) && $usermeme['user_approved'] == "0"){
					return 0;
					} 
										
					if(is_array($usermeme)){
						
						if(_ppt($usermeme['key'].'_'.$order_data) == 1 || _ppt("mem".$usermeme['key'].'_'.$order_data) == 1 ){ 
							return 1;
						}						 
					}
				
				}
				 
				  
				// CHECK AGAINST NO MEMBERSHIP
				if(!is_array($usermeme) && _ppt('mem0_'.$order_data) == 1){ 
				 
					return 1;
				}
				 
				
				return 0;
			
			} break;	
			
			case "membership_active": {
			
			
					$m = $this->USER("get_user_membership", $order_data );
					  
					if(is_array($m)){
					
						$da = $CORE->date_timediff($m['date_expires'],'');
            			if($da['expired'] == 0){
						
							return 1;
						
						}elseif($da['expired'] == 1){
						
							// SEND EMAIL							
							$CORE->FUNC("add_log",
									array(				 
										"type" 			=> "membership_expired",
										"to" 			=> $order_data, 						
										"from" 			=> 0,							
										"alert_uid1" 	=>  $order_data, 	
									)
							);	
							// DELETE KEY
							delete_user_meta($order_data,'ppt_subscription' ); 
						
						}
												 
					}						
			
					return 0;
			
			} break;		
			
		 
			case "get_user_membership": {
			
				// NOT LOGGED IN
				if($order_data == 0 || $order_data  == ""){
				return 0;
				}
				
			 
				$cm			= get_user_meta($order_data,'ppt_subscription' ); 
				 
				 
				if(is_array($cm)){ 
					$i=1; 
					$mymeme = array();
					
					if(isset($cm[0]) && isset($cm[0]['key']) ){
						$mymeme = $cm[0];
					}
					
					// APPROVAL SYSTEM
					if(!isset($mymeme['approved'])){
						$user_approved = 1;
					}else{
						$user_approved = $mymeme['approved'];
					}
					 
					 
					if(!isset($mymeme['key']) || isset($mymeme['key']) && $mymeme['key'] == ""){
						
						// CLEAN UP
						delete_user_meta($order_data,'ppt_subscription' );
						delete_user_meta($order_data,'ppt_subscription_key' );
						
					
					}else{				
						
						$GLOBALS['SHOWALLMEMS'] = 1;
						$sd = $CORE->USER("get_this_membership", $mymeme['key']);	
						unset($GLOBALS['SHOWALLMEMS']);					
						if(is_array($sd)){
						
						if(!isset($sd['name'])){ return 0; }						
						
						$da = $CORE->date_timediff($mymeme['date_expires'],'');						
						
						update_user_meta($order_data,'ppt_subscription_key', $sd['key']);
						            			 
						return array(							
									"key" 			=> $sd['key'],
									"name" 			=> $sd['name'],
									"icon" 			=> $sd['icon'],
									
									"date_start" 	=> $mymeme['date_start'],
									"date_expires" 	=> $mymeme['date_expires'],									
									"expired" 		=> $da['expired'],									
									"user_approved" => $user_approved,
									
									
									
									
						);
						
						}
						
						 
					}
				
				
				}else{
				  	// CLEAN UP	
					delete_user_meta($order_data,'ppt_subscription' );
				
				} 
				
					
				return 0;
			
			} break;
			
			
			
		case "update_rating_likes_new": {
				
				 
				$post_id = $order_data[0];
			 	$rating = $order_data[1];
				
				// HITS ARRAy
				$data = get_post_meta($post_id,'new_likes_array',true);
				if(!is_array($data)){ $data = array(); }
			 
				// GET DATE		  
				$date_now = date('Y-m-d');
				 
				// update
				if(isset($data[$userdata->ID]) && isset($data[$userdata->ID]) ){
					$data[$userdata->ID] = array("date" => date('Y-m-d H:i:s'), "hits" => $data[$userdata->ID]['hits']+1,  "first_rate" => $data[$userdata->ID]['rating'], "userid" => $userdata->ID, "rating" => $rating); 				
				}else{	  
					$data[$userdata->ID] = array("date" => date('Y-m-d H:i:s'), "hits" => 1, "userid" => $userdata->ID, "rating" => $rating );
				} 
			 	
				// SAVE
				update_post_meta($post_id,'new_likes_array',$data);	
				
				//die(print_r($data));
			
		} break;
			
			
		case "update_rating_likes": {
			
				$UID = $order_data;
			 	
				// HITS ARRAy
				$data = get_post_meta($UID,'likes_array',true);
				if(!is_array($data)){ $data = array(); }
			 
				// GET DATE		  
				$date_now = date('Y-m-d');
				
				// update
				if(isset($data[$date_now]) && isset($data[$date_now]) ){
					$data[$date_now] = array("date" => $date_now, "hits" => $data[$date_now]['hits']+1, "last_visit" => date('Y-m-d H:i:s'),"userid" => $userdata->ID); 				
				}else{	  
					$data[$date_now] = array("date" => $date_now, "hits" => 1, "userid" => $userdata->ID );
				}
			 	
				// SAVE
				update_post_meta($UID,'likes_array',$data);	
			
		} break;


		case "get_new_likes_data": {
			
			$r = array("up" => 0, "down" => 0, "total" => 0, "up_percentage" => 0, "down_percentage" => 0);
			
			$data = get_post_meta($order_data,'new_likes_array',true); 
			if(is_array($data) && !empty($data)){	
				foreach($data as $k => $v){
					
					$r['total']++;
					
					if($v['rating'] == "up"){
					$r['up']++;
					}else{
					$r['down']++;
					}
			 
				}
				
				if($r['up'] > 0){
				$r['up_percentage'] = $r['total']/$r['up']*100;
				}
				if($r['down'] > 0){
				$r['down_percentage'] = $r['total']/$r['down']*100;
				}
			} 
			
			
			return $r;
					
		
		} break;
		
		case "get_likes_count": {
			
			
			$c = get_post_meta($order_data,'ratingup',true);	
			if(is_numeric($c) && $c > 0){
			return $c;
			}
			
			return 0;
			
		
		} break;
		
		case "get_rating_likes": {		
			 
			$count = 0;
			 
			// LOOP ALL USER POSTS
			$args = array(
				'post_type' 		=> 'listing_type',
				'posts_per_page' 	=>  100,
				'post_status' 		=>  "publish",
				'author' 			=>  $order_data[0],
				'meta_query' => array(
						 			 
							'log_userid2'   => array(
								'key' 			=> 'likes_array',	
								'type' 			=> 'NUMERIC',								 														
							),		
					),
			 );
			$found_logs = new WP_Query($args);
			$logs = $wpdb->get_results($found_logs->request, OBJECT);
			foreach($logs as $log){
			  
				$data = get_post_meta($log->ID,'likes_array',true);						 
				if(!is_array($data)){ $data = array(); }
					
				switch($order_data[1]){
					
					case "all": {						
						foreach($data as $h){						
							$count =  $count + $h['hits'];										
						}
					} break;					
					default: {					
						if(isset($data[$order_data[1]])){						
							$count = $count + $data[$order_data[1]]['hits'];						
						}					
					} break;				
				} 
			}// end foreach			
			
			return $count;
			
		
		} break;
		
		case "get_subscribers_count": {			
			
			return number_format(count($this->USER("get_subscribers",$order_data)));			 
			
		
		} break;
		
		
		
		case "get_blocked": {
			
			// GETS MY SUBSCRIBERS			 
			$extn = "";
			$type = "blocked";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			  
			$my_list = get_user_meta($order_data, $type.$extn, true);
			
			if(!is_array($my_list)){
			$my_list = array();
			}
			
			$my_list = array_unique($my_list);
			
			return $my_list;
			
		
		} break;
		
		
		case "count_friends": {			
			
			$total = 0;
			
			$total =  count($this->USER("get_subscribers",$order_data));
		 	 
			$total = $total + count($this->USER("get_blocked",$order_data));
			
			return $total;			 
			
		} break;
		
		
		case "get_dislike": {
			
			// GETS MY SUBSCRIBERS			 
			$extn = "_list";
			$type = "dislike";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			$my_list = get_user_meta($order_data, $type.$extn."_followers", true);
			 
			
			if(!is_array($my_list)){			
			$my_list = array();			
			}
			
			$my_list = array_unique($my_list);
			
			return $my_list;
			
		
		} break;
		
		case "get_likes": {
			
			// GETS MY SUBSCRIBERS			 
			$extn = "_list";
			$type = "like";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			$my_list = get_user_meta($order_data, $type.$extn."_followers", true);
			 
			
			if(!is_array($my_list)){			
			$my_list = array();			
			}
			
			$my_list = array_unique($my_list);
			
			return $my_list;
			
		
		} break;
		case "count_dislike": {			
			 
			$total =  count($this->USER("get_likes",$order_data));
		 	 
			return $total;			 
			
		} break;
		case "count_likes": {			
			 
			$total =  count($this->USER("get_likes",$order_data));
		 	 
			return $total;			 
			
		} break;
		
		case "get_subscribers": {
			
			// GETS MY SUBSCRIBERS			 
			$extn = "_list";
			$type = "subscribe";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			$my_list = get_user_meta($order_data, $type.$extn."_followers", true);
			 
			
			if(!is_array($my_list)){			
			$my_list = array();			
			}
			
			$my_list = array_unique($my_list);
			
			return $my_list;
			
		
		} break;
		
		case "get_subscribers_followers_count": {
		
		 $gg = $CORE->USER("get_subscribers_followers", $order_data);
		 
		 if(!is_array($gg)){ $gg = array(); }
		 
		 return count($gg);
		
		
		} break;
		
	 case "get_subscribers_followingme": {
	 

			// FIND OUT WHICH USERS HAVE ADDED ME TO THEIR LIST
			$my_list = array();
			$SQL = "SELECT user_id FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'subscribe_list' AND meta_value LIKE '%\"".$order_data."\"%' AND user_id != '".$order_data."'  LIMIT 50 ";
			  
			 
			$ores = $wpdb->get_results($SQL);
			if(!empty($ores)){
				foreach($ores as $row){
				 
				$my_list[$row->user_id] = $row->user_id;
				}
			
			}
		 	
			return $my_list;
	 
	 
	 } break;
		
		case "get_subscribers_followers": {
		
		
			$extn = "_list";
			$type = "subscribe";
			if(defined('WP_ALLOW_MULTISITE')){
				$extn .= get_current_blog_id();
			}
			 
			$my_list = get_user_meta($order_data, $type.$extn, true);
			 
			if(!is_array($my_list)){
			$my_list = array();
			}
			
			return $my_list;
			 
		
		} break;	
		
		case "get_user_count_hits":
		case "get_total_account_views": { 
		 
			$uid = $order_data;
			
			$value = 0;
			
			if(isset($GLOBALS['get_user_count_hits_'.$uid])){ return $GLOBALS['get_user_count_hits'.$uid]; }
			
			// LISTING IDS			
			$ids = $CORE->PACKAGE("get_user_listing_ids", $uid);
								
			if(is_array($ids) && !empty($ids) ){
				
				foreach($ids as $pid){		
					
					$value += $CORE->PACKAGE("get_hits", array( $pid, "all" ) );	
							
				}
			} 
			
			$GLOBALS['get_user_count_hits'.$uid] = number_format($value);
			
			return number_format($value);		
		
		} break;		
		
		case "get_views": {
		
			$g = $order_data;
			
			$count = 0;
			
 			$data = get_user_meta($g[0],'views_array',true);
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
			
			return $count;
			
		
		} break;
		
		case "update_views": {
			
				$UID = $order_data;
				 
				// HITS ARRAy
				$data = get_user_meta($UID,'views_array',true);
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
				update_user_meta($UID,'views_array',$data);	
			
		} break;
					
					
		case "set_online": {
			
			update_user_meta($order_data, 'online', date("Y-m-d H:i:s") );
			
		} break;
					
		case "get_online_users": {
			 
				// CHECK EXISTS
				$SQL = "SELECT * FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'online' ";
				$user = array();
				$last_posts = (array)$wpdb->get_results($SQL);	 
				foreach($last_posts as $value){				
					$user[$value->user_id] = $value->user_id;				
				}
			
				return $user;		
			
		} break;
		
		case "get_online_status": {
		
				
				if(_ppt(array('user','onlinemode')) == "0"){
				return 0;
				}
				
				// ALWAYS ONLINE FOR ADMIN
				if(user_can($order_data, 'administrator')){
				return 1;
				}
			 
				// CHECK EXISTS
				$SQL = "SELECT count(*) as total FROM ".$wpdb->base_prefix."usermeta WHERE meta_key = 'online' AND user_id ='".$order_data."'  LIMIT 1 ";
			 
				$ores = $wpdb->get_results($SQL);			 
				if(isset($ores[0]) && $ores[0]->total == 1){	
					return 1;
				} 
			
				return 0;		
			
		} break;
			
			
		case "get_online_badge": { 
		
				if($order_data){
			
				return '<span class="onlinebadge online text-dark badge border px-2 bg-white"><i class="fa fa-circle text-success"></i> '.__("Online","premiumpress").'</span>';
			
				}
			
				return '<span class="onlinebadge offline text-dark badge border px-2 bg-white"><i class="fa fa-circle text-dark"></i> '.__("Offline","premiumpress").'</span>';
				
 			
		} break;
		
		case "get_avatar": {
			
			if(is_array($order_data)){
			$order_data = $order_data[0];
			}
			
			
			// PROFILE IMAGE FROM PROFILE
			if(defined('THEME_KEY') && in_array(THEME_KEY, array("da","es")) && $order_data != 1 ){ 
				
					$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('". $order_data ."') LIMIT 1";								 
					$query = $wpdb->get_results($SQL, OBJECT);	
					if(is_array($query) &&!empty($query) && isset($query[0]) && is_numeric($query[0]->ID)){		
						
						return do_shortcode("[IMAGE pathonly=1 pid='".$query[0]->ID."']");
						
					} 	
			
			}
			
			
			$currentimg = get_user_meta( $order_data, "userphoto", true); 
		 	 
			if(is_array($currentimg) && isset($currentimg['img'])){
			 	
				$array = explode('.', $currentimg['img']);
				$extension = end($array);	
				if(substr($currentimg['img'],0,4) != "http" || !in_array($extension, array("jpg","jpeg","png","gif")) && isset($currentimg['src']) ) {
					return $currentimg['src'];
				}else{ 
					return $currentimg['img'];				
				} 
				
			}		 
			 
			$img = get_user_meta($order_data,'myavatar',true);						
			if($img != ""){			
				return CDN_PATH."images/avatar/".$img.".png";			
			}					
			
			return CDN_PATH."images/avatar/none.png";	
		
		} break;	
		
		
		case "get_photo": {		
				
				$img = $this->USER("get_avatar", $order_data);
				 
				// USER PHOTO
				return '<img src="'.$img.'" class="userphoto img-fluid rounded-circle">';
				
			
		} break;		
 
		case "get_phone": {		
				
				$phone = get_user_meta($order_data,'phone',true);
				
				return $phone;
			
		} break;
		
		case "description_title": {		
				
				$d = get_user_meta($order_data,'description_title',true);
				
				return $d;
			
		} break;
		
		case "bar_reputation": {
			
			$data = $CORE->USER("feedback_score", $order_data); 
			
			$l = $CORE->USER("get_level", $order_data); 
			
			ob_start(); 
		
			?>
			<div class="repuationbox">
                       
            <div class="rating-box">             
            <input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fal fa-star" data-fractions="2" data-readonly value="<?php echo $data['stars']; ?>"/> 
           
            <div class="rating-votes tiny text-center"><?php echo $data['votes']; ?> <?php echo __("reviews","premiumpress"); ?></div>      
		 
		 	</div>
			</div>
			<?php
			
			return ob_get_clean();
			
			} break;
			
			case "history_add": {
			
			
				$extn 		= "";
				$key 		= "history";
				if(defined('WP_ALLOW_MULTISITE')){
					$key .= get_current_blog_id();
				}
				$post_id 	=  $order_data; 
				
				if($userdata->ID){ 
					  
					
					// HITS ARRAy
					$data = get_user_meta($userdata->ID,$key,true);
					if(!is_array($data)){ $data = array(); }
					
					// RESET
					if(count($data) > 1000){  $data = array(); }
				 
					// GET DATE		  
					$date_now = date('Y-m-d');
					 
					// update
					if(isset($data[$post_id]) && isset($data[$post_id]) ){
						$data[$post_id] = array("date" => date('Y-m-d H:i:s'), "hits" => $data[$post_id]['hits']+1,  "first_date" => $data[$post_id]['date'], "postid" => $post_id); 				
					}else{	  
						$data[$post_id] = array("date" => date('Y-m-d H:i:s'), "hits" => 1, "postid" => $post_id );
					} 
					
					// SAVE
					update_user_meta($userdata->ID,$key,$data);	
				
				}
			
			}break;
			
			
			case "history_count": {
			
				if(!$userdata->ID){ return 0; }
	
				$key 		= "history";
				if(defined('WP_ALLOW_MULTISITE')){
					$key .= get_current_blog_id();
				}
				
				// HITS ARRAY
				$data = get_user_meta($userdata->ID,$key,true);
				if(!is_array($data)){ $data = array(); }	
							
				if(isset($data[0])){ unset($data[0]); } 
				 
				
				return count($data);  
			
			} break;
			
			
			case "favs_found": {
			
				// SETUP
				$extn = "_list";
				$type = "favorite";
				
				if($userdata->ID){
				
					if(defined('WP_ALLOW_MULTISITE')){
					$extn .= get_current_blog_id();
					}		
									 
					$my_list = get_user_meta($userdata->ID, $type.$extn, true);
					 
					if(is_array($my_list) && in_array($order_data, $my_list)  ){
						return 1;
					}
				
				}
				 
				return 0;
			
			
			} break;
		
			case "favs_count": {
			
				if(!$userdata->ID){ return 0; }
	
				$extn = "_list";
				if(defined('WP_ALLOW_MULTISITE')){
					$extn .= get_current_blog_id();
				}	
				
				$my_list = get_user_meta($userdata->ID, 'favorite'.$extn,true);
				if(!is_array($my_list)){ $my_list = array(); }
				foreach($my_list as $hk => $hh){ if($hh == 0 || $hh == ""){ unset($my_list[$hk]); } }
				
				if(empty($my_list)){ return 0; }
				
				return count($my_list);   
			
			} break;
			
			
			
			case "get_country": {				
			
				$country = get_user_meta($order_data,'country',true);
					
				if(isset($GLOBALS['core_country_list'][$country])){		  
					return $GLOBALS['core_country_list'][$country];			
				} 
				
				return $country;	
			
			} break;
			
			case "get_country_flag": {				
			
				$country = get_user_meta($order_data,'country',true);
				
				if($country == ""){ 
				
					$dc = _ppt(array('user','account_usercountry'));
					if($dc == ""){
					$dc = "US";
					}
				
					$country = $dc; 
				
				} 
				
				if(isset($GLOBALS['core_country_list'][$country])){		  
					return '<span class="flag flag-'.strtolower($country).' ppt_locationflag"></span>';			
				} 
				
				return $country;	
			
			} break;
			
			case "get_city": {				
			
				$country = get_user_meta($order_data,'city',true);
				 
				return $country;	
			
			} break;
			
			case "get_user_profile_link": {
			
				if(!is_numeric($order_data) || _ppt(array('user','allow_profile')) == "0"){ return "#"; }
				
				
				if( defined('THEME_KEY') && in_array(THEME_KEY, array("da","ex")) ){
				 
				 	$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$order_data."') LIMIT 1";				 
					$query = $wpdb->get_results($SQL, OBJECT);
					if(!empty($query)){	
						
						return get_permalink($query[0]->ID);				
					
					}
				
				}elseif(defined('THEME_KEY') && in_array(THEME_KEY, array("es")) ){
				 
					$accounttype = $CORE->USER("get_account_type", $userdata->ID);
					
					if(isset($accounttype['key']) && $accounttype['key'] != 2){
					
					return get_author_posts_url( $order_data );	
					
					}else{
				 	
						$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$order_data."') LIMIT 1";				 
						$query = $wpdb->get_results($SQL, OBJECT);
						if(!empty($query)){	
							
							return get_permalink($query[0]->ID);				
						
						}
					
					}
				
				} 
			
				return get_author_posts_url( $order_data );				 
				
			}
			
			case "get_userid_from_postid": {
			
				return get_post_field( 'post_author', $order_data );				
				  
			} break;
			
			case "get_username": {		
		 
				if(!is_numeric($order_data)){ return "invalid user id"; }
			
				// BUILD DISPLAY NAME
				$name = get_the_author_meta( 'user_login', $order_data);
				
				return $name;
			
			} break;
		
			case "get_name": {		
		 
				if(!is_numeric($order_data)){ return "anonymous"; }
			
				// BUILD DISPLAY NAME
				$name = get_the_author_meta( 'first_name', $order_data)." ".get_the_author_meta( 'last_name', $order_data);
				
				// FALLBACK
				if(strlen(trim($name)) < 4){
				$name = get_the_author_meta( 'user_login', $order_data);
				}
				 
				return $name;
			
			} break;
			
			case "get_display_name": {		
		 
				if(!is_numeric($order_data)){ return "anonymous"; }
				 
				// BUILD DISPLAY NAME
				$name = get_the_author_meta( 'display_name', $order_data);
				  
				return $name;
			
			} break;
			
			
			case "get_first_name": {		
		 
				if(!is_numeric($order_data)){ return "anonymous"; }
			
				// BUILD DISPLAY NAME
				$name = get_the_author_meta( 'first_name', $order_data);
				  
				return $name;
			
			} break;
			
			
			case "get_last_name": {		
		 
				if(!is_numeric($order_data)){ return "anonymous"; }
			
				// BUILD DISPLAY NAME
				$name = get_the_author_meta( 'last_name', $order_data);
				  
				return $name;
			
			} break;
			
			case "get_address": {		
		 
				if(!is_numeric($order_data)){ return "invalid user id"; }
				
				$name = "";
			
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'address1', $order_data, true)) > 1){				
					$name .= get_the_author_meta( 'address1', $order_data, true)."<br>";				
				}
				
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'address2', $order_data, true)) > 1){				
					$name .= get_the_author_meta( 'address2', $order_data, true)."<br>";				
				}
				
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'town', $order_data, true)) > 1){				
					$name .= get_the_author_meta( 'town', $order_data, true)."<br>";				
				}
				
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'city', $order_data, true)) > 1){				
					$name .= get_the_author_meta( 'city', $order_data, true)."<br>";				
				}
				
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'country', $order_data, true)) > 1){		
					$country = get_the_author_meta( 'country', $order_data, true);
					if(isset($GLOBALS['core_country_list'][$country])){
						$name .= $GLOBALS['core_country_list'][$country]."<br>";
					}else{
						$name .=  $country."<br>";
					}
					 			
				}
				
				// BUILD DISPLAY NAME
				if(strlen(get_the_author_meta( 'zip', $order_data, true)) > 1){				
					$name .= get_the_author_meta( 'zip', $order_data, true)."<br>";				
				}
				
				
				return $name;
			
			} break;
			case "get_address_part": {				 		 		 
			 
				$val = get_user_meta( $order_data[1], $order_data[0], true);			   
				
				if(defined('THEME_KEY') && THEME_KEY == "sp" && $val == "" ){ 
					switch($order_data[0]){
						case "address1": {						
							$val = get_user_meta( $order_data[1], 'billing_address', true);	
						} break;
						case "country": {						
							$val = get_user_meta( $order_data[1], 'billing_country', true);	
						} break;
						case "city": {						
							$val = get_user_meta( $order_data[1], 'billing_city', true);	
						} break;
						case "town": {						
							$val = get_user_meta( $order_data[1], 'billing_city', true);	
						} break;
						case "state": {						
							$val = get_user_meta( $order_data[1], 'billing_state', true);	
						} break;
						case "zip": {						
							$val = get_user_meta( $order_data[1], 'billing_zip', true);	
						} break;
						case "phone": {						
							$val = get_user_meta( $order_data[1], 'billing_phone', true);	
						} break;
					
					}
				}
				
				return $val;
				
			} break;
					
			case "get_phone": {			
					
				if(!is_numeric($order_data)){ return "invalid user id"; }
			
				// BUILD DISPLAY NAME
				return get_user_meta( 'phone', $order_data, true);
		
			
			} break;

			case "get_verified_email": {			
				  
				// BUILD DISPLAY NAME				
				if(get_user_meta($order_data,'ppt_verified',true) == 1){				
					return 1;				
				}else{
					return 0;
				}
		
			
			} break;	
			
			case "get_verified_photo": {			
					
				if(!is_numeric($order_data)){ return "invalid user id"; }
				 
				// BUILD DISPLAY NAME				
				if(get_user_meta($order_data,'ppt_verified_photo',true) == "1"){				
					return 1;				
				}else{
					return 0;
				}
		
			
			} break;	
			
			case "get_sms_verified": {			
					
				if(!is_numeric($order_data)){ return "invalid user id"; }
			  
				// BUILD DISPLAY NAME				
				if(get_user_meta($order_data,'ppt_sms_verified',true) == "1"){				
					return 1;				
				}else{
					return 0;
				}
		
			
			} break;	
			
			case "get_verified": {			
					
				if(!is_numeric($order_data)){ return 0; }
			  
			   
				 if(_ppt(array('register', 'forcemailverify' )) == 1 && get_user_meta($order_data,'ppt_verified',true) != "1"){
				 	return 0;
				 }
				 
				 if(_ppt(array('register', 'photoverify' )) == 1 && get_user_meta($order_data,'ppt_verified_photo',true) != "1"){
				 return 0;
				 }
				 
				 if(_ppt(array('sms', 'force' )) == 1 && get_user_meta($order_data,'ppt_sms_verified',true) != "1"){
				 return 0;
				 }
				  
				
				return 1;
		
			
			} break;		
			
			case "get_email": {			
					
					$user_info = get_userdata($order_data);
					
					if(!isset($user_info->user_email)){
					return "";
					} 	
			 
					return $user_info->user_email;					
			
			} break;	
			case "get_desc": {	
			
					if(!is_numeric($order_data)){
					return ;
					}		
					
					$user_info = get_userdata($order_data);
				 
				 	if(defined('WLT_DEMOMODE') && strlen($user_info->description) < 2){
					return "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.";
					} 	
			 
					return stripslashes($user_info->description);					
			
			} break;		
			case "get_joined": {			
					
					if(!is_numeric($order_data)){
					return ;
					}
					
					$user_info = get_userdata($order_data);					 
					if(!isset($user_info->user_registered)){
					return "";
					} 	
					  
					return hook_date_only($user_info->user_registered);					
			
			} break;	
				
			case "get_role": {			
					
					$user_info = get_userdata($order_data);
		
					if(!isset($user_info->roles)){
					return "";
					} 
						
					return $user_info->roles[0];					
			
			} break;					
			
			case "get_lastlogin": {			
					
					$date = get_user_meta($order_data, 'login_lastdate', true);	
					
					if($date == ""){ return "-"; }
					 	
					$xp = $CORE->date_timediff($date); 
					 
					return $xp['string'];
			
			} break;
			
			
			case "get_credit": {			
					
					$credit = get_user_meta($order_data,'ppt_usercredit',true);
					
					if($credit == ""){
					$credit = 0;
					}
					
					return $credit;				
			
			} break;
 
			
			case "get_ordertotal": {
							
					$args = array(
						'post_type' 		=> 'ppt_orders',
					 
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
					return $wp_query1->found_posts;
					
		} break;
		
		
		
		case "get_cashout_total": {
							
					$args = array(
						'post_type' 		=> 'ppt_cashout',
					 
							'meta_query' => array( 
								'user_id'    => array(
									'key' 			=> 'cashout_userid',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $userdata->ID,
									'compare' 		=> '=',								 					 			
								),					 	
							), 
						 
							
					  );
					 $wp_query1 = new WP_Query($args);
					 
					return $wp_query1->found_posts;
					
		} break;


		case "get_news_popup": {
		 
		 
		 		
					
		} break;
		
		case "get_news_pending": {
							
					$args = array(
						'post_type' 		=> 'ppt_news',
					 		'post_status'	=> 'publish',
							'meta_query' => array( 
							
								'relation' => "AND",
								
								'user_id'    => array(
									'key' 			=> 'userid',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $userdata->ID,
									'compare' 		=> '=',								 					 			
								),
								
								'cashout_status'    => array(
									'key' 			=> 'status',	
									'type' 			=> 'NUMERIC',
									'value' 		=> 1,
									'compare' 		=> '=',								 					 			
								),					 	
							),  
							
					  );
					  
					  
					 $wp_query1 = new WP_Query($args);
					 
					return $wp_query1->found_posts;
					
		} break;
		
		
		case "get_cashout_pending": {
							
					$args = array(
						'post_type' 		=> 'ppt_cashout',
					 		'post_status'	=> 'publish',
							'meta_query' => array( 
							
								'relation' => "AND",
								
								'user_id'    => array(
									'key' 			=> 'cashout_userid',	
									'type' 			=> 'NUMERIC',
									'value' 		=> $userdata->ID,
									'compare' 		=> '=',								 					 			
								),
								
								'cashout_status'    => array(
									'key' 			=> 'cashout_status',	
									'type' 			=> 'NUMERIC',
									'value' 		=> 2,
									'compare' 		=> '=',								 					 			
								),					 	
							),  
							
					  );
					  
					  
					 $wp_query1 = new WP_Query($args);
					 
					return $wp_query1->found_posts;
					
		} break;
	 
			
		case "logs_get_unread_single": {
		
		if(!$userdata->ID){
				return 0;
		}
	
	
$SQL = "SELECT DISTINCT ".$wpdb->prefix."posts.ID FROM ".$wpdb->prefix."posts 

INNER JOIN ".$wpdb->prefix."postmeta ON ( ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON ( ".$wpdb->prefix."posts.ID = mt1.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON ( ".$wpdb->prefix."posts.ID = mt2.post_id )  

INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON ( ".$wpdb->prefix."posts.ID = mt3.post_id )  

WHERE 1=1 

AND ( mt2.meta_key = 'log_public' AND mt2.meta_value = '1' ) 

AND ( mt3.meta_key = 'log_unread_".$userdata->ID."' AND mt3.meta_value = '1' )  

AND (  ".$wpdb->prefix."postmeta.meta_key = 'log_to' AND CAST(".$wpdb->prefix."postmeta.meta_value AS SIGNED) = '".$userdata->ID."' OR mt1.meta_key = 'log_from' AND CAST(mt1.meta_value AS SIGNED) = '".$userdata->ID."' ) 

AND ".$wpdb->prefix."posts.post_type = 'ppt_logs' AND (".$wpdb->prefix."posts.post_status = 'publish') GROUP BY ".$wpdb->prefix."posts.ID ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 0, 1";
 		
 		  
			$result = $wpdb->get_results($SQL);
		 			 
			if(empty($result)){
				return 0;
			}
			
			return $result[0]->ID;
		
		 } break;

		case "logs_get_all": {
		 
$SQL = "SELECT DISTINCT ".$wpdb->prefix."posts.ID FROM ".$wpdb->prefix."posts 

INNER JOIN ".$wpdb->prefix."postmeta ON ( ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON ( ".$wpdb->prefix."posts.ID = mt1.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON ( ".$wpdb->prefix."posts.ID = mt2.post_id )  
 
WHERE 1=1 

AND ( mt2.meta_key = 'log_public' AND mt2.meta_value = '1' ) 
 
AND (  ".$wpdb->prefix."postmeta.meta_key = 'log_to' AND CAST(".$wpdb->prefix."postmeta.meta_value AS SIGNED) = '".$userdata->ID."' OR mt1.meta_key = 'log_from' AND CAST(mt1.meta_value AS SIGNED) = '".$userdata->ID."' ) 

AND ".$wpdb->prefix."posts.post_type = 'ppt_logs' AND (".$wpdb->prefix."posts.post_status = 'publish') GROUP BY ".$wpdb->prefix."posts.ID ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 0, 20";


			$result = $wpdb->get_results($SQL);
			 
					 
			if(empty($result)){
				return 0;
			}
			
			return $result;	
		
		} break;
		
 		
	case "logs_clear_count": {
	
		if(!$userdata->ID){
				return 0;
		}
		
		$SQL = "UPDATE ".$wpdb->prefix."postmeta SET meta_value = '0' WHERE meta_key = 'log_unread_".$userdata->ID."'";
 		   
		$wpdb->get_results($SQL);
		
	} break;

	case "count_get_logs": {
	
		if(!$userdata->ID){
				return 0;
		}
	
	/*
	
$SQL = "SELECT COUNT(DISTINCT ".$wpdb->prefix."posts.ID) AS total FROM ".$wpdb->prefix."posts 

INNER JOIN ".$wpdb->prefix."postmeta ON ( ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON ( ".$wpdb->prefix."posts.ID = mt1.post_id ) 

INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON ( ".$wpdb->prefix."posts.ID = mt2.post_id )  

INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON ( ".$wpdb->prefix."posts.ID = mt3.post_id )  

WHERE 1=1 

AND ( mt2.meta_key = 'log_public' AND mt2.meta_value = '1' ) 

AND ( mt3.meta_key = 'log_unread_".$userdata->ID."' AND mt3.meta_value = '1' )  

AND (  ".$wpdb->prefix."postmeta.meta_key = 'log_to' AND CAST(".$wpdb->prefix."postmeta.meta_value AS SIGNED) = '".$userdata->ID."' OR mt1.meta_key = 'log_from' AND CAST(mt1.meta_value AS SIGNED) = '".$userdata->ID."' ) 

AND ".$wpdb->prefix."posts.post_type = 'ppt_logs' AND (".$wpdb->prefix."posts.post_status = 'publish') GROUP BY ".$wpdb->prefix."posts.ID ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 0, 20";
 		
		*/
		
		$SQL = "SELECT COUNT(DISTINCT(".$wpdb->prefix."posts.ID)) AS total FROM ".$wpdb->prefix."posts INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON ( ".$wpdb->prefix."posts.ID = mt3.post_id )  WHERE  mt3.meta_key = 'log_unread_".$userdata->ID."' AND mt3.meta_value = '1' ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 0, 20";
 
 
 		  
			$result = $wpdb->get_results($SQL);
					 
			if(empty($result)){
				return 0;
			}
			
			return $result[0]->total;
			 
		
		} break;
 
		
		case "check_offer_exists_by_orderid": {
		
			if(!$userdata->ID){
				return 0;
			}
		
			$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
					INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 					 				
					WHERE 1=1 
					AND ( mt1.meta_key = 'order_id' AND mt1.meta_value = ('".$order_data."')   )				 
					AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID LIMIT 1 ";
			 
			$result = $wpdb->get_results($SQL);	
					 
			if(empty($result)){
				return 0;
			}
			
			return $result[0]->ID;
		
		} break;
		case "get_offer": {
		
			if(!$userdata->ID){
				return 0;
			}
		
			$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
					INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
					INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 					
					WHERE 1=1 
					AND ( mt1.meta_key = 'seller_id' AND mt1.meta_value = ('".$userdata->ID."') OR mt1.meta_key = 'buyer_id' AND mt1.meta_value = ('".$userdata->ID."')  )
					AND ( mt2.meta_key = 'post_id' AND mt2.meta_value = ('".$order_data."') )
					AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer'  GROUP BY ID ORDER BY post_date DESC LIMIT 1 ";
			 
			$result = $wpdb->get_results($SQL);	
					 
			if(empty($result)){
				return 0;
			}
			
			// GET STATUS
			if(isset($GLOBALS['flag-single'])){			
				$offer_satus = get_post_meta($result[0]->ID, "offer_status", true);			 
				if($offer_satus !=  1){
					return 0;
				}	
			}
			
			
			return $result[0]->ID;
		
		} break;
		
		case "get_offer_status": {
			
			$g = $this->USER("get_offer", $order_data);
			if(is_numeric($g) && $g > 0){	
					
				$status = get_post_meta($g, "offer_status", true);
				return $status;
			
			}
			
			return 0;
		
		} break;	
		
		case "count_offers": {
			
				$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
							 
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'seller_id' AND mt1.meta_value = ('".$order_data."') OR mt1.meta_key = 'buyer_id' AND mt1.meta_value = ('".$order_data."') )
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
			
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
			} break;
			
		case "count_offers_only_by_postid": {
		 
			
			$d1 = $order_data; // POST ID
			  
						$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
						
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'post_id' AND mt1.meta_value = ('".$d1."')  )	 
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
						
			 	
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
			} break;
			
		
		case "count_offers_pending_by_postid": {
		
			if(!is_array($order_data)){
			return 0;
			}
			
			$d1 = $order_data[0]; // POST ID
			$d2 = $order_data[1]; // USER ID
			
			 
						$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
						
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'post_id' AND mt1.meta_value = ('".$d1."')  )						 				
						AND ( mt2.meta_key = 'buyer_id' AND mt2.meta_value = ('".$d2."')  )						 				
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
						
			 	
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
			} break;
			
			
			case "get_offers_pending_by_postid": {
		
			if(!is_array($order_data)){
			return 0;
			}
			
			$d1 = $order_data[0]; // POST ID
			$d2 = $order_data[1]; // USER ID
			
			 
						$SQL = "SELECT ID FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
						
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'post_id' AND mt1.meta_value = ('".$d1."')  )						 				
						AND ( mt2.meta_key = 'buyer_id' AND mt2.meta_value = ('".$d2."')  )						 				
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
						
			 	
					$result = $wpdb->get_results($SQL);	
			
				 if(isset($result[0])){ 		
				return $result[0]->ID;
				
				}else{
				return 0;
				}
				
				
			} break;
			
 
			
		case "count_offers_pending": {
		
		
			
				$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
							 
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'seller_id' AND mt1.meta_value = ('".$order_data."') OR mt1.meta_key = 'buyer_id' AND mt1.meta_value = ('".$order_data."') )
						
						AND ( mt2.meta_key = 'offer_status' AND mt2.meta_value = '1'  )						
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
					 
			 	
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
			} break;
			
			
		case "count_offers_pending_post": {
		
			if(!is_array($order_data)){
			return 0;
			}
			
			$d1 = $order_data[0]; // POST ID
			$d2 = $order_data[1]; // USER ID
			
				$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
				
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
						
						INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON (".$wpdb->prefix."posts.ID = mt3.post_id) 
						
						 
						WHERE 1=1 
							
						AND ( 
						
							mt1.meta_key = 'post_id' 
							
							AND mt1.meta_value = ('".$d1."') 
							
							AND mt2.meta_key = 'seller_id' 
							
							AND mt2.meta_value = ('".$d2."') 
							
							AND mt3.meta_key = 'offer_status' 
							
							AND ( mt3.meta_value = '1'  OR mt3.meta_value = '2'  )
						
						)						 				
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
						
						//echo $SQL;
			 	 
				
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
		} break;
		
		
		case "count_offers_complete_post": {
		
			if(!is_array($order_data)){
			return 0;
			}
			
			$d1 = $order_data[0]; // POST ID
			$d2 = $order_data[1]; // USER ID
			
				$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
				
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
						
						INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON (".$wpdb->prefix."posts.ID = mt3.post_id) 
						
						 
						WHERE 1=1 
							
						AND ( 
						
							mt1.meta_key = 'post_id' 
							
							AND mt1.meta_value = ('".$d1."') 
							
							AND mt2.meta_key = 'seller_id' 
							
							AND mt2.meta_value = ('".$d2."') 
							
							AND mt3.meta_key = 'offer_status' 
							
							AND ( mt3.meta_value = '3'  )
						
						)						 				
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID ";
						
						//echo $SQL;
			 	 
				
					$result = $wpdb->get_results($SQL);	
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
		} break;
			
						
		case "count_offers_complete": {
			
				$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
						INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
							 
						WHERE 1=1 
							
						AND ( mt1.meta_key = 'seller_id' AND mt1.meta_value = ('".$order_data."') )
						
						AND ( mt2.meta_key = 'offer_status' AND mt2.meta_value = '3'  )						
							 
						AND ".$wpdb->prefix."posts.post_status = 'publish' AND ".$wpdb->prefix."posts.post_type='ppt_offer' GROUP BY ID "; // OR mt1.meta_key = 'buyer_id' AND mt1.meta_value = ('".$order_data."')
			 	
					$result = $wpdb->get_results($SQL); 
					
				if(empty($result)){
				return 0;
				}
				  		
				return count($result);
				
				
			} break;
			
			
			case "count_listings_all": {
			
				$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
				WHERE ".$wpdb->prefix."posts.post_author = ('".$order_data."') 
				AND ".$wpdb->prefix."posts.post_status != 'trash'  
				AND ".$wpdb->prefix."posts.post_type='listing_type'";  
				$result = $wpdb->get_results($SQL);	
				  
				return $result[0]->total;
			
			} break;
			
			case "count_listings_published":
			case "count_listings": {
			
				$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
				WHERE ".$wpdb->prefix."posts.post_author = ('".$order_data."') 
				AND ".$wpdb->prefix."posts.post_status = 'publish' 
				AND ".$wpdb->prefix."posts.post_type='listing_type'"; 
			
				$result = $wpdb->get_results($SQL);	
				  
				return $result[0]->total;
			
			} break;
			
			case "count_profile_views":{
			
				$j = get_user_meta($order_data,'views',true);
				if($j == ""){
				return 0;
				}
				return number_format($j);
			
			} break;
			
			
			case "count_messages": {
			
			// MSSAGES BETWEEN USER
			$SQL = "SELECT count(*) as total FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id AND  mt1.meta_key = 'msg_stick' 
			AND ( mt1.meta_value LIKE '%[".$userdata->ID."]%' OR  mt1.meta_value LIKE '%[".$userdata->ID."]%' ) )  
			WHERE  1= 1
			AND ".$wpdb->prefix."posts.post_status = 'publish' 
			AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date ASC";
			 
			 
			$result = $wpdb->get_results($SQL);
			 return $result[0]->total;
						 
			
			} break;
			
			case "count_messages_unread_from_user": {
			
			//$order_data[0]; USER 1
			//$order_data[1]; USER 2 (sender id)
			
			// MSSAGES BETWEEN USER
			$SQL = "SELECT count(*) as total FROM ".$wpdb->prefix."posts 
			 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND  mt2.meta_key = 'msg_status' AND mt2.meta_value = 'unread_".$order_data[0]."') 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt3 ON (".$wpdb->prefix."posts.ID = mt3.post_id AND  mt3.meta_key = 'sender_id' AND mt3.meta_value = '".$order_data[1]."') 
			
			WHERE  1= 1
			AND ".$wpdb->prefix."posts.post_status = 'publish' 
			AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date ASC";
			
			  
			$result = $wpdb->get_results($SQL);
			
			return $result[0]->total;
			
			} break;
						
			case "count_messages_unread": {
			
			// MSSAGES BETWEEN USER
			$SQL = "SELECT count(*) as total FROM ".$wpdb->prefix."posts 
			 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND  mt2.meta_key = 'msg_status' AND mt2.meta_value = 'unread_".$order_data."') 
			
			WHERE  1= 1
			AND ".$wpdb->prefix."posts.post_status = 'publish' 
			AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date ASC";
			   
			$result = $wpdb->get_results($SQL);
			
			return $result[0]->total;			
			
			} break;
			
			
			case "count_sellspace_by_user": {
			
				$campaigns = new WP_Query( array('posts_per_page' => 200, 'post_type' => 'ppt_campaign', 'orderby' => 'post_date', 'order' => 'desc', 'author' => $order_data ) );
				
				return count($campaigns->posts);
			
			} break;
			
			case "count_comments_by_user": {
			
			
			$args = array(
				 
				'number' => 50,
				'post_author__in' => array($order_data),
				'meta_query' => array(			 
					array(
						'key'		=> 'feedback',	
						'compare'	=>'NOT EXISTS'
					),			 
				),
					
			);
			// GET USER FEEDBACK
			$c = new WP_Comment_Query($args); 
			
			return count($c->comments);	
			
			} break;
			
			case "get_messages_unread": {
			
			// MSSAGES BETWEEN USER
			$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
			 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND  mt2.meta_key = 'msg_status' AND mt2.meta_value = 'unread_".$order_data."') 
			
			WHERE  1= 1
			AND ".$wpdb->prefix."posts.post_status = 'publish' 
			AND ".$wpdb->prefix."posts.post_type = 'ppt_message' ORDER BY ".$wpdb->prefix."posts.post_date ASC";
			   
			$result = $wpdb->get_results($SQL);
			
			if(!empty($result) && isset($result[0])){
			return $result[0];
			}
			
			return array();
			
			} break;	
			
			 
			case "user_comment_score": {
			
			
				if(is_array($order_data)){
				
					$userid = $order_data[0];
					$postid = $order_data[1];
					
				}else{
				
					$userid = $order_data;
				}
			
				$total_score = 0;
				$total_found = 0;
				$feedback_value = array();
			 	 
				$args = array(
					 
					'posts_per_page'	=> '150',
					'meta_query' => array(
							 
							array(
								'key'		=> 'postauthor',
								'value' 	=> $userid,
								'compare' 		=> '=',
							),						 
							 
						),
						
				);
				// GET USER FEEDBACK
				$c = new WP_Comment_Query($args); 
				 
				
				$feedback = $c->comments;
				if(!empty($feedback)){
				
					$total_found = count($feedback);
					
					foreach($feedback as $this_feedback){
					 
						if(isset($postid) && is_numeric($postid) ){
							$pid = get_comment_meta($this_feedback->comment_ID,'ratingpid',true);
							if($pid != $postid){
								continue;
							}
						}
					
						$score = get_comment_meta($this_feedback->comment_ID,'ratingtotal',true);
						 
						if( $score == ""){  $score = 5; }
						$total_score = $total_score + $score;
						
						if(isset($feedback_value[substr($score,0,1)])){
						$feedback_value[substr($score,0,1)] = $feedback_value[substr($score,0,1)] + 1;
						}else{
						$feedback_value[substr($score,0,1)] = 1;
						}
					
					}
				}
				
				
			 
			// PERCENTAGE
			$percentage = 0;
			if($total_found > 0 && $total_score > 0){	
			$percentage = number_format(( $total_found / $total_score )*100 * 5, 0);	
			}
			
			// DEFAULT 5 SCORE
			if($total_found > 0){	
				$score = round(($total_score / $total_found),2);
			}else{
				$score = 5;
			}
			
			// DEFAULTS
			if($percentage == 0){ $percentage = 100; $score = 5; }  
			
			return array(
				"score" 		=> $score,
				"votes" 		=> $total_found, 
				"stars" 		=> $score, 
				"percentage" 	=> $percentage, //<-- not used now
				"data" 			=> $feedback_value,
			);
			
			
			} break;
						
			
			case "feedback_score": {
			
			
				if(is_array($order_data)){
				
					$userid = $order_data[0];
					$postid = $order_data[1];
					
				}else{
				
					$userid = $order_data;
				}
			
				$total_score = 0;
				$total_found = 0;
				$feedback_value = array();
			 	 
				$args = array(
					 
					'posts_per_page'	=> '150',
					'meta_query' => array(
							 
							array(
								'key'		=> 'feedback_for',
								'value' 	=> $userid,
								'compare' 		=> '=',
							),
							array(
								'key'		=> 'feedback',	
								'value' 	=> 1,
								'compare' 	=> '=',
							),	
							 
						),
						
				);
				// GET USER FEEDBACK
				$c = new WP_Comment_Query($args);				
				$feedback = $c->comments;
				if(!empty($feedback)){
				
					$total_found = count($feedback);
					
					foreach($feedback as $this_feedback){
					 
						if(isset($postid) && is_numeric($postid) ){
							$pid = get_comment_meta($this_feedback->comment_ID,'ratingpid',true);
							if($pid != $postid){
								continue;
							}
						}
					
						$score = get_comment_meta($this_feedback->comment_ID,'ratingtotal',true);
						  
						if( !is_numeric($score) ){  $score = 5; }
						$total_score = $total_score + $score;
						
						if(isset($feedback_value[substr($score,0,1)])){
						$feedback_value[substr($score,0,1)] = $feedback_value[substr($score,0,1)] + 1;
						}else{
						$feedback_value[substr($score,0,1)] = 1;
						}
					
					}
				}
				
				
			 
			// PERCENTAGE
			$percentage = 0;
			if($total_found > 0 && $total_score > 0){	
			$percentage = number_format(( $total_found / $total_score )*100 * 5, 0);	
			}
			
			// DEFAULT 5 SCORE
			if($total_found > 0){	
				$score = round(($total_score / $total_found),2);
			}else{
				$score = 5;
			}
			
			// DEFAULTS
			if($percentage == 0){ $percentage = 100; $score = 5; }  
			
			if($total_found == 0){	
			$percentage = 0; $score = 0;
			}
			
			$data = array(
				"score" 		=> $score,
				"votes" 		=> $total_found, 
				"stars" 		=> $score, 
				"percentage" 	=> $percentage, //<-- not used now
				"data" 			=> $feedback_value,
			);
			 
			return $data; 
			
			} break;
			
	 
			
			case "get_levels": {
		 
				 
			
			} break;
			case "get_awards": {
						
			
				$user_awards = array(
				
					1 => array(
						"name" => "Complete Profile",
						"desc" => "Sold more than $1 across the market.",
						"active" => false,
					),
					2 => array(
						"name" => "Favorites",
						"desc" => "Has more than 1 ad on their favorites list.",
						"active" => false,
					),	
					3 => array(
						"name" => "Active",
						"desc" => "Active within the last 48 hours.",
						"active" => false,
					),		
					4 => array(
						"name" => "Verified",
						"desc" => "Account has been verified by an admin.",
						"active" => false,
					),	 
					5 => array(
						"name" => "Photo",
						"desc" => "Has uploaded a custom profile photo.",
						"active" => false,
					),		
					
					6 => array(
						"name" => "Celeberity",
						"desc" => "Has more than 100 profile views.",
						"active" => false,
					),
					7 => array(
						"name" => "Power Seller",
						"desc" => "Has more than 10 ads.",
						"active" => false,
					),	
					8 => array(
						"name" => "Feedback",
						"desc" => "Has receieved more than 1 feedback.",
						"active" => false,
					),		
					9 => array(
						"name" => "Diamond Author",
						"desc" => "Has receieved more than 10 feedback.",
						"active" => false,
					),	 
					10 => array(
						"name" => "Emerald Author",
						"desc" => "Has receieved more than 20 feedback.",
						"active" => false,
					),
					11 => array(
						"name" => "Diamond Author",
						"desc" => "Has receieved more than 10 feedback.",
						"active" => false,
					),	 
					12 => array(
						"name" => "Emerald Author",
						"desc" => "Has receieved more than 20 feedback.",
						"active" => false,
					),
					13 => array(
						"name" => "Emerald Author",
						"desc" => "Has receieved more than 20 feedback.",
						"active" => false,
					),
					14 => array(
						"name" => "Diamond Author",
						"desc" => "Has receieved more than 10 feedback.",
						"active" => false,
					),	 
					15 => array(
						"name" => "Emerald Author",
						"desc" => "Has receieved more than 20 feedback.",
						"active" => false,
					),				 
				 
									
				);
				
				
				if(is_numeric($order_data)){
					
					// 1. USER PROFILE
					$ud = get_the_author_meta("description", $order_data);
					if(strlen($ud) > 100){
					
						$user_awards[1]['active'] = 1;
					}
					
					//2 . FAVS
					if($CORE->USER("favs_count", $order_data) > 0 ){
					
						$user_awards[2]['active'] = 1;
					}
				
					//3 .
					if(1 == 1){
					
						$user_awards[3]['active'] = 1;
					}	
					
					//4 .
					if(1 == 1){
					
						$user_awards[4]['active'] = 1;
					}	
					
					//5 .
					if(1 == 1){
					
						$user_awards[5]['active'] = 1;
					}	
					
					//6 .
					if(1 == 1){
					
						$user_awards[6]['active'] = 1;
					}
					
					//7 .
					if(1 == 1){
					
						$user_awards[7]['active'] = 1;
					}
										
					//8 .
					if(1 == 1){
					
						$user_awards[8]['active'] = 1;
					}
					
					//9 .
					if(1 == 1){
					
						$user_awards[9]['active'] = 1;
					}
					
					
																	
				
				return $user_awards;
				
				}else{
				
				return $user_awards;
				
				}
			
			} break;
			
			case "get_account_links": {
			
			
			 
				// BUILD ACCOUNT PAGE ITEMS
				$accountitems = array(
					
					"dashboard" => array(
					
						"name" => __("Dashboard","premiumpress"),
						"desc" => "",
						"link" => _ppt(array('links','account')),
						"icon" => "dashboard",
						"path" => 'dashboard',
						
						"desc" => __("Here you'll find your account overview, recent account notices and alerts.","premiumpress"),
					
					),
					
					
					
					"cashback" => array(
					
						"name" => __("Cashback","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "cashback",
						"path" => 'cashback',
						"desc" => __("Request cashback for items purchased using our affiliate links here.","premiumpress"),
					
					),
					
					"downloads" => array(
					
						"name" => __("Downloads","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "downloads",
						"path" => 'downloads',
						
						"desc" => __("Here you can manage your downloads.","premiumpress"),
					
					),
					 
					
					"offers" => array(
					
						"name" => str_replace("%d", $CORE->LAYOUT("captions","offers"), __("My %d","premiumpress")),
						"desc" => "",
						"link" => "",
						"icon" => "offers",
						"path" => 'offers',
						
						"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), str_replace("%d", strtolower($CORE->LAYOUT("captions","offers")), __("Any %d you have made or recieved can be found here.","premiumpress"))),
						 
					
					),
					
					"listings" => array(
					
						"name" => str_replace("%s", $CORE->LAYOUT("captions","2"),__("My %s","premiumpress")),
						"desc" => "",
						"link" => "",
						"icon" => "clipboard-check",
						"path" => 'listings',
						
						"desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Here you can view, manage and upgrade your existing %s.","premiumpress")),
						 
					
					),
					
					
					"store" => array(
					
						"name" => ppt_title_store(),
						"desc" => "",
						"link" => "",
						"icon" => "store",
						"path" => 'store',
						
						"desc" => ppt_desc_store(),
						 
					
					),
				 
					
					"messages" => array(
					
						"name" => __("Messages","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "chat",
						"path" => 'messages',
						
						"desc" => __("Here you can chat with other users using our private message system.","premiumpress"),
					),
					
					
					"comments" => array(
					
						"name" => __("Comments","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "comments",
						"path" => 'comments',
						"desc" => __("Manage all feedback and comments you have left on our website here.","premiumpress"),
					
					),
					
					"likes" => array(
					
						"name" => __("Who Likes Me","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "heart",
						"path" => 'likes',
						
						"desc" => __("Discover which users have visited your profile and when with these tools.","premiumpress"),
					
					),				
					
					
					"friends" => array(
					
						"name" => __("My Friends","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "users",
						"path" => 'friends',
						"desc" => __("Build a friends list and manage your website connections here.","premiumpress"),
						 
					),
					 
					
					"membership" => array(
					
						"name" => __("Membership","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "user-circle",
						"path" => 'mymembership',
						"desc" => __("Membership options, account upgrades and user add-ons can be found here.","premiumpress"),
					
					),
					 
					
					"orders" => array(
					
						"name" => __("Balance &amp; Invoices","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "invoice",
						"path" => 'orders',
						"desc" => __("View your account balance, invoices and recent withdrawals here.","premiumpress"),
					
					), 
					
					 
					
					"sellspace" => array(
					
						"name" => __("Advertising","premiumpress"),
						"desc" => "",
						"link" => "",
						"icon" => "advertising",
						"path" => 'sellspace',
						"desc" => __("Here you can manage your website banners and advertising.","premiumpress"),
					
					), 
					
					"details" => array(
						"name" => __("Settings","premiumpress"),
						"desc" => "",
						"path" => 'details',
						"icon" => "user-card",
						"link" => "",
						"desc" => "Nulla vitae elit libero pharetra augue dapibus. Nulla vitae elit libero.",
						
						"desc" => __("Contact details, email, password and other account details can be found here.","premiumpress"),
						 
					),
					
					);
					
					
					if(defined('THEME_KEY') && in_array(THEME_KEY,array("es")) ){
						
						if(get_user_meta($userdata->ID,'storeid', true) == ""){
							unset($accountitems['store']);
						}
						
					}else{
					
						unset($accountitems['store']);
					
					}
					
					 
					
					if(defined('THEME_KEY') && THEME_KEY != "so" ){
						unset($accountitems['downloads']);					
					}
					
					if(defined('THEME_KEY') && THEME_KEY != "da"){
						unset($accountitems['likes']);					
					}
					
					if(defined('THEME_KEY') && THEME_KEY == "da" && !in_array(_ppt(array('user','likes')), array("","1")) ){
					unset($accountitems['likes']);
					} 
					
					
					if(defined('THEME_KEY') && !in_array(THEME_KEY,array("cp","cb"))){
						unset($accountitems['cashback']);										
					}else{
					
						if(in_array(THEME_KEY,array("cb")) || _ppt(array('cashback', 'enable' )) == '1'){
						}else{
						unset($accountitems['cashback']);
						}	
					}
					 
					 
					// LISTINGS
					if( $CORE->LAYOUT("captions","listings") ){ 
					 
					}else{
						unset($accountitems['listings']);
					}
					 
					
					
					// ADMIN ONLY
					if(defined('THEME_KEY') && THEME_KEY == "at" && _ppt(array('lst','adminonly')) == 1){
					
					unset($accountitems['listings']);
					
					}elseif( _ppt(array('lst','adminonly')) == 1){ 
					
					unset($accountitems['listings']);
					//unset($accountitems['offers']);
					
					}elseif( _ppt(array('lst','websitepackages')) == "0"){ 
					
					unset($accountitems['listings']);
					unset($accountitems['offers']);
					
					}
					 
				 
					// ONLY ONE LISTING	 
					/*
					if( isset($GLOBALS['accounttype']) && $GLOBALS['accounttype']['can_add_multiple'] == "1" ){	
					
					}else{				 
						unset($accountitems['listings']);
					}
					*/	
					 
					 			
					
					// MEMBERSHIPS					
					 if( $CORE->LAYOUT("captions","memberships") ){
					 	if(_ppt(array('mem','enable')) != 1){
							unset($accountitems['membership']);
						}
					 }else{
					 unset($accountitems['membership']);
					 }
					
					// MESSAGES
					if(_ppt(array('user','account_messages')) != 1){
					unset($accountitems['messages']);
					} 
					
					// COMMENTS
					if(_ppt(array('user','comments')) == 0){
					unset($accountitems['comments']);
					} 
					
					// FRIENDS
					 
					if(_ppt(array('user','friends')) == "0" || in_array(THEME_KEY, array("sp","cp","cb","cm")) ){
					unset($accountitems['friends']);					
					}
					
					// FAVS
					if(_ppt(array('user','favs')) != 1){
					unset($accountitems['favs']);
					} 
					
					// INVOICES
					if(_ppt(array('user','orders')) == "0"){
					unset($accountitems['orders']);
					} 
					
					// ADVERTISING
					if(_ppt(array('sellspace','enable')) != 1){
					unset($accountitems['sellspace']);
					}
					
					
				
					
					if(THEME_KEY == "sp"){
					 
					unset($accountitems['offers']);
					unset($accountitems['listings']);
					unset($accountitems['membership']);
					
					}
					
					if( in_array(THEME_KEY, array("vt","cm")) || $CORE->LAYOUT("captions","offers") == ""){
					 
					unset($accountitems['offers']);
					 	
					}
					
					
					// EXTRAS
					if(THEME_KEY == "jb" && in_array($GLOBALS['accounttype']['key'],array("subscriber")) ){ //
					
						$accountitems['resume'] = array(						
							"name" => __("My Resumes","premiumpress"),
							"desc" => __("Here you can upload and manage your resumes used when applying for jobs.","premiumpress"),
							"link" => "",
							"icon" => "briefcase",
							"path" => 'resume',
						); 	
						 
					}
					
					 
					if(_ppt(array('paywall','enable')) == "1" && _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'enable')) == "1" && _ppt(array('paywall_'.$GLOBALS['accounttype']['key'], 'price'))){
					
						$accountitems['paywall'] = array(						
							"name" => __("Membership","premiumpress"),
							"desc" => __("Here you can manage your membership access.","premiumpress"),
							"link" => "",
							"icon" => "user-circle",
							"path" => 'paywall',
						);
					
					}
					
					
					// HIDE INTERVIEWS/ SINGLE OFFER
					if(_ppt(array('design','single-offers')) == "0"){
							unset($accountitems['offers']);
					} 
					
				 

					return $accountitems;
			
			
			} break;

			
			
		}
	}


function image_avatar($avatar, $id_or_email, $size, $default){ global $wpdb;
	 
	 	// GET USERID
		if(is_object($id_or_email)){
			if(isset($id_or_email->ID))
				$id_or_email = $id_or_email->ID;
			//Comment
			else if($id_or_email->user_id)
				$id_or_email = $id_or_email->user_id;
			else if($id_or_email->comment_author_email)
				$id_or_email = $id_or_email->comment_author_email;
		}
		
		$userid = false;
		if(is_numeric($id_or_email))
			$userid = (int)$id_or_email;
		else if(is_string($id_or_email))
			$userid = (int)$wpdb->get_var("SELECT ID FROM $wpdb->users WHERE user_email = '" . esc_sql($id_or_email) . "'");
		
		// FALLBACK IF NOT AVATAR
		if(!$userid){ return $avatar; }
		
		// CHECK IF ISSET
		$userphoto = get_user_meta($userid,'userphoto',true);
		 
		if(is_array($userphoto) && isset($userphoto['path'])){
			return "<img src='".$userphoto['img']."' class='avatar img-fluid userphoto' alt='image' />";
			
		}elseif(get_user_meta($userid,'myavatar',true) != ""){
		
		return "<img src='".CDN_PATH."images/avatar/".get_user_meta($userid,'myavatar',true).".png' class='userphoto useravatar img-fluid'>";
		}else{
			return str_replace('avatar ','avatar img-fluid userphoto img-fluid ',$avatar);
		}
}

  
 
	
 	/* =============================================================================
	Membership functions
	========================================================================== */

function get_subscription($uid){

	$f = get_user_meta($uid, 'ppt_subscription',true);
	
	return $f;

}
 
  
 

/* =============================================================================
	SOCIAL LOGIN
	========================================================================= */
	

function sociallogin(){ global $CORE;

if(isset($_GET['oauth_token']) && !isset($_GET['sociallogin'])){
$_GET['sociallogin'] = "Twitter";
}
 

if( isset($_GET['sociallogin']) && $_GET['sociallogin'] && in_array($_GET['sociallogin'] ,array("Facebook","Twitter","LinkedIn","Google") ) ) { 

 			 
			$pp = trim($_GET['sociallogin']); 
	 
			// LOAD DEFAULT
			$core_admin_values = get_option("core_admin_values");
			
			// CHECK TO MAKE SURE ITS ENABLED
			if(_ppt(array('register','sociallogin')) != 1){
			die('social login disabled');
			}		
		 	 
			require_once( get_template_directory()."/framework/Hybridauth/autoload.php" );
			
			//First step is to build a configuration array to pass to `Hybridauth\Hybridauth`
			$config = [
				//Location where to redirect users once they authenticate with a provider
				'callback' => home_url().'/wp-login.php?sociallogin='.$_GET['sociallogin'],
			
				//Providers specifics
				'providers' => [
					'Twitter' => [ 
						'enabled' => true,     //Optional: indicates whether to enable or disable Twitter adapter. Defaults to false
						'keys' => [ 
							'key'    => _ppt('social_twitter_key1'), //Required: your Twitter consumer key
							'secret' => _ppt('social_twitter_key2')  //Required: your Twitter consumer secret
						]
					],
					
					'Google'   => [
						'enabled' => true, 
						'keys' => [ 
						'id'  =>  _ppt('social_google_key1'), 
						'secret' => _ppt('social_google_key2'), ] 
					], 
					
					'Facebook' => [
						'enabled' => true, 
						'keys' => [ 
							'id'  =>  _ppt('social_facebook_key1'), 
							'secret' => _ppt('social_facebook_key2'), 
						] 
					],
					
					'Linkedin' => [
						'enabled' => true, 
						'keys' => [ 
							'id'  =>  _ppt('social_linkedin_key1'), 
							'secret' => _ppt('social_linkedin_key2'), 
						] 
					],	
									
				] 				
			];
			
			if($pp == "Twitter"){
			$config['callback'] = home_url()."/wp-login.php"; //.'?sociallogin='.$_GET['sociallogin'];
			}
			 
			try{
				//Feed configuration array to Hybridauth
				$hybridauth = new Hybridauth($config);
			 
				//Attempt to authenticate users with a provider by name
				$adapter = $hybridauth->authenticate( $_GET['sociallogin'] ); 
				 
				//Returns a boolean of whether the user is connected with Twitter
				$isConnected = $adapter->isConnected();
			 
				//Retrieve the user's profile
				$userProfile = $adapter->getUserProfile();	
				 	
				if (empty( $userProfile )) {
					header("location: ".wp_login_url()."&social_error=1");
					exit();
				}
			 	
				// GET EMAIL
				$email = $userProfile->email;
				
				// GET IDENTIFIER
				$identifier = $userProfile->identifier;	
				
				// CHECK IF WERE ALREADY LOGGED IN							
				$founddata = $CORE->USER("check_identifier_exists", $identifier );
				
				//die(print_r($founddata)."--".$identifier); //
				
				if ( ( is_array($founddata) && !empty($founddata) ) || ($email != "" && email_exists( $email ) )  ) {
					
					 
						if(is_array($founddata) && !empty($founddata)){
							$huser = get_user_by( 'email', $founddata['user_email'] );
						}else{
							$huser = get_user_by( 'email', $email );						
						}
						
						 
						// CREATE NEW PASSWORD
						$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
						
						// UPDATE ACCOUNT WITH NEW PASS
						$data = array();
						$data['user_pass'] 		= $random_password;					
						$data['ID'] 			= $huser->data->ID;
						wp_update_user( $data );
						
						// UPDATE IDENTIFIER
						update_user_meta($huser->data->ID, 'sociallogin_identifier', $identifier); 
					 
						// LOGIN						 
						$ff = $this->USER_LOGIN($huser->data->user_email, $random_password );
								
						// REDIRECT
						header("location: ". _ppt(array('links','myaccount')) );
						exit();	
					 
				} 
				 
				
				//Disconnect the adapter 
				$adapter->disconnect();
				 
				$fname = $userProfile->firstName;
				$lname = $userProfile->lastName;
				$dname = $userProfile->displayName;
				
				$photo = $userProfile->photoURL; 
				
				if($email == ""){
				die("Could not get your email address. Please register using the standard registration form.");
				}
				
				// DISPLAY NAME
				if($dname == ""){
					$gg = explode("@", $email);
					$newusername = $gg[0].date('s');
				}else{
					$newusername = $dname;
				}
				
				// CHECK IF USERNAME EXISTS
				if ( username_exists( $newusername ) ){
				$newusername = $newusername."1";
				}
				
				$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$_POST['password'] = $random_password;
						
				// CREATE NEW USER
				$errors = $CORE->USER_REGISTER($newusername, $random_password, $email, 1, 0, 0 );	
						 
				// IF HAS ERRORS					 
				if ( is_wp_error($errors) ) {
							echo '<h4>' . $errors->get_error_message() . '</h4>';
							die();	
				}				
					
				// SET USER ONLINE			
				$this->USER("set_online", $errors->data->ID);		
				 		
				// UPDATE USER DATA
				if(strlen($photo) > 1){
						update_user_meta($errors->data->ID, 'ppt_userphoto',$photo);
				}
					
				// SETUP DEFAULT MEMBERSHIP
				if( $CORE->LAYOUT("captions","memberships") ){ 
					 					
					$sd = $CORE->USER("get_this_membership",_ppt(array('mem','regmembership')));						
					if(is_array($sd)){
					
						// REQUIRED APPROVAL?
						$app = 1;
						if( _ppt(_ppt(array('mem','regmembership')).'_approval') == '1'){
						$app = 0;
						}
					
						update_user_meta( $errors->data->ID ,'ppt_subscription', 
							array(
								"key" => _ppt(array('mem','regmembership')), 
								"date_start" => date("Y-m-d H:i:s"), 
								"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$sd['days']." days")),
								"approved" 		=> $app,
								 
							)
						);
					}
				}
				 	
				// EXTRA
				$data['ID'] 				= $errors->data->ID;
				$data['first_name'] 		= strip_tags($fname);
				$data['last_name'] 			= strip_tags($lname);							
				wp_update_user( $data );
					
				// ADD ON IDENIFIA
				update_user_meta($errors->data->ID, 'sociallogin_identifier', $identifier);
				
				// LOGIN LANGUAGE
				if(_ppt(array('lang','switch')) == "1" && is_array(_ppt('languages')) && !empty(_ppt('languages'))  ){
				
					$u_lang = "";
					$avlangs = _ppt('languages');
					if(!empty($avlangs) && count($avlangs) == 1){
						$u_lang = $avlangs [0];
					}else{
						$u_lang = get_user_meta($errors->data->ID,'language',true);
					} 
				 	
					if($u_lang != ""){
					$u_lang = "?l=".$u_lang;
					}
					
				} 
				 
						
				// REDIRECT
				header("location: ". _ppt(array('links','myaccount')).$u_lang );
				exit();
			 
			
				
			}
			catch(\Exception $e){
				echo '<h4>' . $e->getMessage() . '</h4>';
				die();
			}
		 
		 	
		
	}

}
  

/*
	this function displays the 
	registration fields for users
*/
function user_fields($userid = ""){ $taborder = 10; $string = "";
	
	if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
	$userid = $_GET['eid'];
	}
	
	$regfields = get_option("regfields");
 	 
	if(is_array($regfields) && !empty($regfields)){
		
		$i = 0;
		if(!is_array($regfields['name'])){
		return;
		}
		foreach($regfields['name'] as $data){  
		
			if(isset($regfields['name'][$i]) && strlen($regfields['name'][$i]) > 2 ){
			
			// IF IS USER GET VALUE
			$value = "";
			if(is_numeric($userid) && ( isset($GLOBALS['flag-account']) || is_admin()) ){
			 
				$value = get_user_meta($userid, $regfields['key'][$i], true);	
			 
			} 
			  
			// COL BREASK
			$col0 = "col-md-6 form-group";
			$col1 = "col-md-12";
			$col2 = "col-md-12";
			
			if(isset($GLOBALS['flag-account'])){
			$col0 = "col-md-6 form-group";
			$col1 = "";
			$col2 = "";
			}
			
			// REQUIRED
			if(!isset($regfields['required'][$i])){ $regfields['required'][$i] = 0; }
			
			// SWITCH FOR TAXONOMY
			if($regfields['type'][$i] == "tax"){
			$regfields['values'][$i] = $regfields['tax_name'][$i];
			
			}elseif($regfields['type'][$i] == "post_type"){
			$regfields['values'][$i] = $regfields['posttype_name'][$i];
			}
			
			
			
			if( isset($GLOBALS['flag-register']) && isset($regfields['signup'][$i]) && $regfields['signup'][$i] == 0 ){
			
			  
			
			}else{		 	 
				
				ob_start();
				?>
                <div class="<?php echo $col0; ?> ">
                
                <?php if(!isset($GLOBALS['flag-account'])){ ?><div class="row"><?php } ?>
             	
                
                <?php if(!isset($GLOBALS['flag-register'])){ ?>
                
                    <div class="<?php echo $col1; ?>">
                    
                        <label class="col-form-label">
                        
                            <?php echo stripslashes($regfields['name'][$i]); ?>
                            
                            <?php if($regfields['required'][$i] == 1){ ?>
                            <span class="text-danger">*</span>
                            <?php } ?>
                        
                        </label>                 
                    
                    </div>
                    
                    <?php } ?>
                    
                    <div class="<?php echo $col2; ?>">
            	     
                     <?php if(!isset($regfields['values'][$i])){ $regfields['values'][$i] = ""; } ?>
                     
                     
                    <?php echo  $this->fieldtype($regfields['type'][$i], $regfields['key'][$i], $regfields['values'][$i], $taborder, $value, $regfields['required'][$i], $regfields['name'][$i]); ?>
                    
                    </div> 
                    
                    <?php if(!isset($GLOBALS['flag-account'])){ ?></div><?php } ?>                   
              
                </div>
                <?php
		 		$string .= ob_get_clean(); 
			}
				
				 
				
				$taborder++;		
		
		
			} // is blank name			
		$i++; 
		} // end foreach
	
	} // end is array	
	
	return $string;
	
}

function fieldtype($type, $key, $value = "", $taborder = 1, $user_value = "", $required = 0, $label = ""){ global $wpdb, $userdata;
	
	// IF REQUIRED ADD ON EXTRA CLASS
	$eclass = "";

	if($required != 0 && ( $required == 1 || $required == "yes" ) ){
	$eclass = "required-field";
	}
	
	 
	// DEFAULT VALUE
	if($user_value == "" && $value != ""){ // && !isset($_GET['eid']) 
	$user_value = $value;
	}
	
	ob_start();
	switch($type){
	
	
	 	case "time": { 
		if($user_value == ""){ $user_value = date('Y-m-d H:i:s'); }
		$db = explode(" ",$user_value);			
		
		?>
         
 
		<div class="row">
        <div class="col-md-12">
            <div class="input-group date ppt-datepicker" data-target="#field-<?php echo $key; ?>-date" id="field-<?php echo $key; ?>-date">
                    
            <input type="text"        
            name="custom[<?php echo $key; ?>]" 
            tabindex="<?php echo $taborder; ?>"  
            value="<?php echo esc_attr( $user_value ); ?>"  
            class="form-control <?php echo $eclass; ?>">
            
            <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;">
                        <span class="fal fa-calendar"></span>
                    </span>
            </div>
              
		</div>
        </div> 
        
		<?php 
		} break;
	
	
		case "date": { 
		if($user_value == ""){ $user_value = date('Y-m-d H:i:s'); }
		$db = explode(" ",$user_value);			
		
		?>
         
 
 
 
 
		<div class="row" <?php if(is_admin()){ ?>style="margin:-5px;"<?php } ?>>
        <div class="col-md-12">
            <div class="input-group  date ppt-datepicker" data-target="#field-<?php echo $key; ?>-date1" id="field-<?php echo $key; ?>-date1">
            
         
  
            <input type="text"        
            name="custom[<?php echo $key; ?>]" 
            tabindex="<?php echo $taborder; ?>"  
            value="<?php echo esc_attr( $user_value ); ?>"  
            class="form-control <?php if(is_admin()){ ?>hasaddon<?php }else{ ?>rounded-0 <?php echo $eclass; ?> <?php } ?>"  
            >
            
             <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;">
                        <span class="fal fa-calendar"></span>
                    </span>
            </div>
		</div>
        </div> 
        
		<?php 
		} break;
		
		case "post_type": {
		 
	   
		   $SQL = "SELECT DISTINCT ID, post_title 
		   FROM ".$wpdb->prefix."posts
		   WHERE ".$wpdb->prefix."posts.post_status = 'publish' 
		   AND ".$wpdb->prefix."posts.post_type = '".$value."'
		   ORDER BY ".$wpdb->prefix."posts.post_title ASC
		   LIMIT 100"; 
			 
			$results = $wpdb->get_results($SQL); 
				 				 
			if(count($results) > 0 && !empty($results) ){
			?>
            <select class="form-control <?php echo $eclass; ?>" name="custom[<?php echo $key; ?>]" tabindex="<?php echo $taborder; ?>">
        	<option></option>
			<?php foreach ($results as $val){
				
				// SETUP SELECTED VALUE
               if($user_value == $val->ID){ $b = "selected=selected"; }else{ $b= ""; }
			
			?>			
            <option value="<?php echo $val->ID; ?>" <?php echo $b; ?>><?php echo $val->post_title; ?></option>
            <?php } ?>
            
	    	</select>
            
            <?php } ?>
            
        
        <?php		
		} break;
		
		case "tax": {
 
		
			$terms = get_terms($value,'hide_empty=0&parent=0');
			$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
			 
			 
			if( !isset($terms->errors) && count($terms) > 2){	
		?>
        
        <select class="form-control <?php echo $eclass; ?>" name="custom[<?php echo $key; ?>]" tabindex="<?php echo $taborder; ?>">
        <option></option>
		<?php  
		foreach ( $terms as $term_inn ) {
              
			   // SETUP SELECTED VALUE
               if($user_value == $term_inn->term_id){ $b = "selected=selected"; }else{ $b= ""; }
                                    
                 echo "<option value='".$term_inn->term_id."' ".$b."> " . $term_inn->name . " (".$term_inn->count.") </option>";
				 
		}
         ?>
         
        </select>
        
        <?php } ?>
        
        <?php	
			
		} break;
		
		case "percentage": {
		
		 
		 ?>	
        	
		<div class="row">
        <div class="col-md-12">
            <div class="input-group">
            	<span class="input-group-prepend"><span class="input-group-text">%</span></span>
                <input type="text" name="custom[<?php echo $key; ?>]" maxlength="255"  class="form-control val-numeric <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>"  value="<?php echo esc_attr( $user_value ); ?>" id="field-<?php echo $key; ?>" />                
            </div>
		</div>
        </div> 
        
         <script>
		jQuery( "#field-<?php echo $key; ?>" ).change(function() {	   
			jQuery( "#field-<?php echo $key; ?>" ).val( jQuery( "#field-<?php echo $key; ?>" ).val().replace(',', '') );	  
		});
		</script>
        
		<?php 
		} break;
		
		case "price": {
		
		 
		 ?>	
        	
		<div class="row">
        <div class="col-md-12">
            <div class="input-group">
            	<span class="input-group-prepend"><span class="input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fal") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span></span>
                <input type="text" name="custom[<?php echo $key; ?>]" maxlength="255" placeholder="0"  class="form-control numericonly <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>"  value="<?php echo esc_attr( $user_value ); ?>" id="field-<?php echo $key; ?>" />                
            </div>
		</div>
        </div> 
        
         <script>
		jQuery( "#field-<?php echo $key; ?>" ).change(function() {	   
			jQuery( "#field-<?php echo $key; ?>" ).val( jQuery( "#field-<?php echo $key; ?>" ).val().replace(',', '') );	  
		});
		</script>
        
		<?php 
		} break;
	
		case "input": { 
		
		 
			// CLEAR VALUE ON REGISTER PAGE
			if(!isset($GLOBALS['flag-account']) && !is_admin() &&  !isset($GLOBALS['flag-add'])  ){
				$user_value = ""; $value = "";
			}
		?>
        
      
        <input type="input" <?php if(isset($GLOBALS['flag-register'])){ ?>placeholder="<?php echo $label; ?>"<?php } ?> name="custom[<?php echo $key; ?>]" class="form-control <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>" value="<?php echo esc_attr( $user_value ); ?>"  id="field-<?php echo $key; ?>" />
       
		
        <?php
		} break;
		
		case "textarea": { 
		?>
        <textarea <?php if(isset($GLOBALS['flag-register'])){ ?>placeholder="<?php echo $label; ?>"<?php } ?> name="custom[<?php echo $key; ?>]" rows="10" class="form-control <?php echo $eclass; ?> height:100px" style=" height:100px !important;" tabindex="<?php echo $taborder; ?>" id="field-<?php echo $key; ?>"><?php echo esc_textarea($user_value); ?></textarea>
		<?php
        } break;	
		
		case "select": {
		
		if(is_array($value)){
		$options = $value;
		}else{
		$options = explode( PHP_EOL, $value );
		}
		 
		?> 
        
        
        <?php if(isset($GLOBALS['flag-register'])){ ?><div class="mb-2 small"><?php echo $label; ?></div><?php } ?>
		<select name="custom[<?php echo $key; ?>]" class="form-control <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>"  id="field-<?php echo $key; ?>">	
           
        <?php if($required != 0 && ( $required == 1 || $required == "yes" ) ){ ?>
        <option value=""></option>
        <?php } ?>
        
		<?php if(is_array($options)){ foreach($options as $key => $val){
					
					$val = trim($val);
					
					if($user_value == $key){?>
					<option value="<?php echo $key; ?>" selected=selected><?php echo $val; ?></option>
                    <?php }else{ ?>
					<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                    <?php 
					}
			} }// end foreach
		?>
		</select>
        
        
        <?php 
		} break;
		case "checkbox":
		case "radio": { 
		
		if(is_array($value)){
		$options = $value;
		}else{
		$options = explode( PHP_EOL, $value );
		}
		
		 
		?>
        <div class="form-check pl-0">
        <div class="container pl-0">
        <div class="row">
        
         
        <?php
		if(is_array($options)){ foreach($options as $k => $val){ ?>
        
        <div class="col-md-6">
        
        <?php
				 
					$val = trim($val);
		 			
					
					if($k != "" && !is_numeric($k) ){
					
						if(is_array($user_value) && in_array($k, $user_value)){?> 
                        
                        
						<label class="<?php echo $type; ?> custom-control custom-checkbox">
						<input type="<?php echo $type; ?>" class="form-control custom-control-input" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $k; ?>" checked=checked>
						<span class="custom-control-label"></span>
                        <?php echo $val; ?>
                        </label>
						<?php }else{ ?>
						<label class="<?php echo $type; ?> custom-control custom-checkbox">
						<input type="<?php echo $type; ?>" class="form-control custom-control-input" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $k; ?>">
						<span class="custom-control-label"></span>
                        <?php echo $val; ?>
                        </label>				 
						<?php
						}

					 
					}else{
					
						if(is_array($user_value) && in_array($val, $user_value)){?> 
						<label class="<?php echo $type; ?> custom-control custom-checkbox">
						<input type="<?php echo $type; ?>" class="form-control custom-control-input" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $val; ?>" checked=checked>
						<span class="custom-control-label"></span>
                        <?php echo $val; ?>
                        </label>
						<?php }else{ ?>
						<label class="<?php echo $type; ?> custom-control custom-checkbox">
						<input type="<?php echo $type; ?>" class="form-control custom-control-input" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $val; ?>">
						<span class="custom-control-label"></span>
                        <?php echo $val; ?>
                        </label>				 
						<?php
						}
					
					}
					
			?>
            </div><!-- end col 6 -->
            <?php		
					
					
			} }// end foreach
 		?>
         </div>
        </div>
        </div>
        <?php
		} break;
	
	}
	return ob_get_clean(); 
}


 
 
	/*
		this function gets the users
		feedback rating and vote count
	*/
	 


	/*
	this function counts the users
	posts with/without membership
	*/
	function count_user_posts_by_type( $userid, $post_type = 'post', $EXTRA = "", $include_membershipdate = true ) {
		global $wpdb, $userdata;
	
		$where = get_posts_by_author_sql( $post_type, true, $userid );
		
		// CHECK IF USER IS ASSIGNED TO A MEMBERSHIP AND SO ONLY COUNT LISTINGS AFTER THEIR MEMBERSHIP WAS ASSIGNED
		if($userid == $userdata->ID && $include_membershipdate){
			
			$mem_startdate = get_user_meta($userid, 'ppt_membership_started', true);
			if(strlen($mem_startdate) > 1){
				$where .= " AND post_date > '".$mem_startdate."'";
			}
		
		}
		
		// ADD IN PENDING LISTINGS TOO
		
		$where = str_replace("post_status = 'publish'","post_status = 'publish' OR post_status = 'pending'", $where);
	 
		$count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix."posts $where $EXTRA" );
		
	 
		return apply_filters( 'get_usernumposts', $count, $userid );
	}
	
 
 


	// NEEDS REDOING
	function user_feedback_exists($postid, $userid){ global $wpdb;
	
		if(!is_numeric($postid)){ return false; }
	
		// CHECK IF WE HAVE ALREADY LEFT FEEDBACK FOR THIS USER + ITEM
		$SQL = "SELECT ".$wpdb->postmeta.".post_id, ".$wpdb->posts.".post_author, ".$wpdb->postmeta.".meta_value FROM ".$wpdb->postmeta." 
					INNER JOIN ".$wpdb->posts." ON ( ".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID  AND ".$wpdb->posts.".post_author='".$userid."' )
					WHERE ".$wpdb->postmeta.".meta_key = 'pid' AND ".$wpdb->postmeta.".meta_value= ('".$postid."') AND ".$wpdb->posts.".post_type = 'ppt_feedback' LIMIT 0,100";
	 
		$result = $wpdb->get_results($SQL);
		 
		if(empty($result)){
			return false;
		}else{
			return true;
		}
			 
	}
	
 
	/*
		This function gets the users membership
		name for the icon
	
	*/
	function user_membership_name($userid){ global $userdata;
	
		 
		$cm	 = get_user_meta($userid,'ppt_subscription',true);			 
		
		if(is_array($cm) && !empty($cm['key']) ){
		
		return $this->get_subscription_name($userid)." ".__("membership","premiumpress");
			
		}else{
			return __("Member","premiumpress");
		} 
	
	}
	/*
		This function gets the users favorties list
		data
	
	*/
	function user_favs($userid = ""){ global $CORE, $userdata, $wpdb; 
	
	$extn = "_list";
	if(defined('WP_ALLOW_MULTISITE')){
		$extn .= get_current_blog_id();
	}						 
	$my_list = get_user_meta($userid, 'favorite'.$extn,true);	
	if(!is_array($my_list)){ $my_list = array(); }
	return $my_list;
						
						
	}
	
 

	/*
		This function gets a list of recently viewed posts
		and updated the users recently viewed list
	
	*/
	function user_recentlyviewed($userid = "", $postid = "", $get = false){ global $post, $userdata, $wpdb;
	
		if(isset($GLOBALS['done_recentlyviewed'])){ return;}
		$GLOBALS['done_recentlyviewed'] = true;
	 
		$recent = get_user_meta($userid, "recentlyviewed",true);		
		
		if(!is_array($recent)){ $recent = array(); } 
		
		// REMOVE DUPLICATES
		$recent = array_unique($recent);
		 
		if($get){
		  
			return $recent ;
		  
		}else{
			
			// RESET
			if(count($recent) > 20){
			update_user_meta($userid, "recentlyviewed", "");
			}
			
			$recent[$post->ID] 	= $post->ID;		
			 
			update_user_meta($userid, "recentlyviewed", $recent);		
		}
	
	}

	/*
		This function gets a list of posts
		by a single user.	
	*/
	function user_posts($userid = "1", $limit = 100, $status = "publish"){ global $wpdb;
	
	
		if(!is_numeric($userid)){ return false; }
 
		$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts." 
		WHERE ".$wpdb->posts.".post_author='".$userid."' 
		AND ".$wpdb->posts.".post_type = 'listing_type' 
		AND ".$wpdb->posts.".post_status = '".$status."' 
		ORDER BY ".$wpdb->posts.".post_date 
		DESC LIMIT ". $limit;
	 
		$result = $wpdb->get_results($SQL);
	 
		 
		if(empty($result)){
			return false;
		}else{
			return $result;
		}	
	
	}
	
 


 

	/* =============================================================================
	  PAGE ACCESS
	   ========================================================================== */
	
	function Authorize() {
	 
		global $wpdb, $post;
	
		$user = wp_get_current_user();
		if ( $user->ID == 0 ) {
			nocache_headers();
			
			if(_ppt(array('links','login')) != ""){
			wp_redirect(_ppt(array('links','login')) . '?noaccess=1&redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
			}else{
			wp_redirect(get_option('siteurl') . '/wp-login.php?noaccess=1&redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
			}
			
			exit();
		}
	}


	/* =============================================================================
		  LOGIN FUNCTION 
		========================================================================== */
		
	function LOGIN() { global $pagenow;
	
	  // GOOGLE RECAPCTURE
		   if(_ppt(array('captcha','enable')) == 1 && _ppt('captcha','sitekey') != ""){
		   
			   wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
			 
		   }
	
		
	// FIX FOR ELEMENTOR STYLES NOT SHOWING
	if(defined('ELEMENTOR_VERSION') && _ppt(array('pageassign','header')) != ""){ 
	
			if( substr(_ppt(array('pageassign','header')),0,9) == "elementor"){
			 
			//wp_register_style( 'e1', home_url().'/wp-content/uploads/elementor/css/global.css');	 
			//wp_enqueue_style( 'e1' );
			
			if(defined('ELEMENTOR_PRO_VERSION')){
			wp_register_style( 'e2', home_url().'/wp-content/plugins/elementor-pro/assets/css/frontend.min.css');	 
			wp_enqueue_style( 'e2' );
			}
	  
		}	
	}
	 
	if(!isset($_GET["action"])){ $_GET["action"] =""; }
	 
		switch($_GET["action"]) {
				case 'lostpassword' :
				case 'retrievepassword' :
					$GLOBALS['flag-password'] = true;
					$this->_show_password(); 
					break;
				case 'register': {
					$GLOBALS['flag-register'] = true;			
					$this->_show_register();
				} break;
				case 'resetpass':
				case 'rp': {
					$GLOBALS['flag-resetpassword'] = true;
					$this->_show_resetpass();
				} break;
			 
				case 'login':
				default: {
					$GLOBALS['flag-login'] = true;			
					$this->_show_login();				
				} break;
				
				
		}
		die();
	} // END LOGIN	
	
 
	
	function _show_resetpass(){
	
	global $CORE, $wp_error; $string = ""; 
	
	 /*	
		// CHECK FOR RESET
		if(isset($_GET['key']) && isset($_GET['login']) ){
		
			$user = check_password_reset_key($_GET['key'], $_GET['login']); 		
		  
			if ( is_wp_error($user) ) {
				wp_redirect( site_url('wp-login.php?action=lostpassword&error=invalidkey') );
				exit;
			}
		
			$errors = new WP_Error();
		
			if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
				$errors->add( 'password_reset_mismatch', 'The passwords do not match.'  );
		
			do_action( 'validate_password_reset', $errors, $user );
		
			if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
				reset_password($user, $_POST['pass1']);
				wp_redirect( site_url('wp-login.php?action=login') );
				exit;
			}
		
			wp_enqueue_script('utils');
			wp_enqueue_script('user-profile');
			
			// CHECK FOR ERRORS		
			if(isset($_POST['pass1'])){
			$string .= $this->_show_errors($errors);
			} 
		
		}// end check
		
		// LOAD IN PAGE TEMPLATE
		_ppt_template( 'page', 'reset' );
		
		*/
	 
	}
	
	function _show_password(){ global $CORE, $errortext, $wpdb;
	
		if ( isset($_POST['user_login']) && $_POST['user_login'] ) {
			 	
			$errors = new WP_Error();
		 	 
			if(!function_exists('retrieve_password')){
				//include(str_replace("wp-content","",WP_CONTENT_DIR)."/wp-includes/user.php");
				$errors = $this->retrieve_password1();	
			}else{
				$errors = retrieve_password();	
			}
		 
			 
			// ADD LOG ENTRY AND REDIRECT USER
			if ( !is_wp_error($errors) ) {
				 
				// CONFIRM
				wp_redirect('wp-login.php?checkemail=confirm');
				exit();
			}else{
			
			$errortext = $this->_show_errors($errors); 
			
			}
			
			do_action('lostpassword_post');
			
		}
		
		// CHECK FOR ERRORS
		if ( isset($_GET['error']) && $_GET['error'] == 'invalidkey'   ){
			$errors = new WP_Error();
			
			$errors->add('invalidkey', __("Sorry, that key does not appear to be valid.","premiumpress"),'cp');
			$errors->add('registermsg', __("Please enter your username or e-mail address. You will receive a new password via e-mail.","premiumpress"), 'message');
			
			
		}
	 
		if(!isset($_POST['user_login'])){ $_POST['user_login']=""; }
		
		if(!isset($errors)){ $errors=""; }
	 
		if(isset($_POST['user_login'])){ $errortext = $this->_show_errors($errors); }
	 	
		// LOAD IN PAGE TEMPLATE
		_ppt_template( 'page', 'forgottenpassword' );
	
	} 
	
	
	function retrieve_password1() {
	
    $errors = new WP_Error();
	 
    if ( empty( $_POST['user_login'] ) || ! is_string( $_POST['user_login'] ) ) {
       
	    $errors->add( 'empty_username', __( 'Enter a username or email address.','premiumpress') );
  
    } elseif ( strpos( $_POST['user_login'], '@' ) ) {
        
		$user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
		 
        
		if ( empty( $user_data ) ) { 
		
            $errors->add( 'invalid_email', __( 'There is no account with that username or email address.','premiumpress') );
        }
		
		
    } else {
        $login     = trim( $_POST['user_login'] );
        $user_data = get_user_by( 'login', $login );
    }
 
    
    do_action( 'lostpassword_post', $errors );
 
    if ( $errors->has_errors() ) {
	 
        return $errors;
    }
 
    if ( ! $user_data ) {
	
	
        $errors->add( 'invalidcombo', __( 'There is no account with that username or email address.','premiumpress') );
        return $errors;
    }
 
    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key        = get_password_reset_key( $user_data );
 
    if ( is_wp_error( $key ) ) {
	
	
        return $key;
    }
 
    if ( is_multisite() ) {
        $site_name = get_network()->site_name;
    } else {
        /*
         * The blogname option is escaped with esc_html on the way into the database
         * in sanitize_option we want to reverse this for the plain text arena of emails.
         */
        $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    }
 
    $message = __( 'Someone has requested a password reset for the following account:','premiumpress' ) . "\r\n\r\n";
    /* translators: %s: site name */
    $message .= sprintf( __( 'Site Name: %s','premiumpress' ), $site_name ) . "\r\n\r\n";
    /* translators: %s: user login */
    $message .= sprintf( __( 'Username: %s','premiumpress' ), $user_login ) . "\r\n\r\n";
    $message .= __( 'If this was a mistake, just ignore this email and nothing will happen.','premiumpress' ) . "\r\n\r\n";
    $message .= __( 'To reset your password, visit the following address:','premiumpress' ) . "\r\n\r\n";
    $message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";
 
    /* translators: Password reset email subject. %s: Site name */
    $title = sprintf( __( '[%s] Password Reset','premiumpress' ), $site_name );
 
    /**
     * Filters the subject of the password reset email.
     *
     * @since 2.8.0
     * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
     *
     * @param string  $title      Default email title.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
 
    /**
     * Filters the message body of the password reset mail.
     *
     * If the filtered message is empty, the password reset email will not be sent.
     *
     * @since 2.8.0
     * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
     *
     * @param string  $message    Default mail message.
     * @param string  $key        The activation key.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
 
    if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
        wp_die( __( 'The email could not be sent.','premiumpress' ) . "<br />\n" . __( 'Possible reason: your host may have disabled the mail() function.','premiumpress' ) );
    }
 
    return true;
}
	
	function USER_LOGIN($username, $pass, $return = 0){ global $user, $CORE, $errortext; 
	
			$creds = array();
			$creds['user_login'] 	= $username;
			$creds['user_password'] = $pass;
			$creds['remember'] 		= true; 
			
			// CHECK FOR SEEL BUT ALSO CHECK USER SETUP
			if(strpos(get_option('siteurl'),"https") == false){	 //if ( is_ssl() && !force_ssl_admin() ){		
				$secure_cookie = '';
			}else{			
				$secure_cookie = true;
			} 
			
			// CHECK FOR EMAIL LOGIN
			if(strpos($creds['user_login'],"@") !== false){
			
				$e = get_user_by( 'email', $creds['user_login'] );
				if(is_object($e) && isset($e->data->user_login)){
				$creds['user_login'] = $e->data->user_login;
				}			 
			}
			
			// FIX FOR SHOPPING CART DROPPING SESSIONS DURING LOGIN
			if(isset($_SESSION['ppt_cart']) && is_array($_SESSION['ppt_cart'])){
			$cd = $_SESSION['ppt_cart'];			
			} 
			
			
			if( defined('WLT_DEMOMODE') ){
				$loginSkin =	$_SESSION['skin'];
				if($loginSkin == ""){
				$loginSkin = THEME_KEY."_style1a";
				}
			}	
	 
			$user = wp_signon($creds, $secure_cookie);
			
			//die(print_r($user));
			 
			// RESET 
			if(isset($cd)){
			$CORE->start_session();	
			$_SESSION['ppt_cart'] = $cd;			 
			}
			
			 
			// SEE IF LOGIN WAS SUCCESSFULL			
			if ( is_wp_error($user) ) {
			
				$err_codes = $user->get_error_codes();
				 	
				// Invalid username.
				// Default: '<strong>ERROR</strong>: Invalid username. <a href="%s">Lost your password</a>?'
				if ( in_array( 'invalid_username', $err_codes ) ) {
					return __("The login credentials you entered were incorrect.","premiumpress");
				}
			 
				if ( in_array( 'incorrect_password', $err_codes ) ) {
					return __("The login credentials you entered were incorrect.","premiumpress");
				}
				
				if ( in_array( 'invalid_email', $err_codes ) ) {
					return __("Unknown email address. Check again or try your username.","premiumpress");
				}
				 
				
						
				return $user->get_error_message();			
			
			}elseif ( !is_wp_error($user) ) {
			
			
				//CHECK FOR USER MEMBERSHIP DATA, IF ITS EXPIRED ASK THEM TO PAY AGAIN
				$membership_payment_due = get_user_meta($user->ID, 'ppt_membership_due', true);
			 
				if(is_numeric($membership_payment_due) && $membership_payment_due > 0){
					
					// LOG USER OUT
					wp_logout();
					
					// REDIRECT TO PAYMENT
					if($return){
					
					return home_url()."/wp-login.php?action=membership&uid=".$user->ID;
				 
					}else{
					
					header("location: ".home_url()."/wp-login.php?action=membership&uid=".$user->ID);
					exit();
					
					}
					
				}
				
				// ADD POPUP
				$CORE->ADVERTISING("popup_new", array("login", $user->ID ));
			
				// UPDATE LAST LOGINS				 					
				update_user_meta($user->ID, 'login_lastdate', current_time( 'mysql' ) );				 
				
				// LOGIN IP
				update_user_meta($user->ID, 'login_ip', $this->get_client_ip());
				
				// UPDATE LOGIN COUNT
				$ll = get_user_meta($user->ID, 'login_count', true);
				if(!is_numeric($ll)){ $ll = 0; }				
				$ll++;
				update_user_meta($user->ID, 'login_count', $ll);
				
				// SET USER ONLINE
				$this->USER("set_online",$user->ID);	
				
				// CLEAN-UP FAVS LIST
				$extn = "_list";
				if(defined('WP_ALLOW_MULTISITE')){
					$extn .= get_current_blog_id();
				}	
				$my_list = get_user_meta($user->ID, 'favorite'.$extn,true);
			 
				if(!is_array($my_list)){ $my_list = array(); }
				foreach($my_list as $hk => $hh){ if($hh == 0 || $hh == ""){ unset($my_list[$hk]); }elseif ( get_post_status ( $hh ) != 'publish'  && get_post_type( $hh ) != THEME_TAXONOMY."_type" ) {  unset($my_list[$hk]); } }			  
				update_user_meta($user->ID, 'favorite'.$extn, $my_list);			
				
				// ADMIN LINK
				$admin_link =  admin_url(); 
				
				// CHECK FOR EMAIL				
				$data = array(				 		
				"username" => $CORE->USER("get_name",$user->ID),			 
				); 	
				$this->email_system($user->ID, 'login', $data);
				
				
				// SET ALL USER LISITNGS TO ONLINE
				$CORE->USER("set_online_listings", $user->ID);
				 
				
				// SEND EMAIL
				$data1 = array(
					"user_id" 		=> $user->ID,
					"username" 		=> $CORE->USER("get_username", $user->ID),
					"first_name" 	=> $CORE->USER("get_first_name", $user->ID),
					"last_name" 	=> $CORE->USER("get_last_name", $user->ID),					 
					"email" 		=> $CORE->USER("get_email", $user->ID),
				);
				$CORE->email_system("admin", "admin_user_login", $data1);	
				
			 
				// REDIRECT USER TO ACCOUNT PAGE
				if(isset($_POST['redirect_to']) && strlen($_POST['redirect_to']) > 1 ){
									
					$redirect_to 		= $_POST['redirect_to'];
					
				}elseif( user_can($user->ID, 'administrator') || user_can($user->ID, 'contributor') ){	
					
					
					// GET SIDE LAND
					$lang =_ppt(array('lang','default'));
				 
					$redirect_to = $admin_link."admin.php?page=premiumpress&l=".$lang; 
					 
				}else{	
					
					  
					// LOGIN LANGUAGE 
					
					$u_lang = "";
					$avlangs = _ppt('languages');
					if(!empty($avlangs) && count($avlangs) == 1){
						$u_lang = $avlangs [0];
					}else{
						$u_lang = get_user_meta($user->ID,'language',true);
					} 
				 	
					if($u_lang != ""){
					$u_lang = "?l=".$u_lang;
					}
					 	
					if(isset($loginSkin)){
						if($u_lang == ""){
						$u_lang .= "?skin=".$loginSkin;
						}else{
						$u_lang .= "&skin=".$loginSkin;
						}
					}
						
					$redirect_to 		= _ppt(array('links','myaccount')).$u_lang;
				}
				 
				if($redirect_to == ""){ $redirect_to = get_home_url(); }
				 	
				// ADD LOG
				$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "user_login",							 
							"userid" 	=> $user->data->ID,											 
						)
				);
				 
			 	
				if($return){
				return $redirect_to;
				}else{
				header("location: ".$redirect_to);
				exit();
				}
				
			} 
			
	}
	
	
	function USER_REGISTER($user, $pass, $email, $savedata = array(), $return = 0 ){
 
		global $CORE, $wpdb; 
		
		
		  
		// REGISTER THE NEW USER			 
		$errors = wp_create_user( $user, $pass, $email ); 
		 
		// CHECK FOR ERRORS	 
		if ( is_wp_error($errors) ) {
		
				// TRANSLATION				
				if(isset($errors->errors['existing_user_email'])){
				 
				return __("Sorry, that email address is already used!","premiumpress");
				
				}elseif(isset($errors->errors['existing_user_login'])){
				
				return __("Sorry, that username already exists!","premiumpress");
				
				} 	
			
				return $errors->get_error_message();
		
		}else{   
		
			$GLOBALS['newuserID'] = $errors;
			
			// SAVE PASSWORD FOR EMAIL VERIFICAITON AUTO LOGIN
			if(_ppt(array('register', 'forcemailverify' )) == 1){
				update_user_meta($errors,'password_saved', $pass);
				
				update_user_meta($errors,'ppt_verified',0);
				   
				if(_ppt(array('register', 'photoverify' )) == 1){			 
				 update_user_meta($errors,'ppt_verified_photo',0);				 
				}
				 
				if(get_user_meta($order_data,'ppt_sms_verified',true) ==1){
				 update_user_meta($errors,'ppt_verified_photo',0);	
				}
				
			}
			
			// ADD-ON FIRST / LAST NAME	
			$fname = "";			 
			if(isset($savedata["first_name"]) && $savedata["first_name"] != "" ){
					$data = array();
					$data['ID'] 			= $errors;
					$data['first_name'] 	= esc_html(strip_tags($savedata["first_name"]));						 	
					wp_update_user( $data );
					$fname = $savedata["first_name"];
			}
			 			
			$lname = "";
			if(isset($savedata["last_name"]) && $savedata["last_name"] != "" ){
					$data = array();
					$data['ID'] 		= $errors;
					$data['last_name'] 	= esc_html(strip_tags($savedata["last_name"]));						 	
					wp_update_user( $data );
					$lname = $savedata["last_name"];
			} 
			
			 
			// CUSTOM FIELDS
			if(isset($savedata['custom']) && is_array($savedata['custom']) && !empty($savedata['custom']) ){
			  
				// GET LIST OF ACCEPTABLE KEYS
				$canAccept = array("mobile-prefix","mobile","user_type","da-seek1","da-seek2");
				$regfields = get_option("regfields"); 			
				if(is_array($regfields) && !empty($regfields['name']) ){ 
					$i=0;  
					foreach($regfields['name'] as $data){ 
						$canAccept[trim($regfields['key'][$i])] = trim($regfields['key'][$i]);
						$i++;
					}
				} 
			  
				foreach($savedata['custom'] as $kk => $vv){
					 
					// skip non-allowed keys
					if(!in_array($kk, $canAccept)){ 
					continue; 
					}
					
					if($vv != ""){
					 update_user_meta( $errors, $kk, $vv);
					 }
				}
			}
			
			 		
			// SETUP DEFAULT MEMBERSHIP
			if(_ppt(array('mem','regmembership')) != "" & strlen(_ppt(array('mem','regmembership'))) > 1){
					
					$sd = $CORE->USER("get_this_membership",_ppt(array('mem','regmembership')));
						
					if(is_array($sd) && isset($sd['duration']) ){
					
						// REQUIRED APPROVAL?
						$app = 1;
						if( _ppt(_ppt(array('mem','regmembership')).'_approval') == '1'){
						$app = 0;
						}
						
						$duration = $sd['duration'];
						if($duration == "0"){						
						$duration = 99999;
						}			
					
						update_user_meta( $errors ,'ppt_subscription', 
							array(
								"key" => _ppt(array('mem','regmembership')), 
								"date_start" 	=> date("Y-m-d H:i:s"), 
								"date_expires" 	=> date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$duration." days")),
								"listings" 		=> 0,
								"flistings" 	=> 0,
								"approved" 		=> $app,
							)
						);
					}					
			
			
			}else{
			
				if(is_numeric(_ppt('mem0_listings_count')) && _ppt('mem0_listings_count') > 0){ // DEFAULT FOR NON-MMEBERS
			
					update_user_meta($errors, "free_listings_count", _ppt('mem0_listings_count'));
					
				}
				
				
				if(is_numeric(_ppt('mem0_listings_max_count')) && _ppt('mem0_listings_max_count') > 0){ // DEFAULT FOR NON-MMEBERS					 
						
					update_user_meta($errors, "free_listings_max_count", _ppt('mem0_listings_max_count'));
					
				}
				
				if(is_numeric(_ppt('mem0_max_msg_count')) && _ppt('mem0_max_msg_count') > 0){ // DEFAULT MAX MESSAGES					 
						
					update_user_meta($errors, "max_msg_count", _ppt('mem0_max_msg_count'));
					
				}
				
				
			}
			
			
			
					
			// SETUP DEFAULT MEMBERSHIP FOR DATING THEME
			
			
			
			if(THEME_KEY == "da" && isset($savedata['tax']['dagender']) && _ppt(array('mem','regmembership_'.$savedata['tax']['dagender'])) != "" ){			
			
				$sd = $CORE->USER("get_this_membership",_ppt(array('mem','regmembership_'.$savedata['tax']['dagender'])));
				
				if(is_array($sd) && isset($sd['duration']) ){
							
							// REQUIRED APPROVAL?
							$app = 1;
							if( _ppt(_ppt(array('mem','regmembership_'.$savedata['tax']['dagender'])).'_approval') == '1'){
								$app = 0;
							}									
							
							update_user_meta( $errors ,'ppt_subscription', 
											array(
												"key" => _ppt(array('mem','regmembership_'.$savedata['tax']['dagender'])), 
												"date_start" => date("Y-m-d H:i:s"), 
												"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$sd['duration']." days")),
												"listings" => 0,
												"flistings" => 0,
												"approved" 		=> $app,
											)
							); 
						 
					} 
					
			}
			 
			// CUSTOM TYPE MEMBERSHIP			
			if( in_array(THEME_KEY, array("es","jb","mj","ll")) && isset($savedata['custom']['user_type']) && _ppt(array('usertype', $savedata['custom']['user_type'].'_mem')) != ""){
				
				$sd = $CORE->USER("get_this_membership", _ppt(array('usertype', $savedata['custom']['user_type'].'_mem')) );
				 
							 		
									if(is_array($sd) && isset($sd['duration']) ){
									
									
									// REQUIRED APPROVAL?
										$app = 1;
										if( _ppt(_ppt(array('usertype', $savedata['custom']['user_type'].'_mem')).'_approval') == '1'){
										$app = 0;
										}
										
										$duration = $sd['duration'];
										if($duration == "0"){						
										$duration = 99999;
										}
									
										update_user_meta( $errors ,'ppt_subscription', 
											array(
												"key" => _ppt(array('usertype', $savedata['custom']['user_type'].'_mem')), 
												"date_start" => date("Y-m-d H:i:s"), 
												"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$duration." days")),
												"listings" => 0,
												"flistings" => 0,
												"approved" 		=> $app,
											)
										);
									}	
			
			} 
			
			 				 				
					
				// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "user_registered",							 
								"userid" 	=> $errors,								
								"email_data" => array(	
									"user_id" 			=> $errors,			 		
									"username" 	=> $user,
									"first_name" 	=> $fname,
									"last_name" 	=> $lname,
									"password" 	=> $pass,
									"email" 	=> $email			 
								)			 
							)
				);
				
				// ADD LOG					
				$CORE->FUNC("add_log",
							array(				 
								"type" 		=> "user_verify",							 
								"userid" 	=> $errors,								
								"email_data" => array(	
									"user_id" 			=> $errors,			 		
									"username" 	=> $user,
									"first_name" 	=> $fname,
									"last_name" 	=> $lname,
									"password" 	=> $pass,
									"email" 	=> $email			 
								)			 
							)
				);
				
				
				// WELCOME INBOX MESSAGE				
				$welcomemsg = stripslashes(get_option('ppt_email_inboxwelcome'));
				if(strlen($welcomemsg) > 3){ 
				 				
					$my_post = array();
					$my_post['post_title'] 		= "new conversation";
					$my_post['post_content'] 	= strip_tags(strip_tags($welcomemsg));
					$my_post['post_excerpt'] 	= "";
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "ppt_message";
					$my_post['post_author'] 	= 1;
					$POSTID 	= wp_insert_post( $my_post );
					
					add_post_meta($POSTID, "sender_id", 1);
					add_post_meta($POSTID, "reciever_id", $errors );				 
					
					// EASY TO FIND CUSTOM FIELD
					add_post_meta($POSTID, "msg_stick", "[".$errors."][1]");
					add_post_meta($POSTID, "msg_status", "unread_".$errors);
				}
				
				
				// DA - AUTO CREATE USER LISTING 
				 
				if(in_array(THEME_KEY, array("da")) && !isset($savedata['noaddprofile']) ){
				
					$my_post = array(
						'post_type'		=> 'listing_type',
						'post_title' 	=> $user,
						'post_modified' => current_time( 'mysql' ),
						'post_excerpt' => ' ',
						'post_content' 	=> ' ',
						'post_author' 	=> $errors,
					);	
					
					if(_ppt(array('lst', 'default_listing_status')) == "pending"  ){ 				
						$my_post['post_status'] 	= "pending_approval"; 				
					}else{					
						$my_post['post_status'] 	= "publish";		
					}
					
					$DATING_PROFILE_ID = wp_insert_post( $my_post );	
				
				} 
				
		 
				
				// DEFAULT LANGUAGE
				$u_lang ="";
				if(_ppt(array('lang','switch')) == "1" && is_array(_ppt('languages')) && !empty(_ppt('languages'))  ){ 
				 
					 
					$avlangs = _ppt('languages');
					if(!empty($avlangs) && count($avlangs) == 1){
						$u_lang = $avlangs [0];
					}else{
						$u_lang = strtolower($CORE->_language_current());
					}
					  
					update_user_meta($errors,'language', $u_lang );
					
					$u_lang = get_user_meta($errors,'language',true);
					 
					
					if($u_lang != ""){
					$u_lang = "?l=".$u_lang;
					} 
				} 
				
				// SEND EMAIL
				$data1 = array(
					"user_id" 			=> $errors,
					"username" 		=> $user,
					"first_name" 	=> $fname,
					"last_name" 	=> $lname,
					"password" 		=> $pass,
					"email" 		=> $email,
				);
				$CORE->email_system("admin", "admin_user_new", $data1);	
				 
				
				// AUTO LOGIN NEW USER IF THEY SETUP A PASSWORD				
				$creds = array();
				$creds['user_login'] 	= $user;
				$creds['user_password'] = $pass;
				$creds['remember'] 		= true;
				$user = wp_signon( $creds, false );					
				
				// GET REDIRECT LINK				
				if(isset($savedata['redirect_to']) ){			
					$redirect_to 		= $savedata['redirect_to'].$u_lang;
				}else{
					$redirect_to = _ppt(array('links','myaccount')).$u_lang;
				}
				
				// CHECK FOR DATING PROFILE
				if(isset($DATING_PROFILE_ID) && is_numeric($DATING_PROFILE_ID)){
				 
					$cpage = _ppt(array('links','add'));
					if(substr($cpage,-1) == "/"){
						$cpage .= "?";
					}else{
						$cpage .= "&";
					}			
					$redirect_to = $cpage."eid=".$DATING_PROFILE_ID;
				
				}				 
					
				// REDIRECT USER TO ACCOUNT PAGE	
				if($return){	 
					return $redirect_to;								
				}else{					
					header("location: ".$redirect_to);
					exit();
				} 
				
					
			}// no errors
					
		
	}
	
	function _show_register(){
	
		global $CORE, $errortext, $errorStyle; $user_login = ''; $user_email = ''; 
		
		$errorStyle = "alert-danger";
		
		
		// CHECK IF REGISTRATION IS ENABLED
		if ( !get_option('users_can_register') && !defined('WLT_DEMOMODE') ) {
			wp_redirect( esc_url( site_url() ) .'/wp-login.php?registration=disabled');
			exit();
		} 
		
		// LOAD IN ERRORS
		$errors = new WP_Error(); 
		
		// PERFORM ACTION AFTER USER SUBMISSION
		if ( isset($_POST['ppt_spam_hash']) && isset($_POST['user_login']) && strlen($_POST['user_login']) > 2 && empty($errors->errors) ) { 
	 		 
			// CLEAN UP USER INPUT
			$sanitized_user_login = sanitize_user( $_POST['user_login'] );
			$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );
			 
	 
			// BASIC FORM VALIDATION			
			if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ 
				 $canContinue = google_validate_recaptcha();
				 if(!$canContinue){			  
					$errors->add('registered', __("The security question answer is incorrect.","premiumpress"), 'error');			 
				 }			 
			}
			
			if(_ppt('register_mobilenum') == 1 && strlen($_POST['custom']['mobile-num']) < 8){
			 
			$errors->add('registered', __("Please enter a valid mobile number.","premiumpress"), 'error');	
			}
			
			if(isset($_POST['first_name']) && $_POST['first_name'] == $_POST['last_name'] ){
			$errors->add('registered', __("Your first &amp; last names cannot be the same.","premiumpress"), 'error');	
			}
			 
			
			if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
			$errors->add('registered', __("The email address provided is invalid.","premiumpress"), 'error');	
			}
			
			if(_ppt(array('register','password')) == 1 &&  ( isset($_POST['pass1']) && $_POST['pass1'] == "" ) || ( isset($_POST['pass1']) && strlen($_POST['pass1']) < 5 ) ){
			 
			$errors->add('registered', __("The password cannot be blank or less than 5 characters.","premiumpress"), 'error');	
			}
			
			
			if( _ppt(array('register','password')) == 1 && (  $_POST['pass1']  != $_POST['pass2'] )  ){		
			$errors->add('registered', __("The passwords don't match.","premiumpress"), 'error');		
			}		
			
			
			// CHECK FOR PLUGIN ERRORS
			$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );
		 
			// CONTINUE ONTO STEP 1
			if ( $errors->get_error_code() ) {
			
			}else{
						 
				// GENERATE PASSWORD
				if(_ppt(array('register','password')) == '1' && $_POST['pass2'] !=""){			
					$_POST['password'] = strip_tags($_POST['pass2']);			
				}else{
					$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
					$_POST['password'] = $random_password;	
				}
				
				// CREATE NEW USER
				$errors = $this->USER_REGISTER($sanitized_user_login, $_POST['password'], $user_email, _ppt(array('register','password')) );	
				
				// USER NEEDS TO LOGIN
				if(is_string($errors)){
					
					$errors = new WP_Error();
					
					$errors->add('loggedout', __("The login details have been sent to your email.","premiumpress"), 'message');
			
				
				}
				 
			} // END ERROR CHECK 1	
			
				
		}// END PERFORM ACTION
	
		// CHECK FOR ERRORS 
		if(isset($sanitized_user_login)){
		$errortext = $this->_show_errors($errors);
		}
		
		// LOAD IN PAGE TEMPLATE
		_ppt_template( 'page', 'register' );
	
	}
	function _show_login() {
	 
		global $CORE, $errortext, $errorStyle;  $errors = new WP_Error();
		
		$errorStyle = "alert-danger";
		
		if	( isset($_GET['fr']) && _ppt(array('register','password')) == '1'  ){
		
			$errors->add('loggedout', __("Registration complete, you can now login.","premiumpress"), 'message'); 
			$errorStyle = "alert-success";
			
		}elseif(isset($_GET['fr'])){	
		
			$errors->add('loggedout', __("The login details have been sent to your email.","premiumpress"), 'message');
			
			$errorStyle = "alert-info"; 
		}
	
		// PERFORM LOGIN CHECKS // ACCESS DETAILS
		if(isset($_GET['noaccess'])){
		
			$errors->add('loggedout', __("Please login to access this page.","premiumpress"), 'message');
		
		}elseif(isset($_GET['socialloginerror'])){
		
			$errors->add('loggedout', __("Not enough information from your social profile could be found. Please use the register page to create a new profile on our website.","premiumpress"), 'message');
		
		}elseif	( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] ){
		
			$errors->add('loggedout', __("You are now logged out.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['registration']) && 'disabled' == $_GET['registration'] ){
			
			$errors->add('registerdisabled',  "".__("User registration is currently not allowed.","premiumpress") );
		
		}elseif	( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] ){
			
			$errors->add('confirm', __("The login details have been sent to your email.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )	{
		
			$errors->add('newpass',  __("Check your e-mail for your new password.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] ){
			
			$errors->add('registered', __("Registration complete.","premiumpress"), 'message'); 
			$errorStyle = "alert-success";
		}
		
		// CHECK FOR PLUGIN ERRORS 
		if(isset($_POST['log']) && strlen($_POST['log']) > 1 ){
			$plugin_error = apply_filters('login_errors','');
			 if(strlen($plugin_error) > 5){
				$errors->add('registered', $plugin_error, 'error');
			 }
		}
		
		 
		// CHECK FOR BASIC ERRORS AND THAT THE FORUM HAS BEEN PRESSED
		if ( empty($errors->errors) && isset($_POST['log'])  ) {
	 
			// CHECK FOR SECURE LOGINS
			if ( is_ssl() && !force_ssl_admin() ){
				$secure_cookie = false;
			}else{
				$secure_cookie = '';
			}
			
			// LOGIN USER
			$errors = $this->USER_LOGIN($_POST['log'], $_POST['pwd']);		
	 
		
		} // end basic validation		
	
		// CHECK FOR ERRORS	
		$errortext = $this->_show_errors($errors);
		
		// LOAD IN REGISTER PAGE TEMPLATE
		_ppt_template( 'page', 'login' );
		
	}
	function _show_errors($wp_error) {
	
		global $error, $CORE;
		
		if ( !empty( $error ) ) {
			$wp_error->add('error', $error);
			unset($error);
		}
	
		if (  !empty($wp_error) ) {
		
	
			if ( is_object($wp_error) && $wp_error->get_error_code() ) {
			
				$errors = '';
				$messages = '';
				
				foreach ( $wp_error->get_error_codes() as $code ) {			
				
					$severity = $wp_error->get_error_data($code);
					 
					if($code == "invalidcombo"){
					
					return __( 'There is no account with that username or email address.','premiumpress');
					 
					}elseif($code == "incorrect_password" || $code == "invalid_username"){
					
						return __("The login credentials you entered were incorrect.","premiumpress");
						
					}else{
							// disable default WP error message
						foreach ( $wp_error->get_error_messages($code) as $error ) {
							if ( 'message' == $severity )
	
								$messages .= $error ;
							else
								$errors .= $error;
						}
					}
				}
				if ( !empty($errors) )
					//echo $COREDesign->GL_ALERT( $errors ,"error");
					return $errors;
				if ( !empty($messages) ) 	
					//echo $COREDesign->GL_ALERT( $messages ,"success");
					return $messages;
			}
		}
	}
 	 
	
}

?>