<?php

global $CORE_UI, $CORE, $userdata;

?>

<div  class="ppt-forms style3 d-flex">
  <form action="<?php echo home_url(); ?>" class="position-relative" style="min-width:400px;">
    <div class="input-group">
      <input type="text" class="form-control rounded-pill pl-4 typeahead border-0" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
    </div>
    <button class="iconbit icon-svg" style="width:60px; height:46px;" type="submit" data-ppt-btn>
    <div ppt-icon-24>
      <?php echo $CORE_UI->icons_svg['search']; ?>
    </div>
    </button>
  </form>
  <div style="min-width:80px;" class="text-center ml-3">
    <a <?php if(!$userdata->ID){ ?> href="javascript:void(0);" onclick="processLogin();" <?php }else{ ?>href="<?php echo _ppt(array('links','myaccount')); ?>"<?php } ?>> <?php echo $CORE_UI->AVATAR("user", array("size" => "md", "uid" => $userdata->ID, "css" => "rounded-circle shadow-sm border", "online" => 0, "link" => 0 )); ?> </a>
  </div>
</div>
