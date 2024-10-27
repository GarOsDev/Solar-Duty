<header>
    <div class="row justify-content-center">

        <div class="col-lg-2 my-auto text-center mainIcon">
            <a href="helios_index.php"><img src="iconos_png/helios-high-resolution-logo-transparent.png" alt="Paris" id="logo"></a>
        </div>

        <div class="col-lg-8 my-auto text-center fechaCont">
            <p class="my-auto" id="fecha"></p>
        </div>

        <nav class="col-lg-8 menu" style="display: none">

            <li id="utilidad" onclick="window.location.href='helios_performance.php';">Situación</li>
            <li id="conceptos" onclick="window.location.href='helios_project.php';">Sistema</li>
            <li id="desarrollo" onclick="window.location.href='helios_procedures.php';">Desarrollo</li>

            <?php
            if (!isset($_SESSION["usuario"])) {
                echo "<li><a href='helios_login.php' class='link-light link-underline-opacity-0'>Login</a></li>";
            } else {
                echo "<li class='tracking' onclick=window.location.href='helios_userPanel.php';><img class='imgHome' src='./iconos_svg/home.svg'>$_SESSION[usuario]</li>";
            }
            ?>

        </nav>

        <img class="col-lg-2 my-auto hamIcon" id="hamenu" src="iconos_svg/open-menu.svg" alt="icono hamburguer"/>

    </div>
</header>