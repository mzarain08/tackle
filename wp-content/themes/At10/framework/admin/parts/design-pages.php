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
 
?>



     
  <?php if(defined('ELEMENTOR_VERSION')){ ?>
  
 
  
  <?php }else{ ?>
   
<div class="alert alert-help border mb-3 bg-white">
  <div class="alert-icon bg-danger">
    <i class="fa fa-info"></i>
  </div>
  <div class="alert-text p-4 px-4">
    <h5><?php echo __("Elementor Not Installed","premiumpress"); ?></h5> 
    <p><?php echo __("If you want to edit your pages with a page builder, please install Elementor.","premiumpress"); ?></p>
    <div>
     <a href="plugin-install.php?tab=plugin-information&plugin=elementor" class="btn btn-system shadow-sm"><i class="fab fa-elementor"></i> <?php echo __("Install Elementor","premiumpress"); ?></a>
	</div>
  </div>
</div>

  <?php } ?> 



<div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("Website Pages","premiumpress"); ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("Customize the pre-built pages that come with your PremiumPress theme.","premiumpress"); ?></p>
     
     
<a href="javascript:void(0);" onclick="load_ajax_blocks_builder(0);" class="btn btn-primary btn-xl btn-icon incon-before mb-4"><i class="fa fa-fill"></i> <span class="pr-4"><?php echo __("Page Builder","premiumpress"); ?></span></a>
   
     
     
     
     
     
     
     
      <div class="mt-2">
        <a href="#" onclick="jQuery('#overview-tab').trigger('click');" class="btn btn-system  font-weight-bold text-uppercase tiny"><i class="fa fa-arrow-left mr-1"></i> <?php echo __("go back","premiumpress"); ?></a>
      </div>
    </div>
    <div class="col-md-8">
    


  <div class="card card-admin">
        <div class="card-body">
 

<?php
 
 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
?>
<div class="container bg-light text-600 py-3 rounded mb-3">
<div class="row">

<div class="col-md-8">
<?php echo __("Page Name","premiumpress"); ?>
</div>

 

<div class="col-md-4 text-md-center">
<?php echo __("Actions","premiumpress"); ?>
</div>

</div>
</div>


<?php 

 
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


// ADDON HOMEPAGE
$GLOBALS['core_page_templates']['homepage'] = array( "name" => __("Home Page","premiumpress"), "link" => home_url()."/?reset=1", "order" => 1, "icon" => "fa-home", "bgcolor" => "#212548");  

$GLOBALS['core_page_templates']['search'] = array( "name" => __("Search Page","premiumpress"), "link" => home_url()."/?s=", "order" => 2, "icon" => "fa-search", "bgcolor" => "#214841");  

$GLOBALS['core_page_templates']['single'] = array( "name" => str_replace("%s", $CORE->LAYOUT("captions","1"), __("Single %s Page","premiumpress")), "link" => get_permalink($postID), "order" => 2, "icon" => $CORE->LAYOUT("captions","icon"), "bgcolor" => "#482121");  

$GLOBALS['core_page_templates']['blog'] = array( "name" => __("Blog","premiumpress"), "link" => _ppt(array('links','blog')), "order" => 2.1, "icon" => "fa fa-rss", "bgcolor" => "#483c21");  

