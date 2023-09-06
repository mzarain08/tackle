<?php
global $settings;
?>

            <form class="ppt-search-short rounded" method="get" action="<?php echo home_url(); ?>">
              <div class="hero-search-field">
                <div class="form-group">
                  <div class="input-group-wrapper">
                    <span class="input-group-label d-flex align-items-center "> <?php echo __("Find","premiumpress"); ?>: </span>
                   
                       
                      <input type="input" class="form-control" name="s" value="" placeholder="<?php echo __("e.g. shop, restaurant..","premiumpress"); ?>" />
                      
                    
                  </div>
                </div>
                <div class="main-search-results">
                </div>
              </div>
              <div class="hero-search-field">
                <div class="form-group">
                  <div class="input-group-wrapper position-relative">
                    <span class="input-group-label d-flex align-items-center w-100"> <?php echo __("Near","premiumpress"); ?>:
                    
                    <div class="ml-2 w-100"><input type="input" class="form-control" name="s" value="" placeholder="<?php echo __("London Airport","premiumpress"); ?>" /></div>
                  
                    
                  </div>
                </div>
              </div>
              <button data-ppt-btn class="btn-secondary ml-md-n2 rounded-0 text-uppercase font-weight-bold" style="z-index:1;" type="submit"><?php echo __("Search","premiumpress"); ?></button>
            </form>