<?php
class LoginModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function verify($table, $usuario, $hash) {
        if ($table == 'usuarios') {
            $query = "usuario = '$usuario' OR correo = '$usuario'";
        } else {
            $query = "correo = '$usuario'";
        }
        
        return $this->select("SELECT * FROM $table WHERE $query AND clave = '$hash' AND estado = 1");
    }
}

?>