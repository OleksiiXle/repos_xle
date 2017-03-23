<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>

<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($searchModel, 'message')->textInput()->label('Новое сообщение'); ?>
            <div class="form-group">
                <?= Html::submitButton('Добавить' , ['class' =>  'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6" align="center">
            <b><?= $resultDelete . $resultCreate ?></b>
        </div>
    </div>
    <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'mon',
                        'label'=>'Месяц',
                    ],
                    [
                        'attribute' => 'message',
                        'label'=>'Сообщение',
                    ],
                    [
                        'attribute' => 'oncreate',
                        'label'=>'Дата',
                        'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
                    ],
                    //------------------------------
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons'=>[
                            'delete'=>function($url,$data){
                                $url=Yii::$app->getUrlManager()->createAbsoluteUrl(['/test/delete','id' => $data['id'],
                                ]);
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url ,
                                    [
                                        'title' => 'Удалить',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]);
                            },
                        ],
                        'template'=>'{delete}',
                    ],
                    //------------------------------
                ],
            ]);
            ?>

    </div>
</div>


