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

global $CORE, $userdata, $post;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$args = array('posts_per_page' => 1, 'post_type' => "listing_type", 'orderby' => "rand" );
if( get_user_meta($userdata->ID,'da-seek2',true) != "" ){ 			 
$seek2 = get_user_meta($userdata->ID,'da-seek2',true);				  
$args['tax_query'] = array( array( 'taxonomy' => 'dagender', 'field' => 'term_id', 'terms' => $seek2, "post__not_in" => array($post->ID)  )  );			
}	
 
$NextUserLink = home_url()."/?s=";
$query1 = new WP_Query( $args ); 
if ( $query1->have_posts() ) {
	while ( $query1->have_posts() ) { $query1->the_post();	
		$NextUserLink = get_permalink($post->ID);
	}

}	
wp_reset_query();

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////	
$found_user_data = 0;		
if($userdata->ID){
	$data = get_post_meta($post->ID,'new_likes_array',true); 
	if(is_array($data) && !empty($data)){	
		if(array_key_exists($userdata->ID, $data)){		
		 $found_user_data = $data[$userdata->ID];	 	
		}	
	} 
}	
 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(_ppt(array('user','likes')), array("","1"))){ ?>


 

<div class="d-flex justify-content-between position-relative mb-4 hide-mobile">



<div class="heart-btn w-100">
      <div class="content shadow-sm bg-white">
        <span class="heart"></span>
        <span class="text text-600"><?php echo __("Hit","premiumpress"); ?></span>
        <span class="numb"><?php echo $CORE->USER("get_likes_count", $post->ID); ?></span>
      </div> 
</div>
 <div class="mx-3 y-middle opacity-5">
 
 <?php echo __("or","premiumpress"); ?>
 </div>
  
   <div class="w-100">
 <div class="miss-btn bg-white" onclick="_bar_not();">
      <div class="content shadow-sm text-center text-600 ">       
        <span class="text"><i class="fa fa-sync fa-spin" style="display:none;"></i> <?php echo __("Miss","premiumpress"); ?></span>      
      </div>
    </div> 
</div>
 
</div>

 
 

<script>

function MobileBit(){
	var wins = jQuery(window).width(); 
	if (wins  < 575){	
	jQuery('#likebar-wrap').addClass('<?php if(_ppt('footer_mobile_menu') == 1){ echo "mobile-bit48"; }else{ echo "mobile-bit0"; } ?> bg-primary');	
	}else{	 
	jQuery('#likebar-wrap').removeClass('<?php if(_ppt('footer_mobile_menu') == 1){echo "mobile-bit48"; }else{ echo "mobile-bit0"; } ?> bg-primary');	
	}
}
</script>
 
<div class="card card-body border bg-primary likebar-wrap show-mobile" id="likebar-wrap">
<div class="d-flex justify-content-between text-center likebar">
<div class="_btn" data-toggle="tooltip" data-placement="top" title="<?php echo __("Try Again","premiumpress"); ?>" onclick="_bar_new();"> <i class="fa fa-redo text-secondary"></i> </div>
<div class="_btn big nolike" data-toggle="tooltip" data-placement="top" title="<?php echo __("Dislike","premiumpress"); ?>" onclick="_bar_not();"> <i class="fa fa-times text-danger"></i> </div>
<div class="_btn big like" data-toggle="tooltip" data-placement="top" title="<?php echo __("Like","premiumpress"); ?>" onclick="_bar_like()"> <i class="fa fa-heart text-success"></i> 
<span class="ripple"></span><span class="ripple"></span><span class="ripple"></span>
</div>
<div class="_btn afavs" data-toggle="tooltip" data-placement="top" title="<?php echo __("Add Favorites","premiumpress"); ?>" onclick="_bar_favs();"> <i class="fa fa-star text-warning"></i> </div>
</div> 
</div> 

<div class="text-center small _updaetxt mb-3">
<?php if(is_array($found_user_data)){ 

	$vv = $CORE->date_timediff($found_user_data['date']);				 
	$rdate = strtolower($vv['string-small']);

	if($found_user_data['rating'] == "up"){
	
	echo str_replace("%s",$rdate,__("You liked this user %s","premiumpress"));
	
	}elseif($found_user_data['rating'] == "down"){
	
	echo str_replace("%s",$rdate,__("You disliked this user %s","premiumpress"));
	
	}

 ?>

<?php } ?>
</div> 

 
<script>


jQuery(document).ready(function(){

	jQuery('.heart-btn .content').click(function(){
          jQuery('.content').toggleClass("heart-active")
          jQuery('.text').toggleClass("heart-active")
          jQuery('.numb').toggleClass("heart-active")
          jQuery('.heart').toggleClass("heart-active");
		  
		 var  c = jQuery('.heart-btn .numb').html();
		 jQuery('.heart-btn .numb').html(parseFloat(c)+1);
		  _bar_like();
    
	});

});

<?php if(is_array($found_user_data) && !empty($found_user_data) ){ ?>
jQuery(document).ready(function(){
   
	<?php if($found_user_data['rating'] == "up"){ ?>
	
	jQuery(".likebar .fa-times").removeClass("text-danger").addClass("text-light");
	jQuery(".likebar .ripple").show();
	setTimeout(function(){ 	
	jQuery(".likebar .nolike").attr("data-original-title","<?php echo __("I changed my mind!","premiumpress"); ?>");
	}, 1000);
	<?php }elseif($found_user_data['rating'] == "down"){ ?>
	
	jQuery(".likebar .like i").removeClass("text-success").addClass("text-light");
	
	setTimeout(function(){ 	
		jQuery(".likebar .like").attr("data-original-title","<?php echo __("I changed my mind!","premiumpress"); ?>");
	}, 1000);

	<?php } ?>
   
});
<?php } ?>


function _bar_new(){

	jQuery(".fa-redo").addClass("fa-spin");
 
	setTimeout(function(){ 	
	window.location.href='<?php echo $NextUserLink; ?>';
	}, 2000);


}
function _bar_not(){

		 <?php if(!$userdata->ID){ ?>
		 
		 processLogin(1);
		 
		 <?php }else{ ?>
		 
		 jQuery(".miss-btn i").show();
		 
	_bar_save_rating("down");	
	jQuery(".nolike i").addClass("fa-spin");
	
	setTimeout(function(){ 	
	window.location.href='<?php echo $NextUserLink; ?>';
	}, 2000);
	
	<?php } ?>

}

function _bar_like(){
	
	<?php if(!$userdata->ID){ ?>
		 
		 processLogin(1);
		 
	<?php }else{ ?>
	jQuery(".likebar .fa-times").removeClass("text-danger").addClass("text-light");
	jQuery(".likebar .ripple").show();
	jQuery(".likebar .nolike").attr("data-original-title","").attr("data-toggle","");
	
	_bar_save_rating("up");	 
	
	setTimeout(function(){ 	
	window.location.href='<?php echo $NextUserLink; ?>';
	}, 2000);
	
	
	<?php } ?> 

}

function _bar_favs(){
		
		 <?php if(!$userdata->ID){ ?>
		 
		 processLogin(1);
		 
		 <?php }else{ ?>
		jQuery(".likebar .afavs i").addClass("fa-spin"); 

		jQuery.ajax({
			type: "POST",
			url: ajax_site_url,	
			dataType: 'json',	
			data: {
				'action': "favs",
				'pid': "<?php echo $post->ID; ?>",				 
			},
			success: function(response) {
			  	 
				if(response.status == "add"){
				
				jQuery(".likebar .afavs i").removeClass("fa-heart-broken").addClass("fa-star").addClass("text-warning");
				jQuery(".likebar .afavs").attr("data-original-title","<?php echo __("Add Favorites","premiumpress"); ?>");						 
				
				}else if(response.status == "remove"){
				
				jQuery(".likebar .afavs i").removeClass("fa-star").addClass("fa-heart-broken").removeClass("text-warning");
				jQuery(".likebar .afavs").attr("data-original-title","<?php echo __("Remove Favorites","premiumpress"); ?>");
				 
				}else{	
				
				processLogin();		
							
				}			
			} 
		}); 
	
	setTimeout(function(){ 
	
		jQuery(".likebar .afavs i").removeClass("fa-spin"); 
	
	}, 2000);
	
	<?php } ?>
	
}
hasRated = false;
function _bar_save_rating(vote){
 
	 if(!hasRated){
 	jQuery.ajax({
        type: "POST",  
		url: ajax_site_url,	
        data: {
            action: "rating_likes",
			pid: <?php echo $post->ID; ?>,
            value: vote,
        },
        success: function(e) { 
		
			_bar_favs();
			 
			 if(vote == "up"){
			 jQuery("._updaetxt").html("<?php echo __("Rating Updated","premiumpress"); ?>").addClass("text-success").removeClass("text-danger");
			 }else{
			 jQuery("._updaetxt").html("<?php echo __("Rating Updated","premiumpress"); ?>").addClass("text-danger").removeClass("text-success");
			 }
			 
			 hasRated = true;
        },
        error: function(e) {
             
        }
    });
	}	

}

</script>

 

<?php

}

 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

 
<script>
 

<?php if($CORE->USER("membership_hasaccess", "gifts")){ ?>
function processGifts(){  
		 
   	  
       jQuery.ajax({
        type: "POST",
        url: ajax_site_url,		
   		data: {
               action: "load_gifts", 
			   uid: <?php echo $post->post_author; ?>,
			   pid: <?php echo $post->ID; ?>,  			 
           },
           success: function(response) { 
		    	
		   		//jQuery(".ppt-modal-wrap").addClass("notify-modal upgrade-modal").removeClass("login-modal").fadeIn(400);
   				//jQuery('#ppt-modal-ajax-form').html(response);
			  
				
				pptModal("gifts", response, "modal-bottomxxxx", "ppt-animate-bouncein bg-white ppt-modal-shadow w-700", 0);
				
				
				// UPDATE PRICE DISPLAY
				UpdatePrices();
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
   
} 

<?php } ?> 


function giftshow(){

	jQuery(".extra-modal-wrap").fadeIn(400); 

}

</script>