<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row align-items-end">
        <div class="col-sm-2">
            <?= $form->field($model, 'USERNAME') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'PROFILE')->dropDownList(
                [
                    'ADMINISTRADOR' => 'Administrador',
                    'GESTOR' => 'Gestor',
                ],
                [
                    'prompt' => 'Selecione o status',
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
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
        <div class="col-auto form-group d-flex align-items-end">
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