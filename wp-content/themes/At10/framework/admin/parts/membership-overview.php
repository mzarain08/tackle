<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Membership Settings","premiumpress"), 
  "desc" =>  __("Set default membership and pricing plans for your website.","premiumpress"),
  
  "doclink" => "https://www.premiumpress.com/doc/memberships/",
  
  
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

 




<style>
#overview-box, #p-box {
	display:none;
}
</style>

<div class="card p-3">



       
            <div class="container topshowpaks border-bottom">
  <div class="row py-2">
            <div class="col-md-8 ">
              <div class="text-600 mb-2"><?php echo __("Enable Memberships","premiumpress"); ?></div>
              <p class="text-muted"><?php echo __("Turn on/off the built-in membership system.","premiumpress"); ?></p>
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
        <div class="toggle <?php if(_ppt(array('mem','enable'))  == '1'){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="enable_memberships"  name="admin_values[mem][enable]" value="<?php if(_ppt(array('mem','enable')) == ""){ echo 0; }else{ echo _ppt(array('mem','enable')); } ?>">
            </div>
          </div> 
          

 </div> 



 <?php _ppt_template('framework/admin/parts/membership-packages' ); ?>


 
</div>

 
<div class="card p-3" id="overlistwrap">

<div id="overviewlist"></div>   
 
</div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 