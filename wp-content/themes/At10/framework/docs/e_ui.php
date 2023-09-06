<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();


  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div ppt-flex-between>
 
 
<div ppt-box class="p-5">Empty Box</div> 

<div ppt-box>
    <div class="_header">
        <div class="_title">This is my header</div>
    </div>
    <div class="_content py-5">Box Content</div> 
</div>
 

<div ppt-box>
    <div class="_header">
    	<div class="_title">This is my header</div>
    </div>
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small">Box Footer</div>
</div>
 

 
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div ppt-flex-between>
 
 
<div ppt-box class="p-5 shadow">Shadow</div>
 
<div ppt-box class="p-5 shadow-sm">Shadow SM</div> 

<div ppt-box class="p-5 shadow-lg">Shadow LG</div>
 
<div ppt-box class="p-5 shadow-xl">Shadow XL</div> 
 
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Shadow",
	"desc" => "",
	"data" => $output,
);

  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div ppt-flex-between>
 
  

<div ppt-box>

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small">Box Footer</div>

</div>


<div ppt-box>

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div> 
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>  
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small" ppt-flex-row>
    
    Box Footer 
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>

<div ppt-box>

    <div class="_header shadow-sm" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['grab']; ?></div>
        </div> 
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>  
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small" ppt-flex-row>
    
    Box Footer 
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>




</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Icons",
	"desc" => "",
	"data" => $output,
);
 


ob_start();
_ppt_template( 'framework/design/widgets/list_box_empty' ); 
$empty_box = ob_get_contents();
ob_end_clean(); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div class="d-xl-flex justify-content-between">
 
<div ppt-box style="min-width:300px;">
 
    
    <div class="_content py-4 h-100" ppt-flex-middle> <?php echo $empty_box; ?></div>  

</div> 


<div ppt-box style="min-width:300px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-4"> <?php echo $empty_box; ?></div>  

</div> 
 
<div ppt-box style="min-width:300px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-4"> <?php echo $empty_box; ?></div>  
    
<div class="_footer small" ppt-flex-row="">
    
    Box Footer 
    
    <div ppt-icon-24="" data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></div>

</div> 

</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Empty Box",
	"desc" => "",
	"data" => $output,
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div ppt-flex-between>
 
  

<div ppt-box class="rounded">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small">Box Footer</div>

</div>


<div ppt-box class="rounded">

    <div class="_header" ppt-flex-row>
    
   <div class="_icon">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['chat']; ?></div>
        </div>  
    
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div> 
     
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small" ppt-flex-row>
    
    Box Footer 
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>

<div ppt-box class="rounded">

    <div class="_header shadow-sm" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['grab']; ?></div>
        </div> 
        <div class="_close bg-light">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>  
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer small" ppt-flex-row>
    
    Box Footer 
    
    <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div>
    
    </div>

</div>




</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Rounded",
	"desc" => "",
	"data" => $output,
);




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>
<div ppt-flex-between>
 
  

<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer py-1" ppt-flex-between>
    
    <div class="small"> 
    
    Text + <a href="">Random Link</a>
    
    
    </div>
    
    <div>
    
    <a href="" class="btn-primary btn-sm" data-ppt-btn>Button</a>
    <a href="" class="btn-system btn-sm" data-ppt-btn>Button</a>
    
    </div>
    
    </div>

</div>

<div ppt-box   style="min-width:350px;" class="text-center">

    <div class="_header" ppt-flex-row>
        <div class="_title w-100">This is my header</div> 
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer py-1 "> 
    
    <a href="" class="btn-primary" data-ppt-btn>Button</a>
     
    
    </div>

</div>


 
<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>
    
    <div class="_content py-5">Box Content</div> 
    <div class="_footer py-1" ppt-flex-between>
    
    
    <div>
    <a href="" class="btn-primary btn-sm" data-ppt-btn>Button</a>
    </div>
    <div>
    
    
    <a href="" class="btn-system btn-sm" data-ppt-btn>Button</a>
    
    </div>
    
    </div>

