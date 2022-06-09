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
                <div class="col-6 col-sm-6 col-md-6 col-xl-2" style="text-align: end">
                    <h3 class="mb-0">{{$contracts_total}} {{ $module}} </h3>
                </div>
            </div>
        </div>
        @if(!$contracts->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($contracts as $data)
                    <tr>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        </td>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">
                            {{ $data->contractRequests[0]->customerCompany->company_legal_name }} /
                            {{ $data->contractRequests[0]->customerCompany->company_commercial_name }}
                        </td>
                        <td class="text-center">{{ $data->contractRequests[0]->client_identifier }}</td>
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->contractStatus->color }}">
                                {{ $data->contractStatus->name }}
                            </span>
                        </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_signed])
                            @include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('xisfopay::layouts.contracts.edit_contract_modal')
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $contracts->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
