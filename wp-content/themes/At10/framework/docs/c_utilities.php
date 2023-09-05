<?php

global $CORE, $CORE_UI, $userdata;

$menu = array();



 ?>
 
<h2 class="mb-4">PremiumPress Markup</h2>

<p>PremiumPress elments have their own data tag to prevent conflicts with third party plugins or Boostrap updates.</p>

<div class="my-4">

<?php foreach($CORE_UI->tags as $tag){ ?>

<span data-ppt-element="tag"><?php echo $tag; ?></span>

<?php } ?>


</div>
 

<h2 class="mb-4">Spacing</h2>
 

<div class="card"><div class=" card-body">

<div class="row">


<div class="col-md-4">

 <h4 class="mb-4">Section Padding</h4>
 <pre class="basic">
/*-------- general -----*/
.section-20 { }
.section-40 { }
.section-50 { }
.section-60 { }
.section-80 { }
.section-100 { }

/*-------- top only -----*/ 
.section-top-40 { }
.section-top-60 { }
.section-top-80 { }
.section-top-100 { }

/*-------- bottom only -----*/ 
.section-bottom-40 { }
.section-bottom-60 { }
.section-bottom-80 { }
.section-bottom-100 { }
 
</pre>

    <h4 class="mb-4">Padding</h4>
    
    <div class="bg-light p-4">same as margins</div>

</div>

<div class="col-md-4">

    <h4 class="mb-4">Margins</h4>
    
 <pre class="basic">
/*-------- top -----*/
.mt-1 { }
.mt-2 { }
.mt-3 { }
.mt-4 { }
.mt-5 { }

/*-------- bottom -----*/
.mb-1 { }
.mb-2 { }
.mb-3 { }
.mb-4 { }
.mb-5 { }

/*-------- left -----*/
.ml-1 { }
.ml-2 { }
.ml-3 { }
.ml-4 { }
.ml-5 { }

/*-------- right -----*/
.mr-1 { }
.mr-2 { }
.mr-3 { }
.mr-4 { }
.mr-5 { }

</pre>

</div>

<div class="col-md-4">

    <h4 class="mb-4">Mobile Extras</h4>
    
 <pre class="basic">
/*-------- top -----*/
.mobile-mt-4 { margin-top:40px; }
.mobile-mb-2 { margin-bottom:20px !important; }
.mobile-mb-4 { margin-bottom:40px !important; }
.mobile-mb-6 { margin-bottom:60px !important; }
.mobile-pt-4 { padding-top:40px; }
.mobile-pb-4 { padding-bottom:40px; }

</pre>


<h4 class="mb-4">Flexbox Classes</h4>
    
<pre class="basic">
/*-------flex classes--------*/
   .align_center_center
   .align_col_center_left
   .align_col_bottom_left
   .align_col_center_right
   .align_col_right_bottom
   .align_col_center_bottom
   .align_row_left_top
   .align_row_center_left
   .align_row_center_right
   .align_row_center_center
   .align_row_spacebetween

</pre>
    
    

</div>


</div>

</div></div>