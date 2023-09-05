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

global $post, $CORE, $userdata;

$GLOBALS['flag-edit-block'] = 1;

$pageID = $_POST['catid'];

$g = $CORE->LAYOUT("load_all_by_cat", $pageID);

		if(in_array($pageID, array('text','icon','listings','header','footer','cta','contact','video','faq','hero'))){
			$order = array_column($g, 'order'); 
   			array_multisort( $order, SORT_ASC, $g);
		}



?>
<div style="max-height:600px; overflow-y:scroll"><div class="container"><div class="row">
<?php foreach($g as $tid => $g){ 

if(!isset($g['widget'])){ continue; }

?>

<div class="col-md-6">
        <div class="position-relative border blocktype <?php echo $pageID; ?> shadow-sm" style="min-height:100px;"> <a href="<?php echo home_url(); ?>/?s=&ppt_live_preview=1&tid=<?php echo $pageID; ?>&sid=<?php echo $tid; ?>" target="_blank"> 
          
          <img src="<?php echo $CORE->LAYOUT("get_block_prewview", $tid  ); ?>" class="img-fluid lazy w-100" /> 
          </a> 
          
          </div>
          <div class=" my-2 d-flex justify-content-between align-items-center">
            <div class="text-muted font-weight-bold text-uppercase small"> <?php echo $g['name']; ?> </div>
           
            <ul class="list-inline mb-0">
              <?php if(isset($_GET['smallwindow'])){ ?>
              <li class="list-inline-item"><a href="javascript:void(0);" class="btn btn-system btn-md" 
         onclick="setThisDesign('<?php echo $tid; ?>','<?php echo esc_attr($_GET['tid']); ?>');"><?php echo __("select design","premiumpress"); ?>  <i class="fa fa-angle-double-right mr-0 ml-2"></i> </a> </li>
              <?php }else{ /*?>
              <li>
                <button data-settingid="<?php echo $tid; ?>" data-pagekey="home" class="loadsettingsbox btn btn-system" type="button"><i class="fa fa-cog m-0"></i> <?php echo __("Settings","premiumpress"); ?></button>
              </li>
              <?php */ }  ?>
            </ul>
            
            
          </div>


<a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $pageID; ?>&sid=<?php echo $tid; ?>" target="_blank" class="btn btn-sm btn-system tiny font-weight-bold"><?php echo __("preview","premiumpress"); ?></a>

<a href="javascript:void(0);" onclick="saveThisDesign('<?php echo $tid; ?>');" class="btn btn-primary tiny font-weight-bold float-right"><?php echo __("select","premiumpress"); ?></a>

<hr />         
</div>
        

<?php } ?>
</div></div></div>
<script>

function saveThisDesign(tt){

<?php if($_POST['builder'] == 1){ ?>



load_ajax_blocks_builder(tt);


<?php }else{ ?>

<?php if($pageID == "header"){ ?>
jQuery("#header_style").val(tt);
<?php }elseif($pageID == "footer"){ ?>
jQuery("#footer_style").val(tt);
<?php } ?>

jQuery("#admin_save_form").submit();

<?php } ?>

}

</script>