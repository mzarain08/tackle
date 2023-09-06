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

global $post, $CORE_UI, $userdata, $CORE;


if(in_array(_ppt(array('searchcustom', 'mobileperrow')),array("1"))){


}else{

switch($post->thistheme){ 
		
		case "da":
		case "es": { 
?>
<div class="show-mobile">
  <div class="position-relative mb-3">
    <a href="%link%">
    <div style="height:190px; width:150px; min-width:65px;" class="position-relative"  ppt-border1 >
      <div class="h-100 position-relative">
        <figure>
          <?php _ppt_template( 'cards/themes/search_badges' ); ?>
          <div class="bg-image z-0" data-bg="%image%">&nbsp;</div>
        </figure>
      </div>
    </div>
    </a>
    <div class="lh-20 text-700 " style="margin-top:20px;">
      <?php if(isset($post->online) && $post->online){ ?>
      <span class="text-online">&bull;</span>
      <?php } ?>
      <a href="%link%" class="text-dark">%title%, <span class="fs-sm opacity-5"><?php echo do_shortcode('[AGE]'); ?></span></a>
    </div>
  </div>
</div>
<?php
		
		} break;
		
		default: {
?>

<div class="show-mobile">
  <div class="d-flex position-relative mb-3 border-bottom pb-3">
    <a href="%link%">
    <div style="height:65px; width:65px; min-width:65px;">
      <div ppt-border1 class="h-100 position-relative">
        <div class="bg-image" data-bg="%image%">
          &nbsp;
        </div>
      </div>
    </div>
    </a>
    <div class="w-100 pl-3">
      <div class="d-flex justify-content-between">
        <div class="w-100">
          <div class="fs-6 lh-20 text-700" style="min-height:40px;">
            <a href="%link%" class="text-dark">%title%</a>
          </div>
       
            <nav ppt-nav class="pl-0 list-f100 text-600 d-flex align-items-baseline">
              %bottom%
            </nav>
         
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break;

	}


}

 ?>