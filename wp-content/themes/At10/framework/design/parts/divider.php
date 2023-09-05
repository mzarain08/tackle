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
 
global $divdata;
  
if(isset($divdata['section_divider']) ){
 
 
$color1 = "bg-".$divdata['section_divider_color1']; // background
$color2 = "text-".$divdata['section_divider_color2']; // forground

if(strlen($divdata['section_divider_color1_custom']) > 1){
$color1 = $divdata['section_divider_color1_custom'];
}
 

if(strlen($divdata['section_divider_color2_custom']) > 1){
$color2 = $divdata['section_divider_color2_custom'];
} 
 

?>
<section class="ppt-divider ppt-divider-<?php echo $divdata['section_divider']; ?> <?php if(substr($color1,0,1) != "#"){ ?><?php echo $color1; ?><?php } ?> "<?php if(substr($color1,0,1) == "#"){ ?>style="background:<?php echo $color1; ?>"<?php } ?>>
<?php
switch($divdata['section_divider']){	 

	case "1": { ?>


<div class="overflow-hidden"><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 70"><path fill="currentColor" d="M1440,70H0V45.16a5762.49,5762.49,0,0,1,1440,0Z"/></svg></div></div>

<?php } break; case "2": { ?>

<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60"><path fill="currentColor" d="M0,0V60H1440V0A5771,5771,0,0,1,0,0Z"/></svg></div></div>
				
<?php } break; case "3": { ?>				

<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 92.26"><path fill="currentColor" d="M1206,21.2c-60-5-119-36.92-291-5C772,51.11,768,48.42,708,43.13c-60-5.68-108-29.92-168-30.22-60,.3-147,27.93-207,28.23-60-.3-122-25.94-182-36.91S30,5.93,0,16.2V92.26H1440v-87l-30,5.29C1348.94,22.29,1266,26.19,1206,21.2Z"/></svg></div></div>
				
<?php } break; case "4": { ?>

<section class="divider4"><div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100"><path fill="currentColor" d="M1260,1.65c-60-5.07-119.82,2.47-179.83,10.13s-120,11.48-180,9.57-120-7.66-180-6.42c-60,1.63-120,11.21-180,16a1129.52,1129.52,0,0,1-180,0c-60-4.78-120-14.36-180-19.14S60,7,30,7H0v93H1440V30.89C1380.07,23.2,1319.93,6.15,1260,1.65Z"/></svg></div></div>
				 	
<?php } break; case "5": { ?>

 
					
<?php } break; case "6": { ?>

<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg preserveAspectRatio="xMidYMin slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000.4 78.7"><g fill="currentColor"><path d="M2000 20v59H0V18c12 0 23 6 33 12 10 7 19 15 29 21 28 15 65 14 91-4 10-7 19-15 29-21a80 80 0 0168-8 80 80 0 0168 8c10 6 18 14 28 21 27 18 63 19 91 4 11-6 20-14 30-21s21-12 33-12a33 33 0 014 0c12 0 23 6 33 12 10 7 19 15 29 21 28 15 65 14 92-4 9-7 18-15 28-21a80 80 0 0168-8 80 80 0 0168 8c10 6 18 14 28 21 27 18 63 19 91 4 11-6 20-14 30-21s21-12 33-12a33 33 0 015 0c11 0 22 6 32 12 10 7 19 15 30 21 28 15 64 14 91-4 10-7 18-15 28-21a80 80 0 0168-8 80 80 0 0168 8c10 6 19 14 29 21 26 18 63 19 91 4 10-6 19-14 29-21l6-3c8-5 18-9 28-9a33 33 0 014 0c12 0 23 6 32 12l30 21 3 1a87 87 0 0035 9 90 90 0 0043-8 81 81 0 0010-6l9-6c6-5 12-11 19-15a80 80 0 0168-8 80 80 0 0169 8l20 15 8 6a82 82 0 0011 6 90 90 0 0043 8 87 87 0 0035-9l2-1 30-21a79 79 0 0120-10z" opacity=".75"/><path d="M478 79H23a33 33 0 0117-20l1-1a33 33 0 0122-1 22 22 0 0117-15 15 15 0 015-6 22 22 0 0114-2 52 52 0 0113 4l11 5c12 6 24 12 36 16 14 6 31 8 45 4l5-2a157 157 0 0041-26 151 151 0 0046 28c15 4 31 2 46-4 12-4 24-10 35-16l11-5a52 52 0 0114-4 22 22 0 0113 2 15 15 0 016 6 22 22 0 0117 15 33 33 0 0122 1l1 1a33 33 0 0117 20z" opacity=".5"/><path d="M504 79H0V65c6-10 20-16 32-12a37 37 0 019 5c8 6 15 13 24 16 12 3 25-4 35-12 7-7 15-14 23-19a43 43 0 017-3c14-5 29-1 42 5 11 5 22 12 32 18l5 2c13 7 27 11 41 8 14 3 29-1 42-8l4-2c11-6 21-13 33-18 13-6 28-10 41-5a43 43 0 017 3c9 5 16 12 24 19 10 8 22 15 35 12 9-3 16-10 24-16a37 37 0 019-5c14-5 31 5 35 19v7z"/><circle cx="59.8" cy="29.3" r="8.5"/><circle cx="159.2" cy="32.6" r="5.2"/><circle cx="375.8" cy="32.6" r="5.2"/><circle cx="435.9" cy="36.6" r="7.3"/><circle cx="106.4" cy="5.8" r="5.8" opacity=".5"/><circle cx="321.2" cy="5.8" r="5.8" opacity=".5"/><circle cx="250.3" cy="5.8" r="2.8" opacity=".75"/><path d="M982 79H527a33 33 0 0117-20l1-1a33 33 0 0122-1 22 22 0 0117-15 15 15 0 016-6 22 22 0 0113-2 52 52 0 0113 4l12 5c11 6 23 12 35 16 15 6 31 8 46 4l4-2a157 157 0 0041-26 151 151 0 0046 28c15 4 31 2 46-4 12-4 24-10 36-16l11-5a52 52 0 0113-4 22 22 0 0114 2 15 15 0 015 6 22 22 0 0117 15 33 33 0 0122 1l1 1a33 33 0 0117 20z" opacity=".5"/><path d="M1009 79H504V65c7-10 20-16 32-12a37 37 0 019 5c8 6 15 13 24 16 12 3 25-4 35-12 8-7 15-14 24-19a43 43 0 017-3c13-5 28-1 41 5 12 5 22 12 33 18l4 2c13 7 28 11 42 8 13 3 28-1 41-8l5-2c10-6 21-13 32-18 13-6 28-10 42-5a43 43 0 017 3c8 5 16 12 23 19 10 8 23 15 35 12 9-3 16-10 24-16a37 37 0 019-5c14-4 31 5 35 19l1 7z"/><circle cx="564" cy="29.3" r="8.5"/><circle cx="663.5" cy="32.6" r="5.2"/><circle cx="880.1" cy="32.6" r="5.2"/><circle cx="940.2" cy="36.6" r="7.3"/><circle cx="610.6" cy="5.8" r="5.8" opacity=".5"/><circle cx="825.5" cy="5.8" r="5.8" opacity=".5"/><circle cx="754.6" cy="5.8" r="2.8" opacity=".75"/><path d="M1486 79h-454a33 33 0 0116-20l2-1a33 33 0 0122-1 22 22 0 0116-15 15 15 0 016-6 22 22 0 0113-2 52 52 0 0114 4l11 5c12 6 23 12 35 16 15 6 31 8 46 4l5-2a157 157 0 0041-27 151 151 0 0046 29c15 4 31 2 45-4 13-4 24-10 36-16l11-5a52 52 0 0113-4 22 22 0 0114 2 15 15 0 016 6 22 22 0 0116 15 33 33 0 0122 1l1 1a33 33 0 0117 20z" opacity=".5"/><path d="M1513 79h-504V65c6-10 20-16 31-12a37 37 0 0110 5c7 6 14 13 24 16 12 3 24-4 34-12 8-7 15-14 24-19a43 43 0 017-3c14-5 29-1 42 5 11 5 21 12 32 18l5 2c13 7 27 11 41 8 14 3 28-1 41-8l5-2c11-6 21-13 32-18 13-6 28-10 42-5a43 43 0 017 3c9 5 16 12 24 19 10 8 22 15 34 12 10-3 16-10 24-16a37 37 0 0110-5c14-4 31 5 34 19l1 7z"/><circle cx="1068.3" cy="29.3" r="8.5"/><circle cx="1167.8" cy="32.6" r="5.2"/><circle cx="1384.4" cy="32.6" r="5.2"/><circle cx="1444.5" cy="36.6" r="7.3"/><circle cx="1114.9" cy="5.8" r="5.8" opacity=".5"/><circle cx="1329.8" cy="5.8" r="5.8" opacity=".5"/><circle cx="1258.9" cy="5.8" r="2.8" opacity=".75"/><path d="M1990 79h-454a33 33 0 0117-20l1-1a33 33 0 0122-1 22 22 0 0117-15 15 15 0 015-6 22 22 0 0114-2 52 52 0 0113 4l11 5c12 6 23 12 36 16 14 6 31 8 45 4l5-2a157 157 0 0041-27 151 151 0 0046 29c15 4 31 2 46-4 12-4 23-10 35-16l11-5a52 52 0 0114-4 22 22 0 0113 2 15 15 0 016 6 22 22 0 0117 15 33 33 0 0122 1l1 1a33 33 0 0116 20z" opacity=".5"/><path d="M2000 54v25h-487V65c6-10 20-16 31-12a37 37 0 0110 5c8 6 15 13 24 16 12 3 25-4 34-12l1-1 23-18a43 43 0 017-3c10-3 21-2 32 1a84 84 0 0110 4c11 5 21 12 32 18l5 2c13 7 27 11 41 8 14 3 29-1 41-8l5-2c11-6 21-13 33-18a83 83 0 019-4c10-3 22-5 32-1a43 43 0 017 3c9 5 16 12 23 18l1 1c10 8 22 15 35 12 9-3 16-10 24-16a37 37 0 019-5 26 26 0 0118 1z"/><circle cx="1572.6" cy="29.3" r="8.5"/><circle cx="1672.1" cy="32.6" r="5.2"/><circle cx="1888.7" cy="32.6" r="5.2"/><circle cx="1948.8" cy="36.6" r="7.3"/><circle cx="1619.2" cy="5.8" r="5.8" opacity=".5"/><circle cx="1834.1" cy="5.8" r="5.8" opacity=".5"/><circle cx="1763.2" cy="5.8" r="2.8" opacity=".75"/></g></svg></div></div>
					
<?php } break; case "7": { ?>
	
	<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100"><path fill="currentColor" d="M1260.2,37.86c-60-10-120-20.07-180-16.76-60,3.71-120,19.77-180,18.47-60-1.71-120-21.78-180-31.82s-120-10-180-1.7c-60,8.73-120,24.79-180,28.5-60,3.31-120-6.73-180-11.74s-120-5-150-5H0V100H1440V49.63C1380.07,57.9,1320.13,47.88,1260.2,37.86Z"/></svg></div></div>
	
	
<?php } break; case "8": { ?>
	
	<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.28 2.17" preserveAspectRatio="none"><path d="M35.28 1.67c-3.07-.55-9.27.41-16.15 0-6.87-.4-13.74-.58-19.13.1v.4h35.28z" fill="currentColor"/><path d="M35.28 1.16c-3.17-.8-7.3.4-10.04.56-2.76.17-9.25-1.47-12.68-1.3-3.42.16-4.64.84-7.04.86C3.12 1.31 0 .4 0 .4v1.77h35.28z" opacity=".5" fill="currentColor"/><path d="M35.28.31c-2.57.84-7.68.3-11.8.43-4.1.12-6.85.61-9.57.28C11.18.69 8.3-.16 5.3.02 2.3.22.57.85 0 .87v1.2h35.28z" opacity=".5" fill="currentColor"/></svg></div>
	 
<?php } break; case "9": { ?>
	
	<div class="overflow-hidden "><div class="divider <?php echo $color2; ?>"><svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100"><g fill="currentColor"><path opacity=".5" d="M0 13.2v12.2l220.7 19.2L0 70.9v11.3l250-38.1L0 13.2z"/><path opacity=".5" d="M0 25.4v8.8l145.2 12.6L0 64.1v6.8l220.7-26.3L0 25.4z"/><path opacity=".5" d="M0 25.4v8.8l145.2 12.6L0 64.1v6.8l220.7-26.3L0 25.4z"/><path opacity=".5" d="M0 34.2v29.9l145.2-17.3L0 34.2z"/><path opacity=".5" d="M0 34.2v29.9l145.2-17.3L0 34.2z"/><path opacity=".75" d="M0 34.2v29.9l145.2-17.3L0 34.2z"/><path opacity=".5" d="M750 44.1l250 38.1V69.9L779.3 43.6 1000 24.4V13.2L750 44.1zM750 44.1l-250-31-250 31 250 38zM500 24.4l220.7 19.3L500 69.8 279.3 43.6z"/><path d="M500 82.2L250 44.1 0 82.2v18h1000v-18L750 44.1 500 82.2z"/><path d="M720.7 43.6L500 24.4 279.3 43.7 500 69.8zM500 30.3l164.6 14.3L500 64.1 335.4 44.5z" opacity=".5"/><path d="M720.7 43.6L500 24.4 279.3 43.7 500 69.8zM500 30.3l164.6 14.3L500 64.1 335.4 44.5z" opacity=".5"/><path opacity=".5" d="M664.6 44.5L500 30.2 335.4 44.5 500 64.1l164.6-19.6z"/><path opacity=".5" d="M664.6 44.5L500 30.2 335.4 44.5 500 64.1l164.6-19.6z"/><path opacity=".75" d="M664.6 44.5L500 30.2 335.4 44.5 500 64.1l164.6-19.6z"/><path opacity=".5" d="M1000 69.9v-5.8L854.9 46.8 1000 34.2v-9.8L779.3 43.6 1000 69.9z"/><path opacity=".5" d="M1000 69.9v-5.8L854.9 46.8 1000 34.2v-9.8L779.3 43.6 1000 69.9z"/><path opacity=".5" d="M1000 64.1V34.2L854.9 46.8 1000 64.1z"/><path opacity=".5" d="M1000 64.1V34.2L854.9 46.8 1000 64.1z"/><path opacity=".75" d="M1000 64.1V34.2L854.9 46.8 1000 64.1z"/></g></svg></div>
					 
 
<?php 

} break;

}

?>
</section>
<?php

}

?>