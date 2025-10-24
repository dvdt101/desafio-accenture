<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Client $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
        ],
    ]); ?>

    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'NAME')->textInput(['maxlength' => true, 'placeholder' => 'Digite o nome do cliente']) ?>
        </div>
    </div>
    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true, 'placeholder' => 'Digite o E-mail do cliente']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'STATUS')->dropDownList(
                [
                    'ATIVO' => 'Ativo',
                    'INATIVO' => 'Inativo',
                ],
                [
                    'prompt' => 'Selecione o status',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Adicionar Cliente' : 'Salvar Alterações',
            ['class' => 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>