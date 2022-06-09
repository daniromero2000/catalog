<div class="card">
    <div class="card-body">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="contactsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="principal-tab" data-toggle="tab" href="#principal"
                        role="tab" aria-controls="principal" aria-selected="true">Información, Masters y Contrato
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-sm-3 mb-md-0" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                        aria-controls="requestdoc" aria-selected="false">Contacto Cliente
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="contactsTabContent">
            <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
                @include('xisfopay::layouts.contract_requests.admin.generals')
                @include('xisfopay::layouts.contract_requests.admin.contracts')
                @include('xisfopay::layouts.contract_requests.admin.master_accounts')
            </div>
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <div class="row">
                    @include('xisfopay::layouts.contract_requests.admin.addresses', ['customer' =>$contract_request->customer])
                    @include('xisfopay::layouts.contract_requests.admin.phones', ['customer' =>$contract_request->customer ])
                    @include('xisfopay::layouts.contract_requests.admin.emails', ['customer' =>$contract_request->customer ])
                    @include('xisfopay::layouts.contract_requests.admin.references', ['customer' =>$contract_request->customer
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
