<?php cargarHeader($_SESSION['tipo']); ?>

<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0 font-weight-bold">Panel de Administración</h3>
        <p>Reportes Gráficos.</p>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-info mb-4">
            <div class="card-body">
                <i class="fas fa-user fa-2x"></i> Usuarios
                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-info">
                    <i class="fas fa-users"></i>
                    <?php echo $data['usuarios']['total']; ?>
                    <span class="visually-hidden"></span>
                </span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between bg-info">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>usuarios">Ver detalle</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-success mb-4">
            <div class="card-body">
                <i class="fas fa-users fa-2x"></i> Clientes
                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-success">
                    <i class="fas fa-users"></i>
                    <?php echo $data['clientes']['total']; ?>
                    <span class="visually-hidden"></span>
                </span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between bg-success">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>clientes">Ver detalle</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-danger mb-4">
            <div class="card-body">
                <i class="fas fa-taxi fa-2x"></i> Vehiculos
                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">
                    <i class="fab fa-product-hunt"></i>
                    <?php echo $data['vehiculos']['total']; ?>
                    <span class="visually-hidden"></span>
                </span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between bg-danger">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>vehiculos">Ver detalle</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6">
        <div class="card text-warning mb-4">
            <div class="card-body"><i class="fas fa-tags fa-2x"></i> Tipos
                <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning">
                    <i class="fas fa-tag"></i>
                    <?php echo $data['tipos']['total']; ?>
                    <span class="visually-hidden"></span>
                </span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between bg-warning">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>tipos">Ver detalle</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rentas por Mes</h4>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rentas por Semana</h4>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url; ?>Assets/vendors/chart.js/Chart.min.js"></script>

<script src="<?php echo base_url; ?>Assets/js/chart.js"></script>

</body>

</html>