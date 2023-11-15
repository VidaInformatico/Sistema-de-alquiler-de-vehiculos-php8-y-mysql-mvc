<?php
class Login extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'Login';
        $this->views->getView("login", $data);
    }

    public function validar()
    {
        $usuario = strClean($_POST['usuario']);
        $clave = strClean($_POST['clave']);
        $rol = strClean($_POST['rol']);
        if (empty($usuario) || empty($clave) || empty($rol)) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'icono' => 'error');
        }else{
            $hash = hash("SHA256", $clave);
            $table = ($rol == 1) ? 'usuarios' : 'clientes';
            $data = $this->model->verify($table, $usuario, $hash);
            if (!empty($data)) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['tipo'] = $rol;
                $_SESSION['perfil'] = ($rol == 1) ? $data['perfil'] : 'default.png';
                $msg = array('msg' => 'Iniciando sesion', 'icono' => 'success');
            }else{
                $msg = array('msg' => 'Usuario o contraseña incorrecta', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
