@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.bank-accounts.store') }}" method="post" class="form">
            <div class="card-header">
                <span class="h3 mb-0">Crear cuenta bancaria</span>
            </div>
            <div class="card-body">
                @csrf
                <div class="row mb-0">
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="name">Nombre
                                <span class="text-red"> *</span>
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-font"></i></span>
                                </div>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="account_number">Número de cuenta
                                <span class="text-red"> *</span>
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-hashtag"></i></span>
                                </div>
                                <input class="form-control" type="text" name="account_number" id="account_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <label class="form-control-label" for="bank_id">Banco
                                <span class="text-red"> *</span>
                            </label>
                            <select class="select" name="bank_id" id="bank_id" required>
                                <option value selected disabled>--select an option--</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">
                                        {{ $bank->name }}
                                    </option>
                                @endforeach
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
