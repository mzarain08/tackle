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
 
 
// GET LANGUAGES
$langs = _ppt('languages');
 
 
// PACKAGE FEATURES
$pakfeatures = $CORE->PACKAGE("get_package_all_features", array());
   
    
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?> 

<div class="">
<div class="row">
<div class="col-md-4 pr-lg-4">

<h3><?php echo __("Packages","premiumpress"); ?></h3>
<p class="text-muted lead mb-0"><?php echo __("Add, edit or update packages.","premiumpress"); ?></p> 

 
<script>
function newMembership(){
	jQuery("#addnewpackage").val(1);
	jQuery("#admin_save_form").submit();
}
</script>
 
 


<div class="mt-4 pakbackbtn1">
 <a href="admin.php?page=listingsetup" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>


 <div class="mt-4 pakbackbtn" style="display:none">
 <a href="javascript:void(0);" onclick="processTogglePaks();" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
<input type="hidden" name="addnewpackage" id="addnewpackage" value="0" />

  
  
  </div>
  <div class="col-md-8">
  
  <div class="card p-3">
  

<?php if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1){ }else{ ?>


<a class="_admin_iconbox icon-box pak-box" href="#" onclick="newMembership();">
<i class="fal fa fa-plus bg-primary text-light"></i><strong><?php echo __("Add New Package","premiumpress"); ?></strong><p><?php echo __("Create a new free or paid package.","premiumpress"); ?></p>
</a>

<?php } ?>
  
  
  

<script>
function processTogglePaks(){ 
jQuery(".pakbackbtn1").show();
jQuery(".pakbackbtn").hide()
jQuery("._admin_iconbox").show();
jQuery(".topshowpaks").show();
jQuery(".pak-box").show();
jQuery(".membership-box").hide();
}

function processShowPak(pid){
jQuery("._admin_iconbox").hide();
jQuery(".pak-box").hide();
jQuery(".membership-"+pid).show();
jQuery(".pakbackbtn").show();
jQuery(".pakbackbtn1").hide(); 
jQuery(".topshowpaks").hide();
}

<?php if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1 ){?>
jQuery(document).ready(function() {
processShowPak(99);
});
<?php } ?>

</script> 
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $i=0; 
 while($i < 11){  
 
 $title = _ppt('pak'.$i.'_name'); 
 $icon = str_replace("fa fa ","fa ", _ppt('pak'.$i.'_icon') ); 
 $desc = _ppt('pak'.$i.'_desc');
  
 if($desc == ""){
 $desc = __("No description set.","premiumpress"); 
 }
 
 if($icon == ""){ $icon = "fa fa-cog"; }
  
 if( $title == "" ){ $i++; continue; } ?>
 
 
 <a class="_admin_iconbox icon-box p-box" href="#" onclick="processShowPak(<?php echo $i; ?>)">
<i class="<?php echo $icon; ?>"></i><strong><?php echo $title; ?></strong><p><?php echo substr($desc,0,80); ?>..</p>
</a>
   
  
<?php


$i++;  }

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?> 
   
 
<style>
.card-memberships label {
	font-size:14px;
	font-weight:bold;
}

.card-memberships .nav-link {
	font-size: 14px;
	text-transform: uppercase;
	font-weight: 600;
	color: #b9b9b9;
}

</style>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$shown = 0;
$i=0; while($i < 11){ 


 $title = _ppt('pak'.$i.'_name');
 
 if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1 && !isset($newSet) && $title == ""){
 $title = "&nbsp;";
 $newSet = 1;
 }
 
 if( $title == ""){ $i++; continue; }
 
 $shown++;


?>


