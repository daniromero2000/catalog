@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.bank-movements.store') }}" method="post" class="form">
            <div class="card-header">
                <span class="h3 mb-0">Crear movimiento de bancario</span>
            </div>
            <div class="card-body">
                @csrf
                <div class="row mb-0">
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="amount">Monto del movimiento
                                <span class="text-red"> *</span>
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input class="form-control" type="text" name="amount" id="amount" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="bank_account_id">Cuenta bancaria
                                <span class="text-red"> *</span>
                            </label>
                            <select class="select" name="bank_account_id" id="bank_account_id" required>
                                <option value selected disabled>--select an option--</option>
                                @foreach ($bankAccounts as $bankAccount)
                                    <option value="{{ $bankAccount->id }}">
                                        {{ $bankAccount->name }} / {{ $bankAccount->bank->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="movement_type">Tipo de movimiento
                                <span class="text-red"> *</span>
                            </label>
                            <select class="select" name="movement_type" id="movement_type" required>
                                <option value selected disabled>--select an option--</option>
                                <option value="CREDIT">Crédito</option>
                                <option value="DEBIT">Débito</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.bank-movements.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
