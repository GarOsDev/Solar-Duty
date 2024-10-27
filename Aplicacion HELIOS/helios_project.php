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
    <link rel="stylesheet" href="./css/helios_project.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">
    <script src="./js/helios_project.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>

        <section class="diagrama">

            <div class="proceso">
                <img id="HouseSchema" class="HSchema" src="imagenes/instalacionSolar.jpg" alt="house schema"/>
            </div>

            <img id="warn1" class="warning1" src="iconos_svg/warning.svg" alt="info icon"/>
            <p id="i1" class="info1">La instalación esta permanente conectada a la red electrica, con la posibilidad de vender el excedente de energía a la empresa suministradora</p>

            <img id="warn2" class="warning2" src="iconos_svg/warning.svg" alt="info icon"/>
            <p id="i2" class="info2"><b>Regulador de carga</b>. Será el dispositivo encargado de controlar el flujo de energía que circula entre los paneles y las baterías</p>

            <img id="warn3" class="warning3" src="iconos_svg/warning.svg" alt="info icon"/>
            <p id="i3" class="info3"><b>Controlador</b>: será el cerebro de la instalación, responsable del registro de datos y la transmision de los mismos. Es el principal componente IoT</p>

            <img id="warn4" class="warning4" src="iconos_svg/warning.svg" alt="info icon"/>
            <p id="i4" class="info4"><b>Inversor solar</b>: es el encargado de transformar la corriente alterna procedente de las placas y el regulador a corriente continua para que pueda usarse por los dispositivos conectados</p>


        </section>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>