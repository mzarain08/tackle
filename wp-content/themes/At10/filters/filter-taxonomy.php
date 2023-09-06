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

global $CORE, $userdata, $post, $wpdb, $settings; 


 // BUILD NEW ORDER
if(is_array(_ppt('searchtax'))){
	
	
	// AJAX REQUESTS FOR SINGLE CATS ON SEARC PAGE
	if(isset($_POST['showtax']) && $_POST['showtax'] != ""){
	
	register_taxonomy( $_POST['showtax'], THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => array('name' => $_POST['showtax']) , 
			'query_var' => true, 'rewrite' => true, 'rewrite' => array('slug' => $_POST['showtax']) ) ); 
			
	$displaytax[$_POST['showtax']] =  $_POST['showtax'];
	
	}else{
	
		$taxonomies = get_taxonomies(); 
		$displaytax = array();
		  
		foreach ( $taxonomies as $taxonomy ) {
		
			if(in_array($taxonomy, _ppt('searchtax'))){  
				
				$to = _ppt(array('taxorder',$taxonomy));
				if($to == ""){ $to = 0; }
				
				$displaytax[$to] =  $taxonomy;
				
			}	
		} 
	
	}
 

// REORDER
ksort($displaytax);
 
foreach ( $displaytax as $taxonomy ) {


if(THEME_KEY == "vt" && $taxonomy == "level" && !in_array(_ppt(array('lst', 'vt_levels')), array("","1"))){
continue;
}

if(isset($_GET['tax-store']) && is_numeric($_GET['tax-store']) && $taxonomy == "store" ){
continue;
} 


$showhide = _ppt(array('search','showhide'));
if(!is_numeric($showhide)){
$showhide = 5;
}

if(in_array($taxonomy, _ppt('searchtax'))){ 

$parent = 0;
$count = 1;
$cats = get_terms( $taxonomy, array( 'hide_empty' => 1, 'parent' => $parent  ));
if(!empty($cats)){
 

?>

<div class="card card-filter">
  <div class="card-body"> <a href="javascript:void(0)" onclick="jQuery('#collapse_tax-<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>').toggle();">
   
<div class="block-header">
<h5 class="block-header__title"><?php echo $CORE->GEO("translation_tax_key", $taxonomy); ?></h5>
<div class="block-header__divider"></div> 
</div>   
    
    
    </a>
    <div class="filter-content collapse" id="collapse_tax-<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>">
      <div class="filter_maxheight max_height_<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>" <?php if(count($cats) > $showhide ){ ?>style="max-height:<?php echo $showhide*32; ?>px; overflow:hidden;"<?php } ?>>
        <?php if(THEME_KEY == "dl" && $taxonomy == "make"){ ?>
        <select name="tax-make" class="form-control customfilter" id="reg_field_tax_make" name="sort" data-type="select" data-key="taxonomy" onchange="ChangeSearchValues('',this.value,'model__make','tx_model[]','-1','0', 'reg_field_tax_model_side');  ">
        <option value=""><?php echo __("Any Make","premiumpress"); ?></option>
        <?php
$count = 1;
$cats = get_terms( 'make', array( 'hide_empty' => 0, 'parent' => 0  ));
if(!empty($cats)){


foreach($cats as $cat){ 
if($cat->parent != 0){ continue; } 

 
?>
        <option value="make-<?php echo $cat->term_id; ?>" <?php if(isset($_GET['tax-make']) && $_GET['tax-make'] == $cat->term_id){ echo "selected=selected"; } ?>> <?php echo $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)); ?>
        <?php if($cat->count > 0){ ?>
        (<?php echo $cat->count; ?>)
        <?php } ?>
        </option>
        <?php $count++; } } ?>
        </select>
        <script>
function ChangeSearchValues(e, t, a, o, n, r, i) {	
	
	  jQuery.ajax({
        type: "GET",  
		url: ajax_site_url,	
        data: {
			core_aj: 1,
            action: "ChangeSearchValues",
			val: t,
            key: a,
			cl: o,
			pr: n,
			add: r,
        },
        success: function(r) { 
		
		jQuery('#'+i).html(r);
		jQuery('#'+i).prop('disabled', false);
		
		_filter_update();
		
        },
        error: function(e) {
             
        }
    });	
 
} 
<?php if(isset($_GET['tax-make']) && is_numeric($_GET['tax-make']) ){ ?>
 jQuery(document).ready(function(){ 
   	
   	ChangeSearchValues('','make-<?php echo esc_attr($_GET['tax-make']); ?>','model__make','tx_model[]','<?php if(isset($_GET['tax-model']) && is_numeric($_GET['tax-model']) ){ echo esc_attr($_GET['tax-model']); }else{ echo "-1"; } ?>','0', 'reg_field_tax_model_side');
   
   });  
<?php } ?>
</script>
        <?php   $count=0;  }elseif(THEME_KEY == "dl" && $taxonomy == "model"){ $count=0; ?>
        <select name="tax-model" class="form-control customfilter" data-live-search="true" id="reg_field_tax_model_side"  data-type="select" data-key="taxonomy" onchange="_filter_update();" >
          <option value=""><?php echo __("Any Model","premiumpress"); ?></option>
        </select>
        <?php }else{ ?>
        <?php $count = 1; foreach($cats as $cat){  
		
			if($count > 100){ continue; }
			
			// DEFAULT GENDER FOR DATING THEME
			if( in_array(THEME_KEY, array("da")) && $taxonomy == "dagender" && !isset($_GET['tax-dagender']) ){ 
			
				 $_GET['tax-'.$taxonomy] = get_user_meta($userdata->ID,'da-seek2',true);
				 
			}
			
		 ?>
          
         
        <label class="custom-control custom-checkbox f-<?php echo $taxonomy."-".$cat->term_id; ?>">
        <input type="checkbox" <?php if(isset($GLOBALS['flag-taxonomy-id']) && $GLOBALS['flag-taxonomy-id'] == $cat->term_id ){  ?>disabled<?php } ?> 

<?php if(isset($_GET['tax-'.$taxonomy]) && $_GET['tax-'.$taxonomy] == $cat->term_id){ echo "checked=checked"; } ?>

value="<?php echo $cat->term_id; ?>" name="catid[]" class="custom-control-input customfilter" data-type="checkbox" onclick="_filter_update()" data-key="taxonomy" data-value="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>">
        <div class="custom-control-label <?php if(_ppt(array('search','count')) != 1){ ?>addcount<?php } ?>" data-countkey="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>">
         
         
         <?php if(in_array($taxonomy,array("store","listing"))){ ?>
          <a href="<?php echo get_term_link( $cat->term_id, $taxonomy); ?>" class="text-dark">
   		<?php } ?>
          
          <?php 
		
		if( defined('WLT_DEMOMODE') && $taxonomy == "store" ){
		 
				$did = filter_var($cat->name, FILTER_SANITIZE_NUMBER_INT);	
			 				
				if(is_numeric($did) && isset($GLOBALS['CORE_THEME']['storedata'][$did]['title'])){
							
					echo $GLOBALS['CORE_THEME']['storedata'][$did]['title'];
								
				}else{
				
					echo $CORE->GEO("translation_tax_value", array($cat->term_id, $cat->name)); 
				}
		
	 
		}else{
		
				echo $CORE->GEO("translation_tax_value", array($cat->term_id, $cat->name)); 
		
		}
	 
		?>
       <?php if(in_array($taxonomy,array("store","listing"))){ ?>
          </a>
          <?php } ?>
        
        </div>
        </label>
        <?php $count++; } ?>
        <?php } ?>
      </div>
      <?php if($count > $showhide ){ ?>
      <div class="mt-3">
        <?php if($taxonomy == "store" && strlen(_ppt(array('links','stores'))) > 1){ ?>
      
        <a href="<?php echo _ppt(array('links','stores')); ?>" class="text-primary"><u><span class="small showmoreless"><?php echo __("show more","premiumpress") ?></span></u></a>
        
		<?php }elseif($taxonomy == "listing" && strlen(_ppt(array('links','categories'))) > 1){ ?>
        <a href="<?php echo _ppt(array('links','categories')); ?>" class="text-primary"><u><span class="small showmoreless"><?php echo __("show more","premiumpress") ?></span></u></a>
        <?php }else{ ?>
        <a href="javascript:void(0);" onclick="SetMaxHeight<?php echo strip_tags(str_replace("-","",$taxonomy));; ?>('.max_height_<?php echo strip_tags(str_replace("-","",$taxonomy));; ?>');" class="text-primary"><u><span class="small showmoreless"><?php echo __("show more","premiumpress") ?></span></u></a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php if($count > $showhide ){ ?>
<script>

function SetMaxHeight<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>(div){
	
	if(jQuery('.<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>_hset').length > 0){
	
		jQuery('.max_height_<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>').removeClass('<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>_hset');
		
		 jQuery(div).css('max-height', '<?php echo $showhide*36; ?>px'); 
		 
		 jQuery('#collapse_tax-<?php echo strip_tags(str_replace("-","",$taxonomy)); ?> .showmoreless').html("<?php echo __("show more","premiumpress") ?>");
	
	}else{	
	
		jQuery('.max_height_<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>').addClass('<?php echo strip_tags(str_replace("-","",$taxonomy)); ?>_hset');
		
		jQuery(div).css('max-height', '100%');  
		
		jQuery('#collapse_tax-<?php echo strip_tags(str_replace("-","",$taxonomy)); ?> .showmoreless').html("<?php echo __("show less","premiumpress"); ?>");
	}
 

}
</script>
<?php } ?>
<?php } ?>
<?php } ?>
<?php } } ?>
