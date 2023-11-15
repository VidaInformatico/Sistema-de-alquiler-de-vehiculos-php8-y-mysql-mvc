<?php
class DocumentosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDocumentos(int $estado)
    {
        $sql = "SELECT * FROM documentos WHERE estado = $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarDoc(string $documento)
    {
        $verficar = "SELECT * FROM documentos WHERE documento = '$documento'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            $sql = "INSERT INTO documentos(documento) VALUES (?)";
            $datos = array($documento);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function modificarDoc(string $documento, int $id)
    {
        $sql = "UPDATE documentos SET documento = ? WHERE id = ?";
        $datos = array($documento, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarDoc(int $id)
    {
        $sql = "SELECT * FROM documentos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionDoc(int $estado, int $id)
    {
        $sql = "UPDATE documentos SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
