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

global $CORE, $settings, $userdata;

$settings = array(

"title" => __("Comment Details","premiumpress"), 

"desc" =>__("Here you can add/edit your comment","premiumpress"),

"back" => "overview",

); 

 
$eID = "";
if(isset($_GET['eid']) && $_GET['eid'] != "" && $_GET['eid'] > 0){
$eID = esc_attr($_GET['eid']);
$commentdata = get_comment($eID);

$SQL = "SELECT * FROM $wpdb->comments WHERE comment_ID = ".$eID." LIMIT 1";
$g = $wpdb->get_results($SQL,ARRAY_A);
 

}

 _ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
    <div class="card-title"><?php echo __("Details","premiumpress"); ?></div>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="newcomment" value="<?php if( $eID != ""){ echo $eID; }else{ echo 1; }  ?>" />
    
    
      <div class="row mt-4">
   
        <div class="form-group col-6">
      
          <label><?php echo __("Status","premiumpress"); ?></label>
          <select name="status" class="form-control">
            <?php
// ORDER STATUS
$orderstatus = 1;
if($eID !="" ){
$orderstatus = $commentdata->comment_approved;
}


$stats  = array(

	"1" => array("name" => __("Approved","premiumpress") ),
	"0" => array("name" => __("Pending","premiumpress") ),
	"spam" => array("name" => __("Spam","premiumpress") ),
);
 
foreach( $stats as $k => $n){
?>
            <option value="<?php echo $k; ?>" <?php  if($eID!=""){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
 <?php } ?>
          </select>
        </div>
      
   
           
        <div class="form-group col-6">
          <label><?php echo __("Type","premiumpress"); ?></label>
<select name="commentdata[feedback]" class="form-control" id="feedbacktype">
            <?php
// ORDER STATUS
$orderstatus = 1;
if($eID != "" ){
$orderstatus = get_comment_meta($eID, "feedback", true);
}


$stats  = array(

	"0" => array("name" => __("Comment","premiumpress") ),
	"1" => array("name" => __("User Feedback","premiumpress") ),
 
);
 
foreach( $stats as $k => $n){
?>
<option value="<?php echo $k; ?>" <?php  if($eID != ""){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
 <?php } ?>
</select>
          
          
         
        
        </div>
      
      </div>
      
       
<div class="col-12 px-0">

<label><?php echo __("Comments","premiumpress"); ?></label>
<textarea name="comment" class="form-control" style="height:150px !important;"><?php if($eID !="" ){ echo $g[0]['comment_content']; } ?></textarea>

</div>
 
      
      
<div class="col-12 px-0">
<div id="d" class="nav-tab-wrapper">
<a class="nav-tab nav-tab-active" href="#"><?php echo __("User","premiumpress"); ?></a>
</div>
</div>
   
   
     <div class="row mt-4">
  
         <div class="form-group col-6">
        
                 <label><?php echo __("From","premiumpress"); ?> (<?php echo __("User ID","premiumpress"); ?>)</label>
    <input name="commentdata[feedback_from]" class="form-control"  type="text" value="<?php if($eID !="" ){  echo $commentdata->user_id;}else{ echo $userdata->ID; } ?>">
        
        
        
         
        </div>
        
        
      
        <div class="form-group col-6">
    
              <label ><?php echo __("To","premiumpress"); ?> (<?php echo __("User ID","premiumpress"); ?>)</label>
    <input name="commentdata[feedback_for]" class="form-control"  type="text" value="<?php if($eID !="" ){  echo get_comment_meta($eID, "feedback_for", true);}elseif(isset($_GET['pid'])){ echo get_post_field('post_author', $_GET['pid']); } ?>">
       
        
       
       
        </div>
          
     </div>   
     
<div class="col-12 px-0">
<div id="d" class="nav-tab-wrapper">
<a class="nav-tab nav-tab-active" href="#"><?php echo __("Rating","premiumpress"); ?></a>
</div>
</div>

<div class="row mt-4">
    <?php
	
	$rd = $CORE->LAYOUT("captions","rating");
	 
	if(is_array($rd)){
		foreach($rd as $k => $r){		
		?>
 
    <div class="col-md-6 listingrating">
    
     <label><?php echo $r; ?></label> 
    <div>
           <select name="commentdata[<?php echo $k; ?>]" class="form-control">
              <option value="5" <?php if($eID !="" ){ selected( get_comment_meta($eID, $k, true), 5 ); } ?>>5 - Excellent</option>
              <option value="4" <?php if($eID !="" ){ selected( get_comment_meta($eID, $k, true), 4 ); } ?>>4 </option>
              <option value="3" <?php if($eID !="" ){ selected( get_comment_meta($eID, $k, true), 3 );  }?>>3 </option>
              <option value="2" <?php if($eID !="" ){ selected( get_comment_meta($eID, $k, true), 2 ); } ?>>2 </option>
              <option value="1" <?php if($eID !="" ){ selected( get_comment_meta($eID, $k, true), 1 ); } ?>>1 - Bad</option>
            </select> 
    </div>
</div>
<?php } } ?>
</div>

<div class="row mt-4">
<div class="form-group col-6">

<label ><?php echo __("Rating Total","premiumpress"); ?> (1-5)</label>

<input name="commentdata[ratingtotal]" class="form-control"  type="text" value="<?php if($eID !="" ){  echo get_comment_meta($eID, "ratingtotal", true);}else{ echo 5; } ?>">

</div>


<div class="form-group col-6">

<label ><?php echo __("Related Post ID","premiumpress"); ?></label>

<input name="commentdata[ratingpid]" class="form-control"  type="text" value="<?php if($eID !="" ){  echo get_comment_meta($eID, "ratingpid", true);}elseif(isset($_GET['pid'])){ echo $_GET['pid']; } ?>">

</div>
</div>





      
      
      <div class="p-4 bg-light text-center mt-4">
        <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Save Changes","premiumpress"); ?></button>
      </div>
    </form>
  </div>
</div>
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>


<script>

 
jQuery( document ).ready(function() { 

ShowHideCommentFields(jQuery("#feedbacktype").val());
 
jQuery("#feedbacktype").on("change", function (e) {
 
ShowHideCommentFields(jQuery(this).val())

});  

});

function ShowHideCommentFields(val){

 	jQuery(".listingrating").hide(); 	
	if(val == 1){
	jQuery(".listingrating").hide();	
	} else {
	jQuery(".listingrating").show();
	} 

} 
</script>
