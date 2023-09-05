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

global $CORE; ?>
<form method="get" action="<?php echo home_url(); ?>" class="py-lg-0 ppt-forms">
  <input type="hidden" name="s" value="" />
  <input type="hidden" name="type" value="1" />
  
  
  
  <?php if(_ppt(array('design', 'searchbox_enable')) == "1"){ ?>
  
  <?php $ld = _ppt('customsearchbox');  ?>
  
   <div class="row">
  	
	<?php if(is_array($ld) && !empty($ld)){ foreach($ld as $type => $vals){
	
		if($vals != "1"){  continue; }
	 
  
  		switch($type){
		
			case "keyword": {
?>
    <div class="col">
      <div class="form-input position-relative">
      
        <input name="s" class="form-control typeahead" autocomplete="off" placeholder="<?php echo __("Keyword","premiumpress"); ?>" value="<?php if(isset($_GET['s'])){ echo esc_attr($_GET['s']); } ?>" />
        <span  style="top: 10px; right: 10px; position: absolute;    z-index: 100;"><span class="fal fa-search prev text-dark"></span></span> 
      </div>
    </div>
<?php
			} break;	
					
			case "location": {
?>
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
  
  
<div class="form-input position-relative">
      <input name="zipcode" class="form-control" id="homesearchzip"  placeholder="<?php echo __("Any Location","premiumpress"); ?>" value="<?php if(isset($_GET['zipcode'])) { echo esc_attr($_GET['zipcode']); } ?>" />
  
      </div>
   
    </div>
<?php
			} break;
			
			case "price": {
?>
<div class="col-md-3 col-sm-6 mb-3 mb-md-0">
   
   <div class="form-group position-relative">   
   <input type="hidden" name="price1" value="1" /> 
	<input class="form-control numericonly" name="price2" value="" placeholder="<?php echo __("Max Price","premiumpress"); ?>"/>     
    <div class="position-absolute prev text-dark"><?php echo hook_currency_symbol(''); ?></div>
    </div>
</div>
<?php
			
			} break;
			
			default: { // TAXONOMIE
			
			if(substr($type, 0, 3) == "tax"){
			
				$taxonomy = str_replace("tax_","",$type);
			
				$cats = get_terms( $taxonomy, array( 'hide_empty' => 0, 'parent' => 0  ));
				if(!empty($cats)){
				
				?>
				<div class="col-md-3 col-sm-6 mb-3 mb-md-0">
						
						<select <?php if( in_array(THEME_KEY,array("da","es") ) && $taxonomy == "age"){ ?> name="age1" <?php }else{ ?>name="tax-<?php echo $taxonomy; ?>"<?php } ?> class="form-control rounded-0">
						  <option value=""><?php if($taxonomy == "listing"){ echo __("Category","premiumpress"); }else{ echo $CORE->GEO("translation_tax_key", $taxonomy); } ?></option>
                          
                          <option value=""><?php echo __("Any","premiumpress"); ?></option>
						  <?php
								  $count = 1;
								  $cats = get_terms( $taxonomy, array( 'hide_empty' => 1, 'parent' => 0  ));
								  if(!empty($cats)){
								  foreach($cats as $cat){ 
								  if($cat->parent != 0){ continue; } 
								   
								  ?>
						  <option value="<?php echo $cat->term_id; ?>" <?php if(isset($_GET['tax-listing']) && $_GET['tax-listing'] == $cat->term_id){ echo "selected=selected"; } ?>>
						  <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
                          </option>
						  <?php $count++; } } ?>
						</select>
				</div>
				<?php
				
				}
			
			}
			
			
			} break;
		
		} 
		}
  
   } ?>
   
   
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
    <button  data-ppt-btn class="btn-block  btn-primary rounded-0" style="height: 45px;" type="submit"><?php echo __("Search","premiumpress"); ?></button>
  </div>
  
  </div>
   
  
  <?php }else{ ?>
  
 
  <?php 
  
   $switchme = THEME_KEY;
  if(_ppt(array('lst','makemodels')) == '1'){
  $switchme = "dl";
  }
  
  switch($switchme){ 

case "ll":
case "ph":
case "ex":
case "cp":
case "mj":
case "cm":
case "vt":
case "dt":
case "at":
case "jb":
case "rt":
case "ct":
case "so":
case "pj":
case "sp": {    ?>
  <div class="row">
    <div class="<?php if(in_array(THEME_KEY, array("rt","dt")) ){ ?>col-md-6 col-sm-6 mb-3 mb-md-0<?php }else{ ?>col-md-3 col-sm-6 mb-3 mb-md-0<?php } ?>">
      
       
        
      <div class="form-input position-relative">
        <input name="s" class="form-control typeahead" autocomplete="off" placeholder="<?php echo __("Keyword","premiumpress"); ?>" />
        <span  style="top: 11px; right: 10px; position: absolute;    z-index: 100;color:#000;"><span class="fal fa-search"></span></span>
        
        </div>
     
   
    </div>
    

    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
      <div class="form-input">
      
      
              <?php if(THEME_KEY == "cp"){ ?>
       
        <select name="tax-store" class="form-control rounded-0">
          <option value=""><?php echo __("Any Store","premiumpress"); ?></option>
          <?php
                  $count = 1;
                  $cats = get_terms( 'store', array( 'hide_empty' => 1, 'parent' => 0  ));
                  if(!empty($cats)){
                  foreach($cats as $cat){ 
                  if($cat->parent != 0){ continue; } 
                   
                  ?>
          <option value="<?php echo $cat->term_id; ?>" <?php if(isset($_GET['tax-listing']) && $_GET['tax-listing'] == $cat->term_id){ echo "selected=selected"; } ?>> <?php 
		  
		  
		  
		  
		  if( defined('WLT_DEMOMODE') ){
		 
				$did = filter_var($cat->name, FILTER_SANITIZE_NUMBER_INT);	
			 				
				if(is_numeric($did) && isset($GLOBALS['CORE_THEME']['storedata'][$did]['title'])){
							
					echo $GLOBALS['CORE_THEME']['storedata'][$did]['title'];
								
				}else{
				
					echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); 
				}
		
	 
		}else{
		
				echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); 
		
		}
		  
		   ?></option>
          <?php $count++; } } ?>
        </select>
        
        <?php }else{ ?>
        
            <select name="tax-listing" class="form-control rounded-0">
          <option value=""><?php if(THEME_KEY == "rt"){ echo __("Any Property","premiumpress");  }else{ echo __("Any Category","premiumpress"); } ?></option>
          <?php
                  $count = 1;
                  $cats = get_terms( 'listing', array( 'hide_empty' => 1, 'parent' => 0  ));
                  if(!empty($cats)){
                  foreach($cats as $cat){ 
                  if($cat->parent != 0){ continue; } 
                   
                  ?>
          <option value="<?php echo $cat->term_id; ?>" <?php if(isset($_GET['tax-listing']) && $_GET['tax-listing'] == $cat->term_id){ echo "selected=selected"; } ?>> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
          <?php $count++; } } ?>
        </select>
        
        
        <?php } ?>
        
      </div>
    </div>
    
    
   <?php if(in_array(THEME_KEY, array("rt","dt")) ){ ?>
    
    <?php }else{ ?>
    
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
      <div class="form-input">
        <?php if(THEME_KEY == "jb"){ $foundcats 	= get_terms( "jobtype", array( 'hide_empty' => 0  )); ?>
        <select class="form-control form-control-custom" name="jobtype">
          <option value=""><?php echo __("All Types","premiumpress"); ?></option>
          <?php if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){ ?>
          <option value="<?php echo $cat->term_id; ?>"><?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
          <?php
			 
		}
	}	?>
        </select>
        
        <?php }elseif(THEME_KEY == "cp"){ ?>
        
        <?php 
		$foundcats 	= get_terms( "listing", array( 'hide_empty' => 0  ));
	
			 ?>
        <select class="form-control form-control-custom" name="tax-listing">
          <option value=""><?php echo __("Any Category","premiumpress"); ?></option>
          <?php if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){ ?>
          <option value="<?php echo $cat->term_id; ?>"><?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
          <?php
			 
		}
	}	?>
        </select>
        
        
        <?php }elseif(THEME_KEY == "ph"){ ?>
        
                <?php  $foundcats 	= get_terms( "orientation", array( 'hide_empty' => 0  )); ?>
        <select class="form-control form-control-custom" name="tax-orientation">
          <option value=""><?php echo __("All Types","premiumpress"); ?></option>
          <?php if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){ ?>
          <option value="<?php echo $cat->term_id; ?>"><?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
          <?php
			 
		}
	}	?>
        </select>
        
        
        
        <?php }elseif(in_array(THEME_KEY, array("vt","ll"))){ ?>
        
        <?php 
		$foundcats 	= get_terms( "level", array( 'hide_empty' => 0  ));
	
			 ?>
        <select class="form-control form-control-custom" name="tax-level">
          <option value=""><?php echo __("All Types","premiumpress"); ?></option>
          <?php if(is_array($foundcats) && !empty($foundcats)){
		foreach($foundcats as $cat){ ?>
          <option value="<?php echo $cat->term_id; ?>"><?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
          <?php
			 
		}
	}	?>
        </select>
        

        
        
        <?php }else{ ?>
        
        <input type="hidden" name="price1" value="1" />
    
		
             <div class="input-group">   
	<input class="form-control numericonly" name="price2" value="" placeholder="<?php echo __("Max Price","premiumpress"); ?>"/>
    
     
    <div class="iconbit"><?php echo hook_currency_symbol(''); ?></div>

    </div>
    
        
        <?php } ?>
      </div>
    </div>
    <?php } ?>
    
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
      <button data-ppt-btn class="btn-block  btn-primary" style="height: 45px;" type="submit"><?php echo __("Search","premiumpress"); ?></button>
    </div>
  </div>
  <?php } break; 
  
  case "es":
  case "da": {    ?>
  <div class="row">
  <div class="<?php if(_ppt(array('maps','enable')) == 1){ ?>col-md-3<?php }else{ ?>col-md-4 offset-md-1<?php } ?> col-sm-6">
  
  <?php if(THEME_KEY == "es"){ ?>
  
    <select name="tax-dathnicity" class="form-control mb-4 mb-md-0 rounded-0"  data-live-search="true">
      <option value=""><?php echo __("Any Ethnicity","premiumpress"); ?></option>
      <?php
$count = 1;
$cats = get_terms( 'dathnicity', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
      <option value="<?php echo $cat->term_id; ?>"> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
      <?php $count++; } } ?>
    </select>
  
  
  <?php }else{ ?>
  
    <select name="tax-dagender" class="form-control mb-4 mb-md-0 rounded-0"  data-live-search="true">
      <option value=""><?php echo __("Any Gender","premiumpress"); ?></option>
      <?php
$count = 1;
$cats = get_terms( 'dagender', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
      <option value="<?php echo $cat->term_id; ?>"> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
      <?php $count++; } } ?>
    </select>
    
    <?php } ?>
    
  </div>
  <?php if(in_array(THEME_KEY,array("da","es")) && _ppt(array('lst', 'da_age')) == "0"){  }else{ ?>
  <div class="<?php if(_ppt(array('maps','enable')) == 1){ ?>col-md-3<?php }else{ ?>col-md-4 <?php } ?> col-sm-6">
  
    <select name="age" class="form-control mb-4 mb-md-0 rounded-0"  data-live-search="true">
      <option value=""><?php echo __("Any Age","premiumpress"); ?></option>
      <?php
$count = 1; $show = 0;
$cats = get_terms( 'age', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){
foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 
 
?>
      <option value="<?php echo preg_replace('/[^0-9]/', '', $cat->name); ?>"> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?></option>
      <?php $count++; $show++; } } ?>
      
