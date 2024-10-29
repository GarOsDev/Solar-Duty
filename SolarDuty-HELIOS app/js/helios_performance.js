import { CountUp } from 'https://cdn.jsdelivr.net/npm/countup.js@2.0.8/dist/countUp.min.js';

document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    contador();
    setTimeout(mostrarInformacion,4000);
    
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

function contador() {

    const counterElement = document.getElementById('counter');
    
    const countUp = new CountUp(counterElement, 37000, { // --------------------- Paquete CountUp
        duration: 5, // duración en segundos
        separator: ',', // separador de miles
        decimal: '.' // separador decimal
    });
    
    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }

}

function mostrarInformacion(){

    let contenedor = document.getElementById("filaContador");
    const counterElement = document.getElementById('counter');
    let informacion = document.getElementById("informacionCabecera");
    let unidades = document.getElementById("unidades");

    informacion.classList.remove("oculto");
    unidades.classList.remove("oculto");

    informacion.classList.add("descubierto");
    unidades.classList.add("cifra");
    counterElement.classList.add("cifra");
    contenedor.classList.add("contenedorContador");

}



