
document.addEventListener("DOMContentLoaded", () => {


    cambiarEmail();
    cambiarContrasena();
    eliminarInstalacionSolar();
    eliminarCuentaHelios();

});

window.CerrarSesion = function () {

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let respuesta = this.responseText;
            if (respuesta) {
                location.href = "./helios_index.php";
            }
        }
    };

    xmlhttp.open("GET", "./ajaxFiles/cerrar_sesion.php?cls=true");
    xmlhttp.send();

}


function cambiarEmail() {

    let botonCambiarEmail = document.getElementById("cambiarEmailbtn");
    let notificaciones = document.getElementById("notificaciones");


    botonCambiarEmail.addEventListener("click", () => {

        let email1 = document.getElementById("email1").value;
        let email2 = document.getElementById("email2").value;


        if (email1 == "" || email2 == "") {
            notificaciones.innerHTML = "Rellena todos los campos"
        } else if (email1 != email2) {
            notificaciones.innerHTML = "Emails no coincidentes"
        } else {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
                if (this.readyState == 4 && this.status == 200) {

                    let respuesta = this.responseText;
                    if (respuesta) {
                        notificaciones.innerHTML = "Cambiaste tu e-mail correctamente";
                    } else {
                        console.log("fallo en el cambio")
                    }
                }
            }

            var datos = "";
            datos += "email1=" + email1;
            datos += "&";
            datos += "email2=" + email2;


            xmlhttp.open("POST", "./ajaxFiles/cuenta_usuario.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(datos);
        }
    });
}

function cambiarContrasena() {

    let botonCambiarContrasena = document.getElementById("cambiarContrasenabtn");
    let notificaciones = document.getElementById("notificaciones2");

    botonCambiarContrasena.addEventListener("click", () => {

        let pass1 = document.getElementById("contrasena1").value;
        let pass2 = document.getElementById("contrasena2").value;

        if (pass1 == "" || pass2 == "") {
            notificaciones.innerHTML = "Rellena todos los campos"
        } else if (pass1 != pass2) {
            notificaciones.innerHTML = "Contraseñas no coincidentes"
        } else {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
                if (this.readyState == 4 && this.status == 200) {

                    let respuesta = this.responseText;
                    if (respuesta) {
                        notificaciones.innerHTML = "Cambiaste tu contraseña correctamente";
                    } else {
                        console.log("fallo en el cambio")
                    }
                }
            }

            var datos = "";
            datos += "pass1=" + pass1;
            datos += "&";
            datos += "pass2=" + pass2;


            xmlhttp.open("POST", "./ajaxFiles/cuenta_usuario.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(datos);
        }

    });
}

function eliminarInstalacionSolar() {

    let botonEliminarInstalacionn = document.getElementById("eliminarInstalacionSolar");
    let notificaciones = document.getElementById("notificaciones3");

    botonEliminarInstalacionn.addEventListener("click", () => {

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
            if (this.readyState == 4 && this.status == 200) {

                let respuesta = this.responseText;
                if (respuesta) {
                    notificaciones.innerHTML = "Eliminaste tu instalación correctamente";
                } else {
                    console.log("fallo en el borrado")
                }
            }
        }

        xmlhttp.open("GET", "./ajaxFiles/cuenta_usuario.php?del");
        xmlhttp.send();
    });

}

function eliminarCuentaHelios() {

    let botonEliminarCuenta = document.getElementById("eliminarCuentaHelios");
    let notificaciones = document.getElementById("notificaciones4");
    let loader = document.getElementById("loader");

    botonEliminarCuenta.addEventListener("click", () => {


        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
            if (this.readyState == 4 && this.status == 200) {

                let respuesta = this.responseText;
                if (respuesta) {

                    notificaciones.innerHTML = "Eliminando su cuenta, espere por favor...";
                    loader.style.display = "";

                    setTimeout(() => {
                        window.location.href="./helios_index.php";
                    }, 4000);

                } else {
                    console.log("fallo en el borrado")
                }
            }
        }

        xmlhttp.open("GET", "./ajaxFiles/cuenta_usuario.php?account");
        xmlhttp.send();
    });

}