<?php
 
add_filter( 'ppt_blocks_args',  	array('block_listings10c',  'data') );
add_action( 'listings10c',  	array('block_listings10c', 'output' ) );
add_action( 'listings10c-css',  array('block_listings10c', 'css' ) );
add_action( 'listings10c-js',  	array('block_listings10c', 'js' ) );

class block_listings10c {

	function __construct(){}		

	public static function data($a){ global $CORE;  
	
		global $CORE;
  
		$a['listings10c'] = array(
			"name" 	=> "Style 10 - Search Results + Widgets",
			"image"	=> "listings10c.jpg",
			"cat"	=> "listings",
			"desc" 	=> "",
			"order" => 10, 
			"data" 	=> array( "card" => "info"),
			
			// HIDE VALUES
			"hide-title" 	=> true,
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $settings, $new_settings;
	
	
        $settings = array( );
		  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings10c", "listings", $settings ) );
 	  
		 // UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		 if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		 }  
		 
		 
		 
		if( $settings['card'] == "list"){
			 $thisdesign = 6;
		}else{
			$settings['card'] = "info"; 
		 	$thisdesign = 5;
		}  
		 
		 $GLOBALS['flag-search-sidebarset'] = 1;
 		
		ob_start();
		
		?>
<section class="section-0 <?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_divider']." ".$settings['section_padding']; ?>">
  <div class="container py-sm-4 <?php if(in_array(_ppt(array('design','boxed_layout')), array('1','1a','1b','1c')) ){ echo "px-0"; } ?>">
    <div class="row">
    
    <?php if($settings['title_show'] == "yes"){ ?>
      <div class="col-12">
        <?php _ppt_template( 'framework/design/parts/title' ); ?>
      </div>
      <?php } ?>
      
      <div class="col-md-12 col-lg-3">
      
        <?php _ppt_template( 'search', 'widgets' ); ?>
        
      </div>
  
          <div class="col-md-12 col-lg-9"> 
               
            <?php dynamic_sidebar("search_top");  ?>
              
			<?php _ppt_template( 'search', 'results' ); ?>
            
            <?php dynamic_sidebar("search_bottom");  ?>
       
          
      </div>
    </div>
  </div>
</section>
 

 
<!-- per row/ per page / card layout -->
<input type="hidden" name="cardlayout" class="customfilter" id="filter-cardlayout"  data-type="select" data-key="cardlayout" value="<?php echo _ppt(array('searchcustom', 'cardlayout')); ?>" />
<input type="hidden" name="perpage"  class="customfilter" data-type="select" data-key="perpage" value="18" >
<input type="hidden" name="perrow"  class="customfilter" data-type="select" data-key="perrow" value="<?php echo _ppt(array('searchcustom', 'perrow')); ?>">
<!-- end -->


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
	<?php if(isset($GLOBALS['flag-popular'])){ ?>
	jQuery('#filerbuttonclick').hide();
	jQuery('.filterby-link-pop').trigger('click');
	<?php }else{ ?>
   jQuery('.filters_listing').hide();
    <?php } ?>
  	
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
