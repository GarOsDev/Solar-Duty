<?php
session_start();

if ($_SESSION['usuario'] == "") {
    header('Location: helios_index.php');
}

require_once("db.php");
$db = new HeliosDB();
$res = $db->posicionGeografica($_SESSION['idInstalacion']);
$datosUsu = $db->datosUsuario($_SESSION['usuario']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/helios_cuenta.css">
    <script type="module" src="./js/helios_cuenta.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Panel de <?= $_SESSION['usuario'] ?></title>

</head>

<body>

    <div id="idInstalacion" style="display: none;"><?= $_SESSION['idInstalacion'] ?></div>

    <div class="container">

        <?php include './htmlParts/helios_accountHeader.php' ?>

        <section class="row justify-content-center cuerpoCuenta">

            <div class="row mt-4 justify-content-center ">
                <div class="col-6 text-center text-light fs-3 rounded tituloCuenta">Información de cuenta de usuario</div>
            </div>

            <div class="row text-center justify-content-evenly mt-3 mb-4">
                <div class="col-lg-3 m-2">
                    <div class="card mx-auto" style="width: 18rem;">
                        <img src="iconos_svg/userCard.svg" class="card-img-top w-25 m-3 mx-auto" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center text-light rounded p-2 datosPersonales">Datos Personales</h5>
                            <p class="card-text mt-4">Aqui se detallan los datos que proporcionaste en tu registro</p>
                        </div>
                        <div class="card-header">
                            Nombre
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['nombre'] ?></p>
                        </div>
                        <div class="card-header">
                            Apellidos
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['apellidos'] ?></p>
                        </div>
                        <div class="card-header">
                            Lugar de Residencia
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['municipio'] ?></p>
                        </div>
                        <div class="card-header">
                            Fecha de Registro
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['fechaReg'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 m-2">
                    <div class="card mx-auto" style="width: 18rem;">
                        <img src="iconos_svg/id-card.svg" class="card-img-top w-25 m-3 mx-auto" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center text-light rounded p-2 datosCuenta">Datos de cuenta</h5>
                            <p class="card-text mt-4">Datos únicos de tu cuenta</p>
                        </div>
                        <div class="card-header">
                            Id Usuario
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['idUsu'] ?></p>
                        </div>
                        <div class="card-header">
                            Nombre de Usuario
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['nombreUsuario'] ?></p>
                        </div>
                        <div class="card-header">
                            Contraseña
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['contrasena'] ?></p>
                        </div>
                        <div class="card-header">
                            E-mail
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= $datosUsu[0]['email'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 m-2">
                    <div class="card mx-auto" style="width: 18rem;">
                        <img src="iconos_svg/update.svg" class="card-img-top w-25 m-3 mx-auto" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center text-light rounded p-2 ajustesCuenta">Ajustes de cuenta</h5>
                            <p class="card-text mt-4">Aquí podras realizar los principales cambios en tu cuenta</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><button id="actualizarEmail" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambiaremail">Cambiar E-mail</button></li>
                            <li class="list-group-item"><button id="actualizarContrasena" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambiarcontrasena">Cambiar Contraseña</button></li>
                            <li class="list-group-item"><button id="eliminarInstalacion" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#borrarinstalacion">Eliminar Instalación</button></li>
                            <li class="list-group-item"><button id="eliminarCuenta" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#borrarcuenta">Borrar Cuenta</button></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- VENTANA MODAL CAMBIAR EMAIL -->

            <div class="modal fade" id="cambiaremail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar E-mail de cuenta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nuevo E-mail</label>
                                <input type="email" class="form-control w-75 mx-auto" id="email1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Repita su E-mail</label>
                                <input type="email" class="form-control w-75 mx-auto" id="email2">
                            </div>

                            <div id="notificaciones" class="bg-danger rounded text-light fs-5 w-50 mx-auto"></div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="cambiarEmailbtn" type="button" class="btn btn-danger">Actualizar E-mail</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- VENTANA MODAL CAMBIAR CAMBIAR CONTRASEÑA -->

            <div class="modal fade" id="cambiarcontrasena" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña de cuenta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nueva Contraseña</label>
                                <input type="text" class="form-control w-75 mx-auto" id="contrasena1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Repita Contraseña</label>
                                <input type="text" class="form-control w-75 mx-auto" id="contrasena2">
                            </div>

                            <div id="notificaciones2" class="bg-danger rounded text-light text-center fs-5 w-50 mx-auto"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="cambiarContrasenabtn" type="button" class="btn btn-danger">Actualizar Contraseña</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VENTANA MODAL ELIMINAR INSTALACION -->

            <div class="modal fade" id="borrarinstalacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Instalación Solar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2 class="fs-5">¿Deseas eliminar la instalación solar registrada?</h2>
                            <div id="notificaciones3" class="bg-danger rounded text-light text-center fs-5 w-50 mx-auto"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="eliminarInstalacionSolar" type="button" class="btn btn-primary">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VENTANA MODAL ELIMINAR CUENTA -->

            <div class="modal fade" id="borrarcuenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Cuenta HELIOS</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2 class="fs-5">¿Deseas borrar tu cuenta HELIOS?</h2>
                            <div id="notificaciones4" class="bg-danger rounded text-light text-center fs-5 w-50 mx-auto m-4 "></div>
                            <div id="loader" class="loader mx-auto" style="display: none;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="eliminarCuentaHelios" type="button" class="btn btn-primary">Borrar Cuenta</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>


</body>

</html>