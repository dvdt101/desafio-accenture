<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Pedido#' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <p>
        <?= Html::a('Editar', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'ID' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            [
                'attribute' => 'CLIENT_ID',
                'label' => 'Cliente',
                'format' => 'raw',
                'value' => function ($model) {
                if ($model->client) {
                    return Html::a(
                        Html::encode($model->client->NAME),
                        ['client/view', 'ID' => $model->CLIENT_ID],
                        ['title' => 'Ver Cliente']
                    );
                }
                return '<span class="text-muted">Sem cliente</span>';
            },
            ],
            'TYPE',
            'DESCRIPTION',
            [
                'attribute' => 'TOTAL_VALUE',
                'label' => 'Valor Total',
                'format' => ['currency', 'BRL'],
                'value' => $model->TOTAL_VALUE,
            ],
            'STATUS',
            [
                'attribute' => 'ORDER_DATE',
                'label' => 'Data de cadastro',
                'value' => $model->formattedOrderDate,
            ],
        ],
    ]) ?>

</div>