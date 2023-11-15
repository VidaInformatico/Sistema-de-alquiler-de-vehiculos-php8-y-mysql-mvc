<?php
class ClientesModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getClientes(int $estado)
    {
        $sql = "SELECT * FROM clientes WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function buscarCliente(string $valor)
    {
        $sql = "SELECT id, nombre, direccion FROM clientes WHERE nombre LIKE '%" . $valor . "%' AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCliente(string $dni, string $nombre, string $telefono, string $direccion)
    {
        $verficar = "SELECT * FROM clientes WHERE nombre = '$nombre'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO clientes(dni, nombre, telefono, direccion) VALUES (?,?,?,?)";
            $datos = array($dni, $nombre, $telefono, $direccion);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }
    public function modificarCliente(string $dni, string $nombre, string $telefono ,string $direccion, int $id)
    {
        $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ? ,direccion = ? WHERE id = ?";
        $datos = array($dni, $nombre, $telefono ,$direccion, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarCli(int $id)
    {
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCli(int $estado, int $id)
    {
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function modificarPass(string $clave, int $id)
    {
        $sql = "UPDATE clientes SET clave = ? WHERE id = ?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function modificarDato(string $nombre,string $dni, string $correo, string $tel, string $dir, int $id)
    {
        $sql = "UPDATE clientes SET nombre=?, dni=?, correo=?, telefono=?, direccion=? WHERE id=?";
        $datos = array($nombre, $dni, $correo, $tel, $dir, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
    }
}
