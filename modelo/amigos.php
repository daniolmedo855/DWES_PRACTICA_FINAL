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
            $sql = "SELECT * FROM amigos";
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

        function get_amigos_usuario($usuario){
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
            $sql = "SELECT * FROM amigos WHERE usuario = ? and (nombre like ? or apellidos like ?)";
            $sentencia = $this->bd->prepare($sql);
            $buscar = "%".$nombre."%";
            $sentencia->bind_param("iss", $usuario, $buscar, $buscar);
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

        public function get_amigo($id){
            $sql = "SELECT * FROM amigos WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->execute();
            $sentencia->fetch();
            $amigo = new amigos($this->id, $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->close();
            return $amigo;
        }

        public function modificar_amigo(){
            $sql = "UPDATE amigos SET nombre = ?, apellidos = ?, fecha = ? WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("sssi", $this->nombre, $this->apellidos, $this->fecha, $this->id);
            $sentencia->execute();
            $sentencia->close();
        }
    }
?>