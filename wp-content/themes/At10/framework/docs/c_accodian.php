<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
ob_start();
 ?>
 
 





<div ppt-box class="rounded">

    <div class="_header " ppt-flex-row>
        <div class="_title w-100">This is my header</div>
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['heart']; ?></div>
        </div> 
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>  
    </div>
    
    <div class="_content py-5 ">
    
    
Content here
    
    
    </div> 
    
 
<div class="ppt-accordion" style="cursor:pointer;"> 
 
<div class="d-flex flex-row border-top p-3 ppt-gradiant">
  <div class="w-100" ppt-flex-between>
    <div>
      <div class="fs-5 text-600 btn-show">
       FAQ
      </div>
  
    </div>
    <div ppt-icon-32 class="btn-show hide-show">
      <?php echo $CORE_UI->icons_svg['add']; ?>
    </div>
    
     <div ppt-icon-32 class="btn-show show-hide">
      <?php echo $CORE_UI->icons_svg['close']; ?>
    </div>
  </div>
</div>

<div class="hide border-top p-3" >

hidden content 1

</div> 

</div>
 


 

 
    
    
    
    <div class="_footer small" ppt-flex-row>
    
   <div>
   
   <span class="badge badge-light">tag 1</span> <span class="badge badge-light">tag 2</span> <span class="badge badge-light">tag 3</span>
   
   </div>
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>


 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Show/Hide",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
	$current_data = array(
	
		"name" => array(
			0 => "This is an example seller FAQ question.",
			1 => "This is another FAQ added by the seller.",
			2 => "This is another FAQ added by the seller.",
			3 => "This is another FAQ added by the seller.",
		),
		"value" => array(
			0 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			1 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			2 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
			3 => "Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.",
		),
		
	);
 
ob_start();
 ?>
<?php $i=0; $shown = 0; foreach($current_data['name'] as $data){ if($current_data['name'][$i] !=""){ $shown++; ?>
 
<div class="card ppt-show-hide mb-3" style="cursor:pointer;">
<div class="card-body p-3 text-600">
 
	<i class="fa fa-question-circle mr-2 text-primary hide-mobile"></i>  <?php echo stripslashes($current_data['name'][$i]); ?>
 
 
	<?php if(strlen($current_data['value'][$i]) > 0){ ?>
    <div class="hide pt-3" style="display:none"><?php echo stripslashes($current_data['value'][$i]); ?> </div>
    <?php } ?>

</div> 
</div> 
 
  <?php } $i++; } ?>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Show/Hide",
	"desc" => "",
	"data" => $output,
);
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>