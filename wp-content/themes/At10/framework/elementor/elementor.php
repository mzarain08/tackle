<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


// GLOBOAL FOOTER FOR CPAGE TEMPLATE CANVUS
add_action(
	'elementor/page_templates/canvas/after_content', function() { global $CORE;
	?>

<?php _ppt_template( 'footer', 'codes' );  ?>

    <?php
	}
);
 
function ppt_elementor_designs($catid){

	global $CORE; 

	// GET DATA
		$gd = $CORE->LAYOUT("load_all_by_cat", $catid); 
		ob_start();
		foreach( $gd as $tid => $g){
		
		 
		if(!isset($g['widget'])){ continue; }
		
		//if(is_array($g['cat']) && $g['cat'][1] != $catid){ continue; }
		
		$cat = "";
		if(is_array($g['cat'])){
		$cat = $g['cat'][1];
		}else{
		$cat = $g['cat'];
		}
		
		?>
                   
          <div style="padding:5px; border:1px solid #ddd; margin-bottom:10px;" > 
                        
		   <a href="javascript:void(0)" onclick="ppt_change_design_selection('<?php echo $tid; ?>');"> 
		   <img src="<?php echo $CORE->LAYOUT("get_block_prewview",  $tid ); ?>" style="max-width:100%;" />
		   </a>
		   </div>
           
           <div style="font-size:10px; margin-bottom:10px; text-transform: uppercase;"> 
           <?php echo $g['name']; ?>
            <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $cat; ?>&sid=<?php echo $tid; ?>" style="float:right;" target="_blank">preview</a> 
            
           </div> 
            
		   <?php
			}	
			$output = ob_get_contents();
			ob_end_clean();	

return $output;
}
 
//add_action('elementor/widgets/widgets_registered', 'custom_unregister_elementor_widgets');
function custom_unregister_elementor_widgets($obj){
	$elementor_widget_blacklist = array('image','icon','maps','sidebar');
 
	foreach($elementor_widget_blacklist as $widget_name){
    $obj->unregister_widget_type($widget_name);
  }
 
}


 
 
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-new',
			[
				'title' => "PremiumPress V.".THEME_VERSION,
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);

