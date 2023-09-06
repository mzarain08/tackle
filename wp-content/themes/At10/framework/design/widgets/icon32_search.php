<?php

global $CORE_UI, $CORE;

?>
      <div ppt-flex-between class="ppt-forms style3">
      
        <form action="<?php echo home_url(); ?>" class="position-relative" style="min-width:300px;">
          <div class="input-group">
            <input type="text" class="form-control rounded-pill pl-4 typeahead border-0" name="s" placeholder="<?php if(THEME_KEY == "cp"){ echo __("Store name or keyword..","premiumpress"); }else{ echo __("Keyword..","premiumpress"); } ?>" autocomplete="off">
          </div>
          <button class="iconbit icon-svg" type="submit" data-ppt-btn  style="width:60px; height:46px;"><div ppt-icon-24><?php echo $CORE_UI->icons_svg['search']; ?></div></button>
        </form>
 
 <div style="min-width:350px;">
        <div class="row no-gutters">
        	
          <?php if(in_array(THEME_KEY,array("cp","cb"))){ ?>
          <div class="col-md-3 text-center offset-md-2">
            <a href="<?php echo _ppt(array('links','stores')); ?>" class="text-decoration-none">
            
             <div ppt-icon-size="32" data-ppt-icon2><?php echo $CORE_UI->icons_svg['shopping-bag']; ?></div>
            
            <div class="small text-600 mt-1" data-ppt-f1a>
              <?php echo __("Stores","premiumpress") ?>
            </div>
            </a>
          </div>
          <?php }elseif(_ppt(array('lst','websitepackages')) == 1){ ?>
          <div class="col-md-3 text-center offset-md-2">
            <a href="<?php echo _ppt(array('links','add')); ?>" class="text-decoration-none">
            
             <div ppt-icon-size="32" data-ppt-icon2><?php echo $CORE_UI->icons_svg['add-circle']; ?></div>
            
            <div class="small text-600 mt-1" data-ppt-f1a>
              <?php echo __("Add New","premiumpress"); ?>
            </div>
            </a>
          </div>
          <?php } ?>
          
          <div class="col-md-3 text-center">
            <a href="<?php echo _ppt(array('links','categories')); ?>" class="text-decoration-none">
            
            
             <div ppt-icon-size="32" data-ppt-icon2><?php echo $CORE_UI->icons_svg['tag']; ?></div>
             
            <div class="small text-600 mt-1" data-ppt-f2a>
              <?php echo __("Categories","premiumpress") ?>
            </div>
            </a>
          </div>
          
          <div class="col-md-3 text-center">
            <a href="<?php echo _ppt(array('links','blog')); ?>" class="text-decoration-none">
            
             <div ppt-icon-size="32" data-ppt-icon2><?php echo $CORE_UI->icons_svg['rss']; ?></div>
            
            <div class="small text-600 mt-1" data-ppt-f3a>
              <?php echo __("Blog","premiumpress") ?>
            </div>
            </a>
          </div>
          
     </div>  
</div>
</div>