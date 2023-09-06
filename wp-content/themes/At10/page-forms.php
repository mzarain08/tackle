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

global $CORE, $errortext, $errorStyle, $userdata;  

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(isset($GLOBALS['flag-memberships']) || isset($GLOBALS['flag-validate-sms']) || isset($GLOBALS['flag-validate-photo']) || isset($GLOBALS['flag-validate-email']) ){

	$img = _ppt('register_bgimg');
 
	$defaultImages = array(
		
		0 => DEMO_IMG_PATH."/_register/login2.jpg", 
		
	);

}elseif(isset($GLOBALS['flag-register'])){

	$form = _ppt(array('design','register_layout'));
	$img = _ppt('register_bgimg');
 
	$defaultImages = array(
		
		1 => DEMO_IMG_PATH."/_register/login2.jpg",
		2 => DEMO_IMG_PATH."/_register/login1.jpg",
		3 => DEMO_IMG_PATH."/_register/login4.jpg",
		4 => DEMO_IMG_PATH."/_register/login3.jpg",
		5 => DEMO_IMG_PATH."/_register/login5.jpg",
		6 => DEMO_IMG_PATH."/_register/login6.jpg",
		7 => DEMO_IMG_PATH."/_register/login7.jpg",
		8 => DEMO_IMG_PATH."/_register/login8.jpg", 
		9 => DEMO_IMG_PATH."/_register/login9.jpg", 
		
	);
	
}else{

	$form = _ppt(array('design','login_layout'));
	$img = _ppt('login_bgimg'); 
	 
	$defaultImages = array(
 
		1 => DEMO_IMG_PATH."/_register/register2.jpg",
		2 => DEMO_IMG_PATH."/_register/register1.jpg",
		3 => DEMO_IMG_PATH."/_register/register3.jpg",
		4 => DEMO_IMG_PATH."/_register/register4.jpg",
		5 => DEMO_IMG_PATH."/_register/register5.jpg",
		6 => DEMO_IMG_PATH."/_register/register6.jpg",
		7 => DEMO_IMG_PATH."/_register/register7.jpg",
		8 => DEMO_IMG_PATH."/_register/register8.jpg", 
		9 => DEMO_IMG_PATH."/_register/register9.jpg",  
	);
}

if(isset($_GET['style'])){
$form = $_GET['style'];
}

$formatting = 0;

if(isset($GLOBALS['flag-memberships']) || isset($GLOBALS['flag-validate-sms']) || isset($GLOBALS['flag-validate-photo']) || isset($GLOBALS['flag-validate-email']) || isset($GLOBALS['flag-paywall']) ){
	$form = 0;
}elseif(isset($_GET['format'])){
	$formatting = $_GET['format'];
}
$GLOBALS['flag-format'] = $formatting;
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(is_numeric($form) && in_array($form, array(0, 1,2,3,4,5,6,7)) ){
$GLOBALS['flag-blankpage']= 1;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
 
$bgimage = ""; 
if($bgimage == "" && isset($defaultImages[$form]) ){
$bgimage = $defaultImages[$form];
}

if(strlen($img) > 2){
$bgimage = $img;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

get_header();
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// SET DEFAULTS
ob_start(); 



if(isset($GLOBALS['flag-memberships']) ){
 
	_ppt_template( 'ajax/ajax-modal-memberships' );
	
	$form = 10;

}elseif(isset($GLOBALS['flag-validate-sms']) ){
	 $form = 1;
	_ppt_template( 'forms/verify-sms' ); 

}elseif(isset($GLOBALS['flag-validate-photo']) ){
 	$form = 1;
	_ppt_template( 'forms/verify-photo' );

}elseif(isset($GLOBALS['flag-validate-email']) ){
 	$form = 1;
	_ppt_template( 'forms/verify-email' );
	
}elseif(isset($GLOBALS['flag-paywall']) ){

 	$form = 1;
	_ppt_template( 'forms/paywall' );

}elseif(isset($GLOBALS['flag-register'])){
 	
		if($GLOBALS['flag-format'] == 1){
			_ppt_template( 'ajax/ajax-modal-register-new' );
		}else{
			_ppt_template( 'ajax/ajax-modal-register' );
		}
	
}else{
	
	if( _ppt(array('mem','register'))  == '1'){
	
		if($GLOBALS['flag-format'] == 1){
			_ppt_template( 'ajax/ajax-modal-register-new' );
		}else{
			_ppt_template( 'ajax/ajax-modal-register' );
		}
		
	
	}else{
	
		_ppt_template( 'ajax/ajax-modal-login' );	
	}
} 

$display_content = ob_get_clean();
if (ob_get_level() > 0) {ob_flush();}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

switch($form){

  case "10": { ?>

<div id="ppt-register" class="ppt-forms bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-4 bg-light hide-mobile">
        <div class="overlay-inner">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-7 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="col-12 col-xl-10 mx-auto">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="col-12 col-xl-10 mx-auto">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break; case "1": { ?>

<div id="ppt-register" class="ppt-forms bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-4 bg-light hide-mobile">
        <div class="overlay-inner">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 offset-md-1 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break; case "2": { ?>

<div id="ppt-register" class="ppt-forms dark">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-6 bg-light hide-mobile">
        <div class="overlay-inner">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","light");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break; case "3": { ?>

<div id="ppt-register" class="ppt-forms style2 bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">

      <div class="col-md-6 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div> 
          </div>
        </div>
      </div>
      
      <div class="col bg-light hide-mobile">
        <div class="overlay-inner"></div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>"></div>
      </div>
      
    </div>
  </div>
</div>

<?php } break; case "4": { ?>

<div id="ppt-register" class="ppt-forms bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-6 col-lg-7 bg-light hide-mobile">
        <div class="overlay-inner">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break; case "5": { ?>

<div id="ppt-register" class="ppt-forms bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-4 bg-light hide-mobile">
        <div class="bg-secondary bg-overlay-secondary">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 offset-md-1 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } break; case "6": { ?>

<div id="ppt-register" class="ppt-forms bg-white">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-4 bg-light hide-mobile">
        <div class="bg-primary bg-overlay-primary">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 offset-md-1 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php } break; case "7": { ?>

<div id="ppt-register" class="ppt-forms bg-white style2">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100">
      <div class="col-md-6 col-lg-7 bg-light hide-mobile">
        <div class="bg-primary bg-overlay-secondary">
        </div>
        <div class="bg-image" data-bg="<?php echo $bgimage; ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-5 d-md-flex flex-column align-items-center">
        <div class="container pt-4">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <div class="logo">
                <a href="<?php echo home_url(); ?>"><?php echo $CORE->LAYOUT("get_logo","dark");  ?></a>
              </div>
            </div>
          </div>
        </div>
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="<?php if(isset($GLOBALS['flag-register'])){ ?>col-12<?php }else{ ?>col-11 col-md-10 col-lg-9 mx-auto<?php } ?>">
              <?php echo $display_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php } break; default: { ?>


<section class="bg-light section-60 ppt-forms" id="ppt-register">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-8 mx-auto">
      <div class="card"><div class="card-body">
		<?php echo $display_content; ?>
      </div></div></div>
    </div>
  </div>
</section> 
 
<?php } } ?>
<?php get_footer(); ?>
