<?php

class Widget_PremiumPress_New_Header extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-header';
	}
 
	public function get_title() {
		return "Headers";
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

$GLOBALS['flag-elementor-header'] = 1;

$blocks = ppt_theme_blocks_elementor("header");

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
			
			
				$this->add_control(
			'div_notice1',
			[
			 
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => "<div style='background:#93003c; font-weight:600; color:white;padding:10px; line-height:20px;border-radius:10px;'>".__( "If the design you've selected includes images. You can configure them here, otherwise ignore these options.", 'premiumpress' )."</div>",
			]
		);	
			
		$i=1; while($i < 8){ 
		$this->add_control(
			'f'.$i.'a',
			[
				'label' => __( 'Title', 'premiumpress' )." ".$i,
				'type' => \Elementor\Controls_Manager::TEXT,			
			]
		);
		
		$this->add_control(
			'f'.$i.'b',
			[
				'label' => __( 'Sub Title', 'premiumpress' )." ".$i,
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => "<hr><br>",			
			]
		);
		
		$i++;
		
		
		}
		 
		$this->end_controls_section();	
		
		
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
					'options' => _ppt_elementor_get_blocks("header","ppt-header"),
					'default' => 'header102',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("header").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	 
	 	
		
		
	}
	
	protected function render() { global $header_settings;
	
		$s = $this->get_settings_for_display();	
 		
			
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
  
		
		$g = array("design", "f1a","f2a","f3a","f4a","f5a","f6a","f7a", "f1b","f2b","f3b","f4b","f5b","f6b","f7b" );  
		
		$fields = array();
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("header", 1);		
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
				$header_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k]) && $k != "" ){
				$header_settings[$k] = $s[$k];
			} 
			
		} 
		 
		 	
			
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($header_settings['design']);  
		do_action($header_settings['design']."-css");  
		do_action($header_settings['design']."-js"); 
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "header";
			$GLOBALS['savedata']['design'] 	= $header_settings['design'];
			$GLOBALS['savedata']['data']	= $header_settings; 
			include("elementor-save.php");		
		}
		 
		if( defined('WLT_DEMOMODE') && ( isset($_REQUEST['action']) && $_REQUEST['action']  == "elementor_ajax" ) || isset($_GET['preview']) && !isset($GLOBALS['headerrepeat']) ){
		
		 $GLOBALS['headerrepeat']=1;
		$color = $header_settings['primary_color']; 
		
		if(strlen($color) > 1){ 
		?><style>
		
		.elementor-element .bg-primary, 
		.elementor-element .bg-primary:hover,
		.elementor-element .bg-primary:focus, 
		.elementor-element a.bg-primary:focus, 
		.elementor-element a.bg-primary:hover, 
		.elementor-element button.bg-primary:focus, button.bg-primary:hover, 
		.elementor-element .badge-primary  { background:<?php echo $color; ?> !important; }
			 
			.elementor-element .btn-primary, .btn-primary:hover { color: #fff; background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; } 			
			.elementor-element .text-primary { color: <?php echo $color; ?> !important; }
			.elementor-element .btn-outline-primary { color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
			.elementor-element .btn-outline-primary:hover { background:none !important; }
			.elementor-element .text-primary a  { color: <?php echo $color; ?> !important; }
			
			.elementor-element [ppt-nav].active-underline > ul > li.active > a { border-bottom: 2px solid <?php echo $color; ?>!important; } 
            
            <?php $color = $header_settings['secondary_color']; if(strlen($color) > 1){  ?>
			
            .elementor-element .bg-secondary, 
			.elementor-element .bg-secondary:hover, 
			.elementor-element .bg-secondary:focus, 
			.elementor-element a.bg-secondary:focus, 
			.elementor-element a.bg-secondary:hover, 
			.elementor-element button.bg-secondary:focus, 
			.elementor-element button.bg-secondary:hover, .irs-bar  { background-color:<?php echo $color; ?> !important; } 
			.elementor-element .btn-secondary, 
			.elementor-element .btn-secondary:hover, 
			.elementor-element .btn-secondary:focus { color: #fff; background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
		   
			.elementor-element .text-secondary { color: <?php echo $color; ?> !important; }
			.elementor-element .text-secondary a  { color: <?php echo $color; ?> !important; }
			.elementor-element .btn-outline-secondary { color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; }
			.elementor-element .btn-outline-secondary:hover { background:none !important; }
			 
			<?php } ?>
            
            </style><?php  
			
			if(isset($_GET['preview']) && (strlen($header_settings['primary_color']) > 1 || strlen($header_settings['secondary_color']) > 1 ) ){
				
				
			
				$newdata =  array();
				$newdata['design']['color_primary'] 	= $header_settings['primary_color'];
				$newdata['design']['color_secondary'] 	= $header_settings['secondary_color'];
				
				
				$textlogo = $header_settings['logo_text'];
				if(strlen($textlogo) > 1){
				$newdata['design']['textlogo'] = $header_settings['logo_text'];
				}
				
				$existing_values = get_option("core_admin_values");				 
				$new_result = array_merge((array)$existing_values, $newdata);
				update_option( "core_admin_values", $new_result, true);	
			}
			
			
		
			
					
			}
			
		
		
		
		
		}
		
		
		
	}	
	

} ?>