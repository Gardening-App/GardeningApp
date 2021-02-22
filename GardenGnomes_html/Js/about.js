document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
initialView: 'dayGridMonth',
initialDate: '2021-01-01',
headerToolbar: {
left: 'prev,next today',
center: 'title',
right: 'dayGridMonth,timeGridWeek,timeGridDay'
},
events: [
  {
    title: 'example',
  start: '2021-02-21' 
  },
 


]
});

calendar.render();
});