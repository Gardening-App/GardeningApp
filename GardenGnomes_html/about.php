<?php
	session_start();

?>

<html>
<head>


    <link rel="stylesheet" href="css/about.css">
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Slab&family=Yellowtail&display=swap" rel="stylesheet">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


  <title>About page</title>
</head>


<div class="page-container">
<div class="content-wrapper">
<body>

    <?php
        include("css/header.php"); 
     ?> 

<          <figure class=figurePic>
                <p><img class=scaled src="images/shop.jpeg" alt="Shop">
                <figcaption>Shop out store</figcaption>
            </figure>

            <figure class=figurePic>
                <p><img class=scaled src="images/grid.jpeg" alt="Plan Garden">
                <figcaption>Plan your garden</figcaption>
            </figure>

            <figure class=figurePic>
                <p><img class=scaled src="images/blog.jpeg" alt="Social Page">
                <figcaption>View our social page</figcaption>
            </figure>

            <div id="welcomeText">
                <p id="welcome">
                    Do you ever get frustrated planning the layout of your garden and you can't remember what you have planted and where?
                    Thats why we created Garden Gnomes. A community for gardening enthusiasts to plan and track their gardens. If you are
                    new to gardening this is also a great place to learn and be social to see what other users are doing.
                </p>

                <p id="welcome2">
                    Check out our fun and easy to use<a href="layout.html"> layout </a> feature to keep track of your garden.
                    This feature allows you to pick what fruit you are going to plant and place it so you can see how it will align with
                    your current set up.
                </p>
            </div>
<br><br><br><br><br>

<?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
{
 ?>
<script>
$(document).ready(function() {
  var calendar = $('#calendar').fullCalendar({
   editable:true,
   header:{
    left:'prev,next today',
    center:'title',
    right:'month,agendaWeek,agendaDay'
   },
   events: 'load.php',
   selectable:true,
   selectHelper:true,
   select: function(start, end, allDay)
   {
    var title = prompt("Enter Event Title");
    if(title)
    {
     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
     $.ajax({
      url:"insert.php",
      type:"POST",
      data:{title:title, start:start, end:end},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Added Successfully");
              }
            })
          }
        },
        editable:true,
        eventResize: function(event)
        {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

          var title= event.title;
          var id = event.id;

          $.ajax ({
            url: "update.php",
            type:  "POST",
            data:{title:title, start:start, end:end, id:id},

            success:function(){
              calendar.fullCalendar('refetchEvents');
              alert('Event Update');
            }
          })
        },

        eventDrop:function(event) 
        
        {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          $.ajax({
           url:"update.php",
           type:"POST",
           data:{title:title, start:start, end:end, id:id},
           success:function()
           {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
           }
          });
         },

         eventClick:function(event)
         {
          if(confirm("Are you sure you want to remove this?"))
          {
            var id = event.id;
            $.ajax({
              url:"delete.php",
              type:"POST",
              data:{id:id},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                alert("Calendar Event Removed");
              }
            })

          }
         },



  });

});</script>
<?php } else { ?>
<p>Please log in to take advantage of our calendar!</p>
<?php
} 
?>

<div id='calendar'></div>
<br>
</div>

<?php

    include("css/footer.php"); 
?> 
</div>
</body>
</html>
