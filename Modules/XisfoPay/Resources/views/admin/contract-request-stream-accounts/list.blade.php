@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-xl-2" style="text-align: end">
                    <h3 class="mb-0">{{ $contractRequestStreamAccounts->total() }} {{ $module }} </h3>
                </div>
                @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                    @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
                @endif
            </div>
        </div>
        @if(!$contractRequestStreamAccounts->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($contractRequestStreamAccounts)
                    @foreach($contractRequestStreamAccounts as $data)
                    <tr>
                        <td class="text-center">{{ $data->contractRequest->customer->name }}
                            {{ $data->contractRequest->customer->last_name }} /
                            {{ $data->contractRequest->customerCompany->company_commercial_name }}/
                            {{ $data->contractRequest->client_identifier}}</td>
                        <td class="text-center">{{ $data->nickname }} {{ $data->streaming->streaming }}</td>
                        <td class="text-center">
                            @if ($data->contractRequestStreamAccountCommission != null)
                                {{ $data->contractRequestStreamAccountCommission->streaming->streaming }} / 
                                ${{ $data->contractRequestStreamAccountCommission->amount }} USD
                            @else
                                Sin Asignar
                            @endif
                        </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                            @include('generals::layouts.status', ['status' => $data->set_up])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('xisfopay::layouts.contract-request-stream-accounts.edit_contract_request_stream_account')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $contractRequestStreamAccounts->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
