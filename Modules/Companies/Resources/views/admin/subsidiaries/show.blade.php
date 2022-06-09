@extends('generals::layouts.admin.app')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.subsidiaries.index') }}">Sucursales</a><span class="divider"></span>
                <li class="breadactive">{{$subsidiary->name}}</li>
            </ol>
        </div>
    </div>
    @if($subsidiary)
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $subsidiary->name }} {{ $subsidiary->city->name }}</h2>
            <table class="table-striped table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Dirección</th>
                        <th class="text-center" scope="col">Teléfono</th>
                        <th class="text-center" scope="col">Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $subsidiary->address }}</td>
                        <td class="text-center">{{ $subsidiary->phone }}</td>
                        <td class="text-center">{{ $subsidiary->opening_hours }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>

    @endif

</section>

@endsection