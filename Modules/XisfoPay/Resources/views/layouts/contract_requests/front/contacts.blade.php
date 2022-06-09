<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="contactsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="principal-tab" data-toggle="tab" href="#principal"
                role="tab" aria-controls="principal" aria-selected="true"> <i class="far fa-hand-pointer"></i> 1.1. Información de representante legal
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link mb-sm-3 mb-md-0" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                aria-controls="requestdoc" aria-selected="false"> <i class="far fa-hand-pointer"></i> 1.2. Contacto de cliente
            </a>
        </li>
    </ul>
</div>
<div class="tab-content" id="contactsTabContent">
    <div class="tab-pane fade show active" id="principal" role="tabpanel" aria-labelledby="principal-tab">
        @include('xisfopay::layouts.contract_requests.front.generals')
    </div>
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <div class="row">
            <div class="col-12">
                @include('xisfopay::layouts.contract_requests.front.addresses', ['customer' =>$contract_request->customer])
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                @include('xisfopay::layouts.contract_requests.front.phones', ['customer' =>$contract_request->customer ])
            </div>
            <div class="col-6">
                @include('xisfopay::layouts.contract_requests.front.emails', ['customer' =>$contract_request->customer ])
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include('xisfopay::layouts.contract_requests.front.references', ['customer' =>$contract_request->customer])
            </div>
        </div>
    </div>
</div>
