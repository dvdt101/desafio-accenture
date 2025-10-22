<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Editar Pedido: #' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="order-update">
    <?= $this->render('_form', [
        'model' => $model,
        'clients'=> $clients,
    ]) ?>

</div>
