<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="documentsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="accounts-tab" data-toggle="tab" href="#accounts" role="tab"
                aria-controls="accounts" aria-selected="true">Solicitud de servicios <i class="far fa-file-alt"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                aria-controls="requestdoc" aria-selected="false">Contrato <i class="far fa-file-alt"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="requestdoc-tab" data-toggle="tab" href="#requestdoc" role="tab"
                aria-controls="requestdoc" aria-selected="false">Cuentas bancarias <i class="fas fa-money-check"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="contacts-tab" data-toggle="tab" href="#masters" role="tab"
                aria-controls="masters" aria-selected="false">Cuentas master / Streamings <i class="fas fa-satellite-dish"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="company-tab" data-toggle="tab" href="#company" role="tab"
                aria-controls="company" aria-selected="false">Empresa <i class="far fa-building"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="identity-tab" data-toggle="tab" href="#identity" role="tab"
                aria-controls="identity" aria-selected="false">Identidad <i class="far fa-id-badge"></i>
            </a>
        </li>
    </ul>
</div>
<div class="tab-content" id="documentsTabContent">
    <div class="tab-pane fade show active" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
        @include('xisfopay::front.layouts.contract-requests.contract_request', ['customer' =>$contract_request ])
    </div>
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        @include('xisfopay::front.layouts.contract-requests.contracts')
    </div>
    <div class="tab-pane fade" id="requestdoc" role="tabpanel" aria-labelledby="requestdoc-tab">
        @include('xisfopay::front.layouts.contract-requests.bank_accounts', ['customer' =>$contract_request->customer
        ])
    </div>
    <div class="tab-pane fade show" id="masters" role="tabpanel" aria-labelledby="masters-tab">
        @include('xisfopay::front.layouts.contract-requests.master_accounts')
    </div>
    <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
        @include('xisfopay::front.layouts.contract-requests.company', ['customer_company' =>$contract_request->customerCompany ])
    </div>
    <div class="tab-pane fade" id="identity" role="tabpanel" aria-labelledby="identity-tab">
        @include('xisfopay::front.layouts.contract-requests.ids', ['customer' =>$contract_request->customer ])
    </div>
</div>
