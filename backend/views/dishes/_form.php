<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Dishes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dishes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'ingredients')->widget(MultipleInput::className(), [
            'max'               => 5,
            'min'               => 1,
            'allowEmptyList'    => false,
            'enableGuessTitle'  => true,
            'columns' => [
                [
                    'name'  => 'items',
                    'type'  => \kartik\select2\Select2::className(),
                    'options' => [
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 3,
                            'language' => [
                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::to(['dishes/ingredients-search']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                            ],
                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new JsExpression('function(data) { return data.name; }'),
                            'templateSelection' => new JsExpression('function (data) { return data.name; }'),
                        ],
                    ],
                ],
            ]
        ])->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
