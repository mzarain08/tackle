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

global $CORE, $settings;
  
  $settings = array(
  
  "title" => __("Badges","premiumpress"), 
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create your own badges and add them to selected %s.","premiumpress")), 
  "back" => "overview"
  
  );
  
  
$current_data = array();
 
$current_data = get_option("ppt_badges"); 
if(!is_array($current_data)){ $current_data = array(); }
 
_ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
<div class="card card-admin">
  <div class="card-body">
   
<?php /*
<textarea style="height:400px; width:100%;"><?php
echo "badges = array(";
foreach($current_data as $k => $v){

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
	 
} echo ");"; ?></textarea>*/ ?>
    
  
    <div class="clearfix"> <a href="javascript:void(0);" onClick="jQuery('#ppt_badge_clone .ff999').clone().insertAfter('#ppt_faq_list');jQuery('.badgerow').hide();jQuery('.savemenades').show();" class="btn btn-system btn-md"><i class="fa fa-plus"></i> <?php echo __("Add Badge","premiumpress") ?></a> </div>
    <div id="ppt_faq_list"><div class="topdiv"></div>
      <?php 
 


if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ 

if($current_data['name'][$i] !=""){

if(!isset($current_data['icon'][$i])){ $current_data['icon'][$i] = "fa fa-heart"; }
if(!isset($current_data['color'][$i])){ $current_data['color'][$i] = "#efefef"; }
if( $current_data['color'][$i] == ""){  $current_data['color'][$i] = "#ffffff"; } 
if(!isset($current_data['txtcolor'][$i])){ $current_data['txtcolor'][$i] = "#000000"; }
if(!isset($current_data['key'][$i])){ $current_data['key'][$i] = rand(0,999999); }
if(!isset($current_data['search'][$i])){ $current_data['search'][$i] = 0; }
 
 ?>
      <div id="faq_<?php echo $i; ?>" class="badgerow">
        <div class="p-4 mb-4  border mt-4">
          <div class="row">
          
           <div class="col-md-4">
           
            <label class="btn-block"><?php echo __("Sample","premiumpress"); ?></label>


<div class="ppt-badges mt-0">
            
<div class="_badge" style="<?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>color:<?php echo $current_data['txtcolor'][$i]; ?>;<?php } ?><?php if(isset($current_data['color'][$i]) && strlen($current_data['color'][$i]) > 1){ ?>background-color:<?php echo $current_data['color'][$i]; ?>;<?php } ?>"> 
    
    
    <?php if(isset($current_data['desc'][$i]) && strlen($current_data['desc'][$i]) > 1){ ?>
    
<div class="badge_tooltip text-center" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> <?php echo $current_data['name'][$i]; ?>
    </div>
    <div class="badge_tooltip__item"><?php echo $current_data['desc'][$i]; ?> </div>
  </div>
  
  <?php }else{ ?>
  <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> 
  <?php echo $current_data['name'][$i]; ?>
  <?php } ?>

</div>
           
            </div>
           
           </div>
           
               <div class="col-md-2">
            <label class="btn-block"><?php echo __("Icon","premiumpress"); ?></label>
           
            <input type="hidden" name="ppt_badges[icon][]"  id="badge<?php echo $i; ?>_icon"  value="<?php if($current_data['icon'][$i]== ""){ echo "fa fa-cog"; }else{ echo $current_data['icon'][$i]; } ?>" />
            
            
            <i class="<?php if( $current_data['icon'][$i] != ""){ echo str_replace("fa fa ","fa ", $current_data['icon'][$i] ); }else{ echo "fa fa-cog"; }  ?> fa-2x float-left mr-2 fa-1x border p-2" style="cursor:pointer; height:50px;" id="badge<?php echo $i; ?>_icon_icon" onclick="loadiconbox('badge<?php echo $i; ?>_icon','<?php if( $current_data['icon'][$i] != ""){ echo $current_data['icon'][$i]; }else{ echo "fa fa-cog"; }  ?>');"></i>
          </div>
          
          
          
       
           <div class="col-md-2">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Bg Color","premiumpress") ?></p>
             
             <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-4 border mr-2" style="height: 45px;">&nbsp;</span>
              <input type="text" name="ppt_badges[color][]"  value="<?php echo $current_data['color'][$i]; ?>" autocomplete="off" style="display:none;">
            </div>
             </div>
             
              <div class="col-md-3">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Text Color","premiumpress") ?></p>
             
             <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-4 border mr-2" style="height: 45px;">&nbsp;</span>
              <input type="text" name="ppt_badges[txtcolor][]"  value="<?php echo $current_data['txtcolor'][$i]; ?>" autocomplete="off" style="display:none;">
            </div>
           
                  </div>
             
             
                
          
          
            <div class="col-md-6">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="ppt_badges[name][]" id="faq_title_<?php echo $i; ?>" value="<?php echo $current_data['name'][$i]; ?>" class="form-control rounded-0"  />
            </div>
            
            
            
             
            
                <div class="col-md-6 mt-4">
             
       
     

 <input type="hidden" name="ppt_badges[search][]" id="b<?php echo $i; ?>add" value="<?php if( $current_data['search'][$i] == 1 ){  echo 1; }else{ echo 0; } ?>" class="form-control">
        
 
           
                 </div> 
                 
                 
                 <div class="col-md-12">
              <p class="text-uppercase font-weight-bold text-dark small mt-2"><?php echo __("Description Text ","premiumpress") ?></p>
              <input type="text" name="ppt_badges[desc][]" id="faq_desc_<?php echo $i; ?>" value="<?php if(isset($current_data['desc'][$i])){ echo $current_data['desc'][$i]; } ?>" class="form-control rounded-0"  />
          
          
             
        <label class="custom-control custom-checkbox mt-2">
        <input onclick="ChekBadge('#b<?php echo $i; ?>');" id="b<?php echo $i; ?>check"  type="checkbox" value="1" class="custom-control-input form-control"  <?php if($current_data['search'][$i] == 1){ echo "checked=checked"; } ?> />
         <a href="javascript:void(0);" onClick="jQuery('#faq_title_<?php echo $i; ?>').val('');jQuery('#faq_<?php echo $i; ?>').fadeToggle();" class="btn btn-system btn-sm float-right"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> 
     
        <span class="custom-control-label"><?php echo __("Show on search card.","premiumpress") ?></span> </label>
   
</div>
          
          
            </div>
            
            
          </div>
          <div class="clearfix"></div>
      </div>
      
      
        <input type="hidden" name="ppt_badges[key][]"  id="badge<?php echo $i; ?>_key"  value="<?php echo $current_data['key'][$i];  ?>" />
           
      
      <?php } $i++; } } ?>
    </div>
 
      <div id="ppt_badge_clone" style="display:none">
      
      <div class="ff999">
        <div class="p-4 mb-4  border mt-4">
          <div class="row">
            <div class="col-md-12">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="ppt_badges[name][]" value="" class="form-control rounded-0"  />
            </div> 
           
          </div>
          <div class="clearfix"></div>
          <a href="admin.php?page=listingsetup&lefttab=b" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> 
          
          </div>
      </div> 
    </div>
 
    
    
    
    <div class="p-4 bg-light text-center mt-4 savemenades" <?php if(empty($current_data['key'])){ ?>style="display:none;"<?php } ?>>
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
 <script>
