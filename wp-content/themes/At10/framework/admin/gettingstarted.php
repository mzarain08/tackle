<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;


?>


 

<div class="introbox">
				<div class="introbox__box postbox">
					<div class="introbox__header">
						<div class="introbox__title opacity-5"> Getting Started </div>
						<a class="introbox__skip" href="<?php echo home_url(); ?>/wp-admin/admin.php?page=premiumpress">
							<i class="fa fa-times" aria-hidden="true" title="Skip"></i>
							 
						</a>
					</div>
					<div class="introbox__content">
                    
                    
                    <?php /*
                    <div class="step-box" id="step1">
                    
                    
                    
						<div class="introbox__content--narrow">
							<h3>Welcome to <span>PremiumPress</span> </h3>
							<p>Please watch the video below, It will guide you through the steps needed to setup your website.</p>
						</div>

						<div class="introbox__video">
							<iframe width="620" height="350" src="https://www.youtube.com/embed/CrmCEqzcI3g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
						</div>

						<div class="introbox__actions introbox__content--narrow">
							
                            <a href="javascript:void(0);" onclick="switchpage(2);" class="button button-primary button-hero btn-primary">Create My Website</a>
							
							<a href="https://www.youtube.com/c/Premiumpress/videos?view_as=subscriber" target="_blank" class="button button-secondary button-hero">Watch more videos</a>
						</div>
                        
                        
                   </div>  
				   */ ?>
                   
                   
                    <div class="step-box" id="step1">
                    
                    
                    <div class="introbox__content--narrow">
							<h3>Choose a website design.</h3>
							<p>You can customize and/or change design at anytime.</p>
						</div>

						<div class="introbox__video">
							
                      
                            
                            
<div class="row">

<?php 


$i=0; $defaultthemeis = "";
$categories = $CORE->LAYOUT("get_demo_categories", array());
foreach($categories[THEME_KEY] as $cid => $cat){ 
		 	
$g = $CORE->LAYOUT("load_designs_by_theme", $cid);


foreach($g as $key => $h){ 
 
 // SKIP ELEMENTOR
 if(isset($h['elementor']) && !defined('ELEMENTOR_VERSION')){ continue; }

 $i++;
 
 if($i == 1){ $defaultthemeis = $h['key']; }
 

?>
            <div class="col-6 col-md-4 mb-3">
              <div class="card-ppt-search mb-0 design_<?php echo $h['key']; ?>" ppt-border1>
                <figure style="min-height:150px;" class="<?php if($i == 1){  ?>selecteddesign<?php } ?>" >
                
                <img data-src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="img">
                  
                  
                  <div class="read_more" > <a href="<?php echo home_url(); ?>/?design=<?php echo $h['key']; ?>" target="_blank"><span class="bg-dark text-white p-3"><i class="fal fa-search"></i> <?php echo __("View Design","premiumpress"); ?></span></a> </div>
                   
                   
                </figure> 
              
              
            <div class="py-2  text-left" style="border-top:1px solid #efefef;">
            
              
              <div class="divtxt small text-uppercase mr-2 text-danger mb-2 mt-1 float-right text-danger font-weight-bold" style="opacity:0.6"><?php if($i == 1){  ?>selected design<?php } ?></div>
              
            
            <input type="radio" name="install_template" class="ml-3" onclick="changeselectedesign('<?php echo $h['key']; ?>');" value="<?php echo $h['key']; ?>"  <?php if($i == 1){  ?>checked=checked<?php } ?>/>
                        
            </div>
            
        
              
              </div>
            </div>
         
                <?php } ?>
            <?php } ?>
           
          </div>            
                            
                        
                            
                            
                            
                            
                            
                            
						</div>

						<div class="introbox__actions introbox__content--narrow text-center">
							
                            <a href="javascript:void(0);" onclick="switchpage(3);" class="button button-primary button-hero btn-primary">Continue</a>
                            
                            <a  href="javascript:void(0);" onclick="switchpage(1);" class="button button-secondary button-hero">Go Back</a>
                           
                            
						</div>
                    
                    
                    
                    
                    </div>     
                    
                    
                    
                    
                
                
                <?php /*
                
                
                <div class="step-box" id="step3" style="display:none;">
                    
                    
                    <div class="introbox__content--narrow">
							<h3>Choose a website design.</h3>
							<p>You can customize and/or change design at anytime.</p>
						</div>

						<div class="introbox__video">
                        
                        
                    asdasd
                     
                     
                     </div> 
                     
                     
                     
                        
                        	<div class="introbox__actions introbox__content--narrow text-center">
							
                            <a href="javascript:void(0);" onclick="switchpage(3);" class="button button-primary button-hero btn-primary">Continue</a>
                            
                            <a  href="javascript:void(0);" onclick="switchpage(2);" class="button button-secondary button-hero">Go Back</a>
                            
							</div>  
                    
                    
                     </div>  
					 
					 */ ?>   
                        
                        
					</div>
				</div>
			</div>


<input type="hidden" name="" id="selecteddesignname" value="<?php echo $defaultthemeis; ?>" />
<script>

function changeselectedesign(key){

	jQuery('.selecteddesign').removeClass('selecteddesign');
	
	jQuery('.design_'+key+' figure').addClass('selecteddesign');
	
	
	jQuery('.divtxt').html('');
	
	jQuery('.design_'+key+' .divtxt').html('selected design');
	
	jQuery("#selecteddesignname").val(key);

}

function switchpage(pageid){

	jQuery(".step-box").hide();
	 
	jQuery("#step"+pageid).show();
 
	if(pageid == 3){
	
	jQuery(".introbox").hide();
	
	window.location.href = "<?php echo home_url(); ?>/wp-admin/admin.php?page=design&defaultdesign="+jQuery("#selecteddesignname").val();
	}
	 

}

</script>
<style>

.selecteddesign { border:2px solid red; }

.introbox {
  max-width: 900px;
  padding: 2.5em 0;
  margin: auto;
  text-align: center; }
  .introbox__header {
  line-height: 50px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1); }
   
  .introbox__title {
    padding: 0 15px;
    font-weight: 600;
    text-transform: uppercase;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center; }
  .introbox__skip {
    border-left: 1px solid #eee;
    font-size: 16px;
    color: inherit; }
    .introbox__skip i {
      padding: 15px; }
  .introbox__content {
    padding: 50px; }
    .introbox__content h2 {
      font-size: 2em;
      margin-top: 0; }
  .introbox__content--narrow {
    max-width: 500px;
    margin: auto; }
  .introbox__video {
    margin: 40px 0 60px; }
    .introbox__video iframe {
      -webkit-box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.15);
              box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.15); }
  .introbox__actions .button-primary {
    margin-right: 20px; }
</style>            
<?php _ppt_template('framework/admin/footer' ); ?>
