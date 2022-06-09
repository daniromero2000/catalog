@extends('layouts.front.app')
@section('styles')
<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #000;
        background-color: #ffc107;
    }

    .nav-pills .nav-link {
        border-radius: .0rem;
    }
</style>
@endsection
@section('content')
<div class="row m-0 p-0">
    <div class="col-12 text-right">
        <script src="https://www.dolar-colombia.com/widget.js?t=2&c=1"></script>
    </div>
    <div class="col-12 m-0 p-0">
        <div class="card">
            <div class="row m-0 p-0">
                <div class="col-12 col-md-12 p-0">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="dollars-tab" data-toggle="tab"
                                    href="#dollars" role="tab" aria-controls="request"
                                    aria-selected="true">Dolares</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tokens-tab" data-toggle="tab"
                                    href="#tokens" role="tab" aria-controls="home"
                                    aria-selected="false">Tokens</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" style="background: none;" id="dollars" role="tabpanel"
                    aria-labelledby="dollars-tab">
                    @include('xisfopay::front.pricing.dollars')
                </div>
                <div class="tab-pane fade" style="background: none;" id="tokens" role="tabpanel"
                    aria-labelledby="tokens-tab">
                    @include('xisfopay::front.pricing.tokens')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("input").change(function(){
            trm = parseFloat($('#trm').val());
            calculateXisfoDollars();
            calculateXisfoTokens();
        });
    });

    function calculateXisfoDollars(){
        dollars = parseFloat($('#usd_amount').val());
        if (dollars > 0) {
            chaseCommission = $('#chase_bank_processing_commision').val();
            platformCommission = $('input[name="streaming_commission"]:checked').val();
            if ($('input[name="streaming_commission"]:checked').attr('id') == "epay_base_commission") {
                platformCommission = parseFloat(platformCommission) + parseFloat(dollars * $('#epay_commision').val());
                platformCommission = Math.round((platformCommission + Number.EPSILON) * 100) / 100;
            }
            dollars -= platformCommission;
            xisfoCommission = dollars * 0.05;
            dollars -= xisfoCommission;
            totalDollars = dollars - chaseCommission;
            totalPesos = Math.floor(trm * totalDollars);
            totalPesos = numberWithCommas(totalPesos)
            $('#platform_commission').val(platformCommission);
            $('#xisfo_commission').val(Math.round((xisfoCommission + Number.EPSILON) * 100) / 100);
            $('#chase_commission').val(chaseCommission);
            $('#total_usd_amount').val(Math.round((totalDollars + Number.EPSILON) * 100) / 100);
            $('#total_cop_amount').val(totalPesos);
            calculatePT();
            calculateBT();
        } else{
            $('#platform_commission').val(0);
            $('#xisfo_commission').val(0);
            $('#chase_commission').val(0);
            $('#total_usd_amount').val(0);
            $('#total_cop_amount').val(0);
        }
    }

    function calculatePT(){
        aDollars = parseFloat($('#usd_amount').val());

        if(aDollars <= 50){
            aTransferCost = aDollars * 0.14;
            iva = aDollars * 0.0267;

        } else if(aDollars <= 99){
            aTransferCost = aDollars * 0.08;
            iva = aDollars * 0.0152;

        } else if(aDollars <= 141){
            aTransferCost = aDollars * 0.06;
            iva = aDollars * 0.0114;

        } else{
            aTransferCost = aDollars * 0.04;
            iva = aDollars * 0.0076;
        }

        aTotalDollars = aDollars - (aTransferCost + iva);

        if (trm == 0) {
            aTotalPesos = 0;
        } else{
            aTotalPesos = aTotalDollars * (trm - 200);
        }

        aTotalPesos = numberWithCommas((Math.round((aTotalPesos + Number.EPSILON) * 100) / 100).toFixed(0));

        $('#a_usd_amount').val(Math.round((aDollars + Number.EPSILON) * 100) / 100);
        $('#a_transfer_commission').val(Math.round((aTransferCost + Number.EPSILON) * 100) / 100);
        $('#a_iva').val(Math.round((iva + Number.EPSILON) * 100) / 100);
        $('#a_total_usd_amount').val(Math.round((aTotalDollars + Number.EPSILON) * 100) / 100);
        $('#a_total_cop_amount').val(aTotalPesos);
    }

    function calculateBT(){
        bDollars = parseFloat($('#usd_amount').val());

        if(bDollars <= 50){
            bTransferCost = bDollars * 0.14;

        } else if(bDollars <= 99){
            bTransferCost = bDollars * 0.08;

        } else if(bDollars <= 141){
            bTransferCost = bDollars * 0.06;

        } else if(bDollars < 1000){
            bTransferCost = bDollars * 0.04;

        } else{
            bTransferCost = bDollars * 0.03;
        }

        retentionCost = bDollars * 0.04;
        bTotalDollars = bDollars - (bTransferCost + retentionCost);

        if (trm == 0) {
            bTotalPesos = 0;
        } else{
            bTotalPesos = bTotalDollars * (trm - 100);
        }

        bTotalPesos = numberWithCommas((Math.round((bTotalPesos + Number.EPSILON) * 100) / 100).toFixed(0));

        $('#b_usd_amount').val(Math.round((bDollars + Number.EPSILON) * 100) / 100);
        $('#b_transfer_commission').val(Math.round((bTransferCost + Number.EPSILON) * 100) / 100 );
        $('#b_retention_cost').val(Math.round((retentionCost + Number.EPSILON) * 100) / 100 );
        $('#b_total_usd_amount').val(Math.round((bTotalDollars + Number.EPSILON) * 100) / 100 );
        $('#b_total_cop_amount').val(bTotalPesos);
    }

    function calculateXisfoTokens(){
        tokens = parseFloat($('#tokens_amount').val());
        if (tokens > 0) {
            tDollars   = tokens * parseFloat($('#chaturbate_commission').val());
            tokensTrm  = parseFloat($('#t_trm').val());
            tTotalPesos = Math.floor(tokensTrm * tDollars);
            tTotalPesos = numberWithCommas((Math.round((tTotalPesos + Number.EPSILON) * 100) / 100).toFixed(0))
            $('#t_total_usd_amount').val(Math.round((tDollars + Number.EPSILON) * 100) / 100);
            $('#t_total_cop_amount').val(tTotalPesos);
        } else{
            $('#t_total_usd_amount').val(0);
            $('#t_total_cop_amount').val(0);
        }
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


</script>
@endsection
