<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" alt="Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Desafio Accenture</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::getAlias('@web') ?>/images/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <div class="d-flex flex-column justify-content-center align-itens-center">
                    <a href="#" class="d-block"><?= Yii::$app->user->identity->NAME ?></a>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <?= \yii\helpers\Html::a(
                            '<i class="fas fa-sign-out-alt"></i> Sair',
                            ['site/logout'],
                            [
                                'data-method' => 'post',
                            ]
                        ) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'tachometer-alt', 'url' => ['dashboard/index']],
                    [
                        'label' => 'Clientes',
                        'icon' => 'user',
                        'items' => [
                            ['label' => 'Lista de clientes', 'url' => ['client/index'], 'iconStyle' => 'far'],
                            ['label' => 'Adicionar Cliente', 'url' => ['client/create'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Pedidos',
                        'icon' => 'shopping-cart',
                        'items' => [
                            ['label' => 'Lista de Pedidos', 'url' => ['order/index'], 'iconStyle' => 'far'],
                            ['label' => 'Adicionar Pedido', 'url' => ['order/create'], 'iconStyle' => 'far'],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>