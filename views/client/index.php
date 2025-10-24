<?php

use app\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index p-2">
    <p>
        <?= Html::a('Adicionar Cliente', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="bg-white p-2 mb-2 border rounded">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="bg-white p-2 border rounded">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'headerRowOptions' => ['style' => 'background-color: #f8f9fa;'],
                'summary' => 'Exibindo <b>{count}</b> de <b>{totalCount}</b> registro(s)',
                'emptyText' => 'Nenhum registro encontrado.',
                'columns' => [
                    'ID',
                    [
                        'attribute' => 'NAME',
                        'format' => 'raw',
                        'value' => fn($m) => Html::a(Html::encode($m->NAME), ['view', 'ID' => $m->ID]),
                    ],
                    'EMAIL:email',
                    'STATUS',
                    [
                        'attribute' => 'CREATED_AT',
                        'label' => 'Data de cadastro',
                        'format' => 'raw',
                        'value' => function ($m) {
                                        $dt = DateTime::createFromFormat('d-M-y h.i.s.u A', $m->CREATED_AT);
                                        return $dt ? $dt->format('d/m/Y H:i') : $m->CREATED_AT;
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
                        'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'ID' => $model->ID]);
                                    }
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>