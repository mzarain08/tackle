<?php

class Widget_PremiumPress_Listing_Block extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-block';
	}
 
	public function get_title() {
		return "Single - Block";
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
				'label' => __( 'Display Block', 'premiumpress' ),	
				  
			]
		);	 
		
		$this->add_control(
				'blockid',
				[
					'label' => __( 'Choose Block', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => ppt_theme_listing_blocks(1),
					'default' => "", 
					"description" => "",
				]
		); 
		
		
		$this->add_control(
			'styled' ,
			[
				'label'        	=> __( 'Styled', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress' ),
				'label_off' 	=> __( 'Hide', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 1,
			]
		);
		
	 
		$this->end_controls_section(); 
	   
	    
	}
	
	protected function render() {
	
		global $new_settings;
	
		$s = $this->get_settings_for_display();	
		
		$allBlocks = ppt_theme_listing_blocks();
		 
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		 
		if(isset($allBlocks[$s['blockid']])){
		
			if($s['styled']){
				_ppt_template( $allBlocks[$s['blockid']]['styled'] );  
			}else{
				_ppt_template( $allBlocks[$s['blockid']]['unstyled'] );  
			
			}  
		}
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		 

	}	
	

}