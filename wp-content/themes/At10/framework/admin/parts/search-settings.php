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

global $settings, $CORE, $CORE_ADMIN;

  $settings = array(
  
  "title" => __("Search Settings","premiumpress"), 
  "desc" => __("Additional search settings.","premiumpress"), 
  "back" => "overview"
  
  );
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$data = array("ip" => "ip", "city" => "city", "country" => "country", "country_name" => "country name",  "lat" => "lat", "lng" => "lng", "zip" => "zip", "url" => "Map Data" );
  	 
 
?>
<?php

  $settings = array(
  
  "title" => __("IP Targeting","premiumpress"), 
  "desc" => __("Detect the user IP addresses to display localized content.","premiumpress"), 
  "back" => "overview"
  
  );
  
   _ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
<div class="card card-admin">

 <div id="locationbfffinfo" style="display:none">
 
<div class="bg-light p-4 text-center">

<?php echo __("Location search features can only be used when Google Maps or Mapbox is enabled.","premiumpress"); ?> 

 

</div>
 </div> 

  <div class="card-body" id="locationbfff">
  
 
 


          
 

<div>

<div class="bg-light p-4">

<strong><?php echo __("Optional!","premiumpress"); ?></strong> <?php echo __("When a user visits your website there is no information gathered about the users location. If you want to automatically detect user locaiton information which can be used to display ads and language options to the user, you need to use a third-party API. We have integrated ipstack.com.","premiumpress"); ?> 

<div class="mt-2"><a href="http://ipstack.com?utm_source=FirstPromoter&utm_medium=Affiliate&fpr=mark45" target="_blank" class="btn btn-dark">Visit IP Stack</a></div>

</div>

