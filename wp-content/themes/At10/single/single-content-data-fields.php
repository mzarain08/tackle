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

global $CORE, $post, $userdata, $new_settings;
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$showEmptyFields = 0;
$showStyle = 1;
$data = ppt_theme_listing_data("all");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!isset($post->ID) || is_admin() ){ 
	$i=1; 
	while($i < 10){
	
		$data["field".$i] = array(
					"name"	=> "Field ".$i,				
					"label"	=> "Field ".$i,
					"data"	=> "Value ".$i,
					"type" => "text",
					"tax"	=> "", 
		);
		$i++;
	} 
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
if(isset($new_settings['fields_fields']) && is_array($new_settings['fields_fields']) && !empty($new_settings['fields_fields']) && count($new_settings['fields_fields']) > 1 ){
 

	$oldF = $data;
	$newF = array();
	foreach($new_settings['fields_fields'] as $k => $d){
	
		if(!isset($oldF[$k])){ continue; }
			 
		$newF[$k] = $oldF[$k];		
		if(strlen($d['name']) > 1){
		$newF[$k]['label']  = $d['name'];
		}		
	}
	$data = $newF;  
	
	$showEmptyFields 	= $new_settings['fields_empty'];
	$showStyle 			= $new_settings['fields_style'];
	
}
 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(!empty($data)){
?>

<?php if(isset($post->post_author) && $userdata->ID && $post->post_author == $userdata->ID){ ?>
<div class="addeditmenu" data-key="customfields"></div>
<?php } ?>
<div class="ppt-single-datafields">
<nav ppt-nav="" class="list lh-30 list-fbold">
    <ul>
   
    <?php foreach($data as $d){ if($d['data'] == "" && $d['type'] != "title"){ if(is_admin()){ $d['data'] = "{user data}"; }else{ continue; } } 
	   ?>
    
    <li class="<?php echo $d['type']; ?>"><span><?php echo $d['label']; ?></span> <?php if(strlen($d['data']) > 0){ ?><span><?php echo $d['data']; ?></span><?php } ?></li>
    
	<?php } ?>
    </ul>  
</nav>
</div> 
<?php } ?>