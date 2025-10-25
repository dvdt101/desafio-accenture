<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$isClientView = isset($isClientView);

$columns = [
    'ID',
    [
        'attribute' => 'USERNAME',
        'format' => 'raw',
        'value' => fn($m) => Html::a(Html::encode($m->USERNAME), ['view', 'ID' => $m->ID]),
    ],
    'NAME',
    'EMAIL:email',
    'PROFILE',
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
            'delete' => function ($url, $model, $key) {
                
                if (Yii::$app->user->identity->ID == $model->ID) {
                    return '';
                }

                return Html::a('<i class="fas fa-trash"></i>', $url, [
                    'title' => 'Excluir',
                    'class' => 'btn btn-sm btn-outline-danger me-1 mb-1',
                    'data-method' => 'post',
                    'data-confirm' => 'Tem certeza que deseja excluir?',
                ]);
            },
        ],
        'urlCreator' => function ($action, User $model, $key, $index, $column) {
            return Url::toRoute([$action, 'ID' => $model->ID]);
        }
    ],
];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'headerRowOptions' => ['style' => 'background-color: #f8f9fa;'],
    'summary' => 'Exibindo <b>{count}</b> de <b>{totalCount}</b> registro(s)',
    'emptyText' => 'Nenhum registro encontrado.',
    'columns' => $columns
]); ?>