</div>



</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Buttons",
	"desc" => "",
	"data" => $output,
);
  
  
  
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

ob_start();
_ppt_template( 'framework/design/widgets/list_right1' ); 
$widget1 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'framework/design/widgets/list_right2' ); 
$widget2 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'framework/design/widgets/list_right3' ); 
$widget3 = ob_get_contents();
ob_end_clean(); 


ob_start();
_ppt_template( 'framework/design/widgets/list_box1' ); 
$widget_box1 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'framework/design/widgets/list_box2' ); 
$widget_box2 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'framework/design/widgets/list_row1' ); 
$widget_row1 = ob_get_contents();
ob_end_clean(); 

ob_start();
_ppt_template( 'framework/design/widgets/list_right4' ); 
$widget4 = ob_get_contents();
ob_end_clean(); 



 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

 ob_start();
?>
<div ppt-flex-between>



<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget 2</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget4; ?> 
    </div>      
</div>   
 
 
<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget_row1; ?> 
    </div>      
</div>     

<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget_box2; ?> 
    </div>      
</div>  



<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget_box1; ?> 
    </div>      
</div>  

</div>

<div ppt-flex-between class="mt-5">


<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget1; ?> 
    </div>      
</div> 

<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget2; ?> 
    </div>      
</div> 

<div ppt-box   style="min-width:350px;">
    <div class="_header" ppt-flex-row>
    <div class="_title">Widget</div>
    </div>    
    <div class="_content p-0">      
     <?php echo $widget3; ?> 
    </div>      
</div> 

</div>
 
</div>
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Widgets",
	"desc" => "",
	"data" => $output,
);  
 

 
 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

 ob_start();
?>
<div ppt-flex-between>
 
  
 
<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0">      
<?php 
echo ppt_theme_block_output($widget_box1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget"));
 echo ppt_theme_block_output($widget_box2, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget"));
 
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>   
  
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Inner box",
	"desc" => "",
	"data" => $output,
);  
 
 
 
 
 
 
ob_start();
?>
<div ppt-flex-between>
 
  
 
<div ppt-box   style="min-width:350px;">

    <div class="_header shadow-sm" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0 ppt-gradiant">      
<?php 
echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 2","subtitle" => "600", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 3","subtitle" => "700",  "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>  

 <div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0 bg-light">      
<?php 
echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 2","subtitle" => "600", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 3","subtitle" => "700",  "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>   
  
  
 
 <div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0"> 
<div class="ppt-gradiant border-bottom">  
<?php echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget")); ?>
</div>  
<div class="ppt-gradiant border-bottom">  
<?php echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget")); ?>
</div> 
<div class="ppt-gradiant border-bottom">  
<?php echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget")); ?>
</div>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>  

 


</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Backgrounds",
	"desc" => "",
	"data" => $output,
);  
 
 
 
 
 
 
 
 
 
 
 
 
ob_start();
?>
<div ppt-flex-between>
 
  
 
