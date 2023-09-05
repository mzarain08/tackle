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

global $post, $CORE_UI, $userdata, $CORE;

	
$hits = do_shortcode("[HITS]");
if(!is_numeric($hits)){ $hits = 0; }
$hits = number_format($hits);

// THIS THEME
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$ThisTheme = THEME_KEY;
if(isset($GLOBALS['TEST_THEME_KEY'])){
	$ThisTheme = $GLOBALS['TEST_THEME_KEY'];
}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$show_msg = 0;
if(in_array(_ppt(array('searchcardvals','msg')),array("1")) && !in_array($ThisTheme, array("sp","cm")) ){
$show_msg = 1;
}
if(!in_array($ThisTheme, array("dt","sp","cm","cp","jb","vt","rt","cb")) && _ppt(array('searchcardvals','msg')) == ""){
$show_msg = 1;
}

$show_favs = 0;
if(in_array(_ppt(array('searchcardvals','favs')),array("1"))){
$show_favs = 1;
}

if(!in_array($ThisTheme, array("cp")) && _ppt(array('searchcardvals','favs')) == ""){
$show_favs = 1;
}

$show_qr = 0;
if(in_array(_ppt(array('searchcardvals','qr')),array("1"))){
$show_qr = 1;
}
if( !in_array($ThisTheme, array("da","es")) && _ppt(array('searchcardvals','qr')) == ""){
$show_qr = 1;
}


$show_map = 0;
if(in_array($ThisTheme, array("dt","rt","jb"))){
$show_map = 1;
	if(_ppt(array('searchcardvals','msg')) == "0"){
	$show_map = 0;
	}
}

$show_views = 0;
if(in_array($ThisTheme,array("xx"))){
$show_views = 1;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


<?php if($show_qr ){ ?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="mr-2 qr-hover" data-qr-img="qrcode-image-%postid%" data-qr-link="%link%">
      <?php echo $CORE_UI->icons_svg['qr']; ?>
    </div>
  </div>
  <div class="badge_tooltip__item z-10">
    <div class="qrcode-image-%postid%">
    </div>
    <div class="fs-sm">
      <?php echo __("Scan QR code to view on mobile device.","premiumpress"); ?>
    </div>
  </div>
</div>
<?php } ?>




<?php if($show_msg){ ?>

<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="mr-2" onclick="<?php if(!$userdata->ID){ ?>processLogin(1);<?php }else{ ?>processMessage('<?php if(isset($post->post_author)){ echo $post->post_author; } ?>');<?php } ?>">
      <?php echo $CORE_UI->icons_svg['chat2']; ?>
    </div>
  </div>
  <div class="badge_tooltip__item">
    <?php echo __("Send Message","premiumpress"); ?>
  </div>
</div>
<?php } ?>


<?php if($show_favs){ ?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="hidefavs" onclick="<?php if(!$userdata->ID){ ?>processLogin(1);<?php }else{ ?>processFavsSwitch('%postid%');<?php } ?>">
      <?php echo $CORE_UI->icons_svg['heart']; ?>
    </div>
  </div>
  <div class="badge_tooltip__item">
    <?php echo __("Add Favorites","premiumpress"); ?>
  </div>
</div>
<div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="text-primary showfavs">
  <?php echo $CORE_UI->icons_svg['heart-full']; ?>
</div>
<?php } ?>


<?php if(in_array($ThisTheme,array("at"))  && do_shortcode('[BIDS]') > 0 ){ 

$bids = do_shortcode('[BIDS]');

?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="ml-2 text-success">
      <?php echo $CORE_UI->icons_svg['users']; ?><span class="fs-xs"><?php echo $bids; ?></span>
    </div>
  </div>
  <div class="badge_tooltip__item">
    <?php if($bids == 1){ echo $bids." ".__("bid","premiumpress"); }else{ echo $bids." ".__("bids","premiumpress"); } ?>
  </div>
</div>

<?php } ?>


<?php if(in_array($ThisTheme,array("sp")) && in_array(_ppt(array('searchcardvals','rating')),array("","1"))){   ?>

<div class="mt-n1 ml-2">
<?php echo do_shortcode('[RATING bg="" short="1" hide_empty="1" reviews_show="0"]'); ?>
</div>
  
<?php } ?>


<?php if($show_views){ ?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" style="cursor:pointer" class="ml-2 js-text-primary">
      <?php echo $CORE_UI->icons_svg['users']; ?><span class="fs-xs"><?php echo $hits; ?></span>
    </div>
  </div>
  <div class="badge_tooltip__item">
    <?php echo $hits." ".__("Views","premiumpress"); ?>
  </div>
</div>
<?php } ?>

<?php if($show_map){ ?>
<div class="badge_tooltip text-center" data-direction="top">
  <div class="badge_tooltip__initiator">
    <div ppt-icon-24 data-ppt-icon-size="24" class="ml-2 js-text-primary" style="cursor:pointer" >
      <?php echo $CORE_UI->icons_svg['map-marker']; ?>
    </div>
  </div>
  <div class="badge_tooltip__item">
    <?php if(isset($post->maplocation)){ echo $post->maplocation; }  ?>
  </div>
</div>
<?php } ?>

<?php if($ThisTheme == "cp"){ ?>
<?php echo do_shortcode("[CASHBACK text='".__("Earn %s cashback!","premiumpress")."' svg=1]"); ?>
<?php } ?>