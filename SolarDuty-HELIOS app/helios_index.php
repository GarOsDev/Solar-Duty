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
    <link rel="stylesheet" href="./css/helios_index.css">
    <script src="./js/helios.js"></script>
    <script src="./js/api_index.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>


    <img class="invisible hamIcon" id="hamenu" src="iconos_svg/open-menu.svg" alt="icono hamburguer" />

    <div class="invisible" id="menuScroll">

        <div class="scrollLogo">
            <a class="enlaceMainScroll" href="helios_index.php"><img src="iconos_svg/helios-high-resolution-logo.svg" alt="Paris" id="logo2"></a>
        </div>

        <div class="fechaClase2">
            <p class="fecha" id="fecha2"></p>
        </div>

        <nav class="menu2">

            <li><a href="helios_performance.php">Situación</a></li>
            <li><a href="helios_project.php">Sistema</a></li>
            <li><a href="helios_procedures.php">Desarrollo</a></li>

            <?php
            if (!isset($_SESSION["usuario"])) {
                echo "<li><a href='helios_login.php'>Login</a></li>";
            } else {
                echo "<li id='submenuHome'><a href='helios_userPanel.php'><img class='imgHome' src='./iconos_svg/home.svg' alt='home icon'></a></li>";
            }
            ?>
        </nav>


        <ul id="submenuscroll" class='submenuScroll'>
            <li class="linkA"><a href='helios_userPanel.php'>Portal Solar</a></li>
            <li class="linkB"><a href='helios_userInstallation.php'>Tu Instalación</a></li>
            <li class="linkC"><a href='helios_cuenta.php'>Cuenta</a></li>
            <li onclick='CerrarSesion()' class="linkD"><a href='#'>Cerrar sesión</a></li>
        </ul>

    </div>

    <div class="container">

        <header>
            <div class="row row1 p-4">

                <div class="col-lg-4 my-auto">
                    <div class="logo">
                        <a href="helios_index.php"><img src="iconos_png/helios-high-resolution-logo-transparent.png" alt="Paris" id="logo"></a>
                    </div>
                </div>

                <div id="menuGral" class="col-lg-8 my-auto">

                    <div class="row justify-content-evenly text-center p-2 rounded-pill border border-warning cuerpo">

                        <li class="col-lg-3 col-md-6 col-sm-12 my-auto efect"><a class="link-light link-underline-opacity-0" href="helios_performance.php">Situación</a></li>
                        <li class="col-lg-3 col-md-6 col-sm-12 my-auto efect"><a class="link-light link-underline-opacity-0" href="helios_project.php">Sistema</a></li>
                        <li class="col-lg-3 col-md-6 col-sm-12 my-auto efect"><a class="link-light link-underline-opacity-0" href="helios_procedures.php">Desarrollo</a></li>

                        <?php
                        if (!isset($_SESSION["usuario"])) {
                            echo "<li class='col-lg-3 col-md-6 col-sm-12 efect'><a class='link-light link-underline-opacity-0' href='helios_login.php'>Login</a></li>";
                        } else {
                            echo "<li class='col-lg-3 col-md-6 col-sm-12'>
                                    <div class='row justify-content-center'>
                                        <div class='dropdown col-sm-12 my-auto text-light'>
                                            <button class='btn btn-warning dropdown-toggle efect' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                Hola $_SESSION[usuario]
                                            </button>
                                            <ul class='dropdown-menu text-center mt-3 bg-warning-subtle'>
                                                <li><a class='dropdown-item p-2' href='helios_userPanel.php'>Portal Solar</a></li>
                                                <li><a class='dropdown-item p-2' href='helios_userInstallation.php'>Tu instalación</a></li>
                                                <li><a class='dropdown-item p-2' class='dropdown-item' href='helios_cuenta.php'>Cuenta</a></li>
                                                <li onclick='CerrarSesion()'><a class='dropdown-item p-2' href='#'>Cerrar Sesión</a></li>
                                            </ul>
                                        </div>
                                        <div class='col-auto my-auto text-light'></div>
                                    </div>
                                </li>";
                        }
                        ?>

                    </div>

                </div>

            </div>

            
            <div class="row fechaClase">
                <div class="col-lg-6 my-auto ">
                    <p id="fecha" class="my-auto"></p>
                </div>
                <div class="col-lg-6 temperatura mt-lg-0 mt-3">
                    <img id="iconoTiempo" />
                    <div id="tiempo"></div>
                </div>
            </div>
        </header>


        <section class="row">
            <div class="col-lg-12 videos">
                <video id="mainVideoPlayer" autoplay muted src="videos/main_intro_video1.mp4"></video>
                <div class="textoVideo text-center text-white position-absolute top-50 start-50 translate-middle">
                    <h2 id="textoVideoPrincipal" class="display-1">IMPULSANDO TU ENERGÍA</h2>
                </div>
            </div>
        </section>

        <section class="contenedor_introduccion">
            <div class="row intro1">
                <p class="col-lg-6 my-auto texto_introduccion">
                    Presentamos HELIOS, una herramienta que permite interactuar y gestionar cómodamente y desde cualquier lugar todos los aspectos relacionados con tu instalacion solar.<br><br> Gracias a la tecnología y avances en el
                    campo del IoT podrás cambiar y comprobar los parámetros que rigen el correcto funcionamiento de tu sistema advirtiendo cualquier comportamiento o funcionamiento anómalo para su inmediata atención.
                    <br><br>
                    Todo ello buscando que en todo momento la instalacion solar de su vivienda o edificio funcione a pleno rendimiento.
                </p>
                <img class="col-lg-6 my-auto imagen_introduccion" src="imagenes/solar1.jpg" alt="paneles solares"/>
            </div>

            <div class="row intro2">
                <img class="col-lg-6 my-auto imagen_introduccion" src="imagenes/solar2.jpg" alt="coche electrico" />
                <p class="col-lg-6 my-auto texto_introduccion">
                    Si desea tener una producción solar totalmente controlada a la vez que ayuda al planeta con el uso de tecnologías y recursos sostenibles, HELIOS pretende convertirse el la herramienta ideal para conseguir tal
                    objetivo. <br><br>Gracias a esta aplicación, podrá vislumbrar en tiempo real los datos de generación, almacenaje y previsión energéticas, consiguiendo así plena adaptación a
                    diferentes escenarios de producción dada la situación actual de sus baterias y corrientes generadas. <br><br>El objetivo es servir una herramienta dinámica que sepa actuar frente a todos los escenarios posibles para que el usuario pueda comprobar como funcionaría su instalación bajo unas caracteristicas de diseño totalmente personalizables.
                </p>
            </div>

            <div class="row intro3">
                <p class="col-lg-6 my-auto texto_introduccion">
                    Una de las caracteristicas principales de HELIOS es que busca ser una herramienta adaptable a cualquier instalación fotovoltáica.<br><br>Cumpliendo unos mínimos requisitos relacionados con las características que han de cumplir toda
                    instalación solar, podrá comenzar a utilizar esta aplicación controlando y manejando múltiples parámetros y variables de control. Todo ello para que su instalación se encuentre siempre bajo sus objetivos o pretensiones de uso.<br><br> El fin último de esta aplicación es dar lugar a un entorno fotovolotáico totalmente gestionable, objetivo y seguro
                    que cumpla cualquier previsión de uso o funcionamiento que se plantee.
                </p>
                <img class="col-lg-6 my-auto imagen_introduccion" src="imagenes/solar3.jpg" alt="instalacion solar"/>
            </div>

        </section>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>