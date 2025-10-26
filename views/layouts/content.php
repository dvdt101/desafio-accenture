<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper">
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <?php
        switch ($type) {
            case 'success':
                $text = 'Sucesso';
                $alertClass = 'alert-success';
                $icon = 'check';
                break;
            case 'error':
                $text = 'Erro';
                $alertClass = 'alert-danger';
                $icon = 'ban';
                break;
            case 'warning':
                $text = 'Aviso';
                $alertClass = 'alert-warning';
                $icon = 'exclamation-triangle';
                break;
            case 'info':
            default:
                $text = 'Informação';
                $alertClass = 'alert-info';
                $icon = 'info';
                break;
        }
        ?>
        <div class="alert <?= $alertClass ?> alert-dismissible m-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-<?= $icon ?>"></i> <?= ucfirst($text) ?>!</h5>
            <?= \yii\helpers\Html::encode($message) ?>
        </div>
    <?php endforeach; ?>
    <!-- Main content -->
    <div class="content pt-2">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>