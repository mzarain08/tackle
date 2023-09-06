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

global $CORE_ADMIN, $settings, $CORE;

 

// START MAIN ARRAY
$configsettings = array(




'lang' => array(		
	 
	"n" => __("Languages","premiumpress"), 	
	
	"desc-small" => __("Here you can change the language settings for your website.","premiumpress"),
				
	"desc" => __("Here are all of the language settings for your website.","premiumpress"),
	
	"plugin" => array("name" => "Install Language Editor", "link" => home_url()."/wp-admin/plugin-install.php?tab=plugin-information&plugin=loco-translate") ,
	
	"resetlang" => 1 ,
	
	"video" => array(
	
		1 => array(
		
			"title" => "How to setup multiple languages.",
			"link" => "https://www.youtube.com/watch?v=4yoCSvH8xjU",		
			
		),
				
		
		2 => array(
		
			"title" => "How to setup menu navigation bars in multiple languages.",
			"link" => "https://www.youtube.com/watch?v=Zz8WZhf_JuA",		
			
		),
		
		3 => array(
		
			"title" => "How to update your own language files using loco translate.",
			"link" => "https://www.youtube.com/watch?v=Mm1SMYSSu5c",		
			
		),	
		
		4 => array(
		
			"title" => "How to change text on your website.",
			"link" => "https://www.youtube.com/watch?v=G68QcvQ1U40",		
			
		),	 
		 
	),
	
	"icon" => "fa-language",
	"data" => array(
	
	  
	  
	  
		 "langcustom" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "language",
			 "col12" => true 
		 ),		

	),
), 

 
 
'company' => array(	

	
	"n" => __("My Company Details","premiumpress"), 	
	"desc-small" => __("Update company details and website information.","premiumpress"),		
	"desc" => __("Update company details and website information.","premiumpress"),
		
	
	"back" => "overview",
	
 	"icon" => "fa-briefcase",
	
	"data" => array(	
	
		
		"companymap" 		=> array("name"=> __("Map","premiumpress"), "type" => "custom", "icon" => "fal fa-map-marker",  "path" => "companymap", "col12" => true ),
		
			
	),
), 


'pagelinks' => array(		
	 
	
	"n" => __("Page Links","premiumpress"), 	
	"desc-small" => __("Setup button and page links here by selecting custom pages.","premiumpress"),	
		
	"desc" => __("Page links tell the theme where to send users when they click on links and buttons.","premiumpress"),
	
		
	"video" => "https://www.youtube.com/watch?v=SK7dgyP5H4Q",
	 
	 "icon" => "fa-link",
	 
	 "data" => array(
	 
		 "links" => array( 
				 "name" => "", 
				 "desc" => "",
				 "type" => "custom", 
				 "path" => "pagelinks",
				 "col12" => true 
			),	
	),
	 
), 


'menu' => array(		
	 
	
	"n" => __("Mobile Menu","premiumpress"), 	
	"desc-small" => __("Here you can setup your website mobile menus.","premiumpress"),	
		
	"desc" => __("Here you can setup your website menus.","premiumpress"),
	
		
	//"video" => "https://www.youtube.com/watch?v=SK7dgyP5H4Q",
	 
	 "icon" => "fa-bars",
	 
	 "data" => array(
	 
		 "links" => array( 
				 "name" => "", 
				 "desc" => "",
				 "type" => "custom", 
				 "path" => "mobile",
				 "col12" => true 
			),	
	),
	 
), 






'adsense' => array(		
	 
	
	"n" => __("Google Adsense","premiumpress"), 	
	"desc-small" => __("Here you can enter your Google Adsense API key.","premiumpress"),			
	"desc" => __("Here are all the Google Adsense settings for your website.","premiumpress"),

	"link" => "https://www.google.com/adsense/",
	
	"icon" => "fa-ad",
	"data" => array(
	
		 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => __("This will turn on/off Analytics for your website.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0",
			 "col4" => 1,
		 ),
		 
	  
		 "code" => array(
		 
			 "name" => __("Your AdSense code","premiumpress"), 
			 "desc" => __("This will be provided to you once you've created an account.","premiumpress"),
			 "placeholder" => "UA-123456-x",
			 "d" => "" ,
			 "col4" => 1 , 
			 "type" => "textarea" 
		 ),	
		 
		), 
		 
		
		 
),


