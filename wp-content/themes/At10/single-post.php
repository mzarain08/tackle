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
    
global $post, $CORE; 
   
   $GLOBALS['flag-blog'] = true;
   $GLOBALS['flag-page-sidebar'] = 1;

   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
$month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
$socialshare = "";
ob_start();
?>
<div id="socialbar" class="socialbar social-buttons">

<div class="sharertitle hide-mobile">

<span class="total-count"><?php  echo $day; ?></span>

<span class="total-text"><?php echo $month; ?></span>

</div>


<div class="sharebutton">

<?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "md","share" => 1)); ?>


</div>
<div class="small float-right hide-ipad hide-mobile sharebutton">
<div class="pt-2 opacity-5">
<?php the_category(','); ?>
</div>
</div>
</div>
<?php 
$socialshare = ob_get_contents();
ob_end_clean(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_header();  

_ppt_template( 'single','breadcrumbs' );

_ppt_template( 'page-before' );
 
$blog_header = get_post_meta($post->ID,'blog_header',true);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>



<div class="card-mobile-transparent mobile-negative-margin-x text-black"  ppt-border1>
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
 
<?php if($blog_header != "no"){ ?> 

<img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo strip_tags(do_shortcode('[TITLE]')); ?>" class="card-img-top img-fluid">

<div class=" p-4">

<h1 class="py-lg-4 py-3 mt-4"><?php echo do_shortcode('[TITLE]'); ?></h1>

<?php if(in_array(_ppt(array('design', 'blog_share')), array("","1"))){ echo $socialshare; } ?>
</div>


<?php } ?>


<div class="blog_content p-4"> <?php echo str_replace(" wp-image"," img-fluid wp-image",do_shortcode('[CONTENT media=0]')); ?> </div>

<?php if ( comments_open() ){ ?>
<div class="mt-4 p-4">
<?php 
			
			 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if($post->comment_count == 0 && $post->post_author == 1 && defined('WLT_DEMOMODE')){
 
	
?>
   <div class="block-header">
        <h5 class="block-header__title"> 3 <?php  echo __("Comments","premiumpress"); ?></h5>
        <div class="block-header__divider">
        </div>
      </div>
<?php 
	
	_ppt_template('content-comment-example');	

}else{
	
	// BUILD COMMENT BLOCK
	ob_start();
	try {
	
		comments_template();  // GET THE DEFAULT WORDPRESS TEMPLATE FOR COMMENTS
 	
	}
	catch (Exception $e) {
	ob_end_clean();
	throw $e;
	}  
	$comment_form = ob_get_clean();
	echo preg_replace("/<form.*?<\/form>/is","", $comment_form);


}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


ob_start();

?>
<textarea id="comment" name="comment" style="min-height:100px; height:100px;" aria-required="true" class="form-control my-4 shadow-sm"></textarea>

<?php if(_ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>
<div class="g-recaptcha" style="float:none;" data-sitekey="<?php echo stripslashes(_ppt(array('captcha','sitekey'))); ?>"></div>
<div></div>
<?php } ?>

<div class=" mt-2 clearfix w-100">
<button class="btn btn-system btn-xl shadow-sm" type="submit"><span><?php echo __("Post Comment","premiumpress"); ?></span></button>
</div>
<?php
$commentfield = ob_get_clean();
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if($userdata->ID){

$comments_args = array(
	'class_form' 			=> '',
	'id_form' 				=> 'newcomment',
	'label_submit'			=> '',
	'comment_notes_before' 	=> '',
	'title_reply'			=> '', 
	'title_reply_before' 	=> '',
	'comment_notes_after' 	=> '',
	//'submit_field' 			=> '',
	'comment_field' 		=> ''.$commentfield.'',
	'logged_in_as' 			=> '',
);

comment_form( $comments_args, $post->ID );
}else{
?>
<div class="text-center text-muted p-2 py-4 bg-light"> <i class="fal fa-comments mr-2"></i> <?php echo __("Please login to post a comment.","premiumpress"); ?> </div>
<?php }  ?>
</div>
<?php } ?>
 
 
<?php endwhile; endif; ?>
 

</div>

<?php echo _ppt_template( 'page-after' ); ?>

<?php get_footer(); ?>