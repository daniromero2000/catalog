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
        @if(!empty($bannedCountries->toArray()))
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($bannedCountries as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->country->name }} </td>
                        <td class="text-center">{{ $data->cammodel->nickname }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $bannedCountries->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
