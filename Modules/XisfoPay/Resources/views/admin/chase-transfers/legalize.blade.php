@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
    @if(!$chaseTransfers->isEmpty())
        <form action="{{ route('admin.chaseTransfer.legalize') }}"
            method="post" onsubmit="return submitting()">
            @csrf
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-xl-3" style="text-align: center">
                        <span class="h3 mb-0">Legalizar {{$module}} </span>
                    </div>
                </div>
            </div>
            <div class="row mx-3">
                <div class="col">
                    <div class="form-group">
                        <label class="form-control-label mr-3">
                            Cuenta Bancaria <span class="text-red">*</span>
                        </label>
                        <select class="form-control select" 
                            name="bank_account_id" id="bank_account_id"
                            required>
                            <option value selected disabled>--select an option--</option>
                            @foreach ($bankAccounts as $bankAccount)
                                <option value="{{ $bankAccount->id }}">{{ $bankAccount->name }} - {{ $bankAccount->bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-control-label mr-3">
                            TRM <span class="text-red">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input class="form-control" type="number" step="any" name="trm" id="trm" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table">
                <table class="table-striped table align-items-center table-flush table-hover">
                    @include('generals::layouts.admin.tables.table-headers', [$headers])
                    <tbody>
                        @foreach($chaseTransfers as $data)
                        <tr>
                            <td class="text-center">{{ $data->id }}</td>
                            <td class="text-center">{{ $data->transfer_amount }}</td>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="d-flex align-items-center justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-success checkbox" 
                                        type="checkbox" 
                                        value="{{$data->transfer_amount}}"
                                        name="chaseTransfers[{{$data->id}}]" 
                                        id="flexCheckDefault">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <input class="form-check-input bg-success checkbox" type="checkbox" 
                    id="select_all">
                <label class="form-check-label text-sm mr-3" for="select_all">
                    Seleccionar Todos
                </label>
                <button type="submit" class="btn btn-sm btn-primary" id="create_button_">
                    Legalizar Giros
                </button>
            </div>
        </form>
    @else
        <div class="card-header">
            No hay solicitudes pendientes
        </div>
    @endif
    </div>
</section>
@include('generals::layouts.admin.buttons.disable_button')
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
        
        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
        });
    });

    function submitting(){
        cuenta = $( "#bank_account_id option:selected" ).text();
        trm = $( "#trm" ).val();
        return confirm('¿Estás seguro que quieres legalizar estos giros a la cuenta ' + cuenta +
            ' con una TRM de $' + trm + '?');
    }
</script>
@endsection
