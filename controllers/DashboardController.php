<?php
namespace app\controllers;

use yii;
use Exception;
use yii\web\Controller;
use app\models\Client;
use app\models\Order;

class DashboardController extends Controller
{
    public function actionIndex()
    {

        try {
            $stats = [
                'clientsTotal' => (int) Client::find()->count(),
                'clientsActive' => (int) Client::find()->where(['STATUS' => 'ATIVO'])->count(),
                'clientsInactive' => (int) Client::find()->where(['STATUS' => 'INATIVO'])->count(),
                'ordersTotal' => (int) Order::find()->count(),
                'ordersPaid' => (int) Order::find()->where(['STATUS' => 'PAGO'])->count(),
                'ordersPending' => (int) Order::find()->where(['STATUS' => 'PENDENTE'])->count(),
                'ordersCancelled' => (int) Order::find()->where(['STATUS' => 'CANCELADO'])->count(),
            ];
        } catch (Exception $e) {

            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao carregar dashboard.');
        }


        return $this->render('index', compact('stats'));
    }
}

