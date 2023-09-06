<?php

class Widget_PremiumPress_SingleBlock extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-singleblock';
	}
 
	public function get_title() {
		return "Signle - Page Blocks";
	} 
	public function get_icon() {
		return 'premiumpress-single';
	} 
	public function get_categories() {
		return [ 'premiumpress-single' ];
	} 
	protected function register_controls() {	 global $CORE; 
	 
	   
  		$this->start_controls_section( 
                'singleblock_section',
                [
                    'label' => __('Single Display Settings', 'premiumpress' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]

            );
		
			
		$widgets = array(
			
					
			"single-title" 			=> "Title",
			"single-subtitle" 		=> "Subtitle",
			
					
			"single-breadcrumbs"	=> "Breadcrumbs",
			"single-content" 		=> "Content",
			
			"single-fields" 		=> "Custom fields",
			
			"single-author" 		=> "Author",	
			"single-sidebar-content" 	=> "Sidebar",			
			"single-content-data-button-block" 	=> "Button Block",
			
			"single-hours" 			=> "Hours",
			"single-rates" 			=> "Rates",				
			"single-claim" 			=> "claim",				
			"single-projectbids" 	=> "Bids",				
			"single-sharebox" 		=> "Share Box",			
			"single-files" 			=> "Attachments",
			"single-faq" 			=> "FAQ",			
			"single-reviews" 		=> "Reviews",			
			"single-gallery" 		=> "Gallery",
			
		); 
		 

        $this->add_control(
            'design',
            [
                'label' => __( 'Design', 'premiumpress' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $widgets,
               // 'default' => 'date', 
			 
            ]
        );
 
	   
	   
	   $this->end_controls_section();	   
 	
		
	}
	
	protected function render() { global $listing_settings, $new_settings;
	
		$s = $this->get_settings_for_display();	

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		foreach(array( "design" ) as $k){
			 
			 $listing_settings[$k] = $s[$k];
			 
		}  
		
		$new_settings['gallery_style'] = "gallery";
		 	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////// 
	 
	 	_ppt_template( "single/".$listing_settings['design'] );
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   		
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
	}	
	

} ?>