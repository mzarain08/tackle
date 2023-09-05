<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $wpdb, $CORE, $settings;
   
   // COUNT CATEGOEIES FOR TURNING OFF OPTIONS
   $cats = get_terms( 'listing', array( 'hide_empty' => 0 )); 
   
 
  $settings = array(
  
  "title" => __("Global Settings","premiumpress"), 
  
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("These global %s settings apply to the entire website.","premiumpress") ) ,
  
  //"video" => "https://www.youtube.com/watch?v=RDx63RYwS38",
  
  "back" => "overview",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
   
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
?>

<div class="card card-admin">
  <div class="card-body">
  
  
  
     <div class="row border-bottom pb-3 mb-3">
      <div class="col-md-8 ">
        <label class="font-weight-bold mb-2"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"), __("Enable %s","premiumpress") ); ?></label>
        <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Allow %s to be added to my website.","premiumpress") ); ?></p>
      </div>
      <div class="col-md-2 mt-3 formrow">
        <div class="">
          <label class="radio off">
          <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('websitepackages').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('websitepackages').value='1'">
          </label>
          <div class="toggle <?php if( _ppt(array('lst','websitepackages')) == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
          </div>
        </div>
        <input type="hidden" id="websitepackages" name="admin_values[lst][websitepackages]" value="<?php echo _ppt(array('lst','websitepackages')); ?>">
      </div>
    </div>
        
        
        
     <div class="row border-bottom pb-3 mb-3">
      <div class="col-md-8 ">
        <label class="font-weight-bold mb-2"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"), __("Display %s Packages","premiumpress") ); ?></label>
        <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Allow users to select from free or paid packages.","premiumpress") ); ?></p>
      </div>
      <div class="col-md-2 mt-3 formrow">
        <div class="">
          <label class="radio off">
          <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('displaypricing').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('displaypricing').value='1'">
          </label>
          <div class="toggle <?php if( _ppt(array('lst','displaypricing')) == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
          </div>
        </div>
        <input type="hidden" id="displaypricing" name="admin_values[lst][displaypricing]" value="<?php if(_ppt(array('lst','displaypricing')) == ""){ echo 1; }else{ echo _ppt(array('lst','displaypricing')); } ?>">
      </div>
    </div>
  
  
  
  		
       <div class="container px-0 border-bottom mb-3"> 
      <div class="row " <?php if( _ppt(array('lst','adminonly')) == '1'){  ?>style="border: 5px solid #dc3545!important;    padding: 10px;"<?php } ?>>
      <div class="col-md-8 ">
        <label class="font-weight-bold mb-2"><?php echo __("Admin Only Mode","premiumpress"); ?></label>
        <p class="text-muted"><?php 
		
		echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Stop users from adding new %s.","premiumpress") );
		
		
		?></p>
        <?php if( _ppt(array('lst','adminonly')) == '1'){  ?>
        <p class="font-wight-bold text-danger"><i class="fa fa-check mr-2"></i> <?php echo __("Users listing have been disabled.","premiumpress"); ?></p>
        <?php } ?>
      </div>
      <div class="col-md-2 mt-3 formrow">
        <div class="">
          <label class="radio off">
          <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('adminonly').value='0'">
          </label>
          <label class="radio on">
          <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('adminonly').value='1'">
          </label>
          <div class="toggle <?php if( _ppt(array('lst','adminonly')) == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
          </div>
        </div>
        <input type="hidden" id="adminonly" name="admin_values[lst][adminonly]" value="<?php echo _ppt(array('lst','adminonly')); ?>">
      </div>
    </div>
    
    </div>
    
        

    <!-- ------------------------- -->
    <div class="container px-0 ">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Admin Approval?","premiumpress"); ?></label>
          <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Does the admin need to manually approve a new %s before it goes live?","premiumpress") );  ?></p>
        </div>
        <div class="col-md-5">
          <?php
			   $g = _ppt(array('lst', 'default_listing_status'));
			   ?>
          <select name="admin_values[lst][default_listing_status]" class="mt-2 form-control" style="width:100%">
            <option value="publish" <?php if( $g == "publish"){ echo "selected=selected"; } ?>><?php echo __("No","premiumpress"); ?></option>
            <option value="pending" <?php if( $g == "pending"){ echo "selected=selected"; } ?>><?php echo __("Yes","premiumpress"); ?></option>
          </select>
        </div>
      </div>
    </div>
    <input type="hidden" id="requiremembership" name="admin_values[lst][requiremembership]" value="0">
  
  
   
  
   
  
  
    <?php if(THEME_KEY == "so" ){ ?>
    <div class="container px-0 border-top mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Login To Download","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Force users to login before they can download products.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('requirelogin_downloads').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('requirelogin_downloads').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'requirelogin_downloads' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="requirelogin_downloads" name="admin_values[lst][requirelogin_downloads]" value="<?php echo _ppt(array('lst', 'requirelogin_downloads' )); ?>">
        </div>
      </div>
    </div> 
    
    
    <?php } ?>
    
    
   
  
      <?php if(THEME_KEY == "cp" ){ ?>
   
      <div class="container px-0 border-bottom border-top pt-3 mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Open Coupons In","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("What happens when someone clicks on a coupon/offer.","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
          <?php
			   $g = _ppt(array('lst', 'cppop'));
			   ?>
          <select name="admin_values[lst][cppop]" class="mt-2 form-control" style="width:100%">
            <option value="0" <?php if( $g  == "0"){ echo "selected=selected"; } ?>><?php echo __("New Window","premiumpress"); ?></option>
            <option value="1" <?php if( $g  == "1"){ echo "selected=selected"; } ?>><?php echo __("Listing Page","premiumpress"); ?></option>
           
          </select>
        </div>
      </div>
    </div>
    
     
    <div class="container px-0 border-bottom  pt-3 mb-3">
      <div class="row py-2">
        <div class="col-md-6 pr-lg-5">
          <label><?php echo __("Search Card Terms Area","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Choose which content to show in the terms dropdown.","premiumpress"); ?></p>
        </div>
        <div class="col-md-6">
          <?php
			   $g = _ppt(array('lst', 'cpterms'));
			   ?>
          <select name="admin_values[lst][cpterms]" class="mt-2 form-control" style="width:100%">
            <option value="0" <?php if( $g  == "0"){ echo "selected=selected"; } ?>><?php echo __("Hide Section","premiumpress"); ?></option>
            <option value="1" <?php if( $g  == "1"){ echo "selected=selected"; } ?>>post excerpt</option>
            <option value="2" <?php if( $g  == "2"){ echo "selected=selected"; } ?>>post content</option>
          </select>
        </div>
      </div>
    </div>
     
    
    <?php } ?>
    
    
    
    <?php if(in_array(THEME_KEY, array("mj")) ){ ?>
    
    
    <div class="container px-0 border-top mb-3 pt-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Show Offers Button","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the offers button on the jobs page.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('display_offerbtn').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('display_offerbtn').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_offerbtn')), array("1",""))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_offerbtn" name="admin_values[design][display_offerbtn]" value="<?php  if(in_array(_ppt(array('design', 'display_offerbtn')), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>
    
    
    <div class="container px-0 border-top mb-3 pt-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Sellers Only","premiumpress"); ?></label>
          <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Turn ON to stop non-seller accounts adding %s.","premiumpress")); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('selleronly').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('selleronly').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'selleronly')), array("1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="selleronly" name="admin_values[lst][selleronly]" value="<?php  if(in_array(_ppt(array('lst', 'selleronly')), array("1"))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>
    <?php } ?>
    
    
    <?php if(THEME_KEY == "vt" ){ ?>
    <div class="container px-0 border-top mb-3 pt-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Show Levels","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the display of video levels on your website.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('vt_levels').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('vt_levels').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'vt_levels')), array("","1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="vt_levels" name="admin_values[lst][vt_levels]" value="<?php  if(in_array(_ppt(array('lst', 'vt_levels')), array("","1"))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>
    <?php } ?>
   <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
  
  
  
  
  
  
 
 <?php 
  $settings = array(
  
  "title" => __("Add/Edit","premiumpress")." ".$CORE->LAYOUT("captions","1"), 
  
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("These settings are applied when a user creates a new %s or modifies an existing %s.","premiumpress") ) ,
  
  //"video" => "https://www.youtube.com/watch?v=JnQZK97qDqo",
   
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>



 

