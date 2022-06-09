@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <span class="h3">Cuenta Bancaria: </span>
            <span class="">{{ $bankAccount->name }} / {{ $bankAccount->bank->name }}</span>
        </div>
        <div class="card">
            <div class="card-header">
                <span class="h4 m-3"> Movimientos Bancarios </span>
            </div>
            <div class="table">
                <table class="table table-flush text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de Movimiento</th>
                            <th>Monto</th>
                            <th>Total en la cuenta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bankAccount->bankMovements as $bankMovement)
                            <td>{{ $bankMovement->created_at->format('M d, Y h:i a') }}</td>
                            <td>{{ $bankMovement->movement_type }}</td>
                            <td>${{ number_format($bankMovement->amount, 2) }} {{ $bankAccount->bank->country->exchange_code }}</td>
                            <td>${{ number_format($bankMovement->total_bank_amount, 2) }} {{ $bankAccount->bank->country->exchange_code }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group">
                <a href="{{ route('admin.countries.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
</section>
@endsection