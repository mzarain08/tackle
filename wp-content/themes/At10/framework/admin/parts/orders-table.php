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
        <span class="ajax-search-found"></span> <?php echo __("Orders","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto">
    
  <button type="button" onclick="jQuery('#add-tab').tab('show');" data-ppt-btn  class="btn-primary btn-lg"><?php echo __("Add Order","premiumpress"); ?></button>

    
    </li>
  </ul>
</nav>
<hr />

  

<div id="ajax_response_msg"></div>
<textarea style="width:100%; height:100px;display:none;" id="_filter_data"></textarea>
<input type="hidden" name="cardtype" value="admin-order" class="customfilter"  data-type="select" data-key="cardtype" />
<input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" />
<input type="hidden" class="customfilter" name="perpage" data-type="select" data-key="perpage" value="30">

<?php if(isset($_GET['pakid']) && is_numeric($_GET['pakid']) ){  ?>
<input type="hidden" name="order_pakid" class="customfilter" data-type="select" data-key="order_pakid" value="<?php echo $_GET['pakid']; ?>" />
<?php }elseif(isset($_GET['uid']) && is_numeric($_GET['uid']) ){  ?>
<input type="hidden" name="order_memid" class="customfilter" data-type="select" data-key="order_memid" value="<?php echo $_GET['uid']; ?>" />
<?php }elseif(isset($_GET['memid']) && is_numeric($_GET['memid']) ){  ?>
<input type="hidden" name="order_memid" class="customfilter" data-type="select" data-key="order_memid" value="<?php echo $_GET['memid']; ?>" />
<?php } ?>



<div class="card card-admin" ppt-border1>
  <nav ppt-nav class="p-3 pb-0">
    <ul>
      <li>
        <nav ppt-nav class="boxed pill shadow-sm fs-7 text-600">
          <ul>
            <li class="cursor" onclick="UpdateStatusT('1');"><a href="#" ><?php echo __("Paid","premiumpress"); ?></a></li>
            <li class="cursor" onclick="UpdateStatusT('2');"><a href="#"><?php echo __("Pending","premiumpress"); ?></a></li>
            <li class="cursor" onclick="UpdateStatusT('3');"><a href="#"><?php echo __("Failed","premiumpress"); ?></a></li>
          </ul>
        </nav>
      </li>
      <li class="ml-auto ppt-forms style3" style="min-width:300px;">
        <div class="position-relative">
          <input type="text" class="form-control customfilter pl-3" name="keyword" data-type="text" onchange="_filter_update()" data-key="keyword" autocomplete="off" placeholder="<?php echo __("Keyword...","premiumpress"); ?>" value="">
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

	 
    jQuery(".getstatscheck").each(function (a) {   
	
		if(jQuery(this).is(':checked')){
		
			jQuery(this).attr('checked',false); 
		
		}    	
		
    });	
	
	

	jQuery("#order_status_"+v+"_check").attr('checked',true);
	
	_filter_update();

}

function customsortby1(v){
 
 	if(jQuery('[data-key="sortby"]').val() == v){	 
	jQuery("#filter-sortby-main").val(v+'-u');		
	}else{
	jQuery("#filter-sortby-main").val(v);	
	}	
	
	_filter_update();
}

</script>

 
   
      <div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="actionsbox">
        <?php _ppt_template('framework/admin/parts/order-table-actions' ); ?>
      </div>
      
      <div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="filterssidebox">
        <?php _ppt_template('framework/admin/parts/order-table-filters' ); ?>
      </div>
      
      
      <div class="bg-white">
        <div class="premiumpress_table members">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="doselectall();" /></th>
                <th><?php echo __("Amount","premiumpress"); ?>
                
                 <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('order_total');jQuery(this).find('i').toggleClass('fa-sort-numeric-down-alt').toggleClass('fa-sort-numeric-up')"><i class="fa fa-sort-alpha-down-alt"></i></a> 
                
                
                </th>
                <th style="width:150px;"><?php echo __("Date","premiumpress"); ?>
                
                 <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('date');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a> 
                
                </th>
                <th class="text-center"><?php echo __("Type","premiumpress"); ?> </th>
                <th class="text-center" style="width:150px;"><?php echo __("Status","premiumpress"); ?></th>
                <th class="text-center"><?php echo __("Action","premiumpress"); ?></th>
              </tr>
            </thead>
            <tbody id="ajax-search-output">
            </tbody>
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
</div></div>

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
            admin_action: "mass_update_orders",
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



  

function ajax_delete_order(id){


// RESET
jQuery('#ajax_response_msg').html("");	

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "order_delete",
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

 
function ajax_testing_orders_add(){

// RESET
jQuery('#ajax_response_msg').html("");	

 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "testing_order_add",
			 
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("Orders added successfully");	
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure


</script>
