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

        public function get_usuarios(){ //me devuelve todos los usuarios que no sean admin en un array 
            $usuarios = array();

            $sql = "SELECT * FROM usuarios WHERE admin = 0";
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

        public function get_id($usuario){ //Return de un id dando un nombre
            $sql = "SELECT id FROM usuarios WHERE nombre = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("s", $usuario);
            $sentencia->bind_result($this->id);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return $this->id;
        }

        public function get_nombre($id){ //Return de un nombre dando un id
            $sql = "SELECT nombre FROM usuarios WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($this->nombre);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return $this->nombre;
        }

        public function inicio_sesion($usuario, $contrasenia){ //comprueba los credenciales de inicio de sesion, retorna true o false
            $toRet=false;
            $sql = "SELECT nombre, contrasenia FROM usuarios where nombre = ?"; //obtengo el nombre y contraseña del usuario, lo hago asi para que la contraseña sea case sensitive
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("s", $usuario);
            $sentencia->bind_result($this->nombre, $this->contrasenia);
            $sentencia->execute();


            if($sentencia->fetch()){
                if(strcmp(strtolower($this->nombre), $usuario)==0 && strcmp($this->contrasenia, $contrasenia)==0){ //los comparo haciendo un strtolower al nombre para que el nombre no sea case sensitive
                    $toRet=true;
                }
            }

            $sentencia->close();

            return $toRet;
        }

        public function admin($id){ //return true o false si el usuario es admin
            $sql = "SELECT admin FROM usuarios WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("s", $id);
            $sentencia->bind_result($this->admin);
            $sentencia->execute();
            $sentencia->fetch();
            
            $toRet=$this->admin;

            $sentencia->close();

            return $toRet;
        }

        public function insertar_usuario(){ //inserta un usuario, devuelve true o false
            $toRet=true;
            try{
                $sql = "INSERT INTO usuarios (nombre, contrasenia) VALUES (?, ?)";
                $sentencia = $this->bd->prepare($sql);
                $sentencia->bind_param("ss", $this->nombre, $this->contrasenia);
                $toRet=$sentencia->execute();
                $sentencia->close();
            }catch(Exception $e){
                $toRet=false;
            }
           
            return $toRet;
        }

        public function buscar_usuario($buscar){ //Return array de usuarios con un filtro
            $sql = "SELECT * FROM usuarios WHERE nombre like ?";
            $buscar="%".$buscar."%";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("s", $buscar);
            $sentencia->bind_result($this->id, $this->nombre, $this->contrasenia, $this->admin);
            $sentencia->execute();
            $usuarios = array();
            while($sentencia->fetch()){
                $usuario = new usuarios($this->id, $this->nombre, $this->contrasenia, $this->admin);
                array_push($usuarios, $usuario);
            }
            $sentencia->close();
            return $usuarios;
        }

        public function get_usuario($id){ //Return de un usuario dando un id
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $sentencia = $this->bd->prepare($sql);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($this->id, $this->nombre, $this->contrasenia, $this->admin);
            $sentencia->execute();
            $sentencia->fetch();
            $usuario = new usuarios($this->id, $this->nombre, $this->contrasenia, $this->admin);
            $sentencia->close();
            return $usuario;
        }

        public function modificar_usuario(){ //modifica un usuario, devuelve true o false
            $toRet=true;
            try{
                if($this->contrasenia!=null){
                    $sql = "UPDATE usuarios SET contrasenia = ?, nombre = ? WHERE id = ?";
                } else {
                    $sql = "UPDATE usuarios SET nombre = ? WHERE id = ?";
                }
    
                $sentencia = $this->bd->prepare($sql);
                if($this->contrasenia!=null){
                    $sentencia->bind_param("ssi", $this->contrasenia, $this->nombre, $this->id);
                } else {
                    $sentencia->bind_param("si", $this->nombre, $this->id);
                }
                $toRet=$sentencia->execute();
                $sentencia->close();
            } catch(Exception $e) {
                $toRet=false;
            }
            return $toRet;
        }
    }

?>