<div class="card-memberships membership-box rounded-0 membership-<?php if(isset($newSet)){ echo "99"; }else{ echo $i; } ?>" style="display:none;">
  <div class="card-body">
  
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item mb-0"> <a class="nav-link active rounded-0" id="#taba<?php echo $i; ?>-tab" data-toggle="tab" onclick="jQuery('.pakstats-<?php echo $i; ?>').fadeIn();" href="#taba<?php echo $i; ?>" role="tab"><?php echo __("Basics","premiumpress"); ?></a> </li>
       
      <li class="nav-item mb-0"> <a class="nav-link" id="tabb<?php echo $i; ?>-tab" data-toggle="tab" onclick="jQuery('.pakstats-<?php echo $i; ?>').hide();" href="#tabb<?php echo $i; ?>" role="tab"><?php echo __("Pricing Table","premiumpress"); ?></a> </li>
    
      <li class="nav-item mb-0"> <a class="nav-link" id="tabc<?php echo $i; ?>-tab" data-toggle="tab" onclick="jQuery('.pakstats-<?php echo $i; ?>').hide();"  href="#tabc<?php echo $i; ?>" role="tab"><?php echo __("Features","premiumpress"); ?></a> </li>
     
     <li class="nav-item mb-0"> <a class="nav-link" id="tabd<?php echo $i; ?>-tab" data-toggle="tab" onclick="jQuery('.pakstats-<?php echo $i; ?>').hide();"  href="#tabd<?php echo $i; ?>" role="tab"><?php echo __("Link","premiumpress"); ?></a> </li>
    
    </ul>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  <input type="hidden" id="enablemem<?php echo $i; ?>" name="admin_values[pak<?php echo $i; ?>_enable]" 
  value="<?php if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1 && $title ==  "&nbsp;" ){ echo 1; }elseif($i ==0){ echo 1; }else{ echo _ppt('pak'.$i.'_enable'); }  ?>">
  
  <input type="hidden" name="admin_values[pak<?php echo $i; ?>_key]" value="<?php echo $i; ?>" >
  
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 
    <div class="tab-content bg-white px-0">
      <div class="tab-pane fade show active" id="taba<?php echo $i; ?>" role="tabpanel" aria-labelledby="home-tab">
      
      
        <div class="row">
  
  
  
          <div class="col-md-9">
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            <a href="javascript:void(0);" onclick="jQuery('#title_<?php echo $i; ?>_show').toggle();ShowTranslationsTitle<?php echo $i; ?>();" class="btn btn-sm btn-system float-right mt-n1">
            <i class="fa fa-language"></i> 
			<?php echo __("Show Translations","premiumpress"); ?></a>
            
            
            <script>
			var ShowTranslationsTitle<?php echo $i; ?>Set = 0;
			function ShowTranslationsTitle<?php echo $i; ?>(){
			
				if(!ShowTranslationsTitle<?php echo $i; ?>Set){
				ShowTranslationsTitle<?php echo $i; ?>Set = 1;
				
				jQuery.ajax({
					type: "POST",
					url: '<?php echo home_url(); ?>/',	
					dataType: 'json',	
					data: {
						admin_action: "ajax_get_language_package_titles",
						i: <?php echo $i; ?>,
					},
					success: function(response) {
								
						if(response.status == "ok"){
										
							jQuery('#title_<?php echo $i; ?>_show').html(response.output);								 
						
						} 		
					},
					error: function(e) {
						console.log(e)
					}
				});
				
				} 
			} 
			</script>
            
            
            <?php } ?>
            <label><?php echo __("Display Name","premiumpress"); ?></label>
            <input type="text" style="height:50px !important;" name="admin_values[pak<?php echo $i; ?>_name]" id="<?php echo $i; ?>_name" value="<?php echo $title; ?>" class="form-control bg-light">
            <?php /***********************************************************************/ ?>
           
           
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            <div id="title_<?php echo $i; ?>_show" style="display:none;" > 
              
            </div>
            <?php } ?>
            <?php /***********************************************************************/ ?>
          </div>
          <div class="col-md-3">
            <label class="btn-block"><?php echo __("Icon","premiumpress"); ?></label>
            <input type="hidden" name="admin_values[pak<?php echo $i; ?>_icon]"  id="mem<?php echo $i; ?>_icon"  value="<?php if(_ppt('pak'.$i.'_icon') == ""){ echo "fa fa-cog"; }else{ echo _ppt('pak'.$i.'_icon'); } ?>" />
            <i class="<?php if( _ppt('pak'.$i.'_icon')  != ""){ echo str_replace("fa fa ","fa ", _ppt('pak'.$i.'_icon') ); }else{ echo "fa fa-cog"; }  ?> fa-2x text-primary float-left mr-2 fa-1x border p-2" style="cursor:pointer; height:50px;" id="mem<?php echo $i; ?>_icon_icon" onclick="loadiconbox('mem<?php echo $i; ?>_icon','<?php if( _ppt('pak'.$i.'_icon') != ""){ echo _ppt('pak'.$i.'_icon'); }else{ echo "fa fa-cog"; }  ?>');"></i>
          </div>
          <div class="col-md-12 mt-4">
          
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            
            <a href="javascript:void(0);" onclick="jQuery('#desc_<?php echo $i; ?>_show').toggle();ShowTranslationsDesc<?php echo $i; ?>();" class="btn btn-sm btn-system float-right mt-n1">
            <i class="fa fa-language"></i> <?php echo __("Show Translations","premiumpress"); ?>
            </a>
           
             <script>
			var ShowTranslationsDesc<?php echo $i; ?>Set = 0;
			function ShowTranslationsDesc<?php echo $i; ?>(){
			
				if(!ShowTranslationsDesc<?php echo $i; ?>Set){
				ShowTranslationsDesc<?php echo $i; ?>Set = 1;
				
				jQuery.ajax({
					type: "POST",
					url: '<?php echo home_url(); ?>/',	
					dataType: 'json',	
					data: {
						admin_action: "ajax_get_language_package_desc",
						i: <?php echo $i; ?>,
					},
					success: function(response) {
								
						if(response.status == "ok"){
										
							jQuery('#desc_<?php echo $i; ?>_show').html(response.output);								 
						
						} 		
					},
					error: function(e) {
						console.log(e)
					}
				});
				
				} 
			} 
			</script>
           
           
            <?php } ?>
            
            
            
            <label class="btn-block"><?php echo __("Description","premiumpress"); ?></label>
            <textarea name="admin_values[pak<?php echo $i; ?>_desc]" class="form-control w-100 bg-light" style="min-height:100px;"><?php echo _ppt('pak'.$i.'_desc'); ?></textarea>
           
            <?php /***********************************************************************/ ?>
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            <div id="desc_<?php echo $i; ?>_show" style="display:none;" >  </div>
            <?php } ?>
            <?php /***********************************************************************/ ?>
          </div>
        
        </div>
        <div class="row mt-4">
          <div class="col-md-4">
            <label><?php echo __("Price","premiumpress"); ?> <span class="required">*</span></label>
            <div class="input-group">
              <span class="input-group-prepend input-group-text rounded-0"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
              <input type="text" name="admin_values[pak<?php echo $i; ?>_price]" value="<?php if(_ppt('pak'.$i.'_price') == ""){ echo $i*10; }else{ echo _ppt('pak'.$i.'_price'); } ?>" class="form-control val-numeric">
            </div>
          </div>
          <div class="col-md-4">
            <label class="txt500 mb-2"><?php echo __("Duration","premiumpress"); ?> (<?php echo __("days","premiumpress"); ?>)</label>
            <div class="input-group">
            
              <input type="text" name="admin_values[pak<?php echo $i; ?>_duration]" class="form-control" value="<?php if(_ppt('pak'.$i.'_duration') == ""){ echo "30"; }else{ echo _ppt('pak'.$i.'_duration'); } ?>">
            
            </div>
            <small>0 = <?php echo __("unlimited","premiumpress"); ?></small>
          </div>
          <div class="col-md-4">
            <label><?php echo __("Recurring Payment","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_r').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_r').value='1'">
              </label>
              <div class="toggle <?php if( _ppt('pak'.$i.'_r') == '1'){  ?>on<?php } ?>">
                <div class="yes">
                  ON
                </div>
                <div class="switch">
                </div>
                <div class="no">
                  OFF
                </div>
              </div>
            </div>
            <input type="hidden" id="mem<?php echo $i; ?>_r" name="admin_values[pak<?php echo $i; ?>_r]" value="<?php echo _ppt('pak'.$i.'_r'); ?>">
          </div>
        </div>
 
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
        
<div class="tab-pane fade" id="tabb<?php echo $i; ?>" role="tabpanel"> 


<a href="javascript:void(0);" class="btn btn-sm btn-system" onclick="addnewpackage<?php echo $i; ?>()">
<i class="fa fa-plus mr-2"></i> <?php echo __("Custom Display Feature","premiumpress"); ?>
</a>  

<script>

function addnewpackage<?php echo $i; ?>(){
	
	var countf = jQuery('#customvalue<?php echo $i; ?>-list .customtxtfield').length +1;
	
	if(countf > 10){
	alert('Only 10 fields are currently allowed.');
	return;
	}
 	
	jQuery('#customvalue-list > div').clone().appendTo('#customvalue<?php echo $i; ?>-list').attr('id', 'pak'+ countf +'_wrap');
	
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f1').attr('name', 'admin_values[pak<?php echo $i; ?>_txt'+ countf +']');
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f1').attr('id', 'pak<?php echo $i; ?>_txt'+ countf +'');
		
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f2').attr('name', 'admin_values[pak<?php echo $i; ?>_txt'+ countf +'_val]');
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f2').attr('id', 'pak<?php echo $i; ?>_txt'+ countf +'_val');	 
	
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f3').attr('id', 'pak<?php echo $i; ?>_txt'+ countf +'_val_check');
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f3').attr('onclick', "changeCheckB('pak<?php echo $i; ?>_txt"+ countf +"_val')");
	 
	jQuery('#customvalue<?php echo $i; ?>-list .newfield .f4').attr('onclick', "jQuery('#customvalue<?php echo $i; ?>-list #pak<?php echo $i; ?>_txt"+ countf +"').val(''); jQuery('#customvalue<?php echo $i; ?>-list #pak"+ countf +"_wrap').hide();");
 			
	jQuery('#customvalue<?php echo $i; ?>-list .newfield').removeClass('newfield');
	
}

</script>         

<ul id="customvalue<?php echo $i; ?>-list" class="row">

 <?php $f =1; while($f < 11){ if(_ppt('pak'.$i.'_txt'.$f) == ""){ $f++; continue; } ?>
 
                    <div class="col-md-6 mt-4 border-bottom pb-4 customtxtfield" id="pak<?php echo $f; ?>_wrap">
                      <div class="position-relative">
                      
                        <input type="text" name="admin_values[pak<?php echo $i; ?>_txt<?php echo $f; ?>]" id="pak<?php echo $i; ?>_txt<?php echo $f; ?>" value="<?php if(_ppt('pak'.$i.'_txt'.$f) == ""){ echo ""; }else{ echo _ppt('pak'.$i.'_txt'.$f); } ?>" 
                        class="form-control" style="padding-left:45px !important;">
                        
                        <i class="fal fa-trash text-danger" onclick="jQuery('#customvalue<?php echo $i; ?>-list #pak<?php echo $i; ?>_txt<?php echo $f; ?>').val(''); jQuery('#customvalue<?php echo $i; ?>-list #pak<?php echo $f; ?>_wrap').hide();" style="position:absolute; right:10px; top:10px; cursor:pointer;"></i>
                        
                        <input type="hidden" name="admin_values[pak<?php echo $i; ?>_txt<?php echo $f; ?>_val]" id="pak<?php echo $i; ?>_txt<?php echo $f; ?>_val" value="<?php echo _ppt('pak'.$i.'_txt'.$f.'_val');  ?>" />
                       
                        <i class="fa <?php if(_ppt('pak'.$i.'_txt'.$f.'_val') != "0"){ ?>fa-check text-success<?php }else{ ?>fa-times text-danger<?php } ?> position-absolute" onclick="changeCheckB('pak<?php echo $i; ?>_txt<?php echo $f; ?>_val')" id="pak<?php echo $i; ?>_txt<?php echo $f; ?>_val_check" style="top:15px; left:15px; cursor:pointer;"></i> </div>
                      
					  
					  <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                      
                         
            <a href="javascript:void(0);" onclick="jQuery('#pak<?php echo $i; ?>_txt<?php echo $f; ?>_show').toggle();ShowTranslationsPak<?php echo $i; ?>_txt<?php echo $f; ?>();" class="btn btn-sm btn-system mt-2"><i class="fa fa-language"></i> <?php echo __("Show Translations","premiumpress"); ?> </a>
             
             
                <script>
			var ShowTranslationsPak<?php echo $i; ?>_txt<?php echo $f; ?>Set = 0;
			function ShowTranslationsPak<?php echo $i; ?>_txt<?php echo $f; ?>(){
			
				if(!ShowTranslationsPak<?php echo $i; ?>_txt<?php echo $f; ?>Set){
				ShowTranslationsPak<?php echo $i; ?>_txt<?php echo $f; ?>Set = 1;
				
				jQuery.ajax({
					type: "POST",
					url: '<?php echo home_url(); ?>/',	
					dataType: 'json',	
					data: {
						admin_action: "ajax_get_language_package_paktxt",
						i: <?php echo $i; ?>,
						f: <?php echo $f; ?>,
					},
					success: function(response) {
								
						if(response.status == "ok"){
										
							jQuery('#pak<?php echo $i; ?>_txt<?php echo $f; ?>_show').html(response.output);								 
						
						} 		
					},
					error: function(e) {
						console.log(e)
					}
				});
				
				} 
			} 
			</script>
             
             
                      
                      <div id="pak<?php echo $i; ?>_txt<?php echo $f; ?>_show" style="display:none;"> </div>
                   
                      <?php } ?>
                     
                      </div> 
                    <?php  $f++; } ?> 
                  
                  
   

