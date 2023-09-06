<?php
 
add_filter( 'ppt_blocks_args', 	array('block_stores7',  'data') );
add_action( 'stores7',  		array('block_stores7', 'output' ) );
add_action( 'stores7-css',  	array('block_stores7', 'css' ) );
add_action( 'stores7-js',  	array('block_stores7', 'js' ) );

class block_stores7 {

	function __construct(){}		

	public static function data($a){   global $CORE;
  
		$a['stores7'] = array(
			"name" 		=> "Style 7",
			"image"		=> "stores7.jpg",
			"cat"		=> "store",
			"desc" 		=> "", 
			"order" 	=> 6, 
			
			"data" 	=> array( ),
			
			
			"defaults" => array(
					
					"section_padding" => "section-80",
					"section_bg"	=>	"bg-light",	
					
					// TEXT						
					"title_show" 		=> "yes",
					"title_style" 		=> "1",
					"title_heading" 	=> "h2",
					"title_pos" 		=> "left",
					
					
					"title" 			=> "Latest Deals",					 
					"subtitle"			=>  "",					
					"desc" 				=> "Over 1,000 stores and coupons online right now - find the best deals and offers today!",
					 	
					"title_margin"		=> "mb-4",
					"subtitle_margin"	=> "",
					"desc_margin" 		=> "",					
					
					"title_font" 		=> "",
					"subtitle_font" 	=> "",
					"desc_font" 		=> "",
					 
					"title_txtcolor" 	=> "light",
					"subtitle_txtcolor" => "opacity-5",
					"desc_txtcolor" 	=> "opacity-5",
					
					"title_txtw" 		=> "",
					"subtitle_txtw" 	=> "",
					 
					
					// BUTTON					
					"btn_show" 			=> "yes",						
					"btn_style" 		=> "4",				
					"btn_size" 			=> "btn-md",
					"btn_icon" 			=> "",				
					"btn_icon_pos" 		=> "",
					"btn_font" 			=> "",
					"btn_txt" 			=> __("All Stores","premiumpress"),
					"btn_link" 			=> _ppt(array('links','stores')),
					"btn_bg" 			=> "light",
					"btn_bg_txt" 		=> "text-light",					
					"btn_margin" 		=> "mt-2",
				 
					
					 
			), 
						
		);		
		
		return $a;
	
	} public static function output(){ global $CORE, $new_settings, $settings, $CORE_UI;
	
	
		$settings = array( );  
		 
		// ADD ON SYSTEM DEFAULTS
		$settings = $CORE->LAYOUT("get_block_settings_defaults", array("stores7", "store", $settings ) );
	 
		// UPDATE DATA FROM ELEMENTOR OR CHILD THEMES
		if(is_array($new_settings)){
			 foreach($settings as $h => $j){
				if(isset($new_settings[$h]) && $new_settings[$h] != ""){
					$settings[$h] = $new_settings[$h];
				}
			 }
		} 
		
	 
$settings['card'] 			= "store";
$settings['custom'] 		= "stores";
$settings['datastring'] 	= "";
$settings['perrow'] 	= "5"; 
$randomID = rand();
 
 $args = array(
                   'post_type' 			=> 'listing_type',
                   'posts_per_page' 	=> 8,
				   'post_status'		=> 'publish',
				   'meta_query' => array(  array (						 
							'key'		=> 'homepage',
							'value' 	=> "1",
							'compare' 	=> '=',
					), ),
               );

$wp_query3 = new WP_Query($args);
  
if ( $wp_query3->have_posts() ) :

ob_start();	
?>

<section id="stores7-carousel-<?php echo $randomID; ?>" class="<?php echo $settings['section_class']." ".$settings['section_bg']." ".$settings['section_padding']." ".$settings['section_divider']; ?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="clearfix">
        </div>
        <?php if($settings['title_show'] == "yes"){ ?>
        <div class="d-flex mb-4 justify-content-between">
          <div>
            <<?php echo $settings['title_heading']; ?> class="font-weight-bold mb-0 font-<?php echo $settings['title_font'];  ?> text-<?php echo $settings['title_txtcolor']; ?> <?php echo $settings['title_txtw']; ?>"><?php echo $settings['title']; ?></<?php echo $settings['title_heading']; ?>>
          </div>
          <div class="hide-mobile">
<a class="btn bg-white btn-sm text-muted prev px-2 mt-2 border"><i class="fa fa-angle-left px-1 text-dark" aria-hidden="true"></i></a>
<a class="btn bg-white btn-sm text-muted next px-2 mt-2 border"><i class="fa fa-angle-right px-1 text-dark" aria-hidden="true"></i></a>
          </div>
        </div>
        <?php } ?>
        <div  class="owl-carousel owl-theme" id="stores7"  data-1000="4" data-600="4">
<?php 


while ( $wp_query3->have_posts() ) :  $wp_query3->the_post();  
	
	$POSTID = get_the_ID();
 
	// IMAGE
	$img = do_shortcode('[IMAGE pathonly=1 pid='.$POSTID.']');
	
	// LINK
	$t = wp_get_post_terms($POSTID, 'store', array() );
	
	// STORE DATA
	$store_image = "";
	$store_name = "";
	$store_link = get_permalink($POSTID);
	if(is_array($t) && !empty($t)){
		$store_link = get_term_link($t[0]->term_id, "store");	 
		$store_name = strip_tags(do_shortcode('[STORENAME]')); 				
		$store_image = do_shortcode('[STOREIMAGE sid='.$t[0]->term_id.']');
	
	} 
 
?>
          <div class="card-ppt-search no-fixed-height card-mobile-transparent  border-0 mb-0 shadow-sm">
            <figure class="p-0 border-0"> 
            
             <a href="javascript:void(0);" class="btn-gocoupon" data-nextlink="<?php echo $store_link; ?>" data-couponid="<?php echo $POSTID; ?>">
            
            <?php echo $CORE_UI->IMAGES("image", array("size" => "search", "pid" => rand(999,23233), "css" => "force", "link" => 0, "src" => $img )); ?> 
     
     
      <?php if($store_image != ""){ ?>
             <div class="bg-overlay-secondary bg-primary" style="opacity:0.2"></div>
     <div>
     
    
     <div class="store-rounded">
     <div class="p-2 bg-white shadow-sm position-relative store-icon-small store-rounded">
     <div class="bg-image" data-bg="<?php echo $store_image; ?>"></div>
     </div>
     </div>
    
     
     </div>
      <?php } ?>       
            
           
          
             
              </a>
              </figure>
            <div class="card-body position-relative">
            
              <h3 class="mt-1 h2 link-dark text-700"><a href="javascript:void(0);" class="btn-gocoupon" data-nextlink="<?php echo $store_link; ?>" data-couponid="<?php echo $POSTID; ?>"><?php echo  do_shortcode('[TITLE pid='.$POSTID.']'); ?></a></h3>
           
           
           <div class="text-dark show-mobile link-dark small text-uppercase"><?php echo $store_name; ?></div>
           
           <div class="d-flex justify-content-between">
            
            <div class="opacity-5 small"><?php echo str_replace("%s", do_shortcode('[HITS]'),__("viewed %s times","premiumpress")); ?> </div>
             
             <span class="text-success small"><i class="fa fa-check"></i> <?php echo __( 'verified', 'premiumpress' ); ?></span>
           </div>
            </div>
          </div>
          <?php endwhile;  ?>
        </div>
      </div>
    </div>
  </div>
</section>
 
<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;	
		
		endif;
	
	}
		public static function css(){
		ob_start();
		?>
<style>
#stores7 .owl-stage-outer { padding-bottom:10px; }
#stores7 .owl-stage-outer .card-body .imagebox { width:100px; position:absolute; right:10px; top:-50px; }
#stores7 .owl-stage-outer .card-ppt-search { min-height:50px !important; }
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
