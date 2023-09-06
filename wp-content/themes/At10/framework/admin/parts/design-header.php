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
$header_design = _ppt(array('design','header_style'));

?>

<style>

.btn-elementor {    background: #ba225f!important;    color: #fff!important; }
</style>

<div id="headerDesign">

<nav ppt-nav="" class="sepetator pl-0">
  <ul>
    <li>
      <div class="fs-md text-600">
        <?php echo __("Header Design","premiumpress"); ?>
      </div>
      <div class="mt-2 opacity-8">
        <?php echo __("Choose the header design for your website.","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="#" onclick="switchHeaderSettings();" class="btn-primary btn-lg" data-ppt-btn=""> <span><?php echo __("Settings","premiumpress"); ?></span> </a> </li>
 
     <li> <a href="#" onclick="switchHeaderElementor();" class="btn-elementor btn-lg" data-ppt-btn=""> <span><?php echo __("Elementor","premiumpress"); ?></span> </a> </li>

 
  </ul>
</nav>
<hr />


<?php
 

$catid = "header";
$g = $CORE->LAYOUT("load_all_by_cat", $catid);
$order = array_column($g, 'order'); 
array_multisort( $order, SORT_ASC, $g);

?>
<div>
  <div class="row">
    <?php foreach($g as $tid => $g){ if(!isset($g['widget'])){ continue; } ?>
    <div class="col-md-4">
      <div class="position-relative overflow-hidden" style="min-height:100px; <?php if($header_design == $tid){ echo "border:2px solid #008000;"; } ?>" ppt-border1>
        <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $catid; ?>&sid=<?php echo $tid; ?>" target="_blank"> <img src="<?php echo $CORE->LAYOUT("get_block_prewview", $tid  ); ?>" class="img-fluid lazy w-100" /> </a>
      </div>
      <div class=" my-2 d-flex justify-content-between align-items-center">
        <div class="text-muted font-weight-bold text-uppercase small">
          <?php echo $g['name']; ?>
        </div>
        <?php if($header_design == $tid){ ?>
         <a href="javascript:void(0);" data-ppt-btn class="btn-success btn-xs"><?php echo __("Active","premiumpress"); ?></a>
        <?php }else{ ?>
        <a href="javascript:void(0);" onclick="saveHeader('<?php echo $tid; ?>');" data-ppt-btn class="btn-primary btn-xs"><?php echo __("Select","premiumpress"); ?></a>
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
<input type="hidden" name="admin_values[design][header_style]" id="saveHeader" value="<?php echo $header_design; ?>" />
<script>
function switchHeaderSettings(){

jQuery("#headerDesign").hide();
jQuery("#headerSettings").show(); 
jQuery("#headerElementor").hide();

}

function switchHeaderElementor(){

jQuery("#headerElementor").show();
jQuery("#headerDesign").hide();
jQuery("#headerSettings").hide(); 
}

function saveHeader(tt){ 

jQuery("#saveHeader").val(tt);
jQuery("#admin_save_form").submit();
	
}

<?php if(strlen(_ppt(array("pageassign", "header")) ) > 1){ ?>
   
jQuery(document).ready(function(){  
switchHeaderElementor()
});

<?php } ?>
</script>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="headerElementor" style="display:none;">

<?php  

  $settings = array(
  
  "title" => __("Customize with Elementor","premiumpress"), 
  "desc" => __("Here you can choose your own header template designed with Elementor.","premiumpress")."<br /><br /><strong>".__("Select the default design to reset.","premiumpress")."</strong>", 
  
   "back-link" => "admin.php?page=design",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
    
   
<div class="card card-admin">
  <div class="card-body">


<?php
 

// ADDON HOMEPAGE
$newarray = array();
 
$newarray['header'] = array( "name" => "Header", "link" => "", "order" => 2);
    
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

<div id="headerSettings" style="display:none;">
<?php

  $settings = array(
  
  "title" => __("Header Content","premiumpress"), 
  "desc" => __("Here you can set custom header elements.","premiumpress")."<br><br>".__("To keep our theme multilingual, all default text such as address, working hours etc is found in the language file.","premiumpress"), 
   
   
   "back-link" => "admin.php?page=design",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
    
   $headermenus = _ppt_elementor_menus();
    
   
   ?>
   
   
   
<div class="card card-admin">
  <div class="card-body">
  
  
         
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Phone Number","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("If the header has a phone number display, you can set it here.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <input type="text" class="form-control" name="admin_values[newheader][phone]" placeholder="+123 456 678" value="<?php echo _ppt(array('newheader','phone')); ?>" />
            
             
            </div>
          </div>   
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Email Address","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("If the header has an email display, you can set it here.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <input type="text" class="form-control" name="admin_values[newheader][email]" placeholder="me@me.com" value="<?php echo _ppt(array('newheader','email')); ?>" />
            
             
            </div>
          </div>  
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Office Address","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("If the header has an office address display, you can set it here.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <input type="text" class="form-control" name="admin_values[newheader][address]" placeholder="+123 456 678" value="<?php echo _ppt(array('newheader','address')); ?>" />
            
             
            </div>
          </div>   
          
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Button Text","premiumpress"); ?></label>
              
              <p class="text-muted"><?php echo __("If the header has an button display, you can set it here.","premiumpress"); ?></p>
              
              
            </div>
            <div class="col-md-8 formrow">
             
             <input type="text" class="form-control" name="admin_values[newheader][btn_txt]" placeholder="<?php echo __("Add new","premiumpress"); ?>" value="<?php echo _ppt(array('newheader','btn_txt')); ?>" />
            
             
            </div>
          </div>  
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Top  Menu","premiumpress"); ?></label>
              
      <p class="text-muted"><?php echo __("All menu items are setup within WordPress. ","premiumpress"); ?></p>
                
                
              
            </div>
            <div class="col-md-8 formrow">
            
            <a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php" class="btn btn-system btn-md btn-shadow mt-3" target="_blank"><?php echo __("Manage Menus","premiumpress"); ?></a>
             
             
             <a href="https://www.youtube.com/watch?v=B58lx3BVVSI" class="btn btn-dark btn-sm  mt-3 float-right" target="_blank"><i class="fab fa-youtube"></i> <?php echo __("Watch Video","premiumpress"); ?></a>
             
             
             
            </div>
          </div>   
          
          
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Header Social Icons","premiumpress"); ?></label>
              
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
             <input type="text" class="form-control" name="admin_values[newheader][<?php echo $so; ?>]" value="<?php echo _ppt(array('newheader',$so)); ?>" />
             <i class="fa fab fa-<?php echo $so; ?>"></i>
             </div>
             </div>
             <?php } ?>
             </div>
             
            </div>
          </div>  
          
           
           
          <div class="row border-bottom  pb-3 pt-2 mb-3">
            <div class="col-md-4">
              
              <label class="font-weight-bold mb-2"><?php echo __("Header Image","premiumpress"); ?></label>
              
      <p class="text-muted"><?php echo __("Some headers have background images. Set it here.","premiumpress"); ?></p>
                
                
              
            </div>
            <div class="col-md-8 formrow">
            
                    <input type="hidden" 
               id="up_header_bg_aid" 
               name="admin_values[design][header_bg_aid]" 
               value="<?php  echo stripslashes(_ppt(array('design', 'header_bg_aid')));  ?>"  />
              <input 
               name="admin_values[design][header_bg]" 
               type="hidden" 
               id="up_header_bg" 
               value="<?php echo stripslashes(_ppt(array('design','header_bg')));  ?>" />
              <?php if(substr(_ppt(array('design','header_bg')),0,4) == "http"){ ?>
              <div class="pptselectbox bg-light p-2 position-relative text-center   border">
                 
                <img data-src="<?php echo _ppt(array('design','header_bg')); ?>" style="max-width:100%; max-height:300px;" id="header_bg_preview" class="lazy" alt="img" /> </div>
              <div class="pptselectbtns mb-4 text-center mt-4"> <a href="<?php  echo _ppt(array('design','header_bg'));  ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("View","premiumpress") ?></a> <a href="javascript:void(0);"id="editImg_header_bg" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Edit","premiumpress") ?></a> <a href="javascript:void(0);" id="upload_header_bg" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Change","premiumpress") ?></a> <a href="javascript:void(0);" onclick="jQuery('#up_header_bg').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;"><?php echo __("Delete","premiumpress") ?></a> </div>
              <?php }else{ ?>
              <div class="pptselectbox bg-light text-dark p-5 text-center position-relative">
              
                <a href="javascript:void(0);" id="upload_header_bg">
                <div class="text-dark font-weight-bold btn btn-system btn-md"><?php echo __("select image","premiumpress") ?></div>
                <div class="text-dark mt-4 small">.jpeg/ .png</div>
                </a> </div>
              <?php } ?>
              <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_header_bg').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt(array('design', 'header_bg_aid' ) ); ?>&action=edit&amp;TB_iframe=true');
					
					
               					 
               		return false;
               	});
               	
               	jQuery('#upload_header_bg').click(function() {           
               	
               		ChangeAIDBlock('up_header_bg_aid');
               		ChangeImgBlock('up_header_bg');		
               		ChangeImgPreviewBlock('header_bg_preview');
					jQuery('#textlogobox').val('');
               		
               		formfield = jQuery('#up_header_bg').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 					
               		return false;
               	});
               					
               });	
            </script>
              <div class="text-muted mt-3 small"><?php echo __("Image Size","premiumpress") ?>: 1300px / 100px </div> 
             
             
            </div>
          </div>   
           
          


  <div class="p-4 bg-light text-center mt-4">
            <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
          </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>
</div>
