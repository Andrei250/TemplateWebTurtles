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

class SiteController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }

  
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   
    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Member();
        
        if ($model->load(Yii::$app->request->post()) ) {
            $identity = Member::findOne(['email' => $model->email]);
            if($identity && Yii::$app->getSecurity()->validatePassword($model->password, $identity->password)){
                Yii::$app->user->login($identity);
                return $this->goHome();
            }
            else{
                return $this->render('login', [
                            'model' => $model,
                        ]);
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
            
    }

    public function actionRegister()
    {

        function getCoordinates($address){
            $address = urlencode($address);
            $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
            $response = file_get_contents($url);
            $json = json_decode($response,true);
            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];
         
            return array($lat, $lng);
        }

        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $check = Member::findOne(["email" => $model->email]);
            if($check)
            { 
                return $this->render('register', ['model' => $model]);
            }
            else
            {

                if($model->gender==1)
                    $model->gender='M';
                else
                    $model->gender='F';

                $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $coords = getCoordinates($model->address);

                $model->lat = $coords[0];
                $model->lng = $coords[1];
                $model->save();
                return $this->render('reg-conf.php');
            }
       

        } else {
            return $this->render('register', ['model' => $model]);
        }

    }

    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome(); 
    }

    
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

  
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionProfile(){
        return $this->render('profile');
    }
 
}
