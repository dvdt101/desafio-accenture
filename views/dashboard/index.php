<?php
/** @var array $stats */
$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
     <div class="row">
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-info ">
                <div class="inner">
                    <h3><?= $stats['clientsTotal'] ?></h3>
                    <p>Total de Clientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $stats['ordersPending'] ?></h3>
                    <p>Clientes Ativos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $stats['ordersCancelled'] ?></h3>
                    <p>Clientes Inativos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-info ">
                <div class="inner">
                    <h3><?= $stats['ordersTotal'] ?></h3>
                    <p>Total de Pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $stats['ordersPending'] ?></h3>
                    <p>Pedidos Pagos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $stats['ordersPending'] ?></h3>
                    <p>Pedidos Pendentes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col col-lg-3 col-md-5 col-sm-5 col-11">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $stats['ordersCancelled'] ?></h3>
                    <p>Pedidos Cancelados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>