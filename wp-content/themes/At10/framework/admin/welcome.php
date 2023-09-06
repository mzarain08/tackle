<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN, $CORE_UI;

// UPDATE
if(isset($_GET['hideme']) && !defined('WLT_DEMOMODE') ){
update_option("ppt_hideme", THEME_VERSION);
}

// UPDATES
if(get_option("ppt_reinstall") != THEME_VERSION){
	if(defined('WLT_DEMOMODE')){
	
	}else{
	//update_option("ppt_license_key_bk", get_option("ppt_license_key") );
	//update_option("ppt_license_key","");
	}	
	//update_option("ppt_reinstall", THEME_VERSION);
	
	// CLEAR ALL LOGS
	//$wpdb->query("DELETE FROM ".$wpdb->prefix."posts WHERE post_type = 'ppt_logs'");
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$data = array(
	
	"1" => array(
	
		"title" => __("New","premiumpress"),
		"args" => array('posts_per_page' => 5, 
				'post_type' => "listing_type", 'orderby' => 'date', 'order' => 'desc', 'paged'  => 0, 'offset'  => 0,
		),
	),
	"2" => array(
		"title" => __("Popular","premiumpress"),
		"args" => array('posts_per_page' => 5, 
				'post_type' => "listing_type", 'orderby' => 'meta_value_num', 'order' => 'desc', 'paged'  => 0, 'offset'  => 0,
				'meta_query' => array (
					array (
						'key' => 'hits',	
						'orderby' => 'meta_value_num'				  
					)
				 ) 
		),
	
	),
	"3" => array(
		"title" => __("Updated","premiumpress"),
		"args" => array('posts_per_page' => 5, 
				'post_type' => "listing_type", 'orderby' => 'modified', 'order' => 'desc', 'paged'  => 0, 'offset'  => 0,
				 
		),
	
	
	),
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


// LOAD IN HEADER
_ppt_template('framework/admin/header' ); 


 
?>
 
 
<h2><span><i class="fal fa-tachometer-alt mr-2"></i> <?php echo __("Dashboard","premiumpress"); ?></span>


<div style="top:0px; right:10px;" class="position-absolute hide-mobile">

<a href="admin.php?page=ppt_editor" class=" btn btn-sm btn-dark" ><i class="fa fa-tools"></i> <?php echo __("Site Manager","premiumpress"); ?></a>

<a href="<?php echo home_url(); ?>/?reset=1" class="btn btn-sm btn-system" target="_blank"><?php echo __("Visit Website","premiumpress"); ?> <i class="fa fa-long-arrow-right ml-2"></i></a>

</div>

</h2>

<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$preview = "https://premiummod.com/webshot/index.php?license=".get_option('ppt_license_key')."&web=".home_url()."&tk=".THEME_KEY."&email=".get_option('admin_email');
	
?>
<div class="container px-md-5 py-4">
<div class="row">


<div class="col-md-4">

<div class="border shadow-sm bg-white my-2 position-relative rounded-lg">
            
            <div class="fs-lg lh-10 ml-2 mt-1" style="    letter-spacing: -5px;">
            
            <span class="text-success">&bull;</span>
            <span class="text-warning">&bull;</span>
            <span class="text-primary">&bull;</span>
            
            </div>
            <div style="height:200px;" class="bg-light border m-2 position-relative">
            
            <div class="overlay-inner" style="z-index: 1;"></div>
            
            <div class="bg-image" data-bg="<?php echo $preview; ?>"></div> 
            </div>
             
            <div style=" position:absolute; top:25%; z-index:1;" class="w-100 text-center">
            <div style="max-width: 80%;    margin: auto;">
 
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$args = array(
   		'post_type' 		=> 'listing_type',
    	'posts_per_page' 	=> 100,
         'post_status'		=> array('pending','pending_approval'),
);	 		
$wp_custom_query = new WP_Query($args); 
if($wp_custom_query->found_posts > 0 ){
?> 
<a href="admin.php?page=listings&status=pending" data-ppt-btn="" class="list btn-warning btn-block text-600"><?php echo str_replace("%s", $CORE->LAYOUT("captions","2"), __("Unapproved %s","premiumpress")); ?></a>
<?php
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$comments_count = wp_count_comments();
if($comments_count->moderated > 0){
?> 
  
 <a href="edit-comments.php?comment_status=moderated" data-ppt-btn="" class="list btn-warning btn-block text-600"><?php echo $comments_count->moderated." ".__("Unapproved Comments","premiumpress"); ?></a>
<?php
}

?>
        
         
         
         </div>
         
            </div>
            
             <!-- end box -->
            
            <div class="d-flex justify-content-between">
            
                
                <div>
                
               
                </div>
            
            </div>
            <!-- end box -->
            
            
            </div>

<div>

</div>

</div>

<div class="col-md-8">

  <div class="pl-lg-5 mt-4">
                    <div class="fs-lg text-600"><span><?php echo THEME_NAME; ?></span> <span class="text-800"><?php echo THEME_VERSION; ?></span></div>                
                    
                    <div class="fs-5 my-3"><?php echo str_replace("%s",THEME_VERSION,__("Congratulations on updating to version %s. <br> This update makes it easier than ever to manage your website.","premiumpress")); ?></div>
                    
                      <div class="pb-4">
           
           
                <a class="text-dark tiny text-uppercase" href="https://www.premiumpress.com/account/" target="_blank"><?php echo __("What's new","premiumpress"); ?></a>
            
            <span class="mx-2 text-dark tiny">|</span> 
            
            <a class="text-dark tiny text-uppercase" href="https://www.premiumpress.com/docs/videos/" target="_blank"><?php echo __("Video Tutorials","premiumpress"); ?></a>
            
            
            
           		</div>
 
	</div>
    
</div>
</div>
</div>
<?php




 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

function runSQLCount(){ global $wpdb;

$data = array();

$sqls = array(
	
	"sql" => array(
	
		"user" =>  "SELECT COUNT(*) as total FROM ( SELECT COUNT(".$wpdb->base_prefix."users.user_registered) AS total FROM ".$wpdb->base_prefix."users 
		WHERE ".$wpdb->base_prefix."users.user_registered >= '%a' and ".$wpdb->base_prefix."users.user_registered < '%b' GROUP BY ID ) AS sub",	
		
		"listings" =>  "SELECT COUNT(*) as total FROM ( SELECT ".$wpdb->prefix."posts.post_date FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.post_date >= '%a' and ".$wpdb->prefix."posts.post_date < '%b' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND post_status='publish'   GROUP BY ID ) AS sub",	
		
		"orders" =>  "SELECT COUNT(*) as total FROM ( SELECT ".$wpdb->prefix."posts.post_date FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.post_date >= '%a' and ".$wpdb->prefix."posts.post_date < '%b' AND ".$wpdb->prefix."posts.post_type='ppt_orders' GROUP BY ID ) AS sub",	
		
		"logs" =>  "SELECT COUNT(*) as total FROM ( SELECT ".$wpdb->prefix."posts.post_date FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.post_date >= '%a' and ".$wpdb->prefix."posts.post_date < '%b' AND ".$wpdb->prefix."posts.post_type='ppt_logs' GROUP BY ID ) AS sub",	
		
	 	
	),
	
		
	"dates" => array(
		
			1 => array(			
				date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-9999, date("Y"))), 			
				date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))		
			), 
			
			2 => array(			
				date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-7, date("Y"))), 			
				date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))		
			), 
		
	),
	
	
); 

