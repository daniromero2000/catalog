@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <h2>Crear chase bank transfer amounts</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
@endsection
