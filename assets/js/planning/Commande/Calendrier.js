document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        navLinks: false, 
        businessHours: true,
        editable: false,
        selectable: false,
        eventSources: [base_url + "planning/calendrier_non_plannifier",base_url + "planning/calendrier_plannifier"],
        dateClick: function(info) {
            let link = base_url +"planning/liste_commande?date_commande="+info.dateStr;
            window.location.replace(link);
        }
    });

    calendar.render();
});