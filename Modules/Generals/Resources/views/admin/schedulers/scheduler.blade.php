@extends('generals::layouts.admin.app')
@section('styles')
    <style>
        body{
            text-align: center;
            background-color: rgb(248, 248, 248);
            width: 100%;
        }
        #monthAndYear{
            font-size: 40px;
        }
        table{
            width: 84%;
            margin: 0 auto;
        }

        th, td{
            width: 12%;
            border: 1px solid black;
        }
        tr{
            height: 100px;
            border: 1px solid black;
        }
        thead tr{
            height: 30px;
        }
        .otherDay{
            font-weight: 100;
            font-style: italic;
        }
        #loginSignup{
            display: inline-block;
        }
        #loginSignup button{
            padding: 5px 18px;
        }
        #createEvent{
            border: 1px solid black;
            width: fit-content;
            padding: 10px;
            border-radius: 10px;
            position: fixed;
            left: 20%;
            top: 20%;
            background-color: white;
            z-index: 100;
        }
        #closeCreateBtn{
            float: right;
            background-color: red;
            border-radius: 5px;
            border: 1px solid rgb(99, 99, 99);
            /* font-size: 13px; */
            padding: 5px 10px;
            margin-top: 10px;
        }
        #closeEventBtn{
            float: right;
            background-color: red;
            border-radius: 5px;
            border: 1px solid rgb(99, 99, 99);
            padding: 5px 10px;

        }
        .createEl{
            margin: 20px;
        }
        .events{
            cursor: pointer;
        }
        .events:hover{
            background-color: rgb(240, 240, 240);
        }
        .eventTime{
            display: inline;
            font-style: italic;
            color: gray;
        }
        .eventTitle{
            display: inline;
            color: blue;
        }
        #eventPopUp{
            height: 38%;
            width: 24%;
            position: absolute;
            left: 30%;
            top: 20%;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            z-index: 100;
            color: black;
            padding: 20px;
        }
        #popHeading{
            font-size: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
            margin-top: 10px;
            padding-bottom: 30px;
            margin-bottom: 0px;
        }
        #popDetails{
            margin-top: 0px;
            padding-right: 30px;
            padding-left: 30px;
            padding-top: 10px;
            padding-bottom: 40px;
        }
        #deleteEvent{
            float: right;
        }
        #calendarTable{
            /* display: inline-block; */
        }
        #prevBtn, #nextBtn{
            border-radius: 20px;
            font-size: 20px;
            background-color: blue;
        }
        #createEventBtn{
            margin-left: 10%;
            margin-right: 10%;
        }
        button {
            background-color: blue;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        h2{
            display: inline-block;
        }
        input{
            height: 25px;
            border: 1px solid rgba(0, 0, 17, 0.363);
        }
        .editEl{
            margin: 5px;
        }
        #editTime{
            margin-bottom: 10px;
        }
        .events{
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <h1 id="monthAndYear"></h1>
    <button id="prevBtn"><i class="fas fa-arrow-left"></i></button>
    <button id="createEventBtn">Crear Evento</button>
    <button id="nextBtn"><i class="fas fa-arrow-right"></i></button>
    <br>
    <br>
    <!-- Table for the initial calendar, in javascript a new table is create when a new month is loaded -->
    <table id="calendarTable">
    </table>
    <div id="createEvent" hidden>
        <button id="closeCreateBtn">&#10006</button>
        <h3>Crear Nuevo Evento</h3>
        <label for="eventTitle">Titulo: </label>

        <input type="text" class="createEl" name="eventTitle" id="eventTitle" placeholder="Title..." required><br>
        <label for="eventDate">Día: </label>
        <!--<input type="date" class="createEl" name="eventDate" id="eventDate">-->
        <input id="eventDate" class="createEl" name="eventDate" placeholder="MM/DD/YYYY" data-input required><br>
        <label for="eventTime">Hora: </label>
        <!--<input type="time" min="08:00" max="18:00" class="createEl" name="eventTime" id="eventTime" /><br>-->
        <input type="text" id="eventTime" value="13:30" name="eventTime" class="createEl" required><br>
        <button id="createBtn">Crear</button>
        <!--<div id="ui-timepicker-div" class="ui-timepicker ui-widget ui-helper-clearfix ui-corner-all " style="display: none;"><table class="table-striped ui-timepicker-table ui-widget-content ui-corner-all"><tbody><tr><td class="ui-timepicker-hours"><div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">Hour</div><table class="table-striped ui-timepicker"><tbody><tr><th rowspan="2" class="periods" scope="row">AM</th><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="0"><a class="ui-state-default ">00</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="1"><a class="ui-state-default ">01</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="2"><a class="ui-state-default ">02</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="3"><a class="ui-state-default ">03</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="4"><a class="ui-state-default ">04</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="5"><a class="ui-state-default ">05</a></td></tr><tr><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="6"><a class="ui-state-default ">06</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="7"><a class="ui-state-default ">07</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="8"><a class="ui-state-default ">08</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="9"><a class="ui-state-default ">09</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="10"><a class="ui-state-default ">10</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="11"><a class="ui-state-default ">11</a></td></tr><tr><th rowspan="2" class="periods" scope="row">PM</th><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="12"><a class="ui-state-default ">12</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="13"><a class="ui-state-default ui-state-active">13</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="14"><a class="ui-state-default ">14</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="15"><a class="ui-state-default ">15</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="16"><a class="ui-state-default ">16</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="17"><a class="ui-state-default ">17</a></td></tr><tr><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="18"><a class="ui-state-default ">18</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="19"><a class="ui-state-default ">19</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="20"><a class="ui-state-default ">20</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="21"><a class="ui-state-default ">21</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="22"><a class="ui-state-default ">22</a></td><td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker_3" data-hour="23"><a class="ui-state-default ">23</a></td></tr></tbody></table></td><td class="ui-timepicker-minutes"><div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">Minute</div><table class="table-striped ui-timepicker"><tbody><tr><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="0"><a class="ui-state-default ">00</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="5"><a class="ui-state-default ">05</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="10"><a class="ui-state-default ">10</a></td></tr><tr><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="15"><a class="ui-state-default ">15</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="20"><a class="ui-state-default ">20</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="25"><a class="ui-state-default ">25</a></td></tr><tr><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="30"><a class="ui-state-default ui-state-active">30</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="35"><a class="ui-state-default ">35</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="40"><a class="ui-state-default ">40</a></td></tr><tr><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="45"><a class="ui-state-default ">45</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="50"><a class="ui-state-default ">50</a></td><td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker_3" data-minute="55"><a class="ui-state-default ">55</a></td></tr></tbody></table></td></tr></tbody></table></div>-->
    </div>

    <div id='eventPopUp' hidden>
        <button id="closeEventBtn">&#10006</button>
        <div id="eventTextArea">

        </div>
        <div id="editEvent" hidden>
            <h3>Editar Cita</h3>
            <label for="editTitle">Titulo: </label>
            <input type="text" class="editEl" name="editTitle" id="editTitle"><br>
            <label for="eventDate">Fecha: </label>
            <input type="date" class="editEl" name="editDate" id="editDate" data-input><br>
            <label for="eventTime">Hora: </label>
            <input type="time" class="editEl" name="editTime" id="editTime"><br>
            <button id="changeEvent">Guardar Cambios</button>
        </div>
        <button id="editEventBtn">Editar</button>
        <button id="deleteEvent">Eliminar</button>
    </div>
</section>
@section('scripts')
    @include('generals::admin.schedulers.settings')
@endsection
@endsection

