<?php

global $CORE, $CORE_UI, $userdata;

?>

<script>

function ModalSize(v){

jQuery(".ppt-modal-wrap .ppt-modal-item").removeClass('ppt-animate-fadein ppt-animate-bouncein ppt-animate-bounceout ');

jQuery(".ppt-modal-wrap").removeClass("w-500 w-700 w-900 ppt-cookie-notice modal-bottom");
jQuery(".ppt-modal-wrap").addClass(v).show();
jQuery('#ppt-modal-ajax-form').html(jQuery("#modalcontent").html());
jQuery(".ppt-modal-wrap .card-footer").show();


}
function ModalAnimate(v){

jQuery(".ppt-modal-wrap").removeClass("w-500 w-700 w-900 ppt-cookie-notice modal-bottom");
jQuery(".ppt-modal-wrap").addClass("w-500");



jQuery(".ppt-modal-wrap .ppt-modal-item").removeClass('ppt-animate-fadein ppt-animate-bouncein ppt-animate-bounceout');
jQuery(".ppt-modal-wrap .ppt-modal-item").addClass(v);

jQuery(".ppt-modal-wrap").show();

jQuery('#ppt-modal-ajax-form').html(jQuery("#modalcontent").html());
jQuery(".ppt-modal-wrap .card-footer").show();


}
 
function testthisalert(){

var name = jQuery("#test-alert").val();
var p = jQuery("#test-pos").val();
var ani = jQuery("#test-ani").val();

var content = jQuery("#test-alert-"+name).html();
 

pptModal(name, content, "modal-"+p, ani, 1);
 

}

 

</script>
 
<h2>The Modal</h2>
<p>There is only 1 modal which uses the class <mark>ppt-modal</mark>. this modal changes behavour based on user actions.</p>

 
<div class="p-4 mb-5 mt-2" ppt-border1>


<h4>Modal Sizes</h4>

<div class="row">

	<div class="col-md-2"><button type="button" onclick="ModalSize('w-500')" class="btn btn-system mt-4">500px</button> </div>
	<div class="col-md-2"><button type="button" onclick="ModalSize('w-700')" class="btn btn-system mt-4">700px</button> </div>
	<div class="col-md-2"><button type="button" onclick="ModalSize('w-900')" class="btn btn-system mt-4">900px</button> </div> 
	<div class="col-md-4"><button type="button" onclick="ModalSize('modal-bottom')" class="btn btn-system mt-4">Bottom</button> </div> 
	<div class="col-md-2"><div class="bg-danger text-white" id="modalcontent"><div class="py-5 text-center">modal content here</div></div></div>

</div>

<h4>Modal Transitions</h4>

<div class="row">

	<div class="col-md-9">
     
	<button type="button" onclick="ModalAnimate('ppt-animate-bouncein')" class="btn btn-system mt-4">Bounce In</button> 
    <button type="button" onclick="ModalAnimate('ppt-animate-fadein')" class="btn btn-system mt-4">Fade In</button> 
    <button type="button" onclick="ModalAnimate('ppt-animate-fadeup')" class="btn btn-system mt-4">Fade up</button> 
     
     
     </div> 
	
   
</div>

<hr />

<h4> Test Alert</h4>

<div class="d-flex" style="max-width:500px;">
<select class="form-control" id="test-alert">

<option value="error">Error Alert</option>
<option value="success">Success Alert</option>

<option value="user">User Alert</option>
<option value="cookie">Cookie Alert</option>

<option value="notify">Notify Alert</option>
<option value="message">New Message</option>
<option value="popup">Custom Popup</option>



</select>

<select class="form-control mx-2" id="test-ani">

<option value="">Default</option>
<option value="ppt-animate-bouncein">Bounce</option>
<option value="ppt-animate-fadein">Fade in</option>
<option value="ppt-animate-fadeup">Fade up</option>
   
 
</select>

<select class="form-control mx-2" id="test-pos">
<option value="">Centered</option>
<option value="top">Top</option>
<option value="top-right">top Right</option>
<option value="bottom">Bottom</option>
<option value="bottom-right">Bottom Right</option>

 
</select>