foreach($sqls['sql'] as $k => $s){

	foreach($sqls['dates'] as $ck => $cs){
		
		$sql = str_replace("%b",$cs[1],str_replace("%a",$cs[0], $s ));
		
		$result = $wpdb->get_results($sql);
 		
		$data[$k][$ck] = number_format($result[0]->total); 
	
	}
} 
 
return $data;

}

$allCounts = runSQLCount();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
 
 


 
?>


<div class="container px-md-5 pt-4 border-top"><div class="row">
 
 
 
<div class="col-md-12 mb-4">


<?php

// STATS 2
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
ob_start();
_ppt_template( 'framework/design/widgets/stats4' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

"f1a" => __("Total Users","premiumpress"),
"f1b" => $allCounts['user'][1],
"f1-link" => "admin.php?page=members",
 
"f2a" => str_replace("%s",$CORE->LAYOUT("captions","2"),__("Live %s","premiumpress")),
"f2b" => $allCounts['listings'][1],
"f2-link" => "admin.php?page=listings",
  
"f3a" => __("All Activity","premiumpress"),
"f3b" => $allCounts['logs'][1],

 
"f1c" => $allCounts['user'][2]." ".__("this week","premiumpress"),
"f2c" => $allCounts['listings'][2]." ".__("this week","premiumpress"),
"f3c" => $allCounts['logs'][2]." ".__("this week","premiumpress"),

"f3-link" => "admin.php?page=reports",

"icon" => "svg-users",
"icon2" => "svg-clock",
"icon3" => "svg-chat2",


)
,array("widget"));

 
?> 

</div>
<?php

// STATS 2
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

?>
 
<div class="col-12">


    <div class="card-help card bg-primary  p-4 text-light">
    
    
    <div class="row">
    <div class="col-md-8">
    
    <div class="text-light text-600 fs-4 mb-2"><?php echo __("Site Manager","premiumpress"); ?></div>
    
    <p class="mb-1"><?php echo __("Manage your website design here.","premiumpress"); ?></p>
    
    </div>
    <div class="col-md-4 text-right" ppt-flex-middle>
    
    <a href="admin.php?page=ppt_editor" data-ppt-btn class="btn-system btn-xl mt-1 btn-icon icon-before" target="_blank">
   
    <span class="d-flex">
    
