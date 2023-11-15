const formulario = document.querySelector('#formulario');
let codigoPaisInput;
let iti;
const input = document.querySelector("#telefono");
let nuevoCode;
document.addEventListener('DOMContentLoaded', function(){
    iti = window.intlTelInput(input, {
		separateDialCode: true,
		initialCountry: "auto",
		geoIpLookup: function (callback) {
			fetch("https://ipapi.co/json")
				.then(function (res) { return res.json(); })
				.then(function (data) {
					callback(data.country_code);
				})
				.catch(function () {
					callback("pe");
				});
		},
		utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",

	});
    
    input.addEventListener("countrychange", function() {
        nuevoCode = iti.getSelectedCountryData();
        codigoPaisInput = '+' + nuevoCode.dialCode;
      });
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        if (formulario.nombre.value == '' || formulario.telefono.value == ''
        || formulario.correo.value == '' || formulario.direccion.value == ''
        || formulario.clave.value == '') {
            alertify.error("Todo los campos son requeridos");
        } else {
            const url = base_url + "major/verify";
            // Agrega el código de país al FormData
            const formData = new FormData(this);
            formData.append('codphone', codigoPaisInput);

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
                }
            }
        }
    })
})