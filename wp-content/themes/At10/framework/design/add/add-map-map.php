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

global $CORE, $userdata;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(_ppt(array("maps","provider")) == "basic"){ }else{ } 
	  

?>
      

<div id="geocoder" class="geocoder"></div>

<div class="mb-3">
<input type="text" class="form-control rounded-0 required mb-3" placeholder="<?php echo __("town, city or zipcode...","premiumpress"); ?>" id="form_zipbox" >

</div> 
     
      
<div id="ppt_map_location" style="height:300px;width:100%; background:#efefef;"></div>
     
 
<?php 


///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


if(_ppt(array("maps","provider")) == "mapbox"){

 

?>
 
 
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script>

function initializeLocationMap(){

 	if(mapset == 1){
		return;
	}
	 
	mapboxgl.accessToken = '<?php echo _ppt(array('maps','apikey')); ?>';
	var map = new mapboxgl.Map({
	container: 'ppt_map_location',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [mapLog, mapLat],
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
	     
	   jQuery("#map-location, .save-map-location").val(ev.result.place_name);
	    
	    jQuery(".save-map-log").val(searchResult.coordinates[0]);
	    jQuery(".save-map-lat").val(searchResult.coordinates[1]);
    
	   var marker = new mapboxgl.Marker({draggable: true}).setLngLat([searchResult.coordinates[0], searchResult.coordinates[1]]).on('dragend', onDragEnd).addTo(map);
 	  
	   data =  ev.result.context;
	   dataCount = data.length-1;
	     
	   // COUNTRY
	   if(typeof(data[dataCount]['text']) != "undefined"){
		jQuery(".save-map-country").val(data[dataCount]['text']).show();
		jQuery("#parent_country_list option:selected").removeAttr('selected');
		jQuery("#parent_country_list option[value='0']").attr('selected','selected');
		jQuery(".save-map-country-tax").val('');
		jQuery(".save-map-city-tax").val('');
		jQuery("#parent_country_list").hide(); 
		 dataCount = dataCount -1;
	   }
	    
	  if(typeof(data[dataCount]['text']) != "undefined"){
		jQuery(".save-map-city").val(data[dataCount]['text']).show();
		jQuery("#category_subs option[value='']").attr('selected','selected');
		jQuery("#category_subs").hide();
	   }
			
	}); 
	
	 
	var marker = new mapboxgl.Marker({draggable: true}).setLngLat([mapLog, mapLat]).on('dragend', onDragEnd).addTo(map);
	 
	function onDragEnd(ev) {
	 
		var lngLat = marker.getLngLat();
		  
	    jQuery(".save-map-log").val(lngLat.lng);
	    jQuery(".save-map-lat").val(lngLat.lat);
	    jQuery(".save-map-location").val(jQuery(".mapboxgl-ctrl-geocoder--input").val());
		 
	
	}
 	
	jQuery("#form_zipbox").hide();

}

</script>
<?php }elseif(_ppt(array("maps","provider")) == "google"){ ?>
<script > 



   var geocoder;var map;var marker = ''; var markers = [];
   	
   function initializeLocationMap() {
   
   if(typeof(map) != "undefined"){ return; }
      
      
     // CREATE MAP CANVUS
     var myOptions = {mapTypeId: google.maps.MapTypeId.ROADMAP, zoomControl: true, scaleControl: true }
     map = new google.maps.Map(document.getElementById("ppt_map_location"), myOptions); 
     
		
     // LOAD MAP LOCATIONS
     var defaultBounds = new google.maps.LatLngBounds(
         new google.maps.LatLng(mapLat, mapLog) );
      map.fitBounds(defaultBounds);
   
     // ADD ON MARKER
     <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'map-log',true) !=""){ ?>
     var marker = new google.maps.Marker({
     	position: new google.maps.LatLng(<?php echo get_post_meta($_GET['eid'],'map-lat',true); ?>,<?php echo get_post_meta($_GET['eid'],'map-log',true); ?>),
     	map: map,
     	animation: google.maps.Animation.DROP,	
   	icon: new google.maps.MarkerImage('<?php echo CDN_PATH; ?>images/marker.png'),			 
     });
     <?php } ?> 
   
     // ADD SEARCH BOX
     //map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('form_zipbox'));
     var searchBox = new google.maps.places.SearchBox(document.getElementById('form_zipbox'));
     
     // EVENT
      google.maps.event.addListener(searchBox, 'places_changed', function() {
       var places = searchBox.getPlaces();
   
       if (places.length == 0) {
         return;
       }
       for (var i = 0, marker; marker = markers[i]; i++) {
         marker.setMap(null);
       }
   	
       // For each place, get the icon, place name, and location. 

       var bounds = new google.maps.LatLngBounds();
       for (var i = 0, place; place = places[i]; i++) {
         var image = {
           url: place.icon,
           size: new google.maps.Size(71, 71),
           origin: new google.maps.Point(0, 0),
           anchor: new google.maps.Point(17, 34),
           scaledSize: new google.maps.Size(25, 25)
         }; 
   	  
   
           addMarker(place.geometry.location);
		   
		    jQuery(".save-map-log").val(place.geometry.location.lng());
	   		jQuery(".save-map-lat").val(place.geometry.location.lat());
			 
   	    getMyAddress(place.geometry.location,true)
   
         bounds.extend(place.geometry.location);
       }
   
       map.fitBounds(bounds);	
   //	map.setZoom(10);	 
     });
     
     // LISTEN FOR PLACES ONCLICK
     searchBox.addListener('places_changed', function() {
   	var places = searchBox.getPlaces();
   	jQuery('#form_zipbox').val(places[0].name);
   	jQuery('#showmapbox').show();
   
     });
   
     // EVENT
     google.maps.event.addListener(map, 'bounds_changed', function() {
       var bounds = map.getBounds();
       searchBox.setBounds(bounds);
   	map.setZoom(15);	
     });
     
     // EVENT
     google.maps.event.addListener(map, 'click', function(event){			
       
	     jQuery(".save-map-log").val(event.latLng.lng());
	   	jQuery(".save-map-lat").val(event.latLng.lat());
							   
	   
		 getMyAddress(event.latLng,"yes");	
       	addMarker(event.latLng);
   	
     });
     
     
    
     
   } // END INIT
   
   jQuery(document).ready(function(){ 
   
	   jQuery("#form_map_location").focusout(function() {
	   setTimeout(function(){  getMapLocation(jQuery("#form_map_location").val()); }, 500);   
	   });
	   
	   // HANDLE WHEN THE USED DOESNT SELECT ANYTHING FROM PLACES
	   jQuery(document).on('change', '#form_zipbox', function() {
		getMapLocation(jQuery('#form_zipbox').val());
	   });
   	   
   
   });
   

   function getMapLocation(location){
                           
                           var geocoder = new google.maps.Geocoder();
                               if (geocoder) {	geocoder.geocode({"address": location}, function(results, status) {	if (status == google.maps.GeocoderStatus.OK) {
   						 	 
                               map.setCenter(results[0].geometry.location);
                               addMarker(results[0].geometry.location);
                               getMyAddress(results[0].geometry.location,"no");			
                                 
							   jQuery(".save-map-log").val(results[0].geometry.location.lng());
	   						   jQuery(".save-map-lat").val(results[0].geometry.location.lat());
							   
							   
                               //map.setZoom(10);	 // MAP ZOOM LEVEL	
                               }});}			
   }
   
    function getMyAddress(location,setaddress){
                            
                          
                           google.maps.event.trigger(map, 'resize');
                           var geocoder = new google.maps.Geocoder();
                           var country = "";
                           if (geocoder) {geocoder.geocode({"latLng": location}, function(results, status) { if (status == google.maps.GeocoderStatus.OK) {
                           
   					    
                           	map.setCenter(results[0].geometry.location);	
							
							
							for (var i = 0; i < results[0].address_components.length; i++) {
   						
   						 
								  var addr = results[0].address_components[i];
								  //alert(addr.types[0]+' = '+ addr.long_name);
								  switch (addr.types[0]){
							  		
									case "country": {
									 
									jQuery(".save-map-country").val(addr.long_name).show();
									jQuery("#parent_country_list option:selected").removeAttr('selected');
									jQuery("#parent_country_list option[value='0']").attr('selected','selected');
									jQuery(".save-map-country-tax").val('');
									jQuery(".save-map-city-tax").val('');
									jQuery("#parent_country_list").hide(); 
									 
									
   									} break;
									
									case "locality": 
									case "postal_town": 
									{								 
   									 
									jQuery(".save-map-city").val(addr.long_name).show();
									jQuery("#category_subs option[value='']").attr('selected','selected');
									jQuery("#category_subs").hide();
									
									
   									} break;						  
   							  
   							  	} // end switch 
							  
							} 
                           
                           }
   						
   						});
   						
   						}} 
                           
                           
                           function addMarker(location) {
   						if (marker=='') {	
   						
   						
   						marker = new google.maps.Marker({	position: location, 	map: map, draggable:true,     animation: google.maps.Animation.DROP,	});
   						
   						
   						google.maps.event.addListener (marker, 'dragend', function (event){
   					    
						   
						    jQuery(".save-map-log").val(event.latLng.lng());
	   						   jQuery(".save-map-lat").val(event.latLng.lat());
							  
						   
                           getMyAddress(event.latLng,"yes");	
                           addMarker(event.latLng);
   						});
   						
   						
   						}						
                           marker.setPosition(location);
   						map.setCenter(location); 						
   						}
    
 
    
</script>
<?php } ?>

<script>
mapset = 0;
mapLog = "-0.06";
mapLat = "51.645";

function LoadMapBox(){ 
				
	if(jQuery('.data-map-log').val() != "" && jQuery.isNumeric(jQuery('.data-map-log').val()) && inRange(jQuery('.data-map-log').val(), -90, 90) ){
	mapLog = jQuery('.data-map-log').val();
	}
	
	if(jQuery('.data-map-lat').val() != "" && jQuery.isNumeric(jQuery('.data-map-lat').val()) && inRange(jQuery('.data-map-log').val(), -90, 90) ){
	mapLat = jQuery('.data-map-lat').val();
	}
	  
			
	initializeLocationMap();
	mapset = 1;	 
}

function inRange(n, nStart, nEnd)
{
    if(n>=nStart && n<=nEnd) return true;
    else return false;
}
</script>
<style>
#geocoder svg { display:none; }
.mapboxgl-ctrl-attrib-inner { display:none; }
</style>