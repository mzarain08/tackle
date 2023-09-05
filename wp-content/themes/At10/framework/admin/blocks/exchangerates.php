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

global $CORE_ADMIN, $settings, $CORE;
 
?>
<div class="row">  
<div class="col-md-6">

<div class="tiny mb-2">example</div>

<div class="<?php echo $CORE->GEO("price_formatting",array()); ?> h2" id="displaycuc"><?php if(isset($_GET['amount'])){ echo $_GET['amount']; }else{ echo "5000.99"; } ?></div> 


<input type="text" class="form-control val-numeric" id="testcurr" name="testcurr" class="val-currecy" value="<?php if(isset($_GET['amount'])){ echo $_GET['amount']; }else{ echo "5000.99"; } ?>" />

<script>

jQuery(document).ready(function(){ 

	 
  
  jQuery('input[name=testcurr]').on("keyup change", function(e) {
  
  	console.log();
	
	jQuery("#displaycuc").html(jQuery("#testcurr").val()).removeClass('free');
	
	UpdatePrices();
	
	
  });
  
});


</script>

</div> 
<div class="col-md-6">
  <div class="row">
  
     <div class="col-4">
      
            <label class="w-100"> Symbol </label> 
      
        <input type="text" name="admin_values[currency][symbol]" value="<?php  echo _ppt(array('currency','symbol')); ?>" class="form-control" placeholder="$" style="font-size: 30px;    height: 40px;    line-height: 10px; text-align:center;">
     
          </div>

          
      <div class="col-4">
      
            <label class="w-100"> Thousands </label> 
      
        <input type="text" name="admin_values[currency][tho]" value="<?php echo _ppt(array('currency','tho')); ?>" class="form-control" placeholder="," maxlength="1" style="font-size: 60px;    height: 40px;    line-height: 10px;">
     
          </div>
          
  
        <div class="col-4">
        
            <label class="w-100"> Decimal  </label> 
     
        <input type="text" name="admin_values[currency][dec]" value="<?php echo _ppt(array('currency','dec')); ?>" class="form-control" placeholder="." maxlength="1" style="font-size: 60px;    height: 40px;    line-height: 10px;">
    
          </div>
          
          
  </div>
  
