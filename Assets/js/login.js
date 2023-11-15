function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    if (usuario.value == "" || clave.value == "") {
        alertify.error("Todo los campos son requeridos");
    } else {
        const url = base_url + "login/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    alertify.success(res.msg);
                    setTimeout(() => {
                        window.location = base_url + "dashboard";
                    }, 1500);                    
                } else {
                    alertify.error(res.msg);
                }
            }
        }
    }
}