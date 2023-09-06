<?php
 
 
add_filter( 'ppt_blocks_args', 	array('block_header22',  'data') );
add_action( 'header22',  		array('block_header22', 'output' ) );
add_action( 'header22-css',  	array('block_header22', 'css' ) );
add_action( 'header22-js',  	array('block_header22', 'js' ) );

class block_header22 {

	function __construct(){}		

	public static function data($a){ 
  
		$a['header22'] = array(
			"name" 	=> "Style 22",
			"image"	=> "header22.jpg",
			"cat"	=> "header",
			"desc" 	=> "", 
			"data" 	=> array( ),
			"order" 	=> 22,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $userdata, $new_settings, $settings;
	
		
		// ADD ON SYSTEM DEFAULTS
		$settings = array();
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("header22", "header", $settings ) );
 
		  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }
		 
		ob_start();
		
		?>

<header class="elementor_header header22 bg-white border-bottom navbar-light">

 
  <div class="container py-3 ">
    <div class="row">
    
      <div class="col-md-4 col-lg-3">
      
       <div class="d-flex justify-content-between">
        
        <a class="navbar-brand  mt-sm-1 ml-0" href="<?php echo home_url(); ?><?php if(defined('WLT_DEMOMODE')){ ?>/?reset=1<?php } ?>"> <?php echo $CORE->LAYOUT("get_logo","light");  ?> <?php echo $CORE->LAYOUT("get_logo","dark");  ?> </a>
        
<?php _ppt_template( 'framework/design/header/parts/header-languages' ); ?>
      
      </div>
      
      </div>
      
      <div class="col-lg-4 px-0 hide-ipad hide-mobile link-dark">
      
      <?php if(defined('WLT_DEMOMODE')){ ?>
      
<ul id="menu-top-menu" class="clearfix mb-0 seperator list-inline mb-0">

<li class="list-inline-item list-inline-item-type-custom list-inline-item-object-custom list-inline-item-home list-inline-item-11621 nav-item">
      <a href="<?php echo home_url(); ?>" class="nav-link"><?php echo __("Home","premiumpress"); ?></a>

</li>
      
<li class="list-inline-item list-inline-item-type-post_type list-inline-item-object-page current-list-inline-item page_item page-item-6 current_page_item active list-inline-item-11622 nav-item">
<a href="<?php echo _ppt(array('links','how')); ?>" class="nav-link"><?php echo __("How It works","premiumpress"); ?></a></li>

<li class="list-inline-item list-inline-item-type-post_type list-inline-item-object-page current-list-inline-item page_item page-item-6 current_page_item active list-inline-item-11622 nav-item">
<a href="<?php echo _ppt(array('links','add')); ?>" class="nav-link"><?php echo str_replace("%s", $CORE->LAYOUT("captions","1") ,__("Add %s","premiumpress")); ?></a></li>


</ul>

      
      <?php }else{ ?>
     <?php echo str_replace("menu-item","list-inline-item",do_shortcode('[MAINMENU topnav=1 class="clearfix mb-0 seperator list-inline mb-0"][/MAINMENU]')); ?> 
      <?php } ?>
      </div>
      
      
      <div class="col-sm-10 col-md-6 col-lg-4 hide-mobile">
        <form action="<?php echo home_url(); ?>" class="search">
          <div class="input-group">
            <input type="text" class="form-control rounded pl-5 typeahead" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
          </div>
          <button class="btn position-absolute" type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
      <?php if( ( defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1 )   ){ ?>
      <div class="col-sm-2 col-md-2 col-lg-1 hide-mobile">
      
    <?php if(!$userdata->ID){ ?>
     <a href="javascript:void(0);" onclick="processLogin();" class="tm">
   <img class="rounded-circle img-fluid" src="<?php echo CDN_PATH; ?>images/avatar/none.png" alt="user" width="45" height="45"> 
    </a>
    <?php }else{ ?>
     <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="tm">
  <img class="rounded-circle img-fluid lazy" data-src="<?php echo $CORE->USER("get_avatar", $userdata->ID ); ?>" alt="user" width="45" height="45"> 
    </a>
    <?php } ?>
      
      
      
      </div>
      <?php } ?>
      
    </div>
  </div>
</header> 
<?php

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
		}
		
		public static function js(){ 
		return "";
		}
		
		public static function css(){ 
		 
		ob_start(); ?>
<style>
.header22 .no-gutters i { font-size:24px; margin-bottom:10px; }
.header22 .no-gutters a { font-weight:bold; text-transform:uppercase; font-size:14px; }
.header22 .input-group input { height: 45px;    background: #f8f9fa;    border: 0px !important;  }
.subheader-list-cat a, .subheader-list-store a { width: 100px; border:1px solid #efefef; height: 100px; color:#444; background:#f8f9fa; display:block; text-align:center; margin: auto; line-height: 90px; font-size: 25px; margin-bottom: 10px; overflow: hidden; }
.header22 .btn-light { background:#fff; }
.header22 .nav-link { padding:0px 10px !important; font-size: 14px;    font-weight: 600; }
.header22 ul.seperator li:after { right:-5px; }
.header22 .list-inline { line-height: 45px; }
.header22 .navbar-brand { padding-top:0px; }
.header22 .search button {  top:6px; left:17px;z-index:999; color:#666666; }
.header22 .btn-primary {  height: 45px; line-height:15px; }
@media (max-width: 1200px){
.header22 .btn-primary { font-size:12px; }
}
</style>
<?php 
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		
}

?>
