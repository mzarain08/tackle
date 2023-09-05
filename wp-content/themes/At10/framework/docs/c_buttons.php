<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
<button type="button" data-ppt-btn class="btn-primary">Primary</button> 
<button type="button" data-ppt-btn class="btn-secondary">Secondary</button> 
<button type="button" data-ppt-btn class="btn-success">Success</button> 
<button type="button" data-ppt-btn class="btn-danger">Danger</button> 
<button type="button" data-ppt-btn class="btn-system">System</button>
<button type="button" data-ppt-btn class="btn-light">Light</button>
<button type="button" data-ppt-btn class="btn-dark">Dark</button>
<button type="button" data-ppt-btn class="btn-orange">Orange</button>
 
<?php
$buttons2 = ob_get_contents();
$buttons2 = preg_replace('~>\s+<~', '><',$buttons2); 

ob_end_clean();  

ob_start();
 ?>
<a href="#" data-ppt-btn class="btn-primary">Primary</a> 
<a href="#" data-ppt-btn class="btn-secondary">Secondary</a> 
<a href="#" data-ppt-btn class="btn-success">Success</a> 
<a href="#" data-ppt-btn class="btn-danger">Danger</a> 
<a href="#" data-ppt-btn class="btn-system">System</a>
<a href="#" data-ppt-btn class="btn-light">Light</a>
<a href="#" data-ppt-btn class="btn-dark">Dark</a>
<a href="#" data-ppt-btn class="btn-orange">Orange</a>

<?php

$buttons = preg_replace('~>\s+<~', '><',ob_get_contents()); 

ob_end_clean();  
$menu[] = array(

	"name" => "Default",
	"desc" => "",
	"data" => $buttons2."<hr>".$buttons,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<?php echo str_replace('class="btn','class="btn-xs btn',$buttons); ?>

  
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Extra Small",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<div ppt-flex-between>


<div class="w-100">

<?php echo str_replace('class="btn','class="btn-block btn-lg list btn',$buttons); ?>

</div>
<div class="mx-3"></div>
<div class="w-100">

<?php echo str_replace('class="btn','class="btn-block btn-lg list btn',$buttons2); ?>


</div>

</div>
  
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "List",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<button type="button" class="btn-system small" data-ppt-btn>Extra Small</button>

<button type="button" class="btn-system " data-ppt-btn>Normal</button>

<button type="button" class="btn-system btn-lg" data-ppt-btn>Large</button>

<button type="button" class="btn-system btn-xl" data-ppt-btn>Extra Large</button>
   
<hr />

<button type="button" class="btn-system btn-sm rounded-pill" data-ppt-btn>Extra Small</button>

<button type="button" class="btn-system rounded-pill" data-ppt-btn>Normal</button>

<button type="button" class="btn-system btn-lg rounded-pill" data-ppt-btn>Large</button>

<button type="button" class="btn-system btn-xl rounded-pill" data-ppt-btn>Extra Large</button>
  
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Sizes",
	"desc" => "",
	"data" => $output,
);

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();


echo str_replace('class="btn-','class="rounded btn-', $buttons);

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Rounded",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();


echo str_replace('class="btn-','class="rounded-pill btn-', $buttons);

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Rounded Pils",
	"desc" => "",
	"data" => $output,
);

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

echo str_replace('class="btn-','class="shadow btn-', $buttons);

echo "<hr>";

echo str_replace('class="btn-','class="shadow-sm btn-', $buttons);

echo "<hr>";


echo str_replace('class="btn-','class="shadow-lg btn-', $buttons);
 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Shadow",
	"desc" => "",
	"data" => $output,
);
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
<a href="#" data-ppt-btn class="btn-primary"><i class="fa fa-cog"></i><span>Primary</span></a> 
<a href="#" data-ppt-btn class="btn-secondary"><i class="fa fa-cog"></i><span>Secondary</span></a> 
<a href="#" data-ppt-btn class="btn-success"><i class="fa fa-cog"></i><span>Success</span></a> 
<a href="#" data-ppt-btn class="btn-danger"><i class="fa fa-cog"></i><span>Danger</span></a> 
<a href="#" data-ppt-btn class="btn-system"><i class="fa fa-cog"></i><span>System</span></a>
<a href="#" data-ppt-btn class="btn-light"><i class="fa fa-cog"></i><span>Light</span></a>
<a href="#" data-ppt-btn class="btn-dark"><i class="fa fa-cog"></i><span>Dark</span></a>
<a href="#" data-ppt-btn class="btn-orange"><i class="fa fa-cog"></i><span>Orange</span></a>
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Icons (Basic)",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 

<a href="javascript:void(0)" data-ppt-btn class="btn-sm btn-primary btn-icon icon-before"><i class="fa fa-cog"></i> <span ppt-flex-middle>small</span></a>
     
