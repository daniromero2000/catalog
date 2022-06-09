<!-- Emails -->
<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col text-center">
                <h3 class="mb-0" style="color: #1C4293"> <i class="fas fa-mail-bulk"></i> Correos electrónicos</h3>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($customer->customerEmails->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">Email</th>
                            <th class="text-center" scope="col">Fecha Registro</th>
                            @if ($contract_request->contract_request_status_id == 7)
                            <th class="text-center" scope="col">Acciones</th>
                            @else
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($customer->customerEmails as $customer_email)
                        <tr>
                            <td class="text-center">
                                {{ substr($customer_email->email, 0, 3) . str_repeat("*", strlen($customer_email->email)-12) . substr($customer_email->email, -9) }}
                            </td>
                            <td class="text-center">{{ $customer_email->created_at->format('M d, Y h:i a') }}
                            </td>
                            @if ($contract_request->contract_request_status_id == 7)
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#emailmodal{{$customer_email->id}}" href="" class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                    <i class="fas fa-edit"></i></a>
                                <a href="" class=" table-action table-action" data-toggle="tooltip" data-original-title=""> </a>
                            </td>
                            @else

                            @endif
                        </tr>
                        <div class="modal fade" id="emailmodal{{$customer_email->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Actualizar dirección de correo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <form action="{{ route('account.customer-emails.update', $customer_email->id) }}" method="post" class="form">
                                            <div class="modal-body py-0">
                                                @csrf
                                                @method('PUT')
                                                <input id="customer_id" name="customer_id" value="{{ $customer_email->customer_id }}" hidden>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="phone">Correo electrónico</label>
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" name="email" id="email" placeholder="" required value="{{$customer_email->email}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tienes correos electrónicos registrados</span>
                @endif
            </div>
        </div>
    </div>
</div>
