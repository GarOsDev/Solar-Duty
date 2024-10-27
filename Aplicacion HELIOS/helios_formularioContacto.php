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
    <link rel="stylesheet" href="./css/helios_formularioContacto.css">
    <link rel="stylesheet" href="./css/helios_commonSecondariesHeader.css">
    <script src="./js/helios_formularioContacto.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <?php include './htmlParts/helios_secondariesHeader.php' ?>

        <div class="formularioContacto">

            <div class="row justify-content-center m-3">
                <div class="col-9 bg-success-subtle text-dark fs-5 rounded">
                    <p class="my-auto">Escribenos para cualquier consulta o sugerencia sobre HELIOS. Nuestro equipo técnico te atenderá lo mejor posible</p>
                </div>
            </div>

            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-lg-8 bg-body-secondary rounded p-3">

                    <form id="formularioContacto">
                        <div class="row mb-3">
                            <div class="col-7">
                                <label for="nombreApellidos" class="form-label bg-success p-2 rounded text-light m-2 border border-2 border-dark">Nombre y Apellidos</label>
                                <input type="text" class="form-control" id="nombreApellidos">
                            </div>
                            <div class="col-5">
                                <label for="codPostal" class="form-label bg-success p-2 rounded text-light m-2 border border-2 border-dark">Código Postal</label>
                                <input type="number" class="form-control" id="codPostal"  placeholder ="Ej:28840">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="form-label bg-success p-2 rounded text-light m-2 border border-2 border-dark">Tema de tu mensaje</label>
                            <input type="text" class="form-control" id="asunto" placeholder="Asunto">
                        </div>
                        <div class="mb-3">
                            <label for="emailUsu" class="form-label bg-success p-2 rounded text-light m-2 border border-2 border-dark">Dirección de Correo</label>
                            <input type="email" class="form-control" id="emailUsu" placeholder="name@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label bg-success p-2 rounded text-light m-2 border border-2 border-dark">Mensaje</label>
                            <div id="mensaje" class="form-text">
                                Escríbenos a continuación tu duda o consulta
                            </div>
                            <textarea class="form-control" id="textarea" rows="3"></textarea>
                        </div>
                        <div class="col-12 text-center ">
                            <button type="submit" class="btn btn-primary">Contactar</button>
                        </div>
                    </form>

                </div>
            </div>

            <div id="rowLoader" class="row justify-content-center m-3" style="display: none;">
                <div class="col-2">
                    <div class="loader mx-auto"> </div>
                </div>
            </div>

            <div class="row justify-content-center m-5">
                <div class="col-6 bg-danger text-light fs-5 rounded text-center">
                    <p id="notificacion" class="my-auto"></p>
                </div>
            </div>



        </div>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>

</body>

</html>