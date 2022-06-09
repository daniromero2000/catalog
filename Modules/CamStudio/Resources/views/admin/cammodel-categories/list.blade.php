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
                <div class="col-12">
                    <h2 class="mb-0">Categorias de Modelos</h2>
                </div>
            </div>
        </div>
        @if(!$cammodelCategories->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list text-center">
                    @foreach($cammodelCategories as $data)
                    <tr>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->slug }}</td>
                        <td>@include('generals::layouts.status', ['status' => $data->is_active])</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.cammodel-categories.edit', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Editar Categoria">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{route('admin.cammodel-categories.show', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Ver Categoria">
                                    <i class="fas fa-search"></i>
                                </a>
                                <form id="form_1" action="{{route('admin.cammodel-categories.destroy', $data->id)}}"
                                    method="post" class="form-horizontal">
                                    <input type="hidden" name="_method" value="delete">
                                    @csrf
                                    <button type="submit" class="table-action table-action-delete button-reset"
                                        data-toggle="tooltip" data-original-title="Borrar Categoria">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $cammodelCategories->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
