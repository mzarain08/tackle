<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN, $userdata;


// PAGE LINKS ARRAY
$GLOBALS['core_page_templates'] = $CORE->LAYOUT("get_innerpage_blocks", array());

// GET ELEMENT PAGES
$elementorArray = array();
$args = array(
                   'post_type' 			=> 'elementor_library',
                   'posts_per_page' 	=> 150,
                    'orderby' 	=> 'date',
					'order' => 'desc'
               );
$wp_query = new WP_Query($args);
$tt = $wpdb->get_results($wp_query->request, OBJECT);
if(!empty($tt)){ foreach($tt as $p){ 
 $elementorArray["elementor-".$p->ID] = get_the_title($p->ID); 
} } 


$GLOBALS['elementor_page_templates'] = $elementorArray;
 

function include_thickbox_scripts()    
{
    // include the javascript    
    wp_enqueue_script('thickbox', null, array('jquery'));

    // include the thickbox styles    
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');

}

//add_action('wp_enqueue_scripts', 'include_thickbox_scripts');
//wp_enqueue_script( 'jquery-ui-tabs' );


if(isset($_GET['nid']) && is_numeric($_GET['nid']) ){

$GLOBALS['error_message'] = "<h4>Template Created Successfully</h4><div class='mt-3' style='font-weight:normal !important'> Click here to <a href='".home_url()."/wp-admin/post.php?post=".$_GET['nid']."&action=elementor"."' target='_blank'> <u>edit the template </u></a> "; 

}

