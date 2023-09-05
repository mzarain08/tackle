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

global $CORE, $userdata, $CORE_UI;

	$bannerCount = 0;
   
   $campaigns = new WP_Query( array('posts_per_page' => 200, 'post_type' => 'ppt_campaign', 'orderby' => 'post_date', 'order' => 'desc', 'author' => $userdata->ID  ) );
    
   $showcart = false; 
   
   $sellspacedata = _ppt('sellspace'); 
   
   // get user banners
   $mybanners = $CORE->ADVERTISING("get_user_banners", array($userdata->ID) );
 ?>
 
  
<div class="fs-lg text-600 mb-2"><?php echo __("My Advertising","premiumpress"); ?></div>
 
   
<?php if(empty($campaigns->posts)){   ?>

<p class="mb-4"><?php echo __("You have not purchased any ads.","premiumpress"); ?></p>

<a href="<?php echo _ppt(array('links','sellspace')); ?>" class="btn-system mt-4" data-ppt-btn><?php echo __("Buy Ads","premiumpress"); ?></a>
    
 
<?php }else{ ?>
   
<p class="mb-4"><?php echo __("Here you can manage your ad campaigns.","premiumpress"); ?></p>
 
      
  <?php if(!empty($campaigns->posts)){  
                        foreach($campaigns->posts as $order){ 
                                                         // BITS
                                                         $bits = explode("-",$order->post_title);
                                                         
                                                         // TIME LEFT
                                                         $timeleft = get_post_meta($order->ID, 'listing_expiry_date',true);
                                                         
                                                         // GET ACTIVE BANNER ID
                                                         $activebannerID = get_post_meta($order->ID, 'bannerid', true);
                        								 
                        								 //campaign name								 
                        								 $campaignID = get_post_meta($order->ID, 'location', true);
                        								 
                        								 // BANNER SIZE
														 if(isset($sellspacedata[$campaignID.'_size'])){
                        								 $size = $sellspacedata[$campaignID.'_size'];
														 }else{
														 $size = "";
														 }
                        								 $size_parts = explode("x", $size);	
														 
														 if(!isset($size_parts[1])){ $size_parts[1] = 0; }							 
                        								  
                                                         // AVAILABLE BANNERS
                                                         $avibanner = $CORE->ADVERTISING("get_user_banners", array($userdata->ID, $size_parts[0], $size_parts[1]) ); 
                                                        
                        								  // STATYS
														  $status = $CORE->ADVERTISING("campaign_status", $order->ID);
														  
														  // EXPIRY
														  $e =  $CORE->ADVERTISING("campaign_expires", $order->ID); 
														  
														  // COUNT
														  $bannerCount++;
                                                         
 ?>
 
 

<div class="card p-4">

<div class="row">

<div class="col-md-8">


<div class="font-weight-bold">#<?php echo $order->ID; ?> - <?php  $loc = $CORE->ADVERTISING("get_spaces",  $campaignID);  echo  $loc['n']; ?></div>
 
<ul class="list-inline mt-4">

<li class="list-inline-item border rounded p-1 px-3 text-600 bg-light"> <span class="badge badge-success mr-1"><?php echo $CORE->ADVERTISING("campaign_impressions", $order->ID); ?></span> <span><?php echo __("Views","premiumpress"); ?></span> </li>

<li class="list-inline-item border rounded p-1 px-3 text-600 bg-light"> <span class="badge badge-warning mr-1"><?php echo $CORE->ADVERTISING("campaign_clicks", $order->ID); ?></span> <span><?php echo __("Clicks","premiumpress"); ?></span> </li>


<li class="list-inline-item border rounded p-1 px-3 text-600 bg-light"> <span class="badge badge-warning mr-1" style="background:<?php echo $status['color']; ?>; color:#FFFFFF;"><?php echo $status['short']; ?></span> </li>
 

</ul>
 
                   
<div class="mt-4">


           <form action="" method="post">
                           <input type="hidden" name="action" value="sellspace_set" />
                           <input type="hidden" name="showtab" value="sellspace" />
                           <input type="hidden" name="cid" value="<?php echo $order->ID; ?>" />
                           <div class="form-group">
                           <label><?php echo __("Display Banner","premiumpress"); ?> (<?php echo __("size","premiumpress"); ?> <?php echo $size; ?>px)</label>
                                 <select name="bannerid"  class="form-control">
                                    
                                    <?php $shown =0; if(!empty($avibanner)){ foreach( $avibanner as $kh){ $shown++; ?>
                                    <option value="<?php echo $kh['id']; ?>" <?php selected( $activebannerID, $kh['id'] ); ?>> <?php echo $kh['name']; ?> </option>
                                    <?php } }else{ ?>
                                    <option value="0"><?php echo __("No Banner Available","premiumpress"); ?></option>
                                    
                                    <?php } ?>
                                 </select>
                                 
                        <?php if($shown ==0){ ?>
                        <div class="small mt-2 text-danger"><i class="fa fa-exclamation-triangle"></i> <?php echo __("Please upload a banner size","premiumpress"); ?>:  <?php echo $size_parts[0]; ?>px / <?php echo $size_parts[1]; ?>px</div>
                        <?php } ?>
                                 
                       </div>
                          <div class="form-group">        
                              <label><?php echo __("Banner Link","premiumpress"); ?></label>
                                 <input type="input" name="camurl" value="<?php echo get_post_meta($order->ID, 'url', true); ?>" placeholder="https://..." class="form-control" />
                          </div>
                                 <button class="btn-primary mt-3" data-ppt-btn><?php echo __("Save Changes","premiumpress"); ?></button>   
                             
                        </form>

</div>

<?php if(!$e['expired']){ ?>
<div class="mt-4 small opacity-5">

<div class="d-flex">
<div ppt-icon-16 data-ppt-icon-size="16" class="mr-2"><?php echo $CORE_UI->icons_svg['clock']; ?></div>
 <?php  echo $e['days']." ".__("left","premiumpress");   ?>
</div>

</div>
<?php } ?>
 

</div>

 
</div>


</div>



 
 
<?php } } ?>
 
 
 
 

            <h5 class="mt-5"><?php echo __("My Banners","premiumpress"); ?></h5>
            <hr />
            <div class="bg-light p-3 mb-4">
               <form action="" method="post" class="p-3 bg-light" enctype="multipart/form-data"  id="bupload">
                 <input type="hidden" name="showtab" value="sellspace" />
                  <input type="hidden" name="action" value="sellspace" />
                  <input type="file" name="ppt_banner[]" onfocus="jQuery('#savemb').show();" />
                  <div>
                  <button type="submit" class="btn-primary mt-4" data-ppt-btn id="savemb" style="display:none;"><?php echo __("Save Banner","premiumpress"); ?></button> 
                  </div>  
               </form>
            </div>
            <?php if(!empty($mybanners)){	?>
            <div class="row">
               <?php foreach($mybanners as $k=> $ban){  ?>
               <div class="col-6" id="bannerbox-<?php echo $ban['id']; ?>">
                  <div class="border p-2 mb-4">
                     <div class="text-center">
                        <a href="<?php echo $ban['img']; ?>" target="_blank" class="frame"><img src="<?php echo $ban['img']; ?>" class="img-fluid"></a>
                     </div>
                     <div class="container">
                        <div class="row mt-2 border-top pt-2">
                           <div class="col-md-10">
                              <div class="mt-1 small"><?php echo $ban['name']." (".$ban['w']; ?> X <?php echo $ban['h'].")"; ?> </div>
                           </div>
                           <div class="col-md-2 text-right">
                              
                              
                                 <button class="btn-sm btn-danger rounded-0 text-uppercase float-right" data-ppt-btn type="button" onclick="ajax_banner_delete('<?php echo $ban['id']; ?>');">
                                 
                                 <div ppt-icon-20 data-ppt-icon-size="20"><?php echo $CORE_UI->icons_svg['trash']; ?></div>
                                 
                                 </button>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
            </div>
               
            <?php }else{ ?>
            <div class="text-muted"><?php echo __("No banners found","premiumpress"); ?></div>
            <?php } ?>   
 


<?php } ?>


 










<script>

function ajax_banner_delete(id){


if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
		   
 
// RESET
jQuery('#ajax_response_msg').html("");	
 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "sellspace_delete",
			delid: id,
        },
        success: function(response) {
	 
 
			if(response.status == "ok"){
			 		
				// HIDE ROW
				jQuery('#bannerbox-'+id).hide();	
				
				jQuery("#bupload").submit();
				 
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg1').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            alert("error gere "+e)
        }
    });
	
}
	
}// end are you sure 
 
jQuery(document).ready(function(){ 
	jQuery(".count-advertising").html("<?php echo $bannerCount; ?>"); 
});
</script>