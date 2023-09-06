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
global $CORE, $authorID, $CORE, $CORE_UI;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// GET DESC
$desc 			= get_the_author_meta( 'description', $authorID);
$photo 			= $CORE->USER("get_avatar",$authorID);

$currentimg = get_user_meta($authorID, "userphoto", true);
if(isset($currentimg['src'])){
$photo = $currentimg['src'];
}

$url 			= get_user_meta($authorID,'url',true); 
if(strlen($url) > 4 && substr($url,0,4) != "http"){
	$url = "https://".$url;
}
 

// BACKGROUND
$userbg		 	= get_user_meta($authorID, "userbg", true);
 
if(is_array($userbg) && isset($userbg['src']) && strlen($userbg['src']) > 2){
	$background = $userbg['src'];
}else{
 
	$bgimg		 	= get_user_meta($authorID, "backgroundimg", true);
		
	if(!is_numeric($bgimg)){
	$bgimg = rand(1,9);
	}
	
	if(_ppt(array('bgimg', $bgimg)) == ""){ 	
	$background = DEMO_IMG_PATH."backgroundimages/".$bgimg.".jpg";	
	}else{ 
	$background = _ppt(array('bgimg', $bgimg ));
	}
	
}

if(defined('WLT_DEMOMODE')){
$url 	= "https://www.premiumpress.com";
}



// ACCUNT TYPE
$accounttype = $CORE->USER("get_account_type", $authorID);
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_header();

	
?>
<style>
.list-list span:not(.hasCountdown)+span:before {
 color: #eeeeee !important;
}
</style>
<div class="container my-4">
  <div class="row">
    <?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="col-12">
      <div class="rounded ppt-avatar-card overflow-hidden mb-4 card pb-2">
        <div class="bg-primary overflow-hidden position-relative" style="height:200px;">
          <div class="overlay-inner z-1">
          </div>
          <div class="bg-image" data-image="<?php echo $background; ?>">
          </div>
          <?php if(_ppt(array('user', 'author_links')) != 0 && strlen($url) > 5){  ?>
          <a href="<?php echo $url; ?>" class="btn hide-mobile hide-ipad" target="_blank" rel="nofollow" style="z-index:999; background:#00000036; color:#fff; font-weight:bold; position:absolute; bottom:10px; right:10px;"><?php echo __("Visit Website","premiumpress"); ?> <i class="ml-2 fa fa-external-link"></i> </a>
          <?php } ?>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xl-11 offset-xl-1">
              <div class="d-lg-flex mt-4 justify-content-between text-center text-md-left">
                <div>
                  <div class="d-md-flex">
                    <div class="ppt-avatar bg-image mt-n5 mr-md-4" data-image="<?php echo $photo; ?>" style="z-index:999;">
                      <?php if($CORE->USER("get_verified", $authorID) == "1"){ ?>
                      <span class="ppt-icon-online"> <span class="ripple"></span> <span class="ripple"></span> <span class="ripple"></span> </span>
                      <?php } ?>
                    </div>
                    <div>
                      <div class="mb-0 d-flex align-items-center">
                        <div class="text-700 fs-md">
                          <?php echo $CORE->USER("get_display_name",$authorID); ?>
                        </div>
                        <?php if(!in_array(THEME_KEY,array("es","vt","jb","dt"))){ ?>
                        <div class="ml-3">
                          <?php echo do_shortcode('[RATING_USER uid='.$authorID.' size="md" total_show="0" reviews_show="0"  ]'); ?>
                        </div>
                        <?php } ?>
                      </div>
                      <div class="mt-4 list-list small text-uppercase letter-spacing-1">
                        <span class="text-600">
                        <?php  if(isset($accounttype) && strlen($accounttype['name']) > 1){ echo $accounttype['name']; }else{ echo __("Member","premiumpress"); } ?>
                        </span> <span><?php echo $CORE->USER("get_total_account_views",$authorID)." ". __("views","premiumpress"); ?> </span> <span><?php echo $CORE->USER("get_subscribers_count", $authorID)." ". __("subscribers","premiumpress"); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="d-md-flex justify-content-between mt-3">
                    <?php if(_ppt(array('user','account_messages')) == 1){ ?>
                    <div class="mr-md-3">
                      <a href="javascript:void(0);" onClick="processMessage(<?php echo $authorID; ?>);" data-ppt-btn class="btn-system btn-block btn-lg mb-2"> <span><?php echo __("Message Me","premiumpress"); ?></span> </a>
                    </div>
                    <?php } ?>
                    <div>
                    </div>
                  </div>
                  <div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="col-lg-9">
      <?php if($CORE->USER("count_listings", $authorID) == 0){ ?>
      <div class="card">
        <div class="card-body text-center py-5">
          <h4><?php echo __("Nothing Found","premiumpress") ?></h4>
          <p class="mt-4"><?php echo __("This user has not published anything yet.","premiumpress") ?></p>
        </div>
      </div>
      <?php }else{  ?>
		
     
        <?php 
			if(in_array(THEME_KEY, array("pj"))){
			global $settings;
			$settings['card'] = "list";
			echo do_shortcode('[LISTINGS card="list" dataonly=1 nav=0 custom=author authorid='.$authorID.' ]');
			}else{
			 echo do_shortcode('[LISTINGS card_class="col-md-4" dataonly=1 nav=0 custom=author authorid='.$authorID.' ]'); 
		 	}
			?>
            
            <?php
 }
 //if(_ppt(array('user','author_ads')) == 1){  }  ?>
    </div>
    <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
    <div class="col-lg-3">
      <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
      <div class="card">
        <div class="card-body">
          <h5 class="text-600 mb-3">
            <?php  echo __("About","premiumpress"); ?>
          </h5>
          <?php if(strlen($desc) > 1){ ?>
          <?php echo str_replace("<p>","<p class='mb-0x small'>",wpautop($desc)); ?>
          <?php }


