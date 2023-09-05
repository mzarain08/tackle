<?php
/*
Template Name: [PAGE - PAYMENT CALLBACK]
*/
 
get_header(); 

_ppt_template( 'page-before' );
	
	switch($payment_status){ 
	
		case "success": { 
		
			_ppt_template( 'payment', 'thankyou' );
		
		} break;
		
		default: {
		
		 _ppt_template( 'payment', 'error' );
		 
		} 
	
	}


_ppt_template( 'page-after' );

get_footer(); ?>