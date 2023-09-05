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
   
   global $CORE;
   
$canShowSidebar = 1;
if(isset($_GET['tid']) && $_GET['tid'] == "header_style"){
$canShowSidebar = 0;
}   
   
    ?>
 

<div class="row">

 
<?php if($canShowSidebar){ ?>
  <div class="<?php if(!isset($_GET['smallwindow'])){  ?>col-md-4 pr-lg-4 <?php }else{ ?>col-md-3 pl-4<?php } ?>">
    <?php if(!isset($_GET['smallwindow'])){  ?>
    <h3 class="mt-4 count-all"><?php echo __("All Blocks","premiumpress"); ?> <span></span> </h3>
    <p class="text-muted lead"><?php echo __("Here you can view all the design blocks integrated into this theme.","premiumpress"); ?></p>
    <?php } ?>
    <ul class="list-group list-group-flush mt-5 <?php if(!isset($_GET['smallwindow'])){  ?>pr-4 <?php } ?>">
      <?php 
	
	 
	$allblocks = $CORE->LAYOUT("get_block_types",array());
	  
	foreach($allblocks as $type){ 
	
	
	if(isset($_GET['pagekey']) && $_GET['pagekey'] == "home" && in_array($type['id'], array("header","footer"))){
	 continue;
	}
	 
	
	?>
      <li class=" mb-2 d-flex justify-content-between align-items-center border-bottom pb-2"> <a href="#" onclick="jQuery('.blocklist').hide(); jQuery('#blocklist-<?php echo $type['id']; ?>').show();jQuery('.lazy').trigger('appear'); tinyScroll();" class="text-dark"> <i class="<?php echo $type['icon']; ?> mr-2"></i> <?php echo $type['name']; ?> </a> <span class="badge badge-pill count-<?php echo $type['id']; ?>" style="background:#e43546;color:#fff;">0</span> </li>
      <?php } ?>
    </ul>
    <script>
               jQuery(document).ready(function(){ 
               
               jQuery('.count-all span').html( '('+jQuery('.blocktype').length+')');
			    
			   <?php foreach($CORE->LAYOUT("get_block_types",array()) as $type){ ?>
               jQuery('.count-<?php echo $type['id']; ?>').html( jQuery('.<?php echo $type['id']; ?>').length); 
               <?php } ?>
               
               
               });
       </script>
  </div>
  <?php } ?>
  <div class="col">
    <div class="card card-admin">
      <div class="card-body">
        <?php 
 
 $i=1; foreach($CORE->LAYOUT("get_block_types",array()) as $type){ 
 
 
 if(isset($_GET['pagekey']) && $_GET['pagekey'] == "home" && in_array($type['id'], array("header","footer"))){
	 continue;

}
 
 ?>

        <div id="blocklist-<?php echo $type['id']; ?>" class="blocklist "  <?php if($i != 1){ ?>style="display:none;"<?php } $i++; ?>> <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $type['id']; ?>" target="_blank" class="btn btn-system  mt-n2 float-right btn-md "><?php echo __("Preview All","premiumpress"); ?> <i class="fa fa-search mr-0 ml-2"></i> </a>
          
          
          <h4><?php echo $type['name']; ?></h4>
            <hr />
<div class="row">
          
        
          <?php 
	   
	   // GET DATA
		$g = $CORE->LAYOUT("load_all_by_cat", $type['id']);
			
		if(in_array($type['id'], array('text','icon','listings','header','footer','cta','contact','video','faq','hero'))){
			$order = array_column($g, 'order'); 
   			array_multisort( $order, SORT_ASC, $g);
		}
	   
	   
	   foreach($g as $tid => $g){
	   if(!isset($g['widget'])){ continue; }
	   if(isset($g['copy'])){ continue; }
	   
	    
	   if($tid == "hero_map1" && _ppt(array('maps','enable')) != 1){
	   continue;
	   } 
	   
	   if($tid == "listingpage_openinghours" && THEME_KEY != "dt"){
	   continue;
	   } 
	   
	   if(in_array($tid, array("header13a","listing10a")) && THEME_KEY != "cp"){
	   continue;
	   } 
	   
	   if(in_array(THEME_KEY, array("da","at")) && substr($tid,0,12) == "listingpage_" && substr($tid,0,15) != "listingpage_new"){
	   
	   continue;
	   }
	   
	   
	   if(strpos(strtolower($g['name']),"test")  !== false){ continue; }
	   
	   
	   ?>
       <div class="col-md-6">
          <div class="position-relative border blocktype <?php echo $type['id']; ?> " style="min-height:100px;"> <a href="<?php echo home_url(); ?>/?ppt_live_preview=1&tid=<?php echo $type['id']; ?>&sid=<?php echo $tid; ?>" target="_blank"> 
          
          <img <?php if(!isset($_GET['smallwindow'])){ ?>data-<?php } ?>src="<?php echo $CORE->LAYOUT("get_block_prewview", $tid  ); ?>" class="img-fluid lazy w-100" /> 
          </a> 
          
          </div>
          <div class=" my-2 d-flex justify-content-between align-items-center">
          
         
          
            <div class="text-muted font-weight-bold text-uppercase small"> <?php echo $g['name']; ?> </div>
           
            <ul class="list-inline mb-0">
              <?php if(isset($_GET['smallwindow'])){ ?>
              <li class="list-inline-item"><a href="javascript:void(0);" class="btn btn-system  btn-md" 
         onclick="setThisDesign('<?php echo $tid; ?>','<?php echo esc_attr($_GET['tid']); ?>');"><?php echo __("select design","premiumpress"); ?>  <i class="fa fa-angle-double-right mr-0 ml-2"></i> </a> </li>
              <?php }elseif(defined('ELEMENTOR_VERSION')){ ?>
                 <li class="list-inline-item">
          
          	 		<a href="<?php echo home_url(); ?>/wp-admin/admin.php?inner=ppt_builder&page=design&loadpage=new&pname=Single+Block+Edit+<?php echo $tid; ?>&markspagebuilder=<?php echo $tid; ?>---" target="_blank" class="float-right"><i class="fab fa-elementor"></i> </a>
      
          
              <?php } ?>
            </ul>
            
            
          </div>
          <hr /></div>
          <?php } ?>
        </div></div>
        <?php } ?>
      </div> 
    </div>
  </div>
</div>