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

global $CORE, $userdata, $settings, $CORE_UI, $df;
 
  
if($df['header_style'] == 5){
?>

<header <?php if(isset($df['header_bg_color'])){ ?> style="background:<?php echo $df['header_bg_color']; ?>!important;"<?php } ?> class="<?php echo $df['header_bg']; ?> <?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>navbar-light<?php }else{ ?>navbar-dark<?php } ?> <?php if($df['submenu_show'] ==0){ ?>border-bottom<?php } ?>" data-block-id="header"> %topmenu%
  <div class="container py-4 ">
    <div class="row no-gutters ppt-forms style2" ppt-flex-center>
      <div class="col-md-12 text-md-center">
        %logo%
      </div>
    </div>
  </div>
</header>


<?php }elseif($df['header_style'] == 16){
?>

<header <?php if(isset($df['header_bg_color'])){ ?> style="background:<?php echo $df['header_bg_color']; ?>!important;"<?php } ?> class="<?php echo $df['header_bg']; ?> <?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>navbar-light<?php }else{ ?>navbar-dark<?php } ?> <?php if($df['submenu_show'] ==0){ ?>border-bottom<?php } ?>" data-block-id="header"> %topmenu%


<div class="container py-4">
				<div class="row align-items-center justify-content-between">
					<div class="col-2">
						  %logo%
					</div>
					<div class="text-center d-flex justify-content-center col-6 hide-mobile">
                    
                     <nav ppt-nav ppt-flex-end class="active-underline hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav>
                    
                     
					</div>
					<div class="d-flex align-items-center justify-content-end col-3">
         
                   <div class="show-ipad show-mobile">
            <div class="d-flex">
              <?php if($userdata->ID && in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
              <div class="show-mobile show-ipad icon-notify" onclick="processNotificatons();">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['bell']; ?>
                </div>
              </div>
              <?php }elseif(!$userdata->ID && !empty($CORE->GEO("get_languagelist",array()))){  $languages =  $CORE->GEO("get_languagelist",array());  ?>
              <div class="user-languages" onclick="processLanguages();">
                <span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span>
              </div>
              <?php } ?>
              <div class="ml-4 menu-toggle cursor">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['menu']; ?>
                </div>
              </div>
            </div>
          </div>
         
          <div class="hide-mobile">
          
           
           <?php if(defined('WLT_DEMOMODE') && _ppt(array('lst','websitepackages')) == "0"){ ?>
		    
            <a href="<?php echo wp_login_url(); ?>" class="btn-secondary  rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "join_now" ) ); ?></a>
           
		   <?php }else{ ?>
           
            <?php if( $df['btn_show'] == "1" && !$userdata->ID ){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-secondary  rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
            <?php if( $df['btn2_show'] == "1" && $userdata->ID){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-secondary rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
            
            <?php } ?>
            
            
          </div>
					</div>
				</div>
			</div>

 
</header>

<?php }elseif($df['header_style'] == 15){
?>

<header <?php if(isset($df['header_bg_color'])){ ?> style="background:<?php echo $df['header_bg_color']; ?>!important;"<?php } ?> class=" <?php echo $df['header_bg']; ?> <?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>navbar-light<?php }else{ ?>navbar-dark<?php } ?> <?php if($df['submenu_show'] ==0){ ?>border-bottom<?php } ?>" data-block-id="header"> %topmenu%
 
  <div class="container py-4 logo-lg">
   
    <div class="row no-gutters" ppt-flex-center>
      <div class="col-md-2 col-lg-3">
        %logo%
      </div>
      
      
      <div class="col-lg-4 hide-ipad hide-mobile">
      
      <div>
      <form method="get" action="<?php echo home_url(); ?>">
      <input class="form-control w-100 mr-3" placeholder="<?php echo __( 'What are you looking for?', 'premiumpress' ); ?>" name="s" style="<?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>background:#fafafb;<?php }else{ ?>background:#00000008;<?php } ?> border:0px; height: 50px; padding-left:60px;" />
      
      <div ppt-icon-size="32" class="" data-ppt-icon2 style="position: absolute; top: 10px; color:#8d8d8d; left: 10px;">
                  <?php echo $CORE_UI->icons_svg['search']; ?>
                </div>
     </form>
      </div>
      
      </div>
      
      
      <div class="col-lg-5 col-md-9">
        <div class="d-flex " ppt-flex-end>
        
        
     
     
      <nav ppt-nav ppt-flex-end class="faded active-underline hide-mobile hide-ipad text-600 fs-5"> <?php echo do_shortcode('[MAINMENU style=1 max=4]');  ?> </nav>  
				
     
     
          <div class="show-ipad show-mobile">
            <div class="d-flex">
              <?php if($userdata->ID && in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
              <div class="show-mobile show-ipad icon-notify" onclick="processNotificatons();">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['bell']; ?>
                </div>
              </div>
              <?php }elseif(!$userdata->ID && !empty($CORE->GEO("get_languagelist",array()))){  $languages =  $CORE->GEO("get_languagelist",array());  ?>
              <div class="user-languages" onclick="processLanguages();">
                <span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span>
              </div>
              <?php } ?>
              
              
              
              <div class="ml-4 menu-toggle cursor">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['menu']; ?>
                </div>
              </div>
            </div>
          </div>
 
        </div>
      </div>
    </div>
  </div>
</header>

<?php  
}else{
?>
<header <?php if(isset($df['header_bg_color'])){ ?> style="background:<?php echo $df['header_bg_color']; ?>!important;"<?php } ?> class="<?php if(in_array($df['header_style'],array("9"))){ ?>logo-lg<?php } ?> <?php echo $df['header_bg']; ?> <?php if(in_array($df['header_bg'],array("bg-light","bg-white","bg-soft"))){ ?>navbar-light<?php }else{ ?>navbar-dark<?php } ?> <?php if($df['submenu_show'] ==0){ ?>border-bottom<?php } ?>" data-block-id="header"> %topmenu%
 
  <div class="container <?php if(in_array($df['header_style'],array("12"))){ echo "py-2"; }else{ echo "py-4 logo-lg"; } ?>  ">
   
    <div class="row no-gutters" ppt-flex-center>
      <div class="col-md-4">
        %logo%
      </div>
      <div class="col" <?php if(in_array($df['header_style'],array("8"))){   }else{ ?>ppt-flex-end<?php } ?> >
        <div class="d-flex <?php if(in_array($df['header_style'],array("8"))){ ?>justify-content-end w-100<?php } ?>">
          <?php
		  
		  switch($df['header_style']){		 	
				case "1": {
				?>
          <div class="hide-mobile hide-ipad">
            <?php echo $CORE->ADVERTISING("display_banner", "header_top" ); ?>
          </div>
          <?php
				} break;
				case "2": {
				?>
          <div class="hide-mobile hide-ipad small">
            <?php _ppt_template( 'framework/design/widgets/icon32_3_text' ); ?>
          </div>
          <?php
				} break;
				case "3": {
				?>
          <div class="hide-mobile hide-ipad">
            <?php _ppt_template( 'framework/design/widgets/icon32_search' ); ?>
          </div>
          <?php
				} break;
				case "4": {
				?>
          <div class="hide-mobile hide-ipad small">
            <?php _ppt_template( 'framework/design/widgets/icon32_2_text' ); ?>
          </div>
          <?php
				} break; 
				case "7": {
				?>
          <div class="hide-mobile hide-ipad small">
            <?php _ppt_template( 'framework/design/widgets/search_1' ); ?>
          </div>
          <?php
				} break; 				
				case "8": {
				?>
          <div  class="ppt-forms style3 d-flex justify-content-center hide-mobile hide-ipad">
            <form action="<?php echo home_url(); ?>" class="position-relative d-none d-xl-block mr-4" style="min-width:400px;">
              <div class="input-group">
                <input type="text" class="form-control rounded-pill pl-4 typeahead border-0" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
              </div>
              <button class="iconbit icon-svg" style="width:60px; height:46px;" type="submit" data-ppt-btn>
              <div ppt-icon-24>
                <?php echo $CORE_UI->icons_svg['search']; ?>
              </div>
              </button>
            </form>
            <div class="d-flex justify-content-center">
              <nav ppt-nav ppt-flex-end class="seperator spacing hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1 max=4]');  ?> </nav>
            </div>
          </div>
          <?php
				} break;  
				
			case "9": {
				?> <div class="hide-mobile hide-ipad">
            <div class="d-flex w-100">
                <div ppt-icon-size="48" class="mr-3" data-ppt-icon3><?php echo $CORE_UI->icons_svg['phone']; ?></div>
                <span>
                    <div class="text-600 fs-14" data-ppt-f3a><?php echo __("Phone Us","premiumpress"); ?></div>
                    <div class="opacity-8 text-700 fs-md" data-ppt-f3b><?php echo __("+123 456 789","premiumpress"); ?></div>
                </span>
            </div>
        </div><?php
				} break;  
				
				
			case "10": {
				?> 
                 
                 <nav ppt-nav ppt-flex-end class="faded active-underline hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav>
                
                
                 <div class="hide-mobile">
                 
                  <?php if( $df['btn_show'] == "1" && !$userdata->ID ){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-primary ml-3   text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
            <?php if( $df['btn2_show'] == "1" && $userdata->ID){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-primary ml-3 text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
                 </div>
				
				<?php
				
				} break;  
				
				case "11": { ?>
                
                <nav ppt-nav ppt-flex-end class="faded active-underline hide-mobile hide-ipad text-600 fs-5"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav> <?php
				
				} break;  	
				
				case "12": { ?>
                
               
                <nav ppt-nav ppt-flex-end class="active-underline hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav> 
				 
				
				<?php
				
				} break;  
				
				  
				case "6":
				default: { ?>  <nav ppt-nav ppt-flex-end class="seperator spacing hide-mobile hide-ipad text-600"> <?php echo do_shortcode('[MAINMENU style=1]');  ?> </nav>  <?php
				}  }
		  ?>
          <div class="show-ipad show-mobile">
            <div class="d-flex">
              <?php if($userdata->ID && in_array(_ppt(array('user','notify')), array("","1")) ){ ?>
              <div class="show-mobile show-ipad icon-notify" onclick="processNotificatons();">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['bell']; ?>
                </div>
              </div>
              <?php }elseif(!$userdata->ID && !empty($CORE->GEO("get_languagelist",array()))){  $languages =  $CORE->GEO("get_languagelist",array());  ?>
              <div class="user-languages" onclick="processLanguages();">
                <span class="flag flag-<?php echo $CORE->GEO("get_language_icon",array());  ?>">&nbsp;</span>
              </div>
              <?php } ?>
              <div class="ml-4 menu-toggle cursor">
                <div ppt-icon-size="32" data-ppt-icon2>
                  <?php echo $CORE_UI->icons_svg['menu']; ?>
                </div>
              </div>
            </div>
          </div>
          <?php if($df['header_style'] == 6){ ?>
          <div class="hide-mobile mb-n2 ml-3">
            <a <?php if(!$userdata->ID){ ?> href="javascript:void(0);" onclick="processLogin();" <?php }else{ ?>href="<?php echo _ppt(array('links','myaccount')); ?>"<?php } ?>> <?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $userdata->ID, "css" => "rounded-circle shadow-sm border", "online" => 0, "link" => 0 )); ?> </a>
          </div>
          <?php }elseif($df['header_style'] < 1 && THEME_KEY != "sp"){ ?>
          <div class="hide-mobile">
          
           
           <?php if(defined('WLT_DEMOMODE') && _ppt(array('lst','websitepackages')) == "0"){ ?>
		    
            <a href="<?php echo wp_login_url(); ?>" class="btn-secondary  rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "join_now" ) ); ?></a>
           
		   <?php }else{ ?>
           
            <?php if( $df['btn_show'] == "1" && !$userdata->ID ){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-secondary  rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
            <?php if( $df['btn2_show'] == "1" && $userdata->ID){ ?>
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn-secondary rounded-pill text-600" data-ppt-btn data-ppt-btn-txt><?php echo $CORE->LAYOUT("get_placeholder_text_new", array("button", "addnew" ) ); ?></a>
            <?php } ?>
            
            <?php } ?>
            
            
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</header>
<?php } ?>