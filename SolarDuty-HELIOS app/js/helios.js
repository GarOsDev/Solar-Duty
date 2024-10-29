
document.addEventListener("DOMContentLoaded", () => {

    fecha();
    setInterval(fecha,1000);
    TiempoMain();
    videos();
    cambiarMenu();
    mostrarHora();
    hamburgerMenu();
    mostrarTexto();
    MenuDesplegableScroll();
    
})


function fecha() {

    let fecha = new Date();
    let diaSemanaString = "";

    let dia = fecha.getDate();
    let mes = fecha.getMonth();
    let anio = fecha.getFullYear();
    let diaSemana = fecha.getDay();

    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();


    if (segundos < 10) {
        segundos = "0" + segundos;
    }

    if (minutos < 10) {
        minutos = "0" + minutos;
    }

    if (horas < 10) {
        horas = "0" + horas;
    }

    if(dia < 10){
        dia = "0" + dia;
    }

    if(mes < 10){
        mes = "0" + (mes+1);
    }


    let dias = dia + "/" + mes + "/" + anio;
    let tiempo = `${horas}:${minutos}:${segundos}`;

    
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

    let tiempoCompleto = diaSemanaString + " - " + dias + " - " + tiempo;

    document.getElementById("fecha").innerHTML = tiempoCompleto;
    document.getElementById("fecha2").innerHTML = tiempoCompleto;
    

}

function TiempoMain() {


    let tiempo = document.getElementById("tiempo");
    let icono = document.getElementById("iconoTiempo");

    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener('readystatechange', function () {
        if (this.readyState === this.DONE) {

            let respuesta = JSON.parse(this.responseText);

            tiempo.innerHTML = `${respuesta.data.current_condition[0].weatherDesc[0].value} / ${respuesta.data.current_condition[0].temp_C}ºC`
            icono.setAttribute("src", `${respuesta.data.current_condition[0].weatherIconUrl[0].value}`)
        }
    });

    xhr.open('GET', 'https://world-weather-online-api1.p.rapidapi.com/weather.ashx?q=40.73%2C-3.68&num_of_days=3&lang=en&aqi=yes&alerts=no&format=json');
    xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
    xhr.setRequestHeader('X-RapidAPI-Host', 'world-weather-online-api1.p.rapidapi.com');

    xhr.send();
}


function videos() {

    let video_count = 2;
    let textoVideo = document.getElementById("textoVideoPrincipal");
    let videoPlayer = document.getElementById("mainVideoPlayer");

    let mensajes = ["IMPULSANDO TU ENERGÍA", "DE FORMA EFICIENTE", "CON RESPONSABILIDAD", "Y RIGOR"];
    let indexTexto = 0;


    videoPlayer.addEventListener("ended", () => {

        if (video_count == 5) {
            video_count = 1;
        }

        let nextVideo = "videos/main_intro_video" + video_count + ".mp4";

        videoPlayer.src = nextVideo;
        videoPlayer.play();

        video_count++;
    })


    videoPlayer.addEventListener("ended", () => {
        indexTexto = (indexTexto + 1) % mensajes.length; // Incremento el indice del array de mensajes
        textoVideo.innerHTML = mensajes[indexTexto]; // Establezco el nuevo texto en la etiqueta HTML
    });

}

function mostrarHora() {

    window.addEventListener("scroll", () => {

        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
            document.getElementsByTagName("p")[0].id = "fecha";
            document.getElementsByTagName("p")[1].removeAttribute("id");
        } else {
            document.getElementsByTagName("p")[0].removeAttribute("id");
            document.getElementsByTagName("p")[1].id = "fecha";
        }
    })

    document.getElementsByTagName("p")[0].removeAttribute("id");

}

function cambiarMenu() {


    window.addEventListener("scroll", () => {

        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
            let menuScroll = document.getElementById("menuScroll");
            menuScroll.classList.remove("invisible");
            menuScroll.style.opacity = "1";

        } else {
            let menuScroll = document.getElementById("menuScroll");
            menuScroll.style.opacity = "0";
            menuScroll.classList.add("invisible");
        }
    })

}

