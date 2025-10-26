<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$isClientView = isset($isClientView);

$columns = [
    [
        'attribute' => 'ID',
        'format' => 'raw',
        'value' => fn($m) => Html::a('#' . $m->ID, ['order/view', 'ID' => $m->ID]),
    ],
    [
        'attribute' => 'TOTAL_VALUE',
        'label' => 'Valor',
        'format' => ['currency', 'BRL'],
        'contentOptions' => ['class' => 'text-end'],
    ],
    'TYPE',
    'DESCRIPTION',
    'STATUS',
    [
        'attribute' => 'ORDER_DATE',
        'label' => 'Data de pedido',
        'value' => fn($m) => $m->formattedOrderDate ?? $m->ORDER_DATE,
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
    [
        'class' => yii\grid\ActionColumn::class,
        'header' => 'Ações',
        'contentOptions' => ['class' => 'text-end'],
        'template' => '{view} {update} {delete}',
        'buttons' => [
            'view' => fn($url) => Html::a(
                '<i class="fas fa-eye"></i>',
                $url,
                ['title' => 'Visualizar', 'class' => 'btn btn-sm btn-outline-primary me-1 mb-1',]
            ),
            'update' => fn($url) => Html::a(
                '<i class="fas fa-edit"></i>',
                $url,
                ['title' => 'Editar', 'class' => 'btn btn-sm btn-outline-warning me-1 mb-1',]
            ),
            'delete' => fn($url) => Html::a(
                '<i class="fas fa-trash"></i>',
                $url,
                [
                    'title' => 'Excluir',
                    'class' => 'btn btn-sm btn-outline-danger me-1 mb-1',
                    'data-method' => 'post',
                    'data-confirm' => 'Tem certeza que deseja excluir?',
                ]
            ),
        ],
        'urlCreator' => function ($action, Order $model) {
            return Url::to(["order/$action", 'ID' => $model->ID]);
        }
    ],
];

if (!($isClientView ?? false)) {
    $clientCol = [
        'attribute' => 'CLIENT_ID',
        'label' => 'Cliente',
        'format' => 'raw',
        'value' => function ($m) {
            return $m->client
                ? Html::a(Html::encode($m->client->NAME), ['client/view', 'ID' => $m->CLIENT_ID])
                : '<span class="text-muted">Sem cliente</span>';
        },
    ];
    array_splice($columns, 1, 0, [$clientCol]);
}

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'headerRowOptions' => ['style' => 'background-color: #f8f9fa;'],
    'summary' => 'Exibindo <b>{count}</b> de <b>{totalCount}</b> registro(s)',
    'emptyText' => 'Nenhum registro encontrado.',
    'columns' => $columns,
]); ?>