// VERIFIED
if($CORE->USER("get_verified", $authorID) == "1"){
$verified = '<span class="onlinebadge online text-dark badge border px-2 bg-white"><i class="fa fa-award text-success"></i> '.__("Email Verified","premiumpress").'</span>';
}else{
$verified = '<span class="onlinebadge online text-dark badge border px-2 bg-white"><i class="fa fa-award text-danger"></i> '.__("Not Verified","premiumpress").'</span>';
}

$mydetails = array(
	
	1 => array(
		"icon" => "fal fa-user-tie",
		"title" =>  __("Joined","premiumpress"),
		"value" =>  $CORE->USER("get_joined",  $authorID),		
	),
	
	2 => array(
		"icon" => "fal fa-lightbulb",
		"title" =>  __("Last Online","premiumpress"),
		"value" => $CORE->USER("get_lastlogin",  $authorID),	
	),

	3 => array(
		"icon" => "fal fa-globe",
		"title" =>  __("Location","premiumpress"),
		"value" => $CORE->USER("get_country", $authorID)." ".$CORE->USER("get_country_flag", $authorID),	
	),
	
	4 => array(
		"icon" => "fal fa-envelope",
		"title" =>  __("User Verified","premiumpress"),
		"value" => $verified,	
	),

/*
	5 => array(
		"icon" => "fal fa-award",
		"title" =>  __("User Level","premiumpress"),
		"value" => "<span class='badge badge-success'>".__("Level","premiumpress")." ".$CORE->USER("get_level",  $authorID)."</span>",	
	),
*/	
	
	6 => array(
		"icon" => "fal fa-sync",
		"title" =>  __("Jobs Sold","premiumpress"),
		"value" => $CORE->USER("count_offers_complete", $authorID),	
	),	
	
	7 => array(
		"icon" => "fal fa-clock",
		"title" =>  __("Orders in Queue","premiumpress"),
		"value" => $CORE->USER("count_offers_pending", $authorID),	
	),		
	  
 
);


if($CORE->USER("get_country", $authorID) == ""){
unset($mydetails[3]);
}

if(_ppt(array('user','level')) == "0"){
unset($mydetails[5]);
}

if(in_array(THEME_KEY, array("pj")) && get_user_meta($authorID,'user_type',true) == "user_fr" ){

	$rate = get_user_meta($authorID,'ppt_hourlyrate',true);
	if(is_numeric($rate) && $rate != "0"){
	$rate = hook_price($rate);
	}else{
	$rate =  __("negotiable","premiumpress");
	}

	$mydetails[8] = array(
		"icon" => "fal fa-funnel-dollar",
		"title" =>  __("Hourly Rate","premiumpress"),
		"value" => $rate	
	);
}

