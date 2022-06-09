@extends('generals::layouts.admin.app')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <h2>Estado de Ordenes</h2>
            @include('generals::layouts.search', ['route' => route('admin.order-statuses.index')])
            @if($orderStatuses)
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td class="col-md-4">Nombre</td>
                        <td class="col-md-4">Color</td>
                        <td class="col-md-4">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderStatuses as $status)
                    <tr>
                        <td>{{ $status->name }}</td>
                        <td><button class="btn" style="background-color: {{ $status->color }}"><i class="fa fa-check"
                                    style="color: #ffffff"></i></button></td>
                        <td>
                            <form action="{{ route('admin.order-statuses.destroy', $status->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.order-statuses.edit', $status->id) }}"
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
