<?php
    require_once("bd.php");
    class usuarios extends BD{
        protected $nombre;
        protected $contrasenia;

        public function __construct($nombre=null, $contrasenia=null){
            parent::__construct();
            $this->nombre = $nombre;
            $this->contrasenia = $contrasenia;
        }

        public function get_usuarios(){
            $usuarios = array();

            $sql = "SELECT nombre FROM usuarios";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_result($this->nombre);
            $sentencia->execute();

            while($sentencia->fetch()){
                $usuario = new usuarios($this->nombre);
                array_push($usuarios, $usuario);
            }

            $sentencia->close();

            return $usuarios;
        }
    }
?>