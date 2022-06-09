
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    (function(){
        Date.prototype.deltaDays=function(c){
            return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)
        };
        Date.prototype.getSunday=function(){
            return this.deltaDays(-1*this.getDay())
        }
    })();
    function Week(c){
        this.sunday=c.getSunday();
        this.nextWeek=function(){
            return new Week(this.sunday.deltaDays(7))
        };
        this.prevWeek=function(){
            return new Week(this.sunday.deltaDays(-7))
        };
        this.contains=function(b){
            return this.sunday.valueOf()===b.getSunday().valueOf()
        };
        this.getDates=function(){
            for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));
                return b
        }
    }
    function Month(c,b){
        this.year=c;
        this.month=b;
        this.nextMonth=function(){
            return new Month(c+Math.floor((b+1)/12),(b+1)%12)
        };
        this.prevMonth=function(){
            return new Month(c+Math.floor((b-1)/12),(b+11)%12)
        };
        this.getDateObject=function(a){
            return new Date(this.year,this.month,a)
        };
        this.getWeeks=function(){
            var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);
            for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);
                return c
        }
    };

    //getting the today's date
    let today = new Date();
    let todayMonth = today.getMonth();
    let todayYear = today.getFullYear();

    //Starts with the real time current month
    var currentMonth = new Month(todayYear, todayMonth);
    //tells whether user is logged
    var userLoggedIn = false;
    var userId = '';
    //check if user is logged in

    var one = 1;
    //input disabled days
    $("#eventDate").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d",
        "disable": [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6 || date.getDay() === one);  // disable weekends
            }
        ],
        "locale": {
            "firstDayOfWeek": 1 // set start day of week to Monday
        }
    });


    //input disabled hours
    user_id = <?php echo $id_user; ?>;
    $(document).ready(function() {
        let newtistart,newtifin;
        let start_time,finish_time;
        $.ajax({
            type:"POST",
            url:"/admin/schedulers/getWorkingHour/",
            data:{employee_id:user_id, _token: '{{csrf_token()}}'},
            success:function(resp){
                if(resp == ''){
                }else{
                    $.each(resp,function(key,value){
                        start_time = value['start_time'].slice(0, -3);
                        finish_time = value['finish_time'].slice(0, -3);
                        two_st = parseInt(start_time.substring(0,2));
                        two_ft = parseInt(finish_time.substring(0,2));
                        if(start_time.charAt(0) == 0){
                            newtistart = start_time.substring(1)+'am';
                        }
                        if(two_ft >= 12){
                            var fin_ft = parseInt(two_ft, 10);
                            var ope_ft = fin_ft - 12;
                            var three_st = start_time.substring(2)+'pm';
                            newtifin = ope_ft + three_st;
                        }
                    });
                    $('#eventTime').timepicker({
                        'disableTimeRanges': [['12:00am', newtistart], ['12:00pm', '2:00pm'],[newtifin,'11:59pm']],
                        'step': 15,
                    });
                }
            }
        })

    });


    //generates calendar table for the currentMonth
    generateMonth();
    //adds events to the calendar if a user is logged in and has events
    updateCalendar();

    //when next month button is pressed
    document.getElementById("nextBtn").addEventListener("click", function(event){
        currentMonth = currentMonth.nextMonth();
        //document.getElementById('calendarTable').innerHTML="<thead><tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednseday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr></thead>";
        generateMonth();
        updateCalendar();
    }, false);
    //when previous month button is pressed
    document.getElementById("prevBtn").addEventListener("click", function(event){
        currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
        //document.getElementById('calendarTable').innerHTML="<thead><tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednseday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr></thead>";
        generateMonth();
        updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
    }, false);

    //generates calendar table for the currentMonth
    function generateMonth(){
        let monthsArr = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        var weeks = currentMonth.getWeeks();
        document.getElementById('monthAndYear').innerHTML = monthsArr[currentMonth.month]+' '+currentMonth.year;
        document.getElementById('calendarTable').innerHTML="<thead><tr><th>Domingo</th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr></thead>";
            let i = 1;
            for(var w in weeks){
                var days = weeks[w].getDates();
                let tableRow = document.createElement("tr");
                tableRow.setAttribute('id','row'+i);
                i+=1;
                let week = document.getElementById('calendarTable').appendChild(tableRow);
                let nextMonthDays = document.createElement("th");
                for(var d in days){
                    if(currentMonth.month == days[d].getMonth()){
                        dayId = days[d].getDate()+'';
                        day = week.innerHTML+='<th class="day" id="'+dayId+'">'+ days[d].getDate()+'</th>';
                    }
                    else{
                        day = week.innerHTML+='<th class="otherDay">'+ monthsArr[days[d].getMonth()]+' '+days[d].getDate()+'</th>';
                    }
                }
            }
    }
    //addeds events if user is logged in
    function updateCalendar(){


        getEventsAjax(<?php echo $id_user; ?>);


        if(userLoggedIn){

            getEventsAjax(<?php echo $id_user; ?>);
        }

    }

    ///////////////////////////////////////////////////////////////////////////////
    //This section handles calendar events (ex: creating, fetching, editing, deleting)
    ///////////////////////////////////////////////////////////////////////////////


    //when create event button is pressed the create event input box will pop up on the screen
    document.getElementById('createEventBtn').addEventListener("click",function(event){
        document.getElementById('createEvent').hidden = false;
    });
    //when close button is clicked the create box will disappear
    document.getElementById('closeCreateBtn').addEventListener("click",function(event){
        document.getElementById('createEvent').hidden = true;
    });
    //check when create event form is submitted and run ajax function
    document.getElementById('createBtn').addEventListener("click", createEventAjax,false);

    //when delete event button is pressed
    document.getElementById('deleteEvent').addEventListener('click',deleteEventAjax,false);
    document.getElementById('editEventBtn').addEventListener('click',editEventPopUp,false);
    //edit fields when edit button is clicked
    document.getElementById('changeEvent').addEventListener('click',editEventAjax,false);

    function createEventAjax(event){
        const title = document.getElementById("eventTitle").value; // Get the username from the form
        const date = document.getElementById("eventDate").value; // Get the password from the form
        const time= document.getElementById("eventTime").value;
        // Make a URL-encoded string for passing POST data:

        const data = { 'title': title, 'date': date, 'time':time };
        if (time.indexOf('am') > -1){
            newString = time.replace('am', '');
            if(newString.length == 4){
                newString = 0+newString;
            }
        }else if(time.indexOf('pm') > -1){
            newString = time.replace('pm', '');
            if(newString.length == 4){
                var res = newString.charAt(0);
                var integer = parseInt(res, 10);
                integer = integer + 12;
                removechart = newString.substring(1);
                newString = integer+removechart;
            }
        }
        $.ajax({
            type:"POST",
            url:"/admin/schedulers/createEventHandler/",
            data:{employee_id:user_id,title:title,date:date,time:newString, _token: '{{csrf_token()}}'},
            success:function(res){
                if(res) {
                    location.reload();
                }
            }
        })
        .then(response => response.json())
        .then(data => data.success ? createEventDisplay() : alert(`Could not create event: ${data.message}`));
    }
    //hides create event box and empties inputs. Then updates caledndar with new event
    function createEventDisplay(){
        document.getElementById("eventTitle").value='';
        document.getElementById("eventDate").value='';
        document.getElementById("eventTime").value='';
        document.getElementById('createEvent').hidden = true;
        userLoggedIn = true;
        generateMonth();
        updateCalendar();
    }

    //gets events that have that user_id
    user_id = <?php echo $id_user; ?>;
    function getEventsAjax(user_id){
        $.ajax({
            type:"POST",
            url:"/admin/schedulers/getEventHandler/",
            data:{employee_id:user_id, _token: '{{csrf_token()}}'},
            success:function(events){
                getEventDetails(events)
            }
        })
    }
    //gets the event details
    function getEventDetails(events){
        events.forEach(event => {
            addEvent(event.title, event.date, event.time,event.id)
        });
    }

    //same as generate month except we add events to the month
    function addEvent(title, date, time,id){
        //split the event date by components and convert to int so we can make the nessecary comparisons further down
        let eventYear = Number(date.slice(0,4));
        let eventMonth = Number(date.slice(5,7));
        let eventDay = Number(date.slice(8,10));
        let eventHour = Number(time.slice(0,2));
        //convert the mysql time to 12-hour clock convention
        let oldTime = time;
        eventHour;
        let suffix = 'am ';
        if(eventHour>=12){
            eventHour = eventHour-12;
            suffix = 'pm '
        }
        if(eventHour==0){
            eventHour=12;
        }
        time = eventHour+time.slice(2,5)+suffix;
        let monthsArr = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        var weeks = currentMonth.getWeeks();
        document.getElementById('monthAndYear').innerHTML = monthsArr[currentMonth.month]+' '+currentMonth.year;
        for(var w in weeks){
            var days = weeks[w].getDates()
            //only shows events for the current month
            for(var d in days){
                if(currentMonth.month == days[d].getMonth()){
                    dayId = days[d].getDate()+'';
                    //check if event year, month and day matches
                    if(eventYear==days[d].getFullYear() && eventMonth==days[d].getMonth()+1 && eventDay==days[d].getDate()){
                        //html event_id is based on mysql id
                        eventId = 'event'+id;
                        day = document.getElementById(dayId);
                        //create div for event
                        let eventDiv = document.createElement("div");
                        eventDiv.setAttribute('id',eventId);
                        eventDiv.setAttribute('class','events');
                        //display title for event
                        let eventTitle = document.createElement('p');
                        eventTitle.appendChild(document.createTextNode(title));
                        eventTitle.setAttribute('class','events');
                        //display the time for event
                        let eventTime = document.createElement('small');
                        eventTime.appendChild(document.createTextNode(time));
                        eventTime.setAttribute('class','eventTime');
                        //let eventBr = document.createElement('br');
                        //save all of the event attributes in the div so we can access them when its clicked
                        eventDiv.time = time;
                        eventDiv.oldTime = oldTime;
                        eventDiv.title = title;
                        eventDiv.eventId = id;
                        eventDiv.date = date;
                        eventDiv.appendChild(eventTime);
                        eventDiv.appendChild(eventTitle);
                        //eventDiv.appendChild(eventBr);
                        day.appendChild(eventDiv);
                        //when div is click the event will pop up
                        document.getElementById(eventId).addEventListener("click",eventPopUp);
                    }
                }
            }

        }
    }
    //close event popup
    document.getElementById('closeEventBtn').addEventListener('click',closeEvent);

    //Pops up when event div that is displayed in calendar view is clicked
    function eventPopUp(event){
        let popUp = document.getElementById('eventPopUp');
        //attach all of the event details to the different buttons
        document.getElementById('deleteEvent').eventId = event.currentTarget.eventId;
        document.getElementById('changeEvent').eventId = event.currentTarget.eventId;
        document.getElementById('editEventBtn').eventId = event.currentTarget.eventId;
        document.getElementById('editEventBtn').title = event.currentTarget.title;
        document.getElementById('editEventBtn').date = event.currentTarget.date;
        document.getElementById('editEventBtn').time = event.currentTarget.oldTime;

        //empty the previous selected event details
        if(!popUp.hidden){
            document.getElementById('eventTextArea').innerHTML="";
            popUp.hidden=true;
        }
        //heading is the title of the event
        let heading = document.createElement('h3');
        heading.appendChild(document.createTextNode(event.currentTarget.title));
        heading.setAttribute('id','popHeading');
        //details contains the date and time of event
        let details = document.createElement('p');
        details.setAttribute('id','popDetails');
        details.appendChild(document.createTextNode(event.currentTarget.date));
        details.appendChild(document.createTextNode(' '+event.currentTarget.time));
        document.getElementById('eventTextArea').appendChild(heading);
        document.getElementById('eventTextArea').appendChild(details);
        //show the popup
        popUp.hidden = false;
    }
    //close the event popup and go back to page was before event was clicked
    function closeEvent(){
        document.getElementById('eventTextArea').style.display = 'block';
        document.getElementById('editEvent').hidden = true;
        document.getElementById('editEventBtn').style.display = 'inline-block';
        document.getElementById('deleteEvent').style.display = 'inline-block';
        document.getElementById('eventPopUp').hidden = true;
        document.getElementById('eventTextArea').innerHTML='';
    }
    //deletes the clicked event from mysql
    function deleteEventAjax(event){
        $.ajax({
            type:"POST",
            url:"/admin/schedulers/deleteEventHandler/",
            data:{id:event.currentTarget.eventId, _token: '{{csrf_token()}}'},
            success:function(events){
                if(events) {
                    location.reload();
                }else{
                }
            }
        })

    }
    //reloads calendar after deletion
    function deleteEventDisplay(){
        closeEvent();
        generateMonth();
        updateCalendar();
    }
    //pops up when edit button is clicked
    function editEventPopUp(event){
        var one = 1;
        //input disabled days
        $("#editDate").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d",
            "disable": [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6 || date.getDay() === one);  // disable weekends
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // set start day of week to Monday
            }
        });
        let newtistart,newtifin;
        let start_time,finish_time;
        $.ajax({
            type:"POST",
            url:"/admin/schedulers/getWorkingHour/",
            data:{employee_id:user_id, _token: '{{csrf_token()}}'},
            success:function(resp){
                if(resp == ''){
                }else{
                    $.each(resp,function(key,value){
                        start_time = value['start_time'].slice(0, -3);
                        finish_time = value['finish_time'].slice(0, -3);
                        two_st = parseInt(start_time.substring(0,2));
                        two_ft = parseInt(finish_time.substring(0,2));
                        if(start_time.charAt(0) == 0){
                            newtistart = start_time.substring(1)+'am';
                        }
                        if(two_ft >= 12){
                            var fin_ft = parseInt(two_ft, 10);
                            var ope_ft = fin_ft - 12;
                            var three_st = start_time.substring(2)+'pm';
                            newtifin = ope_ft + three_st;
                        }
                    });
                    $('#editTime').timepicker({
                        'disableTimeRanges': [['12:00am', newtistart], ['12:00pm', '2:00pm'],[newtifin,'11:59pm']],
                        'step': 15,
                    });
                }
            }
        })


        document.getElementById("editTitle").value= event.currentTarget.title; // Get the username from the form
        document.getElementById("editDate").value = event.currentTarget.date; // Get the password from the form
        document.getElementById("editTime").value = event.currentTarget.time;
        document.getElementById('eventTextArea').style.display = 'none';
        document.getElementById('editEvent').hidden = false;
        document.getElementById('editEventBtn').style.display = 'none';
        document.getElementById('deleteEvent').style.display = 'none';
    }

    //called when makes changes button is clicked
    function editEventAjax(event){
        const title = document.getElementById("editTitle").value; // Get the username from the form
        const date = document.getElementById("editDate").value; // Get the password from the form
        const time= document.getElementById("editTime").value;
        // Make a URL-encoded string for passing POST data:
        const data = { 'title': title, 'date': date, 'time':time, 'event_id':event.currentTarget.eventId };

        fetch("includes/editEventHandler.php", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => data.success ? editEventDisplay(data.message) : alert(`Could not edit event: ${data.message}`))
            .catch(err => console.error(err));
    }
    //reloads calendar after event is edited and clears neccessary fields
    function editEventDisplay(message){
        document.getElementById("editTitle").value='';
        document.getElementById("editDate").value='';
        document.getElementById("editTime").value='';
        document.getElementById('eventPopUp').hidden = true;
        document.getElementById('editEvent').hidden = true;
        document.getElementById('eventTextArea').style.display = 'block';
        document.getElementById('eventTextArea').innerHTML="";
        document.getElementById('editEventBtn').style.display = 'inline-block';
        document.getElementById('deleteEvent').style.display = 'inline-block';
        generateMonth();
        updateCalendar();
    }
</script>
