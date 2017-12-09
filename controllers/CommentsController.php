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
use app\models\Votedcomments;
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


    public function actionPlus($id)
    {
    	$check = Votedcomments::find()->where(['comm_id'=>$id, 'member_id'=>Yii::$app->user->id])->one();
    	if($check)
    		return $this->redirect(['site/index']);
    	else
    	{
    		$model2 = new Votedcomments;
    		$model2->comm_id = $id;
    		$model2->member_id = Yii::$app->user->id;
    		$model2->save();
    		$model = Comments::find()->where(['id'=>$id])->one();
    		$model->nr_likes=$model->nr_likes+1;
    		$model->update();
    		return $this->render('plus');
    	}
    }

    public function actionMinus($id)
    {
		$check = Votedcomments::find()->where(['comm_id'=>$id, 'member_id'=>Yii::$app->user->id])->one();
    	if($check)
    		return $this->redirect(['site/index']);
    	else
    	{
    		$model2 = new Votedcomments;
    		$model2->comm_id = $id;
    		$model2->member_id = Yii::$app->user->id;
    		$model2->save();
    		$model = Comments::find()->where(['id'=>$id])->one();
    		$model->nr_dislikes=$model->nr_dislikes+1;
    		$model->update();
    		return $this->render('plus');
    	}
    }

}
