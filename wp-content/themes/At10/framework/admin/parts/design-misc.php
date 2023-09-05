<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("MISC Options","premiumpress"); ?></h3>
       <div class="mt-4">
 <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
      
      
    </div>
    <div class="col-md-8">
      <div class="card card-admin">
        <div class="card-body">
        
 
   
          <div class="row border-bottom  pb-3 pt-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Breadcrumbs","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("This will turn on/off the default theme breadcrumbs.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_breadcrumbs').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_breadcrumbs').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','breadcrumbs')), array("","1"))){  ?>on<?php } ?>">
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
              <input type="hidden" id="enable_breadcrumbs" name="admin_values[design][breadcrumbs]" value="<?php if(in_array(_ppt(array('design','breadcrumbs')), array("","1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>       
        
        
        
         
          <!-- ------------------------- -->
          <div class="row pb-3 pt-3 mb-3 border-bottom">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Show Emoji Icons","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn on/off the default emoji icons.","premiumpress"); ?></p>
            </div>
            <div class="col-md-3">
              <div class="mt-3">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('ppt_emoji').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('ppt_emoji').value='1'">
                </label>
                <div class="toggle <?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){ ?>on<?php } ?>">
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
              <input type="hidden" id="ppt_emoji" name="admin_values[design][ppt_emoji]" value="<?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  echo 1; }else{ echo 0; }  ?>">
            </div>
          </div>
       
        
        
        
          <!-- ------------------------- -->
          <div class="row pb-3 pt-3 mb-3 border-bottom">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Admin Quick Links Bubble","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn on/off the blue quick links button in the bottom right corner.","premiumpress"); ?></p>
            </div>
            <div class="col-md-3">
              <div class="mt-3">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('admin_popup').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('admin_popup').value='1'">
                </label>
                <div class="toggle <?php if(in_array(_ppt(array('design', 'admin_popup')), array("","1"))){ ?>on<?php } ?>">
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
              <input type="hidden" id="admin_popup" name="admin_values[design][admin_popup]" value="<?php if(in_array(_ppt(array('design', 'admin_popup')), array("","1"))){  echo 1; }else{ echo 0; }  ?>">
            </div>
          </div>




          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Elementor Globals File","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Disable this to prevent the globals file being added automtically.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_elementor_globals').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_elementor_globals').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','elementor_globals')), array("","1"))){  ?>on<?php } ?>">
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
              <input type="hidden" id="enable_elementor_globals" name="admin_values[design][elementor_globals]" value="<?php if(in_array(_ppt(array('design','elementor_globals')), array("","1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Elementor Lightbox","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Use elementor lightbox and disable the theme lightbbox.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_elementor_lightbox').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_elementor_lightbox').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','elementor_lightbox')), array("1"))){  ?>on<?php } ?>">
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
              <input type="hidden" id="enable_elementor_lightbox" name="admin_values[design][elementor_lightbox]" value="<?php if(in_array(_ppt(array('design','elementor_lightbox')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          

          
          
          
          
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Page Size","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Here you can set the default page container size.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <select name="admin_values[design][page_layout_new]" >
              
                     <option value="" <?php if(in_array(_ppt(array('design','page_layout_new')), array(""))){ echo "selected=selected"; }  ?>><?php echo __("Fluid Layout","premiumpress"); ?></option>
              
                <option value="5" <?php if(in_array(_ppt(array('design','page_layout_new')), array("5"))){ echo "selected=selected"; }  ?>><?php echo __("Boxed Layout","premiumpress"); ?></option>
                
                
           
              </select>
            </div>
          </div>
          
           
          
          
           <div class="row border-bottom  pb-3 pt-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("jQuery in Footer","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn ON to load jQuery in the footer. This might cause issues with plugins.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('jqueryFooter').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('jqueryFooter').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','jqueryFooter')), array("1"))){  ?>on<?php } ?>">
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
              <input type="hidden" id="jqueryFooter" name="admin_values[design][jqueryFooter]" value="<?php if(in_array(_ppt(array('design','jqueryFooter')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>
          
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              <label class="font-weight-bold mb-2"><?php echo __("Preloader Style","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Set the pre-loader style you want.","premiumpress"); ?></p>
              
               <p class="text-muted"><?php echo __("A great website for lots of free preloaders is icons8.com","premiumpress"); ?></p>
              
              <a href="https://icons8.com/preloaders" target="_blank" class="btn btn-dark btn-sm">Visit Website</a>
              
            </div>
            <div class="col-md-8 mt-3 formrow">
             
             <div class="container">
             <div class="row">
