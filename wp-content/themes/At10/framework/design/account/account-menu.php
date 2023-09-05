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

global $CORE, $userdata, $post, $CORE_UI;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

<div class="mb-4">
  <div class="card" ppt-border1>
    <div class="card-body">
     

     
     
      <?php foreach($GLOBALS['flag-account-links'] as $k => $i){  ?>
      
      <a <?php if($i['link'] != ""){ ?>href="<?php echo $i['link']; ?>"<?php }else{ ?>onclick="SwitchPage('<?php echo $k; ?>');" href="javascript:void(0);"<?php } ?>  class="btn-block list btn-system btn-lg shadow-0  my-2 position-relative menu-item menu-<?php echo $k; ?>" data-ppt-btn>
    
    
       
      <span ppt-icon-24 data-ppt-icon-size="24" class="icon-svg "><?php echo $CORE_UI->icons_svg[$i['icon']]; ?></span>
      
	 <span><?php echo $i['name'] ?></span>
     
     
      </a>
      
      
      <?php if($k == "details"){ ?>
      <ul class="list-unstyled mt-3" id="account_jumplinks" style="display:none;line-height:30px;">
        <li class="list-item"> <a onclick="showdetails('details');" href="javascript:void(0);" class="active text-dark" data-toggle="tab" role="tab"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Details","premiumpress") ?> </a> </li>
       
       
        <li class="list-item"> <a onclick="showdetails('username');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Username","premiumpress") ?> </a> </li>
        
        <?php if(!in_array(THEME_KEY, array("da"))){ ?>
        
        <li class="list-item"> <a onclick="showdetails('photo');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Photo","premiumpress") ?> </a> </li>
      	<li class="list-item"> <a onclick="showdetails('bg');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Background Image","premiumpress") ?> </a> </li>
      	
		
		<?php } ?>
      
        <li class="list-item"> <a onclick="showdetails('address');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Address","premiumpress") ?> </a> </li>
       
       
       <?php /* if(in_array(_ppt(array('user','email_notify')),array("","1"))){ ?>
       
            <li class="list-item"> <a onclick="showdetails('notifications');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Email Notifications","premiumpress") ?> </a> </li>
            
            <?php } */ ?> 
            
            <?php /*
                <li class="list-item"> <a onclick="showdetails('search');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Saved Searches","premiumpress") ?> </a> </li>
       */?>
       
        <?php if( _ppt(array('user','cashout')) == "1" ){ ?>
        <li class="list-item"> <a onclick="showdetails('payment');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Payment","premiumpress") ?> </a> </li>
        <?php } ?>
        
        <li class="list-item"> <a onclick="showdetails('password');" href="javascript:void(0);" data-toggle="tab"  role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Password","premiumpress") ?> </a> </li>
        
        
           <li class="list-item"> <a onclick="showdetails('delete');" href="javascript:void(0);" data-toggle="tab" role="tab" class="text-dark"> <i class="fa fa-angle-right ml-2 mr-2 hide-mobile"></i> <?php echo __("Delete Account","premiumpress") ?> </a> </li>
       
        
        
      </ul>
      <?php } ?>
      
       <?php } ?> 
     
      <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-block btn-light mt-2 btn-md"><?php echo __("Logout","premiumpress") ?> </a> </div>
  </div>
</div>