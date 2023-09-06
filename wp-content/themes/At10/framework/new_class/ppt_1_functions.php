<?php


 
function ppt_theme_pricingtable($type){

global $CORE, $userdata;

$pricing_data = array();

$color_primary = _ppt(array('design','color_primary'));
			if( $color_primary == ""){
			    $color_primary = "#2775d3";
			}

	if($type == "packages"){
		 
		
			$paknames = array( __("Basic","premiumpress") , __("Standard","premiumpress") , __("Premium","premiumpress") );
 			 
			foreach(  $CORE->PACKAGE("get_packages", array() ) as $k => $n){ 
			 	
			  // WORK OUR DAYS
			  $DAYS = _ppt('pak'.$n['key'].'_duration');
			  if($DAYS == ""){ $DAYS =0; }
			   
			  // TUN OFF DURATION FOR AUCTION THEME
			  if(THEME_KEY == "at" && _ppt(array('lst','auction_time')) != '1' ){
			  $DAYS = 0;
			  }
			  
			  $daytext = ""; 
			  switch($DAYS){				
				  case "1": {
					  $daytext = "24 ".__("Hours","premiumpress");
				  } break;
				  case "7": {
					  $daytext = "1 ".__("Week","premiumpress");
				  } break;
				  case "30": {
				  	$daytext =  "1 ".__("Month","premiumpress");
				  } break;
				  case "365": {
				  	$daytext =  "1 ".__("Year","premiumpress");
				  } break;
				  default: { 				  
					  if(is_numeric($DAYS) && $DAYS > 0){
					  $daytext = $DAYS." ".__("Days","premiumpress");
					  }else{
					   $daytext = "";
					  }
				  }
			   } 
			   
			   // DAY  TEXT
			   if(strlen($daytext) > 0){
			   $daytext = __("Live for","premiumpress")." ".$daytext;
			   } 
			   
				// PACKAGE
				$pricing_data[] = array(
						
						'id' 		=> $n['key'], 	
						'title' 	=>  $CORE->GEO("translate_pak_name", array( stripslashes(_ppt('pak'.$n['key'].'_name')), $n['key'])  ),
						'desc' 		=> $CORE->GEO("translate_pak_desc", array( stripslashes(_ppt('pak'.$n['key'].'_desc') ), $n['key']) ),
						
						'subtitle' 	=> $daytext,
						'price' 	=> $n['price'],
						'price_text' => $n['price_text'],
						
						'paycode' 	=> _ppt('pak'.$n['key'].'_key'),
						 
						'active' => _ppt('pak'.$n['key'].'_highlight'),
					 	
						'features' 	=> $CORE->PACKAGE("get_features_array", array($n['key'],"pak") ),	
						
						'button' => $CORE->PACKAGE("get_continue_button", $n['key'] ),
						
						"icon" => _ppt('pak'.$n['key'].'_icon'),						
						"color_primary" => $color_primary,
						
				);
				 
			 
			}// end while
		
		
		// SELLSPACE ****************************************
		/* **************************************************/
		

	}elseif($type == "advertising"){
			
			$sellspacedata 	= _ppt('sellspace');		
			$sellspace 		= $CORE->ADVERTISING("get_spaces", array() );
			
			if(is_array($sellspace) && !empty($sellspace)){ 
				
				foreach($sellspace as $key => $sp){ 
				
					// CHECK IF ENABLED
					if(!isset($sellspacedata[$key]) || isset($sellspacedata[$key]) && $sellspacedata[$key] != 1){ continue; } 
				
				 	// WORKOUT PRICE
					 $price = $sellspacedata[$key."_price"];
					 $price = hook_price(array($price,0));
					 
					 if(is_numeric($price) && $price > 0 ){
					  		$price_txt = $price;
					 }else{
					 		$price_txt = __("Free","premiumpress");
					 }
				
					$subtitle = stripslashes($sellspacedata[$key."_days"])." ". __("days","premiumpress"); 
					
					// PAY CODE
					$paycode =  $CORE->order_encode(array(  
					               
						  "uid" 			=> $userdata->ID,                
						  "amount" 			=> $price,
						  "order_id" 		=> "BAN-".$key."-".$userdata->ID."-".rand(),                
						  "description" 	=> stripslashes($sellspacedata[$key."_name"]), 
						  "paycode" => "",              
					));
					  
					$pricing_data[] = array(
					
						'title' 	=> stripslashes($sellspacedata[$key."_name"]),
						'subtitle' 	=> $subtitle,
						'price' 	=> $price_txt,
 
						'paycode' 	=> $paycode,
						'features' 	=> array( 1 => array("name" =>  stripslashes($sellspacedata[$key."_desc"]), "text" => 1 ) ),
						'button' 	=> $CORE->ADVERTISING("get_continue_button", $key ),
						
						"icon" 		=> $sp['icon'],						
						"color_primary" => $color_primary,
						
					);		 
					
				
				}
			
			}
		
		// MEMBERSHIPS **************************************
		/* **************************************************/

		}else{		
		  
		  // DONT SHOW SUBSCRIBED PACKAGES
			$dontshowkey = "";
			if($userdata->ID ){							 
				$cm			= get_user_meta($userdata->ID,'ppt_subscription'); 		 
				if(is_array($cm) && isset($cm[0]) && _ppt($cm[0]['key'].'_repurchase') == "0" && !is_admin() ){					 
					$dontshowkey = $cm[0]['key'];
				}	
			}
		  
		 	
		foreach(  $CORE->USER("get_memberships", array() ) as $k => $n){  
				 
					$button = $CORE->USER("get_membership_continue_button", $n['key'] );
					if($dontshowkey == $n['key'] || $dontshowkey == "mem".$n['key']){					
						$button = "existing";
					}
			 
					// PACKAGE
					$pricing_data[] = array(
							
							'id' 		=> $n['key'], 	
							'title' 	=> $CORE->GEO("translate_mem_name", array( stripslashes(_ppt('mem'.$n['key'].'_name')), $n['key'])  ),
							'desc' 		=> $CORE->GEO("translate_mem_desc", array( stripslashes(_ppt('mem'.$n['key'].'_desc') ), $n['key']) ),
							'subtitle' 	=> "",
							'price' 	=> $n['price'],
							'price_text' => $n['price_text'],
							'recurring' => _ppt('mem'.$n['key'].'_r'),						
							'features' 	=> $CORE->PACKAGE("get_features_array", array($n['key'], "mem") ),						
							'active' 	=> _ppt('mem'.$n['key'].'_highlight'),
							'button' 	=> $button,
							"icon" 		=> _ppt('mem'.$n['key'].'_icon'),
							
							'paycode' =>  $n['key'],
							
							"color_primary" => $color_primary,
							
					); 
		
		 } 
		
		}


return $pricing_data;

}





 ///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_clean_databasecode($new_result){


$bak = $new_result;
$new = array();



// CLEANUP ARRAY
if( is_array($new_result)){

	// BASIC CLEAN
	foreach($new_result as $c => $cc){ 
		if(!in_array($c,array("pageassign")) && ( is_numeric($c) || $cc == "" )){
			unset($new_result[$c]);
		}
	}
	
	// SEO
	if(isset($new_result['seo']) && !empty($new_result['seo'])){	
	 	foreach($new_result['seo'] as $sk => $sv){ 			
			if($sv == ""){
			unset($new_result['seo'][$sk]);
			}
		}	
	}
	
	// DESIGN
	if(isset($new_result['design']) && !empty($new_result['design'])){	
	 	foreach($new_result['design'] as $dk => $dv){ 			
			if($dv == ""){
			unset($new_result['design'][$dk]);
			}
		}	
	}
	
	// BGIMAGE
	if(isset($new_result['bgimg']) && !empty($new_result['bgimg'])){	
	 	foreach($new_result['bgimg'] as $bgk => $bgv){ 			
			if($bgv == ""){
			unset($new_result['bgimg'][$bgk]);
			}
		}	
	}
	
	// LOOP PAGES AND IF WE HAVE ELEMENTOR COPY
	// DROP THE DEFAULT DATA
	foreach(array("faq","aboutus","testimonials","how","memberships","stores","categories","contact","terms","privacy","add","home") as $k){		
		if(strlen(_ppt(array('pageassign',$k))) > 1){			
			if(isset($new_result[$k])){
			unset($new_result[$k]);			
			}	
		}	
	}
	
	// NEW FOOTER
	if(isset($new_result['newfooter']) && !empty($new_result['newfooter'])){	
	 	foreach($new_result['newfooter'] as $k => $v){ 			
			if($v == ""){
			unset($new_result['newfooter'][$k]);
			}
		}	
	} 
	
} 

return $new_result;


}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 


function _button_wink(){ global $CORE, $userdata;
	
	  if(!$userdata->ID){ 
       
       return 'href="javascript:void(0);" onclick="processLogin();"'; 
         
       }else{ 
       
       return 'href="javascript:void(0);"  onclick="winkshow();"';
 
       } 
	
	}

function BlurImages($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
	
    return array_slice($numbers, 0, $quantity);
	
} 

function ppt_theme_card_data_output($ShowdataKey = "mobile", $elementor_data = ""){ global $CORE, $CORE_UI, $post, $userdata;

$elementor = 0;
$fieldsData = ppt_theme_card_data('defaults');

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 

if(is_array($elementor_data) && !empty($elementor_data)  ){
 
	$elementor = 1;
  	$oldF = $fieldsData;
	$newF = array();
	foreach($elementor_data as $k){
		if(isset($oldF[$k])){
			$newF[$k] = $oldF[$k];
		}
	}
	$fieldsData = $newF;
	 
	 
}else{

	foreach($fieldsData as $k => $v){
		 
		if(!isset($v['show']) || ( isset($v['show']) && !in_array($ShowdataKey, $v['show'] )) ){
			unset($fieldsData[$k]);
		}
	}
	
	if(!empty($fieldsData)){
	$fieldsData = $CORE->multisort($fieldsData, array('order'));
	}
}
 

$i=1;  
 
ob_start();
if(!empty($fieldsData)){?>
<ul>
	<?php foreach($fieldsData as $k => $v){
	 
	
	$label = "";
	$value = $v['data'];
	
	if($elementor == "1" && $value == ""){
		if(isset($v['example'])){
		$value = $v['example'];
		}elseif(is_admin()){
		$value = "{user data}";
		}
	}	 
	
	
	if($value == "" && $label == ""){ continue; }
	if(strpos(strtolower($value), "no category") !== false ){ continue; }	
 
	?>
    <li data-list-k="<?php echo $k; ?>"  class="<?php if(isset($v['tooltip']) || isset($v['no-tooltip']) ){ ?>no-truncate<?php }else{ ?>text-truncate<?php } ?> <?php if($i > 3){ ?>hide-mobile<?php } ?>" <?php if(in_array($k,array("category"))){?>style="max-width: 150px;"<?php  } ?>>
    <?php if(isset($v['tooltip'])){ ?>             
 
        <div class="badge_tooltip text-center" data-direction="top">
            <div class="badge_tooltip__initiator"> 
               <span> 
			 
               <?php if(isset($v['icon-svg']) && isset($CORE_UI->icons_svg[$v['icon-svg']])){ ?> <span ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg[$v['icon-svg']];?></span><?php } ?>
			   
			   <?php echo $value; ?></span>
               
            </div>
            <div class="badge_tooltip__item"><?php echo $v['tooltip']; ?></div>
        </div>         
        <?php }else{ ?>        
        <div><span> <?php if(isset($v['icon-svg']) && isset($CORE_UI->icons_svg[$v['icon-svg']])){ ?> <span ppt-icon-16 data-ppt-icon-size="16"><?php echo $CORE_UI->icons_svg[$v['icon-svg']];?></span><?php } ?> <?php echo $value; ?> </span> </div>
        <?php } ?>
        
      </li>
      <?php $i++;  }  ?>
</ul>
<?php }

$data = ob_get_contents();
ob_end_clean(); 

return $data;

}





function _docsSection($menu){

$i=1;
foreach($menu as $item){

?>

	<section data-nav-title="<?php echo $item['name']; ?>">
	<div class="mb-4 p-3 ppt-show-hide-sectionxxxxx sectionid-<?php echo $i; ?>" ppt-border1>
 
	<div class="border-bottom py-3 mb-4">
    

<div ppt-flex-between> 
    
	<h3><?php echo $item['name']; ?></h3>  
    
    <div class="filterToggle"> 
    <div class="d-flex  toggle-me" onclick="_docsToggleHTML(<?php echo $i; ?>);">
     
    <svg aria-hidden="true" data-icon="toggle-on" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-on">
    <path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zm0 320c-70.8 0-128-57.3-128-128 0-70.8 57.3-128 128-128 70.8 0 128 57.3 128 128 0 70.8-57.3 128-128 128z" class="text-success"></path>
    </svg>
    
    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="toggle-off">
    <g class="fa-group"><path fill="currentColor" d="M384 64H192C86 64 0 150 0 256s86 192 192 192h192c106 0 192-86 192-192S490 64 384 64zM192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class=""></path>
    <path fill="currentColor" d="M192 384a128 128 0 1 1 128-128 127.93 127.93 0 0 1-128 128z" class="text-light"></path></g>
    </svg>
    
      <div>Show HTML code</div>
    </div>
    </div>
    
    </div> 
        
	<?php if(isset($item['desc']) && strlen($item['desc']) > 1){ ?><p><?php echo $item['desc']; ?></p><?php } ?>

</div>
    
      
<div class="hide-section code-wrapper-display" <?php if(isset($item['id']) && strlen($item['id']) > 1){ ?>data-type-<?php echo $item['id']; ?><?php } ?>>
	 <?php echo str_replace("data-src","src",$item['data']); ?>  
</div> 
   
<div class="hide-section code-wrapper" style="display:none;"><?php echo _docsDisplayCode($item['data'], 1); ?></div>
	
	</section>
<?php $i++; } 
 
}
function _docsDisplayCode($html, $wrap = 0){
 
$html = trim($html);
	$html = preg_replace('~>\s+<~', '><',$html);
	$tags = array('</p>','<br />','<br>','<hr />','<hr>','</h1>','</h2>','</h3>','</h4>','</h5>','</h6>',"</section>","</h1>","</h2>","</h3>","</h4>","</h5>","</h6>","</div>","</img>","</span>","</button>","-->","</figure>","<ul>","</ul>","</nav>","</li>");
	foreach($tags as $tag){
		$html = str_replace($tag, $tag."\n",$html);
	}
	
	$tags = array('<div ', '<span ','<link ','<h2');
	foreach($tags as $tag){
		$html = str_replace($tag, "\n	".$tag,$html);
	}
	
if($wrap){

?><pre class="line-numbersx language-html"><code><?php echo htmlentities($html); ?></code></pre><?php

}else{

return $html;

}

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_block_elementor_data($key){
 
$a = array();
 
}
 
function ppt_title_offer(){

	switch(THEME_KEY){
	
		case "rt": {		
			 $title = __("Book Viewing","premiumpress");		
		} break;
		
		case "cb": {		
			 $title = __("Cashback","premiumpress");		
		} break;
	 
		case "ll": {		
			 $title = __("Enrolment and Registration","premiumpress");		
		} break;
		
		default: {		
		 $title = __("Make Offer","premiumpress");	
		} break;
	 
	}
 
return $title;

}
 
function ppt_title_description(){

	switch(THEME_KEY){
		case "cb": {		
			 $title = __("Offer Details","premiumpress");		
		} break;	
		case "pj": {		
			 $title = __("Project Description","premiumpress");		
		} break;
		case "es":
		case "da": {		
			 $title = __("About Me","premiumpress");		
		} break; 
		default: {		
		 $title = __("Description","premiumpress");	
		} break;
	 
	}
 
return $title;

}

function ppt_title_store(){
 
 
	switch(THEME_KEY){ 
	 
		case "es": {
			  $title = __("My Agency","premiumpress");	
		} break;
	 
		default: {		
		 $title = __("My Store","premiumpress");	
		} break;
	 
	}
 
return $title;

}
function ppt_desc_store(){ 
 
	switch(THEME_KEY){ 
	 
		case "es": {
			  $title = __("Here you can view, edit and manage your agency details.","premiumpress");	
		} break;
	 
		default: {		
			$title = __("Here you can view, edit and manage your store details.","premiumpress");	
		} break;
	 
	}
 
return $title;

}
function ppt_visit_store(){ 
 
	switch(THEME_KEY){ 
	 
		case "es": {
			  $title = __("Agency Website","premiumpress");	
		} break;
	 
		default: {		
			$title = __("Visit Store","premiumpress");	
		} break;
	 
	}
 
return $title;

}
function ppt_title_author(){
 
 
	switch(THEME_KEY){

		case "rt": {		
			 $title = __("Agent Details","premiumpress");		
		} break;	
		case "pj":
		case "jb": {		
			 $title = __("Employer Details","premiumpress");		
		} break;
		case "vt": {
			  $title = __("Channel Details","premiumpress");	
		} break;
		case "cb": {
			  $title = __("Store Details","premiumpress");	
		} break;
		case "es": {
			  $title = __("Agency Details","premiumpress");	
		} break;
		case "at":
		case "dl":
		case "ct":
		case "mj": {		
			$title = __("Seller Details","premiumpress");		
		} break;
		default: {		
		 $title = __("Author Details","premiumpress");	
		} break;
	 
	}
 
return $title;

}
function ppt_title_view_profile(){

	
 
	switch(THEME_KEY){

		case "rt": {		
			 $title = __("Agent Details","premiumpress");		
		} break;	
		case "pj":
		case "jb": {		
			 $title = __("Employer Details","premiumpress");		
		} break;
		case "vt": {
			  $title = __("Channel Details","premiumpress");	
		} break;
		case "es": {
			  $title = __("Agency Details","premiumpress");	
		} break;
		case "at":
		case "dl":
		case "ct":
		case "mj": {		
			$title = __("Seller Profile","premiumpress");		
		} break;
		default: {		
		 $title = __("View Profile","premiumpress");	
		} break;
	 
	}
 
return $title;

}
function ppt_title_hours(){ 

	if(defined('THEME_KEY')){
		switch(THEME_KEY){
		
			case "jb": {		
				 $title = __("Company Location","premiumpress"); 	
			} break;
			case "dt": {		
				 $title = __("Opening Hours","premiumpress"); 	
			} break;	
			case "es": {		
				 $title = __("My Availability","premiumpress");	
			} break;
			case "rt":
			case "dl":  {		
				$title = __("Viewing Times","premiumpress"); 	
			} break;
			default: {		
				$title = __("Author Details","premiumpress");		
			} break;
		 
		}
	}
	return $title;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_blocks_defaults($key){

	$a = array();
	$blocks = ppt_theme_blocks_elementor($key,1);
	
	foreach($blocks as $block){
	 
		if(in_array($block,array("tab_start","tab_end","tab1","tab2","tab3","tab4"))){
		 
		}else{
		
			$d = ppt_theme_block_default(array($block), 1);
			foreach($d['f'] as $k => $f){
				$a[$k] = "";
			}		
		}
	}

return $a;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_blocks_elementor($widget, $removeTabs = 0){

	
	$blocks = array(
	
	"search" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end",  
		
		"section", "section_divider"
	),
		
	"headline" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end",  
		
		"section", "section_divider"
	),
	
	"text" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc", "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
	 
		"tab_start", "tab1",  "image", "tab2", "images", "tab_end",   
		
		"feature1",  "feature2",  "feature3",  "feature4",  "feature5",  "feature6",  "feature7",  "feature8",  "feature9",  "feature10", 
		
		"section", "section_divider"
	
	), 
	
	"features" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc", "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
	 
		"tab_start", "tab1",  "image", "tab2", "images", "tab_end",   
		
		"feature1",  "feature2",  "feature3",  "feature4",  "feature5",  "feature6",  "feature7",  "feature8",  "feature9",  "feature10", 
		
		"section", "section_divider"
	
	), 
	
	"headline" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc", "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
 		
		"section", "section_divider"
	
	), 

	"hero" => array(
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc", "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
	 
		"tab_start", "tab1",  "image", "tab2", "image1", "tab_end",  
		
		"section", "section_divider", "text_format"
	
	),

	"listings" => array( 
		
		"listings",
		
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
 		
		"section", "section_divider"
	
	),
	
	"video" => array(
	
		"video", 
	
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
 		
		"section", "section_divider"
	),
	
	"footer" => array(
	
	"footertop","footermid","footerbot", 
	
	"tab_start", "tab1", "footer_menu1", "tab2", "footer_menu2", "tab3", "footer_menu3", "tab4", "footer_menu4", "tab_end", 
	
	"section"
	
	),
	
	
	"category" => array(
	
		"taxonomy",
		
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
	 
		"tab_start", "tab1",  "image", "tab2", "images", "tab_end",  
	
		"section", "section_divider"
	
	),
	
	"header" => array(
 	
	"tab_start", "tab1", "topmenu", "tab2", "mainmenu", "tab3", "submenu",  "tab_end", 
	
	"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
	
	"globals"
	
	), 
	
	
	"blog" => array(
	 
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
 		
		"section", "section_divider"
	),
	
	"pricing" => array(
		
		"pricing",
	 
		"tab_start", "tab1", "title", "tab2", "subtitle", "tab3", "desc",  "tab_end", 
		
		"tab_start", "tab1",  "btn", "tab2", "btn2", "tab_end", 
 		
		"section", "section_divider"
	),
	
	
	);
	 
	$thisBlock = $blocks[$widget]; 
	
	if($removeTabs){		
		 
	 	foreach($thisBlock as $k => $v){ 
			if(in_array($v, array("tab_start","tab_end","tab1","tab2","tab3","tab4"))){
				if(isset($thisBlock[$k])){
			  unset($thisBlock[$k]);
			  }
			}  
		} 
		
	} 
		
	
	return $thisBlock;

}

function ppt_theme_block_select_values($block){

$listValues = array(

	"tag" => array(
	
		"" 		=> __( 'Default', 'premiumpress' ),
		'h1' 	=> 'H1',
		'h2' 	=> 'H2',
		'h3' 	=> 'H3',
		'h4' 	=> 'H4',
		'h5' 	=> 'H5',
		'h6' 	=> 'H6',
		'div' 	=> 'div',
		'span' 	=> 'span',
		'p' 	=> 'p',
	),
	
	"align" => array(
	
			"" 				=> __( 'Default', 'premiumpress' ),
			"text-left" 	=> __( 'Left', 'premiumpress' ),				 
			"text-center" 	=> __( 'Centered', 'premiumpress' ), 
			"text-right" 	=> __( 'Right', 'premiumpress' ), 
	),
	
	"font_size" => array(
	
			"" 			=> __( 'Default', 'premiumpress' ),
			"fs-xl" 	=> __( 'Extra Large', 'premiumpress' ),				 
			"fs-lg" 	=> __( 'Large', 'premiumpress' ), 
			"fs-md" 	=> __( 'Medium', 'premiumpress' ),				
			"fs-sm" 	=> __( 'Small', 'premiumpress' ),
			"fs-xs" 	=> __( 'Extra Small', 'premiumpress' ),				
			"fs-14" 	=> "14px",
			"fs-16" 	=> "16px",
			"fs-18" 	=> "18px",
	),
	
	"font_weight" => array(
	
			"" 			=> __( 'Default', 'premiumpress' ),				
			"text-800" 	=> 800,				 
			"text-700" 	=> 700, 
			"text-600" 	=> 600, 
			"text-500" 	=> 500, 
			"text-400" 	=> 400, 
			"text-300" 	=> 300, 
	),
	
	"underline" => array(
			"" 				=> __( 'Default', 'premiumpress' ),			
			"1" 			=> __( 'Basic Underline', 'premiumpress' ),	
			"2" 			=> __( 'Curly', 'premiumpress' ),	
			"3" 			=> __( 'Circle', 'premiumpress' ), 
			"4" 			=> __( 'Double', 'premiumpress' ), 
			"5" 			=> __( 'Double Underline', 'premiumpress' ),
			"6" 			=> __( 'Underline Zigzag', 'premiumpress' ), 
			"7" 			=> __( 'Diagonal', 'premiumpress' ),	
			"8" 			=> __( 'Strikethrough', 'premiumpress' ),
			"9" 			=> __( 'Crossed Out', 'premiumpress' ),	 
			
			"10" 			=> __( 'Underline 1px', 'premiumpress' ),	 
			"11" 			=> __( 'Underline 2px', 'premiumpress' ),	 
			"12" 			=> __( 'Underline 4px', 'premiumpress' ),	 
			"13" 			=> __( 'Underline 5px', 'premiumpress' ),	
			
			"15" 			=> __( '* Color Text', 'premiumpress' ),	
	),	
	
	"margin" => array(
			"" 				=> __( 'Default', 'premiumpress' ),	
						
			'mb-0' 			=> "Bottom 0px",
			'mb-1' 			=> "Bottom 10px",
			'mb-2' 			=> "Bottom 20px",
			'mb-3' 			=> "Bottom 30px" ,
			'mb-4' 			=> "Bottom 40px",
			'mb-5' 			=> "Bottom 50px", 			
			'mb-8' 			=> "Bottom 80px",
			'mb-10' 		=> "Bottom 100px",
			
			"z2" => "------------",
			
			'mb-n1' 		=> "Bottom Neg 10px",
			'mb-n2' 		=> "Bottom Neg 20px",
			
			'mb-n10' 		=> "Bottom Neg 100px",
			'mb-n20' 		=> "Bottom Neg 200px",
			
			
			
			"z" => "------------",
			
			'mt-0' 			=> "Top 0px",
			'mt-1' 			=> "Top 10px",
			'mt-2' 			=> "Top 20px",
			'mt-3' 			=> "Top 30px" ,
			'mt-4' 			=> "Top 40px",
			'mt-5' 			=> "Top 50px", 			
			'mt-8' 			=> "Top 80px",
			'mt-10' 		=> "Top 100px",	
			
			"z1" => "------------",
			
			'mt-n1' 		=> "Top Neg 10px",
			'mt-n2' 		=> "Top Neg 20px",
			'mt-n3' 		=> "Top Neg 30px",
			'mt-n4' 		=> "Top Neg 40px",
			'mt-n5' 		=> "Top Neg 50px",
			
			
			'mt-n10' 		=> "Top Neg 100px",
			'mt-n20' 		=> "Top Neg 200px",
			
	),	
	
	"animated" => array(
			"" 				=> __( 'Default', 'premiumpress' ),	 
			'ppt-animate-typed' => __( 'Typed', 'premiumpress' ),
			'ppt-animate-pulse-in' => __( 'Pulse', 'premiumpress' ), 
			'ppt-animate-fade-in' => __( 'Slide', 'premiumpress' ),	
	 		'ppt-animate-zoom-in' => __( 'Zoom', 'premiumpress' ),	 
			'ppt-animate-rise-in' => __( 'Rise', 'premiumpress' ), 
			'ppt-animate-rubberBand' => __( 'Rubber Band', 'premiumpress' ), 
			'ppt-animate-wobble' => __( 'Wobble', 'premiumpress' ), 
			
	),	
	
	"text_color" => array(
	
 		"" 				=> __( 'Default', 'premiumpress' ),
		'text-black' 	=> __( 'Black', 'premiumpress' ),
		'text-white' 	=> __( 'White', 'premiumpress' ),
					
		'text-primary' 	=> __( 'Primary', 'premiumpress' ),
		'text-secondary' => __( 'Secondary', 'premiumpress' ),
		'text-light' 	=> __( 'Light', 'premiumpress' ),
		'text-dark' 		=> __( 'Dark', 'premiumpress' ),
		'text-danger' 	=> __( 'Red', 'premiumpress' ), 
		'text-success' 	=> __( 'Green', 'premiumpress' ), 
		'text-warning' 	=> __( 'Yellow', 'premiumpress' ), 
		
		
		
	),	

	"show" => array(
			"" 			=> __( 'Default', 'premiumpress' ),				
			1 			=> __( 'Show', 'premiumpress' ),
			0 			=> __( 'Hide', 'premiumpress' ),
	),	
	
	"bg" => array(
 		"" 				=> __( 'Default', 'premiumpress' ),
		"bg-none" 		=> __( 'Transparent', 'premiumpress' ),
		'bg-white' 		=> __( 'White', 'premiumpress' ),			
		'bg-primary' 	=> __( 'Primary', 'premiumpress' ),
		'bg-secondary' => __( 'Secondary', 'premiumpress' ),
		'bg-light' 	=> __( 'Light', 'premiumpress' ),
		'bg-dark' 		=> __( 'Dark', 'premiumpress' ),
		'bg-orange' 	=> __( 'Orange', 'premiumpress' ),
		
		
		'ppt-gradient1' 	=> __( 'Gradient 1 - Blue', 'premiumpress' ),
		'ppt-gradient2' 	=> __( 'Gradient 2 - Green', 'premiumpress' ),
		'ppt-gradient3' 	=> __( 'Gradient 3 - Purple', 'premiumpress' ),
		'ppt-gradient4' 	=> __( 'Gradient 4  - Purple', 'premiumpress' ),
		'ppt-gradient5' 	=> __( 'Gradient 5 - Grey', 'premiumpress' ),
		'ppt-gradient6' 	=> __( 'Gradient 5 - Grey', 'premiumpress' ),
		
		'ppt-gradient-red' 	=> __( 'Gradient - Red', 'premiumpress' ),
		'ppt-gradient-blue' 	=> __( 'Gradient - Blue', 'premiumpress' ),
		
		
		
 		
	),
	"btn_bg" => array(
	
 		"" 				=> __( 'Default', 'premiumpress' ),
		'btn-system' 	=> __( 'White', 'premiumpress' ),			
		'btn-primary' 	=> __( 'Primary', 'premiumpress' ),
		'btn-secondary' => __( 'Secondary', 'premiumpress' ),
		'btn-light' 	=> __( 'Light', 'premiumpress' ),
		'btn-dark' 		=> __( 'Dark', 'premiumpress' ),
		'btn-orange' 	=> __( 'Orange', 'premiumpress' ), 
	),

	
	"overlay" => array(
		"" 				=> __( 'Default', 'premiumpress' ),
		"none" 			=> __( 'None', 'premiumpress' ),
		"gradient" 		=> __( 'Gradient', 'premiumpress' ),
		
		"gradient-left" => __( 'Gradient Left (dark)', 'premiumpress' ),
		"gradient-left-small" => __( 'Gradient Left (dark - small)', 'premiumpress' ),
		
		"gradient-left-white" => __( 'Gradient Left (light)', 'premiumpress' ),
		"gradient-left-small-white" => __( 'Gradient Left (light - small)', 'premiumpress' ),
		
		
		"black" 		=> "50% Black",
		"white" 		=> "50% White",
		"grey" 			=> "50% Grey",	
		"green" 		=> "50% Green",									
		"primary" 		=> "50% Primary Color",
		"secondary" 	=> "50% Secondary Color",	
	
	),
	
	"section_divider" => array(
	
		"" 			=> __( 'None', 'premiumpress' ),
		'1' 		=> "1 - Rounded Top",		
		'2' 		=> "2 - Rounded Bottom",		
		'3' 		=> "3 - Wiggly Line",	
		'4' 		=> "4 - Wavey Line",
		
		'7' 		=> "7 - Wavey Line 2",
		
		'5' 		=> "5 - Double Faded Lines",
		'8' 		=> "8 - Double Faded Lines 2",
		'9' 		=> "9 - Double Faded Lines 3", 
		
		'6' 		=> "6 - Snow Hills",
		 
		
		
	), 
	
	"w" => array(
	
		'full' 				=> "Full Width (100%)",					
		'container' 		=> "Container (1300px)" ,
		'container-slim' 	=> "Slim (1100px)",
	), 
	
	"padding" => array(
				
		"" 				=> __( 'Default', 'premiumpress' ),		
		"section-none" 	=> "No Padding",
		
		"z" => "------------",
					
					"section-120" 		=> "120px Padding",
					"section-100" 		=> "100px Padding", 
					"section-80" 		=> "80px Padding", 
					"section-60" 		=> "60px Padding", 						
					"section-40" 		=> "40px Padding",
					"section-20" 		=> "20px Padding",
					
					"a" => "------------",
					
					"section-top-40" 		=> "40px Padding Top",
					"section-top-60" 		=> "60px Padding Top",
					"section-top-80" 		=> "80px Padding Top",
					"section-top-100" 		=> "100px Padding Top",
					"section-top-120" 		=> "120px Padding Top",
					
					"b" => "------------",
					
					"section-bottom-40" 		=> "40px Padding Bottom",
					"section-bottom-60" 		=> "60px Padding Bottom",
					"section-bottom-80" 		=> "80px Padding Bottom",
					"section-bottom-100" 		=> "100px Padding Bottom",
					"section-bottom-120" 		=> "120px Padding Bottom",

	), 
	
	
	"ftop_style" => array(
	
		"" 		=> __( 'Default', 'premiumpress' ),
		"1" 	=> __( 'Style 1', 'premiumpress' ),
	 	"2" 	=> __( 'Style 2', 'premiumpress' ),
		"3" 	=> __( 'Style 3', 'premiumpress' ),	 
	
	),
	
	"fmid_style" => array(
	
		"" 		=> __( 'Default', 'premiumpress' ),
		"1" 	=> __( 'Style 1', 'premiumpress' ),
		"2" 	=> __( 'Style 2', 'premiumpress' ),
		"3" 	=> __( 'Style 3', 'premiumpress' ),
 	
	),
	
	"fbot_style" => array(
		"" 		=> __( 'Default', 'premiumpress' ),
		"1" 	=> "Text Left",
		"2" 	=> "Text Center",	
		"3" 	=> "Text Right",	
		"4" 	=> "Text + Cards",
		"5" 	=> "Text + Social",
		"6" 	=> "Text + Links",			 
	
	),
	
	
	"txtbg" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		"dark" 		=> __( 'Dark', 'premiumpress' ),
		"light" 	=> __( 'Light', 'premiumpress' ),
	),	
	 
	
	"social" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Show', 'premiumpress' ),
		0 			=> __( 'Hide', 'premiumpress' ),
	),
	"show_logo" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Show', 'premiumpress' ),
		0 			=> __( 'Hide', 'premiumpress' ),
	),
	
	// HEADER STYLE1
	'style' => array(
		"" 		=> __( 'Default', 'premiumpress' ),	
		'0' 	=> "Menu",	
		'1' 	=> "Banner Advertising",	
		'2' 	=> "Feature Boxes",	 
		'5' 	=> "No Menu - Centered Logo",
		'6' 	=> "Menu + User Icon",	
		'7' 	=> "Search + User Icon", 
		'8' 	=> "Search Middle",
		
		
		9			=> __( 'Style 9', 'premiumpress' ),
		10			=> __( 'Style 10', 'premiumpress' ),
		11			=> __( 'Style 11', 'premiumpress' ),
		12			=> __( 'Style 12', 'premiumpress' ),
		
		15			=> __( 'New Style 15', 'premiumpress' ),
		
		
	),
	
	"topmenu_style" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Style 1', 'premiumpress' ),
		2 			=> __( 'Style 2', 'premiumpress' ),
		3			=> __( 'Style 3', 'premiumpress' ),
	),
	
	"text_style" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Style 1', 'premiumpress' ),
		//2 			=> __( 'Style 2', 'premiumpress' ),
		//3			=> __( 'Style 3', 'premiumpress' ),
	),
	
	
	
	"submenu_style" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Style 1', 'premiumpress' ),
		2 			=> __( 'Style 2', 'premiumpress' ),
		3			=> __( 'Style 3', 'premiumpress' ),
		7			=> __( 'Style 7', 'premiumpress' ),
		
		
		8			=> __( 'Style 8 - Small Categories', 'premiumpress' ),
		9			=> __( 'Style 9 - Big Categories', 'premiumpress' ),
		
		10			=> __( 'Style 10 - Search', 'premiumpress' ),
		
	),
	
	"shadow" => array( 
		"" 				=> __( 'Default', 'premiumpress' ),	
		"shadow-sm" 	=> __( 'Small', 'premiumpress' ),
		"shadow-lg" 	=> __( 'Medium', 'premiumpress' ),
		"shadow" 		=> __( 'Large', 'premiumpress' ),		
	),
	
	"offset" => array(
	
		"0" 	=> __( 'Offset 0', 'premiumpress' ),				
		"1" 	=> __( 'Offset 1', 'premiumpress' ),
		"2" 	=> __( 'Offset 2', 'premiumpress' ),
 		
	),	
	 
	
	
	// PRICING TABLE
	"type" => array( 
		"memberships" 	=> __( 'Memberships', 'premiumpress' ),	
		"advertising" 	=> __( 'Advertising', 'premiumpress' ),	
		"packages" 		=> __( 'Listing Packages', 'premiumpress' ),		
	),
	
	// HERO VIDEO
	"video_show" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Show', 'premiumpress' ),
		0 			=> __( 'Hide', 'premiumpress' ),
	),
	
	// LISTINGS
	"order" => array( 
		'asc' => 'Ascending',
        'desc' => 'Descending'	
	),
	
	"orderby" => array( 
		'ID' => 'Post ID',
		'author' => 'Post Author',
		'title' => 'Title',
		'date' => 'Date',
		'modified' => 'Last Modified Date',				
		'rand' => 'Random',				
		'menu_order' => 'Menu Order',
	),
	
	
	"terms_orderby" => array( 
		'name' => 'Name',
	 	'count' => 'Count',	
		'menu_order' => 'Menu Order',
	),
	
	"card" => array( 
 		'grid' 		=> 'Grid',
         'list' 	=> 'List',
	),	
	
	"mobile_hide_bg" => array(
		"" 			=> __( 'Default', 'premiumpress' ),				
		1 			=> __( 'Hide', 'premiumpress' ),
		0 			=> __( 'Show', 'premiumpress' ),
	),
 
	
	"color1" => array( 
	
 		"" 				=> __( 'Default', 'premiumpress' ),  
		'black' 	=> __( 'Black', 'premiumpress' ),
		'white' 	=> __( 'White', 'premiumpress' ), 
		'primary' 	=> __( 'Primary', 'premiumpress' ),
		'secondary' => __( 'Secondary', 'premiumpress' ),
		'light' 	=> __( 'Light', 'premiumpress' ),
		'dark' 		=> __( 'Dark', 'premiumpress' ),
		'danger' 	=> __( 'Red', 'premiumpress' ), 
		'success' 	=> __( 'Green', 'premiumpress' ), 
		'warning' 	=> __( 'Yellow', 'premiumpress' ), 
		
	),
	
	"color2" => array( 
	
 		"" 				=> __( 'Default', 'premiumpress' ),
		'black' 	=> __( 'Black', 'premiumpress' ),
		'white' 	=> __( 'White', 'premiumpress' ), 
		'primary' 	=> __( 'Primary', 'premiumpress' ),
		'secondary' => __( 'Secondary', 'premiumpress' ),
		'light' 	=> __( 'Light', 'premiumpress' ),
		'dark' 		=> __( 'Dark', 'premiumpress' ),
		'danger' 	=> __( 'Red', 'premiumpress' ), 
		'success' 	=> __( 'Green', 'premiumpress' ), 
		'warning' 	=> __( 'Yellow', 'premiumpress' ),  
		
	),
		
		
);

