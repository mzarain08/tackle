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

global $CORE, $userdata, $post;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<select class="form-control w-100 show-mobile hide-ipad hide-desktop mt-4 mb-4" onchange="SwitchPage(this.value);">
  <?php foreach($CORE->USER("get_account_links", array()) as $k => $i){  ?>
  <option value="<?php echo $k; ?>"><?php echo $i['name'] ?></option>
  <?php if($k == "details"){ ?>
  <option value="username"> - <?php echo __("Username","premiumpress") ?> </option>
  <option value="photo"> - <?php echo __("Photo","premiumpress") ?> </option>
  <option value="address"> - <?php echo __("Address","premiumpress") ?> </option>
  <?php if(in_array(_ppt(array('user','email_notify')),array("","1"))){ ?>
  <option value="notifications"> - <?php echo __("Email Notifications","premiumpress") ?> </option>
  <?php } ?>
 
  <?php if( _ppt(array('user','cashout')) == "1" ){ ?>
  <option value="payment"> - <?php echo __("Payment","premiumpress") ?> </option>
  <?php } ?>
  <option value="password"> - <?php echo __("Password","premiumpress") ?></option>
  <option value="delete"> - <?php echo __("Delete Account","premiumpress") ?> </option>
  <?php } ?>
  <?php } ?>
</select>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

if(isset($GLOBALS['singleListingID']) && is_numeric($GLOBALS['singleListingID'])){ ?>
     
     <a href="<?php echo $GLOBALS['singleListingLink']; ?>" class="btn btn-block btn-primary mb-2 shadow-sm"> <i class="fal fa-pencil mr-2 text-white"></i> <?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("Edit %s","premiumpress")) ?></a>
     
     <?php if($GLOBALS['singleListingLinkMain'] != ""){ ?>
	  <a href="<?php echo $GLOBALS['singleListingLinkMain']; ?>" class="btn btn-block btn-system mb-2 btn-lg"   target="_blank"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"),__("View My %s","premiumpress")) ?></a>
      <?php } ?>
      
      <?php if($GLOBALS['singleListingID'] != 0){ ?>
      <a href="javascript:void(0)" onclick="processListingUpgrade(<?php echo $GLOBALS['singleListingID']; ?>);" class="btn btn-block btn-system mb-3 btn-lg">
      <?php echo str_replace("%s", $CORE->LAYOUT("captions",1), __("Renew &amp; Upgrade","premiumpress")); ?></a>
      <?php } ?>
      
      
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>