</ul>       
    

<div class="container  mt-4">
<div class="row">
<div class="col-md-8">
<div class="mb-2 text-600"><?php echo __("Highlight","premiumpress"); ?></div>
<p class="opacity-5"><?php echo __("Shows this package with a solid color backound or highlighted text.","premiumpress"); ?></p>
</div>
<div class="col-md-3">
                        <div class="formrow mt-2">
                          <label class="radio off">
                          <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak<?php echo $i; ?>_highlight').value='0'">
                          </label>
                          <label class="radio on">
                          <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak<?php echo $i; ?>_highlight').value='1'">
                          </label>
                          <div class="toggle <?php if( _ppt('pak'.$i.'_highlight') == '1'){  ?>on<?php } ?>">
                            <div class="yes">ON</div>
                            <div class="switch"></div>
                            <div class="no">OFF</div>
                          </div>
                        </div>
                        <input type="hidden" id="pak<?php echo $i; ?>_highlight" name="admin_values[pak<?php echo $i; ?>_highlight]" value="<?php if(_ppt('pak'.$i.'_highlight') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_highlight'); } ?>">
                      </div>
    
</div></div>
    
	</div>    
    
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
        
      <div class="tab-pane fade" id="tabc<?php echo $i; ?>" role="tabpanel">
    

 
          
                    <div class="bg-white p-3 pt-0 ">
                     
                     
                      <?php if( !empty($pakfeatures)){ foreach(  $pakfeatures as $pak_key => $fea){  
					  
					  
					  if($fea['key'] == "duration"){ continue; }
					  
					   ?>
                      <div class="row py-3 border-top">
                        <div class="col small"> 
                        
                        
                        <div class="mb-2 text-600 fs-6"> <?php echo $fea['name']; ?> </div>
                         <?php if(isset($fea['desc'])){ ?><div class="opacity-5"> <?php echo $fea['desc']; ?>  </div> <?php } ?>
        
       
                        
                        
                        
                        </div>
                        <div class="col-md-3">
                          <?php if(isset($fea['inputbox'])){ ?>
                          <div class="position-relative">
                            <input type="text" value="<?php if(_ppt('pak'.$i.'_'.$fea['key']) == ""){ echo 10; }else{ echo _ppt('pak'.$i.'_'.$fea['key']); } ?>" name="admin_values[pak<?php echo $i; ?>_<?php echo $fea['key']; ?>]" class="form-control" />
                            <?php if($fea['key'] == "duration"){ ?>
                            <div class="position-absolute text-muted small" style="bottom: 8px;    right: 10px;">days</div>
                            <?php } ?>
                          </div>
                          <?php }else{ ?>
                          <label class="custom-control custom-checkbox">
                          <input type="checkbox" 
                    value="1" 
                   
                    class="custom-control-input" 
                    id="pak<?php echo $i; ?>_<?php echo $fea['key']; ?>check" 
                    onchange="ChekME('#pak<?php echo $i; ?>_<?php echo $fea['key']; ?>');"
                     
                    <?php if(_ppt('pak'.$i.'_'.$fea['key']) == 1){ ?>checked=checked<?php } ?>>
                          <input type="hidden" name="admin_values[pak<?php echo $i; ?>_<?php echo $fea['key']; ?>]" id="pak<?php echo $i; ?>_<?php echo $fea['key']; ?>add" value="<?php if(_ppt('pak'.$i.'_'.$fea['key']) == ""){ echo 1; }else{ echo _ppt('pak'.$i.'_'.$fea['key']); } ?>">
                          <span class="custom-control-label">&nbsp;</span> </label>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } } ?>
                    </div>
          
    
    
    
	</div> 
    
     
     
     
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
        
      <div class="tab-pane fade" id="tabd<?php echo $i; ?>" role="tabpanel">
    
      
            
            <p class="font-weight-bold"><?php echo __("Custom Package Link","premiumpress"); ?></p>
            
            <p><?php echo __("Ideal for use in your own pricing table designs or email links.","premiumpress"); ?></p>
            
            <p><a href="<?php echo _ppt(array('links','add')); ?>?pakid=<?php echo $i; ?>" target="_blank"><?php echo _ppt(array('links','add')); ?>?pakid=<?php echo $i; ?></a></p>
            
           
     
     
</div>  
     
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>  
     
    
</div>


        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  </div> 

<?php if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1){}else{ ?>
<div class="container mb-4 pakstats-<?php echo $i; ?>">
<div class="row no-gutters">

<div class="col-md-6">


    <div class="" style="border-radius: 0px; overflow:hidden; background: #6a6a6a url('<?php echo CDN_PATH; ?>images/bars3.png') bottom left; background-size:cover; ">
            <div class="card-body position-relative p-2 pl-4">
           
              <div class="h1 text-white"><?php echo $CORE->PACKAGE("count_orders_per_package", $i); ?></div>
     		
            <a href="admin.php?page=orders&pakid=<?php echo $i; ?>" class="btn float-right btn-system btn-sm font-weight-bold text-uppercase tiny " target="_blank"><?php echo __("view","premiumpress"); ?></a>
             
            
              <div class="text-white"><?php echo __("Orders Found","premiumpress"); ?></div>
            </div>
          </div>
    
</div>

<div class="col-md-6">


    <div class="" style="border-radius: 0px; overflow:hidden; background: #0866c6 url('<?php echo CDN_PATH; ?>images/bars2.png') bottom left; background-size:cover; ">
            <div class="card-body position-relative p-2 pl-4">
           
              <div class="h1 text-white"><?php echo $CORE->PACKAGE("count_listings_per_package", $i); ?></div>
      
              <a href="admin.php?page=listings&pakid=<?php echo $i; ?>" class="btn float-right btn-system btn-sm font-weight-bold text-uppercase tiny " target="_blank"><?php echo __("view","premiumpress"); ?></a>
              
              <div class="text-white"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"), __("Total %s","premiumpress")); ?></div>
             
            </div>
          </div>
    
</div>
</div>
</div>
<?php } ?>

        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


  <div class="bg-light p-3 savebar">
    <button type="submit" data-ppt-btn class="btn-primary" onclick="jQuery('#enablemem<?php echo $i; ?>').val(1);"><?php echo __("Save Changes","premiumpress"); ?></button>
   
    <a href="javascript:void(0);" onclick="DeletePackage(<?php echo $i; ?>);" class="btn btn-system float-right tiny font-weight-bold mt-2"><i class="fa fa-trash mr-2"></i><?php echo __("Delete","premiumpress"); ?></a>

  
</div></div> 
<?php $i++; } ?>




<?php if($shown == 0){ ?>

<div class="my-4 bg-white rounded border p-5 text-center">
   <i class="fal fa-frown fa-4x mb-4 text-light"></i>
   <h4><?php echo __("No packages found","premiumpress"); ?></h4>
   
  
</div>

<?php } ?>

</div>
 

<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 ?>
 
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>





<script>

function DeletePackage(id){

jQuery("#enablemem"+id).val(0);
jQuery("#"+id+"_name").val('');
jQuery(".membership-"+id).fadeToggle();
jQuery("#admin_save_form").submit();
 
}
</script>