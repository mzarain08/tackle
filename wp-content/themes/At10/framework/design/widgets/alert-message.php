<?php

global $CORE_UI;

?>

 
<div class="bg-white p-3 rounded shadow" style="max-width:400px;">
          <div class="d-flex">
            <div>
              <div style="height:50px; width:50px;" class="rounded bg-light mr-4 position-relative">
                <div class="bg-image rounded" data-bg="">&nbsp;</div>
              </div>
            </div>
            <div class="fs-5">
              <strong class="_username">Mark</strong> <?php echo __("Has sent you a message, take a look!","premiumpress"); ?>
            </div>
          </div> 
        
        <div class="d-flex w-100 mt-4"> 
          <button class="_ok w-100 btn-primary btn-close" data-ppt-btn><?php echo __("Read","premiumpress"); ?></button>
          <button class="_cancel w-100 btn-system btn-close" data-ppt-btn><?php echo __("Cancel","premiumpress"); ?></button> 
        </div>
      </div>
</div>