document.addEventListener('DOMContentLoaded', function () {
    tblMarcas = $('#tblMarcas').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + 'marcas/listar',
            dataSrc: ''
        },
        columns: [
            { 'data': 'id' },
            { 'data': 'marca' },
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
    });//Fin de la tabla marcas
})

function frmMarca() {
    document.getElementById("title").textContent = "Nueva Marca";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}
function registrarMarca(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre").value;
    if (nombre == '') {
        alertify.error("El nombre es requerido");
    } else {
        const url = base_url + 'marcas/registrar';
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
                    tblMarcas.ajax.reload();
                } else {
                    alertify.error(res.msg);
                }
            }
        }
    }
}
function btnEditarMarca(id) {
    document.getElementById("title").textContent = "Actualizar Marca";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'marcas/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.marca;
            myModal.show();
        }
    }
}
function btnEliminarMarca(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La marca no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'marcas/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        tblMarcas.ajax.reload();
                    } else {
                        alertify.error(res.msg);
                    }
                }
            }
        }
    })
}