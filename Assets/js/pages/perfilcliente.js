function actualizarDatos(e) {
    e.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const telefono = document.getElementById('telefono').value;
    const direccion = document.getElementById('direccion').value;
    const dni = document.getElementById('dni').value;
    if (nombre == '' || dni == '' || correo == '' || telefono == '' || direccion == '') {
        alertify.error("Todo los campos son requeridos");
    } else {
        const url = base_url + 'clientes/actualizarDato';
        const frm = document.getElementById("frmDatos");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
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

function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById('clave_actual').value;
    const nueva = document.getElementById('clave_nueva').value;
    const confirmar = document.getElementById('confirmar_clave').value;
    if (actual == '' || nueva == '' || confirmar == '') {
        alertify.error("Todo los campos son requeridos");
    } else {
        if (nueva != confirmar) {
            alertify.error("Las contraseñas no coinciden");
        }else{
            const url = base_url + "clientes/cambiarPass";
            const frm = document.getElementById("frmCambiarPass");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {                    
                    const res = JSON.parse(this.responseText);
                    frm.reset();
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                    }else{
                        alertify.error(res.msg);
                    }
                }
            }
        }
    }
}