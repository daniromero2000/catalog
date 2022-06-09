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
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        <div class="text-left ml-4">
        </div>
        @if($attributes)
        <table class="table-striped table align-items-center table-flush table-hover text-center">
            @include('generals::layouts.admin.tables.table-headers', [$headers])
            <tbody>
                @foreach($attributes as $data)
                <tr>
                    <td class="text-center">{{$data->name}}</td>
                    <td class="text-center">
                        @include('generals::layouts.status', ['status' =>
                        $data->is_active])
                    </td>
                    <td class="text-center">
                        @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' =>
                        $optionsRoutes])
                    </td>
                </tr>
                @include('ecommerce::layouts.admin.attributes.edit_attribute')
                @endforeach
            </tbody>
        </table>
        <div class="card-footer py-2 text-center">
            {{ $attributes->appends(request()->query())->links() }}
        </div>
        @else
        @include('generals::layouts.admin.pagination.pagination_null')
        @endif
    </div>
</section>
@endsection
