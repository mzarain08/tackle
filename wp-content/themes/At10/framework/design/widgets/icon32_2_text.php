<?php

global $CORE_UI;

?>
<div class="d-flex">
<div class="w-100">
    <div class="d-flex w-100 justify-content-md-end" >
        <div ppt-icon-size="32" class="mr-3" data-ppt-icon><?php echo $CORE_UI->icons_svg['clock']; ?></div>
        <span>
            <div class="text-600" data-ppt-f1a><?php echo __("Monday - Friday 08:00 - 20:00","premiumpress"); ?></div>

        </span>
    </div> 
</div>

<div class="mx-4 border-left">&nbsp;</div>
<div class="w-100">
    <div class="d-flex w-100 text-right">
        <div ppt-icon-size="32" class="mr-3" data-ppt-icon3><?php echo $CORE_UI->icons_svg['phone']; ?></div>
        <span>
            <div class="text-600" data-ppt-f3a><?php echo __("Phone Us","premiumpress"); ?></div>
            <div class="small opacity-8" data-ppt-f3b><?php echo __("+123 456 789","premiumpress"); ?></div>
        </span>
    </div>
</div>
</div>
</div>