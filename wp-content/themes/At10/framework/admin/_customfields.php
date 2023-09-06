<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN, $CORE_UI;


 

// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


// GET LANGUAGES
$langs = _ppt('languages');

// GET FIELDS
$cfields = get_option("cfields");  
   
     
   // GET LIST OF CATEGORIES FOR SELECTION
   $categorylist = $CORE->CategoryList(array(0,false,0,THEME_TAXONOMY,0,0,true));
   $categorylistarray = get_terms(THEME_TAXONOMY,"orderby=count&order=desc&get=all");
   $new_categorylistarray = array();
   foreach($categorylistarray as $cad){
   $new_categorylistarray[$cad->term_id] = $cad;
   }



// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){
   
   // SAVE CUSTOM FIELD DATE
   if(isset($_POST['updatefields'])){
   
   	if(empty($_POST['cfield'])){ $_POST['cfield'] = array(); }
   	
   	update_option("cfields", $_POST['cfield']);
	
	$cfields = get_option("cfields"); 
   
   }
   
  if(isset($_GET['reinstalldefaults'])){
   
	   switch(THEME_KEY){
	    
		case "vt":
		case "mj":
	 	case "cp":
		case "pj":
		case "cm": {		
		
		 $dafelds = array();
		 update_option("cfields", $dafelds);
		
		} break;
		
		 
		
		
		case "jb": {
		
		$dafelds = array('name' => array('0' => 'Job Type','1' => 'Experience','2' => 'Company Details','3' => 'Company Name','4' => 'Company Website',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'dbkey' => array('0' => 'custom-1','1' => 'custom-2','2' => 'custom-4','3' => 'company','4' => 'url',),'cat' => array(),'fieldtype' => array('0' => 'taxonomy','1' => 'taxonomy','2' => 'title','3' => 'input','4' => 'input',),'taxonomy' => array('0' => 'jobtype','1' => 'experience','2' => 'category','3' => 'category','4' => 'category',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),);
		
		update_option("cfields", $dafelds);
		 
		
		} break;
				
		case "ll": {
		
		$dafelds = array('name' => array('0' => 'Price','1' => 'Level','2' => 'Language','3' => 'Course Requirements',),'help' => array('0' => '','1' => '','2' => '','3' => '',),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'textarea',),'dbkey' => array('0' => 'price','1' => 'level','2' => 'language','3' => 'req',),'values' => array('0' => '','1' => '','2' => '','3' => '',),'taxonomy' => array('0' => 'category','1' => 'level','2' => 'language','3' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no',),);
		
		update_option("cfields", $dafelds);
		 
		
		} break;
		
		
		case "ph": {
		
		$dafelds = array('name' => array('0' => 'Camera','1' => 'Camera Model','2' => 'Orientation','3' => 'License Type','4' => 'Example Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'fieldtype' => array('0' => 'taxonomy','1' => 'input','2' => 'taxonomy','3' => 'taxonomy','4' => 'input',),'dbkey' => array('0' => 'cameratype','1' => ' camera_model','2' => 'key62809','3' => 'licensetype','4' => 'examplefield',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '',),'taxonomy' => array('0' => 'cameratype','1' => 'category','2' => 'orientation','3' => 'license','4' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no',),);
		
		update_option("cfields", $dafelds);
		 
		
		} break;
		
		case "so": {
		
		$dafelds = array('name' => array('0' => 'Price','1' => 'Version','2' => 'Operating System','3' => 'Example Field',),'help' => array('0' => '','1' => '','2' => '','3' => '',),'fieldtype' => array('0' => 'input','1' => 'input','2' => 'taxonomy','3' => 'input',),'dbkey' => array('0' => 'price','1' => 'version','2' => 'system','3' => 'examplefield',),'values' => array('0' => '','1' => '','2' => '','3' => '',),'taxonomy' => array('0' => 'category','1' => 'category','2' => 'system','3' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no',),);
		
		update_option("cfields", $dafelds);
		
		} break;
	   
	   case "rt": {
	   
	   $dafelds = array('name' => array('0' => 'Asking Price','1' => 'Property Type','2' => 'Beds','3' => 'Baths','4' => 'Property Size (sqft)','5' => 'Phone Number','6' => 'Website','7' => 'My Custom Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'input','5' => 'input','6' => 'input','7' => 'input',),'dbkey' => array('0' => 'price','1' => 'key75170','2' => 'key751701','3' => 'key751702','4' => 'size','5' => 'phone','6' => 'website','7' => 'customfield',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'taxonomy' => array('0' => 'category','1' => 'type','2' => 'beds','3' => 'baths','4' => 'category','5' => 'category','6' => 'category','7' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no',),'cat' => array('0' => 'Array',),);
	   
	   } break;
	   
	   case "dl": {
	   
	   	   $dafelds = array('name' => array('0' => 'Year','1' => 'Condition','2' => 'Body','3' => 'Fuel','4' => 'Transmission','5' => 'Exterior','6' => 'Interior','7' => 'Doors','8' => 'Engine','9' => 'Seller','10' => 'Miles','11' => 'Drive','12' => 'Owners','13' => 'Seller',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'taxonomy','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'taxonomy','9' => 'taxonomy','10' => 'input','11' => 'taxonomy','12' => 'taxonomy','13' => 'taxonomy',),'dbkey' => array('0' => 'year','1' => 'key3','2' => 'key4','3' => 'key5','4' => 'key13','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'key9','9' => 'key10','10' => 'miles','11' => 'key12','12' => 'key1214','13' => 'key72764',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'body','3' => 'fuel','4' => 'transmission','5' => 'exterior','6' => 'interior','7' => 'doors','8' => 'engine','9' => 'owners','10' => 'category','11' => 'drive','12' => 'owners','13' => 'seller',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no',),);
	   
	   update_option("cfields", $dafelds);
	   
	   } break;
	   
	   case "ct": {
	   
	   $dafelds = array('name' => array('0' => 'Refunds','1' => 'Condition','2' => '7 Day Refunds','3' => 'Brand','4' => 'Brand','5' => 'Model Number','6' => 'Color','7' => 'Size','8' => 'Example Field',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '',),'fieldtype' => array('0' => 'title','1' => 'taxonomy','2' => 'taxonomy','3' => 'title','4' => 'taxonomy','5' => 'input','6' => 'taxonomy','7' => 'taxonomy','8' => 'input',),'dbkey' => array('0' => 'key1','1' => 'key2','2' => 'key94643','3' => 'key46827','4' => 'key90394','5' => 'modelnum','6' => 'key5411','7' => 'key91614','8' => 'examplefield',),'values' => array('0' => '','1' => '','2' => 'Yes
No','3' => '','4' => '','5' => '','6' => '','7' => 'Yes
No','8' => '',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'refunds','3' => 'category','4' => 'brand','5' => 'category','6' => 'color','7' => 'size','8' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no',),'cat' => array('0' => 'Array',),);

update_option("cfields", $dafelds);
	   
	   } break;
	   
	   case "mj": {
	   
	   $dafelds = array();
	   update_option("cfields", $dafelds);
	   
	   } break;
	   
	   case "dt": {
	   
	   $dafelds = array('name' => array('0' => 'Phone Number','1' => 'Website','2' => 'Payment Accepted','3' => 'Wifi Access','4' => 'Pets','5' => 'Parking',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'input','2' => 'taxonomy','3' => 'taxonomy','4' => 'taxonomy','5' => 'taxonomy',),'dbkey' => array('0' => 'phone','1' => 'website','2' => 'key1','3' => 'key2','4' => 'key3','5' => 'key4',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '',),'taxonomy' => array('0' => 'category','1' => 'category','2' => 'payment','3' => 'wifi','4' => 'pets','5' => 'parking',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no',),);
	   
	   update_option("cfields", $dafelds);
	   
	   } break;
	   
	   case "at": {
	   
	   $dafelds = array('name' => array('0' => 'Refunds','1' => 'Condition','2' => '7 Day Refunds','3' => 'Brand','4' => 'Brand','5' => 'Model Number','6' => 'Color','7' => 'Size',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '',),'fieldtype' => array('0' => 'title','1' => 'taxonomy','2' => 'taxonomy','3' => 'title','4' => 'taxonomy','5' => 'input','6' => 'taxonomy','7' => 'taxonomy',),'dbkey' => array('0' => 'key1','1' => 'key2','2' => 'key94643','3' => 'key46827','4' => 'key90394','5' => 'modelnum','6' => 'key5411','7' => 'key91614',),'values' => array('0' => '','1' => '','2' => 'Yes
No','3' => '','4' => '','5' => '','6' => '','7' => 'Yes
No',),'taxonomy' => array('0' => 'category','1' => 'condition','2' => 'refunds','3' => 'category','4' => 'brand','5' => 'category','6' => 'color','7' => 'size',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no',),);

update_option("cfields", $dafelds);
	   
	   } break;
		
		case "da": {		
			
			$dafelds = array('name' => array('0' => 'Age','1' => 'Ethnicity','2' => 'Sexuality','3' => 'Gender','4' => 'What do I look like?','5' => 'My Eyes','6' => 'My Hair','7' => 'My Body','8' => 'Hair Lenght','9' => 'My Habbits','10' => 'Drinking','11' => 'Smoking',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '',),'cat' => array(),'fieldtype' => array('0' => 'input','1' => 'taxonomy','2' => 'taxonomy','3' => 'taxonomy','4' => 'title','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'taxonomy','9' => 'title','10' => 'taxonomy','11' => 'taxonomy',),'dbkey' => array('0' => 'daage','1' => 'key2','2' => 'key3','3' => 'key4','4' => 'key5','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'key439','9' => 'key9','10' => 'key10','11' => 'key11',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '',),'taxonomy' => array('0' => 'category','1' => 'dathnicity','2' => 'dasexuality','3' => 'dagender','4' => 'category','5' => 'daeyes','6' => 'dahair','7' => 'dabody','8' => 'dahairlength','9' => 'category','10' => 'dadrink','11' => 'dasmoke',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no',),);
			
			update_option("cfields", $dafelds);
		
		} break;
		
		
		case "es": {		
			
			$dafelds = array('name' => array('0' => 'Ethnicity','1' => 'Sexuality','2' => 'Gender','3' => 'Location','4' => 'What do I look like?','5' => 'My Eyes','6' => 'My Hair','7' => 'My Body','8' => 'My Height','9' => 'Dress Size','10' => 'Bust size','11' => 'My Habbits','12' => 'Drinking','13' => 'Smoking','14' => 'WhatsApp Number',),'help' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'fieldtype' => array('0' => 'taxonomy','1' => 'taxonomy','2' => 'taxonomy','3' => 'input','4' => 'title','5' => 'taxonomy','6' => 'taxonomy','7' => 'taxonomy','8' => 'input','9' => 'input','10' => 'input','11' => 'title','12' => 'taxonomy','13' => 'taxonomy','14' => 'input',),'dbkey' => array('0' => 'key2','1' => 'key3','2' => 'key4','3' => 'map-city','4' => 'key5','5' => 'key6','6' => 'key7','7' => 'key8','8' => 'height','9' => 'dresssize','10' => 'bustsize','11' => 'key9','12' => 'key10','13' => 'key11','14' => 'whatsapp',),'values' => array('0' => '','1' => '','2' => '','3' => '','4' => '','5' => '','6' => '','7' => '','8' => '','9' => '','10' => '','11' => '','12' => '','13' => '','14' => '',),'taxonomy' => array('0' => 'dathnicity','1' => 'dasexuality','2' => 'dagender','3' => 'category','4' => 'category','5' => 'daeyes','6' => 'dahair','7' => 'dabody','8' => 'category','9' => 'category','10' => 'category','11' => 'category','12' => 'dadrink','13' => 'dasmoke','14' => 'category',),'required' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no','14' => 'no',),'editonly' => array('0' => 'no','1' => 'no','2' => 'no','3' => 'no','4' => 'no','5' => 'no','6' => 'no','7' => 'no','8' => 'no','9' => 'no','10' => 'no','11' => 'no','12' => 'no','13' => 'no','14' => 'no',),'cat' => array('0' => 'Array',),);
			
			update_option("cfields", $dafelds);
		
		} break;
		
	   
	   }
	   
	   // LEAVE MESSAGE
		$GLOBALS['ppt_error'] = array(
			"type" 		=> "success",
			"title" 	=> "Settings Updated",
			"message"	=> "Custom field data has been reset.",
		);
	    
   }

   
   
   
   
   
   
   
}

_ppt_template('framework/admin/header' ); 

_ppt_template('framework/admin/_form-top' ); ?>
<div class="p-4">


<div class="d-flex w-100" ppt-flex-between>
<div class="w-100">

<div><span id="catlistboxright"><div class="fs-md text-600"><?php echo __("Custom Fields","premiumpress") ?></div></span></div>
</div>
<div>
<?php if(!isset($_GET['reinstalldefaults'])){ ?>
     
     
<a data-ppt-btn class="btn btn-primary" href="javascript:void(0);" onClick="jQuery('#customfieldlist li').hide();jQuery('.nofieldsbox').hide();jQuery('#customfieldlist_new').clone().appendTo('#customfieldlist');addUpdateFieldKey();jQuery(this).hide();">
<?php echo __("Add New Field","premiumpress"); ?>
</a>
<?php } ?>
</div>
</div>
<hr />  
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
  

   
 
<div  class=" meta-box-sortables ui-sortable">
      <ul id="customfieldlist">
        <?php
                  if(is_array($cfields) && !empty($cfields) ){ $i=0; $setKeys = array(); $selectedcatlist = array();
                  
                  foreach($cfields['name'] as $data){ 
                  
                  	if($cfields['dbkey'][$i] !="" && $cfields['name'][$i] != "" ){ 
                  	
                  	// ADJUST KEY IF IS DUPLICATE
                  	if(in_array($cfields['dbkey'][$i], $setKeys) ){  $cfields['dbkey'][$i] = $cfields['dbkey'][$i]."".$i; }
                  	
                  	// ADD TO ALREADY DONE LIST
                  	$setKeys[] = $cfields['dbkey'][$i];	
                  	
                  	// WORK OUT CATEGORY LIST
                  	$displaycategorylist = $categorylist;
                  	$cat_class_list = ""; $dname = "";
                  	if(isset($cfields['cat'][$i]) && is_array($cfields['cat'][$i])){
                  		foreach($cfields['cat'][$i] as $c){
                  			$selectedcatlist[] = $c;
                  			$displaycategorylist = str_replace('"'.$c.'"', '"'.$c.'" selected=selected', $displaycategorylist);
                  			$cat_class_list .= " catid-".$c;
                  			//$dname .= $new_categorylistarray[$c]->name." ";
                  		}
                  	}
					
					$xtitle = 0;
					if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "title"){
					$xtitle=1;
					}
                  	
                  	
                  	?>
        <li class="closed <?php echo $cat_class_list; ?>" id="field<?php echo $i; ?>">
        
        
        
        
<div class="w-100 rounded  mb-3 <?php if($xtitle){ ?>py-3 shadow-0<?php } ?>"  <?php if(!$xtitle){ ?>ppt-box<?php } ?> >

    <div class="_header" ppt-flex-row>
    
        <div class="_title w-100">
        
        <a href="javascript:void(0);" onclick="addUpdateFieldKey();jQuery('.cf-<?php echo $i; ?>').toggle();" class="text-dark text-600">
        
        <?php echo stripslashes($cfields['name'][$i]); ?> <?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){ ?><span class="required text-red">*</span><?php } ?> 
        
        </a> 
        
        <span class="float-right">
		
        <?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){ ?>
        <span class="text-danger fs-sm mr-3"><?php echo __("required","premiumpress") ?></span>
        <?php } ?>
        
        <?php if(isset($cfields['editonly'][$i]) && $cfields['editonly'][$i] == "yes"){ ?>
        <span class="text-success fs-sm mr-3"><?php echo __("edit only","premiumpress") ?></span>
        <?php } ?>
        
		<span class="opacity-2  fs-sm"><?php echo $cfields['dbkey'][$i]; ?></span>
        
        
        </span>
        
       </div> 
      
      
        <div class="_close grab cursor <?php if($xtitle){ ?>mr-3<?php } ?>">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['grab']; ?></div>
        </div> 
        
        <div class="_close cursor" onClick="deleteField(<?php echo $i; ?>);">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>
         
    </div> 

</div>   


<?php /***********************************************************************/ ?>
               



 <div class="inside cf-<?php echo $i; ?> p-3 ppt-forms style3 mb-4" ppt-border1>
 
              <div class="row">
              
                <div class="col-md-6">
                 
                 
                  <div class="fs-7 mb-3 text-600"><?php echo __("Display Text","premiumpress"); ?> <span class="required">*</span></div>
                  
                  <input type="text" name="cfield[name][]" id="ftitle-<?php echo $i; ?>" value="<?php echo $cfields['name'][$i]; ?>" class="form-control"  />
               
                
                
               
                 
				 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                  <div class="mt-3">
                    <div class="mb-2 small">
                    
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      
                      <?php echo $CORE->GEO("get_lang_name", $lang); ?> </div>
                      
                      
                       <input type="text" name="cfield[name_<?php echo strtolower($lang); ?>][]"  value="<?php if(isset($cfields['name_'.strtolower($lang)][$i])){ echo $cfields['name_'.strtolower($lang)][$i]; } ?>" class="form-control">       
                      
                       
                  </div>
                  
                  <?php } ?>
                  
                  
                 
                <?php } ?>
               
                   <?php /***********************************************************************/ ?>
                   
                   <div class="helpbox">
                  <div class="fs-7 mt-4 text-600 mb-2"><?php echo __("Description","premiumpress"); ?></div>
                  
                  <div class="fs-sm opacity-5 mb-3"><?php echo __("This is displayed under the field.","premiumpress"); ?></div>
                  
                  
                  <input type="text"  name="cfield[help][]" class="form-control stopclean" value="<?php if(isset($cfields['help'][$i])){ echo stripslashes($cfields['help'][$i]); } ?>">
               
               
               
               
               				 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                  <div class="mt-3">
                    <div class="mb-2 small">
                    
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      
                      <?php echo $CORE->GEO("get_lang_name", $lang); ?> </div>
                      
                      
                       <input type="text" name="cfield[help_<?php echo strtolower($lang); ?>][]"  value="<?php if(isset($cfields['help_'.strtolower($lang)][$i])){ echo $cfields['help_'.strtolower($lang)][$i]; } ?>" class="form-control">       
                      
                       
                  </div>
                  
                  <?php } ?>
                  
                  
                 
                <?php } ?>
               
               
               
                </div>
                
                
                    <div class="fs-7 mt-4 text-600 mb-2"><?php echo __("Database Key","premiumpress"); ?> <span class="required">*</span></div>
                  
                   <div class="fs-sm mb-3"><span class="opacity-5"><?php echo __("Used to store the data in WordPress","premiumpress"); ?></span> <a href="https://wordpress.org/support/article/custom-fields/" target="_blank"
                   ><?php echo __("learn more","premiumpress"); ?></a></div>
                  <input type="text"  name="cfield[dbkey][]" id="dbkey-<?php echo $i; ?>"  onchange="removeWhitespace('dbkey-<?php echo $i; ?>');" class="form-control bg-light" value="<?php echo $cfields['dbkey'][$i]; ?>">
                   
                
               </div>
              
                <div class="col-md-6">
                  
                  
				  <div class="fs-7 mb-3 text-600"><?php echo __("Display Category","premiumpress"); ?> <span class="required">*</span></div>
                 
                  <div class="clearfix">
                 
                  
                    <select name="cfield[cat][<?php echo $i; ?>][]" multiple="multiple" style="height:300px !important; width:100%; overflow:scroll; padding:10px !important" class="form-control customfield-cat">
                      <option value="0" <?php if(!isset($cfields['cat'][$i][0]) || ( isset($cfields['cat'][$i][0]) && in_array($cfields['cat'][$i][0], array("","0")))){ echo "selected=selected"; } ?>><?php echo __("Display For All Categories","premiumpress"); ?></option>
                      <?php echo $displaycategorylist; ?>
                    </select>
                  </div>
                   <div class="fs-sm opacity-5 mt-3"><?php echo __("Choose which cateogies should display this field.","premiumpress"); ?></div>
                </div>
                
              </div>
 
              
                <div class="col-md-12 mb-3">
                  
                <hr />
                </div>
             
              <div class="row mt-3">
              
                <div class="col-md-6">
                 
                 <div class="fs-7 text-600 mb-2"><?php echo __("Field Type","premiumpress"); ?><span class="required">*</span></div>
                 
                 
                  <select name="cfield[fieldtype][]" class="field_type form-control"   onchange="showhideextrafield('field<?php echo $i; ?>')">
                    <option value="input" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "input"){echo "selected=selected"; } ?>>Input Field</option>
                    <option value="textarea" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "textarea"){echo "selected=selected"; } ?>>Text Area</option>
                    <option value="checkbox" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "checkbox"){echo "selected=selected"; } ?>>Checkbox</option>
                    <option value="radio" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "radio"){echo "selected=selected"; } ?>>Radio Button</option>
                    <option value="select" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "select"){echo "selected=selected"; } ?>>Selection</option>
                   <option value="taxonomy" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "taxonomy"){echo "selected=selected"; } ?>>Taxonomy</option>
                    <option value="date" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "date"){echo "selected=selected"; } ?>>Date</option>
                    
                    
                    <option value="title" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "title"){echo "selected=selected"; } ?>><?php echo __("Display Caption","premiumpress"); ?> (Title Only)</option>
                  </select>
                  
                   <div class="fs-sm opacity-5 mt-3"><?php echo __("Select the type of field to display to the user.","premiumpress"); ?></div>
               
                  
                  
                </div>
                
                 <div class="col-md-6">
                 
                 
                   <div class="tax_values" style="display:none">
             
                    <div class="fs-7 text-600 mb-2"><?php echo __("Taxonomy","premiumpress"); ?> <span class="required">*</span></div>
                    <select name="cfield[taxonomy][]" class="form-control">
                      <?php
                                    $select_tax = "";
                                    if(isset($cfields['taxonomy'][$i])){
                                    $select_tax = $cfields['taxonomy'][$i];
                                    }
                                    
                                    $taxs = get_taxonomies();
                                    $not_wanted = array('nav_menu','post_tag','post_format','wp_theme','wp_template_part_area');
                                     
									  foreach ($taxs as $tax) {
                                    	if(in_array($tax,$not_wanted)){ continue; }
                                    	if($tax == "category"){ $display_text = "Blog Category"; }elseif($tax == "listing"){ $display_text = "Listing Categories"; }else{ $display_text = $tax; }
                                    	
                                                          printf( '<option value="%1$s"%2$s>%3$s</option>', $tax, selected( $select_tax , $tax, false ), $display_text );
                                                      }
                                     
                                                      ?>
                    </select> 
                
              </div>
              <!-- end well -->
              <script> jQuery(document).ready(function() { showhideextrafield('field<?php echo $i; ?>'); }); </script>
              
                 
                 
                 
              
                </div>
                
                
                
              </div>
              <div class="extra_values" style="display:none">
                
                 <div class="fs-7 text-600 mt-4"><?php echo __("Field Values","premiumpress"); ?> <span class="required">*</span></div>
                
                
                <textarea class="form-control stopclean"  name="cfield[values][]" placeholder="One value per line" style="border:1px solid orange;height:100px !important;"><?php if(isset($cfields['values'][$i])){ echo stripslashes($cfields['values'][$i]); } ?>
