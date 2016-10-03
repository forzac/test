<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "guestbook".
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guestbook';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'text'], 'required'],
            [['username'], 'unique'],
            ['homepage', 'url'],
            [['username', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'text' => 'Text',
            'homepage' => 'Домашняя страница',
            'ip' => 'Ip',
            'browser' => 'Browser',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'filePath' => 'Файл'

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->ip = $_SERVER["REMOTE_ADDR"];
            $this->browser = $_SERVER['HTTP_USER_AGENT'];
            return true;
        } else {
            return false;
        }
    }
}
