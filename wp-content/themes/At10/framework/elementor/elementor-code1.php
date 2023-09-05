<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$i=1; $o = 1;

$tabTitles = array(
	
	1 => array(	
		"title" => esc_html__( 'Title &amp; Descriptions', 'premiumpress' ), 
		"tab1" => esc_html__( 'Title', 'premiumpress' ),
		"tab2" => esc_html__( 'Subtitle', 'premiumpress' ),
		"tab3" => esc_html__( 'Desc', 'premiumpress' ),		
	),
	2 => array(	
		"title" => esc_html__( 'Buttons', 'premiumpress' ), 
		"tab1" => esc_html__( 'Button 1', 'premiumpress' ),
		"tab2" => esc_html__( 'Button 2', 'premiumpress' ),
	),	
	3 => array(	
		"title" => esc_html__( 'Images', 'premiumpress' ), 
		"tab1" => esc_html__( 'Main Image', 'premiumpress' ),
		"tab2" => esc_html__( 'Extra', 'premiumpress' ),
	), 
	
	4 => array(	
		"title" => esc_html__( 'Features', 'premiumpress' ), 
		"tab1" => esc_html__( 'Text', 'premiumpress' ),
		"tab2" => esc_html__( 'Icon', 'premiumpress' ), 
	),	
		
	
);
if(isset($GLOBALS['flag-elementor-header'])){
 
$tabTitles[1] = array(	
		"title" => esc_html__( 'Header', 'premiumpress' ), 
		"tab1" => esc_html__( 'Top', 'premiumpress' ),
		"tab2" => esc_html__( 'Middle', 'premiumpress' ),
		"tab3" => esc_html__( 'Bottom', 'premiumpress' ),		
); 
 
$tabTitles[2] = array(	
		"title" => esc_html__( 'Buttons', 'premiumpress' ), 
		"tab1" => esc_html__( 'Logged In', 'premiumpress' ),
		"tab2" => esc_html__( 'Logged Out', 'premiumpress' ),
		//"tab3" => esc_html__( 'Bottom', 'premiumpress' ),		
); 
unset($GLOBALS['flag-elementor-header']); 
}



if(isset($GLOBALS['flag-elementor-footer'])){
$tabTitles[1] = array(	
		"title" => esc_html__( 'Menu Titles &amp; Links', 'premiumpress' ), 
		"tab1" => esc_html__( 'Menu 1', 'premiumpress' ),
		"tab2" => esc_html__( 'Menu 2', 'premiumpress' ),
		"tab3" => esc_html__( 'Menu 3', 'premiumpress' ),
		"tab4" => esc_html__( 'Menu 4', 'premiumpress' ),
				
); 
 
 
unset($GLOBALS['flag-elementor-footer']);
}


if(isset($GLOBALS['flag-elementor-hero'])){
 
$tabTitles[3] = array(	
		"title" => esc_html__( 'Images', 'premiumpress' ), 
		"tab1" => esc_html__( 'Background', 'premiumpress' ),
		"tab2" => esc_html__( 'Front Image', 'premiumpress' ),
); 
unset($GLOBALS['flag-elementor-hero']); 
}

