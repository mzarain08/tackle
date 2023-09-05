<?php

class Widget_PremiumPress_Headline extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-headline';
	}
 
	public function get_title() {
		return "Headline";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
 
	protected function register_controls() {	 global $CORE; 



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


$blocks = ppt_theme_blocks_elementor("headline");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 	   
 		
  		$this->start_controls_section( 
                'section1',
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
					'options' => _ppt_elementor_get_blocks("headline","ppt-headline"),
					'default' => 'headline1',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("headline").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	 
  		
		
	}
	
	protected function render() { global $headline_settings;
	
		$s = $this->get_settings_for_display();	
		 
		
		// 1. GET ALL KEYS
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		
		
		$blocks = ppt_theme_blocks_elementor("headline", 1);
		$fields = array("design" => "design");
		
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
 	
		foreach($fields as $k){
			
			if(in_array($k, array("image","image1","image2","image3","image4","image5","image6","image7","image8","image9","image10","image11"))){
				$headline_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k])){
				$headline_settings[$k] = $s[$k];
			} 
		} 
		 
		// 3. OUTPUT	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($headline_settings['design']);  
		do_action($headline_settings['design']."-css");  
		do_action($headline_settings['design']."-js");  
		
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		}
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "headline";
			$GLOBALS['savedata']['design'] 	= $headline_settings['design'];
			$GLOBALS['savedata']['data']	= $headline_settings;
			include("elementor-save.php");		
		}
		
	}	
	

}