@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                @include('generals::layouts.admin.module_name')
            </div>
        </div>
        @if(!$cammodels->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($cammodels)
                    @foreach($cammodels as $cammodel)
                    <tr>
                        <td class="text-center">{{ $cammodel->nickname }}</td>
                        <td class="text-center">{{ $cammodel->employee->name }} {{ $cammodel->employee->last_name }}
                        </td>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#modal{{ $cammodel->id }}" href=""
                                class="table-action table-action" data-toggle="tooltip">
                                <i class="fas fa-user-edit"></i></a>
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodels.edit_inactive_modal')
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $cammodels->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
