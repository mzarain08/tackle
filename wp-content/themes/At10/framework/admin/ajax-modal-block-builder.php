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

wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

if(!isset($_SESSION['mydesign']) || isset($_SESSION['mydesign']) && !is_array($_SESSION['mydesign'])){
$_SESSION['mydesign'] = array();
}

if(strlen($_POST['blockId']) > 1){
	
	if(substr($_POST['blockId'],0, 4) == "----"){ // re-order
	 	 
		$cleanme = str_replace("----","",$_POST['blockId']);
	 	$cleanme = substr($cleanme,0 ,-3); 
		$h = explode("---", $cleanme); 
		$_SESSION['mydesign'] = $h; 
	 
	
	}elseif(substr($_POST['blockId'],0, 2) == "--"){ // delete
		unset($_SESSION['mydesign'][str_replace("--","",$_POST['blockId'])]);

	}else{
		$_SESSION['mydesign'] = array_merge($_SESSION['mydesign'], array($_POST['blockId'])); 

	} 

} 
  
?>

<div class="container">
  <div class="row">
 
    <div class="col-md-12">
    
       
       <p class="mt-4 font-weight-bold"><?php echo __("Quick Page Builder","premiumpress"); ?></p>
      
      <p><?php echo __("Select the blocks you want, drag and drop to change the order then export into Elementor to customize.","premiumpress"); ?></p>
      
       <?php if(!defined('ELEMENTOR_VERSION')){ ?>
       <p class="text-danger"><?php echo __("Elementor not installed.","premiumpress"); ?></p>
     
       <?php } ?>
<div class="py-3" id="_buildme" style="display:none;">
 
 
<form name="runmarkspagebuilder" id="runmarkspagebuilder" action="<?php echo home_url(); ?>/wp-admin/admin.php" method="get" >
<input type="hidden" name="inner" value="ppt_builder" />
<input type="hidden" name="page" value="design" />
<input type="hidden" name="loadpage" value="new" /> 
<div class="font-weight-bold mb-3"><?php echo __("Give it a name:","premiumpress"); ?></div>
<input type="text" class="form-control mb-4" value="My New Page <?php echo date("Y-m-d"); ?>" name="pname" />
<button type="submit" class="btn btn-primary btn-xl shadow-sm"><?php echo __("Build My Page","premiumpress"); ?></button>
<input type="hidden" name="markspagebuilder" id="markspagebuilder" value="" />
</form>
 
</div>
    
    
      <?php

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>




<?php 


//// CATEGORIES
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<div id="_ppt_categories" style="display:none;">
<div class="row">
<?php
$block_types = array(); $i=1; 
foreach($CORE->LAYOUT("get_block_types",array()) as $t){ 
	$block_types[$t['id']] = $t['name']; 
}
		
foreach($block_types as $typeid => $type){
		 
	$cats_array[$typeid] = $typeid;
			
	$extracss = "";
			if($i%2){
			$extracss = "margin-right:7px;";
	}
	?>
    <div class="col-md-4 mb-3">
   
   <div class="p-3 border shadow-sm text-center small font-weight-bold link-dark">
    <a href="#" onclick="load_ajax_blocks_category('<?php echo $typeid; ?>', 1)"><?php echo ucfirst(str_replace("_"," ",$typeid)); ?></a>
   </div>
   
    </div>
    <?php 
	//$code .= "<div style='width: 48%;line-height:50px;float: left;text-align:center;border:1px solid #ddd; margin-bottom:20px;".$extracss."'><a href=\"javascript:void(0);\" onclick=\"ppt_elementor_change_type('".$typeid."');\">".$typeid."</a></div>";
	$i++;
}// end types
?>
</div>
</div>

<?php 


//// ADD ON EXTRA IMAGES IF NOT MORE THAN 6
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?> 

