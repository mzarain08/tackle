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

global $CORE_UI;
 
// SAVE CUSTOM FIELD DATE  
$regfields = get_option("regfields"); 

 
if(!is_array($regfields)){ $regfields = array(); }  
  
?>
 

<div ppt-flex-end>

<a href="javascript:void(0);" onClick="jQuery('#regfield-list li').hide();jQuery('#regfield-list-new').clone().appendTo('#regfield-list');jQuery(this).hide();" data-ppt-btn class="btn-primary btn-md shadow-sm"><?php echo __("Add Field","premiumpress"); ?></a>


</div>



<hr />
 
  <ul id="regfield-list">
    <?php 

 
if(is_array($regfields) && !empty($regfields['name']) ){ $i=0; 

 
foreach($regfields['name'] as $data){ 

	if( strlen($regfields['name'][$i]) > 1 ){  ?>
    <li class=" closed " id="rowid-<?php echo $i; ?>">
    
    
    
    
    
    
  <div class="w-100 rounded  mb-3 shadow-0" ppt-box>

    <div class="_header" ppt-flex-row>
    
    <a href="#" onclick=" showvalue<?php echo $i; ?>(jQuery('#ftype-<?php echo $i; ?>').val(),'#values-<?php echo $i; ?>'); jQuery('.cf-<?php echo $i; ?>').fadeToggle();" class="text-dark">
        <div class="_title w-100">
        
        <?php echo stripslashes($regfields['name'][$i]); ?> <?php if(isset($regfields['required'][$i]) && $regfields['required'][$i] == "yes"){ ?><span class="required text-red">*</span><?php } ?> 
        
        </a> 
        
       </div> 
      
      
        <div class="_close grab">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['grab']; ?></div>
        </div> 
        
        <div class="_close" onClick="deleteField(<?php echo $i; ?>);">
            <div ppt-icon-24 data-ppt-icon-size="24"><?php echo $CORE_UI->icons_svg['close']; ?></div>
        </div>
         
    </div> 

</div>   
    
    
    
   
      
      <div class="inside cf-<?php echo $i; ?> p-3 ppt-forms style3 mb-4" ppt-border1>
        <label class="txt500"><?php echo __("Title","premiumpress"); ?> <span class="required">*</span></label>
        <input type="text" name="regfields[name][]" id="title-<?php echo $i; ?>" value="<?php echo stripslashes($regfields['name'][$i]); ?>" class="form-control stopclean"  />
        <div class="row my-3">
          <div class="col-md-6  mt-4">
            <label class="txt500"><?php echo __("Field Type","premiumpress"); ?></label>
            <select name="regfields[type][]" id="ftype-<?php echo $i; ?>" class="form-control stopclean" onchange="showvalue<?php echo $i; ?>(this.value,'#values-<?php echo $i; ?>')">
              <option value="input" <?php if($regfields['type'][$i] == "input"){ echo "selected=selected"; } ?> ><?php echo __("Input Field","premiumpress"); ?></option>
              <option value="textarea" <?php if($regfields['type'][$i] == "textarea"){ echo "selected=selected"; } ?>><?php echo __("Text Area","premiumpress"); ?></option>
              <option value="checkbox" <?php if($regfields['type'][$i] == "checkbox"){ echo "selected=selected"; } ?>><?php echo __("Checkbox","premiumpress"); ?></option>
              <option value="radio" <?php if($regfields['type'][$i] == "radio"){ echo "selected=selected"; } ?>><?php echo __("Radio Button","premiumpress"); ?></option>
              <option value="select" <?php if($regfields['type'][$i] == "select"){ echo "selected=selected"; } ?>><?php echo __("Selection Box","premiumpress"); ?></option>
               
             
            </select>
            <script>
			  
			  function showvalue<?php echo $i; ?>(val, div){
					if(val == "checkbox" || val =="radio" || val == "select" ){
						jQuery(div).show();
					} else {
						jQuery(div).hide();
					}
				}
				
 
			  
			  </script>
          </div>
          <div class="col-md-6  mt-3">
            <label class="txt500"><?php echo __("Unique Database Key","premiumpress"); ?> <span class="required">*</span> </label>
            <input type="text" name="regfields[key][]" id="key-<?php echo $i; ?>" value="<?php echo trim($regfields['key'][$i]); ?>" class="form-control stopclean"  />
            <p class="text-muted py-2 mb-0 pb-0"><?php echo __("No spaces or special characters","premiumpress"); ?>.</p>
          </div>
        </div>
        <div style="display:none;" id="values-<?php echo $i; ?>">
          <label class="txt500"><?php echo __("Field Values (one per row)","premiumpress"); ?> <span class="required">*</span></label>
          <textarea name="regfields[values][]" style="width:100%; height:150px !important;" class="form-control stopclean"><?php 
		
		if(isset($regfields['values'][$i]) && in_array($regfields['type'][$i], array("checkbox","radio","select"))){ echo stripslashes($regfields['values'][$i]); } 
		
		
		?>
</textarea>
        </div>
      
        <div class="row  my-3">

          <div class="col-md-6">
            <label class="txt500"><?php echo __("Show on Registration Form","premiumpress"); ?></label>
            <div class="formrow">
              <label class="radio off">
              <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('rfield-signup-<?php echo $i; ?>').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('rfield-signup-<?php echo $i; ?>').value='1'">
              </label>
              <div class="toggle <?php if(isset($regfields['signup'][$i]) && $regfields['signup'][$i] == '1'){  ?>on<?php } ?>">
                <div class="yes">ON</div>
                <div class="switch"></div>
                <div class="no">OFF</div>
              </div>
            </div>
            <input type="hidden" id="rfield-signup-<?php echo $i; ?>" name="regfields[signup][]"
                                 value="<?php if(isset($regfields['signup'][$i])){ echo $regfields['signup'][$i]; } ?>" class="stopclean">
          </div>
                    <div class="col-md-6">
            <label class="txt500"><?php echo __("Required Field","premiumpress"); ?></label>
            <div class="formrow">
              <label class="radio off">
              <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('rfield-equired-<?php echo $i; ?>').value='0'">
              </label>
              <label class="radio on">
              <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('rfield-equired-<?php echo $i; ?>').value='1'">
              </label>
              <div class="toggle <?php if(isset($regfields['required'][$i]) && $regfields['required'][$i] == '1'){  ?>on<?php } ?>">
                <div class="yes">ON</div>
                <div class="switch"></div>
                <div class="no">OFF</div>
              </div>
            </div>
            <input type="hidden" id="rfield-equired-<?php echo $i; ?>" name="regfields[required][]"
                                 value="<?php if(isset($regfields['required'][$i])){ echo $regfields['required'][$i]; } ?>">
          </div>
        </div>
        <div class="row">
        
          <input type="hidden" name="regfields[tax_name][]" value="" class="stopclean"/>
     
          <?php if($regfields['type'][$i] == "post_type"){  $taxs = get_taxonomies();  ?>
          <div class="col-6">
            <label class="txt500"><?php echo __("Select Post Type","premiumpress"); ?></label>
            <select name="regfields[posttype_name][]" class="form-control">
              <?php
		
		
		$selected = $regfields['posttype_name'][$i];
		
		foreach ( get_post_types('', 'names') as $post_type ) {
							
			$display_text = $post_type;
							
       		printf( '<option value="%1$s"%2$s>%3$s</option>', $post_type, selected( $selected, $post_type, false ), $display_text );
       
	    }
       
	    ?>
            </select>
          </div>
          <?php }else{ ?>
          <input type="hidden" name="regfields[tax_name][]" value="" class="stopclean" />
          <?php } ?>
        </div>
        <!-- end row -->
      </div>
    </li>
    <?php $i++; } ?>
    <?php } ?>
    <?php } ?>
  </ul>

