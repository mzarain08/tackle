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

global $CORE, $userdata;

if(!isset($GLOBALS['widget-da-set'])){ $GLOBALS['widget-da-set'] = 1;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function filterDisplay($type, $key, $default){

 
switch($type){
	
	case "icon": {
		
		if($key == "dagender" && trim(strtolower($default)) == "male"){
			return "&#x1F466;";
			
		}elseif($key == "dagender" && trim(strtolower($default)) == "female"){
			return "&#x1F467;";
		
		}elseif($key == "dagender" && trim(strtolower($default)) == "couples"){
			return "&#x1F46B;";
		} 
	
	} break;
	
	case "title": {
	
		if($key == "dagender" && trim(strtolower($default)) == "male"){
		
			return __("Guys","premiumpress");
			
		}elseif($key == "dagender" && trim(strtolower($default)) == "female"){
		
			return __("Girls","premiumpress");
		}
	
	} break;

}

return $default;

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$photo		= CDN_PATH."images/nouser.jpg";
$username = __("Guest","premiumpress");
$count_favs = 0;

// USER DATA
if($userdata->ID){

	$photo 			= $CORE->USER("get_avatar",$userdata->ID);
	//$url 			= get_user_meta($userdata->ID,'url',true); 
	$username 		= $CORE->USER("get_username",$userdata->ID);
	$email 			= $CORE->USER("get_email",$userdata->ID);
	$joined 		= $CORE->USER("get_joined", $userdata->ID);
	$joined 		= date("M, Y",strtotime($joined));
	$last 			= $CORE->USER("get_lastlogin", $userdata->ID);
	//$country 		= $CORE->USER("get_country", $userdata->ID);
	$country_flag 	= $CORE->USER("get_country_flag", $userdata->ID);
	
	$count_favs = $CORE->USER("favs_count", $userdata->ID);

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




?>


<a <?php if($userdata->ID){ ?>href="<?php echo _ppt(array('links','myaccount')); ?>"<?php }else{ ?> href="#" onclick="processRegister();"<?php } ?> class="text-decoration-none text-dark link-dark btn-block mb-5">
  
<div class="d-flex"> 
   
    <div style="width:80px; height:50px;" class="bg-light mr-4 rounded overflow-hidden position-relative shadow">
    <div class="bg-image"  data-bg="<?php echo $photo; ?>"></div>
    </div> 

	<div class="w-100">  
    
        <div class="text-700"><?php echo $username; ?></div>
          
        <?php if($userdata->ID){ ?>
        <div class="small"><?php echo __("my account","premiumpress"); ?></div>  
        <?php }else{ ?>
        <div class="small"><?php echo __("signup free now!","premiumpress"); ?></div>   
    	<?php } ?>
    	 
 	</div> 
   
</div>

</a>



<?php 

$links = array();
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
//$links["distance"] = array("type" => "sort", "title" => "People nerby", "link" => "", "icon" => "&#x1F30D;");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$taxonomy = "dagender";
register_taxonomy( $taxonomy, THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => array('name' => $taxonomy) , 
	'query_var' => true, 'rewrite' => true, 'rewrite' => array('slug' => $taxonomy) ) ); 
 
$cats = get_terms( $taxonomy, array( 'hide_empty' => 0, 'parent' => 0  ));

foreach($cats as $cat){ 

$links[$cat->term_id] = array("type" => "dagender", "title" => $CORE->GEO("translation_tax", array($cat->term_id, $cat->name)), "link" => "", "icon" => $cat->slug, "count" => 0);

?>

 <input 
    type="checkbox"
    value="<?php echo $cat->term_id; ?>" 
    name="catid[]" 
    class="customfilter filter-<?php echo $taxonomy; ?> filterid-<?php echo $cat->term_id; ?>" 
    data-type="checkbox" 
    onclick="_filter_update()" 
    data-key="taxonomy" 
    data-value="<?php echo $taxonomy; ?>-<?php echo $cat->term_id; ?>" style="display:none;">
<?php


}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 	
$links["pop"] = array("type" => "sort", "title" => "Most populars", "link" => "", "icon" => "&#x1F4A5;");
	
$links["favs"] = array("type" => "sort", "title" => "Favorites", "link" => "", "icon" => "&#x1F496;", "count" => $count_favs);

$links["messages"] = array("type" => "link", "title" => "Messages", "link" => "", "icon" => "&#x1F4EB;");

	
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$membership = 0;
if($userdata->ID){

	$mymem = $CORE->USER("get_user_membership", $userdata->ID); 
	if(isset($mymem['expired']) && $mymem['expired'] == 0){
		
		$membership = 1;
		
	}
}	

$boosted = 0;
if($userdata->ID){
	$boostData = get_user_meta($userdata->ID, 'upgrade_boost', true);
	if(is_array($boostData) && !empty($boostData)){
	 
		$BoostEnds 	= $boostData['end'];
		$BoostStart = $boostData['start'];		
		$hh = $CORE->date_timediff($BoostEnds,$BoostStart);
	 
		if($hh['expired'] == 0){
			$boosted = 1;
		}
	} 
}


$links["membership"] = array("type" => "link", "title" => "Membership", "link" => "", "icon" => "&#x1F600;");

$links["boosted"] = array("type" => "link", "title" => "Boosted", "link" => "", "icon" => "&#x1F680;");
 
	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




foreach($links as $k => $l){ ?>

<div class="mb-2 da-widget-menu"> 



<?php if($k == "membership"){ ?>

<a href="<?php echo _ppt(array('links','memberships')); ?>" class="text-600 text-dark">

<span class="float-right"> 
<?php if($membership){ ?> <i class="fa fa-toggle-on"></i> <?php }else{ ?> <i class="fa fa-toggle-off opacity-5"></i> <?php  } ?>
</span> 

<?php }elseif($k == "boosted"){ ?>

<a href="javascript:void(0);" onclick="processBoost();" class="text-600 text-dark">

<span class="float-right">
<?php if($boosted){ ?> <i class="fa fa-toggle-on"></i> <?php }else{ ?> <i class="fa fa-toggle-off opacity-5"></i> <?php  } ?>
</span>

<?php }else{ ?>

<a href="javascript:void(0)" onclick="pptProcessLink('<?php echo $k; ?>','<?php echo $l['type']; ?>');" class="text-600 text-dark">

<?php if(isset($l['count']) && $l['count'] > 0){ ?><span class="float-right count count-<?php echo $k; ?>"><?php echo $l['count']; ?></span><?php } ?>


<?php } ?>





<div class="d-flex">
    <div class="mr-2"><?php echo filterDisplay("icon",$l['type'],$l['icon']); ?></div>    
    <div><?php echo filterDisplay("title",$l['type'],$l['title']); ?></div>
</div> 

</a>
 
<span class="line-fade1 mt-2"></span>
<span class="line-fade2"></span>

</div>



<?php } 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<script>

function pptProcessLink(key, type){

 
 	jQuery("#filter-custom-favs").removeClass('customfilter');	
	
	if(type == "sort"){
	
		
	
		var sortField = jQuery('#filter-sortby-main');
	
			if(key == "favs"){	
			jQuery("#filter-custom-favs").addClass('customfilter');	
			
			
				if(jQuery("#ajax-search-output").length == 0){
				window.location.href='<?php echo home_url(); ?>/?s=&favs=1';
				return;
				}
			
			}
			
			if(key == "pop"){	
			jQuery("#filter-sortby-main").val('pop');	 
			}
			
			if(key == "distance"){	
			jQuery("#filter-sortby-main").val('distance');	 
			}
			
		if(jQuery("#ajax-search-output").length == 0){
		window.location.href='<?php echo home_url(); ?>/?s=';
		return;
		}
		
		// CHANGE SORT ORDER
		if(sortField.hasClass('up')){
		
			sortField.removeClass('up').addClass('down');
			sortField.val(sortField.attr("data-key")+'-u');
		
		}else{
			
			sortField.removeClass('down').addClass('up');
			sortField.val(sortField.attr("data-key")+'-d');
		
		}
		
		_filter_update(); 
		
	
	}else if(type == "link"){	
		
		if(key == "messages"){
		
		window.location.href='<?php echo _ppt(array('links','chatroom')); ?>';
		
		}else if(key == "membership"){
		
		window.location.href='<?php echo _ppt(array('links','memberships')); ?>';
		
		}
	
	} else {
 
		if(jQuery("#ajax-search-output").length == 0){
		window.location.href='<?php echo home_url(); ?>/?s=&tax-'+type+'='+key;
		return;
		}
	
		if(type == "dagender"){		 
			jQuery(".filter-dagender").attr('checked', false);		
		}
		if(jQuery(".filterid-"+key).length > 0){
		
			jQuery(".filterid-"+key).attr('checked', true);
			
			_filter_update(); 
			
		}	
	
	}	 
	

}

function processLikeSwitch(id){


	card = jQuery("[data-pid='"+id+"']");
	
	favscount = 0;
	if(jQuery(".count-favs").lenght > 0){
	favscount = parseFloat(jQuery(".count-favs").html());
	}
	 
	
	if(card.hasClass("isLiked")){
	
		card.removeClass("isLiked");
		card.find("._cancel").hide();
		card.find("._ok").show();
		vote = "down";		
		favscount=favscount-1;		
	}else{
	
		card.addClass("isLiked");
		card.find("._cancel").show();
		card.find("._ok").hide();
		vote = "up";		
		favscount=favscount+1;	
	}
	
	if(favscount < 0){ favscount = 0; }
	jQuery(".count-favs").html(favscount);
	
 	jQuery.ajax({
        type: "POST",  
		url: ajax_site_url,	
        data: {
            action: "rating_likes",
			pid: id,
            value: vote,
        },
        success: function(e) { 
			   
			 
			jQuery.ajax({
				type: "POST",
				url: ajax_site_url,	
				dataType: 'json',	
				data: {
					'action': "favs",
					'pid': id,				 
				},
				success: function(response) { } 
			}); 
			 
			 
			 hasRated = true;
        },
        error: function(e) {
             
        }
    }); 

}


</script>
 


<input type="hidden" name="sort" class="customfilter" id="filter-sortby-main" data-type="select" data-key="sortby"> 

<input type="hidden" id="filter-custom-favs"  name="favorites" data-type="text" data-key="favorites" value="1" >
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['flag-sponsored-top'] = 1;

$args = array('posts_per_page' => "10", 
			'post_type' => "listing_type", 'orderby' => "random", 'order' => "desc", 'paged'  => 0, 'offset'  => 0,
			'meta_query' => array ( 
						 			  			 
							'homepage'    => array(
								'key' 			=> 'sponsored',								 
								'value' 		=> 1,
								'compare' 		=> '=',								 			
							),			 
					 
				  )
); 

$postData = array("args" => $args, "posts" => array() );  
$sponsored_query = new WP_Query( $args ); 
if ( $sponsored_query->have_posts() ) {	
	foreach($sponsored_query->posts as $p){
		$postData["posts"][$p->ID] = $p->ID;		
	}
}

shuffle($postData["posts"]);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$boostPosts = array();
if(_ppt(array('lst','addon_boost_enable')) == "1"){
		global $CORE;
		$boostPosts = $CORE->USER("boost_get_user_posts", array());
		if(is_array($boostPosts) && !empty($boostPosts)){
			foreach($boostPosts as $bp){				
				if(!isset($postData["posts"][$bp])){
					$postData["posts"][$bp] = $bp;	
				}			
			}		
	}	
}	

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div class="mt-2 pt-1 small mt-4">

<span class="text-600">
<?php echo __("Sponsored","premiumpress"); ?></span> -  <a href="javascript:void(0);" onclick="<?php if(!$userdata->ID){ ?>processLogin();<?php }else{ ?>processSponsored(0);<?php } ?>"><?php echo __("Add me","premiumpress"); ?></a>
</div>

<?php

if(!empty($postData["posts"])){
?>

 


<div class="row no-gutters mt-2">
<?php foreach($postData["posts"] as $s){
 
$image = do_shortcode("[IMAGE pid='".$s."' pathonly=1]");
$title = do_shortcode("[TITLE pid='".$s."']");

if(in_array(THEME_KEY, array("da","es"))){

	$age = do_shortcode("[AGE uid='".$s."']");
	 $title .= "<div class='small opacity-5'>";
	if($age != ""){ 
		 $title .= "".$age;
	} 
		 
	$city = do_shortcode("[CITY uid='".$s."']");
	if($city != ""){ 
		 $title .= " - ".$city;
	} 
	 $title .= "</div>";

}elseif(in_array(THEME_KEY, array("pj"))){
 
	$image = $CORE->USER("get_avatar", get_post_field ('post_author', $s) );
}

?>
<div class="col-md-3">


<div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"> 
  <a href="<?php echo get_permalink($s); ?>" class="text-dark">
  
<div class="position-relative overflow-hidden rounded border" style="height:60px;max-width:120px;">
    <div class="bg-image" data-bg="<?php echo $image; ?>">
    
    </div>
</div>
  
  </a>
    </div>
    <div class="badge_tooltip__item text-center">
	<?php echo $title; ?>
    </div>
  </div> 
</div>
<?php } ?>
</div>

<?php } } ?>