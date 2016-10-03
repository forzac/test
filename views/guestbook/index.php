<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<h1>Guestbook view</h1>
<hr/>

<div class="panel panel-default">
    <div class="panel-heading">
        <a href="../guestbook/add" class="btn btn-success">Add new message</a>
    </div>
    <div class="panel-body">
        <p>
            <?php
            Pjax::begin();
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'username',
                    'email',
                    'text',
                    'filePath' =>  [
                        'label' => 'Картинка',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::img(Url::to('/' . $data->filePath),[
                                'alt'=>'Файл - ' . $data->filePath,
                                'style' => 'width:150px;'
                            ]);
                        },
                    ],
                    'ip',
                    'browser',
                    'created_at'
                ]
            ]);
            Pjax::end();
            ?>
        </p>
    </div>
</div>