<div class="card card-admin">
  <div class="card-body">
 

    <?php if(THEME_KEY == "at" ){ ?>
    
    <div class="container px-0 mt-3 border-bottom mb-3">
      <div class="row py-2 ">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Bidding Increments","premiumpress"); ?> </label>
          <p class="text-muted"><?php echo __("Here you can set the default bid increment.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3 formrow">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span> </div>
            <input type="text" name="admin_values[lst][at_bidinc]" class="form-control val-numeric" value="<?php if(_ppt(array('lst', 'at_bidinc' )) == ""){ echo 1; }else{ echo _ppt(array('lst', 'at_bidinc' )); } ?>">
          </div>
        </div>
      </div>
    </div>
    

    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Disable Auction Length","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn ON to use the package length instead of allowing users to set their own auction lenght.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('auction_time').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('auction_time').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'auction_time' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="auction_time" name="admin_values[lst][auction_time]" value="<?php echo _ppt(array('lst', 'auction_time' )); ?>">
        </div>
      </div>
    </div>
 
    
    
    
    
       
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Delivery","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the delivery selection field.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('auction_delivery').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('auction_delivery').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_delivery' )), array("1",""))){   ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="auction_delivery" name="admin_values[design][display_delivery]" value="<?php if(in_array(_ppt(array('design', 'display_delivery' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>    
    
    
    
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Shipping","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the shipping price field.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('auction_shipping').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('auction_shipping').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_shipping' )), array("1",""))){   ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="auction_shipping" name="admin_values[design][display_shipping]" value="<?php if(in_array(_ppt(array('design', 'display_shipping' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>   
    
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Reserve Price","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the reserve price field.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('auction_reserve').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('auction_reserve').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_reserve' )), array("1",""))){   ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="auction_reserve" name="admin_values[design][display_reserve]" value="<?php if(in_array(_ppt(array('design', 'display_reserve' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>   
    
    
     
    

<?php } ?>

<?php if(in_array(THEME_KEY,array("at","pj")) ){ ?>
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-5">
          <label><?php echo __("Bidding Length","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Select which ones are available.","premiumpress"); ?></p>
        </div>
        <div class="col-md-7">
          <div class="row px-0">
            <?php 


$videopak = array( 
		
		"0.5" => __("30 Minutes","premiumpress"),
		"0.1" => __("1 Hour","premiumpress"),
		"1" => "1 ".__("Day","premiumpress"), 
		"3" => "3 ".__("Days","premiumpress"), 
		"5" => "5 ".__("Days","premiumpress"), 
		"7" => "7 ".__("Days","premiumpress"), 
		"14" => "14 ".__("Days","premiumpress"), 
		"21" => "21 ".__("Days","premiumpress"), 
		"30" => "30 ".__("Days","premiumpress"),
		"60" => "60 ".__("Days","premiumpress"),
		"90" => "90 ".__("Days","premiumpress"),
		"120" => "120 ".__("Days","premiumpress"),
		"150" => "150 ".__("Days","premiumpress"),
		"180" => "180 ".__("Days","premiumpress"),
		
		
);

foreach($videopak as $k => $f ){ ?>
            <div class="col-md-4">
              <label class="custom-control custom-checkbox">
              <input type="checkbox" 
        value="1" 
       
        class="custom-control-input" 
        id="auctiontime_<?php echo str_replace(".","",$k); ?>check" 
        onchange="ChekAtime('#auctiontime_<?php echo str_replace(".","",$k); ?>');"
         
		<?php if(_ppt("auctiontime_".str_replace(".","",$k)) == 1){ ?>checked=checked<?php } ?>>
              <input type="hidden" name="admin_values[auctiontime_<?php echo str_replace(".","",$k); ?>]" id="auctiontime_<?php echo str_replace(".","",$k); ?>add" value="<?php if(in_array(_ppt("auctiontime_".str_replace(".","",$k)) , array("","1")) ){ echo 1; }else{ echo 0; } ?>">
              <span class="custom-control-label"><?php echo $f; ?></span> </label>
            </div>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
    <script>
		function ChekAtime(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
    <?php } ?>
    
     <?php if(in_array(THEME_KEY, array("at")) ){ ?>
     
     
       <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Automated Bidding","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the automated bidding option.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
       
          <div class="mt-2 formrow">
            <label class="radio off">
           
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('at_autobid').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('at_autobid').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'at_autobid' )), array("1",""))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="at_autobid" name="admin_values[lst][at_autobid]" value="<?php if(in_array(_ppt(array('lst', 'at_autobid' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
      
      </div></div></div>
     
     
     <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Buy Now Only","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off the option for users to list a buy now auction.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
       
          <div class="mt-2 formrow">
            <label class="radio off">
           
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('at_buynow').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('at_buynow').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'at_buynow' )), array("1",""))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="at_buynow" name="admin_values[lst][at_buynow]" value="<?php if(in_array(_ppt(array('lst', 'at_buynow' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
      
      </div></div></div>
     
     
     <?php } ?>

    <?php if(in_array(THEME_KEY, array("ct","dl")) ){ ?>
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Listing Types","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("By default both buy now and offers are enabled.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
         <label><?php echo __("Buy Now Only","premiumpress"); ?></label>
          <div class="mt-2 formrow">
            <label class="radio off">
           
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('ct_buynow').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('ct_buynow').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'ct_buynow' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="ct_buynow" name="admin_values[lst][ct_buynow]" value="<?php if(in_array(_ppt(array('lst', 'ct_buynow' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
      
        
          <label class="mt-4"><?php echo __("Make Offer Only","premiumpress"); ?></label>
          <div class="mt-2 formrow">
            <label class="radio off">
           
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('ct_buynow_offer').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('ct_buynow_offer').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'ct_buynow_offer' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="ct_buynow_offer" name="admin_values[lst][ct_buynow_offer]" value="<?php if(in_array(_ppt(array('lst', 'ct_buynow_offer' )), array("1",""))){ echo 1; }else{ echo 0; } ?>">
         
          </div>
        
      </div>
    </div>
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Disable Delivery Option","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn OFF the delivery option when add/editing a listing.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('ct_delivery').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('ct_delivery').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'ct_delivery' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="ct_delivery" name="admin_values[lst][ct_delivery]" value="<?php echo _ppt(array('lst', 'ct_delivery' )); ?>">
        </div>
      </div>
    </div>
    <?php } ?>


    

    
    
    
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Max. Title Length","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("The maximum character length for the title.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text">#</span> </div>
            <input type="text" name="admin_values[lst][titlemax]" class="form-control" value="<?php if(_ppt(array('lst', 'titlemax' )) == ""){ echo 150; }else{ echo _ppt(array('lst', 'titlemax' )); } ?>">
          </div>
        </div>
      </div>
    </div>
        
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Min. Description Length","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("The minimum amount of characters for the description.","premiumpress"); ?></p>
        </div>
        <div class="col-md-3">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text">#</span> </div>
            <input type="text" name="admin_values[lst][descmin]" class="form-control" value="<?php if(_ppt(array('lst', 'descmin' )) == ""){ echo 100; }else{ echo _ppt(array('lst', 'descmin' )); } ?>">
          </div>
        </div>
      </div>
    </div>
    
 <?php if( in_array(THEME_KEY, array("da","es"))   ){ ?>

    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Show Age Fields","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn off to hide age display from the website.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div  class="mt-3 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('da_age').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('da_age').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'da_age')),array("","1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="da_age" name="admin_values[lst][da_age]" value="<?php if(in_array(_ppt(array('lst', 'da_age')),array("","1"))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>

<?php } ?>
   
<?php if( in_array(THEME_KEY, array("da","ex","es","ll"))   ){ ?>

    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3 ">
      <div class="row py-2">
        <div class="col-md-8">
          <label><?php echo __("Require Excerpt (Describe Yourself)","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on to force users to add a short description.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div  class="mt-3 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('require_except').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('require_except').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'require_except' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="require_except" name="admin_values[lst][require_except]" value="<?php if(_ppt(array('lst', 'require_except')) == ""){ echo 0; }else{ echo _ppt(array('lst', 'require_except')); } ?>">
        </div>
      </div>
    </div>

<?php } ?>
<?php if($CORE->LAYOUT("captions","maps") ){ ?>

          <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Location Box","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off to hide the display of the map location box.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_location').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_location').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'default_location')), array("","1"))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="default_location" name="admin_values[lst][default_location]" value="<?php if(in_array(_ppt(array('lst', 'default_location')), array("","1"))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>
    <?php } ?>

