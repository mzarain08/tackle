<?php

global $CORE, $CORE_UI;

/*
?>

 
<div style="position:absolute;right:0px;top:0px; background:#000;" class="p-2 text-white small text-center" onclick="_gridonly()">grid <br /> only</div>
<div style="position:absolute;right:0px;top:60px; background:#000;" class="p-2 text-white small text-center" onclick="_rtlgridonly()">rtl grid <br /> only</div>


<div class="p-3 border-top w-100" style="position:fixed;bottom:0px;">
 
<?php 

$stylesheets = $CORE_UI->LOAD("css"); 

foreach($stylesheets as $k => $v){ ?>

<div ppt-flex-between>

<div>
<?php echo $k; ?>  <a href="<?php echo $v; ?>" target="_blank">...</a> 

</div>

<div>

<div class="filterToggle toggle-style-<?php echo $k; ?>"> 
    <div class="d-flex toggle-me  <?php if(in_array($k,array("theme-grid-rtl","theme-grid","boostrap-css-rtl"))){ }else{?>on<?php } ?>" onclick="_docsToggleStyle('<?php echo $k; ?>');">
     
        <svg aria-hidden="true" data-icon="toggle-on" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-on">
        <path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zm0 320c-70.8 0-128-57.3-128-128 0-70.8 57.3-128 128-128 70.8 0 128 57.3 128 128 0 70.8-57.3 128-128 128z" class="text-success"></path>
        </svg>
        
        <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-off">
        <g class="fa-group"><path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zM192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class=""></path>
        <path fill="currentColor" d="M192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class="text-light"></path></g>
        </svg>
     
    </div>
</div>

</div>

</div>

<?php } ?>
 

</div>
<script>
function _gridonly(){

_docsToggleStyle('theme-grid'); 
_docsToggleStyle('boostrap-css');
_docsToggleStyle('theme-fonts');
_docsToggleStyle('theme-maps');
_docsToggleStyle('premiumpress-chat');

}
function _rtlgridonly(){

_docsToggleStyle('theme-grid-rtl'); 
_docsToggleStyle('boostrap-css');
_docsToggleStyle('theme-fonts');
_docsToggleStyle('theme-maps');
_docsToggleStyle('premiumpress-chat');

}

 
</script>
*/ ?>