<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $settings, $CORE; 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 $settings = array(
  
  "title" => __("Quick Setup","premiumpress"), 
  "desc" =>  __("Here you can see all enabled banner slots. Simply enter the HTML code you want to be displayed.","premiumpress"),
  
  //"doclink" => "https://www.premiumpress.com/docs/advertising/",
 
  "back" => "overview",
  );
   _ppt_template('framework/admin/_form-wrap-top' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<div class="card card-admin">
  <div class="card-body"> 

<?php foreach($CORE->ADVERTISING("get_spaces", array("enabled") ) as $key => $ban){ ?>
 
<a href="javascript:void(0);" class="_admin_iconbox icon-box" onclick="jQuery('.banner-<?php echo $key; ?>').toggle();">
 

<img src="<?php echo $ban['icon']; ?>" class="img-fluid" style="max-width:50px; float: left;    margin-right: 20px;" />

<strong><?php echo $ban['n']; ?></strong>
<p>default size <?php echo $ban['sw']; ?>x<?php echo $ban['sh']; ?>px</p></a> 
 

<div style="display:none" class="banner-<?php echo $key; ?>">
<textarea class="form-control" style="height:150px; font-size:12px; margin-top:10px" placeholder="enter code here.."  name="admin_values[quick_banner][<?php echo $key; ?>]"><?php echo _ppt(array("quick_banner", $key)); ?></textarea>
</div>
<?php } ?>
              
              
      <div class="p-4 bg-light text-center mt-4">
      <button type="submit" data-ppt-btn class="btn-primary"><?php echo __("Save Settings","premiumpress"); ?></button>
    </div>
    
  </div>
</div>
<!-- end admin card --> 
 
<!-- end admin card -->
<?php _ppt_template('framework/admin/_form-wrap-bottom' ); ?> 