<?php
class Tipos extends Controller{
    public function __construct() {        
        parent::__construct();
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url . 'login');
        }
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
    }
    public function index()
    {
        $this->views->getView("vehiculos/tipos");
    }
    public function listar()
    {
        $data = $this->model->getTipos(1);
        for ($i=0; $i < count($data); $i++) {
            $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            $data[$i]['editar'] = '<button class="btn btn-outline-primary" type="button" onclick="btnEditarTipo(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>';
            $data[$i]['eliminar'] = '<button class="btn btn-outline-danger" type="button" onclick="btnEliminarTipo(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $nombre = strClean($_POST['nombre']);
        $id = strClean($_POST['id']);
        if (empty($nombre)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        }else{
            if ($id == "") {
                    $data = $this->model->registrarTipo($nombre);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Tipo registrado con éxito', 'icono' => 'success');
                    }else if($data == "existe"){
                        $msg = array('msg' => 'El tipo ya existe', 'icono' => 'warning');
                    }else{
                        $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
            }else{
                $data = $this->model->modificarTipo($nombre, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Tipo modificado', 'icono' => 'success');
                }else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarTipo($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionTipo(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Tipo dado de baja', 'icono' => 'success');
        }else{
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