</div>

 
<div class="col-12 border-bottom py-3 px-0">
  <div class="row">
    <div class="col-md-8">
      <label><?php echo __("Enable Auto Location Detection","premiumpress"); ?></label>
       <p class="pb-0 btn-block text-muted mb-0 mt-1"><?php echo __("Turn on/off the ipstack integration","premiumpress"); ?></p>
    </div>
    <div class="col-md-2">
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('ipenable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('ipenable').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array("ipstack","enable")), array("","1")) ){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="ipenable" name="admin_values[ipstack][enable]"  value="<?php if( in_array(_ppt(array("ipstack","enable")), array("1")) ){ echo 1; }else{ echo 0; } ?>">
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container px-0 border-bottom mb-3 py-3 my-4">
      <div class="row py-2">
        <div class="col-md-4">
          <label>API Access Key</label>
          <p class="text-muted"><?php echo __("This can be found in your ipstack account area.","premiumpress"); ?></p>
        </div>
        <div class="col-md-8">
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text">#</span> </div>
            <input type="text" name="admin_values[ipstack][apikey]" class="form-control" value="<?php if(function_exists('current_user_can') && current_user_can('administrator')){ echo _ppt(array("ipstack","apikey")); } ?>">
          </div>
        </div>
      </div>
    </div>


<?php if(strlen(_ppt(array("ipstack","apikey"))) > 1){ ?>
<div class="container px-0 border-bottom mb-3 py-3 ">
      <div class="row py-2">
        <div class="col-md-4">
          <label>Run Test</label>
          <p class="text-muted"><?php echo __("Please run a test to make sure it works.","premiumpress"); ?></p>
        </div>
        <div class="col-md-8">
          <div class="input-group mb-3">
          
           <div class="row">
          <?php 
		  foreach($data as $k => $n){ ?>
         
          <div class="col-6"><?php echo $n; ?>s</div>
           <div class="col-6"><span class="show-<?php echo $k; ?>">0</span>  </div>
          <?php } ?>
          </div> 
           
          </div>
           
            <a href="javascript:void(0);" onclick="ajax_ip_check();" class="btn btn-dark">Test IPStack Integration</a>
        </div>
      </div>


<?php } ?>
<script>
function ajax_ip_check(){
 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "ajax_get_ip_test",  
			 
        },
        success: function(response) {
		 	
			console.log(response.data);
  
			if(response.status == "ok"){
			
			<?php foreach($data as $k => $n){ ?>
			jQuery(".show-<?php echo $k; ?>").html(response.data.<?php echo $k; ?>);
			<?php } ?>
			
			
				jQuery.ajax({
						type: "POST",
						url: '<?php echo home_url(); ?>/',	
						dataType: 'json',	
						data: {
							action: "ajax_get_ip_test_map", 
							//s:  response.data.lng+","+response.data.lat, 
							s: response.data.country_name+" "+response.data.city, 
							 
						},
						success: function(response) {
							 	
								console.log(response.data);	
								jQuery(".show-url").html('<a href="'+response.data.url+'" class="btn btn-dark" target="_blank">View Map Data</a>');
				   			
						},
						error: function(e) {
							console.log(e)
						}
					});
			
			  
  		 		 
			}else{			
				
				alert(response.msg);	
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
 	
}// end are you sure

</script>



    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
<?php

$ipdata = get_option("ppt_user_ipdata");
if(!empty($ipdata)){

$ipdata = array_reverse($ipdata);
?>
<div style="max-height:500px; overflow:hidden; overflow-y:scroll;">

<?php foreach($ipdata as $ip => $g){ ?>

<div class="d-flex justify-content-between">
    <div><?php echo $ip; ?></div>
    <div><span class="flag flag-<?php echo strtolower($g['country']); ?>"></span>  <?php echo $g['country_name']; ?> </div>
    <div><?php echo $g['city']; ?></div> 
    <div><?php echo $g['date']; ?></div>
</div>
<?php }?>

</div>
    
<a href="javascript:void(0);" onclick="jQuery('.debugip').toggle();" class="tiny text-dark opacity-5">debug</a>  
<textarea style="width:100%; height:400px; display:none;" class="debugip ppt_user_ipdata">
<?php print_r($ipdata); ?>
</textarea>
    
<textarea style="width:100%; height:400px; display:none;" class="debugip ppt_saved_zipcodes">
<?php print_r(get_option('ppt_saved_zipcodes')); ?>
</textarea>    

<?php } ?>
    
  </div>
</div>
 

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>




<?php

if(in_array(THEME_KEY,array("atxxxx"))){ 

 $settings = array(
  "title" => __("Search Cards","premiumpress"), 
  "desc" => __("Choose the design of your search card.","premiumpress"),
 //"back" => "intro",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
   
  
   ?>
<div class="card card-admin">
  <div class="card-body">
    <div class="row">
      <?php
		
		$snames = array(
		
			1 => "Default",
			2 => "Design 2", 
		);
		  
		
		$SetThis = _ppt(array('design','search_card'));
	 
		
		foreach($snames as $i => $name){ ?>
      <div class="col-6 col-md-4">
        <div class="card-top-image mb-5  bg-light position-relative" style="height:300px; overflow:hidden;">
          <img data-src="<?php echo DEMO_IMG_PATH; ?><?php echo THEME_KEY; ?>/cards/<?php echo $i; ?>.jpg" class="img-fluid lazy" alt="img" <?php if($SetThis == $i){?>style="border:4px solid red;"<?php } ?> />
          <div class="text-center bg-dark text-light py-2 position-absolute w-100" style="bottom:0px;">
            <?php echo $name; ?>
          </div>
        </div>
      </div>
      <?php $i++; } ?>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-3">
          <label><?php echo __("Selected Design","premiumpress"); ?></label>
        </div>
        <div class="col-6">
          <select name="admin_values[design][search_card]" class="form-control">
            <?php foreach($snames as $i => $name){ ?>
            <option value="<?php echo $i; ?>" <?php if( $SetThis == $i){ echo "selected=selected"; }  ?>> <?php echo $name; ?> </option>
            <?php  $i++; } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>

<?php } ?> 