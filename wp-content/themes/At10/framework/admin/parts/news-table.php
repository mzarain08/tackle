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
 
<nav ppt-nav class="sepetator">
  <ul>
    <li>
      <div class="fs-md text-600">
        <span class="ajax-search-found"></span> <?php echo __("Ads","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="#" onclick="jQuery('#add-tab').tab('show');"  class="btn-primary btn-lg" data-ppt-btn>
    <span class="ml-2"><?php echo __("Add New","premiumpress"); ?></span> </a> </li>
  </ul>
</nav>
<hr />

 


<div id="ajax_response_msg"></div>  

<textarea style="width:100%; height:100px;display:none;" id="_filter_data"></textarea>

<input type="hidden" name="cardtype" value="admin-news" class="customfilter"  data-type="select" data-key="cardtype" />
 
 
<div class="row">
 
<div class="col"> 
 
 
<div class="card card-admin p-4">  

    <div class="row mb-3">    
        <div class="col">  
        
        <div class="">

        <a href="javascript:void(0);" class="btn btn-system btn-md hide-mobile" onclick="showfilersbar();"><i class="fa fa-filter"></i> <?php echo __("Show Filters","premiumpress"); ?> </a>
          
         <span id="ajax_response_msg"></span>      
  

        </div>
                 
        </div>
       
       
           <div class="col-md-8 text-right">
    
        <div class="filter_sortby t1"> 
        
         <a href="javascript:void(0);" data-key="hits" class="active"><span><?php echo __("Views","premiumpress"); ?><i></i></span></a>
       
        <a href="javascript:void(0);" data-key="date"><span><?php echo __("Date","premiumpress"); ?><i></i></span></a>
            
        
    	</div>
        
         <input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" />
        
         <input type="hidden" class="customfilter" name="perpage" data-type="select" data-key="perpage" value="30">
    
    </div>
       
       
       
        
    </div>
    
    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="actionsbox">

<?php _ppt_template('framework/admin/parts/cashout-table-actions' ); ?>
 
</div>    
    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="filterssidebox">

<?php _ppt_template('framework/admin/parts/cashout-table-filters' ); ?>
  
</div>
    
	<div class="bg-white">    
    <div class="premiumpress_table members">
     
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>  
                        	<th><input type="checkbox" onclick="doselectall();" /></th>                      
                            <th></th>						
							 
                            
                            </th>
                           <th class="text-center">&nbsp;  </th>
                             
							<th class="text-center"><?php echo __("Views","premiumpress"); ?> </th>
                            
                            	 <th class="text-center"><?php echo __("Visible","premiumpress"); ?></th>
                        	<th class="text-center"><?php echo __("Status","premiumpress"); ?></th>
                          
                            
                            <th class="text-center"><?php echo __("Action","premiumpress"); ?></th>
                        </tr>
                    </thead>
                    <tbody id="ajax-search-output"></tbody>                
                </table>
                
                
                <hr />
                
                <div class="d-flex justify-content-between align-items-center py-2 letter-spacing-1">

                <div class="text-muted small">
                <span class="ajax-search-found">100</span> <?php echo __("results","premiumpress"); ?> - 
                <?php echo __("page","premiumpress"); ?> <span class="ajax-search-page">1</span> of <span class="ajax-search-pageof">10</span>
                </div>
               
                <div class="ajax-search-pagenav"></div>
                
            	</div> 
                
    </div>
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

 

function ajax_delete_news(id){


// RESET
jQuery('#ajax_response_msg').html("");	

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "news_delete",
			uid: id,
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 		
				// HIDE ROW
				jQuery('#postid-'+id).hide();	
				
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("<?php echo trim(__("Data Updated","premiumpress")); ?>");	
				 
  		 	
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