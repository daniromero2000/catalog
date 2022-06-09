<style>
    .container-tr {
        background-color: #F8F9FE;
        color: #6D7AEB;
        font-weight: bold;
    }

    .icon-color {
        color: #6D7AEB;
    }

    .color-title-tab {
        color: #9A9A9A;
    }
</style>

@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            @include('generals::layouts.search', ['route' => route('admin.wishlists.index')])
            <div class="row">
                <div class="col-12">
                    <h3> <i class="fas fa-list"></i> Lista de deseos por cliente</h3>
                </div>
            </div>
        </div>
        @if ($wishlist)
        <table class="table-striped table">
            <thead>
                <tr class="text-center container-tr">
                    <td>Nombre de cliente</td>
                    <td>Producto deseado</td>
                    <td>Fecha de registro</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($wishlist as $data)
                <tr>
                    <td>{{$data->customer->name}} {{$data->customer->last_name}} </td>
                    <td>{{$data->product->name}}</td>
                    <td>{{$data->created_at->format('M d, Y h:i a')}}</td>
                    <td>
                        <a data-toggle="modal" data-target="#covermodal" data-original-title="Ver cover" href="">
                            <i class="fas fa-eye icon-color"></i>
                        </a>
                    </td>
                    @include('ecommerce::layouts.wishlist.show_wishlist_modal')
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
        @else
        <p class="alert alert-warning">Ninguna Wishlist creada aún <a href="{{ route('admin.wishlists.create') }}">Crea
                una!</a>
        </p>
        @include('generals::layouts.admin.pagination.pagination_null', [$skip])
        @endif
    </div>
</section>
@endsection
