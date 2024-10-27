<?php
session_start();

require_once("db.php");

$db = new HeliosDB();

$res = $db->provinciasEspana();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HELIOS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/helios_signin.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">

    <script src="./js/helios_signin.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>


        <section class="formulario">

            <div class="row mb-5 justify-content-center">
                <img src="./iconos_svg/sun-weather.svg" style="width: 200px;" />
            </div>

            <div class="row justify-content-center text-center">
                <h3 class="col-3 p-2 bg-success-subtle border border-success rounded-5">Registro de Usuario</h3>
            </div>

            <form class="mt-5" id="signInForm" method="post">

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        <label for="floatingInput">Nombre</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
                        <label for="floatingPassword">Apellidos</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="text" class="form-control" id="nombreUsu" placeholder="Nombre Usuario">
                        <label for="floatingInput">Nombre Usuario</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="password" class="form-control" id="contrasena" placeholder="Password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <div class="form-floating mb-4 col-lg-7">
                        <input type="email" class="form-control" id="email" placeholder="E-mail">
                        <label for="floatingPassword">E-mail</label>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <select class="form-select mb-4 col-lg-7 w-50" name="provincia" id="provincia">
                        <option value="0" selected>Seleccione su Provincia</option>
                        <?php
                        foreach ($res as $r) {
                            echo "<option value='" . $r["idProvincia"] . "'>" . $r["Provincia"] . "</option>";
                        }
                        ?>
                    </select><br /><br />
                </div>

                <div class="row g-2 justify-content-center">
                    <select class="form-select mb-4 col-lg-7 w-50" name="municipio" id="municipio" disabled>
                        <option value="0" selected>Indique su Municipio</option>
                    </select><br /><br />
                </div>

                <div class="row justify-content-center mt-4 gap-4 text-center">
                    <div class="col-lg-2 col-md-4">
                        <button type="submit" id="inputReg" class="btn btn-outline-success">Crear Cuenta</button>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <a class="backLink" href="helios_login.php"><button type="button" id="inputVolver" class="btn btn-outline-info">Volver</button></a>
                    </div>

                </div>

            </form>


            <div class="row text-center justify-content-center m-3 p-3">
                <div class="col-5 bg-danger-subtle text-danger-emphasis p-2 rounded" id="warnings" style="opacity:0"></div>
            </div>

        </section>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>