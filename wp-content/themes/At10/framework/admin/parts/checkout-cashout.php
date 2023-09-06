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

global $CORE, $CORE_ADMIN, $settings;
 
 
 
 
  $settings = array(
  
  	"title" => __("Cahsout System","premiumpress"), 
  
  	"desc" => "",  
	
    "back" => "overview",
  
  );
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">
   
   
<?php

$g = array(
		 
		  "enable" => array(
		 
			 "name" => __("Cashout System","premiumpress"), 
			 "desc" => __("Turn on/off the cashout system. This will allow users to send you a request to withdraw money from their account.","premiumpress"), 
			 "type" => "yesno", 
			 "d" 	=> 0,
			 "col8" => true 
		 ),	
	 
		 
		 "cashout_hideform" => array(
		 
			 "name" => __("Cashout System - Hide Form","premiumpress"), 
			 "desc" => __("Turn on to hide the cashout request form but continue to use cashout features.","premiumpress"), 
			 "type" => "yesno", 
			 "d" 	=> 0,
			 "col8" => true 
		 ),
);
		 
foreach ($g as $fieldkey => $fielddata){ echo $CORE_ADMIN->LoadCongifField($fielddata, $fieldkey, "cashout"); }

?>
  
   
  
<div class="col-12 border-bottom py-3">
      <div class="row py-2">
        <div class="col-md-8">
          <label class="txt500"><?php echo __("Min Cashout Amount","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Here you can set the minimum amount users must have in credit before they can request a cashout.","premiumpress"); ?></p>
        </div>
        <div class="col-md-4">
           <div class="input-group"> <span class="input-group-prepend input-group-text"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
              <input type="text" class="form-control btn-block"  name="admin_values[cashout][min_amount]" value="<?php if(is_numeric(_ppt(array('cashout', 'min_amount')))){ echo _ppt(array('cashout', 'min_amount')); }else{ echo 0; } ?>" style="max-width:100px">
            </div>
        </div>
      </div>
  
  </div>

    
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
  </div>
</div>
 

 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>



<?php

 
 
  $settings = array(
  
  	"title" => __("Prefered Payment Method","premiumpress"), 
  
  	"desc" => __("Here you can setup default payment methods for the user to select from.","premiumpress"),  
	
    "back" => "overview",
  
  );
  
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
   
<div class="card card-admin">
  <div class="card-body">
   


<?php

$pp = array(
"","Bank Transfer", "Wire Payment","Payoneer","PayPal"
);

 $i=1; while($i < 8){ ?>
  
<div class="col-12 border-bottom py-3">
      <div class="row py-2">
        <div class="col-md-6">
          <label class="txt500"><?php echo __("Method","premiumpress"); ?> <?php echo $i; ?></label>
           
       
        </div>
        <div class="col-md-6">
             <input type="text" class="form-control"  name="admin_values[cashout][method<?php echo $i; ?>]" value="<?php echo _ppt(array('cashout', 'method'.$i));  ?>" placeholder="<?php if(isset($pp[$i])){ echo "eg. ".$pp[$i]; } ?>">
        </div>
      </div>
  
  </div>
  
<?php $i++; } ?>

    
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
    
  </div>
</div>
 

 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>




