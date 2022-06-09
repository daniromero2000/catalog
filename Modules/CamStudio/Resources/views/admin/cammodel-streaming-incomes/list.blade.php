@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<style>
    .pagination {
        justify-content: center;
    }
</style>
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($cammodelsWorkReports->isNotEmpty())
    <div class="card">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-12">
                    @include('generals::layouts.searchStatus', ['route' => route($optionsRoutes . '.index')])
                </div>
            </div>
            <div class="row">
                @include('generals::layouts.admin.module_name')
            </div>
        </div>
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($cammodelsWorkReports as $cammodelWorkReport)
                    <tr>
                        <td class="text-center">
                            {{ $cammodelWorkReport->cammodelStreamingIncomes[0]->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">
                            {{ $cammodelWorkReport->cammodelStreamingIncomes[0]->cammodelStreamAccount->cammodelWithEmployee->nickname }}
                            /
                            {{ $cammodelWorkReport->cammodelStreamingIncomes[0]->cammodelStreamAccount->cammodelWithEmployee->employeeName->name }}
                            {{ $cammodelWorkReport->cammodelStreamingIncomes[0]->cammodelStreamAccount->cammodelWithEmployee->employeeName->last_name }}
                        </td>
                        <td class="text-center">
                            {{ $cammodelWorkReport->cammodelStreamingIncomes[0]->cammodelStreamAccount->cammodelWithEmployee->employeeName->subsidiary->name }}
                        </td>
                        <td class="text-center">
                            {{ $cammodelWorkReport->cammodelStreamingIncomes->sum('tokens') }} /
                            {{ ($cammodelWorkReport->cammodelStreamingIncomes->sum('dollars')/2) }}
                        </td>
                        <td class="text-center">@include('generals::layouts.admin.user_is_aprobed_layout', ['status' =>
                            $cammodelWorkReport->cammodelStreamingIncomes[0]->user_approves])</td>
                        <td class="text-center">
                            @if(!auth()->guard('employee')->user()->hasRole('studio_manager'))
                            <a data-toggle="modal"
                                data-target="#modal{{ $cammodelWorkReport->cammodelStreamingIncomes[0]->id }}" href=""
                                class="table-action table-action" data-toggle="tooltip">
                                <i class="fas fa-user-edit"></i></a>
                            @endif
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-streaming-incomes.edit_streaming_income')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $cammodelsWorkReports->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
