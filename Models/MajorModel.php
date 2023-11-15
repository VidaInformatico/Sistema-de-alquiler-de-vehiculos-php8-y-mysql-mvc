<?php
class MajorModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function verify($item, $valor) {
        return $this->select("SELECT * FROM clientes WHERE $item = '$valor'");
    }

    public function register($nombre, $correo, $codphone, $telefono, $direccion, $clave)
    {
        $sql = "INSERT INTO clientes (nombre, correo, codphone, telefono, direccion, clave) VALUES (?,?,?,?,?,?)";
        return $this->insertar($sql , [$nombre, $correo, $codphone, $telefono, $direccion, $clave]);
    }
}

?>