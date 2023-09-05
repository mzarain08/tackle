<?php

global $settings;

  $settings = array(
  "title" => __("Sidebar","premiumpress"), 
  "desc" => __("Here you can setup your webiste sidebar.","premiumpress"),
  //"video" => "https://www.youtube.com/watch?v=y8wH_LyLbeM",
  
   "back" => "overview",
 
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
  
  
  
  
  
          
      
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Open","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you can set the sidebar to always open.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_sidebar_open').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_sidebar_open').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','sidebar_open')), array("1"))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_sidebar_open" name="admin_values[design][sidebar_open]" value="<?php if(in_array(_ppt(array('design','sidebar_open')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
        
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Text","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you can set the text color style.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_mobile_sidebar_text').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_mobile_sidebar_text').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_text')), array("1"))){  ?>on<?php } ?>">
                  <div class="yes">
                    Dark
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    Light
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_mobile_sidebar_text" name="admin_values[design][mobile_sidebar_text]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_text')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
  
  
  
      
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Logo","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you can turn on/off the sidebar logo.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_mobile_sidebar_logo').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_mobile_sidebar_logo').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_logo')), array("1",""))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_mobile_sidebar_logo" name="admin_values[design][mobile_sidebar_logo]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_logo')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Shadow","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you can turn on/off the sidebar shadow.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_mobile_sidebar_shadow').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_mobile_sidebar_shadow').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_shadow')), array("1",""))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_mobile_sidebar_shadow" name="admin_values[design][mobile_sidebar_shadow]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_shadow')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
    <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Categories","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you show/hide the sidebar categories box","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_sidebar_categories').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_sidebar_categories').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_categories')), array("1"))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_sidebar_categories" name="admin_values[design][mobile_sidebar_categories]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_categories')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
         <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Buttons","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you show/hide the user login/account buttons.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_sidebar_buttons').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_sidebar_buttons').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_buttons')), array("1",""))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_sidebar_buttons" name="admin_values[design][mobile_sidebar_buttons]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_buttons')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Languages","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you show/hide the sidebar languages box","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_sidebar_languages').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_sidebar_languages').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_languages')), array("1",""))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_sidebar_languages" name="admin_values[design][mobile_sidebar_languages]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_languages')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
                
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Mobile Sidebar Currency","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you show/hide the sidebar currency box","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_sidebar_currency').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_sidebar_currency').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','mobile_sidebar_currency')), array("1",""))){  ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="enable_sidebar_currency" name="admin_values[design][mobile_sidebar_currency]" value="<?php if(in_array(_ppt(array('design','mobile_sidebar_currency')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
    
  
  
    <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px; background:<?php echo _ppt(array('design','sidebar_bg')); ?>" class=" m-3 py-4 border text-center">
          <div style="font-size:30px; font-weight:bold; color:<?php echo _ppt(array('design','sidebar_logo_bg')); ?>" class="py-4"><?php echo __("Background","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Sidebar Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="w1" name="admin_values[design][sidebar_bg]" value="<?php echo _ppt(array('design','sidebar_bg'));  ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Sidebar Logo Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="w2" name="admin_values[design][sidebar_logo_bg]" value="<?php echo _ppt(array('design','sidebar_logo_bg')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    
  
  
  
 
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>







<?php


/*

         <!-- ------------------------- -->
          <div class="row pb-3 pt-3 mb-3 border-bottom">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Global Sidebar","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn on a global website sidebar.","premiumpress"); ?></p>
            </div>
            <div class="col-md-3">
              <div class="mt-3">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('customsidebar').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('customsidebar').value='1'">
                </label>
                <div class="toggle <?php if(in_array(_ppt(array('design', 'customsidebar')), array("1"))){ ?>on<?php } ?>">
                  <div class="yes">
                    ON
                  </div>
                  <div class="switch">
                  </div>
                  <div class="no">
                    OFF
                  </div>
                </div>
              </div>
              <input type="hidden" id="customsidebar" name="admin_values[design][customsidebar]" value="<?php if(in_array(_ppt(array('design', 'customsidebar')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
            </div>
          </div> 
        

*/ ?>

<input type="hidden" id="customsidebar" name="admin_values[design][customsidebar]" value="0">