</div>  
</div> 
 <hr />
 


   
  
  <label class="mb-4"><span><?php echo __("Currency Exchange Rates","premiumpress"); ?></span></label>
     
    
    <?php 
	
    $df = array();
	$df['symbol1'] = "&pound;";
	$df['code1'] = "GBP";
	$df['rate1'] = "1.6799";
	
	$df['tho1'] = ",";
	$df['dec1'] = ".";	
	
	$df['symbol2'] = "&euro;";
	$df['code2'] = "EUR";
	$df['rate2'] = "1.3849";
	$df['tho2'] = ".";
	$df['dec2'] = ","; 
	
	$df['symbol3'] = "C$";
	$df['code3'] = "CAD";
	$df['rate3'] = "0.9175";
	$df['tho3'] = ",";
	$df['dec3'] = ".";	

	$df['symbol4'] = "$";
	$df['code4'] = "AUD";
	$df['rate4'] = "0.9371";
	$df['tho4'] = ",";
	$df['dec4'] = ".";	

	$df['symbol5'] = "&yen;";
	$df['code5'] = "JPY";
	$df['rate5'] = "0.0098";
	$df['tho5'] = ",";
	$df['dec5'] = ".";	

			
	$df['symbol6'] = "fal fa-rupee-sign";
	$df['code6'] = "INR";
	$df['rate6'] = "1";	
	$df['tho6'] = ",";
	$df['dec6'] = ".";	 

	$df['symbol7'] = "fal fa-ruble-sign";
	$df['code7'] = "RUB";
	$df['rate7'] = "0.013"; 
	$df['tho7'] = ",";
	$df['dec7'] = ".";	 
	 
	$df['symbol8'] = "fal fa-lira-sign";
	$df['code8'] = "TRY";
	$df['rate8'] = "0.014";
	$df['tho8'] = ",";
	$df['dec8'] = ".";	

	$df['symbol9'] = "&#8359;";
	$df['code9'] = "PTS";
	$df['rate9'] = "1141.78";
	$df['tho9'] = ",";
	$df['dec9'] = ".";	 
	
	$df['symbol10'] = "fab fa-bitcoin";
	$df['code10'] = "BTC";
	$df['rate10'] = "11,481.50";
	$df['tho10'] = ",";
	$df['dec10'] = ".";	

	
	
 	$i=1; while($i < 11){ ?>
    
	<div class="row mb-2 position-relative" id="crow<?php echo $i; ?>">
    
    <div class="col-md-2">
     
        <label class="w-100"><?php echo __("Symbol","premiumpress"); ?></label>
        <div >
            <input type="text" name="admin_values[cc][symbol<?php echo $i; ?>]" class="form-control stopclean  btn-block" value="<?php if(_ppt(array('cc','symbol'.$i)) == ""){ echo $df['symbol'.$i]; }else{ echo trim(_ppt(array('cc','symbol'.$i))); } ?>">
        </div>
        
    </div>
    
    <div class="col-md-2">
        
        <label for="normal-field"><?php echo __("Code","premiumpress"); ?></label>
        <div >
            <input type="text" name="admin_values[cc][code<?php echo $i; ?>]" class="form-control stopclean  btn-block" value="<?php if(_ppt(array('cc','code'.$i)) == ""){ echo $df['code'.$i]; }else{ echo trim(_ppt(array('cc','code'.$i))); } ?>">
        </div>
     
    </div> 
    
    
      <div class="col-2">
      
            <label class="w-100"> Thousands </label> 
      
        <input type="text" name="admin_values[cc][tho<?php echo $i; ?>]" value="<?php if(_ppt(array('cc','tho'.$i)) == ""){ echo $df['tho'.$i]; }else{ echo _ppt(array('cc','tho'.$i)); } ?>" class="form-control" placeholder="," maxlength="1">
     
          </div>
          
  
        <div class="col-2">
        
            <label class="w-100"> Decimal  </label> 
     
        <input type="text" name="admin_values[cc][dec<?php echo $i; ?>]" value="<?php if(_ppt(array('cc','dec'.$i)) == ""){ echo $df['dec'.$i]; }else{ echo _ppt(array('cc','dec'.$i)); } ?>" class="form-control" placeholder="." maxlength="1" >
    
          </div>
    
    <div class="col-md-4">
    
        <label class="small text-uppercase txt500" for="normal-field"><?php echo __("Exchange Rate","premiumpress"); ?></label>
        <div >
            <input type="text" name="admin_values[cc][rate<?php echo $i; ?>]" class="form-control stopclean  btn-block" value="<?php if(_ppt(array('cc','rate'.$i)) == ""){ echo $df['rate'.$i]; }else{ echo trim(_ppt(array('cc','rate'.$i))); } ?>">
        </div>
      
    </div>  
    <?php if(_ppt(array('cc','symbol'.$i)) != " "){ ?>
     <div class="position-absolute" style="bottom: 10px; font-size:12px; right:30px; cursor:pointer; color:red; z-index:100" onclick="jQuery('#crow<?php echo $i; ?> input').val('&nbsp;');"><i class="fa fa-times"></i> </div>   
      <?php } ?>
    </div> 
    
    
    <?php $i++; } ?>
 
 
 
<div class="bg-light p-4 mt-3">

<p><?php echo __("Please remember the base currency rate is always set to 1 therefore you should ensure your rates below reflect the price against your base currency.","premiumpress"); ?></p>

<p><?php echo __("For example, if your base currency is GBP. Then the USD rate would be compared against the GBP. Check the latest rates here:","premiumpress"); ?> <a href="https://finance.yahoo.com/currency-converter/#from=GBP;to=USD;amt=1" target="_blank" style="text-decoration:underline;">here</a></p>
   
</div>
      