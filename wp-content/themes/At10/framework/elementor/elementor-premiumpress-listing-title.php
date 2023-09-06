<?php

class Widget_PremiumPress_Listing_Title extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-title';
	}
 
	public function get_title() {
		return "Single - Title";
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
				'label' => __( 'Title Block', 'premiumpress' ),	
				  
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
 
		_ppt_template( 'single/single-title' );  
		 
		
	}	
	

} ?>