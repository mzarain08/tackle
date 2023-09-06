<?php

// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

?>
<style>

/*
-------------------------------------
*/
html.wp-toolbar {    padding-top: 0px; }
#wpadminbar, #adminmenuback, #adminmenuwrap { display:none; }
#wpcontent, #wpfooter {    margin-left: 0px;}
#wpcontent {    padding-left: 0px!important;}
.folded #wpcontent, .folded #wpfooter { margin-left:0px!important; }
#wpwrap {    height: 100%; }
#wpbody-content {
    padding-bottom: 0;
    float: none;
    width: 100%;
    overflow: visible;
    display: block;
    height: 100%;
	min-height:100%;
}
.folded #wpcontent, .folded #wpfooter
#wpbody {    position: relative;    height: 100%;}
@media screen and (max-width: 782px){
	.auto-fold #wpcontent {
		position: relative;
		margin-left: 0;
		padding-left: 10px;
	}
} 
@media only screen and (max-width: 960px){
	.auto-fold #wpcontent, .auto-fold #wpfooter {
		margin-left: 0px!important;
	}
}
.wp-die-message {
    font-size: 16px!important;
    line-height: 1.5;
    margin: 1em 0;
}
</style>
<?php
if( current_user_can('administrator')  ){}


$GLOBALS['flag-docs'] = 1;
$GLOBALS['flag-testing'] = 1;
 
global  $userdata, $CORE;

_ppt_template( 'framework/docs/header' ); 
 
_ppt_template( 'framework/docs/footer' );  

_ppt_template( 'footer', 'codes' ); 


?>