foreach($CORE->multisort($GLOBALS['core_page_templates'], array('order'))  as $k => $p){

	// KEY
	$corekey = str_replace("page_","",$k);
	$p['id'] = $corekey; 

	// HIDE PAGES IF DISABLED
	//if(_ppt(array('mem','enable')){ } 

	// CHECK FOR MOBILE VIEW
	$page_mobile = _ppt(array('pageassign', $p['id'].'_mobile'));

	// EDIT PAGE LINK
	$page_el = "#"; $page_target_c = ""; $page_target_b = 1; 
	
	if(in_array($k,array("homepage")) && _ppt(array('design','slot1_style')) == "" && _ppt(array('design','header_style')) == "" ){
	
		$page_target_b = 0;
		
		$page_target_c = "onclick=\"jQuery('#ideas-tab').trigger('click');\""; 
	
	}elseif(in_array($k,array("single"))){
	
	  $page_el = home_url()."/wp-admin/admin.php?page=listingsetup&lefttab=single";
		
		$page_target_b = 0;		
	
	}elseif(in_array($k,array("search","blog"))){
	
		$page_target_b = 0;
		
		$page_target_c = "onclick=\"jQuery('#".$k."-tab').trigger('click');\""; 
	
	}elseif(defined('ELEMENTOR_VERSION')){ 
          
          if(substr(_ppt(array('pageassign',$p['id'])), 0, 9) == "elementor" ){ 
		  
		  $page_el = home_url()."/wp-admin/post.php?post=".str_replace("elementor-","",_ppt(array('pageassign',$p['id'])))."&action=elementor";
		  
		  }elseif(substr(_ppt(array('pageassign',$p['id'])), 0, 5) == "page-" ){
		  
		   $page_el = home_url()."/wp-admin/post.php?post=".str_replace("page-","",_ppt(array('pageassign',$p['id'])))."&action=edit";
           
		  }elseif($p['id'] == "homepage" && _ppt(array('design','slot1_style')) == "" && _ppt(array('design','slot2_style')) == ""){ // NO HOMEPAGE SET 		  
		  
		  $page_el = home_url()."/wp-admin/wp-admin/admin.php?page=design&lefttab=ideas";
		  
		  }else{ 
           
           	if($p['id'] == "homepage"){ 
           
           	$page_el = home_url()."/wp-admin/admin.php?page=design&loadpage=home";
			
			}else{
			
				$page_el = home_url()."/wp-admin/admin.php?page=design&loadpage=new&inner=".$p['id'];
			
				$page_target_c = "onclick=\"_pageRefresh();\"";
			
			}
         }
	
	}else{ // end elementor			
	
		$page_target_b = 0;
		
		$page_target_c = "onclick=\"load_ajax_pageedit('".$p['id']."');\"";  
	
	}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
?>


<div class="row mb-3 pb-3 border-bottom page-<?php echo $p['id']; ?>">

<div class="col-md-6 text-600">

<?php echo $p['name']; ?>

</div>
<div class="col-md-6 text-md-right"> 
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

 

	<a href="<?php echo $page_el; ?>" <?php echo $page_target_c; ?> <?php if($page_target_b){ ?>target="_blank"<?php } ?> class="btn btn-system mr-2">
    <i class="fa fa-pencil m-0" data-toggle="tooltip" data-placement="top" title="<?php echo __("Edit Page","premiumpress"); ?>"></i>
 
    </a>
    
  
 
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!in_array($k,array("single","search"))){

$hasCustomPage = _ppt(array('pageassign', $p['id'] ));
?>

 

	<a href="javascript:void(0);" onclick="load_ajax_pagelinks('<?php echo $p['id']; ?>', 0);" class="btn btn-system mr-2"  style="width:40px;">
    <i class="fa fa-desktop m-0 <?php if($hasCustomPage){ ?>text-warning<?php } ?>" data-toggle="tooltip" data-placement="top" title="<?php echo __("Use Custom Template","premiumpress"); ?>"></i>
    
    </a> 
 
    
<?php 
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if(!in_array($k,array("single","search"))){
?>
<a href="javascript:void(0);" onclick="load_ajax_pagelinks('<?php echo $p['id']; ?>', 1);" class="btn btn-system mr-2">

<i class="fa fa-language m-0" data-toggle="tooltip" data-placement="top" title="<?php echo __("Setup Multiple Languages","premiumpress"); ?>"></i>
    
</a>  

<?php 
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

 

 <?php if(!in_array($k,array("homepage","single","search")) && ( $p['link'] == "" || strpos($p['link'],"?") !== false) ){ ?>
    
    <a style="width:40px;" href="admin.php?page=settings&lefttab=pagelinks&brokenlink=<?php echo $p['link']; ?>" class="btn btn-system" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo __("Link Broken","premiumpress"); ?>"><i class="fa fa-unlink text-danger"></i></a>
     
    <?php }else{ ?>
    
        <a style="width:40px;" href="<?php echo $p['link']; ?>" class="btn btn-system text-dark" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo __("Vew Page","premiumpress"); ?>"><i class="fa fa-external-link"></i></a>
        
        <?php if(strlen($page_mobile) > 5){ ?>
        <a style="width:40px;" href="<?php echo str_replace("?reset=1","",$p['link']); ?>?mobile_view=1" class="btn btn-system text-dark mr-3" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo __("Mobile View","premiumpress"); ?>"><i class="fal fa-mobile"></i></a>
        <?php } ?>
        
    <?php } ?>
    
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

 </div>

<?php

/*
<div class="col-md-4">

        <div class="dropdown">
          <button class="btn btn-system dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo __("Design Options","premiumpress"); ?>
          </button>
          <div class="dropdown-menu font-weight-bold  small">
          
           
           <a class="dropdown-item small" href="<?php echo $page_el; ?>" <?php echo $page_target_c; ?> <?php if($page_target_b){ ?>target="_blank"<?php } ?>><?php echo __("Edit Page","premiumpress"); ?></a>
           
           
             <?php if($k == "blog"){ ?>
            <a class="dropdown-item small" href="<?php echo home_url(); ?>/wp-admin/post-new.php"><?php echo __("Add New Blog","premiumpress"); ?></a>
            <?php } ?>
            
             <?php if($k == "page_contact"){ ?>
            <a class="dropdown-item small" href="<?php echo home_url(); ?>/wp-admin/admin.php?page=settings&lefttab=company"><?php echo __("Change Map Location","premiumpress"); ?></a>
            <?php } ?> 
            
             <?php if($k == "page_categories"){ ?>
            <a class="dropdown-item small" href="<?php echo home_url(); ?>/wp-admin/edit-tags.php?taxonomy=listing&post_type=listing_type"><?php echo __("Manage Categories","premiumpress"); ?></a>
            <?php } ?> 
           
            
            
               <?php if($corekey == "add"){ ?>
            <a class="dropdown-item small" href="admin.php?page=listingsetup"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"), __("%s Settings","premiumpress")); ?></a>
            <?php } ?>
            
            
              <?php if($corekey == "memberships"){ ?>
            <a class="dropdown-item small" href="admin.php?page=membershipsetup"><?php echo  __("Membership Settings","premiumpress"); ?></a>
            <?php } ?>
            
            
              <?php if(!in_array($k,array("single","search"))){ ?>
            <a class="dropdown-item small" href="javascript:void(0);" onclick="load_ajax_pagelinks('<?php echo $p['id']; ?>');"><?php echo __("Custom Template","premiumpress"); ?></a>
            <?php } ?>
             
          </div>
        </div>

</div>
*/ ?>

</div>



<?php } ?>


<?php

$noedit = array(
	
	"account" => array("name" => __("My Account","premiumpress") ),

);
foreach($noedit as $k => $n){
?>
<div class="row mb-3 pb-3 border-bottom page-<?php echo  $k; ?>">
    <div class="col-md-4 text-600">
    <?php echo $n['name']; ?>
    </div>
    <div class="col-md-8 font-weight-bold">
     <?php echo  __("This page cannot be edited with a page builder.","premiumpress"); ?>
    </div>
</div>
<?php } ?>
 
    
    </div></div>


    
    
  </div>
 </div> 
 </div>     
 
 
 
 
 <div class="container px-0">
  <div class="row">
    <div class="col-md-4 pr-lg-4">
      <h3 class="mt-4"><?php echo __("WordPress Pages","premiumpress"); ?></h3>
      <p class="text-muted lead mb-4"><?php echo __("These are pages created in the WordPress admin. We've added them here for convenience.","premiumpress"); ?></p>
   
    </div>
    <div class="col-md-8">
    



 <div class="card card-admin">
        <div class="card-body">  
    
    
    
    
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// GET PAGES
$args = array('post_type' => 'page','posts_per_page' 	=> 20,'orderby' => 'date','order' => 'desc' );
$wp_query = new WP_Query($args);
$tt = $wpdb->get_results($wp_query->request, OBJECT);
 if(!empty($tt)){  
	 $elementorArray["9999"] = "9999";
	 foreach($tt as $p){	 
	 
	 	$title = get_the_title($p->ID);	
		
		$link = get_permalink($p->ID);
		
		$template = get_post_meta($p->ID,"_wp_page_template", true);	
		
		if(strlen($template) > 1 && !in_array($template, array('elementor_canvas','elementor_header_footer','elementor_theme')) ){ continue; }
 
?>


<div class="row mb-3 pb-3 border-bottom page-block-<?php echo $p->ID; ?> page-id-<?php echo $p->ID; ?>">

<div class="col-md-6 text-600">

  <?php echo $title; ?>

</div>
<div class="col-md-2">
    <a href="<?php echo $link; ?>" class="float-right text-dark opacity-5" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo __("Vew Page","premiumpress"); ?>"><i class="fa fa-external-link"></i></a>
</div>

<div class="col-md-4">

        <div class="dropdown">
          <button class="btn btn-system dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo __("Quick Actions","premiumpress"); ?>
          </button>
          <div class="dropdown-menu font-weight-bold small">
          
           
            <?php if(defined('ELEMENTOR_VERSION')){ ?>
            
           <a class="dropdown-item small" href="post.php?post=<?php echo $p->ID; ?>&action=elementor" target="_blank"><?php echo __("Edit Page in Elementor","premiumpress"); ?></a>
           
          <a class="dropdown-item small" href="post.php?post=<?php echo $p->ID; ?>&action=edit" target="_blank"><?php echo __("Edit in WP","premiumpress"); ?></a>
           
           <?php }else{ ?>
           
           <a class="dropdown-item small" href="post.php?post=<?php echo $p->ID; ?>&action=edit" target="_blank"><?php echo __("Edit Page","premiumpress"); ?></a>
           
           <?php } ?>
           
          
           
             <a class="dropdown-item small" href="javascript:void(0);" onclick="ajax_page_delete(<?php echo $p->ID; ?>);"><?php echo __("Delete","premiumpress"); ?></a>
           
          </div>
        </div>

</div>


</div>


 

<?php

	 }
 
} ?>
 

<div class="text-center">
<a href="edit.php?post_type=page" class="btn btn-lg btn-system font-weight-bold "><i class="fab fa-wordpress"></i> <?php echo __("Manage All Pages","premiumpress"); ?></a>
</div>
    
</div></div>  
    
    
    
 
  </div>
 </div> 
 </div> 
 
 
 
 
 
 
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

 
<script>

jQuery(document).ready(function(){ 

<?php if(isset($_GET['ep'])){ ?>
jQuery(".<?php echo $_GET['ep']; ?>").attr("style","background:#891414;    padding-top: 20px;    color: white;");
<?php } ?>

});

function _pageRefresh(){
 
 setTimeout(function(){
       window.location = "<?php echo home_url(); ?>/wp-admin/admin.php?page=design&reload=1";
   },10000); 

}

function ajax_page_delete(id){

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

// RESET

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		//dataType: 'json',	
		data: {
            admin_action: "page_delete",
			pid: id,
        },
        success: function(response) {
	 
 			jQuery('.page-block-'+id).hide();  
						
        },
        error: function(e) {
            
        }
    });
	
}// end are you sure

}
</script>
<style>
.show > .dropdown-menu {     transform: scale(1) !important;  } 
.dropdown-item { line-height:30px; }
.btn-elementor { background:#ba225f; color:#fff; font-weight:bold; }
</style> 