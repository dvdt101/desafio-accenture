<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a('Editar', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?php
        if (Yii::$app->user->identity->ID != $model->ID) {
            echo Html::a('Deletar', ['delete', 'ID' => $model->ID], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'USERNAME',
            'NAME',
            'EMAIL:email',
            'PROFILE',
            'STATUS',
            [
                'attribute' => 'CREATED_AT',
                'label' => 'Data de cadastro',
                'value' => $model->formattedCreatedAt,
            ],
        ],
    ]) ?>

</div>