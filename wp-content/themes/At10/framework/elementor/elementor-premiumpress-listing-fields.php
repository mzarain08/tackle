<?php

class Widget_PremiumPress_Listing_Fields extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-listing-fields';
	}
 
	public function get_title() {
		return "Single - Custom Fields";
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
				'label' => __( 'Custom Field Block', 'premiumpress' ),	
				  
			]
		);	 
		
		  
		$this->add_control(
			'fields_empty' ,
			[
				'label'        	=> __( 'Show Empty Fields', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress' ),
				'label_off' 	=> __( 'Hide', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 1,
			]
		);
		 
		
            $repeater = new \Elementor\Repeater();
        
          
			$repeater->add_control(
				'field_name', [
					'label' => esc_html__( 'Custom Title', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::TEXT, 
					'label_block' => true,
				]
			);  
			
			  $repeater->add_control(
                'field', 
                [
                    'label'         => __('Attribute', 'premiumpress' ),
                    'type'          => \Elementor\Controls_Manager::SELECT,
                    'options' 		=> ppt_theme_listing_data("elementor"),
                    'label_block'   => true,   
					'default' 		=> "views",  
                ]
            );  
			      

            $this->add_control(
                'fields_fields',
                [
                    'label' => __( 'Attributes', 'premiumpress' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),	
					'default' 	=> ppt_theme_listing_data("elementor_defaults"),
									
               
                	'title_field' => '{{{ field_name }}}',
                ]
            );
		 
		
		
		$this->end_controls_section();
		  
	   
	    
	}
	
	protected function render() {
	
		global $new_settings;
	
		$s = $this->get_settings_for_display();	
		 
		$new_settings["fields_style"] 	= 1;		 	
		
		$new_settings["fields_empty"] 	= $s['fields_empty'];
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		
		$showFields = array();
		if(is_array($s['fields_fields']) && !empty($s['fields_fields'])){
			foreach($s['fields_fields'] as $k => $v){
				$showFields[$v['field']] = array("key" => $v['field'], "name" => $v['field_name']);
			}
		}
		
		$new_settings["fields_fields"] = $showFields;	
		
		//print_r($new_settings["fields_fields"])."<--";	
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 
		_ppt_template( 'single/single-fields' );  
		 
		
	}	
	

} ?>