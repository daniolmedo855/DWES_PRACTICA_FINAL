<?php
    require_once("../modelo/usuarios.php");

    $bd = new usuarios();
    $usuarios = $bd->get_usuarios();

    require_once("../vista/inicio.html");
    require_once("../vista/inicio_sesion.php");
    require_once("../vista/fin.html");

?>