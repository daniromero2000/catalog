@extends('generals::layouts.admin.app')
@section('module-name')
Leads |
@endsection
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<style>
    .pagination {
        justify-content: center;
    }
</style>
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
        @if(!$leads->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($leads as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->name }} {{ $data->last_name }}</td>
                        <td class="text-center">{{ $data->city->city }}</td>
                        <td class="text-center">{{ $data->leadChannel->channel }}</td>
                        <td class="text-center">{{ $data->leadReason->reason }}</td>
                        {{-- <td class="text-center">{{ $data->leadReason->reason }}</td> --}}
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->leadStatus->color }}">
                                {{ $data->leadStatus->name }}
                            </span>
                        </td>
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
            {{ $leads->appends(request()->query())->links() }}
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