</textarea>
              </div>
  
              
              
                          
                <div class="extrafields">
                
                <hr />
                
 <div class="row">
              
                <div class="col-md-6">
                
                
                  <label class="checkbox">
                
                
                  <input type="checkbox" onchange="ChangeTickValue1(<?php echo $i; ?>);" <?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){echo "checked=checked"; } ?>>
                  <b><?php echo __("Required Field","premiumpress"); ?></b> - <small> <?php echo __("The user will be prompted to select/enter a value.","premiumpress"); ?></small> </label>
                  
                  
                  <input type="hidden" name="cfield[required][]" class="checkvalue<?php echo $i; ?>" value="<?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){echo "yes"; }else{ echo "no";}?>" />
                

</div>
<div class="col-md-6">
                
                  <label class="checkbox">
                
                
                  <input type="checkbox" onchange="ChangeTickValue2(<?php echo $i; ?>);" <?php if(isset($cfields['editonly'][$i]) && $cfields['editonly'][$i] == "yes"){echo "checked=checked"; } ?>>
                  <b><?php echo __("Edit Only","premiumpress"); ?></b> - <small> <?php echo __("This field will not be visible on their listing page.","premiumpress"); ?></small> </label>
                  
                  
                  <input type="hidden" name="cfield[editonly][]" class="checkvalue2<?php echo $i; ?>" value="<?php if(isset($cfields['editonly'][$i]) && $cfields['editonly'][$i] == "yes"){echo "yes"; }else{ echo "no";}?>" />
                
