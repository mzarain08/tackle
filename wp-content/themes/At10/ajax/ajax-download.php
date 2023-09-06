<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

global $CORE, $userdata, $CORE_UI; 


$pid = $_POST['pid']; 

// PRICE AND TYPE
$price = get_post_meta($pid, "price_cart", true);
$price_credits = get_post_meta($pid, "price_credit", true);
 
 

// MEMBERSHIP ACCESS
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$value = array();
if(_ppt(array('mem','enable')) == 1  ){
	$status = array(
		"" 			=> __("Everyone","premiumpress"),
		"loggedin" 	=> __("All Members","premiumpress"),		
		"subs" 		=> __("Members With Subscriptions","premiumpress"), 
	);
	
	// GET ALL MEMBERSHIPS
	$all_memberships = $CORE->USER("get_memberships", array());
	foreach($all_memberships  as $key => $m){
		$status[$m['key']] = $m['name'];
	} 
					 
					  
	$value = get_post_meta($pid,'videoaccess',true);
	// TESTING
	if( _ppt(array('lst', 'requirelogin_videos' )) == '1'){
	 $value["loggedin"] = "loggedin";
	}
	 
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$options = array(


	1 => array(
	
		"title" 	=> __( 'Add to cart', 'premiumpress' ),
		"subtitle" 	=> __( 'Purchase this item via our checkout system.', 'premiumpress' ),
		"desc" => "",
		"enable" => 0,
		"link" => "",
		"btncode" => "",
		"icon" => "cart",
	
	),
	
	2 => array(
	
		"title" 	=> __( 'Free Download', 'premiumpress' ),
		"subtitle" 	=> __( 'Download this item for free or as part of your membership.', 'premiumpress' ),
		"desc" => "",
		"enable" => 0,
		"link" => "",
		"btncode" => "",
		"icon" => "downloads",
			
	),
	
	3 => array(
	
		"title" 	=> __( 'Use My Credit', 'premiumpress' ),
		"subtitle" 	=> __( 'Use your website credit to download this item.', 'premiumpress' ),
		"desc" => "",
		"enable" => 0,
		"link" => "",
		"btncode" => "",
		"icon" => "verified",
			
	),
 

);

// 1. CART
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
if($price > 0){
		
		$options[1]['enable'] = 1;
		$options[1]['title'] .= '<span class="ml-3 badge badge-primary '.$CORE->GEO("price_formatting",array()).'">'.hook_price($price).'</span>';
	    $options[1]['btncode'] = $CORE->order_encode(array(   
		"uid" 				=> $userdata->ID, 
		"amount" 			=> $price,     	
		"order_id" 			=> "CART-".$pid."-".$userdata->ID."-".rand(1, 1000000),   	 
		"description" 		=> get_the_title($pid),   	
		"recurring" 		=> 0,   	
		"couponcode" 		=> 1, 
		//"nocredit" 		=> 1,  	
		//"hidecouponbox" 	=> 0, 							
	   ) );
	   
	   
	   if(!$userdata->ID){ 	   
	   
	   $options[1]['link'] = 'onclick="processLogin();"'; 
	   
	   }else{  
		
		$options[1]['link'] = 'onclick="processNewPayment(\'#orderdatafor'.$pid.'\');"';
        
       } 
}
 
// 2. MEMBERSHIP
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 	  
if($userdata->ID && $CORE->USER("hasaccess_special_vdeoaccess", $pid) == "1"){ 
	    	 
	$thisLink = 'onclick="jQuery(\'#downloadnow'.$pid.'\').submit();"'; 
	$options[2]['btncode'] = "download";
	$options[2]['enable'] = 1;
	$options[2]['link'] =  $thisLink; 
	
	

}

// 3. CREDIT
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 	  
if($price_credits > 0 && $userdata->ID){

	$user_credit = get_user_meta($userdata->ID,'ppt_usercredit',true);
	
	if($user_credit >= $price_credits){
	    	 
		$options[3]['enable'] = 1;
		$options[3]['title'] .= '<span class="ml-3 badge badge-primary ">'.$price_credits." ".__( 'credits', 'premiumpress' ).'</span>';
		
		$options[3]['desc'] = str_replace("%s", $user_credit ,__("You have %s credits remaining.","premiumpress")); 

		
	    $options[3]['btncode'] = $CORE->order_encode(array(   
		"uid" 				=> $userdata->ID, 
		"amount" 			=> $price,     	
		"order_id" 			=> "CART-".$pid."-".$userdata->ID."-".rand(1, 1000000),   	 
		"description" 		=> get_the_title($pid),   	
		"recurring" 		=> 0,   	
		"couponcode" 		=> 1,   	
		//"hidecouponbox" 	=> 0, 	
	   ) );
	   $options[3]['link'] = 'onclick="processNewPayment(\'#orderdatafor'.$pid.'\');"';
	
	}

}

?>



<div class="p-4">
 
<h2 class="text-600 mb-3"> <span class="smilecode float-right" style="font-size: 40px;">&#x1F600;</span> <?php echo __( 'Download Now', 'premiumpress' ); ?></h2>
     
<p><?php echo __( 'Here are your available download options.', 'premiumpress' ); ?></p>


<?php 

if(_ppt(array('mem','enable')) == 1  ){

if(is_array($value) && !empty($value) ){  $psks = "";
foreach($status as $key => $club){
					  if(in_array($key, array("","subs")) ){ continue; } 
                          if(in_array($key,$value) || in_array("mem".$key,$value) ){ 
                             $psks .= "<span class='text-600 text-underline cursor' onclick='processUpgrade();'>".$club."</span> "; 
                          }
} 
					  
if(strlen($psks) > 1){					  
if($userdata->ID){ 
$mymem = $CORE->USER("get_user_membership", $userdata->ID);	
 
?>
<div class="fs-sm opacity-5 mb-3" > <?php if(isset($mymem['expired']) && $mymem['expired'] == 1){ echo __("My membership:","premiumpress")." ".$mymem['name']; }else{ ?><?php echo __("You have no active membership.","premiumpress"); ?><?php } ?></div>
<?php  

}
					  
$options[2]['desc'] = str_replace("%s",$psks,__("This download is available free for %s members.","premiumpress")); 
}
 } 
 
}
?>

				  

<?php

foreach($options as $o){ ?>


<div class="mb-4 p-3 border <?php if(!$o['enable']){ ?>opacity-2<?php } ?>" ppt-border1>
<?php if($o['enable']){ ?><a <?php echo $o['link']; ?> class="cursor text-dark text-decoration-none"><?php } ?>

<div ppt-flex-between>
    <div>
    
    	<div class="d-flex">
       
    	<div style="width:80px;"><div ppt-icon-48 data-ppt-icon-size="48" class="<?php if($o['enable']){ ?>text-primary<?php } ?>"><?php echo $CORE_UI->icons_svg[$o['icon']]; ?></div></div>
     	<div>
        	<div class="fs-6 mb-2 text-600 "><?php echo $o['title']; ?></div>
        	<div class="opacity-5"><?php echo $o['subtitle']; ?></div>
        </div>
        </div>
    </div>
    <div>
        <div ppt-icon-32 data-ppt-icon-size="32"><?php echo $CORE_UI->icons_svg['chevron-right']; ?></div>
    </div>
</div>
<?php if($o['enable']){ ?></a><?php } ?>
</div>

<?php if(strlen($o['desc']) > 1){ ?>
<div class="mb-3 mt-n2 fs-sm opacity-5"><?php echo $o['desc']; ?></div>
<?php } ?>

<?php if($o['btncode'] == "download"){ 

	$data_array = array(
		"uid" 		=> $userdata->ID,
		"pid" 		=> $pid,
	);
	?>
    <form method="post" action="" class="mt-3" id="downloadnow<?php echo $pid; ?>">
        <input type="hidden" name="data" value="<?php echo base64_encode( json_encode( $data_array ) ); ?>" />
        <input type="hidden" name="downloadproduct" value="1" />
      </form>

<?php }elseif(strlen($o['btncode']) > 0 ){ ?>

<input type="hidden" id="orderdatafor<?php echo $pid; ?>" value="<?php echo $o['btncode']; ?>" /> 

<?php  }  ?>


<?php } ?>



</div>  