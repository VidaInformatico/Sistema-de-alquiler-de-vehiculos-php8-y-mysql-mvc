document.addEventListener("DOMContentLoaded", function(){
    tblDoc = $('#tblDoc').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + 'documentos/listar',
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'documento'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'editar'
            },
            {
                'data': 'eliminar'
            }
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
    }); //Fin de la tabla documentos

})


function frmDoc() {
    document.getElementById("title").textContent = "Nueva Documento";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("formulario").reset();
    document.getElementById("id").value = "";
    myModal.show();
}

function registrarDoc(e) {
    e.preventDefault();
    const documento = document.getElementById("documento").value;
    if (documento == '') {
        alertify.error("El nombre es requerido");
    } else {
        const url = base_url + 'documentos/registrar';
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
                    tblDoc.ajax.reload();
                } else {
                    alertify.error(res.msg);
                }
            }
        }
    }
}

function btnEditarDoc(id) {
    document.getElementById("title").textContent = "Actualizar Documento";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + 'documentos/editar/' + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("documento").value = res.documento;
            myModal.show();
        }
    }
}

function btnEliminarDoc(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El documento no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'documentos/eliminar/' + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        tblDoc.ajax.reload();
                    } else {
                        alertify.error(res.msg);
                    }
                }
            }
        }
    })
}