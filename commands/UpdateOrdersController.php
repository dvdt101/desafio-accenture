<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Order;
use Yii;

class UpdateOrdersController extends Controller
{
    public function actionIndex()
    {
        $today = date('Y-m-d H:i:s');

        $orders = Order::find()
            ->where(['STATUS' => 'PENDENTE'])
            ->andWhere(['<', 'ORDER_DATE', new \yii\db\Expression("SYSDATE - 7")])
            ->all();

        $count = count($orders);

        if ($count > 0) {
            foreach ($orders as $order) {
                $order->STATUS = 'CANCELADO';
                $order->save(false);
            }
        }

        $logMsg = sprintf("[%s] %d pedidos atualizados para 'cancelado'.\n", $today, $count);
        $logPath = Yii::getAlias('@runtime/logs/pedidos_cron.log');

        file_put_contents($logPath, $logMsg, FILE_APPEND);

        echo "Processo concluído: {$count} pedidos atualizados.\n";
        return ExitCode::OK;
    }
}
