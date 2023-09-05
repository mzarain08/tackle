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

global $CORE;
 
if(_ppt(array('design', 'customsidebar')) == 1 || isset($GLOBALS['flag-page-sidebar']) ){
?>


				</div>
                
       
                
                
			</div>
    	</div>
        
 <div class="col-md-4 col-lg-3 pr-md-4 ppt-customsidebar hide-ipad hide-mobile">     
            
        <?php _ppt_template( 'sidebar' );  ?>
        
    </div>   
        
        
	</div>


<?php } ?></div>