@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.couriers.update', $courier->id) }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                        value="{{ $courier->name ?: old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción </label>
                    <textarea name="description" id="description" rows="5" class="form-control"
                        placeholder="Descripción">{{ $courier->description ?: old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="URL">URL</label>
                    <div class="input-group">
                        <span class="input-group-addon">http://</span>
                        <input type="text" name="url" id="url" placeholder="Link" class="form-control"
                            value="{{ $courier->url ?: old('url') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_free">Envío gratis?</label>
                    <select name="is_free" id="is_free" class="form-control">
                        <option value="0" @if($courier->is_free == 0) selected="selected" @endif>No</option>
                        <option value="1" @if($courier->is_free == 1) selected="selected" @endif>Si</option>
                    </select>
                </div>
                <div class="form-group" @if($courier->is_free == 1) style="display: none" @endif id="delivery_cost">
                    <label for="cost">Costo de envío <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">{{config('cart.currency')}}</span>
                        <input class="form-control" type="text" id="cost" name="cost"
                            placeholder="{{config('cart.currency')}}" value="{{$courier->cost}}">
                    </div>
                </div>
                <div class="form-group">
                    @include('generals::admin.shared.status-select', ['status' => $courier->status])
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.couriers.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
