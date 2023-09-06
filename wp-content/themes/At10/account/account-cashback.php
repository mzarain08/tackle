<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata; 

 
if(isset($_POST['cb_action']) && $_POST['cb_action'] == "newfile"){
 

		if(isset($_FILES['ppt_verifyfile']) && is_numeric($_POST['cb_pid']) ){
		 
			 
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
					'post_title' => $_FILES['ppt_verifyfile']['name'],
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
				
				$data = array('img' =>$thumbnail, 'path' => $uploaded_file['file'], "aid" => $attachment_id,  "name" => $attachment['post_title'] );	
			 	  
				
				// NOW LETS SAVE THE NEW ONE	
				update_post_meta($_POST['cb_pid'], "cashback_file", $data );
				
				// UPDATE STATUS
				update_post_meta($_POST['cb_pid'], "cashback_status", 1 );
				
				
			 	
				}
 
		}

}
 
   // ORDERS
    $args = array(
      	'post_type' 		=> 'ppt_cashback',
      	'posts_per_page' 	=> 100,
        'paged' 			=> 1,
		
			'meta_query' => array( 
				'user_id'    => array(
					'key' 			=> 'cashback_userid',	
					'type' 			=> 'NUMERIC',
					'value' 		=> $userdata->ID,
					'compare' 		=> '=',								 					 			
				),					 	
      		), 
		 
			
      );
      $wp_query1 = new WP_Query($args); 
      $cb_logs = $wpdb->get_results($wp_query1->request, OBJECT);
	

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$cashbackFields = $CORE->USER("cashback_fields",array());
$statusData = array();
$statusArray = array(

	"4" 	=> 0,  // approved
	"3" 	=> 0,  // expired
	"2" 	=> 0,  // rejected
	"1" 	=> 0,  // pending
	"0" 	=> 0,  // pending upload
	
	"total" => 0 
);


if(!empty($cb_logs) ){

	foreach($cb_logs as $o){ 
	 	
		$s = get_post_meta($o->ID,'cashback_status',true);
		if(!is_numeric($s)){ $s = 0; }
		$statusArray[$s] = $statusArray[$s] +1;
		
		$pid = get_post_meta($o->ID,'cashback_pid',true);
		$ptitle = get_the_title($pid);
		
		if(strlen($ptitle) > 1){
			 	
			$statusData[$o->ID] = array(
				"status" 		=> $s, 
				"status_name" 	=> $cashbackFields['cashback_status']['values'][$s]['name'], 
				"date" 			=> get_the_date( 'dS M Y', $o->ID ), 
				"pid" 			=> $pid, 
				"post_name" 	=> $ptitle, 
				"post_link" 	=> get_permalink($pid),  
			);		
		}
	  
	
	}

}

//print_r($statusData);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



?>

<div class="fs-lg text-600 mb-4"><?php echo __("Cashback Requests","premiumpress"); ?></div>

<div class="row">
<div class="col-md-4 mb-4">
<select class="form-control mt-4" onchange="showcashback(this.value);">

<option value="all"><?php echo __("All","premiumpress") ?> (<?php echo $statusArray['total']; ?>)</option>

<option value="0"><?php echo $cashbackFields['cashback_status']['values'][0]['name']; ?> (<?php echo $statusArray['0']; ?>)</option>
<option value="1"><?php echo $cashbackFields['cashback_status']['values'][1]['name']; ?> (<?php echo $statusArray['1']; ?>)</option>
<option value="2"><?php echo $cashbackFields['cashback_status']['values'][2]['name']; ?> (<?php echo $statusArray['2']; ?>)</option>
<option value="3"><?php echo $cashbackFields['cashback_status']['values'][3]['name']; ?> (<?php echo $statusArray['3']; ?>)</option>
<option value="4"><?php echo $cashbackFields['cashback_status']['values'][4]['name']; ?> (<?php echo $statusArray['4']; ?>)</option>
    

</select>
</div>


<div class="col-md-6"> </div>

</div>
<script>

function showcashback(type){
				
	jQuery(".cb-all").hide();
	jQuery(".cb-"+type).show();
	 
}
			 

</script>      

 
<div class="alter-all-box" <?php if(!empty($statusData)){ ?> style="display:none;"<?php } ?>> 
 
<div class="opacity-5"><?php echo  __("No cashback requests found.","premiumpress"); ?></div>

</div>
 

