<?php
    require_once("../modelo/usuarios.php");
    require_once("../modelo/amigos.php");
    require_once("../modelo/juegos.php");

    if(isset($_REQUEST["action"])){ 
        $funcion = strtolower(trim($_REQUEST["action"]));
        $funcion();
    } else{
        require_once("../vista/inicio.html");
        require_once("../vista/login/inicio_sesion.php");
        require_once("../vista/fin.html");
    }

    //LOGIN Y MENU

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
        require_once("../vista/login/principal.php");
    }

    //AMIGOS

    function amigos(){
        sesion();
        $bd = new amigos();
        $amigos = $bd->get_amigos_usuario($_SESSION["usuario"]);
        require_once("../vista/amigos/principal_amigos.php");
    }

    function insertar_amigo(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                if(comprobar_fecha($_REQUEST["fecha"])){
                    $bd = new amigos();
                    $bd->__set("usuario", $_SESSION["usuario"]);
                    $bd->__set("nombre", $_REQUEST["nombre"]);
                    $bd->__set("apellidos", $_REQUEST["apellidos"]);
                    $fecha = explode("-", $_REQUEST["fecha"]);
                    $fecha= $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $bd->__set("fecha", $fecha);
                    $bd->insertar_amigo();
                    header("Location: index.php?action=amigos&acc=1"); 
                } else {
                    header("Location: index.php?action=amigos&err=1"); 
                }
            }
              
        }

        require_once("../vista/amigos/insertar_amigo.php");
    }

    function buscar_amigo(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new amigos();
                $amigos = $bd->buscar_amigo($_REQUEST["buscar"], $_SESSION["usuario"]);
                require_once("../vista/amigos/principal_amigos.php");
            } else {
                require_once("../vista/amigos/buscar_amigo.php");
            }
        }
    }

    function modificar_amigo(){
        sesion();
        $bd = new amigos();
        if(isset($_GET["id"])){
            $amigo=$bd->get_amigo($_GET["id"]);
            require_once("../vista/amigos/modificar_amigo.php");
        } else {
                if(comprobar_fecha($_REQUEST["fecha"])){
                    $bd->__set("id", $_REQUEST["id"]);
                    $bd->__set("nombre", $_REQUEST["nombre"]);
                    $bd->__set("apellidos", $_REQUEST["apellidos"]);
                    $fecha = explode("-", $_REQUEST["fecha"]);
                    $fecha= $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $bd->__set("fecha", $fecha);
                    $bd->modificar_amigo();
                    header("Location: index.php?action=amigos&acc=2");
                } else {
                    header("Location: index.php?action=amigos&err=1");
                }
                
        }
    }


    //JUEGOS
    function juegos(){
        sesion();
        $bd = new juegos();
        $juegos = $bd->get_juegos_usuario($_SESSION["usuario"]);
        require_once("../vista/juegos/principal_juegos.php");
    }

    function insertar_juego(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new juegos();
                $bd->__set("usuario", $_SESSION["usuario"]);
                $bd->__set("titulo", $_REQUEST["titulo"]);
                $bd->__set("plataforma", $_REQUEST["plataforma"]);
                $bd->__set("anio", $_REQUEST["anio"]);
                $bd->__set("imagen", mover_imagen($_FILES["imagen"]));
                $bd->insertar_juego();
                header("Location: index.php?action=juegos&acc=1"); 
            }
              
        }

        require_once("../vista/juegos/insertar_juego.php");
    }

    function buscar_juego(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new juegos();
                $juegos = $bd->buscar_juego($_REQUEST["buscar"], $_SESSION["usuario"]);
                require_once("../vista/juegos/principal_juegos.php");
            } else {
                require_once("../vista/juegos/buscar_juego.php");
            }
        }
    }

    function modificar_juego(){
        sesion();
        $bd = new juegos();
        if(isset($_GET["id"])){
            $juego=$bd->get_juego($_GET["id"]);
            require_once("../vista/juegos/modificar_juego.php");
        } else {
            $bd->__set("id", $_REQUEST["id"]);
            $bd->__set("titulo", $_REQUEST["titulo"]);
            $bd->__set("plataforma", $_REQUEST["plataforma"]);
            $bd->__set("anio", $_REQUEST["anio"]);
            if(isset($_FILES["imagen"]["name"]) && $_FILES["imagen"]["name"] != ""){
                $bd->__set("imagen", mover_imagen($_FILES["imagen"]));
            } else {
                $bd->__set("imagen", $bd->get_imagen($_REQUEST["id"]));
            }
            $bd->modificar_juego();
            header("Location: index.php?action=juegos&acc=2");        
        }
    }

    //FUNCIONES

    function cambiar_fecha($fecha){
        $fecha = explode("-", $fecha);
        $fecha_nueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        return $fecha_nueva;
    }

    function comprobar_fecha($fecha){
        return preg_match("'^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-([0-9]{4})$'", $fecha);
    }

    function salir(){
        header("Location: index.php");
    }

    function sesion(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    function mover_imagen($imagen){
        if(!file_exists("../img/")){
            mkdir("../img/");
        }

        $origen = $imagen["tmp_name"];
        $nombre = count(glob("../img/*"))+1;
        $destino = "../img/".$nombre.".jpg";

        move_uploaded_file($origen, $destino);

        return $destino;
    }

?>