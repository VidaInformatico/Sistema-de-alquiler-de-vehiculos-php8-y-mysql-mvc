<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Reservas extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header("location: " . base_url . 'login');
        }
        parent::__construct();
    }

    public function index()
    {
        $data['vehiculos'] = $this->model->getVehiculos();
        $this->views->getView("alquiler/reservas", $data);
    }

    public function listar($id_vehiculo)
    {
        $data = $this->model->getReservas($id_vehiculo);
        for ($i = 0; $i < count($data); $i++) {
            if ($_SESSION['tipo'] == 1) {
                $data[$i]['title'] = $data[$i]['nombre'];
            } else {
                if ($data[$i]['id_cliente'] == $_SESSION['id_usuario']) {
                    $data[$i]['title'] = $data[$i]['nombre'];
                } else {
                    $data[$i]['title'] = 'RESERVADO';
                }
            }
            $data[$i]['start'] = $data[$i]['f_recogida'];
            $data[$i]['end'] = $data[$i]['f_entrega'];
            $data[$i]['color'] = ($data[$i]['estado'] == 0) ? '#dc3545' : '#198754';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getVehiculo(int $id)
    {
        $data = $this->model->getVehiculo($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function solicitar()
    {
        $id_cli = $_SESSION['id_usuario'];
        $id_veh = strClean($_POST['idVehiculo']);
        $cantidad = strClean($_POST['cantidad']);
        $precios = strClean($_POST['precios']);
        $fecha = strClean($_POST['fecha']) . ' ' . strClean($_POST['hora']);
        $fecha_reserva = date('Y-m-d H:i:s');
        $observacion = strClean($_POST['observacion']);
        if (
            empty($id_cli) || empty($id_veh) || empty($cantidad) || empty($precios) || empty($fecha)
        ) {
            $msg = array('msg' => 'Todo los campos con * son requeridos', 'icono' => 'warning');
        } else {
            //consultar precio x tipo
            $car = $this->model->getVehiculo($id_veh);
            if ($precios == 1) {
                $total = '+ ' . $cantidad . ' hours';
                $monto = $car['precio_hora'];
            } else if ($precios == 2) {
                $total = '+ ' . $cantidad . ' days';
                $monto = $car['precio_dia'];
            } else {
                $total = '+ ' . $cantidad . ' month';
                $monto = $car['precio_mes'];
            }
            $fecha_devolucion = date("Y-m-d H:i:s", strtotime($fecha . $total));
            $existe = $this->model->verify($fecha, $fecha_devolucion, $id_veh);
            if (empty($existe)) {
                $data = $this->model->registrarReserva($fecha, $fecha_devolucion, $cantidad, $precios, $monto, $fecha_reserva, $observacion, $id_veh, $id_cli);
                if ($data > 0) {
                    $msg = array('msg' => 'Reserva solicitado', 'icono' => 'success', 'id_alquiler' => $data);
                } else {
                    $msg = array('msg' => 'Error al solicitar reserva', 'icono' => 'error');
                }
            } else {
                $msg = array('msg' => 'El vehículo esta reservado: ' . $existe['f_recogida'] . ' hasta ' . $existe['f_entrega'], 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function verify($id)
    {
        if ($_SESSION['tipo'] != 1) {
            header("location: " . base_url . 'login');
        }
        $data['reserva'] = $this->model->getReserva($id);
        $data['vehiculo'] = $this->model->getVehiculo($data['reserva']['id_vehiculo']);
        $this->views->getView("alquiler/verify", $data);
    }

    public function aprobar($idReserva)
    {
        if (empty($idReserva) || $_SESSION['tipo'] != 1) {
            $msg = array('msg' => 'No tienes permisos', 'icono' => 'warning');
        } else {
            $data = $this->model->actualizarEstado(1, $idReserva);
            if ($data == 1) {
                $cliente = $this->model->getReserva($idReserva);
                if ($cliente['correo'] != null) {
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
                        $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom($empresa['correo'], $empresa['nombre']);
                        $mail->addAddress($cliente['correo'], $cliente['nombre']);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Solicitud de reserva';
                        $mail->Body    = 'Tu solicitud de reserva ha sido aprobado';

                        $mail->send();
                        $msg = ['msg' => 'Correo enviado', 'icono' => 'success'];
                    } catch (Exception $e) {
                        $msg = ['msg' => 'Error al enviar: ' . $e->getMessage(), 'icono' => 'error'];
                    }
                }else{
                    $msg = array('msg' => 'Solicitud aprobado', 'icono' => 'success');
                }
            } else {
                $msg = array('msg' => 'Error al aprobar', 'icono' => 'error');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
