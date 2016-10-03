<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 29.09.2016
 * Time: 19:20
 */

namespace app\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

class GuestbookForm extends Model
{
    const MAX_IMAGE_WIDTH = 320;
    const MAX_IMAGE_HEIGHT = 240;
    const SCENARIO_TXT = 'txt';
    const SCENARIO_IMAGE = 'images';

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $text;

    /**
     * @var UploadedFile file attribute <code>[^<>]*<\/code>
     */
    public $file;
    public $homepage;
    public $verifyCode;

    /*
     * '/^[^><]*([^><]*<(code|i|strike|strong|a href="[^><"]*" title="[^"]*")>[^<>]*<\/(code|i|strike|strong|a)>[^><]*)*[^><]*$/'
     */
    public function rules()
    {
        $pattern_first = '/^[^><]*([^><]*<code>[^><]*<\/code>[^><]*|[^><]*<i>[^><]*<\/i>[^><]*|[^><]*<strong>[^><]*<\/strong>[^><]*|';
        $pattern_second ='[^><]*<strike>[^><]*<\/strike>[^><]*||[^><]*<(a href="[^><"]*" title="[^"]*")>[^><]*<\/a>[^><]*)*[^><]*$/';

        return [
            [['username', 'email'], 'filter', 'filter' => 'trim'],
            ['file', 'file', 'extensions' => 'png, jpg, gif', 'on' => 'images'],
            ['file', 'file', 'extensions' => 'txt', 'on' => 'txt', 'maxSize' => 124000, 'tooBig' => 'Максимальный размер текстового файла 100кб'],
            [['username', 'email', 'text', 'verifyCode'], 'required'],
            ['homepage', 'url'],
            ['username', 'match', 'pattern' => '/^([a-zA-Z0-9_])+$/', 'message' => 'Только латиница и цыфры 0-9'],
            ['text', 'match', 'pattern' => $pattern_first . $pattern_second, 'message' => 'Вы можете использовать только эти теги: <code>, <strike>, <i>, <strong>, <a href="" title="">, также не забывайте закрывать теги.'],
            ['username', 'string', 'min' => 6, 'max' => 100],
            ['email', 'email'],
            ['verifyCode', 'captcha','captchaAction'=>'site/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Эл. почта',
            'homepage' => 'Домашняя страница',
            'text' => 'Сообщение',
            'verifyCode' => 'Код с картинки',
            'file' => 'Загрузить файл'
        ];
    }

    public function addGuest()
    {
        $guest = new Guestbook();
        $guest->attributes = $this->attributes;
        $dir = Yii::getAlias('uploads/');
        $fileName = $this->file->baseName . '.' . $this->file->extension;
        $guest->filePath = $dir . $fileName;
        $guest->homepage = $this->homepage;
        $this->uploadImg($dir, $fileName);
        $guest->save();
    }

    public function uploadImg($dir, $fileName)
    {
        $this->file->saveAs($dir . $fileName); //there should be generate random file name!!!
        if ($this->file->extension != 'txt') {
            $photo = Image::getImagine()->open(\Yii::$app->basePath . "/web/" . $dir . $fileName);

            if($photo->getSize()->getWidth() > self::MAX_IMAGE_WIDTH || $photo->getSize()->getHeight() > self::MAX_IMAGE_HEIGHT) {
                $photo->thumbnail(new Box(self::MAX_IMAGE_WIDTH, self::MAX_IMAGE_HEIGHT))->save(\Yii::$app->basePath . "/web/" . $dir . $fileName, ['quality' => 90]);
            } else if ($photo->getSize()->getWidth() > self::MAX_IMAGE_WIDTH && $photo->getSize()->getHeight() > self::MAX_IMAGE_HEIGHT) {
                $photo->thumbnail(new Box(self::MAX_IMAGE_WIDTH, self::MAX_IMAGE_HEIGHT))->save(\Yii::$app->basePath . "/web/" . $dir . $fileName, ['quality' => 90]);
            }
        }

        return $dir . $fileName;
    }

}