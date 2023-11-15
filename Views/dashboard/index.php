<?php cargarHeader($_SESSION['tipo']); ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form id="formulario" onsubmit="modificarEmpresa(event)" autocomplete="off">
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
                        Todo los campos son <span class="text-danger fw-bold">*</span> son obligatorio.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El ruc es requerido">
                            <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['empresa']['id'] ?>" required>
                            <input id="ruc" class="form-control" type="number" name="ruc" placeholder="Ruc" value="<?php echo $data['empresa']['ruc'] ?>" required>
                            <label for="ruc"><i class="fas fa-id-card"></i> Ruc <span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El nombre es requerido">
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $data['empresa']['nombre'] ?>" required>
                            <label for="nombre"><i class="fas fa-list"></i> Nombre <span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <div class="col-md-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El teléfono es requerido">
                        <div class="form-floating mb-3">
                            <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['empresa']['telefono'] ?>" required>
                            <label for="telefono"><i class="fas fa-phone"></i> Teléfono <span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="El correo es requerido">
                            <input id="correo" class="form-control" type="text" name="correo" placeholder="Correo" value="<?php echo $data['empresa']['correo'] ?>" required>
                            <label for="correo"><i class="fas fa-envelope"></i> Correo <span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La dirección es requerido">
                            <textarea id="direccion" class="form-control" name="direccion" rows="3" placeholder="Dirección" required><?php echo $data['empresa']['direccion'] ?></textarea>
                            <label for="direccion"><i class="fas fa-home"></i> Dirección <span class="text-danger fw-bold">*</span> </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mensaje"><i class="fas fa-envelope"></i> Mensaje</label>
                            <textarea id="mensaje" class="form-control" name="mensaje" rows="3"><?php echo $data['empresa']['mensaje'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-image"></i> Logo - PNG (512 x 512 pixeles) recomendado </label>
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" id="foto_actual">
                                    <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> </label>
                                    <span id="icon-cerrar"></span>
                                    <input id="imagen" class="d-none" type="file" name="imagen" onchange="previewLogo(event)">
                                    <img class="img-thumbnail" id="img-preview" src="<?php echo base_url; ?>Assets/img/<?php echo $data['empresa']['logo']; ?>" width="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end my-3">
                    <button class="btn btn-outline-primary" type="submit" id="btnAccion">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url; ?>Assets/js/pages/dashboard.js"></script>
</body>

</html>