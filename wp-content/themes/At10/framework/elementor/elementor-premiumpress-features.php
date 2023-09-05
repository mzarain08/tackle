<?php

class Widget_PremiumPress_New_Features extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-icon';
	}
 
	public function get_title() {
		return "Features";
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

$blocks = ppt_theme_blocks_elementor("features");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

   
   
 
		
		   $this->start_controls_section(
					'features',
					[
						'label' => __( 'Feature Boxes', 'premiumpress' ),
						'description' => __( 'The may not prominent by default; however, some designs may show it.', 'premiumpress' ),				
					 				 
					]
			);  
			
			$this->start_controls_tabs('tabs');	
			
		$i=1; while($i < 11){ 
		 
		
		$this->start_controls_tab(	'box'.$i,	[	'label' => "".$i,	]);
		
		
		$this->add_control(
			'f'.$i.'a',
			[
				'label' => __( 'Title', 'premiumpress' )." ".$i,
				'type' => \Elementor\Controls_Manager::TEXT,	
				'label_block' => true,		
			]
		);
		
		$this->add_control(
			'f'.$i.'b',
			[
				'label' => __( 'Subitle', 'premiumpress' )." ".$i,
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'description' => "",			
			]
		);
		
		$this->add_control(
			'f'.$i.'icon',
			[
				'label' => __( 'Icon', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'description' => "",
				'label_block' => true,				
			]
		);
		
			$this->add_control(
			'f'.$i.'image',
			[
				'label' => __( 'Image', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => "",			
			]
		);
		
		$this->end_controls_tab();
		
		$i++;
		
		
		}
		$this->end_controls_tabs(); 
		$this->end_controls_section();	
		
		
   
	    /************** BUTTON CONTROLS */
		
  		$this->start_controls_section( 
                'text_section',
                [
                    'label' => '<div style="display: flex;align-items: center;"><div style="background:#a41717;color:white;width:20px; height:20px; border-radius:50%; text-align:center; line-height:23px; margin-right:20px;">*</div><Div>'.__('Change Design', 'premiumpress' )."</div></div>",
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]

            );

			
		$this->add_control(
				'design',
				[
					'label' => __( 'Design', 'premiumpress' ),
					'type' => \Elementor\Controls_Manager::SELECT, 
					'options' => _ppt_elementor_get_blocks("icon", array("ppt-icon","ppt-text") ),
					'default' => 'text108',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("icon").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	
	   
		 
		
		
		
	}
	
	protected function render() { global $text_settings;
	
		$s = $this->get_settings_for_display();	


		// 1. GET ALL KEYS
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		
		
		 
		$g = array("design",
		
		"f1a","f2a","f3a","f4a","f5a","f6a","f7a","f8a",
		"f1b","f2b","f3b","f4b","f5b","f6b","f7b","f8b",
		 
		 );
		$fields = array();
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("features", 1);	
		 	
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
			
			if(in_array($k, array("image","image1","image2","image3","image4","image5","image6","image7","image8","image9","image10","image11", 
			
			"f1image", "f2image","f3image","f4image","f5image","f6image","f7image","f8image", "f9image","f10image","f11image",
			
			))){
			
				$text_settings[$k] = $s[$k]['url'];
				
			}elseif(isset($s[$k]) && $k != ""){
			
				$text_settings[$k] = $s[$k];
			} 
			
		} 
	 	 	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($text_settings['design']);  
		do_action($text_settings['design']."-css");  
		do_action($text_settings['design']."-js"); 
		
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "features";
			$GLOBALS['savedata']['design'] 	= $text_settings['design'];
			$GLOBALS['savedata']['data']	= $text_settings; 
			include("elementor-save.php");		
		}
		
	}	
	

} ?>