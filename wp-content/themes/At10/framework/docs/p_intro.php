<?php

global $CORE, $CORE_UI, $userdata, $wp_scripts, $wp_version ;

$GLOBALS['flag-docs'] = 1; 
 
 
?>
<div class="row mb-4">
<?php
// LIST RIGHT
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
ob_start();
echo '<div class="p-4" ppt-border1>';
_ppt_template( 'framework/design/widgets/icon64_text' ); 
echo '</div>';
$output = ob_get_contents();
ob_end_clean();
?>

<div class="col-md-4">
<?php echo ppt_theme_block_output($output, array("title" => THEME_NAME, "subtitle" => "version ".THEME_VERSION, "icon" => "svg-chart", "link" => ""),array("widget")); ?>
</div>

<div class="col-md-4">
<?php echo ppt_theme_block_output($output, array("title" => "WordPress","subtitle" => "version ".$wp_version , "icon" => "svg-wordpress", "link" => ""),array("widget")); ?>
</div>

<div class="col-md-4">
<?php echo ppt_theme_block_output($output, array("title" => "Updated","subtitle" => THEME_VERSION_DATE, "icon" => "svg-clock", "link" => ""),array("widget")); ?>
</div> 
 
</div>

<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>





<hr  class="my-5"/>

<div class="row">

    <div class="col-md-6">
    
    <h2 class="h3 my-4">Overview</h2>
   
    <div ppt-border1 class="p-4">
    
    <p>All the information regarding file structure, build tools, components, credits etc can be found here.</p>
    
    <p>If you have any questions that are beyond the scope of this help documentation, please feel free to contact us with the links below and please don't forget to provide your website URL.</p>
    
    <a href="https://www.premiumpress.com/contactform/" class="btn-primary" data-ppt-btn>Contact Us</a>
    
    
    </div>
    
    
    </div>
    
    <div class="col-md-6">
    
    <h2 class="h3 my-4">Developer Notes</h2>
    
    <div ppt-border1 class="p-4">
    
    <p>This theme has been designed to be lightweight and SEO friendly.</p>
    
    <p>Todo so we have removed all non-essential components from the core framework.</p>
    
    <div class="text-700">Basic Comparison</div>

    <hr />
     
    <div class="row">
    
        <div class="col-md-8" ppt-flex-center>
      
      Boostrap 4/5 CSS Framework
      
        </div>
        
        <div class="col-md-2">
        <div class="small opacity-5">Full</div>
       200kb
        
        </div>
        
        <div class="col-md-2">
        <div class="small opacity-5">Grid Only</div>
       50kb
        
        </div>
    
    </div>  
    <hr />
    
     <p>By removing all the uncessary styles found in Boostrap full, we've reduced load size by 150kb.</p>

    
    
       
    </div>
    
   
    
    
    </div>

</div>


 