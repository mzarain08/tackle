<?php
 
add_filter( 'ppt_blocks_args',  	array('block_listings10a',  'data') );
add_action( 'listings10a',  	array('block_listings10a', 'output' ) );
add_action( 'listings10a-css',  array('block_listings10a', 'css' ) );
add_action( 'listings10a-js',  	array('block_listings10a', 'js' ) );

class block_listings10a {

	function __construct(){}		

	public static function data($a){ global $CORE;  
	
		global $CORE;
  
		$a['listings10a'] = array(
			"name" 	=> "Style 10 - Search Results + Sidebar",
			"image"	=> "listings10a.jpg",
			"cat"	=> "listings",
			"desc" 	=> "",
			"order" => 9, 
			"data" 	=> array( ),
			
			// HIDE VALUES
			"hide-title" 	=> true,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $new_settings;
	
	
        $settings = array( );
		  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings10a", "listings", $settings ) );
 	  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }  
		  
		 
		 if($settings['card'] == "list"){		 
		 	$thisdesign = 6; 
		  
		 }elseif($settings['card'] == "info"){
		  $thisdesign = 5; 		 
 		  
		 }elseif($settings['card'] == "list-xsmall"){
		  $thisdesign = 4;  
		  
		  
		 }else{ 
		 	 $thisdesign = 5; 
		 }
		 
		 $GLOBALS['flag-search-style'] = $thisdesign;
		 
		 $GLOBALS['flag-search-sidebarset'] = 1;
 		
		ob_start();
		
		?>
<section class="section-0 <?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_divider']." ".$settings['section_padding']; ?>">
  <div class="container py-sm-4 <?php if(in_array(_ppt(array('design','boxed_layout')), array('1','1a','1b','1c')) ){ echo "px-0"; } ?>">
    <div class="row">
      <div class="col-md-4 col-lg-3 pr-md-4 collapsed hide-mobile" id="filters-extra">
          
<?php 	 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
ob_start();
dynamic_sidebar("search_sidebar"); 
$sidebar_content = ob_get_clean();

if(strpos($sidebar_content, "blank-widget") !== false){ $sidebar_content = ""; }

if(defined('THEME_KEY') && THEME_KEY == "cp" && strlen(trim($sidebar_content)) < 10 ){
		
	global $settings;
		
		$settings['num'] = 3;
		
		_ppt_template( 'framework/design/widgets/widget', 'coupon-pop' );
		
		
		_ppt_template( 'framework/design/widgets/widget', 'coupon-categories' );		
		 	
		_ppt_template( 'framework/design/widgets/widget', 'coupon-stores' );
		
		_ppt_template( 'framework/design/widgets/widget', 'coupon-deals' );
		
		_ppt_template( 'framework/design/widgets/widget', 'blog-recent' );
		
}
echo $sidebar_content;
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		
		?>
        
        <?php // _ppt_template( 'search', 'sidebar' ); ?>
        
      </div>
      <div class="col">
        <div class="row px-0">
        
          <div class="col-12"> 
               
            <?php dynamic_sidebar("search_top");  ?>
                        
           	<?php if(!isset($GLOBALS['flag-home'])){ _ppt_template( 'search', 'orderby' ); } ?>
            
			<?php _ppt_template( 'search', 'results' ); ?>
            
            <?php echo $CORE->ADVERTISING("display_banner", "search_bottom" ); ?> 
            
            <?php dynamic_sidebar("search_bottom");  ?>
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>
<input type="hidden" name="cardlayout" class="customfilter" id="filter-cardlayout"  data-type="select" data-key="cardlayout" value="list" />
<input type="hidden" name="perpage"  class="customfilter" data-type="select" data-key="perpage" value="<?php if($settings['limit'] == ""){ echo get_option('posts_per_page'); }else{ echo $settings['limit']; } ?>" >
<textarea style="width:100%; height:100px; display:none" id="_filter_data"></textarea>
<?php $output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
	public static function js(){ global $CORE;
	
		ob_start();
		?>
<script>
 
var ajax_site_url = "<?php echo home_url(); ?>/"; 
var ajax_framework_url = "<?php echo get_template_directory_uri(); ?>/"; 
var ajax_googlemaps_key = "<?php echo trim( _ppt(array('maps','apikey')) ); ?>"; 

jQuery(document).ready(function(){ 
    
	 <!-- hide filters button -->
   jQuery('.filters_listing').hide();
    
  	
  _filter_update();
   
   // SHOW FIRST 5 FILTERS
   var i = 0;
   jQuery('.filters_sidebar .filter-content').each(function () {
		if(i < 5){
		jQuery(this).addClass('show');
		i ++;
		}
		
	});
	
});
 
 
</script>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}		
	public static function css(){ global $CORE;
		ob_start();
		?><style>
		#ajax-sponsor-output h6 { display:none; }
		
		.card-blog, .filters_col {background-color: #f8f9fa;  border: 0px solid #ededed !important; } 
        

		
        </style><?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}	
	
}

?>
