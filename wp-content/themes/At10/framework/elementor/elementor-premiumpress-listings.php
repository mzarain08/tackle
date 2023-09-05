<?php

class Widget_PremiumPress_New_Listings extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listings';
	}
 
	public function get_title() {
		return "Listings";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
	protected function register_controls() {	 global $CORE; 
	


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$blocks = ppt_theme_blocks_elementor("listings");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

     
		
		/******************** ICON OPTIONS **/
	 	
		   $this->start_controls_section(
					'images',
					[
						'label' => __( 'Extra Images', 'premiumpress' ),	
						'description' => __( 'The may not prominent by default; however, some designs may show it.', 'premiumpress' ),				
					 				 
					]
			);  
			
		$this->add_control(
			'div_notice',
			[
			 
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => "<div style='background:#93003c; font-weight:600; color:white;padding:10px; line-height:20px;border-radius:10px;'>".__( "If the design you've selected includes images. You can configure them here, otherwise ignore these options.", 'premiumpress' )."</div>",
			]
		);	
			
		 
			
		$i=1; while($i < 7){ 
		$this->add_control(
			'image'.$i,
			[
				'label' => __( 'Image', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::MEDIA, 		
			]
		);
		
		$this->add_control(
			'image'.$i.'_txt',
			[
				'label' => __( 'Caption', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::TEXT,
								
			]
		);
		
		$this->add_control(
			'image'.$i.'_txt1',
			[
				'label' => __( 'Alt Caption', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::TEXT,
								
			]
		);
		
		$this->add_control(
			'image'.$i.'_link',
			[
				'label' => __( 'Link', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => "http://..",
			]
		);
		
		
		$i++; 
		
		}
		$this->end_controls_section();
	 
		
 

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
	$this->start_controls_section(
			'ppt_design',
			[
				'label' => '<div style="display: flex;align-items: center;"><div style="background:#a41717;color:white;width:20px; height:20px; border-radius:50%; text-align:center; line-height:23px; margin-right:20px;">*</div><Div>'.__('Choose Design', 'premiumpress' )."</div></div>",
				 
			]
		);
	$this->add_control(
				'design',
				[
					'label' => __( 'Layout', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => _ppt_elementor_get_blocks("listings","ppt-listings"),
					'default' => 'listings1',
				]
		);

		$this->end_controls_section();	   
	   

		
	}
	
	protected function render() { global $listing_settings;
	
		$s = $this->get_settings_for_display();	

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		$g = array(
		
		"design", 
 	
		"image1", "image1_link", "image1_txt",	"image1_txt1",	
		"image2", "image2_link", "image2_txt", "image2_txt1",	
		"image3", "image3_link", "image3_txt", "image3_txt1",	
		"image4", "image4_link", "image4_txt", "image4_txt1",	 
 		
		);	
		
		
		$fields = array();
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("listings",1);		
		foreach($blocks as $block){

			$d = ppt_theme_block_default(array($block), 1);  
			
			foreach($d['f'] as $k => $f){
				$fields[$k] = $k;			
			}
		}	
		 
		// 2. FILTER DATA
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		
		foreach( $fields as $k){
			
			if(in_array($k, array("image","image1","image2","image3","image4","image5","image6","image7","image8","image9","image10","image11"))){
				$listing_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k]) && $k != "" ){
				$listing_settings[$k] = $s[$k];
			} 
			
		} 
		 	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($listing_settings['design']);  
		do_action($listing_settings['design']."-css");  
		do_action($listing_settings['design']."-js"); 
		
		
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
		 
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "listing";
			$GLOBALS['savedata']['design'] 	= $listing_settings['design'];
			$GLOBALS['savedata']['data']	= $listing_settings;
			include("elementor-save.php");		
		}
		
	}	
	

} ?>