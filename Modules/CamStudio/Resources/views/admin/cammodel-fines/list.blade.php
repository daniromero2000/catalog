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
        @if($cammodelFines->isNotEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
              @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($cammodelFines as $data)
                    <tr>
                        <td class="text-center">{{ $data->cammodel->nickname }}</td>
                        <td class="text-center">{{ $data->foul->name }}</td>
                        <td class="text-center">{{ $data->created_at->format('M d, Y') }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_aprobed])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-fines.edit_fine')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $cammodelFines->appends(request()->query())->links() }}
        </div>
        @else
        @include('generals::layouts.admin.pagination.pagination_null')
        @endif
    </div>
</section>
@endsection