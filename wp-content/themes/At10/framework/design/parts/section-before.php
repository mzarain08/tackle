<?php
global $settings;
 
if(isset($settings['section_pattern']) && is_numeric($settings['section_pattern']) ){ ?>
<div class="bg-pattern" data-bg="<?php echo CDN_PATH; ?>images/pattern/<?php echo $settings['section_pattern']; ?>.svg"></div>
<?php } ?>