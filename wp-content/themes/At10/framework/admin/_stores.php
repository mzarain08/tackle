<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $settings;

if( current_user_can('administrator') && isset($_GET['demodata'])){


		// STORE CREATED IN AN ARRAY	 
		include(get_template_directory() ."/framework/data/_videos.php");
		$videoList = $GLOBALS['_list'];
		
		$storedata =  array(); 
		foreach($videoList as $key => $data){
		
	 
		
			$customPost = get_page_by_title( $data['title'],"","listing_type" );
			 

			if(is_null($customPost)) {	 
			
					
					$ss = get_terms( array(
										'taxonomy' => 'listing',
										'hide_empty' => false,
										'number' => 1,				 
										'search' => $data['cat'],				 
					));
					$cat = "";
					if(!is_wp_error( $ss ) && isset($ss[0])){
						$cat = $ss[0]->term_id;
					}else{
					
						$t = wp_insert_term(
								$data['cat'],   // the term 
								'listing', // the taxonomy
								array( )
							); 
							
							if(is_wp_error( $t )){			
								 
							}elseif(is_object($t)){
								$cat =  $t->term_id; 
							}elseif(is_array($t)){
								$cat =  $t['term_id']; 
							}	
					
					}
			 
					$my_post['post_title'] 		= $data['title'];
					$my_post['post_type'] 		= "listing_type";
					$my_post['post_excerpt'] 	= "";
					$my_post['post_status'] 	= "publish";
					$my_post['post_category'] 	= "";
					$my_post['post_content'] 	= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.";	
					$my_post['tags_input'] 		= array(); 
					$POSTID 					= wp_insert_post( $my_post );
					
					wp_set_post_terms( $POSTID, $cat, "listing" );
					
					update_post_meta($POSTID,"image", $data['image']);
					
					
			}
		
		}


}

if( current_user_can('administrator') && isset($_POST['toolbox']) ){

	global $wpdb, $CORE; 
	
	switch($_POST['toolbox']){
	
		case "delete_tax": {
		
					/*$wpdb->query("delete a,b,c,d
						FROM ".$wpdb->prefix."posts a
						LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
						LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
						LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
						LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
						WHERE a.post_type = 'post' OR a.post_type = 'listing_type' OR a.post_type = 'listing_type' ");
						*/
						
						$wpdb->query("DELETE FROM ".$wpdb->prefix."term_taxonomy WHERE taxonomy='".$_POST['tax']."'");
		
			// LEAVE MESSAGE
			$GLOBALS['ppt_error'] = array(
						"type" 		=> "success",
						"title" 	=> "Settings Updated",
						"message"	=> "featured listings updated.",
			);
			
			 
		
		} break;
	
	
		case "delete_stores": {
		
		
					/*$wpdb->query("delete a,b,c,d
						FROM ".$wpdb->prefix."posts a
						LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
						LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
						LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
						LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
						WHERE a.post_type = 'post' OR a.post_type = 'listing_type' OR a.post_type = 'listing_type' ");
						*/
						
						$wpdb->query("DELETE FROM ".$wpdb->prefix."term_taxonomy WHERE taxonomy='store'");
				 
						update_option('icodes_merchantlist','');
						update_option('icodes_networklist','');
			// LEAVE MESSAGE
			$GLOBALS['ppt_error'] = array(
						"type" 		=> "success",
						"title" 	=> "Settings Updated",
						"message"	=> "featured listings updated.",
			);
	
		} break;
		
		
		
	case "importcats": {
	
	 
		$cats = explode(PHP_EOL,$_POST['cat_import']);
		if(is_array($cats)){
		
		
			$taxType = $_POST['thistax']; 
			
			foreach($cats as $catme){ if($catme == ""){ continue; }
			
				if(substr($catme,0,1) == "-" && substr($catme,0,2) != "--"){				
				
					$term1 = wp_insert_term(substr($catme,1), $taxType, array( 'parent' => $taxID ));
					
					if(isset($term1->error_data['term_exists'])){
						$subtaxID = $term1->error_data['term_exists'];
					}else{		
						$subtaxID = $term1['term_id'];	
					}
									
				}elseif(substr($catme,0,1) == "-" && substr($catme,0,2) == "--"){
				
				wp_insert_term(substr($catme,2), $taxType, array( 'parent' => $subtaxID ));
					
				}else{					
				
					if ( term_exists( $catme , $taxType ) ){
						$term = get_term_by('name', str_replace("_"," ",$catme), $taxType );
						$taxID = $term->term_id;
					}else{
						 
						$term = wp_insert_term(str_replace("_"," ",$catme), $taxType,  array('cat_name' => str_replace("_"," ",$catme) ));
						
						if(isset($term->error_data['term_exists'])){
						$taxID = $term->error_data['term_exists'];
						}else{	
						 
						$taxID = $term['term_id'];	
						}	
						 
					}
				}
				
			} //end foreach
		}// end if
		
			// LEAVE MESSAGE
			$GLOBALS['ppt_error'] = array(
						"type" 		=> "success",
						"title" 	=> "Category Setup Complete",
						"message"	=> "featured listings updated.",
			);
		 
	
	} break;
		 
		

	}
	
	
} 
 
_ppt_template('framework/admin/header' ); 


?>
<div class="tab-content d-flex flex-column h-100">
       
      
       
	<div class="tab-pane addjumplink active" 
        data-title="<?php echo __("Categories","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-tag" 
        id="overview" 
        role="tabpanel" aria-labelledby="overview-tab">
    <?php _ppt_template('framework/admin/parts/stores-overview' ); ?>     
        </div>  
 

 
	<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Delete","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-times" 
        id="del" 
        role="tabpanel" aria-labelledby="del-tab">
    <?php _ppt_template('framework/admin/parts/stores-delete' ); ?>     
        </div>

<?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("cp"))){ ?>
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Demo Stores","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-tag" 
        id="d" 
        role="tabpanel" aria-labelledby="d-tab">
        <?php  _ppt_template('framework/admin/_form-top' ); ?>
    <?php _ppt_template('framework/admin/parts/stores' ); ?>  
     <?php _ppt_template('framework/admin/_form-bottom' ); ?>    
        </div>  

<?php } ?> 

<?php if(defined('THEME_KEY') && in_array(THEME_KEY, array("dl")) || _ppt(array('lst','makemodels')) == '1'){ ?>
        <div class="tab-pane addjumplink" 
        data-title="<?php echo __("Make &amp; Model","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-car" 
        id="makes" 
        role="tabpanel" aria-labelledby="makes-tab">
        <?php  _ppt_template('framework/admin/_form-top' ); ?>
    <?php _ppt_template('framework/admin/parts/stores-makemodel' ); ?>  
     <?php _ppt_template('framework/admin/_form-bottom' ); ?>    
        </div>  

<?php } ?> 


	<div class="tab-pane addjumplink" 
        data-title="<?php echo __("Import","premiumpress"); ?>" 
        data-desc=""
        data-icon="fa-tags" 
        id="import" 
        role="tabpanel" aria-labelledby="import-tab">
    <?php _ppt_template('framework/admin/parts/stores-import' ); ?>     
        </div>    

</div> 
   
<?php  _ppt_template('framework/admin/footer' );  ?>