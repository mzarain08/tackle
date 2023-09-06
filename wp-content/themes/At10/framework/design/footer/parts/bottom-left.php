<?php global $settings; 


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
  <div class="col-md-12">
    <div class="copyright opacity-8">
      <?php echo $footer_copyright; ?>
    </div>
  </div>
</div> 