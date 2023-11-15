<?php
class Services extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['active'] = 'services';
        $data['title'] = 'Servicios';
        $data['detail'] = 'Servicios';
        $this->views->getView("services", $data);
    }
}
