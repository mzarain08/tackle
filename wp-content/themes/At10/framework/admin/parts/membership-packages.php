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

 
 
$memnames = array( __("No Membership","premiumpress"), 'Bronze','Silver','Gold','','','','','','','' );
$memfeatures = $CORE->USER("membership_features", array());
 
 
// GET LANGUAGES
$langs = _ppt('languages');
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
 


<div class="ppt-forms style3">
<div class="row">
<div class="col-md-12">

 
 
<script>
function newMembership(){
	jQuery("#addnewmembership").val(1);
	jQuery("#admin_save_form").submit();
}
</script>
 

 


 
 

 <input type="hidden" name="addnewmembership" id="addnewmembership" value="0" />
  
  
  </div>
  <div class="col-md-12">
  
  
    <div class="">
  

<?php if(isset($_POST['addnewpackage']) && $_POST['addnewpackage'] == 1){ }else{ ?>


<a class="_admin_iconbox icon-box pak-box" href="#" onclick="newMembership();">
<i class="fal fa fa-plus bg-primary text-light"></i><strong><?php echo __("Add Membership","premiumpress"); ?></strong><p><?php echo __("Create a new free or paid membership.","premiumpress"); ?></p>
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
jQuery("#overview-box").hide();

jQuery("#overlistwrap").show();


}

function processShowPak(pid){
jQuery("._admin_iconbox").hide();
jQuery(".pak-box").hide();
jQuery(".membership-"+pid).show();
jQuery(".pakbackbtn").show();
jQuery(".pakbackbtn1").hide(); 
jQuery(".topshowpaks").hide();
jQuery("#overlistwrap").hide();
}

