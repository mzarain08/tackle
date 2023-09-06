<?php

class Widget_PremiumPress_Listing_Subtitle extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-subtitle';
	}
 
	public function get_title() {
		return "Single - Subtitle";
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
				'label' => __( 'Subtitle Block', 'premiumpress' ),	
				  
			]
		);	 
  
		
		
       $repeater = new \Elementor\Repeater();
			
		$repeater->add_control(
				'field_name', [
					'label' => esc_html__( 'Custom Subtitle', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::TEXT, 
					'label_block' => true,
				]
			);  
			
        
            $repeater->add_control(
                'field', 
                [
                    'label'         => __('Attribute', 'premiumpress' ),
                    'type'          => \Elementor\Controls_Manager::SELECT,
                    'options' 		=> ppt_theme_card_data("elementor"),
                    'label_block'   => true,   
					'default' 		=> "views",  
                ]
            );          

            $this->add_control(
                'title_fields',
                [
                    'label' => __( 'Attributes', 'premiumpress' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),	
					'default' 	=> ppt_theme_card_data("elementor_defaults"),
									
               
                	'title_field' => '{{{ field_name }}}',
                ]
            );
		 
		
		
		$this->end_controls_section();
		  
	   
	    
	}
	
	protected function render() {
	
		global $new_settings;
	
		$s = $this->get_settings_for_display();	
		 
		$new_settings["title_style"] 	= 1;	
	 	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		
		$showFields = array();
		if(is_array($s['title_fields']) && !empty($s['title_fields'])){
			foreach($s['title_fields'] as $k => $v){
				$showFields[$v['field']] = $v['field'];
			}
		}
		
		$new_settings["title_fields"] = $showFields;	
		 
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( 'single/single-subtitle' );  
		 
		
	}	
	

} ?>