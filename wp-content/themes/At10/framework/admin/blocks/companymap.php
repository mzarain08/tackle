<?php

global $CORE;

$contact = array(
		"name" 		=> array("name"=> __("Company Name","premiumpress"), "d" => "", "icon" => "fal fa-home", "col6" => true ),		
		"ceoname" 	=> array("name"=> __("CEO Name","premiumpress"), "d" => "", "icon" => "fal fa-user-circle", "col6" => true ),		
		"email" 	=> array("name"=> __("Email","premiumpress"), "d" => "", "icon" => "fal fa-envelope", "col6" => true),
		"phone" 	=> array("name"=> __("Phone","premiumpress"), "d" => "", "icon" => "fal fa-phone", "col6" => true),
		
		 
		 

);

$social = array(
		"twitter" => array("name"=> __("Twitter","premiumpress"), "d" => "", "icon" => "fab fa-twitter", "col6" => true),
		"facebook" => array("name"=> __("Facebook","premiumpress"), "d" => "",  "icon" => "fab fa-facebook", "col6" => true),
		"youtube" => array("name"=> __("Youtube","premiumpress"), "d" => "",  "icon" => "fab fa-youtube", "col6" => true),
		"instagram" => array("name"=> __("Instagram","premiumpress"), "d" => "",  "icon" => "fab fa-instagram", "col6" => true),
		 
		"pinterest" => array("name"=> __("Pinterest","premiumpress"), "d" => "",  "icon" => "fab fa-pinterest", "col6" => true),
		"vimeo" => array("name"=> __("Vimeo","premiumpress"), "d" => "",  "icon" => "fab fa-vimeo", "col6" => true),
		"linkedin" => array("name"=> __("Linkedin","premiumpress"), "d" => "",  "icon" => "fab fa-linkedin", "col6" => true),
		

);

$data = array( 
		 		
				
	
 		
		"core_icon" => array("name"=> __("Theme Icon","premiumpress"), "p" =>  $CORE->LAYOUT("captions","icon"), "d" => "", "desc" => "This is the main theme icon, leave blank for default.",  "icon" => "", "col6" => true),
		
			"core_branding" => array("name"=> __("Theme Branding","premiumpress"), "p" =>  "PremiumPress", "d" => "", "desc" => "Here you can set your own branding text.",  "icon" => "", "col6" => true),
 		
		"addthis" => array("name"=> __("Addthis User ID","premiumpress"), "p" => "1233432323", "d" => "", "desc" => "This is your addthis social sharing ID to replace the default PremiumPress one.",  "icon" => "", "col6" => true),	
 		
);

?>
 
 
 
 
 
 
 
 
<style>
#pac-input { width:400px; position:absolute; top:20px; margin-top:10px; }
</style>

<h5><?php echo __("Contact Information","premiumpress"); ?></h5>
<hr />
<div class="row">
<?php foreach($contact as $k=> $g){ if(!isset($g['name'])){ continue; } ?><div class="col-md-6">
<div class="form-group">	        
<label><?php echo $g['name']; ?></label>
<input type="text" class="form-control" name="admin_values[company][<?php echo $k; ?>]" value="<?php echo _ppt(array('company',$k)); ?>">
</div>
</div>
<?php } ?>


<div class="col-12">
<label><?php echo __("Company Description","premiumpress"); ?></label>
<textarea class="form-control" name="admin_values[company][mission]"><?php echo _ppt(array('company','mission'));  ?></textarea>

</div>


</div> 




<h5 class="mt-4"><?php echo __("Address &amp; Map","premiumpress"); ?></h5>
<hr />
<label><?php echo __("Address","premiumpress"); ?></label>

 <input type="text" class="form-control" name="admin_values[company][address]" value="<?php echo _ppt(array('company','address'));  ?>">

<label class="mt-4"><?php echo __("Map Location","premiumpress"); ?></label>
 
<input id="pac-input" class="form-control" type="text" placeholder="Search Box" style="display:none;">

