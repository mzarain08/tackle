<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();

$font_awesome_icons =  $CORE_UI->ICONS("list",array());


/*
?>
 
<ul class="row row-cols-2 row-cols-md-4 row-cols-lg-5 text-center">

<?php foreach($CORE_UI->icons_svg as $k => $v){ ?>
 
<li class="col mb-4">
<div class="h-100 rounded shadow-sm" ppt-box>
                  <div class="_content py-3" >
                     
                     <div class="my-3"> <span ppt-icon-32 data-ppt-icon-size="32"><?php echo $v; ?></span> </div>
                     
                     <div class="small text-truncate"><?php echo $k; ?></div>
                  
                  </div>
                  <div class="_footer"><a class="stretched-link link-body btn-copy-icon" data-clipboard-text="<i class=&quot;uil uil-chat&quot;></i>">Copy</a></div>
                </div>
   
  
</div>
</li>
<?php } ?>

</ul>

*/ ?>




 
<?php


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 ob_start();
?>
<div class="row">
<?php foreach($CORE_UI->icons_svg as $k => $v){ ?>
<div class="col-md-1 text-center">
<div class="p-3">
    <?php echo $v; ?> 
    
    <label class="small text-truncate"><?php echo $k; ?></label>
	</div>
</div>
<?php } ?> 
</div>
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

<div class="row">
<div class="col-md-6">
<div ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg['toggle_on']; ?></div>
<div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['toggle_on']; ?></div>
<div ppt-icon-32 data-ppt-icon-size="32"><?php echo $CORE_UI->icons_svg['toggle_on']; ?></div>
<div ppt-icon-64 data-ppt-icon-size="64"><?php echo $CORE_UI->icons_svg['toggle_on']; ?></div>

</div>
<div class="col-md-6">

<pre class="basic">/*-------- css -----*/
ppt-icon-16
ppt-icon-24
ppt-icon-32
ppt-icon-64

</pre>

</div>
</div>  

<?php
 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "SVG Sizes",
	"desc" => "",
	"data" => $output,
);

 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();

?>
<div class="row">
<?php foreach($CORE_UI->icons_emoji as $k => $v){ ?>
<div class="col-md-1 text-center"> 
    <label><?php echo $k; ?></label>
   
    <span  ppt-icon-64><?php echo $v; ?> </span>
</div>
<?php } ?>
</div>
 
<?php
 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Emoji Icons",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);


?>


<div ppt-border1 class="p-4">
<?php foreach($font_awesome_icons as $title => $icons){ ?>
        
        
        <div class="block-header mt-4">
            <h3 class="block-header__title"><?php echo ucfirst($title); ?></h3>
            <div class="block-header__divider"></div> 
       </div>
       
       
		<div class="btn-block clearfix">
<?php foreach($icons as $ficon){ 
		
		$ficon = str_replace("far","fa",$ficon);
		if($ficon == ""){ continue; }
		
		?>
        <div data-filter-item data-filter-name="<?php echo $ficon; ?>" style="float:left; padding:5px; width:50px; height:50px;  font-size: 25px; background:#fff; border:1px solid #ddd; margin-right:10px; margin-bottom:10px; cursor:pointer; padding-left:10px; padding-right:10px;" onclick="processIconSelect('fa fa-<?php echo $ficon; ?>');"> <span class="fa fa-<?php echo $ficon; ?>"></span> </div>
        <?php } ?>
        </div>
        <?php } ?>
        
        <div class="clearfix"></div>
 		</div>
</div>
</div>