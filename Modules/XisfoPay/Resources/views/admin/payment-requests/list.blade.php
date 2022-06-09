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
                @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                    @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
                @endif
                <div class="col-6 col-sm-6 col-md-6 col-xl-3" style="text-align: center">
                    <a href="{{ route('admin.pendingPaymentRequests') }}"
                        class="btn btn-sm btn-primary text-white">Pagos pendientes</a>
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
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">
                            {{ $data->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name}}/{{$data->contractRequestStreamAccount->nickname }}
                            {{$data->contractRequestStreamAccount->streaming->streaming }}</td>
                        @if ($data->payment_type == 2)
                        <td class="text-center">{{ number_format($data->usd_amount, 0) }} TKS</td>
                        @else
                        <td class="text-center">{{ number_format($data->usd_amount, 2) }} USD</td>
                        @endif
                        @if ($data->grand_total < 0) <td class="text-center" style="color: red;">
                            $ {{ number_format(round($data->grand_total)) }} </td>
                            @else
                            <td class="text-center">$ {{ number_format(round($data->grand_total)) }}</td>
                            @endif
                            <td class="text-center">{{ number_format($data->usd_gain, 2) }} USD</td>
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
                                @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                                $optionsRoutes])
                            </td>
                    </tr>
                    @include('xisfopay::layouts.payment_requests.edit_payment_request', ['data' =>
                    $data])
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
</section>
@endsection
