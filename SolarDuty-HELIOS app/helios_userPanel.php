<?php
session_start();

if ($_SESSION['usuario'] == "") {
    header('Location: helios_index.php');
}

require_once("db.php");
$db = new HeliosDB();
$res = $db->consultarMunicipio($_SESSION['usuario']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/helios_userPanel.css">
    <script type="module" src="./js/helios_userPanel.js"></script>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Panel de <?= $_SESSION['usuario'] ?></title>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_accountHeader.php' ?>

        <section>

            <div class="row dataInfo">
                <div class="col align-self-center text-center m-5 text-light rounded info_localizacion ">
                    <h5 class="p-2 text-light">Datos Geográficos</h5><br>
                    <div id="lugar" class="loc">Tu instalación se encuentra en: <span id="loc"><?= $res[0]['municipio'] ?></span></div>
                    <div id="latitud" class="alt">Latitud: <span id="lat"></span></div>
                    <div id="longitud" class="long">Longitud: <span id="lon"></span></div>
                </div>


                <div class="col text-center text-light rounded m-5 info_meteo">
                    <h5 class="p-2 text-light">Datos Meteorológicos</h5><br>
                    <div class="imagenTiempo"><img class="imgT" id="img" alt="imagen tiempo" /></div><br>
                    <div id="temperaturaActual" class="temperaturaActual">Temperatura actual: <span id="temAct"></span>ºC</div>
                    <div id="nubosidad" class="nubosidad">Nubosidad: <span id="nub"></span>%</div>
                    <div id="amanecer" class="amanecer">Amanecer: <span id="ama"></span></div>
                    <div id="atardecer" class="atardecer">Atardecer: <span id="atar"></span></div>
                </div>

                <div class="col text-center align-self-center text-light rounded m-5 info_solar">
                    <h5 class="p-2 text-light">Datos Solares</h5><br>
                    <div class="UV">Índice de radiación UV actual: <span id="uvindex"></span></div>
                    <div class="UVm">Índice UV prevista en 1 dia: <span id="uvindexM"></span></div>
                    <div class="UVpm">Índice UV prevista en 2 dias: <span id="uvindexPM"></span></div>
                    <div class="horasSol">Horas de luz/dia: <span id="hsol"></span>h</div>
                    <div class="azimut"><span id="azim"></span></div>
                    <div class="elevacion"><span id="elev"></span></div>
                </div>
            </div>

            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center p-3 text-light rounded horaActual">Hora Solar</div>
            </div>

            <div class="row justify-align-content-center m-3 mb-5">
                <div class="col-12 rounded border border-dark border-3 p-3 simulation">
                    <div class="text-light border border-light border-3 rounded p-2 mensaje">Situación del Sol respecto a la duración del día</div>
                    <div class="sun"></div>
                    <div class="timeline"></div>
                    <span class="tiempo"></span>
                </div>
            </div>


        </section>

        <section>

            <div class="row justify-content-center mb-5">
                <div class="col-5 text-center p-3 text-light rounded horaActual">Evaluación Fotovoltaica</div>
            </div>

            <div class="row mt-2 mb-5 justify-content-evenly">
                <button id="btn1" type="button" class="col-lg-3 col-sm-3 btn btn-outline-dark" onclick="ChartJS('line', 'dni', 'dni value (W/m2)',0,0); BotonesDNI(); Titulo('Radiación Normal Directa'); Hoy()">Radiación Normal Directa (dni)</button>
                <button id="btn1" type="button" class=" col-lg-3 col-sm-3 btn btn-outline-danger" onclick="ChartJS('line','ghi', 'ghi value (W/m2)',0,0); BotonesGHI(); Titulo('Radiación Global Horizontal'); Hoy()">Radiación Global Horizontal (ghi)</button>
                <button id="btn1" type="button" class=" col-lg-2 col-sm-3 btn btn-outline-success" onclick="ChartJS('line','air_temp', 'air temps value (ºC)',0,0); BotonesAIR(); Titulo('Temperatura Aire'); Hoy()">Temperatura aire</button>
                <button id="btn1" type="button" class=" col-lg-2 col-sm-3 btn btn-outline-secondary" onclick="ChartJS('line','cloud_opacity', 'cloud opacities value (%)',0,0); BotonesCLOUD(); Titulo('Opacidad'); Hoy()">Opacidad</button>
            </div>

            <div id="dni" class="row mt-2 mb-2 justify-content-evenly" style="display:none">
                <button id="btn2" type="button" class="col-3 btn btn-info" onclick="ChartJS('doughnut', 'dni', 'dni value (W/m2)',49,96); Titulo('Radiación Normal Directa - Mañana'); Man()">Mañana</button>
                <button id="btn3" type="button" class=" col-3 btn btn-info" onclick="ChartJS('polarArea', 'dni', 'dni value (W/m2)',97,145); Titulo('Radiación Normal Directa - En 2 Días'); Pas()">2 días</button>
            </div>
            <div id="ghi" class="row mt-2 mb-2 justify-content-evenly" style="display:none">
                <button id="btn2" type="button" class="col-3 btn btn-danger" onclick="ChartJS('doughnut', 'ghi', 'ghi value (W/m2)',49,96); Titulo('Radiación Global Horizontal - Mañana'); Man()">Mañana</button>
                <button id="btn3" type="button" class=" col-3 btn btn-danger" onclick="ChartJS('polarArea', 'ghi', 'ghi value (W/m2)',97,145); Titulo('Radiación Global Horizontal - En 2 Días'); Pas()">2 días</button>
            </div>
            <div id="air_temp" class="row mt-2 mb-2 justify-content-evenly" style="display:none">
                <button id="btn2" type="button" class="col-3 btn btn-success" onclick="ChartJS('doughnut', 'air_temp', 'air temps value (ºC)',49,96); Titulo('Temperatura Aire - Mañana'); Man()">Mañana</button>
                <button id="btn3" type="button" class=" col-3 btn btn-success" onclick="ChartJS('polarArea', 'air_temp', 'air temps value (ºC)',97,145); Titulo('Temperatura Aire - En 2 Días'); Pas()">2 días</button>
            </div>
            <div id="cloud_opacity" class="row mt-2 mb-2 justify-content-evenly" style="display:none">
                <button id="btn2" type="button" class="col-3 btn btn-warning" onclick="ChartJS('doughnut', 'cloud_opacity', 'cloud opacities value (%)',49,96); Titulo('Opacidad - Mañana'); Man()">Mañana</button>
                <button id="btn3" type="button" class=" col-3 btn btn-warning" onclick="ChartJS('polarArea', 'cloud_opacity', 'cloud opacities value (%)',97,145); Titulo('Opacidad - En 2 Días'); Pas()">2 días</button>
            </div>
        </section>

        <div class="row mt-5">
            <div class="col-5 mx-auto text-center fs-4 fw-light border-bottom border-danger" id="titulo"></div>
        </div>

        <div class="row mt-2">
            <div class="col-5 mx-auto text-center fs-4 fw-light" id="fechas"></div>
        </div>

        <div style="display: none;">
            <div id="fechaDato"></div>
            <div id="fechaDato2"></div>
            <div id="fechaDato3"></div>
        </div>


        <canvas id="myChart" class="chart"></canvas>



    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>


</body>

</html>