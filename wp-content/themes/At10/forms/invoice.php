<?php global $CORE; 

if(!isset($_GET['invoiceid']) || !is_numeric($_GET['invoiceid']) ){ header('HTTP/1.0 403 Forbidden'); exit;  }

$GLOBALS['dataonly'] = 1; 
$data = $CORE->ORDER("get_order_items", $_GET['invoiceid'] ); 

 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$id = array(
	
	"id" 		=> $CORE->ORDER("format_id", $_GET['invoiceid']),
	"date" 		=> date('Y-m-d H:i:s'),
	"orderid" 	=> "#ORDER 12123323", 
	
	"bill_name" => "John Doe",
	"bill_email" => "johndoe@email.com",
	"bill_phone" => "+123 456 789",
	"bill_address" => "28 New Queen Streeet, Upper London Town. London. UK",

	"company_name" => "John Doe",
	"company_email" => "johndoe@email.com",
	"company_phone" => "+123 456 789",
	"company_address" => "28 New Queen Streeet, Upper London Town. London. UK",

	"invoice_title" => __("Invoice","premiumpress"), 
	
	"shipping_method" 	=> "",
	
	"subtotal" 	=> "100",
	"tax" 		=> "20",
	"shipping" 	=> "10",
	"discount" 	=> "10",
	"total" 	=> "120",
	
	"status" 	=> "Paid",
	
);

foreach($data as $k => $v){
	if(isset($id[$k])){
		$id[$k] = $v;
	}
}
 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

//  border-top:1px solid #ddd; padding-bottom:20px;

?>
<style> 

body { background:#fbfbfb; font-size: 14px; margin-top:30px; }
ul { padding:0px; margin:0px; }
ul li { list-style:none; }
ul li span { width:100%; }

[ppt-invoice] { max-width:800px; margin:auto auto; background:#fff; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);    border: 1px solid #e0e0e0;    border-radius: 0.25rem; padding: 20px;  }
[ppt-invoice] h5 { font-weight:bold; font-size:20px;     border-bottom: 1px solid #ddd;    padding: 10px 0px;  margin: 10px 0px; }
[ppt-invoice] ul li { display: -ms-flexbox;   display: flex; -ms-flex-pack: justify; justify-content: space-between; line-height:30px; }
[ppt-invoice] .txtright { text-align:right; padding-right: 20px; }

.large { font-size:20px; font-weight:bold; }
.xlarge { font-size:40px; font-weight:bold; margin-bottom: 10px; }
.xlarge span { float:right; }

.tt span:first-child { width:30px; margin-right:20px; }
.tt span:nth-child(1) {  }
.tt span:last-child { width:100px;  }
.tt li:first-child { font-weight:bold; }

.subprice { margin-top:30px;}
 

@media print{
[ppt-invoice] { box-shadow:none; border:0px; padding:0px; }
}
@media (min-width: 700.98px) { 
[ppt-invoice] { padding: 50px; }

}
@media (min-width: 575.98px) { 

body { margin-top:30px; }
._wrap { padding-right:40px; }
[ppt-invoice] .reverse {   -ms-flex-direction: row-reverse!important;    flex-direction: row-reverse!important;}
 
[ppt-invoice] ul li.full  span { display:block; margin-top:10px; }

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;

	
}
.col-12 { width:100%; }
.col-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
	position: relative;

}
.col-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
	position: relative;

}


}
 
 
</style>
<?php
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

