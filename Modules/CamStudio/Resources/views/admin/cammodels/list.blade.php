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
                @if (auth()->guard('employee')->user()->hasRole('superadmin|rh'))
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
                <div class="col-6 col-sm-6 col-md-6 col-xl-2">
                    <a class="btn btn-primary btn-sm" href="{{route('admin.cammodels.inactive-list')}}"
                        aria-expanded="false" aria-controls="contentId">
                        Activar Modelo
                    </a>
                </div>
                @endif
            </div>
        </div>
        @if(!$cammodels->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
              @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($cammodels as $data)
                    <tr>
                        <td class="text-center">{{ $data->nickname }}</td>
                        <td class="text-center">{{ $data->employee->name }} {{ $data->employee->last_name }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.cammodels.show', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Editar Empleado">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
