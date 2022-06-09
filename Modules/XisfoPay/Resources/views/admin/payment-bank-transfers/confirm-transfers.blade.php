@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
    @if(!$payment_bank_transfers->isEmpty())
        <div class="card-header border-0">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-xl-3" style="text-align: center">
                    <span class="h3 mb-0">{{ $module}} </span>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.payment-bank-transfers.confirm-transfers') }}"
            method="post" onsubmit="return submitting()">
            @csrf
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover">
                    @include('generals::layouts.admin.tables.table-headers', [$headers])
                    <tbody>
                        @foreach($payment_bank_transfers as $data)
                        <tr>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">
                                {{ $data->paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name}}
                                / {{ $data->paymentRequest->contractRequestStreamAccount->nickname}} /
                                {{ $data->paymentRequest->contractRequestStreamAccount->streaming->streaming}} </td>
                            <td class="text-center">
                                {{ $data->paymentRequest->customerBankAccount->bankNames->name}}
                                /
                                {{ $data->paymentRequest->customerBankAccount->account_number}}
                            </td>
                            @if ($data->value < 0) 
                                <td class="text-center" style="color: red;">
                                $ {{ number_format(round($data->value)) }}
                                </td>
                            @else
                                <td class="text-center">
                                    $ {{ number_format(round($data->value)) }}
                                </td>
                            @endif
                            <td class="d-flex align-items-center justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input bg-success checkbox" 
                                        type="checkbox" 
                                        value="{{$data->id}}"
                                        name="payments[{{$data->id}}]" 
                                        id="flexCheckDefault">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
            <input type="hidden" name="is_transfered" value="1">
            <div class="card-footer text-right">
                <input class="form-check-input bg-success checkbox" type="checkbox" 
                    id="select_all">
                <label class="form-check-label text-sm mr-3" for="select_all">
                    Seleccionar Todos
                </label>
                <button type="submit" class="btn btn-sm btn-primary" id="create_button_">
                    Confirmar Transferencias
                </button>
            </div>
        </form>
    @else
        <div class="card-header">
            No hay transferencias bancarias por confirmar
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
        return confirm('¿Estás seguro que quieres confirmar estas transferencias?');
    }
</script>
@endsection
