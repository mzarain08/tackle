<?php

if(defined('WLT_DEMOMODE') && isset($GLOBALS['savedata']) ){


$images = array(); 
 
?>
<textarea style="display:none; width:100%; height:500px;" data-editor=0 data-key="<?php echo $GLOBALS['savedata']['design']; ?>" data-cat="<?php echo $GLOBALS['savedata']['cat']; ?>"> 
        /* <?php echo $GLOBALS['savedata']['design']; ?> */<?php foreach($GLOBALS['savedata']['data'] as $k => $g){ 
		
		if($k == "design"){ continue; }
		
		if(!is_array($g) && strlen($g) > 10){
			$array = explode('.', $g);
			$extension = end($array);
			if(in_array($extension, array("jpg","jpeg","png","gif"))) {	
			$images[] =  str_replace('"',"'", preg_replace('/\s+/', ' ',$g));
			}
		}
		
		$data = "";
		if(!is_array($g)){ 
		
			$data = str_replace('"',"'", preg_replace('/\s+/', ' ',$g)); 
		
		}
		if($data == ""){
		continue;
		}
		
		
		?>    
        $core["<?php if(in_array($GLOBALS['savedata']['cat'],array("header","footer"))){ echo $GLOBALS['savedata']['cat']; }else{ echo "home"; } ?>"]["<?php echo $GLOBALS['savedata']['design']; ?>"]["<?php echo $k; ?>"] = "<?php echo $data ?>"; <?php } ?>
</textarea>
<?php if(!empty($images)){ ?>
<textarea class="imgbox" style="display:none; width:100%; height:500px;" data-editor=1> 
<?php foreach($images as $img){ echo $img.","; } ?>
</textarea>


<?php } ?> 

<?php } ?>