<?php
 
add_filter( 'ppt_blocks_args', 	array('block_stores8',  'data') );
add_action( 'stores8',  		array('block_stores8', 'output' ) );
add_action( 'stores8-css',  	array('block_stores8', 'css' ) );
add_action( 'stores8-js',  	array('block_stores8', 'js' ) );

class block_stores8 {

	function __construct(){}		

	public static function data($a){   global $CORE;
  
		$a['stores8'] = array(
			"name" 		=> "Style 8",
			"image"		=> "stores8.jpg",
			"cat"		=> "store",
			"desc" 		=> "", 
			"order" 	=> 8, 
			
			"data" 	=> array( ),
			
			
			"defaults" => array(
					
 
					/* stores8 */    
					"section_padding"  => "section-80",     
					"section_bg"  => "bg-light",     
					"section_pos"  => "",     
					"section_w"  => "container",     
					"section_pattern"  => "",     
					"title_show"  => "yes",     
					"title"  => "Popular Stores",     
					"subtitle"  => " ",     
					"desc"  => " ",     
					"title_style"  => "1",     
					"title_pos"  => "left",     
					"title_heading"  => "h2",     
					"title_margin"  => "mb-4",     
					"subtitle_margin"  => "",     
					"desc_margin"  => "",     
					"title_txtcolor"  => "dark",     
					"subtitle_txtcolor"  => "opacity-5",     
					"desc_txtcolor"  => "opacity-5",     
					"title_font"  => "",     
					"subtitle_font"  => "",     
					"desc_font"  => "",     
					"title_txtw"  => "text-700",     
					"subtitle_txtw"  => "",     
					"btn_show"  => "yes",     
					"btn_link"  => "[link-categories]",     
					"btn_txt"  => "All Categories",     
					"btn_bg"  => "primary",     
					"btn_bg_txt"  => "",     
					"btn_icon"  => "",     
					"btn_icon_pos"  => "",     
					"btn_size"  => "btn-lg",     
					"btn_margin"  => "mt-2",     
					"btn_style"  => "1",     
					"btn_font"  => "",     
					"btn_txtw"  => "font-weight-bold",     
					"cat_show"  => "16",     
					"cat_show_list"  => "0",     
					"cat_offset"  => "0", 		
				 
					
					 
			), 
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("stores8", "stores", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		 

$randomID = rand(); 

	ob_start();
	
	?>

<section  class="stores8 <?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
<div class="container">
<div class="row">
<?php if($settings['title_show'] == "yes"){ ?>
  <div class="col-12">
    <?php  _ppt_template( 'framework/design/parts/title' ); ?>

  </div>
  <?php } ?>
  <div class="col-lg-12">
    <div class="row">
      <?php
		
		$termdata = get_terms('store', 'orderby=count&order=desc&hide_empty=0&number=10&parent=0');
		
		$total_merchants = count($termdata);
		$i=1; $sf = 0;
        foreach ($termdata as $term) { 
	 
		 // LINK 
         $link = get_term_link($term);		 
		 
		 // IMAGE
		 $img = do_shortcode('[CATEGORYIMAGE term_id="'.$term->term_id.'" pathonly=1 placeholder=1 tax="listing"]');
		
		?>
      <div class="col-lg-3 col-md-4 col-4 col-lg-5ths <?php if($i > 9){ echo "hide-mobile hide-ipad"; } ?>">
        <div class="card shadow-sm mb-md-4 card-mobile-transparent">
          <div class="card-body text-center card-hover">
           
            <a href="<?php echo $link; ?>" class="text-decoration-none text-dark">
            
            <div class="row">
              <div class="col-12 col-md-12">
              	<div class="bg-white position-relative store-icon-small">
                
                <div class="bg-image" data-bg="<?php echo $img; ?>"></div>
                
                </div>
              </div>
              
              <div class="col-12  col-md-12">
                <h5 class="icon-text"><?php echo $term->name; ?></h5>
              </div>
              
            </div>
              </a>
          </div>
        
        </div>
      </div>
      <?php $i++; } ?>
    </div>
    <?php if(isset($settings['btn_show']) && $settings['btn_show'] == "yes"){ ?>
    <div class="text-center">
        <?php  _ppt_template( 'framework/design/parts/btn' ); ?>
    </div>
    <?php } ?>
  </div>
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
		ob_start();
		?>
<style>

.stores8 .icon-text { font-size:16px; }
.stores8 .store-icon-small { height:100px; margin-bottom:10px; }
.stores8 .store-icon-small {
    background-size: contain!important;
    background-repeat: no-repeat !important;
}
@media (min-width: 576px) and (max-width: 991.98px) { 

.stores8 .icon-text { font-size:14px !important; }

}
@media (max-width:575.98px){
.stores8 { padding:20px 0px !important; }
.stores8 .store-icon-small {border: 1px solid #eee !important; border-radius: 4px !important;}
.stores8 .store-icon-small .bg-image { padding:0px 5px; }
.stores8 .icon-text { font-size:12px !important; }
.stores8 .store-icon-small {    height: 50px !important; }
}
</style>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
		return "";
		ob_start();
		?>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>