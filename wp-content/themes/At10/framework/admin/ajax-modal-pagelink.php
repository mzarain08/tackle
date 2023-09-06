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

global $post, $CORE, $userdata;

$pageID = $_POST['page_id'];

$showlangs = 0;
if(isset($_POST['showlang'])){
$showlangs = $_POST['showlang'];
}
 

// GET LANGUAGES
$langs = _ppt('languages');
 

// FORM TOP
_ppt_template('framework/admin/_form-top' ); 

// PAGE LINKS ARRAY
$GLOBALS['core_page_templates'] = $CORE->LAYOUT("get_innerpage_blocks", array());

// GET ELEMENT PAGES
$elementorArray = array();
$args = array(
                   'post_type' 			=> 'elementor_library',
                   'posts_per_page' 	=> 150,
                    'orderby' 	=> 'date',
					'order' => 'desc'
               );
$wp_query = new WP_Query($args);
$tt = $wpdb->get_results($wp_query->request, OBJECT);
if(!empty($tt)){ foreach($tt as $p){ 
 $elementorArray["elementor-".$p->ID] = get_the_title($p->ID); 
} } 


// GET PAGES
$args = array(
'post_type' 		=> 'page',
'posts_per_page' 	=> 50,
'orderby' 			=> 'date',
'order' 			=> 'desc'
 );
 
$wp_query = new WP_Query($args);
$tt = $wpdb->get_results($wp_query->request, OBJECT);
 if(!empty($tt)){  
	 $elementorArray["9999"] = "9999";
	 foreach($tt as $p){	 
	 	$title = get_the_title($p->ID);	
		
		$template = get_post_meta($p->ID,"_wp_page_template", true);	
		
		if(strlen($template) > 1 && !in_array($template, array('elementor_canvas','elementor_header_footer','elementor_theme')) ){ continue; }
  		
		$elementorArray["page-".$p->ID] = $title;	 
	 }
 
}


$GLOBALS['elementor_page_templates'] = $elementorArray;



