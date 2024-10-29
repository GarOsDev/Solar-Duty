<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HELIOS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/helios_performance.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">
    <script type="module" src="./js/helios_performance.js"></script>



    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>

        <div id="filaContador" class="row justify-content-center mx-auto" style="width: 90%;">

            <div class="row justify-content-center ">
                <div class="col-lg-2 col-md-12 my-auto text-center ">
                    <div id="counter" class="display-3">0</div>
                </div>
                <div id="unidades" class="col-lg-2 col-md-12 display-3 text-center oculto">GW</div>
            </div>

            <div id="informacionCabecera" class="col-12 text-center display-5 oculto">Energía solar producida en España en 2023</div>
        </div>

        <!-- CONTENIDO -->

        <div id="infoGral" class="row mb-5 mx-auto">

            <div class="row justify-content-center mx-auto common">

                <div class="col-10 card my-auto no-border tarjetaQueryA" style="height: 400px;">
                    <div class="card-inner">
                        <div class="card-front1">
                            <img class="iconosFrontCard" src="./iconos_svg/renewable-energy.svg" alt="icono frontal"/>
                        </div>
                        <div class="card-back1">

                            <div class="row">
                                <div class="col-12">
                                    <img class="iconobackCard1" src="./gifts/sol.gif" alt="gift posterior"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 texto1">
                                    La energía solar fotovoltaica ha revolucionado el sistema eléctrico nacional como ninguna otra tecnología lo había hecho hasta ahora. En solo cinco años, la FV ha sido capaz de sumar en territorio nacional más de 27.000 megavatios (MW). Ni la eólica, que era hasta ahora la tecnología con más megas instalados (30.989, según Red Eléctrica), ni los ciclos combinados (centrales térmicas que queman gas natural para generar electricidad) crecieron tanto en tan poco tiempo.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 fuente">
                                    <i>Fuente:energias-renovables.com</i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row mx-auto fondo1 common">
                <div class="col-12 columnafondo1 text-center my-auto">
                    <p class="text-light border p-2 fst-italic w-50 mx-auto fs-4">¿Sabías que?: El sol proporciona más energía a la Tierra en una hora de la que toda la humanidad consume en un año</p>
                </div>
            </div>

            <div class="row mt-4 mb-4 justify-content-center mx-auto common">

                <div class="col-10 card my-auto no-border" style="height: 500px;">
                    <div class="card-inner">
                        <div class="card-front2">
                            <img class="iconosFrontCard" src="./iconos_svg/power-button.svg" alt="icono frontal"/>
                        </div>
                        <div class="card-back2">

                            <div class="row">
                                <div class="col-12">
                                    <img class="iconobackCard2" src="./gifts/battery-sides-vertical.gif" alt="gift posterior"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="texto2">
                                    Las grandes compañías energéticas pusieron en marcha entre 2003 y 2007 <b>18.000 MW</b> de potencia CC (centrales de ciclo combinado), pero es que ellas y otros actores (nuevos agentes de mercado y las empresas instaladoras especializadas en el autoconsumo) han puesto en marcha, entre 2019 y el pasado mes de abril hasta 27.000 MW fotovoltaicos.
                                    <br><br>Entre los primeros efectos del crecimiento brutal del parque FV está lógicamente el incremento de la producción (más electricidad generada). En Abril el Sol ha generado en este país <b>más electricidad</b> que el carbón, el gas, la nuclear y la hidráulica <b>juntos</b>, y casi tanta como la eólica.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 fuente">
                                    <div class="fuente fuente2"><i>Fuente:energias-renovables.com</i></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="row mx-auto fondo2 common">
            <div class="col-12 columnafondo2 text-center my-auto">
                    <p class="text-light border p-2 fst-italic w-50 mx-auto fs-4">¿Sabías que?: La agrofotovoltaica es una técnica que combina la agricultura con la energía solar. Los paneles solares se instalan sobre cultivos, proporcionando sombra parcial y reduciendo la evaporación, mientras generan electricidad.</p>
                </div>
            </div>

            <div class="row justify-content-center mx-auto common2">

                <div class="col-10 card my-auto no-border" style="height: 850px;">
                    <div class="card-inner">
                        <div class="card-front3">
                            <img class="iconosFrontCard" src="./iconos_svg/electric-tower-tower.svg" alt="icono frontal"/>
                        </div>
                        <div class="card-back3">

                            <div class="row">
                                <div class="col-12">
                                    <img class="iconobackCard3" src="./gifts/wired-lineal-860-electric-car.gif" alt="gift posterior"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="texto3">
                                    En el cómputo total de la potencia instalada, España acabó 2023 con más de 125,6 GW, de los que el <b>61,3%</b> son renovables. Así, durante este 2023 el parque de generación renovable creció 8,8% gracias, además de los nuevos MW fotovoltaicos mencionados, a la suma de 661 MW eólicos y 4 MW del contingente de otras renovables. En el ranking nacional, la eólica se mantiene como la tecnología con mayor presencia, con el 24,5%, seguida por el ciclo combinado (20,9%), la fotovoltaica (20,3%) y la hidráulica (13,6%).
                                    <b>2023, el año en que se batieron todas las marcas</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 fuente">
                                    <img class="grafico img-fluid rounded" src="./imagenes/diezaniosdeautoconsumo.jpg" alt="grafico producciones">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 fuente">
                                    <div class="fuente"><i>Fuente:Red Eléctrica</i></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>


</body>

</html>