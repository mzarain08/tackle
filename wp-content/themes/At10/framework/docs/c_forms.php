<?php

global $CORE, $CORE_UI, $userdata;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<form class="form1"> 

<div class="form-group position-relative">
    <input type="text" class="form-control" placeholder="Email" name="email"  data-type="email" value="" data-required="1" autocomplete="current-password">
    <i class="fal fa-envelope"></i>
  </div>
  
<div class="form-group position-relative">
    <input type="password" placeholder="Password" class="form-control" name="password" value="" data-required="1" autocomplete="current-password">
   
    <i class="fal fa-lock"></i> 
    
    <i class="fa fa-eye" onclick="TogglePass('user_pass');"></i>
  </div>
  
  <!-- Text input -->
<div class="mb-4">
  <label for="text-input" class="form-label">Text</label>
  <input class="form-control required-active" data-required="1" type="text" name="text">
</div>
 
<!-- Textarea -->
<div class="mb-4">
  <label for="textarea-input" class="form-label">Textarea</label>
  <textarea class="form-control" id="textarea-input" name="textarea" data-required="1" rows="5">Hello World!</textarea>
</div>

<!-- Select -->
<div class="mb-4">
  <label>Select</label>
  <select class="form-control" name="select" data-required="1">
    <option value="">Choose option...</option>
    <option>Option item 1</option>
    <option>Option item 2</option>
    <option>Option item 3</option>
  </select>
</div>

<label class="checkbox custom-control custom-checkbox">
<input type="checkbox" class="form-control custom-control-input" data-toggle="checkbox" name="checkbox" value="1">
<span class="custom-control-label"></span>Unchecked Checkbox
</label>

<label class="checkbox custom-control custom-checkbox">
<input type="checkbox" class="form-control custom-control-input" data-toggle="checkbox" name="checkbox" value="1" checked="checked">
<span class="custom-control-label"></span>Checkbox
</label>


<label class="mt-4">Search SVG icon</label>
 
<div class="input-group mb-4">
            <input type="text" class="form-control rounded pl-4 typeahead"  name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
        
          <button class="iconbit icon-svg shadow-0" type="submit" data-ppt-btn><div ppt-icon-24><?php echo $CORE_UI->icons_svg['search']; ?></div></button>

</div>

<label>Search font icon</label>
 
<div class="input-group">
            <input type="text" class="form-control rounded pl-4 typeahead" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
        
         <i class="fa fa-search iconbit"></i>

</div>

<button class="btn-primary mt-4" data-ppt-btn type="button" onclick="ppt_form_validation('.form1');">Validate Me</button>

</form>


<?php

$output = ob_get_contents();
$formExample = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 

?>

<script>



</script>

<div class="row mb-5">
 
    <div class="col-md-6">  
    
    <h3 class="mb-3">Style 1</h3>    
     
    <div class="ppt-forms p-4" ppt-border1>	
	  
	<?php echo $formExample; ?></div>
    </div>
    
    
   <div class="col-md-6">   
         <h3 class="mb-3">Dark Style</h3> 
    <div class="ppt-forms dark p-4" ppt-border1>	
 
	<?php echo $formExample; ?></div>
    </div>
    
</div>


<div class="row mb-5">

    <div class="col-md-6">   
     <h3 class="mb-3">Style 2</h3> 
    <div class="ppt-forms style2 p-4" ppt-border1>
   
	<?php echo $formExample; ?></div>    
    </div>
    
 

    <div class="col-md-6">   
    
         <h3 class="mb-3">Style 3</h3>  
    <div class="ppt-forms style3 p-4" ppt-border1>
 
	<?php echo $formExample; ?></div>    
    </div>
     </div>
   

</div>




<?php 
$menu = array();
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
?>

<!-- Text input -->
<div class="mb-4">
  <label for="text-input" class="form-label">Text</label>
  <input class="form-control" type="text" id="text-input" value="Artisanal kale">
</div>

<!-- Search input -->
<div class="mb-4">
  <label for="search-input" class="form-label">Search</label>
  <input class="form-control" type="search" id="search-input" value="How do I shoot web">
</div>

<!-- Email input -->
<div class="mb-4">
  <label for="email-input" class="form-label">Email</label>
  <input class="form-control" type="email" id="email-input" value="email@example.com">
</div>

<!-- URL Input -->
<div class="mb-4">
  <label for="url-input" class="form-label">URL</label>
  <input class="form-control" type="url" id="url-input" value="https://getbootstrap.com">
</div>

<!-- Phone Input -->
<div class="mb-4">
  <label for="tel-input" class="form-label">Phone</label>
  <input class="form-control" type="tel" id="tel-input" value="1-(770)-334-2518">
</div>

<!-- Password Input -->
<div class="mb-4">
  <label for="pass-input" class="form-label">Password</label>
  <input class="form-control" type="password" id="pass-input" value="mypasswordexample">
</div>

<!-- Textarea -->
<div class="mb-4">
  <label for="textarea-input" class="form-label">Textarea</label>
  <textarea class="form-control" id="textarea-input" rows="5">Hello World!</textarea>
</div>

<!-- Select -->
<div class="mb-4">
  <label for="select-input" class="form-label">Select</label>
  <select class="form-select" id="select-input">
    <option>Choose option...</option>
    <option>Option item 1</option>
    <option>Option item 2</option>
    <option>Option item 3</option>
  </select>
</div>

<!-- Multiselect -->
<div class="mb-4">
  <label for="multiselect-input" class="form-label">Multiselect</label>
  <select class="form-select" id="multiselect-input" size="3" multiple>
    <option>Option item 1</option>
    <option>Option item 2</option>
    <option>Option item 3</option>
    <option>Option item 4</option>
    <option>Option item 5</option>
    <option>Option item 6</option>
  </select>
</div>

<!-- File input -->
<div class="mb-4">
  <label for="file-input" class="form-label">File</label>
  <input class="form-control" type="file" id="file-input">
</div>

<!-- Number input -->
<div class="mb-4">
  <label for="number-input" class="form-label">Number</label>
  <input class="form-control" type="number" id="number-input" value="37">
</div>

<!-- Datalist -->
<div class="mb-4">
  <label for="datalist-input" class="form-label">Datalist</label>
  <input class="form-control" list="datalist-options" id="datalist-input" placeholder="Type to search...">
  <datalist id="datalist-options">
    <option value="San Francisco">
    <option value="New York">
    <option value="Seattle">
    <option value="Los Angeles">
    <option value="Chicago">
  </datalist>
</div>

<!-- Range input -->
<div class="mb-4">
  <label for="range-input" class="form-label">Range</label>
  <input class="form-control" type="range" id="range-input">
</div>

<!-- Color input -->
<div class="mb-4">
  <label for="color-input" class="form-label">Color</label>
  <input class="form-control form-control-color" type="color" id="color-input" value="#d946ef">
</div>
<?php 

$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Common Form Elements",
	"desc" => "",
	"data" => $output,
);
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);

?>