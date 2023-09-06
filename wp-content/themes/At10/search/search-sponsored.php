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

global $CORE, $CORE_UI, $wpdb, $wp_query, $userdata;

$GLOBALS['flag-sponsored-shown'] = 0;

if(isset($_GET['hidefilters'])){

}elseif( _ppt(array('design', 'search_sponsored')) == "0"){


}elseif(( !in_array(THEME_KEY,array("sp","cm","cp","cb")) && !isset($GLOBALS['flag-sponsored-top']) && _ppt(array('lst','addon_sponsored_enable')) == "1" )  ){


if( isset($GLOBALS['flag-taxonomy']) && in_array($GLOBALS['flag-taxonomy-type'],array("store","country"))){

}else{

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

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

if(!empty($postData["posts"])){
?>

<div class="card-sponsored p-3 mb-4 rounded hide-mobile overflow-hidden" style="overflow-x: visible; display:none;" ppt-border1>


<div class="owl-carousel owl-theme" data-1200="8" data-1000="6" data-600="4" data-0="2" data-margin="20" data-autoplay="1" style="z-index:12">
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
<div class="item">


<div class="badge_tooltip" data-direction="top">
    <div class="badge_tooltip__initiator"> 
  <a href="<?php echo get_permalink($s); ?>" class="text-dark">
  
<div class="position-relative overflow-hidden rounded border" style="height:100px;max-width:120px;">
    <div class="bg-image" data-bg="<?php echo $image; ?>">
    
    </div>
</div>
  
  </a>
    </div>
    <div class="badge_tooltip__item text-center">
	<?php echo $title; ?>
    </div>
  </div>
  
<?php
/*
   <a class="btn bg-white btn-sm text-muted prev px-2 mt-md-2 border"><i class="fa fa-angle-left px-1" aria-hidden="true"></i></a>
        <a class="btn bg-white btn-sm text-muted next px-2 mt-md-2 border"><i class="fa fa-angle-right px-1" aria-hidden="true"></i></a>
*/
?>

</div>
<?php 

$GLOBALS['flag-sponsored-shown']++;

} ?>

</div>
</div>


<?php } 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
}
}
?>