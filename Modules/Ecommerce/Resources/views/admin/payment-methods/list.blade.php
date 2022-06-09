@extends('generals::layouts.admin.app')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <h2> <i class="fa fa-flask"></i> Payment Methods</h2>
            @include('generals::layouts.search', ['route' => route('admin.payment-methods.index')])
            @if(!$paymentMethods->isEmpty())
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>ID Cuenta</td>
                        <td>ID Cliente</td>
                        <td>Client Secret</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentMethods as $paymentMethod)
                    <tr>
                        <td>{{ $paymentMethod->name }}</td>
                        <td>{{ $paymentMethod->account_id }}</td>
                        <td>{{ $paymentMethod->client_id }}</td>
                        <td>{{ $paymentMethod->client_secret }}</td>
                        <td>@include('generals::layouts.status', ['status' => $paymentMethod->status])</td>
                        <td>
                            <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}"
                                method="post" class="form-horizontal">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}"
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
