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

global $CORE, $CORE_UI, $userdata; $showDashboard = true;
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$page = ""; $selectedpage = "dashboard";
if(isset($_GET['tab'])){
$selectedpage = $_GET['tab'];
$page = $_GET['tab'];
}elseif(isset($_GET['showtab'])){
$page = $_GET['showtab'];
$selectedpage = $_GET['showtab'];
}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$menu = $CORE->USER("get_account_links", array());
 
$listng_data = $CORE->USER("count_user_listings", $userdata->ID);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// USER DATA
//$desc 		= get_the_author_meta( 'description', $userdata->ID);
$photo 			= $CORE->USER("get_avatar",$userdata->ID);
//$url 			= get_user_meta($userdata->ID,'url',true); 
$username 		= $CORE->USER("get_username",$userdata->ID); 

//$link 			= $CORE->USER("get_user_profile_link", $userdata->ID);
//print_r($GLOBALS['accounttype']);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

?>

<div class="container my-sm-4">

<div class="card-mobile-transparent p-3 mb-4  mobile-negative-margin-x" ppt-border1>
<nav ppt-nav class="sepetator">
<ul>

<li  class="w-100">

<div class="d-flex">
<?php echo $CORE_UI->AVATAR("user", array("size" => "lg", "uid" => $userdata->ID, "css" => "rounded-circle", "online" => 0, "link" => 1 )); ?>
 

<div class=" ml-4">
<a href="<?php echo _ppt(array('links','myaccount'))."/?tab=details"; ?>">
	
    <div class="d-flex align-items-center">
    <div class="fs-md text-600"><?php echo $CORE->USER("get_display_name",$userdata->ID); ?></div>
 
    </div>
    
    <div class="fs-sm opacity-5 text-truncate" style="max-width:350px"><?php echo $GLOBALS['accounttype']['name']; ?> &bull; <?php echo $CORE->USER("get_email",$userdata->ID); ?></div>
</a>
</div>

</div>
</li>



<?php 
 
if(in_array($page,array("messages"))){  ?>


<li class="ml-auto" ppt-flex-middle>
<a href="<?php echo _ppt(array('links','myaccount')); ?>" class="btn-system" data-ppt-btn><?php echo __("Dashboard","premiumpress") ?></a>  
</li>

<?php }else{ $css = "ml-auto"; ?>
 

<?php if(!in_array(THEME_KEY,array("sp","cm","cp","cb")) && $listng_data['total']  > 0 && _ppt(array('lst','addon_boost_enable')) != "0" ){ 
 
$BoostValue = 0; 
$BoostLive = 0;
$BoostEnds = "";
$boostData = get_user_meta($userdata->ID, 'upgrade_boost', true);
if(is_array($boostData) && !empty($boostData)){
	$BoostEnds 	= $boostData['end'];
	$BoostStart = $boostData['start'];
	$hh = $CORE->date_timediff($BoostEnds,$BoostStart); 
	if($hh['expired'] == 0){
		$BoostLive = 1;
		$BoostValue = $hh['percentage-left']/100; 
	} 
}
 

?>
<li class="<?php echo $css; $css=""; ?> hide-mobile hide-ipad" ppt-flex-middle >
<a href="javascript:void(0);" onclick="processBoost(0);" class="btn-primary" data-ppt-btn>
<div class="d-flex">

	<?php if($BoostLive){ ?>
    <div ppt-icon-16 data-ppt-icon-size="16" class="mr-2" ppt-flex-middle><?php echo $CORE_UI->icons_svg['clock']; ?></div>
    <span style="display:inline-block;" class="text-600" ppt-flex-middle
     data-pre-layout="boost" data-ppt-countdown="<?php echo $BoostEnds; ?>" data-timezone="<?php echo get_option('gmt_offset'); ?>">&nbsp;</span>
    <?php }else{ ?>
    <div><?php echo __("Boost Me","premiumpress") ?></div>
	<?php } ?>

</div>
</a>
</li> 
<?php } ?>



<?php


 if(!in_array(THEME_KEY,array("sp","cm","cp","cb")) && _ppt(array('lst','adminonly')) != "1" && $GLOBALS['accounttype']['can_add_multiple'] == 1){ ?>

<li class="hide-mobile hide-ipad <?php echo $css; $css=""; ?>" ppt-flex-middle>
<a href="<?php echo _ppt(array('links','add')); ?>" class="btn-secondary" data-ppt-btn>

<span><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></span>

</a>  
</li>


<?php } ?>
 

<li class="<?php echo $css; ?> ml-auto ml-lg-2 ml-xl-2" ppt-flex-middle>
<a href="<?php echo wp_logout_url(home_url()); ?>" class="btn-system" data-ppt-btn>
 <div ppt-icon-16 data-ppt-icon-size="16" class="show-mobile py-3 float-right" ppt-flex-middle><?php echo $CORE_UI->icons_svg['logout']; ?></div>
<span class="hide-mobile"><?php echo __("Logout","premiumpress") ?></span>

</a>  
</li>
<?php } ?>

