function initialize(address){ 
	var tweet=arguments[1]?arguments[1]:true;
	var geocoder = new google.maps.Geocoder();
	var location = "";
	geocoder.geocode( { 'address': address}, function(results, status) { 
		if(status == google.maps.GeocoderStatus.OK) { 			
//			location=location+'<div style="font-size:20pt;font-family:"Times New Roman",Times,serif;">Location: '+results[0].geometry.location+'<br />Last Tweet: '+tweet+'</div>';
		location=location+'<div style="font-size:20pt;font-family:"Times New Roman",Times,serif;">Location: '+address+'<br />Last Tweet: '+tweet+'</div>';
			myOptions ={
				zoom: 8,
				center : results[0].geometry.location,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			var marker = new google.maps.Marker({ 
				position : results[0].geometry.location,
				map : map
			}); 
			var infowindow = new google.maps.InfoWindow({ 
				content : location
			//<?php echo $content ?>
			}); 
			infowindow.open(map,marker);
		}else { 
			alert("Geocode was not successful for the following reason: " + status); 
		}
	});
}
