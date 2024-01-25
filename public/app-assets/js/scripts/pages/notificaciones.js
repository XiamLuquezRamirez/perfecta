$(document).ready(function () {
          // Función para cargar y actualizar la información del servicio terminado
          function cargarServicioTerminado() {
            var form = $("#formServTerminados");
            var url = form.attr("action");

            let pacientes = "";

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // Corregir la referencia a 'datos' aquí
                async: false,
                dataType: "json",
                success: function (response) {
                    $("#cantNotificaPaciente").html(response.cantserv);
                    $("#cantNotificaPaciente2").html(response.cantserv+ ' Nueva(s)');

                $.each(response.servicio, function (i, item) {
                    let npaciente = item.nombre +' ' + item.apellido;
                    pacientes+='<a href="javascript:verNotifiPaci('+item.id+')">'
                    +'<div class="media">'
                    +'    <div class="media-left align-self-center"><i class="feather icon-user-check icon-bg-circle bg-cyan"></i></div>'
                    +'    <div class="media-body">'
                    +'        <h6 style="text-transform: capitalize;" class="media-heading" id="nPAcienteNotif">Servicio Terminado: '+npaciente+'</h6>'
                    +'        <p class="notification-text font-small-3 text-muted">Revisar Recaudo</p>'
                    +'    </div>'
                    +'</div>'
                    +'</a>'
                });

                $("#listNotof").html(pacientes);


                },
                error: function (error) {
                    // Manejar errores si los hay
                    console.error(error);
                }
            });
        }

        // Cargar la información del servicio terminado al cargar la página
        cargarServicioTerminado();

        // Actualizar la información cada 5 segundos (puedes ajustar el intervalo según tus necesidades)
        setInterval(function () {
            cargarServicioTerminado();
        }, 5000); // 5000 milisegundos = 5 segundos

})