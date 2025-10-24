<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $clients */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row align-items-end">
        <div class="col-sm-2">
            <?= $form->field($model, 'ID') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'CLIENT_ID')->dropDownList(
                $clients,
                [
                    'prompt' => 'Selecione um cliente',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'ORDER_DATE')->input('date', [
                'class' => 'form-control',
                'placeholder' => 'Data do pedido',
            ]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'STATUS')->dropDownList(
                [
                    'PAGO' => 'Pago',
                    'PENDENTE' => 'Pendente',
                    'CANCELADO' => 'Cancelado',
                ],
                [
                    'prompt' => 'Selecione o status',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
        <div class="col-auto form-group d-flex">
            <div class="d-flex gap-2 mb-2 m-1">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
            <div class="d-flex gap-2 mb-2 m-1">
                <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>