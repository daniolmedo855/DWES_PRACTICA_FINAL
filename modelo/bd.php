<?php
require_once("../../../cred.php");
class BD {
    protected $bd;

    public function __construct() {
        $this->bd = new mysqli("localhost", USU_CONN, PSW_CONN, "agenda");
    }

    public function __get($nombre){
        return $this->$nombre;
    }

    public function __set($nombre, $valor){
        $this->$nombre = $valor;
    }
}
?>