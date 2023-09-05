<?php

global $settings, $CORE;
 

// GET DISPLAY TITLES
$sinel_page_titles = single_page_titles();
 
$settings = array(
  
  "title" => __("Display Settings","premiumpress"), 
  "desc" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")),__("Here you can turn on/off default display options for the %s page.","premiumpress")),
  
  "back" => "overview",
  
  );
   _ppt_template('framework/admin/_form-wrap-top' ); ?>
<div class="card card-admin">
  <div class="card-body">
<?php 
	 

$memfeatures = array(

 
	1 => array(
	
		"name" => $sinel_page_titles["1_intro"],
		"desc" => "",		
		"key" => "display_1_intro",
		"default" => 1,
		"extra"		=> "<span class='badge badge-info float-right'>section</span>",
	),
	
	101 => array(
	
		"name" 		=> __("Tags &amp; Keywords","premiumpress"),
		"desc" 		=> "",		
		"key" 		=> "display_tags",
		"default" 	=> 0,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	),
	
); 

 


	if(!in_array(THEME_KEY, array("vt"))){ 
		$memfeatures[331] = array(
		
			"name" => __("Images","premiumpress"),
			"desc" => "",		
			"key" => "display_intro_images",
			"default" => 1,
			"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
			"bg" 		=> 1,
		 );
		$memfeatures[332] = array(
		
			"name" => __("Videos","premiumpress"),
			"desc" => "",		
			"key" => "display_intro_video",
			"default" => 1,
			"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
			"bg" 		=> 1,
		 );
	}

 

// START WITH THE MAIN SECTION
$ki = 40;
foreach($sinel_page_titles as $k => $t){
 
	if($t != "" && $k != "1_intro"){
	
		if($k == "5_reviews"){ $k = "comments"; }

		$memfeatures[$ki] = array(
		
			"name" => $t,
			"desc" => "",		
			"key" => "display_".$k,
			"default" => 1,
			"extra"		=> "<span class='badge badge-info float-right'>section</span>",
		 );
		 $ki++;
		 
		 
	 
	 
	 	if($k == "comments"){
		
		$memfeatures[64] = array(
			
				"name" 		=> "Comment Popup",
				"desc" 		=> __("This is the recent comment pop-up at the top of the page.","premiumpress"),		
				"key" 		=> "display_comment_popup",
				"default" 	=> 1,
				"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
				"bg" 		=> 1,
			);
		}
		 
		if($k == "2_location" && in_array(THEME_KEY, array("dt","es","dl","rt") )){
		
		
				$title = "";
				switch(THEME_KEY){
				
				
					case "es": {
					$title = __("Meeting Hours","premiumpress");
					} break;
				
					case "dl": 		
					case "rt": {
					$title = __("Viewing Hours","premiumpress");
					} break; 
					
					default: {	
					$title = __("Opening Hours","premiumpress");
					} break;
				} 
		
			$memfeatures[92] = array(
			
				"name" 		=> $title,
				"desc" 		=> __("Turn on/off this section.","premiumpress"),		
				"key" 		=> "display_openinghours",
				"default" 	=> 1,
				"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
				"bg" 		=> 1,
			);
			
			$memfeatures[93] = array(
			
				"name" 		=> __("12 Hour Display","premiumpress"),
				"desc" 		=> __("12 hour or 24 hour time display.","premiumpress"),		
				"key" 		=> "element_open12",
				"default" 	=> 1,
				"bg" 		=> 1,
			); 
		
		}
		
		if($k == "2_location" && in_array(THEME_KEY, array("at","ct"))){ 
 
			$memfeatures[80] = array(
			
				"name" 		=> __("Delivery","premiumpress"),
				"desc" 		=> __("Turn on/off to delivery box.","premiumpress"),		
				"key" 		=> "display_delivery",
				"default" 	=> 1,
				"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
				"bg" 		=> 1,
			 );
		
		} 
		
		
		if($k == "3_features" && !in_array(THEME_KEY, array("sp","cp","vt","jb")) ){
		
		
						 
				
						$title = "";
						switch(THEME_KEY){
						
						
							case "es": {
							$title = __("Services","premiumpress");
							} break;
						
							case "da": {
							$title = __("My Interests","premiumpress");
							} break;
						
							case "mj": {
							$title = __("Why Choose Me","premiumpress");
							} break;
							
							case "dt": {
							$title = __("Amenities","premiumpress");
							} break;	
							
							case "ll": {
							$title = __("Skills you will gain","premiumpress");
							} break;	
									 
							
							default: {	
							$title = __("Features","premiumpress");
							} break;
						} 
						
					$memfeatures[84] = array(
					
						"name" 		=> $title,
						"desc" 		=> __("Visible at the bottom of the details sections.","premiumpress"),		
						"key" 		=> "display_features",
						"default" 	=> 1,
						"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
						"bg" 		=> 1,
				 
					);
				
				 
		
			}
		 
	 
	 }
}




 
	$memfeatures[65] = array(
	
		"name" => __("Recommended For You","premiumpress"),
		"desc" => "",		
		"key" => "display_related",
		"default" => 1,
		"extra"		=> "<span class='badge badge-info float-right'>section</span>",
	 );
	 

