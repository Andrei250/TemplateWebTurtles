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
use app\models\Locations;

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
                $model2 = new Locations;
                $model2->comm_id= $model->id;
                $model2->name=$model->address;
                $model2->save();
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
            $model = Comments::find()->where(['id'=>$id])->one();
            if(!$model->istrash ){
                $model->nr_likes=$model->nr_likes+1;
                $model->update();
        		$model2 = new Votedcomments;
        		$model2->comm_id = $id;
        		$model2->member_id = Yii::$app->user->id;
        		$model2->save();
        		return $this->render('plus');
            } else {
            return $this->redirect(['site/index']);
            }
    	}
    }

    public function actionMinus($id)
    {
		$check = Votedcomments::find()->where(['comm_id'=>$id, 'member_id'=>Yii::$app->user->id])->one();
    	if($check)
    		return $this->redirect(['site/index']);
    	else
    	{
            $model = Comments::find()->where(['id'=>$id])->one();
            if(!$model->istrash ){
                $model->nr_dislikes=$model->nr_dislikes+1;
                $model->update();
        		$model2 = new Votedcomments;
        		$model2->comm_id = $id;
        		$model2->member_id = Yii::$app->user->id;
        		$model2->save();
        		return $this->render('plus');
            } else {
            return $this->redirect(['site/index']);
            }
    	}
    }

    public function actionDelete($id)
    {
        $model = Comments::find()->where(['id'=>$id])->one();
       
        if($model->istrash === '0')
        {
            $model->istrash = '1';
            $model->update();
        }
        return $this->redirect(['site/index']);

    }

}
