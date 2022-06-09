@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
               @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$interviewStatuses->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody class="text-center">
                    @foreach ($interviewStatuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>
                            <button class="btn" style="background-color: {{ $status->color }}">
                                <i class="fa fa-check" style="color: #ffffff">
                                </i>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('admin.interview-statuses.destroy', $status->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.interview-statuses.edit', $status->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                        class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{-- @include('generals::layouts.admin.pagination.pagination', [$skip]) --}}
        </div>
    </div>
    @else
    {{-- @include('generals::layouts.admin.pagination.pagination_null', [$skip]) --}}
    @endif
</section>
@endsection
