<?php
    require_once("../modelo/usuarios.php");
    require_once("../modelo/amigos.php");
    require_once("../modelo/juegos.php");
    require_once("../modelo/prestamos.php");

    if(isset($_REQUEST["action"])){  //si no encuentra ningun action llama a la función iniciar
        $funcion = strtolower(trim($_REQUEST["action"]));
        $funcion();
    } else{
        iniciar();
    }

    //LOGIN Y MENU
    function iniciar(){ //si esta iniciada $_REQUEST["action"], es decir se ha pulsado el botón de inicio de sesión, compruebo las credenciales y hago el login, sino muestra el formulario
        if(isset($_REQUEST["action"])){
            $bd = new usuarios();

            $usuario = strtolower(trim($_REQUEST["nombre"])); //para que el nombre no sea case sensitive
            $contrasenia = $_REQUEST["contraseña"];

            if(isset($_REQUEST["recordar"])){ //recordar establece una cookie con el nombre de usuario
                setcookie("usuario", $usuario, time() + (86400 * 30));
            } else{
                setcookie("usuario", "", time() - 3600);
            }

            if($bd->inicio_sesion($usuario, $contrasenia)){ //compruebo las credenciales, si son correctas continuo, si no mando un error al login
                sesion();
                $_SESSION["usuario"] = $bd->get_id($_REQUEST["nombre"]); //me guardo la id en la sesion usuario para usarla en otras funciones

                $_SESSION["admin"] = false;
                if($bd->admin($_SESSION["usuario"])==1){ //si es admin la sesion admin se pone en true
                    $_SESSION["admin"] = true;
                }

                header("Location: index.php?action=inicio");
            } else{
                header("Location: index.php?err=1");
            }
        } else {
            require_once("../vista/inicio.html");
            require_once("../vista/login/inicio_sesion.php");
            require_once("../vista/fin.html");
        }
    }

    function inicio(){ //pagina sin nada solo el menu, por no redirigir a otra vista como amigos de primeras
        require_once("../vista/login/principal.php");
    }

    //AMIGOS
    function amigos(){ //Muestra amigos
        sesion();
        $bd = new amigos();
        if($_SESSION["admin"]==1){ //dependiendo de si es admin o no muestra todos los amigos o solo los del usuario, pues contactos y amigos son iguales
            $bd_usuarios = new usuarios();
            $amigos = $bd->get_amigos();
        } else {
            $amigos = $bd->get_amigos_usuario($_SESSION["usuario"]);
        }
        require_once("../vista/amigos/principal_amigos.php");
    }

    function insertar_amigo(){ //inserta un amigo
        sesion();
        if($_SESSION["admin"]==1){ //dependiendo de si es admin o no voy a necesitar todos los usuarios para el dueño
            $bd_usuarios = new usuarios();
            $usuarios = $bd_usuarios->get_usuarios();
        }

        if(isset($_REQUEST["action"])){ //si no he enviado el formulario lo cargo, si lo he enviado lo inserto
            if(isset($_REQUEST["enviar"])){
                if(comprobar_fecha_hoy($_REQUEST["fecha"])){ //compruebo que la fecha no es mayor a hoy, si es correcto hago el insert y redirecciono con un acierto, sino no se inserta y redirecciono con un error
                    $bd = new amigos();
                    if($_SESSION["admin"]==1){ //si es admin el dueño lo determina el admin, si no sera el de la session
                        $bd->__set("usuario", $_REQUEST["usuario"]);
                    } else  {
                        $bd->__set("usuario", $_SESSION["usuario"]);
                    }
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

    function buscar_amigo(){ //busca un amigo
        sesion();
        if($_SESSION["admin"]==1){ //si es admin voy a necesitar todos los usuarios para luego mostrar el resultado de la busqueda con el require_once de principal_amigos
            $bd_usuarios = new usuarios();
            $usuarios = $bd_usuarios->get_usuarios();
        }
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new amigos();
                if($_SESSION["admin"]==1){
                    $amigos = $bd->buscar_amigo($_REQUEST["buscar"]); //la busqueda se hace en todos los usuarios si no paso la variable de usuario
                } else {
                    $amigos = $bd->buscar_amigo($_REQUEST["buscar"], $_SESSION["usuario"]); //la busqueda se hace solo en los amigos del usuario que le he pasado
                }
                require_once("../vista/amigos/principal_amigos.php");
            } else {
                require_once("../vista/amigos/buscar_amigo.php");
            }
        }
    }

    function modificar_amigo(){ //modifica un amigo
        sesion();
        $bd = new amigos();
        if($_SESSION["admin"]==1){ //si es admin necesita los dueños
            $bd_usuarios = new usuarios();
            $usuarios = $bd_usuarios->get_usuarios();
        }
        if(isset($_GET["id"])){ //como me paso por la url el id del usuario que quiero modificar si esta cargo el formulario si no proceso los datos
            $amigo=$bd->get_amigo($_GET["id"]);
            require_once("../vista/amigos/modificar_amigo.php");
        } else {
            if(comprobar_fecha_hoy($_REQUEST["fecha"])){ //comprobar que la fecha no es posterior a hoy

                $bd->__set("id", $_REQUEST["id"]);
                $bd->__set("nombre", $_REQUEST["nombre"]);
                $bd->__set("apellidos", $_REQUEST["apellidos"]);
                $bd->__set("fecha", $_REQUEST["fecha"]);
                
                if($_SESSION["admin"]==1){ // si es admin el dueño lo determina el admin, si no sera el de la session
                    $bd->__set("usuario", $_REQUEST["usuario"]);
                } else {
                    $bd->__set("usuario", $_SESSION["usuario"]);
                }
                
                $bd->modificar_amigo();

                header("Location: index.php?action=amigos&acc=2");
            } else {
                header("Location: index.php?action=amigos&err=1");
            }
        }
    }


    //JUEGOS
    function juegos(){ //Muestra juegos
        sesion();
        $bd = new juegos();
        $juegos = $bd->get_juegos_usuario($_SESSION["usuario"]);
        require_once("../vista/juegos/principal_juegos.php");
    }

    function insertar_juego(){ //inserta un juego
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                if(comprobar_anio($_REQUEST["anio"])){ //el año de lanzamiento no debe ser posterior a el año actual
                    $bd = new juegos();
                    $bd->__set("usuario", $_SESSION["usuario"]);
                    $bd->__set("titulo", $_REQUEST["titulo"]);
                    $bd->__set("plataforma", $_REQUEST["plataforma"]);
                    $bd->__set("anio", $_REQUEST["anio"]);
                    $bd->__set("imagen", mover_imagen($_FILES["imagen"])); //mover imagen me devuelve la ruta de la imagen
                    $bd->insertar_juego();
                    header("Location: index.php?action=juegos&acc=1"); 
                } else {
                    header("Location: index.php?action=juegos&err=1");
                }
            }
              
        }

        require_once("../vista/juegos/insertar_juego.php");
    }

    function buscar_juego(){ //busca un juego
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

    function modificar_juego(){// modifica un juego
        $bd = new juegos();
        if(isset($_GET["id"])){ 
            $juego=$bd->get_juego($_GET["id"]);
            require_once("../vista/juegos/modificar_juego.php");
        } else {
            if(comprobar_anio($_REQUEST["anio"])){
                $bd->__set("id", $_REQUEST["id"]);
                $bd->__set("titulo", $_REQUEST["titulo"]);
                $bd->__set("plataforma", $_REQUEST["plataforma"]);
                $bd->__set("anio", $_REQUEST["anio"]);

                if(isset($_FILES["imagen"]["name"]) && $_FILES["imagen"]["name"] != ""){ //comprueba que me haya subido una imagen si no no la modifico
                    $bd->__set("imagen", mover_imagen($_FILES["imagen"]));
                } else {
                    $bd->__set("imagen", $bd->get_imagen($_REQUEST["id"]));
                }

                $bd->modificar_juego();
                header("Location: index.php?action=juegos&acc=2"); 
            } else {
                header("Location: index.php?action=juegos&err=1"); 

            }
                   
        }
    }

    //PRESTAMOS
    function prestamos(){ //Muestra prestamos
        sesion();
        $bd = new prestamos();
        $prestamos = $bd->get_prestamos_usuario($_SESSION["usuario"]);
        require_once("../vista/prestamos/principal_prestamos.php");
    }

    function insertar_prestamo(){ //inserta un prestamo
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                if(!comprobar_fecha_hoy($_REQUEST["fecha"])){ //la fecha de prestamo no puede ser anterior a hoy
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

    function buscar_prestamo(){ //busca un prestamo
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

    function devolver_prestamo(){ //devuelve un prestamo
        if(isset($_GET["id"])){
            $bd = new prestamos();
            $bd->devolver_prestamo($_GET["id"]);
            header("Location: index.php?action=prestamos&acc=2");
        }
    }

    //USUARIOS
    function usuarios(){ //Muestra usuarios
        sesion();
        $bd = new usuarios();
        $usuarios = $bd->get_usuarios();
        require_once("../vista/usuarios/principal_usuarios.php");
    }
    
    function insertar_usuario(){ //inserta un usuario
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new usuarios();
                $bd->__set("nombre", $_REQUEST["nombre"]);
                $bd->__set("contrasenia", $_REQUEST["contrasenia"]);
                if($bd->insertar_usuario()){ //inserta el usuario si no hay errores
                    header("Location: index.php?action=usuarios&acc=1");
                } else {
                    header("Location: index.php?action=usuarios&err=1"); 
                }
            }  
        }
        require_once("../vista/usuarios/insertar_usuario.php");
    }

    function buscar_usuario(){ //busca un usuario
        sesion();
        if(isset($_REQUEST["action"])){
            if(isset($_REQUEST["enviar"])){
                $bd = new usuarios();
                $usuarios = $bd->buscar_usuario($_REQUEST["buscar"], );
                require_once("../vista/usuarios/principal_usuarios.php");
            } else {
                require_once("../vista/usuarios/buscar_usuario.php");
            }
        }
    }

    function modificar_usuario(){ //modifica un usuario
        sesion();
        $bd = new usuarios();
        if(isset($_GET["id"])){
            $usuario=$bd->get_usuario($_GET["id"]);
            require_once("../vista/usuarios/modificar_usuario.php");
        } else {
            $bd->__set("id", $_REQUEST["id"]);
            $bd->__set("nombre", $_REQUEST["nombre"]);
            if(trim($_REQUEST["contrasenia"]) != ""){
                $bd->__set("contrasenia", $_REQUEST["contrasenia"]);
            }
            if($bd->modificar_usuario()){ //si no hay errores al modificar el usuario lo modifico
                header("Location: index.php?action=usuarios&acc=2");
            } else {
                header("Location: index.php?action=usuarios&err=1");
            }
        }
    }

    //FUNCIONES
    function cambiar_fecha($fecha){ //me pone la fecha en formato español
        $fecha = explode("-", $fecha);
        $toRet=$fecha[2]."-".$fecha[1]."-".$fecha[0];
        return $toRet;
    }

    function comprobar_fecha_hoy($fecha){ //comprueba que la fecha no sea mayor a hoy
        $hoy = strtotime("today");
        $fecha = strtotime($fecha);
        return $fecha<$hoy;
    }

    function comprobar_anio($anio){ //comprueba que el año no sea posterior al actual
        $hoy = date("Y");
        return $anio<=intval($hoy);
    }

    function salir(){ //cierra la sesion
        session_destroy();
        header("Location: index.php");
    }

    function sesion(){ //inicia la sesion si no esta ya iniciada
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    function mover_imagen($imagen){ //establece el nombre de la imagen, mueve la imagen y devuelve la ruta de la imagen
        if(!file_exists("../img/")){ //si no existe la carpeta la crea en caso de que nunca haya subido una imagen antes
            mkdir("../img/");
        }

        $origen = $imagen["tmp_name"];
        $nombre = count(glob("../img/*"))+1; //count(glob("../img/*"))+1 cuenta cuantas imagenes hay en la carpeta y le suma uno para el nombre, asi las imagenes nunca tendran el mismo nombre
        $destino = "../img/".$nombre.".jpg";

        move_uploaded_file($origen, $destino);

        return $destino;
    }

    function modificar_contrasenia($contrasenia){ //modifica la contraseña, es decir me devuelve una cadena de asteriscos para no mostrar la contraseña original
        $toRet="";
        for($i=0; $i<strlen($contrasenia); $i++){
            $toRet .= "*";
        }
        return $toRet;
    }

?>