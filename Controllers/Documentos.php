<?php
class Documentos extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url . 'login');
        }
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
    }
    public function index()
    {
        $this->views->getView("documentos/index"); 
    }
    
    public function listar()
    {
        $data = $this->model->getDocumentos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
            $data[$i]['editar'] = '<button class="btn btn-outline-primary" type="button" onclick="btnEditarDoc(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>';
            $data[$i]['eliminar'] = '<button class="btn btn-outline-danger" type="button" onclick="btnEliminarDoc(' . $data[$i]['id'] . ');"><i class="fas fa-trash-alt"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $documento = strClean($_POST['documento']);
        $id = strClean($_POST['id']);
        if (empty($documento)) {
            $msg = array('msg' => 'El documento es requerido', 'icono' => 'warning');
        } else {
            if ($id == "") {
                $data = $this->model->registrarDoc($documento);
                if ($data == "ok") {
                    $msg = array('msg' => 'Documento registrado con éxito', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El documento ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->modificarDoc($documento, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Documento modificado', 'icono' => 'success');
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
        $data = $this->model->editarDoc($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id)
    {
        $data = $this->model->accionDoc(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Documento dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