$listValues['custom'] = _ppt_custom_searchlist();

$listValues['footer_menu1'] = _ppt_elementor_menus();
$listValues['footer_menu2'] = _ppt_elementor_menus();
$listValues['footer_menu3'] = _ppt_elementor_menus();
$listValues['footer_menu4'] = _ppt_elementor_menus();

if(isset($listValues[$block])){
return $listValues[$block];
}

return ;

}


function ppt_theme_block_default($type, $full){

$allBlocks = array(


	"feature1" => array(
		
		"t" => __('Feature 1', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f1a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f1b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f1icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"f1image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature2" => array(
		
		"t" => __('Feature 2', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f2a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f2b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f2icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
			"f2image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
		),
	),
	"feature3" => array(
		
		"t" => __('Feature 3', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f3a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f3b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f3icon" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"f3image" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature4" => array(
		
		"t" => __('Feature 4', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f4a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f4b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f4icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"f4image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),	
	"feature5" => array(
		
		"t" => __('Feature 5', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f5a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f5b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f5icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),
			"f5image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),	
	"feature6" => array(
		
		"t" => __('Feature 6', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f6a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f6b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f6icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"f6image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature7" => array(
		
		"t" => __('Feature 7', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f7a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f7b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f7icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"f8image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature8" => array(
		
		"t" => __('Feature 8', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f8a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f8b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f8icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"f8image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature9" => array(
		
		"t" => __('Feature 9', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f9a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f9b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f9icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"f9image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	"feature10" => array(
		
		"t" => __('Feature 10', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "f10a" => array(
				"d" 		=> "", 
				"type" 		=> "text_block", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "f10b" => array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Sub title', 'premiumpress' ),
				"desc" 		=> "",
			),
						
			"f10icon" => array(
				"d" 		=> "", 
				"type" 		=> "icon", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"f10image" => array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Icon', 'premiumpress' ),
				"desc" 		=> "",
			),		
		),
	),
	

	"listings" => array(
		
		"t" => __('Listing Data', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "card" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Display Type', 'premiumpress' ),
				"desc" 		=> "",
			),
			 "show" => array(
				"d" 		=> "", 
				"type" 		=> "number", 
				"t" 		=> __('Limit', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "perrow" => array(
				"d" 		=> "", 
				"type" 		=> "number", 
				"t" 		=> __('Per Row', 'premiumpress' ),
				"desc" 		=> "",
			),
					
			 "custom" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Custom', 'premiumpress' ),
				"desc" 		=> "",
			),		
			
			 "orderby" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Order By', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "order" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Order', 'premiumpress' ),
				"desc" 		=> "",
			),
			 
  
		),
	),

	"pricing" => array(
		
		"t" => __('Price Table Data', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "pricing_type" => array(
				"d" 		=> "memberships", 
				"type" 		=> "select", 
				"t" 		=> __('Pricing Data', 'premiumpress' ),
				"desc" 		=> "",
			),
			  
  
		),
	),

	"topmenu" => array(
		
		"t" => __('Header - Top Menu', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "topmenu_show" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"topmenu_social" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Social Icons', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "topmenu_style" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Top Menu Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "topmenu_bg" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Background', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
			"topmenu_bg_color" => array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			), 
		),
	),
	
	
	"mainmenu" => array(
		
		"t" => __('Header - Main Menu', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "header_style" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"header_bg" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Background', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"header_bg_color" => array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			), 
		),
	),
	 
	"submenu" => array(
		
		"t" => __('Header - Sub Menu', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "submenu_show" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"submenu_style" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"submenu_bg" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Backgrond', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"submenu_bg_color" => array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),		
			  
		),
	),
 
	
	"taxonomy" => array(
		
		"t" => __('Taxonomy', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			 "tax" 		=> array(
				"d" 		=> "", 
				"type" 		=> "taxonomy", 
				"t" 		=> __('Taxonomy', 'premiumpress' ),
				"desc" 		=> "",
			),
			 
			
			 "cat" 		=> array(
				"d" 		=> "", 
				"type" 		=> "taxonomy_selected", 
				"t" 		=> __('Parent Categories', 'premiumpress' ),
				"desc" 		=> __( "Select which values to display.", 'premiumpress' ),
			),
			
			 "cat_subs" => array(
				"d" 		=> "", 
				"type" 		=> "switch", 
				"t" 		=> __('Show Sub Categories Only', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "orderby" 		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Order By', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			 "order" 		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Order', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			 "limit" 		=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Limit', 'premiumpress' ),
				"desc" 		=> __( "This maximum number to display.", 'premiumpress' ),
			),
			
			"hide_empty" => array(
				"d" 		=> "", 
				"type" 		=> "switch", 
				"t" 		=> __('Hide Empty', 'premiumpress' ),
				"desc" 		=> __( "This will hide values with no results.", 'premiumpress' ),
			),
			
			
			
		),
	),

	
	"title" => array(
		
		"t" => __('Text - Title', 'premiumpress' ),
		"d" => "",
		"f" => array(
			/*
			"title_notice" 	=> array(
				"d" 		=> "", 
				"type" 		=> "notice", 
				"t" 		=> __( "If the design you've selected includes a title. You can configure it here, otherwise ignore this option.", 'premiumpress' ),
				"desc" 		=> "",				
			),
		
			
			"title_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Title', 'premiumpress' ),
				"desc" 		=> ,
			),
			*/
			
			"title_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Title', 'premiumpress' ),
				"desc" 		=> __('This option will not work with all designs.', 'premiumpress' ),			
			),
			
			"title" 		=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Text', 'premiumpress' ),
				"desc" 		=> __('Use curly brackets to underline text and normal brackets to animate. Example: This is {underlined} and this is [animated1, animated2, animated3].', 'premiumpress' ),
			),
			
			"title_text_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('System Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"title_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"title_align"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Alignment', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"title_font_size"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Size', 'premiumpress' ),
				"desc" 		=> "",
			),
			"title_font_weight" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Weight', 'premiumpress' ),
				"desc" 		=> "",
			),		
			"title_underline"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Underline', 'premiumpress' ),
				"desc" 		=> "",
			),
			"title_underline_color"=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Underline Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"title_animated"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Animated', 'premiumpress' ),
				"desc" 		=> "",
			),	
				
			"title_margin"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Margin', 'premiumpress' ),
				"desc" 		=> "",
			), 
		), 
		
	),
	
	"subtitle" => array(
		
		"t" => __('Text - Subtitle', 'premiumpress' ),
		"d" => "",
		"f" => array(
			/*
			"subtitle_notice" 	=> array(
				"d" 		=> "", 
				"type" 		=> "notice", 
				"t" 		=> __( "If the design you've selected includes a subtitle. You can configure it here, otherwise ignore this option.", 'premiumpress' ),	
				"desc" 		=> "",				
			),
			*/
			
			"subtitle_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Subtitle', 'premiumpress' ),
				"desc" 		=> __('This option will not work with all designs.', 'premiumpress' ),			
			),
			"subtitle" 		=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Text', 'premiumpress' ),
				"desc" 		=> __('Use curly brackets to underline text and normal brackets to animate. Example: This is {underlined} and this is [animated1, animated2, animated3].', 'premiumpress' ),
			),
			"subtitle_text_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('System Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"subtitle_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"subtitle_align"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Alignment', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"subtitle_font_size"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Size', 'premiumpress' ),
				"desc" 		=> "",
			),
			"subtitle_font_weight" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Weight', 'premiumpress' ),
				"desc" 		=> "",
			),		
			"subtitle_underline"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Underline', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"subtitle_underline_color"=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Underline Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"subtitle_animated"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Animated', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"subtitle_margin"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Margin', 'premiumpress' ),
				"desc" 		=> "",
			), 
		), 
		
	),
 	
	"desc" => array(
		
		"t" => __('Text - Description', 'premiumpress' ),
		"d" => "",
		"f" => array(
			/*
			"desc_notice" 	=> array(
				"d" 		=> "", 
				"type" 		=> "notice", 
				"t" 		=> __( "If the design you've selected includes a description. You can configure it here, otherwise ignore this option.", 'premiumpress' ),		
				"desc" 		=> "",			
			),
			*/
			"desc_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Description', 'premiumpress' ),
				"desc" 		=> __('This option will not work with all designs.', 'premiumpress' ),
			),
			"desc" 		=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Text', 'premiumpress' ),
				"desc" 		=> __('Use curly brackets to underline text and normal brackets to animate. Example: This is {underlined} and this is [animated1, animated2, animated3].', 'premiumpress' ),
			),
			"desc_text_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('System Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"desc_color"		=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"desc_align"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Alignment', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"desc_font_size"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Size', 'premiumpress' ),
				"desc" 		=> "",
			),
			"desc_font_weight" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Weight', 'premiumpress' ),
				"desc" 		=> "",
			),		
			"desc_underline"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Underline', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"desc_underline_color"=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Underline Color', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"desc_animated" => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Animated', 'premiumpress' ),
				"desc" 		=> "",
			),
			"desc_margin"=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Margin', 'premiumpress' ),
				"desc" 		=> "",
			), 
		),  
			
	),	
	
	"header" => array(
		
		"t" => __('Header', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"topmenu_show"	 => array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Top menu - Show', 'premiumpress' ),
				"desc" 		=> "",
			),		 
			"btn_show" 		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Button 1 - Show', 'premiumpress' ),
				"desc" 		=> "",
			),
		 	"btn2_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "switch", 
				"t" 		=> __('Button 2 - Show', 'premiumpress' ),
				"desc" 		=> "",
			),
			"submenu_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "switch", 
				"t" 		=> __('Show Submenu', 'premiumpress' ),
				"desc" 		=> "",
			),
			"submenu_style"	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Sub Menu Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			"submenu_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Submenu Background', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"submenu_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Submenu Background Color', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"header_style" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Header Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			"header_bg" 		=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Header Background Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"header_bg_color" 		=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Header Background Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			"topmenu_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Top Menu Background', 'premiumpress' ),
				"desc" 		=> "",
			),
			"topmenu_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Top Menu Background', 'premiumpress' ),
				"desc" 		=> "",
			),
			"topmenu_social" => array(
				"d" 		=> "", 
				"type" 		=> "switch", 
				"t" 		=> __('Social Icons', 'premiumpress' ),
				"desc" 		=> "",
			),			
			
		),
		
	),
	
	"btn" => array(
		
		"t" => __('Button - One', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
		/*
			"btn_notice" 	=> array(
				"d" 		=> "", 
				"type" 		=> "notice", 
				"t" 		=> __( "If the design you've selected includes a button. You can configure it here, otherwise ignore this option.", 'premiumpress' ),	
				"desc" 		=> "",				
			),
		*/
			"btn_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> __('Enter the full website link. Example: https://www.premiumpress.com', 'premiumpress' )
			), 
			
		),
	),
	
	
	"btn2" => array(
		
		"t" => __('Button - Two', 'premiumpress' ),
		"d" => "",
		"f" => array( 
			
			"btn2_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn2_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn2_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn2_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"btn2_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> __('Enter the full website link. Example: https://www.premiumpress.com', 'premiumpress' )
			), 
			
		),
	),
	


	"globals" => array(
		
		"t" => __( 'Global Settings', 'premiumpress' ),
		"d" => "",
		"f" => array(	
		
			"primary_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Primary Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"secondary_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Secondary Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"logo_text" 	=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Logo Text', 'premiumpress' ),
				"desc" 		=> "",
			),
		
		
		),
	),

	"section" => array(
		
		"t" => __( 'Layout - Section &amp; Padding', 'premiumpress' ),
		"d" => "",
		"f" => array(			
			 
			"section_padding" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Padding', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
			"section_margin" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Margin', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
			"section_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Background Color', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"section_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Background Custom Color', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"section_overlay" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Overlay', 'premiumpress' ),
				"desc" 		=> "",
			),
			 
			"section_w" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Width', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			
			"section_mobile_hide_bg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Hide Background (Mobile)', 'premiumpress' ),
				"desc" 		=> __( 'Not used by all designs. This will try to hide the background image when displayed on mobile devices for better display.', 'premiumpress' ),
			),
			
			"section_css" 	=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Custom CSS Tags', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
		),
		
	),
	
	
	"section_divider" => array(
		
		"t" => __('Divider', 'premiumpress' ),
		"d" => "",
		"f" => array(
			
			"section_divider" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Divider', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"section_divider_color1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Background Color', 'premiumpress' ), 
				"desc" 		=> "",
			),
			
			"section_divider_color1_custom" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ), 
				"desc" 		=> "",
			),	
			
			"section_divider_color2" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Foreground Color', 'premiumpress' ), 
				"desc" 		=> "",
			),	
			
			"section_divider_color2_custom" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Custom Color', 'premiumpress' ), 
				"desc" 		=> "",
			),
	
		),
	),
	
		
	
	
	"text_format" => array(
		
		"t" => __('Text Formatting', 'premiumpress' ),
		"d" => "",
		"f" => array(
			
			"text_format_text_style" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Display Style', 'premiumpress' ),
				"desc" 		=> "",
			),	
	
		),
	),
	
	"image" => array(
		
		"t" => __('Image - Main Image', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"image" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image_alt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Image ALT Tag.', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image_css" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Custom CSS', 'premiumpress' ),
				"desc" 		=> "",
			),
			
		),
	),
	
	"image1" => array(
		
		"t" => __('Image - Main Image', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"image1_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show', 'premiumpress' ),
				"desc" 		=> "",
			),
		
			"image1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image1_alt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Image ALT Tag.', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image1_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image1_shadow" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Shadow', 'premiumpress' ),
				"desc" 		=> "",
			),  
			
			"image1_offset" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Offset', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image1_css" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Custom CSS', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"video_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Video Icon', 'premiumpress' ),
				"desc" 		=> "",
			),
			
		),
	),
	
	"images" => array(
		
		"t" => __('Image - Extra Images', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"image1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image1_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image1_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image1_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			"image2" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image2_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image2_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image2_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"image3" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image3_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image3_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image3_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			"image4" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image4_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image4_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image4_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
				
			"image5" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image5_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image5_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image5_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			"image6" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image6_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image6_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image6_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),	
			
			
			"image7" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image7_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image7_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image7_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			"image8" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image8_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image8_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image8_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"image9" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image9_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image9_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image9_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			"image10" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Choose Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			"image10_txt" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Caption', 'premiumpress' ),
				"desc" 		=> "",
			),  
			"image10_txt1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Alt Caption', 'premiumpress' ),
				"desc" 		=> "",
			), 
			"image10_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "link", 
				"t" 		=> __('Link', 'premiumpress' ),
				"desc" 		=> "",
			),			
			
			
			
		),
	),
	
	
	
	"video" => array(
		
		"t" => __('Video', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
		
			"video_image" 	=> array(
				"d" 		=> "", 
				"type" 		=> "image", 
				"t" 		=> __('Video Image', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"video_image_title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Image ALT Tag.', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
			"video_icon" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Video Icon', 'premiumpress' ),
				"desc" 		=> "1",
			),
			
			"video_link" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Video Link', 'premiumpress' ),
				"desc" 		=> __('Enter the full website link. Example: https://www.premiumpress.com', 'premiumpress' )
			), 
			
		),
	),
	
	
	
	
	
	"footertop" => array(
		
		"t" => __('Footer - Top', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"footertop_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show/Hide', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footertop_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footertop_ftop_style" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footertop_txtbg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Text Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Text', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			
		),
	),	
	
	
	
	"footermid" => array(
		
		"t" => __('Footer - Middle', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"footermid_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show/Hide', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footermid_show_logo" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show Logo', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footermid_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footermid_fmid_style" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footermid_txtbg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Text Color', 'premiumpress' ),
				"desc" 		=> "",
			), 
			
		),
	),
	
	
	"footer_menu1" => array(
		
		"t" => __('Links List 1', 'premiumpress' ),
		"d" => "",
		"f" => array(
	
			
			"footer_menu1_title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),		
			"footer_menu1" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('WP Menu Links', 'premiumpress' ),
				"desc" 		=> __('Select this option if you want to use an existing WordPress menu otherwise set the links below.', 'premiumpress' ),
			),
			
			"footer_menu1_links" 	=> array(
				"d" 		=> "", 
				"type" 		=> "repeater-links", 
				"t" 		=> __('Custom Menu Links', 'premiumpress' ),
				"desc" 		=> "",
			),
				
			
		),
	),
	
	
		"footer_menu2" => array(
		
		"t" => __('Links List 2', 'premiumpress' ),
		"d" => "",
		"f" => array(
	
			
			"footer_menu2_title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"footer_menu2" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('WP Menu Links', 'premiumpress' ),
				"desc" 		=> __('Select this option if you want to use an existing WordPress menu otherwise set the links below.', 'premiumpress' ),
			),
			
			"footer_menu2_links" 	=> array(
				"d" 		=> "", 
				"type" 		=> "repeater-links", 
				"t" 		=> __('Custom Menu Links', 'premiumpress' ),
				"desc" 		=> "",
			),
			
		),
	),
	
	
	
	"footer_menu3" => array(
		
		"t" => __('Links List 3', 'premiumpress' ),
		"d" => "",
		"f" => array(
	
			
			"footer_menu3_title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"footer_menu3" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('WP Menu Links', 'premiumpress' ),
				"desc" 		=> __('Select this option if you want to use an existing WordPress menu otherwise set the links below.', 'premiumpress' ),
			),	
			
			"footer_menu3_links" 	=> array(
				"d" 		=> "", 
				"type" 		=> "repeater-links", 
				"t" 		=> __('Custom Menu Links', 'premiumpress' ),
				"desc" 		=> "",
			),
			
		),
	),
	
	
	
	"footer_menu4" => array(
		
		"t" => __('Links List 4', 'premiumpress' ),
		"d" => "",
		"f" => array(
	
		"footer_menu4_title" 	=> array(
				"d" 		=> "", 
				"type" 		=> "text", 
				"t" 		=> __('Title', 'premiumpress' ),
				"desc" 		=> "",
			),	
			"footer_menu4" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('WP Menu Links', 'premiumpress' ),
				"desc" 		=> __('Select this option if you want to use an existing WordPress menu otherwise set the links below.', 'premiumpress' ),
			),	
			
			"footer_menu4_links" 	=> array(
				"d" 		=> "", 
				"type" 		=> "repeater-links", 
				"t" 		=> __('Custom Menu Links', 'premiumpress' ),
				"desc" 		=> "",
			),
			
		),
	),
	
	
	"footerbot" => array(
		
		"t" => __('Footer - Bottom', 'premiumpress' ),
		"d" => "",
		"f" => array(
		
			"footerbot_show" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Show/Hide', 'premiumpress' ),
				"desc" 		=> "",
			),
			 
			"footerbot_txtbg" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Text Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footerbot_bg_color" 	=> array(
				"d" 		=> "", 
				"type" 		=> "color", 
				"t" 		=> __('Color', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			"footerbot_fbot_style" 	=> array(
				"d" 		=> "", 
				"type" 		=> "select", 
				"t" 		=> __('Style', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
			"footer_description" 	=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Description', 'premiumpress' ),
				"desc" 		=> "",
			),
			 
			
			"footer_copyright" 	=> array(
				"d" 		=> "", 
				"type" 		=> "textarea", 
				"t" 		=> __('Copyright Text', 'premiumpress' ),
				"desc" 		=> "",
			),
			
			
		),
	),
	
		
		
);


// DEFAULT VALUES





$return = array();

if(is_array($type)){
	foreach($type as $k){
		if(isset($allBlocks[$k])){
			
			// GET THE KEYS ONLY
			if($full == 0){
				
				$h = array_keys($allBlocks[$k]['f']);
				$pssme = array();
				foreach($h as $hh){
				$pssme[$hh] = "";
				} 
			
				$return = array_merge($return, $pssme);
			
			// FULL DATA
			}else{
				$return = array_merge($return, $allBlocks[$k]);
			}
		
		
		}
	}
}
 
return $return;
}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_block_output($html, $elementor_settings, $blockdata = ""){ global $CORE, $CORE_UI;
 
if(!isset($blockdata[0])){
return $html;
}

// BOOTSTRAP CODE CHANGES
$html = str_replace("pr-lg-5","pr-lg-5 pe-lg-5",$html);
$html = str_replace("pl-lg-5","pl-lg-5 ps-lg-5",$html);

$html = str_replace("pr-xl-5","pr-xl-5 pe-xl-5",$html);
$html = str_replace("pl-xl-5","pl-xl-5 ps-xl-5",$html);

$html = str_replace("mr-4","mr-4 me-4",$html);
$html = str_replace("mr-5","mr-5 me-5",$html);

$html = str_replace("ml-auto","ml-auto ms-auto",$html);
$html = str_replace("mr-auto","mr-auto me-auto",$html);




if($blockdata[0] == "widget"){

//print_r($elementor_settings);

}else{

	 // ADD ON CODE
	$html = str_replace("<section","<section data-ppt-section ",$html);
	$html = str_replace("<section","<section data-ppt-blocktype='".$blockdata[0]."' ",$html);
	$html = str_replace("<section","<section data-ppt-blockid='".$blockdata[1]."' ",$html); 
	 
	 
	// IF EMPTY (NOT ELEMENTOR) LETS CHECK FOR DEFAULT SETTINGS 
	if(empty($elementor_settings)){
		$elementor_settings = array();
		 
		$default_settings = $CORE->LAYOUT("get_block_settings_defaults_new", $blockdata );
	 
		foreach($default_settings as $k => $v){
			if($v != ""){
				$elementor_settings[$k] = $v;
			}
		}
		
		 
	}

}
 
$default_tags = array(); 



// TITLE, SUBTITLE, DESC
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$default_tags["data-ppt-title"] = array(
	"key"		=> "title",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "title", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
		
			"text" 	=> array("d" => "", "key" => "title"),
			 
			"underline" 	=> array("d" => "", "key" => "title_underline"),			
			"underline_color" 	=> array("d" => "", "key" => "title_underline_color"),
			 
			"animated" 		=> array("d" => "", "key" => "title_animated"),
						
			"color" 		=> array("d" => "", "key" => "title_color"), 			
			"class-color" 	=> array("d" => "", "key" => "title_text_color"),			
			"class-size" 	=> array("d" => "", "key" => "title_font_size"),
			"class-weight" 	=> array("d" => "", "key" => "title_font_weight"),
			"class-margin" 	=> array("d" => "", "key" => "title_margin"),
			"class-align" 	=> array("d" => "", "key" => "title_align"),
			  
			
		),	
	),	
);

$default_tags["data-ppt-subtitle"] = array(
	"key"		=> "subtitle",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "subtitle", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
		
			"text" 	=> array("d" => "", "key" => "subtitle"),
			
			"underline" 	=> array("d" => "", "key" => "subtitle_underline"),
			"underline_color" 	=> array("d" => "", "key" => "subtitle_underline_color"),
			
			"animated" 	=> array("d" => "", "key" => "subtitle_animated"),
			
			"color" 	=> array("d" => "", "key" => "subtitle_color"),
			
			"class-color" 	=> array("d" => "", "key" => "subtitle_text_color"),
			"class-size" 	=> array("d" => "", "key" => "subtitle_font_size"),
			"class-weight" 	=> array("d" => "", "key" => "subtitle_font_weight"),
			"class-margin" 	=> array("d" => "", "key" => "subtitle_margin"),
			"class-align" 	=> array("d" => "", "key" => "subtitle_align"), 
			
			"remove" 		=> array("d" => "", "key" => "subtitle_show"),

		 	
		),	
	),	
);

$default_tags["data-ppt-desc"] = array(
	"key"		=> "desc",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "desc", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "desc"),	
			
			"color" 		=> array("d" => "", "key" => "desc_color"), 
			
			"class-color" 	=> array("d" => "", "key" => "desc_text_color"),
			"class-size" 	=> array("d" => "", "key" => "desc_font_size"),
			"class-weight" 	=> array("d" => "", "key" => "desc_font_weight"),
			"class-margin" 	=> array("d" => "", "key" => "desc_margin"),
			"class-align" 	=> array("d" => "", "key" => "desc_align"),
			
			"underline" 	=> array("d" => "", "key" => "desc_underline"),
			"underline_color" 	=> array("d" => "", "key" => "desc_underline_color"),
			
			"animated" 		=> array("d" => "", "key" => "desc_animated"),
			
			"remove" 		=> array("d" => "", "key" => "desc_show"),
			
		),	
	),	
);


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$default_tags["data-ppt-copyright"] = array(
	"key"		=> "footer_copyright",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_copyright", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_copyright"), 
		),	
	),	
);

$default_tags["data-ppt-footerdesc"] = array(
	"key"		=> "footer_description",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_description", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_description"), 
		),	
	),	
);
 

$default_tags["data-ppt-footer-menutitle1"] = array(
	"key"		=> "footer_menu1_title",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_menu1_title", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_menu1_title"), 
		),	
	),	
);

$default_tags["data-ppt-footer-menutitle2"] = array(
	"key"		=> "footer_menu2_title",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_menu2_title", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_menu2_title"), 
		),	
	),	
);

$default_tags["data-ppt-footer-menutitle3"] = array(
	"key"		=> "footer_menu3_title",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_menu3_title", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_menu3_title"), 
		),	
	),	
);

$default_tags["data-ppt-footer-menutitle4"] = array(
	"key"		=> "footer_menu4_title",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "footer_menu4_title", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "footer_menu4_title"), 
		),	
	),	
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




$default_tags["data-ppt-icon"] = array(
	"key"		=> "icon",
	"inner" => array(
		 
		"values" => array(		
		 
			"icon" 	=> array("d" => "", "key" => "icon"),
		),	
	),	
);

$default_tags["data-ppt-icon2"] = array(
	"key"		=> "icon2",
	"inner" => array(
		 
		"values" => array(		
		 
			"icon" 	=> array("d" => "", "key" => "icon2"),
		),	
	),	
);

$default_tags["data-ppt-icon3"] = array(
	"key"		=> "icon3",
	"inner" => array(
		 
		"values" => array(		
		 
			"icon" 	=> array("d" => "", "key" => "icon3"),
		),	
	),	
);


$default_tags["data-ppt-link"] = array(
	"key"		=> "link",
	"inner" => array(
		 
		"values" => array(		
		 
			"href" 	=> array("d" => "", "key" => "link"),
			"onclick" 	=> array("d" => "", "key" => "link-onclick"),
			"class" 	=> array("d" => "", "key" => "link-class"),
		),	
	),	
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


 
$default_tags["data-ppt-btn"] = array(
	"key"		=> "btn_bg",
	"inner" => array(
		"editor" => array(),
		"values" => array(	
			"class" 	=> array("d" => "", "key" => "btn_bg"),
			 "color-bg" 	=> array("d" => "", "key" => "btn_bg_color"),
		),	
	),	
); 


$default_tags["data-ppt-btn-txt"] = array(
	"key"		=> "btn_txt",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "btn_txt", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(	
			
			"text" 		=> array("d" => "", "key" => "btn_txt"),	
			"href" 		=> array("d" => "", "key" => "btn_link"),
			
			 
		),	
	),	
);

$default_tags["data-ppt-btn-link"] = array(
	"key"		=> "btn_link",
	"inner" => array(
	"values" => array(		
			"href" 	=> array("d" => "", "key" => "btn_link"),
		),	
	),	
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



$default_tags["data-ppt-btn2-link"] = array(
	"key"		=> "btn2_link",
	"inner" => array(
	"values" => array(		
			"href" 	=> array("d" => "", "key" => "btn2_link"),		 
		),	
	),	
);

$default_tags["data-ppt-btn2-txt"] = array(
	"key"		=> "btn2_txt",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "btn2_txt", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "btn2_txt"),	
			"href" 	=> array("d" => "", "key" => "btn2_link"),
			"class" 	=> array("d" => "", "key" => "btn2_bg"),
			
			"color-bg" 	=> array("d" => "", "key" => "btn2_bg_color"),
			
		),	
	),	
); 


$i=1;
while($i < 10){

$default_tags["data-ppt-f".$i."-link"] = array(
	"key"		=> "f".$i."-link",
	"inner" => array(
		 
		"values" => array(		
		 
			"href" 	=> array("d" => "", "key" => "f".$i."-link"),
			"onclick" 	=> array("d" => "", "key" => "f".$i."-link-onclick"),
		),	
	),	
);


$default_tags["data-ppt-f".$i."a"] = array(
	"key"		=> "f".$i."a",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "f".$i."a", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "f".$i."a"),	
		),	
	),	
);


$default_tags["data-ppt-f".$i."b"] = array(
	"key"		=> "f".$i."b",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "f".$i."b", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "f".$i."b"),	
		),	
	),	
);

