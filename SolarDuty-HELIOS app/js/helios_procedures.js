document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    mostrarInfo();
    
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


function mostrarInfo(){

    let flecha = document.getElementById("flecha1");
    let imagen = document.getElementById("img1");
    let texto = document.getElementById("txt1");
    let bordeFlecha = document.getElementById("icon1");

    let flecha2 = document.getElementById("flecha2");
    let imagen2 = document.getElementById("img2");
    let texto2 = document.getElementById("txt2");

    let flecha3 = document.getElementById("flecha3");
    let imagen3 = document.getElementById("img3");
    let texto3 = document.getElementById("txt3");

    let flecha4 = document.getElementById("flecha4");
    let imagen4 = document.getElementById("img4");
    let texto4 = document.getElementById("txt4");
    

    flecha.addEventListener("click", () => {
        
        if(imagen.classList.contains("animacionImagenIda")){

            flecha.style.rotate = "0deg";
            flecha.style.transition = "rotate 0.1s";
            
            bordeFlecha.style.background = "white";
            bordeFlecha.style.transition = "background 1s";
            
            imagen.classList.add("animacionImagenVuelta");
            imagen.classList.remove("animacionImagenIda");
            imagen.style.opacity = "0";
            imagen.style.transition = "opacity 0.5s";

            texto.classList.add("animacionTextoVuelta");
            texto.classList.remove("animacionTextoIda");
            texto.style.opacity = "0";
            texto.style.transition = "opacity 0.5s";

        }else{

            flecha.style.rotate = "90deg";
            flecha.style.transition = "rotate 0.1s";

            bordeFlecha.style.background = "linear-gradient(90deg, rgba(47,79,79,1) 0%, rgba(44,166,161,1) 50%, rgba(47,79,79,1) 100%)";
            bordeFlecha.style.transition = "background 1s";

            imagen.classList.add("animacionImagenIda");
            imagen.classList.remove("animacionImagenVuelta");
            imagen.style.opacity = "1";
            imagen.style.transition = "opacity 1s";
            

            texto.classList.add("animacionTextoIda");
            texto.classList.remove("animacionTextoVuelta");
            texto.style.opacity = "1";
            texto.style.transition = "opacity 1s";

        }
    })

    flecha2.addEventListener("click", () => {
        
        if(imagen2.classList.contains("animacionImagenIdaB")){

            flecha2.style.rotate = "0deg";
            flecha2.style.transition = "rotate 0.1s";
                    
            imagen2.classList.add("animacionImagenVueltaB");
            imagen2.classList.remove("animacionImagenIdaB");
            imagen2.style.opacity = "0";
            imagen2.style.transition = "opacity 0.5s";

            texto2.classList.add("animacionTextoVueltaB");
            texto2.classList.remove("animacionTextoIdaB");
            texto2.style.opacity = "0";
            texto2.style.transition = "opacity 0.5s";

        }else{

            flecha2.style.rotate = "-90deg";
            flecha2.style.transition = "rotate 0.1s";

            imagen2.classList.add("animacionImagenIdaB");
            imagen2.classList.remove("animacionImagenVueltaB");
            imagen2.style.opacity = "1";
            imagen2.style.transition = "opacity 1s";
            

            texto2.classList.add("animacionTextoIdaB");
            texto2.classList.remove("animacionTextoVueltaB");
            texto2.style.opacity = "1";
            texto2.style.transition = "opacity 1s";

        }
    })

    flecha3.addEventListener("click", () => {
        
        if(imagen3.classList.contains("animacionImagenIda")){

            flecha3.style.rotate = "0deg";
            flecha3.style.transition = "rotate 0.1s";
            
            imagen3.classList.add("animacionImagenVuelta");
            imagen3.classList.remove("animacionImagenIda");
            imagen3.style.opacity = "0";
            imagen3.style.transition = "opacity 0.5s";

            texto3.classList.add("animacionTextoVuelta");
            texto3.classList.remove("animacionTextoIda");
            texto3.style.opacity = "0";
            texto3.style.transition = "opacity 0.5s";

        }else{

            flecha3.style.rotate = "90deg";
            flecha3.style.transition = "rotate 0.1s";

            imagen3.classList.add("animacionImagenIda");
            imagen3.classList.remove("animacionImagenVuelta");
            imagen3.style.opacity = "1";
            imagen3.style.transition = "opacity 1s";
            

            texto3.classList.add("animacionTextoIda");
            texto3.classList.remove("animacionTextoVuelta");
            texto3.style.opacity = "1";
            texto3.style.transition = "opacity 1s";

        }
    })

    flecha4.addEventListener("click", () => {
        
        if(imagen4.classList.contains("animacionImagenIdaB")){

            flecha4.style.rotate = "0deg";
            flecha4.style.transition = "rotate 0.1s";
                    
            imagen4.classList.add("animacionImagenVueltaB");
            imagen4.classList.remove("animacionImagenIdaB");
            imagen4.style.opacity = "0";
            imagen4.style.transition = "opacity 0.5s";

            texto4.classList.add("animacionTextoVueltaB");
            texto4.classList.remove("animacionTextoIdaB");
            texto4.style.opacity = "0";
            texto4.style.transition = "opacity 0.5s";

        }else{

            flecha4.style.rotate = "-90deg";
            flecha4.style.transition = "rotate 0.1s";

            imagen4.classList.add("animacionImagenIdaB");
            imagen4.classList.remove("animacionImagenVueltaB");
            imagen4.style.opacity = "1";
            imagen4.style.transition = "opacity 1s";
            

            texto4.classList.add("animacionTextoIdaB");
            texto4.classList.remove("animacionTextoVueltaB");
            texto4.style.opacity = "1";
            texto4.style.transition = "opacity 1s";

        }
    })
}
