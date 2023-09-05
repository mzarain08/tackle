<?php

class Widget_PremiumPress_Newsletter extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-newsletter';
	}
 
	public function get_title() {
		return "Newsletter";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
	protected function register_controls() {	 global $CORE; 
	
	 
	
	    /************** BUTTON CONTROLS */
		
  		$this->start_controls_section( 
                'hero_section',
                [
                    'label' => '<div style="display: flex;align-items: center;"><div style="background:#a41717;color:white;width:20px; height:20px; border-radius:50%; text-align:center; line-height:20px; margin-right:20px;">1</div><Div>'.__('Choose Design', 'premiumpress' )."</div></div>",
					
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]

            );

			
		$this->add_control(
				'design',
				[
					'label' => __( 'Design', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => _ppt_elementor_get_blocks("subscribe","ppt-newsletter"),
					'default' => 'subscribe1',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("subscribe").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	 
		
		 
	 
		
	}
	
	protected function render() { global $newsletterform_settings;
	
		$s = $this->get_settings_for_display();	

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		foreach(array( "design" ) as $k){
			
			if($k == "image"){
				$newsletterform_settings[$k] = $s[$k]['url'];
			}else{
				$newsletterform_settings[$k] = $s[$k];
			} 
		} 
		   	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($newsletterform_settings['design']);  
		do_action($newsletterform_settings['design']."-css");  
		do_action($newsletterform_settings['design']."-js");  
	}	
	

}