$default_tags["data-ppt-f".$i."c"] = array(
	"key"		=> "f".$i."c",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "f".$i."c", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "f".$i."c"),	
		),	
	),	
);

$default_tags["data-ppt-f".$i."icon"] = array(
	"key"		=> "f".$i."icon",
	"inner" => array(
		 
		"values" => array(	 
			"feature-icon" 	=> array("d" => "", "key" => "f".$i."icon"),	
		),	
	),	
);

$default_tags["data-ppt-f".$i."image"] = array(
	"key"		=> "f".$i."image",
	"inner" => array(
		 
		"values" => array(		
			"feature-image" 	=> array("d" => "", "key" => "f".$i."image"), 
		),	
	),	
);

	/* ?? svg image???
	$default_tags["data-ppt-icon".$i."-image"] = array(
		"key"		=> "icon".$i."_image",
		"editor"	=> '',
		"type" 		=> "image",
	);
	*/ 
	$i++;
}


$default_tags["data-ppt-image-video"] = array(
	"key"		=> "video_image",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"src" 	=> array("d" => "", "key" => "video_image"),
			"alt" 	=> array("d" => "", "key" => "video_image_title"),
			//"href" 	=> array("d" => "", "key" => "text_image1"),	
		),	
	),	
);
$default_tags["data-ppt-video-link"] = array(
	"key"		=> "video_link",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"href" 	=> array("d" => "", "key" => "video_link"),			
		),	
	),	
);



$default_tags["data-ppt-image"] = array(
	"key"		=> "image",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"data-src" 	=> array("d" => "", "key" => "image"),
			"alt" 	=> array("d" => "", "key" => "image_alt"),
			"href" 	=> array("d" => "", "key" => "image_link"),	
			
			"custom-css" 	=> array("d" => "", "key" => "image_css"),
			
		),	
	),	
);

$default_tags["data-ppt-image-bg-extra"] = array(
	"key"		=> "image",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"bg-image" 	=> array("d" => "", "key" => "image"),
			//"href" 	=> array("d" => "", "key" => "text_image1"),	
		),	
	),	
);

$default_tags["data-ppt-image-bg"] = array(
	"key"		=> "image",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"bg-image" 	=> array("d" => "", "key" => "image"),
			//"alt" 	=> array("d" => "", "key" => "image_title"),
			//"href" 	=> array("d" => "", "key" => "text_image1"),	
		),	
	),	
);

$i=1; while($i < 11){ 
$default_tags["data-ppt-image".$i] = array(
	"key"		=> "image".$i,
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"data-src" 	=> array("d" => "", "key" => "image".$i),	
			"custom-css" 	=> array("d" => "", "key" => "image".$i."_css"),		
		),	
	),	
);

$default_tags["data-ppt-image".$i."-bg"] = array(
	"key"		=> "image".$i,
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"bg-image" 	=> array("d" => "", "key" => "image".$i),			
		),	
	),	
);

$default_tags["data-ppt-image".$i."-link"] = array(
	"key"		=> "image".$i."_link",
	"inner" => array(
		"editor" => array(),
		"values" => array(		
			"href" 	=> array("d" => "", "key" => "image".$i."_link"),			
		),	
	),	
);

$default_tags["data-ppt-image".$i."-txt"] = array(
	"key"		=> "image".$i."_txt",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "image".$i."_txt", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "image".$i."_txt"),			
		),	
	),	
);
$default_tags["data-ppt-image".$i."-txt1"] = array(
	"key"		=> "image".$i."_txt1",
	"inner" => array(
		"editor" => array(
			'class' => "elementor-inline-editing", 
			"data" 	=> array( 'elementor-setting-key' => "image".$i."_txt1", 'elementor-inline-editing-toolbar' => 'none')
		),
		"values" => array(		
			"text" 	=> array("d" => "", "key" => "image".$i."_txt1"),			
		),	
	),	
);

$i++;
}


$default_tags["data-ppt-section"] = array(
	"key"		=> "section_bg",
	"inner" => array(
		"editor" => array(
			'class' => "", 
			"data" 	=> ''
		),
		"values" => array(		
			"class" 	=> array("d" => "", "key" => "section_bg"),	
			"custom-css" 	=> array("d" => "", "key" => "section_css"),
			"class-padding" 	=> array("d" => "", "key" => "section_padding"),	
			"class-margin" 	=> array("d" => "", "key" => "section_margin"),
			
			//"data-divider" 	=> array("d" => "", "key" => "section_divider"),
			//"data-overlay" 	=> array("d" => "", "key" => "section_overlay"),	
			
			"color-bg" 	=> array("d" => "", "key" => "section_bg_color"),
			
			"mobile_hide_bg" 	=> array("d" => "", "key" => "section_mobile_hide_bg"),
			 
			
		),	
	),	
);
 

if(is_array($elementor_settings) && !empty($elementor_settings) ){ // INSIDE ELEMENTOR 

$patterns = array();
foreach($default_tags as $k => $v){	 

	// UPDATE TEXT
	if(isset($v['inner']['values'])){
		foreach($v['inner']['values'] as $vk => $val){ 
							
			if(isset($val['key']) && !is_array($val['key']) && strlen($val['key']) > 1 && isset($elementor_settings[$val['key']]) && !is_array($elementor_settings[$val['key']]) ){ 			 
				$v['inner']['values'][$vk]['d'] = trim($elementor_settings[$val['key']]);  
			}
			
			// DROP EMPTY VALUES 
			if(!in_array($vk,array("animated","underline")) && $v['inner']['values'][$vk]['d'] == ""){
				unset($v['inner']['values'][$vk]);
			}
		}	
		
		$action = "replace";
		if(in_array($k,array("data-ppt-title", "data-ppt-subtitle", "data-ppt-desc")) && isset($v['inner']['values']['text']['d']) && $v['inner']['values']['text']['d'] == " "){
		 $action = "remove";
		}
		 
		
		$patterns[] = array(
				'xpath'   	=> '//*[@'.$k.']',
				//'insert'  	=> $tag,
				'task'    	=> $action,
				'inner' 	=> $v['inner'],
		);	
	}		
}
 
//die(print_r($patterns));
 
if ($html) {
    $dom = new DOMDocument();
	libxml_use_internal_errors(true);
    if (!$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'))) {
        $error = 'Error while loading source HTML!';
    } else {
        
		$dom->formatOutput = true;
        // Use DomXPath
        $xpath = new DomXPath($dom);
        // Process Dom changes
        foreach ($patterns as $pattern) {
		
		if(isset($GLOBALS['updatedContent'])){ unset($GLOBALS['updatedContent']); }
		
            $xpath_results = $xpath->query($pattern['xpath']);
			
            if ($xpath_results->length) {
			
                $node = $xpath_results->item(0);
				 
				
                if (!@$error) { //&& $pattern['insert'] != "" 
				 
				
                    switch ($pattern['task']) {
                        case 'remove':
                            $node->parentNode->removeChild($node);
                            break;
                        case 'replace': {

							if(!empty($pattern['inner'])){
																				
								foreach($pattern['inner'] as $k => $v){
								
									switch($k){	
										case "editor": {
											if(is_admin()){
											foreach($v as $ik => $iv){												
												switch($ik){
													case "class":{
														$node->setAttribute("class", $node->getAttribute("class")." ".$iv);
													} break;
													case "data":{
														if(is_array($iv)){
														foreach($iv as $ddi => $ddik){
															$node->setAttribute("data-".$ddi, $ddik);
														}
														}else{
														//echo $iv."<---";
														}								
													} break;
												}											
											}												
											}
										} break;	
										case "values": {
										
											foreach($v as $ik => $iv){											
											
												switch($ik){
												
												
													case "remove": {
													
														if($iv['d'] == "0"){
															$node->parentNode->removeChild($node);
																												
														}
													
													} break;
													
												
													case "animated": {
													 
													if($iv['d'] == ""){
													
													// DO NOTHING
													}else{
													 
													 
													global $df;
													$df['animated'] = $iv['d'];
													
													// string is
													$currentString = $node->nodeValue;
													if(isset($GLOBALS['updatedContent'])){
													$currentString = $GLOBALS['updatedContent'];
													}
													    	
													$string = preg_replace_callback("|\[(.*)\]|", function($matches) {  global $df;
 
															   if (isset($matches[0]) && isset($matches[1]) ) {																 
																 
																 $df['animated-data'] = $matches[1];
																 $df['animated-divid'] =  rand(0,19999);																
																
																$txt = $matches[1];
															   
																 return "<span class='ppt-animate' data-animation='".$df['animated']."' data-items=\"".$txt."\" data-id='".$df['animated-divid']."'> </span>";
																
																
															  }
															  else {
																 return 0;
															  }
															  
													}, $currentString);
													 
													if($string != "0"){
													 
														$template = $dom->createDocumentFragment();
														$template->appendXML($string); 					
														$node->nodeValue = "";
														$node->appendChild($template);
														 
														
													}
													
													}
													
													
													} break;
													
													case "mobile_hide_bg": {
													 
														if($iv['d'] == "1"){
															$class = $node->getAttribute("class");	
															$node->setAttribute("class", $class." hide-mobile-bg"); 
														}
														
													} break;
													
													case "underline": {
													 
													 
													if($iv['d'] == ""){
												 		// DO NOTHING		
													}else{
														 
														global $df;
														$df['underline'] = $iv['d'];
														$df['undercolor'] = "blue";
														if(isset($v['underline_color'])){
														$df['undercolor'] = $v['underline_color']['d'];
														}
																	
														$string = preg_replace_callback("|\{(.*)\}|", function($matches) {  global $df;
	 
																   if (isset($matches[0]) && isset($matches[1]) ) {
																																	
																	ob_start();
																	_ppt_template( 'framework/design/headline/parts/headline_underline' );
																	$underline = ob_get_contents();
																	ob_end_clean();
																	
																	if($df['underline'] == 15){
																		
																		if($df['undercolor'] == "blue"){ 
																		return "<span class='text-primary'>".$matches[1]."</span>";
																		}else{
																		return "<span style='color:".$df['undercolor']."'>".$matches[1]."</span>";
																		}
																	
																	
																	}elseif($df['underline'] > 9){
																	 return '<span class="ppt-headline"><span class="ppt-line">'.$matches[1]."<span class='ppt-line-".$df['underline']."' style='background:".$df['undercolor']."'></span></span></span>";
																	}else{
																	 return '<span class="ppt-headline">'.$matches[1].$underline."</span>";
																	}
																	  
																	
																  }
																  else {
																	 return 0;
																  }
																}, $node->nodeValue);
														
														
														if($string != "0" && strlen($string) > 1){  
															 
															$template = $dom->createDocumentFragment();
															$template->appendXML($string);
															$node->nodeValue = "";
															$node->appendChild($template);
															$GLOBALS['updatedContent'] = $string; 
															
														}
													
													}
													
													
													} break;
													
												
													case "bg-image": {
													if(!is_array($iv['d']) && strlen($iv['d']) > 1){
													$node->setAttribute("style", "background-image:url('".$iv['d']."');" );
													$node->setAttribute("data-bg", $iv['d'] );
													}
													} break;
													
													case "color": {
													
														if(substr($iv['d'],0,1) == "#"){
														$node->setAttribute("style", "color:".$iv['d'].";" );
														}else{
														$class = $node->getAttribute("class");	
														$node->setAttribute("class", $class." ".$iv['d']);	
														}
														
													} break;
													
													case "color-bg": {
														$node->setAttribute("style", "background-color:".$iv['d']."!important;" );
													} break; 
													
													case "feature-icon": {
													
														$cd = $node->getAttribute("class");
														$extra = "";
														 
														if(strpos($cd,"4x") !== false){
														$extra .= " fa-4x";
														}
														$cd = str_replace("fa-"," ",$cd); 
														
														// NEW ICON
														$new_icon = str_replace("fa ","fal ",$iv['d']);
														 			
														$node->setAttribute("class", $cd." ".$new_icon.$extra);	 
														
													} break;
													
													case "feature-image": {
														
														if(strlen($iv['d']) > 1){
														
														$string = "<img src='".$iv['d']."' class='img-fluid' />";
														
														$template = $dom->createDocumentFragment();
														$template->appendXML($string);
														$node->nodeValue = "";
														$node->appendChild($template);
														$GLOBALS['updatedContent'] = $string; 
														
														}
													
													
													}  break;
													
													case "icon": {	
													
													$icon = $iv['d'];													 
													$size = $node->getAttribute("ppt-icon-size");														
													$class = $node->getAttribute("class");														
													
													if(substr($iv['d'], 0,4) == "svg-"){
													
														$svg =  substr($iv['d'],4,1000);
														 
														if(isset($CORE_UI->icons_svg[$svg])){
														
															$icon = '<div ppt-icon-size="'.$size.'" class="'.$class.'">'.$CORE_UI->icons_svg[$svg]."</div>";
															 
															$template = $dom->createDocumentFragment();
															$template->appendXML($icon); 															 
															//$node->replaceWith($template);
															 
															
														}														 
														
														
													}else{
														$cd = $node->getAttribute("class");
														$node->setAttribute($ik, $cd." ".$iv['d']);	
													}	 
													
													//$cd = $node->getAttribute("class");
													//$node->parentNode->removeChild($node);
													
													} break;
													
													case "custom-css":
													case "class-padding":
													case "class-color":
													case "class-size":
													case "class-weight":
													case "class-margin":
													case "class-align":
													case "class": {	
													
													$cd = $node->getAttribute("class");
													
													// REMOVE DEFAULT BTN STYLES
													if(strpos($iv['d'],"btn-") !== false){
														foreach(array("btn-system","btn-primary","btn-secondary","btn-dark","btn-light","btn-white","btn-black","btn-orange") as $rr){
														$cd = str_replace($rr,"",$cd);
														} 
													}
													
													// REMOVE DEFAULT BTN STYLES
													if($ik == "class-color" && strpos($iv['d'],"text-") !== false){
														foreach(array("text-dark","text-primary","text-secondary","text-light") as $rr){
														$cd = str_replace($rr,"",$cd);
														} 
													}
													
													// REMOVE DEFAULT BTN STYLES
													if($ik == "class-padding" && $iv['d'] != ""){
														$cd = str_replace("section-","section-old-",$cd);
													}
													
													// REMOVE DEFAULT BG STYLES
													if($iv['d'] == "bg-remove"){
													$cd = str_replace("bg-","bg----",$cd);
													} 
													
													// UPDATE EXISTING CLASS WITH NEW VALUES
													//if($iv['d'] != ""){												
													$node->setAttribute("class", $cd." ".$iv['d']);	
													//}
																										
													} break;											
																										
													case "text": {	
													
																							
														if(strlen($iv['d']) > 0){
														
															 $node->nodeValue = htmlentities($iv['d']);
														  
														}	 
																											
													} break;
													
													default: {
														if(is_array($iv['d'])){
														//die(print_r($iv['d']));
														}elseif(strlen($iv['d']) > 0){
														$node->setAttribute($ik, $iv['d']);
														}
													} break;
												} // end switch
											
											}	 
																				
										} break;							
									
										default: {
										 
										
										} break;
									}									 
								}							
							}						
							
						   } break;
                        case 'append':
                            $node->parentNode->appendChild($newNode);
                            break;
                        case 'prepend':
                            $node->parentNode->insertBefore($newNode, $node);
                            break;
                        default:
                            $error = ""; //"Wrong task pattern: $pattern['task']!";
                    }
                }
            }
        }
    }
    if (@$error) {
        // print or return $error...
    } else {
        // Save Dom
        $html = $dom->saveXML($dom->documentElement);
    }
	libxml_use_internal_errors(false);
}
 

}// END INSIDE ELEMENTOR


 


// SWITCH OUT FONTAWESOME ICONS FOR SVG VERSION

$html = str_replace("&lt;svg","<svg", $html);
$html = str_replace("&lt;/svg&gt;","<svg>", $html);
$html = str_replace("&lt;br&gt;","<br />", $html);
$html = str_replace("&lt;br /&gt;","<br />", $html);
$html = str_replace("&amp;","&", $html);
 
$html = str_replace("&lt;span&gt;","<span>", $html);
$html = str_replace("&lt;/span&gt;","</span>", $html);
 
$html = str_replace("&#13;","", $html);

$html = str_replace("&lt;date&gt;","<date>", $html);
$html = str_replace("&lt;/date&gt;","</date>", $html);
  
$html = str_replace("&lt;strong&gt;","<strong>", $html);
$html = str_replace("&lt;/strong&gt;","</strong>", $html);

 


if(isset($_REQUEST['action']) && $_REQUEST['action'] == "elementor"){
$html = str_replace('class="hide"',"", $html);
}

// LINK FILTERS

$html = $CORE->_ppt_filter_link($html);

// CHILD THEME IMAGES
if(strpos($html,"[path-images]") !== false){
	
	if(defined('WLT_DEMOMODE') && isset($_SESSION['skin']) && substr($_SESSION['skin'],0,10) == "childtheme" ){ 
	
		$f = wp_get_theme();
		 
		$html = str_replace("[path-images]", str_replace($f->stylesheet,$_SESSION['skin'],get_template_directory_uri()), $html);
		
	}

	$html = str_replace("[path-images]","", $html);
}

// FULL WIDTH HACKS
if(isset($elementor_settings['section_w']) && in_array($elementor_settings['section_w'], array("container-slim","container-fluid"))){
$html = str_replace("container",$elementor_settings['section_w'], $html);
}

// ADD ON DIVIDER

if(isset($elementor_settings['section_divider']) && $elementor_settings['section_divider'] != ""){
	
 	 
	global $divdata;
	$divdata['section_divider'] 				= $elementor_settings['section_divider'];
	$divdata['section_divider_color1'] 			= $elementor_settings['section_divider_color1'];
	$divdata['section_divider_color2'] 			= $elementor_settings['section_divider_color2']; 
	
	$divdata['section_divider_color1_custom'] 	= "";
	if(isset($elementor_settings['section_divider_color1_custom'])){
	$divdata['section_divider_color1_custom'] 	= $elementor_settings['section_divider_color1_custom'];
	}
	
	$divdata['section_divider_color2_custom'] 	= "";
	if(isset($elementor_settings['section_divider_color2_custom'])){
	$divdata['section_divider_color2_custom'] 	= $elementor_settings['section_divider_color2_custom'];
	}
	

	ob_start();
	_ppt_template( 'framework/design/parts/divider' );
	$dividercode = ob_get_contents();
	ob_end_clean();
	$html = $html.$dividercode; 

}

 

return $html;
}







