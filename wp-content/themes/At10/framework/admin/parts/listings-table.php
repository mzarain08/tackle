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
        <span class="ajax-search-found"></span> <?php echo $CORE->LAYOUT("captions","2"); ?>
      </div>
    </li>
    <li class="ml-auto"> <a href="admin.php?page=listings&addnew=1"  class="btn-primary btn-lg" data-ppt-btn>
    <span class="ml-2"><?php echo __("Add","premiumpress"); ?> <?php echo $CORE->LAYOUT("captions","1"); ?></span> </a> </li>
  </ul>
</nav>
<hr />


<?php

$args = array(
   		'post_type' 		=> 'listing_type',
    	'posts_per_page' 	=> 100,
         'post_status'		=> array('pending_approval'),
);
$countPending = 0;	 		
$wp_custom_query = new WP_Query($args); 
if($wp_custom_query->found_posts > 0 ){
$countPending = $wp_custom_query->found_posts;
}
 

?>

<?php if(isset($_GET['uid']) && is_numeric($_GET['uid']) ){ ?>
<input type="hidden" class="customfilter"  name="userid" data-type="text" data-key="userid" value="<?php echo esc_attr($_GET['uid']); ?>" >
<?php } ?>
<textarea style="width:100%; height:100px;display:none;" id="_filter_data"></textarea>
<input type="hidden" name="cardtype" value="admin-listing" class="customfilter"  data-type="select" data-key="cardtype" />
<input type="hidden" name="sort" class="customfilter" id="filter-sortby-main"  data-type="select" data-key="sortby" />
<input type="hidden" class="customfilter" name="perpage" data-type="select" data-key="perpage" value="30">
<input type="hidden" name="cardlayout" class="customfilter" id="filter-cardlayout"  data-type="select" data-key="cardlayout" value="list1" />
<span id="ajax_response_msg"></span>
<div class="card card-admin" ppt-border1>
  <nav ppt-nav class="p-3 pb-0">
    <ul>
      <li>
        <nav ppt-nav class="boxed pill shadow-sm fs-7 text-600">
          <ul>
            <li class="cursor" onclick="UpdateStatusT('publish');jQuery(this).addClass('active');"><a href="#" ><?php echo __("Live","premiumpress"); ?></a></li>
            <li class="cursor" onclick="UpdateStatusT('pending_approval');jQuery(this).addClass('active');"><a href="#"><?php echo __("Pending","premiumpress"); ?>
              <?php if($countPending > 0){ ?>
              <span class="num bg-warning"><?php echo $countPending; ?></span>
              <?php } ?>
              </a></li>
            <li class="cursor" onclick="UpdateStatusT('payment');jQuery(this).addClass('active');"><a href="#"><?php echo __("Payment","premiumpress"); ?></a></li>
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
	
	jQuery(".boxed.pill li").removeClass('active');
	
	jQuery("#poststatusop").val(v);
	
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
  <div class="col-md-12 px-0  border-top"  style="display:none;" id="actionsbox">
    <?php _ppt_template('framework/admin/parts/listings-table-actions' ); ?>
  </div>
  
  <div class="col-md-12 px-0  border-top" style="display:none;" id="filterssidebox">
    <?php _ppt_template('framework/admin/parts/listings-table-filters' ); ?>
  </div>
  
  <div class="bg-white">
    <div class="premiumpress_table members overflow-auto" style="margin-left: -1px; margin-right: -1px;">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>
              <input type="checkbox" onclick="doselectall();" />
            </th>
            <th><?php echo __("Title","premiumpress"); ?> <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('title');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a> </th>
            <?php if(in_array(THEME_KEY, array("ct","dl"))){ ?>
            <th class="text-center"><?php echo __("Offers","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("jb"))){ ?>
            <th class="text-center"><?php echo __("Applicants","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("mj"))){ ?>
            <th class="text-center"><?php echo __("Orders","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("cp"))){ ?>
            <th class="text-center"><?php echo __("Verified","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("at"))){ ?>
            <th class="text-center"><?php echo __("Bids","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("dt"))){ ?>
            <th class="text-center"><?php echo __("Leads","premiumpress"); ?> <i class="fal fa-info-circle" data-toggle="tooltip" data-title="<?php echo __("The num of times the contact form has been used on the listing page.","premiumpress"); ?>"></i> </th>
            <?php } ?>
            <th class="text-center"> <?php echo __("Views","premiumpress"); ?> <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('hits');jQuery(this).find('i').toggleClass('fa-sort-numeric-down-alt').toggleClass('fa-sort-numeric-up')"><i class="fa fa-sort-numeric-down-alt"></i></a> </th>
            <?php if(in_array(THEME_KEY, array("dt")) && _ppt(array('design', 'single-offers'))  == '1' ){ ?>
            <th class="text-center"><?php echo __("Claimed","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("dt"))  ){ ?>
            <th class="text-center"><?php echo __("City","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("vt"))){ ?>
            <th class="text-center">
              <?php   echo __("Member Access","premiumpress"); ?>
            </th>
            <?php }elseif(in_array(THEME_KEY, array("da","es"))){ ?>
            <th class="text-center"> <?php echo __("Age","premiumpress"); ?> <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('age');jQuery(this).find('i').toggleClass('fa-sort-numeric-down-alt').toggleClass('fa-sort-numeric-up')"><i class="fa fa-sort-numeric-down-alt"></i></a> </th>
            <?php }elseif(in_array(THEME_KEY, array("cp"))){ ?>
            <th class="text-center"><?php echo __("Times Used","premiumpress"); ?></th>
            <?php }elseif(in_array(THEME_KEY, array("ph"))){ ?>
            <th class="text-center"><?php echo __("Downloads","premiumpress"); ?></th>
            <?php }else{ ?>
            <th class="text-center"><?php echo __("Price","premiumpress"); ?> <a href="javascript:void(0);" class="text-dark" onclick="customsortby1('price');jQuery(this).find('i').toggleClass('fa-sort-alpha-down-alt').toggleClass('fa-sort-alpha-up')"><i class="fa fa-sort-alpha-down-alt"></i></a> </th>
            <?php } ?>
            <th class="text-center"><?php echo __("Status","premiumpress"); ?></th>
            <th class="text-center" style="width:150px;"><?php echo __("Action","premiumpress"); ?></th>
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
</div>
<?php 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
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
	
	var mf = 0;
	if(jQuery('#mass_addon_featured').length > 0){
		if(jQuery('#mass_addon_featured').is(':checked')){
		mf = 1;
		}
	}
	
	var mh = 0;
	if(jQuery('#mass_addon_homepage').length > 0){
		if(jQuery('#mass_addon_homepage').is(':checked')){
		mh = 1;
		}
	}
		 
	var ms = 0;
	if(jQuery('#mass_addon_sponsored').length > 0){
		if(jQuery('#mass_addon_sponsored').is(':checked')){
		ms = 1;
		}
	}

	// TURN OFF
	var off_mf = 0;
	if(jQuery('#mass_off_addon_featured').length > 0){
		if(jQuery('#mass_off_addon_featured').is(':checked')){
		off_mf = 1;
		}
	}
	
	var off_mh = 0;
	if(jQuery('#mass_off_addon_homepage').length > 0){
		if(jQuery('#mass_off_addon_homepage').is(':checked')){
		off_mh = 1;
		}
	}
		 
	var off_ms = 0;
	if(jQuery('#mass_off_addon_sponsored').length > 0){
		if(jQuery('#mass_off_addon_sponsored').is(':checked')){
		off_ms = 1;
		}
	}

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "mass_update_listings",
			pids: ids,
			cat: jQuery('#mass-cat').val(),			
			pak: jQuery('#mass-pak').val(),
			
			addon_featured: mf,
			addon_homepage: mh,
			addon_sponsored: ms,
			
			addon_off_featured: off_mf,
			addon_off_homepage: off_mh,
			addon_off_sponsored: off_ms,
			
			
			status: jQuery('#mass-status').val(),
			//deleteall: delall,
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


 

 
jQuery('.makefeatured').on('click', function() {		

var self = jQuery(this);
var id = this.id;	
jQuery('.tabinner').val(id);
			

});
 
function ajax_featured_listing(id,t){
 
	 var self = jQuery(this);
	 
	  
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            admin_action: "listing_featured",
			pid: id,
			type: t,
        },
        success: function(response) {
					
			if(response.current == "yes"){
				
				jQuery("."+t+"-icon-"+id+' i').addClass('text-success');					 
  		 	
			}else{
							
				jQuery("."+t+"-icon-"+id+' i').removeClass('text-success');
			} 
			  
			 
			
					
        },
        error: function(e) {
            console.log(e)
        }
    });
}

function ajax_listing_delete(id){


if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
		   
		


// RESET
jQuery('#ajax_response_msg').html("");	
 
jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "listing_delete",
			pid: id,
        },
        success: function(response) {	 
 
			if(response.status == "ok"){
			 		
				// HIDE ROW
				jQuery('#postid-'+id).hide();
				 
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            alert("error gere "+e)
        }
    });
	
}
	
}// end are you sure

</script>