<div id="geocoder" class="geocoder"></div>
<div id="ppt_map_location" class="bg-light" style="height:250px;width:100%;position:relative;">

<?php if( _ppt(array('maps','enable')) == 1 ){ ?>
<button class="btn rounded-0 btn-outline-dark" type="button" onclick="preloadmap();"  style="position:absolute;top:40%; left:40%;"><?php echo __("Load Map","premiumpress"); ?></button>
<?php }else{ ?>

<a href="#maps" id="maps-tab" data-targetdiv="maps" data-toggle="tab" role="tab" aria-controls="maps" aria-selected="false" class="btn rounded-0 btn-outline-dark customlist"  style="position:absolute;top:40%; left:40%;"><?php echo __("Google Maps Disabled","premiumpress"); ?></a>
<?php } ?>



</div>

<div class="row" style="display:none;">

<div class="col-md-6">
<label><?php echo __("Longitude","premiumpress"); ?></label>

<div class="mt-2">

 <input type="text" id="map-long" class="form-control" name="admin_values[company][map-log]" value="<?php  if(_ppt(array('company','map-log')) == ""){ echo "-0.5337212075259945"; }else{ echo _ppt(array('company','map-log')); } ?>">
</div>

</div>
<div class="col-md-6">
<label><?php echo __("Latitude","premiumpress"); ?></label>
<div class="mt-2">
 <input type="text" id="map-lat" class="form-control" name="admin_values[company][map-lat]"  value="<?php if(_ppt(array('company','map-lat')) == ""){ echo "51.30835312151235"; }else{ echo _ppt(array('company','map-lat')); } ?>"> 
</div> 
</div>
</div>

 

