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

global $CORE, $post;

	// GET POST META
 	 
	$status = get_post_meta($post->ID,'cashback_status',true);
	  
 	$cashout_paid = get_post_meta($post->ID,'cashback_total',true);	 
	 
	$user_id = get_post_meta($post->ID,'cashback_userid',true);
 

?>

<tr id="postid-<?php echo $post->ID; ?>">
  <td><input class="checkbox1" type="checkbox" name="check[]" onclick="jQuery('#actionsbox').show();" value="<?php echo $post->ID; ?>">
  </td>
  <td><ul class="list-inline mb-0">
      <?php if(is_numeric($user_id)){ ?>
      <li class="list-inline-item"> <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark" style="max-width:55px; max-height:45px; overflow:hidden;">
        <?php  echo str_replace("avatar ","avatar img-fluid ",get_avatar( $user_id, 50 )); ?>
        </a> </li>
      <?php } ?>
      <li class="list-inline-item mt-n2">
        <div class="pt-3 font-weight-bold"> <?php echo $CORE->USER("get_username", $user_id); ?></div>
        <div class="small mt-2"> <?php echo hook_date($post->post_date); ?></div>
      </li>
    </ul>
    </td>
 
  <td style="text-align:center;">
  
  <?php if($cashout_paid > 0){ ?>
  <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price($cashout_paid); ?></span> 
  <?php }else{ ?>
  -
  <?php } ?>
  </td>
  <td style="text-align:center;">
  
  
<?php

switch($status){


	case "4": {
	?>
	<span class="inline-flex items-center font-weight-bold order-status-icon status-1"><?php echo __("Approved","premiumpress"); ?></span> </span>
	<?php
	} break;
	
	case "3": {
	?>
	<span class="inline-flex items-center font-weight-bold order-status-icon status-2"><?php echo __("Expired","premiumpress"); ?></span> </span>
	<?php
	} break;
	
	case "2": {
	?>
	<span class="inline-flex items-center font-weight-bold order-status-icon status-5"><?php echo __("Rejected","premiumpress"); ?></span> </span>
	<?php
	} break;
	
	case "1": {
	?>
	<span class="inline-flex items-center font-weight-bold order-status-icon status-3"><?php echo __("Pending","premiumpress"); ?></span> </span>
	<?php
	} break;
	
	default: {
	?>
	<span class="inline-flex items-center font-weight-bold order-status-icon status-2"><?php echo __("Pending Upload","premiumpress"); ?></span> </span>
	<?php
	} break;

}

?>
  
 
  </td>
 
  <td>
  
  
<div class="d-flex">  
  
 <div class="dropdown">
  <button class="btn-system  font-weight-bold dropdown-toggle btn-block" type="button"   data-ppt-btn data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo __("Actions","premiumpress"); ?>
  </button>
  <div class="dropdown-menu quick py-0 text-center">
    
      <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=cashback&eid=<?php echo $post->ID; ?>" class="dropdown-item fs-7 text-dark"><?php echo __("Edit","premiumpress"); ?> </a>
         
          <a href="javascript:void(0);"  onclick="ajax_delete_cashout('<?php echo $post->ID; ?>')"  class="dropdown-item fs-7 text-dark"><?php echo __("Delete","premiumpress"); ?></a>
       
        <a href="admin.php?page=members&eid=<?php echo $user_id; ?>"  class="dropdown-item fs-7 text-dark"><?php echo __("User Profile","premiumpress"); ?></a>
         
  </div> 
  
</div> 
  
  
  
  </td>
</tr>
