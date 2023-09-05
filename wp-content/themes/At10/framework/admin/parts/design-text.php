<?php
 
 global $settings;

  $settings = array(
  "title" => __("Website Text","premiumpress"), 
  "desc" => __("Here are links to help you find the text you want to change.","premiumpress"),
  
 
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?> 
        
		<div class="card card-admin"><div class="card-body">

     
<?php 


$task = array(


	1 => array(
		
		"title" => __("Change system text - video tutorial","premiumpress"),
		"desc"	=>	__("Learn how to change system text within your website.","premiumpress"),

		"link"	=>	"https://www.premiumpress.com/doc/change-website-text/",
		"icon" => "fa-external-link" 		
	),
	2 => array(
		
		"title" => __("Custom field text","premiumpress"),
		"desc"	=>	__("These are the fields you create for your website.","premiumpress"),

		"link"	=>	"admin.php?page=listingsetup&lefttab=f",
		"icon" => "fa-font-case" 		
	),
	3 => array(
		
		"title" => __("Navigation text","premiumpress"),
		"desc"	=>	__("These are the menu items on your website.","premiumpress"),

		"link"	=>	"nav-menus.php",
		"icon" => "fa-font-case" 		
	),
	4 => array(
		
		"title" => __("Category text","premiumpress"),
		"desc"	=>	__("These are the tiles and descriptions for your categories.","premiumpress"),

		"link"	=>	"edit-tags.php?taxonomy=listing&post_type=listing_type",
		"icon" => "fa-font-case" 		
	),
	
	5 => array(
		
		"title" => __("Taxonomy text","premiumpress"),
		"desc"	=>	__("These are custom taxonomies created on youe website.","premiumpress"),

		"link"	=>	"admin.php?page=settings&lefttab=taxonomies",
		"icon" => "fa-font-case" 		
	),	
	
);

foreach($task as $t){ ?>

<a href="<?php echo $t['link']; ?>" class="_admin_iconbox icon-box">
<i class="fal bg-primary text-light  <?php echo $t['icon']; ?>"></i><strong><?php echo $t['title']; ?></strong><p><?php echo $t['desc']; ?></p></a>
 
<?php   } ?>

   
        </div></div>
        
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>