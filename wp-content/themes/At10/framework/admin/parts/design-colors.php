<?php

global $settings, $CORE;

  $settings = array(
  "title" => __("Colors","premiumpress"), 
  "desc" => __("Here you can setup custom colors for your website.","premiumpress"),
  "video" => "https://www.youtube.com/watch?v=y8wH_LyLbeM",
  
   "back" => "overview",
 
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">

  <div class="card-body">
  
 <?php /* 
  
    <div class="row">
    
      <div class="col-md-6">
     
          <label><?php echo __("System Colors","premiumpress"); ?></label>
      
     <p><?php echo __("Select a system color palette or create your own below.","premiumpress"); ?></p>
      
      </div>
      <div class="col-md-6">
<select name="admin_values[design][color_sheet]" class="form-control" >
<option value=""><?php echo __("Disabled","premiumpress"); ?></option> 
<?php
$ss = _ppt(array('design','color_sheet'));
$colors = $CORE->LAYOUT("ppt_colors",array());
foreach($colors as $k => $v){
?>
<option value="<?php echo $k; ?>" <?php if($ss == $k){ echo 'selected=selected'; } ?>><?php echo $v['name']; ?></option>   

<?php } ?>
  
</select>
  
</div>

</div>
  
  
  
<hr />  
  
  */ ?>
  
    <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px; background:<?php echo _ppt(array('design','color_bg')); ?>" class=" m-3 py-4 border text-center">
          <div style="font-size:30px; font-weight:bold; color:<?php echo _ppt(array('design','color_text')); ?>" class="py-4"><?php echo __("Text Color","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Website Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="w1" name="admin_values[design][color_bg]" value="<?php echo _ppt(array('design','color_bg'));  ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Body Text Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="w2" name="admin_values[design][color_text]" value="<?php echo _ppt(array('design','color_text')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <hr />
    <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px; background:<?php echo _ppt(array('design','color_bgdark')); ?>" class=" m-3 py-4 border text-center">
          <div class="text-primary" style="font-size:30px; font-weight:bold; <?php if(_ppt(array('design','color_primary')) != ""){ ?>color:<?php echo _ppt(array('design','color_primary')); } ?> !important"><?php echo __("Primary Text","premiumpress"); ?></div>
          <div class="text-secondary mt-3 pb-4 font-weight-bold" style="<?php if(_ppt(array('design','color_secondary')) != ""){ ?>color:<?php echo _ppt(array('design','color_secondary')); } ?> !important;"><?php echo __("Secondary color","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Primary Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc1" name="admin_values[design][color_primary]" value="<?php echo _ppt(array('design','color_primary')); ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Secondary Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc3" name="admin_values[design][color_secondary]" value="<?php echo _ppt(array('design','color_secondary')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px;" class=" m-3 py-4 border text-center bg-dark">
          <div class="text-primary" style="font-size:30px; font-weight:bold; <?php if(_ppt(array('design','color_link_light')) != ""){ ?>color:<?php echo _ppt(array('design','color_link_light')); }else{ ?> color:#fff<?php } ?> !important"><?php echo __("Link Light","premiumpress"); ?></div>
          <div class="text-secondary mt-3 pb-4 font-weight-bold" style="<?php if(_ppt(array('design','color_link_dark')) != ""){ ?>color:<?php echo _ppt(array('design','color_link_dark')); }else{ ?>color:#000<?php } ?> !important;"><?php echo __("Link Dark","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Link Light Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc1" name="admin_values[design][color_link_light]" value="<?php echo _ppt(array('design','color_link_light')); ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Link Dark Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc3" name="admin_values[design][color_link_dark]" value="<?php echo _ppt(array('design','color_link_dark')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    
    <?php /*
    <div class="row">
      <div class="col-md-6 mt-4">
        <div class="row mx-4 text-center">
          <div class="col-6" style="height:130px; border-radius:4px; <?php if(_ppt(array('design','color_primary_soft')) != ""){ ?>background:<?php echo _ppt(array('design','color_primary_soft')); ?> !important; <?php } ?>" >
          <i class="fa fa-circle text-primary" style="padding-top:30px; font-size:70px; font-weight:bold;"></i> </div>
          
          <div class="col-6 " 
   style="height:130px; border-radius:4px; <?php if(_ppt(array('design','color_secondary_soft')) != ""){ ?> background:<?php echo _ppt(array('design','color_secondary_soft')); ?> !important; <?php } ?>">
   <i class="fa fa-circle text-secondary" style="padding-top:30px; font-size:70px; font-weight:bold;"></i> </div>
        </div>
      </div>
      
      
      <div class="col-md-6 mt-3">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Primary Soft Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="gbg1" name="admin_values[design][color_primary_soft]" value="<?php echo _ppt(array('design','color_primary_soft'));  ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Secondary Soft Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="gbg2" name="admin_values[design][color_secondary_soft]" value="<?php echo _ppt(array('design','color_secondary_soft'));  ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
	
	*/ ?>
    
    
    <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px; <?php if(_ppt(array('design','color_breadcrumbs')) != ""){ ?>background:<?php echo _ppt(array('design','color_breadcrumbs')); }else{ ?> <?php } ?>" class=" m-3 py-4 border text-center">
          <div class="text-dark" style="font-size:30px; font-weight:bold;"><?php echo __("Breadcrumbs","premiumpress"); ?></div>
          <div class="text-secondary mt-3 pb-4 font-weight-bold" style="<?php if(_ppt(array('design','color_breadcrumbs_text')) != ""){ ?>color:<?php echo _ppt(array('design','color_breadcrumbs_text')); }else{ ?>color:#ddd<?php } ?> !important;"><?php echo __("Breadcrumbs Text","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("breadcrumbs Box Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control"  name="admin_values[design][color_breadcrumbs]" value="<?php echo _ppt(array('design','color_breadcrumbs')); ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("breadcrumbs Box Text","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control"   name="admin_values[design][color_breadcrumbs_text]" value="<?php echo _ppt(array('design','color_breadcrumbs_text')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />   
    
    
   <div class="row">
      <div class="col-md-6">
        <div style="border-radius:4px; <?php if(_ppt(array('design','color_search')) != ""){ ?>background:<?php echo _ppt(array('design','color_search')); }else{ ?> <?php } ?>" class=" m-3 py-4 border text-center">
          <div class="text-dark" style="font-size:30px; font-weight:bold;"><?php echo __("Search Box","premiumpress"); ?></div>
          <div class="text-secondary mt-3 pb-4 font-weight-bold" style="<?php if(_ppt(array('design','color_search_text')) != ""){ ?>color:<?php echo _ppt(array('design','color_search_text')); }else{ ?>color:#ddd<?php } ?> !important;"><?php echo __("Search Box Text","premiumpress"); ?></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Search Box Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control"  name="admin_values[design][color_search]" value="<?php echo _ppt(array('design','color_search')); ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Search Box Text","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control"   name="admin_values[design][color_search_text]" value="<?php echo _ppt(array('design','color_search_text')); ?>" autocomplete="off">
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    
    
    
    
    <div class="row">
      <div class="col-md-6">
        <div class="row mx-4 text-center">
        
        
          <div class="col-6" style="height:130px; border-radius:4px;" >
          <i class="fa fa-circle <?php if(_ppt(array('design','color_border')) != ""){  }else{ ?>text-light<?php } ?>" style="padding-top:30px; font-size:70px; font-weight:bold;<?php  if(_ppt(array('design','color_border')) != ""){ ?>color:<?php echo _ppt(array('design','color_border')); ?><?php } ?>"></i>
          
          </div>
          
       </div>
         </div>
      
      <div class="col-md-6 mt-3">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Border Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="gbg1" name="admin_values[design][color_border]" value="<?php echo _ppt(array('design','color_border'));  ?>" autocomplete="off">
            </div>
          </div>
       
        </div>
      </div>
    </div>
    <hr />
    
    
    <div class="row">
      <div class="col-md-6">
        <div class="row mx-4 text-center">
        
        
          <div class="col-6" style="height:130px; border-radius:4px;" >
          <i class="fa fa-circle <?php if(_ppt(array('design','color_box')) != ""){  }else{ ?>text-light<?php } ?>" style="padding-top:30px; font-size:70px; font-weight:bold;<?php  if(_ppt(array('design','color_box')) != ""){ ?>color:<?php echo _ppt(array('design','color_box')); ?><?php } ?>"></i>
          
          </div>
          
       </div>
         </div>
      
      <div class="col-md-6">
        <div class="row px-3">
        
          <div class="col-12">
            <label class="txt500"><?php echo __("Ad Page Box Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 box mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="gbg1" name="admin_values[design][color_box]" value="<?php echo _ppt(array('design','color_box'));  ?>" autocomplete="off">
            </div>
          </div>
          
            <div class="col-12  mt-3">
            <label class="txt500"><?php echo __("Ad Page Box Text Color","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 box mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="gbg1" name="admin_values[design][color_box_text]" value="<?php echo _ppt(array('design','color_box_text'));  ?>" autocomplete="off">
            </div>
          </div>
          
       
        </div>
      </div>
    </div>
    <hr />
    
    
    <div class="row">
      <div class="col-md-6 mt-4">
        <div class="row mx-4 text-center">
          <div class="col-6 bg-dark" style="height:130px; border-radius:4px; <?php if(_ppt(array('design','color_bgdark')) != ""){ ?>background:<?php echo _ppt(array('design','color_bgdark')); ?> !important; <?php } ?>" > <i class="fa fa-circle text-white" style="padding-top:30px; font-size:70px; font-weight:bold;"></i> </div>
          <div class="col-6 bg-light" 
   style="height:130px; border-radius:4px; <?php if(_ppt(array('design','color_bglight')) != ""){ ?> background:<?php echo _ppt(array('design','color_bglight')); ?> !important; <?php } ?>"> <i class="fa fa-circle text-dark" style="padding-top:30px; font-size:70px; font-weight:bold;"></i> </div>
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="row px-3">
          <div class="col-12">
            <label class="txt500"><?php echo __("Dark Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc2" name="admin_values[design][color_bgdark]" value="<?php echo _ppt(array('design','color_bgdark'));  ?>" autocomplete="off">
            </div>
          </div>
          <div class="col-12 mt-4">
            <label class="txt500"><?php echo __("Light Background","premiumpress"); ?></label>
            <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
              <input type="text" class="form-control" id="pc4" name="admin_values[design][color_bglight]" value="<?php echo _ppt(array('design','color_bglight'));  ?>" autocomplete="off">
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
