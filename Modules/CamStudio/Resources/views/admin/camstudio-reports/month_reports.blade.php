@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.no_link_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            <div class="row">
                @include('generals::layouts.admin.module_name')
                <div class="col-8 col-sm-6 col-md-6 col-xl-9">
                    @include('generals::layouts.searchMonth', ['route' => route($optionsRoutes . '.month')])
                </div>
            </div>
        </div>
        @if($actualCammodelsLiquidations->isNotEmpty() || $pastCammodelsLiquidations->isNotEmpty())
        <div class="card px-3">
            <div class="row">
                <div class="col 12 col-md-12">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tables-tab" data-toggle="tab"
                                    href="#report_tables" role="tab" aria-controls="request"
                                    aria-selected="true">Tablas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="graphs-tab" data-toggle="tab"
                                    href="#report_graphs" role="tab" aria-controls="home"
                                    aria-selected="false">Gráficos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-sm-3 mb-md-0" id="comments-tab" data-toggle="tab"
                                    href="#report_comments" role="tab" aria-controls="home"
                                    aria-selected="false">Comentarios</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" style="background: none;" id="report_tables" role="tabpanel"
                    aria-labelledby="tables-tab">
                    @include('camstudio::admin.layouts.camstudio-reports.month.report_tables')
                </div>
                <div class="tab-pane fade" style="background: none;" id="report_graphs" role="tabpanel"
                    aria-labelledby="graphs-tab">
                    @include('camstudio::admin.layouts.camstudio-reports.month.report_graphs')
                </div>
                <div class="tab-pane fade" style="background: none;" id="report_comments" role="tabpanel"
                    aria-labelledby="comments-tab">
                    @include('camstudio::admin.layouts.camstudio-report-commentaries.commentaries', ['datas' => $commentaries])
                </div>
            </div>
        </div>
        @else
        <div class="card-body">
            <span class="h3">
                No hay registros
            </span>
        </div>
        @endif
    </div>
</section>
@include('camstudio::admin.layouts.camstudio-report-commentaries.add_comment_modal', ['periodType' => 'month'])
<script>
    var today = new Date();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm;
    document.getElementById("month").setAttribute("max", today);

    var compoundLiquidations = JSON.parse('<?php echo json_encode($compoundCammodelsLiquidations)?>');
    var subsidiaryLiquidations = JSON.parse('<?php echo json_encode($subsidiaryMonthsTotal)?>');
    var platformsLiquidations = JSON.parse('<?php echo json_encode($platformsMonthsTotal)?>');
    var platformsPrevLiquidations = JSON.parse('<?php echo json_encode($platformsPrevTotal)?>');
    var periodMonths         = JSON.parse('<?php echo json_encode($actualFortnight)?>');
</script>
@endsection
@section('scripts')
@include('camstudio::admin.layouts.camstudio-reports.cammodels_liquidationsJS')
@include('camstudio::admin.layouts.camstudio-reports.subsidiaries_liquidationsJS')
@include('camstudio::admin.layouts.camstudio-reports.platforms_liquidationsJS')
@include('camstudio::admin.layouts.camstudio-reports.platforms_prev_liquidationsJS')
@endsection
