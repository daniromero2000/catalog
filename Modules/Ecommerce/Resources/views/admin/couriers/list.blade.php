@extends('generals::layouts.admin.app')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <h2> <i class="fa fa-truck"></i> Couriers</h2>
            @include('generals::layouts.search', ['route' => route('admin.couriers.index')])
            @if($couriers)
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td class="col-md-2">Nombre</td>
                        <td class="col-md-2">Descripción</td>
                        <td class="col-md-2">URL</td>
                        <td class="col-md-1">Es gratis?</td>
                        <td class="col-md-1">Costo</td>
                        <td class="col-md-1">Estado</td>
                        <td class="col-md-3">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($couriers as $courier)
                    <tr>
                        <td>{{ $courier->name }}</td>
                        <td>{{ str_limit($courier->description, 100, ' ...') }}</td>
                        <td>{{ $courier->url }}</td>
                        <td>
                            @include('generals::layouts.status', ['status' => $courier->is_free])
                        </td>
                        <td>
                            {{config('cart.currency')}} {{ $courier->cost }}
                        </td>
                        <td>@include('generals::layouts.status', ['status' => $courier->status])</td>
                        <td>
                            <form action="{{ route('admin.couriers.destroy', $courier->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.couriers.edit', $courier->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                        class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
@endsection
