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
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }  global $wpdb, $CORE; 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

do_action('hook_footer_after'); 

_ppt_template( 'footer-notify' ); 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

 ?>
</div>
</div>

</div><!-- end main body wrapper -->

</div>

<?php //_ppt_template('framework/admin/_helpme' ); ?>
<script>


function closeHelpBoxWindow(){}


jQuery(document).ready(function() {	
	
	/*
	jQuery('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover click focus',
                boundary: 'window'
    }); 
 */

	// AUTO CLOSE WORDPRESS ADMIN
	document.body.className+=' folded'; 
	  
	// SET PAGE HEADER
	jQuery('#sidebar h1').html('<a href="#">PremiumPress</a>');

	// ADD SIDEBAR LINKS
	var i = 1;
	jQuery('.addjumplink').each(function(index,item){
		  var id = this.id;		
		  
		 	
			f = '<li><a href="#'+id+'" id="'+id+'-tab" data-targetdiv="'+id+'" class="nav-item nav-link" data-toggle="tab" role="tab" aria-controls="'+id+'" aria-selected="false"><i class="fa fa-chevron-right"></i>' + jQuery(this).data('title') + '</a></li>';
			//' + jQuery(this).data('icon') + '
		 	 
		  if(id == "linkblocks" || id == "linkinvoice" || id == "logs"){
		  	
			if(id == "logs"){
			
			var lii = "admin.php?page=reports";
			
			}else if(id == "linkinvoice"){
			var lii = "admin.php?page=settings&lefttab=company";
			}else{
			var lii = "admin.php?page=docs&lefttab=blocks";
			}
		 
			
			 	g = '<a class="_admin_iconbox icon-box" href="'+lii+'" id="'+id+'-box"><i class="fal ' + jQuery(this).data('icon') + '"></i><strong>' + jQuery(this).data('title') + '</strong><p>' + jQuery(this).data('desc') + '</p></a>';
		  
		  }else{ 
		  
		  	g = '<a class="_admin_iconbox icon-box" href="#" id="'+id+'-box" onclick="jQuery(\'#'+ id +'-tab\').trigger(\'click\');window.scrollTo({ top: 0, behavior: \'smooth\' });"  data-targetdiv="'+id+'"><i class="fal ' + jQuery(this).data('icon') + '"></i><strong>' + jQuery(this).data('title') + '</strong><p>' + jQuery(this).data('desc') + '</p></a>';
			 
			
		  
		  }
			 
			jQuery('#overviewlist').append(g);
		 
		 
		 <?php if(isset($_GET['page']) &&  in_array($_GET['page'], array('settings','design','email','advertising','cart','news','search','stores','docs','orders','cashout','listings','members','reports','customfields',"listingsetup","membershipsetup","usersettings","newsletter")) ){ ?>
		 
		  jQuery('.jumplinks-<?php echo esc_attr($_GET['page']); ?>').append(f);
		  
		 <?php }else{ ?> 
		 jQuery('#jumplinks').append(f);	
		 <?php } ?>
		 
		 	  
		  i++;
	 });
	  
	 // UPDATE MAIN PAGE DISPLAY
 	<?php if(isset($_GET['page']) && $_GET['page'] == "orders" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show');
	 
 	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "comments" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show');
	 
	 <?php }elseif(isset($_GET['page']) && $_GET['page'] == "news" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show');  
	 
	 <?php }elseif(isset($_GET['page']) && $_GET['page'] == "cashout" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show');  
	 
 	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "listings" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 	
	  //jQuery('#sidebar').toggleClass('active');
	  
 	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "reports" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 	 
 	
 	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "advertising" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 	 
  	
	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "members" && isset($_GET['eid'])){ ?> 
	   
	 jQuery('#add-tab').trigger('click');
	 
	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "email" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 
	 
	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "newsletter" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 
	 
	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "cashback" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show');  
	 
	<?php }elseif(isset($_GET['page']) && $_GET['page'] == "dispute" && isset($_GET['eid'])){ ?> 
	 
	 jQuery('#add-tab').tab('show'); 
		 
	 <?php }elseif(isset($_GET['page']) && ( $_GET['page'] == "premiumpress"  ) || isset($_GET['smallwindow'])  ){ ?> 
 	 	  
 	<?php }else{ ?>
 	
  	 //jQuery('#jumplinks li:first-child a').tab('show'); 	

	 jQuery('#content h2').hide();
	 
	 
	  <?php if(isset($_GET['page']) && $_GET['page'] == "customfields" ){ ?>
	  jQuery('#content').prepend('<h2><span><i class="fa fa-align-left mr-2"></i> Custom Fields</span></h2>');	

	 
	  <?php }elseif(isset($_GET['page']) && $_GET['page'] == "plugins" ){ ?>
	  jQuery('#content').prepend('<h2><span><i class="fa fa-plug mr-2"></i> Plugins</span></h2>');	

	  <?php }elseif(isset($_GET['page']) && $_GET['page'] == "messages" ){ ?>
	  jQuery('#content').prepend('<h2><span><i class="fa fa-comments mr-2"></i> Messages</span></h2>');	
 
	 <?php }else{ ?>	
	 jQuery('#content').prepend('<h2><span><i class="fa '+jQuery('.tab-content .tab-pane:first-child').data('icon')+' mr-2"></i> '+jQuery('.tab-content .tab-pane:first-child').data('title')+'</span></h2>');	 
  <?php } ?>
  
 	<?php } ?>	
	
	
	// ON JUMPLINK CHANGE ADD TITLE	
	jQuery('a[data-toggle="tab"]:not(.custom)').on('shown.bs.tab', function (e) {
	
	jQuery('#jumplinks .child li a').each(function () {		
		jQuery(this).removeClass('show active');	
	});
	 
	 var id = this.id;	
	 
	 jQuery(this).addClass('show active');
	 
	 tt = jQuery('#'+id).data('targetdiv');
	 jQuery('#content h2').hide();
	<?php if(isset($_GET['page']) && !in_array($_GET['page'], array("members","listings")) ){ ?>
	 jQuery('#content').prepend('<h2><span><i class="fa '+jQuery('#'+tt).data('icon')+' mr-2"></i> '+jQuery('#'+tt).data('title')+'</span></h2>');	
	 <?php } ?>
	 tinyScroll();
	    
	});
	
	
	// ON JUMPLINK CHANGE ADD TITLE	
	jQuery('.jumplinks-docs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	
	jQuery('#jumplinks .child li a').each(function () {		
		jQuery(this).removeClass('show active');	
	});
	 
	 var id = this.id;	
	 
	 jQuery(this).addClass('show active');
	 
	 tt = jQuery('#'+id).data('targetdiv');
	 jQuery('#content h2').hide();
	 
	 
	  
	 jQuery('#content').prepend('<h2><span><i class="fa '+jQuery('#'+tt).data('icon')+' mr-2"></i> '+jQuery('#'+tt).data('title')+'</span></h2>');	
	 
	 
	 tinyScroll();
	    
	});
	  
		
	//------------ Tab Displays
	jQuery('#myTab .nav-link').on('click', function() {		
			var self = jQuery(this);
			 var id = this.id;	
			jQuery('.tabinner').val(id);
			
	}); 
	
	<?php 
	if(isset($_POST['tabinner']) && $_POST['tabinner'] != ""){ ?>		 
		jQuery('#myTab a[href="#<?php echo str_replace("-tab","",$_POST['tabinner']); ?>"]').tab('show');		
	<?php } ?>		
		
	//------------ Tab Displays
	jQuery('#jumplinks .nav-link').on('click', function() {		
			var self = jQuery(this);
			 var id = this.id;			
			jQuery('.lefttab').val(id);
			
			closeHelpBoxWindow();
			
	}); 
	
	
	
	setTimeout(function(){
	<?php if(isset($_GET['testemail'])){ ?>
	jQuery('#jumplinks a[href="#sendemail"]').tab('show');
	<?php }elseif(isset($_GET['editpages'])){ ?>
	jQuery('#jumplinks a[href="#pagelinking"]').tab('show');	
	<?php }elseif(isset($_POST['lefttab']) && $_POST['lefttab'] != ""){ ?>
	jQuery('#jumplinks a[href="#<?php echo str_replace("#","",str_replace("-tab","",$_POST['lefttab'])); ?>"]').tab('show');		
	<?php }elseif(isset($_GET['lefttab']) && $_GET['lefttab'] != ""){ ?>		 
	jQuery('#jumplinks a[href="#<?php echo str_replace("#","",str_replace("-tab","",$_GET['lefttab'])); ?>"]').tab('show');		
	<?php } ?>
	}, 1000);	
		
		
		
		//------------ icon box
		jQuery('.icon-box').on('click', function (e) {		
		
		var self = jQuery(this);
		 var id = this.id;	
		 tt = jQuery('#'+id).data('targetdiv');		 
		 jQuery('#jumplinks a[href="#'+tt+'"]').tab('show');
		 
		 
		setTimeout(function(){
		jQuery('[data-toggle="tooltip1"]').tooltip({
					trigger: 'hover click focus',
					boundary: 'window',
					placement: 'bottom'
		}); 
		
		
		
		
		}, 2000);

		 	 		 
		});
		
		//------------ custom list
		jQuery('.customlist').on('click', function (e) {
	 
		var self = jQuery(this);
		 var id = this.id;	
		 tt = jQuery('#'+id).data('targetdiv');		 
		 jQuery('#jumplinks a[href="#'+tt+'"]').tab('show');	 		 
		});
				
		
		//------------ Accordian Tab Display
		jQuery('.accordion .btn-link').on('click', function() {
			var self = jQuery(this);
			jQuery('.ShowThisAccordianTab').val(jQuery(this).attr('data-target'));
			
		}); 	
		<?php if(isset($_POST['showaccordiantab']) && $_POST['showaccordiantab'] != ""){ ?>
		jQuery('<?php echo $_POST['showaccordiantab']; ?>').collapse();
		<?php } ?>
		
	
		<?php if(isset($_POST['tab']) && $_POST['tab'] != ""){ ?>
		// SET DEFAULT TAB IN
		jQuery('#MainTabs a[href="#<?php echo esc_attr($_POST['tab']); ?>"]').tab('show');		
		<?php }elseif(isset($_GET['tab']) && $_GET['tab'] != ""){ ?>
		// SET DEFAULT TAB IN		
		jQuery('#MainTabs a[href="#<?php echo esc_attr($_GET['tab']); ?>"]').tab('show');
		
		
		<?php } ?>
		
		
		// Toggle
		var off = false;
		var toggle = jQuery('.toggle');

		toggle.siblings().hide();
		toggle.show();
 
		jQuery('#content').on('click', '.toggle', function() {
			var self = jQuery(this);

			if (self.hasClass('on')) {
				self.siblings('.off').click();
				self.removeClass('on').addClass('off');
			} else {
				self.siblings('.on').click();
				self.removeClass('off').addClass('on');
			}
		});
		

 		
	// SIDEBAR NAV
	var fullHeight = function() {

		jQuery('.js-fullheight').css('height', jQuery(window).height());
		jQuery(window).resize(function(){
			jQuery('.js-fullheight').css('height', jQuery(window).height());
		});

	};
	fullHeight();

	jQuery('#sidebarCollapse').on('click', function () {
      jQuery('#sidebar').toggleClass('active');
  	});
  
  // NOW TURN OFF THE SPINNER  
  jQuery('#loading-spinnner').remove();
  jQuery('#premiumpress-body').show();
		
		
		// COLOR PICKER
	  <?php if(isset($_GET['page']) && in_array($_GET['page'], array("design","listingsetup")) ){ ?>
		jQuery('.myColorPicker').colorPickerByGiro({
			preview: '.myColorPicker-preview'
		});
	 <?php } ?>	

});

	function showfilersbar(){  
		
		jQuery('#filters-extra').toggle();
		jQuery('#filterssidebox').toggle();
	 
	}
	function showactionsbar(){  
		
		jQuery('#actionsbox').toggle();
	 
	}
	
	 
	function doselectall(){
		
		jQuery('#actionsbox').show();
		
		jQuery('.checkbox1').each(function() {
		
			if(this.checked) { 
				this.checked = false;
			}else{
				this.checked = true; 
			} 
		
		});
	}
  
  


 
