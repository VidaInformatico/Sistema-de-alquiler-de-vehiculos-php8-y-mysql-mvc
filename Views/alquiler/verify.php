<?php cargarHeader($_SESSION['tipo']); ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <input type="hidden" id="idreserva" value="<?php echo $data['reserva']['id']; ?>">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><b>Vehículo: </b> <?php echo $data['vehiculo']['tipo']; ?></li>
                    <li class="list-group-item"><b>Marca: </b> <?php echo $data['vehiculo']['marca']; ?></li>
                    <li class="list-group-item"><img class="img-thumbnail" src="<?php echo base_url . 'Assets/img/vehiculos/' . $data['vehiculo']['foto']; ?>" alt=""></li>
                </ul>
            </div>
            <div class="col-md-6">
                <?php //COMPROBAR TIPO
                if ($data['reserva']['tipo_precio'] == 1) {
                    $tipo = 'HORAS: ';
                } else if ($data['reserva']['tipo_precio'] == 2) {
                    $tipo = 'DIAS: ';
                } else {
                    $tipo = 'MESES: ';
                } ?>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><b>Cliente:</b> <?php echo $data['reserva']['nombre']; ?></li>
                    <li class="list-group-item"><b>Fecha Recogida:</b> <?php echo $data['reserva']['f_recogida']; ?></li>
                    <li class="list-group-item"><b>Fecha Entrega:</b> <?php echo $data['reserva']['f_entrega']; ?></li>
                    <li class="list-group-item"><b>Observaciones:</b> <?php echo $data['reserva']['observacion']; ?></li>
                    <li class="list-group-item"><b><?php echo $tipo; ?></b><?php echo $data['reserva']['monto']; ?></li>
                    <li class="list-group-item"><b>Total:</b> <?php echo number_format($data['reserva']['monto'] * $data['reserva']['cantidad'], 2); ?></li>
                </ul>
                <?php if ($data['reserva']['estado'] == 0) { ?>
                    <div class="text-end">
                        <button class="btn btn-primary" type="button" id="btnAprobar">Aprobar</button>
                    </div>
                <?php } ?>
            </div>

        </div>

    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url . 'Assets/js/pages/verify.js'; ?>"></script>

</body>

</html>