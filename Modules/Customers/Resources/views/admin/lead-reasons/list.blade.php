@extends('generals::layouts.admin.app')
@section('module-name')
Motivos de registro leads |
@endsection
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
        @if(!$leadReasons->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($leads as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->reason }} </td>
                        <td class="text-center">{{ $data->company_id }} </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('customers::layouts.leads.edit_lead')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $leadReasons->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
@section('scripts')
@include('generals::layouts.cities-selectorJS')
@endsection
