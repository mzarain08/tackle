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
	$data = $CORE->FUNC("format_logtype", $post->ID );
	 
	$user_id = $data['userid'];
	
	$key = explode("(",$data['name']);
	
	// NAME
	$name = notify_string_filter($data, $data['title_from'], "from");
	
	// DESC
	$desc = notify_string_filter($data, $data['desc_from'], "from");
	
	
	 
?>

<tr id="postid-<?php echo $post->ID; ?>" class="logclass <?php if(isset($key[1])){ echo str_replace(")","",$key[1]); } ?>">
  <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $post->ID; ?>">
  </td>
  <?php if(is_numeric($user_id)){ ?>
  <td>
  
  
  
  
  <ul class="list-inline mb-0 ">
      <li class="list-inline-item"> 
        <?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $user_id, "css" => "rounded-circle", "online" => 0)); ?>

        
        
        
        
         </li>
      <li class="list-inline-item">
        <div class="font-weight-bold mb-2"><?php echo $name; ?></div>
        <div class="small btn-block"> <?php echo $desc; ?> </div>
      </li>
    </ul>
    
    
    
    
    </td>
  <?php }else{ ?>
  <td><?php  echo $data['name']; ?>
  </td>
  <?php } ?>
  
  
  
  <td><?php  echo $data['time']; ?></td>
  <td><i class="<?php echo $data['icon']; ?> fa-2x float-left pr-3"></i></td>
  <td><a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=reports&eid=<?php echo $post->ID; ?>" class="btn btn-system btn-md  btn-block"><?php echo __("Edit","premiumpress"); ?> </a> <a href="javascript:void(0);"  onclick="ajax_delete_log('<?php echo $post->ID; ?>')"   class="btn btn-system btn-md   btn-block"><?php echo __("Delete","premiumpress"); ?></a> </td>
</tr>
