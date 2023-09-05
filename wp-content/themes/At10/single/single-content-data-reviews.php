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

global $CORE, $CORE_UI, $post, $userdata, $new_settings;

  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
// BUILD COMMENT FORM
$ratingLabels = $CORE->LAYOUT("captions","rating");
 

// GET COMMENTS
if(isset($post->ID )){
$c = get_comments( array ('fields' => 'ids', 'post_id' => $post->ID ) );
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$ratingData = array(
"score" 		=> 0, 
"votes" 		=> 0, 
"comments" 		=> array(), 
"rating_score" 	=> array(
	"5" => 0,
	"4" => 0,
	"3" => 0,
	"2" => 0,    
	"1" => 0, 	
	),
);

if( is_admin() || ( !isset($post->ID) || get_post_meta($post->ID,"ppt-demo",true) == "1" && empty($c) )  ){ 
$ratingData = array(
"score" 		=> 9, 
"votes" 		=> 2, 
"comments" 		=> array(
	1 => array(
		"ID" => 1,
		"desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. 
		Mauris ornare tempor nulla.", 
		"date" => date("Y-m-d"), 			
		"author" => 1, 
		"author_name" => $CORE->USER("get_display_name",1), 			
		"pid" => 1,	
		"score" => 5
	),
	2 => array(
		"ID" => 1,
		"desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. 
		Mauris ornare tempor nulla.", 
		"date" => date("Y-m-d"), 			
		"author" => 1, 
		"author_name" => $CORE->USER("get_display_name",1), 			
		"pid" => 1,		
		"score" => 4	 
	),

), 
"rating_score" 	=> array(
	"5" => 1,
	"4" => 1,
	"3" => 0,
	"2" => 0,    
	"1" => 0, 	 
	),
);
}

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!empty($c)){
 
	foreach($c as $commentid){
	 			 		
		$user_rating = get_comment_meta( $commentid, 'ratingtotal', true );
		if(!is_numeric($user_rating)){ $user_rating = 5; }				
				 
			$get_comment = get_comment( $commentid );
			 
			if(in_array(THEME_KEY,array("mj","pj")) && $get_comment->user_id == $post->post_author){ continue; }
			 
								
			$ratingData["comments"][$commentid] = array(						
					"ID"		 	=> $commentid,
					"desc" 			=> strip_tags($get_comment->comment_content), 
					"date" 			=> $get_comment->comment_date, 			
					"author" 		=> $get_comment->user_id, 
					"author_name" 	=> $CORE->USER("get_display_name",$get_comment->user_id), 			
					"pid" 			=> $get_comment->comment_post_ID,	
					"score" 		=> $user_rating,
			);
			
		 
				
			$ratingData["votes"]++; 
				
			$ratingData["score"] = $ratingData["score"] + $user_rating;
				
			$r = round($user_rating);	
			$ratingData["rating_score"][$r] = $ratingData["rating_score"][$r] + 1;
								 
	}
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
 /*
 <textarea style="width:100%; height:400px;">
<?php print_r($ratingData); ?>
</textarea>
 */
 
 
 
?>

<?php if(count($ratingData['comments']) == 0 && in_array(THEME_KEY,array("dt","es","cm","vt","so","ll","sp","cp","rt","cb")) &&  in_array(_ppt(array('design','display_comments')), array("","1"))  ){ ?>

<div class="border rounded p-4 opacity-8 overflow-hidden position-relative text-center">

<div><?php 

$link = "";
if(!$userdata->ID){ $link = 'onclick="processLogin();"'; }else{ $link = 'onclick="processCommentPop();"'; }
echo str_replace("%s", '<a href="javascript:void(0)" '.$link.' class="text-underline text-dark text-500">'.__("write a review","premiumpress").'</a>', __("Be the first to %s","premiumpress")); ?> <i class="fal fa-comment-alt-edit"></i>  </div>
</div>

<?php }elseif(count($ratingData['comments']) == 0 ){ ?> 

<input type="hidden" name="ppt-count-comments-0" class="ppt-count-comments-0" />


<script>
jQuery(document).ready(function() {
	jQuery(".ppt-single-reviews-wrapper").hide();
});
</script>

<?php } ?> 



<?php if(count($ratingData["comments"]) > 0){ ?>
<?php if(_ppt(array('user','ratings_breakdown')) != "0"){ ?>
<div class="card card-reviews-ratings" >
<div class="card-body">

<div class="row">

    <div class="col-md-6">
    
        <div class="bg-light p-4 rounded mb-4 mb-sm-0">
        
        <h4><?php echo __("Average user rating","premiumpress") ?></h4>
        
        <div class="d-flex align-items-baseline">
       
        <span class="text-800 fs-lg"><?php if($ratingData['votes'] > 0){ echo number_format(round($ratingData['score']/$ratingData['votes'],2),1); }else{ echo 0; } ?></span> 
        
        <div class="fs-7 ml-1">/ 5</div>
        
        <div class="fs-sm ml-2 opacity-5"><?php if($ratingData['votes'] == 1){ echo __("1 review","premiumpress"); }else{ echo $ratingData['votes']." ".__("reviews","premiumpress"); } ?></div>
        
        </div>
        
        <div class="mt-4">
         
        <?php 
		 
		
		echo $CORE_UI->RATING("stars", array("css" => "", 
		"total" => $ratingData['score'], 
		"total_show" => 0, 
		
		"reviews" => $ratingData['votes'], 
		"reviews_show" => 0, 
		
		"size" => "lg", 
		"bg" => "bg-primary")); ?>
        
        </div>
        
        </div>
    
    </div>
    
    <div class="col-md-6">
    
<?php if( in_array(THEME_KEY,array("dt","es","cm","vt","so","ll","sp","cp","rt","cb")) &&  in_array(_ppt(array('design','display_comments')), array("","1"))  ){ ?>

<a href="javascript:void(0)" <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processCommentPop();"<?php } ?> class="btn btn-system btn-sm float-right">
<?php echo __("Write Review","premiumpress") ?>
</a>

<?php } ?>
    
	<div class="mb-4 text-600"><?php echo __("Rating breakdown","premiumpress") ?></div>
    
    <?php 
	
	$stars = $ratingData['rating_score'];
	
	
	 foreach($stars as $k => $s){
		
		if($ratingData['votes'] > 0){
			$per = round($s/$ratingData['votes']*100,1);
		}else{
			$per = 0;
		}
		
		 
	 ?>
      <div class="row no-gutters mb-2">
      
      <div class="col-2">
      
      <div class="d-flex align-items-baseline small">
      <span style="width:20px;" class="text-600"><?php echo $k; ?></span>
      <i class="fa fa-star"></i>
      </div>
      </div>
     
     <div class="col-10">
     	
        <a href="javascript:void(0);" onclick="jQuery('.crating').hide();jQuery('.crating-<?php echo $k; ?>').show();">
       <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
       </div> 
       </a>
        
        </div>
       
      </div>
      <?php } ?>

    </div>
</div>


</div>
</div>
<?php } ?>
<?php } ?>

<?php
foreach($ratingData['comments'] as $comment){

?>

<div class="card card-rating mt-4 crating crating-<?php echo round($comment['score']); ?>">
<div class="card-body">
<div class="row">

    <div class="col-md-3 text-md-center">
    	
        <div class="row">
        
        <div class="col-3 col-md-12">
        <?php echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => $comment['author'], "css" => "rounded-circle" )); ?>
        </div>
        
        <div class="col-9 col-md-12">
        
        
        
        <div class="text-700"><?php echo $comment['author_name']; ?></div>
        
        <?php if(!in_array(THEME_KEY,array("es","vt","jb","dt"))){ ?>
        <div class="d-inline-flex mx-auto"><?php echo do_shortcode('[RATING_USER uid='.$comment['author'].']'); ?></div>    
		<?php } ?>
    	
        </div>
        
        </div>
    </div>
    <div class="col-md-9 mt-4 mt-sm-0 d-flex align-items-center mobile-text-12"> 
    
    
    <div class="">
    
        <div style="min-height:80px;">
        <?php echo $comment['desc']; ?>
        </div>
     
    
        <div class="mt-2"> 
        <?php echo $CORE_UI->RATING("stars", array("css" => "", "total" => $comment['score'], "total_show" => 0, "reviews_show" => 0, "reviews" => 1, "tooltip" => 0, "size" => "sm", "bg" => "bg-primary")); ?>
        
        </div>
    
     </div>
    
    </div> 

