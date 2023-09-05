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

$sp = get_post_meta($post->ID ,'sponsored', true);
$sf = get_post_meta($post->ID ,'featured', true);
$sh = get_post_meta($post->ID ,'homepage', true);
		

 
?>

<tr id="postid-<?php echo $post->ID; ?>">
  <td><input class="checkbox1 mb-4" type="checkbox" name="check[]" onclick="jQuery('#actionsbox').show();" value="<?php echo $post->ID; ?>">
  </td>
  <td class="px-0">
  
   
  
<div class="d-inline-flex align-self-baseline font-weight-bold w-100">
  
  	<?php  if(in_array(THEME_KEY, array("cp"))){  }elseif(in_array(THEME_KEY, array("pj"))){ ?>
    
    <div class="mr-3">
    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">
	<?php echo $CORE_UI->IMAGES("image", array("size" => "xxs", "uid" => $post->post_author, "css" => "rounded", "link"=> 1)); ?>
    </a>
    </div>
    
    <?php }else{ ?>
    
    <div class="mr-3">
    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">
    <div  ppt-border1 class="position-relative overflow-hidden rounded-lg" style="width:60px; height:50px;">	
		<div class="bg-image"  data-bg="<?php echo do_shortcode("[IMAGE pathonly=1 pid='".$post->ID."']"); ?>"></div>
    </div>
    </a>
    </div>
    
    <?php } ?> 
    
    <div>
    
    <div class="text-truncate w-100" style="max-width:250px;; min-height:30px;">
    
    <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" class="text-dark"><?php  echo $post->post_title; ?></a>
    
    </div>
    
    
<nav class="pl-0 fs-sm" ppt-nav>
<ul>
<li>
<?php if(in_array(THEME_KEY, array("cp"))){ 
			echo do_shortcode('[STORENAME]');  }elseif(in_array(THEME_KEY, array("da"))){
			echo do_shortcode('[GENDER]');  }else{ 
			echo str_replace("a hr","a target='_blank' hr",do_shortcode('[CATEGORY]')); } ?>



</li>
    <?php if(!in_array(THEME_KEY, array("cp","sp","cm"))){ ?>
<li><a href="admin.php?page=members&eid=<?php echo $post->post_author; ?>" target="_blank" class="font-weight-normal text-truncate" style="max-width:100px;"><?php echo $CORE->USER("get_username", $post->post_author); ?></a></li><?php } ?>

<?php if(in_array(THEME_KEY, array("dt")) && get_post_meta($post->ID,"claimed",true) != ""){ ?>
<li><span class="badge badge-warning"><?php echo __("claimed","premiumpress"); ?></span></li>
<?php } ?>

<?php if( $CORE->LAYOUT("captions","listings")  && get_post_meta($post->ID ,'listing_expiry_date', true) != ""){ ?>
          
<li><?php echo do_shortcode('[TIMELEFT postid="'.$post->ID.'" layout="1" text_before="" text_ended="Not Set" key="listing_expiry_date"]'); ?> </li>

<?php } ?>
 
</ul>
    
          
    


</div> 
  
  
  
  
 </td>
    
  <?php if(in_array(THEME_KEY, array("at"))){ ?>
  
  <td class="text-center"><?php  echo do_shortcode('[STATUS]'); ?>
    <div class="small mt-2">
      <?php  echo do_shortcode('[BIDS]'); ?>
      <?php echo __("bids","premiumpress"); ?></div>
      
      </td>
      
      
  <?php }elseif(in_array(THEME_KEY, array("dt"))){ ?>
  
  <td class="text-center"> 
  
   <?php  echo do_shortcode('[LEADS]'); ?>
      
      </td>



  <?php }elseif(in_array(THEME_KEY, array("cp"))){ ?>
  <td class="text-center"><div class="small mt-2">
      <?php  //echo do_shortcode('[RATING]'); ?>
    </div>
    <div class="mt-2 small">
      <?php  if(do_shortcode('[VERIFIED]') == 1){ ?>
      <span class="text-success"><i class="fa fa-check"></i> <?php echo __( 'Verified', 'premiumpress' ); ?></span>
      <?php }else{ ?>
      <span><?php echo __( 'Not Verified', 'premiumpress' ); ?></span>
      <?php } ?>
    </div></td>
  <?php }elseif(in_array(THEME_KEY, array("ct","dl","jb","mj"))){ ?>
  <td class="text-center"><?php  echo do_shortcode('[OFFERS]'); ?>
    <?php if(in_array(THEME_KEY, array("ct","dl","jb"))){ ?>
    <div class="small text-muted">
      <?php if(get_post_meta($post->ID, "status", true ) == 0){ ?>
      <?php echo __("available","premiumpress"); ?>
      <?php }else{ ?>
      <strong><?php echo __("unavailable","premiumpress"); ?></strong>
      <?php } ?>
    </div>
    <?php } ?>
  </td>
  <?php } ?>


  <td class="text-center">
 
  
    <?php  echo do_shortcode('[HITS]'); ?>
 
  