<div ppt-icon-16 data-ppt-icon-size="16" class="mx-3"><?php echo $CORE_UI->icons_svg['desktop']; ?></div>
    
    <span><?php echo __("Site Manager","premiumpress"); ?></span></span>
    
    
    </a>
    
    </div> 
    </div>
    
    
    </div>


</div>

<?php

// STATS 2
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

?>

<style>
.nav-pills .nav-link {
color: #adadad;
    font-weight: 600;
}
</style>

 
<div class="col-md-8 mb-4"> 


<div class="row mb-2">
    <div class="col-md-8">
   

 <ul id="PopTabs" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav mt-n2 ">

 <?php $i=1; foreach($data as $k => $d){ ?>
 <li class="nav-item flex-sm-fill m-0">
        <a id="t<?php echo $k; ?>-tab" data-toggle="tab" href="#t<?php echo $k; ?>" role="tab" aria-controls="t<?php echo $k; ?>" aria-selected="true" class="custom nav-link border-0  <?php if($i == 1){ ?>font-weight-bold  active<?php } ?>">
		<?php echo $d['title']; ?>
        </a>
      </li>
 <?php $i++; } ?>
 
</ul>
 

    </div>
    <div class="col-md-4 text-right">
    <a href="admin.php?page=listings" data-ppt-btn class=" btn-system text-600"><?php echo __("manage","premiumpress"); ?></a>
    </div>
</div>
 

<div ppt-border1 class="p-3" style="min-height:400px;">
  
 

<div id="PopTabsContent" class="tab-content bg-white p-0">


<?php 

 

foreach($data as $k => $d){ ?>

<div id="t<?php echo $k; ?>" role="tabpanel" aria-labelledby="t<?php echo $k; ?>-tab" class="tab-pane fade <?php if($k == 1){ ?>show  active<?php } ?>">

<?php 

 
$i=1;
$query1 = new WP_Query( $d['args'] ); 
if ( $query1->have_posts() ) {
foreach($query1->posts as $post){
 

$photo 	= do_shortcode("[IMAGE pid='".$post->ID."' pathonly='1']");
$title 	= get_the_title($post->ID);
$link 	= get_permalink($post->ID);
$hits 	= do_shortcode("[HITS pid=".$post->ID ." pathonly=1]");
$author 	= $CORE->USER("get_username", $post->post_author);
  
if($k == 3){ 
	$vv = $CORE->date_timediff($post->post_modified);
	$dd =  __("updated","premiumpress")." ".$vv['string-small'];
}else{
	$vv = $CORE->date_timediff($post->post_date);	
	$dd =  __("added","premiumpress")." ".$vv['string-small'];
}
 
?>


<div class="<?php if($i != 5){ ?>border-bottom<?php } ?> py-3">

<div class="d-flex"> 
   	 
    <div style="width:80px; height:50px;" class="bg-light mr-4 rounded overflow-hidden position-relative">
    	<div class="overlay-inner z-1"></div>
		<div class="bg-image" data-bg="<?php echo $photo; ?>"></div>
    </div> 

	<div class="w-100"> 
    <div class="d-flex justify-content-between"> 
        
        <div>
        	<div class="text-700"><a href="<?php echo $link; ?>" class="text-dark"><?php echo $title; ?></a></div> 
        	<div class="list-list text-uppercase tiny mt-2">
			<span><?php echo $hits; ?> <?php echo __("views","premiumpress"); ?></span>
            <span><?php echo $dd; ?></span>
            <span><a href="admin.php?page=members&eid=<?php echo $post->post_author; ?>" target="_blank"><?php echo $author; ?></a></span>
            
            </div>
        </div>    
         
        <a href="<?php echo $link; ?>" class="text-dark"><i class="fa fa-chevron-right fa-2x mt-2 mr-2 opacity-5"></i></a> 
        
    </div>   
   
    	 
 	</div> 
   
</div>

</div>
<?php $i++; } } ?> 
</div>
<?php }  ?>

</div>


  
    </div>

</div>

<div class="col-md-4">


<div ppt-border1 class="p-3">


<div class="ppt-tabs-listing border-0 bg-white">
<div class="fieldset">
<div class="_title text-600 text-dark" style="background:#fff;"><?php echo __("Total","premiumpress"); ?></div>
<div class="_price <?php echo $CORE->GEO("price_formatting",array() );  ?>" id="totalprice"></div>
</div>
</div>


<ul class="list-group list-group-flush border-0">

 
<?php
 
