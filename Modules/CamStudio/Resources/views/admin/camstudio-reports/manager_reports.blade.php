@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.no_link_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-12 text-left">
                    <span class="h3 mb-0 px-4"> Progreso de Ventas </span>
                    <span>{{ 'desde: '.$liquidation_period['0'].', hasta: '.$liquidation_period['1'] }} </span>
                    
                    @include('generals::layouts.searchFortnights', ['route' => route($optionsRoutes . '.manager')])
                </div>
            </div>
        </div>
        @if($managersLiquidations->isNotEmpty())
        <div class="table bg-white">
            <table class="table table-striped align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th onclick="sortTable(0)" class="text-center">{{ $headers[0] }}</th>
                        <th onclick="sortTable(1)" class="text-center">{{ $headers[1] }}</th>
                        <th class="text-center">{{ $headers[2] }}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($managersLiquidations as $key => $managerLiquidations)
                    <tr>
                        <td>
                            {{ $managerLiquidations['manager']->name.' '.$managerLiquidations['manager']->last_name }}
                        </td>
                        <td>
                            ${{ $managerLiquidations['manager_incomes'] }}
                        </td>
                        <td>
                            <a href="{{ route('admin.camstudio-reports.manager.report', $managerLiquidations['manager']->id) }}">
                                <span>
                                    <i class="fas fa-search"></i>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="card-body">
            <span class="h3">
                No hay registros
            </span>
        </div>
        @endif
    </div>
</section>
@endsection