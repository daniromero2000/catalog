@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="col pl-0 mb-3">
            <h2>{{$module}} </h2>
        </div>
        <form action="" method="post" class="form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label" for="item_category_id">¿Qué categoría es el artículo? </label>
                        <select name="item_category_id" id="item_category_id" class="form-control" enabled>
                            @foreach($itemCategories as $itemCategory)
                            <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="weightt" class="form-group">
                        <input type="number" name="weight" id="weight" placeholder="¿Qué peso tiene tu joya en gramos?"
                            class="form-control" step=".01" value="{{ old('weight') }}">
                    </div>
                    <div id="jewelry_quality_id1" class="form-group">
                        <label for="jewelry_quality_id">¿De qué Calidad es la joya? </label>
                        <select name="jewelry_quality_id" id="jewelry_quality_id" class=" form-control " enabled>
                            @foreach($jewelryQualities as $jewelryQuality)
                            <option value="{{ $jewelryQuality->id }}">{{ $jewelryQuality->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="fasecoldaCodeClase1" class="form-group">
                                <label for="roll">Clase de Vehículo</label>
                                <select name="fasecoldaCodeClase" class="form-control" id="fasecoldaCodeClase">
                                    <option value="">-- Selecciona la clase--</option>
                                    @foreach ($clases as $clase)
                                    <option value="{{ $clase->Clase }}">{{ $clase->Clase }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="fasecoldaCodeMarca1"
                                class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaCodeMarca">Marca </label>
                                <select name="marca" class="form-control" required id="marca">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="fasecoldaCodeRef01" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaCodeRef1">Línea</label>
                                <select name="ref1" class="form-control" id="ref1">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="fasecoldaCodeRef02" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaCodeRef2">Referencia </label>
                                <select name="ref2" class="form-control" id="ref2">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="fasecoldaCodeRef03" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaCodeRef3">Cilindraje</label>
                                <select name="fasecoldaCodeRef3" class="form-control" id="fasecoldaCodeRef3">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="fasecoldaModelo1" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaModelo">Modelo </label>
                                <select name="model" class="form-control" id="model">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="fasecoldaPrice1" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="fasecoldaPrice">Precio </label>
                                <input type="text" name="current_price" class="form-control" id="current_price"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="jewelryPrice01" class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                <label for="jewelryPrice1">Precio </label>
                                <i class="fa fa-search-dollar"> </i><input type="text" name="jewelryPrice1"
                                    class="form-control no-border" id="jewelryPrice1"
                                    value="{{ config('cart.currency_symbol') }} 0">
                            </div>
                        </div>
                    </div>
                    <input id="item_status_id" type="hidden" class="form-control" name="item_status_id" value="3">
                    <input type="hidden" name="status" id="status" class="form-control" value="1">
                </div>

            </div>
        </form>
    </div>
    <script src="{{ asset('js/front/jquery.min.js') }}"></script>
    @include('pawnshop::admin.pawn-shop-self-assessor.autoevaluadorJS')
</section>
@endsection