foreach($blocks as $block){

if(in_array($block,array( "feature1",  "feature2",  "feature3",  "feature4",  "feature5",  "feature6",  "feature7",  "feature8",  "feature9",  "feature10"))){ continue; }



 
if(in_array($block,array("tab_start","tab_end","tab1","tab2","tab3","tab4"))){
	 
	 
	switch($block){
	
		case "tab_start": {
			$this->start_controls_section( 'section_content'.$o,[ 'label' => $tabTitles[$o]['title'] ] );			
			$this->start_controls_tabs('tabs'.$o);			 
		} break;
		case "tab_end": {
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$o++;
		} break;
		case "tab1": {
			$this->start_controls_tab(	'tab1'.$o,	[	'label' => $tabTitles[$o]['tab1'],	]);
		} break;
		case "tab2": {
			$this->end_controls_tab();			
			$this->start_controls_section( 'section_content'.$o );			
			$this->start_controls_tab(	'tab2'.$o,	[	'label' => $tabTitles[$o]['tab2'],	]);
		} break;
		case "tab3": {
			$this->end_controls_tab();			
			$this->start_controls_section( 'section_content'.$o  );			
			$this->start_controls_tab(	'tab3'.$o,	[	'label' => $tabTitles[$o]['tab3'],	]);
		} break; 
		case "tab4": {
			$this->end_controls_tab();			
			$this->start_controls_section( 'section_content'.$o  );			
			$this->start_controls_tab(	'tab4'.$o,	[	'label' => $tabTitles[$o]['tab4'],	]);
		} break;
		
	}

}else{

 
	$d = ppt_theme_block_default(array($block), 1);
  
 if(in_array($block,array("title","subtitle","desc","btn","btn2","image","image1","images", "topmenu","submenu","mainmenu","footer_menu1","footer_menu2","footer_menu3","footer_menu4",
 
 
 ) )){

 
 }elseif(in_array($block,array("section","globals","text_format","section_divider"))){
 
   
 	$this->start_controls_section(
		'ppt_block'.$i,
		[
			'label' => $d['t'],
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,	
		]
	);
	
 }else{
 

 	$this->start_controls_section(
		'ppt_block'.$i,
		[
			'label' => $d['t'],
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,	
		]
	);
 }
 


	
	foreach($d['f'] as $k => $f){
 	
		switch($f['type']){
		
			case "notice": {
		
				$this->add_control(
					$k,
					[
						'type' => \Elementor\Controls_Manager::RAW_HTML,
				 
						'raw' => "<div style='background:#93003c; font-weight:600; color:white;padding:10px; line-height:20px;border-radius:10px;'>".$f['t']."</div>",
						
					]
				);
			
			} break;
			 
		
			case "text": {
				
			
					$this->add_control(
						$k,
						[
							'label' => $f['t'],
							'type' => \Elementor\Controls_Manager::TEXT,					
							"description" => $f['desc'],
							
						]
					); 
				
			
			} break;
		
			case "text_block": {
				
			
					$this->add_control(
						$k,
						[
							'label' => $f['t'],
							'type' => \Elementor\Controls_Manager::TEXT,					
							"description" => $f['desc'],
							'label_block' => true,
							
						]
					); 
				
			
			} break;			
			

			case "number": {
		
				$this->add_control(
					$k,
					[
						'label' => $f['t'],
						'type' => \Elementor\Controls_Manager::NUMBER,					
						"description" => $f['desc'],
						
					]
				); 
			
			} break;			
			case "color": {
		
				$this->add_control(
					$k,
					[
						'label' => $f['t'],
						'type' => \Elementor\Controls_Manager::COLOR,					
						"description" => $f['desc'],
						
					]
				);
			
			} break;
		
			case "textarea": {
			
				if(in_array($k,array("title","subtitle","desc"))){
				
					$this->add_control(
						$k,
						[
							'label' => $f['t'],
							'type' => \Elementor\Controls_Manager::TEXTAREA,					
							"description" => $f['desc'], 
							'separator' => 'after',
						]
					);
				}else{
				
				$this->add_control(
					$k,
					[
						'label' => $f['t'],
						'type' => \Elementor\Controls_Manager::TEXTAREA,					
						"description" => $f['desc'],
						
					]
				);
				
				}
				
			} break;
			
			case "image": {
		
				$this->add_control(
					$k,
					[
						'label' => $f['t'],
						'type' => \Elementor\Controls_Manager::MEDIA,					
						"description" => $f['desc'],
						
					]
				);
			
			} break;
			
			case "select": {
			
				$b =  str_replace($block."_","",$k);
				if($k == "topmenu_style"){
					$b = "topmenu_style";
				}elseif($k == "submenu_style"){
					$b = "submenu_style";					
				}elseif($k == "btn_bg"){
					$b = "btn_bg";
				}elseif($k == "btn2_bg"){
					$b = "btn_bg";
				}
				
				if($block == "taxonomy" && $k == "orderby"){
					$b = "terms_orderby";
				} 
						
				$b = str_replace("header_","", $b);
				
		
				$this->add_control(
					$k,
					[
						'label' 		=> $f['t'],
						'type' 			=> \Elementor\Controls_Manager::SELECT,
						'options' 		=> ppt_theme_block_select_values($b),
						"default" 		=> "",				
						"description" 	=> $f['desc'],
						'default' 		=> $f['d'],
						
					]
				);
			
			} break;
			
			case "switch": { 
			
				$this->add_control(
						$k ,
						[
							'label'        	=> $f['t'],
							'type'         	=> \Elementor\Controls_Manager::SWITCHER,
							'label_on' 		=> __( 'Yes', 'premiumpress' ),
							'label_off' 	=> __( 'No', 'premiumpress' ),
							'return_value' 	=> 1,
							'default' 		=> 0,
						]
					);
			
			} break;
			
			case "link": {
		
				$this->add_control(
					$k,
					[
						'label' => $f['t'],
						'type' => \Elementor\Controls_Manager::TEXT,					
						"description" => $f['desc'],
						'separator' => 'after',
						
					]
				);
			
			} break;
			
			
			case "taxonomy": { 
			 
		 
				$taxArray = array();	
				$taxonomies = get_taxonomies(); 
				foreach ( $taxonomies as $taxonomy ) {
				if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','elementor_library_type','elementor_library_category', 'elementor_font_type', 
				
				'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme',
				
				'make','model', 'wp_template_part_area',
				 
				))){ continue; } 
				$taxArray[$taxonomy] =  $taxonomy;
				
				}
						
				$this->add_control(
							$k,
							[
								'label' => $f['t'],
								'type' => \Elementor\Controls_Manager::SELECT,				
								'options' => $taxArray ,
								"default" => "listing",
							]
				);
			
			} break;
			
			case "taxonomy_selected": { 
			  
				$taxHide = true;
					 
					
				$taxonomies = get_taxonomies(); 
				foreach ( $taxonomies as $taxonomy ) {
				if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','elementor_library_type','elementor_library_category', 'elementor_font_type', 
				
				'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme',
				
				'make','model', 'wp_template_part_area',
				 
				))){ continue; } 
				  
			 
					$category_options = array();
					$terms = get_terms( array(
						'taxonomy' => $taxonomy,
						'hide_empty' => 0,
					));
				
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						foreach ( $terms as $term ) {
							$category_options[ $term->term_id ] = $term->name;
						}
					}
					
					$this->add_control(
						$k."_".$taxonomy,
						[
							'label' => $f['t'],
							'type' => \Elementor\Controls_Manager::SELECT2,
							'label_block' => true,
							'multiple' => true,
							'options' =>  $category_options,                
							'default' => '', 
							'condition' => ['tax' => $taxonomy  ],
						]
					);
					
					
					
					}
			
			} break;
			
			
			case "repeater-links": {
			
				 $repeater = new \Elementor\Repeater();
        
         
				$repeater->add_control(
					'field_name', [
						'label' => esc_html__( 'Display Text', 'premiumpress' ),
						'type' => \Elementor\Controls_Manager::TEXT, 
						'label_block' => true,
					]
				);  
				 
				  $repeater->add_control(
					'field', 
					[
						'label'         => __('Link', 'premiumpress' ),
						'type' => \Elementor\Controls_Manager::TEXT,  
						'label_block'   => true,   
						'default' 		=> "",  
					]
				);  
					  
	
				$this->add_control(
						$k ,
						[
						'label' => __( 'Custom Links', 'premiumpress' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),	
						//'default' 	=> "",  
						'title_field' => '{{{ field_name }}}', 
					]
				); 
			 
			} break;
			
			
		}
	}
 
	
	$this->end_controls_section();
 
$i++;
}

}

?>