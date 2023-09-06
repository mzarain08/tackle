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

global $CORE, $settings;
  
  $settings = array(
  
  "title" => __("Pay Wall","premiumpress"), 
  "desc" => __("Unlike memberships which allow users to choose what they want, the Pay Wall system is a fixed fee based system which blocks access to member account features until the payment is made.","premiumpress"), 
  //"back" => "overview"
  
  );
  
  
  $accountTypes = $CORE->USER("get_account_type_all", array());
  
  
   _ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
     
    
<div class="card p-3 mb-4">
            <div class="container">
  <div class="row py-2">
            <div class="col-md-8 ">
              <div class="text-600 mb-2"><?php echo __("Enable PayWall System","premiumpress"); ?></div>
              <p class="text-muted"><?php echo __("Turn on/off the built-in paywall system.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_memberships').value='0'; jQuery('#admin_save_form').submit();">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_memberships').value='1'; jQuery('#admin_save_form').submit();">
        </label>
        <div class="toggle <?php if(_ppt(array('paywall','enable'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="enable_memberships"  name="admin_values[paywall][enable]" value="<?php if(_ppt(array('paywall','enable')) == ""){ echo 0; }else{ echo _ppt(array('paywall','enable')); } ?>">
            </div>
          </div> 
          

 </div> 
    
 </div>     
    
    
    
    
    
    
    
<div class="card card-admin">
  <div class="card-body">
   
   
   
<?php 

$i = 1;
foreach($accountTypes as $k => $f ){ 

if(in_array($k,array("banned","visitor"))){ continue; }

?>
<div class="mb-4">


 
 
<div class="fs-6 text-700 mb-2"><?php echo $f['name']; ?></div>
 
<div class="fs-14"><?php echo $f['desc']; ?></div>


  <label class="custom-control custom-checkbox mt-3">
              <input type="checkbox"  value="1" 
       
        class="custom-control-input" 
        id="paywall_<?php echo $k; ?>check" 
        onchange="CheckPhotoUserType('#paywall_<?php echo $k; ?>');"
         
		<?php if( in_array(_ppt(array("paywall_".$k,'enable')), array("1")) ){ ?>checked=checked<?php } ?>>
              <input type="hidden" name="admin_values[paywall_<?php echo $k; ?>][enable]" id="paywall_<?php echo $k; ?>add"  value="<?php if(in_array(_ppt(array("paywall_".$k,'enable')), array("1"))){ echo 1; }else{ echo 0; } ?>">
              <span class="custom-control-label h6"><?php echo __("Enable","premiumpress"); ?></span> </label>



 <div class="row mt-4">
 
          <div class="col-md-4">
            <label><?php echo __("Price","premiumpress"); ?> <span class="required">*</span></label>
            <div class="input-group">
              <span class="input-group-prepend input-group-text rounded-0"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
              <input type="text" name="admin_values[paywall_<?php echo $k; ?>][price]" value="<?php echo _ppt(array("paywall_".$k,'price')); ?>" class="form-control val-numeric">
            </div>
          </div>
          
          <div class="col-md-4">
            <label class="txt500 mb-2"><?php echo __("Duration","premiumpress"); ?> (<?php echo __("days","premiumpress"); ?>)</label>
            <div class="input-group">
            
              <?php
			  
			  $dur = _ppt(array("paywall_".$k,'duration'));
			  
			  $recurring = _ppt(array("paywall_".$k,'recurring'));
			  
			  
			   if(in_array($dur, array(1,2,7,30,60,90,120,150,180,365) )){ ?>
              
              <select name="admin_values[paywall_<?php echo $k; ?>][duration]" class="form-control">
                <option value="1" <?php if($dur == "1"){ echo 'selected=selected'; } ?>>24
                hours</option>
                <option value="2" <?php if($dur == "2"){ echo 'selected=selected'; } ?>>48
                hours</option>
                <option value="7" <?php if($dur == "7"){ echo 'selected=selected'; } ?>>1
                Week</option>
                <option value="30" <?php if($dur == "30"){ echo 'selected=selected'; } ?>>1
                Month</option>
                <option value="60" <?php if($dur == "60"){ echo 'selected=selected'; } ?>>2
                Months</option>
                <option value="90" <?php if($dur == "90"){ echo 'selected=selected'; } ?>>3
                Months</option>
                <option value="120" <?php if($dur == "120"){ echo 'selected=selected'; } ?>>4
                Months</option>
                <option value="150" <?php if($dur == "150"){ echo 'selected=selected'; } ?>>5
                Months</option>
                <option value="180" <?php if($dur == "180"){ echo 'selected=selected'; } ?>>6
                Months</option>
                <option value="365" <?php if($dur == "365"){ echo 'selected=selected'; } ?>>1
                Year</option>
                <option value="99">Custom Duration</option>
              </select>
              <?php }else{ ?>
              <input type="text" name="admin_values[paywall_<?php echo $k; ?>][duration]"   class="form-control" value="<?php if($dur == ""){ echo "30"; }else{ echo $dur; } ?>">
              <?php } ?>
            </div>
            <small>0 = <?php echo __("unlimited","premiumpress"); ?></small>
          </div>
          
          <div class="col-md-4">
            <label><?php echo __("Recurring Payment","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_r').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_r').value='1'">
              </label>
              <div class="toggle <?php if( $recurring  == '1'){  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_r" name="admin_values[paywall_<?php echo $k; ?>][recurring]" value="<?php echo $recurring; ?>">
          </div>
        </div> 

 
               

</div>

<hr />

<?php $i++; } ?> 





   
   
   
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
    <script>
		function CheckPhotoUserType(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		</script>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>