<?php
 
add_filter( 'ppt_blocks_args', 	array('block_icon0',  'data') );
add_action( 'icon0',  		array('block_icon0', 'output' ) );
add_action( 'icon0-css',  	array('block_icon0', 'css' ) );
add_action( 'icon0-js',  	array('block_icon0', 'js' ) );

class block_icon0 {

	function __construct(){}		

	public static function data($a){  global $CORE; 
  
		$a['icon0'] = array(
			"name" 	=> "Style 8",
			"image"	=> "icon0.jpg",
			"cat"	=> "icon",
			"order" => 0,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			"defaults" => array(
					
					"section_padding" => "section-40",
					"section_bg"	=>	"bg-light",	
					
					// TEXT
						
					"title_show" 		=> "yes",
					"title_style" 		=> "1",
					"title_heading" 	=> "h2",
					"title_pos" 		=> "center",
					
					"title" 			=> "Build your website in minutes!",					 
					"subtitle"			=> $CORE->LAYOUT("get_placeholder_text", array('desc', "hero") ),					
					"desc" 				=> "",
					 	
					"title_margin"		=> "",
					"subtitle_margin"	=> "mb-4",
					"desc_margin" 		=> "",					
					
					"title_font" 		=> "",
					"subtitle_font" 	=> "",
					"desc_font" 		=> "",
					 
					"title_txtcolor" 	=> "dark",
					"subtitle_txtcolor" => "opacity-5",
					"desc_txtcolor" 	=> "opacity-5",
					
					"title_txtw" 		=> "",
					"subtitle_txtw" 	=> "",
					 
					
					// BUTTON					
					"btn_show" 			=> "no",						
					"btn_style" 		=> "1",				
					"btn_size" 			=> "",
					"btn_icon" 			=> "",				
					"btn_icon_pos" 		=> "",
					"btn_font" 			=> "",
					"btn_txt" 			=> "",
					"btn_link" 			=> "",
					"btn_bg" 			=> "",
					"btn_bg_txt" 		=> "",					
					"btn_margin" 		=> "mt-4",
					 			
					
					// BUTTON				
					"btn2_show" 		=> "no",						
					"btn2_style" 		=> "2",				
					"btn2_size" 		=> "",
					"btn2_icon" 		=> "",				
					"btn2_icon_pos" 	=> "",
					"btn2_font" 		=> "",
					"btn2_txt" 			=> "",
					"btn2_link" 		=> "",
					"btn2_bg" 			=> "",
					"btn2_bg_txt" 		=> "",					
					"btn2_margin" 		=> "mt-4",
					
					 
			),		
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;	
	
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("icon0", "icon", $settings ) ); 
  
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		
		// default icons
		$d_icons = array(
		"",
		
		"fas fa-layer-group",
		"fas fa-tachometer-alt",
		"fas fa-file-signature",
		
		"fas fa-users",
		"fas fa-envelope",
		"fas fa-file-signature",

		"fab fa-facebook",
		"fas fa-comments-alt",
 		
		"fa fa-clock",
		"fab fa-elementor",
		
		);
		
		$settings["title_pos"] = "center";
		 
	  
	ob_start();
	?><section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
   <div class="<?php echo $settings['section_w']; ?>">
   <div class="row">
   <?php if($settings['title_show'] == "yes"){ ?>
   <div class="col-lg-8 mx-auto text-center"> 
      <?php _ppt_template( 'framework/design/parts/title' ); ?>     
   </div>
   <?php } ?>
   
   <div class="col-lg-12">
      <div class="row">
         <?php $i=1; while($i < 11){ ?>
         <div class="col-lg-3 col-md-4 col-4 col-lg-5ths <?php if($i > 9){ echo "hide-mobile hide-ipad"; } ?>">
            <div class="card shadow-sm my-md-4 <?php if($settings['icon'.$i.'_type'] != "image"){ ?>py-3<?php } ?> card-mobile-transparent">
               <div class="card-body text-center card-hover">
               <a href="<?php if($settings['icon'.$i.'_link'] == ""){ echo "#"; }else{ echo $settings['icon'.$i.'_link']; } ?>" class="text-decoration-none">
                  <div class="row">
                  
                     <div class="col-12 col-md-12">
                       
                       
                        <?php if($settings['icon'.$i.'_type'] == "image"){ ?>
                        
                       <img data-src="<?php echo $settings['icon'.$i.'_image']; ?>" class="img-fluid mb-3 lazy" alt="<?php echo $settings['icon'.$i.'_title']; ?>" />                      
					  
                       <?php }else{ ?>
                    
                    <i class="<?php if($settings['icon'.$i] == ""){ echo $d_icons[$i]; }else{  echo strtolower($settings['icon'.$i]); } ?> text-<?php echo $settings['icon'.$i.'_iconcolor']; ?>  fa-3x mb-4"></i>
                    	
						<?php } ?>
                    
                    
                     </div>
                     
<div class="col-12  col-md-12">
<h5 data-elementor-setting-key="icon<?php echo $i; ?>_title" 
            data-elementor-inline-editing-toolbar="none" 
            class="elementor-inline-editing icon-text text-<?php echo $settings['icon'.$i.'_txtcolor']; ?>"><?php if($settings['icon'.$i.'_title'] == ""){ echo $CORE->LAYOUT("get_placeholder_text", array('title', $i) ); }else{ echo $settings['icon'.$i.'_title']; } ?></h5>
                        
                         
                     </div>
                  </div>
               </div>
               </a>
            </div>
         </div>
         <?php $i++; } ?>
         
         <?php if($settings['btn_show'] == "yes"){ ?>
         <div class="col-12 text-center mt-4">
               <?php _ppt_template( 'framework/design/parts/btn' ); ?>
         </div>
         <?php } ?> 
         
      </div>
   </div>
</section><?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
		public static function css(){
	 
		ob_start();
		?>
<style>
@media (max-width:575.98px){

.icon-text { font-size:12px !important; }

}
</style>
		<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
		public static function js(){
		return "";
		ob_start();
		?>
 
        <?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		}	
}

?>