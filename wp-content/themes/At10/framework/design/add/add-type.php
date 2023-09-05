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

$type = "";

if(isset($_GET['eid'])){ 
$type 	= get_post_meta($_GET['eid'],"type", true);
}
					 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$data = array(
	
	"car" => array(
		"name" => __("Car","premiumpress"), 
		"icon" => "fa fa-car"
	),
	"truck" => array(
		"name" => __("Truck","premiumpress"), 
		"icon" => "fa fa-truck"
	),
 
	"van" => array(
		"name" =>  __("Van","premiumpress"), 
		"icon" => "fa fa-shuttle-van"
	),
 
	"caravan" => array(
		"name" =>  __("Caravan","premiumpress"), 
		"icon" => "fa fa-caravan"
	),
	
	"bus" => array(
		"name" =>  __("Bus","premiumpress"), 
		"icon" => "fa fa-bus"
	),
	"motorcycle" => array(
		"name" => __("Motorcycle","premiumpress"), 
		"icon" => "fal fa-motorcycle"
	),
	
	"bicycle" => array(
		"name" => __("Bicycle","premiumpress"), 
		"icon" => "fa fa-bicycle"
	),
	
	"parts" => array(
		"name" =>  __("Car Parts","premiumpress"), 
		"icon" => "fa fa-car-battery"
	), 
	
);

?>

<div class="my-4 p-2 show-mobile text-600">
<h4><?php echo __("Select a vehicle type.","premiumpress"); ?> </h4>
</div>
 
<div class="my-4">
<div class="row" id="typebox">

<?php foreach($data as $k => $v){  ?>
        
<div class="col-4 col-md-4 col-xl-3">

	<div class="cardbox <?php if($type != $k){ echo "closed"; } ?>" data-key="<?php echo $k; ?>">
         
        <i class="<?php echo $v['icon']; ?>"></i>
         
        <div class="small data-type"><?php echo $v['name']; ?></div>
         
        
	</div>  

</div>
<?php } ?>

</div> 
</div> 

<input type="hidden"  name="custom[type]" class="form-control typeval" value="<?php echo $type; ?>" />
 

<hr class="hide-mobile" />
<div class="d-flex justify-content-between card-footer-nav ">
 

<button class="btn btn-primary btn-close hide-mobile" type="button"><?php echo __("Continue","premiumpress"); ?></button>


</div>

<script>
 
jQuery(document).ready(function(){ 

	var a = jQuery("#typebox .cardbox:not(.hasTrigger)");
	a.each(function (a) {
	
		jQuery(this).addClass('hasTrigger');		
		jQuery(this).on("click", function (e) {
		
			jQuery("#typebox .cardbox").addClass("closed"); 
			 
			jQuery('.typeval').val(jQuery(this).attr("data-key"));
			
			jQuery(this).removeClass("closed"); 
			
			jQuery(".data-type-wrap .cardbox").html(jQuery(this).html()).removeClass("closed");
			
			 
		});
	}); 

});
 

</script> 