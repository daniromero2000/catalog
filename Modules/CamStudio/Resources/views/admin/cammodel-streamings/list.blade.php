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
        @if(!$cammodelStreamAccounts->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
               @include('generals::layouts.admin.tables.table-headers')
                <div class="message" id="message">Mensaje</div>
                <tbody class="list">
                    @foreach($cammodelStreamAccounts as $row => $data)
                    <tr>
                        <td class="text-center">{{ $data->cammodel->nickname }}</td>
                        <td class="text-center">{{ $data->profile }}</td>
                        <td class="text-center">{{ $data->user }}</td>
                        <td class="text-center"><a
                                href="https://{{ $data->streaming->url }}{{ $data->profile }}">{{ $data->streaming->streaming }}</a>
                        </td>
                        <td class="text-center">
                            <input class="text-center border-0 changeType{{ $row }}" type="password" id="changeType"
                                value="password" data-toggle="modal" data-target="#validationModal"
                                onclick="sendKey({{ $row }}); sendPass('{{ $data->id }}')">
                        </td>
                        <td class="text-center">{{ $data->corporatePhone->phone }}</td>
                        <td class="text-center">{{ $data->corporatePhone->simcard_number }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-streamings.edit_cammodel_streaming')
                    @include('camstudio::admin.layouts.cammodel-streamings.pass_validation')
                    @endforeach
                </tbody>
            </table>
            @include('camstudio::admin.cammodel-streamings.validate')
            <input type="hidden" name="selected" id="selected">
        </div>

        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection
