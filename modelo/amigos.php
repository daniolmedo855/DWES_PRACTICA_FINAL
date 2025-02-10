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

        function get_amigos(){ //Return de todos los amigos en un array
            $sql = "SELECT * FROM amigos order by usuario";
            $sentencia = $this->bd->prepare($sql);
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

        function get_amigos_usuario($usuario){ //Return de todos los amigos de un usuario en un array
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

        public function insertar_amigo(){ //inserta un amigo
            $sql = "INSERT INTO amigos (usuario, nombre, apellidos, fecha) VALUES (?, ?, ?, ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("isss", $this->usuario, $this->nombre, $this->apellidos, $this->fecha);
            $sentencia->execute();
            $sentencia->close();
        }

        public function buscar_amigo($nombre, $usuario=null){ //return de array de amigos con un filtro, si no le paso el usuario buscara en todos los usuarios
            if($usuario==null){
                $sql = "SELECT * FROM amigos WHERE nombre like ? or apellidos like ?";
                
            } else {
                $sql = "SELECT * FROM amigos WHERE usuario = ? and (nombre like ? or apellidos like ?)";
            }
            $sentencia = $this->bd->prepare($sql);
            $buscar = "%".$nombre."%";
            if($usuario == null){
                $sentencia->bind_param("ss", $buscar, $buscar);
            } else {
                $sentencia->bind_param("iss", $usuario, $buscar, $buscar);
            }
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

        public function get_amigo($id){ //Return de un amigo dando un id
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

        public function modificar_amigo(){ //modifica un amigo
            $sql = "UPDATE amigos SET nombre = ?, apellidos = ?, fecha = ?, usuario = ? WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("sssii", $this->nombre, $this->apellidos, $this->fecha, $this->usuario, $this->id);
            $sentencia->execute();
            $sentencia->close();
        }
    }
?>