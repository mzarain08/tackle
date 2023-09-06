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

global $CORE, $CORE_UI;
 
 
?> 
 
<nav ppt-nav class="sepetator">
  <ul>
    <li>
      <div class="fs-md text-600">
        <span class="ajax-search-found"></span> <?php echo __("Cashback Logs","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="admin.php?page=cashback&addnew=1"  class="btn-primary btn-lg" data-ppt-btn>
    <span class="ml-2"><?php echo __("Add New","premiumpress"); ?></span> </a> </li>
     <li > <a href="#" onclick="jQuery('#settings-tab').trigger('click');window.scrollTo({ top: 0, behavior: 'smooth' });"  class="btn-primary btn-lg" data-ppt-btn>
    <span class="ml-2"><?php echo __("Settings","premiumpress"); ?></span> </a> </li>
  </ul>
</nav>
<hr />

 

<div id="ajax_response_msg"></div>  



<textarea style="width:100%; height:100px;display:none;" id="_filter_data"></textarea>

<input type="hidden" name="cardtype" value="admin-cashback" class="customfilter"  data-type="select" data-key="cardtype" />
 <input type="hidden" class="customfilter" name="perpage" data-type="select" data-key="perpage" value="30">
 
 
 <div class="card card-admin" ppt-border1>
  <nav ppt-nav class="p-3 pb-0">
    <ul>
      <li>
        <nav ppt-nav class="boxed pill shadow-sm fs-7 text-600">
          <ul>
            <li class="cursor" onclick="UpdateStatusT('0');jQuery(this).addClass('active');"><a href="#" ><?php echo __("Pending Upload","premiumpress"); ?></a></li>
            <li class="cursor" onclick="UpdateStatusT('1');jQuery(this).addClass('active');"><a href="#"><?php echo __("Pending","premiumpress"); ?></a></li>
            <li class="cursor" onclick="UpdateStatusT('4');jQuery(this).addClass('active');"><a href="#"><?php echo __("Approved","premiumpress"); ?></a></li>
          </ul>
        </nav>
      </li>
      <li class="ml-auto ppt-forms style3" style="min-width:300px;">
        <div class="position-relative">
          <input type="text" class="form-control customfilter pl-3" name="keyword" data-type="text" onchange="_filter_update()" data-key="keyword" autocomplete="off" placeholder="<?php echo __("Tracking ID","premiumpress"); ?>" value="">
          <button class="btn position-absolute text-muted" style="top:5px; right:0px;" type="button" onclick="_filter_update()">
          <div ppt-icon-24 data-ppt-icon-size="24">
            <?php echo $CORE_UI->icons_svg['search']; ?>
          </div>
          </button>
        </div>
      </li>
      <li>
        <div ppt-icon-20 data-ppt-icon-size="20" class="btn-system js-text-primary" onclick="showfilersbar();" data-ppt-btn >
          <?php echo $CORE_UI->icons_svg['sliders']; ?>
        </div>
      </li>
    </ul>
  </nav>
 
 
<script>
function UpdateStatusT(v){
	
	jQuery(".boxed.pill li").removeClass('active');
	
	jQuery("#poststatusop").val(v);
	
	_filter_update();

}


</script>
    
    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="actionsbox">

<?php _ppt_template('framework/admin/parts/cashback-table-actions' ); ?>
 
</div>    
    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="filterssidebox">

<?php _ppt_template('framework/admin/parts/cashback-table-filters' ); ?>
  
</div>
    
	<div class="bg-white">    
    <div class="premiumpress_table members" style="margin-left: -1px; margin-right: -1px;">
     
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>  
                        	<th><input type="checkbox" onclick="doselectall();" /></th>                      
                            <th><?php echo __("Amount","premiumpress"); ?></th>						
							 
                            
                            </th>
							<th class="text-center"><?php echo __("Amount Paid","premiumpress"); ?>
                            
                            
                            
                            </th>
                        	<th class="text-center"><?php echo __("Status","premiumpress"); ?></th>
                          
                            
                            <th class="text-center"><?php echo __("Action","premiumpress"); ?></th>
                        </tr>
                    </thead>
                    <tbody id="ajax-search-output"></tbody>                
                </table>
                
            
                  <hr />
                <div class="d-flex justify-content-between  p-3">
                    <div>                
                    <span class="text-600"><span class="ajax-search-found">100</span> <?php echo __("results","premiumpress"); ?></span>                
                    <span class="opacity-5 fs-sm"><span class="ajax-search-page">1</span> of <span class="ajax-search-pageof">10</span></span>                
                    </div>  
                    <div class="ajax-search-pagenav"></div>                
            	</div> 
            
 
    
</div> 
</div>
</div>
<script>


function ajax_massupdate_listings(){

	var ids = [];
	var cats = [];
	
	// DELETE ALL
	var delall = false; 
	if(jQuery('#delete-seleced').is(':checked')){
		delall = 1;
	}
	
 	
	jQuery('.checkbox1').each(function(key, value) { //loop through each checkbox
	 
		if(this.checked) { 
		
			ids.push(this.value);
		} 
	
	}); 

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "mass_update_cashout",
			pids: ids,
			cat: jQuery('#mass_os').val(),
			deleteall: delall,
        },
        success: function(response) {
					
			if(response.status == "ok"){
					
				// CHANGE ICON
				_filter_update();					 
  		 	
			}else{		
				
				// CHANGE ICON
				jQuery('#ajax_mass_update_msg').html("Update Failed");					 
  		 		
			} 
			
				
        },
        error: function(e) {
            console.log(e)
        }
    });

} // end function

 
  

function ajax_delete_cashout(id){


// RESET
jQuery('#ajax_response_msg').html("");	

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "cashout_delete",
			uid: id,
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 		
				// HIDE ROW
				jQuery('#postid-'+id).hide();	
				
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("Order deleted successfully");	
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });

}
	
}// end are you sure

 

</script>