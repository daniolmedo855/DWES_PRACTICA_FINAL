<?php
    class amigos extends BD{
        protected $id;
        protected $usuario;
        protected $nombre;
        protected $apellidos;
        protected $fecha;

        public function __construct($id=null, $usuario=null, $nombre=null, $apellidos=null, $fecha=null){
            parent::__construct();
            $this->id = $id;
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->fecha = $fecha;
        }

        function get_amigos($usuario){
            $sql = "SELECT * FROM amigos WHERE usuario = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $usuario);
            $sentencia->bind_result($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->execute();
            $amigos = array();
            while($sentencia->fetch()){
                $amigo = new amigos($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
                array_push($amigos, $amigo);
            }
            $sentencia->close();
            return $amigos;
        }

        public function insertar_amigo(){
            $sql = "INSERT INTO amigos (usuario, nombre, apellidos, fecha) VALUES (?, ?, ?, ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("isss", $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->execute();
            $sentencia->close();
        }

        public function buscar_amigo($nombre, $usuario){
            $sql = "SELECT * FROM amigos WHERE usuario = ? and (nombre = ? or apellidos = ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("iss",$usuario, $nombre, $nombre);
            $sentencia->bind_result($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->execute();
            $amigos = array();
            while($sentencia->fetch()){
                $amigo = new amigos($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
                array_push($amigos, $amigo);
            }
            $sentencia->close();
            return $amigos;
        }
    }
?>