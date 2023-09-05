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
if (!defined('THEME_VERSION')) {	footer('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $CORE; 
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(!isset($GLOBALS['flag-docs'])){ wp_footer(); }
 
do_action('hook_footer_after'); 




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if( in_array(THEME_KEY,array("da","es")) && _ppt(array("comchat","msg_enable")) == "1" && _ppt(array('comchat','appid')) != "" && _ppt(array("comchat","authkey")) != "" && !isset($GLOBALS['COMCHATSET']) ){  $GLOBALS['COMCHATSET'] = 1; ?>
<script>
  var chat_appid = '<?php echo _ppt(array("comchat","appid")); ?>';
  var chat_auth = '<?php echo _ppt(array("comchat","authkey")); ?>';
    var chat_id = '<?php echo $userdata->ID; ?>';
    var chat_name = '<?php echo $CORE->USER("get_username", $userdata->ID); ?>';
    var chat_avatar = '<?php echo $CORE->USER("get_avatar", $userdata->ID); ?>';
    var chat_link = '<?php echo $CORE->USER("get_user_profile_link", $userdata->ID); ?>';
</script>
<script>
  (function() {
    var chat_css = document.createElement('link'); chat_css.rel = 'stylesheet'; chat_css.type = 'text/css'; chat_css.href = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.css';
    document.getElementsByTagName("head")[0].appendChild(chat_css);
    var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.js'; var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
  })();
</script>
<?php }

 

_ppt_template( 'footer-notify' ); 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!$userdata->ID && _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ /* ?>
<script> 
function reloadgp(){
grecaptcha.render('g-recaptcha-id', {
    sitekey: "<?php echo _ppt(array('captcha','sitekey')); ?>",
    callback: function(response) {
        console.log(response);
    }
});
}
</script>
<?php*/ } 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(isset($GLOBALS['flag-slickslider'])){
?>

<script src="<?php echo CDN_PATH.'js/js.plugins-slickslider.js'; ?>"></script>
<script> jQuery(document).ready(function(){  

<?php if($GLOBALS['flag-slickslider'] == "1"){ ?>
       var slider = jQuery('.gallery-items').slick({
          centerMode: false,
		  adaptiveHeight: true,
          centerPadding: '0',
          slidesToShow: <?php if(in_array(THEME_KEY, array("so"))){ echo 1; }else{ echo 3; }?>,
          slidesToScroll: 1,
          autoplay: true,
		  
		  autoplaySpeed: 6000,
          prevArrow: '',
          nextArrow: '',
           responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					arrows: false,
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
				  }
				}
				 
			  ]
    }); 
	
	jQuery('.gallery-items').attr('dir', 'ltr');

<?php }elseif($GLOBALS['flag-slickslider'] == "2"){ ?>


     jQuery('.gallery-items').slick({
          centerMode: false,
          centerPadding: '0',
          slidesToShow: 1,
          slidesToScroll: 1,
		  autoplaySpeed: 10000,
		  adaptiveHeight: true,
          autoplay: true,
          prevArrow: '<span class="fal fa-angle-left left"></span>',
          nextArrow: '<span class="fal fa-angle-right right"></span>',
		   <?php if(isset($GLOBALS['flag-slickslider-filecount']) && is_array($GLOBALS['flag-slickslider-filecount']) && count($GLOBALS['flag-slickslider-filecount']) > 3){ ?>
          asNavFor: '.gallery-items-nav'
		  <?php } ?>
    });
	  <?php if(isset($GLOBALS['flag-slickslider-filecount']) && is_array($GLOBALS['flag-slickslider-filecount']) && count($GLOBALS['flag-slickslider-filecount']) > 1){ ?>
	jQuery('.gallery-items').attr('dir', 'ltr');
    
    jQuery('.gallery-items-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.gallery-items',
      dots: false,
	  
      nav:false,
	  prevArrow: '',
          nextArrow: '',
      centerMode: true,
      focusOnSelect: true
    });
	
	jQuery('.gallery-items-nav').attr('dir', 'ltr');
	<?php } ?>


<?php } ?>
    
}); </script>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(defined('WLT_DEMOMODE') && !$userdata->ID || get_option("ppt_license_key") == ""){ ?>
<script>window.addEventListener("load",function(){function n(n,e){e=document.createElement("script");e.src="https://image.providesupport.com/"+n,document.body.appendChild(e)}n("js/0hrtty9k9a7pa1tkfndzj3oe32/safe-monitor-sync.js?ps_h=vaZF&ps_t="+Date.now()),n("sjs/static.js")})</script>

<?php } 
/*
if(_ppt(array('gdpr','enable')) == 1 && !isset($_SESSION['ppt-cookie'])  ){ ?>
<input type="hidden" value="0" ppt-addon-cookielaw />
<?php }
*/


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 if( _ppt(array('design','loadinline')) == 0 && !is_admin() && isset($GLOBALS['flag-home']) && ( _ppt(array('adultwarning','enable')) == 1   ) ){  ?>
 
<?php } 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>


