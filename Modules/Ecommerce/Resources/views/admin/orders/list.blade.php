@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route('admin.orders.index')])
            <div class="row">
                <div class="col-12">
                    <h2>Ordenes {{ config('app.name') }}</h2>
                </div>
            </div>
        </div>
        @if(!empty($orders))
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <th>Nº Orden</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Courier</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>FVN0-{{$order->id}}</td>
                        <td>{{ date('M d, Y h:i a', strtotime($order->created_at)) }}</td>
                        <td>{{$order->customer->name}} {{$order->customer->last_name}}</td>
                        <td>{{ $order->courier['name'] }}</td>
                        <td>
                            <span
                                class="label @if($order->grand_total != $order->total_paid) label-danger @else label-success @endif">{{ config('cart.currency') }}
                                ${{ number_format($order->grand_total, 0) }}</span>
                        </td>
                        <td>
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $order->orderStatus->color }}">
                                {{ $order->orderStatus->name }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class=" table-action table-action"
                                data-toggle="tooltip" data-original-title="">
                                <i class="fas fa-search"></i>
                            </a>
                        </td>
                    </tr>
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
