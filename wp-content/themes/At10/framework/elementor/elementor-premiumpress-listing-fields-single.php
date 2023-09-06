<?php

class Widget_PremiumPress_Listing_Fields_Single extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-fields-single';
	}
 
	public function get_title() {
		return "Single - Custom field";
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
				'label' => __( 'Single Field Block', 'premiumpress' ),	
				  
			]
		);	 
		
 
		
		$this->add_control(
				'fields-single-size',
				[
					'label' => __( 'Display Style', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => array( 
					
							"xs" 				=> __( 'Extra Small', 'premiumpress' ),							
							"sm" 				=> __( 'Small', 'premiumpress' ),
							"md" 				=> __( 'Medium', 'premiumpress' ),
							"lg" 				=> __( 'Large', 'premiumpress' ),
							"xl" 				=> __( 'Extra Large', 'premiumpress' ),								
														
					 ) ,
					'default' => "1", 
					"description" => "",
				]
		);
		
		/*
		$this->add_control(
			'fields-single-empty' ,
			[
				'label'        	=> __( 'Show Empty Fields', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress' ),
				'label_off' 	=> __( 'Hide', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 1,
			]
		);*/
		
		$this->add_control(
			'fields-single-data' ,
			[
				'label'        	=> __( 'Show Empty fields-single', 'premiumpress' ),
				'type'          => \Elementor\Controls_Manager::SELECT,
                'options' 		=> ppt_theme_listing_data_single("elementor"), 
				//'default' 		=> 1,
			]
		);
		  
		
		
		$this->end_controls_section();
		  
	   
	    
	}
	
	protected function render() {
	
		global $new_settings;
	
		$s = $this->get_settings_for_display();	
		 
		$new_settings["fields_single_style"] 	= 1; 
		
		/*$new_settings["fields_single_empty"] 	= $s['fields-single-empty'];*/
		
	 	$new_settings["fields_single_data"] 	= $s['fields-single-data'];
		
		$new_settings["fields_single_size"] 	= $s['fields-single-size'];
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( 'single/single-content-data-fields-single' );  
		 
		
	}	
	

} ?>