foreach(  $CORE->ORDER("get_status", array() ) as $k => $n){ 


$amount = $CORE->ORDER("get_total", $n['key']); $amount = str_replace("+","",$amount);

?>
 
<li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted mb-0 calprice" <?php if($n['key'] != 6){ ?>style="border-bottom:1px solid #fbfbfb;"<?php } ?> 
data-amount="<?php echo preg_replace("/[^0-9.]/", "", hook_price(array($amount,0))); ?>"> 

<a href="admin.php?page=orders&order_status=<?php echo $n['key']; ?>">
<span class="inline-flex items-center font-weight-bold order-status-icon <?php echo $n['css']; ?> mr-2">
    <span class="dot mr-2"></span>
    <span class="pr-2px leading-relaxed whitespace-no-wrap"><?php echo $n['name']; ?></span>
</span>
</a>

<span class="<?php echo $CORE->GEO("price_formatting",array() );  ?>"> <?php echo hook_price(array($amount,0)); ?> </span>

</li>

 
<?php } ?>

 
</ul>



<script>

function calPrice(){
 	
	var total = 0;
	jQuery('.calprice').each(function () {		  
		total = total + parseFloat(jQuery(this).attr("data-amount"));
		 
	});
	
	jQuery("#totalprice").html(total);
	
	UpdatePrices(); 
	
}

jQuery(document).ready(function() {
	calPrice();
});

</script>

</div></div></div>

 


<?php

// STATS 2
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

?>

<div class="mt-4 mb-5">
<div class="row">

 <div class="col-md-4">
 
 
 <div ppt-box class="rounded">
   
     <div class="_header">
        <div class="_title"><?php echo __("New","premiumpress")." ".$CORE->LAYOUT("captions","2"); ?></div>
     </div>
 <div class="_content">
 
   
        <ul class="list-group list-group-flush">
          <?php
 $i=0;
while($i < 6){


	$DATE1 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 1, date("Y")));
	$DATE2 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 30, date("Y")));
 
	if($i == 0){
	$days = 0;
	}else{
	$days = $i * 28;
	}
	
	$count = $wpdb->get_var("SELECT count(*) FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.post_type = '".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' ");

?>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted"> <span class="small"><?php echo date('F Y', strtotime("-".$days." days")); ?></span> <span class="badge <?php if($count > 0){ ?>bg-primary<?php }else{ ?>bg-secondary<?php } ?> text-white badge-pill"> <?php echo $count; ?> </span> </li>
          <?php
$i++;
} 
?>
        </ul>
      
      </div>
    </div>
  </div>
  <div class="col-md-4">
  
   <div ppt-box class="rounded">
   
     <div class="_header">
        <div class="_title"><?php echo __("New Users","premiumpress"); ?></div>
     </div>
 <div class="_content">
        <ul class="list-group list-group-flush">
          <?php
 $i=0;
while($i < 6){

	$DATE1 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 1, date("Y")));
	$DATE2 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 30, date("Y")));
 

	if($i == 0){
	$days = 0;
	}else{
	$days = $i * 28;
	}
	
	$count = $wpdb->get_var("SELECT count(*) FROM ".$wpdb->base_prefix."users WHERE  ".$wpdb->base_prefix."users.user_registered >= '".$DATE1."' and ".$wpdb->base_prefix."users.user_registered < '".$DATE2."' ");

?>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted"> <span class="small"><?php echo date('F Y', strtotime("-".$days." days")); ?></span> <span class="badge <?php if($count > 0){ ?>bg-primary<?php }else{ ?>bg-secondary<?php } ?> text-white badge-pill"> <?php echo $count; ?> </span> </li>
          <?php
$i++;
} 
?>
        </ul>
      </div>
        
    </div>
  </div>
  <div class="col-md-4">
    <div ppt-box class="rounded">
     <div class="_header">
        <div class="_title"><?php echo __("New Orders","premiumpress"); ?></div>
     </div>
        <div class="_content">
        <ul class="list-group list-group-flush">
          <?php
 $i=0;
while($i < 6){

	$DATE1 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 1, date("Y")));
	$DATE2 = date("Y-m-d",mktime(0, 0, 0, date("m")-$i, 30, date("Y")));
 


	if($i == 0){
	$days = 0;
	}else{
	$days = $i * 28;
	}
 
	$SQL = "SELECT count(*) FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."'   AND ".$wpdb->prefix."posts.post_type='ppt_orders' ";
 
	$count = $wpdb->get_var($SQL);

?>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted"> <span class="small"><?php echo date('F Y', strtotime("-".$days." days")); ?></span> <span class="badge <?php if($count > 0){ ?>bg-primary<?php }else{ ?>bg-secondary<?php } ?> text-white badge-pill"> <?php echo $count; ?> </span> </li>
          <?php
$i++;
} 
?>
        </ul>
      </div></div>
    </div>

</div>

</div>

<?php

// STATS 2
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 

?>


</div></div></div>
<?php
 
_ppt_template('framework/admin/footer' ); 
?>