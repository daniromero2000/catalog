<div class="row align-items-center mb-3">
    <div class="col">
    </div>
    @if (auth()->guard('employee')->user()->hasRole('xisfopay_assistant|superadmin'))
        @include('xisfopay::layouts.contract_requests.admin.edit_customer_password_button')
    @endif
    @if ($contract_request->customerCompany->is_aprobed )
        @if ($contract_request->contract_request_status_id != 3 && !$contract_request->is_signed)
        <div class="col-2 text-right p-0">
            <a href="{{ route('admin.contractRequest.generate',$contract_request->id) }}" id="dm"
                class="btn btn-primary text-white btn-sm" target="_blank"><i class="fa fa-print pr-2"></i>Imprimir Solicitud
                Contrato</a>
        </div>
        @endif
        @include('xisfopay::layouts.contract_requests.admin.edit_contract_request_button')
    @endif
</div>
<div class="w-100">
    <div class="table-responsive">
        @include('xisfopay::layouts.contract_requests.admin.customer')
    </div>
</div>
