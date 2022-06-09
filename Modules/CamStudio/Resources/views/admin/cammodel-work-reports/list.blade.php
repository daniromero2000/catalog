@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchComment', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
               @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if($cammodelWorkReports->isNotEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($cammodelWorkReports as $cammodelWorkReport)
                    <tr>
                        <td class="text-center">{{ $cammodelWorkReport->id }}</td>
                        <td class="text-center">{{ $cammodelWorkReport->cammodel->nickname }}</td>
                        <td class="text-center">
                            @if ($cammodelWorkReport->room != null)
                            {{ $cammodelWorkReport->room->name }}
                            @else
                            --No Data--
                            @endif
                        </td>
                        <td class="text-center">{{ $cammodelWorkReport->shift->name }}</td>
                        <td class="text-center">
                            @if ($cammodelWorkReport->inCharge != null)
                            {{ $cammodelWorkReport->inCharge->name.' '.$cammodelWorkReport->inCharge->last_name }}
                            @else
                            --No Data--
                            @endif
                        </td>
                        <td class="text-center">{{ date('h:i a', strtotime($cammodelWorkReport->entry_time)) }}</td>
                        <td class="text-center">
                            @if ($cammodelWorkReport->connection_time)
                            {{ date('h:i a', strtotime($cammodelWorkReport->connection_time)) }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($cammodelWorkReport->disconnection_time)
                            {{ date('h:i a', strtotime($cammodelWorkReport->disconnection_time)) }}
                            @endif
                        </td>
                        <td class="text-center">{{ $cammodelWorkReport->created_at }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-between">
                                @include('generals::layouts.admin.tables.table_options', ['data' => $cammodelWorkReport, 'optionsRoutes' =>
                                $optionsRoutes])
                                <a data-toggle="modal" class="ml-2" data-target="#commentModal{{ $cammodelWorkReport->id }}"><i class="fas fa-comments text-gray"></i></a>
                            </div>
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-work-reports.edit_work_report')
                    @endforeach
                </tbody>
            </table>
            @foreach ($cammodelWorkReports as $cammodelWorkReport)
            @include('camstudio::admin.layouts.cammodel-work-report-commentaries.add_comment_modal')     
            @endforeach
        </div>
        <div class="card-footer py-2 text-center">
            {{ $cammodelWorkReports->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
