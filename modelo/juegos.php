<?php
    require_once("bd.php");
    class juegos extends BD{
        protected $id;
        protected $usuario;
        protected $titulo;
        protected $plataforma;
        protected $anio;
        protected $imagen;

        public function __construct($id=null, $usuario=null, $titulo=null, $plataforma=null, $anio=null, $imagen=null){
            parent::__construct();
            $this->id = $id;
            $this->usuario = $usuario;
            $this->titulo = $titulo;
            $this->plataforma = $plataforma;
            $this->anio = $anio;
            $this->imagen = $imagen;
        }

        public function get_juegos(){
            $juegos = array();

            $sql = "SELECT * FROM juegos";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_result($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->execute();

            while($sentencia->fetch()){
                $juego = new juegos($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
                array_push($juegos, $juego);
            }

            $sentencia->close();

            return $juegos;
        }

        public function get_juegos_usuario($usuario){
            $juegos = array();

            $sql = "SELECT * FROM juegos WHERE usuario = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $usuario);
            $sentencia->bind_result($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->execute();

            while($sentencia->fetch()){
                $juego = new juegos($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
                array_push($juegos, $juego);
            }

            $sentencia->close();

            return $juegos;
        }

        public function insertar_juego(){
            $sql = "INSERT INTO juegos (usuario, titulo, plataforma, anio, imagen) VALUES (?, ?, ?, ?, ?)";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("issis", $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->execute();
            $sentencia->close();
        }

        public function buscar_juego($titulo, $usuario){
            $sql = "SELECT * FROM juegos WHERE usuario = ? and (titulo like ? or plataforma like ?)";
            $sentencia = $this->bd->prepare($sql);
            $buscar = "%".$titulo."%";
            $sentencia->bind_param("iss", $usuario, $buscar, $buscar);
            $sentencia->bind_result($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->execute();
            $juegos = array();
            while($sentencia->fetch()){
                $juego = new juegos($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
                array_push($juegos, $juego);
            }
            $sentencia->close();
            return $juegos;
        }

        public function get_juego($id){
            $sql = "SELECT * FROM juegos WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->execute();
            $sentencia->fetch();
            $juego = new juegos($this->id, $this->usuario, $this->titulo, $this->plataforma, $this->anio, $this->imagen);
            $sentencia->close();
            return $juego;
        }

        public function get_imagen($id){
            $sql = "SELECT imagen FROM juegos WHERE id = ?";
            $imagen = "";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($imagen);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return $imagen;
        }

        public function modificar_juego(){
            $sql = "UPDATE juegos SET titulo = ?, plataforma = ?, anio = ?, imagen = ? WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("ssssi", $this->titulo, $this->plataforma, $this->anio, $this->imagen, $this->id);
            $sentencia->execute();
            $sentencia->close();
        }

    }
?>