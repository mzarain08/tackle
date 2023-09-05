<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

global $CORE, $userdata, $CORE_UI; 


?>

<div style="<?php if(strlen(_ppt(array('design','sidebar_logo_bg'))) > 1){ ?>background: <?php echo _ppt(array('design','sidebar_logo_bg')); ?>;<?php } ?>" class="y-middle hederlogo">

	<?php  if(in_array(_ppt(array('design','mobile_sidebar_logo')), array("1",""))){  ?>
    
    <div>
    
        <a href="#" class="menu-toggle1 sidebar-logo btn-block mt-4 lh-20"> <?php echo str_replace("-black","-light",str_replace("-primary","-light",$CORE->LAYOUT("get_logo","light")));  ?> </a>
         
        <div class="text-center">
        <button class="navbar-toggler menu-toggle1" onclick="window.location.reload();">
            <div ppt-icon-size="24" class="text-light" data-ppt-icon2><?php echo $CORE_UI->icons_svg['menu']; ?></div>
            </button>
        </div>
    
    </div>
     
    
    <?php }else{ ?>
     <button class="navbar-toggler menu-toggle-slim" onclick="window.location.reload();">
        <div ppt-icon-size="32" class="text-light" data-ppt-icon2><?php echo $CORE_UI->icons_svg['menu']; ?></div>
        </button>
    
    <?php } ?>

</div>


<div class="sidebar-content <?php if(in_array(_ppt(array('design','mobile_sidebar_text')), array("1"))){ echo "text-dark"; }else{ echo "text-light"; } ?>"> 

<?php 
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




/*


 <?php echo do_shortcode('[MAINMENU class="mobile-nav" mobile=1]');  ?>
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(_ppt(array('lst','websitepackages')) == "1" && in_array(_ppt(array('mobile_menu','add')), array('1',"")) ){
?>


<a href="<?php echo _ppt(array('links','myaccount')); ?>" data-ppt-btn class=" btn-block btn-primary mt-4  mt-sm-3 list text-600"><?php echo  __("My Account","premiumpress") ?> </a>


<a href="<?php echo _ppt(array('links','add')); ?>" data-ppt-btn class=" btn-block btn-primary mt-4  mt-sm-3 list text-600"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1"), __("Add %s","premiumpress")) ?> </a>
 <hr />
<?php 
}
*/

?>

 

 

<div class="text-600 border-bottom mb-2 pb-2 fs-sm text-uppsercase"><?php echo __("Navigation","premiumpress"); ?></div>
<div class="nav-icon">
<?php echo do_shortcode('[MAINMENU class="mobile-nav" mobile=1]');  ?> 
</div>
<?php /*

 <ul>
             <li><a class="opacity-8" href="<?php echo home_url(); ?>"> <span class="icon"><i class="fal fa-home"></i></span> <span> <?php echo __("Home","premiumpress"); ?></span> </a></li>
                      
             <li><a class="opacity-8" href="<?php echo home_url()."/?s="; ?>"><span class="icon"><i class="fal fa-search"></i></span> <span><?php echo __("Search","premiumpress"); ?></span></a></li>
             
             <li><a class="opacity-8" href="<?php echo _ppt(array('links','aboutus')); ?>"> <span class="icon"><i class="fal fa-info"></i></span> <span><?php echo __("About Us","premiumpress"); ?></span></a></li>             
             
             <li><a class="opacity-8" href="<?php echo _ppt(array('links','how')); ?>"> <span class="icon"><i class="fal fa-star"></i></span> <span><?php echo __("How it works","premiumpress"); ?></span></a></li>
             
             <li><a class="opacity-8" href="<?php echo _ppt(array('links','blog')); ?>"> <span class="icon"><i class="fal fa-rss"></i></span> <span><?php echo __("Blog","premiumpress"); ?></span></a></li>
                              
         </ul>
  
 */ ?>
 
<?php

if(in_array(_ppt(array('design','mobile_sidebar_categories')), array("1"))){
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$limit = 30;
	$termdata = get_terms("listing", 'orderby=arc&order=menu_order&hide_empty=0&parent=0');
	if(is_wp_error( $termdata )){ 
		echo $termdata->get_error_message(); 
		return;
	}
	$total_merchants = count($termdata);
 
	$data = array(); $i=1;
	foreach ($termdata as $term) {
 	 
			
			if($i > $limit){
			$i++; continue;
			} 
		  
			$data[] = array( 
				"name"	=> $term->name,  
				"link"	=> get_term_link($term), 
				"count"	=> $term->count,  
				"icon" 	=> do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="listing"]'),
			); 
			
			$i++; 
		 
	
	} 
