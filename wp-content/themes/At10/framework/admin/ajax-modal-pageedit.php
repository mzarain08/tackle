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

$GLOBALS['flag-edit-block'] = 1;

$pageID = $_POST['page_id'];
?>
<?php
// FORM TOP
_ppt_template('framework/admin/_form-top' ); 



$all_block_data = $CORE->LAYOUT("get_blocks_data", array());

 
 
?>
<style>
label {
	font-size: 14px;
	font-weight: 600;
}

.border-green {
	border:2px solid green !important;
}
</style>
<div style="max-height:600px;   overflow: auto; overflow-y: scroll;">
<?php
// PAGE LINKS ARRAY
$GLOBALS['core_page_templates'] = $CORE->LAYOUT("get_innerpage_blocks", array());


if($pageID == "homepage"){

 $GLOBALS['core_page_templates']['homepage'] = array( 
 
	 "name" => __("Home Page","premiumpress"), 
	 "link" => home_url()."/?reset=1", 
	 "order" => 1, 
	 "icon" => "fa-home", 
	 "bgcolor" => "#212548", 
	 "blocks" => array(
	 	 "slot1_style" => _ppt(array('design','slot1_style')),
		 "slot2_style" => _ppt(array('design','slot2_style')),
		 "slot3_style" => _ppt(array('design','slot3_style')),
		 "slot4_style" => _ppt(array('design','slot4_style')),
		 "slot5_style" => _ppt(array('design','slot5_style')),
		 "slot6_style" => _ppt(array('design','slot6_style')),
		 "slot7_style" => _ppt(array('design','slot7_style')),
		 "slot8_style" => _ppt(array('design','slot8_style')),
		 "slot9_style" => _ppt(array('design','slot9_style')), 
	 ),
 
 );  


}elseif($pageID == "header_style"){

$GLOBALS['core_page_templates']['header_style'] = array( "name" => __("Header","premiumpress"), "link" => home_url()."/?s=&ppt_live_preview=1&tid=header&sid="._ppt(array('design','header_style')), "blocks" => array(_ppt(array('design','header_style'))) );  

}elseif($pageID == "footer_style"){

$GLOBALS['core_page_templates']['footer_style'] = array( "name" => __("Footer","premiumpress"), "link" => home_url()."/?s=&ppt_live_preview=1&tid=footer&sid="._ppt(array('design','footer_style')), "blocks" => array(_ppt(array('design','footer_style'))) );  

}


