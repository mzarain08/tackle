<?php

global $settings, $CORE;
 
 $settings = array(
  
  "title" => __("Page Options","premiumpress"), 
  "desc" => __("Additional page display options.","premiumpress"),
  
  "back" => "overview",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
  
  
  <a href="admin.php?page=ppt_editor&s=listingpage" class="_admin_iconbox icon-box mb-3 pb-4" >

<i class="fab bg-primary text-light  fa-elementor"></i><strong><?php echo __("Edit Page Design","premiumpress"); ?></strong><p><?php echo __("You can customize the layout with Elementor.","premiumpress"); ?></p>

</a>

  
<?php if(in_array(_ppt(array("maps","provider")), array("mapbox","google"))  ) {  ?>
    <!-- ------------------------- -->
    <div class="container px-0 mb-3 pb-3 border-bottom">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Show Map Box","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the map display on the ad page.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
     
          <div class="formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('mapbox').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('mapbox').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'mapbox' )), array("1",""))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="mapbox" name="admin_values[design][mapbox]" value="<?php if(in_array(_ppt(array('design', 'mapbox' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>

 </div> </div>
<?php } ?>


    <!-- ------------------------- -->
    <div class="container px-0 mb-3 pb-3 border-bottom">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Social Sharing Box","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the default display of this box.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
     
          <div class="formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('socialshare').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('socialshare').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'socialshare' )), array("1",""))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="socialshare" name="admin_values[design][socialshare]" value="<?php  echo _ppt(array('design', 'socialshare' )); ?>">
        </div>

 </div> </div>




    <!-- ------------------------- -->
    <div class="container px-0 mb-3 pb-3 border-bottom">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Blur Photos","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off to blur photos for non-logged in users.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
     

          <div class="mt-2">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_photologin').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_photologin').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_photologin')), array("1"))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_photologin" name="admin_values[design][display_photologin]" value="<?php if(in_array(_ppt(array('design', 'display_photologin')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
          
          
        </div>

 </div> </div>

    <!-- ------------------------- -->
    <div class="container px-0 mb-3 pb-3 border-bottom">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Default Gallery Style","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Choose which gallery style to use.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
     
    <?php
			   $g = _ppt(array('design', 'default_gallery'));
			   ?>
          <select name="admin_values[design][default_gallery]" class="mt-2 form-control" style="width:100%">
           <option value="" <?php if( $g == ""){ echo "selected=selected"; } ?>></option>
          
            <option value="grid" <?php if( $g == "grid"){ echo "selected=selected"; } ?>><?php echo __("Grid","premiumpress"); ?></option>
          <option value="row" <?php if( $g == "row"){ echo "selected=selected"; } ?>><?php echo __("Gallery","premiumpress"); ?></option>
          <option value="tall" <?php if( $g == "tall"){ echo "selected=selected"; } ?>><?php echo __("Tall Images","premiumpress"); ?></option>
          <option value="carousel" <?php if( $g == "carousel"){ echo "selected=selected"; } ?>><?php echo __("Carousel","premiumpress"); ?></option>
          
             
         
          </select>
        </div>

 </div> </div>




        
<input type="hidden" id="requirelogin_listings" name="admin_values[design][requirelogin_listings]" value="0">          
<input type="hidden" id="display_musiclogin" name="admin_values[design][display_musiclogin]" value="0">
<input type="hidden" id="display_videologin" name="admin_values[design][display_videologin]" value="0">
 
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>