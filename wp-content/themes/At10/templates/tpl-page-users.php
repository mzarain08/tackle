<?php
/*
Template Name: [PAGE - USERS]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE;

$GLOBALS['flag-agencies'] = 1;

get_header(); 

_ppt_template( 'page-before' );
   
$args = array('role' => 'subscriber' );


$key = _ppt('userpagetype');
if($key == ""){
	$key = "user_em";
}

$args = array_merge($args, 			
				array( 'meta_query' => array (
				
					'relation'    => 'AND',	
					
							array( 	 
							'user_type'    => array(
								'key' 			=> 'user_type',								 
								'value' 		=> $key,
								'compare' 		=> '=',								 			
							),			 
							 						
						),			
				), )  );
				
$query1 = new WP_User_Query($args);
$editors = $query1->get_results();


$act = $CORE->USER("get_account_type_all", array());
 
$title = __("Members","premiumpress");
foreach($act as $k => $bk){

	if($k == $key){
		if(isset($bk['name_long']) && strlen($bk['name_long']) > 1){
		$title = $bk['name_long'];
		}else{
		$title = $bk['name'];
		}
		
	}

}
 
   
   
?>

 
<section class="section-0 section-bottom-40 mt-4 mt-sm-0">
  <div class="container py-sm-4 <?php if(in_array(_ppt(array('design','boxed_layout')), array('1','1a','1b','1c')) ){ echo "px-0"; } ?>">
    <div class="row">
      <div class="col-md-8">
        <?php


if ( ! empty( $editors ) ) {
foreach ( $editors as $editor ) { $udata = $editor->data;


// GET DESC
$desc 			= get_the_author_meta( 'description', $udata->ID);
$link 			= get_author_posts_url($udata->ID);
$photo 			= $CORE->USER("get_avatar",$udata->ID); 
$username 		= $CORE->USER("get_username", $udata->ID);
$country 		= $CORE->USER("get_country", $udata->ID);


if(defined('WLT_DEMOMODE')){
$desc  = "Et vim graeco principes. Cu dico nullam pri stet possim quaerendum invenire platonem animal assentior nam. ";
$country = "USA";
}

?>
        <div class="rounded-20 mb-4 p-2" ppt-border1>
          <div class="py-3">
            <div class="container">
              <div class="row no-gutter">
                <div class="col-4">
                  <a href="<?php echo $link; ?>">
                  <div class="position-relative user_img rounded-20 overflow-hidden">
                    <div class="bg-image" data-bg="<?php echo $photo; ?>">
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-8">
                
                  <div class="link-dark fs-lg text-700"><a href="<?php echo $link; ?>"><?php echo $username; ?></a></div>
                  
                  <div class="mb-2">
                 <?php if(!in_array(THEME_KEY,array("es","vt"))){ ?>
                     <?php echo do_shortcode('[RATING_USER uid='.$udata->ID.' size="sm" total_show="0" reviews_show="0"  ]'); ?> 
                   <?php }else{ ?>
                     <?php echo __("Joined","premiumpress") ?> <?php echo $CORE->USER("get_joined", $udata->ID); ?> 
                    <?php } ?>
                    </div>
                  
                  <p class="hide-mobile"><?php echo $desc; ?></p>
                  
                  <a href="<?php echo $link; ?>" data-ppt-btn class="btn-primary hide-mobile"><?php echo __("View Profile","premiumpress") ?></a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } } ?>
      </div>
      <div class="col-md-4">
        <?php 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if(get_option('users_can_register') == 1 || defined('WLT_DEMOMODE') ){  ?>
        <div class="card">
          <div class="card-body">
            <h4><?php echo __("Don't have an account?","premiumpress"); ?></h4>
            <p> <?php echo __("Signup today and enjoy all of the member benefits.","premiumpress"); ?> </p>
            <a href="<?php echo wp_registration_url(); ?>" class="btn btn-primary"><?php echo __("Sign Up","premiumpress"); ?></a>
          </div>
        </div>
        <?php } ?>
        <?php dynamic_sidebar("page_sidebar");  ?>
      </div>
    </div>
  </div>
</section>
<style>


.user_img { width:100%; height:150px }
@media (min-width: 991px) { 
.user_img { width:200px; height:180px }
}
@media (max-width: 575.98px) { 
.user_img { width:100%; height:80px }
}
</style>
<?php 
_ppt_template( 'page-after' );

get_footer();  ?>