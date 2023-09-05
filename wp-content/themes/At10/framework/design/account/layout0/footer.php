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

global $CORE, $CORE_UI, $userdata, $post; 


?> 
      
      
    </div>
    <div class="col-lg-3 hide-mobile" id="accountmenubar">
   
      
      <?php _ppt_template( 'framework/design/account/account-menu' ); ?>
    
  </div>
</div>
</div>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div style="position:fixed; <?php if(_ppt('footer_mobile_menu') == 1){ echo "bottom:58px;"; }else{ echo "bottom:0px;"; } ?> width:100%; z-index:999;" class="p-2 bg-primary text-light show-mobile account-mobile-menu">
  <div class="row">
    <div class="col-6">
      
      
         
         <div class="d-flex">
         
             <?php echo $CORE_UI->AVATAR("user", array("size" => "xs", "uid" => $userdata->ID, "css" => "rounded mr-3", "online" => 0, "link" => 0)); ?>
           
            <div class="text-truncate small font-weight-bold mt-1">
            <?php echo $CORE->USER("get_username", $userdata->ID ); ?>  
            </div>
       </div>
      
      
    </div>
    <div class="col-6">
      
      
<div class="dropdown show">
  <a class="btn btn-system btn-block btn-sm font-weight-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo __("Menu","premiumpress"); ?>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
 
    
  <?php foreach($GLOBALS['flag-account-links'] as $k => $i){  ?>
  <a class="dropdown-item" <?php if($i['link'] != ""){ ?>href="<?php echo $i['link']; ?>"<?php }else{ ?>onclick="SwitchPage('<?php echo $k; ?>');jQuery('.footer-nav-area').removeClass('hide-mobile').show();" href="javascript:void(0);"<?php } ?>><?php echo $i['name'] ?></a>
  <?php if($k == "details"){ ?>
  <a onclick="showdetails('username');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Username","premiumpress") ?> </a>
 
 <?php if(!in_array(THEME_KEY, array("da"))){ ?>
        
  <a onclick="showdetails('photo');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Photo","premiumpress") ?> </a>
  <a onclick="showdetails('bg');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Background Image","premiumpress") ?> </a>
 
<?php } ?>
 
  <a onclick="showdetails('address');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Address","premiumpress") ?> </a>
 
 
  <?php if(in_array(_ppt(array('user','email_notify')),array("","1"))){ ?>
  <a onclick="showdetails('notifications');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Email Notifications","premiumpress") ?> </a>
  <?php } ?>
 
  <?php if( _ppt(array('user','cashout')) == "1" ){ ?>
  <a onclick="showdetails('payment');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Payment","premiumpress") ?> </a>
  <?php } ?>
  <a onclick="showdetails('password');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Password","premiumpress") ?></a>
  <a onclick="showdetails('delete');" href="javascript:void(0);" class="dropdown-item"> - <?php echo __("Delete Account","premiumpress") ?> </a>
  <?php } ?>
  <?php } ?>
    
    
    <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-block btn-light mt-2 btn-md"><?php echo __("Logout","premiumpress") ?> </a> 
    
  </div>
</div>
      
      
    </div>
  </div>
</div> 
