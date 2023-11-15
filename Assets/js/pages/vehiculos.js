const frm = document.getElementById("formulario");
document.addEventListener('DOMContentLoaded', function () {
    tblVehiculos = $('#tblVehiculos').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        pageLength: 25,
        ajax: {
            url: base_url + 'vehiculos/listar',
            dataSrc: ''
        },
        columns: [
            { 'data': 'id' },
            { 'data': 'imagen' },
            { 'data': 'placa' },
            { 'data': 'marca' },
            { 'data': 'tipo' },
            { 'data': 'modelo' },
            { 'data': 'estado' },
            { 'data': 'editar' },
            { 'data': 'eliminar' }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        "createdRow": function (row, data, index) {
            //pintar una celda
            if (data.estado == 2) {
                $('td', row).eq(6).html('<span class="badge bg-dark">Alquilado</span>');
            } else {
                $('td', row).eq(6).html('<span class="badge bg-success">Activo</span>');
            }
        },
        buttons,
        resonsieve: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ]
    });//Fin de vehiculos
})

function frmVehiculo() {
    document.getElementById("title").textContent = "Nuevo Vehículo";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
    deleteImg();
}
function registrarVeh(e) {
    e.preventDefault();
    if (frm.placa.value == '' || frm.marca.value == '' || frm.tipo.value == '' || frm.modelo.value == ''
        || frm.precio_hora.value == '' || frm.precio_dia.value == '' || frm.precio_mes.value == ''
        || frm.kilometraje.value == '' || frm.transmision.value == '' || frm.asientos.value == ''
        || frm.equipaje.value == '' || frm.combustible.value == '') {
            alertify.error("Todo los campos son requeridos");
    } else {
        const url = base_url + 'vehiculos/registrar';
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.upload.addEventListener('progress', function () {
            document.getElementById('btnAccion').textContent = 'Procesando...';
        });
        http.send(new FormData(frm));
        http.addEventListener('load', function () {
            document.getElementById('btnAccion').textContent = 'Procesando...';
        });
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == 'success') {
                    alertify.success(res.msg);
                    frm.reset();
                    myModal.hide();
                    tblVehiculos.ajax.reload();
                }else{
                    alertify.error(res.msg);
                }

            }
        }
    }
}
function btnEditarVeh(id) {
    document.getElementById("title").textContent = "Actualizar Vehículo";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'vehiculos/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            frm.placa.value = res.placa;
            frm.marca.value = res.id_marca;
            frm.tipo.value = res.id_tipo;
            frm.modelo.value = res.modelo;
            frm.precio_hora.value = res.precio_hora;
            frm.precio_dia.value = res.precio_dia;
            frm.precio_mes.value = res.precio_mes;
            frm.kilometraje.value = res.kilometraje;
            frm.transmision.value = res.transmision;
            frm.asientos.value = res.asientos;
            frm.equipaje.value = res.equipaje;
            frm.combustible.value = res.combustible;
            document.getElementById("img-preview").src = base_url + 'Assets/img/vehiculos/' + res.foto;
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-outline-danger" onclick="deleteImg()">
            <i class="fas fa-times-circle"></i></button>`;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("foto_actual").value = res.foto;
            myModal.show();
        }
    }
}
function btnEliminarVeh(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El vehículo no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'vehiculos/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);;
                        tblVehiculos.ajax.reload();
                    }else{
                        alertify.error(res.msg);
                    }
                }
            }

        }
    })
}