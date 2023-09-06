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

global $wpdb, $CORE, $CORE_ADMIN;


// GET LANGUAGES
$langs = _ppt('languages');
 
?>
 
  
 
 <div class="col-12 border-bottom py-3 px-0">
  <div class="row">
    <div class="col-md-8">
      <label><?php echo __("Sidebar Menu","premiumpress"); ?></label>
      <p class="pb-0 btn-block text-muted mb-0 mt-2"><?php echo __("The sidebar menu is edited within the WordPress menu area.","premiumpress"); ?></p>
    </div>
    <div class="col-md-4">
      <div class="input-group mb-2">
      
         <a href="nav-menus.php" class="btn btn-system color2"><?php echo __("Edit Menu","premiumpress"); ?></a>
         
      </div>
    </div>
  </div>
</div>
 
 
 
 
 <div class="col-12 border-bottom py-3 px-0">
  <div class="row">
    <div class="col-md-8">
      <label><?php echo __("Footer Mobile Menu","premiumpress"); ?></label>
      <p class="pb-0 btn-block text-muted mb-0 mt-2"><?php echo __("Turn on/off the footer mobile menu.","premiumpress"); ?></p>
    </div>
    <div class="col-md-4">
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" value="off" onchange="document.getElementById('footer_mobile_menu').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle" value="on" onchange="document.getElementById('footer_mobile_menu').value='1'">
            </label>
            <div class="toggle <?php if( _ppt('footer_mobile_menu') == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="footer_mobile_menu" name="admin_values[footer_mobile_menu]"  value="<?php if(_ppt('footer_mobile_menu') == ""){ echo 1; }else{ echo _ppt('footer_mobile_menu'); } ?>">
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
 
<?php if(_ppt(array('lst','websitepackages')) == "1"){ ?>
  
 <div class="col-12 border-bottom py-3 px-0">
  <div class="row">
    <div class="col-md-8">
      <label><?php echo __("Show Add Button","premiumpress"); ?></label>
      <p class="pb-0 btn-block text-muted mb-0 mt-2"><?php echo __("Turn on/off the add new button on your mobile menu","premiumpress"); ?></p>
    </div>
    <div class="col-md-4">
      <div class="input-group mb-2">
        <div class="formrow">
          <div class="">
            <label class="radio off" style="display: none;">
            <input type="radio" name="toggle" value="off" onchange="document.getElementById('mobileadd').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle" value="on" onchange="document.getElementById('mobileadd').value='1'">
            </label>
            <div class="toggle <?php if( in_array(_ppt(array('mobile_menu','add')), array('1',""))){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
            <input type="hidden" id="mobileadd" name="admin_values[mobile_menu][add]"  value="<?php if(_ppt(array('mobile_menu','add')) == ""){ echo 1; }else{ echo _ppt(array('mobile_menu','add')); } ?>">
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
 
 
<?php } ?>
 
 
            
 
 
 
<div class="clearfix btn-block my-4">

  <div class="row mb-2">
  
   <div class="col-md-1 pr-0 small text-muted">  <?php echo __("Icon","premiumpress"); ?>  </div> 
  
    <div class="col-md-5 small text-muted"> <?php echo __("Display Caption","premiumpress"); ?> </div>    
   
    <div class="col-md-5 small text-muted"> <?php echo __("Link","premiumpress"); ?> </div>
   
    <div class="col-md-1 small text-muted px-0"> <?php echo __("Big","premiumpress"); ?>
     
   
<div class="badge_tooltip text-center" data-direction="top" style="display:inline-block;">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle"></i> </div>
    <div class="badge_tooltip__item"><?php echo __("This will display as a big icon with the primary background color and no text.","premiumpress"); ?></div>
  </div>
  
 
         
    
     </div>
       
    </div>
    
  </div>
  
  <hr />
  
<?php


$defaults = array( 
	
	1 => array(
		"n" => __("Home","premiumpress"),
		"i" => "fal fa-house",
		"l" => home_url(),
		"b" => 0,
	),
	2 => array(
		"n" => __("Search","premiumpress"),
		"i" => "fal fa-search",
		"l" => home_url()."/?s=",
		"b" => 0,
	),	
	3 => array(
		"n" => "", //__("Chat","premiumpress"),
		"i" => "fa fa-plus",
		"l" => "[add]",//_ppt(array('links','myaccount'))."/?showtab=messages",
		"b" => 1,
	),
	4 => array(
		"n" => "",
		"i" => "fa fa-users-crown",
		"l" => "[login]",
		"b" => 0,
	),	
	5 => array(
		"n" => "Blog",
		"i" => "fal fa-sparkles",
		"l" => _ppt(array('links','blog')),
		"b" => 0,
	),		
		
);

