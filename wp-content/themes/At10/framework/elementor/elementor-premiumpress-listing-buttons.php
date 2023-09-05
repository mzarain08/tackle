<?php

class Widget_PremiumPress_Listing_Buttons extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-button';
	}
 
	public function get_title() {
		return "Single - Buttons";
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
				'label' => __( 'Button Block', 'premiumpress' ),	
				  
			]
		);	 
		
		$this->add_control(
				'button_type',
				[
					'label' => __( 'Button Style', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' 		=> ppt_theme_listing_buttons("elementor"),
					'default' => _ppt(array('design','single_top')), 
					"description" => "",
				]
		); 


		$this->add_control(
				'button_size',
				[
					'label' => __( 'Button Size', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => array( 
					 						
							"btn-sm" 				=> __( 'Small', 'premiumpress' ),
							"btn-md" 				=> __( 'Medium', 'premiumpress' ),
							"btn-lg" 				=> __( 'Large', 'premiumpress' ),
							"btn-xl" 				=> __( 'Extra Large', 'premiumpress' ),								
														
					 ) ,
					'default' => "btn-lg", 
					"description" => "",
				]
		); 
		
		
		
		$this->add_control(
			'button_block' ,
			[
				'label'        	=> __( 'Show Full Width', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'premiumpress' ),
				'label_off' 	=> __( 'No', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 1,
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
 		 
		$new_settings["button_type"] 	= $s['button_type'];
		
		$new_settings["button_size"] 	= $s['button_size'];
  		
		$new_settings["button_block"] 	= $s['button_block'];
  
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( 'single/single-content-data-buttons' );  
		 
		
	}	
	

} ?>