<?php

use yii\helpers\Html;
use yii\bootstrap5\Breadcrumbs;
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light align-items-center justify-content-between px-3 shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link accenture-color" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between w-100">
        <h1 class="m-0 fw-bold text-dark" style="font-size: 1.5rem;">
            <?= !is_null($this->title)
                ? Html::encode($this->title)
                : Html::encode(\yii\helpers\Inflector::camelize($this->context->id)) ?>
        </h1>

        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
            'options' => ['class' => 'breadcrumb float-md-end mb-0'],
            'itemTemplate' => "<li class='breadcrumb-item color-black'>{link}</li>\n",
            'activeItemTemplate' => "<li class='breadcrumb-item accenture-color'>{link}</li>\n",
        ]) ?>
    </div>
</nav>
