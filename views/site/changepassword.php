<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>
<div class="form">
 
<?php $form = ActiveForm::begin([
        'id' => 'chnage-password-form',
            'enableClientValidation' => true,
    ]); ?>

 
  <div class="row"> <?php echo $form->field($model,'old_password'); ?> <?php echo $form->field($model,'old_password')->passwordInput(); ?>  </div>
 
  <div class="row"> <?php echo $form->field($model,'new_password'); ?> <?php echo $form->field($model,'new_password')->passwordInput(); ?>  </div>
 
  <div class="row"> <?php echo $form->field($model,'repeat_password'); ?> <?php echo $form->field($model,'repeat_password')->passwordInput(); ?>  </div>
 
  <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Change password', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
  <?php ActiveForm::end(); ?>
</div>


</div>
