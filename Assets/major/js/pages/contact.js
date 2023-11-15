const formulario = document.querySelector('#formulario');
const btnEnviar = document.querySelector('#btnEnviar');
document.addEventListener('DOMContentLoaded', function(){
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        if (formulario.nombre.value == '' || formulario.asunto.value == ''
        || formulario.correo.value == '' || formulario.mensaje.value == '') {
            alertify.error("Todo los campos son requeridos");
        } else {
            btnEnviar.value = 'Enviando...';
            const url = base_url + "contact/enviarCorreo";
            // Agrega el código de país al FormData
            const formData = new FormData(this);
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(formData);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {              
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        alertify.success(res.msg);
                        formulario.reset();
                    } else {
                        alertify.error(res.msg);
                    }
                    btnEnviar.value = 'Enviar Mensaje';
                }
            }
        }
    })
})