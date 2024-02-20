<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use App\Models\Profesionales;
use App\Models\Tratamientos;
use App\Models\Secciones;
use App\Models\ItemsTratamiento;
use App\Models\Servicios;
use App\Models\Evoluciones;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

class PacientesController extends Controller
{
    public function Pacientes()
    {
        if (Auth::check()) {
            $bandera = "";
            return view('Pacientes.GestionPacientes', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ValidarPacientes()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $existe = "no";
            $pacientes = DB::connection('mysql')
                ->table('pacientes')
                ->where('identificacion', $idPac)
                ->where('estado', 'ACTIVO')
                ->first();

            if ($pacientes) {
                $existe = "si";
            }

            return response()->json([
                'existe' => $existe,

            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function updateServiciosTerminados()
    {
        if (Auth::check()) {
            $servicio = Tratamientos::AllServiciosTermiandos();

            if (request()->ajax()) {
                return response()->json([
                    'servicio' => $servicio,
                    'cantserv' => $servicio->count()
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ImprimirTratPlan()
    {
        if (Auth::check()) {

            $pdf = new Dompdf();
            $tratamiento = request()->get('trata');
            $opc = request()->get('opc');
            // $logo = public_path('app-assets/images/logo/logo_perfecta.png');
            $logo = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAACNCAYAAABrCgRpAAABN2lDQ1BBZG9iZSBSR0IgKDE5OTgpAAAokZWPv0rDUBSHvxtFxaFWCOLgcCdRUGzVwYxJW4ogWKtDkq1JQ5ViEm6uf/oQjm4dXNx9AidHwUHxCXwDxamDQ4QMBYvf9J3fORzOAaNi152GUYbzWKt205Gu58vZF2aYAoBOmKV2q3UAECdxxBjf7wiA10277jTG+38yH6ZKAyNguxtlIYgK0L/SqQYxBMygn2oQD4CpTto1EE9AqZf7G1AKcv8ASsr1fBBfgNlzPR+MOcAMcl8BTB1da4Bakg7UWe9Uy6plWdLuJkEkjweZjs4zuR+HiUoT1dFRF8jvA2AxH2w3HblWtay99X/+PRHX82Vun0cIQCw9F1lBeKEuf1UYO5PrYsdwGQ7vYXpUZLs3cLcBC7dFtlqF8hY8Dn8AwMZP/fNTP8gAAAAJcEhZcwAACxMAAAsTAQCanBgAAAagaVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA3LjAtYzAwMCA3OS4xMzU3YzllLCAyMDIxLzA3LzE0LTAwOjM5OjU2ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wOkNyZWF0ZURhdGU9IjIwMTctMDUtMjVUMTE6MjY6MjMrMDU6MzAiIHhtcDpNb2RpZnlEYXRlPSIyMDIzLTA5LTA4VDIzOjUwOjM4LTA1OjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIzLTA5LTA4VDIzOjUwOjM4LTA1OjAwIiBkYzpmb3JtYXQ9ImltYWdlL3BuZyIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpkODgxMWY5OC0zNjY4LTRlNDItOGFjMi0wMWU2ZWQ3MzgyZTMiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDphYjE0YWQxZS00MTMyLWM2NDItYTkzYy1kMzNkNTU1YjE3NjIiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoyQUI5RTcyNDNBMDExMUU3QUU1MDhCOUVBRTFCRERGMSIgcGhvdG9zaG9wOkNvbG9yTW9kZT0iMyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjJBQjlFNzIxM0EwMTExRTdBRTUwOEI5RUFFMUJEREYxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjJBQjlFNzIyM0EwMTExRTdBRTUwOEI5RUFFMUJEREYxIi8+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjY1NTkyZDVmLWY1ZTktMmY0Ni05OGM3LTRkNDg4ZWMzYmIzZCIgc3RFdnQ6d2hlbj0iMjAyMy0wOS0wOFQyMzo1MDozOC0wNTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjUgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6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";


            $tratamiento = Tratamientos::busTatamientoRecaudo($tratamiento);

            $html = "<head>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    border-width: 0.1px;
                }
                th, td {
                    border: 0.1px solid black;
                    padding: 4px;
                }
                th {
                    background-color: #EAEBF4;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
    
                .percentile-line {
                    width: 100%;
                    height: 2px;
                    background-color: #EAEBF4;
                    position: relative;
                  }
              
                  .percentile-marker {
                    width: 1px;
                    height: 8px;
                    background-color: #000;
                    position: absolute;
                    top: -4px;
                  }
              
                  .percentile-point {
                    width: 8px;
                    height: 8px;
                    background-color: #02C804;
                    position: absolute;
                    top: -2px;
                    border-radius: 50%;
                    transform: translateX(-50%);
                  }
              
                  .percentile-value {
                    font-size: 8px;
                    color: black;
                    text-align: center;
                    position: absolute;
                    top: 8px;
                    left: 5px;
                    transform: translateX(-50%);
                  }
                  .no-border-right {
                    border-right: none;
                }
                  .no-border-left {
                    border-left: none;
                }

                .no-border {
                    border: none;
                    text-align: center;
                }

                hr {
                    border-width: 0.1px;
                    border-color: #333; /* Cambia el color de la línea (puedes usar nombres, códigos hexadecimales, etc.) */
                    border-style: solid; /* Establece el estilo de la línea (en este caso, sólido) */
                  }
            </style>
            </head>";
            $npaciente =  $tratamiento->npaciente . ' ' . $tratamiento->apellido;
            $html .= '<div style="page-break-after: always;">';
            $html .= '<table style="width:100%; border-collapse: collapse; background-color: transparent;">';
            $html .= '<tr style="margin-bottom: 10px;">';
            $html .= '<td class="no-border" style="padding: 0;"><img src="' . $logo . '"  style="width: 200px; height: auto;"></td>'; // Ancho fijo para la celda del logo
            $html .= '<td class="no-border" style="padding: 0; vertical-align: top;">'; // Agregado vertical-align: top;
            $html .= '<p style="margin: 0;">PERFECTA S.A.S</p>';
            $html .= '<p style="margin: 0;">CENTRO DE REHABILITACIÓN ESTETICA</p>';
            $html .= '<p style="margin: 0;">CRA 11 No 11-04 SAN JOAQUIN</p>';
            $html .= '<p style="margin: 0;">Teléfono 312 8817962</p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td class="no-border" colspan="2" style="padding: 0; vertical-align: top; text-align: left;">'; // Colspan para ocupar ambas celdas
            $html .= '<p style="margin: 0;"><strong>Nombre de Tratamiento: </strong>' . $tratamiento->nombre . '</p>';
            $html .= '<p style="margin: 0;"><strong>Profesional: </strong>' . $tratamiento->nprofe . '</p>';
            $html .= '<p style="margin: 0;"><strong>Especialidad: </strong>' . $tratamiento->nespecialidad . '</p>';
            $html .= '<p style="margin: 0;"><strong>Nombre del Paciente: </strong>' . $npaciente . '</p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</table><hr />';




            $secciones = Secciones::buscSeccServ($tratamiento->id);
            $gtotal = 0;
            $abonado = 0;
            foreach ($secciones as $dataSecc) {
                // Agregar subtítulo y tabla de items de tratamientos
                $html .= '<h4 style="margin-bottom: 2px;">' . $dataSecc->nombre . '</h4>';

                $servicios = Secciones::buscServSecc($dataSecc->id);
                $pagadoTratamiento = $servicios->sum('pagado');
                $abonado += $pagadoTratamiento;
                $html .= '<table style="margin-bottom: 10px; width:100%; border-collapse: collapse; background-color: transparent; font-size: 12px;">';
                $total = 0;
                // Agregar encabezados de la tabla de tratamientos
                $html .= '<tr>';
                $html .= '<th>Nombre de Servicio</th>';
                $html .= '<th>Valor</th>';
                $html .= '</tr>';

                foreach ($servicios as $dataServ) {

                    // Agregar datos de la tabla de tratamientos (reemplazar con tus datos reales)
                    $html .= '<tr>';
                    $html .= '<td>' . $dataServ->nombre . '</td>';
                    $html .= '<td style="text-align: right;"> $ ' . number_format($dataServ->valor, 2, ',', '.') . '</td>';
                    $html .= '</tr>';
                    $total += $dataServ->valor;
                }

                $gtotal  += $total;

                $html .= '<tr>';
                $html .= '<td style="text-align: right; font-weight: bold;">Total:</td>';
                $html .= '<td style="text-align: right; font-weight: bold;">$ ' . number_format($total, 2, ',', '.') . '</td>';
                $html .= '</tr>';

                $html .= '</table>';
            }

            $html .= '<table style="width:100%; border-collapse: collapse; background-color: transparent; font-size: 12px;">';
            $html .= '<tr>';
            $html .= '<td class="no-border-right" style="text-align: right; font-weight: bold;">Total tratamiento:</td>';
            $html .= '<td class="no-border-left" style="text-align: right; font-weight: bold;">$ ' . number_format($gtotal, 2, ',', '.') . '</td>';

            $html .= '</tr>';
            $html .= '</table>';


            $html .= '<table style="margin-bottom: 10px; width:100%; border-collapse: collapse; background-color: transparent; font-size: 12px;">';
            $html .= '<tr>';
            $html .= '<td  style="text-align: right; font-weight: bold;">Abonado:</td>';
            $html .= '<td  style="text-align: right; font-weight: bold;">$ ' . number_format($abonado, 2, ',', '.') . '</td>';

            $html .= '</tr>';
            $html .= '<tr>';
            $saldo = $gtotal - $abonado;
            $html .= '<td  style="text-align: right; font-weight: bold;">Saldo:</td>';
            $html .= '<td  style="text-align: right; font-weight: bold;">$ ' . number_format($saldo, 2, ',', '.') . '</td>';

            $html .= '</tr>';
            $html .= '</table>';
            $html .= '</div>';

            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();


            $pdfContent = $pdf->output();

            if ($opc == 1) {
                // Establecer los encabezados de respuesta
                $headers = [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="Resultado Individual.pdf"'
                ];

                // Devolver el contenido del PDF como una respuesta HTTP con los encabezados
                return response($pdfContent, 200, $headers);
            } else {

                if ($tratamiento->email == "" || $tratamiento->email == null) {
                    if (request()->ajax()) {
                        return response()->json([
                            'resultado' => "noCorreo",
                        ]);
                    }
                } else {
                    $mail = new PHPMailer(true);

                    $mensaje = 'Se ha enviado un archivo adjunto con el presupuesto del tratamiento ' . $tratamiento->nombre;
                    $asunto = 'Presupuesto de tratamiento PERFECTA';


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
        Estimad@  <strong style='text-transform: capitalize;'> " . $npaciente . ",</strong>
        </td>
        </tr>
        <tr>
        <td  id='x_initial-text'>
        " . $mensaje . "
        </td>
        </tr>
        <div>
        </body>
        </html>";


                    try {
                        // Configuración del servidor SMTP
                        require base_path("vendor/autoload.php");
                        $mail->isSMTP();
                        $mail->CharSet = 'UTF-8';
                        $mail->Host = 'mail.perfectaestetica.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'notificaciones@perfectaestetica.com';
                        $mail->Password = 'Mairen_2024';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS si es necesario
                        $mail->Port = 587;

                        // Configuración del remitente y destinatario
                        $mail->setFrom('notificaciones@perfectaestetica.com', 'PERFECTA');

                        $mail->addAddress($tratamiento->email, $npaciente);

                        // Contenido del correo
                        $mail->isHTML(true);
                        $mail->Subject = $asunto;
                        $mail->Body = $contenido;
                        $mail->addStringAttachment($pdfContent, 'presupuesto_Individual.pdf');

                        // Envío del correo
                        $mail->send();

                        return "ok";
                    } catch (Exception $e) {
                        return "Error";
                    }
                }
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function envioComprobante()
    {
        if (Auth::check()) {
            $mail = new PHPMailer(true);
            $idTransaccion = request()->get("idTransaccion");
            $transaccion = Tratamientos::buscTransaccion($idTransaccion);
            $servTerminado = Servicios::ConultservTerminado($idTransaccion);
            $medioPago = Tratamientos::MediosPago($idTransaccion);

            $tratamiento = Tratamientos::busTatamientoRecaudo($transaccion->tratamiento);


            $infPaciente = Pacientes::BuscarPaciente($tratamiento->paciente);

            if ($infPaciente->email == "" || $infPaciente->email == null) {
                if (request()->ajax()) {
                    return response()->json([
                        'resultado' => "noCorreo",
                    ]);
                }
            } else {
                $vTotal = 0;
                foreach ($medioPago as $mPago) {
                    $vTotal = $vTotal + $mPago->valor;
                }

                $dateTime = new \DateTime($transaccion->created_at);

                $fecha = $dateTime->format('d/m/Y h:i A');
                $ncompro = self::addCeros($transaccion->id, 5);
                $fecha =
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
        Estimad@ <strong>" . $infPaciente->apellido . ", " . $infPaciente->nombre . ",</strong>
        </td>
        </tr>
        <tr><td bgcolor='#EEEEEE'><p style='color: #C67386 !important; font-family: Arial; font-size: 18px; margin: 0px !important; line-height: 21px; padding: 10px 20px 0px; text-align: center;'><strong>A continuación encontrará el detalle del</strong></p></td></tr>
        <tr><td bgcolor='#EEEEEE'><p style='color: #C67386 !important; font-family: Arial; font-size: 25px; margin: 0px !important; line-height: 31px; padding: 5px 20px; text-align: center;'><strong>PAGO DE SERVICIOS</strong></p></td></tr>
        <tr class='x_header'>
        <td>
        <table>
        <tbody>
        <tr>
        <td style='font-size: 18px;' colspan='2'>
        Datos del comprobante
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Número de Comprobante: </strong>" . $ncompro . "</p></td></tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Fecha y Hora: </strong> " . $fecha . "</p></td></tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Empresa de servicio: </strong> PERFECTA S.A.S</p></td></tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Concepto: </strong>Pago de servicios de " . $tratamiento->nombre . "</p></td></tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Monto: $ " . number_format($vTotal, 2, ',', '.') . "</strong></p></td></tr>
        <tr><td><p style='color: rgb(100, 100, 100) !important; font-family: Arial; font-size: 17px; margin: 0px !important; line-height: 19px; padding: 15px 40px 5px;'><font color='#C67386'>•</font> <strong>Resultado:</strong> Exitoso</p></td></tr>
        <div>
        </body>
        </html>";


                try {
                    // Configuración del servidor SMTP
                    require base_path("vendor/autoload.php");
                    $mail->isSMTP();
                    $mail->Host = 'mail.perfectaestetica.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'notificaciones@perfectaestetica.com';
                    $mail->Password = 'Mairen_2024';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS si es necesario
                    $mail->Port = 587;

                    // Configuración del remitente y destinatario
                    $mail->setFrom('notificaciones@perfectaestetica.com', 'PERFECTA');
                    $mail->addAddress($infPaciente->email, $infPaciente->nombre . " " . $infPaciente->apellido);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = "Comprobante de pago";
                    $mail->Body = $contenido;


                    // Envío del correo
                    $mail->send();

                    if (request()->ajax()) {
                        return response()->json([
                            'resultado' => "ok",
                        ]);
                    }
                } catch (Exception $e) {
                    if (request()->ajax()) {
                        return response()->json([
                            'resultado' => "error",
                        ]);
                    }
                }
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function AllProfesionales()
    {
        if (Auth::check()) {
            $profesionales = Profesionales::AllProfesional();

            if (request()->ajax()) {
                return response()->json([
                    'profesionales' => $profesionales,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function DeleteTransaccion()
    {
        if (Auth::check()) {
            $idTrasa = request()->get('idTransaccion');
            $motivo = request()->get('motivoDelete');

            $transaccion = Tratamientos::buscTransaccion($idTrasa);
            $delTransaccion = Tratamientos::delTransaccion($transaccion, $motivo);

            $buscServTrata = Tratamientos::buscServ($transaccion->tratamiento);

            if($buscServTrata->count() > 0) {
                $tratami = Tratamientos::editarEstado($transaccion->tratamiento);
            }


            if (request()->ajax()) {
                return response()->json([
                    'transaccion' => $transaccion,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function DeleteArchivoEvolucion()
    {
        if (Auth::check()) {
            $idArchivo = request()->get('idArchivo');

            $delTransaccion = Evoluciones::delArchivo($idArchivo);

            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function DeleteEvolucion()
    {
        if (Auth::check()) {
            $idEvo = request()->get('idEvo');

            $evolucion = Evoluciones::ConsultarEvolucionEdit($idEvo);
            $delEvolucion = Evoluciones::Eliminar($idEvo);

            $serv = $evolucion->servicio;

            $consEvol = Evoluciones::ConsultarEvolucionesServ($serv);
            $ultEvol = $consEvol->last();

            $updateServ = Evoluciones::updatePorcAvance($ultEvol->servicio, $ultEvol->pavance);

            if (request()->ajax()) {
                return response()->json([
                    'estado' => "ok",
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function AllEspecialidades()
    {
        if (Auth::check()) {
            $especialidades = Especialidades::AllEspecialidades();

            if (request()->ajax()) {
                return response()->json([
                    'especialidades' => $especialidades,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }



    public function AllServicios()
    {
        if (Auth::check()) {
            $servicios = Servicios::BuscarAllServicio();

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $servicios,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function busEditServ()
    {
        if (Auth::check()) {
            $idServ = request()->get('idServ');
            $serviciosEdit = Secciones::BuscarServicioEdit($idServ);

            if (request()->ajax()) {
                return response()->json([
                    'serviciosEdit' => $serviciosEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function busEditSecc()
    {
        if (Auth::check()) {
            $idSecc = request()->get('idSecc');
            $seccionesEdit = Secciones::buscSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'seccionesEdit' => $seccionesEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function busEditTrata()
    {
        if (Auth::check()) {
            $idTrat = request()->get('idTrat');
            $tratraEdit = Tratamientos::busTatamiento($idTrat);

            if (request()->ajax()) {
                return response()->json([
                    'tratraEdit' => $tratraEdit,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ConsultarEvoluciones()
    {
        if (Auth::check()) {
            $idSecc = request()->get('idSecc');
            $idServ = request()->get('idServ');
            $Seccion = Secciones::buscSeccion($idSecc);

            $evoluciones = Evoluciones::ConsultarEvolucionesServ($idServ);

            foreach ($evoluciones as $evo) {
                $archivosEvolucion = Evoluciones::consulArcEvol($evo->id);
                $evo->archivos = $archivosEvolucion;
            }

            if (request()->ajax()) {
                return response()->json([
                    'Seccion' => $Seccion,
                    'evoluciones' => $evoluciones,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function ConsultarEvolucionEdit()
    {
        if (Auth::check()) {
            $idEvo = request()->get('idEvo');

            $evolucion = Evoluciones::ConsultarEvolucionEdit($idEvo);
            $archivosEvolucion = Evoluciones::consulArcEvol($evolucion->id);
            $evolucion->archivos = $archivosEvolucion;


            if (request()->ajax()) {
                return response()->json([
                    'evolucion' => $evolucion
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function ConsultarEvolucionesGen()
    {
        if (Auth::check()) {
            $idTrata = request()->get('idTrata');
            $tratamiento = Tratamientos::busTatamiento($idTrata);
            $evoluciones = Evoluciones::ConsultarEvoluciones($idTrata);

            foreach ($evoluciones as $evo) {
                $archivosEvolucion = Evoluciones::consulArcEvol($evo->id);
                $evo->archivos = $archivosEvolucion;
            }

            if (request()->ajax()) {
                return response()->json([
                    'tratamiento' => $tratamiento,
                    'evoluciones' => $evoluciones
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarServicio()
    {
        if (Auth::check()) {
            $idServ = request()->get('idServ');
            $idSecc = request()->get('idSecc');

            $serviciosEdit = Secciones::eliminarServ($idServ);
            $servSeccion = Secciones::buscServSecc($idSecc);
            $totServ = Secciones::busTotalSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'serviciosEdit' => $serviciosEdit,
                    'servSeccion' => $servSeccion,
                    'totServ' => $totServ
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarSeccion()
    {
        if (Auth::check()) {

            $idSecc = request()->get('idSecc');

            $servSeccion = Secciones::buscServSecc($idSecc);
            $seccionStatus = "";

            if ($servSeccion->count() == 0) {
                $serviciosEdit = Secciones::eliminarSeccion($idSecc);
                $serviciosEdit = ItemsTratamiento::eliminarSeccion($idSecc);

                $seccionStatus = "ok";
            } else {
                $seccionStatus = "fail";
                $serviciosEdit = "";
            }

            if (request()->ajax()) {
                return response()->json([
                    'seccionStatus' => $seccionStatus,
                    'serviciosEdit' => $serviciosEdit
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function EliminarTratamiento()
    {
        if (Auth::check()) {

            $idTrata = request()->get('idTrata');

            $Secciones = Secciones::buscSecc($idTrata);
            $tratamientoStatus = "";

            if ($Secciones->count() == 0) {
                $trataEdit = Tratamientos::eliminarTrata($idTrata);
                $tratamientoStatus = "ok";
            } else {
                $tratamientoStatus = "fail";
                $trataEdit = "";
            }

            if (request()->ajax()) {
                return response()->json([
                    'tratamientoStatus' => $tratamientoStatus,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function CargarDatosPacTrat()
    {
        if (Auth::check()) {
            $idPac = request()->get('pacTrat');
            $paciente = Pacientes::BuscarPaciente($idPac);
            $tratamientosAct = Tratamientos::TratamientosPacientesAct($idPac);
            $tratamientosOtr = Tratamientos::TratamientosPacientesOtr($idPac);
            $citas = Citas::CitasPaciente($idPac);
            $servi = Secciones::allSevicios($idPac);

            if (request()->ajax()) {
                return response()->json([
                    'paciente' => $paciente,
                    'tratamientosAct' => $tratamientosAct,
                    'tratamientosOtr' => $tratamientosOtr,
                    'citas' => $citas,
                    'servi' => $servi
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function TratamientosRecaudo()
    {
        if (Auth::check()) {
            $idPac = request()->get('idPac');
            $tratamientosRecaudo = collect(Tratamientos::TratamientosPacientesRecaudo($idPac));


            $resultadosAgrupados = collect();

            $tratamientosAgrupados = $tratamientosRecaudo->groupBy('tratamiento');

            // Recorrer la colección agrupada y calcular sumas\
            $realizadoTratamiento = 0;
            $tratamientosAgrupados->each(function ($tratamientosPorTratamiento, $tratamiento) use ($resultadosAgrupados) {
                $totalTratamiento = $tratamientosPorTratamiento->sum('valor');
                $pagadoTratamiento = $tratamientosPorTratamiento->sum('pagado');
                $saldoTratamiento = $totalTratamiento - $pagadoTratamiento;

                $estado_serv = $tratamientosPorTratamiento->first()->estado_serv;


                $realizadoTratamiento = $tratamientosPorTratamiento->sum('valor');


                $nombreTratamiento = $tratamientosPorTratamiento->first()->ntrara;
                $nombreProfesional = $tratamientosPorTratamiento->first()->nprof;
                $nombrePaciente = $tratamientosPorTratamiento->first()->npac;
                $saldoPrevio = $tratamientosPorTratamiento->first()->sprev;

                // Agregar los resultados a la nueva colección
                $resultadosAgrupados->push([
                    'tratamiento' => $tratamiento,
                    'nombreTratamiento' => $nombreTratamiento,
                    'nombreProfesional' => $nombreProfesional,
                    'nombrePaciente' => $nombrePaciente,
                    'saldoPrevio' => $saldoPrevio,
                    'total' => $totalTratamiento,
                    'realizado' => $realizadoTratamiento,
                    'pagado' => $pagadoTratamiento,
                    'saldo' => $saldoTratamiento,
                ]);
            });

            /// Recaudos realizados al paciente
            $recaudos = Tratamientos::transaccionesPacientes($idPac);
            /// Recaudos eliminados al paciente
            $recaudosEliminados = Tratamientos::transaccionesPacientesEliminadas($idPac);

            if (request()->ajax()) {
                return response()->json([
                    'tratamientosRecaudo' => $resultadosAgrupados,
                    'recaudos' => $recaudos,
                    'recaudosEliminados' => $recaudosEliminados
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function TratamientosRecaudoDetalles()
    {
        if (Auth::check()) {
            $data = request()->all();
            $dataIdsJson = request()->get('dataIds');
            $dataIdsArray = json_decode($dataIdsJson, true);

            $detaTrata = "";

            foreach ($dataIdsArray as $dataId) {
                //cargar tratamientos
                $tratamiento = Tratamientos::busTatamiento($dataId);
                $secciones = Secciones::buscSeccServ($tratamiento->id);
                if ($secciones->count() > 0) {                                                                                                                                                                                                                                                                                                                                                   
                $detaTrata .= '<tr>' .
                    '<th colspan="6" class="text-truncate">' .
                    '    <div>' .
                    '        <p style="text-transform: capitalize;" class="mb-25 latest-update-item-name text-bold-600"><span class="bullet bullet-primary bullet-sm"></span> ' .
                    $tratamiento->nombre .
                    '        </p>' .
                    '    </div></th>' .
                    '</tr><input type="hidden" name="tratamientoSel" value="' . $tratamiento->id . '"/><input type="hidden" name="tratamiento" value="' . $tratamiento->id . '"/>';

                //cargar secciones
                }
                $secc = "";
                foreach ($secciones as $dataSecc) {
                    $servicios = Secciones::buscServSecc($dataSecc->id);
                    if ($servicios->count() > 0) {
                        $secc = '<tr>' .
                            '<th colspan="6" class="text-truncate">' .
                            '    <div>' .
                            '        <p style="text-transform: capitalize;" class="mb-25 latest-update-item-name" style=" font-style: italic;">' .
                            $dataSecc->nombre .
                            '        </p>' .
                            '    </div></th>' .
                            '</tr>';
                        $detaTrata .= $secc;
                    }
                    //cargar servicios


                    foreach ($servicios as $dataServ) {
                        $serv = "";
                        $saldo = $dataServ->valor - $dataServ->pagado;
                        $serv = '<tr>' .
                            '<td  class="text-truncate">' .
                            '    <input type="checkbox" data-valor="' . $saldo . '" data-id="' . $dataServ->id .
                            '" id="checkRecaudo' . $dataServ->id . '"  class="icheck-activity-det">' .
                            '</td>' .
                            '<td  class="text-truncate">' .
                            '    <div>' .
                            '        <p>' .
                            $dataServ->nombre .
                            '        </p>' .
                            '    </div>' .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($dataServ->valor, 2, ',', '.') .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($dataServ->pagado, 2, ',', '.') .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">' .
                            $dataServ->estado_serv .
                            '</td>' .
                            '<td class="text-truncate" style="vertical-align: middle; ">$ ' .
                            number_format($saldo, 2, ',', '.')  .
                            '</td>' .
                            '</tr>';
                        $detaTrata .= $serv;
                    }
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'detaTrata' => $detaTrata,
                    'saldo_previo' => $tratamiento->saldo_previo
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function SeccionesTratamientos()
    {
        if (Auth::check()) {
            $idTrat = request()->get('tratSecc');

            $Tratamientos = Tratamientos::busTatamiento($idTrat);
            $ItemsTratamientos = ItemsTratamiento::consulAllItem($idTrat);
            $ContTratamientos = '';

            $servTratamiento = Tratamientos::consulAllServ($idTrat);

            foreach ($ItemsTratamientos as $i => $item) {
                if ($item->tip_servi == "seccion") {

                    $seccion = Secciones::buscSeccion($item->id_servi);

                    $busTotalSeccion = Secciones::busTotalSeccion($seccion->id);
                    $total = number_format($busTotalSeccion, 2, ',', '.');


                    $ContTratamientos .= '<div id="seccion' . $seccion->id . '" class="card collapse-header mb-0" role="tablist">
                <div id="headingCollapse5"
                    class="card-header d-flex justify-content-between align-items-center m-1"
                    style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; border: 1px solid #e4e7ed;"
                    data-toggle="collapse" role="tab"
                    data-target="#collapse' . $seccion->id . '"
                    aria-expanded="false"
                    aria-controls="collapse' . $seccion->id . '">
                    <div class="collapse-title media">

                        <div class="media-body mt-25">
                            <h4 id="nomSeccion' . $seccion->id . '">' . $seccion->nombre . '</h4>
                        </div>
                    </div>
                    <div
                        class="information d-sm-flex d-none align-items-center">
                        <div class="collection mr-1">
                            <span class="bullet bullet-xs bullet-primary"></span>
                            <span class="font-weight-bold" id="span-total' . $seccion->id . '">$ ' . $total . '</span>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle"
                                id="fisrt-open-submenu"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i  class="feather icon-more-vertical mr-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="fisrt-open-submenu">
                                <a onclick="$.addServicioSeccion(' . $seccion->id . ');"
                                    class="dropdown-item mail-reply">
                                    <i class="feather icon-plus"></i>
                                    Agregar Servicio
                                </a>
                                <div class="dropdown-divider">
                                </div>
                                <a onclick="$.editarSeccion(' . $seccion->id . ');" 
                                    class="dropdown-item">
                                    <i class="feather icon-edit"></i>
                                    Editar sección
                                </a>
                                <a onclick="$.eliminarSeccion(' . $seccion->id . ');"
                                    class="dropdown-item">
                                    <i class="feather icon-trash-2"></i>
                                    Eliminar Sección
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapse' . $seccion->id . '" role="tabpanel"
                    aria-labelledby="headingCollapse5"
                    class="collapse">
                    <div class="card-content">
                        <div class="card-body">
                          <table class="table mb-5">
                                    <tbody id="trServicioSeccion' . $seccion->id . '">

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>';
                } else {
                }
            }

            if (request()->ajax()) {
                return response()->json([
                    'Tratamientos' => $Tratamientos,
                    'ContTratamientos' => $ContTratamientos,
                    'servTratamiento' => $servTratamiento,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function CargarPacientes()
    {
        if (Auth::check()) {
            $perPage = 10; // Número de posts por página
            $page = request()->get('page', 1);
            $search = request()->get('search');
            if (!is_numeric($page)) {
                $page = 1; // Establecer un valor predeterminado si no es numérico
            }

            $pacientes = DB::connection('mysql')
                ->table('pacientes')
                ->where('estado', 'ACTIVO');

            if ($search) {
                $pacientes->where(function ($query) use ($search) {
                    $query->where('identificacion', 'LIKE', '%' . $search . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $search . '%')
                        ->orWhere('apellido', 'LIKE', '%' . $search . '%');
                });
            }



            $ListPacientes = $pacientes->paginate($perPage, ['*'], 'page', $page);

            $tdTable = '';
            $x = ($page - 1) * $perPage + 1;

            foreach ($ListPacientes as $i => $item) {
                if (!is_null($item)) {
                    $conse = $i + 1;

                    $servTermi =  Servicios::buscSeccServPac($item->id);

                    $tdTable .= '<tr>
                <td>' . $conse . '</td>
                <td>
                    <a style="color:#009c9f; font-weight: bold" onclick="$.ver(' . $item->id . ');" >' . $item->identificacion . '</a>
                </td>
                <td><span class="invoice-amount" style="text-transform: capitalize;">' . $item->nombre . ' ' . $item->apellido . '</span></td>
                <td><span class="invoice-date">' . $item->telefono . '</span></td>';
                    if ($servTermi->count() > 0) {
                        $tdTable .= '<td><span class="badge badge-warning badge-pill">Pendiente</span></td>';
                    } else {
                        $tdTable .= '<td><span class="badge badge-success badge-pill">Ninguna</span></td>';
                    }

                    $tdTable .= '<td>
                    <div class="invoice-action">
                    <a onclick="$.ver(' . $item->id . ');"  title="Ver" class="invoice-action-view mr-1">
                    <i class="feather icon-eye"></i>
                    </a>
                    <a onclick="$.editar(' . $item->id . ');" title="Editar" class="invoice-action-edit cursor-pointer mr-1">
                        <i class="feather icon-edit-1"></i>
                    </a>
                    <a onclick="$.VerTratamientosList(' . $item->id . ');" title="Tratamientos" class="invoice-action-edit cursor-pointer">
                        <i class="feather icon-heart"></i>
                    </a>
                    </div>
                </td>
            </tr>';

                    $x++;
                }
            }

            $pagination = $ListPacientes->links('Pacientes.PaginacionPacientes')->render();

            return response()->json([
                'temas' => $tdTable,
                'links' => $pagination,
            ]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function Tratamientos()
    {
        $bandera = "";
        if (Auth::check()) {
            return view('Pacientes.GestionTratamientos', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function Recaudos()
    {
        $bandera = "";
        if (Auth::check()) {
            return view('Pacientes.GestionarRecaudos', compact('bandera'));
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function CargarMunicipios(Request $request)
    {
        if (Auth::check()) {

            $term = $request->input('q'); // Obtener el término de búsqueda

            // Consultar municipios desde la base de datos y filtrar por término de búsqueda
            $municipios = DB::connection('mysql')
                ->table('municipios')
                ->select('id_municipio AS id', 'municipio AS text')
                ->where('estado', '1')
                ->where('municipio', 'LIKE', '%' . $term . '%')
                ->get();

            // Formatear los resultados en un array
            $formattedMunicipios = [];
            foreach ($municipios as $municipio) {
                $formattedMunicipios[] = ['id' => $municipio->id, 'text' => $municipio->text];
            }
            return response()->json(['data' => $municipios]);
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarTratamiento()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idProfesional = $data['idTratamiento'];

            if ($data['accion'] == "agregar") {
                $respuesta = Tratamientos::guardar($data);
            } else {
                $respuesta = Tratamientos::editar($data);
            }

            $newTrata =  Tratamientos::TratamientosPacientesAct($respuesta->paciente);

            if (request()->ajax()) {
                return response()->json([
                    'newTrata' => $newTrata,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarSeccion()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idTrat = $data['idtrata'];

            if ($data['accion'] == "agregar") {
                $respuesta = Secciones::guardar($data, $idTrat);
                $itemTatra = ItemsTratamiento::guardar($respuesta->id, 'seccion', $idTrat);
            } else {
                $respuesta = Secciones::editarSeccion($data);
            }

            if (request()->ajax()) {
                return response()->json([
                    'seccion' => $respuesta
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarPagoTratamiento()
    {
        if (Auth::check()) {
            $data = request()->all();

            $transaccion = Tratamientos::guardarTransaccion($data);
            $mediPago = Tratamientos::guardarMediosPago($data, $transaccion);

            $pagoServ = Servicios::updateSaldoServicio($data);
            $valorTotal = $pagoServ['valorTotal'];
            $collectServTerm = $pagoServ['collectServTerm'];
            $collectServAfec = $pagoServ['collectServAfec'];

            foreach ($collectServTerm as $id) {
                $ServTerm = Servicios::guardarServTerm($id, $transaccion);
            }

            foreach ($collectServAfec as $item) {
                $servAfec = Tratamientos::guardarServAfectados($item['servicio'], $item['valorServicio'], $transaccion);
            }

            $updatetrata = Tratamientos::updateTrata($data['tratamientoSel'], $valorTotal);

            //consultas 
            $servTerminado = Servicios::ConultservTerminado($transaccion);
            $medioPago = Tratamientos::MediosPago($transaccion);
            $tratamiento = Tratamientos::busTatamientoRecaudo($data['tratamientoSel']);
            $transaccion = Tratamientos::buscTransaccion($transaccion);

            if (request()->ajax()) {
                return response()->json([
                    'servTerminado' => $servTerminado,
                    'medioPago' => $medioPago,
                    'tratamiento' => $tratamiento,
                    'transaccion' => $transaccion
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function CargarHistoricoTransacciones()
    {
        if (Auth::check()) {
            $transaccion = request()->get('idTransaccion');

            $servTerminado = Servicios::ConultservTerminado($transaccion);
            $medioPago = Tratamientos::MediosPago($transaccion);
            $transaccion = Tratamientos::buscTransaccion($transaccion);
            $tratamiento = Tratamientos::busTatamientoRecaudo($transaccion->tratamiento);

            if (request()->ajax()) {
                return response()->json([
                    'servTerminado' => $servTerminado,
                    'medioPago' => $medioPago,
                    'tratamiento' => $tratamiento,
                    'transaccion' => $transaccion
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarServicio()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idSecc = $data['idSecc'];
            $idTrata = $data['idTrata'];
            $idPac = $data['idPac'];

            if ($data['accion'] == "agregar") {
                $respuesta = Secciones::guardarServ($data, $idSecc, $idTrata, $idPac);
                if ($data["origServicio"] == "trata") {
                    $itemTatra = ItemsTratamiento::guardar($respuesta, 'trata', $idTrata);
                }
            } else {
                $respuesta = Secciones::editarServ($data);
            }

            $servSeccion = Secciones::buscServSecc($idSecc);

            $totServ = Secciones::busTotalSeccion($idSecc);
            $tratami = Tratamientos::editarEstado($idTrata);

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $respuesta,
                    'totServ' => $totServ,
                    'servSeccion' => $servSeccion,

                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }
    public function GuardarEvolucion()
    {
        if (Auth::check()) {
            $data = request()->all();

            $idSecc = $data['idSecc'];
            $idTrata = $data['idTrata'];
            $idPac = $data['idPac'];
            $idSer = $data['idSer'];

            if ($data['accion'] == "agregar") {
                $respuestaEvol = Evoluciones::guardar($data, $idSecc, $idTrata, $idPac, $idSer);
                $Evol = $respuestaEvol->id;
            } else {
                $respuestaEvol = Evoluciones::editar($data);
                $Evol = $respuestaEvol;
            }

            if (request()->has('repeater-list')) {
                $arc = [];
                $tip = [];
                $nom = [];
                $repeaterList = $data['repeater-list'];
                foreach ($repeaterList as $archivosEvo) {
                    if (isset($archivosEvo['archivo'])) {

                        $archivo = $archivosEvo['archivo'];
                        $nombreOriginal = $archivo->getClientOriginalName();
                        $tipoMime = $archivo->getClientMimeType();

                        // Realiza acciones con el archivo, como moverlo a una ubicación deseada
                        $prefijo = substr(md5(uniqid(rand())), 0, 6);
                        $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                        $archivo->move(public_path() . '/app-assets/evoluciones/', $nombreArchivo);
                        $arc[] = $nombreArchivo;
                        $tip[] = $tipoMime;
                        $nom[] = $nombreOriginal;
                        // Aquí puedes trabajar con los datos del archivo, como almacenarlos en una base de datos
                        $data['archivo'] = $arc;
                        $data['tipoArc'] = $tip;
                        $data['nombre'] = $nom;
                    }
                }
            }

            $updateServ = Secciones::updateServ($idSer, $data['pavance']);

            if (isset($data['archivo'])) {
                $evoArchivos = Evoluciones::guardarArcEvol($data, $Evol);
            }

            $servSeccion = Secciones::buscServSecc($idSecc);
            $totServ = Secciones::busTotalSeccion($idSecc);

            if (request()->ajax()) {
                return response()->json([
                    'servicios' => $Evol,
                    'totServ' => $totServ,
                    'servSeccion' => $servSeccion,

                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function GuardarPaciente()
    {
        if (Auth::check()) {
            $data = request()->all();
            $idPaciente = $data['idPaciente'];
            if ($data['accion'] == "agregar") {

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
                $idPaciente = $respuesta;
            } else if ($data['accion'] == "editar") {
                if (isset($data['fotoPaciente'])) {

                    $archivo = $data['fotoPaciente'];
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $tipoMime = $archivo->getClientMimeType();

                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $nombreArchivo = self::sanear_string($prefijo . '_' . $nombreOriginal);
                    $archivo->move(public_path() . '/app-assets/images/FotosPacientes/', $nombreArchivo);
                    $data['img'] = $nombreArchivo;
                } else {
                    $data['img'] = $data['fotoCargada'];
                }

                $respuesta = Pacientes::editar($data);
            }

            if ($respuesta) {
                $estado = "ok";
            } else {
                $estado = "fail";
            }

            if (request()->ajax()) {
                return response()->json([
                    'estado' => $estado,
                    'id' => $idPaciente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function BuscarPacientes()
    {
        if (Auth::check()) {
            $idPaciente = request()->get('idPac');
            $detaCita = Citas::buscaCitasPacientes($idPaciente);
            $paciente = Pacientes::BuscarPaciente($idPaciente);
            $tratamientos = Tratamientos::TratamientosPacientes($idPaciente);

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

    public function addCeros($numero, $cantidad_digitos)
    {
        $numero_con_ceros = str_pad($numero, $cantidad_digitos, '0', STR_PAD_LEFT);
        return $numero_con_ceros;
    }

    public function CargarPacientesCita()
    {
        if (Auth::check()) {
            $paciente = Pacientes::BuscarPacienteCita();

            if (request()->ajax()) {
                return response()->json([
                    'pacientes' => $paciente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function PacientesTratamientos(Request $request)
    {

        $term = $request->input('q'); // Obtener el término de búsqueda

        // Consultar municipios desde la base de datos y filtrar por término de búsqueda
        $pacientes = DB::connection('mysql')
            ->table('pacientes')
            ->select('id', DB::raw('CONCAT(nombre, " ", apellido) AS text'))
            ->where('estado', 'ACTIVO')
            ->where(function ($query) use ($term) {
                $query->where('nombre', 'LIKE', '%' . $term . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $term . '%')
                    ->orWhere('identificacion', 'LIKE', '%' . $term . '%');
            })
            ->get();


        // Formatear los resultados en un array
        $formattedPacientes = [];
        foreach ($pacientes as $pacient) {
            $formattedPacientes[] = ['id' => $pacient->id, 'text' => $pacient->text];
        }

        return response()->json(['data' => $pacientes]);
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
