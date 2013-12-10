<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>Prototype 1 </title>
        <meta name="prototype samples" content="prototype testing">
        <meta name="SeeMai" content="Geolocation Project">
        <meta name="viewport" content="user-scalable=0, initial-scale=1.0">

       
        <link type="text/css" rel="stylesheet" href="/stylesheets/style.css" />
        <script src="js/scripts.js"></script>
     
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
   <script>
var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(40.730885,-73.997383);
  var mapOptions = {
    zoom: 8,
    center: latlng,
    mapTypeId: 'roadmap'
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeLatLng() {
  var input = document.getElementById('latlng').value;
  var address2 = document.getElementById('address');
  
  var formatted = document.getElementById('formataddress');
  var formatted2 =  document.getElementById('formataddress2');
  var formatted3 =  document.getElementById('formataddress3');
  
  
  var latlngStr = input.split(',', 2);
  var lat = parseFloat(latlngStr[0]);
  var lng = parseFloat(latlngStr[1]);
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        map.setZoom(11);
        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        infowindow.setContent(results[0].formatted_address);
        address2 = results[0].formatted_address;
        address.innerHTML=address2;
        
        var country;
        var postcode;
        var locality;
        var street;
        var state;

        for (i=0;i<results[0].address_components.length;i++){
            for (j=0;j<results[0].address_components[i].types.length;j++){
               if(results[0].address_components[i].types[j]=="country"){
                  country = results[0].address_components[i].long_name;
                }
                else if(results[0].address_components[i].types[j]=="postal_code"){
                  postcode = results[0].address_components[i].long_name;
                  }
                  else if(results[0].address_components[i].types[j]=="sublocality" || results[0].address_components[i].types[j]=="locality"){
                  locality = results[0].address_components[i].long_name;
                  }
                   else if(results[0].address_components[i].types[j]=="route"){
                street = results[0].address_components[i].long_name;
                  } else if(results[0].address_components[i].types[j]=="administrative_area_level_1" || results[0].address_components[i].types[j]=="administrative_area_level_2"){
                state = results[0].address_components[i].long_name;
                  }
                  
        }
        }
       
        geocodeterms.innerHTML="Street: " + street.toString() +
        "<br>Town/City: " + locality.toString() +
        "<br>County/State: " + state.toString() +
        "<br> Country: " + country.toString() +
        "<br> Postcode: " + postcode.toString();
       
        
        infowindow.open(map, marker);
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

    </head>
    
    
    
    
    
    <body>
    <p><h3>Prototype 1: Get geolocation</h3></p>
    
    <p id="demo">Click the button to get your coordinates:</p>
        <button onclick="getLocation()">Click Here</button>
    <script>
     var x=document.getElementById("demo");
    function getLocation()
     {
     if (navigator.geolocation)
       {
      navigator.geolocation.getCurrentPosition(showPosition);
       }
     else{x.innerHTML="Geolocation is not supported by this browser.";}
     }
    function showPosition(position)
     {
     x.innerHTML="Latitude: " + position.coords.latitude + 
     "<br>Longitude: " + position.coords.longitude;	
     }

    
    </script>
    <p> <h3>Prototype 2 </h3> </p>

      <input id="latlng" type="text" value="40.714224,-73.961452">
      <input type="button" value="Reverse Geocode" onclick="codeLatLng()">
      

    
    <div id="map-canvas"></div>
    <p> Your address is: </p>
    <p id="address"> Address </p>
   
    <p id="geocodeterms"> </p>
    
    <a href="projectplan.php">Project Plan </a>
    <br>
    <a href="web/viewer.html"> Viewer </a>

    </body>
    

</html>