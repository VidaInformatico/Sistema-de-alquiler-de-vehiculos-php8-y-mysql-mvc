<?php

class Dashboard extends Controller
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
        if ($_SESSION['tipo'] == 1) {
            $data['usuarios'] = $this->model->getDatos('usuarios');
            $data['clientes'] = $this->model->getDatos('clientes');
            $data['vehiculos'] = $this->model->getDatos('vehiculos');
            $data['tipos'] = $this->model->getDatos('tipos');
            $data['marcas'] = $this->model->getDatos('marcas');
            $this->views->getView('dashboard/home', $data);
        } else {
            header("location: " . base_url . 'reservas');
        }
    }
    
    public function rentas()
    {
        $desde = date('Y') . '-01-01 00:00:00';
        $hasta = date('Y') . '-12-31 23:59:59';
        $data['renta'] = $this->model->rentas($desde, $hasta);
        echo json_encode($data);
        die();
    }

    public function rentasSemana()
    {
        $data = $this->model->rentasSemana();
        echo json_encode($data);
        die();
    }
}
