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

global $CORE_UI, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$SQL = "SELECT ID FROM ".$wpdb->posts." WHERE post_type ='listing_type' and post_status = 'publish' ORDER BY rand() LIMIT 1 ";				 			 
$result = $wpdb->get_results($SQL);
if(isset($result[0])){
	$postID = $result[0]->ID;	
}else{
	$postID = 10;
} 
$pl = get_permalink($postID);
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$adLayouts = array(

	1 => array(
	
		"name" => "Grid",
		"link" => $pl."/?style=grid",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/gal2.jpg",
	),
	
	
	2 => array(
	
		"name" => "Gallery",
		"link" => $pl."/?style=row",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/gal1.jpg",
	),
	
	3 => array(
	
		"name" => "Carousel",
		"link" => $pl."/?style=carousel",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/gal3.jpg",
	),	
		
	
	4 => array(
	
		"name" => "Tall Images",
		"link" => $pl."/?style=tall",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/gal4.jpg",
	),	 
		
	
); 

$searchLayouts = array(

	1 => array(
	
		"name" => "Full Search",
		"link" => home_url()."/?s=&full=1",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/s1.jpg",
	),
	
	3 => array(
	
		"name" => "Inline Search",
		"link" => home_url()."/?s=&inline=1",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/s3.jpg",
	),	
		
	
	
	2 => array(
	
		"name" => "Hidden Filters",
		"link" => home_url()."/?s=&hidefilters=1",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/s2.jpg",
	),
	

	
	4 => array(
	
		"name" => "Map View",
		"link" => home_url()."/?s=&map=1",
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/s4.jpg",
	),	 
		
	
); 

$innerLayouts = array(

	1 => array(
	
		"name" => "Members Area",
		"link" => _ppt(array('links','myaccount')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/paccount.jpg",
	),
	
	
	2 => array(
	
		"name" => str_replace("%s", $CORE->LAYOUT("captions","2"), __("Add %s","premiumpress") ),
		"link" => _ppt(array('links','add')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/padd.jpg",
	),
	
	3 => array(
	
		"name" => __("Memberships","premiumpress"),
		"link" => _ppt(array('links','memberships')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pmem.jpg",
	),	
	
	
	11 => array(
	
		"name" => __("Pricing Table","premiumpress"),
		"link" => _ppt(array('links','pricing')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/ppricing.jpg",
	),
		
	
	4 => array(
	
		"name" => __("Advertising","premiumpress"),
		"link" => _ppt(array('links','sellspace')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/padvertise.jpg",
	),	 


	5 => array(
	
		"name" => __("Testimonials","premiumpress"),
		"link" => _ppt(array('links','testimonials')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/ptest.jpg",
	),	
	
	6 => array(
	
		"name" => __("About Us","premiumpress"),
		"link" => _ppt(array('links','aboutus')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pabout.jpg",
	),	
		
	7 => array(
	
		"name" => __("How it works","premiumpress"),
		"link" => _ppt(array('links','how')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/phow.jpg",
	),	
	
	8 => array(
	
		"name" => __("FAQ","premiumpress"),
		"link" => _ppt(array('links','faq')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pfaq.jpg",
	),	
	
	9 => array(
	
		"name" => __("Privacy","premiumpress"),
		"link" => _ppt(array('links','privacy')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pprivacy.jpg",
	),
	
	10 => array(
	
		"name" => __("Categories","premiumpress"),
		"link" => _ppt(array('links','categories')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pcategories.jpg",
	),
	
	"stores" => array(
	
		"name" => __("Agencies","premiumpress"),
		"link" => _ppt(array('links','stores')),
		"img" => "https://premiumpress1063.b-cdn.net/_demoimagesv10/demo/pstores.jpg",
	),	
); 

 
if(in_array(THEME_KEY,array("cp","cb"))){
$innerLayouts["stores"]['name'] = __("Stores","premiumpress");
}

if(!in_array(THEME_KEY,array("es","cp","so","jb","cb"))){

unset($innerLayouts["stores"]);

}

if(in_array(THEME_KEY,array("vt"))){

unset($searchLayouts[4]);

}
 
?>
<div class="border-bottom py-4 bg-light demo-nav" id="adstyles" style="display:none;" >
  <div class="container">
    <div class="row">
      <?php foreach($adLayouts as $l){ ?>
      <div class="col-md-2">
        <div class="text-center y-middle p-3 hover-jump" ppt-border1>
          <a href="<?php echo $l['link']; ?>"><img data-src="<?php echo $l['img']; ?>" class="img-fluid lazy"></a>
        </div>
        <div class="mt-3 text-600 text-center text-black">
          <?php echo $l['name']; ?>
        </div>
      </div>
      <?php } ?>
      <div class="col">
        <div class="bg-light rounded-lg p-4">
          <div class="text-600 fs-5 mb-3 text-black">
            Multiple Ad Layouts
          </div>
          <div class="mb-2 text-black">
            This theme comes with multiple ad layouts included. You can choose your default layout via the admin area.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="border-bottom py-4 bg-light demo-nav" id="searchstyles" style="display:none;" >
  <div class="container">
    <div class="row">
      <?php foreach($searchLayouts as $l){ ?>
      <div class="col-md-2">
        <div class="text-center y-middle p-3 hover-jump" ppt-border1>
          <a href="<?php echo $l['link']; ?>"><img data-src="<?php echo $l['img']; ?>" class="img-fluid lazy"></a>
        </div>
        <div class="mt-3 text-600 text-center text-black">
          <?php echo $l['name']; ?>
        </div>
      </div>
      <?php } ?>
      <div class="col">
        <div class="bg-light rounded-lg p-4">
          <div class="text-600 fs-5 mb-3 text-black">
            Multiple Search Layouts
          </div>
          <div class="mb-2 text-black">
            This theme comes with multiple layouts included. You can choose your
              default layout via the admin area.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="border-bottom py-4 bg-light demo-nav" id="innerstyles" style="display:none;" >
  <div class="container">
    <div class="row">
      <?php foreach($innerLayouts as $l){ ?>
      <div class="col-md-2">
        <div class="text-center y-middle p-3 hover-jump" ppt-border1>
          <a href="<?php echo $l['link']; ?>"><img data-src="<?php echo $l['img']; ?>" class="img-fluid lazy"></a>
        </div>
        <div class="my-3 text-600 text-center text-black">
          <?php echo $l['name']; ?>
        </div>
      </div>
      <?php } ?> 
    </div>
  </div>
</div>
