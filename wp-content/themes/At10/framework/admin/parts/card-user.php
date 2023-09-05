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

 
if(isset($post->ID)){

	$userv = get_user_meta($post->ID,'ppt_verified',true);
	$showmeme = 0;
	if( $CORE->LAYOUT("captions","memberships")  ){
	$showmeme = 1;
	$mem = $CORE->USER("get_user_membership", $post->ID);
	} 


$email = $CORE->USER("get_email",$post->ID);

?>

<tr id="postid-<?php echo $post->ID; ?>">
  <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $post->ID; ?>">
  </td>
  <td>
 
  
  <ul class="list-inline mb-0 ">
      <li class="list-inline-item">
      


<?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $post->ID, "css" => "rounded-circle", "online" => 0)); ?>


       
        
        </li>
      <li class="list-inline-item">
        <div class="font-weight-bold">
		
		<span class="ellipsis" style="max-width:140px;display: inline-block;"><a target="_blank" href="<?php echo $CORE->USER("get_user_profile_link", $post->ID); ?>"><?php echo $CORE->USER("get_name",$post->ID); ?></a></span> 
       
        </div>
        <div class="small btn-block ellipsis" style="max-width:140px;display: inline-block;"><?php echo $email; ?> </div>
      </li>
    </ul>
  
    <?php 
	  
  if($showmeme && isset($mem['user_approved']) && $mem['user_approved'] == "0"){
  
 ?>
 <span class="inline-flex items-center font-weight-bold order-status-icon status-4"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap"><?php echo __("Pending Approval","premiumpress"); ?> </span> </span>
 
 
 <?php } ?>
    
    </td>
  <td class="">
  <?php echo $CORE->USER("get_joined",$post->ID); ?>
  
  <?php if( $showmeme && isset($mem['name'])){
   ?>
   <div class="mt-3">
  <span class="btn btn-system tiny"><i class="fa fa-star text-warning pr-0 mr-1"></i> <?php echo $mem['name']; ?> </span>
  </div>  
  
  <?php }   ?>
  
   <div><?php if($CORE->USER("get_online_status",$post->ID)){ echo $CORE->USER("get_online_badge", 1); } ?></div>
  
  </td>
  <td><?php echo $CORE->USER("get_lastlogin",$post->ID); ?>
    <div>
     
      
      <span class="onlinebadge online text-dark badge border px-2 bg-white">
	  
	  <i class="fa fa-award <?php if( $userv  == 1){ echo "text-success"; }else{ echo "text-danger"; }?>"></i> 
	  
	  <?php if( $userv == 1){ ?>
      <?php echo __("Email Verified","premiumpress"); ?> 
	  <?php }else{ ?>
      <?php echo __("Not Verified","premiumpress"); ?> 
      <?php }?></span>
      
       
    </div>
    
    
    
    </td>
  <td class="text-center"><?php echo $CORE->USER("get_ordertotal",$post->ID); ?></td>
  
  <td><?php $cc = $CORE->USER("get_credit",$post->ID); echo hook_price($cc);  ?></td>
  <td>
  
  
  
  
 <div class="dropdown">
  <button class="btn-system  font-weight-bold dropdown-toggle btn-block" type="button"   data-ppt-btn data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo __("Actions","premiumpress"); ?>
  </button>
  <div class="dropdown-menu quick py-0 text-center">
    
           
           <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=members&eid=<?php echo $post->ID; ?>" class="dropdown-item fs-7 text-dark"><?php echo __("Edit","premiumpress"); ?> </a> 
  
  
           <?php  
  
    if(isset($post->roles) && !in_array( 'administrator', $post->roles ) ){ ?>
  <a href="javascript:void(0);" onclick="ajax_delete_user('<?php echo $post->ID; ?>')" class="dropdown-item fs-7 text-dark"><?php echo __("Delete","premiumpress"); ?></a>
  <?php } ?>
         
         
         
        <a href="admin.php?page=email&lefttab=sendemail&email=<?php echo $email; ?>&uid=148"  class="dropdown-item fs-7 text-dark"><?php echo __("Send Email","premiumpress"); ?></a>
         
  </div>
</div>   
  


  
  
   </td>
</tr>
<?php } ?>