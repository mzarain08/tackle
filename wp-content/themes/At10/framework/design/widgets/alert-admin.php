<?php

global $CORE_UI;

?>

 

<div ppt-box class="rounded">
  <div class="_content py-3">
    <div class="d-flex">
      <div class="hide-mobile">
        <div style="height:60px; width:60px;" class="bg-light rounded position-relative overflow-hidden text-success" ppt-flex-middle>
          <div ppt-icon-size="32" data-ppt-icon>
            <?php echo $CORE_UI->icons_svg['check_circle']; ?>
          </div>
        </div>
      </div>
      <div class="w-100 mx-3" ppt-flex>
        <div class="text-600 fs-5">
          <?php echo __("Saved Successfully","premiumpress"); ?>
        </div>
        <div class="lh-20 mt-2 fs-sm">
          <?php echo __("Your changes have been updated.","premiumpress"); ?>
        </div>
      </div>
 
    </div>
  </div>
</div>