<?php

// GET CATS

if(!empty($cats) && count($cats) > 1){ 

?>        <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Category Changes","premiumpress"); ?></label>
          <p class="text-muted"><?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Turn OFF to prevent users from changing the category after creating a %s.","premiumpress")); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_catsedits').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_catsedits').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('lst', 'default_catsedits' )), array("","1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="default_catsedits" name="admin_values[lst][default_catsedits]" value="<?php if(in_array(_ppt(array('lst', 'default_catsedits' )), array("","1")) ){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>


    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Multiple Categories","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn ON to allow users to select multiple categories.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_multiplecats').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_multiplecats').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('lst', 'default_multiplecats' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="default_multiplecats" name="admin_values[lst][default_multiplecats]" value="<?php echo _ppt(array('lst', 'default_multiplecats' )); ?>">
        </div>
      </div>
    </div>
   
<?php } ?>  
    
    
    
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


  
  
<?php

 $settings = array(
  
  "title" => __("Submission Form Images","premiumpress"), 
  "desc" => __("These are the images dislayed on the sidebar of the submission form.","premiumpress") ,
  
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
   
   $simages = array(
   
   "sform_basic" => array( "title" => "Basic Tab" ),
    
   "sform_desc" => array( "title" => "Description Tab" ),
    
   "sform_details" => array( "title" => "Details Tab" ),
   
   "sform_media" => array( "title" => "Media Tab" ),  
    
   "sform_finish" => array( "title" => "Finish Tab" ),   
   
   );
   
   
?>

<div class="card card-admin">
  <div class="card-body">
  
  
<?php foreach($simages as $k => $img){ 



$defaulttxt = _ppt(array('lst', $k."_tip"));

if($defaulttxt == "" && $k == "sform_basic" && strlen(_ppt(array('lst','default_catmsg'))) > 0){
	
	$clearme = 1;
	$defaulttxt = _ppt(array('lst','default_catmsg'));
	
} 
  

?>

    <div class="row mt-4 border-bottom pb-3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <label><?php echo $img['title']; ?></label>
    
        <p class="text-muted"><?php echo __("Recommended size","premiumpress"); ?>: 800x1200</p>
        
        <?php echo $CORE->MEDIA("customUploadForm", $k); ?> 
        
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0">
      
      <label><?php echo __("Quick Tip","premiumpress"); ?></label>
      
      <div class="small opacity-5 mb-2"><?php echo __("Enter your own custom message here.","premiumpress"); ?></div>
      
       <textarea class="form-control" name="admin_values[lst][<?php echo $k."_tip"; ?>]" style="height:200px;"><?php echo $defaulttxt; ?></textarea>
<?php if(isset($clearme)){ ?>
<input name="admin_values[lst][default_catmsg]" type="hidden" value="" />
<?php } ?>

    </div>  
      </div>
      
      <?php } ?>
      
   </div>  
      </div> 
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>

  
  
 
<?php
 
  $settings = array("title" => __("Listing Expiry","premiumpress"), "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Here you can set what happens when %s expire.","premiumpress") ) );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
  
  
  
  
