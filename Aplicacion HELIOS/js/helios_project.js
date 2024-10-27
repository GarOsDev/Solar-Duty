document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    sombra();
    

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


function cambiarMenu(){

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

function sombra(){

    let cuerpo = document.getElementsByClassName("diagrama")[0];
    let warn1 = document.getElementById("warn1");
    let i1 = document.getElementById("i1");
    let warn2 = document.getElementById("warn2");
    let i2 = document.getElementById("i2");
    let warn3 = document.getElementById("warn3");
    let i3 = document.getElementById("i3");
    let warn4 = document.getElementById("warn4");
    let i4 = document.getElementById("i4");

    warn1.addEventListener("mouseover", () => {
        i1.style.opacity=1;
        i1.style.transition = "opacity 0.5s";
        cuerpo.classList.add("sombreado");
    });
    warn1.addEventListener("mouseout", () => {
        i1.style.opacity=0;
        i1.style.transition = "opacity 0.5s";
        cuerpo.classList.remove("sombreado");
    });

    warn2.addEventListener("mouseover", () => {
        i2.style.opacity=1;
        i2.style.transition = "opacity 0.5s";
        cuerpo.classList.add("sombreado");
    });
    warn2.addEventListener("mouseout", () => {
        i2.style.opacity=0;
        i2.style.transition = "opacity 0.5s";
        
        cuerpo.classList.remove("sombreado");
    });

    warn3.addEventListener("mouseover", () => {
        i3.style.opacity=1;
        i3.style.transition = "opacity 0.5s";
        cuerpo.classList.add("sombreado");
    });
    warn3.addEventListener("mouseout", () => {
        i3.style.opacity=0;
        i3.style.transition = "opacity 0.5s";
        
        cuerpo.classList.remove("sombreado");
    });

    warn4.addEventListener("mouseover", () => {
        i4.style.opacity=1;
        i4.style.transition = "opacity 0.5s";
        cuerpo.classList.add("sombreado");
    });
    warn4.addEventListener("mouseout", () => {
        i4.style.opacity=0;
        i4.style.transition = "opacity 0.5s";
        
        cuerpo.classList.remove("sombreado");
    });



}