function showthispage(k){

 
	jQuery('#buttonarea').toggle().html('<a href="javascript:void(0);" onclick="showthispage(\''+ k +'\');" class="btn btn-dark mt-5 btn-sm text-left"><i class="fa fa-arrow-left mr-3" aria-hidden="true"></i> Go Back</a>');
	jQuery('#logoarea').toggle();
	jQuery('#mainsection').toggle();
	jQuery('#'+k).toggle();

}


jQuery(window).on('load',function () {
	jQuery('.confirm').click(function(e)
	{
		if(confirm("Are you sure?"))
		{
		   
		
		}
		else
		{
			 alert('Phew! That was close!');
			e.preventDefault();
		}
	});
});


<?php if(isset($_POST['tab']) && $_POST['tab'] != ""){ ?>
showthispage("<?php echo $_POST['tab']; ?>");
<?php } ?>

</script>
 
<?php if($CORE->GEO("is_right_to_left", array() )){ ?>
<script>
jQuery(document).ready(function(){ 
     //jQuery("html[lang=ar]").attr("dir", "rtl").find("body").addClass("rtl right-to-left");
	 
});
</script>
<?php } ?>


<?php if(isset($_GET['page']) && $_GET['page'] != 3 && $_GET['page'] != "add" &&  $_GET['page'] != "listings"){ ?>
<!-- FILE UPLOAD FUNCTION --->
<input type="hidden" value="" name="imgIdblock" id="imgIdblock" />
<input type="hidden" value="" name="imgAID" id="imgAID" />
<input type="hidden" value="" name="imgPreviewID" id="imgPreviewID" />
<script >
function ChangeImgBlock(divname){
	document.getElementById("imgIdblock").value = divname;
}
function ChangeAIDBlock(divname){
	document.getElementById("imgAID").value = divname;
}
function ChangeImgPreviewBlock(divname){
	document.getElementById("imgPreviewID").value = divname;
}
jQuery(document).ready(function() {
 
	window.send_to_editor = function(html) {
	 	
	
	var regex = /src="(.+?)"/;
    var rslt =html.match(regex);
 	 
	var imgrex = /wp-image-(.+?)"/;
    var imgid = html.match(imgrex);
 
    var imgurl = rslt[1];
	var imgaid = imgid[1];
	
	jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
	jQuery('#'+document.getElementById("imgAID").value).val(imgaid);
	jQuery('#'+document.getElementById("imgPreviewID").value).attr("src", imgurl ); 
	 
	 tb_remove();
	   
	 
	 <?php if(isset($_GET['page']) && $_GET['page'] == "email"){ ?>
	 
	 var editoid = 'email_id_'+jQuery("#emailCurrentEditID").val();	 
	 
	 var text = '<img src="'+imgurl+'">';
	 
	 
	 var content = '('+text+')';
	 
	if(jQuery('#wp-'+editoid+'-wrap').hasClass('html-active')){ // We are in text mode
	
		jQuery('#'+editoid).val(jQuery('#'+editoid).val()+' '+content); // Update the textarea's content	 
		
	} else { // We are in tinyMCE mode
		
		jQuery('#'+editoid+'_ifr').contents().find("body").html( jQuery('#'+editoid+'_ifr').contents().find("body").html() +' '+ content);
		
	}
	 
	 <?php }else{ ?>
	 document.admin_save_form.submit();
	 <?php } ?>
	 
	}
}); 
</script>
<!--- END FILE UPLOAD FUNCTION -->
<?php } ?>


