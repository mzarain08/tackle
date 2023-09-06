<?php global $settings, $CORE_UI; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$icons = CDN_PATH."images/cards_all.svg";
if(strlen(_ppt("footer_icons")) > 2){
$icons = _ppt("footer_icons"); 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$footer_copyright = "";
if(strlen(_ppt(array('newfooter','copy'))) > 2){
$footer_copyright = "&copy; ".date("Y")." ". _ppt(array('newfooter','copy'));
}elseif(isset($settings['footer_copyright']) && strlen($settings['footer_copyright']) > 2){
$footer_copyright = $settings['footer_copyright'];
}else{
$footer_copyright = "&copy; ".date("Y")." ".stripslashes(_ppt(array('company','name')))." ".__("All rights reserved.","premiumpress");
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!isset($settings["footer_copyright_style"])){  $settings["footer_copyright_style"] = "";}

switch($settings["footer_copyright_style"]){

	case "1": {
?>
<div class="row px-0">
  <div class="col-md-12">
    <div class="copyright opacity-8">
      <?php echo $footer_copyright; ?>
    </div>
  </div>
</div> 
<?php
	} break;
	case "2": {
?>
<div class="row px-0">
  <div class="col-md-12 text-center">
    <div class="copyright opacity-8"><?php echo $footer_copyright; ?></div>
  </div>
</div>
<?php
	} break;
	case "3": {
?>
<div class="row px-0">
  <div class="col-md-12 text-right">
    <div class="copyright opacity-8"><?php echo $footer_copyright; ?></div>
  </div>
</div>
<?php
	} break;
 
 	case "5": {
?>
<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8"><?php echo $footer_copyright; ?></div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block">
  <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "md")); ?>  
  </div>
</div>
<?php
	} break;	
 	case "6": {
?>
<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8"><?php echo $footer_copyright; ?></div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block">
  
  
    <?php if(isset($settings['footer_menu1']) && strlen($settings['footer_menu1']) > 2){ ?>
    
    <?php echo str_replace("menu-item","list-inline-item", str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu1'].'" class="list-inline"][/MAINMENU]'))); ?>
    <?php }else{ ?>
    
    <?php  echo str_replace("menu-item","list-inline-item", str_replace("<li>","<li class='list-inline-item'>", str_replace("list-unstyled","list-inline", str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="list-inline"][/MAINMENU]')))));  ?>
    
    <?php } ?>
  </div>
</div>
<?php
	} break;
	default: {
	?>
	<div class="row px-0">
	  <div class="col-md-6">
		<div class="copyright opacity-8">
		  <?php echo $footer_copyright; ?>
		</div>
	  </div>
	  <div class="col-md-6 text-right d-none d-md-block"> <img data-src="<?php echo $icons; ?>" alt="cards" class="lazy" /> </div>
	</div>
	<?php
	}
}

?>