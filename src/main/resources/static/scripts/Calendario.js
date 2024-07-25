document.addEventListener('DOMContentLoaded', function() {
    var calendarioEl = document.getElementById('calendario');

    var calendario = new FullCalendar.Calendar(calendarioEl, {
        height: 800,
        initialView: 'dayGridMonth',
        initialDate: '2023-04-17',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
            title: 'Evento de prueba',
            start: '2023-04-20T10:00:00',
            end: '2023-04-20T12:00:00',
            backgroundColor: '#007bff',
            borderColor: '#007bff'
            }
        ]
    });

    calendario.render();
});
