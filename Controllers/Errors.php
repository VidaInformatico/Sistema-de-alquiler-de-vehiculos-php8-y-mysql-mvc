<?php
class Errors extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView("errors/index");
    }
}
