<?php

class Widget_PremiumPress_Hero extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-hero';
	}
 
	public function get_title() {
		return "Hero";
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

$GLOBALS['flag-elementor-hero'] = 1;

$blocks = ppt_theme_blocks_elementor("hero");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	   
 
		$this->start_controls_section(
			'ppt_search',
			[
				'label' => __( 'Search Box', 'premiumpress' ),	
		 	 
				 
			]
		);
	   
		$this->add_control(
			'searchbox' ,
			[
				'label'        	=> __( 'Show Search Box', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'premiumpress' ),
				'label_off' 	=> __( 'No', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 0,
			]
		);	
		
		$this->add_control(
			'searchboxmap' ,
			[
				'label'        	=> __( 'Enable Location Search', 'premiumpress' ),
				'type'         	=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'premiumpress' ),
				'label_off' 	=> __( 'No', 'premiumpress' ),
				'return_value' 	=> 1,
				'default' 		=> 0,
			]
		);	 
		    
	   $this->end_controls_section();	
	 
   
		
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
					'options' => _ppt_elementor_get_blocks("hero","ppt-hero"),
					'default' => 'hero1',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("hero").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	 
		
		 
		
	}
	
	protected function render() { global $hero_settings;
	
		$s = $this->get_settings_for_display();	

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		$g = array(
		
		"design", 
	  	
		"image1_show", "image1", "image1_link", "video_show",
		
		"searchbox", "searchboxmap",
		 
		
		"image",
		 
		
		);
		
		
		$fields = array();
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("hero", 1);		
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
				$hero_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k])){
				$hero_settings[$k] = $s[$k];
			} 
			
		} 	
		
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($hero_settings['design']);  
		do_action($hero_settings['design']."-css");  
		do_action($hero_settings['design']."-js");  
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "hero";
			$GLOBALS['savedata']['design'] 	= $hero_settings['design'];
			$GLOBALS['savedata']['data']	= $hero_settings;
			include("elementor-save.php");		
		}
		
	}	
	

}