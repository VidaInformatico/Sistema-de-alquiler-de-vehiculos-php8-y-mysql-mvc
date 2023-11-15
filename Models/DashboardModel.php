<?php
class DashboardModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function rentas($desde, $hasta)
    {
        $sql = "SELECT SUM(IF(MONTH(fecha_prestamo) = 1, (cantidad * monto), 0)) AS ene,
        SUM(IF(MONTH(fecha_prestamo) = 2, (cantidad * monto), 0)) AS feb,
        SUM(IF(MONTH(fecha_prestamo) = 3, (cantidad * monto), 0)) AS mar,
        SUM(IF(MONTH(fecha_prestamo) = 4, (cantidad * monto), 0)) AS abr,
        SUM(IF(MONTH(fecha_prestamo) = 5, (cantidad * monto), 0)) AS may,
        SUM(IF(MONTH(fecha_prestamo) = 6, (cantidad * monto), 0)) AS jun,
        SUM(IF(MONTH(fecha_prestamo) = 7, (cantidad * monto), 0)) AS jul,
        SUM(IF(MONTH(fecha_prestamo) = 8, (cantidad * monto), 0)) AS ago,
        SUM(IF(MONTH(fecha_prestamo) = 9, (cantidad * monto), 0)) AS sep,
        SUM(IF(MONTH(fecha_prestamo) = 10, (cantidad * monto), 0)) AS oct,
        SUM(IF(MONTH(fecha_prestamo) = 11, (cantidad * monto), 0)) AS nov,
        SUM(IF(MONTH(fecha_prestamo) = 12, (cantidad * monto), 0)) AS dic 
        FROM alquiler WHERE fecha_prestamo BETWEEN '$desde' AND '$hasta'";
        return $this->select($sql);
    }

    public function rentasSemana()
    {
        $sql = "SELECT 
        DATE_FORMAT(fecha_prestamo, '%Y-%m-%d') as fecha, 
        SUM(cantidad * monto) as total
        FROM alquiler
        WHERE WEEK(fecha_prestamo) = WEEK(CURDATE())  -- Obtener la semana actual
        GROUP BY fecha
        ORDER BY fecha";
        return $this->selectAll($sql);
    }
}