</div>
</div>
</div> 

<?php } 
 



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();

?>

<div class="position-relative">
<textarea id="comment" name="comment" style="min-height:100px;" aria-required="true" class="form-control my-4"></textarea>
<div ppt-icon-24 data-ppt-icon-size="24" style="position:absolute; right:10px; bottom:10px;" class="cursor opacity-5" onclick="jQuery('.fileupload-buttonbar').toggle();" >
                <?php echo $CORE_UI->icons_svg['attachment']; ?>
 </div>

 
</div>

<div class="fileupload-buttonbar" style="display:none;">
  <div class="d-flex justify-content-between align-items-center mt-2 mb-4">
    <div class="custom-file">
      <input type="file" id="gallery" name="commentphoto" class="custom-file-input">
      <label class="custom-file-label" for="gallery"><?php echo __("Select .jpg or .png images only.","premiumpress"); ?></label>
    </div>
  </div>
</div>

 <button id="reviewbtn" type="submit" style="display:none;"><?php echo __("Save Comment","premiumpress"); ?></button>
<?php
$commentfield = ob_get_clean(); 

/*

	3. DISPLAY RATING BOX
	
*/
$formextra = "";
if(THEME_KEY != "pj"){

if(!is_array($ratingLabels) ){  $ratingLabels = array();  }

ob_start(); ?>
<input type="hidden" name="score" value="5" id="rating-score" />
<input type="hidden" name="nocaptcha" value="1" />
<input type="hidden" name="totalratingitems" value="<?php echo count($ratingLabels); ?>" />
<input type="hidden" name="postauthor" value="<?php echo $post->post_author; ?>" />
<div class="container px-0 px-md-2">
  <div class="row" id="ratingCalculate">
    <div class="col-md-8">
      <?php foreach($ratingLabels as $k => $rating){ ?>
      <div class="py-2 border-bottom">
        <div class="row">
          <div class="col-4">
            <label class="pb-0 mb-0 small font-weight-bold text-uppercase text-muted"><?php echo $rating; ?></label>
          </div>
          <div class="col-8">
            <div class="mt-n2">
              <input type="hidden" class="rate-range" data-min="0" data-max="5"  name="rating-val" id="<?php echo $k; ?>"  data-step="1"  value="5">
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php if(count($ratingLabels) < 2){ echo $commentfield; $commentfield = ""; } ?>
    </div>
    <div class="col-md-4 hide-mobile">
      <div class="review-total">
        <div class="rating_avg" data-form="AVG({rating-val})"></div>
        <strong><?php echo __("Your Score.","premiumpress"); ?></strong> </div>
      <div class="rating-smiles">
        <div class="d-flex justify-content-center">
          <div><i class="fal fa-frown"></i></div>
          <div><i class="fal fa-smile"></i></div>
          <div><i class="fal fa-laugh-beam"></i></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$formextra = ob_get_clean();

 
}
 
/*

	4. DISPLAY EVERYTHING
	
*/

if($userdata->ID && !isset($GLOBALS['commentsboxset']) ){

$GLOBALS['commentsboxset'] = 1;

$comments_args = array(
	'class_form' 			=> '',
	'id_form' 				=> 'newcomment',
	'label_submit'			=> '',
	'comment_notes_before' 	=> '',
	'title_reply'			=> '', 
	'title_reply_before' 	=> '',
	'comment_notes_after' 	=> '',
	//'submit_field' 			=> '',
	'comment_field' 		=> "".$formextra.''.$commentfield.'',
	'logged_in_as' 			=> '',
);
?>
<!--msg model -->
<div class="comment-modal-wrap shadow hidepage" style="display:none;">
 
    <div class="comment-modal-container">
    
        <div class="px-4 pt-4 pb-0">
          <div id="comments-ajax-all" style="max-height: 500px;    overflow: hidden;    overflow-y: scroll;"></div>
          <div id="commentsformbody"> <?php echo comment_form( $comments_args, $post->ID ); ?> </div>
        </div>
        <div class="card-footer text-center">
          <button type="button" onclick="jQuery('#reviewbtn').trigger('click');" data-ppt-btn class="btn-primary"><?php echo __("Save Comment","premiumpress"); ?></button>
        </div>
      </div> 
  
</div>
<?php }  ?>