if(in_array(_ppt(array('design','single_top')), array("","0"))){
 
	 /*
	$memfeatures[6] = array(
	
		"name" => __("Header &amp; Submenu","premiumpress"),
		"desc" => __("This will hide all nav buttons on the submenu bar also.","premiumpress"),		
		"key" => "display_submenu",
		"default" => 1,
		"extra"		=> "<span class='badge badge-info float-right'>section</span>",
	 ); 
	 */
	 
	if(in_array(THEME_KEY , array("da","ex","es","ll"))){
	
		if(THEME_KEY == "es"){ 
		
		$tg = __("Special tag line.","premiumpress");
		
	 		
		}elseif(THEME_KEY == "ll"){ 
		
		$tg = __("A few words to explain the course content.","premiumpress");
		
		
		}else{
		$tg = __("How would you describe yourself in one sentence?","premiumpress");
		
		} 
		 
			$memfeatures[74] = array(
			
				"name" => $tg,
				"desc" => "",		
				"key" => "display_excerpt",
				"default" => 1,
				"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
				"bg" 		=> 1,
			 );
	}
	if(in_array(THEME_KEY, array("da"))){ 
		$memfeatures[33] = array(
		
			"name" => __("Button - Wink","premiumpress"),
			"desc" => "",		
			"key" => "display_winks",
			"default" => 1,
			"extra"		=> "<span class='badge badge-success float-right'>button</span>",
			"bg" 		=> 1,
		 );
	}
	 
	$memfeatures[7] = array(
	
		"name" => __("Social Sharing","premiumpress"),
		"desc" => "",		
		"key" => "display_addthis",
		"default" => 1,
		"extra"		=> "<span class='badge badge-success float-right'>button</span>",
		"bg" 		=> 1,
	 );
	 
}

if( in_array(THEME_KEY, array("vt","cm","pj")) || $CORE->LAYOUT("captions","offers") == ""){ }else{  
 
		$memfeatures[91] = array(
		
			"name" 		=> $CORE->LAYOUT("captions","offerbtn"),
			"desc" 		=> "",		
			"key" 		=> "display_offers",
			"default" 	=> 1,
			"extra"		=> "<span class='badge badge-success float-right'>button</span>",
			"bg" 		=> 1,
		);

} 

