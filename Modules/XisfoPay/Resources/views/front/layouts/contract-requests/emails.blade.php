<!-- Emails -->
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col text-center">
                    <h3 class="mb-0" style="color: #1C4293"> <i class="fas fa-envelope-open-text"></i> Correo(s) electrónico(s)</h3>
                </div>
            </div>
            <br>
            <div class="w-100">
                <div class="table-responsive">
                    @if($customer->customerEmails->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Dirección de correo electrónico</th>
                                <th class="text-center" scope="col">Fecha Registro</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene Emails</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
