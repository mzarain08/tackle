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

	// GET POST META
	$news_id = get_post_meta($post->ID,'news_id',true);
	 
	$news_status = get_post_meta($post->ID,'status',true);
 	
	$news_date = get_post_meta($post->ID,'date',true);	 
	
 	$type = get_post_meta($post->ID,'type',true); 
	 
	$user_id = get_post_meta($post->ID,'userid',true);
 
  	$show = get_post_meta($post->ID,'show',true); 

	
	$msg = $post->post_content;
	
	$date_end = get_post_meta($post->ID,'date_end',true);


// IMAGE
$title = "";
$image = "";
if($type == 1){
$image = get_post_meta($post->ID,'image',true);
$title = __("Custom Popup","premiumpress");
}elseif($user_id != ""){
$image =  $CORE->USER("get_avatar",$user_id);
$title = $CORE->USER("get_username", $user_id); ;
}
 
 
?>

<tr id="postid-<?php echo $post->ID; ?>">
  
  
  <td><input class="checkbox1" type="checkbox" name="check[]" onclick="jQuery('#actionsbox').show();" value="<?php echo $post->ID; ?>">
  </td>
  
  
  <td>
  
  <div class="d-flex">
  
     
      <div class="list-inline-item" >
      
     <?php echo $CORE_UI->IMAGES("image", array("size" => "xxs", "src" => $image, "css" => "rounded mr-2", "link"=> 0)); ?>

        
        </div>
      
      
      <div>
        <div class="font-weight-bold"> <?php echo $title; ?> </div>
        
        
        <div class="small mt-2"><span class="tiny opacity-8">
		
		<?php echo __("Ends","premiumpress"); ?>	
        
		 <span class='ppt-countdown d-inline-flex' data-ppt-countdown="<?php echo $date_end; ?>" 
         data-newsid="<?php echo $post->ID; ?>" 
         data-expire="" 
         data-timezone="<?php echo get_option('gmt_offset'); ?>"  
         data-ontick="ajax_ontick_auction"></span> 
		  </span> </div>
       
      </div>
    </div>
    
    </td>
    
    
 

    <td style="text-align:center;">
  
  
 
  
  </td>
  

  
  
  <td style="text-align:center;">
  
  <?php 
  
   $views = get_post_meta($post->ID,"hits",true) ;
   if(!is_numeric($views)){ $views =0; }

	echo number_format($views);
	
   ?>
  
  </td>
  
     <td style="text-align:center;">
  
 
 <?php echo $CORE->ADVERTISING("popup_fields", array("show",$show)); ?>
 
 </td>
  
  
 
 
  
  <td><?php
 
// ORDER STATUS
 
$stats  = array(

	"1" => array("name" => __("Pending","premiumpress"), "color" => "bg-warning", ),
	"2" => array("name" => __("Rejected","premiumpress"), "color" => "bg-danger", ),
	"3" => array("name" => __("Live","premiumpress"), "color" => "bg-success", ),
);
if(isset($stats[$news_status]['name'])){
?>
    <div style=" padding:8px; color:#fff; font-weight:bold; text-align:center; font-size:11px; width:100%; float:right; text-transform:uppercase" class="rounded <?php echo $stats[$news_status]['color']; ?>"><?php echo $stats[$news_status]['name']; ?></div>
    <?php } ?>
  </td>
 
  
  
  
  <td>
  
  <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=news&eid=<?php echo $post->ID; ?>" class="btn btn-system btn-md  btn-block"><?php echo __("Edit","premiumpress"); ?> </a> 
  
  <a href="javascript:void(0);" onclick="ajax_delete_news('<?php echo $post->ID; ?>')"  class="btn btn-system btn-md  btn-block"><?php echo __("Delete","premiumpress"); ?></a>
  
  </td>
  
  
  
</tr>
