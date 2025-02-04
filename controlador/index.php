<?php
    require_once("../modelo/usuarios.php");
    require_once("../modelo/amigos.php");
    require_once("../modelo/juegos.php");
    require_once("../modelo/prestamos.php");

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
                if(comprobar_fecha_hoy($_REQUEST["fecha"])){
                    $bd = new amigos();
                    $bd->__set("usuario", $_SESSION["usuario"]);
                    $bd->__set("nombre", $_REQUEST["nombre"]);
                    $bd->__set("apellidos", $_REQUEST["apellidos"]);
                    $bd->__set("fecha", $_REQUEST["fecha"]);
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
        $bd = new amigos();
        if(isset($_GET["id"])){
            $amigo=$bd->get_amigo($_GET["id"]);
            require_once("../vista/amigos/modificar_amigo.php");
        } else {
                if(comprobar_fecha_hoy($_REQUEST["fecha"])){
                    $bd->__set("id", $_REQUEST["id"]);
                    $bd->__set("nombre", $_REQUEST["nombre"]);
                    $bd->__set("apellidos", $_REQUEST["apellidos"]);
                    $bd->__set("fecha", $_REQUEST["fecha"]);
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

    //PRESTAMOS
    function prestamos(){
        sesion();
        $bd = new prestamos();
        $prestamos = $bd->get_prestamos_usuario($_SESSION["usuario"]);
        require_once("../vista/prestamos/principal_prestamos.php");
    }

    function insertar_prestamo(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                if(comprobar_fecha_hoy($_REQUEST["fecha"])){
                    $bd = new prestamos();
                    $bd->__set("usuario", $_SESSION["usuario"]);
                    $bd->__set("amigo", $_REQUEST["amigo"]);
                    $bd->__set("juego", $_REQUEST["juego"]);
                    $bd->__set("fecha_prestamo", $_REQUEST["fecha"]);
                    $bd->insertar_prestamo();
                    header("Location: index.php?action=prestamos&acc=1"); 
                } else {
                    header("Location: index.php?action=prestamos&err=1"); 
                }
                
                
            } else {
                $bd_prestamos = new prestamos();
                $bd_amigos = new amigos();
                $juegos=$bd_prestamos->get_prestamos_usuario_juego($_SESSION["usuario"]);
                $amigos=$bd_amigos->get_amigos_usuario($_SESSION["usuario"]);
                require_once("../vista/prestamos/insertar_prestamo.php");

            }
        }
    }

    function buscar_prestamo(){
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new prestamos();
                $prestamos = $bd->buscar_prestamo($_REQUEST["buscar"], $_SESSION["usuario"]);
                require_once("../vista/prestamos/principal_prestamos.php");
            } else {
                require_once("../vista/prestamos/buscar_prestamo.php");
            }
        }
    }

    function devolver_prestamo(){
        if(isset($_GET["id"])){
            $bd = new prestamos();
            $bd->devolver_prestamo($_GET["id"]);
            header("Location: index.php?action=prestamos&acc=2");
        }
    }

    //FUNCIONES
    function cambiar_fecha($fecha){
        $fecha = explode("-", $fecha);
        $toRet=$fecha[2]."-".$fecha[1]."-".$fecha[0];
        return $toRet;
    }

    function comprobar_fecha_hoy($fecha){
        $hoy = strtotime("today");
        $fecha = strtotime($fecha);
        return $fecha>=$hoy;
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