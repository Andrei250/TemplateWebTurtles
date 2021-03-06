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
use app\models\CommComments;
use app\models\Locations;

/* @var $this yii\web\View */

$this->title = 'WEBTURTLES';
?>
<?php 


      $response = array();

      $models = Comments::find()->all();

      foreach ($models as $model) {
          
        if($model->istrash == '0'){
          // $coords = getCoordinates($model->address);
          $response[]=$model->address;
        }
      }

      $jsonData = json_encode($response);

    

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

<?php if(!Yii::$app->user->isGuest ){
  $model=Member::find()->where(['id'=>Yii::$app->user->id])->one();
  if($model->isadmin=='1'){
  ?>
<a href="<?= Url::to(['site/memberlist']);?>" class="btn btn-success" style="margin:5px auto;">MemberList</a>
<?php } 
}
?>
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
     $comms=CommComments::find()->where(['comm_id'=>$comment->id])->all();
     foreach ($comms as $comm) {
        if($comm->is_trash !='1')
        { $member=Member::find()->where(['id'=>$comment->member_id])->one();
            ?>

            <div class="comm-content-comm">
        <br><div>
          <p style="float:left; font-size:14px; color: #888; font-size: 14px; margin: 0 0 10px;">Author: <?= $member->first_name.' '.$member->last_name ?></p>

          <br><br>
          <p style="float: left; font-size: 16px; text-align: justify; word-break: break-all;"><?= $comm->content;  ?></p>   
          <br> 
        </div>
      <div><?php
       if(($comm->member_id == Yii::$app->user->id || Member::find()->where(['id'=>Yii::$app->user->id, 'isadmin'=>'1'])->one() ) && !Yii::$app->user->isGuest)
            {
              ?>
                   <a style="float:right" href="<?= Url::to(['comm-comments/delete','id'=>$comm->id]);?>" class="vote-btn" style="color:black;"><i class="fa fa-trash " aria-hidden="true"></i></a><br>
              <?php
            }

            ?>
          </div><hr>

      </div>
  
          <?php
        }



     }
     if(!Yii::$app->user->isGuest){

     ?>
     <div>
          <a href="<?= Url::to(['comm-comments/add','id'=>$comment->id]);?>" class="btn btn-success" style="margin:5px; float:left;">Add Comment for this Issue</a>
      </div>
      <br>
      <?php
    }
   }
 }
   ?>  

</div>

</div>
<br>
<?php
$orders = Comments::find()->orderBy(['nr_likes'=>SORT_DESC])->all();
  if($orders){
    ?>
<div class="topul div-center">
    <h2 style="font-family: Bungee">TOP 5 </h4>
    <?php
    $i=0;
    
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
<?php
}
?>
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

    <div id="map"></div>
    <script>
      var map;
      var markers = [];
      var ceva = <?= $jsonData ?>;
      var geocoder;
      var address;
     
      function initMap() {
        geocoder = new google.maps.Geocoder();
        var city = {lat: 45.75, lng: 21.226};

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: city,
          mapTypeId: 'terrain'
        });

        for(var i=0; i<ceva.length;++i)
        {
            address = ceva[i];
            codeAddress(address);
        }


      }
      function codeAddress(address) {
          geocoder.geocode({ 'address': address }, function (results, status) {
              var latLng = {lat: results[0].geometry.location.lat (), lng: results[0].geometry.location.lng ()};
              if (status == 'OK') {
                  var marker = new google.maps.Marker({
                      position: latLng,
                      map: map
                  });
                  markers.push(marker);
              } else {
                  alert('Geocode was not successful for the following reason: ' + status);
              }
          });
      }

    
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gbdwEmwQ3d2_-Q-qfNFrrjwl4-79BAM&callback=initMap">
    </script>

    
   
 