$i=1;
while($i < 6){

$menu_id = $i;



?>
<div class="row mt-2">


  
     <div class="col-md-1" >
            
     
      <input type="hidden" name="admin_values[mobilemenuicon][<?php echo $menu_id; ?>]" id="tax_icon_<?php echo $menu_id; ?>"  value="<?php if(_ppt(array('mobilemenuicon', $menu_id)) != ""){ echo _ppt(array('mobilemenuicon', $menu_id)); }else{ echo $defaults[$menu_id]["i"]; }  ?>" />
     
      <i class="<?php if(_ppt(array('mobilemenuicon', $menu_id)) != ""){ echo str_replace("fa fa ","fa ",_ppt(array('mobilemenuicon', $menu_id))); }else{ echo "fa fa-cog"; }  ?> float-left mr-2 fa-1x border p-2" style="cursor:pointer;" id="tax_icon_<?php echo $menu_id; ?>_icon" onclick="loadiconbox('tax_icon_<?php echo $menu_id; ?>','<?php if(_ppt(array('mobilemenuicon', $menu_id)) != ""){ echo _ppt(array('mobilemenuicon', $menu_id)); }else{ echo "fa fa-cog"; }  ?>');"></i>
      
      
     </div>
      
      
      
  
    <div class="col-md-5">
    
    
      <input class="form-control small" name="admin_values[mobilemenucaption][<?php echo $menu_id; ?>]"  value="<?php if(_ppt(array('mobilemenucaption', $menu_id)) != ""){ echo _ppt(array('mobilemenucaption', $menu_id)); }else{ echo $defaults[$menu_id]["n"]; }  ?>" />
     
      <div class="mt-1">
      
      
       <?php if(is_array($langs) && !empty($langs) && count($langs) > 1   ){  ?>
      <a href="javascript:void(0);" onclick="jQuery('.showtaxtranslations<?php echo str_replace(" ","-",$menu_id); ?>').toggle();" class="tiny"><?php echo __("Show translations","premiumpress"); ?></a> 
       
       <?php } ?>  
      
      </div>
       
          
      
 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                <div id="" class="p-3 py-2 bg-light mt-3 showtaxtranslations<?php echo str_replace(" ","-",$menu_id); ?>" style="display:none;">
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                  <div class="mt-3">
                    <div class="mb-2 small">
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      <?php echo $CORE->GEO("get_lang_name", strtolower($lang)); ?>   </div>
                   
                   <input class="form-control small" name="admin_values[mobilemenucaption_<?php echo strtolower($lang); ?>][<?php echo $menu_id; ?>]" 
                    value="<?php if(_ppt(array('mobilemenucaption_'.strtolower($lang), $menu_id)) != ""){ echo _ppt(array('mobilemenucaption_'.strtolower($lang), $menu_id)); }else{ echo $defaults[$menu_id]["n"]; }  ?>" />
                   
                  </div>
                 
                  <?php } ?>
                </div>
<?php } ?>
      
      
      
      
      
    </div>
     
    
    
     <div class="col-md-5">
     
     
     <div class="position-relative">
      <input class="form-control small" style="font-size:11px !important;" name="admin_values[mobilemenulink][<?php echo $menu_id; ?>]"  value="<?php if(_ppt(array('mobilemenulink', $menu_id)) != ""){ echo _ppt(array('mobilemenulink', $menu_id)); }else{ echo $defaults[$menu_id]["l"]; }  ?>" id="mol<?php echo $menu_id; ?>" />
      
      <span class="input-group-addon" style="top: 10px;    right: 10px;    position: absolute;    z-index: 100;"> <a href="javascript:void(0);" onclick="jQuery('.sel-<?php echo $menu_id; ?>').toggle()"> <span class="fal fa-file"></span></a> </span>
      
      </div>
      
      
        <select class="form-control-sm mt-2 border-0 bg-light sel-<?php echo $menu_id; ?>" onchange="jQuery('#mol<?php echo $menu_id; ?>').val(this.value)" style="display:none;">
       <option><?php echo __("Page Shortcodes","premiumpress"); ?></option>
       <?php
	   
	   $shortcodes = array("[menu]","[add]", "[login]", "[search]","[categories]" ); //"[cart]","[stores]", 
	   
	   foreach($shortcodes as $p){
	   ?>
       <option><?php echo $p; ?></option>
       <?php } ?>
       </select>
       
      </div> 
      
      
      <div class="col-md-1">
      	
        <?php
		
		$val = 0;
		if(_ppt(array('mobilemenulink', $menu_id)) != ""){ 
		$val = _ppt(array('mobilemenubig', $menu_id)); 
		}else{ 
		$val = $defaults[$menu_id]["b"]; 
		} 
		
		?>
        
        <input type="checkbox" name="admin_values[mobilemenubig][<?php echo $menu_id; ?>]" <?php if($val){ echo "checked=checked"; } ?> value="1" />
      
      </div>   
    
 
 </div> 
<?php $i++; } ?>
  

<input style="display:none;" type="checkbox" name="admin_values[mobilemenubig][0]" value="0" checked="checked" />



<hr />

<div class="mb-4 text-600"><?php echo __("Preview","premiumpress"); ?></div>

<?php 


$GLOBALS['show-mobilemenu'] = 1; 
_ppt_template( 'footer', 'mobilemenu' );  ?>
      