<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="documentsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="requestdoc-tab" data-toggle="tab" href="#requestdoc" role="tab"
                aria-controls="requestdoc" aria-selected="false"><i class="far fa-hand-pointer"></i> 2.1. Solicitud de servicios
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="contract-tab" data-toggle="tab" href="#contract" role="tab"
                aria-controls="contract" aria-selected="false"><i class="far fa-hand-pointer"></i> 2.2. Contrato
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="company-tab" data-toggle="tab" href="#company" role="tab"
                aria-controls="company" aria-selected="false"> <i class="far fa-hand-pointer"></i> 2.3.Información legal de empresa
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="identity-tab" data-toggle="tab" href="#identity" role="tab"
                aria-controls="identity" aria-selected="false"><i class="far fa-hand-pointer"></i> 2.4. Documentos de identidad empresa
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab"
                aria-controls="accounts" aria-selected="true"><i class="far fa-hand-pointer"></i> 2.5. Cuentas bancarias
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="master-accounts-tab" data-toggle="tab" href="#master-accounts"
                role="tab" aria-controls="requestdoc" aria-selected="false"> <i class="far fa-hand-pointer"></i> 2.6. Cuentas master
            </a>
        </li>
    </ul>
</div>
<div class="tab-content" id="documentsTabContent">
    <div class="tab-pane fade show active" id="requestdoc" role="tabpanel" aria-labelledby="requestdoc-tab">
        @include('xisfopay::layouts.contract_requests.front.contract_request', ['customer' =>$contract_request ])
    </div>
    <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract-tab">
        @include('xisfopay::layouts.contract_requests.front.contracts')
    </div>
    <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
        @include('xisfopay::layouts.contract_requests.front.company', ['customer_company'
        =>$contract_request->customerCompany ])
    </div>
    <div class="tab-pane fade" id="identity" role="tabpanel" aria-labelledby="identity-tab">
        @include('xisfopay::layouts.contract_requests.front.ids', ['customer' =>$contract_request->customer ])
    </div>
    <div class="tab-pane fade" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
        @include('xisfopay::layouts.contract_requests.front.bank_accounts', ['customer' =>$contract_request->customer
        ])
    </div>
    <div class="tab-pane fade show" id="master-accounts" role="tabpanel" aria-labelledby="master-accounts-tab">
        @include('xisfopay::layouts.contract_requests.front.master_accounts')
    </div>
</div>
