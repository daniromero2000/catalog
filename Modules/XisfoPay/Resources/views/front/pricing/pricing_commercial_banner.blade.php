@extends('layouts.front.app')
@section('styles')
@endsection
@section('content')
@include('generals::layouts.errors-and-messages')
<div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="card m-3">
            <form action="{{route('commercialPricingCalculator')}}" method="GET">
                <div class="card-header bg-warning">
                    <span class="h5">Ingreso al tarificador comercial</span>
                </div>
                <div class="form-group m-4">
                    <label for="employee_identity" class="form-control-label">
                        Número de Identificación <span style="color: #ff1d1d"> *</span>
                    </label>
                    <input type="password" id="employee_identity" name="employee_identity" class="form-control">
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Ingresar</button>
                    <a class="btn btn-sm btn-secondary" href="https://xisfo.com/">
                        <span>Regresar</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection