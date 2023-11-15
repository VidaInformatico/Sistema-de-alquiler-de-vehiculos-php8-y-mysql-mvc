<?php
class AlquilerModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAlquiler()
    {
        $sql = "SELECT a.*, c.nombre, v.placa, v.modelo, d.documento, t.tipo FROM alquiler a INNER JOIN clientes c ON c.id = a.id_cliente INNER JOIN vehiculos v ON v.id = a.id_vehiculo INNER JOIN documentos d ON d.id = a.id_doc INNER JOIN tipos t ON t.id = v.id_tipo";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDoc()
    {
        $sql = "SELECT * FROM documentos WHERE estado = 1";
        $existe = $this->selectAll($sql);
        return $existe;
    }
    public function getVehiculos()
    {
        $sql = "SELECT v.id, v.placa, v.id_tipo, v.id_marca, v.estado, t.id, t.tipo, m.id, m.marca FROM vehiculos v INNER JOIN tipos t ON t.id = v.id_tipo INNER JOIN marcas m ON m.id = v.id_marca WHERE v.estado = 1";
        $existe = $this->selectAll($sql);
        return $existe;
    }
    public function getVehiculo($id)
    {
        $sql = "SELECT * FROM vehiculos WHERE id = $id";
        $existe = $this->select($sql);
        return $existe;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }

    public function verify($desde, $hasta, $id_veh) {
        $sql = "SELECT * FROM reservas
        WHERE id_vehiculo = $id_veh
        AND f_recogida <= '$desde'
        AND f_entrega >= '$hasta'";

        return $this->select($sql);
    }

    public function registrarAlquiler($cantidad, $precios, $monto, $abono, $fecha, $fecha_devolucion, $observacion, $id_cli, $id_veh, $documento)
    {
        $verficar = "SELECT * FROM alquiler WHERE id_cliente = $id_cli AND id_vehiculo = $id_veh AND id_doc = $documento AND estado = 1";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            $sql = "INSERT INTO alquiler(cantidad, tipo_precio, monto, abono, fecha_prestamo, fecha_devolucion, observacion, id_cliente, id_vehiculo, id_doc) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $datos = array($cantidad, $precios, $monto, $abono, $fecha, $fecha_devolucion, $observacion, $id_cli, $id_veh, $documento);
            $data = $this->insertar($sql, $datos);
            if ($data > 0) {
                $res = $data;
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function actualizarVehiculo(int $estado, int $id)
    {
        $sql = "UPDATE vehiculos SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function procesarEntrega(int $estado, int $id)
    {
        $sql = "UPDATE alquiler SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function verPrestamo(int $id)
    {
        $sql = "SELECT a.*, c.dni, c.nombre, c.telefono, c.direccion, v.placa, v.modelo, d.documento, t.tipo FROM alquiler a INNER JOIN clientes c ON c.id = a.id_cliente INNER JOIN vehiculos v ON v.id = a.id_vehiculo INNER JOIN documentos d ON d.id = a.id_doc INNER JOIN tipos t ON t.id = v.id_tipo WHERE a.id = $id";
        $existe = $this->select($sql);
        return $existe;
    }
}
