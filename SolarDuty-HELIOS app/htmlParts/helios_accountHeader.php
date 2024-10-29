<header>
    <div class="row justify-content-center align-items-center">
        <div class="my-auto col-lg-3 col-sm-12 badge text-light text-wrap fs-2 p-2 cabeceraTit">PORTAL SOLAR</div>
        <div class="my-auto col-lg-3 col-sm-12 m-lg-1 m-sm-4 text-center"><img class="img-fluid mainsun" src="./iconos_svg/eco-solar-panel.svg" onclick="window.location.href='helios_userPanel.php';" alt="icono cabecera" /></div>
        <div class="my-auto h4 col-lg-3 col-sm-12 badge text-light text-wrap fs-4 p-2 cabeceraUsu">Hola <?= $_SESSION['usuario'] ?></div>
    </div>
</header>

<div class="collapse" id="navbarToggleExternalContent">
    <div class="row mx-auto justify-content-center text-center">
        <div class="text-bg-dark p-4 d-flex justify-content-evenly flex-wrap">

            <div class="col-lg-2 col-12 mt-lg-0 mt-3">
                <h4 class="my-auto"><a href="helios_index.php">Helios</a></h4>
            </div>
            <div class="col-lg-2 col-12 mt-lg-0 mt-3">
                <h4 class="my-auto"><a href="helios_userPanel.php">Portal Solar</a></h4>
            </div>
            <div class="col-lg-3 col-12 mt-lg-0 mt-3">
                <h4 class="my-auto"><a href="helios_userInstallation.php">Tu instalación</a></h4>
            </div>
            <div class="col-lg-2 col-12 mt-lg-0 mt-3">
                <h4 class="my-auto"><a href="helios_cuenta.php">Cuenta</a></h4>
            </div>
            <div class="col-lg-2 col-12 mt-lg-0 mt-3">
                <h4 onclick="CerrarSesion()" class="my-auto"><a href="#">Cerrar sesión</a></h4>
            </div>


        </div>
    </div>
</div>
<nav class="navbar barraMenu">
    <div class="container-fluid justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>