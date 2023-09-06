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

global $CORE, $userdata, $post;


$args = array(
                        'post_type' 		=> 'ppt_offer',
                        'posts_per_page' 	=> 100, 
                     	'post_status'		=> 'publish',
						 'meta_query' => array(	
							 'relation'    => 'AND',					
								 array(							
									 										 
									 'user1'    => array(
									 'key' => 'post_id',
									 'compare' => '=',
									 'value' => $post->ID,							 			
								) 					
							 ),	
						 ),
                     );					
                     $wp_query = new WP_Query($args); 
					 $demodata = array(); 
					
                     // COUNT EXISTING ADVERTISERS	 
                     $tt = $wpdb->get_results($wp_query->request, OBJECT); 
                     $i=1; $post_id_array = array(); 
 
                     if(!empty($tt)){
					 
                     foreach($tt as $p){
					 
					 	$buyerid = get_post_meta($p->ID,"buyer_id", true);
					 
					 	if(!is_numeric($buyerid)){ continue; }
					 
					 	$content_post = get_post($p->ID);
					 
						$demodata[$i] =  array(
	 			
							"name" => $CORE->USER("get_username", $buyerid),
							"desc" => wpautop($content_post->post_content),
							"img" => $CORE->USER("get_avatar", $buyerid),
							"price" => get_post_meta($p->ID,"price", true),
							"days" => "10",
							"link" => get_author_posts_url( $buyerid ),
							"date" => get_post_field("post_date", $p->ID),
						 );					 
					 
					 }
					 
					 }
					 
if(is_admin() || ( defined('WLT_DEMOMODE')  && empty($demodata) )  ){ //

$expiry_date = date("Y-m-d H:i:s");
$demodata = array(

	 1 => array(
	 
		"name" => "James Brown",
		"desc" => "<p> I have over 10 years experience in this field and would love to help complete this task for you. </p><p>I offer 100% satisfaction guesntee, if you are unhappy with my work you can ask for a refund. </p>",
		"img" => DEMO_IMG_PATH."pj/user4.jpg",
		"price" => "870",
		"days" => "10",
		"link" => "#",
		"date" => date("Y-m-d H:i:s", strtotime( $expiry_date . " -1 day") ),
	 ),
	 2 => array( 
		"name" => "John Summers",
		"desc" => "<p> Please give me this oppotunity to show you how creative I can be to complete this task for you.</p><p>I have offered what I believe is a fair price for this item but would be happy to adjust if needed. </p>",
		"img" => DEMO_IMG_PATH."pj/user2.jpg",
		"price" => "400",
		"days" => "12",
		"link" => "#",
		"date" => date("Y-m-d H:i:s", strtotime( $expiry_date . " -2 hours") ),
	 ),	 
	 3 => array(
	 
		"name" => "Jenny Black",
		"desc" => "<p> I would be the perfect candidate for this job, I have many years experience in this field and have completed many similiar jobs in the past.</p><p>Please see my feedback for proof.</p>",
		"img" => DEMO_IMG_PATH."pj/user7.jpg",
		"price" => "300",
		"days" => "17",
		"link" => "#",
		"date" => date("Y-m-d H:i:s", strtotime( $expiry_date . " -1 hours") ),
	 ), 
);
}
 


if(is_array($demodata) && !empty($demodata)){ 
?>

 
<?php
$i=1;
 foreach($demodata as $d){ 
 
 if(!isset($topPrice)){
 $topPrice = $d['price']; 
 }elseif(isset($topPrice) && $d['price'] > $topPrice){
 $topPrice = $d['price'];
 }
 
 ?>
 
<div class="pb-2 <?php if($i != count($demodata)){ ?>border-bottom mb-2<?php } ?>">

<div class="d-flex">
	<a href="<?php echo $d['link']; ?>">
        <div style="height:60px; width:60px;" class="overflow-hidden position-relative roudned bg-light rounded-lg">
            <div class="bg-image" data-bg="<?php echo $d['img']; ?>"></div>
        </div>
    </a>
    <div class="ml-3 ml-lg-4">
    	
        <div class="text-600"><?php echo $d['name']; ?></div>
    	<div class="mt-2">
        <span class="text-600"><?php echo hook_price($d['price']); ?></span> <span class=" fs-sm ml-2"><?php echo $CORE->PACKAGE("get_timesince", $d['date']); ?></span>
        </div>
    </div>

</div>


</div>
 
 
<?php $i++; } ?>

<script>
jQuery(document).ready(function(){ 
	jQuery(".topbidprice").html("<?php echo $topPrice; ?>");
});
</script>
    
    
<?php }else{ ?>
    
<div class="text-center opacity-5"><?php echo __("No bids placed.","premiumpress") ?></div> 
<script>
jQuery(document).ready(function(){ 
	jQuery(".topbidprice").hide();
});
</script>   
<?php } ?>
