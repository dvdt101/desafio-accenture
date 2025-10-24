<?php

use yii\helpers\Html;
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
             <?= $this->render('_gradeView', [
            'dataProvider' => $dataProvider,
        ]) ?>
        </div>
    </div>

</div>