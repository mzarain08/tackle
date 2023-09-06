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

global $CORE, $post, $userdata, $new_settings; 

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->thistheme = THEME_KEY;
	}

 $buttonStyle = 1;
 
$btnClass = "btn-primary btn-block btn-lg list mb-3";

if(isset($GLOBALS['single-data-button-css'])){
$btnClass .= " ".$GLOBALS['single-data-button-css'];
}
if(isset($GLOBALS['single-data-button-new-css'])){
$btnClass = $GLOBALS['single-data-button-new-css'];
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$inElementor = 0;
if(is_admin() || isset($GLOBALS['docs-preview']) ){
$inElementor = 1;
}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['single-data-button'])){

	$buttonStyle = $GLOBALS['single-data-button'];
	
	if(isset($GLOBALS['single-data-button-size'])){
		$btnClass .= " ".$GLOBALS['single-data-button-size'];
	}
	
}elseif(isset($new_settings['button_type'])){

	$buttonStyle  = $new_settings["button_type"];
	
	$btnClass .= " ".$new_settings["button_size"];
	if($new_settings["button_block"] == 1){
	$btnClass .= " btn-block";
	}
 
	
	
}else{

$btnClass .= " btn-sm";

}


  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch($buttonStyle){

	case "message": {
	
		$title =  __("Send Message","premiumpress");
		
		if(THEME_KEY == "dt"){
		$title =  __("Contact Business","premiumpress");
		}
		
		theme_sidebar_buttons("contact", $title, 1, $btnClass );
	
	} break;
	
	case "offer": {
		
		if(in_array(_ppt(array('design','display_offers')), array("","1")) ){
		
		$GLOBALS['flag-set-makeoffer']=1;
		
		 ?><a href="javascript:void(0);" <?php if($userdata->ID){ ?> onclick="processMakeOffer();"<?php }else{ ?>onclick="processLogin();"<?php } ?> class="<?php echo $btnClass; ?>" data-ppt-btn>
         
			<span><?php echo $CORE->LAYOUT("captions","offerbtn"); ?></span>
			
            </a>
        
		<?php 
		} 
	
	} break;
	
	
	case "demo": {
	
	$url = get_post_meta($post->ID, "url_demo", true);
	
	if($url != ""){ ?>
      <a href="<?php echo $url ?>" class="<?php echo $btnClass; ?>" data-ppt-btn rel="nofollow" target="_blank" data-ppt-btn><span><?php echo __("Try Demo","premiumpress"); ?></span></a>
    <?php 
	} 
	
	} break;
	
	case "website": {
	
	$url = get_post_meta($post->ID, "url", true);
	if($url == ""){
	$url = get_post_meta($post->ID, "website", true);
	}
	
	if(is_admin()){ $url = "##"; }
	
	if($url != ""){ ?>
      <a href="<?php echo $url ?>" class="<?php echo $btnClass; ?>" data-ppt-btn rel="nofollow" target="_blank"><span><?php echo __("Visit Website","premiumpress"); ?></span></a>
    <?php 
	} 
	
	} break;
	
	case "buy_cm": { 
	
	$afflink = get_post_meta($post->ID, 'buy_link', true);
	if(is_admin()){
	$afflink = "####";
	}
	if(strlen($afflink) > 1){ ?>
    
    <a href="<?php echo $afflink; ?>" target="_blank" rel="nofollow" class="btn btn-block btn-primary btn-xl btn-icon shadow icon-before mt-2 mb-3">
    <i class="fal fa-shopping-cart mr-2 text-light"></i> <span><?php echo __("Visit Store","premiumpress") ?></span>
    </a>
    <?php 
	
	}
	
	
	} break;
	
	case "buynow": { 
	
	 
	if(in_array(THEME_KEY,array("ct","dl")) && ( get_post_meta($post->ID,"offertype", true) == 1 || defined('WLT_DEMOMODE') ) ){
	
	
	 ?>
    
     <a href="javascript:void(0);" <?php if($userdata->ID){ ?>onclick="BuyNowOffer();"<?php }else{ ?>onclick="processLogin();"<?php } ?>  class="<?php echo $btnClass; ?>" data-ppt-btn> 
    
    <span><?php echo __("Buy Now","premiumpress"); ?></span> 
    
    </a>
    
   <?php }elseif(in_array(THEME_KEY,array("pj")) ){ $bin_price = get_post_meta($post->ID,'price_bin',true);  ?>
   
   
   <div class="badge_tooltip z-10" data-direction="top">
    <div class="badge_tooltip__initiator"> 
    
    <a href="javascript:void(0);" <?php if($userdata->ID){ ?>onclick="BuyNowOffer();"<?php }else{ ?>onclick="processLogin();"<?php } ?>  class="<?php echo $btnClass; ?>" data-ppt-btn>
    
 <i class="fal fa-handshake text-primary"></i> <span><?php echo __("Accept","premiumpress"); ?> <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $bin_price; ?> </span> </span>
 
 </a>

    </div>
    <div class="badge_tooltip__item text-center"><?php echo __("This amount is set by the employer. Accept this amount to begin work right away.","premiumpress"); ?></div>
  </div> 
    
    <?php } ?> 

<script>
   
function BuyNowOffer(){

<?php if($post->post_author == $userdata->ID){ ?>
alert("<?php echo __("You cannot buy your own items.","premiumpress"); ?>");
return false;
<?php } ?>

<?php if(defined('WLT_DEMOMODEx')){ ?>
alert("This option is disabled in demo mode.");
return;
<?php } ?>

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>"))
		{
		
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_offer_make",
			pid: <?php echo $post->ID; ?>,
			aid: <?php echo $post->post_author; ?>,
			<?php if(in_array(THEME_KEY,array("rt"))){ ?>
			price: jQuery('#offer_price_amount').val(),
			<?php }else{ ?>
			skip_to_buy: 1,
			<?php } ?>
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				window.location.href='<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers&showoid='+response.oid;	
				  
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
		
		}
		else
		{
		 
			e.preventDefault();
		}
}

   
   
   </script>
   

      <?php  
	
	} break;
	
	case "gift": {
		
		 ?>
      
      <a <?php echo _button_gift($post->post_author, $post->ID); ?> class="<?php echo $btnClass; ?>" data-ppt-btn><span><?php echo __("Send Gift","premiumpress") ?></span></a>
 
      <?php 
 
	
	} break;
	
	
	case "download": {
	
	if(!$userdata->ID && _ppt(array('lst', 'requirelogin_downloads' )) == '1'){ 
	$thisLink = 'href="javascript:void(0);" onclick="processLogin();"';
}else{
	$thisLink = 'href="javascript:void(0);" onclick="processDownload('.$post->ID.');"';
} 
		
		 ?>
      
   <button data-ppt-btn class="mobile-buynow-trigger btn btn-lg btn-primary btn-block" <?php echo $thisLink; ?> type="button"> 
      
      <span><?php echo __("Download Now","premiumpress"); ?></span>
      
   </button>
      <?php 
 
	
	} break;
	
	case "favs": {
		
	  	echo do_shortcode('[FAVS text=1 icon=0 class="'.$btnClass.'"]'); 
	
	} break;	
	case "favs1": {
		
		if(in_array(_ppt(array('user','favs')), array("","1")) ){
		 
			 echo do_shortcode('[FAVS text=1 icon=0 tooltip=0 class="btn btn-favs-text p-0 lh-20 mb-3"]');
		
		}
	
	} break;
	
	
	case "cashback": {
	
	$active = 0;
	$title = __("Activate Cashback","premiumpress");
	$pid = $post->ID;
	$btnBG = "btn-primary";
	$active = 0;
	if($userdata->ID){
		
		$data = get_user_meta($userdata->ID,'cashback_array',true);
		if(!is_array($data)){ $data = array(); }
		if(isset($data[$pid]) && isset($data[$pid]) ){
			$title = __("Activated","premiumpress");
			$btnBG = "btn-success";
			$active = 1;
		}
		
		
	}
		
		?>
        
<a href="javascript:void(0);" <?php if($userdata->ID){ ?> onclick="<?php if($userdata->ID && !$active ){ ?>processNewCashback(<?php echo $post->ID; ?>);<?php } ?>processMakeOffer();"<?php }else{ ?>onclick="processLogin();"<?php } ?> class="<?php echo $btnBG; ?> btn-cashback btn-block btn-lg list mb-3" data-ppt-btn><?php echo $title; ?></a>
 
        
        <?php
	
	} break;
	
	case "wink": {
		global $CORE_TEMPLATE; ?>
        
        <a <?php echo _button_wink(); ?> class="<?php echo $btnClass; ?>" data-ppt-btn><?php echo __("Send Wink","premiumpress") ?></a>


<!--wink modal -->
<div style="display:none;" id="modal-wink">
 
      <div class="card-body p-0">
        <div class="">
          <div class="position-relative hero-default" style="height:400px;">
            <div class="bg-image" data-bg="<?php echo do_shortcode("[IMAGE pathonly=1]"); ?>"></div>
            <div class="overlay-inner">
            </div>
            <div class="hero_content z-10">
              <div class="container">
                <div class="d-flex align-items-end flex-column text-light" style="height:400px;">
                  <div class="p-2">
                    &nbsp;
                  </div>
                  <div class="mt-auto p-2 w-100">
                    <div class="winksent" style="display:none;">
                      <div class="h2 font-weight-bold">
                        <?php echo __("Wink Sent!","premiumpress"); ?>
                      </div>
                      <p class="mb-0 pb-0"><?php echo str_replace("%s", $CORE->USER("get_username",$post->post_author), __("We've sent %s a nudge!","premiumpress")); ?></p>
                    </div>
                    <div class="toomnaywinks" style="display:none;">
                      <div class="lead font-weight-bold">
                        <?php echo __("Too Many Winks","premiumpress"); ?>
                      </div>
                      <p class="mb-0 pb-0"><?php echo __("It looks like you've already sent a wink.","premiumpress"); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
       
    </div>

        <script>
		
		function winkshow(){
	
	 
	jQuery(".winksent").hide();
	jQuery(".toomnaywinks").hide();
	
	response = jQuery("#modal-wink").html(); 
 
	pptModal("wink", response, "modal-bottomxxxx", "mm-wink ppt-animate-bouncein bg-white ppt-modal-shadow w-500", 0);
				
	var a = jQuery(".bg-image");
	a.each(function (a) {
		if (jQuery(this).attr("data-bg")) jQuery(this).css("background-image", "url(" + jQuery(this).data("bg") + ")");
	});
	
	jQuery(".filter-modal-wrap").fadeIn(400);
	 
	jQuery.ajax({
			type: "POST",
			url: '<?php echo home_url(); ?>/',	
			dataType: 'json',	
			data: {
				action: "add_wink",
				pid: <?php echo $post->ID; ?>,
				uid: <?php echo $userdata->ID; ?>,
				rid: <?php echo $post->post_author; ?>,						 			
			},
			success: function(response) {
	 
				if(response.status == "ok"){  
				 
				jQuery.ajax({
						type: "POST",
						url: '<?php echo home_url(); ?>/',	
						dataType: 'json',	
						data: {
							action: "send_chat_msg",
							uid: <?php echo $userdata->ID; ?>,
							rid: <?php echo $post->post_author; ?>,
							gift: 99,
							msg: 'gift',			
						},
						success: function(response) {
				 
							if(response.status == "ok"){
							
									jQuery(".mm-wink .winksent").show();
							
							}		
						},
						error: function(e) {
							console.log(e)
						}
				});
				
				 
				} else { 	 		 
				
				jQuery(".toomnaywinks").show();
				 
				}			
			},
			error: function(e) {
				console.log(e)
			}
	});

}
		
		</script>
		
		<?php
	} break;	
	
	case "friends": {
	
		if(_ppt(array('user','friends')) == 1){ ?>

      <?php echo do_shortcode('[BUTTON_USER type="subscribe" class="'.$btnClass.'" text=1 uid="'.$post->post_author.'"]'); ?>
      
	<?php }
	
	} break;	
	
	
	case "report": {
			
		?>        
        <a href="<?php echo _ppt(array('links','contact')); ?>/?report=<?php echo $post->ID; ?>" class="<?php echo $btnClass; ?>" data-ppt-btn>       
        <span><?php echo __("Report","premiumpress") ?></span>        
        </a>
        <?php
		
	} break;	
	
	case "phone": {
	
	
	if(isset($GLOBALS['flag-button-set-phone'])){ return; }	
	$GLOBALS['flag-button-set-phone']=1; 
	
	
	
	$phone = get_post_meta($post->ID, "phone", true);
	
	if($inElementor){
	$phone = "123 456 678";
	}
	
	if(strlen($phone) > 2){ ?>

      <a href="javascript:void(0);" onclick="showPhone()"  class="<?php echo str_replace("btn-primary","",$btnClass); ?> <?php if(THEME_KEY == "dt"){ echo "btn-system"; }else{ echo "btn-primary"; } ?> btn-lg " data-ppt-btn>
      <span class="_text <?php if(THEME_KEY == "dt"){ echo "text-dark"; }else{ echo "text-light"; } ?>"><i class="fal fa-phone-alt mr-2"></i> <span><?php echo __("123 *** ***","premiumpress") ?></span></span>
      <span class="_number" style="display:none;"><?php echo $phone; ?></span>
      </a>
      
      <script>
	  function showPhone(){
	  
	  		jQuery('._text').hide();
	  		jQuery('._number').show();
	  }
	  
	  </script>
      
      <?php 
	 }
	 
	} break;
	
	case "whatsapp": {
	
	$whatsapp = get_post_meta($post->ID, "whatsapp", true);
	if($inElementor){
	$whatsapp = "+44 123 456";
	}
	
	if(strlen($whatsapp) > 2){ ?>

      <a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" rel="nofollow" class="<?php echo str_replace("btn-primary","",$btnClass); ?> btn-whatsapp mobile-buynow-trigger" data-ppt-btn>
      <i class="fab fa-whatsapp mr-2"></i> <span><?php echo __("WhatsApp Me!","premiumpress") ?></span>
      </a>
      
      <?php 
	 }

	
	} break;
}

?>
 