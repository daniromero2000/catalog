<!-- Emails -->
<div class="col-md-6">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Emails</h3>
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
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($customer->customerEmails as $customer_email)
                            <tr>
                                <td class="text-center">
                                    {{ $customer_email->email }}
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
