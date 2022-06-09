@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.couriers.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción </label>
                    <textarea name="description" id="description" rows="5" class="form-control"
                        placeholder="Descripción">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="URL">URL</label>
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input type="text" name="url" id="url" placeholder="Link" class="form-control"
                            value="{{ old('url') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_free">Es envío gratis? </label>
                    <select name="is_free" id="is_free" class="form-control">
                        <option value="0">No</option>
                        <option value="1" selected="selected">Si</option>
                    </select>
                </div>
                <div class="form-group" style="display: none" id="delivery_cost">
                    <label for="cost">Costo de Envío <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">{{config('cart.currency')}}</span>
                        <input class="form-control" type="text" id="cost" name="cost"
                            placeholder="{{config('cart.currency')}}" value="{{old('cost')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Estado </label>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Deshabilitado</option>
                        <option value="1">Habilitado</option>
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
