<?php
    require_once("bd.php");
    class usuarios extends BD{
        protected $id;
        protected $nombre;
        protected $contrasenia;
        protected $admin;

        public function __construct($id=null, $nombre=null, $contrasenia=null, $admin=null){
            parent::__construct();
            $this->nombre = $nombre;
            $this->contrasenia = $contrasenia;
        }

        public function get_usuarios(){
            $usuarios = array();

            $sql = "SELECT * FROM usuarios";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_result($this->id, $this->nombre, $this->contrasenia, $this->admin);
            $sentencia->execute();

            while($sentencia->fetch()){
                $usuario = new usuarios($this->id, $this->nombre, $this->contrasenia, $this->admin);
                array_push($usuarios, $usuario);
            }

            $sentencia->close();

            return $usuarios;
        }

        public function get_id($usuario){
            $sql = "SELECT id FROM usuarios WHERE nombre = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("s", $usuario);
            $sentencia->bind_result($this->id);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return $this->id;
        }

        public function inicio_sesion($usuario, $contrasenia){
            $toRet=false;
            $sql = "SELECT nombre, contrasenia FROM usuarios WHERE nombre = ? AND contrasenia = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("ss", $usuario, $contrasenia);
            $sentencia->bind_result($this->nombre, $this->contrasenia);
            $sentencia->execute();


            if($sentencia->fetch()){
                $toRet=true;
            }

            $sentencia->close();

            return $toRet;
        }

    }
?>