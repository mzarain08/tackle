<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<span class="badge bg-primary">Primary</span>
<span class="badge bg-secondary">Secondary</span>
<span class="badge bg-success">Success</span>
<span class="badge bg-danger">Danger</span>
<span class="badge bg-warning text-dark">Warning</span>
<span class="badge bg-info text-dark">Info</span>
<span class="badge bg-light text-dark">Light</span>
<span class="badge bg-dark">Dark</span>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Stats",
	"desc" => "",
	"data" => $output,
);




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<div class="row">

<div class="col-md-6">

<?php 


$s =  $CORE->PACKAGE("get_status",  array() ); 

foreach($s  as $status){

echo  '<div class="btn-block mb-4">

<span class="inline-flex items-center font-weight-bold order-status-icon '.$status['css'].' mr-2"> <span class="dot mr-2"></span> <span class="pr-2px leading-relaxed whitespace-no-wrap">'.$status['name'].'</span> </span>


</div>';

}


?> 

</div>
<div class="col-md-6">
<div class="ppt-badges">
<?php 


$s =  $CORE->PACKAGE("get_status",  array() ); 

foreach($s  as $status){
?>

<div class="_badge" style="color:#FBFBFB;background-color:#2BA346;">   <?php echo $status['name']; ?>  </div>
 

<?php

 

}


?> 
</div>
</div>

</div> 


<div class="ppt-badges">
            
<div class="_badge" style="color:#000000;background-color:#FFC300;"> 
    
    
        
<div class="badge_tooltip text-center" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-star" style="color:#000000"></i> Gold    </div>
    <div class="badge_tooltip__item">Gold User Listing </div>
  </div>
  
  
</div>
           


 
  </div>

 
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Alternative style",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>