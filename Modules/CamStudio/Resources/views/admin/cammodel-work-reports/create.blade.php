@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="col-6 pl-0 mb-3">
                    <h2 class="ml-4">Selecciona un Room para asignar a la Modelo</h2>
                </div>
                <div class="col-6">
                    <div class="form-group d-flex align-items-center">
                        <label class="mt-2 mr-2" for="subsidiary_selector">Sede: </label>
                        <select class="form-control form-control-sm" id="subsidiary_selector"
                            onchange="subsidiary_selection()">
                            <option value="0">Todas las Sedes</option>
                            <option value="1">Lefemme Studio Principal</option>
                            <option value="2">Lefemme Studio Lago</option>
                            <option value="3">Lefemme Studio Santa Mónica</option>
                            <option value="4">Lefemme Studio Manizales</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="room_cards">
                @foreach ($rooms as $room)
                <div class="col-xl-2 col-lg-3">
                    <div class="card mx-0 px-0">
                        <button type="button" onclick="room_selection({{ $room->id }})" class="btn mx-0 pt-4">
                            <span style="color: #AF6AA4"><i id="icon_{{ $room->id }}"
                                    class="fas fa-door-closed fa-6x"></i></span>
                            <div class="card-body text-center p-0 pt-2">
                                <h5 class="card-title m-0">{{ $room->name }}</h5>
                                <span class="h5 card-text p-0">{{ $room->subsidiary->name }}</span>
                            </div>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @foreach ($rooms as $room)
                @include('camstudio::admin.layouts.cammodel-work-reports.add_work_report_modal')
            @endforeach
            @if ($rooms->isEmpty())
            <p class="alert alert-warning">No hay Rooms disponibles.
            </p>
            @endif
        </div>
    </div>
</section>
@include('generals::layouts.admin.buttons.disable_button')
<script>
    var rooms_object = JSON.parse('<?php echo json_encode($rooms)?>');
    rooms = Object.values(rooms_object);
</script>
@include('generals::layouts.utilities')
@endsection
