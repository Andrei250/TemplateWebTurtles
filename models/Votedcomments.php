<?php

namespace app\models;

use Yii;

class Votedcomments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votedcomments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'comm_id'], 'integer'],
            [['comm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::className(), 'targetAttribute' => ['comm_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'int' => 'Int',
            'member_id' => 'Member ID',
            'comm_id' => 'Comm ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComm()
    {
        return $this->hasOne(Comments::className(), ['id' => 'comm_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }
}
