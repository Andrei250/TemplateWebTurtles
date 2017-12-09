<?php

use app\models\Member;
use app\models\Comments;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\ActiveRecord;
use yii\db\ActiveQueryInterface;
use yii\helpers\Json;
use yii\web\IdentityInterface;
use app\models\User;
/* @var $this yii\web\View */

$this->title = 'WEBTURTLES';
?>
<div class="site-index myPage">
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

    <!-- Image Header -->
<div class="w3-display-container w3-animate-opacity">
  <img src="/../TemplateWebTurtles/imagini/city4k.jpg" alt="city" style="width:100%; height:auto">
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
<?php if(!Yii::$app->user->isGuest){
  ?>
<a href="<?= Url::to(['comments/add']);?>" class="btn btn-success" style="margin :5px;">Add a Comment</a>
<?php } ?>
<div id="comments">

<?php
   $comments=Comments::find()->all();

   foreach ($comments as $comment) {
  if($comment->istrash != '1'){
    $member=Member::find()->where(['id'=>$comment->member_id])->one();
     ?>
      <div class="comm-content">
          <p style="float:left; font-size:10px">Author:<?= $member->first_name.' '.$member->last_name ?></p>
          <br>
          <br>
          <p style="float: left; font-size: 16px; text-align: justify; word-break: break-all;"><?= $comment->info;  ?></p>
          <br>
          <p style="float: right; font-size: 16px;"> Location: <?= $comment->address ?> </p>
          <br>
       <?php
        if($comment->member_id != Yii::$app->user->id)
        {
          ?>
              <div class="vote">
                  <a href="#" class="vote-btn"><i class="fa fa-check" aria-hidden="true"></i></a>
                  <a href="#" class="vote-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
              </div>
          <?php
            }
          ?>
      </div>

     <?php
   }
 }
   ?>  

</div>
</body>
  <script type="text/javascript">
       $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
    </script>
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

