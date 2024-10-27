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
    <link rel="stylesheet" href="./css/helios_procedures.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">
    <script src="./js/helios_procedures.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>

        <section class="proceso">

            <div class="contAA">
                <div id="img1" class="img">
                    <img class="concept" src="iconos_png/notebook.png" alt="notebook icon"/>
                </div>
                <div id="icon1" class="icon">
                    <img id="flecha1" class="arrow" src="iconos_svg/arrow.svg" alt="arrow"/>
                </div>
                <div id="txt1" class="txt1">
                    <h3>Fase 1: Estudio</h3>
                    <p>El proyecto comienza a ejecutarse en una primera fase de estudio y baremación. Todos los aspectos son determinados y creados por el cliente para que los dispositivos instalados funcionen en las mejores condiciones posibles. Se establecen las primeras magnitudes como la potencia generada, corriente almacenda, consumo estimado o rendimiento previsto según las horas de sol.</p>
                </div>
            </div>

            <div class="contB">
                <div id="img2" class="img">
                    <img class="concept2" src="iconos_png/tool.png" alt="tool icon"/>
                </div>
                <div id="icon2" class="icon2">
                    <img id="flecha2" class="arrow" src="iconos_svg/arrow2.svg" alt="arrow"/>
                </div>
                <div id="txt2" class="txt2">
                    <h3>Fase 2: Instalación</h3>
                    <p>La proyección de la estructura se lleva a cabo implementando todos los componentes para el funcionamiento general del sistema. Se procede a instalar el numero de placas solares acordados con el cliente para posteriormente conectarlos al resto de componentes.<br><br>El regulador recibe la corriente generada por las mismas y éste es el encargado de llevar la corriente a la instalacion particular o a la red electrica. <br><br>Tras su instalación, el controlador e inversor son instalados en los lugares apropiados para la maxima utilidad en terminos de accesibilidad y utilidad para con el uso diario que hará de ellos el cliente.</p>
                </div>
            </div>

            <div class="contA">
                <div id="img3" class="img">
                    <img class="concept3" src="iconos_svg/optimization.svg" alt="optimization icon"/>
                </div>
                <div id="icon3" class="icon2">
                    <img id="flecha3" class="arrow" src="iconos_svg/arrow3.svg" alt="arrow"/>
                </div>
                <div id="txt3" class="txt3">
                    <h3>Fase 3: Puesta a punto</h3>
                    <p>Una vez la instalación completada, los dispositivos son configurados y adaptados a los requerimientos dinámicos previstos en la fase de estudio. <br>Junto con el usuario, se acuerdan cada uno de los modos de funcionamiento que tendrá la instalación solar en funcion de la luz incidente así como el conjunto de parametros IoT que permitan una continua supervisión y comprobación del funcionamiento por parte del sistema.<br><br> Esta es sin duda una fase muy importante ya que determinará el comportamiento y funcionamiento general del sistema durante todos los años de vida útil de la misma.</p>
                </div>
            </div>

            <div class="contAB">
                <div id="img4" class="img">
                    <img class="concept4" src="iconos_png/calculator.png" alt="calculator icon"/>
                </div>
                <div id="icon4" class="icon2">
                    <img id="flecha4" class="arrow" src="iconos_svg/arrow4.svg" alt="arrow"/>
                </div>
                <div id="txt4" class="txt4">
                    <h3>Fase 4: Optimización</h3>
                    <p>Si llegara el caso, se podría llevar a cabo una etapa anexa de optimización. En esta fase se establecen posibles ajustes que necesiten una mayor precisión en el funcionamiento o parametros de conexión que necesiten ser configurados, tanto a solicitud del cliente como del escenario de funcionamiento previsto. <br><br>Todo ello para que una vez establecidos, el rendimiento de la instalación este lo mas cercano posible al 100%. <br><br>En esta parte del proyecto tambien se determinan aspectos relacionados con la transmisión de los datos de modo que el cliente sea capaz de recibirlos en la forma y medida que haya determinado.</p>
                </div>
            </div>


        </section>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>