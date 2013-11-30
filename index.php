<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>Prototype 1 </title>
        <meta name="prototype samples" content="prototype testing">
        <meta name="SeeMai" content="Geolocation Project">

        <link rel="stylesheet" href="css/style.css?v=1.0">
        <script src="js/scripts.js"></script>
         <style>
      html, body, #map-canvas {
        height: 80%;
        width: 70%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 20%;
        margin-left: 100px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      
      #latlng {
        width: 225px;
      }

    </style>
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
  var address = document.getElementById('address');
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
        infowindow.setContent(results[1].formatted_address);
        address.innerHTML="The address will go here";
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
     <div id="panel">
      <input id="latlng" type="text" value="40.714224,-73.961452">
      <input type="button" value="Reverse Geocode" onclick="codeLatLng()">
      
    </div>
    <div id="map-canvas"></div>
    <p> Your address is: </p>
    <p id="address"> Address </p>

    </body>
    

</html>