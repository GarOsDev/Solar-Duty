
let myChart = {};

document.addEventListener("DOMContentLoaded", () => {

    PosicionGeografica();
    AnimarSol();
    setInterval(HoraActual, 1000);

    let body = document.getElementsByTagName("body")[0];
    body.addEventListener("onload", ChartJS());

});

function PosicionGeografica() {

    let municipio = document.getElementById("loc").innerHTML.toLowerCase();
    let latitud = document.getElementById("lat");
    let longitud = document.getElementById("lon");

    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener('readystatechange', function () {
        if (this.readyState === this.DONE) {
            let respuesta = JSON.parse(this.responseText);

            latitud.innerHTML = respuesta.search_api.result[0].latitude;
            longitud.innerHTML = respuesta.search_api.result[0].longitude;

            DatosCielo();
            RegistrarPosicion();
        }
    });

    xhr.open('GET', `https://world-weather-online-api1.p.rapidapi.com/search.ashx?q=${municipio}&format=json`);
    xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
    xhr.setRequestHeader('X-RapidAPI-Host', 'world-weather-online-api1.p.rapidapi.com');

    xhr.send();
}

function DatosCielo() {

    let latitud = document.getElementById("lat").innerHTML;
    let longitud = document.getElementById("lon").innerHTML;

    let imagen_tiempo = document.getElementById("img");
    let temperaturaActual = document.getElementById("temAct");
    let nubosidad = document.getElementById("nub");
    let amanecer = document.getElementById("ama");
    let atardecer = document.getElementById("atar");

    let radiacion = document.getElementById("uvindex");
    let radiacionM = document.getElementById("uvindexM");
    let radiacionPM = document.getElementById("uvindexPM");
    let horasSol = document.getElementById("hsol");

    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener('readystatechange', function () {
        if (this.readyState === this.DONE) {
            let resp = JSON.parse(this.responseText);

            imagen_tiempo.setAttribute("src", resp.data.current_condition[0].weatherIconUrl[0].value)
            temperaturaActual.innerHTML = resp.data.current_condition[0].temp_C;
            nubosidad.innerHTML = resp.data.current_condition[0].cloudcover;
            amanecer.innerHTML = resp.data.weather[0].astronomy[0].sunrise;
            atardecer.innerHTML = resp.data.weather[0].astronomy[0].sunset;

            radiacion.innerHTML = resp.data.current_condition[0].uvIndex;
            radiacionM.innerHTML = resp.data.weather[1].uvIndex;
            radiacionPM.innerHTML = resp.data.weather[2].uvIndex;
            horasSol.innerHTML = resp.data.weather[0].sunHour;
        }
    });

    xhr.open('GET', `https://world-weather-online-api1.p.rapidapi.com/weather.ashx?q=${latitud}%2C${longitud}&num_of_days=3&lang=en&aqi=yes&alerts=no&format=json`);
    xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
    xhr.setRequestHeader('X-RapidAPI-Host', 'world-weather-online-api1.p.rapidapi.com');

    xhr.send();
}

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

function PosicionSol() {

    let sun = document.querySelector('.sun');

    let fechaActual = new Date();

    fechaActual.setHours(fechaActual.getHours() - 2);
    fechaActual.setMinutes(fechaActual.getMinutes() - 12);

    let hour = fechaActual.getHours();
    let minutes = fechaActual.getMinutes();

    let totalMinutes = hour * 60 + minutes;
    let timelineWidth = document.querySelector('.timeline').clientWidth;
    let newPosition = (totalMinutes / (24 * 60)) * timelineWidth;

    sun.style.left = `${newPosition}px`;
    PosicionHora(newPosition);

    if (hour >= 0 && hour < 6) {
        // Noche
        sun.style.backgroundColor = '#F7F6BB';
    } else if (hour >= 6 && hour < 12) {
        // Mañana
        sun.style.backgroundColor = '#ffd700';
    } else if (hour >= 12 && hour < 18) {
        // Tarde
        sun.style.backgroundColor = '#ff5733';
    } else {
        // Noche
        sun.style.backgroundColor = '#FDA403';
    }
}

function AnimarSol() {

    PosicionSol();
    requestAnimationFrame(AnimarSol);
}


function HoraActual() {

    let hora = document.querySelector(".tiempo");

    let fecha = new Date();

    fecha.setHours(fecha.getHours() - 2);
    fecha.setMinutes(fecha.getMinutes() - 12);

    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();
    let segundos = fecha.getSeconds();

    horas < 10 ? horas = `0${horas}` : horas;
    minutos < 10 ? minutos = `0${minutos}` : minutos;
    segundos < 10 ? segundos = `0${segundos}` : segundos;


    let tiempoActual = `${horas}:${minutos}:${segundos}`;
    hora.innerHTML = tiempoActual;
}

