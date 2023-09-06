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
 
global $CORE, $userdata, $CORE_UI; 

$GLOBALS['home-demo'] = 1;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$theme_key = THEME_KEY; 

//$theme_key = "jb";
$GLOBALS['TEST_THEME_KEY'] = $theme_key;

 
$title = "";
$link = "";
$logotxt = "PremiumPress";
$subtitle = "Create your own website in minutes. <br> Quick to setup &amp; easy to customize.";

$desc = "<strong>Version ".THEME_VERSION."</strong>  Updated <date>".THEME_VERSION_DATE."</date> ";

switch($theme_key){ 

	case "cb": {		
		$title = "Build a {Cashback} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-cashback-theme/";		
		$logotxt = "Cashback<span class='text-700 text-primary'>Theme</span>";				
	} break;
	
	case "at": {		
		$title = "Build an {Auction} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-auction-theme/";		
		$logotxt = "Auction<span class='text-700 text-primary'>Theme</span>";			
	} break;
	
	case "cp": {		
		$title = "Build a {Coupon} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-coupon-theme/";
		$logotxt = "Coupon<span class='text-700 text-primary'>Theme</span>";	
	} break;
	
	case "ct": {		
		$title = "Build a {Classifieds} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-classifieds-theme/";
		$logotxt = "Classifieds<span class='text-700 text-primary'>Theme</span>";		
	} break;
	
	case "dl": {		
		$title = "Build an {Autos} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-car-dealer-theme/";		
		$logotxt = "Autos<span class='text-700 text-primary'>Theme</span>";
	} break;
	
	case "sp": {		
		$title = "Build Your Own {Online Store}";		
		$link = "https://www.premiumpress.com/wordpress-shop-theme/";
		$logotxt = "Shop<span class='text-700 text-primary'>Theme</span>";	
	} break;
	
	case "ll": {		
		$title = "Build Your Own {LMS Website}";		
		$link = "https://www.premiumpress.com/wordpress-lms-theme/";
		$logotxt = "LMS<span class='text-700 text-primary'>Theme</span>";		
	} break;
	
	case "da": {		
		$title = "Build a {Dating} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-dating-theme/";	
		$logotxt = "Dating<span class='text-700 text-primary'>Theme</span>";		
	} break;
	
	case "es": {		
		$title = "Build an {Escorts} <br /> Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-escort-theme/";	
		$logotxt = "Escort<span class='text-700 text-primary'>Theme</span>";	
	} break;	
	
	case "mj": {		
		$title = "Build a {Micro Jobs} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-micro-jobs-theme/";	
		$logotxt = "Jobs<span class='text-700 text-primary'>Theme</span>";		
	} break;
	
	case "dt": {		
		$title = "Build a {Directory} Website Today!";		
		$link = "https://www.premiumpress.com/wordpressdirectory-theme/";
		$logotxt = "Directory<span class='text-700 text-primary'>Theme</span>";		
	} break; 

	case "jb": {		
		$title = "Build a {Job Board} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-job-board-theme/";	
		$logotxt = "Jobs<span class='text-700 text-primary'>Theme</span>";		
	} break;	
		
	case "cm": {		
		$title = "Build a {Comparison} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-price-comparison-theme/";		
		$logotxt = "Compare<span class='text-700 text-primary'>Theme</span>";	
	} break; 

	case "pj": {
		$title = "Build a {Task Desk} Website Today!";
		$link = "https://www.premiumpress.com/wordpress-freelancer-theme/";	
		$logotxt = "Freelancer<span class='text-700 text-primary'>Theme</span>";			
	} break; 
 	
	case "rt": {		
		$title = "Build a {Real Estate} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-real-estate-theme/";
		$logotxt = "Real <span class='text-700 text-primary'>Estate</span>";		
	} break;
 
	case "so": {		
		$title = "Build a {Download} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-digital-download-theme/";
		$logotxt = "Download <span class='text-700 text-primary'>Theme</span>";			
	} break;
	
	case "ph": {		
		$title = "Build a Stock Photo Website";		
		$link = "https://www.premiumpress.com/wordpress-stock-photography-theme/";		
	} break;
	
	case "vt": {		
		$title = "Build a {Video} Website Today!";		
		$link = "https://www.premiumpress.com/wordpress-video-theme/";	
		$logotxt = "Video <span class='text-700 text-primary'>Theme</span>";		
	} break;
	

}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();
?>
<header class="bg-white navbar-light border-bottom elementor_header header7">
  <div class="container py-4">
    <div class="row no-gutters" ppt-flex-center="">
      <div class="col-3">
        <a href="https://www.premiumpress.com">
        <div class="textlogo navbar-brand-dark text-700"><?php echo $logotxt; ?></div>
        </a>
      </div>
      <div class="col">
        <div class="d-flex w-100 ">
          <nav ppt-nav="" ppt-flex-end="" class="seperator spacing hide-mobile hide-ipad text-600 ml-auto">
            <ul>
              <li> <a href="<?php echo home_url(); ?>/#demos" class=""> Templates</a> </li>
              <li> <a href="<?php echo home_url(); ?>/#elementor1" class=""> Elementor</a> </li>
              <li> <a href="<?php echo home_url(); ?>/#sections" class=""> Sections</a> </li>
              <li> <a href="<?php echo home_url(); ?>/#adminarea" class=""> Admin Area</a> </li>
            </ul>
          </nav>
          <div class="ml-auto">
            <a href="<?php echo $link; ?>" class="btn-orange rounded text-600" data-ppt-btn="" data-ppt-btn-txt="">Buy Now</a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<?php 
