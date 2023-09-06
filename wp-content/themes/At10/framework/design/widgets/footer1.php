<?php

global $CORE, $CORE_UI;

?>

<footer class="footer section-60 text-center bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12 logo-lg">
        <?php echo $CORE->LAYOUT("get_logo","light"); ?>
      </div>
      <div class="col-md-12 my-4">
        <nav ppt-nav class=" seperator d-flex d-flex justify-content-center"> <?php echo do_shortcode('[MAINMENU footer=1][/MAINMENU]'); ?> </nav>
      </div>
      <div class="col-md-12">
        <?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "lg", "website" => 1, "footer" => 1)); ?>
      </div>
      <div class="col-12 text-center small mt-5 opacity-8">
        &copy; 2022 - PremiumPress Limited.
      </div>
    </div>
  </div>
</footer>
