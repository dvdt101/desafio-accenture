<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Client;
use app\models\Order;

class DashboardController extends Controller
{
    public function actionIndex()
    {

        $stats = [
            'clientsTotal'   => (int) Client::find()->count(),
            'clientsActive'  => (int) Client::find()->where(['STATUS' => 'ATIVO'])->count(),
            'ordersTotal'    => (int) Order::find()->count(),
            'ordersPending'  => (int) Order::find()->where(['STATUS' => 'PENDENTE'])->count(),
            'ordersCancelled' => (int) Order::find()->where(['STATUS'=> 'CANCELADO'])->count(),
        ];

        return $this->render('index', compact('stats'));
    }
}
