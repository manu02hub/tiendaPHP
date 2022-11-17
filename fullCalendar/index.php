<html lang='en'>

<head>
    <meta charset='utf-8' />
    <link href='node_modules/fullcalendar/main.css' rel='stylesheet' />
    <!-- CSS only -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <script src='node_modules/fullcalendar/main.js'></script>
    <script src='node_modules/fullcalendar/locales/es.js'></script>

    <script src="node_modules/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>
</head>

<body>
    <div id='calendar'></div>

    <!-- Modal -->
    <div class="modal fade" id="modalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="tituloModal"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" method="post">
                        <input type="hidden" class="form-control" id="idEvento">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="tituloEvento" name="titulo">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Descripcion</label>
                            <input type="textarea" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechaInit" name="start">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" id="horaInit" value="00:00">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fechaEnd" name="end">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" id="horaEnd" value="00:00">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="guardar" value="edit">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" id="eliminar" value="delete">Eliminar</button>
                    <button type="button" class="btn btn-success" id="crear" value="save">Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            timeZone: 'Europe/Madrid',
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'

            },
            dateClick: function(info) {
                crearEvento();
                mostrarModal();
            },
            events: 'http://localhost/proyectosPHP/DAW2/1_desarrolloServidor/trimestre1/tienda/fullCalendar/eventosJSON.php',

            eventClick: function(info) {
                cogerEvento(info);
                mostrarModal();
            }

        });
        calendar.render();
    });

    function mostrarModal() {
        $("#modalEventos").modal('show');
    }


    function crearEvento() {
        $("#tituloModal").text("Nuevo Evento");
        $("#tituloEvento").val("");
        $("#descripcion").val("");
        $("#fechaInit").val("");
        $("#horaInit").val("");
        $("#fechaEnd").val("");
        $("#horaEnd").val("");
        $(".modal-footer button").eq(1).hide();
        $(".modal-footer button").eq(2).hide();
        $(".modal-footer button").eq(3).show();
    }

    function cogerEvento(info) {
        $("#tituloModal").text("Mi Evento");
        $("#tituloEvento").val(info.event.title);
        $("#descripcion").val(info.event.extendedProps.description);
        $("#fechaInit").val(info.event.startStr);
        $("#horaInit").val(info.event.start);
        $("#fechaEnd").val(info.event.endStr);
        $("#horaEnd").val(info.event.end);
        $(".modal-footer button").eq(3).hide();
        $(".modal-footer button").eq(1).show();
        $(".modal-footer button").eq(2).show();
    }

    // $(".modal-footer button").click(function() {
    //     let vbtn = $(this).val();
    //     let form = $("form");

    //     switch (vbtn) {
    //         case "save":
    //             // form.attr("action", "EventoController&action=save")
    //             <?php
    //             EventoController::save();
    //             ?>
    //             break;
    //         case "edit":
    //             // form.attr("action", "controller=users&action=edit")
    //             <?php
    //             EventoController::save();
    //             ?>
    //             break;
    //         case "delete":
    //             // form.attr("action", "controller=users&action=delete")
    //             <?php
    //             EventoController::save();
    //             ?>
    //             break;
    //     }
    // });
</script>

</html>