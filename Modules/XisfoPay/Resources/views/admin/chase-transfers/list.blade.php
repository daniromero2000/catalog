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
                    <span class="h3 mb-0">{{ $module}} </span>
                </div>
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
                <div class="col" style="">
                    <a class="btn btn-primary btn-sm" href="{{route('admin.chaseTransfer.legalizeView')}}" aria-expanded="false"
                        aria-controls="contentId">
                        Legalizar giros
                    </a>
                </div>
            </div>
        </div>
        @if(!$chaseTransfers->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($chaseTransfers as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">$ {{ number_format($data->transfer_amount, 2) }}</td>
                        <td class="text-center">$ {{ number_format($data->ChaseTransferTrm->trm, 2) }} 
                            / {{ $data->ChaseTransferTrm->bank->name }}</td>
                        <td class="text-center">${{ number_format($data->paymentRequests->sum('commission'), 2) }} USD</td>
                        <td class="text-center">${{ number_format($data->paymentRequests->sum('real_commission'), 2) }} USD</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                            @include('generals::layouts.status', ['status' => $data->is_approved])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                        @include('xisfopay::layouts.chase-transfers.edit_chase_transfer_modal', ['chaseTransfer' => $data])
                    </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
      <div class="card-footer py-2">
            {{ $chaseTransfers->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif

</section>
@endsection
