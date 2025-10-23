<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $clients */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
        ],
    ]); ?>
    <div class="mb-1 row">
        <div class="col-sm-3">
            <?= $form->field($model, 'CLIENT_ID')->dropDownList(
                $clients,
                [
                    'prompt' => 'Selecione um cliente',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'STATUS')->dropDownList(
                [
                    'PAGO' => 'Pago',
                    'PENDENTE' => 'Pedente',
                    'CANCELADO' => 'Cancelado',
                ],
                [
                    'prompt' => 'Selecione o status',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
    </div>

    <div class="mb-1 row">
        <div class="col-sm-2">
            <?= $form->field($model, 'TOTAL_VALUE')
                ->textInput(
                    [
                        'maxlength' => true,
                        'inputmode' => 'decimal',
                        'placeholder' => '0,00',
                        'value' => ''
                    ]
                )
                ->widget(MaskedInput::class, [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'radixPoint' => ',',
                        'groupSeparator' => '.',
                        'autoGroup' => true,
                        'digits' => 2,
                        'removeMaskOnSubmit' => true,
                    ],
                ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Adicionar Pedido' : 'Salvar Alterações',
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>