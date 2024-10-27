<?php
session_start();

if ($_SESSION['usuario'] == "") {
    header('Location: helios_index.php');
}

require_once("db.php");
$db = new HeliosDB();
$res = $db->posicionGeografica($_SESSION['idInstalacion']);



// LLAMADA A API PRECIODELALUZ.ORG

$url = "https://api.preciodelaluz.org/v1/prices/all?zone=PCB";
$resp = callAPI($url);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/helios_userInstallation.css">
    <script type="module" src="./js/helios_userInstallation.js"></script>


    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SORTABLE JS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Panel de <?= $_SESSION['usuario'] ?></title>

</head>

<body>

    <div id="preciodelaluzAPI" style="display: none;"><?= $resp ?></div>
    <div id="idInstalacion" style="display: none;"><?= $_SESSION['idInstalacion'] ?></div>

    <div class="container">

        <?php include './htmlParts/helios_accountHeader.php' ?>

        <section class="row justify-content-center estadoInstalacion">

            <div id="noInstallation" class="row justify-content-center SinInstalacion" style="display: none;">

                <div class="row justify-content-center m-5">
                    <div class="col-lg-7 col-md-8 border border-2 border-dark rounded">
                        <div class="row justify-content-center p-3">
                            <div class="fs-4 col-lg-8 col-sm-8 m-lg-1 text-center">Aún no has creado tu instalación</div>
                            <div class="col-lg-3 col-sm-4 text-center my-auto"><button id="botonCrear" type="button" class="btn btn-success">Comenzar</button></div>
                        </div>
                    </div>

                </div>

                <div id="cuadroGeneral" class="row list-group list-group-horizontal justify-content-evenly mb-2" style="display:none">

                    <div class="row justify-content-center mb-3">

                        <div class="col-lg-5 fs-3 text-center bg-primary-subtle rounded p-1 mb-2 ">Debes tener en cuenta</div>

                        <div class="col-lg-12 bg-secondary-subtle rounded">
                            <div class="col-lg-4 fs-4 bg-success text-light p-2 rounded m-2 text-center mx-auto">Inversor Solar</div>
                            <div class="">Dispositivo encargado de transformar la electricidad que producen los Paneles o que contienen las Baterías Solares de 12v 24v o 48v en corriente alterna de 230v apta para el uso en el hogar.</div>
                        </div>

                        <div class="col-lg-12 bg-secondary-subtle m-2 rounded">
                            <div class="col-lg-4 fs-4 bg-success text-light p-2 rounded m-2 text-center mx-auto">Regulador Solar</div>
                            <div class="">Dispositivo cuya función es controlar el estado de carga de las baterías para garantizar que se realiza un llenado óptimo y alargando su vida útil.</div>

                            <div class="mt-2 mb-2"><span class="bg-danger text-light rounded p-1">MPPT</span>:Aprovechan la máxima producción del panel solar para la carga de la batería.
                                Son más eficientes, especialmente cuando hay una diferencia significativa entre la tensión del panel y la tensión de la batería.
                                Son ideales para sistemas grandes y complejos, permitiendo el uso de paneles solares de mayor tensión con sistemas de baterías de menor tensión.
                            </div>
                            <hr>
                            <div class="mt-2 mb-2"><span class="bg-danger text-light rounded p-1">PWM</span>:Realiza una modulación por pulsos y únicamente trabaja de corte de paso de energía entre los paneles y las baterías cuando se han cargado completamente.
                                Por ello funcionan como un interruptor que conecta y desconecta rápidamente los paneles solares a la batería. Son menos eficientes, especialmente cuando hay una diferencia significativa entre la tensión del panel solar y la batería.
                                Son más adecuados para sistemas pequeños.
                            </div>
                        </div>

                    </div>

                    <!-- CUADRO DISPOSITIVOS -->

                    <div id="CD" class="col-lg-5 col-md-10 crearInstalacion my-auto">

                        <div class="row justify-content-center mb-5 bg-secondary-subtle campoCreacion">

                            <!-- PLACAS SOLARES -->

                            <div class="row justify-content-center placasSolares">

                                <!-- TITULO -->
                                <div class="row justify-content-center bg-success text-center m-2 border rounded">
                                    <div class="fs-4 col-12 mx-auto text-light">Placas Solares</div>
                                </div>

                                <!-- Placas 12v -->

                                <div class="row m-1 justify-content-center">
                                    <div class="col-7 text-center fs-5 bg-warning-subtle border rounded border-warning">Placas de 12V</div>
                                </div>

                                <div id="placas12V" class="row m-3 justify-content-center 12V"></div>
                                <div id="nombresplacas12V" class="row m-3 justify-content-around text-center"></div>

                                <!-- Placas 24v -->

                                <div class="row m-1 justify-content-center">
                                    <div class="col-7 text-center fs-5 bg-warning-subtle border rounded border-warning">Placas de 24V</div>
                                </div>

                                <div id="placas24V" class="row m-3 justify-content-center 24V"></div>
                                <div id="nombresplacas24V" class="row m-3 justify-content-around text-center"></div>

                            </div>

                            <!-- BATERÍAS -->

                            <div class="row justify-content-center baterias">

                                <!-- TITULO -->
                                <div class="row justify-content-center bg-success text-center m-2 border rounded">
                                    <div class="fs-4 col-12 mx-auto text-light">Baterías</div>
                                </div>

                                <!-- Baterias -->

                                <div class="row m-1 justify-content-center justify-content-around">
                                    <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">Batería 100ah</div>
                                    <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">Batería 150ah</div>
                                    <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">Batería 300ah</div>
                                </div>

                                <div id="imgBaterias" class="row m-3 justify-content-center bat"></div>

                            </div>

                            <!-- REGULADOR & INVERSOR -->

                            <div class="row justify-content-center inversoRegulador">

                                <!-- TITULO -->
                                <div class="row justify-content-center bg-success text-center m-2 border rounded">
                                    <div class="fs-4 col-12 mx-auto text-light">Inversor & Regulador</div>
                                </div>

                                <!-- Inversor/Regulador -->

                                <div class="row m-1 justify-content-center">

                                    <div class="row m-1 justify-content-center">
                                        <div class="col-7 text-center fs-5 bg-warning-subtle border rounded border-warning">Inversor</div>
                                    </div>

                                    <div class="row m-1 justify-content-center justify-content-around">
                                        <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">12V</div>
                                        <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">24V</div>
                                        <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">48V</div>
                                    </div>

                                    <div id="imgInversores" class="row m-3 justify-content-center inreg"></div>

                                    <div class="row m-1 justify-content-center">
                                        <div class="col-7 text-center fs-5 bg-warning-subtle border rounded border-warning">Regulador</div>
                                    </div>

                                    <div class="row m-1 justify-content-center justify-content-around">
                                        <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">MPPT</div>
                                        <div class="col-3 text-center fs-5 bg-success-subtle m-1 border rounded border-success">PWC</div>
                                    </div>

                                    <div id="imgReguladores" class="row m-3 justify-content-center inreg"></div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- CUADRO DE CREACION DISEÑO -->

                    <div id="disenoCreacion" class="col-lg-6 col-md-10 my-auto disenarInstalacion">
                        <div class="row justify-content-center mb-5 campoDiseno">
                            <div id="contenedorDispositivos" class="col-12 border border-4 border-dark rounded plantilla">

                                <img src="./imagenes/fondo_plantilla_creacion.jpg" class="imagenFondo" alt="fondo de plantilla" />
                                <div id="aparatos" class="aparatos"></div>

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-lg-7 my-auto">
                            <div class="row justify-content-center">
                                <div id="informacionWatts" class="col-lg-10 mx-auto bg-warning text-center rounded border-top border-black border-3 p-2 fs-3"></div>
                            </div>
                            <div class="row justify-content-center">
                                <div id="informacionBaterias" class="col-lg-10 mx-auto bg-warning text-center rounded border-top border-black border-3 p-2 fs-4"></div>
                            </div>
                            <div class="row justify-content-center">
                                <div id="informacionInversor" class="col-lg-10 mx-auto bg-warning text-center rounded border-top border-black border-3 p-2 fs-5"></div>
                            </div>
                            <div class="row justify-content-center">
                                <div id="informacionRegulador" class="col-lg-10 mx-auto bg-warning text-center rounded border-top border-black border-3 p-2 fs-5"></div>
                            </div>

                            <div class="row justify-content-center m-5 botonCreacion">
                                <button id="botonRegistrarInstalacion" type="button" class="col-6 btn btn-success">Crear Instalación</button>
                            </div>
                        </div>

                    </div>




                </div>

            </div>

            <div id="yesInstallation" class="row justify-content-center " style="display: none;">

                <div class="row justify-content-center m-3 rounded ConInstalacion">
                    <div class="row justify-content-center m-3">
                        <div class="col-lg-4 col-sm-12 fs-4 p-1 rounded my-auto text-center text-white tituloInstalacion">Consulta el estado de tu instalación</div>
                    </div>
                    <div class="row justify-content-evenly p-3">

                        <div class="col-lg-4 col-sm-10 rounded text-white resumen">

                            <div class="row p-2">
                                <div class="col-12 text-center fs-4">Resumen Instalacion</div>
                            </div>

                            <div class="row p-2">
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                                    </svg> Latitud: <span id="latitud"><?= $res[0]['latitud'] ?></span></div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                    </svg> Longitud: <span id="longitud"><?= $res[0]['longitud'] ?></span></div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                                        <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641z" />
                                    </svg> Voltaje Base: <span id="voltajeBase"></span></div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plug-fill" viewBox="0 0 16 16">
                                        <path d="M6 0a.5.5 0 0 1 .5.5V3h3V.5a.5.5 0 0 1 1 0V3h1a.5.5 0 0 1 .5.5v3A3.5 3.5 0 0 1 8.5 10c-.002.434-.01.845-.04 1.22-.041.514-.126 1.003-.317 1.424a2.08 2.08 0 0 1-.97 1.028C6.725 13.9 6.169 14 5.5 14c-.998 0-1.61.33-1.974.718A1.92 1.92 0 0 0 3 16H2c0-.616.232-1.367.797-1.968C3.374 13.42 4.261 13 5.5 13c.581 0 .962-.088 1.218-.219.241-.123.4-.3.514-.55.121-.266.193-.621.23-1.09.027-.34.035-.718.037-1.141A3.5 3.5 0 0 1 4 6.5v-3a.5.5 0 0 1 .5-.5h1V.5A.5.5 0 0 1 6 0" />
                                    </svg> Potencia instalada: <span id="potenciaInstalada"></span>W</div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-fullscreen" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5M.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5" />
                                    </svg> Número de placas: <span id="numeroPlacas"></span></div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-battery-half" viewBox="0 0 16 16">
                                        <path d="M2 6h5v4H2z" />
                                        <path d="M2 4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm10 1a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm4 3a1.5 1.5 0 0 1-1.5 1.5v-3A1.5 1.5 0 0 1 16 8" />
                                    </svg> Capacidad de almacenamiento: <span id="capacidadAlmacenamiento"></span>ah</div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-device-ssd-fill" viewBox="0 0 16 16">
                                        <path d="M5 8V4h6v4z" />
                                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m9 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M3.5 11a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1m9.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4.75 3h6.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-6.5A.75.75 0 0 1 4 8.25v-4.5A.75.75 0 0 1 4.75 3M5 12h6a1 1 0 0 1 1 1v2h-1v-2h-.75v2h-1v-2H8.5v2h-1v-2h-.75v2h-1v-2H5v2H4v-2a1 1 0 0 1 1-1" />
                                    </svg> Tipo de regulador: <span id="tipoRegulador"></span></div>
                                <div class="col-12 p-2 fs-5"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1z" />
                                        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812" />
                                    </svg> Voltaje limite inversor: <span id="voltajeInversor"></span></div>
                            </div>

                        </div>

                        <div class="col-lg-7 col-sm-10 mt-lg-0 mt-sm-2 mt-2  rounded text-white my-auto  produccion">

                            <div class="row mt-4 mb-2 justify-content-center ">
                                <div class="col-2 my-auto text-center ">
                                    <div class="loader"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 p-2 fs-5">
                                    <div class="row">
                                        <div class="col-2 my-auto text-center"><img class="w-50 rounded" src="gifts/solar-production.gif" alt="gift energia actual" /></div>
                                        <div class="col-10 my-auto ">Generando actualmente <span class="text-danger" id="potenciaActual"></span> Watts de energía fotovoltaica</div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-2 my-auto text-center"><img class="w-50 rounded" src="gifts/solar-energy.gif" alt="gift energia prevista" /></div>
                                        <div class="col-10 my-auto ">Energía diaria prevista <span class="text-danger" id="energiaDiaria"></span> Watts</div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-2 my-auto text-center"><img class="w-50 rounded" src="gifts/solar-panel.gif" alt="gift energia mensual" /></div>
                                        <div class="col-10 my-auto ">Energía mensual prevista <span class="text-danger" id="energiaMensual"></span> Kw</div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-2 my-auto text-center"><img class="w-50 rounded" src="gifts/bateria-ecologica2.gif" alt="icono autonomia" /></div>
                                        <div class="col-10 my-auto ">Autonomía calculada <span class="text-danger" id="autonomia"></span> días</div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="col-2 my-auto text-center"><img class="w-50 rounded" src="gifts/motor-verde.gif" alt="icono eficiencia" /></div>
                                        <div class="col-10 my-auto ">Eficiencia de instalación <span class="text-danger" id="eficiencia"></span> %</div>
                                    </div>

                                </div>
                            </div>

                            <!-- BOTON MODAL CONFIGURACIÓN DE ALERTA Y DESCARGA DE REGISTROS -->

                            <div class="row justify-content-center  m-3">
                                <div class="col-5 mx-auto text-center my-auto">
                                    <button type="button" class="btn btn-outline-light mx-auto" data-bs-toggle="modal" data-bs-target="#alerta">Configurar alerta de producción</button>
                                </div>
                                <div class="col-5 mx-auto text-center my-auto ">
                                    <button id="registros" type="button" class="btn btn-outline-light mx-auto">Descargar previsiones y registros</button>
                                </div>
                            </div>



                            <!-- VENTANA MODAL CONFIGURACIÓN DE ALERTA -->

                            <div class="modal fade" id="alerta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-dark">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alertas HELIOS</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-dark text-center">
                                            <h2 class="fs-5 bg-danger p-1 text-light w-75 rounded mx-auto ">Configurar servicio de alertas</h2>
                                            <p>Recibe una alerta en tu correo cuando no se registren valores de producción o esten por debajo del límite establecido</p>
                                            <hr>
                                            <p>El sistema monitorizará tu instalación en las principales horas solares del día</p>
                                            <hr>
                                            <p>Avísame cuando la producción baje de <span id="wattsalert" class="bg-danger p-1 text-light rounded "></span> Watts</p>
                                            <input type="range" id="inputRangeValue" min="0" max="5000" class="w-75">
                                            <hr>
                                            <div id="notificaciones" class="bg-danger rounded text-light fs-5 w-50 mx-auto"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button id="botonalerta" type="button" class="btn btn-primary">Guardar Configuración</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="configuracionAlerta" class="row justify-content-center p-3" style="display:none">
                        <div class="col-8 rounded border border-3 border-dark mx-auto bg-danger">
                            <div id="alertaConfigurada" class="text-center text-light fs-5"></div>
                        </div>
                    </div>

                    <div class="row justify-content-center p-3">
                        <div class="col-5 p-2 text-white text-center rounded my-auto fs-5 resumen">Previsión de Producción</div>
                    </div>

                    <div class="row p-3">
                        <div class="col-12 rounded border border-3 border-dark grafico">
                            <canvas id="myPowerChart" class="chart "></canvas>
                        </div>
                    </div>

                    <div class="row justify-content-center p-3">
                        <div class="col-10 p-2 text-white text-center rounded my-auto fs-5 resumen"><img class="imagenEmisiones" src="./gifts/bateria-ecologica.gif" alt="icono emisiones" />Con tu instalación estas evitando que se viertan <span class="text-danger" id="emisionesEvitadas"></span> Kg de CO2 al mes</div>
                    </div>

                    <div class="row justify-content-evenly">

                        <div class="col-lg-4 col-sm-10  p-2 text-white rounded my-auto resumen">


                            <div class="fs-5 text-center">Datos económicos</div>



                            <div class="text-center ">Precio actual del megawatio: <span class="text-danger" id="precioElectricidadMegaWatio"></span> €/MWh</div>


                            <div class="text-center ">Precio actual del kilowatio: <span class="text-danger" id="precioElectricidadKiloWatio"></span> €/kWh</div>


                        </div>

                        <div class="col-lg-7 col-sm-10 mt-lg-0 mt-sm-2 mt-2 rounded text-white my-auto produccion">
                            <div class="row p-2">
                                <div class="col-12 text-center fs-4">Simulación Económica</div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12 p-2 fs-5">
                                    <div class="row">
                                        <div class="col-12 my-auto ">Precio de la energía generada por tu sistema solar <span class="text-danger" id="costoInstalacion"></span> €/kWh</div>
                                    </div>
                                    <div class="row mt-3 ">
                                        <div class="row">
                                            <div class="col-12 my-auto ">Precio diario de la energía comprada a la red consumiendo <span id="slideValor" class="text-danger"> - </span> kWh: <span class="text-danger" id="costosRedElectrica"></span> €</div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <input type="range" class="form-range w-75 " id="rangoConsumos">
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-10 my-auto">Precio tras ahorro <span class="text-danger" id="ahorroCostos"> - </span> €</div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3 justify-content-center p-3">
                        <div class="col-5 p-2 text-white text-center rounded my-auto fs-5 resumen">Precio de la luz hoy</div>
                    </div>

                    <div class="row p-3">
                        <div class="col-12 rounded border border-3 border-dark grafico">
                            <canvas id="myChart" class="chart "></canvas>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>

    <?php include './htmlParts/helios_generalFooter.php' ?>


</body>

</html>