if( current_user_can('administrator') ){




if(isset($_GET['resetdemo'])){
	
	$new_core_array = get_option("core_admin_values");
	
	foreach( array("slot1","slot2","slot3","slot4","slot5","slot6","slot7","slot8","slot9","header","footer") as $s){
	$new_core_array['design'][$s."_style"] = "";
	}
 	  
	update_option('core_admin_values', $new_core_array);
	
	// CLEAN UP ELEMENTOR PAGES
	$existing_values = get_option("core_admin_values");					
	$_POST['admin_values']['pageassign']["homepage"] = "";
	$_POST['admin_values']['pageassign']["header"] = "";
	$_POST['admin_values']['pageassign']["footer"] = "";
	$new_result =  ppt_clean_databasecode($CORE_ADMIN->clean_array_merge((array)$existing_values, (array)$_POST['admin_values']));	
	update_option( "core_admin_values", $new_result);
	
	// LEAVE MESSAGE
	$GLOBALS['ppt_error'] = array(
				"type" 		=> "success",
				"title" 	=> "Settings Updated",
				"message"	=> "The design has been reset.",
	);

}

	if(isset($_POST) && isset($_POST['loaddesign']) ){
	
	
	
		$g = $CORE->LAYOUT("load_single_design", $_POST['loaddesign']);	 
		 
		if(is_array($g)){
			
			// FIX PHP 7.1
			$existingdta = get_option("core_admin_values");
			if(!is_array($existingdta )){
			$existingdta  = array();
			}
			 	
			$new_core_array = apply_filters( $_POST['loaddesign'], $existingdta );	 
			 
			// REMOVE SAMPLE DATA	
			if(isset($new_core_array['sampledata'])){ unset($new_core_array['sampledata']); }	
		 				 
			update_option('core_admin_values', $new_core_array);	
		 	 
			// REMOVE PREVIEW SESSION
			if(isset($_SESSION['design_preview'])){
				unset($_SESSION['design_preview']);
			}	
			
			/*?><textarea style="width:100%; height:100%;"><?php $_POST['loaddesign'].print_r($new_core_array); ?></textarea><?php die(); */
			 
	 
			// LEAVE MESSAGE
			$GLOBALS['ppt_error'] = array(
				"type" 		=> "success",
				"title" 	=> __("Settings Updated","premiumpress"),
				"message"	=> __("The design has been loaded","premiumpress"),
			);
			
			if(defined('ELEMENTOR_VERSION')){ 
			
					// RESET HOMEPAGE ELEMENTOR PAGE
					$existing_values = get_option("core_admin_values");					
					$_POST['admin_values']['pageassign']["homepage"] = "";
					$new_result =  ppt_clean_databasecode($CORE_ADMIN->clean_array_merge((array)$existing_values, (array)$_POST['admin_values']));	
					 
					update_option( "core_admin_values", $new_result);
					
					 
					// CHECK FOR ELEMENTOR TEMPLATES AS PART OF THE DESIGN
					if(isset($g['elementor']) && is_array($g['elementor'])){
					
						foreach($g['elementor'] as $k => $file_path){
							
							// PROCESS IT 
							$elementor_importer = new PremiumPress_Elementor_Importer();
							$id = $elementor_importer->import_elementor_file( $file_path, $k." - ".date('d-m-Y') );
							
							if( !is_wp_error( $id ) ) {	
						
								$existing_values = get_option("core_admin_values");					 	
								$existing_values['pageassign'][$k] = "elementor-".$id;					 
								update_option( "core_admin_values", $existing_values);					 			 		
						
							}else{				
								die($id->get_error_message());			
							}					
							
						
						}			
					} 
			
			} // end if elementor
		
			
			$_GET['redirecthomepage'] =1;
		
		}else{
			
			// LEAVE MESSAGE
			$GLOBALS['ppt_error'] = array(
				"type" 		=> "error",
				"title" 	=> "Design Not Found",
				"message"	=> "The design requested could not be located.",
			); 	 
		
		}
	
	}// end load design
	

 
if(isset($_GET['loadpage'])){


$columns = array(); $imgidrandom = 1;

// REMOVE PREVIEW SESSION
if(isset($_SESSION['design_preview'])){
	unset($_SESSION['design_preview']);
}




if($_GET['loadpage'] == "customcard"){
 
	
	$elementor_file = get_template_directory()."/framework/design/cards/elementor-".$_GET['cardid'].".json"; //
	 
	if(file_exists($elementor_file)){  
		 
		// PROCESS IT 
		$elementor_importer = new PremiumPress_Elementor_Importer();
		$id = $elementor_importer->import_elementor_file( $elementor_file, "Search Card (".$_GET['cardid'].") - ".date('d-m-Y') );
		
		
			
				if( !is_wp_error( $id ) ) {	
				
				
				// RESET HOMEPAGE ELEMENTOR PAGE
					$existing_values = get_option("core_admin_values");					
					$_POST['admin_values']['customcard'][$_GET['cardid']] = "elementor-".$id;
					$new_result =  ppt_clean_databasecode($CORE_ADMIN->clean_array_merge((array)$existing_values, (array)$_POST['admin_values']));	
					update_option( "core_admin_values", $new_result);
					
					die(
					'<div> <h2 style="margin-top:30px;">Loading please wait...</h2></div>'.
					
					'<script>setTimeout(function() { window.location.href = "'.home_url().'/wp-admin/post.php?post='.$id.'&action=elementor"; }, 3000);</script>'
					); 
				 	
					 			 		
				
				}else{				
					die($id->get_error_message()."<br><br>".$elementor_file);			
				}	
		 
	
	}else{
	
		die("missing search card");
	}
	

}elseif($_GET['loadpage'] == "new" && $_GET['inner'] == "account"){
 
	
	$elementor_file = get_template_directory()."/framework/elementor/accountpage.json"; //
	 
	  
	if(file_exists($elementor_file)){  
		 
		// PROCESS IT 
		$elementor_importer = new PremiumPress_Elementor_Importer();
		$id = $elementor_importer->import_elementor_file( $elementor_file, "Listing Page - ".date('d-m-Y') );
		
		
			
				if( !is_wp_error( $id ) ) {	
				
				
				// RESET HOMEPAGE ELEMENTOR PAGE
					$existing_values = get_option("core_admin_values");					
					$_POST['admin_values']['pageassign']['account'] = "elementor-".$id;
					$new_result =  ppt_clean_databasecode($CORE_ADMIN->clean_array_merge((array)$existing_values, (array)$_POST['admin_values']));	
					update_option( "core_admin_values", $new_result);
					
					die(
					'<div> <h2 style="margin-top:30px;">Loading please wait...</h2></div>'.
					
					'<script>setTimeout(function() { window.location.href = "'.home_url().'/wp-admin/post.php?post='.$id.'&action=elementor"; }, 3000);</script>'
					); 
				 	
					 			 		
				
				}else{				
					die($id->get_error_message()."<br><br>".$elementor_file);			
				}	
		 
	
	}else{
	
		die("missing search card");
	}
	
}elseif($_GET['loadpage'] == "new" && in_array($_GET['inner'],array("listingpage","xxxx") ) ){
  
  	
	$elementor_file = get_template_directory()."/".THEME_FOLDER."/listingpage.json";   	 
	if(file_exists($elementor_file)){
	
	}else{
	
	$elementor_file =get_template_directory()."/framework/elementor/listingpage.json";   	
	}
	
	
	
	
	if(file_exists($elementor_file)){  
		 
		// PROCESS IT 
		$elementor_importer = new PremiumPress_Elementor_Importer();
		$id = $elementor_importer->import_elementor_file( $elementor_file, "Listing Page - ".date('d-m-Y') );
		
		
			
				if( !is_wp_error( $id ) ) {	
				
				
				// RESET HOMEPAGE ELEMENTOR PAGE
					$existing_values = get_option("core_admin_values");					
					$_POST['admin_values']['pageassign']['listingpage'] = "elementor-".$id; 
					
					$new_result = ppt_clean_databasecode($CORE_ADMIN->clean_array_merge((array)$existing_values, (array)$_POST['admin_values']));
					
					/*
					?>
                    <textarea style="width:100%"><?php print_r($existing_values); ?></textarea>
                    <hr />
                    <textarea style="width:100%"><?php print_r($new_result); ?></textarea>
                     
                    <?php
					die(); 
					*/
					
					
					update_option( "core_admin_values", $new_result);
					
					die(
					'<div> <h2 style="margin-top:30px;">Loading please wait...</h2></div>'.
					
					'<script>setTimeout(function() { window.location.href = "'.home_url().'/wp-admin/post.php?post='.$id.'&action=elementor"; }, 3000);</script>'
					); 
				 	
					 			 		
				
				}else{				
					die($id->get_error_message()."<br><br>".$elementor_file);			
				}	
 	
	}else{
	
		die("missing search card");
	}

}elseif($_GET['loadpage'] == "home"){

 	//removed "header","footer"
	
	
	foreach( $CORE->LAYOUT("get_slots",array(1,2,3,4,5,6,7,8,9)) as $s){
	
	
		if(strlen(_ppt(array('design',$s['id']))) > 1){ 
		  
		
			$cat = $CORE->LAYOUT("get_block_category", _ppt(array('design',$s['id'])) );
			
			$blockKey = _ppt(array('design',$s['id']));
			
			if($blockKey == ""){ continue; }
			
			
			$block_settings = array();			 
			$block_settings = $CORE->LAYOUT("get_block_settings_defaults", array($blockKey, $cat, array() ) );
			
			if(is_array($cat)){
			$block_settings["type"] =  $cat[0];
			}else{
			$block_settings["type"] =  $cat;
			}
			
			if(is_array($cat)){			
			$block_settings[$cat[0]."_style"] = $blockKey;
			}else{
			$block_settings[$cat."_style"] = $blockKey;
			}  
			
			$block_settings["design"] 		=  $blockKey;
			$widgetName = $CORE->LAYOUT("get_block_widget", $blockKey  );	
			
			
			
			if($cat =="header"){
				$block_settings["color_primary"] = _ppt(array('design','color_primary'));
				$block_settings["color_secondary"] = _ppt(array('design','color_secondary'));
			}
			
			
			// CLEANUP IMAGES			
			foreach($block_settings as $k => $a){
			
				if( in_array($k, array(
				"hero_image", 
				"image",
				"image1",
				"image2",
				"image3",
				"image4",
				"image5",
				"image6",
				"image7",
				"image8",
				
				"text_image1",
				"text_image2",
				"text_image3",
				"text_image4",
				"text_image5",
				"text_image6",
				"text_image7",
				"text_image8",
				"text_image9",
				
				"image_block1",
				"image_block2",
				"image_block3",
				"image_block4",
				"image_block5",
				"image_block6",
				"image_block7",
				"image_block8",
				"image_block9",
				
				"icon1_image",
				"icon2_image",
				"icon3_image",
				"icon4_image",
				"icon5_image",
				"icon6_image",
				"icon7_image",
				"icon8_image", 
				
				
				
				"image_subscribe",
				"image_icon",
				"image_cta",
				"image_faq",
				
					"author_image1",
				"author_image2",
				"author_image3",
				"author_image4",
				"author_image5",
				"author_image6",
				"author_image7",
				
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'url' => $a,
						);
					$imgidrandom++;
				}	
				
				if( in_array($k, array(
				
				"btn_icon", 
				"btn2_icon",
								
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'value' => $a,
						);
					$imgidrandom++;
				}		
			
			}
			
			//die(print_r($block_settings));
		 
			$columns[] = array(  
					"id" 		=> "49157210",
					"isInner" 	=> false,
					"elType" 	=> "section",
					"settings" 	=> array(		
						"layout" 		=> "full_width",
						"css_classes" 	=> "",
					), 
					
					"elements" => array(
						
							0 => array(	
									"id" 		=> "49157211",
									"isInner" 	=> "1",
									"elType" 	=> "column",			 			
									"settings" => array(
										
										"_column_size" 	=> "100",
										"layout" 		=> "full_width",	
																
									),						
									
									"elements" => array(
									
										0 => array(	
												"id" 			=> "49157213",
												"isInner" 		=> false,
												"elType" 		=> "widget",							
												"widgetType" 	=> $widgetName,
																
												"settings" => $block_settings,
												
												"elements" => array( ),
										), 
										
									), // end widget 
									
									
							),// end elements (column )
				
						),
					 
				);
		
		}
		
	}
	
 
}elseif(isset($_GET['inner']) ){

 
if( $_GET['inner'] == "ppt_builder" ){

 	$cleanme = substr($_GET['markspagebuilder'],0 ,-3);
	
	$h = array("blocks" => explode("---", $cleanme) );
 
}elseif($_GET['inner'] == "header"){

	$h = array("blocks" => array(_ppt(array('design','header_style'))) );

}elseif($_GET['inner'] == "footer"){

	$h = array("blocks" => array(_ppt(array('design','footer_style'))) );

}elseif(strlen($_GET['inner']) > 2){

	$h = $CORE->LAYOUT("get_innerpage_blocks", "page_".$_GET['inner'] );
	
}else{

	$h = $CORE->LAYOUT("get_innerpage_blocks", $_GET['loadpage'] );
}



 
if(isset($h['blocks'])){

	// GET INNER PAGE CONTENT DATA 
	// THIS IS FOR PAGES
	if( $_GET['inner'] == "ppt_builder" ){
	$allinnerdata = array();
	}else{
	$allinnerdata = $CORE->LAYOUT("default_innerpages", array() );
	}
	
	 
	
	foreach($h['blocks'] as $s){
	 	
		// GET KEY	
		$cat = $CORE->LAYOUT("get_block_category", $s );	 
		$blockKey = $s;
 		
		// GET DEFAULT PAGE CONTENT
		$block_settings 				= array();	 		
		if( $_GET['inner'] == "ppt_builder" ){
		
			$block_settings =  $CORE->LAYOUT("get_block_defaults", $blockKey);
		
		}elseif($_GET['loadpage'] == "new" && isset($allinnerdata[$_GET['inner']]) && isset($allinnerdata[$_GET['inner']][$blockKey]) ){
			$block_settings 				= $allinnerdata[$_GET['inner']][$blockKey];
		}	
		
		if(is_array($cat)){
		$cat = $cat[0];
		}
	 
		$block_settings["type"] 		=  $cat;
		$block_settings[$cat."_style"] 	= $blockKey; 
		$block_settings["design"] 		=  $blockKey;
		
		if($cat =="header"){
				$block_settings["color_primary"] = _ppt(array('design','color_primary'));
				$block_settings["color_secondary"] = _ppt(array('design','color_secondary'));
		}
		 
		$widgetName = $CORE->LAYOUT("get_block_widget", $blockKey  );
			
			// CLEANUP IMAGES			
			foreach($block_settings as $k => $a){
			
				if( in_array($k, array(
				
				"hero_image", 
				
								"image",
				"image1",
				"image2",
				"image3",
				"image4",
				"image5",
				"image6",
				"image7",
				"image8",
				
				"text_image1",
				"text_image2",
				"text_image3",
				"text_image4",
				"text_image5",
				"text_image6",
				"text_image7",
				"text_image8",
				"text_image9",
				
				"image_block1",
				"image_block2",
				"image_block3",
				"image_block4",
				"image_block5",
				"image_block6",
				"image_block7",
				"image_block8",
				"image_block9",
				
				"icon1_image",
				"icon2_image",
				"icon3_image",
				"icon4_image",
				"icon5_image",
				"icon6_image",
				"icon7_image",
				"icon8_image", 

				
				"image_subscribe",
				"image_icon",
				"image_cta",
				"image_faq",
				
				"author_image1",
				"author_image2",
				"author_image3",
				"author_image4",
				"author_image5",
				"author_image6",
				"author_image7",
				
				
				
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'url' => $a,
						);
					$imgidrandom++;
				}	
				
				
				if( in_array($k, array(
				
				"btn_icon", 
				"btn2_icon",
								
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'value' => $a,
						);
					$imgidrandom++;
				}		
			
			}
		 
			
			$columns[] = array( 
			 
				
					"id" 		=> "49157210",
					"isInner" 	=> false,
					"elType" 	=> "section",
					"settings" 	=> array(		
						"layout" 		=> "full_width",
						"css_classes" 	=> "",
					), 
					
					"elements" => array(
						
							0 => array(	
									"id" 		=> "49157211",
									"isInner" 	=> "1",
									"elType" 	=> "column",			 			
									"settings" => array(
										
										"_column_size" 	=> "100",
										"layout" 		=> "full_width",	
																
									),						
									
									"elements" => array(
									
										0 => array(	
												"id" 			=> "49157213",
												"isInner" 		=> false,
												"elType" 		=> "widget",							
												"widgetType" 	=> $widgetName,
																
												"settings" => $block_settings,
												
												"elements" => array( ),
										), 
										
									), // end widget
									
									
									
									
							),// end elements (column )
				
						),
					 
				);	 
		
	
	}

}

	

}elseif(strlen($_GET['loadpage']) > 1 ){
 
 
	$g = $CORE->LAYOUT("load_single_design", $_GET['loadpage']);	
	  
 ;
	// CHECK FOR ELEMENTOR TEMPLATE
	if(isset($g['elementor'])){
	
				$elementor_file = $g['elementor']['homepage'];	
	 
				if(!file_exists($elementor_file)){ unset($_SESSION['design_preview']); die("preview file not found"); }
				 
				// PROCESS IT 
				$elementor_importer = new PremiumPress_Elementor_Importer();
				$id = $elementor_importer->import_elementor_file( $elementor_file, $g['key']." - ".date('d-m-Y') );
				
				
				if( !is_wp_error( $id ) ) {	
				
				
					die(
					'<div> <h2 style="margin-top:30px;">Loading please wait...</h2></div>'.
					
					'<script>setTimeout(function() { window.location.href = "'.home_url().'/wp-admin/post.php?post='.$id.'&action=elementor"; }, 3000);</script>'
					); 
											
				
				}else{				
					die($id->get_error_message());			
				}	
				
			
	
	}else{
	
	
		// FIX PHP 7.1
			$existingdta = get_option("core_admin_values");
			if(!is_array($existingdta )){
			$existingdta  = array();
			}
	
 	$new_core_array = apply_filters( $_GET['loadpage'], $existingdta ); 
	
	
	if(isset($new_core_array['sampledata'])){ unset($new_core_array['sampledata']); }	
	
 	foreach( $CORE->LAYOUT("get_slots", array("header", 1,2,3,4,5,6,7,8,9,"footer") ) as $s){
	
	 
	
	  	if(!isset($new_core_array['design'][$s['id']])){
		continue;
		}  
	
		$blid = $new_core_array['design'][$s['id']];
		
		
		if(strlen($blid) > 1){
		   
			$cat = $CORE->LAYOUT("get_block_category", $blid );	
			
			if($cat == ""){ continue; }		
			 
			$blockKey = $blid;
			
			if($blockKey == ""){ continue; }
			
			$block_settings 				= array();			 
		 
		
			if(($cat == "header" || $cat == "footer")  && isset($new_core_array[$cat]) ){  
			
				
				// ONLY LOAD INT HE FOOTER AS THE HEADER IS PART OF THE DESIGN
				if(!isset($_GET['full'])){
					if( isset($g['homepage_header']) && $cat == "footer" ){
					
					}else{
					
					continue;
					
					}
				} 
			 
			 
			
			
			$block_settings =  $CORE->LAYOUT("get_block_defaults", $blockKey);
			 if(!is_array($block_settings)){ $block_settings = array(); }
			 
 			
			}elseif(isset($new_core_array['home'][$blockKey])){
			$block_settings 				= $new_core_array['home'][$blockKey]; 			 
			}else{
			$block_settings = "";
			}
			
			 if(!is_array($block_settings)){ $block_settings = array(); }
			 
			//die(print_r($block_settings).$blockKey);
			
			//if(!is_array($block_settings)){ continue; }
			
			if(is_array($cat)){
			$cat = $cat[0];
			} 
			
			$block_settings["type"] 		= $cat;
			$block_settings[$cat."_style"] 	= $blockKey;
			$block_settings["design"] 		=  $blockKey;
			 
			// die($cat." -- ".$blockKey);
			$widgetName = $CORE->LAYOUT("get_block_widget", $blockKey  );	
			 
			
			if($cat =="header" && isset($new_core_array['design']['color_primary']) ){
				$block_settings["color_primary"] 	= $new_core_array['design']['color_primary'];
				$block_settings["color_secondary"] 	= $new_core_array['design']['color_secondary'];
			}
			
			 
			// CLEANUP IMAGES
						
			foreach($block_settings as $k => $a){
			
				if( in_array($k, array(
				"hero_image", 
								"image",
				"image1",
				"image2",
				"image3",
				"image4",
				"image5",
				"image6",
				"image7",
				"image8",
				"text_image1",
				"text_image2",
				"text_image3",
				"text_image4",
				"text_image5",
				"text_image6",
				"text_image7",
				"text_image8",
				"text_image9",

				"icon1_image",
				"icon2_image",
				"icon3_image",
				"icon4_image",
				"icon5_image",
				"icon6_image",
				"icon7_image",
				"icon8_image", 

				
				"image_block1",
				"image_block2",
				"image_block3",
				"image_block4",
				"image_block5",
				"image_block6",
				"image_block7",
				"image_block8",
				"image_block9",

				"image_subscribe",
				"image_icon",
				"image_cta",
				"image_faq",
				
					"author_image1",
				"author_image2",
				"author_image3",
				"author_image4",
				"author_image5",
				"author_image6",
				"author_image7",
				
				
				
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'url' => $a,
						);
					$imgidrandom++;
				}	
				
				
				
				if( in_array($k, array(
				
				"btn_icon", 
				"btn2_icon",
								
				)) ){
				
				 	unset($block_settings[$k]);
					$block_settings[$k] = array(
						"id" => $imgidrandom,
						'value' => $a,
						);
					$imgidrandom++;
				}
						
			
			}
			
			
			$canContinue = 1;
			$block_data =  $CORE->LAYOUT("get_block_data", $blockKey);
		 	if(isset($block_data['elementor_data'])){
				
				
			
			$elementor_file = get_template_directory()."/framework/elementor/blockdata/".$block_data['elementor_data'];   
			if(file_exists($elementor_file)){ 
					
					$data = json_decode( file_get_contents( $elementor_file ), true );
					if ( empty( $data ) ) {
			
							return new \WP_Error( 'file_error', 'Invalid File. ('.$elementor_file.') Data cannot be read.' );
						}
						
						$columns[] = $data['content'][0];
						$canContinue = 0;
						
						 
				} 
			
			}
			 
			
		 	if($canContinue){
			
			$columns[] = array( 
			 
				
					"id" 		=> "49157210",
					"isInner" 	=> false,
					"elType" 	=> "section",
					"settings" 	=> array(		
						"layout" 		=> "full_width",
						"css_classes" 	=> "",
					), 
					
					"elements" => array(
						
							0 => array(	
									"id" 		=> "49157211",
									"isInner" 	=> "1",
									"elType" 	=> "column",			 			
									"settings" => array(
										
										"_column_size" 	=> "100",
										"layout" 		=> "full_width",	
																
									),						
									
									"elements" => array(
									
										0 => array(	
												"id" 			=> "49157213",
												"isInner" 		=> false,
												"elType" 		=> "widget",							
												"widgetType" 	=> $widgetName,
																
												"settings" => $block_settings,
												
												"elements" => array( ),
										), 
										
									), // end widget
									
									
									
									
							),// end elements (column )
				
						),
					 
				);
		}
		}
		
		}
		
	}




}

//die(print_r($columns));


	if(is_array($columns) && !empty($columns) ){
	
	      
		$name = $_GET['loadpage']; 
		if(isset($_GET['inner'])){
			$name = $_GET['inner'];		
		}
		
		if(isset($_GET['pname']) && strlen($_GET['pname']) > 1){
			$name = $_GET['pname']; 
		} 
		
		  
	 	$elementor_importer = new PremiumPress_Elementor_Importer();	 	
		$id = $elementor_importer->import_elementor_file( json_encode($columns, JSON_PARTIAL_OUTPUT_ON_ERROR), $name." - ".date('d-m-Y') );
	
		
		//update_post_meta($id, '_wp_page_template', 'elementor_canvas');
		 
		// LOAD FULL PAGE CANVUS FOR NORMAL PAGES
		// UNLESS IT CONTAINS A SPECILA HEADER
		if(!isset($g) || ( isset($g) && !isset($g['homepage_header'])) ){
		update_post_meta($id, '_wp_page_template', 'elementor_header_footer');
		} 
		
		if(isset($_GET['inner']) && in_array($_GET['inner'],array("header","footer"))){
		update_post_meta($id, '_wp_page_template', 'elementor_canvas');
		}
		
		
		
		if(isset($_GET['inner']) && in_array($_GET['inner'],array("ppt_builder"))){
		
			$page = array();
			$page['post_title'] 	= $name;
			$page['post_content'] 	= '[premiumpress_elementor_template id="'.$id.'"]';
			$page['post_status'] 	= 'publish';
			$page['post_type'] 		= 'page';
			$page['post_author'] 	= $userdata->ID;
			$page_id = wp_insert_post( $page );
			
			update_post_meta($page_id, '_wp_page_template', 'elementor_canvas');
			
		
		}
		
	 	 
		// UPDATE DATABASE WITH NEW KEY
		if(isset($_GET['inner']) ){
 				if(strlen($_GET['inner']) > 2){				
				
					 
					$existing_values = get_option("core_admin_values");	
					
					if(isset($_GET['mobile'])){
					$existing_values['pageassign'][$_GET['inner']."_mobile"] = "elementor-".$id;
					}else{
					$existing_values['pageassign'][$_GET['inner']] = "elementor-".$id;
					}
										 
					update_option( "core_admin_values", $existing_values);
					
				
				}
		}elseif(isset($_GET['loadpage']) && $_GET['loadpage'] == "home"){
	
					
					$existing_values = get_option("core_admin_values");		
					
					
					if(isset($_GET['mobile'])){
					$existing_values['pageassign']["homepage_mobile"] = "elementor-".$id;	
					}else{
					$existing_values['pageassign']["homepage"] = "elementor-".$id;	
					}
								 	
									 
					update_option( "core_admin_values", $existing_values);
		
		}
			
			
			
		if( isset($_GET['full']) ){
		update_post_meta($id, '_wp_page_template', 'elementor_canvas'); 
		}
			
	
		die(
		'<div> <h2 style="margin-top:30px;">Loading please wait...</h2></div>'.
		
		'<script>setTimeout(function() { window.location.href = "'.home_url().'/wp-admin/post.php?post='.$id.'&action=elementor"; }, 3000);</script>'
		);
	
	}

}





} // end if admin




 

// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

 	 
// LOAD IN HEADER


_ppt_template('framework/admin/header' ); 
 

_ppt_template('framework/admin/_form-top' ); 
?>




<div class="tab-content d-flex flex-column h-100">

                
        
        <div class="tab-pane active addjumplink" 
         
        data-title="<?php echo __("Overview","premiumpress"); ?>" 
        data-desc=""
        
        data-icon="fa fa-desktop" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
         <?php _ppt_template('framework/admin/parts/design-overview' ); ?>      
        </div><!-- end design home tab -->
                 
       
          
     <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Manage website pages","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can view and customize your website pages.","premiumpress"); ?>"
       
        data-icon="fa fa-desktop" 
         
        id="pages" 
        role="tabpanel" aria-labelledby="pages-tab">
         <?php _ppt_template('framework/admin/parts/design-pages' ); ?> 
        </div><!-- end design home tab -->
       
           
                  
        <div class="tab-pane  addjumplink"         
        data-title="<?php echo __("Pre-Built Designs","premiumpress"); ?>" 
        data-desc=""         
        data-icon="fa fa-pencil-paintbrush" 
        id="ideas" 
        role="tabpanel" aria-labelledby="ideas-tab">
         <?php _ppt_template('framework/admin/parts/design-ideas' ); ?>      
        </div><!-- end design home tab -->
          
          
             
     <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Change my logo &amp; fonts","premiumpress"); ?>" 
        data-desc="<?php echo __("Upload and customize your website logo and fonts.","premiumpress"); ?>"
       
        data-icon="fa fa-lightbulb" 
         
        id="logo" 
        role="tabpanel" aria-labelledby="logo-tab">
         <?php _ppt_template('framework/admin/parts/design-logo' ); ?> 
        </div><!-- end design home tab -->
             
 
 
     <div class="tab-pane  addjumplink" 
          
        
         data-title="<?php echo __("Header Design","premiumpress"); ?>" 
        data-desc="<?php echo __("Change the appearance of your header.","premiumpress"); ?>"
       
        data-icon="fa fa-pager" 
         
        id="header" 
        role="tabpanel" aria-labelledby="header-tab">
         <?php _ppt_template('framework/admin/parts/design-header' ); ?>    
        </div><!-- end design home tab -->
        
        
     <div class="tab-pane  addjumplink" 
          
        
         data-title="<?php echo __("Footer Design","premiumpress"); ?>" 
        data-desc="<?php echo __("Change the appearance of your footer.","premiumpress"); ?>"
       
        data-icon="fa fa-pager" 
         
        id="footer" 
        role="tabpanel" aria-labelledby="footer-tab">
         <?php _ppt_template('framework/admin/parts/design-footer' ); ?>    
        </div><!-- end design home tab --> 
          
   
    <div class="tab-pane addjumplink" 
          
        
         data-title="<?php echo __("Sidebar settings","premiumpress"); ?>" 
        data-desc="<?php echo __("Change the appearance of your sidebar.","premiumpress"); ?>"
       
        data-icon="fa fa-columns" 
         
        id="side" 
        role="tabpanel" aria-labelledby="side-tab">
         <?php _ppt_template('framework/admin/parts/design-sidebar' ); ?>    
        </div><!-- end design home tab -->
          
   
   
   
             
       <div class="tab-pane addjumplink" 
        
        
         data-title="<?php echo __("Change website colors","premiumpress"); ?>" 
        data-desc="<?php echo __("Customize the color schema for your website.","premiumpress"); ?>"
 
        data-icon="fa fa-fill-drip" 
         
        id="colors" 
        role="tabpanel" aria-labelledby="colors-tab">
           <?php _ppt_template('framework/admin/parts/design-colors' ); ?>
        </div><!-- end design home tab -->
   
   
    
         
        <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Change website text","premiumpress"); ?>" 
        data-desc="<?php echo __("Here are quick links to changing website text.","premiumpress"); ?>"
       
        data-icon="fa fa-font-case" 
        id="text" 
        role="tabpanel" aria-labelledby="text-tab">
          <?php _ppt_template('framework/admin/parts/design-text' ); ?>  
        </div><!-- end design home tab -->

      
        <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Change navigation links","premiumpress"); ?>" 
        data-desc="<?php echo __("Here are quick links to help you change menu items.","premiumpress"); ?>"
       
        data-icon="fa fa-bars" 
        id="menu" 
        role="tabpanel" aria-labelledby="menu-tab">
          <?php _ppt_template('framework/admin/parts/design-menu' ); ?>  
        </div><!-- end design home tab -->
              
   
      
        
         
        <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Setup a global announcement","premiumpress"); ?>" 
        data-desc="<?php echo __("Setup a global announcements bar at the top of your website.","premiumpress"); ?>"
       
        data-icon="fa fa-bullhorn" 
        id="section" 
        role="tabpanel" aria-labelledby="section-tab">
          <?php _ppt_template('framework/admin/parts/design-sections' ); ?>  
        </div><!-- end design home tab -->
              
   
      
             
         
         <div class="tab-pane addjumplink"          
          data-title="<?php echo __("Enter custom CSS/Javascript code","premiumpress"); ?>" 
        data-desc="<?php echo __("Add your own code without editing framework files.","premiumpress"); ?>" 
        data-icon="fa fa-code" 
         
        id="css" 
        role="tabpanel" aria-labelledby="css-tab">
            <?php _ppt_template('framework/admin/parts/design-css' ); ?> 
        </div><!-- end design home tab -->





        <div class="tab-pane addjumplink" 
        
        
        data-title="<?php echo __("Other","premiumpress"); ?>" 
        data-desc="<?php echo __("Additional design related options for your website.","premiumpress"); ?>"
       
        data-icon="fa fa-cog" 
        id="misc" 
        role="tabpanel" aria-labelledby="misc-tab">
          <?php _ppt_template('framework/admin/parts/design-misc' ); ?>  
        </div>
      
      
      
      
      
      
         
        
        <?php /*
            <div class="tab-pane addjumplink" 
        
        
           data-title="<?php echo __("Elementor","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can preview any additonal Elementor templates that might be required.","premiumpress"); ?>"
 
        
        data-icon="fa fa-desktop" 
         
        id="elementor" 
        role="tabpanel" aria-labelledby="elementor-tab">
         <?php _ppt_template('framework/admin/parts/design-elementor' ); ?>      
        </div><!-- end design home tab -->
        
        
       
      
              
     <div class="tab-pane addjumplink"         
            data-title="<?php echo __("All Blocks","premiumpress"); ?>" 
        data-desc="<?php echo __("Here you can preview all of the design blocks included in this theme.","premiumpress"); ?>"
 
        data-icon="fa-layer-group" 
        id="linkblocks" 
        role="tabpanel" aria-labelledby="blocks-tab"> 

        
        <?php if(isset($_GET['smallwindow'])){ ?>
        <input type="hidden" name="removesmallwindow" value="1" />
        <?php } ?>
		
        
         */ ?>

</div>



<?php _ppt_template('framework/admin/_form-bottom' ); ?>

<form id="loaddemodesign" name="loaddemodesign" method="post">
<input type="hidden" name="loaddesign" id="loaddesign" value="123" />
</form>
 

<script>

function DeleteSetDesign(id){ 
	jQuery('#'+id).val('');
	document.admin_save_form.submit();
}

jQuery('.loadblockdataajax').on('click', function() {	
	
		var self = jQuery(this);
		var id = this.id;
		var divout = jQuery(this).data('tdiv');
			
		jQuery.ajax({
			type: "POST",
			url: '<?php echo home_url(); ?>/',	
			dataType: 'json',	
			data: {
				admin_action: "load_block_data",
				id: jQuery(this).data('blockid'),
			},
			success: function(response) {
					  	
				// HIDE ROW
				jQuery('#'+divout).html(response.output); 				
				 			
			},
			error: function(e) {
				alert("error gere "+e)
			}
		});		 
			
}); 



jQuery(document).ready(function () {

 
<?php if(isset($_GET['redirecthomepage'])  ){ ?>
window.location.href = "<?php echo home_url(); ?>/?reset=1";
<?php } ?>
 
<?php if(isset($_GET['defaultdesign']) && strlen($_GET['defaultdesign']) > 1 && !isset($_POST['loaddesign'])  ){ ?>
 
jQuery('#loaddesign').val('<?php echo esc_attr($_GET['defaultdesign']); ?>');
document.loaddemodesign.submit();

<?php } ?>

 
 
 	<?php if(isset($_GET['pagekey']) && $_GET['pagekey'] == "home"){ ?>
	
	jQuery('.lefttab').val('pagelinking-tab');
	
	<?php }elseif(isset($_GET['pagekey']) && $_GET['pagekey'] == "header" || isset($_GET['pagekey']) && $_GET['pagekey'] == "footer" ){ ?>
	
	jQuery('.lefttab').val('header-tab');
	
 	<?php }elseif(isset($_GET['pagekey'])){ ?>
	
 	jQuery('.lefttab').val('pagelinking-tab');
	
	<?php } ?>

	<?php if(isset($_POST['removesmallwindow'])){ ?>
 
	self.parent.tb_remove();
	self.parent.location.assign("<?php echo home_url(); ?>/wp-admin/admin.php?page=design&lefttab="+jQuery('.lefttab').val());	 
	<?php } ?>
	
             
     jQuery('.loaddatabox').click(function() { 
              			   	 
     	tb_show('', 'admin.php?page=docs&amp;tid='+ jQuery(this).data('id') +'&amp;pagekey='+ jQuery(this).data('pagekey') + '&amp;smallwindow=1&amp;TB_iframe=true');
		return false;	
 	
     });  
	 
     jQuery('.loadsettingsbox').click(function() { 
	          			   	 
     	tb_show('', 'admin.php?page=docs&amp;tid='+ jQuery(this).data('id') +'&amp;sid='+ jQuery(this).data('settingid') +'&amp;pagekey='+ jQuery(this).data('pagekey') +'&amp;smallwindow=1&amp;TB_iframe=true');
		return false;	
 	
     });
  
});
</script>
<?php _ppt_template('framework/admin/footer' ); ?>