function PosicionHora(espacio) {

    let hora = document.querySelector(".tiempo");
    hora.style.left = `${espacio}px`;
}

function RegistrarPosicion() {

    let latitud = document.getElementById("lat").innerHTML;
    let longitud = document.getElementById("lon").innerHTML;

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
        if (this.readyState == 4 && this.status == 200) {

            let respuesta = this.responseText;
        }
    }


    var datos = "";
    datos += "lat=" + latitud;
    datos += "&";
    datos += "lon=" + longitud;


    xmlhttp.open("POST", "./ajaxFiles/registroPosicion.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(datos);

}

function DiferenciaTiempoRegistro(model, radiationType, description, periodo1, periodo2,verfif = false) {

    let tiempoActualMilisegundos = new Date().getTime();
    let tiempoActualSegundos = Math.floor(tiempoActualMilisegundos / 1000);

    let segundosDía = 24 * 60 * 60;
    

    /* ************************** PETICION AJAX TIME STAMP PARAMETRO */

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let timeStampSegudnos = this.responseText;
            let diferenciaTiempo = 0;

            diferenciaTiempo = tiempoActualSegundos - timeStampSegudnos;

            if (diferenciaTiempo < segundosDía) {
                SolarChart(model, radiationType, description, periodo1, periodo2, verfif);
            } else {
                SolarChart(model, radiationType, description, periodo1, periodo2, verfif=true);
            }

        }
    };

    xmlhttp.open("GET", "./ajaxFiles/registroParametros.php?getTime=true");
    xmlhttp.send();

}


window.ChartJS = function (model = "line", radiationType = "dni", description = "dni values (W/m2)", periodo1 = 0, periodo2 = 0,verfif) {


    if (Object.keys(myChart).length != 0) {
        myChart.destroy();
    }

    DiferenciaTiempoRegistro(model, radiationType, description, periodo1, periodo2,verfif = false);

};

function SolarChart(model, radiationType, description, periodo1, periodo2,verfif) {

    let periodoFinal = periodo1 + 48;
    let periodo2Final = periodo2 + 48;

    let latitud = document.getElementById("lat").innerHTML;
    let longitud = document.getElementById("lon").innerHTML;
    let fechaDato = document.getElementById("fechaDato");


    if (verfif) {

        // ****************************************** PETICION AJAX API PARAMETROS SOLARES ******************************************

        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {

                let res = this.responseText; // RESPUESTA API


                dibujarGrafico(model, radiationType, description, periodo1, periodo2, periodoFinal, periodo2Final, res);

                // ****************************************** PETICION AJAX REGISTRAR PARAMETROS ******************************************

                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
                    if (this.readyState == 4 && this.status == 200) {

                        let respuesta = this.responseText; // RESPUESTA PHP
                    }
                }


                var datos = "";
                datos += "parametroSolares=" + res;

                xmlhttp.open("POST", "./ajaxFiles/registroParametros.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(datos);

            }
        });

        xhr.open('GET', `https://solcast.p.rapidapi.com/radiation/forecasts?api_key=BVmB-tcESGysIBkXlXKRzH1JNGIVOajb&latitude=${latitud}&longitude=${longitud}&format=json`);
        xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
        xhr.setRequestHeader('X-RapidAPI-Host', 'solcast.p.rapidapi.com');

        xhr.send();

    } else {

        // ****************************************** PETICION AJAX PHP PARAMETROS SOLARES ******************************************


        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
            if (this.readyState == 4 && this.status == 200) {

                let respuesta = this.responseText; // RESPUESTA PHP (string)
                

                dibujarGrafico(model, radiationType, description, periodo1, periodo2, periodoFinal, periodo2Final, respuesta);
                FechasRegistros(respuesta)

            }
        }

        xmlhttp.open("GET", "./ajaxFiles/registroParametros.php?params=true");
        xmlhttp.send();

    }

};

// ***************************** CHART JS *****************************