<?php

	// CUSTOM JQUERY
	if(strlen(get_option('custom_js')) > 10){ echo stripslashes(get_option('custom_js')); }
 
	// GOOGLE ANALYTICS
	if(_ppt(array('analytics','enable')) == '1'){
 		
		
		if(strlen(_ppt(array('analytics','uakeyv4'))) > 1){
		
		ob_start();
		?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo stripslashes(_ppt(array('analytics','uakeyv4'))); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo stripslashes(_ppt(array('analytics','uakeyv4'))); ?>');
</script>
<?php
		echo ob_get_clean(); 
		
		}else{
		ob_start();
		?>
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');		
		  ga('create', '<?php echo stripslashes(_ppt(array('analytics','uakey'))); ?>', 'auto');
		  ga('send', 'pageview');		
		</script>
<?php
		echo ob_get_clean(); 
		}
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('maps','enable')) == 1){ ?>

<div id="locationMap">
</div>
<!--map-modal -->
<div class="map-modal-wrap shadow hidepage" style="display:none;">
  <div class="map-modal-wrap-overlay">
  </div>
  <div class="map-modal-item">
    <div class="map-modal-container">
      <div class="map-modal">
        <div id="singleMap"  data-latitude="54.2890174" data-longitude="-0.4024484">
        </div>
      </div>
      <div class="card-body">
        <h3><a href="#" class="text-dark">&nbsp;</a></h3>
        <div class="address text-muted small letter-spacing-1">
        </div>
        <div class="map-modal-close bg-primary text-center">
          <i class="fal fa-times">&nbsp;</i>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['elementor-preview'])){

 ?>
<!--global modal -->
 
<div class="ppt-modal-wrap shadow hidepage" style="display:none;">
  <div class="ppt-modal-wrap-overlay"></div>
  
  <div class="ppt-modal-item">  
    <div class="ppt-modal-container">
      <div id="ppt-modal-ajax-form">
      </div>
      <div class="ppt-modal-close text-center">
        <i class="fa fa-times">&nbsp;</i>
      </div>
      <div class="card-footer ppt-modal-footer text-center" style="display:none;">
        <button type="button" onclick="jQuery('.ppt-modal-wrap').fadeOut(400);" class="btn btn-system shadow-sm btn-xl"><?php echo __("Close Window","premiumpress"); ?></button>
      </div>
    </div>
  </div>  
</div>

<script>
jQuery(document).ready(function() {
	jQuery(".ppt-modal-wrap-overlay").on("click", function (e) {
 console.log("footer - mofdal wrap click");
	jQuery(".ppt-modal-wrap").removeClass('show').fadeOut(400);		
	});
});								

</script>
<?php 
} 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!is_admin() && defined("THEME_KEY") && !isset($_GET['ppt_live_preview']) &&  current_user_can('administrator') && !ppt_check_preview_mode() && in_array(_ppt(array('design', 'admin_popup')), array("","1")) && !isset($GLOBALS['flag-add'])  && !isset($GLOBALS['flag-register']) && !isset($GLOBALS['flag-login']) && !isset($GLOBALS['flag-no-admin-helper']) && !isset($GLOBALS['flag-home-demo']) ){ 
$de = "";
if(isset($post->ID)){
$de =  "&current_template_id=".$post->ID;
}

$admin_links = array(
	"users" => array(
		
		"title" => __("Manage Users","premiumpress"),
		"link" => home_url()."/wp-admin/admin.php?page=members",
		"icon" => "fa fa-user",
	),
	"listings" => array(
		
		"title" => str_replace("%s", $CORE->LAYOUT("captions","2"),__("Manage %s","premiumpress")),
		"link" => home_url()."/wp-admin/admin.php?page=listings",
		"icon" => $CORE->LAYOUT("captions","icon"),
	),
	
	"dash" => array(
		
		"title" => __("Dashboard","premiumpress"),
		"link" => home_url()."/wp-admin/admin.php?page=premiumpress",
		"icon" => "fa fa-tachometer-alt",
	),
	
	"manage" => array(
		
		"title" => __("Site Manager","premiumpress"),
		"link" => home_url()."/wp-admin/admin.php?page=ppt_editor",
		"icon" => "fa fa-desktop",
	),
	
	"inlineeditor" => array(
		
		"title" => __("Text Editor","premiumpress"),
		"link" => home_url()."/wp-admin/admin.php?page=ppt_editor",
		"icon" => "fa fa-pencil",
	),
 
 
);

if( !$CORE->LAYOUT("captions","memberships") ){ 
unset($admin_links['memberships']);
}

?>

 <div class="ppt_admin_quickeditor hide-mobile" style="display:none;">
    <a class="ppt_admin_quickeditor-fab ppt_admin_quickeditor-btn-large" id="ppt_admin_quickeditorBtn"><img data-src="<?php echo CDN_PATH; ?>images/premiumpress-white.png" class="img-fluid p-3 lazy" /></a>
    <ul class="ppt_admin_quickeditor-menu">
    <?php foreach($admin_links as $k => $l){ ?>
      <li <?php if(!isset($_GET['inline-editor'])){ ?>data-toggle="tooltip" data-placement="top" title="<?php echo $l['title']; ?>"<?php } ?>>
      <a <?php if($k == "inlineeditor"){ ?>href="<?php if(isset($_GET['inline-editor'])){ echo ppt_current_page(); }else{ ?>?inline-editor=1<?php } ?>" <?php }else{ ?>href="<?php echo $l['link']; ?>"  target="_blank" <?php } ?> class="ppt_admin_quickeditor-fab ppt_admin_quickeditor-btn-sm scale-transition scale-out btn-<?php echo $k; ?>"><i class="<?php echo $l['icon']; ?>"></i></a>
      
      </li>
      <?php } ?> 
    </ul>
  </div> 
  
<script>

jQuery(document).ready(function(){ 

	jQuery('#ppt_admin_quickeditorBtn').click(function() {
	  
	  jQuery('.ppt_admin_quickeditor-btn-sm').toggleClass('scale-out');
	  if (!jQuery('.ppt_admin_quickeditor-card').hasClass('scale-out')) {
		jQuery('.ppt_admin_quickeditor-card').toggleClass('scale-out');
	  }
	});
	
	jQuery('.ppt_admin_quickeditor-btn-sm').click(function() {
	  var btn = jQuery(this);
	  var card = jQuery('.ppt_admin_quickeditor-card');
	
	  if (jQuery('.ppt_admin_quickeditor-card').hasClass('scale-out')) {
		jQuery('.ppt_admin_quickeditor-card').toggleClass('scale-out');
	  }	  
	  
	});

});
</script>
<?php } ?>