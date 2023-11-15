let m_entrega = new bootstrap.Modal(document.getElementById('entrega'));

document.addEventListener('DOMContentLoaded', function(){
    tblAlquiler = $('#tblAlquiler').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + 'alquiler/listar',
            dataSrc: ''
        },
        columns: [{
                'data': 'id'},
            {'data': 'documento'},
            {'data': 'nombre'},
            {'data': 'tipo'},
            {'data': 'placa'},
            {'data': 'modelo'},
            {'data': 'f_prestamo'},
            {'data': 'f_devolucion'},
            {'data': 'cantidad'},
            {'data': 'monto'},
            {'data': 'abono'},
            {'data': 'estatus'},
            {'data': 'recibir'},
            {'data': 'accion'},
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons,
        "createdRow": function (row, data, index) {
            //pintar una celda
            if (data.estado == 1) {
                $('td', row).eq(10).html('<span class="badge bg-dark">Prestado</span>');
                $('td', row).css({
                'background-color': '#FEA4AE'
                });
            } else {
                $('td', row).eq(10).html('<span class="badge bg-success">Devuelto</span>');
            }
        },
        resonsieve: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ]
    }); //Fin de la tabla alquiler

    $("#select_cliente").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: base_url + 'clientes/buscarCliente/',
                dataType: "json",
                data: {
                    cli: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            document.getElementById('id_cli').value = ui.item.id;
            document.getElementById('select_cliente').value = ui.item.nombre;
        }
    })

    $("#select_vehiculo").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                url: base_url + 'vehiculos/buscarVehiculo',
                dataType: "json",
                data: {
                    veh: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            document.getElementById('id_veh').value = ui.item.id;
            document.getElementById('select_vehiculo').value = ui.item.placa;
            document.getElementById('precio_dia').value = ui.item.dia;
            document.getElementById('precio_hora').value = ui.item.hora;
            document.getElementById('precio_mes').value = ui.item.mes;
        }
    })
})

function frmAlquiler() {
    document.getElementById("title").textContent = "Nuevo Alquiler";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    myModal.show();
}

function registrarAlquiler(e) {
    e.preventDefault();
    const select_cliente = document.getElementById("select_cliente").value;
    const select_vehiculo = document.getElementById("select_vehiculo").value;
    const id_cli = document.getElementById("id_cli").value;
    const id_veh = document.getElementById("id_veh").value;
    const cantidad = document.getElementById("cantidad").value;
    const abono = document.getElementById("abono").value;
    const fecha = document.getElementById("fecha").value;
    const documento = document.getElementById("documento").value;
    if (select_cliente == '' || select_vehiculo == '' || id_cli == '' || id_veh == ''
    || cantidad == '' || abono == '' || fecha == '' || documento == '') {
        alertify.error("Todo los campos son requeridos");
    } else {
        const url = base_url + 'alquiler/registrar';
        const frm = document.getElementById("formulario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == 'success') {
                    alertify.success(res.msg);
                    frm.reset();
                    myModal.hide();
                    tblAlquiler.ajax.reload();
                    setTimeout(() => {
                        window.open(base_url + 'alquiler/pdfPrestamo/'+ res.id_alquiler);
                    }, 2000);
                }else{
                    alertify.error(res.msg);
                }
            }
        }
    }
}
function entrega(id) {
    const url = base_url + 'alquiler/ver/'+ id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById('id_alquiler').value = res.id;
            document.getElementById('pendiente').value = res.abono;
            let = total = parseFloat((res.monto * res.cantidad) - res.abono);
            document.getElementById('monto_pagar').value = total.toFixed(2);
            m_entrega.show();
        }
    }
    
}
function procesarEntrega(e) {
    e.preventDefault();
    const id = document.getElementById('id_alquiler').value;
    const url = base_url + 'alquiler/procesar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.icono == 'success') {
                alertify.success(res.msg);
                m_entrega.hide();
                tblAlquiler.ajax.reload();
            }else{
                alertify.error(res.msg);
            }           
        }
    }
}