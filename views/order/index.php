<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <p>
        <?= Html::a('Novo Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'headerRowOptions' => ['style' => 'background-color: #f8f9fa;'],
            'summary' => 'Exibindo <b>{count}</b> de <b>{totalCount}</b> registro(s)',
            'emptyText' => 'Nenhum registro encontrado.',
            'columns' => [
                [
                    'attribute' => 'ID',
                    'format' => 'raw',
                    'value' => fn($m) => Html::a('#' . Html::encode($m->CLIENT_ID), ['view', 'ID' => $m->ID]),
                ],
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
                'TOTAL_VALUE',
                'STATUS',
                [
                    'attribute' => 'ORDER_DATE',
                    'label' => 'Data de pedido',
                    'format' => 'raw',
                    'value' => function ($m) {
                                $dt = DateTime::createFromFormat('d-M-y h.i.s.u A', $m->ORDER_DATE);
                                return $dt ? $dt->format('d/m/Y H:i') : $m->ORDER_DATE;
                            },
                ],
                [
                    'class' => yii\grid\ActionColumn::class,
                    'header' => 'Ações',
                    'contentOptions' => ['class' => 'text-end'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => fn($url) =>
                            Html::a('<i class="fas fa-eye"></i>', $url, [
                                'title' => 'Visualizar',
                                'class' => 'btn btn-sm btn-outline-primary me-1 mb-1',
                            ]),
                        'update' => fn($url) =>
                            Html::a('<i class="fas fa-edit"></i>', $url, [
                                'title' => 'Editar',
                                'class' => 'btn btn-sm btn-outline-warning me-1 mb-1',
                            ]),
                        'delete' => fn($url) =>
                            Html::a('<i class="fas fa-trash"></i>', $url, [
                                'title' => 'Excluir',
                                'class' => 'btn btn-sm btn-outline-danger me-1 mb-1',
                                'data-method' => 'post',
                                'data-confirm' => 'Tem certeza que deseja excluir?',
                            ]),
                    ],
                    'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'ID' => $model->ID]);
                            }
                ],
            ],
        ]); ?>
    </div>


</div>