</div></div>                
                
                </div>
                <!-- end extra field -->
              
              
              
              
              
           
            
            
            
            
            
            
          </div>
        </li>
        <?php }  $i++; } }else{ ?>
        <div class="p-4 bg-light text-center font-weight-bold opacity-5 nofieldsbox"><?php echo __("No Fields Created","premiumpress"); ?></div>
        <?php } ?>
      </ul>
    </div>
    <?php if(!empty($selectedcatlist)){ ?>
    <hr />
    <div id="filterbycatbox" class="px-0">
      <select onchange="FilterByCategory(this.value);" class="form-control mb-4 mt-3">
        <option value="0"><?php echo __("Show All Categories","premiumpress"); ?></option>
        <?php 
                  foreach(array_unique($selectedcatlist) as $ck){
                  
                  	foreach($categorylistarray as $cad){
                  	
                  		if($ck == $cad->term_id){
                  		?>
        <option value="catid-<?php echo $cad->term_id; ?>"><?php echo $cad->name; ?></option>
        <?php
                  }	
                  }
                  }
                  ?>
      </select>
    </div>
    <?php } ?>
    <script>


function deleteField(id){

	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
	
		addUpdateFieldKey();
		jQuery('#dbkey-'+id).val('');
		
		jQuery('#field'+id).fadeOut(400);
		
		setTimeout(function(){ 
				 	
			jQuery('#field'+id).html('');				
				
		}, 3000); 
	
	}

}

