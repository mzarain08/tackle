<?php
 
 global $settings;

  $settings = array(
  "title" => __("Website Navigation","premiumpress"), 
  "desc" => __("Here are links to help you find the right menu items.","premiumpress"),
   
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?> 
        
		<div class="card card-admin"><div class="card-body">

     
<?php 


$task = array(


	1 => array(
		
		"title" => __("Change menu items - video tutorial","premiumpress"),
		"desc"	=>	__("Learn how to change menu navigation on your website.","premiumpress"),

		"link"	=>	"https://www.premiumpress.com/doc/menu-navigation/",
		"icon" => "fa-external-link" 		
	),
	2 => array(
		
		"title" => __("Wordpress menu manager","premiumpress"),
		"desc"	=>	__("Most of the theme menus are setup using the WordPress menu manager.","premiumpress"),

		"link"	=>	"nav-menus.php",
		"icon" => "fa-bars" 		
	),
	3 => array(
		
		"title" => __("Mobile footer menu items","premiumpress"),
		"desc"	=>	__("Here you can change mobile menu icons and links.","premiumpress"),

		"link"	=>	"admin.php?page=settings&lefttab=menu",
		"icon" => "fa-bars" 		
	),
 	
	
);

foreach($task as $t){ ?>

<a href="<?php echo $t['link']; ?>" class="_admin_iconbox icon-box">
<i class="fal bg-primary text-light  <?php echo $t['icon']; ?>"></i><strong><?php echo $t['title']; ?></strong><p><?php echo $t['desc']; ?></p></a>
 
<?php   } ?>

   
        </div></div>
        
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>