function dibujarGrafico(model, radiationType, description, periodo1, periodo2, periodoFinal, periodo2Final, res) {

    const ctx = document.getElementById('myChart');
    let resObj = JSON.parse(res); // se pasa string json string a objeto

    myChart = new Chart(ctx, {
        type: model,
        data: {
            labels: resObj.forecasts.slice(periodo1, periodoFinal + 1).map(row => {

                if (periodo1 < periodoFinal) {
                    return row.period_end.substring(11, 19);
                }

                periodo1++;
            }),
            datasets: [{
                label: description,
                data: resObj.forecasts.slice(periodo2, periodo2Final + 1).map(column => {

                    if (periodo2 < periodo2Final) {
                        return column[radiationType];
                    }

                    periodo2++;
                }),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1,

            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    return myChart;
}


window.BotonesDNI = function () {

    let dni = document.getElementById("dni");
    let ghi = document.getElementById("ghi");
    let air = document.getElementById("air_temp");
    let cloud = document.getElementById("cloud_opacity");

    dni.style.display = "";

    if (ghi.style.display != "none") {
        ghi.style.display = "none";
    }
    if (air.style.display != "none") {
        air.style.display = "none";
    }
    if (cloud.style.display != "none") {
        cloud.style.display = "none";
    }
}

window.BotonesGHI = function () {

    let dni = document.getElementById("dni");
    let ghi = document.getElementById("ghi");
    let air = document.getElementById("air_temp");
    let cloud = document.getElementById("cloud_opacity");

    ghi.style.display = "";

    if (dni.style.display != "none") {
        dni.style.display = "none";
    }
    if (air.style.display != "none") {
        air.style.display = "none";
    }
    if (cloud.style.display != "none") {
        cloud.style.display = "none";
    }
}

window.BotonesAIR = function () {

    let dni = document.getElementById("dni");
    let ghi = document.getElementById("ghi");
    let air = document.getElementById("air_temp");
    let cloud = document.getElementById("cloud_opacity");

    air.style.display = "";

    if (ghi.style.display != "none") {
        ghi.style.display = "none";
    }
    if (dni.style.display != "none") {
        dni.style.display = "none";
    }
    if (cloud.style.display != "none") {
        cloud.style.display = "none";
    }
}

window.BotonesCLOUD = function () {

    let dni = document.getElementById("dni");
    let ghi = document.getElementById("ghi");
    let air = document.getElementById("air_temp");
    let cloud = document.getElementById("cloud_opacity");

    cloud.style.display = "";

    if (ghi.style.display != "none") {
        ghi.style.display = "none";
    }
    if (air.style.display != "none") {
        air.style.display = "none";
    }
    if (dni.style.display != "none") {
        dni.style.display = "none";
    }
}


function FechasRegistros(respuesta) {


    let fechaAAAAMMDD_hoy = (JSON.parse(respuesta).forecasts[0].period_end.substring(0, 10));
    let dia = fechaAAAAMMDD_hoy.substring(8, 10);
    let mes = fechaAAAAMMDD_hoy.substring(5, 7);
    let anio = fechaAAAAMMDD_hoy.substring(0, 4);

    let fechaDDMMAAAA_hoy = `${dia}/${mes}/${anio}`;

    document.getElementById("fechaDato").innerHTML = fechaDDMMAAAA_hoy;


    let fechaAAAAMMDD_manana = (JSON.parse(respuesta).forecasts[48].period_end.substring(0, 10));
    let dia_man = fechaAAAAMMDD_manana.substring(8, 10);
    let mes_man = fechaAAAAMMDD_manana.substring(5, 7);
    let anio_man = fechaAAAAMMDD_manana.substring(0, 4);

    let fechaDDMMAAAA_man = `${dia_man}/${mes_man}/${anio_man}`;

    document.getElementById("fechaDato2").innerHTML = fechaDDMMAAAA_man;


    let fechaAAAAMMDD_pas = (JSON.parse(respuesta).forecasts[97].period_end.substring(0, 10));
    let dia_pas = fechaAAAAMMDD_pas.substring(8, 10);
    let mes_pas = fechaAAAAMMDD_pas.substring(5, 7);
    let anio_pas = fechaAAAAMMDD_pas.substring(0, 4);

    let fechaDDMMAAAA_pas = `${dia_pas}/${mes_pas}/${anio_pas}`;
    document.getElementById("fechaDato3").innerHTML = fechaDDMMAAAA_pas;

}

window.Titulo = function (titulo) {

    let tit = document.getElementById("titulo");

    tit.innerHTML = titulo;

}

window.Hoy = function () {

    let origen = document.getElementById("fechaDato").innerHTML;
    let destino = document.getElementById("fechas");

    destino.innerHTML = origen;
}

window.Man = function () {

    let origen = document.getElementById("fechaDato2").innerHTML;
    let destino = document.getElementById("fechas");

    destino.innerHTML = origen;

}

window.Pas = function () {

    let origen = document.getElementById("fechaDato3").innerHTML;
    let destino = document.getElementById("fechas");

    destino.innerHTML = origen;

}














