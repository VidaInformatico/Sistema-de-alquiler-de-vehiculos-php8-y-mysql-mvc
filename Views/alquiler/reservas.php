<?php cargarHeader($_SESSION['tipo']); ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 overflow-auto" style="max-height: 500px;">
                <ul class="list-group">
                    <?php foreach ($data['vehiculos'] as $car) { ?>
                        <li class="list-group-item cars <?php echo (!empty($_GET['car']) && $_GET['car'] == $car['id']) ? 'bg-warning' : ''; ?>" id="<?php echo $car['id']; ?>">
                            <img class="img-thumbnail" width="50" src="<?php echo base_url . 'Assets/img/vehiculos/' . $car['foto']; ?>" alt="">
                            <a href="#" class="text-decoration-none" onclick="verificarReserva(event, <?php echo $car['id']; ?>)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click Aqui">
                                <?php echo $car['tipo'] . ' - ' . $car['marca']; ?>
                            </a>
                        </li>
                        <hr>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-9">
                <div id="container"></div>
            </div>
        </div>

    </div>
</div>

<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalReserva" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Nueva reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmReserva" method="post" autocomplete="off">
                <input type="hidden" id="idVehiculo" name="idVehiculo" value="<?php echo (!empty($_GET['car']) && is_numeric($_GET['car'])) ? $_GET['car'] : ''; ?>">
                <div class="modal-body">

                    <div class="row">
                        <div class="form-floating mb-3 col-md-6">
                            <input class="form-control" type="date" id="fecha" name="fecha">
                            <label for="fecha">Fecha <span class="text-danger fw-bold">*</span></label>
                        </div>
                        <div class="form-floating mb-3 col-md-3">
                            <input class="form-control" type="time" id="hora" name="hora">
                            <label for="hora">Hora <span class="text-danger fw-bold">*</span></label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="cantidad" required>
                                <label for="cantidad">Cant. <span class="text-danger fw-bold">*</span></label>
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
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <textarea id="observacion" class="form-control" name="observacion" rows="3" placeholder="Observación"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btnSolicitar">Solicitar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php cargarFooter($_SESSION['tipo']); ?>

<script src="<?php echo base_url; ?>Assets/vendors/fullcalendar/js/main.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/es.global.min.js"></script>

<?php if ($_SESSION['tipo'] == 2) { ?>
    <script src="<?php echo base_url; ?>Assets/js/pages/reservas.js"></script>
<?php } else { ?>
    <script>
        const idVehiculo = document.querySelector('#idVehiculo');
        var calendarEl = document.querySelector('#container');
        var elementosConClase = document.querySelectorAll(".cars");
        document.addEventListener('DOMContentLoaded', function() {
            cargarReservas('reservas/listar/' + idVehiculo.value);
        })

        function verificarReserva(e, id_veh) {
            e.preventDefault();
            if (elementosConClase.length > 0) {
                elementosConClase.forEach(function(elemento) {
                    if (elemento.id == id_veh) {
                        // Obtener la cadena de consulta actual
                        var queryParams = new URLSearchParams(window.location.search);
                        // Modificar el valor del parámetro 'tuParametro'
                        queryParams.set('car', id_veh);
                        // Obtener la nueva URL con la cadena de consulta modificada
                        var nuevaURL = window.location.pathname + '?' + queryParams.toString();
                        // Reemplazar la URL actual sin recargar la página
                        history.replaceState(null, null, nuevaURL);
                        // Si el id coincide, agregar la clase; de lo contrario, quitarla
                        idVehiculo.value = id_veh;
                        elemento.classList.add("bg-warning");
                    } else {
                        elemento.classList.remove("bg-warning");
                    }
                });
            }
            const url = 'reservas/listar/' + id_veh;
            cargarReservas(url);
        }

        function cargarReservas(ruta) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'es',
                events: base_url + ruta,
            });
            calendar.render();
        }
    </script>
<?php } ?>

</body>

</html>