</ul>
</nav>    
 
</div>
 

<div>


</div>

<?php
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>

<?php if(!in_array($page,array("messages"))){ ?>
<div ppt-border1 class="border-bottom-0 mobile-mb-2 mb-4 mb-xl-0 show-mobile">
  <div class="d-xl-flex" >
    <div class="h-100 account-left">
    
      <div ppt-box class="w-100 dropdown nohover show" id="menutopx">
      
      
        <div class="_header border-0 cursor" ppt-flex-row  onclick="AccountMenuToggle();">
          <div class="_title">
            <?php echo __("Account Options","premiumpress") ?> 
          </div>
          <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24">
              <?php echo $CORE_UI->icons_svg['chevron-down']; ?>
            </div>
          </div>
      </div> 
      
      </div>
    </div>
    
    <div class="w-100 d-none d-lg-block">
    
      <div ppt-box class="flex-column account-right">
      
        <div class="_header hide-mobile border-0 account-right-top" ppt-flex-row>
          <div class="_title">
          <?php if(isset($menu[$selectedpage]['name'])){ echo $menu[$selectedpage]['name']; } ?>
          
          </div>
          <a href="<?php echo _ppt(array('links','contact')); ?>" class="text-dark">
          <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24">
              <?php echo $CORE_UI->icons_svg['info-circle']; ?>
            </div>
          </div>
          </a>
        </div>
          
      </div>
    </div>
  </div>
</div>
<?php }  ?> 

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
?>
<div ppt-border1 class="mb-4 bg-light border-top-0 page-<?php echo $page; ?>">
  <div class="d-xl-flex" >
  
  
