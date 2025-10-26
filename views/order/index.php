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
<div class="order-index p-2">
    <p>
        <?= Html::a('Novo Pedido', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="bg-white p-2 mb-2 border rounded">
        <?=$this->render('_search', ['model' => $searchModel, 'clients' => $clients]);?>
    </div>
    <div class="bg-white p-2 mb-2 border rounded">
        <div class="table-responsive">
            <?= $this->render('_gridView', [
                'dataProvider' => $dataProvider,
            ]) ?>
        </div>
    </div>

</div>