if(!in_array(THEME_KEY, array("mj")) ){
	
	unset($mydetails[5]);
	unset($mydetails[6]);
	unset($mydetails[7]);
}else{

	if(THEME_KEY == "at"){
		$mydetails[6]['title'] = __("Auctions Sold","premiumpress");
		$mydetails[7]['title'] = __("Auctions Pending Review","premiumpress");
	}
}

 ?>
          <ul class="list-group list-group-flush small text-uppercase">
            <?php foreach($mydetails as $d){ ?>
            <li class="list-group-item d-flex px-0 justify-content-between"> <strong><?php echo $d['title']; ?></strong> <span class="mb-0"><?php echo $d['value']; ?></span> </li>
            <?php } ?>
          </ul>
        </div>
        <div class="card-footer bg-white border-top">
          <?php echo do_shortcode('[BUTTON_USER type="subscribe" class="btn-system btn-block list" text=1 uid="'.$authorID.'"]'); ?> <?php echo do_shortcode('[BUTTON_USER type="block" class="btn-system btn-block mt-4 list" text=1 uid="'.$authorID.'"]'); ?>
        </div>
      </div>
      <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(in_array(THEME_KEY, array("mj","at","pj","ct","dl")) && _ppt(array('user','ratings')) == 1 ){

$data = $CORE->USER("feedback_score", $authorID); 
 
$ratingLabels = array(

	"1" => __('Very Poor',"premiumpress"),
	"2" =>  __('Below Average',"premiumpress"),	
	"3" =>  __('Average',"premiumpress"),
	"4" =>  __('Above Average',"premiumpress"),
	"5" =>  __('Perfect',"premiumpress"),

 );
 

if($data['votes'] > 0){
 ?>
      <div class="card card-author-extra mb-4 myrating mt-4">
        <div class="card-body">
          <h4 class="text-600">
            <?php  echo __("My Rating","premiumpress"); ?>
          </h4>
          <div class="mb-3">
            <?php echo do_shortcode('[RATING_USER uid='.$authorID.']'); ?>
          </div>
          <?php $i=5; while($i > 0){
		 
		 if(isset($data['data'][$i])){  $to = $data['data'][$i]; }else{  $to = 0; } 
		 
		 
		 ?>
          <div class="row <?php if($to > 0){ ?>mb-2<?php } ?>">
            <div class="col-11">
              <label class="pb-0 mb-0 small mb-2 w-100"> <span class="font-weight-bold text-uppercase text-muted"><?php echo $ratingLabels[$i]; ?></span>
              <?php if($to > 0){ ?>
              <span class="float-right small"> <a href="javascript:void(0);" onclick="showcomments('<?php echo $i; ?>','<?php echo $ratingLabels[$i]; ?>');">
              <?php  echo __("view comments","premiumpress"); ?>
              </a></span>
              <?php } ?>
              </label>
              <div class="progress rounded-0">
                <div class="progress-bar bg-warning rounded-lg" role="progressbar" style="width: <?php if($to == 0){ echo 0; }else{ echo $to/$data['votes']*100; } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
            <div class="col-1 px-0">
              <span class="rating-result-count <?php if($to == 0){ ?>bg-light text-dark<?php } ?>"><?php echo $to; ?></span>
            </div>
          </div>
          <?php $i--; } ?>
        </div>
      </div>
      <!--comments-modal -->
      <script>
function showcomments(rr, text){

	rre = rr + 1;
	 
	 
	  jQuery.ajax({
			type: "POST",  
			url: ajax_site_url,	
			data: {
				action: "get_comments",
				uid: <?php echo $authorID; ?>,
				value1: rr,
				value2: rre,
			},
			success: function(comment_data) {			 
				
				 
				pptModal("feedback", comment_data, "modal-bottom-rightxxx", "ppt-animate-bouncein bg-white w-700", 1);
				 
				 
			},
			error: function(e) {
				 
			}
		});	
	 
}
</script>
      <?php } } ?>
    </div>
    <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
  </div>
</div>
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
get_footer(); ?>