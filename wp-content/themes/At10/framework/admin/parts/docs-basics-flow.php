<?php

global $settings;
 
  $settings = array(
  "title" => "Website Flow", 
  "desc" => "Here you can see how we've designed the website flow.",
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body text-center">
    <img data-src="<?php echo DEMO_IMG_PATH; ?>admin/flow1.png" class="img-fluid lazy" alt="img"   />
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
