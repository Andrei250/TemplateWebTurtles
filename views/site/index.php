<?php


/* @var $this yii\web\View */

$this->title = 'WEBTURTLES';
?>
<div class="site-index myPage">

    <!-- Image Header -->
<div class="w3-display-container w3-animate-opacity">
  <img src="/../TemplateWebTurtles/imagini/city4kk.jpg" alt="city" style="width:100%; height:auto">
</div>
</div>
 
 </br>

<div>
  <style type="text/css">
    body{
  min-width: 100%;
  text-align: center;
}
#all{
  width:100%;
  margin: 0 auto; /*centers the website*/
}

#likes{
  height:5px;
  width:50%;
  background: #8B0000;
  float:left;
}
#dislikes{
  height:5px;
  width:50%;
  background:#ccc;
  float:right;
}

#bar{
  margin:0 auto;
  width:60%;
}
  </style>
<body>
<div id="all">
  <div id="bar">
    <div id="likes"></div>
    <div id="dislikes"></div>
  </div>
  <input type="button" value="Like" id="likeButton" onclick="like();"/>
  <input type="button" value="Dislike" id="dislikeButton" onclick="dislike();"/>

</div>
</body>
<script>
var likes=0, dislikes=0;

//Functions to increase likes and immediately calculate bar widths
function like(){
  likes++;
  calculateBar();
}
function dislike(){
  dislikes++;
  calculateBar();
}

//Calculates bar widths
function calculateBar(){
  var total= likes+dislikes;
    //Simple math to calculate percentages
  var percentageLikes=(likes/total)*100;
  var percentageDislikes=(dislikes/total)*100;

    //We need to apply the widths to our elements
  document.getElementById('likes').style.width=percentageLikes.toString()+"%";
  document.getElementById('dislikes').style.width=percentageDislikes.toString()+"%";
    
    //We add the numbers on the buttons, just to show how to
    document.getElementById('likeButton').value="Like ("+likes.toString()+")";
    document.getElementById('dislikeButton').value="Disike ("+dislikes.toString()+")";

}

calculateBar();
</script>
</div>

 <!--Harta-->
 
  <head>
    <title>Remove Markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 500px;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        bottom: : auto;
        left: 38%;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 15px;
        padding-left: 10px;
        z-index: 100;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
      <input onclick="clearMarkers();" type=button value="Hide Markers">
      <input onclick="showMarkers();" type=button value="Show All Markers">
      <input onclick="deleteMarkers();" type=button value="Delete Markers">
    </div>
    <div id="map"></div>
    <script>

      // In the following example, markers appear when the user clicks on the map.
      // The markers are stored in an array.
      // The user can then click an option to hide, show or delete the markers.
      var map;
      var markers = [];

      function initMap() {
        var city = {lat: 45.75, lng: 21.226};

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: city,
          mapTypeId: 'terrain'
        });

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          addMarker(event.latLng);
        });

        // Adds a marker at the center of the map.
        addMarker(city);
      }

      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gbdwEmwQ3d2_-Q-qfNFrrjwl4-79BAM&callback=initMap">
    </script>
  </body>