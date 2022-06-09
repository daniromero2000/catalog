@extends('layouts.front.app')
@section('styles')
<style>

</style>

@endsection
@section('content')
<section class="container-reset px-2 content-empty content">
    <div class="row row-reset">
        <div class="card-body">
            @include('generals::layouts.errors-and-messages')
        </div>
        <div class="col-md-12">
            <h5 style=" color: gray; "><i class="fas fa-user-circle"></i> Perfil - {{$customer->name}} </h5>
            <hr>
        </div>
    </div>
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if(!request()->has('address2')) active @endif" id="profile-tab"
                    data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i
                        class="ni ni-cloud-upload-96 mr-2"></i>Perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                    aria-controls="orders" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Pedidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="address-tab" data-toggle="tab" href="#address" role="tab"
                    aria-controls="address" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Direcciones
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link mb-sm-3 mb-md-0 @if (request()->has('address2')) active @endif" id="address-tab2"
                    data-toggle="tab" href="#address2" role="tab" aria-controls="address2" aria-selected="false"><i
                        class="ni ni-calendar-grid-58 mr-2"></i>Lista de deseos
                </a>
            </li>
        </ul>
    </div>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(!request()->has('address2')) show active @endif" id="profile"
                    role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container bootstrap snippet">
                        <div class="row">
                            <div class="col-sm-12">
                                <!--left col-->
                                <div class="text-center">
                                    <img src="{{ asset('img/tws/avatar.png') }}" class="avatar profile-rounded"
                                        alt="avatar">
                                </div>
                                <div class="card text-center mt-3">
                                    <div class="card-header">
                                        <h4>
                                            <h5 class="title-card-profile">{{$customer->name}} {{$customer->last_name}}
                                            </h5>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h6 class="card-title title-detail-profile"><i
                                                                class="fas fa-at"></i> Correo electrónico</h6>
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <p class="card-text">{{$customer->email}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h6 class="card-title title-detail-profile"><i
                                                                class="fas fa-birthday-cake"></i> Cumpleaños</h6>
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <p class="card-text">{{$customer->birthday}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    @if(!$orders->isEmpty())
                    <table class="table-striped table text-sm text-center">
                        <thead>
                            <th class="head-tab">Fecha</th>
                            <th class="head-tab">Total</th>
                            <th class="head-tab">Estado</th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <a class="link-modal-ped" data-toggle="modal"
                                        data-target="#order_modal_{{$order['id']}}" title="Show order"
                                        href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}
                                    </a>
                                    <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1"
                                        role="dialog" aria-labelledby="MyOrders">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content modal-rounded">
                                                <div class="m-auto mt-4">
                                                    <h5 class="modal-title title-detail-profile">Referencia
                                                        #{{$order['reference']}}</h5>
                                                </div>
                                                {{-- <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Reference
                                                                #{{$order['reference']}}</h4>
                                            </div> --}}
                                            <div class="modal-body">
                                                <table class="table-striped table text-sm">
                                                    <thead>
                                                        <th class="head-tab">Dirección</th>
                                                        <th class="head-tab">Metodo de Pago</th>
                                                        <th class="head-tab">Total</th>
                                                        <th class="head-tab">Estado</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <address>
                                                                    {{$order['address']->customer_address}}<br>
                                                                </address>
                                                            </td>
                                                            <td>{{$order['payment']}}</td>
                                                            <td>{{ config('cart.currency_symbol') }}
                                                                {{number_format($order['grand_total'],0)}}
                                                            </td>
                                                            <td>
                                                                <span class="badge"
                                                                    style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <p>Detalles del pedido:</p>
                                                <table class="table-striped table text-sm">
                                                    <thead>
                                                        <th class="head-tab">Nombre</th>
                                                        <th class="head-tab">Cantidad</th>
                                                        <th class="head-tab">Precio</th>
                                                        <th class="head-tab">Cover</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order['products'] as $product)
                                                        <tr>
                                                            <td>{{$product['name']}}</td>
                                                            <td>{{$product['pivot']['quantity']}}</td>
                                                            <td>{{number_format($product['price'],0)}}</td>
                                                            {{$product['id']}}
                                                            {{$product['cover']}}
                                                            <td><img src="{{ asset('storage/'.$product->cover) }}"
                                                                    width=50px height=50px alt="{{ $product['name'] }}"
                                                                    class="img-orderDetail">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                </div>
                </td>
                <td>
                    <span
                        class="label @if($order['grand_total'] != $order['total_paid']) label-danger @else label-success @endif">{{ config('cart.currency') }}
                        ${{ number_format($order['grand_total'],0) }}</span>
                </td>
                <td class="text-center">
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</span>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                @else
                <br />
                <p class="alert alert-warning">No tienes direcciones creadas aún.</p>
                @endif
            </div>
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                @if(!$addresses->isEmpty())
                <table class="table-striped table text-sm text-center">
                    <thead>
                        <th class="head-tab">Dirección</th>
                        <th class="head-tab">Ciudad</th>
                        <th class="head-tab">Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($addresses as $address)
                        <tr>
                            <td>{{$address->customer_address}}</td>
                            <td>{{$address->city->city}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <a href="" data-toggle="modal" data-target="#destroyadressModal">
                                    <i style="color: #831448;" class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <!-- Modal destroy address -->
                            <div class="modal fade modal-top" id="destroyadressModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-cont" role="document">
                                    <div class="modal-content modal-rounded">
                                        <div class="row mx-0 justify-content-end">
                                            <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row text-center">
                                                    <div class="col-12 col-md-12">
                                                        <h4 style="color:#831448">Advertencia <i
                                                                class="fas fa-exclamation-circle"></i> </h4>
                                                        <p style="color:#808080">¿Seguro desea eliminar la dirección?
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post"
                                                        action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}"
                                                        class="form-horizontal">
                                                        <input type="hidden" name="_method" value="delete">
                                                        @csrf
                                                        <button class="btn btn-sm btn-confirm" type="submit"> Eliminar
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <br />
                <p class="alert alert-warning">No tienes direcciones creadas aún.</p>
                @endif
            </div>


            <div class="tab-pane fade @if(request()->has('address2')) show active @endif" id="address2" role="tabpanel"
                aria-labelledby="address-tab2">
                @if(!$wishlist->isEmpty())
                <table class="table-striped table text-sm text-center">
                    <thead>
                        <th class="head-tab">Sku</th>
                        <th class="head-tab">Producto</th>
                        <th class="head-tab">Precio</th>
                        <th class="head-tab">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($wishlist as $data)
                        <tr>
                            <td>{{$data->product->sku}}</td>
                            <td>{{$data->product->name}}</td>
                            <td>$ {{ number_format($data->product->price)}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#modalcover" data-original-title="Ver cover"
                                    href="">
                                    <i style="color:#831448" class="fas fa-eye"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#productModal{{ $data->product->id }}"
                                    class="table-action table-action" data-toggle="tooltip"
                                    data-original-title="Agregar a carrito">
                                    <i style="color:#831448" class="fas fa-cart-plus"></i>
                                </a>
                                <a href="" data-toggle="modal" data-target="#destroyModal">
                                    <i style="color:#831448" class="fas fa-times-circle"></i>
                                </a>
                            </td>
                            <!-- Modal cover -->
                            <div class="modal fade" id="modalcover" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" role="dialog" aria-labelledby="covermodal" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="row mx-0 justify-content-end">
                                                <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="content m-auto">
                                                <div class="text-center" style="color:#831448">
                                                    <h4>{{$data->product->name}}</h4>
                                                </div>
                                                <img class="img-fluid lazy"
                                                    src-src="{{ asset("storage/" . $data->product->cover )}}"
                                                    alt="{{$data->product->name}}" style=" border-radius: 6px; ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="productModal{{ $data->product->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" role="dialog"
                                aria-labelledby="productModal{{ $data->product->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="row mx-0 justify-content-end">
                                                <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @include('ecommerce::front.products.layouts.modals.modal_product_accounts_option_one',
                                            ['product'=>$data->product])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal eliminar wishlist -->
                            <div class="modal fade" id="destroyModal" data-backdrop="static" data-keyboard="false"
                                style="margin-top:100px" tabindex="-1" role="dialog"
                                aria-labelledby="productModal{{ $data->product->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-rounded mt-5">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="row mx-0 justify-content-end">
                                                <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="container">
                                                <div class="row text-center">
                                                    <div class="col-12 col-md-12">
                                                        <h4 style="color:#831448">Advertencia <i
                                                                class="fas fa-exclamation-circle"></i></h4>
                                                        <p style="color:#808080">¿Seguro desea eliminar el registro de
                                                            su lista de deseos?</p>
                                                    </div>
                                                </div>
                                                <form action="{{ route('wishlist.destroy', $data->id) }}" method="POST"
                                                    class="form-horizontal">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete">
                                                    <div class="modal-footer">
                                                        <button style="background-color:#B93D6B" type="submit"
                                                            class="btn btn-danger">Confirmar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <br />
                <p class="alert alert-warning">No tienes productos en tu lista de deseos.</p>
                @endif
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" @if(request()->input('tab') == 'profile') class="active" @endif><a
                    href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li role="presentation" @if(request()->input('tab') == 'orders') class="active" @endif><a
                    href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Pedidos</a></li>
                    <li role="presentation" @if(request()->input('tab') == 'address') class="active" @endif><a
                    href="#address" aria-controls="address" role="tab" data-toggle="tab">Direcciones</a></li>
                </ul>
                <div class="tab-content customer-order-list">
                    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'profile')active @endif"
                        id="profile">
                        {{$customer->name}} <br /><small>{{$customer->email}}</small>
    </div>
    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'orders')active @endif" id="orders">
        @if(!$orders->isEmpty())
        <table class="table-striped table">
            <tbody>
                <tr>
                    <td>Fecha</td>
                    <td>Total</td>
                    <td>Estado</td>
                </tr>
            </tbody>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}" title="Show order"
                            href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1" role="dialog"
                            aria-labelledby="MyOrders">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Reference
                                            #{{$order['reference']}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table-striped table">
                                            <thead>
                                                <th>Direccón</th>
                                                <th>Metodo de Pago</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <address>
                                                            {{$order['address']->customer_address}}<br>
                                                        </address>
                                                    </td>
                                                    <td>{{$order['payment']}}</td>
                                                    <td>{{ config('cart.currency_symbol') }}
                                                        {{$order['grand_total']}}
                                                    </td>
                                                    <td>
                                                        <p class="text-center"
                                                            style="color: #ffffff; background-color: {{ $order['status']->color }}">
                                                            {{ $order['status']->name }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <p>Detalles del Pedido:</p>
                                        <table class="table-striped table">
                                            <thead>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Cover</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($order['products'] as $product)
                                                <tr>
                                                    <td>{{$product['name']}}</td>
                                                    <td>{{$product['pivot']['quantity']}}</td>
                                                    <td>{{$product['price']}}</td>
                                                    <td><img src="{{ asset("storage/".$product['cover']) }}" width=50px
                                                            height=50px alt="{{ $product['name'] }}"
                                                            class="img-orderDetail"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><span class="label @if($order['grand_total'] != $order['total_paid']) label-danger
                                    @else label-success @endif">{{ config('cart.currency') }}
                            {{ $order['grand_total'] }}</span>
                    </td>
                    <td>
                        <p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }}">
                            {{ $order['status']->name }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="alert alert-warning">Sin pedidos aún. <a href="{{ route('/') }}">Compra Ahora!</a>
        </p>
        @endif
    </div>
    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'address')active @endif" id="address">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('customer.address.create', auth()->user()->id) }}" class="btn btn-primary">Crea tu
                    dirección</a>
            </div>
        </div>
        @if(!$addresses->isEmpty())
        <table class="table-striped table">
            <thead>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Zip</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                <tr>
                    <td>{{$address->customer_address}}</td>
                    <td>{{$address->city->city}}</td>
                    <td>{{$address->zip}}</td>
                    <td>
                        <form method="post"
                            action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}"
                            class="form-horizontal">
                            <div class="btn-group">
                                <input type="hidden" name="_method" value="delete">
                                @csrf
                                <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}"
                                    class="btn btn-primary"> <i class="fa fa-pencil"></i> Editar</a>
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Borrar</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <br />
        <p class="alert alert-warning">No tienes direcciones creadas aún.</p>
        @endif
    </div>
    </div>
    </div>
    </div>
    </div> --}}
</section>
@endsection
