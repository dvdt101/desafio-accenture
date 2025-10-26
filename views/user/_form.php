<?php

use SebastianBergmann\CodeCoverage\StaticAnalysis\Visibility;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'NAME')->textInput(['maxlength' => 100, 'placeholder' => 'Digite o nome e sobrenome']) ?>
        </div>
    </div>
    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => 50, 'placeholder' => 'Digite Nome de usuário Ex: david.silva']) ?>
        </div>
    </div>
    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => 100, 'placeholder' => 'Digite o E-mail']) ?>
        </div>
    </div>
    <div class="mb-1 row">
        <div class="col-sm-4">
            <?= $form->field($model, 'PASSWORD_PLAIN')->passwordInput(['maxlength' => 20, 'placeholder' => 'Digite o Senha para o usuário']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?php
            if (Yii::$app->user->identity->ID != $model->ID) {
                echo $form->field($model, 'PROFILE', )->dropDownList(
                    [
                        'ADMINISTRADOR' => 'Administrador',
                        'GESTOR' => 'Gestor',
                    ],
                    [
                        'prompt' => 'Selecione Perfil',
                        'class' => 'form-control',
                    ]
                );
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?php
            if (Yii::$app->user->identity->ID != $model->ID) {
                echo $form->field($model, 'STATUS')->dropDownList(
                    [
                        'ATIVO' => 'Ativo',
                        'INATIVO' => 'Inativo',
                    ],
                    [
                        'prompt' => 'Selecione o status',
                        'class' => 'form-control',
                    ]
                );

            }
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Adicionar Usuário' : 'Salvar Alterações',
            ['class' => 'btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>