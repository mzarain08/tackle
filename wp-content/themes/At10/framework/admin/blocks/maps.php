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

global $settings;

  $settings = array(
  
  "title" => __("Map Providers","premiumpress"), 
  "desc" => __("Here you can choose which map provider you want to use.","premiumpress"), 
  "back" => "overview"
  
  );
  
$data = array("ip" => "ip", "city" => "city", "country" => "country", "country_name" => "country name",  "lat" => "lat", "lng" => "lng", "zip" => "zip", "url" => "Map Data" );
  
  
   _ppt_template('framework/admin/_form-wrap-top' );
?>

<div class="card card-admin">
  <div class="card-body">
  
  
<div class="col-12 border-bottom py-3 px-0 mb-4">
  <div class="row">
    <div class="col-md-9">
      <label><?php echo __("Enable Maps","premiumpress"); ?></label>
       <p class="pb-0 btn-block text-muted mb-0 mt-1"><?php echo __("Maps are displayed on contact and search pages.","premiumpress"); ?></p>
    </div>
    <div class="col-md-2">
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle"  value="off" onchange="document.getElementById('mapsen').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle" value="on" onchange="document.getElementById('mapsen').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array("maps","enable")), array("1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="mapsen" name="admin_values[maps][enable]"  value="<?php if( in_array(_ppt(array("maps","enable")), array("1")) ){ echo 1; }else{ echo 0; } ?>">
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>
  


<?php
$m = array(
								1 => array("id" => "google", "name" => "", "img" =>  "https://premiumpress1063.b-cdn.net/_demoimagesv10/admin/gmaps.png"), 
								2 => array("id" => "mapbox", "name" => "", "img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/admin/mapbox.png"),
								3 => array("id" => "basic", "name" => "<strong>No Map</strong> <br><br />"),
);

?>
<div class="row">
<?php foreach($m as $mk => $md){ ?>
<div class="col-md-4 text-center">

<div class="bg-light py-5 rounded">

<?php if(isset($md['img'])){ ?>
<div class="px-3" style="height:40px;"><img src="<?php echo $md['img']; ?>" class="img-fluid" /></div>
<?php } ?>

<?php echo $md['name']; ?>

<small>
<?php if($mk == 1){ ?>
<a href='https://console.developers.google.com/apis/dashboard' style='font-weight: bold;' target='_blank'>get api key</a>
<?php }elseif($mk == 2){ ?>
<a href='https://account.mapbox.com/' style='font-weight: bold;' target='_blank'>get api key</a>
<?php }else{ ?>
no key needed
<?php } ?>
</small>

</div>


<input type="radio" class="mt-2" name="mapp"  value="<?php echo $md['id']; ?>" <?php if( _ppt(array("maps","provider")) == $md['id'] ){  ?>checked=checked<?php } ?> onclick="ChangeMap(this.value)" />
</div>
<?php } ?>
</div>

<div>


</div>

<input type="hidden" name="admin_values[maps][provider]"  value="<?php echo _ppt(array("maps","provider")); ?>" id="mapprovider" />
<script>
function ChangeMap(v){

	jQuery("#mapprovider").val(v); 
	
	jQuery("#basickey").hide();
	jQuery("#mapsapikey").show();
	jQuery("#locationbfffinfo").hide();
 
	
	if(v == "basic"){
	jQuery("#mapsapikey").hide();
	jQuery("#basickey").show();
	
 
	jQuery("#locationbfffinfo").show();
	
	}
		
}
jQuery(document).ready(function() { 
ChangeMap('<?php echo _ppt(array("maps","provider")); ?>');
});
</script>


<div id="mapsapikey">
<div class="container px-0 border-bottom mb-3 py-3 border-top mt-4"  >
      <div class="row py-2">
        <div class="col-md-4">
          <label>Maps API Key</label>
          <p class="text-muted"><?php echo __("This is API key for the map provider you select above.","premiumpress"); ?></p>
        </div>
        <div class="col-md-8">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text">#</span> </div>
            <input type="text" name="admin_values[maps][apikey]" class="form-control" value="<?php if(function_exists('current_user_can') && current_user_can('administrator')){ echo _ppt(array("maps","apikey")); } ?>">
          </div>
        </div>
      </div>
    </div>


<div class="container px-0"  >
      <div class="row py-2">
        <div class="col-md-4">
          <label><?php echo __("Zoom Level","premiumpress"); ?> (1 - 15)</label>
          
          <p class="text-muted"><?php echo __("Choose a default zoom level for your maps.","premiumpress"); ?></p>
          
           </div>
           <div class="col-md-4">
           </div>
            <div class="col-md-4">
            <input type="text" name="admin_values[maps][zoom]" class="form-control" value="<?php echo _ppt(array("maps","zoom")); ?>" placeholder="10">
        
           </div> 
        </div>
        
    </div>
    
    

<div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
              <div class="col-md-8 pr-lg-5">
                <label><?php echo __("Distance Metric","premiumpress"); ?></label>
                <p class="text-muted"><?php echo __("Here you can set which metric system to use.","premiumpress"); ?></p>
              </div>
              <div class="col-md-4">
                <div class="input-group mb-3">
                   
     <select name="admin_values[maps][mapmetric]" class="form-control mb-4">
     
      <option value="0"><?php echo __("miles","premiumpress"); ?></option>
      
      <option value="1" <?php  if( _ppt(array('maps','mapmetric')) == "1"){ echo "selected=selected"; } ?>><?php echo __("kilometers","premiumpress"); ?></option>
      
     
      </select>
                
                
                
                </div>
              </div>
            </div>
          </div>
          


<?php

 
$selected_countries = _ppt(array('maps','country_limit'));

?>
<div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
              <div class="col-md-8 pr-lg-5">
                <label><?php echo __("Default Search Country","premiumpress"); ?></label>
                <p class="text-muted"><?php echo __("By default map data is worldwide. Set this if you want to limit location based search results to one country.","premiumpress"); ?></p>
              </div>
              <div class="col-md-4">
                <div class="input-group mb-3">
                   
<select name="admin_values[maps][country_limit]" class="form-control">
<option value="0" <?php if( $selected_countries == "" || $selected_countries == "0" ){ echo "selected=selected"; } ?>><?php echo __("All Countries","premiumpress"); ?></option>
<?php
 
foreach($GLOBALS['core_country_list'] as $key => $value){
?>

<option value="<?php echo $key; ?>" <?php if( $selected_countries == $key){ ?> selected=selected<?php } ?>><?php echo $value; ?></option>

<?php } // end if 

 
?>
</select> 
                
                
                
                </div>
              </div>
            </div>
          </div>
    

</div>



<div id="basickey">




</div>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>