function hamburgerMenu() {

    let menuScroll = document.getElementById("menuScroll");
    let menuHamburger = document.getElementById("hamenu");
    let verificadorAnchura = false;
    let verificadorScroll = false;

    window.addEventListener("resize", () => {

        menuScroll.classList.add("invisible");

        if (window.innerWidth < 1490) {

            menuScroll.style.display = "none";
            menuHamburger.classList.remove("invisible");
            verificadorAnchura = true;

        } else {
            menuHamburger.classList.add("invisible");
            menuScroll.style.removeProperty("display");
            menuScroll.classList.remove("invisible");
            verificadorAnchura = false;
        }

        menuHamburger.setAttribute("src","iconos_svg/open-menu.svg");
    })

    window.addEventListener("scroll", () => {

        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400 && window.innerWidth < 1490) {
            menuHamburger.classList.remove("invisible");
            menuHamburger.style.opacity = "1";
        } else {
            menuHamburger.style.opacity = "0";
            //menuHamburger.classList.add("invisible");
        }

        if (verificadorAnchura) {
            if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
                menuHamburger.classList.remove("invisible");
                menuHamburger.style.opacity = "1";
            } else {
                menuHamburger.style.opacity = "0";
                menuHamburger.classList.add("invisible");
            }
        }
    })

    menuHamburger.addEventListener("click", () => {

        if (menuScroll.style.display == "none") {
            menuScroll.style.removeProperty("display");
            menuHamburger.setAttribute("src","iconos_svg/close-menu.svg");
        } else {
            menuScroll.style.display = "none"
            menuHamburger.setAttribute("src","iconos_svg/open-menu.svg");
        }
    })
}

function mostrarTexto(){

    let cuadro1 = document.getElementsByClassName("intro1")[0];
    let cuadro2 = document.getElementsByClassName("intro2")[0];
    let cuadro3 = document.getElementsByClassName("intro3")[0];

    window.addEventListener("scroll",()=>{

        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
            cuadro1.style.opacity = "1";
        }else{
            cuadro1.style.opacity = "0";
        }

        if (document.body.scrollTop > 700 || document.documentElement.scrollTop > 700) {
            cuadro2.style.opacity = "1";
        }else{
            cuadro2.style.opacity = "0";
        }

        if (document.body.scrollTop > 1200 || document.documentElement.scrollTop > 1200) {
            cuadro3.style.opacity = "1";
        }else{
            cuadro3.style.opacity = "0";
        }
    })
}



function MenuDesplegableScroll(){

    let submenuhome = document.getElementById("submenuHome");
    let submenuscroll = document.getElementById("submenuscroll");
    let link1 = document.getElementsByClassName("linkA")[0];
    let link2 = document.getElementsByClassName("linkB")[0];
    let link3 = document.getElementsByClassName("linkC")[0];
    let link4 = document.getElementsByClassName("linkD")[0];
    
    submenuhome.addEventListener("mouseover", () =>{
        submenuscroll.style.opacity = "1";
        submenuscroll.style.display = "";
        link1.classList.add("animationLinkA");
        link2.classList.add("animationLinkB");
        link3.classList.add("animationLinkC");
        link4.classList.add("animationLinkD");
        
        link1.classList.remove("animationLinkALeave");
        link2.classList.remove("animationLinkBLeave");
        link3.classList.remove("animationLinkCLeave");
        link4.classList.remove("animationLinkDLeave");

    });

    submenuscroll.addEventListener("mouseover", () =>{
        submenuscroll.style.opacity = "1";
        submenuscroll.style.display = "";
    });

    submenuhome.addEventListener("mouseleave", () =>{
        submenuscroll.style.opacity = "0";

        link1.classList.remove("animationLinkA");
        link2.classList.remove("animationLinkB");
        link3.classList.remove("animationLinkC");
        link4.classList.remove("animationLinkD");

        link1.classList.add("animationLinkALeave");
        link2.classList.add("animationLinkBLeave");
        link3.classList.add("animationLinkCLeave");
        link4.classList.add("animationLinkDLeave");

    });

    submenuscroll.addEventListener("mouseleave", () =>{
        submenuscroll.style.opacity = "0";

        link1.classList.remove("animationLinkA");
        link2.classList.remove("animationLinkB");
        link3.classList.remove("animationLinkC");
        link4.classList.remove("animationLinkD");

        link1.classList.add("animationLinkALeave");
        link2.classList.add("animationLinkBLeave");
        link3.classList.add("animationLinkCLeave");
        link4.classList.add("animationLinkDLeave");

        setTimeout(() =>{
            submenuscroll.style.display = "none";
        },200)
    });

}


function CerrarSesion(){

    var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			
			let respuesta = this.responseText;
            if(respuesta){
                location.reload();
            }
		}
	};

	xmlhttp.open("GET", "./ajaxFiles/cerrar_sesion.php?cls=true");
	xmlhttp.send();

}