<div><button data-ppt-btn class="btn-primary" onclick="testthisalert();">Try</button></div>

</div>
</div> 

 

<h2>Alerts</h2>
<p>Alerts are triggered via Ajax on user events such as new messages etc.</p>



<h4>Error Alert</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-error">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-error' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>

<hr />

<h4>Success Alert</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-success">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-success' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>





<hr />

<h4>New Message Alert</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-message">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-message' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>

<hr />

<h4>Notify Alert</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-notify">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-notify' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>



<hr />

<h4>Custom Popup</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-popup">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-popup' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>

<hr />

<h4>Admin Save Notice</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-cookie">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-admin' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>

<hr />

<h4>Cookie Popup</h4>
<div class="bg-dark" style="min-height:600px;" ppt-flex-middle>
<div class="bg-white rounded overflow-hidden" style="max-width:500px;" id="test-alert-cookie">
<?php

ob_start();
_ppt_template( 'framework/design/widgets/alert-cookie' ); 
$output = ob_get_contents();
ob_end_clean();
 
echo ppt_theme_block_output($output, array(

/*
"title" => "Testing 123",
"desc" => "Testing 345",

"btn_txt" => "Button 1",
"btn2_txt" => "Button 2",

"btn_link" => "google.com",
"btn2_link" => "yahoo.com",
"icon" => "svg-users",
*/
 
)
,array("widget"));

?> 
</div>
</div>

 
 
<?php

$modals = array(

	"processCookie" => array(	
		"name" => "processCookie",
		"action" => "processCookie",
	),
	
	"processLogin" => array(	
		"name" => "processLogin",
		"action" => "processLogin",
	),
	
	"processRegister" => array(	
		"name" => "processRegister",
		"action" => "processRegister",
	),
	
	"processVideoOpen" => array(	
		"name" => "processVideoOpen",
		"action" => "processVideoOpen",
	),
	
	
	"processNotificatons" => array(	
		"name" => "processNotificatons",
		"action" => "processNotificatons",
	),
	
	"processFeatured" => array(	
		"name" => "processFeatured",
		"action" => "processFeatured",
	),
	
	
	"processSponsored" => array(	
		"name" => "processSponsored",
		"action" => "processSponsored",
	),

	"processHomepage" => array(	
		"name" => "processHomepage",
		"action" => "processHomepage",
	),
	
	"processListingUpgrade" => array(	
		"name" => "processListingUpgrade",
		"action" => "processListingUpgrade",
	),	
	
	"processUpgrade" => array(	
		"name" => "processUpgrade",
		"action" => "processUpgrade",
	),	

	"processLanguages" => array(	
		"name" => "processLanguages",
		"action" => "processLanguages",
	),	
	
	"processPayment" => array(	
		"name" => "processPayment",
		"action" => "processPayment",
	),	
	
	"processNewPayment" => array(	
		"name" => "processNewPayment",
		"action" => "processNewPayment",
	),	
	
	"processCredit" => array(	
		"name" => "processCredit",
		"action" => "processCredit",
	),	
	
	"processMessageSingle" => array(	
		"name" => "processMessageSingle",
		"action" => "processMessageSingle",
	),	
	
	"processMessage" => array(	
		"name" => "processMessage",
		"action" => "processMessage",
	),	
	
	"processFilterbox" => array(	
		"name" => "processFilterbox",
		"action" => "processFilterbox",
	),	

	"processBoost" => array(	
		"name" => "processBoost",
		"action" => "processBoost",
	),
	
	"processStats" => array(	
		"name" => "processStats",
		"action" => "processStats",
		"value" => "1",
	),	
	 
	
	
);

 

?>

<hr class="my-5" />

<div class="row">
<?php foreach($modals as $m){ ?>

<div class="col-md-4">

<a href="#" onclick="<?php echo $m['action']; ?>(<?php if(isset($m['value'])){ echo $m['value']; } ?>)"><?php echo $m['name']; ?></a>

</div>
<?php } ?>
</div>