<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>


<div class="row">
  
    <div class="col-md-4">
      <div class="p-3 mb-3 bg-primary text-white rounded-lg">Primary</div>
    </div>
    
    
  
    <div class="col-md-4">
      <div class="p-3 mb-3 bg-secondary text-white rounded-lg">Secondary</div>
    </div>
    
    <div class="col-md-4">
      <div class="p-3 mb-3 bg-soft text-primary text-600 rounded-lg">Soft</div>
    </div>

<div class="col-12">
<hr />
</div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-success text-white rounded-lg">Success</div>
    </div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-danger text-white rounded-lg">Danger</div>
    </div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-warning text-dark rounded-lg">Warning</div>
    </div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-info text-dark rounded-lg">Info</div>
    </div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-light text-dark rounded-lg">Light</div>
    </div>
  
    <div class="col-md-2">
      <div class="p-3 mb-3 bg-dark text-white rounded-lg">Dark</div>
    </div>
  
</div>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Colors",
	"desc" => "",
	"data" => $output,
);
 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
<span class="text-primary h4 mr-4">primary</span>
<span class="text-secondary h4 mr-4">secondary</span>
<span class="text-orange h4 mr-4">orange</span>
<span class="text-dark h4 mr-4">dark</span>
<span class="text-success h4 mr-4">text</span>
<span class="text-danger h4 mr-4">text</span>
 

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Text Colors",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<style>

.group-circle span { width:40px; height:40px; border-radius:100%; display: inline-block; border: 2px solid #fff; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%)!important; }
.group-circle span+span { margin-left:-10px; }
</style>
<div class="badge_tooltip text-center" data-direction="top"><div class="badge_tooltip__initiator"> 
   
<div class="group-circle">
<span class="bg-primary">&nbsp;</span>
<span class="bg-secondary">&nbsp;</span>
<span class="bg-orange">&nbsp;</span>
<span class="bg-dark">&nbsp;</span>
<span class="bg-success">&nbsp;</span>
<span class="bg-danger">&nbsp;</span>
</div>
  </div><div class="badge_tooltip__item"> Available Colors </div></div>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Color Circles",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
<span class="opacity-8 mr-4">Opacity 10%</span>
<span class="opacity-5 mr-4">Opacity 50%</span>
<span class="opacity-2">Opacity 20%</span>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Opacity",
	"desc" => "",
	"data" => $output,
);

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>
 
 
