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

global $CORE, $userdata;


if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } $core_admin_values = get_option("core_admin_values");
 function MakeField($type, $name, $value, $list="", $default=""){
if($value ==""){ $value = $default; }
	switch($type){	
		case "checkbox": { return  "<input type='checkbox' class='checkbox' name='".$name."' value='".$value."'> "; } break;	
		case "text": { return  "<input type='text' name='adminArray[".$name."]' value='".$value."' class='form-control'>"; } break;
		case "textarea": { return "<textarea name='adminArray[".$name."]' type='text' class='form-control'>".stripslashes($value)."</textarea>"; } break;
		case "listbox": { 
			$r ="<select name='adminArray[".$name."]' class='form-control'>";
			foreach($list as $key => $val){
				if($value==$key){ $sel="selected"; }else{ $sel=""; }
				$r .="<option value='".$key."' ".$sel.">".$val."</option>";
			}
			$r .="</select>";
			return $r;
		} break;
	}
}


?>


<a href="https://www.premiumpress.com/plugins/?license=<?php echo get_option('ppt_license_key'); ?>" target="_blank" class="float-right btn-system btn"><?php echo __("Find More Plugins","premiumpress"); ?></a>
 
<h4><?php echo __("Installed Gateways","premiumpress"); ?></h4>  
<hr />


<div id="ajax-payment-form"></div>
 
<div id="accordion" class="clearfix">                 
<?php 
 
$gatways = hook_payments_gateways($GLOBALS['core_gateways']);

$i=1;$p=1; if(is_array($gatways)){foreach($gatways as $Value){ ?>

   
    <div class="border shadow-sm" id="heading<?php echo $i; ?>" style="cursor:pointer;">
           <a class="p-3 py-4 btn-block"  data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
     
      
      <div class="float-right" style="margin-top:-10px;">
      
      <div class="border">
      
<?php if(strpos($Value['logo'], "http") === false){ ?>
<img src="<?php echo DEMO_IMG_PATH; ?>gateways/<?php echo $Value['logo'] ?>"  style="max-width:100px; max-height:80px;">
<?php }else{ ?>
<img src="<?php echo $Value['logo'] ?>"  class="merchantlogo " style="max-width:100px; max-height:80px;">
<?php } ?>
    </div>
      
      </div>
      
 
           <h6 class="mb-0"><?php echo $Value['name'] ?> <?php if(get_option($Value['function']) == 'yes'){ ?><span class="badge badge-success txt300"><?php echo __("Enabled","premiumpress"); ?></span> <?php } ?></h6>  
      
      </a>
    </div>
    <div id="collapse<?php echo $i; ?>" class=" collapse border" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
     

<div class="container">
   <div class="row border-bottom bg-dark text-white" style="border-top:0px;">
      <div class="col-8 pt-4">
         <label class="txt500 text-white"> <?php echo __("Enable Gateway","premiumpress"); ?> </label>
         <p class="py-2 text-white"><?php echo __("Turn on/off the display of this gateway.","premiumpress"); ?></p>
      </div>
      <div class="col-4 pt-4">
         <label class="radio off">
         <input type="radio" name="toggle" 
            value="no" onchange="document.getElementById('<?php echo $Value['function']; ?>_on').value='no'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="yes" onchange="document.getElementById('<?php echo $Value['function']; ?>_on').value='yes'">
         </label>
         <div class="toggle <?php if(get_option($Value['function']) == 'yes'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="<?php echo $Value['function']; ?>_on" name="adminArray[<?php echo $Value['function']; ?>]" value="<?php echo get_option($Value['function']); ?>">
   </div>
</div>

<div class="p-4">

 
<div class="row mt-2">
   <?php foreach($Value['fields'] as $key => $field){ 
      if(!isset($field['list'])){ $field['list'] = ""; }
      if(!isset($field['default'])){ $field['default'] =""; }
      
      if($Value['function'] == $field['fieldname']){ continue; }
      
      ?>
   <div class="col-md-6 form-group py-2">
      <label class="txt500"><?php echo $field['name'] ?></label>   
      <?php echo MakeField($field['type'], $field['fieldname'],get_option($field['fieldname']),$field['list'], $field['default']) ?>
   </div>
   <?php } ?>
   <?php /*
   <hr />
   <div class="col-md-12">
      <div class="form-group">
         <label class="txt500">Display Text</label>
         <textarea name="adminArray[<?php echo $Value['function']; ?>_desc]" class="form-control" style="min-height:200px;"><?php  echo stripslashes(get_option($Value['function'].'_desc'));  ?></textarea>
      </div>
   </div>
 */ ?>
</div>
<?php if(isset($Value['notes']) && strlen($Value['notes']) > 1){ ?>

<div class="padding1 text-center mb-3">
   <?php echo $Value['notes']; ?>
</div>
<?php } ?> 
     
     
      </div>
 </div>    
 <?php $i++; } }  ?>  
 