<script>


 
jQuery(document).ready(function() {	
 
	
	jQuery( "#regfield-list" ).sortable({
                   revert       : true,
                   connectWith  : ".sortable",
				    
					handle: ".grab",
				   placeholder: "panel-placeholder",
				    
					
					
	stop: function( ) { 
				
			
				   jQuery('<input>').attr({
                        			type: 'hidden',            			
                        			name: 'updatefields',
                        			value: 1,
                        		}).appendTo('#customfieldlist'); 
								  
			
			
			},start: function(event, ui){
			
			var classes = ui.item.attr('class').split(/\s+/);
			for(var x=0; x<classes.length;x++){   
				if (classes[x].indexOf("col")>-1){
				ui.placeholder.addClass(classes[x]);
			  }
			}
			  
			 ui.placeholder.css({      
			  width: ui.item.innerWidth() - 30 + 1,
			  height: ui.item.innerHeight() - 15 + 1,     
			  padding: ui.item.css("padding"),
			  marginTop: 0
			});       
		  }
					
					
					
                });  
				
            
});
   
 

function deleteField(id){

	if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>")) {
	
	 jQuery('#title-'+id).val(''); 
	 jQuery('#rowid-'+id).hide();
		
		setTimeout(function(){ 
				 	
			jQuery('#field'+id).html('');				
				
		}, 3000); 
	
	}

}

function showvalue(val, div){
	if(val == "checkbox" || val =="radio" || val =="select" ){
		jQuery(div).show();
	} else {
		jQuery(div).hide();
	}
}
 
function checknotblank(){
if(jQuery('#nfaqt1').val() == ""){  jQuery('#nfaqt1').val(' '); }
}
</script>