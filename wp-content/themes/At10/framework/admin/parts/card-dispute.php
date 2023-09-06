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

global $CORE, $post, $CORE_UI;

	 
	
	$order_status = get_post_meta($post->ID,'dispute_status',true);
	
	
	$user1_id = get_post_meta($post->ID,'user1_id',true);
	$user1_status = get_post_meta($post->ID,'user1_status',true);
	
	$user2_id = get_post_meta($post->ID,'user2_id',true);
	$user2_status = get_post_meta($post->ID,'user2_status',true);
	
	$order_total  = get_post_meta($post->ID,'order_total',true);
 

   $day 	= date("d", strtotime($post->post_date));
   $month 	= date("M", strtotime($post->post_date));
   $year 	= date("Y", strtotime($post->post_date));
   
?>

<tr id="postid-<?php echo $post->ID; ?>">
 
 
  <td>
  
  <input class="checkbox1" type="checkbox" name="check[]" onclick="jQuery('#actionsbox').show();" value="<?php echo $post->ID; ?>">
  
  </td>
 
 
  <td>
  
 
<div class="d-inline-flex align-self-baseline font-weight-bold">

<div class="clearfix">
<div class="clearfix text-center"><?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $post->ID, "css" => "rounded-circle", "online" => 0)); ?></div> 


<div class="clearfix fs-sm text-center"><?php echo $CORE->ORDER("get_dispute_user_status_formatted",  $user1_status ); ?> </div>   


</div>



<div class="mx-3">&nbsp;</div>

<div >
<div class="clearfix text-center"><?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $post->ID, "css" => "rounded-circle", "online" => 0)); ?></div>

<div class="clearfix fs-sm text-center"><?php echo $CORE->ORDER("get_dispute_user_status_formatted",  $user2_status ); ?>  </div> 

</div>


</div>
   
    

 
  </td>
  
  
  
  
   <td class="text-center"> 
    <div class="font-weight-bold mb-2">
    <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price($order_total); ?></span>
    </div>
   </td>
   
   
   
  
  <td>
  <div class="font-weight-bold"><?php echo  $day." ".$month; ?></div>
  
  <div class="small"><?php echo $year; ?></div>
  </td>
  
  
   
  
  
  <td class="text-center"> 
   
  <?php echo $CORE->ORDER("get_dispute_status_formatted",  $order_status ); ?>   
 
  </td>
 
 
 
  <td>
  
  
 <div class="dropdown">
  <button class="btn-system  font-weight-bold dropdown-toggle btn-block" type="button"   data-ppt-btn data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo __("Actions","premiumpress"); ?>
  </button>
  <div class="dropdown-menu quick py-0 text-center">
    
      <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=dispute&eid=<?php echo $post->ID; ?>" class="dropdown-item fs-7 text-dark"><?php echo __("Edit","premiumpress"); ?> </a>
         
          <a href="javascript:void(0);" onclick="ajax_delete_order('<?php echo $post->ID; ?>')"  class="dropdown-item fs-7 text-dark"><?php echo __("Delete","premiumpress"); ?></a>
       
        
  </div> 
  
  </td>
  
  
</tr>
