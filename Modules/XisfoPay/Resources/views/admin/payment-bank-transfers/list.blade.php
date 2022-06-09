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
                <div class="col-6 col-sm-6 col-md-6 col-xl-3" style="text-align: center">
                    <span class="h3 mb-0">{{ $module}} </span>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-xl-3" style="text-align: center">
                    <a href="{{ route('admin.payment-bank-transfers.to-confirm') }}"
                        class="btn btn-sm btn-primary text-white">Confirmar Transferencias</a>
                </div>
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
                            {{ $data->paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name}}
                            / {{ $data->paymentRequest->contractRequestStreamAccount->nickname}} /
                            {{ $data->paymentRequest->contractRequestStreamAccount->streaming->streaming}} </td>
                        <td class="text-center">
                            {{ $data->paymentRequest->customerBankAccount->bankNames->name}}
                            /
                            {{ $data->paymentRequest->customerBankAccount->account_number}}
                        </td>
                        @if ($data->value < 0) <td class="text-center" style="color: red;">
                            $ {{ number_format(round($data->value)) }}
                            @else
                            <td class="text-center">$ {{ number_format(round($data->value)) }}</td>
                            @endif
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_aprobed])@include('generals::layouts.status', ['status' =>
                                $data->is_transfered])
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.payment-requests.show', $data->paymentRequest->id)}}"
                                    class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                    <i class="fas fa-search"></i></a>
                            </td>
                            <td class="text-center">
                                @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                                $optionsRoutes])
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
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
