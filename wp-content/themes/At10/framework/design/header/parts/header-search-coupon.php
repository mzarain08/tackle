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

global $CORE, $settings, $userdata;
 
if(!isset($settings['extra_show'])  ){
$settings['extra_show'] = "yes";
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$phone = _ppt(array('newheader','phone'));
if($phone == ""){
$phone = _ppt(array('company','phone'));
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$email = _ppt(array('newheader','email'));
if($email == ""){
$email = _ppt(array('company','email'));
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(isset($_GET['ppt_live_preview']) && $phone == ""){
$phone = "123 456 789";
}

if(isset($_GET['ppt_live_preview']) && $email == ""){
$email = "admin@mywebsite.com";
}


?>
 

<ul class="topbar-info main-header ">

 


<li class="list-inline-item hide-mobile quicklinks text-center">
            
    <a href="<?php echo home_url(); ?>/?s=shipping" class="text-white text-center clearfix">
    <i class="fal mb-2 fa-shopping-cart fa-2x text-secondary"></i>
    <div><?php echo __("Free Shipping","premiumpress"); ?></div>
    </a>

</li>
        
<li class="list-inline-item hide-mobile quicklinks text-center">
            
    <a href="<?php echo home_url(); ?>/?s=sale" class="text-white text-center clearfix">
    <i class="fal mb-2 fa-tags fa-2x text-secondary"></i>
    <div><?php echo __("Black Friday","premiumpress"); ?></div>
    </a>

</li>        
  
  
  
  <li class="hide-mobile hide-ipad" style="border-right:0px !important;">
  
    <form action="<?php echo home_url(); ?>" class="search">
      <div class="input-group">
        <input type="text" class="form-control rounded-0 typeahead" name="s" placeholder="<?php
		
		if(THEME_KEY == "cp"){
		
		echo __("Store name or keyword..","premiumpress");
		
		}else{
		
		  echo __("Keyword..","premiumpress");
		  
		}  
		  
		   ?>" autocomplete="off">
        <div class="input-group-append">
          <button class="btn bg-secondary rounded-0 text-uppercase px-3 border-0" type="submit"> <?php echo __("Search","premiumpress"); ?> </button>
        </div>
      </div>
      
      <div class="mt-2 tiny">
      
      <strong class="mr-2"><?php echo __("Top Stores","premiumpress"); ?>:</strong> 
      
	<?php
    $categories = get_terms('store', 'orderby=term_order&hide_empty=0&limit=3');
	if(is_array($categories) && !empty($categories)){
    $total_stores = count($categories);
    if(isset($_GET['pv']) && is_numeric($_GET['pv'])){
        $start = $per_page*$_GET['pv'];
    }   
    $i=1;  
    foreach ($categories as $term) { 
        // HIDE PARENT
        if($term->parent != 0){ continue; }
        if($i > 4){ continue; }
    ?>
    <a href="<?php echo get_term_link($term); ?>" class="text-white text-underline mr-2"><?php echo $term->name; ?></a> 
    <?php $i++; } ?>
    <?php } ?>
    </div>
      
      
      
      
    </form>
  </li>
  
</ul>
<?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>