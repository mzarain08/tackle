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


global $CORE, $CORE_UI, $userdata;

$menu = array();



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
<div class="row text-center">
						<div class="col-md-3 col-lg-2">
							<h1>H1</h1>
							<h2>H2</h2>
							<h3>H3</h3>
							<h4>H4</h4>
							<h5>H5</h5>
							<h6>H6</h6>
						</div>
						<div class="col-md-3 col-lg-2">
							<h1 class="font-weight-extra-bold">H1</h1>
							<h2 class="font-weight-extra-bold">H2</h2>
							<h3 class="font-weight-extra-bold">H3</h3>
							<h4 class="font-weight-extra-bold">H4</h4>
							<h5 class="font-weight-extra-bold">H5</h5>
							<h6 class="font-weight-extra-bold">H6</h6>
						</div>
						<div class="col-md-3 col-lg-2">
							<h1 class="font-weight-bold">H1</h1>
							<h2 class="font-weight-bold">H2</h2>
							<h3 class="font-weight-bold">H3</h3>
							<h4 class="font-weight-bold">H4</h4>
							<h5 class="font-weight-semi-bold">H5</h5>
							<h6 class="font-weight-bold">H6</h6>
						</div>
						<div class="col-md-3 col-lg-2">
							<h1 class="font-weight-semibold">H1</h1>
							<h2 class="font-weight-semibold">H2</h2>
							<h3 class="font-weight-semibold">H3</h3>
							<h4 class="font-weight-semibold">H4</h4>
							<h5 class="font-weight-semibold">H5</h5>
							<h6 class="font-weight-semibold">H6</h6>
						</div>
						<div class="col-md-3 col-lg-2">
							<h1 class="font-weight-normal">H1</h1>
							<h2 class="font-weight-normal">H2</h2>
							<h3 class="font-weight-normal">H3</h3>
							<h4 class="font-weight-normal">H4</h4>
							<h5 class="font-weight-normal">H5</h5>
							<h6 class="font-weight-normal">H6</h6>
						</div>
						<div class="col-md-3 col-lg-2">
							<h1 class=" text-light bg-primary rounded-lg mb-3">H1</h1>
							<h2 class="text-light bg-secondary rounded-lg mb-3">H2</h2>
							<h3 class="text-light bg-dark rounded-lg mb-3">H3</h3>
							<h4 class="text-light bg-light text-dark rounded-lg mb-3">H4</h4>
							<h5 class="text-light bg-success rounded-lg mb-3">H5</h5>
							<h6 class="text-light bg-danger rounded-lg mb-3">H6</h6>
						</div>
					</div>
 
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"id"	=> "headings",
	"name" => "Headings",
	"desc" => "",
	"data" => $output,
);
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
 
<div class="row">
						<div class="col-lg-6">
							<h1 class="mb-3">H1 Heading</h1>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus.</p>

							<hr class="solid my-4">

							<h2 class="mb-3">H2 Heading</h2>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus.</p>

							<hr class="solid my-4">

							<h3 class="mb-3">H3 Heading</h3>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus.</p>

							<hr class="solid my-4">

							<h4 class="mb-3">H4 Heading</h4>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus.</p>

							<hr class="solid my-4">

							<h5 class="mb-3">H5 Heading</h5>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus.</p>

							<hr class="solid my-4">

							<h6 class="mb-3">H6 Heading</h6>
							<p>Pellentesque pellentesque eget tempor tellus. Fusce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget tempor tellus. Pellentesque pellentesque eget tempor tellus ellentesque pellentesque eget.</p>

						</div>

						<div class="col-lg-6">
                        
                        

							<p class="lead">Lead Pellentesque tempor tellus eget pellentesque. usce lacllentesque eget tempor tellus ellentesque pelleinia tempor malesuada. Pellentesque pellentesque eget tempor tellus ellentesqu.</p>

							<p>You can use the mark tag to <mark>highlight</mark> text.</p>
							<p><del>This line of text is meant to be treated as deleted text.</del></p>
							<p><s>This line of text is meant to be treated as no longer accurate.</s></p>
							<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
							<p><u>This line of text will render as underlined</u></p>
							<p><small>This line of text is meant to be treated as fine print.</small></p>
							<p><strong>This line rendered as bold text.</strong></p>
							<p><em>This line rendered as italicized text.</em></p>
 
							  
							<p>
							  <small>This line of text is meant to be treated as fine print.</small>
							</p>

							<p class="text-muted">Muted fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
							<p class="text-primary">Primary nullam id dolor id nibh ultricies vehicula ut id elit.</p>
							<p class="text-secondary">Secondary nullam id dolor nibh ultricies vehicula ut id elit.</p>
							<p class="text-tertiary">Tertiary nullam id dolor id ultricies vehicula ut id elit.</p>
							<p class="text-quaternary">Quaternary nullam id dolor id nibh vehicula ut id elit.</p>
							<p class="text-success">Sucess suis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
							<p class="text-info">Info maecenas sed diam eget risus varius blandit sit amet non magna.</p>
							<p class="text-warning">Warning tiam porta sem malesuada magna mollis euismod.</p>
							<p class="text-danger">Danger donec ullamcorper nulla non metus auctor fringilla.</p>

						</div>
					</div>


