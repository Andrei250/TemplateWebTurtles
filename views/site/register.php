<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
</br>
    <h2 style="font-family: Bungee">Hello!</h2>

    <p  style="font-family: Bungee">Please fill out the following fields to register:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'address')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'age')->textInput([
                                 'type' => 'number'
                            ]) ?>
        <?= $form->field($model, 'gender')->radioList(array('1'=>'Male',2=>'Female')); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
</br>
    <?php ActiveForm::end(); ?>

</div>
<body class="backgr"></body>
