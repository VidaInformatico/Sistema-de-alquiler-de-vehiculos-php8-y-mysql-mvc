let tblUsuarios, tblClientes, tblMarcas, tblTipos, tblAlquiler,
tblVehiculos, myModal, tblDoc;
const buttons = [{
    //Botón para Excel
    extend: 'excelHtml5',
    footer: true,
    title: 'Reporte',
    filename: 'Reporte',
    //Aquí es donde generas el botón personalizado
    text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
},
//Botón para PDF
{
    extend: 'pdfHtml5',
    download: 'open',
    footer: true,
    title: 'Reporte',
    filename: 'Reporte',
    text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
    exportOptions: {
        columns: [0, 1, 2, 3, 5]
    }
},
//Botón para print
{
    extend: 'print',
    footer: true,
    filename: 'Reporte',
    text: '<span class="badge bg-warning"><i class="fas fa-print"></i></span>'
},
//Botón para print
{
    extend: 'csvHtml5',
    footer: true,
    filename: 'Reporte',
    text: '<span class="badge bg-success"><i class="fas fa-file-csv"></i></span>'
},
{
    extend: 'colvis',
    text: '<span class="badge bg-info"><i class="fas fa-columns"></i></span>',
    postfixButtons: ['colvisRestore']
}
];
const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'i><'col-sm-7'p>>";

document.addEventListener("DOMContentLoaded", function(){
    //fin validaciones
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    if (document.getElementById('myModal')) {
        myModal = new bootstrap.Modal(document.getElementById('myModal'));
    }

})


function preview(e) {
    var input = document.getElementById('imagen');
    var filePath = input.value;
    var extension = /(\.png|\.jpeg|\.jpg)$/i;
    if (!extension.exec(filePath)) {
        alertify.error("Seleccione un archivo valido");
        deleteImg();
        return;
    } else {
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-outline-danger" onclick="deleteImg()"><i class="fas fa-times-circle"></i></button>
        `;
    }
}
function previewLogo(e) {
    var input = document.getElementById('imagen');
    var filePath = input.value;
    var extension = /(\.png)$/i;
    if (!extension.exec(filePath)) {
        alertify.error("Seleccione un archivo valido");
        deleteImg();
        return false;
    } else {
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-outline-danger" onclick="deleteImg()"><i class="fas fa-times-circle"></i></button>
        `;
    }
}
function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}

function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}