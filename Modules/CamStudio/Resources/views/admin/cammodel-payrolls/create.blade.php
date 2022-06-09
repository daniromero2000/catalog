@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form"
            onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <h2>Liquidar Nomina Modelos</h2>
                    </div>
                    <div class="col-6 text-right">
                        <script src="https://www.dolar-colombia.com/widget.js?t=2&c=1"></script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Ingrese TRM <strong>APROBADA</strong> para
                                liquidar la Nomina<span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-funnel-dollar"></i></span>
                                </div>
                                <input class="form-control" type="text" name="trm" id="trm" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('camstudio::admin.layouts.cammodel-payrolls.cammodel_incomes_to_pay')
            <div class="card-footer text-right">
                @if (!$uncutCammodelStreamingIncomes->isEmpty())
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                @endif
                <a href="{{ route($optionsRoutes . '.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
    function sortTable(column = 0) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("incomes-table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[column];
                y = rows[i + 1].getElementsByTagName("TD")[column];
                if (column == 0) {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else{
                    if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

</script>
<script type="text/javascript" src="{{asset('js/utilities.js')}}"></script>
@endsection