</td>
  
  
  
  
  
  <td class="text-center"><?php if(in_array(THEME_KEY, array("dt")) && _ppt(array('design', 'single-offers'))  == '1'){ ?>
    <?php if(get_post_meta($post->ID, "claimed", true ) == ""){ ?>
    <span class="text-muted">-</span>
    <?php }else{ ?>
    <div class="btn btn-system btn-sm"><i class="fa fa-check text-success"></i> <?php echo __("claimed","premiumpress"); ?></div>
    <?php } ?>
    <?php }elseif(in_array(THEME_KEY, array("dt")) ){ ?>
    <?php  echo do_shortcode('[CITY]'); ?>
    <?php }elseif(in_array(THEME_KEY, array("cp"))){ ?>
    <?php  echo do_shortcode('[USED]'); ?>
    <?php }elseif(in_array(THEME_KEY, array("vt"))){ ?>
    
	
	<?php  echo do_shortcode('[MEMBERSHIP-BADGE]');  ?>
    
    
	
	<?php }elseif(in_array(THEME_KEY, array("ph"))){ ?>
    <?php  echo do_shortcode('[DOWNLOADS]'); ?>
    
    <?php }elseif(in_array(THEME_KEY, array("da","es"))){ ?>
    <?php  echo do_shortcode('[AGE]'); ?>
    
    <?php }else{ ?>
    <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo do_shortcode('[PRICE]'); ?></span>
    <?php } ?>
  </td>
  <td class="text-center"> 
     
 
    <?php echo $CORE->PACKAGE("get_status_formatted",  $post->ID ); ?> 
    
    <?php if(THEME_KEY != "sp"){ ?>
    <div class="small mt-2">
      <?php  $pp =  $CORE->PACKAGE('get_package',$post->ID); if(is_array($pp)){ echo $pp['name']; } ?>
    </div>
    <?php } ?> 
    
  </td>
  <td>
  
<div class="d-flex">  
  
 <div class="dropdown">
  <button class="btn-system  font-weight-bold dropdown-toggle btn-block" type="button"   data-ppt-btn data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo __("Actions","premiumpress"); ?>
  </button>
  <div class="dropdown-menu quick py-0 text-center">
    
      <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=listings&eid=<?php echo $post->ID; ?>" class="dropdown-item fs-7 text-dark"><?php echo __("Edit","premiumpress"); ?> </a>
         
          <a href="javascript:void(0);" onclick="ajax_listing_delete('<?php echo $post->ID; ?>')"  class="dropdown-item fs-7 text-dark"><?php echo __("Delete","premiumpress"); ?></a>
       
        <a href="admin.php?page=comments&eid=0&pid=<?php echo $post->ID; ?>"  class="dropdown-item fs-7 text-dark"><?php echo __("Add Comment","premiumpress"); ?></a>
         
  </div> 
  
</div> 
   
    <?php
		 
		 
		 ?>    
 <div class="dropdown ml-2">
  <button class="btn-system  font-weight-bold dropdown-toggle btn-block" type="button"   data-ppt-btn data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-star"></i>
    

<?php if($sf == 1){ ?><span class="text-danger fs-md my-2" style="position: absolute;    top: -20px;    right: 0px;">&bull;</span><?php } ?>
<?php if($sp == 1){ ?><span class="text-warning fs-md my-2" style="position: absolute;    top: -10px;    right: 0px;">&bull;</span><?php } ?>
<?php if($sh == 1){ ?><span class="text-green fs-md my-2" style="position: absolute;    top: 0px;    right: 0px;">&bull;</span><?php } ?>
  
    
  </button>
  <div class="dropdown-menu quick py-0 text-center">
    
<div class="dropdown-item cursor" onclick="ajax_featured_listing('<?php echo $post->ID; ?>','featured');">

	<span  style="cursor:pointer;" class="<?php if($sf != 1){ ?>opacity-5<?php } ?> featured-icon-<?php echo $post->ID; ?>">
		<i class="fa fa-check <?php if($sf == 1){ ?>text-success<?php } ?> pr-0 mr-0" style="font-size:12px; opacity:1!important;color:#fbfbfb"></i>
	</span>

	<span class="ml-2 d-inline-flex"><span class="text-danger fs-md mr-2">&bull;</span> <?php echo __("Featured","premiumpress"); ?></span>

</div>
      
<div class="dropdown-item cursor" onclick="ajax_featured_listing('<?php echo $post->ID; ?>','homepage');" style="cursor:pointer;">

	<span  class="<?php if($sh != 1){ ?>opacity-5<?php } ?> homepage-icon-<?php echo $post->ID; ?>">
		<i class="fa fa-check <?php if($sh == 1){ ?>text-success<?php } ?> pr-0 mr-0" style="font-size:12px;opacity:1!important;color:#fbfbfb"></i>
	</span>

	<span class="ml-2 d-inline-flex"><span class="text-green fs-md mr-2">&bull;</span> <?php echo __("Homepage","premiumpress"); ?></span>

</div>     
 
<?php if(_ppt(array('lst','addon_sponsored_enable')) == "1"){ ?>
<div class="dropdown-item cursor" onclick="ajax_featured_listing('<?php echo $post->ID; ?>','sponsored');">

	<span  style="cursor:pointer;" class="<?php if($sp != 1){ ?>opacity-5<?php } ?> sponsored-icon-<?php echo $post->ID; ?>">
	<i class="fa fa-check  pr-0 mr-0 <?php if($sp == 1){ ?>text-success<?php } ?>" style="font-size:12px;opacity:1!important; color:#fbfbfb"></i>
    </span>

	<span class="ml-2 d-inline-flex"><span class="text-warning fs-md mr-2">&bull;</span> <?php echo __("Sponsored","premiumpress"); ?></span>
                
</div>
<?php } ?>
      
      
  </div> 
  
</div> 
  
</div>
  
  
  </td>
</tr>
