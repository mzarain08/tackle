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

global $CORE, $post, $userdata, $CORE_UI, $new_settings; 

$elementor = 0;

$fieldsData = ppt_theme_card_data('defaults');
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
if(isset($new_settings['card_top_style'])){

	$elementor = 1;

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
foreach($fieldsData as $k => $f){
	
	if($elementor == 1 || ( $elementor == 0 && isset($f['show']) && in_array("mobile", $f['show'] ) ) ){
	
	
	if(isset($f['special'])){ 
	
	echo $f['data'];
	
	}else{ 
	
	$value = $f['data']; 
	
	if($elementor == "1" && $value == ""){
		if(isset($f['example'])){
		$value = $f['example'];
		}else{
		$value = "{user data}";
		}
	}	
	 
 
	$label = "";
	if(isset($f['label'])){ $label = $f['label']; }
	
	if($value == "" && $label == ""){ continue; }
	
	if(isset($f['type']) && $f['type'] == "price" && $value == "0"){ continue; }
	 
	if(strpos(strtolower($value), "no category") !== false ){ continue; }
 	
	
	if(isset($f['tooltip'])){ ?> 
        
    <li>    
 	<span>
        <div class="badge_tooltip text-center" data-direction="top">
            <div class="badge_tooltip__initiator"> 
               <span> <?php if(isset($f['label'])){ echo $f['label']; } ?>  <?php if(isset($f['icon-svg'])){ ?> <span ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg[$f['icon-svg']];?></span><?php } ?> <?php echo $value; ?> </span>
            </div>
            <div class="badge_tooltip__item"><?php echo $f['tooltip']; ?></div>
        </div> 
     </span>
     </li>    
   <?php }else{ ?>
    
    <li> 
    <span class="<?php if(isset($f['css']) ){ echo $f['css']; } ?> <?php if(isset($f['type']) && $f['type'] == "price"){ echo $CORE->GEO("price_formatting",array()); } ?>">
	<?php echo $label; ?>  <?php if(isset($f['icon-svg'])){ ?> <span ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg[$f['icon-svg']];?></span><?php } ?> <?php echo $value; ?>
    
    </span>
	</li> 
	<?php
	
	}
	 
	} 
	
	}
}
?>