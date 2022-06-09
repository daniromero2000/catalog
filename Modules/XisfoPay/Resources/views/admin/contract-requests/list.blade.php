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
                    <h3 class="mb-0">{{$contract_requests_total}} {{ $module}} </h3>
                </div>
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$contract_requests->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($contract_requests as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->customerCompany->company_legal_name }} /
                            {{ $data->customerCompany->company_commercial_name }} </td>
                        <td class="text-center"> @if ($data->contract_request_type == 3)
                            <span class="badge" style="background-color: #ffee00">
                                {{ $data->customer->customerGroup->name }} Venta Tokens
                            </span>
                            @else
                            {{ $data->customer->customerGroup->name }}
                            @endif </td>
                        <td class="text-center">{{ $data->client_identifier }}</td>
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->contractRequestStatus->color }}">
                                {{ $data->contractRequestStatus->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.status', ['status' => $data->is_signed])
                            @include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">@include('generals::layouts.admin.tables.table_options_with_comments',
                            [$data,
                            'optionsRoutes' => $optionsRoutes])
                        </td>
                    </tr>
                    @include('xisfopay::layouts.contract_requests.admin.add_comment_list_modal', ['id' => $data->id])
                    @include('xisfopay::layouts.contract_requests.admin.edit_contract_request', ['data' => $data])
                    @endforeach
                <tbody>
            </table>
        </div>
      <div class="card-footer py-2">
            {{ $contract_requests->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif

</section>
@endsection