///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
function ppt_theme_listing_blocks($elementor = 0){ 
	 
$list = array( 


 	"title1" 	=> array(
	
		"name"		=> __("Title","premiumpress"), 		
		"styled" 	=> "single/single-title", 
		"unstyled" 	=> "single/single-content-data-title",
	),
 
	"description" 	=> array(
	
		"name"		=> "Description", 		
		"styled" 	=> "single/single-content", 
		"unstyled" 	=> "single/single-content-data-description",
	),
 
 	"features" 	=> array(
	
		"name"		=> __("Features","premiumpress"), 		
		"styled" 	=> "single/single-features", 
		"unstyled" 	=> "single/single-content-data-features",
	),
	
 	"author" 	=> array(
	
		"name"		=> __("Author Box","premiumpress"), 		
		"styled" 	=> "single/single-author", 
		"unstyled" 	=> "single/single-author",
	),
	 
	"map" 	=> array(
	
		"name"		=> __("Map","premiumpress"), 		
		"styled" 	=> "single/single-map", 
		"unstyled" 	=> "single/single-content-data-map",
	),
	
	"reviews" 	=> array(
	
		"name"		=> __("Reviews","premiumpress"), 		
		"styled" 	=> "single/single-reviews", 
		"unstyled" 	=> "single/single-content-data-reviews",
	),
	
	"contact" 	=> array(
	
		"name"		=> __("Contact Form","premiumpress"), 		
		"styled" 	=> "single/single-contact", 
		"unstyled" 	=> "single/single-content-data-contact",
	),	
	
	"hours" 	=> array(
	
		"name"		=> __("Viewing Times","premiumpress"), 		
		"styled" 	=> "single/single-hours", 
		"unstyled" 	=> "single/single-content-data-hours",
	),
		
	"sidebar" 	=> array(
	
		"name"		=> "Sidebar", 		
		"styled" 	=> "single/single-sidebar-content", 
		"unstyled" 	=> "single/single-sidebar-content",
	),
	
	"gifts" 	=> array(
	
		"name"		=> __("Gifts","premiumpress"), 		
		"styled" 	=> "single/single-gifts", 
		"unstyled" 	=> "single/single-content-data-gifts",
	),
	
	"rates" 	=> array(
	
		"name"		=> __("Rates","premiumpress"), 		
		"styled" 	=> "single/single-rates", 
		"unstyled" 	=> "single/single-content-data-rates",
	),
	
	"stats" 	=> array(
	
		"name"		=> __("Stats Bar","premiumpress"), 		
		"styled" 	=> "single/single-statsbar", 
		"unstyled" 	=> "single/single-statsbar",
	),
	
	"popular" 	=> array(
	
		"name"		=> __("Popular Ads","premiumpress"), 		
		"styled" 	=> "single/single-popular", 
		"unstyled" 	=> "single/single-popular",
	),
	
	"files" 	=> array(
	
		"name"		=> __("Attachments","premiumpress"), 		
		"styled" 	=> "single/single-files", 
		"unstyled" 	=> "single/single-content-data-files",
	),
	
	"videos" 	=> array( 
		"name"		=> __("User Videos","premiumpress"), 		
		"styled" 	=> "single/single-videos", 
		"unstyled" 	=> "single/single-content-data-videos",
	),
	
	
	
	"customfields" 	=> array(
	
		"name"		=> __("Custom Fields","premiumpress"), 		
		"styled" 	=> "single/single-fields", 
		"unstyled" 	=> "single/single-content-data-fields",
	),
	
	"services" 	=> array(
	
		"name"		=> __("Services","premiumpress"), 		
		"styled" 	=> "single/single-services", 
		"unstyled" 	=> "single/single-content-data-services",
	),
	
	"share" 	=> array(
	
		"name"		=> __("Share Box","premiumpress"), 		
		"styled" 	=> "single/single-share", 
		"unstyled" 	=> "single/single-content-data-share",
	),
	
	
	"related" 	=> array(
	
		"name"		=> __("Recommended Ads","premiumpress"), 		
		"styled" 	=> "single/single-related", 
		"unstyled" 	=> "single/single-content-data-related",
	),
		
	"faq" 	=> array(
	
		"name"		=> __("FAQ","premiumpress"), 		
		"styled" 	=> "single/single-faq", 
		"unstyled" 	=> "single/single-content-data-faq",
	),
	
	"claim" 	=> array(
	
		"name"		=> __("Clam Box","premiumpress"), 		
		"styled" 	=> "single/single-claim", 
		"unstyled" 	=> "single/single-claim",
	),
		
						
);

// THIS THEME
$ThisTheme = THEME_KEY;
if(isset($GLOBALS['TEST_THEME_KEY'])){
	$ThisTheme = $GLOBALS['TEST_THEME_KEY'];
}


if(in_array($ThisTheme, array("sp") ) ){
foreach($list as $k => $v){
	if(!in_array($k,array("sidebar","title1","title2","description","reviews","contact","share" ))){
		unset($list[$k]);
	}
}
}
 

 
if(!in_array($ThisTheme, array("es","da") ) ){
unset($list['gift']);
}

if(!in_array($ThisTheme, array("es") ) ){
unset($list['rates']);
}

if(!in_array($ThisTheme, array("mj") ) ){
unset($list['faq']);
}

if(!in_array($ThisTheme, array("dt") ) ){
unset($list['services']);
unset($list['claim']);
}

switch($ThisTheme){

	case "rt": {
		$list['hours']['name'] = __("Viewing Times","premiumpress");
	} break;
	case "dl": {
		$list['hours']['name'] = __("Viewing Times","premiumpress");
	} break;
	case "at": {
	 
	} break;
	case "da": {
		unset($list['author']);
		$list['dating'] = "Dating Like Box";	
	} break;	
	case "cm": {
		$list['compare'] = "Price Compare";	
	} break;
	case "sp": {	  
		$list['sidebar']['name'] = __("Product Checkout Box","premiumpress");		
	} break;
	case "mj": {
		$list['microjob'] = "Micro Job Bar";	
	} break;
	case "cp": {
		  
		 $list['sidebar']['name'] = __("Coupon Box","premiumpress");	
		
	} break;
	case "vt": {
		$list['video'] = "Video Likes Bar";	
	} break;
	case "dt": {
		$list['directory'] = "Claim Listing";	
		$list['hours']['name'] = __("Opening Hours","premiumpress");
	} break;
	case "so": {
		
		//$list['membershipaccess'] = "Membership Access";
	} break;
	case "pj": {
	
		unset($list['reviews']);
		
		$list['project'] = "Project Box";	
		$list['project-bids'] = "User Offers Box";
		$list['user-downloads'] = "User Downloads"; 
		
	} break;

	case "es": {	  
		$list['hours']['name'] = __("My Availability","premiumpress");		
	} break;
	
	case "jb": {
		$list['hours']['name'] = __("Interview Times","premiumpress");
	} break;	
	
}

$newlist = array();
if($elementor){

	foreach($list as $k => $v){
		if(isset($v['name'])){
		$newlist[$k] = $v['name']; 
		}
	}
	return $newlist;

}
 
return $list;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_listing_buttons($show){ global $post, $CORE, $CORE_UI;

 
$list = array();

$ThisTheme 	= THEME_KEY; 
if(isset($GLOBALS['TEST_THEME_KEY'])){
$ThisTheme 	= $GLOBALS['TEST_THEME_KEY'];
}
 
 
$list["message"] 	= array("name" => __("Send Message","premiumpress"),"order" => 10, "show" => array() );
$list["favs"] 		= array("name" => __("Add to favorites","premiumpress"),"order" => 10, "show" => array()  );
$list["favs1"] 		= array("name" => __("Add to favorites (text)","premiumpress"),"order" => 10, "show" => array() );
$list["friends"] 	= array("name" => __("Add Friends","premiumpress"),"order" => 10, "show" => array() );
$list["report"] 	= array("name" => __("Report Button","premiumpress"),"order" => 10, "show" => array() );

switch($ThisTheme){

	case "es": {
	
		$list["phone"] 		= array("name" => __("Phone Reveal","premiumpress"),"order" => 10, "show" => array("single_top") );		 
		//$list["gift"] 		= array("name" => __("Send Gift","premiumpress") );
		$list["whatsapp"]	 = array("name" => __("Whats App","premiumpress"),"order" => 10, "show" => array("single_top") );
		
		array_push($list["message"]["show"], "single_top");
	
	} break;
	
	case "da": {
	
		$list["message"] 	= array("name" => __("Send Message","premiumpress"),"order" => 10, "show" => array("single_top")  ); 		
		$list["wink"] 		= array("name" => __("Send Wink","premiumpress"),"order" => 10, "show" => array("single_top") );	  
		//$list["report"] 	= array("name" => __("Report Button","premiumpress"),"order" => 10, "show" => array("single_top") );


	} break;	
	
	case "jb": {	 
	
		$list["offer"] 		= array("name" => __("Apply Now","premiumpress"),"order" => 10, "show" => array("single_top") );		
 	
	} break;
	
	case "ct": { 
	 
		$list["offer"] 		= array("name" => __("Make Offer","premiumpress"),"order" => 10 );	 
	
	} break;
	
	case "dt": { 
	
		$list["phone"] 	= array("name" => __("Phone Reveal","premiumpress"),"order" => 10 ); 
 		
	} break;
	
	case "dl": {
	
		$list["favs1"] 	= array("name" => __("Send Message","premiumpress"),"order" => 7, "show" => array("single_top")  ); 
		$list["offer"] 		= array("name" => __("Make Offer","premiumpress"),"order" => 8, "show" => array("single_top")  );
		$list["buynow"] 	= array("name" => __("Buy Now","premiumpress"),"order" => 9, "show" => array("single_top")  );		
 	

	} break;
	
	case "cm": {
	
		$list["buy_cm"] 	= array("name" => __("Buy Now","premiumpress"),"order" => 10 ); 
 		 
	} break;
	
	case "pj": { 
		
		$list["favs1"] 	= array("name" => __("Send Message","premiumpress"),"order" => 3, "show" => array("single_top")  ); 
		$list["offer"] 		= array("name" => __("Apply Now","premiumpress"), "order" => 4, "show" => array("single_top") );		
 		$list["buynow"] 	= array("name" => __("Buy Now","premiumpress"), "order" => 5, "show" => array("single_top") );		
 	
	} break;
	
	case "so": { 
		
		$list["demo"] 		= array("name" => __("View Demo","premiumpress"),"order" => 10, "show" => array("single_top")  ); 
		$list["website"] 	= array("name" => __("Visit Website","premiumpress"),"order" => 10, "show" => array("single_top")  );
		 
		$list["download"] 	= array("name" => __("Download Button","premiumpress"),"order" => 11, "show" => array("")  );
		  
		 
		 
	} break;
	
	case "ll": {
	
		$list["favs1"] 	= array("name" => __("Send Message","premiumpress"),"order" => 3, "show" => array("single_top")  ); 	 
		$list["offer"] 		= array("name" => __("Enroll Now","premiumpress"),"order" => 10, "show" => array("single_top")  );		
 		$list["message"] 	= array("name" => __("Send Message","premiumpress"),"order" => 10, "show" => array("single_top") );
 	
	} break;
	
	case "rt": {
	 
		$list["offer"] 		= array("name" => __("Book Viewing","premiumpress"),"order" => 10, "show" => array("single_top")  );		
 		$list["message"] 	= array("name" => __("Send Message","premiumpress"),"order" => 10, "show" => array("single_top") );
		$list["favs"] 		= array("name" => __("Add to favorites","premiumpress"),"order" => 10, "show" => array("single_top")  );

	} break;
	case "vt": {
	 
  	
	} break;
	default: {
	 
		$list["favs"] 	= array("name" => __("Add to favorites (button)","premiumpress"),"order" => 10, "show" => array("single_top")  );
	
	} break;
	
}

 
if($show == "elementor"){

	$newlist = array();
	foreach($list as $k => $v){
		$newlist[$k] = $v['name'];
	}
	return $newlist;
} 

if($show == "elementor_defaults"){
 
	$newlist = array();
	$i = 0;
	foreach($list as $k => $v){
		$newlist[$i] = array("field" => $k, "field_name" => $v['name'] );
		$i++;
	}
 
	return $newlist;
}

return $list;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_listing_data_single($show){ global $post, $CORE, $CORE_UI;

if(!isset($post->ID)){ return; }

$ThisTheme 	= THEME_KEY; 

$list = array();


$list["price"] = array(
	"name" 		=> __("Price","premiumpress"),
	"label" 	=> __("Price","premiumpress"),  
	"data" 		=> get_post_meta($post->ID,"price",true), 
	"icon" 		=> "",
	"example"	=> "10.99",
	"type" 		=> "price",
);


if($show == "elementor"){

	$newlist = array();
	foreach($list as $k => $v){
		$newlist[$k] = $v['name'];
	}
	return $newlist;
} 

if($show == "elementor_defaults"){
 
	$newlist = array();
	$i = 0;
	foreach($list as $k => $v){
		$newlist[$i] = array("field" => $k, "field_name" => $v['name'] );
		$i++;
	}
 
	return $newlist;
}

return $list;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_listing_data($show){ global $post, $CORE, $CORE_UI;

if(!isset( $post->ID )){ return; }


$ThisTheme 	= THEME_KEY;  
$list = array(); 

switch(THEME_KEY){
 

	case "jb": {
	
		$list["salary"] = array(
			"name"	=> __("Salary","premiumpress"),				
			"label"	=> __("Salary","premiumpress"),
			"data"	=> do_shortcode('[PRICE]').do_shortcode('[SALARYTYPE]'),
			"type" => "text",
			"tax"	=> "", 
		);
		
		$list["country"] = array(
			"name"	=> __("Country","premiumpress"),				
			"label"	=> __("Country","premiumpress"),
			"data"	=> do_shortcode('[COUNTRY]'),
			"type" => "text",
			"tax"	=> "", 
		);
		
		$list["city"] = array(
			"name"	=> __("City","premiumpress"),				
			"label"	=> __("City","premiumpress"),
			"data"	=> do_shortcode('[CITY]'),
			"type" => "text",
			"tax"	=> "", 
		);
	
	} break;

}



$THISPOSTID = $post->ID;

// GET CATEGORY FOR THIS LISTING
$incats = wp_get_post_terms( $THISPOSTID, "listing" );
$incatsarray = array();
if(is_array($incats)){
	foreach($incats as $cad){
		$incatsarray[$cad->term_id] = $cad->term_id;
	}
}

// GET FIELDS
$regfields = get_option("cfields"); 			
			 
// START COUNTER
$i=0;

// CHECK HAS VALUES
if(is_array($regfields) && isset($regfields['dbkey']) ){ 			
	
	foreach($regfields['dbkey'] as $field){					 
	
		if(isset($regfields['editonly'][$i]) && $regfields['editonly'][$i] == "yes"){  $i++; continue; }
						 
			// CHECK IF THIS IS A HIDDEN FIELD
			if(!isset($regfields['dbkey'][$i]) || (isset($regfields['dbkey'][$i]) && $regfields['dbkey'][$i] == "")  ){ $i++; continue; }
				
				if(in_array(THEME_KEY, array("ll")) && $regfields['dbkey'][$i] == "req"){ continue; }	 // LL THEME			
				
				// CHECK THIS FIELD IS FOR THIS CATEGORY				 
				$canShow = false;				 
				if(isset($regfields['cat']) && isset($regfields['cat'][$i]) &&  is_array($regfields['cat'][$i]) && empty($regfields['cat'][$i])){
				
					$canShow = true;
					
				}elseif(isset($regfields['cat']) && isset($regfields['cat'][$i]) && is_array($regfields['cat'][$i]) && !empty($regfields['cat'][$i]) ){
				
					foreach($regfields['cat'][$i] as $fc){						
						if(in_array($fc, $incatsarray)){						
							$canShow = true;
						}
					}	
								
				}else{				 
				
					$canShow = true;
				}
				 	 
				// SHOW ALL CATS
				if(!isset($regfields['cat'][$i][0]) || isset($regfields['cat'][$i][0]) && ( $regfields['cat'][$i][0] == "" || $regfields['cat'][$i][0] == "0" )){
				$canShow = true;
				}
						 		
				if(!$canShow){ $i++; continue; }	 
					 
				// CHECK IF IS HEADLINE
				if($regfields['fieldtype'][$i] == "title"){ 						
						
						
						$titlecss = "text-primary my-4";
						
						if(!isset($titlecount)){
							$titlecount = 1;
							$titlecss = "text-primary my-4";						
						} 
						
						//$STRING .="<div class='col-12'><h6 class='".$titlecss."'>".$CORE->GEO("translate_field_name", array( stripslashes($regfields['name'][$i]), $i, $regfields))."</h6></div>";
						 
								
						$list[$regfields['dbkey'][$i]] = array( 
						"name"	=> $CORE->GEO("translate_field_name", array( stripslashes($regfields['name'][$i]), $i, $regfields)), 
						"label"	=> $CORE->GEO("translate_field_name", array( stripslashes($regfields['name'][$i]), $i, $regfields)),
						"data"	=> "",
						"type" => "", 
						"tax"	=> "", 
						"type"	=> "title", 
						);
								
						
						 
						
						$i++; 
						continue;
				}
				
			
						  
					 		  
						// CHECK FOR YOUTUBE LINK
						if($regfields['fieldtype'][$i] == "taxonomy"){	
										
							$my_categories = get_the_terms( $THISPOSTID, $regfields['taxonomy'][$i] );
													  
							$value = "";
							if ( is_array( $my_categories ) ) {
								foreach ( $my_categories as $my_category ) {
									  
									$value .= $CORE->GEO("translation_tax", array($my_category->term_id, $my_category->name));
									
									if(count($my_categories) > 1){
									
									$value .= ", ";
									
									
									}
								}
							}
							
							
						}else{
						
							$v_check = get_post_meta($THISPOSTID, $regfields['dbkey'][$i], true);						 
						 	 
							 
							 	
							// CHECK FOR EMAIL							
							if(!is_array($v_check) && strpos($v_check,"@") !== false){	
														
								$v_check = "<a href='mailto:".$v_check."' rel='nofollow' style='text-decoration:underline;'>".$v_check."</a>";								
							
							// IF LINKS MAKE OUTBOUND
							}elseif(!is_array($v_check) && ( substr($v_check,0,4) == "http" || substr($v_check,-4) == ".com")){	
							 
							
									if(get_option('permalink_structure') == ""){
									$link = $v_check;								
									}else{
									//$link = get_home_url()."/out/".$THISPOSTID."/".$regfields['dbkey'][$i]."/";
									$link = $v_check;
									}
									
									$icon = ""; 
									$text = "<u>".__("Visit Website","premiumpress")."</u>";
									
									if(strpos($v_check, "facebook") !== false){
									$icon = "<i class='fab fa-facebook mr-2 text-primary'></i>";
									$text = __("Visit Facebook","premiumpress");									
									}
									
									if(strpos($v_check, "instagram") !== false){
									$icon = "<i class='fab fa-instagram mr-2 text-primary'></i>";
									$text = __("Visit Instagram","premiumpress");									
									}
									 
									if(strpos($v_check, "skype.com") !== false){
									$icon = "<i class='fab fa-skype mr-2 text-primary'></i>";
									$text = __("Skype Chat","premiumpress");									
									}
									
									if(strpos($v_check, "youtube") !== false){
									$icon = "<i class='fab fa-youtube mr-2 text-primary'></i>";
									$text = __("Visit YouTube","premiumpress");									
									}
									
									if(strpos($v_check, "twitter.com") !== false){
									$icon = "<i class='fab fa-twitter mr-2 text-primary'></i>";
									$text = __("Visit Twitter","premiumpress");									
									}
								 
									
									
									$v_check = "<a href='".$link."' class='text-dark' rel='nofollow' target='_blank'>".$icon.$text."</a>";													
							
							
							
							// CHECK BOX DISPLAY						 						
							}elseif(is_array($v_check)){
								$nstring = "";						 					 				 									
								foreach($v_check as $vk=>$vd){
									if(!is_array($vd) && $vd != "" && $vd != "--" && $vd !="Array"){
									 
									$nstring .= "".$vd.", ";
									}
								}
								$nstring = substr($nstring,0,-2);
								$v_check = $nstring;						
							}
							if($regfields['dbkey'][$i] == "price"){						 
							$v_check = hook_price($v_check);						
							}
						 
							if($regfields['fieldtype'][$i] == "textarea"){	
							$v_check = wpautop($v_check);
							}
							
							// INTEGRATION FOR COUPONS
							if( isset($GLOBALS['CORE_THEME']['coupon']['code_key']) && $GLOBALS['CORE_THEME']['coupon']['code_key'] == $regfields['dbkey'][$i]  ){
								$v_check = '[CBUTTON]';
							}
							if($regfields['dbkey'][$i] == "expires" || $regfields['dbkey'][$i] == "expiry_date"){						 
							$v_check = $this->date_timediff( $v_check );						
							}
							if($regfields['dbkey'][$i] == "start_date"){						 
							$v_check = $this->format_date( $v_check );						
							}
							
														
							$value = $v_check;
						}
						$values = "";
						
						 
						if(is_array($value)){ 
						
							foreach($value as $val){			
								if(is_object($val)){
								$values .= " <a href='".get_term_link($val->slug, $regfields['taxonomy'][$i]). "'>".$val->name."</a>";
								}if(!is_array($val) && !is_object($val) && strlen($val) > 2){ $values .= " ".$val; 
								}elseif(is_array($val)){ 
									foreach($val as $val1){ 						 
										$values .= " ".$val1; 						 
									} // end foreach
								} // end if
							} // end foreach
						
						}else{ $values = $value; }	
				
				
				if(!is_object($values)){ 
							
						// ADD ON DATE FORMAT
						if($regfields['fieldtype'][$i] == "date"){ $values = hook_date($values); }
								
								
									
				if($regfields['fieldtype'][$i] == "select"){ 				
				 $values = trim(stripslashes(str_replace("_"," ",str_replace("::",",", str_replace(";;","'", $values)))));		
				
				}
				
				 
				if($regfields['name'][$i] != "" && strlen($regfields['name'][$i]) > 1){ 
				
				$list[$regfields['dbkey'][$i]] = array(
				
				"name"	=> $CORE->GEO("translate_field_name", array( stripslashes($regfields['name'][$i]), $i, $regfields)),
				
				"label"	=> $CORE->GEO("translate_field_name", array( stripslashes($regfields['name'][$i]), $i, $regfields)),
				"data"	=> $values,
				"type" => $regfields['fieldtype'][$i],
				"tax"	=> $regfields['taxonomy'][$i], 
				"type"	=> $regfields['fieldtype'][$i], 
				);
								
				}	
			}
							
			// NEXT FIELD
			$i++;
		} 
	} 
	
// REMOVE BLANK FIELDS
if(isset($list['price']) && $list['price']['data'] == "$0.00"){
unset($list['price']);
}	
	 
 	
if($show == "elementor"){

	$newlist = array();
	foreach($list as $k => $v){
		$newlist[$k] = $v['name'];
	}
	return $newlist;
} 

if($show == "elementor_defaults"){
 
	$newlist = array();
	$i = 0;
	foreach($list as $k => $v){
		$newlist[$i] = array("field" => $k, "field_name" => $v['name'] );
		$i++;
	}
 
	return $newlist;
}


if(isset($GLOBALS['flag-button-set-phone']) && isset($list['phone']) ){
unset($list['phone']);
}


return $list;

}

function ppt_theme_card_data($show){ global $post, $CORE, $CORE_UI, $userdata;

   // ADMIN PREVIEW
    if(!isset($post->ID)){
		$post = new stdClass();
		$post->ID 			= 1;
		$post->post_title 	= "This is a sample title."; 
		$post->post_author 	= 1; 
		$post->post_excerpt = "";
		$post->post_content = "";
		$post->comment_count = 0;
		$post->post_date = "";
	}


$ThisTheme 	= THEME_KEY; 

if(isset($GLOBALS['TEST_THEME_KEY'])){
$ThisTheme 	= $GLOBALS['TEST_THEME_KEY'];
}



$list = array();




if(isset($GLOBALS['card-list-data'])){
	$list = $GLOBALS['card-list-data'];
	if($show == "elementor"){
	
		$newlist = array();
		foreach($list as $k => $v){
			$newlist[$k] = $v['name'];
		}
		return $newlist;
	} 
	
	if($show == "elementor_defaults"){
	 
		$newlist = array();
		$i = 0;
		foreach($list as $k => $v){
			$newlist[$i] = array("field" => $k, "field_name" => $v['name'] );
			$i++;
		}
		
		//die(print_r($newlist));
		
		return $newlist;
	}

}



$list["id"] = array(
"name" 		=> __("Page ID","premiumpress"),
"label" 	=> __("ID","premiumpress"), 
"data" 		=> $post->ID, 
"icon-svg" 	=> "",
"example" 	=> "#102",
"order" 	=> 10,
"tooltip" 	=> __("Reference Number. Use this if you need to contact us or report a problem.","premiumpress"), 
"show" 		=> array(), //"single_short", "single_long", "grid_top", "list_top"
);

if(in_array(THEME_KEY, array('da','cp','es'))){
$list["id"]["show"] = array();
}


$list["category"] = array(
"name" 		=> __("Category","premiumpress"),
"data" 		=> " ".do_shortcode('[CATEGORY limit=1]'), 
"icon-svg" 	=> "",
"example" => "Toy Shop",
"order" 	=> 10,
"show" 		=> array("single_short", "single_long", "grid_top", "list_top"),
); 

$list["views"] = array(
"name" 		=> __("Page Views","premiumpress"), 
"data" 		=>  do_shortcode('[HITS]')." ".__("views","premiumpress"), 
"icon" 		=> "fal fa-users",
"example" 	=> "1282 views",
"order" 	=> 10,
);

$list["views_icon"] = array(
"name" 		=> __("Page Views Icon","premiumpress")."(icon)", 
"tooltip" 	=> __("Views","premiumpress"), 
"data" 		=> do_shortcode('[HITS]'), 
"example" 	=> "118282",
"icon-svg" 	=> "users",
"order" 	=> 10,
"show" 		=> array("single_short", "single_long"),

);	

 	
$list["timesince"] = array(
"name" 		=> __("Time since","premiumpress"), 
"tooltip" 		=> __("Date ad was created.","premiumpress"), 
"data" 		=>  do_shortcode('[TIMESINCE]'), 
"icon-svg" 	=> "clock",
"example" 	=> "5 hrs ago",
"order" 	=> 10,
"show" 		=> array("single_long"),
);


				
switch($ThisTheme){ 

 
	
	case "at": {
	
		$list["id"]["name"] = __("LOT Number","premiumpress");
		$list["id"]["label"] = __("LOT","premiumpress"); 
	  	
		
	 
		$list["date_ends"] = array(
			"name" 		=> __("Auction Ends","premiumpress"),
			"label" 	=> __("Ends","premiumpress"),
			"data" 		=>  hook_date(get_post_meta($post->ID,'listing_expiry_date',true)), 
			"icon" 		=> "fal fa-users",
			"example" => "5ds 4mins 6hrs",
			"order" 	=> 10,
		); 
		
		$list["date_ends_timer"] = array(
			"name" 		=> __("Auction Ends Timer","premiumpress"),
			"data" 		=>  do_shortcode('[TIMELEFT]'),
			"icon-svg" 		=> "clock",
			"show" 		=> array("mobile","list_top"),
			"order" 	=> 10,
		);
	
		 
		$list["bids"] = array(
			"name" 		=> __("bids","premiumpress"),
			"data" 		=> do_shortcode('[BIDS]')." ".__("bids","premiumpress"), 
			"icon-svg" 		=> "hand",
			"order" 	=> 10,
			"show" 		=> array("list_bottom"),
		); 
	 
		
	$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("mobile","list_top"),
			"order" 	=> 1,
		);
 
	$list["bids_icon"] = array(
			"name" 		=> __("Bids","premiumpress")."(icon)", 
			"tooltip" 	=> __("Bids Recieved","premiumpress"), 
			"data" 		=> '<i class="fal fa-hand-paper mr-1"></i> '.do_shortcode('[BIDS]'), 
			"show" 		=> array("grid_bottom"),
			"order" 	=> 10,
		);
		
		 
	} break;
	
	case "ct": {  
	
		//array_push($list["category"]["show"], "mobile");
		
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile","list_top"),
			"order" 	=> 8,
		);
		
		$list["city"] = array(
			"name" 		=> __("City","premiumpress"), 
			"data" 		=>  do_shortcode('[CITY link=1]'), 
			"show" 		=> array("list_top","mobile"),
			"order" 	=> 10,
			
		); 
	
	
	} break;
	
	case "cb": {
	 
		unset($list["category"]["icon-svg"]);
		unset($list["category"]["icon-svg"]);
		
		$list["store"] = array(
			"name" 		=> __("Store Name","premiumpress"),
			"data" 		=> do_shortcode('[STORENAME link=1]'), 
			"show" => array("list_top","grid_bottom"),
			"order" 	=> 10,
		);
	
	} break;

	case "cp": {
	 
		unset($list["category"]["icon-svg"]);
		unset($list["category"]["icon-svg"]);
		
		$list["store"] = array(
			"name" 		=> __("Store Name","premiumpress"),
			"data" 		=> do_shortcode('[STORENAME link=1]'), 
			"show" => array("list_top","grid_bottom"),
			"order" 	=> 10,
		);
	 
		$useddate = get_post_meta($post->ID,'lastused',true); 
		
		if($useddate != "" &&  ( strtotime(date("Y-m-d H:i:s", strtotime($useddate) ))  >  strtotime(date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " -1 day")))  ) ){ 

		$list["lastused"] = array(
			"name" 		=> __("Last Used","premiumpress"),
			"data" 		=>  '<em class="text-danger"><i class="fa fa-fire ml-2 mr-1"></i>'. __("used today","premiumpress")."</em>", 
			"show" => array("grid_top", ),
			"order" 	=> 10,
		);
		
		} 
		
		if(do_shortcode('[USED]') > 0){
		$list["used"] = array(
			"name" 		=> __("Used Count","premiumpress"),
			"data" 		=>  str_replace("%s", do_shortcode('[USED]'), __( 'used %s times', 'premiumpress' )), 
			"show" => array("mobile"),
			"order" 	=> 10,
		); 
		}
	 
		
		$list["comments"] = array(
			"name" 		=> __("Comments","premiumpress"),
			"data" 		=> do_shortcode('[COMMENTS hide_empty=1]'), 
			"show"		=> array("list_top","grid_bottom"),
			"order" 	=> 11,
		);
		
		$list["successrate"] = array(
			"name" 		=> __("Success Rate","premiumpress"),
			"data" 		=> do_shortcode('[SUCCESSRATE text="1"]'), 
			"show"		=> array("list_top"),
			"order" 	=> 11,
			"no-tooltip" => 1
		);
		
		
		if(_ppt(array('cashback', 'enable' )) != '0'){
		$list["cashback"] = array(
			"name" 		=> __("Cashback","premiumpress"),
			"data" 		=> do_shortcode('[CASHBACK text="'.__("Earn %s cashback!","premiumpress").'"]'), 
			"show"		=> array("grid_bottom","list_top"),
			"order" 	=> 12,
			"no-tooltip" => 1
		);
		}
		
		
		$list["timeleft"] = array(
			"name" 		=> __("Timeleft","premiumpress"),
			"data" 		=> do_shortcode('[TIMELEFT textonly=1]'), 
			"show"		=> array(),
			"order" 	=> 11,
		);
		
		
		if(user_can($userdata->ID,'administrator') ){
		$list["edit"] = array(
			"name" 		=> __("Edit Coupon","premiumpress"),
			"data" 		=> '<a href="'.home_url().'/wp-admin/admin.php?page=listings&eid='.$post->ID.'" target="_blank"><span class="fa fa-pencil"><span></a>', 
			"show"		=> array("list_top"),
			"order" 	=> 16,
			"no-tooltip" => 1
		);
		
		}
		
		
		/*
		
   
    <?php  if(get_post_meta($post->ID, "listing_expiry_date", true) != ""){  $vv = $CORE->date_timediff(get_post_meta($post->ID, "listing_expiry_date", true));  
		echo str_replace("%s", $vv['string-small'] ,__("offer ends in %s","premiumpress"));
		} 
		 ?>
   
		*/ 
		
	
	} break;
	
	case "cm": {
	
	 array_push($list["category"]["show"], "mobile"); 
	
	$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile"),
			"order" 	=> 9,
		); 
		
	
	} break;


	case "mj": {
	 
	 	array_push($list["category"]["show"], "mobile");
		 
		$list["waiting"] = array(
			"name" 		=> __("Waiting","premiumpress"),
			"label" 	=> __("Waiting","premiumpress"),  
			"tooltip" 	=> __("Orders in Queue","premiumpress"), 
			"data" 		=> do_shortcode('[WAITING]'), 
			"icon" 		=> "fal fa-sync",
			"order" 	=> 10,
			 
		);
		
		$list["sold"] = array(
			"name" 		=> __("Jobs Sold","premiumpress"), 
			"label" 	=> __("Jobs Sold","premiumpress"), 
			"data" 		=> do_shortcode('[SALES]')." ".__("Sold","premiumpress"), 
			"icon" 		=> "fal fa-box",
			"order" 	=> 10,
			"show" 		=> array("list_top"),
		);
		
		
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("list_top", "grid_bottom","mobile"),
			"order" 	=> 8,
		);
		
		
	 
		
		$list["waiting_icon"] = array(
			"name" 		=> __("Orders in Queue","premiumpress")."(icon)", 
			"tooltip" 	=> __("Orders in Queue","premiumpress"), 
			"data" 		=> '<i class="fal fa-sync mr-1"></i> '.do_shortcode('[SALES]'), 
			"show" 		=> array("grid_bottom"),
			"order" 	=> 10,
		);
		 
 
	} break;
	

	
	case "dl": {
	
		
		$list["year"] = array(
			"name" 		=> __("Year","premiumpress"), 
			"data" 		=>  do_shortcode('[YEAR]'), 
			"icon" 		=> "fal fa-calendar",
			"show" 		=> array("grid_top"),
			"order" 	=> 10,
		);
	
		$list["make"] = array(
			"name" 		=> __("Make","premiumpress"), 
			"data" 		=>  do_shortcode('[MAKE link=1]'), 
			"icon" 		=> "fal fa-car",
			"show" 		=> array("grid_top","mobile"),
			"order" 	=> 9,
		);
	
		$list["modal"] = array(
			"name" 		=> __("Modal","premiumpress"), 
			"data" 		=>  do_shortcode('[MODEL]'), 
			"icon" 		=> "fal fa-car-side",
			"show" 		=> array("grid_top","mobile"),
			"order" 	=> 10,
		); 
		
	 
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile"),
			"order" 	=> 7,
		);
		
 
 
	
	} break; 
	
	
	case "jb": {
	 
		 //array_push($list["category"]["show"], "mobile");
		 
		$list["type"] = array(
			"name" 		=> __("Job Type","premiumpress"),
			"data" 		=> do_shortcode('[JOBTYPE]'), 
			"icon" 		=> "fal fa-briefcase",
			"show" 		=> array("mobile","list_top"),
			"order" 	=> 10,
		);  
		
		
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile","list_top"),
			"order" 	=> 7,
		);
		

		$list["salary"] = array(
			"name" 		=> __("Salary","premiumpress"), 
			"data" 		=>  do_shortcode('[SALARYTYPE]'), 
			"icon" 		=> "fal fa-users",
			"example"	=> "full time",
			"show" 		=> array("grid_bottom"),
			"order" 	=> 10,
		);
		 
		
		$list["country"] = array(
			"name" 		=> __("Country","premiumpress"), 
			"data" 		=>  do_shortcode('[COUNTRY link=1]'), 
			"order" 	=> 10,
			//"show" 		=> array("list_top"),
			
		);
		
		$list["city"] = array(
			"name" 		=> __("City","premiumpress"), 
			"data" 		=>  do_shortcode('[CITY link=1]'), 
			"order" 	=> 10,
			"show" 		=> array("list_top"),
		);
		 
 
	
	} break;
	
	case "sp": {
	
	
		array_push($list["category"]["show"], "mobile");
	
	 if(in_array(_ppt(array('design','display_comments')), array("","1"))  ){
	 	
		$tt = "";
		if($post->comment_count == 1){  $tt = __("review","premiumpress"); }else{ $tt = __("reviews","premiumpress"); } 
		
		$list["reviews"] = array(
			"name" 		=> __("Reviews","premiumpress"),
			"data" 		=> $post->comment_count." ".$tt, 
			"icon" 		=> "fal fa-comments",
			"order" 	=> 10,
			
		);
	} 
	
		// GET QUTY
		$qty = get_post_meta($post->ID, "qty", true );   if($qty == ""){ $qty = 10; }
	 	
		$list["qty"] = array(
			"name" 		=> __("QTY","premiumpress"),
			"data" 		=> __("In Stock","premiumpress"), 
			"icon" 		=> "fal fa-box",
			"order" 	=> 10,
			
		);
		
		if(get_post_meta($post->ID, "sku", true) != ""){
		
			$list["sku"] = array(
				"name" 		=> __("SKU","premiumpress"),
				"data" 		=> get_post_meta($post->ID, "sku", true), 
				"icon" 		=> "fa fa-barcode-scan",
				"order" 	=> 10,
			);		
		}		
		 
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile"),
			"order" 	=> 10,
		);
		
		
		$oldprice = get_post_meta($post->ID,'old_price', true);
		if(is_admin() || strlen($oldprice) > 0){
		$list["oldprice"] = array(
			"name" 		=> __("Old Price","premiumpress"),
			"data" 		=> $oldprice, 
			"example"	=> 299,
			"type"		=> "price",
			"css"		=> "strike",
			"show" 		=> array("grid_bottom","mobile"),
			"order" 	=> 10,
		);
		}
		 
		
		$list["score"] = array(
			"name" 		=> __("Score","premiumpress"),
			"data" 		=> do_shortcode('[RATING css="d-flex" size="xs" results=0 type="stars" bg=""]'), 
	 		"order" 	=> 10,
			"show" => array("grid_bottom"),
		);

		 
		
	
	} break;
	
	
	case "ll": {
	
	 if(in_array(_ppt(array('design','display_comments')), array("","1"))  ){
	 	
		$tt = "";
		if($post->comment_count == 1){  $tt = __("review","premiumpress"); }else{ $tt = __("reviews","premiumpress"); } 
		
		$list["reviews"] = array(
			"name" 		=> __("Reviews","premiumpress"),
			"data" 		=> $post->comment_count." ".$tt, 
			"icon" 		=> "fal fa-comments",
			"order" 	=> 10,
			
		);
	} 
		 
	
		$list["level"] = array(
			"name" 		=> __("Level","premiumpress"),
			"data" 		=> do_shortcode('[LEVEL]'), 
			"icon" 		=> "fal fa-user",
			"show" => array("grid_top",),
			"order" 	=> 10,
		);
		
		$list["language"] = array(
			"name" 		=> __("Language","premiumpress"),			
			"data" 		=> do_shortcode('[LANGUAGE]'), 
			"icon" 		=> "fal fa-language",
			"order" 	=> 10,
		);
		$list["score"] = array(
			"name" 		=> __("Score","premiumpress"),
			"data" 		=> do_shortcode('[RATING css="d-flex" size="xs" results=0 type="stars"]'), 
	 		"order" 	=> 10,
			"show" => array("grid_bottom"),
		);
	
	} break;
	
	
	case "vt": {
	  
	 	array_push($list["category"]["show"], "mobile");
		
		$list["score"] = array(
			"name" 		=> __("Score","premiumpress"),
			"data" 		=> do_shortcode('[RATING css="d-flex" size="xs" results=0 type="stars"]'), 
	 		"order" 	=> 10,
			"show" => array("grid_bottom"),
		);
		
		 
		if(in_array(_ppt(array('user', 'likes')), array("", "1")) ){ 
			$list["likes_icon"] = array(
				"name" 		=> __("Likes Icon","premiumpress")."(icon)", 
				"tooltip" 	=> __("Likes","premiumpress"), 
				"data" 		=> '<i class="fal fa-heart mr-1"></i> '.do_shortcode('[LIKES]'),  
				"show" => array("grid_bottom"),
				"order" 	=> 10,
			);
		}
		 
		
		$list["level"] = array(
			"name" 		=> __("Level","premiumpress"),
			"data" 		=> do_shortcode('[LEVEL]'), 
			"icon" 		=> "fal fa-user-graduate",
			"order" 	=> 10,
			
		);
		
 
	} break;
	 
	
 
	case "da": { 
	
	
	//unset($list["views_icon"]['show'][2]);
	//unset($list["category"]['show'][0]);
	unset($list["id"]['show'][0]);
	unset($list["id"]['show'][1]);
	
	$list["category"]['icon-svg'] = "star";
  
	
	$list["gender"] = array(
			"name" 		=> __("Gender","premiumpress"), 
			"data" 		=>  do_shortcode('[GENDER]'), 
			"show" 		=> array("grid_bottom"), 
			"order" 	=> 6,
			"show" => array("grid_bottom"),
	);
 	$list["age"] = array(
			"name" 		=> __("Age","premiumpress"), 
			"data" 		=>  do_shortcode('[AGE]'),
			"order" 	=> 7,
			"show" => array("grid_bottom"),
	);	 
	$list["country"] = array(
			"name" 		=> __("Country","premiumpress"), 
			"data" 		=>  do_shortcode('[COUNTRY link=1]'), 
			"show" 		=> array(),
			"order" 	=> 10, 
			"show" => array("list_top"),
	);
	$list["city"] = array(
			"name" 		=> __("City","premiumpress"), 
			"data" 		=>  do_shortcode('[CITY link=1]'), 
			"show" 		=> array(),
			"order" 	=> 8,
			"show" => array("grid_bottom","mobile","list_top"),
	); 
		
		$ll = "";
		if(strlen(do_shortcode('[COUNTRY]')) > 1){
		$ll .= "".do_shortcode('[COUNTRY]');
		}
		if(strlen(do_shortcode('[CITY]')) > 1){
		$ll .= ", ".do_shortcode('[CITY]');
		}
		
		$list["location"] = array(
			"name" 		=> __("Country + City","premiumpress"), 
			"data" 		=>  $ll, 
			"order" 	=> 10,
		); 
	
		$list["agegender"] = array(
			"name" 		=> __("Gender + Age ","premiumpress"), 
			"data" 		=>  do_shortcode('[GENDER]').", ".do_shortcode('[AGE]'),
			"order" 	=> 7,
			"show" => array("list_top","mobile"),
		);
		 
		

	} break; 
	
	
	case "es": {
	 
		unset($list["category"]['icon-svg']);
		
		$list["age"] = array(
			"name" 		=> __("Age","premiumpress"), 
			"data" 		=>  do_shortcode('[AGE]'), 
			"show" 		=> array(), 
			"order" 	=> 10,
		);
		
		$list["agegender"] = array(
			"name" 		=> __("Gender + Age ","premiumpress"), 
			"data" 		=>  do_shortcode('[GENDER]').", ".do_shortcode('[AGE]'),
			"show" 		=> array("grid_top","mobile", "single_short"), 
			"order" 	=> 8,
		);
		
		$list["gender"] = array(
			"name" 		=> __("Gender","premiumpress"), 
			"data" 		=>  do_shortcode('[GENDER]'), 
			"show" 		=> array(), 
			"order" 	=> 10,
		 
		);
		
		$list["country"] = array(
			"name" 		=> __("Country","premiumpress"), 
			"data" 		=>  do_shortcode('[COUNTRY]'), 
			"order" 	=> 10,
		);
		
		
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom"),
			"order" 	=> 10,
		);
				
		$list["city"] = array(
			"name" 		=> __("City","premiumpress"), 
			"data" 		=>  do_shortcode('[CITY]'), 
			"show" 		=> array("mobile","single_long"), 
			"order" 	=> 10,
		);   
	 

	} break;
	
	
	case "rt": {
	 
		
		$list["type"] = array(
			"name" 		=> __("Type","premiumpress"),
			"data" 		=> do_shortcode('[HOUSETYPE]'), 
			"example"	=> "House",
			"show" 		=> array("grid_top"),
			"order" 	=> 10,
		);


		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("list_top","mobile"),
			"order" 	=> 7,
		);
		
				
		$list["beds"] = array(
			"name" 		=> __("Beds","premiumpress"), 			 
			"data" 		=>  '<i class="fa fa-bed mr-2"></i> '.do_shortcode('[BEDS numonly=1]'), 
			"show" => array("grid_bottom","mobile", "list_top"),
			"order" 	=> 8,
			
		);
		
		$list["baths"] = array(
			"name" 		=> __("Baths","premiumpress"), 		 
			"data" 		=>  '<i class="fa fa-bath mr-2"></i> '.do_shortcode('[BATHS numonly=1]'), 		  
			"show" => array("grid_bottom","mobile","list_top"),
			"order" 	=> 9,
		);
		 
		
		$list["city"] = array(
			"name" 		=> __("City","premiumpress"),
			"data" 		=> do_shortcode('[CITY link=1]'), 
			"example"	=> "New York",
			"show" 		=> array("list_top"),
			"order" 	=> 10,
		);
		

	} break;
	
	
	
	case "dt": {
 
	 
		//unset($list["id"]["label"]['show']['3']); // remove id from list top 
		$list["category"]['show'] = array("single_short", "single_long", "grid_top", "list_top","mobile");
		
		$list["score"] = array(
			"name" 		=> __("Score","premiumpress"),
			"data" 		=> do_shortcode('[RATING css="d-flex" size="xs" results=0 type="stars"]'), 
	 		"order" 	=> 10,
			"show" => array("list_bottom"),
		);
		
		$list["country"] = array(
			"name" 		=> __("Country","premiumpress"), 
			"data" 		=>  do_shortcode('[COUNTRY link=1]'), 
			"order" 	=> 8,
			"icon-svg" 	=> "flag",
			"show" => array("single_long"),
		);
		
		$list["city"] = array(
			"name" 		=> __("City","premiumpress"), 
			"data" 		=>  do_shortcode('[CITY link=1]'), 
			"order" 	=> 9,
			"icon-svg" 	=> "map-marker",
			"show" => array("list_top","single_long","mobile"),
		);
	 
		
		if(in_array(_ppt(array('design', "display_openinghours")), array("","1")) ){
		
		$list["open"] = array(
			"name" 		=> __("Opening Hours","premiumpress"), 
	 
			"data" 		=>  do_shortcode('[OPEN]'), 
			"icon" 		=> "fal fa-clock",
			"order" 	=> 10,
		);	
		
		}
		
		if( in_array(_ppt(array('design','display_claim')), array("","1")) && user_can( $post->post_author, 'edit_posts' )  ){
		
			if(user_can( $post->post_author, 'delete_posts' ) && get_post_meta($post->ID,"claimed", true) == "" ){
			
			/*
			  
      <span class="p-1 px-2 rounded text-500 small badge-warning hide-mobile mt-n2"><a href="javascript:void(0)" <?php if(!$userdata->ID){ ?>onclick="processLogin();" <?php }else{ ?>onclick="processClaimPop();"<?php } ?>><?php echo __("Unclaimed","premiumpress") ?> </a>
      </span>
			*/
			
			}else{
			
			/*
			
      <span class="p-1 px-2 rounded text-500 small badge-success hide-mobile mt-n2"><i class="fa fa-check-circle"></i><?php echo __("Claimed","premiumpress") ?> </span>
   
			*/
			
			}
			
		$list["claimed"] = array(
			"name" 		=> __("claimed","premiumpress"), 
	 		"order" 	=> 10,
			"data" 		=>  "", 
			"icon" 		=> ""
		);	
		
		
		}
 

	} break; 

	
	case "pj": { 
	   
		$list["bids"] = array(
			"name" 		=> __("Offers","premiumpress"),
			"data" 		=> do_shortcode('[PROPOSALS]')." ".__("Offers","premiumpress"), 
			"icon" 		=> "fal fa-users",
			"order" 	=> 10,
		);
		
		$list["price"] = array(
			"name" 		=> __("Price","premiumpress"),
			"data" 		=> do_shortcode('[PRICE]'), 
			"example"	=> 100,
			"type"		=> "price",
			"show" 		=> array("grid_bottom","mobile"),
			"order" 	=> 8,
		);
		
		$list["bids_icon"] = array(
			"name" 		=> __("Offers","premiumpress")."(icon)", 
			"tooltip" 	=> __("Offers Recieved","premiumpress"), 
			"data" 		=> '<i class="fal fa-hand-paper mr-1"></i> '.do_shortcode('[PROPOSALS]'), 
			"show" 		=> array("grid_bottom"),
			"order" 	=> 10,
		);
	 
		
		$list["date_ends"] = array(
			"name" 		=> __("Auction Ends","premiumpress"),
			"label" 	=> __("Ends","premiumpress"),
			"data" 		=>  hook_date(get_post_meta($post->ID,'listing_expiry_date',true)), 
			"icon" 		=> "fal fa-users",
			"order" 	=> 10,
			
		);
		
		$list["date_ends_timer"] = array(
			"name" 		=> __("Auction Ends Timer","premiumpress"),
			"data" 		=>  do_shortcode('[TIMELEFT]'),
			"icon-svg" 		=> "clock",
			"show" 		=> array("mobile"),
			"order" 	=> 10,
		);
	

	} break;
	
	
	
	case "so": {
	 
		
		$list["score"] = array(
			"name" 		=> __("Score","premiumpress"),
			"data" 		=> do_shortcode('[RATING css="d-flex" size="xs" results=0 type="stars"]'), 
	 		"order" 	=> 10,
			"show" => array("grid_bottom"),
		);
		 
	 
		
		$list["downloads_icon"] = array(
			"name" 		=> __("Downloads","premiumpress"),
			"data" 		=> '<i class="fal fa-download mr-1"></i> '.get_post_meta($post->ID,"download_count",true), 
			"tooltip" 	=> __("Downloads","premiumpress"), 
			"show" => array("grid_bottom"), 
			
		);
		
		$list["downloads"] = array(
			"name" 		=> __("Downloads","premiumpress"),
			"data" 		=> get_post_meta($post->ID,"download_count",true)." ".__("Downloads","premiumpress"), 
			"icon" 		=> "fal fa-download",
			"order" 	=> 10,
		 
		);
		
		
		

	} break;
	
	
	case "ph": {
	
		 
		
		$list["downloads"] = array(
			"name" 		=> __("Downloads","premiumpress"),
			"data" 		=> do_shortcode('[DOWNLOADS]')." ".__("Downloads","premiumpress"), 
			"icon" 		=> "fal fa-download",
			"order" 	=> 10,
		);
	 
	} break;
	
	

	case "cp": {
	
	/*
	
	$storename = do_shortcode('[STORENAME link=0]');
	
	?> 
    
    
	<?php $useddate = get_post_meta($post->ID,'lastused',true); if($useddate != "" &&  ( strtotime(date("Y-m-d H:i:s", strtotime($useddate) ))  >  strtotime(date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " -1 day")))  )
			 
			
			){ $da = $CORE->date_timediff($useddate,''); ?>
       <span class="hide-mobile"><i class="fa fa-fire"></i> <?php echo __( 'Last Used', 'premiumpress' ); ?> <?php echo str_replace("%s",  $da['string-small'], __("%s ago","premiumpress")); ?></span>
      <?php } ?>
    
    <?php if(strlen($storename) > 1){ ?>  
    <span><i class="fal fa-home"></i><a href="<?php echo do_shortcode('[AFFLINK store=1]'); ?>" class="mt-2"><?php echo $storename; ?></a></span>
    <?php } ?>
    
    <span><i class="fal fa-users"></i><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?></span> 
  
    <span><i class="fal fa-shopping-cart"></i><?php echo do_shortcode('[USED]'); ?> <?php echo __( 'Used', 'premiumpress' ); ?></span> 
    
     <?php if(do_shortcode('[VERIFIED]')){ ?>
      <span class="text-success ml-3"><i class="fa fa-check"></i><?php echo __( 'Verified', 'premiumpress' ); ?> </span>
      <?php } ?>
    
    <?php
	
	*/
	} break;
  
	

} 
 

