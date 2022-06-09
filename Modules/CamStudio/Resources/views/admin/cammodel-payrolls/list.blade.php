@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
              @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$cammodel_payrolls->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($cammodel_payrolls as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->cammodel->nickname }}</td>
                        <td class="text-center">${{ number_format($data->bonus, 2) }}</td>
                        <td class="text-center">${{ number_format($data->total_usd_cammodel, 2) }}</td>
                        <td class="text-center">${{ number_format($data->total_cop_cammodel) }}</td>
                        <td class="text-center">${{ $data->trm }}</td>
                        <td class="text-center">{{ $data->user_approves }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-payrolls.edit_cammodel_payroll', ['data' =>
                    $data])
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
</section>
@endsection
