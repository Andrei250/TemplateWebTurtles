<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Button;
use yii\web\UrlManager;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<html lang="<?= Yii::$app->language ?>">
<head>
  <link rel="stylesheet" type="text/css" href="site.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title>WEBTURTLES</title>
    <?php $this->head() ?>
</head>
<body id="myPage">
<?php $this->beginBody() ?>

<div class="wrap">



<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="<?= Url::to(['site/index']);?>" style="padding:12px 16px" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"> Home</i></a>
  <?php
  if (!Yii::$app->user->isGuest){
    ?>
 
  <a href="<?= Url::to(['site/index']);?>/#team" class="w3-bar-item w3-hide-small w3-hover-white">Team</a>
  <a href="<?= Url::to(['site/index']);?>/#work" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Work</a>
  <a href="<?= Url::to(['site/index']);?>/#pricing" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Price</a>
  <a href="<?= Url::to(['site/index']);?>/#contact" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal" title="Search"><i class="fa fa-search"></i></a>
  <a href="<?= Url::to(['site/logout']);?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Logout</a>
  <?php } else {
    ?>
    <a href="<?= Url::to(['site/login']);?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Login</a>
    <a href="<?= Url::to(['site/register']);?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Register</a>
  <?php
  }
  ?>
 </div>

  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
    <?php
  if (!Yii::$app->user->isGuest){
    ?>
    <a href="<?= Url::to(['site/index']);?>/#team" class="w3-bar-item w3-button">Team</a>
    <a href="<?= Url::to(['site/index']);?>/#work" class="w3-bar-item w3-button">Work</a>
    <a href="<?= Url::to(['site/index']);?>/#pricing" class="w3-bar-item w3-button">Price</a>
    <a href="<?= Url::to(['site/index']);?>/#contact" class="w3-bar-item w3-button">Contact</a>
    <a href="#" class="w3-bar-item w3-button">Search</a>
    <a href="<?= Url::to(['/site/logout']); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Logout</a>

    <?php } else {
    ?>
    <a href="<?= Url::to(['site/login']);?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Login</a>
    <a href="<?= Url::to(['site/register']);?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal">Register</a>
  <?php
  }
  ?>
  
  </div>
</div>

    <div class="container" style="width: 100%; margin:0; padding: 0;">
        
        <?= $content ?>
    </div>
</div>

<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center">
  <h4>Follow Us</h4>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-instagram"></i></a>
  <a class="w3-button w3-large w3-teal w3-hide-small" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
  <p>Powered by WEBTURTLES</p>

  <div style="position:relative;bottom:100px;z-index:1;" class="w3-tooltip w3-right">
    <span class="w3-text w3-padding w3-teal w3-hide-small">Go To Top</span>   
    <a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>
</footer>

<script>
// Script for side navigation
function w3_open() {
    var x = document.getElementById("mySidebar");
    x.style.width = "300px";
    x.style.paddingTop = "10%";
    x.style.display = "block";
}

// Close side navigation
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