$GLOBALS['card-list-data'] = $list;

if(isset($GLOBALS['TEST_THEME_KEY'])){ unset($GLOBALS['card-list-data']); }

if($show == "elementor"){

	$newlist = array();
	foreach($list as $k => $v){
		$newlist[$k] = $v['name'];
	}
	return $newlist;
} 

if($show == "elementor_defaults"){
 
	$newlist = array();
	$i = 0;
	foreach($list as $k => $v){
		$newlist[$i] = array("field" => $k, "field_name" => $v['name'] );
		$i++;
	}
	
	//die(print_r($newlist));
	
	return $newlist;
}

 
 
return $list;

}
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 
function ppt_theme_badwordlist($text, $filter){

$badwords = array("@$$","13?","2 girls 1 cup","2g1c","3p","4r5e","5h1t","5hit","a_s_s","a55","aardappels afgieteng","aborto","achter het raam zitten","acrotomophilia","afberen","aflebberen","afrossen","afrukken","aftrekken","afwerkplaats","afzeiken","afzuigen","ahole","allumé","allumée","allupato","amador","amcik","ammucchiata","anal","anale","analritter","anderhalve man en een paardekop","andskota","anilingus","anita","anus","ânus","ar5e","aranha","ariano","arrapato","arrse","arrusa","arruso","arsch","arschficker","arschlecker","arschloch","arse","arsehole","asbak","Asesinato","ash0le","ash0les","asholes","asno","aso","ass","Ass Monkey","assatanato","asses","Assface","assfucker","ass-fucker","assfukka","assh0le","assh0lez","asshole","assholes","assholz","assmunch","assrammer","asswhole","asswipe","auto erotic","autoerotic","ayir","azzhole","b!+ch","b!tch","b00b","b00bs","b17ch","b1tch","babeland","baby batter","bagascia","bagger schijten","bagnarsi","baiser","balalao","baldracca","balen","ball gag","ball gravy","ball kicking","ball licking","ball sack","ball sucking","ballbag","balle","balls","ballsack","bander","bangbros","bareback","barely legal","barenaked","bassterds","bastard","bastardo","bastards","bastardz","basterds","basterdz","bastinado","battere","battona","bbw","bdsm","beastial","beastiality","beaver cleaver","beaver lips","bedonderen","befborstelg","beffen","bekken","belazeren","belino","bellend","besodemieterd zijn","besodemieteren","bestial","bestiality","beurt","bi curious","bi+ch","bi7ch","Biatch","bicha","big black","big breasts","big knockers","big tits","biga","bigornette","bimbos","birdlock","biscate","bissexual","bitch","bitcher","bitchers","bitches","bitchin","bitching","bite","bitte","black cock","bloblos","blonde action","blonde on blonde action","bloody","blow j","Blow Job","blow your l","blowjob","blowjobs","blue waffle","blumpkin","bocchinara","bocchino","boceta","boemelen","boerelul","boerenpummelg","boffing","bofilo","boiata","boiolas","bokkelul","Bollera","bollock","bollocks","bollok","bondage","boner","boob","boobs","booobs","boooobs","booooobs","booooooobs","booty call","bordel","bordello","bosser","bosta","botergeil","bourré","bourrée","branlage","branler","branlette","branleur","branleuse","bratze","braulio de borracha","breasts","brinca","broekhoesten","brouter le cresson","brown showers","brugpieperg","brunette action","bucaiolo","buceta","budiùlo","buffelen","bugger","buiten de pot piesen","bukkake","bulldyke","bullet vibe","bum","bumbum","bumsen","bung hole","bunghole","bunny fucker","buona donna","burro","busone","busty","butt","buttcheeks","butthole","buttmuch","butt-pirate","buttplug","buttwipe","bychara","byk","c0ck","c0cks","c0cksucker","c0k","cabrao","cabron","Cabrón","Caca","cacca","caccati in mano e prenditi a schiaffi","cacete","caciocappella","cadavere","cagar","cagare","cagata","cagna","cailler","camel toe","camgirl","camisinha","cammello","camslut","camwhore","cappella","caralho","carciofo","carità","carpet muncher","carpetmuncher","casci","cawk","cawks","cazzata","cazzimma","cazzo","cerveja","chatte","checca","chernozhopyi","chiappa","chiasse","chiavare","chiavata","chier","chink","chiottes","chochota","chocolate rosebuds","chraa","chuj","Chupada","Chupapollas","chupar","Chupetón","ciospo","cipa","circlejerk","cirer","ciucciami il cazzo","cl1t","cleveland steamer","clit","clito","clitoris","clits","clover clamps","clusterfuck","cnts","cntz","cnut","cocaína","cock","cockface","cockhead","cock-head","cockmunch","cockmuncher","cocks","cocksuck ","cocksucked ","CockSucker","cock-sucker","cocksucking","cocksucks ","cocksuka","cocksukka","coglione","coglioni","cok","cokmuncher","coksucka","colhoes","comer","con","cona","concha","Concha de tu madre","connard","connasse","conne","Coño","consolo","coon","Coprofagía","coprolagnia","coprophilia","cornhole","corno","cornuto","couilles","cox","cozza","cramouille","crap","cu","cul","culattina","culattone","Culo","cum","cummer","cumming","cums","cumshot","cunilingus","cunillingus","cunnilingus","cunt","cuntlick ","cuntlicker ","cuntlicking ","cunts","cuntz","cyalis","cyberfuc","cyberfuck ","cyberfucked ","cyberfucker","cyberfuckers","cyberfucking ","d1ck","d4mn","damn","dar o rabo","darkie","da's kloten van de bok","date rape","daterape","daygo","de ballen","de hoer spelen","de hond uitlaten","de koffer induiken","de pijp aan maarten geven","de pijp uitgaan","déconne","déconner","deep throat","deepthroat","dego","delg","di merda","dick","dickhead","dike","dild0","dild0s","dildo","dildos","dilld0","dilld0s","dink","dinks","dirsa","dirty pillows","dirty sanchez","ditalino","dlck","dödel","dog style","dog-fucker","doggie style","doggiestyle","doggin","dogging","doggy style","doggystyle","dolboy'eb","dolcett","dombo","domination","dominatricks","dominatrics","dominatrix","dommes","donkey punch","donkeyribber","doosh","double dong","double penetration","doudounes","dp action","draaikontg","drague","driehoog achter wonen","Drogas","drolg","drooggeiler","droogkloot","duche","dum raio","dupa","duro","dyke","dziwka","eat my ass","ebalnik","ebalo","ebalom sch'elkat","ecchi","een beurt geven","een nummertje maken","een wip maken","eikel","ejackulate","ejaculate","ejaculated","ejaculates ","ejaculating ","ejaculatings","ejaculation","ejakulate","Ekrem","Ekto","emmerdant","emmerder","emmerdeur","emmerdeuse","enculé","enculée","enculer","enema","enfoiré","enfoirée","engerd","erotic","erotism","Esperma","esporra","ethical slut","étron","eunuch","f u c k","f u c k e r","f_u_c_k","f4nny","faen","fag","fag1t","faget","fagg1t","fagging","faggit","faggitt","faggot","faggs","fagit","fagot","fagots","fags","fagz","faig","faigs","fanculo","fanny","fannyflaps","fannyfucker","fanyy","fare unaŠ","fart","fatass","fava","fcuk","fcuker","fcuking","fecal","feces","feck","fecker","feg","felch","Felcher","felching","fellate","fellatio","feltch","female squirting","femdom","femminuccia","fica","fick","ficken","Fiesta de salchichas","figa","figging","figlio di buona donna","figlio di puttana","figone","filho da puta","fille de pute","fils de pute","fingerfuck ","fingerfucked ","fingerfucker ","fingerfuckers","fingerfucking ","fingerfucks ","fingering","finocchio","fistfuck","fistfucked ","fistfucker ","fistfuckers ","fistfucking ","fistfuckings ","fistfucks ","fisting","fitt","flamoes","flange","flic","flikken","Flikker","flipping the bird","flittchen","foda","foda-se","foder","Follador","Follar","folle","fook","fooker","foot fetish","footjob","foreskin","fottere","fottersi","Fotze","foutre","fracicone","frango assado","fratze","fregna","frocio","froscio","frotting","Fu(","fuck","fuck buttons","fucka","fucked","fucker","fuckers","fuckhead","fuckheads","fuckin","fucking","fuckings","fuckingshitmotherfucker","fuckme ","fucks","fuckwhit","fuckwit","fudge packer","fudgepacker","fuk","Fukah","Fuken","fuker","Fukin","Fukk","Fukkah","Fukken","Fukker","Fukkin","fuks","fukwhit","fukwit","fuori come un balcone","futanari","futkretzn","fux","fux0r","g ????","g00k","gadverdamme","galbak","gang bang","gangbang","gangbanged ","gangbangs ","gat","gay","gay sex","gayboy","gaygirl","gaylord","gays","gaysex","gayz","gedoogzone","geil","geilneef","genitals","gerber","gesodemieter","giant cock","Gilipichis","Gilipollas","girl on","girl on top","girls gone wild","goatcx","goatse","God","god-dam","goddamn","goddamned","God-damned","godverdomme","gokkun","gol","golden shower","goldone","goo girl","goodpoop","gook","goregasm","gouine","gozar","graftak","grande folle","gras maaien","gratenkutg","grelho","greppeldel","griet","grilletto","grogniasse","grope","group sex","g-spot","guanto","guardone","gueule","guiena","guro","h00r","h0ar","h0r","h0re","h4x0r","Hacer una paja","Haciendo el amor","hackfresse","hand job","handjob","hard core","hardcore","hardcoresex ","hell ","hells","helvete","hentai","Heroína","heshe","heterosexual","Hija de puta","Hijaputa","Hijo de puta","Hijoputa","hoar","hoare","hoempert","hoer","hoerenbuurt","hoerenloper","hoerig","hol","homem gay","homo","homoerotic","homoerótico","homosexual","honkey","hooker","hoor","hoore","hore","horniest","horny","hot chick","hotsex","how to kill","how to murder","Huevon","hufter","huge fat","hui","huisdealer","humping","hupen","hure","hurensohn","Idiota","Imbécil","incazzarsi","incest","incoglionirsi","inferno","infierno","ingoio","injun","intercourse","ische","jack off","jackoff","jack-off ","jail bait","jailbait","jap","japs","jerk off","jerk-off","jerk-off ","jigaboo","jiggaboo","jiggerboo","Jilipollas","jisim","jism","jiss","jiz ","jizm","jizm ","jizz","johny","jouir","juggs","kackbratze","kacke","kacken","kampflesbe","kanen","kanker","Kapullo","kawk","kettingzeugg","kike","kimme","kinbaku","kinkster","kinky","klaarkomen","klerebeer","klojo","klooien","klootjesvolk","klootoog","klootzak","kloten","knackwurst","knob","knobbing","knobead","knobed","knobend","knobhead","knobjocky","knobjokey","knobs","knobz","knor","knulle","kock","kondum","kondums","kontg","kontneuken","kraut","krentekakker","kuk","kuksuger","kum","kummer","kumming","kums","kunilingus","kunt","kunts","kuntz","Kurac","kurwa","kusi","kut","kuttelikkertje","kwakkieg","kyrpa","l3i+ch","l3itch","la putain de ta mère","labia","Lameculos","l'arte bolognese","latte","leather restraint","leather straight jacket","leccaculo","lecchino","lemon party","Lesbian","lésbica","lesbo","Lezzian","liefdesgrot","Lipshits","Lipshitz","lmfao","lofare","loffa","loffare","lolita","lovemaking","lul","lul-de-behanger","lulhannes","lumaca","lummel","lümmel","lust","lusting","m0f0","m0fo","m45terbate","ma5terb8","ma5terbate","Maciza","Macizorra","mafketel","make me come","maldito","male squirting","MALPT","mama","Mamada","mamhoon","manico","mannaggia","maquereau","Marica","Maricón","Mariconazo","martillo","masochist","masokist","massterbait","masstrbait","masstrbate","masterb8","masterbaiter","masterbat","masterbat3","masterbate","master-bate","masterbates","masterbation","masterbations","masturbat","masturbate","matennaaierg","matje","melon","menage a trois","ménage a trois","merd","merda","merdata","merde","merdeuse","merdeux","merdoso","merlan","meuf","mibun","Mierda","mignotta","milchtüten","milf","minchia","minchione","missionary position","mof","mof0","mofo","mo-fo","mona","monkleigh","monta","montare","möpse","morgenlatte","morue","möse","Motha Fucker","Motha Fuker","Motha Fukkah","Motha Fukker","mothafuck","mothafucka","mothafuckas","mothafuckaz","mothafucked ","mothafucker","mothafuckers","mothafuckin","mothafucking ","mothafuckings","mothafucks","Mother Fucker","Mother Fukah","Mother Fuker","Mother Fukkah","Mother Fukker","motherfuck","motherfucked","motherfucker","mother-fucker","motherfuckers","motherfuckin","motherfucking","motherfuckings","motherfuckka","motherfucks","moule","mouliewop","mound of venus","mr hands","mucke","mudack","muff","muff diver","muffdiving","mufti","muie","mulkku","muschi","mussa","mutha","Mutha Fucker","Mutha Fukah","Mutha Fuker","Mutha Fukkah","Mutha Fukker","muthafecker","muthafuckker","muther","mutherfucker","mutsg","n1gga","n1gger","n1gr","naaien","naakt","nackt","nambla","nastt","nave scuola","nawashi","nazi","nazis","nègre","negro","neonazi","nepesaurio","nerchia","neuken","neukstier","nicht","nig nog","nigg3r","nigg4h","nigga","niggah","niggas","niggaz","nigger","nigger;","niggers ","nigur;","niiger;","niigr;","nimphomania","nippel","nipple","nipples","nique ta mère","nob","nob jokey","nobhead","nobjocky","nobjokey","noune","nsfw images","nude","nudity","nudo","numbnuts","nutsack","nympho","nymphomania","octopussy","oetlul","omorashi","onanieren","one cup two girls","one guy one jar","op z'n hondjes","op z'n sodemieter geven","opgeilen","opizdenet","opkankeren","oprotten","opsodemieteren","opzouten","orafis","orgasim ","orgasim;","orgasims ","orgasm","orgasms ","orgasum","orgy","oriface","orifice","orifiss","Orina","orospu","osto'eblo","ostokhuitel'no","ot'ebis","otmudohat","otpizdit","otsosi","ouwe rukker","ouwehoer","ouwehoeren","p0rn","paal","paardelul","packi","packie","packy","padlo","padulo","paedophile","paki","pakie","paky","palen","palle","palloso","palucher","paneleiro","panties","panty","paska","passar um cheque","patacca","patonza","pau","pawn","pecker","pecorina","pédale","pédé","pedik","Pedo","pedobear","pedophile","peeenus","peeenusss","peenus","pegging","peidar","peinus","pen1s","penas","penis","pênis","penis-breath","penisfucker","penozeg","penus","penuus","perdet","perse","Pervertido","pesce","péter","petuh","Pezón","phone sex","phonesex","Phuc","Phuck","Phuk","phuked","Phuker","phuking","phukked","Phukker","phukking","phuks","phuq","picheln","picio","picka","pidar gnoinyj","piece of shit","pierdol","piesen","pigfucker","pijpbekkieg","pijpen","pik","pillu","pimmel","pimpern","pimpis","pincare","Pinche","pinkeln","pinto","pipa","pipe","pipi","pipì","pippone","pirla","Pis","pisciare","piscio","pisello","piss","piss pig","pissed","pissen","pisser","pissers","pisses ","pissflaps","pissin ","pissing","pissoff ","pisspig","pistola","pistolotto","piz`dyulina","pizda","pizdato","pizdatyi","piz'det","pizdetc","pizdoi nakryt'sja","pizd'uk","playboy","pleasure chest","pleurislaaier","po khuy","podi ku'evo","poeben","poep","poepen","poilu","po'imat' na konchik","po'iti posrat","polac","polack","polak","pole smoker","poluchit pizdy","pomiciare","pompa","pompino","ponyplay","poof","Poonani","poontsee","poop","poop chute","poopchute","poot","popel","poppen","porca","porca madonna","porca miseria","porca puttana","porco due","porco zio","porn","porno","pornography","pornos","porra","portiekslet","pososi moyu konfetku","pot","potta","potverdorie","pouffiasse","pousse-crotte","pr0n","pr1c","pr1ck","pr1k","preteen","prick","pricks ","prince albert piercing","prissat","proebat","promudobl'adsksya pizdopro'ebina","pron","propezdoloch","prosrat","Prostituta","pthc","pube","pubes","publiciteitsgeil","pula","pule","pusse","pussee","pussi","pussies","pussy","pussys ","puta","puta que pariu","puta que te pariu","putain","pute","puto","puttana","puuke","puuker","qahbeh","quaglia","queaf","queca","queef","queer","queers","queerz","queue","qweers","qweerz","qweir","raaskallen","Racista","raghead","raging boner","Ramera","ramoner","rape","raping","rapist","raspeezdeyi","raspizdatyi","rautenberg","raz'yebuy","raz'yoba","recchione","recktum","rectum","reet","reet trappen"," voor zijn","reetridder","regina","remsporeng","retard","reudig","reutelen","reverse cowgirl","rimjaw","rimjob","rimming","rincoglionire","rizzarsi","rompiballe","rosette","rosy palm","rosy palm and her 5 sisters","rothoer","rotzak","ruffiano","rukhond","rukken","rusty trombone","s & m","s hit","s&m","s.o.b.","s_h_i_t","sacanagem","saco","Sádico","sadism","sadist","salaud","salope","sbattere","sbattersi","sborra","sborrata","sborrone","sbrodolata","scank","scat","schabracke","schaffer","schatje","scheiss","scheiße","schijt","schijten","schlampe","schlong","schmuck","schnackeln","schoft","schuinsmarcheerder","scissoring","scopare","scopata","scorreggiare","screw","screwing","scroat","scrote","scrotum","s'ebat'sya","sega","semen","serin","service trois pièces","sex","sexo","Sexo oral","sexy","sh!+","Sh!t","sh1t","sh1ter","sh1ts","sh1tter","sh1tz","shag","shagger","shaggin","shagging","shalava","sharmuta","sharmute","shaved beaver","shaved pussy","shemale","shi+","shibari","shipal","shit","shitdick","shite","shited","shitey","shitfuck","shitfull","shithead","shiting","shitings","shits","shitted","shitter","shitters ","shitting","shittings","Shitty","shitty ","Shity","shitz","shiz","shota","shrimping","Shyt","Shyte","Shytty","Shyty","skanck","skank","skankee","skankey","skanks","Skanky","skribz","skurwysyn","slanteye","slempen","sletg","sletterig","slik mijn zaad","slinguare","slinguata","slut","sluts","Slutty","slutz","sm","sm??","smandrappata","smegma","smut","snatch","snolg","snowballing","soccia","socmel","sodomize","sodomy","son-of-a-bitch","Soplagaitas","Soplapollas","sorca","spac","spagnola","sphencter","spic","spierdalaj","splooge","spompinare","spooge","spread legs","spuiten","spunk","standje","standje-69g","sticchio","stoephoer","stootje","strap on","strapon","strappado","strip club","strontg","stronza","stronzata","stronzo","styervo","style doggy","suce","suck","sucks","sufferdg","suicide girls","suka","sukin syn","sultry women","sveltina","sverginare","svodit posrat","svoloch","swastika","swinger","t1tt1e5","t1tties","tainted love","tante","tapette","tapijtnek","tarzanello","taste my","tea bagging","teefg","teets","teez","temeier","teringlijer","terrone","testa di cazzo","testical","testicle","Tetas grandes","tette","teuf","threesome","throating","Tía buena","tied up","tight white","tirare","tirer","tit","titfuck","tits","titt","tittchen","titten","tittie5","tittiefucker","titties","titty","tittyfuck","tittywank","titwank","toeter","tongue in a","tongzoeng","topa","topless","torneira","tosser","towelhead","trakhat'sya","tranny","transar","Travesti","tribadism","trick","trimandoblydskiy pizdoproyob","tringle","tringler","Trio","triootjeg","trique","troia","trombare","trottoir prostituée","trottoirteef","trou du cul","tub girl","tubgirl","turd","turlute","tushy","tw4t","twat","twathead","twatty","twink","twinkie","two girls one cup","twunt","twunter","ubl'yudok","uboy","uccello","u'ebitsche","undressing","upskirt","urethra play","urophilia","utrecht","v pizdu","v14gra","v1gra","va1jina","vacca","vaffanculo","vafl'a","vafli lovit","vag1na","vagiina","vagina","vai tomar no cu","vai-te foder","vaj1na","vajina","vangare","veado","venire","venus mound","Verga","vergallen","verkloten","verneuken","vete a la mierda","veuve","viagra","viande a pneus","vibrador","vibrator","viespeuk","vingeren","violet blue","violet wand","vittu","vleesroos","vögeln","vollpfosten","voor jan lul","voor jan-met-de-korte-achternaam","vorarephilia","voyeur","vullva","vulva","vyperdysh","vzdrochennyi","w00se","w0p","wang","wank","wanker","wanky","watje","welzijnsmafia","wet dream","wetback","wh00r","wh0re","white power","whoar","whore","wichsen","wichser","wijf","willies","willy","wippen","women rapping","wop","wrapping men","wrinkled starfish","wuftje","xana","xochota","xrated","xx","xxx","yaoi","yeb vas","yed","yellow showers","yiffy","zaadje","zabourah","za'ebat","zaebis","zakkenwasser","zalupa","zalupat","zasranetc","zassat","zeiken","zeiker","zinne","zio cantante","zlo'ebuchy","zoccola","zoophilia","zuigen","zuiplap","fuck");

if($filter == 1){ // yes/no filter 

  foreach($badwords as $string) {
 
        if (strpos($text,$string) !== false){
			return 1;
		} 
  }
  return 0;

	
}

return $text;

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_text_switch($key, $text){


	switch($key){
	
		case "male": {
		
			$text = __("Men","premiumpress");
		
		} break;
		
		case "female": {
		
			$text = __("Women","premiumpress");
		
		} break;
	
	}
	
	return $text;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_main_filters(){ global $CORE;

$filters = array();

// USER SEARCHES
if(isset($_GET['user'])){

	$filters[] = array("key" => "date_added", "name" => __("Date Added","premiumpress")  );	
	
	return $filters;

}


if(in_array(THEME_KEY, array('at','sp','ct','cm','so','mj','pj',"rt"))){
$filters[] = array("key" => "price", "name" => __("Price","premiumpress") ); 
} 


$filters[] = array("key" => "tax_listing", "name" => SearchFilterCaptions("category", __("Category","premiumpress") ) ); 
 

$filters[] = array("key" => "keyword", "name" => __("Keyword","premiumpress") ); 

if(defined("THEME_KEY") && !in_array(THEME_KEY, array("sp","vt","so","ph","cp","cb") ) ){


if(_ppt(array('maps','enable')) == 1 && in_array(_ppt(array("maps","provider")), array("mapbox","google")) && strlen(_ppt(array('maps','apikey'))) > 5  ) {
	$filters[] = array("key" => "distance", 	"name" =>  SearchFilterCaptions("distance", __("Nearby","premiumpress") )   );
}


$filters[] = array("key" => "tax_country", 	"name" => __("Location","premiumpress")  );

}

 

switch(THEME_KEY){

	case "at": { 
	
		$filters[] = array("key" => "ends", "name" => __("Date Ends","premiumpress") );
		
	} break;
	
	case "pj": {
	
		//$filters[] = array("key" => "bids", "name" => __("Bids","premiumpress") ); 
		$filters[] = array("key" => "ends", "name" => __("Date Ends","premiumpress") ); 
		//$filters[] = array("key" => "seller", "name" => __("Seller Details","premiumpress") ); 
		 
	} break;
	
	case "sp": { 
	
		$filters[] = array("key" => "deliver", "name" => __("Delivery Time","premiumpress") );
		$filters[] = array("key" => "comments", "name" => __("Reviews","premiumpress") ); 
		 
	} break; 	
	case "da": { 
		 
	} break; 
	
	case "cb": {
	
		$filters[] = array("key" => "price", "name" => __("Price","premiumpress") );
		$filters[] = array("key" => "comments", "name" => __("Reviews","premiumpress") ); 
		$filters[] = array("key" => "lastused", "name" => __("Last Used","premiumpress")  );
		$filters[] = array("key" => "ends", "name" => __("Date Ends","premiumpress") );
		
	} break; 
	
	case "cp": {
		 
		$filters[] = array("key" => "comments", "name" => __("Reviews","premiumpress") ); 
		$filters[] = array("key" => "lastused", "name" => __("Last Used","premiumpress")  );
		 $filters[] = array("key" => "ends", "name" => __("Date Ends","premiumpress") );
		
	} break; 
	
	case "dl": { 
		 
		$filters[] = array("key" => "year", "name" => __("Year","premiumpress") ); 	
		 
	} break;
	
	case "mj": {
	
		$filters[] = array("key" => "deliver", "name" => __("Delivery Time","premiumpress") ); 
		//$filters[] = array("key" => "seller", "name" => __("Seller Details","premiumpress") ); 
		$filters[] = array("key" => "sold", "name" => __("Sold","premiumpress") ); 
		
		 
	} break;
	
	case "jb": {
	
		$filters[] = array("key" => "company", "name" => __("Company","premiumpress") ); 
		//$filters[] = array("key" => "seller", "name" => __("Seller Details","premiumpress") ); 
		 
	} break; 
	
	case "so": {
	
		$filters[] = array("key" => "downloads", "name" => __("Downloads","premiumpress") ); 
		if(_ppt(array('mem','enable')) == "1"){	
		$filters[] = array("key" => "membership", "name" => __("Membership","premiumpress") );
		}
		
	} break;
	
	case "vt": { 
		
		if(_ppt(array('mem','enable')) == "1"){	
	 	$filters[] = array("key" => "membership", "name" => __("Membership","premiumpress") );
		}
		
		$filters[] = array("key" => "comments", "name" => __("Reviews","premiumpress") ); 
		$filters[] = array("key" => "length", "name" => __("Video Length","premiumpress") ); 
			
	} break; 
	
	case "ll": { 
	 
		$filters[] = array("key" => "comments", "name" => __("Reviews","premiumpress") ); 
		 
	} break; 	
	
	default: {
	
		 
	} break;
	
} 
 

$taxonomies = get_taxonomies(); 
foreach ( $taxonomies as $taxonomy ) {

if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','listing','elementor_library_type','elementor_library_category', 'elementor_font_type', 
'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme','city','country' 

,'make','model',

))){ continue; } 


if(isset($filters[$taxonomy])){ continue; }

if(strpos($taxonomy, "wp_") !== false){ continue; }

$filters[] = array("type" => "tax", "key" => "tax_".$taxonomy, "name" => $CORE->GEO("translation_tax_key", $taxonomy) );

}



$filters[] = array("key" => "date_added", "name" => __("Date Added","premiumpress")  );



// RE-ORDER
$search_order = _ppt('search_order');
if(is_array($search_order) && !empty($search_order)){
	
	$newFilters = array();
	foreach($filters as $f){
		$newFilters[$f['key']] = $f;
		$newFilters[$f['key']]['order'] = 100;
	}
	
	$i=1;
	foreach($search_order as $kg => $gg){
		if(isset($newFilters[$kg])){
			$newFilters[$kg]['order'] = $i;
			$i++;
		}
	}
	
	
	$order = array_column($newFilters, 'order'); 
	array_multisort( $order, SORT_ASC, $newFilters);
	 
	
	$filters = $newFilters;
	 

}
 