<?php

$preimg = _ppt(array('design','preloader-image'));

$preloaders = array(

	1 => "loading.svg",
	2 => "loading2.svg",
	3 => "loading3.svg",
	
	

);

if($preimg == ""){ $preimg =1; }

foreach($preloaders as $k => $img){?>
                <div class="col-4 text-center">
                  <figure> <img data-src="<?php echo  CDN_PATH."images/".$img; ?>" alt="img" class="lazy img-fluid" <?php if( $preimg == $img){ ?>style="border:3px solid red;"<?php } ?>> </figure>
                  <input type="radio"  value="<?php echo $img; ?>" name="admin_values[design][preloader-image]" <?php if( $preimg == $img){ echo "checked=checked"; } ?> >
                </div>
                <?php } ?>
                 </div> </div>
                
                
                
               <div class="divider-or"><span><?php echo __("or","premiumpress"); ?></span></div>
                
                <div>
                <label><?php echo __("Enter Custom URL","premiumpress"); ?></label>
                <input type="text" name="admin_values[design][preloader-url]" value="<?php echo _ppt(array('design','preloader-url')); ?>" class="form-control" placeholder="https://" />
                
                </div>
                
                
             
             
             
            </div>
          </div>         
          
          
          
          
          
          
          
          
          
          <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php

/*
 
 global $settings;

  $settings = array(
  "title" => __("Blog Page","premiumpress"), 
  "desc" => __("Extra options for your blog page.","premiumpress"),
  
  //"video" => "https://www.youtube.com/watch?v=y8wH_LyLbeM",
  
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?> 



<div class="card card-admin"><div class="card-body">
 

<?php 


global $CORE_UI, $CORE;

$RTL = 0;
if($CORE->GEO("is_right_to_left", array() )){ 
$RTL = 1;
}	

foreach($CORE_UI->styles as $k => $v){

$canContinue = 1;
if(!empty($v['globals'])){
	$canContinue = 0;
	foreach($v['globals'] as $r){ 
		if(isset($GLOBALS[$r]) && in_array($RTL,$v['rtl']) ){
			$canContinue = 1;
		}
	}
}
if(!$canContinue){ continue; }

 ?>
 
           <div class="row border-bottom  pb-3 pt-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo $v['path']; ?></label>
              <p class="text-muted"><?php echo __("Disable the theme from loading this style.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('jqueryFooter').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('jqueryFooter').value='1'">
                </label>
                <div class="toggle <?php  if(in_array(_ppt(array('design','jqueryFooter')), array("1"))){  ?>on<?php } ?>">
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
              <input type="hidden" id="jqueryFooter" name="admin_values[design][jqueryFooter]" value="<?php if(in_array(_ppt(array('design','jqueryFooter')), array("1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div> 


<?php } ?> 



<div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    	</div>

   
        </div></div>
        
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); 


*/  ?>


<?php
 
 global $settings;

  $settings = array(
  "title" => __("Blog Page","premiumpress"), 
  "desc" => __("Extra options for your blog page.","premiumpress"),
  
  //"video" => "https://www.youtube.com/watch?v=y8wH_LyLbeM",
  
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?> 
        
		<div class="card card-admin"><div class="card-body">

    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-9">
          <label><?php echo __("Social Sharing","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the social media sharing buttons.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('blog_share').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('blog_share').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'blog_share')), array("","1"))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="blog_share" name="admin_values[design][blog_share]" value="<?php if(in_array(_ppt(array('design', 'blog_share')), array("","1"))){  echo 1; }else{ echo 0; }  ?>">
        </div>
      </div>
    </div> 

<div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    	</div>

   
        </div></div>
        
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>