<?php if( in_array(THEME_KEY, array("at"))   ){ ?>
  
  
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7 pr-lg-5">
          <label><?php echo __("Auto Relist","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off to auto relist expired auctions.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('auction_autolist').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('auction_autolist').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt('autolist'), array("1",""))){   ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="auction_autolist" name="admin_values[autolist]" value="<?php if(in_array(_ppt('autolist'), array("1",""))){ echo 1; }else{ echo 0; } ?>">
        </div>
      </div>
    </div>  
  
<?php } ?>
  
  
  
  
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Change Status?","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Should the theme update the post status?","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
          <?php
			   $g = _ppt(array('lst', 'expiryaction'));
			   ?>
          <select name="admin_values[lst][expiryaction]" class="mt-2 form-control" style="width:100%">
            <option value="-1" <?php if( $g  == "-1"){ echo "selected=selected"; } ?>><?php echo __("Do nothing","premiumpress"); ?></option>
            <option value="1" <?php if( $g  == "1"){ echo "selected=selected"; } ?>>
            <?php if(THEME_KEY == "cp"){ echo __("Set to expired","premiumpress"); }else{ echo __("Set to expired - user to repay","premiumpress"); } ?>
            </option>
           <?php /* <option value="2" <?php if( $g  == "2"){ echo "selected=selected"; } ?>><?php echo __("Delete listing","premiumpress"); ?></option>*/ ?>
          </select>
        </div>
      </div>
    </div>
    <!-- ------------------------- -->
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Change Listing Package?","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Should the theme change the listing package?","premiumpress"); ?></p>
        </div>
        <div class="col-md-5">
          <?php
			   $g = _ppt(array('lst', 'expirypackage'));
			   ?>
          <select name="admin_values[lst][expirypackage]" class="mt-2 form-control" style="width:100%">
            <option value="-1" <?php if( $g  == "-1"){ echo "selected=selected"; } ?>><?php echo __("Do nothing","premiumpress"); ?></option>
            
            <?php
			
			
				$all_packages = $CORE->PACKAGE("get_packages", array());
			 	 
				foreach($all_packages  as $key => $m){
				 	
						?>
                          <option value="<?php echo $m['key']; ?>" <?php if( $g  == $m['key']){ echo "selected=selected"; } ?>><?php echo __("Set to","premiumpress")." ".$m['name']; ?></option>
                        
                        <?php
				 
				
				} 
			
			?>
             
          </select>
        </div>
      </div>
    </div>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<script>
		function ChekME(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		 
		function changeCheckB(div){
			
			if (jQuery('#'+div+'_check').hasClass('fa-check')) {			
				jQuery('#'+div).val(0);	
				jQuery('#'+div+'_check').removeClass('fa-check text-success').addClass('fa-times text-danger');		
			}else{			
				jQuery('#'+div).val(1);	
				jQuery('#'+div+'_check').removeClass('fa-times text-danger').addClass('fa-check text-success');	
			}
					
				
		}
</script>
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
