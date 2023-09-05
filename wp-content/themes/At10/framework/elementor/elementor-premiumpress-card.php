<?php

class Widget_PremiumPress_Card extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-card';
	}
 
	public function get_title() {
		return "Card";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
	protected function register_controls() {	 global $CORE; 
	
	
	 	$block_types = array("1" => "testing","2" => "testing",); 
	   
	   
  		$this->start_controls_section( 
                'definition_list_section',
                [
                    'label' => __('Display Items', 'premiumpress' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]

            );
 

            $repeater = new \Elementor\Repeater();
        
            $repeater->add_control(
                'custom_field', 
                [
                    'label'         => __('Attribute', 'premiumpress' ),
                    'type'          => \Elementor\Controls_Manager::SELECT,
                    'options' => $block_types,
                    'label_block'   => true,    
                ]
            );          

            $this->add_control(
                'definition_list',
                [
                    'label' => __( 'Attributes', 'premiumpress' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
					
                        [
                          'custom_field' => __( 'Attribute', 'premiumpress' ),
                        
                        ], 
                        
						
                ],
                'title_field' => '{{{ repeater_term }}}',
                ]
            );

            $this->end_controls_section();	   
	   
	   
	    
	}
	
	protected function render() {
	
	$s = $this->get_settings_for_display();	
	
	print_r($s);
	
	}	
	

}