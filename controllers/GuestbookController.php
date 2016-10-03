<?php

namespace app\controllers;

use Yii;
use app\models\GuestbookForm;
use app\models\Guestbook;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

class GuestbookController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'foreColor' => 0x33CC33,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Guestbook::find(),
            'pagination' => [
                'pageSize' => 25,
            ],
            'sort' => ['attributes' => ['username','email', 'created_at']]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new GuestbookForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';

            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file->extension == 'txt') {
                $model->scenario = $model::SCENARIO_TXT;
            } else {
                $model->scenario = $model::SCENARIO_IMAGE;
            }
            if($model->validate()) {
                $model->addGuest();
                Yii::$app->session->setFlash('success', 'Данные успешно добавлены');

                return Yii::$app->getResponse()->redirect('index');
            }
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionPreview()
    {
        if(Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model = new GuestbookForm();
            if ($model->file = UploadedFile::getInstance($model, 'file')) {
                $dir = Yii::getAlias('temp/uploads/');
                $fileName = $model->file->baseName . '.' . $model->file->extension;
                $model->uploadImg($dir, $fileName);
                $data['GuestbookForm']['file'] = $dir . $fileName;
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['model' => $data];
        }
    }
}
