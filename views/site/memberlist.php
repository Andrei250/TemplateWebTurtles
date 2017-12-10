<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use app\models\Member;
use yii\helpers\Url;

$this->title = 'MemberList';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$models= Member::find()->all();

foreach ($models as $model) {
	if($model->id != Yii::$app->user->id && !$model->istrash)
		{
?>
		<div class="member-list">
      			<?=$model->first_name?> <?=$model->last_name?>
      			<br>
      			<?=$model->email ?>
      			
      			<a style="float:right" href="<?= Url::to(['site/delete','id'=>$model->id]);?>" class="vote-btn" style="color:black;"><i class="fa fa-trash " aria-hidden="true"></i></a>
      			<hr>
		</div>

	
	<?php
	}
}
?>