?>
<section class="p-3" ppt-border1 ppt-invoice>
  <div class="row justify-content-center">
  <div class="col-12">
  
  <div class="xlarge"><?php echo $id['invoice_title']; ?> <span>#<?php echo $id['id']; ?></span></div>
  
  <div><?php echo $id['status']; ?></div> 
  
  </div>
    <div class="col-12">
      <div class="row reverse">

        <div class="col-5">
        
          <h5><?php echo __("Bill to","premiumpress") ?></h5>
          <ul>
            <li><span><?php echo __("Name","premiumpress") ?>:</span> <span><?php echo $id['bill_name']; ?></span> </li>
            <li><span><?php echo __("Email","premiumpress") ?>:</span> <span><?php echo $id['bill_email']; ?></span> </li>
            <li><span><?php echo __("Phone","premiumpress") ?>:</span> <span><?php echo $id['bill_phone']; ?></span> </li>
            <li class="full"><span><?php echo __("Mailing Address","premiumpress") ?></span> <span><?php echo str_replace("<br>",",",$id['bill_address']); ?></span> </li>
          </ul>
          
          <h5><?php echo __("Bill from","premiumpress") ?></h5>
          <ul>
            <li><span><?php echo __("Name","premiumpress") ?>:</span> <span><?php echo $id['company_name']; ?></span> </li>
            <li><span><?php echo __("Email","premiumpress") ?>:</span> <span><?php echo $id['company_email']; ?></span> </li>
            <li><span><?php echo __("Phone","premiumpress") ?>:</span> <span><?php echo $id['company_phone']; ?></span> </li>
            <li class="full"><span><?php echo __("Mailing Address","premiumpress") ?></span> <span><?php echo str_replace("<br>",",",$id['company_address']); ?></span> </li>
          </ul>
          
        </div>
        
        <div class="col-7"><div class="_wrap">
        
  		<h5><?php echo __("Ordered","premiumpress") ?></h5>
          <ul>
            <li><span><?php echo __("Order Ref","premiumpress") ?>:</span> <span><?php echo $id['orderid']; ?></span> </li>
            <li><span><?php echo __("Date &amp; Time","premiumpress") ?>:</span> <span><?php echo hook_date($id['date']); ?></span> </li>
          </ul>
        
          <h5><?php echo __("Items","premiumpress") ?></h5>
          
           <ul class="tt">
           
            <li><span>QTY</span> <span><?php echo __("Description","premiumpress") ?></span> <span><?php echo __("Price","premiumpress") ?></span> </li>
            
            <?php if(isset($data['items']) && !empty($data['items'])){ foreach($data['items'] as $itemID => $items){ foreach($items as $item){ ?>
             <li><span><?php echo $item['qty']; ?>x</span> <span><?php echo $item['name']; ?></span> <span><?php echo hook_price($item['amount']); ?></span> </li> 
           <?php } } } ?>
            
          </ul>
     
          <ul class="subprice">
            <li><span><?php echo __("Subtotal","premiumpress") ?></span> <span class="txtright"><?php echo hook_price($id['subtotal']); ?></span> </li>
            <?php if(is_numeric($id['discount']) && $id['discount'] != 0){ ?>
            <li><span><?php echo __("Discount","premiumpress") ?></span> <span class="txtright"><?php echo hook_price($id['discount']); ?></span> </li>
            <?php } ?>
            
            <?php if(is_numeric($id['tax']) && $id['tax'] != 0 ){ ?>
            <li><span><?php echo __("Tax","premiumpress") ?></span> <span class="txtright"><?php echo hook_price($id['tax']); ?></span></li>
            <?php } ?>
            
            <?php if(is_numeric($id['shipping']) && $id['shipping'] != 0){ ?>
            <li><span><?php echo __("Shipping","premiumpress") ?></span> <span class="txtright"><?php echo hook_price($id['shipping']); ?></span> </li>
            <?php } ?>            
            
            <li class="large"><span><?php echo __("Total","premiumpress") ?></span> <span class="txtright"><?php echo hook_price($id['total']); ?></span> </li> 
          </ul>
          
            <?php if(strlen($id['shipping_method']) > 1){ ?>
            <div style="margin-top:20px; font-weight:600;"><?php echo $id['shipping_method']; ?></div>
            <?php } ?>   
         
         
        </div>
        </div>
      </div>
    </div>
  </div>
  
<div>
 
</div>
  
</section>
