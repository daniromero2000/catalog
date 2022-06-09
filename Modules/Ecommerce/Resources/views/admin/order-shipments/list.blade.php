@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route('admin.order-shipments.index')])
            <div class="row">
                <div class="col-12">
                    <h3>Despacho de Ordenes</h3>
                </div>
            </div>
        </div>
        @if(!empty($shipments->toArray()))
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Orden</th>
                        <th>Courier</th>
                        <th>Cantidad</th>
                        <th>Peso</th>
                        <th>Track #</th>
                        <th>Despacho</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $item)
                    @if ( $item->company_id == $company_id)
                    <tr>
                        <td><a title="Show order"
                                href="{{ route('admin.orders.show', $item->order_id) }}">{{ $item->order_id }}</a> </td>
                        <td>{{ $item->courier->name }}</td>
                        <td>{{ $item->total_qty }}</td>
                        <td>{{ $item->total_weight }}</td>
                        <td>{{ $item->track_number }}</td>
                        <td>
                            <a title="Ver Despacho" href="{{route('admin.order-shipments.show', $item->id)}}"><i
                                    class="fa fa-truck"></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
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
@endsection
