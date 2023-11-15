<?php
class Pricing extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['active'] = 'pricing';
        $data['title'] = 'Precios';
        $data['detail'] = 'Precios';
        $data['vehiculos'] = $this->model->getVehiculos(1);
        $this->views->getView("pricing", $data);
    }
}
