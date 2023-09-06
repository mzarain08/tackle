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
        <span class="ajax-search-found"></span> <?php echo __("Users","premiumpress"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="admin.php?page=members&eid=0" class="btn-primary btn-lg" data-ppt-btn> <span class="ml-2"><?php echo __("Add User","premiumpress"); ?></span> </a> </li>
  </ul>
</nav>
<hr />



<textarea style="width:100%; height:100px;display:none;" id="_filter_data"></textarea>

<input type="hidden" name="cardtype" value="admin-user" class="customfilter"  data-type="select" data-key="cardtype" /> 
<input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" value="dateuser-d" />
<input type="hidden" class="customfilter" name="perpage" data-type="select" data-key="perpage" value="10">
  
  
<input type="hidden" data-type="select" data-key="online" data-value="1"> 
<input type="hidden"  data-type="select" data-key="verify" data-value="1">       
<input type="hidden"  data-type="select" data-key="user_type" data-value="all" value="all">       
  

<script>

function UpdateUserType(v,e){	 	
		
	jQuery('[data-key="'+v+'"]').val(e);
 	jQuery('[data-key="'+v+'"]').addClass("customfilter");
	_filter_update();

}

function UpdateStatusT(v){	 	
		
	if(jQuery('[data-key="'+v+'"]').hasClass("customfilter")){
		jQuery('[data-key="'+v+'"]').val(0);
		jQuery('[data-key="'+v+'"]').removeClass("customfilter");
	}else{
		jQuery('[data-key="'+v+'"]').val(1);
		jQuery('[data-key="'+v+'"]').addClass("customfilter");
	} 
 	
	_filter_update();

}

</script>

<div class="" ppt-border1>
  <nav ppt-nav class="p-3 pb-0">
    <ul>
      <li>
        <nav ppt-nav class="boxed pill shadow-sm fs-7 text-600">
          <ul>
            <li class="cursor" onclick="UpdateStatusT('online');jQuery(this).addClass('active');"><a href="#" ><?php echo __("Online Now","premiumpress"); ?></a></li>
             
            <li class="cursor" onclick="UpdateStatusT('verify');jQuery(this).addClass('active');"><a href="#"><?php echo __("Verified","premiumpress"); ?></a></li>
            
            <!--<li class="cursor" onclick="UpdateStatusT('not-verify');jQuery(this).addClass('active');"><a href="#"><?php echo __("Not-Verified","premiumpress"); ?></a></li>-->
           
            
          </ul>
        </nav>
      </li>
      <li class="ml-auto ppt-forms style3" style="min-width:300px;">
        <div class="position-relative">
        <input type="text" class="form-control customfilter" name="username" data-type="text" data-key="username"  placeholder="<?php echo __("Username..","premiumpress"); ?>" value="<?php if(isset($_GET['username'])){ echo esc_attr($_GET['username']); } ?>">
          
          
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



    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="actionsbox">

<?php _ppt_template('framework/admin/parts/user-table-actions' ); ?>
 
</div>    
    
<div class="col-md-12 px-0 bg-light border-top" style="display:none;" id="filterssidebox">

<?php _ppt_template('framework/admin/parts/user-table-filters' ); ?>
  
</div>
      
    <div class="premiumpress_table members" style="margin: -1px;">
     
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>  
                        	<th><input type="checkbox" onclick="doselectall();" /></th>                       
                           
                            <th><?php echo __("Name","premiumpress"); ?>
                            
                            
                            <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('dateuser');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a>
                            
                            </th>						
                            <th><?php echo __("Joined","premiumpress"); ?>  
                            
                            <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('userdate');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a>
                             
                             
                             </th>
                            <th><?php echo __("Last Seen","premiumpress"); ?>
                            
                            
                               <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('lastlogin');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a>
                            
                            </th>
                            <th class="text-center"><?php echo __("Orders","premiumpress"); ?></th>
                            <th>
							
							<?php echo __("Credit","premiumpress"); ?>
                            
                                  <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('credit');jQuery(this).find('i').toggleClass('fa-sort-numeric-down-alt').toggleClass('fa-sort-numeric-up')"><i class="fa fa-sort-alpha-down-alt"></i></a>
                            
                            </th>
                            <th style="width:150px;" class="text-center"><?php echo __("Action","premiumpress"); ?></th>
                            
                        </tr>
                    </thead>
                    <tbody id="ajax-search-output"></tbody>                
                </table>
                <hr />
                
                <div class="d-flex justify-content-between  p-3">
             	<div>                
                <span class="text-600"><span class="ajax-search-found">100</span> <?php echo __("results","premiumpress"); ?></span>                
				<span class="opacity-5 fs-sm">
                <span class="ajax-search-page">1</span> of <span class="ajax-search-pageof">10</span>
                </span>                
                </div>  
                <div class="ajax-search-pagenav"></div>                
            	</div>                
                </div>  
   			 </div>
	 
  
 


<script>


function customsortby1(v){
 
 	if(jQuery('[data-key="sortby"]').val() == v){	 
	jQuery("#filter-sortby-main").val(v+'-u');		
	}else{
	jQuery("#filter-sortby-main").val(v);	
	}	
	
	_filter_update();
}

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
            admin_action: "mass_update_users",
			pids: ids,
			//cat: jQuery('#mass-cat').val(),
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


 
function ajax_user_verify(id,divid){
 
	 var self = jQuery(this);
	 
	  
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "user_verify",
			uid: id,
        },
        success: function(response) {
					
			if(response.current == "yes"){
				
				jQuery("#"+divid+' i').removeClass('text-danger').addClass('text-success');					 
  		 	
			}else{
							
				jQuery("#"+divid+' i').removeClass('text-success').addClass('text-danger');
			} 
			
			jQuery('#ajax_response_msg').html("User Updated");
					
        },
        error: function(e) {
            console.log(e)
        }
    });
}

 

function ajax_user_delete(id){

if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {

// RESET

jQuery('#ajax_response_msg').html("");	
 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "user_delete",
			pid: id,
        },
        success: function(response) {
	 
 
			if(response.status == "ok"){
			 		
				// HIDE ROW
				jQuery('#postid-'+id).hide();	
				
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("<?php echo trim(__("User Deleted successfully","premiumpress")); ?>");	
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            alert("error gere "+e)
        }
    });
	
}// end are you sure

}

</script>