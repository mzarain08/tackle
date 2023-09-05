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
   
   global $CORE, $userdata, $settings, $post; 

 
 
   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
	} 							   
  
?>
 
<style>
 
.card-share :is(header, .icons, .field){  display: flex;  align-items: center;  justify-content: space-between;}
.card-share .icons a{  display: flex;  align-items: center;  border-radius: 50%;  justify-content: center;  transition: all 0.3s ease-in-out;}
.card-share .icons{  margin: 15px 0 20px 0; padding: 0px;} 
.card-share .icons a{  height: 50px;  width: 50px;  font-size: 20px;  text-decoration: none;  border: 1px solid transparent;}
.card-share .icons a i{  transition: transform 0.3s ease-in-out;}
.card-share .icons a:nth-child(1){  color: #1877F2;  border-color: #b7d4fb;}
.card-share .icons a:nth-child(1):hover{  background: #1877F2;}
.card-share .icons a:nth-child(2){  color: #46C1F6;  border-color: #b6e7fc;}
.card-share .icons a:nth-child(2):hover{  background: #46C1F6;}
.card-share .icons a:nth-child(3){  color: #e1306c;  border-color: #f5bccf;}
.card-share .icons a:nth-child(3):hover{  background: #e1306c;}
.card-share .icons a:nth-child(4){  color: #f64c5b;  border-color: #f64c5b;}
.card-share .icons a:nth-child(4):hover{  background: #f64c5b;}
.card-share .icons a:nth-child(5){  color: #0088cc;  border-color: #b3e6ff;}
.card-share .icons a:nth-child(5):hover{  background: #0088cc;}
.card-share .icons a:hover{  color: #fff;  border-color: transparent;}
.card-share .icons a:hover i{  transform: scale(1.2);}
.card-share .field{  margin: 12px 0 -5px 0;  height: 45px;  border-radius: 4px;  padding: 0 5px;  border: 1px solid #e1e1e1;}
.card-share .field.active{  border-color: #000;}
.card-share .field i{  width: 50px;  font-size: 18px;  text-align: center;}
.card-share .field.active i{  color: #000;}
.card-share .field input{  width: 100%;  height: 100%;  border: none;  outline: none;  font-size: 12px;}
 
</style>

<div class="card-share">


 <ul class="icons">
        <a href="https://www.facebook.com/sharer.php?url=<?php echo get_permalink($post->ID); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/share?url=<?php echo get_permalink($post->ID); ?>&amp;text=<?php echo urlencode($post->post_title); ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a>
         <?php if(THEME_KEY !="vt"){ ?>
        <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID); ?>&amp;description=<?php echo urlencode($post->post_title); ?>" target="_blank" rel="nofollow"><i class="fab fa-pinterest"></i></a>
       <?php } ?>
        <a href="https://www.linkedin.com/cws/share?url=<?php echo get_permalink($post->ID); ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin"></i></a>

</ul>

      <p class="small opacity-8"><?php echo __("Or copy link","premiumpress"); ?></p>
      <div class="field">
        <i class="fa fa-link"></i>
        <input type="text" readonly id="copylink" value="<?php echo get_permalink($post->ID); ?>">
        <button class="btn-primary btn-sm text-600 js-copy-link text-center" data-ppt-btn data-clipboard-target="#copylink" style="min-width:60px;"><?php echo __("Copy","premiumpress"); ?></button>
      </div>

</div>

<script>      
jQuery(document).ready(function(){  
	setTimeout(function() {
		var clipboard = new ClipboardJS('.js-copy-link');
		clipboard.on('success', function(e) { 
		
		jQuery(".card-share .field").addClass("active");
		
		 alert("<?php echo __("Link saved to your clipboard.","premiumpress"); ?>");
		 
		 });
		 
	},5000);
});                     
</script> 