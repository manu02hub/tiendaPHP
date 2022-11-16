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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>

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
</body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="tituloEvento"></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="descripcionEvento"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Modificar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'

            }, eventSources: [{
                events: [
                    {
                        title: 'All Day Event',
                        description: 'Siuuuuu',
                        start: '2022-11-01',
                        color: "black",
                        textColor: "yellow", 
                        extendedProps: {
                            description: 'Siuuuuu',
                        }

                    },
                    {
                        title: 'Long Event',
                        start: '2022-11-07',
                        end: '2022-11-10'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2022-11-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2022-11-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2022-11-11',
                        end: '2022-11-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2022-11-12T10:30:00',
                        end: '2022-11-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2022-11-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2022-11-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2022-11-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2022-11-28'
                    }
                ]
            }],
            eventClick: function (info) {


                $("#exampleModal").modal('show');
                $("#tituloEvento").text(info.event.title);
                $("#descripcionEvento").text(info.event.extendedProps.description);
                console.log($("#descripcionEvento").text());


                // alert('Date: ' + info.dateStr);
                // alert('Clicked on: ' + info.dateStr);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('Current view: ' + info.view.type);
                // // change the day's background color just for fun
                //  info.dayEl.style.backgroundColor = 'red';

                // var dateStrInit = info.dateStr;
                // var dateStrFin = prompt('Enter a date in YYYY-MM-DD format');
                // // var date = new Date(dateStrInit + 'T00:00:00'); // will be in local time
                // var date = new Date(dateStrInit); // will be in local time
                // var date2 = new Date(dateStrFin); // will be in local time

                // if (!isNaN(date.valueOf())) { // valid?
                //     calendar.addEvent({
                //         title: 'dynamic event',
                //         start: date,
                //         end: date2
                //     });
                //     alert('Great. Now, update your database...');
                // } else {
                //     alert('Invalid date.');
                // }

            }

            // eventClick: function (info) {

            //     $("#tituloEvento").text(info.event.title);
            //     $("#descripcionEvento").html(info.event.descripcion);
            // }

        });

        calendar.render();
    });

    // dateClick: function() {
    //     alert('a day has been clicked!');
    // }


</script>

</html>