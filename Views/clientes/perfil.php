<?php cargarHeader($_SESSION['tipo']); ?>

<div class="row">
    <!--Profile Card 3-->
    <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="card text-center">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item active">Identidad: <?php echo $data['dni']; ?></li>
                    <li class="list-group-item">Correo: <?php echo $data['correo']; ?></li>
                    <li class="list-group-item active">Teléfono: <?php echo $data['telefono']; ?></li>
                    <li class="list-group-item">Dirección: <?php echo $data['direccion']; ?></li>
                    <li class="list-group-item active">Fecha registro: <?php echo $data['fecha']; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                Datos Personales
            </div>
            <div class="card-body text-center">
                <form class="my-3" id="frmDatos" onsubmit="actualizarDatos(event)" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $data['nombre'] ?>" required>
                                <label for="nombre"><i class="fas fa-list"></i> Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="dni" class="form-control" type="text" name="dni" placeholder="Identidad" value="<?php echo $data['dni'] ?>" required>
                                <label for="dni"><i class="fas fa-list"></i> Identidad</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="correo" class="form-control" type="email" name="correo" placeholder="Correo Electrónico" value="<?php echo $data['correo'] ?>" required>
                                <label for="correo"><i class="fas fa-envelope"></i> Correo</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['telefono'] ?>" required>
                                <label for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion" value="<?php echo $data['direccion'] ?>" required>
                                <label for="direccion"><i class="fas fa-home"></i> Dirección</label>
                            </div>

                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-outline-primary" type="submit" id="editarPerfil">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Midificar Contraseña
            </div>
            <div class="card-body text-center">
                <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="clave_actual" class="form-control" type="password" name="clave_actual" placeholder="Contraseña Actual" required>
                                <label for="clave_actual"><i class="fas fa-key"></i> Contraseña Actual</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="clave_nueva" class="form-control" type="password" name="clave_nueva" placeholder="Contraseña Nueva" required>
                                <label for="clave_nueva"><i class="fas fa-lock"></i> Contraseña Nueva</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave" placeholder="Confirmar Contraseña" required>
                                <label for="confirmar_clave"><i class="fas fa-unlock"></i> Confirmar Contraseña</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid gap-2 mt-2">
                                <button class="btn btn-outline-primary" type="submit">Modificar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url . 'Assets/js/pages/perfilcliente.js'; ?>"></script>

</body>

</html>