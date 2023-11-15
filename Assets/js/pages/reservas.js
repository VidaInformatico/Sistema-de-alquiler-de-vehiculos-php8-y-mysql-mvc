const fecha = document.querySelector('#fecha');
const hora = document.querySelector('#hora');
const idVehiculo = document.querySelector('#idVehiculo');
const precio_hora = document.querySelector('#precio_hora');
const precio_dia = document.querySelector('#precio_dia');
const precio_mes = document.querySelector('#precio_mes');
const frmReserva = document.querySelector('#frmReserva');
var calendarEl = document.querySelector('#container');
var elementosConClase = document.querySelectorAll(".cars");
document.addEventListener('DOMContentLoaded', function () {
    cargarReservas('reservas/listar/' + idVehiculo.value);

    frmReserva.addEventListener('submit', function (e) {
        e.preventDefault();
        if (idVehiculo.value == '' || fecha.value == '' || hora.value == '') {
            alertify.error("Todo los campos son requeridos");
        } else {
            const url = base_url + "reservas/solicitar";
            const http = new XMLHttpRequest();
            let formData = new FormData(this);
            http.open("POST", url, true);
            http.send(formData);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        frmReserva.reset();
                        cargarReservas('reservas/listar/' + idVehiculo.value);
                        $('#modalReserva').modal('hide');
                    } else {
                        alertify.error(res.msg);
                    }
                }
            }
        }
    })
})

function verificarReserva(e, id_veh) {
    e.preventDefault();
    if (elementosConClase.length > 0) {
        elementosConClase.forEach(function (elemento) {
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
        editable: true,

        dateClick: function (info) {
            if (idVehiculo.value == '') {
                alertify.error("Seleccione un vehículo");
            } else {
                cargarVehiculo(idVehiculo.value, info.dateStr);
            }
        },
    });
    calendar.render();
}

function cargarVehiculo(id_veh, fechaStart) {
    const url = base_url + "reservas/getVehiculo/" + id_veh;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            fecha.value = fechaStart;
            precio_hora.value = res.precio_hora;
            precio_dia.value = res.precio_dia;
            precio_mes.value = res.precio_mes;
            $('#modalReserva').modal('show');
        }
    }
}