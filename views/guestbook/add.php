<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Guestbook */
/* @var $form ActiveForm */

$this->title = 'Add message';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-add">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="row">
        <div class="col-lg-6">

            <?php $form = ActiveForm::begin([
                'id' => 'add-form',
                'enableAjaxValidation' => true,
                'validateOnSubmit' => false,
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>

            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'homepage') ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $form->field($model, 'text')->textarea(['id' => 'test']) ?>
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-primary" value="<link></link>">link</button>
                    <button type="button" class="btn btn-success" value="<italic></italic>">italic</button>
                    <button type="button" class="btn btn-info" value="<strike></strike>">strike</button>
                    <button type="button" class="btn btn-warning" value="<strong></strong>">strong</button>
                </div>
            </div>
            <?= $form->field($model, 'file')->fileInput() ?>
            <?= $form->field($model, 'verifyCode', ['enableAjaxValidation' => false])->widget(Captcha::className()) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => "add"]) ?>
                <button id="preview" class="btn btn-success" data-toggle="modal" data-target="#myModal" type="submit">Preview</button>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Preview mode</h4>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item" id="username"></li>
                                <li class="list-group-item" id="email"></li>
                                <li class="list-group-item" id="homepage"></li>
                                <li class="list-group-item" id="file"></li>
                                <li class="list-group-item" id="text"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- add -->
</div>
