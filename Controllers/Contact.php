<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Contact extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['active'] = 'contact';
        $data['title'] = 'Contactos';
        $data['detail'] = 'Contactenos';
        $this->views->getView("contact", $data);
    }

    public function enviarCorreo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = strClean($_POST['nombre']);
            $asunto = strClean($_POST['asunto']);
            $correo = strClean($_POST['correo']);
            $mensaje = strClean($_POST['mensaje']);
            if (
                empty($nombre) || empty($asunto)
                || empty($correo) || empty($mensaje)
            ) {
                $res = ['msg' => 'Todo los campos son requeridos', 'icono' => 'error'];
            } else {
                $empresa = $this->model->getEmpresa();
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = USER_SMTP;                     //SMTP username
                    $mail->Password   = CLAVE_SMTP;                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = PUERTO_SMTP;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom($correo, $nombre);
                    $mail->addAddress($empresa['correo'], $empresa['nombre']);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $asunto;
                    $mail->Body    = $mensaje;

                    $mail->send();
                    $res = ['msg' => 'Mensaje enviado', 'icono' => 'success'];
                } catch (Exception $e) {
                    $res = ['msg' => 'Error al enviar: ' . $e->getMessage(), 'icono' => 'error'];
                }
            }
        } else {
            $res = ['msg' => 'Error desconocido', 'icono' => 'error'];
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
