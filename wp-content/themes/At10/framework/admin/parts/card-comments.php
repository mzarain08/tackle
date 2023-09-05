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

if(isset($post->comment_ID)){

$ID = $post->comment_ID;
$UID = 1;
$user_id = 0;
if(get_comment_meta( $ID, 'feedback_from', true ) != ""){
	$UID = get_comment_meta( $ID, 'feedback_from', true );
	$user_id = $UID;
}

$DATE = "";

if(isset($post->comment_date)){
$DATE = $post->comment_date;
}

$TITLE = "";
if(isset($post->comment_content)){
$TITLE = $post->comment_content;
}

$RATING = get_comment_meta($ID, "ratingtotal", true);

$RATINGPID = get_comment_meta($ID, "ratingpid", true);

$TYPE = get_comment_meta($ID, "feedback", true);
 

if($TYPE == 1){  $TYPE = __("User Feedback","premiumpress"); }else{ $TYPE = __("Comment","premiumpress");}
 
  
/*
ay ( [0] => WP_Comment Object ( [] => 1 [comment_post_ID] => 1 [comment_author] => A WordPress Commenter [comment_author_email] => wapuu@wordpress.example [comment_author_url] => https://wordpress.org/ [comment_author_IP] => [] => 2022-01-26 10:54:34 [comment_date_gmt] => 2022-01-26 10:54:34 [comment_content] => Hi, this is a comment. To get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard. Commenter avatars come from Gravatar. [comment_karma] => 0 [comment_approved] => 1 [comment_agent] => [
*/

?>
<tr id="postid-<?php echo $ID; ?>">
  
  
  <td>
  
  <input class="checkbox1" type="checkbox" name="check[]" onclick="jQuery('#actionsbox').show();" value="<?php echo $ID; ?>">
  
  </td>
  
  
  <td><ul class="list-inline mb-0">
      <?php if(is_numeric($user_id) && $user_id > 0){ ?>
      <li class="list-inline-item"> <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark" style="max-width:55px; max-height:45px; overflow:hidden;">
        <?php  echo str_replace("avatar ","avatar img-fluid ",get_avatar( $UID, 50 )); ?>
        </a> </li>
      <?php } ?>
      <li class="list-inline-item mt-n2">
        <div class="pt-3 font-weight-bold"> <?php echo $CORE->USER("get_username", $UID); ?></div>
        <div class="small mt-2"> <span class="tiny opacity-8"><?php echo hook_date($DATE); ?></span> </div>
       
      </li>
    </ul>
    </td>
    
 <td>
  
  
  </td>
  
   <td>
  
<?php if($RATING != ""){ ?>
 <div class="rating-score-small">
     
    <strong class="<?php if($RATING == 0){ ?>bg-primary<?php }else{ echo "rating-color-".number_format($RATING,0); } ?>"><?php if($RATING == 0){ echo "-"; }else{ echo number_format($RATING,1); } ?></strong>
    </div>
    
<?php } ?> 
  </td> 
   
  <td>
  
 <?php echo $TITLE; ?>
 
 <div class="small opacity-5"><?php echo $TYPE; ?></div>
 
 <?php if(is_numeric($RATINGPID)){ ?>
 
 <div class="tiny text-truncate mt-2" style="max-width:200px;"><a href="<?php echo get_permalink($RATINGPID); ?>" target="_blank"><?php echo do_shortcode("[TITLE pid=".$RATINGPID."]"); ?></a></div>
 
 <?php } ?>
  
  </td>  
   <td>
  
  <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=comments&eid=<?php echo $ID; ?>" class="btn btn-system btn-md  btn-block"><?php echo __("Edit","premiumpress"); ?> </a> 
  
  <a href="javascript:void(0);" onclick="ajax_delete_news('<?php echo $ID; ?>')"  class="btn btn-system btn-md  btn-block"><?php echo __("Delete","premiumpress"); ?></a>
  
  </td>
  


</tr>
<?php } ?>