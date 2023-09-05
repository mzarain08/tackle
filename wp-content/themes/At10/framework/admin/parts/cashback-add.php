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

global $CORE, $settings;

 

// WORK OUT THE COMMISSION
$commission = 0;
$pid = 0;
$file = array();
$cashback_pid = "";
$paidDate = "";

$cashbackFields = $CORE->USER("cashback_fields",array());
 

if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){

	$pid = $_GET['eid'];
	
	$file 			= get_post_meta($pid, 'cashback_file', true);
	$cashback_pid 	= get_post_meta($pid, 'cashback_pid', true);
	$paidDate 		= get_post_meta($pid,'cashback_paid', true);
	
	$commission = get_post_meta($pid, 'cashback_total', true);
	if(!is_numeric($commission)){
		$commission = 0;
	}
	 
	
}

 
$settings = array(

"title" => __("Cashback Details","premiumpress"), 

"desc" =>__("Here you can add/edit a cashback request.","premiumpress"),

);

// USER ID
if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ 

$cashback_userid =  get_post_meta($_GET['eid'], "cashback_userid", true);

$cashback_postdata = get_post($_GET['eid']);
 
} 

 

_ppt_template('framework/admin/_form-wrap-top' ); ?>

<div class="card card-admin">
  <div class="card-body">
    <div class="card-title"><?php echo __("Cashback Details","premiumpress"); ?></div>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="neworder" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ echo esc_attr($_GET['eid']); }else{ echo 1; }  ?>" />
      <p class="text-muted mt-4"><?php echo __("Who's the request from?","premiumpress"); ?></p>
      <div class="row">
        <div class="form-group col-md-6">
          <label><?php echo __("User ID","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> # </span> </div>
            <input name="order[cashback_userid]" class="form-control"  type="text" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ echo $cashback_userid; } ?>">
          </div>
          
         <?php if(isset($_GET['eid'])){  ?>
      
          <a href="admin.php?page=members&eid=<?php echo $cashback_userid; ?>" target="_blank" class="btn btn-system  btn-sm mt-4"><?php echo __("View User Account","premiumpress"); ?></a>
          
            
        <?php } ?>
        
        <div class="mt-4">
         <label><?php echo __("Post ID","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> # </span> </div>
            <input name="order[cashback_pid]" class="form-control"  type="text" value="<?php echo $cashback_pid; ?>">
          </div>
        </div>
        
         <?php if(is_numeric($cashback_pid) && $cashback_pid > 0){  
		 
		 	$found 	= wp_get_object_terms( $cashback_pid, 'store' );
			 
			if(is_array($found) && !empty($found)){
				$link = get_term_link($found[0]->term_id, "store");	 
				$name = $found[0]->name; 				
				$store_image = do_shortcode('[STOREIMAGE sid='.$found[0]->term_id.']');
				 
			}
		 	
		 
		 ?>
      
          <a href="<?php echo get_permalink($cashback_pid); ?>" target="_blank" class="btn btn-system  btn-sm mt-4"><?php echo __("View Ad","premiumpress"); ?></a>
          
          <?php if(isset($store_image)){ ?>
          <div class="mt-4">
          Store: <a href="<?php echo $link; ?>"><?php echo $name; ?></a>
          </div>
          <?php } ?>
            
        <?php } ?>
        
        
        </div>
      
      <div class="col">
      
      <?php if(isset($_GET['eid']) && $cashback_userid > 0){  
 	  
	  ?>
      
      
       <div class="bg-light border p-4">
        
        <?php
		
		$data = array(
		
		"username" 	=> array( "t" => __("Username","premiumpress"), 		"v" => $CORE->USER("get_username",$cashback_userid) ),
		"email" 	=> array( "t" => __("Email","premiumpress"), 			"v" => $CORE->USER("get_email",$cashback_userid) ),
		"joined" 	=> array( "t" => __("Date Joined","premiumpress"), 		"v" => $CORE->USER("get_joined",$cashback_userid) ),
		"lastlogin" => array( "t" => __("Last Login","premiumpress"), 		"v" => $CORE->USER("get_lastlogin",$cashback_userid) ),
		"balance" 	=> array( "t" => __("Current Balance","premiumpress"), 	"v" => hook_price(get_user_meta($cashback_userid,"ppt_usercredit", true) )),
		
		);
		
		foreach($data as $k => $d){
		
		?>
        <div class="text-600"><?php echo $d['t']; ?></div>
        <div class="opacity-5 mb-2"><?php echo $d['v']; ?></div>
        
        <?php } ?>
         
        </div>
           <?php } ?>
      
      </div>
       
      </div>
       
       
      
       <hr />
      <p class="text-muted"><?php echo __("What are the user purchase details.","premiumpress"); ?></p>
 
      <div class="row">
      
        <div class="form-group col-6">
    
    
         <label><?php echo __("Cashback Total","premiumpress"); ?></label>
          <div class="input-group">
            <div class="input-group-prepend"> <span class="input-group-text"> <?php echo _ppt(array('currency','symbol')); ?> </span> </div>
            <input name="order[cashback_total]" class="form-control numericonly" type="text" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ echo get_post_meta($_GET['eid'], "cashback_total", true); }else{ echo 0; } ?>">
     </div>
       
          
             <label class="mt-4"><?php echo __("Proof Of Purchase","premiumpress"); ?></label>
          	<input name="ppt_verifyfile" type="file" class="form-control p-1"  /> 
            
            <?php if(isset($file['img'])){ ?>
            <div class="mt-3 text-600 position-relative" id="cashbackfile">
            
            <a href="<?php echo $file['img']; ?>" target="_blank"><span class="fa fa-file nopos mr-2"></span> <?php echo $file['name']; ?></a>
            
            <a href="javascript:void(0)" onclick="delete_cashback_file(<?php echo $pid; ?>);" class="float-right text-danger"><span class="fa fa-trash nopos text-danger"></span> <?php echo __("Delete","premiumpress"); ?></a>
            </div>
            
             
            
            
            <?php } ?>
         
          
          <?php ?>
          
        </div>
        
        
        
        <div class="col-6">
         
  		<div class="bg-light border p-4">
        
        
       <?php echo __("The cashback total is the amount you will give this user once approved.","premiumpress"); ?>
        
        </div>
        
        
        
          <div class="my-4 opacity-5 text-14">  
          
          <?php echo __("Date created","premiumpress"); ?> <?php echo hook_date($cashback_postdata->post_date); ?>
        
          </div>
            
        
          
        </div>
      </div>
      
       <hr />
      <p class="text-muted"><?php echo __("What's the status of the cashback request?","premiumpress"); ?></p>
      <div class="row">
        <div class="form-group col-6">
          <label><?php echo __("Request Status","premiumpress"); ?></label>
          <select name="order[cashback_status]" class="form-control">
            <?php
