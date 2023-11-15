<?php
class Usuarios extends Controller{
    public function __construct() {
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
        $this->views->getView("usuarios/index");        
    }
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            $data[$i]['editar'] = '<button class="btn btn-outline-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>';
            $data[$i]['eliminar'] = '<button class="btn btn-outline-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
        
    }
    
    public function registrar()
    {
        if ($this->is_valid_email($_POST['correo'])) {
            $usuario = strClean($_POST['usuario']);
            $nombre = strClean($_POST['nombre']);
            $correo = strClean($_POST['correo']);
            $telefono = strClean($_POST['telefono']);
            $clave = strClean($_POST['clave']);
            $confirmar = strClean($_POST['confirmar']);
            $id = strClean($_POST['id']);
            $hash = hash("SHA256", $clave);
            if (empty($usuario) || empty($nombre) || empty($correo) || empty($telefono)) {
                $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
            } else {
                if ($id == "") {
                    if (!empty($clave) && !empty($confirmar)) {
                        if ($clave != $confirmar) {
                            $msg = array('msg' => 'Las contraseña no coinciden', 'icono' => 'warning');
                        } else {
                            $data = $this->model->registrarUsuario($usuario, $nombre, $correo, $telefono, $hash);
                            if ($data == "ok") {
                                $msg = array('msg' => 'Usuario registrado con éxito', 'icono' => 'success');
                            } else if ($data == "existe") {
                                $msg = array('msg' => 'El usuario ya existe', 'icono' => 'warning');
                            } else {
                                $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                            }
                        }
                    } else {
                        $msg = array('msg' => 'La contraseña es requerido', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificarUsuario($usuario, $nombre, $correo, $telefono, $id);
                    if ($data == "modificado") {
                        $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                    } else {
                        $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
                    }
                }
            }
        }else{
            $msg = array('msg' => 'Ingresa un correo valido', 'icono' => 'warning');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuario dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar el usuario', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function cambiarPass()
    {
        $actual = strClean($_POST['clave_actual']);
        $nueva = strClean($_POST['clave_nueva']);
        $confirmar = strClean($_POST['confirmar_clave']);
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        }else{
            if ($nueva != $confirmar) {
                $mensaje = array('msg' => 'Las contraseña no coinciden', 'icono' => 'warning');
            }else{
                $id = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);
                $data = $this->model->editarUser($id);
                if($data['clave'] == $hash){
                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {
                        $mensaje = array('msg' => 'Contraseña Modificada con éxito', 'icono' => 'success');
                    }else{
                        $mensaje = array('msg' => 'Error al modificar la contraseña', 'icono' => 'error');
                    }
                }else{
                    $mensaje = array('msg' => 'La contraseña actual incorrecta: ', 'icono' => 'warning');
                }
            }
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function perfil()
    {
        $id_user = $_SESSION['id_usuario'];
        $data = $this->model->editarUser($id_user);
        $this->views->getView("usuarios/perfil", $data);
    }

    public function actualizarDato()
    {
        $usuario = strClean($_POST['usuario']);
        $nombre = strClean($_POST['nombre']);
        $correo = strClean($_POST['correo']);
        $telefono = strClean($_POST['telefono']);
        $direccion = strClean($_POST['direccion']);
        $apellido = strClean($_POST['apellido']);
        $id = $_SESSION['id_usuario'];
        $perfil = $_FILES['imagen'];
        $name = $perfil['name'];
        $tmpname = $perfil['tmp_name'];
        $fecha = date("YmdHis");
        if (!empty($name)) {
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $formatos_permitidos =  array('png', 'jpeg', 'jpg');
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            if (!in_array($extension, $formatos_permitidos)) {
                $msg = array('msg' => 'Archivo no permitido', 'icono' => 'warning');
            } else {
                $imgNombre = $fecha . ".jpg";
                $destino = "Assets/img/users/" . $imgNombre;
            }
        } else {
            $imgNombre = strClean($_POST['foto_actual']);
        }
        if (empty($usuario) || empty($nombre)|| empty($apellido) || empty($correo)|| empty($telefono) || empty($direccion)) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        } else {
            if (!empty($name)) {
                $imgDelete = $this->model->editarUser($id);
                if ($imgDelete['perfil'] != 'avatar.svg') {
                    if (file_exists("Assets/img/users/" . $imgDelete['perfil'])) {
                        unlink("Assets/img/users/" . $imgDelete['perfil']);
                    }
                }
            }
            $data = $this->model->modificarDato($usuario, $nombre, $apellido, $correo, $telefono, $direccion, $imgNombre, $id);
            if ($data == 1) {
                if (!empty($name)) {
                    move_uploaded_file($tmpname, $destino);
                }
                $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al modificar el usuario', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
    
    function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }
}
?>

