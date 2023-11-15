<?php
class About extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'Sobre nosotros (as)';
        $data['detail'] = 'Sobre nosotros (as)';
        $data['active'] = 'about';
        $this->views->getView("about", $data);
    }
}
