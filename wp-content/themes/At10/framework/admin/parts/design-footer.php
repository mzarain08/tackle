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

global $CORE, $CORE_UI, $settings; 

 // GET LANGUAGES
$langs = _ppt('languages');

// GET ELEMENT PAGES
$elementorArray = $GLOBALS['elementor_page_templates'];
  
// PAGE LINKS ARRAY
$pages = $GLOBALS['core_page_templates'];

// DESIGN
$footer_design = _ppt(array('design','footer_style'));

?>

<style>

.btn-elementor {    background: #ba225f!important;    color: #fff!important; }
</style>

<div id="footerDesign">

<nav ppt-nav="" class="sepetator pl-0">
  <ul>
    <li>
      <div class="fs-md text-600">
        <?php echo __("Footer Design","premiumpress"); ?>
      </div>
      <div class="mt-2 opacity-8">
        <?php echo __("Choose the footer design for your website.","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="#" onclick="switchFooterSettings();" class="btn-primary btn-lg" data-ppt-btn=""> <span><?php echo __("Settings","premiumpress"); ?></span> </a> </li>
 
     <li> <a href="#" onclick="switchFooterElementor();" class="btn-elementor btn-lg" data-ppt-btn=""> <span><?php echo __("Elementor","premiumpress"); ?></span> </a> </li>

 
  </ul>
</nav>
<hr />


<?php
 

$catid = "footer";
$g = $CORE->LAYOUT("load_all_by_cat", $catid);
$order = array_column($g, 'order'); 
array_multisort( $order, SORT_ASC, $g);

?>
<div>
  <div class="row">
    <?php foreach($g as $tid => $g){ if(!isset($g['widget'])){ continue; } ?>
    <div class="col-md-4">
      <div class="position-relative overflow-hidden" style="min-height:100px; <?php if($footer_design == $tid){ echo "border:2px solid #008000;"; } ?>" ppt-border1>
        <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $catid; ?>&sid=<?php echo $tid; ?>" target="_blank"> <img src="<?php echo $CORE->LAYOUT("get_block_prewview", $tid  ); ?>" class="img-fluid lazy w-100" /> </a>
      </div>
      <div class=" my-2 d-flex justify-content-between align-items-center">
        <div class="text-muted font-weight-bold text-uppercase small">
          <?php echo $g['name']; ?>
        </div>
        <?php if($footer_design == $tid){ ?>
         <a href="javascript:void(0);" data-ppt-btn class="btn-success btn-xs"><?php echo __("Active","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="javascript:void(0);" onclick="saveFooter('<?php echo $tid; ?>');" data-ppt-btn class="btn-primary btn-xs"><?php echo __("Select","premiumpress"); ?></a>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

</div>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<input type="hidden" name="admin_values[design][footer_style]" id="saveFooter" value="<?php echo $footer_design; ?>" />
<script>
function switchFooterSettings(){

jQuery("#footerDesign").hide();
jQuery("#footerSettings").show(); 
jQuery("#footerElementor").hide();

}

function switchFooterElementor(){

jQuery("#footerElementor").show();
jQuery("#footerDesign").hide();
jQuery("#footerSettings").hide(); 
}

function saveFooter(tt){ 

jQuery("#saveFooter").val(tt);
jQuery("#admin_save_form").submit();
	
}

<?php if(strlen(_ppt(array("pageassign", "footer")) ) > 1){ ?>
   
jQuery(document).ready(function(){  
switchFooterElementor()
});

<?php } ?>
</script>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="footerElementor" style="display:none;">

<?php  

  $settings = array(
  
  "title" => __("Customize with Elementor","premiumpress"), 
  "desc" => __("Here you can choose your own footer template designed with Elementor.","premiumpress")."<br /><br /><strong>".__("Select the default design to reset.","premiumpress")."</strong>", 
  
   "back-link" => "admin.php?page=design",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
    
   
<div class="card card-admin">
  <div class="card-body">


<?php
 

// ADDON HOMEPAGE
$newarray = array();
 
$newarray['footer'] = array( "name" => "Footer", "link" => "", "order" => 2);
    
foreach($CORE->multisort($newarray, array('order'))  as $k => $p){ 
	
	// KEY
	$corekey = str_replace("page_","",$k);
	$p['id'] = $corekey;

?>
<div class="container border-bottom py-3">
  <div class="row px-0">
    <div class="col-6">
      <h6 class="mb-0"><?php echo $p['name']; ?></h6>
      
       <?php if(is_array($langs) && !empty($langs) && count($langs) > 1   ){  ?>
      <a href="javascript:void(0);" onclick="jQuery('.showtranslations<?php echo $p['id']; ?>').toggle();" 
                class="mt-3 btn btn-sm btn-system"><i class="fa fa-language"></i> <?php echo __("Show translations","premiumpress"); ?> </a> 
       
       <?php } ?>  
       
       <a href="#" onclick="switchFooterSettings();" class="btn-system btn-xs mt-4" data-ppt-btn=""> <span><?php echo __("Settings","premiumpress"); ?></span> </a> 
                
       </div>
    <div class="col-6">
      <select data-placeholder="Default Page" name="admin_values[pageassign][<?php echo $p['id']; ?>]"   class="form-control">
       <option value="0" style="color:#999999;"><?php echo __("Default Design","premiumpress"); ?></option>
        <optgroup label="Elementor Templates"></optgroup>
        <?php 
				  if(is_array($elementorArray)){
				  
				  $currentK = _ppt(array('pageassign', $p['id'] ));
				  
				  
				  foreach ( $elementorArray as $key => $title ) {  
				  
				     
               
			    if($key == "9999"){ ?>
        <optgroup label="Page Templates"></optgroup>
        <?php continue; }
				               
               $option = '<option value="'. $key.'"';
               if(  $currentK == $key){ $option .= " selected=selected ";   } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } } ?>
      </select>
      
      
      <?php /***********************************************************************/ ?>
      
         <div class="div mt-3">
                
                  <div class="row px-0">
                    <div class="col-xl-6">
                    	
                        
                     <?php if(substr(_ppt(array('pageassign',$p['id'])), 0, 9) == "elementor" ){  ?>
                     
                       <a href="<?php echo get_permalink(str_replace("elementor-","",_ppt(array('pageassign',$p['id'])))); ?>" target="_blank" class=" btn btn-system btn-md btn-block"><?php echo __("View","premiumpress"); ?></a>
                       
                     <?php }elseif(strlen(_ppt(array('links', $p['id']))) > 0 ){ ?>
                      
                      <a href="<?php echo _ppt(array('links', $p['id'])); ?>" target="_blank" class=" btn btn-system btn-md btn-block"><?php echo __("View","premiumpress"); ?></a>
                      
                      <?php } ?>
                      
                    </div>
                    <div class="col-xl-6">
                    
                      <?php if(defined('ELEMENTOR_VERSION')){ ?>
                      
                      
						  <?php if(substr(_ppt(array('pageassign',$p['id'])), 0, 9) == "elementor" ){  ?>
                          
                          <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo str_replace("elementor-","",_ppt(array('pageassign',$p['id']))); ?>&action=elementor" 
                          class="btn btn-system btn-md btn-block" target="_blank" ><i class="fab fa-elementor"></i> <?php echo __("Edit","premiumpress"); ?></a>
                          
                           
                           <?php }elseif(substr(_ppt(array('pageassign',$p['id'])), 0, 5) == "page-" ){  ?>
                         
                          <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo str_replace("page-","",_ppt(array('pageassign',$p['id']))); ?>&action=edit" 
                          class="btn btn-system btn-md btn-block" target="_blank" ><i class="fab fa-wordpress"></i> <?php echo __("Edit","premiumpress"); ?></a>
                           
                          
                          <?php }else{ ?>
                           
                          
                          
                          <a href="<?php echo home_url(); ?>/wp-admin/<?php if($p['id'] == "homepage"){ ?>admin.php?page=design&loadpage=home<?php }else{ ?>admin.php?page=design&loadpage=new&inner=<?php echo $p['id']; ?><?php } ?>" class="btn btn-system btn-md btn-block" target="_blank" ><i class="fab fa-elementor"></i> <?php echo __("Edit","premiumpress"); ?></a>
                          
                          <?php } ?>
                      
                       
                      <?php } ?>
                      
                      
                           </div>
                  </div>
                </div> 
                
                
                                      <?php /***********************************************************************/ ?>
                 
                 
				 <?php if(is_array($langs) && !empty($langs) && count($langs) > 1 ){ ?>
                
                <div id="" class="p-3 py-2 bg-light mt-3 showtranslations<?php echo $p['id']; ?>" style="display:none;">
                  <?php foreach(_ppt('languages') as $lang){
			
					$icon = explode("_",$lang); 
			
					if(_ppt(array('lang','default')) == "en_US" && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
				
				?>
                  <div class="mt-3">
                    <div class="mb-2 small">
                      <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?> mr-2">&nbsp;</div>
                      <?php echo $CORE->GEO("get_lang_name", $lang); ?> <?php echo $p['name']; ?> </div>
                    <select data-placeholder="Default Page" name="admin_values[pageassign][<?php echo $p['id']; ?>_<?php echo strtolower($lang); ?>]" <?php if(is_array($elementorArray) && count($elementorArray) > 50  ){ ?> data-size="10" class="form-control selectpicker"  data-live-search="true" title="&nbsp;"<?php }else{ ?>class="form-control"  <?php } ?>>
                      <option></option>
                       <option value="" style="color:#999999;"><?php echo __("Default Design","premiumpress"); ?></option>
                      <?php 
					  
					  $currentKey = _ppt(array('pageassign', $p['id']."_".strtolower($lang)));
					  
					  foreach ( $elementorArray as $key => $title ) {      
               
               $option = '<option value="'. $key.'"';
               if(  $currentKey == $key){ $option .= " selected=selected "; $EditLink = substr($key,10,100); } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } ?>
                    </select>
                  </div>
                  <div class="div mt-3">
                    <?php if(_ppt(array('pageassign',$p['id']."_".strtolower($lang))) != "" && isset($EditLink)){  ?>
                    <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $EditLink; ?>&action=elementor" class="btn btn-system btn-md" target="_blank" > <i class="fa fa-pencil"></i> <?php echo __("Edit Design","premiumpress"); ?></a>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
                <?php } ?>
                
                   <?php /***********************************************************************/ ?>
                       
	  
	  
       <?php /***********************************************************************/ ?>
     
      
    </div>    
  </div>
</div>

<?php } ?> 
  
  
  <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>



</div>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div id="footerSettings" style="display:none;">
<?php

  $settings = array(
  
  "title" => __("Footer Content","premiumpress"), 
  "desc" => __("Here you can set custom footer elements.","premiumpress"), 
   
   
   "back-link" => "admin.php?page=design",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
    
   $footermenus = _ppt_elementor_menus();
    
   
   ?>
   
   
   
<div class="card card-admin">
  <div class="card-body">


          
          
      
          <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-4">
              <label class="font-weight-bold mb-2"><?php echo __("Footer Logo","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Hide the logo on the footer.","premiumpress"); ?></p>
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('newfooterlogo').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('newfooterlogo').value='1'">
        </label>
        <div class="toggle <?php if(in_array(_ppt(array('newfooter','logo')),array("","1"))){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="newfooterlogo" name="admin_values[newfooter][logo]" value="<?php if(in_array(_ppt(array('newfooter','logo')),array("","1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>  
           
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Footer Text","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("This is usually displayed under the logo but may not apply to all designs.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <textarea class="form-control" style="height:100px;width:100%;" name="admin_values[newfooter][desc]"><?php echo _ppt(array('newfooter','desc')); ?></textarea>   
 
             
            </div>
          </div>    
          
          
          
          
 
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4 ">
              <label class="font-weight-bold mb-2"><?php echo __("Footer Menus","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("All menu items are setup within WordPress. ","premiumpress"); ?></p>
                
                <a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php" class="btn btn-system btn-sm btn-shadow mt-3" target="_blank"><?php echo __("Manage Menus","premiumpress"); ?></a>
             
              
              
            </div>
            <div class="col-md-4">
            
            <label><?php echo __("Menu Title","premiumpress"); ?> 1</label>
            <input type="text" name="admin_values[newfooter][menu1_title]" class="form-control" placeholder="<?php echo __("Useful Links","premiumpress"); ?>" value="<?php echo _ppt(array('newfooter','menu1_title')); ?>" />
             
              <label class="mt-3"><?php echo __("Select Display Menu","premiumpress"); ?> 1</label>
 
             <select class="form-control" name="admin_values[newfooter][menu1]">
             <?php foreach( $footermenus as $k => $n){ ?>
             <option value="<?php echo $k; ?>" <?php if(_ppt(array('newfooter','menu1')) == $k){ echo "selected=selected"; } ?>><?php echo $n; ?></option>
             <?php } ?>
             </select>
             
             
            </div>
            <div class="col-md-4">
             
              <label><?php echo __("Menu Title","premiumpress"); ?> 2</label>
            <input type="text" name="admin_values[newfooter][menu2_title]" class="form-control" placeholder="<?php echo __("Members","premiumpress"); ?>" value="<?php echo _ppt(array('newfooter','menu2_title')); ?>" />
            
             <label class="mt-3"><?php echo __("Select Display Menu","premiumpress"); ?> 1</label>
 
 
             <select class="form-control" name="admin_values[newfooter][menu2]">
             <?php foreach( $footermenus as $k => $n){ ?>
             <option value="<?php echo $k; ?>" <?php if(_ppt(array('newfooter','menu2')) == $k){ echo "selected=selected"; } ?>><?php echo $n; ?></option>
             <?php } ?>
             </select>
 
             
            </div>
            
          </div>
          
          
        <div class="row border-bottom pb-3 mb-3">
            <div class="col-md-4">
              <label class="font-weight-bold mb-2"><?php echo __("Footer Newsletters","premiumpress"); ?></label>
           
              <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=email&lefttab=newsletters" class="btn btn-system btn-sm btn-shadow mt-1" target="_blank"><?php echo __("Manage Newsletters","premiumpress"); ?></a>
             
              
            </div>
            <div class="col-md-2 mt-3 formrow">
              <div class="">
                <label class="radio off">
        <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('newfooternews').value='0'">
        </label>
        <label class="radio on">
        <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('newfooternews').value='1'">
        </label>
        <div class="toggle <?php if(in_array(_ppt(array('newfooter','news')),array("","1"))){  ?>on<?php } ?>">
          <div class="yes">ON</div>
          <div class="switch"></div>
          <div class="no">OFF</div>
        </div>
      </div>
      <input type="hidden" id="newfooternews" name="admin_values[newfooter][news]" value="<?php if(in_array(_ppt(array('newfooter','news')),array("","1"))){ echo 1; }else{ echo 0; } ?>">
            </div>
          </div>  
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Footer Social Icons","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("Set your social media values here. If not value is set it will check your company values.","premiumpress"); ?></p>
              
               <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=settings&lefttab=company" class="btn btn-system btn-sm btn-shadow mt-1" target="_blank"><?php echo __("Manage Company Values","premiumpress"); ?></a>
             
              
              
            </div>
            <div class="col-md-8 formrow">
            <div class="row">
             <?php
			 
$user_socials = array(
						"facebook"	=> array(
							"icon" => "fab fa-facebook",
							"share" => 1,
						),
						"twitter"	=> array(
							"icon" => "fab fa-twitter",
							"share" => 1,
						), 
						"instagram"	=> array(
							"icon" => "fab fa-instagram",
						), 
						"pinterest"	=> array(
							"icon" => "fab fa-pinterest",
							"share" => 1,
						), 
						"linkedin"	=> array(
							"icon" => "fab fa-linkedin",
							"share" => 1,
						), 
						"youtube"	=> array(
							"icon" => "fab fa-youtube",
						), 	
						"vimeo"	=> array(
							"icon" => "fab fa-vimeo",
						), 										
		);
			 foreach($user_socials as $so => $sm){ 
			 ?>
             <div class="col-md-6">
             <div class="form-group position-relative">
             <input type="text" class="form-control" name="admin_values[newfooter][<?php echo $so; ?>]" value="<?php echo _ppt(array('newfooter',$so)); ?>" />
             <i class="fa fab fa-<?php echo $so; ?>"></i>
             </div>
             </div>
             <?php } ?>
             </div>
             
            </div>
          </div>    
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Footer Copyright","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("Customize the copyright text.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <input type="text" class="form-control" name="admin_values[newfooter][copy]" placeholder="&copy; 2022 - my website" value="<?php echo _ppt(array('newfooter','copy')); ?>" />
            
             
            </div>
          </div>    
          
           

 
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4 ">
              <label class="font-weight-bold mb-2"><?php echo __("Payment Icons","premiumpress"); ?></label>
              <p class="text-muted"><?php echo __("Replace the default payment icons with your own image.","premiumpress"); ?></p>
              
               <img data-src="<?php echo CDN_PATH; ?>images/cards_all.svg" alt="cards" class="lazy" />

              
            </div>
            <div class="col-md-5 formrow">
             
               
  <?php echo $CORE->MEDIA("customUploadForm", "footer_icons"); ?> 
  
             
            </div>
          </div>
      

 
  <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
</div>
