@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0 pb-0">
            <div class="row">
                @include('generals::layouts.admin.module_name')
            </div>
        </div>
        <div class="row px-3">
            <div class="col 12 col-md-12">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="info-tab" data-toggle="tab"
                                href="#tipper_info" role="tab" aria-controls="home"
                                aria-selected="false">Información</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-sm-3 mb-md-0" id="social-media-tab" data-toggle="tab"
                                href="#tipper_social_media" role="tab" aria-controls="home"
                                aria-selected="false">Redes Sociales</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" style="background: none;" id="tipper_info" role="tabpanel"
                aria-labelledby="info-tab">
                @include('camstudio::admin.layouts.cammodel-tippers.info')
            </div>
            <div class="tab-pane fade" style="background: none;" id="tipper_social_media" role="tabpanel"
                aria-labelledby="social-media-tab">
                @include('camstudio::admin.layouts.cammodel-tippers.social_media')
            </div>
        </div>
    </div>
    @include('camstudio::admin.layouts.cammodel-tippers.add_cammodel_tipper_social_media_modal')
    @include('camstudio::admin.layouts.cammodel-tippers.edit_cammodel_tipper_modal')
</section>
@endsection
