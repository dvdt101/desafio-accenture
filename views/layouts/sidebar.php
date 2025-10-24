<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" alt="Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Desafio Accenture</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::getAlias('@web') ?>/images/user.png"  class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Usuário</a>
            </div>
        </div>

        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'tachometer-alt', 'url' => ['dashboard/index']],
                    ['label' => 'Clientes', 'icon' => 'user', 'url' => ['client/index']],
                    ['label' => 'Pedidos', 'icon' => 'shopping-cart', 'url' => ['order/index']],
                    ['label' => 'Sair', 'url' => ['site/login'], 'icon' => 'sign-out-alt', 'visible' => Yii::$app->user->isGuest],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>