return $filters;

}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_search_card_items(){ 

global $CORE;
	
	$icons = array(

		"msg" => array(
			"name" => __("Send Message","premiumpress"),
		),  

		"favs" => array(		
			"name" => __("Ad Favorites","premiumpress"),
		),
		
		"qr" => array(		
			"name" => __("QR Code","premiumpress"),
		),	
		
	);
	 
	if(in_array(THEME_KEY,array("dt"))){ 
		$icons["views"]["name"] = __("Views","premiumpress"); 
		$icons["map"]["name"] = __("Map Icon","premiumpress"); 
	}
	
	if(in_array(THEME_KEY,array("sp"))){ 
	
		unset($icons["msg"]);
		$icons["rating"]["name"] = __("Star Rating","premiumpress");
		$icons["colors"]["name"] = __("Colors","premiumpress"); 
		$icons["sizes"]["name"] = __("Sizes","premiumpress"); 
	}
	
	if(in_array(THEME_KEY,array("cm"))){ 
	unset($icons["msg"]);
	}
 
	if(in_array(THEME_KEY,array("es","da"))){ 
 
	$icons = array();
	$videopak = array(
	
		1 => array("key" => "age", "name" => __("Age","premiumpress") ),
		2 => array("key" => "height", "name" => __("Height","premiumpress") ),
		3 => array("key" => "dress", "name" => __("Dress Size","premiumpress") ),
		4 => array("key" => "city", "name" => __("City","premiumpress") ),
		 
		
	);
	
	$taxonomies = get_taxonomies(); 
	foreach ( $taxonomies as $taxonomy ) {
	if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','listing','elementor_library_type','elementor_library_category', 'elementor_font_type', 
	'topic-tag', 'product_type', 'product_visibility', 'product_cat', 'product_tag', 'product_shipping_class', 'pa_color', 'pa_size', 'advanced_ads_groups', 'wpbdp_category','wp_theme','wp_template_part_area' 
	))){ continue; } 
	
	
 
	
		$videopak[] = array("key" => "tax_".$taxonomy, "name" => $CORE->GEO("translation_tax_key", $taxonomy) );
	
	}
	
	foreach($videopak as $k => $f ){
		
		$icons[$f['key']] = array( "name" => $f['name'] );	
	}

}
 
	
	return $icons;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_checkbox_filters(){ 

$showonly = array(
	
	// TITLE
	"featured" => array(
		"name" => __("Featured","premiumpress"),
	),  
	
	// VERIFIED
	"verified" => array(		
		"name" => __("Verified","premiumpress"),
	),
	 
		
	// AT
	"buynow" => array(		
		"name" => __("Buy Now","premiumpress"),
	),
	"hasbids" => array(		
		"name" => __("Has Bids","premiumpress"),
	),
	
	// CP
	"lastused" => array(		
		"name" => __("Used Today","premiumpress"),
	),
	"offers" => array(		
		"name" => __("Offers","premiumpress"),
	),
	"cashback" => array(		
		"name" => __("Cashback","premiumpress"),
	),
	
	//"expiry" => array(		
	//	"name" => __("Live","premiumpress"),
	//),
	
	
	// ONLINE
	"online" => array(		
		"name" => __("Online","premiumpress"),
	), 
	
	// DA ES
	"hasvideo" => array(		
		"name" => __("Video","premiumpress"),
	),	 
	
	/*
	"reviews" => array(		
		"name" => __("Reviews","premiumpress"),
	),
	*/
	
	
	"sale" => array(		
		"name" => __("On Sale","premiumpress"),
	),
	
	// ONLINE
	/*
	"map" => array(		
		"name" => __("Map","premiumpress"),
	),
	*/ 


);

 

if(defined("THEME_KEY") && !in_array(THEME_KEY, array("da","ct","mj") ) ){
unset($showonly['online']);
}


if(defined("THEME_KEY") && !in_array(THEME_KEY, array("cp") ) ){
unset($showonly['offers']);
unset($showonly['lastused']);
unset($showonly['cashback']);
 

}
if(in_array(THEME_KEY, array("cp") ) && _ppt(array('cashback', 'enable' )) == '0' ){
unset($showonly['cashback']); 
}

if(defined("THEME_KEY") && in_array(THEME_KEY, array("sp","vt","so") ) ){
unset($showonly['map']);
}

if(defined("THEME_KEY") && !in_array(THEME_KEY, array("sp") ) ){
unset($showonly['sale']);
}

if(_ppt(array('lst','addon_featured_enable')) == 1){ 
	
	if(THEME_KEY == "cp"){
	
	$showonly['featured']['name'] = __("Staff Picks","premiumpress");
	
	}
	
	
}else{
	unset($showonly['featured']);
}

if(defined("THEME_KEY") && !in_array(THEME_KEY, array("da","es")) ){
unset($showonly['hasvideo']);
}
 

if(defined("THEME_KEY") && in_array(THEME_KEY, array("es") ) ){
 
	if(in_array(THEME_KEY, array("da","es")) ){
		$showonly['verified']['name'] = __("Verified","premiumpress");
	}

}else{
unset($showonly['verified']);
}

// REVIEWS
/*
if(defined("THEME_KEY") && in_array(THEME_KEY, array("cp","es")) && _ppt(array('user','comments')) == "1"){ 

}else{
unset($showonly['reviews']);
} 
*/

// EXPIRY
if(defined("THEME_KEY") && !in_array(THEME_KEY, array("at","cp")) ){
unset($showonly['expiry']);
}

// BUY NOW
if(defined("THEME_KEY") && !in_array(THEME_KEY, array("at","ct")) ){

	unset($showonly['buynow']);
	
}elseif(defined("THEME_KEY") && in_array(THEME_KEY, array("at","ct")) ){

	if(in_array(_ppt(array('lst', 'at_buynow' )), array("0")) ){
		unset($showonly['buynow']);
	}
}
if(defined("THEME_KEY") && !in_array(THEME_KEY, array("at")) ){
unset($showonly['hasbids']);
} 

return $showonly;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_orderby_filters(){ 


$orderbydata = array(
	
	// TITLE
	"title" => array(
		"name" => __("Title","premiumpress"),
		
		"down" => __("Title: (A-z)","premiumpress"),
		"up" => __("Title: (Z-a)","premiumpress"), 

	),
	
	"id" => array(		
		"name" => __("Date","premiumpress"),
		
		"up" => __("Date: (New)","premiumpress"),
		"down" => __("Date: (Old)","premiumpress"), 
		
	),
	"price" => array(		
		"name" => __("Price","premiumpress"),
		
		"up" => __("Price: (Highest)","premiumpress"),
		"down" => __("Price: (Lowest)","premiumpress"), 
	),
	
	// DA
	"age" => array(
		"name" => __("Age","premiumpress"),

		"up" => __("Age: (Young)","premiumpress"),
		"down" => __("Age: (Old)","premiumpress"), 
		
	),
	
	// AT
	"expiry" => array(
		"name" => __("Ending","premiumpress"),
		
		"down" => __("Ending: (Soon)","premiumpress"),
		"up" => __("Ending: (Last)","premiumpress"), 

	),
	// MAPS
	"distance" => array(
		"name" => __("Distance","premiumpress"),		
		"down" => __("Distance: (Closest)","premiumpress"),
		"up" => __("Distance: (Furthest)","premiumpress"), 
	),
	
	"hits" => array(		
	
		"name" => __("Popular","premiumpress"),		
		"up" => __("Popular: (Most)","premiumpress"),
		"down" => __("Popular: (Least)","premiumpress"), 

	), 

	"update" => array(		
	
		"name" => __("Recently Updated","premiumpress"),		
		"up" => __("Updated: (New)","premiumpress"),
		"down" => __("Updated: (Old)","premiumpress"), 

	),  
	
);

if(!in_array(_ppt(array('search', 'latest')),array("","1"))){
	unset($orderbydata["id"]);
}
if(!in_array(_ppt(array('search', 'pop')),array("","1"))){
	unset($orderbydata["pop"]);
}
/*
if(!in_array(_ppt(array('search', 'title')),array("1"))){
	unset($orderbydata["title"]);
}
*/
 
if(defined("THEME_KEY") && !in_array(THEME_KEY, array('da'))){
	unset($orderbydata["age"]);
}
if(defined("THEME_KEY") &&  !in_array(THEME_KEY, array('at','cp','pj')) && !isset($GLOBALS['flag-expire']) ){
	unset($orderbydata["expiry"]);
}
if(defined("THEME_KEY") &&  !in_array(THEME_KEY, array('at','sp','ct','cm','so','jb',"rt","cb"))){
	unset($orderbydata["price"]);
}


if(_ppt(array('maps','enable')) == 1 && in_array(_ppt(array("maps","provider")), array("mapbox","google"))  ) { //&& _ppt(array("searchfilter","distance")) == "1"

}elseif(in_array(THEME_KEY,array("sp","vt","cm"))){

}else{
unset($orderbydata["distance"]);
}

/*
$adminorderby = _ppt('searchorderby');
if(is_array($adminorderby) && !empty($adminorderby )){
// do we need this?
}
*/


return $orderbydata;

}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function ppt_theme_menubar(){



$menu = array(
				
	"home" 			=> array( "name" => __("Home","premiumpress"), 	 "link" => home_url()  ),						
	
	"search1" 		=> array( "name" => __("Search","premiumpress"), "link" => home_url()."/?s=", "toggle" => "#searchstyles" ),
	
	
	"search" 		=> array( "name" => __("Search","premiumpress"), "link" => home_url()."/?s=",
	
	
		"data" => array(
 		
			"s1" 		=> array( "name" => __("Search All","premiumpress"), "icon" => "search", "link" => home_url()."/?s=", ),
			
			
			"girls" => array( "name" => __("All Girls","premiumpress"), "link" => home_url()."/dagender/female/", ),  
			
			"guys" => array( "name" => __("All Guys","premiumpress"), "link" => home_url()."/dagender/male/"), 
			
 			
			"s2" 		=> array( "name" => __("Recently Added","premiumpress"), "icon" => "star", "link" => home_url()."/?s=&sort=id"  ), 
 			
			"s3" 		=> array( "name" => __("Most Popular","premiumpress"), "icon" => "users", "link" => home_url()."/?s=&sort=hits"  ),
			
			"s4" 		=> array( "name" => __("Recently Updated","premiumpress"), "icon" => "users", "link" => home_url()."/?s=&sort=update"  ),
				
 			 
		),
	
	
	 ), 	
	


	"sale" => array( "name" => __("On Sale","premiumpress"), "link" => home_url()."/sale/discount/", ),  
  		
	"stores" => array( "name" => __("Stores","premiumpress"), "link" => _ppt(array('links','stores')), ),
	 
	"how" => array( "name" => __("How it works","premiumpress"), "link" => _ppt(array('links','how'))  ),
	
	"aboutus" 	=> array( "name" => __("About Us","premiumpress"), 	"link" => _ppt(array('links','aboutus')) ),	 
	
	"memberships" 	=> array( "name" => __("Membership","premiumpress"), 	"link" => _ppt(array('links','memberships')) ),	 
	
 	"messages" => array( "name" => __("Messages","premiumpress"), "link" => _ppt(array('links','myaccount'))."/?showtab=messages" ),
 	
	
	"more" 		=> array( "name" => __("Support","premiumpress"), 		"link" => home_url()."/?s=", 
		"data" => array(
		
			"contact" 		=> array( "name" => __("Contact Us","premiumpress"), 	"link" => _ppt(array('links','contact')) ), 
			
			"pricing" 		=> array( "name" => __("Pricing Plans","premiumpress"), "link" => _ppt(array('links','pricing')), ), 	
			
			 "faq" 			=> array( "name" => __("FAQ","premiumpress"), 			"link" => _ppt(array('links','faq')) ),	
	 	
			"blog" 			=> array( "name" => __("Blog","premiumpress"), 			"link" => _ppt(array('links','blog')), ),
													
												
			"testimonials" 	=> array( "name" => __("Testimonials","premiumpress"), 	"link" => _ppt(array('links','testimonials')) ),										
			"aboutus" 		=> array( "name" => __("About Us","premiumpress"), 		"link" => _ppt(array('links','aboutus')) ),										
			"privacy" 		=> array( "name" => __("Privacy","premiumpress"), 		"link" => _ppt(array('links','privacy')) ), 			
			"sellspace" 	=> array( "name" => __("Advertise","premiumpress"), "link" => _ppt(array('links','sellspace')) ),	
			
		),
	), 	 
	
 	"blog" => array( "name" => __("Blog","premiumpress"), "link" => _ppt(array('links','blog')) ),
 
	
	
);

if(in_array(THEME_KEY,array("vt","so","dt","cp","es"))){
unset($menu['messages']);
}

if(in_array(THEME_KEY,array("es"))){
unset($menu['how']);
unset($menu['search']);
}else{
unset($menu['search1']);
}

if(in_array(THEME_KEY,array("sp"))){
$menu['search']['name'] = __("Shop","premiumpress");
unset($menu['messages']);
unset($menu['more']['data']['pricing']);
unset($menu['more']['data']['sellspace']);
}else{
unset($menu['aboutus']);
unset($menu['sale']); 
}

if(!in_array(THEME_KEY,array("da"))){
unset($menu['search']['data']['girls']); 
unset($menu['search']['data']['guys']); 
}else{
unset($menu['how']); 
}

if(in_array(THEME_KEY,array("vt","sp","cm","cp"))){
unset($menu['how']); 
}

if(!in_array(THEME_KEY,array("es","cp","so","cb"))){
unset($menu['stores']); 

}elseif(in_array(THEME_KEY,array("es"))){
$menu['stores']['name'] = __("Agencies","premiumpress");

}elseif(in_array(THEME_KEY,array("so"))){
$menu['stores']['name'] = __("Brands","premiumpress");
}

if(in_array(THEME_KEY,array("vt","da","es"))){
unset($menu['pricing']); 
}else{
unset($menu['memberships']);
}

if(in_array(THEME_KEY,array("dt"))){
$menu['how'] = array( "name" => __("Pricing","premiumpress"), "link" => _ppt(array('links','pricing')), );
unset($menu["more"]["data"]['pricing']); 
}

if(in_array(THEME_KEY,array("mj"))){
unset($menu['pricing']);
}

return $menu; 

}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function _button_gift($uid, $pid){ global $CORE, $userdata;
	
		if(!$CORE->USER("membership_hasaccess", "gifts")){ 
       
       	return 'href="javascript:void(0);"  onclick="processUpgrade();"';
       
       }elseif(!$userdata->ID){ 
       
        return 'href="javascript:void(0);" onclick="processLogin();"'; 
         
       }elseif($userdata->ID && $CORE->USER("membership_hasaccess", "gifts")){ 
       
       return 'href="javascript:void(0);"  onclick="processGifts('.$uid.','.$pid.');"';
         
       }else{    
	     
       return 'href="javascript:void(0);"  onclick="ProcessUpgrade();"';
		
       } 
}
	
function ppt_default_tax_icon($taxonomy){


$defaulticon = "fal fa-check";

 

// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dagender"){
	 
	$defaulticon = "fal fa-user";
} 
// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dasexuality"){
	 
	$defaulticon = "fal fa-smile-wink";
}
// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dathnicity"){
	 
	$defaulticon = "fal fa-globe-americas";
}



// CHECK FOR THINGS TURNED OFF
if($taxonomy == "daeyes"){
	 
	$defaulticon = "fal fa-eye";
}
// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dahair"){
 
	$defaulticon = "fal fa-palette";
}

// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dabody"){
	 
	$defaulticon = "fal fa-dewpoint";
}


// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dasmoke"){
	 
	$defaulticon = "fal fa-smoking";
}

// CHECK FOR THINGS TURNED OFF
if($taxonomy == "dadrink"){
	 
	$defaulticon = "fal fa-beer";
}


if($taxonomy == "condition"){

	$defaulticon = "fal fa-box";
}
if($taxonomy == "delivery"){

	$defaulticon = "fal fa-ship";
}

if(THEME_KEY == "dl"){
	switch($taxonomy){
	
		case "make": { $defaulticon = "fal fa-car"; } break;
		case "model": { $defaulticon = "fal fa-car-side"; } break;
		case "fuel": { $defaulticon = "fal fa-gas-pump"; } break;
		case "condition": { $defaulticon = "fal fa-car-garage"; } break;
		case "body": { $defaulticon = "fal fa-cars"; } break;
		case "transmission": { $defaulticon = "fal fa-battery-bolt"; } break;
		case "exterior": { $defaulticon = "fal fa-brush"; } break;
		case "interior": { $defaulticon = "fal fa-fill"; } break;
		case "doors": { $defaulticon = "fal fa-door-open"; } break;
		case "engine": { $defaulticon = "fal fa-car-battery"; } break;
		case "drive": { $defaulticon = "fal fa-steering-wheel"; } break;
		case "seller": { $defaulticon = "fal fa-user"; } break;
		case "owners": { $defaulticon = "fal fa-users"; } break;
	
	}
}

if(THEME_KEY == "rt"){
	switch($taxonomy){
	
		case "beds": { $defaulticon = "fal fa-bed"; } break;
		case "baths": { $defaulticon = "fal fa-bath"; } break;
 	 
	}
}
if(THEME_KEY == "da"){
	switch($taxonomy){
	
		case "dahairlength": { $defaulticon = "fal fa-cut"; } break;
		 
	}
}

return $defaulticon;

}
 

function SearchFilterCaptions($filter, $default){ global $CORE;

	switch($filter){
	
		case "distance": {
		
			
			if(in_array(THEME_KEY,array("da","es"))){
				return __("Nearby Users","premiumpress");
			}
			
			return str_replace("%s", $CORE->LAYOUT("captions","2"), __("Nearby %s","premiumpress") );
		
		
		} break;
	
		case "rating": {		
			return __("Rating","premiumpress"); 		
		} break;
		
		case "tax_refunds":
		case "refunds": {		
			return __("Refunds","premiumpress"); 		
		} break;
	
		case "year": {
		
			return __("Year","premiumpress"); 
		
		} break;
	
		case "price": {
		
			if(THEME_KEY == "jb"){ 
			
				return __("Salary","premiumpress"); 
			
			}elseif(THEME_KEY == "pj"){ 
			
				return __("Budget","premiumpress"); 
					
			}elseif(THEME_KEY == "mj"){ 
			
				return __("Budget","premiumpress"); 
			
			}else{
				return __("Price","premiumpress"); 
			}
		
		} break;
		
		case "tax_store": 
		case "store": {
			
			
			if(THEME_KEY == "es"){ 
			return __("Agency","premiumpress");
			}
			
			return __("Store","premiumpress");
		
		} break;
		
		case "tax_beds": 
		case "beds": {
		
			return __("Bedrooms","premiumpress");
		
		} break;
		
		
		case "tax_remote": 
		case "remote": {
		
			return __("Remote","premiumpress");
		
		} break;		
		case "tax_experience": 
		case "experience": {
		
			return __("Experience","premiumpress");
		
		} break;
			
		case "tax_company": 
		case "company": {
		
			return __("Company","premiumpress");
		
		} break;		
			
		case "tax_system": 
		case "system": {
		
			return __("System","premiumpress");
		
		} break;		
		case "tax_baths": 
		case "baths": {
		
			return __("Bathrooms","premiumpress");
		
		} break;
				
		case "tax_type": 
		case "type": {
		
			if(THEME_KEY == "rt"){
		
			return __("Rental/Sale","premiumpress");			 
			 
			}else{
			
			return __("Type","premiumpress");
			  
			}			
			
		} break;
		case "all-category": {
		
			if(THEME_KEY == "ex"){
		
			return __("All Language","premiumpress");			 
			
			}elseif(THEME_KEY == "rt"){
		
			return __("All Types","premiumpress");
			
			}elseif(THEME_KEY == "da"){
		
			return __("All Star signs","premiumpress");
			
			}elseif(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1'){
		
			return __("All Makes &amp; Models","premiumpress");

			}else{
			
			return __("All Categories","premiumpress");
			  
			}			
			
		} break;
		
		case "tax_listing":
		case "category": {
		
			if(isset($GLOBALS['flag-taxonomy']) && is_numeric($GLOBALS['flag-taxonomy-id']) && $GLOBALS['flag-taxonomy-id'] > 0){ 
	
			return __("Sub Categories","premiumpress"); 
	
			}
		
			if(THEME_KEY == "ex"){
		
			return __("Language","premiumpress");			 
			
			}elseif(THEME_KEY == "rt"){
		
			return __("Type","premiumpress");
			
			}elseif(THEME_KEY == "da"){
		
			return __("Star sign","premiumpress");
			
			}elseif(THEME_KEY == "dl" || _ppt(array('lst','makemodels')) == '1'){
		
			return __("Make &amp; Model","premiumpress");
		
			}else{
			
			return __("Category","premiumpress");
			  
			}			
			
		} break;
		
 		case "tax_delivery":
		case "delivery": {		
			return __("Delivery","premiumpress");		
		} break;
				
 		case "tax_city":
		case "city": {		
			return __("City","premiumpress");		
		} break;
		
		case "tax_pets":
		case "pets": {		
			return __("Pets","premiumpress");		
		} break;
		
		case "tax_garden":
		case "garden": {		
			return __("Garden","premiumpress");		
		} break;
				
		case "tax_parking":
		case "parking": {		
			return __("Parking","premiumpress");		
		} break;
		
		case "tax_payment":
		case "payment": {		
			return __("Payment","premiumpress");		
		} break;
		
		case "tax_wifi":
		case "wifi": {		
			return __("Wifi Access","premiumpress");		
		} break;
			
		case "tax_age":
		case "age": {		
			return __("Age","premiumpress");		
		} break;
		
		case "dahairlength":
		case "tax_dahairlength":{		
			return __("Hair Length","premiumpress");		
		} break;
		 
	
	}

	return $default;
}

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
function ppt_encode_string($string,$key) {
    
    return bin2hex($string);
}

function ppt_decode_string($string,$key) {
	
	return hex2bin($string);

}
function ppt_current_page(){ global $post;


$cpage = str_replace("inline-editor","",$_SERVER['REQUEST_URI']);	 

return $cpage;
}


function ppt_footer_output($df){ global $CORE_UI, $CORE;


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
  
$footer = ppt_footer_settings($df);
 
// SOCIAL
ob_start();
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "5", "size" => "md", "website" => 1, "footer" => 1));
$social_1 = ob_get_contents();
ob_end_clean();

ob_start();
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "md", "website" => 1, "footer" => 1));
$social_2 = ob_get_contents();
ob_end_clean();

ob_start();
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "2", "size" => "md", "website" => 1, "footer" => 1));
$social_3 = ob_get_contents();
ob_end_clean();

ob_start();
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "rounded", "style" => "4", "size" => "md", "website" => 1, "footer" => 1));
$social_4 = ob_get_contents();
ob_end_clean();

ob_start();
echo $CORE_UI->ICONS("social", array("uid" => 0, "css" => "", "style" => "2", "size" => "lg", "website" => 1, "footer" => 1));
$social_big = ob_get_contents();
ob_end_clean();

// CARDS
$cards = $footer['icons'];
 
// LOGO
ob_start();
echo $CORE->LAYOUT("get_logo","light");
$logo = ob_get_contents();
ob_end_clean();

// NEWSLETETR
ob_start();							 
_ppt_template( 'widgets/widget-newsletter-form' ); 
$newsletter = ob_get_contents();
ob_end_clean();	

// DESCRIPTION
$desc = $footer['desc'];

 

// MENU1 
if(in_array($df['footer_menu1'],array("","none")) && isset($df['footer_menu1_links']) && is_array($df['footer_menu1_links']) && count($df['footer_menu1_links']) > 0 && $df['footer_menu1_links'][0]['field'] != "" ){
	$menu1 = "<ul>";
	foreach($df['footer_menu1_links'] as $a => $b){
		$menu1 .= "<li><a href='".$b['field']."'>".$b['field_name']."</a></li>";
	}
	$menu1 .= "</ul>";
}else{

	ob_start();							 
	echo $footer['menu1'];
	$menu1 = ob_get_contents();
	ob_end_clean();	
}
$menu1_title = $footer['menu1_title'];

$menu_footer = str_replace("<li>","<li class='mx-2'>",str_replace("default_footer_menu","d-md-inline-flex justify-content-around",$menu1));



// MENU2
if(in_array($df['footer_menu2'],array("","none")) && isset($df['footer_menu2_links']) && is_array($df['footer_menu2_links']) && count($df['footer_menu2_links']) > 0 && $df['footer_menu2_links'][0]['field'] != "" ){
 
	$menu2 = "<ul>";
	foreach($df['footer_menu2_links'] as $a => $b){
		$menu2 .= "<li><a href='".$b['field']."'>".$b['field_name']."</a></li>";
	}
	$menu2 .= "</ul>";
}else{
ob_start();							 
echo $footer['menu2'];
$menu2 = ob_get_contents();
ob_end_clean();	
}

$menu2_title = $footer['menu2_title'];

// MENU3
if(in_array($df['footer_menu3'],array("","none")) && isset($df['footer_menu3_links']) && is_array($df['footer_menu3_links']) && count($df['footer_menu3_links']) > 0 && $df['footer_menu3_links'][0]['field'] != "" ){
	$menu3 = "<ul>";
	foreach($df['footer_menu3_links'] as $a => $b){
		$menu3 .= "<li><a href='".$b['field']."'>".$b['field_name']."</a></li>";
	}
	$menu3 .= "</ul>";
}else{
ob_start();							 
echo $footer['menu3'];
$menu3 = ob_get_contents();
ob_end_clean();	
}
$menu3_title = $footer['menu3_title'];

// MENU4
if(in_array($df['footer_menu4'],array("","none")) && isset($df['footer_menu4_links']) && is_array($df['footer_menu4_links']) && count($df['footer_menu4_links']) > 0 && $df['footer_menu4_links'][0]['field'] != "" ){
	$menu4 = "<ul>";
	foreach($df['footer_menu4_links'] as $a => $b){
		$menu4 .= "<li><a href='".$b['field']."'>".$b['field_name']."</a></li>";
	}
	$menu4 .= "</ul>";
}else{
ob_start();							 
echo $footer['menu4'];
$menu4 = ob_get_contents();
ob_end_clean();	
}

$menu4_title = $footer['menu4_title'];
 
// NEWSLETETR
ob_start();							 
_ppt_template( 'widgets/widget-newsletter-form' ); 
$newsletter = ob_get_contents();
ob_end_clean();	
 
// COPY
$copyright =  $footer['copy'];

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

ob_start();	
?><section><?php 						 
_ppt_template( 'framework/design/footer/new/top' ); 
_ppt_template( 'framework/design/footer/new/mid' ); 						 
_ppt_template( 'framework/design/footer/new/bot' ); 
?></section><?php
$output = ob_get_contents();
ob_end_clean();
 

return str_replace("%menu1%", $menu1,

str_replace("%menu1_title%", $menu1_title, 

str_replace("%menu2%", $menu2, str_replace("%menu2_title%", $menu2_title,  
str_replace("%menu3%", $menu3, str_replace("%menu3_title%", $menu3_title, 
str_replace("%menu4%", $menu4, str_replace("%menu4_title%", $menu4_title, 

str_replace("%copy%", $copyright,
str_replace("%newsbox%",$newsletter,
str_replace("%desc%", $desc,
str_replace("%menu_footer%", $menu_footer,

str_replace("%social_1%", $social_1,
str_replace("%social_2%", $social_2,
str_replace("%social_3%", $social_3,
str_replace("%social_4%", $social_4,

str_replace("%social_big%", $social_big,


str_replace("%cards%", $cards,

str_replace("%logo%", $logo, ppt_theme_block_output($output, $df, array("footer", "footer1"))))))))))))))))))))); 

}

function ppt_footer_settings($settings = array()){ global $CORE;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$footer_logo = 1; $footer_logo_img = "";
if(_ppt(array('newfooter','logo')) == "0"){
$footer_logo = 0;
}else{
	if(isset($settings['section_bg']) && in_array($settings['section_bg'], array('bg-light','','bg-white'))){
	$footer_logo_img = str_replace("text-primary","",str_replace("text-secondary","",str_replace("text-muted","", $CORE->LAYOUT("get_logo","dark") ))); 
	}else{
	$footer_logo_img = str_replace("text-primary","",str_replace("text-secondary","",str_replace("text-muted","", $CORE->LAYOUT("get_logo","light") )));
	}
}

	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$footer_description = "";
if(isset($settings['footer_description']) && strlen($settings['footer_description']) > 2){
$footer_description = $settings['footer_description'];
}elseif(strlen(_ppt(array('newfooter','desc'))) > 2){
$footer_description = _ppt(array('newfooter','desc'));
}elseif(strlen(_ppt(array('company','mission'))) > 2){ 
$footer_description = _ppt(array('company','mission')); 
}else{ 
$footer_description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";
} 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$footer_menu1_title = "";
if(isset($settings['footer_menu1_title']) && strlen($settings['footer_menu1_title']) > 2){
$footer_menu1_title = $settings['footer_menu1_title'];
}elseif(strlen(_ppt(array('newfooter','menu1_title'))) > 1){
$footer_menu1_title = _ppt(array('newfooter','menu1_title'));
}else{
$footer_menu1_title = __("Useful Links","premiumpress");
}


$footer_menu1 = "";
if(isset($settings['footer_menu1']) && strlen($settings['footer_menu1']) > 2){
$footer_menu1 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu1'].'" class="links-vertical list-unstyled"][/MAINMENU]'));
}elseif(strlen(_ppt(array('newfooter','menu1'))) > 1 && _ppt(array('newfooter','menu1')) != "none"){
$footer_menu1 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'._ppt(array('newfooter','menu1')).'" class="links-vertical list-unstyled"][/MAINMENU]'));
}else{
$footer_menu1 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="links-vertical list-unstyled"][/MAINMENU]'));
}
 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$footer_menu2_title = "";
if(isset($settings['footer_menu2_title']) && strlen($settings['footer_menu2_title']) > 2){
$footer_menu2_title = $settings['footer_menu2_title'];
}elseif(strlen(_ppt(array('newfooter','menu2_title'))) > 1){
$footer_menu2_title = _ppt(array('newfooter','menu2_title'));
}else{
$footer_menu2_title = __("Quick Search","premiumpress");
}

$footer_menu2 = "";
if(isset($settings['footer_menu2']) && strlen($settings['footer_menu2']) > 2){
$footer_menu2 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu2'].'" class="links-vertical list-unstyled"][/MAINMENU]'));
}elseif(strlen(_ppt(array('newfooter','menu2'))) > 1 && _ppt(array('newfooter','menu2')) != "none"){
$footer_menu2 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'._ppt(array('newfooter','menu2')).'" class="links-vertical list-unstyled"][/MAINMENU]'));
}else{
$footer_menu2 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="links-vertical list-unstyled"][/MAINMENU]'));
}	

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$footer_menu3_title = "";
if(isset($settings['footer_menu3_title']) && strlen($settings['footer_menu3_title']) > 2){
$footer_menu3_title = $settings['footer_menu3_title'];
}elseif(strlen(_ppt(array('newfooter','menu3_title'))) > 1){
$footer_menu3_title = _ppt(array('newfooter','menu3_title'));
}else{
$footer_menu3_title = __("Members","premiumpress");
}

$footer_menu3 = "";
if(isset($settings['footer_menu3']) && strlen($settings['footer_menu3']) > 2){
$footer_menu3 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu3'].'" class="links-vertical list-unstyled"][/MAINMENU]'));
}elseif(strlen(_ppt(array('newfooter','menu3'))) > 1 && _ppt(array('newfooter','menu3')) != "none"){
$footer_menu3 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'._ppt(array('newfooter','menu3')).'" class="links-vertical list-unstyled"][/MAINMENU]'));
}else{
$footer_menu3 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="links-vertical list-unstyled"][/MAINMENU]'));
}	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
$footer_menu4_title = "";
if(isset($settings['footer_menu4_title']) && strlen($settings['footer_menu4_title']) > 2){
$footer_menu4_title = $settings['footer_menu4_title'];
}elseif(strlen(_ppt(array('newfooter','menu4_title'))) > 1){
$footer_menu4_title = _ppt(array('newfooter','menu4_title'));
}else{
$footer_menu4_title = __("Contact","premiumpress");
}

$footer_menu4 = "";
if(isset($settings['footer_menu4']) && strlen($settings['footer_menu4']) > 2){
$footer_menu4 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'.$settings['footer_menu4'].'" class="links-vertical list-unstyled"][/MAINMENU]'));
}elseif(strlen(_ppt(array('newfooter','menu4'))) > 1 && _ppt(array('newfooter','menu4')) != "none"){
$footer_menu4 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU menu_name="'._ppt(array('newfooter','menu4')).'" class="links-vertical list-unstyled"][/MAINMENU]'));
}else{
$footer_menu4 = str_replace("nav-link","opacity-8",do_shortcode('[MAINMENU footer=1 class="links-vertical list-unstyled"][/MAINMENU]'));
}	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
      
