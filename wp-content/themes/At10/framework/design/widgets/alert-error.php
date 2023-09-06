<?php

global $CORE_UI;

?>

<div class="p-4 bg-white">
  <div class="d-flex flex-row mobile-mb-2">
    <div class="mr-3 mt-1 text-danger">
      <div ppt-icon-size="48" data-ppt-icon>
        <?php echo $CORE_UI->icons_svg['clock']; ?>
      </div>
    </div>
    <div>
      <div class="fs-md text-600 mb-2" data-ppt-title>
        Deactivate account
      </div>
      <div class="" data-ppt-desc>
        Are you sure you want to deactivate your account? All of your data will
          be permanently removed. This action cannot be undone.
      </div>
    </div>
  </div>
</div>
<div class="border-top bg-light p-3">
  <div class="text-right">
    <a href="#" class="btn-system btn-close" data-ppt-btn data-ppt-btn-link><span data-ppt-btn-txt>Cancel</span></a>
    <a href="#" class="btn-danger btn-close" data-ppt-btn data-ppt-btn2-link><span data-ppt-btn2-txt>Deactivate</span></a>
  </div>
</div> 