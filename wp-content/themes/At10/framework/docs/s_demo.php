<?php

global $CORE, $CORE_UI, $userdata;

$themes = array("at","ct","cm","dl","dt","da","es","ll","ph","pj","mj","rt","sp","so","vt","cp"); //,
foreach($themes as $t){



switch($t){ 

	case "cp": {		
		$title = "Build Your Own Coupon Website";		
		$link = "https://www.premiumpress.com/wordpress-coupon-theme/";		
	} break;

	case "at": {		
		$title = "Build Your Own Auction Website";		
		$link = "https://www.premiumpress.com/wordpress-auction-theme/";		
	} break;
	
	
	case "ct": {		
		$title = "Build Your Own Classifieds Site";		
		$link = "https://www.premiumpress.com/wordpress-classifieds-theme/";		
	} break;
	
	case "dl": {		
		$title = "Build Your Own Autos Website";		
		$link = "https://www.premiumpress.com/wordpress-car-dealer-theme/";		
	} break;
	
	case "sp": {		
		$title = "Build Your Own Online Store";		
		$link = "https://www.premiumpress.com/wordpress-shop-theme/";		
	} break;
	
	case "ll": {		
		$title = "Build Your Own LMS Website";		
		$link = "https://www.premiumpress.com/wordpress-lms-theme/";		
	} break;

	
	case "ct": {		
		$title = "Build Your Own Classifieds Website";		
		$link = "https://www.premiumpress.com/wordpress-classifieds-theme/";		
	} break;
	
	case "da": {		
		$title = "Build Your Own Dating Website";		
		$link = "https://www.premiumpress.com/wordpress-dating-theme/";		
	} break;
	
	case "es": {		
		$title = "Build Your Own Escorts Website";		
		$link = "https://www.premiumpress.com/wordpress-escort-theme/";		
	} break;	
	
	case "mj": {		
		$title = "Build A Micro Jobs Website";		
		$link = "https://www.premiumpress.com/wordpress-micro-jobs-theme/";		
	} break;
	
	case "dt": {		
		$title = "Build Your Own Online Directory";		
		$link = "https://www.premiumpress.com/wordpressdirectory-theme/";		
	} break; 

	case "jb": {		
		$title = "Build Your Jobs Website";		
		$link = "https://www.premiumpress.com/wordpress-job-board-theme/";		
	} break;
	
		
	case "cm": {		
		$title = "Price Compare Website Builder";		
		$link = "https://www.premiumpress.com/wordpress-price-comparison-theme/";		
	} break;

	

	case "pj": {		
		$title = "Build Your Own Task Desk Site";		
		$link = "https://www.premiumpress.com/wordpress-freelancer-theme/";		
	} break;
 
 	
	case "rt": {		
		$title = "Build Your Own Property Site";		
		$link = "https://www.premiumpress.com/wordpress-real-estate-theme/";		
	} break;	
	
 
	case "so": {		
		$title = "Build A Software Marketplace";		
		$link = "https://www.premiumpress.com/wordpress-digital-download-theme/";		
	} break;
	
	
	case "ph": {		
		$title = "Build a Stock Photo Website";		
		$link = "https://www.premiumpress.com/wordpress-stock-photography-theme/";		
	} break;
	
		case "vt": {		
		$title = "Build Your Video Sharing Website";		
		$link = "https://www.premiumpress.com/wordpress-video-theme/";		
	} break;
	
	

}

ob_start();
do_action( 'text133' );
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

"section_bg" => "bg-light section-0 pt-4 pb-5",

"btn_show" 		=> 1, 
"btn2_show" 		=> 1, 

"image" 	=> "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/demo-".$t.".jpg",
"title" 	=> $title,

"subtitle" => "Quick to setup. Easy to Customize. Lot's of features!",

),array("widget"));

echo "<hr>";

}

?>