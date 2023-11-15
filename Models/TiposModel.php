<?php
class TiposModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTipos(int $estado)
    {
        $sql = "SELECT * FROM tipos WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarTipo(string $tipo)
    {
        $verficar = "SELECT * FROM tipos WHERE tipo = '$tipo'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO tipos(tipo) VALUES (?)";
            $datos = array($tipo);
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
    public function modificarTipo(string $tipo, int $id)
    {
        $sql = "UPDATE tipos SET tipo = ? WHERE id = ?";
        $datos = array($tipo, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarTipo(int $id)
    {
        $sql = "SELECT * FROM tipos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionTipo(int $estado, int $id)
    {
        $sql = "UPDATE tipos SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