<a href="javascript:void(0)" data-ppt-btn class="btn-primary btn-icon icon-before"><i class="fa fa-cog"></i> <span ppt-flex-middle>default</span></a>

<a href="javascript:void(0)" data-ppt-btn class="btn-lg btn-primary btn-icon icon-before"><i class="fa fa-cog"></i> <span ppt-flex-middle>large</span></a>
        

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Icons (Fixed Left)",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
 
 <a href="javascript:void(0)" data-ppt-btn class="btn-sm btn-primary btn-icon icon-after">
 
 <span>small</span> 
 
 <span class="icon-svg" data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['cart']; ?></span>
 
  </a>
     
 
 <a href="javascript:void(0)" data-ppt-btn class="btn-primary btn-icon icon-after">
 
 <span>small</span> 
 
 <span class="icon-svg"><?php echo $CORE_UI->icons_svg['cart']; ?></span>
 
  </a>

 
 <a href="javascript:void(0)" data-ppt-btn class="btn-lg btn-primary btn-icon icon-after">
 
 <span>small</span> 
 
 <span class="icon-svg"><?php echo $CORE_UI->icons_svg['cart']; ?></span>

</a> 

<hr />


<a href="javascript:void(0)" data-ppt-btn class="btn-sm btn-primary btn-icon icon-before">
 
 
 <span class="icon-svg" data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['cart']; ?></span>
 
 <span>small</span> 
 
</a>
     
 
<a href="javascript:void(0)" data-ppt-btn class="btn-primary btn-icon icon-before">
 
 
 <span class="icon-svg"><?php echo $CORE_UI->icons_svg['cart']; ?></span>

 <span>small</span> 
 
</a>

 
<a href="javascript:void(0)" data-ppt-btn class="btn-lg btn-primary btn-icon icon-before">
 
 
 <span class="icon-svg"><?php echo $CORE_UI->icons_svg['cart']; ?></span>

 <span>small</span> 

</a> 
 

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "SVG Icons",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
 
 <a href="javascript:void(0)" data-ppt-btn class="btn-sm btn-primary btn-icon icon-after"><span>small</span> <i class="fa fa-cog"></i>  </a>
     
<a href="javascript:void(0)" data-ppt-btn class="btn-primary btn-icon icon-after"><span>default</span> <i class="fa fa-cog"></i> </a>

<a href="javascript:void(0)" data-ppt-btn class="btn-lg btn-primary btn-icon icon-after"><span   ppt-flex-between><span>large</span> <i class="fa fa-cog"></i></span></a>
   

 

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Icons (Fixed Right)",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
<a href="javascript:void(0)" data-ppt-btn class="btn-sm btn-secondary btn-icon icon-before"> <i class="fa fa-user-circle"></i> <span> Member Login</span> </a> 

<a href="javascript:void(0)" data-ppt-btn class=" btn-sm btn-primary btn-icon icon-after"> <span>Search Website</span> <i class="fas fa-long-arrow-alt-right"></i> </a>

<hr />
<a href="javascript:void(0)" data-ppt-btn class="btn btn-secondary btn-icon icon-before"> <i class="fa fa-user-circle"></i> <span> Member Login</span> </a> 

<a href="javascript:void(0)" data-ppt-btn class=" btn btn-primary btn-icon icon-after"> <span>Search Website</span> <i class="fas fa-long-arrow-alt-right"></i> </a>

<hr />
<a href="javascript:void(0)" data-ppt-btn class="btn-lg btn-secondary btn-icon icon-before"> <i class="fa fa-user-circle"></i> <span> Member Login</span> </a> 

<a href="javascript:void(0)" data-ppt-btn class=" btn-lg btn-primary btn-icon icon-after"> <span>Search Website</span> <i class="fas fa-long-arrow-alt-right"></i> </a>

<hr />
<a href="javascript:void(0)" data-ppt-btn class="btn-xl btn-secondary btn-icon icon-before"> <i class="fa fa-user-circle"></i> <span> Member Login</span> </a> 

<a href="javascript:void(0)" data-ppt-btn class=" btn-xl btn-primary btn-icon icon-after"> <span>Search Website</span> <i class="fas fa-long-arrow-alt-right"></i> </a>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Stacked",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
<a href="javascript:void(0)" data-ppt-btn class="btn-primary mr-4 btn-num"> <span class="num bg-secondary text-light">12</span> <span> Member Login</span> </a> 

<a href="javascript:void(0)" data-ppt-btn class="btn-system btn-num"> <span class="num btn-primary text-light">12</span> <span> Member Login</span> </a> 
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Numbers",
	"desc" => "",
	"data" => $output,
);

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>