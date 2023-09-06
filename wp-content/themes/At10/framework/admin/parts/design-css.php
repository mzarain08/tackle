<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Custom CSS","premiumpress"); ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Enter custom CSS and we'll add it between your website &lt;head&gt; tags.","premiumpress"); ?></p>
      <div class="mt-2">
        <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <textarea class="form-control" style="height:300px !important;font-size:11px;" name="adminArray[custom_head]"><?php echo stripslashes(get_option('custom_head')); ?></textarea>
          
          
		  <p class="description"><?php echo __("Style tags are already included so there is no need to add them again.","premiumpress"); ?></p>
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Custom JS","premiumpress"); ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Enter custom javascript code and we'll add it to your website footer.","premiumpress"); ?></p>
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <textarea class="form-control" style="height:300px !important;font-size:11px;" name="adminArray[custom_js]"><?php echo stripslashes(get_option('custom_js')); ?></textarea>
           <p class="description"><?php echo __("Script tags are already included so there is no need to add them again.","premiumpress"); ?></p>
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Custom Body Tags","premiumpress"); ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Enter custom tags and we'll add it to the body class list for your website.","premiumpress"); ?></p>
      <div class="mt-2">
        <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
          <input type="text" class="form-control"  name="admin_values[design][custom_bodytags]" value="<?php echo _ppt(array('design','custom_bodytags')); ?>"> 
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
