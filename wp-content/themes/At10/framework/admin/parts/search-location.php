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

global $CORE;
 
 
global $settings, $CORE, $CORE_ADMIN;
 	 
  $settings = array(
  
  "title" => __("Search Data","premiumpress"), 
  "desc" => __("Here you can manage your country and city search data.","premiumpress"), 
  
  "back" => "overview",
  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
 
<div class="card card-admin">
  <div class="card-body">
 
 

<div class="bg-light rounded p-3 mb-4">

<strong><?php echo __("How it works","premiumpress"); ?></strong> <?php echo __("The country and city search system uses a taxonomy. Parent values will be considered countries. Sub categories regions and cities.","premiumpress"); ?>

</div> 
 

       
          

    <a href="edit-tags.php?taxonomy=country&post_type=listing_type" class="btn btn-system btn-sm shadow-sm"><?php echo __("Manage Country Values","premiumpress"); ?></a>
 
 
 

 <div class="col-12 border-top mt-4 py-3 px-0 mb-4">
  <div class="row">
    <div class="col-md-7">
      <label><?php echo __("Bulk Import Countries","premiumpress"); ?></label>
       <p class="pb-0 btn-block text-muted mb-0 mt-1"><?php echo __("This will add new countries to your website.","premiumpress"); ?></p>
    </div>
    <div class="col-md-5">
     
        
        <button class="btn btn-primary mt-2" type="button" onclick="ajax_import_countrylist();"><?php echo __("Start Import","premiumpress"); ?></button>
    
    </div>
  </div>
</div>
 
 <div class="col-12 border-top mt-4 py-3 px-0 mb-4">
  <div class="row">
    <div class="col-md-7">
      <label><?php echo __("Bulk Import Cities","premiumpress"); ?></label>
       <p class="pb-0 btn-block text-muted mb-0 mt-1"><?php echo __("This will add new cities to your website.","premiumpress"); ?></p>
    </div>
    <div class="col-md-5">
    
         <select name="custom[map-country]" class="form-control" id="import-city">
          <?php  foreach($GLOBALS['core_country_list'] as $key=>$value){
                               
							   if(!isset($GLOBALS['core_state_list'][$key])){ continue; }
							   
							   $states = explode("|",$GLOBALS['core_state_list'][$key]);
							   
                                echo "<option value='".$key."'>".$value." (".count($states)." cities)</option>";} ?>
        </select>
        
        <button class="btn btn-primary mt-2" type="button" onclick="ajax_import_citylist();"><?php echo __("Start Import","premiumpress"); ?></button>
    
    </div>
  </div>
</div>
 


 


<?php /*
<div class="row border-bottom pb-3 mb-3">
            <div class="col-md-8 ">
              <label class="font-weight-bold mb-2"><?php echo __("Disable Full Country List","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Turn this feature on/off.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
                <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('fullcountrylist').value='0'">
                </label>
                <label class="radio on">
                <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('fullcountrylist').value='1'">
                </label>
                <div class="toggle <?php if( _ppt(array('search','input_fulllists')) == '1'){  ?>on<?php } ?>">
                  <div class="yes">ON</div>
                  <div class="switch"></div>
                  <div class="no">OFF</div>
                </div>
              </div>
              <input type="hidden" id="fullcountrylist" name="admin_values[search][input_fulllists]" value="<?php echo _ppt(array('search','input_fulllists')); ?>">
            </div>
</div>
*/ ?>          


 


<script>

function ajax_import_countrylist(){

	if(confirm("<?php echo trim(__("Are you sure you want to import new countries?","premiumpress")); ?>")) {           
				
					jQuery.ajax({
						type: "POST",
						url: ajax_site_url,	 	
						data: {
							admin_action: "ajax_import_countrylist", 
						},
						success: function(response) {            	 
							 
							window.location = "<?php echo home_url(); ?>/wp-admin/edit-tags.php?taxonomy=country&post_type=listing_type";
							 
						},
						error: function(e) {
							 
						}
					});
			
	
	}// end are you sure

}

function ajax_import_citylist(){
 
 
	countryid = jQuery("#import-city").val();
	
	if(confirm("<?php echo trim(__("Are you sure you want to import new cities?","premiumpress")); ?>")) {           
				
					jQuery.ajax({
						type: "POST",
						url: ajax_site_url,	 	
						data: {
							admin_action: "ajax_import_citylist",
							country_id: countryid, 
						},
						success: function(response) {            	 
							 
							 window.location = "<?php echo home_url(); ?>/wp-admin/edit-tags.php?taxonomy=country&post_type=listing_type";
							
							 
						},
						error: function(e) {
							 
						}
					});
			
	
	}// end are you sure

}

</script>
  
 
 
 
 
 
 
 
<?php
$countrydata = array();
$tax_country = get_terms("country", 'orderby=count&order=desc&hide_empty=0&parent=0');
	if(!is_wp_error( $tax_country )){ 
		$countrydata = array();
		foreach ($tax_country as $term) {
			$countrydata[$term->term_id] = $term->name; 
	}
}

$checkoutcountries = _ppt('search_countries');

?>

<div class="row border-top pt-3 my-3">
<div class="col-md-6">

<strong class="mb-2"><?php echo __("Available Countries","premiumpress"); ?></strong>

<p class="mt-2"><?php echo __("Choose which countries are visible to the users when they add/edit their pages under the location tab.","premiumpress"); ?></p>
 
<p class="small opacity-5"><?php echo __("Hold CTRL to select multiple.","premiumpress"); ?></p>

</div>
 
     
<div class="col-md-6">
 
<select name="admin_values[search_countries][]" class="form-control w-100" style="height:250px !important; width:100% !important;" multiple="multiple">
<option value="0" <?php if( !is_array( $checkoutcountries ) || is_array($checkoutcountries) && in_array("0", $checkoutcountries ) ){ echo "selected=selected"; } ?>><?php echo __("All Countries","premiumpress"); ?></option>
<?php
$count = 1;
 
 
if(!empty($countrydata)){

	foreach($countrydata as $k => $n){ 
	if($cat->parent != 0){ continue; } 

?>
<option value="<?php echo $k; ?>"  <?php if( !is_array( $checkoutcountries ) || is_array($checkoutcountries) && in_array($k, $checkoutcountries ) ){ echo "selected=selected"; } ?>>
	<?php echo $n; ?>
</option>

<?php $count++; } } ?>
</select> 

</div>
</div>
 
 
 
 
 
 
 
 

   <div class="card-footer text-center">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>

	</div>
</div>

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 
