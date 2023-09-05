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
 
 
global $settings, $CORE;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
  $settings = array(
  
  "title" => __("Search Analaytics","premiumpress"), 
  "desc" => __("Here you can preview recent search data.","premiumpress")."<br><br><br><span class='badge badge-success'>Beta Test</span> This section is currently under beta testing. More options to come in future updates.", 
  "back" => "overview"
  
  );
  
   _ppt_template('framework/admin/_form-wrap-top' );
  
   // GET DATA
   $data = get_option('ppt_search_data');
 
   
    ?>

<div class="card"> 
<div class="card-body">
  <div style=" min-height:500px; max-height:1000px;overflow:hidden;     overflow-y: scroll;"> 
	<?php 
    
    if(is_array($data)){
	
	$data = array_reverse($data);
	
    $i=1;
	foreach($data as $ip_address => $d){ ?> 
    
    <div class="row mb-2 pb-2 border-bottom">
    
        <div class="col-md-4">
        
            <div class="d-flex">
                <div style="height:50px; width:50px;" class="mr-2 bg-light position-relative">
               
                <?php if( is_numeric($d['user']) && $d['user'] > 0 ){ ?>
                <a href="admin.php?page=members&eid=<?php echo $d['user']; ?>">
                <div class="bg-image" data-bg="<?php echo $CORE->USER("get_avatar",$d['user']); ?>"></div> 
                </a>
                <?php } ?>
                
                </div>
                <div class="small">
                    
                    <div class="text-600"><?php if( is_numeric($d['user']) && $d['user'] > 0 ){ echo $CORE->USER("get_username",$d['user']); }else{ ?> guest <?php } ?></div>
                    <div class="tiny"><?php echo $ip_address; ?> <?php if(isset($d['country'])){ ?> <?php echo $d['country_name']; ?> <?php } ?></div>
                   
                   
                    
                    
                </div>
            </div>
            </div> 
            
            <div class="col-md-4">
            <div class="tiny">First Search</div>
            
             <div class="small"><?php echo hook_date($d['date']); ?></div>
             
              
              <?php if(isset($d['updated'])){ ?>
               
                <div class="tiny mt-2">Recent Search</div>
                <div class="small"><?php echo hook_date($d['updated']); ?></div>
                <?php } ?>
             
            </div>
            
            <div class="col-md-4">
            
            <a href="javascript:void(0);" onclick="jQuery('#search<?php echo $i; ?>').toggle();" class="btn btn-system"><?php echo count($d['data']); ?> Searches </a>
            
            
            </div>
        
        
        
    </div>
    
     <textarea style="width:100%; height:100px; font-size:11px; display:none" id="search<?php echo $i; ?>"><?php print_r($d['data']); ?></textarea>
           
     
    <?php $i++; } } ?>
</div>
 
    <div class="container px-0 border-bottom mb-3">
      <div class="row py-2">
        <div class="col-md-8 pr-lg-5">
          <label><?php echo __("Enable Search Analytics","premiumpress"); ?></label>
          <p class="text-muted"><?php echo __("Turn ON to start recording search data.","premiumpress"); ?></p>
        </div>
        <div class="col-md-2">
          <div class="mt-4 formrow">
            <label class="radio off">
            <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('analytics').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('analytics').value='1'">
            </label>
            <div class="toggle <?php if(_ppt(array('search', 'analytics' )) == '1'){  ?>on<?php } ?>">
              <div class="yes">ON</div>
              <div class="switch"></div>
              <div class="no">OFF</div>
            </div>
          </div>
          <input type="hidden" id="analytics" name="admin_values[search][analytics]" value="<?php echo _ppt(array('lst', 'analytics' )); ?>">
        </div>
      </div>
    </div>
<div>
<input type="checkbox" name="resetlogs" value="1" /> reset logs
</div> 
 

    <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Changes","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
  

<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?>