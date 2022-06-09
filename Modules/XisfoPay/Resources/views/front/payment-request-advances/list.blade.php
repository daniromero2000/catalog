@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Prestamos
@endsection
@section('breadcum-item')
Prestamos
@endsection
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
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
                                <td class="text-center">
                                    {{ $data->paymentRequest->contractRequestStreamAccount->nickname }}</td>
                                <td class="text-center">${{ number_format($data->value, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge"
                                        style="color: #ffffff; background-color: {{ $data->paymentRequestStatus->color }}">
                                        {{ $data->paymentRequestStatus->name }}
                                    </span>
                                </td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $data->is_aprobed])
                                </td>
                                <td class="text-center">
                                    <a href="{{route('account.payment-request-advances.show', $data->id)}}"
                                        class=" table-action table-action" data-toggle="tooltip"
                                        data-original-title="Ver Anticipo">
                                        <i class="fas fa-eye text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
               <div class="card-footer py-2 text-center">
                    {{ $payment_request_advances->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