// ADDON HOMEPAGE
// ADDON HOMEPAGE
$GLOBALS['core_page_templates']['homepage'] = array( "name" => __("Home Page","premiumpress"), "link" => home_url()."/?reset=1", "order" => 1, "icon" => "fa-home", "bgcolor" => "#212548");  
//$GLOBALS['core_page_templates']['blog'] = array( "name" => __("Blog Page","premiumpress"), "link" => _ppt(array('links','blog'))."/?reset=1", "order" => 1, "icon" => "fa-rss", "bgcolor" => "#212548");  


 
$GLOBALS['core_page_templates']['listingpage'] = array( "name" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Page","premiumpress")), "link" => "", "order" => 2.2, "icon" => $CORE->LAYOUT("captions","icon"), "bgcolor" => "#482121");  
 
 
foreach($CORE->multisort($GLOBALS['core_page_templates'], array('order'))  as $k => $p){

	// KEY
	$corekey = str_replace("page_","",$k);
	$p['id'] = $corekey; 

	if($pageID != $corekey){ continue; }

?>

<div class="container p-3">
  <div class="row"> 
   
    <div class="col-md-12">
     
    
      <?php

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>
      <ul class="nav nav-tabs small mb-3" id="myTab" role="tablist">
        <li class="nav-item mb-0"> <a class="nav-link active border-0 pl-0" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __("Desktop Version","premiumpress"); ?></a> </li>
        <li class="nav-item mb-0"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo __("Mobile Version","premiumpress"); ?></a> </li>
      </ul>
      <div class="tab-content bg-white p-0" id="myTabContent">
        <?php

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          
          <?php if($showlangs){ ?>

          <strong class="mb-2 btn-block"><?php echo __("Multiple Languages","premiumpress"); ?></strong>
          
           
      
      <div class="fs-7 opacity-5">
	  
	  <?php echo __("When a visitor views your website a page is displayed. Here you can choose which page to display based on the language they are using.","premiumpress"); ?>
     
          
         <?php echo __("Choose which page to show for each language below.","premiumpress"); ?>
         
         </div>
          
          <?php }else{ ?>
          
          <strong class="mb-2 btn-block"><?php echo __("Custom Page Template","premiumpress"); ?></strong>
          <p class="opacity-8"><?php echo __("Select a page from the list below and we'll display this design instead of the default theme design.","premiumpress"); ?></p>
          
          
          <?php } ?>
		  
		  
		  <?php if(isset($p['noedit']) ){ ?>
          <h6>This page cannot be edited</h6>
          <div class="tiny">
            This page contains core theme code and cannot be edited just yet.
              We hope to add more options soon.
          </div>
          <?php }elseif(!$showlangs){ ?>
          <select data-placeholder="<?php echo __("Default Template","premiumpress"); ?>" name="admin_values[pageassign][<?php echo $p['id']; ?>]"  <?php if(is_array($elementorArray) && count($elementorArray) > 30  ){ ?> class="form-control"  data-size="10" data-live-search="true" title="&nbsp;"<?php }else{ ?>class="form-control"  <?php } ?> >
            <option value="0" style="color:#999999;"><?php echo __("Default Template","premiumpress"); ?></option>
            <optgroup label="Elementor Templates"></optgroup>
            <?php 
				  if(is_array($elementorArray)){
				  
				  foreach ( $elementorArray as $key => $title ) {  
				  
				      if($title == "Default Kit"){ continue; }  
               
			    if($key == "9999"){ ?>
            <optgroup label="Page Templates"></optgroup>
            <?php continue; }
				               
               $option = '<option value="'. $key.'"';
               if( _ppt(array('pageassign', $p['id'] )) == $key){ $option .= " selected=selected ";   } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } } ?>
          </select>
          <?php }  ?>
          
          <?php if($showlangs && (  empty($langs) || ( is_array($langs) && count($langs) < 2 ) ) ){ ?>
          
        <hr />
           <?php echo __("You have not setup any languages.","premiumpress"); ?> 
           <div><a href="admin.php?page=settings&lefttab=lang" data-ppt-btn class="btn-system mt-3"><?php echo __("Do It Now","premiumpress"); ?></a></div>
           
          
          <?php }elseif( is_array($langs) && !empty($langs) && count($langs) > 1 && $showlangs   ){  ?>
          <a href="javascript:void(0);" id="lang-desktop" data-pid="<?php echo $p['id']; ?>" onclick="template_language_transactions('showtranslations<?php echo $p['id']; ?>','<?php echo $p['id']; ?>');" 
                class="mt-3 btn btn-sm btn-system"><i class="fa fa-language"></i> <?php echo __("Show Translations","premiumpress"); ?> </a>
          <div id="" class="p-3 py-2 bg-light mt-3 showtranslations<?php echo $p['id']; ?>" style="display:none;">
            <div id="showtranslations<?php echo $p['id']; ?>_data" style="max-height:400px; overflow-y:scroll;">
            </div>
          </div>
          <?php } ?>
        </div>
        <?php

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <strong class="mb-2 btn-block"><?php echo __("Mobile Page Template","premiumpress"); ?></strong>
          <p class="opacity-8"><?php echo __("Select a custom page to be used when viewed on a mobile phone.","premiumpress"); ?></p>
         
         
         <?php if(!$showlangs){ ?>
         
          <select data-placeholder="<?php echo __("Use Default Design","premiumpress"); ?>" name="admin_values[pageassign][<?php echo $p['id']; ?>_mobile]"  <?php if(is_array($elementorArray) && count($elementorArray) > 30  ){ ?> data-size="10" class="form-control"  data-live-search="true" title="&nbsp;"<?php }else{ ?>class="form-control"  <?php } ?> >
            <option value="0" style="color:#999999;"><?php echo __("Use Default Design","premiumpress"); ?></option>
            <optgroup label="Elementor Templates"></optgroup>
            <?php 
				  if(is_array($elementorArray)){
				  
				  foreach ( $elementorArray as $key => $title ) {  
				   if($title == "Default Kit"){ continue; }  
				     
               
			    if($key == "9999"){ ?>
            <optgroup label="Page Templates"></optgroup>
            <?php continue; }
				               
               $option = '<option value="'. $key.'"';
               if( _ppt(array('pageassign', $p['id']."_mobile" )) == $key){ $option .= " selected=selected ";   } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } } ?>
          </select>
          <?php } ?>
          
          <?php if($showlangs && is_array($langs) && !empty($langs) && count($langs) > 1 && $showlangs   ){   ?>
          <a href="javascript:void(0);" onclick="template_language_transactions('showtranslations<?php echo $p['id']; ?>_mobile','<?php echo $p['id']; ?>_mobile');" 
                class="mt-3 btn btn-sm btn-system"><i class="fa fa-language"></i> <?php echo __("Show Translations","premiumpress"); ?> </a>
          <div class="p-3 py-2 bg-light mt-3 showtranslations<?php echo $p['id']; ?>_mobile" style="display:none;">
            <div id="showtranslations<?php echo $p['id']."_mobile"; ?>_data"></div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<div class="p-4 bg-light text-center mt-4">
  <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
</div>
<?php _ppt_template('framework/admin/_form-bottom' );  ?>
<script>

<?php if($showlangs){ ?>
jQuery(document).ready(function(){ 
var lid = jQuery("#lang-desktop").data('pid');
jQuery("#lang-desktop").hide();
template_language_transactions('showtranslations'+lid, lid);
});
<?php } ?>

function template_language_transactions(div,template){

	jQuery('.'+div).toggle();
	 
 
	if(jQuery('#'+div+'_data').html().length < 30){
	
	jQuery.ajax({
			type: "POST",
			url: '<?php echo home_url(); ?>/',	
			dataType: 'json',	
			data: {
				admin_action: "language_templates",
				t: template, 
			},
			success: function(response) {
				 
				if(response.status == "ok"){
				
					 jQuery('#'+div+'_data').html(response.output);
				
				}
				
			},
			error: function(e) {
				
			}
		});
	}

}

</script>