if(in_array(THEME_KEY, array("sp") )){
	$memfeatures[55] = array(
		
			"name" 		=> __("Ask Question","premiumpress"),
			"desc" 		=> "",		
			"key" 		=> "display_askquestion",
			"default" 	=> 0,
			"extra"		=> "<span class='badge badge-success float-right'>button</span>",
			"bg" 		=> 1,
		);

}else{
	$memfeatures[55] = array(
		
			"name" 		=> __("Message Me","premiumpress")."<div class='tiny mt-2'><a href='admin.php?page=usersettings&lefttab=ap' class='text-dark'><u>".__("settings found here","premiumpress")."</u></a></div>",
			"desc" 		=> "",		
			"key" 		=> "",
			"default" 	=> 0,
			"extra"		=> "<span class='badge badge-success float-right'>button</span>",
			"bg" 		=> 1,
		);
}


	$memfeatures[56] = array(
		
			"name" 		=> __("Favorites","premiumpress")."<div class='tiny mt-2'><a href='admin.php?page=usersettings&lefttab=ap' class='text-dark'><u>".__("settings found here","premiumpress")."</u></a></div>",
			"desc" 		=> "",		
			"key" 		=> "",
			"default" 	=> 0,
			"extra"		=> "<span class='badge badge-success float-right'>button</span>",
			"bg" 		=> 1,
		);
	 


 

	$memfeatures[99] = array(
	
		"name" 		=> __("Sticky Sidebar","premiumpress"),
		"desc" 		=> __("The sidebar contents will scroll with the user.","premiumpress"),		
		"key" 		=> "display_stickysidebar",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		
	); 
	
	
if(defined('THEME_KEY') && in_array(THEME_KEY, array("da"))){ 
 
	$memfeatures[810] = array(
	
		"name" 		=> __("I'm Looking For","premiumpress"),
		"desc" 		=> __("Turn on/off this entire section.","premiumpress"),		
		"key" 		=> "display_lookingfor",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	 );

}
if(defined('THEME_KEY') && in_array(THEME_KEY, array("dt"))){  
 
	$memfeatures[94] = array(
	
		"name" 		=> __("Claim Listing Feature","premiumpress"),
		"desc" 		=> "",		
		"key" 		=> "display_claim",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
		
	); 
 

}


if(defined('THEME_KEY') && in_array(THEME_KEY, array("es"))){ 
 
	$memfeatures[80] = array(
	
		"name" 		=> __("My Rates","premiumpress"),
		"desc" 		=> __("Turn on/off to user rates system.","premiumpress"),		
		"key" 		=> "display_rates",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	);

}	



if(defined('THEME_KEY') && in_array(THEME_KEY, array("at"))){ 

 
	$memfeatures[81] = array(
	
		"name" 		=> __("Highest Bigger","premiumpress"),
		"desc" 		=> __("Turn on/off to highest bidder box.","premiumpress"),		
		"key" 		=> "display_hbid",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>block</span>",
		"bg" 		=> 1,
	);
	
	$memfeatures[82] = array(
	
		"name" 		=> __("Reserve Price","premiumpress"),
		"desc" 		=> __("Turn on/off to reserve price box.","premiumpress"),		
		"key" 		=> "display_reserve",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	);
	
	$memfeatures[83] = array(
	
		"name" 		=> __("Shipping","premiumpress"),
		"desc" 		=> __("Turn on/off shipping options.","premiumpress"),		
		"key" 		=> "display_shipping",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	 );

}

/*
	$memfeatures[74] = array(
	
		"name" 		=> __("Mobile Bottom Button","premiumpress"),
		"desc" 		=> __("Turn on/off to user mobile pop-up menu.","premiumpress"),		
		"key" 		=> "display_mobile_bottom",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	);

	$memfeatures[75] = array(
	
		"name" 		=> __("Mobile Collape","premiumpress"),
		"desc" 		=> __("Turn on/off to stop the theme collapsing content on mobile devices.","premiumpress"),		
		"key" 		=> "display_mobile_collapse",
		"default" 	=> 1,
		"extra"		=> "<span class='badge badge-warning float-right'>content</span>",
		"bg" 		=> 1,
	);
*/
?>
    
    <?php



	$snames = array(
	
			0 => array(
				"name" => "Image Header", 
				"img" => DEMO_IMG_PATH."newsingle/top_.jpg",
				"key" => "",
			),
		
			1 => array(
				"name" => "Gallery", 
				"img" => DEMO_IMG_PATH."newsingle/top_gallery.jpg",
				"key" => "gallery",
			),
			
			2 => array(
				"name" => "Carousel", 
				"img" => DEMO_IMG_PATH."newsingle/top_gallery-carousel.jpg",
				"key" => "gallery-carousel",
			),	
			
			7 => array(
				"name" => "Carousel Basic", 
				"img" => DEMO_IMG_PATH."newsingle/top_gallery-carousel-basic.jpg",
				"key" => "gallery-carousel-basic",
			),	
			
			3 => array(
				"name" => "Image Grid", 
				"img" => DEMO_IMG_PATH."newsingle/top_gallery-grid.jpg",
				"key" => "gallery-grid",
			),	
			
			4 => array(
				"name" => "Video", 
				"img" => DEMO_IMG_PATH."newsingle/top_video.jpg",
				"key" => "video",
			),
			
		 
			
			6 => array(
				"name" => "Tall Images", 
				"img" => DEMO_IMG_PATH."newsingle/top_full_text.jpg",
				"key" => "tall_gallery",
			),	
			
			8 => array(
				"name" => "Full Gallery", 
				"img" => DEMO_IMG_PATH."newsingle/top_full_gallery.jpg",
				"key" => "full_gallery",
			),	
			
			
			
			 
				
			 
		);
		
		if(in_array(THEME_KEY,array("cp"))){
		$snames = array();
		$memfeatures = array();
		}
		
		if(in_array(THEME_KEY,array("pj","jb","ph"))){
		$snames = array();
		//$memfeatures = array();
		}
		 

		$SetThis = _ppt(array('design','single_top')); 
		 
