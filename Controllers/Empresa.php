<?php

class Empresa extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $data['empresa'] = $this->model->getEmpresa();
        $this->views->getView("dashboard/index", $data);
    }
    function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }
    public function modificar()
    {
        if ($this->is_valid_email($_POST['correo'])) {
            $ruc = intval(strClean($_POST['ruc']));
            $nombre = strClean($_POST['nombre']);
            $tel = strClean($_POST['telefono']);
            $dir = strClean($_POST['direccion']);
            $correo = strClean($_POST['correo']);
            $mensaje = strClean($_POST['mensaje']);
            $id = intval(strClean($_POST['id']));
            $img = $_FILES['imagen'];
            $tmpName = $img['tmp_name'];
            if (empty($id) || empty($nombre) || empty($tel) || empty($correo) || empty($dir)) {
                $msg = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
            } else {
                $name = "logo.png";
                $destino = 'Assets/img/logo.png';
                $data = $this->model->modificar($ruc, $nombre, $tel, $correo, $dir, $mensaje, $name, $id);
                if ($data == 'ok') {
                    if (!empty($img['name'])) {
                        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $formatos_permitidos =  array('png');
                        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
                        if (!in_array($extension, $formatos_permitidos)) {
                            $msg = array('msg' => 'Imagen no permitido', 'icono' => 'warning');
                        } else {
                            move_uploaded_file($tmpName, $destino);
                            $msg = array('msg' => 'Datos modificado con éxito', 'icono' => 'success');
                        }
                    } else {
                        $msg = array('msg' => 'Datos modificado con éxito', 'icono' => 'success');
                    }
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        } else {
            $msg = array('msg' => 'Ingrese un correo valido', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
