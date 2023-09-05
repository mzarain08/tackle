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

global $CORE, $userdata;

$eid = 0; $paymentDue = 0;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$title = str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Create a new %s","premiumpress") );

if(THEME_KEY == "dl"){

$title = __("Add a new vehicle","premiumpress");
}

if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ 
$eid = $_GET['eid'];
$title = str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Update my %s","premiumpress") );

$foundA = get_post_meta($eid,'totaldue',true);
if(is_numeric($foundA) && $foundA > 0){
$paymentDue = $foundA;
}

}

wp_register_script( 'ppt-up-js', CDN_PATH.'js/js.up.js', array( 'jquery' ), true);
wp_enqueue_script( 'ppt-up-js' );
wp_enqueue_style("ppt-up-css", 	CDN_PATH.'css/_up.css');
wp_enqueue_style("ppt-submit-css", 	CDN_PATH.'css/_submitform.css'); 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$userIP = array();
if( !isset($_GET['eid']) && !in_array(THEME_KEY,array("sp")) && _ppt(array('lst','default_location')) != '0' ){

	$re = (array)json_decode($CORE->GEO("get_user_geo_data", 0));
	
	if(isset($re['data'])){
	$userIP = $re['data'];
	} 
	
	$GLOBALS['userIP'] = $userIP;

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$fields = array(



	"intro" => array(
	
		"img"		=>	"sform_basic",
		"title" 	=> __("Basics","premiumpress"),
		"desc" 		=> $title,
		"info"		=> __("Increase your page views with a catchy title!","premiumpress"),
		
		"fields" 	=> array(
			
			1 => array( "path" => "framework/design/add/add-title" ),
			
			2 => array( "path" => "framework/design/add/add-aftertitle" ),
			 
		),
	
	),
	
	"description" => array(
	
		"img"		=>	"sform_desc",
		"title" 	=> __("Description","premiumpress"),
		"desc" 		=> __("Description","premiumpress"),
		"info"		=> __("Make your description easy to read. Focus on benefits and features and includes lot's of detail for best results.","premiumpress"),
		
		"fields" 	=> array( 
		
			1 => array( "path" => "framework/design/add/add-excerpt" ),
			
			2 => array( "path" => "framework/design/add/add-content" ), 
			
			3 => array( "path" => "framework/design/add/add-keywords" ),
			
			4 => array( "path" => "framework/design/add/add-features" ),			
		
		),
	),

	"details" => array(
	
		"img"		=>	"sform_details",
		"title" 	=> __("Details","premiumpress"),
		"desc" 		=> __("Details","premiumpress"),
		"info"		=> "",
		
		"fields" 	=> array( 
		
			1 => array( "path" => "framework/design/add/add-customfields" ),
		
		),	
	),
	
	
	"media" => array(
	
		"img"		=>	"sform_media",
		"title" 	=> __("Media","premiumpress"),
		"desc" 		=> __("Media","premiumpress"),
		"info"		=> __("Upload your best photos for maximum results. You can resize and crop images after you've uploaded them.","premiumpress"),
		
		"fields" 	=> array( 
			
			1 => array( "path" => "framework/design/add/add-media" ),
		
		),
	
	), 
	
	
	"finish" => array(
	
		"img"		=>	"sform_finish",
		"title" 	=> __("Finish","premiumpress"),
		"desc" 		=> __("Finish","premiumpress"),
		"info"		=> "",
		
		"fields" 	=> array( 
			
			1 => array( "path" => "framework/design/add/add-save" ),
		
		),
	
	), 
	
);
 
if(THEME_KEY == "sp"){
	$fields["intro"]["fields"][3] = array( "path" => "framework/design/add/add-product" );
	unset($fields["details"]["fields"][1]);
}
 
if(THEME_KEY == "cb"){
	$fields["details"]["fields"][2] = array( "path" => "framework/design/add/add-product-cashback" );
}

if(THEME_KEY == "vt"){
	$fields["details"]["fields"][2] = array( "path" => "framework/design/add/add-series" );
	 
}

if(!$userdata->ID){
 
$fields["intro"]["info"] = __("Already a member?","premiumpress")." <a href='#' onclick='processLogin(0);'>".__("Sign in","premiumpress")."</a>";
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>

<div id="ppt-add-listing-save" style="display:none;">
    <div class="container py-5 my-5">
        <div class="alert alert-primary p-3 alert-dismissible fade show" role="alert"> 
            <strong><i class="fa fa-spin fa-sync mr-3"></i>  <?php echo __("Saving Your Changes","premiumpress"); ?></strong> - <?php echo __("This may take a few minutes, please wait...","premiumpress"); ?> 
        </div>
    </div>
</div>



<div id="ppt-add-listing-form" class="<?php if(!is_admin()){ ?>my-5<?php } ?> ppt-forms style3" data-step="1">
<?php
$i=1;	
foreach($fields as $k => $b){
 
	$img = _ppt($b['img']);
	
	$tip = _ppt(array('lst', $b['img']."_tip"));
 
	if($tip == ""){
	$tip = $b['info'];
	}
	
	
 
?>

 
<section class="container px-0 add-block block<?php echo $i; ?> <?php if($i == 1){ echo "active"; }  ?>">

 <div class="ppt-add-listing-error"></div>
  
<div class="add-block-wrap">
 
    <div class="row no-gutters">
   
    <div class="col-lg-4 bg-primary hide-mobile position-relative overflow-hidden tipsidebar">
    
    <div class="bg-image" data-bg="<?php  if(strlen($img) > 1){ echo $img; }elseif( $b['img'] == "sform_basic"){ echo DEMO_IMGS."?sidebar=".$b['img']."&t=".THEME_KEY; } ?>"></div>
    
    <div class="card h-100 bg-none border-0">
    
        <div class="card-body"> 

      
      
        </div>
        
        <div class="card-footer bg-none">
        
        <?php if( THEME_KEY != "sp" && strlen($tip) > 1){ ?> 
        
        <div class="bg-white shadow text-dark mb-4 p-3 rounded-lg">
        
        <?php if(function_exists('current_user_can') && current_user_can('administrator')){ ?>
        <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=listingsetup&lefttab=s" class="text-dark"><i class="fa fa-pencil float-right"></i></a>
        <?php } ?>
        
		<div class="text-700 mb-2"><i class="fa fa-info-circle mr-2"></i> <?php echo __("Quick Tip","premiumpress"); ?></div> 
		<?php echo wpautop($tip); ?>
        </div>  
        
       <?php } ?>
        
       
       <?php if($eid > 0){ ?>
       <a href="<?php echo get_permalink($eid); ?>" target="_blank" data-ppt-btn class="list btn-block btn-lg btn-system mb-2"><?php echo __("View Ad","premiumpress"); ?></a>  
       
	    <a href="javascript:void(0)" onclick="processStats(<?php echo $eid; ?>);" data-ppt-btn class="list btn-block btn-lg btn-system mb-4"><?php echo __("Statistics","premiumpress"); ?></a>  
       
	   
	   <?php } ?>
       
        <div class="ppt-add-listing-payment" <?php if($paymentDue == 0){ ?>style="display:none;"<?php } ?>>
            <div class="container px-0 mb-4">
                <div class="bg-black rounded p-3 text-light">
                    <div class="d-flex justify-content-between text-700">
                    
                    <div><?php echo __("Total","premiumpress"); ?></div>
                    
                    <div class="totalPriceDisplay"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $paymentDue; ?></span></div>
                    
                    </div>
                </div>
            </div>
         
        </div>
               
        
       <button data-ppt-btn class=" btn-secondary btn-block btn-lg text-600 btn-save" type="button"><?php echo __("Save","premiumpress"); ?></button>
        
        </div>
    
    </div>
     
    
    
    </div>
   
    
    <div class="col-lg-8"> 
    
    <div class="card card-add-block mb-0"><div class="card-body"> 
    
    <div class="_title"><span class="title-number bg-secondary">0<?php echo $i; ?></span> <?php echo $b['desc']; ?></div> 
    
    <?php  
	
	if($k === "details"){
		switch(THEME_KEY){		
			case "sp":{
				_ppt_template('framework/design/add/add-product-category' ); 
				_ppt_template('framework/design/add/add-product-details' );
			} break;
			case "so":{			
				_ppt_template('framework/design/add/add-filedownload' );				
			} break;
			case "cm":{			
				_ppt_template('framework/design/add/add-compare' );				
				_ppt_template('framework/design/add/add-compare-stores' );							
			} break;
			case "mj":{					
				_ppt_template('framework/design/add/add-gigs' );				
				_ppt_template('framework/design/add/add-faq' );								
			} break;
			case "ll":{			
				_ppt_template('framework/design/add/add-coursedownload' ); 				
			} break;
			case "es":{
				_ppt_template('framework/design/add/add-callrates' );						
				_ppt_template('framework/design/add/add-workinghours' ); 				 	
			} break;
			case "dt":{
				 _ppt_template('framework/design/add/add-services' );				  
				 _ppt_template('framework/design/add/add-workinghours' ); 			
			} break;	
			
			case "jb":{				 			  
				 _ppt_template('framework/design/add/add-workinghours' ); 			
			} break;	
					
			case "rt": {			
				 _ppt_template('framework/design/add/add-workinghours' ); 
			} break;
			case "dl": {			
				 _ppt_template('framework/design/add/add-workinghours' ); 
			} break; 
		}  
	}
	
    foreach($b['fields'] as $f){ _ppt_template( $f['path'] ); } 
 	
	?>
     
    </div>
    <div class="card-footer">
     
    
    <div class="d-flex justify-content-between p-2 text-600">
    
    <div><button data-ppt-btn class=" btn-system btn-back btn-lg scroll-top-quick" type="button" onClick="steps('<?php echo $i; ?>','back')"><i class="fa fa-arrow-left mr-2"></i> <?php echo __("Back","premiumpress"); ?></button></div>
    
    <div>
    <button  data-ppt-btn class=" btn-system btn-forward btn-lg scroll-top-quick text-600" type="button" onClick="steps('<?php echo $i; ?>','forward')"><?php echo __("Next","premiumpress"); ?> <i class="fa fa-arrow-right ml-2"></i> </button>
    
    
    <button data-ppt-btn class=" btn-secondary btn-block btn-lg text-600 btn-save" type="button" ><?php echo __("Save","premiumpress"); ?></button>
      
    
    </div>
    
    
    </div>
    
     </div>
    
    </div>
    
    </div>
    
    </div>


</div>


 
 
 
 <div class="row overflow-hidden mt-4 steps-box hide-mobile">
<?php $s=1; foreach($fields as $kk => $bb){ ?> 
      
       <div class="col-md-5ths col-lg-5ths mobile-mb-2 scroll-top-quick <?php if($s < $i){ ?>active<?php } ?>" onClick="steps('<?php echo $s; ?>','this')"> 
       
       <span class="number-box px-xl-3 text-tuncate">
      
      		<span class="number bg-secondary">0<?php echo $s; ?></span> <?php echo $bb['title']; ?>
       
       </span>
       	 
      </div>
      
<?php $s++; } ?>
</div>


 
</section>

 
  


<?php $i++; }
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>

<div class="ppt-add-listing-payment mb-4 show-mobile" <?php if($paymentDue == 0){ ?>style="display:none;"<?php } ?>>

    <div class="container mt-4">
        <div class="bg-black rounded p-3 text-light">
            <div class="d-flex justify-content-between text-700">
            
            <div><?php echo __("Total","premiumpress"); ?></div>
            
            <div class="totalPriceDisplay"><span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $paymentDue; ?></span></div>
            
            </div>
        </div>
    </div>
 
</div>

<section class="mb-5  text-600 show-mobile">
<div class="container">

<button type="button" data-ppt-btn class=" btn-lg btn-secondary btn-save" id="mainSaveBtn"><?php echo __("Save","premiumpress"); ?></button>

</div>
</section>


<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
?>


</div>

<?php if(is_admin()){ ?>
<input type="hidden" name="custom[adminareaedit]" class="form-control" value="1" />
<?php } ?>

<input type="hidden" name="totaldue" id="totaldue" class="form-control" value="<?php echo $paymentDue; ?>" />

 
<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ ?>
<input type="hidden" name="eid" value="<?php echo esc_attr($_GET['eid']); ?>" />
<input type="hidden" class="form-control" name="oldeid" value="<?php echo esc_attr($_GET['eid']); ?>" />
<?php } ?>


<?php if(isset($_GET['repost'])){ ?>
<input type="hidden" class="form-control" name="repost" value="1" />
<?php } ?>
 

<form  method="post" enctype="multipart/form-data" id="SUBMISSION_FORM" onsubmit="return false;" style="display:none;"></form>
 

<?php
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/*
if( _ppt(array('sms','force'))  == '1' && !$userdata->ID ){
?>
<input type="hidden" id="smschecked" name="" value="0"/>
<?php 
}
*/
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
<script>
function showcustomfields(){	
	
	jQuery('.customfield').addClass("hidden").hide();
	var sList = ""; var catid = -1;
	
	jQuery(".usercat").each(function() {
		catid = jQuery(this).attr('data-id');	 	 
		jQuery('.customid-' + catid).removeClass("hidden").show();       	   
	});	
	
	jQuery("#parent_category_list .active").each(function() {
		catid = jQuery(this).attr('data-id');	 	 
		jQuery('.customid-' + catid).removeClass("hidden").show();       	   
	});	
	
	jQuery("#subcategory_list .active").each(function() {
		catid = jQuery(this).attr('data-id');	
		jQuery('.customid-' + catid).removeClass("hidden").show();       	   
	});
	
	// SHOW ALL ALLOWED
	jQuery('.customid-0').show();  
	
	// REMOVED REQUIRED FROM HIDDEN FIELDS
	jQuery(".customfield.hidden .required-field").each(function(i, obj) {		 	
		jQuery(this).removeClass("required-field").addClass("required-field-xxx"); 		       	   
	});	
	
	// SHOW SWITCHED FIELDS
	jQuery('.customid-' + catid+' .required-field-xxx').each(function(i, obj) {		 	
		jQuery(this).removeClass("required-field-xxx").addClass("required-field"); 		       	   
	});	
	 
	jQuery('.customid-0 .required-field-xxx').each(function(i, obj) {		 	
		jQuery(this).removeClass("required-field-xxx").addClass("required-field"); 		       	   
	});	
} 

function updateTotal(){

	var totaldue = 0;
 
	if(jQuery('[data-amount]').length > 0){
		
		var a = jQuery("[data-amount]");
		a.each(function (a) {
		
			var type = jQuery(this).attr('type');
			
			console.log(type);
			
			if(  ( type == "checkbox" || type == "radio"  ) && jQuery(this).prop("checked") ){
			
			amount = parseFloat(jQuery(this).attr("data-amount"));			
			totaldue += amount;
			
			}else if(jQuery(this).val() == 1){
			
			amount = parseFloat(jQuery(this).attr("data-amount"));			
			totaldue += amount;
			
			}
			
		});
	}
	
	jQuery("#totaldue").val(totaldue);
	jQuery(".totalPriceDisplay span").html(totaldue);
	UpdatePrices();
	
	if(totaldue > 0){
	
		jQuery(".ppt-add-listing-payment").show();
	
		jQuery(".btn-save").html("<?php echo __("Pay Now","premiumpress"); ?>");
	
	}else{
	
	jQuery(".btn-save").html("<?php echo __("Save","premiumpress"); ?>");
	
	}
	
 
}

jQuery(document).ready(function(){ 

	textarealimit(); 
	
	jQuery('.scroll-top-quick').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 100);
			return false;
	});
	
	<?php if(!$userdata->ID){ ?>
	 
	jQuery('input[data-key="title"]').on('change', function () {
			username_generate(jQuery('input[data-key="title"]').val());
			 
	});
	
	jQuery('input[data-key="username"]').on('change', function () {
	
		jQuery(this).val(jQuery(this).val().replace(/\s+/g, ''));
			 
	});
	
	
	<?php } ?> 
	
	<?php if($paymentDue > 0){ ?>
	jQuery(".btn-save").html("<?php echo __("Pay Now","premiumpress"); ?>");
	<?php } ?>
	
	jQuery(".btn-save").on('click',function(e) {		 
		processSubmitForm();
	});
	
		setTimeout(function(){ 
							
			showcustomfields();
					
		}, 2000);
	
	 
	
});