?>
    <div class="row mb-3 ">
      <?php foreach($snames as $i => $n){ ?>
      <div class="col-6 col-md-4 text-center mb-3">
        <div class="card-top-image mb-1  bg-light position-relative design_<?php echo $n['key']; ?> <?php if( $n['key'] == $SetThis ){ ?>selecteddesign<?php } ?>" style="overflow:hidden;"> 
        
        
        <img <?php if(!isset($_GET['lefttab'])){ ?>data-<?php } ?>src="<?php echo $n['img']; ?>" class="img-fluid lazy border mb-2" alt="img" />
         
        </div>
         <div class="d-flex text-600 small">
		 
          <div>
          <input type="radio" name="install_template" class="mr-2" onclick="changeselectedesign('<?php echo $n['key']; ?>');" value="<?php echo $n['key']; ?>"  <?php if($n['key'] == $SetThis){  ?>checked=checked<?php } ?>/>
     	</div>
         
		 <div><?php echo $n['name']; ?></div>
         
         </div>
        
      </div>
      <?php $i++; } ?>
    </div>
    <style>
.selecteddesign { border:2px solid red; }
</style>



    <input type="hidden" name="admin_values[design][single_top]" id="selecteddesignname" value="<?php echo $SetThis; ?>">
    <script>

function changeselectedesign(key){

	jQuery('.selecteddesign').removeClass('selecteddesign');
	
	jQuery('.design_'+key+'').addClass('selecteddesign');
	
	jQuery("#selecteddesignname").val(key);

}
 
