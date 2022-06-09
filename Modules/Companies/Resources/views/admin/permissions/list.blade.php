@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
               @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$permissions->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody>
                    @foreach($permissions as $data)
                    <tr>
                        <td class="text-center">{{$data->id}}</td>
                        <td class="text-center">{{$data->name}}</td>
                        <td class="text-center">{{$data->display_name}}</td>
                        <td class="text-center"><i class="{{$data->icon}}"></i></td>
                        <td class="text-center">{{$data->description}}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.permissions.update', $data->id) }}" method="post" class="form">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body py-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="name{{ $data->id }}">Nombre</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-font"></i></span>
                                                        </div>
                                                        <input type="text" name="name" id="name{{ $data->id }}"
                                                            placeholder="Nombre" validation-pattern="name"
                                                            class="form-control" required
                                                            value="{{ old('name') ?: $data->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="display_name{{ $data->id }}">Nombre a mostrar</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-font"></i></span>
                                                        </div>
                                                        <input type="text" name="display_name"
                                                            id="display_name{{ $data->id }}"
                                                            placeholder="Nombre a mostrar" validation-pattern="name"
                                                            class="form-control" required
                                                            value="{{ old('display_name') ?: $data->display_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="icon{{ $data->id }}">Ícono</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i
                                                                    class="fa fa-image"></i></span>
                                                        </div>
                                                        <input type="text" name="icon" id="icon{{ $data->id }}"
                                                            placeholder="Ícono" class="form-control"
                                                            onchange="icon_change('icon{{$data->id}}')"
                                                            value="{!! $data->icon ?: old('icon')  !!}" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text text-primary">
                                                                <i id="selected_icon{{$data->id}}"
                                                                    class="{{ $data->icon }}"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="icon{{ $data->id }}">Descripción</label>
                                                    <textarea name="description" id="description"
                                                        validation-pattern="text" class="form-control"
                                                        rows="3">{!! $data->description ?: old('description')  !!}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
</section>
<script>
    function icon_change(icon){
        target = document.getElementById(icon).value;
        document.getElementById('selected_'+icon).className = target;
    }
</script>
@endsection
