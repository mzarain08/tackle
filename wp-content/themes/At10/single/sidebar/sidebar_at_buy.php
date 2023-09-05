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

global $CORE, $post, $userdata, $CORE_AUCTION;


//1. GET EXPIRY DATE
$expiry_date = get_post_meta($post->ID,'listing_expiry_date',true);
$vv = $CORE->date_timediff($expiry_date);

// END THE AUCTION
if($expiry_date != "" && $vv['expired'] == 1){
    $CORE_AUCTION->_end_auction($post->ID);
}

// GET AUCTION DISPLAY TYPE
$display_type = get_post_meta($post->ID, 'auction_type', true );

// GET CURRENT PRICE
$current_price = get_post_meta($post->ID,'price_current',true);
if(!is_numeric($current_price)){ $current_price = 0; }

// GET RESERVE PRICE
$price_reserve = get_post_meta($post->ID,'price_reserve',true);
if(!is_numeric($price_reserve)){ $price_reserve = 0; }

// GET THE BIDING TYPE
$auction_type_credit = get_post_meta($post->ID,'auction_type_credit',true);
if($auction_type_credit == ""){ $auction_type_credit = 0; }

// GET BUY NOW PRICE
$bin_price = get_post_meta($post->ID,'price_bin',true);

// GET SHIPPING OST
$price_shipping = get_post_meta($post->ID,'price_shipping',true);
if($price_shipping == "" || !is_numeric($price_shipping)){$price_shipping = 0; }

if($bin_price > 0 && $price_shipping > 0){
    $bin_price = $bin_price+ $price_shipping;
}

$bin_price = hook_price(array($bin_price,0));

// CHECK FOR QTY
$qty = get_post_meta($post->ID,'qty', true);
if($qty == ""){ $qty = 1; }

// CHECK FOR USER BUY NOW PAYMENT WITH ITEMS
// WHICH HAVE MULTIPLE QTY VALUES

//1. GET EXPIRY DATE
$expiry_date = get_post_meta($post->ID,'listing_expiry_date',true);

// type
$display_type = get_post_meta($post->ID, 'auction_type', true );