</script>
<?php if(!empty($memfeatures)){ ?>
    <div class="row py-2 small border-top bg-dark text-light">
      <div class="col-md-6">
        <strong><?php echo __("Display","premiumpress"); ?></strong>
      </div>
      <div class="col-md-3 text-center">
        <strong><?php echo __("Show","premiumpress"); ?></strong>
      </div>
      <div class="col-md-3 text-center">
        <strong><?php echo __("Hide","premiumpress"); ?></strong>
      </div>
    </div>
<?php } ?>
    <?php  foreach($memfeatures as $i => $f){  ?>
    <div class="row  border-top position-relative <?php if(isset($f['bg'])){ ?>bg-light pt-2<?php }else{ ?>py-3<?php } ?>">
      <div class="col-md-6 small">
      
      
<?php if(isset($f['desc']) && strlen($f['desc']) ){ ?>
        
        
<div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"> 
  <label class="position-relative"><?php echo $f['name']; ?> <i class="fal fa-info-circle"></i> </label>
    </div>
    <div class="badge_tooltip__item text-center"><?php echo $f['desc']; ?></div>
  </div>
        
     
 
        <?php }else{ ?>
        <label class="position-relative"><?php echo $f['name']; ?> </label>
      <?php } ?>
      
        <?php if(isset($f['extra']) && strlen($f['extra']) ){ echo $f['extra']; } ?>
      </div>
      <div class="col-md-3 text-center">
      <?php if($f['key'] != ""){ ?> 
      
        <label class="custom-control custom-checkbox">
        <input type="<?php if($f['key'] == ""){ echo "checkbox"; }else{ echo "radio";} ?>" value="1" class="custom-control-input"  name="<?php echo $f['key']; ?>_radio"  
   <?php if($f['key'] == ""){ echo "disabled"; }else{ ?> onchange="SinglePageCheckMe('<?php echo $f['key']; ?>',1);" <?php if( in_array(_ppt(array('design', $f['key'] )), array("1")) || ( _ppt(array('design', $f['key'])) == "" && $f['default'] == 1 ) ){ ?>checked=checked<?php } } ?>>
        <span class="custom-control-label">&nbsp;</span> </label>
        <?php } ?>
        
      </div>
      <div class="col-md-3 text-center">
       <?php if($f['key'] != ""){ ?> 
        <label class="custom-control custom-checkbox">
        <input type="<?php if($f['key'] == ""){ echo "checkbox"; }else{ echo "radio";} ?>"  value="0"  class="custom-control-input" name="<?php echo $f['key']; ?>_radio"   
    <?php if($f['key'] == ""){ echo "disabled"; }else{ ?>onchange="SinglePageCheckMe('<?php echo $f['key']; ?>',0);" <?php if( ( in_array(_ppt(array('design', $f['key'] )), array("")) && $f['default'] == 0) || in_array(_ppt(array('design', $f['key'] )), array("0")) ){ ?>checked=checked<?php } } ?>>
        <span class="custom-control-label">&nbsp;</span> </label>
        <?php } ?>
      </div>
    </div>
    <!-- end row -->
    <input type="hidden" name="admin_values[design][<?php echo $f['key']; ?>]" id="<?php echo $f['key']; ?>_radio_val" value="<?php if( _ppt(array('design', $f['key'])) == "" && $f['default'] == 1){ echo 1; }else{ echo _ppt(array('design', $f['key'])); } ?>">
    <?php } ?>
    <script> function SinglePageCheckMe(div,v){ jQuery('#'+div+'_radio_val').val(v); } </script>
 
  
 
 
    <!-- ------------------------- -->
    <div class="container px-0 mb-3 mt-4">
      <div class="row py-2">
        <div class="col-md-7">
          <label><?php echo __("Users Must Login To Access","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn on/off to force users to login before viewing.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <label><?php echo __("Entire Page","premiumpress"); ?></label>
          <div class="formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('requirelogin_listings').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('requirelogin_listings').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('design', 'requirelogin_listings' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="requirelogin_listings" name="admin_values[design][requirelogin_listings]" value="<?php echo _ppt(array('design', 'requirelogin_listings' )); ?>">
        </div>
        <div class="col-md-2">
        
           <label><?php echo __("Audio/Music","premiumpress"); ?></label>
          <div class=" mb-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_musiclogin').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_musiclogin').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_musiclogin')), array("1"))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_musiclogin" name="admin_values[design][display_musiclogin]" value="<?php if(in_array(_ppt(array('design', 'display_musiclogin')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
        
        </div>
        
        
        <div class="col-md-7">
        </div>
        <div class="col-md-2 mt-3">
          <label><?php echo __("Photos","premiumpress"); ?></label>
          <div class="mt-2">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_photologin').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_photologin').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_photologin')), array("1"))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_photologin" name="admin_values[design][display_photologin]" value="<?php if(in_array(_ppt(array('design', 'display_photologin')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
         
        </div>
        <div class="col-md-2 mt-3">
          <label><?php echo __("Videos","premiumpress"); ?></label>
          <div class="mt-2">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('display_videologin').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('display_videologin').value='1'">
            </label>
            <div class="toggle <?php if(in_array(_ppt(array('design', 'display_videologin')), array("1"))){ ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="display_videologin" name="admin_values[design][display_videologin]" value="<?php if(in_array(_ppt(array('design', 'display_videologin')), array("1"))){  echo 1; }else{ echo 0; }  ?>">
        </div>
      </div>
    </div>
     <input type="hidden" name="admin_values[design][single_layout]" value="4" />
   
    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' );  ?>
