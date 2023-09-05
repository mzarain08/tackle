<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;


// COUPON CODE SETTINGS
if(current_user_can('administrator') && isset($_POST['edituserid']) && is_numeric($_POST['edituserid'])){

 
// SAVE USER DATA
$user_id = $CORE->USER("save",$_POST); 

// CUSTOM FIELDS
if(isset($_POST['custom']) && is_array($_POST['custom']) && !empty($_POST['custom']) ){
	foreach($_POST['custom'] as $kk => $vv){
		update_user_meta( $user_id, $kk, $vv);			  
	}
}
	
// CART DELIVERY DATA
if(defined('WLT_CART') && isset($_POST['delivery']) && is_array($_POST['delivery']) ){
	foreach($_POST['delivery'] as $kk => $vv){
		 update_user_meta( $user_id, $kk, $vv);
	}     
}


// SAVE USER MEMBERSHIP DATA
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
if(isset($_POST['paywall_expires'])){ 

	 		
	update_user_meta($user_id,'ppt_paywall', 
		array( 
			"date_start" 	=> date("Y-m-d-H:i:s"), 
			"date_expires" 	=> $_POST['paywall_expires'],	
			"approved" 		=> 1,				
		)
	);
	
	
}


// SAVE USER MEMBERSHIP DATA
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
if(isset($_POST['membership'])){ 
	
	 	// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
		$au = get_user_meta( $user_id, 'ppt_subscription', true );		  
		 
		if(is_array($au) && isset($au['date_expires'])){
		
		}else{ 
			
			$sd = $CORE->USER("get_this_membership", $_POST['membership']);	
			
			if(isset($sd['duration'])){
			  		 
				$au = array(
					"date_start" => date("Y-m-d H:i:s"), 
					"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$sd['duration']." days")),
				);			
			} 
		
		}
		
		// DATE EXPIRES
		$expires = "";
		if(isset($_POST['membership_expires'])){		
			$expires = $_POST['membership_expires'];
		}elseif(isset($au['date_expires'])){
			$expires = $au['date_expires'];
		} 
		
		if($expires != ""){		
			
		
			update_user_meta( $user_id ,'ppt_subscription', 
					array(
						"key" 			=> $_POST['membership'] , 
						"date_start" 	=> $au['date_start'], 
						"date_expires" 	=> $expires,	
						"approved" 		=>  $_POST['user_approved'],				 
					)
			); 	
		
		} 
		
		
		if(isset($_POST['ppt_userdownloads'])){
		update_user_meta( $user_id, 'free_downloads_count',$_POST['ppt_userdownloads']); 		 	
		}
		
		if(isset($_POST['ppt_freelistings'])){
		update_user_meta( $user_id, 'free_listings_count',$_POST['ppt_freelistings']); 
		}
		
		if(isset($_POST['ppt_freelistings_max'])){
		update_user_meta( $user_id, 'free_listings_max_count',$_POST['ppt_freelistings_max']); 
		}
		
		if(isset($_POST['max_msg'])){
		update_user_meta( $user_id, 'max_msg_count',$_POST['max_msg']); 
		}
		
	
}

// BOOST
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['boost'])){ 
		
		$boostData = get_user_meta($userdata->ID, 'upgrade_boost', true);
		if($_POST['boost'] == 1){ 
			$start = "";
			$end = "";
			if(isset($_POST['boost_start'])){
				if($_POST['boost_start'] == ""){
					$hours = _ppt(array('lst','addon_boost_days')); 
					if(!is_numeric($hours)){
					$hours = 24;
					}
					$start = date("Y-m-d H:i:s");
					$end 	= date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$hours." hours"));
				}else{
					$start = $_POST['boost_start'];
					$end 	= $_POST['boost_end'];
				}
			}
			
			$boostdata = array(						
				"start" =>  $start,
				"end" 	=> 	$end,
			);
			
			update_user_meta($user_id, 'upgrade_boost', $boostdata);
			
		}elseif($_POST['boost'] == 0){
			
			update_user_meta($user_id, 'upgrade_boost', '');
		
		}
}
// CHECK FOR USERNAME CHANGE
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['usernamechange']) && $_POST['usernamechange'] == "1" && strlen($_POST['user_login']) > 3 ){
	$wpdb->query("UPDATE ".$wpdb->prefix."users SET user_login = '".trim(strip_tags($_POST['user_login']))."' WHERE ID = (".$user_id.") LIMIT 1"); 
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// LEAVE MESSAGE
$GLOBALS['ppt_error'] = array(
"type" 		=> "success",
);
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
}

 

_ppt_template('framework/admin/header' ); 

?>


<div class="tab-content d-flex flex-column h-100">

<?php if(!isset($_GET['eid']) ){ ?>

        <div class="tab-pane active addjumplink" 
        data-title="Users" 
        data-icon="fa-users" 
        id="users" 
        role="tabpanel" aria-labelledby="users-tab">    
   
    	<?php  _ppt_template('framework/admin/parts/users-table' ); ?> 

        </div>  
<?php } ?>

<?php if(isset($_GET['eid']) ){ ?>
        <div class="tab-pane addjumplink" 
        data-title="Add Member" 
        data-icon="fa-users-medical" 
        id="add" 
        role="tabpanel" aria-labelledby="add-tab">

		<?php _ppt_template('framework/admin/parts/users-add' ); ?>

        </div>
<?php } ?>

</div><!-- end tabs -->


<script>


 
jQuery(document).ready(function(){
 
 <?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ ?>
 
  jQuery('#myTab li:nth-child(2) a').tab('show');
 
 <?php } ?> 
});

 

function ajax_load_media(id){

tb_show('', 'admin.php?page=add&eid='+id+'&action=edit&mediaonly&amp;TB_iframe=true');
return false;

}



function ajax_delete_user(id){

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

// RESET
jQuery('#ajax_response_msg').html("");	


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "user_delete",
			uid: id,
        },
        success: function(response) {			
			if(response.status == "ok"){
					
				// HIDE ROW
				jQuery('#postid-'+id).hide();	
				
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("User deleted successfully");	
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
	}
	
}// end are you sure

 
jQuery(document).ready(function() {
	jQuery('.card-footer').hide(); 
});

</script>

<?php  _ppt_template('framework/admin/footer' );  ?>