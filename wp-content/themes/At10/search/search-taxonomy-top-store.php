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

global $CORE, $CORE_UI, $LAYOUT, $wpdb, $wp_query, $userdata;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$big = 1;
if($term->taxonomy == "store"){
$big = 0;
}
$image = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 big="'.$big.'" tax="'.$term->taxonomy.'" placeholder=0]');
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch(THEME_KEY){

 case "es":{
  $stitle = __("%s Escorts","premiumpress");
 } break;
 
 case "so":{
  $stitle = __("%s Downloads","premiumpress");
 } break;
 
 case "jb":{
  $stitle = __("%s Jobs","premiumpress");
 } break;
 
 case "cb":{
  $stitle = __("%s Deals","premiumpress");
 } break;
 
 default:{ 
  $stitle = __("%s Coupons &amp; Offers","premiumpress");
 } break;
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$title = $CORE->GEO("translation_tax", array($term->term_id, $term->name));

?>

<div class="border-bottom bg-white">
  <div class="py-3 border-bottom mb-3">
    <?php _ppt_template( 'search/search-breadcrumbs' ); ?>
  </div>
  <div class="container  main-container">
    <div class="row">
 
    
      <?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//  
///////////////////////////////////////////////////////////////////////////////////////

?>
      <div class="col-12 col-lg-8">
      
      
        <div class="d-flex align-items-center mb-4">
        <?php if(strlen($image) > 1){ ?>
          <div style="height: 70px;  width: 110px;" class="store-icon-small mr-4 mr-lg-5 show-mobilex">
            <div ppt-border1 class="h-100 position-relative">
              <div class="bg-image" data-bg="<?php echo $image; ?>">
                &nbsp;
              </div>
            </div>
          </div>
          <?php } ?>
          <div>
            <div class="d-md-flex justify-content-between">
              <h1 class="fs-md mb-2 mt-1 text-600"><?php echo $title; ?></h1>
            </div>
            
            
            <a href="<?php echo home_url(); ?>/outtax/<?php echo $term->term_id; ?>/store/" rel="nofollow" target="_blank" data-ppt-btn class="btn-primary btn-xs btn-block show-mobile"><span><?php echo ppt_visit_store(); ?></span></a>
 
            
            <nav ppt-nav class="pl-0 my-2 fs-14 textc-600 hide-mobile">
            
              <ul>
              
              <li><?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "3", "size" => "sm","share" => 1, "link" => get_term_link($term), "link_desc" => $title )); ?></li>
              
                <li>
                
                     <div class="d-flex verified ">
                    <div ppt-icon-16 data-ppt-icon-size="16">
                      <?php echo $CORE_UI->icons_svg['clipboard']; ?>
                    </div>
                    <div class="ml-2">
                     <?php echo str_replace("%s", $term->count, $stitle); ?>
                    </div>
                  </div>
                
                  </li>
                  <?php /*
                <li class="hide-mobile">
                  <div class="d-flex verified text-success">
                    <div ppt-icon-16 data-ppt-icon-size="16">
                      <?php echo $CORE_UI->icons_svg['check-circle-full']; ?>
                    </div>
                    <div class="ml-2">
                      <?php echo $term->count; ?> <?php echo  __("Verified","premiumpress"); ?>
                    </div>
                  </div>
                </li>
				*/ ?>
                  <?php if( THEME_KEY != "cb" && _ppt(array('lst','websitepackages')) != "0"){ ?>
                <li class="hide-mobile">
                
                 <div class="d-flex">
                    <div ppt-icon-16 data-ppt-icon-size="16">
                      <?php echo $CORE_UI->icons_svg['tag']; ?>
                    </div>
                    <div class="ml-2">
                       <a <?php if(!$userdata->ID){ ?>  href="javascript:void(0)"  onclick="processLogin(1);" <?php }else{ ?> href="<?php echo _ppt(array('links','add')); ?>/?tax=<?php echo $term->taxonomy; ?>&taxid=<?php echo $term->term_id; ?>"<?php } ?>  rel="nofollow"> <?php echo str_replace("%s",$CORE->LAYOUT("captions","1"), __("Add %s","premiumpress")); ?> </a>
                    </div>
                  </div>
                
                  
                </li>
                <?php } ?>
                
                
              </ul>
              
            </nav>
          </div>
        </div>
        

        
        
        <?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// <div><?php echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "sm","share" => 1, "link" => get_term_link($term), "link_desc" => $title )); 
  
  /*        
?>
        <div class="fs-smx">
          
        </div>
        <?php
*/
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
 
      </div>
      




<div class="col-12 col-lg-4 hide-ipad hide-mobile text-right">
 
<a href="<?php echo home_url(); ?>/outtax/<?php echo $term->term_id; ?>/store/" rel="nofollow" target="_blank" data-ppt-btn class="btn-primary btn-lg mt-3"><span><?php echo ppt_visit_store(); ?></span></a>
 
</div>


    </div>
  </div>
</div> 