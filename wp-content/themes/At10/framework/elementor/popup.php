<?php

global $CORE, $CORE_UI, $userdata;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
?>

<style>
.templates_wrapper { max-width:900px; margin:auto; width:100%; background-color: #f1f3f5; }
.dialog-header {    padding: 0;    background-color: #fff; background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 65%, rgba(244,244,244,1) 100%);    -webkit-box-shadow: 0 0 8px rgb(0 0 0 / 10%);    box-shadow: 0 0 8px rgb(0 0 0 / 10%);  position: relative;    z-index: 1; height: 50px; }
 
.templates_wrapper .catid-kit img, .templates_wrapper .catid-undefined img { filter: none!important; }

.pptlogo { width:40px; height:40px; position:absolute; left:30px; top:5px; background: #2775d3; border-radius: 4px; }
.pptlogo > div { padding:5px; }
.pptlogo span {     background-image: url(https://premiumpressweb.b-cdn.net/premiumpress-logo-white.svg);    background-repeat: no-repeat;    background-size: contain;    background-position: 0px 0px;    width: 30px;    height: 40px;    display: block; }
 
/*
-------------------------------------
*/
.lined.nav-tabs {    border:none!important;}
.lined .nav-item {   }
.lined .nav-link {  border: none;  border-bottom: 0px solid transparent; height: 50px; line-height: 35px;    font-weight: 600;  border-radius: 0px; color: black; }
.lined .nav-link:hover {  border: none;  border-bottom: 0px solid transparent; }
.lined .nav-link.active {  background: none;  color: #fff; background: #2775d3; font-weight: 700!important;  }
.lined .badge { text-shadow: none; top: 14px;    right: 60px; position:absolute; }


/*
-------------------------------------
*/
.ppt-scroll  {  position: relative;  width: 100%;  overflow: auto;}
.ps{ position:relative; overflow:hidden!important;overflow-anchor:none;-ms-overflow-style:none;touch-action:auto;-ms-touch-action:auto}.ps__rail-x{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;height:15px;bottom:0;position:absolute}.ps__rail-y{display:none;opacity:0;transition:background-color .2s linear,opacity .2s linear;-webkit-transition:background-color .2s linear,opacity .2s linear;width:15px;right:0;position:absolute}.ps--active-x>.ps__rail-x,.ps--active-y>.ps__rail-y{display:block;background-color:transparent}.ps--focus>.ps__rail-x,.ps--focus>.ps__rail-y,.ps--scrolling-x>.ps__rail-x,.ps--scrolling-y>.ps__rail-y,.ps:hover>.ps__rail-x,.ps:hover>.ps__rail-y{opacity:.6}.ps .ps__rail-x.ps--clicking,.ps .ps__rail-x:focus,.ps .ps__rail-x:hover,.ps .ps__rail-y.ps--clicking,.ps .ps__rail-y:focus,.ps .ps__rail-y:hover{background-color:#eee;opacity:.9}.ps__thumb-x{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,height .2s ease-in-out;-webkit-transition:background-color .2s linear,height .2s ease-in-out;height:6px;bottom:2px;position:absolute}.ps__thumb-y{background-color:#aaa;border-radius:6px;transition:background-color .2s linear,width .2s ease-in-out;-webkit-transition:background-color .2s linear,width .2s ease-in-out;width:6px;right:2px;position:absolute}.ps__rail-x.ps--clicking .ps__thumb-x,.ps__rail-x:focus>.ps__thumb-x,.ps__rail-x:hover>.ps__thumb-x{background-color:#999;height:11px}.ps__rail-y.ps--clicking .ps__thumb-y,.ps__rail-y:focus>.ps__thumb-y,.ps__rail-y:hover>.ps__thumb-y{background-color:#999;width:11px}@supports (-ms-overflow-style:none){.ps{overflow:auto!important}}@media screen and (-ms-high-contrast:active),(-ms-high-contrast:none){.ps{overflow:auto!important}}

/*
-------------------------------------
*/

.templates_wrapper ._loading { display:none; }
.templates_wrapper._loading { margin-bottom:30px; }
.templates_wrapper._loading ._btns { display:none!important; }
.templates_wrapper._loading ._loading {     position: absolute;    top: 20%;    left: 40%; display: block!important; }
.templates_wrapper .bg-image-wrap { cursor:pointer; overflow:hidden; position:relative; border: 1px solid #ddd; box-shadow: 0 .125rem .25rem rgba(0,0,0,.035)!important; background: #fff;    padding: 10px;  }
.templates_wrapper ._title { font-size: 12px;    font-weight: 500;    margin: 8px 0px; }
.templates_wrapper ._btn { cursor:pointer; margin-top: 5px; }

.betatheme:not(.catid-listingpage, .catid-undefined) ._title { display:none; }
 
.betatheme:not(.catid-undefined) { margin-bottom:20px; }


#ppt_preview_cats .badge { position:absolute; top:2px; right:2px; display:none; }


._dectext { font-size:14px; opacity: 0.8; font-weight: 400;    margin-left: 20px; }

</style>


<input type="hidden" name="" id="template-tkey" value="<?php echo THEME_KEY; ?>" />
 

<div class="templates_wrapper">


<div class="dialog-header">

<div class="pptlogo"><div><span></span></div></div>

    <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
      <li class="nav-item flex-sm-fill">
        <a id="ppt-elementor-1tab" data-toggle="tab" href="#ppt-elementor1" role="tab" aria-controls="ppt-elementor1" aria-selected="true" class="nav-link active"><?php echo __("Sections","premiumpress"); ?></a>
      </li>
   
      <li class="nav-item flex-sm-fill">
        <a id="ppt-elementor-2tab" data-toggle="tab" href="#ppt-elementor2" role="tab" aria-controls="ppt-elementor2" aria-selected="false" class="nav-link"><?php echo __("Blocks","premiumpress"); ?></a>
      </li>
	
      <li class="nav-item flex-sm-fill">
        <a data-toggle="tab" href="#ppt-elementor3" id="ppt-elementor-3tab" role="tab" aria-controls="ppt-elementor3" aria-selected="false" class="nav-link"><?php echo __("Pages","premiumpress"); ?></a>
      </li>
    </ul>

</div>


<!-- SAVING SPINNER -->
<div class="ppt_preview_wait" style="display:none;">
<div class="py-3 my-4">
  <div class="text-center"><i class="fa fa-spinner fa-4x text-primary fa-spin"></i></div>
  <div class="mt-3 text-muted text-center">
    <?php echo __("Updating your page, please wait...","premiumpress"); ?>
  </div>
</div>
</div>

 <!-- dont remove -->
    <div class="ppt-block-insert" data-cat="0" data-bid="0"></div>
    <div class="ppt-template-insert" data-template="0"></div>    
 <!-- dont remove -->
 
<div id="myTab2Content" class="tab-content">    
   
    
<div id="ppt-elementor1" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade  show active pt-4 p-3">  

    <p class="_dectext"><?php echo __("Pre-made sections to help you build pages faster.","premiumpress"); ?></p>
   
          
    <div style="min-height:450px; max-height:500px;" class="ppt-scroll" id="theme_cats">
        <div class="container">
        
            <!-- CATEGORY VIEW -->
            <div id="ppt_preview_cats" class="row"><i class="fa fa-sync fa-spin"></i></div>
            
            <!-- BLOCKS VIEW -->
            <div id="ppt_preview_blocks" class="row"></div>
        
        </div> 
    </div> 
    
    <div class="mt-2 text-center" id="ppt_preview_goback" style="display:none;">
    <a href="#top" onclick="ppt_preview_goback();" data-ppt-btn class="btn-system"><?php echo __("Go Back","premiumpress"); ?></a>
    </div> 
       
      
</div>
<!------------------ --> 
<div id="ppt-elementor2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade pt-4 p-3">


	<p class="_dectext"><?php echo __("Un-styled blocks ideal for extending your designs.","premiumpress"); ?></p>
          
    <div style="min-height:450px; max-height:500px;" class="ppt-scroll" id="theme_blocks">    
        <div class="container">
            <div class="row">
            
            
        <?php
            
            // GET DATA
            $g = array();
			
			$g['listings1'] = array(
				"name" => "Row",
				"order" => 1, 
			);
			
			
			$g['listings2'] = array(
				"name" => "Block",
				"order" => 2, 
			);		
			
			$g['listings3'] = array(
				"name" => "Carousel",
				"order" => 3, 
			);		
		 
           	   
             ?>
            
            <?php foreach($g as $k => $g){  ?>
            <div class="col-md-4 mb-4">
                <div class="card p-1 border-0 shadow-sm"><a href="#top" onclick="ppt_insert_template('special-<?php echo $k; ?>', 0);"><img src="<?php echo $CORE->LAYOUT("get_block_prewview", $k  ); ?>" class="img-fluid lazy w-100" /></a> 
                <div class="small text-center py-1 pt-2 text-600"><?php echo $g['name']; ?></div> </div>
            </div>
            <?php }?>
            
             
            
			<?php
            
            /*
            $g = $CORE->LAYOUT("load_all_by_cat",  "block");
             $order = array_column($g, 'order'); 
             array_multisort( $order, SORT_ASC, $g);
			 
             ?>
            
            <?php foreach($g as $k => $g){  ?>
            <div class="col-md-4 mb-4">
                <div class="card p-1 border-0 shadow-sm"><a href="#top" onclick="ppt_insert_template('special-<?php echo $k; ?>', 0);"><img src="<?php echo $CORE->LAYOUT("get_block_prewview", $k  ); ?>" class="img-fluid lazy w-100" /></a> 
                <div class="small text-center py-1 pt-2 text-600"><?php echo $g['name']; ?></div> </div>
            </div>
            <?php } */ ?>
            </div>
        </div>
     </div>  

</div>
<!------------------ --> 
 
 
<div id="ppt-elementor3" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade pt-4 p-3">
 <?php /*
    <select onchange="showhideblocks(this.value);" id="catselect" class="mb-4 ml-3">
    	<option value="all">All</option>
    </select>
 */ ?>
 
 
 <p class="_dectext"><?php echo __("Pre-made pages to get you started.","premiumpress"); ?></p>


    <div style="min-height:450px; max-height:500px;" class="ppt-scroll1" id="theme_pages">    
        <div class="container">
            <div id="betathemes" class="row"></div>
            <div id="defaulthemes" class="row">
			<?php 
            function compare_lastname($a, $b){
            
                return strnatcmp($a['order'], $b['order']);
            
            } 
            $categories = $CORE->LAYOUT("get_demo_categories", array());
            foreach($categories[THEME_KEY] as $cid => $cat){ 
            $g = $CORE->LAYOUT("load_designs_by_theme", $cid); 
            usort($g, 'compare_lastname');  
            foreach($g as $key => $h){ 
            
             
            
            ?>
            <div class="col-md-4 betatheme catid-kit preloaded-kit-<?php echo $h['key'] ?>">
             
            <div class="bg-image-wrap" onclick="ppt_link_out('<?php echo home_url(); ?>/wp-admin/admin.php?page=design&loadpage=<?php echo $h['key'] ?>&full=1');">
               <span class="btn-dark color3 text-white"> <img src="<?php echo $h['image']; ?>" class="img-fluid lazy" alt="alt"></span>
               
            </div>   
            
             </div>
            <?php } ?>
            <?php } ?>
            </div>
        </div>
     </div>  
     
    
     
     
           
   <div class="mt-2 text-center" id="ppt_preview_goback1" style="display:none;"><hr />
        <a href="#top" onclick="load_ppt_templates(0, 0);" data-ppt-btn class="btn-system"><?php echo __("Go Back","premiumpress"); ?></a>
  </div>  
            
  
    
</div>
<!------------------ -->
 
 
 
 
    </div>
    <!-- End lined tabs -->
  </div>
 
<script>

var ajax_site_url = "<?php echo home_url(); ?>/index.php";  
 
var loaded = 0;
jQuery(document).ready(function(){ 

load_ppt_templates(0, 0);



});
function showhideblocks(blockid){

	jQuery(".betatheme").hide();
	
	if(blockid == "all"){	
		jQuery(".betatheme").show();
	}else{	
		jQuery(".catid-"+ blockid).show();
	}
}
function load_ppt_templates(themeid, catdid){

if(!loaded){

	// HIDE KIT WHEN VIEWED
	if(themeid == 0){	
		jQuery("#ppt_preview_goback1").hide();
		
		jQuery("#defaulthemes").show(); 
		
	}else{
		jQuery(".ppt-template-"+themeid).hide();
		jQuery("#ppt_preview_goback1").show();
		
		jQuery("#defaulthemes").hide(); 
		
	}
	
	
	

	jQuery.ajax({
			type: "POST",
		 	url: ajax_site_url,		
			data: {
				   elementor_action: "load_ppt_templates",
				   call: "get_templates",
				   template_id: themeid,
				   cat:  catdid
				  
				   
			   },
			   success: function(response) {
			   
					
			   		if(catdid != 0){
						
						taget_div = "#ppt_preview_blocks"; 
						jQuery('#ppt_preview_cats').hide(); 
						jQuery('#ppt_preview_goback').show(0);
   						jQuery('#ppt_preview_blocks').html('').show();
					
					}else{
						jQuery('#ppt_preview_cats').html('');
						taget_div = "#betathemes"; 
						jQuery("#betathemes").html(''); 
						
					}
					
					
					const container = document.querySelector(taget_div);
					container.scrollTop = 0;
			   		
			   		
			  
					 jQuery.each(response, function(k, v) {
							 	 
							
							if(k == "cats" && catdid == 0){ 
							
								jQuery.each(v, function(ck, cv) {	
							
									jQuery("#catselect").append(new Option(cv, ck) );
									
									
									jQuery("#ppt_preview_cats").append('<div class="col-md-4 mb-4"><a href="javascript:void(0);" onClick="ppt_elementor_blocks_category(\'' + ck +'\')"> <div class="bg-white rounded p-3 text-center position-relative"><span class="font-weight-bold text-dark"><i class="' + cv.icon +' mr-3"></i>' + cv.name +'<span class="badge badge-danger">' + cv.count +'</span></span></div></a></div><div></div>');
									
									
								
								});							
							
							}
							
							if(k == "data"){
							 	 
								jQuery.each(v, function(tk, tv) {
								
									if(tv.category == "kit"){
									
									var onclick = "load_ppt_templates('" + tk + "', 0);"; 
									var tt = "view";
								 
									}else{
									
									var  onclick = "ppt_insert_template('" + tk + "', 0);";
									var tt = "import";
								 
									}
									
									// HIDE ANY PRELOADED DATA
									jQuery(".preloaded-"+tk).hide();
									
									jQuery(taget_div).append('<div class="col-md-4 betatheme catid-' + tv.category + ' ppt-template-' + tk + '"><div><div class="bg-image-wrap" onclick="'+ onclick +'"><div class="_loading"><i class="fa fa-sync fa-spin text-dark fa-3x"></i></div><img src="' + tv.image + '" class="img-fluid lazy"></div><div class="_title">' + tv.name + '</div></div></div>');	
									 										
								
								}); // end loops themes
							
							}// end if
							
							
					});
					
					
				// CUSTOM BACKGROUNDS 
				//jQuery("img.lazy").myLazyLoad();
				 	
				
			   },
			   error: function(e) {
			   		console.log("error");
				    console.log(e)
			   }
	});

}

}
 

function ppt_link_out(linka){
 
	var win = window.open(  linka,  '_blank' );						
 
}
function ppt_preview_goback(){

jQuery('#ppt_preview_cats').show(); 
jQuery('#ppt_preview_blocks').hide();
jQuery('#ppt_preview_goback').hide();
			
}
 
function ppt_insert_template(tid){

	jQuery('._dectext').hide();

	jQuery(".ppt-template-insert").attr('data-template', tid);
	jQuery(".ppt-template-insert").trigger('click');
	
	jQuery(".ppt-scroll").hide();
	jQuery("#betathemes").hide();
	jQuery("#ppt-elementor2").hide();
	jQuery("#ppt-elementor3").hide();
	
	jQuery(".ppt_preview_wait").show();
	jQuery('#ppt_preview_goback').hide();
	
	// CLOSE WINDOW
	setTimeout(function(){	
		 
		jQuery(".ppt-modal-close").trigger("click"); 
													
	}, 2000);

}

function ppt_insert_values(bid, cat){
	
	jQuery(".ppt-block-insert").attr('data-bid', bid);
	jQuery(".ppt-block-insert").attr('data-cat', cat);
	jQuery(".ppt-block-insert").trigger('click');
	
	jQuery(".ppt-scroll").hide();
	jQuery(".ppt_preview_wait").show();
	jQuery('#ppt_preview_goback').hide();
	
	jQuery('._dectext').hide();
	
	
	// CLOSE WINDOW
	setTimeout(function(){	
																
		jQuery('body,html').animate({ scrollTop: 0	}, 800);
		
		jQuery(".ppt-modal-close").trigger("click"); 
													
	}, 8000); 
}

function ppt_elementor_blocks_category(catid){
	  
	  load_ppt_templates(0, catid);
	   
   
}
jQuery(document).ready(function(){ 

const qs = new PerfectScrollbar('#theme_cats');
const qs1 = new PerfectScrollbar('#theme_blocks');
const qs2 = new PerfectScrollbar('#theme_pages');

<?php if(isset($_GET['ppt_live_preview'])){ ?>
jQuery("body").addClass("bg-dark");
<?php } ?>

});
/* SCROLL */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.PerfectScrollbar=e()}(this,function(){"use strict";function t(t){return getComputedStyle(t)}function e(t,e){for(var i in e){var r=e[i];"number"==typeof r&&(r+="px"),t.style[i]=r}return t}function i(t){var e=document.createElement("div");return e.className=t,e}function r(t,e){if(!v)throw new Error("No element matching method supported");return v.call(t,e)}function l(t){t.remove?t.remove():t.parentNode&&t.parentNode.removeChild(t)}function n(t,e){return Array.prototype.filter.call(t.children,function(t){return r(t,e)})}function o(t,e){var i=t.element.classList,r=m.state.scrolling(e);i.contains(r)?clearTimeout(Y[e]):i.add(r)}function s(t,e){Y[e]=setTimeout(function(){return t.isAlive&&t.element.classList.remove(m.state.scrolling(e))},t.settings.scrollingThreshold)}function a(t,e){o(t,e),s(t,e)}function c(t){if("function"==typeof window.CustomEvent)return new CustomEvent(t);var e=document.createEvent("CustomEvent");return e.initCustomEvent(t,!1,!1,void 0),e}function h(t,e,i,r,l){var n=i[0],o=i[1],s=i[2],h=i[3],u=i[4],d=i[5];void 0===r&&(r=!0),void 0===l&&(l=!1);var f=t.element;t.reach[h]=null,f[s]<1&&(t.reach[h]="start"),f[s]>t[n]-t[o]-1&&(t.reach[h]="end"),e&&(f.dispatchEvent(c("ps-scroll-"+h)),e<0?f.dispatchEvent(c("ps-scroll-"+u)):e>0&&f.dispatchEvent(c("ps-scroll-"+d)),r&&a(t,h)),t.reach[h]&&(e||l)&&f.dispatchEvent(c("ps-"+h+"-reach-"+t.reach[h]))}function u(t){return parseInt(t,10)||0}function d(t){return r(t,"input,[contenteditable]")||r(t,"select,[contenteditable]")||r(t,"textarea,[contenteditable]")||r(t,"button,[contenteditable]")}function f(e){var i=t(e);return u(i.width)+u(i.paddingLeft)+u(i.paddingRight)+u(i.borderLeftWidth)+u(i.borderRightWidth)}function p(t,e){return t.settings.minScrollbarLength&&(e=Math.max(e,t.settings.minScrollbarLength)),t.settings.maxScrollbarLength&&(e=Math.min(e,t.settings.maxScrollbarLength)),e}function b(t,i){var r={width:i.railXWidth},l=Math.floor(t.scrollTop);i.isRtl?r.left=i.negativeScrollAdjustment+t.scrollLeft+i.containerWidth-i.contentWidth:r.left=t.scrollLeft,i.isScrollbarXUsingBottom?r.bottom=i.scrollbarXBottom-l:r.top=i.scrollbarXTop+l,e(i.scrollbarXRail,r);var n={top:l,height:i.railYHeight};i.isScrollbarYUsingRight?i.isRtl?n.right=i.contentWidth-(i.negativeScrollAdjustment+t.scrollLeft)-i.scrollbarYRight-i.scrollbarYOuterWidth:n.right=i.scrollbarYRight-t.scrollLeft:i.isRtl?n.left=i.negativeScrollAdjustment+t.scrollLeft+2*i.containerWidth-i.contentWidth-i.scrollbarYLeft-i.scrollbarYOuterWidth:n.left=i.scrollbarYLeft+t.scrollLeft,e(i.scrollbarYRail,n),e(i.scrollbarX,{left:i.scrollbarXLeft,width:i.scrollbarXWidth-i.railBorderXWidth}),e(i.scrollbarY,{top:i.scrollbarYTop,height:i.scrollbarYHeight-i.railBorderYWidth})}function g(t,e){function i(e){b[d]=g+Y*(e[a]-v),o(t,f),R(t),e.stopPropagation(),e.preventDefault()}function r(){s(t,f),t[p].classList.remove(m.state.clicking),t.event.unbind(t.ownerDocument,"mousemove",i)}var l=e[0],n=e[1],a=e[2],c=e[3],h=e[4],u=e[5],d=e[6],f=e[7],p=e[8],b=t.element,g=null,v=null,Y=null;t.event.bind(t[h],"mousedown",function(e){g=b[d],v=e[a],Y=(t[n]-t[l])/(t[c]-t[u]),t.event.bind(t.ownerDocument,"mousemove",i),t.event.once(t.ownerDocument,"mouseup",r),t[p].classList.add(m.state.clicking),e.stopPropagation(),e.preventDefault()})}var v="undefined"!=typeof Element&&(Element.prototype.matches||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector),m={main:"ps",element:{thumb:function(t){return"ps__thumb-"+t},rail:function(t){return"ps__rail-"+t},consuming:"ps__child--consume"},state:{focus:"ps--focus",clicking:"ps--clicking",active:function(t){return"ps--active-"+t},scrolling:function(t){return"ps--scrolling-"+t}}},Y={x:null,y:null},X=function(t){this.element=t,this.handlers={}},w={isEmpty:{configurable:!0}};X.prototype.bind=function(t,e){void 0===this.handlers[t]&&(this.handlers[t]=[]),this.handlers[t].push(e),this.element.addEventListener(t,e,!1)},X.prototype.unbind=function(t,e){var i=this;this.handlers[t]=this.handlers[t].filter(function(r){return!(!e||r===e)||(i.element.removeEventListener(t,r,!1),!1)})},X.prototype.unbindAll=function(){var t=this;for(var e in t.handlers)t.unbind(e)},w.isEmpty.get=function(){var t=this;return Object.keys(this.handlers).every(function(e){return 0===t.handlers[e].length})},Object.defineProperties(X.prototype,w);var y=function(){this.eventElements=[]};y.prototype.eventElement=function(t){var e=this.eventElements.filter(function(e){return e.element===t})[0];return e||(e=new X(t),this.eventElements.push(e)),e},y.prototype.bind=function(t,e,i){this.eventElement(t).bind(e,i)},y.prototype.unbind=function(t,e,i){var r=this.eventElement(t);r.unbind(e,i),r.isEmpty&&this.eventElements.splice(this.eventElements.indexOf(r),1)},y.prototype.unbindAll=function(){this.eventElements.forEach(function(t){return t.unbindAll()}),this.eventElements=[]},y.prototype.once=function(t,e,i){var r=this.eventElement(t),l=function(t){r.unbind(e,l),i(t)};r.bind(e,l)};var W=function(t,e,i,r,l){void 0===r&&(r=!0),void 0===l&&(l=!1);var n;if("top"===e)n=["contentHeight","containerHeight","scrollTop","y","up","down"];else{if("left"!==e)throw new Error("A proper axis should be provided");n=["contentWidth","containerWidth","scrollLeft","x","left","right"]}h(t,i,n,r,l)},L={isWebKit:"undefined"!=typeof document&&"WebkitAppearance"in document.documentElement.style,supportsTouch:"undefined"!=typeof window&&("ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch),supportsIePointer:"undefined"!=typeof navigator&&navigator.msMaxTouchPoints,isChrome:"undefined"!=typeof navigator&&/Chrome/i.test(navigator&&navigator.userAgent)},R=function(t){var e=t.element,i=Math.floor(e.scrollTop);t.containerWidth=e.clientWidth,t.containerHeight=e.clientHeight,t.contentWidth=e.scrollWidth,t.contentHeight=e.scrollHeight,e.contains(t.scrollbarXRail)||(n(e,m.element.rail("x")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarXRail)),e.contains(t.scrollbarYRail)||(n(e,m.element.rail("y")).forEach(function(t){return l(t)}),e.appendChild(t.scrollbarYRail)),!t.settings.suppressScrollX&&t.containerWidth+t.settings.scrollXMarginOffset<t.contentWidth?(t.scrollbarXActive=!0,t.railXWidth=t.containerWidth-t.railXMarginWidth,t.railXRatio=t.containerWidth/t.railXWidth,t.scrollbarXWidth=p(t,u(t.railXWidth*t.containerWidth/t.contentWidth)),t.scrollbarXLeft=u((t.negativeScrollAdjustment+e.scrollLeft)*(t.railXWidth-t.scrollbarXWidth)/(t.contentWidth-t.containerWidth))):t.scrollbarXActive=!1,!t.settings.suppressScrollY&&t.containerHeight+t.settings.scrollYMarginOffset<t.contentHeight?(t.scrollbarYActive=!0,t.railYHeight=t.containerHeight-t.railYMarginHeight,t.railYRatio=t.containerHeight/t.railYHeight,t.scrollbarYHeight=p(t,u(t.railYHeight*t.containerHeight/t.contentHeight)),t.scrollbarYTop=u(i*(t.railYHeight-t.scrollbarYHeight)/(t.contentHeight-t.containerHeight))):t.scrollbarYActive=!1,t.scrollbarXLeft>=t.railXWidth-t.scrollbarXWidth&&(t.scrollbarXLeft=t.railXWidth-t.scrollbarXWidth),t.scrollbarYTop>=t.railYHeight-t.scrollbarYHeight&&(t.scrollbarYTop=t.railYHeight-t.scrollbarYHeight),b(e,t),t.scrollbarXActive?e.classList.add(m.state.active("x")):(e.classList.remove(m.state.active("x")),t.scrollbarXWidth=0,t.scrollbarXLeft=0,e.scrollLeft=0),t.scrollbarYActive?e.classList.add(m.state.active("y")):(e.classList.remove(m.state.active("y")),t.scrollbarYHeight=0,t.scrollbarYTop=0,e.scrollTop=0)},T={"click-rail":function(t){t.event.bind(t.scrollbarY,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarYRail,"mousedown",function(e){var i=e.pageY-window.pageYOffset-t.scrollbarYRail.getBoundingClientRect().top>t.scrollbarYTop?1:-1;t.element.scrollTop+=i*t.containerHeight,R(t),e.stopPropagation()}),t.event.bind(t.scrollbarX,"mousedown",function(t){return t.stopPropagation()}),t.event.bind(t.scrollbarXRail,"mousedown",function(e){var i=e.pageX-window.pageXOffset-t.scrollbarXRail.getBoundingClientRect().left>t.scrollbarXLeft?1:-1;t.element.scrollLeft+=i*t.containerWidth,R(t),e.stopPropagation()})},"drag-thumb":function(t){g(t,["containerWidth","contentWidth","pageX","railXWidth","scrollbarX","scrollbarXWidth","scrollLeft","x","scrollbarXRail"]),g(t,["containerHeight","contentHeight","pageY","railYHeight","scrollbarY","scrollbarYHeight","scrollTop","y","scrollbarYRail"])},keyboard:function(t){function e(e,r){var l=Math.floor(i.scrollTop);if(0===e){if(!t.scrollbarYActive)return!1;if(0===l&&r>0||l>=t.contentHeight-t.containerHeight&&r<0)return!t.settings.wheelPropagation}var n=i.scrollLeft;if(0===r){if(!t.scrollbarXActive)return!1;if(0===n&&e<0||n>=t.contentWidth-t.containerWidth&&e>0)return!t.settings.wheelPropagation}return!0}var i=t.element,l=function(){return r(i,":hover")},n=function(){return r(t.scrollbarX,":focus")||r(t.scrollbarY,":focus")};t.event.bind(t.ownerDocument,"keydown",function(r){if(!(r.isDefaultPrevented&&r.isDefaultPrevented()||r.defaultPrevented)&&(l()||n())){var o=document.activeElement?document.activeElement:t.ownerDocument.activeElement;if(o){if("IFRAME"===o.tagName)o=o.contentDocument.activeElement;else for(;o.shadowRoot;)o=o.shadowRoot.activeElement;if(d(o))return}var s=0,a=0;switch(r.which){case 37:s=r.metaKey?-t.contentWidth:r.altKey?-t.containerWidth:-30;break;case 38:a=r.metaKey?t.contentHeight:r.altKey?t.containerHeight:30;break;case 39:s=r.metaKey?t.contentWidth:r.altKey?t.containerWidth:30;break;case 40:a=r.metaKey?-t.contentHeight:r.altKey?-t.containerHeight:-30;break;case 32:a=r.shiftKey?t.containerHeight:-t.containerHeight;break;case 33:a=t.containerHeight;break;case 34:a=-t.containerHeight;break;case 36:a=t.contentHeight;break;case 35:a=-t.contentHeight;break;default:return}t.settings.suppressScrollX&&0!==s||t.settings.suppressScrollY&&0!==a||(i.scrollTop-=a,i.scrollLeft+=s,R(t),e(s,a)&&r.preventDefault())}})},wheel:function(e){function i(t,i){var r=Math.floor(o.scrollTop),l=0===o.scrollTop,n=r+o.offsetHeight===o.scrollHeight,s=0===o.scrollLeft,a=o.scrollLeft+o.offsetWidth===o.scrollWidth;return!(Math.abs(i)>Math.abs(t)?l||n:s||a)||!e.settings.wheelPropagation}function r(t){var e=t.deltaX,i=-1*t.deltaY;return void 0!==e&&void 0!==i||(e=-1*t.wheelDeltaX/6,i=t.wheelDeltaY/6),t.deltaMode&&1===t.deltaMode&&(e*=10,i*=10),e!==e&&i!==i&&(e=0,i=t.wheelDelta),t.shiftKey?[-i,-e]:[e,i]}function l(e,i,r){if(!L.isWebKit&&o.querySelector("select:focus"))return!0;if(!o.contains(e))return!1;for(var l=e;l&&l!==o;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var s=l.scrollHeight-l.clientHeight;if(s>0&&!(0===l.scrollTop&&r>0||l.scrollTop===s&&r<0))return!0;var a=l.scrollWidth-l.clientWidth;if(a>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===a&&i>0))return!0}l=l.parentNode}return!1}function n(t){var n=r(t),s=n[0],a=n[1];if(!l(t.target,s,a)){var c=!1;e.settings.useBothWheelAxes?e.scrollbarYActive&&!e.scrollbarXActive?(a?o.scrollTop-=a*e.settings.wheelSpeed:o.scrollTop+=s*e.settings.wheelSpeed,c=!0):e.scrollbarXActive&&!e.scrollbarYActive&&(s?o.scrollLeft+=s*e.settings.wheelSpeed:o.scrollLeft-=a*e.settings.wheelSpeed,c=!0):(o.scrollTop-=a*e.settings.wheelSpeed,o.scrollLeft+=s*e.settings.wheelSpeed),R(e),(c=c||i(s,a))&&!t.ctrlKey&&(t.stopPropagation(),t.preventDefault())}}var o=e.element;void 0!==window.onwheel?e.event.bind(o,"wheel",n):void 0!==window.onmousewheel&&e.event.bind(o,"mousewheel",n)},touch:function(e){function i(t,i){var r=Math.floor(h.scrollTop),l=h.scrollLeft,n=Math.abs(t),o=Math.abs(i);if(o>n){if(i<0&&r===e.contentHeight-e.containerHeight||i>0&&0===r)return 0===window.scrollY&&i>0&&L.isChrome}else if(n>o&&(t<0&&l===e.contentWidth-e.containerWidth||t>0&&0===l))return!0;return!0}function r(t,i){h.scrollTop-=i,h.scrollLeft-=t,R(e)}function l(t){return t.targetTouches?t.targetTouches[0]:t}function n(t){return!(t.pointerType&&"pen"===t.pointerType&&0===t.buttons||(!t.targetTouches||1!==t.targetTouches.length)&&(!t.pointerType||"mouse"===t.pointerType||t.pointerType===t.MSPOINTER_TYPE_MOUSE))}function o(t){if(n(t)){var e=l(t);u.pageX=e.pageX,u.pageY=e.pageY,d=(new Date).getTime(),null!==p&&clearInterval(p)}}function s(e,i,r){if(!h.contains(e))return!1;for(var l=e;l&&l!==h;){if(l.classList.contains(m.element.consuming))return!0;var n=t(l);if([n.overflow,n.overflowX,n.overflowY].join("").match(/(scroll|auto)/)){var o=l.scrollHeight-l.clientHeight;if(o>0&&!(0===l.scrollTop&&r>0||l.scrollTop===o&&r<0))return!0;var s=l.scrollLeft-l.clientWidth;if(s>0&&!(0===l.scrollLeft&&i<0||l.scrollLeft===s&&i>0))return!0}l=l.parentNode}return!1}function a(t){if(n(t)){var e=l(t),o={pageX:e.pageX,pageY:e.pageY},a=o.pageX-u.pageX,c=o.pageY-u.pageY;if(s(t.target,a,c))return;r(a,c),u=o;var h=(new Date).getTime(),p=h-d;p>0&&(f.x=a/p,f.y=c/p,d=h),i(a,c)&&t.preventDefault()}}function c(){e.settings.swipeEasing&&(clearInterval(p),p=setInterval(function(){e.isInitialized?clearInterval(p):f.x||f.y?Math.abs(f.x)<.01&&Math.abs(f.y)<.01?clearInterval(p):(r(30*f.x,30*f.y),f.x*=.8,f.y*=.8):clearInterval(p)},10))}if(L.supportsTouch||L.supportsIePointer){var h=e.element,u={},d=0,f={},p=null;L.supportsTouch?(e.event.bind(h,"touchstart",o),e.event.bind(h,"touchmove",a),e.event.bind(h,"touchend",c)):L.supportsIePointer&&(window.PointerEvent?(e.event.bind(h,"pointerdown",o),e.event.bind(h,"pointermove",a),e.event.bind(h,"pointerup",c)):window.MSPointerEvent&&(e.event.bind(h,"MSPointerDown",o),e.event.bind(h,"MSPointerMove",a),e.event.bind(h,"MSPointerUp",c)))}}},H=function(r,l){var n=this;if(void 0===l&&(l={}),"string"==typeof r&&(r=document.querySelector(r)),!r||!r.nodeName)throw new Error("no element is specified to initialize PerfectScrollbar");this.element=r,r.classList.add(m.main),this.settings={handlers:["click-rail","drag-thumb","keyboard","wheel","touch"],maxScrollbarLength:null,minScrollbarLength:null,scrollingThreshold:1e3,scrollXMarginOffset:0,scrollYMarginOffset:0,suppressScrollX:!1,suppressScrollY:!1,swipeEasing:!0,useBothWheelAxes:!1,wheelPropagation:!0,wheelSpeed:1};for(var o in l)n.settings[o]=l[o];this.containerWidth=null,this.containerHeight=null,this.contentWidth=null,this.contentHeight=null;var s=function(){return r.classList.add(m.state.focus)},a=function(){return r.classList.remove(m.state.focus)};this.isRtl="rtl"===t(r).direction,this.isNegativeScroll=function(){var t=r.scrollLeft,e=null;return r.scrollLeft=-1,e=r.scrollLeft<0,r.scrollLeft=t,e}(),this.negativeScrollAdjustment=this.isNegativeScroll?r.scrollWidth-r.clientWidth:0,this.event=new y,this.ownerDocument=r.ownerDocument||document,this.scrollbarXRail=i(m.element.rail("x")),r.appendChild(this.scrollbarXRail),this.scrollbarX=i(m.element.thumb("x")),this.scrollbarXRail.appendChild(this.scrollbarX),this.scrollbarX.setAttribute("tabindex",0),this.event.bind(this.scrollbarX,"focus",s),this.event.bind(this.scrollbarX,"blur",a),this.scrollbarXActive=null,this.scrollbarXWidth=null,this.scrollbarXLeft=null;var c=t(this.scrollbarXRail);this.scrollbarXBottom=parseInt(c.bottom,10),isNaN(this.scrollbarXBottom)?(this.isScrollbarXUsingBottom=!1,this.scrollbarXTop=u(c.top)):this.isScrollbarXUsingBottom=!0,this.railBorderXWidth=u(c.borderLeftWidth)+u(c.borderRightWidth),e(this.scrollbarXRail,{display:"block"}),this.railXMarginWidth=u(c.marginLeft)+u(c.marginRight),e(this.scrollbarXRail,{display:""}),this.railXWidth=null,this.railXRatio=null,this.scrollbarYRail=i(m.element.rail("y")),r.appendChild(this.scrollbarYRail),this.scrollbarY=i(m.element.thumb("y")),this.scrollbarYRail.appendChild(this.scrollbarY),this.scrollbarY.setAttribute("tabindex",0),this.event.bind(this.scrollbarY,"focus",s),this.event.bind(this.scrollbarY,"blur",a),this.scrollbarYActive=null,this.scrollbarYHeight=null,this.scrollbarYTop=null;var h=t(this.scrollbarYRail);this.scrollbarYRight=parseInt(h.right,10),isNaN(this.scrollbarYRight)?(this.isScrollbarYUsingRight=!1,this.scrollbarYLeft=u(h.left)):this.isScrollbarYUsingRight=!0,this.scrollbarYOuterWidth=this.isRtl?f(this.scrollbarY):null,this.railBorderYWidth=u(h.borderTopWidth)+u(h.borderBottomWidth),e(this.scrollbarYRail,{display:"block"}),this.railYMarginHeight=u(h.marginTop)+u(h.marginBottom),e(this.scrollbarYRail,{display:""}),this.railYHeight=null,this.railYRatio=null,this.reach={x:r.scrollLeft<=0?"start":r.scrollLeft>=this.contentWidth-this.containerWidth?"end":null,y:r.scrollTop<=0?"start":r.scrollTop>=this.contentHeight-this.containerHeight?"end":null},this.isAlive=!0,this.settings.handlers.forEach(function(t){return T[t](n)}),this.lastScrollTop=Math.floor(r.scrollTop),this.lastScrollLeft=r.scrollLeft,this.event.bind(this.element,"scroll",function(t){return n.onScroll(t)}),R(this)};return H.prototype.update=function(){this.isAlive&&(this.negativeScrollAdjustment=this.isNegativeScroll?this.element.scrollWidth-this.element.clientWidth:0,e(this.scrollbarXRail,{display:"block"}),e(this.scrollbarYRail,{display:"block"}),this.railXMarginWidth=u(t(this.scrollbarXRail).marginLeft)+u(t(this.scrollbarXRail).marginRight),this.railYMarginHeight=u(t(this.scrollbarYRail).marginTop)+u(t(this.scrollbarYRail).marginBottom),e(this.scrollbarXRail,{display:"none"}),e(this.scrollbarYRail,{display:"none"}),R(this),W(this,"top",0,!1,!0),W(this,"left",0,!1,!0),e(this.scrollbarXRail,{display:""}),e(this.scrollbarYRail,{display:""}))},H.prototype.onScroll=function(t){this.isAlive&&(R(this),W(this,"top",this.element.scrollTop-this.lastScrollTop),W(this,"left",this.element.scrollLeft-this.lastScrollLeft),this.lastScrollTop=Math.floor(this.element.scrollTop),this.lastScrollLeft=this.element.scrollLeft)},H.prototype.destroy=function(){this.isAlive&&(this.event.unbindAll(),l(this.scrollbarX),l(this.scrollbarY),l(this.scrollbarXRail),l(this.scrollbarYRail),this.removePsClasses(),this.element=null,this.scrollbarX=null,this.scrollbarY=null,this.scrollbarXRail=null,this.scrollbarYRail=null,this.isAlive=!1)},H.prototype.removePsClasses=function(){this.element.className=this.element.className.split(" ").filter(function(t){return!t.match(/^ps([-_].+|)$/)}).join(" ")},H});

</script>