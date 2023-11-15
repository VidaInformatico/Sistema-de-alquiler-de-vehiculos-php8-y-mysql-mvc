const btnAprobar = document.querySelector('#btnAprobar');
const idreserva = document.querySelector('#idreserva');
document.addEventListener('DOMContentLoaded', function () {
    if (btnAprobar) {
        btnAprobar.addEventListener('click', function () {
            if (idreserva.value == '') {
                alertify.error("Error desconocido");
            } else {
                alertify.confirm("Esta seguro de aprobar", function (e) {
                    if (e) {
                        const url = base_url + 'reservas/aprobar/' + idreserva.value;
                        const http = new XMLHttpRequest();
                        http.open("GET", url, true);
                        http.send();
                        http.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                const res = JSON.parse(this.responseText);
                                if (res.icono == 'success') {
                                    alertify.success(res.msg);;
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                } else {
                                    alertify.error(res.msg);
                                }
                            }
                        }
                    }
                });
                return false;
            }


        })
    }

})