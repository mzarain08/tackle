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
 
 
?><div class="py-4 bg-white">

   <div class="container">
      <div class="row">
         <div class="col-md-3 border-right">
           
            <?php
               $count = 1;
               $cats = get_terms( 'listing', array( 'hide_empty' => 0, 'parent' => 0  ));
               if(!empty($cats)){
               ?>
            <select class="form-control" name="mass-cat" id="mass-cat">
            <option value=""><?php echo __("Change Category","premiumpress"); ?></option>
               <?php
                  foreach($cats as $cat){ 
                  
                   
                  ?>
               <option value="<?php echo $cat->term_id; ?>"><?php if($cat->parent != 0){ echo "-- "; } ?> <?php echo $cat->name; ?></option>
               <?php $count++; } ?>
            </select>
            <?php } ?>         
         </div>
         <div class="col-md-3 border-right"> 
         <?php if( $CORE->LAYOUT("captions","listings") ){ ?>
          
             
            <select class="form-control" name="mass-pak" id="mass-pak">
               <option value=""><?php echo __("Change Package","premiumpress"); ?></option>
               <?php foreach(  $CORE->PACKAGE("get_packages", array() ) as $k => $n){  ?>
               <option value="<?php echo $k; ?>"><?php echo $n['name']; ?></option>
              <?php } ?>
                
            </select>
            <?php }else{ ?>
            <input type="hidden"name="mass-pak" id="mass-pak" value="0">
            <?php } ?>
            
            
        
            
           
          
         </div>
         <div class="col-md-3 ">  
         
           
 <select class="form-control" name="mass-status" id="mass-status">
               <option value=""><?php echo __("Change Status","premiumpress"); ?></option>
               <option value="publish"><?php echo __("Live","premiumpress"); ?></option>
               <option value="pending"><?php echo __("Pending","premiumpress"); ?></option>
               <option value="trash"><?php echo __("Delete","premiumpress"); ?></option>
                
            </select>
       
  
         </div>
         <div class="col-lg-3">
          
        <button class="btn-system  btn-block" data-ppt-btn type="button" onclick="ajax_massupdate_listings();"><?php echo __("Update","premiumpress"); ?> </button>
        
         </div>
        
      </div>
   </div>
   <a href="javascript:void(0);" onclick="jQuery('#actionsbox').hide();" class="float-right btn-sm btn-dark text-light rounded-0"><?php echo __("hide me","premiumpress"); ?></a>

</div>