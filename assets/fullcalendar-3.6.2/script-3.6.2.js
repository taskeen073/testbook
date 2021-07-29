$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',  //  prevYear nextYea
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
        },  
        buttonIcons:{
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'         
        },       
 eventClick:  function(event, jsEvent, view) {
	 const thaiyearstart = event.start.add(543, 'years');
	 const thaiyearend = event.end.add(543, 'years');
	    $('#modalTitle').html( '<style>table, td, th { border: 1px solid #ddd; text-align: left; } table { border-collapse: collapse; width: 100%; } th, td { text-align: left; padding: 5px; } </style><table><tr><th> สังกัด</th><td>' + event.division +'</td></tr><tr><th>ผู้จอง</th><td> ' + event.member +   '</td></tr><tr><th>ห้องประชุม</th><td> ' + event.rooms +'</td></tr><tr><th>กิจกรรม</th><td> ' + event.title + '</td></tr><tr><th>จำนวน (คน)</th><td>' + event.people + '</td></tr><tr><th>เริ่มเวลา</th><td>'+ thaiyearstart.format("DD MMM YYYY HH:mm") + '</td></tr><tr><th>สิ้นสุดเวลา</th><td>' + thaiyearend.format("DD MMM YYYY HH:mm") + '</td></tr><tr><th>จัดโต๊ะ</th><td>' + event.style + '</td></tr><tr><th>อุปกรณ์</th><td>' + event.equipment +  '</td></tr><tr><th>อื่นๆ</th><td><pre style="padding: 0px;border: 0px;background-color: transparent !important;">' + event.etc +'</pre></td></tr></table>');
                    $('#fullCalModal').modal();
                    return false;
                },
        eventLimit:true,
        lang: 'th',
    
        eventRender: function(event, element) {
      $(element).tooltip({title: event.title});      
  },
        events: {
            url: 'assets/fullcalendar-3.6.2/data_events-3.6.2.php',
            error: function() {
            }
        }    
     
    });
  
});
