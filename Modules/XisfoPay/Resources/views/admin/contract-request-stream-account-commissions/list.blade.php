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
                <div class="col-6 col-sm-6 col-md-6 col-xl-2" style="text-align: end">
                    <h3 class="mb-0">{{ $contractRequestStreamAccountCommissions->total() }} {{ $module }} </h3>
                </div>
                @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                    @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
                @endif
            </div>
        </div>
        @if(!$contractRequestStreamAccountCommissions->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @if($contractRequestStreamAccountCommissions)
                    @foreach($contractRequestStreamAccountCommissions as $data)
                    <tr>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">$ {{ number_format($data->amount, 2) }}</td>
                        <td class="text-center"> {{$data->streaming->streaming}} </td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                            @include('generals::layouts.status', ['status' => $data->is_default])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                        @include('xisfopay::layouts.stream-account-commisions.edit_stream_account_commisions_modal', ['contractRequestStreamAccountCommission' => $data])
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{ $contractRequestStreamAccountCommissions->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
