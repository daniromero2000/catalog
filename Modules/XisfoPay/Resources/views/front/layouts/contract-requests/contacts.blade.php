<div class="card">
    <div class="card-body">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="contactsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="principal-tab" data-toggle="tab" href="#principal"
                        role="tab" aria-controls="principal" aria-selected="true">Datos de cliente, contacto y referencias
                        <i class="far fa-address-card"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="contactsTabContent">
            <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
                <div class="row w-100">
                    @include('xisfopay::front.layouts.contract-requests.generals')
                    @include('xisfopay::layouts.contract_requests.addresses', ['customer' =>$contract_request->customer])
                    @include('xisfopay::front.layouts.contract-requests.phones', ['customer' =>$contract_request->customer ])
                    @include('xisfopay::front.layouts.contract-requests.emails', ['customer' =>$contract_request->customer ])
                    @include('xisfopay::front.layouts.contract-requests.references', ['customer' =>$contract_request->customer])
                </div>
            </div>
        </div>
    </div>
</div>
