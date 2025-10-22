<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Client $model */

$this->title = 'Adicionar Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
