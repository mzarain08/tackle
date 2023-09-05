<?php

class Widget_PremiumPress_Footer extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-footer';
	}
 
	public function get_title() {
		return "Footers";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
	protected function register_controls() {	 global $CORE; 
	

$i=1;
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['flag-elementor-footer'] = 1;

$blocks = ppt_theme_blocks_elementor("footer");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
	
	    /************** BUTTON CONTROLS */
		
  		$this->start_controls_section( 
                'hero_section',
                [
                    'label' => '<div style="display: flex;align-items: center;"><div style="background:#a41717;color:white;width:20px; height:20px; border-radius:50%; text-align:center; line-height:23px; margin-right:20px;">*</div><Div>'.__('Choose Design', 'premiumpress' )."</div></div>",
					
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]

            );

			
		$this->add_control(
				'design',
				[
					'label' => __( 'Design', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => _ppt_elementor_get_blocks("footer","ppt-footer"),
					'default' => 'footer1',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("footer").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	 
 	 
		
	}
	
	protected function render() { global $footer_settings;
	
		$s = $this->get_settings_for_display();	

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		$g = array( "design" );  
		
		$fields = array();
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("footer", 1);		
		foreach($blocks as $block){
		  
			$d = ppt_theme_block_default(array($block), 1);  
			
			foreach($d['f'] as $k => $f){
				$fields[$k] = $k;			
			}
		}
		 

		// 2. FILTER DATA
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
 		
		foreach( $fields as $k){
			
			if(in_array($k, array("image","image1","image2","image3","image4","image5","image6","image7","image8","image9","image10","image11"))){
				$footer_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k]) && $k != "" ){
				$footer_settings[$k] = $s[$k];
			} 
			
		} 
	 
  		  	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($footer_settings['design']);  
		do_action($footer_settings['design']."-css");  
		do_action($footer_settings['design']."-js");  
		
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "footer";
			$GLOBALS['savedata']['design'] 	= $footer_settings['design'];
			$GLOBALS['savedata']['data']	= $footer_settings;
			include("elementor-save.php");		
		}
		
	}	
	

}