<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0">      
<?php 
echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "500",  "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 2","subtitle" => "600", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget1, array("title" => "testing 3","subtitle" => "700",  "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>   
  
  
 
<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0">      
<?php 
echo ppt_theme_block_output($widget2, array("title" => "testing 1","subtitle" => "testing 123", "icon" => "fa fa-heart", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget2, array("title" => "testing 2","subtitle" => "testing 123", "icon" => "svg-chat", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget2, array("title" => "testing 3","subtitle" => "testing 123", "icon" => "svg-heart", "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>  
  

<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0">      
<?php 
echo ppt_theme_block_output($widget3, array("title" => "testing 1","subtitle" => "testing 123", "icon" => "fa fa-heart", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget3, array("title" => "testing 2","subtitle" => "testing 123", "icon" => "svg-chat", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget3, array("title" => "testing 3","subtitle" => "testing 123", "icon" => "svg-heart", "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>

 
 

 


</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box + Widgets",
	"desc" => "",
	"data" => $output,
);  
 
 

 
ob_start();
?>
<div ppt-flex-between>
 
 

<div ppt-box   style="min-width:350px;">

    <div class="_header" ppt-flex-row>
        <div class="_title">This is my header</div>
        <div class="_close">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>    
    </div>    
    <div class="_content p-0">      
<?php 
echo ppt_theme_block_output($widget1, array("title" => "testing 1","subtitle" => "600", "icon" => "fa fa-heart", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget2, array("title" => "testing 2","subtitle" => "testing 123", "icon" => "svg-chat", "link" => "http://google.com"),array("widget"));
echo ppt_theme_block_output($widget3, array("title" => "testing 3","subtitle" => "testing 123", "icon" => "svg-heart", "link" => "http://google.com"),array("widget"));
?>    
</div>      
     <div class="_footer small" ppt-flex-row>    
    <div>Box Footer</div>     
    <a href=""><div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['arrow-long-right']; ?></div></a>
    
    </div> 

</div>

 
 

 


</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Mixed Widgets",
	"desc" => "",
	"data" => $output,
);  
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 
ob_start();
_ppt_template( 'framework/design/widgets/pop1' ); 
$box_header3 = ob_get_contents();
ob_end_clean(); 

ob_start();
?>
<div ppt-flex-between>
 


<div ppt-box style="min-width:350px;">

    <div class="_header text-center p-4 bg-primary">
        <div class="fs-5 text-white text-600">My header text</div>
    </div> 
    <div class="_content p-0 text-center py-5">  random content </div>
     
</div>


<div ppt-box style="min-width:350px;">
<div class="text-center bg-primary"><div class="fs-5 text-white text-600 p-3">  Header With Curve  </div></div>     
<div class="overflow-hidden text-white bg-primary" style="height:18px;"><?php echo $CORE_UI->borders['curve_bottom']; ?></div>
<div class="_content p-0 text-center py-5">  random content </div>     
</div>


<div ppt-box style="min-width:350px;">
<div class="text-center bg-primary"><div class="fs-5 text-white text-600 p-3">  Header Border Top  </div></div>     

<div class="bg-primary medium">
<?php echo $box_header3; ?>
</div>

<div class="overflow-hidden text-white bg-primary mt-n3" style="height:18px;"><?php echo $CORE_UI->borders['curve_top']; ?></div>
<div class="_content p-0 text-center py-5">  random content </div>     
</div>
 
 

 


</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Headers",
	"desc" => "",
	"data" => $output,
); 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 

ob_start();
?>
<div ppt-flex-between>
 


<div ppt-box style="min-width:350px;">

    <div class="_header text-center p-4 bg-primary">
        <div class="fs-5 text-white text-600 position-relative z-10">My header text</div>
        
       <div class="bg-image visible" data-bg="http://localhost/V10IMAGES/_demoimagesv10/backgroundimages/1.jpg"></div>
       <div class="bg-overlay-primary bg-primary"></div>
    </div> 
    <div class="_content p-0 text-center py-5">  random content </div>
     
</div>


 

<div ppt-box style="min-width:350px;">

    <div class="_header text-center p-4 bg-primary">
        <div class="fs-5 text-white text-600 position-relative z-10">My header text</div>
        
       <div class="bg-image visible" data-bg="http://localhost/V10IMAGES/_demoimagesv10/backgroundimages/1.jpg"></div>
       <div class="bg-overlay-primary bg-primary"></div>
    </div> 
    
    <div class="z-10">
    
    <div style="height:80px; width:80px;" class="bg-danger mx-auto mt-n4 rounded">&amp;</div>
    
    </div>
    
    <div class="_content p-0 text-center py-5">  random content </div>
     
</div>
 


</div> 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"name" => "Box Header Backgrounds",
	"desc" => "",
	"data" => $output,
); 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 






_docsSection($menu);

?>


<style>


</style>