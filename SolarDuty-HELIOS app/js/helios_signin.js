document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    SignIn();
    ComprobarUsuario();

})


function fecha() {

    const dia = new Date().getDate();
    const mes = new Date().getMonth();
    const anio = new Date().getFullYear();
    const diaSemana = new Date().getDay();

    const hora = new Date().getHours();
    const minutos = new Date().getMinutes();
    const segundos = new Date().getSeconds();

    let fecha = dia + "/" + (mes + 1) + "/" + anio;
    let tiempo = `${hora}:${minutos}:${segundos}`;

    let diaSemanaString = "";

    switch (diaSemana) {
        case 0:
            diaSemanaString = "Domingo";
            break;
        case 1:
            diaSemanaString = "Lunes";
            break;
        case 2:
            diaSemanaString = "Martes";
            break;
        case 3:
            diaSemanaString = "Miércoles";
            break;
        case 4:
            diaSemanaString = "Jueves";
            break;
        case 5:
            diaSemanaString = "Viernes";
            break;
        case 6:
            diaSemanaString = "Sábado";
            break;
    }


    function tiempos() {

        const hora = new Date().getHours();
        const minutos = new Date().getMinutes();
        const segundos = new Date().getSeconds();

        let tiempo = `${hora}:${minutos}:${segundos}`;

        if (segundos < 10) {
            tiempo = `${hora}:${minutos}:0${segundos}`;
        }
        if (minutos < 10) {
            tiempo = `${hora}:0${minutos}:${segundos}`;
        }
        if (minutos < 10 && segundos < 10) {
            tiempo = `${hora}:0${minutos}:0${segundos}`;
        }

        document.getElementById("fecha").innerHTML = diaSemanaString + " - " + fecha + " - " + tiempo;

    }

    document.getElementById("fecha").innerHTML = diaSemanaString + " - " + fecha + " - " + tiempo;


    setInterval(tiempos, 1000);

}


function cambiarMenu() {

    let boton = document.getElementById("hamenu");
    let menu = document.getElementsByClassName("menu")[0];
    let fechaCont = document.getElementsByClassName("fechaCont")[0];
    let header = document.getElementsByTagName("header")[0];


    boton.addEventListener("click", () => {

        if (menu.style.display) {
            boton.setAttribute("src", "iconos_svg/close-menu.svg");
            menu.removeAttribute("style");
            fechaCont.style.display = "none";

            document.getElementById("conceptos").classList.add("trackingA");
            document.getElementById("desarrollo").classList.add("trackingB");
            document.getElementById("utilidad").classList.add("trackingC");
            document.getElementById("sesion").classList.add("li1");

        } else {
            boton.setAttribute("src", "iconos_svg/open-menu.svg");
            menu.style.display = "none";
            fechaCont.removeAttribute("style");
        }

    })

    header.addEventListener("mouseleave", () => {

        if (!menu.style.display) {

            menu.style.opacity = "0";
            menu.style.transition = "0.25s opacity";

            boton.style.opacity = "0";
            boton.style.transition = "0.25s opacity";

            setTimeout(() => {
                menu.style.display = "none";
                boton.setAttribute("src", "iconos_svg/open-menu.svg");
                boton.style.opacity = "1";
                fechaCont.removeAttribute("style");
            }, 250)
        }

    })


}

function SignIn() {

    let nombre = document.getElementById("nombre");
    let apellidos = document.getElementById("apellidos");
    let nombreUsu = document.getElementById("nombreUsu");
    let contrasena = document.getElementById("contrasena");
    let email = document.getElementById("email");
    let provincia = document.getElementById("provincia");
    let municipio = document.getElementById("municipio");
    let warnings = document.getElementById("warnings");

    provincia.addEventListener("change", () => {

        let IdProvincia = provincia.value;
        municipio.removeAttribute("disabled");
        

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {

                let respuesta = this.responseText;

                municipio.innerHTML = respuesta;
            }

        };

        xmlhttp.open("GET", "./ajaxFiles/registro.php?prov=" + IdProvincia);

        xmlhttp.send();


    })


    let formulario = document.getElementById("signInForm").addEventListener("submit", (e) => {
        e.preventDefault();

        if (nombre.value == "" || apellidos.value == "" || nombreUsu.value == "" || contrasena.value == "" || email.value == "" || provincia.value == "" || municipio.value == "") {
            warnings.style.opacity = "1";
            warnings.innerHTML = "Rellene los campos vacíos"
        } else {

            /* *********************** PETICION AJAX REGISTRAR USUARIO********************* */

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
                if (this.readyState == 4 && this.status == 200) {

                    let respuesta = this.responseText;

                    if (respuesta) {
                        window.location.href = "./helios_userPanel.php";
                    } else {
                        warnings.style.opacity = "1";
                        warnings.innerHTML = "Fallo en el registro";
                    }

                }
            }


            var datos = "";
            datos += "nom=" + nombre.value;
            datos += "&";
            datos += "ape=" + apellidos.value;
            datos += "&";
            datos += "nomUsu=" + nombreUsu.value.toLowerCase();
            datos += "&";
            datos += "pass=" + contrasena.value;
            datos += "&";
            datos += "email=" + email.value;
            datos += "&";
            datos += "prov=" + provincia.value;
            datos += "&";
            datos += "munic=" + municipio.value;

            console.log(datos);


            xmlhttp.open("POST", "./ajaxFiles/registro.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(datos);
        }

    });
}

function ComprobarUsuario() {

    let usuario = document.getElementById("nombreUsu");
    let warnings = document.getElementById("warnings");
    let input = document.getElementById("inputReg");

    usuario.addEventListener("focusout", () => {

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {

                let respuesta = JSON.parse(this.responseText);
                console.log(respuesta);

                if (respuesta.mensaje1) {
                    warnings.innerHTML = "Nombre de usuario ya registrado";
                    input.setAttribute("disabled", "");
                } else {
                    input.removeAttribute("disabled");
                    warnings.innerHTML = "";
                }
            }

        };

        console.log(usuario.value);

        xmlhttp.open("GET", "./ajaxFiles/registro.php?usu=" + usuario.value);

        xmlhttp.send();

    })


}


