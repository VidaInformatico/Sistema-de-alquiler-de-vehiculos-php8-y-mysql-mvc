<?php

class Vehiculos extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url . 'login');
        }
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        parent::__construct();
    }
    public function index()
    {
        $data['marcas'] = $this->model->getDatos('marcas');
        $data['tipos'] = $this->model->getDatos('tipos');
        $this->views->getView("vehiculos/index", $data);
    }
    public function listar()
    {
        $data = $this->model->vehiculos();
        $date = date('Y-m-d');
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['date'] = $date;
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . base_url . "Assets/img/vehiculos/" . $data[$i]['foto'] . '" width="50">';
            $data[$i]['editar'] = '<button class="btn btn-outline-primary" type="button" onclick="btnEditarVeh(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>';
            $data[$i]['eliminar'] = '<button class="btn btn-outline-danger" type="button" onclick="btnEliminarVeh(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $placa = strClean($_POST['placa']);
        $marca = intval(strClean($_POST['marca']));
        $tipo = intval(strClean($_POST['tipo']));
        $modelo = strClean($_POST['modelo']);
        $precio_hora = strClean($_POST['precio_hora']);
        $precio_dia = strClean($_POST['precio_dia']);
        $precio_mes = strClean($_POST['precio_mes']);
        $kilometraje = strClean($_POST['kilometraje']);
        $transmision = strClean($_POST['transmision']);
        $asientos = strClean($_POST['asientos']);
        $equipaje = strClean($_POST['equipaje']);
        $combustible = strClean($_POST['combustible']);
        $id = strClean($_POST['id']);
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];

        $fecha = date("YmdHis");
        if (
            empty($placa) || empty($marca) || empty($tipo) || empty($modelo)
            || empty($precio_dia) || empty($precio_hora) || empty($precio_mes) || empty($kilometraje)
            || empty($transmision) || empty($asientos) || empty($equipaje) || empty($combustible)
        ) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        } else {
            //CREAR CARPETA
            if (!file_exists('Assets/img/vehiculos')) {
                mkdir('Assets/img/vehiculos');
            }
            if (!empty($name)) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $formatos_permitidos =  array('png', 'jpeg', 'jpg');
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                if (!in_array($extension, $formatos_permitidos)) {
                    $msg = array('msg' => 'Archivo no permitido', 'icono' => 'warning');
                } else {
                    $imgNombre = $fecha . ".jpg";
                    $destino = "Assets/img/vehiculos/" . $imgNombre;
                }
            } else if (!empty($_POST['foto_actual']) && empty($name)) {
                $imgNombre = $_POST['foto_actual'];
            } else {
                $imgNombre = "default.png";
            }
            if ($id == "") {
                $data = $this->model->registrarVehiculo($placa, $precio_hora, $precio_dia, $precio_mes,
                $modelo, $kilometraje, $transmision, $asientos, $equipaje, $combustible, $imgNombre, $tipo, $marca);
                if ($data == "ok") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpname, $destino);
                    }
                    $msg = array('msg' => 'Vehículo registrado con éxito', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El Vehículo ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $imgDelete = $this->model->editarVeh($id);
                if ($imgDelete['foto'] != 'default.png') {
                    if (file_exists("Assets/img/vehiculos/" . $imgDelete['foto'])) {
                        unlink("Assets/img/vehiculos/" . $imgDelete['foto']);
                    }
                }
                $data = $this->model->modificarVehiculo($placa, $precio_hora, $precio_dia, $precio_mes,
                $modelo, $kilometraje, $transmision, $asientos, $equipaje, $combustible, $imgNombre, $tipo, $marca, $id);
                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpname, $destino);
                    }
                    $msg = array('msg' => 'Vehículo modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarVeh($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionVeh(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Vehículo dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar el Vehiculo', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarVehiculo()
    {
        if (isset($_GET['veh'])) {
            $data = $this->model->buscarVehiculo($_GET['veh']);
            $datos = array();
            foreach ($data as $row) {
                $data['id'] = $row['id'];
                $data['label'] = $row['placa'] . ' - ' . $row['marca'] . ' - ' . $row['tipo'];
                $data['value'] = $row['placa'] . ' - ' . $row['marca'] . ' - ' . $row['tipo'];
                $data['hora'] = $row['precio_hora'];
                $data['dia'] = $row['precio_dia'];
                $data['mes'] = $row['precio_mes'];
                array_push($datos, $data);
            }
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