// ORDER STATUS
if(isset($_GET['eid'])){
$orderstatus = get_post_meta($_GET['eid'], "cashback_status", true);
}


foreach( $cashbackFields['cashback_status']['values'] as $k => $n){
?>
            <option value="<?php echo $n['id']; ?>" <?php  if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){  selected( $orderstatus, $k ); }  ?>><?php echo $n['name']; ?></option>
            <?php } ?>
          </select>
          <?php

// ORDER STATUS
if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "cashback_paid", true) != ""){ ?>
          <div class="small text-muted mt-3"> <?php echo  __("Paid","premiumpress")." ".get_post_meta($_GET['eid'], "cashback_paid", true); ?> </div>
          <?php

}
?>
        </div>
        <div class="form-group col-6">
        <?php if(isset($_GET['eid'])){ ?>
        <?php if($paidDate == ""){ ?>
        <div class="bg-light border p-4">
        
        
         <?php echo str_replace("%s",hook_price($commission),__("If you set this to approved, a total of %s will be added to the users balance.","premiumpress")); ?>
        
        </div>
        
        <input type="hidden" name="commission" value="<?php echo $commission; ?>" />
      <?php }elseif(strlen($paidDate) > 1){ ?>
      
       <div class="alert-success border p-4">
        
        
        <?php echo str_replace("%s",hook_price($commission), str_replace("%d", $paidDate, __("A total of %s was be added to the users balance on %d.","premiumpress"))); ?>
        
        </div>
      <?php } ?>
      <?php } ?>
      
      
      
      
      
      
        </div>
      </div>
      <!-- end row -->
      <hr /> 
      
      
      
      
      
      
      <!-- end row -->
      <div class="form-group mt-4">
        <label><?php echo __("Admin Notes","premiumpress"); ?></label>
        <div class="input-group">
          <textarea name="order[cashback_notes]" class="form-control" style="height:100px !important;"><?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "cashback_notes", true); }?>
</textarea>
        </div>
      </div>
      <div class="p-4 bg-light text-center mt-4">
        <button type="submit" data-ppt-btn class="btn-primary"> <?php echo __("Update Order","premiumpress"); ?></button>
      </div>
    </form>
  </div>
</div>







<script>

function delete_cashback_file(pid){
 										   
 	
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "delete_cashback_file",
			pid: pid,
			 		
        },
        success: function(response) {
 
			if(response.status == "ok"){
			
			jQuery("#cashbackfile").hide();
			alert("<?php echo __("File Deleted","premiumpress"); ?>"); 
			 			 
  		 	
			}else{			
		 			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });	
 		
}
</script> 


<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>