<?php

class Widget_PremiumPress_Listing_Buttons_Block extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-button-block';
	}
 
	public function get_title() {
		return "Single - Button Block";
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
	  
		
            $repeater = new \Elementor\Repeater();
        
           
			  $repeater->add_control(
                'button', 
                [
                    'label'         => __('Button', 'premiumpress' ),
                    'type'          => \Elementor\Controls_Manager::SELECT,
                    'options' 		=> ppt_theme_listing_buttons("elementor"),
                    'label_block'   => true,   
					'default' 		=> "",  
                ]
            );  
			      

            $this->add_control(
                'buttons',
                [
                    'label' => __( 'Button', 'premiumpress' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),	
					'default' 	=> ppt_theme_listing_buttons("elementor_defaults"),
									
               
                	//'title_field' => '{{{ field_name }}}',
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
 		
		$showFields = array();
		if(is_array($s['buttons']) && !empty($s['buttons'])){
			foreach($s['buttons'] as $k => $v){
				$showFields[$v['button']] = array("key" => $v['button'] );
			}
		}
		
		$new_settings["buttons"] = $showFields;	
		 
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( 'single/single-content-data-button-block' );  
		 
		
	}	
	

}