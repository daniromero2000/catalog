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
        @if(!$streamings->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($streamings as $data)
                    <tr>
                        <td class="text-center">{{ $data->streaming }}</td>
                        <td class="text-center">{{ $data->url }}</td>
                        <td class="text-center">$ {{ number_format($data->usd_commission, 2) }} USD</td>
                        <td class="text-center">$ {{ number_format($data->usd_token_rate, 2) }} USD</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('streamings::layouts.admin.streamings.edit_streaming')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $streamings->appends(request()->query())->links() }}
        </div>
    </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