<?php if(is_admin()){ ?>
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
				
				jQuery("."+t+"-icon-"+id+' i').addClass('text-success fa-check').removeClass('fa-times text-danger');					 
  		 	
			}else{
							
				jQuery("."+t+"-icon-"+id+' i').addClass('text-danger fa-times').removeClass('fa-check text-success');	
			}  
					
        },
        error: function(e) {
            console.log(e)
        }
    });
}
<?php } ?>

function username_generate(name){

	jQuery("#ajax-username").html('');

	jQuery.ajax({
                type: "POST",
				dataType: 'json',
                url: '<?php echo home_url(); ?>/',		
         	data: {
                     action: "ajax_username_generate",
         			name: name, 
                 },
               success: function(response) {
         		 
         			if(response.status == "ok"){
					 
					 jQuery("#ajax-username").html('');
					 
					jQuery.each(response.data, function(key, val) {							 
							 
						jQuery("#ajax-username").append('<div class="usertry" data-block="block" data-parent="username" data-value="'+val+'">'+val+'</div>');
						
					});
					
					
					jQuery('.usertry').each(function () { 	
					
						jQuery(this).on('click',function(e) {
						
							var input = jQuery('input[data-key="username"]');
							
							 jQuery(".usertry").removeClass('checked');
							 
							 jQuery(input).removeClass('required-active');	
							 
							jQuery(this).addClass('checked');
								
							input.val(jQuery(this).attr("data-value")); 	
							 					
						
						});	
					
					});
					
						 
         			
         			} 		
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
	});

}
function ValidateUsername(){

	var input = jQuery('[data-key="username"]');
	if(input.val().length < 3){
	return false;
	}
	
	jQuery.ajax({
                 type: "POST",
				 dataType: 'json',
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                     action: "validateUsername",
         			un: input.val(), 
                 },
                 success: function(response) {         		
         			 
						if( response.status == "ok"){			
					  
						jQuery("#ajax-username").html('');
						 
						return true;
												
						}else{						
						 
						 jQuery(input).addClass('required-active');						 
						  					 
						 return false; 						 
						}					
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
	});	
	
	return true;

}

function noUserAccess(){

alert("<?php echo __("You can add more media once you've saved this ad.","premiumpress"); ?>");
return false;
}

function steps(id,action){

	jQuery('.add-block').removeClass('active'); 
	
	if(action == "this"){
		jQuery('.block'+id).addClass('active');
	}else if(action == "forward"){
		nxt = parseFloat(id)+1;
		console.log(nxt);
		jQuery('.block'+nxt).addClass('active');
	}else{
		console.log(id);
		nxt = parseFloat(id)-1;
		console.log(nxt);
		jQuery('.block'+nxt).addClass('active');
	} 
 
}


function processEditData(btype){
	
	fd = btype;
	
	 if(btype != "map" && btype != "category" && jQuery(".modal-"+fd).length > 0){
		 
		 jQuery(".modal-"+fd).remove();
		 
	 }else{
	
	jQuery.ajax({
			type: "POST",
			url: ajax_site_url,		
			data: {
				   action: "load_editlisting_form",		
				   type: btype,
				   eid: <?php echo $eid; ?>,   
				 
			   },
			   success: function(response) {
			    
			   
			   pptModal(btype, response, "modal-bottom-rightxxx", "ppt-animate-fadein bg-white w-700 p-3", 0); 
			   
				if(btype == "map"){
				
				jQuery('head').append('<link rel="stylesheet" href="'+ CNDPath + 'css/css.plugins-flag.css" type="text/css" id="ppt-loaded-flags" />');	
				
				}
				
				if(btype == "sms"){
				
					loadJS(CNDPath + 'js/js.mobileprefixU.js', 'ppt-mobile-sms', function(el) {				
					
						var handleChange = function() {    
							jQuery("#mobilenum-input").val(iti.getNumber());
						}
					   
						var input = document.querySelector("#mobilenum-input");
						var iti = window.intlTelInput(input, { 
						  utilsScript: "<?php echo CDN_PATH.'js/js.mobileprefixU.js'; ?>",
						 // autoHideDialCode: false,
						  nationalMode: false,
						   
						});
					
						input.addEventListener('change', handleChange);
						input.addEventListener('keyup', handleChange);
						 
						jQuery(".iti__country-list li").click(function(e) {				 
							jQuery("#mobilenum-input").val( '+' + jQuery(this).data('dial-code') ); 
							
						}); 
					}); 
				
				}
			   		  
									
			   },
			   error: function(e) {
				   console.log(e)
			   }
		   });
		   
	}

}


function processSubmitForm(){ 
 
	canContinue = true;
	
	
	<?php if( in_array(THEME_KEY, array("dt","mj","ct","rt")) && !isset($_GET['eid']) ){ ?>
		
		if(jQuery(".tempcat, .usercat").length == 0){
	 	steps('1','this');
		alert("<?php echo __("Please select a category.","premiumpress"); ?>");
		return false;
		}	 
	
	<?php } ?>
	
	jQuery(".form-control").removeClass('required-active');
	jQuery(".ppt-add-listing-error").html(''); 

	// FIRE DEFAULT VALIDATION
	canContinue = js_validate_fields("<?php echo __("Please completed all required fields.","premiumpress"); ?>"); 
	
	// SWITCH TAB
	if(jQuery(".block1 .required-active").length > 0){
	steps('1','this');	
	}else if(jQuery(".block2 .required-active").length > 0){
	steps('2','this');
	}else if(jQuery(".block3 .required-active").length > 0){
	steps('3','this');
	}else if(jQuery(".block4 .required-active").length > 0){
	steps('4','this');
	}else if(jQuery(".block5 .required-active").length > 0){
	steps('5','this');
	}
	
	if(!canContinue){
	return;
	}
	
 	if(jQuery('[data-key="username"]').length > 0){		
		if(!ValidateUsername()){
			steps('5','this');
			jQuery('[data-key="username"]').addClass('required-active');
			alert("<?php echo __("Please enter a valid username","premiumpress"); ?>");
			return false;
		}		
	}
	
 	if(jQuery('[data-key="mypass"]').length > 0){		
		if(jQuery('[data-key="mypass"]').val() == "" || jQuery('[data-key="mypass1"]').val() == "" || ( jQuery('[data-key="mypass"]').val() != jQuery('[data-key="mypass1"]').val())){
			steps('5','this');
			jQuery('[data-key="mypass"]').addClass('required-active');
			alert("<?php echo __("Please create a valid account password.","premiumpress"); ?>");
			return false;
		}		
	}
	 
	
	<?php if( in_array(THEME_KEY, array("dt","es","dl","rt")) && in_array(_ppt(array('design', "display_openinghours")), array("","1")) ){ ?>
	// BUSINESS HOURS PLUGIN
	jQuery('.startTime').attr('name', 'startTime[]');
	jQuery('.endTime').attr('name', 'endTime[]');
	jQuery('.isActive').attr('name', 'isActive[]');
	<?php } ?>

	
	<?php if(!is_admin() && THEME_KEY != "vt" && _ppt(array('lst', 'default_listing_require_image' )) == 1){ ?>
	if(jQuery('.vidbox-photo .btn-success').length == 0){
		steps('4','this');
		alert("<?php echo __("Please upload an image.","premiumpress"); ?>");
		return false;
	}
	<?php } ?>
	
	<?php if(!$userdata->ID){ ?>
	if(jQuery('.myemail').val() == ""){
		jQuery('.myemail').addClass('required-active');
		steps('5','this');
		alert("<?php echo __("Please enter your email address.","premiumpress"); ?>");
		return false;
	
	}
	if(!isValidEmail(jQuery('.myemail').val())){
		jQuery('.myemail').addClass('required-active');
		steps('5','this');
		alert("<?php echo __("Please enter a valid email address.","premiumpress"); ?>");
		return false;
	}
	
	 
	
	jQuery('.myemail').removeClass('required-active');
	<?php } ?> 
	
	<?php if(!defined('WLT_CART') && is_numeric(_ppt(array('lst', 'descmin' ))) && _ppt(array('lst', 'descmin' )) > 0){ ?>							
	// CHECK IF VALUE IS ON
	if(jQuery('#field-post_content').length){
	
		var text_length = jQuery('#field-post_content').val().length;	
		if( text_length < <?php echo _ppt(array('lst', 'descmin')); ?> ){	
		
			jQuery('#field-post_content').addClass('required-active').focus();
									
			alert("<?php echo __("Please enter a bigger description.","premiumpress"); ?>");
			steps('2','this');
			return false;
		}	
	}						
	<?php } ?>
	
	
	 // GOOGLE RECAPTURE	
	 <?php if(!is_admin() && _ppt(array('captcha','enable')) == 1 && _ppt(array('captcha','sitekey')) != "" ){ ?>
	if(jQuery("#g-recaptcha-response").length == 0 || jQuery("#g-recaptcha-response").val().length == 0){
		steps('5','this');
		alert("<?php echo __("Please verify you're not a robot.","premiumpress"); ?>");
		return false;
	} 
	jQuery("#g-recaptcha-response").addClass("form-control"); 
	<?php } ?>
	
	// MOVE ALL FORM DATA INTO PLACE
	jQuery('#SUBMISSION_FORM').html('');
	jQuery('.form-control').each(function(){
	
		var attr = jQuery(this).attr('name'); 
		if (typeof attr !== 'undefined' && attr !== false) { 	
	 		
			var type = jQuery(this).attr('type');
			 
			if(  ( type == "checkbox" || type == "radio"  ) && !jQuery(this).prop("checked") ){
			 
			 //console.log(type+' skipped '+attr);
			
			}else{
			
			jQuery('#SUBMISSION_FORM').append('<textarea type="text" name="'+jQuery(this).attr('name')+'">'+jQuery(this).val()+'</textarea>');
			
			}
		}
		
		//jQuery(this).html().clone().appendTo(jQuery('#SUBMISSION_FORM'));	
		 
	});	
 
	// SHOW SPINNER
	if(canContinue){
	
		jQuery('#ppt-add-listing-form').hide();
		jQuery('#ppt-add-listing-save').show(); 	 
	 
		// SAVE THE DATA 
		jQuery.ajax({
			type: "POST",
			dataType: 'json',
			url: '<?php echo home_url(); ?>/',	
			enctype: 'multipart/form-data',	
			data: {
				action: "savelisting",
				formdata: jQuery('#SUBMISSION_FORM').serialize(), 
					 
			},
			success: function(response) { 
			
				if(response.status == "error"){				 
					
					jQuery('#ppt-add-listing-save').hide();
					jQuery('#ppt-add-listing-form').show();
					jQuery(".ppt-add-listing-error").html('<div>'+response.msg+"</div>");
					
					if(response.type == "email" || response.type == "username" ){
					steps('5','this');
					}
				
				
				}else if(response.status == "payment"){	
					
					
					processNewPayment(response.paymentdata);
					
					jQuery(".modal-category, .modal-map").hide();
					
					jQuery('#ppt-add-listing-save').hide();
					jQuery('#ppt-add-listing-form').show();
					
				}else{ 
				  
				 window.location.replace(response.link); 
				 
				}		
							
			}
	
		});	
		
	}	 
		 
}


function textarealimit(){
   
     
   	text_max = <?php if(!is_numeric(_ppt(array('lst', 'descmin' )))){ echo 100; }else{ echo _ppt(array('lst', 'descmin' )); } ?>;
   
     if(text_max == 0 || text_max == ""){
   	  jQuery('#textarea_counter').hide();
	  jQuery('#textarea_counter_hidden').val('1');
   	  return;
     }
	 
	 if(jQuery('#field-post_content').length){
	 
     	var text_length = jQuery('#field-post_content').val().length;
	 
		 var text_remaining = text_max - text_length;
		 if(text_remaining < 0){
		 jQuery('#textarea_counter').hide();
		 }
	   
		 jQuery('#textarea_counter span').html( '<b>' + text_remaining + '</b> <?php echo __("characters remaining","premiumpress"); ?>');
	   
		  jQuery('#field-post_content').keyup(function() {
		
			   var text_length = jQuery('#field-post_content').val().length;
			   var text_remaining = text_max - text_length; 
	   
			   jQuery('#textarea_counter span').html( '<b>' + text_remaining + '</b> <?php echo __("characters remaining","premiumpress"); ?>');
			
			if(text_remaining < 0){
				jQuery('#textarea_counter').hide();
				 jQuery('#textarea_counter_hidden').val('1');
			}else{
				jQuery('#textarea_counter').show();
				 jQuery('#textarea_counter_hidden').val('0');
			}
			
		  }); 
	 
	 }
	  
}

/* SCROLL */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.PerfectScrollbar=e()}(this,function(){"use strict";function t(t){return getComputedStyle(t)}function e(t,e){for(var i in e){var r=e[i];"number"==typeof r&&(r+="px"),t.style[i]=r}return t}function i(t){var e=document.createElement("div");return e.className=t,e}function r(t,e){if(!v)throw new Error("No element matching method supported");return v.call(t,e)}function l(t){t.remove?t.remove():t.parentNode&&t.parentNode.removeChild(t)}function n(t,e){return Array.prototype.filter.call(t.children,function(t){return r(t,e)})}function o(t,e){var i=t.element.classList,r=m.state.scrolling(e);i.contains(r)?clearTimeout(Y[e]):i.add(r)}function s(t,e){Y[e]=setTimeout(function(){return t.isAlive&&t.element.classList.remove(m.state.scrolling(e))},t.settings.scrollingThreshold)}function a(t,e){o(t,e),s(t,e)}function c(t){if("function"==typeof window.CustomEvent)return new CustomEvent(t);var e=document.createEvent("CustomEvent");return e.initCustomEvent(t,!1,!1,void 0),e}function h(t,e,i,r,l){var n=i[0],o=i[1],s=i[2],h=i[3],u=i[4],d=i[5];void 0===r&&(r=!0),void 0===l&&(l=!1);var f=t.element;t.reach[h]=null,f[s]<1&&(t.reach[h]="start"),f[s]>t[n]-t[o]-1&&(t.reach[h]="end"),e&&(f.dispatchEvent(c("ps-scroll-"+h)),e<0?f.dispatchEvent(c("ps-scroll-"+u)):e>0&&f.dispatchEvent(c("ps-scroll-"+d)),r&&a(t,h)),t.reach[h]&&(e||l)&&f.dispatchEvent(c("ps-"+h+"-reach-"+t.reach[h]))}function u(t){return parseInt(t,10)||0}function d(t){return r(t,"input,[contenteditable]")||r(t,"select,[contenteditable]")||r(t,"textarea,[contenteditable]")||r(t,"button,[contenteditable]")}function f(e){var i=t(e);return u(i.width)+u(i.paddingLeft)+u(i.paddingRight)+u(i.borderLeftWidth)+u(i.borderRightWidth)}function p(t,e){return t.settings.minScrollbarLength&&(e=Math.max(e,t.settings.minScrollbarLength)),t.settings.maxScrollbarLength&&(e=Math.min(e,t.settings.maxScrollbarLength)),e}function b(t,i){var r={width:i.railXWidth},l=Math.floor(t.scrollTop);i.isRtl?r.left=i.negativeScrollAdjustment+t.scrollLeft+i.containerWidth-i.contentWidth:r.left=t.scrollLeft,i.isScrollbarXUsingBottom?r.bottom=i.scrollbarXBottom-l:r.top=i.scrollbarXTop+l,e(i.scrollbarXRail,r);var n={top:l,height:i.railYHeight};i.isScrollbarYUsingRight?i.isRtl?n.right=i.contentWidth-(i.negativeScrollAdjustment+t.scrollLeft)-i.scrollbarYRight-i.scrollbarYOuterWidth:n.right=i.scrollbarYRight-t.scrollLeft:i.isRtl?n.left=i.negativeScrollAdjustment+t.scrollLeft+2*i.containerWidth-i.contentWidth-i.scrollbarYLeft-i.scrollbarYOuterWidth:n.left=i.scrollbarYLeft+t.scrollLeft,e(i.scrollbarYRail,n),e(i.scrollbarX,{left:i.scrollbarXLeft,width:i.scrollbarXWidth-i.railBorderXWidth}),e(i.scrollbarY,{top:i.scrollbarYTop,height:i.scrollbarYHeight-i.railBorderYWidth})}function g(t,e){function i(e){b[d]=g+Y*(e[a]-v),o(t,f),R(t),e.stopPropagation(),e.preventDefault()}function r(){s(t,f),t[p].classList.remove(m.state.clicking),t.event.unbind(t.ownerDocument,"mousemove",i)}var l=e[0],n=e[1],a=e[2],c=e[3],h=e[4],u=e[5],d=e[6],f=e[7],p=e[8],b=t.element,g=null,v=null,Y=null;t.event.bind(t[h],"mousedown",function(e){g=b[d],v=e[a],Y=(t[n]-t[l])/(t[c]-t[u]),t.event.bind(t.ownerDocument,"mousemove",i),t.event.once(t.ownerDocument,"mouseup",r),t[p].classList.add(m.state.clicking),e.stopPropagation(),e.preventDefault()})}var v="undefined"!=typeof Element&&(Element.prototype.matches||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector),m={main:"ps",element:{thumb:function(t){return"ps__thumb-"+t},rail:function(t){return"ps__rail-"+t},consuming:"ps__child--consume"},state:{focus:"ps--focus",clicking:"ps--clicking",active:function(t){return"ps--active-"+t},scrolling:function(t){return"ps--scrolling-"+t}}},Y={x:null,y:null},X=function(t){this.element=t,this.handlers={}},w={isEmpty:{configurable:!0}};X.prototype.bind=function(t,e){void 0===this.handlers[t]&&(this.handlers[t]=[]),this.handlers[t].push(e),this.element.addEventListener(t,e,!1)},X.prototype.unbind=function(t,e){var i=this;this.handlers[t]=this.handlers[t].filter(function(r){return!(!e||r===e)||(i.element.removeEventListener(t,r,!1),!1)})},X.prototype.unbindAll=function(){var t=this;for(var e in t.handlers)t.unbind(e)},w.isEmpty.get=function(){var t=this;return Object.keys(this.handlers).every(function(e){return 0===t.handlers[e].length})},Object.defineProperties(X.prototype,w);var y=function(){this.eventElements=[]};y.prototype.eventElement=function(t){var e=this.eventElements.filter(function(e){return e.element===t})[0];return e||(e=new X(t),this.eventElements.push(e)),e},y.prototype.bind=function(t,e,i){this.eventElement(t).bind(e,i)},y.prototype.unbind=function(t,e,i){var r=this.eventElement(t);r.unbind(e,i),r.isEmpty&&this.eventElements.splice(this.eventElements.indexOf(r),1)},y.prototype.unbindAll=function(){this.eventElements.forEach(function(t){return t.unbindAll()}),this.eventElements=[]},y.prototype.once=function(t,e,i){var r=this.eventElement(t),l=function(t){r.unbind(e,l),i(t)};r.bind(e,l)};var W=function(t,e,i,r,l){void 0===r&&(r=!0),void 0===l&&(l=!1);var n;if("top"===e)n=["contentHeight","containerHeight","scrollTop","y","up","down"];else{if("left"!==e)throw new Error("A proper axis should be provided");n=["contentWidth","containerWidth","scrollLeft","x","left","right"]}h(t,i,n,r,l)},L={isWebKit:"undefined"!=typeof document&&"WebkitAppearance"in document.documentElement.style,supportsTouch:"undefined"!=typeof window&&("ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch),supportsIePointer:"undefined"!=typeof navigator&&navigator.msMaxTouchPoints,isChrome:"undefined"!=typeof navigator&&/Chrome/i.test(navigator&&navigator.userAgent)},R=function(t){var e=t.element,i=Math.floor(e.scrollTop);t.containerWidth=e.clientWidth,t.containerHeight=e.clientHeight,t.contentWidth=e.scrollWidth,t.contentHeight=e.scrollHeight,e.contains(t.scrollbarXRail)||(n(e,m.element.rail("x")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarXRail)),e.contains(t.scrollbarYRail)||(n(e,m.element.rail("y")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarYRail)),!t.settings.suppressScrollX&&t.containerWidth+t.settings.scrollXMarginOffset<t.contentWidth?(t.scrollbarXActive=!0,t.railXWidth=t.containerWidth-t.railXMarginWidth,t.railXRatio=t.containerWidth/t.railXWidth,t.scrollbarXWidth=p(t,u(t.railXWidth*t.containerWidth/t.contentWidth)),t.scrollbarXLeft=u((t.negativeScrollAdjustment+e.scrollLeft)*(t.railXWidth-t.scrollbarXWidth)/(t.contentWidth-t.containerWidth))):t.scrollbarXActive=!1,!t.settings.suppressScrollY&&t.containerHeight+t.settings.scrollYMarginOffset<t.contentHeight?(t.scrollbarYActive=!0,t.railYHeight=t.containerHeight-t.railYMarginHeight,t.railYRatio=t.containerHeight/t.railYHeight,t.scrollbarYHeight=p(t,u(t.railYHeight*t.containerHeight/t.contentHeight)),t.scrollbarYTop=u(i*(t.railYHeight-t.scrollbarYHeight)/(t.contentHeight-t.containerHeight))):t.scrollbarYActive=!1,t.scrollbarXLeft>=t.railXWidth-t.scrollbarXWidth&&(t.scrollbarXLeft=t.railXWidth-t.scrollbarXWidth),t.scrollbarYTop>=t.railYHeight-t.scrollbarYHeight&&(t.scrollbarYTop=t.railYHeight-t.scrollbarYHeight),b(e,t),t.scrollbarXActive?e.classList.add(m.state.active("x")):(e.classList.remove(m.state.active("x")),t.scrollbarXWidth=0,t.scrollbarXLeft=0,e.scrollLeft=0),t.scrollbarYActive?e.classList.add(m.state.active("y")):(e.classList.remove(m.state.active("y")),t.scrollbarYHeight=0,t.scrollbarYTop=0,e.scrollTop=0)},T={"click-rail":function(t){t.event.bind(t.scrollbarY,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarYRail,"mousedown",function(e){var i=e.pageY-window.pageYOffset-t.scrollbarYRail.getBoundingClientRect().top>t.scrollbarYTop?1:-1;t.element.scrollTop+=i*t.containerHeight,R(t),e.stopPropagation()}),t.event.bind(t.scrollbarX,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarXRail,"mousedown",function(e){var i=e.pageX-window.pageXOffset-t.scrollbarXRail.getBoundingClientRect().left>t.scrollbarXLeft?1:-1;t.element.scrollLeft+=i*t.containerWidth,R(t),e.stopPropagation()})},"drag-thumb":function(t){g(t,["containerWidth","contentWidth","pageX","railXWidth","scrollbarX","scrollbarXWidth","scrollLeft","x","scrollbarXRail"]),g(t,["containerHeight","contentHeight","pageY","railYHeight","scrollbarY","scrollbarYHeight","scrollTop","y","scrollbarYRail"])},keyboard:function(t){function e(e,r){var l=Math.floor(i.scrollTop);if(0===e){if(!t.scrollbarYActive)return!1;if(0===l&&r>0||l>=t.contentHeight-t.containerHeight&&r<0)return!t.settings.wheelPropagation}var n=i.scrollLeft;if(0===r){if(!t.scrollbarXActive)return!1;if(0===n&&e<0||n>=t.contentWidth-t.containerWidth&&e>0)return!t.settings.wheelPropagation}return!0}var i=t.element,l=function(){return r(i,":hover")},n=function(){return r(t.scrollbarX,":focus")||r(t.scrollbarY,":focus")};t.event.bind(t.ownerDocument,"keydown",function(r){if(!(r.isDefaultPrevented&&r.isDefaultPrevented()||r.defaultPrevented)&&(l()||n())){var o=document.activeElement?document.activeElement:t.ownerDocument.activeElement;if(o){if("IFRAME"===o.tagName)o=o.contentDocument.activeElement;else for(;o.shadowRoot;)o=o.shadowRoot.activeElement;if(d(o))return}var s=0,a=0;switch(r.which){case 37:s=r.metaKey?-t.contentWidth:r.altKey?-t.containerWidth:-30;break;case 38:a=r.metaKey?t.contentHeight:r.altKey?t.containerHeight:30;break;case 39:s=r.metaKey?t.contentWidth:r.altKey?t.containerWidth:30;break;case 40:a=r.metaKey?-t.contentHeight:r.altKey?-t.containerHeight:-30;break;case 32:a=r.shiftKey?t.containerHeight:-t.containerHeight;break;case 33:a=t.containerHeight;break;case 34:a=-t.containerHeight;break;case 36:a=t.contentHeight;break;case 35:a=-t.contentHeight;break;default:return}t.settings.suppressScrollX&&0!==s||t.settings.suppressScrollY&&0!==a||(i.scrollTop-=a,i.scrollLeft+=s,R(t),e(s,a)&&r.preventDefault())}})},wheel:function(e){function i(t,i){var r=Math.floor(o.scrollTop),l=0===o.scrollTop,n=r+o.offsetHeight===o.scrollHeight,s=0===o.scrollLeft,a=o.scrollLeft+o.offsetWidth===o.scrollWidth;return!(Math.abs(i)>Math.abs(t)?l||n:s||a)||!e.settings.wheelPropagation}function r(t){var e=t.deltaX,i=-1*t.deltaY;return void 0!==e&&void 0!==i||(e=-1*t.wheelDeltaX/6,i=t.wheelDeltaY/6),t.deltaMode&&1===t.deltaMode&&(e*=10,i*=10),e!==e&&i!==i&&(e=0,i=t.wheelDelta),t.shiftKey?[-i,-e]:[e,i]}function l(e,i,r){if(!L.isWebKit&&o.querySelector("select:focus"))return!0;if(!o.contains(e))return!1;for(var l=e;l&&l!==o;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var s=l.scrollHeight-l.clientHeight;if(s>0&&!(0===l.scrollTop&&r>0||l.scrollTop===s&&r<0))return!0;var a=l.scrollWidth-l.clientWidth;if(a>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===a&&i>0))return!0}l=l.parentNode}return!1}function n(t){var n=r(t),s=n[0],a=n[1];if(!l(t.target,s,a)){var c=!1;e.settings.useBothWheelAxes?e.scrollbarYActive&&!e.scrollbarXActive?(a?o.scrollTop-=a*e.settings.wheelSpeed:o.scrollTop+=s*e.settings.wheelSpeed,c=!0):e.scrollbarXActive&&!e.scrollbarYActive&&(s?o.scrollLeft+=s*e.settings.wheelSpeed:o.scrollLeft-=a*e.settings.wheelSpeed,c=!0):(o.scrollTop-=a*e.settings.wheelSpeed,o.scrollLeft+=s*e.settings.wheelSpeed),R(e),(c=c||i(s,a))&&!t.ctrlKey&&(t.stopPropagation(),t.preventDefault())}}var o=e.element;void 0!==window.onwheel?e.event.bind(o,"wheel",n):void 0!==window.onmousewheel&&e.event.bind(o,"mousewheel",n)},touch:function(e){function i(t,i){var r=Math.floor(h.scrollTop),l=h.scrollLeft,n=Math.abs(t),o=Math.abs(i);if(o>n){if(i<0&&r===e.contentHeight-e.containerHeight||i>0&&0===r)return 0===window.scrollY&&i>0&&L.isChrome}else if(n>o&&(t<0&&l===e.contentWidth-e.containerWidth||t>0&&0===l))return!0;return!0}function r(t,i){h.scrollTop-=i,h.scrollLeft-=t,R(e)}function l(t){return t.targetTouches?t.targetTouches[0]:t}function n(t){return!(t.pointerType&&"pen"===t.pointerType&&0===t.buttons||(!t.targetTouches||1!==t.targetTouches.length)&&(!t.pointerType||"mouse"===t.pointerType||t.pointerType===t.MSPOINTER_TYPE_MOUSE))}function o(t){if(n(t)){var e=l(t);u.pageX=e.pageX,u.pageY=e.pageY,d=(new Date).getTime(),null!==p&&clearInterval(p)}}function s(e,i,r){if(!h.contains(e))return!1;for(var l=e;l&&l!==h;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var o=l.scrollHeight-l.clientHeight;if(o>0&&!(0===l.scrollTop&&r>0||l.scrollTop===o&&r<0))return!0;var s=l.scrollLeft-l.clientWidth;if(s>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===s&&i>0))return!0}l=l.parentNode}return!1}function a(t){if(n(t)){var e=l(t),o={pageX:e.pageX,pageY:e.pageY},a=o.pageX-u.pageX,c=o.pageY-u.pageY;if(s(t.target,a,c))return;r(a,c),u=o;var h=(new Date).getTime(),p=h-d;p>0&&(f.x=a/p,f.y=c/p,d=h),i(a,c)&&t.preventDefault()}}function c(){e.settings.swipeEasing&&(clearInterval(p),p=setInterval(function(){e.isInitialized?clearInterval(p):f.x||f.y?Math.abs(f.x)<.01&&Math.abs(f.y)<.01?clearInterval(p):(r(30*f.x,30*f.y),f.x*=.8,f.y*=.8):clearInterval(p)},10))}if(L.supportsTouch||L.supportsIePointer){var h=e.element,u={},d=0,f={},p=null;L.supportsTouch?(e.event.bind(h,"touchstart",o),e.event.bind(h,"touchmove",a),e.event.bind(h,"touchend",c)):L.supportsIePointer&&(window.PointerEvent?(e.event.bind(h,"pointerdown",o),e.event.bind(h,"pointermove",a),e.event.bind(h,"pointerup",c)):window.MSPointerEvent&&(e.event.bind(h,"MSPointerDown",o),e.event.bind(h,"MSPointerMove",a),e.event.bind(h,"MSPointerUp",c)))}}},H=function(r,l){var n=this;if(void 0===l&&(l={}),"string"==typeof r&&(r=document.querySelector(r)),!r||!r.nodeName)throw new Error("no element is specified to initialize PerfectScrollbar");this.element=r,r.classList.add(m.main),this.settings={handlers:["click-rail","drag-thumb","keyboard","wheel","touch"],maxScrollbarLength:null,minScrollbarLength:null,scrollingThreshold:1e3,scrollXMarginOffset:0,scrollYMarginOffset:0,suppressScrollX:!1,suppressScrollY:!1,swipeEasing:!0,useBothWheelAxes:!1,wheelPropagation:!0,wheelSpeed:1};for(var o in l)n.settings[o]=l[o];this.containerWidth=null,this.containerHeight=null,this.contentWidth=null,this.contentHeight=null;var s=function(){return r.classList.add(m.state.focus)},a=function(){return r.classList.remove(m.state.focus)};this.isRtl="rtl"===t(r).direction,this.isNegativeScroll=function(){var t=r.scrollLeft,e=null;return r.scrollLeft=-1,e=r.scrollLeft<0,r.scrollLeft=t,e}(),this.negativeScrollAdjustment=this.isNegativeScroll?r.scrollWidth-r.clientWidth:0,this.event=new y,this.ownerDocument=r.ownerDocument||document,this.scrollbarXRail=i(m.element.rail("x")),r.appendChild(this.scrollbarXRail),this.scrollbarX=i(m.element.thumb("x")),this.scrollbarXRail.appendChild(this.scrollbarX),this.scrollbarX.setAttribute("tabindex",0),this.event.bind(this.scrollbarX,"focus",s),this.event.bind(this.scrollbarX,"blur",a),this.scrollbarXActive=null,this.scrollbarXWidth=null,this.scrollbarXLeft=null;var c=t(this.scrollbarXRail);this.scrollbarXBottom=parseInt(c.bottom,10),isNaN(this.scrollbarXBottom)?(this.isScrollbarXUsingBottom=!1,this.scrollbarXTop=u(c.top)):this.isScrollbarXUsingBottom=!0,this.railBorderXWidth=u(c.borderLeftWidth)+u(c.borderRightWidth),e(this.scrollbarXRail,{display:"block"}),this.railXMarginWidth=u(c.marginLeft)+u(c.marginRight),e(this.scrollbarXRail,{display:""}),this.railXWidth=null,this.railXRatio=null,this.scrollbarYRail=i(m.element.rail("y")),r.appendChild(this.scrollbarYRail),this.scrollbarY=i(m.element.thumb("y")),this.scrollbarYRail.appendChild(this.scrollbarY),this.scrollbarY.setAttribute("tabindex",0),this.event.bind(this.scrollbarY,"focus",s),this.event.bind(this.scrollbarY,"blur",a),this.scrollbarYActive=null,this.scrollbarYHeight=null,this.scrollbarYTop=null;var h=t(this.scrollbarYRail);this.scrollbarYRight=parseInt(h.right,10),isNaN(this.scrollbarYRight)?(this.isScrollbarYUsingRight=!1,this.scrollbarYLeft=u(h.left)):this.isScrollbarYUsingRight=!0,this.scrollbarYOuterWidth=this.isRtl?f(this.scrollbarY):null,this.railBorderYWidth=u(h.borderTopWidth)+u(h.borderBottomWidth),e(this.scrollbarYRail,{display:"block"}),this.railYMarginHeight=u(h.marginTop)+u(h.marginBottom),e(this.scrollbarYRail,{display:""}),this.railYHeight=null,this.railYRatio=null,this.reach={x:r.scrollLeft<=0?"start":r.scrollLeft>=this.contentWidth-this.containerWidth?"end":null,y:r.scrollTop<=0?"start":r.scrollTop>=this.contentHeight-this.containerHeight?"end":null},this.isAlive=!0,this.settings.handlers.forEach(function(t){return T[t](n)}),this.lastScrollTop=Math.floor(r.scrollTop),this.lastScrollLeft=r.scrollLeft,this.event.bind(this.element,"scroll",function(t){return n.onScroll(t)}),R(this)};return H.prototype.update=function(){this.isAlive&&(this.negativeScrollAdjustment=this.isNegativeScroll?this.element.scrollWidth-this.element.clientWidth:0,e(this.scrollbarXRail,{display:"block"}),e(this.scrollbarYRail,{display:"block"}),this.railXMarginWidth=u(t(this.scrollbarXRail).marginLeft)+u(t(this.scrollbarXRail).marginRight),this.railYMarginHeight=u(t(this.scrollbarYRail).marginTop)+u(t(this.scrollbarYRail).marginBottom),e(this.scrollbarXRail,{display:"none"}),e(this.scrollbarYRail,{display:"none"}),R(this),W(this,"top",0,!1,!0),W(this,"left",0,!1,!0),e(this.scrollbarXRail,{display:""}),e(this.scrollbarYRail,{display:""}))},H.prototype.onScroll=function(t){this.isAlive&&(R(this),W(this,"top",this.element.scrollTop-this.lastScrollTop),W(this,"left",this.element.scrollLeft-this.lastScrollLeft),this.lastScrollTop=Math.floor(this.element.scrollTop),this.lastScrollLeft=this.element.scrollLeft)},H.prototype.destroy=function(){this.isAlive&&(this.event.unbindAll(),l(this.scrollbarX),l(this.scrollbarY),l(this.scrollbarXRail),l(this.scrollbarYRail),this.removePsClasses(),this.element=null,this.scrollbarX=null,this.scrollbarY=null,this.scrollbarXRail=null,this.scrollbarYRail=null,this.isAlive=!1)},H.prototype.removePsClasses=function(){this.element.className=this.element.className.split(" ").filter(function(t){return!t.match(/^ps([-_].+|)$/)}).join(" ")},H});

</script>


<style>

.ppt-add-listing-error > div { color:#fff; background:red; padding:10px; margin-bottom:10px; font-weight:700; border-radius:4px; }

.usertry { cursor:pointer; display: inline-flex; border-radius: 0.25rem; border: 1px solid #dee2e6; font-weight: 500; font-size:14px; padding: 5px 10px; margin-bottom: 20px; margin-right:10px; }
.usertry.checked { background-color: #fafafb; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); }
.usertry:not(.checked) i {display:none;}
.usertry i {margin-right: 5px;    color: green; }

.usertry.dashed {     box-shadow: none;    border: 1px solid #ddd;    padding: 5px 10px;    background: #fff;}

.gig-box.active i { color:#ffc300; font-weight:700; opacity: 1; }

.step-check { text-align: center; border-radius: 100%;width: 20px;    height: 20px;    font-size: 11px;    display: inline-block;    line-height: 20px;    margin-right: 10px;	    background-color: #35853e;		color:#fff;	}
.step-check.white { background: none;    border: 1px solid #000; }
.step-check.white i { display:none; }

 
.step-text { cursor:pointer;display: inline-block;   width: 100%;    font-weight: 600; font-size: 18px; line-height:40px; }
.wp-admin .step-text { background: #f9f9f9!important; }
 

.tipsidebar .bg-image

.btn-save { font-weight:600!important; }
.card-add-block .btn-save { display:none!important; }
.block5 .card-add-block .btn-save {display:inline-block!important; } 

.cardbox { box-shadow: 0 .125rem .25rem rgba(0,0,0,.035); border: 1px solid #dee2e6;    text-align: center; border-radius:8px; cursor:pointer; margin-bottom:20px; }
.cardbox i { font-size:35px;   }
.cardbox.closed i { opacity: 0.1; }
.cardbox .small { font-weight:600; margin-top:5px; overflow: hidden;    text-overflow: ellipsis;    white-space: nowrap; }
.cardbox.closed { box-shadow:none; background: #fafafb;    border: 2px dashed #ddd; }

.cardbox.closed .on { display:none; }
.cardbox.closed .off { display:inline-block; }

.cardbox .on, .cardbox .on i { display:inline-block; opacity: 1!important; }
.cardbox .off { display:none; }


#ppt-add-listing-form .custom-control-label.input-lg { font-size:14px!important; }
#ppt-add-listing-form .custom-control-label.input-lg::before, #ppt-add-listing-form .custom-control-label.input-lg::after { width:20px; height:20px; top:0px; }
#ppt-add-listing-form .custom-control-label.input-lg::after {  top: 10px; left: -18px; }

#ppt-add-listing-form .card-add-block { border: 0px!important; }
#ppt-add-listing-form .card-add-block .card-footer {     background: linear-gradient(89deg,#fff 0,rgb(248 249 250) 100%); }
#ppt-add-listing-form .add-block:not(.block1) .card-add-block .card-footer {  }
#ppt-add-listing-form .block1 .btn-back {display:none; }
 
#ppt-add-listing-form .input-group-text { } 
#ppt-add-listing-form ._title { margin-top:30px; font-size:28px; font-weight: 600; padding-left:60px; position:relative; margin-bottom: 50px; }
#ppt-add-listing-form .title-number { position: absolute; width:40px; height:40px; background:red; color:#fff; border-radius:100%;  left: 0px;  top: 0px; line-height: 40px; font-size: 16px; text-align:center; }
 
#ppt-add-listing-form ._subtitle { opacity:0.5; font-size:16px; margin-bottom:20px;   padding-bottom: 20px; }
#ppt-add-listing-form  label { font-size:16px; font-weight: 600; margin-bottom: 15px; }
#ppt-add-listing-form .description { opacity:0.5; font-size:12px; }



.steps-box .number  {  display: inline-block; width:25px; height:25px; background:red; color:#fff; border-radius:100%;     line-height: 25px; font-size: 12px;    margin-right: 10px; }
.steps-box  .number-box { cursor:pointer;      font-size: 14px;    display: inline-block;    margin-right: 10px;   text-align: center;    line-height: 50px;    font-weight: 600;    z-index: 2;    position: relative; background: #fafafb; }

.wp-admin .steps-box  .number-box { background:#f9f9f9; }
@media (min-width: 992px){
.steps-box [class*=col-]:after {    width: 100%;    position: absolute;    content: "";    height: 1px;    background: 0 0;    border-top: 1px solid rgba(164,174,198,.2);    top: 1.5rem;    z-index: 0;    left: 3rem;}
}

ul.timeline li.active a { font-weight:600; color:#000; }
ul.timeline li.active:before { background: #000;     z-index: 1; }
@media (min-width: 991.98px) { 

.pak-desc { margin-left:125px; margin-right:100px; }
.pak-desc2 { margin-left:110px; margin-right:100px; }

#ppt-add-listing-form .add-block:not(.active) .card-footer { display:none; }
#ppt-add-listing-form .block5 .btn-forward { display:none; }
#ppt-add-listing-form .add-block:not(.active) { display:none; }
#ppt-add-listing-form .add-block-wrap { box-shadow: 0 .125rem .25rem rgba(0,0,0,.035)!important; background:#fff; border: 1px solid #ddd; border-radius:8px; }
#ppt-add-listing-form .form-control.big { font-size: 24px; margin-bottom: 30px; }


.card-add-block .card-body, .card-add-block .card-footer { padding-left:50px; }
.cardbox { padding:30px; }

#field-post_content { min-height:250px; }

.summarybox { font-size:16px; }
.summarybox .row { padding:10px 0px; }
.summarybox .row:last-child {   }

}
@media (max-width: 991.98px) { 

#ppt-add-listing-form ._title { margin-top:0px; font-size:18px; font-weight: 600; }
#ppt-add-listing-form ._subtitle { opacity:0.5; font-size:14px; }

#ppt-add-listing-form .add-block .card-footer { display:none; }
#ppt-add-listing-form .stepsbox { display:none!important; }
.tipsidebar, .steps-box { display:none!important; }
#ppt-add-listing-form .card-add-block {   }
.paysection { padding:20px; }
.cardbox { padding:10px; }

} 

@media (max-width: 600px) { 
.card-footer-nav { position: absolute;  bottom: 30px;  width: 100%; }
.card-footer {position: absolute;  bottom: 0;  width: 100%; }
}


#ppt-add-listing-form label.checkbox { margin:0px!important; } 
#ppt-add-listing-form label.checkbox .form-control { min-height:20px; box-shadow:none!important; }

#ppt-add-listing-form .exta1a .custom-control-label::before {
    background-color: #ffffff;
    border: #c9c9c9 solid 1px;
}

</style>