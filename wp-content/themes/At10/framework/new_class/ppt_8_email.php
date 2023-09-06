<?php


function notify_list(){ global $CORE;


	$data = array(
	
	
	
		"user_registered" => array(	
					
		"name" 		=>  __("New User Registration","premiumpress"),
						
			"desc_admin" =>  __("Sent to the user after they join your website.","premiumpress"), 
			
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s joined the website.","premiumpress")), 
			"desc_to" => __("You joined the website.","premiumpress"),
						 
			"icon" 		=> "fal fa-user-plus",
						
			"email" => array(
					"subject" => "Welcome to our website",
					"body" => "Dear (username)<br><br>Thank you for joining our website.<br><br>Your login details are;<br><br>Username: (username)<br>Password: (password) <br>",
					"shortcodes" => array("username","email","password","first_name","last_name"),
			),
						
	),								
		 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// 
 
 
  		"public_user_unblock" => array(	
					
						"name" =>  "User Unblocked", 	
						
						"desc_from" 	=>  str_replace("%p","%user_to", str_replace("%s","%user_from", __("%s has unblocked %p.","premiumpress"))), 			
						"desc_to" 		=>  str_replace("%s","%user_from", __("%s hasun blocked you.","premiumpress")), 
						
											
						"desc" =>  __("unblocked","premiumpress")." %t",						
						"icon" => "fal fa-check",
		),
		
 		"public_user_block" => array(	
					
						"name" =>  "User Blocked", 	
						
						"desc_from" 	=>  str_replace("%p","%user_to", str_replace("%s","%user_from", __("%s has blocked %p.","premiumpress"))), 			
						"desc_to" 		=>  str_replace("%s","%user_from", __("%s has blocked you.","premiumpress")), 
						
											
						"desc" =>  __("blocked","premiumpress")." %t",						
						"icon" => "fal fa-times",
		),
	 
		"public_user_subscribe" => array(	
					
						"name" =>  "New Subscriber", 	
						
						"desc_from" 	=>  str_replace("%p","%user_to", str_replace("%s","%user_from", __("%s is now frends with %p.","premiumpress"))), 			
						"desc_to" 		=>  str_replace("%s","%user_from", __("%s has added you to their friends list.","premiumpress")), 
						
											
						"desc" =>  __("started following","premiumpress")." %t",						
						"icon" => "fal fa-user",
		),
					
		"public_user_unsubscribe" => array(	
					
						"name" =>  "Subscriber Removed", 	
						
						"desc_from" 	=>  str_replace("%p","%user_to", str_replace("%s","%user_from", __("%s is no longer frends with %p.","premiumpress"))), 			
						"desc_to" 		=>  str_replace("%s","%user_from", __("%s has removed you from their friends list.","premiumpress")), 
						
						 					
						"icon" => "fal fa-user",
	),


// FRIENDS NOTIFICATION
				/*
					"friend_listing_update" => array(	
					
						"name" 		=>  str_replace("%s", $CORE->LAYOUT("captions","1"), __("Friend System - New %s Added","premiumpress")),
						"desc" 		=>  str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Sent to friends of a user who creates a new %s.","premiumpress") ),
						  
						 
						"postid" 	=> true,						 
						"alert" 	=> true,
						"icon" 		=> "fal fa-user",
						
						"replace_username" => true,
						
						"link" 		=> _ppt(array('links','myaccount'))."?showtab=friends",
						"data" 		=> array(
						
								"to" => array(							
									"name" =>  __("Friend Update","premiumpress"),	
									"desc" =>  "%p",								
								),
								 							
						),	
						
						"email" => array(
							"subject" => str_replace("%s", $CORE->LAYOUT("captions","1"),"New %s Added"),
							"body" => str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), "Dear (username)<br><br>A new %s has been added by one of your friends.<br><br>(link)<br><br>"),
						),					
						
					), */

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

					"email" => array(	
					
						"name" =>  __("Email Sent","premiumpress"), 						
						 
						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 
						
						"hide_from_notifications" => true,
											
						"icon" => "fa fa-envelope",
					),
					
					"email_system" => array(	
					
						"name" =>  __("System Email Sent","premiumpress"), 
						 
						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 	
						
						"hide_from_notifications" => true,
											
						"icon" => "fal fa-envelope",
					),
					
					"email_admin" => array(	
					
						"name" =>  __("Admin Sent Email","premiumpress"), 						

						 
						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 
						
						"hide_from_notifications" => true,
											
						"icon" => "fal fa-envelope",
					),
					
					"newsletter" => array(	
					
						"name" =>  __("Newsletter Sent","premiumpress"), 
						 
						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 
						
						"hide_from_notifications" => true,
						
						"icon" => "fal fa-mail-bulk",
					),
					
					"pending_approval" => array(	
					
						"name" =>  __("Pending Approval Email","premiumpress"), 
						 
						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 
						
						"hide_from_notifications" => true,
						
						"icon" => "fal fa-user-check",
					),
					
					
					"admin_dispute" => array(	
					
						"name" =>  __("Admin Dispute","premiumpress"), 

						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 

						"hide_from_notifications" => true,
						
						"icon" => "fal fa-mail-bulk",
					),
					
					
					"admin_cashout" => array(	
					
						"name" =>  __("Admin Cashout","premiumpress"), 

						"desc_from"  =>  __("You were sent an email.","premiumpress"), 			
						"desc_to" 	 =>  __("You were sent an email.","premiumpress"), 

						"hide_from_notifications" => true,
						
						"icon" => "fal fa-mail-bulk",
					),
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	 
		"membership_expired" => array(						
				
			"name" 		=>  __("Membership Expired","premiumpress"),
			
			"desc_admin" =>  __("Sent to a user when their membership has expired.","premiumpress"), 
					 	
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s's membership has expired.","premiumpress")), 			
			"desc_to" =>  __("Your membership has expired.","premiumpress"), 
			
						
						"postid" 	=> false, 
						"alert" 	=> true,
						"icon" => "fal fa-clock",
						
						"email" => array(
							"subject" => "Listing Expired",
							"body" => "Dear (username)<br><br>Your membership has expired.<br><br>You can login to your account anytime to renew and update your membership.",
						),
			),
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

			
		"msg_new" => array(	
					
			"name" 	=>  __("New Message","premiumpress"),
						 		
			"desc_admin" =>  __("Sent to a user when they receive a new message.","premiumpress"), 
					
			"desc_from" 	=>  str_replace("%p","%user_from", str_replace("%s","%user_to", __("You sent a message to %s.","premiumpress"))), 			
			"desc_to" => str_replace("%s","%user_from", __("You have received a new message from %s.","premiumpress")), 
				 		
						
						"hide_from_notifications" => true,
						 
						"alert" => true,
						"icon" => "fal fa-envelope",
						"replace_username" => true,
						
						"link" => _ppt(array('links','myaccount'))."?showtab=messages",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("New Message","premiumpress"),	
								"desc" =>  __("Sent from %s","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Message Sent","premiumpress"),	
								"desc" =>  __("Sent to %s","premiumpress"),								
							),	
						),
						"email" => array(
							"subject" => "New Message",
							"body" => "Dear (username)<br><br>You have received a new message.<br><br>You can login to your account anytime to read your messages.",
						),							 	
						 
		 ),
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		"listing_added" => array(						
						"name" =>  __("New Listing Added","premiumpress"), 
						 
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s has created a new listing.","premiumpress")), 			
						"desc_to" => __("You have created a new listing.","premiumpress"), 
						
						"postid" 	=> true, 
						"icon" => "fal fa-plus",
		),
					
		"listing_update" => array(			
								
						"name" 		=>  __("Listing Updated","premiumpress"),
						 
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s has updated a listing.","premiumpress")), 			
						"desc_to" => __("You have updated a listing.","premiumpress"),
 	
						"postid" 	=> true, 
						"icon" => "fal fa-edit",
		),
					
		"listing_deleted" => array(						
						"name" 		=>  __("Listing Deleted","premiumpress"),
						
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s has deleted a listing.","premiumpress")), 			
						"desc_to" => __("You have deleted a listing.","premiumpress"),

						
						
						"postid" 	=> true, 
						"icon" => "fal fa-trash-alt",
		),
					
		"listing_expired" => array(						
						"name" 		=>  __("Listing Expired","premiumpress"),
						
						
						"desc_admin" =>  __("Sent to a user when their listing has expired.","premiumpress"), 
			
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s's listing has expired.","premiumpress")), 			
						"desc_to" => __("One of your listings has expired.","premiumpress"),

					 	
						"postid" 	=> true, 
						"alert" 	=> true,
						"icon" => "fal fa-clock",
						
						"email" => array(
							"subject" => "Listing Expired",
							"body" => "Dear (username)<br><br>Your listing has expired.<br><br>You can login to your account anytime to renew and update your listings.",
						),
		),
					
					// CONTACT FORM BOX WHEN NOT LOGGED IN
		"listing_message" => array(	
					
						"name" 		=>  __("Contact Form","premiumpress"),
						"desc" 		=>  __("Contact page or listing contact forms.","premiumpress"),
						 
						"desc_from" 	=>  str_replace("%p","%user_from", str_replace("%s","%user_to", __("A guest user has sent a message to %s.","premiumpress"))), 			
						"desc_to" => str_replace("%s","%user_from", __("You have received a new message from a guest user.","premiumpress")), 
		 	 
						"postid" 	=> true,						 
						"alert" 	=> true,
						"icon" 		=> "fal fa-envelope-open-text",
						
						"replace_username" => true,
						
						"link" 		=> _ppt(array('links','myaccount'))."?showtab=messages",
						"data" 		=> array(
						
								"to" => array(							
									"name" =>  __("New Message Received","premiumpress"),	
									"desc" =>  __("from %s","premiumpress"),								
								),
								
								"from" => array(							
									"name" =>  __("New Message Sent","premiumpress"),	
									"desc" =>  __("Sent to %s","premiumpress"),								
								),							
						),	
						
						"email" => array(
							"subject" => "Contact Form",
							"body" => "Dear (username)<br><br>You have received a new message.<br><br>(message)",
						),					
						
		),

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

		"offer_new" => array(	
					
				"name" 		=>  __("New Offer Sent","premiumpress"),
						
						 
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s has been sent a new job request.","premiumpress")), 			
			"desc_to" => __("You have received a new job offer.","premiumpress"),
 						
						
						"postid" 	=> true,  
						"alert" => true,
						"icon" => "fal fa-comments-alt-dollar",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("New Offer Received","premiumpress"),	
								"desc" =>  __("from %s","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("New Offer Sent","premiumpress"),	
								"desc" =>  __("Sent to %s","premiumpress"),								
							),							
						),
						
						"email" => array(
							"subject" => "New Offer Received",
							"body" => "Dear (username)<br><br>You have received a new offer from (from_username).<br><br>You can login to your account anytime to find out more.",
						),
						
					), 
					
			"offer_accepted" => array(						
							 
						"name" 	=>  __("Offer Accepted","premiumpress"),
						 
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s has accepted a job offer.","premiumpress")), 			
						"desc_to" => __("You have accepted a job offer.","premiumpress"),
 
 	 
						"postid" 	=> true, 
						 
						"alert" => true,
						"icon" => "fal fa-smile",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("Offer Accepted","premiumpress"),	
								"desc" =>  __("%s accepted your offer.","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Offer Accepted","premiumpress"),	
								"desc" =>  __("You accepted the offer from %s","premiumpress"),								
							),							
						),
						"email" => array(
							"subject" => "Offer Accepted",
							"body" => "Dear (username)<br><br>An offer you made has been accepted.<br><br>You can login to your account anytime to find out more.",
						),		  
					 
			), 	
					
					
			"offer_rejected" => array(	
					
					"name" 	=>  __("Offer Rejected","premiumpress"),
						 
					"desc_from" 	=>  str_replace("%s","%user_from", __("%s rejected a job offer.","premiumpress")), 			
					"desc_to" => __("You rejected a job offer.","premiumpress"),
					
						 
					"postid" 	=> true, 
						 
						"alert" => true,
						"icon" => "fal fa-frown",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("Offer Rejected","premiumpress"),	
								"desc" =>  __("%s rejected your offer.","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Offer Rejected","premiumpress"),	
								"desc" =>  __("You rejected the offer from %s","premiumpress"),								
							),							
						),
						"email" => array(
							"subject" => "Offer Rejected",
							"body" => "Dear (username)<br><br>An offer you made has been rejected.<br><br>You can login to your account anytime to find out more.",
						),			  
					 
			),
					
			"offer_updated" => array(
					
			"name" 	=>  __("Offer Updated","premiumpress"),
						 
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s has updated the job status.","premiumpress")), 			
			"desc_to" => __("You updated the job status.","premiumpress"),
 							 
						"postid" 	=> true, 						 
						"alert" => true,
						"icon" => "fal fa-sync-alt",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("Offer Updated","premiumpress"),	
								"desc" =>  __("%s updated the offer status.","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Offer Updated","premiumpress"),	
								"desc" =>  __("You have updated the offer status.","premiumpress"),								
							),							
						),
						"email" => array(
							"subject" => "Offer Updated",
							"body" => "Dear (username)<br><br>An offer status has been updated.<br><br>You can login to your account anytime to find out more.",
						),			  
					 
			),
										
			"offer_complete" => array(	
					
				"name" 	=>  __("Offer Completed","premiumpress"),
						 
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s has completed a job","premiumpress")), 			
				"desc_to" => __("You have completed a job.","premiumpress"),

						 
						"postid" 	=> true, 						 
						"alert" => true,
						"icon" => "fal fa-thumbs-up",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("Order Complete","premiumpress"),	
								"desc" =>  __("%s marked the offer as finished.","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Order Complete","premiumpress"),	
								"desc" =>  __("You marked the order complete.","premiumpress"),								
							),							
						)				  
					 
			),
			
			
			
				"offer_dispute" => array(	
					
					"name" 	=>  __("Offer Disputed","premiumpress"),
						 
					"desc_from" 	=>  str_replace("%s","%user_from", __("%s has opened a dispute.","premiumpress")), 			
					"desc_to" => __("You opened a cancelation request.","premiumpress"),
					
						 
					"postid" 	=> true, 
						 
						"alert" => true,
						"icon" => "fal fa-frown",
						"replace_username" => true,
						"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("Cancelation request","premiumpress"),	
								"desc" =>  __("%s has opened a dispute.","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("Cancelation request","premiumpress"),	
								"desc" =>  __("You opened a cancelation request for %s","premiumpress"),								
							),							
						),
						"email" => array(
							"subject" => "Cancelation Request",
							"body" => "Dear (username)<br><br>A cancelation request has been made.<br><br>You can login to your account anytime to find out more.",
						),			  
					 
			),
			
			
		"feedback_receieved" => array(	
					
				"name" =>  __("Feedback Received","premiumpress"), 
						 
				"desc_to" 	=>  str_replace("%p","%user_to", str_replace("%s","%user_from", __("%s has left you feedback.","premiumpress"))), 			
				"desc_from" => str_replace("%s","%user_to", __("You have left feedback for %s.","premiumpress")),
 		
						"icon" => "fal fa-comments",
						"postid" 	=> true,  
						
						"alert" => true,
						"replace_username" => true,
						"link" => "profile",
						"data" => array(
						
							"to" => array(							
								"name" =>  __("New Feedback Received","premiumpress"),	
								"desc" =>  __("from %s","premiumpress"),								
							),
							
							"from" => array(							
								"name" =>  __("New Feedback Sent","premiumpress"),	
								"desc" =>  __("Sent to %s","premiumpress"),								
							),							
						),
						
						"email" => array(
							"subject" => "New Feedback received",
							"body" => "Dear (username)<br><br>You have just received new feedback. <br><br>You can login to your account anytime to view your new feedback.",
						),
						
		),
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	"order" => array(	
					
			"name" =>  __("New Order","premiumpress"),
				
			"desc_admin" =>  __("Sent to a user after they make a new purchase.","premiumpress"), 
			
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s made a new order.","premiumpress")), 
			"desc_to" => __("You placed a new order.","premiumpress"),
											
			"icon" => "fal fa-sack",
						
			"email" => array(
							"subject" => "Payment received - thank you!",
							"body" => "Dear (username)<br><br>Thank you for placing an order on our website. <br><br>You can login to your account anytime to view your invoice.",
				),
						
		), 
		
		
		"comission_invoice" => array(	
					
			"name" =>  __("House Commission Invoice","premiumpress"), 
				
			"desc_from" =>  str_replace("%s","%user_to", __("%s has received a commission invoice.","premiumpress")), 
			"desc_to" 	=> __("You have received a new invoice.","premiumpress"),
											
			"icon" => "fal fa-sack",
			
			"alert" => true, 
				
						
		), 
		
		"comission_taken" => array(	
					
			"name" =>  __("Comission Deducted","premiumpress"), 
				
			"desc_from" =>  str_replace("%s","%user_to", __("%s has been deducted house commission.","premiumpress")), 
			"desc_to" 	=> __("Your account has been deducated the house commission amount.","premiumpress"),
											
			"icon" => "fal fa-sack",
			
			"alert" => true, 
				
						
		), 	 
		
		
		"sms" => array(	
					
			"name" =>  __("SMS Sent","premiumpress"), 
				
			"desc_from" => __("User was sent an SMS message.","premiumpress"), 
			"desc_to" 	=> __("User was sent an SMS message.","premiumpress"),
											
			"icon" => "fal fa-mobile-android",
			
			"alert" => true, 
				
						
		), 	 
		
		
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

					"match_notification" => array(	
					
						"name" 		=>  __("New Match Found","premiumpress"),
						"desc" 		=>  str_replace("%s", strtolower($CORE->LAYOUT("captions","1")), __("Sent to the user when a %s is added that meets a users match criteria.","premiumpress") ),
						 
						 "desc_from" 	=>    str_replace("%s","%user_from", __("%s has a new listing matching your match criteria.","premiumpress")), 			
						"desc_to" 		=>   __("You have a new listing matching your criteria.","premiumpress"), 
						  
						 
						"postid" 	=> true,						 
						"alert" 	=> true,
						"icon" 		=> "fal fa-star",
						
						"replace_username" => true,
						
						"link" 		=> _ppt(array('links','myaccount'))."?showtab=messages",
						"data" 		=> array(
						
								"to" => array(							
									"name" =>  __("New Match Found","premiumpress"),	
									"desc" =>  "%p",								
								),
								 							
						),	
						
						"email" => array(
							"subject" => "New Match Found",
							"body" => "Dear (username)<br><br>A new listing has been added which meets your match criteria.<br><br>(link)<br><br>",
						),					
						
					), 
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	"user_verify" => array(	
					
		"name" 		=>  __("Verify Email Address","premiumpress"),
		
			"desc_admin" =>  __("Sent to the user to verify their email address.","premiumpress"), 
			
		
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s was sent an email to verify their email address.","premiumpress")), 
			"desc_to" => __("You were sent an email to verify your email address.","premiumpress"),	 		
		 	
			"icon" 		=> "fal fa-award",
						
			"email" => array(
					"subject" => "Please verify your email.",
					"body" => "Dear (username)<br><br>Thank you for joining our website.<br><br>Please use the link below to verify your email address.<br><br> (vlink) <br>",
					"shortcodes" => array("username","email","vlink","first_name","last_name"),
			),
						
	),
				
				
			
					
	"user_password" => array(	
						
			"name" =>  __("Account Password Updated","premiumpress"), 
						
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s updated their account password.","premiumpress")), 
			"desc_to" => __("You updated your account password.","premiumpress"),	
						
			"icon" => "fal fa-user-cog",	
	),
					
					
	  "user_photo" => array(	
	  					
			"name" =>  __("User Photo Updated","premiumpress"),	

			
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s updated their display photo.","premiumpress")), 
			"desc_to" => __("You updated your display photo.","premiumpress"),	 
			
			"icon" => "fal fa-user-circle",
							
		),
					
		"user_login" => array(
		
			"name" =>  __("User Login","premiumpress"),
			 
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s has logged in.","premiumpress")), 
			"desc_to" => __("You have logged in to your account.","premiumpress"),	 
			
			"icon" => "fal fa-user",
			
			"hide_from_user" => true,
		),
		
		"user_logout" => array(
		
			"name" =>  __("User Logout","premiumpress"),
			 
			"desc_from" 	=>  str_replace("%s","%user_from", __("%s logged out of their account.","premiumpress")), 
			"desc_to" => __("You logged out of your account.","premiumpress"),	 
			
			"icon" => "fal fa-user-slash",
			
			"hide_from_user" => true,
		),

					
		"user_update" => array(						
						
				"name" 			=>  __("Account Update","premiumpress"), 
										
				"desc_to" 		=> __("You updated your account details.","premiumpress"), 
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s updated their account details.","premiumpress")), 	
									
				"icon" 			=> "fal fa-user-edit",
					
			),
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	
	);
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

	if(defined('THEME_KEY') && THEME_KEY == "at"){
	
	$at_update = array(
	
	
			"offer_new" 		=> array(  
				
				"name" 			=>  __("New Bid","premiumpress"),		 
				"desc_from" 	=>  str_replace("%s","%post_name", __("You have bid on %s","premiumpress")), 			
				"desc_to" 		=> str_replace("%s","%post_name", __("You have received a bid on %s.","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Auction Won","premiumpress"),
				"desc_from" 	=> str_replace("%s","%post_name", __("Your item has been sold. %s","premiumpress")),
				"desc_to" 		=>  str_replace("%s","%post_name", __("You have won an auction. %s","premiumpress")), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Auction Outbid","premiumpress"),
				"desc_to" 		=>  str_replace("%s","%user_from", __("%s has been outbid.","premiumpress")), 			
				"desc_from" 	=> __("You've been outbid.","premiumpress"),
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Auction Status Updated","premiumpress"),	 
				"desc_from" 	=> str_replace("%s","%post_name", __("The item status for %s has been updated.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name", __("The item status for %s has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Auction Completed","premiumpress"),		 
				"desc_from" 	=>  str_replace("%s","%user_to", __("The auction is complete.","premiumpress")), 			
				"desc_to" 		=> __("The auction is now complete.","premiumpress"),
			),
			

		// AUCTION THME
		"at_auction_ended" => array(	
					
			"name" 	=>  __("Auction Ended","premiumpress"),
						
			"desc_from" 	=>  str_replace("%s","%post_name", __("The auction %s has ended.","premiumpress")), 
			"desc_to" => str_replace("%s","%post_name",__("Your auction %s has ended.","premiumpress")),	 
				 		 
				"alert" => true,
				"icon" => "fal fa-clock",
						
				"link" => _ppt(array('links','myaccount'))."?showtab=offers",
						 	
						"email" => array(
							"subject" => "Auction Ended",
							"body" => "Dear (username)<br><br>An auction you were watching has ended.<br><br>You can login to your account anytime to view your auctions.",
						),							 	
						 
				), 
		);
		
		
		
		// UPDATE
		$data = array_replace_recursive($data, $at_update);
	}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "pj"){ 
	
		$rt_update = array(
		
			"offer_new" 		=> array(  
				
				"name" 			=>  __("New Offer","premiumpress"),		 
				"desc_from" 	=>  str_replace("%p","%post_name", str_replace("%s","%user_from", __("You have made an offer on %p.","premiumpress"))), 			
				"desc_to" 		=>  str_replace("%s","%post_name", __("You have received a new offer for %s","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Offer Accepted","premiumpress"),
				"desc_from" 	=>  str_replace("%s","%post_name", __("You accepted the offer for %s.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name",__("Your offer was accepted for %s","premiumpress")), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Offer Rejected","premiumpress"),
				"desc_from" 	=> str_replace("%p","%post_name", str_replace("%s","%user_from", __("You rejected the offer for %p.","premiumpress"))), 
				"desc_to" 		=>  str_replace("%s","%post_name",__("The offer was rejected for %s","premiumpress")), 
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Offer Updated","premiumpress"),	 
				"desc_from" 	=> str_replace("%s","%post_name", __("The offer %s has been updated.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name", __("The offer for %s has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Sale Complete","premiumpress"),		 
				"desc_from" 	=>  __("The sale is now complete.","premiumpress"),			
				"desc_to" 		=> __("The sale is now complete.","premiumpress"),
			),
		
		
		);
		$data = array_replace_recursive($data, $rt_update);
	}	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "ct"){ 
	
		$rt_update = array(
		
			"offer_new" 		=> array(  
				
				"name" 			=>  __("New Offer","premiumpress"),		 
				"desc_from" 	=>  str_replace("%p","%post_name", str_replace("%s","%user_from", __("You have made an offer on %p.","premiumpress"))), 			
				"desc_to" 		=>  str_replace("%s","%post_name", __("You have received a new offer for %s","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Offer Accepted","premiumpress"),
				"desc_from" 	=>  str_replace("%s","%post_name", __("You accepted the offer for %s.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%user_from",__("Your offer was accepted by %s","premiumpress")), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Offer Rejected","premiumpress"),
				"desc_from" 	=> str_replace("%p","%post_name", str_replace("%s","%user_from", __("You rejected the offer for %p.","premiumpress"))), 
				"desc_to" 		=>  str_replace("%s","%post_name",__("The offer was rejected for %s","premiumpress")), 
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Offer Updated","premiumpress"),	 
				"desc_from" 	=> str_replace("%s","%post_name", __("The offer %s has been updated.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name", __("The offer for %s has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Sale Complete","premiumpress"),		 
				"desc_from" 	=>  __("The sale is now complete.","premiumpress"),			
				"desc_to" 		=> __("The sale is now complete.","premiumpress"),
			),
		
		
		);
		$data = array_replace_recursive($data, $rt_update);
	}
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "rt"){ 
	
		$rt_update = array(
		
			"offer_new" 		=> array(  
				
				"icon" => "fal fa-home",
				
				"name" 			=>  __("House Viewing","premiumpress"),		 
				"desc_to" 	=>  str_replace("%p","%post_name", str_replace("%s","%user_from", __("%s has requested to view %p.","premiumpress"))), 			
				"desc_from" 		=>  str_replace("%s","%post_name", __("You have requested to view %s.","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Viewing Accepted","premiumpress"),
				"desc_to" 		=>  str_replace("%s","%post_name", __("Your request to view %s was accepted.","premiumpress")), 	
				"desc_from" 	=>  str_replace("%s","%post_name",__("You have accepted the viewing on %s.","premiumpress")), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Viewing Declined","premiumpress"),
				"desc_to" 	=> str_replace("%s","%user_from", __("%s has declined your request.","premiumpress")), 
				"desc_from" 		=>  __("You have cancelled the viewing request.","premiumpress"), 
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Viewing Status Updated","premiumpress"),	 
				"desc_to" 	=> str_replace("%s","%post_name", __("The item status for %s has been updated.","premiumpress")), 	
				"desc_from" 		=>  str_replace("%s","%post_name", __("The item status for %s has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Viewing Complete","premiumpress"),		 
				"desc_to" 		=>  __("The viewing is now complete.","premiumpress"),			
				"desc_from" 	=> __("The viewing is now complete.","premiumpress"),
			),
		
		
		);
		$data = array_replace_recursive($data, $rt_update);
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "jb"){ 
	
		$jb_update = array(
		
			"offer_new" 		=> array(  
				
				"name" 			=>  __("New Job Interview","premiumpress"),		 
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s has applied for a job interview.","premiumpress")), 			
				"desc_to" 		=>  str_replace("%s","%post_name", __("You have applied for a job interview.","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Interview Accepted","premiumpress"),
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s has accepted a job interview request.","premiumpress")), 	
				"desc_to" 		=>  __("You have accepted the job interview request.","premiumpress"), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Interview Cancelled","premiumpress"),
				"desc_from" 	=> str_replace("%s","%user_from", __("%s has declined the job interview request.","premiumpress")), 
				"desc_to" 		=>  __("You have declined the job interview request.","premiumpress"), 
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Interview Status Updated","premiumpress"),	 
				"desc_from" 	=> str_replace("%s","%post_name", __("The item status for interview has been updated.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name", __("The item status for interview has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Interview Complete","premiumpress"),		 
				"desc_from" 	=>  __("The interview is now complete.","premiumpress"),			
				"desc_to" 		=> __("The interview is now complete.","premiumpress"),
			),
		
		
		);
		$data = array_replace_recursive($data, $jb_update);
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "ll"){ 
	
		$ll_update = array(
		
			"offer_new" 		=> array(  
				
				"name" 			=>  __("New Application","premiumpress"),		 
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s has applied to join a course.","premiumpress")), 			
				"desc_to" 		=>  str_replace("%s","%post_name", __("You have applied to join a course.","premiumpress")),		
						
			),
						
			"offer_accepted" 	=> array(	 				
				
				"name" 			=>  __("Application Accepted","premiumpress"),
				"desc_from" 	=>  str_replace("%s","%user_from", __("%s has accepted a new student.","premiumpress")), 	
				"desc_to" 		=>  __("You have accepted a new student.","premiumpress"), 			
				
 			),
			
			"offer_rejected" 	=> array(	
				
				"name" 			=>  __("Application Declined","premiumpress"),
				"desc_from" 	=> str_replace("%s","%user_from", __("%s has declined the application.","premiumpress")), 
				"desc_to" 		=>  __("You have declined the application.","premiumpress"), 
			),
			
			"offer_updated" 	=> array(
			 	
				"name" 			=>  __("Application Updated","premiumpress"),	 
				"desc_from" 	=> str_replace("%s","%post_name", __("The item status for application has been updated.","premiumpress")), 	
				"desc_to" 		=>  str_replace("%s","%post_name", __("The item status for application has been updated.","premiumpress")), 				
				
			),
			
			"offer_complete" 	=> array(	 // this is being hit twice
				 
				"name" 			=>  __("Application Complete","premiumpress"),		 
				"desc_from" 	=>  __("The application is now complete.","premiumpress"),			
				"desc_to" 		=> __("The applicationis now complete.","premiumpress"),
			),
		
		
		);
		$data = array_replace_recursive($data, $ll_update);
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "dt"){ // DT THEME 
	
		$mj_update = array(
		 		 
			"dt_claimed" => array(						
						 
						"alert" => true,
						"icon" => "fal fa-funnel-dollar",
						 
						"link" => _ppt(array('links','myaccount'))."?showtab=messages",						 					
						 						
						"name" =>  __("New Listing Claimed","premiumpress"),	
						 	
						"desc_to" 	=>  str_replace("%s","%user_from", __("%s has claimed a new listing.","premiumpress")), 			
						"desc_from" => __("You have claimed a business page.","premiumpress"),
						 						 	
						 
			 ),
			
	
		);
		
		// UPDATE
		$data = array_replace_recursive($data, $mj_update);
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && THEME_KEY == "mj"){ // MJ THEME IS BACKWARDS
	
		$mj_update = array(
		
			"offer_new" => array(  
			
				"name" 			=>  __("New Job","premiumpress"),				 
				"desc_from" 	=>  str_replace("%s","%user_to", __("A new job offer was sent to %s.","premiumpress")), 			
				"desc_to"		=> __("You have received a new job offer.","premiumpress"),		
						
			),
						
			"offer_accepted" => array(	 				
				
				"name" 		=>  __("Job Accepted","premiumpress"), 	 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s has accepted the job and will begin work.","premiumpress")), 			
				"desc_from" => __("You have accepted the job.","premiumpress"),
 			),
			
			"offer_rejected" => array(	
				
				"name" 		=>  __("Job Rejected","premiumpress"),		 		 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s rejected a job offer.","premiumpress")), 			
				"desc_from" => __("You rejected a job offer.","premiumpress"),
			),
			
			"offer_updated" => array(
			 	
				"name" 		=>  __("Job Updated","premiumpress"),	 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s has updated the job status.","premiumpress")), 			
				"desc_from" => __("You updated the job status.","premiumpress"),
				
			),
			
			"offer_complete" => array(	
				 
				"name" 		=>  __("Job Completed","premiumpress"),		 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s has completed a job","premiumpress")), 			
				"desc_from" => __("You have completed a job.","premiumpress"),
			),
			
	 		 				 
			"mj_credit_added" => array(						
						 
						"alert" => true,
						"icon" => "fal fa-funnel-dollar",
						 
						"link" => _ppt(array('links','myaccount'))."?showtab=messages",						 					
						 						
						"name" =>  __("New Credit Added","premiumpress"),	
						 	
						"desc_from" 	=>  str_replace("%s","%user_from", __("%s has received account credit.","premiumpress")), 			
						"desc_to" => __("You have received new account credit.","premiumpress"),
							
						
						"email" => array(
							"subject" => "New Credit Added",
							"body" => "Dear (username)<br><br>Your account has been updated with new credit.<br><br>You can login to your account anytime to find out more.",
						),							 	
						 
			 ),
			
	
		);
		
		// UPDATE
		$data = array_replace_recursive($data, $mj_update);
	}
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
	
	
	if(defined('THEME_KEY') && in_array(THEME_KEY, array("da","es")) ){ 
	
		$mj_update = array(
		
			"da_wink" => array(  
			
				"name" 			=>  __("New Wink","premiumpress"),				 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s has sent you a wink.","premiumpress")), 			
				"desc_from"		=> str_replace("%s","%user_to", __("You have sent %s a wink.","premiumpress")),	
				
				"icon" => "fal fa-smile",	
						
			),
			
			"da_gift" => array(  
			
				"name" 			=>  __("New Gift","premiumpress"),				 
				"desc_to" 	=>  str_replace("%s","%user_from", __("%s has sent you a gift.","premiumpress")), 			
				"desc_from"		=> str_replace("%s","%user_to", __("You have sent %s a gift.","premiumpress")),	
				
				"icon" => "fal fa-smile",	
						
			),
		
		);
	
		// UPDATE
		$data = array_replace_recursive($data, $mj_update);
	}
	
		
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
	
	return $data;

}

class framework_email extends framework_updates {

	function EMAIL($action='add', $order_data = "123"){
	
	global $userdata, $wpdb, $CORE;
	 
		switch($action){
			
	 		case "newsletter_unsubscribe": {
			
				// CHECK EXISTS
				$ores = $wpdb->get_results("SELECT post_id as uid FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'news_email' AND meta_value = ('".esc_sql($order_data['email'])."') LIMIT 1 ");
				 
				if(!empty($ores)){
					 
					wp_delete_post($ores[0]->uid, true);
				
				}
				
				return 0;
			
			} break;
			
			case "newsletter_confirm": {
			
				// CHECK EXISTS
				$ores = $wpdb->get_results("SELECT post_id as uid FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'news_hash' AND meta_value = ('".esc_sql($order_data['hash'])."') LIMIT 1 ");
				 
				if(!empty($ores)){
												
					update_post_meta($ores[0]->uid, "news_verified", "yes");
				
				}
				
				return 0;			
			
			} break;
			
			case "newsletter_add": {
			
				// CHECK EXISTS
				$ores = $wpdb->get_results("SELECT post_id as uid FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'news_email' AND meta_value = ('".esc_sql($order_data['email'])."') LIMIT 1 ");
				 
				if(empty($ores)){
			
					$my_post = array();				
					$my_post['post_title'] 		= $order_data['email']; 
					$my_post['post_type'] 		= "ppt_newsletter"; 
					$my_post['post_status'] 	= "publish";
					$my_post['post_content'] 	= ""; 		
					$uid = wp_insert_post( $my_post );
					
					add_post_meta($uid, "news_email", $order_data['email']);
					add_post_meta($uid, "news_hash", $order_data['hash']);					
					add_post_meta($uid, "news_verified", $order_data['verified']);
					
					
					return $uid;
				
				}else{
				
					return $ores[0]->uid;
					
				}  
				 
			
			} break;
			
			case "get_all": {
			
				$emails = array( );
				
				return $emails;			
			
			} break;
			
			case "count_email": {
			
				$SQL = "SELECT count(*) AS total FROM ".$wpdb->base_prefix."postmeta WHERE meta_key = 'log_emailid' AND meta_value = '".$order_data."'";					 
				$result = $wpdb->get_results($SQL);
				if(empty($result)){ 
				
					return 0;
				}
				  
				return $result[0]->total;			
			
			} break;
			
			
			case "get_admin_emails": {
			
				$emails = array( 	
				
				
				
						"admin_user_new" => array(
							
							"name" => __("New User Registration","premiumpress"),
							"desc" => __("Sent to admin when a new user joins.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "Admin Email [Listing Expired]",
								"body" 		=> "Dear Admin<br><br>A new user has just signed up;<br><br> User: (username) <br> Email: (email)<br> User ID: (user_id) <br><br>Regards <br><br>System Email",
							),
						),					
						
						
							"admin_user_login" => array(
							
							"name" => __("User Login","premiumpress"),
							"desc" => __("Sent to admin when a user logins in.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "User Login Detected",
								"body" 		=> "Dear Admin<br><br>A user has just logged in;<br><br> User: (username) <br> Email: (email)<br> User ID: (user_id) <br>Date (date) (time)  <br>Website (website) <br><br>Regards <br><br>System Email",
							),
						),
						
									
									
						"admin_listing_new" => array(
							
							"name" => __("Listing Added","premiumpress"),
							"desc" => __("Sent to admin when a new listing is added.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "Admin Email [Listing Added]",
								"body" 		=> "Dear Admin<br><br>A user listing (title) has been added by (username);<br><br> (link)<br><br>Regards <br><br>System Email",
							),
							
						),
						"admin_listing_update" => array(
							
							"name" => __("Listing Updated","premiumpress"),
							"desc" => __("Sent to admin when a listing is updated.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "Admin Email [Listing Updated]",
								"body" 		=> "Dear Admin<br><br>A user listing (title) has been updated by (username);<br><br> (link)<br><br>Regards <br><br>System Email",
							),
						),	
						
						"admin_listing_expire" => array(
							
							"name" => __("Listing Expired","premiumpress"),
							"desc" => __("Sent to admin when a listing has expired.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "Admin Email [Listing Expired]",
								"body" 		=> "Dear Admin<br><br>A user listing (title) has expired;<br><br> (link)<br><br>User: (username) <br><br>Regards <br><br>System Email",
							),
						),	
						
						
						"admin_order_new" => array(
							
							"name" => __("New Order","premiumpress"),
							"desc" => __("Sent to admin when a new order is added.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "Admin Email [New Order]",
								"body" 		=> "Dear Admin<br><br>(from_username) has placed a new order.<br><br> (post_name)<br><br>Total: (total) <br><br>Regards <br><br>System Email",
							),
						),	
						
						/*
						"admin_news" => array(
							
							"name" => __("New News Request","premiumpress"),
							"desc" => __("Sent to admin when a new news request is made.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "New News Request",
								"body" 		=> "Dear Admin<br><br>(from_username) has added a new news request. <br><br>Regards <br><br>System Email",
							),
						),	
						*/
											
						"admin_cashback" => array(
							
							"name" => __("New Cashback Request","premiumpress"),
							"desc" => __("Sent to admin when a new cashback request is made.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "New Cashback Request",
								"body" 		=> "Dear Admin<br><br>(from_username) has added a new cashback request. <br><br>Regards <br><br>System Email",
							),
						),
						
						"admin_cashout" => array(
							
							"name" => __("New Cashout Request","premiumpress"),
							"desc" => __("Sent to admin when a new cashout request is made.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "New Cashout Request",
								"body" 		=> "Dear Admin<br><br>A new cashout request has been made. <br><br>Regards <br><br>System Email",
							),
						),
						
						/*
							"admin_account_update" => array(
							
							"name" => __("Account Details Changed","premiumpress"),
							"desc" => __("Sent to admin when someone updates their account details.","premiumpress"),
							
							"email" => array(
							
								"subject" 	=> "User Details Updated",
								"body" 		=> "Dear Admin<br><br>User (username) has updated their account details.<br><br> (link)<br><br>Regards <br><br>System Email",
							),
							
						),
						*/
						
						
				
				);
				
				if(!$CORE->LAYOUT("captions","listings")){
				
					unset($emails['admin_listing_new']);
					unset($emails['admin_listing_update']);
					unset($emails['admin_listing_expire']);
					
				}
				
				if(_ppt(array('user','cashout')) != "1"){ 
					unset($emails['admin_cashout']);
				}
				
				if(defined('THEME_KEY') && THEME_KEY  != "cp"){ 
				
					unset($emails['admin_cashback']);
				
				}
				
				return $emails;			
			
			} break;			
			
			
			
		}
	}


 	
	
/*
	this function sends daily emails to users
	if any are required
*/	
function cron_emails(){ global $wpdb, $CORE;

	if(is_numeric(_ppt(array('emails','event_5days'))) != ""){
	
		// CHECK EVENTS
		/*
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'date' AND mt2.meta_value LIKE '%".date("Y-m-d", strtotime( "+5 days") )."%'  ) 
			WHERE ".$wpdb->prefix."posts.post_type = 'event' 
			AND ".$wpdb->prefix."posts.post_status = 'publish'
			LIMIT 50";
		
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
			foreach($result as $r){
			
			$data = array(			
			"name" => get_the_title($r->ID),
			"link" => get_permalink($r->ID),
			"date" => get_post_meta($r->ID,"date", true),
			"price" => get_post_meta($r->ID,"price", true),
			"location" => get_post_meta($r->ID,"location", true),
			 
			); 
		
			$this->email_system("allusers", 'event_5days', $data);
			
			}// end foreach
		} // end if empty
		
		*/
		
	} // END EMAIL
	
	
	
	if(is_numeric(_ppt(array('emails','event_1day'))) != ""){
	
		// CHECK EVENTS
		// 
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'date' AND mt2.meta_value LIKE '%".date("Y-m-d" )."%'  ) 
			WHERE ".$wpdb->prefix."posts.post_type = 'event' 
			AND ".$wpdb->prefix."posts.post_status = 'publish'
			LIMIT 50";
		
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
			foreach($result as $r){
			
			$data = array(			
			"name" => get_the_title($r->ID),
			"link" => get_permalink($r->ID),
			"date" => get_post_meta($r->ID,"date", true),
			"price" => get_post_meta($r->ID,"price", true),
			"location" => get_post_meta($r->ID,"location", true),
			 
			); 
		
			$this->email_system("allusers", 'event_1day', $data);
			
			}// end foreach
		} // end if empty
		
	} // END EMAIL
	
	
	
 
	

}
	
	
	
function returnhtml(){ return "text/html"; }
	
	

/*
	this function sends the email
*/
function email_send($email, $subject, $message, $headers = array() ){ global $CORE;

 	// ADD ON EXTRA HEADERS
	$headers[] = "Content-Type: text/html; charset=\"" .get_option('blog_charset') . "\"\n"; 
 	
	// EMAIL FILTERS		 
	add_filter('wp_mail_content_type', array($this, 'returnhtml') );	
	apply_filters( 'wp_mail_content_type', "text/html" );
	
	 
	// CHECK FOR EMAIL HEADER/FOOTERS	
	$finalMessage = stripslashes($this->email_message_filter(get_option('ppt_email_header'), array())).$message.stripslashes($this->email_message_filter(get_option('ppt_email_footer'), array()));	 
	
	$finalMessage = str_replace("<p>","<p style='margin-bottom:15px;'>", stripslashes(wpautop($finalMessage)));
		 
	// SEND MESSAGE	
	wp_mail($email, stripslashes($subject), "<html><body>".$finalMessage."</body></html>", $headers); 	 
	
	// UPDATE EMAIL LOGS
	$emaillogs = get_option('ppt_emaillogs');
	if(!is_array($emaillogs)){ $emaillogs = array(); }
	
	// GET DATE		  
	$date_now = date('Y-m-d');
					
	// update
	if(isset($emaillogs[$date_now]) && isset($emaillogs[$date_now]) ){
		$emaillogs[$date_now] = array("date" => $date_now, "hits" => $emaillogs[$date_now]['hits']+1, "last_sent" => date('Y-m-d H:i:s')); 				
	}else{	  
		$emaillogs[$date_now] = array("date" => $date_now, "hits" => 1 );
	}
	
	update_option("ppt_emaillogs", $emaillogs);
		 
	
}

/*
	this function gets all of the user emails
*/
function email_get_all_user_emails(){ global $wpdb; $STRING = "";


		$SQL = "SELECT DISTINCT user_email FROM ".$wpdb->base_prefix."users";		 	
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
		 
			foreach($result as $e){
			$STRING .= $e->user_email.",";
			}		
		}
 
	return substr($STRING,0,-1);
}
 
/*
	this function sets up emails from the built-in
	email templates
*/
function SENDEMAIL($userid = "", $emailid = "", $data = ""){$this->email_system($userid, $emailid, $data); }

function email_custom($userid = "", $subject = "", $message = ""){ global $CORE; $headers = array();

		// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
		$ppt_emails = get_option("ppt_emails");
		if(!is_array($ppt_emails)){ $ppt_emails = array(); }
		$emailid = 0;

		// GET USER EMAIL FROM THEIR ID
		if($userid == "admin"){		
			$user_email = get_option('admin_email');
		}elseif($userid == "allusers"){		
			$user_email = $this->email_get_all_user_emails();
		}elseif(is_numeric($userid)){
			$user_email = get_the_author_meta( 'user_email', $userid );
		}else{
			$user_email = $userid;
		}
			 
		// VALIDATE FOR NO EMAIL SET
		if($user_email == ""){	
			
			$CORE->ADDLOG("Email Error", $userid, "", "error", "email", $emailid );			 
			return;			
		}	
		
		// CLEAN EMAIL WITH SHORTCODES
		$subject = $this->email_message_filter($subject, array());
		$message = $this->email_message_filter($message, array());
	
			
		// DEFAULT MESSAGE HEADERS
		if(isset($_POST['contact_e1']) && $_POST['contact_n1'] != ""){	
			$headers[] = 'From: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';			
		}elseif(isset($ppt_emails[$emailid]['from_name']) && strlen($ppt_emails[$emailid]['from_name']) > 2){ 
			$headers[] = 'From: '.$ppt_emails[$emailid]['from_name'].' <'.$ppt_emails[$emailid]['from_email'].'>';
		}else{ 
			$headers[] = 'From: '.get_option('emailfrom').' <'.get_option('admin_email').'>';
		}
		
		// CHECK FOR BBC HEADERS
		if(isset($ppt_emails[$emailid]['bcc_name']) && strlen($ppt_emails[$emailid]['bcc_name']) > 1){ 
			$headers[] .= 'Bcc: '.$bbc_name.' <'.$ppt_emails[$emailid]['bcc_email'].'>';
		}
			
  		
		// SEND EMAIL
		$this->email_send($user_email, stripslashes($subject), $message, $headers);
 
}

function email_system($userid = "", $emailid = "", $data = array() ){ global $CORE; $headers = array(); 
  
 	// CHECK WE HAVE ASSIGNED AN EMAIL TO THIS
	/// EMAIL ID OTHERWISE LOG NO EMAIL
	
	// GET EMAIL DATA
	$all_emails = _ppt('emails'); 
	  
	// CHECK WE HAVE AN EMAIL SETUP
	if( isset($all_emails[$emailid]) ){ 
	
		// CHECK ITS ENABLED
		if(!isset($all_emails[$emailid]['enable']) || ( isset($all_emails[$emailid]['enable']) && $all_emails[$emailid]['enable'] != 1) ){ return; }
	
		// GET USER EMAIL FROM THEIR ID
		if($userid == "admin"){		
			$user_email = get_option('admin_email');
		}elseif($userid == "allusers"){		
			$user_email = $this->email_get_all_user_emails();
		}elseif(is_numeric($userid)){
			$user_email = get_the_author_meta( 'user_email', $userid );
		}else{
			$user_email = $userid;
		}
			 
		// VALIDATE FOR NO EMAIL SET
		if($user_email == ""){	
		
				// ADD LOG
				$CORE->FUNC("add_log",
						array(				 
							"type" 		=> "email",	
							"status" 	=> "error",		
							"data" 		=> "Error sending email ".$emailid,						 
							"userid" 	=> $userid,		
							"email" 	=> $emailid,			 
						)
				);		
			 
			return;			
		}
		
		if(!isset($all_emails[$emailid]['body'])){
		$all_emails[$emailid]['body'] = "";
		}
		
		$subject = "";
		$message = "";
		
		// GET THE EMAIL CONTENT
		if(isset($all_emails[$emailid]['subject'])){
		$subject = $this->email_message_filter($all_emails[$emailid]['subject'], $data);
		}
		
		if(isset($all_emails[$emailid]['body'])){
		$message = $this->email_message_filter($all_emails[$emailid]['body'], $data);
		}
		
		// IF BLANK GET DEFAULT EMAIL CONTENT
		if($subject == "" || $message == "" ){
			return;
		} 
		
		/*
		if(defined('WLT_DEMOMODE')){
			$message .= "\n\n------------------------------------------\n\n";
			foreach($data as $g => $gg){
				$message .= "".$g." :: ".$gg."\n\n";
			}
		}*/
 	
		// DEFAULT MESSAGE HEADERS
		if(isset($_POST['contact_e1']) && $_POST['contact_n1'] != ""){	
		
			$headers[] = 'From: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';					
			$headers[] = 'Reply-To: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';
			
		}elseif(isset($all_emails[$emailid]['from_name']) && strlen($all_emails[$emailid]['from_name']) > 2){ 
			$headers[] = 'From: '.$all_emails[$emailid]['from_name'].' <'.$all_emails[$emailid]['from_email'].'>';
		}else{ 
			$headers[] = 'From: '.get_option('emailfrom').' <'.get_option('admin_email').'>';
		}
		
		// CHECK FOR BBC HEADERS
		if(isset($all_emails[$emailid]['bcc_name']) && strlen($all_emails[$emailid]['bcc_name']) > 1){ 
			$headers[] .= 'Bcc: '.$bbc_name.' <'.$all_emails[$emailid]['bcc_email'].'>';
		}
		
		// ADD LOG
		$CORE->FUNC("add_log",
				array(				 
					"type" 		=> "email",
					"data" 		=> stripslashes($subject) ." <br><br>".stripslashes($message)."<br><br>".$user_email,						 
					
					"userid" 	=> $userid,
					
					"emailid" 	=> $emailid, 
					
					"email"		=> $user_email,
					 		 
				)
		);	
 		
		// SEND EMAIL
		$this->email_send($user_email, stripslashes($subject), stripslashes($message), $headers);		
 		
	
	// NO EMAIL SET
	}else{
	
		 
		return;	
	}
 
}
/*
	this function replaces tags in emails with
	anyting thats available within the system
*/
function email_message_filter($message, $data, $get=false, $emailID = ""){ global $userdata, $CORE;

 	$extra_shortcodes = array(
		
		'website' 		=> home_url(), 		
		'date' 			=> hook_date(date('Y-m-d')),
		'time' 			=> date('h:i:s A'),		
	);	
	
	 	
	if($get && in_array($emailID, array("newsletter")) ){
	$extra_shortcodes["unsubscribe"] 		= "http://wwww.XXXX/unsubscribe/";	
	}
	
	if($get && in_array($emailID, array("user_verify")) ){
	$extra_shortcodes["vlink"] 		= "http://wwww.XXXX/link-to-verify/";	
	}
	
	
	if($get && in_array($emailID, array("offer_new","offer_accepted","offer_rejected","offer_updated")) ){
		
		$extra_shortcodes["from_username"] 		= "Buyer Name";
		$extra_shortcodes["post_name"] 			= "Full Item Name";
 		
	}
	
	if($get && in_array($emailID, array("order","admin_order_new")) && THEME_KEY  != "sp"){
		
		$extra_shortcodes["from_username"] 	= "Buyer Name";
		$extra_shortcodes["total"] 			= "$100";
		$extra_shortcodes["post_name"] 		= "Full Item Name";
 		$extra_shortcodes["orderid"] 		= "#LST-123-4545";
		$extra_shortcodes["ordernumber"] 		= "34838434";
		
	}
	 
	
	if($get && in_array($emailID, array("user_registered", "admin_user_new")) ){	
	 
		$extra_shortcodes["user_id"] 		= "45";
		$extra_shortcodes["username"] 		= "JohnDoe";
		$extra_shortcodes["email"] 			= "johndoe@gmail.com";
		$extra_shortcodes["password"] 		= "adas87d8sa7d87a8sda8d";
		$extra_shortcodes["first_name"] 	= "John";
		$extra_shortcodes["last_name"] 		= "Doe";
		
		$regfields = get_option("regfields"); 
		if(!is_array($regfields)){ $regfields = array(); } $i=0; 
		
		if(is_array($regfields) && isset($regfields['name'])){
			foreach($regfields['name'] as $data){ 	
				if( strlen($regfields['name'][$i]) > 2 ){ 
				$extra_shortcodes["userfield_".$regfields['key'][$i]] 		= stripslashes($regfields['name'][$i]);		
				}
				$i++;
			} 
		}
	
	}
	
  
	// USER ID	
	if(isset($data['user_id']) && is_numeric($data['user_id']) ){
		
		$userid =   $data['user_id'];
		
		$message = str_replace("(user_id)", $data['user_id'], $message);
		
		$extra_shortcodes["user_id"] = $data['user_id'];	
		 
	}elseif( isset($userdata->ID) ){
		
		$userid =   $userdata->ID;
		
		$message = str_replace("(user_id)", $userdata->ID, $message);	
	}
	
	
	// VERIFY LINK	
	$message = str_replace("(vlink)", home_url()."/verifyme/".$userid."/", $message);  //<a href="'.home_url()."/verifyme/".$userid."/".'">'..'</a>'
	
	$message = str_replace("(website)", '<a href="'.home_url().'">'.home_url().'</a>', $message); 
  
	
	// MATCH REG FIELDS
	preg_match_all('/\(([^\)]*)\)/', $message, $matches);
	if(is_array($matches) && !empty($matches[0])){
		
		$o=0;
		foreach($matches[1] as $g){
		
			if(substr($g,0, 10) == "userfield_"){			
			 
				$message = str_replace("(".$g.")", get_user_meta($userid, substr($g, 10), true), $message); 
			
			}		 
		$o++;
		} 
		 
	}
	
	
	 
	
	
	// USERNAME	
	if(isset($data['username']) && strlen($data['username']) > 2){ 
	
		$message = str_replace("(username)", $data['username'], $message);		
		$extra_shortcodes["username"] = $data['username'];
		
	}elseif(isset($data['user_id']) && is_numeric($data['user_id']) ){
		 
		$message = str_replace("(username)", $CORE->USER("get_username", $data['user_id']), $message);		
		$extra_shortcodes["username"] = $CORE->USER("get_username", $data['user_id']);
	
	}elseif(isset($_POST['user_login'])){
	
		$message = str_replace("(username)", $_POST['user_login'], $message);	 
		$message = str_replace("(Username)", $_POST['user_login'], $message);
	
	}elseif(isset($_POST['username'])){
	
		$message = str_replace("(username)", $_POST['username'], $message);	 
		$message = str_replace("(Username)", $_POST['username'], $message);	
	
	}elseif( isset($userdata->display_name) ){
	
		$message = str_replace("(Username)", $userdata->display_name, $message);
		$message = str_replace("(username)", $userdata->display_name, $message);	 
	 
	}	
	
	
	
	// USERNAME	
	if(isset($data['from_username']) && strlen($data['from_username']) > 2){ 
	
		$message = str_replace("(from_username)", $data['from_username'], $message);		
		$extra_shortcodes["from_username"] = $data['from_username'];
		
	} 
	
	
	// FIRST NAME
	if(isset($data['user_id']) && is_numeric($data['user_id']) ){
		 
		$message = str_replace("(first_name)", $CORE->USER("get_first_name", $data['user_id']), $message);				
	
	}elseif(isset($_POST['first_name'])){
	
		$message = str_replace("(first_name)", $_POST['first_name'], $message);	
	
	}elseif(isset($userdata->first_name) && !in_array($emailID, array("newsletter")) ){
	
		$message = str_replace("(first_name)", $userdata->first_name, $message);
		$extra_shortcodes["first_name"] = $userdata->first_name;
	 	 	
	}
	
	// LAST NAME
	if(isset($data['user_id']) && is_numeric($data['user_id']) ){
		 
		$message = str_replace("(last_name)", $CORE->USER("get_last_name", $data['user_id']), $message);			
	
	}elseif(isset($_POST['last_name'])){
	
		$message = str_replace("(last_name)", $_POST['last_name'], $message);	 
	
	}elseif(isset($userdata->last_name) && !in_array($emailID, array("newsletter")) ){
		 
		$message = str_replace("(last_name)", $userdata->last_name, $message);			
		$extra_shortcodes["last_name"] = $userdata->last_name;
		
	}
	
	// USER EMAIL
	if(isset($data['user_id']) && is_numeric($data['user_id']) ){
	 	
		$message = str_replace("(user_email)", $CORE->USER("get_email", $data['user_id']), $message);			
	
	}elseif(isset($_POST['user_email'])){	
	
		$message = str_replace("(user_email)", $_POST['user_email'], $message);	
		 
	}elseif( isset($userdata->ID) && !in_array($emailID, array("newsletter"))  ){	
		
		$e = $CORE->USER("get_email", $userdata->ID);
		$message = str_replace("(user_email)", $e, $message);		
		$extra_shortcodes["user_email"] = $e;
		 
	}	 
	 
	// NAME
	if(isset($_POST['contact_n1'])){
	$message = str_replace("(name)", $_POST['contact_n1'], $message);	
	} 
	 

	// PERFORM STRING REPLACE ON ENTIRE MESSAGE CONTENT	
	if(is_array($_POST)){
		foreach($_POST as $key=>$value){
			if(is_array($value)){
				foreach($value as $key1=>$val1){
					if(is_array($val1)){
					
					}else{
					$message = str_replace("(".$key1.")",$val1,$message);
					}// end if
				} // end foreach			
			}else{
			if(!is_object($value)){
			$message = str_replace("(".$key.")",$value,$message);
			}
			}		 
		}// end foreach
	}// end if
	
	
	
	// PASSED IN DATA
	if(is_array($data)){
		foreach($data as $key => $val){
			$message = str_replace("(".$key.")",$val, $message);
			
			$extra_shortcodes[$key] = $val;
			
		}	
	}
		
	// CHECK EXTRA SHORTCODES
	foreach($extra_shortcodes as $key=>$val){
	$message = str_replace("(".$key.")",$val,$message);
	}

	
	// RETURN SHORTCODES
	if($get){
	
	return $extra_shortcodes;
	
	}
	
	
	$message = str_replace("(theme_key)", THEME_KEY, $message);
	
	
	// CLEAN UPDATE EMPTY TAGS
	if(is_admin()){
	$message = preg_replace("/\([^)]+\)/", '', $message); //******
	}else{
	//$message = preg_replace("/\([^)]+\)/", '', $message);
	}	 

	
	// RETURN MESSAGE
	return $message;
}
 
 
	
	
	
	
	
	
	


	
 	// EMAIL FROM
	function _fromname($email){
		return get_option('emailfrom');
	}
	function _fromemail($email){
		$admin_email = get_option('admin_email');
		if($admin_email == ""){
			return $email;
		}else{
			return $admin_email;
		}		
	}
	
	// DEBUG EMAIL OPTION
	function debug_wpmail($query){
	if(defined('WLT_DEBUG_EMAIL')){
		echo "<div style='background:#fafafa; border:1px solid #ddd; padding:15px;'>";
		foreach($query as $k=>$p){
			if(is_array($p)){
			print_r($p);
			}else{
			echo $k.": ".$p."<br />";
			}
		}
		echo "</div>";
		die();
	}
	return $query;
	} 





///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


function SMS_CODE_VALIDATE($num = "", $code = "123"){ global $userdata;

	switch(_ppt(array("sms","provider"))){		
		case "msg91": { 		
		
				$postData = array(
				'authkey' 	=> _ppt(array("sms","msg91_api")),
				'mobile' 	=> str_replace("+","",$num),
				'sender' 	=> _ppt(array("sms","msg91_id")),
				"otp"		=> $code,
				);
				 
				$response = wp_remote_post( "https://api.msg91.com/api/v5/otp/verify", array(
				'method'      => 'GET', 
				'headers'     => array(),
				'body'        => $postData,
				'cookies'     => array()
				));
				
				if( !is_wp_error( $response ) && ($response['response']['code'] == 200) ) {	 
				 	
					$data = $response['body']; 
					$t = json_decode($data);
					
					if($t->type == "error"){					
						return array("status" => "invalid", "msg" => $t->message );
					} 				
				} 
		 
		
		} break;
		
		case "nexmo": { 
		
		
				$RQ = get_user_meta($userdata->ID, "nexmo_requestid", true);
				if($RQ == ""){
					return array("status" => "invalid", "msg" => "Missing Request ID");
				}
	 
				$postData = array(
				'api_key' 		=> _ppt(array("sms","nexmo_api")),
				'api_secret' 	=> _ppt(array("sms","nexmo_key")),
				'request_id' 	=> $RQ,
				"code"			=> $code,
				);
				 
				$response = wp_remote_post( "https://api.nexmo.com/verify/check/json", array(
				'method'      => 'GET', 
				'headers'     => array(),
				'body'        => $postData,
				'cookies'     => array()
				));
			 
				
				if( !is_wp_error( $response ) && ($response['response']['code'] == 200) ) {	 
				 	
					$data = $response['body'];
					
					//{"request_id":"5d2c9cae3f7843128e0aa1bd6c190872","status":"16","error_text":"The code provided does not match the expected value"}1
					
					//{"request_id":"5d2c9cae3f7843128e0aa1bd6c190872","status":"0","event_id":"140000006D1DD153","price":"0.05000000","currency":"EUR","estimated_price_messages_sent":"0.03400000"}1
					
					//die(print_r($data));
					 
					$t = json_decode($data);
					
					if(isset($t->error_text) ){
					
						if(strpos($t->error_text,"already") !== false){ // word has already veriied
							return array("status" => "ok", "msg" => "" );
						}
						
						return array("status" => "invalid", "msg" => $t->error_text );
					} 				
				} 
		
		
		
		} break;
		 
	}
	
	return array("status" => "ok", "msg" => "" );
						

}


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


function SMS_CODE_SEND($num = "all", $msg = "123", $from = ""){ global $CORE, $userdata;

  $i=1; 
  
  $from = _ppt(array("sms","nexmo_from"));
  if($from == ""){
  $from = "SMS CODE";
  }
  
  // TEST CODE
  if($msg == "test"){
	  // this is a test code
	  $msg = "";
  }
  
	switch(_ppt(array("sms","provider"))){	
		
		case "msg91": { 
		
			$postData = array(
				'authkey' 	=> _ppt(array("sms","msg91_api")),
				'mobiles' 	=> str_replace("+","",$num),
				'message' 	=> urlencode(stripslashes($msg)),
				'sender' 	=> _ppt(array("sms","msg91_id")),
				'route' 	=> "default", 
			);  
		 
			$postData["template_id"] =  _ppt(array("sms","msg91_tid"));
			
			$response = wp_remote_post( "https://api.msg91.com/api/v5/otp", array(
				'method'      => 'GET', 
				'headers'     => array(),
				'body'        => $postData,
				'cookies'     => array()
				));
				
			
			if( !is_wp_error( $response ) && ($response['response']['code'] == 200) ) {	 
				 	
				 
					$t = json_decode($response['body']);
					 
					if($t->type == "success"){					
						return array("status" => "ok", "msg" => "SMS Sent");
					}
			}  
			
				
		} break;
		
		case "nexmo": {
		 
						
			$postData = array(
				'api_key' 		=> _ppt(array("sms","nexmo_api")),
				'api_secret' 	=> _ppt(array("sms","nexmo_key")),
				'brand' 		=> "AcmeInc",
				"number"		=> str_replace("+","",$num),
			);
				 
			$response = wp_remote_post("https://api.nexmo.com/verify/json", array(
				'method'      => 'GET', 
				'headers'     => array(),
				'body'        => $postData,
				'cookies'     => array()
			));

			if( !is_wp_error( $response ) && ($response['response']['code'] == 200) ) {	 
			 
				$t = json_decode($response['body']);				
				update_user_meta($userdata->ID, "nexmo_requestid", $t->request_id);
			
				return array("status" => "ok", "msg" => "SMS Sent");
			}
			
			
			
		} break;
		default: { } break;
	
	}	
	
	// FAILED MESSAGE
	$error_message = "SMS failed";
	
	if( is_wp_error( $response )  ) {	 
		$error_message = $response->get_error_message();
	}
	
	return array("status" => "error", "msg" => $error_message);
			
   

} 
	 
	
}

?>