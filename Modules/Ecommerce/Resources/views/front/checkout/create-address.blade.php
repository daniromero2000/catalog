@extends('layouts.front.app')
@section('content')
<section class="container content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('customer.address.store', $customer->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="alias">Alias <span class="text-danger">*</span></label>
                    <input type="text" name="alias" id="alias" placeholder="Home or Office" class="form-control"
                        value="{{ old('alias') }}">
                </div>
                <div class="form-group">
                    <label for="address_1">Dirección<span class="text-danger">*</span></label>
                    <input type="text" name="address_1" id="address_1" placeholder="Address 1" class="form-control"
                        value="{{ old('address_1') }}">
                </div>
                <div class="form-group">
                    <label for="country_id">País </label>
                    <select name="country_id" id="country_id" class="form-control">
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="province_id">Departamento </label>
                    <select name="province_id" id="province_id" class="form-control">
                        @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="cities" class="form-group">
                    <label for="city_id">Ciudad </label>
                    <select name="city_id" id="city_id" class="form-control">
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Estado </label>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Deshabilitada</option>
                        <option value="1">Habilitada</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <input type="hidden" name="page" value="checkout">
                    <a href="{{ route('customer.address.index', $customer->id) }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
