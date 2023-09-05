<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $post, $userdata;

$args = array(
                      'post_type' 			=> 'ppt_resume',
                      'posts_per_page' 	=> 100,
                  	'post_author' 	=> $userdata->ID,
					'author' 	=> $userdata->ID,
                      'paged' 				=> 1,
                  );
                  $wp_query = new WP_Query($args); 
				   
                  // COUNT EXISTING ADVERTISERS	 
                  $tt = $wpdb->get_results($wp_query->request, OBJECT);

 
?>

 
 
          <div class="stepbox row">
            <div class="col-4 stepbox-step step1 active">
              <div class="text-center stepbox-stepnum"><?php echo __("Submit Application","premiumpress"); ?></div>
              <div class="progress bg-success">
                <div class="progress-bar"></div>
              </div>
              <a href="javascript:void(0);" onclick="ChangeSteps(1);" class="stepbox-dot bg-dark"></a> </div>
            <div class="col-4 stepbox-step step2">
              <div class="text-center stepbox-stepnum"><?php echo __("Wait for Responce","premiumpress"); ?></div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
            <div class="col-4 stepbox-step step3">
              <div class="text-center stepbox-stepnum"> <?php echo __("Setup Interview","premiumpress"); ?> </div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a> </div>
          </div>
          
          
          
          <div id="waitresponcebox"  style="display:none;">
   
            <div class="p-4 bg-light m-3 rounded">

<div class="text-600 mb-3"><?php echo __("What happens next?","premiumpress"); ?></div>

              <p><?php echo __("An email has been sent to the employer to notify them of your new application.","premiumpress"); ?></p>
              <p><?php echo __("The employer has up to 30 days (usually allot quicker!) to respond and either accept or decline your application. Once a response is received you will be emailed and you can view all responses via your members area.","premiumpress"); ?></p>
            </div>
            <div class="text-center my-4">
            
            <a href="<?php echo get_permalink($post->ID); ?>" data-ppt-btn class="btn-primary mr-3"><?php echo __("Back to item page","premiumpress"); ?></a> 
            
            <a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers" data-ppt-btn class=" btn-primary"><?php echo __("View my applications","premiumpress"); ?></a>
            
            </div>
          </div>
          <div id="makeofferbox" >
            <div class="col-md-12 m-auto ">
              <div class="row ">
                <div class="col-md-12">
                  <div class="p-4 bg-light col-12 rounded mb-4">


<div class="text-600 mb-3"><?php echo __("How does it work?","premiumpress"); ?></div>


                    <p style="line-height:30px;" class="text-muted"> <?php echo __("Apply for this job now by selecting your resume below and clicking continue. We'll notify the employer and if accepted, arrange an interview for you.","premiumpress"); ?> </p>
                    <script>
                              function ValidateThis(){
                             
								
								ajax_single_offer_make();
								return false;
                              	 
                              }
							  
							  
							  
function ajax_single_offer_make(){ 
 
	jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            single_action: "single_offer_make",
			pid: <?php echo $post->ID; ?>,
			aid: <?php echo $post->post_author; ?>,
			price: jQuery('#offer_price_amount').val(),
			 
        },
        success: function(response) {
 
			if(response.status == "ok"){
			 	 
				// UPDATED DISPLAY			
				jQuery('#makeofferbox').hide();	
				jQuery('#waitresponcebox').show();	
				
				//jQuery('.step1').removeClass('active');
				//jQuery('.step1 .process').removeClass('bg-success');
				
				jQuery('.step2').addClass('active');
				jQuery('.step2 .progress').addClass('bg-success');
				 
				 
  		 	
			}else{			
				console.log("Error trying to add.");			
			}			
        },
        error: function(e) {
            console.log(e)
        }
    });
	
}// end are you sure
							  
							  
</script>
                    <form method="post" action="<?php echo _ppt(array('links','offerpage')); ?>" onsubmit="return ValidateThis();">
                    
                      <div class="">
                        <?php if(!empty($tt)){   ?>
                        
                          <input type="hidden" name="ct_action" value="newoffer">
                      <input type="hidden" name="ct_pid" value="<?php echo $post->ID; ?>">
                      <input type="hidden" name="ct_aid" value="">
                        
                        <label> <?php echo __("Select Resume","premiumpress") ?></label>
                        <div class="input-group">
                          <select class="form-control" name="offer_price_amount" id="offer_price_amount">
                            <?php foreach($tt as $p1){  $post1 = get_post($p1->ID); 
							
							if($post1->post_author != $userdata->ID){ continue; }
							?>
                            <option value="<?php echo $p1->ID; ?>" />
                            <?php echo $post1->post_title; ?> (<?php echo $post1->post_author; ?>)
                            </option>
                            <?php } ?>
                          </select>
                        </div>
                       
  <?php if(!$userdata->ID){ ?>
      <a href="javascript:void(0);" data-ppt-btn onclick="processLogin(1);" class="btn-primary font-weight-bold text-uppercase mt-3">  <?php echo __("Continue","premiumpress") ?></a> 
      <?php }else{ ?>
     <button data-ppt-btn class="btn-primary font-weight-bold text-uppercase mt-3" style="cursor:pointer"><?php echo __("Continue","premiumpress"); ?> </button>
      <?php } ?>
                        
                        
                        
                        <?php }else{ ?>
                        <h5><?php echo __("You do not have any resumes uploaded.","premiumpress") ?></h5>
                        <p><?php echo __("You must add an resume before you can apply for this job.","premiumpress") ?></p>
                        
                        <a href="<?php echo _ppt(array('links','myaccount')); ?>/?showtab=resume" class="btn btn-primary"><?php echo __("Upload Resume.","premiumpress") ?></a>
                        <?php } ?>
                      </div>
                      <div class="clearfix">
                        <p class="mt-4 ml-2 small float-left"><?php echo __("By clicking continue you agree to our website","premiumpress"); ?> <a href="<?php echo _ppt(array('links','terms')); ?>" style="text-decoration:underline;"><?php echo __("terms and conditions","premiumpress"); ?>.</a></p>
                          
                        
                        
                        </div>
                    </form>
                  </div>
                </div>
                
              
                
                
              </div>
            </div>
            <!-- end make offer box -->
          </div>
 
