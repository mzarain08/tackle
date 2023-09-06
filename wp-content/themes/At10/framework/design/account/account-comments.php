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

global $CORE, $userdata; 

// RATING VALUES
$gg = array(
	"",
	__('Very Poor',"premiumpress"),
	__('Below Average',"premiumpress"),
	__('Average',"premiumpress"),
	__('Above Average',"premiumpress"),
	__('Perfect',"premiumpress"),
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div class="tabbable-panel" id="commentsTabs">
  <div class="tabbable-line">
    <ul class="nav nav-tabs clearfix hide-mobile">
      <li class="nav-item"> <a href="javascript:void(0);" onclick="showcomments('all');"  class="nav-link py-3 text-dark active" data-toggle="tab"  role="tab"> <span class="px-lg-2 "> <?php echo __("All","premiumpress") ?> </span> <span class="badge badge-pill" id="count-all-comments">0</span> </a> </li>
      <li class="nav-item"> <a href="javascript:void(0);" onclick="showcomments(1);"  class="nav-link py-3 text-dark showcomments-1-btn" data-toggle="tab"  role="tab"> <span class="px-lg-2 offer-txt-approved"><?php echo __("Published","premiumpress") ?></span> <span class="badge badge-pill" id="count-comments-approved">0</span> </a> </li>
      <li class="nav-item"> <a href="javascript:void(0);" onclick="showcomments(0);" class="nav-link py-3 text-dark showcomments-2-btn" data-toggle="tab"  role="tab"> <span class="px-lg-2 offer-txt-pending"><?php echo __("Pending Review","premiumpress") ?></span> <span class="badge badge-pill" id="count-comments-pending">0</span> </a> </li>
    </ul>
  </div>
</div>
<div class="tab-content pb-4 border-0 px-0 mt-4">
  <?php 
$args = array(
	 
	'number' => 50,
	'post_author__in' => array($userdata->ID),
	'meta_query' => array(			 
		array(
			'key'		=> 'feedback',	
			'compare'	=>'NOT EXISTS'
		),			 
	),
		
);
// GET USER FEEDBACK
$c = new WP_Comment_Query($args); 
$comments = $c->comments;
 

if(!empty($comments)){ 
?>
  <div class="ppt-comments">
    <?php foreach($comments as $comment){ 
 
    	
		$settings = array(
		
			"ID" 			=> $comment->comment_ID,
			"desc" 			=> strip_tags($comment->comment_content), 
			"date" 			=> $comment->comment_date, 			
			"author" 		=> $comment->user_id, 
			"author_name" 	=> $CORE->USER("get_name",$comment->user_id), 			
			"pid" 			=> $comment->comment_post_ID, 
			
		);		 
		
		$score = get_comment_meta($settings['ID'],'ratingtotal',true);
		// GET LISTING ID
		$listingid = $settings['pid'];	
		?>
    <div class="border-bottom bg-white rounded mb-4 p-3 comment-<?php echo $comment->comment_ID; ?> comment-approved-<?php echo $comment->comment_approved; ?>">
 
      <div class="comment-wrapper card-feedback">
        <div class="row">
          <div class="col-md-2">
            
            <?php  if(is_numeric($listingid)){ ?>
            <a href="<?php echo get_permalink($listingid); ?>" target="_blank">
            <img class="img-fluid" src="<?php echo do_shortcode("[IMAGE pid='".$listingid."' pathonly=1]"); ?>" alt="">
            </a>
            <?php }else{ ?>
            <div class="pr-lg-3">
            <img class="rounded-circle img-fluid" src="<?php echo $CORE->USER("get_avatar", $userdata->ID ); ?>" alt="user">
            </div>
            <?php } ?>
              
            
          </div>
          <div class="col pl-lg-3">
            <div class="clearfix">
            </div>
            <div class="desc mt-4" style="min-height: 70px;">
              <?php echo $settings['desc']; ?>
            </div>
            <div class="pt-2 mt-3">
              <?php if($comment->comment_approved != 1){ ?>
              <span class="badge badge-warning floar-right mr-3"><?php echo __("Under Review","premiumpress"); ?></span>
              <?php }else{ ?>
              <span class="badge badge-success floar-right mr-3"><?php echo __("Approved","premiumpress"); ?></span>
              <?php } ?>
              
              <span class="small"> <i class="fal fa-calendar mr-2"></i> <?php echo hook_date($settings['date']); ?></span>
              
              <a href="javascript:void(0);" onclick="deletecomment('<?php echo $comment->comment_ID; ?>');" class="btn btn-system btn-sm float-right"><i class="fal fa-trash"></i> <?php echo __("Delete","premiumpress"); ?></a>
              
            </div>
          </div>
          <?php if(is_numeric($score)){ ?>
          <div class="col-md-3">
            <div class="rating-score-big text-center">
              <span><?php echo number_format($score,1); ?></span> <strong><?php echo $gg[number_format($score,0)]; ?></strong>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php  } ?>
  </div>
  <?php }else{ ?>
  
<div class="my-4 bg-white rounded border p-5 text-center">
   <i class="fal fa-comments fa-4x mb-4 text-light"></i>
   <h4>   <?php echo __("No comments found","premiumpress") ?></h4>
</div>

  <?php } ?>
</div>
<script>

jQuery(document).ready(function(){ 

jQuery("#count-all-comments, .count-all-comments").html(parseFloat(jQuery('.comment-approved-1').length) + parseFloat(jQuery('.comment-approved-0').length) );
jQuery("#count-comments-approved, .count-comments-approved").html(jQuery('.comment-approved-1').length);
jQuery("#count-comments-pending, .count-comments-pending").html(jQuery('.comment-approved-0').length);


});

function deletecomment(cid){ 
	
     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',
		   dataType: 'json',		
   		data: {
            action: "comment_trash",
			cid: 	 cid, 
			
           },
           success: function(response) {   			 
			 
			 jQuery(".comment-"+cid).hide();
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       }); 
}

function showcomments(type){

	jQuery('.comment-approved-0').hide();
	jQuery('.comment-approved-1').hide();
	
	jQuery('.comment-approved-'+type).show();
	
	if(type == "all"){
		jQuery('.comment-approved-0').show();
		jQuery('.comment-approved-1').show();
	}
}
</script>