<?php if(!in_array($page,array("messages"))){ ?>

    <div class="h-100 account-left">
      <div ppt-box class="w-100">
     
       
        <div class="_content p-0" id="_account_menuitems">
          <?php
		  
		  
// ACCOUNT LINKS
  
foreach($menu as $k => $i){

//if($k == "memberships"){ continue; } 



if(in_array($k,array("comments")) && $CORE->USER("count_comments_by_user", $userdata->ID)  < 1){ continue; }

if(in_array($k,array("sellspace")) && $CORE->USER("count_sellspace_by_user", $userdata->ID) < 1){  continue; }

if(in_array($k,array("listings"))){  
 
	if($listng_data['total'] == 0){
	continue;
	}
}

 

$linkClass = "";
$num = 0;
 if($k == $selectedpage){
	$linkClass = "active";
}
if($k == "messages"){
$num = $CORE->USER("count_messages_unread", $userdata->ID);
}

if($k == "offers"){
	$of = $CORE->USER("count_offers", $userdata->ID);	
	if($of > 0){
	$num =  $of;
	}
}

if($k == "cashback"){
	$of = $CORE->USER("count_cashback", $userdata->ID);	
	if($of > 0){
	$num =  $of;
	}
}

if($k == "listings"){
	$num =  $listng_data['total'];
	if($num < 2){
		$i['name'] = str_replace("%s", $CORE->LAYOUT("captions","1"),__("My %s","premiumpress"));
	}
}

if($k == "friends"){
 	
	$fc = $CORE->USER("count_friends", $userdata->ID);
 
	if($fc > 0){
	$num =  $fc;
	}else{
	continue;
	}
}
 
if($k == "orders"){
	$user_credit = get_user_meta($userdata->ID,'ppt_usercredit',true);
	if(is_numeric($user_credit) && $user_credit != 0){
	$num = $user_credit;
	} 
}

?>

<a href="<?php echo _ppt(array('links','myaccount'))."/?tab=".$k; ?>"  ppt-list-item class="hover-bg-light <?php echo $linkClass; ?> page-link-<?php echo $k; ?>">
<div class="d-flex flex-row p-md-2 py-3">

  <div class="mr-3">  
    
    <div ppt-icon-24 ppt-icon-size="24">
      <?php echo $CORE_UI->icons_svg[$i['icon']]; ?>
    </div> 
 
  </div> 
  
  <div class="w-100" ppt-flex-between>
    <div>
    
      <div class="text-600 mb-2">
        <?php echo $i['name']; ?> 
		
		<?php if(( $k == "orders" && $num != 0) || ( $num > 0) ){ ?><span class="badge btn-danger <?php if($k == "orders"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php echo $num; ?></span>
		<?php }elseif($num > 0){ ?><span class="badge btn-warning <?php if($k == "orders"){ echo $CORE->GEO("price_formatting",array()); } ?>"><?php echo $num; ?></span>
		<?php } ?>
     
     
      </div>
      
      <div class="opacity-5 text-400 small">
        <?php echo $i['desc']; ?>
      </div>
    </div>

  </div>
</div>
</a> 
<?php
 

}

?>
        </div>
      </div>
    </div>

<?php } ?>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

    <div class="w-100 bg-white">
    
      <div ppt-box class="flex-column account-right shadow-0">
        
        <div class="_content <?php if(!in_array($page,array("messages"))){ ?>p-lg-5 p-3<?php }else{ ?>p-0<?php } ?>" > 
        
        <?php 
		 
		switch($page){
			
			case "advertising":
			case "sellspace": {			
			_ppt_template( 'account/account-sellspace' );			
			} break;
			case "offers": {			
			_ppt_template( 'account/account-offers' );			
			} break;					
			case "orders": {			
			_ppt_template( 'account/account-invoices' );			
			} break;						
			case "friends": {			
			_ppt_template( 'account/account-friends' );			
			} break;			
			case "membership": {			
			_ppt_template( 'account/account-membership' );			
			} break;		
			case "messages": {			
			_ppt_template( 'account/account-messages' );			
			} break;		
			case "listings": {			
			_ppt_template( 'account/account-listings' );			
			} break;				
			case "details": {			
			_ppt_template( 'account/account-settings' );			
			} break;
			case "downloads": {			
			_ppt_template( 'account/account-downloads' );			
			} break;
			case "cashback": {			
			_ppt_template( 'account/account-cashback' );			
			} break;
			case "likes": {			
			_ppt_template( 'account/account-likes' );			
			} break;
			case "comments": {			
			_ppt_template( 'account/account-comments' );			
			} break;
			case "resume": {			
			_ppt_template( 'account/account-resume' );			
			} break;
			case "store": {			
			_ppt_template( 'account/account-store' );			
			} break;
			case "paywall": {			
			_ppt_template( 'account/account-paywall' );			
			} break;						
			default: {			
			_ppt_template( 'account/account-dashboard' );			
			} break;			
		
		}
		
		?> 
       
        </div> 
      </div>
    </div>
  </div>
</div>
 
<script>
 
<?php if(in_array($page,array("messages"))){ ?>               
jQuery(document).ready(function(){ 
ajax_load_chat_list(); 
});	  
				  
<?php } ?> 	 


function AccountMenuToggle(){

<?php if(in_array($page,array("messages"))){ ?>
window.location = '<?php echo _ppt(array('links','myaccount')); ?>';
<?php }else{ ?>
jQuery('#_account_menuitems').toggleClass("hide");
<?php } ?>


}
function AccountMenuOff(){
jQuery('#_account_menuitems').addClass("hide");	
jQuery('.account-right-top').hide();
}
function AccountMenuOn(){
jQuery('#_account_menuitems').removeClass("hide");

jQuery('.account-right-top').show();
}
jQuery(window).on('resize',function () {

	var wins = jQuery(window).width();
	if (wins  < 1200){	
	
	if(jQuery('#menutopx').hasClass("show")){
	
	}else{
	AccountMenuOff();
	}
	
	
	}else{
	AccountMenuOn();
	}
});
jQuery(window).on('load',function () {

	var wins = jQuery(window).width();
	if (wins  < 1200){	
	AccountMenuOff();
	}else{
	AccountMenuOn();
	}

}); 
</script>
<style>


@media (min-width: 1200px) {
.account-left > [ppt-box]  { min-width:355px; max-width:355px; margin: -1px; }
.account-left {  background:red; } 
}

@media (min-width: 575.98px) {
.account-right { border-bottom:0px!important; }
}
@media (max-width: 1200px) {
.account-left { margin: -1px; }
.account-right { margin: -1px; border-top: 0px!important;; }
}

.account-right { margin-right: -1px;    margin-top: -1px; }
#_account_menuitems.hide [ppt-list-item]  { display:none; }

.hover-bg-light:hover, .hover-bg-light.active { background:#fbfbfb; }
 
</style> 
</div>