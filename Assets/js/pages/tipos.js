document.addEventListener('DOMContentLoaded', function(){
    tblTipos= $('#tblTipos').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + 'tipos/listar',
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'tipo'},
            {'data': 'estado'},
            {'data': 'editar'},
            {'data': 'eliminar'}
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
    });//Fin de la tabla Tipos
})

function frmTipo() {
    document.getElementById("title").textContent = "Nuevo Tipo";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}
function registrarTipo(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        alertify.error("El nombre es requerido");
    } else {
        const url = base_url + 'tipos/registrar';
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
                    tblTipos.ajax.reload();
                } else {
                    alertify.error(res.msg);
                }
            }
        }
    }
}
function btnEditarTipo(id) {
    document.getElementById("title").textContent = "Actualizar Tipo";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'tipos/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.tipo;
            myModal.show();
        }
    }
}
function btnEliminarTipo(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El tipo no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'tipos/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        tblTipos.ajax.reload();
                    } else {
                        alertify.error(res.msg);
                    }
                }
            }

        }
    })
}