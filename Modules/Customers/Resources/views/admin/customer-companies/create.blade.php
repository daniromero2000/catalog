@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.customer-companies.store') }}" method="post" class="form">
            @csrf
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Empresas Cliente</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="customer_id">Cliente</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="constitution_type">Tipo de Constitución</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                </div>
                                <select name="constitution_type" id="constitution_type" class="form-control">
                                    <option selected="selected" value="Natural">
                                        Natural</option>
                                    <option value="Jurídica">Jurídica
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="company_legal_name">Nombre Legal Empresa</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="company_legal_name" id="company_legal_name" validation-pattern="company_legal_name"
                                    placeholder="Nombre Legal Empresa" class="form-control" value="{{ old('company_legal_name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="company_commercial_name">Nombre Comercial Empresa</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="company_commercial_name" id="company_commercial_name" validation-pattern="company_commercial_name"
                                    placeholder="Nombre Comercial Empresa" class="form-control" value="{{ old('company_commercial_name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="company_address">Dirección</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="company_address" id="company_address" validation-pattern="company_address"
                                    placeholder="Dirección" class="form-control" value="{{ old('company_address') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="neighborhood">Barrio</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="neighborhood" id="neighborhood" validation-pattern="neighborhood"
                                    placeholder="Barrio" class="form-control" value="{{ old('neighborhood') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="company_phone">Teléfono</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="company_phone" id="company_phone" validation-pattern="company_phone"
                                    placeholder="Teléfono" class="form-control" value="{{ old('company_phone') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="city_id">Ciudad</label>
                            <div class="input-group input-group-merge">
                                <select name="city_id" id="city_id" class="form-control"
                                    enabled>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($cities as $citie)
                                        <option value="{{ $citie->id }}">{{ $citie->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.customer-bank-accounts.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
