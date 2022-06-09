@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <div class="col pl-0 mb-3">
                <h2>Crear ingreso Offline</h2>
            </div>
            <form action="{{ route('admin.cammodel-streaming-incomes.store-offline') }}" method="post"
                onsubmit="disable_button('create_button_')">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="cammodel_selector">Fecha</label>
                            <div class="input-group">
                                <input type="date" name="created_at" 
                                    id="created_at" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="cammodel_selector">Modelo</label>
                            <select class="form-control" id="cammodel_selector" name="cammodel_id"
                                onchange="cammodel_selected()" required>
                                <option value disabled selected>--select an option--</option>
                                @forelse ($cammodels as $cammodel)
                                    <option value="{{ $cammodel->id }}">{{ $cammodel->nickname }}
                                        / {{ $cammodel->employee->name.' '.$cammodel->employee->last_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="stream_account_selector"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="tokens_input"></div>
                        </div>
                    </div>
                </div>
                <div class="text-right" id="submit_button">
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("created_at").setAttribute("max", today);

    var cammodels = JSON.parse('<?php echo json_encode($cammodels)?>');
    var selectedCammodel = [];

    function cammodel_selected(){
        cammodelId = document.getElementById('cammodel_selector').value;
        openSelect =    '<label class="form-control-label" for="cammodel_selector">Stream</label>' +
                        '<select class="form-control" name="cammodel_stream_account_id" id="account_selector" ' +
                            'onChange="stream_selected()" required>' +
                            '<option value disabled selected>--select an option--</option>';
        closeSelect =   '</select>'
        selectContent = '';
        cammodels.forEach(cammodel => {
            if(cammodel['id'] == cammodelId){
                selectedCammodel = cammodel;
                selectedCammodel['cammodel_stream_accounts_without_skype'].forEach(streamAccount => {
                    selectContent +=    '<option value="' + streamAccount['id'] + '">' +
                                            streamAccount['streaming']['streaming'] + '</option>';
                });
            }
        });
        document.getElementById('stream_account_selector').innerHTML = openSelect + selectContent + closeSelect;
    }

    function stream_selected(){
        streamAccountId = document.getElementById('account_selector').value;
        inputContent = '<input type="number" class="form-control" name="tokens" required>';
        selectedCammodel['cammodel_stream_accounts_without_skype'].forEach(streamAccount => {
            if (streamAccount['id'] == streamAccountId) {
                if (parseFloat(streamAccount['streaming']['usd_token_rate']) == 1.0) {
                    inputLabel = '<label class="form-control-label" for="tokens">Dolares</label>'
                } else{
                    inputLabel = '<label class="form-control-label" for="tokens">Tokens</label>'
                }
            }
        });
        document.getElementById('tokens_input').innerHTML = inputLabel + inputContent;
        document.getElementById('submit_button').innerHTML = '<button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>';
    }

</script>
@include('generals::layouts.admin.buttons.disable_button')
@endsection
