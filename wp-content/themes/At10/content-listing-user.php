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

global $CORE, $CORE_UI, $settings, $post, $userdata;

	$thiscard = ""; 
	if(isset($settings['card']) && strlen($settings['card']) > 0){
		$thiscard = $settings['card'];
	}else{		
		$thiscard = _ppt(array('design','search_card'));	
	}
	
	
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

$desc 			= get_the_author_meta( 'description', $post->ID);
$link 			= get_author_posts_url($post->ID);
$photo 			= $CORE->USER("get_avatar",$post->ID); 
$username 		= $CORE->USER("get_display_name",$post->ID); //$CORE->USER("get_username", $post->ID);
$country 		= $CORE->USER("get_country", $post->ID);
$joined 		= $CORE->USER("get_joined", $post->ID);

$rating = do_shortcode('[RATING_USER uid='.$post->ID.' size="md" total_show="0" reviews_show="0" ]'); 

// ACCUNT TYPE
$accounttype = $CORE->USER("get_account_type", $post->ID);
$user_type = $accounttype['name'];
$count = $CORE->USER("count_listings", $post->ID);
 

//if($CORE->USER("get_verified", $authorID) == "1"){ 

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

if($thiscard == "list"){
	$card_data = 'cards/user/list'; 
}else{
	$card_data = 'cards/user/grid'; 
}

ob_start();
_ppt_template( $card_data ); 
$search_card = ob_get_contents();
ob_end_clean(); 	
 
 
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 
 
$data = ppt_theme_block_output($search_card, array(),array("widget")); 
 
$data = str_replace("%title%",substr(str_replace(".com","", str_replace("@","",$username)),0,15),$data);
$data = str_replace("%image%",$photo,$data);
$data =  str_replace("%link%",$link,$data);
$data =  str_replace("%rating%",$rating, $data);
$data =  str_replace("%desc%",$desc, $data); 
$data =  str_replace("%user_type%",$user_type, $data); 
$data =  str_replace("%count%",$count, $data); 
$data =  str_replace("%joined%",$joined, $data); 


echo $data; 

?>  