@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
Pagos
@endsection
@section('breadcum-item')
<i class="fas fa-cash-register"></i> Gestión de pagos
@endsection
@include('generals::layouts.admin.pagination.pagination_style')
@section('content')@include('generals::layouts.admin.pagination.pagination_style')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            <div class="card">
                <div class="card-header border-0">
                    @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-4">
                            <h3 class="mb-0" style="color: #1C4393;"> <i class="fas fa-cash-register"></i> Tus
                                solicitudes
                                de pago</h3>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-2">
                            @include('generals::layouts.front.create-entity-buttom', [$optionsRoutes])
                        </div>
                    </div>
                </div>
                @if(!$payment_requests->isEmpty())
                <div class="table-responsive">
                    <table class="table-striped table align-items-center table-flush table-hover">
                        @include('generals::layouts.admin.tables.table-headers', [$headers])
                        <tbody>
                            @foreach($payment_requests as $data)
                            <tr>
                                <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                                <td class="text-center">
                                    {{$data->contractRequestStreamAccount->nickname }}
                                    {{$data->contractRequestStreamAccount->streaming->streaming }}
                                </td>
                                <td class="text-center">{{ number_format($data->trm, 2) }}</td>
                                @if ($data->payment_type == 2)
                                <td class="text-center">{{ number_format($data->usd_amount, 0) }} TKS</td>
                                @else
                                <td class="text-center">{{ number_format($data->usd_amount, 2) }} USD</td>
                                @endif
                                @if ($data->grand_total < 0) <td class="text-center" style="color: red;">
                                    $ {{ number_format(round($data->grand_total)) }}
                                    </td>
                                    @else
                                    <td class="text-center">$ {{ number_format(round($data->grand_total)) }}</td>
                                    @endif
                                    <td class="text-center">
                                        <span class="badge"
                                            style="color: #ffffff; background-color: {{ $data->paymentRequestStatus->color }}">
                                            {{ $data->paymentRequestStatus->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">@include('generals::layouts.status', ['status' =>
                                        $data->is_aprobed]) @include('generals::layouts.status', ['status' =>
                                        $data->payment_type])
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('account.payment-requests.show', $data->id)}}"
                                            class=" table-action table-action" data-toggle="tooltip"
                                            data-original-title="Ver Pago">
                                            <i class="fas fa-eye text-primary"></i>
                                        </a>
                                    </td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
               <div class="card-footer py-2 text-center">
                {{ $payment_requests->appends(request()->query())->links() }}
            </div>
            </div>
            @else
            @include('generals::layouts.admin.pagination.pagination_null')
            @endif
        </div>
    </div>
</div>
@endsection
