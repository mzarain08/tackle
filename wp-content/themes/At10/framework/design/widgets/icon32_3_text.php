<?php

global $CORE_UI;

?>
<div ppt-flex-between>
    <div class="d-flex border-right pr-3 w-100 mr-3">
        <div ppt-icon-size="32" class="mr-3" data-ppt-icon><?php echo $CORE_UI->icons_svg['clock']; ?></div>
        <span>
            <div class="text-600" data-ppt-f1a><?php echo __("Monday - Friday 08:00 - 20:00","premiumpress"); ?></div>
        
        </span>
    </div>
    
    <div class="d-flex border-right pr-3 w-100 mr-3">
        <div ppt-icon-size="32" class="mr-3" data-ppt-icon2><?php echo $CORE_UI->icons_svg['map-marker']; ?></div>
        <span>
            <div class="text-600" data-ppt-f2a><?php echo __("Our Address","premiumpress"); ?></div>
            <div class="small opacity-8" data-ppt-f2b><?php echo __("London, 24 Rillington Place","premiumpress"); ?></div>
        </span>
    </div>
    
    <div class="d-flex w-100">
        <div ppt-icon-size="32" class="mr-3" data-ppt-icon3><?php echo $CORE_UI->icons_svg['phone']; ?></div>
        <span>
            <div class="text-600" data-ppt-f3a><?php echo __("Phone Us","premiumpress"); ?></div>
            <div class="small opacity-8" data-ppt-f3b><?php echo __("+123 456 789","premiumpress"); ?></div>
        </span>
    </div>
</div>