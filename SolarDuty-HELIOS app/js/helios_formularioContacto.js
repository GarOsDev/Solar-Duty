document.addEventListener("DOMContentLoaded", () => {

    fecha();
    cambiarMenu();
    submitFormulario();
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

function submitFormulario(){ // SE UTILIZA API RAPIDMAIL PARA PODER ENVIAR CORREOS

    document.getElementById("formularioContacto").addEventListener("submit", (e) =>{
        e.preventDefault();

        let nombreApellidos = document.getElementById("nombreApellidos").value;
        let codPostal = document.getElementById("codPostal").value;
        let asunto = document.getElementById("asunto").value;
        let emailUsu = document.getElementById("emailUsu").value;
        let textarea = document.getElementById("textarea").value;

        const data = JSON.stringify({
            ishtml: 'false',
            sendto: 'fiercesparko11@gmail.com',
            name: nombreApellidos,
            replyTo: emailUsu,
            title: asunto,
            body: textarea
        });
        
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener('readystatechange', function () {

            if(document.getElementById("notificacion").innerHTML == ""){
                document.getElementById("rowLoader").style.display="";
                if (this.readyState === this.DONE) {
                    document.getElementById("rowLoader").style.display="none";
                    document.getElementById("notificacion").innerHTML = "Mensaje enviado. En breve le contactaremos, muchas gracias"
                }
            }
            
        });
        
        xhr.open('POST', 'https://rapidmail.p.rapidapi.com/');
        xhr.setRequestHeader('content-type', 'application/json');
        xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
        xhr.setRequestHeader('X-RapidAPI-Host', 'rapidmail.p.rapidapi.com');
        
        xhr.send(data);
    })
}

