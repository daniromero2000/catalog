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
        @if($kpis->isNotEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
              @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list text-center">
                    @foreach($kpis as $data)
                    <tr>
                        <td>{{ $data->created_at->format('Y-m-d') }}</td>
                        <td>{{ $data->min_fortnight_goal }}</td>
                        <td>{{ $data->subsidiary->name }}</td>
                        <td>
                            @if ($data->shift != null)
                            {{ $data->shift->name }}
                            @else
                            ----
                            @endif
                        </td>
                        <td>
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('companies::admin.layouts.kpis.edit_kpi')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $kpis->appends(request()->query())->links() }}
        </div>
        @else
        @include('generals::layouts.admin.pagination.pagination_null')
        @endif
    </div>
</section>
@endsection