<?php if(isset($_GET['page']) &&  in_array($_GET['page'], array('settings','listingsetup','membershipsetup')) ){ ?>
<script>
 
function loadiconbox(div, current_icon){

	jQuery(".ppt-modal-wrap").addClass('upgrade-modal').fadeIn(400);
	
	 
	jQuery(".card-footer").show();
	jQuery(".ppt-modal-close").hide();
	
	jQuery('#icon_divid_save').val(div);
	jQuery('#icon_divid_save_currenticon').val(current_icon);
	
	
	
	pptModal("icons", jQuery("#iconslist").html(), "modal-rightxxxx", "ppt-animate-fadeup bg-white w-700 ppt-modal-shadow", 1);
	

}
function processIconSelect(icon){

	 
	jQuery("#"+jQuery('#icon_divid_save').val()).val(icon);
	
	jQuery("#"+jQuery('#icon_divid_save').val()+'_icon').removeClass(jQuery('#icon_divid_save_currenticon').val()).addClass(icon);
	
	jQuery(".ppt-modal-wrap").removeClass('show');	
 
}
</script>
<!--login modal -->
<input type="hidden" id="icon_divid_save" value="" />
<input type="hidden" id="icon_divid_save_currenticon" value="" />

      

<?php
 global $CORE_UI;
		
 $font_awesome_icons =  $CORE_UI->ICONS("list",array()); ?>
    
    <div id="iconslist" style="display:none;"> 
    
    
<script>
jQuery(document).ready(function(){ 
	jQuery('[data-search]').on('keyup', function() {
		var searchVal = jQuery(this).val();
		jQuery(".block-header").hide();
		var filterItems = jQuery('[data-filter-item]');
	
		if ( searchVal != '' ) {
			filterItems.addClass('hidden');
			jQuery('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');
		} else {
			filterItems.removeClass('hidden');
		}
	});
});
</script>
    
    	<div class="p-3" style="max-height:400px; overflow:scroll;">
        <input type="text" class="form-control mb-3" data-search placeholder="<?php echo __("Filter by keyword","premiumpress"); ?>" />
    
        <?php foreach($font_awesome_icons as $title => $icons){ ?>
        
        
        <div class="block-header mt-4">
            <h3 class="block-header__title"><?php echo ucfirst($title); ?></h3>
            <div class="block-header__divider"></div> 
       </div>
       
       
		<div class="btn-block clearfix">
		<?php foreach($icons as $ficon){ 
		
		$ficon = str_replace("far","fa",$ficon);
		if($ficon == ""){ continue; }
		?>
        <div data-filter-item data-filter-name="<?php echo $ficon; ?>" style="float:left; padding:5px; width:50px; height:50px;  font-size: 25px; background:#fff; border:1px solid #ddd; margin-right:10px; margin-bottom:10px; cursor:pointer; padding-left:10px; padding-right:10px;" onclick="processIconSelect('fa fa-<?php echo $ficon; ?>');"> <span class="fa fa-<?php echo $ficon; ?>"></span> </div>
        <?php } ?>
        </div>
        <?php } ?>
        
        <div class="clearfix"></div>
 		</div>
      </div>

<?php } ?>

 



