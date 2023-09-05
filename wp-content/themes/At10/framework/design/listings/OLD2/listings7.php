<?php
 
add_filter( 'ppt_blocks_args', 	array('block_listings7',  'data') );
add_action( 'listings7',  		array('block_listings7', 'output' ) );
add_action( 'listings7-css',  	array('block_listings7', 'css' ) );
//add_action( 'listings7-js',  	array('block_listings7', 'js' ) );

class block_listings7 {

	function __construct(){}		

	public static function data($a){ global $CORE;  
  
		$a['listings7'] = array(
			"name" 	=> "Grid",
			"image"	=> "listings7.jpg",
			"cat"	=> "listings",
			"order" => 7,
			"desc" 	=> "", 
			"data" 	=> array( ),	
			
			"defaults" => array(
							
		 
				/* listings7 */    
				"section_padding"  => "section-top-60",     
				"section_bg"  => "bg-white",     
				"section_pos"  => "",     
				"section_w"  => "container",     
				"section_pattern"  => "",     
				"title_show"  => "yes",     
				"title"  => "Newly Added",     
				"subtitle"  => "Take a look at some of our latest items.",     
				"desc"  => " ",     
				"title_style"  => "1",     
				"title_pos"  => "left",     
				"title_heading"  => "h2",     
				"title_margin"  => "mb-2",     
				"subtitle_margin"  => "mb-0",     
				"desc_margin"  => "mb-0",     
				"title_txtcolor"  => "dark",     
				"subtitle_txtcolor"  => "primary",     
				"desc_txtcolor"  => "opacity-5",     
				"title_font"  => "",     
				"subtitle_font"  => "",     
				"desc_font"  => "",     
				"title_txtw"  => "text-800",     
				"subtitle_txtw"  => "text-700",     
				"datastring"  => " dataonly='1' cat='' card='info' perrow='' show='' custom='new' customvalue='' order='desc' orderby='date' debug='0' ",     
				"perrow"  => "",     
				"card"  => "info",     
				"limit"  => "",     
				"custom"  => "new", 		
							 
			),
					
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings;
	
	  
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("listings7", "listings", $settings ) ); 
		 
 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		}else{
		
		$settings['datastring'] = "orderby='rand'";
		}
		
		
		 
 
	ob_start();
	  
	 
	?>
<section class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
<div class="container">
<div class="row">

    <div class="col-lg-6 side1">
    <div class="mr-lg-4">
    <?php echo do_shortcode('[LISTINGS nav=0 small=1 limt=1 show=1 card_class="col-12 px-0" custom="featured" connected=1 ]'); ?>
    </div>    
    </div>
     
     
    <div class="col-lg-6 side2">
    

<div class="row">


<?php echo do_shortcode('[LISTINGS nav=0 small=1 limt=1 show=4 card_class="col-md-6" custom=new connected=1 ]'); ?>
    

</div>


    </div> 
      
      
</div>     
</div>
</section>
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
	
	}
	
		public static function css(){
		ob_start();
		?>
<style>
@media(min-width:100px){
.side1 .card-ppt-search .ppt-image-search { height:500px; }
}
.side2 .card-footer {display:none; }
.side2 .card-ppt-search { margin-bottom:10px!important; }
</style>
<?php	
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
		 }	
}

?>