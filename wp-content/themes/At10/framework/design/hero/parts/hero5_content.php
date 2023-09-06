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
 
global $settings, $df, $CORE;



?>
  <div class="container position-relative z-10 py-sm-5 _contents">
    <div class="row align-items-center">
      <div class="col-lg-6 text-light text-center text-md-left">
       
 
        
        <div class="mt-5 d-flex h1buttonbox mobile-mb-4">
        
        <?php if(THEME_KEY == "sp"){ ?>
        
          <?php if($df['btn_show'] == "1"){ ?>
           <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-light text-600" data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
         
        <?php }else{ ?>
        
          <?php if($df['btn_show'] == "1"){ ?>
          <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-lg btn-light text-600"  data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
          <?php } ?>
          <?php if($df['btn2_show'] == "1"){ ?>
          <a href="<?php echo home_url(); ?>/?s=" class="btn-lg btn-light text-600"  data-ppt-btn data-ppt-btn2-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search" ) ); ?></a>
          <?php } ?>
          
        <?php } ?>
          
        </div>
        
        <?php if($df['searchbox'] == "1"){ ?>
        <div class="mt-5">
          <form method="get" action="<?php echo home_url(); ?>" style="max-width:400px;">
            <div class="bg-white rounded-lg p-1 d-flex">
              <input class="typeahead form-control form-control-lg border-0 mb-0" type="text"  name="s" placeholder="<?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "start_search_here" ) ); ?>">
              <button class="btn-primary btn-search" data-ppt-btn type="submit"><span><?php echo __("Search","premiumpress"); ?></span></button>
            </div>
          </form>
        </div>
        <?php } ?>
        
        <?php if(isset($df['searchboxmap']) && $df['searchboxmap'] == "1"){ ?>
        <div class="mt-5">
          <form method="get" action="<?php echo home_url(); ?>" style="max-width:500px;">
          <input type="hidden" name="s" value="" />
            <div class="bg-white rounded-lg p-1 d-flex">
              <?php echo _get_country_search_box_map(); ?>
              <button  class="btn-primary btn-search" data-ppt-btn type="submit"><span><?php echo __("Search","premiumpress"); ?></span></button>
            </div>
          </form>
        </div>
        <?php } ?>
        
      </div>
      <?php if($df['image1_show'] == "1"){ ?>
      <div class="col-lg-6" data-cues="slideInDown">
        <div class="position-relative">
          <a href="#" data-ppt-image1-link>
          <?php if($df['video_show'] == "1"){ ?>
          <div class="videoplaybutton_wrap" style="position: absolute;top: 40%;left: 40%;">
            <div class="videoplaybutton bg-white" style="line-height: 110px;">
              <span class="fa fa-play fa-2x text-primary" style="position: absolute;    top: 35px;    left: 38px;">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span><span class="ripple_playbtn bg-white">&nbsp;</span>
            </div>
          </div>
          <?php } ?>
          <img src="<?php echo $df['image1']; ?>" class="img-fluid rounded shadow" alt="image" data-ppt-image1> </a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  
  <div class="bg-image" style="background-image:url('<?php echo $df['image']; ?>');" data-ppt-image-bg>&nbsp;</div>
  
<?php  _ppt_template( 'framework/design/hero/parts/overlay' ); ?>