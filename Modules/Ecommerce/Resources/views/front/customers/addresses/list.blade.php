@extends('layouts.front.app')

@section('content')
<section class="content container">
    @include('generals::layouts.errors-and-messages')
    @if($addresses)
    <div class="box">
        <div class="box-body">
            <h2>Direcciones</h2>
            @if(!$addresses->isEmpty())
            <table class="table-striped table">
                <tbody>
                    <tr>
                        <td>Alias</td>
                        <td>Dirección</td>
                        @if(isset($address->province))
                        <td>Departamento</td>
                        @endif
                        <td>Ciudad</td>
                        <td>Zip Code</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </tbody>
                <tbody>
                    @foreach ($addresses as $address)
                    <tr>
                        <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $address->alias }}</a></td>
                        <td>{{ $address->address_1 }}</td>
                        @if(isset($address->province))
                        <td>{{ $address->province->name }}</td>
                        @endif
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->zip }}</td>

                        <td>@include('generals::layouts.status', ['status' => $address->status])</td>
                        <td>
                            <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.addresses.edit', $address->id) }}"
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
            <a href="{{ route('accounts', ['tab' => 'profile']) }}" class="btn btn-default">Regresar a mi cuenta</a>
            @else
            <p class="alert alert-warning">No hay direcciones creadas aún. <a
                    href="{{ route('customer.address.create', auth()->id()) }}">Crear</a></p>
            @endif
        </div>
    </div>
    @else
    <div class="box">
        <div class="box-body">
            <p class="alert alert-warning">No se encontraron direcciones.</p>
        </div>
    </div>
    @endif
</section>
@endsection
