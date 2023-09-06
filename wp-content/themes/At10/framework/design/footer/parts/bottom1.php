<?php global $settings; ?>

<div class="row px-0">
  <div class="col-md-6">
    <div class="copyright opacity-8">
      <?php if(isset($settings['footer_copyright']) && strlen($settings['footer_copyright']) > 2){ ?>
      <?php echo $settings['footer_copyright']; ?>
      <?php }else{ ?>
      &copy; <?php echo date("Y"); ?> <?php echo stripslashes(_ppt(array('company','name'))); ?>. <?php echo __("All rights reserved.","premiumpress"); ?>
      <?php } ?>
    </div>
  </div>
  <div class="col-md-6 text-right d-none d-md-block"> <img data-src="<?php echo CDN_PATH; ?>images/cards_all.svg" alt="cards" class="lazy" /> </div>
</div>
