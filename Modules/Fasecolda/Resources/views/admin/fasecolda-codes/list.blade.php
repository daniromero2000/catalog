@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            @if($fasecolda_codes)
            <div class="row">
                <div class="col-4 col-sm-6 col-md-6 col-xl-4" style="text-align: end">
                    <h3 class="mb-0">{{ $module}} {{ $fasecolda_codes->Codigo }}</h3>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    <tr>
                        <td class="text-center">{{ $fasecolda_codes->Marca }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Clase }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Referencia1 }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Referencia2 }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Referencia3 }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Servicio }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Bcpp }}</td>

                        <td class="text-center">{{ $fasecolda_codes->Importado }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Potencia }}</td>
                        <td class="text-center">{{ $fasecolda_codes->TipoCaja }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Cilindraje }}</td>
                        <td class="text-center">{{ $fasecolda_codes->Nacionalidad }}</td>
                        <td class="text-center">{{ $fasecolda_codes->CapacidadPasajeros }}</td>
                        <td class="text-center">{{ $fasecolda_codes->CapacidadCarga }}</td>
                    </tr>
                <tbody>
            </table>
        </div>
        @if(!$fasecolda_codes->fasecoldaPrices->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col">Modelo </th>
                        <th class="text-center" scope="col">Valor </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fasecolda_codes->fasecoldaPrices as $data)
                    <tr>
                        <td class="text-center">{{ $data->Modelo }}</td>
                        <td class="text-center">${{ number_format($data->Valor *1000) }}</td>
                    </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
        @else
        <p class="info info-warning">No tiene Valores</a>
        </p>
        @endif
        @else
        <p class="info info-warning">Utiliza la option de filtrar para buscar por código</a>
        </p>
        @endif
    </div>
</section>
@endsection
