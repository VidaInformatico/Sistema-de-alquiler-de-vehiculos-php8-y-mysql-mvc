<?php
class EmpresaModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function modificar(string $ruc, string $nombre, string $tel, string $correo, string $dir, string $mensaje, string $img, int $id)
    {
        $sql = "UPDATE configuracion SET ruc=?, nombre = ?, telefono =?, correo=?, direccion=?, mensaje=?, logo = ? WHERE id=?";
        $datos = array($ruc, $nombre, $tel, $correo, $dir, $mensaje, $img, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

}
