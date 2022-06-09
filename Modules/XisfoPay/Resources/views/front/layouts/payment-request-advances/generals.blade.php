<div class="card">
    <div class="card-header">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"><strong>Préstamo </strong>
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $payment_request_advance->paymentRequestStatus->color }}">
                        {{ $payment_request_advance->paymentRequestStatus->name }}
                    </span></h3>
            </div>
            @if ( $payment_request_advance->is_aprobed && $payment_request_advance->transfer == 0)
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#bankTransfermodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Registrar Transferencia </a>
            </div>
            @endif
        </div>
    </div>
    <div class="w-100">
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Valor (COP)</th>
                        <th scope="col">Aprobado</th>
                        <th scope="col">Transferencia</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <td class="text-center">{{ $payment_request_advance->created_at->format('M d, Y h:i a') }}
                        </td>
                        <td class="text-center">${{ number_format($payment_request_advance->value, 2) }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                            $payment_request_advance->is_aprobed])
                        </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                            $payment_request_advance->transfer])
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3 mx-0">
                <div class="col text-right">
                    <form action="{{ route('admin.contract-requests.destroy', $payment_request_advance['id']) }}"
                        method="post" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
