<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comm_comments".
 *
 * @property integer $id
 * @property integer $comm_id
 * @property string $content
 * @property string $member_id
 * @property string $is_trash
 *
 * @property Comments $comm
 * @property Member $member
 */
class CommComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comm_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comm_id', 'member_id'], 'integer'],
            [['is_trash'], 'string'],
            [['content'], 'string', 'max' => 255],
            [['comm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::className(), 'targetAttribute' => ['comm_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['content'],'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comm_id' => 'Comm ID',
            'content' => 'Content',
            'member_id' => 'Member ID',
            'is_trash' => 'Is Trash',
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
