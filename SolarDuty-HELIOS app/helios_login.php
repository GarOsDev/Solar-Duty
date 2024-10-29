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
    <link rel="stylesheet" href="./css/helios_login.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">
    <script src="./js/helios_login.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>


        <section class="formularioLogIn ">

            <div class="row justify-content-center">
                <img src="./iconos_svg/earth-day.svg" style="width: 225px;" />
            </div>

            <div class="row justify-content-center text-center m-3">
                <h3 class="col-3 p-2 bg-success-subtle border border-success rounded">Iniciar Sesión</h3>
            </div>

            <form class="form" id="loginForm" method="post">

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="text" class="form-control" id="userName" placeholder="Usuario">
                        <label for="floatingInput">Nombre Usuario</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="password" class="form-control" id="pass" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <button id="logueo" type="submit" class="btn btn-success col-lg-2 " disabled>Log in</button>
                </div>

            </form>

            <hr class="col-8 mx-auto mt-5 border border-danger border-2 opacity-75">

            <div class="row justify-content-center m-5 registro">

                <div class="col-lg-3 text-center my-auto">
                    <a href="helios_signin.php"><button type="button" class="btn btn-outline-success w-75">Registro</button></a>
                </div>

                <div class="col-lg-3 mt-lg-0 mt-3 text-center my-auto">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">¿Olvidaste tu contraseña?</button>
                </div>

            </div>

            <div class="row text-center justify-content-center m-3 p-3">
                <div class="col-5 bg-danger-subtle text-danger-emphasis p-2 rounded" id="warnings" style="opacity:0"></div>
            </div>


        </section>

        <!-- VENTANA MODAL -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h1 class="modal-title fs-5 bg-success p-1 text-light rounded " id="exampleModalLabel">Restablecer Contraseña</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row justify-content-center">
                            <p class="fs-5 bg">Si no recuerdas tu contraseña para poder acceder a HELIOS podrás crear una nueva aquí</p>
                        </div>

                        <div class="row justify-content-center">
                            <img class="w-50" src="./iconos_svg/study.svg" />
                        </div>


                        <div class="form-floating mb-3">
                            <input id="usuario" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nombre de usuario</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input id="contrasena1" type="password" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nueva contraseña</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input id="contrasena2" type="password" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Repetir contraseña</label>
                        </div>

                        <div id="notificaciones" class="bg-danger rounded text-light text-center fs-5 w-75 mx-auto"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="botonCambiar" type="button" class="btn btn-success" disabled>Cambiar</button>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>