foreach($CORE->multisort($GLOBALS['core_page_templates'], array('order'))  as $k => $p){
 
 
	// KEY
	$corekey = str_replace("page_","", str_replace("page_","", $k ));
	$p['id'] = $corekey; 
 	 
	if($pageID != $corekey){ continue; }
	 
	
?>
  <div class="block pagetop">
    <h4><?php echo $p['name']; ?></h4>
    <a href="<?php echo $p['link']; ?>" target="_blank" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny"> <?php echo __("Preview Page","premiumpress"); ?> </a>
    <hr />
  </div>
  <?php if(isset($p['blocks'])){ 


	 foreach(  $p['blocks'] as $blockkey => $s){ 
	  
 
	$_GET['pagekey'] = str_replace("homepage","home",$p['id']);

	$this_block_data = array();
	if(isset($all_block_data[$s])){
	$this_block_data[$s] = $all_block_data[$s]; 
	}else{
	continue; // NO DATA SET
	}
	
	
	if(_ppt(array($p['id'],$s)) == "delete"){
	continue;
	}
	
	$block_cat = $CORE->LAYOUT("get_block_category", $s );	
?>
  <div class="block-data block-<?php echo $s; ?>-data" style="display:none;">
    <h4 class="opacity-5"><?php echo $s; ?></h4>
    <hr />
    <div  class="mr-3 mt-3">
      <a href="javascript:void(0);" onclick="gobacktoall();" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny mb-3"><i class="fa fa-long-arrow-alt-left"></i> <?php echo __("Go back","premiumpress"); ?></a> <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&amp;livedata=1&amp;tid=<?php echo $block_cat; ?>&amp;sid=<?php echo $s; ?>&innerpageid=<?php echo $p['id']; ?>" target="_blank" class="btn-preview btn btn-system btn-sm shadow-sm font-weight-bold tiny mb-3"><?php echo __("Preview My Changes","premiumpress"); ?></a> <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&amp;tid=<?php echo $block_cat; ?>&amp;sid=<?php echo $s; ?>&innerpageid=<?php echo $p['id']; ?>" target="_blank" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny mb-3"><?php echo __("Preview","premiumpress"); ?></a> <a href="javascript:void(0);" onclick="loaddefaults();" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny mb-3 float-right"><?php echo __("Load  Defaults","premiumpress"); ?></a> <?php echo $CORE->LAYOUT("load_blocks", $this_block_data );  ?>
    </div>
  </div>
  <div class="text-center block block-<?php echo $s; ?>">
    <div class="container">
      <div class="row">
        <div class="col-md-6 position-relative">
           <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&amp;defaultdata=1&amp;tid=<?php echo $block_cat; ?>&amp;sid=<?php echo $s; ?>&innerpageid=<?php echo $p['id']; ?>" target="_blank" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny btn-block"><img src="<?php echo $CORE->LAYOUT("get_block_prewview", $s); ?>" class="img-fluid" alt="img"  /></a>
        </div>
        <div class="col-md-6">
          <div class="bg-light p-3 ">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <button type="button"  style="cursor:pointer;" data-pagekey="<?php echo $k; ?>" data-settingid="<?php echo $s; ?>" data-pagekey="innerpage" class="loadsettingsbox btn btn-system btn-md font-weight-bold btn-block mb-3 shadow-sm " >
                  <?php echo __("Configure","premiumpress"); ?>
                  </button>
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                  <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&amp;livedata=1&amp;tid=<?php echo $block_cat; ?>&amp;sid=<?php echo $s; ?>&innerpageid=<?php echo $p['id']; ?>" target="_blank"  class="btn btn-system btn-sm shadow-sm font-weight-bold tiny btn-block"> <?php echo __("Preview","premiumpress"); ?> </a>
                </div>
                
                
                <?php if($p['id'] == "homepage"){ ?> <?php } ?>
                <div class="col-md-6">
                  <a href="javascript:void(0);" onclick="deleteblock('<?php echo $s; ?>', '<?php echo $p['id']; ?>', '<?php echo $blockkey ?>' );" class="btn btn-system btn-sm shadow-sm font-weight-bold tiny btn-block"><?php echo __("Delete","premiumpress"); ?></a>
                </div>
              
                
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
  </div>
  <?php } ?>
  <?php } ?>
  <?php } ?>
</div>

<div class="p-4 bg-light text-center mt-4" style="display:none" id="savechagedbtnb">
  <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
</div>
<?php _ppt_template('framework/admin/_form-bottom' );  ?>
<script>
     jQuery('.loaddatabox').click(function() { 
              			   	 
     	tb_show('', 'admin.php?page=docs&amp;tid='+ jQuery(this).data('id') +'&amp;pagekey='+ jQuery(this).data('pagekey') + '&amp;smallwindow=1&amp;TB_iframe=true');
		return false;	
 	
     });  
	 
function gobacktoall(){

jQuery(".block-data").hide();
jQuery(".block").show();



} 


function deleteblock(bid, pageid, blockid){

	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
	
		jQuery(".block-"+bid).hide();
	
		jQuery.ajax({
				type: "POST",
				 url: '<?php echo home_url(); ?>/', 
				data: {
					admin_action: "delete_block_value", 
					name: pageid,
					value: blockid,
					block: bid,
					 
				},
				success: function(response) {
					  
					 jQuery(".btn-preview").addClass("bg-success text-light");
				 
					
				},
				error: function(e) {
					
				}
			});
	} 
}
	 
function loaddefaults(){ 

	jQuery('.hasdefault').each(function () {		  
		
		var dval = jQuery(this).attr("data-default");
		if(dval != ""){
		jQuery(this).val(dval);  
	 	} 
		
	}); 
	
	jQuery("#savechagedbtnb").show();
	alert("Default values set - dont forget to save your changes.");
}	

jQuery('.hasdefault').change(function() {
 
jQuery.ajax({
			type: "POST",
			 url: '<?php echo home_url(); ?>/', 
			data: {
				admin_action: "update_block_value", 
				name: jQuery(this).attr('name'),
				value: jQuery(this).val(),
				 
			},
			success: function(response) {
				  
				 jQuery(".btn-preview").addClass("bg-success text-light");
			 
				
			},
			error: function(e) {
				
			}
		}); 


});
 
jQuery('.loadsettingsbox').click(function() {

jQuery(".block").hide();
jQuery(".block-data").hide();
jQuery(".block-"+ jQuery(this).data('settingid') +"-data").show(); 
		 
 	
});
</script>
