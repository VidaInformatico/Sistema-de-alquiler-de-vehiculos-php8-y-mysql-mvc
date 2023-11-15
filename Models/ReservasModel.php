<?php
class ReservasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getReservas($id_vehiculo)
    {
        if (empty($id_vehiculo)) {
            $sql = "SELECT r.*, c.nombre FROM reservas r INNER JOIN clientes c ON r.id_cliente = c.id";
        } else {
            $sql = "SELECT r.*, c.nombre FROM reservas r INNER JOIN clientes c ON r.id_cliente = c.id WHERE r.id_vehiculo = $id_vehiculo";
        }

        $data = $this->selectAll($sql);
        return $data;
    }
    public function getVehiculos()
    {
        $sql = "SELECT v.*, m.marca, t.tipo FROM vehiculos v INNER JOIN marcas m ON v.id_marca = m.id INNER JOIN tipos t ON v.id_tipo = t.id WHERE v.estado != 0";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getVehiculo($id)
    {
        $sql = "SELECT v.*, m.marca, t.tipo FROM vehiculos v INNER JOIN marcas m ON v.id_marca = m.id INNER JOIN tipos t ON v.id_tipo = t.id WHERE v.id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function verify($desde, $hasta, $id_veh)
    {
        $sql = "SELECT * FROM reservas
        WHERE id_vehiculo = $id_veh
        AND f_recogida <= '$desde'
        AND f_entrega >= '$hasta'";

        return $this->select($sql);
    }

    public function registrarReserva($fecha, $fecha_devolucion, $cantidad, $tipo, $monto, $fecha_reserva, $observacion, $id_veh, $id_cli)
    {
        $sql = "INSERT INTO reservas(f_recogida, f_entrega, cantidad, tipo_precio, monto, f_reserva, observacion, id_vehiculo, id_cliente) VALUES (?,?,?,?,?,?,?,?,?)";
        $datos = array($fecha, $fecha_devolucion, $cantidad, $tipo, $monto, $fecha_reserva, $observacion, $id_veh, $id_cli);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function getNuevasReservas()
    {
        $sql = "SELECT r.id, r.f_reserva, c.nombre FROM reservas r INNER JOIN clientes c ON r.id_cliente = c.id WHERE r.estado = 0 ORDER BY r.id DESC LIMIT 5";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getReserva($id)
    {
        $sql = "SELECT r.*, c.nombre, c.correo FROM reservas r INNER JOIN clientes c ON r.id_cliente = c.id WHERE r.id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarEstado($estado, $id)
    {
        $sql = "UPDATE reservas SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        return $this->save($sql, $datos);
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
}
