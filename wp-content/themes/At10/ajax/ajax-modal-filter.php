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

global $CORE;

$filters = ppt_theme_main_filters();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$type = $_POST['showtax'];
$id = $_POST['fid'];
$sidebar = 0;


if(isset($_POST['sidebar'])){
$sidebar = 1;
}
 

$title = SearchFilterCaptions($id, $type);

if($title == "tax"){

	$title = $CORE->GEO("translation_tax_key", str_replace("tax_","",$id));
}

$filterList = ppt_theme_main_filters();
foreach($filterList as $filter){
	if($id == $filter['key']){
		$ThisFilter =  $filter;
	}
}
 

if( ( $title == "" || $title == $type ) && isset($ThisFilter) ){
$title = $ThisFilter['name'];
}


$filter = $id;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$em = array("&#x1F600;","&#x1F604;","&#x1F60A;","&#x1F60B;","&#x1F60E;","&#x1F642;");
$k = array_rand($em, 1);
$v = $em[$k];

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!$sidebar){
?>
<div class="card-popup medium">
<div class="bg-primary pt-3">
    <div class="card-popup-content" style="min-height: 130px;">    
    <div class="text-white mt-3">     
    	<strong class="h1"><?php if(in_array(_ppt(array('design', 'ppt_emoji')), array("","1"))){  echo $v; } ?> <?php echo $title; ?></strong>
    	<?php /*<div class="text-truncate mt-2 opacity-8">asdasd</div>*/ ?>
    </div>      
    </div>      
</div>

<div class="card-body pt-0 filter-<?php echo $filter; ?>" >
<div class="ppt-scroll ppt-scroll<?php echo $filter; ?>" data-target="ppt-scroll<?php echo $filter; ?>">
<div  style="max-height:400px; <?php if(in_array($filter,array("distance","location","makemodel"))){ ?>min-height:250px;<?php } ?>">
<?php }

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
if(in_array($filter,array("tax_age","age"))){

_ppt_template( 'filters/filter-age' );

}elseif(in_array($filter,array("deliver"))){

_ppt_template( 'filters/filter-delivery' );

}elseif(in_array($filter,array("seller"))){

_ppt_template( 'filters/filter-seller' );

}elseif(in_array($filter,array("distance"))){

_ppt_template( 'filters/filter-distance' ); 

}elseif(in_array($filter,array("location","tax_country"))){

 
_ppt_template( 'filters/filter-distance-countrylist' );
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


}else{

 
	if($filter == "tax_listing" && is_numeric($type) ){ 
	$GLOBALS['flag-parent-id'] = $type;
	}


		// BUILD DATA
		global  $filter_data;
		$filter_data = array(			
			"title" => $title, 
			"key" 	=> strip_tags(str_replace("-","",$filter)),
			"tax" 	=> str_replace("tax_","",$filter),
			"nav" 	=> 0,
			"wrap_css" => "",
			"css" 	=> "",
			"count" => _ppt(array('search','count')),
		);
	 	 
		 
        // DESIGN MIDDLE
        if(substr($filter,0,4) == "tax_"){
			 
            _ppt_template( 'filters/filter-tax' );
            
        }else{
		    
            _ppt_template( 'filters/filter-'.$filter );
            
        } 

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!$sidebar){
?>
</div>
</div> 
</div> 

<script>
jQuery(document).ready(function(){ 
 
const qs = new PerfectScrollbar('.ppt-scroll<?php echo $filter; ?>');

});
  
 
jQuery(document).ready(function(){ 

_filter_counterupdate();
 
jQuery(".customfilter").each(function (a) {
	jQuery(this).on("click", function (e) {
	 
		console.log(".tax-val-"+jQuery(this).val());
		jQuery(".tax-val-"+jQuery(this).val()).toggleClass("on");						
	});
});

 

});
</script>
 
<?php } ?>