$footer_newsletter = 1;
if(_ppt(array('newfooter','news')) == "0"){
$footer_newsletter = 0;
}	

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$icons = CDN_PATH."images/cards_all.svg";
if(strlen(_ppt("footer_icons")) > 2){
$icons = _ppt("footer_icons"); 
}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$footer_copyright = "";
if(strlen(_ppt(array('newfooter','copy'))) > 2){
$footer_copyright = "&copy; ".date("Y")." ". _ppt(array('newfooter','copy'));
}elseif(isset($settings['footer_copyright']) && strlen($settings['footer_copyright']) > 2){
$footer_copyright = $settings['footer_copyright'];
}else{
$footer_copyright = "&copy; ".date("Y")." ".stripslashes(_ppt(array('company','name')))." ".__("All rights reserved.","premiumpress");
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
$footer_phone = "44 1232 9389 1233";
if(strlen(_ppt(array('company','phone')) > 2)){
$footer_phone = _ppt(array('company','phone'));
}

$footer_email = _ppt(array('company','email'));
if($footer_email == ""){
$footer_email = "mywebsite@gmail.com";
}

$footer_address = _ppt(array('company','address'));
if($footer_address == ""){
$footer_address = "Horse Guards. UK. M4 182";
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

return array(

"logo" => $footer_logo, 
"logo_img" =>  $footer_logo_img, 
"desc" => $footer_description, 

"menu1" => $footer_menu1, 
"menu1_title" => $footer_menu1_title, 

"menu2" => $footer_menu2, 
"menu2_title" => $footer_menu2_title, 

"menu3" => $footer_menu3, 
"menu3_title" => $footer_menu3_title,

"menu4" => $footer_menu4, 
"menu4_title" => $footer_menu4_title,

"news" => $footer_newsletter, 
"icons" => $icons, 
"copy" => $footer_copyright, 
"phone" => $footer_phone, 
"address" => $footer_address, 
"email" => $footer_email,

);

}

function ppt_check_preview_mode(){

	if(isset($_GET['elementor-preview']) || isset($_GET['preview_id'])){
		return 1;
	}	
	 
	return 0; // needs rechecking  

}

function membership_plan_features_full(){  global $CORE;

$memberships = $CORE->USER("get_memberships", array());

if(_ppt(array('mem','register')) == "1"){ }else{  
array_unshift($memberships , array("key" => 0, "name"=> __("No Membership","premiumpress"), "price" => "0", "icon" => "" ));
}

?>
 

<div id="membership_table_compare">
<div class="<?php if(!is_admin()){ ?>card card-body shadow-sm card-mobile-transparent<?php } ?>">
<div class="_header hide-mobile">
<div class="d-flex justify-content-between">

    <div class="_name align-self-center">&nbsp;</div>
    <div class="w-100">
        <div class="d-flex  justify-content-between">
        
            <?php foreach($memberships as $mem){ ?>
                <div class="_value">
                <span class=""><?php echo $mem['name']; ?></span>
                
           
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</div> 

<div class="_block small text-600">
<div class="d-flex justify-content-between">

    <div class="_name align-self-center">&nbsp;</div>
    <div class="w-100">
        <div class="d-flex  justify-content-between">
        
            <?php foreach($memberships as $mem){ ?>
                <div class="_value" style="min-width:50px;">
                
                
                <div>
                <?php if($mem['key'] != 0){ ?><?php echo hook_price($mem['price']); ?><?php } ?>
                </div>
                
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</div> 

    <?php $ff=1; foreach($CORE->USER("membership_features", array()) as $f){ 
	 
	$name 	= "";
	$desc 	= "";
	$active = "";
	$icon = "fa-cog";
	$name = $f['name'];
				
	if(isset($f['name_front_end'])){
		$name = $f['name_front_end'];
	}
	
	if(isset($f['desc_front_end'])){
		$desc = $f['desc_front_end'];
	}
	
	if(isset($f['icon'])){
		$icon 	= $f['icon'];
	}
	
	$icon = "fa-cog";
	
	$count = "";
	$count_txt = "";
?>

<div class="_block <?php if($ff%2){ echo "odd"; } ?> block-<?php echo $f['key']; ?>">
<div class="d-flex justify-content-between">

    <div class="_name align-self-center">
          <!--<i class="fal text-warning <?php echo $icon; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $desc; ?>"></i> -->
		  
		  <?php echo $name; ?> 
          
          
   <div class="badge_tooltip text-center float-right mr-3" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal fa fa-info-circle" style="color:#000000"></i></div>
    <div class="badge_tooltip__item"><?php if(is_admin()){ echo $f['desc']; }else{ echo $f['desc_user']; } ?></div>
  </div>
          
    </div>
    <div class="w-100">
        <div class="d-flex  justify-content-between">
        
            <?php $hideBlock=0; foreach($memberships as $mem){ ?>
                <div class="_value">
                 
                 <?php if( _ppt($mem['key']."_".$f['key']."_hide") == "1" || _ppt("mem".$mem['key']."_".$f['key']."_hide") == "1" ){ 
				 
				 $hideBlock++;
				  
				 if($hideBlock == count($memberships)){ ?>
                 <script type='text/javascript'>
                  jQuery(document).ready(function(){
                      jQuery('.block-<?php echo $f['key']; ?>').hide();
                  });
              </script>
                 <?php }
				 
				 }elseif( _ppt($mem['key']."_".$f['key']) == "0" || _ppt("mem".$mem['key']."_".$f['key']) == "0" ){ ?>
                
                <i class="fa fa-times text-danger"></i>
                
                <?php }else{ 
				
				switch($f['key']){
				
					case "max_msg": {
						
						$count_txt = "";
						
						$count = _ppt('mem'.$mem['key'].'_max_msg_count');
						
						$desc = str_replace("%x", $count ,$f['desc_front_end']);	
					
					} break;
					
					case "downloads": { 
						
						$count_txt = "";
						
						$count = _ppt('mem'.$mem['key'].'_downloads_count');
						
						$desc = str_replace("%x", $count ,$f['desc_front_end']);		
					
					} break;
					
					case "listings": { 
						
						$count_txt = __("free","premiumpress");
						
						$count = _ppt('mem'.$mem['key'].'_listings_count');
						 
						if(!is_numeric($count)){ $count = 0; }
						
						$desc = str_replace("%x", $count ,$f['desc_front_end']);		
					
					} break;	
				}
							
				?>
                
                <i class="fa fa-check text-success"></i>
                
                <?php if(isset($count)){ ?><div class="_num"><?php echo $count;?> <?php echo $count_txt; ?></div><?php } ?>
                
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</div> 

<?php $ff++; } ?>
</div>  
</div>  
<?php 

}

function membership_plan_features($order_data){  global $CORE;

$subdata = $CORE->USER("get_this_membership",$order_data);
 
?>
 
<div class="container">
<div class="row">
<?php

$hideBlock = 0; 
foreach($CORE->USER("membership_features", array()) as $f){  

	if( _ppt($subdata['key']."_".$f['key']."_hide") == "1" || _ppt("mem".$subdata['key']."_".$f['key']."_hide") == "1" ){ continue; }
	
	// HIDE IF NOT ENABLED
	if( _ppt($subdata['key']."_".$f['key']) == "0" || _ppt("mem".$subdata['key']."_".$f['key']) == "0" ){ continue; }
	
	$name 	= "";
	$desc 	= "";
	$active = "";
	$icon = "fa-cog";
	
	//echo $f['key']."<--";
	
	switch($f['key']){
	
		case "max_msg": {
		
			$count = _ppt('mem'.$subdata['key'].'_max_msg_count');
			
			$f['desc_front_end'] = str_replace("%x", $count ,$f['desc_front_end']);	
		
		} break;
		
		case "downloads": { 
			
			$count = _ppt('mem'.$subdata['key'].'_downloads_count');
			
			$f['desc_front_end'] = str_replace("%x", $count ,$f['desc_front_end']);		
		
		} break;
		
		case "listings": { 
			
			$count = _ppt('mem'.$subdata['key'].'_listings_count');
			
			$f['desc_front_end'] = str_replace("%x", $count ,$f['desc_front_end']);		
		
		} break;	
	}
	
	$name = $f['name'];
				
	if(isset($f['name_front_end'])){
		$name = $f['name_front_end'];
	}
	
	if(isset($f['desc_front_end'])){
		$desc = $f['desc_front_end'];
	}
	
	if(isset($f['icon'])){
		$icon 	= $f['icon'];
	}

?>

<div class="col-md-4 col-xl-3 text-center">

	<i class="fal text-warning <?php echo $icon; ?> my-3 fa-2x" data-toggle="tooltip" data-placement="top" title="<?php echo $desc; ?>"></i>

	<div class="font-weight-bold small"><?php echo $name; ?></div> 
    
</div> 
<?php } ?>
</div></div>
<?php 

}

function notify_string_filter($data, $str, $who){
	
	global $CORE;
 
	if(is_numeric($data['user_to'])){
		$str = str_replace("%user_to", "<strong>".$CORE->USER("get_username",$data['user_to'])."</strong>", $str);
	}
			
	if(is_numeric($data['user_from'])){
		$str = str_replace("%user_from", "<strong>".$CORE->USER("get_username",$data['user_from'])."</strong>", $str);
	}
	 
	if( strpos($str,"%post_name") !== false ){
		$id = get_post_meta($data['log_id'], 'log_postid', true);
		$str = str_replace("%post_name", "<strong>".get_the_title($id)."</strong>", $str);
	}

	// CLEAN UP
	foreach(array("%user_from","%user_to") as $tag){
		$str = str_replace($tag,"", $str);
	}

	return $str;

}

function theme_sidebar_buttons($type, $text = "", $trigger = 0, $css = "btn-xl mt-0 mb-3"){
	
	global $userdata, $CORE, $post;
	
	if($trigger){
	$css .= " mobile-buynow-trigger";
	}

	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	
	switch($type){
	
	case "badges": {
	 
	$canC1 = 0;
	$customBadges = array(); 
	/*
	
	
	if(get_post_meta($post->ID, 'photosverified', true) == 1 ){ 
	
		$customBadges = array( "photosverified" => array("name" => __("Photos Verified","premiumpress"), "icon" => "fa fa-camera", "css" => "bg-success text-light", "desc" => __("User photos have been verified by our website admins.","premiumpress") ) );
	 	
		$canC1 = 1;
	}	
	*/
	
	
	
	// CHECK WE HAVE BADHES ENABLED
	if(in_array(_ppt(array('badges', 'enable' )), array("","1")) ){ 	
		$myBadges = get_post_meta($post->ID,'badges',true);  
	}  
	
	$canC2 = 0;
	if(!empty($myBadges) ){ 
		$canC2 = 1;	
	}
	
	if($canC1 ==0 && $canC2 ==0){ 
	return "";
	}
	?>
	 
	<div class="ppt-badges clearfix mb-3"> 
    	
        
        <?php if(is_array($customBadges) && !empty($customBadges) ){ ?>
        
        <?php foreach($customBadges as $cb){ ?>
        <div class="_badge <?php echo $cb['css']; ?> mr-2">
        
        <div class="badge_tooltip text-center" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal <?php echo $cb['icon']; ?>"></i> <?php echo $cb['name']; ?>
    </div>
    <div class="badge_tooltip__item"><?php echo $cb['desc']; ?> </div>
  </div>
  
        
        </div>
        <?php } ?>
        
        <?php } ?>
        
 
    <div class="">
        <?php
        $current_data = get_option("ppt_badges");
         
        if( !empty($current_data) ){ $show = 0; $i=0; foreach($current_data['name'] as $data){ 
        
        if($current_data['name'][$i] == ""){ $i++; continue; }
 				
        if(in_array($current_data['key'][$i], $myBadges)){
		 
        
        ?>
       
           
<div class="_badge <?php if(defined('WLT_DEMOMODE') && $current_data['color'][$i] == "#2266C6"){ echo "bg-primary"; } ?>" style="<?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>color:<?php echo $current_data['txtcolor'][$i]; ?>;<?php } ?><?php if(defined('WLT_DEMOMODE') && $current_data['color'][$i] == "#2266C6"){ echo ""; }elseif(isset($current_data['color'][$i]) && strlen($current_data['color'][$i]) > 1){ ?>background-color:<?php echo $current_data['color'][$i]; ?>;<?php } ?>"> 
    
    
    <?php if(isset($current_data['desc'][$i]) && strlen($current_data['desc'][$i]) > 1){ ?>
    
<div class="badge_tooltip text-center" data-direction="top">
    <div class="badge_tooltip__initiator"> 
   <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> <?php echo $current_data['name'][$i]; ?>
    </div>
    <div class="badge_tooltip__item"><?php echo $current_data['desc'][$i]; ?> </div>
  </div>
  
  <?php }else{ ?>
  <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['txtcolor'][$i]) && strlen($current_data['txtcolor'][$i]) > 1){ ?>style="color:<?php echo $current_data['txtcolor'][$i]; ?>"<?php } ?>></i> 
  <?php echo $current_data['name'][$i]; ?>
  <?php } ?>

</div>
     
        <?php $show++; } $i++; } } ?> 
        </div>
	
	 
	</div>
	<?php
 
	} break;
	
	case "membershipaccess": {  
	
	if(_ppt(array('mem','enable')) == 1){
	
	$value = get_post_meta($post->ID,'videoaccess',true);
	 
	 
	
	if(!empty($value) && $value[0] != ""){
	?>
	
<div class="ppt-awards">
<div class="fieldset mt-n3">
<div class="_title text-600"><span><?php echo __("Members Only","premiumpress"); ?></span></div>
<div class="tiny text-center px-md-4 mb-3"><?php echo __("This download is available for members only.","premiumpress"); ?></div>
<div class="d-flex justify-content-center">
	   
<?php 
		
 
$status = array(
	"" 		=> __("Everyone","premiumpress"),
	"loggedin" 	=> __("Logged In Users","premiumpress"),		
	"subs" 	=> __("Any Membership","premiumpress"), 
);

// GET ALL MEMBERSHIPS
$all_memberships = $CORE->USER("get_memberships", array());
foreach($all_memberships  as $key => $m){
	$status[$m['key']] = $m['name'];
} 



if( _ppt(array('lst', 'requirelogin_videos' )) == '1'){
	$value["loggedin"] = "loggedin";
}		 

if(is_array($value) && !empty($value) ){  
	$psks = "";
		foreach($status as $key => $club){
		
		//if(in_array($key, array("","subs")) ){ continue; } 
		
		if(in_array($key,$value) || in_array("mem".$key,$value) ){ 
		
		$icon = "fa-users";
		
		if($key == "loggedin"){
			$icon = "fa-user-shield";		
		}elseif($key == "subs"){
			$con = "fa-users-crown";		
		}elseif(is_numeric($key)){		
			$icon = _ppt('mem'.$key.'_icon');		 
		}
				 				 
		?>
			<div class="_award" style="border-color:">    
			<div class="badge_tooltip" data-direction="top">
				<div class="badge_tooltip__initiator"> 
			   <i class="fal fa <?php echo $icon; ?>"></i>
				</div>
				<div class="badge_tooltip__item"><?php echo $club; ?></div>
			  </div>
			</div>
		<?php 	 
		}
	} 
} 
?>
</div>
</div>
</div>

<?php if(!$CORE->USER("hasaccess_special_vdeoaccess", $post->ID)){ ?>
  <a href="javascript:void(0)"  <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?>onclick="processUpgrade();"<?php } ?>  class="btn btn-primary btn-block font-weight-bold btn-lg" data-ppt-btn>
        <span><?php echo __("Upgrade Now","premiumpress") ?></span>
</a>
<script>
jQuery(document).ready(function(){  
	 
		jQuery("#downloadbutton").attr('disabled','disabled'); 
		 
});
</script>    
        
        
<?php } ?>

<?php 

}

}
	
	} break;
	
	case "awards": {
	 
	
	// CHECK WE HAVE BADHES ENABLED
	if(in_array(_ppt(array('awards', 'enable' )), array("","1")) && isset($post->ID) ){ 
	
	$myBadges = get_post_meta($post->ID,'awards',true);
	 
	if(!is_array($myBadges) || is_array($myBadges) && empty($myBadges) ){ 
	
		return ""; 
	
	}
	?>
	 
	<div class="ppt-awards">
	<div class="fieldset mt-n3">
	<div class="_title"><span><?php echo __("Awards Received","premiumpress"); ?></span></div>
	<div class="d-flex justify-content-center">
	<?php $shown =0;
	$current_data = get_option("ppt_awards");
	 
	if( !empty($current_data) ){ $show = 0; $i=0; foreach($current_data['name'] as $data){ 
	
	if($current_data['name'][$i] == ""){ $i++; continue; }
	
	if(in_array($current_data['key'][$i], $myBadges)){ $shown++;
	
	?>
   
	<div class="_award" style="border-color:<?php echo $current_data['color'][$i]; ?>">    
	<div class="badge_tooltip" data-direction="top">
		<div class="badge_tooltip__initiator"> 
	   <i class="fal <?php echo $current_data['icon'][$i]; ?>" <?php if(isset($current_data['color'][$i]) && strlen($current_data['color'][$i]) > 1){ ?>style="color:<?php echo $current_data['color'][$i]; ?>"<?php } ?>></i>
		</div>
		<div class="badge_tooltip__item"><?php echo $current_data['name'][$i]; ?> </div>
	  </div>
	</div>
   
	<?php $show++; } $i++; } } ?> 
    </div>
	
	</div>
	</div>
<?php if($shown == 0){ ?>
<script type="text/javascript"> 
jQuery(document).ready(function(){  
		jQuery(".ppt-awards").hide(); 
			
});
</script>
<?php } ?>
	<?php

	}

	} break;
	
	
	case "favs": {
		
	 if(in_array(_ppt(array('user','favs')), array("","1")) ){
     
    	 echo do_shortcode('[FAVS class="btn btn-block btn-system btn-icon icon-before '.$css.'" text=1 icon=0 tooltip=0]');
	
    }
	
	} break;
 
	
	case "messages":
	case "contact": {
		
		if(in_array(_ppt(array('user','account_messages')), array("","1")) ){
		
			if(!$userdata->ID && !in_array(_ppt(array('user','messages_login_required')), array("1")) && in_array(THEME_KEY,array("dt","rt","at","ct","jb")) ){ ?>
			  
			  
			  <a href="javascript:void(0)" onclick="processContactForm(<?php echo $post->ID; ?>);" class=" <?php echo $css; ?>" data-ppt-btn>
			 
			  <span><?php echo $text ?></span>              
              </a>
              
              <?php _ppt_template( 'widgets/_contactform' );  ?>
			  
			<?php }else{ ?>
		
			  <a <?php echo $CORE->USER("get_message_link", $post->post_author); ?> class="<?php echo $css; ?>" data-ppt-btn>
			 
			  <span><?php echo $text; ?></span>
              </a>
			  
		<?php }
			  
		} 
	
	} break;
	 
	
	case "review": { 
	
	if(in_array(_ppt(array('design', 'display_comments')), array("","1"))){ ?>
    
		<a href="javascript:void(0);" <?php if(!$userdata->ID){ ?> onclick="processLogin();" <?php }else{ ?> onclick="processCommentPop();" <?php } ?>  class="<?php echo $css; ?>">
        
        <span><?php echo __("Write Review","premiumpress") ?></span></a>
        
		<?php }
		
	}break;


	case "favs_small": {
	
		 if(in_array(_ppt(array('user','favs')), array("","1")) ){
     
    	 echo do_shortcode('[FAVS class="btn bg-white btn-block mt-2 small" text=1 icon=0 tooltip=0]');
	
   	 }
	} break;
 
	
	
	}

}
 
 
function single_page_titles(){

$text = array();

switch(THEME_KEY){

	case "pj": {
	
	$text = array(
		"1_intro" 		=> __("Job Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> __("Job Offers","premiumpress"),	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Employer","premiumpress"),
	);
 
	} break;

	case "cp": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> "",
		"4_services" 	=> "",	
		"5_reviews" 	=> __("User Feedback","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;
	
	case "ph": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;

	case "sp": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> "",
		"4_services" 	=> "",	
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;

	case "ll": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;
	
	case "so": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;

	case "vt": {
	global $post;
	
	$text = array(
		"1_intro" 		=> __("Intro","premiumpress"),
		"2_location" 	=> "",
		"4_services" 	=> "",	
		"3_features" 	=> __("Details","premiumpress"),
		"5_reviews" 	=> __("User Comments","premiumpress"),
		"6_author" 		=> __("Channel","premiumpress"),
	);
	
	
	if( isset($post->post_author) && user_can($post->post_author,'administrator') ){	
	//unset($text['6_author']);
	}elseif(_ppt(array('user','allow_profile')) == "0"){
	unset($text['6_author']);
	}
	
 
	} break;

	case "cm": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> "",
		"4_services" 	=> __("Price Comparison","premiumpress"),	
		"3_features" 	=> __("Features &amp; More","premiumpress"),
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;
	
	case "es": {
	
	$text = array(
		"1_intro" 		=> __("About","premiumpress"),
		"2_location" 	=> __("Location &amp; Availability","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> __("Reviews","premiumpress"),
		"6_author" 		=> "&nbsp;",
	);
 
	} break;
	
	case "ct": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Seller","premiumpress"),
	);
 
	} break;
	
	case "jb": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Employer","premiumpress"),
	);
 
	} break;
	
	case "rt": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Agent","premiumpress"),
	);
 
	} break;
 
	case "dl": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Seller","premiumpress"),
	);
 
	} break;
	
	case "at": {
	
	$text = array(
		"1_intro" 		=> __("Description","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> __("Seller","premiumpress"),
	);
 
	} break;
	
	case "da": {
	
	$text = array(
		"1_intro" 		=> __("About Me","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> "",	
		"5_reviews" 	=> "",
		"6_author" 		=> "",
	);
 
	} break; 
	
	case "mj": {	
	
	$text = array(
		"1_intro" 		=> __("About","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> __("Details","premiumpress"),
		"4_services" 	=> __("FAQ","premiumpress"),	
		"6_author" 		=> __("Seller","premiumpress"),	
		"5_reviews" 	=> __("User Reviews","premiumpress"),
		
	);
 
	} break;
	
	case "sp": {	
	
	$text = array(
		"1_intro" 		=> __("About","premiumpress"),
		"2_location" 	=> "",
		"3_features" 	=> "",
		"4_services" 	=> "",	
		"6_author" 		=> "",	
		"5_reviews" 	=> "",
		
	);
 
	} break;
	
	case "dt":	
	default: {	
	
	$text = array(
		"1_intro" 		=> __("About","premiumpress"),
		"2_location" 	=> __("Location","premiumpress"),
		"3_features" 	=> __("Amenities and More","premiumpress"),
		"4_services" 	=> __("Services","premiumpress"),		
		"5_reviews" 	=> __("User Reviews","premiumpress"),
		"6_author" 		=> "",
	);
 
	} break;
} 

return $text;

}

// USED TO REORDER MEMBERSHIP ITEMS BY ORDER
function compare_order($a, $b){

	return strnatcmp($a['order'], $b['order']);
					
} 



function _get_country_search_box(){

global $wpdb;

//CITY OR COUNTRY?

 

if(_ppt(array('search','filters_citylist')) == 1){
$mapv = "map-city";
$ct = "city";
}else{
$mapv = "map-country";
$ct = "country";
}

 


 $SQL = "SELECT DISTINCT a.meta_value FROM ".$wpdb->postmeta." AS a 
 INNER JOIN ".$wpdb->postmeta." AS t ON ( a.meta_key = '".$mapv."' AND t.post_id = a.post_id ) 
 INNER JOIN ".$wpdb->posts." AS f ON ( t.post_id = f.ID AND f.post_status = 'publish') 
 LIMIT 60";
 
				$results = $wpdb->get_results($SQL); 
				 				 
				$in_array = array(); $statesArray = array();
				?>
                 <select class=" form-control"  id="filter-<?php echo $ct; ?>"  name="<?php echo $ct; ?>">
       				<option value=""><?php echo __("Any Location","premiumpress"); ?></option>
				<?php	
					foreach ($results as $val){			
						
						$state = $val->meta_value;						
						if( !in_array($state,$in_array)){						
							
							// ADD TO ARRAY
							$in_array[] = $state;
							$statesArray[] .= $state;
						}// if in array					
					} // end while	
					
					// NOW RE-ORDER AND DISPLAY
					asort($statesArray);
					foreach($statesArray as $state){ 
							if(strlen($state) < 2){ continue; }
							
							
							$name = $state;
							if(isset($GLOBALS['core_country_list'][$state])){
							$name = $GLOBALS['core_country_list'][$state];
							}
							echo "<option value='".$state."'>". $name."</option>";
							
					}  
	 
	  
		  ?>
        
        </select> <?php
 
}

function _ppt_meta_title(){ global $post;

	// WEBSITE TITLE
	ob_start();
	wp_title(); 
	$site_title 	= ob_get_clean(); 
	$custom_title 	= "";
	 
	
	// CHECK FOR PAGE KEY
	$pagekey = _ppt_pagekey(); 
	
	if(strlen($pagekey) > 1){
		
		// GET TITLE		
		if(is_page() && strlen(_ppt(array('seo', $pagekey.'_title'))) > 1){ // PAGES
		
			$custom_title = _ppt_meta_filter(_ppt(array('seo', $pagekey.'_title')), $pagekey);	
		  
		}elseif(isset($GLOBALS['flag-taxonomy-id']) && _ppt( array('seo',$GLOBALS['flag-taxonomy-id'].'_title')) != ""){
		
			$custom_title = _ppt( array('seo',$GLOBALS['flag-taxonomy-id'].'_title'));
				
		}elseif(strlen(_ppt(array('seo', $pagekey.'_title'))) > 1){
		
			$custom_title = _ppt_meta_filter(_ppt(array('seo', $pagekey.'_title')), $pagekey);
			 
		}
		
		// CUSTOM TITLE
		if( strlen($custom_title) > 1){	 // && _ppt(array('seo', $pagekey.'_force')) == 1		
			$site_title = $custom_title;	
		}
		 
	
	}
	
	
	
	// CHECK FOR PAGE TEMPLATE
	if($site_title == "" && is_page_template() && _ppt(array('seo', 'pages_force')) == 1 ){
			
			$g = get_post_meta($post->ID,'_wp_page_template',true);	  
			$gb = explode("/",$g);
			if(isset($gb[1])){
				
				$newpagekey = str_replace("tpl-","",$gb[1]);
				$newpagekey = str_replace("page-","",$newpagekey);
				$newpagekey = str_replace(".php","",$newpagekey); 
								
				 
				if( strlen(_ppt(array('seo', 'page_'.$newpagekey.'_title'))) > 1){ // PAGES
		
					$site_title = _ppt_meta_filter(_ppt(array('seo', 'page_'.$newpagekey.'_title')), "pages");
					
				}elseif(strlen(_ppt(array('seo', 'pages_title'))) > 1){ // PAGES
		 
					$site_title = _ppt_meta_filter(_ppt(array('seo', 'pages_title')), "pages");
					 
		  		}
			 
			}
			 
	} 
	
	
	
	// FALLBACK
	if($site_title == ""){
	$site_title = get_option("blogname");
	}
	 
	// RETURN
	return $site_title;

}

function _ppt_meta_description(){


	$site_desc = "";
	$custom_desc = "";
	
	// CHECK FOR PAGE KEY
	$pagekey = _ppt_pagekey();
	 
	 
	if(strlen($pagekey) > 1){
		
		// GET DESC	
		if(is_page() && strlen(_ppt(array('seo', $pagekey.'_desc'))) > 1){ // PAGES
		
			$custom_desc = _ppt_meta_filter(_ppt(array('seo', $pagekey.'_desc')), $pagekey);	
		  
		}elseif(isset($GLOBALS['flag-taxonomy-id']) && _ppt( array('seo',$GLOBALS['flag-taxonomy-id'].'_desc')) != ""){
		
			$custom_desc = _ppt( array('seo',$GLOBALS['flag-taxonomy-id'].'_desc'));
				
		}elseif(strlen(_ppt(array('seo', $pagekey.'_desc'))) > 1){
		
			$custom_desc = _ppt_meta_filter(_ppt(array('seo', $pagekey.'_desc')), $pagekey);
		}
		
		// CUSTOM TITLE
		if( strlen($custom_desc) > 1 && _ppt(array('seo', $pagekey.'_force')) == 1){			
			$site_desc = $custom_desc;	
		}
	
	}
	 
	// CHECK FOR PAGE TEMPLATE
	if(is_page_template() && _ppt(array('seo', 'pages_force')) == 1 ){
			
			$g = get_post_meta($post->ID,'_wp_page_template',true);	  
			$gb = explode("/",$g);
			if(isset($gb[1])){
				
				$newpagekey = str_replace("tpl-","",$gb[1]);
				$newpagekey = str_replace("page-","",$newpagekey);
				$newpagekey = str_replace(".php","",$newpagekey); 
								
				 
				if( strlen(_ppt(array('seo', 'page_'.$newpagekey.'_desc'))) > 1){ // PAGES
		
					$site_desc = _ppt_meta_filter(_ppt(array('seo', 'page_'.$newpagekey.'_desc')), "pages");
					
				}elseif(strlen(_ppt(array('seo', 'pages_desc'))) > 1){ // PAGES
		 
					$site_desc = _ppt_meta_filter(_ppt(array('seo', 'pages_desc')), "pages");
					 
		  		}
			 
			}
			 
	} 
	
	
	// FACEBOOK IMAGES ADDON
	$out = '';
	if($pagekey == "home" && strlen(_ppt(array('ogdata', 'image'))) > 2 ){
	
		echo '<meta property="og:url" content="'.home_url().'" />
			<meta property="og:type" content="webpage" />
			<meta property="og:title" content="'._ppt(array('ogdata', 'title')).'" />
			<meta property="og:description" content="'._ppt(array('ogdata', 'desc')).'" />
			<meta property="og:image" content="'._ppt(array('ogdata', 'image')).'" />
			<meta property="og:image:width" content="700" />
			<meta property="og:image:height" content="700" />';
	
	}	
	
	if(strlen($custom_desc) > 1){
	return '<meta name="description" content="'.$custom_desc.'">';
 	}
	
	return "";

}

function _ppt_meta_keywords(){

	// CHECK FOR PAGE KEY
	$pagekey = _ppt_pagekey();
	$custom_desc = "";
	
	if(strlen($pagekey) > 1){
	
		// GET DESCRIPTION
		if(strlen(_ppt(array('seo', $pagekey.'_keywords'))) > 2){
			$custom_desc = _ppt(array('seo', $pagekey.'_keywords'));
		}
	
	}
	
	if(strlen($custom_desc) > 1){
	return '<meta name="keywords" content="'.$custom_desc.'">';
 	}
	
	return "";

}

function _ppt_pagekey(){	
	
	foreach(_ppt_metapages() as $k => $page){

		if(isset($GLOBALS[$page['flag']])){
		
			return $k;
		}	
	}	
 	
	return "";
}

function _ppt_metapages(){

	$pages = array(
		
		"home"	=> array( 
			"name" 		=> "Home page", 
			"default" 	=> get_option("blogname"), 
			"order" 	=> 1, 
			"tags" 		=> array(),
			"flag" 		=> "flag-home"
		),
		 
		
		"category" => array( 
			"name" 		=> "Category page", 
			"default" 	=> "Categories &raquo; [CAT-NAME]", 
			"order" 	=> 2, 
			"tags" 		=> array("cat-name"),
			"flag" 		=> "flag-tax-listing",
		),
		
		"store" => array( 
			"name" 		=> "Store page", 
			"default" 	=> "[STORE-NAME]", 
			"order" 	=> 2, 
			"tags" 		=> array("store-name"),
			"flag" 		=> "flag-tax-store", // load this after category
		),
				
		
		"taxonomy" => array( 
			"name" 		=> "Taxonomy pages", 
			"default" 	=> "[TAX-NAME]", 
			"order" 	=> 3, 
			"tags" 		=> array("tax-name"),
			"flag" 		=> "flag-taxonomy", // load this after category
		), 
				
		"search" => array( 
			"name" 		=> "Search page", 
			"default" 	=> "", 
			"order" 	=> 4, 
			"tags" 		=> array("keyword"),
			"flag" 		=> "flag-search",
			
		),
		
		"listing" => array( 
			"name" 		=> "Main listing page", 
			"default" 	=> "[TITLE] - [CATEGORY]", 
			"order" 	=> 5, 
			"tags" 		=> array("title","category"),
			"flag" 		=> "flag-singlepage",
			
		),
		
		
		"pages" => array( 
			"name" 		=> "Pages", 
			"default" 	=> "[TITLE]", 
			"order" 	=> 6, 
			"tags" 		=> array("title"),
			"flag" 		=> "flag-page",
			
		),
		
		
	);
	
	//
	if(defined('THEME_KEY') && THEME_KEY == "cp" ){
	
	}else{
	unset($pages['store']);
	}
	
	return $pages;

}

function _ppt_meta_filter($title, $pagekey){ global $post;

	foreach(_ppt_metapages() as $k => $page){

		if($k == $pagekey){
			
			foreach($page['tags'] as $t => $d){
				
				switch($k){
				
					case "pages": {
					  
						$title = str_replace("[TITLE]", get_the_title($post->ID), $title);						 
					
					} break;
				
					case "category": {
						
						// KEYWORD
						$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						
						//print_r($term->term_id);
						 
						$title = str_replace("[CAT-NAME]", $term->name, $title);
						 
					
					} break;
					
					case "store": { 
					
						// KEYWORD
						$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						 
						$title = str_replace("[STORE-NAME]", $term->name, $title);
						
					
					} break;
					
					case "taxonomy": {
					
					
						// KEYWORD
						$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						 
						$title = str_replace("[TAX-NAME]", $term->name, $title);
						
					
					} break;
				
					case "search": {
						
						// KEYWORD
						if(isset($_GET['s'])){
						$title = str_replace("[KEYWORD]", $_GET['s'], $title);
						}
					
					} break;
					
					case "listing": {
						
						// KEYWORD
						 
						$title = str_replace("[TITLE]", do_shortcode("[TITLE]"), $title);
						
						$title = str_replace("[CATEGORY]", do_shortcode("[CATEGORY link=0]"), $title);
						 
					
					} break;
					
				
				} // END SWITCH
			}		 
		}	
	}
	
	return $title;
}





function _ppt_livepreview(){
 
	if(isset($_GET['ppt_live_preview']) && isset($_GET['tid']) && $_GET['tid'] != "" && function_exists('current_user_can') && current_user_can('administrator') ){
	
		return 1;
	
	}
	return 0;
}
 
 
function _ppt_demopath(){	
	
	$path = DEMO_IMG_PATH.THEME_KEY;
		
	if(!defined('WLT_DEMOMODE')  && ( isset($_GET['loadpage']) || isset($_POST['loaddesign']) ) ){
		$path .= "/ELEMENTOR/";
	}	
	return $path;
}
function _ppt_custom_searchlist(){

	 
	$customlist = array(
			'' => __( 'Default Orderby', 'premiumpress' ),				
			'featured' => __( 'Featured Items', 'premiumpress' ),	
			'sponsored' => __( 'Sponsored Items', 'premiumpress' ),	
			
			'homepage' => __( 'Homepage Items', 'premiumpress' ),	
						
			'popular' => __( 'Popular Items', 'premiumpress' ),			
			'random' => __( 'Random Items', 'premiumpress' ),
			'new' => __( 'New Items', 'premiumpress' ), 
	);
	
	if(defined('THEME_KEY') && in_array(THEME_KEY, array("da","es")) ){	
		$customlist["men"] = __( 'Male Profiles', 'premiumpress' );
		$customlist["women"] = __( 'Female Profiles', 'premiumpress' );	
	}
	
	if(defined('THEME_KEY') &&  THEME_KEY == "at"){
		$customlist["endingsoon"] = __( 'Items Ending Soon', 'premiumpress' );
	}
	
	if(defined('THEME_KEY') &&  in_array(THEME_KEY, array("dt","cm"))){
		$customlist["rating"] = __( 'Rated Items', 'premiumpress' );
	}
	
	
	return $customlist;
}

function _ppt_pagelinking($key){ global $CORE;
 
 	 
	// CHECK FOR DEMO CONTENT
	// ELEMENTOR CONTENT
	if(isset($_SESSION['design_preview']) && strlen($_SESSION['design_preview']) ){
	
		$g = $CORE->LAYOUT("load_single_design", $_SESSION['design_preview']);
		
		if(isset($g['elementor']) && is_array($g['elementor'])  && isset($g['elementor'][$key])){
		 	
			$preview_name = $key." - ".date('Y');			 		
			
			// CHECK FOR PAGE
			$exi = get_page_by_title( $preview_name , OBJECT, 'elementor_library') ;	 
		
			// CHECK EXISTS
			if ($exi && $exi->post_status == "publish") {
			
				$f = get_page_by_title( $preview_name , OBJECT, 'elementor_library');
				
				return "elementor-".$f->ID;			 
			
			// CREATE NEW ONE
			}else{	
			
				// DELETE CURRENT PAGE
				if($exi){
					wp_delete_post($exi->ID, true);
				}
			
				$elementor_file = $g['elementor'][$key];	
			 
				if(!file_exists($elementor_file)){ unset($_SESSION['design_preview']); die("preview file not found"); }
				 
				// PROCESS IT 
				$elementor_importer = new PremiumPress_Elementor_Importer();
				$id = $elementor_importer->import_elementor_file( $elementor_file, $key." - ".date('Y') );
			 
				
				if( !is_wp_error( $id ) ) {	
				
					return "elementor-".$id;				 			 		
				
				}else{				
					die($id->get_error_message());			
				}					
					
			}
						
		}		
	
	}
	
	// CURRENT LANG
	$cl = strtolower($CORE->_language_current());
	$check = "";
	
	// CHECK MOBILE
	if( $CORE->isMobileDevice() ){  	
	 
	 	// CHECK FOR MOBILE PAGE
		$checkKey 		= $key.'_mobile_'.$cl;
 		$check 			= _ppt(array('pageassign', $checkKey ));
		if($check == ""){		
			$checkKey 	= $key."_mobile";
			$check 		= _ppt(array('pageassign', $key."_mobile" ));
		} 		  
	
	}
	
	if($key != "" && in_array($check, array("","0")) ){
	
	 	// CHECK FOR PAGE
		$checkKey 		= $key.'_'.$cl;
 		$check 			= _ppt(array('pageassign', $checkKey ));
		
		 
		if($check == ""){	
		$checkKey 		= $key.'_'.$cl.'_'.$cl;
 		$check 			= _ppt(array('pageassign', $checkKey ));
		
		}
		
		if($check == ""){		
			$checkKey 	= $key;
			$check 		= _ppt(array('pageassign', $key ));
		}
		
		
		
	//echo $key."".$cl."<--".$check."<br>";
	
			
	}
 	
	if($check != "" && !in_array($check, array("","0")) && !in_array($key, array("header","footer")) && !isset($_GET['reset']) && substr($check,0,5) == "page-"){
	 	
			$g = explode("-",$check);			
			$rpage = get_permalink($g[1]);
			
			if(strlen($rpage) > 5){	
				header("location:".$rpage."");
				exit();
			}
			
	}
	
	if( $check != "" && !in_array($check, array("","0")) ){
 		
			// CHECK FOR ELEMENETOR
			$CORE->_elementor_scripts($checkKey);
					
			// RETURN
			return $check;		
	}
	
	return "";

}
 
 
function _ppt_custom_text($text, $matchkey = false){

	$captions = array(
		"condition" 	=> __("Condition","premiumpress"),
		"make" 			=> __("Make","premiumpress"),
		"model" 		=> __("Model","premiumpress"),
		
		"level" 		=> __("Difficulty Level","premiumpress"),
		
		"color" 		=> __("Color","premiumpress"),
		"size" 			=> __("Size","premiumpress"),
		"brand" 		=> __("Brand","premiumpress"),
		
		"body" 			=> __("Body","premiumpress"),
		"fuel" 			=> __("Fuel","premiumpress"),
		"transmission" 	=> __("Transmission","premiumpress"),
		"exterior" 		=> __("Exterior","premiumpress"),
		"interior" 		=> __("Interior","premiumpress"),
		"doors" 		=> __("Door","premiumpress"),
		"seller" 		=> __("Seller","premiumpress"),
		"features" 		=> __("Features","premiumpress"),
		"engine" 		=> __("Engine","premiumpress"),
		"drive" 		=> __("Drive","premiumpress"),
		"owners" 		=> __("Owners","premiumpress"),
		
		"ctype"			=> __("Type","premiumpress"),
		"jobtype"		=> __("Type","premiumpress"),
		
		"dagender" 		=> __("Gender","premiumpress"),
		"daseeking"		=> __("Seeking","premiumpress"),
		"dasexuality"	=> __("Sexuality","premiumpress"),
		"dathnicity"	=> __("Ethnicity","premiumpress"),
		"daeyes"		=> __("Eyes Color","premiumpress"),
		"dahair"		=> __("Hair Color","premiumpress"),
		"dabody"		=> __("Body","premiumpress"),
		"dasmoke"		=> __("Smoking","premiumpress"),
		"dadrink"		=> __("Drinking","premiumpress"),
		"dastarsign"	=> __("Star Sign","premiumpress"),
		
		
		"cameratype" 	=> __("Camera","premiumpress"),
		"license" 		=> __("License","premiumpress"),
		"orientation" 	=> __("Orientation","premiumpress"),
	 
	);
	
	if($matchkey){
		
		if(array_key_exists($text,$captions)){
		return true;
		}else{
		return false;
		}
	}
 	
	if(isset($captions[$text])){
		return $captions[$text];
	}
	return "";

}
 
function menuaddondata(){ 
return ""; // REMOVED 9.4.4
}


function _ppt_template($n, $n1 = ''){
	
	if(defined('DEBUG_SPEED')){ $GLOBALS['ppt_time_inner'] = microtime(true); }
	
	get_template_part($n, $n1);
	
	if(defined('DEBUG_SPEED')){	$time = round(microtime(true) -  $GLOBALS['ppt_time_inner'],2);	if($time > 0){ echo "-- $n-$n1.php took ".$time."  seconds <br>"; }	}
	
}



function google_validate_recaptcha(){
 
 		 
		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
            'body' => array(
                'secret'   =>  stripslashes(_ppt(array('captcha','secretkey'))),
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        ) );
	 	
		if (!is_wp_error($response) && ($response['response']['code'] == 200)){
		
			$response_body = json_decode( $response['body'] );
			
			if ( empty( $response_body->success ) || ! $response_body->success ) {
				return false;
			}
			
			return true;
		
		}else{
			return false;
		}
}
 
