<?php

class Widget_PremiumPress_New_Category extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-category';
	}
 
	public function get_title() {
		return "Category";
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

$blocks = ppt_theme_blocks_elementor("category");

include("elementor-code1.php");

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
  	
		
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
					'options' => _ppt_elementor_get_blocks("category","ppt-category"),
					'default' => 'category100',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("category").'</div>',
			]
		);
		
		$this->end_controls_section();	
		
 	
		
	}
	
	protected function render() { global $category_settings;
	
		$s = $this->get_settings_for_display();	
		 

		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   	
		$g = array("design");
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("category", 1);		
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
				$category_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k]) && $k != ""){
				$category_settings[$k] = $s[$k];
			} 
			
		}		
		 	
 
		// 3. CATEGORY SELECTED VALUES
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////

		$category_settings['cat'] = "";
		if(isset($s['cat_'.$category_settings['tax']])){
		$category_settings['cat'] = $s['cat_'.$category_settings['tax']];
		} 
 	
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($category_settings['design']);  
		do_action($category_settings['design']."-css");  
		do_action($category_settings['design']."-js");  
		
		if(isset($_GET['preview']) || isset($_GET['action']) || isset($_POST['actions'])){ 
		?>        
        <script src="<?php echo CDN_PATH.'elementor/js/pagebottom-new.js'; ?>"></script>
        <?php	
		} 
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "category";
			$GLOBALS['savedata']['design'] 	= $category_settings['design'];
			$GLOBALS['savedata']['data']	= $category_settings;
			include("elementor-save.php");		
		}
		
	}	
	

}