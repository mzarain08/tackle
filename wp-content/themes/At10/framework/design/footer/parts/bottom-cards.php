<?php global $settings;


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
?>

<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8">
      <?php echo $footer_copyright; ?>
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block"> <img data-src="<?php echo $icons; ?>" src="" alt="cards" class="lazy" /> </div>
</div>
