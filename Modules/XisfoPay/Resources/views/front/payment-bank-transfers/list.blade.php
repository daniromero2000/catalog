@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Transferencias Bancarias
@endsection
@section('breadcum-item')
Transferencias Bancarias
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
                @if(!$payment_bank_transfers->isEmpty())
                <div class="table-responsive">
                    <table class="table-striped table align-items-center table-flush table-hover">
                        @include('generals::layouts.admin.tables.table-headers', [$headers])
                        <tbody>
                            @foreach($payment_bank_transfers as $data)
                            <tr>
                                <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                                <td class="text-center">
                                    {{ $data->paymentRequest->contractRequestStreamAccount->nickname}}
                                    {{ $data->paymentRequest->contractRequestStreamAccount->streaming->streaming}} </td>
                                <td class="text-center">
                                    {{ $data->paymentRequest->contractRequestStreamAccount->contractRequest->customer->customerBankAccounts->where('is_default', 1)->first()->bank->name}}
                                    /
                                    {{ str_repeat("*", 4) . substr($data->paymentRequest->contractRequestStreamAccount->contractRequest->customer->customerBankAccounts->where('is_default',
1)->first()->account_number, -4) }}
                                </td>
                                @if ($data->value < 0) <td class="text-center" style="color: red;">
                                    $ {{ number_format(round($data->value)) }}
                                    @else
                                    <td class="text-center">$ {{ number_format(round($data->value)) }}</td>
                                    @endif
                                    <td class="text-center">@include('generals::layouts.status', ['status' =>
                                        $data->is_aprobed]) @include('generals::layouts.status', ['status' =>
                                        $data->is_transfered])
                                    </td>
                            </tr>
                            @include('xisfopay::layouts.payment-bank-transfers.edit_payment_transfer')
                            @endforeach
                        <tbody>
                    </table>
                </div>
                <div class="card-footer py-2">
                    {{ $payment_bank_transfers->appends(request()->query())->links() }}
                </div>
            </div>
            @else
            @include('generals::layouts.admin.pagination.pagination_null_no_create')
            @endif
        </div>
    </div>
</div>
@endsection