$header = ob_get_contents();
ob_end_clean();
if (ob_get_level() > 0) {
ob_flush();
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(!defined("THEME_KEY")){

?>
<div class="p-5">
<h1>Theme not installed</h1>
<p>Use the link below to complete the theme setup.</p>
<a href="wp-admin/admin.php?page=premiumpress">Install Theme</a>

</div>
<?php

}else{


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
 
$GLOBALS['flag-home-demo'] = 1;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<style>
body {    background: #ffffff !important;}


.btn-primary { background:#243588!important; }
body .text-primary {    color: #243588!important;} 

.theme-wrap button { opacity:0; }
.theme-wrap:hover button { opacity:1; }
 

</style>
<?php
do_action( 'hero18-css' );

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<input type="hidden"  id="demo-homepage" value="1" />
<input type="hidden" name="notify-stop" class="notify-stop" id="notify-stop" value="1" />
<?php

 
if(isset($_GET['templates'])){  

echo $header;

$block_count = $CORE->LAYOUT("get_block_count", array());
 
//print_r($block_count);
?>

<div class="container py-5">
<div class="row">
<div class="col-md-3">

    <div ppt-border1 class="p-3">
    <?php
	
   		$allblocks = $CORE->LAYOUT("get_block_types",array());          
        foreach($allblocks as $type){  
        
         
    ?>
    
<a href="#" onclick="previewBlock('<?php echo $type['id']; ?>');" class="text-dark">
<div ppt-flex-between class="mb-2">
<span class="text-600"><?php echo $type['name']; ?></span>
<span  class="btn-system btn-sm"><?php if(!isset($block_count[$type['id']])){ echo "0"; }else{ echo $block_count[$type['id']]['count']; } ?></span>
</div>
</a>
<?php } ?>
</div>


</div>

<div class="col-md-8">

<div id="blockoutput"></div>

</div>

</div>
</div>



<script>
function previewBlock(tid){
	 
       jQuery.ajax({
        type: "POST",
        url: ajax_site_url,		
   		data: {
               action: "load_block_preview_cat",
			   tid: tid,			   
           },
           success: function(response) { 
		   
		   		jQuery('#blockoutput').html(response);	 
   			
           },
           error: function(e) {
               console.log(e)
           }
       });
   
}
</script>

<?php


}elseif(isset($_GET['blockid'])){  

echo $header;



switch($_GET['blockid']){

	case "pricing": {
	
	$blockTitle = __("Pricing Table","premiumpress");
	
	} break;
	case "header": {
	
	$blockTitle = __("Header Designs","premiumpress");
	
	} break;
	case "cta": {	
	$blockTitle = __("Call to Action","premiumpress");	
	} break;

	case "footer": {	
	$blockTitle = __("Footer Designs","premiumpress");	
	} break;
	
	case "icon": {	
	$blockTitle = __("Icons &amp; Features","premiumpress");	
	} break;
	
	case "faq": {	
	$blockTitle = __("FAQ Blocks","premiumpress");	
	} break;
	
	case "contact": {	
	$blockTitle = __("Contact Forms","premiumpress");	
	} break;
		
	case "listings": {	
	$blockTitle = __("Listing Blocks","premiumpress");	
	} break;
	
	case "category": {	
	$blockTitle = __("Category Blocks","premiumpress");	
	} break;

	case "blog": {	
	$blockTitle = __("Blog Sections","premiumpress");	
	} break;
	
	case "hero": {	
	$blockTitle = __("Hero Designs","premiumpress");	
	} break;

	case "text": {	
	$blockTitle = __("Text Blocks","premiumpress");	
	} break;
	
	case "buttons": {	
	$blockTitle = __("Website Blocks","premiumpress");	
	} break;
	
	default: {
	
	$blockTitle = $_GET['blockid'];
	
	}

}

?>
</div>
<?php



ob_start();
do_action( 'headline20' );
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

"section_bg" => "bg-primary section-60 pt-4 pb-5 text-light ppt-gradient1",
 
"title" 	=> $blockTitle,
"title_font_weight" 	=> "text-600",
"title_font_size" 	=> "fs-xl",
"underline" 	=> "3",
"desc_underline_color" 	=> "#ffffff",

"subtitle" => "PremiumPress Block System",
//"desc" => "",

),array("widget"));

if(in_array($_GET['blockid'],array("buttons","typography","extra"))){

switch($_GET['blockid']){
	case "buttons": {
		?>
        <div class="container py-5"><style>.filterToggle { display:none; }</style>
        <?php _ppt_template( 'framework/docs/c_buttons' );  ?>
        </div>
        <?php 
	
	} break;
	
	case "typography": {
		?>
        <div class="container py-5"><style>.filterToggle { display:none; }</style>
        <?php _ppt_template( 'framework/docs/c_typography' );  ?>
        <?php _ppt_template( 'framework/docs/c_colors' );  ?>
        </div>
        <?php 
	
	} break;
	
	
	case "extra": {
		?>
        <div class="container py-5"><style>.filterToggle { display:none; }</style>
         <?php _ppt_template( 'framework/docs/c_stats' );  ?>
		<?php _ppt_template( 'framework/docs/c_ratings' );  ?>
        <?php _ppt_template( 'framework/docs/c_social' );  ?>
         <?php _ppt_template( 'framework/docs/c_online' );  ?>
          <?php _ppt_template( 'framework/docs/c_avatars' );  ?>
           <?php _ppt_template( 'framework/docs/c_icons' );  ?>
        </div>
        <?php 
	
	} break;	
}



}else{


// GET DATA
$g = $CORE->LAYOUT("load_all_by_cat",  $_GET['blockid']);
 
$order = array_column($g, 'order'); 
array_multisort( $order, SORT_ASC, $g);


foreach($g as $k => $g){  

 
	if(!isset($g['widget'])){ continue; }
	
	if(in_array($k,array("hero11")) ){ continue; }
	  
	if(isset($_GET['blockid']) && $_GET['blockid'] == "text" && is_array($g['cat']) ){
	continue;
	} 
	 
	?>
<div class="<?php if(in_array($_GET['blockid'],array("hero",""))){ ?>container-fluid<?php }else{ ?>container<?php } ?>">	 
<section class="position-relative <?php if(!in_array($_GET['blockid'],array("pricing","blog","category"))){ ?>shadow<?php } ?> sectionid-<?php echo $k; ?>" data-nav-title="<?php echo $g['name']; ?>" style="margin:100px 0px ;"> 
 <?php
		$html = "";
		ob_start();
		do_action( $k );
		$html = ob_get_contents();
		 
		echo do_action( $k."-css" );
		echo do_action( $k."-js" );
		 
?> 
</section></div>
	<?php
	
	}

}


}else{
 
//echo $header;


ob_start();
do_action( 'hero18' );
$output = ob_get_contents();
ob_end_clean();

echo str_replace("bg-white","ppt-fixed-header navbar-light",$header);
 
echo ppt_theme_block_output($output, array(

	"title" 	=> $title,
 	"subtitle" => $subtitle, 
	"desc" => $desc, 
	
	//"desc_font_size" => "fs-sm",
	
	"btn2_txt" => "Buy Now", 
	"btn2_link" => $link, 
	
	"title_underline" => 1,
	"title_underline_color" => "#fac106",
	
	"image1" 	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/hero-".$theme_key.".png",


),array("widget"));

 
ob_start();
do_action( 'text145' );
$output = ob_get_contents();
ob_end_clean();
 
echo str_replace("--","<br>",ppt_theme_block_output($output, array(

"section_bg" => "section-60 bg-white",
 
 "title" => "Easy To Customize",  
  
 "subtitle_font_size" => "fs-lg",
 "subtitle" => "20+ Pre-built Demo <br /> Websites Included",
 
 "desc" => "Save time and money with our pre-build layouts. Simply select the layout you like, drag in your images and update the content. You can adjust the designs, add in new content or switch to a different layout at anytime.",
 "desc_font_size" => "lh-40 text-500 opacity-5",

),array("widget")));

 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$categories 	= $CORE->LAYOUT("get_demo_categories", array()); 
$g 				= $CORE->LAYOUT("load_designs_by_theme", "lang");

$cats = array();

$cats 			= $categories[$theme_key];

  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
				
?>
 

<section id="demos" class="mt-2">
<div class="container pb-5">
    <div class="row">
      <?php  
            $i = 1; $tc = 1;
			
			$setLimit=2000;
			
            
            foreach($cats as $cid => $cat){ 
			 
				if($cat != ""){
				$topset = $cid;
				?>
                
                
                
                
<?php if($tc == 40000){ ?>


<div class="col-12 my-4">


<section class="section-40 bg-light rounded-lg my-5" id="elementor1">

<div class="container">
 
<div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="pl-4">
                        <img src="https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/elemantor-logo.png" alt="elementor" class="img-fluid" style="    max-width: 350px;">
                        <h2 class="text-700">Customize pages using the Free Elementor page builder</h2>
                        <ul class="fs-6 lh-40 mt-4">
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div> <div>Drag and Drop Editor</div> </li>
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div> <span>No Coding Required</span> </li>                               
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div> <span>250+ Custom Elements</span>  </li>
                            
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div> <span>Elementor Pro <strong>Not Required</strong></span>  </li>
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="text-right position-relative">
                    
                    <a href="https://www.youtube.com/watch?v=eccyi92nhKs" target="_blank">
                    
                      <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;">
              <div class="videoplaybutton bg-white" style="line-height: 110px;">
                <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span>
              </div>
            </div>
                    
                       <img src="https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/elementor.png" alt="elementor" class="img-fluid">
                       
                       
                       </a>
                       
                    </div>
                </div>
            </div> 
          
</div>
</section>

 
 

</div>


<?php } ?>
                
                
                
                
                
                
                
                
				<div class="col-12">				
				<div class="text-md text-600 mb-4"><span class="fs-md text-600"><?php echo $cat; ?></span></div>				
				</div>
                
                
                
                
                
                
				<?php
				
				$tc++;
							
				}
				
				
				if(isset($topset) && $topset != $cid){
				?>
				<div class="col-12"><hr /></div>
				<?php	
				} 
            
                $g = $CORE->LAYOUT("load_designs_by_theme", $cid);  
				 
				
				$iic = 1;
				if(is_array($cat)){ $setLimit=4; continue; }
				 
			      
                foreach($CORE->multisort($g, array('order')) as $key => $h){	
				
				if($iic > 3 && $cid != "childtheme_".strtolower(THEME_KEY)){ continue; }	 
                
                $name = "";
                $al = home_url()."/wp-admin/admin.php?page=design&defaultdesign=".$h['key'];
                if(defined('WLT_DEMOMODE')){ 
                    $al = home_url()."/?design=".$h['key'];
                }
				
				$gg = $CORE->LAYOUT("load_single_design", $h['key']); 
				$hh = new $h['key'];
				$gc = $hh->load(array());
				 
				$cp 	=  $gc['design']['color_primary'];
				$cs 	=  $gc['design']['color_secondary'];
				$csoft  = "";
				if(isset($gc['design']['color_primary_soft'])){
				$csoft 	=  $gc['design']['color_primary_soft'];
				}
				
				
	
				 
                
?>

 
      <div class="col-6 col-md-4 mb-4 mobile-mb-4 theme-wrap" >
   
          <a href="<?php echo $al; ?>&desktop_view=1"  target="_blank">
          
     <div class="overflow-hidden position-relative mb-5 demo-preview  shadow" ppt-border1>
     
      <figure class="text-center" style="line-height: 250px;">
      
      <button data-ppt-btn class="btn-system btn-lg overflow-hidden">View Demo</button>
      
       <div data-bg="<?php echo $h['image']; ?>" class="bg-image" style="background-position: top;"></div>
       
       
      </figure>
   
        </div>
        
        </a>
   
        
  
      </div>
      <?php  $i++; $iic++; }  }     ?>
      
   
    </div>
    
 
 
 
</div>
</section>

 

  

<div id="sections"></div>
<?php


ob_start();
do_action( 'icon180' );
$output = ob_get_contents();
ob_end_clean();




if($theme_key == "sp"){
$sellsp = "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/sellspace-sp.jpg";

$sellspa = "Built-in Checkout System";
$sellspb = "Checkout, Tax &amp; shipping options are all built-in. No need for third party-plugins.";


}else{
$sellsp = "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/sellspace.jpg";
$sellspa = "Memberships, Pricing Tables, Advertising &amp; More!";
$sellspb = "Everything you need to monetise and make more money is built-in.";

}
 
 
echo str_replace("--","<br>",ppt_theme_block_output($output, array(
 
 "title" => "PremiumPress is an all-in-one solution for WordPress. {No paid plugins required.}",
 
 "title_underline" => 15,
 
 "f1image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/elementor-".$theme_key.".jpg", 
 "f2image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/blocks.jpg", 
 
 "f3image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/languages.jpg",
 
 "f4image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/payment.jpg",
 
 "f5image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/email.jpg",
 
 "f6image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/search-".$theme_key.".jpg",
 "f7image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/mobile-".$theme_key.".jpg",
 
 "f8image" => $sellsp,
 "f9image" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/features1/members.jpg",
 
 
 
 "f1a" => "Customize pages using <br /> Elementor page builder.", "f1b" => "Design your pages using the <strong>free</strong> version of Elementor.",
 "f2a" => "Build pages faster! 250+ Ready-made blocks included.", "f2b" => "Creating amazing website layouts in minutes with over 250 different design blocks to choose from.",
 
 "f3a" => "Multiple Languages", "f3b" => "All pages and website text can be translated. We've even included 10+ language packs to get you started.",
 "f4a" => "30+ Payment Gateways", "f4b" => "We have over 30 free payment gateways you can download and use with your PremiumPress website.",
 
 "f5a" => "EMAIL &amp; SMS Verification", "f5b" => "Setup email and SMS verification options to stop users accessing account features until verified.",
 
 "f6a" => "Full AJAX search, pagination, filters and user searches.", "f6b" => "This theme includes advanced search and filtering tools built-in. You can turn on/off additional options in the admin area and setup your own search fields.",
 "f7a" => "Mobile Friendly", "f7b" => "Mobile friendly design means you're website will work great on smart phones and tablets.",
 

 "f8a" => $sellspa,  "f8b" => $sellspb,
 
 "f9a" => "Dedicated Members Area &amp; Personlzied Login &amp; Register Pages", "f9b" => "Your website members get their own personlized members area where they can login anytime to manage their account.",
 
 
 

),array("widget")));

?>
 

<section class="demo-wrap pt-0" id="adminarea">
<div class="container">
 
<div class="row align-items-center">

<div class="col-lg-7">

	<img class="img-fluid" src="https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/adminarea.png" alt="admin area">
                   
</div>
<div class="col-lg-5">
               
                    
                        <div class="fs-lg text-700 mb-4">Website Management</div>
                        
                        <div>A complete set of admin tools to manage your website.</div>
                        
                        
                        <ul class="fs-6 lh-40 mt-4">
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><?php echo $CORE_UI->icons_svg['check']; ?></div><span>300+ Admin Area Options</span> </li>
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><?php echo $CORE_UI->icons_svg['check']; ?></div> <span>Regular Updates</span> </li> 
                            <li class="d-flex"> <div ppt-icon-size="20" class="mr-2"><?php echo $CORE_UI->icons_svg['check']; ?></div> <span>Beginner Friendly</span>  </li>
                        </ul>
                        
                        
                        <a href="<?php echo home_url()."/wp-login.php?admindemo=1"; ?>" data-ppt-btn class="btn-primary btn-lg text-700 mt-4" target="_blank">Visit Admin Area</a> 
                        
                        <a href="<?php echo $link; ?>" class="btn-orange rounded text-600 btn-lg mt-4" data-ppt-btn="" data-ppt-btn-txt="">Buy Now</a> 
                        
                    </div>
              
 </div> 
          
</div>
</section>

 
<?php


}
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
<script>window.addEventListener("load",function(){function n(n,e){e=document.createElement("script");e.src="https://image.providesupport.com/"+n,document.body.appendChild(e)}n("js/0hrtty9k9a7pa1tkfndzj3oe32/safe-monitor-sync.js?ps_h=vaZF&ps_t="+Date.now()),n("sjs/static.js")})</script>

<section class="section-40 bg-black text-white text-center">
    <p class="mb-3">Made with love <i class="fa fa-heart text-danger mx-2">&nbsp;</i> by <span class="text-600">PremiumPress</span> </p>
</section>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

} ?>