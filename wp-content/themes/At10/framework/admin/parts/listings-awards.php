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
  
  "title" => __("Awards","premiumpress"), 
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","2")), __("Create your own awards and add them to the sidebar of selected %s.","premiumpress")), 
  "back" => "overview"
  
  );
  
  
$current_data = array();
 
$current_data = get_option("ppt_awards"); 
if(!is_array($current_data)){ $current_data = array(); }
 
_ppt_template('framework/admin/_form-wrap-top' );
   
    ?>
<div class="card card-admin">
  <div class="card-body">
   
<?php /*
<textarea style="height:400px; width:100%;"><?php
echo "awards = array(";
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
    
  
    <div class="clearfix"> <a href="javascript:void(0);" onClick="jQuery('#ppt_award_clone .ff999').clone().insertAfter('#ppt_award_list');jQuery('.badgerow').hide();jQuery('.savemeawarsds').show();" class="btn btn-system btn-md"><i class="fa fa-plus"></i> <?php echo __("Add Badge","premiumpress") ?></a> </div>
    <div id="ppt_award_list"><div class="topdiv"></div>
      <?php 
 


if( !empty($current_data) ){ $i=0; foreach($current_data['name'] as $data){ 

if($current_data['name'][$i] !=""){

if(!isset($current_data['icon'][$i])){ $current_data['icon'][$i] = "fa fa-heart"; }
if(!isset($current_data['color'][$i])){ $current_data['color'][$i] = "#000000"; }
if(!isset($current_data['key'][$i])){ $current_data['key'][$i] = rand(0,999999); }

$unqiueID = "aaw".rand(0,999999);


 ?>
      <div id="award_<?php echo $i; ?>" class="badgerow">
        <div class="p-4 mb-4  border mt-4">
          <div class="row">
          
           <div class="col-md-2">
           
            <label class="btn-block"><?php echo __("Sample","premiumpress"); ?></label>
           <div class="ppt-awards mt-0">
            
<div class="_award" style="border-color:<?php echo $current_data['color'][$i]; ?>">
    
<div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal <?php echo $current_data['icon'][$i]; ?>" style="color:<?php echo $current_data['color'][$i]; ?>"></i>
    </div>
    <div class="badge_tooltip__item"><?php echo $current_data['name'][$i]; ?> </div>
  </div>

</div>
           
            </div>
           
           </div>
           
               <div class="col-md-2">
            <label class="btn-block"><?php echo __("Icon","premiumpress"); ?></label>
           
            <input type="hidden" name="ppt_awards[icon][]"  id="badge<?php echo $unqiueID.$i; ?>_icon"  value="<?php if($current_data['icon'][$i]== ""){ echo "fa fa-cog"; }else{ echo $current_data['icon'][$i]; } ?>" />
            
            
            <i class="<?php if( $current_data['icon'][$i] != ""){ echo str_replace("fa fa ","fa ", $current_data['icon'][$i] ); }else{ echo "fa fa-cog"; }  ?> fa-2x float-left mr-2 fa-1x border p-2" style="cursor:pointer; height:50px;" id="badge<?php echo $unqiueID.$i; ?>_icon_icon" onclick="loadiconbox('badge<?php echo $unqiueID.$i; ?>_icon','<?php if( $current_data['icon'][$i] != ""){ echo $current_data['icon'][$i]; }else{ echo "fa fa-cog"; }  ?>');"></i>
          </div>
          
            <div class="col-md-6">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="ppt_awards[name][]" id="award_title_<?php echo $i; ?>" value="<?php echo $current_data['name'][$i]; ?>" class="form-control rounded-0"  />
            </div>
            
           <div class="col-md-2">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Color","premiumpress") ?></p>
             
             <div class="input-group myColorPicker"> <span class="input-group-addon myColorPicker-preview px-4 border mr-2" style="height: 45px;">&nbsp;</span>
              <input type="text" name="ppt_awards[color][]"  value="<?php echo $current_data['color'][$i]; ?>" autocomplete="off" style="display:none;">
            </div>
             
             
            </div>
                 </div>
    
 
<div class="col-12 mt-4">
 <a href="javascript:void(0);" onClick="jQuery('#award_title_<?php echo $i; ?>').val('');jQuery('#award_<?php echo $i; ?>').fadeToggle();" class="btn btn-system btn-sm float-right"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> 
            
 </div>
            
            
            
            
            
          </div>
          <div class="clearfix"></div>
      </div>
      
      
        <input type="hidden" name="ppt_awards[key][]"  id="badge<?php echo $i; ?>_key"  value="<?php echo $current_data['key'][$i];  ?>" />
           
      
      <?php } $i++; } } ?>
    </div>
 
      <div id="ppt_award_clone" style="display:none">
      
      <div class="ff999">
        <div class="p-4 mb-4  border mt-4">
          <div class="row">
            <div class="col-md-12">
              <p class="text-uppercase font-weight-bold text-dark small"><?php echo __("Title","premiumpress") ?></p>
              <input type="text" name="ppt_awards[name][]" value="" class="form-control rounded-0"  />
            </div> 
           
          </div>
          <div class="clearfix"></div>
          <a href="admin.php?page=listingsetup&lefttab=b" class="btn btn-system btn-md mt-2"><i class="fa fa-trash"></i> <?php echo __("Delete","premiumpress") ?></a> 
          
          </div>
      </div> 
    </div>
 
  
    <div class="p-4 bg-light text-center mt-4 savemeawarsds" <?php if(empty($current_data['key'])){ ?>style="display:none;"<?php } ?>>
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
 
 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


 <?php 
  $settings = array(
  
  "title" => __("Enable awards","premiumpress"), 
  
  "desc" =>  __("You can turn off while you create awards and turn on when you're ready.","premiumpress") ,
    
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>



 

<div class="card card-admin">
  <div class="card-body">

 
    <div class="container px-0">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Show awards","premiumpress"); ?></label>
          <p class="text-muted"><?php echo  __("Turn ON to show awards on your website.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('enableaw').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('enableaw').value='1'">
            </label>
            <div class="toggle <?php  if(in_array(_ppt(array('awards', 'enable' )), array("","1")) ){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="enableaw" name="admin_values[awards][enable]" value="<?php  if(in_array(_ppt(array('awards', 'enable' )), array("","1")) ){ echo 1; }else{ echo _ppt(array('awards', 'enable' )); } ?>">
        </div>
      </div>
    </div>
    
      
           <hr />
 <a href="admin.php?page=listingsetup&reinstallawards=1" class="mt-1 btn-system btn-sm confirm"><i class="fal fa-sync mr-2"></i> <?php echo __("reset to default awards","premiumpress"); ?></a>
   
   
   
   <div class="p-4 bg-light text-center mt-4">
         <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    	</div>

    
  </div>
</div>
 
<?php if(isset($_GET['reinstallawards'])){ ?>
<script>
jQuery(document).ready(function () {
 
window.location.href = "<?php echo home_url(); ?>/wp-admin/admin.php?page=listingsetup&lefttab=aw";

});
 
</script>
<?php } ?> 
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>