<script> 
var ajax_site_url = "<?php echo home_url(); ?>/";





/* MENU */
window.$ = window.jQuery;

 !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],t):(e="undefined"!=typeof globalThis?globalThis:e||self).metisMenu=t(e.$)}(this,(function(e){"use strict";function t(e){return e&&"object"==typeof e&&"default"in e?e:{default:e}}var n=t(e);const i=(e=>{const t="transitionend",n={TRANSITION_END:"mmTransitionEnd",triggerTransitionEnd(n){e(n).trigger(t)},supportsTransitionEnd:()=>Boolean(t)};function i(t){let i=!1;return e(this).one(n.TRANSITION_END,(()=>{i=!0})),setTimeout((()=>{i||n.triggerTransitionEnd(this)}),t),this}return e.fn.mmEmulateTransitionEnd=i,e.event.special[n.TRANSITION_END]={bindType:t,delegateType:t,handle(t){if(e(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}},n})(n.default),s="metisMenu",r="metisMenu",a=n.default.fn[s],o={toggle:!0,preventDefault:!0,triggerElement:"a",parentTrigger:"li",subMenu:"ul"},l={SHOW:"show.metisMenu",SHOWN:"shown.metisMenu",HIDE:"hide.metisMenu",HIDDEN:"hidden.metisMenu",CLICK_DATA_API:"click.metisMenu.data-api"},d="metismenu",g="mm-active",h="mm-show",u="mm-collapse",f="mm-collapsing";class c{constructor(e,t){this.element=e,this.config={...o,...t},this.transitioning=null,this.init()}init(){const e=this,t=this.config,i=n.default(this.element);i.addClass(d),i.find(`${t.parentTrigger}.${g}`).children(t.triggerElement).attr("aria-expanded","true"),i.find(`${t.parentTrigger}.${g}`).parents(t.parentTrigger).addClass(g),i.find(`${t.parentTrigger}.${g}`).parents(t.parentTrigger).children(t.triggerElement).attr("aria-expanded","true"),i.find(`${t.parentTrigger}.${g}`).has(t.subMenu).children(t.subMenu).addClass(`${u} ${h}`),i.find(t.parentTrigger).not(`.${g}`).has(t.subMenu).children(t.subMenu).addClass(u),i.find(t.parentTrigger).children(t.triggerElement).on(l.CLICK_DATA_API,(function(i){const s=n.default(this);if("true"===s.attr("aria-disabled"))return;t.preventDefault&&"#"===s.attr("href")&&i.preventDefault();const r=s.parent(t.parentTrigger),a=r.siblings(t.parentTrigger),o=a.children(t.triggerElement);r.hasClass(g)?(s.attr("aria-expanded","false"),e.removeActive(r)):(s.attr("aria-expanded","true"),e.setActive(r),t.toggle&&(e.removeActive(a),o.attr("aria-expanded","false"))),t.onTransitionStart&&t.onTransitionStart(i)}))}setActive(e){n.default(e).addClass(g);const t=n.default(e).children(this.config.subMenu);t.length>0&&!t.hasClass(h)&&this.show(t)}removeActive(e){n.default(e).removeClass(g);const t=n.default(e).children(`${this.config.subMenu}.${h}`);t.length>0&&this.hide(t)}show(e){if(this.transitioning||n.default(e).hasClass(f))return;const t=n.default(e),s=n.default.Event(l.SHOW);if(t.trigger(s),s.isDefaultPrevented())return;if(t.parent(this.config.parentTrigger).addClass(g),this.config.toggle){const e=t.parent(this.config.parentTrigger).siblings().children(`${this.config.subMenu}.${h}`);this.hide(e)}t.removeClass(u).addClass(f).height(0),this.setTransitioning(!0);t.height(e[0].scrollHeight).one(i.TRANSITION_END,(()=>{this.config&&this.element&&(t.removeClass(f).addClass(`${u} ${h}`).height(""),this.setTransitioning(!1),t.trigger(l.SHOWN))})).mmEmulateTransitionEnd(350)}hide(e){if(this.transitioning||!n.default(e).hasClass(h))return;const t=n.default(e),s=n.default.Event(l.HIDE);if(t.trigger(s),s.isDefaultPrevented())return;t.parent(this.config.parentTrigger).removeClass(g),t.height(t.height())[0].offsetHeight,t.addClass(f).removeClass(u).removeClass(h),this.setTransitioning(!0);const r=()=>{this.config&&this.element&&(this.transitioning&&this.config.onTransitionEnd&&this.config.onTransitionEnd(),this.setTransitioning(!1),t.trigger(l.HIDDEN),t.removeClass(f).addClass(u))};0===t.height()||"none"===t.css("display")?r():t.height(0).one(i.TRANSITION_END,r).mmEmulateTransitionEnd(350)}setTransitioning(e){this.transitioning=e}dispose(){n.default.removeData(this.element,r),n.default(this.element).find(this.config.parentTrigger).children(this.config.triggerElement).off(l.CLICK_DATA_API),this.transitioning=null,this.config=null,this.element=null}static jQueryInterface(e){return this.each((function(){const t=n.default(this);let i=t.data(r);const s={...o,...t.data(),..."object"==typeof e&&e?e:{}};if(i||(i=new c(this,s),t.data(r,i)),"string"==typeof e){if(void 0===i[e])throw new Error(`No method named "${e}"`);i[e]()}}))}}return n.default.fn[s]=c.jQueryInterface,n.default.fn[s].Constructor=c,n.default.fn[s].noConflict=()=>(n.default.fn[s]=a,c.jQueryInterface),c}));


var handleMetisMenu = function() {
	 
		if(jQuery('#admin-menu').length > 0 ){
			jQuery("#admin-menu").metisMenu();
		}
		jQuery('.metismenu > .mm-active ').each(function(){
			if(!jQuery(this).children('ul').length > 0)
			{
				jQuery(this).addClass('active-no-child');
			}
		});
}
handleMetisMenu();


 </script>
 
