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
 
 
global $settings, $CORE_ADMIN, $CORE, $CORE_UI;

$accountTypes = $CORE->USER("get_account_type_all", array());
  
  $settings = array(
  
  "title" => __("User Account Types","premiumpress"), 
  "desc" => __("User types are automatically assigned and updated based on the users interaction with your website unless set manually by the admin.","premiumpress"),


	"back" => "overview",
 
  
  );
   
   
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
  
  
   
   
<div class="p-3" ppt-border1>
  <div>
  
 
<?php /*
 
   <div class="container px-0 mb-3 mt-4">
  <div class="row py-2">
    <div class="col-md-9">
      <div class="text-600 mb-2"><?php echo __("Show on registration form","premiumpress"); ?></div>
      <p class="text-muted fs-sm"><?php echo __("Allow users to select their account type during registration.","premiumpress"); ?></p> 
       
    </div>
    <div class="col-md-3">
      <div  class="mt-3 formrow">
        <label class="radio off">
        <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('showaccounttype').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('showaccounttype').value='1'">
        </label>
        <div class="toggle <?php if(_ppt(array("user","showaccounttype")) == 1){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="showaccounttype" name="admin_values[user][showaccounttype]" value="<?php if(_ppt(array("user","showaccounttype")) == 1){ echo 1; }else{ echo 0; } ?>">
      
      
    </div>
  </div>
</div>

*/ ?>
 <input type="hidden" id="showaccounttype" name="admin_values[user][showaccounttype]" value="0">

<?php 

 

foreach($accountTypes as $k => $f ){ ?>

<div class="ppt-accordion" style="cursor:pointer;"> 
<div class="d-flex flex-row border-top p-3 py-lg-4">
  <div class="w-100" ppt-flex-between>
    <div class="w-100 btn-show">
      <div class="fs-6 text-600 ">
  <?php echo $f['name']; ?>
      </div>
    </div>
    <div ppt-icon-32 class="hide-show btn-show">
      <?php echo $CORE_UI->icons_svg['add']; ?>
    </div>
     <div ppt-icon-32 class="show-hide btn-show">
      <?php echo $CORE_UI->icons_svg['close']; ?>
    </div>
  </div>
</div>


<div class="hide border-top p-3"> 

 

<div class="mb-3 ppt-forms style3">

<div class="d-flex">

 

    <div class="w-100">
    
    <div class="position-relative">
        <input type="text" class="form-control" placeholder="<?php echo $f['name']; ?>" name="admin_values[usertype][<?php echo $k."_name"; ?>]" value="<?php echo _ppt(array("usertype",$k."_name" )); ?>" />
        
        <div class="position-absolute" style="top:10px; right:10px;"><span class="badge badge-primary"><?php echo $k; ?></span></div>
        
        </div>
        
        <div class="smal mt-2 opacity-5 mt-3"><?php echo $f['desc']; ?></div>       


<?php if(!in_array($k,array("banned"))){ ?>
<hr />

<div class="small mb-2 opacity-5 text-700"><?php echo __("User Privileges","premiumpress"); ?></div>
 
<div class="row"> 
<?php 

$titles = array(

"single" 	=> __("Can create Ads","premiumpress"),
"multiple"	 => __("Multiple Ads","premiumpress"),
"sellspace"	 => __("Buy Advertising","premiumpress"),
"view_ads"	 => __("View Ad Pages","premiumpress"),

//"view_search"	 => __("View Search Pages","premiumpress"),
//"contact"	 => __("View Search Pages","premiumpress"),


);

foreach($f['privileges'] as $kk => $vv){ 

	$val = _ppt(array("usertype",$k."_".$kk ));
	if($val == ""){
	$val = $vv;
	}
	 

?>
<div class="col-md-6">


<label class="custom-control custom-checkbox mr-4">

<input type="checkbox"   value="1"  class="custom-control-input" id="usertype_<?php echo $k."_".$kk; ?>check"  onchange="CheckUserype('<?php echo $k."_".$kk; ?>');" <?php if( $val == "1" ){ ?>checked=checked<?php } ?>>

<input type="hidden" name="admin_values[usertype][<?php echo $k."_".$kk; ?>]" id="usertype_<?php echo $k."_".$kk; ?>add" value="<?php echo $val; ?>">

<span class="custom-control-label"><?php echo $titles[$kk]; ?></span> 

</label> 

 
</div>
<?php } ?>

</div>
 <?php } ?>

</div> 

</div>

</div></div>



</div>

<?php  } ?>    

<script>
function CheckUserype(div){
	if (jQuery('#usertype_'+div+'check').is(':checked')) {			
		jQuery('#usertype_'+div+'add').val(1);			
	}else{			
		jQuery('#usertype_'+div+'add').val(0);
	}		
}
</script>

 
  
  </div>

      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div> 
 
</div>
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>