function resetcatfieldids(){

	i = 0;
	jQuery('.customfield-cat').each(function(i, obj) {
			 
		//catfieldid = jQuery(obj).attr('name');	 	 
		//console.log(catfieldid);	
		jQuery(obj).attr('name', 'cfield[cat]['+i+'][]');	   
		i++;
	});	

}

function addUpdateFieldKey(){



	// ADD NEW
   jQuery('<input>').attr({
	   type: 'hidden',            			
	   name: 'updatefields',
	   value: 1,
   }).appendTo('#customfieldlist');
}

jQuery(document).ready(function() {	

	// reload cat ids
	resetcatfieldids();

	jQuery( "#customfieldlist" ).sortable({
                   revert       : true,
                   connectWith  : ".sortable",
				    
					handle: ".grab",
				   placeholder: "panel-placeholder",
				    
					
					
	stop: function( ) { 
				
			
				   jQuery('<input>').attr({
                        			type: 'hidden',            			
                        			name: 'updatefields',
                        			value: 1,
                        		}).appendTo('#customfieldlist'); 
								
								// reload ids
								resetcatfieldids();
			
			
			
			
			},start: function(event, ui){
			
			var classes = ui.item.attr('class').split(/\s+/);
			for(var x=0; x<classes.length;x++){   
				if (classes[x].indexOf("col")>-1){
				ui.placeholder.addClass(classes[x]);
			  }
			}
			  
			 ui.placeholder.css({      
			  width: ui.item.innerWidth() - 30 + 1,
			  height: ui.item.innerHeight() - 15 + 1,     
			  padding: ui.item.css("padding"),
			  marginTop: 0
			});       
		  }
					
					
					
                });  
				
            
	});
   
   jQuery('#catlistboxright').html(jQuery('#filterbycatbox').html());
   jQuery('#filterbycatbox').html('');
            
            function showhideextrafield(div){
            			
            	val = jQuery('#'+div+' .field_type').val();
             
            			
            	if(val == "title" ){
					jQuery('#'+div+' .helpbox').hide();
				 
            	 
            	}else if(val == "checkbox" || val =="radio" || val =="select" ){
            		jQuery('#'+div+' .extra_values').show();
            		jQuery('#'+div+' .tax_values').hide();
            		jQuery('#'+div+' .tax_link').hide(); 
            	}else if(val == "taxonomy" ){
            		jQuery('#'+div+' .extra_values').hide();
            		jQuery('#'+div+' .tax_values').show();
            		jQuery('#'+div+' .tax_link').show();
            	}else{
            		jQuery('#'+div+' .extra_values').hide();
            		jQuery('#'+div+' .tax_values').hide();
            		jQuery('#'+div+' .tax_link').hide();	
            	}	
            }
            
            function FilterByCategory(catid){
            
            	if(catid == 0){
            	jQuery('#customfieldlist li').show();
            	}else{
            	jQuery('#customfieldlist li').hide();
            	jQuery('#customfieldlist li.'+catid+'').show();
            	}
            }
            function ChangeTickValue1(id){ 
             
            	 if(jQuery('.checkvalue'+id+'').val() == "no"){
            	 jQuery('.checkvalue'+id+'').val("yes");
            	 }else{
            	 jQuery('.checkvalue'+id+'').val("no");
            	 } 
            } 
			 function ChangeTickValue2(id){ 
             
            	 if(jQuery('.checkvalue2'+id+'').val() == "no"){
            	 jQuery('.checkvalue2'+id+'').val("yes");
            	 }else{
            	 jQuery('.checkvalue2'+id+'').val("no");
            	 } 
            } 
            function changeboxme(id){
            
             var v = jQuery("#"+id).val();
             if(v == 1){
             jQuery("#"+id).val('0');
             }else{
             jQuery("#"+id).val('1');
             }
             
            }
         </script>
 
        
         
       
          <a href="admin.php?page=settings&lefttab=taxonomies" class="float-right mt-1 btn btn-sm btn-system"><i class="fal fa-heading"></i> <?php echo __("Manage Taxonomies","premiumpress"); ?></a>
       
          <a href="admin.php?page=customfields&reinstalldefaults=1" class="mt-1 btn-system btn-sm confirm"><i class="fal fa-sync mr-2"></i> <?php echo __("reset all fields","premiumpress"); ?></a>
   
           <hr />



    
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
 
 
<?php /*
<textarea style="height:400px; width:100%;display:none;"><?php
echo "dafelds = array(";
foreach($cfields as $k => $v){

	if(is_array($v)){
		$i=0;
		echo "'".$k."' => array(";
		foreach($v as $k1 => $v1){
			if(!is_array($v1)){
			echo "'".$i."' => '".$v1."',";
			}
			$i++;
		}
		echo "),";	
	}
	 
} echo ");"; ?></textarea> 
*/ ?>



 















