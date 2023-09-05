<?php

class Widget_PremiumPress_Listing_Gallery extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-gallery';
	}
 
	public function get_title() {
		return "Single - Gallery";
	} 
	public function get_icon() {
		return 'premiumpress-single';
	} 
	public function get_categories() {
		return [ 'premiumpress-single' ];
	} 
	protected function register_controls() {	 global $CORE; 
	
	 
 
		$this->start_controls_section(
			'ppt_listngpage',
			[
				'label' => __( 'Gallery Block', 'premiumpress' ),	
				  
			]
		);	 
		
		
		 
		
		$list = array( 
					
							"single/single-gallery-row" 					=> "Gallery",
							"single/single-gallery-grid" 				=> "Grid",
							"single/single-gallery-tall" 			=> "Tall Images",  
							"single/single-gallery-carousel" 		=> "Carousel",
							 
							"single/single-gallery-video" 			=> "Video",
											
							
			);
		
		
		if(THEME_KEY == "vt"){
		
		unset($list['single/single-row']);
		unset($list['single/single-galleryo']);
		unset($list['single/single-gallery-tall']);
		unset($list['single/single-gallery-carousel']);
		
		}else{
		unset($list['single/single-gallery-video']);
		}
		
		
		 
		
		$this->add_control(
				'gallery_style',
				[
					'label' => __( 'Gallery Style', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => $list ,
					'default' => "single/single-gallery", 
					"description" => "",
				]
		);
		
	  
		
		
		$this->end_controls_section();
		  
	   
	    
	}
	
	protected function render() {
	
		global $new_settings;
	
		$s = $this->get_settings_for_display();	
	 
  
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( $s['gallery_style'] );  
		 
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
	}	
	

} ?>