<?php foreach($statusData as $k => $d){ 
 
?>
<div ppt-border1 class="p-3 mb-3 <?php if(!in_array($d['status'],array("2","3"))){ ?>cursor<?php } ?> cb-all cb-<?php echo $d['status']; ?>" onclick="jQuery('.cbdata-<?php echo $k; ?>').toggle();">
<div class="row" >  

 <div class="col-md-12">
 
 <a href="<?php echo $d['post_link']; ?>" target="_blank" class="link-dark text-dark text-600"> <i class="fa fa-external-link-alt fs-sm mr-2"></i> <?php echo $d['post_name']; ?> </a>
 
 <hr />
 </div>

    <div class="col-md-4">
    
    <div class="fs-sm opacity-5 text-600 mb-1"><?php echo __("Tracking ID","premiumpress") ?></div>
    <div class="text-600">#<?php echo $k; ?></div>
    
    </div>
    <div class="col-md-4">
    
    <div class="fs-sm opacity-5 text-600 mb-1"><?php echo __("Activated","premiumpress") ?></div>
    <div class="text-600"><?php echo $d['date']; ?></div>
    
    </div>
    <div class="col-md-4">
    
    <div class="fs-sm opacity-5 text-600 mb-1"><?php echo __("Status","premiumpress") ?></div>
    <div class="text-600 <?php if(in_array($d['status'],array("2","3"))){ ?>text-danger<?php }elseif($d['status'] == "4"){ ?>text-success<?php } ?>"><?php echo $d['status_name']; ?></div>
    
    </div>

</div>
</div>
<?php if(!in_array($d['status'],array("2","3"))){ ?>
<div ppt-border1 class="my-4 p-3 cbdata-<?php echo $k; ?>" style="display:none;">
 
<div class="container">
 
    <div class="row align-items-center">
    
      <div class="col-lg-6 order-2 px-0">
      
        <div class="shadow-sm " ppt-border1>
          <div class="card-body p-md-4">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box bg-success text-light"><span class="number"><i class="fa fa-check"></i></span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Activate Tracking","premiumpress") ?></div>
                <div class="opacity-5 fs-sm"><?php echo __("You can monitor the progress of this cashback request via your members area.","premiumpress") ?></div>
              </div>
            </div>
          </div>
  
        </div>
 
        <div class="shadow-sm  mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box <?php if($d['status'] > 0 ){ ?> bg-success <?php }else{ ?> bg-light <?php } ?> text-light"><span class="number"><i class="<?php if($d['status'] > 0 ){ ?>fa fa-check<?php }else{ ?>fa fa-star text-warning<?php } ?>"></i></span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Proof of Purchase","premiumpress") ?></div>
                <div class="opacity-5 fs-sm"><?php echo __("After you've purchased the item from the retailer, upload your proof of purchase via your members area.","premiumpress") ?></div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="shadow-sm  mt-6" ppt-border1>
          <div class="card-body p-6">
            <div class="d-flex flex-row">
              <div>
                <span class="number-box <?php if($d['status'] == 4 ){ ?> bg-success <?php }else{ ?> bg-light <?php } ?>  text-light"><span class="number"><?php if($d['status'] == 4 ){ ?><i class="fa fa-check"></i> <?php } ?></span></span>
              </div>
              <div>
                <div class="text-600 mb-2"><?php echo __("Wait for Confirmation","premiumpress") ?></div>
                <div class="opacity-5 fs-sm"><?php echo __("Once the retailer pays us the comission for your order we will credit it to your account as cashback.","premiumpress") ?></div>
              </div>
            </div>
          </div>
        </div>
    
      </div>
  
      <div class="col-lg-6  pr-lg-5 pe-lg-5">
      
<?php if($d['status'] == "0"){ ?>

<div class="text-600 fs-md mb-4"><?php echo __("Proof of Purchase","premiumpress") ?></div>

<p class="lead mb-4" ><?php echo __("Please upload a purchase receipt or reference number which confirms your order.","premiumpress") ?></p>

<p class="mb-4"><?php echo __("We will contact the retailer to confirm your purchase.","premiumpress") ?></p>

<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="cb_action" value="newfile" />
<input type="hidden" name="cb_pid" value="<?php echo $k; ?>" />

<input name="ppt_verifyfile" type="file" class="form-control p-1"  />

<button data-ppt-btn class="btn-primary mt-3 btn-sm"><?php echo __("Update","premiumpress") ?></button>
</form>

 

<?php }elseif($d['status'] == "4"){ 

	$commission = get_post_meta($k, 'cashback_total', true);
	if(!is_numeric($commission)){
		$commission = 0;
	}
	
	$commission_date = get_post_meta($k, "cashback_paid", true);
	if($commission_date == ""){
	$commission_date = date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " -1 days") );
	update_post_meta($k, "cashback_paid",$commission_date);
	
	}
	
	
	

?>
 
<div class="text-600 fs-md mb-4"><?php echo __("Payment Approved","premiumpress") ?></div>
 
<p class="lead mb-4"><?php echo str_replace("%s",hook_price($commission), str_replace("%d",hook_date($commission_date),  __("Your account was credited with %s cashback on %d.","premiumpress"))); ?></p>

<p class="mb-4"><?php echo __("Thank you and have a wonderful day!","premiumpress") ?></p>


<?php }else{ ?>      

<div class="text-600 fs-md mb-4"><?php echo __("Waiting Confirmation","premiumpress") ?></div>

<p class="lead mb-4" ><?php echo __("It can then take up to 60 days for the cashback to be approved and made payable.","premiumpress") ?></p>

<p class="mb-4"><?php echo __("Once we have recieved payment from the retailer, your account will be updated. Thank you for your patience.","premiumpress") ?></p>


<?php } ?> 
     
      </div>
 
    </div>
 
  </div>
 
</div>
<?php } ?>

<?php } ?>

<style>
.mt-6 {
    margin-top: 1.5rem!important;
} 
.number-box {
    width: 40px;
    height: 40px;
    font-size: 16px;
    display: inline-block;
    margin-right: 30px;
    border-radius: 100%;
    text-align: center;
    line-height: 40px;
    font-weight: 600;
}

</style>