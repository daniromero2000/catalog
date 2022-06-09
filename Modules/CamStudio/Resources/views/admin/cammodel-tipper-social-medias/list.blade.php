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
        @if($cammodelTipperSocialMedias->isNotEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
              @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($cammodelTipperSocialMedias as $data)
                    <tr>
                        <td class="text-center">{{ $data->cammodelTipper->profile }}</td>
                        <td class="text-center">{{ $data->profile }}</td>
                        <td class="text-center">{{ $data->socialMedia->social }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('camstudio::admin.layouts.cammodel-tipper-social-medias.edit_cammodel_tipper_social_media_modal')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $cammodelTipperSocialMedias->appends(request()->query())->links() }}
        </div>
        @else
        @include('generals::layouts.admin.pagination.pagination_null')
        @endif
    </div>
</section>
@endsection
