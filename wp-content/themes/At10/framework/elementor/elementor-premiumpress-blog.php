<?php

class Widget_PremiumPress_Blog extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-blog';
	}
 
	public function get_title() {
		return "Blogs";
	} 
	public function get_icon() {
		return 'premiumpress';
	} 
	public function get_categories() {
		return [ 'premiumpress-new' ];
	} 
	protected function register_controls() {	 global $CORE; 
	 
	 
		
	/******************** SECTION **/
	
		$this->start_controls_section(
			'ppt_blog1',
			[
				'label' => __( 'Settings', 'premiumpress' ),				
				  'label' => __('Blog Data', 'premiumpress' ),	
			]
		); 
		
		
		 $this->add_control(
            'show',
            [
                'label' => __( 'Display Amount', 'premiumpress' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '',
				 
            ]
        );
		
		$category_options = array();
		$terms = get_terms( array(
			'taxonomy' => "category",
			'hide_empty' => 0,
		));
	
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			foreach ( $terms as $term ) {
				$category_options[ $term->term_id ] = $term->name;
			}
		}
		
		$this->add_control(
            'cat',
            [
                'label' => __( 'Blog Category', 'premiumpress' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' =>  $category_options,                
				'default' => '',  
            ]
        );
		
	 
	$this->end_controls_section();	 
		


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$blocks = ppt_theme_blocks_elementor("blog");

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
					'options' => _ppt_elementor_get_blocks("blog","ppt-blog"),
					'default' => 'blog1',
				]
		);
		
		
		$this->add_control(
			'div_design_preview',
			[
				//'label' => __( 'Block Type 1', 'premiumpress' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
				'raw' => '<div id="ppt_elementor_designs">'.ppt_elementor_designs("blog").'</div>',
			]
		);	
		
		
		$this->end_controls_section();	
		
	}
	
	protected function render() { global $blog_settings;
	
		$s = $this->get_settings_for_display();	
 
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   	
		$g = array("design", "show", "cat",);
		foreach($g as $bb){
		$fields[$bb] = $bb;
		}
		
		// ADDON 
		$blocks = ppt_theme_blocks_elementor("blog", 1);		
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
				$blog_settings[$k] = $s[$k]['url'];
			}elseif(isset($s[$k]) && $k != ""){
				$blog_settings[$k] = $s[$k];
			} 
			
		}	
			
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////
   
		do_action($blog_settings['design']);  
		do_action($blog_settings['design']."-css");  
		do_action($blog_settings['design']."-js"); 
		
		if(defined('WLT_DEMOMODE') && isset($_GET['preview']) ){
			$GLOBALS['savedata'] = array();
			$GLOBALS['savedata']['cat'] 	= "blog";
			$GLOBALS['savedata']['design'] 	= $blog_settings['design'];
			$GLOBALS['savedata']['data']	= $blog_settings;
			include("elementor-save.php");		
		}
	}	
	

}