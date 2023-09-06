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

global $CORE, $post, $userdata; 
 

$title = ppt_title_hours();


if(!isset($post->ID) || is_admin()){

$bh = array(
				'start' => array
					(
						0 => '09:00',
						1 => '09:00',
						2 => '12:00',
						3 => '09:45',
						4 => '09:00',
						5 => '09:00',
						6 => '06:45',
					),
			
				'end' => array
					(
						0 => '18:00',
						1 => '18:00',
						2 => '18:00',
						3 => '18:00',
						4 => '18:00',
						5 => '18:00',
						6 => '18:00',
					),
			
				'active' => array
					(
						0 => rand(0,1),
						1 => rand(0,1),
						2 => rand(0,1),
						3 => rand(0,1),
						4 => rand(0,1),
						5 => rand(0,1),
						6 => rand(0,1),
					),
			
			);

}else{
$bh = get_post_meta($post->ID,'businesshours',true);

}

$days = array(
	"Mon" => __('Monday',"premiumpress"),
	"Tue" => __('Tuesday',"premiumpress"),
	"Wed" => __('Wednesday',"premiumpress"),
	"Thu" => __('Thursday',"premiumpress"),
	"Fri" => __('Friday',"premiumpress"),
	"Sat" => __('Saturday',"premiumpress"),
	"Sun" => __('Sunday',"premiumpress") ,
);

$days_chek = array(
	0 => "Mon",
	1 => "Tue",
	2 => "Wed",
	3 => "Thu",
	4 => "Fri",
	5 => "Sat",
	6 => "Sun",
);

if(is_array($bh) && !empty($bh) ){  
?>

<?php if(THEME_KEY == "jb"){ ?>
<div class="text-600 mb-3 text-primary"><?php echo __('Available Interview Times',"premiumpress"); ?></div>
<?php } ?>

<div class="card-hours text-600">

<div class="addeditmenu" data-key="openinghours"></div>

 
<?php  
 
$i=0; $countClosed = 0; 

while($i < 7){  if(isset($bh['active'][$i]) && $bh['active'][$i] == 1){ }else{ $countClosed++; } $i++; }

?>
 
<?php $i=0; $d=1; while($i < 7){ 
  
  	if(!isset($bh['start'][$i])){ $i++; $d++; continue; }
  
  
  if(_ppt(array('design','element_open12')) == "1"){
  
	  $start =  date('g:i A', strtotime($bh['start'][$i]));
	  
	  $end = date('g:i A', strtotime($bh['end'][$i]));
  
  }else{
	  
	  $start =  date('H:i A', strtotime($bh['start'][$i]));
	  
	  $end =  date('H:i A', strtotime($bh['end'][$i]));
  
  }
  
$array = array_values($days);
$today = date("D");
$isToday = false;

if($today == $days_chek[$i] ){
$isToday = true;
}

 ?>
<div class="d-flex justify-content-between mb-2">

<span><?php echo $array[$i]; ?></span>
            
              <?php if(isset($bh['active'][$i]) && $bh['active'][$i] == 1){  ?>
              <span class="<?php if($isToday){ ?>text-light p-1 rounded text-600 bg-primary<?php } ?> small">
              <?php  echo $start." - ".$end; ?>
              </span>
              
              <?php }else{ ?>
              <span class="<?php if($isToday){ ?>text-light p-1 rounded text-600 bg-primary<?php } ?> small">
              <?php if(in_array(THEME_KEY, array("jb"))){  echo __("Unavailable","premiumpress"); }elseif(in_array(THEME_KEY, array("es","dl"))){  echo __("Busy","premiumpress"); }else{ echo __("Closed","premiumpress"); } ?>
              </span>
              
              <?php } ?>
</div>
<?php $i++; $d++; } ?> 
  
 </div>

<?php } ?>