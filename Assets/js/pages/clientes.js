document.addEventListener('DOMContentLoaded', function () {
    tblClientes = $('#tblClientes').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + "clientes/listar",
            dataSrc: ''
        },
        columns: [{ 'data': 'id' },
        { 'data': 'dni' },
        { 'data': 'nombre' },
        { 'data': 'telefono' },
        { 'data': 'direccion' },
        { 'data': 'estado' },
        { 'data': 'editar' },
        { 'data': 'eliminar' }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom,
        buttons,
        resonsieve: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ]
    });//Fin de la tabla clientes
})

function frmCliente() {
    document.getElementById("title").textContent = "Nuevo Cliente";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}
function registrarCli(e) {
    e.preventDefault();
    const dni = document.getElementById("dni").value;
    const nombre = document.getElementById("nombre").value;
    const telefono = document.getElementById("telefono").value;
    const direccion = document.getElementById("direccion").value;
    if (dni == '' || nombre == '' || telefono == '' || direccion == '') {
        alertify.error("Todo los campos son requeridos");
    } else {
        const url = base_url + 'clientes/registrar';
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
                    tblClientes.ajax.reload();
                }else{
                    alertify.error(res.msg);
                }
            }
        }
    }
}
function btnEditarCli(id) {
    document.getElementById("title").textContent = "Actualizar cliente";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "clientes/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            myModal.show();
        }
    }
}
function btnEliminarCli(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El cliente no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "clientes/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        tblClientes.ajax.reload();
                    }else{
                        alertify.error(res.msg);
                    }
                }
            }

        }
    })
}