// ONLY SHOW IF IS LIVE
if( in_array($post->post_status, array("publish","expired")) ){


// ELEMENTOR PREVIEW
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

    if(is_admin()){

        $vv['expired']  = 0;
        $expiry_date = date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + 30 days") );
        $bin_price = 100;
        $current_price = 50;

    }


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

    if($expiry_date  == "" || $vv['expired'] == 1){



        _ppt_template( 'single/sidebar/sidebar_at_end' );


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


    }else{ ?>



        <div class="fieldset" id="buybox-price" <?php if($display_type ==2 && $bin_price == "0"){ echo "style='display:none;'"; } ?>>





            <div id="bidding_highest_bidder" class="small"></div>


            <?php /*** SHIPPING */ ?>
            <?php if($price_shipping > 0){ ?>
                <div class="small mb-3 mt-n1"> <i class="fal fa-box mr-2"></i> <?php echo __("Shipping cost","premiumpress"); ?>: <span class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo hook_price(array($price_shipping,0)) ; ?></span> </div>
            <?php } ?>





            <?php if(!isset( $GLOBALS['timer-set'])){  ?>
                <div class="top-header mb-4">
                    <div id="buybox-timer" class="clearfix p-0"></div>
                </div>

                <div id="auction_timer_layout_single_side" style="display:none;">
                    <di class="box-count-down "> <span class="countdown-lastest is-countdown"> <span class="box-count" ppt-border1><span class="number text-dark">{dn}</span><span class="text text-dark"><?php echo __("Days","premiumpress"); ?></span></span> <span class="dot">:</span> <span class="box-count" ppt-border1><span class="number text-dark">{hnn}</span> <span class="text text-dark"><?php echo __("Hrs","premiumpress"); ?></span></span> <span class="dot">:</span> <span class="box-count" ppt-border1><span class="number text-dark">{mnn}</span> <span class="text text-dark"><?php echo __("Mins","premiumpress"); ?></span></span> <span class="dot">:</span> <span class="box-count" ppt-border1><span class="number text-dark">{snn}</span> <span class="text text-dark"><?php echo __("Secs","premiumpress"); ?></span></span> </span> </di>
                </div>

            <?php } ?>





            <?php


            /*** BID BOX ***/ if($display_type != 2){ $GLOBALS['flag-show-bidbox'] = 1; ?>



                <div class="buynowlisting">

                    <a href="javascript:void(0);" <?php if($userdata->ID){ ?> onclick="processBidPop();" <?php }else{ ?>onclick="processLogin(1,'');"<?php } ?> class=" btn-primary mobile-buynow-trigger list btn-block btn-lg mb-3" data-ppt-btn>
                        <span><?php echo __("Bid Now","premiumpress"); ?></span>
                        <span class="buybox-price-num <?php echo $CORE->GEO("price_formatting",array()); ?>"><?php if(is_admin()){echo "50."; } ?>00</span>

                    </a>
                </div>



            <?php } /** END BIDDING OPTIONS */  ?>




            <?php /*** BUY NOW ***/

            $cleanedBP = str_replace(",","",$bin_price);


            if(is_numeric($cleanedBP) && $cleanedBP > 0.00  && ( ( $cleanedBP >= $current_price && $cleanedBP >= $price_reserve ) || ( $display_type == 2) )){
            ?>
            <style>
                .buynowsidebar{ padding:10px 20px; margin: 10px 0; text-align: left;background-color: #ffc30096; border-radius: 10px; width:100%; }
                .buynowsidebar .col-md-6, .buynowsidebar .col-md-4{ padding:5px; background:white;border-radius: 5px; margin:5px; border: 1px solid black; }
                .buynowsidebar .form-control{ height:26px; }
                 .buynowsidebar .input-container {max-width: 40px;float:left;}
                .buynowsidebar input[type="text"] {
                    width: 100%;
                }
            </style>

            <form method="post" action="" name="buynowform" id="buynowform">
                <input type="hidden" name="auction_action" value="buynow" />
                <input type="hidden" name="buyqty" id="buyqty" value="" />
                <input type="hidden" name="pricetotal" id="pricetotal" value="" />
            </form>
            <?php $qty = get_post_meta($post->ID,'qty', true);if ($qty < 1) { $qty = 0;}?>
            <div class="_header buynowsidebar">
                <div class="row error"></div>
                <div class="row"> <div class="col-md-6">Price Each Plus Shipping</div>                   <div class="col-md-4 price" data-price="<?php echo $bin_price;?>"  ><em class="<?php echo $CORE->GEO("price_formatting",array()); ?>"><?php echo $bin_price; ?></em> </div>                     </div>
                <div class="row"> <div class="col-md-6">Quantity Available</div>           <div class="col-md-4" id="quantity" data-qty="<?php echo $qty;?>"><?php echo $qty;?></div></div>
                <div class="row"> <div class="col-md-6">Quantity To Buy</div>              <div class="col-md-4">
                        <!--<input class="form-control" type="number" value="1" name="qtytobuy" id="qtytobuy" onchange="calculateTotal()" >-->
                        <button id="minus" style="float:left;margin-right:5px;">−</button>
                        <div class="input-container">
                            <input type="text" placeholder="" name="qtytobuy" id="qtytobuy" value="1" >
                        </div>
                        <button id="plus" style="float:right">+</button>
                    </div></div>
                <div class="row"> <div class="col-md-6">Total Order value</div>            <div class="col-md-4 <?php echo $CORE->GEO("price_formatting",array()); ?>" id="totalordervalue" style="font-weight:bold;"><!--<em class="<?php /*echo $CORE->GEO("price_formatting",array()); */?>">--><?php echo $bin_price; ?></em></div></div></div>
        </div>

        <?php if($userdata->ID){ ?>
            <button type="button" <?php if($userdata->ID != $post->post_author){ ?> onclick="processbuynow();" <?php }else{ ?> onclick="alert('<?php echo __("You cannot bid on your own items.","premiumpress"); ?>');"<?php } ?>
                    class="btn-primary buynowbtn list btn-block btn-lg" data-ppt-btn>

  <span> <?php echo __("Buy Now","premiumpress"); ?> <!--<em class="<?php /*echo $CORE->GEO("price_formatting",array()); */?>"><?php /*echo $bin_price; */?></em></span>-->
            </button>
        <?php }else{ ?>

            <a href="javascript:void(0);" onclick="processLogin(1,'');" class="list btn-primary btn-block btn-lg" data-ppt-btn>
                <span><?php echo __("Buy Now","premiumpress"); ?></span>  <!--<em class="<?php /*echo $CORE->GEO("price_formatting",array()); */?>"><?php /*echo $bin_price; */?></em>-->
            </a>
        <?php } ?>

        <script>

            function processbuynow(){

                <?php if(_ppt(array('mem','enable'))  == '1' && _ppt(array('mem','register'))  == '1' && $CORE->USER("membership_active", $userdata->ID) == 0){ ?>
                alert("<?php echo __("You need an active membership to use this feature.","premiumpress"); ?>");
                return;
                <?php } ?>

                if(confirm("<?php echo trim(__("Are you sure?","premiumpress")); ?>"))
                {
                    document.getElementById('buyqty').value = document.getElementById('qtytobuy').value;

                    jQuery("#buynowform").submit();

                }

            }

        //Update the qunatity
            const minusButton = document.getElementById('minus');
            const plusButton = document.getElementById('plus');
            const inputField = document.getElementById('qtytobuy');
            const singlePiecePrice = parseFloat(document.querySelector('.price').dataset.price.replace(/,/g, ''));
            const availableQuantity = parseInt(document.getElementById("quantity").textContent);
            const totalPriceElement = document.getElementById('totalordervalue');

            // Function to recalculate total price
            function recalculateTotal(currentValue) {
                if (currentValue < 1) {
                    currentValue = 1;
                } else if (currentValue > availableQuantity) {
                    currentValue = availableQuantity;
                }

                inputField.value = currentValue;

                // Calculate the total price when quantity changes
                const totalAmount = singlePiecePrice * currentValue;
                totalPriceElement.textContent = totalAmount.toFixed(2);
                document.getElementById('pricetotal').value = totalAmount;
            }

            // Initialize the total price based on the initial quantity
            recalculateTotal(parseInt(inputField.value));

            minusButton.addEventListener('click', event => {
                event.preventDefault();
                let currentValue = parseInt(inputField.value) || 0;
                currentValue--;

                recalculateTotal(currentValue);
            });

            plusButton.addEventListener('click', event => {
                event.preventDefault();
                let currentValue = parseInt(inputField.value) || 0;
                currentValue++;

                recalculateTotal(currentValue);
            });

            // Listen for input changes and recalculate total
            inputField.addEventListener('input', () => {
                const currentValue = parseInt(inputField.value) || 0;
                recalculateTotal(currentValue);
            });

        </script>
    <?php } /*** BUY NOW ***/ ?>



        </span>










        <?php if($userdata->ID){ ?>
            <div class="bidmanlink" style="display:none;"> <small><a href="<?php echo _ppt(array('links','myaccount')); ?>?showtab=offers" class="btn bg-white btn-block mt-2 tiny text-uppercase"><?php echo __("Manage My Bids","premiumpress"); ?></a></small> </div>
        <?php } ?>

        <?php if($expiry_date  == ""){  ?>
            <script>
                jQuery(document).ready(function(){

                    ajax_load_bidding_history();

                });
            </script>



        <?php }elseif($expiry_date  != ""){  ?>




            <script>



                function refreshBiding() {
                    setTimeout(function () {

                        ajax_load_bidding_history();
                        ajax_load_buybox();

                        refreshBiding();

                    }, 6000);
                }

                function refreshBidingPage() { // every 5 minutes
                    setTimeout(function () {

                        window.open('<?php echo get_permalink($post->ID); ?>', "_self");

                    }, 30000);
                }


                function ajax_set_maxbid() {


                    var bidprice = jQuery('#user_maxbid').val();
                    var ecp = jQuery('.buybox-price-num').html().replace(/[^0-9.,]/g, '');
                    var ecp = Math.round(parseFloat(ecp)*100)/100;
                    var bidprice = Math.round(parseFloat(bidprice)*100)/100;

                    var bidinc = <?php if(_ppt(array('lst', 'at_bidinc' )) == ""){ echo 1; }else{ echo _ppt(array('lst', 'at_bidinc' )); }  ?>;


                    var minbidamount = parseFloat(ecp) + parseFloat(bidinc);

                    if(bidprice > ecp){

                        if(bidprice < minbidamount){
                            alert("<?php echo __("Please enter a value greater than: ".hook_currency_symbol(''),"premiumpress"); ?>"+minbidamount);
                            return false;
                        }



                    }else{
                        alert("<?php echo __("Please enter a value greater than the current auction price.","premiumpress"); ?>");
                        return false;
                    }



                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo get_home_url(); ?>/',
                        data: {
                            auction_action: "set_maxbid",
                            pid: <?php echo $post->ID; ?>,
                            uid: <?php if($userdata->ID){ echo $userdata->ID; }else{ echo 0; } ?>,
                            amount: jQuery('#user_maxbid').val(),
                        },
                        success: function(e) {

                            //jQuery('.singlebidbox').hide();

                            jQuery('.maxbid-price-num').html(jQuery('#user_maxbid').val());

                            // CLEAR VALUE
                            //jQuery('#user_maxbid').val('');

                        },
                        error: function(e) {
                            //alert(e)
                        }
                    })
                }




                function ajax_expire() {
                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo get_home_url(); ?>/',
                        data: {
                            action: "expire_check_listing",
                            pid: <?php echo $post->ID; ?>
                        },
                        success: function(e) {

                            //console.log(e+'<-- ajax_expire');

                            // alert(e);
                            // RELOAD PAGE
                            //window.open('<?php echo get_permalink($post->ID); ?>', "_self");
                        },
                        error: function(e) {
                            //alert("error" + e)
                        }
                    })
                }


                function ajax_load_buybox() {
                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo home_url(); ?>/',
                        data: {
                            auction_action: "buybox_load",
                            pid: <?php echo $post->ID; ?>,
                            uid: <?php if($userdata->ID){ echo $userdata->ID; }else{ echo 0; } ?>,
                        },
                        dataType: 'json',
                        success: function(response) {

                            //console.log(response);

                            if(response.status == "sold"){

                                // RELOAD WINDOW
                                //window.open('<?php echo get_permalink($post->ID); ?>', "_self");

                            }else{

                                // BLINK AFFECT
                                jQuery('#buybox-price').fadeTo('slow', 0.5).fadeTo('slow', 1.0);

                                if(response.price != ""){

                                    jQuery('.buybox-price-num').html(response.price).removeClass('free');
                                    jQuery('.buybox-price-num').addClass('ppt-price');
                                    // REMOVE .00
                                    //var fdate = jQuery('.buybox-price-num').html().toString().replace(/\.00$/,'');
                                    //jQuery('.buybox-price-num').html(fdate);

                                    // UPDATE PRICE DISPLAY
                                    UpdatePrices();


                                }

                                var dateStr =	response.date;
                                var a		=	dateStr.split(' ');
                                var d		=	a[0].split('-');
                                var t		=	a[1].split(':');
                                var finalDate1 = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2],t[2]);

                                //console.log(d[0],(d[1]-1),d[2],t[0],t[1],t[2]);

                                //console.log('single: expiry date: '+response.date + ' --  timer date: (' +finalDate1+') timezone: <?php echo get_option('gmt_offset'); ?> ');

                                jQuery('#buybox-timer').countdown('destroy');

                                jQuery('#buybox-timer').countdown({
                                    until: finalDate1,
                                    layout:jQuery('#auction_timer_layout_single_side').html(),
                                    //format: $this.data( "format" ),
                                    //labels: labels,
                                    timezone: <?php echo get_option('gmt_offset'); ?>,
                                    //compact: true,
                                    //serverSync: ajax_serverSync(),
                                    onExpiry: function(){

                                        jQuery('#buybox-buybox').html('<button class="btn btn-block mt-2 rounded-0 "><?php echo __("Auction Finished","premiumpress"); ?></button>');

                                        // CORE AJAX EXPIRE
                                        ajax_expire();

                                        <?php if($vv['expired'] != 1){  ?>
                                        // RELOAD PAGE
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000);
                                        <?php } ?>


                                    },
                                    alwaysExpire: true,
                                });

                                // USER CREDIT CHANGE
                                jQuery('#buybox-user-credit').html(response.credit);

                            }

                            // UPDATE BIDDING HISTORY
                            ajax_load_bidding_history();

                            UpdatePrices();



                        },
                        error: function(e) {
                            //console.log(e)
                        }
                    })
                }

                function ajax_serverSync() {

                    ajax_load_serverTime('.ggtd');
                    dateStr =	jQuery('.ggtd').val();

                    if(typeof dateStr !== "undefined" && dateStr != "" && dateStr != null){
                        //console.log(dateStr + "<-- gg");
                        return dateStr;

                    }
                }

                function ajax_load_buybox_bid(){


                    <?php if($display_type != 3){ ?>


                    var bidprice = jQuery('#bid_amount').val();
                    var ecp = jQuery('.buybox-price-num').html().replace(/[^0-9.,]/g, '').replace(',', '');
                    var ecp = Math.round(parseFloat(ecp)*100)/100;
                    var bidprice = Math.round(parseFloat(bidprice)*100)/100;

                    var bidinc = <?php if(_ppt(array('lst', 'at_bidinc' )) == ""){ echo 1; }else{ echo _ppt(array('lst', 'at_bidinc' )); }  ?>;


                    var minbidamount = parseFloat(ecp) + parseFloat(bidinc);


                    if(bidprice < ecp){
                        alert("<?php echo __("Please enter a value greater than: ".hook_currency_symbol(''),"premiumpress"); ?>"+ecp);
                        return false;
                    }



                    <?php
                    $history = get_post_meta($post->ID,'current_bid_data',true);
                    if($history == "" || ( is_array($history) && empty($history) ) ){  }else{ ?>

                    if(bidprice > ecp){


                        if(bidprice < minbidamount){

                            alert("<?php echo __("Please enter a value greater than: ".hook_currency_symbol(''),"premiumpress"); ?>"+minbidamount);
                            return false;

                        }


                    }
                    <?php } ?>



                    <?php } ?>




                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo home_url(); ?>/',
                        data: {
                            auction_action: "buybox_bid",
                            pid: <?php echo $post->ID; ?>,

                            <?php if($display_type == 3){ ?>
                            amount: 1, // set penny amount
                            type: "penny",
                            <?php }else{ ?>
                            amount: jQuery('#bid_amount').val(),
                            type: "auction",
                            <?php } ?>

                            <?php if($auction_type_credit == 1){$ctype = "credit"; }elseif($auction_type_credit == 2){ $ctype = "tokens"; }else{  $ctype = "none"; } ?>
                            credit_type: "<?php echo $ctype; ?>",

                            uid: <?php if($userdata->ID){ echo $userdata->ID; }else{ echo 0; } ?>,

                        },
                        dataType: 'json',
                        success: function(response) {

                            //console.log(response);

                            if(response.status == "nocredit"){

                                jQuery('.btn-mainbid').html("<button class='btn sold'><?php echo __("NO CREDIT.","premiumpress"); ?></button>");
                                jQuery('.maxbid').html('');

                            }else if(response.status  == "error_not_greater"){

                                jQuery('#bidding_message').html("<div class='alert alert-danger'><?php echo __("Invalid Amount.","premiumpress"); ?></div>");

                            }else{


                                if( jQuery('#bid_amount').val() > parseFloat(<?php echo str_replace(",","",$bin_price); ?>) ){
                                    jQuery('.buynowbtn').hide();
                                }

                                // CLEAN UP
                                jQuery('#bidding_message').html('');

                            }

                            // RELOAD DATA
                            ajax_load_buybox();

                            // CHECK FOR BID RESULT
                            if(response.outbid == "outbid"){

                                jQuery('#bidding_message').html("<div class='alert alert-danger mt-2 rounded-0'><?php echo __("You've been outbid.","premiumpress"); ?></div>");

                            }else if( response.outbid == "reserve_notmet"){

                                jQuery('#bidding_message').html("<div class='alert alert-warning mt-2 rounded-0'><?php echo __("This item has a reserve price. Your bid was accepted but it will not win the auction because it is less than the users reserve price.","premiumpress"); ?></div>");

                            }else {

                                jQuery('#bidding_message').html("<div class='alert alert-success mt-2 rounded-0 '><i class='fa fa-check float-right mt-1'></i><?php echo __("Bid Added.","premiumpress"); ?></div>").fadeOut(1000).fadeIn(1000).fadeOut(1000).fadeIn(1000);

                            }

                            setTimeout(function () { jQuery('#bidding_message').html(""); }, 6000);

                        },
                        error: function(e) {
                            //console.log(e)
                        }
                    });


                }

            </script>



        <?php } // if not expired ?>






        <input type="hidden" class="ggtd" />
        <script>
            var hbidder_id = 0;

            function ajax_load_bidding_history() {

                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo get_home_url(); ?>/',
                    data: {
                        auction_action: "bidhistory",
                        pid: <?php echo $post->ID; ?>
                    },
                    dataType: 'json',
                    success: function(response) {

                        // UPDATE COUNT
                        jQuery('.bidding_history_count').html(response.total);
                        jQuery('#bidding_history_data').html(response.data);


                        if(response.bidder_high_name != "nobidders" && response.bidder_high_name != ""){


                            jQuery('#nobidders').hide();
                            jQuery('#bidders_high').show();

                            jQuery('#bidders_high_name').html(response.bidder_high_name);

                            <?php if($userdata->ID){ ?>
                            // FLASH FOR NEW BID
                            //console.log(hbidder_id + ' old VS new ' + response.bidder_high_id);
                            if(hbidder_id != response.bidder_high_id && response.bidder_high_id != <?php echo $userdata->ID; ?>){

                                jQuery('.highbidder').addClass('newhighbidder-red').stop().fadeTo('slow', 0.1).fadeTo('slow', 1.0);
                                jQuery('.highbidder').removeClass('newhighbidder-red');

                                // SET VAR FOR NEW BID
                                hbidder_id = response.bidder_high_id;

                            }
                            <?php } ?>

                        }else{

                            jQuery('#nobidders').show();
                            jQuery('#bidders_high').hide();

                        }


                        // RELOAD PAGE
                        //window.open('<?php echo get_permalink($post->ID); ?>', "_self");
                    },
                    error: function(e) {
                        // alert("error" + e)
                    }
                })
            }
        </script>
    <?php } // end auction expired ?>



<?php } ?>