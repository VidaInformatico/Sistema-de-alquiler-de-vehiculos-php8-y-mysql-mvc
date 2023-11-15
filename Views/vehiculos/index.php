<?php cargarHeader($_SESSION['tipo']); ?>

<button class="btn btn-outline-primary mb-2" type="button" onclick="frmVehiculo();"><i class="fas fa-plus"></i></button>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover display responsive nowrap" id="tblVehiculos" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Modelo</th>
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
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario" onsubmit="registrarVeh(event);" autocomplete="off">
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        <div>
                            Todo los campos con <span class="text-danger fw-bold">*</span> son obligatorio.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                                <input type="hidden" id="id" name="id">
                                <input id="placa" class="form-control" type="text" name="placa" placeholder="Código de barras">
                                <label for="placa">Placa<span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La marca es requerido">
                                <select id="marca" class="form-control" name="marca" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['marcas'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['marca']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="marca">Marcas <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El tipo es requerido">
                                <select id="tipo" class="form-control" name="tipo" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['tipos'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['tipo']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="tipo">Tipos <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El módelo es requerido">
                                <input id="modelo" class="form-control" type="text" name="modelo" placeholder="Módelo">
                                <label for="modelo">Módelo <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Precio Hora">
                                <input id="precio_hora" class="form-control" type="text" name="precio_hora" placeholder="Precio Hora">
                                <label for="precio_hora">Precio Hora <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Precio Dia">
                                <input id="precio_dia" class="form-control" type="text" name="precio_dia" placeholder="Precio Dia">
                                <label for="precio_dia">Precio Dia <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Precio Mes">
                                <input id="precio_mes" class="form-control" type="text" name="precio_mes" placeholder="Precio Mes">
                                <label for="precio_mes">Precio Mes <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kilometraje">
                                <input id="kilometraje" class="form-control" type="text" name="kilometraje" placeholder="Kilometraje">
                                <label for="kilometraje">Kilometraje <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Transmision">
                                <input id="transmision" class="form-control" type="text" name="transmision" placeholder="Transmision">
                                <label for="transmision">Transmision <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Asientos">
                                <input id="asientos" class="form-control" type="text" name="asientos" placeholder="Asientos">
                                <label for="asientos">Asientos<span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Equipaje">
                                <input id="equipaje" class="form-control" type="text" name="equipaje" placeholder="Equipaje">
                                <label for="equipaje">Equipaje <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Combustible">
                                <input id="combustible" class="form-control" type="text" name="combustible" placeholder="Combustible">
                                <label for="combustible">Combustible <span class="text-danger fw-bold">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Foto</label>
                            <div class="form-floating mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                        <input type="hidden" id="foto_actual" name="foto_actual">
                                        <img class="img-thumbnail" id="img-preview" width="300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url . 'Assets/js/pages/vehiculos.js'; ?>"></script>

</body>

</html>