'analytics' => array(		
	 
	
	"n" => __("Google Analytics","premiumpress"), 	
	"desc-small" => __("Here you can enter your Google Analytics API key.","premiumpress"),			
	"desc" => __("Here are all the Google Analytics settings for your website.","premiumpress"),

	"link" => "https://analytics.google.com/analytics/web/",
	
	"icon" => "fa-signal-alt",
	"data" => array(
	
		 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => __("This will turn on/off Analytics for your website.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0",
			 "col4" => 1,
		 ),
		 
	  
		 "uakey" => array(
		 
			 "name" => __("Google Analytics UA Key","premiumpress"), 
			 "desc" => __("This is required by Google to use their Analytics code on your website.","premiumpress")." <a href='https://analytics.google.com/analytics/' style='font-weight:bold;'><u>Get your key here.</u></a>",
			 "placeholder" => "UA-123456-x",
			 "d" => "" ,
			 "col4" => 1,  
		 ),	
		 
		  "uakeyv4" => array(
		 
			 "name" => __("Google Analytics V4 Key","premiumpress"), 
			 "desc" => __("If you are using a new v4 key, enter the code here.","premiumpress"),
			 "placeholder" => "G-xxxxx",
			 "d" => "" ,
			 "col4" => 1,  
		 ),	

	),
), 

'captcha' => array(		


	"n" => __("Google Captcha V2","premiumpress"), 	
	"desc-small" => __("Google Captcha is designed to help reduce spam on your website.","premiumpress"),			
	"desc" => __("This is to stop bots commenting. If turned OFF there will be no CAPTCHA security code.","premiumpress"),
	
	"link" => "https://www.google.com/recaptcha/intro/v3.html",
	
	"video" => "https://www.youtube.com/watch?v=9ayUf4jIo7k",

	"icon" => "fa-project-diagram",
	"data" => array(	
			
		 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => "",
			 "type" => "yesno", 
			 "d" => "0",
			 "col4" => 1,  
		 ),
		 
		 
		 "sitekey" => array(
		 
			 "name" => __("Site Key","premiumpress"), 
			 "desc" => "You can get your own key using the link here: <a href='https://www.google.com/recaptcha/' target='_blank'>https://www.google.com/recaptcha/</a>",
			 
			 "d" => "",
			 "col4" => 1, 
		 ),	
		 
		 
		 "secretkey" => array(
		 
			 "name" => __("Secret Key","premiumpress"), 
			 "desc" => "",
			 
			 "d" => "",
			 "col4" => 1, 
		 ),			 
		 	 


	),
), 





   
/*
'gateways' => array(	


	"n" => __("Payment Gateways","premiumpress"), 	
	"desc-small" => __("Here you can setup and configure payment gateways for your website.","premiumpress"),			
	"desc" => __("Here you can setup and configure payment gateways for your website.","premiumpress"),
	
	"video" => "https://www.youtube.com/watch?v=jBVnWQi8Xlw",
	 
	"icon" => "fa-shopping-cart",
	"data" => array(
	
	
 		"exr" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "gateways",
			 "col12" => true 
		 ),	
		 		 
		 
		 
	),		 
),
*/

/*
'coupons' => array(	


	"n" => __("Coupon Codes","premiumpress"), 	
	"desc-small" => __("Here you can setup discount codes for your website.","premiumpress"),			
	"desc" => __("Here you can setup discount codes for your website.","premiumpress"),

 	"video" => "https://www.youtube.com/watch?v=atAAYYUuo4o",
	
	"icon" => "fa-cut",
	"data" => array(
	
	
	 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => __("Turn on/off discount codes during payment.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0"  
		 ),
		 
	 
 		"exr1" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "coupons",
			 "col12" => true 
		 ),			 
		 
		 
	),		 
),
*/

'currency' => array(	


	"n" => __("Currency Settings","premiumpress"), 	
	"desc-small" => __("Here you can change the currency settings for your website.","premiumpress"),			
	"desc" => __("Here are all of the currency settings for your website.","premiumpress"),

 
	"icon" => "fa-sack-dollar",
	"data" => array(
	
	
 		"switch" => array(
		 
			 "name" => __("Currency Switcher","premiumpress"), 
			 "desc" => __("Turn on/off the display of the currency switching button.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "1",
			  
		 ),	
	 

		 
 		"code" => array(
		 
			 "name" => "Code (eg. USD)", 
			 "desc" => "",
			 "type" => "text", 
			 "d" => "USD" ,
			  "col6" => true
		 ),	
		 
		 
 		"position" => array(
		 
			 "name" => __("Symbol Position","premiumpress"), 
			 "desc" => "",
			 "type" => "select", 
			 "values" => array( 1=> array("id" => "left", "name" => "Left (e.g $100)"), 2 => array("id" => "right", "name" => "Right (e.g 100$)"), ),
			  "col6" => true 
		 ),	
		 	 
		 /*
 		"dec" => array(
		 
			 "name" => __("Decimal Places","premiumpress"), 
			 "desc" => "",
			 "type" => "select", 
			 "values" => array( 1=> array("id" => "0", "name" => "0"), 2 => array("id" => "1", "name" => "1"), 3 => array("id" => "2", "name" => "2"), 4 => array("id" => "3", "name" => "3"), ) ,
			 "col6" => true
		 ),			 
		 
		 
		 */
		 
		 "s" 	=> array( "seperator" => true),	 		 
	  
		 "exr" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "exchangerates",
			 "col12" => true 
		 ),		

	),
), 


