@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<style>
    .circular-image {
        display: inline-block;
        overflow: hidden;
        border-radius: 50%;
        max-width: 150px;
        max-height: 150px;
    }
</style>
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="col pl-0 mb-3">
                <h2>Gestión de turnos Modelos</h2>
            </div>
            @if ($cammodelWorkReports->isNotEmpty())
            <div class="row">
                @foreach ($cammodelWorkReports as $cammodelWorkReport)
                <div class="col-xl-2 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-90">
                        <button class="btn p-0 mr-0 h-100" type="button" @if ($cammodelWorkReport->connection_time ==
                            null)
                            title="Pendiente de hora de conexión"
                            @else
                            title="Disponible para registro de ventas"
                            @endif
                            data-toggle="modal" data-target="#modal{{ $cammodelWorkReport->cammodel->id }}">
                            <span class="h5">{{ $cammodelWorkReport->cammodel->nickname }}
                                @if ($cammodelWorkReport->connection_time == null)
                                <i class="fas fa-clock fa-lg text-warning"></i>
                                @else
                                <i class="far fa-money-bill-alt fa-lg text-success"></i>
                                @endif
                            </span>
                            <div class="card-header p-0 text-center" style="overflow: hidden">
                                <div class="circular-image text-center">
                                    @if ($cammodelWorkReport->cammodel->employeeName->avatar != "No Avatar")
                                    <img src="{{ asset("storage/".$cammodelWorkReport->cammodel->employeeName->avatar) }}"
                                        style="max-width: 100%; max-height: 300px;"
                                        id="photo_{{$cammodelWorkReport->cammodel->id}}"
                                        alt="{{$cammodelWorkReport->cammodel->nickname}}">
                                    @else
                                    <img src="https://cdn.pixabay.com/photo/2014/04/02/14/10/female-306407__340.png"
                                        style="max-width: 100%; max-height: 300px;"
                                        id="photo_{{$cammodelWorkReport->cammodel->id}}"
                                        alt="{{$cammodelWorkReport->cammodel->nickname}}">
                                    @endif
                                </div>
                            </div>
                            <div class="card-body text-center my-0 p-0 pt-2 px-2">
                                <span class="h5">{{ $cammodelWorkReport->room->name }}
                                    - {{ $cammodelWorkReport->room->subsidiary->name }}</span>
                            </div>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn p-0 w-33">
                                <a href="{{ route("admin.cammodels.show", $cammodelWorkReport->cammodel->id) }}"
                                    type="button" class="btn-secondary w-100"><i class="fas fa-user-circle"></i></a>
                            </button>
                            <button type="button" class="btn p-0 w-33">
                                <a href="{{ route("admin.cammodel-stats.show", $cammodelWorkReport->cammodel->id) }}"
                                    type="button" class="btn-secondary w-100"><i class="fas fa-signal"></i></a>
                            </button>
                            <button type="button" class="btn p-0 w-33">
                                <a data-toggle="modal"
                                    data-target="#commentModal{{ $cammodelWorkReport->id }}"
                                    type="button" class="btn-secondary w-100"><i class="fas fa-comments"></i></a>
                            </button>
                        </div>
                        <button type="button" class="btn p-0 mr-0" data-toggle="modal"
                            data-target="#tipperModal{{ $cammodelWorkReport->cammodel->id }}">
                            <div class="bg-success p-0 m-0  text-center">
                                <span class="h5 text-white font-weight-bold"> Agregar Tipper
                                    <i class="fas fa-dollar-sign"></i></span>
                            </div>
                        </button>
                        <button type="button" class="btn p-0 mr-0" data-toggle="modal"
                            data-target="#fineModal{{ $cammodelWorkReport->cammodel->id }}">
                            <div class="card-footer bg-warning p-0 m-0  text-center">
                                <span class="h5 text-white font-weight-bold"> Aplicar multa
                                    <i class="fab fa-creative-commons-nc"></i></span>
                            </div>
                        </button>
                    </div>
                </div>
                @include('camstudio::admin.layouts.cammodel-streaming-incomes.add_cammodel_fine_modal')
                @include('camstudio::admin.layouts.cammodel-streaming-incomes.add_cammodel_tipper_modal')
                @if ($cammodelWorkReport->connection_time == null)
                @include('camstudio::admin.layouts.cammodel-streaming-incomes.edit_work_report_connection')
                @else
                @include('camstudio::admin.layouts.cammodel-streaming-incomes.add_streaming_income_modal')
                @endif
                @include('camstudio::admin.layouts.cammodel-work-report-commentaries.add_comment_modal')
                @endforeach
            </div>
            @else
            <p class="alert alert-warning">No hay turnos reportados. <a
                    href="{{ route("admin.cammodel-work-reports.create") }}">Crear uno</a>
            </p>
            @endif
        </div>
    </div>
</section>
@include('generals::layouts.admin.buttons.disable_button')
@endsection
