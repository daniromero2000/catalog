@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form"
            onsubmit="disable_button('create_button_')">
            @csrf
            <div class="card mb-0 pb-0">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h3 class="mb-0"><strong>Pagos a liquidar en el Corte </strong>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="table-responsive">
                            @if(!$uncutPaymentRequests->isEmpty())
                            <table class="table-striped table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cuenta Cliente</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Giro/Trm</th>
                                        <th scope="col">Aprobado</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($uncutPaymentRequests as $data)
                                    <tr>
                                        <td class="text-center">{{$data->created_at->format('M d, Y h:i a')}}</td>
                                        <td class="text-center">
                                            {{$data->contractRequestStreamAccount->nickname }}{{$data->contractRequestStreamAccount->streaming->streaming }}
                                            {{ $data->contractRequestStreamAccount->contractRequest->client_identifier }}
                                        </td>
                                        @if ($data->payment_type == 2)
                                        <td class="text-center">{{ number_format($data->usd_amount, 0) }} TKS</td>
                                        @else
                                        <td class="text-center">{{ number_format($data->usd_amount, 2) }} USD</td>
                                        @endif
                                        <td class="text-center">Giro {{$data->chaseTransfer->id }} TRM
                                            ${{$data->chaseTransfer->chaseTransferTrm->trm }}
                                            {{  $data->chaseTransfer->created_at->format('M d, Y') }} </td>
                                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                                            $data->is_aprobed])
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-sm">No tiene Pagos <strong>APROBADOS</strong> para liquidar</span><br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                @if (!$uncutPaymentRequests->isEmpty())
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Liquidar</button>
                @endif
                <a href="{{ route($optionsRoutes . '.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/utilities.js')}}"></script>
@endsection
