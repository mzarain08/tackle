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
 
require_once get_template_directory() ."/framework/data/_makes.php";

global $settings;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Makes &amp; Models","premiumpress"), 
  "desc" => __("Use these tools to help you quickly import makes and models into your website.","premiumpress"),
  
  //"doclink" => "https://www.premiumpress.com/docs/users/",
  
  "video" => "",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 
 
	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$make = "";
$model = "";
if(isset($_GET['eid'])){ 
$make 	= get_post_meta($_GET['eid'],"make", true);
$model 	= get_post_meta($_GET['eid'],"model", true);
}

$list = array();
if(isset($GLOBALS['ppt_makes'])){
	$list = $GLOBALS['ppt_makes'];
}
$data = array();
foreach($list as $m){
	$data[str_replace(" ","",strtolower($m))] = __($m,"premiumpress");
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div class="card card-admin">
  <div class="card-body">
  
  
<div class="text-center py-4" id="importmakes" style="display:none;">

    <i class="fa fa-sync fa-3x fa-spin"></i>
    <div class="text-600 my-4">Importing please wait..</div>
</div>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<div id="makesimportlist">

<a href="edit-tags.php?taxonomy=listing&post_type=listing_type" class="btn-primary float-right" target="_blank" data-ppt-btn>Manage</a>

<div class="text-600 mb-2">Import Tool</div>

<div class="opacity-5">Click any brands below to begin import.</div>
<hr />
<div class="row">
<?php foreach($data as $k => $v){  ?>
        
 
<div class="col-md-3 mb-2">
<div data-ppt-btn class="btn-system btn-block cursor" onclick="ajax_import_makes('<?php echo $v; ?>','<?php echo $k; ?>');">
<?php echo $v; ?>
</div>
</div>

<?php } ?>
</div>
  
 </div> 
</div>
</div>

<script>

function ajax_import_makes(make,id){
 
  
	
	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
	
	jQuery("#makesimportlist").hide(); 
	jQuery("#importmakes").show();          
				
					jQuery.ajax({
						type: "POST",
						dataType: 'json',	
						url: ajax_site_url,	 	
						data: {
							admin_action: "ajax_import_makes",
							makeid: id, 
							make:make,
						},
						success: function(response) {
						
							alert("Complete! "+response.count+" Items added.")
							 
								jQuery("#makesimportlist").show(); 
								jQuery("#importmakes").hide();   
							
							 
						},
						error: function(e) {
							 
						}
					});
			
	
	}// end are you sure

}

</script>

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>