@extends('xisfopay::front.customers.accounts.app')
@section('name-module')
<i class="fas fa-file-contract"></i> Contratos
@endsection
@section('breadcum-item')
Contratos
@endsection
@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @if(!$contracts->isEmpty())
            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                       @include('generals::layouts.admin.module_name')
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-striped table align-items-center table-flush table-hover">
                        @include('generals::layouts.admin.tables.table-headers', [$headers])
                        <tbody>
                            @foreach($contracts as $data)
                            <tr>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $data->is_active])
                                </td>
                                <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                                <td class="text-center">
                                    {{ $data->contractRequests[0]->customerCompany->company_legal_name }}
                                    /
                                    {{ $data->contractRequests[0]->customerCompany->company_commercial_name }}
                                </td>
                                <td class="text-center">{{ $data->contractRequests[0]->client_identifier }}</td>
                                <td class="text-center">
                                    <span class="badge"
                                        style="color: #ffffff; background-color: {{ $data->contractStatus->color }}">
                                        {{ $data->contractStatus->name }}
                                    </span>
                                </td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $data->is_signed]) @include('generals::layouts.status', ['status' =>
                                    $data->is_aprobed])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('account.contracts.show', $data->id )}}"
                                        class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                        <i style="color: #1c4393 !important; font-size: 15px;" class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
               <div class="card-footer py-2 text-center">
                    {{ $contracts->appends(request()->query())->links() }}
                </div>
            </div>
            @else
            <p class="alert alert-warning">Tu contrato no está disponible aún.</p>
            @endif
        </div>
    </div>
</div>
@endsection
