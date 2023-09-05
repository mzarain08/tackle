<?php

global $CORE_UI;

?>

<div ppt-box class="rounded">
  <div class="_content py-3">
    <div class="d-flex">
      <div style="width:150px;" class="hide-mobile">
        <div style="height:60px; width:60px;" class="bg-light rounded position-relative overflow-hidden" ppt-flex-middle>
          <div ppt-icon-size="32" data-ppt-icon class="text-warning">
            <?php echo $CORE_UI->icons_svg['bell']; ?>
          </div>
        </div>
      </div>
      <div class="w-100 mx-3" ppt-flex>
        <div class="text-600 fs-5">
          <?php echo __("New Notification","premiumpress"); ?>
        </div>
        <div class="lh-20 mt-2 fs-sm">
          <?php echo __("You have a new notification.","premiumpress"); ?>
        </div>
      </div>
      <div ppt-flex-between ppt-flex-end>
        <a href="#" class="btn-close _ok btn-warning" data-ppt-btn>
        <div ppt-icon-size="24" data-ppt-icon>
          <?php echo $CORE_UI->icons_svg['cursor-click']; ?>
        </div>
        </a> <a href="#" class="btn-system  _cancel btn-close hide-mobile"  data-ppt-btn>
        <div ppt-icon-size="24" data-ppt-icon>
          <?php echo $CORE_UI->icons_svg['close']; ?>
        </div>
        </a>
      </div>
    </div>
  </div>
</div> 