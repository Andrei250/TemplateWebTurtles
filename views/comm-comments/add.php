<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Add Comment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <br>

    <p style="font-size: 20">Write a comment!</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'content')->textInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Add Comment', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        <br>
    <?php ActiveForm::end(); ?>

</div>

<body class="background0"></body>
