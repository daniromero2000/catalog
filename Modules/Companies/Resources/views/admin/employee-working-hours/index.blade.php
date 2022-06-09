@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if(!$working_hours->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">{{ $module}}</h3>
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
        </div>
        <link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' />

        <div id='calendar'> </div>
    </div>
    @endif
</section>
@endsection

<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
<script>
    jq13 = jQuery.noConflict(true);
</script>
<script>
    jq13(document).ready(function() {
            // page is now ready, initialize the calendar...
            jq13('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',

                events : [
                    @foreach($working_hours as $hour)
                    {
                        title : '{{ $hour->employee->name . ' ' . $hour->employee->last_name }}',
                        start : '{{ $hour->date . ' ' . $hour->start_time }}',
                        end : '{{ $hour->date . ' ' . $hour->finish_time }}',
                    },
                    @endforeach
                ]
            })
        });
</script>
