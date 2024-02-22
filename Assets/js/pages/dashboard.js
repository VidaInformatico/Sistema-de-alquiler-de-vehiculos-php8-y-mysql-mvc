function modificarEmpresa(e) {
    e.preventDefault();
    const id = document.getElementById("id").value;
    const ruc = document.getElementById("ruc").value;
    const nombre = document.getElementById("nombre").value;
    const telefono = document.getElementById("telefono").value;
    const correo = document.getElementById("correo").value;
    const direccion = document.getElementById("direccion").value;

    if (id == '' || ruc == '' || nombre == '' || telefono == '' || correo == '' || direccion == '') {
        alertify.error("Todo los campos son requeridos");
    } else {
        const frm = document.getElementById('formulario');
        const url = base_url + 'empresa/modificar';
        const http = new XMLHttpRequest();
        let frmData = new FormData(frm);
        http.open("POST", url, true);
        http.upload.addEventListener('progress', function () {
            document.getElementById('btnAccion').textContent = 'Procesando...';
        });
        http.send(frmData);
        http.addEventListener('load', function () {
            document.getElementById('btnAccion').textContent = 'Modificar';
        });
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == 'success') {
                    alertify.success(res.msg);
                }else{
                    alertify.error(res.msg);
                }
            }
        }
    }
}
