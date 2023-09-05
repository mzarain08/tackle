<?php 
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE, $CORE_CART;

$GLOBALS['flag-checkout'] = 1;  
 
 
// GET THE CART DATA
$table_data = $CORE_CART->cart_getitems();

// SET DATA AS GLOBAL JUST ENCASE NEEDED WITHIN A PLUGIN
$GLOBALS['global_cart_data'] = $table_data;
 
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_header(); 

_ppt_template( 'page-before' );


if(empty($GLOBALS['global_cart_data']['items']) ){ 

?>

<section>
<div class="container text-center">

    <h1 class="my-5">
    
    <i class="fa fa-shopping-basket" aria-hidden="true"></i> <?php echo __("Your basket is empty.","premiumpress") ?>
    
    </h1>
                     

</div>
</section>
<?php


}else{

?>

<section>
<div class="container">
 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$steps = array(
	
	1 => array("title" => __("Shopping Cart","premiumpress")), 
	2 => array("title" => __("Billing","premiumpress")),
	3 => array("title" => __("Payment","premiumpress")),
	4 => array("title" => __("Finish","premiumpress")),
 	
); 
?>
<div class="overflow-hidden steps-box hide-mobile row my-4 hide-mobile">
<?php $s=1; $i=1; foreach($steps as $kk => $bb){ ?>       
       <div class="col-md-3 mobile-mb-2 scroll-top-quick <?php if($s < $i){ ?>active<?php } ?>" onClick="steps('<?php echo $s; ?>','this')">        
       <span class="number-box px-xl-3 text-tuncate">      
      		<span class="number bg-secondary">0<?php echo $s; ?></span> <?php echo $bb['title']; ?>       
       </span>       	 
      </div>      
<?php $s++; } ?>
</div>
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>
 
<div class="h-100 mb-5 mobile-mb-4">

    <div class="row">
    
        <div class="col-md-4">
        
        <div id="checkout-items"><?php _ppt_template('forms/checkout/items' ); ?></div>
        
        </div>
        
        <div class="col-md-8">
        
        <?php _ppt_template('forms/checkout/billing' ); ?>
        
        </div> 
    
    </div>

</div> 

<?php
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


?>

</div>
</section>

<style>

.steps-box .number  {  display: inline-block; width:25px; height:25px; background:red; color:#fff; border-radius:100%;     line-height: 25px; font-size: 12px;    margin-right: 10px; }
.steps-box  .number-box { cursor:pointer;      font-size: 14px;    display: inline-block;    margin-right: 10px;   text-align: center;    line-height: 50px;    font-weight: 600;    z-index: 2;    position: relative; background: #fafafb; }

.wp-admin .steps-box  .number-box { background:#f7f7f7; }
@media (min-width: 992px){
.steps-box [class*=col-]:after {    width: 100%;    position: absolute;    content: "";    height: 1px;    background: 0 0;    border-top: 1px solid rgba(164,174,198,.2);    top: 1.5rem;    z-index: 0;    left: 3rem;}
}
</style>	
<?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

}// end

_ppt_template( 'page-after' );

get_footer();   ?>