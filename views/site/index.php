<?php


/* @var $this yii\web\View */

$this->title = 'WEBTURTLES';
?>
<div class="site-index myPage">

    <!-- Image Header -->
<div class="w3-display-container w3-animate-opacity">
  <img src="/../TemplateWebTurtles/imagini/city4k.jpg" alt="city" style="width:100%; height:auto">
  <h1 style="position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: black;
    font-family: 'Bungee';
    font-size: 200%;">Social Responsability Portal</h1>
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
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Marker Labels</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        overflow: visible;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 500px;
        margin: 0;
        padding: 0;
        overflow: visible;
      }
    </style>
    
  </head>
  <body>
    <div id="map"></div>
  </body>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gbdwEmwQ3d2_-Q-qfNFrrjwl4-79BAM"></script>
    <script>
      // In the following example, markers appear when the user clicks on the map.
      // Each marker is labeled with a single alphabetical character.
      var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var labelIndex = 0;

      function initialize() {
        var bangalore = { lat: 12.97, lng: 77.59 };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: bangalore
        });

        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng, map);
        });

        // Add a marker at the center of the map.
        addMarker(bangalore, map);
      }

      // Adds a marker to the map.
      function addMarker(location, map) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
        var marker = new google.maps.Marker({
          position: location,
          label: labels[labelIndex++ % labels.length],
          map: map
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
