<?php
session_start();


if (isset($_GET['cls'])) {
    session_destroy();
    echo "Sesion cerrada correctamente";
};
