function initialize() {
   var tweet=arguments[0]?arguments[0]:"No Tweet!";
   var browserSupportFlag = new Boolean();
   if(navigator.geolocation) {
	var latlng;
   	var location="";
		
	browserSupportFlag = true;
	navigator.geolocation.getCurrentPosition(function(position) {
	latlng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
	if(typeof position.address != 'undefined'){
		location=location+'<div style="font-size:12pt"><b>Your Position Is:</b> '+position.address+'<br />Last Tweet: '+tweet+'</div>';
	}else{
		location=location+'<div style="font-size:12pt;font-family:"Times New Roman",Times,serif;">Latitude: '+position.coords.latitude+'<br />Longitude: '+position.coords.longitude +'</div>';			
	}

	var myOptions ={
		zoom: 8,
		center : latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP

	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	var marker = new google.maps.Marker({ 
		position : latlng,
		map : map
	}); 
	var infowindow = new google.maps.InfoWindow({ 
		content : location,
		maxWidth : 200
	}); 
	
	infowindow.open(map,marker);

    }, function() {
        handleNoGeolocation(browserSupportFlag);
    });
    }else{
    // Browser doesn't support Geolocation
	browserSupportFlag = false;
	handleNoGeolocation(browserSupportFlag);
    }
}



function handleNoGeolocation(errorFlag) {
  if (errorFlag == true) {
    contentString = "Error: The Geolocation service failed.";
  } else {
    contentString = "Error: Your browser doesn't support geolocation.";
  } 
  document.getElementById("map_canvas").innerHTML=contentString;
}
