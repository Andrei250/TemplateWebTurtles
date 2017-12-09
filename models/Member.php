<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Member extends \yii\db\ActiveRecord implements IdentityInterface
{ 

    public $address;
    private $_user = false;

    public static function tableName()
    {
        return 'member';
    }

    public function rules()
    {
        return [
            [['isadmin', 'gender'], 'string'],
            [['age'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['first_name', 'last_name', 'email', 'password'], 'string', 'max' => 255],
            [['age','first_name', 'last_name', 'email', 'password','address','gender'],'required'],
            ['email', 'email'],
            ['email','unique'],
            [['istrash'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'isadmin' => 'Isadmin',
            'password' => 'Password',
            'age' => 'Age',
            'gender' => 'Gender',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'istrash' => 'Istrash',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($user->password,$this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Member::find()->where(['email'=>$this->email])->one();
        }

        return $this->_user;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
