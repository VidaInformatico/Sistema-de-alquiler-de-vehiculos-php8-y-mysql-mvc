<?php cargarHeader($_SESSION['tipo']); ?>

<button class="btn btn-outline-primary mb-2" type="button" onclick="frmAlquiler();"><i class="fas fa-plus"></i></button>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover display responsive nowrap" id="tblAlquiler" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Doc Garantia</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Placa</th>
                        <th>Módelo</th>
                        <th>F. Prestamo</th>
                        <th>F. Devolción</th>
                        <th>Cant.</th>
                        <th>Monto</th>
                        <th>Abono</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title">Nuevo Alquiler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario" onsubmit="registrarAlquiler(event)" autocomplete="off">
                <div class="modal-body">
                    <?php foreach ($data['vehiculos'] as $row) { ?>
                        <span class="badge bg-success"> <i class="fas fa-taxi"></i> <?php echo $row['placa'] . ' - ' . $row['tipo'] . ' - ' . $row['marca'] ?></span>
                    <?php } ?>
                    <div class="card my-2">

                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <div>
                                Todo los campos con <span class="text-danger fw-bold">*</span> son obligatorio.
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" id="id_cli" name="id_cli">
                                        <input id="select_cliente" class="form-control" type="text" name="select_cliente" placeholder="Buscar Cliente" required>
                                        <label for="select_cliente">Buscar Cliente <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" id="id_veh" name="id_veh">
                                        <input id="select_vehiculo" class="form-control" type="text" name="select_vehiculo" placeholder="Buscar Vehículo" required>
                                        <label for="select_vehiculo">Buscar Vehículo <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="cantidad" required>
                                        <label for="cantidad">Cantidad <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h6>Precios</h6>
                                    <hr>
                                </div>
                                <div class="col-md-4">
                                    <label class="btn btn-outline-primary btn-block">
                                        <input type="radio" name="precios" value="1" checked> x Hora
                                    </label>
                                    <div class="form-floating mb-3">
                                        <input id="precio_hora" class="form-control" type="text" name="precio_hora" placeholder="Precio x Hora" disabled>
                                        <label for="precio_hora">Precio x Hora <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="btn btn-outline-primary btn-block">
                                        <input type="radio" name="precios" value="2"> x Dia
                                    </label>
                                    <div class="form-floating mb-3">
                                        <input id="precio_dia" class="form-control" type="text" name="precio" placeholder="_dia x Día" disabled>
                                        <label for="precio_dia">Precio x Dia <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="btn btn-outline-primary btn-block">
                                        <input type="radio" name="precios" value="3"> x Mes
                                    </label>
                                    <div class="form-floating mb-3">
                                        <input id="precio_mes" class="form-control" type="text" name="precio_mes" placeholder="Precio x Mes" disabled>
                                        <label for="precio_mes">Precio x Mes <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input id="abono" class="form-control" type="text" name="abono" placeholder="Abono" required>
                                        <label for="abono">Abono <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input id="fecha" class="form-control" type="datetime-local" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                                        <label for="fecha">Fecha/Hora <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select name="documento" id="documento" class="form-control" required>
                                            <?php foreach ($data['documentos'] as $doc) { ?>
                                                <option value="<?php echo $doc['id']; ?>"><?php echo $doc['documento']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="documento">Doc Garantia <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <textarea id="observacion" class="form-control" name="observacion" rows="3" placeholder="Observación"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary" id="btnAccion">Alquilar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="entrega" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="Label">Entrega del Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="procesarEntrega" onsubmit="procesarEntrega(event)">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id_alquiler">
                        <input id="pendiente" class="form-control" type="text" placeholder="Monto a Pendiente" disabled>
                        <label for="pendiente">Monto Abonado</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="monto_pagar" class="form-control" type="text" placeholder="Monto a Pagar" disabled>
                        <label for="monto_pagar">Pendiente</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Procesar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url . 'Assets/js/pages/alquiler.js'; ?>"></script>

</body>

</html>