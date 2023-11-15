<?php
class Clientes extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url . 'login');
        }
        parent::__construct();
    }
    public function index()
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $this->views->getView('clientes/index');
    }
    public function listar()
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $data = $this->model->getClientes(1);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            $data[$i]['editar'] = '<button class="btn btn-outline-primary" type="button" onclick="btnEditarCli(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>';
            $data[$i]['eliminar'] = '<button class="btn btn-outline-danger" type="button" onclick="btnEliminarCli(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $dni = strClean($_POST['dni']);
        $nombre = strClean($_POST['nombre']);
        $telefono = strClean($_POST['telefono']);
        $direccion = strClean($_POST['direccion']);
        $id = strClean($_POST['id']);
        if (empty($dni) || empty($nombre) || empty($telefono) || empty($direccion)) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        }else{
            if ($id == "") {
                $data = $this->model->registrarCliente($dni, $nombre, $telefono, $direccion);
                if ($data == "ok") {
                    $msg = array('msg' => 'Cliente registrado con éxito', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El cliente ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar el cliente', 'icono' => 'error');
                }
            }else{
                $data = $this->model->modificarCliente($dni, $nombre, $telefono, $direccion, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Cliente modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar el cliente', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $data = $this->model->editarCli($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $data = $this->model->accionCli(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Cliente dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar el cliente', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function buscarCliente()
    {
        if (isset($_GET['cli'])) {
            $data = $this->model->buscarCliente($_GET['cli']);
            $datos = array();
            foreach ($data as $row) {
                $data['id'] = $row['id'];
                $data['label'] = $row['nombre'] . ' - ' . $row['direccion'];
                $data['value'] = $row['nombre'];
                array_push($datos, $data);
            }
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        }
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
                $data = $this->model->editarCli($id);
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
        $data = $this->model->editarCli($id_user);
        $this->views->getView("clientes/perfil", $data);
    }

    public function actualizarDato()
    {
        $nombre = strClean($_POST['nombre']);
        $correo = strClean($_POST['correo']);
        $telefono = strClean($_POST['telefono']);
        $direccion = strClean($_POST['direccion']);
        $dni = strClean($_POST['dni']);
        $id = $_SESSION['id_usuario'];
        if (empty($dni) || empty($nombre) || empty($correo)|| empty($telefono) || empty($direccion)) {
            $msg = array('msg' => 'Todo los campos son obligatorios', 'icono' => 'warning');
        } else {
            $data = $this->model->modificarDato($nombre, $dni, $correo, $telefono, $direccion, $id);
            if ($data == 1) {
                $msg = array('msg' => 'Perfil modificado con éxito', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
