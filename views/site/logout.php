<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;

$this->title = 'Logout';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-logout">
    <h1><?= Html::encode($this->title) ?></h1>
    <h1> Do you want to log out?</h1>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Logout', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

</div>


