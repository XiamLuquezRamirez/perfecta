<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Tratamientos;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class CitasController extends Controller
{
    public function CargarDisponibilidad()
    {
        if (Auth::check()) {
            $idProf =  request()->get('idProf');
            $disponibilidad = Citas::CitasProfesional($idProf);

            if (request()->ajax()) {
                return response()->json([
                    'disponibilidad' => $disponibilidad
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarAllCitas()
    {
        if (Auth::check()) {
            $disponibilidad = Citas::AllCitas();

            if (request()->ajax()) {
                return response()->json([
                    'disponibilidad' => $disponibilidad
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function VerDetallesCita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCita');
            $detaCita = Citas::buscaDetCitas($idCita);

            $paciente = Pacientes::BuscarPaciente($detaCita->paciente);

            $tratamientos = Tratamientos::TratamientosPacientes($detaCita->paciente);

            if (request()->ajax()) {
                return response()->json([
                    'detaCita' => $detaCita,
                    'paciente' => $paciente,
                    'tratamientos' => $tratamientos,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function VerCitasPac()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $CitasPaciente = Citas::buscaCitasPacientes($idPac);
      

            if (request()->ajax()) {
                return response()->json([
                    'CitasPaciente' => $CitasPaciente
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CambioEstadocita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCita');
            $estadoCita = request()->get('estadoCita');
            $CitasPaciente = Citas::CambioEstadocita($idCita, $estadoCita);
            $tipo = 'cambioEstado';
            //enviar correo de cambio de estado
            $envioCorreo = self::envioCambioEstadoCita($idCita,$tipo);

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $CitasPaciente,
                    'envioCorreo' => $envioCorreo
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function notificaccionCita(){
        if (Auth::check()) {
            $idCita = request()->get('idCita');
            $tipo = 'recordatorio';
            //enviar correo de cambio de estado
            $envioCorreo = self::envioCambioEstadoCita($idCita,$tipo);

            if (request()->ajax()) {
                return response()->json([
                    'envioCorreo' => $envioCorreo
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function envioCambioEstadoCita($idCita,$tipo) {
        $mail = new PHPMailer(true);

        $datosCita = Citas::infcitasEmail($idCita);
       
        if($datosCita->email=="" || $datosCita->email==null){
            return 'noCorreo';
        }

        setlocale(LC_TIME, 'es_ES.utf8');
        $dateTime = new \DateTime($datosCita->inicio);

        // Formatea la fecha y hora según el nuevo formato
        $fechaHoraFormateada = $dateTime->format('d/m/Y h:i A');
        $mensaje = "";
        $asunto = "";
        if($tipo == 'recordatorio'){
            $mensaje = "Le recordamos que tiene una cita pendiente";
            $asunto = "Recordatorio de cita";
        }else{
            $mensaje = "Su cita a cambiado a estado: ".$datosCita->estado;
            $asunto = "Cambio de estado de cita";
        }

        $contenido = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title>Narrative Invitation Email</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
        <style type='text/css'>

        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            border: 0;
            outline: none;
        }

        a img {
            border: none;
        }

        /* General styling */

        td, h1, h2, h3  {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
        }

        td {
            font-size: 13px;
            line-height: 19px;
            text-align: left;
        }

        body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
        }

        table {
            border-collapse: collapse !important;
        }


        h1, h2, h3, h4 {
            padding: 0;
            margin: 0;
            color: #444444;
            font-weight: 400;
            line-height: 110%;
        }

        h1 {
            font-size: 35px;
        }

        h2 {
            font-size: 30px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 18px;
            font-weight: normal;
        }

        .important-font {
            color: #21BEB4;
            font-weight: bold;
        }

        .hide {
            display: none !important;
        }

        .force-full-width {
            width: 100% !important;
        }

        .rps_16ec table#x_main-wrapper {
            border-collapse: collapse;
            border-spacing: 0;
            border: none;
            margin: 0 auto;
            width: 100%;
          }

          .rps_16ec #x_greeting {
            text-align: center;
          }

          .rps_16ec table.x_appt-data {
            width: auto;
            margin: 0 auto;
          }

          .rps_16ec .x_data-row {
            margin: 0 auto;
            width: auto;
          }

          .rps_16ec .x_appt-data tr:first-child td {
            padding-top: 12px;
          }

          .rps_16ec .x_data-row .x_label {
            width: 25%;
            font-weight: bold;
            color: #0097cc;
            text-align: right;
          }

          .rps_16ec .x_header td {
            background: #0097cc;
            padding: 3px;
            color: #fafafa;
            text-align: center;
          }

          .rps_16ec #x_initial-text {
            text-align: center;
            padding: 18px 0;
            line-height: 1.4em;
          }

          .rps_16ec .x_appt-data tr:first-child td {
            padding-top: 12px;
          }
          .rps_16ec .x_data-row .x_label, .rps_16ec .x_data-row .x_data {
            padding: 4px;
              padding-top: 4px;
          }

        </style>

        <style type='text/css' media='screen'>
            @media screen {
                @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

                /* Thanks Outlook 2013! */
                td, h1, h2, h3 {
                font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 600px)'>
            /* Mobile styles */
            @media only screen and (max-width: 600px) {

            table[class='w320'] {
                width: 320px !important;
            }

            table[class='w300'] {
                width: 300px !important;
            }

            table[class='w290'] {
                width: 290px !important;
            }

            td[class='w320'] {
                width: 320px !important;
            }

            td[class~='mobile-padding'] {
                padding-left: 14px !important;
                padding-right: 14px !important;
            }

            td[class*='mobile-padding-left'] {
                padding-left: 14px !important;
            }

            td[class*='mobile-padding-right'] {
                padding-right: 14px !important;
            }

            td[class*='mobile-padding-left-only'] {
                padding-left: 14px !important;
                padding-right: 0 !important;
            }

            td[class*='mobile-padding-right-only'] {
                padding-right: 14px !important;
                padding-left: 0 !important;
            }

            td[class*='mobile-block'] {
                display: block !important;
                width: 100% !important;
                text-align: left !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                padding-bottom: 15px !important;
            }

            td[class*='mobile-no-padding-bottom'] {
                padding-bottom: 0 !important;
            }

            td[class~='mobile-center'] {
                text-align: center !important;
            }

            table[class*='mobile-center-block'] {
                float: none !important;
                margin: 0 auto !important;
            }

            *[class*='mobile-hide'] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                line-height: 0 !important;
                font-size: 0 !important;
            }

            td[class*='mobile-border'] {
                border: 0 !important;
            }
            }
        </style>
        </head>
        <body class='body' style='padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none' bgcolor='#ffffff'>
        <div class='rps_16ec'>
        <div>
        <table id='x_main-wrapper'>
        <thead id='x_logo'>
        <tr>
        <th>
        <img data-imagetype='External' src='https://perfectaestetica.com/app-assets/images/logo/logo_perfecta.png' width = '200px'  alt='PERFECTA' class='x_responsive'> 
        </th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td id='x_greeting'>
        Estimad@ <strong>".$datosCita->apaciente.", ".$datosCita->npaciente.",</strong>
        </td>
        </tr>
        <tr>
        <td style='text-transform: capitalize;' id='x_initial-text'>
        ".$mensaje."
        </td>
        </tr>
        <tr class='x_header'>
        <td>
        <table>
        <tbody>
        <tr>
        <td colspan='2'>
        Datos de la cita
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr>
        <td>
        <table class='x_appt-data'>
        <tbody>
        <tr class='x_data-row'>
        <td class='x_label'>
        Sede
        </td>
        <td class='x_data'>
        Perfecta - Centro de rehabilitación Estética
        </td>
        </tr>
        <tr class='x_data-row'>
        <td class='x_label'>
        Dirección
        </td>
        <td class='x_data'>
        Calle 11 #11-04 San Joaquin
        </td>
        </tr>
        <tr class='x_data-row'>
        <td class='x_label'>
        Fecha
        </td>
        <td class='x_data'>".$fechaHoraFormateada."
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr>
        <td>
        <table class='x_appt-data'>
        <tbody>
        <tr class='x_data-row x_short'>
        <td class='x_label'>
        Profesional
        </td>
        <td class='x_data'>
        ".$datosCita->nomprof."
        </td>
        </tr>
        <tr class='x_data-row x_short'>
        <td class='x_label'>
        Especialidad
        </td>
        <td class='x_data'>
        ".$datosCita->nombre."
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <div>
        </body>
        </html>";



        try {
            // Configuración del servidor SMTP
            require base_path("vendor/autoload.php");
            $mail->isSMTP();
            $mail->Host = 'mail.perfectaestetica.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'citas@perfectaestetica.com';
            $mail->Password = 'Mairen_2024';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS si es necesario
            $mail->Port = 587;

            // Configuración del remitente y destinatario
            $mail->setFrom('citas@perfectaestetica.com', 'PERFECTA');
            $mail->addAddress('xiamir64@gmail.com', $datosCita->npaciente. " ".$datosCita->apaciente);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $contenido;

            // Envío del correo
            $mail->send();

            return 'ok';
        } catch (Exception $e) {
            return "Error";
        }
    }

    public function InformacionCita()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCitaPac');
            $CitasPaciente = Citas::buscaDetCitas($idCita);

            if (request()->ajax()) {
                return response()->json([
                    'CitasPaciente' => $CitasPaciente
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarCita()
    {
        if (Auth::check()) {
            $data = request()->all();

            if ($data["opc"] == "1") {
                if (isset($data['fotoPaciente'])) {

                    $archivo = $data['fotoPaciente'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/images/FotosPacientes/', $nombreArchivo);
                    $data['img'] = $nombreArchivo;
                } else {
                    $data['img'] = "avatar-s-1.png";
                }

                $respuesta = Pacientes::guardar($data);
                $data['idpac'] = $respuesta;
            }
            if ($data['accionCita'] == "agregar") {
                $cita = Citas::GuardarCitas($data);
            } else {
                $cita = Citas::EditarCitas($data);
            }


            if ($cita) {
                if ($data['notCliente'] == "si") {
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok"
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarComentario()
    {
        if (Auth::check()) {
            $data = request()->all();
            $cita = Citas::GuardarComentario($data);

            $comentario = Citas::buscaDetCitas($data['idCit']);


            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                    'comentario' => $comentario->comentario,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function cargarComentario()
    {
        if (Auth::check()) {
            $idCita = request()->get('idCit');
             $comentario = Citas::buscaDetCitas($idCita);
             
            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                    'comentario' => $comentario->comentario,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

   

    public function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array(
                "¨", "º", "-", "~", "", "@", "|", "!",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", " h¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                " ",
            ),
            '',
            $string
        );

        return $string;
    }
}
