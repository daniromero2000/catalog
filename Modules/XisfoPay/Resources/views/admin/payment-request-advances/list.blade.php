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
            </div>
        </div>
        @if(!$payment_request_advances->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($payment_request_advances as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->paymentRequest->contractRequestStreamAccount->nickname }}</td>
                        <td class="text-center">${{ number_format($data->value, 2) }}</td>
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->paymentRequestStatus->color }}">
                                {{ $data->paymentRequestStatus->name }}
                            </span>
                        </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('xisfopay::layouts.payment_request_advances.edit_payment_request_advance', ['data' =>
                    $data])
                    @endforeach
                <tbody>
            </table>
        </div>
       <div class="card-footer py-2 text-center">
            {{ $payment_request_advances->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
