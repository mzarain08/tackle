<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

//echo do_shortcode('[MAINMENU class="navbar-nav" style=1]');
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav>
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Basic",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav class="spacing">
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Spacing",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
<div ppt-nav class="list"><ul><li class="text"><span>Field 1</span><span>Value 1</span></li><li class="text"><span>Field 2</span><span>Value 2</span></li><li class="text"><span>Field 3</span><span>Value 3</span></li><li class="text"><span>Field 4</span><span>Value 4</span></li><li class="text"><span>Field 5</span><span>Value 5</span></li><li class="text"><span>Field 6</span><span>Value 6</span></li><li class="text"><span>Field 7</span><span>Value 7</span></li><li class="text"><span>Field 8</span><span>Value 8</span></li><li class="text"><span>Field 9</span><span>Value 9</span></li></ul></div>


<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "List",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
<div ppt-nav class="spaced">
<ul>
<li class="text"><span>Field 1</span></li>
<li class="text"><span>Field 2</span></li>
<li class="text"><span>Field 3</span></li>
<li class="text"><span>Field 4</span></li>
</ul>
</div>


<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "List Dotted",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav>
	  <?php echo do_shortcode('[MAINMENU topnav=1 class="d-flex justify-content-between"][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Flex Spaced",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav class="seperator">
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Seperator",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav class="boxed">
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Boxed",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav class="boxed pill">
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Boxed Pill",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
 <nav ppt-nav class="spacing seperator crumbs">
	  <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 </nav>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Breadcrumbs",
	"desc" => "",
	"data" => $output,
);

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 

<nav  ppt-nav class="seperator">
    <ul>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3 is longer</a></li>
        <li class="ml-auto">
        
        <?php  echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "xs", "website" => 1, "header" => 1)); ?>
        
        </li>
    </ul>
</nav>
 
 
 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Right",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

 
?>
 
<div class="row">
 
 
<div class="col-md-6 navbar-dark border py-5 bg-dark" ppt-flex-middle>

<?php echo $CORE->LAYOUT("get_logo","light"); ?>

</div> 

<div class="col-md-6 navbar-light border py-5" ppt-flex-middle>

<?php echo $CORE->LAYOUT("get_logo","dark"); ?>

</div> 

</div>
 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Logo",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

 
?>
<nav ppt-nav class="seperator">
<?php echo do_shortcode('[MAINMENU style=1]');  ?> 
</nav>

<div class="clearfix"></div>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Dropdown Menu",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
<div class="d-flex navbar-light" ppt-flex-between> 
<a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
<nav ppt-nav class="spacing d-flex" ppt-flex-center> 
<?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
<a href="#" class="btn-primary" data-ppt-btn>Button</a>
</nav>  
</div> 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Full",
	"desc" => "",
	"data" => $output,
);


 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
 
<header class="navbar-light">
 

<nav ppt-nav class="ppt-top-menu bg-dark py-2 small" ppt-flex-between>

<?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
 
<?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "xs", "website" => 1, "header" => 1)); ?>
 
</nav>  

<div class="d-flex navbar-light py-3" ppt-flex-between> 
<a class="navbar-brand" href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
<nav ppt-nav class="spacing d-flex" ppt-flex-center> 
<?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
<a href="#" class="btn-primary" data-ppt-btn>Button</a>
</nav>  
</div> 

</header>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Full",
	"desc" => "",
	"data" => $output,
);




 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<header class="navbar-light">

<div ppt-flex-between>

	<a  href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>

    <nav ppt-nav class="spacing seperator crumbs d-flex">
    
   <?php echo do_shortcode('[MAINMENU topnav=1][/MAINMENU]'); ?> 
    
    <ul class="ml-n4">
    <li> <a href="" class="border-left pl-3">Sign In <span ppt-icon-16><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></span> </a> </li>
    </ul> 
      
	</nav>

</div>

</header>

<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Top Menu",
	"desc" => "",
	"data" => $output,
);






///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<header class="navbar-light">

<div ppt-flex-between>

	<a  href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>

<?php _ppt_template( 'framework/design/widgets/icon32_3_text' );  ?>

</div>

</header> 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Working Times",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<header class="navbar-light">

<div ppt-flex-between>

<a  href="<?php echo home_url(); ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>

<?php _ppt_template( 'framework/design/widgets/icon32_search' );  ?>

</div>

</header> 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Working Times",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>