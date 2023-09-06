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

global $CORE, $userdata, $STRING;
 
    // ORDERS
    $args = array(
      	'post_type' 		=> 'ppt_orders',
      	'posts_per_page' 	=> 100,
        'paged' 			=> 1,
		
			'meta_query' => array( 
				'user_id'    => array(
					'key' 			=> 'order_userid',	
					'type' 			=> 'NUMERIC',
					'value' 		=> $userdata->ID,
					'compare' 		=> '=',								 					 			
				),					 	
      		), 
		 
			
      );
      $wp_query1 = new WP_Query($args); 
      $orders = $wpdb->get_results($wp_query1->request, OBJECT);

$alreadyFound = array();

$shown = 0;
 
?>

 
<?php if(!empty($orders)){ $i = 1; ?>
<?php

	foreach($orders as $order){
	
	$data = $CORE->ORDER("get_order", $order->ID);
	 
	
	$key = 0;	
	
	if(strlen($data['order_id']) > 1){
	
		$parts = explode("-", $data['order_id']);
		if(is_numeric($parts[1]) && $parts[1] > 1){
			$key  = $parts[1];
		}
	
	}elseif(strlen($data['order_postid']) > 2){
	
		$key = $data['order_postid'];
	}
	
  
	 
	if( $key == 0 || in_array($key, $alreadyFound) ){ continue; }
	$alreadyFound[$key] = $key; 
 	
	if(isset($key) && is_numeric($key) && get_post_meta($key, "download_path", true) != ""){ 

	
	// SATYS
	$ss = get_post_status($key);
	
	$shown++;
 
?>
<div class="border-bottom bg-white shadow-sm mb-4  p-3 listingid-<?php echo $key; ?> paiddownloads">
  <div class="row y-middle">
    <div class="col-9">
      <div class="float-left img-list mr-3"> <?php echo str_replace("data-","",do_shortcode('[IMAGE pid="'.$key.'"]'));  ?> </div>
      <div class="ellipsis" style="max-width:200px;">
        <?php if($ss != "trash"){ ?>
        <a href="<?php echo get_permalink($key); ?>" class="text-dark font-weight-bold" target="_blank"> <?php echo get_the_title($key); ?></a>
        <?php }else{ ?>
        <?php echo get_the_title($key); ?>
        <?php } ?>
      </div>
    </div>
    <div class="col-3">
    <?php if($data['order_process'] == 3){ 
	
	
	// DOWNLOAD ARRSY
	$data_array = array(
		"uid" 		=> $userdata->ID,
		"pid" 		=> $key,
	);
	
	
	?>  
     
    <form method="post" action="" class="mt-3" id="downloadnow<?php echo $post->ID; ?>">
        <input type="hidden" name="data" value="<?php echo base64_encode( json_encode( $data_array ) ); ?>" />
        <input type="hidden" name="downloadproduct" value="1" />
      </form>
      <button type="button" class='btn btn-primary btn-block' onclick="jQuery('#downloadnow<?php echo $post->ID; ?>').submit();"><i class="fal fa-download"></i> <?php echo __("Download Now","premiumpress"); ?></button>
    
     
     
    <?php }else{ ?>
   
   <?php echo __("Order Processing","premiumpress"); ?>
    <?php } ?>
    </div>
  </div>
</div>
<?php 					 
						 
			}// end if 
 
} // end if
 
}

?>

<?php if($shown == 0){ ?>

<div class="card">
  <div class="card-body">
    <div class="p-4 text-center"> 
    
    <i class="fal fa-download fa-4x mb-4 text-light"></i>
    
    
    <h4> <?php echo __("No downloads found","premiumpress") ?></h4>
    
    
     </div>
  </div>
</div>
 
<?php } ?>
