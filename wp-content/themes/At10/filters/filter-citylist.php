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

global $CORE, $userdata, $post, $settings; 


if(_ppt(array('maps','enable')) == 1){ 


$showhide = _ppt(array('search','showhide'));
if(!is_numeric($showhide)){
$showhide = 5;
}   

$SQL = "SELECT DISTINCT a.meta_value FROM ".$wpdb->postmeta." AS a 
 INNER JOIN ".$wpdb->postmeta." AS t ON ( a.meta_key = 'map-city' AND t.post_id = a.post_id ) 
 INNER JOIN ".$wpdb->posts." AS f ON ( t.post_id = f.ID AND f.post_status = 'publish') 
 LIMIT 60";			
			 
$results = $wpdb->get_results($SQL); 
				 				 
if(count($results) > 0 && !empty($results) ){

 
?>

<div class="card card-filter">
  <div class="card-body"> <a href="javascript:void(0)" onclick="jQuery('#collapse_country').toggle();">
    
<div class="block-header">
<h5 class="block-header__title"><?php  echo __("City","premiumpress");  ?></h5>
<div class="block-header__divider"></div> 
</div>   
   
    </a>
    <div class="filter-content collapse" id="collapse_country">
     
     
	 <div class="filter_maxheight max_height_citylist" <?php if(count($results) > $showhide ){ ?>style="max-height:<?php echo $showhide*32; ?>px; overflow:hidden;"<?php } ?>>
	 <?php    
	  
	  
	  $selected_country = "";
	  if(isset($_GET['city'])){
	  $selected_country  = trim($_GET['city']);
	  }
	 
	  
	
				
				
				
				$in_array = array(); $statesArray = array();
					foreach ($results as $val){			
						
						$state = $val->meta_value;						
						if(!in_array($state,$in_array)){						
							
							// ADD TO ARRAY
							$in_array[] = $state;
							$statesArray[] .= $state;
						}// if in array					
					} // end while	
					
					// NOW RE-ORDER AND DISPLAY
					asort($statesArray);
					foreach($statesArray as $state){ 
							if(strlen($state) < 2){ continue; }
							
							
							$name = $state;			
							
							
							if(isset($GLOBALS['core_country_list'][$state])){
							
								$name = $GLOBALS['core_country_list'][$state];
								
							}else{
								foreach($GLOBALS['core_country_list'] as $country){
								
									if($country == $state){
									
										$name = $country;
									
									}
								}
							
							}
							
							?>
      <label class="custom-control custom-checkbox">
      <input type="checkbox"  value="<?php echo trim($state); ?>" name="city" class="custom-control-input customfilter ccche" onclick="_filter_update();" <?php if($selected_country == trim($state)){ echo "checked=checked"; } ?> data-key="city" data-value="<?php echo trim($state); ?>" data-old-value="" data-type="checkbox">
      <div class="custom-control-label " data-countkey="catid-"> <a href="javascript:void(0)" class="text-dark" style="text-decoration:none;"> <?php echo $name; ?> </a> </div>
      </label>
      <?php  }  ?>
      
      
      
      <input type="hidden"  value="" id="user-city"  />
      <select class="customfilter form-control mt-3" id="filter-city" style="display:none;" name="city" data-type="select" data-key="city" <?php if(!$CORE->isMobileDevice()){ ?>onchange="_filter_update()" <?php } ?>>
      </select>
      
    </div>
    </div>
    
    <?php if(count($results) > $showhide ){ ?>
      <div class="mt-3"> <a href="javascript:void(0);" onclick="SetMaxHeightlisting('.max_height_citylist');" class="text-primary"><u><span class="small showmoreless"><?php echo __("show more","premiumpress") ?></span></u></a> </div>
      <?php } ?>
    
  </div>
</div>


<?php } ?> 
<?php } ?>