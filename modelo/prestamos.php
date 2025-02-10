<?php
    require_once("bd.php");
    class prestamos extends bd{
        protected $id;
        protected $usuario;
        protected $amigo;
        protected $juego;
        protected $fecha_prestamo;
        protected $devuelto;

        public function __construct($id=null, $usuario=null, $amigo=null, $juego=null, $fecha_prestamo=null, $devuelto=null){
            parent::__construct();
            $this->id = $id;
            $this->usuario = $usuario;
            $this->amigo = $amigo;
            $this->juego = $juego;
            $this->fecha_prestamo = $fecha_prestamo;
            $this->devuelto = $devuelto;
        }

        public function get_prestamos(){ //return de todos los prestamos
            $prestamos = array();

            $sql = "SELECT * FROM prestamos order by fecha_prestamo";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_result($this->id, $this->usuario, $this->amigo, $this->juego, $this->fecha_prestamo, $this->devuelto);
            $sentencia->execute();

            while($sentencia->fetch()){
                $prestamo = new prestamos($this->id, $this->usuario, $this->amigo, $this->juego, $this->fecha_prestamo, $this->devuelto);
                array_push($prestamos, $prestamo);
            }

            $sentencia->close();

            return $prestamos;
        }

        public function get_prestamos_usuario($usuario){ //return de todos los prestamos de un usuario en un array
            $prestamos = array();
            //como busco variables que no tiene prestamos no puedo usar el objeto prestamos, por eso devuelvo una matriz con arrays asociativo en vez de un array de objetos
            $id=0;
            $nombre_amigo="";
            $nombre_usuario="";
            $titulo="";
            $imagen="";
            $fecha="";
            $devuelto="";
            
            $sql = "SELECT prestamos.id, amigos.nombre, usuarios.nombre as usuario_nom, juegos.titulo, juegos.imagen, prestamos.fecha_prestamo, prestamos.devuelto FROM prestamos JOIN amigos on amigos.id=prestamos.amigo JOIN juegos on juegos.id=prestamos.juego JOIN usuarios on usuarios.id=prestamos.usuario WHERE prestamos.usuario = ? order by fecha_prestamo DESC";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $usuario);
            $sentencia->bind_result($id, $nombre_amigo, $nombre_usuario, $titulo, $imagen, $fecha, $devuelto);
            $sentencia->execute();

            while($sentencia->fetch()){
                $prestamo = [
                    "id"=> $id,
                    "amigo" => $nombre_amigo,
                    "usuario"=> $nombre_usuario,
                    "titulo"=> $titulo,
                    "imagen"=> $imagen,
                    "fecha"=> $fecha,
                    "devuelto"=> $devuelto
                ];
                array_push($prestamos, $prestamo);
            }

            $sentencia->close();

            return $prestamos;
        }

        public function get_prestamos_usuario_juego($usuario){ //return de todos los prestamos de un usuario en un array
            $juegos = array();
            
            $id=0;
            $titulo="";

            $sql = "SELECT juegos.id, juegos.titulo FROM juegos WHERE juegos.usuario = ? and juegos.id not in (select prestamos.juego from prestamos where devuelto=0 and prestamos.usuario = ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("ii", $usuario, $usuario);
            $sentencia->bind_result($id, $titulo);
            $sentencia->execute();

            while($sentencia->fetch()){
                $juego = [
                    "id"=> $id,
                    "titulo"=> $titulo
                ];
                array_push($juegos, $juego);
            }

            $sentencia->close();
            return $juegos;
        }

        public function insertar_prestamo(){ //inserta un prestamo
            $sql = "INSERT INTO prestamos (usuario, amigo, juego, fecha_prestamo) VALUES (?, ?, ?, ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("iiis", $this->usuario, $this->amigo, $this->juego, $this->fecha_prestamo);
            $sentencia->execute();
            $sentencia->close();
        }

        public function buscar_prestamo($busqueda, $usuario){ //return de todos los prestamos de un usuario en un array con un filtro
            $prestamos = array();

            $id=0;
            $nombre_amigo="";
            $nombre_usuario="";
            $titulo="";
            $imagen="";
            $fecha="";
            $devuelto=0;
            $busqueda = "%".$busqueda."%";
            
            $sql = "SELECT prestamos.id, amigos.nombre, usuarios.nombre as usuario_nom, juegos.titulo, juegos.imagen, prestamos.fecha_prestamo, prestamos.devuelto FROM prestamos JOIN amigos on amigos.id=prestamos.amigo JOIN juegos on juegos.id=prestamos.juego JOIN usuarios on usuarios.id=prestamos.usuario WHERE prestamos.usuario = ? AND (amigos.nombre like ? or juegos.titulo like ?) order by fecha_prestamo DESC";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("iss", $usuario, $busqueda, $busqueda);
            $sentencia->bind_result($id, $nombre_amigo, $nombre_usuario, $titulo, $imagen, $fecha, $devuelto);
            $sentencia->execute();

            while($sentencia->fetch()){
                $prestamo = [
                    "id"=> $id,
                    "amigo" => $nombre_amigo,
                    "usuario"=> $nombre_usuario,
                    "titulo"=> $titulo,
                    "imagen"=> $imagen,
                    "fecha"=> $fecha,
                    "devuelto"=> $devuelto
                ];
                array_push($prestamos, $prestamo);
            }

            $sentencia->close();

            return $prestamos;
        }

        public function devolver_prestamo($id){ //estable devuelto = true para un prestamo
            $sql = "UPDATE prestamos SET devuelto = 1 WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->execute();
            $sentencia->close();
        }
    }
?>