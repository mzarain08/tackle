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
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

global $CORE, $userdata, $CORE_UI;

 ?>
<script>

function notify_delete(nid){ 
	
     jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',
		   dataType: 'json',		
   		data: {
            action: "notify_delete",
			nid: 	 nid, 
			
           },
           success: function(response) {   			 
			 
			 jQuery(".log-"+nid).fadeOut(400);	
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       }); 
}

</script>

<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['action']) && !isset($GLOBALS['flag-account']) ){ 
?>

<div ppt-box class="rounded">

<div class="_header d-flex">


    <div class="_icon">
        <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['bell']; ?>
          </div>
    </div>
    <div class="_title w-100"> 
 <?php echo __("My Alerts","premiumpress"); ?> 
    </div>  
     
    
    <div class="_close btn-close">
        <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['close']; ?>
          </div>
    </div>
    
</div>
<?php 

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 
 
<div class="_content <?php if(isset($_POST['action']) && !isset($GLOBALS['flag-account']) ){  }else{ ?>px-0<?php } ?> py-3"> 
<div class="ppt-scroll ppt-notify-window" data-target="#scrollwindow1" id="scrollwindow1">

<?php 		 
			
   
$logs = $CORE->USER("logs_get_all", $userdata->ID ); 

$shown_logs = 0;		  
if(!empty($logs)){	
 
foreach($logs as $log){ 
				
	// CLEAR EXTRAS
	$extra = ""; $extra_button = "";
				 				
	// GET DATA
	$d = $CORE->FUNC("format_logtype", $log->ID ); 
 	  
	// TITLE & DESC
	$title = "";
	$desc = "";
	if(isset($d['user_to'])){
		if($d['user_to'] == $userdata->ID){
			$title 	= notify_string_filter($d, $d['title_to'], "to");
			$desc 	= notify_string_filter($d, $d['desc_to'], "to");
		}else{
			$title 	= notify_string_filter($d, $d['title_from'], "from");
			$desc 	= notify_string_filter($d, $d['desc_from'], "from");
		} 
	}
	
	// CLEAN UP
	if($title == ""){
		wp_delete_post( $log->ID );
		continue;
	}
	
	// IS HIDDEN??
	if(get_post_meta($d['log_id'], "log_hide_".$userdata->ID, true)){
		continue;
	}
	
	// HAS BEEN READ?
	$read  = get_post_meta($d['log_id'], "log_unread_".$userdata->ID, true);
	if($read){
		update_post_meta($d['log_id'], "log_unread_".$userdata->ID, 0);
	}
	
	// MAKE EXTRAS
	switch($d['log_type']){
		
		case "order": {
				
				// SHOW ONLY TO ME
				if($d['user_to'] == $userdata->ID){
					$invoiceid  	= get_post_meta($d['log_id'], "log_extra", true); // invoice id
					$orderid  		= get_post_meta($d['log_id'], "log_extra2", true); // order id
					
					$extra_button = _ppt(array('links','myaccount'))."/?showtab=orders&invoice=".$invoiceid."&order=".$orderid;
					if(isset($onClickB)){ unset($onClickB); }
				}
			
		} break;
		 
		
		case "msg_new": {
		 	
			$onClickB = 1;
			
			if($d['user_to'] == $userdata->ID){
			 
			$extra_button = 'processMessage('.$d['user_from'].');';
			
			}else{
			
			$extra_button = 'processMessage('.$d['user_to'].');';
			
			} 
		
		} break;
		
		case "da_gift":
		case "da_wink":
		
		case "feedback_receieved": {
		
			if($d['user_to'] == $userdata->ID){
			
			$extra_button = $CORE->USER("get_user_profile_link", $d['user_from']);
			
			}else{
			
			$extra_button = $CORE->USER("get_user_profile_link", $d['user_to']);
			
			} 
			
			
		} break;
		
		
		case "comission_invoice": {
		
			$extra  = get_post_meta($d['log_id'], "log_extra", true);
			
			$extra_button = _ppt(array('links','myaccount'))."/?showtab=orders&showoid=".$extra;
			
		} break;
		case "comission_taken":
		case "mj_credit_added": {
		
			$extra  = get_post_meta($d['log_id'], "log_extra", true);
			
			$extra_button = _ppt(array('links','myaccount'))."/?showtab=cashout&showoid=".$extra;
			
		} break;
		
		case "at_auction_ended":
		case "offer_complete":
		case "offer_updated":
		case "offer_accepted":
		case "offer_rejected":
		case "offer_new": {
			
			$extra  = get_post_meta($d['log_id'], "log_extra", true);
			
			$extra_button = _ppt(array('links','myaccount'))."/?showtab=offers&showoid=".$extra;
			
		} break;
		
		case "public_listing_view":
		case "listing_deleted":
		case "listing_expired":
		case "listing_update":
		case "listing_added": {
				
				$extra  = get_post_meta($d['log_id'], "log_postid", true); 
				if(is_numeric($extra)){
				$extra_button = get_permalink($extra);
				} 
		
		} break;
		 
	
	}  

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 $shown_logs ++;
?>

<div class="mb-4 p-sm-3 card-mobile-transparent <?php if($read){ ?>unread<?php } ?> log-<?php echo $log->ID; ?> <?php echo $d['log_type']; ?>" ppt-border1>

<div class="d-md-flex justift-content-between"> 
    
    <div class="pr-lg-5 w-100">
    
        <div class="d-flex">
        
         
         <div ppt-icon-size="32" class="mr-3 text-warning"><?php echo $CORE_UI->icons_svg['bell']; ?></div>
         
         
             <div class="ml-md-3">
                    <div class="font-weight-bold"> <?php echo $title; ?></div> 
                      
                      <div class="text-muted small mt-2"> <?php echo $desc; ?></div>
                      
                      <div class="text-muted tiny text-uppercase mt-2 opacity-5 mobile-mb-2"><?php echo $d['time']; ?></div>
             
             </div>
        </div>
    
    </div> 
    
<div>

<div class="row">



       <?php if(strlen($extra_button) > 1){ ?>
        <div class="col-6 col-md-12  mb-md-2">
        <a <?php if(isset($onClickB)){ ?> href="javascript:void(0);" onclick="<?php echo $extra_button; ?>" <?php }else{ ?>href="<?php echo $extra_button; ?>" <?php } ?>  data-ppt-btn class="list btn-warning btn-sm btn-block"><?php echo __("view","premiumpress"); ?></a>
       </div>
       <?php } ?> 
<div class="col-6 col-md-12">
<button type="button" onclick="notify_delete('<?php echo $log->ID; ?>');" data-ppt-btn class="list btn-system btn-sm btn-block"><?php echo __("delete","premiumpress"); ?></button>
</div>       
 </div>      
</div> 
     

</div> 
</div>
  <?php /*<textarea style="height:150px;  width:100%;"><?php print_r($d); ?></textarea>*/ ?>
    <?php
				
} }

?>

<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//CLEAR LOGS 
$CORE->USER("logs_clear_count", $userdata->ID );


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($shown_logs == 0){
?>
<div class="opacity-5 mt-4 font-weight-bold"><?php echo __("No notifications found.","premiumpress"); ?></div>
<?php } 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
 
</div>
 
<?php if(isset($_POST['action']) && !isset($GLOBALS['flag-account'])  ){  ?>
</div>
<div class="_footer text-center py-3 bg-light border-top">
 
    <button type="button" class="btn-system btn-lg btn-close" data-ppt-btn> 
   
   <span><?php echo __("Close Window","premiumpress") ?></span>
    
    </button>

</div>
</div>
<?php } ?>