<?php if(_ppt(array('maps','enable')) == 1 && _ppt(array("maps","provider")) == "mapbox"){ ?>
 
 
<script>
var ajax_googlemaps_key = "<?php echo trim( _ppt(array('maps','apikey')) ); ?>";
function preloadmap(){

<?php if(_ppt(array("maps","provider")) == "mapbox"){ ?>
jQuery("<script/>",{type:'text/javascript', src:'https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'}).appendTo('head');	
jQuery("<script/>",{type:'text/javascript', src:'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js'}).appendTo('head');	
jQuery('head').append('<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" />');
<?php }elseif(_ppt(array("maps","provider")) == "google"){ ?>
//jQuery("<script/>",{type:'text/javascript', src:'<?php echo  $CORE->GEO("maps_google_link", array() ); ?>'}).appendTo('head');

   var script = document.createElement("script");
        script.src = "https://maps.google.com/maps/api/js?callback=loadWLTGoogleMapsApiReady&key=<?php echo _ppt(array('maps','apikey')); ?>&libraries=places";
        document.getElementsByTagName("head")[0].appendChild(script);		

<?php } ?>
	
setTimeout( function(){ 
		
		
<?php if(_ppt(array("maps","provider")) == "mapbox"){ ?>
	
	initializeLocationMap();
	
	<?php }elseif(_ppt(array("maps","provider")) == "google"){ ?>
	
	loadGoogleMapsApi();
	
	<?php } ?>
		
		
 }, 2000 );

}

function initializeLocationMap(){
 

	mapboxgl.accessToken = '<?php echo _ppt(array('maps','apikey')); ?>';
	var map = new mapboxgl.Map({
	container: 'ppt_map_location',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: ["<?php echo  _ppt(array('company','map-log')); ?>","<?php echo _ppt(array('company','map-lat')); ?>"],
	zoom: 13
	});
	
	var geocoder = new MapboxGeocoder({
		accessToken: mapboxgl.accessToken,
		mapboxgl: mapboxgl,
		marker: {        
        	draggable: true
        },
	});
	document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
	 
	geocoder.on('result', function (ev) {
	  
       var searchResult = ev.result.geometry;
	     
	   jQuery("#map-location").val(ev.result.place_name);
	   jQuery("#map-long").val(searchResult.coordinates[0]);
	   jQuery("#map-lat").val(searchResult.coordinates[1]);
	   
	   jQuery('#map-country').val = "";
   	   jQuery('#map-state').val = "";  
   	   jQuery('#map-route').val = "";  
   	   jQuery('#map-area').val = "";  
   	   jQuery('#map-neighborhood').val = "";  
   						
	   
		placeName = ev.result.place_name.split(',');
        
		//console.log(placeName);

            if(placeName[0] != "") {                 
                jQuery('#map-neighborhood').val(placeName[0]);
            }
			
           if(placeName[1] != "") {                 
                jQuery('#map-route').val(placeName[1]);
            } 
			
			 if(placeName[2] != "") {                 
                jQuery('#map-city').val(placeName[1]);
            } 
	   
	     	if(placeName[3] != "") {  
		 
		 		c = placeName[3].split(' '); 
			 	   
				if(placeName[3] == " United Kingdom"){
				
				jQuery('#map-country').val("UK");
				
				}else if(placeName[3] == " United States"){
				
				jQuery('#map-country').val("US");
				
				}else if(c[3] == null){
				
				jQuery('#map-country').val(placeName[3]);
				
				} else{
				
				jQuery('#map-state').val(c[1]);
				jQuery('#form_zipbox').val(c[2]+' '+c[3]);
				
				}
				
				
            } 
			
			if(placeName[4] != "") {  
		
				jQuery('#map-country').val(placeName[4]);
			}
		
	});
	
 
		
	
	
	var marker = new mapboxgl.Marker({draggable: true}).setLngLat(["<?php echo  _ppt(array('company','map-log')); ?>","<?php echo _ppt(array('company','map-lat')); ?>"]).on('dragend', onDragEnd).addTo(map);
	 
	function onDragEnd(ev) {
	 
		var lngLat = marker.getLngLat();
		
		 
	   jQuery("#map-long").val(lngLat.lng);
	   jQuery("#map-lat").val(lngLat.lat);
	    
    	jQuery.getJSON("https://api.mapbox.com/geocoding/v5/mapbox.places/"+ lngLat.lng + ',' + lngLat.lat	 +".json?access_token=" + ajax_googlemaps_key, { }, function(e) {
		
		 	//console.log(e.features[0]);	
			
			 jQuery("#map-location").val(e.features[0].place_name);	 
		 
		 	var long = e.features[0].center[0];
			var lat = e.features[0].center[1];
			  
			placeName = e.features[0].place_name.split(',');
			
			 if(placeName[0] != "") {                 
                jQuery('#map-neighborhood').val(placeName[0]);
            }
			
           if(placeName[1] != "") {                 
                jQuery('#map-route').val(placeName[1]);
            } 
			
			 if(placeName[2] != "") {                 
                jQuery('#map-city').val(placeName[1]);
            } 
	   
	     	if(placeName[3] != "" && typeof placeName[3] != 'undefined' ) {  
		 
		 		c = placeName[3].split(' '); 
			 	   
				if(placeName[3] == " United Kingdom"){
				
				jQuery('#location-country').val("UK");
				
				}else if(placeName[3] == " United States"){
				
				jQuery('#location-country').val("US");
				
				}else if(c[3] == null){
				
				jQuery('#map-country').val(placeName[3]);
				
				} else{
				
				jQuery('#map-state').val(c[1]);
				jQuery('#location-zip').val(c[2]+' '+c[3]);
				
				}
				
				
            } 
			
			if(placeName[4] != "" && typeof placeName[4] != 'undefined' ) {  
		
				jQuery('#location-country').val(placeName[4]);
			} 
			
		});
		 	
	
	} 
 
	
	
	jQuery("#form_zipbox").hide();

}
</script>
<?php } ?>

 
<script > 

var geocoder;var map;var marker = '';   var markerArray = []; 

<?php /*
jQuery(document).ready(function(){
<?php if(_ppt(array('maps','enable')) == 1 ){ ?>

	
<?php } ?>
});
*/ ?>