<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"id"	=> "headings",
	"name" => "Headings",
	"desc" => "",
	"data" => $output,
);

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>
<p class="fs-xxl">This is extra large text</p>  
<p class="fs-xl">This is extra large text</p>  
<p class="fs-lg">This is large text</p>
<p class="fs-md">This is medium text</p>
<p>This is normal text</p>
<p class="fs-sm">This is small text</p>
<p class="fs-xs">This is extra small text</p>

<p class="fs-14">font size 14</p>
<p class="fs-16">font size 16</p>
<p class="fs-18">font size 18</p>

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"id"	=> "headings",
	"name" => "Body Text Sizes",
	"desc" => "",
	"data" => $output,
);
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<p>This is some text</p>
<p class="text-400">text 400</p>
<p class="text-500">text 500</p>
<p class="text-600">text 600</p>
<p class="text-700">text 700</p>
<p class="text-800">text 800</p>
  

<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	"id"	=> "headings",
	"name" => "Font Weight",
	"desc" => "",
	"data" => $output,
);
 
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<p><abbr title="attribute">attr</abbr></p>
<p><abbr class="initialism" title="HyperText Markup Language">HTML</abbr></p>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Abbreviations",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<figure>
  <blockquote class="blockquote">
    <p>A well-known quote, contained in a blockquote element.</p>
  </blockquote>
  <figcaption class="blockquote-footer">
    Someone famous in <cite title="Source Title">Source Title</cite>
  </figcaption>
</figure>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Blockquote",
	"desc" => "",
	"data" => $output,
);

 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<dl>
  <dt>Description lists</dt>
  <dd>A description list is perfect for defining terms.</dd>
  <dt>Malesuada porta</dt>
  <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
  <dt>Euismod</dt>
  <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
</dl>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(

	"name" => "Description list basic example",
	"desc" => "",
	"data" => $output,
);




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
ob_start();
 ?>

<dl class="row">
  <dt class="col-sm-3">Description lists&nbsp;</dt>
  <dd class="col-sm-9">A description list is perfect for defining terms.</dd>
  <dt class="col-sm-3">Euismod</dt>
  <dd class="col-sm-9">
    <p class="mb-2">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</p>
    <p class="mb-0">Donec id elit non mi porta gravida at eget metus.</p>
  </dd>
  <dt class="col-sm-3">Malesuada porta</dt>
  <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>
  <dt class="col-sm-3 text-truncate">Long truncated term is truncated</dt>
  <dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
  <dt class="col-sm-3">Nesting</dt>
  <dd class="col-sm-9">
    <dl class="row">
      <dt class="col-sm-4">Nested definition list</dt>
      <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat nunc augue.</dd>
    </dl>
  </dd>
</dl>
<?php
$output = ob_get_contents();
$output = preg_replace('~>\s+<~', '><',$output);
ob_end_clean(); 
 
$menu[] = array(
	
	
	"name" => "Description list alignment",
	"desc" => "",
	"data" => $output,
);



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
_docsSection($menu);
 ?>