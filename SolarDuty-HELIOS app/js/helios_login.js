document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    Login();
    reestablecerContrasena();
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

function Login() {

    let nomUsu = document.getElementById("userName");
    let passUsu = document.getElementById("pass");
    let warnings = document.getElementById("warnings");
    let botonlogin = document.getElementById("logueo");

    passUsu.addEventListener("input", () => {
        if (nomUsu.value.trim() != "") {
            botonlogin.removeAttribute("disabled");
        }
    })

    nomUsu.addEventListener("input", () => {
        if (passUsu.value.trim() != "") {
            botonlogin.removeAttribute("disabled");
        }
    })

    let formulario = document.getElementById("loginForm").addEventListener("submit", (e) => {
        e.preventDefault();

        /* *********************** PETICION AJAX COMPROBAR USUARIO********************* */

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
            if (this.readyState == 4 && this.status == 200) {

                let respuesta = JSON.parse(this.responseText);
                if (respuesta.mensaje) {
                    warnings.innerHTML = respuesta.mensaje;
                } else if (respuesta.mensaje2) {
                    window.location.href = "./helios_index.php";
                }

                warnings.style.opacity = "1";
            }
        }

        var datos = "";
        datos += "user=" + nomUsu.value.toLowerCase();
        datos += "&";
        datos += "contra=" + passUsu.value;


        xmlhttp.open("POST", "./ajaxFiles/login.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(datos);


    });
}

function reestablecerContrasena() {

    let usuario = document.getElementById("usuario");
    let pass1 = document.getElementById("contrasena1");
    let pass2 = document.getElementById("contrasena2");
    let notificaciones = document.getElementById("notificaciones");
    let boton = document.getElementById("botonCambiar");


    usuario.addEventListener("input", () => {
        if (pass1.value != "" && pass2.value != "") {
            boton.removeAttribute("disbled");
        }
    })
    
    pass1.addEventListener("input", () => {
        if (usuario.value != "" && pass2.value != "") {
            boton.removeAttribute("disbled");
        }
    })
    pass2.addEventListener("input", () => {
        if (usuario.value != "" && pass1.value != "") {
            boton.removeAttribute("disabled");
        }
    })

    boton.addEventListener("click", () => {

        let usuario = document.getElementById("usuario");
        let pass1 = document.getElementById("contrasena1");
        let pass2 = document.getElementById("contrasena2");

        if (usuario.value == "" || pass1.value == "" || pass2.value == "") {
            notificaciones.innerHTML = "Rellena todos los campos"
        } else if (pass1.value != pass2.value) {
            notificaciones.innerHTML = "Nuevas Contraseñas no coincidentes"
        } else {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
                if (this.readyState == 4 && this.status == 200) {

                    let respuesta = JSON.parse(this.responseText);
                    if (respuesta.mensaje) {
                        notificaciones.innerHTML = respuesta.mensaje;
                    } else {
                        usuario.value = "";
                        pass1.value = "";
                        pass2.value = "";
                        notificaciones.innerHTML = respuesta.mensaje2;
                    }
                    console.log(respuesta);
                }
            }

            var datos = "";
            datos += "usuario=" + usuario.value;
            datos += "&";
            datos += "pass1=" + pass1.value;
            datos += "&";
            datos += "pass2=" + pass2.value;


            xmlhttp.open("POST", "./ajaxFiles/login.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(datos);
        }
    })



}