/*
'gdpr' => array(	


	"n" => __("GDPR Cookie Law","premiumpress"), 	
	"desc-small" => __("Here you can turn on the accepty GDPR cookies option.","premiumpress"),			
	"desc" => __("Here you can turn on the accepty GDPR cookies option.","premiumpress"),
 
 	"video" => "https://www.youtube.com/watch?v=7yfq6n05TNQ",
	
	"icon" => "fa-cookie",
	"data" => array(
	
	
	 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => __("Turn on/off  the display of the 'accept cookies' option in the footer of your website.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0"  
		 ), 
		 
		 
	),		 
),
 
'adultwarning' => array(	


	"n" => __("Adult Notice 18+","premiumpress"), 	
	"desc-small" => __("Here you can turn on adult only content notices.","premiumpress"),			
	"desc" => __("Here you can turn on adult only content notices.","premiumpress"),
 
 	"video" => "https://www.youtube.com/watch?v=7yfq6n05TNQ",
	
	"icon" => "fa-exclamation-circle",
	"data" => array(
	
	
	 "enable" => array(
		 
			 "name" => __("Enable","premiumpress"), 
			 "desc" => __("Turn on/off  the display of the 'adult content' at the bottom of your website.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "0"  
		 ), 
		 
		 
	),		 
),
*/

/*
'blog' => array(	


	"n" => __("Blog","premiumpress"), 	
	"desc-small" => __("Here are additional settings for the built-in blog pages.","premiumpress"),			
	"desc" => __("Here are additional settings for the built-in blog pages.","premiumpress"),
 
	"icon" => "fa-rss",
	"data" => array(
	
	
	 "enablesocial" => array(
		 
			 "name" => __("Social Sharing","premiumpress"), 
			 "desc" => __("Turn on/off the social media sharing buttons.","premiumpress"),
			 "type" => "yesno", 
			 "d" => "1"  
		 ),
		 
	 
 		 		 
		 
		 
	),		 
),*/


 



'comchat' => array(	


	"n" => __("Atom Integration","premiumpress"), 	
	"desc-small" => __("Atom are a third-part chatroom software provider.","premiumpress"),			
	"desc" => __("Here you can setup Atom software on your website.","premiumpress"),

 	"video" => "https://youtu.be/bUDRwX2j8vo",
	
	"link" => "https://a.paddle.com/v2/click/11855/127045?link=3219",
	
	"icon" => "fa-comment-alt-smile",
	"data" => array(
	 
		 
	 
 		"exr1" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "comchat",
			 "col12" => true 
		 ),			 
		 
		 
	),		 
),


'sms' => array(	


	"n" => __("SMS","premiumpress"), 	
	"desc-small" => __("Here you can setup SMS provide options.","premiumpress"),			
	"desc" => __("We have integrated multiple SMS API which allow you to send SMS messages to your users. You will need an account with credit to use this feature.","premiumpress"),
	
	"link" => "https://www.nexmo.com/",
 
	"icon" => "fa-mobile-android",
	"data" => array(
	
	
		 //"s" 	=> array( "seperator" => true),	 		 
	  
		 "exr" => array( 
			 "name" => "", 
			 "desc" => "",
			 "type" => "custom", 
			 "path" => "sms",
			 "col12" => true 
		 ),	 
	),		 
),

 
);



if(!in_array(THEME_KEY,array("da","es"))){
unset($configsettings['comchat']);
}

 



// TURN OFF SETTINGS
if(THEME_KEY == "sp"){
unset($configsettings['user']['data']['allow_profile']);
}

if(THEME_KEY == "vt"){
unset($configsettings['user']['data']['author_reputation']);
}
  

?>