<div id="_ppt_blocks" style="max-height:500px; overflow-y:auto;">
<div class="container">
<div class="font-weight-bold"><?php echo __("My Page Layout","premiumpress"); ?></div>
<div class="row row1 mt-4" >
<?php foreach($_SESSION['mydesign'] as $key => $block){ ?>
<div class="col-12 has-block" data-blockid="<?php echo $block; ?>">

	<div class="panel panel-primary position-relative overflow-hidden border rounded shadow-sm p-2  mb-3 bg-white">
    
    <div class="row">
    <div class="col-md-4">
    
     <a href="<?php echo home_url(); ?>/?s=&ppt_live_preview=1&tid=<?php echo $pageID; ?>&sid=<?php echo $block; ?>" target="_blank"> 
          
          <img src="<?php echo $CORE->LAYOUT("get_block_prewview", $block  ); ?>" class="img-fluid lazy w-100" /> 
          </a> 
    
    </div>
    <div class="col-md-8 ">
    
    <div class="panel-heading">
        <div class="panel-title float-right" style="cursor:pointer;">
        <i class='fa fa-expand-arrows-alt opacity-5'></i>
        </div>
        
        <a href="#" onclick="load_ajax_blocks_builder('--<?php echo $key; ?>');" class="btn btn-system tiny mr-2"><i class="fa fa-trash"></i> </a>

        
        <div class="mt-1 tiny opacity-5"><?php echo ucfirst(str_replace("_"," ",$block)); ?></div>
    
    </div>
    </div> 
        
    </div>  
    
</div></div>
<?php } ?>
</div></div></div> 

</div></div>
 
<?php 


//// ADD ON EXTRA IMAGES IF NOT MORE THAN 6
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<hr />
<div class="text-center py-3" id="_gonormal">
 
<a href="#" onclick="_addBlock();" class="btn btn-system font-weight-bold mr-4"><i class="fal fa-plus"></i> <?php echo __("Add Block","premiumpress"); ?></a>

<a href="#" onclick="_runBuilder();" class="btn btn-system font-weight-bold confirm"><?php echo __("Export Design","premiumpress"); ?> <i class="fal fa-file-export m-0 ml-2"></i> </a>
 
</div>

<div class="text-center py-3" id="_goback" style="display:none;">
 
<a  href="#" onclick="load_ajax_blocks_builder(0);" class="btn btn-system font-weight-bold mr-2"><i class="fal fa-arrow-left "></i> <?php echo __("Go Back","premiumpress"); ?></a>

 
</div>



<?php 


//// ADD ON EXTRA IMAGES IF NOT MORE THAN 6
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

  

</div>

<script>
 
function _runBuilder(){

 	<?php if(!defined('ELEMENTOR_VERSION')){ ?>
	
	alert("<?php echo __("Elementor not installed.","premiumpress"); ?>");
	
	<?php }else{ ?>
	var runString = "";
	var a = jQuery(".has-block");
	a.each(function (a) {
		   
		if(jQuery(this).attr("data-blockid") != ""){
			
			runString += jQuery(this).attr("data-blockid")+'---' 
		   
		}
		   
	});
	
	jQuery("#markspagebuilder").val(runString); 
	
	jQuery("#_ppt_blocks").hide(); 
	jQuery("#_ppt_categories").hide();
	jQuery("#_buildme").show();
	<?php } ?>
 
}

function _addBlock(){

	jQuery("#_gonormal").hide();
	jQuery("#_goback").show();
	
	jQuery("#_ppt_blocks").hide(); 
	jQuery("#_ppt_categories").fadeToggle();
	 
}

jQuery(document).ready(function(){ 


	 // SORTABLE
 
	jQuery('#_ppt_blocks .row1').sortable({
		connectWith: ".panel",
		handle: ".panel-heading",
		placeholder: "panel-placeholder",
		
		stop: function( ) { 
		
			// save order
			var runString = "";
			var a = jQuery(".has-block");
			a.each(function (a) {
				   
				if(jQuery(this).attr("data-blockid") != ""){
					
					runString += jQuery(this).attr("data-blockid")+'---' 
				    
				}
				   
			});
			
			 load_ajax_blocks_builder('----'+runString);
			 
        
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
	
	jQuery('#_ppt_blocks .row1 .panel').on('mousedown', function(){
		jQuery(this).css( 'cursor', 'move' );
	}).on('mouseup', function(){
		jQuery(this).css( 'cursor', 'auto' );
	});
	
	// CCHECK EMPTY
	<?php if(empty($_SESSION['mydesign'])){ ?>
	_addBlock();
	jQuery("#_goback").hide();
	<?php } ?>

});


</script>