<?php if( isset($_POST['addnewmembership']) && $_POST['addnewmembership'] == 1 ){?>
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
 
 $title = _ppt('mem'.$i.'_name'); 
 $icon = str_replace("fa fa ","fa ", _ppt('mem'.$i.'_icon') ); 
 $desc = _ppt('mem'.$i.'_desc'); 
 
 if($desc == ""){
 $desc = __("No description set.","premiumpress"); 
 }
 
 if($i == 0){
 	$title 	= __("No Membership Access","premiumpress"); 
 	$icon 	= "fa fa-users";
	$desc 	= __("Control access for users without a valid membership.","premiumpress");
 }
 
 if($icon == ""){ $icon = "fa fa-cog"; }
  
 if( $title == "" && $i > 0){ $i++; continue; } ?>
  
<a class="_admin_iconbox icon-box p-box" href="#" onclick="processShowPak(<?php echo $i; ?>)">
<i class="<?php echo $icon; ?>"></i><strong><?php echo $title; ?></strong><p><?php echo substr($desc,0,80); ?></p>
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
 

 $i=0; while($i < 11){ 
 
 
 $title = _ppt('mem'.$i.'_name');
 
 if(isset($_POST['addnewmembership']) && $_POST['addnewmembership'] == 1 && !isset($newSet) && $title == "" && $i != 0){
 $title = "&nbsp;";
 $newSet = 1;

 } 
  
 if( $title == "" && $i > 0){ $i++; continue; }
 
 
 ?>
<div class="card-memberships membership-box rounded-0 membership-<?php if(isset($newSet)){ echo "99"; }else{ echo $i; } ?>" style="display:none;">
  <div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
    <?php if($i != 0){ ?>
      <li class="nav-item mb-0"> <a class="nav-link active rounded-0" id="#taba<?php echo $i; ?>-tab" data-toggle="tab" href="#taba<?php echo $i; ?>" role="tab"><?php echo __("Basics","premiumpress"); ?></a> </li>
      
      <li class="nav-item mb-0"> <a class="nav-link" id="#tabb<?php echo $i; ?>-tab" onclick="jQuery('#customdisplay<?php echo  $i; ?>').show();" data-toggle="tab" href="#tabb<?php echo $i; ?>" role="tab"><?php echo __("Pricing Table","premiumpress"); ?></a> </li>
      <?php } ?>
      
      <li class="nav-item mb-0"> <a class="nav-link" id="#tabc<?php echo $i; ?>-tab" data-toggle="tab" onclick="jQuery('.savebar').show();" href="#tabc<?php echo $i; ?>" role="tab"><?php echo __("Features","premiumpress"); ?></a> </li>
      <?php if($i != 0){ ?>
      <li class="nav-item mb-0"> <a class="nav-link" id="#tabd<?php echo $i; ?>-tab" data-toggle="tab" href="#tabd<?php echo $i; ?>" role="tab"><?php echo __("Settings","premiumpress"); ?></a> </li>
      <?php } ?>
    </ul>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  <input type="hidden" id="enablemem<?php echo $i; ?>" name="admin_values[mem<?php echo $i; ?>_enable]" 
  value="<?php if(isset($_POST['addnewmembership']) && $_POST['addnewmembership'] == 1 && $title ==  "&nbsp;" ){ echo 1; }elseif($i ==0){ echo 1; }else{ echo _ppt('mem'.$i.'_enable'); }  ?>">
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="tab-content bg-white px-0">
      <div class="tab-pane fade show <?php if($i != 0){ ?>active<?php } ?>" id="taba<?php echo $i; ?>" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
        
        
         <?php if($i == 0){ ?>
           
         
           <?php }else{ ?>
        
          <div class="col-md-9">
          
           <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                   
                 <a href="javascript:void(0);" onclick="jQuery('#title_<?php echo $i; ?>_show').toggle();" class="btn btn-sm btn-system float-right mt-n1"><i class="fa fa-language"></i>
				 <?php echo __("Show Translations","premiumpress"); ?>
                 </a> 
                  
                  <?php } ?>
          
            <label><?php echo __("Display Name","premiumpress"); ?></label>
            
            <input type="text" style="height:50px !important;" name="admin_values[mem<?php echo $i; ?>_name]" id="<?php echo $i; ?>_name" value="<?php echo $title; ?>" class="form-control  mt-2">
         
         
         
         
         
               <?php /***********************************************************************/ ?>
                 
                 
				 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                    
         
                
                <div id="title_<?php echo $i; ?>_show" style="display:none;" >
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                  <div class="mt-3">
                    <label>
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      <?php echo $CORE->GEO("get_lang_name", $lang); ?> </label>
                      
                      
                       <input type="text" name="admin_values[mem<?php echo $i; ?>_name_<?php echo strtolower($lang); ?>]" value="<?php if(_ppt('mem'.$i.'_name_'.strtolower($lang)) == ""){ if(isset($paknames[$i]) ){ echo $paknames[$i]; }else{ echo ""; }  }else{ echo _ppt('mem'.$i.'_name_'.strtolower($lang)); } ?>" class="form-control ">       
                    
                  </div>
                  
                  <?php } ?>
                  
                  
                </div>
                <?php } ?>
                
                   <?php /***********************************************************************/ ?>   
         
         
         
         
         
         
         
         
          </div>
          <div class="col-md-3">
            <label class="btn-block"><?php echo __("Icon","premiumpress"); ?></label>
            <input type="hidden" name="admin_values[mem<?php echo $i; ?>_icon]"  id="mem<?php echo $i; ?>_icon"  value="<?php if(_ppt('mem'.$i.'_icon') == ""){ echo "fa fa-cog"; }else{ echo _ppt('mem'.$i.'_icon'); } ?>" />
            <i class="<?php if( _ppt('mem'.$i.'_icon')  != ""){ echo str_replace("fa fa ","fa ", _ppt('mem'.$i.'_icon') ); }else{ echo "fa fa-cog"; }  ?> fa-2x float-left mr-2 fa-1x border p-2" style="cursor:pointer; height:50px;" id="mem<?php echo $i; ?>_icon_icon" onclick="loadiconbox('mem<?php echo $i; ?>_icon','<?php if( _ppt('mem'.$i.'_icon') != ""){ echo _ppt('mem'.$i.'_icon'); }else{ echo "fa fa-cog"; }  ?>');"></i>
          </div>
          
          
          
          <div class="col-md-12 mt-4">
          
           <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?> 
                 
              
                 <a href="javascript:void(0);" onclick="jQuery('#desc_<?php echo $i; ?>_show').toggle();" class="btn btn-sm btn-system float-right mt-n1"><i class="fa fa-language"></i>
				 <?php echo __("Show Translations","premiumpress"); ?>
                 </a> 
                 
                 <?php } ?>
          
            <label class="btn-block"><?php echo __("Description","premiumpress"); ?></label>
            <textarea name="admin_values[mem<?php echo $i; ?>_desc]" class="form-control w-100 " style="min-height:100px;"><?php echo _ppt('mem'.$i.'_desc'); ?></textarea>
            <div class="small opacity-5 mt-2"><?php echo __("This is not displayed on all designs.","premiumpress"); ?></div>
          
          
          
            <?php /***********************************************************************/ ?>
                 
                 
				 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?> 
                 
               
         
                
                <div id="desc_<?php echo $i; ?>_show" style="display:none;" >
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                
                    <label class="mt-3">
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      <?php echo $CORE->GEO("get_lang_name", $lang); ?> </label>
                      
                      <textarea name="admin_values[mem<?php echo $i; ?>_desc_<?php echo strtolower($lang); ?>]" class="form-control " style="height:100px !important;"><?php if(_ppt('mem'.$i.'_desc_'.strtolower($lang)) == ""){ }else{ echo _ppt('mem'.$i.'_desc_'.strtolower($lang)); } ?></textarea>   
                    
                  
                  
                  <?php } ?> 
                  
                </div>
                <?php } ?>
                
                
                <?php /***********************************************************************/ ?>
          
          
          
          
          
          </div>
          <?php } ?>
          
          
        </div>
        <div class="row mt-4" style="<?php if($i == 0){ echo "display:none;";} ?>">
          <div class="col-md-4">
            <label><?php echo __("Price","premiumpress"); ?> <span class="required">*</span></label>
            <div class="input-group">
              <span class="input-group-prepend input-group-text rounded-0"><?php if(strpos( _ppt(array('currency','symbol')), "fa") === false){ echo hook_currency_symbol('');  }else{ echo '<i class="'._ppt(array('currency','symbol')).'"></i>'; } ?></span>
              <input type="text" name="admin_values[mem<?php echo $i; ?>_price]" value="<?php if(_ppt('mem'.$i.'_price') == ""){ echo $i*10; }else{ echo _ppt('mem'.$i.'_price'); } ?>" class="form-control val-numeric">
            </div>
          </div>
          <div class="col-md-4">
            <label class="txt500 mb-2"><?php echo __("Duration","premiumpress"); ?> (<?php echo __("days","premiumpress"); ?>)</label>
            <div class="input-group">
              <?php if(in_array(_ppt('mem'.$i.'_duration'), array(1,2,7,30,60,90,120,150,180,365) )){ ?>
              <select name="admin_values[mem<?php echo $i; ?>_duration]" class="form-control">
                <option value="1" <?php if(_ppt('mem'.$i.'_duration') == "1"){ echo 'selected=selected'; } ?>>24
                hours</option>
                <option value="2" <?php if(_ppt('mem'.$i.'_duration') == "2"){ echo 'selected=selected'; } ?>>48
                hours</option>
                <option value="7" <?php if(_ppt('mem'.$i.'_duration') == "7"){ echo 'selected=selected'; } ?>>1
                Week</option>
                <option value="30" <?php if(_ppt('mem'.$i.'_duration') == "30"){ echo 'selected=selected'; } ?>>1
                Month</option>
                <option value="60" <?php if(_ppt('mem'.$i.'_duration') == "60"){ echo 'selected=selected'; } ?>>2
                Months</option>
                <option value="90" <?php if(_ppt('mem'.$i.'_duration') == "90"){ echo 'selected=selected'; } ?>>3
                Months</option>
                <option value="120" <?php if(_ppt('mem'.$i.'_duration') == "120"){ echo 'selected=selected'; } ?>>4
                Months</option>
                <option value="150" <?php if(_ppt('mem'.$i.'_duration') == "150"){ echo 'selected=selected'; } ?>>5
                Months</option>
                <option value="180" <?php if(_ppt('mem'.$i.'_duration') == "180"){ echo 'selected=selected'; } ?>>6
                Months</option>
                <option value="365" <?php if(_ppt('mem'.$i.'_duration') == "365"){ echo 'selected=selected'; } ?>>1
                Year</option>
                <option value="99">Custom Duration</option>
              </select>
              <?php }else{ ?>
              <input type="text" name="admin_values[mem<?php echo $i; ?>_duration]"   class="form-control" value="<?php if(_ppt('mem'.$i.'_duration') == ""){ echo "30"; }else{ echo _ppt('mem'.$i.'_duration'); } ?>">
              <?php } ?>
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
              <div class="toggle <?php if( _ppt('mem'.$i.'_r') == '1'){  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_r" name="admin_values[mem<?php echo $i; ?>_r]" value="<?php echo _ppt('mem'.$i.'_r'); ?>">
          </div>
        </div> 
      
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
      </div>
      <div class="tab-pane fade" id="tabb<?php echo $i; ?>" role="tabpanel">
      
     
        <p class="opacity-5"><?php echo __("Customize the text displayed on the pricing table.","premiumpress"); ?></p>
       
      
      
        <!-- custom features -->
        <div class="row mb-4 mt-4" id="customdisplay<?php echo  $i; ?>" style="display:none;">
          <?php $f =1; while($f < 9){ ?>
          <div class="col-md-6 mb-4 border-bottom pb-4">
            <div class="position-relative">
              <input type="text" name="admin_values[mem<?php echo $i; ?>_txt<?php echo $f; ?>]" value="<?php if(_ppt('mem'.$i.'_txt'.$f) == ""){ echo ""; }else{ echo _ppt('mem'.$i.'_txt'.$f); } ?>" class="form-control" style="padding-left:45px !important;">
              <input type="hidden" name="admin_values[mem<?php echo $i; ?>_txt<?php echo $f; ?>_val]" id="mem<?php echo $i; ?>_txt<?php echo $f; ?>_val" value="<?php if(_ppt('mem'.$i.'_txt'.$f.'_val') == ""){ echo "1"; }?>" />
              <i class="fa <?php if(_ppt('mem'.$i.'_txt'.$f.'_val') != "0"){ ?>fa-check text-success<?php }else{ ?>fa-times text-danger<?php } ?> position-absolute" onclick="changeCheckB('mem<?php echo $i; ?>_txt<?php echo $f; ?>_val')" id="mem<?php echo $i; ?>_txt<?php echo $f; ?>_val_check" style="top:15px; left:15px; cursor:pointer;"></i>
            </div>
            
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            <div class="mt-1">
            <a href="javascript:void(0);" onclick="jQuery('#custom_<?php echo $i; ?>_show<?php echo $f; ?>').toggle();" class="btn btn-sm btn-system"><i class="fa fa-language"></i>
				 <?php echo __("Show Translations","premiumpress"); ?>
                 </a></div>
             <?php } ?>
            
            
            <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
            <div id="custom_<?php echo $i; ?>_show<?php echo $f; ?>" style="display:none;" >
              <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
              <div class="mt-3">
                <div class="mb-2 small">
                  <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">
                    &nbsp;
                  </div>
                  <?php echo $CORE->GEO("get_lang_name", $lang); ?>
                </div>
                <input type="text" name="admin_values[mem<?php echo $i; ?>_txt<?php echo $f; ?>_<?php echo strtolower($lang); ?>]" value="<?php if(_ppt('mem'.$i.'_txt'.$f.'_'.strtolower($lang)) == ""){ echo _ppt('mem'.$i.'_txt'.$f); }else{ echo _ppt('mem'.$i.'_txt'.$f.'_'.strtolower($lang)); } ?>" class="form-control">
              </div>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
          <?php  $f++; } ?>
        </div>
        <!-- end custom features -->
        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
      </div>
      <div class="tab-pane fade <?php if($i == 0){ ?>active show<?php } ?>" id="tabc<?php echo $i; ?>" role="tabpanel">
       
        <p class="opacity-5"><?php echo __("Choose which features belong to this membership.","premiumpress"); ?></p>
        
 
          <?php  foreach($memfeatures as $f){  ?>
          
          
          <div class="row py-3 border-top position-relative" id="fearow<?php echo $i; ?>_<?php echo $f['key']; ?>" >
           
 
           
            <div class="col-md-7 small">
            
              <div class="text-600 mb-2 fs-16"> <?php echo str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), $f['name'] ); ?>  </div>
             
             
              <?php if(isset($f['desc'])){ ?> <div class="opacity-5">  
          <?php echo $f['desc']; ?>
              </div><?php } ?>
           
              
              
              
            </div>
            <div class="col-md-5 text-center">
            
            <div class="d-flex" >
            
            	<div class="mr-3 y-middle">
				<?php if( _ppt('mem'.$i.'_'.$f['key'].'_hide') == "1" ){ ?><i class="fa fa-eye-slash text-warning"></i><?php }elseif( _ppt('mem'.$i.'_'.$f['key']) == "1" ){ ?><i class="fa fa-check text-success"></i><?php }else{ ?><i class="fa fa-times text-danger"></i> <?php } ?>
                
                </div>
            
                <select class="form-control" name="admin_values[mem<?php echo $i; ?>_<?php echo $f['key']; ?>]" onchange="HideFeature(this.value, '#mem<?php echo $i; ?>_<?php echo $f['key'].'_hide'; ?>add');">
                
                <option value="0"><?php echo __("Deny Access","premiumpress"); ?></option>
                
                <option value="1" <?php if( _ppt('mem'.$i.'_'.$f['key']) == "1" ){ ?>selected=selected<?php } ?>><?php echo __("Allow Access","premiumpress"); ?></option>
               
                <option value="99" <?php if( _ppt('mem'.$i.'_'.$f['key'].'_hide') == "1" ){ ?>selected=selected<?php } ?>><?php echo __("Disable Feature","premiumpress"); ?></option>
               
                </select>
                
                 
              <input type="hidden" name="admin_values[mem<?php echo $i; ?>_<?php echo $f['key'].'_hide'; ?>]" id="mem<?php echo $i; ?>_<?php echo $f['key'].'_hide'; ?>add" value="<?php 
			  
			  if( _ppt('mem'.$i.'_'.$f['key'].'_hide') == ""){ echo $f['hide_default']; }else{ echo _ppt('mem'.$i.'_'.$f['key'].'_hide'); } ?>">
            
            </div>
             
            
          
            </div>

            <?php if($f['key'] == "downloadsxxxxxxxxx"){ ?>
            
          <div class="col-md-5 mt-3">
              <label><?php echo __("Downloads","premiumpress"); ?></label>
              <div class="input-group">
              
                <input type="text" name="admin_values[mem<?php echo $i; ?>_downloads_count]" value="<?php if(_ppt('mem'.$i.'_downloads_count') == ""){ echo 0; }else{ echo _ppt('mem'.$i.'_downloads_count'); } ?>" class="form-control val-numeric">
              </div>
            </div>
            
            <?php }elseif($f['key'] == "listings"){ ?>
            
           
            <div class="col-md-5 mt-3">
              <div class="input-group">
              
                <input type="text" name="admin_values[mem<?php echo $i; ?>_listings_count]" value="<?php if(_ppt('mem'.$i.'_listings_count') == ""){ echo 0; }else{ echo _ppt('mem'.$i.'_listings_count'); } ?>" class="form-control val-numeric">
              </div>
            </div>
            
            <?php }elseif($f['key'] == "max_msg"){ ?>
        
            <div class="col-md-5 mt-3">
              <div class="input-group">
                
                <input type="text" name="admin_values[mem<?php echo $i; ?>_max_msg_count]" value="<?php if(_ppt('mem'.$i.'_max_msg_count') == ""){ echo 100; }else{ echo _ppt('mem'.$i.'_max_msg_count'); } ?>" class="form-control val-numeric">
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
          
          
    
        
        
        
        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
      </div>
      <div class="tab-pane fade" id="tabd<?php echo $i; ?>" role="tabpanel">
        <div class="row">
          <div class="col-md-3 mt-4">
            <label><?php echo __("Admin Approval","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_approval').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_approval').value='1'">
              </label>
              <div class="toggle <?php if( _ppt('mem'.$i.'_approval') == '1'){  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_approval" name="admin_values[mem<?php echo $i; ?>_approval]" value="<?php echo _ppt('mem'.$i.'_approval'); ?>">
          </div>
          <div class="col-md-8 mt-4">
            <div style="font-size:14px;">
              <?php echo __("If you want to manually approve user accounts after they purchase this membership enable this option. During the period of waiting for approval they will not be able to access any membership features.","premiumpress"); ?>
            </div>
          </div>
        </div>
        <hr  />
        <div class="row" style="<?php if($i == 0){ echo "display:none;";} ?>">
          <div class="col-md-3 mt-4">
            <label><?php echo __("Show After Purchase","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_repurchase').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_repurchase').value='1'">
              </label>
              <div class="toggle <?php if( in_array( _ppt('mem'.$i.'_repurchase'), array("","1")) ) {  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_repurchase" name="admin_values[mem<?php echo $i; ?>_repurchase]" value="<?php if(in_array(_ppt('mem'.$i.'_repurchase'), array("","1")) ){ echo 1; }else{ echo 0; } ?>">
          </div>
          
           
          
          
          
          <div class="col-md-8 mt-4">
            <div style="font-size:14px;">
              <?php echo __("Turn OFF to stop users who are currently subscribed to this plan from seeing this package when upgrading or buying a new membership.","premiumpress"); ?>
            </div>
          </div>
        </div>
        
        
        
         <hr  />
         
         
        <div class="row">
          <div class="col-md-3 mt-4">
            <label><?php echo __("Highlight","premiumpress"); ?> </label>
            <div class="formrow mt-2">
              <label class="radio off">
         
       
                      <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_highlight').value='0'">
                      </label>
                      <label class="radio on">
                      <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_highlight').value='1'">
                      </label>
                      <div class="toggle <?php if( _ppt('mem'.$i.'_highlight') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                      </div>
                    </div>
                    <input type="hidden" id="mem<?php echo $i; ?>_highlight" name="admin_values[mem<?php echo $i; ?>_highlight]" value="<?php if(_ppt('mem'.$i.'_highlight') == ""){ echo 0; }else{ echo _ppt('mem'.$i.'_highlight'); } ?>">
                  
                
         
          </div>
          <div class="col-md-8 mt-4">
            <div style="font-size:14px;">
              <?php echo __("This will display a solid background within the pricing table display.","premiumpress"); ?>
            </div>
          </div>
        </div>
  
                 
        
        
        
        
        <hr  />
        <div class="row" style="<?php if($i == 0){ echo "display:none;";} ?>">
          <div class="col-md-3 mt-4">
            <label><?php echo __("Hide Package","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_hideme').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_hideme').value='1'">
              </label>
              <div class="toggle <?php if( in_array( _ppt('mem'.$i.'_hideme'), array("1")) ) {  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_hideme" name="admin_values[mem<?php echo $i; ?>_hideme]" value="<?php if(in_array(_ppt('mem'.$i.'_hideme'), array("","0")) ){ echo 0; }else{ echo 1; } ?>">
          </div>
          <div class="col-md-8 mt-4">
            <div style="font-size:14px;">
              <?php echo __("Turn ON to hide the package from the package selection pages. This will stop new users from being able to purchase this package but all old users to continue using it.","premiumpress"); ?>
            </div>
          </div>
        </div>
        
        
        <hr  />
        <div class="row" style="<?php if($i == 0){ echo "display:none;";} ?>">
          <div class="col-md-3 mt-4">
            <label><?php echo __("Show Badge","premiumpress"); ?></label>
            <div class="formrow mt-2">
              <label class="radio off">
              <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('mem<?php echo $i; ?>_badge').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('mem<?php echo $i; ?>_badge').value='1'">
              </label>
              <div class="toggle <?php if( in_array( _ppt('mem'.$i.'_badge'), array("1")) ) {  ?>on<?php } ?>">
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
            <input type="hidden" id="mem<?php echo $i; ?>_badge" name="admin_values[mem<?php echo $i; ?>_badge]" value="<?php if(in_array(_ppt('mem'.$i.'_badge'), array("","0")) ){ echo 0; }else{ echo 1; } ?>">
          </div>
          <div class="col-md-8 mt-4">
            <div style="font-size:14px;">
              <?php echo __("This will try to display the package icon next to the users name as a badge.","premiumpress"); ?>
            </div>
          </div>
        </div>


<hr />
        
              <div class="py-4 small">
              
              <strong><?php echo __("Restricting Page Content","premiumpress"); ?> <span class="float-right badge badge-primary lead">This ID: <?php echo $i; ?></span></strong>
              
              <p class="mt-3"><?php echo __("Restrict content within your WordPress pages using the shortcode below.","premiumpress"); ?></p>
              
              <textarea class="form-control w-100" style="height:50px !important; padding-top:10px !important;">[MEMBERSHIP show="<?php echo $i; ?>"]my restricted content here[/MEMBERSHIP]</textarea>
              
              </div>
        
        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
      </div>
    </div>
  </div> 

        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


<?php if( ( isset($_POST['addnewmembership']) && $_POST['addnewmembership'] == 1)  || $i == 0){}else{ ?>
<div class="container mb-4 pakstats-<?php echo $i; ?>">
<div class="row no-gutters">

<div class="col-md-6">


    <div class="" style="border-radius: 0px; overflow:hidden; background: #6a6a6a url('<?php echo CDN_PATH; ?>images/bars3.png') bottom left; background-size:cover; ">
            <div class="card-body position-relative p-2 pl-4">
           
              <div class="text-white h1"><?php echo $CORE->USER("count_orders_per_membership", $i); ?></div>
     		
            <a href="admin.php?page=orders&memid=<?php echo $i; ?>" class="btn float-right btn-system btn-sm font-weight-bold text-uppercase tiny " target="_blank"><?php echo __("view","premiumpress"); ?></a>
             
            
              <div class="text-white"><?php echo __("Orders Found","premiumpress"); ?></div>
            </div>
          </div>
    
</div>

<div class="col-md-6">


    <div class="" style="border-radius: 0px; overflow:hidden; background: #0866c6 url('<?php echo CDN_PATH; ?>images/bars2.png') bottom left; background-size:cover; ">
            <div class="card-body position-relative p-2 pl-4">
           
              <div class="text-white h1"><?php echo $CORE->USER("count_users_per_membership", $i); ?></div>
      
              <a href="admin.php?page=members&memid=<?php echo $i; ?>" class="btn float-right btn-system btn-sm font-weight-bold text-uppercase tiny " target="_blank"><?php echo __("view","premiumpress"); ?></a>
              
              <div class="text-white"><?php echo __("Total Subscribers","premiumpress"); ?></div>
             
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
  <div class=" p-3 savebar">


<button type="submit" data-ppt-btn class="btn-primary font-weight-bold "><?php echo __("Save Changes","premiumpress"); ?></button>

  <?php if($i > 0){ ?>  <a href="javascript:void(0);" data-ppt-btn onclick="DeleteMembership(<?php echo $i; ?>);" class="btn-system float-right tiny font-weight-bold mt-2"><i class="fa fa-trash mr-2"></i><?php echo __("Delete","premiumpress"); ?></a>  <?php } ?>
</div>
        
  
  
</div>
<?php $i++; }
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 ?>
   </div> 
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 ?>
<script>

function DeleteMembership(id){

jQuery("#enablemem"+id).val(0);
jQuery("#"+id+"_name").val('');
jQuery(".membership-"+id).fadeToggle();
jQuery("#admin_save_form").submit();
 
}

  
		function ChekME(div){
		
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		
			function ChekMEHide(div){
		
			if (jQuery(div+'checkhide').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
		
function HideFeature(val, div){
 
	if(val == "99"){
	jQuery(div).val(1);
	}else{
	jQuery(div).val(0);
	}

}
		
function changeCheckB(div){
			
			if (jQuery('#'+div+'_check').hasClass('fa-check')) {			
				jQuery('#'+div).val(0);	
				jQuery('#'+div+'_check').removeClass('fa-check text-success').addClass('fa-times text-danger');		
			}else{			
				jQuery('#'+div).val(1);	
				jQuery('#'+div+'_check').removeClass('fa-times text-danger').addClass('fa-check text-success');	
			}
					
				
}
</script>