function ChekBadge(div){
		 
			if (jQuery(div+'check').is(':checked')) {			
				jQuery(div+'add').val(1);			
			}else{			
				jQuery(div+'add').val(0);
			}
		
		}
</script>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


 <?php 
  $settings = array(
  
  "title" => __("Enable Badges","premiumpress"), 
  
  "desc" =>  __("You can turn off while you create badges and turn on when you're ready.","premiumpress") ,
    
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>



 

<div class="card card-admin">
  <div class="card-body">

 
    <div class="container px-0">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Show Badges","premiumpress"); ?></label>
          <p class="text-muted"><?php echo  __("Turn ON to show badges on your website.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('enable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('enable').value='1'">
            </label>
            <div class="toggle <?php  if(in_array(_ppt(array('badges', 'enable' )), array("","1")) ){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="enable" name="admin_values[badges][enable]" value="<?php  if(in_array(_ppt(array('badges', 'enable' )), array("","1")) ){ echo 1; }else{ echo _ppt(array('badges', 'enable' )); } ?>">
        </div>
      </div>
    </div>
    
      
           <hr />
 <a href="admin.php?page=listingsetup&reinstallbadges=1" class="mt-1 btn-system btn-sm confirm"><i class="fal fa-sync mr-2"></i> <?php echo __("reset to default badges","premiumpress"); ?></a>
   
   
   
   <div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    	</div>

    
  </div>
</div>
 
<?php if(isset($_GET['reinstallbadges'])){ ?>
<script>
jQuery(document).ready(function () {
 
window.location.href = "<?php echo home_url(); ?>/wp-admin/admin.php?page=listingsetup&lefttab=b";

});
 
</script>
<?php } ?> 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>