</div>
<?php _ppt_template('framework/admin/_form-bottom' ); ?>
<?php  _ppt_template('framework/admin/footer' );  ?>
 
     <!--- ----------- -->
<div style="display:none">
   <div id="customfieldlist_new">
      <li> 
         <div class="p-3" ppt-border1>   
            <input type="hidden" name="cfield[values][]" value=""  />
            <input type="hidden" name="cfield[cat][][]" value="0" class="customfield-cat"  />
            <input type="hidden" name="cfield[fieldtype][]" value="input"  />
            <input type="hidden" name="cfield[required][]" value="no"  />
            <input type="hidden" name="cfield[taxonomy][]" value=""  />
            <input type="hidden" name="cfield[help][]" value=""  />
            <input type="hidden" name="cfield[taxonomy_link][]" value=""  />
            
            
            <div class="fs-7 text-600 mb-2"><?php echo __("Display Caption","premiumpress"); ?></div>
            <input type="text" name="cfield[name][]" value=""  style="width:100%;" class="form-control my-3"  />  
            <input type="hidden" id="newcfieldkey" name="cfield[dbkey][]" value="key<?php echo rand(0,100000); ?>"  />
            <button class="btn-primary mt-2 " data-ppt-btn type="submit"><?php echo __("Save","premiumpress"); ?></button>
         </div>
      </li>
   </div>
</div>
<!--- ----------- -->

<script>
jQuery(document).ready(function() {
	jQuery('#newcfieldkey').val( "custom-" + ( jQuery('#customfieldlist li').length + 1 ) );
}); 
</script>
 