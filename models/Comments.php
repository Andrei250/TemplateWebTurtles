<?php

namespace app\models;

use Yii;


class Comments extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['member_id', 'nr_likes', 'nr_dislikes'], 'integer'],
            [['date'], 'safe'],
            [['info'], 'string', 'max' => 1000],
            [['address'], 'string', 'max' => 255],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['info','address'],'required'],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'info' => 'Info',
            'address' => 'Address',
            'nr_likes' => 'Nr Likes',
            'nr_dislikes' => 'Nr Dislikes',
            'date' => 'Date',
        ];
    }

    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }
}
