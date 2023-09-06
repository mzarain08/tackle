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

global $wpdb, $CORE, $userdata;

 
// GET PAGES
$page_links = array();
$pages = get_pages();
foreach ( $pages as $page ) { 

	$link = get_page_link( $page->ID );
	
	$page_links[$page->ID] = array("id" => $link , "name" => $page->post_title);

}

// PAGE LINKS ARRAY
$pagelinksarray = array(

	"myaccount" 	=> array("name"=> __("My Account","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-account.php" ),
	"callback" 		=> array("name"=> __("Callback","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-callback.php" ),
	"add" 			=> array("name"=> __("Add Listing","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-add.php"),
 
 
	"pricing" 			=> array("name"=> __("Pricing Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-pricing.php" ),
	
 
 
	"blog" 			=> array("name"=> __("Blog","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-blog.php"),			
	"sellspace" 	=> array("name"=> __("Advertising Page","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "templates/tpl-page-sellspace.php" ),			
			 
	"aboutus" 		=> array("name"=> __("About Us Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-aboutus.php" ),			
	
	"memberships" 	=> array("name"=> "Memberships", "type" => "select", "template" => "templates/tpl-page-memberships.php"  ),
	
	"contact" 		=> array("name"=> __("Contact Form","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "templates/tpl-page-contact.php" ),
	"terms" 		=> array("name"=> __("Terms &amp; Conditions Page","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "templates/tpl-page-terms.php" ),
	"privacy" 		=> array("name"=> __("Privacy Page","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "templates/tpl-page-privacy.php" ),	
			
	"faq" 			=> array("name"=> __("FAQ Page","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "templates/tpl-page-faq.php" ),	
	"testimonials" 	=> array("name"=> __("Testimonials Page","premiumpress"), "type" => "select", "pagelinks" => 1, "template" => "" ),	

		
		
	"how" 			=> array("name"=> __("How it works","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-how.php" ),
			
	"stores" 			=> array("name"=> __("Stores","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-stores.php" ),
	
	"categories" 		=> array("name"=> __("Category List","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-categories.php" ),
	
	"email_verify" 			=> array("name"=> __("Email Verified (Thank You Page)","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "" ),
  
	
	//"users" 			=> array("name"=> __("Users Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-users.php" ),
	
	/* 
	 "popular" 			=> array("name"=> __("Popular Items Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-popular.php" ),
	"new" 				=> array("name"=> __("New Items Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-new.php" ),
	"expire" 			=> array("name"=> __("Ending Soon","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-expire.php" ),
"city" 				=> array("name"=> __("City Search Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-city.php" ),
	"country" 			=> array("name"=> __("Country Search Page","premiumpress"), "type" => "select",  "pagelinks" => 1, "template" => "templates/tpl-page-country.php" ), 
*/
	 
	 
);

if( in_array(THEME_KEY, array("es","da")) ){
unset($pagelinksarray['expire']);
unset($pagelinksarray['users']);
}
 

if(isset($_GET['autocreate']) && isset($pagelinksarray[$_GET['autocreate']])  ){ 
 
		$page = array();
		$page['post_title'] 	= $pagelinksarray[$_GET['autocreate']]['name'];
		$page['post_content'] 	= '';
		$page['post_status'] 	= 'publish';
		$page['post_type'] 		= 'page';
		$page['post_author'] 	= $userdata->ID;
		$page_id = wp_insert_post( $page );
		update_post_meta($page_id , 'pagecolumns', 3);
		update_post_meta($page_id , '_wp_page_template', $pagelinksarray[$_GET['autocreate']]['template']);
	 
		
		$newvals["links"][$_GET['autocreate']] = get_permalink($page_id);
		// GET OLD OPTIONS 
		$existing_values = $CORE->ppt_core_settings;
					 
		// MERGE WITH EXISTING VALUES					 
		$new_result = array_replace_recursive((array)$existing_values, (array)$newvals);
					 
		// UPDATE DATABASE 		
		update_option( "core_admin_values", $new_result, true);
		
		//header(home_url()."/wp-admin/admin.php?page=settings&lefttab=pagelinks");
		//exit();
	 
}

 



if( !$CORE->LAYOUT("captions","memberships") ){ 
unset($pagelinksarray['memberships']);
}

if(!in_array(THEME_KEY, array("cp","cm","es","so","jb","cb")) ){
unset($pagelinksarray['stores']);
}
if(in_array(THEME_KEY, array("es")) ){
	$pagelinksarray["stores"] 	= array("name"	=> __("Agencies Page","premiumpress") );
				
}elseif(in_array(THEME_KEY, array("so")) ){
	$pagelinksarray["stores"] 	= array("name"	=> __("Brands Page","premiumpress") );			
}


if(THEME_KEY == "sp"){

	$pagelinksarray["cart"] 	= array("name"	=> __("Cart","premiumpress"), 	"type" => "select",  );			
	$pagelinksarray["checkout"] = array("name"	=> __("Checkout Page","premiumpress"), "type" => "select",  );
	
	unset($pagelinksarray['offers']);
	unset($pagelinksarray['add']);
	 
}
 


foreach($pagelinksarray  as $key => $link){

$value = _ppt(array("links",$key));

 
  
 ?>
<!-- ------------------------- -->

<div class="container px-0 border-bottom mb-3" <?php /* if($key == "add" && _ppt(array('lst','adminonly')) == 1 ){ $value = ""; echo "style='display:none;'"; }*/ ?>>
  <div class="row py-2">
    <div class="col-md-4">
      <label><?php echo str_replace("(","<br>(",$link['name']); ?></label>
  
    </div>
    <div class="col-md-8">
    
    <div class="position-relative">
       <input class="form-control" type="text" <?php if($value == ""){ ?> style="border:2px solid red !important;"<?php } ?> id="pagelinkfor<?php echo $key; ?>" name="admin_values[links][<?php echo $key; ?>]" value="<?php echo $value; ?>">
       
       <?php if( $value != ""){ ?>
       
        <span class="input-group-addon" style="top: 10px;    right: 50px;    position: absolute;    z-index: 100;"> <a href="javascript:void(0);" onclick="jQuery('.sel-<?php echo $key; ?>').toggle()"> <span class="fal fa-file"></span></a> </span>
      
       <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;"> <a href="<?php echo _ppt(array("links",$key)); ?>" target="_blank"> <span class="fal fa-external-link"></span></a> </span>
       <?php } ?>
    </div>
    
    
    <?php if($value == "" && $key != "email_verify"){ ?>
    <a href="admin.php?page=settings&lefttab=pagelinks&autocreate=<?php echo $key; ?>" class="float-right btn-sm btn-system font-weight-bold mt-2"><?php echo __("Create Page For Me","premiumpress"); ?></a>
    <?php } ?>
       
       <select class="form-control-sm mt-2 border-0 bg-light sel-<?php echo $key; ?>" onchange="jQuery('#pagelinkfor<?php echo $key; ?>').val(this.value)" style="display:none;">
       <option></option>
       <?php
	   foreach($page_links as $p){
	   ?>
       <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
       <?php } ?>
       </select>
     
    </div>
  </div>
</div>
<!-- ------------------------- -->
<?php
 
} 
?> 