/*
	this function will stop wordpress showing 404 pages
*/
function _ppt_check_pagetemplate_request($c){
 
return $c;
}
add_filter( 'template_include',  '_ppt_check_pagetemplate_request'  );

function _ppt_checkfile($filename){

	return false;// ERRORS IN DEMO - NEEDS MORE TESTING
	
}
function _ppt_theme_part($c){ global $post;
 
	// MUST BE IN TWO PARTS
	// 1. PATHS / 2. NAME //3. FORCE ($c[2]
 
	if(defined('THEME_FOLDER') ){		
		// CHECK IF CHILD THEME HAS THIS FILE
		// OTHERWISE LET THEME USE DEFAULT		
		if(defined('CHILD_THEME_NAME') && file_exists(get_stylesheet_directory()."/".$c[0]."-".$c[1].".php") ){
			return $c[0];	
		}else{ 
			 
			return constant('THEME_FOLDER')."/".$c[0];
		}
	}
	return $c[0];
}
/*
	this function returns the folder path
	for the correct file, fallback to theme
	default is no child theme variation found
*/
function _ppt_theme_folder($c, $force = false){ global $post;
 
	// MUST BE IN TWO PARTS
	// 1. PATHS / 2. NAME //3. FORCE ($c[2]	 	 	
	if( ( !is_array($c)  || ( isset($post->post_type) && $post->post_type != "listing_type" ) ) && !isset($c[2]) ){ return $c[0]; }
	
 
	if(defined('THEME_FOLDER') ){		
		// CHECK IF CHILD THEME HAS THIS FILE
		// OTHERWISE LET THEME USE DEFAULT	
		 
		if(defined('WLT_DEMOMODE') && isset($GLOBALS['childtemplate']) && file_exists(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/".$c[0]."-".$c[1].".php") ){
		
		return $c[0];	
 
		}elseif(defined('CHILD_THEME_NAME') && file_exists(get_stylesheet_directory()."/".$c[0]."-".$c[1].".php") ){
		
			return $c[0];	
		
		}elseif(file_exists(THEME_PATH."/templates/".$c[0]."-".$c[1].".php") ){ // CHECK OUR PARTS FOLDER
 
			return "templates/".$c[0];			
		
		}elseif(file_exists(THEME_PATH.constant('THEME_FOLDER')."/template/".$c[0]."-".$c[1].".php") ){ 
		 
			return constant('THEME_FOLDER')."/template/".$c[0];
			
		}else{ 
			 
			return constant('THEME_FOLDER')."/".$c[0];
		}
	}
	return $c[0];
}
function _ppt($a){
   
	$core_data = get_option("core_admin_values");	
	 
	// HOMEPAGE DESIGN CHANGER
	
	if(
	
	( defined('WLT_DEMOMODE') || ( function_exists('wp_get_current_user') && function_exists('current_user_can')  && current_user_can('administrator') ) ) &&
	
	isset($GLOBALS['CORE_THEME']) && 
	
	( isset($_GET['design']) || isset($_SESSION['design_preview']) ) ){
	
		$core_data = $GLOBALS['CORE_THEME']; 
	
	}
	 
	
	if(is_array($a)){
 	
		if( isset($core_data[$a[0]][$a[1]]) ){
		 	
			if(is_string($core_data[$a[0]][$a[1]])){						
				return stripslashes($core_data[$a[0]][$a[1]]);				
			}else{
				return $core_data[$a[0]][$a[1]];
			}
					
		}else{		
			return "";		
		}
	
	}else{
 
 
		// DEMO EXTRAS
		if(isset($core_data[$a]) ){
		 
			if(is_string($core_data[$a])){							
				return stripslashes($core_data[$a]);
			}else{
				return $core_data[$a];
			}
			
		}else{		
			return "";		
		}	
	}
		 
}
/*
	this function is used throughout
	plugins and core for adding
	term values to existing taxonomies
*/
function _ppt_term_add($name, $tax, $parent = 0){
	
	// VALIUDATE
	if($name == ""){ return false; }
	
	// REGISTER IF DOESNT EXIST
	if(!taxonomy_exists($tax)){
	register_taxonomy( $tax, 'listing_type', array( 'hierarchical' => true, 'labels' =>'', 'query_var' => true, 'rewrite' => true ) ); 
	}
	
	if ( term_exists( $name , $tax ) ){	
	
			$term = get_term_by('slug', $name, $tax );		 
			$nparent  = $term->term_id;
			$saved_cats_array[] = $term->term_id;
				
	}else{
		
		$cat_id = wp_insert_term($name, $tax, array('cat_name' => $name, 'parent' => $parent ));
	 	 
		if(!is_object($cat_id) && isset($cat_id['term_id'])){
		
			$saved_cats_array[] = $cat_id['term_id'];
			$nparent = $cat_id['term_id'];
			
		}else{
		
			$nparent = $cat_id->term_id;
			
		}	 // end if	
		 
	} 
	
	return $nparent;

}


 
		 
/* =============================================================================
[FRAMEWORK] CORE FUNCTIONS
========================================================================== */

class framework_functions { 

function _ppt_filter_link($link){

	$link = str_replace( "[link-contact]", _ppt(array('links','contact')), $link );
	$link = str_replace( "[link-add]", _ppt(array('links','add')), $link );
	$link = str_replace( "[link-stores]", _ppt(array('links','stores')), $link );
	$link = str_replace( "[link-categories]", _ppt(array('links','categories')), $link );
	$link = str_replace( "[link-search]", home_url()."/?s=", $link );
	$link = str_replace( "[link-login]", wp_login_url(), $link );
	$link = str_replace( "[link-join]", wp_registration_url(), $link );
	$link = str_replace( "[link-register]", wp_registration_url(), $link );
	$link = str_replace( "[link-membership]", _ppt(array('links','memberships')), $link );
	
	return $link;
}


function FUNC($action='add', $order_data = ""){

global $userdata, $wpdb, $CORE;
 
	switch($action){
	
		case "demo_title": {
		 
		
			switch(THEME_KEY){
			
				case "cp": {
				
					$randomeTitle = array(
						1 => "20% Off With in-store pick-pp", 
						2 => "Free Shipping with this coupon code", 
						3 => "50% when you shop in store today",
						4 => "Buy Obe get One Free Between 3pm and 6pm.",
						5 => "Save 35% on purchased over $50",
						6 => "Enjoy Free Shipping on orders over $100",
						7 => "Buy Now Deliver Tomorrow with this coupon code.",
						8 => "Up to 15% Off When You Join Newsletter",
						9 => "Up to 33% Off Selected Bikes",
						10 => "30% Off When you buy Two",
						11 => "Up to 33% Off Selected Items",
						12 => "Up to $20 Off Summer Items", 
						13 => "20% Off With in-store pick-pp", 
						14 => "Free Shipping with this coupon code", 
						15 => "50% when you shop today",
						16 => "Buy One get One Free Between 3pm and 6pm.",
						17 => "Save 35% on purchased over $50",
						18 => "Enjoy Free Shipping on orders over $100",
						19 => "Buy Now Deliver Tomorrow with this coupon code.",
						20 => "Up to 15% Off Selected Items",
						21 => "Up to 33% Off Selected Items",
					); 
				
				
				} break;
				
				case "mj": {
			
				
				
				} break;
				
				
				default: {
				
				
				} break;
			
			} 
		
			if(isset($randomeTitle)){
			return $randomeTitle[$order_data];
			}else{
			return "Example Listing ".$order_data;
			}
			
		
		} break; 
	
		case "update_core":{
		
		// EXAMPLE		
		// array('design','color_primary'),  $s['color_primary'])
		
		if(is_array($order_data) && isset($order_data[0][0]) ){
		
			$existing_values = get_option("core_admin_values");			
			if(isset($order_data[0][1]) &&	$order_data[0][1] != ""){				
				$existing_values[$order_data[0][0]][$order_data[0][1]] = $order_data[1];	
			}				  
			update_option( "core_admin_values", $existing_values);			 
		
		}
		
		
		
		} break;
 
		case "format_logtype": {
		
		
			$type 		= get_post_meta($order_data,"log_type",true);			
			$log_to 	= get_post_meta($order_data,"log_to",true);		
			$log_from 	= get_post_meta($order_data,"log_from",true);
			if($log_from == ""){
			$log_from = $log_to;
			}
			$userid 	= $log_to;
		
			$l = $CORE->FUNC("get_logtype", array());
			 
			if(!isset($l[$type])){ return; }
			
			//die(print_r($l[$type]));
			
			$name = $type;
			$desc = "";
			$icon = "fal fa-info-circle"; 
			
			// ICON
			if(isset($l[$type]['icon']) ){
				$icon = $l[$type]['icon'];
			}
			
			// LINK
			$link = "";
			if(isset($l[$type]['link']) ){
				$link = $l[$type]['link'];				
			}
			
			// DATE & TIME
			$date = get_the_date("Y-m-d H:i:s", $order_data);
			$vv = $CORE->date_timediff($date);
			$time = $vv['string-small'];
			if($time == ""){ $time = "1s"; }
			
			// MESSAGE FROM 
			$name_from = $l[$type]["name"];
			$desc_from = $l[$type]["desc_from"];
			
			// MESSAGE TO
			$name_to = $l[$type]["name"];
			$desc_to = $l[$type]["desc_to"];
		
			
			return array(
			
				"log_id"		=> $order_data,  
				"log_type" 		=> $type,
				"icon" 			=> $icon, 
				
				"user_from" 	=> $log_from, 
				"title_from" 	=> $name_from,
				"desc_from" 	=> $desc_from, 
				
				"user_to" 		=> $log_to, 
				"title_to" 		=> $name_to,
				"desc_to"		=> $desc_to,
				
				"date" 			=> $date, 
				"time" 			=> $time,  
				
				'userid' 	=> $userid,		
				  
			);
		
		
		} break;
	
		case "get_logtype": {
		 
				$types = array( );
				
				// MERGED CLEANED LIST
				 
				$types = notify_list();
				
				 
				if(_ppt(array('user', 'friends')) == "1"){
				
				}else{
				unset($types['friend_listing_update']['email']);
				}
				
				// CLEAN UP				
				if(_ppt(array('escrow', 'enable_escrow')) == "1"){
				
				}elseif( defined('THEME_KEY') && THEME_KEY != "mj"){				
					unset($types['mj_credit_added']['email']);
				}
				
				
				if(defined('THEME_KEY') && THEME_KEY != "at"){				
					unset($types['at_auction_ended']['email']);
				}
				
				if(defined('THEME_KEY') && in_array(THEME_KEY, array("sp","at")) ){	
					unset($types['listing_expired']['email']);
				} 
				
				// IF NOT OFFER SYSTEM REMOVE EMAILS
				if( $CORE->LAYOUT("captions","offers")  == ""){
				
					unset($types['offer_complete']['email']);					
					unset($types['offer_updated']['email']);
					unset($types['offer_rejected']['email']);
					unset($types['offer_accepted']['email']);
					unset($types['offer_new']['email']);
					unset($types['feedback_receieved']['email']);
				}
				
				// MEMBERSHIPS
				if( !$CORE->LAYOUT("captions","memberships") ){
				 	unset($types['membership_expired']['email']);
				}
				 
				
				// TEXT CHANGES				
				if(defined('THEME_KEY') && THEME_KEY == "rt"){
					
		 	 
					
					// EMAILS
					$types["offer_new"]["email"]["subject"] =  "New Property Viewing Request";
					$types["offer_new"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - (from_username) has just requested a home viewing for your listed property.<br><br>Property Title: (post_name) <br><br>Please login to your account to update the applicate and schedule an viewing date.";
					
					$types["offer_accepted"]["email"]["subject"] =  "Viewing Request Accepted";
					$types["offer_accepted"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - your property viewing request has been accepted by the seller/agent.<br><br>Property Title: (post_name) <br><br>You can login to your account anytime to check for updates."; 
						
					$types["offer_rejected"]["email"]["subject"] =  "Property Viewing Request Rejected";
					$types["offer_rejected"]["email"]["body"] =  "Dear (username)<br><br>Unfortunately the seller has decided to decline a viewing request at this time.<br><br>Property Title: (post_name) <br><br>You can login to your account anytime to schedule a viewing on a different property.";
				
					$types["offer_updated"]["email"]["subject"] =  "Property Viewing Status Updated";
					$types["offer_updated"]["email"]["body"] =  "Dear (username)<br><br>The property viewing request for <strong>(post_name)</strong> has been updated.<br><br>Please login to your account to check for updates.";
									
			 
			 
				}elseif(defined('THEME_KEY') && THEME_KEY == "jb"){
					
	 
					
					// EMAILS
					$types["offer_new"]["email"]["subject"] =  "New Interview";
					$types["offer_new"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - (from_username) has just requested an interview for your work position.<br><br> Job Title: (post_name) <br><br>Please login to your account to update the applicate and schedule an interview date.";
					
					$types["offer_accepted"]["email"]["subject"] =  "Interview Request Accepted";
					$types["offer_accepted"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - your job interview has been accepted and is being updared by the employer.<br><br> Job Title: (post_name) <br><br>You can login to your account anytime to check for updates."; 
						
					$types["offer_rejected"]["email"]["subject"] =  "Interview Request Rejected";
					$types["offer_rejected"]["email"]["body"] =  "Dear (username)<br><br>Unfortunately the employeer has decided to decline an interview.<br><br> Job Title: (post_name) <br><br>You can login to your account anytime to apply for another job.";
				
					$types["offer_updated"]["email"]["subject"] =  "Interview Status Updated";
					$types["offer_updated"]["email"]["body"] =  "Dear (username)<br><br>The job interview request for <strong>(post_name)</strong> has been updated.<br><br>Please login to your account to check for updates.";
									
			 
			 
			 	}elseif(defined('THEME_KEY') && THEME_KEY == "ll"){
				 
					
					// EMAILS
					$types["offer_new"]["email"]["subject"] =  "New Application";
					$types["offer_new"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - (from_username) has just requested an Application for your work position.<br><br> Job Title: (post_name) <br><br>Please login to your account to update the applicate and schedule an Application date.";
					
					$types["offer_accepted"]["email"]["subject"] =  "Application Request Accepted";
					$types["offer_accepted"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - your job Application has been accepted and is being updared by the employer.<br><br> Job Title: (post_name) <br><br>You can login to your account anytime to check for updates."; 
						
					$types["offer_rejected"]["email"]["subject"] =  "Application Request Rejected";
					$types["offer_rejected"]["email"]["body"] =  "Dear (username)<br><br>Unfortunately the employeer has decided to decline an Application.<br><br> Job Title: (post_name) <br><br>You can login to your account anytime to apply for another job.";
				
					$types["offer_updated"]["email"]["subject"] =  "Application Status Updated";
					$types["offer_updated"]["email"]["body"] =  "Dear (username)<br><br>The job Application request for <strong>(post_name)</strong> has been updated.<br><br>Please login to your account to check for updates.";
					
			 
			 
			 }elseif(defined('THEME_KEY') && THEME_KEY == "mj"){
					
					 
					// EMAILS
					$types["offer_new"]["email"]["subject"] =  "New Job Purchased";
					$types["offer_new"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - (from_username) has just purchased your gig.<br><br> Item: (post_name) <br><br>Please login to your account to update the user and begin the order.";
					
					$types["offer_accepted"]["email"]["subject"] =  "Work has started.";
					$types["offer_accepted"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - your job has been accepted and is now being worked on.<br><br> Item: (post_name) <br><br>You can login to your account anytime and check the progress."; 
						
					$types["offer_rejected"]["email"]["subject"] =  "Job Rejected";
					$types["offer_rejected"]["email"]["body"] =  "Dear (username)<br><br>Unfortunately the seller has decided to decline this job. Payment for this job has been credted to your account.<br><br> Job Cancelled: (post_name) <br><br>You can login to your account anytime to purchase another job.";
				
					$types["offer_updated"]["email"]["subject"] =  "Job Status Updated";
					$types["offer_updated"]["email"]["body"] =  "Dear (username)<br><br>The job <strong>(post_name)</strong> has been updated.<br><br>Please login to your account to check for new feedback.";
				
					 
			 
				}elseif(defined('THEME_KEY') && THEME_KEY == "at"){
					
					// 1. new offer
					$types["offer_new"]["email"]["subject"] =  "New Bid Recieved";
					$types["offer_new"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - you've received a new bid on your item.<br><br> Item: (post_name) <br><br>You can login to your account and manage your items.";
					 
				 	// 2. offer accepted
				  	$types["offer_accepted"]["email"]["subject"] =  "Auction Winner - Congratulations!";
					$types["offer_accepted"]["email"]["body"] =  "Dear (username)<br><br>Congratulations - you've won an auction.<br><br> Item: (post_name) <br><br>You can login to your account and make payment asap.";
					 
					
					// 3. offer rejected
					$types["offer_rejected"]["email"]["subject"] =  "You've been outbid!";
					$types["offer_rejected"]["email"]["body"] =  "Dear (username)<br><br>You'be been outbid by (from_username)<br><br> Item: (post_name) <br><br>You can login to your account anytime to bid again.";
				   
					$types["offer_updated"]["email"]["subject"] =  "Item Status Updated";
					$types["offer_updated"]["email"]["body"] =  "Dear (username)<br><br>The auction item status has been updated.<br><br>Please login to your account to check for new buy/seller feedback.";
				  
				
				}
				 
				
				
				if(!is_array($order_data) && strlen($order_data) > 1 && isset($types[$order_data]) ){
					
					return $types[$order_data];
				}
				
				return $types;			
				
		
		
		} break;
	
		case "add_log": {		
	 		
				
			$data = "";
			if(isset($order_data['data']) && is_array($order_data['data'])){
			$data = $this->flatten($order_data['data']);
			}elseif(isset($order_data['data'])){
			$data = $order_data['data'];
			} 
			
					
				
			// IF THIS IS A PUBLIC LOG
			// LETS CHECK FOR DUPLICATES
			if(isset($order_data['public']) && $order_data['public'] == 1){			
			
				$args = array( 
				
					'post_type' 		=> 'ppt_logs',
					'posts_per_page' 	=>  4, // WE ONLY NEED 1
				
					'date_query' => array(
						'after'     => '1 minutes ago',
						'inclusive' => true
					), 			
						
					'meta_query' => array(
						 											 
							'log_to'    => array(      								
								'key' 			=> 'log_public',	
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 					 			
							),			 
							 		
					),					
				);
							
			 $found_logs = new WP_Query($args);
			 if(count($found_logs->posts) > 3){
			 return ;
			 }
			
			
			}		
			
			
			// SETUP NEW ORDER			
			$my_post = array();				
			$my_post['post_title'] 		= " ";
			$my_post['post_type'] 		= "ppt_logs"; 
			$my_post['post_status'] 	= "publish";
			$my_post['post_content'] 	= addslashes($data); 
			$logid = wp_insert_post( $my_post );
			 
			// LOG TYPE
			add_post_meta($logid, "log_type", $order_data['type']);
			
			// PUBLIC OR PRIVATE
			$types = notify_list();
			 
			if(isset($types[$order_data['type']]) && isset($types[$order_data['type']]["hide_from_user"])){
			add_post_meta($logid, "log_public", 0);
			}else{
			add_post_meta($logid, "log_public", 1);
			
				if(isset($types[$order_data['type']]) && isset($types[$order_data['type']]["hide_from_notifications"])){
				
				}else{
				  
					if(isset($order_data['to']) && is_numeric($order_data['to'])){
						
						add_post_meta($logid, "log_unread_".$order_data['to'], 1);
						
						if(isset($order_data['from']) && $order_data['from'] != ""){
						add_post_meta($logid, "log_unread_".$order_data['from'], 1);
						}
					
					}else{
					
						add_post_meta($logid, "log_unread_".$userdata->ID, 1);
					} 
					
				}
			 
			}
			
			// USER TO
			if(isset($order_data['to']) && is_numeric($order_data['to'])){
				$touser = $order_data['to'];
				add_post_meta($logid, "log_to", $order_data['to'] );			
			
			}elseif(isset($order_data['userid']) && is_numeric($order_data['userid'])){	
			
				$touser = $order_data['userid'];
				add_post_meta($logid, "log_to", $order_data['userid'] );
			
			}elseif($userdata->ID){		
				$touser = $userdata->ID;
				add_post_meta($logid, "log_to", $userdata->ID);			
			}
			
			// USER FROM
			if(isset($order_data['from']) && $order_data['from'] != ""){
				add_post_meta($logid, "log_from", $order_data['from']);
			}			
						
			// POST ID
			if(isset($order_data['postid']) && $order_data['postid'] != ""){
			add_post_meta($logid, "log_postid", $order_data['postid']);
			}
			
			// EXTRA(ORDER ID ETC)
			if(isset($order_data['extra']) && $order_data['extra'] != ""){
			add_post_meta($logid, "log_extra", $order_data['extra']);
			}
			
			if(isset($order_data['extra2']) && $order_data['extra2'] != ""){
			add_post_meta($logid, "log_extra2", $order_data['extra2']);
			}
			
			// EMAIL ID
			if(isset($order_data['emailid']) && $order_data['emailid'] != ""){
			add_post_meta($logid, "log_emailid", $order_data['emailid']);
			}
			
			// USER EMAIL
			if(isset($order_data['email']) && $order_data['email'] != ""){
			add_post_meta($logid, "log_email", $order_data['email']);
			}
			 
				
			
			$l = $CORE->FUNC("get_logtype",$order_data['type']);
			if(isset($l['email']) ){ 
			
			$data1 = array(); 
				 
				
				if(isset($order_data['alert_uid1']) && is_numeric($order_data['alert_uid1']) ){	
								
					$data1['username'] 		= $CORE->USER("username",$order_data['alert_uid1']);
					$data1['username'] 		= $CORE->USER("get_name",$order_data['alert_uid1']); 
					
				}elseif(isset($order_data['to']) && is_numeric($order_data['to']) ){					
					
					$data1['username'] 		= $CORE->USER("username",$order_data['to']);
					$data1['username'] 		= $CORE->USER("get_name",$order_data['to']);
										 
				}
				
				
				if(isset($order_data['alert_uid2']) && is_numeric($order_data['alert_uid2']) ){	
								
					$data1['from_username'] 		= $CORE->USER("username",$order_data['alert_uid2']);
					$data1['from_username'] 		= $CORE->USER("get_name",$order_data['alert_uid2']); 
					
				}elseif(isset($order_data['from']) && is_numeric($order_data['from']) ){
				
					$data1['from_username'] 		= $CORE->USER("get_username",$order_data['from']);
					
				}
				
				
				if(isset($order_data['postid']) && is_numeric($order_data['postid']) ){
					$data1['post_name'] 		= get_the_title($order_data['postid']);				
				}	
			 
				// CHECK FOR PASSED IN EMAIL DATA
				if( isset($order_data["email_data"]) && is_array($order_data["email_data"])){		
				
					foreach($order_data["email_data"] as $k => $d){						
						$data1[$k] = $d;					
					}				
				
				}
				 
				//die($touser."<--".print_r($order_data).print_r($data).print_r($data1));
				  
				
				$CORE->email_system($touser, $order_data['type'], $data1);
			
			}
			
			
			
		} break;
		

		
		
		
		
	}
}



	/*
		this function creates a new database entry
		for logging user events
	*/	
	function ADDLOG($message='',$userid='',$postid='',$link='label-success', $type = "", $data = ""){ global $wpdb, $CORE;	
	
		$this->FUNC("add_log",
			array(
				"message" 	=> $message,
				"type" 		=> $type,
				"postid" 	=> $postid,
				"userid" 	=> $userid,
			)
		);	 	
	
	}
	
	 
	/*
		This function gets the difference between dates
		returns in different formats
	*/
	function date_timediff($end_date, $start_date = '' ){ global $CORE;
	 	
			if($end_date == ""){ $end_date = date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " - 1 days") ); } // default is expired
			if($start_date == ""){ $start_date = current_time( 'mysql' ); } // default is now
			
			// REQUIRE DATE DIFF
			if(!function_exists('date_diff')){
				echo "This theme required PHP date_diff enabled. Please contact your hosting provider to enable it.";
				return;
			}
			 
			// MAKE SURE ITS A DATE STRING	
			$start_date = date( "Y-m-d H:i:s", strtotime( $start_date ) ); 	
			$end_date 	= date( "Y-m-d H:i:s", strtotime( $end_date ) ); 
			
			// EXPIRED
			$expired = 0;
			if( strtotime($end_date) <= strtotime(current_time( 'mysql' ))  ){	
				$expired = 1;
			}
			
			// GET DATE DIF PARTS
			$intervalo = date_diff(date_create($start_date), date_create($end_date));
			$dateArray = (array) $intervalo;
		 	 
			$string 		= "";
			$string_small 	= "";
			$expiredTime 	= "";
			$text = array();
			$text["y"] = array("b" => __("Year","premiumpress"), 	"p" => __("Years","premiumpress"), "s" => "y");
			$text["m"] = array("b" => __("Month","premiumpress"), 	"p" => __("Months","premiumpress"), "s" => "m");
			$text["d"] = array("b" => __("Day","premiumpress"), 	"p" => __("Days","premiumpress"), "s" => "d");
			$text["h"] = array("b" => __("Hour","premiumpress"), 	"p" => __("Hours","premiumpress"), "s" => "hr");
			$text["i"] = array("b" => __("Minute","premiumpress"), "p" => __("Minutes","premiumpress"), "s" => "m");			
			$text["s"] = array("b" => __("Second","premiumpress"), "p" => __("Seconds","premiumpress"), "s" => "s");
			
			foreach(array("y","m","d","h","i","s") as $k){
				if(isset($dateArray[$k])  && $dateArray[$k] > 0){
					
					$kk = "p";
					if($dateArray[$k] == 1){
					$kk = "b";
					}
					
					if(strlen($string) > 1){ 
					 
					
					}else{
					
					$string 		.= $dateArray[$k]." ".$text[$k][$kk];
					$string_small 	.= $dateArray[$k]."".$text[$k]['s'];
					}
					
					
				}
			
			} 
			
			// TIME LEFT TO PERCETAGE
			$completed = 0;
			$left = 0;
			$TimeToPercentage = 0;
			if(!$expired){
			
				$start 		= strtotime($start_date);
				$end 		= strtotime($end_date); 
				$current 	= strtotime(date( "Y-m-d H:i:s"));
				
				$completed = (($current - $start) / ($end - $start)) * 100;
			  	$completed = round($completed,2);
				$left = 100-$completed;
			
				
			}
			
			
			// WORK OUT DAYS LEFT			 
			$datediff = strtotime($end_date) - strtotime($start_date);			
			$daysleft  = round($datediff / (60 * 60 * 24));
			
			//ago text
			$et = "";
			if($expired){
			$et = " ".__("ago","premiumpress");
			}
					
			// RETURN STRING
			return array(
			"raw" 					=> $dateArray,
			"string-small" 			=> $string_small.$et, 
			"string" 				=> $string.$et, 
			"expired" 				=> $expired, 
			"expired-time" 			=> $string,
			"start" 				=> $start_date, 
			"end" 					=> $end_date,
			"percentage-left"		=> $left,
			"percentage-done"		=> $completed,
			"days-left" 			=> $daysleft,
			);
			
	}

 
 

	/* =============================================================================
		 DATE FORMATTING
		========================================================================== */
	
	function format_date($date){
	return mysql2date(get_option('date_format') . ' ' . get_option('time_format'),  $date, false);
	}
	
	/* =============================================================================
	  Time Difference (now and date entered) / V7 / 25th Feb 
	   ========================================================================== */

	function DATE($date){
		global $wpdb;
		if($date == "" || is_array($date) ){return; }	
			
		$date_format = get_option('date_format') . ' ' . get_option('time_format');		
		 
		return mysql2date($date_format,$date);
	}
	
		function DATEONLY($date){
		global $wpdb;
		if($date == "" || is_array($date) ){return; }	
			
		$date_format = get_option('date_format');		
		 
		return mysql2date($date_format,$date);
	}
	
function DATETIME($extratime = ""){
	 
		if($extratime !=""){
		return date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . $extratime) );
		}else{
		return date('Y-m-d H:i:s', strtotime(current_time( 'mysql' )) );
		}
		
	}
	
	/* =============================================================================
		GET CLIENT IP
		========================================================================== */
		
	function get_client_ip(){
			if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])){
				  return $_SERVER['HTTP_CLIENT_IP'];
			}
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				  return strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
			}
			if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])){
				  return $_SERVER['HTTP_PROXY_USER'];
			}
			if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
				  return $_SERVER['REMOTE_ADDR'];
			}else{
				  return "invalid";//"0.0.0.0";
			}
	}
	
/*
	this function sorts an array 
	by the required key
*/
function multisort($array, $sort_by) {
 
 		if(!is_array($array)){ return; }
		$estr = '';
		
		foreach ($array as $key => $value) {
			$estr = '';
			foreach ($sort_by as $sort_field) {
				if(isset($value[$sort_field])){
					$tmp[$sort_field][$key] = $value[$sort_field];	
					$estr .= '$tmp[\'' . $sort_field . '\'], ';
				}
			}
		}
		
		$estr .= '$array';
		$estr = 'array_multisort(' . $estr . ');';
		eval($estr);
	
		return $array;
}
function multisortkey($array, $skey, $svalue){

	if(!is_array($array)){ return; }
	foreach ($array as $key => $value) {
		if($svalue == $value[$skey]){
			return $key;
		} // end if
	}// end foreach
}

 
	
} 

?>