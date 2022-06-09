@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route('admin.checkouts.index')])
            <div class="row">
                <div class="col-12">
                    <h3>Checkouts Sin Finalizar</h3>
                </div>
            </div>
        </div>
        @if($checkouts)
        <table class="table-striped table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkouts as $checkout)
                <tr>
                    <td class="text-center">{{ date('M d, Y h:i a', strtotime($checkout->created_at)) }}
                    </td>
                    <td class="text-center">{{$checkout->customer->name}} {{$checkout->customer->last_name}}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.checkouts.show', $checkout->id) }}" class=" table-action table-action"
                            data-toggle="tooltip" data-original-title="">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
        @else
        <p class="alert alert-warning">Ningún Checkout Creado aún <a href="{{ route('admin.brands.create') }}">Crea
                una!</a>
        </p>
        @include('generals::layouts.admin.pagination.pagination_null', [$skip])
        @endif
    </div>
</section>
@endsection
