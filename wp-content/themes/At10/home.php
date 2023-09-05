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
 
global $CORE;
	
	$GLOBALS['flag-home'] = 1;	
  
	$pageLinkingID = _ppt_pagelinking("homepage");	
	
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	if(isset($_GET['ppt_live_preview']) ){ // && _ppt_livepreview()
	
	$GLOBALS['flag-testing'] = 1;
	get_header();  
	
	
 	if(isset($_GET['tid']) && !isset($_GET['sid']) ){
		
		// GET DATA
		$g = $CORE->LAYOUT("load_all_by_cat",  $_GET['tid']);
			
		if(in_array($_GET['tid'], array('text','icon','listings','header','cta','contact','video','faq'))){
			$order = array_column($g, 'order'); 
   			array_multisort( $order, SORT_ASC, $g);
		}	   
	   
	   foreach($g as $k => $g){ 
	   
			echo do_action( $k."-css" );
			echo do_action( $k );
			if($g['cat'] == "header" && isset($_GET['ppt_live_preview']) ){
						echo "<div style='height:200px; background:grey'></div>";
			}
			echo do_action( $k."-js" );						
		    echo "<div class='w-100 bg-black py-3 text-white text-center my-3'>".$k."</div>";
						
		} 
		
	}elseif(isset($_GET['sid'])){
	
		echo do_action( $_GET['sid']."-css" );
		echo do_action( $_GET['sid'] );
		echo do_action( $_GET['sid']."-js" );
		
	} 
	if(defined('WLT_DEMOMODE')){
	_ppt_template('framework/docs/_previewbar' ); 
	}
	
	get_footer();
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	}else if( substr($pageLinkingID ,0,4) == "page" && !isset($_GET['design']) ){ 
	
		$pageID = substr($pageLinkingID, 5,10000);
		
		// CHECK ELMENTOR CANVUS		
		if(get_post_meta($pageID, "_wp_page_template", true) == "elementor_canvas"){		
			define('NOHEADERFOOTER', 1);
		}		
		
		$this_post = get_post($pageID); 
			 	
		get_header(); 	
		
		echo do_shortcode($this_post->post_content);	
			
		get_footer();
	  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 	}else if( substr($pageLinkingID ,0,9) == "elementor" && !isset($_GET['design']) ){ 
		 
		 
		// CHECK ELMENTOR CANVUS		
		if(get_post_meta(substr($pageLinkingID,10,100), "_wp_page_template", true) == "elementor_canvas"){		
			define('NOHEADERFOOTER', 1);
		}
			 	
		get_header(); 	
		
		echo do_shortcode( "[premiumpress_elementor_template id='".substr($pageLinkingID,10,100)."']");	
			
		get_footer();
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	}else{
 
 
	
 		if(_ppt(array('design','slot1_style')) == "elementor" && defined('ELEMENTOR_VERSION') && isset($_SESSION['design_preview']) && strlen($_SESSION['design_preview']) > 1){ // CHILD THEME PREVIEWS
		 
			_ppt_template( 'home', 'elementor' ); 		
		
		}else{
 			
			get_header(); 
		 	  
			if( ( ( _ppt(array('design','slot1_style')) == "" && _ppt(array('design','slot2_style')) == "" ) || _ppt(array('design','slot1_style')) == "elementor") &&  strlen(_ppt(array('pageassign','homepage'))) < 3){
			 
			_ppt_template( 'home', 'demo' ); 
			 
		 	}else{ 
			
			$i=1;
			while($i < 10){
				$design = _ppt(array('design','slot'.$i.'_style'));
				if(strlen($design) > 1){	
				$CORE->LAYOUT("load_single_block",$design);	
				}
				$i++;
			}
		 
			}
			
			get_footer();	
			 
		} 

	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>