?>
<div class="text-600 border-bottom mb-2 pb-2 my-3 fs-sm text-uppsercase"><?php echo __("Categories","premiumpress"); ?></div>
 
<div class="ppt-scroll fs-14" data-target="#scrollwindow2" id="scrollwindow2"><div>
<?php foreach($data as $cat){ ?>
<div class="mb-1">
<a href="<?php echo $cat['link']; ?>" class="text-decoration-none">  <?php echo $cat['name']; ?></a>
</div>
<?php } ?>
</div>
</div>

<?php

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>


<div class="text-600 border-bottom mb-2 pb-2 fs-sm text-uppsercase mt-4"><?php echo __("Useful Links","premiumpress"); ?></div>


<?php 

if(in_array(_ppt(array('design','mobile_sidebar_buttons')), array("1",""))){ 
if(!$userdata->ID){ ?>
  
<?php if(get_option('users_can_register') == 1){ ?>  
<a data-ppt-btn class="btn-primary mb-3 btn-block list" href="<?php echo wp_login_url(); ?>"><?php echo __("Sign In","premiumpress"); ?></a>
<a data-ppt-btn class="btn-primary mb-3 btn-block list" href="<?php echo wp_registration_url(); ?>"><?php echo __("Register","premiumpress"); ?></a>
<?php } ?>
    
<?php }else{ ?>
<a data-ppt-btn class="btn-primary mb-3 btn-block list" href="<?php echo _ppt(array('links','myaccount')); ?>"> <?php echo __("My Account","premiumpress"); ?></a>
<a data-ppt-btn class="btn-primary mb-3 btn-block list" href="<?php echo wp_logout_url(home_url()); ?>"><?php echo __("Logout","premiumpress"); ?></a>
<?php } 

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 
   
// LANGUAGES
if(in_array(_ppt(array('design','mobile_sidebar_languages')), array("1",""))){
$languages =  $CORE->GEO("get_languagelist",array()); 
  
if(is_array($languages) && !empty($languages)){ ?>
 
  <select class="form-control w-100" id="mobilelangselect">
  <option><?php echo __("Language","premiumpress"); ?></option>
    <?php foreach($languages as $h){ ?>
    <option value="<?php echo $h['link']; ?>"><?php echo $h['name']; ?></option>
    <?php } ?>
  </select>
  <script>
		 
		 jQuery(function () {
			 
			jQuery("#mobilelangselect").change(function () {
				location.href = jQuery(this).val();
			})
		})
		 </script>
<?php 
} 
}
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// CURRENCY
if(in_array(_ppt(array('design','mobile_sidebar_currency')), array("1",""))){
$CORE->_currency_setup();
$currency =  $CORE->GEO("get_currencylist",array()); 
 
if(is_array($currency) && !empty($currency)){ ?>
  
  <select class="form-control w-100 mt-2" id="mobilecurrencyselect">
  <option><?php echo __("Currency","premiumpress"); ?></option>
    <?php foreach($currency as $h){ ?>
    <option value="<?php echo $h['link']; ?>"><?php echo $h['name']; ?></option>
    <?php } ?>
  </select>
  <script>
		 
		 jQuery(function () {
			 
			jQuery("#mobilecurrencyselect").change(function () {
				location.href = jQuery(this).val();
			})
		})
		 </script>
<?php 
} 

}
  
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
?>
</div>

<?php  if(_ppt(array('design','sidebar_open')) == "1"){  ?>

<script>
jQuery(window).on('resize',function () {

var wins = jQuery(window).width();
	if (wins  < 700){	
		jQuery("#wrapper").removeClass("toggled");
		jQuery('#sidebar-wrapper').hide();
	}else{
		jQuery("#wrapper").addClass("toggled");
		jQuery('#sidebar-wrapper').show();
	}
});
jQuery(window).on('load',function () {

	var wins = jQuery(window).width();
	
	if (wins  < 700){	
		setTimeout( function(){ 
						 
	  jQuery("#wrapper").removeClass("toggled");
			jQuery('#sidebar-wrapper').hide();
		
	  }  , 1000 );
		
	}

}); 
 </script>
<?php } ?>