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
    title: 'Bean Day',
  start: '2021-01-06' 
  },
  {
    title: 'Houseplant Appreciation Day',
  start: '2021-01-10' 
  },
  {
    title: 'National Seed Swap Day',
  start: '2021-01-' 
  },
 
  
  {
    title: 'Peach Blossom Day',
  start: '2021-03-03' 
  },
  {
    title: 'Johnny AppleSeed Day',
  start: '2021-03-11' 
  },
  {
    title: 'Plant a Flower Day',
  start: '2021-03-12' 
  },
  {
    title: 'Pecan Day',
  start: '2021-03-25' 
  },


]
});

calendar.render();
});
