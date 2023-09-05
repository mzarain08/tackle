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


	include(get_template_directory()."/framework/data/_stores.php");
	
	$storesList = $GLOBALS['_list_stores'];
	
$letters = range('A', 'Z');
	 
  $settings = array(
  
  "title" => __("Stores","premiumpress"), 
  "desc" => __("Here you can manage the default theme stores. If you do not want a store to display, check the box.","premiumpress"), 
  
  "back" => "overview",
  
  ); 
  
   _ppt_template('framework/admin/_form-wrap-top' ); ?>


<script>

function hideStore(newone){ 

	if(jQuery(".check-"+newone).is(':checked')){		 
		jQuery("#store_hide").val(jQuery("#store_hide").val()+','+newone);		
	}else{		
		jQuery("#store_hide").val(jQuery("#store_hide").val().replace(','+newone, ""));	 
	}
 
}

function saveStoreData(){
 
	jQuery.each(jQuery("#store_hide").data(), function(i, v) {
		console.log(i + " -- " + v);
		if(v == 1){
			jQuery("#store_hide").val(jQuery("#store_hide").val() + "," + i );
		}
		
	});
	 
	 jQuery("#admin_save_form").submit();
	 
}

function checkStoreData(){ 
 
	res =  jQuery("#store_hide").val().split(",");
 
	jQuery.each(res, function(i, v) {	 		 
		jQuery(".check-"+v).prop('checked', true);
		
	});
}
jQuery(document).ready(function() {	

	checkStoreData();
	 
});

</script>
  
 
<input type="hidden" id="store_hide" name="admin_values[storedata][hide]" value="<?php echo _ppt(array('storedata', 'hide')); ?>"  data-test="123"> 
<div class="card card-admin">
  <div class="card-body">
  

	<?php foreach($letters as $l){ ?>
    <div class="wrap wrap-<?php echo $l; ?>">
    <h3><?php echo $l; ?></h3>
    <hr />
    <div class="py-3 mb-4">
   <div class="row no-gutters"> 
		<?php $i =1; foreach($storesList as $store => $store_image){ ?>    
            
            <?php if(substr(strtolower($store), 0,1) == strtolower($l)){ ?>
              
            
            <div class="col-6 col-md-3 py-2">
            
            <div class="d-flex">
            <input type="checkbox" class="mr-2 check-<?php echo filterme($store); ?>" onchange="hideStore('<?php echo filterme($store); ?>');"  value="" />
            
            <div class="small"><?php echo $store; ?></div>
            
            </div>
            
            </div>          
            
           
          
            <?php $i++; } ?> 
            
        <?php } ?>  
    </div>
 	</div>
    </div>
    <?php } ?>
    
    
    
    
    
    
    
    <div class="p-4 bg-light text-center mt-4">
      <button type="button" onclick="saveStoreData();" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card -->
    
   
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 