<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="documentsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab"
                aria-controls="accounts" aria-selected="true">Cuentas Bancarias
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="requestdoc-tab" data-toggle="tab" href="#requestdoc" role="tab"
                aria-controls="requestdoc" aria-selected="false">Solicitud de Contrato
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="company-tab" data-toggle="tab" href="#company" role="tab"
                aria-controls="company" aria-selected="false">Empresa
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="identity-tab" data-toggle="tab" href="#identity" role="tab"
                aria-controls="identity" aria-selected="false">Identidad
            </a>
        </li>
    </ul>
</div>
<div class="tab-content" id="documentsTabContent">
    <div class="tab-pane fade show active" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
        @include('xisfopay::layouts.contract_requests.admin.bank_accounts', ['customer' =>$contract_request->customer
        ])
    </div>
    <div class="tab-pane fade" id="requestdoc" role="tabpanel" aria-labelledby="requestdoc-tab">
        @include('xisfopay::layouts.contract_requests.admin.contract_request', ['customer' =>$contract_request ])
    </div>
    <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
        @include('xisfopay::layouts.contract_requests.admin.company', ['customer_company' =>$contract_request->customerCompany ])
    </div>
    <div class="tab-pane fade" id="identity" role="tabpanel" aria-labelledby="identity-tab">
        @include('xisfopay::layouts.contract_requests.admin.ids', ['customer' =>$contract_request->customer ])
    </div>
</div>
