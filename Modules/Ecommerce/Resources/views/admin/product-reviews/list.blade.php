@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <h2>Calificaci&oacute;n de Productos</h2>
            @include('generals::layouts.search', ['route' => route('admin.product-reviews.index')])
        </div>
        @if($productReviews)
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <td>Nombre</td>
                        <td>Title</td>
                        <td>Rating</td>
                        <td>Comentario</td>
                        <td>Estado</td>
                        <td>Producto</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productReviews as $item)
                    {{-- @if ( $item->company_id == auth()->guard('employee')->user()->subsidiary->company_id) --}}
                    <tr>
                        <td>
                            <a title="Show order"
                                href="{{ route('admin.orders.show', $item->order_id) }}">{{ $item->order_id }}</a>
                        </td>
                        <td>{{ $item->courier->name }}</td>
                        <td>{{ $item->total_qty }}</td>
                        <td>{{ $item->total_weight }}</td>
                        <td>{{ $item->track_number }}</td>
                        <td>
                            <a title="Ver Despacho"
                                href="{{route('admin.order-shipments.show', $item->id)}}">Product</a>
                        </td>
                    </tr>
                    {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endif
</section>
@endsection
