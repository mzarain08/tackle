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
   
   global $CORE, $userdata, $settings, $post; 
   
  
   ?>
   
<style> 

.card-message-board {  }
.card-message-board .ppt-message-board { padding:0px; margin:0px; } 
.card-message-board .ppt-message-board li {    padding:8px 4px;    margin:0px;  }
.card-message-board .ppt-message-board ._text { font-size:12px; position:relative; background-color: #000;    color: #fff;    padding: 10px;    display: inline-block; border-radius: 4px; } 
.card-message-board .ppt-message-board ._time { font-size:11px; opacity:0.5; } 
.card-message-board .ppt-message-board .pagination { margin-right:-10px; }
.card-message-board .page-link {padding: 5px 10px;    font-size: 14px;    background: #00000042;    color: #fff;    border-radius: 4px !important; margin: 0px 3px; }
.card-message-board .ppt-message-board ._text:before {
    content: " ";
    position: absolute;
    width: 10px;
    height: 10px;
    left: -6px;
    z-index: 1;
    top: auto;
    bottom: 0;
    border: 6px solid #3b82f6;
    border-color: transparent transparent #000;
}
</style>
 
 
<?php if(_ppt(array('user','liveads')) == "1"){ ?>
<div class="card card-message-board">
<div class="card-header bg-primary text-light text-600  d-flex justify-content-between">

<div>
<span><?php  echo __("Message Board","premiumpress"); ?></span>
</div>
<div>
    <ul class="pagination mb-0">
    <li class="page-item"><a href="#" class="page-link prev"><i class="fa fa-chevron-down"></i></a></li>
    <li class="page-item"><a href="#" class="page-link next"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
</div>
</div>
  <div class="card-body p-2">
  
<ul class="ppt-message-board">
<?php $c=1; while($c < 10){ ?>
<li>
<div class="d-flex _msg">

	<div class="mr-4">
    
	<?php echo $CORE_UI->AVATAR("user", array("size" => "sm", "uid" => $userdata->ID, "css" => "rounded-circle", "online" => 0, "link" => 0)); ?>
    
    </div>

    <div>
    
    	<div class="_text">css3transition effect are the best effect to use this news ticker to make it more....</div>
        
        <div class="_time">20 mins ago.</div>
    
    </div>
</div>
</li>
<?php $c++; } ?>
</ul>
 
  
</div>
 

</div> 

<script>

"function"!=typeof Object.create&&(Object.create=function(e){function n(){}return n.prototype=e,new n}),function(e,n,t,i){var o={init:function(n,t){if(this.elem=t,this.$elem=e(t),this.newsTagName=this.$elem.find(":first-child").prop("tagName"),this.newsClassName=this.$elem.find(":first-child").attr("class"),this.timer=null,this.resizeTimer=null,this.animationStarted=!1,this.isHovered=!1,"string"==typeof n)throw console&&console.error("String property override is not supported"),"String property override is not supported";this.options=e.extend({},e.fn.bootstrapNews.options,n),this.prepareLayout(),this.options.autoplay&&this.animate(),this.options.navigation&&this.buildNavigation(),"function"==typeof this.options.onToDo&&this.options.onToDo.apply(this,arguments)},prepareLayout:function(){var t=this;e(t.elem).find("."+t.newsClassName).on("mouseenter",function(){t.onReset(!0)}),e(t.elem).find("."+t.newsClassName).on("mouseout",function(){t.onReset(!1)}),e.map(t.$elem.find(t.newsTagName),function(n,i){i>t.options.newsPerPage-1?e(n).hide():e(n).show()}),t.$elem.find(t.newsTagName).length<t.options.newsPerPage&&(t.options.newsPerPage=t.$elem.find(t.newsTagName).length);var i=0;e.map(t.$elem.find(t.newsTagName),function(n,o){o<t.options.newsPerPage&&(i=parseInt(i)+parseInt(e(n).height())+10)}),e(t.elem).css({"overflow-y":"hidden",height:i}),e(n).resize(function(){null!==t.resizeTimer&&clearTimeout(t.resizeTimer),t.resizeTimer=setTimeout(function(){t.prepareLayout()},200)})},findPanelObject:function(){for(var e=this.$elem;void 0!==e.parent();)if((e=e.parent()).parent().hasClass("card"))return e.parent()},buildNavigation:function(){var n=this.findPanelObject();if(n){var t='',i=e(n).find(".card-footer")[0];i?e(i).append(t):e(n).append('');var o=this;e(n).find(".prev").on("click",function(e){e.preventDefault(),o.onPrev()}),e(n).find(".next").on("click",function(e){e.preventDefault(),o.onNext()})}},onStop:function(){},onPause:function(){this.isHovered=!0,this.options.autoplay&&this.timer&&clearTimeout(this.timer)},onReset:function(e){this.timer&&clearTimeout(this.timer),this.options.autoplay&&(this.isHovered=e,this.animate())},animate:function(){var e=this;e.timer=setTimeout(function(){e.options.pauseOnHover||(e.isHovered=!1),e.isHovered||("up"===e.options.direction?e.onNext():e.onPrev())},e.options.newsTickerInterval)},onPrev:function(){var n=this;if(n.animationStarted)return!1;n.animationStarted=!0;var t="<"+n.newsTagName+' style="display:none;" class="'+n.newsClassName+'">'+e(n.$elem).find(n.newsTagName).last().html()+"</"+n.newsTagName+">";e(n.$elem).prepend(t),e(n.$elem).find(n.newsTagName).first().slideDown(n.options.animationSpeed,function(){e(n.$elem).find(n.newsTagName).last().remove()}),e(n.$elem).find(n.newsTagName+":nth-child("+parseInt(n.options.newsPerPage+1)+")").slideUp(n.options.animationSpeed,function(){n.animationStarted=!1,n.onReset(n.isHovered)}),e(n.elem).find("."+n.newsClassName).on("mouseenter",function(){n.onReset(!0)}),e(n.elem).find("."+n.newsClassName).on("mouseout",function(){n.onReset(!1)})},onNext:function(){var n=this;if(n.animationStarted)return!1;n.animationStarted=!0;var t="<"+n.newsTagName+' style="display:none;" class='+n.newsClassName+">"+e(n.$elem).find(n.newsTagName).first().html()+"</"+n.newsTagName+">";e(n.$elem).append(t),e(n.$elem).find(n.newsTagName).first().slideUp(n.options.animationSpeed,function(){e(this).remove()}),e(n.$elem).find(n.newsTagName+":nth-child("+parseInt(n.options.newsPerPage+1)+")").slideDown(n.options.animationSpeed,function(){n.animationStarted=!1,n.onReset(n.isHovered)}),e(n.elem).find("."+n.newsClassName).on("mouseenter",function(){n.onReset(!0)}),e(n.elem).find("."+n.newsClassName).on("mouseout",function(){n.onReset(!1)})}};e.fn.bootstrapNews=function(e){return this.each(function(){Object.create(o).init(e,this)})},e.fn.bootstrapNews.options={newsPerPage:4,navigation:!0,autoplay:!0,direction:"up",animationSpeed:"normal",newsTickerInterval:4e3,pauseOnHover:!0,onStop:null,onPause:null,onReset:null,onPrev:null,onNext:null,onToDo:null}}(jQuery,window,document); 

jQuery(document).ready(function( ) {

       jQuery(".ppt-message-board").bootstrapNews({
            newsPerPage: 5,
            autoplay: true,
			pauseOnHover:true,
            direction: 'up',
            newsTickerInterval: 10000, 
            
        });
	 
    });
</script>
<?php

} ?>