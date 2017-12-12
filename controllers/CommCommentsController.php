<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Member;
use yii\db\ActiveRecord;
use yii\db\ActiveQueryInterface;
use yii\helpers\Json;
use yii\web\IdentityInterface;
use app\models\User;
use app\models\CommComments;
use app\models\Comments;

class CommCommentsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete($id)
    {
        $model = CommComments::find()->where(['id'=>$id])->one();
       
        if($model->is_trash === '0')
        {
            $model->is_trash = '1';
            $model->update();
        }
        return $this->redirect(['site/index']);

    }

    public function actionAdd($id)
	{
		$model = new CommComments;
	 	if($model->load(Yii::$app->request->post()) && $model->validate())
	 	{
	 		$model->comm_id=$id;
	 		$model->member_id = Yii::$app->user->id;
	 		$model->save();
	 		return $this->redirect(['site/index']);
	 		
	 	}

	 	return $this->render('add', ['model' => $model, 'id' =>$id]);	
    }
}
