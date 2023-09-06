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


global $settings, $wpdb;
 

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
?>

<p>Here is a list of all the design code used for your current setup.</p>


<div class="row">
<div class="col-md-6">
    
<textarea style="width:100%; height:600px; font-size:12px;" id="debugtt"><?php  if(isset($core_admin_values['design'])){
foreach($core_admin_values['design'] as $k=> $v){ ?>$core['design']['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";
<?php } }  ?>
</textarea>
 

</div> 


<div class="col-md-6">
    
 
 
<textarea style="width:100%; height:600px; font-size:12px;" id="debugtt"><?php if(isset($core_admin_values['design'])){ foreach($core_admin_values['design'] as $k=> $v){ ?>$core['design']['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";
<?php } } ?>
<?php  if(isset($core_admin_values['home']) && is_array($core_admin_values['home'])){ foreach($core_admin_values['home'] as $k => $v){ 

	if(is_array($v)){
	
		foreach($v as $kk => $vv){
		?>$core['home']['<?php echo $k; ?>']['<?php echo $kk; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$vv)); ?>";
		<?php
		}
	
	}else{
	?>$core['home']['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";
	<?php
	}

} } ?>
</textarea>

 
</div> 

<div class="col-md-12">
 
<textarea style="width:100%; height:600px; font-size:12px;" id="debugtt"><?php 
if(isset($core_admin_values['design'])){
foreach($core_admin_values['design'] as $k=> $v){ ?>$core['design']['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";
<?php } } ?>
<?php foreach($core_admin_values as $k => $v){ 

	if(is_array($v)){
	
		foreach($v as $kk => $vv){
		
		if(is_array( $vv)){
		
			foreach($vv as $kkk => $vvv){
				if(!is_array($vvv)){
				?>$core['<?php echo $k; ?>']['<?php echo $kk; ?>']['<?php echo $kkk; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$vvv)); ?>";
				<?php
				}
			}
		
		}else{
		
		?>$core['<?php echo $k; ?>']['<?php echo $kk; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$vv)); ?>";
		<?php
		}
		
		}
	
	}else{
	?>$core['<?php echo $k; ?>'] = "<?php echo stripslashes(str_replace('"',"'",$v)); ?>";
	<?php
	}

} ?>
</textarea>
</div> </div> 