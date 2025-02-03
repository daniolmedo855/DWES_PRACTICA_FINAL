<?php
    require_once("../modelo/usuarios.php");
    require_once("../modelo/amigos.php");

    if(isset($_REQUEST["action"])){ 
        $funcion = strtolower(trim($_REQUEST["action"]));
        $funcion();
    } else{
        require_once("../vista/inicio.html");
        require_once("../vista/inicio_sesion.php");
        require_once("../vista/fin.html");
    }

    function iniciar(){
        $bd = new usuarios();

            $usuario = $_REQUEST["nombre"];
            $contrasenia = $_REQUEST["contraseña"];

            if(isset($_REQUEST["recordar"])){
                setcookie("usuario", $usuario, time() + (86400 * 30));
            } else{
                setcookie("usuario", "", time() - 3600);
            }

            if($bd->inicio_sesion($usuario, $contrasenia)){
                sesion();
                $_SESSION["usuario"] = $bd->get_id($_REQUEST["nombre"]);
                header("Location: index.php?action=inicio");
            } else{
                header("Location: index.php?err=1");
            }

    }

    function inicio(){
        require_once("../vista/principal.php");
    }

    function amigos(){
        sesion();
        $bd = new amigos();
        $amigos = $bd->get_amigos($_SESSION["usuario"]);
        require_once("../vista/principal_amigos.php");
    }

    function salir(){
        header("Location: index.php");
    }

    function sesion(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    function cambiar_fecha($fecha){
        $fecha = explode("-", $fecha);
        $fecha_nueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        return $fecha_nueva;
    }

    function insertar_amigo(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["nombre"]) && isset($_REQUEST["apellidos"]) && isset($_REQUEST["fecha"])){
                $bd = new amigos();
                $bd->__set("usuario", $_SESSION["usuario"]);
                $bd->__set("nombre", $_REQUEST["nombre"]);
                $bd->__set("apellidos", $_REQUEST["apellidos"]);
                $fecha = explode("/", str_replace("-", "/", $_REQUEST["fecha"]));
                $fecha= $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $bd->__set("fecha", $fecha);
                echo $bd->__get("usuario")."<br>".$bd->__get("nombre")."<br>".$bd->__get("apellidos")."<br>".$bd->__get("fecha");
                $bd->insertar_amigo();
                header("Location: index.php?action=amigos&acc=1"); 
            }
              
        }

        require_once("../vista/insertar_amigo.php");
    }

    function buscar_amigos(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["buscar"])){
                $bd = new amigos();
                $amigos = $bd->buscar_amigo($_REQUEST["buscar"], $_SESSION["usuario"]);
                require_once("../vista/principal_amigos.php");
            } else {
                require_once("../vista/buscar_amigo.php");
            }
        }
    }

?>