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
  <div class="col-md-6 text-right d-none d-md-block">
  
  
    <?php if(isset($settings['footer_menu1']) && strlen($settings['footer_menu1']) > 2){ ?>
    
    <?php echo str_replace("menu-item","list-inline-item", str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu1'].'" class="list-inline"][/MAINMENU]'))); ?>
    <?php }else{ ?>
    
    <?php  echo str_replace("menu-item","list-inline-item", str_replace("<li>","<li class='list-inline-item'>", str_replace("list-unstyled","list-inline", str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="list-inline"][/MAINMENU]')))));  ?>
    
    <?php } ?>
  </div>
</div>
