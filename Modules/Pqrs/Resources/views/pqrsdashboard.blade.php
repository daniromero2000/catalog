@extends('generals::layouts.admin.app')
@section('title', 'Dashboard Pqrs')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-header with-border">
            <h1 class="box-title"><strong>Panel PQRS</strong></h1>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus">
                        <!-- --></i><!-- --></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                    title="Remove">
                    <i class="fa fa-times">
                        <!-- --></i><!-- --></button>
            </div>
        </div>
        <div class="box-body">
            <p>¡Hola <strong>{{ $user->name }}</strong>! <br>Bienvenido al CRM Pqrs.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 d-flex align-items-center d-flex justify-content-center">
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h5 class="m-b-20"><strong>PQRS</strong></h5>
                                <h2 class="text-right"><i
                                        class="fas fa-headset f-left"></i><span>{{ $pqrGlobalCount }}</span></h2>
                                <a href="{{ route('admin.pqrs.index') }}"><span
                                        class="label label-default pull-right">Ver más</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <section>
        <div class="row">
            <div class="col-md-12">
                <h1 class=""><strong>CRM PQRS</strong>
                </h1>
            </div>
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h2>{{ ($listLeadCount) }}</h2>
                        <p class="m-b-20"><strong>PQRS ABIERTOS</strong></p>
                    </div>
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ver más</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body bg-black-gradient" style="display: none;">
                            @if(!Empty($pqrLeads))
                            <table class="table-striped table">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Fecha</th>
                                        <th class="text-center" scope="col">Código</th>
                                        <th class="text-center" scope="col">Pqrs</th>
                                        <th class="text-center" scope="col">Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pqrLeads as $pqrLead)
                                    <tr>
                                        <td class="text-center">
                                            {{ date('M d, Y h:i a', strtotime($pqrLead->created_at)) }}</td>
                                        <td class="text-center">{{ $pqrLead->id }}</td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('admin.pqrs.show', $pqrLead->id) }}">{{ $pqrLead->pqr }}</a>
                                        </td>
                                        <td class="text-center">{{ $pqrLead->phone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="alert">No hay datos.</a>
                            </p>
                            @endif
                        </div>

                    </div>
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h2>{{ ($listTramiteCount) }}</h2>
                        <p class="m-b-20"><strong>PQRS EN TRÁMITE</strong></p>
                    </div>
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ver más</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body bg-black-gradient" style="display: none;">
                            @if(!Empty($pqrTramites))
                            <table class="table-striped table">
                               @include('generals::layouts.admin.tables.table-headers')
                                <tbody>
                                    @foreach ($pqrTramites as $pqrTramite)
                                    <tr>
                                        <td class="text-center">{{ $pqrTramite->id }}</td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('admin.pqrs.show', $pqrTramite->id) }}">{{ $pqrTramite->pqr }}</a>
                                        </td>
                                        <td class="text-center">{{ $pqrTramite->name }}</td>
                                        <td class="text-center">{{ $pqrTramite->phone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="alert">No hay datos.</a>
                            </p>
                            @endif
                        </div>

                    </div>
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h2>{{ ($listTramitePendienteInfo) }}</h2>
                        <p class="m-b-20"><strong>EN TRÁMITE PENDIENTE INFORMACIÓN TERCERO</strong></p>
                    </div>
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ver más</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body bg-black-gradient" style="display: none;">
                            @if(!Empty($pqrTramitePendienteInfos))
                            <table class="table-striped table">
                               @include('generals::layouts.admin.tables.table-headers')
                                <tbody>
                                    @foreach ($pqrTramitePendienteInfos as $pqrTramitePendienteInfo)
                                    <tr>
                                        <td class="text-center">{{ $pqrTramitePendienteInfo->id }}</td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('admin.pqrs.show', $pqrTramitePendienteInfo->id) }}">{{ $pqrTramitePendienteInfo->pqr }}</a>
                                        </td>
                                        <td class="text-center">{{ $pqrTramitePendienteInfo->name }}</td>
                                        <td class="text-center">{{ $pqrTramitePendienteInfo->phone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="alert">No hay datos.</a>
                            </p>
                            @endif
                        </div>

                    </div>
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h2>{{ ($listAtendidoCount) }}</h2>
                        <p class="m-b-20"><strong>PQRS ATENDIDOS</strong></p>
                    </div>
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ver más</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body bg-black-gradient" style="display: none;">
                            @if(!Empty($pqrAtendidos))
                            <table class="table-striped table">
                              @include('generals::layouts.admin.tables.table-headers')
                                <tbody>
                                    @foreach ($pqrAtendidos as $pqrAtendido)
                                    <tr>
                                        <td class="text-center">{{ $pqrAtendido->id }}</td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('admin.pqrs.show', $pqrAtendido->id) }}">{{ $pqrAtendido->pqr }}</a>
                                        </td>
                                        <td class="text-center">{{ $pqrAtendido->name }}</td>
                                        <td class="text-center">{{ $pqrAtendido->phone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="alert">No hay datos.</a>
                            </p>
                            @endif
                        </div>

                    </div>
                    <div class="icon">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection
