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

  
<div class="fs-lg text-600 mb-2"><?php echo __("My Comments","premiumpress"); ?></div>
 
<p class="mb-4"><?php echo __("Here you can manage your comments and feedback.","premiumpress"); ?></p>


<div class="col-md-4 px-0 mb-3">
    <select class="form-control" onchange="showcomments(this.value);">
   <option value="all"><?php echo __("All Comments","premiumpress"); ?></option>
   
    <option value="1"><?php echo __("Published","premiumpress") ?></option>
   <option value="0"><?php echo __("Pending Review","premiumpress") ?></option>
   
    </select>
</div>
 
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
    <div ppt-border1 class=" mb-4 p-3 comment-<?php echo $comment->comment_ID; ?> comment-approved-<?php echo $comment->comment_approved; ?>">
 
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
  
<hr />

<div class="opacity-5"><?php echo __("No comments found","premiumpress") ?></div>

  <?php } ?>
 
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
