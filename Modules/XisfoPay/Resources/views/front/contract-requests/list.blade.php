@extends('xisfopay::front.customers.accounts.app')
@section('icon')
<link rel="icon" href="{{asset('modules/generals/argonTemplate/img/icons/icon.png')}}" type="image/png">
@endsection
@section('name-pagine')
Solicitudes de servicio |
@endsection
@section('name-module')
<i class="fas fa-file-contract"></i> Solicitudes de servicio
@endsection
@section('breadcum-item')
 Solicitudes de servicio <i class="fas fa-file-signature"></i>  
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            @include('generals::layouts.errors-and-messages')
            @if(!$contract_requests->isEmpty())
            <div class="card">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-4">
                            <h3 class="mb-0" style="color: #1C4393;"> <i class="fas fa-file-signature"></i> Tus solicitudes de servicio</h3>
                        </div>
                        @if ($enable_create == 1)
                        <div class="col-6 col-sm-6 col-md-6 col-xl-2">
                            <div class="justify-content-right d-flex">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('account.create-new-contract-request') }}" aria-expanded="false"
                                    aria-controls="contentId">
                                    Crear nueva solicitud de servicio
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table align-items-center table-flush">
                           @include('generals::layouts.admin.tables.table-headers')
                            <tbody class="list text-center">
                                @foreach($contract_requests as $data)
                                <tr>
                                    {{-- <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td> --}}
                                    <td class="text-center">{{ $data->customerCompany->company_legal_name }} /
                                        {{ $data->customerCompany->company_commercial_name }} </td>
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
                                    <td class="text-center">
                                        <a href="{{ route('account.contract-requests.show', $data->id )}}"
                                            class="table-action table-action" data-toggle="tooltip"
                                            data-original-title="Ver">
                                            <i style="color: #1c4393 !important; font-size: 15px;"
                                                class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
