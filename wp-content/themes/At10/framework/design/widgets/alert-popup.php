<?php

global $CORE_UI;

?>

<div class="p-3 bg-white rounded shadow-lg position-relative" style="min-width: 250px; max-width:400px;">
  <div class="d-flex">
    <div>
      <div style="height:50px; width:50px;" class="rounded bg-light mr-4 position-relative">
        <div class="bg-image rounded bg-light">
        </div>
      </div>
    </div>
    <div class="pr-5">
      <div ppt-icon-24 data-ppt-icon-size="24" class="btn-close position-absolute" style="right:10px; top:10px;cursor:pointer;">
        <?php echo $CORE_UI->icons_svg['close']; ?>
      </div>
      <a href="#" class="_link btn-close text-dark">
      <div class="_username">
        <strong>Sammy</strong> has updated her photo. Do you like it?
      </div>
      </a>
    </div>
  </div>
</div>
