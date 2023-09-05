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


global $settings, $wpdb, $CORE ;
 

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
?>

<p>Here is a list of all the design code used for your current setup.</p>

<div class="row">
<div class="col-md-6">
<div class="p4" ppt-border1>
  <div class="card-body">
    <h6>How it works</h6>
    <hr />
    <p class="lead text-muted">Orders are created when a customer completes the checkout process. Each order is given a unique Order ID.</p>
    <div class="text-center"> <img data-src="<?php echo DEMO_IMG_PATH; ?>admin/flow2.png" class="img-fluid lazy" alt="img"   /> </div>
    <h6>Order ID</h6>
    <hr />
    <p class="text-muted lead">Order ID's are non-sequential as they use the default WordPress ID approach. The order ID is constructed using a number of data elements.</p>
    <pre>

{ORDER TYPE} - { USER ID } - { POST ID } - { DATE }

</pre>
    <h6>Order Process</h6>
    <hr />
    <div class="row mb-4">
      <div class="col-4"> Paid </div>
      <div class="col-4"> Processing </div>
      <div class="col-4"> Complete </div>
      <div class="col-12 mt-2">
        <div class="progress">
          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
<div class="col-md-6"> 


 <div class="p-4" ppt-border1>
<table class="table table-bordered bg-white  mb-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Key</th>
      <th scope="col">Description</th>
      <th scope="col">Color Tag</th>
    </tr>
  </thead>
  <tbody>
    <?php
$types = $CORE->ORDER("get_status",array());
$i=1;
foreach($types as $k => $t){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $k; ?></td>
      <td><?php echo $t['name']; ?></td>
      <td><div style="background:<?php echo $t['color']; ?>" class="p-2 text-white font-weight-bold text-center"><?php echo $t['color']; ?></div></td>
    </tr>
    <?php  $i++; } ?>
  </tbody>
</table>
</div>


<div class="my-4 p-4" ppt-border1>

<p>The order process indicated the current process of the order.</p>

<table class="table table-bordered bg-white  mb-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Key</th>
      <th scope="col">Description</th>
      <th scope="col">Color Tag</th>
    </tr>
  </thead>
  <tbody>
    <?php
$types = $CORE->ORDER("get_process",array());
$i=1;
foreach($types as $k => $t){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $k; ?></td>
      <td><?php echo $t['name']; ?></td>
      <td><div style="background:<?php echo $t['color']; ?>" class="p-2 text-white font-weight-bold text-center"><?php echo $t['color']; ?></div></td>
    </tr>
    <?php  $i++; } ?>
  </tbody>
</table>

</div>



<div class="mt-4 p-4" ppt-border1>


<p>Order types are used to indicate what sort of payment the order is for.</p>

<table class="table table-bordered bg-white ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Key</th>
      <th scope="col">Description</th>
      <th scope="col">Color Tag</th>
    </tr>
  </thead>
  <tbody>
    <?php
$types = $CORE->ORDER("get_type",array());
$i=1;
foreach($types as $t){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $t['id']; ?></td>
      <td><?php echo $t['name']; ?></td>
      <td><div style="background:<?php echo $t['color']; ?>" class="p-2 text-white font-weight-bold text-center"><?php echo $t['color']; ?></div></td>
    </tr>
    <?php  $i++; } ?>
  </tbody>
</table>


</div>



</div>
</div>

 
 
<?php

/*

 


<h4>Basic Commands</h4>
 
<pre class="bg-light">


$orderadd = $CORE->ORDER('add', array('order_id', 'order_status','user_id'));

$CORE->ORDER("get_type", $orderid);

$CORE->ORDER("get_status", $orderid);

$CORE->ORDER("check_exists", $orderid);

$CORE->ORDER("format_id", $orderid);

</pre> 

*/ ?>