</div>

<hr />

<div class="row">

        <div class="col-md-4">
                    <label><?php echo __("Demo Test Mode","premiumpress"); ?></label>
                    <div class="formrow mt-2">
                      <label class="radio off">
                      <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('demopay').value='0'">
                      </label>
                      <label class="radio on">
                      <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('demopay').value='1'">
                      </label>
                      <div class="toggle <?php if( in_array(_ppt('demopay'), array("","1") )){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                      </div>
                    </div>
                    <input type="hidden" id="demopay" name="admin_values[demopay]" value="<?php if( in_array(_ppt('demopay'), array("","1")) ){ echo 1; }else{ echo 0; } ?>">
                  </div>

<div class="col-md-8">

<p class="mt-3"><?php echo __("The demo test mode helps you test the payment sytem without having to use real money. It is only visible to the admin but if you want to hide it completely turn it off here.","premiumpress"); ?></p>

</div>

</div> 

<?php if(is_array($gatways)){ ?>
<div class="bg-light p-4 mt-3 mb-5">

<p><i class="fa fa-shopping-cart"></i> <strong><?php echo __("Payment Test","premiumpress"); ?></strong> </p>

<p><?php echo __("Make a test payment using your current settings.","premiumpress"); ?></p>
 
<button type="button" class="btn btn-sm btn-outline-dark" onclick="processNewPayment('<?php 
   
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
	
   	"amount" => 1, 
	
   	"order_id" => "TEST-".rand(),
   	 
   	"description" => "Admin Payment Test",
   	
   	"recurring" => 0,
	
	"nocoupons" => 1,
    
   								
   ) ); 
    		
   ?>');">Pay $1 Now</button>
 
<button type="button" class="btn btn-sm btn-outline-dark" onclick="processNewPayment('<?php 
   
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
	
   	"amount" => 5.99, 
	
   	"order_id" => "TEST-".rand(),
   	 
   	"description" => "Admin Payment Test",
   	
   	"recurring" => 0,
	
	"nocoupons" => 1,
    
   								
   ) ); 
    		
   ?>');">Pay $5.99 Now</button>
 
 
<button type="button" class="btn btn-sm btn-outline-dark" onclick="processNewPayment('<?php 
   
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
	
   	"amount" => 10.99, 
	
   	"order_id" => "TEST-".rand(),
   	 
   	"description" => "Admin Payment Test",
   	
   	"recurring" => 0,
	
	"nocoupons" => 1,
    
   								
   ) ); 
    		
   ?>');">Pay $10.99 Now</button>



<button type="button" class="btn btn-sm btn-outline-dark" onclick="processNewPayment('<?php 
   
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
	
   	"amount" => 101, 
	
   	"order_id" => "TEST-".rand(),
   	 
   	"description" => "Admin Payment Test",
   	
   	"recurring" => 0,
	
	"nocoupons" => 1,
    
   								
   ) ); 
    		
   ?>');">Pay $101 Now</button>
   
   
   
   
   
<button type="button" class="btn btn-sm btn-outline-dark " onclick="processNewPayment('<?php 
   
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
	
   	"amount" => 10, 
	
   	"order_id" => "TEST-".rand(),
   	 
   	"description" => "Admin Payment Test",
   	
   	"recurring" => 1,
	"recurring_days" => 30,
	
	"nocoupons" => 1,
    
   								
   ) ); 
    		
   ?>');">Pay $10 - recurring</button>
 
 
   
   
   
 
</div>

 
 

<?php } ?> 