function loadGoogleMapsApi(){
	
	jQuery('#ppt_map_location').show();
    if(typeof googlemap === "undefined"){
     		
    } else {
        loadWLTGoogleMapsApiReady();
    }
	
	jQuery('#pac-input').show();
}
function loadWLTGoogleMapsApiReady(){ 
	jQuery("body").trigger("gmap_loaded"); 
}
jQuery("body").bind("gmap_loaded", function(){

			<?php if( _ppt(array('company','map-log')) !="" ){ ?>
			
			var myLatlng = new google.maps.LatLng(<?php echo _ppt(array('company','map-lat')); ?>,<?php echo  _ppt(array('company','map-log')); ?>);
			var myOptions = { zoom: 8,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			
			<?php }else{ ?>
			var myLatlng = new google.maps.LatLng(0,0);
			var myOptions = { zoom: 1,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			<?php } ?>
			 
			
            map = new google.maps.Map(document.getElementById("ppt_map_location"), myOptions);
			
			
		// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	  // LISTEN FOR PLACES ONCLICK
	  searchBox.addListener('places_changed', function() {
		var places = searchBox.getPlaces();
		 
		addMarker(places[0].geometry.location);
		
				document.getElementById("map-long").value = places[0].geometry.location.lng();	
				document.getElementById("map-lat").value =  places[0].geometry.location.lat();
			 
	
	  });
 
			
			
			<?php if( _ppt(array('company','map-log')) != "" ){ ?>
			var marker = new google.maps.Marker({
					position: myLatlng,
					map: map				 
				});
			markerArray.push(marker);
			<?php } ?>
			
			 
			
			google.maps.event.addListener(map, 'click', function(event){			
				document.getElementById("map-long").value = event.latLng.lng();	
				document.getElementById("map-lat").value =  event.latLng.lat();
			 
				addMarker(event.latLng);			
			});

});
function addMarker(location) {

	jQuery(markerArray).each(function(id, marker) {	
        marker.setVisible(false);
    });
	
	marker = new google.maps.Marker({	position: location, 	map: map,	});
	markerArray.push(marker);
	map.panTo(marker.position); 
	map.setCenter(location);  
}	
function getMapLocation(location){
 
			document.getElementById("map-state").value = "";
			var geocoder = new google.maps.Geocoder();if (geocoder) {	geocoder.geocode({"address": location}, function(results, status) {	if (status == google.maps.GeocoderStatus.OK) {
		 
			map.setCenter(results[0].geometry.location);
			addMarker(results[0].geometry.location);
		 	
			document.getElementById("map-long").value = results[0].geometry.location.lng();	
			document.getElementById("map-lat").value =  results[0].geometry.location.lat();
			map.setZoom(9);		
			}});}
			
}
 

</script>
 
<h5 class="mt-4"><?php echo __("Social Media","premiumpress"); ?></h5>
<hr />
<div class="row">
<?php foreach($social as $k=> $g){ if(!isset($g['name'])){ continue; } ?><div class="col-md-4">
        
<label><?php echo $g['name']; ?></label>
<div class="form-group position-relative">	
<input type="text" class="form-control" name="admin_values[company][<?php echo $k; ?>]" value="<?php echo _ppt(array('company',$k)); ?>">
<i class="fa <?php echo $g['icon']; ?>"></i>
</div>
</div>
<?php } ?>
</div> 
 
<h5 class="mt-4"><?php echo __("Other","premiumpress"); ?></h5>
<hr />
<div class="row">
<?php foreach($data as $k=> $g){ if(!isset($g['name'])){ continue; } ?><div class="col-md-6">
<div class="form-group">	        
<label><?php echo $g['name']; ?></label>
<input type="text" class="form-control" name="admin_values[company][<?php echo $k; ?>]" value="<?php echo _ppt(array('company',$k)); ?>" placeholder="<?php echo $g['p']; ?>">
</div>
<div class="description  mb-4"><?php echo $g['desc']; ?></div>

</div>
<?php } ?>
</div> 