add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-single',
			[
				'title' => __( 'Single Page Blocks', 'premiumpress' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);


 if( defined('WLT_DEMOMODE') ){
 
add_action(
	'elementor/page_templates/canvas/after_content', function() { global $CORE;
	
	//<style><?php echo $CORE->LAYOUT("load_css", array()); </style>
	?>
 
	 <?php if(isset($_GET['preview'])){ ?>
	<script>
		jQuery(document).ready(function() { 
		 
		// ADD ADMINIATION TO BLOCKS	
		var code = "";
		
		var keycode = "";
		var editorcode = "";
		
		var i = 1;
		jQuery('textarea').each(function () {
		
		
		type = jQuery(this).data('key');
		cat = jQuery(this).data('cat');
		editor = jQuery(this).data('editor');
		 
			
		if(editor){
		
			editorcode = editorcode + jQuery(this).val()+'\n';	
		 
		
		}else{
				 
			if(cat != "header" && cat != "footer"  && typeof type != 'undefined'){
				
				keycode = keycode + "$core['design']['slot"+i+"_style'] = \""+type+"\";\n";	
				i++;
			
			}
			
			if(cat == "header"){
				keycode = keycode + "$core['design']['header_style'] = \""+type+"\";\n";	
			}
			
			if(cat == "footer"){
				keycode = keycode + "$core['design']['footer_style'] = \""+type+"\";\n";	
			}
			 
												 
			code = code + jQuery(this).val()+'\n';	
		
		}
					   
		
		
		
		});
		
		
		while(i < 10){ 
		
		keycode = keycode + "$core['design']['slot"+i+"_style'] = '';\n";
		
		i++;
		}
		
		
		jQuery('.addtooutput').each(function () {
		
			key = jQuery(this).data('key');
			value = jQuery(this).val();
			
			keycode = keycode + "$core['design']['" + key +"'] = \""+value+"\";\n";	
			 
		});  
		
		
		jQuery('#finishedoutput').val(keycode +' \n'+code);
		
		jQuery('#finishededitor').val(editorcode);
	
	 
	});
	</script>
    
  


<form method="post"  style="height:300px;" target="_blank">

<input type="hidden" name="childtheme_build" value="1" />

   

<div style="display:nonex;">


    <div class="bg-dark p-3 text-light">
    
    <div ppt-flex-between>
    
        <span> Output code for child themes.</span>
        
         <span>
         
         <input type="text" name="childtheme[name]" placeholder="Name.." class="form-control" />
         <button type="submit" class="btn-primary overflow-hidden" data-ppt-btn>Save Child Theme</button></span>
     
        
        </div>
    
    </div>
    
    
	<textarea style="width:100%; height:600px;" id="finishedoutput" name="childtheme[data]"></textarea>
	 
   
    <div class="bg-dark p-3 text-light">images</div>
	<textarea style="width:100%; height:600px;" id="finishededitor" name="childtheme[images]"></textarea>
	
</div>

</form>

	<?php
	}
	
	}
);

}

final class Elementor_Test_Extension {

	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	public function __construct() {

		add_action( 'init', [ $this, 'init' ] );
	 

	}
	
	function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

		$elementor_theme_manager->register_location( 'header' );
		$elementor_theme_manager->register_location( 'footer' ); 
	}

 
	public function init() {
 

		// Include plugin files
		$this->includes();
		 	
		// Register Theme locations
		add_action( 'elementor/theme/register_locations', [ $this, 'theme_prefix_register_elementor_locations' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
 	
		// Display Default Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'enqueue_site_styles' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_site_scripts' ] );
		
		// EDITOR
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
		 
		
	 	// PREVIEW
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_preview_styles' ] );
 
		
		// IN LIVE PREVIEW MODE
		add_action( 'elementor/frontend/before_register_styles', [ $this, 'frontend_styles' ] );

	  	
		// SAVE WIDGET
		add_action( 'elementor/widget/render_content',  [ $this, '_elementor_widget_render' ]  , 10, 3 );
	 		 
	 	
	} 
 
		
	function _elementor_widget_render($content, $widget){ global $CORE;
		
		
		$settings = $widget->get_settings();
		if(isset($settings['type'])){
		switch($settings['type']){
			
			case "header": { 
			
			$custom_css =  $CORE->LAYOUT("get_color", array("primary") ); 
			$custom_css .=  $CORE->LAYOUT("get_color", array("secondary") );	
		  
			echo "<style>".$CORE->LAYOUT("load_css", array()).$custom_css."</style>";
			
			} break;
		
		}	  
		}
		   
		return $content;
	
	}
 
 	
	// PREVIEW WINDOW STYLES
	// WHENE DITING
	public function enqueue_preview_styles(){ global $CORE;
 		    
		 
		// OUTPUT STYLES
		?><style><?php  echo str_replace(".bg-secondary",".elementor-editor-active .bg-secondary", str_replace(".text-secondary",".elementor-editor-active .text-secondary",
		str_replace(".bg-primary",".elementor-editor-active .bg-primary", str_replace(".text-primary",".elementor-editor-active .text-primary",$CORE->LAYOUT("load_css", array()))))); ?></style><?php 	
		 
	}	
	
	
	public function enqueue_editor_styles(){ global $CORE;		
		
		// LOADED WHENE EDITING
		wp_register_style( 'ppt-elementor-admin', CDN_PATH.'elementor/css/elementor-admin.css', [], 1 );
		wp_enqueue_style('ppt-elementor-admin');
			
		 
	}
	
	public function frontend_styles() { global $CORE;
	 	
		
		// THIS IS FOR THE LIVE PREVIEW MODE
		if(isset($_GET['preview_id']) && is_numeric($_GET['preview_id']) ){
			
			if($CORE->GEO("is_right_to_left", array() )){ 
			wp_register_style( 'ppt-bootstrap', CDN_PATH.'css/_bootstrap-rtl.css', [], 1 );
			}else{
			wp_register_style( 'ppt-bootstrap', CDN_PATH.'css/_bootstrap.css', [], 1 );
			}
			
			wp_enqueue_style('ppt-bootstrap'); 
			
			wp_register_style( 'ppt-styles', CDN_PATH.'css/css.premiumpress.css', [], 1 );
			wp_enqueue_style('ppt-styles'); 		
			
			wp_enqueue_script( 'premiumpress-js', CDN_PATH.'elementor/js/premiumpress.js', array(), 1 );	
			
			
		 
		}
		 		 
		 
	}
	/**
	 * Register all script that need for any specific widget on call basis.
	 * @return [type] [description]
	 */
	public function enqueue_editor_scripts() {
	
	
	  	wp_enqueue_script( 'premiumpress-editor', CDN_PATH.'elementor/js/editor.js', array(), 1 );
		
		// OUTPUT STYLES
		?><script>var ajax_site_url = "<?php echo home_url(); ?>/index.php"; </script><?php 
		
		
	}

	/**
	 * Loading site related style from here.
	 * @return [type] [description]
	 */
	public function enqueue_site_styles() {

	 
		
	}

	/**
	 * Loading site related script that needs all time such as uikit.
	 * @return [type] [description]
	 */
	public function enqueue_site_scripts() {
	
		 wp_enqueue_script( 'premiumpress-js', CDN_PATH.'elementor/js/premiumpress.js', array(), 1 );
  
 
	}
 
	public function includes() {
 		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress.php' ); 
		
		//require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-card.php' ); 
		
		// HEROS
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-hero.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-features.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-text.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-category.php' );
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listings.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-header.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-footer.php' );
		 
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-blog.php' );

		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-contactform.php' );
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-newsletter.php' );
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-pricing.php' );
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-headline.php' );

		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-video.php' );
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-search.php' );
		
		// LISTING PAGE EXTRAS
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-title.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-subtitle.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-gallery.php' ); 

		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-fields.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-fields-single.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-buttons.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-buttons-block.php' ); 
		
		require_once( THEME_PATH . '/framework/elementor/elementor-premiumpress-listing-block.php' );  
		
		
	}
	
	public function register_widgets() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Hero() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Text() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Features() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Category() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Listings() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_New_Header() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Footer() ); 
	  	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Blog() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Contactform() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Newsletter() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Pricing() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Headline() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Search() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Video() ); 


		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Card() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Title() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Subtitle() ); 

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Gallery() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Fields() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Fields_Single() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Buttons() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Buttons_Block() ); 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listing_Block() ); 

		// MAIN CARDS
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Hero() ); 
		
		

	}
 

}

Elementor_Test_Extension::instance(); 
?>