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


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$make = "";
$model = "";
if(isset($_GET['eid'])){ 
$make 	= get_post_meta($_GET['eid'],"make", true);
$model 	= get_post_meta($_GET['eid'],"model", true);
}

$list = array();
if(isset($GLOBALS['ppt_makes'])){
	$list = $GLOBALS['ppt_makes'];
}
$data = array();
foreach($list as $m){
	$data[str_replace(" ","",strtolower($m))] = __($m,"premiumpress");
}
 
					 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>
 <div class="my-4 p-2 show-mobile text-600">
<h4><?php echo __("Select a make and model.","premiumpress"); ?> </h4>
</div>

<div class="border">
<div class="row no-gutters">


    <div class="col-md-6">
    <div class="ppt-scroll ppt-scroll1"  id="parent_makes">
        <div class="catlist" style="max-height:400px;">
        
        <?php foreach($data as $k => $v){  ?>
        
        <div class="_cat <?php if($make == $k){ echo "check active"; } ?>" data-key="<?php echo $k; ?>">
         <div class="small opacity-5"><?php echo $v; ?></div>
		 
        </div>
        <?php } ?>
        
   </div>
   </div>
   </div>
   
    
	<div class="col-md-6">
   <div class="ppt-scroll ppt-scroll2" id="parent_models">
     <div class="catlist" style="max-height:400px;"></div>
    </div>
	</div>
    
</div>


<input type="hidden"  name="custom[make]" class="form-control" value="<?php echo $make; ?>" />
<input type="hidden"  name="custom[model]" class="form-control" value="<?php echo $model; ?>" />


<hr class="hide-mobile" />
<div class="d-flex justify-content-between card-footer-nav ">

<button class="btn btn-system" type="button" onclick="ClearAllModels();"><?php echo __("Clear All","premiumpress"); ?></button>


<button class="btn btn-primary btn-close hide-mobile" type="button"><?php echo __("Continue","premiumpress"); ?></button>


</div>

<script>

function ClearAllModels(){


jQuery(".data-make-wrap .cardbox").addClass("closed");
jQuery(".data-model-wrap .cardbox").addClass("closed");

jQuery(".data-make").html('');
jQuery(".data-model").html('');

}

jQuery(document).ready(function(){ 

const qs = new PerfectScrollbar('.ppt-scroll1');
const qs1 = new PerfectScrollbar('.ppt-scroll2');

SelectModels();

SelectMakes();

});

function SelectModels(){

	var a = jQuery("#parent_makes .catlist > div:not(.hasTrigger)");
	a.each(function (a) {
	
		jQuery(this).addClass('hasTrigger');		
		jQuery(this).on("click", function (e) {
			 
			jQuery("#parent_makes .active").removeClass("active");
			 			
			jQuery(this).toggleClass('active');			
			jQuery(this).addClass('check');   
			
			jQuery("[name='custom[make]']").val(jQuery(this).attr("data-key"));
			
			jQuery(".data-make-wrap .cardbox").removeClass("closed");
			jQuery(".data-make").html(jQuery(this).attr("data-key"));
			
			SelectMakes();
			
			 
		});
	}); 
}

function SelectMakes(){

	var make = jQuery("[name='custom[make]']").val();
	var sel = jQuery("[name='custom[model]']").val();
	

	jQuery.ajax({
		type: "POST",
		url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
				action: "ajax_load_makes",
				make: make, 
				selected: sel
		},
		success: function(response) {
		  	 
			jQuery("#parent_models .catlist").html(response.output);
			
			var a = jQuery("#parent_models .catlist > div:not(.hasTrigger)");
			a.each(function (a) {
			
				jQuery(this).addClass('hasTrigger');		
				jQuery(this).on("click", function (e) {
					 
					jQuery("#parent_models .active").removeClass("active");
								
					jQuery(this).toggleClass('active');			
					jQuery(this).addClass('check');   
					
					jQuery("[name='custom[model]']").val(jQuery(this).attr("data-key"));
					
					jQuery(".data-model-wrap .cardbox").removeClass("closed");
					jQuery(".data-model").html(jQuery(this).attr("data-key"));
				 	 
				});
			}); 
			  
				
		},
		error: function(e) {
			console.log(e)
		}
	});

}


</script>
<style>
.catlist > div.active { background:#efefef; }
.catlist > div { border: 1px solid #ddd; padding:10px; margin-top: -1px; font-weight:700; position:relative; cursor:pointer; }
#parent_makes.catlist > div:after { font-family:"Font Awesome 5 Pro";content:"\f054";position:absolute;color:#ccc;top:10px;right:20px;font-size:16px;font-weight:500; }
.catlist > div.active.check:after { font-family:"Font Awesome 5 Pro"; content:"\f058"!important; color:#006600!important; position:absolute; top:10px;right:20px;font-size:16px;font-weight:700!important; }
.ppt-scroll  {  position: relative;  width: 100%;  overflow: auto;}
.ps{overflow:hidden!important;overflow-anchor:none;-ms-overflow-style:none;touch-action:auto;-ms-touch-action:auto}.ps__rail-x{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;height:15px;bottom:0;position:absolute}.ps__rail-y{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;width:15px;right:0;position:absolute}.ps--active-x>.ps__rail-x,.ps--active-y>.ps__rail-y{display:block;background-color:transparent}.ps--focus>.ps__rail-x,.ps--focus>.ps__rail-y,.ps--scrolling-x>.ps__rail-x,.ps--scrolling-y>.ps__rail-y,.ps:hover>.ps__rail-x,.ps:hover>.ps__rail-y{opacity:.6}.ps .ps__rail-x.ps--clicking,.ps .ps__rail-x:focus,.ps .ps__rail-x:hover,.ps .ps__rail-y.ps--clicking,.ps .ps__rail-y:focus,.ps .ps__rail-y:hover{background-color:#eee;opacity:.9}.ps__thumb-x{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,height .2s ease-in-out;-webkit-transition:background-color .2s linear,height .2s ease-in-out;height:6px;bottom:2px;position:absolute}.ps__thumb-y{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,width .2s ease-in-out;-webkit-transition:background-color .2s linear,width .2s ease-in-out;width:6px;right:2px;position:absolute}.ps__rail-x.ps--clicking .ps__thumb-x,.ps__rail-x:focus>.ps__thumb-x,.ps__rail-x:hover>.ps__thumb-x{background-color:#999;height:11px}.ps__rail-y.ps--clicking .ps__thumb-y,.ps__rail-y:focus>.ps__thumb-y,.ps__rail-y:hover>.ps__thumb-y{background-color:#999;width:11px}@supports (-ms-overflow-style:none){.ps{overflow:auto!important}}@media screen and (-ms-high-contrast:active),(-ms-high-contrast:none){.ps{overflow:auto!important}}
</style>