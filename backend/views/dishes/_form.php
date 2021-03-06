<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
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

    <h3>Ingredients</h3>

    <?php
        echo $form->field($model, 'disheIngs')->widget(MultipleInput::className(), [
            'min'               => 1,
            'allowEmptyList'    => false,
            'enableGuessTitle'  => true,
            'columns' => [
                [
                    'name'  => 'id_ing',
                    'type'  => Select2::className(),
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
<?php
//Fixing Select2 bug with multiple row input
$ajax_url = Url::to(['dishes/ingredients-search']);
$JS = <<<JS
    $('.select2-selection__rendered[role=textbox]').each(function(index, item){
        var title = $(item).attr('title');
        $.get('$ajax_url', {id: title}, function(response) {
            $(item).text(response.results.text);
        }.bind(item));
    });
JS;

$this->registerJs($JS);

?>