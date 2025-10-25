<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('Adicionar Usuário', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="bg-white p-2 mb-2 border rounded">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="bg-white p-2 border rounded">
        <div class="table-responsive">
             <?= $this->render('_gridView', [
            'dataProvider' => $dataProvider,
        ]) ?>
        </div>
    </div>
</div>
