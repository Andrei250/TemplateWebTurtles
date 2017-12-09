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
use app\models\Votedcomments;
use yii\db\ActiveQuery;

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

<?php if(!Yii::$app->user->isGuest){
  ?>
<a href="<?= Url::to(['comments/add']);?>" class="btn btn-success" style="margin:5px auto;">Add a Comment</a>
<?php } ?>
<div id="comments">

<?php
   $comments=Comments::find()->all();

   foreach ($comments as $comment) {
  if($comment->istrash != '1'){
    $member=Member::find()->where(['id'=>$comment->member_id])->one();
     ?>
      <div class="comm-content">
        <br><div>
          <p style="float:left; font-size:14px; color: #888; font-size: 14px; margin: 0 0 10px;">Author: <?= $member->first_name.' '.$member->last_name ?></p>
          <p style="float:right; font-size:16px; color: #888; font-size: 14px; margin: 0 0 0;"> Location: <?= $comment->address ?> </p>

          <br><br>
          <p style="float: left; font-size: 16px; text-align: justify; word-break: break-all;"><?= $comment->info;  ?></p>   
          <br> 
        </div>
      <div><?php
        $check = Votedcomments::find()->where(['member_id'=>Yii::$app->user->id,'comm_id'=>$comment->id])->one();
        if($comment->member_id != Yii::$app->user->id && !$check && !Yii::$app->user->isGuest)
        {
          ?>
              <div class="vote">
                  <a style="float:right" href="<?= Url::to(['comments/plus','id'=>$comment->id]);?>" class="vote-btn" style="color: ;"><i class="fa fa-check " aria-hidden="true"></i></a>
                  <a style="float:right" href="<?= Url::to(['comments/minus','id'=>$comment->id]);?>" class="vote-btn" style="color:red;"><i class="fa fa-times " aria-hidden="true"></i></a><br>
              </div>
              
              
          <?php
            }  if(($comment->member_id == Yii::$app->user->id || Member::find()->where(['id'=>Yii::$app->user->id, 'isadmin'=>'1'])->one() ) && !Yii::$app->user->isGuest)
            {
              ?>
                   <a style="float:right" href="<?= Url::to(['comments/delete','id'=>$comment->id]);?>" class="vote-btn" style="color:black;"><i class="fa fa-trash " aria-hidden="true"></i></a><br>
              <?php
            }

            ?>
          </div><hr>

      </div>

     <?php
   }
 }
   ?>  

</div>

</div>

<div class="topul div-center">
    <h2 style="font-family: Bungee">TOP 5 </h4>
    <?php
    $i=0;
    $orders = Comments::find()->orderBy(['nr_likes'=>SORT_DESC])->all();
    foreach ($orders as $order  ) {
      if($order->istrash == '0' && $i<5){
        $i++;
    ?>
      <h3 class="elemente-top" style="font-family: Bungee"><?=$i?>. <?=$order->address  ?></h2>
    <?php
    }
    }

    ?>

</div>
</div>

<br>
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
          zoom: 3,
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

    
   
 