<style>
#overview-box { display:none; }
</style>
 
  <div class="tab-content <?php if(!isset($_GET['firstinstall'])){ ?>d-flex flex-column h-100<?php } ?>">
  
    
    
        <div class="tab-pane addjumplink show active" 
        data-title="<?php echo __("Overview","premiumpress"); ?>" 
        data-icon="fa-home" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
         <?php _ppt_template('framework/admin/parts/settings-overview' ); ?>  
                               
        </div>  
        
        
         <div class="tab-pane  addjumplink" 
        data-title="<?php echo __("License Key","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can change your license key.","premiumpress"); ?>"
        data-icon="fa-key" 
        id="cleaning" 
        role="tabpanel" aria-labelledby="cleaning-tab">
        
        <?php _ppt_template('framework/admin/parts/settings-cleaning' ); ?>

          
        </div><!-- end design home tab -->      
    
   
      
        
        
         <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Taxonomies","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can setup your own custom taxonomies.","premiumpress"); ?>"
        data-icon="fa-filter" 
        id="taxonomies" 
        role="tabpanel" aria-labelledby="taxonomies-tab">
        <?php _ppt_template('framework/admin/parts/settings-taxonomies' ); ?>          
        </div><!-- end design home tab -->    
     
        
    
    <?php 
	
	global $settings;
	$i=1; foreach($configsettings as $k => $d){ ?>
    
    
     <div class="tab-pane addjumplink" 
     data-title="<?php echo $d['n']; ?>" 
     data-icon="<?php echo $d['icon']; ?>"
     data-desc="<?php echo $d['desc-small']; ?>"
     
      
     id="<?php echo $k; ?>" role="tabpanel" aria-labelledby="<?php echo $k; ?>-tab">
     
   
      <?php
 
 	$vid = "";
 	if(isset($d['video'])){ $vid = $d['video']; }
	
	$link = "";
 	if(isset($d['link'])){ $link = $d['link']; }
 	
	$plugin = "";
 	if(isset($d['plugin'])){ $plugin = $d['plugin']; }
 
  	$settings = array("title" => $d['n'], "desc" => $d['desc'], "video" => $vid, "link" => $link , "plugin" => $plugin, "back" => "overview",);
  	 _ppt_template('framework/admin/_form-wrap-top' ); 
	 
	 
	 
	 ?>  
    
    
    <div class="card card-admin"><div class="card-body">
    
    <div class="row">
    <?php if(is_array($d['data'])){ foreach($d['data'] as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, $k); } } ?>  
    </div>
    
   
    <div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    	</div>
    
    
     </div>
    
 
	<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>  
     
  
  </div> </div>
    
    
    <?php $i++; } ?>
    

    

<?php /* if( $CORE->LAYOUT("captions","listings") ){ ?>

     <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Listing Settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can setup listing packages for your website.","premiumpress"); ?>"
        data-icon="fa-layer-plus" 
        id="packages" 
        role="tabpanel" aria-labelledby="packages-tab">
<?php  _ppt_template('framework/admin/parts/listings-packages' ); ?> 
        </div>      
       
        
      <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Custom Fields","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can setup cutom fields for your listings.","premiumpress"); ?>"
        data-icon="fa-cube" 
        id="customfields" 
        role="tabpanel" aria-labelledby="customfields-tab">
<?php  _ppt_template('framework/admin/parts/listings-fields' ); ?> 
        </div>  
        */ ?>
           
          
  <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Maps &amp; Distance Searches","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can configure website map options.","premiumpress"); ?>"
        data-icon="fa-map-marker" 
        id="maps" 
        role="tabpanel" aria-labelledby="maps-packages-tab">
		 <?php _ppt_template('framework/admin/blocks/maps' ); ?>
        </div> 
         
    
 
    
    
    
    
    
    
    
    </div>
   
 

<script>
 
jQuery(document).ready(function(){
  // Add smooth scrolling to all links
  jQuery(".runmenow").on('click', function(event) {
   	var id = this.id;	
 	
	// switch tab
	jQuery('#myTab li:nth-child(2) a').tab('show');
	
	// set tab value
	jQuery('.tabinner').val('settings-tab');
	
	// SET ACCORDIAN TAB
	jQuery('.ShowThisAccordianTab').val('#collapse'+jQuery(this).data('id')); 
	
	// HIDE ALL TABS
	jQuery('.addsection').hide();
	
	// SHOW ONLY THIS ONE
	jQuery('#'+id).show();
	
	// open collapse	 
	jQuery('#collapse'+jQuery(this).data('id')).collapse('show');
  
  });
});

</script>