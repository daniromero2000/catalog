@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<style>
    .circular-image {
        display: inline-block;
        overflow: hidden;
        border-radius: 50%;
        max-width: 200px;
        max-height: 200px;
    }
</style>
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card px-3">
        <div class="row">
            <div class="col 12 col-md-12">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="graphs-tab" data-toggle="tab"
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
            <div class="tab-pane fade show active" style="background: none;" id="report_graphs" role="tabpanel"
                aria-labelledby="graphs-tab">
                @include('camstudio::admin.layouts.cammodel-stats.graphs')
            </div>
            <div class="tab-pane fade" style="background: none;" id="report_comments" role="tabpanel"
                aria-labelledby="comments-tab">
                @include('camstudio::admin.layouts.cammodels.commentaries', ['commentaries' => $cammodel->employee->employeeCommentaries])
            </div>
        </div>
    </div>
@include('camstudio::admin.layouts.cammodels.add_comment_modal')
</section>
@endsection
@section('scripts')
<script>
    var cammodelStreamingIncomes = JSON.parse('<?php echo json_encode($cammodelStreamingIncomes)?>');
    var cammodelStreamingStats   = JSON.parse('<?php echo json_encode($cammodelStreamingStats)?>');
    var cammodelSocialStats      = JSON.parse('<?php echo json_encode($cammodelSocialStats)?>');
    var dailyIncomes             = JSON.parse('<?php echo json_encode($dailyIncomes)?>');
    var fortnightsIncomes        = JSON.parse('<?php echo json_encode($fortnightsIncomes)?>');
</script>
@if ($cammodelStreamingIncomes->isNotEmpty())
@include('camstudio::admin.layouts.cammodel-stats.streaming_incomesJS')
@include('camstudio::admin.layouts.cammodel-stats.daily_incomesJS')
@include('camstudio::admin.layouts.cammodel-stats.streamings_chartJS')
@include('camstudio::admin.layouts.cammodel-stats.socials_chartJS')
@endif
@endsection
