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
use app\models\Comments;

class CommentsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionAdd()
	{
		$model = new Comments;
	 	if($model->load(Yii::$app->request->post()) && $model->validate())
	 	{
	 		$model->date =date('Y-m-d H:i:s');
	 		$model->member_id = Yii::$app->user->id;
	 		if($model->save())
	 		{
	 			return $this->redirect(['site/index']);
	 		}
	 		else
	 		{
	 			throw new \yii\base\Exception( "Not saved" );
	 		}
	 	}

	 	return $this->render('add', ['model' => $model]);	
    }

}
