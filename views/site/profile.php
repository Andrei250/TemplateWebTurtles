<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>

	<h6>Email : <?=$model->email ?> </h6>    

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
        <?= $form->field($model, 'age')->textInput([
                                 'type' => 'number'
                            ]) ?>
         <?php

         	if($model->gender == 'M')
         		$model->gender='1';
         	else
         		$model->gender='2';
         ?>
        <?= $form->field($model, 'gender')->radioList(['1'=>'Male',2=>'Female']); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
</br>
    <?php ActiveForm::end(); ?>


</div>
