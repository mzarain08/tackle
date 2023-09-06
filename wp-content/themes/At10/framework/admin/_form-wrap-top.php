<?php global $settings;  ?>

 
<div class="">
<div class="row">
<div class="col-md-4 pr-lg-4">


<div class="txt1">

  <h3 class="mt-4"><?php echo $settings['title']; ?></h3>
  <p class="opacity-8 lead"><?php echo $settings['desc']; ?></p>
 
 
 
  <?php if(isset($settings['plugin']) && is_array($settings['plugin'])){ ?>
 
 <a href="<?php echo $settings['plugin']['link']; ?>" class="btn btn-danger shadow-sm btn-sm px-3 popup-yt mb-4"><i class="fa fa-download mr-1"></i> <?php echo $settings['plugin']['name']; ?></a>
 
 
  <?php } ?>
  
  
  <?php if(isset($settings['desc-help']) && strlen($settings['desc-help']) > 2){ ?>
  <div class="opacity-8 mt-4 desc-help lead"><?php echo $settings['desc-help']; ?></div>
  <?php } ?>
  
  
  <?php if(isset($settings['sitemanager'])){ ?>
  <div class="mt-3"> <a href="admin.php?page=ppt_editor" class="btn btn-dark shadow-sm btn-lg"><i class="fa fa-tools mr-1"></i> <?php echo __("Site Manager","premiumpress"); ?></a> </div>
  <?php } ?>
   
  
    
  <?php if(isset($settings['doclink']) && strlen($settings['doclink']) > 2 && _ppt(array('company','core_branding')) == ""){ ?>
  <div> <a href="<?php echo $settings['doclink']; ?>/?license=<?php echo get_option('ppt_license_key'); ?>&web=<?php echo home_url(); ?>&tk=<?php echo THEME_KEY; ?>" class="btn btn-dark shadow-sm btn-sm mt-5" target="_blank">
  <i class="fa fa-file mr-1"></i> <?php echo __("Online Documentation","premiumpress"); ?></a> </div>
  <?php } ?>
   
  
  <?php if(isset($settings['link']) && strlen($settings['link']) > 2){ ?>
  <div> <a href="<?php echo $settings['link']; ?>" class="btn btn-dark shadow-sm btn-sm" target="_blank"><i class="fa fa-link mr-1"></i> <?php echo __("visit website","premiumpress"); ?></a> </div>
  <?php } ?>
  
    
  <?php if(isset($settings['back-link']) ){ ?>
 <div class="mt-4">
 <a href="<?php echo $settings['back-link']; ?>" class="btn btn-system font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
  <?php } ?>
  
  <?php if(isset($settings['back']) ){ ?>
 <div class="mt-4">
 <a href="#" onclick="jQuery('#<?php echo $settings['back']; ?>-tab').trigger('click');" class="btn btn-system font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
 </div>
  <?php } ?>
   

</div>

<div class="txt2">
    
  
  
<div class="mt-4 pakbackbtn" style="display:none">
 <a href="javascript:void(0);" onclick="processTogglePaks();" data-ppt-btn class="btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
</div>
 
 
</div>
  
 
  <?php /*if(isset($settings['video']) && !is_array($settings['video']) && strlen($settings['video']) > 2){ ?>
  
  <a href="<?php echo $settings['video']; ?>" class="btn btn-danger shadow-sm btn-sm px-3 popup-yt mb-4"><i class="fa fa-video mr-1"></i> <?php echo __("watch video","premiumpress"); ?></a>
  
  <?php }elseif(isset($settings['video']) && is_array($settings['video'])){ ?>
  
  <h3 class="mt-4"><i class="fa fa-video mr-1"></i> <?php echo __("Video Tutorials","premiumpress"); ?></h3>
  
  <div class="pr-lg-3">
  <?php $i=1; foreach($settings['video'] as $vid){ ?>
  
  <div class="mt-4"><a href="<?php echo $vid['link']; ?>" class=" popup-yt mb-4 text-dark opacity-5"> <?php echo $i; ?>. <?php echo $vid['title']; ?></a></div>
  
  <?php $i++; } ?>
  </div>
  <?php } */ ?>
  

  
</div>
<div class="col-md-8">
