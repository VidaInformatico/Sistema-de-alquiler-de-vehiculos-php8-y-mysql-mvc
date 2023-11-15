<?php
class Major extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['active'] = 'inicio';
        $this->views->getView("index", $data);
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = strClean($_POST['nombre']);
            $codphone = strClean($_POST['codphone']);
            $telefono = strClean($_POST['telefono']);
            $correo = strClean($_POST['correo']);
            $clave = strClean($_POST['clave']);
            $direccion = strClean($_POST['direccion']);
            if (
                empty($nombre) || empty($telefono)
                || empty($correo) || empty($clave) || empty($direccion)
            ) {
                $res = ['msg' => 'Todo los campos son requeridos', 'icono' => 'error'];
            } else {
                $hash = hash("SHA256", $clave);
                $verificar = $this->model->verify('correo', $correo);
                if (empty($verificar)) {
                    $data = $this->model->register($nombre, $correo, $codphone, $telefono, $direccion, $hash);
                    if ($data > 0) {
                        $res = ['msg' => 'Registrado con éxito', 'icono' => 'success'];
                    } else {
                        $res = ['msg' => 'Error al registrarse', 'icono' => 'error'];
                    }
                } else {
                    $res = ['msg' => 'Ya tienes una cuenta', 'icono' => 'error'];
                }
            }
        } else {
            $res = ['msg' => 'Error desconocido', 'icono' => 'error'];
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