<?php if($show == 0){ ?>
      <option value="20">20+</option>
      <option value="30">30+</option>
      <option value="40">40+</option>
      <option value="50">50+</option>

<?php } ?>  
      
      
    </select>
  </div>
  <?php } ?>
  <?php if(_ppt(array('maps','enable')) == 1){ ?>
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
  
   
      <div class="form-input position-relative">
      <input name="zipcode" class="form-control" placeholder="<?php echo __("Location","premiumpress"); ?>" />
      <span  style="top: 11px; right: 10px; position: absolute;    z-index: 100;color:#000;"><span class="fal fa-map-marker"></span></span>
      
      </div>
 		 
  
  
  </div>
   
  <?php } ?>
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
    <button data-ppt-btn class="btn-block btn-primary rounded-0" style="height: 45px;" type="submit"><?php echo __("Search","premiumpress"); ?></button>
  </div>
  <?php } break;   case "dl": {    ?>
  <div class="row">
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
  
  
<?php
global $filter_data;
$filter_data['tax'] = "listing";
$GLOBALS['ncats']= "listing";
$GLOBALS['flag-inside-sidebar'] = 1;


ob_start();
_ppt_template( 'filters/filter-tax-listing-dropdown' );  
$searchCode = ob_get_contents();
ob_end_clean(); 

echo str_replace("catid[]","tax-listing",$searchCode);

?>
  </div>
  
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
  
    
     <div class="input-group">   
	<input class="form-control numericonly rounded" name="price1" value="" placeholder="<?php echo __("Min Price","premiumpress"); ?>"/>
    
    <div class="iconbit"><?php echo hook_currency_symbol(''); ?></div>

    </div>
   </div> 
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
  
    
     <div class="input-group">   
	<input class="form-control numericonly rounded" name="price2" value="" placeholder="<?php echo __("Max Price","premiumpress"); ?>"/>
   
    
     
    <div class="iconbit"><?php echo hook_currency_symbol(''); ?></div>

    </div>
    
    
  </div>
  <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
    <button data-ppt-btn class="btn-block btn-primary rounded-0 text-600" style="height: 45px;" type="submit"><?php echo __("Search","premiumpress"); ?></button>
  </div>
  <?php } break; default: { } break;  }  ?>
  
  <?php } ?>
</form>
